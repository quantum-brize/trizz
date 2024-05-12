<?php
include "inc.php"; 
$selectpage=2;
if (!isset($_COOKIE[$cookie_name])) {
} else {
	$cookieuserid = $_COOKIE[$cookie_name];
}
if ($cookieuserid > 0) {
	$_SESSION['userId'] = $cookieuserid;
}



  $url = $basesiteurl."balancesheet.php"; 
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
 
 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
	<title>Balancesheet</title>
	<?php
	include "headerinc.php";
	?>

	<script>
		function opendashboard() {
			$('body').removeClass('loginbg');
			$('body').load('dashboard.php');
		}
	</script>

	<style>
		body {
			background-color: #f0f7fe;
		}
	</style>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
	<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
</head>

<body>

	<div class="innerpageaccountheader" style="width:100% !important;display:flex;justify-content: space-between;align-items:center;">
		<div><a onclick="closeWindow();" style="color:#FFFFFF !important;"><i class="fa fa-arrow-left" aria-hidden="true" ></i></a>Balance Sheet</div> 
	</div>
	 <div></div>
 
 
 <div class="bodyouter" style="margin-top:50px; padding:10px; " >
 <div style="padding: 10px; font-size: 18px; color: #FFFFFF; background-color: #6F66D7; border-radius: 5px; margin-bottom:10px;">Balance: ₹<?php echo $contentres['Balance']; ?></div>
 
 
 <?php foreach($contentres['Balancesheet'] as $list){ 
  ?>
<div class="bodybard" style="margin-bottom:10px;" onclick="openWindow('<?php echo $fullurl.'offerdetails.php?id='.$list['Id'].''; ?>');">
<div class="pading">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top">
	<div style="font-size:12px; font-weight:400; margin-bottom:5px;"><?php echo stripslashes($list['PaymentDate']); ?></div>
	<div style="font-size:12px; font-weight:600;">Ref. <?php echo stripslashes($list['RefNo']); ?></div>
	
	<div style="font-size:12px; font-weight:400; margin-top:5px;"><?php echo stripslashes($list['Description']); ?></div>
	
	
	</td>
    <td width="25%" align="center" valign="middle" style="padding-left:10px;"><span style="background-color: <?php if($list['PaymentType']!='Debit'){ ?>#26bbca<?php }else { ?>#ca2646<?php } ?>; color: #FFFFFF; font-size: 12px; font-weight: 600; display: inline-block; padding: 2px 5px; border-radius: 4px;"><?php echo stripslashes($list['Method']); ?></span></td>
    <td width="25%" align="right" valign="bottom" style="padding-left:10px;"><div style="font-size:12px; font-weight:400; margin-bottom:5px;"><?php echo stripslashes($list['PaymentType']); ?></div>
	<div style="font-size:16px; font-weight:600;">₹<?php echo stripslashes($list['Amount']); ?></div>	</td>
  </tr>
</table>

</div>

</div>
 <?php } ?>

 
</div>
 

	<?php 
	include "footerinc.php";
	?>

</body>

</html>