<?php 
include "inc.php"; 
include "agenturlinc.php"; 
include "config/mail.php"; 

$rs=GetPageRecord('*','sys_userMaster','id="'.$staticparentId.'" ');  

$AgentWebsiteData=mysqli_fetch_array($rs);

?>

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>




<?php

if($_POST['action']=='changePassword' && trim($_POST['oldPassword'])!=""){ 

 

$oldPassword=trim(addslashes($_POST['oldPassword']));

$newPassword=trim(addslashes($_POST['newPassword']));

$confirmPassword=trim(addslashes($_POST['confirmPassword']));







$rs=GetPageRecord('*','sys_userMaster','id="'.$_SESSION['agentUserid'].'"   and password="'.md5($oldPassword).'" '); 

if(mysqli_num_rows($rs)>0){

$LoginUserDetails=mysqli_fetch_array($rs); 



if($newPassword==$confirmPassword){





$namevalue ='password="'.md5($newPassword).'"';  

$where=' id="'.$_SESSION['agentUserid'].'"';

updatelisting('sys_userMaster',$namevalue,$where);



?>

<script> alert('Password Successfully Changed...!'); 

parent.redirectpage('settings');

</script>

<?php



}else{



?>

<script> alert('New Password and Confirm Password did not match...!');  

</script>

<?php



} 

 



}else{ 

?>

<script> alert('Old Password did not match...!');  

</script>

<?php



}

?>  



<?php 

exit();

}

















if($_POST['action']=='flightcancellation' && trim($_POST['id'])!=""){ 



 $namevalue ='flightBookingId="'.base64_decode(base64_decode($_POST['id'])).'",addDate="'.date('Y-m-d H:i:s').'",status=0';  

 $bookinglastId = addlistinggetlastid('ticketCancelRequest',$namevalue); 

?>

<script>

parent.$('#showflightbookingcancelaltion').hide();

parent.$('#showflightbookingcancelaltion').html('');

parent.$('#showflightbookingcancelaltionthanks').show();

</script>

<?php

}









if($_POST['action']=='submithotelenquiry' && trim($_POST['name'])!="" && trim($_POST['mobile'])!="" && trim($_POST['email'])!="" && trim($_POST['hotelName'])!="" && trim($_POST['roomName'])!=""){ 



 $namevalue ='name="'.addslashes($_POST['name']).'",mobile="'.addslashes($_POST['mobile']).'",email="'.addslashes($_POST['email']).'",notes="'.addslashes($_POST['notes']).'",hotelName="'.addslashes($_POST['hotelName']).'",roomName="'.addslashes($_POST['roomName']).'",room="'.addslashes($_POST['room']).'",adult="'.addslashes($_POST['adult']).'",child="'.addslashes($_POST['child']).'",startDate="'.date('Y-m-d',strtotime($_POST['startdate'])).'",endDate="'.date('Y-m-d',strtotime($_POST['enddate'])).'",city="'.addslashes($_POST['city']).'",addDate="'.date('Y-m-d H:i:s').'",agentId="'.$_SESSION['agentUserid'].'"';  

 $bookinglastId = addlistinggetlastid('hotelEnquiry',$namevalue); 

 

 

 

 

 

 $subject = 'New Enquiry Received For Hotel';

 



$mailbody=' <table border="1" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC">

  <tr>

    <td colspan="3" bgcolor="#F5F5F5"><strong>Hotel Enquiry</strong> </td>

  </tr>

  <tr>

    <td><strong>Name</strong></td>

    <td><strong>:</strong></td>

    <td>'.addslashes($_POST['name']).'</td>

  </tr>

  <tr>

    <td><strong>Phone</strong></td>

    <td><strong>:</strong></td>

    <td>'.addslashes($_POST['mobile']).'</td>

  </tr>

  <tr>

    <td><strong>Email</strong></td>

    <td><strong>:</strong></td>

    <td>'.addslashes($_POST['email']).'</td>

  </tr>

  <tr>

    <td><strong>Notes</strong></td>

    <td><strong>:</strong></td>

    <td>'.addslashes($_POST['notes']).'</td>

  </tr>

  <tr>

    <td><strong>Hotel</strong></td>

    <td><strong>:</strong></td>

    <td>'.addslashes($_POST['hotelName']).'</td>

  </tr>

  <tr>

    <td><strong>Room</strong></td>

    <td><strong>:</strong></td>

    <td>'.addslashes($_POST['roomName']).'</td>

  </tr>

  <tr>

    <td><strong>Hotel City </strong></td>

    <td><strong>:</strong></td>

    <td>'.addslashes($_POST['city']).'</td>

  </tr>

  <tr>

    <td><strong>No of rooms </strong></td>

    <td><strong>:</strong></td>

    <td>'.addslashes($_POST['room']).'</td>

  </tr>

  <tr>

    <td><strong>Adult</strong></td>

    <td><strong>:</strong></td>

    <td>'.addslashes($_POST['adult']).'</td>

  </tr>

  <tr>

    <td><strong>Child</strong></td>

    <td><strong>:</strong></td>

    <td>'.addslashes($_POST['child']).'</td>

  </tr>

  <tr>

    <td><strong>Checkin</strong></td>

    <td><strong>:</strong></td>

    <td>'.date('d-m-Y',strtotime($_POST['startdate'])).'</td>

  </tr>

  <tr>

    <td><strong>Checkout</strong></td>

    <td><strong>:</strong></td>

    <td>'.date('d-m-Y',strtotime($_POST['enddate'])).'</td>

  </tr>

  

</table>';



 

 

 

 

 

  sendmainmail($getcompanybasicinfo['email'],$subject,$mailbody);

 

?>

<script>

parent.$('#showflightbookingcancelaltion').hide();

parent.$('#showflightbookingcancelaltion').html('');

parent.$('#showflightbookingcancelaltionthanks').show();

</script>

<?php

}









if($_POST['action']=='submitpackageenquiry' && trim($_POST['name'])!="" && trim($_POST['mobile'])!="" && trim($_POST['email'])!="" && trim($_POST['citydestination'])!="" && trim($_POST['departureCity'])!=""){ 



 $namevalue ='name="'.addslashes($_POST['name']).'",mobile="'.addslashes($_POST['mobile']).'",email="'.addslashes($_POST['email']).'",packageName="'.addslashes($_POST['packageName']).'",citydestination="'.addslashes($_POST['citydestination']).'",departureCity="'.addslashes($_POST['departureCity']).'",departureDate="'.date('Y-m-d',strtotime($_POST['departuredate'])).'",addDate="'.date('Y-m-d H:i:s').'",agentId="'.$_SESSION['agentUserid'].'"';  

 $bookinglastId = addlistinggetlastid('packageEnquiry',$namevalue); 
 

 

 $subject = 'New Enquiry Received For Package';

 



$mailbody=' <table border="1" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC">

  <tr>

    <td colspan="3" bgcolor="#F5F5F5"><strong>Package Enquiry</strong> </td>

  </tr>

  <tr>

    <td><strong>Name</strong></td>

    <td><strong>:</strong></td>

    <td>'.addslashes($_POST['name']).'</td>

  </tr>

  <tr>

    <td><strong>Phone</strong></td>

    <td><strong>:</strong></td>

    <td>'.addslashes($_POST['mobile']).'</td>

  </tr>

  <tr>

    <td><strong>Email</strong></td>

    <td><strong>:</strong></td>

    <td>'.addslashes($_POST['email']).'</td>

  </tr>

  

   <tr>

    <td><strong>Package</strong></td>

    <td><strong>:</strong></td>

    <td>'.addslashes($_POST['packageName']).'</td>

  </tr>

  <tr>

    <td><strong>Destination</strong></td>

    <td><strong>:</strong></td>

    <td>'.addslashes($_POST['citydestination']).'</td>

  </tr>

  <tr>

    <td><strong>City of Departure</strong></td>

    <td><strong>:</strong></td>

    <td>'.addslashes($_POST['departureCity']).'</td>

  </tr>

  <tr>

    <td><strong>Date of Departure</strong></td>

    <td><strong>:</strong></td>

    <td>'.addslashes($_POST['departuredate']).'</td>

  </tr> 
  

</table>';
 

 

$to=$websitesetting['contactEmail'];  
 
send_attachment_mail_new('mohd.m.imran@gmail.com',$subject,$mailbody,$cc);

?>

<script>

parent.$('#showflightbookingcancelaltion').hide();

parent.$('#showflightbookingcancelaltion').html('');

parent.$('#showflightbookingcancelaltionthanks').show();

</script>

<?php

}






if($_REQUEST['action']=='onlineRecharge' && $_REQUEST['amount']!=""){

$amount=0;

if($_POST['pg_name']=="DC"){
	$amount=round($_REQUEST["amount"]+($_REQUEST["amount"]*0.0085));
}

if($_POST['pg_name']=="CC"){
	$amount=round($_REQUEST["amount"]+($_REQUEST["amount"]*0.019));
}

if($_POST['pg_name']=="MW"){
	$amount=round($_REQUEST["amount"]+($_REQUEST["amount"]*0.0175));
}

if($_POST['pg_name']=="NB"){
	$amount=round($_REQUEST["amount"]+17);
}

if($_POST['pg_name']=="UPI"){
	$amount=round($_REQUEST['amount']);
}

$note=addslashes($_REQUEST['notes']);

$token=rand(89898,543132113).strtotime(date('YmdHis'));

$booking_payment_type=addslashes($_REQUEST['booking_payment_type']);


$chkrow=GetPageRecord('*','onlineRechargeRequest','token="'.$token.'"'); 

$_SESSION['paymenttoken']=$token;

if(mysqli_num_rows($chkrow)==0){

$namevalue ='agentId="'.$_SESSION['agentUserid'].'",requestedAmount="'.$amount.'",note="'.$note.'",status="pending",bookingType="'.$_REQUEST["booking_payment_type"].'",serviceId="'.$_SESSION['serviceId'].'",merchant_param1="'.$_REQUEST["booking_payment_type"].'",merchant_param2="'.$token.'",merchant_param3="'.$_SESSION['agentUserid'].'",merchant_param4="'.$_SESSION['parentAgentId'].'",merchant_param5="'.$_SESSION['parentid'].'",dateAdded="'.date("Y-m-d H:i:s").'",token="'.$token.'",email="'.trim($_REQUEST['email']).'" ';

$txnID = addlistinggetlastid('onlineRechargeRequest',$namevalue);


$a=GetPageRecord('*','sys_userMaster','id="'.$_SESSION['websiteUserId'].'" ');   
$websiteLoginuser=mysqli_fetch_array($a);


$floatValue = number_format((float)$amount, 2, '.', '');  // return float
$_SESSION["txnID"]=encode($txnID);
$_SESSION["token"]=encode($token);
$_SESSION["amount"]=trim($floatValue);
$_SESSION["first_name"]=strip($_REQUEST['firstNameAdt']);
$_SESSION["last_name"]=strip($_REQUEST['lastNameAdt']);
$_SESSION["phone"]=strip($_REQUEST['userphone']);
$_SESSION["user_email"]=strip($_REQUEST['email']);
$_SESSION["show_payment_mode"]='';
$_SESSION["order_id"]=encode($txnID);
$_SESSION["token"]=$token;
$_SESSION["pg_name"]=$_POST['pg_name'];
header("Location:easebuzzPayment.php?actionType=".$_REQUEST["booking_payment_type"]);


exit();

}

}





