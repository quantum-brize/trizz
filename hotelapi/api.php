<?php

$body1 = '{
  "ClientId": "tboprod",
  "UserName": "DELT2324",
  "Password": "Today@#9823$",
  "EndUserIp": "'.$_SERVER['SERVER_ADDR'].'" 
}';

$ch = curl_init();
$url = 'https://api.travelboutiqueonline.com/SharedAPI/SharedData.svc/rest/Authenticate';

$headers = array(
'Content-Type: application/json',
'Content-Length: '.strlen($body1),    
'Accept: application/json',
'UserName:AMDR802',
'APIPassword:@Travel#Ind-11'
);

 


curl_setopt($ch , CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $body1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$information = curl_getinfo($ch);
//print_r($information);
$result = curl_exec($ch);
  
 

$json_arr = json_decode($result,true);
$tokenId = $json_arr['TokenId'];
$_SESSION['hotelTokenId']=$tokenId;
?>  