<?php
include 'function.php';

error_log('ログイン画面');

// ログイン認証


if (!empty($_POST)) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  // 入力項目のバリデーションチェック

  //emailの文字数チェック
  //emailの形式チェック
  //passの文字数チェック
  //passの文字チェック

  if (empty($errMsg)) {
    // DB接続してユーザあるかチェック
    // あればログイン、なければTOPページに遷移
    try {
      $dbh = dbConnect();
      $sql = 'SELECT * FROM users WHERE email = :email AND password = :password';
      $data = array(':email' => $email, ':password' => $password);
      $stmt = queryPost($dbh, $sql, $data);
      $result = $stmt->fetch(PDO::FETCH_ASSOC);

      if (!empty($result)) {
        // ログイン成功
        error_log('ログイン成功');
        $_SESSION['login_id'] = $result['id'];
        $_SESSION['login_email'] = $result['email'];
        $_SESSION['login_date'] = time();

        error_log('セッション情報:' . print_r($_SESSION, true));

        header('Location:myPage.php');
        exit;
      }
      else {
        // ログイン失敗
        error_log('ログイン失敗');
        session_destroy();
        header('Location:index.php');
        exit;
      }
    }
    catch(Exception $e) {
      error_log('エラー発生' . $e->getMessage());
      $errMsg['common'] = '例外発生';
    }
  }
}

?>

<?php
$title = 'ログイン';
include 'header.php';
include 'bodyHeader.php';
?>
  <main>
    <div class="main-form">
      <h1>Login</h1>
      <form action="" method="post">
        <input type="text" name="email" placeholder="Email" class="input-width-max">
        <input type="password" name="password" placeholder="Password" class="input-width-max">
        <input type="submit" value="Enter" class="input-width-max">
      </form>
      <p class="new-acount-tab"><a href="addUser.php">→ New Acount</a></p>
      <p class="new-acount-tab"><a href="remindPass.php">→ Remaind Pass</a></p>
    </div>
  </main>
<?php
include 'bodyFooter.php';
?>
