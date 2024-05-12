<?php 
$a=GetPageRecord('*','sys_userMaster','id="'.decode($_REQUEST['id']).'" '); 
$agentinfo=mysqli_fetch_array($a);





if($_REQUEST['id']!=''){

$rs5=GetPageRecord('*','sys_userMaster',' id="'.decode($_REQUEST['id']).'" '); 

$editresult=mysqli_fetch_array($rs5);

}









$rs8=GetPageRecord('SUM(amount) as totalcreditAmt','sys_balanceSheet','agentId="'.$editresult['id'].'" and paymentType="Credit" and offlineAgent=0 '); 

$agentCreditAmt=mysqli_fetch_array($rs8); 



$rs8=GetPageRecord('SUM(amount) as totaldebitAmt','sys_balanceSheet','agentId="'.$editresult['id'].'" and paymentType="Debit" and offlineAgent=0 '); 

$agentDebitAmt=mysqli_fetch_array($rs8); 



$totalwalletBalance=($agentCreditAmt['totalcreditAmt']-$agentDebitAmt['totaldebitAmt']);



 





function getfaretypedisplayname($flightname,$faretype){



$fareType=explode('~',$faretype); 

$fareType=$fareType[1];



if(trim($fareType[1])==''){

$fareType=$faretype;

}



$a=GetPageRecord('*','fareTypeMaster',' 1 and  FIND_IN_SET("'.trim($fareType).'",fareTypeName) and flightName="'.trim($flightname).'" '); 

$datares=mysqli_fetch_array($a); 



if($datares['displayType']!=''){

return stripslashes($datares['displayType']);

}  

}


 

?>


<div class="wrapper">
<div class="container-fluid">
<div class="main-content">

                <div class="page-content">

      
                    <div class="newboxheading">
                      <div class="newhead">Balance Sheet - <?php echo $agentinfo['company']; ?>
                         
 <div class="newoptionmenu">

  
 
 									 
 
  
   
 
    									 
										 
     
   
 <div>
 <button type="button" class="btn btn-secondary btn-lg waves-effect waves-light"  onclick="loadpop('Add Payment',this,'500px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addNewTransaction&agentId=<?php echo $_REQUEST['id']; ?>">Add Balance </button> 
 						 
 </div>
 

  

									
									
  
		  
		  

 </div>
 </div>     
 
     
</div>
                    <!-- start page title -->
                     
              
                      <div style="padding-top: 34px;">
                        <div class="col-md-12 col-xl-12" style="padding-left:0px; padding-right:0px;">
						              <div class="">
                            <div class="card-body" style=" background-color:#FFFFFF;"> 
                                     
                                     
							 
                                        <table class="table table-bordered table-striped" style=" margin-bottom:0px;">

							<thead>

								<tr>

								  <th align="left">Date</th>

								  <th align="left">Reference No.</th>

								  <th align="left">Description</th>

								  <th align="center"><div align="center">Method</div></th>

								  <th align="right"><div align="right">Credit</div></th>

								  <th align="right"><div align="right">Debit</div></th>

								  <th align="right"><div align="right">Running Balance</div></th>

								</tr>

							</thead>

							<tbody> 

<?php

$search='';

if($_REQUEST['fromdate']!='' && $_REQUEST['todate']!=''){

$search.=' and  DATE(addDate)>="'.date('Y-m-d',strtotime($_REQUEST['fromdate'])).'" and  DATE(addDate)<="'.date('Y-m-d',strtotime($_REQUEST['todate'])).'" ';

}



if($_REQUEST['keyword']!=''){

$search.=' and  (bookingId like "%'.decode($_REQUEST['keyword']).'%" ) ';

}

							

$totalCreditAmt=0;

$totalDebitAmt=0;

$balance=0;

								

$limit=clean($_GET['records']);

$page=clean($_GET['page']); 

$sNo=1;

  

$targetpage='display.html?ga=agents&agentCategory='.$_REQUEST['agentCategory'].'&id='.$_REQUEST['id'].'&view=1&fromdate='.$_REQUEST['fromdate'].'&todate='.$_REQUEST['todate'].'&keyword='.$_REQUEST['keyword'].'&'; 



$rs=GetRecordList('*','sys_balanceSheet',' where 1 '.$search.' and agentId="'.decode($_REQUEST['id']).'"  order by id desc  ','25',$page,$targetpage); 

$totalentry=$rs[1]; 

$paging=$rs[2];  

