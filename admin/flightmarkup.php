 

<div class="wrapper">
<div class="container-fluid">
<div class="main-content">

                <div class="page-content">

      
                    
                    <!-- start page title -->
                     
              
                        <div class="row">
                        <div class="col-md-12 col-xl-12">
						<div class="card" style="min-height:500px;">
                            <div class="card-body" style="padding:0px;"> 
                                    <h4 class="card-title cardtitle">Flight Markup<div class="float-right">
								 
									
								
									</div></h4> 
							  
                                        <table class="table">
							<thead>
								<tr>
								  <th width="80%" style="padding-left:20px !important;">Name</th>
								  <th width="10%">Markup</th>
								  <th width="10%">Block&nbsp;Flights</th>
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
 
  
 $a=GetPageRecord('count(id) as totalflightsgroup','fareTypedomesticFlightsMarkupMaster',' agentTypeGroupId="'.($rest['id']).'"  ');  
$editresultgroup=mysqli_fetch_array($a); 

 $a=GetPageRecord('count(id) as totalflightsgroupblock','fareTypeblockFlightMaster',' agentTypeGroupId="'.($rest['id']).'"  ');  
$editresultgroup2=mysqli_fetch_array($a); 

 $abc=GetPageRecord('count(id) as totalflightsgroup','fareTypeofflineflightsbookingMaster',' agentTypeGroupId="'.($rest['id']).'"  ');  
$editresultgroup3=mysqli_fetch_array($abc); 
 
?>
								<tr>
								  <td width="80%" style="padding-left:20px !important;"><div style="font-weight:500;"><?php echo stripslashes($rest['name']); ?></div>																		</td>
									<td width="10%"><a href="display.html?ga=domesticflightsmarkup&typeid=<?php echo encode($rest['id']); ?>">
								    <button type="button" class="btn btn-light btn-sm" style="  background-color: #0cb5b5; color:#fff; font-weight:700;"> &nbsp;<i class="fa fa-list" aria-hidden="true"></i> Markup Group (<?php echo $editresultgroup['totalflightsgroup']; ?>)</button></a></td>
									<td width="10%"> <a href="display.html?ga=blockflights&typeid=<?php echo encode($rest['id']); ?>">
								      <button type="button" class="btn btn-light btn-sm" style="  background-color:#CC0033; color:#fff; font-weight:700;"> &nbsp;<i class="fa fa-list" aria-hidden="true"></i> Block Group (<?php echo $editresultgroup2['totalflightsgroupblock']; ?>)</button>
							      </a> </td>
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