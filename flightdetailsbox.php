<?php  

if($_REQUEST['preview']==1){

include "inc.php";  

include "config/logincheck.php";

}





if($_REQUEST['tabid']==''){

$_REQUEST['tabid']=1;

}

 

 

$a=GetPageRecord('*','wig_flight_json_bkp',' agentId="'.$_SESSION['agentUserid'].'" and id="'.$_REQUEST['id'].'" ');

$res=mysqli_fetch_array($a);



	$bagg=explode (",", $res['FLIGHT_INFO']);

 $iB=$bagg[1];

 $cB=$bagg[0];


if($_REQUEST['cancelp']==''){ ?>
 
 <style>

 .detailscontent<?php echo $res['id']; ?> { padding: 10px; border: 1px solid #ddd; display: none; }

 .detailsboxtabs<?php echo $res['id']; ?> { width: 100%; border-bottom: 1px solid #ddd; overflow: hidden; padding-left: 0px; }

 .detailsboxtabs<?php echo $res['id']; ?> a { padding: 5px 10px; margin-right: 5px; float: left; color: #000; padding: 10px 20px; border-radius: 12px !important; border-bottom-left-radius: 0px !important; border-bottom-right-radius: 0px !important; font-weight: 600; }

 .detailsboxtabs<?php echo $res['id']; ?> .active { background-color: var(--blue); color: #fff; }

 </style>

<div class="detailsboxtabs<?php echo $res['id']; ?>" style="position:relative;">

<a <?php if($_REQUEST['tabid']==1){ ?> class="active"<?php } ?> id="fltb1<?php echo $res['id']; ?>"  onClick="flightdetailstab<?php echo $res['id']; ?>('1<?php echo $res['id']; ?>');">Flight Details</a>

<?php if($_REQUEST['preview']!=1){ ?><a <?php if($_REQUEST['']==2){ ?> class="active"<?php } ?> id="fltb2<?php echo $res['id']; ?>" onClick="flightdetailstab<?php echo $res['id']; ?>('2<?php echo $res['id']; ?>');" style="display:none;">Fare Details</a><?php } ?>

<a <?php if($_REQUEST['']==3){ ?> class="active"<?php } ?> id="fltb3<?php echo $res['id']; ?>" onClick="flightdetailstab<?php echo $res['id']; ?>('3<?php echo $res['id']; ?>');">Baggage Info</a>

<a  <?php if($_REQUEST['']==4){ ?> class="active"<?php } ?> id="fltb4<?php echo $res['id']; ?>" onClick="flightdetailstab<?php echo $res['id']; ?>('4<?php echo $res['id']; ?>');">Fare Rules</a>





</div>

 

<div class="detailscontent<?php echo $res['id']; ?>" id="tabid1<?php echo $res['id']; ?>">

<div class="row">

<div class="col-12">
 

	  

<?php
$j=0; 

 
if($res['apiType']=='kafila'){
  
foreach(unserialize(stripslashes($res['CON_DETAILS'])) as $layoverFlight){


if($layoverFlight->FLIGHT_NAME!=''){

$yesdata=1;
?>
<div class="row multiflightbox">
<div class="col-3">
 <table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"><img src="<?php echo $imgurl.getflightlogo(stripslashes($res['FLIGHT_NAME'])); ?>" width="32" height="32"></td>
    <td>
	<div class="flightname"><?php echo $layoverFlight->FLIGHT_NAME; ?> </div>
	<div class="flightnumber"><?php echo $layoverFlight->FLIGHT_CODE; ?> <?php echo $layoverFlight->FLIGHT_NO; ?></div>
	
	</td>
  </tr>
</table>

</div>

<div class="col-9">
 <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="33%" align="center">
	<div class="coltime">
	<?php echo $layoverFlight->DEP_TIME; ?></div>
	<div class="coltime" style="font-size:11px;"><?php echo date('d-m-Y',strtotime($layoverFlight->DEP_DATE)); ?></div>
	<div class="graysmalltext">

	<?php

	$rs=GetPageRecord('*','flightDestinationMaster',' airportCode="'.$layoverFlight->ORG_CODE.'"');

$rscodearr=mysqli_fetch_array($rs); ?>

(<?php echo strip($layoverFlight->ORG_CODE); ?>) <?php echo strip($rscodearr['city']); ?><br /><?php echo strip($rscodearr['airportDescription']); ?></div>
	 
	</td>
    <td width="33%" align="center"><div class="nostops"><?php echo $layoverFlight->DURATION; ?></div><div style="margin-top:2px;">
	<span class="green"><?php if($res['refundyes']=='1'){ echo '<span class="refundablespan">Refundable</span>'; } else { echo '<span class="nonrefundablespan">Non Refundable</span>'; } ?></span>
	</div> </td>
    <td width="33%" align="center"><div class="coltime">
	<?php echo $layoverFlight->ARRV_TIME; ?></div>
	<div class="coltime" style="font-size:11px;"><?php echo date('d-m-Y',strtotime($layoverFlight->ARRV_DATE)); ?></div>
	 
	<div class="graysmalltext">

	<?php

	$rs=GetPageRecord('*','flightDestinationMaster',' airportCode="'.$layoverFlight->DES_CODE.'"');

$rscodearr=mysqli_fetch_array($rs); ?>

(<?php echo strip($layoverFlight->DES_CODE); ?>) <?php echo strip($rscodearr['city']); ?><br /><?php echo strip($rscodearr['airportDescription']); ?></div>
	
	</td>
  </tr>
</table>

</div>

<?php if($layoverFlight->LAYOVER_INFO!=''){ ?>
  <div style="text-align: center; color: #0b0b0b; padding: 5px; background-color: #e4f8ff; font-weight: 600; border-radius: 24px; margin-top:20px;"><?php echo $layoverFlight->LAYOVER_INFO; ?></div>
<?php } ?>
</div>

	  <?php  $j++; } } ?>
	  
	  
	  
	  <?php
	  if($yesdata!=1){  
	  
 

$yesdata=1;
?>
<div class="row multiflightbox">
<div class="col-3">
 <table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"><img src="<?php echo $imgurl.getflightlogo(stripslashes($res['FLIGHT_NAME'])); ?>" width="32" height="32"></td>
    <td>
	<div class="flightname"><?php echo stripslashes($res['FLIGHT_NAME']); ?> </div>
	<div class="flightnumber"><?php echo stripslashes($res['FLIGHT_CODE']); ?>-<?php echo stripslashes($res['FLIGHT_NO']); ?></div>
	
	</td>
  </tr>
</table>

</div>

<div class="col-9">
 <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="33%" align="center">
	<div class="coltime">
	<?php echo stripslashes($res['DEP_TIME']); ?></div>
	<div class="coltime" style="font-size:11px;"><?php echo date('d-m-Y',strtotime($res['DEP_DATE'])); ?></div>
	<div class="graysmalltext">
 
<div class="graysmalltext">

	<?php

	$rs=GetPageRecord('*','flightDestinationMaster',' airportCode="'.$res['ORG_CODE'].'"');

$rscodearr=mysqli_fetch_array($rs); ?>

(<?php echo strip($res['ORG_CODE']); ?>) <?php echo strip($rscodearr['city']); ?><br /><?php echo strip($rscodearr['airportDescription']); ?></div>
</div>
	</td>
    <td width="33%" align="center"><div class="nostops"><?php echo $res['DUR']; ?></div> <div style="margin-top:2px;">
	<span class="green"><?php if($res['refundyes']=='1'){ echo '<span class="refundablespan">Refundable</span>'; } else { echo '<span class="nonrefundablespan">Non Refundable</span>'; } ?></span>
	</div></td>
    <td width="33%" align="center"><div class="coltime">
	<?php echo stripslashes($res['ARRV_TIME']); ?></div>
		<div class="coltime" style="font-size:11px;"><?php echo date('d-m-Y',strtotime($res['ARRV_DATE'])); ?></div>
	<div class="graysmalltext">

	<?php

	$rs=GetPageRecord('*','flightDestinationMaster',' airportCode="'.$res['ORG_CODE'].'"');

$rscodearr=mysqli_fetch_array($rs); ?>

(<?php echo strip($res['ORG_CODE']); ?>) <?php echo strip($rscodearr['city']); ?><br /><?php echo strip($rscodearr['airportDescription']); ?></div></td>
  </tr>
</table>

</div>

 
</div>

	  <?php }  $j++;  
	  
 
	  
	  
	  }

 $arr = unserialize(stripslashes($res['PARAM_DATA']));
 
 //echo '<pre>';
  //print_r($arr);


 



   if($res['apiType']=='tbo'){ 
   
   	$d=1;
		
		$segmentsDataArr=(array) unserialize(stripslashes($res['PARAM_DATA']));
		// echo '<pre>';
		//  print_r($segmentsDataArr);
		
		$numberOfStop=count($segmentsDataArr['Segments'][0]);
		if(count($numberOfStop)>0)
		{
		
			foreach($segmentsDataArr['Segments'][0] as $segmentsDataArrValue)
			{
			
			
		?>
		
		<div class="row multiflightbox">
 <?php if($d>1){?>
  <div style="text-align: center; color: #0b0b0b; padding: 5px; background-color: #e4f8ff; font-weight: 600; border-radius: 24px; margin-top:20px;"><?php 
  
  $lastdep=date('Y-m-d H:i:s',strtotime($segmentsDataArrValue['Origin']['DepTime']));
  
  $datetime1 = new DateTime($lastdep);
$datetime2 = new DateTime($lastarr);
$interval = $datetime1->diff($datetime2);
$elapsed = $interval->format(' %h:%i hours');
echo 'Layover time: '.$elapsed;
  
  ?></div>
 <?php } ?>
		
<div class="col-3">
 <table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"><img src="<?php echo $imgurl.getflightlogo(stripslashes( $segmentsDataArrValue['Airline']['AirlineName'])); ?>" width="32" height="32"></td>
    <td>
	<div class="flightname"><?php echo $segmentsDataArrValue['Airline']['AirlineName']; ?> </div>
	<div class="flightnumber"><?php echo $segmentsDataArrValue['Airline']['AirlineCode']; ?> <?php echo $segmentsDataArrValue['Airline']['FlightNumber']; ?></div>
	
	</td>
  </tr>
</table>

</div>

<div class="col-9">
 <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="33%" align="center">
	<div class="coltime">
	<?php echo date('H:i A',strtotime($segmentsDataArrValue['Origin']['DepTime'])); ?></div>
	<div class="coltime" style="font-size:11px;"><?php echo date('d-m-Y',strtotime($segmentsDataArrValue['Origin']['DepTime']));  ?></div>
	<div class="graysmalltext"> 
	
	<?php

	$rs=GetPageRecord('*','flightDestinationMaster',' airportCode="'.$segmentsDataArrValue['Origin']['Airport']['CityCode'].'"'); 
$rscodearr=mysqli_fetch_array($rs); ?>
	
	(<?php echo $segmentsDataArrValue['Origin']['Airport']['CityCode']; ?>) <?php echo strip($rscodearr['city']); ?><br /><?php echo strip($segmentsDataArrValue['Origin']['Airport']['AirportName']); ?><?php if($segmentsDataArrValue['Origin']['Airport']['Terminal']!=''){ ?> 
	<div style="color:#009900;">Terminal: <?php echo $segmentsDataArrValue['Origin']['Airport']['Terminal']; ?></div><?php } ?></div>
	</td>
    <td width="33%" align="center">	<div class="nostops" style="font-size:15px; font-weight:800;"><?php echo sprintf("%d:%02d",   floor($segmentsDataArrValue['Duration']/60), $segmentsDataArrValue['Duration']%60);  ?></div> <div style="margin-top:2px;">
	 
	</div></td>
    <td width="33%" align="center"><div class="coltime">
	<?php echo date('H:i A',strtotime($segmentsDataArrValue['Destination']['ArrTime'])); ?></div>
		<div class="coltime" style="font-size:11px;"><?php echo date('d-m-Y',strtotime($segmentsDataArrValue['Destination']['ArrTime'])); $lastarr=date('Y-m-d H:i:s',strtotime($segmentsDataArrValue['Destination']['ArrTime'])); ?></div>
	<div class="graysmalltext">
	<?php

	$rs=GetPageRecord('*','flightDestinationMaster',' airportCode="'.$segmentsDataArrValue['Destination']['Airport']['CityCode'].'"'); 
$rscodearr=mysqli_fetch_array($rs); ?>
	
	(<?php echo $segmentsDataArrValue['Destination']['Airport']['CityCode']; ?>) <?php echo strip($rscodearr['city']); ?><br /><?php echo strip($segmentsDataArrValue['Destination']['Airport']['AirportName']); ?> 
	
	<?php if($segmentsDataArrValue['Destination']['Airport']['Terminal']!=''){ ?> 
	<div style="color:#009900;">Terminal: <?php echo $segmentsDataArrValue['Destination']['Airport']['Terminal']; ?></div><?php } ?></div></td>
  </tr>
</table>

</div>

 
</div>
			
		<?php
		
		$j++; 	$d++; }
		}
		
		
		$ss=1;
		$numberOfStop=count($segmentsDataArr['Segments'][1]);
		if(count($numberOfStop)>0)
		{ 
		$Rhh=1;
			foreach($segmentsDataArr['Segments'][1] as $segmentsDataArrValue)
			{
			if($Rhh==1){
			?>
		
	<div style="padding: 5px 10px; background-color: #f1f1f1; font-weight: 700; margin-bottom: 10px; margin-top:10px;">Return Flight</div>
		<?php
		
		}
		?>
		
		<div class="row multiflightbox">
 <?php if($ss>1){?>
  <div style="text-align: center; color: #0b0b0b; padding: 5px; background-color: #e4f8ff; font-weight: 600; border-radius: 24px; margin-top:20px;"><?php 
  
  $lastdep=date('Y-m-d H:i:s',strtotime($segmentsDataArrValue['Origin']['DepTime']));
  
  $datetime1 = new DateTime($lastdep);
$datetime2 = new DateTime($lastarr);
$interval = $datetime1->diff($datetime2);
$elapsed = $interval->format(' %h:%i hours');
echo 'Layover time: '.$elapsed;
  
  ?></div>
 <?php } ?>
		
<div class="col-3">
 <table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"><img src="<?php echo $imgurl.getflightlogo(stripslashes( $segmentsDataArrValue['Airline']['AirlineName'])); ?>" width="32" height="32"></td>
    <td>
	<div class="flightname"><?php echo $segmentsDataArrValue['Airline']['AirlineName']; ?> </div>
	<div class="flightnumber"><?php echo $segmentsDataArrValue['Airline']['AirlineCode']; ?> <?php echo $segmentsDataArrValue['Airline']['FlightNumber']; ?></div>
	
	</td>
  </tr>
</table>

</div>

<div class="col-9">
 <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="33%" align="center">
	<div class="coltime">
	<?php echo date('H:i A',strtotime($segmentsDataArrValue['Origin']['DepTime'])); ?></div>
	<div class="coltime" style="font-size:11px;"><?php echo date('d-m-Y',strtotime($segmentsDataArrValue['Origin']['DepTime']));  ?></div>
	<div class="graysmalltext"> 
	
	<?php

	$rs=GetPageRecord('*','flightDestinationMaster',' airportCode="'.$segmentsDataArrValue['Origin']['Airport']['CityCode'].'"'); 
$rscodearr=mysqli_fetch_array($rs); ?>
	
	(<?php echo $segmentsDataArrValue['Origin']['Airport']['CityCode']; ?>) <?php echo strip($rscodearr['city']); ?><br /><?php echo strip($segmentsDataArrValue['Origin']['Airport']['AirportName']); ?><?php if($segmentsDataArrValue['Origin']['Airport']['Terminal']!=''){ ?> 
	<div style="color:#009900;">Terminal: <?php echo $segmentsDataArrValue['Origin']['Airport']['Terminal']; ?></div><?php } ?>
	</div>
	</td>
    <td width="33%" align="center">
	
	<div class="nostops" style="font-size:15px; font-weight:800;"><?php echo sprintf("%d:%02d",   floor($segmentsDataArrValue['Duration']/60), $segmentsDataArrValue['Duration']%60);  ?></div> <div style="margin-top:2px;">
	 
	</div></td>
    <td width="33%" align="center"><div class="coltime">
	<?php echo date('H:i A',strtotime($segmentsDataArrValue['Destination']['ArrTime'])); ?></div>
		<div class="coltime" style="font-size:11px;"><?php echo date('d-m-Y',strtotime($segmentsDataArrValue['Destination']['ArrTime'])); $lastarr=date('Y-m-d H:i:s',strtotime($segmentsDataArrValue['Destination']['ArrTime'])); ?></div>
	<div class="graysmalltext">
	<?php

	$rs=GetPageRecord('*','flightDestinationMaster',' airportCode="'.$segmentsDataArrValue['Destination']['Airport']['CityCode'].'"'); 
$rscodearr=mysqli_fetch_array($rs); ?>
	
	(<?php echo $segmentsDataArrValue['Destination']['Airport']['CityCode']; ?>) <?php echo strip($rscodearr['city']); ?><br /><?php echo strip($segmentsDataArrValue['Destination']['Airport']['AirportName']); ?><?php if($segmentsDataArrValue['Destination']['Airport']['Terminal']!=''){ ?> 
	<div style="color:#009900;">Terminal: <?php echo $segmentsDataArrValue['Destination']['Airport']['Terminal']; ?></div><?php } ?></div></td>
  </tr>
</table>

</div>

 
</div>
			
		<?php
		
		$j++; 	$d++; $ss++; $Rhh++; }
		}
		
		
		//echo "<pre>";
		//print_r($segmentsDataArr);
		//die;
		
	  
	  		//foreach( as $layoverFlight){
			
			
			
			//}
	  
 
	  
	  
	  }
	  
	  


 ?>



 

</div>

</div>



</div> 



 

<div class="detailscontent<?php echo $res['id']; ?>"  id="tabid3<?php echo $res['id']; ?>">

<div class="row">

<div class="col-12">

 

 <table width="100%" border="0" cellpadding="0" cellspacing="0" class="baggageclass">

  <tr>

    <td width="33%" align="left" bgcolor="#f5f5f5"><strong>Airline</strong></td>

    <td width="33%" align="left" bgcolor="#f5f5f5"><strong>Check-in Baggage</strong></td>

    <td width="33%" align="left" bgcolor="#f5f5f5"><strong>Cabin Baggage</strong></td>

  </tr>

  <tr>

    <td width="33%" align="left"><table border="0" cellpadding="0" cellspacing="0">

  <tr>

    <td colspan="2"><img src="<?php echo $imgurl.getflightlogo(stripslashes($res['FLIGHT_NAME'])); ?>"  height="32"></td>

    <td>

	<div class="flightname"><?php echo stripslashes($res['FLIGHT_NAME']); ?></div>

	<div class="flightnumber"><?php echo stripslashes($res['FLIGHT_CODE']); ?>-<?php echo stripslashes($res['FLIGHT_NO']); ?></div>

	

	</td>

  </tr>

</table></td>

    <td width="33%" align="left"><?php 		$segmentsDataArr=(array) unserialize(stripslashes($res['PARAM_DATA'])); echo $segmentsDataArr['Segments'][0][0]['Baggage']; ?></td>

    <td width="33%" align="left"><?php echo $segmentsDataArr['Segments'][0][0]['CabinBaggage']; ?></td>

  </tr>

  <tr>

    <td colspan="3" align="left"><div  style="padding:10px; background-color:#F5F5F5;">

					 Baggage information mentioned above is obtained from airline's reservation system, <?php echo stripslashes($getcompanybasicinfo['companyName']); ?> does not guarantee the accuracy of this information.<br />

 The baggage allowance may vary according to stop-overs, connecting flights. changes in airline rules. etc. 

		  </div></td>

    </tr>

</table>



 

 

</div>

</div>



</div> 





 

<div class="detailscontent<?php echo $res['id']; ?>"  id="tabid2<?php echo $res['id']; ?>">

<div class="row">

<div class="col-6">

<div style="margin-bottom:10px; font-size:16px;"><strong>Fare Breakup</strong></div>

<table width="100%" border="0" cellpadding="0" cellspacing="0" class="baggageclass">

  

  <tr>

    <td width="33%" align="left">Base Fare</td>

    <td width="33%" align="left">&#8377;<?php $str_arr = explode (",", $res['agfare']);  

	$basefare = explode ("=", $str_arr[0]);

	echo $basefare[1];

	  ?></td>
  </tr>

  <tr>

    <td align="left">Surcharges & Taxes</td>

    <td align="left">&#8377;<?php 

	$basefare = explode ("=", $str_arr[1]);

	echo $basefare[1];

	  ?></td>
  </tr>

  <tr>

    <td align="left" bgcolor="#F7F7F7"><strong>Total Fare</strong></td>

    <td align="left" bgcolor="#F7F7F7"><strong>&#8377;<?php 

	$basefare = explode ("=", $str_arr[2]);

	echo $basefare[1];

	  ?></strong></td>
  </tr>
  <tr>
    <td align="left">Commission (-)</td>
    <td align="left">&#8377;<?php echo $res['acom']; ?></td>
  </tr>
  <tr>
    <td align="left">GST</td>
    <td align="left">&#8377;<?php echo $totalgst=round($res['acom']*18/100); ?></td>
  </tr>
  <tr>
    <td align="left">TDS</td>
    <td align="left">&#8377;<?php echo $totaltds=round($res['acom']*5/100); ?></td>
  </tr>
  <tr>
    <td align="left" bgcolor="#FFF9EA"><strong>Net Price</strong></td>
    <td align="left" bgcolor="#FFF9EA"><strong>&#8377;<?php 
	$basefare = explode ("=", $str_arr[2]);
	echo (($basefare[1]+$totalcommissiongstdisplay+$totalgst+$totaltds)-$res['acom']);
	?></strong></td>
  </tr>
</table>

</div>

</div>

</div> 





 

<div class="detailscontent<?php echo $res['id']; ?>"  id="tabid4<?php echo $res['id']; ?>">

 

 <?php

 

 


if($res['apiType']=='tbo'){ 



$ResultIndex=$res['ResultIndex'];

include 'FLYTBOAPI/FareRulesOB.php'; 

$_SESSION['ob-farerule-result']= $fare_rule_result;



$frule_res= $fare_rule_result;; 

$fare_Origin= $frule_res['Response']['FareRules']['0']['Origin'];

$fare_Destination= $frule_res['Response']['FareRules']['0']['Destination'];

$FareRuleDetail= $frule_res['Response']['FareRules']['0']['FareRuleDetail'];

?>
<style>
#fareruledetails table{border:1px solid #ddd !important; width:100% !important;}
#fareruledetails table tr td{border:1px solid #ddd !important; background-color:#FFFFFF; padding:10px !important; font-size:12px !important;}
#fareruledetails table th{padding:10px; background-color:#F4F4F4 !important;}
</style>
 <div class="fareruledivbox"> 

 

 <div id="fareruledetails" style="color:#000000;">
 <?php
 $segmentsDataArr=(array) unserialize(stripslashes($res['PARAM_DATA'])); 
 if($segmentsDataArr['AirlineRemark']!=''){
 ?>
 <div style="margin-bottom:10px; color:#CC3300; color:#CC3300; font-size:13px;"><strong>Airline Remark: <?php echo $segmentsDataArr['AirlineRemark']; ?></strong></div>
 
 <?php } ?>
 <?php echo str_replace('-------------------------------------------------','<br>',$FareRuleDetail); ?></div>

 </div>

 

<?php

}



 } else { 

?>


<?php
 



$ResultIndex=$res['ResultIndex'];

include 'FLYTBOAPI/FareRulesOB.php'; 

$_SESSION['ob-farerule-result']= $fare_rule_result;



$frule_res= $fare_rule_result;; 

$fare_Origin= $frule_res['Response']['FareRules']['0']['Origin'];

$fare_Destination= $frule_res['Response']['FareRules']['0']['Destination'];

$FareRuleDetail= $frule_res['Response']['FareRules']['0']['FareRuleDetail'];

?>
<style>
#fareruledetails table{border:1px solid #ddd !important; width:100% !important;}
#fareruledetails table tr td{border:1px solid #ddd !important; background-color:#FFFFFF; padding:10px !important; font-size:12px !important;}
#fareruledetails table th{padding:10px; background-color:#F4F4F4 !important;}
</style>
 <div class="fareruledivbox"> 

 

 <div id="fareruledetails" style="color:#000000;">
 <?php
 $segmentsDataArr=(array) unserialize(stripslashes($res['PARAM_DATA'])); 
 if($segmentsDataArr['AirlineRemark']!=''){
 ?>
 <div style="margin-bottom:10px; color:#CC3300; color:#CC3300; font-size:13px;"><strong>Airline Remark: <?php echo $segmentsDataArr['AirlineRemark']; ?></strong></div>
 
 <?php } ?>
 <?php echo str_replace('-------------------------------------------------','<br>',$FareRuleDetail); ?></div>

 </div>

 

<?php

?>





<?php } ?>




</div>

 

 

 

 <script>

 function flightdetailstab<?php echo $res['id']; ?>(id){

 $('.detailsboxtabs<?php echo $res['id']; ?> a').removeClass('active');

 $('.detailscontent<?php echo $res['id']; ?>').hide();

 $('#tabid'+id).show(); 

 $('#fltb'+id).addClass('active');

 }

 flightdetailstab<?php echo $res['id']; ?>(1<?php echo $res['id']; ?>);

 </script>

 