<?php
include 'function.php';

error_log('マイページ画面');
error_log('POSTデータ:' . print_r($_POST, true));
error_log('GETデータ:' . print_r($_GET, true));

// post確認
if (!empty($_POST)) {
  $add_target = $_POST['add-target'];
  $add_date = $_POST['add-date'];
  error_log('POSTデータ(target):' . $add_target);
  error_log('POSTデータ(date):' . $add_date);

  // user_id取得有無確認

  // target追加
  try {
    $dbh = dbConnect();
    $sql ='INSERT INTO target (target, user_id, scheduled_date, create_date) VALUES (:target, :user_id, :scheduled_date, :create_date)';
    $data = array(':target' => $add_target, ':user_id' => $_SESSION['login_id'], ':scheduled_date' => $add_date, ':create_date' => date('Y-m-d H:i:s'));
    $stmt = queryPost($dbh, $sql, $data);

    header('Location:myPage.php');
    exit;
  }
  catch (Exception $e) {
    error_log('エラー発生 :' . $e->getMessage() );
    $errMsg['common'] = '例外発生';
  }
} else {  // POSTない場合
  // get情報取得
  $start_day = $_GET['start_day'];
  $end_day = $_GET['end_day'];
  $attr_task = $_GET['attr_task'];

  if ( empty($start_day) ) {
    $start_day = '0000-01-01';
  }
  if ( empty($end_day) ) {
    $end_day = '9999-12-30';
  }

  error_log('開始日' . $start_day);
  error_log('終了日' . $end_day);
  error_log('表示属性' . $attr_task);

  try {
    $dbh1 = dbConnect();

    if (empty($attr_task)) {
      $sql1 ='SELECT DISTINCT scheduled_date FROM target WHERE user_id = :user_id AND complete_flg = "0" AND delete_flg = "0" AND scheduled_date >= :start_day AND scheduled_date <= :end_day ORDER BY scheduled_date ASC';
    } else if ($attr_task == 1) {
      $sql1 ='SELECT DISTINCT scheduled_date FROM target WHERE user_id = :user_id AND complete_flg = "1" AND delete_flg = "0" AND scheduled_date >= :start_day AND scheduled_date <= :end_day ORDER BY scheduled_date ASC';
    } else {
      $sql1 ='SELECT DISTINCT scheduled_date FROM target WHERE user_id = :user_id AND delete_flg = "0" AND scheduled_date >= :start_day AND scheduled_date <= :end_day ORDER BY scheduled_date ASC';
    }

    $data1 = array(':user_id'=>$_SESSION['login_id'], ':start_day' => $start_day, ':end_day' => $end_day);
    $stmt1 = queryPost($dbh1, $sql1, $data1);
    $results_scheduled = $stmt1->fetchAll();
    error_log('現在のid:' . $_SESSION['login_id']);
    error_log('stmtの中身:' . print_r($stmt1, true));
    error_log('スケジュールデータの結果:' . print_r($results_scheduled, true));

    // スケジュールデータの数だけデータを取得する
    $results_target = array();
    foreach ($results_scheduled as $row) {
      error_log('各スケジュールデータ:'. $row['scheduled_date']);

      $dbh2 = dbConnect();

      if (empty($attr_task)) {
        $sql2 ='SELECT id, target, complete_flg, scheduled_date FROM target WHERE user_id = :user_id AND complete_flg = "0" AND delete_flg = "0" AND scheduled_date = :scheduled_date';
      } else if ($attr_task == 1) {
        $sql2 ='SELECT id, target, complete_flg, scheduled_date FROM target WHERE user_id = :user_id AND complete_flg = "1" AND delete_flg = "0" AND scheduled_date = :scheduled_date';
      } else {
        $sql2 ='SELECT id, target, complete_flg, scheduled_date FROM target WHERE user_id = :user_id AND delete_flg = "0" AND scheduled_date = :scheduled_date';
      }

      $data2 = array(':user_id'=>$_SESSION['login_id'], ':scheduled_date'=>$row['scheduled_date']);
      $stmt2 = queryPost($dbh2, $sql2, $data2);
      $results_target[] = $stmt2->fetchAll();
      error_log('stmtの中身:' . print_r($stmt2, true));
      error_log('targetの結果:' . print_r($results_target, true));
    }
    error_log('全targetの結果:' . print_r($results_target, true));
    error_log('targetの配列数:'. count($results_target));
  }
  catch (Exception $e) {
    error_log('エラー発生 :' . $e->getMessage() );
    $errMsg['common'] = '例外発生';
  }
}



