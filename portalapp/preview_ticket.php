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
$actual_link =str_replace('flightsearch.php','searchloadflight.php',$actual_link);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
	<title>Preview</title>
	<?php
	include "headerinc.php";
	?>

	 
 
</head>

<body>
<div class="innerpageaccountheader filtercontents" style="width:100% !important;"><div><a onclick="closeWindow();" style="color:#FFFFFF !important;"><i class="fa fa-arrow-left" aria-hidden="true" ></i></a>Preview</div> <div></div></div>
 <iframe src="<?php echo base64_decode($_REQUEST['k']); ?>" width="100%" height="100" frameborder="0" style="position: absolute; height: 100%; margin-top: 50px;"></iframe>
 
</body>

</html>