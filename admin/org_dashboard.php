<?php
include "inc.php"; 
$mainwhere='';  
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
    color: #212529!important;
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

html{background-color:#f8fafa!important;}
body{background-color:#f8fafa!important;}
.card-body { padding: 10px 15px; }
.watherbox{background: rgb(140,190,244); background: linear-gradient(180deg, rgba(140,190,244,1) 0%, rgba(51,140,236,1) 48%); color:#FFFFFF; padding:8px; text-align:center;border-radius: 5px;text-shadow: 0px 1px 2px #00000085;}

.table thead th {  padding: 5px 10px 5px 15px; }
</style>

<!-- Resources -->


<div class="wrapper">
 
         <div class="container-fluid" style="padding-left: 70px !important; padding-right: 25px !important; padding-top: 8px !important;">
 <div class="row">
<div class="col-xl-12">
<?php include "dashboardtab.php"; ?>
</div>
</div>
 <div class="row">
 		<div class="col-xl-6">
			
			<div class="card"> 
			 
			<div class="card-body"  >
			<p class="text-muted font-weight-medium mt-1 mb-2 dashheader">Earning Reports</p>
	 <div class="row"  >
	 
	 <div class="col-xl-4">
	 <table width="100%" border="0" cellpadding="0" cellspacing="0" style="height:200px;">
  <tr>
    <td height="0" colspan="3">&nbsp;</td>
    </tr>
  <tr>
    <td colspan="3">
	<?php
	$a=GetPageRecord('SUM(agentTax) as totalagentTax, SUM(tax) as totaltax, SUM(agentTotalFare) as totalagentTotalFare, SUM(markup) as totalagentmarkup','flightBookingMaster',' YEAR(bookingDate)='.date("Y").'  and status=2');
$restflights=mysqli_fetch_array($a);
?>

	<?php 
	$a=GetPageRecord('SUM(markup) as totalmarkup, SUM(agentTotalFare) as totalhotelagentTotalFare, SUM(agentMarukup) as totalhotelagentMarukup','hotelBookingMaster',' YEAR(addDate)='.date("Y").'  and status=2');
$resthotels=mysqli_fetch_array($a);
?>
	<div style="font-size:40px; color:#666666; line-height:40px;">&#8377;<?php echo ($restflights['totalagentTax']-$restflights['totaltax'])+$resthotels['totalmarkup']; ?></div>
	<div style="font-weight:600;">This year total profit</div>
	</td>
  </tr>
</table>

	 
	 </div>
		<div class="col-xl-8">
		 <script>
		 am5.ready(function() {

// Create root element
// https://www.amcharts.com/docs/v5/getting-started/#Root_element
var root = am5.Root.new("chartdiv");


// Set themes
// https://www.amcharts.com/docs/v5/concepts/themes/
root.setThemes([
  am5themes_Animated.new(root)
]);


// Create chart
// https://www.amcharts.com/docs/v5/charts/xy-chart/
var chart = root.container.children.push(am5xy.XYChart.new(root, {
  panX: true,
  panY: true,
  wheelX: "panX",
  wheelY: "zoomX",
  pinchZoomX:true
}));

// Add cursor
// https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
cursor.lineY.set("visible", false);


// Create axes
// https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
var xRenderer = am5xy.AxisRendererX.new(root, { minGridDistance: 30 });
xRenderer.labels.template.setAll({
  rotation: -90,
  centerY: am5.p50,
  centerX: am5.p100,
  paddingRight: 15
});

var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
  maxDeviation: 0.3,
  categoryField: "country",
  renderer: xRenderer,
  tooltip: am5.Tooltip.new(root, {})
}));

var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
  maxDeviation: 0.3,
  renderer: am5xy.AxisRendererY.new(root, {})
}));


// Create series
// https://www.amcharts.com/docs/v5/charts/xy-chart/series/
var series = chart.series.push(am5xy.ColumnSeries.new(root, {
  name: "Series 1",
  xAxis: xAxis,
  yAxis: yAxis,
  valueYField: "value",
  sequencedInterpolation: true,
  categoryXField: "country",
  tooltip: am5.Tooltip.new(root, {
    labelText:"{valueY}"
  })
}));

