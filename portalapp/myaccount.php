<?php
include "inc.php"; 
$cookie_name = "user";
if(!isset($_COOKIE[$cookie_name])) {
     
} else {
    $cookieuserid=$_COOKIE[$cookie_name];
}
 if($cookieuserid>0){
$_SESSION['userId']=$cookieuserid; 
}
 

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

 
 
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
<title>My Account</title>
<?php
include "headerinc.php";
?>

<script>
function opendashboard(){
$('body').removeClass('loginbg');
$('body').load('dashboard.php');
}
</script>

<style>
body{background-color:#f0f7fe;}
</style>

</head>
<body>

<div class="innerpageaccountheader"><i class="fa fa-arrow-left" aria-hidden="true" onclick="closeWindow();"></i>My Account</div>
<div class="blkaria"></div>
<div class="bodyouter" style="margin-top: -60px; padding:10px;">
<div class="innerbodycard">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
 
  <tr>
    <td colspan="2" style="border: 1px solid #ddd; padding: 10px; border-radius: 5px;"><div class="profilelogo"><img src="<?php echo $contentslogin['Member']['Logo']; ?>" /></div></td>
    <td width="90%" style=" padding-left:15px; line-height: 22px;">
	<div style="font-size:18px; font-weight:700;"><?php echo stripslashes($contentslogin['Member']['CompanyName']); ?> (<?php echo stripslashes($contentslogin['Member']['DisplayId']); ?>)</div>
	<div style="font-size:14px; color:#666666;"><?php echo stripslashes($contentslogin['Member']['Email']); ?></div>
	<div style="font-size:14px; color:#666666;"><?php echo stripslashes($contentslogin['Member']['Phone']); ?></div>
	</td>
  </tr>
</table>

</div>
</div>

<div class="fullwhitesection" style="padding-top: 0px; padding-bottom: 0px;">
<div class="profilemenu">  

        <a onclick="openWindow('<?php echo $fullurl.'balancesheet.php'; ?>');">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"><i class="fa fa-money" aria-hidden="true"></i></td>
    <td width="96%">Balance Sheet<div>Your credit and debit entry list </div></td>
  </tr>
  
</table> </a>

        <a onclick="openWindow('<?php echo $fullurl.'topuprecharge.php'; ?>');">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"><i class="fa fa-retweet" aria-hidden="true"></i></td>
    <td width="96%">Topup Recharge<div>Recharge your wallet online</div></td>
  </tr>
  
</table></a>

  <a  onclick="openWindow('<?php echo $fullurl.'topuprequest.php'; ?>');">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"><i class="fa fa-cloud-upload" aria-hidden="true"></i></td>
    <td width="96%">Top Up Request<div>Make request to admin for wallet recharge</div></td>
  </tr>
  
</table></a>

 
 
 <a onclick="openWindow('<?php echo $fullurl.'settingpage.php'; ?>');">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"><i class="fa fa-cog" aria-hidden="true"></i></td>
    <td width="96%">Settings<div>Your all account setting in one place</div></td>
  </tr>
  
</table></a> 

<a onclick="openWindow('<?php echo $fullurl.'contentpage.php?page=1'; ?>');">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"><i class="fa fa-building" aria-hidden="true"></i></td>
    <td width="96%">About<div>Know about organization </div></td>
  </tr>
  
</table></a> 

 <a onclick="openWindow('<?php echo $fullurl.'contentpage.php?page=2'; ?>');">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"><i class="fa fa-file-text" aria-hidden="true"></i></td>
    <td width="96%">Terms &amp; conditions<div>Read organization terms </div></td>
  </tr>
  
</table></a>   
<a onclick="openWindow('<?php echo $fullurl.'contentpage.php?page=4'; ?>');">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"><i class="fa fa-align-center" aria-hidden="true"></i></td>
    <td width="96%">Privacy Policy<div>Read organization policy </div></td>
  </tr>
  
</table></a>    

 <a onclick="openWindow('<?php echo $fullurl.'contactpage.php'; ?>');">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"><i class="fa fa-life-ring" aria-hidden="true"></i></td>
    <td width="96%">Contact<div>24x7 customer support</div></td>
  </tr>
  
</table></a>     
 <a href="<?php echo $fullrul; ?>logout.php"  onclick="closeWindow();">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"><i class="fa fa-sign-out" aria-hidden="true"></i></td>
    <td width="96%">Logout</td>
  </tr>
  
</table></a>      

 

</div>
 

</div>


<?php
include "footerinc.php";
?>

</body>
</html>
