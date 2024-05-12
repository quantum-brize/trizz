<?php 
include "inc.php"; 
include "config/logincheck.php"; 
$page='hotels';

 

$a=GetPageRecord('*','hotelMaster',' id="'.decode($_REQUEST['hotelSearchId']).'"'); 
$rest=mysqli_fetch_array($a);
 
  

$r=GetPageRecord('*','sys_HotelRoomTypeCost',' id="'.decode($_REQUEST['rid']).'"'); 
$roomdatamain=mysqli_fetch_array($r);

$starcategory='3, 4 Star';
if($_REQUEST['starcategory']!=''){
$starcategory=$_REQUEST['starcategory'];
}
 
if($_REQUEST['checkInDate']!=''){
 $checkInDate=$_REQUEST['checkInDate'];
}
  
 
if($_REQUEST['checkOutDate']!=''){
$checkOutDate=$_REQUEST['checkOutDate'];
}
 
$destinationHotel='130443,IN'; 
if($_REQUEST['destinationHotel']!=''){
$destinationHotel=$_REQUEST['destinationHotel'];
}
 
$citydestination='Delhi,India'; 
if($_REQUEST['citydestination']!=''){
$citydestination=$_REQUEST['citydestination'];
}




$date1 = new DateTime($checkInDate);
$date2 = new DateTime($checkOutDate); 
$numberOfNights= $date2->diff($date1)->format("%a");
if($numberOfNights==0){ $numberOfNights=1; }
			
			
			 
$adultCount=$_REQUEST['ad'];
$childCount=$_REQUEST['cd'];
			

$agentid=$_SESSION['parentAgentId'];

$roomCount=$_REQUEST['empcount'];

 $bl=GetPageRecord('*','taxMaster','id=2 '); 
$taxData=mysqli_fetch_array($bl);



 
 
	$HotelSearchDetails = trim($_POST['HotelSearchDetails']);
	$HotelSearchArr = json_decode($HotelSearchDetails); 
	  
	 
	 
	 
	 
	$hotelJsonData = trim($_POST['hotelJsonData']);
	$hotelArr = json_decode($hotelJsonData); 
	
	$RoomDetails = trim($_POST['RoomDetails']);
	$RoomArr = json_decode($RoomDetails); 
	
	$uniqueId = trim($_REQUEST['un']);
	$HotelName = trim($rest['name']);
	$HotelCode = trim($rest['id']);
	$Rating = trim($rest['category']);
	$Address = trim($rest['address']);
	$Destination = trim($rest['cityName']);
	$CheckIn = date('Y-m-d',strtotime($checkInDate));
	$CheckOut = date('Y-m-d',strtotime($checkOutDate));
	$status = "1";
	 
 
 	$numberroom=1;
				$finalroomcost=0;
				$finalmealcost=0;
				$age1=0;
				$age2=0;
				foreach(range($_REQUEST['empcount']-1,$columns) as $index) {
				
				$adult=$_GET['noadults'.$numberroom];
				$child=$_GET['nochilds'.$numberroom];
				$age1=$_GET['age1'.$numberroom];
				$age2=$_GET['age2'.$numberroom];
	
	
	
	
$rs=GetPageRecord('*','sys_HotelRoomTypeCost',' hotelId="'.$rest['id'].'" and id="'.$roomdatamain['id'].'" and maxPax<3 and rooms>0 and validFrom<="'.date('Y-m-d', strtotime($checkInDate)).'" and validTo>="'.date('Y-m-d', strtotime($checkOutDate)).'" order by adultCost asc');
$hotelPrice=mysqli_fetch_array($rs); 
 
 
 $adultcost=0;
				$childcost1=0;
				$childcost2=0;
				
					$childcostone=0;
				$childcosttwo=0; 
				
				
				 
				
				if($adult<3 && $hotelPrice['id']>0){
			
		 		
				 $adultcost=$hotelPrice['adultCost']+($hotelPrice['mealCost']*$adultCount);
				 $finalmealcost+=($hotelPrice['mealCost']*$adultCount);
				
				if($age1<3 && $child>0){
				$childcostone=$hotelPrice['infantCost'];
				}

				if($age1>2 && $child>0){
				$childcostone=$hotelPrice['childCost']+($hotelPrice['mealCost']*$adultCount);
				 $finalmealcost+=($hotelPrice['mealCost']*$adultCount);
				}
				
				if($age2>2 && $child==2){
				$childcosttwo=$hotelPrice['childCost']+($hotelPrice['mealCost']*$adultCount);
				 $finalmealcost+=($hotelPrice['mealCost']*$adultCount);
				} 
				if($age2<3 && $child==2){
				$childcosttwo=$hotelPrice['infantCost'];
				} 
				
				
				
			 
		  $finalroomcost+=($adultcost+$childcostone+$childcosttwo)*$numberOfNights;
				
				
				} else {
				
				$rs=GetPageRecord('*','sys_HotelRoomTypeCost',' hotelId="'.$rest['id'].'"  and id="'.$roomdatamain['id'].'" and maxPax>2 and rooms>0 and validFrom<="'.date('Y-m-d', strtotime($checkInDate)).'" and validTo>="'.date('Y-m-d', strtotime($checkOutDate)).'" order by adultCost asc');
			$hotelPrice=mysqli_fetch_array($rs); 
			
						$childcostone=0;
				$childcosttwo=0; 
 
			
			if($hotelPrice['id']!=''){
			 
						 
				$adultcost=$hotelPrice['adultCost']+($hotelPrice['mealCost']*$adultCount);
				 $finalmealcost+=($hotelPrice['mealCost']*$adultCount);
				
				if($age1<3 && $child>0){
				$childcostone=$hotelPrice['infantCost'];
				}
				
				if($age1>2 && $child>0){
				$childcostone=$hotelPrice['childCost']+($hotelPrice['mealCost']*$adultCount);
				 $finalmealcost+=($hotelPrice['mealCost']*$adultCount);
				}
				 	//echo $child.'-'.$rest['name'];
				
				if($age2>2 && $child==2){
				$childcosttwo=$hotelPrice['childCost']+($hotelPrice['mealCost']*$adultCount);
				 $finalmealcost+=($hotelPrice['mealCost']*$adultCount);
				} 
				if($age2<3 && $child==2){
				$childcosttwo=$hotelPrice['infantCost'];
				} 

				 } else {
				 
				 $rs=GetPageRecord('*','sys_HotelRoomTypeCost',' hotelId="'.$rest['id'].'"  and id="'.$roomdatamain['id'].'" and rooms>0 and maxPax<3 and validFrom<="'.date('Y-m-d', strtotime($checkInDate)).'" and validTo>="'.date('Y-m-d', strtotime($checkOutDate)).'" order by adultCost asc');
			$hotelPrice=mysqli_fetch_array($rs); 
				 
				 
				 $adultcost=$hotelPrice['adultCost']+$hotelPrice['extraBed']+($hotelPrice['mealCost']*$adultCount);
				  $finalmealcost+=($hotelPrice['mealCost']*$adultCount);
				   $finalmealcost+=($hotelPrice['mealCost']*$adultCount);
				
				if($age1<3 && $child>0){
				$childcostone=$hotelPrice['infantCost'];
				}
				
				if($age1>2 && $child>0){
				$childcostone=$hotelPrice['childCost']+($hotelPrice['mealCost']*$adultCount);
				 $finalmealcost+=($hotelPrice['mealCost']*$adultCount);
				}
				 	//echo $child.'-'.$rest['name'];
				
			if($age2>2 && $child==2){
			$childcosttwo=$hotelPrice['childCost']+($hotelPrice['mealCost']*$adultCount);
			 $finalmealcost+=($hotelPrice['mealCost']*$adultCount);
			} 
			if($age2<3 && $child==2){
			$childcosttwo=$hotelPrice['infantCost'];
			} 				 
		}
				 
$finalroomcost+=($adultcost+$childcostone+$childcosttwo)*$numberOfNights;
		
}
    $numberroom++; 
  }
  
 
  	$hotelCost=calculatehotelcost(encode($agentid),stripslashes($rest['name']),$finalroomcost,'0');
	
	
	 

  
	 $baseFare = ($hotelCost[0]);  
	$TotalFareForApi=$hotelCost[2];
	$BookingNote = $updatedPriceArr->hInfo->ops{0}->inst{0}->msg;
	
	
	$Commission=getHotelAgentCommission($BaseFare,stripslashes($_REQUEST['hotelName']));
	
	
	
	if($taxData['applicableType']=='commission'){
		$agentFinalGST=(($Commission*$taxData['valuePerc'])/100);
	}
	
	if($taxData['applicableType']=='totalfare'){
		$agentFinalGST=(($BaseFare*$taxData['valuePerc'])/100);
	}
	
	$clientTax=($TAX+($hotelCost[1]));

	
	  
