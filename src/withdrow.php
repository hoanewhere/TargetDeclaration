<?php
include 'function.php';

error_log('退会画面');

// ログイン認証する


if (isset($_POST['widhdrow'])) {
  //退会処理実施
  try {
    $dbh = dbConnect();
    $sql = 'UPDATE users SET delete_flg = 1 WHERE email = :email';
    $data = array(':email' => $_SESSION['login_email']);
    $stmt = queryPost($dbh, $sql, $data);
    error_log('sql(退会処理)：' . print_r($stmt, true));

    session_destroy();
    header('Location:index.php');

  }
  catch(Exception $e) {
    error_log('エラー発生 :' . $e->getMessage() );
    $errMsg['common'] = '例外発生';
  }
}

?>

<?php
$title = '退会';
include 'header.php';
include 'bodyHeader.php';
?>
  <main>
    <div class="main-form">
      <h1>Withdrow</h1>
      <form action="" method="post">
        <input type="submit" name="widhdrow" value="Remove User" class="input-width-max">
      </form>
    </div>
  </main>
<?php
include 'bodyFooter.php';
?>
