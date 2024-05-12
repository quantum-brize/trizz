<?php
include "inc.php";  

 
$rswe=GetPageRecord('*','weatherAPI',' 1 and udpateDate<"'.date('Y-m-d').'" order by id asc'); 
while($restWeather=mysqli_fetch_array($rswe)){ 
  

$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://weather-by-api-ninjas.p.rapidapi.com/v1/weather?city=".$restWeather['cityName']."",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"X-RapidAPI-Host: weather-by-api-ninjas.p.rapidapi.com",
		"X-RapidAPI-Key: 4qHxfnYRW8mshIpW9aY4RfeEmocZp1ZXAWDjsnQk9pQYTjDPCQ"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	
	$data = json_decode($response);	
	
 
	
$namevalue ='cloud_pct="'.$data->cloud_pct.'",tempWether="'.$data->temp.'",feels_like="'.$data->feels_like.'",humidity="'.$data->humidity.'",min_temp="'.$data->min_temp.'",max_temp="'.$data->max_temp.'",wind_speed="'.$data->wind_speed.'",wind_degrees	="'.$data->wind_degrees	.'",sunrise="'.$data->sunrise.'",sunset="'.$data->sunset.'",udpateDate="'.date('Y-m-d').'"';   
$where='id="'.$restWeather['id'].'"';    
updatelisting('weatherAPI',$namevalue,$where); 

}


}
?>