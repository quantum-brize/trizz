<?php

$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 


$search='';

if($_REQUEST['agent']!=''){
$search.=' and  agentId="'.$_REQUEST['agent'].'" ';
}

if($_REQUEST['fromdate']!='' && $_REQUEST['todate']!=''){
$search.=' and  DATE(bookingDate)>="'.date('Y-m-d',strtotime($_REQUEST['fromdate'])).'" and  DATE(bookingDate)<="'.date('Y-m-d',strtotime($_REQUEST['todate'])).'" ';
$fromdate=date('d-m-Y',strtotime($_REQUEST['fromdate']));
$todate=date('d-m-Y',strtotime($_REQUEST['todate']));
} else {
$search.=' and  DATE(bookingDate)>="'.date('Y-m-'.'1').'" and  DATE(bookingDate)<="'.date('Y-m-t').'" ';
$fromdate=date('1-m-Y');
$todate=date('t-m-Y');
}


if($_REQUEST['keyword']!=''){
$search.=' and  (invoiceId like "%'.$_REQUEST['keyword'].'%" or  pnrNo like "%'.$_REQUEST['keyword'].'%"   ) ';
}
?>
<div class="wrapper">
<div class="container-fluid">
<div class="main-content">

<div class="page-content">



<!-- start page title -->


<div class="row">
<div class="col-md-12 col-xl-12">
<div class="card" style="min-height:500px;">
<div class="card-body" style="padding:0px;"> 
<h4 class="card-title cardtitle">Flight GST Report List<div class="float-right"></div></h4> 
<div style="float: right; width: 75%; margin-top: -44px; margin-right: 14px;" class="searchbox">
			<form method="get" id="searchform">
		<div class="row">
		
		<input name="ga" type="hidden" value="<?php echo $_REQUEST['ga']; ?>" />
		<input name="stage" type="hidden" value="<?php echo $_REQUEST['stage']; ?>" />
		
		<div class="col-xl-3">
			<div class="input-group">
	 	<input type="text" id="fromdate" name="fromdate" class="form-control" placeholder="From Date" value="<?php echo $fromdate; ?>"  readonly >
		
			</div>
		  </div>
				
		<div class="col-xl-3">
			<div class="input-group">
	 	<input type="text" id="todate" name="todate" class="form-control" placeholder="To Date"  value="<?php echo $todate; ?>" readonly>
		
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
			<select id="agent" name="agent" class="form-control"  data-placeholder="All Source"  autocomplete="off"  onchange="$('#searchform').submit();">   
				<option value="">All Agents</option>   
			 <?php  
$rs=GetPageRecord('*','sys_userMaster','  parentId="'.$LoginUserDetails['parentId'].'" and userType="agent" order by id asc');
while($rest=mysqli_fetch_array($rs)){ 
?>
<option value="<?php echo $rest['id']; ?>" <?php if($_REQUEST['agent']==$rest['id']){ ?>selected="selected"<?php } ?>><?php echo stripslashes($rest['companyName']); ?></option>    
		<?php } ?>
</select> 
			</div>
		  </div>
		
		<div class="col-xl-3">
			<div class="input-group">
			<input name="keyword" type="text" class="form-control" id="keyword" placeholder="Enter Keyword" value="<?php echo $_REQUEST['keyword']; ?>"  >
			<span class="input-group-append">
			<button class="btn btn-light bg-primary border-primary text-white" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
			<a href="export_gstreport.php?fromdate=<?php echo $fromdate; ?>&todate=<?php echo $todate; ?>&agent=<?php echo $_REQUEST['agent']; ?>&keyword=<?php echo $_REQUEST['keyword']; ?>" target="_blank"><button class="btn btn-light bg-primary border-primary text-white" type="button" style="margin-left:5px;">Export</button></a>
			</span>
			</div>
		  </div>
				
				
		 	  </div>
		</form>										
	 	  </div>






<table class="table table-hover mb-0">

<thead>
<tr>
<th>Invoice Date </th>
<th>Invoice No. </th>
<th>Booking ID</th>
<th>Corporate</th>
<th>GSTN</th>
<th><div align="center">Commission</div></th>
<th><div align="center">Amount</div></th>
<th><div align="center">GST</div></th>
<th><div align="center">GST Amount </div></th>
<th><div align="center">TDS</div></th>
<th><div align="center">Invoice&nbsp;Amount </div></th>
</tr>
</thead>
<tbody>
<?php 
$totalgst=0;

