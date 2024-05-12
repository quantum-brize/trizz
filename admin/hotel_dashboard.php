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
			<div class="row">
			
			<div class="col-xl-4">
			
			<div class="card" style="overflow:hidden; background-color:#2c786e; color:#FFFFFF;">
			<div class="card-body" style="text-align:center; font-size:36px; padding:50px 0px;">
			 <?php
				 $wheretotalhotel=' and DATE(addDate)="'.date('Y-m-d').'"'; 
				 
				$a=GetPageRecord('count(id) as totalhotelbookings','hotelBookingMaster',' 1 '.$wheretotalhotel.' and status!=0 '); 
				$gettotal=mysqli_fetch_array($a); 
				echo $gettotal['totalhotelbookings'];
				?>
				 <div class="text" style="font-size:14px;">New bookings</div>
			</div>
			
			</div>
			
			</div>
			
			<div class="col-xl-4">
			
			<div class="card" style="overflow:hidden; background-color:#63905f; color:#FFFFFF;">
			<div class="card-body" style="text-align:center; font-size:36px; padding:50px 0px;">
			<?php 
				 
				$a=GetPageRecord('count(id) as totalhotelbookings','hotelBookingMaster',' 1 and CheckIn<="'.date('Y-m-d').'" and CheckOutDate>="'.date('Y-m-d').'" and status=2 '); 
				$gettotal=mysqli_fetch_array($a); 
				echo $gettotal['totalhotelbookings'];
				?>
				 <div class="text" style="font-size:14px;">In-house</div>
			</div>
			
			</div>
			
			</div>
			
			<div class="col-xl-4">
			
			<div class="card" style="overflow:hidden; background-color:#a8803f; color:#FFFFFF;">
			<div class="card-body" style="text-align:center; font-size:36px; padding:50px 0px;">
			  <?php  
				$a=GetPageRecord('count(id) as totalhotelbookings','hotelBookingMaster',' 1 and   CheckOutDate>"'.date('Y-m-d').'" and status=2 '); 
				$gettotal=mysqli_fetch_array($a); 
				echo $gettotal['totalhotelbookings'];
				?>
				 <div class="text" style="font-size:14px;">Arrivals</div>
			</div>
			
			</div>
			
			</div>
			
			
			
			<div class="col-xl-4">
			
			<div class="card" style="overflow:hidden; background-color:#6b7aa1; color:#FFFFFF;">
			<div class="card-body" style="text-align:center; font-size:36px; padding:50px 0px;">
			  <?php  
				$a=GetPageRecord('count(id) as totalhotelbookings','hotelBookingMaster',' 1  and CheckOutDate="'.date('Y-m-d').'" and status=2 '); 
				$gettotal=mysqli_fetch_array($a); 
				echo $gettotal['totalhotelbookings'];
				?>
				 <div class="text" style="font-size:14px;">Departures</div>
			</div>
			
			</div>
			
			</div>
			
			
			<div class="col-xl-4">
			
			<div class="card" style="overflow:hidden; background-color:#c15a5a; color:#FFFFFF;">
			<div class="card-body" style="text-align:center; font-size:36px; padding:50px 0px;">
			<?php  
				$a=GetPageRecord('count(id) as totalhotelbookings','hotelBookingMaster',' 1   and status=3 '); 
				$gettotal=mysqli_fetch_array($a); 
				echo $gettotal['totalhotelbookings'];
				?>
				 <div class="text" style="font-size:14px;">Cancellations</div>
			</div>
			
			</div>
			
			</div>
			
			<div class="col-xl-4">
			
			<div class="card" style="overflow:hidden; background-color:#a22138; color:#FFFFFF;">
			<div class="card-body" style="text-align:center; font-size:36px; padding:50px 0px;">
			  	<?php  
				$a=GetPageRecord('count(id) as totalhotelbookings','hotelBookingMaster',' 1   and status=4 '); 
				$gettotal=mysqli_fetch_array($a); 
				echo $gettotal['totalhotelbookings'];
				?>
				 <div class="text" style="font-size:14px;">Rejected</div>
			</div>
			
			</div>
			
			</div>
			
			</div>
			 
			</div>
			
			
			
			
			
			<div class="col-xl-6">
			
			<div class="card"> 
			 
			<div class="card-body"  >
			 <p class="text-muted font-weight-medium mt-1 mb-2 dashheader">New Registered Properties</p>
			
			 
			
			<div id="chartdiv2" style="height:324px; width:100%; overflow:auto;">
			
			<table class="table">
							<thead>
								<tr>
									<th width="30%">Name</th>
									<th>Type</th>
									<th>Destination</th>
									<th>Status</th>
								<th>	<?php if($_SESSION['userid']==1){ ?>Supplier<?php } else { ?>Last Update<?php } ?></th> 
								</tr>
							</thead>
							<tbody>
							
							<?php 
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 

 

