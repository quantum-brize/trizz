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

      <div class="newboxheading"><div class="newhead">Landing Pages<div class="newoptionmenu">
  	
		<div>	<?php if (strpos($LoginUserDetails["permissionAddEdit"], 'Suppliers') !== false) { ?>	
				<a href="display.html?ga=landingpages&add=1">
				<button type="button" class="btn btn-secondary btn-lg waves-effect waves-light"    style="margin-bottom:20px;">Create Landing Page</button>
				</a> <?php } ?></div>					  <div><form  action=""    method="post" enctype="multipart/form-data">	
								  <input type="text" name="keyword" class="form-control"  placeholder="Search by name"  value="<?php echo $_REQUEST['keyword']; ?>" style="margin-top: 3px;">
								  <input name="page" type="hidden" value="<?php echo $_REQUEST['page']; ?>" />
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
                                                <tr>                                                   <th width="18">ID</th>
                                                    <th width="111">Template&nbsp;Name </th>
                                                    <th width="113">Banner&nbsp;Heading </th>
                                                    <th width="134">Banner&nbsp;Subheading </th>
                                                    <th width="100">Main&nbsp;Heading </th>
                                                    <th width="121">Status</th>
                                                    <th width="130">By</th>
                                                    <th width="1%">&nbsp;</th>
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
$where=' where    (name like "%'.$_REQUEST['keyword'].'%" or  bannerHeading like "%'.$_REQUEST['keyword'].'%" or  mainHeading like "%'.$_REQUEST['keyword'].'%"  ) order by id desc'; 
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 
$targetpage='display.html?ga='.$_REQUEST['ga'].'&keyword='.$_REQUEST['keyword'].'&'; 
$rs=GetRecordList('*','landingPages','  '.$where.'  ','25',$page,$targetpage);

$totalentry=$rs[1];

$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){

 
?>

<tr>
   
  <td><a style="cursor:pointer;" href="display.html?ga=landingpages&add=1&id=<?php echo encode($rest['id']); ?>"><?php echo encode($rest['id']); ?></a></td>
  <td  ><?php echo stripslashes($rest['name']); ?></td>
  <td  ><?php echo stripslashes($rest['bannerHeading']); ?></td>
  <td><?php echo stripslashes($rest['bannerSubHeading']); ?></td>
  <td style="font-size:12px;"><?php echo stripslashes($rest['mainHeading']); ?></td>
  <td style="font-size:12px;"><?php if($rest['status']==1){ ?><span class="badge badge-success">Active</span><?php }else{ ?><span class="badge badge-danger">Inactive</span><?php } ?></td>
  <td style="font-size:12px;">
<div style="width:130px;"><?php  $a=GetPageRecord('*','sys_userMaster','id="'.$rest['addedBy'].'"'); $profilename=mysqli_fetch_array($a); echo $profilename['firstName']; ?><br />
<?php echo date('d-m-Y h:i A',strtotime($rest['dateAdded'])); ?></div></td>
  <td width="1%" style="font-size:12px;"> 
 <a class="dropdown-item neweditpan"  href="<?php echo $landingpage; ?><?php echo stripslashes($rest['pageURL']); ?>" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a> </td>
  <td width="1%" style="font-size:12px;"> 
 <a class="dropdown-item neweditpan"  href="display.html?ga=landingpages&add=1&id=<?php echo encode($rest['id']); ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a> </td>
</tr>


<?php $totalno++; } ?>
                                            </tbody>
                                        </table>
										
							  </form>
                           
									 <?php if($totalno==1){ ?>
						   <div style="text-align:center; padding:40px 0px; font-size:14px; color:#999999;">No Landing Page</div>
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