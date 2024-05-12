<?php 
include "inc.php";
$abcd=GetPageRecord('*','sys_packageBuilder','id="'.decode($_REQUEST['id']).'"'); 
$result=mysqli_fetch_array($abcd);  
 
$rs13=GetPageRecord('*','queryMaster','id="'.$result['queryId'].'"');   
$queryData=mysqli_fetch_array($rs13); 
 
$rs13=GetPageRecord('*','sys_userMaster','id="'.$queryData['addedBy'].'"');   
$userData=mysqli_fetch_array($rs13); 


$rs=GetPageRecord('invoiceLogo','sys_userMaster','id=1 ');  
$invoicedataa=mysqli_fetch_array($rs);


$proposalurlmain=''.$fullurlproposal.'sharepackage/'.$_REQUEST['id'].'/'.cleanstring(stripslashes($result['name'])).'.html';
 
?>
<div style="width:800px; margin:auto; font-family:Arial, Helvetica, sans-serif; font-size:13px;  ">
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-size:13px;">
  <tr>
    <td colspan="3" align="center" style="padding-bottom:5px;"><img src="<?php echo $fullurl; ?>profilepic/<?php echo $invoicedataa['invoiceLogo']; ?>"    style="height: 54px;"><hr /></td>
  </tr>
  <tr>
    <td colspan="3" style="padding-bottom:5px;"><strong>Dear <?php echo stripslashes(trim($queryData['name'])); ?>,</strong></td>
  </tr>
  <tr>
    <td colspan="3" style="line-height:25px;">This is <?php echo stripslashes($userData['firstName']); ?> <?php echo stripslashes($userData['lasetName']); ?> and I will be working with you to plan your trip to <strong><?php

												$string = '';

										$string = preg_replace('/\.$/', '', $queryData['destinationId']);  

										$array = explode(',', $string); 

										foreach($array as $value)  

										{ echo getCityName($value); } ?></strong><br>

Please find below details for your trip and feel free to call me at +91 <?php echo str_replace('+','',stripslashes($userData['mobile'])); ?> or <a href="<?php echo $proposalurlmain; ?>" target="_blank" style="color:#CC0000; text-decoration:none;"><strong>click here</strong></a> to view more details about this trip.</td>
  </tr>
  <tr>
    <td colspan="3" style="line-height:25px;">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="left" valign="top" style="line-height:25px;"><table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC"  style="font-size:13px;">
      <tr>
        <td colspan="4" bgcolor="#3187E6" style="color:#FFFFFF; background-color:#3187E6;"><strong>Query Details </strong></td>
        </tr>
      <tr>
        <td width="25%"><strong>QueryId:</strong></td>
        <td width="40%">#<?php echo encode($queryData['destinationId']); ?></td>
        <td width="15%"><strong>Adult(s):</strong></td>
        <td width="20%"><?php echo ($queryData['adult']); ?></td>
        </tr>
      <tr>
        <td width="25%"><strong>Nights:</strong></td>
        <td width="40%"><?php echo ($queryData['day']-1); ?> Nights &amp; <?php echo ($queryData['day']); ?> Days </td>
        <td width="15%"><strong>Child(s):</strong></td>
        <td><?php echo ($queryData['child']); ?><?php if($queryData['infant']>0){ ?>&nbsp;&nbsp;<strong>Infant(s): <?php echo ($queryData['infant']); ?></strong><?php } ?></td>
      </tr>
      <tr>
        <td width="25%"><strong>Destination Covered: </strong></td>
        <td width="40%"><?php echo stripslashes($result['destinations']); ?> </td>
        <td width="15%"><strong>Start Date:</strong></td>
        <td><?php echo date('D, d M, Y',strtotime($result['startDate'])); ?></td>
      </tr>
      <tr>
        <td width="25%"><strong>Query Date: </strong></td>
        <td width="40%"><?php echo date('d-M-Y',strtotime($queryData['dateAdded'])); ?></td>
        <td width="15%"><strong>End Date: </strong></td>
        <td><?php echo date('D, d M, Y',strtotime($result['endDate'])); ?> </td>
      </tr>
      
    </table></td>
  </tr>
  <tr>
    <td colspan="3" align="left" valign="top" style="line-height:25px;">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="left" valign="top" style="line-height:25px;">
     
               
 <?php 
 $i=1; 
