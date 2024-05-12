<?php  

 if($_REQUEST['staffselect']!='' && $_REQUEST['qid']!=''){ 
$namevalue ='assignedTo="'.$_REQUEST['staffselect'].'",assignedDate="'.date('Y-m-d H:i:s').'"'; 
$where='id="'.$_REQUEST['qid'].'"';   
updatelisting('hotelBookingMaster',$namevalue,$where);  
 }
 
$selectedmenu=41;
?>

<style>
#searchform input{height: 35px; top: 2px; }
#searchform select{ height: 35px; top: 2px;}
#searchform .col-xl-3{ padding-right: 0px; padding-left: 5px;}
</style>


<div class="wrapper">
<div class="container-fluid">
<div class="main-content">

                <div class="page-content">

      
                    <div class="newboxheading">
                      <div class="newhead">Hotel Bookings 	
								 
								 <div style="float:right; width:60%;" class="searchbox">

			<form method="get" id="searchform" class="newsearchsecform"  style="top: -9px; left: 126px !important; width:40%;">

		<div class="row">

		

		<input name="ga" type="hidden" value="<?php echo $_REQUEST['ga']; ?>" />

		<input name="stage" type="hidden" value="<?php echo $_REQUEST['stage']; ?>" />

		

		<div class="col-xl-3">

			<div class="input-group">

	 	<input type="text" id="fromdate" name="fromdate" class="form-control" placeholder="From Date" value="<?php echo $_REQUEST['fromdate']; ?>"  readonly >

		

			</div>

		  </div>

				

		<div class="col-xl-3">

			<div class="input-group">

	 	<input type="text" id="todate" name="todate" class="form-control" placeholder="To Date"  value="<?php echo $_REQUEST['todate']; ?>" readonly>

		

			</div>

		  </div>

			

			

			<script>

		$( function() {

    $( "#fromdate" ).datepicker({ dateFormat: 'dd-mm-yy' });

    $( "#todate" ).datepicker({ dateFormat: 'dd-mm-yy' });

  } );

  </script>

			 

				

		<div class="col-xl-3">

			<div class="input-group">

			<select   name="status" class="form-control" data-placeholder="Select Status" autocomplete="off">   
				<option value="">Select Status</option>
				<option value="1" <?php if($_REQUEST['status']==1){ ?>selected="selected"<?php } ?>>Pending</option>
				<option value="2" <?php if($_REQUEST['status']==2){ ?>selected="selected"<?php } ?>>Confirm</option>
				<option value="3" <?php if($_REQUEST['status']==3){ ?>selected="selected"<?php } ?>>Cancelled</option>
			</select> 

			</div>

		  </div>

		

		<div class="col-xl-3">

			<div class="input-group">

			<input name="keyword" type="text" class="form-control" id="keyword" placeholder="Enter Keyword" value="<?php echo $_REQUEST['keyword']; ?>"  >

			<span class="input-group-append">

			<button class="btn btn-light bg-primary border-primary text-white" type="submit" style="padding: 5px 10px; top: 2px;"><i class="fa fa-search" aria-hidden="true"></i></button>

			</span>

			</div>

		  </div>
 
				

				

		 	  </div>

		</form>										

	 	  </div>
								 
								 
							 
 <div class="newoptionmenu">

  
 
 									 
 
  
   
 
    									 
										 
     
   
 <div>
<!-- <button type="button" class="btn btn-secondary btn-lg waves-effect waves-light"   onclick="exportData();"  >Export</button> -->						 
 </div>
  
		  

 </div>
 </div>     
 
     
</div>
                    <!-- start page title -->
                     
              
                      <div style="padding-top: 34px;">
					  
					  <div class="card-header header-elements-inline" style="    padding: 0px 8px;">
 