series.columns.template.setAll({ cornerRadiusTL: 5, cornerRadiusTR: 5 });
series.columns.template.adapters.add("fill", function(fill, target) {
  return chart.get("colors").getIndex(series.columns.indexOf(target));
});

series.columns.template.adapters.add("stroke", function(stroke, target) {
  return chart.get("colors").getIndex(series.columns.indexOf(target));
});


// Set data
var data = [
<?php
for($iM =1;$iM<=12;$iM++){
$month=date("M", strtotime("$iM/12/10"));
?>
{ 
  country: "<?php echo $month; ?>",
  value: <?php echo $totalconfirmedbooking=(countlisting('id','flightBookingMaster',' where 1  and MONTH(bookingDate)='.date("m", strtotime("$iM/12/10")).' and YEAR(bookingDate)='.date('Y').' and status=2')+countlisting('id','hotelBookingMaster',' where 1  and MONTH(addDate)='.date("m", strtotime("$iM/12/10")).' and YEAR(addDate)='.date('Y').' and status=2')); ?>
},<?php  $i++; } ?> ];

xAxis.data.setAll(data);
series.data.setAll(data);


// Make stuff animate on load
// https://www.amcharts.com/docs/v5/concepts/animations/
series.appear(1000);
chart.appear(1000, 100);

}); // end am5.ready()
		 
		  
</script><div id="chartdiv" style="height:230px; width:100%;"></div>
</div>

 <div class="col-xl-12">
 <div style="border: 1px solid #ddd; padding: 10px; border-radius: 5px; margin-top:10px;">
 
 <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="32%" align="left" valign="top">
	<div style="font-size:14px; font-weight:500;">Buying</div>
	<div style="font-size:24px; font-weight:600; color:#666666;">&#8377;<?php echo $totalbuying=($restflights['totalagentTotalFare']-$restflights['totalagentmarkup'])+($resthotels['totalhotelagentTotalFare']-$resthotels['totalhotelagentMarukup']-$resthotels['totalmarkup']); ?></div>
	</td>
    <td width="33%" align="left" valign="top" style="padding-left:30px; border-left:1px solid #ddd;">	<div style="font-size:14px; font-weight:500;">Selling</div>
	<div style="font-size:24px; font-weight:600; color:#666666;">&#8377;<?php echo  $totalselling=($restflights['totalagentTotalFare'])+($resthotels['totalhotelagentTotalFare']-$resthotels['totalhotelagentMarukup']); ?></div></td>
    <td width="33%" align="left" valign="top"style="padding-left:30px; border-left:1px solid #ddd;">	<div style="font-size:14px; font-weight:500;">Earnings</div>
	<div style="font-size:24px; font-weight:600; color:#666666;">&#8377;<?php echo ($totalselling-$totalbuying); ?></div></td>
  </tr>
</table>

 </div>
 </div>

<!-- HTML -->


</div>

			</div>
			</div>
			</div>
			
			<div class="col-xl-6">
			
			<div class="card"> 
			
			<div class="card-body"  >
			<p class="text-muted font-weight-medium mt-1 mb-2 dashheader">Booking Vs Confirmed</p>
	  <div class="row" style=" padding-left:20px;">
	 
	 <div class="col-xl-4"> 
	 <div style="font-weight:600; margin-bottom:30px;">This year bookings</div>
	 
	 <div style="font-size:40px; color:#666666; line-height:40px;"><?php echo $totalbookings=(countlisting('id','flightBookingMaster',' where 1  and  YEAR(bookingDate)='.date('Y').' and status!=2')+countlisting('id','hotelBookingMaster',' where 1   and YEAR(addDate)='.date('Y').' ')); ?></div>
	<div style="font-weight:600; margin-bottom:30px;">Total Bookings</div>
	
	
	 <div style="font-size:40px; color:#666666; line-height:40px;"><?php echo $totalconfirmedbooking; ?></div>
	<div style="font-weight:600;">Total Confirmed Bookings</div>
	 </div>
	 
	  <div class="col-xl-8">
	 <script>
