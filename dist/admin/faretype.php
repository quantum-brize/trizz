 

<div class="wrapper">
<div class="container-fluid">
<div class="main-content">

                <div class="page-content">

      
                    
                    <!-- start page title -->
                     
              
                        <div class="row">
                        <div class="col-md-12 col-xl-12">
						<div class="card" style="min-height:500px;">
                            <div class="card-body" style="padding:0px;"> 
                                    <h4 class="card-title cardtitle">Fare Type<div class="float-right">
								 
									
								 <button type="button" class="btn btn-secondary btn-lg waves-effect waves-light"  onclick="loadpop('Add Fare Type',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addfaretype">Add Fare Type</button>  
									</div></h4> 
							  
                                        <table class="table">
							<thead>
								<tr>
								  <th>Flight Name</th>
									<th width="20%">Fare Type </th>
									<th width="5%">&nbsp;</th>
									<th width="20%">Display Fare Type </th>
									<th width="1%"><div align="center">Edit</div></th>
								</tr>
							</thead>
							<tbody>
							
							<?php 
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 

if($_REQUEST['keyword']!=''){
$search.=' and flightName like "%'.$_REQUEST['keyword'].'%" ';
} 

$search.='';

 
$targetpage='display.html?ga='.$_REQUEST['ga'].'&keyword='.$_REQUEST['keyword'].'&'; 
$rs=GetRecordList('*','fareTypeMaster',' where 1 '.$search.' order by id desc  ','100',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){  
?>
								<tr>
<td><div style="font-weight:500;"><?php echo stripslashes($rest['flightName']); ?></div></td>
<td width="20%"><span style="font-weight:500;">

<?php
$string = preg_replace('/\.$/', '', $rest['fareTypeName']); $array = explode(',', $string); foreach($array as $value){
?>
<span class="badge badge-secondary"><?php echo $value; ?></span>
<?php } ?></td>
<td width="5%"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></td>
<td width="20%"> 

<span class="badge badge-secondary" style=" <?php if($rest['displayColor']!=''){ ?>background-color:<?php echo $rest['displayColor']; ?>;<?php } ?>"><?php echo stripslashes($rest['displayType']); ?></span> </td>
<td width="1%"><div align="center"><a  style="cursor:pointer;" onclick="loadpop('Edit Fare Type',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addfaretype&id=<?php echo encode($rest['id']); ?>">
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