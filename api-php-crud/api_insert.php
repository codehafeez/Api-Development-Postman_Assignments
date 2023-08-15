<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods, Access-Control-Allow-Headers, Authorization, X-Requested-With');
$data = json_decode(file_get_contents("php://input"), true);

$sname = $data['sname'];
$sage = $data['sage'];
$scity = $data['scity'];

include 'connect.php';

$sql = "insert into studentdata (name, age, city) values ('$sname', '$sage', '$scity')";

if (mysqli_query($conn, $sql)) {
  echo json_encode(['msg' => 'Data Inserted Successfully!', 'status' => true]);
} else {
  echo json_encode(['msg' => 'Data Failed to be Inserted!', 'status' => false]);
}
?>