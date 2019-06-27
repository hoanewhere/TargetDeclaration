<?php
include 'function.php';

error_log('マイページ画面');

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
  //GETがない場合
  try {
    $dbh1 = dbConnect();
    $sql1 ='SELECT DISTINCT scheduled_date FROM target WHERE user_id = :user_id AND complete_flg = "0" AND delete_flg = "0" ORDER BY scheduled_date ASC';
    $data1 = array(':user_id'=>$_SESSION['login_id']);
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
      $sql2 ='SELECT id, target, complete_flg, scheduled_date FROM target WHERE user_id = :user_id AND complete_flg = "0" AND delete_flg = "0" AND scheduled_date = :scheduled_date';
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
          <form action="#">
            <p>開始日</p>
            <input type="date" name="start_day" class="input-width-max">
            <p>終了日</p>
            <input type="date" name="end_day" class="input-width-max">
            <p>表示単位</p>
            <select class="input-width-half" name="display_unit">
              <option value="year">YEAR</option>
              <option value="MONTH">MONTH</option>
              <option value="DAY">DAY</option>
            </select>
            <p>属性</p>
            <select class="input-width-half" name="attr_task">
              <option value="all">ALL</option>
              <option value="not_yet">NOT YET</option>
              <option value="complete">COMPLETE</option>
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
                        <input type="date" value=<?php echo substr($results_target[$i_date][$i_ta]['scheduled_date'], 0, 10); ?>>
                        <input type="checkbox" class="js-target-chk">
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
