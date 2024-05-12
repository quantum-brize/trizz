<?php 
$abcd=GetPageRecord('*','sys_packageBuilder','id="'.decode($_REQUEST['id']).'"'); 
$result=mysqli_fetch_array($abcd);  

$rs=GetPageRecord($select,'sys_userMaster','id in (select addedBy from sys_userMaster where id="'.$result['addedBy'].'") '); 
$invoicedataa=mysqli_fetch_array($rs);


$n=1;
$begin = new DateTime( $result['startDate'] );
$end   = new DateTime( $result['endDate'] );
 
$rs1=GetPageRecord('*','queryMaster','id="'.$result['queryId'].'"');   
$querydata=mysqli_fetch_array($rs1); 

$a=GetPageRecord('*','sys_packageBuilderEvent','packageId="'.$result['id'].'" and sectionType="Flight"');   
$getflight=mysqli_fetch_array($a); 

$a=GetPageRecord('*','sys_packageBuilderEvent','packageId="'.$result['id'].'" and sectionType="Activity"');   
$getActivity=mysqli_fetch_array($a); 

$a=GetPageRecord('*','sys_packageBuilderEvent','packageId="'.$result['id'].'" and sectionType="Accommodation"');   
$getHotel=mysqli_fetch_array($a); 

$a=GetPageRecord('*','sys_packageBuilderEvent','packageId="'.$result['id'].'" and (sectionType="Transportation")');   
$gettransport=mysqli_fetch_array($a); 

$a=GetPageRecord('*','sys_packageBuilderEvent','packageId="'.$result['id'].'" and sectionType="Meal"');   
$getmeal=mysqli_fetch_array($a); 

$rs=GetPageRecord($select,'sys_userMaster','id="'.$result['addedBy'].'" '); 
$packagecreator=mysqli_fetch_array($rs);
?>
<table width="640" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top">
	<?php if($result['queryId']!=''){ ?>
	<div style="font-size:22px;"><strong><?php echo $querydata['name']; ?>'s</strong> trip to</div>
	<?php } ?>	</td>
    <td width="40%" rowspan="3" align="right" valign="top"><img src="<?php echo $fullurl; ?>profilepic/<?php  echo $invoicedataa['invoiceLogo']; ?>" style="height:45px; width:auto; position:absolute; left:0px; top:0px;" /></td>
  </tr>
  <tr>
    <td colspan="2" align="left" valign="top"><div style="font-size:22px; line-height:30px; color:#458ebf;"><strong><?php echo stripslashes($result['name']); ?></strong></div></td>
  </tr>
   <tr>
    <td colspan="2" align="left" valign="top"><div style="font-size:13px; line-height:30px; color:#000;"><?php echo stripslashes($result['destinations']); ?></div></td>
  </tr>
  <tr>
    <td colspan="2" align="left" valign="top"><div style="font-size:18px; line-height:30px;"><strong><?php echo round($result['days']-1); ?> Nights / <?php echo stripslashes($result['days']); ?> Days</strong></div></td>
  </tr>
</table>

 <table width="675" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>
     <td colspan="3">&nbsp;</td>
   </tr>
   <tr>
     <td colspan="3" style="border-top:2px solid #e1eefa;">&nbsp;</td>
   </tr>
 </table>


<table width="675" border="0" align="center" cellpadding="5" cellspacing="0">
   <tr>
     <td colspan="2">&nbsp;</td>
   </tr>
   <tr>
     <td colspan="2">&nbsp;</td>
   </tr>
   <tr>
     <td align="left"  style="font-size:14px;"><div style="font-size:15px;"><strong>Contents</strong></div>
	 <table width="100%" border="0" cellpadding="5" cellspacing="0" style="font-size:13px;">
  <tr>
    <td width="8%" align="center" style="color:#000">&nbsp;</td>
    <td width="92%"  colspan="3" align="left" style="color:#6db0fb;">&nbsp;</td>
  </tr>
  <tr>
    <td width="8%" align="center" style="color:#000"><strong>1.</strong></td>
    <td  colspan="3" align="left" style="color:#6db0fb;"><strong>Your Itinerary</strong></td>
    </tr>
  <tr>
    <td width="8%" align="center" style="color:#000"><strong>2.</strong></td>
    <td  colspan="3" align="left" style="color:#6db0fb;"><strong>Day Wise Details</strong></td>
  </tr>
  
  <tr>
    <td width="8%" align="center" style="color:#000"><strong>3.</strong></td>
    <td  colspan="3" align="left" style="color:#6db0fb;"><strong>Cancellation &amp; Date Change
      Policies</strong></td>
  </tr>
  <tr>
    <td width="8%" align="center" style="color:#000">&nbsp;</td>
    <td  colspan="3" align="left" style="color:#6db0fb;">&nbsp;</td>
  </tr>