$rsa=GetPageRecord('*','hotelBookingMaster','uniqueId="'.$uniqueId.'"'); 
$checkdupli=mysqli_fetch_array($rsa); 

 
 $totalgst=0;
	if($rest['hotelGST']==5){
	$totalgst=round($hotelCost[2]*$rest['hotelGST']/100);
	}
	
	if($rest['hotelGST']==18){
	$totalgst=round($hotelCost[4]*$rest['hotelGST']/100);
	}
	
 $TAX=$totalgst;

if($checkdupli['uniqueId']!=$uniqueId){

?>
<?php  
$cancellationdate='';
$refundable='Non-Refundable';

$newroomname.=stripslashes($roomdatamain['roomType']); ?> <?php  $newroomname.=stripslashes(' | '.$roomdatamain['inclusion']); 
	 if($roomdatamain['cancellationPolicy']=='Refundable'){
   $checkin=date('Y-m-d',strtotime($_REQUEST['checkInDate']));  
	 if(date('Y-m-d')>date('Y-m-d',strtotime($checkin . ' -'.$roomdatamain['cancellationBeforeDays'].' day'))){
	  } else { $newroomname.=" | Free Cancellation "; $refundable='Refundable'; $cancellationdate=date('Y-m-d',strtotime($checkin . ' -'.$roomdatamain['cancellationBeforeDays'].' day')); } } ?>
<?php
	
	 $namevalue ='uniqueId="'.$uniqueId.'",HotelName="'.$HotelName.'",HotelCode="'.$HotelCode.'",Rating="'.$Rating.'",Address="'.$Address.'",RoomType="'.$newroomname.'",RoomTypeCode="'.$roomdatamain['id'].'",TaxCode="'.$TAX.'",Amount="'.(($hotelCost[2]-$hotelCost[3])+$TAX).'",CancellationPolicy="'.$refundable.'",ServiceTax="'.$ServiceTax.'",SvTax="'.$SvTax.'",DisTax="'.$DisTax.'",ExTax="'.$ExTax.'",status=0,Destination="'.$Destination.'",CheckIn="'.$CheckIn.'",CheckOutDate="'.$CheckOut.'",agentId="'.$_SESSION['agentUserid'].'",addDate="'.date('Y-m-d H:i:s').'",addBy="'.$_SESSION['agentUserid'].'",Inclusion="'.$roomdatamain['inclusion'].'",BookingNote="'.$BookingNote.'",baseFare="'.$BaseFare.'",tax="'.$TAX.'",totalFare="'.$TotalFare.'",agentBaseFare="'.($hotelCost[2]-$hotelCost[3]).'",agentTax="'.($TAX+($hotelCost[1]-$hotelCost[3])).'",agentTotalFare="'.(($hotelCost[2]-$hotelCost[3])+$TAX).'",clientBaseFare="'.($hotelCost[2]).'",clientTax="'.$clientTax.'",clientTotalFare="'.(($hotelCost[2])+$TAX).'",markup="'.$hotelCost[4].'",agentMarkup="'.$hotelCost[3].'",agentCommision="'.$Commission.'",agentFinalGST="'.$totalgst.'",taxApplicableType="'.$taxData['applicableType'].'",taxValuePerc="'.$taxData['valuePerc'].'",manualBooking=1,taxApplicableOn="'.$taxData['applicableOn'].'",mealCost="'.$finalmealcost.'",TotalRoom="'.trim($_REQUEST['empcount']).'",detailArray="'.addslashes(serialize($result)).'",bookedRoom="'.trim($_REQUEST['empcount']).'",cancellationDate="'.$cancellationdate.'"';  
	 $bookinglastId = addlistinggetlastid('hotelBookingMaster',$namevalue);  
	$_SESSION['bookinglastId']=$bookinglastId; 
	}
			
	
	
	$baseFare=$BaseFare; 
	$TotalFare=(($hotelCost[2])+$TAX);
	$TAX= $clientTax;
	

 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<title>Hotel Review - <?php echo stripslashes($getcompanybasicinfo['companyName']); ?></title>
