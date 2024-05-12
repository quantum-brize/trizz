<?php
include "inc.php";  

  $url = $basesiteurl."packageenquirypage.php"; 
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
 
 
 $totalhotel=0; foreach($contentres['PackageEnquiry'] as $list) { $b=1; ?> 
<div class="bookcarddetails1"   onclick="openWindow('<?php echo  $list['Voucher']; ?>');">
<div class="idconfirmflex">
<div>
<h6>Package: &nbsp; <?php echo $list['Package']; ?></h6> 
<p>Destination.: <?php echo $list['Destination']; ?></p>
<p><?php echo date('d M Y - h:i:A',strtotime($list['QueryDate'])); ?></p>
</div>
 
</div>
<div class="idconfirmflex" style="border-bottom:0px;">
<div> 
<p><strong>Departure:</strong> <?php echo $list['Departure']; ?></p>
<p><strong>Departure Date:</strong> <?php echo date('d M Y',strtotime($list['DepartureDate'])); ?></p>
<p><strong>Name:</strong> &#8377;<?php echo $list['Name']; ?></p>
<p><strong>Phone:</strong> &#8377;<?php echo $list['Phone']; ?></p>
<p><strong>Email:</strong> &#8377;<?php echo $list['Email']; ?></p>
</div>
</div>
 
</div>
 
</div>
<?php } ?>
<?php if($b!=1){ ?>
<div style="padding:30px 0px; text-align:center;">No Booking Found</div>
<?php } ?>