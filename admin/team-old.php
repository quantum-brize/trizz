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

                <div class="page-content">

      
                    
                    <!-- start page title -->
                     
              
                        <div class="row">
                        <div class="col-md-12 col-xl-12">
						<div class="card" style="min-height:500px;">
                            <div class="card-body"> 
                                    <h4 class="card-title" style=" margin-top:0px;">Team<div class="float-right" id="addmemberbtndiv---">
									<button id="addteammember" type="button" class="btn btn-secondary btn-lg waves-effect waves-light"  onclick="loadpop('Invite team member',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addstaff">Invite team member</button>
									</div></h4>
                                    <p class="card-title-desc" >People within your organisation</p>
							 <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">	
                                        <table class="table table-hover mb-0">

                                            <thead>
                                                <tr>
                                                  <th width="2%">&nbsp;</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Status</th>
                                                    <th><div align="center"><input type="checkbox" name="checkAll2step" id="checkAll2step" value="1" >&nbsp;2&nbsp;Step&nbsp;Verification
                                                    </div></th>
                                                    <th><input type="checkbox" name="checkAllQrcodeon" id="checkAllQrcodeon" value="1" >&nbsp;QR&nbsp;Code On </th>
                                                    <th>&nbsp;</th>
                                                    <th>&nbsp;</th>
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
$where=' where  1 order by id asc'; 
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 
$targetpage='display.html?ga='.$_REQUEST['ga'].'&'; 
$rs=GetRecordList('*','sys_userMaster','  '.$where.'  ','100',$page,$targetpage);

$totalentry=$rs[1];

$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 
?>

<tr>
  <td width="2%"><div class="bulbblue"><?php echo substr($rest['firstName'],0,1); ?></div></td>
<td><?php echo stripslashes($rest['firstName']); ?> <?php echo stripslashes($rest['lastName']); ?></td>
<td><?php echo stripslashes($rest['email']); ?></td>
<td>
<?php if($rest['status']==1){ ?>
<span class="badge badge-success">Active</span>
<?php } else {  ?>
<span class="badge badge-danger">Inactive</span>
<?php } ?></td>
<td><div align="center">
  <input type="checkbox" name="stipverification[]" class="stip1" value="<?php echo encode($rest['id']); ?>" style="width: 19px; height: 22px;" <?php if($rest['stepVerification']==1){ ?>checked="checked"<?php } ?>>
</div></td>
<td><div align="center">
 <?php if($rest['id']!=1){ ?> <input type="checkbox" name="qrcodeon[]" class="stip2" value="<?php echo encode($rest['id']); ?>" style="width: 19px; height: 22px;"  <?php if($rest['qrCodeOn']==1){ ?>checked="checked"<?php } ?>><?php } ?>
</div></td>
<td><?php if($rest['id']!=1 && $rest["userType"]==3){ ?><a href="display.html?ga=team&add=1&id=<?php echo encode($rest['id']); ?>" class="badge badge-info" style="color:#fff !important;" >Set Target</a><?php } ?></td>
<td><?php if($rest['userType']!=0){ ?><div class="">
                                            <button type="button" class="optionmenu" data-toggle="dropdown" aria-expanded="false">
                                         <i class="mdi mdi-dots-vertical"></i>                                            </button>
                                            <div class="dropdown-menu" style="">
                                                <a class="dropdown-item"  style="cursor:pointer;" onclick="loadpop('Edit user details',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addstaff&id=<?php echo encode($rest['id']); ?>">Edit User</a>                                            </div>
                                        </div><?php } ?></td>
</tr>


<?php $ns++; } ?>
                                            </tbody>
                                        </table>
                                        <input name="action" type="hidden" id="action" value="stepverificationaction">
                           <div class="modal-footer" style="padding-right:0px;"> 
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

    </div>

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