<?php include "headerinc.php"; ?>

<style>
#cancelationpolicy table tr td{padding:10px !important;}
</style>

<style>
.showonlyaftercheck{display:none;}
</style>
 

</head>

<body>

<?php include "header.php"; ?>

 
 


 


<div class="container" style="margin-top:80px; margin-bottom:20px;"> 
<form id="flightbookingsubmit" method="post" action="hotel-booking-action-page" >
 
  <!--<input type="hidden" name="hotelJsonData" value="<?php echo htmlentities($_POST['hotelJsonData']); ?>" >
  <input type="hidden" name="RoomDetails" value="<?php echo htmlentities($_POST['RoomDetails']); ?>" />-->
  <input name="HotelSearchDetails" type="hidden" value="<?php echo htmlentities($_POST['HotelSearchDetails']); ?>">
  <input name="HotelReviewData" type="hidden" value="<?php echo htmlentities(json_encode($updatedPriceArr,true)); ?>">
  
  
   <input type="hidden" name="action" value="paxdetailaction">
			<input type="hidden" name="offlineBooking" value="no">
            <input type="hidden" name="bookinglastId" value="<?php echo $bookinglastId; ?>" >
            <input type="hidden" name="nr" value="<?php echo ($_REQUEST['empcount']-1); ?>" >
			<input type="hidden" name="cancellationdate" value="<?php echo ($cancellationdate); ?>" >
<div class="row" id="bookingdatainfo">
<div class="col-9" style="min-height:500px;">

<div class="row">
<div class="col-12" style="position:relative; margin-bottom:20px; display:block !important;"  id="steponeflightdetails">
<h2>Review your Booking</h2>
 


<div class="card cardresult" style="width:100%;">
<div class="card-header">Hotel Information</div>
<div class="card-body">
<div class="detailscontent">
<div class="row">
<div class="col-12">

 
<div class="row multiflightbox">
<div class="col-12">
 <h4 style="font-size:20px;"><strong><?php echo stripslashes($rest['name']); ?> <span class="starcatht" style="font-size:16px; color:#FF9900;"><?php for($i=1; $i<=$rest['category']; $i++){ ?>
						 <i class="fa fa-star" aria-hidden="true"></i>
						   <?php }  ?></span></strong> </h4>
 <div style="font-size:12px; margin-bottom:20px;"><?php echo strip($rest['address']); ?> </div>

</div>

 

  
</div>
 
</div> 
<div class="card-body" style="background-color:#F8F8F8; padding:10px 15px;">

<table border="0" cellpadding="5" cellspacing="0" style="font-size:12px; font-weight:600;">
  <tr>
    <td colspan="5" align="left" valign="top" style="font-size:16px; font-weight:700; color:#FF0000; padding-bottom:10px;">
	<?php echo stripslashes($roomdatamain['roomType']); ?> <?php echo stripslashes(' | '.$roomdatamain['inclusion']); ?> <?php 
	 if($roomdatamain['cancellationPolicy']=='Refundable'){
   $checkin=date('Y-m-d',strtotime($_REQUEST['checkInDate']));  
	 if(date('Y-m-d')>date('Y-m-d',strtotime($checkin . ' -'.$roomdatamain['cancellationBeforeDays'].' day'))){
	 ?> 
	<?php } else {?>
	 | Free Cancellation 
	<?php } } ?>
	
	<?php   $_SESSION['syshotelroomname']=strip($roomdatamain['roomType']); ?></td>
    </tr>
  <tr>
    <td align="left" valign="top"><div style="font-size:12px; color:#999999;">CHECK IN</div>
	<div style="font-size:16px; color:#000000; font-weight:800;"><?php echo date('j F Y',strtotime($checkInDate)); ?></div>
	<div style="font-size:12px; color:#999999;"><?php echo date('l',strtotime($checkInDate)); ?></div>	</td>
    <td align="left" valign="middle" style="padding:0px 20px;"><div style="padding: 4px 10px; font-size: 12px; border: 1px solid #ddd; background-color: #fff; border-radius: 22px;"><?php echo $numberOfNights; ?> NIGHT(S)</div></td>
  <td align="left" valign="top"><div style="font-size:12px; color:#999999;">CHECK OUT</div>
	<div style="font-size:16px; color:#000000; font-weight:800;"><?php echo date('j F Y',strtotime($checkOutDate)); ?></div>
	<div style="font-size:12px; color:#999999;"><?php echo date('l',strtotime($checkOutDate)); ?></div>	</td>
  <td align="left" valign="top" style="padding:0px 30px;">&nbsp;</td>
  <td align="left" valign="middle" style="font-size:16px;"><strong><?php echo  $_REQUEST['ad']; ?></strong> Adults | <?php echo $_REQUEST['cd']; ?> Childs | <?php echo $_REQUEST['empcount']; ?> Rooms</td>
  </tr>
</table>



