<?php
include "config/database.php";
ini_set('max_execution_time', '300');  
    
 
include "agenturlinc.php";
include "config/function.php"; 


if($_SESSION['uniqueId']==''){
$_SESSION['uniqueId'] = uniqid();
}
 
 



 
$obj = json_decode(json_encode($_POST));  
$MemberId=$obj->MemberId;  
$searcharray=$obj->searcharray;   
 $_REQUEST=get_object_vars(json_decode($searcharray));

$Api='tj';
$tripType=$_REQUEST["tripType"];
$SRC=$_REQUEST["fromDestinationFlight"];
$DES=$_REQUEST["toDestinationFlight"];
$DEP_DATE=$_REQUEST["journeyDateOne"];
$RET_DATE=$_REQUEST["journeyDateRound"];
$ADT=$_REQUEST["ADT"];
$CHD=$_REQUEST["CHD"];
$INF=$_REQUEST["INF"];
$PC=$_REQUEST["PC"]; 

deleteRecord('wig_flight_json_bkp',' 1 and  agentId="'.$MemberId.'"  ');  
  

$b=GetPageRecord('id','sys_userMaster',' id="'.$MemberId.'" and status=1'); 
$profiledata=mysqli_fetch_array($b); 

 

//------------------------------Get Flight Data--------------------------


$_SESSION['agentUserid']=$MemberId;
$_SESSION['agentUsername']='';
$_SESSION['parentid']=$MemberId;
$_SESSION['parentAgentId']=$MemberId;

 

include "api_inc.php";
include "flight_setting.php";



if($tripType==1){

$wheretotal='  agentId="'.$MemberId.'"  group by FLIGHT_NO,FLIGHT_CODE   order by AMT asc  ';
} else {
$wheretotal='  agentId="'.$MemberId.'"   order by AMT asc  ';
}




if($Api=='dummy'){

$_REQUEST['tripType']=$tripType;
$_REQUEST['fromDestinationFlight']=$SRC;
$_REQUEST['toDestinationFlight']=$DES;
$_REQUEST['journeyDateOne']=$DEP_DATE;
$_REQUEST['journeyDateRound']=$RET_DATE;
$_REQUEST['ADT']=$ADT;
$_REQUEST['CHD']=$CHD;
$_REQUEST['INF']=$INF;
$_REQUEST['PC']=$PC;

$wheretotal='1 order by AMT asc limit 0,50';
 
}


if($Api=='kafila'){

$_REQUEST['tripType']=$tripType;
$_REQUEST['fromDestinationFlight']=$SRC;
$_REQUEST['toDestinationFlight']=$DES;
$_REQUEST['journeyDateOne']=$DEP_DATE;
$_REQUEST['journeyDateRound']=$RET_DATE;
$_REQUEST['ADT']=$ADT;
$_REQUEST['CHD']=$CHD;
$_REQUEST['INF']=$INF;
$_REQUEST['PC']=$PC;


include "API_kafila-one-way.php";
}
 
if($Api=='tbo' && $tripType==1){


$_REQUEST['tripType']=$tripType;
$_REQUEST['fromDestinationFlight']=$SRC;
$_REQUEST['toDestinationFlight']=$DES;
$_REQUEST['journeyDateOne']=$DEP_DATE;
$_REQUEST['journeyDateRound']=$RET_DATE;
$_REQUEST['ADT']=$ADT;
$_REQUEST['CHD']=$CHD;
$_REQUEST['INF']=$INF;
$_REQUEST['PC']=$PC; 

include "API_tbo-one-way.php";
}

