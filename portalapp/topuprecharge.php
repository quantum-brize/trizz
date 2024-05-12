<?php
include "inc.php";
$cookie_name = "user";
$selectpage = 2;
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
	<title>Top Up Recharge</title>
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
		.cardpricelist li { width: 46%; margin-bottom: 10px; margin-left:4px; margin-right:4px; display: inline-block; }
	</style> 
</head>

<body>
	<div class="innerpageaccountheader" style="width:100% !important;display:flex;justify-content: space-between;align-items:center;">
	<div><a onclick="closeWindow();" style="color:#FFFFFF !important;"><i class="fa fa-arrow-left" aria-hidden="true" ></i></a> Topup Recharge</div>
	</div>
	<div class="bodypading">
		<section class="profile">
			<div class="listcontent">
				<div class="card" style="border: 1px solid #ddd;">
					<div class="tbtabcontent" style="border-top-left-radius: 14px;">
						<div class="card-body" style="padding:0px;">
							<div class="selectamt" style="text-align:center;">SELECT AMOUNT</div>
							<ul class="cardpricelist" style="text-align:center;">
								<li>
									<div class="topupcol">
										<div class="card" style=" background-color:#f6f6f6">
											<label>
												<div class="card-body" style="text-align:center; cursor:pointer;">
													<div style="font-size:22px; text-align:center; font-weight:600;">₹5000</div>
													<input name="amount" type="radio" style="height: 20px; width: 20px;" value="5000" checked>
												</div>
											</label>
										</div>
									</div>
								</li>
								<li>
									<div class="topupcol">
										<div class="card"  style=" background-color:#f6f6f6">
											<label>
												<div class="card-body" style="text-align:center; cursor:pointer;">
													<div style="font-size:22px; text-align:center; font-weight:600;">₹10000</div>
													<input name="amount" type="radio" value="10000" style="height: 20px; width: 20px;">
												</div>
											</label>
										</div>
									</div>
								</li>
								<li>
									<div class="topupcol">
										<div class="card"  style=" background-color:#f6f6f6">
											<label>
												<div class="card-body" style="text-align:center; cursor:pointer;">
													<div style="font-size:22px; text-align:center; font-weight:600;">₹15000</div>
													<input name="amount" type="radio" value="15000" style="height: 20px; width: 20px;">
												</div>
											</label>
										</div>
									</div>
								</li>
								<li>
									<div class="topupcol">
										<div class="card"  style=" background-color:#f6f6f6">
											<label>
												<div class="card-body" style="text-align:center; cursor:pointer;">
													<div style="font-size:22px; text-align:center; font-weight:600;">₹20000</div>
													<input name="amount" type="radio" value="20000" style="height: 20px; width: 20px;">
												</div>
											</label>
										</div>
									</div>
								</li>

								<li style="width: 98%;">
									<div class="topupcol" style="width: 97%; margin: auto;">
										<div class="card">
											<label>
												<div class="card-body" style="text-align:center; cursor:pointer;">
													<div style="font-size:22px; text-align:center; font-weight:600;">
														<div style="font-size:13px;">Enter Amount</div><input min="1" name="customamount" id="customamount" type="number" value="" style="font-size: 22px;font-weight:600;">
													</div>
												</div>
											</label>
										</div>
									</div>
								</li>
								<li style="width: 98%;">
									<div class="paybtn"><button type="button" class="btn btn-secondary btn-icon btn-sm" onClick="payonlinenow();" style="width:97%;">Pay Now</button></div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>


	<?php 
	include "footerinc.php";
	?>

</body>

</html>