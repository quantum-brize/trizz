<?php 
$abcd=GetPageRecord('*','sys_packageBuilder','id="'.decode($_REQUEST['id']).'"'); 
$result=mysqli_fetch_array($abcd);  

$rs=GetPageRecord($select,'sys_userMaster','id=1'); 
$invoicedataa=mysqli_fetch_array($rs);

 if($_REQUEST['ntid']!=''){
$namevalue ='makeDone=1';   
updatelisting('queryTask',$namevalue,'id="'.decode($_REQUEST['ntid']).'"');
}


?>

<style>
<?php if($_REQUEST['ga']!='itineraries'){ ?>.container-fluid{padding-left:0px !important;padding-right:0px !important;}<?php } ?>
.wrapper{ position:relative; padding-left: 90px;}
.wbg{background-color:#ffffffc7; color:#000;padding:30px;position:absolute; left:0px; top:0px; width:100%; }
.bbg{background-color:#000000c4; color:#fff;padding:30px;position:absolute; left:0px; top:0px; width:100%; }
.pnameheading{font-size:30px; line-height:41px;font-weight: 700;}
.pnamedate{font-size: 20px; line-height: 29px;}
.coverBanner{ height:650px; overflow:hidden; width:100%; }
.coverBanner img{width:100%; height:auto; min-height:100%; }

.jss2755span {
    font-size: 12px;
    line-height: 15px;
    padding-top: 3px;
    margin-right: 15px;
    padding-bottom: 3px;
    color: #fff;
    background: #525a68;
    border-radius: 5px;
}
.actiimgbox{width:100%; height:100%; overflow:hidden; position:relative;}
.actiimgbox img{width:auto; height:400px; min-width:100%;}
.actiimgboxflight{width:100%; height:200px; overflow:hidden; position:relative;}
.actiimgboxflight img{width:100%; height:100%;}
<?php if($_REQUEST['ga']=='itineraries'){ ?>.container-fluid{max-width:1300px !important;}<?php } ?>

.itinerariesbox{padding:10px 30px !important;}
<?php if($_REQUEST['ga']!='itineraries'){ ?>
.container-fluid {
    max-width: 1200px !important;
}

body{background-color:#eaeef2 !important;}
<?php } ?>

.itinerariesbox span{    font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji" !important; font-size:14px!important;}

.itinerariesbox p{    font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji" !important; font-size:14px!important;}

.card {
    -webkit-box-shadow: 0 0 1.25rem rgb(108 118 134 / 0%)!important;
    box-shadow: 0 0 1.25rem rgb(108 118 134 / 19%)!important;
}
</style>
<div style="width:100%;<?php if($_REQUEST['ga']=='itineraries'){ ?> padding-left:90px;<?php } ?>" class="outeritibox">
<div style="margin:auto; max-width:100%; position:relative;<?php if($_REQUEST['ga']=='itineraries'){ ?> max-width:1200px;<?php } ?>">
 
<div class="<?php if($result['packageTheme']==1){ ?>wbg<?php } else { ?>bbg<?php } ?>">
<div class="row">
<div class="col-md-8 col-xl-8 headerresposive2" >
<div class="pnameheading"><?php echo stripslashes($result['name']); ?></div>
<div class="pnamedate"><?php echo date('d M Y',strtotime($result['startDate'])); ?> to <?php echo date('d M Y',strtotime($result['endDate'])); ?> - ID: <?php echo encode($result['id']); ?></div>

</div>

<div class="col-md-4 col-xl-4 headerresposive1" style="text-align:right;padding-right: 30px;"> <img src="<?php echo $fullurl; ?>profilepic/<?php  echo $invoicedataa['invoiceLogo']; ?>" style="height:65px; width:auto;" /></div>






</div>

</div>
 

<div class="coverBanner"><img src="<?php echo $fullurl; ?>package_image/<?php echo $result['coverPhoto']; ?>"  /></div>


<?php if($_REQUEST['notprice']!=1){ ?>

<div class="col-md-12 col-xl-12" style="font-weight:700;" >
<?php if($result['billingType']==2){ ?>
<?php if($result['totalDiscount']>0){ ?><div style="padding: 30px;  text-align: center; font-size: 16px;   font-size:30px; color:#8f8b8b; border-bottom:1px solid #f3f3f3;padding-bottom: 0px;"><span style="font-size:20px;">Per Person Price </span><span style="text-decoration: line-through;">&#8377;<?php echo $totalfinalcost=number_format(round($result['grossPrice']+$result['totalDiscount'])); ?> </span></div><?php } ?>
<div style="padding: 30px;  text-align: center; font-size: 16px;   font-size:40px; color:#000; border-bottom:1px solid #f3f3f3;padding-top: 0px;">
<?php $totalfinalcost=number_format(round($result['grossPrice']));   if($result['convertedCurrency']=='INR'){ ?>
&#8377;<?php  echo $totalfinalcost=number_format(round($result['grossPrice'])); ?> 
<?php } else { ?>
<?php  echo $totalfinalcost=number_format(round($result['convertedCost'])).' '.$result['convertedCurrency']; ?> 
<?php } ?>

<div style="font-size:12px; text-transform:uppercase;  color:#333333;">Per Person Price</div>
<?php if($result['totalDiscount']>0){ ?>
<div style="font-size:12px; text-transform:uppercase;  color:#333333;">Discount: &#8377;<?php echo stripslashes($result['totalDiscount']); ?></div>
<?php } ?>
<?php if($result['ebo']!=''){ ?>
<div style="font-size:14px; text-transform:uppercase;  color:#333333;"><?php echo stripslashes($result['ebo']); ?></div>
<?php } ?>
</div>

<?php } ?>

 
<?php  
if($result['showcgst']==0 || $result['showsgst']==0 || $result['showigst']==0 || $result['showtcs']==0){
 
$gst='';
if($result['showcgst']==0){ 
$totalcgstval=$result['totalcgst'];
}

if($result['showsgst']==0){   
$totalsgstval=$result['totalsgst'];
}

if($result['showigst']==0){  
$totaligstval=$result['totaligst'];
}

if($result['showtcs']==0){  
$totalgrossgrosstcs=$result['grosstcs'];
}


$toatlminisval=$totalcgstval+$totalsgstval+$totaligstval+$totalgrossgrosstcs;
}




if($result['showcgst']==1 || $result['showsgst']==1 || $result['showigst']==1 || $result['showtcs']==1){
 if($result['convertedCurrency']=='INR'){ 
$gst='';
if($result['showcgst']==1){ 
$gst.='CGST: '.$result['cgst'].'% | ';  
$totalcgstval=$result['totalcgst'];
}

if($result['showsgst']==1){  
$gst1.='SGST: '.$result['sgst'].'% | ';  
$totalsgstval=$result['totalsgst'];
}

if($result['showigst']==1){  
$gst2.='IGST: '.$result['igst'].'% | ';  
$totaligstval=$result['totaligst'];
}

if($result['showtcs']==1){  
$gst3.='TCS: 5%'; 
$totalgrossgrosstcs=$result['grosstcs'];
}

if($gst1!='' || $gst2!=''){
$gsttext='&#8377;'.($totalcgstval+$totalsgstval+$totaligstval).' (GST)';
}

if($gst3!=''){
$tcstext=' &#8377;'.$totalgrossgrosstcs.' (TCS) & ';
}

$gst='Inclusive of '.$tcstext.' '.$gsttext.'';
}
 
}
 ?>
<?php if($result['billingType']==1){ ?>
<?php if($result['totalDiscount']>0){ ?>
<div style="padding: 30px;  text-align: center; font-size: 16px;   font-size:30px; color:#8f8b8b; border-bottom:1px solid #f3f3f3;padding-bottom: 0px;"><span style="font-size:20px;">Total Price </span><span style="text-decoration: line-through;">
<?php  $totalfinalcost=number_format(round($result['grossPrice']+$result['totalDiscount'])); if($result['convertedCurrency']=='INR'){ ?>
&#8377;<?php echo  number_format(round($result['grossPrice']+$result['totalDiscount'])); ?> 
<?php } else { ?>
<?php  echo $totalfinalcost=number_format(round($result['convertedCost'])).' '.$result['convertedCurrency']; ?> 
<?php } ?>


</span></div>
<?php } ?>
<div style="padding: 30px;  text-align: center; font-size: 16px;   font-size:35px; color:#000; border-top:1px solid #f3f3f3;">
<?php  $totalfinalcost=number_format($result['grossPrice']); if($result['convertedCurrency']=='INR'){  ?>
&#8377;<?php echo $totalfinalcost=number_format($result['grossPrice']); ?> 
<?php } else { ?>
<?php  echo $totalfinalcost=number_format(round($result['convertedCost'])).' '.$result['convertedCurrency']; ?> 
<?php } ?>


<?php if($result['showcgst']==1 || $result['showsgst']==1 || $result['showigst']==1 || $result['showtcs']==1){ ?><div style="font-size:12px; text-transform:uppercase;  color:#333333;"><?php echo rtrim($gst,' | ') ?></div> <?php } ?>
<div style="font-size:12px; text-transform:uppercase;  color:#333333;"><?php echo $result['adult']; ?> Adult(s)<?php if($result['child']>0){ ?> and <?php echo $result['child']; ?> Child(s)<?php } ?> - Total <?php echo $result['adult']+$result['child']; ?> Pax Price</div>
<?php if($result['totalDiscount']>0){ ?>
<div style="font-size:12px; text-transform:uppercase;  color:#333333;">Discount: &#8377;<?php echo stripslashes($result['totalDiscount']); ?></div>
<?php } ?>
<?php if($result['ebo']!=''){ ?>
<div style="font-size:14px; text-transform:uppercase;  color:#333333;"><?php echo stripslashes($result['ebo']); ?></div>
<?php } ?>
</div>

<?php }  ?>


 


<?php if($result['queryId']>0){  if($_SESSION['userid']==''){ if($result['depositDueDate']=='' || $result['depositDueDate']>=date('Y-m-d')){  

if($result['depositAmount']>0){
$depositamount=$result['depositAmount'];
} else { 
$depositamount=$result['grossPrice'];
} ?>
<?php if($result['depositDueDate']!='' && $result['depositAmount']>0){ ?>

<form method="post" action="packagepayment.php"> 
<div style="width:100%; text-align:center; padding-bottom:20px;">
<input name="Save" type="submit" value="Book Now" id="savingbutton" class="btn btn-primary" style="font-size: 16px; font-weight: 800; padding: 10px 50px;" >
<input name="bookpackage" type="hidden" value="1" />
<input name="pid" type="hidden" value="<?php echo $_REQUEST['id']; ?>" />
<input name="qid" type="hidden" value="<?php echo encode($result['queryId']); ?>" />
</div>
</form>
<?php } ?>

<?php if($result['depositDueDate']!=''){ ?>
<div style="color:#000; font-size:14px; width:100%; margin-bottom:20px; text-align:center;">For book this pacakge pay deposit amount &#8377;<?php echo number_format($depositamount); ?> - valid till <?php echo date('j F Y',strtotime($result['depositDueDate'])); ?></div>
<?php } } } } ?>

</div>
<?php } ?>


<div class="container-fluid" style="padding-left:0px;">
<div class="main-content">

 <div class="page-content">
 
 <?php
$n=1;
$begin = new DateTime( $result['startDate'] );
$end   = new DateTime( $result['endDate'] );

for($i = $begin; $i <= $end; $i->modify('+1 day')){



$abcde=GetPageRecord('*','sys_packageBuilderEvent',' packageDays="'.$n.'" and packageId="'.$result['id'].'"'); 
$dayDetailsData=mysqli_fetch_array($abcde); 
?>
 
<div class="row">
<div class="col-md-12 col-xl-12">
<div class="itiday">Day <?php echo $n; ?>  <?php echo date('D', strtotime($i->format("Y-m-d"))); ?>, <?php echo date('d M Y', strtotime($i->format("Y-m-d"))); ?> 

 


</div>
<?php if($dayDetailsData['daySubject']!=''){ ?>
<div class="card">
<div class="card-body" style="padding: 10px !important;"> 
<h5 style="margin-top:0px;"><?php echo stripslashes($dayDetailsData['daySubject']); ?></h5>
<?php echo (stripslashes($dayDetailsData['dayDetails'])); ?>
</div>
</div>
<?php } ?>

<?php  
$rs=GetPageRecord('*','sys_packageBuilderEvent',' packageId="'.$result['id'].'" and packageDays="'.$n.'" and name!="" order by sr, time(checkIn) asc');
while($eventData=mysqli_fetch_array($rs)){ 
?> 


<div class="card" style="overflow: hidden;">
<div class="row"> 







<?php if($eventData['sectionType']=='Accommodation' || $eventData['sectionType']=='FeesInsurance' || $eventData['sectionType']=='Flight' || $eventData['sectionType']=='Meal' || $eventData['sectionType']=='Cruise'){ ?>
<div class="<?php if($eventData['sectionType']=='Flight'){ ?>col-md-3 col-xl-3<?php } else { ?>col-md-6 col-xl-6<?php } ?>" style="position:relative;">
<div class="<?php if($eventData['sectionType']=='Flight'){ ?>actiimgboxflight<?php } else {  ?>actiimgbox<?php } ?>"><img id="eventimage<?php echo $eventData['id']; ?>" <?php if($eventData['sectionType']=='Flight'){ ?> style="height:100%;" <?php } ?>  src="<?php echo $fullurl; ?>package_image/<?php if($eventData['eventPhoto']!=''){ echo $eventData['eventPhoto']; } else {  if($eventData['sectionType']=='Accommodation' ){ echo 'nohotel.png'; }  if($eventData['sectionType']=='Cruise' ){ echo 'nohotel.png'; }if($eventData['sectionType']=='FeesInsurance' ){ echo 'nofee.png'; }if($eventData['sectionType']=='Flight' ){ echo 'noother.png'; } } ?>" /></div>


 
 	
</div>


<?php } ?>
<?php if($eventData['sectionType']=='Transportation' || $eventData['sectionType']=='Activity'){ ?>
<div class="col-md-6 col-xl-6 showinmobile ">
<div class="actiimgbox"><img  id="eventimage<?php echo $eventData['id']; ?>" src="<?php echo $fullurl; ?>package_image/<?php  if($eventData['eventPhoto']!=''){ echo $eventData['eventPhoto']; } else {   if($eventData['sectionType']=='Transportation' ){ echo 'notransfer.png'; }if($eventData['sectionType']=='Activity' ){ echo 'noactivity.png'; }if($eventData['sectionType']=='Meal' ){ echo 'nomeal.png'; } } ?>" /></div></div><?php } ?>


  
<div class="<?php if($eventData['sectionType']=='Flight'){ ?>col-md-9 col-xl-9<?php } else { ?>col-md-6 col-xl-6<?php } ?> itinerariesbox">
<div class="card-body" style="padding-top:20px;"> 
<h5 style="line-height: 32px; margin-top:0px; margin-bottom: 2px;"><i style="" class="fa <?php if($eventData['sectionType']=='Accommodation'){ ?>fa-bed<?php } ?><?php if($eventData['sectionType']=='Cruise'){ ?>fa-ship<?php } ?><?php if($eventData['sectionType']=='Activity'){ ?>fa-blind<?php } ?><?php if($eventData['sectionType']=='Transportation'){ ?>fa-car<?php } ?><?php if($eventData['sectionType']=='FeesInsurance'){ ?>fa-credit-card<?php } ?><?php if($eventData['sectionType']=='Meal'){ ?>fa-cutlery<?php } ?><?php if($eventData['sectionType']=='Flight'){ ?>fa-plane<?php } ?><?php if($eventData['sectionType']=='Leisure'){ ?>fa-umbrella<?php } ?>" aria-hidden="true"></i> <?php echo stripslashes($eventData['name']); ?> <?php if($eventData['flightNo']!=''){ ?> <span style="color:#FF9900; padding-left:10px;">(<?php echo stripslashes($eventData['flightNo']); ?>)</span><?php } ?> <span style="color:#FF9900; padding-left:10px;"><?php echo starcategory($eventData['hotelCategory']); ?></span></h5> 
 



 <?php if($eventData['sectionType']=='Accommodation'){ ?>
<div style="border-top:1px solid #ddd;border-bottom:1px solid #ddd; padding-top:10px; margin-bottom:10px;">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><div style="margin-bottom:10px;">
<div style="margin-bottom:2px;">Check-in</div>
<div style="margin-bottom:5px; font-weight:700;"><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo date('d M Y',strtotime($eventData['startDate'])); ?><?php if($eventData['showTime']==1){ ?> - <?php echo  date('g:i A',strtotime($eventData['checkIn'])); ?><?php } ?></div>
</div></td>
    <td><div style="margin-bottom:10px;">
<div style="margin-bottom:2px;">Check-out</div>
<div style="margin-bottom:5px; font-weight:700;"><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo date('d M Y',strtotime($eventData['endDate'])); ?><?php if($eventData['showTime']==1){ ?> - <?php echo  date('g:i A',strtotime($eventData['checkOut'])); ?><?php } ?></div>
</div></td>
  </tr>
  <tr>
    <td colspan="2">
<?php  
 
$swe=GetPageRecord('*','hotelMaster',' name="'.stripslashes($eventData['name']).'" ');
$hotelData=mysqli_fetch_array($swe);

?> 
	</td>
    </tr>
</table>
</div>

<?php if($eventData['singleRoom']>0){ ?>
 
<div style="margin-bottom:20px;"><strong>Room: </strong> <?php echo $eventData['singleRoom']; ?> Single &nbsp;&nbsp;| &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Meal: </strong> <?php echo stripslashes($eventData['mealPlan']); ?> &nbsp;&nbsp;| &nbsp;&nbsp;<strong><i class="fa fa-home" aria-hidden="true"></i> Room Type: </strong> <?php echo stripslashes($eventData['hotelRoom']); ?></div>
 
 <?php } ?>
 
  <?php if($eventData['doubleRoom']>0){ ?>
 
 <div style="margin-bottom:20px;"><strong>Room: </strong> <?php echo $eventData['doubleRoom']; ?> Double &nbsp;&nbsp;| &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Meal: </strong> <?php echo stripslashes($eventData['mealPlan']); ?>&nbsp;&nbsp;| &nbsp;&nbsp;<strong><i class="fa fa-home" aria-hidden="true"></i> Room Type: </strong> <?php echo stripslashes($eventData['hotelRoom']); ?></div>
 <?php } ?>


<?php if($eventData['tripleRoom']>0){ ?>
 <div style="margin-bottom:20px;"><strong>Room: </strong> <?php echo $eventData['tripleRoom']; ?> Triple &nbsp;&nbsp;| &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Meal: </strong> <?php echo stripslashes($eventData['mealPlan']); ?>&nbsp;&nbsp;| &nbsp;&nbsp;<strong><i class="fa fa-home" aria-hidden="true"></i> Room Type: </strong> <?php echo stripslashes($eventData['hotelRoom']); ?></div>
<?php } ?>



<?php if($eventData['quadRoom']>0){ ?>
<div style="margin-bottom:20px;"><strong>Room: </strong> <?php echo $eventData['quadRoom']; ?> Quad &nbsp;&nbsp;| &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Meal: </strong> <?php echo stripslashes($eventData['mealPlan']); ?>&nbsp;&nbsp;| &nbsp;&nbsp;<strong><i class="fa fa-home" aria-hidden="true"></i> Room Type: </strong> <?php echo stripslashes($eventData['hotelRoom']); ?></div>
<?php } ?>


<?php if($eventData['cwbRoom']>0){ ?> 
  <div style="margin-bottom:20px;"><strong>Room: </strong> <?php echo $eventData['cwbRoom']; ?> Child With Bed &nbsp;&nbsp;| &nbsp;&nbsp;<strong><i class="fa fa-home" aria-hidden="true"></i> Meal: </strong> <?php echo stripslashes($eventData['mealPlan']); ?></div>
<?php } ?>

<?php if($eventData['cnbRoom']>0){ ?> 
  <div style="margin-bottom:20px;"><strong>Room: </strong> <?php echo $eventData['cnbRoom']; ?> Child No Bed &nbsp;&nbsp;| &nbsp;&nbsp;<strong><i class="fa fa-home" aria-hidden="true"></i> Meal: </strong> <?php echo stripslashes($eventData['mealPlan']); ?></div>
<?php } ?>

<?php if($hotelData['imgLink']!=''){ ?><a href="<?php echo strip($hotelData['imgLink']); ?>" target="_blank" style="padding: 7px 12px; background-color: #2b93cb; border-radius: 2px; color: #fff;">View More</a><?php } ?>

<?php } ?>

 <?php if($eventData['sectionType']=='Activity' || $eventData['sectionType']=='Transportation' ){ ?>
 <div style="margin-bottom:20px;">
 &nbsp;<?php  if(date('g:i A',strtotime($eventData['checkIn']))!=date('Y-m-d',strtotime($eventData['checkIn'])).' 00:01:00'){ ?> <?php if($eventData['showTime']==1){ ?>&nbsp;<i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp; <?php echo  date('g:i A',strtotime($eventData['checkIn'])); ?> to <?php echo  date('g:i A',strtotime($eventData['checkOut'])); } ?><?php } ?></div>
 
<?php } ?>
 <?php if($eventData['sectionType']=='Cruise'){ ?>
 <div style="margin-bottom:20px;">
 <i class="fa fa-calendar" aria-hidden="true"></i> &nbsp;<?php echo date('d M Y',strtotime($eventData['startDate'])); ?><?php if($eventData['showTime']==1){ ?> &nbsp;<i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp; <?php echo  date('g:i A',strtotime($eventData['checkIn'])); ?> to <?php echo  date('g:i A',strtotime($eventData['checkOut'])); ?><?php } ?></div>
 
<?php } ?>


 <?php if($eventData['sectionType']=='Meal'){ ?>
 <div style="margin-bottom:20px;">
 <i class="fa fa-calendar" aria-hidden="true"></i> &nbsp;<?php echo date('d M Y',strtotime($eventData['startDate'])); ?><?php if($eventData['showTime']==1){ ?> &nbsp;<i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp; <?php echo  date('g:i A',strtotime($eventData['checkIn'])); ?> TO <?php echo  date('g:i A',strtotime($eventData['checkOut'])); ?><?php } ?></div>
 
<?php } ?>


 <?php if($eventData['sectionType']=='FeesInsurance'){ ?>
 <div style="margin-bottom:20px;">
 <i class="fa fa-calendar" aria-hidden="true"></i> &nbsp;<?php echo date('d M Y',strtotime($eventData['startDate'])); ?></div>
 
<?php } ?>

<?php if($eventData['sectionType']=='Flight'){ ?>
<div style="margin-bottom:10px;">
 <i class="fa fa-calendar" aria-hidden="true"></i> &nbsp;<?php echo date('d M Y',strtotime($eventData['startDate'])); ?></div>
 <div style="margin-bottom:5px;">
 
 <table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" style="padding-right:20px; font-size:12px;"><div style="font-size:14px; font-weight:700; color:#000; margin-bottom:3px;"><?php echo  date('g:i A',strtotime($eventData['checkIn'])); ?></div><?php echo  stripslashes($eventData['fromDestination']); ?></td>
    <td align="center" style="width:100px;"><?php if($eventData['flightDuration']!=''){ ?><div style="text-align:center; font-size:11px; color:#666666;padding-bottom: 4px;"><?php echo stripslashes($eventData['flightDuration']); ?></div><?php } ?><div style="font-size:0px; border-top:2px solid #ddd; position:relative;"><i class="fa fa-plane" aria-hidden="true" style="position: absolute; font-size: 18px; transform: rotate(45deg); top: -9px; left: 40%;"></i></div></td>
    <td align="center" style="padding-left:20px;"><div style="font-size:14px; font-weight:700; color:#000; margin-bottom:3px;"><?php echo  date('g:i A',strtotime($eventData['checkOut'])); ?></div><?php echo  stripslashes($eventData['toDestination']); ?></td>
  </tr>
</table>
 
 
 </div>
 
<?php } ?>

<?php if($eventData['sectionType']=='Leisure'){ ?>
 <div style="margin-bottom:20px;">
 <i class="fa fa-calendar" aria-hidden="true"></i> &nbsp;<?php echo date('d M Y',strtotime($eventData['startDate'])); ?> </div>
 
<?php } ?>

<?php echo (stripslashes($eventData['description'])); ?>

</div>
</div>
 
 
 <?php if($eventData['sectionType']=='Transportation' || $eventData['sectionType']=='Activity' || $eventData['sectionType']=='Leisure'){ ?>
<div class="col-md-6 col-xl-6 hideinmobile">
<div class="actiimgbox"><img  id="eventimage<?php echo $eventData['id']; ?>" src="<?php echo $fullurl; ?>package_image/<?php  if($eventData['eventPhoto']!=''){ echo $eventData['eventPhoto']; } else {   if($eventData['sectionType']=='Transportation' ){ echo 'notransfer.png'; }if($eventData['sectionType']=='Activity' ){ echo 'noactivity.png'; }if($eventData['sectionType']=='Meal' ){ echo 'nomeal.png'; } }?>" /></div>


 
 	
</div>


<?php }  ?>






</div>


 



</div>


 
<?php } ?>


</div>
</div>
 
 <?php $n++;} ?>
 
 
 
 <div class="row">
<div class="col-md-12 col-xl-12">
<div class="itiday" style="text-align:center;">IMPORTANT TIPS 

 


</div>

</div>

<?php 
$rsa=GetPageRecord('*','sys_PackageTips',' packageId="'.$result['id'].'"   order by id asc');
while($packageTipsData=mysqli_fetch_array($rsa)){ 
?>
<div class="col-md-6 col-xl-6">
<div class="card">
<div class="card-body" style=" min-height:280px; padding:10px;">
<h6 style=" margin-top:0px;"><?php echo stripslashes($packageTipsData['title']); ?></h6>
<div style="height:280px; overflow:auto;"><?php echo stripslashes($packageTipsData['description']); ?></div>


</div>
</div>
</div>
<?php } ?>




</div>


 <div class="row">
<div class="col-md-12 col-xl-12">
<div class="itiday" style="text-align:center;">Comments</div>

<div style="padding-bottom:20px;">

<div class="col-md-12 col-xl-12">
<div class="card">
<div class="card-body" style="padding:20px !important;" id="loadpackagecommnet">
 
</div>


<script>
function funloadpackagecommnet(){
$('#loadpackagecommnet').load('<?php echo $fullurl; ?>loadpackagecommnet.php?id=<?php echo $result['id']; ?>');
}

funloadpackagecommnet();
</script>
</div>
</div>

</div>
 </div>
 
 
 
 <div class="row" style="display:none;">
<div class="col-md-12 col-xl-12"> 
<div class="card">
<div class="card-body"> 

<h5 style="line-height: 32px; margin-top:0px;">Inclusion / Exclusion   </h5>
<?php echo (stripslashes($result['inclusionExclusion'])); ?>
  </div> 
  
  </div> </div> </div>
 
 
  
 </div>
 
</div>
</div>
<?php
$rs=GetPageRecord($select,'sys_userMaster','id="'.$result['addedBy'].'" '); 
$packagecreator=mysqli_fetch_array($rs);
?>
 <div style="width:100%; background-color:#343642; color:#fff; overflow:hidden; padding:20px 0px; "> 
<div class="container-fluid" style="padding-left:0px;">
<div class="main-content">
<div class="row">
<div class="col-md-6 col-xl-6">
<div class="card-body">
<div style="margin-bottom:10px; padding-bottom:10px; border-bottom:1px solid #ffffff30;">
<table border="0" cellpadding="0" cellspacing="0" style="color:#fff;">
  <tr>
    <td colspan="2"><div style="width:50px; height:50px; overflow:hidden; margin-right:10px; border-radius: 100%;"><img src="<?php echo $fullurl; ?><?php if($packagecreator['profilePhoto']!=''){ ?>profilepic/<?php echo $packagecreator['profilePhoto']; ?><?php } else { ?>profilepic/whiteuserphoto.png<?php } ?>" style="width:100%; height:auto; min-height:100%;" /></div></td>
    <td><div style="font-size:16px; margin-bottom:0px; font-weight:800;"><?php echo stripslashes($packagecreator['firstName']); ?> <?php echo stripslashes($packagecreator['lastName']); ?></div><div style="font-size:14px; margin-bottom:0px;"><?php echo stripslashes($invoicedataa['invoiceCompany']); ?></div></td>
  </tr>
</table>

</div>
<div style="margin-bottom:10px; padding-bottom:10px; border-bottom:1px solid #ffffff30;">
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="color:#fff;">
  <tr>
    <td width="50%" align="left">Email address</td>
    <td width="50%" align="right"><?php echo strip($packagecreator['email']); ?></td>
  </tr>
</table>

</div>
<div style="margin-bottom:10px; padding-bottom:10px; border-bottom:1px solid #ffffff30;">
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="color:#fff;">
  <tr>
    <td width="50%" align="left">Phone number
</td>
    <td width="50%" align="right"><?php echo strip($packagecreator['mobile']); ?></td>
  </tr>
</table>

</div>
 
<div style="margin-bottom:10px; padding-bottom:10px; border-bottom:1px solid #ffffff30;">
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="color:#fff;">
  <tr>
    <td width="50%" align="left">Website
</td>
    <td width="50%" align="right"><a style="color:#fff; text-decoration:none;" target="_blank" href="http://<?php echo str_replace('https://','',str_replace('http://','',$packagecreator['website'])); ?>"><i class="fa fa-external-link" aria-hidden="true"></i>&nbsp; <?php echo str_replace('https://','',str_replace('http://','',$packagecreator['website'])); ?></a></td>
  </tr>
</table>

</div>

</div>
</div>

<div class="col-md-6 col-xl-6">
<div class="card-body">

<div style="margin-bottom:10px; padding-bottom:10px; border-bottom:1px solid #ffffff30;">
<table border="0" cellpadding="0" cellspacing="0" style="color:#fff;">
  <tr>
    <td colspan="2"><div style="width:50px; height:50px; overflow:hidden; margin-right:10px; border-radius: 100%;"> </div></td>
    <td>  </td>
  </tr>
</table>

</div>
<div style="margin-bottom:10px; padding-bottom:10px; border-bottom:1px solid #ffffff30;">
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="color:#fff;">
  <tr>
    <td width="50%" align="left">Total price</td>
    <td width="50%" align="right">&#8377;<?php  echo $totalfinalcost; ?></td>
  </tr>
</table>

</div>
<div style="margin-bottom:10px; padding-bottom:10px; border-bottom:1px solid #ffffff30;">
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="color:#fff;">
  <tr>
    <td width="50%" align="left"><a style="cursor:pointer;" onclick="loadpop('Terms and Conditions',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=showterms&pid=<?php echo $_REQUEST['id']; ?>">Terms and conditions</a></td>
    <td width="50%" align="right">&nbsp; </td>
  </tr>
</table>

</div>
 
 
</div>
</div>
</div>
</div></div></div>
                                            
 </div>
                                            
 </div>

 
 <?php include "footer.php"; ?>  
 <style>
 .footerstripboxouter{display:none;}
 </style>