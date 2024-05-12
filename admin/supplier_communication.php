 Dear Sir,<br>Kindly provide the best rates for below enquiry for <?php echo getCityName($editresult['destinationId']); ?> at the earliest<br><br><table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC">
  <tr>
    <td colspan="6" bgcolor="#F8F8F8"><strong>Enquiry Details </strong></td>
  </tr>
  <tr>
    <td><strong>Customer Name </strong></td>
    <td><?php echo  stripslashes($clientData['submitName']); ?> <?php echo  stripslashes($clientData['firstName']); ?> <?php echo  stripslashes($clientData['lastName']); ?></td>
    <td><strong>Enquiry ID </strong></td>
    <td><?php echo  encode($editresult['id']); ?></td>
    <td><strong>Enquiry For </strong></td>
    <td><?php echo  $sourcedata; ?></td>
  </tr>
  
  <tr>
    <td><strong>Check-In</strong></td>
    <td><?php echo  $startDate; ?></td>
    <td><strong>Check-Out </strong></td>
    <td><?php echo  $endDate; ?></td>
    <td><strong>Nights</strong></td>
    <td><?php echo  $editresult['day']; ?></td>
  </tr>
  <tr>
    <td><strong>Destination</strong></td>
    <td><?php echo  getCityName($editresult['destinationId']); ?></td>
    <td><strong>Total Pax</strong></td>
    <td colspan="3"><?php echo  $editresult['adult']; ?> Adult - <?php echo  $editresult['child']; ?> Child - <?php echo  $editresult['infant']; ?> Infant <strong> </strong></td>
  </tr>
  <tr>
    <td><strong>Remarks</strong></td>
    <td colspan="5">&nbsp;</td>
  </tr>
</table>
<div style=" pointer-events: none;">
<div style="margin-top:20px; font-size:15px; padding:10px; margin-bottom:20px; font-weight:700; background-color:#F2F2F2;">Hotel</div>

<?php 
$rsads=GetPageRecord('*','sys_packageBuilderEvent',' packageId="'.$packagedatadetials['id'].'" and sectionType="Accommodation"   order by sectionType asc');
while($rest=mysqli_fetch_array($rsads)){ 
?>


<table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC" style=" margin-bottom:10px; pointer-events: none;">
  <tr>
    <td colspan="2" bgcolor="#F8F8F8" style=" pointer-events: none;"><strong><?php echo stripslashes($rest['name']); ?> </strong></td>
  </tr>
  <tr>
    <td width="26%"><strong>Check-In</strong></td>
    <td width="74%"><?php echo date('d-m-Y',strtotime($rest['startDate'])); ?></td>
  </tr>
  
  <tr>
    <td><strong>Check-Out </strong></td>
    <td><?php echo date('d-m-Y',strtotime($rest['endDate'])); ?></td>
  </tr>
  <tr>
    <td><strong>Nights</strong></td>
    <td><?php echo daysbydates($rest['startDate'],$rest['endDate']); ?></td>
  </tr>
  <tr>
    <td><strong>Room Category </strong></td>
    <td><?php echo stripslashes($rest['hotelRoom']); ?></td>
  </tr>
  <tr>
    <td><strong>Meal</strong></td>
    <td><?php echo stripslashes($rest['mealPlan']); ?></td>
  </tr>
  <tr>
    <td><strong>Pax</strong></td>
    <td><?php echo  $editresult['adult']; ?> Adult - <?php echo  $editresult['child']; ?> Child - <?php echo  $editresult['infant']; ?> Infant <strong> </strong></td>
  </tr>
  <tr>
    <td><strong>No of Rooms </strong></td>
    <td><?php echo  stripslashes($rest['singleRoom']+$rest['doubleRoom']+$rest['tripleRoom']+$rest['quadRoom']+$rest['cwbRoom']+$rest['cnbRoom']); ?></td>
  </tr>
</table>

<?php } ?>

<div style="margin-top:20px; font-size:15px; padding:10px; margin-bottom:20px; font-weight:700; background-color:#F2F2F2;">Transfers / Activity</div>

<table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC" style=" margin-bottom:10px;">
  <tr>
    <td width="33%" bgcolor="#F8F8F8"><strong>Name  </strong></td>
    <td width="33%" bgcolor="#F8F8F8"><strong>Date</strong></td>
    <td width="33%" bgcolor="#F8F8F8"><strong>Type</strong></td>
  </tr>
 <?php 
$rsads=GetPageRecord('*','sys_packageBuilderEvent',' packageId="'.$packagedatadetials['id'].'" and sectionType!="Accommodation"   order by sectionType asc');
while($rest=mysqli_fetch_array($rsads)){ 
?>
 
  <tr>
    <td width="33%"><strong><?php echo stripslashes($rest['name']); ?></strong></td>
    <td width="33%"><?php echo date('d-m-Y',strtotime($rest['startDate'])); ?></td>
    <td width="33%"><?php if($rest['sectionType']=='FeesInsurance'){ echo 'Fees - Insurance'; } else {  echo $rest['sectionType'];  } if($rest['transferCategory']!=''){ echo ' - '.$rest['transferCategory']; } ?> </td>
  </tr>
  <?php } ?>
</table>
</div>
<?php echo  stripslashes($LoginUserDetails['emailsignature']); ?>
