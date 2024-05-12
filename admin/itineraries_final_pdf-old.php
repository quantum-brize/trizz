<?php 
$abcd=GetPageRecord('*','sys_packageBuilder','id="'.decode($_REQUEST['id']).'"'); 
$result=mysqli_fetch_array($abcd);  

$rs=GetPageRecord($select,'sys_userMaster','id in (select addedBy from sys_userMaster where id="'.$result['addedBy'].'") '); 
$invoicedataa=mysqli_fetch_array($rs);


$n=1;
$begin = new DateTime( $result['startDate'] );
$end   = new DateTime( $result['endDate'] );
?> 
 <style>
.wrapper{margin-top:117px !important; position:relative;}
.wbg{background-color:#fff; color:#000;padding:30px;position:absolute; left:0px; top:0px; width:100%;}
.bbg{background-color:#000; color:#fff;padding:30px;position:absolute; left:0px; top:0px; width:100%;}
.pnameheading{font-size:18px; line-height:40px;font-weight: 700; text-align:center; font-weight:600;}
.pnamedate{font-size: 16px; line-height: 29px; text-align:center;}
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
 
</style>
<div class="<?php if($result['packageTheme']==1){ ?>wbg<?php } else { ?>bbg<?php } ?>">
<div style="text-align:center;"><img src="<?php echo $fullurl; ?>profilepic/<?php  echo $invoicedataa['invoiceLogo']; ?>" style="height:65px; width:auto;" /></div>
 <div class="pnameheading"><?php echo stripslashes($result['name']); ?><br />
<span style="font-size:14px;"><?php echo date('d M Y',strtotime($result['startDate'])); ?> to <?php echo date('d M Y',strtotime($result['endDate'])); ?> - ID: <?php echo encode($result['id']); ?></span></div> 
<img src="<?php echo $fullurl; ?>package_image/<?php echo $result['coverPhoto']; ?>" /><br /><br />
<br />
<div class="col-md-12 col-xl-12" style="font-weight:700; page-break-after: always;" >
<?php if($result['billingType']==2){ ?>
<div style="padding: 30px;  text-align: center; font-size: 16px;   font-size:40px; color:#000;  ">&#8377;<?php echo number_format(round($result['grossPrice']/($result['adult']+$result['child']))+$result['extraMarkup']); ?> 
<div style="font-size:12px; text-transform:uppercase;  color:#333333;">Per Person Price</div>
</div>

<?php } ?>

<?php if($result['billingType']==1){ ?>
<div style="padding: 30px;  text-align: center; font-size: 16px;   font-size:35px; color:#000;   ">&#8377;<?php echo number_format($result['grossPrice']+$result['extraMarkup']); ?> 
<div style="font-size:12px; text-transform:uppercase;  color:#333333;"><?php echo $result['adult']; ?> Adult(s)<?php if($result['child']>0){ ?> and <?php echo $result['child']; ?> Child(s)<?php } ?> - Total <?php echo $result['adult']+$result['child']; ?> Pax Price</div>
</div>

<?php } ?>
</div>
 <?php
for($i = $begin; $i <= $end; $i->modify('+1 day')){ 
$abcde=GetPageRecord('*','sys_packageBuilderEvent',' packageDays="'.$n.'" and packageId="'.$result['id'].'"'); 
$dayDetailsData=mysqli_fetch_array($abcde); 
?> 
<div style="padding-top:0px; margin-top:0px; font-size:18px; font-weight:600; color:#fff; background-color:#6c757d; line-height:40px;">&nbsp;&nbsp;Day <?php echo $n; ?>  <?php echo date('D', strtotime($i->format("Y-m-d"))); ?>, <?php echo date('d M Y', strtotime($i->format("Y-m-d"))); ?></div><?php if($dayDetailsData['daySubject']!=''){ ?> 
<div style="font-size:18px; font-weight:800;"><?php echo stripslashes($dayDetailsData['daySubject']); ?></div><?php echo (stripslashes($dayDetailsData['dayDetails'])); ?><?php } ?>
 

<?php  
$rs=GetPageRecord('*','sys_packageBuilderEvent',' packageId="'.$result['id'].'" and packageDays="'.$n.'" order by time(checkIn) asc');
while($eventData=mysqli_fetch_array($rs)){ 
?> 

<div style="background-color:#6c757d; font-size:2px; width:100%;">&nbsp;</div><br /> 
<img src="<?php echo $fullurl; ?>package_image/<?php  if($eventData['eventPhoto']!=''){ echo $eventData['eventPhoto']; } else {   if($eventData['sectionType']=='Transportation' ){ echo 'notransfer.png'; }if($eventData['sectionType']=='Activity' ){ echo 'noactivity.png'; }if($eventData['sectionType']=='Meal' ){ echo 'nomeal.png'; } }?>"  style="width:900px;"  />
  
<div style=" font-size:15px; font-weight:600;"><?php echo stripslashes($eventData['name']); ?> <?php if($eventData['flightNo']!=''){ ?> <span style="color:#FF9900; padding-left:10px;">(<?php echo stripslashes($eventData['flightNo']); ?>)</span><?php } ?> <span style="color:#FF9900; padding-left:10px;"><?php echo starcategory($eventData['hotelCategory']); ?></span></div> 
 



 <?php if($eventData['sectionType']=='Accommodation'){ ?>
<div style="border-top:1px solid #ddd;border-bottom:1px solid #ddd; padding-top:10px; margin-bottom:10px;">
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
  <div style="margin-bottom:20px;"><strong>Room: </strong> <?php echo $eventData['cwbRoom']; ?> Child With Bad &nbsp;&nbsp;| &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Meal: </strong> <?php echo stripslashes($eventData['mealPlan']); ?></div>
<?php } ?>

<?php if($eventData['cnbRoom']>0){ ?> 
  <div style="margin-bottom:20px;"><strong>Room: </strong> <?php echo $eventData['cnbRoom']; ?> Child No Bad &nbsp;&nbsp;| &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Meal: </strong> <?php echo stripslashes($eventData['mealPlan']); ?></div>
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



<?php echo (stripslashes($eventData['description'])); ?>

 
 
 

 
<?php } ?>


 
 <?php $n++;} ?> 
 <div style="background-color:#6c757d; font-size:2px; width:100%;">&nbsp;</div> 
<h2 style="text-align:center;">IMPORTANT TIPS </h2>

<?php 
$rsa=GetPageRecord('*','sys_PackageTips',' packageId="'.$result['id'].'"   order by id asc');
while($packageTipsData=mysqli_fetch_array($rsa)){ 
?>
<div class="impn">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td style="font-size:14px;"><h4 style=" margin-top:0px;"><?php echo stripslashes($packageTipsData['title']); ?></h4>
<?php echo stripslashes($packageTipsData['description']); ?>  </td>
  </tr>
</table>
</div>
<?php } ?>




</div>
 
 <div style="background-color:#6c757d; font-size:2px; width:100%;">&nbsp;</div> 
 <h2 style="line-height: 32px; margin-top:0px;">Inclusion / Exclusion</h2>
<div style="font-size:14px;"></div><?php echo (stripslashes($result['inclusionExclusion'])); ?></div> 
<?php
$rs=GetPageRecord($select,'sys_userMaster','id="'.$result['addedBy'].'" '); 
$packagecreator=mysqli_fetch_array($rs);
?>
 <div style="width:100%; background-color:#343642; color:#fff; overflow:hidden; padding:20px 0px; "> 
<div class="container-fluid">
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
    <td width="50%" align="right"><?php echo strip($packagecreator['countryCode']); ?> <?php echo strip($packagecreator['mobile']); ?></td>
  </tr>
</table>

</div>
 
<div style="margin-bottom:10px; padding-bottom:10px; border-bottom:1px solid #ffffff30;">
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="color:#fff;">
  <tr>
    <td width="50%" align="left">Website
</td>
    <td width="50%" align="right"><a style="color:#fff; text-decoration:none;" target="_blank" href="http://<?php echo str_replace('https://','',str_replace('http://','',$packagecreator['website'])); ?>"><i class="fa fa-external-link" aria-hidden="true"></i></a></td>
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
    <td width="50%" align="right">&#8377;<?php if($result['billingType']==2){   echo number_format(round($result['grossPrice']/($result['adult']+$result['child']))+$result['extraMarkup']);   }   if($result['billingType']==1){   echo number_format($result['grossPrice']+$result['extraMarkup']);   } ?></td>
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
                                            
 

  
 <?php include "footer.php"; ?>  