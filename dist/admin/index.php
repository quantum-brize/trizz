<?php 
include "inc.php"; 
include "config/logincheck.php"; 
if($_SESSION['userid']=='' || $_SESSION['username']==''){ 
header("Location: login.html");
exit();
}  

if($LoginUserDetails['qrCode']!=$LoginUserDetails['verifyQrCode']){
header("Location: login.html");
exit();
}

$namevalue ='onlineStatus=2,onlineSessionDate="'.date('Y-m-d H:i:s').'"';  
$where='id="'.$_SESSION['userid'].'"';   
updatelisting('sys_userMaster',$namevalue,$where);   



$naviactive='da';
$pageselect='';


if($pageselect==''){
$pageselect=00;
}


if($_REQUEST['ga']=='itineraries'){
$selectedmenu=2;
}

if($_REQUEST['ga']=='clients'){
$selectedmenu=3;
}

if($_REQUEST['ga']=='query'){
$selectedmenu=4;
}

if($_REQUEST['ga']=='suppliers'){
$selectedmenu=5;
}

if($_REQUEST['ga']=='CollectionReport'){
$selectedmenu=6;
}

if($_REQUEST['ga']=='inbox'){
$selectedmenu=7;
}

if($_REQUEST['ga']=='flightbooking'){
$selectedmenu=41;
}

if($_REQUEST['ga']=='hotelBookings'){
$selectedmenu=41;
}

$pageurl='dashboard.php';

 
 

if($_REQUEST['ga']!=''){

$topPageName=$moduledetails['name'];

$addpage='';
if($_REQUEST['add']==1){
$addpage='add_';
}
 
if($_REQUEST['view']==1){
$addpage='view_';
}


 
$pageurl=$addpage.$_REQUEST['ga'].'.php';



}


if($_REQUEST['ga']=='setting'){ 
$pageurl='companysetting.php';
}

if($_REQUEST['ga']=='myprofile'){ 
$pageurl='my_profile.php';
}


?>
<!DOCTYPE html>
<html lang="en">
   
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
      <title><?php echo $clientnameglobal; ?></title> 
	  <?php include "headerinc.php"; ?>  
	  
   </head>
   <body> 
   <?php include "header.php"; ?>   
     
	 <?php if($pageurl!='dashboard.php'){ include $pageurl; } else { ?>
	 <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>


	 <div style="width:100%;" id="loaddashboard"><div style="text-align:center; padding-top:200px;">Loading Dashboard...</div></div>
	 
	 <script>
	  function loaddasboard(filename,dashtype)
	  {
	   
	 $('#loaddashboard').load(''+filename+'?type='+dashtype);
	 
	 }
	 
	 
	 loaddasboard('dashboard.php',1);
	 </script>
	 
	 <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
	 <?php } ?>
	 
	 
       <?php include "footer.php"; ?>  
	 
   </body>
   
</html>