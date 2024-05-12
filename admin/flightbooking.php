<?php 
$selectedmenu=41;
$u = decode($_REQUEST['u']);

if($_REQUEST['u']==''){
$u=$_SESSION['userid'];
}
$abcd=GetPageRecord('*','userMaster','id="'.$u.'"'); 
$result=mysqli_fetch_array($abcd); 

if($_REQUEST['status']==1 || $_REQUEST['status']==2 || $_REQUEST['status']==3){
if($_REQUEST['i']!=''){
$namevalue ='status="'.$_REQUEST['status'].'"';  
$where='id="'.decode($_REQUEST['i']).'"';    
updatelisting('sys_packageBuilder',$namevalue,$where); 
}
}


if($_REQUEST['status']==4){
if($_REQUEST['i']!=''){
$namevalue ='archiveThis=1';  
$where='id="'.decode($_REQUEST['i']).'"';    
updatelisting('sys_packageBuilder',$namevalue,$where); 
}
}


if($_REQUEST['status']==5){
if($_REQUEST['i']!=''){
$namevalue ='archiveThis=0';  
$where='id="'.decode($_REQUEST['i']).'"';    
updatelisting('sys_packageBuilder',$namevalue,$where); 
}
}


 if($_REQUEST['qid']!=''){ 

$namevalue ='assignedTo="'.$_REQUEST['staffselect'].'",assignedDate="'.date('Y-m-d H:i:s').'"'; 

$where='id="'.$_REQUEST['qid'].'"';   

updatelisting('flightBookingMaster',$namevalue,$where);  

 } 
  

include '../FLYTBOAPI/APIConstants.php';
include '../FLYTBOAPI/RestApiCaller.php';
include '../FLYTBOAPI/FlightAuthentication.php';


if(!isset($_SESSION['tbotokenId']) || $_SESSION['tbotokenId']=='')

{
 
	$_SESSION['tbotokenId']=$json['TokenId'];

}	
 
 
  echo $_SESSION['tbotokenId'];
 
		$hrequest = array('EndUserIp' => ''.$_SERVER['REMOTE_ADDR'].'',
		'TokenId' => ''.$_SESSION['tbotokenId'].'',
		'BookingId' => '67411325',
		'Source' => '5'  
		);
  $req=str_replace('\/','/',json_encode($hrequest)); 
   
 
$header = array('Content-Type: application/json', 'Accept-Encoding: gzip'); 
$restCaller = new RestApiCaller(); 
  
 
$flightRes = $restCaller->post('https://booking.travelboutiqueonline.com/AirAPI_V10/AirService.svc/rest/ReleasePNRRequest', $req, $header); 
$search_result = json_decode($flightRes, true);

 

 

 print_r($req);
 
 
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

      
                    <div class="newboxheading"><div class="newhead">Flight Bookings 	
								 
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

			<select  name="status" class="form-control" data-placeholder="Select Status" autocomplete="off">   

				<option value="">Show All</option>

				<option value="1" <?php if($_REQUEST['status']==1){ ?>selected="selected"<?php } ?>>Pending</option>

				<option value="2" <?php if($_REQUEST['status']==2){ ?>selected="selected"<?php } ?>>Confirm</option>

				<option value="3" <?php if($_REQUEST['status']==3){ ?>selected="selected"<?php } ?>>Cancelled</option>

				<option value="4" <?php if($_REQUEST['status']==4){ ?>selected="selected"<?php } ?>>Rejected</option>

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
 <button type="button" class="btn btn-secondary btn-lg waves-effect waves-light"   onclick="exportData();"  >Export</button> 						 
 </div>
  
		  

 </div>
 </div>     
 
     
