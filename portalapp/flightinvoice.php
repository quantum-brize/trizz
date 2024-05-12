<?php
include "inc.php";  

  $url = $basesiteurl."flightbookingspage.php"; 
 $ch = curl_init($url);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);

$data = array(
'MemberId' => $_SESSION['userId']
); 

curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
$contents = curl_exec($ch);
$contentres=json_decode($contents,true); 
curl_close($ch); 
 
include "headerinc.php";  
 
 
 $totalhotel=0; foreach($contentres['FlightBookings'] as $list) { 
 
 if($list['Status']=='Confirm'){
 $b=1;
 
 
  ?> 
<div class="bookcarddetails1"  onclick="openWindow('<?php echo $fullurl; ?>preview_ticket.php?k=<?php echo  base64_encode($list['Invoice']); ?>');"   >
<div class="idconfirmflex">
<div>
<h6>Ref.: &nbsp; <?php echo $list['RefNo']; ?></h6> 
<p><?php echo date('d M Y - h:i:A',strtotime($list['BookingDate'])); ?></p>
</div>
<div class="text-end">
<?php if($list['Status']=='Confirm'){ ?>
<a><?php echo $list['Status']; ?></a>
<?php } ?>
<?php if($list['Status']=='Pending'){ ?>
<a style="background-color:#FF6600;"><?php echo $list['Status']; ?></a>
<?php } ?>
<?php if($list['Status']=='Cancelled'){ ?>
<a style="background-color:#CC0000;"><?php echo $list['Status']; ?></a>
<?php } ?>
<?php if($list['Status']=='Rejected'){ ?>
<a style="background-color:#CC0000;"><?php echo $list['Status']; ?></a>
<?php } ?>

<p><i class="fa fa-file-text-o" aria-hidden="true"></i></p>
</div>
</div>
<div class="idconfirmflex" style="border-bottom:0px;">
<div>
<h6><i class="fa fa-plane" aria-hidden="true"></i> <?php echo $list['Flight']; ?></h6>
<div style="text-align:left;"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> <?php echo date('d M Y - h:i:A',strtotime($list['JourneyDate'])); ?></div>
<?php if($list['PNR']!=''){ ?><div style="text-align:left;"><div style="order: #98F8D9 1px solid; background-color: #DAFEF5; padding: 3px 10px; display: inline-block; margin-top: 5px;"><?php echo $list['PNR']; ?></div><?php } ?>

</div>
</div>
<div class="text-end">
<p><strong>From:</strong> <?php echo $list['From']; ?></p>
<p><strong>To:</strong> <?php echo $list['To']; ?></p>
<p><strong>Amount:</strong> &#8377;<?php echo $list['TotalFare']; ?></p>
</div>
</div>
 
</div>
<?php } } ?>
<?php if($b!=1){ ?>
<div style="padding:30px 0px; text-align:center;">No Booking Found</div>
<?php } ?>