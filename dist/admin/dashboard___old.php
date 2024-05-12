<?php
$mainwhere=''; 



if($LoginUserDetails['userType']!=0){ 
   
$mainwherecnfq='';
if($LoginUserDetails['showQueryStatus']==1){
$mainwherecnfq=' and (statusId=5) '; 
}else{  
$mainwherecnfq=' and (addedBy="'.$_SESSION['userid'].'" or  assignTo="'.$_SESSION['userid'].'")  '; 
}

 $mainwhere.='and assignTo in (select id from sys_userMaster where branchId in (select id from roleMaster where parentId="'.$LoginUserDetails['branchId'].'")  or (   assignTo in (select id from sys_userMaster where branchId in (select id from roleMaster where parentId in ( select id from roleMaster where parentId="'.$LoginUserDetails['branchId'].'" ) ) ) or   assignTo in (select id from sys_userMaster where branchId in (select id from roleMaster where parentId in ( select id from roleMaster where parentId in ( select id from roleMaster where parentId="'.$LoginUserDetails['branchId'].'" ) ) ) ) or   assignTo in (select id from sys_userMaster where branchId in (select id from roleMaster where parentId in ( select id from roleMaster where parentId in ( select id from roleMaster where parentId in (select id from roleMaster where parentId="'.$LoginUserDetails['branchId'].'")  ) ) ) ) or   assignTo in (select id from sys_userMaster where branchId in (select id from roleMaster where parentId in ( select id from roleMaster where parentId in ( select id from roleMaster where parentId in (select id from roleMaster where parentId in (select id from roleMaster where parentId="'.$LoginUserDetails['branchId'].'") )  ) ) ) ) or addedBy="'.$_SESSION['userid'].'" or  assignTo="'.$_SESSION['userid'].'") )  ';

} else {

$startDate=date('d-m-Y',strtotime('-30 Days'));
$endDate=date('d-m-Y');

 
$mainwhere='    ';
//$mainwhere='  and date(dateAdded)<="'.date('Y-m-d',strtotime($endDate)).'" and  date(dateAdded)>="'.date('Y-m-d',strtotime($startDate)).'"  ';
 
}


if($LoginUserDetails['showQueryStatus']==2){
$mainwhere='    ';
}



$rswe=GetPageRecord('*','weatherAPI',' 1 and udpateDate<"'.date('Y-m-d').'" order by id asc'); 
while($restWeather=mysqli_fetch_array($rswe)){ 
  

$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://weather-by-api-ninjas.p.rapidapi.com/v1/weather?city=".$restWeather['cityName']."",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"X-RapidAPI-Host: weather-by-api-ninjas.p.rapidapi.com",
		"X-RapidAPI-Key: 4qHxfnYRW8mshIpW9aY4RfeEmocZp1ZXAWDjsnQk9pQYTjDPCQ"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	
	$data = json_decode($response);	
	
 
	
$namevalue ='cloud_pct="'.$data->cloud_pct.'",tempWether="'.$data->temp.'",feels_like="'.$data->feels_like.'",humidity="'.$data->humidity.'",min_temp="'.$data->min_temp.'",max_temp="'.$data->max_temp.'",wind_speed="'.$data->wind_speed.'",wind_degrees	="'.$data->wind_degrees	.'",sunrise="'.$data->sunrise.'",sunset="'.$data->sunset.'",udpateDate="'.date('Y-m-d').'"';   
$where='id="'.$restWeather['id'].'"';    
updatelisting('weatherAPI',$namevalue,$where); 

}


}
?>


<style>
#chartdiv {
  width: 100%;
  height:290px;
}
#chartdivdestination {
  width: 100%;
  height:240px;
}

.text-muted {
    color: #000000!important;
    font-weight: 700;
    font-size: 14px;
    text-transform: uppercase;
}

.container-fluid {
    max-width: 100%;
    padding-left: 80px;
    padding-right: 22px;
    padding-top: 8px;
}

.wrapper {
    margin-top: 56px;
    padding-left: 20px;
}

