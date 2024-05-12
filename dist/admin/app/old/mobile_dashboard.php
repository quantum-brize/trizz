<?php  
include "mobile_inc.php";



$mainwhere=''; 
if($LoginUserDetails['userType']!=0){ 
   
$mainwherecnfq='';
if($LoginUserDetails['showQueryStatus']==1){
$mainwherecnfq=' and (statusId=5) '; 
}else{  
$mainwherecnfq=' and (addedBy="'.$_SESSION['userid'].'" or  assignTo="'.$_SESSION['userid'].'")  '; 
}

$mainwhere=' and (addedBy="'.$_SESSION['userid'].'" or  assignTo="'.$_SESSION['userid'].'")  '; 

} else {

$startDate=date('d-m-Y',strtotime('-30 Days'));
$endDate=date('d-m-Y');

 
$mainwhere='  and date(dateAdded)<="'.date('Y-m-d',strtotime($endDate)).'" and  date(dateAdded)>="'.date('Y-m-d',strtotime($startDate)).'"  ';
 
}
?>


<?php // include "mobile_inc.php"; ?>

<html lang="en" class="isPWA"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover">
<title>Dashboard</title>
<?php include "mobile_headerinc.php"; ?>
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
<style>
.querystaus h2{font-size:32px; color:#fff;}
.querystaus p{color:#fff;margin-bottom: 10px;}
</style>
</head>
 

</body>

<div id="preloader"><div class="spinner-border color-highlight" role="status"></div></div>
<div id="page">
 
<div class="page-content header-clear-small">
 
 <div class="row me-2 ms-2 mb-0">
 <div class="col-6 text-center">
 <div class="card querystaus" style="background-color:#655be6;"><div class="col-12 text-center">
 
<h2 class="mt-3 mb-1"><?php echo countlisting('id','queryMaster',' where   DATE(dateAdded)="'.date('Y-m-d').'" '.$mainwhere.' and fromCity!="" and clientId in (select id from userMaster where userType=4 and firstName!="") ');   ?></h2>
<p>Today's Queries</p>
</div></div>
</div>
 <div class="col-6 text-center">
<div class="card querystaus"  style="background-color:#0f1f3e;"><div class="col-12 text-center">
 
<h2 class="mt-3 mb-1"><?php echo countlisting('id','queryMaster',' where  1 '.$mainwhere.' and fromCity!="" and clientId in (select id from userMaster where userType=4 and firstName!="")  ');   ?></h2>
<p>Total Queries</p>
</div></div>

</div>

 <div class="col-6 text-center"><div class="card querystaus"   style="background-color:#cc00a9;">

<div class="col-12 text-center">
 
<h2 class="mt-3 mb-1"><?php echo countlisting('id','queryMaster',' where   statusId=8 and fromCity!="" and clientId in (select id from userMaster where userType=4 and firstName!="") '.$mainwherecnfq.' ');   ?></h2>
<p>Proposal Sent </p>
</div></div></div>


<div class="col-6 text-center"><div class="card querystaus"  style="background-color:#FF6600;"><div class="col-12 text-center">
 
<h2 class="mt-3 mb-1"><?php echo countlisting('id','queryMaster',' where   statusId=9 and fromCity!="" and clientId in (select id from userMaster where userType=4 and firstName!="") '.$mainwherecnfq.' ');   ?></h2>
<p>Total Pro. Conf</p>
</div></div></div>

<div class="col-6 text-center"><div class="card querystaus" style="background-color:#46cd93;"><div class="col-12 text-center">
 
<h2 class="mt-3 mb-1"><?php echo countlisting('id','queryMaster',' where   statusId=5 and fromCity!="" and clientId in (select id from userMaster where userType=4 and firstName!="") '.$mainwherecnfq.' ');   ?></h2>
<p>Total Confirmed</p>
</div></div></div>

<div class="col-6 text-center"><div class="card querystaus"  style="background-color:#f9392f;"><div class="col-12 text-center">
 
<h2 class="mt-3 mb-1"><?php echo countlisting('id','queryMaster',' where   statusId=7  '.$mainwhere.' and fromCity!="" and clientId in (select id from userMaster where userType=4 and firstName!="")  ');   ?></h2>
<p>Total Lost</p>
</div></div></div>

</div>
 
<div class="card card-style">
<div class="content mb-0">
<h1 class="text-center mb-0">Task / Followup's</h1> 
  <div class="content mt-0 mb-0">
<div class="list-group list-custom-large short-border check-visited">
<?php
 $totalno=1;

$a=GetPageRecord('*','queryTask',' 1 '.$mainwhere.' and (makeDone!=1 ) order by id desc');
while($rest=mysqli_fetch_array($a)){


$b=GetPageRecord('*','queryMaster','id="'.$rest['queryId'].'"'); 
$queryData=mysqli_fetch_array($b);

$bc=GetPageRecord('*','userMaster','id="'.$queryData['clientId'].'"'); 
$clientData=mysqli_fetch_array($bc);

?>

<a href="display.html?ga=query&view=1&id=<?php echo encode($rest['queryId']); ?>&c=3" class=" visited-link">
<?php if($rest['taskType']=='Task'){ ?>
	<i class="fa fa-calendar-check-o" aria-hidden="true" style="font-size: 25px; color:#adb5bd"></i>
	<?php } ?>
	<?php if($rest['taskType']=='Call'){ ?>

	<i class="fa fa-phone-square" aria-hidden="true" style="font-size: 25px; color:#adb5bd"></i>
	<?php } ?>
	<?php if($rest['taskType']=='Meeting'){ ?>
	<i class="fa fa-handshake-o" aria-hidden="true" style="font-size: 25px; color:#adb5bd"></i>
	<?php } ?>
<span><?php echo (stripslashes($rest['details'])); ?></span>
<strong><?php echo date('d/m/Y-h:i A',strtotime($rest['reminderDate'])); ?> </strong> &nbsp;

</a> 
<?php  $totalno++; } ?>

</div>
</div>
</div>

</div>



<div class="card card-style">
<div class="content mb-0">
<h1 class="text-center mb-0">Payment Collection</h1> 
  <div class="content mt-0 mb-0">
<div class="list-group list-custom-large check-visited">
<?php
$pendingpay=0;
$totalno=1;
 
if($LoginUserDetails['showQueryStatus']==1){

$a=GetPageRecord('*','sys_PackagePayment',' 1 and DATE(paymentDate)<="'.date('Y-m-d').'" and paymentStatus!=1   order by paymentDate asc');
} else {
$a=GetPageRecord('*','sys_PackagePayment',' 1 and DATE(paymentDate)<="'.date('Y-m-d').'" and paymentStatus!=1 and queryId in(select id from queryMaster where 1 '.$mainwhere.')  order by paymentDate asc');

} 
while($paymentlist=mysqli_fetch_array($a)){ 


$b3d=GetPageRecord('*','userMaster','id in (select clientId from queryMaster where id="'.$paymentlist['queryId'].'" )'); 
$clientData=mysqli_fetch_array($b3d);
?>

<a href="display.html?ga=query&view=1&id=<?php echo encode($paymentlist['queryId']); ?>" class=" visited-link">
 
<span><?php echo encode($paymentlist['queryId']); ?> - &#8377;<?php echo ($paymentlist['amount']); ?></span>
<strong><?php echo stripslashes($clientData['firstName']); ?> <?php echo stripslashes($clientData['lastName']); ?> - <?php echo date('d/m/Y - h:i A',strtotime($paymentlist['paymentDate'])); ?></strong> &nbsp;

</a> 

<?php  $totalno++; } ?>

</div>
</div>
</div>

</div>



<div class="card card-style">
<div class="content mb-0">
<h1 class="text-center mb-0">Query By Status</h1> 
  <div class="content mt-0 mb-0">
<div id="chartdiv2" style="height:320px;"></div>
						 
									<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

var chart = am4core.create("chartdiv2", am4charts.SlicedChart);
chart.hiddenState.properties.opacity = 0; // this makes initial fade in effect

chart.data = [

<?php  
$a=GetPageRecord('*','queryStatusMaster',' 1 order by id asc');
while($stageres=mysqli_fetch_array($a)){ 


$abcd=GetPageRecord('count(id) as totalsages','queryMaster','statusId="'.$stageres['id'].'" '.$mainwhere.''); 
$leadstagecount=mysqli_fetch_array($abcd);
?>
{
    "name": "<?php echo strip($stageres['name']); ?>",
    "value": <?php echo $leadstagecount['totalsages']; ?>
},<?php } ?>

];

var series = chart.series.push(new am4charts.FunnelSeries());
series.colors.step = 2;
series.dataFields.value = "value";
series.dataFields.category = "name";
series.alignLabels = false;

series.labelsContainer.paddingLeft = 15;
series.labelsContainer.width = 200;

//series.orientation = "horizontal";
//series.bottomRatio = 1;

 

}); // end am4core.ready()
 
									</script>