$search.='';


$whereuser='';

if($_SESSION['userid']==1){
$whereuser=' ';
} else { 
$whereuser='and addBy="'.$_SESSION['userid'].'"'; 
}
 
$targetpage='display.html?ga='.$_REQUEST['ga'].'&keyword='.$_REQUEST['keyword'].'&destination='.$_REQUEST['destination'].'&'; 
$rs=GetRecordList('*','hotelMaster',' where 1   order by id desc  ','25',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 


$rs7=GetPageRecord('*','sys_userMaster',' id="'.$rest['addedBy'].'"'); 
$agentData=mysqli_fetch_array($rs7);
 
?>	<style>
									.roomratelist{ margin-bottom:5px; }
									</style>
								<tr>
<td width="30%" onclick="loadpop('Edit Hotel',this,'800px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addhotellibrary&id=<?php echo encode($rest['id']); ?>" style="cursor:pointer;"><div style="font-weight:500;"><?php echo stripslashes($rest['name']); ?></div>

 

<div style="margin-top:1px; font-weight:12px; font-weight:400;display:none;"><?php echo gethotelcategorytype($rest['category']); ?></div>									</td>
<td><span class="badge bg-dark" style="background-color:#0cb5b5; color:#FFFFFF;"><?php echo stripslashes($rest['hotelType']); ?></span></td>
<td><?php echo getCityName($rest['destination']); ?></td>
								
									<td onclick="loadpop('Edit Hotel',this,'800px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addhotellibrary&id=<?php echo encode($rest['id']); ?>" style="cursor:pointer; color:#FFFFFF;"><div align="left"><?php if($rest['status']==1){ ?><span class="badge bg-blue" style="background-color:#0cb5b5;">Active</span><?php } else { ?><span class="badge bg-blue" style="background-color:#f9392f;">In-Active</span><?php } ?></div></td>
									<td><?php if($_SESSION['userid']==1){ ?><?php echo strip($agentData['companyName']); } ?>
									<div style="font-size:10px; color:#666666;"><?php echo date('d-m-Y h:i A',strtotime($rest['dateAdded'])); ?></div></td>
								</tr> 
								
								<?php } ?>
						</table>
			
			
			</div>
			</div>
			
			
			</div>
			</div>
			
			 
			
			<div class="col-xl-6">
			
			<div class="card"> 
	 
			<div class="card-body"  >
			
			 <p class="text-muted font-weight-medium mt-1 mb-2 dashheader">New registered hotel  suppliers</p>
			 
			
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

 $targetpage='display.html?ga='.$_REQUEST['ga'].'&fromdate='.$_REQUEST['fromdate'].'&todate='.$_REQUEST['todate'].'&keyword='.$_REQUEST['keyword'].'&'; 
