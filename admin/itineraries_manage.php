 

<div style="margin-left: 65px; margin-right: 25px; padding-top: 10px !important; padding-bottom: 10px;">
<div class="main-content">
<div class="page-content">



<div class="row">

 
<div class="col-md-12 col-xl-12">
<h4><?php echo stripslashes($result['name']); ?><span style="color: #353535; font-size: 14px; margin-top: 2px; float: right;"><?php echo stripslashes($result['destinations']); ?> - Adult: <?php echo stripslashes($result['adult']); ?> | Child: <?php echo stripslashes($result['child']); ?></span></h4>

 
	 

</div>
</div>

</div>
</div>
</div>

<div class="container-fluid">
<div class="main-content">

                <div class="page-content">

      
                    
                    <!-- start page title -->
                     
              
                        <div class=" ">
                        <div class="col-md-12 col-xl-12">
						<div class="card">
                            <div class="card-body" style="padding:10px;" >  
                                     
							 <form class="custom-validation" action="frmaction.html" id="billingformsave" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">
                                        <table class="table table-hover mb-0">

                                            <thead>
                                                <tr>
                                                  <th width="1%">&nbsp;</th>
                                                    <th>Item</th>
                                                    <th>Type</th>
                                                    <th><?php if (strpos($LoginUserDetails["permissionView"], 'PackagePrice') !== false) { ?><div align="right">Net</div><?php } ?></th>
                                                    <th><?php if (strpos($LoginUserDetails["permissionView"], 'PackagePrice') !== false) { ?><div align="center">Markup</div><?php } ?></th>
                                                    <th width="10%"><?php if (strpos($LoginUserDetails["permissionView"], 'PackagePrice') !== false) { ?>
                                                  <div align="right">Gross</div><?php } ?></th>
                                                    <th>&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>
<?php
$netflightcosting=0;
$totalnetCost=0;
$totalGross=0;

