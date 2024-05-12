<?php 
include "inc.php"; 
include "config/logincheck.php"; 
$page='hotels';
$agentid=$_SESSION['agentUserid']; 
 $_SESSION['hotelTraceId']=$_REQUEST['hotelTraceId'];
if($_REQUEST['ResultIndex']!="")
{


 $body2 = '{
 "ResultIndex": '.($_REQUEST['ResultIndex']).',
  "HotelCode": "'.($_REQUEST['HotelCode']).'",
  "EndUserIp": "'.$_SERVER['SERVER_ADDR'].'",
  "TokenId": "'.$_SESSION['hotelTokenId'].'",
  "TraceId": "'.$_SESSION['hotelTraceId'].'"
}';


//echo "<br>";

$ch2 = curl_init();
$url2 = 'https://api.travelboutiqueonline.com/HotelAPI_V10/HotelService.svc/rest/GetHotelInfo/';

$headers2 = array(
'Content-Type: application/json',
'Content-Length: '.strlen($body2),    
'Accept: application/json'
);

 curl_setopt($ch2 , CURLOPT_URL, $url2);
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch2, CURLOPT_POSTFIELDS, $body2);
curl_setopt($ch2, CURLOPT_HTTPHEADER, $headers2);

$information2 = curl_getinfo($ch2);
$result2 = curl_exec($ch2);
$hotelInfoArr = json_decode($result2,true); 	
//echo "<pre>";
//print_r($hotelInfoArr);

$hotelResultInfo=$hotelInfoArr['HotelInfoResult']['HotelDetails'];
$_SESSION['hotelResultInfo']=$hotelResultInfo;
 


//-------------Room Data-----------------


$body3 = '{
 "ResultIndex": '.($_REQUEST['ResultIndex']).',
  "HotelCode": "'.($_REQUEST['HotelCode']).'",
  "EndUserIp": "'.$_SERVER['SERVER_ADDR'].'",
  "TokenId": "'.$_SESSION['hotelTokenId'].'",
  "TraceId": "'.$_SESSION['hotelTraceId'].'"
}';

$ch3 = curl_init();
$url3 = 'https://api.travelboutiqueonline.com/HotelAPI_V10/HotelService.svc/rest/GetHotelRoom/';

 
$headers3 = array(
'Content-Type: application/json',
'Content-Length: '.strlen($body3),    
'Accept: application/json'
);

 curl_setopt($ch3 , CURLOPT_URL, $url3);
curl_setopt($ch3, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch3, CURLOPT_POSTFIELDS, $body3);
curl_setopt($ch3, CURLOPT_HTTPHEADER, $headers3);

$information3 = curl_getinfo($ch3);
 $result3 = curl_exec($ch3);
$roomDataArr = json_decode($result3,true); 

//echo "<br><br>";



$_SESSION['roomData']=$roomDataArr['GetHotelRoomResult']['HotelRoomsDetails'];

}


//die;

$a=GetPageRecord('*','hotelMaster',' id="'.decode($_REQUEST['hotelSearchId']).'"'); 
$rest=mysqli_fetch_array($a);


