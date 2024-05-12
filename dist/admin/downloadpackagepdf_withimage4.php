<?php
include "inc.php"; 

$abcd=GetPageRecord('*','sys_packageBuilder','id="'.decode($_REQUEST['id']).'"'); 
$result=mysqli_fetch_array($abcd); 
if($result['id']!='' && $result['linkSharing']==1){

$select='*'; 
$where='id="'.$result['addedBy'].'"'; 
$rs=GetPageRecord($select,'sys_userMaster',$where); 
$LoginUserDetails=mysqli_fetch_array($rs);
 
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
 

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Didact+Gothic&display=swap" rel="stylesheet">


<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Archivo+Black&display=swap" rel="stylesheet">

<style>
.box{width: 794px; height: 1122px; position:relative; overflow-y: hidden;}
body{ padding:0px; margin:0px;font-family: 'Didact Gothic', sans-serif; font-size:14px;}
.firstpage{background: rgb(0,0,0); background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(0,0,0,0.40706705045299374) 69%, rgba(0,0,0,0.7123891793045343) 100%); width:100%; height:100%; position:absolute; left:0px; top:0px; }
.secpage{  width:100%; height:100%; position:absolute; left:0px; top:0px; }
.dayphoto { width: 80px; height: 80px; margin-right: 0px; overflow: hidden; border-radius: 16px; border: 3px solid #ffffff; box-shadow: 2px 2px 4px #0a0a0a45; }
.dayphoto img{width:100% !important; min-height:100% !important; height:auto !important;}
.box table tr td{font-size:12px !important;}
.secpage table tr td table { border: 1px solid #ddd !important; border-right: 1px solid #ddd !important; border-bottom: 1px solid #ddd !important; margin-bottom: 4px; border-radius: 10px; background-color: #ffffff61; line-height:16px !important; }
.secpage table tr td table tr td{ padding:10px !important;}
.secpage table tr td table tr td div{ font-size:12px !important;}
.secpage table tr td table tr td strong{ font-size:15px !important; font-weight:400 !important;}
.secpagelast { background: rgb(91,91,91); background: linear-gradient(180deg, rgba(91,91,91,1) 0%, rgba(0,0,0,1) 100%); width: 100%; height: 100%; position: absolute; left: 0px; top: 0px; font-family: 'Archivo Black', cursive; padding-top: 500px; text-align: center; font-size: 55px; color: #fff; text-shadow: 2px 2px 4px #00000061; }

</style>




<div style="width: 794px; ">

 <div class="box" style="overflow:hidden;">
<img src="<?php echo $fullurl; ?>package_image/<?php echo str_replace(' ','%20',$result['coverPhoto']); ?>" height="400" style="height:100%; width:auto; min-width:100%; margin-left: -290px;" />
<div class="firstpage">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="300" colspan="3">&nbsp;</td>
    </tr>
  <tr>
    <td colspan="3" align="center"><img src="<?php echo $fullurl; ?>profilepic/<?php  echo $invoicedataa['invoiceLogo']; ?>" style="height: 60px; width: auto; margin-bottom: 10px; padding: 10px; background-color: #ffffffb0; border-radius: 14px; " /></td>
  </tr>
  <tr>
    <td colspan="3" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="center" style="font-size: 50px !important; font-family: 'Archivo Black', cursive; padding: 10px 30px; color: #fff; text-shadow: 2px 2px 10px #000;"><?php echo stripslashes($result['name']); ?></td>
  </tr>
  <tr>
    <td colspan="3"  >&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"  ><div style="background-color: #ffffffde; margin: 0px 50px; padding: 20px; border-radius: 10px;background-image:url(images/iticontentbg.png); background-repeat:repeat;"><table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-size:16px;">
    <tr>
      <td style="padding:5px 0px;"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAABmJLR0QA/wD/AP+gvaeTAAABfUlEQVRIieXWPUscURTG8d8qamyUWJldsU5K8ROYPr4QsAsI6UO6FSVfJzYioo0h3yBBfAExabQwhWKhQYgoihYzC8tm2HtndtTCB05z7zznfzhzODM8N1VyPDuEaUziNUbS8z/YxxpWcVZWcf1YxF/cBeIcC6mnI1XxIwLYGlsYLQodkbQxL7QRR6jlhfZjswNoI37iRR7wlxKgjZiPhQ6JG6TYOMfLVkhXBngGA7FVRmgQUzHgd4FE16hLBqcmaeV1wDMZUaDf2reunuGpBzy/YsAXgSSvMjzDAc9FqyGr1T2BwrLWbHfA8999Fvg4kORD5FmzTgL3YEX7tl1J3mk1jXp61s6zHAOeDSQpEu9jwH04LRF6gt4YMHwsETwXCyWZ3O8lQDfk+9lAsjZ3OoDuydjRsaphtwB0WzLxHWkQ6zmgq0r8yFTwGZdtgP/wSYF3GqM3OMyAHqR3D6px3DZBbzD20NCGlprAXx8LCm+bwBOPCa7gm4IL4kl1D6g+L/ymwoEkAAAAAElFTkSuQmCC" width="32"/></td>
      <td width="99%" style="padding:5px 0px; padding-left:10px;font-size: 16px !important;"><?php echo stripslashes($result['destinations']); ?> - <?php echo round($result['days']-1); ?> nights, <?php echo stripslashes($result['days']); ?> days</td>
    </tr>
    <tr>
      <td style="padding:5px 0px;"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAABmJLR0QA/wD/AP+gvaeTAAABS0lEQVR4nO2aQU7DMBBFH5QNVyjdAeIGHIFbsOUK3KYn6m2QKiqQyiIsUTp2xvkO+U+KFEX25OfbHjuJwRhjjDFr5SpQ5jwxVrR+q7ijz3hdpmWU7R/X7jqOC+Qa8Bq81kvcMOfgcQLeGVps+3t+KqjfKu4omTmgV2bLAYvEBqgFqLEBagFqbIBagDFaIivBL+ADOAKfwENTRTNTsxSO1FFyz9BQR4aG+x4r/B8NKNK7+lnABqgFqLEBagFqbhrEjGbh7HJVrL4H2AC1ADUtckB0jGaXq2L1PcAGqAWoycwBl/4gdfkW6R4gvLdXgj1gA9QC1ChzgFeCDXgurZDZAxTz/AbYAY/AC/BWGkA5BKZyy/DtfxJLHgJPGUGWbEDxeK+laNvZTGyAAwnb5CL0ZsAO2JO0T7AmCfZgQhpLzgEp2AC1AGOMMcYYFT9T02E5130aiAAAAABJRU5ErkJggg==" width="32"/></td>
      <td style="padding:5px 0px; padding-left:10px;font-size: 16px !important;"><?php echo date('j M Y',strtotime($result['startDate'])); ?> <strong>to</strong> <?php echo date('j M Y',strtotime($result['endDate'])); ?></td>
    </tr>
    <tr>
      <td style="padding:5px 0px;"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAABmJLR0QA/wD/AP+gvaeTAAADhklEQVR4nO2azUtVQRjGf5kpEhFaGX0R1MZF/QFJRItKSaMIyW1aQkEFbSUKiiCKdv0TIdIXhIvaZZD2hUFqEYG5sBaltwumlraYudyr3Jnz3nPP3LnWPPBsznnfeZ/3nXNm5swcCAgICCgd6oFrwBsgDSxopoHX+t4Gb+ocow1IkU3axCnguCeNztAGzBOdfIZ/+IeKUI+s55dyEljvWlyF6wDAeWBNDL+1wLmEtXjBWwrv/QxfedCbOH4SvwAp1+JWuA6ASqQYONVYijGgrBEK4FuAb4QCxPBpBQaAGc0BoCVJUeWsoxXzlHXM4BN3CswwKR2JYNAS+IXBx0UB4uhIBDOWwL8MPi4KEEdHXhQ6BlRZ7lUbrqcLjJGLqQR15EUpZoGXnnydIM7jekTgZ+LhBHUkgjlL0DmL33WLn4lXHegoGs8tgfsjfFuAp9g3R1LAE8w9n4SOotCgg+f2wJy+1uAycJnqCAj4n1ALnAIeAaOo1Vga+Aw8ALq0TSl0nNExvwDTWscocA/oTFpHDXCJxSc5tlH8RJ42VgPNwA3gIeoU6Btqv/A7MA6MAL3AZeAoald4KdqRbbFPAt1ae1HYBgwJAi4AE0AH2dVlJepwow/72t3EaVRB2sgubytQPTwhbGMQ2Bo3+e2onpEEukv2EGMVcLEAXwnHgNOooqJj9Qh9x+MUoQa1Jx/V+CyLDy8OAsMJJr6UH4CmnHgXsK8Kc5+Egl6HK4JG08ABbV8F3HGYeC7ngVtkvwgPIRufuqXJr0N9htoaSwF7tf0m4FmJks/lALBRa9hH9AHMD4SzQ1dEQ79RX3gAW4BPHpLPcATYrLU0E/06dEgKcD+ikbParh6377uUw6inENR4ZLPtlRTgo6WBHm1Tjdqs8J18hv2o2QedpMluVFIA07v0FajTNrfLIOmlvKm11aEWWflsRIetpgAn9f0mCvvbo1ScJztFdlrsYhVgCHVKW4mai30na+J7YCVqxfguyQJk1vdRM0Q5sFNrbY9bABMqUEtS3wlGcQxHu92NZZCclI0uCtBXBolJ+Tjp5GtRHz6+E5NyBuGyV/qu7Ce70FgOqEJ9H0RCWoA98bV4g2gckBZgdxFCfGGXxEhagB1FCPGFnRIjaQGW4y/sIs3SnxBnWV6DICjNkf8KSAuwUJwWb4jML/wm51uAb4QC+BbgG6EAvgUEBAQE+MRf4zQr1ajhlicAAAAASUVORK5CYII=" width="32"/></td>
      <td style="padding:5px 0px; padding-left:10px;font-size: 16px !important;">Adults (Above 12 Years) : <?php echo stripslashes($result['adult']); ?> | Child (5-12 Years) : <?php echo stripslashes($querydata['child']); ?> Child (0-5 Years) - <?php if($querydata['infant']>0){ echo stripslashes($querydata['infant']); } else { echo '0'; } ?></td>
    </tr>
    
    
    <tr>
      <td colspan="2" style="padding:5px 0px;"><div style="margin-top:10px;   text-align:center; border-top:1px solid #ddd; padding-top:20px;">
 <div  ><div style="font-size:22px; color:#000; "><strong><?php if($result['billingType']==2){ ?>
        Per Person Cost
          <?php } ?><?php if($result['billingType']==1){ ?>Total Cost <?php } ?></strong></div>
       
       <div style="font-size:30px;  color:#000; font-family: 'Archivo Black', cursive;">
	   <?php  if($result['convertedCurrency']=='INR'){  ?>
	   <?php if($result['billingType']==2){ ?><strong>&#8377;<?php echo number_format(round($result['grossPrice'])); ?></strong><?php } ?>
	   
	   <?php if($result['billingType']==1){ ?><strong>&#8377;<?php echo number_format($result['grossPrice']); ?></strong>  <?php } ?>
	   <?php } else { ?>
	   <?php  echo $totalfinalcost=number_format(round($result['convertedCost'])).' '.$result['convertedCurrency']; ?> 
	   <?php } ?>
	   
	   <div style="  margin:10px 0px 0px; color:#4f4f4f; font-size:13px;line-height: 20px; font-family:Arial, Helvetica, sans-serif;"><i>Note: All  prices are subject to change without prior notice as per availability, <br />
       the final date of travel and any
changes in taxes.</i></div>
	   </div>	
</div>
 </div></td>
    </tr>
    
    <tr>
      <td colspan="2" align="center" style="padding:10px 0px;"></td>
    </tr>
  </table></div></td>
  </tr>
</table>

</div>
 </div>
 
 
 <?php
	$n=1;
$begin = new DateTime( $result['startDate'] );
$end   = new DateTime( $result['endDate'] );
 
 
for($i = $begin; $i <= $end; $i->modify('+1 day')){ 
$abcde=GetPageRecord('*','sys_packageBuilderEvent',' packageDays="'.$n.'" and packageId="'.$result['id'].'"'); 
$dayDetailsData=mysqli_fetch_array($abcde); 
?> 
 <div class="box" style="overflow:hidden; background-image:url(<?php echo $fullurl; ?>package_image/<?php  if($dayDetailsData['dayphoto']!=''){  echo str_replace(' ','%20',$dayDetailsData['dayphoto']); } else { echo $result['coverPhoto']; } ?>); background-repeat:no-repeat; background-size:100% 100%;">
 
<div class="secpage" style="background-color:transparent;">
 <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3" style="background-image:url(images/iticontentbg.png); background-repeat:repeat; padding:30px; padding-bottom:0px;">
	<?php if($n==1){ ?>
	<div style="padding:20px 0px; font-size:40px; font-weight:400; text-align:left; font-family: 'Archivo Black', cursive; color:#006699;text-shadow: 2px 3px #c9c9c9; ">ITINERARY</div>
	<?php } ?>
	
	<div style="font-size:32px; text-align:left; color:#000; margin-bottom:4px; margin-top:10px;  font-family: 'Archivo Black', cursive;">Day <?php echo $n; ?> - <?php echo stripslashes($dayDetailsData['daySubject']); ?></strong>
  </div>
	<div style="font-size:16px; font-weight:500; text-align:left;"><?php echo nl2br(strip_tags(stripslashes($dayDetailsData['dayDetails']))); ?></div>
	
	
	
	
	<div style="font-size:13px; margin-top:30px;">
	<?php  
$rstt=GetPageRecord('*','sys_packageBuilderEvent',' packageId="'.$result['id'].'"  and packageDays="'.$n.'" and sectionType="Flight" order by sr, time(checkIn) asc');
while($eventData=mysqli_fetch_array($rstt)){ 
?>  

<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top"><div class="dayphoto"><img src="data:image/png;base64,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">



 
</div></td>
    <td width="90%" align="left" valign="top" style="padding-left:10px; font-size:13px;line-height: 20px;"><div >
  <div style="font-size:16px; font-weight:700;"><?php echo stripslashes($eventData['name']); ?></div></div><table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" width="150"><?php echo  date('g:i A',strtotime($eventData['checkIn'])); ?><br />
      <strong><?php echo  stripslashes($eventData['fromDestination']); ?></strong></td>
    <td align="center" style="width:100px;"><?php if($eventData['flightDuration']!=''){ ?><div style="text-align:center; font-size:11px; color:#666666;padding-bottom: 4px;"><?php echo stripslashes($eventData['flightDuration']); ?></div><?php } ?><div style="font-size:0px; border-top:2px solid #ddd; position:relative;"><i class="fa fa-plane" aria-hidden="true" style="position: absolute; font-size: 18px; transform: rotate(45deg); top: -9px; left: 40%;"></i></div></td>
    <td align="center" width="150"><?php echo  date('g:i A',strtotime($eventData['checkOut'])); ?><br/>
      <strong><?php echo  stripslashes($eventData['toDestination']); ?></strong></td>
  </tr>
</table><div style="font-size:12px;line-height: 20px;"><?php echo strip_tags(stripslashes($eventData['description'])); ?></div></td>
  </tr>
</table>

  
<?php } ?>
	
	
<?php  
$rs=GetPageRecord('*','sys_packageBuilderEvent',' packageId="'.$result['id'].'" and packageDays="'.$n.'"  and sectionType="Accommodation" order by time(checkIn) asc');
while($eventData=mysqli_fetch_array($rs)){

if(date('Y-m-d', strtotime($i->format("Y-m-d")))>=$eventData['startDate'] && date('Y-m-d', strtotime($i->format("Y-m-d")))<$eventData['endDate']){
?>
<div>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top"><div class="dayphoto"><img src="<?php echo $fullurl; ?>package_image/<?php  if($eventData['eventPhoto']!=''){ echo $eventData['eventPhoto']; } else {   if($eventData['sectionType']=='Transportation' ){ echo 'notransfer.png'; }if($eventData['sectionType']=='Activity' ){ echo 'noactivity.png'; }if($eventData['sectionType']=='Meal' ){ echo 'nomeal.png'; } }?>" width="203" height="147"  style="border-radius: 5px; "></div></td>
    <td width="90%" align="left" valign="top" style="padding-left:10px; "> <?php if($eventData['sectionType']=='Accommodation'){ ?>
      <div style=" padding-top:4px; margin-bottom:4px;">
<div style="font-size:14px; font-weight:800; color:#000; margin-bottom:4px;font-family: 'Archivo Black', cursive;"><strong><?php echo stripslashes($eventData['name']); ?></strong></div>
 
</div>

<?php if($eventData['singleRoom']>0){ ?>
 
<div style="margin-bottom:4px; font-size:14px"><strong> Room: </strong> <?php echo $eventData['singleRoom']; ?> Single &nbsp;&nbsp;| &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Meal: </strong> <?php echo stripslashes($eventData['mealPlan']); ?>&nbsp;&nbsp; | &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Room Type: </strong> <?php echo stripslashes($eventData['hotelRoom']); ?></div>
 
 <?php } ?>
 
  <?php if($eventData['doubleRoom']>0){ ?>
 
 <div style="margin-bottom:4px; font-size:14px"><strong>Room: </strong> <?php echo $eventData['doubleRoom']; ?> Double &nbsp;&nbsp;| &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Meal: </strong> <?php echo stripslashes($eventData['mealPlan']); ?>&nbsp;&nbsp; | &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Room Type: </strong> <?php echo stripslashes($eventData['hotelRoom']); ?></div>
 <?php } ?>


<?php if($eventData['tripleRoom']>0){ ?>
 <div style="margin-bottom:4px; font-size:14px"><strong>Room: </strong> <?php echo $eventData['tripleRoom']; ?> Triple &nbsp;&nbsp;| &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Meal: </strong> <?php echo stripslashes($eventData['mealPlan']); ?> &nbsp;&nbsp; | &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Room Type: </strong> <?php echo stripslashes($eventData['hotelRoom']); ?></div>
<?php } ?>



<?php if($eventData['quadRoom']>0){ ?>
<div style="margin-bottom:4px; font-size:14px"><strong>Room: </strong> <?php echo $eventData['quadRoom']; ?> Quad &nbsp;&nbsp;| &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Meal: </strong> <?php echo stripslashes($eventData['mealPlan']); ?>&nbsp;&nbsp;| &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Room Type: </strong> <?php echo stripslashes($eventData['hotelRoom']); ?></div>
<?php } ?>


<?php if($eventData['cwbRoom']>0){ ?> 
  <div style="margin-bottom:4px; font-size:14px"><strong>Room: </strong> <?php echo $eventData['cwbRoom']; ?> Child With Bed &nbsp;&nbsp;| &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Meal: </strong> <?php echo stripslashes($eventData['mealPlan']); ?>&nbsp;&nbsp; | &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Room Type: </strong> <?php echo stripslashes($eventData['hotelRoom']); ?></div>
<?php } ?>

<?php if($eventData['cnbRoom']>0){ ?> 
  <div style="margin-bottom:4px;"><strong>Room: </strong> <?php echo $eventData['cnbRoom']; ?> Child No Bed &nbsp;&nbsp;| &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Meal: </strong> <?php echo stripslashes($eventData['mealPlan']); ?>&nbsp;&nbsp; | &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Room Type: </strong> <?php echo stripslashes($eventData['hotelRoom']); ?></div>
<?php } ?>
<?php } ?>
<div style="font-size:14px;line-height: 20px;">Check-In: <?php echo date('d-m-Y',strtotime($eventData['startDate'])); ?> | Check-Out: <?php echo date('d-m-Y',strtotime($eventData['endDate'])); ?></div>

<div style="font-size:14px;line-height: 20px;"><?php echo strip_tags(stripslashes($eventData['description'])); ?></div>

 
</td>
  </tr>
</table>

</div>
<?php  } } ?>

 <?php  
$rs=GetPageRecord('*','sys_packageBuilderEvent',' packageId="'.$result['id'].'"  and packageDays="'.$n.'" and  (sectionType="Activity" ) order by time(checkIn) asc');
while($eventData=mysqli_fetch_array($rs)){ 
?>
<div>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top"><div class="dayphoto"><img src="<?php echo $fullurl; ?>package_image/<?php  if($eventData['eventPhoto']!=''){ echo $eventData['eventPhoto']; } else { if($eventData['sectionType']=='Transportation' ){ echo 'notransfer.png'; }if($eventData['sectionType']=='Activity' ){ echo 'noactivity.png'; }if($eventData['sectionType']=='Meal' ){ echo 'nomeal.png'; } }?>" width="203" height="147" style="border-radius: 5px; " ></div></td>
    <td width="90%" align="left" valign="top" style="padding-left:10px; font-size:13px;line-height: 20px;"> <div style="font-size:14px; font-weight:500; color:#000; margin-bottom:4px;font-family: 'Archivo Black', cursive;"><strong><?php echo stripslashes($eventData['name']); ?></strong> </div><?php if($eventData['sectionType']=='Activity' || $eventData['sectionType']=='Transportation' ){ ?>
 <div style="margin-bottom:4px;">
 <i class="fa fa-calendar" aria-hidden="true"></i> &nbsp;<?php echo date('d M Y',strtotime($eventData['startDate'])); ?> &nbsp;<i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp; <?php echo  date('g:i A',strtotime($eventData['checkIn'])); ?> to <?php echo  date('g:i A',strtotime($eventData['checkOut'])); ?></div>
 
<?php } ?><?php echo strip_tags(stripslashes($eventData['description'])); ?></td>
  </tr>
</table>

</div>

<?php } ?>


 <?php  
$rs=GetPageRecord('*','sys_packageBuilderEvent',' packageId="'.$result['id'].'" and packageDays="'.$n.'" and  ( sectionType="Transportation") order by time(checkIn) asc');
while($eventData=mysqli_fetch_array($rs)){ 

?>
<div >
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top"><div class="dayphoto"><img src="<?php echo $fullurl; ?>package_image/<?php  if($eventData['eventPhoto']!=''){ echo $eventData['eventPhoto']; } else {   if($eventData['sectionType']=='Transportation' ){ echo 'notransfer.png'; }if($eventData['sectionType']=='Activity' ){ echo 'noactivity.png'; }if($eventData['sectionType']=='Meal' ){ echo 'nomeal.png'; } }?>" width="203" height="147"  style="border-radius: 5px; " ></div></td>
    <td width="90%" align="left" valign="top" style="padding-left:10px; font-size:13px;line-height: 20px;"> <div style="font-size:14px; font-weight:500; color:#000; margin-bottom:4px;font-family: 'Archivo Black', cursive;"><strong><?php echo stripslashes($eventData['name']); ?></strong> </div><?php if($eventData['sectionType']=='Activity' || $eventData['sectionType']=='Transportation' ){ ?>
 <div style="margin-bottom:4px;">
 <i class="fa fa-calendar" aria-hidden="true"></i> &nbsp;<?php echo date('d M Y',strtotime($eventData['startDate'])); ?> &nbsp;<i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp; <?php echo  date('g:i A',strtotime($eventData['checkIn'])); ?> to <?php echo  date('g:i A',strtotime($eventData['checkOut'])); ?></div>
 
<?php } ?><?php echo strip_tags(stripslashes($eventData['description'])); ?></td>
  </tr>
</table>

</div>

<?php } ?>

 <?php   
$rs=GetPageRecord('*','sys_packageBuilderEvent',' packageId="'.$result['id'].'"   and packageDays="'.$n.'" and  sectionType="Meal"  ');
while($eventData=mysqli_fetch_array($rs)){ 


 
?>
<div >
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top"><div class="dayphoto"><img src="<?php echo $fullurl; ?>package_image/<?php echo $eventData['eventPhoto']; ?>" width="203" height="147" style="border-radius: 5px; " ></div></td>
    <td width="90%" align="left" valign="top" style="padding-left:10px; font-size:13px;line-height: 20px;"> <div style="font-size:14px; font-weight:500; color:#000; margin-bottom:4px;font-family: 'Archivo Black', cursive;"><strong><?php echo stripslashes($eventData['name']); ?></strong> </div><?php if($eventData['sectionType']=='Meal' ){ ?>
 <div style="margin-bottom:4px;">
 <i class="fa fa-calendar" aria-hidden="true"></i> &nbsp;<?php echo date('d M Y',strtotime($eventData['startDate'])); ?> &nbsp;<i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp; <?php echo  date('g:i A',strtotime($eventData['checkIn'])); ?> to <?php echo  date('g:i A',strtotime($eventData['checkOut'])); ?></div>
 
<?php } ?><?php echo strip_tags(stripslashes($eventData['description'])); ?></td>
  </tr>
</table>

</div>

<?php } ?>

</div>
       </td>
    </tr>
  <tr>
    <td colspan="3"><img src="images/itifootbg.png" width="100%" height="80"></td>
  </tr>
</table>

</div>
 </div>
 
 <?php $n++; } ?>
 
 
 <div class="box" style="overflow:hidden;">
<img src="<?php echo $fullurl; ?>package_image/<?php  echo $result['coverPhoto'];   ?>"  style="height:100%; width:auto; min-width:100%;   filter: contrast(120%);" />
<div class="firstpage" style="background-color:transparent;">
 <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3" style="background-image:url(images/iticontentbg.png); background-repeat:repeat; padding:30px; padding-bottom:0px;">
	<?php if($n==1){ ?>
	<div style="padding:20px 0px; font-size:40px; font-weight:400; text-align:left; font-family: 'Archivo Black', cursive; color:#006699;text-shadow: 2px 3px #c9c9c9; ">Terms and Conditions</div>
	<?php } ?>
	<?php 
$rsa=GetPageRecord('*','sys_PackageTips',' packageId="'.$result['id'].'"   order by id asc limit 0,2');
while($packageTipsData=mysqli_fetch_array($rsa)){ 
?> 
	<div style="font-size:25px; text-align:left; color:#000; margin-bottom:4px; margin-top:10px;  font-family: 'Archivo Black', cursive;"><?php echo stripslashes($packageTipsData['title']); ?></strong>
  </div>
	<div style="font-size:14px; font-weight:500; text-align:left;"><?php echo stripslashes($packageTipsData['description']); ?></div>
	<?php } ?>
       </td>
    </tr>
  <tr>
    <td colspan="3"><img src="images/itifootbg.png" width="100%"></td>
  </tr>
</table>

</div>
 </div>
 
 <div class="box" style="overflow:hidden;">
<img src="<?php echo $fullurl; ?>package_image/<?php  echo $result['coverPhoto'];   ?>"  style="height:100%; width:auto; min-width:100%;   filter: contrast(120%);" />
<div class="firstpage" style="background-color:transparent;">
 <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3" style="background-image:url(images/iticontentbg.png); background-repeat:repeat; padding:30px; padding-bottom:0px;">
	<?php if($n==1){ ?>
	<div style="padding:20px 0px; font-size:40px; font-weight:400; text-align:left; font-family: 'Archivo Black', cursive; color:#006699;text-shadow: 2px 3px #c9c9c9; ">Terms and Conditions</div>
	<?php } ?>
	<?php 
$rsa=GetPageRecord('*','sys_PackageTips',' packageId="'.$result['id'].'"   order by id asc limit 2,4');
while($packageTipsData=mysqli_fetch_array($rsa)){ 
?> 
	<div style="font-size:25px; text-align:left; color:#000; margin-bottom:4px; margin-top:10px;  font-family: 'Archivo Black', cursive;"><?php echo stripslashes($packageTipsData['title']); ?></strong>
  </div>
	<div style="font-size:14px; font-weight:500; text-align:left;"><?php echo stripslashes($packageTipsData['description']); ?></div>
	<?php } ?>
       </td>
    </tr>
  <tr>
    <td colspan="3"><img src="images/itifootbg.png" width="100%"></td>
  </tr>
</table>

</div>
 </div>
 
 
 
 <div class="box" style="overflow:hidden;">
<img src="<?php echo $fullurl; ?>package_image/<?php  echo $result['coverPhoto'];   ?>"  style="height:100%; width:auto; min-width:100%;   filter: contrast(120%);" />
<div class="firstpage" style="background-color:transparent;">
 <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3" style="background-image:url(images/iticontentbg.png); background-repeat:repeat; padding:30px; padding-bottom:0px;">
	<?php if($n==1){ ?>
	<div style="padding:20px 0px; font-size:40px; font-weight:400; text-align:left; font-family: 'Archivo Black', cursive; color:#006699;text-shadow: 2px 3px #c9c9c9; ">Terms and Conditions</div>
	<?php } ?>
	 
	<div style="font-size:25px; text-align:left; color:#000; margin-bottom:4px; margin-top:10px;  font-family: 'Archivo Black', cursive;">Terms and Conditions</strong>
  </div>
	<div style="font-size:14px; font-weight:500; text-align:left;"><?php echo (stripslashes($result['terms'])); ?></div>
 
       </td>
    </tr>
  <tr>
    <td colspan="3"><img src="images/itifootbg.png" width="100%"></td>
  </tr>
</table>

</div>
 </div>
 
 
 <div class="box" style="overflow:hidden;"> 
<div class="secpagelast"  >
 Thank You!
<div style="text-align:center; margin-top:30px; margin-bottom:30px;"><img src="<?php echo $fullurl; ?>profilepic/<?php  echo $invoicedataa['invoiceLogo']; ?>" style="height: 60px; width: auto; margin-bottom: 10px; padding: 10px; background-color: #ffffffb0; border-radius: 14px; " /></div>

<div style="margin-bottom:10px; text-align:center; font-size:20px;"><strong>Call Us: </strong> <?php echo strip($packagecreator['countryCode']); ?> <?php echo strip($packagecreator['mobile']); ?></div>
<div style="margin-bottom:10px; text-align:center; font-size:20px;"><strong>Email: </strong><?php echo strip($packagecreator['email']); ?></div>
</div>
 </div>
</div>
 
 
 <?php } ?>

 <script>
  window.print();
 </script>