</div>
</div>

</div>

<?php if($LoginUserDetails['userType']==0){  ?>

<div class="card card-style">
<div class="content mb-0">
<h1 class="text-center mb-0">Sales Rep.</h1> 
  <div class="content mt-0 mb-0">
<div class="list-group list-custom-large check-visited">
<?php
$rr=1;
$rs=GetPageRecord('count(id) as astotalcountquery,id,assignTo','queryMaster','  1 and assignTo!=0  group by assignTo order by astotalcountquery desc limit 0, 15 ');
while($rest=mysqli_fetch_array($rs)){ 

$abcd=GetPageRecord('*','sys_userMaster','id="'.$rest['assignTo'].'"'); 
$userdata=mysqli_fetch_array($abcd);
?>

<a class=" visited-link">
 
<span><?php echo $rr; ?>. <?php echo strip($userdata['firstName']); ?> <?php echo strip($userdata['lastName']); ?></span>
<strong>Assigned: <?php echo countlisting('id','queryMaster',' where  1 '.$mainwhere.' and fromCity!="" and clientId in (select id from userMaster where userType=4 and firstName!="") and assignTo="'.$userdata['id'].'"  ');   ?> &nbsp;|&nbsp; Confirmed: <?php echo countlisting('id','queryMaster',' where statusId=5   '.$mainwhere.' and fromCity!="" and clientId in (select id from userMaster where userType=4 and firstName!="") and assignTo="'.$userdata['id'].'"  ');   ?></strong> &nbsp;

</a> 

 <?php $rr++; } ?>

</div>
</div>
</div>

</div>


<?php } ?>