</div>
	
	<?php if($roomdatamain['cancellationPolicy']!=''){?>
 <div style="margin-top:10px;">
 <h3 style="font-size: 14px; font-weight: 800;">Cancellation Policy</h3>
 <div style="padding-top:10px;">
<div id="cancelationpolicydd">

<?php  if($_REQUEST['c']==2){ ?>
  <div style="padding:10px; color:#000000;">This is Non-Refundable Booking.<br />
    <br />
    100% charges will be applicable if cancelled after <?php echo date('j F Y',strtotime(date('Y-m-d') . "-1 days")); ?>  23:30<br />
  The property makes no refunds for no shows or early checkouts.</div>
 <?php } else { ?>
 <div style="padding:10px; color:#000000;"> 
    Charges will be refundable if cancelled before <?php echo date('j F Y',strtotime($_REQUEST['checkInDate'] . "-".$roomdatamain['cancellationBeforeDays']." days")); ?>  23:30<br />
  <strong>Note:</strong> Cancellation charges may be applicable.
  
  </div>
 
 <?php } ?>


</div>
</div>
 
</div>
<?php }?>

 
  
  

</div>
</div>

</div>
</div>


 <div class="card cardresult" style="width:100%; margin-top:20px;">
<div class="card-header">PAX Details</div>
<div class="card-body">
<div > 
 
            <!-- Contacts Form -->
        
            <div class="row">
              <!-- Input -->
           
		   <?php
		   $n=1;
	foreach(range($_REQUEST['empcount']-1,$columns) as $index) {
	
				$adultroom=$_GET['noadults'.$n];
				$childroom=$_GET['nochilds'.$n];
				$age1=$_GET['age1'.$n];
				$age2=$_GET['age2'.$n];
			  	   
		    ?>
			
			<input name="noadults<?php echo $n; ?>" type="hidden" value="<?php echo $adultroom; ?>">
			<input name="nochilds<?php echo $n; ?>" type="hidden" value="<?php echo $childroom; ?>">
			<input name="age1<?php echo $n; ?>" type="hidden" value="<?php echo $age1; ?>">
			<input name="age2<?php echo $n; ?>" type="hidden" value="<?php echo $age2; ?>">
		   
              <h5 class="mb-4 text-dark font-weight-bold font-size-21" id="scroll-description" style="font-size: 14px; width: 100%; padding: 6px 18px; background-color: #f0f6fb;"><strong>Room - <?php echo $n; ?></strong></h5>
	 
			  <div class="row">
			 <div class="row"  >
			 <?php 
			  $a=1;
			$adult = 1;
				foreach(range($adultroom-1,$columnsa) as $indexa) {
			 ?>  
			   
			   <div class="col-sm-2 mb-2">
                <div class="js-form-message">
                  <label class="form-label"><strong><?php echo $adult; ?>.:</strong> Adult Title </label>
                  <select class="form-control validate1" name="titleAdt<?php echo $n.$adult; ?>" >
                    <option value="">Select</option>
                    <option value="Mr">Mr.</option>
                    <option value="Mrs">Mrs</option>
                    <option value="Ms">Ms.</option>
                  </select>
                </div>
              </div>
			  
			  
              <div class="col-sm-4 mb-4">
                <div class="js-form-message">
                  <label class="form-label"> Adult First Name</label>
                  <input type="text" class="form-control validate1" name="firstNameAdt<?php echo $n.$adult; ?>" id="firstNameAdt<?php echo $a; ?>" placeholder="" aria-label="" required
                                                data-msg="Please enter your first name."
                                                data-error-class="u-has-error"
                                                data-success-class="u-has-success" autocomplete="nope">
                </div>
              </div> 
			  
			  
              <div class="col-sm-4 mb-4">
                <div class="js-form-message">
                  <label class="form-label"> Adult Last Name</label>
                  <input type="text" class="form-control validate1" name="lastNameAdt<?php echo $n.$adult; ?>" id="lastNameAdt<?php echo $a; ?>" required
                                                data-msg="Please enter your last name."
                                                data-error-class="u-has-error"
                                                data-success-class="u-has-success" autocomplete="nope">
                  <input type="hidden" name="adtpaxType<?php echo $adult; ?>" id="adtpaxType<?php echo $adult; ?>" value="AD" >
                </div>
              </div>

			  
              <!-- End Input -->
              <div class="w-100"></div>
              <!-- Input -->
              <!-- End Input -->
       		<?php $adult++; } ?>
					</div>
			
			 <?php 
			 $child=1;
			 
			if($childroom>0){
			 
		foreach(range($childroom-1,$columnsv) as $indexv) {
				  
				 ?>  			
				   
				  <div class="col-sm-4 mb-4">
					<div class="js-form-message">
					  <label class="form-label"><strong><?php echo $child; ?>.: </strong>Child First Name - <strong><?php if($child==1){ echo $age1; } else { echo $age2;  } ?> Year(s)</strong></label>
					  <input type="text" class="form-control validate1" name="firstNameChd<?php echo $n.$child; ?>" id="firstNameChd<?php echo $c; ?>" placeholder="" aria-label="" required
													data-msg="Please enter your first name."
													data-error-class="u-has-error"
													data-success-class="u-has-success" autocomplete="nope">
					</div>
				  </div>
				  <!-- End Input -->
				  <!-- Input -->
				  <div class="col-sm-4 mb-4">
					<div class="js-form-message">
					  <label class="form-label">Child Last Name <?php echo $child; ?> </label>
					  <input type="text" class="form-control validate1" name="lastNameChd<?php echo $n.$child; ?>" id="lastNameChd<?php echo $c; ?>" required
													data-msg="Please enter your last name."
													data-error-class="u-has-error"
													data-success-class="u-has-success" autocomplete="nope">
													
					  <input type="hidden" name="ageChild<?php echo $n.$child; ?>" id="ageChild<?php echo $n.$child; ?>" value="<?php if($child==1){ echo $age1; } else { echo $age2;  } ?>" >
                  <input type="hidden" name="childpaxType<?php echo $n.$child; ?>" id="childpaxType<?php echo $n.$child; ?>" value="CH" >
					</div>
				  </div>
				        <div class="w-100"></div>
				 
				 <?php $child++; }
			 
			  }
			  ?>			  
			  
         
		 	  </div>
			  
<?php 
	$room++;
	$n++; } 

 
		?>
			  
			  
			  
		 
            </div>
            <!-- End Contacts Form -->
          </div>

