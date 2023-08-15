<?php
header('Access-Control-Allow-Origin: *');
header('Response: HTTP/1.1 200 OK');
require('../wp-config.php');


$json = json_decode(file_get_contents('php://input'), true);
wp_login($json[email], $json[password]);
// wp_login('rider1@gmail.com', 'rider1@gmail.com');
function wp_login($username, $password, $deprecated = '') 
{
    $user = wp_authenticate($username, $password);
    if (!is_wp_error($user)) {
        

        $allowed_roles = array('Rider');
        if($allowed_roles[0] === 'Rider'){
            echo json_encode(
            array(
                'msg' => "Success",
                'email' => $username,
                'id' =>$user->data->ID
            ));
        }
        else {
            echo json_encode(
                array('msg' => "Sorry! Incorrect Email or Password."));
        }
    }
    else { 
        echo json_encode(array('msg' => "Sorry! Incorrect Email or Password."));
        // echo $user->get_error_message(); 
    }
}
