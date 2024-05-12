<?php 
include "inc.php";

$a=GetPageRecord('*','websiteSetting','id=1');  
$websitesetting=mysqli_fetch_array($a); 
 

if($_POST['username']!='' && $_POST['password']!=''){  
ini_set('max_execution_time', '300');   

$cip=$_SERVER['REMOTE_ADDR'];   
$clogin=date('Y-m-d H:i:s');   
$result =mysqli_query (db(),"select * from sys_userMaster where email='".$_POST['username']."'   and id!=1 and  password='".md5($_POST['password'])."' and status=1 and (userType='agent') ")  or die(mysqli_error());  
$number =mysqli_num_rows($result);   
if($number>0)  
{   

$select='';  
$where='';  
$rs='';  
$select='*'; 

$where="email='".$_POST['username']."' and  password='".md5($_POST['password'])."'";  
$rs=GetPageRecord($select,'sys_userMaster',$where);  
$userinfo=mysqli_fetch_array($rs); 

deleteRecord('sys_userLogs','DATE(addLastDate)<"'.date('Y-m-d',strtotime('-2 days')).'"'); 

$_SESSION['agentUserid']=$userinfo['id'];   
$_SESSION['parentAgentId']=$userinfo['id'];  
$_SESSION['agentUsername']=$userinfo['email'];    
$_SESSION['parentid']=$userinfo['id'];  


 

//loginattampmail($userinfo['id'],$_POST['username']); 

$sql_insk="insert into sys_userLogs set  currentIp='".$cip."',logType='login',details='User Login',userId='".$userinfo['id']."',parentId='".$userinfo['id']."',addDate='".time()."'";  
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 
 
$sql_ins="update sys_userMaster set onlineStatus=1 where id=".$_SESSION['agentUserid']."";  
mysqli_query(db(),$sql_ins) or die(mysqli_error());  

header('Location: '.$fullurl.'agent-dashboard');

exit();

} else {

$notlogin=1;

}
 
} 


if($_REQUEST['i']!='' && base64_decode(base64_decode($_REQUEST['j']))==date('Ymd')){

$user=base64_decode(base64_decode($_REQUEST['i'])); 

$domainName=str_replace('www.','',$_SERVER['SERVER_NAME']); 
$rs=GetPageRecord('*','sys_userMaster','domainName="'.$domainName.'" ');  
$AgentWebsiteData=mysqli_fetch_array($rs);

$cip=$_SERVER['REMOTE_ADDR'];   
$clogin=date('Y-m-d H:i:s');   
$result =mysqli_query (db(),"select * from sys_userMaster where email='".$user."' and websiteUser=0 and id!=1   and status=1 and (userType='agent') ")  or die(mysqli_error());  
$number =mysqli_num_rows($result);   
if($number>0)  
{   

$select='';  
$where='';  
$rs='';  
$select='*'; 

$where="email='".$user."'";  
$rs=GetPageRecord($select,'sys_userMaster',$where);  
$userinfo=mysqli_fetch_array($rs); 

deleteRecord('sys_userLogs','DATE(addLastDate)<"'.date('Y-m-d',strtotime('-2 days')).'"'); 

$_SESSION['agentUserid']=$userinfo['id'];   
$_SESSION['parentAgentId']=$userinfo['parentAgentId'];  
$_SESSION['agentUsername']=$userinfo['email'];    
$_SESSION['parentid']=$userinfo['parentId'];  

loginattampmail($userinfo['id'],$_POST['username']); 

$sql_insk="insert into sys_userLogs set  currentIp='".$cip."',logType='login',details='User Login',userId='".$userinfo['id']."',parentId='".$userinfo['id']."',addDate='".time()."'";  
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 
 
$sql_ins="update sys_userMaster set onlineStatus=1 where id=".$_SESSION['agentUserid']."";  
mysqli_query(db(),$sql_ins) or die(mysqli_error());  

header('Location: '.$fullurl.'agent-dashboard');

exit();

} else {

$notlogin=1;

}


}



$rs=GetPageRecord('*','sys_userMaster','id="'.$staticparentId.'" ');  
$AgentWebsiteData=mysqli_fetch_array($rs);



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<title>Login - <?php echo $systemname; ?></title> 
<?php include "headerinc.php"; ?>

<style>
body{padding-top:60px !important; padding-bottom:70px !important;}
#loginouter{position:inherit;max-width: unset !important;}
#loginbg{background: transparent !important;}
.flightfooter{margin-top: 0px !important;}

