<?php
include "inc.php";
$abcde=GetPageRecord('*','sys_voucherMaster','id="'.decode($_REQUEST['id']).'"'); 
$voucherData=mysqli_fetch_array($abcde);

$rs1=GetPageRecord('*','queryMaster','id="'.$voucherData['queryId'].'"');   
$editresult=mysqli_fetch_array($rs1); 

$rs13=GetPageRecord('*','sys_packageBuilder','queryId="'.$editresult['id'].'" and confirmQuote=1');   
$packagedatadetials=mysqli_fetch_array($rs13);


$rs13=GetPageRecord('*','sys_packageBuilder','queryId="'.$editresult['id'].'" and confirmQuote=1');   
$packagedatadetials=mysqli_fetch_array($rs13);


$rs1333=GetPageRecord('*','sys_PackageTips','packageId="'.$packagedatadetials['id'].'" and title like "%Inclusion%"');   
$packageTipsData=mysqli_fetch_array($rs1333);



$rs=GetPageRecord($select,'sys_userMaster','id in (select addedBy from sys_userMaster where id="'.$packagedatadetials['addedBy'].'") '); 
$invoicedataa=mysqli_fetch_array($rs);

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
 
 <div id="savingbutton" style="width: 800px; margin: auto; text-align: left; font-family:Arial, Helvetica, sans-serifa;">
 <img src="<?php echo $fullurl; ?>package_image/<?php if($voucherData['bannerImage']!=''){ echo str_replace('','',$voucherData['bannerImage']); } else { echo 'reservationconfirmationvoucher.jpg'; } ?>" name="bannerphoto" width="100%" id="bannerphoto"  />
<?php if($_REQUEST['sendmail']!=1){ ?>
 <div class="divFooter">
 <strong><?php echo stripslashes($invoicedataa['invoiceCompany']); ?></strong> | <?php echo stripslashes($invoicedataa['invoiceAddress']); ?> <br>
 <strong>Email:</strong> <?php echo stripslashes($invoicedataa['invoiceEmail']); ?> | <strong>Phone:</strong> +91-9873000130<br>
<strong>Toll Free: </strong><?php echo stripslashes($invoicedataa['invoicePhone']); ?> 
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
 <!--
 <img src="<?php echo $fullurl; ?>package_image/<?php if($voucherData['bannerImage']!=''){ echo str_replace('','',$voucherData['bannerImage']); } else { echo 'reservationconfirmationvoucher.jpg'; } ?>" name="bannerphoto" width="100%" id="bannerphoto"  />
 -->
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
    <td align="left" valign="middle" style="padding:0px 10px  10px 0px;"><?php echo $editresult['adult']; ?> Adult(s) <?php if($editresult['child']!='' && $editresult['child']>0){ ?> - <?php echo $editresult['child']; ?> Child(s)<?php } if($editresult['infant']!='' && $editresult['infant']>0){ ?> - <?php echo $editresult['infant']; ?> Infant(s)<?php } ?></td>
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
<div style="border-top:2px solid #ddd;border-bottom:2px solid #ddd; padding:20px 0px 0px;"><table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="2%" colspan="2" valign="top" style="padding-right:20px; max-height:"><img style="display:none;" src="<?php echo $fullurl; ?>package_image/<?php echo stripslashes($packageTipsData['iconset']); ?>" style="width: 80px;" /><!--<div style="background-color: #74cc01; color: #fff; height: 36px; margin-right: 10px; text-align: center; width: 36px; line-height: 40px; font-size: 18px; border-radius: 30px;"><i class="fa <?php echo stripslashes($packageTipsData['iconset']); ?>" aria-hidden="true"></i></div>--></td>
    <td><h6 style=" margin-top:0px;font-size: 16px; margin-bottom: 10px;"><?php echo stripslashes($packageTipsData['title']); ?></h6>
<div style=" padding-bottom:20px;"><?php echo str_replace('</p>','',str_replace('<p>','',stripslashes($packageTipsData['description']))); ?></div>  </td>
  </tr>
</table></div>
</div>

<div style="padding:15px; text-align:left;">
<table width="100%" class=" " >

                                            <thead>
                                            </thead>
                                            <tbody>
<?php
$a=$voucherData['inclusions'];
$netflightcosting=0;
$totalnetCost=0;
$totalGross=0;
$rs=GetPageRecord('*','sys_packageBuilderEvent',' packageId="'.$packagedatadetials['id'].'" and sectionType!="Accommodation" order by packageDays,time(checkIn) asc');
while($rest=mysqli_fetch_array($rs)){ 
$netCost=0;
$markupValue=0;
$gross=0;
 if (strpos($a, $rest['id']) !== false) {
?>

<tr>
  <td width="5%" style="padding:10px 0px; border-bottom:1px solid #ddd;"><img src="<?php echo $fullurl; ?>images/<?php if($rest['sectionType']=='Flight'){ ?>airicon.png<?php } ?><?php if($rest['sectionType']=='Transportation'){ ?>caricon.png<?php } ?><?php if($rest['sectionType']=='Meal'){ ?>mealicon.png<?php } ?><?php if($rest['sectionType']=='Activity'){ ?>sightseeingicon.png<?php } ?><?php if($rest['sectionType']=='FeesInsurance'){ ?>inshurenceicon.png<?php } ?>" style="width:30px; height:30px;"></td>
<td style=" font-weight: 700; padding:10px 0px; border-bottom:1px solid #ddd; "   ><?php echo stripslashes($rest['name']); ?><?php if($rest['sectionType']=='Accommodation'){ ?>
<span style="color:#FF9900; padding-left:10px;"><?php echo starcategory($rest['hotelCategory']); ?></span> 

 

<?php } } ?></td>
</tr>

<?php $totalno++; } ?>
</tbody>
</table>
	
</div>



</div>
	
<script>
function printDiv() 
{

  var divToPrint=document.getElementById('shoquotionbox');

  var newWin=window.open('','Print-Window');

  newWin.document.open();

  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

  newWin.document.close();

  setTimeout(function(){newWin.close();},10);

}
 
</script>

<?php if($_REQUEST['print']==1){ ?>
	

</body>
 
</html>
<?php } ?>