<?php
require('../wp-config.php');

$consumer_key = 'ck_ac41b691be52a04f4740127bcca0af31a957f579';
$consumer_secret = 'cs_81f527da7c60151beff84cb2a037405c9a890091';

$order_ids = array();
$con = mysqli_connect("localhost","wownow_wow","wownow_wow","wownow_wow");
$productsQuery = "SELECT `ID` FROM `wp_posts` WHERE `post_type` = 'product' AND `post_author` = '{$_GET['vendor']}'";
$products = mysqli_query($con,$productsQuery);
if($products->num_rows > 0){
    while($product = mysqli_fetch_assoc($products)){
        $itemMetaQuery = "SELECT `order_item_id` FROM `wp_woocommerce_order_itemmeta` WHERE `meta_key` = '_product_id' AND `meta_value` = '{$product['ID']}'";
        $itemMetaObject = mysqli_query($con,$itemMetaQuery);
        if($itemMetaObject->num_rows > 0){
            while($itemMeta = $itemMetaObject->fetch_assoc()){
                $itemsQuery = "SELECT `order_id` FROM `wp_woocommerce_order_items` WHERE `order_item_id` = {$itemMeta['order_item_id']} AND `order_item_type` = 'line_item'";
                $itemsObject = mysqli_query($con,$itemsQuery);
                if($itemsObject->num_rows > 0){
                    while($item = $itemsObject->fetch_assoc()){
                        $order_ids[] = $item['order_id'];
                    }
                }
            }
        }
    }
}
$orders = array();
foreach($order_ids as $k=>$v){
    $ch = curl_init("https://wownow.pk/wp-json/wc/v3/orders/{$v}");
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_USERPWD,"{$consumer_key}:{$consumer_secret}");
    $result = json_decode(curl_exec($ch));
    if(curl_errno($ch)){
        var_dump(curl_error($ch));
    }
    curl_close($ch);
    $items = "";
    foreach($result->line_items as $kk=>$vv){
        $items .= (($kk == 0) ? "" : ", ") . $vv->name;
    }
    $result->all_items = $items;
    $orders[] = $result;
}
$jsonOrders = json_encode($orders);
$arrayOrders = json_decode($jsonOrders,true);
echo json_encode(array_unique($arrayOrders));die;
?>