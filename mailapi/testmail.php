<?php

$url = "https://sygmatravels.com/mailapi/mailapi.php";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);

        $data = array(
        'to' => 'mohd.m.imran@gmail.com',
        'Subject' => 'Rest Password',
        'Detail' => 'Dear Mohd Your updated login details'
);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
$contents = curl_exec($ch);
$contentres=json_decode($contents,true); 
curl_close($ch);
?>