if($Api=='tbo' && $tripType==2){

$_REQUEST['tripType']=$tripType;
$_REQUEST['fromDestinationFlight']=$SRC;
$_REQUEST['toDestinationFlight']=$DES;
$_REQUEST['journeyDateOne']=$DEP_DATE;
$_REQUEST['journeyDateRound']=$RET_DATE;
$_REQUEST['ADT']=$ADT;
$_REQUEST['CHD']=$CHD;
$_REQUEST['INF']=$INF;
$_REQUEST['PC']=$PC;


include "API_tbo-round-trip.php";
}

 if($Api=='tj'){
 
  

$_REQUEST['tripType']=$tripType;
$_REQUEST['fromDestinationFlight']=$SRC;
$_REQUEST['toDestinationFlight']=$DES;
$_REQUEST['journeyDateOne']=$DEP_DATE;
$_REQUEST['journeyDateRound']=$RET_DATE;
$_REQUEST['ADT']=$ADT;
$_REQUEST['CHD']=$CHD;
$_REQUEST['INF']=$INF;
$_REQUEST['PC']=$PC;

if($tripType==1){
include "API_tripjack-one-way.php";
} else {
include "tripjack-round-way.php";
}

 
}
 
if($Api=='ak'){

$_REQUEST['tripType']=$tripType;
$_REQUEST['fromDestinationFlight']=$SRC;
$_REQUEST['toDestinationFlight']=$DES;
$_REQUEST['journeyDateOne']=$DEP_DATE;
$_REQUEST['journeyDateRound']=$RET_DATE;
$_REQUEST['ADT']=$ADT;
$_REQUEST['CHD']=$CHD;
$_REQUEST['INF']=$INF;
$_REQUEST['PC']=$PC;


include "fixed-AK-Search-API.php";
}
 
if($Api=='fd'){

$_REQUEST['tripType']=$tripType;
$_REQUEST['fromDestinationFlight']=$SRC;
$_REQUEST['toDestinationFlight']=$DES;
$_REQUEST['journeyDateOne']=$DEP_DATE;
$_REQUEST['journeyDateRound']=$RET_DATE;
$_REQUEST['ADT']=$ADT;
$_REQUEST['CHD']=$CHD;
$_REQUEST['INF']=$INF;
$_REQUEST['PC']=$PC;


include "fixed-FD-Search-API.php";
}
 
//------------------------------Get Flight Data From MYSQL-------------------------- 

$datalist='';
  
