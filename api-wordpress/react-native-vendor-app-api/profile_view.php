<?php
header('Access-Control-Allow-Origin: *');
header('Response: HTTP/1.1 200 OK');
require('../wp-config.php');



$json = json_decode(file_get_contents('php://input'), true);
$myrows = $wpdb->get_results("SELECT user_email, display_name, api_mobile_number, api_address FROM wp_users WHERE user_email='$json[email]'");

foreach ($myrows as $row) 
{
    echo json_encode(array(
        'user_email' => $row->user_email,
        'display_name' => $row->display_name,
        'mobile_number' => $row->api_mobile_number,
        'address' => $row->api_address
    ));
}