</table>	 </td>
     <td width="50%" bgcolor="#eaf5ff"   ><table width="100%" border="0" cellpadding="5" cellspacing="0" style="font-size:12px;">
       <tr>
         <td colspan="3" align="left"><i>&nbsp;&nbsp;&nbsp;Curated by</i>
          <div style="font-size:13px;"><strong>&nbsp;&nbsp;<?php echo stripslashes($packagecreator['firstName']); ?></strong></div></td>
        </tr>
       <tr>
         <td colspan="3" align="left">&nbsp;&nbsp;&nbsp;<i>Phone</i>
          <div style="font-size:13px;"><strong>&nbsp;&nbsp;<?php echo strip($packagecreator['countryCode']); ?> <?php echo strip($packagecreator['mobile']); ?></strong></div></td>
       </tr>
       <tr>
         <td colspan="3" align="left">&nbsp;&nbsp;&nbsp;<i>Email</i>
          <div style="font-size:13px;"><strong>&nbsp;&nbsp;<?php echo strip($packagecreator['email']); ?></strong></div></td>
       </tr>
       <tr>
         <td colspan="3" align="left">&nbsp;&nbsp;&nbsp;<i>Quotation Created on</i>
         <div style="font-size:13px;"><strong>&nbsp;&nbsp;<?php echo date('j, F Y',strtotime($result['dateAdded'])); ?></strong></div></td>
       </tr>
       
     </table></td>
   </tr>
</table>

 <table width="680" border="0" align="center" cellpadding="0" cellspacing="0">

   <tr>
     <td width="640" align="left">&nbsp;</td>
   </tr>
   <tr>
     <td align="left">&nbsp;</td>
   </tr>
   <tr>
     <td align="left">&nbsp;</td>
   </tr>
   <tr>
     <td align="left"><div style="font-size:15px;"><strong>Highlights</strong></div></td>
   </tr>
   <tr>
     <td align="left">&nbsp;</td>
   </tr>
   <tr>
     <td align="left"><table height="80" border="0" cellpadding="10" cellspacing="0"  style="border:2px solid #e1eefa; font-size:13px;">
  <tr>
      <?php if($getflight['id']!=''){ ?>  <td width="100" align="center" style="border-right:2px solid #e1eefa;"><img src="<?php echo $fullurl; ?>images/pdfflight.PNG" width="32" /><br />
      Flights</td> 	  <?php } ?>
   <?php if($getHotel['id']!=''){ ?>  <td width="100" align="center"  style="border-right:2px solid #e1eefa;border-left:2px solid #e1eefa;"><img src="<?php echo $fullurl; ?>images/pdfhotel.PNG" width="32" /><br />
      Hotel</td> 
	  <?php } ?>
	  
      <?php if($getActivity['id']!=''){ ?><td width="100" align="center"  style="border-right:2px solid #e1eefa;border-left:2px solid #e1eefa;"><img src="<?php echo $fullurl; ?>images/pdfactivity.PNG" width="32" /><br />
      Activity</td> 
	  <?php } ?>
	  
    <?php if($gettransport['id']!=''){ ?><td width="100" align="center"  style="border-right:2px solid #e1eefa;border-left:2px solid #e1eefa;"><img src="<?php echo $fullurl; ?>images/pdftransport.png" width="32" /><br />
      Transport</td> <?php } ?>
    <?php if($getmeal['id']!=''){ ?>  <td width="100" align="center"  style="border-right:2px solid #e1eefa;border-left:2px solid #e1eefa;"><img src="<?php echo $fullurl; ?>images/pdmeal.png" width="32" /><br />
Meal</td><?php } ?>
  </tr>
  
</table></td>
   </tr>
   <tr>
     <td align="left">&nbsp;</td>
   </tr>
   <tr>
     <td align="left">&nbsp;</td>
   </tr>
   
   <tr>
     <td align="left">&nbsp;</td>
   </tr>
   <tr>
     <td align="left">&nbsp;</td>
   </tr>
 </table>
 
 
 <table width="675" border="0" align="center" cellpadding="20" cellspacing="0"style="page-break-after: always;" > 
   <tr>
     <td align="center" bgcolor="#eaf5ff" style=" border:1px solid #93cbf0; text-align:center; font-size:20px;"><div style="font-size:22px; color:#000;"><strong><?php if($result['billingType']==2){ ?>
       Cost Per Person Cost<?php } ?><?php if($result['billingType']==1){ ?>Total Cost <?php } ?></strong></div>
       <div style="font-size:14px; color:#666666;"><i>Note: All above prices are subject to change without prior notice as per availability, the final date of travel and any