?>

<?php
$title = 'マイページ';
include 'header.php';
include 'bodyHeader.php';
?>
  <main>
    <div class="mypage-container">
      <div class="my-side-container">
        <section class="side-bar">
          <h3>表示内容</h3>
          <form action="" method="get">
            <p>開始日</p>
            <input type="date" name="start_day" class="input-width-max" value=<?php if(!empty($_GET['start_day'])) echo $_GET['start_day'] ?>>
            <p>終了日</p>
            <input type="date" name="end_day" class="input-width-max" value=<?php if(!empty($_GET['end_day'])) echo $_GET['end_day'] ?>>
            <!-- <p>表示単位</p>
            <select class="input-width-half" name="display_unit">
              <option value="DAY">DAY</option>
              <option value="MONTH">MONTH</option>
              <option value="year">YEAR</option>
            </select> -->
            <p>属性</p>
            <select class="input-width-max" name="attr_task">
              <option value="0" <?php if(empty($attr_task)) echo 'selected' ?>>NOT YET</option>
              <option value="1" <?php if($attr_task == 1) echo 'selected' ?>>COMPLETE</option>
              <option value="2" <?php if($attr_task == 2) echo 'selected' ?>>ALL</option>
            </select>
            <input type="submit" name="" value="SHOW" class="input-width-max">
          </form>
          <button type="button" name="add-button" class="js-add-button">新規追加</button>
        </section>
      </div>
      <div class="my-main-container">
        <section class="main-bar">
          <h1>TARGET</h1>
          <article>
            <form class="" action="" method="">
              <?php for($i_date = 0; $i_date < count($results_scheduled); $i_date++): ?>
                <div class="day-block">
                  <h3 class="sentence-date"><?php echo substr($results_scheduled[$i_date]['scheduled_date'], 0, 10); ?></h3>
                    <?php for($i_ta = 0; $i_ta < count($results_target[$i_date]); $i_ta++): ?>
                      <div class="sententce">
                        <textarea name="target" rows="1" class="js-target-text"><?php echo  $results_target[$i_date][$i_ta]['target']; ?></textarea>
                        <input type="date" class="js-target-date" value=<?php echo substr($results_target[$i_date][$i_ta]['scheduled_date'], 0, 10); ?>>
                        <input type="checkbox" class="js-target-chk" <?php if($results_target[$i_date][$i_ta]['complete_flg'] == 1) echo 'checked' ?>>
                        <span class="remain-id js-remain-id"><?php echo  $results_target[$i_date][$i_ta]['id']; ?></span>
                      </div>
                    <?php endfor; ?>
                </div>
              <?php endfor; ?>
            </form>
          </article>
        </section>
      </div>
    </div>
    <div class="add-form">
      <section>
        <form class="" action="" method="post">
          <div class="add-block">
            <h3 class="add-title">新規Target　追加</h3>
            <span class="cancel-add-form css-cancel js-cancel-add-form"></span>
              <div class="sententce">
                <textarea name="add-target" rows="1" placeholder="Targetを入力してください"></textarea>
                <input type="date" name="add-date">
                <input type="submit" name="" value="追加">
              </div>
          </div>
      </section>
    </div>
  </main>
<?php
include 'bodyFooter.php';
?>