am5.ready(function() {

// Create root element
// https://www.amcharts.com/docs/v5/getting-started/#Root_element
var root = am5.Root.new("chartdivbookings");

// Set themes
// https://www.amcharts.com/docs/v5/concepts/themes/
root.setThemes([
  am5themes_Animated.new(root)
]);

// Create chart
// https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
var chart = root.container.children.push(
  am5percent.PieChart.new(root, {
    startAngle: 160, endAngle: 380
  })
);

// Create series
// https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series

var series0 = chart.series.push(
  am5percent.PieSeries.new(root, {
    valueField: "litres",
    categoryField: "country",
    startAngle: 160,
    endAngle: 380,
    radius: am5.percent(90),
    innerRadius: am5.percent(90)
  })
);

var colorSet = am5.ColorSet.new(root, {
  colors: [series0.get("colors").getIndex(0)],
  passOptions: {
    lightness: -0.05,
    hue: 0
  }
});

series0.set("colors", colorSet);

series0.ticks.template.set("forceHidden", true);
series0.labels.template.set("forceHidden", true);

var series1 = chart.series.push(
  am5percent.PieSeries.new(root, {
    startAngle: 160,
    endAngle: 380,
    valueField: "bottles",
    innerRadius: am5.percent(80),
    categoryField: "country"
  })
);
 

var label = chart.seriesContainer.children.push(
  am5.Label.new(root, {
    textAlign: "center",
    centerY: am5.p100,
    centerX: am5.p50,
    text: "[fontSize:18px][/]Total\n[bold fontSize:30px]Bookings[/]"
  })
);

var data = [
  {
    country: "Attempt",
    bottles: <?php echo $totalbookings; ?>
  },{
    country: "Confirmed",
    bottles: <?php echo $totalconfirmedbooking; ?>
  } 
];

// Set data
// https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
series0.data.setAll(data);
series1.data.setAll(data);

}); // end am5.ready()
</script>

<!-- HTML -->
<div style="height:318px;">
<div id="chartdivbookings" style="height:280px;"></div>
</div>
	 </div>
	 
	 </div>

			</div>
			</div>
			</div>
			
			
			
				<div class="col-xl-2">
			<?php
			$rs8=GetPageRecord('SUM(amount) as totalcreditAmt','sys_balanceSheet',' paymentType="Credit" and offlineAgent=0 '); 

$agentCreditAmt=mysqli_fetch_array($rs8); 



$rs8=GetPageRecord('SUM(amount) as totaldebitAmt','sys_balanceSheet',' paymentType="Debit" and offlineAgent=0 '); 

$agentDebitAmt=mysqli_fetch_array($rs8); 



$totalwalletBalance=($agentCreditAmt['totalcreditAmt']-$agentDebitAmt['totaldebitAmt']);
?>
			<div class="card"> 
				 
			<div class="card-body"   >
			<p class="text-muted font-weight-medium mt-1 mb-2 dashheader" style="margin-bottom: 18px !important;">Balance Sheet</p>
			<div style="padding: 10px 15px; color: #FFFFFF; font-size: 26px; font-weight: 500; background-color: #066f6d; border-radius: 10px; margin-bottom:10px;">&#8377;<?php echo round($agentCreditAmt['totalcreditAmt']); ?>
			<div style="font-size:14px;">Total Credit</div>
			</div>
			
			<div style="padding: 10px 15px; color: #FFFFFF; font-size: 26px; font-weight: 500; background-color: #981b47; border-radius: 10px; margin-bottom:10px;">&#8377;<?php echo round($agentDebitAmt['totaldebitAmt']); ?>
			<div style="font-size:14px;">Total Debit</div>
			</div>
			
			
			<div style="padding: 10px 15px; color: #000000; font-size: 26px; font-weight: 500; background-color: #ececec; border-radius: 10px; margin-bottom: 10px;">&#8377;<?php echo round($totalwalletBalance); ?>
			<div style="font-size:14px;">Total Wallet Balance</div>
			</div>
			</div>
			
			</div>
			</div>
			
			
			<div class="col-xl-5">
			 
			<div class="card"> 
				<div  style="padding:10px 15px 5px;">
					<p class="text-muted font-weight-medium mt-1 mb-2 dashheader">New Register Agents</p>
			</div>
			<div class="card-body"  style="padding:0px 20px 10px;height: 285px; overflow: auto;" >
			
			
			 
			
			 <table class="table" style="font-size:12px;">

							<thead>

								<tr>

								  <th>Company</th>

								  <th>Agent</th>

								  <th align="center"><div align="center">Status</div></th>
							    </tr>
							</thead>

							<tbody>

								<?php 

