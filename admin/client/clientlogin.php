<?php include "clientinc.php";  
$_SESSION['chatuser']='';
$msg='';
if(isset($_POST['submit']) && trim($_POST['username'])!='' && trim($_POST['password'])!=''){

$username = trim($_POST['username']);
$password = trim($_POST['password']);

echo "select * from userMaster where email='".$username."' and  password='".md5($password)."' and status=1 and userType=4 ";
$result =mysqli_query (db(),"select * from userMaster where email='".$username."' and  password='".md5($password)."' and status=1 and userType=4 ")  or die(mysqli_error());  
if(mysqli_num_rows($result)>0) 
{  
$userinfo=mysqli_fetch_array($result);

$_SESSION['clientname']=$userinfo['firstName'].' '.$userinfo['lastName'];
 $_SESSION['clientId']=$userinfo['id'];
  
 
header('location:index.html');

}else{ 
$msg='Username or password incorrect!';
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
            <div class="row" style="margin: auto; max-width: 330px;">
                 
            <div class="card">
                <div class="col-lg-12 align-self-center">
                    <div class="login-inner-form">
					<div style="text-align:center; padding-top:30px;"><img src="../profilepic/<?php echo stripslashes($companydetails['invoiceLogo']); ?>" class="logo" alt="logo" style="height: 40px;"></div>
                        <div class="details" style="padding:30px;">
                            <h3>Sign into your account</h3>
                            <form action="login.html" method="post">
                                <div class="form-group">
                                    <input name="username" type="email" class="input-text" id="username" placeholder="Email Address">
                                </div>
                                <div class="form-group">
                                    <input name="password" type="password" class="input-text" id="password" placeholder="Password">
                                </div>
                                <div class="checkbox clearfix">
                                    <div class="form-check checkbox-theme">
                                        <input class="form-check-input" type="checkbox" value="" id="rememberMe">
                                        <label class="form-check-label" for="rememberMe">
                                            Remember me
                                        </label>
                                    </div>
                                    <a href="clientforgetpassword.php">Forgot Password</a>
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="submit" class="btn-md btn-theme btn-block">Login</button>
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
</div>
<!-- Login 17 end -->

<!-- External JS libraries -->
<script src="assets/js/jquery-2.2.0.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<!-- Custom JS Script -->

</body>
 
</html>
