<?php
include "inc.php"; 
include "config/logincheck.php"; 
 
ini_set('display_errors', '1');



/************** Search *******************/
$searchResultGFValue='';

$newSessionId = trim($_SESSION['uniqueId']);
$tripType = trim($_REQUEST['tripType']);
$fromDestinationFlight = trim($_REQUEST['fromDestinationFlight']);
$toDestinationFlight = trim($_REQUEST['toDestinationFlight']);
$journeyDateOne = trim($_REQUEST['journeyDateOne']);
$journeyDateRound = trim($_GET['journeyDateRound']);

$ADT = trim($_REQUEST['ADT']);
$CHD = trim($_REQUEST['CHD']);
$INF = trim($_REQUEST['INF']);
$PC = trim($_REQUEST['PC']);
$toalPaxFinal=$ADT+$CHD+$INF;
$toalPax=$ADT+$CHD;

$_SESSION['ADT']=$ADT;
$_SESSION['CHD']=$CHD;
$_SESSION['INF']=$INF;

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
  

 

$rsMF=GetPageRecord('*','pnr_details',' 1 and   travel_date="'.$journeyDate.'" and flight_id in (select id from fixdeparture_flight where fromCode="'.$fromdestexp[0].'" and  toCode="'.$todestexp[0].'" and is_approve=1)  order by id asc'); 

