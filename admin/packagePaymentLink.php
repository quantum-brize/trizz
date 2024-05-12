<?php
include "inc.php"; 

$abcd=GetPageRecord('*','sys_packageBuilder','id="'.decode($_REQUEST['pid']).'"'); 
$result=mysqli_fetch_array($abcd); 

$abcde=GetPageRecord('*','sys_PackagePayment',' queryId="'.$result['queryId'].'" and packageId="'.$result['id'].'" order by id desc'); 
$paymentdata=mysqli_fetch_array($abcde); 
 

$fd=GetPageRecord('*','queryMaster','id="'.$result['queryId'].'"'); 
$queryData=mysqli_fetch_array($fd);


$rsa=GetPageRecord('*','userMaster','id="'.$queryData['clientId'].'"'); 
$userDetail=mysqli_fetch_array($rsa);

$rs=GetPageRecord($select,'sys_userMaster','id=1 '); 
$invoicedataa=mysqli_fetch_array($rs);


$akey=GetPageRecord('firstName','sys_userMaster','id=1'); 
$getpaymentkey=mysqli_fetch_array($akey);
?>
<!DOCTYPE html>
<html lang="en">
   
   <head>
      <meta charset="utf-8">
   </head>

<body> 

<div class="container-fluid" style="width:700px; margin:auto; border:1px solid #ddd; padding:10px;">
<div class="main-content">

<div class="page-content"> 

<div class="row">
<div class="col-md-6 col-xl-6" style="margin:auto;">
<div class="card" >
<div class="card-body"> 
<div style="text-align:center;">
<div style="margin-top:10px;  text-align:center; font-size:60px; color:#1fa67a; margin-bottom:20px;"><img src="<?php echo $fullurl; ?>profilepic/<?php  echo $invoicedataa['invoiceLogo']; ?>" style="height:65px; width:auto;" /></div>
 
<div style="margin-bottom:10px; text-align:center; font-size:15px; ">Booking ID: <?php echo encode($result['queryId']); ?></div>  

<div style="padding:20px;margin-bottom:20px; background-color:#DDFFF4; border:1px solid #C6FFE3;">
<div style="margin-bottom:10px; text-align:center; font-size:30px; color:#000;"><?php echo stripslashes($result['name']); ?></div>

<div style=" text-align:center; font-size:15px; "><?php echo date('d M Y',strtotime($result['startDate'])); ?> to <?php echo date('d M Y',strtotime($result['endDate'])); ?> - ID: <?php echo encode($result['id']); ?></div>
</div>


<div style="margin-bottom:10px; text-align:center; font-size:20px; color:#000;"><strong>Client Details</strong></div>
<div style="margin-bottom:20px; text-align:center; font-size:14px; color:#000;">
<table width="43%" border="0" align="center" cellpadding="6" cellspacing="0"  style="border:1px solid #ddd;">
  <tr style="border-bottom:1px solid #ddd;">
    <td width="26%" align="left"><strong>Name:</strong></td>
    <td width="74%" align="left"><?php echo stripslashes($userDetail['submitName']); ?> <?php echo stripslashes($userDetail['firstName']); ?> <?php echo stripslashes($userDetail['lastName']); ?></td>
  </tr>
  <tr style="border-bottom:1px solid #ddd;">
    <td width="26%" align="left"><strong>Email:</strong></td>
    <td width="74%" align="left"><?php echo stripslashes($userDetail['email']); ?></td>
  </tr>
  <tr style="border-bottom:1px solid #ddd;">
    <td width="26%" align="left"><strong>Mobile:</strong></td>
    <td width="74%" align="left"><?php echo stripslashes($userDetail['mobileCode']); ?><?php echo stripslashes($userDetail['mobile']); ?></td>
  </tr>
</table>
</div>

   