$numberOfNights=$_REQUEST['nights'];
$adultCount=$_REQUEST['ad'];
$childCount=$_REQUEST['cd'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
   <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo stripslashes($hotelResultInfo['HotelName']); ?> - Hotel - <?php echo stripslashes($getcompanybasicinfo['companyName']); ?></title>
 
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" integrity="sha512-+EoPw+Fiwh6eSeRK7zwIKG2MA8i3rV/DGa3tdttQGgWyatG/SkncT53KHQaS5Jh9MNOT3dmFL0FjTY08And/Cw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<?php include "headerinc.php"; ?> 

<style>
   #bodyaria{padding:68px 0px 0px 0px;}
   .webcontenor{ max-width:1200px; margin:auto;}
   .roomdetails{color:#4a4a4a; font-weight:400; font-size:14px;} 
   .attractions ul { list-style: none; margin: 0px; font-size: 14px; color: #000000; font-weight: 500; padding: 15px; background-color: #FFFFCC; border: 2px solid #FFCC66; margin-right: 20px; border-radius: 10px; margin-bottom:20px; }
   h6{font-weight:400 !important; font-size:24px !important;}
   h6 span{font-weight:800 !important;}
   .roomone .col-lg-2, .col-lg-4 { padding-right: 10px !important; }
.abtPptDtlsTags__item { align-items: center; background-color: #edf6ff; border: 1px solid #c8e6ff; border-radius: 4px; cursor: pointer; margin-right: 7px; text-align: center; display: inline-block; padding: 6px 10px; font-weight: 500; margin-bottom: 10px; }
.secondrttable{background-color:#FFFFFF; border:1px solid #ddd; border-right:0px; border-bottom:0px;}
.secondrttable tr td{ border-bottom:1px solid #ddd; border-right:1px solid #ddd;  color:#4a4a4a !important; }
.secondrttable tr td table{background-color: rgb(255, 255, 228);}
.secondrttable tr td table tr td{padding:5px !important; }
.secondrttable tr td table tr:first-child{ background-color:#F7F7F7 !important;}
.rmRatePlan__rec { border: 1px solid #852d94; border-radius: 8px; color: #852d94; display: inline-flex; font-size: 10px; font-weight: 700; margin-bottom: 12px; padding: 3px 8px; text-transform: uppercase; }
.hotels_amenities{font-size:14px;}

@media(max-width: 576px){
   .hotelnameflex{margin-top: 0px;display: block;}
   .rightpricediv{text-align: left;}
   .hotelnameflex{padding-left: 10px !important;padding-right: 10px !important;margin-bottom: 10px !important;}
   .hotelnameflex h3{font-size: 18px !important;margin-bottom: 5px !important;}
   .staricons{margin-bottom: 5px !important;}
   .hotelnameflex button{font-size: 14px; font-weight: 500; padding: 4px 4px; width: 32%; margin-top: 3px;}
   #bodyaria{    padding: 62px 6px 0px 6px !important;}
   .rightview{display: none !important;}
   .leftfullimg{height: 210px !important;}
   .seemoreflex h6{font-size: 18px !important;}
   .roomdetails{font-size: 13px !important;}
   .attractions ul{margin-right: 0px !important;font-size: 13px !important;padding: 12px !important;margin-bottom: 5px !important;}
   .accomadationcard{padding: 12px !important;margin-bottom: 20px !important;}
   .abtPptDtlsTags__item{padding: 5px 6px !important;margin-right: 4px !important;font-size: 12px !important;} 
   .galleryview{margin-bottom: 15px !important;}
   .roomcontentlist{padding: 15px 10px !important;}
   .roomcontentlist h4{margin-bottom: 10px !important;font-size: 16px !important;}
   .secondrttable h4{font-size: 15px !important;margin-bottom: 5px !important;}
   .borders div{font-size: 15px !important;margin-bottom: 5px !important;}
   .hotels_amenities{font-size: 12px !important;}
   .priceinmb div{font-size: 14px !important;}
   .forminmb button{font-size: 12px !important;padding: 5px !important;}
   .rmRatePlan__rec{margin-bottom: 4px !important;}
   #incroomname1{margin-bottom: 4px !important;}
   .secondrttable tr td{width: auto !important; padding: 5px !important;}
   .dealscardblue{padding: 10px !important; border-radius: 10px !important;}
   .flexdealsdiv h6{margin-bottom: 5px !important;font-size: 13px !important;}
   .flexdealsdiv p{margin-bottom: 5px !important;font-size: 11px !important;}
   .flexdealsdiv button{background: #fff !important;color: #000 !important;font-size: 13px !important;padding: 4px !important;}
   .dealsstayimg{top: 6px !important;left: 8px !important;}
   .dealsstayimg{display: none !important;}
}

</style>
</head>

<body>
<?php include "header.php"; ?>
  
   <div id="bodyaria" class="innersearchbody">

      <div class="webcontenor">
         <div class="hotelnameflex">
            <div>
               <h3><?php echo stripslashes($hotelResultInfo['HotelName']); ?></h3>
               <div class="staricons"><span>Hotels</span>
			   <?php for($i=1; $i<=$hotelResultInfo['StarRating']; $i++){ ?><i class="fa fa-star" aria-hidden="true"></i><?php } ?>
               </div>
               <p><i class="fa fa-map-marker" aria-hidden="true"></i>  <?php echo $hotelResultInfo['Address']; ?></p>
            </div>

            <div class="rightpricediv">
               <p>Start From</p>
               <h6  id="toppriceht">0</h6>
               <a   href="#pricelist" class="roomselectbtn"><button type="button" class="btn btn-danger">Select Room</button></a>
            </div>
         </div>

         <div class="galleryview">
            <div class="row gallerys">

               <div class="col-lg-8">
                  <div class="leftfullimg">
                    <a href="<?php if($hotelResultInfo['Images'][0]!=''){  echo $hotelimg=$hotelResultInfo['Images'][0];  } else { echo 'images/NoImageFound.png'; } ?>">
                    <img src="<?php if($hotelResultInfo['Images'][0]!=''){  echo $hotelimg=$hotelResultInfo['Images'][0];  } else { echo 'images/NoImageFound.png'; } ?>" alt="" onerror="this.onerror=null;this.src='images/nohotelimage.png';">
                    </a>
                  </div>
               </div>

               <div class="col-lg-4 rightview">
                  <div class="row">
                     <div class="col-lg-6">
                        <div class="fixheightimg">
                           <a href="<?php if($hotelResultInfo['Images'][1]!=''){  echo $hotelimg=$hotelResultInfo['Images'][1];  } else { echo 'images/NoImageFound.png'; } ?>">
                           <img src="<?php if($hotelResultInfo['Images'][1]!=''){  echo $hotelimg=$hotelResultInfo['Images'][1];  } else { echo 'images/NoImageFound.png'; } ?>" alt="" onerror="this.onerror=null;this.src='images/nohotelimage.png';">
                           </a>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="fixheightimg">
                          <a href="<?php if($hotelResultInfo['Images'][2]!=''){  echo $hotelimg=$hotelResultInfo['Images'][2];  } else { echo 'images/NoImageFound.png'; } ?>">
                          <img src="<?php if($hotelResultInfo['Images'][2]!=''){  echo $hotelimg=$hotelResultInfo['Images'][2];  } else { echo 'images/NoImageFound.png'; } ?>" alt="" onerror="this.onerror=null;this.src='images/nohotelimage.png';">
                          </a>
                     </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="fixheightimg">
                          <a href="<?php if($hotelResultInfo['Images'][3]!=''){  echo $hotelimg=$hotelResultInfo['Images'][3];  } else { echo 'images/NoImageFound.png'; } ?>">
                          <img src="<?php if($hotelResultInfo['Images'][3]!=''){  echo $hotelimg=$hotelResultInfo['Images'][3];  } else { echo 'images/NoImageFound.png'; } ?>" alt="" onerror="this.onerror=null;this.src='images/nohotelimage.png';">
                          </a>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="fixheightimg">
                           <a href="<?php if($hotelResultInfo['Images'][4]!=''){  echo $hotelimg=$hotelResultInfo['Images'][4];  } else { echo 'images/NoImageFound.png'; } ?>">
                           <img src="<?php if($hotelResultInfo['Images'][4]!=''){  echo $hotelimg=$hotelResultInfo['Images'][4];  } else { echo 'images/NoImageFound.png'; } ?>" alt="" onerror="this.onerror=null;this.src='images/nohotelimage.png';">
                           </a>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="fixheightimg">
                           <a href="<?php if($hotelResultInfo['Images'][5]!=''){  echo $hotelimg=$hotelResultInfo['Images'][5];  } else { echo 'images/NoImageFound.png'; } ?>">
                           <img src="<?php if($hotelResultInfo['Images'][5]!=''){  echo $hotelimg=$hotelResultInfo['Images'][5];  } else { echo 'images/NoImageFound.png'; } ?>" alt="" onerror="this.onerror=null;this.src='images/nohotelimage.png';">
                           </a>
                        </div>
                     </div>
                     <div class="col-lg-6 seemorephoto">
                        <div class="fixheightimg">
                           <a href="<?php if($hotelResultInfo['Images'][6]!=''){  echo $hotelimg=$hotelResultInfo['Images'][6];  } else { echo 'images/NoImageFound.png'; } ?>">
                           <img src="<?php if($hotelResultInfo['Images'][6]!=''){  echo $hotelimg=$hotelResultInfo['Images'][6];  } else { echo 'images/NoImageFound.png'; } ?>" alt="" onerror="this.onerror=null;this.src='images/nohotelimage.png';">
                        </a>
                        </div>
                     </div>
                  </div>
               </div>

            </div>
         </div><!-- galleryview  -->

         <div class="accomadationcard">
            
			<div class="row">
			 <div class="col-lg-<?php if(count($hotelResultInfo['Attractions'])>0){?>8<?php } else { ?>12<?php } ?>">
			 <div class="seemoreflex">
               <h6>About <span><?php echo stripslashes($hotelResultInfo['HotelName']); ?></span></h6> 
			   
			 

            </div>
            <p class="roomdetails"><?php echo preg_replace('/^(<br\s*\/?>)*|(<br\s*\/?>)*$/i', '', html_entity_decode(stripslashes($hotelResultInfo['Description']))); ?></p>
			</div>
				<?php if(count($hotelResultInfo['Attractions'])>0){?>
			 <div class="col-lg-4">
			 <div class="seemoreflex">
               <h6>Attractions</h6> 
            </div>
           <div class="attractions">
		   <ul>
		 <?php foreach($hotelResultInfo['Attractions'] as $hotelattraction){ ?>
			<li><?php echo $hotelattraction['Key']; ?> <?php echo $hotelattraction['Value']; ?></li> 
			<?php } ?>
			</ul>
		 </div>
			</div>
			 <?php } ?>
			</div>
         </div>
		 <?php if(count($hotelResultInfo['HotelFacilities'])>0){?>
<div class="accomadationcard">
            <div class="seemoreflex">
                  <h6>Hotel <span>Facilities</span></h6> 
            </div> 
			 <?php foreach($hotelResultInfo['HotelFacilities'] as $hotelFacilities){ ?>
			<div class="abtPptDtlsTags__item"><i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp;&nbsp;<?php echo $hotelFacilities; ?></div>
			<?php } ?> 
         </div>
		 <?php } ?>
		 <?php if(count($hotelResultInfo['HotelPolicy'])>0){?>
		 
         <div class="accomadationcard">
            <div class="seemoreflex">
                 <h6>Hotel <span>Policy</span></h6> 
            </div>
               <p class="roomdetails"><?php echo preg_replace('/^(<br\s*\/?>)*|(<br\s*\/?>)*$/i', '', html_entity_decode(stripslashes($hotelResultInfo['HotelPolicy']))); ?></p>
         </div>
 <?php } ?>

         <section>
            <div class="roomcontentlist" id="pricelist">
               <h4>Available Room Types in <?php echo stripslashes($hotelResultInfo['HotelName']); ?></h4>
			   
			   <table class="secondrttable" width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#ddd" style="margin-bottom:10px;">
  <tr>
    <td width="40%" align="left" bgcolor="#F8F8F8" class="mobilehide" style="padding:10px;"><strong>Room Type</strong></td>
    <td width="33%" align="left" bgcolor="#F8F8F8"  class="mobilehide" style="padding:10px;"><strong>Benefits</strong></td>
    <td width="18%" align="left" bgcolor="#F8F8F8"  class="mobilehide" style="padding:10px;"><strong> Price</strong></td>
  </tr>
 
 
 <?php 
			//echo $HotelSearchArr = json_decode(($_REQUEST['HotelSearchDetails'])); 
			 
	 	//echo '<pre>';
			//print_r($roomDataArr);
			
			 $n=1;
			$roomCount = 1;
			
			if(count($roomDataArr['GetHotelRoomResult']['HotelRoomsDetails'])>0)
			{
			
			foreach($roomDataArr['GetHotelRoomResult']['HotelRoomsDetails'] as $roomValArr)
			{


			$baseFare=0;
			$adultCost=0;
			$childCost=0;
			if($adultCount>0){
			$adultCost=($hotelPrice['adultCost']*$adultCount);
			}
			if($childCount>0){
			$childCost=($hotelPrice['childCost']*$childCount);
			}  
			    $baseFare=((($adultCost+$childCost)*trim($_REQUEST['empcount']))*$numberOfNights); 
			$hotelCost=calculatehotelcost(encode($agentid),stripslashes($rest['name']),$baseFare,'0');
			
			if($count==1){
			$minprice=$hotelCost[2];
			}
			
			if($hotelCost[2]>$maxprice){
			$maxprice=$hotelCost[2];
			}
			
			

		?>
  <tr>
    <td width="40%" align="left" valign="top" style="padding:10px;"><h4 style="font-weight:700; font-size:24px; margin-bottom:10px; color:#000;"><?php echo stripslashes($roomValArr['RoomTypeName']); ?></h4>
	  
	
	
	<div style="margin-bottom:5px; color:#CC3300;"></strong> <a onClick="$('.rows<?php echo $n; ?>').toggle();"><strong>View Cancellation Policy</strong></a></div>
	<?php if($roomValArr['CancellationPolicies']){ ?>
	
	<table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC" style="display:none; font-weight:500;" class="cancelltioncharge rows<?php echo $n; ?>">
  <tr>
    <td><strong>From Date</strong></td>
    <td><strong>To Date</strong></td>
    <td><strong>Charge</strong></td>
  </tr>
  <?php
  $charge='Non-Refundable';
  $check=0;
   foreach($roomValArr['CancellationPolicies'] as $roomValArracharge)	{ ?>
  <tr>
    <td><?php echo  date('d/m/Y - h:i A',strtotime($roomValArracharge['FromDate'])); ?></td>
    <td><?php echo  date('d/m/Y - h:i A',strtotime($roomValArracharge['ToDate'])); ?></td>
    <td><?php echo  $roomValArracharge['Charge'];
	if($roomValArracharge['Charge']<1 && $check==0){
	$charge='Refundable';
	$check=1;
	$till=date('j M Y',strtotime($roomValArracharge['ToDate']));
	} 
	
	 ?><?php if($roomValArracharge['ChargeType']==2){ echo '%'; } else { echo ' INR'; } ?></td>
  </tr>
  <?php } ?>
</table>
<?php } 
/*
			echo '<pre>';
print_r($roomValArr);*/

?>	</td>
    <td width="33%" align="left" valign="top" style="padding:10px;"><div class="borders d-grid">
					 <?php if($n==1){ ?><div><span class="rmRatePlan__rec appendRight3">RECOMMENDED</span></div><?php } ?>
					 <?php if($charge=='Refundable'){ $comroomname='Room With Free Cancellation'; } else {  $comroomname='Room With'; }  ?> 
					 
					 <div style="margin-bottom:10px; font-size:18px; font-weight:800; " id="incroomname<?php echo $n; ?>"></div>
					 											 
			<?php $a=1; foreach($roomValArr['Amenities'] as $roomValArramini)	{
			
			$string = preg_replace('/\.$/', '', $roomValArramini); //Remove dot at end if exists
$array = explode(',', $string); //split string into array seperated by ', '
foreach($array as $value) //loop over values
{ 

if(trim($value)!=''){
			 ?> 								
																
 <p class="hotels_amenities" style="margin-bottom: 5px;"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> <?php echo $roomval=rtrim(trim($value),",");   if($roomval=='Breakfast' || $roomval=='Breakfast and Dinner' || $roomval=='Dinner'){ $comroomname.=' '.$roomval; } ?></p>
 <?php $a++; } } }  ?>
 <?php if($a==1){ ?>
 
  <p class="hotels_amenities" style="margin-bottom: 5px;"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Room Only</p>
 <?php } ?>
 <?php if($charge=='Refundable'){ ?>
 <p class="hotels_amenities" style="margin-bottom: 5px; color:#00a19c; font-weight:500;">
 <i class="fa fa-check" aria-hidden="true"></i> Free Cancellation till <?php echo $till; ?>
 </p>
 <?php } else { ?>
  <p class="hotels_amenities" style="margin-bottom: 5px; color:#CC3300; font-weight:500;">
 <i class="fa fa-times" aria-hidden="true"></i> <?php echo $charge; ?>
 </p>
 <?php } ?>
 
			<script>
			$('#incroomname<?php echo $n; ?>').text('<?php  if($comroomname=='Room With'){ echo str_replace('With','Only',$comroomname); } else { echo $comroomname; } ?>');
			</script>																												 
		    </div></td>
    <td class="priceinmb" width="18%" align="left" valign="top" style="padding:10px;">
	
	<div style="color:#666666;">Total Price</div>
	<div style="font-size:24px; color:#000000; font-weight:700; margin-bottom:5px;"><?php  
	
	$hotelCostdisplay=calculatehotelcost(encode($agentid),stripslashes($hotelResultInfo['HotelName']),$roomValArr['Price']['PublishedPrice'],'0');
	echo convertfromtocurrencywithcurr('INR',$_SESSION['currency'],$hotelCostdisplay[2]);  
	 round($roomValArr['Price']['PublishedPrice']);  	if($n==1)
			{
			?>
			<script> 
			$('#toppriceht').html('<?php echo convertfromtocurrencywithcurr('INR',$_SESSION['currency'],$hotelCostdisplay[2]);   ?>');
			</script>
			<?php } ?>
	 </div>
		<form class="forminmb" name="roomfrom" method="get" action="hotel-review?i=<?php echo $roomValArr['RoomIndex']; ?>" >
	<button type="submit" class="btn btn-danger" style=" font-weight:700px; padding:5px 20px;"   >

                                    <span class="ladda-label" style="color: #fff;">Book Now</span>
                                    <span class="ladda-spinner"></span></button>

									
									<input type="hidden" name="RoomIndex" id="RoomIndex" value="<?php echo $roomValArr['RoomIndex']; ?>" >
									<input type="hidden" name="RoomTypeCode" id="RoomTypeCode" value="<?php echo $roomValArr['RoomTypeCode']; ?>" >
									<input type="hidden" name="RoomTypeName" id="RoomTypeName" value="<?php echo $roomValArr['RoomTypeName']; ?>" >
									<input type="hidden" name="RatePlanCode" id="RatePlanCode" value="<?php echo $roomValArr['RatePlanCode']; ?>" >
									
									<input type="hidden" name="BedTypeCode" id="BedTypeCode" value="" >
									<input type="hidden" name="SmokingPreference" id="SmokingPreference" value="<?php echo $roomValArr['SmokingPreference']; ?>" >
									<input type="hidden" name="Supplements" id="Supplements" value="" >
									
									<input type="hidden" name="ResultIndex" id="ResultIndex" value="<?php echo  $_REQUEST['ResultIndex']; ?>" >
									<input type="hidden" name="HotelCode" id="HotelCode" value="<?php echo $_REQUEST['HotelCode']; ?>" >
									<input type="hidden" name="HotelName" id="HotelName" value="<?php echo $hotelResultInfo['HotelName']; ?>" >
									<input type="hidden" name="NoOfRooms" id="NoOfRooms" value="<?php echo $_REQUEST['empcount']; ?>" >
									<input type="hidden" name="ClientReferenceNo" id="ClientReferenceNo" value="" >
									<input type="hidden" name="IsVoucherBooking" id="IsVoucherBooking" value="" >
									
									<input type="hidden" name="roomArrayIndex" id="roomArrayIndex" value="<?php echo ($n-1); ?>" >
									<input type="hidden" name="hotelimg" id="hotelimg" value="<?php echo $hotelimg; ?>" >
									<input type="hidden" name="hotelnights" id="hotelnights" value="<?php echo $numberOfNights; ?>" >
								</form>									
													<?php  if($LoginUserDetails['userType']=='agent' || $LoginUserDetails['userType']=='client'){} else  {  ?>					
									<div style="margin-top:10px; font-size:11px;">To get more offers or less price<br><a onClick="$('#clientloginbox').show();loadclientloginbox(1);" style="cursor:pointer;"><strong>LOGIN NOW</strong></a></div>
									<?php } ?>
									
									<?php if($n==1){ ?>
									<script>
									// $('#toppriceht').html('&#8377;<?php  echo $hotelCost[2];   ?>');
									</script>
									<?php } ?>	</td>
  </tr>
  
  	<?php $n++; } }  ?>	
</table>

            </div><!-- roomcontentlist  -->

            <div class="dealscardblue">
               <div class="flexdealsdiv">
                  <div>
                    <h6>You can get better deals for your group stay!</h6> 
                    <p>For group enquiry feel free contact us</p></div>
                  <div>
                    <a href="contact-us" target="_blank"><button type="button" class="btn btn-light">Contact Us </button></a>
                  </div>
               </div>
               <img class="dealsstayimg" src="images/deals1.svg" alt="">
            </div>
      </div><!-- webcontenor  -->

   </div>



 
   <script>
      function getSearchCityHotel(citysearchfield, cityresultfield, listsearch) {
         var citysearchfieldval = encodeURI($('#' + citysearchfield).val());
         var citysearchfield = citysearchfield;

         if (citysearchfieldval != '') {
            $('#' + listsearch).show();
            $('#' + listsearch).load('searchcitylistshotel.php?keyword=' + citysearchfieldval + '&searchcitylists=' + listsearch + '&cityresultfield=' + cityresultfield + '&citysearchfield=' + citysearchfield);
         }
      }



      $(document).ready(function() {
         $("#dt1").datepicker({
            dateFormat: "dd-mm-yy",
            minDate: 0,
            onSelect: function() {
               var dt2 = $('#dt2');
               var startDate = $(this).datepicker('getDate');
               //add 30 days to selected date
               startDate.setDate(startDate.getDate() + 30);
               var minDate = $(this).datepicker('getDate');
               var dt2Date = dt2.datepicker('getDate');
               //difference in days. 86400 seconds in day, 1000 ms in second
               var dateDiff = (dt2Date - minDate) / (86400 * 1000);

               //dt2 not set or dt1 date is greater than dt2 date
               if (dt2Date == null || dateDiff < 0) {
                  dt2.datepicker('setDate', minDate);
               }
               //dt1 date is 30 days under dt2 date
               else if (dateDiff > 30) {
                  dt2.datepicker('setDate', startDate);
               }
               //sets dt2 maxDate to the last day of 30 days window
               dt2.datepicker('option', 'maxDate', startDate);
               //first day which can be selected in dt2 is selected date in dt1
               dt2.datepicker('option', 'minDate', minDate);
            }
         });
         $('#dt2').datepicker({
            dateFormat: "dd-mm-yy",
            minDate: 0,
            onSelect: function() {}
         });

      });



      function gettotalpax() {

         var totalpax = 0;
         $('.pax').each(function(i, obj) {
            totalpax = Number(totalpax + Number($(obj).val()));
         });
         $('#totalpax').val(totalpax);


         var empcount = $('#empcount').val();
         $('#travellersshow').val('' + empcount + ' Room - ' + totalpax + ' Guest');
      }





      function addEmpInfo() {
         var empcount = $('#empcount').val();

         empcount = Number(empcount) + 1;
         $.get("loadchild.php?id=" + empcount, function(data) {
            $("#loademployee").append(data);
         });

         var totalpax = $('#totalpax').val();
         $('#empcount').val(empcount);
         $('#travellersshow').val('' + empcount + ' Room - ' + totalpax + ' Guest');
      }



      function removeEmpInfo(id) {
         $('#empInfoId' + id).remove();
         var empcount = $('#empcount').val();
         empcount = Number(empcount) - 1;
         var totalpax = $('#totalpax').val();
         $('#empcount').val(empcount);
         $('#travellersshow').val('' + empcount + ' Room - ' + totalpax + ' Guest');
      }



      function combinecheckbox() {
         var combinecheck = '';
         var output = jQuery.map($(':checkbox[name=category\\[\\]]:checked'), function(n, i) {
            combinecheck = combinecheck + n.value + ',';
         }).join(',');

         $('#starcategory').val(rtrim(combinecheck) + ' Star');
      }

      function rtrim(str) {
         return str.replace(/\s+$/, '');
      }

      function openclosebox(id) {

         var getdisplay = $('#' + id + ' .whitecardbody').css('display');
         $('#' + id + ' .whitecardheader .fa').removeClass('fa-angle-down');

         if (getdisplay == 'none') {
            $('#' + id + ' .whitecardbody').slideDown();
            $('#' + id + ' .whitecardheader .fa').addClass('fa-angle-up');
         } else {
            $('#' + id + ' .whitecardbody').slideUp();
            $('#' + id + ' .whitecardheader .fa').addClass('fa-angle-down');
         }

      }
   </script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js" integrity="sha512-IsNh5E3eYy3tr/JiX2Yx4vsCujtkhwl7SLqgnwLNgf04Hrt9BT9SXlLlZlWx+OK4ndzAoALhsMNcCmkggjZB1w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   <script>
      $(document).ready(function(){
         $(".gallerys").magnificPopup({
            type:'image',
            delegate:'a',
            gallery:{
               enabled:true
            }
         });
      });
   </script>


<?php include "footerinc.php"; ?>
<?php include "footer.php"; ?>


</body>

</html>