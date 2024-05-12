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

      <div class="newboxheading"><div class="newhead">Campaigns<div class="newoptionmenu">
  	
		<div>	<?php if (strpos($LoginUserDetails["permissionAddEdit"], 'Suppliers') !== false) { ?>	
				<a href="display.html?ga=campaigns&add=1"><button type="button" class="btn btn-secondary btn-lg waves-effect waves-light"  >Creaate Campaign</button></a> <?php } ?></div>					  <div><form  action=""  class=" "    method="get" enctype="multipart/form-data">	
								  <input type="text" name="keyword" class="form-control newsearchsec"  placeholder="Search by name"  value="<?php echo $_REQUEST['keyword']; ?>" style="margin-top: 3px;">
								  <input name="ga" type="hidden" value="<?php echo $_REQUEST['ga']; ?>" />
								  </form></div>
								  
 </div>
 </div>     
 
     
</div>
                    
                    <!-- start page title -->
                     
              
                        <div class=" ">
                        <div class="col-md-12 col-xl-12" style="padding-top:32px;">
						<div class="card" >
                            <div class="card-body" style="padding:0px;"> 
           
							  
							  
							  <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm" >
				 
							  
                                        <table class="table table-hover mb-0">

                                            <thead>
                                                <tr>                                                   <th>Name</th>
                                                    <th>Template</th>
                                                    <th>Clients Group</th>
                                                    <th width="1%"><div align="center">Sent</div></th>
                                                    <th width="1%"><div align="center">Views</div></th>
                                                    <th width="12%">By</th>
                                                    <th width="10%">Date</th>
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
$where=' where    (title like "%'.$_REQUEST['keyword'].'%"   ) order by id desc'; 
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 
$targetpage='display.html?ga='.$_REQUEST['ga'].'&keyword='.$_REQUEST['keyword'].'&'; 
$rs=GetRecordList('*','campaignMaster','  '.$where.'  ','25',$page,$targetpage);

$totalentry=$rs[1];

$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){


$abcd=GetPageRecord('*','clientGroupMaster','id="'.$rest['customerGroup'].'"'); 
$cgroupdata=mysqli_fetch_array($abcd); 

$abcde=GetPageRecord('*','templateMaster','id="'.$rest['templateId'].'"'); 
$templatedata=mysqli_fetch_array($abcde); 
?>

<tr>
   
  <td><a style="cursor:pointer;"popaction="action=viewcampaign&id=<?php echo encode($rest['id']); ?>" onclick="loadpop('Campaign',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center"><?php echo stripslashes($rest['title']); ?></a></td>
  <td  ><?php echo stripslashes($templatedata['name']); ?></td>
  <td  ><?php echo stripslashes($cgroupdata['name']); ?></td>
  <td width="1%"><div align="center"><?php echo stripslashes($rest['contacts']); ?></div></td>
  <td width="1%"><div align="center"><?php echo strip($rest['clicks']); ?></div></td>
  <td width="12%">
<?php echo addbynewbadges($rest['addedBy']); ?></td>
  <td width="10%"><?php if(date('d-m-Y', strtotime($rest['dateAdded']))=='01-01-1970'){ echo '-'; } else {  echo date('d-m-Y', strtotime($rest['dateAdded'])); } ?></td>
  <td width="1%">
  <a class="dropdown-item neweditpan" popaction="action=viewcampaign&id=<?php echo encode($rest['id']); ?>" onclick="loadpop('Campaign',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center" style="cursor:pointer;"><i class="fa fa-eye" aria-hidden="true"></i></a> </td>
</tr>


<?php $totalno++; } ?>
                                            </tbody>
                                        </table>
										
							  </form>
                           
									 <?php if($totalno==1){ ?>
						   <div style="text-align:center; padding:40px 0px; font-size:14px; color:#999999;">No Campaign</div>
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