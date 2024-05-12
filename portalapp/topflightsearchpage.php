<?php
include "config/database.php";
ini_set('max_execution_time', '300');  
   
 
include "agenturlinc.php";
include "config/function.php"; 
include "flight_setting.php";
 
$obj = json_decode(json_encode($_POST)); 
  

$TokenId=$data["TokenId"];  
$EndUserIp=$data["EndUserIp"];
 
  



$datalist.='';
$rs=GetPageRecord('*','flightSearchLog',' 1  order by id desc limit 0,10');
while($rest=mysqli_fetch_array($rs)){ 

if($rest['tripType']==1){
$way='One Way';
}
if($rest['tripType']==2){
$way='Round Trip';
}

$datalist.='{
		"from": "'.stripslashes($rest['userFrom']).'",
        "to": "'.stripslashes($rest['userTo']).'",
        "type": "'.$way.'",
        "typeId": "'.stripslashes($rest['tripType']).'",
        "date": "'.date('d-m-Y',strtotime($rest['userDeparture'])).'"
      },';
}

  
 

echo '{ 
"TokenId":"'.$TokenId.'",
"Error":{
"ErrorCode":0,
"ErrorMessage":""
},
"FlightSearch":[
      '.rtrim($datalist,',').'
    ]
}';

 

 

?>