html{background-color:#eaeef2!important;}
body{background-color:#eaeef2!important;}
.card-body { padding: 10px 15px; }
.watherbox{background: rgb(140,190,244); background: linear-gradient(180deg, rgba(140,190,244,1) 0%, rgba(51,140,236,1) 48%); color:#FFFFFF; padding:8px; text-align:center;border-radius: 5px;text-shadow: 0px 1px 2px #00000085;}
</style>

<!-- Resources -->
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

<div class="wrapper">
<div class="dashboardleft">
<div class="dashboardleftinnter" style="position: fixed; width: 215px;">
<h4 class="card-title" style=" margin-top:0px; font-size: 18px;">Query Status</h4>
 <a href="display.html?startDate=<?php echo date('d-m-Y'); ?>&endDate=<?php echo date('d-m-Y'); ?>&keyword=&page=&ga=query&searchcity=&searchusers=&searchsource="> 
<div class="listbox"><span><?php echo countlisting('id','queryMaster',' where   DATE(dateAdded)="'.date('Y-m-d').'" '.$mainwhere.'  ');   ?></span>

<div style="margin-top:2px; font-size:12px; text-transform:uppercase; font-weight:700;">Today's Queries</div>
</div>
</a>

 <a href="display.html?startDate=01-01-<?php echo date('Y',strtotime(' - 1 Year')); ?>&endDate=<?php echo date('d-m-Y'); ?>&keyword=&page=&ga=query&searchcity=&searchusers=&searchsource=">
<div class="listbox" style="background-color:#e4ebf9;"><span><?php echo countlisting('id','queryMaster',' where  1 '.$mainwhere.'   ');   ?></span>

<div style="margin-top:2px; font-size:12px; text-transform:uppercase; font-weight:700;">Total Queries</div>
</div>
</a>
<a href="display.html?startDate=01-01-<?php echo date('Y',strtotime(' - 1 Year')); ?>&endDate=<?php echo date('d-m-Y'); ?>&keyword=&page=&ga=query&searchcity=&searchusers=&searchsource=&statusid=8">
<div class="listbox" style="background-color:#ffe7fb;"><span><?php echo countlisting('id','queryMaster',' where   statusId=8 and clientId in (select id from userMaster where userType=4 and firstName!="") '.$mainwherecnfq.' ');   ?></span>

<div style="margin-top:2px; font-size:12px; text-transform:uppercase; font-weight:700;">Proposal Sent </div>
</div>
</a>

<a href="display.html?startDate=01-01-<?php echo date('Y',strtotime(' - 1 Year')); ?>&endDate=<?php echo date('d-m-Y'); ?>&keyword=&page=&ga=query&searchcity=&searchusers=&searchsource=&statusid=9">
<div class="listbox" style="background-color:#fff1e8;"><span><?php echo countlisting('id','queryMaster',' where   statusId=9  and clientId in (select id from userMaster where userType=4 and firstName!="") '.$mainwherecnfq.' ');   ?></span>

<div style="margin-top:2px; font-size:12px; text-transform:uppercase; font-weight:700;">Total Pro. Conf </div>
</div>
</a>

<a href="display.html?startDate=01-01-<?php echo date('Y',strtotime(' - 1 Year')); ?>&endDate=<?php echo date('d-m-Y'); ?>&keyword=&page=&ga=query&searchcity=&searchusers=&searchsource=&statusid=5">
<div class="listbox" style="background-color:#e4fdf2;"><span><?php echo countlisting('id','queryMaster',' where   statusId=5  and clientId in (select id from userMaster where userType=4 and firstName!="") '.$mainwherecnfq.' ');   ?></span>

<div style="margin-top:2px; font-size:12px; text-transform:uppercase; font-weight:700;">Total Confirmed </div>
</div>
</a>
   <a href="display.html?startDate=01-01-<?php echo date('Y',strtotime(' - 1 Year')); ?>&endDate=<?php echo date('d-m-Y'); ?>&keyword=&page=&ga=query&searchcity=&searchusers=&searchsource=&statusid=7">
<div class="listbox" style="background-color:#ffeeed;"><span><?php echo countlisting('id','queryMaster',' where   statusId=7  '.$mainwhere.'   and clientId in (select id from userMaster where userType=4 and firstName!="")  ');   ?></span>

<div style="margin-top:2px; font-size:12px; text-transform:uppercase; font-weight:700;">Total Lost</div>
</div>
</a>
 
 
 

</div>


</div>
         <div class="container-fluid" style="padding-left: 288px !important; padding-right: 25px !important; padding-top: 8px !important;">


<?php if (strpos($LoginUserDetails["permissionAddEdit"], 'Query') !== false) { ?>
 
<div class="row">
 <div class="col-xl-12">
  <div class="card">
   <div class="card-body">
   <div class="row">
   
   <div class="col-xl-4">
   <div class="bigbtntab"><a href="#"  onclick="loadpop2('Add Client',this,'600px')" data-toggle="modal" data-target="#myModal2" data-backdrop="static" popaction="action=addclient"><table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="center" bgcolor="#fef1e1"><img src="images/icons8-circled-user-male-skin-type-7-64.png" width="42"  /> </td>
    <td width="75%">Add Client</td>
  </tr>
  
</table></a>
</div>
   </div>
   
    <div class="col-xl-4">
   <div class="bigbtntab"><a href="#" onclick="createquery('');"><table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="center" bgcolor="#e0f5f1"><img src="images/icons8-new-copy-80.png" width="42"  /> </td>
    <td width="75%">Add Query </td>
  </tr>
  
</table></a></div>
   </div>
   
    <div class="col-xl-3" style="display:none;">
   <div class="bigbtntab"><a href="display.html?ga=query"><table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="center" bgcolor="#f5e0ee"><img src="images/icons8-open-envelope-80.png" width="42"  /> </td>
    <td width="75%">Send Email </td>
  </tr>
  
</table></a></div>
   </div>
   
    <div class="col-xl-4">
   <div class="bigbtntab"><a href="#" onclick="loadpop2('Itinerary setup',this,'600px')" data-toggle="modal" data-target="#myModal2" data-backdrop="static" popaction="action=addtineraries"><table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="center" bgcolor="#ede5fd"><img src="images/icons8-open-box-64.png" width="42"  /> </td>
    <td width="75%">Add Itinerary </td>
  </tr>
  
</table></a></div>
   </div>
   
   </div>
   </div>
  </div>
 </div>
 
 <?php
 $rswe=GetPageRecord('*','weatherAPI',' 1   order by id asc'); 
while($restWeather=mysqli_fetch_array($rswe)){ 
?>
<div class="col-xl-3">
<div class="card" style="padding:10px;"> 
<div class="watherbox">
<?php if($restWeather['tempWether']!=''){ ?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="center">
	<?php if($restWeather['cloud_pct']<40){ ?>
	<img src="weathericon/1163662.png" height="50" />
	<?php } ?>
	
	<?php if($restWeather['cloud_pct']>40 && $restWeather['cloud_pct']<=60){ ?>
	<img src="weathericon/3222801.png" height="50" />
	<?php } ?>
	
	<?php if($restWeather['cloud_pct']>60 && $restWeather['cloud_pct']<=75){ ?>
	<img src="weathericon/414927.png" height="50" />
	<?php } ?>
	
	<?php if($restWeather['cloud_pct']>76 && $restWeather['cloud_pct']<=90){ ?>
	<img src="weathericon/4735072.png" height="50" />
	<?php } ?>
	
	<?php if($restWeather['cloud_pct']>90 && $restWeather['tempWether']>=0){ ?>
	<img src="weathericon/1146860.png" height="50" />
	<?php } ?>
	
	<?php if($restWeather['cloud_pct']>90 && $restWeather['tempWether']<0){ ?>
	<img src="weathericon/2315309.png" height="50" /> 
	<?php } ?>
	
	
	</td>
    <td width="70%" align="center"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="2" align="center"><div style="font-size:30px; font-weight:800; line-height:20px;"><?php echo $restWeather['tempWether']; ?><span style="font-size:12px; font-weight:400;">C</span></div></td>
        <td align="center" style="font-size:11px;">Feel: <?php echo $restWeather['feels_like']; ?>&#8451;</td>
      </tr>
      <tr>
        <td colspan="2" align="center" style="padding:0px 0px; font-size:14px; font-weight:600;"><?php echo $restWeather['cityName']; ?></td>
        <td align="center"style="font-size:11px;">W: <?php echo $restWeather['wind_speed']; ?> Kh</td>
      </tr>
      <tr>
        <td colspan="2" align="center" style="padding:0px 0px; font-size:11px; font-weight:600;"><?php echo date('D, d M'); ?></td>
        <td align="center"style="font-size:11px;">Hum: <?php echo $restWeather['cloud_pct']; ?>%</td>
      </tr>
      
    </table></td>
  </tr>
</table>
<?php } else { ?>
<div style="padding:21px 0px; text-align:center;">No Data</div>
<?php } ?>


</div> 
</div>
</div>
<?php } ?>

 

 

 
                     <div class="col-xl-6">
                            <div class="card">
                                <div class="card-body" style="height:350px;">
                                     <p class="text-muted font-weight-medium mt-1 mb-2"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> Task / Followup's</p>
									 
									  
									<div style="height:285px; overflow:auto;"><div class="taskfollowuplist">
<?php
 $totalno=1;

$a=GetPageRecord('*','queryTask',' 1 '.$mainwhere.' and (makeDone!=1 ) and taskType!="Notification" order by reminderDate asc limit 0,50');
while($rest=mysqli_fetch_array($a)){


$b=GetPageRecord('*','queryMaster','id="'.$rest['queryId'].'"'); 
$queryData=mysqli_fetch_array($b);

$bc=GetPageRecord('*','userMaster','id="'.$queryData['clientId'].'"'); 
$clientData=mysqli_fetch_array($bc);

?>

<div class="tasklist">
<div class="heading"><a href="display.html?ga=query&view=1&id=<?php echo encode($rest['queryId']); ?>&c=3" target="_blank"  style="color:#000000;"><?php if($rest['taskType']=='Task'){ ?>
	<i class="fa fa-calendar-check-o" aria-hidden="true"></i>
	<?php } ?>
	<?php if($rest['taskType']=='Call'){ ?>

	<i class="fa fa-phone-square" aria-hidden="true"></i>
	<?php } ?>
	<?php if($rest['taskType']=='Meeting'){ ?>
	<i class="fa fa-handshake-o" aria-hidden="true"></i>
	<?php } ?> &nbsp;<?php echo encode($rest['queryId']); ?> - <?php echo (stripslashes($rest['details'])); ?></a></div>
<div class="subline"><span style="margin-bottom:5px; font-size:12px; color:#FF0000;<?php if($rest['makeDone']==1){ ?>text-decoration: line-through;<?php } ?>"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo date('d/m/Y-h:i A',strtotime($rest['reminderDate'])); ?> </span> - <?php echo stripslashes($clientData['firstName']); ?> <?php echo stripslashes($clientData['lastName']); ?> <?php if($rest['makeDone']!=1 && date('Y-m-d',strtotime($rest['reminderDate']))>=date('Y-m-d')){ ?> <span class="badge badge-info">Scheduled</span><?php } ?>
  
  <?php if($rest['makeDone']!=1 && date('Y-m-d',strtotime($rest['reminderDate']))<date('Y-m-d')){ ?> <span class="badge badge-danger">Pending</span><?php } ?>
	<?php if($rest['makeDone']==1){ ?> <span class="badge badge-success">Done</span><div style="width:100%; margin-top:2px; font-size:11px;"><?php echo date('d/m/Y - h:i A',strtotime($rest['confirmDate'])); ?></div><?php } ?>

</div>
</div>
<?php  $totalno++; } ?>

</div>
							 <?php if($totalno==1){ ?> <div style="padding:10px; text-align:center;">Task / Followup's</div><?php } ?>
									</div>
 
                              </div>
                            </div>
                        </div>
						<style>
						
.todayspayment {
position: fixed;
top: 0px;
left: 0px;
right: 0px;
bottom: 0px;
margin: 370px;
margin-top: 100px;
background-color: #fff;
height: 420px;
z-index: 99999999;
}
						</style>
						<div class="col-xl-6"> 
						<div class="card" id="showtodayspayment">
                                        <div class="card-body" style="height: 350px;">
									   <p class="text-muted font-weight-medium mt-1 mb-2"><i class="fa fa-file-text" aria-hidden="true"></i> Today's Payment Collection </p>
									   <button type="button" id="closepayment" onclick="closepayementbox();" class="btn btn-secondary btn-lg waves-effect waves-light" style="padding: 6px 10px; position: absolute; top: 12px; right: 30px; display:none;"  >Close</button>
									   
									   <div style="height:277px; overflow:auto;">
									 <table class="table table-hover mb-0" style="border:1px solid #ddd;">

                                            <thead>
                                                <tr>
                                                  <th>Query ID </th>
                                                  <th>Amount</th>
                                                  <th>Due Date</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
<tbody> 
<?php
$pendingpay=0;
$totalno=1;
 
if($LoginUserDetails['showQueryStatus']==1){

$a=GetPageRecord('*','sys_PackagePayment',' 1 and DATE(paymentDate)<="'.date('Y-m-d').'" and paymentStatus!=1   order by paymentDate asc limit 0,50');
} else {
$a=GetPageRecord('*','sys_PackagePayment',' 1 and DATE(paymentDate)<="'.date('Y-m-d').'" and paymentStatus!=1 and queryId in(select id from queryMaster where 1 '.$mainwhere.')  order by paymentDate asc limit 0,50');

}



while($paymentlist=mysqli_fetch_array($a)){ 


$b3d=GetPageRecord('*','userMaster','id in (select clientId from queryMaster where id="'.$paymentlist['queryId'].'" )'); 
$clientData=mysqli_fetch_array($b3d);
?>

<tr style="font-size:12px;">
  <td align="left" valign="top"><a href="display.html?ga=query&view=1&id=<?php echo encode($paymentlist['queryId']); ?>" target="_blank" style="color: #2b99e7 !important;">#<?php echo encode($paymentlist['queryId']); ?></a><br /><?php echo stripslashes($clientData['firstName']); ?> <?php echo stripslashes($clientData['lastName']); ?></td>
  <td align="left" valign="top" style="    font-size: 14px;">&#8377;<?php echo ($paymentlist['amount']); ?></td>
  <td align="left" valign="top"><?php echo date('d/m/Y',strtotime($paymentlist['paymentDate'])); ?> </td>
  <td align="left" valign="top"><?php if($paymentlist['paymentStatus']==1){ ?><span class="badge badge-success">Paid</span><?php } ?>
  
  <?php if(date('Y-m-d H:i:s',strtotime($paymentlist['paymentDate']))>=date('Y-m-d H:i:s')){  if($paymentlist['paymentStatus']==2){ $pendingpay=1; ?><span class="badge badge-warning">Scheduled</span><?php } } else { if($paymentlist['paymentStatus']==2){  $pendingpay=1; ?> <span class="badge badge-danger">Overdue</span> <?php } } ?>  </td>
</tr>


<?php  $totalno++; } ?>
                                          </tbody>
                              </table>
									 </div>
						 
									 
										</div>
										</div>
						 </div>
						 
						 
						</div>
<?php } ?>
     <div class="row">
 

                        <div class="col-xl-5">
                            <div class="card">
                                <div class="card-body" style="height: height: 375px;;">
                                     <p class="text-muted font-weight-medium mt-1 mb-2">This Year Queries</p>
									 
									 <script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdiv", am4charts.XYChart3D);

// Add data
chart.data = [


<?php
for($iM =1;$iM<=12;$iM++){
$month=date("M", strtotime("$iM/12/10"));
?>
{
  "country": "<?php echo $month; ?>",
  "visits": <?php echo countlisting('id','queryMaster',' where 1 '.$mainwhere.' and MONTH(dateAdded)='.date("m", strtotime("$iM/12/10")).' and YEAR(dateAdded)='.date('Y').' '); ?>
},
<?php $i++; } ?>


];

// Create axes
let categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "country";
categoryAxis.renderer.labels.template.rotation = 270;
categoryAxis.renderer.labels.template.hideOversized = false;
categoryAxis.renderer.minGridDistance = 20;
categoryAxis.renderer.labels.template.horizontalCenter = "right";
categoryAxis.renderer.labels.template.verticalCenter = "middle";
categoryAxis.tooltip.label.rotation = 270;
categoryAxis.tooltip.label.horizontalCenter = "right";
categoryAxis.tooltip.label.verticalCenter = "middle";

let valueAxis = chart.yAxes.push(new am4charts.ValueAxis());


// Create series
var series = chart.series.push(new am4charts.ColumnSeries3D());
series.dataFields.valueY = "visits";
series.dataFields.categoryX = "country";
series.name = "Visits";
series.tooltipText = "{categoryX}: [bold]{valueY}[/]";
series.columns.template.fillOpacity = .8;

var columnTemplate = series.columns.template;
columnTemplate.strokeWidth = 2;
columnTemplate.strokeOpacity = 1;
columnTemplate.stroke = am4core.color("#FFFFFF");

columnTemplate.adapter.add("fill", function(fill, target) {
  return chart.colors.getIndex(target.dataItem.index);
})

columnTemplate.adapter.add("stroke", function(stroke, target) {
  return chart.colors.getIndex(target.dataItem.index);
})

chart.cursor = new am4charts.XYCursor();
chart.cursor.lineX.strokeOpacity = 0;
chart.cursor.lineY.strokeOpacity = 0;

}); // end am4core.ready()
</script>

<!-- HTML -->
<div id="chartdiv"></div>
                              </div>
                            </div>
                        </div>
						
						<div class="col-xl-3"> 
						<div class="card">
                                        <div class="card-body" style="height: height: 365px;;">
									   <p class="text-muted font-weight-medium mt-1 mb-2">QUERIES BY STATUS</p>
									   <div id="chartdiv2" style="height:292px;"></div>
						 
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
						 
						 
						 <div class="col-xl-4"> <div class="card">
                                <div class="card-body">
								<?php
								 $rs=GetPageRecord('count(id) as totaltours','sys_packageBuilder','1  and confirmQuote=1 and queryId!=0 and startDate="'.date('Y-m-d').'" order by id desc');  
									$resttotal=mysqli_fetch_array($rs); ?>
						 <p class="text-muted font-weight-medium mt-1 mb-2">Today Tours (<?php echo $resttotal['totaltours']; ?>)</p>
						 
						 <style>
							.statusboxed{
							width: 12px !important;
							height: 12px !important;
							border-radius: 100%;
						 }
						 </style>
						 
						 
						 <!--<div style="height:251px; overflow:auto;" id="loadliveclients">
						 </div>-->
						 
						 
						 <script>
						/*window.setInterval(function(){
						loadliveusers();
						}, 10000);
						
						function loadliveusers(){
						$('#loadliveusers').load('loadliveusers.php');
						$('#loadliveclients').load('loadliveclients.php');
						}
						
						loadliveusers();*/
						</script>
						 
					<!--	 <div style=" margin-top:10px;">
						 
						 <a href="display.html?ga=usermessenger"><button type="button" class="btn btn-primary btn-lg" style=" width:100%;"><i class="fa fa-comments" aria-hidden="true"></i> View All Chats</button></a>
						 
						 </div>-->
						 
						 <div style="height:251px; overflow:auto;" class="taskfollowuplist">
					<?php
					$t=1;
					  $rs=GetPageRecord('*','sys_packageBuilder','1  and confirmQuote=1 and queryId!=0 and startDate="'.date('Y-m-d').'" order by id desc');  
while($rest=mysqli_fetch_array($rs)){

$wherequeryt='';
if($_SESSION['userid']!=1){
$wherequeryt=' assignTo="'.$_SESSION['userid'].'" ';
}

$b=GetPageRecord('*','queryMaster','id="'.$rest['queryId'].'" '.$wherequeryt.' '); 
$queryData=mysqli_fetch_array($b);

if($queryData['id']!=''){

$bc=GetPageRecord('*','userMaster','id="'.$queryData['clientId'].'"'); 
$clientData=mysqli_fetch_array($bc);

$bcd=GetPageRecord('*','sys_packageBuilderEvent','packageId="'.$rest['id'].'" and sectionType="Flight"'); 
$eventdata=mysqli_fetch_array($bcd);
?>
					<div class="tasklist">
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top"><div class="heading"><a href="<?php echo $fullurl; ?>display.html?ga=query&view=1&id=<?php echo encode($rest['queryId']);  ?>&c=2" target="_blank" style="color:#000000; font-size:12px;">	
	<?php echo str_replace("'","",str_replace(',','',stripslashes($rest['name'])));  ?></a></div>
<div class="subline"><i class="fa fa-user" aria-hidden="true"></i>   <?php echo stripslashes($clientData['submitName']); ?> <?php echo stripslashes($clientData['firstName']); ?> <?php echo stripslashes($clientData['lastName']); ?>  
   
	
</div></td>
    <td width="10%" align="left" valign="top" style="padding-left:10px;">
	<?php if($eventdata['id']!=''){ ?>
	<img src="data:image/png;base64,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" width="40">
	<?php } else { ?>
	<img src="data:image/png;base64,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" width="40">




	<?php } ?>

</td>
  </tr>
</table>


</div>
					<?php $t++; } } ?>
					
					<?php if($t==1){ ?>
					<div style="padding:20px; text-align:center; font-size:12px;">No Tours Today</div>
					<?php } ?>
						 </div>
						 
						 	 <div style=" margin-top:10px;">
						 
						 <a href="display.html?ga=travelreport"><button type="button" class="btn btn-primary btn-lg" style=" width:100%;">View All Tours</button></a>
						 
						 </div>
						</div>	
						</div>
						</div>
						 
						 
						</div>



<?php if($LoginUserDetails['userType']==0){  ?>
     <div class="row">
 

                        <div class="col-xl-4"> <div class="card">
                                <div class="card-body">
						 <p class="text-muted font-weight-medium mt-1 mb-2">SALES REPS</p>
						 <div style="height:320px; overflow:auto;"><table width="100%" border="0" cellpadding="0" cellspacing="0" style=" font-size:12px;">
						  <tr>
    <td align="left" style="padding:5px; border-bottom:1px solid #ddd;"><strong>Name</strong></td>
    <td align="center" bgcolor="#F3F3F3" style="padding:5px;  border-bottom:1px solid #ddd;"><strong>Assigned</strong></td>
    <td align="center" bgcolor="#E8FFF1" style="padding:5px;  border-bottom:1px solid #ddd;"><strong>Confirmed </strong></td>
  </tr>
<?php
$rr=1;
$rs=GetPageRecord('count(id) as astotalcountquery,id,assignTo','queryMaster','  1 and assignTo!=0  group by assignTo order by astotalcountquery desc limit 0, 15 ');
while($rest=mysqli_fetch_array($rs)){ 

$abcd=GetPageRecord('*','sys_userMaster','id="'.$rest['assignTo'].'"'); 
$userdata=mysqli_fetch_array($abcd);
?>
 
  <tr>
    <td width="72%" align="left" style="padding:5px; border-bottom:1px solid #ddd;"><?php echo $rr; ?>. <?php echo strip($userdata['firstName']); ?> <?php echo strip($userdata['lastName']); ?></td>
    <td width="28%" align="center" bgcolor="#F3F3F3" style="padding:5px;  border-bottom:1px solid #ddd;"><?php echo countlisting('id','queryMaster',' where  1 '.$mainwhere.' and clientId in (select id from userMaster where userType=4 and firstName!="") and assignTo="'.$userdata['id'].'"  ');   ?></td>
    <td width="28%" align="center" bgcolor="#E8FFF1" style="padding:5px;  border-bottom:1px solid #ddd;"><?php echo countlisting('id','queryMaster',' where statusId=5   '.$mainwhere.' and clientId in (select id from userMaster where userType=4 and firstName!="") and assignTo="'.$userdata['id'].'"  ');   ?></td>
  </tr>
  <?php $rr++; } ?>
</table></div>
						</div>	</div>
						</div>
						
						
                        <div class="col-xl-4"> <div class="card">
                                <div class="card-body">
						 <p class="text-muted font-weight-medium mt-1 mb-2">TOP LEAD SOURCES</p>
						 <div style="height:320px; overflow:auto;"><table width="100%" border="0" cellpadding="0" cellspacing="0" style=" font-size:12px;">
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

if($userdata['name']!=''){
?>
 
  <tr>
    <td width="72%" align="left" style="padding:5px; border-bottom:1px solid #ddd;"><?php echo $rr; ?>. <?php echo strip($userdata['name']); ?></td>
    <td width="28%" align="center" bgcolor="#F3F3F3" style="padding:5px;  border-bottom:1px solid #ddd;"><?php echo countlisting('id','queryMaster',' where  1 '.$mainwhere.' and   leadSource="'.$userdata['id'].'"  and clientId in (select id from userMaster where userType=4 and firstName!="")  ');   ?></td>
    <td width="28%" align="center" bgcolor="#E8FFF1" style="padding:5px;  border-bottom:1px solid #ddd;"><?php echo countlisting('id','queryMaster',' where  statusId=5 and 1 '.$mainwhere.' and   leadSource="'.$userdata['id'].'"  and clientId in (select id from userMaster where userType=4 and firstName!="")  ');   ?></td>
  </tr>
  <?php $rr++; }} ?>
</table></div>
						</div>	</div>
						</div>
						
						
						
						<div class="col-xl-4"> <div class="card">
                                <div class="card-body">
						 <p class="text-muted font-weight-medium mt-1 mb-2">Finance Report </p>
						 
					<div style="padding: 5px; background-color: #d2f1ff; border-radius: 5px; margin-bottom: 4px;"><table width="100%" border="0" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC">
  <tr>
    <td><strong>This Month Sales</strong></td>
    <td width="40%" align="right" style="font-weight:800;">
	
	<?php 
	$rspro=GetPageRecord('SUM(grossPrice) as totalthismonthsale','sys_packageBuilder',' confirmQuote=1 and Month(confirmDate)="'.date('m').'"  and Year(confirmDate)="'.date('Y').'" and queryId in (select id from queryMaster where statusId=5)'); 
 	$thismonthsale=mysqli_fetch_array($rspro);
	echo '&#8377;'.number_format($thismonthsale['totalthismonthsale']);
	
	
	$rspro=GetPageRecord('SUM(grossPrice) as totalthismonthsalequery','sys_packageBuilder',' confirmQuote=1 and queryId in (select id from queryMaster where statusId=5)'); 
 	$thismonthsale=mysqli_fetch_array($rspro);
	 
	  $ba=GetPageRecord('SUM(amount) as totalrecived','sys_PackagePayment',' paymentStatus=1  '); $packagecostrecived=mysqli_fetch_array($ba); 
	  
	 $ba=GetPageRecord('SUM(amount) as totalrecived','sys_PackagePayment',' paymentStatus=1  '); $packagecostrecived=mysqli_fetch_array($ba); 
	 
	 $finalpendingamount=number_format(round($thismonthsale['totalthismonthsalequery']-$packagecostrecived['totalrecived']));
?>	</td>
  </tr>
</table>
					</div>
					
					
					<div style="padding: 5px; background-color: #D2FFED; border-radius: 5px; margin-bottom: 4px;"><table width="100%" border="0" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC">
  <tr>
    <td><strong>This&nbsp;Month&nbsp;Collections</strong></td>
    <td width="40%" align="right" style="font-weight:800;">
	
 <?php $ba=GetPageRecord('SUM(amount) as totalrecived','sys_PackagePayment',' paymentStatus=1  and DATE(PAYMENTDATE)  between  "'.date('Y-m-1').'" and "'.date('Y-m-d').'"'); $packagecostrecived=mysqli_fetch_array($ba); echo '&#8377;'.number_format($packagecostrecived['totalrecived']); ?>

</td>
  </tr>
</table>
					</div>
					
					
					<div style="padding: 5px; background-color:#FFE1E1; border-radius: 5px; margin-bottom: 4px;"><table width="100%" border="0" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC">
  <tr>
    <td><strong>Total&nbsp;Pending&nbsp;Collection</strong></td>
    <td width="40%" align="right" style="font-weight:800;">
	
	
 <?php echo '&#8377;'.$finalpendingamount; ?>

</td>
  </tr>
</table>
					</div>
					
					
					<div style="padding: 5px; background-color:#FFEEB3; border-radius: 5px; margin-bottom: 4px;"><table width="100%" border="0" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC">
  <tr>
    <td><strong>Total&nbsp;Supplier&nbsp;Pending </strong></td>
    <td width="40%" align="right" style="font-weight:800;">
	
	<?php
$netflightcosting=0;
$totalnetCost=0;
$totalnetCostfinal=0;
$totalnetCostfinalpaid=0;
$totalGross=0;
$netCost=0;
$rs=GetPageRecord('*','sys_packageBuilderEvent','   packageId in (select id from sys_packageBuilder where queryId in( select id from queryMaster where statusId=5)) and sectionType!="Leisure" and name!="" ');
while($rest=mysqli_fetch_array($rs)){ 
 

$netCost=0;
$markupValue=0;
$gross=0;

$predate=date('d-m-Y',strtotime($editresult['startDate']));
?>


<?php
$totalnetCostfinalpaid=$totalnetCostfinalpaid+$rest['paidAmount'];


if($rest['sectionType']=='Accommodation'){

 $totalnetCostfinal=$totalnetCostfinal+$netCost=round($rest['singleRoomCost']*$rest['singleRoom'])+($rest['doubleRoomCost']*$rest['doubleRoom'])+($rest['tripleRoomCost']*$rest['tripleRoom'])+($rest['quadRoomCost']*$rest['quadRoom'])+($rest['cwbRoomCost']*$rest['cwbRoom'])+($rest['cnbRoomCost']*$rest['cnbRoom']);

} else { 

if($rest['transferCategory']=='Private'){

 $totalnetCostfinal=$totalnetCostfinal+$netCost=round($rest['vehicle']*$rest['adultCost']);

} else {

 $totalnetCostfinal=$totalnetCostfinal+$netCost=round($rest['adultCost']*$editresult['adult'])+($rest['childCost']*$editresult['child']);

if($rest['sectionType']=='Flight'){
$netflightcosting=$netCost+$netflightcosting;
}


}
 
}




$totalnetCost=$netCost+$totalnetCost;

 


 
 ?>
  
 <?php }    echo '&#8377;'.number_format(round($totalnetCostfinal-$totalnetCostfinalpaid)); ?>
 

</td>
  </tr>
</table>
					</div>
						 
						 
						 <div style="padding: 5px; background-color:#eee1ff; border-radius: 5px; margin-bottom: 4px;"><table width="100%" border="0" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC">
  <tr>
    <td><strong>This&nbsp;Month&nbsp;Expense</strong></td>
    <td width="40%" align="right" style="font-weight:800;">
	
	
 <?php $ba=GetPageRecord('SUM(amount) as totalgross','expenseMaster',' 1 and DATE(paymentDate) between  "'.date('Y-m-1').'" and "'.date('Y-m-d').'"  ' ); $packagecost=mysqli_fetch_array($ba); echo number_format($packagecost['totalgross']); ?>

</td>
  </tr>
</table>
					</div>
						 
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="    margin-bottom: 5px; margin-top:5px;">
  <tr>
    <td colspan="2"  style="padding-right:3px;"><div style="padding: 15px 0px; text-align: center; border: 1px solid #ddd; border-radius: 5px; margin-top: 8px; background-color: #f9f9f9;">
	<div style="font-size:20px; font-weight:700;"><?php
		$rspro=GetPageRecord('SUM(grossPrice) as totalthismonthsale','sys_packageBuilder',' confirmQuote=1    and Year(confirmDate)="'.date('Y').'" and queryId in (select id from queryMaster where statusId=5)'); 
 	$thismonthsale=mysqli_fetch_array($rspro);
	echo '&#8377;'.number_format($thismonthsale['totalthismonthsale']);
	?></div>
	<div style="font-size:12px; font-weight:600;"><?php echo date('Y'); ?>  Sales</div>
	</div></td>
    <td width="50%" style="padding-left:3px;"><div style="padding: 15px 0px; text-align: center; border: 1px solid #ddd; border-radius: 5px; margin-top: 8px; background-color: #f9f9f9;">
	<div style="font-size:20px; font-weight:700;"><?php $ba=GetPageRecord('SUM(amount) as totalrecived','sys_PackagePayment',' paymentStatus=1  and DATE(PAYMENTDATE)  between  "'.date('Y-1-1').'" and "'.date('Y-m-d').'"'); $packagecostrecived=mysqli_fetch_array($ba); echo '&#8377;'.number_format($packagecostrecived['totalrecived']); ?></div>
	<div style="font-size:12px; font-weight:600;"><?php echo date('Y'); ?>  Collections</div>
	</div></td>
  </tr>
</table>

						 
						 
						 
						</div>	</div>
						</div>
						
						 
         </div>
		 <?php } ?>
         <!-- end container-fluid -->
      </div>
	   <div style="position:fixed; width:100%; height:100%; top:0; left:0; z-index:999; background-color:#00000094; display:none;" id="blackdiv"></div>
						 
			<script>
									   	function closepayementbox(){
											/*$('#blackdiv').hide();
											$('#closepayment').hide();
											$('#showtodayspayment').removeClass('todayspayment');*/
										}
											function openpayementbox(){/*
											$('#blackdiv').show();
											$('#closepayment').show();
											$('#showtodayspayment').addClass('todayspayment');
										*/}
										<?php if($pendingpay==1){ ?>
										openpayementbox();
										<?php } ?>
									   </script>			  
<script>
if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
$('.container-fluid').removeAttr('style');
}
</script>

 