<?php
include 'function.php';

error_log('ログインユーザ画面');

if (!empty($_POST)) {
  $userName = $_POST['user_name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $rePassword = $_POST['re_password'];

  error_log('ポストデータ(user_name):' . $userName);
  error_log('ポストデータ(email):' . $email);
  error_log('ポストデータ(password):' . $password);
  error_log('ポストデータ($rePassword):' . $rePassword);

  // 入力項目のバリデーションチェック

  // ユーザネームの文字数チェック
  // ユーザネームの文字チェック
  // emailの形式チェック
  // パスワードの文字数チェック
  // パスワードの文字チェック
  // パスワードとreパスワードの一致チェック
  // 登録済みのメアドじゃないかチェック

  // DB接続してデータ登録
  if (empty($errMsg)) {
    try {
      $dbh = dbConnect();
      $sql = 'INSERT INTO users (user_name, password, email, create_date, update_date) VALUES (:user_name, :password, :email, :create_date, :update_date )';
      $data = array(':user_name' => $userName, ':password' => password_hash($password, PASSWORD_DEFAULT), ':email' => $email, ':create_date' => date('Y-m-d H:i:s'), ':update_date' => date('Y-m-d H:i:s'));

      $stmt = queryPost($dbh, $sql, $data);
      error_log('sql実行結果(ユーザ登録)' . print_r($stmt, true));

      // ログイン情報保持
      $_SESSION['login_email'] = $email;
      $_SESSION['login_date'] = time();

      error_log('セッション情報:' . print_r($_SESSION, true));

      header('Location:myPage.php');
      exit;
    }
    catch (Exception $e) {
      error_log('エラー発生 :' . $e->getMessage() );
      $errMsg['common'] = '例外発生';
    }
  }
}

?>

<?php
$title = 'ユーザ登録';
include 'header.php';
include 'bodyHeader.php';
?>
  <main>
    <div class="main-form">
      <h1>User Info</h1>
      <form action="" method="post">
        <p>User Name</p>
        <input type="text" name="user_name" placeholder="UserName" class="input-width-max">
        <p>Email</p>
        <input type="text" name="email" placeholder="Email" class="input-width-max">
        <p>Password</p>
        <input type="password" name="password" placeholder="Password" class="input-width-max">
        <p>Re: Password</p>
        <input type="password" name="re_password" placeholder="Password" class="input-width-max">
        <input type="submit" value="Add User" class="input-width-max">
      </form>
    </div>
  </main>
<?php
include 'bodyFooter.php';
?>