</div>
</div>

 <div class="card cardresult" style="width:100%; margin-top:20px;">








 <div class="card-header">Contact Details</div>
										 
						 <div class="card-body">
						 
						 	 <div class="row"> <!-- Input -->
                                         
										
										<div class="col-sm-6 mb-4">
                                            <div class="js-form-message">
                                                <label class="form-label">
                                                    Email
                                                </label>

                                                <input type="email" class="form-control validate1" name="email" placeholder="" aria-label="" required
                                                data-msg="Please enter a valid email address."
                                                data-error-class="u-has-error"
                                                data-success-class="u-has-success" autocomplete="nope" value="<?php echo $LoginUserDetails['email']; ?>">
                                            </div>
                                        </div>
                                        <!-- End Input -->

                                        <!-- Input -->
                                        <div class="col-sm-6 mb-4">
                                            <div class="js-form-message">
                                                <label class="form-label">
                                                    Phone
                                                </label>

                                                <input type="number" class="form-control validate1" name="phone" placeholder="" aria-label="" required
                                                data-msg="Please enter a valid phone number."
                                                data-error-class="u-has-error"
                                                data-success-class="u-has-success" autocomplete="nope"  value="<?php echo $LoginUserDetails['phone']; ?>">
                                            </div>
                                        </div>
                                        <!-- End Input -->
										
										<!-- Input -->
                                         
                                        <!-- End Input -->
										</div>
                                        
										<div class="row" style="position:relative;"> 
								<label style="padding-left: 37px; width: 100%; margin-bottom: 30px;"><input name="gst" type="checkbox" value="1" onClick="ifgst();" class="checkbox_check" style="width: 16px; height: 16px; position: absolute; left: 14px; top: 3px;"> I have a GST number (Optional)</label>
								  <div class="col-sm-4 mb-4 showgst">
                                            <div class="js-form-message">
                                                <label class="form-label">
                                                    Company Name
                                                </label>

                                                <input type="text" class="form-control" name="companyName" placeholder=""  autocomplete="nope">
                                            </div>
                                        </div>
										
										<div class="col-sm-4 mb-4 showgst">
                                            <div class="js-form-message">
                                                <label class="form-label">
                                                    GST No
                                                </label>

                                                <input type="test" class="form-control" name="gstNo" placeholder=""  autocomplete="nope">
                                            </div>
                                        </div>
										
										<div class="col-sm-4 mb-4 showgst">
                                            <div class="js-form-message">
                                                <label class="form-label">
                                                    Email
                                                </label>

                                                <input type="test" class="form-control" name="gstEmail" placeholder=""  autocomplete="nope">
                                                <input type="hidden" class="form-control" name="ppid"  value="<?php echo base64_encode(base64_encode(base64_encode($roomPriceSelected['Price']['PublishedPrice']))); ?>">
                                            </div>
                                        </div>
										
										
										
										</div>
						 
						 
						 </div>
				<div class="card-footer text-muted hidefooter">
   
    
   <button type="button" class="btn btn-danger btn-sm" style="float:right;" onClick="checkInputs();">Proceed To Review</button>
   
   
  </div>		
  
  
  
  <div class="card-footer text-muted" id="showfooterpay" style="display:none;">
   
    
   <button type="button" class="btn btn-danger btn-sm" style="float:right;" onClick="$('#steponeflightdetails').hide();$('#steptwopassengerdetails').hide();$('#stepfourpayments').show();$('.flightreviewbox').removeClass('active');$('#strp4').addClass('active');$('.hidefooter').show();$('#showfooterpay').hide();$('#stepfourpayments').show();">Proceed To Pay</button>
   
   
  </div> 
</div>




</div>

</div>
 
<div class="col-12" style="position:relative; margin-bottom:20px; display:none;"  id="stepfourpayments">
<h2>Payments</h2>

<div class="card cardresult" style="width:100%;">
<div class="card-header">
Pay By Wallet
</div>

<div class="row">

<div class="col-4"> 

<div style="padding: 40px 0px; text-align: center;  font-size: 30px; border-bottom-left-radius: 5px; <?php if($totalwalletBalance>=$basefare[1]){?>border-right: 2px solid #41e0d2; background-color: #e4f8ff; color:#02C4B0;<?php } else { ?>border-right: 2px solid #e04159; background-color: #ffe4e4;color:#c4021e;<?php } ?>">
<div style="font-weight:600; ">₹<?php echo round($totalwalletBalance); ?></div>
<div style="font-size:14px; color:#000000; "><strong>Your Wallet Balance</strong></div>
</div> 

</div>


<div class="col-8">
<div class="card-body">
<?php if($totalwalletBalance>=($roomPriceSelected['Price']['PublishedPrice'])){?>
<div style="padding-top:10px; padding-bottom:10px; font-size:14px;"><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp; By placing this order, you agree to our Terms Of Use and Privacy Policy</div>

<input name="termsofuse" type="checkbox" value="1" checked disabled="disabled"> I accept <a href="<?php echo $fullurl; ?>terms-conditions" target="_blank" style="text-decoration:underline;">terms & conditions</a>
 
<div style=" font-size:14px; margin-bottom:10px; margin-top:15px;">
<button type="button" class="btn btn-danger" onClick="payandbooknow();" >Pay Now ₹<?php echo round($TotalFare); ?></button>
</div>
<input name="flightbooking" id="flightbooking" type="hidden" value="0">
<?php } else { ?>

<div style="padding-top:10px; padding-bottom:10px; font-size:14px; color:#CC0000;"><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp; You don't have sufficient balance.</div>
<?php } ?>
</div>


</div>


</div>



</div>

</div>
 
 </div>
 