$targetpage='display.html?ga='.$_REQUEST['ga'].'&agentCategory='.$_REQUEST['agentCategory'].'&fromdate='.$_REQUEST['fromdate'].'&todate='.$_REQUEST['todate'].'&keyword='.$_REQUEST['keyword'].'&'; 
$rs=GetRecordList('*','sys_balanceSheet',' where 1 and amount>0 and bookingId in (select id from flightBookingMaster where status=2) and billType="flight"  group by bookingId  order by id desc  ','100',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 


$rs6=GetPageRecord('*','flightBookingMaster',' id="'.$rest['bookingId'].'" '); 
$bookingdata=mysqli_fetch_array($rs6);

$ag=GetPageRecord('*','sys_userMaster',' id="'.$bookingdata['agentId'].'" '); 
$agentData=mysqli_fetch_array($ag);

$rs6=GetPageRecord('*','flightBookingMaster',' id="'.$rest['bookingId'].'" '); 
$bookingdata=mysqli_fetch_array($rs6);

$rs7=GetPageRecord('*','sys_balanceSheet',' bookingId="'.$rest['bookingId'].'" and bookingType="Facilitating"'); 
$totalamountres=mysqli_fetch_array($rs7);

if($totalamountres['amount']<1){

$rs7=GetPageRecord('*','sys_balanceSheet',' bookingId="'.$rest['bookingId'].'" and bookingType="flight"'); 
$totalamountres=mysqli_fetch_array($rs7);

}
$totalpriceofgst=$totalamountres['amount'];

$ag=GetPageRecord('*','sys_userMaster',' id in (select id from sys_userMaster where id ="'.$rest['agentId'].'") '); 
$agentData=mysqli_fetch_array($ag);
?>

<tr>
<td align="left" valign="top"><?php echo date('d-m-Y', strtotime($bookingdata['bookingDate'])); ?></td>
<td align="left" valign="top"><a href="<?php echo $fullurl; ?>flightInvoice.php?id=<?php echo encode($bookingdata['id']); ?>" target="_blank"><?php echo encode($bookingdata['invoiceId']); ?></a></td>
<td align="left" valign="top"><?php echo encode($bookingdata['id']); ?></td>
<td align="left" valign="top"><?php echo strip($agentData['companyName']); ?></td>
<td align="left" valign="top"><?php echo strip($agentData['gstin']); ?></td>
<td align="left" valign="top"><div align="center"><?php echo  ($bookingdata['agentCommision']); $gstamount=round($bookingdata['agentCommision']*18/100); $tds=round($bookingdata['agentCommision']*5/100); ?></div></td>
<td align="left" valign="top"><div align="center"><?php echo stripslashes($ServiceFee); ?></div></td>
<td align="left" valign="top"><div align="center">18%</div></td>
<td align="left" valign="top"><div align="center"><?php if($bookingdata['agentCommision']==0){ echo stripslashes($rest['amount']); } else { echo $gstamount; }?></div></td>
<td align="left" valign="top">
<div align="center"><?php echo $tds; ?></div></td>
<td align="left" valign="top"><div align="center"><?php echo (round($bookingdata['agentTotalFare']+$gstamount+$tds)-$bookingdata['agentCommision']); ?></div></td>
</tr>

<?php $sNo++; } ?>
<tr>
<td align="left" valign="top">&nbsp; </td>
<td align="left" valign="top"> </td>
<td align="left" valign="top">&nbsp; </td>
<td align="left" valign="top">&nbsp; </td>
<td align="left" valign="top">&nbsp; </td>
<td align="left" valign="top"> <div align="center"></div></td>
<td align="left" valign="top">&nbsp; </td>
<td align="left" valign="top"> 
<div align="center"><strong>Total</strong></div></td>
<td align="left" valign="top"><div align="center"><strong><?php echo $totalgst; ?> INR </strong></div></td>
<td align="left" valign="top"> <div align="center"></div></td>
<td align="left" valign="top"><div align="center"></div></td>
</tr>
</tbody>
</table>

<div class="mt-3 pageingouter">	
<div style="float: left; font-size: 13px; padding: 7px 11px; border: 1px solid #ededed; background-color: #fff; color: #000;">Total Records: <strong></strong></div>
<div class="pagingnumbers"></div>

</div>


</div>


</div>


</div>








</div><!--end col-->

<!-- end row -->

</div>

<!-- End Page-content -->


</div>
</div>	</div>