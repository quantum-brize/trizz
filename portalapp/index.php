<?php
include "inc.php";

/* if (isset($_COOKIE['user'])) {
    unset($_COOKIE['user']); 
    setcookie('user', '', -1, '/'); 
 
} else {
     
} */

$cookie_name = "user";



if(!isset($_COOKIE[$cookie_name])) {
     
} else {
    $cookieuserid=$_COOKIE[$cookie_name];
}
 
if($_POST['username']==''){

$url = $basesiteurl."authpage_mobile.php";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);

$data = array(
    'ClientId' => '1',
        'UserName' => 'faujiyatra',
        'Password' => 'admin@3214',
        'EndUserIp' => $_SERVER['REMOTE_HOST'],
        'ApiKey' => '61014823250e8cdb-193d-475e-961d-0303c85ef4d1'
); 

curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
$contents = curl_exec($ch);
$contents=json_decode($contents,true); 
curl_close($ch);

 

$_SESSION['appLogo']=$contents['Member']['Logo'];
$_SESSION['appTokenId']=$contents['TokenId'];
 

if(trim($contents['Member']['Email'])==''){

echo 'Please contact your service provider!';
exit();

}

}


if($_POST['username']!='' && $_POST['password']!='' && $cookieuserid==''){

$url = $basesiteurl."agentloginpage_mobile.php";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);

		$data = array(
		'TokenId' => $_SESSION['appTokenId'],
		'UserName' => $_POST['username'],
		'Password' => $_POST['password'],
		'EndUserIp' => $_SERVER['REMOTE_HOST']
); 

curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
$contents = curl_exec($ch);
$contentslogin=json_decode($contents,true); 
curl_close($ch);
 

if($contentslogin['Member']['MemberId']!='' && $contentslogin['Member']['MemberId']!=0){
$_SESSION['userId']=$contentslogin['Member']['MemberId'];
$_SESSION['UserName']=$contentslogin['Member']['UserName'];
$logindone=1;


$cookie_value = $contentslogin['Member']['MemberId'];
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

}

}


if($cookieuserid>0){
$_SESSION['userId']=$cookieuserid; 
}
 
  

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
<title>Login</title>
<?php
include "headerinc.php";
?>

<script>
function opendashboard(){
$('body').removeClass('loginbg');
$('body').load('dashboard.php');
}
</script>
</head>

<body class="loginbg"> 
 
 
 <?php if($cookieuserid>0 || $logindone==1){ ?>
 <script>
 opendashboard();
 </script>
 <?php } else { ?>
<div class="loginbox">
<div class="logo"><img src="<?php echo $_SESSION['appLogo']; ?>" /></div>
<div class="loginsubline">Login here to your account as</div>
<div class="inputbox">
<form action=""  method="post">
              <input name="username" type="email" id="username" placeholder="Email" class="loginfield">
              <input name="password" type="password" id="password" placeholder="Password" class="loginfield">
			  <button type="submit" class="redbtnbig" onclick="$('#loadingblk').show();" >Login</button>
			  </form>
			  <div class="forgetpassword">
			   Forgot your password? <a style=" cursor:pointer; color:var(--blue);" onclick="loadpop('Reset Password',this,'500px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=resetpassword"><strong>Reset Here</strong></a>			  </div>
			   
			   <a href="#"><button type="button" class="redbtnbigborder">Create Account</button> </a>  </div>
</div> 

<script>
 

<?php
if($contentslogin['Member']['MemberId']!='' && $contentslogin['Member']['MemberId']!=0){
?> 
showToast('Successfully Login!');
<?php } ?>

<?php
if($contentslogin['Member']['MemberId']<1){
?>
showToast('Login Faild!');
<?php } ?>

</script>

<?php } ?>

<?php
include "footerinc.php";
?>


</body>
</html>
