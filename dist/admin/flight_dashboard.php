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
 	<div class="col-xl-3">
			<div class="card" style="overflow: hidden;">
			<div class="card-body" style="text-align:center; background-color:#46cd93; color:#fff;">
		<h2><strong>
				<?php
				$a=GetPageRecord('count(id) as totalflight','flightBookingMaster',' status=2'); 
				$gettotal=mysqli_fetch_array($a); 
				echo $gettotal['totalflight'];
				?>
		
		</strong></h2>
		
		<div style="text-align:center; font-size:14px;"> Confirmed Flights</div>
			</div>
			</div>
			</div>
			<div class="col-xl-3">
			<div class="card"  style="overflow: hidden;">
			<div class="card-body" style="text-align:center; background-color:#f9392f; color:#fff;">
		<h2><strong><?php
				$a=GetPageRecord('count(id) as totalflight','flightBookingMaster',' status=3 or status=4'); 
				$gettotal=mysqli_fetch_array($a); 
				echo $gettotal['totalflight'];
				?></strong></h2>
		
		<div style="text-align:center; font-size:14px;"> Canceled Flights</div>
			</div>
			</div>
			</div>
			<div class="col-xl-3" >
			<div class="card"  style="overflow: hidden;">
			<div class="card-body" style="text-align:center; background-color:#FF6600; color:#fff;">
		<h2><strong><?php
				$a=GetPageRecord('count(id) as totalflight','flightBookingMaster',' status=1 or status=0'); 
				$gettotal=mysqli_fetch_array($a); 
				echo $gettotal['totalflight'];
				?></strong></h2>
		
		<div style="text-align:center; font-size:14px;"> Pending Flights </div>
			</div>
			</div>
			</div>
			 
			 
			<div class="col-xl-3">
			<div class="card"  style="overflow: hidden;">
			<div class="card-body" style="text-align:center;background-color:#088682; color:#fff;">
		<h2><strong><?php
				$a=GetPageRecord('count(id) as totalflight','flightBookingMaster',' 1'); 
				$gettotal=mysqli_fetch_array($a); 
				echo $gettotal['totalflight'];
				?></strong></h2>
		
		<div style="text-align:center; font-size:14px;"> Total Bookings </div>
			</div>
			</div>
			</div>
			<div class="col-xl-4">
			
			<div class="card"> 
			 
			<div class="card-body"  >
	 <p class="text-muted font-weight-medium mt-1 mb-2 dashheader">Confirmed flight bookings in <?php echo date('Y'); ?></p>
		
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
  value: <?php echo countlisting('id','flightBookingMaster',' where 1  and MONTH(bookingDate)='.date("m", strtotime("$iM/12/10")).' and YEAR(bookingDate)='.date('Y').' and status=2'); ?>
},<?php  $i++; } ?> ];

xAxis.data.setAll(data);
series.data.setAll(data);


// Make stuff animate on load
// https://www.amcharts.com/docs/v5/concepts/animations/
series.appear(1000);
chart.appear(1000, 100);

}); // end am5.ready()
		 
		  
</script>

<!-- HTML -->
<div id="chartdiv" style="height:290px; width:100%;"></div>
			</div>
			</div>
			</div>
			
			
			
			
			
			<div class="col-xl-4">
			
			<div class="card">  
			<div class="card-body"  >
			
			 <p class="text-muted font-weight-medium mt-1 mb-2 dashheader">Airline market share</p>
			<script>
am5.ready(function() {

// Create root element
// https://www.amcharts.com/docs/v5/getting-started/#Root_element
var root = am5.Root.new("chartdiv2");


// Set themes
// https://www.amcharts.com/docs/v5/concepts/themes/
root.setThemes([
  am5themes_Animated.new(root)
]);


// Create chart
// https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
var chart = root.container.children.push(am5percent.PieChart.new(root, {
  layout: root.verticalLayout
}));


// Create series
// https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
var series = chart.series.push(am5percent.PieSeries.new(root, {
  valueField: "value",
  categoryField: "category"
}));


// Set data
// https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
series.data.setAll([
 <?php  
$rs=GetPageRecord('*','flightBookingMaster','  1  and status=2 group by flightName');
while($rest=mysqli_fetch_array($rs)){ 

$a=GetPageRecord('count(id) as totalflights','flightBookingMaster','  1  and status=2 and flightName="'.$rest['flightName'].'"');
$restflights=mysqli_fetch_array($a);
?> 
  { value: <?php echo $restflights['totalflights']; ?>, category: "<?php echo $rest['flightName']; ?>" }, 
  <?php } ?>
]);


// Play initial series animation
// https://www.amcharts.com/docs/v5/concepts/animations/#Animation_of_series
series.appear(1000, 100);

}); // end am5.ready()
</script>
			
			<div id="chartdiv2" style="height:290px; width:100%;"></div>
			</div>
			
			
			</div>
			</div>
			
			<div class="col-xl-4">
			
			<div class="card">  
			<div class="card-body"  >
			<p class="text-muted font-weight-medium mt-1 mb-2 dashheader">Top flight destinations</p>
			
			<script>
