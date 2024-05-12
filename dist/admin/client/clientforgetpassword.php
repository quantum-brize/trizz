<?php include "clientinc.php";  
$msg='';
$st=0;
if(isset($_POST['submit']) && trim($_POST['email'])!=''){

$email = trim($_POST['email']); 


$result =mysqli_query (db(),"select * from userMaster where email='".$email."' and status=1 and userType=4 ")  or die(mysqli_error());  
if(mysqli_num_rows($result)>0) 
{  
$userinfo=mysqli_fetch_array($result); 

require_once('PHPMailer/class.phpmailer.php'); 
include("PHPMailer/class.smtp.php"); 

function send_attachment_mail($fromemail,$to,$subject,$description,$ccmail,$attfilename) 
{ 
 
$select='*'; 
$where='id=1'; 
$rs=GetPageRecord($select,'sys_userMaster',$where); 
$LoginUserDetails=mysqli_fetch_array($rs);  

	$mail = new PHPMailer(); 
	$mail->IsMail(); 
	$mail->SMTPAuth = $LoginUserDetails['securityType']; 
	$mail->SMTPSecure = $LoginUserDetails['smtpServer']; 
	$mail->Host = $LoginUserDetails['smtpServer']; 
	$mail->Port = $LoginUserDetails['emailPort'];   
	$mail->Username = $LoginUserDetails['emailAccount']; 
	$mail->Password = $LoginUserDetails['emailPassword'];  
	$mail->From = $LoginUserDetails['emailAccount']; 
	$mail->FromName = $LoginUserDetails['fromName']; 
	$mail->Subject = $subject; 
	$mail->AltBody = ""; 
	$mail->CharSet = 'UTF-8'; 
    $mail->ContentType = 'text/html'; 
	$mail->MsgHTML('<body>'.$description.'</body>');  
	$mail->AddAddress(trim($to), "");  
	$mail->AddAttachment('voucherAttachments/'.$attfilename);  
	$ccmail = explode(',', $ccmail);
	foreach ($ccmail as $ccaddress) {
	$mail->AddCC(trim($ccaddress));
	}  
	$mail->IsHTML(true); 
	$mail->SMTPOptions = array(
	'ssl' => array(
	'verify_peer' => false,
	'verify_peer_name' => false,
	'allow_self_signed' => true
	)
	);
	$mail->Send(); 
}
$newpassword=rand(00000000,99999999);
//$ccmail='ops@goinmyway.co.in,accounts@goinmyway.co.in';
$file_name='';



$select='*'; 
$where='id=1'; 
$rs=GetPageRecord($select,'sys_userMaster',$where); 
$LoginUserDetails=mysqli_fetch_array($rs);

$mailbody='Dear '.$userinfo['firstName'].',
<div><br>
</div>
<div>Please find below the login details</div>
<div><br>
</div>
<div><strong>Login URL:</strong>&nbsp;<a href="'.$fullurl.'" target="_blank">'.$fullurl.'</a><br>
    <strong>Username:</strong>&nbsp;<a href="mailto:'.$userinfo['email'].'" target="_blank">'.$userinfo['email'].'</a><br>
  <strong>Password:&nbsp;</strong>'.$newpassword.'</div>
<div><br>
</div>
<div>Note: Please update your password after login in your profile section.</div>
<div><br>
</div>
<div>Thanks<br>
  Team '.$LoginUserDetails['fromName'].'</div>
 ';
send_attachment_mail($fromemail,$userinfo['email'],'Recovery Password Request',$mailbody,$ccmail,$file_name);


$namevalue ='password="'.md5($newpassword).'"';  
$where="email='".$email."'";  
updatelisting('userMaster',$namevalue,$where);

 $msg='Your temporary password has been sent on your email Id.!';
$st=1;
}else{ 
$st=0;
$msg='Email does not exist..!';
}

}
 ?>

<!DOCTYPE html>
<html lang="en">
 
 



<head>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        '../../../www.googletagmanager.com/gtm5445.html?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-W24T6W7');</script>
    <!-- End Google Tag Manager -->
    <title>Login - <?php echo $clientnameglobal; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <!-- External CSS libraries -->
    <link type="text/css" rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="assets/fonts/font-awesome/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="assets/fonts/flaticon/font/flaticon.css">

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon" >

    <!-- Google fonts -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800%7CPoppins:400,500,700,800,900%7CRoboto:100,300,400,400i,500,700">

    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" id="style_sheet" href="assets/css/skins/default.css">

</head>

<body id="top">
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W24T6W7"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<div class="page_loader"></div>

<!-- Login 17 start -->
<div class="login-17">
    <div class="container">
        <div class="col-md-12 pad-0">
            <div class="row login-box-6">
                <div class="col-lg-5 col-md-12 col-sm-12 col-pad-0 bg-img align-self-center none-992">
                    <a href="#">
                        <img src="images/whitelogo.png" class="logo" alt="logo" style="height: 40px;">
                    </a>
                    <p>Manage Query, Package, Payment and much more</p> 
                </div>
                <div class="col-lg-7 col-md-12 col-sm-12 col-pad-0 align-self-center">
                    <div class="login-inner-form"> 
                        <div class="details">
                            <h5 style=" <?php if($st==0){ ?> color:#FF0000; <?php } if($st==1){ ?> color:#33CC99; <?php  } ?> "><?php echo $msg; ?></h5>
                            <h3>Forget Password</h3>
                            <form action="forgetpassword.html" method="post">
                                <div class="form-group">
                                    <input name="email" type="email" class="input-text" id="email" placeholder="Email Address">
                                </div>  
                                <div class="form-group">
                                    <button type="submit" name="submit" class="btn-md btn-theme btn-block">Recover Password</button>
                                </div>
								<div class="form-group">
                                    <a href="login.html" class="btn-md btn-theme btn-block">Back to login</a>
                                </div>
						
                            </form>
                 <!--           <p>Don't have an account?<a href="register-17.html"> Register here</a></p>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Login 17 end -->

<!-- External JS libraries -->
<script src="assets/js/jquery-2.2.0.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<!-- Custom JS Script -->

</body>
 
</html>
