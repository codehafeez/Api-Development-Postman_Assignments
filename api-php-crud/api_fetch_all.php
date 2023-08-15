<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

include 'connect.php';

$sql = "select * from studentdata";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
  echo json_encode($data);
} else {
  echo json_encode(['msg' => 'No Data!', 'status' => false]);
}
?>