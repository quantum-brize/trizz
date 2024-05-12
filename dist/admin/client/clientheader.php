<?php if($_SESSION['clientname']=='' || $_SESSION['clientId']==''){
header('location: login.html');
}
if($_SESSION['chatuser']==''){
$_SESSION['chatuser']=rand(99999999,11111111);
}

updatelisting('userMaster','onlineSessionDate="'.date('Y-m-d H:i:s').'",onlineStatus=2','id="'.$_SESSION['clientId'].'"');  


updatelisting('sys_userMaster','onlineStatus=1','onlineSessionDate<"'.date('Y-m-d H:i:s',strtotime('-10 minutes')).'"'); 
updatelisting('sys_userMaster','onlineStatus=0','onlineSessionDate<"'.date('Y-m-d H:i:s',strtotime('-30 minutes')).'"');




 ?>
<header id="careerfy-header" class="careerfy-header-one">
<div class="container">
<div class="row">
<aside class="col-md-2"> <a href="index.html" class="careerfy-logo"><img src="../profilepic/<?php echo stripslashes($companydetails['invoiceLogo']); ?>" alt="" style="height:50px !important;"></a> </aside>
<aside class="col-md-6">
<nav class="careerfy-navigation">
<div class="navbar-header">
<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#careerfy-navbar-collapse-1" aria-expanded="false">
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
</div>
<div class="collapse navbar-collapse" id="careerfy-navbar-collapse-1">
<ul class="navbar-nav"> 
<li><a href="<?php echo $fullurl; ?>">My Trips</a></li>
<li><a href="payment.html">Payment History</a></li>
<li><a href="chathistory.html">Chat History</a></li>
<li><a href="profile.html">My Profile</a></li>
<li><a href="logout.html">Logout</a></li> 
</ul>
</div>
</nav>
</aside>
<aside class="col-md-4">
<div class="careerfy-right">
<ul class="careerfy-user-section">
 <li><strong>Call Us: </strong><a class="careerfy-color careerfy-open-signin-tab" href="tel:<?php echo $companydetails['invoicePhone']; ?>" style="color:#333333;"><?php echo $companydetails['invoicePhone']; ?></a></li>
</ul>
 <a href="#" class="careerfy-simple-btn careerfy-bgcolor" onClick="chatwindowopenclose(1);loadmessage();" style="margin-left:0px;" ><span> <i class="fa fa-commenting" aria-hidden="true" style="font-size: 19px; margin-right: 4px;"></i> Chat</span></a>
</div>
</aside>
</div>
</div>
</header>