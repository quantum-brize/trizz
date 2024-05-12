<?php
include "inc.php";
$cookie_name = "user";
if (!isset($_COOKIE[$cookie_name])) {
} else {
	$cookieuserid = $_COOKIE[$cookie_name];
}
if ($cookieuserid > 0) {
	$_SESSION['userId'] = $cookieuserid;
}

$actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$actual_link =str_replace($fullurl,'',$actual_link);
$actual_link =str_replace('hotelsearch.php','searchloadhotel.php',$actual_link);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
	<title>Hotel Search</title>
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
<div class="innerpageaccountheader filtercontents" style="width:100% !important;"><div><a href="<?php echo $fullurl; ?>hotelpage.php" style="color:#FFFFFF !important;"><i class="fa fa-arrow-left" aria-hidden="true" ></i></a>Hotels</div> <div><i class="fa fa-filter" aria-hidden="true"></i></div></div>
<div class="bodyouter" style=" padding:10px;">
	<section class="cardsection" style="margin-top: 50px;">
		<div class="container">
		
		<div style="padding:10px; border:1px solid #ddd; margin-bottom:10px; border-radius: 10px;">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" style="font-size:16px; font-weight:600;"><?php echo $_REQUEST['citydestination']; ?> <span id="totalhotel"></span>
	
	<div style="font-size:12px; margin-top:4px;"><?php echo date('j M Y',strtotime($_REQUEST['checkInDate'])); ?>&nbsp; - &nbsp;<?php echo date('j M Y',strtotime($_REQUEST['checkOutDate'])); ?></div></td>
    <td width="30%" align="right"><a href="<?php echo $fullurl; ?>holidayspage.php" style="font-weight: 600; font-size: 14px; padding: 4px 10px; text-align: center; display: inline; border: 1px solid #ddd; background-color: var(--base-color) !important; color: #fff !important; border-radius: 5px; margin-right: 5px; display:none;"><i class="fa fa-filter" aria-hidden="true"></i> Filter</a></td>
    <td width="5%" align="right"><a href="<?php echo $fullurl; ?>hotelpage.php" style=" color:#0066CC; font-weight:600; font-size:14px; display:block; padding:4px 10px; text-align:center;">Edit</a></td>
  </tr>
</table>

</div>
<div style=" width:100%;" id="searchloadhotel">
			<div style="padding:50px 0px; text-align:center;"><img src="images/loading-gif.gif" style="width:32px; height:32px;" /></div>
			</div>
			
			<script>
			$('#searchloadhotel').load('<?php echo $actual_link; ?>');
			</script>

	 
		</div>
	</section>

</div>


	<?php
	include "footerinc.php";
	?>

</body>

</html>