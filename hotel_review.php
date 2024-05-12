<?php 
include "inc.php"; 
include "config/logincheck.php"; 
$page='hotels';


$six_digit_random_number = random_int(100000, 999999);
$bookingServiceType='hotel';
$_SESSION['serviceId']=$six_digit_random_number;

$roomCount=$_REQUEST['empcount'];
$adultCount=$_REQUEST['ad'];
$childCount=$_REQUEST['cd'];

$requestDetail=json_decode($_SESSION['hotelSearchRequestSES'],true);
$roomGuestArr=$requestDetail['RoomGuests'];

$hotelResultInfo=$_SESSION['hotelResultInfo'];
$roomData=$_SESSION['roomData'];
$hotelBasicJsonArr=json_decode($_SESSION['hotelBasicJson'],true);

$roomArrayIndex=$_REQUEST['roomArrayIndex'];

$roomPriceSelected=$roomData[$roomArrayIndex];

/*echo "<pre>";
print_r($roomData[$roomArrayIndex]);*/

$roomPrice=$roomPriceSelected['Price']['RoomPrice'];
$Tax=$roomPriceSelected['Price']['Tax'];
$OtherCharges=$roomPriceSelected['Price']['OtherCharges'];
$PublishedPrice=$roomPriceSelected['Price']['PublishedPrice'];

$_SESSION['roomPriceOfRoom']=$roomPrice;
$_SESSION['TaxOfRoom']=$Tax;
$_SESSION['OtherChargesOfRoom']=$OtherCharges;
$_SESSION['PublishedPriceOfRoom']=$PublishedPrice;


  
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
.showonlyaftercheck{display:none;}

#steponeflightdetails{display:block;}
@media (max-width: 575.98px) {

  .mobilesettd {padding: 10px !important;margin: 0px 2px !important;}
  .mobilesettd td{font-size: 14px !important;}
  .mobilesettd td div{font-size: 14px !important;}
  .mobilesettd .check4{font-size: 10px !important;}
  .nightsp{white-space: nowrap !important;}
  .mbpading2{padding: 0px 10px !important;}

}

</style>
 

</head>

<body>

<?php include "header.php"; ?>

 
 


 


<div class="container mobilereviecnt" style="margin-top:80px; margin-bottom:20px;"> 
<form id="flightbookingsubmit" method="post" action="hotel-booking-action" >
<div class="row" id="bookingdatainfo">
<div class="col-9" style="min-height:500px;">

<div class="row">
<div class="col-12" style="position:relative; margin-bottom:20px;"  id="steponeflightdetails">
<h2>Review your Booking</h2>
 


<div class="card cardresult" style="width:100%;">
<div class="card-header">Hotel Information</div>
<div class="card-body">
<div class="detailscontent">
<div class="row">
<div class="col-12">

 
<div class="row multiflightbox">
<div class="col-8">
 <h4 style="margin-top: 10px;"><strong><?php echo stripslashes($hotelResultInfo['HotelName']); ?> <span class="starcatht" style="font-size:18px; color:#FF9900;"><?php for($i=1; $i<=$hotelResultInfo['StarRating']; $i++){ ?>
						 <i class="fa fa-star" aria-hidden="true"></i>
						   <?php } 
						   
						  
						   
						   ?></span></strong> </h4>
 <div style="font-size:12px; margin-bottom:20px;"><?php echo $_SESSION['HotelDestinationAddress']=$hotelResultInfo['Address']; ?> </div>

</div>

<div class="col-4" style="text-align:right;">
<img src="<?php echo $_REQUEST['hotelimg']; ?>" alt="" width="75" height="69"></div>

  
</div>
 
</div> 
<div class="card-body mobilesettd" style="background-color:#F8F8F8; padding:10px 15px;">

