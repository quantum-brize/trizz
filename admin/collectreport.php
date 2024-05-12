<?php
if($_REQUEST['startDate']!='' && $_REQUEST['endDate']!='' ){
$startDate=date('d-m-Y',strtotime($_REQUEST['startDate']));
$endDate=date('d-m-Y',strtotime($_REQUEST['endDate']));
} else {
$startDate=date('d-m-Y',strtotime('-30 Days'));
$endDate=date('d-m-Y');
}

$where1='';
$where2='';

$whereintotal=' and DATE(dateAdded) between  "'.date('Y-m-d',strtotime($startDate)).'" and "'.date('Y-m-d',strtotime($endDate)).'" ';
$whereintotal2=' and DATE(paymentDate) between  "'.date('Y-m-d',strtotime($startDate)).'" and "'.date('Y-m-d',strtotime($endDate)).'" ';



if($_REQUEST['keyword']!=''){
$where1=' and (queryId="'.decode($_REQUEST['keyword']).'"  or id="'.decode($_REQUEST['keyword']).'" or paymentId="'.$_REQUEST['keyword'].'")';
}

if($_REQUEST['transectionType']!=''){
$where2=' and transectionType="'.$_REQUEST['transectionType'].'"';
}

if($_REQUEST['status']!=''){
if($_REQUEST['status']==1){
$where2=' and paymentStatus="'.$_REQUEST['status'].'"';
}

if($_REQUEST['status']==2){
$where2=' and paymentStatus="'.$_REQUEST['status'].'" and DATE(paymentDate)>"'.date('Y-m-d H:i:s').'"';
}


if($_REQUEST['status']==3){
$where2=' and paymentStatus=2 and DATE(paymentDate)<"'.date('Y-m-d H:i:s').'"';
}

}
?>

 <style>