@media (max-width: 576px){
  .mobilecolset .loginform{width: 103% !important;}
  .logintext h2{font-size: 20px !important;margin-bottom: 5px;}
  .logintext span{font-size: 18px;}
  .logintext p{font-size: 14px;}
  .waittext{width: 100% !important;}
  .newloginbg{margin-bottom: 30px !important;}
  .waittext{margin-bottom: 30px !important;font-size: 16px !important;}
  .accountbox span{width: 50px;height: 50px;}
  .gIbdUL{padding: 20px !important;}
  .savingtext{font-size: 14px !important;}
  .cntbuttons a { padding: 10px 10px !important; color: #fff; font-size: 16px !important; border-radius: 8px; font-weight: 600; display: inline-block; }
  .savingtext{margin-top: 0px;}
  .golMEs .cntbuttons{justify-content: start !important;}
  .frFVwJ{display: none;}
  .golMEs .row{padding-top: 0px !important;}
  .newloginbg .loginform{padding: 20px !important;}
}
</style>


</head>

<body id="loginbg" class="loginbody">
  <!-- header -->

  <?php  include "header.php"; ?>
   

<div class="newloginbg">
<div class="container">
<div id="loginouter">
<div id="loginouterin" class="formloginouter">

<div class="row d-flex align-items-center" style="margin-top:10px;">
  <div class="col-lg-8">
   <div class="logintext">
    <span>One-Stop Solution for Booking Your Trip</span>
    <h2>A Signature Of Excellence</h2>
    <p>With special corporate rates on flights & hotels, save your travel budget by paying less for more features</p>
   </div>
  </div>
  <div class="col-lg-4 mobilecolset" style="padding-right: 1.5rem !important;">
  <div class="loginform"> 
<form action=""  method="post">
            <div class="formlogo">
               
              <p>Login here to your account as</p>
			 <?php if($notlogin==1){?> <div style="margin:10px 0px; color:#CC0000; font-size:12px; font-weight:600;">Invalid Login!</div><?php } ?>
            </div>
            <div class="inputbox">
              <input name="username" type="email" id="username" placeholder="Email">
              <input name="password" type="password" id="password" placeholder="Password">
            </div>
            <div class="loginbutton">
             <a>
                  <button type="submit">Login</button>
			    </a>
               
            </div>
            <div class="reset">
              <p>Forgot your password ? <a style=" cursor:pointer; color:var(--blue);" onClick="loadpop('Reset Password',this,'500px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=resetpassword">Reset Here</a></p>
              <hr>
              <p class="dontheading">Don't have an account?
              </p>
            </div>
            <p></p>
            <div class="createbutton">
              <a href="sign-up">
                <button type="button">Create Account</button>
              </a>
            </div>
             
        </form>


</div>
  </div>
</div>
    
    
 
</div>
</div>
</div>
</div>
<section class="waiting">
  <div class="container">
    <div class="row">


    <div class="col-lg-12 text-center">
      <h2 class="waittext">No Waiting, No Subscription Charges,
Get Started Instantly!</h2>
    </div>
    <div class="col-lg-4 text-center">
      <div class="accountbox">
        <span>1</span>
        <h4>Create Your Account Now</h4>
        <p>Get started by providing minimal details like employee size, organisation name, etc.</p>
      </div>
    </div>
    <div class="col-lg-4 text-center">
      <div class="accountbox">
        <span>2</span>
        <h4>Set Up Employee-friendly Policy Guidelines</h4>
        <p>Gain most of the benefits by setting up employee-friendly policies (only Admin users)</p>
      </div>
    </div>
    <div class="col-lg-4 text-center">
      <div class="accountbox">
        <span>3</span>
        <h4>Invite Your Employees & Start Booking</h4>
        <p>Invite your employees to myBiz so that they could enjoy all the corporate benefits.</p>
      </div>
    </div>
    </div>
  </div>
</section>
<section overflow="hidden" class="sc-1nwjbkl-3 golMEs">
  <div class="sc-1ce7538-3 frFVwJ"></div>
  <div class="sc-1ce7538-0 gIbdUL">
   <div class="container">
    <div class="row">
      <div class="col-lg-6">
   <h2 class="savingtext">Contact Us Any Time 24 x 7</h2>
      </div>
      <div class="col-lg-6">
        <div class="cntbuttons">
        <a style="background: linear-gradient(135deg, #d72e36, #f95535);width: 40%; text-align: center;" href="<?php echo $fullurl ?>contactpage.php">Enquiry Now</a>
        <a style="background: #fff;color:var(--blue)" href="<?php echo $fullurl ?>contactpage.php">Contact Us</a>
        </div>
      </div>
    </div>
   </div>
  </div>

</section>

</div>

<?php include "footerinc.php"; ?>

<?php include "footer.php"; ?>
</body>
</html>