$rs=GetRecordList('*','sys_userMaster',' where hotelManagement=1 and  userType="suppliers"  order by id asc  ','100',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 
 
?>
								
								<tr>
								  <td align="left" valign="top"><a href="display.html?ga=suppliers&id=<?php echo encode($rest['id']); ?>&add=1"><strong><?php echo stripslashes($rest['companyName']); ?></strong></a><br />
<?php echo stripslashes($rest['name']); ?></td>
									<td align="left" valign="top"><?php echo ($rest['city']); ?>, <?php echo getStateName($rest['state']); ?>, <?php echo ($rest['country']); ?></td>
									<td align="left" valign="top"><?php echo ($rest['status']); ?></td>
									<td align="left" valign="top"><?php echo date('d-m-Y',strtotime($rest['dateAdded'])); ?></td>
								</tr>
								 <?php $sNo++; } ?>
							</tbody>
						</table>
			<?php if($sNo==1){ ?>
			<div style="text-align:center; padding:30px;">No Supplier </div>
			<?php } ?>
			
			</div>
			</div>
			
			
			</div>
			</div>
			
			 
			
			
			<div class="col-xl-6">
			
			<div class="card"> 
	 
			<div class="card-body"  >
			
			 <p class="text-muted font-weight-medium mt-1 mb-2 dashheader">Recent hotel bookings</p>
			 
			
			<div id="chartdiv5" style="height:290px; width:100%; overflow:auto;">
			
			<table class="table">
							<thead>
								<tr>
								  <th>Booking ID </th>
								  <th>Agent</th>
								  <th>Hotel</th>
									<th>Room Type</th>
									<th align="left">Status</th>
							    </tr>
							</thead>
							<tbody>
								<?php 
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 


$search='';

if($_REQUEST['status']!=''){
$search.=' and status="'.$_REQUEST['status'].'" ';
}

if($_REQUEST['sk']=='1'){
$search.='  and DATE(addDate)="'.date('Y-m-d').'" and status!=0 ';
}
if($_REQUEST['sk']=='2'){
$search.='  and CheckIn<="'.date('Y-m-d').'" and CheckOutDate>="'.date('Y-m-d').'" and status=2 ';
}
if($_REQUEST['sk']=='3'){
$search.='  and    CheckOutDate>"'.date('Y-m-d').'" and status=2 ';
}
if($_REQUEST['sk']=='4'){
$search.='  and CheckOutDate="'.date('Y-m-d').'" and status=2  ';
}
if($_REQUEST['sk']=='5'){
$search.='   and status=3 ';
}
if($_REQUEST['sk']=='6'){
$search.='   and status=4 ';
}

if($_REQUEST['fromdate']!='' && $_REQUEST['todate']!=''){
$search.=' and  DATE(CheckIn)>="'.date('Y-m-d',strtotime($_REQUEST['fromdate'])).'" and  DATE(CheckIn)<="'.date('Y-m-d',strtotime($_REQUEST['todate'])).'" ';
}


if($_REQUEST['keyword']!=''){
$search.=' and  (Destination like "%'.$_REQUEST['keyword'].'%" or  HotelName like "%'.$_REQUEST['keyword'].'%" or  HotelCode like "%'.$_REQUEST['keyword'].'%" or RoomType like "%'.$_REQUEST['keyword'].'%" or agentId in (select id from sys_userMaster where companyName like "%'.$_REQUEST['keyword'].'%" ) ) ) ';
}
 
 $targetpage='display.html?ga='.$_REQUEST['ga'].'&status='.$_REQUEST['status'].'&fromdate='.$_REQUEST['fromdate'].'&todate='.$_REQUEST['todate'].'&keyword='.$_REQUEST['keyword'].'&sk='.$_REQUEST['sk'].'&';
  