<style>
.counttabs{padding:20px 10px; overflow:hidden;}
.counttabs a{color:#000000;}
.counttabs .box{padding:10px 0px; text-align:center; font-size:30px; font-weight:700; box-shadow: 0 1px 4px rgba(0,0,0,.16); margin:0px 5px; float:left; border-top:10px solid #96c7c1; width:130px;border-radius: 5px;}
.counttabs .active{ background-color:#f1f1f1;}
.counttabs .box .text{font-size:11px; text-transform:uppercase; font-weight:500;}
</style>
						

						<div class="counttabs">
				 <a href="display.html?ga=hotelBookings&sk=1"><div class="box <?php if($_REQUEST['sk']==1){?>active<?php } ?>">
				 <?php
				 $wheretotalhotel=' and DATE(addDate)="'.date('Y-m-d').'"'; 
				 
				$a=GetPageRecord('count(id) as totalhotelbookings','hotelBookingMaster',' 1 '.$wheretotalhotel.' and status!=0 '); 
				$gettotal=mysqli_fetch_array($a); 
				echo $gettotal['totalhotelbookings'];
				?>
				 <div class="text">New bookings</div>
				 </div></a>
				 
				 <a href="display.html?ga=hotelBookings&sk=2"><div class="box <?php if($_REQUEST['sk']==2){?>active<?php } ?>" style="border-top:10px solid #cdf2ca;">
				  <?php 
				 
				$a=GetPageRecord('count(id) as totalhotelbookings','hotelBookingMaster',' 1 and CheckIn<="'.date('Y-m-d').'" and CheckOutDate>="'.date('Y-m-d').'" and status=2 '); 
				$gettotal=mysqli_fetch_array($a); 
				echo $gettotal['totalhotelbookings'];
				?>
				 <div class="text">In-House</div>
				 </div></a>
				 
				 <a href="display.html?ga=hotelBookings&sk=3"><div class="box <?php if($_REQUEST['sk']==3){?>active<?php } ?>" style="border-top:10px solid #f7d59c;">
				 <?php  
				$a=GetPageRecord('count(id) as totalhotelbookings','hotelBookingMaster',' 1 and   CheckOutDate>"'.date('Y-m-d').'" and status=2 '); 
				$gettotal=mysqli_fetch_array($a); 
				echo $gettotal['totalhotelbookings'];
				?>
				 <div class="text">Arrivals</div>
				 </div></a>
				 
				 
				  <a href="display.html?ga=hotelBookings&sk=4"><div class="box <?php if($_REQUEST['sk']==4){?>active<?php } ?>" style="border-top:10px solid #6b7aa1;">
				<?php  
				$a=GetPageRecord('count(id) as totalhotelbookings','hotelBookingMaster',' 1  and CheckOutDate="'.date('Y-m-d').'" and status=2 '); 
				$gettotal=mysqli_fetch_array($a); 
				echo $gettotal['totalhotelbookings'];
				?>
				 <div class="text">Departures</div>
				 </div></a>
				 
				 
				<a href="display.html?ga=hotelBookings&sk=5"> <div class="box <?php if($_REQUEST['sk']==5){?>active<?php } ?>" style="border-top:10px solid #f29191;">
				<?php  
				$a=GetPageRecord('count(id) as totalhotelbookings','hotelBookingMaster',' 1   and status=3 '); 
				$gettotal=mysqli_fetch_array($a); 
				echo $gettotal['totalhotelbookings'];
				?>
				 <div class="text">Cancellations</div>
				 </div></a>
				 
				 <a href="display.html?ga=hotelBookings&sk=6"><div class="box <?php if($_REQUEST['sk']==6){?>active<?php } ?>" style="border-top:10px solid #c54259;">
				<?php  
				$a=GetPageRecord('count(id) as totalhotelbookings','hotelBookingMaster',' 1   and status=4 '); 
				$gettotal=mysqli_fetch_array($a); 
				echo $gettotal['totalhotelbookings'];
				?>
				 <div class="text">Rejected</div>
				 </div></a>
				 
				 </div>
 
			  </div>
					  
                        <div class="col-md-12 col-xl-12" style="padding-left:0px; padding-right:0px;">
						              <div class="">
                            <div class="card-body" style=" background-color:#FFFFFF;"> 
                                     
                                     
							 
                                        <table class="table" style="font-size:13px;">
							<thead>
								<tr>
								  <th>Assign</th>
								  <th>Booking ID </th>
								  <th>Agent</th>
								  <th>Hotel</th>
									<th>Room Type</th>
									<th><div align="left">Amount</div></th>
									<th align="left">Status</th>
								    <th align="left">&nbsp;</th>
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
$search.=' and  (Destination like "%'.$_REQUEST['keyword'].'%" or  HotelName like "%'.$_REQUEST['keyword'].'%" or  HotelCode like "%'.$_REQUEST['keyword'].'%" or RoomType like "%'.$_REQUEST['keyword'].'%"  ) ';
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

 

if($agentData['isAgent']==0){
$clientName= ($clientData['name']);
$clientEmail= ($clientData['email']);
$clientPhone= ($clientData['phone']);
}



?>
								
								<tr>
								  <td>
	
	<?php if($_SESSION['userid']==1 ){ ?>
	
	<form action="" method="get" id="staffselectid<?php echo stripslashes($rest['id']); ?>" name="staffselectid<?php echo stripslashes($rest['id']); ?>">
	<input type="hidden" name="ga" value="<?php echo $_REQUEST['ga']; ?>" />
	<input type="hidden" name="qid" value="<?php echo stripslashes($rest['id']); ?>" />
	<select id="staffselect"  name="staffselect"  class="form-control"  autocomplete="off" onchange="$('#staffselectid<?php echo stripslashes($rest['id']); ?>').submit();"  style="width:100%;">   
	<option value="">Select User</option>   
	<?php  
	$rsA=GetPageRecord('*','sys_userMaster','   userType="1" order by firstName asc');
	while($restUser=mysqli_fetch_array($rsA)){ 
	?>
	<option value="<?php echo $restUser['id']; ?>" <?php if($rest['assignedTo']==$restUser['id']){ ?>selected="selected"<?php } ?>><?php echo stripslashes($restUser['firstName']); ?> <?php echo stripslashes($restUser['lastName']); ?></option>    
	<?php } ?>
	</select>
	</form>
 
	<?php } else { ?>
	
	<?php if($rest['assignedTo']>0){ 
	
	$rsB=GetPageRecord('*','sys_userMaster',' id="'.$rest['assignedTo'].'"');
	$restUserselect=mysqli_fetch_array($rsB); ?>
	
	<strong><?php echo stripslashes($restUserselect['name']); ?></strong>
	
	<div style="font-size:12px;"><?php echo date('d/m/Y h:i A',strtotime($rest['assignedDate'])); ?></div>
	
 <?php  } else { ?>
	
	<form action="" method="get" id="staffselectid<?php echo stripslashes($rest['id']); ?>" name="staffselectid<?php echo stripslashes($rest['id']); ?>">
	<input type="hidden" name="ga" value="<?php echo $_REQUEST['ga']; ?>" />
	<input type="hidden" name="qid" value="<?php echo stripslashes($rest['id']); ?>" />
	<select id="staffselect"  name="staffselect"  class="form-control"  autocomplete="off" onchange="$('#staffselectid<?php echo stripslashes($rest['id']); ?>').submit();"  style="width:100%;">   
	<option value="">Select User</option>   
	<?php  
	$rsA=GetPageRecord('*','sys_userMaster',' id="'.$_SESSION['userid'].'"');
	while($restUser=mysqli_fetch_array($rsA)){ 
	?>
	<option value="<?php echo $restUser['id']; ?>" <?php if($rest['assignedTo']==$restUser['id']){ ?>selected="selected"<?php } ?>><?php echo stripslashes($restUser['firstName']); ?> <?php echo stripslashes($restUser['lastName']); ?></option>    
	<?php } ?>
	</select>
	</form>
	<?php } ?>
	<?php }   ?></td>
								  <td align="left" valign="top">
								  <strong><?php echo $rest['BookingNumber']; ?></strong>
								  <div style="font-size:11px; color:#666666;">Ref. <?php echo encode($rest['id']); ?></div>
								  <div style="width:140px; font-size:11px;"><?php echo date('d-m-Y h:i A', strtotime($rest['addDate'])); ?></div>
								  
								  <div style="font-size:12px;"><?php
	$rs7=GetPageRecord('*','sys_userMaster',' 1 and id in (select parentId from sys_userMaster where id="'.$rest['agentId'].'" ) '); 
		$parentwebsiteagent=mysqli_fetch_array($rs7); ?>
		<a href="display.html?ga=agents&id=<?php echo encode($parentwebsiteagent['id']); ?>&view=1"  target="_blank"><?php echo $parentwebsiteagent['website']; ?></a>		</div>								  </td>
								  <td><div style="font-size:13px; line-height: 16px; margin-bottom:3px;white-space: nowrap; max-width:200px; overflow: hidden; text-overflow: ellipsis;font-weight:600;"> <?php if($agentData['isAgent']==0){ ?><span class="badge bg-blue">B2C Client</span><?php } else { ?><span class="badge bg-black" style="background-color:#000;">Agent</span><?php } ?></div>

	

	<span style="font-size:12px; margin-top:2px; color:#000000; font-weight:500;"><a href="display.html?ga=agents_user&id=<?php echo encode($rest['agentId']); ?>" target="_blank"><?php echo $clientName; ?></a></span>&nbsp;
	<?php if($agentData['isAgent']==1){ ?>
	<i class="fa fa-external-link" aria-hidden="true" onclick="loadpop('<?php echo strip($agentData['companyName']); ?> Details',this,'400px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewAgentDetails&id=<?php echo encode($rest['agentId']); ?>" style="cursor:pointer;"></i>
	<?php } ?>
	
	<div style="color:#303030; font-size:12px; margin-bottom:3px;"><?php echo $clientEmail; ?></div>
	<div style="color:#303030; font-size:12px; margin-bottom:3px;"><?php echo $clientPhone; ?></div>	</td>
								  <td align="left" valign="top"><div class="green-lighter" >
								  				<div>
								  				<?php for($i=1; $i<=$rest['Rating']; $i++){ ?>
						  						 <i class="fa fa-star" aria-hidden="true" style="font-size:12px; color: #ffbc00;"></i>
												 <?php } ?></div>  
												  <strong><?php echo stripslashes($rest['HotelName']); ?></strong></div>
												  City: <strong><?php echo stripslashes($rest['Destination']); ?></strong>
												  <div style="width:200px;"><strong>Checkin: </strong><?php echo date('d-m-Y', strtotime($rest['CheckIn'])); ?><br />
<strong>Checkout: </strong><?php echo date('d-m-Y', strtotime($rest['CheckOutDate'])); ?></div>												  </td>
									<td align="left" valign="top"><div><?php echo stripslashes($rest['RoomType']); ?> (<?php echo  stripslashes($totalbookungpax_room['roomNo']); ?>)</div></td>
									<td align="left" valign="top"></strong>
								      <div align="left"><strong>Buying: &#8377;<?php echo round($rest['agentTotalFare']-$rest['agentMarukup']-$rest['markup']); ?></strong></div>
								      <div style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;  white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width:200px; margin-top:2px; color:#CC0000;">
								        <div align="left">Selling: <strong>&#8377;</strong><strong><?php echo  round($rest['agentTotalFare']-$rest['agentMarukup']); ?></strong></div>
								      </div>	
									  
									  <div style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;  white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width:200px; margin-top:2px; color:#009999;">Markup : <strong>&#8377;<?php echo  round($rest['markup']); ?></strong></div>							  </td>
									<td align="left" valign="top">
									
									
									<?php if($rest['hotelRequest']==1 && $rest['status']!=2){ ?>
									<span class="badge bg-blue" style="background-color:#0091ff;">On&nbsp;Request</span>
									<div style="text-align:center; font-size:11px; color:#FF0000; margin-top:5px;">UNPAID</div>
								 
									<?php } else { ?>
									<?php if($rest['status']==1){ ?><span class="badge bg-blue" style="background-color:#FF6600;">Pending</span><?php } ?>
									<?php if($rest['status']==2){ ?><span class="badge bg-blue" style="background-color:#46cd93;">Confirm</span><?php } ?>
									<?php if($rest['status']==3){ ?><span class="badge bg-blue" style="background-color:#f9392f;">Cancelled</span><?php } ?>
									<?php if($rest['status']==4){ ?><span class="badge bg-blue" style="background-color:#f9392f;">Rejected</span><?php } ?>	
									<?php } ?>
									
									
																	</td>
								    <td align="left" valign="top"><div style="width:192px;">
									
								<?php if($rest['status']==2){ ?>	
									<button type="button" class="btn   btn-sm btn btn-light bg-primary border-primary text-white" onclick="loadpop('View Hotel Voucher',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewHotelVoucher&id=<?php echo encode($rest['id']); ?>&page=<?php echo $_REQUEST['ga']; ?>">Voucher</button>
									<?php } ?>
									
									<?php if(getagentbalance($agentData['id'])>round($rest['agentTotalFare']-$rest['agentMarukup']) || $rest['hotelRequest']==0){ ?>
									 <button type="button" class="btn btn-secondary btn-sm" onclick="loadpop('Confirm Voucher',this,'500px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=confirmHotelVoucher&id=<?php echo encode($rest['id']); ?>&page=<?php echo $_REQUEST['ga']; ?>&hotelRequest=<?php echo ($rest['hotelRequest']); ?>">Update Status</button> 
									<?php } else { ?>
									<div style=" color:#FF0000; font-size:12px; margin-top:5px;"><strong>Low Balance</strong></div>
									<?php } ?>
									
								
									</div></td>
								</tr>
								 <?php $sNo++; } ?>
							</tbody>
						</table>
                           <?php if($sNo==1){ ?>
						   <div style="text-align:center; padding:40px 0px; font-size:14px; color:#999999;">No Booking</div>
						   <?php } else { ?>
								<div class="mt-3 pageingouter">	
										<div style="float: left; font-size: 13px; padding: 7px 11px; border: 1px solid #ededed; background-color: #fff; color: #000;">Total Records: <strong><?php echo $totalentry; ?></strong></div>
											<div class="pagingnumbers"><?php echo $paging; ?></div>
											
							  </div>
										  
										<?php } ?>
						  </div>
								 
                             
</div>
                             

                        </div>

                         
						
						
						
						 
                     

             </div><!--end col-->

            <!-- end row -->

    </div>

        <!-- End Page-content -->

         
    </div>
	</div>	</div>
	
	
<script>

function exportData(){

	var fromdate=$('#fromdate').val();

	var todate=$('#todate').val();

	var keyword=$('#keyword').val();

	var status=$('#status').val();

	var requestedAmount=$('#requestedAmount').val();

	window.location.href="exportonlineflightbooking.php?fromdate="+fromdate+"&todate="+todate+"&keyword="+keyword+"&status="+status;

}

</script>