changes in taxes.</i></div>
       <div style="font-size:30px; color:#29a3ff;"><?php if($result['billingType']==2){ ?><strong>&#8377;<?php echo number_format($result['grossPrice']+$result['extraMarkup']); ?></strong><?php } ?>
	   
	   <?php if($result['billingType']==1){ ?><strong>&#8377;<?php echo number_format($result['grossPrice']); ?></strong> &nbsp;<span style="font-size:16px;">for <?php echo $result['adult']; ?> Adult(s)<?php if($result['child']>0){ ?> and <?php echo $result['child']; ?> Child(s)<?php } ?></span><?php } ?>
	   </div>	 </td>
   </tr>
   
   <tr>
     <td align="center" style="padding:0px;" >&nbsp;</td>
   </tr>
   <tr>
     <td align="center"  ><div style="font-size:20px; color:#00C1A9"><i>Please think twice before printing this page. 
       Save paper, it's good for the environment.</i></div></td>
   </tr>
 </table>
<table width="670" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" valign="top">
	 
	<div style="font-size:20px; color:#29a3ff"><strong>Your Itinerary</strong></div>	 </td>
  </tr>
  <tr>
    <td align="left" valign="top"><div style="font-size:26px; line-height:30px; color:#000;"><strong><?php echo stripslashes($result['days']); ?> Days Trip</strong></div></td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top"><table width="100%" border="0" cellpadding="10" cellspacing="0" bordercolor="#FFFFFF" style="font-size:14px; border:1px solid #ddd; font-size:13px; page-break-after: always;">
      <tr>
        <td colspan="2" bgcolor="#e7b5a7" style="color:#000000; font-weight:600;"><strong><?php echo stripslashes($result['name']); ?> - <?php echo round($result['days']-1); ?> Nights Stay</strong></td>
        </tr>
     <?php
	 $n=1;
for($i = $begin; $i <= $end; $i->modify('+1 day')){ 
$rs=GetPageRecord('*','sys_packageBuilderEvent',' packageId="'.$result['id'].'" and startDate="'.$i->format("Y-m-d").'" order by sr, time(checkIn) asc');
while($eventData=mysqli_fetch_array($rs)){ 
?>  <tr>
        <td width="33%" align="left" style="border-bottom:1px solid #ddd;"><?php echo date('D, j M, Y', strtotime($i->format("Y-m-d"))); ?></td>
        <td width="67%" align="left" style="border-bottom:1px solid #ddd; border-left:1px solid #ddd;"><strong><?php echo stripslashes($eventData['name']); ?></strong></td>
      </tr>
      <?php $n++; } if($eventData['name']!=''){ ?>
	  <tr>
        <td width="33%" align="left" style="border-bottom:1px solid #ddd;"><?php echo date('D, j M, Y', strtotime($i->format("Y-m-d"))); ?></td>
        <td width="67%" align="left" style="border-bottom:1px solid #ddd; border-left:1px solid #ddd;"><strong><?php echo stripslashes($eventData['name']); ?></strong></td>
      </tr>
	  
	   <?php }} ?>
    </table></td>
  </tr>
</table>


<table width="831" border="0" align="center" cellpadding="0" cellspacing="0" style="page-break-after: always;" >
  <tr>
    <td width="831" align="left" valign="top">
	 
	<div style="font-size:20px; color:#29a3ff"><strong>Day Wise Details</strong></div>	 </td>
  </tr>
    <?php
	$n=1;
$begin = new DateTime( $result['startDate'] );
$end   = new DateTime( $result['endDate'] );
 
 
for($i = $begin; $i <= $end; $i->modify('+1 day')){ 
$abcde=GetPageRecord('*','sys_packageBuilderEvent',' packageDays="'.$n.'" and packageId="'.$result['id'].'"'); 
$dayDetailsData=mysqli_fetch_array($abcde); 
?> 
    <tr nobr="true">
      <td align="left" valign="top">&nbsp;</td>
    </tr>
  <tr nobr="true">
    <td align="left" valign="top"><div style="font-size:20px; line-height:22px; color:#000;"><strong><?php echo $n; ?> Day - <?php echo date('D', strtotime($i->format("Y-m-d"))); ?>, <?php echo date('d M Y', strtotime($i->format("Y-m-d"))); ?></strong></div></td>
  </tr>  
  
   <?php if($dayDetailsData['daySubject']!=''){ ?>
  <tr>
    <td align="left" valign="top" style="font-size:14px;"> 
<table width="650" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><div style="font-size:15px;"><strong><?php echo stripslashes($dayDetailsData['daySubject']); ?></strong></div></td>
    </tr>
  <tr>
    <td colspan="3" style="font-size:12px;"><?php echo strip_tags(stripslashes($dayDetailsData['dayDetails'])); ?></td>
  </tr>
</table>	</td>
  </tr><?php } ?>
 
  <tr>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">
 
	
	
	<table width="90%" border="0" cellpadding="5" cellspacing="0" >
  <?php  
$rs=GetPageRecord('*','sys_packageBuilderEvent',' packageId="'.$result['id'].'" and packageDays="'.$n.'" order by time(checkIn) asc');
while($eventData=mysqli_fetch_array($rs)){ 
?> 
  <tr  nobr="true">
    <td width="60%" align="left" valign="top" bgcolor="#eaf5ff"><div style="font-size:15px;"><strong><?php echo stripslashes($eventData['name']); ?> 
          <?php if($eventData['flightNo']!=''){ ?> 
          <span style="color:#FF9900; padding-left:10px;">(<?php echo stripslashes($eventData['flightNo']); ?>)</span>
          <?php } ?> 
          <span style="color:#FF9900; padding-left:10px;"><?php echo starcategory($eventData['hotelCategory']); ?></span></strong></div>
		  
		  
 <?php if($eventData['sectionType']=='Accommodation'){ ?>
<div style="border-top:1px solid #ddd;border-bottom:1px solid #ddd; padding-top:4px; margin-bottom:4px;">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"><div style="margin-bottom:10px;">
<div style="margin-bottom:2px;">Check-in</div>
<div style="margin-bottom:5px; font-weight:700;"><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo date('d M Y',strtotime($eventData['startDate'])); ?> - <?php echo  date('g:i A',strtotime($eventData['checkIn'])); ?></div>
</div></td>
    <td><div style="margin-bottom:10px;">
<div style="margin-bottom:2px;">Check-out</div>
<div style="margin-bottom:5px; font-weight:700;"><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo date('d M Y',strtotime($eventData['endDate'])); ?> - <?php echo  date('g:i A',strtotime($eventData['checkOut'])); ?></div>
</div></td>
  </tr>
</table>
</div>

<?php if($eventData['singleRoom']>0){ ?>
 
<div style="margin-bottom:20px;"><strong>Room: </strong> <?php echo $eventData['singleRoom']; ?> Single &nbsp;&nbsp;| &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Meal: </strong> <?php echo stripslashes($eventData['mealPlan']); ?></div>
 
 <?php } ?>
 
  <?php if($eventData['doubleRoom']>0){ ?>
 
 <div style="margin-bottom:20px;"><strong>Room: </strong> <?php echo $eventData['doubleRoom']; ?> Double &nbsp;&nbsp;| &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Meal: </strong> <?php echo stripslashes($eventData['mealPlan']); ?></div>
 <?php } ?>


<?php if($eventData['tripleRoom']>0){ ?>
 <div style="margin-bottom:20px;"><strong>Room: </strong> <?php echo $eventData['tripleRoom']; ?> Triple &nbsp;&nbsp;| &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Meal: </strong> <?php echo stripslashes($eventData['mealPlan']); ?></div>
<?php } ?>



<?php if($eventData['quadRoom']>0){ ?>
<div style="margin-bottom:20px;"><strong>Room: </strong> <?php echo $eventData['quadRoom']; ?> Quad &nbsp;&nbsp;| &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Meal: </strong> <?php echo stripslashes($eventData['mealPlan']); ?></div>
<?php } ?>


<?php if($eventData['cwbRoom']>0){ ?> 
  <div style="margin-bottom:20px;"><strong>Room: </strong> <?php echo $eventData['cwbRoom']; ?> Child With Bed &nbsp;&nbsp;| &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Meal: </strong> <?php echo stripslashes($eventData['mealPlan']); ?></div>
<?php } ?>

<?php if($eventData['cnbRoom']>0){ ?> 
  <div style="margin-bottom:20px;"><strong>Room: </strong> <?php echo $eventData['cnbRoom']; ?> Child No Bed &nbsp;&nbsp;| &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Meal: </strong> <?php echo stripslashes($eventData['mealPlan']); ?></div>
<?php } ?>
<?php } ?>

 <?php if($eventData['sectionType']=='Activity' || $eventData['sectionType']=='Transportation' ){ ?>
 <div style="margin-bottom:20px;">
 <i class="fa fa-calendar" aria-hidden="true"></i> &nbsp;<?php echo date('d M Y',strtotime($eventData['startDate'])); ?> &nbsp;<i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp; <?php echo  date('g:i A',strtotime($eventData['checkIn'])); ?> to <?php echo  date('g:i A',strtotime($eventData['checkOut'])); ?></div>
 
<?php } ?>



 <?php if($eventData['sectionType']=='Meal'){ ?>
 <div style="margin-bottom:20px;">
 <i class="fa fa-calendar" aria-hidden="true"></i> &nbsp;<?php echo date('d M Y',strtotime($eventData['startDate'])); ?> &nbsp;<i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp; <?php echo  date('g:i A',strtotime($eventData['checkIn'])); ?> TO <?php echo  date('g:i A',strtotime($eventData['checkOut'])); ?></div>
 
<?php } ?>


 <?php if($eventData['sectionType']=='FeesInsurance'){ ?>
 <div >
 <i class="fa fa-calendar" aria-hidden="true"></i> &nbsp;<?php echo date('d M Y',strtotime($eventData['startDate'])); ?></div>
 
<?php } ?>

<?php if($eventData['sectionType']=='Flight'){ ?>
 
 <div style="margin-bottom:5px;">
 
 <table border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" style="padding-right:20px; font-size:12px;"><div style="font-size:14px; font-weight:700; color:#000; margin-bottom:3px;"><?php echo  date('g:i A',strtotime($eventData['checkIn'])); ?></div><?php echo  stripslashes($eventData['fromDestination']); ?></td>
    <td align="center" style="width:100px;"><?php if($eventData['flightDuration']!=''){ ?><div style="text-align:center; font-size:11px; color:#666666;padding-bottom: 4px;"><?php echo stripslashes($eventData['flightDuration']); ?></div><?php } ?><div style="font-size:0px; border-top:2px solid #ddd; position:relative;"><i class="fa fa-plane" aria-hidden="true" style="position: absolute; font-size: 18px; transform: rotate(45deg); top: -9px; left: 40%;"></i></div></td>
    <td align="center" style="padding-left:20px;"><div style="font-size:14px; font-weight:700; color:#000; margin-bottom:3px;"><?php echo  date('g:i A',strtotime($eventData['checkOut'])); ?></div><?php echo  stripslashes($eventData['toDestination']); ?></td>
  </tr>
</table><div style="text-align:center;"><?php echo (stripslashes($eventData['description'])); ?></div>
 </div>
<?php } ?><?php if($eventData['sectionType']!='Flight'){  echo (stripslashes($eventData['description'])); } ?></td>
    <td width="30%" align="right" valign="top" bgcolor="#eaf5ff"><img src="<?php echo $fullurl; ?>package_image/<?php  if($eventData['eventPhoto']!=''){ echo $eventData['eventPhoto']; } else {   if($eventData['sectionType']=='Transportation' ){ echo 'notransfer.png'; }if($eventData['sectionType']=='Activity' ){ echo 'noactivity.png'; }if($eventData['sectionType']=='Meal' ){ echo 'nomeal.png'; } }?>" width="350" height="200" style="width:350px; height:200px;"></td>
  </tr>
  <tr>
    <td colspan="2" align="left" valign="top" bgcolor="#FFFFFF" style="font-size:1px;">d</td>
    </tr>
  
  <?php } ?>
</table></td>
  </tr>
   
 <?php $n++;} ?>
</table>
<?php 
$rsa=GetPageRecord('*','sys_PackageTips',' packageId="'.$result['id'].'"   order by id asc');
while($packageTipsData=mysqli_fetch_array($rsa)){ 
?>
<table width="670" border="0" align="center" cellpadding="20" cellspacing="0">
  
  <tr>
    <td align="left" valign="top" bgcolor="#f2f2f2"><div style="font-size:22px; line-height:22px; color:#000;"><strong><?php echo stripslashes($packageTipsData['title']); ?></strong></div></td>
  </tr>
  <tr>
    <td align="left" valign="top" bgcolor="#f2f2f2" style="font-size:12px;"><?php echo stripslashes($packageTipsData['description']); ?></td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
</table>
<?php } ?>
