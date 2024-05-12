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
						<div class="card" style="min-height:500px;">
                            <div class="card-body"> 
                                    <h4 class="card-title cardtitle cardtitle" >Lead Source
									<form  action=""  class="newsearchsecform"   method="post" enctype="multipart/form-data">	
								  <input type="text" name="keyword" class="form-control newsearchsec"  placeholder="Search by name"  value="<?php echo $_REQUEST['keyword']; ?>" >
								  <input name="page" type="hidden" value="<?php echo $_REQUEST['page']; ?>" />
								  </form>
								  
								  
									<div class="float-right">
								   <button type="button" class="btn btn-secondary btn-lg waves-effect waves-light"  onclick="loadpop2('Add Lead Source',this,'400px')" data-toggle="modal"  data-target="#myModal2" data-backdrop="static" popaction="action=addleadsource"   >Add Lead Source</button>  
									</div></h4> 
							  
                                        <table class="table table-hover mb-0">

                                            <thead>
                                                <tr>
                                                  <th width="40">Name</th>
                                                    <th width="4%">Status</th>
                                                    <th width="15%"> By</th>
                                                    <th width="15%">Date</th>
                                                    <th width="2%" align="left">&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>
<?php
$wheres='';
if($_REQUEST['keyword']!=''){
$wheres=' and  name like "%'.$_REQUEST['keyword'].'%" ';
}

$totalno='1';
$totalmail='0';
$select='';
$where='';
$rs=''; 
$select='*'; 
$wheremain=''; 
$where=' where name!="" '.$wheres.' order by id desc'; 
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 
$targetpage='display.html?ga='.$_REQUEST['ga'].'&keyword='.$_REQUEST['keyword'].'&'; 
$rs=GetRecordList('*','querySourceMaster','  '.$where.'  ','25',$page,$targetpage);

$totalentry=$rs[1];

$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 
?>

<tr>
  <td style="cursor:pointer;"  onclick="loadpop2('Edit Lead Source',this,'400px')" data-toggle="modal" data-target="#myModal2" data-backdrop="static" popaction="action=addleadsource&id=<?php echo encode($rest['id']); ?>" ><?php echo stripslashes($rest['name']); ?></td>
<td width="4%"><?php echo newstatusbadges($rest['status']); ?></td>
<td width="15%"><?php echo addbynewbadges($rest['addedBy']); ?></td>
<td width="15%">
<?php echo date('d-m-Y', strtotime($rest['dateAdded'])); ?></td>
<td width="2%" align="left">
<a class="dropdown-item neweditpan" onclick="loadpop2('Edit Lead Source',this,'400px')" data-toggle="modal"  data-target="#myModal2" data-backdrop="static" popaction="action=addleadsource&id=<?php echo encode($rest['id']); ?>" ><i class="fa fa-pencil" aria-hidden="true"></i></a> </td>
</tr>


<?php $totalno++; } ?>
                                            </tbody>
                                        </table>
                           
									 <?php if($totalno==1){ ?>
						   <div style="text-align:center; padding:40px 0px; font-size:14px; color:#999999;">No Lead Source</div>
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