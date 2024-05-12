<?php include "inc.php"; 
  
$rs=GetPageRecord('*','hotelBookingMaster','id="'.$_REQUEST['id'].'"   '); 
$editresult=mysqli_fetch_array($rs);   
 
$urs=GetPageRecord('*','sys_userMaster',' id="'.$editresult['agentId'].'" '); 
$agentData=mysqli_fetch_array($urs); 
?>

<div id="DivIdToPrint" style="max-width:800px;">
<style>
@media print {
table tr td { font-family:Arial, Helvetica, sans-serif;  font-size:13px; }
}
</style>
<table width="100%" border="0" cellspacing="0" cellpadding="5" style=" ">
  <tr>
    <td width="50%"><strong><?php echo stripslashes($editresult['HotelName']); ?></strong> <?php for($i=1; $i<=$editresult['Rating']; $i++){ ?>
						  						 <i class="fa fa-star" aria-hidden="true" style="font-size:12px;color: #ff8100;"></i>
												 <?php } ?> <br />
  <?php echo stripslashes($editresult['Address']); ?></td>
    <td width="50%">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="5">
      <tr>
        <td colspan="3" bgcolor="#BBE8F7"  ><strong><strong><?php echo stripslashes($editresult['RoomType']); ?> (<?php echo stripslashes($editresult['TotalRoom']); ?>)</strong></strong></td>
        </tr>
      <tr>
        <td width="25%" bgcolor="#D3F0FA" style="background-color:#D3F0FA;">Check In<br />
          <strong><?php echo date('d/m/Y', strtotime($editresult['CheckIn'])); ?></strong></td>
        <td width="25%" bgcolor="#E4F7FC" style="background-color:#D3F0FA;">Check Out<br />
          <strong><?php echo date('d/m/Y', strtotime($editresult['CheckOutDate'])); ?></strong></td>
        <td width="25%" bgcolor="#D3F0FA" style="background-color:#D3F0FA;">Total stay<br />
          <strong><?php $start_ts = strtotime($editresult['CheckIn']); 
$end_ts = strtotime($editresult['CheckOutDate']); 
$diff = $end_ts - $start_ts; 
$totNights = round($diff / 86400); if($totNights==0){ echo '1'; }else{ echo $totNights; } ?> Night(s)</strong></td>
      </tr>
    </table></td>
    </tr>
	<tr>
    <td width="50%" style="border-bottom:1px solid #ddd;"> 
      <strong>Pax Details</strong></td>
    <td width="50%" align="center" style="border-bottom:1px solid #ddd;">&nbsp; </td>
  </tr>
  
  <tr>
    <td colspan="2" style="border-bottom:1px solid #ddd;"><table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC">
      <tr>
        <td width="15%" bgcolor="#F4F4F4"><strong>Pax Type </strong></td>
        <td width="25%" bgcolor="#F4F4F4"><strong>Name</strong></td>
        <td bgcolor="#F4F4F4">&nbsp;</td>
      </tr>
	  	<?php 
		$rs6=GetPageRecord('*','hotelBookingPaxDetailMaster',' bookingTableId="'.$editresult['id'].'" and firstName!="" order by roomNo asc '); 
		while($paxData=mysqli_fetch_array($rs6)){
	  ?>
      <tr>
        <td width="15%"><?php if($paxData['paxType']=='AD'){ echo 'Adult'; } if($paxData['paxType']=='CH'){ echo 'Child'; }  ?></td>
        <td width="25%"><?php if($paxData['paxType']!='CH'){ echo $paxData['title']; ?>&nbsp;<?php } echo $paxData['firstName']; ?>&nbsp;<?php echo $paxData['lastName'];  if($paxData['paxType']=='CH'){ ?> (<?php echo $paxData['ageChild']; ?>)<?php } ?></td>
        <td>Room <?php echo $paxData['roomNo']; ?></td>
      </tr>
	  <?php } ?>
      
    </table></td>
    </tr>
 
  <tr>
    <td width="50%" style="border-bottom:1px solid #ddd;"><strong>Contact Details</strong> <br />
 Email : <?php echo stripslashes($agentData['email']); ?> <br />
 Mobile : <?php echo stripslashes($agentData['phone']); ?></td>
    <td width="50%" style="border-bottom:1px solid #ddd;">&nbsp;</td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="5" cellspacing="0">
<?php if($editresult['manualBooking']==0){ ?>
  <tr>
    <td width="100%" style="border-bottom:1px solid #ddd;"><strong>Cancellation Policy</strong><br />
	<?php
 
$hotelData = $detailArray ;
 
 $values = $hotelData->cnp->pd;
 
 
		 
		  
		  ?>
 <table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC" style=" font-size:13px; font-weight:600;">
   <tr>
     <td bgcolor="#F4F4F4"><strong>From Date</strong></td>
     <td bgcolor="#F4F4F4"><strong>To Date</strong></td>
     <td bgcolor="#F4F4F4"><strong>Penalty amount</strong></td>
   </tr>
  <?php  foreach($values as $hotelList){ ?>
   <tr>
     <td style="border-bottom: 1px solid #ddd;"><?php echo $hotelList->fdt; ?></td>
     <td style="border-bottom: 1px solid #ddd;"><?php echo $hotelList->tdt; ?></td>
     <td style="border-bottom: 1px solid #ddd;">&#8377;<?php echo $hotelList->am; ?></td>
   </tr>
   <?php } ?>
</table> </td>
    </tr>
	<?php } else { ?>
	<tr>
    <td style="border-bottom:1px solid #ddd;"><strong>Cancellation Policy</strong><br />
	 
  <?php if($editresult['CancellationPolicy']=='Refundable'){ echo 'Refundable - Cancellation Date: '.date('j F Y',strtotime($editresult['cancellationDate'])).' 23:30'; } else { echo 'This is Non-Refundable Booking.'; } ?> </td>
    </tr>
	<?php } ?>
	<?php if($_REQUEST['ta']!=2){ ?>
  <?php } ?>
</table>
<div style="width: 100%; text-align: center; margin-top: 10px;">
<a href="<?php echo $websiteurl; ?>booking_confirmation.html?i=<?php echo base64_encode(base64_encode($editresult['id'])); ?>" target="_blank"><button type="button" class="btn btn-secondary btn-sm"  style="background-color: #d40000; color: #fff; font-weight: 600; font-size: 16px; padding: 15px 40px; border-radius: 5px; border: 0px;">Confirm Booking</button></a>
</div>
</div>
 

 
 