</div>
                    <!-- start page title -->
                     
              
                      <div style="padding-top: 34px;">
					  
					  <div class="card-header header-elements-inline" style="    padding: 0px 8px;">
 

						

						<table border="0" cellpadding="10" cellspacing="0" style="font-size:13px;">

  <tr>

    <td><a href="display.html?ga=flightbooking&stage=&fromdate=&todate=&status=2&keyword="><div style="background-color: #46cd93; height: 30px; color: #fff; border-radius: 30px; text-align: center; line-height: 30px; font-size: 16px; font-weight: 600; width: 80px; "><?php

				$a=GetPageRecord('count(id) as totalflight','flightBookingMaster','1  '.$managerwhere.'  and agentOffline=0 and status=2'); 

				$gettotal=mysqli_fetch_array($a); 

				echo $gettotal['totalflight'];

				?></div></a></td>

    <td style="padding-left:0px;">Confirmed</td>

    <td><a href="display.html?ga=flightbooking&stage=&fromdate=&todate=&status=3&keyword="><div style="background-color: #f9392f; height: 30px; color: #fff; border-radius: 30px; text-align: center; line-height: 30px; font-size: 16px; font-weight: 600; width: 80px;  "><?php

				$a=GetPageRecord('count(id) as totalflight','flightBookingMaster','1  '.$managerwhere.'  and agentOffline=0 and status=3'); 

				$gettotal=mysqli_fetch_array($a); 

				echo $gettotal['totalflight'];

				?></div></a></td>

    <td style="padding-left:0px;">Cancel</td>

	

	<td><a href="display.html?ga=flightbooking&stage=&fromdate=&todate=&status=4&keyword="><div style="background-color: #f9392f; height: 30px; color: #fff; border-radius: 30px; text-align: center; line-height: 30px; font-size: 16px; font-weight: 600; width: 80px;  "><?php

				$a=GetPageRecord('count(id) as totalflight','flightBookingMaster','1  '.$managerwhere.'  and agentOffline=0 and status=4'); 

				$gettotal=mysqli_fetch_array($a); 

				echo $gettotal['totalflight'];

				?></div></a></td>

    <td style="padding-left:0px;">Rejected</td>

    <td>

	<a href="display.html?ga=flightbooking&stage=&fromdate=&todate=&status=1&keyword="><div style="background-color: #FF6600; height: 30px; color: #fff; border-radius: 30px; text-align: center; line-height: 30px; font-size: 16px; font-weight: 600; width: 80px;  "><?php

				$a=GetPageRecord('count(id) as totalflight','flightBookingMaster','1  '.$managerwhere.'  and agentOffline=0 and (status=1 or status=0)'); 

				$gettotal=mysqli_fetch_array($a); 

				echo $gettotal['totalflight'];

				?></div></a>

	

	</td>

    <td style="padding-left:0px;">Pending </td>

    <td>

	<a href="display.html?ga=flightbooking"><div style="background-color: #0063d2; height: 30px; color: #fff; border-radius: 30px; text-align: center; line-height: 30px; font-size: 16px; font-weight: 600; width: 80px;  "><?php

				$a=GetPageRecord('count(id) as totalflight','flightBookingMaster','1  '.$managerwhere.'  and agentOffline=0  '); 

				$gettotal=mysqli_fetch_array($a); 

				echo $gettotal['totalflight'];

				?></div></a>

	

	</td>

    <td style="padding-left:0px;">All </td>

  </tr>

</table>
 
			  </div>
					  
                        <div class="col-md-12 col-xl-12" style="padding-left:0px; padding-right:0px;">
						              <div class="">
                            <div class="card-body" style=" background-color:#FFFFFF;"> 
                                     
                                     
							 
                                        <table width="100%" border="0" cellpadding="5" cellspacing="0" class="table table-bordered table-striped" style="white-space: nowrap; font-size:13px;">

  <tr>

    <td><strong>Assign</strong></td>

    <td><strong>Booking Date </strong></td>

    <td><strong>Sector</strong></td>

    <td><strong>Journey Date </strong></td>

    <td><strong>Passanger </strong></td>

    <td><strong>Agent/Client</strong></td>

    <td><strong>PNR</strong></td>

    <td><strong>Statement</strong></td>

    </tr>

	<?php 

$limit=clean($_GET['records']);

$page=clean($_GET['page']); 

$sNo=1; 





$search='';



if($_REQUEST['status']!=''){

$search.=' and  status="'.$_REQUEST['status'].'" ';

}



if($_REQUEST['fromdate']!='' && $_REQUEST['todate']!=''){

$search.=' and  DATE(journeyDate)>="'.date('Y-m-d',strtotime($_REQUEST['fromdate'])).'" and  DATE(journeyDate)<="'.date('Y-m-d',strtotime($_REQUEST['todate'])).'" ';

}





if($_REQUEST['keyword']!=''){

$search.=' and  (flightName like "%'.$_REQUEST['keyword'].'%" or flightNo like "%'.$_REQUEST['keyword'].'%" or  source like "%'.$_REQUEST['keyword'].'%" or  destination like "%'.$_REQUEST['keyword'].'%" or pnrNo like "%'.$_REQUEST['keyword'].'%" or bookingNumber like "%'.$_REQUEST['keyword'].'%" or totalFare like "%'.$_REQUEST['keyword'].'%" or agentId in (select id from sys_userMaster where companyName like "%'.$_REQUEST['keyword'].'%" )) ';

}



 





 

