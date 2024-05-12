<?php 
if($_REQUEST['t']==1 || $_REQUEST['t']==2){
$namevalue ='packageTheme="'.$_REQUEST['t'].'"';  
$where='id="'.decode($_REQUEST['id']).'"';    
updatelisting('sys_packageBuilder',$namevalue,$where); 
}

$abcd=GetPageRecord('*','sys_packageBuilder','id="'.decode($_REQUEST['id']).'"'); 
$result=mysqli_fetch_array($abcd);  

$rs=GetPageRecord('*','sys_userMaster','id in (select addedBy from sys_userMaster where id="'.$result['addedBy'].'") '); 
$invoicedataa=mysqli_fetch_array($rs);
?>
 


<style>
<?php if($_REQUEST['ga']!='itineraries'){ ?>.container-fluid{padding-left:30px !important;}<?php } ?>
.wrapper{  position:relative;    padding-left: 90px;}
.wbg{background-color:#ffffffc7; color:#000;padding:30px;position:absolute; left:0px; top:0px; width:100%;  }
.bbg{background-color:#000000c4; color:#fff;padding:30px;position:absolute; left:0px; top:0px; width:100%;   }
.pnameheading{font-size:30px; line-height:41px;font-weight: 700;}
.pnamedate{font-size: 20px; line-height: 29px;}
.coverBanner{ height:650px; overflow:hidden;}
.coverBanner img{width:100%; height:auto; min-height:100%;}

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
 body {
    background-color: #eaeef2!important;
}
.itinerariesbox{padding:10px 30px !important;}
</style>

<div style="width:100%; padding-left:90px;" class="outeritibox">
<div style="margin:auto; max-width:100%; position:relative; max-width:1200px;">

<div style="width:100%; background-color:#f5f5f5; overflow:hidden; ">
<div class="<?php if($result['packageTheme']==1){ ?>wbg<?php } else { ?>bbg<?php } ?>">
<div class="row">
<div class="col-md-8 col-xl-8" >
<div class="pnameheading"><?php echo stripslashes($result['name']); ?></div>
<div class="pnamedate"><?php echo date('d M Y',strtotime($result['startDate'])); ?> to <?php echo date('d M Y',strtotime($result['endDate'])); ?> - ID: <?php echo encode($result['id']); ?></div>

</div>

<div class="col-md-4 col-xl-4" style="text-align:right;padding-right: 30px;"> <img src="<?php echo $fullurl; ?>profilepic/<?php  echo $invoicedataa['invoiceLogo']; ?>" style="height:65px; width:auto;" /></div>






</div>

</div>
</div>


<div class="coverBanner"><img src="<?php echo $fullurl; ?>package_image/<?php echo str_replace('','',$result['coverPhoto']); ?>"  /></div>




<div class="col-md-12 col-xl-12" style="font-weight:700;" >
<?php  ?>
<?php if($result['totalDiscount']>0){ ?><div style="padding: 30px;  text-align: center; font-size: 16px;   font-size:30px; color:#8f8b8b; border-bottom:1px solid #f3f3f3;padding-bottom: 0px;"><span style="font-size:20px;"><?php if($result['billingType']==2){ ?>Per Person Price<?php }else{ ?> Total <?php  } ?> </span><span style="text-decoration: line-through;">&#8377;<?php echo $totalfinalcost=number_format(round($result['grossPrice']+$result['totalDiscount'])); ?> </span></div><?php } ?>
<div style="padding: 30px;  text-align: center; font-size: 16px;   font-size:40px; color:#000; border-bottom:1px solid #f3f3f3;padding-top: 0px;">&#8377;<?php echo $totalfinalcost=number_format(round($result['grossPrice'])); ?> 
<div style="font-size:12px; text-transform:uppercase;  color:#333333;"><?php if($result['billingType']==2){ ?>Per Person Price<?php }else{ ?> Total Package Cost <?php } ?></div>
<?php if($result['totalDiscount']>0){ ?>
<div style="font-size:12px; text-transform:uppercase;  color:#333333;">Discount: &#8377;<?php echo stripslashes($result['totalDiscount']); ?></div>
<?php } ?>
<?php if($result['ebo']!=''){ ?>
<div style="font-size:14px; text-transform:uppercase;  color:#333333;"><?php echo stripslashes($result['ebo']); ?></div>
<?php } ?>
</div>

<?php  ?>

 
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
 

 ?>
<?php if($result['billingType']==1){ }  ?>


 


<?php if($result['queryId']>0){  if($_SESSION['userid']==''){ if($result['depositDueDate']=='' || $result['depositDueDate']>=date('Y-m-d')){  

if($result['depositAmount']>0){
$depositamount=$result['depositAmount'];
} else { 
$depositamount=$result['grossPrice'];
} ?> 

<?php if($result['depositDueDate']!=''){ ?>
<div style="color:#000; font-size:14px; width:100%; margin-bottom:20px; text-align:center;">For book this pacakge pay deposit amount &#8377;<?php echo number_format($depositamount); ?> - valid till <?php echo date('j F Y',strtotime($result['depositDueDate'])); ?></div>
<?php } } } } ?>

</div>



<div class="container-fluid" style="padding-left:20px;">
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

<button type="button" id="page<?php echo $n; ?>" class="btn btn-secondary btn-sm waves-effect" style="float:right; font-size:12px;" onclick="loadpop('Day <?php echo $n; ?> Details',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=editDayDetails&pid=<?php echo $_REQUEST['id']; ?>&d=<?php echo $n; ?>"><i class="fa fa-pencil" aria-hidden="true"></i> Day Details</button>


</div>
<?php if($dayDetailsData['daySubject']!=''){ ?>
<div class="card">
<div class="card-body"> 
<h5 style="margin-top:0px;"><?php echo stripslashes($dayDetailsData['daySubject']); ?></h5>
<?php echo (stripslashes($dayDetailsData['dayDetails'])); ?>
</div>
</div>
<?php } ?>

<?php  
$rs=GetPageRecord('*','sys_packageBuilderEvent',' packageId="'.$result['id'].'" and packageDays="'.$n.'" order by sr, time(checkIn) asc');
while($eventData=mysqli_fetch_array($rs)){ 
?> 


<div class="card" style="overflow: hidden;">
<div class="row"> 







<?php if($eventData['sectionType']=='Accommodation' || $eventData['sectionType']=='FeesInsurance' || $eventData['sectionType']=='Flight' || $eventData['sectionType']=='Meal' || $eventData['sectionType']=='Cruise'){ ?>
<div class="<?php if($eventData['sectionType']=='Flight'){ ?>col-md-3 col-xl-3<?php } else { ?>col-md-6 col-xl-6<?php } ?>" style="position:relative;">
<div class="<?php if($eventData['sectionType']=='Flight'){ ?>actiimgboxflight<?php } else {  ?>actiimgbox<?php } ?>"><img id="eventimage<?php echo $eventData['id']; ?>" <?php if($eventData['sectionType']=='Flight'){ ?> style="height:100%;" <?php } ?>  src="<?php echo $fullurl; ?>package_image/<?php if($eventData['eventPhoto']!=''){ echo $eventData['eventPhoto']; } else {  if($eventData['sectionType']=='Accommodation' ){ echo 'nohotel.png'; } if($eventData['sectionType']=='Cruise' ){ echo 'nohotel.png'; }if($eventData['sectionType']=='FeesInsurance' ){ echo 'nofee.png'; }if($eventData['sectionType']=='Flight' ){ echo 'noother.png'; } } ?>" /></div>


<button type="button" class="optionmenu" style="position: absolute; right: -0px; top:20px; background-color: #fff; padding: 10px; border-radius: 5px; padding-right: 14px; font-size: 14px; color: #000; padding: 5px 18px; line-height: 28px;"  onclick="loadpop('Media library',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=medialibrary&afunctin=changeeventimage<?php echo $eventData['id']; ?>&pid=<?php echo $_REQUEST['id']; ?>">
<i class="fa fa-pencil" aria-hidden="true"></i> Edit </button>
 	
</div>


<?php } ?>

 <script>
function changeeventimage<?php echo $eventData['id']; ?>(img){
 $('#eventimage<?php echo $eventData['id']; ?>').attr('src','<?php echo $fullurl; ?>package_image/'+img);
 $( ".close" ).trigger( "click" );
 $('#ActionDiv').load('actionpage.php?pid=<?php echo encode($result['id']); ?>&id=<?php echo ($eventData['id']); ?>&action=seteventcoverphoto&imagename='+img);
}
</script>
<div class="<?php if($eventData['sectionType']=='Flight'){ ?>col-md-9 col-xl-9<?php } else { ?>col-md-6 col-xl-6<?php } ?> itinerariesbox">
<div class="card-body" style="padding-top:20px;"> 
<h5 style="line-height: 32px; margin-top:0px; margin-bottom: 2px;"><?php echo stripslashes($eventData['name']); ?> <?php if($eventData['flightNo']!=''){ ?> <span style="color:#FF9900; padding-left:10px;">(<?php echo stripslashes($eventData['flightNo']); ?>)</span><?php } ?> <span style="color:#FF9900; padding-left:10px;"><?php echo starcategory($eventData['hotelCategory']); ?></span></h5> 
 



 <?php if($eventData['sectionType']=='Accommodation'){ ?>
<div style="border-top:1px solid #ddd;border-bottom:1px solid #ddd; padding-top:10px; margin-bottom:10px;">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"><div style="margin-bottom:10px;">
<div style="margin-bottom:2px;">Check-in</div>
<div style="margin-bottom:5px; font-weight:700;"><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo date('d M Y',strtotime($eventData['startDate'])); ?><?php if($eventData['showTime']==1){ ?> - <?php echo  date('g:i A',strtotime($eventData['checkIn'])); ?><?php } ?></div>
</div></td>
    <td><div style="margin-bottom:10px;">
<div style="margin-bottom:2px;">Check-out</div>
<div style="margin-bottom:5px; font-weight:700;"><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo date('d M Y',strtotime($eventData['endDate'])); ?><?php if($eventData['showTime']==1){ ?> - <?php echo  date('g:i A',strtotime($eventData['checkOut'])); ?><?php } ?></div>
</div></td>
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
  <div style="margin-bottom:20px;"><strong>Room: </strong> <?php echo $eventData['cwbRoom']; ?> Child With Bad &nbsp;&nbsp;| &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Meal: </strong> <?php echo stripslashes($eventData['mealPlan']); ?></div>
<?php } ?>

<?php if($eventData['cnbRoom']>0){ ?> 
  <div style="margin-bottom:20px;"><strong>Room: </strong> <?php echo $eventData['cnbRoom']; ?> Child No Bad &nbsp;&nbsp;| &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Meal: </strong> <?php echo stripslashes($eventData['mealPlan']); ?></div>
<?php } ?>
<?php } ?>

 <?php if($eventData['sectionType']=='Activity' || $eventData['sectionType']=='Transportation' ){ ?>
 <div style="margin-bottom:20px;">
 <i class="fa fa-calendar" aria-hidden="true"></i> &nbsp;<?php echo date('d M Y',strtotime($eventData['startDate'])); ?> &nbsp; <?php if($eventData['showTime']==1){ ?><i class="fa fa-clock-o" aria-hidden="true"></i>
 
<?php if(date('g:i A',strtotime($eventData['checkIn']))!=date('Y-m-d',strtotime($eventData['checkIn'])).' 00:01:00'){ ?>&nbsp; <?php echo  date('g:i A',strtotime($eventData['checkIn'])); ?> to <?php echo  date('g:i A',strtotime($eventData['checkOut'])); } ?><?php } ?></div>
 
<?php } ?>

<?php if($eventData['sectionType']=='Leisure'){ ?>
 <div style="margin-bottom:20px;">
 <i class="fa fa-umbrella" aria-hidden="true"></i> &nbsp;<?php echo date('d M Y',strtotime($eventData['startDate'])); ?> </div>
 
<?php } ?>



 <?php if($eventData['sectionType']=='Meal'){ ?>
 <div style="margin-bottom:20px;">
 <i class="fa fa-calendar" aria-hidden="true"></i> &nbsp;<?php echo date('d M Y',strtotime($eventData['startDate'])); ?> &nbsp;<?php if($eventData['showTime']==1){ ?><i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp; <?php echo  date('g:i A',strtotime($eventData['checkIn'])); ?> TO <?php echo  date('g:i A',strtotime($eventData['checkOut'])); ?><?php } ?></div>
 
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
    <td align="center" style="width:100px;">
	<?php if($eventData['flightDuration']!=''){ ?><div style="text-align:center; font-size:11px; color:#666666;padding-bottom: 4px;"><?php echo stripslashes($eventData['flightDuration']); ?></div><?php } ?>
	<div style="font-size:0px; border-top:2px solid #ddd; position:relative;"><i class="fa fa-plane" aria-hidden="true" style="position: absolute; font-size: 18px; transform: rotate(45deg); top: -9px; left: 40%;"></i></div></td>
    <td align="center" style="padding-left:20px;"><div style="font-size:14px; font-weight:700; color:#000; margin-bottom:3px;"><?php echo  date('g:i A',strtotime($eventData['checkOut'])); ?></div><?php echo  stripslashes($eventData['toDestination']); ?></td>
  </tr>
</table>
 
 
 </div>
 
<?php } ?>



<?php echo (stripslashes($eventData['description'])); ?>

<div style="margin-top:20px;"><a href="#" <?php if($result['quoteStatus']!=1 && $result['confirmQuote']!=1 || $_SESSION['userid']==1 || strpos($LoginUserDetails["permissionView"], 'PackagePermission') !== false){ ?> onclick="loadpop('<?php if($eventData['sectionType']=='FeesInsurance'){ echo 'Fees - Insurance'; } else {  echo $eventData['sectionType'];  }?> From <?php echo date('d-m-Y', strtotime($i->format("Y-m-d"))); ?>',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=add<?php echo $eventData['sectionType']; ?>&toatlPax=<?php echo $totalPax; ?>&pid=<?php echo $_REQUEST['id']; ?>&d=<?php echo date('Y-m-d', strtotime($i->format("Y-m-d"))); ?>&id=<?php echo encode($eventData['id']); ?>" <?php } ?>><button type="button" id="page2" class="btn btn-secondary btn-sm waves-effect" style="float:right; font-size:12px;"  ><i class="fa fa-pencil" aria-hidden="true"></i> Edit</button></a></div>

</div>
</div>
 
 
 <?php if($eventData['sectionType']=='Transportation' || $eventData['sectionType']=='Activity'){ ?>
<div class="col-md-6 col-xl-6">
<div class="actiimgbox"><img  id="eventimage<?php echo $eventData['id']; ?>" src="<?php echo $fullurl; ?>package_image/<?php  if($eventData['eventPhoto']!=''){ echo $eventData['eventPhoto']; } else {   if($eventData['sectionType']=='Transportation' ){ echo 'notransfer.png'; }if($eventData['sectionType']=='Activity' ){ echo 'noactivity.png'; }if($eventData['sectionType']=='Meal' ){ echo 'nomeal.png'; } }?>" /></div>


<button type="button" class="optionmenu"  onclick="loadpop('Media library',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=medialibrary&afunctin=changeeventimage<?php echo $eventData['id']; ?>&pid=<?php echo $_REQUEST['id']; ?>" style="position: absolute; left: -0px; top:20px; background-color: #fff; padding: 10px; border-radius: 5px; padding-right: 14px; font-size: 14px; color: #000; padding: 5px 18px; line-height: 28px;">
<i class="fa fa-pencil" aria-hidden="true"></i> Edit </button>
 	
</div>


<?php }  ?>


 <?php if($eventData['sectionType']=='Leisure'){ ?>
<div class="col-md-6 col-xl-6">
  <div class="actiimgbox"><img  id="eventimage<?php echo $eventData['id']; ?>" src="<?php echo $fullurl; ?>package_image/<?php  if($eventData['eventPhoto']!=''){ echo $eventData['eventPhoto']; } else { if($eventData['sectionType']=='Leisure' ){ echo 'noactivity.png'; } }?>" /></div>
  <button type="button" class="optionmenu"  onclick="loadpop('Media library',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=medialibrary&afunctin=changeeventimage<?php echo $eventData['id']; ?>&pid=<?php echo $_REQUEST['id']; ?>" style="position: absolute; left: -0px; top:20px; background-color: #fff; padding: 10px; border-radius: 5px; padding-right: 14px; font-size: 14px; color: #000; padding: 5px 18px; line-height: 28px;">
<i class="fa fa-pencil" aria-hidden="true"></i> Edit </button>
 	
</div>


<?php }  ?>





</div>


 



</div>


 
<?php } ?>


</div>
</div>
 
 <?php $n++; } ?>
 
 
 
 
 <div class="row">
<div class="col-md-12 col-xl-12">
<div class="itiday" style="text-align:center;">IMPORTANT TIPS 

<button type="button" id="pageit" class="btn btn-secondary btn-sm waves-effect" style="float:right; font-size:12px;" onclick="loadpop('Add Tips',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addtips&pid=<?php echo $_REQUEST['id']; ?>&b=3&d=it"><i class="fa fa-pencil" aria-hidden="true"></i> Add Tips</button>


</div>

</div>

<?php 
$rsa=GetPageRecord('*','sys_PackageTips',' packageId="'.$result['id'].'"   order by id asc');
while($packageTipsData=mysqli_fetch_array($rsa)){ 
?>
<div class="col-md-6 col-xl-6">
<div class="card">
<div class="card-body" style="    min-height: 180px;">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="2%" colspan="2" valign="top" style="padding-right:20px;"><img src="<?php echo $fullurl; ?>package_image/<?php echo stripslashes($packageTipsData['iconset']); ?>" style="width: 80px;" /><!--<div style="background-color: #74cc01; color: #fff; height: 36px; margin-right: 10px; text-align: center; width: 36px; line-height: 40px; font-size: 18px; border-radius: 30px;"><i class="fa <?php echo stripslashes($packageTipsData['iconset']); ?>" aria-hidden="true"></i></div>--></td>
    <td><h6 style=" margin-top:0px;"><?php echo stripslashes($packageTipsData['title']); ?></h6>
<?php echo str_replace('*','&#10004;',(stripslashes($packageTipsData['description']))); ?> 
<button type="button" id="pageit" class="btn btn-secondary btn-sm waves-effect" style="float:right; font-size:12px;" onclick="loadpop('Add Tips',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addtips&pid=<?php echo $_REQUEST['id']; ?>&id=<?php echo encode($packageTipsData['id']); ?>&b=3&d=it"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</button></td>
  </tr>
</table>


</div>
</div>
</div>
<?php } ?>




</div>
 
 
 
 
 
 
 
 
 
 
 
 
 <div class="row" style="display:none;">
<div class="col-md-12 col-xl-12"> 
<div class="card">
<div class="card-body"> 

<h5 style="line-height: 32px; margin-top:0px;">Inclusion / Exclusion <button type="button" id="pageinc" class="btn btn-secondary btn-sm waves-effect" style="float:right; font-size:12px;" onclick="loadpop('Inclusion - Exclusion',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=editinclusionExclusionDetails&pid=<?php echo $_REQUEST['id']; ?>&d=inc"><i class="fa fa-pencil" aria-hidden="true"></i> Edit Details</button> </h5>
<?php echo (stripslashes($result['inclusionExclusion'])); ?>
  </div> 
  
  </div> </div> </div>
  
  
  <div class="row">
<div class="col-md-12 col-xl-12"> 
<div class="card">
<div class="card-body itinerariesbox" style="padding:20px 20px !important;"> 

<h5 style="line-height: 32px; margin-top:0px;">
Terms and Conditions <button type="button" id="pagetc" class="btn btn-secondary btn-sm waves-effect" style="float:right; font-size:12px;" onclick="loadpop('Terms and Conditions',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=edittermsandconditionsDetails&pid=<?php echo $_REQUEST['id']; ?>&d=tc"><i class="fa fa-pencil" aria-hidden="true"></i> Edit Details</button> </h5>
<?php echo (stripslashes($result['terms'])); ?>
  </div> 
  
  </div> </div> </div>
 
 
  
 </div>
 
</div>
</div>






       <button type="button" class="optionmenu" data-toggle="dropdown" aria-expanded="false" style="position: absolute; right: -5px; top: 210px; background-color: #fff; padding: 10px; border-radius: 5px; padding-right: 14px; font-size: 14px; color: #000; padding: 5px 18px; line-height: 28px;">
                                         <i class="fa fa-pencil" aria-hidden="true"></i> Edit </button>
                                            <div class="dropdown-menu" style=""> 
											
                                                <a class="dropdown-item"  style="cursor:pointer;" onclick="loadpop('Media library',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=medialibrary&afunctin=changeCoverPhoto&pid=<?php echo $_REQUEST['id']; ?>">Replace Cover Photo</a>	
												
												 <a class="dropdown-item"  href="display.html?ga=itineraries&view=1&id=<?php echo $_REQUEST['id']; ?>&b=3&t=<?php if($result['packageTheme']==1){ echo '2'; } else {  echo '1';   } ?>" style="cursor:pointer;"><?php if($result['packageTheme']==1){ ?>Dark Theme<?php } else { ?>Light Theme<?php } ?></a>
												
																							</div>
 </div>
</div>
 <script>
 function changeCoverPhoto(img){
 $('.coverBanner img').attr('src','<?php echo $fullurl; ?>package_image/'+img);
 $( ".close" ).trigger( "click" );
 $('#ActionDiv').load('actionpage.php?pid=<?php echo encode($result['id']); ?>&action=setpackagecoverphoto&imagename='+img);
 }
 
 
 
 
 </script>


<script>
<?php if($_GET['d']!=''){ ?>
	$('#page<?php echo $_GET['d']; ?>').focus();
	<?php 
} ?>
</script>