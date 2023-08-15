<?php
header('Access-Control-Allow-Origin: *');
header('Response: HTTP/1.1 200 OK');
require('../wp-config.php');


$json = json_decode(file_get_contents('php://input'), true);
$res = $wpdb->update('wp_users', 
	array( 
		'display_name' => $json[display_name],
		'api_mobile_number' => $json[mobile_number],
		'api_address' => $json[address],
	), 
	array('user_email' => '$json[email]'), 
	array('%s', '%s', '%s'), 
	array('%d') 
);


if($res){ echo json_encode(array('msg' => "Success")); }
else { echo json_encode(array('msg' => "Run Database Query Error")); }

