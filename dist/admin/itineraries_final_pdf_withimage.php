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
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js"
    integrity="sha256-c9vxcXyAG4paArQG3xk6DjyW/9aHxai2ef9RpMWO44A=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>


<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Anton&family=Open+Sans:wght@400;500;700&family=Redressed&display=swap" rel="stylesheet">

 
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'> 
<style>
@font-face {
  font-family: Redressed-Regular;
  src: url(fonts/Redressed-Regular.ttf);
}
</style>


<div style="padding:10px; font-family:Arial, Helvetica, sans-serif; font-size:13px; width:100%;" id="content2">

<div style="height:450px; position:relative; overflow:hidden; background-image:url(<?php echo $fullurl; ?>package_image/<?php echo $result['coverPhoto']; ?>); background-size:100% 100%;">
<div style="width:100%; height:100%; background-color:#00000066; color:#fff; text-align:center;">
 <table width="100%" border="0" cellpadding="10" cellspacing="0" style="color:#fff;">
  <tr>
    <td colspan="3" align="center">&nbsp;</td>
    </tr>
  <tr>
    <td colspan="3" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="center"><img src="<?php echo $fullurl; ?>profilepic/<?php  echo $invoicedataa['invoiceLogo']; ?>" style="height:45px; width:auto; filter:  brightness(0) invert(1); " /></td>
  </tr>
  <tr>
    <td colspan="3" align="center" style="padding-top:10px;" > </td>
  </tr>
  <tr>
    <td colspan="3" align="center" style=" font-family:Impact; font-size:50px; line-height:50px; font-weight:400;"><?php echo stripslashes($result['destinations']); ?></td>
  </tr>
  <tr>
    <td colspan="3" align="center" style="font-family: 'Redressed-Regular', cursive; font-size:50px;"><?php echo stripslashes($result['name']); ?></td>
  </tr>
</table>


</div>



</div>
<div style="margin-top:10px; border:4px solid #00aef4; padding:30px; position:relative;">

<div style="position: absolute; right: 5%; background-color: #ef7d00; color: #fff; font-size: 23px; height: 120px; width: 120px; top: -74px; border-radius: 100%; line-height: 126px; text-align: center; font-weight: 700; border: 4px solid #fff;"><?php echo round($result['days']-1); ?>N / <?php echo stripslashes($result['days']); ?>D</div>
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="2" align="left" valign="top"><div style="font-size:30px; font-weight:700; color:#ef7d00; margin-bottom:10px;">Basic Details:</div>
	  
	   
	<div style="margin-top:3px; font-size:15px; line-height:20px; font-weight:400; line-height:26px;">
	Destination : <?php echo stripslashes($result['destinations']); ?><br />
	Duration : <?php echo round($result['days']-1); ?> Nights / <?php echo stripslashes($result['days']); ?> Days<br />
	Adults (Above 12 Years) : <?php echo stripslashes($result['adult']); ?><br />
Child (5-12 Years) : <?php echo stripslashes($querydata['child']); ?> Child (0-5 Years) - <?php if($querydata['infant']>0){ echo stripslashes($querydata['infant']); } else { echo '0'; } ?><br />
Date of Arrival : <?php echo date('j M Y',strtotime($querydata['startDate'])); ?><br />

Date of Departure: <?php echo date('j M Y',strtotime($querydata['endDate'])); ?></div>
 
	  </td>
      <td width="50%" align="left" valign="top" style="border-left:1px solid #ddd; padding-left:30px;"><div style="margin-top:3px; font-size:15px; line-height:20px; font-weight:400; line-height:26px;"> 
<strong style="font-size:18px; color:#ef7d00;">Executive Details:</strong><br />
<strong><?php echo stripslashes($packagecreator['firstName']); ?></strong><br />
<?php echo strip($packagecreator['email']); ?><br />
+<?php echo strip($packagecreator['countryCode']); ?> <?php echo strip($packagecreator['mobile']); ?>
</div></td>
    </tr>
  </table>
  
 <div style="margin-top:20px; padding-top:30px; text-align:center; border-top:1px solid #ddd;">
 <div  ><div style="font-size:22px; color:#ef7d00; "><strong><?php if($result['billingType']==2){ ?>
       Cost Per Person Cost<?php } ?><?php if($result['billingType']==1){ ?>Total Cost <?php } ?></strong></div>
       <div style="font-size:14px;  margin:10px 0px;"><i>Note: All above prices are subject to change without prior notice as per availability, <br />
       the final date of travel and any
