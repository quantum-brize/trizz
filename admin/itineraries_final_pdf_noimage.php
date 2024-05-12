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

<div style="background-color: #535353cc; position: fixed; width: 100%; height: 100%; z-index: 9999;"><div style="position: relative; width: 100%; text-align: center;"><div style="margin: auto; font-size: 20px;font-family: cursive; width: 30%; background-color: #fff; margin-top: 10%; padding: 20px; border-radius: 4px; font-weight: 700;">Please wait...</div></div></div>


<div style="padding:30px; font-family:Arial, Helvetica, sans-serif; font-size:13px; width:850px;" id="content2">
<div style="padding:20px; background-color:#e2f1f5; border-top:4px solid #22c7a6;">
<table width="100%" border="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top"><div style="font-size:11px; margin-bottom:10px;">Quote ID: <?php echo $_REQUEST['id']; ?> Quote Date: <?php echo date('j, F Y',strtotime($result['dateAdded'])); ?></div>
	<div style="font-size:22px;"><strong><?php echo $querydata['name']; ?> - <?php echo stripslashes($result['name']); ?></strong></div>
	
	<div style="margin-top:3px; font-size:13px;"><strong><?php echo stripslashes($result['destinations']); ?></strong></div>
	<div style="margin-top:3px; font-size:13px; line-height:20px;">Adults (Above 12 Years) - <?php echo stripslashes($result['adult']); ?><br />
Child (5-12 Years) - <?php echo stripslashes($querydata['child']); ?> Child (0-5 Years) - <?php if($querydata['infant']>0){ echo stripslashes($querydata['infant']); } else { echo '0'; } ?><br />
Date of Arrival : <?php echo date('j M Y',strtotime($querydata['startDate'])); ?><br />
Date of Departure: <?php echo date('j M Y',strtotime($querydata['endDate'])); ?></div>
<div style="margin-top:5px; font-size:18px; font-weight:700;"><strong><?php echo round($result['days']-1); ?> Nights / <?php echo stripslashes($result['days']); ?> Days  Tour Package</strong> </div>
	
	</td>
    <td width="50%" align="left" valign="top" style="padding-left:20px;"><img src="<?php echo $fullurl; ?>profilepic/<?php  echo $invoicedataa['invoiceLogo']; ?>" style="height:45px; width:auto; " />
	
	<div style="margin-top:10px; font-size:13px; line-height:24px;"> 
<strong>Executive Details</strong><br />
<?php echo stripslashes($packagecreator['firstName']); ?><br />
<?php echo strip($packagecreator['email']); ?><br />
<?php echo strip($packagecreator['countryCode']); ?> <?php echo strip($packagecreator['mobile']); ?>
</div></td>
  </tr>
</table>


</div>


<div style="margin: 20px 0px; background-color: #32c5ff; color: #fff; font-size: 16px; text-align: center; padding:20px; border: 4px solid #0cb3e5; border-radius: 20px;"><div style="font-size:22px; color:#fff;"><strong><?php if($result['billingType']==2){ ?>
       Cost Per Person Cost<?php } ?><?php if($result['billingType']==1){ ?>Total Cost <?php } ?></strong></div>
       <div style="font-size:14px; color:#fff; margin:10px 0px;"><i>Note: All above prices are subject to change without prior notice as per availability, <br />
       the final date of travel and any
changes in taxes.</i></div>
       <div style="font-size:30px; color:#fff;"><?php if($result['billingType']==2){ ?><strong>&#8377;<?php echo number_format($result['grossPrice']+$result['extraMarkup']); ?></strong><?php } ?>
	   
	   <?php if($result['billingType']==1){ ?><strong>&#8377;<?php echo number_format($result['grossPrice']); ?></strong> <span style="font-size:16px;">for <?php echo $result['adult']; ?> Adult(s)<?php if($result['child']>0){ ?> and <?php echo $result['child']; ?> Child(s)<?php } ?></span><?php } ?>
	   </div>	
 
</div>



<div style="margin: 20px 0px; background-color: #fff; color:#666666; font-size: 16px; text-align: center; padding:20px; border: 4px dashed #ccc; border-radius: 20px; line-height:22px; font-weight:700;"> 
Please think twice before printing this page. <br />

       Save paper, it's good for the environment.
</div>



<div style="padding:10px; font-size:16px; font-weight:700; background-color:#e7f3fe; border-left:4px solid #2196f3;">Tour Itinerary!</div>


  <?php
	$n=1;
$begin = new DateTime( $result['startDate'] );
$end   = new DateTime( $result['endDate'] );
 
 
for($i = $begin; $i <= $end; $i->modify('+1 day')){ 
$abcde=GetPageRecord('*','sys_packageBuilderEvent',' packageDays="'.$n.'" and packageId="'.$result['id'].'"'); 
$dayDetailsData=mysqli_fetch_array($abcde); 
?> 
<div style=" border:1px solid #ddd; margin:10px 0px;">
<div style="background-color:#f9f9f9; padding:15px; font-weight:500;border-bottom:1px solid #ddd; line-height:20px; font-size:16px;">Day <?php echo $n; ?> - <?php echo stripslashes($dayDetailsData['daySubject']); ?></div>
<div style="padding:15px; line-height:20px;"><?php echo strip_tags(stripslashes($dayDetailsData['dayDetails'])); ?></div>
</div>
<?php $n++; } ?>

<div style="padding:10px; font-size:16px; font-weight:700; background-color:#e7f3fe; border-left:4px solid #2196f3; margin:15px 0px;">Hotels & Activity Details</div> 

<table width="100%" border="0" cellpadding="10" cellspacing="0" bordercolor="#FFFFFF" style="font-size:14px; border:1px solid #ddd; font-size:13px; page-break-after: always;">
      <tr>
        <td colspan="2" bgcolor="#e7b5a7" style="color:#000000; font-weight:600;"><strong><?php echo stripslashes($result['name']); ?> - <?php echo round($result['days']-1); ?> Nights Stay</strong></td>
        </tr>
     <?php
	 
$begin = new DateTime( $result['startDate'] );
$end   = new DateTime( $result['endDate'] );
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
    </table>

<?php 
$rsa=GetPageRecord('*','sys_PackageTips',' packageId="'.$result['id'].'"   order by id asc');
while($packageTipsData=mysqli_fetch_array($rsa)){ 
?>
<div style="padding:10px; font-size:16px; font-weight:700; background-color:#e7f3fe; border-left:4px solid #2196f3; margin:15px 0px;"><?php echo stripslashes($packageTipsData['title']); ?></div>

<div style="margin-bottom:30px; font-size:14px;  line-height:20px;"><?php echo stripslashes($packageTipsData['description']); ?></div>

<?php } ?>


</div>
 <script>
 
domtoimage.toPng(document.getElementById('content2'))
.then(function (blob) {
	var pdf = new jsPDF('2', 'pt', [$('#content2').width(), $('#content2').height()]);

	pdf.addImage(blob, 'PNG', 0, 0, $('#content2').width(), $('#content2').height());
	pdf.save("<?php echo stripslashes($result['name']); ?>.pdf");  
	 
	setTimeout(function() {  window.open(window.location, '_self').close(); }, 3000);
	 
}); 
</script>

<script>
  window.print();
 </script>