<?php  
include "../config/database.php"; 
include "../config/function.php";  
include "../config/setting.php";  
$fullurl=$fullurl.'app/';
$loginpage=1;

if($_POST['username']!='' && $_POST['userpass']!=''){   
$username = clean($_POST['username']); 
$password = clean($_POST['userpass']); 


$ftoken = '';   
$loginreturn = login($username,$password,$ftoken);

 

if($loginreturn=='yes'){ 
 
 
$rs=GetPageRecord('*','sys_userMaster','id="'.$_SESSION['userid'].'" and email="'.$_SESSION['username'].'"'); 
$LoginUserDetails=mysqli_fetch_array($rs);

if($LoginUserDetails['stepVerification']==0){

$rendnumber=mt_rand(100000, 999999);

$namevalue ='qrCode="'.$rendnumber.'",verifyQrCode="'.$rendnumber.'"';  
$where='id="'.$_SESSION['userid'].'"';    
updatelisting('sys_userMaster',$namevalue,$where);  

$_SESSION['sesQRCode']=$namevalue;


header("Location: ".$fullurl."mobile_dashboard.php"); 
exit(); 

}



if($LoginUserDetails['stepVerification']==1){
$rendnumber=mt_rand(100000, 999999);
 $namevalue ='qrCode="'.$rendnumber.'",verifyQrCode=0';  
$where='id="'.$_SESSION['userid'].'"';    
updatelisting('sys_userMaster',$namevalue,$where);  

}
 


} else {  
$errormsg='Invalid username or password';

}
}
 
 
$rsa=GetPageRecord('*','sys_userMaster','id=1'); 
$logincolor=mysqli_fetch_array($rsa);
?>


<?php // include "mobile_inc.php"; ?>

<html lang="en" class="isPWA"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover">
<title>Login</title>
<?php include "mobile_headerinc.php"; ?>
</head>


<body class="theme-light" data-highlight="red" data-gradient="body-default">




<div id="preloader" class="preloader-hide"><div class="spinner-border color-highlight" role="status"></div></div>
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<div id="page" data-swup="0" class="device-is-ios">
<div class="page-content pb-0">
<div data-card-height="cover" class="card" style="height: 667px;">
<div class="card-top notch-clear">
<div class="d-flex"> 
<a href="#" data-toggle-theme="" class="show-on-theme-light ms-auto icon icon-m"><i class="font-12 fa fa-moon color-theme"></i></a>
<a href="#" data-toggle-theme="" class="show-on-theme-dark ms-auto icon icon-m"><i class="font-12 fa fa-lightbulb color-yellow-dark"></i></a>
</div>
</div>      <form id="loginForm" method="post">
<div class="card-center">
<div class="ps-5 pe-5">
<h1 class="text-center font-800 font-40 mb-1">Sign In</h1>
<p class="text-center font-12">Let's get you logged in</p>
<div class="input-style no-borders has-icon validate-field">
<i class="fa fa-user"></i>
<input name="username" type="text" class="form-control validate-name" id="form1a" placeholder="Email">
<label for="form1a" class="color-blue-dark font-10 mt-1">Name</label>
<i class="fa fa-times disabled invalid color-red-dark"></i>
<i class="fa fa-check disabled valid color-green-dark"></i>
<em>(required)</em>
</div>
<div class="input-style no-borders has-icon validate-field mt-4">
<i class="fa fa-lock"></i>
<input name="userpass" type="password" class="form-control validate-password" id="form3a" placeholder="Password">
<label for="form3a" class="color-blue-dark font-10 mt-1">Password</label>
<i class="fa fa-times disabled invalid color-red-dark"></i>
<i class="fa fa-check disabled valid color-green-dark"></i>
<em>(required)</em>
</div> 
<a href="#" class="back-button btn btn-full btn-m shadow-large rounded-sm text-uppercase font-700 bg-highlight" onClick="$('#loginForm').submit();" style=" background-color:<?php echo $logincolor['themeColor']; ?> !important;">LOGIN</a>
  
</div>
</div>

</form>
</div>
</div>
 
 
</div>

<?php include "mobile_footer.php"; ?>


</body>
</html>