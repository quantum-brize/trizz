<?php
include "inc.php";
$cookie_name = "user";
$selectpage=2;
if (!isset($_COOKIE[$cookie_name])) {
} else {
	$cookieuserid = $_COOKIE[$cookie_name];
}
if ($cookieuserid > 0) {
	$_SESSION['userId'] = $cookieuserid;
}

 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
	<title>Bookings</title>
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
		<div>Booking</div> 
	</div>
	<div style="margin-top: 50px;">

		<div class="tabsall" style="border-bottom:1px solid #ddd;">
			<ul>
				<li onclick="selectbookingtab(1);" id="btb1" ><a href="#">Flight</a></li>
				<li onclick="selectbookingtab(2);" id="btb2"><a href="#">Hotel</a></li>
				<li onclick="selectbookingtab(3);" id="btb3"><a href="#">Package</a></li>
			</ul>
		</div><!-- tabsall  -->

		<div class="srchstaus" style="margin-top:0px; display:none;">
			<table style="width: 100%;">
				<tr>
					<td style="padding-bottom:0px;">
						<div class="input-group inputsearch2">
							<span class="input-group-text" id="basic-addon1"><i class="fa fa-search" aria-hidden="true"></i></span>
							<input type="text" class="form-control destinput" placeholder="Search" aria-label="Username" aria-describedby="basic-addon1">
						</div>					 </td>
				</tr>
			</table>
		</div>


		<div class="bodypading"></div>

	</div>
<script>
function selectbookingtab(id){
$('#btb1').removeClass('active');
$('#btb2').removeClass('active');
$('#btb3').removeClass('active');
if(id==1){
$('#btb1').addClass('active');
$('.bodypading').load('flightbookings.php');
}
if(id==2){
$('#btb2').addClass('active');
$('.bodypading').load('hotelbookings.php');
}
if(id==3){
$('#btb3').addClass('active');
$('.bodypading').load('packagebookings.php');
}
}

selectbookingtab(1);
</script>

	<?php
	include "footermenu.php";
	include "footerinc.php";
	?>

</body>

</html>