am5.ready(function() {

// Create root element
// https://www.amcharts.com/docs/v5/getting-started/#Root_element
var root = am5.Root.new("chartdiv3");


// Set themes
// https://www.amcharts.com/docs/v5/concepts/themes/
root.setThemes([am5themes_Animated.new(root)]);


// Create chart
// https://www.amcharts.com/docs/v5/charts/xy-chart/
var chart = root.container.children.push(
  am5xy.XYChart.new(root, {
    panX: false,
    panY: false,
    wheelX: "none",
    wheelY: "none"
  })
);


// Create axes
// https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
var yRenderer = am5xy.AxisRendererY.new(root, { minGridDistance: 30 });

var yAxis = chart.yAxes.push(
  am5xy.CategoryAxis.new(root, {
    maxDeviation: 0,
    categoryField: "country",
    renderer: yRenderer
  })
);

var xAxis = chart.xAxes.push(
  am5xy.ValueAxis.new(root, {
    maxDeviation: 0,
    min: 0,
    renderer: am5xy.AxisRendererX.new(root, {})
  })
);


// Create series
// https://www.amcharts.com/docs/v5/charts/xy-chart/series/
var series = chart.series.push(
  am5xy.ColumnSeries.new(root, {
    name: "Series 1",
    xAxis: xAxis,
    yAxis: yAxis,
    valueXField: "value",
    sequencedInterpolation: true,
    categoryYField: "country"
  })
);

var columnTemplate = series.columns.template;

columnTemplate.setAll({
  draggable: true,
  cursorOverStyle: "pointer",
  tooltipText: "drag to rearrange",
  cornerRadiusBR: 10,
  cornerRadiusTR: 10
});
columnTemplate.adapters.add("fill", (fill, target) => {
  return chart.get("colors").getIndex(series.columns.indexOf(target));
});

columnTemplate.adapters.add("stroke", (stroke, target) => {
  return chart.get("colors").getIndex(series.columns.indexOf(target));
});

columnTemplate.events.on("dragstop", () => {
  sortCategoryAxis();
});

// Get series item by category
function getSeriesItem(category) {
  for (var i = 0; i < series.dataItems.length; i++) {
    var dataItem = series.dataItems[i];
    if (dataItem.get("categoryY") == category) {
      return dataItem;
    }
  }
}


// Axis sorting
function sortCategoryAxis() {
  // Sort by value
  series.dataItems.sort(function (x, y) {
    return y.get("graphics").y() - x.get("graphics").y();
  });

  var easing = am5.ease.out(am5.ease.cubic);

  // Go through each axis item
  am5.array.each(yAxis.dataItems, function (dataItem) {
    // get corresponding series item
    var seriesDataItem = getSeriesItem(dataItem.get("category"));

    if (seriesDataItem) {
      // get index of series data item
      var index = series.dataItems.indexOf(seriesDataItem);

      var column = seriesDataItem.get("graphics");

      // position after sorting
      var fy =
        yRenderer.positionToCoordinate(yAxis.indexToPosition(index)) -
        column.height() / 2;

      // set index to be the same as series data item index
      if (index != dataItem.get("index")) {
        dataItem.set("index", index);

        // current position
        var x = column.x();
        var y = column.y();

        column.set("dy", -(fy - y));
        column.set("dx", x);

        column.animate({ key: "dy", to: 0, duration: 600, easing: easing });
        column.animate({ key: "dx", to: 0, duration: 600, easing: easing });
      } else {
        column.animate({ key: "y", to: fy, duration: 600, easing: easing });
        column.animate({ key: "x", to: 0, duration: 600, easing: easing });
      }
    }
  });

  // Sort axis items by index.
  // This changes the order instantly, but as dx and dy is set and animated,
  // they keep in the same places and then animate to true positions.
  yAxis.dataItems.sort(function (x, y) {
    return x.get("index") - y.get("index");
  });
}

// Set data
var data = [
 <?php  
$rs=GetPageRecord('count(id) as totalflightscount, destination','flightBookingMaster','  1  and status=2 group by destination order by totalflightscount desc limit 0,5');
while($rest=mysqli_fetch_array($rs)){ 

 
?> 
{
  country: "<?php echo $rest['destination']; ?> (<?php echo $rest['totalflightscount']; ?>)",
  value: <?php echo $rest['totalflightscount']; ?>
},
<?php } ?>
];

yAxis.data.setAll(data);
series.data.setAll(data);


// Make stuff animate on load
// https://www.amcharts.com/docs/v5/concepts/animations/
series.appear(1000);
chart.appear(1000, 100);

}); // end am5.ready()
</script>
			
			<div id="chartdiv3" style="height:290px; width:100%;"></div>
			</div>
			
			
			</div>
			</div>
			
			
			
			<div class="col-xl-4">
			
			<div class="card"> 
				<div  style="padding:10px 15px 0px;">
						<p class="text-muted font-weight-medium mt-1 mb-0 dashheader">Top flignt booking agents</p>
			</div>
			<div class="card-body" style="overflow:auto;"  > 
			
			<div style="height:290px; width:100%; ">
			<table width="100%" class="table" >
  <thead>
    <th colspan="2" align="left" bgcolor="#F3F3F3"><strong>Agent</strong></th>
    <th width="20%" align="center" bgcolor="#F3F3F3"><strong>Bookings </strong></th>
    <th width="20%" align="right" bgcolor="#F3F3F3"><div align="right"><strong>Amount</strong></div></th>
    <?php  
