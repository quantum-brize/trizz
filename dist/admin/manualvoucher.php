 
<script language="JavaScript" type="text/javascript" src="ckeditor/ckeditor.js"></script> 
<script language="JavaScript" type="text/javascript" src="ckeditor/ckfinder/ckfinder.js"></script>

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
</style>
<div class="wrapper">
<div class="container-fluid">
<div class="main-content">
 <div class="page-content">
<div class="row">
<div class="col-md-12 col-xl-12" style="margin-left: 5px; padding-right:20px !important;background-color: #fff; ">
 

<?php if($_REQUEST['addvoucher']==1 && $_SESSION['manualVoucherPin']!=''){

$abcde=GetPageRecord('*','sys_manualVoucherMaster','id="'.decode($_REQUEST['vid']).'"'); 
$voucherData=mysqli_fetch_array($abcde); 

$rs=GetPageRecord($select,'sys_userMaster','id in (select addedBy from sys_userMaster where id=1) '); 
$invoicedataa=mysqli_fetch_array($rs); 
 ?>


<h4 class="card-title" style=" margin-top:0px; overflow:hidden; text-align:center;"><?php echo 'Add'; ?> Voucher</h4>
<form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">	
<div style="width: 850px; margin: auto; text-align: left; padding: 10px; box-shadow: 2px 2px 4px #d2d2d2aa; border: 1px solid #ddd; margin-top: 20px;">


<div style="width:100%; position:relative;">
<img id="bannerphoto" src="<?php echo $fullurl; ?>package_image/<?php if($voucherData['bannerImage']!=''){ echo str_replace('','',$voucherData['bannerImage']); } else { echo 'reservationconfirmationvoucher.jpg'; } ?>" width="828"  />
 
<button type="button" class="optionmenu"  onclick="loadpop('Media library',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=medialibrary&afunctin=changeCoverPhoto&pid=1" style="position: absolute; right: -5px; top:20px; background-color: #fff; padding: 10px; border-radius: 5px; padding-right: 14px; font-size: 14px; color: #000; padding: 5px 18px; line-height: 28px;">
<i class="fa fa-pencil" aria-hidden="true"></i> Edit </button>
 
</div>


<div style="padding:15px; text-align:center; font-weight:800; font-size:16px; text-align:center; text-decoration:underline;">RESERVATION VOUCHER</div>

<div style="padding:15px; text-align:left;">
<div style="margin-bottom:5px;"><textarea name="welcomeContent" cols="" rows="4" class="form-control" id="welcomeContent"><?php if($voucherData['welcomeContent']!=''){ echo (stripslashes($voucherData['welcomeContent'])); }else{ ?>Dear ****
Thank you for choosing <?php echo stripslashes($invoicedataa['invoiceCompany']); ?>!
We are delighted to confirm your reservation as follows:<?php } ?></textarea>
</div>
</div>

<div style="padding:15px; text-align:left;">
 <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" valign="middle" style="padding:0px 10px 10px 0px;">Confirmation No</td>
    <td width="80%" align="left" valign="middle" style="padding:0px 0px  10px 0px;"><input name="confirmationNo" type="text" class="form-control"   value="<?php if($voucherData['confirmationNo']!=''){ echo stripslashes($voucherData['confirmationNo']); } ?>"  /></td>
  </tr>
  
  <tr>
    <td align="left" valign="middle" style="padding:0px 10px 10px 0px;">Supplier</td>
    <td width="80%" align="left" valign="middle" style="padding:0px 0px  10px 0px;"><input name="supplierName" type="text" class="form-control"   value="<?php if($voucherData['supplierName']!=''){ echo stripslashes($voucherData['supplierName']); } ?>"  /></td>
  </tr>
  <tr>
    <td align="left" valign="middle" style="padding:0px 10px 10px 0px;">Hotel</td>
    <td align="left" valign="middle" style="padding:0px 10px  10px 0px;"><input name="hotel" type="text" class="form-control"   value="<?php echo stripslashes($voucherData['hotel']); ?>"  /></td> 
	 
  </tr>
  <tr>
    <td align="left" valign="middle" style="padding:0px 10px 10px 0px;">Destination</td>
    <td align="left" valign="middle" style="padding:0px 10px  10px 0px;"><input name="destination" type="text" class="form-control" id="destinationId" value="<?php if($voucherData['destination']!=''){ echo stripslashes($voucherData['destination']); } ?>"  /></td>
  </tr>
  <tr>
    <td align="left" valign="middle" style="padding:0px 10px 10px 0px;">Lead Pax Name</td>
    <td align="left" valign="middle" style="padding:0px 10px  10px 0px;"><input name="leadPaxName" type="text" class="form-control"   value="<?php if($voucherData['leadPaxName']!=''){ echo stripslashes($voucherData['leadPaxName']); } ?>"></td>
  </tr>
  <tr>
    <td align="left" valign="middle" style="padding:0px 10px 10px 0px;">Check In</td>
    <td align="left" valign="middle" style="padding:0px 10px  10px 0px;"><input name="startDate" type="text" class="form-control" id="startDate" value="<?php if($voucherData['startDate']!=''){ echo date('d-m-Y', strtotime($voucherData['startDate'])); }else{ echo date('d-m-Y'); } ?>" readonly=""></td>
  </tr>
  <tr>
    <td align="left" valign="middle" style="padding:0px 10px 10px 0px;">Check Out</td>
    <td align="left" valign="middle" style="padding:0px 10px  10px 0px;"><input name="endDate" type="text" class="form-control"  id="endDate" value="<?php if($voucherData['endDate']!=''){ echo date('d-m-Y', strtotime($voucherData['endDate'])); }else{ echo date('d-m-Y'); } ?>" readonly=""></td>
  </tr>
  <tr>
    <td align="left" valign="middle" style="padding:0px 10px 10px 0px;">Nights</td>
    <td align="left" valign="middle" style="padding:0px 10px  10px 0px;"><input name="nights" type="text" class="form-control" id="nights" value="<?php if($voucherData['nights']!=''){ echo stripslashes($voucherData['nights']); } ?>"></td>
  </tr>
  <tr>
    <td align="left" valign="middle" style="padding:0px 10px 10px 0px;">Total No. Of Rooms</td>
    <td align="left" valign="middle" style="padding:0px 10px  10px 0px;"><input name="noOfRooms" type="text" class="form-control" id="noOfRooms" value="<?php if($voucherData['noOfRooms']!=''){ echo stripslashes($voucherData['noOfRooms']); } ?>"></td>
  </tr>
  <tr>
    <td align="left" valign="middle" style="padding:0px 10px 10px 0px;">Room Type</td>
    <td align="left" valign="middle" style="padding:0px 10px  10px 0px;"><input name="roomType" type="text" class="form-control" id="roomType" value="<?php if($voucherData['roomType']!=''){ echo stripslashes($voucherData['roomType']); } ?>"></td>
  </tr>
  <tr>
    <td align="left" valign="middle" style="padding:0px 10px 10px 0px;">No. of Pax </td>
    <td align="left" valign="middle" style="padding:0px 10px  10px 0px;"><input name="adult" type="text" class="form-control" id="adult" value="<?php if($voucherData['adult']!=''){ echo stripslashes($voucherData['adult']); } ?>"></td>
  </tr>
  <tr>
    <td align="left" valign="middle" style="padding:0px 10px 10px 0px;">Transfer Mode</td>
    <td align="left" valign="middle" style="padding:0px 10px  10px 0px;"><input name="transferMode" type="text" class="form-control" id="transferMode" value="<?php if($voucherData['transferMode']!=''){ echo stripslashes($voucherData['transferMode']); } ?>"></td>
  </tr>
  <tr>
    <td align="left" valign="middle" style="padding:0px 10px 10px 0px;">Meal Plan </td>
    <td align="left" valign="middle" style="padding:0px 10px  10px 0px;"><input name="mealPlan" type="text" class="form-control" id="mealPlan" value="<?php if($voucherData['mealPlan']!=''){ echo stripslashes($voucherData['mealPlan']); } ?>" /></td>
  </tr>
</table>

</div>

<div style="padding:15px; text-align:left;">
<div style="margin-bottom:2px;">Remarks</div>
<div style="margin-bottom:5px;"><textarea name="remark" id="remark" cols="" rows="7" class="form-control"  ><?php if($voucherData['remark']!=''){ echo stripslashes($voucherData['remark']); } ?></textarea>
</div>
</div>
<script type="text/javascript">

var editor = CKEDITOR.replace('remark');

CKFinder.setupCKEditor( editor,'ckeditor/ckfinder/' ) ;

</script>
<div style="padding:15px; text-align:center; font-weight:800; font-size:16px; text-align:center; text-decoration:underline;">INCLUSIONS</div>
<div style="padding:15px; text-align:left;">
<table width="100%" class="table table-hover mb-0">

                                            <thead>
                                            </thead>
                                            <tbody>
 

<tr>
  <td width="1%"><textarea name="inclusions" id="inclusions" cols="" rows="7" class="form-control"  ><?php if($voucherData['inclusions']!=''){ echo stripslashes($voucherData['inclusions']); } ?></textarea> </td>
  </tr>
</tbody>
</table>
</div>

<script type="text/javascript">

var editor = CKEDITOR.replace('inclusions');

CKFinder.setupCKEditor( editor,'ckeditor/ckfinder/' ) ;

</script>

</div>

<div class="form-group mb-0" style="padding: 20px 0px;  border-top: 1px solid #e6e6e6; overflow:hidden; margin-top:20px;">
                                           
                                   
											
											 <button type="submit" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" style="float:right;">
                                                Save Voucher
                                            </button>
											
											 <a href="display.html?ga=manualvoucher"><button type="button" id="savingbutton" class="btn btn-dark waves-effect waves-light" style="float:left;">
                                                Cancel
                                            </button></a>
											<input type="hidden" name="bannerImage" id="bannerImage" value="<?php if($voucherData['bannerImage']!=''){ echo str_replace('','',$voucherData['bannerImage']); } else { echo 'reservationconfirmationvoucher.jpg'; } ?>" /> 
                                             <input autocomplete="false" name="action" type="hidden" id="action" value="addmanualvoucher"> 
											 <input autocomplete="false" name="editid" type="hidden" id="editid" value="<?php echo $voucherData['id']; ?>">  
 
								</div>
								</form>
<?php }  else { ?>
 
<?php 
if($_SESSION['manualVoucherPin']!=''){
$totalno=1;
$rsa=GetPageRecord('*','sys_manualVoucherMaster','1 order by id desc');
while($invoiceData=mysqli_fetch_array($rsa)){ 
?>
<div class="card" style=" border: 2px solid #ddd;"> 
<div class="card-body"> 
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="5%" align="center"><i class="fa fa-file-o" aria-hidden="true" style="font-size:50px; color:#0066CC;"></i></td>
    <td colspan="2" align="left" style="padding-left:10px;"><div style="color:#666666; margin-bottom:0px;">Voucher - <?php echo date('j M Y',strtotime($invoiceData['dateAdded']));  ?></div>
      <div style="color:#000; font-size:24px;">ID: <?php echo encode($invoiceData['id']);  ?></div>
	  <div style="color:#666666; margin-bottom:0px; font-size: 10px; font-weight:500;">Created By - <?php echo getUserNameNew($invoiceData['addedBy']); ?></div>
	  </td>
    <td align="right"> 
<button  onclick="loadpop('View Voucher',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewmanualvoucher&id=<?php echo encode($invoiceData['id']); ?>" type="button" class="btn btn-primary waves-effect waves-light">View</button> 
&nbsp;
 
<a href="display.html?ga=manualvoucher&addvoucher=1&vid=<?php echo encode($invoiceData['id']); ?>"><button  type="button" class="btn btn-primary waves-effect waves-light">Edit</button></a>
 
 </td>
  </tr>
</table>

</div>
</div>
<?php $totalno++; } ?>

<?php if($totalno==1){ ?>
<div style="text-align:center; font-size:16px; padding:30px; color:#999999; "><div style="text-align:center; font-size:60px;"><i class="fa fa-file-o" aria-hidden="true"></i></div>No Voucher Created</div>
<?php } ?>
 
<div style="padding:20px; text-align:center;">
  <a href="display.html?ga=manualvoucher&addvoucher=1"><button type="button" class="btn btn-primary btn-lg waves-effect waves-light"><i class="fa fa-plus" aria-hidden="true"></i> Create New Voucher</button></a>
</div>
 
<?php }else{ 
 ?>
<form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">	
 <table width="100%" border="0" cellspacing="0" cellpadding="5" style="    margin-bottom: 20px;">
  <tr>
    <td align="center"><div style="padding:20px;" >
  <input name="pin" type="password" placeholder="Enter Pin" class="form-control" style="width: 250px; text-align: center;" />
</div></td>
  </tr>
  <tr>
    <td align="center"><button type="submit" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';"> Login </button></td>
  </tr>
</table> 
<input autocomplete="false" name="action" type="hidden" id="action" value="loginmanualvoucher"> 
</form>
 <?php }} ?>
 

</div>
</div></div></div></div></div>


<script>
 function changeCoverPhoto(img){
 $('#bannerphoto').attr('src','<?php echo $fullurl; ?>package_image/'+img);
 $('#bannerImage').val(img);
 $( ".close" ).trigger( "click" ); 
 }
  



 $( function() {
    $( "#startDate" ).datepicker({ 
	  dateFormat: 'dd-mm-yy' 
      });
	  
	  $( "#endDate" ).datepicker({ 
	  dateFormat: 'dd-mm-yy' 
      });
  } );
 

</script>