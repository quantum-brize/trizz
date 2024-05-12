<?php

$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://api2pdf-api2pdf-v1.p.rapidapi.com/wkhtmltopdf/url",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "POST",
	CURLOPT_POSTFIELDS => "{
  \"url\": \"https://travbizz.in/crm/b2c/downloadpackagepdf_withimage.php?id=202566291\",
  \"inlinePdf\": true,
  \"fileName\": \"wkhtmltopdf-url-to-pdf.pdf\",
  \"options\": {
    \"orientation\": \"portrait\",
    \"pageSize\": \"A4\",
     \"margin-top\": \"0in\",
	  \"margin-right\": \"0in\",
	   \"margin-bottom\": \"0in\",
	    \"margin-left\": \"0in\"
	
  }
}",
	CURLOPT_HTTPHEADER => [
		"X-RapidAPI-Host: api2pdf-api2pdf-v1.p.rapidapi.com",
		"X-RapidAPI-Key: 4qHxfnYRW8mshIpW9aY4RfeEmocZp1ZXAWDjsnQk9pQYTjDPCQ",
		"content-type: application/json"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $response;
}