$limit=clean($_GET['records']);

$page=clean($_GET['page']); 

$sNo=1; 





$search='';



 


if($_REQUEST['fromdate']!='' && $_REQUEST['todate']!=''){

$search.=' and  DATE(addDate)>="'.date('Y-m-d',strtotime($_REQUEST['fromdate'])).'" and  DATE(addDate)<="'.date('Y-m-d',strtotime($_REQUEST['todate'])).'" ';

}





if($_REQUEST['keyword']!=''){

$search.=' and  (companyName like "%'.$_REQUEST['keyword'].'%" or agentId like "%'.decodemakeAgentId($_REQUEST['keyword']).'%" or  name like "%'.$_REQUEST['keyword'].'%" or  phone like "%'.$_REQUEST['keyword'].'%" or  email like "%'.$_REQUEST['keyword'].'%") ';

}



$managerwhere='';

	if($LoginUserDetails['roleId']==5){

$managerwhere=' and   salesManager="'.$_SESSION['userid'].'"   ';

}

 









 

$targetpage='display.html?ga='.$_REQUEST['ga'].'&agentCategory='.$_REQUEST['agentCategory'].'&fromdate='.$_REQUEST['fromdate'].'&todate='.$_REQUEST['todate'].'&keyword='.$_REQUEST['keyword'].'&'; 

$rs=GetRecordList('*','sys_userMaster',' where userType="agent"   order by id desc  ','10',$page,$targetpage); 

$totalentry=$rs[1]; 

$paging=$rs[2];  

while($rest=mysqli_fetch_array($rs[0])){ 

$totalSale=0;

 

 

?>

								

								<tr>

								  <td align="left" valign="top"><a target="_blank" href="display.html?ga=agents&id=<?php echo encode($rest['id']); ?>&add=1"><strong><?php  echo ($rest['agentId']); ?></strong> <br />

<strong><?php echo stripslashes($rest['companyName']); ?></strong><br />

<?php echo date('d-m-Y',strtotime($rest['dateAdded'])); ?></a> </td>

								  <td align="left" valign="top">

								  <strong> <?php echo stripslashes($rest['firstName']); ?> <?php echo stripslashes($rest['lastName']); ?></strong>

								  <div style="margin-bottom:2px;"><i class="fa fa-phone" aria-hidden="true"></i> &nbsp;<?php echo stripslashes($rest['countryCode']); ?>-<?php echo stripslashes($rest['phone']); ?></div>

								  <div style="margin-bottom:2px;"><i class="fa fa-envelope" aria-hidden="true"></i> &nbsp;<a href="mailto:<?php echo stripslashes($rest['email']); ?>"><?php echo stripslashes($rest['email']); ?></a></div> 

<i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo ($rest['city']); ?>, <?php echo ($rest['state']); ?>, <?php echo ($rest['country']); ?>						  </td>

                                  <td align="center" valign="top">

								  

								  <div align="center">
									<?php if($rest['status']==0){ ?>
								  <div style="background-color: #ff0000; font-weight: 700; padding: 5px 10px; display: inline-block; line-height: 10px; border-radius: 10px; color: #fff;">

								  Deactive </div>
								  <?php } else { ?>
								  <div style="background-color: #1f8513; font-weight: 700; padding: 5px 10px; display: inline-block; line-height: 10px; border-radius: 10px; color: #fff;">

								  Active </div>
								  <?php } ?>
								  </div>								  </td>
                                </tr>

								 <?php $sNo++; } ?>
							</tbody>
						</table>
			
			
			 
			</div>
			
			</div>
			</div>
			 
			
			 
			
			<div class="col-xl-5">
			 
			<div class="card"> 
				<div  style="padding:10px 15px 5px;"> 
						<p class="text-muted font-weight-medium mt-1 mb-2 dashheader">Today's Tours</p>
			</div>
			<div class="card-body"  style="padding:0px 20px 10px;height: 285px; overflow: auto;" >
			
			 
			
			 <table class="table" style="font-size:12px;">

							<thead>
							</thead>

							<tbody>

			 
								
 <?php   