<table border="0" cellpadding="5" cellspacing="0">
  <tr>
    <td colspan="5" align="left" valign="top" style="font-size:20px; font-weight:700; color:#FF0000;"><?php echo $_SESSION['syshotelroomname']=$_REQUEST['RoomTypeName']; ?></td>
    </tr>
  <tr>
    <td align="left" valign="top"><div class="check4" style="font-size:12px; color:#999999;">CHECK IN</div>
	<div style="font-size:18px; color:#000000; font-weight:800;"><?php echo date('j F Y',strtotime($hotelBasicJsonArr['CheckIn'])); ?></div>
	<div style="font-size:12px; color:#999999;"><?php echo date('l',strtotime($hotelBasicJsonArr['CheckIn'])); ?></div>	</td>
    <td align="left" valign="middle" class="mbpading2" style="padding:0px 20px;"><div class="check4 nightsp"  style="padding: 4px 10px; font-size: 12px; border: 1px solid #ddd; background-color: #fff; border-radius: 22px;"><?php echo $_REQUEST['hotelnights']; ?> NIGHT(S)</div></td>
  <td align="left" valign="top"><div class="check4" style="font-size:12px; color:#999999;">CHECK OUT</div>
	<div style="font-size:18px; color:#000000; font-weight:800;"><?php echo date('j F Y',strtotime($hotelBasicJsonArr['CheckOut'])); ?></div>
	<div style="font-size:12px; color:#999999;"><?php echo date('l',strtotime($hotelBasicJsonArr['CheckOut'])); ?></div>	</td>
  <td align="left" valign="top" class="mbpading2"  style="padding:0px 30px;">&nbsp;</td>
  <td align="left" valign="middle" style="font-size:16px;"><strong><?php echo $hotelBasicJsonArr['TotalAdult']; ?></strong> Adults | <?php echo $hotelBasicJsonArr['TotalChild']; ?> Childs | <?php echo $hotelBasicJsonArr['TotalRoom']; 
  
   $_SESSION['hotelstarcategoryrating']=$hotelResultInfo['StarRating'];
   $_SESSION['hoteltotaladult']=$hotelBasicJsonArr['TotalAdult'];
   $_SESSION['hoteltotalchild']=$hotelBasicJsonArr['TotalChild'];
  
  ?> Rooms</td>
  </tr>
</table>

