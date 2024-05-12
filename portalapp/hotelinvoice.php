<?php
include "inc.php";  

  $url = $basesiteurl."hotelbookingspage.php"; 
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
 
 
 $totalhotel=0; foreach($contentres['HotelBookings'] as $list) { 
 if($list['Status']=='Confirm'){
 
  $b=1; ?> 
<div class="bookcarddetails1"   onclick="openWindow('<?php echo $fullurl; ?>preview_ticket.php?k=<?php echo  base64_encode($list['Invoice']); ?>');">
<div class="idconfirmflex">
<div>
<h6>Booking No.: &nbsp; <?php echo $list['BookingNumber']; ?></h6> 
<p>Ref.: <?php echo $list['RefNo']; ?></p>
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
<h6><i class="fa fa-hotel" aria-hidden="true"></i> &nbsp;<?php echo $list['Hotel']; ?> - <?php echo $list['Category']; ?> Star</h6>
<p><strong>Check-in:</strong> <?php echo date('d M Y',strtotime($list['From'])); ?></p>
<p><strong>Check-out:</strong> <?php echo date('d M Y',strtotime($list['To'])); ?></p>
<p><strong>Amount:</strong> &#8377;<?php echo $list['Price']; ?></p>
</div>
</div>
 
</div>
 
</div>
<?php } } ?>
<?php if($b!=1){ ?>
<div style="padding:30px 0px; text-align:center;">No Booking Found</div>
<?php } ?>