if($_REQUEST['action']=='onlineRecharge______' && $_REQUEST['amount']!=""){

$amount=addslashes($_REQUEST['amount']);

$note=addslashes($_REQUEST['notes']);

$token=rand(89898,543132113).strtotime(date('YmdHis'));

$booking_payment_type=addslashes($_REQUEST['booking_payment_type']);



$chkrow=GetPageRecord('*','onlineRechargeRequest','token="'.$token.'"'); 

if(mysqli_num_rows($chkrow)==0){



$namevalue ='agentId="'.$_SESSION['agentUserid'].'",requestedAmount="'.$amount.'",note="'.$note.'",status="pending",bookingType="'.$_REQUEST["booking_payment_type"].'",serviceId="'.$_SESSION['serviceId'].'",merchant_param1="'.$_REQUEST["booking_payment_type"].'",merchant_param2="'.$token.'",merchant_param3="'.$_SESSION['agentUserid'].'",merchant_param4="'.$_SESSION['parentAgentId'].'",merchant_param5="'.$_SESSION['parentid'].'",dateAdded="'.date("Y-m-d H:i:s").'",token="'.$token.'" ';

$txnID = addlistinggetlastid('onlineRechargeRequest',$namevalue);

$floatValue = number_format((float)$amount, 2, '.', '');  // return float

$_SESSION["txnID"]=$txnID;
$_SESSION["amount"]=$amount;
$_SESSION["first_name"]=strip($LoginUserDetails['name']);
$_SESSION["last_name"]=strip($LoginUserDetails['lastName']);
$_SESSION["phone"]=strip($LoginUserDetails['phone']);
$_SESSION["user_email"]=strip($LoginUserDetails['email']);
$_SESSION["order_id"]=encode($txnID);
$_SESSION["token"]=$token;
?>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>

<img src="<?php echo $fullurl; ?>images/loading.gif" style="display: block; margin-left: auto; margin-right: auto;">
    <form id="redirectForm" name="redirectForm" method="post" action="<?php echo $fullurl; ?>request.php" style=" display:none;">
		<input type="hidden" name="appId" value="5290203b4f80dc816c8b1072720925"/>
		<input type="hidden" name="orderId" value="<?php echo $token; ?>"/>
		<input type="hidden" name="orderAmount" value="<?php echo trim($amount); ?>"/>
        <input type="hidden" name="orderCurrency" value="INR"/>
        <input type="hidden" name="orderNote" placeholder="<?php echo strip($notes); ?>"/>
        <input type="hidden" name="customerName" value="<?php echo strip($LoginUserDetails['firstName']); ?> <?php echo strip($LoginUserDetails['lastName']); ?>" />
        <input type="hidden" name="customerEmail" value="<?php echo strip($LoginUserDetails['email']); ?>"/>
		<input type="hidden" name="customerPhone" value="<?php echo strip($LoginUserDetails['phone']); ?>"/>
        <input class="form-control" name="returnUrl" value="https://pay.earnmytravel.com/response.php"/> 
        <input class="form-control" name="notifyUrl" value="https://pay.earnmytravel.com/response.php"/>
        <button type="submit" class="btn btn-primary btn-block" value="Pay">Submit</button>
      </form>

<script type="text/javascript">
document.redirectForm.submit();
</script>

<?php

exit();

}



}













/*

if($_POST['action']=='onlineRechargeFlightBook' && $_POST['amount']!=""){



$booking_payment_type=addslashes($_POST['booking_payment_type']);

$amount=addslashes($_POST['amount']);

$note=addslashes($_POST['notes']);

$token=addslashes($_POST['token']);



$chkrow=GetPageRecord('*','onlineRechargeRequest','token="'.$token.'"'); 

if(mysqli_num_rows($chkrow)==0){



$amount=round($_POST['amount']);



$namevalue ='agentId="'.$_SESSION['agentUserid'].'",requestedAmount="'.$amount.'",note="'.$note.'",status="pending",dateAdded="'.date("Y-m-d H:i:s").'",token="'.$token.'" ';

$txnID = addlistinggetlastid('onlineRechargeRequest',$namevalue);



$floatValue = number_format((float)$amount, 2, '.', '');  // return float



$_SESSION["txnID"]=encode($token);

$_SESSION["amount"]=trim($floatValue);

$_SESSION["first_name"]=strip($LoginUserDetails['name']);

$_SESSION["last_name"]=strip($LoginUserDetails['lastName']);

$_SESSION["phone"]=strip($LoginUserDetails['phone']);

$_SESSION["user_email"]=strip($LoginUserDetails['email']);

$_SESSION["show_payment_mode"]=$show_payment_mode;

$_SESSION["order_id"]=encode($token);

$_SESSION["token"]=$token;

header("Location:easebuzzPayment.php?actionType=".$_REQUEST["booking_payment_type"]);



exit();



}



}

*/













if($_POST['action']=='resetpassword' && trim($_POST['email'])!=""){  



$rs=GetPageRecord('*','sys_userMaster','  email="'.$_REQUEST['email'].'"  '); 

if(mysqli_num_rows($rs)>0){

$LoginUserDetails=mysqli_fetch_array($rs); 

 

$password=rand ( 10000000 , 99999999 );



$namevalue ='password="'.md5($password).'"';  

$where=' id="'.$LoginUserDetails['id'].'" ';

updatelisting('sys_userMaster',$namevalue,$where);

 

 $subject = 'Reset Password';

 

$ars=GetPageRecord('invoiceLogo','sys_userMaster','id=1');   
$companyLogoAdmin=mysqli_fetch_array($ars); 


$mailbody='
<div style="background-color:#f9f9f9; padding:30px 0px; width:100%;text-align:center;"> 
<div style="width:100%;  font-family:Arial, Helvetica, sans-serif;text-align:center;">

  <table width="600" border="0" align="center" cellpadding="30" cellspacing="0"   style="text-align:left;width:600px;  background-color:#FFFFFF; font-family:Arial, Helvetica, sans-serif;">
  
  <tr>
      <td colspan="3" align="center" bgcolor="#fff" style="background-color:#fff;  font-size:#000; font-size:26px;"><img src="'.$adminurl.'profilepic/'.stripslashes($companyLogoAdmin['invoiceLogo']).'" height="50" /></td>
      </tr>
    <tr>
      <td colspan="3" align="center" bgcolor="#e8f7ff" style="background-color:#e8f7ff;  font-size:#000; font-size:26px;">'.$subject.'</td>
      </tr>
    <tr>
      <td colspan="3" style="font-size:14px;"> <strong>Your updated login credentials</strong><br /> 
  <br />
 
      Login Page URL: <a href="'.$fullurl.'" target="_blank">'.$fullurl.'</a><br /> 
  <br /> 
      Username: '.stripslashes($LoginUserDetails['email']).'<br />  
      Password: '.$password.'<br />

  <br /> </td>
    </tr>
  </table>
</div>
</div>  

  ';


 
 

send_attachment_mail($fromemail,$LoginUserDetails['email'],$subject,$mailbody,$ccmail,$file_name);




} else {

?>

<script> alert('Email address not registered with us');  

</script>

<?php

exit();

}

 

 

 

 

 

?>

<script>

parent.$('.showflightbookingcancelaltion').hide();

parent.$('#showflightbookingcancelaltion').html('');

parent.$('#showflightbookingcancelaltionthanks').show();

</script>

<?php

}