while($searchResultGFValue=mysqli_fetch_array($rsMF)){ 

$airlineidsold=GetPageRecord('count(id) as totalsold','flightBookingMaster','status=2 and fdFlightId="'.$searchResultGFValue["id"].'"'); 
$finalsold=mysqli_fetch_array($airlineidsold);

$airlineidcancel=GetPageRecord('count(id) as totalcancel','flightBookingMaster','status=3 and fdFlightId="'.$searchResultGFValue["id"].'"'); 
$finalcancel=mysqli_fetch_array($airlineidcancel);


$remainingseats=round($searchResultGFValue['qty']-($finalsold['totalsold']+$finalcancel['totalcancel'])-$searchResultGFValue['block']);

 if($remainingseats>=$toalPaxFinal){ 
 
 
 
 $re=GetPageRecord('*','fixdeparture_flight',' id="'.$searchResultGFValue['flight_id'].'"'); 
$flightdata=mysqli_fetch_array($re);

 $fn=GetPageRecord('*','sys_flightName',' id="'.$flightdata['airline_id'].'"'); 
$flightName=mysqli_fetch_array($fn);

	   
	    $D_TIME= $flightdata['departure_time'];
		$A_TIME= $flightdata['arrival_time'];


		$msdate1= $A_TIME;
		$msdate1= explode('T',$msdate1); 
		$msdateaxp1= $msdate1['0'].' '.$msdate1['1']; 
		$msdate2= $D_TIME;
		$msdate2= explode('T',$msdate2); 
		$msdateaxp2= $msdate2['0'].' '.$msdate2['1']; 
		$seconds = strtotime($msdateaxp1) - strtotime($msdateaxp2);
		$hours   = floor($seconds / 3600); 
		$minutes = floor(($seconds - ($hours * 3600))/60); 
		$dur= $hours.'H '.$minutes.'M';		
		
		
		$FIXEDID= $searchResultGFValue['id'];
		$ORG_CODE= $flightdata['fromCode'];
		$ORG_NAME= $flightdata['fromDestination'];
		
		$DES_CODE= $flightdata['toCode'];
		$DES_NAME= $flightdata['toDestination'];
		$DEP_DATE= $journeyDate;
		$DEP_TIME= $flightdata['departure_time'];
		
		$ARRV_DATE= $journeyDate;
		$ARRV_TIME= $flightdata['arrival_time'];
		$FLIGHT_CODE= '';
		$FLIGHT_NAME= $flightName['name'];
		
		$flightNoArr='';
		$flightNoGF='';
		
		$FLIGHT_NO= $flightdata['flight_no'];
		$FLIGHT_LOGO = '';
		$FARE_TYPE='FXD';
		
		$SEAT=$remainingseats;
		$STOP=0;
		
		$infcost=0;
		if($INF>0){
		$infcost=round($INF*1750);
		}
		
		
		$AMT=round($searchResultGFValue['fare']*$toalPax)+$infcost;
		
		
		$S_CODE=$flightdata['fromCode']."-".$flightdata['toCode'];
		$CN_CODE=$flightdata['flight_no'];
		$FLIGHT_INFO='7 Kg,15 Kg';
		$NET_FARE=$AMT;
		
		$flightType='D';
		$totalPaxFare=$NET_FARE;
		
		$totalTax=0;
		
	$getCalCost=calculateflightcost(encode($agentid),$FLIGHT_NAME,$flightType,$FARE_TYPE,$toalPax,$totalPaxFare,$totalTax);
            $getCalCost2=calculateflightcostForAgent(encode($agentid),$FLIGHT_NAME,$flightType,$FARE_TYPE,$toalPax,$totalPaxFare,$totalTax);
           
		   	$getAgentTaxonly=calculateflightcostForAgentMarkup(encode($agentid),$FLIGHT_NAME,$flightType,$FARE_TYPE,$toalPax,$totalPaxFare,$totalTax);
           
           $getNetFare=calculateflightcostForAgentNetFare(encode($agentid),$FLIGHT_NAME,$flightType,$FARE_TYPE,$toalPax,$NET_FARE,$totalTax);
           $netamount = $getNetFare[0];
     

            
             $adfare='baseFare='.$totalPaxFare.',tax='.$totalTax.',totalFare='.($totalPaxFare+$totalTax);
             $agfare='baseFare='.$getCalCost2[2].',tax='.$getCalCost2[0].',totalFare='.$getCalCost2[1];
             $clfare='baseFare='.$getCalCost[2].',tax='.$getCalCost[0].',totalFare='.$getCalCost[1];
              
 
 
  $adminMarkup=($getCalCost2[1]-$getCalCost[1]);
			  $totaldisplayTax=($getCalCost2[0]+$adminMarkup)-($getAgentTaxonly[0]);
         //echo round($flightList->NET_FARE+$getCalCost['3']).'-'.$getCalCost2[1].'-'.$getCalCost['3'].'-'.$flightList->NET_FARE.'+++++++++++++';
         $nefareamountnew=round($NET_FARE+$getCalCost['3']);		
		
$agentFixedMakup=round(agentfixmarkup(encode($agentid),trim(str_replace(' ','',$FLIGHT_NAME)),$flightType,$FARE_TYPE,$toalPax,$getCalCost2[1],$totalTax));
		
		
 $namevalue ='
 UID="",TID=""
 ,ResultIndex=""
 ,FIXEDID="'.$FIXEDID.'"
 ,ORG_CODE="'.$ORG_CODE.'"
 ,apiType="FD"
 ,ORG_NAME="'.$ORG_NAME.'"
 ,DES_CODE="'.$DES_CODE.'"
 ,DES_NAME="'.$DES_NAME.'"
 ,DEP_DATE="'.$DEP_DATE.'"
 ,DEP_TIME="'.$DEP_TIME.'"
 ,ARRV_DATE="'.$ARRV_DATE.'"
 ,ARRV_TIME="'.$ARRV_TIME.'"
 ,FLIGHT_CODE="'.trim($FLIGHT_CODE).'"
 ,FLIGHT_NAME="'.$FLIGHT_NAME.'"
 ,FLIGHT_NO="'.trim($FLIGHT_NO).'"
 ,FARE_TYPE="'.$FARE_TYPE.'"
 ,SEAT="'.$SEAT.'"
 ,STOP="'.$STOP.'"
 ,AMT="'.$getCalCost2[1].'"
 ,DISPLAY_AMT="'.$AMT.'"
 ,DUR="'.$dur.'"
 ,S_CODE="'.$S_CODE.'"
 ,CN_CODE="'.$CN_CODE.'"
 ,OI=""
 ,PCC="'.$FARE_TYPE.'"
 ,TAX_BREAKUP="0"
 ,FLIGHT_INFO="'.$FLIGHT_INFO.'"
 ,NET_FARE="'.$getCalCost2[1].'"
 ,refundyes=""
 ,AirlineRemark=""
 ,F_CLASS=""
 ,SECTOR="'.$flightType.'"
 ,fdFlightId="'.$searchResultGFValue['id'].'"
 ,agentFixedMakup="'.$agentFixedMakup.'"
 ,CON_DETAILS=""
 ,PARAM_DATA="",agentId="'.$_SESSION['agentUserid'].'"
 ,uniqueSessionId="'.$_SESSION['uniqueSessionId'].'"
 ,searchJson=""
 ,tripType=1
 ,acom="'.round($getCalCost2[1]-$netamount).'"
 ,netFareBeforecomm="'.$getCalCost2[1].'"
 ,adfare="'.$adfare.'",agfare="'.$agfare.'",clfare="'.$clfare.'",agentMarkup="'.$getAgentTaxonly[0].'",adminMarkup="'.$adminMarkup.'",totalTax="'.$totaldisplayTax.'"';
 
 
 
 
addlistinggetlastid('wig_flight_json_bkp',$namevalue); 		
		
		
		
	}  } 
	

 ?>