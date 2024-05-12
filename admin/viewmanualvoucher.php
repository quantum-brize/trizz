<?php
include "inc.php";
$abcde=GetPageRecord('*','sys_manualVoucherMaster','id="'.decode($_REQUEST['id']).'"'); 
$voucherData=mysqli_fetch_array($abcde); 
 
$rs=GetPageRecord($select,'sys_userMaster','id=1'); 
$invoicedataa2=mysqli_fetch_array($rs);
?>
<?php if($_REQUEST['print']==1){ ?>
<!DOCTYPE html>
<html lang="en">
   
   <head>
      <meta charset="utf-8"> 
	  <link href="assets/css/style.css?i=1" rel="stylesheet" type="text/css"> 
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
   </head>

<body> 

<?php } ?>
<style>
 
 
.statusbox{margin-right: 5px; padding: 10px; text-align: center; background-color: #000000; font-size: 13px; color: #fff; border-radius: 4px; text-transform:uppercase;}
 .bulbblue2 {
    height: 30px;
    width: 30px;
    background-color: #3b5de7;
    border-radius: 100%;
    text-align: center;
    overflow: hidden;
    line-height: 34px;
    font-size: 16px;
    font-weight: 600;
    color: #fff;
    margin-right: 20px;
}
</style>
 
<style type="text/css" media="print">
@page {
    size: auto;   /* auto is the initial value */
    margin: 0; margin-top:0px;  /* this affects the margin in the printer settings */
}

 

</style>
 
 <div style="width: 800px; margin: auto; text-align: left; font-family:Arial, Helvetica, sans-serifa;">

<?php if($_REQUEST['sendmail']!=1){ ?>
 <div class="divFooter">
 <strong><?php echo stripslashes($invoicedataa2['invoiceCompany']); ?></strong> | <?php echo stripslashes($invoicedataa2['invoiceAddress']); ?> <br>
 <strong>Email:</strong> <?php echo stripslashes($invoicedataa2['invoiceEmail']); ?> | <strong>Phone:</strong> +91-9873000130<br>
<strong>Toll Free: </strong><?php echo stripslashes($invoicedataa2['invoicePhone']); ?> 
 </div>
 <?php } ?>
 
 <style>
  .divFooter {
    display: none;
  }
 
@media print {
  div.divFooter { display:block;
    position: fixed;
    bottom: 5px; width:100%; font-size:11px; text-align:center; line-height:16px;
  }
}
 </style>
 <img src="<?php echo $fullurl; ?>package_image/<?php if($voucherData['bannerImage']!=''){ echo str_replace('','',$voucherData['bannerImage']); } else { echo 'reservationconfirmationvoucher.jpg'; } ?>" name="bannerphoto" width="100%" id="bannerphoto"  />
 <div style="padding:15px; text-align:center; font-weight:800; font-size:16px; text-align:center; text-decoration:underline;">RESERVATION VOUCHER</div>

<div style="padding:15px; text-align:left;">
<div style="margin-bottom:5px;"><?php echo stripslashes($voucherData['welcomeContent']); ?>
</div>
</div>

<div style="padding:15px; text-align:left;">
 <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" valign="middle" style="padding:0px 10px 10px 0px;"><strong>Confirmation No</strong></td>
    <td width="80%" align="left" valign="middle" style="padding:0px 0px  10px 0px;"><?php echo stripslashes($voucherData['confirmationNo']); ?></td>
  </tr>
  
  <tr>
    <td align="left" valign="middle" style="padding:0px 10px 10px 0px;"><strong>Supplier</strong></td>
    <td width="80%" align="left" valign="middle" style="padding:0px 0px  10px 0px;"><?php echo stripslashes($voucherData['supplierName']); ?></td>
  </tr>
  <tr>
    <td align="left" valign="middle" style="padding:0px 10px 10px 0px;"><strong>Hotel</strong></td>
    <td align="left" valign="middle" style="padding:0px 10px  10px 0px;"><?php echo stripslashes($voucherData['hotel']); ?></td>
  </tr>
  <tr>
    <td align="left" valign="middle" style="padding:0px 10px 10px 0px;"><strong>Destination</strong></td>
    <td align="left" valign="middle" style="padding:0px 10px  10px 0px;"><?php echo stripslashes($voucherData['destination']); ?></td>
  </tr>
  <tr>
    <td align="left" valign="middle" style="padding:0px 10px 10px 0px;"><strong>Lead Pax Name</strong></td>
    <td align="left" valign="middle" style="padding:0px 10px  10px 0px;"><?php if($voucherData['leadPaxName']==''){ echo stripslashes($editresult['name']); } else { echo stripslashes($voucherData['leadPaxName']);  } ?></td>
  </tr>
  <tr>
    <td align="left" valign="middle" style="padding:0px 10px 10px 0px;"><strong>Check In</strong></td>
    <td align="left" valign="middle" style="padding:0px 10px  10px 0px;"><?php if($voucherData['startDate']!=''){ echo date('d-m-Y',strtotime($voucherData['startDate'])); } ?></td>
  </tr>
  <tr>
    <td align="left" valign="middle" style="padding:0px 10px 10px 0px;"><strong>Check Out</strong></td>
    <td align="left" valign="middle" style="padding:0px 10px  10px 0px;"><?php if($voucherData['endDate']!=''){ echo date('d-m-Y',strtotime($voucherData['endDate'])); } ?></td>
  </tr>
  <tr>
    <td align="left" valign="middle" style="padding:0px 10px 10px 0px;"><strong>Nights</strong></td>
    <td align="left" valign="middle" style="padding:0px 10px  10px 0px;"><?php echo stripslashes($voucherData['nights']); ?></td>
  </tr>
  <tr>
    <td align="left" valign="middle" style="padding:0px 10px 10px 0px;"><strong>Total No. Of Rooms</strong></td>
    <td align="left" valign="middle" style="padding:0px 10px  10px 0px;"><?php echo stripslashes($voucherData['noOfRooms']); ?></td>
  </tr>
  <tr>
    <td align="left" valign="middle" style="padding:0px 10px 10px 0px;"><strong>Room Type</strong></td>
    <td align="left" valign="middle" style="padding:0px 10px  10px 0px;"><?php echo stripslashes($voucherData['roomType']); ?></td>
  </tr>
  <tr>
    <td align="left" valign="middle" style="padding:0px 10px 10px 0px;"><strong>No. of Pax </strong></td>
    <td align="left" valign="middle" style="padding:0px 10px  10px 0px;"><?php echo $voucherData['adult']; ?></td>
  </tr>
  <tr>
    <td align="left" valign="middle" style="padding:0px 10px 10px 0px;"><strong>Transfer Mode</strong></td>
    <td align="left" valign="middle" style="padding:0px 10px  10px 0px;"><?php echo stripslashes($voucherData['transferMode']); ?></td>
  </tr>
  <tr>
    <td align="left" valign="middle" style="padding:0px 10px 10px 0px;"><strong>Meal Plan </strong></td>
    <td align="left" valign="middle" style="padding:0px 10px  10px 0px;"><?php echo stripslashes($voucherData['mealPlan']); ?></td>
  </tr>
</table>

</div>

<div style="padding:15px; text-align:left;">
<div style="margin-bottom:2px;"><strong>Remarks</strong></div>
<div style="margin-bottom:5px;" ><?php echo stripslashes($voucherData['remark']); ?>
</div>
</div>
<div style="page-break-after: always;"></div>
<div style="padding:15px; text-align:center; font-weight:800; font-size:16px; text-align:center; text-decoration:underline;">INCLUSIONS</div>
<div style="padding:15px; text-align:left;">
<table width="100%" class=" " >

                                            <thead>
                                            </thead>
                                            <tbody> 

<tr>
  <td style=" font-weight: 700; padding:10px 0px; border-bottom:1px solid #ddd;"><?php echo strip($voucherData['inclusions']); ?></td>
</tr>
 
</tbody>
</table>
</div>



</div>


<?php if($_REQUEST['print']==1){ ?>
</body>
 
</html>
<?php } ?>