if($_REQUEST['action']=='applycop' && $_REQUEST['id']!='' && $_REQUEST['bid']!='' && $_REQUEST['displayprice']!=''){



$id=decode($_REQUEST['id']);

$bid=decode($_REQUEST['bid']);



$a=GetPageRecord('*','couponCodeMaster','id="'.$id.'"'); 

$res=mysqli_fetch_array($a); 



$usage=GetPageRecord('id','flightBookingMaster','couponCode="'.$res["couponCode"].'"');

$total_usage=mysqli_num_rows($usage);



$minAmt=GetPageRecord('*','couponCodeMaster',' couponCode="'.$res["couponCode"].'" and featured="1" and status="1" and fromDate<="'.date('Y-m-d').'" and minAmount<="'.$_REQUEST['displayprice'].'" and useslimit>"'.$total_usage.'"');



if($res["useslimit"]>$total_usage && mysqli_num_rows($minAmt)>0){



if($res['discountType']==1){

$couponValue=trim(($res['discount']*$_REQUEST['displayprice'])/100);

}

if($res['discountType']==2){

$couponValue=$res['discount'];

}



$couponType=stripslashes($res['couponType']);

$couponCode=stripslashes($res['couponCode']);



$namevalue ='couponType="'.$couponType.'",discountType="'.$res['discountType'].'",couponCode="'.$couponCode.'",couponValue="'.$couponValue.'"';

$where='id="'.$bid.'"';

updatelisting('wig_flight_json_bkp',$namevalue,$where);

?>

<div style="font-size:14px; border:1px solid #6cf7c3; padding:15px; background-color:#effff6; margin-bottom:10px; overflow:hidden;">

<i class="fa fa-check-circle" aria-hidden="true" style="color:#339900;"></i> &nbsp;Congrats! You have availed a discount <?php if($res['couponType']==2){echo "(Cashback)";} ?>  of <?php echo $couponValue; ?> INR , TnC apply.

<!--<div style="overflow:hidden;">

<a href="#" onclick="removeapplycop();" style=" background-color:#CC0000; color:#fff; font-size:11px; padding:2px 10px; float:right;border-radius:2px;">Remove</a></div>-->

</div>



<script>

/*

$('#discountapply').text('<?php echo $couponValue; ?>');

$('#discountAmt').text('<?php echo $couponValue; ?>');

$('#arq').val('<?php echo ($_REQUEST['displayprice']-$couponValue)+202565517+202565517; ?>');

$('#totalpayAmt').text('<?php echo $_REQUEST['displayprice']-$couponValue; ?>');

$('#discountAmtDiv').show();

*/

</script>



<?php if($res['couponType']==1){ ?>

<script>

$('#totalpayAmt').text('<?php echo $_REQUEST['displayprice']-$couponValue; ?>');

$('#arq').val('<?php echo ($_REQUEST['displayprice']-$couponValue)+202565517+202565517; ?>');

$('#displayprice').text('<?php echo ($_REQUEST['displayprice']-$couponValue); ?>');

</script>

<?php } ?>



<?php if($res['couponType']==2){ ?>

o<script>

$('#totalpayAmt').text('<?php echo $_REQUEST['displayprice']; ?>');

$('#arq').val('<?php echo ($_REQUEST['displayprice'])+202565517+202565517; ?>');

$('#displayprice').text('<?php echo ($_REQUEST['displayprice']); ?>');

</script>

<?php } ?>



<script>

$('#couponCodeApply').val('<?php echo $couponCode; ?>');

$('#discountapply').text('<?php echo $couponValue; ?>');

$('#discountAmt').text('<?php echo $couponValue; ?>');

$('#discountAmtDiv').show();

</script>





<?php

}else{

$namevalue ='couponType="",discountType="",couponCode="",couponValue=""'; 

$where='id="'.$bid.'"';   

updatelisting('wig_flight_json_bkp',$namevalue,$where);

?>

<script>

$('#discountapply').text('');

$('#displayprice').text('');

$('#discountAmt').text('');

$('#discountAmtDiv').hide();

$('#totalpayAmt').text('<?php echo $_REQUEST['displayprice']; ?>');

$('#arq').val('<?php echo $_REQUEST['displayprice']+202565517+202565517; ?>');



alert('This Coupon is not valid or limit exceed...!');

</script>

<?php

}



} 



if($_REQUEST['action']=='removeapplycop' && $_REQUEST['id']!='' && $_REQUEST['bid']!='' && $_REQUEST['displayprice']!=''){



$id=decode($_REQUEST['id']);

$bid=decode($_REQUEST['bid']); 



$namevalue ='couponType="",discountType="",couponCode="",couponValue=""'; 

$where='id="'.$bid.'"';   

updatelisting('wig_flight_json_bkp',$namevalue,$where);



?> 



<script>

$('#couponCodeApply').val('');

$('#discountAmtDiv').hide();

$('#totalpayAmt').text('<?php echo $_REQUEST['displayprice']; ?>');

$('#displayprice').text('<?php echo ($_REQUEST['displayprice']); ?>');

$('#arq').val('<?php echo $_REQUEST['displayprice']+202565517+202565517; ?>');

</script>



<?php

} 





if($_REQUEST['action']=='applycopmanual' && $_REQUEST['couponcode']!='' && $_REQUEST['bid']!='' && $_REQUEST['displayprice']!=''){



$couponcode=trim($_REQUEST['couponcode']);

$bid=decode($_REQUEST['bid']);



$usage=GetPageRecord('id','flightBookingMaster','couponCode="'.$couponcode.'"');

$total_usage=mysqli_num_rows($usage);



$a=GetPageRecord('*','couponCodeMaster',' couponCode="'.$couponcode.'" and featured="1" and status="1" and fromDate<="'.date('Y-m-d').'" and minAmount<="'.$_REQUEST['displayprice'].'" and useslimit>"'.$total_usage.'"');

if(mysqli_num_rows($a)<1){

?>

<script>

alert('This Coupon is not valid...!');

</script>

<?php

exit();

}else{

$res=mysqli_fetch_array($a); 



if($res['discountType']==1){

$couponValue=trim(($res['discount']*$_REQUEST['displayprice'])/100);

}

if($res['discountType']==2){

$couponValue=$res['discount'];

}



$couponCode=stripslashes($res['couponCode']);

$couponValue=stripslashes($couponValue);



$namevalue ='couponType="'.$res['couponType'].'",discountType="'.$res['discountType'].'",couponCode="'.$couponCode.'",couponValue="'.$couponValue.'"';

$where='id="'.$bid.'"';   

updatelisting('wig_flight_json_bkp',$namevalue,$where);



?>

<div style="font-size:14px; border:1px solid #6cf7c3; padding:15px; background-color:#effff6; margin-bottom:10px; overflow:hidden;">

<i class="fa fa-check-circle" aria-hidden="true" style="color:#339900;"></i> &nbsp;Congrats! You have availed a discount <?php if($res['couponType']==2){echo "(Cashback)";} ?> of <?php echo $couponValue; ?> INR , TnC apply.

<!--<div style="overflow:hidden;">

<a href="#" onclick="removeapplycop();" style=" background-color:#CC0000; color:#fff; font-size:11px; padding:2px 10px; float:right;border-radius:2px;">Remove</a></div>-->

</div>



<script>

/*

$('#discountAmt').text('<?php echo $couponValue; ?>');

$('#totalpayAmt').text('<?php echo $_REQUEST['displayprice']-$couponValue; ?>');

$('#discountAmtDiv').show();

$('.appliedbtn').show();

$('.applybtn').hide(); 

$('#discountapply').text('<?php echo $couponValue; ?>');

$('#displayprice').text('<?php echo ($_REQUEST['displayprice']-$couponValue); ?>');

$('#arq').val('<?php echo ($_REQUEST['displayprice']-$couponValue)+202565517+202565517; ?>');

*/

</script>





<?php if($res['couponType']==1){ ?>

<script>

$('#totalpayAmt').text('<?php echo $_REQUEST['displayprice']-$couponValue; ?>');

$('#arq').val('<?php echo ($_REQUEST['displayprice']-$couponValue)+202565517+202565517; ?>');

$('#displayprice').text('<?php echo ($_REQUEST['displayprice']-$couponValue); ?>');

</script>

<?php } ?>



<?php if($res['couponType']==2){ ?>

<script>

$('#totalpayAmt').text('<?php echo $_REQUEST['displayprice']; ?>');

$('#arq').val('<?php echo ($_REQUEST['displayprice'])+202565517+202565517; ?>');

$('#displayprice').text('<?php echo ($_REQUEST['displayprice']); ?>');

</script>

<?php } ?>



<script>

$('#discountAmt').text('<?php echo $couponValue; ?>');

$('#discountAmtDiv').show();

$('.appliedbtn').show();

$('.applybtn').hide(); 

$('#couponCodeApply').val('<?php echo $couponCode; ?>');

$('#discountapply').text('<?php echo $couponValue; ?>');

</script>







<?php

}

} 













 

 

 

 

 

 if(trim($_POST['action'])=='addlandingpage' && trim($_POST['name'])!=''){  

 

 

$name=addslashes($_POST['name']);   

$bannerHeading=addslashes($_POST['bannerHeading']);  

$pageURL=str_replace(' ','-',addslashes($_POST['pageURL']));   

$bannerSubHeading=addslashes($_POST['bannerSubHeading']);    

$enquiryHeading=addslashes($_POST['enquiryHeading']);    

$enquirySubHeading=addslashes($_POST['enquirySubHeading']);    

$contactNumber=addslashes($_POST['contactNumber']);    

$emailId=addslashes($_POST['emailId']);    

$address=addslashes($_POST['address']);    

$mainHeading=addslashes($_POST['mainHeading']);     

$description=addslashes($_POST['description']);     

$leadSource=addslashes($_POST['leadSource']);     

$facebook=addslashes($_POST['facebook']);     

$instagram=addslashes($_POST['instagram']);     

$twitter=addslashes($_POST['twitter']);     

$youtube=addslashes($_POST['youtube']);     

$pinterest=addslashes($_POST['pinterest']);   

$metaTitle=addslashes($_POST['metaTitle']);   

$metaDescription=addslashes($_POST['metaDescription']);   

$metaKeyword=addslashes($_POST['metaKeyword']);   

$headerScript=addslashes($_POST['headerScript']);       

$footerScript=addslashes($_POST['footerScript']);      

$oldphoto=addslashes($_POST['bannerold']);     

$companyLogoold=addslashes($_POST['companyLogoold']);    

$status=addslashes($_POST['status']);        

$packages=addslashes($_POST['packages']);    

$editid=decode($_POST['editid']);

  

  

  

  

if($_FILES["banner"]["tmp_name"]!=""){ 

$rt=mt_rand().strtotime(date("YMDHis")); 

$companyLogoFileName=basename($_FILES['banner']['name']); 

$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION); 

$profilePhoto=time().$rt.'.'.$companyLogoFileExtension;  

move_uploaded_file($_FILES["banner"]["tmp_name"], "package_image/{$profilePhoto}");  

} 

if($profilePhoto==''){ 

$profilePhoto=$oldphoto; 

} 

  

  

  

  

