<?php 
include "config/database.php"; 
include "config/function.php";  
include "config/setting.php";  
$qr=decode($_REQUEST['qr']); 

$namevalue ='verifyQrCode='.$qr.'';  
$where='qrCode="'.$qr.'"';    
updatelisting('sys_userMaster',$namevalue,$where); 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
<title>Verify QR Code</title>
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body style="text-align:center; background-color:#0074E8; color:#FFFFFF; font-size:16px; font-family:Arial, Helvetica, sans-serif;">
<div style="padding-top:100px; font-size:100px;"><i class="fa fa-check-circle" aria-hidden="true"></i></div>
<div style="text-align:center; margin-top:20px;"><strong>Accepted</strong></div>
</body>
</html>