$rs=GetPageRecord('*','flightBookingMaster','  1  and status=2 group by agentId limit 0,10');
while($rest=mysqli_fetch_array($rs)){  
$c=GetPageRecord('companyName','sys_userMaster','   id="'.$rest['agentId'].'"');
$agentsdata=mysqli_fetch_array($c);

$a=GetPageRecord('count(id) as totalflights','flightBookingMaster','   agentId="'.$rest['agentId'].'" and status=2');
$restflights=mysqli_fetch_array($a);

$ad=GetPageRecord('SUM(agentTotalFare) as totalagentcost','flightBookingMaster','   agentId="'.$rest['agentId'].'" and status=2');
$restflightsamount=mysqli_fetch_array($ad);
?>
  
  <tr>
    <td colspan="2" align="left"><?php echo stripslashes($agentsdata['companyName']); ?></td>
    <td width="20%" align="center"><?php echo stripslashes($restflights['totalflights']); ?></td>
    <td width="20%" align="right"><div align="right">&#8377;<?php echo round($restflightsamount['totalagentcost']); ?></div></td>
    </tr>
  <?php } ?>
</table>

			</div>
			</div>
			
			
			</div>
			</div>
			
			
			
			
			
			
			
			<div class="col-xl-4">
			
			<div class="card"> 
			 
			<div class="card-body"  >
			
			<p class="text-muted font-weight-medium mt-1 mb-2 dashheader">New registered flight  suppliers</p>
			 
			
			<div   style="height:290px; width:100%; overflow:auto;">
			<table class="table">
							<thead>
								<tr>
								  <th>Company</th>
									<th>Location</th>
									<th>Status</th>
									<th align="left">Register</th>
								</tr>
							</thead>
							<tbody>
								<?php 
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 

$search='';
 
 

 $targetpage='display.html?ga='.$_REQUEST['ga'].'&fromdate='.$_REQUEST['fromdate'].'&todate='.$_REQUEST['todate'].'&keyword='.$_REQUEST['keyword'].'&'; 
$rs=GetRecordList('*','sys_userMaster',' where flightManagement=1 and userType="suppliers"   order by id asc  ','100',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 

?>
								
								<tr>
								  <td align="left" valign="top"><a href="display.html?ga=suppliers&id=<?php echo encode($rest['id']); ?>&add=1"><strong><?php echo stripslashes($rest['companyName']); ?></strong></a><br />
<?php echo stripslashes($rest['name']); ?></td>
									<td align="left" valign="top"><?php echo  ($rest['city']); ?>, <?php echo  ($rest['state']); ?>, <?php echo  ($rest['country']); ?></td>
									<td align="left" valign="top"><?php if($rest['status']==0){ ?>
								  <div style="background-color: #ff0000; font-weight: 700; padding: 5px 10px; display: inline-block; line-height: 10px; border-radius: 10px; color: #fff;">

								  Deactive </div>
								  <?php } else { ?>
								  <div style="background-color: #1f8513; font-weight: 700; padding: 5px 10px; display: inline-block; line-height: 10px; border-radius: 10px; color: #fff;">

								  Active </div>
								  <?php } ?></td>
									<td align="left" valign="top"><?php echo date('d-m-Y',strtotime($rest['dateAdded'])); ?></td>
								</tr>
								 <?php $sNo++; } ?>
							</tbody>
						</table>
			<?php if($sNo==1){ ?>
			<div style="text-align:center; padding:30px;">No  Supplier</div>
			<?php } ?>
			
			</div>
			</div>
			
			
			</div>
			</div>
			
			
			
			<div class="col-xl-4">
			
			<div class="card"> 
			 
			<div class="card-body"  >
						<p class="text-muted font-weight-medium mt-1 mb-2 dashheader">Top flight source</p>
			
			<script>