if($_FILES["companyLogo"]["tmp_name"]!=""){ 

$rt=mt_rand().strtotime(date("YMDHis")); 

$companyLogoFileName=basename($_FILES['companyLogo']['name']); 

$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION); 

$profilePhotocompany=time().$rt.'.'.$companyLogoFileExtension;  

move_uploaded_file($_FILES["companyLogo"]["tmp_name"], "package_image/{$profilePhotocompany}");  

} 

if($profilePhotocompany==''){ 

$profilePhotocompany=$companyLogoold; 

} 

  



if($editid!=''){  



$namevalue ='name="'.$name.'",bannerHeading="'.$bannerHeading.'",bannerSubHeading="'.$bannerSubHeading.'",companyLogo="'.$profilePhotocompany.'",packages="'.$packages.'",enquiryHeading="'.$enquiryHeading.'",enquirySubHeading="'.$enquirySubHeading.'",contactNumber="'.$contactNumber.'",emailId="'.$emailId.'",address="'.$address.'",mainHeading="'.$mainHeading.'",description="'.$description.'",leadSource="'.$leadSource.'",facebook="'.$facebook.'",instagram="'.$instagram.'",twitter="'.$twitter.'",youtube="'.$youtube.'",pinterest="'.$pinterest.'",metaTitle="'.$metaTitle.'",metaDescription="'.$metaDescription.'",metaKeyword="'.$metaKeyword.'",headerScript="'.$headerScript.'",footerScript="'.$footerScript.'",pageURL="'.$pageURL.'",banner="'.$profilePhoto.'",status="'.$status.'",dateAdded="'.date('Y-m-d H:i:s').'",addedBy="'.$_SESSION['agentUserid'].'"';

$where='id="'.$editid.'"';    

updatelisting('landingPages',$namevalue,$where);  

  

} else {  

$namevalue ='name="'.$name.'",bannerHeading="'.$bannerHeading.'",bannerSubHeading="'.$bannerSubHeading.'",companyLogo="'.$profilePhotocompany.'",packages="'.$packages.'",enquiryHeading="'.$enquiryHeading.'",enquirySubHeading="'.$enquirySubHeading.'",contactNumber="'.$contactNumber.'",emailId="'.$emailId.'",address="'.$address.'",mainHeading="'.$mainHeading.'",description="'.$description.'",leadSource="'.$leadSource.'",facebook="'.$facebook.'",instagram="'.$instagram.'",twitter="'.$twitter.'",youtube="'.$youtube.'",pinterest="'.$pinterest.'",metaTitle="'.$metaTitle.'",metaDescription="'.$metaDescription.'",metaKeyword="'.$metaKeyword.'",headerScript="'.$headerScript.'",footerScript="'.$footerScript.'",pageURL="'.$pageURL.'",banner="'.$profilePhoto.'",status="'.$status.'",dateAdded="'.date('Y-m-d H:i:s').'",addedBy="'.$_SESSION['agentUserid'].'"';

addlistinggetlastid('landingPages',$namevalue);  

  

}  

 





?> 

<script> 

parent.redirectpage('landing-page'); 

</script> 

<?php 

}





















if($_POST['action']=='savechangequerystatus' && $_POST['editid']!="" && $_POST['status']!="" && $_POST['statusname']!=""){



$comment=addslashes($_POST['comment']);

$status=addslashes($_POST['status']); 

$editid=addslashes($_POST['editid']); 

$closureReasons=addslashes($_POST['closureReasons']); 

  

if($closureReasons!=''){

$closureReasons=$closureReasons;











//------------Send Mail--------------------





$rs7=GetPageRecord('*','queryMaster','   id="'.decode($editid).'" '); 

$res=mysqli_fetch_array($rs7);



$a=GetPageRecord('*','emailTemplates','  emailTemplateType="Lead Closer"'); 

$resTemplate=mysqli_fetch_array($a);



$subject=queryreplacetags(decode($editid),stripslashes($resTemplate['emailSubject']));

$description=queryreplacetags(decode($editid),stripslashes($resTemplate['emailContent']));

 

$ccmail=''; 

$attachment='';



//send_attachment_mail($frommail,$res['contactEmail'],$subject,$description,$ccmail,$attachment);



//------------Send Mail--------------------







} else {

$closureReasons=0;

}



if($editid!=''){



//-------EDIT-----------



$namevalue ='status="'.decode($status).'",editDate="'.date('Y-m-d H:i:s').'",editBy="'.$_SESSION['agentUserid'].'",closureReasons="'.$closureReasons.'"';  

$where='  id="'.decode($editid).'"';   

updatelisting('queryMaster',$namevalue,$where); 



$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='query',sectionId='".decode($editid)."',details='Query Status Changed To ".str_replace('%20',' ',$_POST['statusname'])."',userId='".$_SESSION['agentUserid']."',parentId='".$LoginUserDetails['parentId']."',comment='".$_POST['comment']."',addDate='".time()."'";   



}  

 

mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 



 



?>

<script> 

parent.redirectpage('query-view?id=<?php echo $_POST['editid']; ?>&<?php if($editid!=''){ echo 'save=1'; } ?>');

</script>



<?php

exit();

}











if($_POST['action']=='savequerynote' && $_POST['editid']!="" && $_POST['comment']!=""){



$comment=addslashes($_POST['comment']); 

$editid=addslashes($_POST['editid']); 





  



if($editid!=''){



//-------EDIT-----------







$namevalue ='comment="'.$comment.'",queryId="'.decode($editid).'",parentId="'.$LoginUserDetails['parentId'].'",addDate="'.date('Y-m-d H:i:s').'",addBy="'.$_SESSION['agentUserid'].'"';   

$lastid=addlistinggetlastid('queryNote',$namevalue);  



$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='query',sectionId='".decode($editid)."',details='Query Note Added',userId='".$_SESSION['agentUserid']."',parentId='".$LoginUserDetails['parentId']."',addDate='".time()."'";   



mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 





$namevalue ='editDate="'.date('Y-m-d H:i:s').'",editBy="'.$_SESSION['agentUserid'].'"';  

$where='parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($editid).'"';   

updatelisting('queryMaster',$namevalue,$where); 

}  

 



 



?>

<script>

parent.redirectpage('query-view?id=<?php echo $_POST['editid']; ?>&<?php if($editid!=''){ echo 'save=1'; } ?>');

</script>



<?php

exit();

}

















if($_POST['action']=='fixedMarkupAgent'){



$count=count($_REQUEST["flightId"]);



if($count>0){

	mysqli_query(db(),'delete from fixedMarkupAgent where agentId="'.$_SESSION['agentUserid'].'"');

}







for($i=0;$i<$count;$i++){

	

	$flightId=$_REQUEST["flightId"][$i];

	$type=$_REQUEST["type"][$i];

	$value=$_REQUEST["value"][$i];

$namevalue='flightId="'.$flightId.'",type="'.$type.'",value="'.$value.'",agentId="'.$_SESSION['agentUserid'].'",dateAdded="'.date('Y-m-d H:i:s').'",addedBy="'.$_SESSION['agentUserid'].'"';

$lastid=addlistinggetlastid('fixedMarkupAgent',$namevalue);



}

?>

<script>

location.href='<?php echo $fullurl; ?>settings';

</script>

<?php

exit();

}













