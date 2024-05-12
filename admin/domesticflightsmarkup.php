<?php
$a=GetPageRecord('*','sys_commissionType',' id="'.decode($_REQUEST['typeid']).'"  ');  
$editresult=mysqli_fetch_array($a); 
?>
<style>
.roomratelist{padding:2px 5px; background-color:#F9F9F9; margin:2px; float:left; border:1px solid #ddd;}	
</style>
<div class="wrapper">
<div class="container-fluid">
<div class="main-content">

                <div class="page-content">

      
                    
                    <!-- start page title -->
                     
              
                        <div class="row">
                        <div class="col-md-12 col-xl-12">
						<div class="card" style="min-height:500px;">
                            <div class="card-body" style="padding:0px;"> 
                                    <h4 class="card-title cardtitle">Agent Type -  <span style="color:#FF0000;"><?php echo stripslashes($editresult['name']); ?></span> - Flight Markup<div class="float-right">
									
									<div class="float-right">
								 
									
								 <button type="button" class="btn btn-secondary btn-lg waves-effect waves-light" onclick="loadpop('Add Flight',this,'500px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=adddomesticflightsmarkup&typeid=<?php echo $_REQUEST['typeid']; ?>">Add Flight</button>  
									</div>
								 
									
								
									</div></h4> 
							  
                                        <table class="table">
							<thead>
								<tr>
								  <th width="2%"><div align="center">Sr.</div></th>
									<th width="10%">Flight</th>
									<th><div align="left">Fare Type</div></th>
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
$rs=GetRecordList('*','domesticFlightsMarkupMaster',' where   agentTypeGroupId="'.decode($_REQUEST['typeid']).'" '.$search.' order by id desc  ','250',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){  
?>
								<tr>
								  <td width="2%"><div align="center"><?php echo $sNo; ?>.</div></td>
									<td width="10%"><div style="font-weight:500;"><?php echo stripslashes($rest['name']); ?></div>																		</td>
									<td width="35%" style="text-align:center;"> 
									<div style="margin-bottom:2px; cursor:pointer;" id="displayroomrate<?php echo ($rest['id']); ?>" onclick="loadpop('Add Markup > <?php echo stripslashes($editresult['name']); ?> > <?php echo str_replace(' ',' ',stripslashes($rest['name'])); ?>',this,'800px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addfaretypedomesticFlightsMarkup&id=<?php echo encode($rest['id']); ?>&typeid=<?php echo $_REQUEST['typeid']; ?>&name=<?php echo str_replace(' ','%20',stripslashes($rest['name'])); ?>">
                                      <div align="left">
                                        <?php
$roomslist='';
$a=GetPageRecord('*','fareTypedomesticFlightsMarkupMaster',' flightId="'.$rest['id'].'" order by id desc');
if(mysqli_num_rows($a)>0){ while($roomlist=mysqli_fetch_array($a)){ $roomslist.='<div class="roomratelist">'.($roomlist['name']).' '.($roomlist['markupValue']).' '.($roomlist['markupType']).'</div>'; }  echo $roomslist; } ?> 
                                        </div>
									</div> </td>
									
									<td width="1%"><div align="center" style="width:170px;">
									<button type="button" class="btn btn-primary btn-icon btn-sm"   onclick="loadpop('Add Markup > <?php echo stripslashes($editresult['name']); ?> > <?php echo str_replace(' ',' ',stripslashes($rest['name'])); ?>',this,'800px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addfaretypedomesticFlightsMarkup&id=<?php echo encode($rest['id']); ?>&typeid=<?php echo $_REQUEST['typeid']; ?>&name=<?php echo str_replace(' ','%20',stripslashes($rest['name'])); ?>"> <i class="fa fa-plus" aria-hidden="true"></i> Add Fare Type</button>
									
									<a  style="cursor:pointer;" onclick="loadpop('Edit Flight',this,'500px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=adddomesticflightsmarkup&id=<?php echo encode($rest['id']); ?>&typeid=<?php echo $_REQUEST['typeid']; ?>">
									  <button type="button" class="btn btn-light btn-sm"> <i class="fa fa-pencil" aria-hidden="true"></i> </button>
								    </a></div></td>
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