<?php
include 'function.php';

error_log('パスワード編集画面');

include 'auth.php';

if (!empty($_POST)) {
  $old_pass = $_POST['old_pass'];
  $new_pass = $_POST['new_pass'];
  $new_re_pass = $_POST['new_re_pass'];

  // ユーザの現PASSが正しいかチェック
  try {
    $dbh1 = dbConnect();
    $sql1 = 'SELECT * FROM users WHERE email = :email';
    $data1 = array(':email'=> $_SESSION['login_email']);
    $stmt1 = queryPost($dbh1, $sql1, $data1);
    $result1 = $stmt1->fetch(PDO::FETCH_ASSOC);

    if (!empty($result1)) {
      if (password_verify($old_pass, $result1['password'])) {
        // 現PASS確認完了
        if ( $new_pass === $new_re_pass ) {
          // 新PASS確認完了
          $dbh2 = dbConnect();
          $sql2 = 'UPDATE users SET password = :pass WHERE email = :email';
          $data2 = array(':email'=> $_SESSION['login_email'], ':pass'=> password_hash($new_pass, PASSWORD_DEFAULT));
          $stmt2 = queryPost($dbh2, $sql2, $data2);

          error_log('sql(パスワード編集)：' . print_r($stmt2, true));
          header('Location:index.php');
          exit;
        }
      }
    }
    // パスワード編集失敗
    error_log('パスワード編集失敗');

  }
  catch(Exception $e) {
    error_log('エラー発生 :' . $e->getMessage() );
    $errMsg['common'] = '例外発生';
  }
}

?>

<?php
$title = 'パスワード変更';
include 'header.php';
include 'bodyHeader.php';
?>
  <main>
    <div class="main-form">
      <h1>Change Pass</h1>
      <form action="" method="post">
        <p>Old Password</p>
        <input type="password" name="old_pass" placeholder="old" class="input-width-max">
        <p>New Password</p>
        <input type="password" name="new_pass" placeholder="new" class="input-width-max">
        <p>Re: New Password</p>
        <input type="password" name="new_re_pass" placeholder="re: new" class="input-width-max">
        <input type="submit" value="Change Pass" class="input-width-max">
      </form>
    </div>
  </main>
<?php
include 'bodyFooter.php';
?>