if($_POST['action']=='savequery'  && $_POST['contactNumber']!="" && $_POST['contactEmail']!="" && $_POST['nameHead']!="" && $_POST['contactPerson']!="" && $_POST['contactCountry']!="" && $_POST['travelFromCity']!="" && $_POST['travelLocation']!="" && $_POST['startDate']!="" && $_POST['endDate']!=""){



$queryType=addslashes($_POST['queryType']);

$contactNumber=addslashes($_POST['contactNumber']);

$contactEmail=addslashes($_POST['contactEmail']);

$companyName=addslashes($_POST['companyName']);

$nameHead=addslashes($_POST['nameHead']);

$contactPerson=addslashes($_POST['contactPerson']);

$contactCountry=addslashes($_POST['contactCountry']);

$contactState=addslashes($_POST['contactState']);

$contactCity=addslashes($_POST['contactCity']);

$travelFromCity=$_POST['travelFromCity'];

$travelLocation=$_POST['travelLocation'];

$startDate=date('Y-m-d',strtotime($_POST['startDate']));

$endDate=date('Y-m-d',strtotime($_POST['endDate']));

$adult=addslashes($_POST['adult']);

$child=addslashes($_POST['child']);

$infant=addslashes($_POST['infant']);

$querySource=addslashes($_POST['querySource']);

$queryPriority=addslashes($_POST['queryPriority']);

$assignTo=addslashes($_POST['assignTo']);

$typePackage=addslashes($_POST['typePackage']);

$typeFlight=addslashes($_POST['typeFlight']);

$typeTransfer=addslashes($_POST['typeTransfer']);

$typeHotel=addslashes($_POST['typeHotel']);

$typeSightseeing=addslashes($_POST['typeSightseeing']);

$typeMiscellaneous=addslashes($_POST['typeMiscellaneous']);

$description=addslashes($_POST['description']);

 

$editid=addslashes($_POST['editid']);

$clientId=decode($_POST['clientId']);

$queryStage=decode($_POST['queryStage']);

 

 

$rs7=GetPageRecord('*','clientMaster',' parentId="'.$LoginUserDetails['parentId'].'" and (phone="'.trim($contactNumber).'" or email="'.trim($contactEmail).'") order by id desc limit 0,1 '); 

$checkclient=mysqli_fetch_array($rs7);





$clientId=$checkclient['id'];



if($checkclient['id']!=''){



$namevalue ='companyName="'.$companyName.'",nameHead="'.$nameHead.'",name="'.$contactPerson.'",phone="'.$contactNumber.'",email="'.$contactEmail.'",clientCountry="'.$contactCountry.'",clientState="'.$contactState.'",clientCity="'.$contactCity.'",editBy="'.$_SESSION['agentUserid'].'",editDate="'.date('Y-m-d H:i:s').'"'; 



$where='parentId="'.$LoginUserDetails['parentId'].'" and id="'.$clientId.'"';   

updatelisting('clientMaster',$namevalue,$where); 



$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='client',sectionId='".$checkclient['id']."',details='".$contactPerson." Client Updated',userId='".$_SESSION['agentUserid']."',parentId='".$LoginUserDetails['parentId']."',addDate='".time()."'";   



} else { 



$namevalue ='clientType="'.$queryType.'",companyName="'.$companyName.'",nameHead="'.$nameHead.'",name="'.$contactPerson.'",phone="'.$contactNumber.'",email="'.$contactEmail.'",clientCountry="'.$contactCountry.'",clientState="'.$contactState.'",clientCity="'.$contactCity.'",addBy="'.$_SESSION['agentUserid'].'",addDate="'.date('Y-m-d H:i:s').'",parentId="'.$LoginUserDetails['parentId'].'"'; 

 

$clientId=addlistinggetlastid('clientMaster',$namevalue); 



$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='client',sectionId='".$clientId."',details='".$contactPerson." Client Added',userId='".$_SESSION['agentUserid']."',parentId='".$LoginUserDetails['parentId']."',addDate='".time()."'"; 



}



 



if($editid!=''){



//-------EDIT-----------



$namevalue ='contactNumber="'.$contactNumber.'",contactEmail="'.$contactEmail.'",companyName="'.$companyName.'",nameHead="'.$nameHead.'",contactPerson="'.$contactPerson.'",contactCountry="'.$contactCountry.'",contactState="'.$contactState.'",contactCity="'.$contactCity.'",travelFromCity="'.$travelFromCity.'",travelLocation="'.$travelLocation.'",startDate="'.$startDate.'",endDate="'.$endDate.'",adult="'.$adult.'",child="'.$child.'",infant="'.$infant.'",querySource="'.$querySource.'",queryPriority="'.$queryPriority.'",assignTo="'.$assignTo.'",typePackage="'.$typePackage.'",typeFlight="'.$typeFlight.'",typeTransfer="'.$typeTransfer.'",typeHotel="'.$typeHotel.'",description="'.$description.'",typeSightseeing="'.$typeSightseeing.'",typeMiscellaneous="'.$typeMiscellaneous.'",editBy="'.$_SESSION['agentUserid'].'",editDate="'.date('Y-m-d H:i:s').'"'; 



$where='  id="'.decode($editid).'"';   

updatelisting('queryMaster',$namevalue,$where); 



$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='query',sectionId='".decode($editid)."',details='#".$editid." Query Updated',userId='".$_SESSION['agentUserid']."',parentId='".$LoginUserDetails['parentId']."',addDate='".time()."'";   



} else { 



//-------ADD-----------



$namevalue ='queryType="'.$queryType.'",contactNumber="'.$contactNumber.'",clientId="'.$clientId.'",contactEmail="'.$contactEmail.'",companyName="'.$companyName.'",nameHead="'.$nameHead.'",contactPerson="'.$contactPerson.'",contactCountry="'.$contactCountry.'",contactState="'.$contactState.'",contactCity="'.$contactCity.'",travelFromCity="'.$travelFromCity.'",travelLocation="'.$travelLocation.'",startDate="'.$startDate.'",endDate="'.$endDate.'",adult="'.$adult.'",child="'.$child.'",infant="'.$infant.'",querySource="'.$querySource.'",queryPriority="'.$queryPriority.'",assignTo="'.$assignTo.'",typePackage="'.$typePackage.'",typeFlight="'.$typeFlight.'",typeTransfer="'.$typeTransfer.'",typeHotel="'.$typeHotel.'",typeSightseeing="'.$typeSightseeing.'",typeMiscellaneous="'.$typeMiscellaneous.'",status="'.$queryStage.'",addBy="'.$_SESSION['agentUserid'].'",description="'.$description.'",addDate="'.date('Y-m-d H:i:s').'",parentId="'.$LoginUserDetails['parentId'].'"'; 



$lastid=addlistinggetlastid('queryMaster',$namevalue);   



$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='query',sectionId='".$lastid."',details='#".encode($lastid)." Query Added',userId='".$_SESSION['agentUserid']."',parentId='".$LoginUserDetails['parentId']."',addDate='".time()."'";

















//------------Send Mail To User--------------------



$a=GetPageRecord('*','emailTemplates',' parentId="'.$LoginUserDetails['parentId'].'"  and emailTemplateType="Assigned Query"'); 

$resTemplate=mysqli_fetch_array($a);



$subject=queryreplacetags($lastid,stripslashes($resTemplate['emailSubject']));

$description=queryreplacetags($lastid,stripslashes($resTemplate['emailContent']));

 

$ccmail=''; 

$attachment='';



$rs7=GetPageRecord('*','sys_userMaster','  id="'.$assignTo.'"'); 

$res=mysqli_fetch_array($rs7);



send_attachment_mail($frommail,$res['email'],$subject,$description,$ccmail,$attachment);



//------------Send Mail To User--------------------











//------------Send Mail To Client--------------------



$a=GetPageRecord('*','emailTemplates','   emailTemplateType="New Lead"'); 

$resTemplate=mysqli_fetch_array($a);



$subject=queryreplacetags($lastid,stripslashes($resTemplate['emailSubject']));

$description=queryreplacetags($lastid,stripslashes($resTemplate['emailContent']));

 

$ccmail=''; 

$attachment=''; 



send_attachment_mail($frommail,trim($contactEmail),$subject,$description,$ccmail,$attachment);



//------------Send Mail To Client--------------------



}





 

mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 



 



?>

<script>

parent.redirectpage('querylist?<?php if($editid!=''){ echo 'save=1'; } else { echo 'added=1'; } ?>');

</script>



<?php

exit();

}











if(trim($_POST['action'])=='savemailsetting' && trim($_POST['fromName'])!='' && trim($_POST['emailAccount'])!='' && trim($_POST['emailPassword'])!='' && trim($_POST['smtpServer'])!='' && trim($_POST['emailPort'])!=''){ 

 



$fromName=$_POST['fromName'];  

$emailAccount=$_POST['emailAccount'];  

$emailPassword=$_POST['emailPassword'];  

$smtpServer=$_POST['smtpServer'];  

$emailPort=$_POST['emailPort'];  

$securityType=$_POST['securityType'];  



$namevalue ='fromName="'.$fromName.'",emailAccount="'.$emailAccount.'",emailPassword="'.$emailPassword.'",smtpServer="'.$smtpServer.'",emailPort="'.$emailPort.'",securityType="'.$securityType.'"'; 

$where='id="'.$_SESSION['agentUserid'].'"';    

updatelisting('sys_userMaster',$namevalue,$where); 



 



?> 

<script>   

parent.redirectpage('my-profile'); 

</script> 

<?php  } 









if($_REQUEST['action']=='additinerary' && $_REQUEST['quotationtype']!=""){



$queryid=addslashes($_REQUEST['queryid']); 

$quotationtype=addslashes($_REQUEST['quotationtype']); 

$editid=addslashes($_POST['editid']); 

 



if($editid!=''){ 

} else {





//-------------ADD-----------------



$namevalue ='startDate="'.date('Y-m-d').'",endDate="'.date('Y-m-d').'",adult=1,child=0,infant=0,quotationType="'.$quotationtype.'",addBy="'.$_SESSION['agentUserid'].'",addDate="'.date('Y-m-d H:i:s').'",parentId="'.$_SESSION['agentUserid'].'",dayWise=1'; 



$lastid=addlistinggetlastid('quotationMaster',$namevalue);  







if($_REQUEST['quotationtype']=='Detailed Package'){



$ha=GetPageRecord('*','packageTermsConditions','  parentId="'.$LoginUserDetails['parentId'].'" order by id asc');

while($listdata=mysqli_fetch_array($ha)){ 



$namevalue ='termType="'.$listdata['termType'].'",termDescription="'.addslashes($listdata['termDescription']).'",quotationId="'.$lastid.'",parentId="'.$_SESSION['agentUserid'].'"';  

addlistinggetlastid('quotationTerms',$namevalue); 



}









$ab=GetPageRecord('*','sys_branchMaster',' parentId="'.$LoginUserDetails['parentId'].'" and  id="'.$LoginUserDetails['branchId'].'" order by id asc '); 

$branchData=mysqli_fetch_array($ab);



$namevalue ='quotationId="'.$lastid.'",parentId="'.$_SESSION['agentUserid'].'",CGST="'.$branchData['taxName1'].'",SGST="'.$branchData['taxName2'].'",IGST="'.$branchData['taxName3'].'",TCS="'.$branchData['taxName4'].'",currencyId="'.$branchData['currency'].'"';  

addlistinggetlastid('sys_quickPackageOptions',$namevalue);  



}



 



$sql_insk="insert into sys_userLogs set  currentIp='".$_SERVER['REMOTE_ADDR']."',logType='query',sectionId='".$lastid."',details='#QT".encode($lastid)." Quotation Added in #".$queryid."',userId='".$_SESSION['agentUserid']."',parentId='".$_SESSION['agentUserid']."',addDate='".time()."'"; 

}

  



?>

<script>

parent.redirectpage('add-quotation?id=<?php echo encode($lastid); ?>&save=1');

</script>



<?php

exit();

}



























