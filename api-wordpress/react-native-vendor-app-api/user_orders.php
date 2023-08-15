<?php
header('Access-Control-Allow-Origin: *');
header('Response: HTTP/1.1 200 OK');
require('../wp-config.php');

$consumer_key = 'ck_26f9f34d639c50541d886c8997208b17799173a0';
$consumer_secret = 'cs_77233b8ce9d09c07b9ea991a99398019095f73e1';

$ch = curl_init('https://wownow.pk/wp-json/wc/v2/orders?consumer_key='.$consumer_key.'&consumer_secret='.$consumer_secret);

$result = curl_exec($ch);
curl_close($ch);

print_r($result);

    // echo json_encode(array('Data' => $result));