am5.ready(function() {

// Create root element
// https://www.amcharts.com/docs/v5/getting-started/#Root_element
var root = am5.Root.new("chartdiv5");


// Set themes
// https://www.amcharts.com/docs/v5/concepts/themes/
root.setThemes([am5themes_Animated.new(root)]);


// Create chart
// https://www.amcharts.com/docs/v5/charts/xy-chart/
var chart = root.container.children.push(
  am5xy.XYChart.new(root, {
    panX: false,
    panY: false,
    wheelX: "none",
    wheelY: "none"
  })
);


// Create axes
// https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
var yRenderer = am5xy.AxisRendererY.new(root, { minGridDistance: 30 });

var yAxis = chart.yAxes.push(
  am5xy.CategoryAxis.new(root, {
    maxDeviation: 0,
    categoryField: "country",
    renderer: yRenderer
  })
);

var xAxis = chart.xAxes.push(
  am5xy.ValueAxis.new(root, {
    maxDeviation: 0,
    min: 0,
    renderer: am5xy.AxisRendererX.new(root, {})
  })
);


// Create series
// https://www.amcharts.com/docs/v5/charts/xy-chart/series/
var series = chart.series.push(
  am5xy.ColumnSeries.new(root, {
    name: "Series 1",
    xAxis: xAxis,
    yAxis: yAxis,
    valueXField: "value",
    sequencedInterpolation: true,
    categoryYField: "country"
  })
);

var columnTemplate = series.columns.template;

columnTemplate.setAll({
  draggable: true,
  cursorOverStyle: "pointer",
  tooltipText: "drag to rearrange",
  cornerRadiusBR: 10,
  cornerRadiusTR: 10
});
columnTemplate.adapters.add("fill", (fill, target) => {
  return chart.get("colors").getIndex(series.columns.indexOf(target));
});

columnTemplate.adapters.add("stroke", (stroke, target) => {
  return chart.get("colors").getIndex(series.columns.indexOf(target));
});

columnTemplate.events.on("dragstop", () => {
  sortCategoryAxis();
});

// Get series item by category
function getSeriesItem(category) {
  for (var i = 0; i < series.dataItems.length; i++) {
    var dataItem = series.dataItems[i];
    if (dataItem.get("categoryY") == category) {
      return dataItem;
    }
  }
}


// Axis sorting
function sortCategoryAxis() {
  // Sort by value
  series.dataItems.sort(function (x, y) {
    return y.get("graphics").y() - x.get("graphics").y();
  });

  var easing = am5.ease.out(am5.ease.cubic);

  // Go through each axis item
  am5.array.each(yAxis.dataItems, function (dataItem) {
    // get corresponding series item
    var seriesDataItem = getSeriesItem(dataItem.get("category"));

    if (seriesDataItem) {
      // get index of series data item
      var index = series.dataItems.indexOf(seriesDataItem);

      var column = seriesDataItem.get("graphics");

      // position after sorting
      var fy =
        yRenderer.positionToCoordinate(yAxis.indexToPosition(index)) -
        column.height() / 2;

      // set index to be the same as series data item index
      if (index != dataItem.get("index")) {
        dataItem.set("index", index);

        // current position
        var x = column.x();
        var y = column.y();

        column.set("dy", -(fy - y));
        column.set("dx", x);

        column.animate({ key: "dy", to: 0, duration: 600, easing: easing });
        column.animate({ key: "dx", to: 0, duration: 600, easing: easing });
      } else {
        column.animate({ key: "y", to: fy, duration: 600, easing: easing });
        column.animate({ key: "x", to: 0, duration: 600, easing: easing });
      }
    }
  });

  // Sort axis items by index.
  // This changes the order instantly, but as dx and dy is set and animated,
  // they keep in the same places and then animate to true positions.
  yAxis.dataItems.sort(function (x, y) {
    return x.get("index") - y.get("index");
  });
}

// Set data
var data = [
 <?php  
$rs=GetPageRecord('count(id) as totalflightscount, source','flightBookingMaster','  1  and status=2 group by source order by totalflightscount desc limit 0,5');
while($rest=mysqli_fetch_array($rs)){ 

 
?> 
{
  country: "<?php echo $rest['source']; ?> (<?php echo $rest['totalflightscount']; ?>)",
  value: <?php echo $rest['totalflightscount']; ?>
},
<?php } ?>
];

yAxis.data.setAll(data);
series.data.setAll(data);


// Make stuff animate on load
// https://www.amcharts.com/docs/v5/concepts/animations/
series.appear(1000);
chart.appear(1000, 100);

}); // end am5.ready()
</script>
			
			<div id="chartdiv5" style="height:290px; width:100%;"></div>
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

 