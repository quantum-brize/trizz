<?php 
if($LoginUserDetails['userType']!=0){ exit(); }
$u = decode($_REQUEST['u']);

if($_REQUEST['u']==''){
$u=$_SESSION['userid'];
}
$abcd=GetPageRecord('*','userMaster','id="'.$u.'"'); 
$result=mysqli_fetch_array($abcd); 
?>
 <script src="tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
selector: "#emailsignature",
themes: "modern",
plugins: [
"advlist autolink lists link image charmap print preview anchor",
"searchreplace visualblocks code fullscreen"
],
toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
});
</script>



<div class="wrapper">
<div class="container-fluid">
<div class="main-content">

                <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top" >
<?php include "settingleft.php"; ?>
	
	</td>
    <td align="left" valign="top" width="90%"><div class="page-content">

      <div class="newboxheading"><div class="newhead">Team - People within your organisation<div class="newoptionmenu">
  	
		<div> <button id="addteammember" type="button" class="btn btn-secondary btn-lg waves-effect waves-light"  onclick="loadpop('Invite team member',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addstaff">Invite team member</button></div>					 
								  
 </div>
 </div>     
 
     
</div>
                    
                    <!-- start page title -->
                     
              
                        <div class=" ">
                        <div class="col-md-12 col-xl-12" style="padding-top:32px;">
						<div class=" "  >
                            <div class="card-body"> 
                                     
                       
							 <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">	
                                        <table class="table table-hover mb-0">

                                            <thead>
                                                <tr>
                                                  <th width="0%">&nbsp;</th>
                                                  <th width="30%">Name</th>
                                                  <th width="35%">Email</th>
                                                  <th width="25%">Role</th>
                                                  <th width="1%">Status</th>
                                                  <th class="d-none"><div align="center"><input type="checkbox" name="checkAll2step" id="checkAll2step" value="1" >&nbsp;2&nbsp;Step&nbsp;Verification
                                                  </div></th>
                                                  <th class="d-none"><input type="checkbox" name="checkAllQrcodeon" id="checkAllQrcodeon" value="1" >&nbsp;QR&nbsp;Code On </th>
                                                  <th width="1%">&nbsp;</th>
                                                  <th width="1%">&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>
<?php
$ns=1;
$totalmail='0';
$select='';
$where='';
$rs=''; 
$select='*'; 
$wheremain=''; 
$where=' where (userType="1" or userType="0")   order by id asc'; 
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 
$targetpage='display.html?ga='.$_REQUEST['ga'].'&'; 
$rs=GetRecordList('*','sys_userMaster','  '.$where.'  ','100',$page,$targetpage);

$totalentry=$rs[1];

$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 


$rst=GetPageRecord('*','roleMaster',' id="'.$rest['branchId'].'"  '); 
$restrole=mysqli_fetch_array($rst);

$rstb=GetPageRecord('*','branchMaster',' id="'.$restrole['branchId'].'"  '); 
$restbranch=mysqli_fetch_array($rstb);
?>

<tr>
<td width="0%"><div class="bulbblue" style="margin-right:0px; margin:auto;"><?php echo substr($rest['firstName'],0,1); ?></div></td>
<td width="30%"><?php echo stripslashes($rest['firstName']); ?> <?php echo stripslashes($rest['lastName']); ?></td>
<td width="35%"><?php echo stripslashes($rest['email']); ?></td>
<td width="25%">
<?php if($rest['id']==1){ echo 'Administrator'; } else { ?>
<strong><?php echo stripslashes($restrole['name']); ?></strong> - <?php echo stripslashes($restbranch['name']); } ?></td>
<td width="1%">
<?php if($rest['status']==1){ ?>
<span class="badge badge-success">Active</span>
<?php } else {  ?>
<span class="badge badge-danger">Inactive</span>
<?php } ?></td>
<td class="d-none"><div align="center">
  <input type="checkbox" name="stipverification[]" class="stip1" value="<?php echo encode($rest['id']); ?>" style="width: 19px; height: 22px;" <?php if($rest['stepVerification']==1){ ?>checked="checked"<?php } ?>>
</div></td>
<td class="d-none"><div align="center">
 <?php if($rest['id']!=1){ ?> <input type="checkbox" name="qrcodeon[]" class="stip2" value="<?php echo encode($rest['id']); ?>" style="width: 19px; height: 22px;"  <?php if($rest['qrCodeOn']==1){ ?>checked="checked"<?php } ?>><?php } ?>
</div></td>
<td width="1%"><?php if($rest['id']!=1 ){ ?><a href="display.html?ga=team&add=1&id=<?php echo encode($rest['id']); ?>" class="badge badge-info" style="color:#fff !important;" >Set Target</a><?php } ?></td>
<td width="1%"><?php if($rest['userType']!=0){ ?>

<a class="dropdown-item neweditpan" onclick="loadpop('Edit user details',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addstaff&id=<?php echo encode($rest['id']); ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>

   <?php } ?></td>
</tr>


<?php $ns++; } ?>
                                            </tbody>
                               </table>
                                        <input name="action" type="hidden" id="action" value="stepverificationaction">
                           <div class="modal-footer d-none" style="padding-right:10px;"> 
<input name="Save" type="submit" value="Save Changes" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';">
</div>
							  </form>
						  </div>
								 
                             
</div>
                             

                        </div>

   <?php if($ns>$totalusers){ ?>
 <script>
 $('#addmemberbtndiv #addteammember').remove();
 $('#addmemberbtndiv').html('<div class="upmsg">Your user limit exceeded. Please upgrade your subscription</div>');
 </script>   
   
   <?php } ?>                      
						
						
<style>
.upmsg{color: #CC3300; font-weight: 400; font-size: 14px; padding: 5px 10px; border: 1px solid #ffe18f; background-color: #fffdd4;}
</style>					 
                     

             </div><!--end col-->

            <!-- end row -->

    </div></td>
  </tr>
</table>


        <!-- End Page-content -->

         
    </div>
  </div>	</div>
	
	
<script>
$(function () {
    $("#checkAll2step").click(function () {
        if ($("#checkAll2step").is(':checked')) {
            $(".stip1").prop("checked", true);
        } else {
            $(".stip1").prop("checked", false);
        }
    });
	
	
	$("#checkAllQrcodeon").click(function () {
        if ($("#checkAllQrcodeon").is(':checked')) {
            $(".stip2").prop("checked", true);
        } else {
            $(".stip2").prop("checked", false);
        }
    });
	
});
</script>