<?php 
include "inc.php"; 

if($_REQUEST['id']!='' && $_REQUEST['pid']>0 && $_REQUEST['qid']>0){
$pid=$_REQUEST['pid'];
$qid=$_REQUEST['qid'];
$linkid=$_REQUEST['id'];

$_SESSION['packageId']=$pid;
$_SESSION['queryId']=$qid; 
$_SESSION['linkid']=$linkid; 
 $_SESSION['paymentId']=decode($linkid); 
} else {
exit();
}


$asv=GetPageRecord('*','sys_PackagePayment','queryId="'.decode($qid).'" and packageId="'.decode($pid).'" and id="'.decode($linkid).'" and paymentStatus!=0 order by paymentDate desc');  
$paymentlist=mysqli_fetch_array($asv);

$f=GetPageRecord('*','sys_packageBuilder','id="'.decode($pid).'"'); 
$packageData=mysqli_fetch_array($f);

$totalAmt=$paymentlist['amount']+$paymentlist['conFee'];

$fd=GetPageRecord('*','queryMaster','id="'.decode($qid).'"'); 
$queryData=mysqli_fetch_array($fd);

$rsa=GetPageRecord('*','userMaster','id="'.$queryData['clientId'].'"'); 
$userDetail=mysqli_fetch_array($rsa);

$rs=GetPageRecord($select,'sys_userMaster','id in (select addedBy from sys_userMaster where id="'.$packageData['addedBy'].'") '); 
$invoicedataa=mysqli_fetch_array($rs);

/*if($packageData['depositAmount']>0){
$totalAmt=$packageData['depositAmount'];
} else {
$totalAmt=$packageData['grossPrice'];
}*/

 

?>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>			  
<form  action="payment/pay.php" method="POST" style=" display:none;" id="paymentpay">

<input type="hidden" name="item_name" value="<?php echo strip($packageData['name']); ?>">

<input type="hidden" name="item_description" value="<?php echo date('d M Y',strtotime($packageData['startDate'])); ?> to <?php echo date('d M Y',strtotime($packageData['endDate'])); ?> - Payment">

<input type="hidden" name="item_number" value="<?php echo $qid; ?>">

<input type="hidden" name="amount" value="<?php echo trim($totalAmt); ?>">

<input type="hidden" name="address" value="<?php echo strip($userDetail['address']); ?>">

<input type="hidden" name="currency" value="INR">

<input type="hidden" name="cust_name" value="<?php echo strip($userDetail['firstName']); ?> <?php echo strip($userDetail['lastName']); ?>">

<input type="hidden" name="email" value="<?php echo strip($userDetail['email']); ?>">

<input type="hidden" name="contact" value="<?php echo strip($userDetail['mobile']); ?>">

<input type="hidden" name="receipt" value="<?php echo $_REQUEST['id']; ?>">

<input type="hidden" name="logoImg" value="<?php echo $fullurl; ?>profilepic/<?php  echo $invoicedataa['invoiceLogo']; ?>">

<input type="submit" class="btn btn-primary" value="Buy Now">

</form>
<script>
$('#paymentpay').submit();
</script>