<div class="col-3">
<div class="card">
<div class="card-header">
Fare Summary
</div>
<div class="card-body">

 <table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-size:14px; color:#000000;">
  <tr>
    <td align="left" style="padding:10px 0px; border-bottom:1px solid #ddd;">Room Price</td>
    <td width="50%" align="right" style="padding:10px 0px; border-bottom:1px solid #ddd; font-size:14px;">₹<?php echo ($hotelCost[2]);  ?></td>
  </tr>
  
  <tr>
    <td align="left" style="padding:10px 0px; border-bottom:1px solid #ddd;">Taxes & Fee</td>
    <td width="50%" align="right" style="padding:10px 0px; border-bottom:1px solid #ddd; font-size:14px;">₹<?php echo ($clientTax+$totalgst); ?></td>
  </tr>   
  

  


    <tr>
    <td align="left" style="padding:10px 0px; border-bottom:1px solid #ddd;">Amount to Pay</td>
 <td align="right" style="padding:10px 0px; border-bottom:1px solid #ddd; font-size:14px;">₹<span id="totalpayAmt"><?php echo round($TotalFare); $_SESSION['hotelfinalprice']=round($TotalFare); ?></span></td>
  </tr>
</table>
<?php if($totalwalletBalance>=($roomPriceSelected['Price']['PublishedPrice'])){} else {?>
<div style="padding-top:10px; padding-bottom:10px; font-size:14px; color:#CC0000;"><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp; You don't have sufficient balance.</div>
<?php } ?>
</div>

</div>
 </div>
 
   </div>
					<input name="finalclientcost" id="finalclientcost" type="hidden" value="<?php echo round($TotalFareForApi);  $_SESSION['finalclientcostchk']=round($TotalFare); ?>">
 

 
 </form>
</div>




<div class="row" id="bookingloading" style="display:none;">
<div class="col-12" style=" text-align:center;">

<div class="card">
<div class="card-body">

<div style="text-align:center; font-size:30px; padding:80px 0px;">
<div style="text-align:center; "><img src="images/loadinggif.gif" width="40"></div>
Wait Please Processing...</div>

</div>
</div>
</div>
 </div> 
 
 
 </div>
 
 
<script>
 
  function checkInputs(){
  var e='';
  var flag = 0;
  $('.validate1').each(function() {
       if($(this).val() == ''){
	    $('.form-control').removeClass('redborderfiled');
	   $(this).addClass('redborderfiled');
	   $(this).focus();
       e=1;
	   return false;
       }
   });
    
   if(e==1){
   alert('Please fill mandatory fields');
   }
   
   if(e!=1){
   $('.form-control').removeClass('redborderfiled');
  $('#steponeflightdetails').show();$('#steptwopassengerdetails').show();$('.flightreviewbox').removeClass('active');$('#strp3').addClass('active');$(window).scrollTop(0);$('.hidefooter').hide();$('#showfooterpay').show();$('#stepfourpayments').hide();
  }
  
  }
 
 
 function showfarerule(id){
 var farerulebtn = $('.farerulebtn').text();
 if(farerulebtn=='Show Fare Rules'){
 $('.farerulebtn').html('Hide Fare Rules');
 $('#showfarerule').slideDown();
 } else {
 $('.farerulebtn').html('Show Fare Rules');
 $('#showfarerule').slideUp();
 }
 
  if(farerulebtn=='Show Fare Rules'){
 $('#showfarerule').html('Loading...');
 $('#showfarerule').load('showflightfarerule.php?id='+id);
 }
 }
 
 
  function showfarerule2(id){
 var farerulebtn = $('.farerulebtn2').text();
 if(farerulebtn=='Show Fare Rules'){
 $('.farerulebtn2').html('Hide Fare Rules');
 $('#showfarerule2').slideDown();
 } else {
 $('.farerulebtn2').html('Show Fare Rules');
 $('#showfarerule2').slideUp();
 }
 
  if(farerulebtn=='Show Fare Rules'){
 $('#showfarerule2').html('Loading...');
 $('#showfarerule2').load('showflightfarerule.php?id='+id);
 }
 }
 
 
   $( function() {
    $( ".datepickerfield" ).datepicker(
	{
changeMonth: true,
            changeYear: true,
            yearRange: '-100:+0',
			dateFormat: 'dd-mm-yy',
			maxDate: new Date()
	
	}
	
	);
  } );
  
  $( function() {
    $( ".datepickerfieldexpiry" ).datepicker(
	{
			changeMonth: true,
            changeYear: true,
            yearRange: '-100:+50',
			dateFormat: 'dd-mm-yy',
			minDate: 0
	
	}
	
	);
  } );
 </script>
<?php include "footer.php"; ?>
 
 <script>
 $('#showfarerule').load('showflightfarerule.php?id=<?php echo encode($res['id']); ?>&checkingflightfare=1');
 <?php if($resret['id']!=''){ ?>
 $('#showfarerule2').load('showflightfarerule.php?id=<?php echo encode($resret['id']); ?>&checkingflightfare=1');
 <?php } ?>
 
 function payandbooknow(){
 $('#flightbooking').val('1');
 $('#flightbookingsubmit').submit();
 $('#bookingloading').show();
 $('#bookingdatainfo').hide();
 $('.flightreview').hide();
 }
</script>

<iframe id="bookingframe" name="bookingframe" style="display:none;"></iframe>

<link rel="stylesheet" href="css/msastyles.php?c=3F449D&c2=26295e&h=3F449D&f=444444">

<script src="https://davinaxtravels.in/website/assets/js/magnific.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<link rel="stylesheet" type="text/css" href="css/jquery.seat-charts.css" />

<script type="text/javascript" src="css/jquery.seat-charts.min.js"></script>

<script type="text/javascript">

