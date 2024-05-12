<?php   
$as=GetPageRecord('*','userMaster','id="'.decode($_REQUEST['id']).'"'); 
$clientDetails=mysqli_fetch_array($as); 
 
 ?>
 <style>
 body{background-color:#f9fbfc !important;}
 html{background-color:#f9fbfc !important;}
 </style>

<div class="wrapper">

<div class="dashboardleft" style=" background-color:#f9fbfc;border-right: 1px solid #ddd6 !important;">
<div class="dashboardleftinnter">
<h4 class="card-title" style=" margin-top:0px; font-size: 18px; font-weight:700;">Client Account</h4>

</div>
  
<div class="listleftmenulink">

<a href="#clientsec">Client Details</a>
<a href="#followupsec">Followup's</a>
<a href="#querysec">Queries</a>  
<a href="#invoicesec">Invoice</a>
<a href="#paymentsec">Payment History</a>
<a href="#documentsec">Documents</a>
</div>
 

</div>












<div class="container-fluid" style="padding-left:300px !important;">
<div class="main-content">

                <div class="page-content">

      
                    <div class="row">
					    <div class="col-md-12 col-xl-12" id="displayprofile">
                      <div class="systemcard">
					  
					    <div style=" background-color:#FFFFFF; padding-bottom:20px; border-bottom:1px solid #ececec; position:relative;">
						<div class="float-right">
									<a href="display.html?ga=clients" style="position: absolute; right: 50px; top: 10px;"><button type="button" class="btn btn-primary btn-lg waves-effect waves-light" style="margin-bottom:10px;">Back</button></a>
									</div>
						
						<a class="dropdown-item neweditpan" style="cursor:pointer; position:absolute; right:0px; top:10px;z-index: 1;background-color: #c6e5f5;"  onclick="loadpop2('Edit Client',this,'600px')" data-toggle="modal"  data-target="#myModal2" data-backdrop="static"  popaction="action=addclient&id=<?php echo encode($clientDetails['id']); ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
						
							<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"><div class="profileuserbadges" style="line-height: 56px;"><?php echo substr($clientDetails['firstName'],0,1); ?></div></td>
    <td width="95%" style=" position:relative;"><div style="margin-bottom:0px; font-size:16px; font-weight:700;"><?php echo stripslashes($clientDetails['submitName']); ?> <?php echo stripslashes($clientDetails['firstName']).' '.stripslashes($clientDetails['lastName']); ?></div>
	<div style="margin-bottom:0px; font-size:14px; font-weight:400;">Type: B2C</div>
	<div style="margin-bottom:0px; font-size:13px; font-weight:400;">Created: <strong><?php if(date('d-m-Y', ($clientDetails['dateAdded']))=='01-01-1970'){ echo '-'; } else {  echo date('d-m-Y', ($clientDetails['dateAdded'])); } ?></strong></div></td>
  </tr>
</table>

							</div>
							
							
							<div id="clientsec">
							<div style="font-size:16px; font-weight:600; margin-bottom:5px; margin-top:20px;">Client Information</div>
							
							
							<table border="0" cellpadding="5" cellspacing="0"  >
  <tr>
    <td style="padding-right:100px;">Mobile</td>
    <td><?php  echo  (trim($clientDetails['mobileCode'])); ?> <?php  echo checkmobile(trim($clientDetails['mobile'])); ?></td>
  </tr>
  <tr>
    <td>Email</td>
    <td><?php echo stripslashes($clientDetails['email']); ?></td>
  </tr>
  <tr>
    <td>Mobile 2 </td>
    <td><?php  echo  (trim($clientDetails['mobileCode2'])); ?> <?php  echo checkmobile(trim($clientDetails['mobile2'])); ?></td>
  </tr>
  <tr>
    <td>Email 2 </td>
    <td><?php echo stripslashes($clientDetails['email2']); ?></td>
  </tr>
  <tr>
    <td>City</td>
    <td><?php  $a=GetPageRecord('*','cityMaster','id="'.$clientDetails['city'].'"'); $profilename=mysqli_fetch_array($a); echo $profilename['name']; ?></td>
  </tr>
  <tr>
    <td>Address</td>
    <td><?php echo stripslashes($clientDetails['address']); ?></td>
  </tr>
  <tr>
    <td>Date of Birth</td>
    <td><?php if($clientDetails['dob']>'1970-01-01'){ echo date('d-m-Y', strtotime($clientDetails['dob'])); } else { echo '-'; } ?></td>
  </tr>
  <tr>
    <td>Marriage Anniversary</td>
    <td><?php if($clientDetails['marriageAnniversary']>'1970-01-01'){ echo date('d-m-Y', strtotime($clientDetails['dob'])); } else { echo '-'; } ?></td>
  </tr>
</table>

							</div>
							</div>
							
							
							<div class="systemcard" id="followupsec">
								<div style=" background-color: #FFFFFF; padding-bottom: 10px; position: relative; ">
							<div style="font-size:16px; font-weight:600; margin-bottom:5px;">Followup's</div>
							</div>
							
							 <table class="table table-hover mb-0" style="border:1px solid #ddd;">

                                            <thead>
                                                <tr>
                                                  <th width="5%" align="center">&nbsp;</th>
                                                  <th>Query ID </th>
                                                  <th>Details</th>
                                                  <th>Reminder</th>
                                                  <th>Status</th>
                                                  <th>Assigned</th>
                                                </tr>
                                            </thead>
<tbody> 
<?php

$totalno=1;

$where=' where queryId in (select id from queryMaster where clientId="'.$clientDetails['id'].'"   '.$mainwhere.')   order by reminderDate desc';


$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 
$targetpage='display.html?ga='.$_REQUEST['ga'].'&keyword='.$_REQUEST['keyword'].'&searchcity'.$_REQUEST['searchcity'].'&status='.$_REQUEST['status'].'&searchusers='.$_REQUEST['searchusers'].'&'; 
$rs=GetRecordList('*','queryTask','   '.$where.'  ','100',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 

$b=GetPageRecord('*','queryMaster','id="'.$rest['queryId'].'"'); 
$queryData=mysqli_fetch_array($b);

$bc=GetPageRecord('*','userMaster','id="'.$queryData['clientId'].'"'); 
$clientData=mysqli_fetch_array($bc);

?>

<tr>
  <td width="5%" align="center" valign="top"><div class="iconbox">
	<?php if($rest['taskType']=='Task'){ ?>
	<i class="fa fa-calendar-check-o" aria-hidden="true"></i>
	<?php } ?>
	<?php if($rest['taskType']=='Call'){ ?>
	<i class="fa fa-phone-square" aria-hidden="true"></i>
	<?php } ?>
	<?php if($rest['taskType']=='Meeting'){ ?>
	<i class="fa fa-handshake-o" aria-hidden="true"></i>
	<?php } ?>
	
</div></td>
  <td align="left" valign="top"><a href="display.html?ga=query&view=1&id=<?php echo encode($rest['queryId']); ?>&c=3" target="_blank"><?php echo encode($rest['queryId']); ?></a></td>
  <td align="left" valign="top" style="text-transform:uppercase;"><?php echo (stripslashes($rest['details'])); ?></td>
  <td align="left" valign="top">	<?php if($rest['status']==1){ ?>
	<div style="margin-bottom:5px; font-size:12px; color:#FF0000;<?php if($rest['makeDone']==1){ ?>text-decoration: line-through;<?php } ?>"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo date('d/m/Y - h:i A',strtotime($rest['reminderDate'])); ?> </div>
	<?php } ?></td>
  <td align="left" valign="top">
  <?php if($rest['makeDone']!=1 && date('Y-m-d',strtotime($rest['reminderDate']))>=date('Y-m-d')){ ?> <span class="badge badge-info">Scheduled</span><?php } ?>
  
  <?php if($rest['makeDone']!=1 && date('Y-m-d',strtotime($rest['reminderDate']))<date('Y-m-d')){ ?> <span class="badge badge-danger">Pending</span><?php } ?>
	<?php if($rest['makeDone']==1){ ?> <span class="badge badge-success">Done</span><div style="width:100%; margin-top:2px; font-size:11px;"><?php echo date('d/m/Y - h:i A',strtotime($rest['confirmDate'])); ?></div><?php } ?></td>
  <td align="left" valign="top"><div style="margin-bottom:0px; font-weight:600;"><?php echo getUserNameNew($rest['assignTo']); ?></div>
<div style=" font-weight:600; font-size:11px; color:#999999;"><?php echo displaydateinnumber($rest['dateAdded']); ?></div> </td>
  </tr>


<?php  $totalno++; } ?>
                                          </tbody>
                              </table>
										
										<?php if($totalno==1){ ?>
										<div style="padding:20px; text-align:center;">No Followup Found</div>
										<?php } ?>

							

							</div>
							
							 
							
								<div  class="systemcard" id="querysec">
								<div style=" background-color: #FFFFFF; padding-bottom: 10px; position: relative; ">
							<div style="font-size:16px; font-weight:600; margin-bottom:5px; position:relative;">Queries
							
							<a href="#" onclick="createqueryfromclient('<?php echo $_REQUEST['id']; ?>');" style="position:absolute; right:0px;"><button type="button" class="btn btn-secondary btn-lg waves-effect waves-light" style="margin-bottom: 10px; border-radius:20px; padding: 5px 15px; width: 100%;text-align:left;"><i class="fa fa-plus" aria-hidden="true"></i> Add Query</button></a>
							</div>
							</div>
							
							 <table class="table table-hover mb-0">

                                            <thead>
                                                <tr>
                                                  <th>ID</th>
                                                    <th>Destination</th>
                                                    <th><div align="left">From</div></th>
                                                    <th><div align="left">To</div></th>
                                                    <th>Requirement</th>
                                                    <th>Status</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
<?php

if($LoginUserDetails['userType']!=0){ 

if($LoginUserDetails['showQueryStatus']==0){
$mainwhere=' and (addedBy="'.$_SESSION['userid'].'" or  assignTo="'.$_SESSION['userid'].'")  '; 
}

if($LoginUserDetails['showQueryStatus']==1){
$mainwhere=' and (statusId=5  or statusId=9) '; 
}

if($LoginUserDetails['showQueryStatus']==2){
$mainwhere=' and 1  '; 
}

if($_REQUEST['statusid']==1){ 
//$noteswhere='and id in (select queryId from queryNotes) and statusId=1';
}

if($_REQUEST['statusid']==''){ 
//$noteswhere='and id in (select queryId from queryNotes)';
}

} else {
$mainwhere=' and 1 '; 
}





$totalno='1';
$totalmail='0';
$select='';
$where='';
$rs=''; 
$select='*'; 
$wheremain=''; 
$where=' where   clientId="'.$clientDetails['id'].'" '.$mainwhere.' order by id desc'; 
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 
$targetpage='display.html?ga='.$_REQUEST['ga'].'&keyword='.$_REQUEST['keyword'].'&'; 
$rs=GetRecordList('*','queryMaster','  '.$where.'  ','100',$page,$targetpage);

$totalentry=$rs[1];

$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 
?>

<tr>
  <td><a href="display.html?ga=query&view=1&id=<?php echo encode($rest['id']); ?>" target="_blank" ><?php  echo encode($rest['id']); ?></a></td>
  <td><span style="max-width:180px; overflow:hidden;overflow-wrap: break-word;"><?php
												$string = '';
										$string = preg_replace('/\.$/', '', $rest['destinationId']);  
										$array = explode(',', $string); 
										foreach($array as $value)  
										{ ?>
										<span class="badge badge-boxed  badge-soft-success" style=" background-color: #737373 !important; color:#fff; font-size: 11px; padding: 5px 6px;"><?php echo  getCityName($value); ?></span>
							  <?php }?></span></td>
<td><div align="left"><?php echo date('d-m-Y', strtotime($rest['startDate'])); ?></div></td>
<td><div align="left"><?php echo date('d-m-Y', strtotime($rest['endDate'])); ?></div></td>
<td><?php $rsb=GetPageRecord('*','queryServicesMaster',' id="'.$rest['serviceId'].'"');while($restsource=mysqli_fetch_array($rsb)){  echo stripslashes($restsource['name']); }?></td>
<td><?php echo getstatus($rest['statusId']); ?></td>
<td><?php if(date('d-m-Y', strtotime($rest['dateAdded']))=='01-01-1970'){ echo '-'; } else {  echo date('d-m-Y', strtotime($rest['dateAdded'])); } ?></td>
</tr>


<?php $totalno++; } ?>
                                            </tbody>
                                        </table>
										<?php if($totalno==1){ ?><div style="padding:20px; text-align:center;">No Query Found</div><?php } ?>

							</div>
							
							
							
							
							<div class="systemcard"  id="invoicesec">
								<div style=" background-color: #FFFFFF; padding-bottom: 10px; position: relative; ">
							<div style="font-size:16px; font-weight:600; margin-bottom:5px;">Invoice</div>
							</div>
							
							 <table class="table table-hover mb-0">

                                            <thead>
                                                <tr>
                                                  <th>Invoice ID</th>
                                                    <th width="10%">Amount</th>
                                                    <th width="10%">Received</th>
                                                    <th width="10%">Pending</th>
                                                    <th width="15%"><div align="left">Date</div></th>
                                                    <th width="1%">&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>
<?php

if($LoginUserDetails['userType']!=0){ 

if($LoginUserDetails['showQueryStatus']==0){
$mainwhere=' and (addedBy="'.$_SESSION['userid'].'" or  assignTo="'.$_SESSION['userid'].'")  '; 
}

if($LoginUserDetails['showQueryStatus']==1){
$mainwhere=' and (statusId=5  or statusId=9) '; 
}

if($LoginUserDetails['showQueryStatus']==2){
$mainwhere=' and 1  '; 
}

if($_REQUEST['statusid']==1){ 
//$noteswhere='and id in (select queryId from queryNotes) and statusId=1';
}

if($_REQUEST['statusid']==''){ 
//$noteswhere='and id in (select queryId from queryNotes)';
}

} else {
$mainwhere=' and 1 '; 
}





$totalnoi='1';
$totalmail='0';
$select='';
$where='';
$rs=''; 
$select='*'; 
$wheremain=''; 
$where=' where  queryId in (select id from queryMaster where clientId="'.$clientDetails['id'].'"   '.$mainwhere.')   order by id desc'; 
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 
$targetpage='display.html?ga='.$_REQUEST['ga'].'&keyword='.$_REQUEST['keyword'].'&'; 
$rs=GetRecordList('*','sys_invoiceMaster','  '.$where.'  ','100',$page,$targetpage);

$totalentry=$rs[1];

$paging=$rs[2];  
while($invoiceData=mysqli_fetch_array($rs[0])){ 




$rs13=GetPageRecord('*','sys_packageBuilder','queryId="'.$invoiceData['queryId'].'" and confirmQuote=1');   
$packagedatadetials=mysqli_fetch_array($rs13);
?>

<tr>
  <td><a href="display.html?ga=query&view=1&id=<?php echo encode($invoiceData['queryId']); ?>&c=5" target="_blank" ><?php echo ($invoiceData['invoiceId']);  ?> - <?php echo encode($invoiceData['queryId']);  ?></a></td>
  <td width="10%">&#8377;<?php echo number_format($invoiceData['amount']);  ?></td>
  <td width="10%">&#8377;<?php $ba=GetPageRecord('SUM(amount) as totalrecived','sys_PackagePayment',' queryId="'.$invoiceData['queryId'].'" and packageId="'.$packagedatadetials['id'].'" and paymentStatus=1 '); $packagecostrecived=mysqli_fetch_array($ba); echo number_format($packagecostrecived['totalrecived']); ?></td>
  <td width="10%"><?php echo number_format(round($invoiceData['amount']-$packagecostrecived['totalrecived'])); ?></td>
  <td width="15%"><div align="left"><?php echo date('j M Y',strtotime($invoiceData['invoiceDate']));  ?></div></td>
<td width="1%"><button type="button" onclick="loadpop('View Invoice',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewinvoice&id=<?php echo encode($invoiceData['id']); ?>&queryId=<?php echo encode($invoiceData['queryId']); ?>&packageId=<?php echo encode($packagedatadetials['id']); ?>"  class="btn btn-light btn-sm"> <i class="fa fa-print" aria-hidden="true"></i> </button></td>
</tr>


<?php $totalnoi++; } ?>
                                            </tbody>
                                        </table>
										
										<?php if($totalnoi==1){ ?><div style="padding:20px; text-align:center;">No Invoice Found</div><?php } ?>

							

							</div>
							
							
							
							
							<div class="systemcard"  id="paymentsec">
								<div style=" background-color: #FFFFFF; padding-bottom: 10px; position: relative; ">
							<div style="font-size:16px; font-weight:600; margin-bottom:5px;">Payments</div>
							</div>
							
							 <table class="table table-hover mb-0" style="border:1px solid #ddd;">

                                            <thead>
                                                <tr>
                                                  <th>Query ID </th>
                                                  <th>Payment ID </th>
                                                  <th>Transection ID</th>
                                                  <th>Type</th>
                                                  <th>Amount</th>
                                                  <th>Payment Date</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
<tbody> 
<?php

$totalno=1;
 
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 
$targetpage='display.html?ga='.$_REQUEST['ga'].'&keyword='.$_REQUEST['keyword'].'&searchcity'.$_REQUEST['searchcity'].'&status='.$_REQUEST['status'].'&transectionType='.$_REQUEST['transectionType'].'&'; 
$rs=GetRecordList('*','sys_PackagePayment',' where queryId in (select id from queryMaster where clientId="'.$clientDetails['id'].'"   '.$mainwhere.')  ','100',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($paymentlist=mysqli_fetch_array($rs[0])){ 
 
?>

<tr>
  <td align="left" valign="top"><a href="display.html?ga=query&view=1&id=<?php echo encode($paymentlist['queryId']); ?>&c=5" target="_blank"><?php echo encode($paymentlist['queryId']); ?></a></td>
  <td align="left" valign="top"><?php if($paymentlist['paymentStatus']==1){ echo encode($paymentlist['id']); } else { echo '-'; } ?></td>
  <td align="left" valign="top" style="text-transform:uppercase;"><?php if($paymentlist['paymentId']!=''){  echo ($paymentlist['paymentId']); } else { echo '-'; }  ?></td>
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
										
										<?php if($totalnoi==1){ ?><div style="padding:20px; text-align:center;">No Payment Found</div><?php } ?>

							

							</div>
							
							
							
							<div class="systemcard"  id="documentsec">
								<div style=" background-color: #FFFFFF; padding-bottom: 10px; position: relative;">
							<div style="font-size:16px; font-weight:600; margin-bottom:5px;">Documents</div>
							</div>
							
							 <table class="table table-hover mb-0" style="border:1px solid #ddd;">

                                            <thead>
                                                <tr>
                                                  <th>Query ID</th>
                                                  <th>First Name</th>
                                                  <th>Last Name</th>
                                                  <th>Gender</th>
                                                  <th>Date of Birth </th>
                                                  <th width="1%"><div align="right">Action</div></th>
                                                </tr>
                                            </thead>
<tbody>
<?php 
$totalno=1;
$rs=GetPageRecord('*','sys_guests',' queryId in (select id from queryMaster where clientId="'.$clientDetails['id'].'"   '.$mainwhere.')  order by id desc');
while($rest=mysqli_fetch_array($rs)){

if($rest['firstName']!=''){  
?>

<tr>
  <td align="left" valign="top"><a href="display.html?ga=query&view=1&id=<?php echo encode($rest['queryId']); ?>&c=10" target="_blank"><?php echo encode($rest['queryId']); ?></a></td>
  <td align="left" valign="top"><?php echo stripslashes($rest['submitName']); ?> <?php echo stripslashes($rest['firstName']); ?></td>
  <td align="left" valign="top"><?php echo stripslashes($rest['lastName']); ?></td>
  <td align="left" valign="top"><span style="text-transform:uppercase;"><?php echo stripslashes($rest['gender']); ?></span></td>
  <td align="left" valign="top"><?php echo date('d-m-Y', strtotime($rest['dob'])); ?></td>
  <td width="1%" align="left" valign="top"><div align="right">
  <?php  if (strpos($LoginUserDetails["permissionAddEdit"], 'Guest') !== false) { ?>
  <button type="button" class="btn btn-info btn-sm waves-effect waves-light" onclick="loadpop('Upload Documents',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addGuestDocuments&queryId=<?php echo encode($rest['queryId']); ?>&id=<?php echo encode($rest['id']); ?>" style="margin-bottom:0px; margin-bottom: 0px; margin: 0px 5px;">Document</button>
  
   
  

  <?php } } ?>
  </div>  </td>
</tr>


<?php  $totalno++; } ?>
        </tbody>
      </table>
										
										<?php if($totalno==1){ ?>
										<div style="padding:20px; text-align:center;">No Document Found</div>
										<?php } ?>

							

							</div>
							
							 
							</div>
				 
							   

                         
						
						
						 
						 
                     

             </div>

            <!-- end row -->

    </div>

        <!-- End Page-content -->

         
    </div>
	</div>	</div>