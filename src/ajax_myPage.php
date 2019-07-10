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
} else if (isset($_POST['chk'])) {
  error_log('chk項目　チェンジ');
  $chk = $_POST['chk'];
  $id = $_POST['id'];
  error_log('chk状態：' . $chk);

  try {
    $dbh = dbConnect();
    $sql = 'UPDATE target SET complete_flg = :comp_flg WHERE id = :id';
    $data = array(':comp_flg' => $chk ,':id' => $id);
    $stmt = queryPost($dbh, $sql, $data);

    $data = ['id' => $id];
    echo json_encode($data);
  }
  catch(Exception $e) {
    error_log('エラー発生 :' . $e->getMessage() );
    $errMsg['common'] = '例外発生';
    echo "";
  }
} else if (!empty($_POST['date'])) {
  $date = $_POST['date'];
  $id = $_POST['id'];
  try {
    $dbh = dbConnect();
    $sql = 'UPDATE target SET scheduled_date = :scheduled_date WHERE id = :id';
    $data = array(':scheduled_date' => $date, ':id' => $id);
    $stmt = queryPost($dbh, $sql, $data);

    $data = ['id' => $id];
    echo json_encode($data);
  }
  catch(Exception $e) {
    error_log('エラー発生 :' . $e->getMessage() );
    $errMsg['common'] = '例外発生';
    echo "";
  }
} else {
  error_log('POSTデータなし');
}
?>
