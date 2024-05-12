 

<div class="wrapper">
<div class="container-fluid">
<div class="main-content">

                <div class="page-content">

      
                    
                    <!-- start page title -->
                     
              
                        <div class="row">
                        <div class="col-md-12 col-xl-12">
						<div class="card" style="min-height:500px;">
                            <div class="card-body" style="padding:0px;"> 
                                    <h4 class="card-title cardtitle">Agent Group<div class="float-right">
								 
									
								 <button type="button" class="btn btn-secondary btn-lg waves-effect waves-light"  onclick="loadpop('Agent Type',this,'500px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addcommissiontype"  >Add Agent Group</button>  
									</div></h4> 
							  
                                        <table class="table">
							<thead>
								<tr>
								  <th width="70%" style="padding-left:20px !important;">Name</th>
								  <th>Update Date</th>
									<th width="1%"><div align="center">Edit</div></th>
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
$rs=GetRecordList('*','sys_commissionType',' where 1 '.$search.' order by id desc  ','100',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 
 
 
 
?>
								<tr>
								  <td width="70%" style="padding-left:20px !important;"><div style="font-weight:500;"><?php echo stripslashes($rest['name']); ?></div>																		</td>
									<td><?php if($rest['editDate']!='' && $rest['editDate']!='0'){ echo date('d-m-Y h:i A',strtotime($rest['editDate'])); } else { echo '-'; } ?></td>
									<td><div align="center"><a  style="cursor:pointer;" onclick="loadpop('Edit Agent Group',this,'500px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addcommissiontype&id=<?php echo encode($rest['id']); ?>">
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