</div>
	
	
 



 
  
  

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
		   $room=1;
		   if(count($roomGuestArr)>0)
		   {
		   	  foreach($roomGuestArr as $roomGuestArrValue)			  
			  {	
			  	$adultCount=$roomGuestArrValue['NoOfAdults'];
				$childCount=$roomGuestArrValue['NoOfChild'];
				//$ChildAge=$roomGuestArrValue['ChildAge'];
			  	   
		    ?>
		   
              <h5 class="mb-4 text-dark font-weight-bold font-size-21" id="scroll-description" style="font-size: 14px; width: 100%; padding: 6px 18px; background-color: #f0f6fb;"><strong>Room - <?php echo $room; ?></strong></h5>
	 
			  <div class="row">
			 
			 <?php 
			  
			  for($a=1;$a<=$adultCount;$a++)
			  {
			  
			 ?>  
			   
			   <div class="col-sm-2 mb-2">
                <div class="js-form-message">
                  <label class="form-label"> Adult<?php echo $a;  ?> Title </label>
                  <select class="form-control validate1" name="titleAdt<?php echo $a; ?>" id="titleAdt<?php echo $a; ?>">
                    <option value="">Select</option>
                    <option value="Mr">Mr.</option>
                    <option value="Mrs">Mrs</option>
                    <option value="Ms">Ms.</option>
                  </select>
                </div>
              </div>
			  
			  
              <div class="col-sm-4 mb-4">
                <div class="js-form-message">
                  <label class="form-label"> First Name<?php echo $a;  ?>  </label>
                  <input type="text" class="form-control validate1" name="firstNameAdt<?php echo $a; ?>" id="firstNameAdt<?php echo $a; ?>" placeholder="" aria-label="" required
                                                data-msg="Please enter your first name."
                                                data-error-class="u-has-error"
                                                data-success-class="u-has-success" autocomplete="nope">
                </div>
              </div> 
			  
			  
              <div class="col-sm-4 mb-4">
                <div class="js-form-message">
                  <label class="form-label"> Last name<?php echo $a;  ?> </label>
                  <input type="text" class="form-control validate1" name="lastNameAdt<?php echo $a; ?>" id="lastNameAdt<?php echo $a; ?>" required
                                                data-msg="Please enter your last name."
                                                data-error-class="u-has-error"
                                                data-success-class="u-has-success" autocomplete="nope">
                  <input type="hidden" name="adtpaxType<?php echo $a; ?>" id="adtpaxType<?php echo $a; ?>" value="" >
                </div>
              </div>
		
			  
              <!-- End Input -->
              <div class="w-100"></div>
              <!-- Input -->
              <!-- End Input -->
       		<?php } ?>
			
			 <?php 
			 if($childCount>0)
			 { 
			 	  $ChildAgeArr=$roomGuestArrValue['ChildAge'];
				  for($c=1;$c<=$childCount;$c++)
				  {
				  
				 ?>  			
				   
				  <div class="col-sm-4 mb-4">
					<div class="js-form-message">
					  <label class="form-label">Child First Name<?php echo $c; ?> </label>
					  <input type="text" class="form-control validate1" name="firstNameChd<?php echo $c; ?>" id="firstNameChd<?php echo $c; ?>" placeholder="" aria-label="" required
													data-msg="Please enter your first name."
													data-error-class="u-has-error"
													data-success-class="u-has-success" autocomplete="nope">
					</div>
				  </div>
				  <!-- End Input -->
				  <!-- Input -->
				  <div class="col-sm-4 mb-4">
					<div class="js-form-message">
					  <label class="form-label">Child Last name<?php echo $c; ?> </label>
					  <input type="text" class="form-control validate1" name="lastNameChd<?php echo $c; ?>" id="lastNameChd<?php echo $c; ?>" required
													data-msg="Please enter your last name."
													data-error-class="u-has-error"
													data-success-class="u-has-success" autocomplete="nope">
													
					  <input type="hidden" name="ageChild<?php echo $c; ?>" id="ageChild<?php echo $c; ?>" value="<?php echo $ChildAgeArr[$c-1]; ?>" >
					  <input type="hidden" name="childpaxType<?php echo $c; ?>" id="childpaxType<?php echo $c; ?>" value="<?php echo $ChildAgeArr[$c-1]; ?>" >
					</div>
				  </div>
				 
				 <?php }
			 
			  } 
			 
			  ?>			  
			  
         
		 	  </div>
			  
<?php 
	$room++;
	} 

}
		?>
			  
			  
	<label style="padding-left: 37px; width: 100%; margin-bottom: 30px;"><input name="IsVoucherBooking" type="checkbox" value="1"  class="checkbox_check" style="width: 16px; left:15px; height: 16px; position: absolute;  "> Hold Booking</label>		  
		 
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
												      	<?php 
						$a=GetPageRecord('*','sys_userMaster','id="'.$_SESSION['agentUserid'].'" and (userType="client" or userType="agent")  ');   
						$websiteLoginuser=mysqli_fetch_array($a);
				 
						?>

                                                <input type="email" class="form-control validate1" name="email" id="email" placeholder="" aria-label="" required
                                                data-msg="Please enter a valid email address."
                                                data-error-class="u-has-error"
                                                data-success-class="u-has-success" autocomplete="nope" value="<?php echo $websiteLoginuser['email']; ?>">
                                            </div>
                                        </div>
                                        <!-- End Input -->

                                        <!-- Input -->
                                        <div class="col-sm-6 mb-4">
                                            <div class="js-form-message">
                                                <label class="form-label">
                                                    Phone
                                                </label>

                                                <input type="number" class="form-control validate1" id="userphone" name="phone" placeholder="" aria-label="" required
                                                data-msg="Please enter a valid phone number."
                                                data-error-class="u-has-error"
                                                data-success-class="u-has-success" autocomplete="nope"  value="<?php echo $websiteLoginuser['phone']; ?>">
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
Payments
</div>

