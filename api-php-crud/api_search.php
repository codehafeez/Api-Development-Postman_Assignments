<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');

$data = json_decode(file_get_contents("php://input"), true);

$searchterm = $data['search'];
include 'connect.php';

$sql = "select * from studentdata where name like '%$searchterm%'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

  echo json_encode($data);
} else {  
  echo json_encode(['msg' => 'No Data Found to search query!', 'status' => false]);
}
?>