if($_POST['action']=='savedetailpackageotitle' && $_POST['name']!=""){



$startDate=date('Y-m-d',strtotime($_POST['startDate'])); 

$endDate=date('Y-m-d',strtotime($_POST['endDate'])); 

/*

$adult=addslashes($_POST['adult']); 

$child=addslashes($_POST['child']);

$infant=addslashes($_POST['infant']);  

*/

$showOnWebsite=addslashes($_POST['showOnWebsite']);  

$packageTheme=addslashes($_POST['packageTheme']);  



$name=addslashes($_POST['name']); 

$packageItinerary=addslashes($_POST['packageItinerary']); 

$editid=addslashes($_POST['editid']); 

$oldpackagebanner=addslashes($_POST['bannerImg']); 

$nights=round($_POST['nights']); 



if($_FILES["packagebanner"]["tmp_name"]!=""){  



$rt=mt_rand().strtotime(date("YMDHis")); 

$packagebannerFileName=basename($_FILES['packagebanner']['name']); 



$packagebannerFileExtension=pathinfo($packagebannerFileName, PATHINFO_EXTENSION);  

$packagebanner=time().$rt.'.'.$packagebannerFileExtension; 



move_uploaded_file($_FILES["packagebanner"]["tmp_name"], "upload/{$packagebanner}"); 

}



if($packagebanner==''){ 

$packagebanner=$oldpackagebanner; 

}





//$destination = implode(',',$_POST['pickupCityfromCity']);

$destination = $_POST['cityName'];



$weekendGatewayLocationId=addslashes($_POST['weekendGatewayLocationId']);

$flighticon = $_POST['flighticon'];

$hotelicon = $_POST['hotelicon'];

$sightseeingicon = $_POST['sightseeingicon'];

$transfericon = $_POST['transfericon'];

$activityicon = $_POST['activityicon'];

$cruiseicon = $_POST['cruiseicon'];







$rs5=GetPageRecord('*','quotationMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.decode($editid).'" '); 

$editresult=mysqli_fetch_array($rs5);



if($editresult['queryId']==0){

$namevalue ='name="'.$name.'",bannerImg="'.$packagebanner.'",packageItinerary="'.$packageItinerary.'",packageTheme="'.$packageTheme.'",destination="'.$destination.'",showOnWebsite="'.$showOnWebsite.'",nights="'.$nights.'",flighticon="'.$flighticon.'",hotelicon="'.$hotelicon.'",sightseeingicon="'.$sightseeingicon.'",transfericon="'.$transfericon.'",activityicon="'.$activityicon.'",cruiseicon="'.$cruiseicon.'",weekendGatewayLocationId="'.$weekendGatewayLocationId.'"'; 

}else{

$namevalue ='name="'.$name.'",bannerImg="'.$packagebanner.'",packageItinerary="'.$packageItinerary.'",startDate="'.$startDate.'",endDate="'.$endDate.'",packageTheme="'.$packageTheme.'",nights="'.$nights.'",destination="'.$destination.'",showOnWebsite="'.$showOnWebsite.'",flighticon="'.$flighticon.'",hotelicon="'.$hotelicon.'",sightseeingicon="'.$sightseeingicon.'",transfericon="'.$transfericon.'",activityicon="'.$activityicon.'",cruiseicon="'.$cruiseicon.'",weekendGatewayLocationId="'.$weekendGatewayLocationId.'"'; 

}

$where='parentId="'.$_SESSION['agentUserid'].'" and id="'.decode($editid).'"';   

updatelisting('quotationMaster',$namevalue,$where);  



 



?>

<script>

parent.redirectpage('add-quotation?id=<?php echo $editid; ?>&save=1');

</script>



<?php

exit();

}







if($_POST['action']=='savequickpackageoptionpeice' && $_POST['editid']!="" && $_POST['quotationid']!=""){



$perAdult=addslashes($_POST['perAdult']); 

$perChild=addslashes($_POST['perChild']);

$quotationAdultMarkup=addslashes($_POST['quotationAdultMarkup']); 

$quotationChildMarkup=addslashes($_POST['quotationChildMarkup']); 

$currencyId=addslashes($_POST['currencyId']); 

$editid=addslashes($_POST['editid']); 



if($editid!=''){



//-------EDIT-----------

$namevalue ='currencyId="'.$currencyId.'",perAdult="'.$perAdult.'",perChild="'.$perChild.'",quotationAdultMarkup="'.$quotationAdultMarkup.'",quotationChildMarkup="'.$quotationChildMarkup.'",currencyId="'.$currencyId.'"';  





$where='id="'.decode($editid).'"';   

updatelisting('sys_quickPackageOptions',$namevalue,$where); 

 



}  

 



 



?>

<script>

parent.redirectpage('add-quotation?id=<?php echo $_POST['quotationid']; ?>&save=1'); 

</script>



<?php

exit();

}













if($_POST['action']=='savedaydetails' && $_POST['title']!="" && $_POST['description']!='' && $_POST['quotationid']!=''){



 

$title=addslashes($_POST['title']); 

$description=addslashes($_POST['description']); 

$editid=addslashes($_POST['editid']);  



$namevalue ='title="'.$title.'",description="'.$description.'",editBy="'.$_SESSION['userid'].'",editDate="'.date('Y-m-d H:i:s').'"'; 

$where='parentId="'.$_SESSION['agentUserid'].'" and id="'.decode($editid).'" and quotationId="'.decode($_REQUEST['quotationid']).'"';   

updatelisting('packageDays',$namevalue,$where);  



 



?>

<script>

parent.$('#loadingwhite').hide();

parent.$( ".close" ).trigger( "click" );

parent.selectthisday('<?php echo $_REQUEST['dayid']; ?>','<?php echo $_REQUEST['dayid']; ?>','<?php echo $_REQUEST['daydate']; ?>');



</script>



<?php

exit();

}





if($_POST['action']=='saveEventTermDescription' && $_POST['termType']!="" && $_POST['termType']!="" && $_POST['quotationid']!=""){



$termType=addslashes($_POST['termType']); 

$editid=addslashes($_POST['editid']); 

$termDescription=addslashes($_POST['termDescription']); 

$termDescription = preg_replace('/font-family.+?;/', "", $termDescription);

$termDescription = str_replace('font-family:',"", $termDescription);



$namevalue ='termType="'.$termType.'",termDescription="'.$termDescription.'"'; 

$where='parentId="'.$_SESSION['agentUserid'].'" and id="'.decode($editid).'"';   

updatelisting('quotationTerms',$namevalue,$where);  



 



?>

<script>

parent.redirectpage('add-quotation?id=<?php echo $_REQUEST['quotationid']; ?>&save=1');

</script>



<?php

exit();

}







if($_REQUEST['action']=='createflyer' && $_REQUEST['typevar']!='' && $_SESSION['agentUserid']!=''){ 

$typevar=$_REQUEST['typevar'];

$pageWidth='0px';

$pageHeight='0px';



if($typevar=='Instagram Story'){

$pageWidth='1080px';

$pageHeight='1920px';

}





if($typevar=='Instagram Post'){

$pageWidth='1080px';

$pageHeight='1080px';

}



if($typevar=='Facebook Post'){

$pageWidth='1200px';

$pageHeight='630px';

}

if($typevar=='Emailer'){

$pageWidth='800px';

$pageHeight='1000px';

}



if($pageWidth!='0px'){

 

$namevalue ='userId="'.$_SESSION['agentUserid'].'",projectType="'.trim($typevar).'",name="New Project",pageWidth="'.$pageWidth.'",pageHeight="'.$pageHeight.'",editDate="'.date('Y-m-d H:i:s').'",addDate="'.date('Y-m-d H:i:s').'"';   

$lastid=addlistinggetlastid('flyer_project',$namevalue); 



?>

<script>

window.location.href = "flyer-designer/edit-project.html?id=<?php echo encode($lastid); ?>";

</script>

<?php



}

}






if(trim($_POST['action'])=='saveaddcustomer' && trim($_POST['name'])!=''  && trim($_POST['lastName'])!='' ){ 
 

$name=stripslashes($_POST['name']);  
$nameHead=stripslashes($_POST['nameHead']); 

$email=stripslashes($_POST['email']); 
$phone=stripslashes($_POST['phone']); 
$meal=stripslashes($_POST['meal']);
$department=stripslashes($_POST['department']);
$designation=stripslashes($_POST['designation']);
$empid=stripslashes($_POST['empid']);


$lastName=stripslashes($_POST['lastName']);  
$gender=stripslashes($_POST['gender']);  
$dob=date('Y-m-d',strtotime($_POST['dob'])); 
$passportExpiry=date('Y-m-d',strtotime($_POST['passportExpiry']));  
$passportNo=stripslashes($_POST['passportNo']);   


if(decode($_REQUEST['editid'])>0){

$namevalue ='name="'.$name.'",lastName="'.$lastName.'",gender="'.$gender.'",email="'.$email.'",phone="'.$phone.'",designation="'.$designation.'",department="'.$department.'",empid="'.$empid.'",meal="'.$meal.'",dob="'.$dob.'",passportExpiry="'.$passportExpiry.'",passportNo="'.$passportNo.'",nameHead="'.$nameHead.'",addDate="'.date('Y-m-d').'"'; 
$where='agentId="'.$_SESSION['agentUserid'].'" and id="'.decode($_REQUEST['editid']).'"';  
updatelisting('clientMaster',$namevalue,$where); 

} else { 


$namevalue ='name="'.$name.'",lastName="'.$lastName.'",gender="'.$gender.'",email="'.$email.'",phone="'.$phone.'",designation="'.$designation.'",department="'.$department.'",empid="'.$empid.'",meal="'.$meal.'",dob="'.$dob.'",passportExpiry="'.$passportExpiry.'",passportNo="'.$passportNo.'",nameHead="'.$nameHead.'",agentId="'.$_SESSION['agentUserid'].'",addDate="'.date('Y-m-d').'"';   
addlistinggetlastid('clientMaster',$namevalue);  

}

 

?> 
<script>   
parent.window.location.href = "my-customer";
</script> 
<?php  }














if(trim($_POST['action'])=='saveaddcustomer123' && trim($_POST['name'])!=''  && trim($_POST['lastName'])!='' ){ 

 
$name=stripslashes($_POST['name']);  

$nameHead=stripslashes($_POST['nameHead']); 

$lastName=stripslashes($_POST['lastName']);  

$gender=stripslashes($_POST['gender']);  

$dob=date('Y-m-d',strtotime($_POST['dob'])); 

$passportExpiry=date('Y-m-d',strtotime($_POST['passportExpiry']));  

$passportNo=stripslashes($_POST['passportNo']);   





if(decode($_REQUEST['editid'])>0){



$namevalue ='firstName="'.$name.'",lastName="'.$lastName.'",gender="'.$gender.'",dob="'.$dob.'",passportExpiry="'.$passportExpiry.'",passportNumber="'.$passportNo.'",title="'.$nameHead.'",addDate="'.date('Y-m-d').'"'; 

$where=' id="'.decode($_REQUEST['editid']).'"';  

updatelisting('flightBookingPaxDetailMaster',$namevalue,$where); 



} else { 





$namevalue ='firstName="'.$name.'",lastName="'.$lastName.'",gender="'.$gender.'",dob="'.$dob.'",passportExpiry="'.$passportExpiry.'",passportNumber="'.$passportNo.'",title="'.$nameHead.'",agentId="'.$_SESSION['agentUserid'].'",addDate="'.date('Y-m-d').'"';   

addlistinggetlastid('flightBookingPaxDetailMaster',$namevalue);  



}



 



?> 

<script>   

parent.window.location.href = "my-customer";

</script> 

<?php  } 

if(trim($_REQUEST['action'])=='paymentGatewayPayment'  && trim($_REQUEST['type'])!='' ){

 

$rs=GetPageRecord('*','onlineRechargeRequest','agentId="'.$_SESSION['agentUserid'].'"  order by id desc');  
$getagent=mysqli_fetch_array($rs); 
  
 if($getagent['status']=='success' && $getagent['token']==$_SESSION['paymenttoken']){ 
 
if(trim($_REQUEST['totalAmountToPay'])<=round($totalwalletBalance)){  

 ?>
<script> 
bookingFormSubmit();
</script>
 <?php
 }
 }
 
}

















if(trim($_POST['action'])=='addflightbookingnote' && trim($_POST['details'])!=''  && trim($_POST['bookingid'])!=''){ 

 



$bookingid=decode($_POST['bookingid']);  

$details=stripslashes($_POST['details']);  





 

$namevalue ='bookingid="'.$bookingid.'",details="'.$details.'",agentId="'.$_SESSION['agentUserid'].'",addDate="'.date('Y-m-d H:i:s').'"';   

addlistinggetlastid('flightBookingNotes',$namevalue);  

 

 



?> 

<script>   

parent.window.location.href = "flight-booking-details?id=<?php echo $_POST['bookingid']; ?>";

</script> 

<?php  } 



 



if(trim($_POST['action'])=='flightbookingamendments' && trim($_POST['id'])!=''  && trim($_POST['amType'])!=''){ 

 



$bookingId=decode($_POST['id']);  

$amendmentType=stripslashes($_POST['amType']);  

$amPax=stripslashes($_POST['amPax']);  

$remarkDetails=stripslashes($_POST['remarkDetails']);  

$nextTravelDate=date('Y-m-d',strtotime($_POST['nextTravelDate']));  

$generationTime=date('Y-m-d H:i:s');   

$addBy=$_SESSION['agentUserid'];  



$selectedPax='';

foreach ( $_POST['amPax'] as $value ) {

   $selectedPax.=$value.',';

}



 

$namevalue ='bookingId="'.$bookingId.'",amendmentType="'.$amendmentType.'",assignedUser="'.$acountmanager['id'].'",remarkDetails="'.$remarkDetails.'",nextTravelDate="'.$nextTravelDate.'",generationTime="'.$generationTime.'",addBy="'.$addBy.'",selectedPax="'.$selectedPax.'"';

addlistinggetlastid('flightAmendments',$namevalue);  

 

 



?> 

<script>   

parent.window.location.href = "flight-booking-details?id=<?php echo $_POST['id']; ?>";

</script> 

<?php  } 





if(trim($_POST['action'])=='addpaymentrequest' && trim($_POST['requestedAmount'])!=''){ 



$requestedAmount=stripslashes($_POST['requestedAmount']);  

$paymentMode=stripslashes($_POST['paymentMode']); 

$referenceNumber=stripslashes($_POST['referenceNumber']);  

$note=stripslashes($_POST['note']);  



$sql='';



if($_FILES["attachment"]["tmp_name"]!=""){ 

$rt=mt_rand().strtotime(date("YMDHis")); 

$companyLogoFileName=basename($_FILES['attachment']['name']); 

$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION); 

$profilePhoto=time().$rt.'.'.$companyLogoFileExtension;  

move_uploaded_file($_FILES["attachment"]["tmp_name"], "masteradmin/upload/{$profilePhoto}");



$sql=',attachment="'.$profilePhoto.'"';

}



$namevalue ='requestedAmount="'.$requestedAmount.'",paymentMode="'.$paymentMode.'",referenceNumber="'.$referenceNumber.'",note="'.$note.'",agentId="'.$_SESSION['agentUserid'].'",addDate="'.date('Y-m-d').'" '.$sql.'';

addlistinggetlastid('offlineRechargeRequest',$namevalue);  





?> 

<script>   

parent.window.location.href = "topup-request?save=1";

</script> 

<?php

}



