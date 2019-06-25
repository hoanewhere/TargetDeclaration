<?php
error_log('ログイン認証開始');

$current_url = basename($_SERVER['REQUEST_URI']);
error_log('カレントURI:' . $current_url);

if ($current_url != 'login.php') {
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
}


?>