$rst=GetPageRecord('*','wig_flight_json_bkp',' '.$wheretotal.' ');
while($res=mysqli_fetch_array($rst)){ 

$str_arr = explode (",", $res['agfare']);  
	$basefares = explode ("=", $str_arr[2]);

$deptime= $res['DEP_DATE'].' '.$res['DEP_TIME'];
$deptime=date('hi',strtotime($deptime));

$arrtime= $res['DEP_DATE'].' '.$res['ARRV_TIME'];
$arrtime=date('hi',strtotime($arrtime));
  
preg_match("/([0-9]+)/", $res['DUR'], $matches);

$D_TIME= $res['DEP_TIME'];
$arrtime= $res['ARRV_TIME'];
$DEP_DATE=$res['DEP_DATE'];
$ARRV_DATE=$res['ARRV_DATE'];

if($res['STOP']==0){ $stops='Non Stop'; } else { $stops=$res['STOP']; }

$fatetypedetails='';



if(getfaretypedetails(stripslashes($res['FLIGHT_NAME']),stripslashes($res['PCC']))!=''){ $fatetypedetails=getfaretypedetails(stripslashes($res['FLIGHT_NAME']),stripslashes($res['PCC'])); }

if(getfaretypedisplayname(stripslashes($res['FLIGHT_NAME']),stripslashes($res['PCC']))!=''){ $faretypeName=getfaretypedisplayname(stripslashes($res['FLIGHT_NAME']),stripslashes($res['PCC'])); } else {
$faretypeName=$res['PCC'];
}

if(getfaretypedisplayname(stripslashes($res['FLIGHT_NAME']),stripslashes($res['PCC']))!=''){ $faretypeNamecolor=getfaretypedisplaycolor(stripslashes($res['FLIGHT_NAME']),stripslashes($res['PCC'])); } else { $faretypeNamecolor='#000'; }

$F_CLASS=$res['F_CLASS'];
 
 
  if($res['refundyes']=='1'){ $refund='Refundable'; } else { $refund='Non Refundable'; }
  
 $str_arr = explode (",", $res['agfare']); $ADFarestr_arr = explode (",", $res['adfare']); 
 $basefare = explode ("=", $str_arr[0]);
 
 $basefare = explode ("=", $str_arr[2]);
	$taxfare = explode ("=", $ADFarestr_arr[1]);
	$basefareadmin = explode ("=", $ADFarestr_arr[2]);
	$taxfare=$taxfare[1]+($basefare[1]-$basefareadmin[1]);
	

if($Api=='dummy'){
$varsrc=explode ("-", $SRC); 
$vardes=explode ("-", $DES); 

$ORG_CODE=$varsrc[0];
$DES_CODE=$vardes[0];
} else {
$ORG_CODE=$res['ORG_CODE'];
$DES_CODE=$res['DES_CODE'];
}

$datalist.='{
		"roundTripFlight": "'.$res['roundTripFlight'].'",
		"flightId": "'.($res['id']).'",
		"flightName": "'.$res['FLIGHT_NAME'].'",
        "flightCode": "'.$res['FLIGHT_CODE'].'",
        "flightNumber": "'.$res['FLIGHT_NO'].'",
        "flightLogo": "'.$imgurl.getflightlogo(stripslashes($res['FLIGHT_NAME'])).'",
        "depTime": "'.$res['DEP_TIME'].'",
        "depDate": "'.$res['DEP_DATE'].'",
        "orgCode": "'.$ORG_CODE.'",
        "orgName": "'.$res['ORG_NAME'].'",
        "arrTime": "'.$res['ARRV_TIME'].'",
        "arrDate": "'.$res['ARRV_DATE'].'",
        "desCode": "'.$DES_CODE.'",
        "desName": "'.$res['DES_NAME'].'",
        "duration": "'.$res['DUR'].'",
        "stop": "'.$stops.'",
        "seats": "'.$res['SEAT'].'",
        "fareType": "'.$faretypeName.'",
        "fareTypeColor": "'.$faretypeNamecolor.'",
        "fareTypeDetail": "'.preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', strip_tags(stripslashes($fatetypedetails))).'",
        "fClass": "'.$F_CLASS.'", 
        "refund": "'.$refund.'",
        "displayFare": "'.$basefares[1].'",
        "netFare": "'.$res['netFareBeforecomm'].'",
        "baseFare": "'.round($basefare[1]-$taxfare).'",
        "taxes": "'.$taxfare.'" 
      },';
}
 
 
 
$co=GetPageRecord('COUNT(id) as totalflights','wig_flight_json_bkp',' roundTripFlight=0 and  agentId="'.$MemberId.'"    order by AMT asc');
$fco=mysqli_fetch_array($co);
 
$co=GetPageRecord('COUNT(id) as totalflightsround','wig_flight_json_bkp',' roundTripFlight=1 and  agentId="'.$MemberId.'"   order by AMT asc');
$fcoround=mysqli_fetch_array($co);

echo '{ 
"tripType":"'.$tripType.'",
"Error":{
"ErrorCode":0,
"ErrorMessage":""
},
"FlightSearchTerms":[
      { 
		"Api": "'.$Api.'",
		"SRC": "'.$_REQUEST['fromDestinationFlight'].'",
		"DES": "'.$_REQUEST['toDestinationFlight'].'",
		"DEP_DATE": "'.$_REQUEST['journeyDateOne'].'",
		"RET_DATE": "'.$_REQUEST['journeyDateRound'].'",
		"ADT": "'.$_REQUEST['ADT'].'",
		"CHD": "'.$_REQUEST['CHD'].'",
		"INF": "'.$_REQUEST['INF'].'",
		"PC": "'.$_REQUEST['PC'].'",
		"FlightsCount": "'.$fco['totalflights'].'",
		"FlightsRoundCount": "'.$fcoround['totalflightsround'].'"
      }
    ],
"FlightList":[
 '.rtrim($datalist,',').'
]
}';


 

 

?>