$targetpage='display.html?ga='.$_REQUEST['ga'].'&status='.$_REQUEST['status'].'&fromdate='.$_REQUEST['fromdate'].'&todate='.$_REQUEST['todate'].'&keyword='.$_REQUEST['keyword'].'&'; 

$rs=GetRecordList('*','flightBookingMaster',' where 1 and agentBookingType=0 and bookingType=0  '.$managerwhere.' '.$search.'  order by id desc  ','25',$page,$targetpage); 

$totalentry=$rs[1]; 

$paging=$rs[2];  

while($rest=mysqli_fetch_array($rs[0])){ 

 



$rs6=GetPageRecord('*','flightBookingPaxDetailMaster',' BookingId="'.$rest['id'].'" '); 

$agentcate=mysqli_fetch_array($rs6);



$cft=GetPageRecord('*','flightBookingMaster',' uniqueSessionId="'.$rest['uniqueSessionId'].'" '); 

$cont=mysqli_num_rows($cft);



$ag=GetPageRecord('*','sys_userMaster',' id="'.$rest['agentId'].'" '); 

$agentData=mysqli_fetch_array($ag);

$clientName='';

$clientEmail='';

$clientPhone='';



$clientName=strip($agentData['companyName']);









$ba=GetPageRecord('*','sys_balanceSheet',' bookingId="'.$rest['id'].'" and bookingType="flight" '); 



 

$ag=GetPageRecord('*','userMaster',' id="'.$rest['clientId'].'" '); 

$clientData=mysqli_fetch_array($ag);



if($agentData['isAgent']==0){

$clientName= ($clientData['name']);

}

$clientEmail= ($agentData['email']);

$clientPhone= ($agentData['phone']);


$ag=GetPageRecord('*','flight_booking_ssr_details',' BookingId="'.$rest['id'].'" ');  
$ssrprice=mysqli_fetch_array($ag);

?>

  <tr <?php if($rest['totalWithSSRAmount']>0){ ?>style="background-color:#cff3ff"<?php } ?>>

  

  

    <td>

	<div style="margin-bottom:4px; "><?php if($LoginUserDetails['roleId']!=5){ ?><div class="btn-group" role="group" aria-label="Option"> 

  <a  onclick="loadpop('View Ticket',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewTicket&id=<?php echo encode($rest['id']); ?>"><button type="button" class="btn btn-secondary"><i class="fa fa-file-text-o" aria-hidden="true"></i></button></a> 
 

  <?php if($rest['pnrNo']!='' && $rest['status']!=4){?>

  <a  href="<?php echo $fullurl; ?>flightInvoice.php?id=<?php echo encode($rest['id']); ?>" target="_blank"><button type="button" class="btn btn-secondary"><i class="fa fa-info" aria-hidden="true"></i></button></a>

<?php } ?>





   

 

  <?php if($rest['status']!=4){?>

  <a onclick="loadpop('Update PNR',this,'700px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=updatePNR&id=<?php echo encode($rest['id']); ?>"><button type="button" class="btn btn-secondary"><i class="fa fa-pencil" aria-hidden="true"></i></button></a></div><?php } ?></div>

 

	<?php if($_SESSION['userid']==1 ){ ?>

	
 
	<form action="" method="get" id="staffselectid<?php echo stripslashes($rest['id']); ?>" name="staffselectid<?php echo stripslashes($rest['id']); ?>">

	<input type="hidden" name="ga" value="<?php echo $_REQUEST['ga']; ?>" />

	<input type="hidden" name="qid" value="<?php echo stripslashes($rest['id']); ?>" />

	<select id="staffselect"  name="staffselect"  class="form-control"  autocomplete="off" onchange="$('#staffselectid<?php echo stripslashes($rest['id']); ?>').submit();"  style="width:100%;">   

	<option value="">Select User</option>   

	<?php  

	$rsA=GetPageRecord('*','sys_userMaster','  userType="1" order by firstName asc');

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

	$rsA=GetPageRecord('*','sys_userMaster','  id="'.$_SESSION['userid'].'"');

	while($restUser=mysqli_fetch_array($rsA)){ 

	?>

	<option value="<?php echo $restUser['id']; ?>" <?php if($rest['assignedTo']==$restUser['id']){ ?>selected="selected"<?php } ?>><?php echo stripslashes($restUser['name']); ?></option>    

	<?php } ?>

	</select>

	</form>

	<?php } ?>

	<?php }   ?><?php } ?>  </td>





    <td style="position:relative;">
	<?php if($rest['mobileDevice']==0){ ?>
	<i class="fa fa-desktop" aria-hidden="true" style="font-size: 20px; position: absolute; right: 10px; top: 10px; color: #0081fa;"></i>
	<?php } else { ?>
	<i class="fa fa-mobile" aria-hidden="true" style="font-size: 30px; position: absolute; right: 10px; top: 10px; color:#FF0000;"></i>
	<?php } ?>

	 <?php if($rest['status']==1 || $rest['status']==0){ ?><span class="badge bg-blue" style="background-color:#FF6600;">Pending</span><?php } ?>

									<?php if($rest['status']==2){ ?><span class="badge bg-blue" style="background-color:#46cd93;">Confirm</span><?php } ?>

									<?php if($rest['status']==3){ ?><span class="badge bg-blue" style="background-color:#f9392f;">Cancelled</span><?php } ?><?php if($rest['status']==4){ ?><span class="badge bg-blue" style="background-color:#f9392f;">Rejected</span><?php } ?>	

	<div style="font-size:12px; margin:5px 0px 0px;"><span class="badge bg-black" style="background-color: #e8e8e8; font-size: 12px; color: #000;"><?php echo encode($rest['id']); ?></span></div>

	

	<?php echo date('d-m-Y h:i A', strtotime($rest['bookingDate'])); ?><div style="font-size:12px;"> </div>

		

		

		<?php if($rest['status']==2){



$abc=GetPageRecord('id,addDate','ticketCancelRequest',' flightBookingId="'.$rest['id'].'"'); 

$cancelrequestdata=mysqli_fetch_array($abc);



if($cancelrequestdata['id']>0){

 ?><div style="color: #fff; background-color: #CC0000; padding: 0px 5px;font-size:12px;"><strong>Cancellation Request</strong><br /><span><?php echo date("d-m-Y H:i:s",strtotime($cancelrequestdata['addDate'])); ?></span></div><?php } } ?>	

 <div>API: <strong><?php echo $rest['apiType']; ?><?php if($rest['apiType']=='FD'){ 
 
 $asupplier=GetPageRecord('companyName','sys_userMaster',' id in (select addedBy from pnr_details where id="'.$rest['fdFlightId'].'")');  
$resasupplier=mysqli_fetch_array($asupplier);
 
 ?> - (<?php echo strip($resasupplier['companyName']); ?>)<?php } ?></strong></div> 	</td>

		

	<td>From: <?php $arr = explode('-',$rest['source']); echo $arr[1]; ?><br />

