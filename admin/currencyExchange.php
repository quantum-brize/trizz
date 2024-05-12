<?php if($LoginUserDetails['userType']!=0){ exit(); } ?>
<div class="wrapper">
<div class="container-fluid">
<div class="main-content">

                <div class="page-content">

      
                    
                    <!-- start page title -->
                     
              
                        <div class=" ">
                        <div class="col-md-12 col-xl-12">
						<div class="card" >
                            <div class="card-body" style="padding:10px;"> 
                                    <h4 class="card-title" style="margin-top: 0px !important; padding-left: 10px !important; padding-top: 10px !important; padding-bottom: 5px !IMPORTANT;padding-right: 0px !important;">Currency
                                      <div class="float-right">
									<?php if (strpos($LoginUserDetails["permissionAddEdit"], 'Suppliers') !== false) { ?>	<button type="button" class="btn btn-secondary btn-lg waves-effect waves-light"  onclick="loadpop('Add Currency',this,'400px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addcurrencyexchange" style="margin-bottom:20px;">Add Currency</button> <?php } ?>
									</div></h4>
                  
							 
                                        <table class="table table-hover mb-0">

                                            <thead>
                                                <tr>
                                                  <th width="1%">&nbsp;</th>
                                                  <th>Name</th>
                                                    <th>Conversion (USD)</th>
                                                    <th>Status</th>
                                                    <th>Update</th>
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
$where=' where name!="" order by id desc'; 
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 
$targetpage='display.html?ga='.$_REQUEST['ga'].'&keyword='.$_REQUEST['keyword'].'&'; 
$rs=GetRecordList('*','currencyExchangeMaster','  '.$where.'  ','2500',$page,$targetpage);

$totalentry=$rs[1];

$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 
?>

<tr>
  <td width="1%"><img style="height:20px; width:auto;" src="upload/<?php echo stripslashes($rest['flagImg']); ?>" /></td>
  <td><?php echo stripslashes($rest['name']); ?></td>
  <td><?php echo stripslashes($rest['rate']); ?></td>
  <td><?php if($rest['status']==1){ echo 'Active'; }else{ echo 'Inactive'; } ?></td>
<td> 
<?php echo date('d-m-Y', strtotime($rest['dateAdded'])); ?></td>
<td width="1%"> 
                                            <a style="cursor:pointer;" onclick="loadpop('Edit Currency',this,'400px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addcurrencyexchange&id=<?php echo encode($rest['id']); ?>">Edit</a>
                                             
                      </td>
</tr>


<?php $totalno++; } ?>
                                            </tbody>
                              </table>
                           
									
						  </div>
								 
                             
</div>
                             

                        </div>

                         
						
						
						
						 
                     

             </div><!--end col-->
			 
			 
			 
			 
			 
			 
			  

            <!-- end row -->

    </div>

        <!-- End Page-content -->

         
    </div>
  </div>	</div>