while($agentWebsitePages=mysqli_fetch_array($rs[0])){ 

if($agentWebsitePages['amount']>0){

	

//Opening Balance Debit Amount

$openBalDebited=GetPageRecord('SUM(amount)','sys_balanceSheet',' agentId="'.$agentWebsitePages['agentId'].'" and paymentType="Debit" and id<="'.$agentWebsitePages["id"].'" order by id asc'); 

$openBalDebitedData=mysqli_fetch_array($openBalDebited);

$openBalDebitedAmount = $openBalDebitedData["SUM(amount)"];





//Opening Balance Credit Amount

$openBalCredited=GetPageRecord('SUM(amount)','sys_balanceSheet',' agentId="'.$agentWebsitePages['agentId'].'" and paymentType="Credit" and id<="'.$agentWebsitePages["id"].'" order by id asc'); 

$openBalCreditedData=mysqli_fetch_array($openBalCredited);

$openBalCreditedAmount = $openBalCreditedData["SUM(amount)"];

$balance = round($openBalCreditedAmount-$openBalDebitedAmount);	

	



$totalDebit+=$openBalDebitedAmount;



$totalCredit+=$openBalCreditedAmount;



?>

<tr>

	<td align="left" valign="top"><?php echo date('l d M Y h:i A', strtotime($agentWebsitePages['addDate'])); ?></td>

	<td align="left" valign="top">

	

	

	 

	

	<?php if($agentWebsitePages['transactionId']!=''){ ?><strong><?php echo $agentWebsitePages['transactionId']; ?></strong><?php } else { ?>
	
	
	
	<?php if($agentWebsitePages['bookingId']>0 && $agentWebsitePages['bookingType']=='flight'){
	$b=GetPageRecord('*','flightBookingMaster','id="'.$agentWebsitePages['bookingId'].'" '); 
	$getflightbookingdata=mysqli_fetch_array($b); 
	?>
	<a href="#" onClick="loadpop('View Ticket',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewTicket&id=<?php echo encode($getflightbookingdata['id']); ?>"><strong><?php echo encode($getflightbookingdata['id']); ?></strong> </a> 
	<?php } ?>
	
	
	<?php if($agentWebsitePages['bookingType']=='flight_commision'  || $agentWebsitePages['bookingType']=='flight_GST' || $agentWebsitePages['bookingType']=='RejectBankRefund' || $agentWebsitePages['bookingType']=='TDS'){ ?>
	<strong><?php echo encode($agentWebsitePages['bookingId']); ?></strong>  
	<?php } ?>
	
	
	<?php if( $agentWebsitePages['bookingType']=='bus'){ ?>
	<strong><?php echo encode($agentWebsitePages['bookingId']); ?></strong>  
	<?php } ?>
	
	
	
	<?php if($agentWebsitePages['bookingType']=='hotel'){ 
	

	
	$b=GetPageRecord('*','hotelBookingMaster','BookingNumber="'.$agentWebsitePages['bookingId'].'" '); 
	$gethotelbookingdata=mysqli_fetch_array($b); 
	?>
	<strong><?php echo encode($gethotelbookingdata['id']); ?></strong>  
	<?php } ?><?php } ?>	 </td>

	<td align="left" valign="top">

	<?php 

	if($agentWebsitePages['paymentMethod']=='Refund'){ ?>

		<strong><i class="fa fa-credit-card-alt" aria-hidden="true"></i> Cancellation Charges</strong>

	<?php 

	} else {    

	

	

	if($agentWebsitePages['paymentMethod']!=''  ){ ?>

	<strong><i class="fa fa-credit-card-alt" aria-hidden="true"></i> Wallet Recharge</strong>

	<?php } else { ?>

 

	

	<?php if($agentWebsitePages['bookingType']=='Facilitating' || $agentWebsitePages['bookingType']=='Facilitating_GST'){?>

	

	<?php if($agentWebsitePages['bookingType']=='Facilitating'){ ?>

	<strong style="color:#CC0000;">Facilitating Charges</strong>

	<?php } ?>

	<?php if($agentWebsitePages['bookingType']=='Facilitating_GST'){ ?>

	<strong style="color:#CC0000;">18% GST on Facilitating Charges</strong>

	<?php } ?>

	

	

	<?php } else { ?>

	

	

	

	<?php if( $agentWebsitePages['bookingType']=='flight_GST' || $agentWebsitePages['bookingType']=='flight_commision' || $agentWebsitePages['bookingType']=='TDS' || $agentWebsitePages['bookingType']=='hotel_GST' || $agentWebsitePages['bookingType']=='hotel_commision' || $agentWebsitePages['bookingType']=='hotelTDS' || $agentWebsitePages['bookingType']=='hotelMarkup'){ ?>

	

		

	<?php if($agentWebsitePages['bookingType']=='flight_commision'){ echo '<strong>Flight commission return after detect 18% GST</strong>'; } ?>

	<?php if($agentWebsitePages['bookingType']=='TDS'){ echo '<strong>Flight TDS dedection 5%</strong>'; } ?>

	

	

	 

	 

	<?php if($agentWebsitePages['bookingType']=='hotel_commision'){ echo '<strong>Hotel commission return after detect 18% GST</strong>'; } ?>

	<?php if($agentWebsitePages['bookingType']=='hotelTDS'){ echo '<strong>Hotel TDS dedection 5%</strong>'; } ?>

	

	

	

	

	<?php  } else { ?>

	<?php if($agentWebsitePages['bookingId']>0 && $agentWebsitePages['bookingType']=='flight'){

	$b=GetPageRecord('*','flightBookingMaster','id="'.$agentWebsitePages['bookingId'].'" '); 

	$getflightbookingdata=mysqli_fetch_array($b);

	?>

	Flight: <strong><?php echo stripslashes($getflightbookingdata['flightName']); ?> <?php echo stripslashes($getflightbookingdata['flightNo']); ?></strong><br>

	Destination: <strong><?php echo stripslashes($getflightbookingdata['source']); ?> > <?php echo stripslashes($getflightbookingdata['destination']); ?></strong><br>

	Fare Type: <strong><?php  echo getfaretypedisplayname(stripslashes($getflightbookingdata['flightName']),stripslashes($getflightbookingdata['pcc']));  ?></strong></strong><br>

	Class: <strong><?php echo stripslashes($getflightbookingdata['flightClass']); ?></strong>

	<?php } else { 

	

	if($gethotelbookingdata['HotelName']!=''){

	?>

	Hotel: <strong><?php echo $gethotelbookingdata['HotelName']; ?></strong> <br>

	Room: <strong><?php echo $gethotelbookingdata['RoomType']; ?></strong> <br>
City: <strong><?php echo $gethotelbookingdata['Destination']; ?></strong><br>

Check-In: <strong><?php echo date('d-m-Y',strtotime($gethotelbookingdata['CheckIn'])); ?></strong><br>

Check-Out: <strong><?php echo date('d-m-Y',strtotime($gethotelbookingdata['CheckOutDate'])); ?></strong>

 

 							   

<?php } } ?><?php } ?>



<?php if($agentWebsitePages['bookingType']=='Markup'){ ?><span style="color:#339900; font-weight:600;"><?php echo 'Flight Markup'; ?></span><?php } ?>

<?php if($agentWebsitePages['bookingType']=='hotelMarkup'){ ?><span style="color:#339900; font-weight:600;"><?php echo 'Hotel Markup'; ?></span><?php } ?>

<?php } ?>



<?php if($agentWebsitePages['bookingType']=='RejectBankRefund'){ ?> <strong><?php if($agentWebsitePages['remarks']!=''){ ?><div style="font-size:12px; color:#666666;"><?php echo $agentWebsitePages['remarks']; ?></div><?php } ?></strong> <?php }  ?>

 

<?php } ?>

<?php if($agentWebsitePages['remarks']!=''){ ?><div style="font-size:12px; color:#666666;"><?php echo $agentWebsitePages['remarks']; ?></div><?php } } ?>



</td>

	<td align="center" valign="top"><div align="center">

	<?php  if($agentWebsitePages['paymentType']=='Credit'){ ?> 

	<span class="badge badge-dark"><?php echo strip($agentWebsitePages['paymentMethod']); ?></span>

	<?php }  else { ?>

	 

	<span class="badge badge-primary">Wallet</span>

	<?php } ?>								  

	</div></td>

	<td align="right" valign="top"><div align="right">

	<?php if($agentWebsitePages['paymentType']=='Credit'){ $totalCreditAmt+=$agentWebsitePages['amount']; ?>

	<?php echo strip($agentWebsitePages['amount']); ?> INR

	<?php } ?>

	</div></td>

	<td align="right" valign="top"><div align="right">

	<?php if($agentWebsitePages['paymentType']=='Debit'){ $totalDebitAmt+=$agentWebsitePages['amount']; ?>

	<?php echo strip($agentWebsitePages['amount']); ?> INR

	<?php } ?>

	</div></td>

	

	<td align="right" valign="top"><div align="right"><?php echo strip($balance); ?> INR</div></td>



						      </tr>

								

								<?php } } ?>

								 

								<tr>

								  <td align="right" valign="top" bgcolor="#EBEBEB">&nbsp;</td>

							      <td align="right" valign="top" bgcolor="#EBEBEB">&nbsp;</td>

							      <td align="right" valign="top" bgcolor="#EBEBEB">&nbsp;</td>

							      <td align="center" valign="top" bgcolor="#EBEBEB"><div align="center"><strong>Total</strong>:</div></td>

							      <td align="right" valign="top" bgcolor="#EBEBEB"><div align="right"><strong><?php echo round($agentCreditAmt['totalcreditAmt']); ?> INR</strong></div></td>

							      <td align="right" valign="top" bgcolor="#EBEBEB"><div align="right"><strong><?php echo round($agentDebitAmt['totaldebitAmt']); ?> INR</strong></div></td>

							      <td align="right" valign="top" bgcolor="#EBEBEB"><div align="right"><strong><?php echo round($totalwalletBalance); ?> INR</strong></div></td>

						      </tr>

								<tr>

								  <td colspan="7" valign="top" style="padding:0px;"><div class="card-footer text-right" style="overflow:hidden;width: 100%; ">

		 

										<div style="float: left; font-size: 13px; padding: 7px 11px; border: 1px solid #ededed; background-color: #fff; color: #000;">Total Records: <strong><?php echo $totalentry; ?></strong></div>

											<div class="pagingnumbers"><?php echo $paging; ?></div>

											

						 

			  </div></td>

							  </tr>

							</tbody>

			    </table>
                     
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
function duplicatePackage(id) {
  var result = confirm("Are you sure you want to create duplicate package?");
  if (result==true) {
   $('#ActionDiv').load('actionpage.php?pid='+id+'&action=addduplicatepackage');
  } else {
   return false;
  }
}
</script>