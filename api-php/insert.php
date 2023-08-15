<?php
include("connection_db.php"); 
header('Access-Control-Allow-Origin: *');
header('Response: HTTP/1.1 200 OK');
$json = json_decode(file_get_contents('php://input'), true);

    $name = $json['name'];
    $email = $json['email'];

    $sql = "INSERT INTO api_users (name, email) VALUES ('$name', '$email')";
    if ($con->query($sql) === TRUE) {
        $arr_data[] = array('message' => 'Success');
    } 
    else {
        $arr_data[] = array('message' => 'Database insert error.'.$con->error);
    }

    echo json_encode($arr_data);

?>