.table td, .table th {
    vertical-align: top;
}
.statusbox{margin-right: 5px; padding: 10px; text-align: center; background-color: #000000; font-size: 13px; color: #fff; border-radius: 4px; text-transform:uppercase;}
</style>
<div class="wrapper">
<div class="container-fluid">
<div class="main-content">

                <div class="page-content">

      <div class="newboxheading"><div class="newhead">Collection Report<div class="newoptionmenu">
  <form  action=""    method="get" enctype="multipart/form-data">	
								<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><input type="text" class="form-control" id="startDate" name="startDate" readonly="" placeholder="From" value="<?php echo $startDate; ?>" style="width:130px;"></td>
    <td style="padding-left:5px;"><input type="text" class="form-control" id="endDate" name="endDate" readonly="" placeholder="From" value="<?php echo $endDate; ?>" style="width:130px;"></td>
    <td style="padding-left:5px;"><input type="text" name="keyword" class="form-control"  placeholder="query, payment, transection id"  value="<?php echo $_REQUEST['keyword']; ?>" style=" width:150px;">
								  <input name="page" type="hidden" value="<?php echo $_REQUEST['page']; ?>" /><input name="ga" type="hidden" value="<?php echo $_REQUEST['ga']; ?>" />						    </td>
    <td style="padding-left:5px;"><select name="transectionType" class="form-control" style="width:130px;">
<option value="">All Type</option> 
<option value="Online"<?php if($_REQUEST['transectionType']=='Online'){ ?> selected="selected"<?php } ?>>Online</option> 
<option value="Cash"<?php if($_REQUEST['transectionType']=='Cash'){ ?> selected="selected"<?php } ?>>Cash</option> 
<option value="Checks"<?php if($_REQUEST['transectionType']=='Checks'){ ?> selected="selected"<?php } ?>>Checks</option>
<option value="NEFT"<?php if($_REQUEST['transectionType']=='NEFT'){ ?> selected="selected"<?php } ?>>NEFT</option> 
<option value="Mobile&nbsp;Payment"<?php if($_REQUEST['transectionType']=='Mobile Payment'){ ?> selected="selected"<?php } ?>>Mobile&nbsp;Payment</option> 
</select></td>
 <td style="padding-left:5px;"><select name="status" class="form-control"  style="width:130px;"> 
<option value="">All Status</option> 
<option value="1"<?php if($_REQUEST['status']==1){ ?> selected="selected"<?php } ?>>Paid</option>  
<option value="2"<?php if($_REQUEST['status']==2){ ?> selected="selected"<?php } ?>>Scheduled</option>  
<option value="3"<?php if($_REQUEST['status']==3){ ?> selected="selected"<?php } ?>>Overdue</option>  
</select>  </td> 
    <td style="padding-left:5px;"><button type="submit" class="btn btn-secondary btn-lg waves-effect waves-light" style="padding: 6px 10px;"  ><i class="fa fa-search" aria-hidden="true"></i> Search</button></td>
    <td>&nbsp;</td>
  </tr>
</table>
  </form>
 </div>
 </div>     
 
     
</div>
                    
                    <!-- start page title -->
                     
              
                        <div class=" ">
                        <div class="col-md-12 col-xl-12" style="padding-top:45px;">
						<div class="card" style="min-height:500px; overflow:hidden;">
                            <div class="card-body" style="padding:0px;"> 
                                      
							  
							  
							  <div style=" padding:10px;">
							  <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="33%" align="left" valign="top"><div class="statusbox" style="background-color:#655be6;"><div style="margin-bottom: 0px; font-size: 30px; line-height: 38px;">
	&#8377;<?php $ba=GetPageRecord('SUM(grossPrice) as totalgross','sys_packageBuilder',' confirmQuote=1 '.$whereintotal.' ' ); $packagecost=mysqli_fetch_array($ba); echo number_format($packagecost['totalgross']); ?>
	
	</div>Total Amount</div></td>
    <td width="33%" align="left" valign="top"><div class="statusbox" style="background-color:#0cb5b5;">
      <div style="margin-bottom: 0px; font-size: 30px; line-height: 38px;">&#8377;<?php $ba=GetPageRecord('SUM(amount) as totalrecived','sys_PackagePayment',' paymentStatus=1 '.$whereintotal2.' '.$where1.' '.$where2.''); $packagecostrecived=mysqli_fetch_array($ba); echo number_format($packagecostrecived['totalrecived']); ?></div>
      Received</div></td>
     
    <td width="33%" align="left" valign="top"><div class="statusbox" style="background-color:#e45555; margin-right:0px;">
      <div style="margin-bottom: 0px; font-size: 30px; line-height: 38px;">&#8377;<?php echo number_format(round($packagecost['totalgross']-$packagecostrecived['totalrecived'])); ?></div>Pending</div></td>
    </tr>
</table>

							  </div>
							  
                                       
                                         
                           
						   
						   
						   <table class="table table-hover mb-0" style="border:1px solid #ddd;">

                                            <thead>
                                                <tr>
                                                  <th>Query ID </th>
                                                  <th>Payment ID </th>
                                                  <th>Transection ID</th>
                                                  <th>Client</th>
                                                  <th>Type</th>
                                                  <th>Amount</th>
                                                  <th>Payment Date</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
<tbody> 
<?php

$totalno=1;

$where=' where DATE(paymentDate) between "'.date('Y-m-d',strtotime($startDate)).'" and "'.date('Y-m-d',strtotime($endDate)).'" '.$where1.' '.$where2.' order by paymentDate desc';


$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 
$targetpage='display.html?ga='.$_REQUEST['ga'].'&keyword='.$_REQUEST['keyword'].'&searchcity'.$_REQUEST['searchcity'].'&status='.$_REQUEST['status'].'&transectionType='.$_REQUEST['transectionType'].'&'; 
$rs=GetRecordList('*','sys_PackagePayment','   '.$where.'  ','25',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($paymentlist=mysqli_fetch_array($rs[0])){ 
 
 
 $b3d=GetPageRecord('*','userMaster','id in (select clientId from queryMaster where id="'.$paymentlist['queryId'].'" )'); 
$clientData=mysqli_fetch_array($b3d);
?>

<tr>
  <td align="left" valign="top"><a href="display.html?ga=query&view=1&id=<?php echo encode($paymentlist['queryId']); ?>" target="_blank"><?php echo encode($paymentlist['queryId']); ?></a></td>
  <td align="left" valign="top"><?php if($paymentlist['paymentStatus']==1){ echo encode($paymentlist['id']); } else { echo '-'; } ?></td>
  <td align="left" valign="top" style="text-transform:uppercase;"><?php if($paymentlist['paymentId']!=''){  echo ($paymentlist['paymentId']); } else { echo '-'; }  ?></td>
  <td align="left" valign="top"><?php echo stripslashes($clientData['firstName']); ?> <?php echo stripslashes($clientData['lastName']); ?></td>
  <td align="left" valign="top"><?php if($paymentlist['paymentId']!=''){  ?><span class="badge badge-dark"><?php echo ($paymentlist['transectionType']); ?></span><?php } ?></td>
  <td align="left" valign="top">&#8377;<?php echo ($paymentlist['amount']); ?></td>
  <td align="left" valign="top"><?php echo date('d/m/Y - h:i A',strtotime($paymentlist['paymentDate'])); ?> </td>
  <td align="left" valign="top"><?php if($paymentlist['paymentStatus']==1){ ?><span class="badge badge-success">Paid</span><?php } ?>
  
  <?php if(date('Y-m-d H:i:s',strtotime($paymentlist['paymentDate']))>=date('Y-m-d H:i:s')){  if($paymentlist['paymentStatus']==2){ ?><span class="badge badge-warning">Scheduled</span><?php } } else { if($paymentlist['paymentStatus']==2){ ?>
  <span class="badge badge-danger">Overdue</span>
  <?php } } ?>  </td>
</tr>


<?php  $totalno++; } ?>
                                          </tbody>
                              </table>
						   
						   
						   
						   
									 <?php if($totalno==1){ ?>
						   <div style="text-align:center; padding:40px 0px; font-size:14px; color:#999999;">No Data </div>
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



 $( function() {
    $( "#startDate" ).datepicker({ 
	  dateFormat: 'dd-mm-yy' 
      });
	  
	  $( "#endDate" ).datepicker({ 
	  dateFormat: 'dd-mm-yy' 
      });
  } );
 

</script>
				
	
<script>
function changeAssignTo(id){
var assignTo = $('#assignTo'+id).val();  
$('#actoinfrm').attr('src','actionpage.php?action=changeassignstatus&queryid='+id+'&assignTo='+assignTo);
}

</script>