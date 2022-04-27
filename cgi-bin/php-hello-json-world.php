<?php
$date = date('Y-m-d H:i:s');

$data = [ 'title' => 'Hello World', 'heading' => 'Hello World', 'message' => 'Hello World', 'time' => $date, 'IP' => $_SERVER['REMOTE_ADDR']];

header('Cache-Control: no-cache');
header('Content-type: application/json');
echo json_encode( $data );
?>
