<?php
error_log('ログイン認証開始');

if (!isset($_SESSION['login_id'])) {
  // ログイン認証失敗
  error_log('ログイン認証失敗');
  session_destroy();
  header('Location:login.php');
  exit;
}
else {
  // ログイン認証成功
  error_log('ログイン認証成功');
}

?>
