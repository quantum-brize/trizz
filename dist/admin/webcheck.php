 

<div class="wrapper">
<div class="container-fluid">
<div class="main-content">

                <div class="page-content">

      
                    
                    <!-- start page title -->
                     
              
                        <div class="row">
                        <div class="col-md-12 col-xl-12">
						<div class="card" style="min-height:500px;">
                            <div class="card-body" style="padding:0px;"> 
                                    <h4 class="card-title cardtitle">Web Check<div class="float-right">
									
									 
									
									
								<?php if (strpos($LoginUserDetails["permissionAddEdit"], 'Suppliers') !== false) { ?>	<button type="button" class="btn btn-secondary btn-lg waves-effect waves-light"  onclick="loadpop2('Add Web Check',this,'600px')" data-toggle="modal"  data-target="#myModal2" data-backdrop="static"  popaction="action=webcheck" >Add Web Check</button> <?php } ?>
									</div></h4> 
							  
                                        <table class="table">
							<thead>
								<tr>
									<th width="1%">&nbsp;</th>
									<th width="70%">Flight</th>
									<th width="1%">Status</th>
									<th width="10%">&nbsp;</th>
								</tr>
							</thead>
							<tbody>
<?php 
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 
$targetpage='display.html?ga='.$_REQUEST['ga'].'&'; 
$rs=GetRecordList('*','sys_webCheckMaster',' order by id asc  ','100',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){
?>
								
<tr>
<td width="1%" align="left" valign="top"><?php if(isset($rest['logo'])){ ?><img src="upload/<?php echo stripslashes($rest['logo']); ?>" width="50" height="50"><?php } ?></td>
	<td align="left" valign="top"><a href="display.html?ga=<?php echo $_REQUEST['ga']; ?>&id=<?php echo encode($rest['id']); ?>&add=1"><?php echo stripslashes($rest['flightName']); ?></a></td>
	<td align="left" valign="top"><?php echo newstatusbadges($rest['status']); ?></td>
	<td align="left" valign="top">
	<button type="button" class="btn alpha-primary text-primary-800 btn-icon" onclick="loadpop2('Edit Web Check',this,'600px')" data-toggle="modal"  data-target="#myModal2" data-backdrop="static"  popaction="action=webcheck&id=<?php echo encode($rest['id']); ?>" ><i class="fa fa-pencil" aria-hidden="true"></i></button>
	</td>
									

							  </tr>
								 <?php $sNo++; } ?>
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