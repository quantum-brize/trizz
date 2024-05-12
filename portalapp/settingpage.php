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



$url = $basesiteurl . "usersetting.php";
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
	<title>Settings</title>
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
		.profilecard .card-body { padding: 15px; }
	</style>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
	<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
</head>

<body>
	<div class="innerpageaccountheader" style="width:100% !important;display:flex;justify-content: space-between;align-items:center;">
		<div><a onclick="closeWindow();" style="color:#FFFFFF !important;"><i class="fa fa-arrow-left" aria-hidden="true" ></i></a>Settings</div>
	</div>
	<div class="bodypading" style="margin-top: 55px;">
		<div class="card profilecard">
			<div class="card-body">

				<h1>Security</h1>
				<p style="font-size: 14px;margin-top:0px;">Change password for this account</p>
				<div class="table-responsive">
					<table class="table table-bordered table-striped profiletable" style=" font-size:13px;">
						<tbody>
							<tr>
								<td align="left" valign="top">
									<div style="width:120px;"><strong>First Name </strong></div>
								</td>
								<td align="left" valign="top" class="profiledetail"><?php echo $contentres['FirstName']; ?></td>
							</tr>
							<tr>
								<td width="10%" align="left" valign="top"><strong>Last Name </strong></td>
								<td width="90%" align="left" valign="top" class="profiledetail"><?php echo $contentres['LastName']; ?></td>
							</tr>
							<tr>
								<td width="10%" align="left" valign="top"><strong>Email </strong></td>
								<td width="90%" align="left" valign="top" class="profiledetail"><?php echo $contentres['Email']; ?></td>
							</tr>
							<tr>
								<td width="10%" align="left" valign="top"><strong>Password</strong></td>
								<td width="90%" align="left" valign="top" class="profiledetail">***********</td>
							</tr>
						</tbody>
					</table>

					<div class=" " style="position:relative; width:100%; text-align:right;">
						<a style="cursor:pointer;" onclick="loadpop('Change Password',this,'400px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=changepassword"><button type="button" class="combutton">Change Password</button></a>
					</div>
				</div>
			</div>
		</div>

		<div class="card profilecard" style="margin-top: 20px;">
			<div class="card-body">

				<h1>Fixed Markup</h1>
				<p style="font-size: 14px;margin-top:0px;">Update fixed markup for flight booking</p>
				<div class="table-responsive">
					<form method="post" action="actionpage.php">
						<input type="hidden" class="form-control" name="action" value="fixedMarkupAgent">
						<div class="table-responsive">
							<table class="table balancesheettable" style="font-size:13px;">
								<thead style="background-color: #f6f6f6;">
									<tr>
										<th  align="left" valign="middle">Flight</th>
										<th  align="left" valign="middle">Type</th>
										<th  align="left" valign="middle">Value</th>
									</tr>
								</thead>
								<tbody>
								
								<?php foreach($contentres['FlightList'] as $list){  ?>
									<tr>
									<input type="hidden" class="form-control" name="flightId[]" value="<?php echo $list["FlightId"]; ?>">
										<td  align="left" valign="middle">
											<div><strong><?php echo $list["FlightName"]; ?></strong></div>										</td>
										<td width="30%" align="left" valign="middle">
											<select class="form-control" name="type[]">
			<option value="0" <?php if($list["MarkupType"]==0){ ?>selected="selected"<?php } ?>>Flat</option>
			<option value="1" <?php if($list["MarkupType"]==1){ ?>selected="selected"<?php } ?>>Percentage</option>
		</select>										</td>
										<td width="30%" align="left" valign="middle">
											<input type="number" class="form-control" name="value[]" value="<?php echo $list["MarkUp"]; ?>">										</td>
									</tr>
								<?php } ?>
									
									<?php foreach($contentres['FlightListInt'] as $list){  ?>
									<tr>
										<input type="hidden" class="form-control" name="flightId[]" value="30">
										<td align="left" valign="middle" style="background-color:#464646; color:#fff;">
											<div><strong>International</strong></div>										</td>
										<td width="30%" align="left" valign="middle" style="background-color:#464646; color:#fff;">
											<select class="form-control" name="type[]">
			<option value="0" <?php if($list["MarkupType"]==0){ ?>selected="selected"<?php } ?>>Flat</option>
			<option value="1" <?php if($list["MarkupType"]==1){ ?>selected="selected"<?php } ?>>Percentage</option>
		</select>										</td>
										<td width="30%" align="left" valign="middle" style="background-color:#464646; color:#fff;">
											<input type="number" class="form-control" name="value[]" value="<?php echo $list["MarkUp"]; ?>">										</td>
									</tr>
										<?php } ?>
								</tbody>
							</table>
							<div style="margin-top:10px;">
								<button type="submit" class="combutton" style="padding: 10px 20px;">Update Markup</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div><!-- bodypadding  -->


	<?php 
	include "footerinc.php";
	?>

</body>

</html>