$rs=GetPageRecord('*','sys_packageBuilderEvent',' packageId="'.$result['id'].'" and sectionType!="Leisure" order by packageDays,time(checkIn) asc');
while($rest=mysqli_fetch_array($rs)){ 
$netCost=0;
$markupValue=0;
$gross=0;
?>

<?php if($rest['sectionType']!='' ){   ?>

<tr>
  <td width="1%"><div class="bulbblue" style="background-color:#343642; margin-right:0px;"><i class="fa <?php if($rest['sectionType']=='Accommodation'){ ?>fa-bed<?php } ?><?php if($rest['sectionType']=='Activity'){ ?>fa-blind<?php } ?><?php if($rest['sectionType']=='Transportation'){ ?>fa-car<?php } ?><?php if($rest['sectionType']=='FeesInsurance'){ ?>fa-credit-card<?php } ?><?php if($rest['sectionType']=='Meal'){ ?>fa-cutlery<?php } ?><?php if($rest['sectionType']=='Flight'){ ?>fa-plane<?php } ?>" aria-hidden="true"></i></div></td>
<td style=" font-weight: 700; cursor:pointer;" <?php if (strpos($LoginUserDetails["permissionView"], 'PackagePrice') !== false) { ?> onclick="loadpop('Edit Pricing',this,'400px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=editpricing&id=<?php echo encode($rest['id']); ?>&pid=<?php echo $_REQUEST['id']; ?>&sectionType=<?php echo $rest['sectionType']; ?>&transfertype=<?php echo $rest['transferCategory']; ?>" <?php } ?> ><?php echo stripslashes($rest['name']); ?><?php if($rest['sectionType']=='Accommodation'){ ?>
<span style="color:#FF9900; padding-left:10px;"><?php echo starcategory($rest['hotelCategory']); ?></span> 

<div style="color: #989898; font-size: 11px; padding-top: 4px; font-weight: 800; text-transform: uppercase;"><?php echo stripslashes($rest['hotelRoom']); ?> - <?php echo date('d-m-Y',strtotime($rest['startDate'])); ?> To <?php echo date('d-m-Y',strtotime($rest['endDate'])); ?></div>

<?php } else { ?>


<div style="color: #989898; font-size: 11px; padding-top: 4px; font-weight: 800; text-transform: uppercase;"><?php echo date('d-m-Y',strtotime($rest['startDate'])); if($rest['sectionType']!='FeesInsurance'){ ?> - <i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo date('g:i A',strtotime($rest['checkIn']));  ?> to <?php echo date('g:i A',strtotime($rest['checkOut']));  ?> <?php   } if (strpos($LoginUserDetails["permissionView"], 'PackagePrice') !== false) { if($rest['transferCategory']=='Private'){ ?> - <strong>Vehicle: </strong><?php echo stripslashes($rest['vehicle']); } } ?></div>


<?php } ?></td>
<td><?php if($rest['sectionType']=='FeesInsurance'){ echo 'Fees - Insurance'; } else {  echo $rest['sectionType'];  } if($rest['transferCategory']!=''){ echo ' - '.$rest['transferCategory']; } ?></td>
<td>  
    <div align="right">
      <?php if (strpos($LoginUserDetails["permissionView"], 'PackagePrice') !== false) { ?>&#8377; <?php } ?><?php

if($rest['sectionType']=='Accommodation'){
if (strpos($LoginUserDetails["permissionView"], 'PackagePrice') !== false) {
echo $netCost=round($rest['singleRoomCost']*$rest['singleRoom'])+($rest['doubleRoomCost']*$rest['doubleRoom'])+($rest['tripleRoomCost']*$rest['tripleRoom'])+($rest['quadRoomCost']*$rest['quadRoom'])+($rest['cwbRoomCost']*$rest['cwbRoom'])+($rest['cnbRoomCost']*$rest['cnbRoom']);
}else{
$netCost=round($rest['singleRoomCost']*$rest['singleRoom'])+($rest['doubleRoomCost']*$rest['doubleRoom'])+($rest['tripleRoomCost']*$rest['tripleRoom'])+($rest['quadRoomCost']*$rest['quadRoom'])+($rest['cwbRoomCost']*$rest['cwbRoom'])+($rest['cnbRoomCost']*$rest['cnbRoom']);
}
} else { 

if($rest['transferCategory']=='Private'){
if (strpos($LoginUserDetails["permissionView"], 'PackagePrice') !== false) {
echo $netCost=round($rest['vehicle']*$rest['adultCost']);
}else{
$netCost=round($rest['vehicle']*$rest['adultCost']);
}
} else {
if (strpos($LoginUserDetails["permissionView"], 'PackagePrice') !== false) {
echo $netCost=round($rest['adultCost']*$result['adult'])+($rest['childCost']*$result['child']);
}else{
$netCost=round($rest['adultCost']*$result['adult'])+($rest['childCost']*$result['child']);
}
if($rest['sectionType']=='Flight'){
$netflightcosting=$netCost+$netflightcosting;
}


}
 
}




$totalnetCost=$netCost+$totalnetCost;

$markupValue=($rest['markupPercent']*$netCost/100);
$gross=round($netCost+$markupValue);

$totalGross=$gross+$totalGross;
 ?>
      </div></td>
<td><?php if (strpos($LoginUserDetails["permissionView"], 'PackagePrice') !== false) { ?><div align="center"><?php echo ($rest['markupPercent']); ?>%</div><?php } ?></td>
<td width="10%"> <div align="right"><?php if (strpos($LoginUserDetails["permissionView"], 'PackagePrice') !== false) { ?>&#8377;<?php echo $gross; ?><?php }else{ $gross; } ?></div></td>
<td> <?php if (strpos($LoginUserDetails["permissionView"], 'PackagePrice') !== false) { ?><div class="">
                                            <button type="button" class="optionmenu" data-toggle="dropdown" aria-expanded="false">
                                         <i class="mdi mdi-dots-vertical"></i>                                            </button>
                                            <div class="dropdown-menu" style=""><a class="dropdown-item"  style="cursor:pointer;" onclick="loadpop('Edit Pricing',this,'400px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=editpricing&id=<?php echo encode($rest['id']); ?>&pid=<?php echo $_REQUEST['id']; ?>&sectionType=<?php echo $rest['sectionType']; ?>&transfertype=<?php echo $rest['transferCategory']; ?>">Edit Pricing</a>												</div>
                                        </div> <?php } ?></td>
</tr>


<?php $totalno++; } } ?>



<tr style=" border-top:2px solid #ededed;border-bottom:2px solid #ededed; font-size:18px; font-weight:700;background-color: #00000008;">
  <td colspan="2" align="left"><table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"><select name="billingType" id="billingType" style=" <?php //if($result['queryId']>0){ ?>display:none1;<?php //} ?>font-size: 14px; padding: 8px; border: 1px solid #b9b9b9; border-radius: 5px; font-weight: 600;" onchange="changebillingtype();">
    <option value="1" <?php if($result['billingType']==1){ ?>selected="selected"<?php } ?>>Total price</option>
   <option value="2" <?php if($result['billingType']==2){ ?>selected="selected"<?php } ?>>Price per traveller</option> 
  </select></td>
    <td style="padding-left:10px;"><select name="gstType" id="gstType" style=" font-size: 14px; padding: 8px; border: 1px solid #b9b9b9; border-radius: 5px; font-weight: 600;" onchange="changebillingtype();">
    <option value="0" <?php if($result['gstType']==0){ ?>selected="selected"<?php } ?>>GST On Total</option>
   <option value="1" <?php if($result['gstType']==1){ ?>selected="selected"<?php } ?>>GST On Markup</option> 
  </select></td>
  </tr>
  
</table>

  <?php if($result['billingType']==1){ 
  $totalnetCost=$totalnetCost;
  $totalGross=$totalGross;  
    $totalnetCostview=$totalnetCost;
  $totalGrossview=$totalGross; 
   
   }  else { 
     $totalnetCostview=$totalnetCost;
  $totalGrossview=$totalGross; 
   
	$totalnetCost=round($totalnetCost/($result['adult']+$result['child']));
	$totalGross=round($totalGross/($result['adult']+$result['child'])); 
	 
   }
   

   ?>  
   
   
   <script>
   function changebillingtype(){
   var billingType = $('#billingType').val();
   var gstType = $('#gstType').val();
   $('#ActionDiv').load('actionpage.php?action=updatebillingtype&pid=<?php echo encode($result['id']); ?>&billingType='+billingType+'&gstType='+gstType);
   }
   
   </script>   </td>
<td colspan="2"><?php if (strpos($LoginUserDetails["permissionView"], 'PackagePrice') !== false) { ?><div align="right"><span style="font-size:13px; color:#666666;"><?php if($result['billingType']==1){ echo 'Total Net'; } else { echo 'Per Person Net'; } ?>
  <br />
</span>&#8377;<?php echo $totalnetCost; ?></div><?php } ?></td>
<td><?php if (strpos($LoginUserDetails["permissionView"], 'PackagePrice') !== false) { ?><div align="center"><span style="font-size:13px; color:#666666;">% Markup
</span><br />
  &#8377;<?php echo ($totalGross-$totalnetCost); ?></div><?php }else{ ($totalGross-$totalnetCost); } ?></td>
<td width="10%"><div align="right"><span style="font-size:13px; color:#666666;">Extra Markup</span><br />
    <?php if($result['extraMarkup']>0){ echo '&#8377;'.($result['extraMarkup']); }else{ echo ($result['baseMarkup']).'%'; } ?></div>
	
	<a style="padding: 2px 10px; font-size: 12px; background-color: #059a7f; color: #fff !important; border-radius: 2px; top: -3px; position: relative; cursor:pointer; float:right;"  onclick="loadpop('Add Extra Markup',this,'400px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=packageextramarkup&pid=<?php echo $_REQUEST['id']; ?>"><i class="fa fa-pencil" aria-hidden="true"></i> Update</a>	</td>
<td align="right"><div align="right"><span style="font-size:13px; color:#666666;"><?php if($result['billingType']==1){ echo 'Total'; } else { echo 'Per Person'; } ?></span><br />&#8377;<?php echo $total=(($totalGross/100*$result['baseMarkup'])+$totalGross)+($result['extraMarkup']); ?></div></td>
</tr>
<?php
$totalcgst=0;
$totalsgst=0;
$totaligst=0;
if($result['gstType']==0){
if($result['cgst']>0){ $totalcgst=round($total*$result['cgst']/100); }
if($result['sgst']>0){ $totalsgst=round($total*$result['sgst']/100); }
if($result['igst']>0){ $totaligst=round($total*$result['igst']/100); }
}

if($result['gstType']==1){
$totalmarkup=(round($totalGross/100*$result['baseMarkup']))+($result['extraMarkup']);

if($result['cgst']>0){ $totalcgst=round($totalmarkup*$result['cgst']/100); }
if($result['sgst']>0){ $totalsgst=round($totalmarkup*$result['sgst']/100); }
if($result['igst']>0){ $totaligst=round($totalmarkup*$result['igst']/100); }
}

 ?>
<tr style=" border-top:1px solid #ededed;border-bottom:1px solid #ededed; font-size:15px; ">
  <td colspan="2" align="left">&nbsp;</td>
  <td colspan="2">&nbsp;</td>
  <td align="center"><table border="0" cellspacing="0" cellpadding="0">
  <tr>
   <td align="left" style="border-top:0px;"><input name="showcgst" type="checkbox" value="1" <?php if($result['showcgst']==1){ ?> checked="checked" <?php } ?> /></td>
    <td align="right" style="border-top:0px;">Show</td>
  </tr>
</table></td>
  <td width="10%" align="right"><table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="border-top: 0px;">CGST&nbsp;%</td>
    <td style="border-top: 0px;"><input name="cgst" type="number" min="0" class="form-control" id="cgst" value="<?php echo stripslashes($result['cgst']); ?>" style="width:80px;"></td>
  </tr>
  
</table> </td>
  <td align="right"  style="font-size:18px;">&#8377;<?php echo $totalcgst; ?></td>
</tr>
<tr style=" border-top:1px solid #ededed;border-bottom:1px solid #ededed; font-size:15px; ">
  <td colspan="2" align="left">&nbsp;</td>
  <td colspan="2">&nbsp;</td>
  <td align="center"><table border="0" cellspacing="0" cellpadding="0">
  <tr>
   
    <td align="left" style="border-top:0px;"><input name="showsgst" type="checkbox" value="1" <?php if($result['showsgst']==1){ ?> checked="checked" <?php } ?> /></td>
	 <td align="right" style="border-top:0px;">Show</td>
  </tr>
</table></td>
  <td width="10%" align="right"><table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="border-top: 0px;">SGST&nbsp;%</td>
    <td style="border-top: 0px;"><input name="sgst" type="number" min="0" class="form-control" id="sgst" value="<?php echo stripslashes($result['sgst']); ?>" style="width:80px;"></td>
  </tr>
  
</table></td>
  <td align="right"  style="font-size:18px;">&#8377;<?php echo $totalsgst; ?></td>
</tr>
<tr style=" border-top:1px solid #ededed;border-bottom:1px solid #ededed; font-size:15px; ">
  <td colspan="2" align="left">&nbsp; </td>
  <td colspan="2">&nbsp;</td>
  <td align="center"><table border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td align="left" style="border-top:0px;"><input name="showigst" type="checkbox" value="1" <?php if($result['showigst']==1){ ?> checked="checked" <?php } ?> /></td>
    <td align="right" style="border-top:0px;">Show</td>
  </tr>
</table></td>
  <td width="10%" align="right"><table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="border-top: 0px;">IGST&nbsp;%</td>
    <td style="border-top: 0px;"><input name="igst" type="number" min="0" class="form-control" id="igst" value="<?php echo stripslashes($result['igst']); ?>" style="width:80px;"></td>
  </tr>
  
</table></td>
  <td align="right"  style="font-size:18px;"><strong>&#8377;<?php echo $totaligst; ?></strong></td>
</tr>
<tr style=" border-top:1px solid #ededed;border-bottom:1px solid #ededed; font-size:15px; ">
  <td colspan="2" align="left">&nbsp;</td>
  <td colspan="2">&nbsp;</td>
  <td align="center"><table border="0" cellspacing="0" cellpadding="0">
  <tr>
  
    <td align="left" style="border-top:0px;"><input name="showtcs" type="checkbox" value="1" <?php if($result['showtcs']==1){ ?> checked="checked" <?php } ?> /></td>
	  <td align="right" style="border-top:0px;">Show</td>
  </tr>
</table></td>
  <td width="10%" align="right"><table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="border-top: 0px;">TCS &nbsp;%</td>
    <td style="border-top: 0px;"><input name="tcsPercent" type="number" min="0" class="form-control" id="tcsPercent" value="<?php echo stripslashes($result['tcsPercent']); ?>" style="width:80px;"></td>
  </tr>
  
</table></td>
  <td align="right"  style="font-size:18px;"><strong>&#8377;<?php 
  if($result['billingType']==1){
  echo $totaltcs=round(($totalnetCost-$netflightcosting)*$result['tcsPercent']/100);
  } else { 
  echo $totaltcs=round(($totalnetCost-($netflightcosting/($result['adult']+$result['child'])))*$result['tcsPercent']/100);
  }
  
   ?></strong></td>
</tr>
<tr style=" border-top:1px solid #ededed;border-bottom:2px solid #ededed; font-size:15px; ">
  <td colspan="5" align="left">&nbsp;</td>
  <td width="10%" align="right">
  <table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="border-top: 0px;">Discount</td>
    <td style="border-top: 0px;"><input name="totalDiscount" type="number" min="0" class="form-control" id="totalDiscount" value="<?php echo stripslashes($result['totalDiscount']); ?>" style="width:80px;"></td>
  </tr>
</table>   </td>
  <td align="right" style="font-size:18px;"><strong>&#8377;<?php echo $result['totalDiscount']; ?></strong></td>
</tr>
<tr style=" border-top:1px solid #ededed;border-bottom:2px solid #ededed; font-size:15px;background-color: #00000008; ">
  <td colspan="5" align="right">
  
  <table border="0" align="right" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2">Show Price In:</td>
	
	
	
    <td><select name="convertedCurrency" id="convertedCurrency" style=" font-size: 14px; padding: 8px; border: 1px solid #b9b9b9; border-radius: 5px; font-weight: 600; width:100px;" onchange="$('#changecussyes').val('1');$('#billingformsave').submit();">
  <?php
  
  $rs=GetPageRecord('*','currencyExchangeMaster',' status=1 order by id asc');
while($restcurr=mysqli_fetch_array($rs)){ 
?> 
    <option value="<?php echo $restcurr['name']; ?>" <?php if($result['convertedCurrency']==$restcurr['name']){ ?>selected="selected"<?php } ?>><?php echo $restcurr['name']; ?></option>  
	<?php } ?>
	
  </select></td>
  </tr>
</table>  </td>
  <td width="10%" align="right">Total Gross</td>
  <td align="right" style="font-size:18px;"><strong>&#8377;<?php echo $finalcostperperson=(($totalcgst+$totalsgst+$totaligst+$total+$totaltcs)-$result['totalDiscount']); ?></strong></td>
  
  <?php
  
  if($result['convertedCurrency']!='INR'){
	

?>
</tr>
<tr style=" border-top:1px solid #ededed;border-bottom:2px solid #ededed; font-size:15px; ">
  <td colspan="5" align="left">&nbsp;</td>
  <td colspan="2" align="right"><strong><?php echo round($result['convertedCost']).' '.$result['convertedCurrency']; ?></strong></td>
</tr>
<?php } ?>
<tr style=" border-top:1px solid #ededed;border-bottom:2px solid #ededed; font-size:15px; ">
  <td colspan="5" align="left">&nbsp;</td>
  <td colspan="2" align="right"><input name="ebo" type="text" class="form-control" id="ebo" value="<?php echo stripslashes($result['ebo']); ?>" placeholder="Early Bird Offer" style="text-align:center;" ></td>
  </tr>
                                            </tbody>
                              </table>
							  <div style="text-align:right; margin-top:10px;"><input name="Save" type="submit" value="Update Billing" id="savingbutton" class="btn btn-primary" style="padding: 10px 20px;" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" ></div>
								<input name="action" type="hidden" id="action" value="saveGSTpackagebuilder">  
								<input name="pid" type="hidden" value="<?php echo encode($result['id']); ?>">
								<input name="changecussyes" id="changecussyes" type="hidden" value="0">
								<input name="finalcostperperson" id="finalcostperperson" type="hidden" value="<?php echo $finalcostperperson; ?>">
							  </form>
<?php 
updatelisting('sys_packageBuilder','netPrice="'.$totalnetCostview.'",grossPrice="'.(($totalcgst+$totalsgst+$totaligst+$total+$totaltcs)-$result['totalDiscount']).'",totaligst="'.$totaligst.'",totalsgst="'.$totalsgst.'",totalcgst="'.$totalcgst.'",grosstcs="'.$totaltcs.'",grossNoGSTPrice="'.$total.'"','id="'.$result['id'].'"'); 
?>
                         
						  </div>
						  
					  
						  
						  <div class=" " >
   
  
 
 
 <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data" style="display:none;">	
 
 <div class="modal-body">			
<div class="row"> <div class="col-md-12"> 
  <h4 class="card-title" style=" margin-top:0px;">Deposit information </h4>	
  </div>
 <div class="col-md-6">  
 <div class="row" style="margin-left: -8px; margin-top: 10px;"> 
<div class="col-md-5"> 
<div class="form-group">
<label for="validationCustom02">Amount</label>
    <input name="depositAmount" type="number" min="0" class="form-control" id="depositAmount" value="<?php echo stripslashes($result['depositAmount']); ?>">
</div></div>
 
<div class="col-md-5"> 
<div class="form-group">
<label for="validationCustom02">Due date</label>
      <input name="depositDueDate" type="text" min="0" class="form-control datecale" id="depositDueDate" value="<?php if($result['depositDueDate']!=''){ echo date('d-m-Y',strtotime($result['depositDueDate'])); } else { echo date('d-m-Y',strtotime(' + 7 days')); } ?>">
</div></div>

<div class="col-md-2"> 
<div class="form-group">
<label for="validationCustom02" style="width: 100%;">&nbsp;</label>
      <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" >
</div></div>

</div> 
  </div>

</div>   
</div>
 


<input name="action" type="hidden" id="action" value="savepageduedate">  
<input name="pid" type="hidden" value="<?php echo encode($result['id']); ?>">
</form>
 


</div>
								 
                             
</div>
                             

                        </div>

                         
						
						
						
						 
                     

             </div><!--end col-->

            <!-- end row -->

    </div>

        <!-- End Page-content -->

         
  </div>
</div>
</div>
 
<style>
.table-hover tr td table tr td{border:0px !important;    padding: 5px 0px 5px 5px !important;}
</style>
 
<script>
  $( function() {
    $( ".datecale" ).datepicker({
        dateFormat: 'dd-mm-yy',minDate: 0
    });
  } );
  </script>