<div class="row">
<?php if($LoginUserDetails['userType']=='agent'){ ?>
<div class="col-4"> 

<div style="padding: 40px 0px; text-align: center;  font-size: 30px; border-bottom-left-radius: 5px; <?php if($totalwalletBalance>=$basefare[1]){?>border-right: 2px solid #41e0d2; background-color: #e4f8ff; color:#02C4B0;<?php } else { ?>border-right: 2px solid #e04159; background-color: #ffe4e4;color:#c4021e;<?php } ?>">
<div style="font-weight:600; ">₹<?php echo round($totalwalletBalance); ?></div>
<div style="font-size:14px; color:#000000; "><strong>Your Wallet Balance</strong></div>
</div> 

</div>
<?php } ?>


<div class="col-<?php if($LoginUserDetails['userType']=='agent'){ ?>8<?php } else { ?>12<?php } ?>">
<div class="card-body">

<div style="padding-top:10px; padding-bottom:10px; font-size:14px;"><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp; By placing this order, you agree to our Terms Of Use and Privacy Policy</div>
<div style="margin-bottom:10px;">
<input name="termsofuse" type="checkbox" value="1" checked disabled="disabled"> I accept <a href="<?php echo $fullurl; ?>terms-conditions" target="_blank" style="text-decoration:underline;">terms & conditions</a>
</div>
<?php if($LoginUserDetails['userType']=='agent'){ ?>
<?php if($totalwalletBalance>=($roomPriceSelected['Price']['PublishedPrice'])){?>

 

<button type="button" class="btn btn-danger" onClick="payandbooknow();" >Pay Now ₹<?php $hotelCostdisplay=calculatehotelcost(encode($agentid),stripslashes($hotelResultInfo['HotelName']),$roomPriceSelected['Price']['PublishedPrice'],'0'); echo $hotelCostdisplay[2]; ?></button>

 

 
<input name="flightbooking" id="flightbooking" type="hidden" value="0">
<?php } else { ?>

<div style="padding-top:10px; padding-bottom:10px; font-size:14px; color:#CC0000;"><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp; You don't have sufficient balance.</div>
<?php } ?>

<?php }  ?>
 <?php if($LoginUserDetails['userType']!='agent'){ ?>
<a href="javascript:void(0);" onClick="payonlinenow();" id="payonlinebtn"><button type="button" class="btn btn-danger payonlinebtnmain" >Pay Online ₹<?php $hotelCostdisplay=calculatehotelcost(encode($agentid),stripslashes($hotelResultInfo['HotelName']),$roomPriceSelected['Price']['PublishedPrice'],'0'); echo $hotelCostdisplay[2]; ?></button></a>
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
    <td width="50%" align="right" style="padding:10px 0px; border-bottom:1px solid #ddd; font-size:14px;">₹<?php
	$hotelCostdisplay=calculatehotelcost(encode($agentid),stripslashes($hotelResultInfo['HotelName']),$roomPriceSelected['Price']['PublishedPrice'],'0');
	
	 echo round($roomPriceSelected['Price']['RoomPrice']); ?></td>
  </tr>
  
  <tr>
    <td align="left" style="padding:10px 0px; border-bottom:1px solid #ddd;">Tax</td>
    <td width="50%" align="right" style="padding:10px 0px; border-bottom:1px solid #ddd; font-size:14px;">₹<?php echo round($roomPriceSelected['Price']['Tax']); ?></td>
  </tr> 
  
   <tr>
    <td align="left" style="padding:10px 0px; border-bottom:1px solid #ddd;">Other Charges</td>
    <td width="50%" align="right" style="padding:10px 0px; border-bottom:1px solid #ddd; font-size:14px;">₹<?php echo round($hotelCostdisplay[1]+$roomPriceSelected['Price']['OtherCharges']); 
	
	$_SESSION['balancesheetothercharges']=round($hotelCostdisplay[1]+$roomPriceSelected['Price']['OtherCharges']);
	
	?></td>
  </tr>   
  

  


    <tr>
    <td align="left" style="padding:10px 0px; border-bottom:1px solid #ddd;">Amount to Pay</td>
 <td align="right" style="padding:10px 0px; border-bottom:1px solid #ddd; font-size:14px;">₹<span id="totalpayAmt"><?php echo $hotelCostdisplay[2]; $_SESSION['balancesheetamount']=$hotelCostdisplay[2]; ?></span></td>
  </tr>
</table>
 
</div>

</div>
 </div>
 
   </div>
					<input type="hidden" name="RoomIndex" id="RoomIndex" value="<?php echo $_REQUEST['RoomIndex']; ?>" >
					
					<!--<input type="hidden" name="tatp" id="tatp" value="<?php $hotelCostdisplay=calculatehotelcost(encode($agentid),stripslashes($hotelResultInfo['HotelName']),$roomPriceSelected['Price']['PublishedPrice'],'0'); echo $hotelCostdisplay[2]; ?>" >-->
					
					<input type="hidden" name="tatp" id="tatp" value="1" >
									<input type="hidden" name="RoomTypeCode" id="RoomTypeCode" value="<?php echo $_REQUEST['RoomTypeCode']; ?>" >
									<input type="hidden" name="RoomTypeName" id="RoomTypeName" value="<?php echo $_REQUEST['RoomTypeName']; ?>" >
									<input type="hidden" name="RatePlanCode" id="RatePlanCode" value="<?php echo $_REQUEST['RatePlanCode']; ?>" >
									
									<input type="hidden" name="BedTypeCode" id="BedTypeCode" value="" >
									<input type="hidden" name="SmokingPreference" id="SmokingPreference" value="<?php echo $_REQUEST['SmokingPreference']; ?>" >
									<input type="hidden" name="Supplements" id="Supplements" value="" >
									
									<input type="hidden" name="ResultIndex" id="ResultIndex" value="<?php echo  ($_REQUEST['ResultIndex']); ?>" >
									<input type="hidden" name="HotelCode" id="HotelCode" value="<?php echo ($_REQUEST['HotelCode']); ?>" >
									<input type="hidden" name="HotelName" id="HotelName" value="<?php echo $_REQUEST['HotelName']; ?>" >
									<input type="hidden" name="NoOfRooms" id="NoOfRooms" value="<?php echo $_REQUEST['NoOfRooms']; ?>" >
									<input type="hidden" name="ClientReferenceNo" id="ClientReferenceNo" value="" >
									<input type="hidden" name="IsVoucherBooking" id="IsVoucherBooking" value="" >

 
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
 
  function bookingFormSubmit(){
 $('#flightbooking').val('1');
 $('#flightbookingsubmit').submit(); 
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


 function allBookingSubmit(){
	 $("#flightbookingsubmit").submit();
 }




function payonlinenow(){
	$('#flightbooking').val('1');
	$('#bookingMethod').val('0');
 var totalAmountToPay=$('#tatp').val();
	//var totalAmountToPay=1;
	
	 var firstNameAdt = encodeURI($('#firstNameAdt1').val());
 var lastNameAdt = encodeURI($('#lastNameAdt1').val());
 var email = encodeURI($('#email').val());
 var userphone = encodeURI($('#userphone').val());
 
   

childWindow = window.open('online-recharge?b=1&bamount='+totalAmountToPay+'&firstNameAdt='+firstNameAdt+'&lastNameAdt='+lastNameAdt+'&email='+email+'&userphone='+userphone+'&z=<?php echo encode($_SESSION['agentUserid']); ?>&type=wallet&bType=<?php echo $_SESSION['serviceId']; ?>', '_blank');

}
</script>

<div class="mfp-with-anim mfp-hide mfp-dialog" style="max-width: 610px; border-radius: 10px; padding: 10px;" id="new-card-dialog">

  <div id="view-seats"></div>

</div>
<?php include "footerinc.php"; ?>