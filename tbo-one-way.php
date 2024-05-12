<?php 
include "inc.php"; 
include "config/logincheck.php";

//include('top-cache.php');

$jsonAuth = '{
   "TYPE":"AUTH",
   "NAME":"GET_AUTH_TOKEN",
   "STR":[
      {
         "A_ID":"'.$A_ID.'",
         "U_ID":"'.$U_ID.'",
         "PWD":"'.$PWD.'",
         "MODULE":"'.$MODULE.'",
         "HS":"'.$hitSource.'"
      }
   ]
}';

//logger("JSON POST FOR AUTH: ".$jsonAuth);
 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$TokenUrl);
curl_setopt($ch, CURLINFO_HEADER_OUT, true);
curl_setopt($ch, CURLOPT_POST,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonAuth);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); 
curl_setopt($ch, CURLOPT_TIMEOUT, 300); 
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);

$responseAuth = curl_exec($ch); 
curl_close($ch);
$responseAuthArr = json_decode($responseAuth);


//logger("Response return from auth API: ".$responseAuth);


 
 


$tokenId = trim($responseAuthArr->RESULT);
$newSessionId = trim($_SESSION['uniqueId']);
$tripType = trim($_REQUEST['tripType']);
$fromDestinationFlight = trim($_REQUEST['fromDestinationFlight']);
$toDestinationFlight = trim($_REQUEST['toDestinationFlight']);
$journeyDateOne = trim($_REQUEST['journeyDateOne']);
$journeyDateRound = trim($_GET['journeyDateRound']);

$cabinclass = trim($_REQUEST['PC']);

$ADT = trim($_REQUEST['ADT']);
$CHD = trim($_REQUEST['CHD']);
$INF = trim($_REQUEST['INF']);
$PC = trim($_REQUEST['PC']);
$toalPaxFinal=$ADT+$CHD+$INF;
$toalPax=$ADT+$CHD;

if($tripType=='1'){ 
	 $journeyDate = date('Y-m-d',strtotime($journeyDateOne));
	 $returnDate = '';
}else{ 
	 
	 $journeyDate = date('Y-m-d',strtotime($journeyDateOne));
	 $returnDate = date('Y-m-d',strtotime($journeyDateRound));
}

$fromdestexp = explode('-',$fromDestinationFlight);
$todestexp = explode('-',$toDestinationFlight);

if (strstr($fromdestexp[1],'India')=='India' && strstr($todestexp[1],'India')=='India') {
  $SECTOR = 'D';
} else {
  $SECTOR = 'I';
}

  
 
 
 
 
 // **************** TBO API **************************
 
 include dirname(__FILE__).'/FLYTBOAPI/APIConstants.php';
include dirname(__FILE__).'/FLYTBOAPI/RestApiCaller.php';
include dirname(__FILE__).'/FLYTBOAPI/FlightAuthentication.php';


// Token Generate 
if(!isset($_SESSION['tbotokenId']) || $_SESSION['tbotokenId']=='')

{

	include dirname(__FILE__).'/FLYTBOAPI/FlightAuthentication2.php';

	$_SESSION['tbotokenId']=$json['TokenId'];

}	

 include dirname(__FILE__).'/FLYTBOAPI/FlightSearch2.php';
 

updatelisting('wig_flight_json_bkp','endSearch=1',' uniqueSessionId="'.$_SESSION['uniqueSessionId'].'"  ');

?>