<?php

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://eu53.chat-api.com/instance190232/sendMessage?token=axsngvj9msw782fz",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "phone=79995253422&body=Test-Msg",
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/x-www-form-urlencoded"
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
