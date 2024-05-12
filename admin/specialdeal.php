 

<div class="wrapper">
<div class="container-fluid">
<div class="main-content">

                <div class="page-content">

      
                    
                    <!-- start page title -->
                     
              
                        <div class="row">
                        <div class="col-md-12 col-xl-12">
						<div class="card" style="min-height:500px;">
                            <div class="card-body" style="padding:0px;"> 
                                    <h4 class="card-title cardtitle">Special Deal<div class="float-right">
								 
									
								 <button type="button" class="btn btn-secondary btn-lg waves-effect waves-light"  onclick="loadpop2('Add Special Deal',this,'600px')" data-toggle="modal"  data-target="#myModal2" data-backdrop="static"  popaction="action=specialdeal" >Add Special Deal</button>  
									</div></h4> 
							  
                                        <table class="table">
							<thead>
								<tr>
									<th width="1%">&nbsp;</th>
									<th width="25%">Title</th>
									<th width="5%"><div align="center">Type</div></th>
									<th width="5%">Status</th>
									<th width="1%">Date</th>
									<th width="1%">&nbsp;</th>
								</tr>
							</thead>
							<tbody>
<?php 
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 
$targetpage='display.html?ga='.$_REQUEST['ga'].'&'; 
$rs=GetRecordList('*','sys_specialDeal',' where addBy=1    order by id desc  ','100',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){
?>
								
<tr>
	<td width="1%" align="left" valign="top"><?php if(isset($rest['image'])){ ?><img src="upload/<?php echo stripslashes($rest['image']); ?>" width="50"  ><?php } ?></td>
	
	<td align="left" valign="top"><?php echo stripslashes($rest['title']); ?></td>
	
	<td width="5%" align="left" valign="top" style="text-transform:uppercase;"><div align="center"><strong><?php echo stripslashes($rest['dealType']); ?></strong></div></td>
	<td width="5%" align="left" valign="top"><?php echo newstatusbadges($rest['status']); ?></td>
	
	<td width="5%" align="left" valign="top"><?php echo date("d-m-Y",strtotime($rest['addDate'])); ?></td>
	
	<td width="1%" align="left" valign="top">
	<a  onclick="loadpop2('Edit Special Deal',this,'600px')" data-toggle="modal"  data-target="#myModal2" data-backdrop="static"  popaction="action=specialdeal&id=<?php echo encode($rest['id']); ?>" >
	<button type="button" class="btn alpha-primary text-primary-800 btn-icon"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>	</td>
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