$(document).ready(function(){ 

$('.popup-ajax').magnificPopup({ 

    removalDelay: 500,

    closeBtnInside: true,

    callbacks: {

        beforeOpen: function(){

        $("#view-seats").html('<div style="font-size:20px;text-align:center;line-height:120px;width:100%;">Wait Please...</div>');

        var myvalue = this.st.el.attr('data-id');
		console.log('myvalue ' +myvalue);
		
		   var dataPassenger = this.st.el.attr('data-passenger');
		   console.log('dataPassenger ' +dataPassenger);

        var res = myvalue.split("|"); //alert(res);

        var n = res[0];       

        var trid = 'seatlayout'+res[0];

        var sdd = "<?php echo base64_encode($sid);?>";

        tripid = res[1];trvnm = res[2];bloc = res[3];btime = res[4];dloc = res[5];dtime = res[6];fare = res[7];busdesc = res[8];dur = res[9];

        $.ajax({url: "ajax_seat_layout.php?tnm="+trvnm+"&bl="+bloc+"&bt="+btime+"&dl="+dloc+"&dt="+dtime+"&f="+fare+"&bdesc="+busdesc+"&dur1="+dur+"&tid="+tripid+"&tripid="+tripid+"&j="+n+"&dataPassenger="+dataPassenger, success: function(result){

            $("#view-seats").html(result);

            }

          });

            this.st.mainClass = this.st.el.attr('data-effect');

        }

    },

    midClick: true



   });
   
   

 $(".popclose").click(function () {

      $(".mfp-close").click();

 });     
   
 /*********** Return Fligh *********/
 
 $('.popup-ajax2').magnificPopup({ 

    removalDelay: 500,

    closeBtnInside: true,

    callbacks: {

        beforeOpen: function(){

        $("#view-seats").html('<div style="font-size:50px;text-align:center;line-height:120px;width:100%;">Please Wait Seat Layout Opening...<i class="fa fa-spinner user-profile-statictics-icon"></i></div>');

       var myvalue = this.st.el.attr('data-id');
	   var dataPassenger = this.st.el.attr('data-passenger');
	   console.log('dataPassenger ' +dataPassenger);

        var res = myvalue.split("|"); //alert(res);

        var n = res[0];       

        var trid = 'seatlayout'+res[0];

        var sdd = "<?php echo base64_encode($sid);?>";

        tripid = res[1];trvnm = res[2];bloc = res[3];btime = res[4];dloc = res[5];dtime = res[6];fare = res[7];busdesc = res[8];dur = res[9];

        $.ajax({url: "ajax_seat_layout2.php?tnm="+trvnm+"&bl="+bloc+"&bt="+btime+"&dl="+dloc+"&dt="+dtime+"&f="+fare+"&bdesc="+busdesc+"&dur1="+dur+"&tid="+tripid+"&tripid="+tripid+"&j="+n+"&dataPassenger="+dataPassenger, success: function(result){

            $("#view-seats").html(result);

            }

          });

            this.st.mainClass = this.st.el.attr('data-effect');

        }

    },

    midClick: true



   });
   
     



});   

</script>


<script type="text/javascript">







//var hide = 0;



var sum=0;
var arr_seat=new Array();
function change_icon2(ac,n,am,dataPassenger){	

	//alert(dataPassenger);
	var totalAdult='<?php echo $_SESSION['ADT']; ?>';
	var totalChild='<?php echo $_SESSION['CHD']; ?>';
	//alert(dataPassenger);
	
	var dataPassArr = dataPassenger.split("_"); 
	var passenterType=dataPassArr[0];
	var passenterValue=dataPassArr[1];


	var seat = 'sl'+ac+'seat'+am+'amt'+n;   //  alert(seat);  
	$('#SeatPriceInn2').val(n);
	$('#SeatNoInn2').val(ac);
	
	// set seat adult wise 
	 if(passenterType=='seatAdult2' && passenterValue!='')
	 {
		 for(i=1;i<=totalAdult;i++)
		 {
		 	if(passenterValue==i)
			{
				$('#seatAdultPrice2'+i).val(n);
				$('#seatAdultCode2'+i).val(ac);
			}
					 
		 } 
		 
	}	
	
	// set seat adult wise 
	 if(passenterType=='seatChild2' && passenterValue!='')
	 {
		 for(i=1;i<=totalChild;i++)
		 {
		 	if(passenterValue==i)
			{
				$('#seatChildPrice2'+i).val(n);
				$('#seatChildCode2'+i).val(ac);
			}
					 
		 } 
		 
	}		
	
	allCalCulatedPrice();
	calculate_fare2(ac,n,am);
}


function change_icon(ac,n,am,dataPassenger){

	var totalAdult='<?php echo $_SESSION['ADT']; ?>';
	var totalChild='<?php echo $_SESSION['CHD']; ?>';
	
	var dataPassArr = dataPassenger.split("_"); 
	var passenterType=dataPassArr[0];
	var passenterValue=dataPassArr[1];
		
	var seat = 'sl'+ac+'seat'+am+'amt'+n;   //  alert(seat); 
	//alert(ac+' '+n+' '+am); 
	$('#SeatPriceInn').val(n);
	$('#SeatNoInn2').val(ac);
	
	//console.log('dataPassenger '+dataPassenger+' Total Adult '+'<?php echo $_SESSION['ADT']; ?>');
	
	// set seat adult wise 
	 if(passenterType=='seatAdult' && passenterValue!='')
	 {
		 for(i=1;i<=totalAdult;i++)
		 {
		 	if(passenterValue==i)
			{
				$('#seatAdultPrice'+i).val(n);
				$('#seatAdultCode'+i).val(ac);
			}
					 
		 } 
		 
	}
	
	
	// set seat adult wise 
	 if(passenterType=='seatChild' && passenterValue!='')
	 {
		 for(i=1;i<=totalChild;i++)
		 {
		 	if(passenterValue==i)
			{
				$('#seatChildPrice'+i).val(n);
				$('#seatChildCode'+i).val(ac);
			}
					 
		 } 
		 
	}	
	
	
	allCalCulatedPrice();
	calculate_fare(ac,n,am);
}



function calculate_fare(ac,n,am){ 
	
	var st= 'st'+ac;
	var hid_st= 'hid_st'+am;
	var amt= 'amt'+n;
	var hid_amt= 'hid_amt'+n; 
	var splits = st.split("st"); 
	var splitss = splits[1].split(","); 
	var hid_amt = hid_amt.split("hid_amt"); 

	var hid_amts = hid_amt[1].split(",");  

	$(".seatval").html(splitss);
	$(".seatvalamt").html(hid_amts);
	$('#seatval').val(splitss);
	$('#seatvalamt').val(hid_amts);
	


}