<div class="card card-style">
<div class="content mb-0">
<h1 class="text-center mb-0">Top Lead Source</h1> 
  <div class="content mt-0 mb-0">
<div class="list-group list-custom-large check-visited">
<table border="0" cellpadding="0" cellspacing="0" style=" font-size:12px; margin:10px 0px;">
						  <tr>
    <td align="left" style="padding:5px; border-bottom:1px solid #ddd;"><strong>Name</strong></td>
    <td align="center" bgcolor="#F3F3F3" style="padding:5px;  border-bottom:1px solid #ddd;"><strong>Total Queries </strong></td>
    <td align="center" bgcolor="#E8FFF1" style="padding:5px;  border-bottom:1px solid #ddd;"><strong>Confirmed </strong></td>
  </tr>
<?php
$rr=1;
$rs=GetPageRecord('count(id) as sourcetotal,id,leadSource','queryMaster','  1 and leadSource!=0  group by leadSource order by sourcetotal desc limit 0, 15 ');
while($rest=mysqli_fetch_array($rs)){ 

$abcd=GetPageRecord('*','querySourceMaster','id="'.$rest['leadSource'].'"'); 
$userdata=mysqli_fetch_array($abcd);
?>
 
  <tr>
    <td align="left" style="padding:5px; border-bottom:1px solid #ddd;"><?php echo $rr; ?>. <?php echo strip($userdata['name']); ?></td>
    <td align="center" bgcolor="#F3F3F3" style="padding:5px;  border-bottom:1px solid #ddd;"><?php echo countlisting('id','queryMaster',' where  1 '.$mainwhere.' and fromCity!="" and   leadSource="'.$userdata['id'].'"  and clientId in (select id from userMaster where userType=4 and firstName!="")  ');   ?></td>
    <td align="center" bgcolor="#E8FFF1" style="padding:5px;  border-bottom:1px solid #ddd;"><?php echo countlisting('id','queryMaster',' where  statusId=5 and 1 '.$mainwhere.' and fromCity!="" and   leadSource="'.$userdata['id'].'"  and clientId in (select id from userMaster where userType=4 and firstName!="")  ');   ?></td>
  </tr>
  <?php $rr++; } ?>
</table>

</div>
</div>
</div>

</div>
 
 
 
</div>

 
 

 
</div>
<?php include "mobile_footer.php"; ?>

</body>
</html>