changes in taxes.</i></div>
       <div style="font-size:30px;  color:#ef7d00; "><?php if($result['billingType']==2){ ?><strong>&#8377;<?php echo number_format($result['grossPrice']+$result['extraMarkup']); ?></strong><?php } ?>
	   
	   <?php if($result['billingType']==1){ ?><strong>&#8377;<?php echo number_format($result['grossPrice']); ?></strong> <span style="font-size:16px;">for <?php echo $result['adult']; ?> Adult(s)<?php if($result['child']>0){ ?> and <?php echo $result['child']; ?> Child(s)<?php } ?></span><?php } ?>
	   </div>	
 
</div>
 </div>
  
</div>



<div style="margin-top:20px; padding-bottom:10px; border-bottom:2px solid #01aeec; margin-bottom:20px;">
 <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left"><div style=" font-family:Impact; font-size:30px; line-height:35px; font-weight:400; color:#01aeec; "><?php echo stripslashes($result['destinations']); ?></div>
	
	<div style="font-family: 'Redressed-Regular';font-size:22px; line-height:25px; color:#ef7d00;"><?php echo stripslashes($result['name']); ?></div>
	</td>
    <td width="50%" align="right"><img src="<?php echo $fullurl; ?>profilepic/<?php  echo $invoicedataa['invoiceLogo']; ?>" style="height:40px; width:auto; " /></td>
  </tr>
</table>

</div>
<div style="padding:20px;">
<div style=" margin-bottom:20px; border-bottom:2px solid #01aeec; padding-bottom:10px; color:#01aeec; font-size:22px; font-weight:600;">&#x2672; Itinerary</div>


<?php
	$n=1;
$begin = new DateTime( $result['startDate'] );
$end   = new DateTime( $result['endDate'] );
 
 
for($i = $begin; $i <= $end; $i->modify('+1 day')){ 
$abcde=GetPageRecord('*','sys_packageBuilderEvent',' packageDays="'.$n.'" and packageId="'.$result['id'].'"'); 
$dayDetailsData=mysqli_fetch_array($abcde); 
?> 
<div style=" margin-bottom:20px; border-bottom:1px solid #ddd; padding-bottom:20px;">
<div style=" padding:5px 0px; font-weight:500; line-height:20px; font-size:18px; color:#ef7d00; font-weight:600;">Day <?php echo $n; ?> - <?php echo stripslashes($dayDetailsData['daySubject']); ?></div>
<div style="padding:5px 0px; line-height:20px; font-size:14px;"><?php echo strip_tags(stripslashes($dayDetailsData['dayDetails'])); ?></div>
</div>
<?php $n++; } ?>







<div style="font-size:22px;  color:#02aef5; font-weight:500; padding-bottom:20px; border-bottom:1px solid #ddd; ">Cost <?php if($result['billingType']==2){ ?><strong> &#8377;<?php echo number_format($result['grossPrice']+$result['extraMarkup']); ?></strong><?php } ?>
	   
	   <?php if($result['billingType']==1){ ?><strong>&#8377;<?php echo number_format($result['grossPrice']); ?></strong> <span style=" ">for <?php echo $result['adult']; ?> Adult(s)<?php if($result['child']>0){ ?> and <?php echo $result['child']; ?> Child(s)<?php } ?></span><?php } ?>  (Incl. of all taxes.)
	   </div>
	   
	   
	   
	   
	   </div>


<div style="margin-top:20px; padding-bottom:10px; border-bottom:2px solid #01aeec; margin-bottom:20px;">
 <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left"><div style=" font-family:Impact; font-size:30px; line-height:35px; font-weight:400; color:#01aeec; "><?php echo stripslashes($result['destinations']); ?></div>
	
	<div style="font-family: 'Redressed-Regular';font-size:22px; line-height:25px; color:#ef7d00;"><?php echo stripslashes($result['name']); ?></div>
	</td>
    <td width="50%" align="right"><img src="<?php echo $fullurl; ?>profilepic/<?php  echo $invoicedataa['invoiceLogo']; ?>" style="height:40px; width:auto; " /></td>
  </tr>
</table>

</div>


<?php
$rs=GetPageRecord('*','sys_packageBuilderEvent',' packageId="'.$result['id'].'"  and  sectionType="Accommodation" order by time(checkIn) asc');
$eventData1=mysqli_fetch_array($rs); 
if($eventData1['id']!=''){ 
?>
 <div style="padding:20px;">
<div style=" margin-bottom:20px; border-bottom:2px solid #01aeec; padding-bottom:10px; color:#01aeec; font-size:22px; font-weight:600;">&#x2617; Hotels </div>
  <?php  
$rs=GetPageRecord('*','sys_packageBuilderEvent',' packageId="'.$result['id'].'"  and  sectionType="Accommodation" order by time(checkIn) asc');
while($eventData=mysqli_fetch_array($rs)){ 
?>
<div style="margin-bottom:20px; padding-bottom:20px; border-bottom:1px solid #ddd;">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
   <?php if($eventData['eventPhoto']!=''){ ?> <td colspan="2" align="left" valign="top"><img src="<?php echo $fullurl; ?>package_image/<?php  if($eventData['eventPhoto']!=''){ echo $eventData['eventPhoto']; } else {   if($eventData['sectionType']=='Transportation' ){ echo 'notransfer.png'; }if($eventData['sectionType']=='Activity' ){ echo 'noactivity.png'; }if($eventData['sectionType']=='Meal' ){ echo 'nomeal.png'; } }?>" width="203" height="147" ></td><?php } ?>
    <td width="99%" align="left" valign="top" style="padding-left:20px; font-size:13px;"> <?php if($eventData['sectionType']=='Accommodation'){ ?>
<div style=" padding-top:4px; margin-bottom:4px;">
<div style="font-size:16px; font-weight:500; color:#ef7d00; margin-bottom:10px;"><strong><?php echo stripslashes($eventData['name']); ?></strong> - <?php echo starcategory($eventData['hotelCategory']); ?></div>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-size:13px;">
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
<?php } ?><?php echo strip_tags(stripslashes($eventData['description'])); ?></td>
  </tr>
</table>

</div>

<?php } ?>
</div>
<?php } ?>




<?php
$rs=GetPageRecord('*','sys_packageBuilderEvent',' packageId="'.$result['id'].'"  and  (sectionType="Activity"  )  order by time(checkIn) asc');
$eventData1=mysqli_fetch_array($rs); 
if($eventData1['id']!=''){ 
?>
 <div style="padding:20px;">
<div style=" margin-bottom:20px; border-bottom:2px solid #01aeec; padding-bottom:10px; color:#01aeec; font-size:22px; font-weight:600;">&#x2617; Activity </div>
  <?php  
$rs=GetPageRecord('*','sys_packageBuilderEvent',' packageId="'.$result['id'].'"  and  (sectionType="Activity" ) order by time(checkIn) asc');
while($eventData=mysqli_fetch_array($rs)){ 
?>
<div style="margin-bottom:20px; padding-bottom:20px; border-bottom:1px solid #ddd;">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top"><img src="<?php echo $fullurl; ?>package_image/<?php  if($eventData['eventPhoto']!=''){ echo $eventData['eventPhoto']; } else {   if($eventData['sectionType']=='Transportation' ){ echo 'notransfer.png'; }if($eventData['sectionType']=='Activity' ){ echo 'noactivity.png'; }if($eventData['sectionType']=='Meal' ){ echo 'nomeal.png'; } }?>" width="203" height="147" ></td>
    <td width="99%" align="left" valign="top" style="padding-left:20px; font-size:13px;"> <div style="font-size:16px; font-weight:500; color:#ef7d00; margin-bottom:10px;"><strong><?php echo stripslashes($eventData['name']); ?></strong> </div><?php if($eventData['sectionType']=='Activity' || $eventData['sectionType']=='Transportation' ){ ?>
 <div style="margin-bottom:20px;">
 <i class="fa fa-calendar" aria-hidden="true"></i> &nbsp;<?php echo date('d M Y',strtotime($eventData['startDate'])); ?> &nbsp;<i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp; <?php echo  date('g:i A',strtotime($eventData['checkIn'])); ?> to <?php echo  date('g:i A',strtotime($eventData['checkOut'])); ?></div>
 
<?php } ?><?php echo strip_tags(stripslashes($eventData['description'])); ?></td>
  </tr>
</table>

</div>

<?php } ?>
</div>
<?php } ?>

 


<?php
$rs=GetPageRecord('*','sys_packageBuilderEvent',' packageId="'.$result['id'].'"  and  ( sectionType="Transportation" )  order by time(checkIn) asc');
$eventData1=mysqli_fetch_array($rs); 
if($eventData1['id']!=''){ 
?>
 <div style="padding:20px;">
<div style=" margin-bottom:20px; border-bottom:2px solid #01aeec; padding-bottom:10px; color:#01aeec; font-size:22px; font-weight:600;">&#x2617; Transport   </div>
  <?php  
$rs=GetPageRecord('*','sys_packageBuilderEvent',' packageId="'.$result['id'].'"  and  ( sectionType="Transportation") order by time(checkIn) asc');
while($eventData=mysqli_fetch_array($rs)){ 
?>
<div style="margin-bottom:20px; padding-bottom:20px; border-bottom:1px solid #ddd;">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top"><img src="<?php echo $fullurl; ?>package_image/<?php  if($eventData['eventPhoto']!=''){ echo $eventData['eventPhoto']; } else {   if($eventData['sectionType']=='Transportation' ){ echo 'notransfer.png'; }if($eventData['sectionType']=='Activity' ){ echo 'noactivity.png'; }if($eventData['sectionType']=='Meal' ){ echo 'nomeal.png'; } }?>" width="203" height="147" ></td>
    <td width="99%" align="left" valign="top" style="padding-left:20px; font-size:13px;"> <div style="font-size:16px; font-weight:500; color:#ef7d00; margin-bottom:10px;"><strong><?php echo stripslashes($eventData['name']); ?></strong> </div><?php if($eventData['sectionType']=='Activity' || $eventData['sectionType']=='Transportation' ){ ?>
 <div style="margin-bottom:20px;">
 <i class="fa fa-calendar" aria-hidden="true"></i> &nbsp;<?php echo date('d M Y',strtotime($eventData['startDate'])); ?> &nbsp;<i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp; <?php echo  date('g:i A',strtotime($eventData['checkIn'])); ?> to <?php echo  date('g:i A',strtotime($eventData['checkOut'])); ?></div>
 
<?php } ?><?php echo strip_tags(stripslashes($eventData['description'])); ?></td>
  </tr>
</table>

</div>

<?php } ?>
</div>
<?php } ?>



 
<?php
$rs=GetPageRecord('*','sys_packageBuilderEvent',' packageId="'.$result['id'].'"  and  ( sectionType="Meal" )  order by time(checkIn) asc');
$eventData1=mysqli_fetch_array($rs); 
if($eventData1['id']!=''){ 
?>
 <div style="padding:20px;">
<div style=" margin-bottom:20px; border-bottom:2px solid #01aeec; padding-bottom:10px; color:#01aeec; font-size:22px; font-weight:600;">&#x2617; Meal   </div>
  <?php  
$rs=GetPageRecord('*','sys_packageBuilderEvent',' packageId="'.$result['id'].'"  and  ( sectionType="Meal") order by time(checkIn) asc');
while($eventData=mysqli_fetch_array($rs)){ 
?>
<div style="margin-bottom:20px; padding-bottom:20px; border-bottom:1px solid #ddd;">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top"><img src="<?php echo $fullurl; ?>package_image/<?php  if($eventData['eventPhoto']!=''){ echo $eventData['eventPhoto']; } else {   if($eventData['sectionType']=='Transportation' ){ echo 'notransfer.png'; }if($eventData['sectionType']=='Activity' ){ echo 'noactivity.png'; }if($eventData['sectionType']=='Meal' ){ echo 'nomeal.png'; } }?>" width="203" height="147" ></td>
    <td width="99%" align="left" valign="top" style="padding-left:20px; font-size:13px;"> <div style="font-size:16px; font-weight:500; color:#ef7d00; margin-bottom:10px;"><strong><?php echo stripslashes($eventData['name']); ?></strong> </div><?php if($eventData['sectionType']=='Meal' ){ ?>
 <div style="margin-bottom:20px;">
 <i class="fa fa-calendar" aria-hidden="true"></i> &nbsp;<?php echo date('d M Y',strtotime($eventData['startDate'])); ?> &nbsp;<i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp; <?php echo  date('g:i A',strtotime($eventData['checkIn'])); ?> to <?php echo  date('g:i A',strtotime($eventData['checkOut'])); ?></div>
 
<?php } ?><?php echo strip_tags(stripslashes($eventData['description'])); ?></td>
  </tr>
</table>

</div>

<?php } ?>
</div>
<?php } ?>



 
<div style="margin-top:20px; padding-bottom:10px; border-bottom:2px solid #01aeec; margin-bottom:20px;">
 <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left"><div style=" font-family:Impact; font-size:30px; line-height:35px; font-weight:400; color:#01aeec; "><?php echo stripslashes($result['destinations']); ?></div>
	
	<div style="font-family: 'Redressed-Regular';font-size:22px; line-height:25px; color:#ef7d00;"><?php echo stripslashes($result['name']); ?></div>
	</td>
    <td width="50%" align="right"><img src="<?php echo $fullurl; ?>profilepic/<?php  echo $invoicedataa['invoiceLogo']; ?>" style="height:40px; width:auto; " /></td>
  </tr>
</table>

</div>

<div style="padding:20px;"><?php 
$rsa=GetPageRecord('*','sys_PackageTips',' packageId="'.$result['id'].'"   order by id asc');
while($packageTipsData=mysqli_fetch_array($rsa)){ 
?>
<div style=" padding:5px 0px; font-weight:500; line-height:20px; font-size:18px; color:#ef7d00; font-weight:600;"><?php echo stripslashes($packageTipsData['title']); ?></div>

<div style="margin-bottom:20px; font-size:14px;  line-height:20px; padding-bottom:20px; border-bottom:1px solid #ddd;"><?php echo stripslashes($packageTipsData['description']); ?></div>

<?php } ?></div>

  

  <div style="padding:30px; margin-top:30px; text-align:center;"><img src="<?php echo $fullurl; ?>profilepic/<?php  echo $invoicedataa['invoiceLogo']; ?>" style="height:50px; width:auto; " />
  
  <div style="margin-top:3px; font-size:15px; line-height:20px; font-weight:400; line-height:26px; margin-top:20px;"> 
<strong style="font-size:18px; color:#ef7d00;">Contact Details</strong><br />
<strong><?php echo stripslashes($packagecreator['firstName']); ?></strong><br />
<?php echo strip($packagecreator['email']); ?><br />
+<?php echo strip($packagecreator['countryCode']); ?> <?php echo strip($packagecreator['mobile']); ?>
</div>
  </div>

 




</div>
 <script>
 
 
 
 
 
 domtoimage.toPng(document.getElementById('content2'))
.then(function (blob) {
	var pdf = new jsPDF('0', 'pt', [$('#content2').width(), $('#content2').height()]);

 pdf.addImage(blob, 'PNG', 0, 0, $('#content2').width(), $('#content2').height());
  pdf.save("<?php echo stripslashes($result['name']); ?>.pdf");  
	 
 setTimeout(function() {  window.open(window.location, '_self').close(); }, 3000);
	 
}); 
</script>