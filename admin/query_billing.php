<?php
$rs13=GetPageRecord('*','sys_packageBuilder','queryId="'.$editresult['id'].'" and confirmQuote=1');   
$packagedatadetials=mysqli_fetch_array($rs13);


$fd=GetPageRecord('*','queryMaster','id="'.decode($_REQUEST['id']).'"'); 
$queryData=mysqli_fetch_array($fd);



$rs13ddd=GetPageRecord('*','sys_packageBuilderEvent',' supplierCancellationDate!="" and  packageId="'.$packagedatadetials['id'].'" order by  supplierCancellationDate desc');   
$packageEvents=mysqli_fetch_array($rs13ddd);

?>

<style>
 
 
.statusbox{margin-right: 5px; padding: 10px; text-align: center; background-color: #000000; font-size: 13px; color: #fff; border-radius: 4px; text-transform:uppercase;}
.conf{width: 100px;
    border: 1px solid #ddd;
    border-radius: 3px;
    padding: 5px;
    text-align: center;}
</style>
<div class=" ">
<div class=" "  >

<?php //if($packagedatadetials['id']>0 && $packageEvents['supplierCancellationDate']!='' && $packageEvents['supplierCancellationDate']!="1970-01-01"){ 

if($packagedatadetials['id']>0){ ?>

<div style="margin-bottom:10px;">
							  <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="14%" align="left" valign="top"><div class="statusbox" style="background-color:#655be6;"><div style="margin-bottom: 0px; font-size: 30px; line-height: 38px;">
	&#8377;<?php $ba=GetPageRecord('*','sys_packageBuilder',' queryId="'.$editresult['id'].'" and confirmQuote=1'); $packagecost=mysqli_fetch_array($ba); echo number_format($packagecost['grossPrice']); ?>
	
	</div>
    Total&nbsp;Amount</div></td>
    <td width="14%" align="left" valign="top"><div class="statusbox" style="background-color:#0cb5b5;">
      <div style="margin-bottom: 0px; font-size: 30px; line-height: 38px;">&#8377;<?php $ba=GetPageRecord('SUM(amount) as totalrecived','sys_PackagePayment',' queryId="'.$editresult['id'].'" and packageId="'.$packagedatadetials['id'].'" and paymentStatus=1 '); $packagecostrecived=mysqli_fetch_array($ba); echo number_format($packagecostrecived['totalrecived']); ?></div>
      Received</div></td>
     
    <td width="14%" align="left" valign="top"><div class="statusbox" style="background-color:#e45555;">
      <div style="margin-bottom: 0px; font-size: 30px; line-height: 38px;">&#8377;<?php echo number_format(round($packagecost['grossPrice']-$packagecostrecived['totalrecived'])); ?></div>Pending</div></td> 
	<td width="16%" align="left" valign="top"><div class="statusbox" style="background-color: #ffffff; color: #000000; font-weight: 600;">
      <div style="margin-bottom: 0px; font-size: 30px; line-height: 38px;">&#8377;<?php $ba=GetPageRecord('SUM(supplierAmount) as totalsupplierAmount','sys_packageBuilderEvent',' packageId="'.$packagedatadetials['id'].'" '); $suppTotalcost=mysqli_fetch_array($ba); echo number_format(round($packagecost['grossPrice']-$suppTotalcost['totalsupplierAmount'])); ?></div>Gross Profit</div></td>
    <td width="14%" align="left" valign="top"><div class="statusbox" style="background-color:#e69f5b;"><div style="margin-bottom: 0px; font-size: 30px; line-height: 38px;">
	&#8377;<?php echo number_format($suppTotalcost['totalsupplierAmount']); ?>
	
	</div>
         Supplier&nbsp;Amount</div></td>
    <td width="14%" align="left" valign="top"><div class="statusbox" style="background-color:#71b183;">
      <div style="margin-bottom: 0px; font-size: 30px; line-height: 38px;">&#8377;<?php $ba=GetPageRecord('SUM(paidAmount) as totalrecived','sys_packageBuilderEvent',' packageId="'.$packagedatadetials['id'].'" '); $suppcostrecived=mysqli_fetch_array($ba); echo number_format($suppcostrecived['totalrecived']); ?></div>
      Supplier&nbsp;Received</div></td>
    <td width="14%" align="left" valign="top"><div class="statusbox" style="background-color:#ae8393;">
      <div style="margin-bottom: 0px; font-size: 30px; line-height: 38px;">&#8377;<?php echo number_format(round($suppTotalcost['totalsupplierAmount']-$suppcostrecived['totalrecived'])); ?></div>
      Supplier&nbsp;Pending</div></td>
    
  </tr>
</table>

  </div>
  
   
 
<div class="col-lg-12" style=" padding: 0px; "> 
<h4 class="mt-0 header-title" style="border-bottom:0px; position:relative;">Payments (<?php $ba=GetPageRecord('count(id) as totalpayments','sys_PackagePayment',' queryId="'.$editresult['id'].'" and packageId="'.$packagedatadetials['id'].'" and paymentStatus!=0'); $packagecostrecivedpayment=mysqli_fetch_array($ba); echo number_format($packagecostrecivedpayment['totalpayments']); ?>)

<a onclick="loadpop('Send Payment Plan To Mail',this,'400px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=sendSelectedPaymentPlanToMail&queryId=<?php echo $_REQUEST['id']; ?>&packageId=<?php echo encode($packagedatadetials['id']); ?>" style="position: absolute; font-size: 12px; font-weight: 600; right: 5px; top:2px; background-color: #005ee2; color: #fff; padding: 2px 10px; border-radius: 3px; cursor: pointer;">Send Payment Plan To Mail</a>

</h4>
<form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">	
 <div class="card"> 
<div class="card-body" style="padding:10px !important;"><table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC"  style=" font-size:12px;">

                                            <thead>
                                                <tr>
                                                  <th>Payment&nbsp;ID</th>
                                                  <th>Trans.&nbsp;ID</th>
                                                  <th>Type</th>
                                                  <th>Amount</th>
                                                  <th>Payment&nbsp;Date</th>
                                                    <th>Status</th>
                                                    <th align="center">&nbsp;</th>
                                                    <th align="center"  style="display:none;">&nbsp;</th>
                                                    <th align="center">Convenience Fee</th>
                                                    <th>Receipt</th>
                                                    <th><div align="right">Action</div></th>
                                                </tr>
                                            </thead>
<tbody>
<?php 
$totalpendingamountcount=0;
$totalno=1;
$rs=GetPageRecord('*','sys_PackagePayment',' queryId="'.$editresult['id'].'" and packageId="'.$packagedatadetials['id'].'" and paymentStatus!=0 order by paymentDate asc');
while($paymentlist=mysqli_fetch_array($rs)){ 
?>

<tr style=" <?php if($paymentlist['paymentStatus']==1){ ?> background-color: #e4fff9;<?php } ?>">
  <td align="left" valign="top"><?php if($paymentlist['paymentStatus']==1){ echo encode($paymentlist['id']); } else { echo '-'; } ?></td>
  <td align="left" valign="top" style="text-transform:uppercase;"><?php if($paymentlist['paymentId']!=''){  echo ($paymentlist['paymentId']); } else { echo '-'; }  ?></td>
  <td align="left" valign="top"><?php if($paymentlist['paymentId']!=''){  ?><span class="badge badge-dark"><?php echo ($paymentlist['transectionType']); ?></span><?php } ?></td>
  <td align="left" valign="top">&#8377;<?php echo ($paymentlist['amount']); $totalpendingamountcount+=$paymentlist['amount']; ?></td>
  <td align="left" valign="top"><?php if($paymentlist['paymentStatus']==1){ echo date('d/m/Y - h:i A',strtotime($paymentlist['paymentDate'])); } else { echo date('d/m/Y',strtotime($paymentlist['paymentDate']));  } ?> </td>
  <td align="left" valign="top"><?php if($paymentlist['paymentStatus']==1){ ?><span class="badge badge-success">Paid</span><?php } ?>
  
  <?php if(date('Y-m-d H:i:s',strtotime($paymentlist['paymentDate']))>=date('Y-m-d H:i:s')){  if($paymentlist['paymentStatus']==2){ ?><span class="badge badge-warning">Scheduled</span><?php } } else { if($paymentlist['paymentStatus']==2){ ?>
  <span class="badge badge-danger">Overdue</span>
  <?php } } ?>  </td>
  <td align="center" valign="top">
<?php if (strpos($LoginUserDetails["permissionAddEdit"], 'Billing') !== false) { ?>
  
  <?php if($paymentlist['paymentStatus']!=1){ ?><button type="button" class="btn btn-info btn-sm waves-effect waves-light" onclick="loadpop('Send Payment Link',this,'400px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=sendpaymentlink&pid=<?php echo encode($packagedatadetials['id']); ?>&qid=<?php echo encode($editresult['id']); ?>&id=<?php echo encode($paymentlist['id']); ?>&amt=<?php echo ($paymentlist['amount']); ?>&sendlink=1" style="margin-bottom:0px; float:right; width: 100%;"><?php if($paymentlist['paymentLinkDate']==''){ ?>Send Link<?php }else{ ?>Re-Send Link<?php } ?></button>
   <br />
<?php if($paymentlist['paymentLinkDate']!='' && $paymentlist['paymentLinkDate']!='1970-01-01'){ ?><div style="width:100%; margin-top:2px; float:left;font-size: 10px;"><?php echo date('d-m-Y - h:i A',strtotime($paymentlist['paymentLinkDate'])); ?></div><?php } } ?>
<?php } ?></td>
  <td align="center" valign="top"  style="display:none;"><?php if (strpos($LoginUserDetails["permissionAddEdit"], 'Billing') !== false) { ?>
  
  <?php if($paymentlist['paymentStatus']!=1){ ?>
  <button type="button" class="btn btn-info btn-sm waves-effect waves-light" onclick="loadpop('Send Without Link',this,'400px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=sendpaymentWithoutLink&pid=<?php echo encode($packagedatadetials['id']); ?>&qid=<?php echo encode($editresult['id']); ?>&id=<?php echo encode($paymentlist['id']); ?>&amt=<?php echo ($paymentlist['amount']); ?>" style="margin-bottom:0px; float:right;"><?php if($paymentlist['paymentWithoutLinkDate']==''){ ?>Send Payment Details<?php }else{ ?>Re-Send Payment Details<?php } ?></button> 
  
   <br />
<?php if($paymentlist['paymentWithoutLinkDate']!='' && $paymentlist['paymentWithoutLinkDate']!='1970-01-01'){ ?>
<div style="width:100%; font-size:12px; margin-top:2px; float:left;"><?php echo date('d-m-Y - h:i A',strtotime($paymentlist['paymentWithoutLinkDate'])); ?>	</div>
<?php } } else { ?>

	<button type="button" class="btn btn-info btn-sm waves-effect waves-light" onclick="loadpop('Send Without Link',this,'400px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=sendpaymentWithoutLink&pid=<?php echo encode($packagedatadetials['id']); ?>&qid=<?php echo encode($editresult['id']); ?>&id=<?php echo encode($paymentlist['id']); ?>&amt=<?php echo ($paymentlist['amount']); ?>&acn=1" style="margin-bottom:0px; float:right;"><?php if($paymentlist['paymentWithoutLinkDate']==''){ ?>Send Payment Details<?php }else{ ?>Re-Send Payment Details<?php } ?></button>
	
	
   <br />
<?php if($paymentlist['paymentWithoutLinkDate']!='' && $paymentlist['paymentWithoutLinkDate']!='1970-01-01'){ ?>
<div style="width:100%; font-size:12px; margin-top:2px; float:left;"><?php echo date('d-m-Y - h:i A',strtotime($paymentlist['paymentWithoutLinkDate'])); ?>	</div>

<?php } ?>
<?php }  }?></td>
  <td align="center" valign="top"><?php if($paymentlist['paymentStatus']!=1){ ?><input type="number" min="0" name="conFee" id="conFee<?php echo encode($paymentlist['id']); ?>" class="conf" placeholder="Convenience Fee" value="<?php echo ($paymentlist['conFee']); ?>" onkeyup="confeefun('<?php echo encode($paymentlist['id']); ?>');" /><?php } ?></td>
  <td align="left" valign="top"><?php if($paymentlist['receiptFile']!=''){ ?><a href="<?php echo $fullurl; ?>package_image/<?php echo $paymentlist['receiptFile']; ?>" target="_blank">Download</a><?php } ?></td>
  <td align="left" valign="top"><div style=" width: 100px; float:right;"><?php if($paymentlist['paymentStatus']!=1){ ?><div align="right">
 <?php if (strpos($LoginUserDetails["permissionAddEdit"], 'Billing') !== false) { ?>  <?php if($paymentlist['paymentBy']==0 && $paymentlist['paymentId']!=''){ } else { ?>
 
 
 
  <button type="button" class="btn btn-info btn-sm waves-effect waves-light" onclick="loadpop('Schedule Payment',this,'400px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=schedulepayment&payment=<?php echo (round($packagecost['grossPrice']-$packagecostrecived['totalrecived'])); ?>&queryId=<?php echo $_REQUEST['id']; ?>&packageId=<?php echo encode($packagedatadetials['id']); ?>&id=<?php echo encode($paymentlist['id']); ?>" style="margin-bottom:0px; float:right;">Edit</button>
  
  
  <?php } }  ?>
  </div><?php }  ?>&nbsp;<?php   if($_SESSION['userid']==1){ ?><button type="button" class="btn btn-danger btn-sm waves-effect waves-light" onclick="deletebill('<?php echo encode($paymentlist['id']); ?>');" style="margin-bottom:0px; float:right; margin-right: 3px;">Delete</button><?php } ?> <?php if($paymentlist['paymentStatus']==1){ ?><a class="btn btn-info btn-sm waves-effect waves-light" href="<?php echo $fullurl; ?>download-payment-receipt.html?id=<?php echo encode($paymentlist['id']); ?>" target="_blank">Payment&nbsp;Receipt</a>
  <?php $payreceipt=$fullurl.'download-payment-receipt.html?id='.encode($paymentlist['id']); ?>
  <?php } ?></div></td>
</tr>



<?php  $totalno++; } ?>

<tr style=" <?php if($paymentlist['paymentStatus']==1){ ?> background-color: #e4fff9;<?php } ?>">
  <td colspan="3" align="right" valign="top"><strong>Not Scheduled Amount: </strong></td>
  <td align="left" valign="top"><strong>&#8377;<?php echo $packagecost['grossPrice']-$totalpendingamountcount; ?></strong></td>
  <td colspan="7" align="right" valign="top"><?php if (strpos($LoginUserDetails["permissionAddEdit"], 'Billing') !== false) { ?>
<?php if(($packagecost['grossPrice']-$totalpendingamountcount)>0){ ?><button type="button" class="btn btn-pink btn-sm waves-effect waves-light" onclick="loadpop('Create Payment Plan',this,'400px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=schedulepayment&payment=<?php if($totalno==1){ echo (round($packagecost['grossPrice']-$packagecostrecived['totalrecived'])); } else { echo ($packagecost['grossPrice']-$totalpendingamountcount); }?>&queryId=<?php echo $_REQUEST['id']; ?>&packageId=<?php echo encode($packagedatadetials['id']); ?>&addpay=1" style="margin-bottom:0px; float:right;">Schedule Payment</button><?php } ?>
<?php } ?></td>
  </tr>

        </tbody>
      </table>
	  </div>
	  </div>
							  
<input name="action" type="hidden" id="action" value="sendSelectedPaymentPlanToMail" />  
<input name="queryId" type="hidden"  value="<?php echo $_REQUEST['id']; ?>" />
<input name="packageId" type="hidden"  value="<?php echo encode($packagedatadetials['id']); ?>" />  
<?php if($totalno>1){ ?>
<div style="overflow: hidden; width: 100%; margin-top: 10px; display:none;">   
<table border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td><!--<input name="Save" type="submit" value="Send Payment Plan To Mail"   id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" style="float:left;"  />--> </td>
    <td>&nbsp;&nbsp;
      <?php if($queryData['sendPaymentPlanDate']!='' && $queryData['sendPaymentPlanDate']!='1970-01-01'){ ?>Email Date: <?php echo date('d-m-Y - h:i A',strtotime($queryData['sendPaymentPlanDate'])); ?><?php } ?></td>
  </tr>
</table>

</div>
<?php } ?>
</form>
</div>
			
				
 		
 
<div > 
<h4 class="mt-0 header-title" style="border-bottom:0px; overflow:hidden;">&nbsp;</h4>
<?php
$totalno=1;
$rsa=GetPageRecord('*','sys_invoiceMaster',' queryId="'.$editresult['id'].'" and packageId="'.$packagedatadetials['id'].'"  order by id desc');
while($invoiceData=mysqli_fetch_array($rsa)){ 
?>
<div class="card"> 
<div class="card-body" style="padding:10px !important;"> 
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="5%" align="center"><i class="fa fa-file-text" aria-hidden="true" style="font-size:40px; color:#0066CC;"></i></td>
    <td colspan="2" align="left" style="padding-left:10px;"><div style="color:#666666; margin-bottom:0px;">Invoice - <?php echo date('j M Y',strtotime($invoiceData['invoiceDate']));  ?></div>
      <div style="color:#000; font-size:20px;"><?php echo ($invoiceData['invoiceId']);  ?></div></td>
    <td align="right"> 
<button  onclick="loadpop('View Invoice',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewinvoice&id=<?php echo encode($invoiceData['id']); ?>&queryId=<?php echo encode($editresult['id']); ?>&packageId=<?php echo encode($packagedatadetials['id']); ?>" type="button" class="btn btn-primary waves-effect waves-light">View Invoice</button> 
 </td>
  </tr>
</table>

</div>
</div>
<?php $totalno++; } ?>
<?php if($totalno==1){ ?>
<?php if (strpos($LoginUserDetails["permissionAddEdit"], 'Billing') !== false) { ?>
<div style="text-align:center; padding:10px;">
<div style="margin-bottom:10px;">No Invoice Found</div> 
<a target="actoinfrm"  href="actionpage.php?action=genrateinvoice&queryId=<?php echo encode($editresult['id']); ?>&packageId=<?php echo encode($packagedatadetials['id']); ?>&amount=<?php $ba=GetPageRecord('*','sys_packageBuilder',' queryId="'.$editresult['id'].'" and confirmQuote=1'); $packagecost=mysqli_fetch_array($ba); echo trim($packagecost['grossPrice']); ?>">
<button type="button" class="btn btn-primary waves-effect waves-light">Genrate Invoice</button> 
</a>
</div>			  
<?php }  } ?>
<?php } else {  ?>

<div style="text-align:center; font-size:16px; padding:30px; color:#999999; "><div style="text-align:center; font-size:60px;"><i class="fa fa-briefcase" aria-hidden="true"></i></div>No itinerary confirmed or supplier's cancellation date not entered</div>
<?php } ?>

 
				   
  </div>		   
</div>
							  <div id="saveconfee" style="display:none;"></div>
							  <script>
							  function confeefun(id){
							  	var conFee = $('#conFee'+id).val();
								 
							  	$('#saveconfee').load('actionpage.php?action=saveconfee&id='+id+'&conFee='+conFee+'&queryId=<?php echo $_REQUEST['id']; ?>');
							  }
							  
							  function deletebill(id){
							  
							  	if(confirm('Are you sure want to delete?')){
									$('#saveconfee').load('actionpage.php?action=deletebill&parentId=<?php echo $_REQUEST['id']; ?>&id='+id);
								}
							  
							  }
							  </script>
							   