To: <?php $arr2 = explode('-',$rest['destination']); echo $arr2[1]; ?></td>

    <td>

	<span style="color:#000;"><i class="fa fa-plane" aria-hidden="true"></i> <strong><?php echo stripslashes($rest['flightName']); ?>&nbsp;(<?php echo stripslashes($rest['flightNo']); ?>)<br>

</span>

	<div style="color:#CC0000; margin-top:2px;"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> <?php echo date('d-m-Y', strtotime($rest['journeyDate'])); ?></div>

	<div style="color:#0066CC; margin-top:2px;"><?php if($rest['tripType']==1){ echo 'Oneway'; } else { echo 'Round Trip'; } ?> </div>	</td>

    <td><?php 

	  $ns=1;

		$rs6=GetPageRecord('*','flightBookingPaxDetailMaster',' BookingId="'.$rest['id'].'" and firstName!="" '); 

		while($paxData=mysqli_fetch_array($rs6)){

	  

	  ?>

	  <div><i class="fa fa-user" aria-hidden="true"></i> <strong><?php echo $paxData['title']; ?>&nbsp;<?php echo $paxData['firstName']; ?>&nbsp;<?php echo $paxData['lastName']; ?></strong></div>

	  <?php } ?>	  </td>

    <td style="white-space: initial !important;"> 



	

