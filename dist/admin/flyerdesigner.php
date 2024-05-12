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

      <div class="newboxheading"><div class="newhead">Flyer Designer 
 <form  action=""  class="newsearchsecform"  style="top: -9px; left: 56px !important;"  method="get" enctype="multipart/form-data">	
								  <input type="text" name="keyword" class="form-control newsearchsec"  placeholder="Search by name"  value="<?php echo $_REQUEST['keyword']; ?>" style="margin-top: 3px;margin-left: 50px;">
								  <input name="ga" type="hidden" value="<?php echo $_REQUEST['ga']; ?>" />
								  </form>
 </div>     
 
     
</div>
                    
                    <!-- start page title -->
                     
              
                        <div class=" ">
                        <div class="col-md-12 col-xl-12" style=" padding-top: 45px;">
						<div class="card" style="min-height:500px;padding: 10px;">
                            <div class="card-body" style="padding:0px;"> 
                                      
							  <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm" >
							 <?php if($_SESSION['userid']==1){ ?> <div id="bulkassign" style="display:none;padding: 5px 2px; background-color: #f0f0f0; border-bottom: 2px solid #ddd; border-radius: 3px; margin-bottom: 10px; width:100%; float:left;"><table border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td style="font-size:13px;"><input type="checkbox" id="ckbCheckAll"  style="width: 16px; height: 16px;margin-left: 6px;" /></td>
    <td style="font-size:13px;">Select All&nbsp;</td>
    <td><select id="assignToPerson" name="assignToPerson" class="form-control" style="padding: 5px; font-size: 12px; height: 30px; line-height: 20px; color: #000; font-weight: 600;"   autocomplete="off" >
  <option value="0" >Select Client Group</option>
  <?php  

$rs22=GetPageRecord('*','clientGroupMaster','  status=1 order by name asc'); 
while($restuser=mysqli_fetch_array($rs22)){ 
?>
  <option value="<?php echo $restuser['id']; ?>" ><?php echo stripslashes($restuser['name']); ?></option>
  <?php } ?>
</select></td>
    <td><button type="submit"  id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.value='Saving...';"  style="float:right;padding: 3px 10px;"  >
                                                Save
                                            </button></td>
    <td><input autocomplete="false" name="action" type="hidden" id="action" value="bulkclientaddtogroup" /></td>
  </tr>
</table>
</div> <?php } ?>



 

<div class="bodyareahome" >
<div class="bodysections">
<div class="lighttext">Here's a few things you can create</div>
<h1 style="    font-size: 30px;">Tell your story with easy way!</h1>

<div class="listtypehome">
<a href="#" onclick="createflyer('Instagram Story');"><img src="flyer-designer/images/instagramstory.PNG" /><div>Instagram Story</div></a>
<a href="#"  onclick="createflyer('Instagram Post');"><img src="flyer-designer/images/instagrampost.PNG" /><div>Instagram Post</div></a>
<a href="#"  onclick="createflyer('Facebook Post');"><img src="flyer-designer/images/facebookpost.PNG" /><div>Facebook Post</div></a>
<a href="#"  onclick="createflyer('Emailer');"><img src="flyer-designer/images/emailer.PNG" /><div>Emailer</div></a> 
</div>



</div>

<div class="bodysections">
<div class="lighttext">&nbsp;</div>
<h1 style="font-size: 30px;">Flyer Projects</h1>
 

</div>

</div>
 

 






							 <table class="table table-hover mb-0">

                                            <thead>
                                                <tr>
                                                  <th width="2%">#</th>
                                                  <th>Name</th>
                                                    <th>Type</th>
                                                    <th>Size</th>
                                                    <th>Last Update</th>
                                                    <th width="2%">&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody><?php

$searchKeyword='';
$searchKeyword=$_REQUEST['keyword'];
$totalmail='0';
$select='';
$where='';
$rs=''; 
$select='*'; 
$wheremain='';
if($searchKeyword!=''){ 
 $searchwhere=' and (	name like "%'.$searchKeyword.'%"    )'; 
}


$where=' where flyerHTML!="" '.$searchwhere.' order by id desc'; 
 
$limit=clean($_GET['records']);
$page=clean($_GET['page']);

$sNo=1;

$targetpage='display.html?ga='.$_REQUEST['ga'].'&keyword='.$searchKeyword.'&';
 
$rs=GetRecordList('*','flyer_project','  '.$where.'  ','50',$page,$targetpage);

$totalentry=$rs[1];

$paging=$rs[2]; //pagination

while($rest=mysqli_fetch_array($rs[0])){ 
?>

<tr>
  <td width="2%"><?php echo $sNo; ?></td>
  <td><strong><?php echo stripslashes($rest['name']); ?></strong></td>
  <td><?php echo stripslashes($rest['projectType']); ?></td>
  <td><?php echo stripslashes($rest['pageWidth']); ?> - <?php echo stripslashes($rest['pageHeight']); ?></td>
  <td><?php echo date('d/m/Y h:i A',strtotime($rest['editDate'])); ?></td>
  <td width="2%">
<a class="dropdown-item neweditpan"  href="<?php echo $fullurl; ?>flyer-designer/edit-project.html?id=<?php echo encode($rest['id']); ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a> </td>
</tr>


<?php $sNo++; } ?>
                                            </tbody>
                                        </table> 
							  
							   
							  </form>
							  
                                         
                           
									 <?php if($totalno==1){ ?>
						   <div style="text-align:center; padding:40px 0px; font-size:14px; color:#999999;">No Clients</div>
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
function createflyer(type){
var typevar=encodeURI(type); 
$('#actionload').load('actionpage.php?typevar='+typevar+'&action=createflyer');
}

function deleteproject(id){
if(confirm('Are you sure you want to delete this project?')){
$('#actionload').load('actionpage.php?did='+id+'&action=deleteproject');
}
}
</script>
<div id="actionload" style="display:none;"></div>
