<?php
include "inc.php"; 

$selectpage=1;

$url = $basesiteurl."agentprofilepage_mobile.php";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);

		$data = array(
		'MemberId' => $_SESSION['userId']
); 

curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
$contents = curl_exec($ch);
$contentslogin=json_decode($contents,true); 
curl_close($ch);





$url = $basesiteurl."dashboard_mobile.php";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);

		$data = array(
		'MemberId' => $_SESSION['userId']
); 

curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
$contents = curl_exec($ch);
$reportdata=json_decode($contents,true); 
curl_close($ch);



$url = $basesiteurl."packagelistpage_mobile.php";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);

		$data = array(
		'MemberId' => $_SESSION['userId']
); 

curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
$contents = curl_exec($ch);
$packagedata=json_decode($contents,true); 
curl_close($ch); 
?>

<style>
body{background-color:#f0f7fe;}
</style>


<div id="dashboardservicebox">

<div id="dashboardlogindetailouter">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"><div class="nameround" onclick="openWindow('<?php echo $fullurl.'myaccount.php'; ?>');"><i class="fa fa-bars" aria-hidden="true" style="margin-top: 6px;"></i></div></td>
    <td width="99%"><div class="name">Welcome, <?php echo $contentslogin['Member']['CompanyName']; ?></div>
      <div class="dbalance"  onclick="openWindow('<?php echo $fullurl.'balancesheet.php'; ?>');">Balance: ₹<?php echo $contentslogin['Member']['WalletBalance']; ?> &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i></div>
	  
	  <i class="fa fa-bell-o" aria-hidden="true" style="position: absolute; right: 20px; font-size: 22px; color: #FFFFFF; top: 30px;"></i>
	  </td>
  </tr>
</table>


</div>


<div class="servicebox">
<a  onclick="openWindow('<?php echo $fullurl.'flightpage.php'; ?>');"><i class="fa fa-plane" aria-hidden="true"></i> 
<div>Flights</div></a>
<a  onclick="openWindow('<?php echo $fullurl.'hotelpage.php'; ?>');"><i class="fa fa-hospital-o" aria-hidden="true"></i><div>Hotels</div></a>
<a   onclick="openWindow('<?php echo $fullurl.'holidayspage.php'; ?>');"><i class="fa fa-suitcase" aria-hidden="true"></i><div>Holidays</div></a>

</div>
</div>

<div class="bodyouter" style="padding-top:190px;">
<div class="bodybardbanner">
<img src="images/mobilebanner.jpg" style="width:100%;" />
</div>

<div class="bodybard">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="33%" align="center"  style="border-right: 1px solid #ddddddcf;">
	<div style="padding:10px; font-size:11px;">
	
	<div style="font-size:22px; font-weight:600;"><?php echo $reportdata['Member']['Flight']; ?></div>	
	Flight Bookings
	</div>
	</td>
    <td width="33%" align="center"  style="border-right: 1px solid #ddddddcf;">
	<div style="padding:10px; font-size:11px;">
	
	<div style="font-size:22px; font-weight:600;"><?php echo $reportdata['Member']['Hotel']; ?></div>	
	Hotel Bookings
	</div>
	</td>
    <td width="33%" align="center">
	<div style="padding:10px; font-size:11px;">
	
	<div style="font-size:22px; font-weight:600;"><?php echo $reportdata['Member']['Holidays']; ?></div>	
	Holidays Enquiry
	</div>
	</td>
  </tr>
</table>


</div>
</div>
<div class="sectionheading" style="margin-top:-20px;">Top Packages <a   onclick="openWindow('<?php echo $fullurl.'holidayspage.php'; ?>');">View All <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a></div>
<div class="packagelistouter">
	<?php
	$n=1;
	foreach($packagedata['Package'] as $list){ 
	if($list['price']>0){
	
	if($n<11){
	?>
	<div class="packagebox" onclick="openWindow('<?php echo $fullurl.'packagedetails.php?id='.$list['packageId'].'&fromdate='.date("d-m-Y", strtotime("+1 day")).''; ?>');">
	<div class="imgbox">
	<img src="<?php echo stripslashes($list['banner']); ?>" />
	</div>
	<div class="name"><?php echo stripslashes($list['name']); ?></div>
	<div class="subline">Start From</div>
	<div class="price">₹<?php echo stripslashes($list['price']); ?></div>
	</div>
	
	
	<?php } $n++;  } }	?>
	
</div>



<?php include "footermenu.php"; ?>



<script>
$(window).scroll(function() { 
	
        if ($(document).scrollTop() > 1) {
		
            $('#dashboardlogindetailouter').hide();
        }
        else {
            $('#dashboardlogindetailouter').show();
        }
    });

 
</script>
