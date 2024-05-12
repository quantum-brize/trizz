<?php  
include "config/database.php"; 
include "config/function.php";  
include "config/setting.php";  
 

if($_POST['username']!='' && $_POST['userpass']!=''){   
$username = clean($_POST['username']); 
$password = clean($_POST['userpass']); 


$ftoken = '';   
$loginreturn = login($username,$password,$ftoken);
if($loginreturn=='yes'){ 


 
 
$rs=GetPageRecord('*','sys_userMaster','id="'.$_SESSION['userid'].'" and email="'.$_SESSION['username'].'"'); 
$LoginUserDetails=mysqli_fetch_array($rs);
 

$rendnumber=mt_rand(100000, 999999);

$namevalue ='qrCode="'.$rendnumber.'",verifyQrCode="'.$rendnumber.'"';  
$where='id="'.$_SESSION['userid'].'"';    
updatelisting('sys_userMaster',$namevalue,$where);  

$_SESSION['sesQRCode']=$namevalue;


header("Location: ".$fullurl.""); 
exit(); 
 



 
 


} else {  
$errormsg='Invalid username or password';

}
}




 
$rsa=GetPageRecord('*','sys_userMaster','id=1'); 
$logincolor=mysqli_fetch_array($rsa);
?>
<!DOCTYPE html>
<html lang="zxx">
 
<head>
 
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <!-- External CSS libraries -->
    <link type="text/css" rel="stylesheet" href="login2/assets/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="login2/assets/fonts/font-awesome/css/font-awesome.min.css"> 

    <!-- Favicon icon -->
   <link rel="shortcut icon" href="login2/assets/img/favicon.ico" type="image/x-icon" >

    <!-- Google fonts -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800%7CPoppins:400,500,700,800,900%7CRoboto:100,300,400,400i,500,700">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">

    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="login2/assets/css/style.css"> 
	
	
 <style>
 .loginouter{ max-width:890px; margin:auto; margin-top:10%; background-color:#fff; box-shadow: 0px 2px 30px #ccc6; font-size:13px;}
 .loginouter .sectionpadding{padding:50px;}
 h1{font-size:26px; margin-bottom:5px; font-weight:500;}
 .sublinehead{font-size:14px; font-weight:600; margin-bottom:10px;}
 #loginForm{margin-top:20px;}
 .form-control{margin-bottom:20px; padding:10px 15px; font-size:14px;}
 .btn-primary{width: 100%; font-size: 14px; font-weight: 600; padding: 12px; margin-top: 10px;}
 
 @media only screen and (max-width: 600px) {
 .rightbox{display:none;}
 }
 </style>
</head>
<body>
  
 <img src="images/loginbg.png" style="position:fixed; left:0px; top:0px; width:100%; height:100%; z-index:-1;">
 
 <div class="loginouter">
 <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" width="60%">
	<div class="sectionpadding">
	<div style="margin-bottom:10px;"><img src="profilepic/<?php echo stripslashes($logincolor['invoiceLogo']); ?>" style="height:35px; margin-bottom:10px;"/></div>
	<h1>Sign in</h1>
	<div class="sublinehead">to access your account</div>
	
	<form id="loginForm" method="post">
                            <div class="form-group clearfix">
                                <div class="form-box">
								 <input name="username" type="email" id="emailAddress" class="form-control" placeholder="Email Address" aria-label="Email Address" required>
								  
                                    <i class="flaticon-mail-2"></i>
                                </div>
                            </div>
                            <div class="form-group clearfix">
                                <div class="form-box">
								<input name="userpass" type="password" class="form-control" id="userpass" autocomplete="off" placeholder="Password" aria-label="Password" required>
								 
                                    <i class="flaticon-password"></i>
                                </div>
                            </div>
                            <div class="checkbox form-group clearfix">
                                <div class="form-check float-start"> 
									<input id="remember-me" name="remember" class="form-check-input" type="checkbox">
                                    <label class="form-check-label" for="rememberme">
                                        Remember me
                                    </label>
                                </div> 
                            </div>
                            <div class="form-group clearfix">
                                <button type="button"  id="submitfrm" class="btn btn-primary btn-lg btn-theme">Login</button>
                            </div>
                        </form>
	
	</div>
	</td>
    <td style="border-left:2px solid #f1f1f1;" class="rightbox"><div class="sectionpadding" style="text-align:center; font-size:13px;"><img src="images/crmimgright.jpg" height="200">
	<div style="font-weight:600; font-size:16px;">System Features</div>
	<div style="margin-bottom:20px;">CRM system for query, booking management proposal itinerary, client, marketing and much more.</div>
	<div style="font-size:11px; color:#666666;">by TravBizz</div>
	
	</div></td>
  </tr>
</table>

 </div>
 


  <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript" charset="utf-8"></script>
  <script src="jquery.md5.min.js" type="text/javascript" charset="utf-8"></script>
  <script type="text/javascript" charset="utf-8">
    jQuery(document).ready(function($) {
      $('#submitfrm').click(function(){ 
	  $('#userpass').val($.MD5($('#userpass').val()));
	  $('#loginForm').submit();
      });
    });
  </script>

</body>
 
</html>