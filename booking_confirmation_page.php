<?php
include "config/database.php";  
include "config/function.php"; 
include "config/setting.php";  
 

$rs=GetPageRecord('*','hotelBookingMaster','id="'.base64_decode(base64_decode($_REQUEST['i'])).'"   '); 
$editresult=mysqli_fetch_array($rs);  


$rs7=GetPageRecord('*','sys_userMaster',' id in (select supplier  from hotelMaster where id in ( select HotelCode from hotelBookingMaster where id="'.$editresult['id'].'") ) ');  
$hotelhave=mysqli_fetch_array($rs7);


if($_POST['confirmationNo']!='' && $_POST['action']=='confirmHotelVoucher'){
$confirmationNo=trim(addslashes($_POST['confirmationNo']));  

$supplier=trim(addslashes($_POST['supplier']));  

$type=trim(addslashes($_POST['type']));  

$status=trim(addslashes($_POST['status']));  

$status=trim(addslashes($_POST['status']));  

$confirmedBy=trim(addslashes($_POST['confirmedBy']));  

$remark=trim(addslashes($_POST['remark']));  

$editid=$_POST['editid']; 


 

	$url="hotelBookings";

 



$namevalue ='confirmationNo="'.$confirmationNo.'",supplier="'.$supplier.'",remark="'.$remark.'",status="'.$status.'",confirmedBy="'.$confirmedBy.'",confirmedDate="'.date('Y-m-d H:i:s').'"';   
$where=' id="'.decode($_REQUEST['editid']).'"'; 
updatelisting('hotelBookingMaster',$namevalue,$where);


 
if($editresult['hotelRequest']==1 && $status==2){

$ag=GetPageRecord('*','hotelBookingMaster','id="'.$editresult['id'].'" '); 
$hotelbook=mysqli_fetch_array($ag);


$a ='bookingId="'.$hotelbook['BookingNumber'].'",bookingType="hotel",agentId="'.($hotelbook['agentId']).'",amount="'.round($hotelbook['agentTotalFare']-$hotelbook['agentMarukup']).'",paymentType="Debit",addedBy="'.$hotelbook['agentId'].'",addDate="'.date('Y-m-d H:i:s').'",billType="hotel"';
	addlistinggetlastid('sys_balanceSheet',$a);
 
}
 
 }


$rs=GetPageRecord('*','hotelBookingMaster','id="'.base64_decode(base64_decode($_REQUEST['i'])).'"   '); 
$editresult=mysqli_fetch_array($rs); 





function getagentbalance($id){
$totalwalletBalance=0; 
$totalwalletBalanceOffline=0; 
if($id>0){ 
$rs8=GetPageRecord('SUM(amount) as totalcreditAmt','sys_balanceSheet','agentId="'.$id.'" and paymentType="Credit" and offlineAgent=0 ');  
$agentCreditAmt=mysqli_fetch_array($rs8); 

$rs8=GetPageRecord('SUM(amount) as totaldebitAmt','sys_balanceSheet','agentId="'.$id.'" and paymentType="Debit" and offlineAgent=0 ');  
$agentDebitAmt=mysqli_fetch_array($rs8);  

return ($agentCreditAmt['totalcreditAmt']-$agentDebitAmt['totaldebitAmt']);
}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Booking Confirmation</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<link href="css/main.css" rel="stylesheet" type="text/css">
</head>

<body style="background-color:#F8F8F8;">
<div style="max-width:400px; padding:20px; border:1px solid #ddd; background-color:#FFFFFF; margin:auto; margin-top:50px;">
 
  <form action="" method="post" enctype="multipart/form-data" name="addeditfrm"  id="addeditfrm"> 



		 <div class="modal-body">	

<?php   if($editresult['status']==2){ ?>
<h1 style="color:#009900; text-align:center;">Booking Confirmed</h1>
<?php } else { ?>

<?php if(getagentbalance($editresult['agentId'])>round($editresult['agentTotalFare']-$editresult['agentMarukup']) || $editresult['hotelRequest']==0){ ?>
			<div class="col-md-12">



					<div class="row">






 <h1>Hotel Confirmation</h1> 

						    <div class="col-md-12">



								<div class="form-group">



									<label>Hotel Confirmation No.</label> 

     

									<input name="confirmationNo" type="text" class="form-control" id="confirmationNo" value="">



								</div> 



						   </div>
   

					</div> 
		   </div>
  
   <div class="card-footer text-right">
 

								<button type="submit" class="btn btn-primary" style="width: 100%; font-size: 20px;">Confirm Now</button>


			
			<input name="action" type="hidden" id="action" value="confirmHotelVoucher">   
			<input name="editid" type="hidden" id="editid" value="<?php echo encode($editresult['id']); ?>"> 
			<input name="hotelRequest" type="hidden" id="hotelRequest" value="0"> 
			<input name="status" type="hidden" id="status" value="2"> 
			<input name="confirmedBy" type="hidden" class="form-control" id="confirmedBy" value="<?php echo $hotelhave['companyName']; ?>">
			
			<input name="supplier" type="hidden" id="supplier" value="<?php echo $hotelhave['id']; ?>">
			<input name="i" type="hidden" id="i" value="<?php echo $_REQUEST['i']; ?>">

		   </div>
				  
				  <?php } else { ?>
				  <div style="text-align:center; color:#FF0000;"><strong>Agent balance is low. Can not confirm this booking.</strong></div>
				  <?php } ?>
				  <?php } ?>
				  
    </div>



</form>
 
</div>
</body>
</html>
