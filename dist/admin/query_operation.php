<?php 
$rs1=GetPageRecord('*','queryMaster','id="'.decode($_REQUEST['id']).'"');   
$editresult=mysqli_fetch_array($rs1); 

$rs13=GetPageRecord('*','sys_packageBuilder','queryId="'.$editresult['id'].'" and confirmQuote=1');   
$packagedatadetials=mysqli_fetch_array($rs13);


$rs13=GetPageRecord('*','sys_packageBuilder','queryId="'.$editresult['id'].'" and confirmQuote=1');   
$packagedatadetials=mysqli_fetch_array($rs13);



$rs1333=GetPageRecord('*','sys_PackageTips','packageId="'.$packagedatadetials['id'].'" and title like "%Inclusion%"');   
$packageTipsData=mysqli_fetch_array($rs1333);
?>
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
<div class=" ">
<div>

<?php if($packagedatadetials['id']>0 && $editresult['statusId']==5){ ?>

<?php if($_REQUEST['addvoucher']==1){

$abcde=GetPageRecord('*','sys_voucherMaster','id="'.decode($_REQUEST['vid']).'"'); 
$voucherData=mysqli_fetch_array($abcde);


$rs=GetPageRecord($select,'sys_userMaster','id in (select addedBy from sys_userMaster where id="'.$packagedatadetials['addedBy'].'") '); 
$invoicedataa=mysqli_fetch_array($rs);
 ?>


<h4 class="card-title" style=" margin-top:0px; overflow:hidden; text-align:center;"><?php if($_REQUEST['vid']!=''){ echo 'Edit'; } else { echo 'Add'; } ?> Voucher</h4>
<form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">	
<div style="width: 850px; margin: auto; text-align: left; padding: 10px; box-shadow: 2px 2px 4px #d2d2d2aa; border: 1px solid #ddd; margin-top: 20px;">


<div style="width:100%; position:relative;">
<img id="bannerphoto" src="<?php echo $fullurl; ?>package_image/<?php if($voucherData['bannerImage']!=''){ echo str_replace('','',$voucherData['bannerImage']); } else { echo 'reservationconfirmationvoucher.jpg'; } ?>" width="828"  />

 <?php if (strpos($LoginUserDetails["permissionAddEdit"], 'Operation') !== false) { ?>	
<button type="button" class="optionmenu"  onclick="loadpop('Media library',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=medialibrary&afunctin=changeCoverPhoto&pid=<?php echo $_REQUEST['id']; ?>" style="position: absolute; right: -5px; top:20px; background-color: #fff; padding: 10px; border-radius: 5px; padding-right: 14px; font-size: 14px; color: #000; padding: 5px 18px; line-height: 28px;">
<i class="fa fa-pencil" aria-hidden="true"></i> Edit </button>
<?php } ?>
</div>


<div style="padding:15px; text-align:center; font-weight:800; font-size:16px; text-align:center; text-decoration:underline;">RESERVATION VOUCHER</div>

<div style="padding:15px; text-align:left;">
<div style="margin-bottom:5px;"><textarea name="welcomeContent" cols="" rows="4" class="form-control" id="welcomeContent"><?php if($voucherData['welcomeContent']!=''){ echo stripslashes($voucherData['welcomeContent']); } else { ?>Dear <?php echo stripslashes($clientData['submitName']); ?> <?php echo stripslashes($clientData['firstName']); ?> <?php echo stripslashes($clientData['lastName']); ?>

Thank you for choosing <?php echo stripslashes($invoicedataa['invoiceCompany']); ?>!
We are delighted to confirm your reservation as follows:<?php } ?></textarea>
</div>
</div>

<div style="padding:15px; text-align:left;">
 <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" valign="middle" style="padding:0px 10px 10px 0px;">Confirmation No</td>
    <td width="80%" align="left" valign="middle" style="padding:0px 0px  10px 0px;"><input name="confirmationNo" type="text" class="form-control"   value="<?php echo stripslashes($voucherData['confirmationNo']); ?>"  /></td>
  </tr>
  
  <tr>
    <td align="left" valign="middle" style="padding:0px 10px 10px 0px;">Supplier</td>
    <td width="80%" align="left" valign="middle" style="padding:0px 0px  10px 0px;"><input name="supplierName" type="text" class="form-control"   value="<?php if($voucherData['supplierName']!=''){ echo stripslashes($voucherData['supplierName']);  } else { echo stripslashes($invoicedataa['invoiceCompany']); } ?>"  /></td>
  </tr>
  <tr>
    <td align="left" valign="middle" style="padding:0px 10px 10px 0px;">Hotel</td>
    <td align="left" valign="middle" style="padding:0px 10px  10px 0px;"><select name="hotelselect" class="form-control"   id="hotelselect" onchange="selectHotel();" >
	  <option value="0"  >Select Hotel</option>
	     
			<?php
			$rs=GetPageRecord('*','sys_packageBuilderEvent',' packageId="'.$packagedatadetials['id'].'" and sectionType="Accommodation"  order by packageDays,time(checkIn) asc');
			while($rest=mysqli_fetch_array($rs)){ 
			?>
 
      <option value="<?php echo stripslashes($rest['id']); ?>" <?php if($voucherData['hotel']==$rest['name']){ ?>selected="selected"<?php } ?>><?php echo stripslashes($rest['name']); ?> - <?php echo stripslashes($rest['hotelRoom']); ?></option>
	  <?php } ?>
    </select></td>
	
	
  </tr>
  <tr>
    <td align="left" valign="middle" style="padding:0px 10px 10px 0px;">Destination</td>
    <td align="left" valign="middle" style="padding:0px 10px  10px 0px;"><input name="destination" type="text" class="form-control" id="destinationId" value="<?php echo stripslashes($voucherData['destination']); ?>"  /></td>
  </tr>
  <tr>
    <td align="left" valign="middle" style="padding:0px 10px 10px 0px;">Lead Pax Name</td>
    <td align="left" valign="middle" style="padding:0px 10px  10px 0px;"><input name="leadPaxName" type="text" class="form-control"   value="<?php if($voucherData['leadPaxName']==''){ echo stripslashes($editresult['name']); } else { echo stripslashes($voucherData['leadPaxName']);  } ?>"></td>
  </tr>
  <tr>
    <td align="left" valign="middle" style="padding:0px 10px 10px 0px;">Check In</td>
    <td align="left" valign="middle" style="padding:0px 10px  10px 0px;"><input name="startDate" type="text" class="form-control" readonly="readonly" id="startDate" value="<?php if($voucherData['startDate']!=''){ echo date('d-m-Y',strtotime($voucherData['startDate'])); } ?>"></td>
  </tr>
  <tr>
    <td align="left" valign="middle" style="padding:0px 10px 10px 0px;">Check Out</td>
    <td align="left" valign="middle" style="padding:0px 10px  10px 0px;"><input name="endDate" type="text" class="form-control"  readonly="readonly" id="endDate" value="<?php if($voucherData['endDate']!=''){ echo date('d-m-Y',strtotime($voucherData['endDate'])); } ?>"></td>
  </tr>
  <tr>
    <td align="left" valign="middle" style="padding:0px 10px 10px 0px;">Nights</td>
    <td align="left" valign="middle" style="padding:0px 10px  10px 0px;"><input name="nights" type="text" class="form-control" readonly="readonly" id="nights" value="<?php echo stripslashes($voucherData['nights']); ?>"></td>
  </tr>
  <tr>
    <td align="left" valign="middle" style="padding:0px 10px 10px 0px;">Total No. Of Rooms</td>
    <td align="left" valign="middle" style="padding:0px 10px  10px 0px;"><input name="noOfRooms" type="text" class="form-control" readonly="readonly" id="noOfRooms" value="<?php echo stripslashes($voucherData['noOfRooms']); ?>"></td>
  </tr>
  <tr>
    <td align="left" valign="middle" style="padding:0px 10px 10px 0px;">Room Type</td>
    <td align="left" valign="middle" style="padding:0px 10px  10px 0px;"><input name="roomType" type="text" class="form-control" readonly="readonly" id="roomType" value="<?php echo stripslashes($voucherData['roomType']); ?>"></td>
  </tr>
  <tr>
    <td align="left" valign="middle" style="padding:0px 10px 10px 0px;">No. of Pax </td>
    <td align="left" valign="middle" style="padding:0px 10px  10px 0px;"><?php echo $editresult['adult']; ?> Adult(s) <?php if($editresult['child']!='' && $editresult['child']>0){ ?> - <?php echo $editresult['child']; ?> Child(s)<?php } if($editresult['infant']!='' && $editresult['infant']>0){ ?> - <?php echo $editresult['infant']; ?> Infant(s)<?php } ?></td>
  </tr>
  <tr>
    <td align="left" valign="middle" style="padding:0px 10px 10px 0px;">Transfer Mode</td>
    <td align="left" valign="middle" style="padding:0px 10px  10px 0px;"><input name="transferMode" type="text" class="form-control" id="transferMode" value="<?php echo stripslashes($voucherData['transferMode']); ?>"></td>
  </tr>
  <tr>
    <td align="left" valign="middle" style="padding:0px 10px 10px 0px;">Meal Plan </td>
    <td align="left" valign="middle" style="padding:0px 10px  10px 0px;"><input name="mealPlan" type="text" class="form-control" id="mealPlan" value="<?php echo stripslashes($voucherData['mealPlan']); ?>" /></td>
  </tr>
</table>

</div>

<div style="padding:15px; text-align:left;">
<div style="margin-bottom:2px;">Remarks</div>
<div style="margin-bottom:5px;"><textarea name="remark" id="remark" cols="" rows="7" class="form-control"  ><?php echo stripslashes($voucherData['remark']); ?></textarea>
</div>
</div>

<script>
	function selectHotel(){
	var hotel = encodeURI($('#hotelselect').val());
	$('#ActionDiv').load('actionpage.php?hotel='+hotel+'&action=gethoteldatavaoucher&packageId=<?php echo encode($packagedatadetials['id']); ?>&queryId=<?php echo $_REQUEST['id']; ?>');
	}
	</script>
<?php if($voucherData['id']==''){ ?>
<script>
setTimeout("selectHotel()", 500); 
</script>
<?php } ?>

<script type="text/javascript">

var editor = CKEDITOR.replace('remark');

CKFinder.setupCKEditor( editor,'ckeditor/ckfinder/' ) ;

</script>
<div style="padding:15px; text-align:center; font-weight:800; font-size:16px; text-align:center; text-decoration:underline;">INCLUSIONS</div>

<div style="padding:15px; text-align:left;">
<table class="table table-hover mb-0">

                                            <thead>
                                            </thead>
                                            <tbody>
<?php
$a=$voucherData['inclusions'];
$netflightcosting=0;
$totalnetCost=0;
$totalGross=0;
$rs=GetPageRecord('*','sys_packageBuilderEvent',' packageId="'.$packagedatadetials['id'].'" and sectionType!="Accommodation" and sectionType!="Leisure" and name!=""  order by packageDays,time(checkIn) asc');
while($rest=mysqli_fetch_array($rs)){ 
$netCost=0;
$markupValue=0;
$gross=0;
?>

<tr>
  <td width="1%"><input type="checkbox" name="inclusions[]"  <?php if (strpos($a, $rest['id']) !== false) { ?>checked="checked"<?php } ?>  value="<?php echo stripslashes($rest['id']); ?>"  style="width: 19px; height: 22px;"> </td>
  <td style=" font-weight: 700;  "   ><?php echo stripslashes($rest['name']); ?><?php if($rest['sectionType']=='Accommodation'){ ?>
<span style="color:#FF9900; padding-left:10px;"><?php echo starcategory($rest['hotelCategory']); ?></span> 



<?php } ?> <div style="font-size:11PX; color:#999999;"><?php echo $rest['sectionType']; ?></div></td>
</tr>


<?php $totalno++; } ?>
</tbody>
</table>
</div>

<div style="padding:15px; text-align:center; font-weight:800; font-size:16px; text-align:center; text-decoration:underline;">TERMS</div>
<div style="padding:15px; text-align:left;">
<div style="border-top:2px solid #ddd;border-bottom:2px solid #ddd; padding:20px 0px 0px;"><table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><h6 style=" margin-top:0px;"><?php echo stripslashes($packageTipsData['title']); ?></h6>
<div style="  "><?php echo str_replace('</p>','',str_replace('<p>','',stripslashes($packageTipsData['description']))); ?></div>  </td>
  </tr>
</table>
</div>
</div>




</div>

<div class="form-group mb-0" style="padding: 20px 0px;  border-top: 1px solid #e6e6e6; overflow:hidden; margin-top:20px;">
                                           
                                   
											
											 <button type="submit" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" style="float:right;">
                                                Save Voucher
                                            </button>
											
											 <a href="display.html?ga=query&view=1&id=<?php echo $_REQUEST['id']; ?>&c=8"><button type="button" id="savingbutton" class="btn btn-dark waves-effect waves-light" style="float:left;">
                                                Cancel
                                            </button></a>
											<input type="hidden" name="bannerImage" id="bannerImage" value="<?php if($voucherData['bannerImage']!=''){ echo str_replace('','',$voucherData['bannerImage']); } else { echo 'reservationconfirmationvoucher.jpg'; } ?>" />
											 <input type="hidden" name="hotel" id="hotel" value="<?php echo stripslashes($voucherData['hotel']); ?>" />
                                             <input autocomplete="false" name="action" type="hidden" id="action" value="addvoucher"> 
											 <input autocomplete="false" name="editid" type="hidden" id="editid" value="<?php echo $voucherData['id']; ?>"> 
											 <input autocomplete="false" name="queryId" type="hidden" id="queryId" value="<?php echo $_REQUEST['id']; ?>"> 
											 <input autocomplete="false" name="packageId" type="hidden" id="packageId" value="<?php echo encode($packagedatadetials['id']); ?>"> 

											 <input autocomplete="false" name="adult" type="hidden"  value="<?php echo $editresult['adult']; ?>"> 
											 <input autocomplete="false" name="child" type="hidden" value="<?php echo $editresult['child']; ?>"> 
											 <input autocomplete="false" name="infant" type="hidden"   value="<?php echo $editresult['infant']; ?>"> 
								</div>
								</form>
<?php }  else { ?>

<h4 class="mt-0 header-title" style="margin-bottom:10px; position:relative;">Customer / Query Details <a target="_blank" href="<?php echo $fullurlproposal; ?>sharepackage/<?php echo encode($packagedatadetials['id']); ?>/<?php echo cleanstring(stripslashes($packagedatadetials['name'])); ?>.html" style="position: absolute; font-size: 12px; font-weight: 600; right: 5px; top: 5px; background-color: #005ee2; color: #fff; padding: 1px 10px; border-radius: 3px; cursor:pointer;"> View Proposal</a></h4>
<div class="card">
<div style="padding:10px;">
<table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC">
  <tr>
    <td><strong>Customer Name </strong></td>
    <td><?php echo stripslashes($clientData['submitName']).' '.stripslashes($clientData['firstName']).' '.stripslashes($clientData['lastName']); ?></td>
    <td><strong>Enquiry ID </strong></td>
    <td><?php echo  encode($editresult['id']); ?></td>
    <td><strong>Enquiry For </strong></td>
    <td><?php echo  $sourcedata; ?></td>
  </tr>
  
  <tr>
    <td colspan="6" bgcolor="#F8F8F8"><strong>Query Details </strong></td>
  </tr>
  <tr>
    <td><strong>Check-In</strong></td>
    <td><?php echo $startDate; ?></td>
    <td><strong>Check-Out </strong></td>
    <td><?php echo $endDate; ?></td>
    <td><strong>Nights</strong></td>
    <td><?php echo $editresult['day']; ?></td>
  </tr>
  <tr>
    <td><strong>From City </strong></td>
    <td><?php echo stripslashes($editresult['fromCity']); ?></td>
    <td><strong>Destination</strong></td>
    <td><?php echo getCityName($editresult['destinationId']); ?></td>
    <td><strong>Total Pax</strong></td>
    <td><?php echo $editresult['adult'].' Adult - '.$editresult['child'].' Child - '.$editresult['infant']; ?> Infant </td>
  </tr>
  <tr>
    <td><strong>Remarks</strong></td>
    <td colspan="5"><?php echo stripslashes($editresult['details']); ?></td>
  </tr>
  
</table>
 
</div>
</div>

<h4 class="mt-0 header-title" style="margin-bottom:10px; position:relative;">Vouchers <?php if (strpos($LoginUserDetails["permissionAddEdit"], 'Operation') !== false) { ?><a href="display.html?ga=query&view=1&id=<?php echo $_REQUEST['id']; ?>&c=8&addvoucher=1" style="position: absolute; font-size: 12px; font-weight: 600; right: 5px; top: 5px; background-color: #005ee2; color: #fff; padding: 1px 10px; border-radius: 3px; cursor:pointer;"> + Create New Voucher</a><?php } ?></h4>
<?php
$totalno=1;
$rsa=GetPageRecord('*','sys_voucherMaster',' queryId="'.$editresult['id'].'" and packageId="'.$packagedatadetials['id'].'"  order by id desc');
while($invoiceData=mysqli_fetch_array($rsa)){ 
?>
<div class="card"> 
<div class="card-body" style="padding:10px;"> 
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="5%" align="center"><i class="fa fa-file-o" aria-hidden="true" style="font-size:40px; color:#0066CC;"></i></td>
    <td colspan="2" align="left" style="padding-left:10px;"><div style="color:#666666; margin-bottom:0px;">Voucher - <?php echo date('j M Y',strtotime($invoiceData['dateAdded']));  ?></div>
      <div style="color:#000; font-size:20px;">ID: <?php echo encode($invoiceData['id']);  ?></div></td>
    <td align="right"> 
<button  onclick="loadpop('View Voucher',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewvoucher&id=<?php echo encode($invoiceData['id']); ?>&queryId=<?php echo encode($editresult['id']); ?>&packageId=<?php echo encode($packagedatadetials['id']); ?>" type="button" class="btn btn-primary waves-effect waves-light">View</button> 
&nbsp;

<?php if (strpos($LoginUserDetails["permissionAddEdit"], 'Operation') !== false) { ?>
<a href="display.html?ga=query&view=1&id=<?php echo $_REQUEST['id']; ?>&c=8&addvoucher=1&vid=<?php echo encode($invoiceData['id']); ?>"><button  type="button" class="btn btn-primary waves-effect waves-light">Edit</button></a>

<?php } ?>
 </td>
  </tr>
</table>

</div>
</div>
<?php $totalno++; } ?>

<?php if($totalno==1){ ?>
<div style="text-align:center; font-size:16px; padding:30px; color:#999999; "><div style="text-align:center; font-size:60px;"><i class="fa fa-file-o" aria-hidden="true"></i></div>No Voucher Created</div>
<?php } ?>

 
<?php } ?>

<?php } else {  ?>

<div style="text-align:center; font-size:16px; padding:30px; color:#999999; "><div style="text-align:center; font-size:60px;"><i class="fa fa-briefcase" aria-hidden="true"></i></div>
Query Not Confirmed</div>
<?php } ?>

</div>
</div>


<script>
 function changeCoverPhoto(img){
 $('#bannerphoto').attr('src','<?php echo $fullurl; ?>package_image/'+img);
 $('#bannerImage').val(img);
 $( ".close" ).trigger( "click" ); 
 }
  
</script>