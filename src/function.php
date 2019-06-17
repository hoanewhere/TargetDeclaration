<?php
//    ログ取るかどうか
ini_set("log_errors", "ON");
ini_set("error_log", "php.log");

// セッション設定
session_start();
session_regenerate_id();
error_log('セッション情報:' . print_r($_SESSION, true));

// エラーメッセージ
$errMsg = array();


// DB周り
function dbConnect() {
  $dsn = 'mysql:dbname=target_declaration; host=localhost; charset=utf8';
  $user = 'root';
  $password = 'root';
  $options = array(
    // SQL実行失敗時にはエラーコードのみ設定
    PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT,
    // デフォルトフェッチモードを連想配列形式に設定
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    // バッファードクエリを使う(一度に結果セットをすべて取得し、サーバー負荷を軽減)
    // SELECTで得た結果に対してもrowCountメソッドを使えるようにする
    PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
  );

  $dbh = new PDO($dsn, $user, $password, $options);

  return $dbh;
}

function queryPost($dbh, $sql, $data) {
  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);
  error_log('関数内' . print_r($stmt, true));
  return $stmt;
}


?>