<div style="margin-bottom:10px; text-align:center; font-size:20px; color:#000;"><strong>Payment Details </strong></div>
 <table width="100%" border="0" cellpadding="10" cellspacing="0" style="border:1px solid #ccc;">
  <tr>
    <td align="center" bgcolor="#F0F0F0" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;"><strong>Due Date </strong></td>
    <td align="center" bgcolor="#F0F0F0" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;"><strong>Status</strong></td>
    <td width="30%" align="center" bgcolor="#F0F0F0" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;"><strong>Installment Amount </strong></td>
    <?php if($_REQUEST['sendlink']==1){ ?><td width="25%" align="center" bgcolor="#F0F0F0" style="border-bottom:1px solid #ccc; ">&nbsp;</td>
    <?php } ?>
  </tr>
  <?Php
  if(decode($_REQUEST['id'])>0){
   $a=GetPageRecord('*','sys_PackagePayment','queryId="'.$result['queryId'].'" and packageId="'.decode($_REQUEST['pid']).'" and id="'.decode($_REQUEST['id']).'" and paymentStatus!=0 order by paymentDate desc'); 
   
   while($paymentlist=mysqli_fetch_array($a)){ 
    //if(decode($_REQUEST['id'])==$paymentlist['id']){
  ?>
  <tr>
    <td align="center"  style="font-size:16px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;"><?php echo date('j F Y',strtotime($paymentlist['paymentDate'])); ?></td>
    <td align="center"  style="font-size:16px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;"><?php if($paymentlist['paymentStatus']==1){ ?>
      <div style="color:#009900"><strong>&#10004; Paid</strong></div><?php } ?>
  
  <?php if(date('Y-m-d H:i:s',strtotime($paymentlist['paymentDate']))>=date('Y-m-d H:i:s')){  if($paymentlist['paymentStatus']==2){ ?><div style="color:#FF6600"><strong>&#8987; Pending</strong></div><?php } } else { if($paymentlist['paymentStatus']==2){ ?>
  <div style="color:#FF6600"><strong>&#8987; Overdue</strong></div>
  <?php } } ?></td>
    <td width="30%" align="right" style="font-size:16px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;">&#8377;<?php echo number_format($paymentlist['amount']); if($paymentlist['conFee']>0){ ?><br>
      + <?php echo number_format($paymentlist['conFee']); ?> Convenience fee* <?php } ?></td>
    <?php if($getpaymentkey['paymentAPIKey']!='' && $getpaymentkey['paymentAPISecret']!=''){ ?><td width="25%" align="center" style="  border-bottom:1px solid #ccc;  "><?php if($paymentlist['paymentStatus']==1){ ?><?php }else{ if(decode($_REQUEST['id'])==$paymentlist['id']){ ?><a href="<?php echo $fullurl; ?>linkPackagepayment.php?pid=<?php echo $_REQUEST['pid']; ?>&id=<?php echo $_REQUEST['id']; ?>&qid=<?php echo $_REQUEST['qid']; ?>" style="background-color:#1699dd; color:#fff; text-decoration:none; padding:3px 10px;"><strong>Make Payment </strong></a><?php } } ?></td>
    <?php } ?>
  </tr> 
  <?php  } } ?>
  
  <?Php 
  if(decode($_REQUEST['id'])==''){
   $a=GetPageRecord('*','sys_PackagePayment','queryId="'.$result['queryId'].'" and packageId="'.decode($_REQUEST['pid']).'" and paymentStatus!=0 order by paymentDate desc');  
   while($paymentlist=mysqli_fetch_array($a)){ 
     
  ?>
  <tr>
    <td align="center"  style="font-size:16px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;"><?php echo date('j F Y',strtotime($paymentlist['paymentDate'])); ?></td>
    <td align="center"  style="font-size:16px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;"><?php if($paymentlist['paymentStatus']==1){ ?>
      <div style="color:#009900"><strong>&#10004; Paid</strong></div>
      <?php } ?>
  
  <?php if(date('Y-m-d H:i:s',strtotime($paymentlist['paymentDate']))>=date('Y-m-d H:i:s')){  if($paymentlist['paymentStatus']==2){ ?><div style="color:#FF6600"><strong>&#8987; Pending</strong></div><?php } } else { if($paymentlist['paymentStatus']==2){ ?>
  <div style="color:#FF6600"><strong>&#8987; Overdue</strong></div>
  <?php } } ?></td>
    <td width="30%" align="right" style="font-size:16px; border-bottom:1px solid #ccc; border-right:1px solid #ccc;">&#8377;<?php echo number_format($paymentlist['amount']); if($paymentlist['conFee']>0){ ?><br>
      + <?php echo number_format($paymentlist['conFee']); ?> Convenience fee* <?php } ?></td>
    <?php if($_REQUEST['sendlink']==1){ ?><td width="25%" align="center" style="  border-bottom:1px solid #ccc;  "><?php if($paymentlist['paymentStatus']==1){ ?><?php }else{ if(decode($_REQUEST['id'])==$paymentlist['id']){ ?><a href="<?php echo $fullurl; ?>linkPackagepayment.php?pid=<?php echo $_REQUEST['pid']; ?>&id=<?php echo $_REQUEST['id']; ?>&qid=<?php echo $_REQUEST['qid']; ?>" style="background-color:#1699dd; color:#fff; text-decoration:none; padding:3px 10px;"><strong>Make Payment </strong></a><?php } } ?></td>
    <?php } ?>
  </tr> 
  <?php  } } ?> 
   
