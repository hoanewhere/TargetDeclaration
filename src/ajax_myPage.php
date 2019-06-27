<?php
include 'function.php';

error_log('ajax_myPage処理');
error_log('postデータ:' . print_r($_POST, true));

if (!empty($_POST['target'])) {
  $target = $_POST['target'];
  $id = $_POST['id'];
  try {
    $dbh = dbConnect();
    $sql = 'UPDATE target SET target = :target WHERE id = :id';
    $data = array(':target' => $target, ':id' => $id);
    $stmt = queryPost($dbh, $sql, $data);

    $data = ['target' => $target];
    echo json_encode($data);
  }
  catch(Exception $e) {
    error_log('エラー発生 :' . $e->getMessage() );
    $errMsg['common'] = '例外発生';
    echo "";
  }
} else if (!empty($_POST['chk'])) {
  $id = $_POST['id'];
  try {
    $dbh = dbConnect();
    $sql = 'UPDATE target SET complete_flg = "1" WHERE id = :id';
    $data = array(':id' => $id);
    $stmt = queryPost($dbh, $sql, $data);

    $data = ['id' => $id];
    echo json_encode($data);
  }
  catch(Exception $e) {
    error_log('エラー発生 :' . $e->getMessage() );
    $errMsg['common'] = '例外発生';
    echo "";
  }
}

?>