if($_POST['action']=='onlineRechargeFlightBook' && $_POST['amount']!=""){

$booking_payment_type=addslashes($_POST['booking_payment_type']);
$show_payment_mode=addslashes($_POST['pg_name']);
$amount=addslashes($_POST['amount']);
$note=addslashes($_POST['notes']);
$token=rand(89898,543132113).strtotime(date('YmdHis'));

$chkrow=GetPageRecord('*','onlineRechargeRequest','token="'.$token.'"'); 
if(mysqli_num_rows($chkrow)==0){





if($show_payment_mode=='DC' || $show_payment_mode=='CC' || $show_payment_mode=='NB' || $show_payment_mode=='UPI'){

if($show_payment_mode=='DC'){
$totalamount= round($amount); 
}
if($show_payment_mode=='CC'){
$totalamount= round($amount); 
}
if($show_payment_mode=='NB'){
$totalamount= round($amount); 
}
if($show_payment_mode=='UPI'){
$totalamount= round($amount); 
}



} else { 
exit();

}

$amount=round($_POST['amount']);





$_SESSION['serviceId']=decode($_POST['bType']);

$namevalue ='agentId="'.$_SESSION['agentUserid'].'",requestedAmount="'.$amount.'",note="'.$note.'",status="pending",dateAdded="'.date("Y-m-d H:i:s").'",token="'.$token.'",bookingType="'.$_POST['type'].'",serviceId="'.decode($_POST['bType']).'" ';
$txnID = addlistinggetlastid('onlineRechargeRequest',$namevalue);

$floatValue = number_format((float)$totalamount, 2, '.', '');  // return float

$_SESSION["txnID"]=encode($token);
$_SESSION["amount"]=trim($floatValue);
$_SESSION["balanceamount"]=trim($amount);
$_SESSION["first_name"]=strip($LoginUserDetails['name']);
$_SESSION["last_name"]=strip($LoginUserDetails['lastName']);
$_SESSION["phone"]=strip($LoginUserDetails['phone']);
$_SESSION["user_email"]=strip($LoginUserDetails['email']);
$_SESSION["show_payment_mode"]=$_REQUEST["pg_name"];
$_SESSION["order_id"]=encode($token);
$_SESSION["token"]=$token;
header("Location:easebuzzPayment.php?actionType=".$_REQUEST["booking_payment_type"]);

exit();

}

}



