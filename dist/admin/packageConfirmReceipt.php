<?php
include "inc.php"; 

$abcd=GetPageRecord('*','sys_packageBuilder','id="'.decode($_REQUEST['pid']).'"'); 
$result=mysqli_fetch_array($abcd); 

$abcde=GetPageRecord('*','sys_PackagePayment','packageId="'.$result['id'].'" order by id desc'); 
$paymentdata=mysqli_fetch_array($abcde); 
 

$fd=GetPageRecord('*','queryMaster','id="'.$result['queryId'].'"'); 
$queryData=mysqli_fetch_array($fd);


$rsa=GetPageRecord('*','userMaster','id="'.$queryData['clientId'].'"'); 
$userDetail=mysqli_fetch_array($rsa);

$rs=GetPageRecord($select,'sys_userMaster','id in (select addedBy from sys_userMaster where id="'.$result['addedBy'].'") '); 
$invoicedataa=mysqli_fetch_array($rs);


$rsrec=GetPageRecord('SUM(amount) as totalreceived','sys_PackagePayment','packageId="'.$result['id'].'" and paymentStatus=1 order by id desc'); 
$paymentreceiveddata=mysqli_fetch_array($rsrec); 



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
<div style="margin-bottom:10px; text-align:center; font-size:30px; color:#1fa67a;"><?php if($_REQUEST['linkpayment']!=1){ ?>Booking Confirmed!<?php }else{ ?>Payment Received!<?php } ?></div>
<div style="margin-bottom:10px; text-align:center; font-size:15px; ">Booking ID: <?php echo encode($result['queryId']); ?></div>  

<div style="padding:20px;margin-bottom:20px; background-color:#DDFFF4; border:1px solid #C6FFE3;">
<div style="margin-bottom:10px; text-align:center; font-size:30px; color:#000;"><?php echo stripslashes($result['name']); ?></div>

<div style=" text-align:center; font-size:15px; "><?php echo date('d M Y',strtotime($result['startDate'])); ?> to <?php echo date('d M Y',strtotime($result['endDate'])); ?> - ID: <?php echo encode($result['id']); ?></div>
</div>


<div style="margin-bottom:10px; text-align:center; font-size:20px; color:#000;"><strong>Client Details</strong></div>
<div style="margin-bottom:20px; text-align:center; font-size:14px; color:#000;">
<table width="100%" border="0" cellpadding="6" cellspacing="0"  style="border:1px solid #ddd;">
  <tr style="border-bottom:1px solid #ddd;">
    <td width="50%" align="right"><strong>Name:</strong></td>
    <td width="50%" align="left"><?php echo stripslashes($userDetail['submitName']); ?> <?php echo stripslashes($userDetail['firstName']); ?> <?php echo stripslashes($userDetail['lastName']); ?></td>
  </tr>
  <tr style="border-bottom:1px solid #ddd;">
    <td width="50%" align="right"><strong>Email:</strong></td>
    <td width="50%" align="left"><?php echo stripslashes($userDetail['email']); ?></td>
  </tr>
  <tr style="border-bottom:1px solid #ddd;">
    <td width="50%" align="right"><strong>Mobile:</strong></td>
    <td width="50%" align="left"><?php echo stripslashes($userDetail['mobileCode']); ?><?php echo stripslashes($userDetail['mobile']); ?></td>
  </tr>
</table>
</div>

<div style="margin-bottom:10px; text-align:center; font-size:20px; color:#000;"><strong>Cost Details</strong></div>
<div style="margin-bottom:20px; text-align:center; font-size:14px; color:#000;">
<table width="100%" border="0" cellpadding="6" cellspacing="0"  style="border:1px solid #ddd;">
  <tr style="border-bottom:1px solid #ddd;">
    <td width="50%" align="left"><strong>Package Cost: </strong></td>
    <td width="50%" align="right">&#8377;<?php echo number_format($result['grossNoGSTPrice']); ?></td>
  </tr>
   <?php if($result['cgst']>0){ ?>
  <tr style="border-bottom:1px solid #ddd;">
    <td width="50%" align="left"><strong>CGST <?php echo strip($result['cgst']); ?>%  </strong></td>
    <td width="50%" align="right">&#8377;<?php echo number_format($result['totalcgst']); ?></td>
  </tr>
  <?php } ?>
  
  <?php if($result['sgst']>0){ ?>
  <tr style="border-bottom:1px solid #ddd;">
    <td width="50%" align="left"><strong>CGST <?php echo strip($result['sgst']); ?>%  </strong></td>
    <td width="50%" align="right">&#8377;<?php echo number_format($result['totalsgst']); ?></td>
  </tr>
  <?php } ?>
  
  <?php if($result['igst']>0){ ?>
  <tr style="border-bottom:1px solid #ddd;">
    <td width="50%" align="left"><strong>CGST <?php echo strip($result['igst']); ?>%  </strong></td>
    <td width="50%" align="right">&#8377;<?php echo number_format($result['totaligst']); ?></td>
  </tr>
  <?php } ?>
  <tr style="border-bottom:1px solid #ddd;">
    <td align="left"><strong>TCS 5% </strong></td>
    <td align="right">&#8377;<?php echo number_format($result['grosstcs']); ?></td>
  </tr>
  <tr style="border-bottom:1px solid #ddd;">
    <td align="left"><strong>Total Amount</strong></td>
    <td align="right">&#8377;<?php echo number_format($totalpayment=($result['grossPrice'])); ?></td>
  </tr>
</table>
</div>

<div style="margin-bottom:10px; text-align:center; font-size:20px; color:#000;"><strong>Payment Details</strong></div>
<div style="margin-bottom:20px; text-align:center; font-size:14px; color:#000;">
<table width="100%" border="0" cellpadding="6" cellspacing="0"  style="border:1px solid #ddd;">
  <tr style="border-bottom:1px solid #ddd;">
    <td width="70%" align="left"><strong>Payment ID: <?php echo encode($paymentdata['id']); ?> - <?php echo date('d/m/Y - h:i A',strtotime($paymentdata['paymentDate'])); ?></strong></td>
    <td width="17%" align="right">&#8377;<?php echo number_format($paymentdata['amount']); ?></td>
  </tr>
  <tr style="border-bottom:1px solid #ddd; color:#CC3300;">
    <td align="left"><strong>Remaining Payment </strong></td>
    <td align="right"><strong>&#8377;<?php echo number_format($totalpayment-$paymentreceiveddata['totalreceived']); ?></strong></td>
  </tr>
</table>
</div>


<div style="text-align:center;"><strong>For more information please contact us</strong><br>
      <strong>Phone:</strong> <?php echo stripslashes($invoicedataa['mobileCode']); ?><?php echo $invoicedataa['phone']; ?><br>
        <strong>Email: </strong><?php echo stripslashes($invoicedataa['email']); ?></div>

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
