<?php 

if($_REQUEST['action']=='lockquery'){
$st=$_REQUEST['st'];
if($st==0){
$lockPostSaleSupplier=1;
}
if($st==1){
$lockPostSaleSupplier=0;
}

$namevalue ='lockPostSaleSupplier="'.$lockPostSaleSupplier.'"'; 
$where='id="'.decode($_REQUEST['id']).'"';    
updatelisting('queryMaster',$namevalue,$where);  
}
$rs1=GetPageRecord('*','queryMaster','id="'.decode($_REQUEST['id']).'"');   
$editresult=mysqli_fetch_array($rs1); 

$rs13=GetPageRecord('*','sys_packageBuilder','queryId="'.$editresult['id'].'" and confirmQuote=1');   
$packagedatadetials=mysqli_fetch_array($rs13);


$rs13=GetPageRecord('*','sys_packageBuilder','queryId="'.$editresult['id'].'" and confirmQuote=1');   
$packagedatadetials=mysqli_fetch_array($rs13);



$rs1333=GetPageRecord('*','sys_PackageTips','packageId="'.$packagedatadetials['id'].'" and title like "%Inclusion%"');   
$packageTipsData=mysqli_fetch_array($rs1333);

?>

<style>
 
 
.statusbox{margin-right: 5px; padding: 10px; text-align: center; background-color: #000000; font-size: 13px; color: #fff; border-radius: 4px; text-transform:uppercase;}
 .bulbblue2 {
    height: 30px;
    width: 30px;
    background-color: #3b5de7;
    border-radius: 100%;
    text-align: center;
    overflow: hidden;
    line-height: 34px;
    font-size: 16px;
    font-weight: 600;
    color: #fff;
    margin-right: 20px;
}
.cnfno{width: 140px;}

 .suppeventlist{padding:10px; border:1px solid #ddd; margin-bottom:10px;border-radius: 5px;}
  .suppeventlist:hover{background-color:#fffcec;}
</style>
 

<?php if($packagedatadetials['id']>0){ ?>


<?php
$rsads=GetPageRecord('*','sys_packageBuilderEvent',' packageId="'.$packagedatadetials['id'].'" and sectionType!="Leisure" group by sectionType order by sectionType asc');
while($groupservices=mysqli_fetch_array($rsads)){ 
?>
<?php if($groupservices['sectionType']!=''){ ?>
<div class="card" style="margin-bottom:10px; margin-left:10px; margin-right:10px; margin-top:10px;">
<div class="card-body" style="padding:10px;">
<h4 class="mt-0 header-title" style="margin-bottom:10px;"><i class="fa <?php if($groupservices['sectionType']=='Accommodation'){ ?>fa-bed<?php } ?><?php if($groupservices['sectionType']=='Activity'){ ?>fa-blind<?php } ?><?php if($groupservices['sectionType']=='Transportation'){ ?>fa-car<?php } ?><?php if($groupservices['sectionType']=='FeesInsurance'){ ?>fa-credit-card<?php } ?><?php if($groupservices['sectionType']=='Meal'){ ?>fa-cutlery<?php } ?><?php if($groupservices['sectionType']=='Flight'){ ?>fa-plane<?php } ?>" aria-hidden="true"></i> &nbsp;<?php if($groupservices['sectionType']=='FeesInsurance'){ echo 'Fees - Insurance'; } else {  echo $groupservices['sectionType'];  } ?></h4>

<?php
$netflightcosting=0;
$totalnetCost=0;
$totalGross=0;

$rs=GetPageRecord('*','sys_packageBuilderEvent',' packageId="'.$packagedatadetials['id'].'" and  sectionType="'.$groupservices['sectionType'].'" and sectionType!="Leisure" and name!="" order by packageDays,time(checkIn) asc');
while($rest=mysqli_fetch_array($rs)){ 


$aadv=GetPageRecord('count(id) as totalnotes','supplierNotes','serviceId="'.$rest['id'].'"');  
$notesyes=mysqli_fetch_array($aadv);

$netCost=0;
$markupValue=0;
$gross=0;

$predate=date('d-m-Y',strtotime($editresult['startDate']));
?>


<?php

if($rest['sectionType']=='Accommodation'){

 $netCost=round($rest['singleRoomCost']*$rest['singleRoom'])+($rest['doubleRoomCost']*$rest['doubleRoom'])+($rest['tripleRoomCost']*$rest['tripleRoom'])+($rest['quadRoomCost']*$rest['quadRoom'])+($rest['cwbRoomCost']*$rest['cwbRoom'])+($rest['cnbRoomCost']*$rest['cnbRoom']);

} else { 

if($rest['transferCategory']=='Private'){

 $netCost=round($rest['vehicle']*$rest['adultCost']);

} else {

 $netCost=round($rest['adultCost']*$editresult['adult'])+($rest['childCost']*$editresult['child']);

if($rest['sectionType']=='Flight'){
$netflightcosting=$netCost+$netflightcosting;
}


}
 
}




$totalnetCost=$netCost+$totalnetCost;

$markupValue=($rest['markupPercent']*$netCost/100);
$gross=round($netCost+$markupValue);

$totalGross=$gross+$totalGross;


if($rest['supplierAmount']>0){
//$netCost=$rest['supplierAmount'];
}


 
 ?>
 
 
 
 <div class="suppeventlist" style="position:relative;">
 <a onClick="loadpop('Post Sales Supplier',this,'700px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addpostsalessupplier&queryId=<?php echo $_REQUEST['id']; ?>&id=<?php echo encode($rest['id']); ?>" style="position: absolute; font-size: 12px; font-weight: 600; right: 10px; top: 16px; background-color: #005ee2; color: #fff; padding: 5px 10px; border-radius: 3px; cursor: pointer;"><i class="fa fa-pencil" aria-hidden="true"></i> &nbsp;Update Payment</a>
 
 
 <a onclick="loadpop('Remark',this,'700px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addSupplierRemark&queryId=<?php echo $_REQUEST['id']; ?>&id=<?php echo encode($rest['id']); ?>" style="position: absolute; font-size: 12px; font-weight: 600; right: 140px; top: 16px; background-color: #39b7c1; color: #fff; padding: 5px 10px; border-radius: 3px; cursor: pointer;"><i class="fa fa-message" aria-hidden="true"></i> Remark (<?php echo $notesyes['totalnotes']; ?>)</a>
 
 <strong><?php echo stripslashes($rest['name']); ?></strong><?php if($rest['sectionType']=='Accommodation'){ ?>
<span style="color:#FF9900; padding-left:10px;"><?php echo starcategory($rest['hotelCategory']); ?></span> 

<div style="color: #989898; font-size: 11px; padding-top: 4px; font-weight: 800; text-transform: uppercase;"><?php echo stripslashes($rest['hotelRoom']); ?> - <?php echo date('d-m-Y',strtotime($rest['startDate'])); ?> To <?php echo date('d-m-Y',strtotime($rest['endDate'])); ?></div>

<?php } else { ?>


<div style="color: #989898; font-size: 11px; padding-top: 4px; font-weight: 800; text-transform: uppercase;"><?php echo date('d-m-Y',strtotime($rest['startDate'])); if($rest['sectionType']!='FeesInsurance'){ ?> - <i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo date('g:i A',strtotime($rest['checkIn']));  ?> to <?php echo date('g:i A',strtotime($rest['checkOut']));  ?> <?php   }  if($rest['transferCategory']=='Private'){ ?> - <strong>Vehicle: </strong><?php echo stripslashes($rest['vehicle']); } ?></div>




<?php } ?>

<div style="margin-top:5px;">
<table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC" style="font-size:12px;">
  <tr>
    <td><strong>Supplier</strong></td>
    <td><strong>Status</strong></td>
    <td><strong>Payment</strong></td>
    <td><div align="center"><strong>Amount</strong></div></td>
    <td><div align="center"><strong>Cancellation</strong></div></td>
    <td><div align="center"><strong>Due Date</strong></div></td>
    <td><div align="center"><strong>Paid Amount </strong></div></td>
    <td><div align="center"><strong>Pending</strong></div></td>
    </tr>
  <tr>
    <td><?php  
$rs2=GetPageRecord('*','userMaster',' id="'.$rest['supplierId'].'" and status=1 and userType=5 order by firstName asc');
if(mysqli_num_rows($rs2)>0){ $restsup=mysqli_fetch_array($rs2); echo $restsup['company']; }else{ echo 'No Supplier Selected'; } ?>  <?php if($rest['bookingStatusId']==2){ ?><div style=" font-size:12px; color:#666666;"><strong>CN: <?php echo $rest['confirmationNo']; ?></strong></div><?php } ?></td>
    <td><div style="border-radius: 3px; text-align: center; padding:3px;font-size: 12px;  padding-right: 0px; padding-left: 4px; color:#fff; background-color:#<?php if($rest['bookingStatusId']==0){ ?>e77350<?php } ?><?php if($rest['bookingStatusId']==1){ ?>e3445a<?php } ?><?php if($rest['bookingStatusId']==2){ ?>01c875<?php } ?><?php if($rest['bookingStatusId']==3){ ?>a55cd9<?php } ?><?php if($rest['bookingStatusId']==4){ ?>323232<?php } ?>;"><?php if($rest['bookingStatusId']==0){ ?>Mail Sent<?php } ?><?php if($rest['bookingStatusId']==1){ ?>Pending Confirmation<?php } ?><?php if($rest['bookingStatusId']==2){ ?>Confirmed<?php } ?><?php if($rest['bookingStatusId']==3){ ?>Not Confirmed<?php } ?><?php if($rest['bookingStatusId']==4){ ?>Rates Negotiation<?php } ?></div></td>
    <td><div style="border-radius: 3px; text-align: center; padding:3px; font-size: 12px;  padding-right: 0px; padding-left: 4px; color:#fff; background-color:#<?php if($rest['status']==0){ ?>e77350<?php } ?><?php if($rest['status']==1){ ?>01c875<?php } ?>;"><?php if($rest['status']==0){ ?>Payment Pending<?php } ?><?php if($rest['status']==1){ ?>Amount Paid<?php } ?></div></td>
    <td><div align="center"><?php echo $netCost; ?></div></td>
    <td><div align="center" <?php if($rest['supplierCancellationDate']<=date('Y-m-d')){ ?>style="color:#FF0000;"<?php } ?>><?php if($rest['supplierCancellationDate']!='' && date('d-m-Y',strtotime($rest['supplierCancellationDate']))!='01-01-1970'){  echo date('d-m-Y',strtotime($rest['supplierCancellationDate'])); } ?></div></td>
    <td><div align="center" <?php if($rest['dueDate']<date('Y-m-d')){ ?>style="color:#FF0000;"<?php } ?>><?php if($rest['dueDate']!='' && date('d-m-Y',strtotime($rest['dueDate']))!='01-01-1970'){  echo date('d-m-Y',strtotime($rest['dueDate'])); } ?></div></td>
    <td><div align="center"><?php echo $rest['paidAmount']; ?></div></td>
    <td><div align="center"><?php echo $netCost-$rest['paidAmount']; ?></div></td>
    </tr>
</table>

</div>
 </div>
 
 <?php $totalno++; } } ?>


</div>
</div>
<?php } ?>
<?php } ?>

 

 


<script>
function saveexpcontent(id){  
var paidAmount = Number($('#paidAmount'+id).val()); 
var supplierAmount = Number($('#supplierAmount'+id).val()); 
var restpending = Number(supplierAmount-paidAmount);
$('#pendingAmount'+id).val(restpending);

var supplierId = encodeURI($('#supplierId'+id).val()); 
var dueDate = encodeURI($('#dueDate'+id).val());  
var suppliercancellationdate = encodeURI($('#suppliercancellationdate'+id).val());  
var bookingStatusId = encodeURI($('#bookingStatusId'+id).val());  
var confirmationNo = encodeURI($('#confirmationNo'+id).val());
if(bookingStatusId==2){
$('#confirmationNo'+id).show();
}else{
$('#confirmationNo'+id).hide();
}




var pendingAmount = encodeURI($('#pendingAmount'+id).val()); 
var status = encodeURI($('#status'+id).val()); 
 
$('#ActionDiv').load('actionpage.php?action=savesuppliercosting&id='+id+'&supplierAmount='+supplierAmount+'&supplierId='+supplierId+'&dueDate='+dueDate+'&paidAmount='+paidAmount+'&bookingStatusId='+bookingStatusId+'&pendingAmount='+pendingAmount+'&suppliercancellationdate='+suppliercancellationdate+'&status='+status+'&confirmationNo='+confirmationNo);

}


</script>