if($_POST['action']=='clientloginotpsend' && trim($_REQUEST['emailid'])!=""){  

 
 $subject = 'Login OTP';
 $otp = sprintf("%06d", mt_rand(1, 999999));
 $_SESSION['b2cloginotp']=$otp;
 $_SESSION['b2cloginemail']=$_REQUEST['emailid'];
 
 $ars=GetPageRecord('invoiceLogo','sys_userMaster','id=1');   
$companyLogoAdmin=mysqli_fetch_array($ars); 

$mailbody='

<div style="background-color:#f9f9f9; padding:30px 0px; width:100%;text-align:center;"> 
<div style="width:100%;  font-family:Arial, Helvetica, sans-serif;text-align:center;">

  <table width="600" border="0" align="center" cellpadding="30" cellspacing="0"   style="text-align:left;width:600px;  background-color:#FFFFFF; font-family:Arial, Helvetica, sans-serif;">
  
  <tr>
      <td colspan="3" align="center" bgcolor="#fff" style="background-color:#fff;  font-size:#000; font-size:26px;"><img src="'.$adminurl.'profilepic/'.stripslashes($companyLogoAdmin['invoiceLogo']).'" height="50" /></td>
      </tr>
    <tr>
      <td colspan="3" align="center" bgcolor="#e8f7ff" style="background-color:#e8f7ff;  font-size:#000; font-size:26px;">'.$subject.'</td>
      </tr>
    <tr>
      <td colspan="3" style="font-size:14px; text-align: center;">     
  <strong>Your Login OTP </strong><br />
  <br />
      
      <span style="border: 2px dashed #8de4c8; background-color: #e5fffc; font-size: 26px; padding: 16px; display: inline-block; line-height: 18px; font-weight: 600;">'.$otp.'</span>
	  
	  <br />
  <br /> </td>
    </tr>
  </table>
</div>
</div>  
 ';

 
  
send_attachment_mail($fromemail,trim($_REQUEST['emailid']),$subject,$mailbody,$ccmail,$file_name);
 


?>
<script> 
parent.loadclientloginbox(2); 
</script>
<?php


 }
 



 if($_POST['action']=='clientloginotpenter' && trim($_POST['loginotp'])!="" && trim($_POST['emailid'])!=""){  
 

 
 if($_SESSION['b2cloginotp']==$_REQUEST['loginotp']){
 
 
 
 
 $rs=GetPageRecord('*','sys_userMaster','email="'.trim($_POST['emailid']).'" '); 
if(mysqli_num_rows($rs)>0){
$userinfo=mysqli_fetch_array($rs); 

if($userinfo['userType']!='client'){
?>
<script>
alert('Invalid Login! Please try login as agent.');
</script>
<?php
exit();
}

 
//deleteRecord('sys_userLogs','DATE(addLastDate)<"'.date('Y-m-d',strtotime('-2 days')).'"'); 

$_SESSION['agentUserid']=$userinfo['id'];   
$_SESSION['websiteUserId']=$userinfo['id'];   
$_SESSION['parentAgentId']=$userinfo['parentAgentId'];  
$_SESSION['agentUsername']=$userinfo['email'];    
$_SESSION['parentid']=$userinfo['parentId'];  

//loginattampmail($userinfo['id'],$_POST['username']); 

//$sql_insk="insert into sys_userLogs set  currentIp='".$cip."',logType='login',details='Client Login',userId='".$userinfo['id']."',parentId='".$userinfo['id']."',addDate='".time()."'";  
//mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 
 
$rsa=GetPageRecord('*','sys_userMaster',"userType='b2cwebsite'");  
$groupdata=mysqli_fetch_array($rsa);
 
//$sql_ins="update sys_userMaster set onlineStatus=1,commissionType='".$groupdata['commissionType']."'  where id=".$_SESSION['agentUserid']." and userType='client'";  
//mysqli_query(db(),$sql_ins) or die(mysqli_error());  


?>
<script> 

parent.location.reload();

parent.$('#email').val('<?php echo $userinfo['email']; ?>');
parent.$('#userphone').val('<?php echo $userinfo['phone']; ?>');
parent.$('#email').removeAttr('onclick');
 
</script>
<?php
 
 
 } else { 
 
 
 
  ?>
<script> 
parent.loadclientloginbox(3); 
</script>
  <?php
 
 
 
 }
 
 
 
 
 
 
 } else {  ?>
 
 <script>
 parent.alert('Invalid OTP!');
 </script>
 
 
 <?php }
 
 
 }
 
 
 
 
 if($_POST['action']=='completeprofile' && trim($_POST['name'])!="" && trim($_POST['lastName'])!="" && trim($_POST['phone'])!=""){  
  
$name=stripslashes($_POST['name']);   
$lastName=stripslashes($_POST['lastName']);  
$phone=stripslashes($_POST['phone']);  
$email=stripslashes($_POST['emailid']);  
$commissionType=$websitedatauser['commissionType'];
$submitName=stripslashes($_POST['submitName']); 
$parentId=1;
$parentAgentId=1;

 $rs=GetPageRecord('commissionType','sys_userMaster','id=2');  
$getWebsiteAgent=mysqli_fetch_array($rs); 
$password=rand ( 10000000 , 99999999 );


 
$namevalue ='submitName="'.$submitName.'",firstName="'.$name.'",lastName="'.$lastName.'",password="'.md5($password).'",status=1,commissionType="'.$getWebsiteAgent['commissionType'].'",userType="client",phone="'.$phone.'",mobile="'.$phone.'",email="'.$email.'",dateAdded="'.date('Y-m-d H:i:s').'",addedBy=1';  
$bookinglastId = addlistinggetlastid('sys_userMaster',$namevalue);

 
$namevalue ='submitName="'.$submitName.'",firstName="'.$name.'",lastName="'.$lastName.'",password="'.md5($password).'",status=1,userType="4",phone="'.$phone.'",mobile="'.$phone.'",email="'.$email.'",dateAdded="'.date('Y-m-d H:i:s').'",addedBy=1';  
addlistinggetlastid('userMaster',$namevalue);

 

 
 $rs=GetPageRecord('*','sys_userMaster','id="'.$bookinglastId.'"');  
$userinfo=mysqli_fetch_array($rs); 

$_SESSION['agentUserid']=$userinfo['id'];   
$_SESSION['websiteUserId']=$userinfo['id'];   
$_SESSION['parentAgentId']=$userinfo['parentAgentId'];  
$_SESSION['agentUsername']=$userinfo['email'];    
$_SESSION['parentid']=$userinfo['parentId'];  
 
 

 
 $rs=GetPageRecord('*','sys_userMaster','id=1');  
$getlogo=mysqli_fetch_array($rs);  
 
 
$ccmail='';   
$file_name='';  
 

$subject = 'Login Details - '.strip($getlogo['companyName']).''; 


$mailbody='<div align="left">Dear '.$firstName.',<br /> 
          <br /> 
      Thank you for register with us.<br /> 
  <br /> 
  <strong>Your Login Credentials</strong><br /> 
  <br /> 
      Login Page URL: <a href="'.$fullurl.'" target="_blank">'.$fullurl.'</a><br /> 
  <br /> 
  
      Username: '.$email.'<br />  
      Password: '.$password.'<br /> 
  <br /> 

     <div style="padding:20px; margin-top:10px; background-color:#FFFFCC;"><strong>Note:</strong> Your account is under review process.</div> 

    </div> ';

 
 

send_attachment_mail($fromemail,$email,$subject,$mailbody,$ccmail,$file_name); 
 
 
?>
<script> 
parent.location.reload();
</script>
<?php
 
 }
 
 
 
  if($_POST['action']=='clientloginwithuserpassword' && trim($_POST['password'])!="" && trim($_POST['username'])!=""){
  
  
  
if($_POST['username']!='' && $_POST['password']!=''){ 

ini_set('max_execution_time', '300');  
 

$cip=$_SERVER['REMOTE_ADDR'];   
$clogin=date('Y-m-d H:i:s');   
$result =mysqli_query (db(),"select * from sys_userMaster where email='".$_POST['username']."' and  password='".md5($_POST['password'])."'  and (userType='client') ")  or die(mysqli_error());  
$number =mysqli_num_rows($result);   
if($number>0)  
{   

$select='';  
$where='';  
$rs='';  
$select='*'; 

$where="email='".$_POST['username']."' and  password='".md5($_POST['password'])."'";  
$rs=GetPageRecord($select,'sys_userMaster',$where);  
$userinfo=mysqli_fetch_array($rs); 

deleteRecord('sys_userLogs','DATE(addLastDate)<"'.date('Y-m-d',strtotime('-2 days')).'"'); 

$_SESSION['agentUserid']=$userinfo['id'];   
$_SESSION['parentAgentId']=$userinfo['parentAgentId'];  
$_SESSION['agentUsername']=$userinfo['email'];    
$_SESSION['parentid']=$userinfo['parentId'];  


$sql_insk="insert into sys_userLogs set  currentIp='".$cip."',logType='login',details='Client Login',userId='".$userinfo['id']."',parentId='".$userinfo['id']."',addDate='".time()."'";  
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 

  
$rsa=GetPageRecord('*','sys_userMaster',"userType='b2cwebsite'");  
$groupdata=mysqli_fetch_array($rsa);
 
$sql_ins="update sys_userMaster set onlineStatus=1,commissionType='".$groupdata['commissionType']."' where id=".$_SESSION['agentUserid']." and userType='client'";  
mysqli_query(db(),$sql_ins) or die(mysqli_error());  
?>
<script> 
parent.location.reload();
</script>
<script> 
<?php

exit();

} else {

?>
<script>
alert('Invalid Login!');
</script>

<?php

}
 
} 

  
  }









  
  if($_POST['action']=='editclientprofile' && trim($_POST['name'])!=""){  
 
 $name=addslashes($_REQUEST['name']);
 $lastName=addslashes($_REQUEST['lastName']);
 $dob=date('Y-m-d',strtotime($_REQUEST['dob']));
 $gender=addslashes($_REQUEST['gender']);
 $maritalStatus=addslashes($_REQUEST['maritalStatus']);
 $email=addslashes($_REQUEST['email']);
 $phone=addslashes($_REQUEST['phone']);
 
 
 
  $namevalue ='firstName="'.$name.'",dob="'.$dob.'",gender="'.$gender.'",maritalStatus="'.$maritalStatus.'",phone="'.$phone.'",lastName="'.$lastName.'"';  
$where=' id="'.$_SESSION['websiteUserId'].'"';
updatelisting('sys_userMaster',$namevalue,$where);


  $namevalue ='firstName="'.$name.'",dob="'.$dob.'",gender="'.$gender.'",maritalStatus="'.$maritalStatus.'",phone="'.$phone.'",lastName="'.$lastName.'"';  
$where=' email="'.$email.'"';
updatelisting('userMaster',$namevalue,$where);

?>

<script>
  parent.redirectpage('my-profile?a=1');
</script>

<?php

 
 }
 


if($_POST['action']=='addagentbranch' && $_POST['companyName']!="" && $_POST['gst']!="" && $_POST['gstMobile']!="" && $_POST['gstEmail']!="" && $_POST['state']!="" && $_POST['gstAddress']!=""){

$companyName=addslashes($_POST['companyName']);
$gst=addslashes($_POST['gst']);
$gstMobile=addslashes($_POST['gstMobile']);
$gstEmail=addslashes($_POST['gstEmail']);
$state=addslashes($_POST['state']);
$gstAddress=addslashes($_POST['gstAddress']); 
$editid=addslashes($_POST['editid']); 
$id=decode($_POST['id']); 

 

if($editid!=''){

//-------EDIT-----------

 $namevalue ='companyName="'.$companyName.'",gst="'.$gst.'",gstMobile="'.$gstMobile.'",gstEmail="'.$gstEmail.'",state="'.$state.'",gstAddress="'.$gstAddress.'"';  
$where='  id="'.($editid).'"';  
  
updatelisting('agentBranch',$namevalue,$where);  

} else { 

//-------ADD-----------

$namevalue ='companyName="'.$companyName.'",gst="'.$gst.'",gstMobile="'.$gstMobile.'",gstEmail="'.$gstEmail.'",state="'.$state.'",gstAddress="'.$gstAddress.'",agentId="'.$id.'"';  
addlistinggetlastid('agentBranch',$namevalue);   
 
}
 

 

?>
<script>
parent.window.location.href = "branches";
</script>

<?php

exit();
}
?>

<?php
if(trim($_POST['action'])=='deleteClients'){   
    deleteRecord('clientMaster','id="'.$_REQUEST['deleteId'].'" '); 
?> 
 <script> 
    parent.window.location.href = "my-customer";
 </script> 
<?php 
}

if(trim($_POST['action'])=='deletebranch'){   
    deleteRecord('agentBranch','id="'.$_REQUEST['deleteId'].'" '); 
?> 
 <script> 
    parent.window.location.href = "branches";
 </script> 
<?php 
}