$rs=GetPageRecord('*','sys_packageBuilderEvent',' packageId="'.$result['id'].'"  and  sectionType="Accommodation" order by packageDays asc');
while($eventData=mysqli_fetch_array($rs)){

$earlier = new DateTime($eventData['startDate']);
$later = new DateTime($eventData['endDate']); 
$abs_diff = $later->diff($earlier)->format("%a");
?>
 <table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC"  style="font-size:13px; margin-bottom:10px;">
      <?php if($i==1){?>
      <tr>
        <td colspan="7" bgcolor="#000000" style="color:#FFFFFF; background-color:#000000;"><strong><?php echo stripslashes($result['name']); ?></strong></td>
        </tr><?php }?>
 <tr>
        <td bgcolor="#E4E4E4"><strong>City</strong></td>
        <td bgcolor="#E4E4E4"><strong>Hotel Name </strong></td>
        <td bgcolor="#E4E4E4"><strong>Check In </strong></td>
        <td bgcolor="#E4E4E4"><strong>Check Out</strong> </td>
        <td bgcolor="#E4E4E4"><strong>Nights</strong></td>
        <td bgcolor="#E4E4E4"><strong>Room Type </strong></td>
        <td bgcolor="#E4E4E4"><strong>Meal Plan </strong></td>
        </tr>
 
	  <tr>
        <td><strong><?php echo stripslashes($eventData['destinationName']); ?></strong></td>
        <td><?php echo stripslashes($eventData['name']); ?> (<?php echo ($eventData['hotelCategory']); ?> Star)<br />
		  <?php if($eventData['singleRoom']>0){ ?><strong>Single Room: <?php echo $eventData['singleRoom']; ?></strong><br /><?php } ?>
        <?php if($eventData['doubleRoom']>0){ ?><strong>Double Room:  <?php echo $eventData['doubleRoom']; ?></strong><br /><?php } ?>
        <?php if($eventData['tripleRoom']>0){ ?><strong>Triple Room: <?php echo $eventData['tripleRoom']; ?></strong><br /><?php } ?>
        <?php if($eventData['quadRoom']>0){ ?><strong>Quad Room: <?php echo $eventData['quadRoom']; ?></strong><br /><?php } ?> 
        <?php if($eventData['cwbRoom']>0){ ?><strong>CWB Room: <?php echo $eventData['cwbRoom']; ?></strong><br /><?php } ?> 
        <?php if($eventData['cnbRoom']>0){ ?> <strong>CNB Room: <?php echo $eventData['cnbRoom']; ?></strong><?php } ?></td>
        <td><?php echo date('d-M-Y',strtotime($eventData['startDate'])); ?></td>
        <td><?php echo date('d-M-Y',strtotime($eventData['endDate'])); ?></td>
        <td><?php echo $abs_diff; ?></td>
        <td><?php echo stripslashes($eventData['hotelRoom']); ?></td>
        <td><?php echo stripslashes($eventData['mealPlan']); ?></td>
      </tr>
  </table>    <?php $i++; } ?>    </td>
  </tr>
  <tr>
    <td colspan="3" align="left" valign="top" style="line-height:25px;">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="center" valign="top" style="line-height:25px; font-size:25px;"><strong><?php if($result['billingType']==2){ ?>
        Per Person
          <?php } ?><?php if($result['billingType']==1){ ?>
          Total  
          <?php } ?> Package Price: <?php  if($result['convertedCurrency']=='INR'){  ?>
	   <?php if($result['billingType']==2){ ?><strong>&#8377;<?php echo number_format(round($result['grossPrice'])); ?></strong><?php } ?>
	   
	   <?php if($result['billingType']==1){ ?><strong>&#8377;<?php echo number_format($result['grossPrice']); ?></strong>  <?php } ?>
	   <?php } else { ?>
	   <?php  echo $totalfinalcost=number_format(round($result['convertedCost'])).' '.$result['convertedCurrency']; ?> 
	   <?php } ?> </strong></td>
  </tr>
  <tr>
    <td colspan="3" align="left" valign="top" style="line-height:25px;">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="left" valign="top" style="line-height:25px;"><table width="100%" border="0" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC"  style="font-size:13px;">
      <tr>
        <td colspan="2" bgcolor="#000000" style="color:#FFFFFF; background-color:#000000;"><strong>Itinerary Details</strong></td>
        </tr>
 <?php
	$n=1;
$begin = new DateTime( $result['startDate'] );
$end   = new DateTime( $result['endDate'] );
 
 
for($i = $begin; $i <= $end; $i->modify('+1 day')){ 

$abcde=GetPageRecord('*','sys_packageBuilderEvent',' packageDays="'.$n.'" and packageId="'.$result['id'].'"'); 
$dayDetailsData=mysqli_fetch_array($abcde); 
?> 
      <tr>
        <td width="17%" align="left" bgcolor="#E2E2E2"><strong><?php echo date('d M Y', strtotime($i->format("Y-m-d"))); ?></strong></td>
        <td width="86%" align="left" bgcolor="#F4F4F4"><strong>Day <?php echo $n; ?>: </strong><?php echo stripslashes($dayDetailsData['daySubject']); ?> </td>
        </tr>
      <tr>
        <td colspan="2" align="left" valign="top">
		
		<?php if($dayDetailsData['dayDetails']!=''){?><div style="padding:10px 0px; margin-bottom:10px; border-bottom:1px solid #ddd;"><?php echo nl2br(strip_tags(stripslashes($dayDetailsData['dayDetails']))); ?></div><?php } ?>
		
		
	<?php  
$rstt=GetPageRecord('*','sys_packageBuilderEvent',' packageId="'.$result['id'].'"  and packageDays="'.$n.'" and sectionType="Flight" order by sr, time(checkIn) asc');
while($eventData=mysqli_fetch_array($rstt)){ 
?>  	
		<div style="margin-bottom:20px;">
<strong>Flight Included:</strong> <?php echo stripslashes($eventData['name']); ?> (<?php echo stripslashes($eventData['flightNo']); ?>) - <?php echo  stripslashes($eventData['fromDestination']); ?> (<?php echo  date('g:i A',strtotime($eventData['checkIn'])); ?>) to <?php echo  stripslashes($eventData['toDestination']); ?> (<?php echo  date('g:i A',strtotime($eventData['checkOut'])); ?>) - (<a href="<?php echo $proposalurlmain; ?>" target="_blank" style="color:#CC0000; text-decoration:none;"><strong>click here</strong></a> to view package details)</div>
		<?php } ?>
         
 <?php  
$actno=1;
$activity='';
$rs=GetPageRecord('*','sys_packageBuilderEvent',' packageId="'.$result['id'].'"  and packageDays="'.$n.'" and  (sectionType="Activity" ) order by time(checkIn) asc');
while($eventData=mysqli_fetch_array($rs)){ 

$activity=stripslashes($eventData['name']).',';

$actno++; } 
?>
<?php if($activity!=''){?>
<div style="margin-bottom:20px;">
<strong>Activity Included:</strong> <?php echo rtrim($activity,','); ?> - (<a href="<?php echo $proposalurlmain; ?>" target="_blank" style="color:#CC0000; text-decoration:none;"><strong>click here</strong></a> to view package details)</div>
<?php } ?>

 




 <?php  
 $transport='';
$rs=GetPageRecord('*','sys_packageBuilderEvent',' packageId="'.$result['id'].'" and packageDays="'.$n.'" and  ( sectionType="Transportation") order by time(checkIn) asc');
while($eventData=mysqli_fetch_array($rs)){ 

$transport=stripslashes($eventData['name']).','; }

?>
 
 
<?php if($transport!=''){?>
<div style="margin-bottom:20px;">
<strong>Transport Included:</strong> <?php echo rtrim($transport,','); ?> - (<a href="<?php echo $proposalurlmain; ?>" target="_blank" style="color:#CC0000; text-decoration:none;"><strong>click here</strong></a> to view package details)</div>
<?php } ?>
 <?php   
 $mealshow='';
$rs=GetPageRecord('*','sys_packageBuilderEvent',' packageId="'.$result['id'].'"   and packageDays="'.$n.'" and  sectionType="Meal"  ');
while($eventData=mysqli_fetch_array($rs)){


$mealshow=stripslashes($eventData['name']).','; } 
 
 if($mealshow!=''){
?>
<div style="margin-bottom:20px;">
<strong>Meal Included:</strong> <?php  echo rtrim($mealshow,','); ?> - (<a href="<?php echo $proposalurlmain; ?>" target="_blank" style="color:#CC0000; text-decoration:none;"><strong>click here</strong></a> to view package details)</div>

<?php } ?> </td> 
        </tr>
		<?php $n++; } ?>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" align="left" valign="top" style="line-height:25px;">&nbsp;</td>
  </tr>
</table>
</div>
