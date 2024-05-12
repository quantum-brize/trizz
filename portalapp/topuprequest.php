<?php
include "inc.php";
$selectpage = 2;
if (!isset($_COOKIE[$cookie_name])) {
} else {
	$cookieuserid = $_COOKIE[$cookie_name];
}
if ($cookieuserid > 0) {
	$_SESSION['userId'] = $cookieuserid;
}



$url = $basesiteurl . "topuprequest.php";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);

$data = array(
	'MemberId' => $_SESSION['userId']
);

curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
$contents = curl_exec($ch);
$contentres = json_decode($contents, true);
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
		<div><a onclick="closeWindow();" style="color:#FFFFFF !important;"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>Topup Request</div>
	 </div>
	 <div class="bodyouter" style="margin-top:50px; padding:10px; ">
		 <?php foreach($contentres['TopupRequest'] as $list){ ?>
		 <div class="card requestcard">
           <table width="100%">
			<tr>
				<td width="50%" style="text-align: left;">
					<div>
						<p class="date"><?php echo stripslashes($list['RequestDate']); ?></p>
						<p><strong>Ref. <?php echo stripslashes($list['RefNo']); ?></strong></p>
					</div>
			  </td>
				<td width="15%" align="center">
				  <span style="background-color: <?php if($list['PaymentMode']!='Credit'){ ?>#26bbca<?php }else { ?>#ca2646<?php } ?>; color: #FFFFFF; font-size: 12px; font-weight: 600; display: inline-block; padding: 2px 5px; border-radius: 4px; text-transform:capitalize;"><?php echo stripslashes($list['Status']); ?></span>			  </td>
				<td width="15%" class="" style="text-align: right;">
					<div class="amountshow">₹<?php echo $list['Amount']; ?></div>
			  </td>
			</tr>
		   </table>
		</div>
		
		<?php } ?><!-- requestcard  -->
	 </div>

	<?php
	include "footerinc.php";
	?>

</body>

</html>