function calculate_fare2(ac,n,am){ 

	var st= 'st'+ac;
	var hid_st= 'hid_st'+am;
	var amt= 'amt'+n;
	var hid_amt= 'hid_amt'+n; 
	var splits = st.split("st"); 
	var splitss = splits[1].split(","); 
	var hid_amt = hid_amt.split("hid_amt"); 

	var hid_amts = hid_amt[1].split(",");  

	$(".seatval2").html(splitss);
	$(".seatvalamt2").html(hid_amts);
	$('#seatval2').val(splitss);
	$('#seatvalamt2').val(hid_amts);
	


}


function allCalCulatedPrice()
{
	var baseFarePrice=parseInt($('#baseFareInn').val());
	var TaxAndFee=parseInt($('#TaxAndFeeInn').val());
	
	var BaggageFeeInn=parseInt($('#BaggageFeeInn').val());
	var MealFeeInn=parseInt($('#MealFeeInn').val());
	var SeatPriceInn=parseInt($('#SeatPriceInn').val());
	
	var BaggageFeeInn2=parseInt($('#BaggageFeeInn2').val());
	var MealFeeInn2=parseInt($('#MealFeeInn2').val());
	var SeatPriceInn2=parseInt($('#SeatPriceInn2').val());
	
	var totalPricePay=baseFarePrice+TaxAndFee+BaggageFeeInn+MealFeeInn+BaggageFeeInn2+MealFeeInn2+SeatPriceInn+SeatPriceInn2;
	$('#totalAmountToPay').val(totalPricePay);
	$('#totalpayAmt').html(totalPricePay);
	

}


</script>	

<script>

$(document).ready(function(){ //alert("ghvh");

    $(".ret").click(function(){

        $(".shd").toggle(300);

    });

});

$(document).ready(function(){ //alert("ghvh");

    $(".msshdd").click(function(){

        $(".msshd").toggle(300);

    });

});

</script>

<script type="text/javascript">

$(document).ready(function($) {

    /*$("#adltmeal").change(function() {

        var adltmeal = $(this).val(); 

        var splits = adltmeal.split(","); 

        var mlamt = splits[2]; 

        var splitss = mlamt.split("INR");

        var mlamount = splitss[1].trim();  

        $("#mealval").html(adltmeal);

       var finalclientcost = Number($('#finalclientcost').val()); 

 

      if(mlamount >0){ 

          var finalclientcost = parseInt(finalclientcost);

          var mlamnt= parseInt(mlamount); 

          $('#displayprice').text(Number(finalclientcost+mlamnt)); 

          $('#finalclientcost').val(Number(finalclientcost+mlamnt)); 

      }

  });*/

  $(document).ready(function($) {

    $("#adltmeal").change(function() {

        var adltmeal = $(this).val(); //alert(search_id); exit;

         $(".admealbtn").show();

         $("#mealval").html(adltmeal);
		 
		 if(adltmeal.indexOf('INR') != -1){
			  adltmealArr = adltmeal.split("INR");
			  var adltmeal=adltmealArr[1].trim();
			  $('#MealFeeInn').val(adltmeal);				
	     }
		 

		  allCalCulatedPrice();

         

    });
	
	/* return flight */
	$("#adltmeal2").change(function() {

        var adltmeal = $(this).val(); //alert(search_id); exit;

         $(".admealbtn").show();

         $("#mealval2").html(adltmeal);
		  
		  if(adltmeal.indexOf('INR') != -1){
		  
			  adltmealArr = adltmeal.split("INR");
			  var adltmeal=adltmealArr[1].trim();
			  $('#MealFeeInn2').val(adltmeal);	
		  }
		  allCalCulatedPrice();		 

         

    });
	

});

     $("#childmeal").change(function() {

        var childmeal = $(this).val(); //alert(search_id); exit;

         $("#mealchildval").html(childmeal);

          $("#cdmealbtn").show();

    });
	
	/* return flight */
	$("#childmeal2").change(function() {

        var childmeal = $(this).val(); //alert(search_id); exit;

         $("#mealchildval2").html(childmeal);

          $("#cdmealbtn").show();

    });
	

});

$(document).ready(function($) {

   
    $("#adltbag").change(function() {

        var adltbag = $(this).val(); //alert(search_id); exit;

         $("#baggval").html(adltbag);

          $(".adbagbtn").show();
		   if(adltbag.indexOf('INR') != -1){
			  adltbagArr = adltbag.split("INR");
			  var adltbag=adltbagArr[1].trim();
			  $('#BaggageFeeInn').val(adltbag);	
		  }
		  allCalCulatedPrice();
		  

    });

    $("#childbag").change(function() {

        var childbag = $(this).val(); //alert(search_id); exit;

         $("#baggchildval").html(childbag);

         $("#cdbagbtn").show();

    });
	
	
/* return flight round */

    $("#adltbag2").change(function() {

        var adltbag2 = $(this).val(); //alert(search_id); exit;

         $("#baggval2").html(adltbag2);
         $(".adbagbtn").show();
		 
		  if(adltbag2.indexOf('INR') != -1){
		  
		  adltbagArr = adltbag2.split("INR");
		  var adltbag2=adltbagArr[1].trim();
		  $('#BaggageFeeInn2').val(adltbag2);
		  }	
		  allCalCulatedPrice();		 

    });

    $("#childbag2").change(function() {

        var childbag2 = $(this).val(); //alert(search_id); exit;

         $("#baggchildval2").html(childbag2);

         $("#cdbagbtn2").show();

    });	
	
	

});

</script>

<div class="mfp-with-anim mfp-hide mfp-dialog" style="max-width: 610px; border-radius: 10px; padding: 10px;" id="new-card-dialog">

  <div id="view-seats"></div>

</div>
