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
                                    <h4 class="card-title cardtitle">Call Back Request
									 
									
									
									<div class="float-right">
								   
									</div></h4> 
							  
                                        <table class="table table-hover mb-0">

                                            <thead>
                                                <tr>
                                                  <th width="1%">Type</th>
                                                  <th>Client Name</th>
                                                    <th>Mobile</th>
                                                    <th>Email</th>
                                                    <th>Package</th>
                                                    <th>Query</th>
                                                    <th>Response Date</th>
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
$where=' where 1 order by id desc'; 
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 
$targetpage='display.html?ga='.$_REQUEST['ga'].'&keyword='.$_REQUEST['keyword'].'&'; 
$rs=GetRecordList('*','automationCallBack','  '.$where.'  ','25',$page,$targetpage);

$totalentry=$rs[1];

$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 


$rs133=GetPageRecord('*','sys_packageBuilder','id="'.$rest['packageId'].'" ');   
$packageDatas=mysqli_fetch_array($rs133); 

$asclient=GetPageRecord('*','userMaster','id="'.$rest['clientId'].'"'); 
$clientDetails=mysqli_fetch_array($asclient);  
?>

<tr>
  <td width="1%"><?php if($rest['callBackType']==1){ ?><span class="badge badge-primary">Interest</span><?php } ?><?php if($rest['callBackType']==2){ ?><span class="badge badge-orange">Call Back</span><?php } ?></td>
  <td><?php echo  stripslashes($clientDetails['firstName']); ?></td>
  <td><?php echo  stripslashes($clientDetails['mobile']); ?></td>
  <td><?php echo  stripslashes($clientDetails['email']); ?></td>
  <td><a href="display.html?ga=itineraries&view=1&id=<?php echo encode($packageDatas['id']); ?>&b=3" target="_blank" style="color:#0066CC !important;"><?php echo stripslashes($packageDatas['name']); ?></a></td>
  <td><a href="display.html?ga=query&view=1&id=<?php echo  encode($rest['queryId']); ?>" target="_blank" style="color:#0066CC !important;"><?php echo  encode($rest['queryId']); ?></a></td>
  <td><?php echo date('d-m-Y - h:i A', strtotime($rest['addDate'])); ?></td>
</tr>


<?php $totalno++; } ?>
                                            </tbody>
                                        </table>
                           
									 <?php if($totalno==1){ ?>
						   <div style="text-align:center; padding:40px 0px; font-size:14px; color:#999999;">No Data</div>
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