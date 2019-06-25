<?php
include 'function.php';

error_log('ログアウト開始');

session_destroy();
header('Location:index.php');

?>