$rs=GetPageRecord('*','flightBookingMaster',' agentBookingType=0 and bookingType=0 and status=2 and journeyDate="'.date('Y-m-d').'" order by id desc'); 
while($rest=mysqli_fetch_array($rs)){  




$ag=GetPageRecord('*','sys_userMaster',' id="'.$rest['agentId'].'" '); 

$agentData=mysqli_fetch_array($ag);

$clientName='';

$clientEmail='';

$clientPhone='';



$clientName=strip($agentData['companyName']);









$ba=GetPageRecord('*','sys_balanceSheet',' bookingId="'.$rest['id'].'" and bookingType="flight" '); 



 


$ag=GetPageRecord('*','clientMaster',' id="'.$rest['clientId'].'" '); 

$clientData=mysqli_fetch_array($ag);



if($agentData['isAgent']==0){

$clientName= ($clientData['name']);

}

$clientEmail= ($agentData['email']);

$clientPhone= ($agentData['phone']);
$i=1;
?> 

								<tr  onclick="loadpop('View Ticket',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewTicket&id=<?php echo encode($rest['id']); ?>" style="cursor:pointer;">

								  <td align="left" valign="top"><a  style="cursor:pointer;"><i class="fa fa-plane" aria-hidden="true"></i> <strong>Flight</strong>
								    <br />
								    <strong>ID:</strong> <?php echo encode($rest['id']); ?></a>
								  </td>

								  <td align="left" valign="top"><strong>From:</strong> <?php $arr = explode('-',$rest['source']); echo $arr[1]; ?><br />

<strong>To:</strong> <?php $arr2 = explode('-',$rest['destination']); echo $arr2[1]; ?> </td>

                                  <td align="center" valign="top"><div align="left"><i class="fa fa-plane" aria-hidden="true"></i> <strong><?php echo stripslashes($rest['flightName']); ?>&nbsp;(<?php echo stripslashes($rest['flightNo']); ?>)<br>

                                    </span>

	                              </div>
                                    <div style="color:#CC0000; margin-top:2px;">
                                      <div align="left"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> <?php echo date('d-m-Y', strtotime($rest['journeyDate'])); ?></div>
                                    </div>

	<div style="color:#0066CC; margin-top:2px;">
	  <div align="left">
	    <?php if($rest['tripType']==1){ echo 'Oneway'; } else { echo 'Round Trip'; } ?> 
	    </div>
	</div>	</td>
                                  <td align="center" valign="top"><?php if($agentData['websiteUser']==1){ ?><div style="padding:2px 5px; font-size:10px; text-transform: uppercase; background-color:#0066CC; color:#fff;display: inline-block; border-radius: 5px;">Client</div><?php } else { ?><div style="padding:2px 5px; font-size:10px; text-transform: uppercase; background-color:#000; color:#fff;display: inline-block; border-radius: 5px;">Agent</div><?php } ?><br />


	<span style="font-size:12px; margin-top:2px; color:#000000; font-weight:500;"><a href="display.html?ga=agents_user&id=<?php echo encode($rest['agentId']); ?>" target="_blank"><?php echo $clientName; ?></a></span>
	<?php  if($agentData['websiteUser']==0){  ?>


	<i class="fa fa-external-link" aria-hidden="true" onclick="loadpop('<?php echo strip($agentData['companyName']); ?> Details',this,'400px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewAgentDetails&id=<?php echo encode($rest['agentId']); ?>" style="cursor:pointer;"></i>

	<?php } else { ?>
<strong><?php echo strip($agentData['name']); ?> <?php echo strip($agentData['lastName']); ?></strong>
	<?php } ?>
 

	 	

	

	 </td>
                                </tr>

								 <?php  } ?>
								 
								 <?php   