</table>
<?php if($_REQUEST['shal']==1){ ?>
<div style="overflow:hidden; width:100%;"><div style="padding:10px; background-color:#F0FFFB; border:1px solid #ccc; width:100%; float:right; margin-top:10px; text-align:right;box-sizing: border-box;"><table border="0" align="right" cellpadding="5" cellspacing="0">

<?php 
	$totalcgst=0;
	$totalsgst=0;
	$totaligst=0;
	if($result['cgst']>0){ $totalcgst=round($total*$result['cgst']/100); }
	if($result['sgst']>0){ $totalsgst=round($total*$result['sgst']/100); }
	if($result['igst']>0){ $totaligst=round($total*$result['igst']/100); }
    ?>
  <tr>
    <td colspan="6" align="right" style="font-size:16;"><strong>GST <?php echo round($result['cgst']+$result['sgst']+$result['igst']); ?>%: </strong></td>
    <td align="right" style="font-size:20px; font-weight:500;"><strong>&#8377;<?php echo round($result['totalcgst']+$result['totalsgst']+$result['totaligst']); ?></strong></td>
  </tr> 
  <?php if($result['grosstcs']>0){ ?><tr>
    <td colspan="6" align="right" style="font-size:16;"><strong>TCS <?php echo $result['tcsPercent']; ?>%:</strong></td>
    <td align="right" style="font-size:20px; font-weight:500;"><strong>&#8377;<?php echo strip($result['grosstcs']); ?> </strong></td>
  </tr><?php } ?>
  <tr>
    <td colspan="6" align="right" style="font-size:16;"><strong>Grand Total:</strong></td>
    <td align="right" style="font-size:20px; font-weight:500;"><strong>&#8377;<?php echo strip($result['grossPrice']); ?> </strong></td>
  </tr>
  
</table>
</div></div>
<?php } ?>
<div style="margin-bottom:10px; text-align:center; font-size:20px; color:#000; margin-top:20px;"><strong>Bank Details  </strong></div>

<?php echo stripslashes($invoicedataa['packageImportantTips']); ?>
<div style="padding:10px;    border: 1px solid #ccc;">
  </div>


<div style="text-align:center; padding-top:20px; width:100%;"><strong>For more information please contact us</strong><br>
      <strong>Phone:</strong> <?php echo $invoicedataa['invoicePhone']; ?><br>
        <strong>Email: </strong><?php echo stripslashes($invoicedataa['invoiceEmail']); ?></div>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>



</body>
 
</html>
