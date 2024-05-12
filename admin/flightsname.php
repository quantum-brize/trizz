 

<div class="wrapper">
<div class="container-fluid">
<div class="main-content">

                <div class="page-content">

      
                    
                    <!-- start page title -->
                     
              
                        <div class="row">
                        <div class="col-md-12 col-xl-12">
						<div class="card" style="min-height:500px;">
                            <div class="card-body" style="padding:0px;"> 
                                    <h4 class="card-title cardtitle">Flight Name & Logo<div class="float-right">
								 
									
								 <button type="button" class="btn btn-secondary btn-lg waves-effect waves-light"  onclick="loadpop('Add Flight',this,'500px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addflightname">Add Flight</button>  
									</div></h4> 
							  
                                        <table class="table">
							<thead>
								<tr>
								  <th width="1%"style="padding-left:20px !important;"><div align="left">Logo</div></th>
									<th style="padding-left:20px !important;"><div align="left">Name</div></th>
									<th width="15%"><div align="left">By</div></th>
								    <th width="10%"><div align="left">Date</div></th>
							      <th width="1%"><div align="left">Edit</div></th>
								</tr>
							</thead>
							<tbody>
							
							<?php 
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 

if($_REQUEST['keyword']!=''){
$search.=' and name like "%'.$_REQUEST['keyword'].'%" ';
} 

$search.='';

 
$targetpage='display.html?ga='.$_REQUEST['ga'].'&keyword='.$_REQUEST['keyword'].'&'; 
$rs=GetRecordList('*','sys_flightName',' where 1 '.$search.' order by id desc  ','100',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 
 
?>
								<tr>
								  <td width="1%" style="padding-left:20px !important;"><div style="width:32px; height:32px; overflow:hidden; border:1px solid #ddd; ">
								    <div align="left"><img src="<?php if($rest['details']!=''){ echo 'upload/'.stripslashes($rest['details']); } else { ?>assets/hotelnoimage.png<?php } ?>" style="width:50px; height:50px;" /></div>
								  </div></td>
									<td style="padding-left:20px !important;"><div style="font-weight:500;">
									  <div align="left"><?php echo stripslashes($rest['name']); ?></div>
									</div>																		</td>
									<td width="15%">									 
									  <div align="left"><strong><?php echo getUserName($rest['editBy']); ?></strong>							          </div></td>
									
									<td width="10%"><div align="left">
									  <?php if($rest['editDate']!='' && $rest['editDate']!='0'){ echo date('d-m-Y h:i A',strtotime($rest['editDate'])); } else { echo '-'; } ?>
								    </div></td>
									<td width="1%"><div align="left"><a  style="cursor:pointer;" onclick="loadpop('Edit Flight',this,'500px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addflightname&id=<?php echo encode($rest['id']); ?>">
									  <button type="button" class="btn btn-light btn-sm"> <i class="fa fa-pencil" aria-hidden="true"></i> </button>
								  </a></div></td>
								</tr> 
								<?php } ?>
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