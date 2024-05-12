<?php 
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
                            <div class="card-body" style="padding:0px;"> 
                                    <h4 class="card-title" style=" margin-top:0px;">Client Group<div class="float-right">
								<?php if (strpos($LoginUserDetails["permissionAddEdit"], 'Suppliers') !== false) { ?>	<button type="button" class="btn btn-secondary btn-lg waves-effect waves-light"  onclick="loadpop('Add Client Group',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addclientgroup" style="margin-bottom:20px;">Add Client Group</button> <?php } ?>
									</div></h4> 
							 <div   style="  margin-bottom: 20px; float: left; width: 100%; border-top: 1px solid #dee2e6; border-bottom: 2px solid #dee2e6; background-color: #f3f3f3; padding: 8px;">
								 
								  <div class="row" style="margin-right: 0px; margin-left: 0px;">
								  
								    
								  <div class="col-md-3 col-xl-3">
								   <form  action=""    method="post" enctype="multipart/form-data">	
								  <input type="text" name="keyword" class="form-control"  placeholder="Search by name"  value="<?php echo $_REQUEST['keyword']; ?>" style="margin-top: 3px;">
								  <input name="page" type="hidden" value="<?php echo $_REQUEST['page']; ?>" />
								  </form>
								  </div>
								 </div>
								 
							  </div>
                                        <table class="table table-hover mb-0">

                                            <thead>
                                                <tr>
                                                  <th>Name</th>
                                                    <th>Description</th>
                                                    <th><div align="center">Clients</div></th>
                                                    <th>Status</th>
                                                    <th>Update</th>
                                                    <th>&nbsp;</th>
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
$where=' where    (name like "%'.$_REQUEST['keyword'].'%" or description like "%'.$_REQUEST['keyword'].'%" ) order by id desc'; 
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 
$targetpage='display.html?ga='.$_REQUEST['ga'].'&keyword='.$_REQUEST['keyword'].'&'; 
$rs=GetRecordList('*','clientGroupMaster','  '.$where.'  ','25',$page,$targetpage);

$totalentry=$rs[1];

$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 
?>

<tr>
  <td><?php echo stripslashes($rest['name']); ?></td>
  <td><?php echo stripslashes($rest['description']); ?></td>
<td> <div align="center"><i class="fa fa-user" aria-hidden="true"></i> <?php
 $a=GetPageRecord('count(id) as totalclients','clientGroupContacts',' groupId="'.$rest['id'].'" ');  
$result=mysqli_fetch_array($a); echo $result['totalclients'];
?>
</div></td>
<td><?php if($rest['status']==1){ ?><span class="badge badge-success">Active</span><?php }else{ ?><span class="badge badge-danger">Inactive</span><?php } ?></td>
<td><?php  $a=GetPageRecord('*','sys_userMaster','id="'.$rest['addedBy'].'"'); $profilename=mysqli_fetch_array($a); echo $profilename['firstName']; ?><br />
<?php echo date('d-m-Y h:i A',strtotime($rest['dateAdded'])); ?></td>
<td><a style="cursor:pointer;"  onclick="loadpop('Edit Client Group',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addclientgroup&id=<?php echo encode($rest['id']); ?>"><button type="button" class="btn btn-outline-primary waves-effect waves-light"><i class="fa fa-pencil" aria-hidden="true"></i></button></a></td>
</tr>


<?php $totalno++; } ?>
                                            </tbody>
                                        </table>
                           
									 <?php if($totalno==1){ ?>
						   <div style="text-align:center; padding:40px 0px; font-size:14px; color:#999999;">No Supplier</div>
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