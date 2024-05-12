<?php
if($_REQUEST['did']!=''){
deleteRecord('domesticHotelMarkupMaster','id="'.decode($_REQUEST['did']).'"'); 
}
?>

<div class="wrapper">
<div class="container-fluid">
<div class="main-content">

                <div class="page-content">

      
                    
                    <!-- start page title -->
                     
              
                        <div class="row">
                        <div class="col-md-12 col-xl-12">
						<div class="card" style="min-height:500px;">
                            <div class="card-body" style="padding:0px;"> 
                                    <h4 class="card-title cardtitle">Hotel Markup
                                      <div class="float-right"> 
									
								 <button type="button" class="btn btn-secondary btn-lg waves-effect waves-light" onclick="loadpop('Add Hotel',this,'500px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=adddomestichotelsmarkup">Add Hotel</button>  
							 
								
									</div></h4> 
							  
                                        <table class="table">
							<thead>
								<tr>
								  <th width="2%"><div align="center">Sr.</div></th>
									<th>Group</th>
									<th><div align="left">Name</div></th>
									<th><div align="center">Markup</div></th>
									<th>Markup</th>
									<th width="4%"><div align="center">Edit</div></th>
								    <th width="4%" align="right">Delete</th>
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
$rs=GetRecordList('*','domesticHotelMarkupMaster',' where addBy="'.$_SESSION['userid'].'"  '.$search.' order by id desc  ','100',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 


$a=GetPageRecord('*','sys_commissionType','id="'.$rest['groupId'].'"  order by id desc'); 
$groupname=mysqli_fetch_array($a)
 
?>
								<tr>
								  <td width="2%"><div align="center"><?php echo $sNo; ?>.</div></td>
									<td><div style="font-weight:500;"><?php echo stripslashes($groupname['name']); ?></div>																		</td>
									<td style="text-align:center;"><div align="left"><?php echo stripslashes($rest['name']); ?></div></td>
									<td style="text-align:center;"> 
									<div style="margin-bottom:2px; cursor:pointer;" id="displayroomrate<?php echo ($rest['id']); ?>" onclick="loadpop('Add Markup',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addfaretypedomesticHotelMarkup&id=<?php echo encode($rest['id']); ?>">
<?php
$roomslist='';
$a=GetPageRecord('*','fareTypedomesticHotelMarkupMaster',' hotelId="'.$rest['id'].'" and addBy="'.$_SESSION['userid'].'" order by id desc');
if(mysqli_num_rows($a)>0){ while($roomlist=mysqli_fetch_array($a)){ $roomslist.='<div class="roomratelist">'.($roomlist['name']).' '.($roomlist['markupValue']).' '.($roomlist['markupType']).'</div>'; }  echo $roomslist; } ?> 
									</div> </td>
									
									<td><button type="button" class="btn btn-primary btn-icon btn-sm"   onclick="loadpop('Add Markup',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addfaretypedomesticHotelMarkup&id=<?php echo encode($rest['id']); ?>"> <i class="fa fa-plus" aria-hidden="true"></i> Add</button></td>
									<td width="4%"><div align="center">
									
									
									<a  style="cursor:pointer;" onclick="loadpop('Edit Hotel',this,'500px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=adddomestichotelsmarkup&id=<?php echo encode($rest['id']); ?>">
									  <button type="button" class="btn btn-light btn-sm"> <i class="fa fa-pencil" aria-hidden="true"></i> </button>
								    </a></div></td>
								    <td width="4%" align="right"><div align="center"><a  style="cursor:pointer;" href="display.html?keyword=&ga=domestichotelsmarkup&did=<?php echo encode($rest['id']); ?>" onclick="return confirm('Are you sure want to delte this markup?')">
									  <button type="button" class="btn btn-light btn-sm"> <i class="fa fa-trash" aria-hidden="true" style="color:#FF0000;"></i> </button>
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