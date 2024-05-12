<?php 
$u = decode($_REQUEST['u']);

if($_REQUEST['u']==''){
$u=$_SESSION['userid'];
}
$abcd=GetPageRecord('*','userMaster','id="'.$u.'"'); 
$result=mysqli_fetch_array($abcd); 
 

?>


<div class="wrapper">
<div class="container-fluid">
<div class="main-content">

                <div class="page-content">

      
                    
                    <!-- start page title -->
                     
              
                        <div class="row">
                        <div class="col-md-12 col-xl-12">
						<div class="card">
                            <div class="card-body"> 
                                    <h4 class="card-title cardtitle" >Activity
									<form  action=""  class="newsearchsecform"  style="left: 72px;"  method="get" enctype="multipart/form-data">	
								  <input type="text" name="keyword" class="form-control newsearchsec"  placeholder="Search by name"  value="<?php echo $_REQUEST['keyword']; ?>" style="margin-top: 3px;">
								  <input name="ga" type="hidden" value="<?php echo $_REQUEST['ga']; ?>" />
								  </form>
									
									<div class="float-right">
									<a href="<?php echo $fullurl; ?>imports/activity-import.xls" class="btn btn-secondary btn-lg waves-effect waves-light btn-primary-gray" >Download Format</a>
								<button type="button" class="btn btn-secondary btn-lg waves-effect waves-light btn-primary-gray"  onclick="loadpop('Import Activity Excel',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=importactivityExcel">Import File</button>
								<a href="<?php echo $fullurl; ?>exportActivity.php" target="_blank" class="btn btn-secondary btn-lg waves-effect waves-light btn-primary-gray">Export Data</a>
								 <button type="button" class="btn btn-secondary btn-lg waves-effect waves-light"  onclick="loadpop2('Add Activity',this,'600px')" data-toggle="modal" data-target="#myModal2" data-backdrop="static"  popaction="action=addactivity">Add Activity</button>
								 
									</div></h4>
                                     
							 
                                        <table class="table table-hover mb-0">

                                            <thead>
                                                <tr>
                                                  <th>Name</th>
                                                    <th width="15%">Destination</th>
                                                    <th width="1%"><div align="center">Price</div></th>
                                                    <th width="1%">Status</th>
                                                    <th width="15%">By</th>
                                                    <th width="12%">Date</th>
                                                    <th width="1%">&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>
<?php
 
$where4='';
if($_REQUEST['keyword']!=''){
$where4=' and  name like "%'.$_REQUEST['keyword'].'%" ';
}


$totalno='1';
$select='';
$where='';
$rs=''; 
$select='*'; 
$wheremain=''; 
$where=' where 1   '.$where4.'  order by id desc'; 
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 
$targetpage='display.html?ga='.$_REQUEST['ga'].'&s='.$_REQUEST['s'].'&'; 
$rs=GetRecordList('*','sightseeingMaster','  '.$where.'  ','25',$page,$targetpage);

$totalentry=$rs[1];

$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 

$rs33=GetPageRecord($select,'sys_userMaster','id="'.$rest['addedBy'].'" '); 
$packagecreator=mysqli_fetch_array($rs33);
?>

<tr>
  <td style="cursor:pointer;" onclick="loadpop('Update Price',this,'1320px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addActivityRate&id=<?php echo encode($rest['id']); ?>">
  
  <table border="0" cellpadding="0" cellspacing="0"  class="addbynewbadges">
  <tr>
   <?php if($rest['photo']!=''){ ?> <td colspan="2"  style="padding-right:10px !important;"><img src="<?php echo $fullurl; ?>package_image/<?php echo stripslashes($rest['photo']); ?>" width="25" height="25" /></td>
   <?php } ?>
    <td><?php echo stripslashes($rest['name']); ?></td>
  </tr>
</table>   </td>
<td width="15%"><?php echo getCityName($rest['destination']); ?></td>
<td width="1%"><div align="center"><a class="dropdown-item"  style="cursor:pointer; font-size:12px; text-decoration:underline;" onclick="loadpop('Update Price',this,'1320px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addActivityRate&id=<?php echo encode($rest['id']); ?>">Update</a></div></td>
<td width="1%"><?php echo newstatusbadges($rest['status']); ?></td>
<td width="15%"><?php echo addbynewbadges($rest['addedBy']); ?></td>
<td width="12%"><?php echo date('d-m-Y', strtotime($rest['dateAdded'])); ?></td>
<td width="1%"><a class="dropdown-item neweditpan" onclick="loadpop2('Edit Activity',this,'600px')" data-toggle="modal" data-target="#myModal2" data-backdrop="static"  popaction="action=addactivity&id=<?php echo encode($rest['id']); ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
</tr>


<?php $totalno++; } ?>
                                            </tbody>
                                        </table>
                           <?php if($totalno==1){ ?>
						   <div style="text-align:center; padding:40px 0px; font-size:14px; color:#999999;">No Activity </div>
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
	
 