<?php if($agentData['websiteUser']==1){ ?><div style="padding:2px 5px; font-size:10px; text-transform: uppercase; background-color:#0066CC; color:#fff;display: inline-block; border-radius: 5px;">Client</div><?php } else { ?><div style="padding:2px 5px; font-size:10px; text-transform: uppercase; background-color:#000; color:#fff;display: inline-block; border-radius: 5px;">Agent</div><?php } ?><br />


	<span style="font-size:12px; margin-top:2px; color:#000000; font-weight:500;"><a href="display.html?ga=agents_user&id=<?php echo encode($rest['agentId']); ?>" target="_blank"><?php if($agentData['websiteUser']==1){?><?php echo strip($agentData['lastName']); ?> <?php echo strip($agentData['lastName']); ?><?php } else { ?><?php echo strip($agentData['companyName']); ?><?php } ?></a></span>
	<?php  if($agentData['websiteUser']==0){  ?>


	<i class="fa fa-external-link" aria-hidden="true" onclick="loadpop('<?php echo strip($agentData['companyName']); ?> Details',this,'400px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewAgentDetails&id=<?php echo encode($rest['agentId']); ?>" style="cursor:pointer;"></i>

	<?php } else { ?>
<strong><?php echo strip($agentData['firstName']); ?> <?php echo strip($agentData['lastName']); ?> <?php echo strip($agentData['lastName']); ?></strong>
	<?php } ?>

	<div style="color:#303030; font-size:12px; margin-bottom:3px;"><?php echo $clientEmail; ?></div>

	<div style="color:#303030; font-size:12px; margin-bottom:3px;"><?php echo $clientPhone; ?></div>	

	

	<?php if($rest['remark']!=''){ ?><div style="font-size: 11px; background-color: #FFFEEA; max-width:200px;white-space: initial; border: 1px solid #FFCC00; padding: 5px; border-radius: 4px; color: #000;"><?php echo stripslashes($rest['remark']); ?></div><?php } ?>	</td>

    <td> 

	<div style="font-size:12px; margin:5px 0px 0px;"><span class="badge bg-black" style="background-color: #e8e8e8; font-size: 12px; color: #000;"><?php echo stripslashes($rest['bookingNumber']); ?></span></div>

	<?php if($rest['pnrNo']!=''){?><span class="badge bg-blue" style="color:#009900;font-size:14px;font-weight:700;background-color: #fff;"><i class="fa fa-tag" aria-hidden="true"></i> <?php echo stripslashes($rest['pnrNo']); ?>  </span><?php } ?>

	 

	

	<div><span class="badge badge-boxed  badge-soft-success" style=" background-color: #737373 !important; color:#fff; margin-top:2px; font-size: 11px; padding:2px 6px;"><?php $pnrstring=explode('~',$rest['pcc']); echo $pnrstring[1];   ?></span></div>

	

	<div><?php 

	$rs8=GetPageRecord('*','fareTypeMaster',' flightName="'.$rest['flightName'].'"  and fareTypeName like "%'.$pnrstring[1].'%"'); 

		$parentwebsiteagent=mysqli_fetch_array($rs8);

		?>

	 <span class="badge badge-boxed  badge-soft-success" style=" background-color:<?php echo $parentwebsiteagent['displayColor']; ?> !important; color:#fff; margin-top:2px; font-size: 11px; padding:2px 6px;"><?php echo $parentwebsiteagent['displayType']; ?></span>	</div>

	<div style="font-size:12px; color:#009900; <?php if($rest['refundyes']=='REFUNDABLE'){   } else { echo 'color:#FF0000'; } ?>">

	<?php if($rest['refundyes']=='REFUNDABLE'){ echo 'Refundable'; } else { echo 'Non Refundable'; } ?>

	</div>	</td>

    <td><strong>Buying: &#8377;<?php
	 $getTDS=round($rest['agentCommision']*5/100); 
	$gstcost=0;
	$gstcost=($rest['serviceFee']*18/100);
   echo round($rest['agentTotalFare']+$getTDS+$ssrprice['BaggageFeeInn']+$ssrprice['MealFeeInn']+$ssrprice['SeatPriceInn']-$rest['agentCommision']+$getTDS)-str_replace('-','',round($rest['markup'])); ?>
	 </strong>

	 

<div style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;  white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width:200px; margin-top:2px; color:#009999;">Markup : <strong>&#8377;<?php echo str_replace('-','',round($rest['agentTax']-$rest['tax'])); ?></strong></div>



<div style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;  white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width:200px; margin-top:2px; color:#3366CC;">Comm.: <strong>&#8377;<?php echo ($rest['agentCommision']); ?></strong></div>

<div style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;  white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width:200px; margin-top:2px; color:#000;">TDS: <strong>&#8377;<?php echo round($getTDS); ?></strong></div>

<div style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;  white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width:200px; margin-top:2px; color:#009900;">Profit: <strong>&#8377;<?php echo round($rest['serviceFee']+$rest['agentCommision']-$getTDS);?> </strong></div>


<div style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;  white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width:200px; margin-top:2px; color:#CC0000;">Selling: <strong>&#8377;<?php echo stripslashes($rest['agentTotalFare']+$ssrprice['BaggageFeeInn']+$ssrprice['MealFeeInn']+$ssrprice['SeatPriceInn']); ?></strong></div></td>

    </tr>

	 <?php $sNo++; } ?>

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