$rs=GetRecordList('*','hotelBookingMaster',' where 1 and status>0  '.$search.' order by id desc  ','25',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 
 

$ag=GetPageRecord('COUNT(id) as totaladult','hotelBookingPaxDetailMaster',' BookingNumber="'.$rest['BookingNumber'].'" and paxType="adult" '); 
$totalbookungpax_adult=mysqli_fetch_array($ag);


$ag=GetPageRecord('COUNT(id) as totalchild','hotelBookingPaxDetailMaster',' BookingNumber="'.$rest['BookingNumber'].'" and paxType="child" '); 
$totalbookungpax_child=mysqli_fetch_array($ag);
 
$ag=GetPageRecord('roomNo','hotelBookingPaxDetailMaster',' BookingNumber="'.$rest['BookingNumber'].'"  order by roomNo desc '); 
$totalbookungpax_room=mysqli_fetch_array($ag);


$clientName='';
$clientEmail='';
$clientPhone='';

$ag=GetPageRecord('*','sys_userMaster',' id="'.$rest['agentId'].'" '); 
$agentData=mysqli_fetch_array($ag);

$clientEmail= ($agentData['email']);
$clientPhone= ($agentData['phone']);



$clientName=strip($agentData['companyName']);

 
$ag=GetPageRecord('*','userMaster',' id="'.$rest['clientId'].'" '); 
$clientData=mysqli_fetch_array($ag);

 

if($agentData['userType']==4){
$clientName= ($clientData['name']);
$clientEmail= ($clientData['email']);
$clientPhone= ($clientData['phone']);
}



?>
								
								<tr>
								  <td align="left" valign="top">
								  <strong><?php echo $rest['BookingNumber']; ?></strong>
								  <div style="font-size:11px; color:#666666;">Ref. <?php echo encode($rest['id']); ?></div>
								  <div style="width:140px; font-size:11px;"><?php echo date('d-m-Y h:i A', strtotime($rest['addDate'])); ?></div>
								  
								   								  </td>
								  <td><div style="font-size:13px; line-height: 16px; margin-bottom:3px;white-space: nowrap; max-width:200px; overflow: hidden; text-overflow: ellipsis;font-weight:600;"> <?php if($agentData['userType']==4){ ?><span class="badge bg-blue">B2C Client</span><?php } else { ?><span class="badge bg-black" style="background-color:#000; color:#FFFFFF;">Agent</span><?php } ?></div>

	

	<span style="font-size:12px; margin-top:2px; color:#000000; font-weight:500;"><a href="display.html?ga=agents_user&id=<?php echo encode($rest['agentId']); ?>" target="_blank"><?php echo $clientName; ?></a></span>&nbsp;
	<?php if($agentData['isAgent']==1){ ?>
	<i class="fa fa-external-link" aria-hidden="true" onclick="loadpop('<?php echo strip($agentData['companyName']); ?> Details',this,'400px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewAgentDetails&id=<?php echo encode($rest['agentId']); ?>" style="cursor:pointer;"></i>
	<?php } ?>
	
	 
	 	</td>
								  <td align="left" valign="top"><div class="green-lighter" >
								  				<div>
								  				<?php for($i=1; $i<=$rest['Rating']; $i++){ ?>
						  						 <i class="fa fa-star" aria-hidden="true" style="font-size:12px; color: #ffbc00;"></i>
												 <?php } ?></div>  
												  <strong><?php echo stripslashes($rest['HotelName']); ?></strong></div>
												  City: <strong><?php echo stripslashes($rest['Destination']); ?></strong>
												  <div style="width:130px;"><strong>Checkin: </strong><?php echo date('d-m-Y', strtotime($rest['CheckIn'])); ?><br />
<strong>Checkout: </strong><?php echo date('d-m-Y', strtotime($rest['CheckOutDate'])); ?></div>												  </td>
									<td align="left" valign="top"><div><?php echo stripslashes($rest['RoomType']); ?> (<?php echo  stripslashes($totalbookungpax_room['roomNo']); ?>)</div></td>
									<td align="left" valign="top" style="color:#FFFFFF;">
									
									
									<?php if($rest['hotelRequest']==1 && $rest['status']!=2){ ?>
									<span class="badge bg-blue" style="background-color:#0091ff;">On&nbsp;Request</span>
									<div style="text-align:center; font-size:11px; color:#FF0000; margin-top:5px;">UNPAID</div>
								 
									<?php } else { ?>
									<?php if($rest['status']==1){ ?><span class="badge bg-blue" style="background-color:#FF6600;">Pending</span><?php } ?>
									<?php if($rest['status']==2){ ?><span class="badge bg-blue" style="background-color:#46cd93;">Confirm</span><?php } ?>
									<?php if($rest['status']==3){ ?><span class="badge bg-blue" style="background-color:#f9392f;">Cancelled</span><?php } ?>
									<?php if($rest['status']==4){ ?><span class="badge bg-blue" style="background-color:#f9392f;">Rejected</span><?php } ?>	
									<?php } ?>																	</td>
							    </tr>
								 <?php $sNo++; } ?>
							</tbody>
						</table>
			
			
			</div>
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

 