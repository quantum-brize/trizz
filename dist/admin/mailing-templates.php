<?php 
$u = decode($_REQUEST['u']);

if($_REQUEST['u']==''){
$u=$_SESSION['userid'];
}
$abcd=GetPageRecord('*','userMaster','id="'.decode($_REQUEST['g']).'"'); 
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

      <div class="newboxheading"><div class="newhead">Email Templates<div class="newoptionmenu">
 
 	<div>  
								 
				<a href="display.html?ga=mailing-templates&add=1"><button type="button" class="btn btn-secondary btn-lg waves-effect waves-light" >Add Templates</button></a>  </div>
 <div> <form  action=""  class=" "   method="get" enctype="multipart/form-data">	
								  <input type="text" name="keyword" class="form-control newsearchsec"  placeholder="Search by name"  value="<?php echo $_REQUEST['keyword']; ?>" style="margin-top: 3px;">
								  <input name="ga" type="hidden" value="<?php echo $_REQUEST['ga']; ?>" />
								  </form>
								</div>
							
 </div>
 </div>     
 
     
</div>
                    
                    <!-- start page title -->
                     
              
                        <div class=" ">
                        <div class="col-md-12 col-xl-12" style="padding-top:32px;">
						<div class="card" >
                            <div class="card-body" style="padding:0px;"> 
                                      
							  
							  
							  <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm" >
							 <?php if($_SESSION['userid']==1){ ?> <div id="bulkassign" style="display:none;padding: 5px 2px; background-color: #f0f0f0; border-bottom: 2px solid #ddd; border-radius: 3px; margin-bottom: 10px; width:100%; float:left;"><table border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td style="font-size:13px;"><input type="checkbox" id="ckbCheckAll"  style="width: 16px; height: 16px;margin-left: 6px;" /></td>
    <td style="font-size:13px;">Select All&nbsp;</td>
 
    <td><button type="submit"  id="savingbutton" class="btn btn-primary btn-primaryred" onclick="this.form.submit(); this.value='Saving...';"  style="float:right;padding: 3px 10px;"  >
                                                Delete Selected Template
                                            </button></td>
    <td><input autocomplete="false" name="action" type="hidden" id="action" value="bulktemplatedelete" /></td>
  </tr>
</table>
</div> <?php } ?>
							  
                                        <table class="table table-hover mb-0">

                                            <thead>
                                                <tr>
                                                  <th width="1%">&nbsp;</th>
                                                  <th><strong>ID</strong></th>
                                                    <th><strong>Name</strong></th>
                                                    <th>Mail Subject </th>
                                                    <th width="15%" align="left">By</th>
                                                    <th width="12%">Date</th>
                                                    <th width="1%">&nbsp; </th>
                                                    <th width="1%">&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>
<?php
$totalno='1';
$totalmail='0';
$select='';
$where='';
$rs=''; 
$select='*'; 
$wheremain=''; 
$where=' where    (name like "%'.$_REQUEST['keyword'].'%" or subject like "%'.$_REQUEST['keyword'].'%" ) order by id desc'; 
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 
$targetpage='display.html?ga='.$_REQUEST['ga'].'&keyword='.$_REQUEST['keyword'].'&'; 
$rs=GetRecordList('*','templateMaster','  '.$where.'  ','25',$page,$targetpage);

$totalentry=$rs[1];

$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 
?>

<tr>
  <td width="1%"><?php if($_SESSION['userid']==1){ ?>
    <input type="checkbox" name="assignall[]" class="checkBoxClass" id="assignqury" value="<?php echo encode($rest['id']); ?>" onclick="selectedfun();" style="width: 16px; height: 16px;"><?php } ?></td>
  <td><a style="cursor:pointer;" onclick="loadpop('View Template',this,'1200px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewtemplate&id=<?php echo encode($rest['id']); ?>" ><strong><?php echo encode($rest['id']); ?></strong></a></td>
  <td><a style="cursor:pointer;" onclick="loadpop('View Template',this,'1200px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewtemplate&id=<?php echo encode($rest['id']); ?>" ><strong><?php echo stripslashes($rest['name']); ?></strong></a></td>
  <td><?php echo stripslashes($rest['subject']); ?></td>
  <td width="15%"><?php echo addbynewbadges($rest['addedBy']); ?></td>
  <td width="12%"><?php if(date('d-m-Y', strtotime($rest['dateAdded']))=='01-01-1970'){ echo '-'; } else {  echo date('d-m-Y', strtotime($rest['dateAdded'])); } ?></td>
  <td width="1%"><a class="dropdown-item neweditpan" onclick="loadpop('View Template',this,'1200px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewtemplate&id=<?php echo encode($rest['id']); ?>"  style="float:left;"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
  <td width="1%"><a class="dropdown-item neweditpan"  href="display.html?ga=mailing-templates&add=1&id=<?php echo encode($rest['id']); ?>"  ><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
</tr>


<?php $totalno++; } ?>
                                            </tbody>
                                        </table>
										
							  </form>
                           
									 <?php if($totalno==1){ ?>
						   <div style="text-align:center; padding:40px 0px; font-size:14px; color:#999999;">No Email Template</div>
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

$(document).ready(function () {
    $("#ckbCheckAll").click(function () {
        $(".checkBoxClass").prop('checked', $(this).prop('checked'));
		if($(".checkBoxClass").prop('checked') == true){
		$('#bulkassign').show();
		}else{
		$('#bulkassign').hide();
		}
    });
});
function selectedfun(){ 
var mychecked = $('.checkBoxClass:checked').length 
if (mychecked==0) {
    $('#bulkassign').hide();
}
if (mychecked>0) {
    $('#bulkassign').show();
} 
}

</script>