$rs=GetPageRecord('*','hotelBookingMaster','  1   and status=2 and CheckIn="'.date('Y-m-d').'" order by id desc'); 
while($rest=mysqli_fetch_array($rs)){  


$clientName='';
$clientEmail='';
$clientPhone='';

$ag=GetPageRecord('*','sys_userMaster',' id="'.$rest['agentId'].'" '); 
$agentData=mysqli_fetch_array($ag);

$clientEmail= ($agentData['email']);
$clientPhone= ($agentData['phone']);



$clientName=strip($agentData['companyName']);

 
$ag=GetPageRecord('*','clientMaster',' id="'.$rest['clientId'].'" '); 
$clientData=mysqli_fetch_array($ag);

 

if($agentData['isAgent']==0){
$clientName= ($clientData['name']);
$clientEmail= ($clientData['email']);
$clientPhone= ($clientData['phone']);
}

$i=1;
 
?> 

								<tr  onclick="loadpop('View Hotel Voucher',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewHotelVoucher&id=<?php echo encode($rest['id']); ?>&page=<?php echo $_REQUEST['ga']; ?>" style="cursor:pointer;">

								  <td align="left" valign="top"><a  style="cursor:pointer;"><i class="fa fa-plane" aria-hidden="true"></i> <strong>Hotel</strong>
								    <br />
								    <strong>ID:</strong> <?php echo encode($rest['id']); ?></a>
								  </td>
								  
<td align="left" valign="top"><strong>Room Type:</strong><div><?php echo stripslashes($rest['RoomType']); ?></div></td>
								  <td align="left" valign="top">
								  
								  <div>
								  <?php for($i=1; $i<=$rest['Rating']; $i++){ ?>
						  						 <i class="fa fa-star" aria-hidden="true" style="font-size:12px; color: #ffbc00;"></i>
												 <?php } ?>
								  </div>  
								  
								  			  <strong><?php echo stripslashes($rest['HotelName']); ?></strong> 
												  City: <strong><?php echo stripslashes($rest['Destination']); ?></strong>
												  <div style="width:130px;"><strong>Checkin: </strong><?php echo date('d-m-Y', strtotime($rest['CheckIn'])); ?><br />
<strong>Checkout: </strong><?php echo date('d-m-Y', strtotime($rest['CheckOutDate'])); ?></div>
								  
							      </td>

                                  
                                  <td align="center" valign="top"><?php if($agentData['websiteUser']==1){ ?>
                                    <div style="padding:2px 5px; font-size:10px; text-transform: uppercase; background-color:#0066CC; color:#fff;display: inline-block; border-radius: 5px;">Client</div><?php } else { ?><div style="padding:2px 5px; font-size:10px; text-transform: uppercase; background-color:#000; color:#fff;display: inline-block; border-radius: 5px;">Agent</div><?php } ?><br />


	<span style="font-size:12px; margin-top:2px; color:#000000; font-weight:500;"><a href="display.html?ga=agents_user&id=<?php echo encode($rest['agentId']); ?>" target="_blank"><?php echo $clientName; ?></a></span>
	<?php  if($agentData['websiteUser']==0){  ?>


	<i class="fa fa-external-link" aria-hidden="true" onclick="loadpop('<?php echo strip($agentData['companyName']); ?> Details',this,'400px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewAgentDetails&id=<?php echo encode($rest['agentId']); ?>" style="cursor:pointer;"></i>

	<?php } else { ?>
<strong><?php echo strip($agentData['name']); ?> <?php echo strip($agentData['lastName']); ?></strong>
	<?php } ?>	 </td>
                                </tr>

								 <?php  } ?>
								  
							</tbody>
			  </table>
			<?php if($i!=1){ ?>
			<div style="text-align:center; font-size:14px; padding-top:100px;">No tours for today</div>
			<?php } ?>
			 
			</div>
			
			</div>
			</div>
		</div>	
         <!-- end container-fluid -->
      </div>
	    	  
<script>
if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
$('.container-fluid').removeAttr('style');
}
</script>

 