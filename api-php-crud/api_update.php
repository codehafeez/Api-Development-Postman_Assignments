<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods, Access-Control-Allow-Headers, Authorization, X-Requested-With');

$data = json_decode(file_get_contents("php://input"), true);

$sid = $data['sid'];
$sname = $data['sname'];
$sage = $data['sage'];
$scity = $data['scity'];

include 'connect.php';

$sql = "update studentdata set name = '$sname', age = '$sage', city = '$scity' where id = '$sid'";

if (mysqli_query($conn, $sql)) {
  echo json_encode(['msg' => 'Data Updated Successfully!', 'status' => true]);
} else {
  echo json_encode(['msg' => 'Data Failed to be Updated!', 'status' => false]);
}

?>