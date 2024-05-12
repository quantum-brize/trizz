<?php
 
?>

 <style>
.table td, .table th {
    vertical-align: top;
}
.statusbox{margin-right: 5px; padding: 10px; text-align: center; background-color: #000000; font-size: 13px; color: #fff; border-radius: 4px; text-transform:uppercase;}

.cardgray { padding: 18px; background-color: #f2f2f24a; min-height: 105px; border: 1px solid #ddd; box-shadow: 3px 3px 6px #00000036 !important; color: #000; }
.cardgray .badge.badge-soft-danger { background-color: #f1646c !important; color: #fff !important; padding: 7px; font-size: 12px; }
.cardgray .badge.badge-soft-success { background-color: #1ecab8 !important; color: #fff !important; padding: 7px; font-size: 12px; }

</style>
<div class="wrapper">
<div class="container-fluid">
<div class="main-content">

                <div class="page-content">

      
                    
                    <!-- start page title -->
                     
              
                        <div class=" ">
                        <div class="col-md-12 col-xl-12">
						<div class="card"  >
                            <div class="card-body" style="padding:20px;"> 
                                    <h4 class="card-title" style="margin-top: 0px; padding-top: 0px !important; padding-bottom: 10px !important; padding-left: 10px !important;">Marketing Dashboard</h4> 
							  
							  
							   
							  
                                       
         
                        <div class="col-12"> 
							
							 <div class="row">
                                <div class="col-md-3">
								<div class="card cardgray">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div>
                                                        <p class="text-muted font-weight-medium mt-1 mb-2"><?php echo date('F'); ?>'s Campaigns</p>
                                                        <h4><?php echo $thismonth=countlisting('id','campaignMaster',' where deleteStatus=0  and MONTH(dateAdded)='.date('m').' and YEAR(dateAdded)='.date('Y').'');  $lstmonth=countlisting('id','campaignMaster',' where deleteStatus=0  and MONTH(dateAdded)='.date("m",strtotime("-1 month")).' and YEAR(dateAdded)='.date('Y').''); if($thismonth<1){ echo '0'; } ?></h4>
														
														<?php if($lstmonth=='' || $lstmonth==0){ $lstmonth=1; } if($thismonth=='' || $thismonth==0){ $thismonth=1; } if($thismonth>=$lstmonth){
											 
														 ?>
														<span class="badge badge-soft-success mr-2" style="position: absolute; right: 0px; bottom: 6px;"> <?php echo round(($thismonth/$lstmonth)*100); ?>% <i class="mdi mdi-arrow-up"></i> </span>
														<?php } else { ?>
														<span class="badge badge-soft-danger mr-2" style="position: absolute; right: 0px; bottom: 6px;"> <?php echo round(($thismonth/$lstmonth)*100); ?>% <i class="mdi mdi-arrow-down"></i> </span>
														<?php } ?>
                                                    </div>
                                                </div>

                                                 
                                            </div>

                                             
                                        </div>
                                    </div>
								
								</div>
								
								<div class="col-md-3">
								<div class="card cardgray">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div>
                                                        <p class="text-muted font-weight-medium mt-1 mb-2"><?php echo date('F'); ?>'s Leads</p>
                                                        <h4><?php echo $thismonth=countlisting('id','queryMaster',' where deleteStatus=0  and MONTH(dateAdded)='.date('m').' and YEAR(dateAdded)='.date('Y').' and statusId=1'); $lstmonth=countlisting('id','queryMaster',' where deleteStatus=0  and MONTH(dateAdded)='.date("m",strtotime("-1 month")).' and YEAR(dateAdded)='.date('Y').' and statusId=1'); if($thismonth<1){ echo '0'; } ?></h4>
														
														
									<?php if($lstmonth=='' || $lstmonth==0){ $lstmonth=1; } if($thismonth=='' || $thismonth==0){ $thismonth=1; } if($thismonth>=$lstmonth){
											 
														 ?>
														<span class="badge badge-soft-success mr-2" style="position: absolute; right: 0px; bottom: 6px;"> <?php echo round(($thismonth/$lstmonth)*100); ?>% <i class="mdi mdi-arrow-up"></i> </span>
														<?php } else { ?>
														<span class="badge badge-soft-danger mr-2" style="position: absolute; right: 0px; bottom: 6px;"> <?php echo round(($thismonth/$lstmonth)*100); ?>% <i class="mdi mdi-arrow-down"></i> </span>
														<?php } ?>
									
									
                                                    </div>
                                                </div>

                                                 
                                            </div>

                                             
                                        </div>
                                    </div>
								
								</div>
								
								<div class="col-md-3">
								<div class="card cardgray">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div>
                                                        <p class="text-muted font-weight-medium mt-1 mb-2">In <?php echo date('F'); ?> Email Sent</p>
                                                        <h4><?php 
												$abcd=GetPageRecord('SUM(contacts) as totalmailsent','campaignMaster','  MONTH(dateAdded)='.date('m').' and YEAR(dateAdded)='.date('Y').' and status=1 '); 
												$mailsent=mysqli_fetch_array($abcd); echo $thismonth=$totalthismonthemail=$mailsent['totalmailsent']+countlisting('id','feedbackMaster',' where  MONTH(dateAdded)='.date('m').' and YEAR(dateAdded)='.date('Y').'  ');
												
												if($totalthismonthemail==''){echo '0'; }
												
												
												
												$abcd=GetPageRecord('SUM(contacts) as totalmailsentlat','campaignMaster','  MONTH(dateAdded)='.date("m",strtotime("-1 month")).' and YEAR(dateAdded)='.date('Y').' and status=1 '); 
												$mailsent=mysqli_fetch_array($abcd);  $lstmonth=$totalthismonthemail=$mailsent['totalmailsentlat']+countlisting('id','feedbackMaster',' where  MONTH(dateAdded)='.date("m",strtotime("-1 month")).' and YEAR(dateAdded)='.date('Y').'  ');
												
											
												
														
														 ?></h4>
														 
														 
														 <?php if($lstmonth=='' || $lstmonth==0){ $lstmonth=1; } if($thismonth=='' || $thismonth==0){ $thismonth=1; } if($thismonth>=$lstmonth){
											 
														 ?>
														<span class="badge badge-soft-success mr-2" style="position: absolute; right: 0px; bottom: 6px;"> <?php echo round(($thismonth/$lstmonth)*100); ?>% <i class="mdi mdi-arrow-up"></i> </span>
														<?php } else { ?>
														<span class="badge badge-soft-danger mr-2" style="position: absolute; right: 0px; bottom: 6px;"> <?php echo round(($thismonth/$lstmonth)*100); ?>% <i class="mdi mdi-arrow-down"></i> </span>
														<?php } ?>
									
									
                                                    
														 
                                                    </div>
                                                </div>

                                                 
                                            </div>

                                             
                                        </div>
                                    </div>
								
								</div>
								
								
								<div class="col-md-3">
								<div class="card cardgray">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                  <div>
                                                        <p class="text-muted font-weight-medium mt-1 mb-2"><?php echo date('F'); ?>'s Feedback Response</p>
                                                        <h4><?php echo $thismonth=countlisting('id','feedbackMaster',' where ratingStar!=0  and MONTH(dateAdded)='.date('m').' and YEAR(dateAdded)='.date('Y').'  '); $lstmonth=countlisting('id','feedbackMaster',' where ratingStar!=0  and MONTH(dateAdded)='.date("m",strtotime("-1 month")).' and YEAR(dateAdded)='.date('Y').'  '); if($thismonth<1){ echo '0'; } ?></h4>
														
														
													  <?php if($lstmonth=='' || $lstmonth==0){ $lstmonth=1; } if($thismonth=='' || $thismonth==0){ $thismonth=1; } if($thismonth>=$lstmonth){
											 
														 ?>
													  <span class="badge badge-soft-success mr-2" style="position: absolute; right: 0px; bottom: 6px;"> <?php echo round(($thismonth/$lstmonth)*100); ?>% <i class="mdi mdi-arrow-up"></i> </span>
													  <?php } else { ?>
												    <span class="badge badge-soft-danger mr-2" style="position: absolute; right: 0px; bottom: 6px;"> <?php echo round(($thismonth/$lstmonth)*100); ?>% <i class="mdi mdi-arrow-down"></i> </span>
												    <?php } ?>
                                                  </div>
                                                </div>

                                                 
                                            </div>

                                             
                                        </div>
                                    </div>
								
								</div>
								
								</div>
								
								
								
									<div class="d-flex align-items-center justify-content-between" style="margin-bottom:20px;">
                                <h4 class="page-title mb-0 font-size-18">Start Marketing <span style="font-size:12px; text-transform: none;">&nbsp;&nbsp; - Choose options below to start your day with generate new business</span></h4>

                                 

                          </div>	
						  
						  
						  
						  
						  <div class="row">
                        <div class="col-lg-3" style="cursor:pointer;"  popaction="action=campaigns&campid=1" >
                            <a href="display.html?ga=campaigns&add=1"><div class="card bg-primary text-white-50 marketingbox">
                                <div class="card-body">
                                    <p class="card-text"><img src="images/customer-icon.png" height="80px;" ></p>
                                    <h5 class="mt-0 mb-4 text-white">Customers</h5>
                                </div>
                            </div></a>
                        </div>

                          

                        <div class="col-lg-3" style="cursor:pointer;"  >
                            <a href="display.html?ga=campaigns&add=1"><div class="card bg-success text-white-50 marketingbox">
                                <div class="card-body">
								      <p class="card-text"><p class="card-text"><img src="images/trip-icon.png" height="80px;" ></p> 
                                    <h5 class="mt-0 mb-4 text-white">Plan a Trip For Customer</h5> 
                                </div>
                            </div></a> 
                        </div>
						
						 <div class="col-lg-3" style="cursor:pointer;"  >
                            <a href="display.html?ga=campaigns&add=1&birthdaywish=1"><div class="card bg-warning text-white-50 marketingbox">
                                <div class="card-body">
								      <p class="card-text"><img src="images/birthday-icon.png" height="80px;" ></p>
                                    <h5 class="mt-0 mb-4 text-white">Customer Birthdays For This Month</h5> 
                                </div>
                            </div></a>
                        </div>
						
						 <div class="col-lg-3" style="cursor:pointer;"  >
                            <a href="display.html?ga=campaigns&add=1&anniversary=1"><div class="card bg-danger text-white-50 marketingbox">
                                <div class="card-body">
								      <p class="card-text"><img src="images/marrige-icon.png" height="80px;" ></p>
                                    <h5 class="mt-0 mb-4 text-white">Customer Marriage Anniversary For The Month</h5> 
                                </div>
                            </div></a>
                        </div>
						
						  
                    </div>
								
								
								
								
							  <div>
                                                         <h4 class="card-title mb-4" style="margin-top: 0px; padding-top: 10px !important; padding-bottom:0px !important; padding-left: 10px !important;">Recent Campaigns   &nbsp;&nbsp;&nbsp;<?php if (strpos($LoginUserDetails["permissionAddEdit"], 'Suppliers') !== false) { ?>	
				<a href="display.html?ga=campaigns&add=1"><button type="button" class="btn btn-secondary btn-lg waves-effect waves-light" >Creaate Campaign</button></a> <?php } ?></h4>
														 
														 
														 
														 <div class="table-responsive"  style="margin-top:15px;">
                                            <table class="table mb-0">

                                            <thead>
                                                <tr>
                                                  <th>Campaign </th>
                                                    <th>Template</th>
                                                    <th>Mailing Group</th>
                                                    <th align="center"> 
                                                      <div align="center">Subscriber</div>                                                 </th>
                                                    <th><div align="center">Views</div></th>
                                                    <th>Status </th>
                                                    <th>By</th>
                                                </tr>
                                            </thead>
                                            <tbody>
											
								 
											   <?php
											   
											$searchKeyword='';
											$searchKeyword=$_REQUEST['keyword'];
											$totalmail='0';
											$select='';
											$where='';
											$rs=''; 
											$select='*'; 
											$wheremain='';
											if($searchKeyword!=''){ 
											$searchwhere=' and (	title like "%'.$searchKeyword.'%" or details like "%'.$searchKeyword.'%"  or notes like "%'.$searchKeyword.'%"    )'; 
											}
											
											
											if($_SESSION['userid']!='1'){
											$wheremain=' and assignTo="'.$_SESSION['userid'].'" '; 
											}
											  $where=' where deleteStatus=0  '.$wheremain.'  '.$searchwhere.' order by id desc';
											
											$limit=clean($_GET['records']);
											$page=clean($_GET['page']);
											
											$sNo=1; 
											$targetpage='display.html?ga='.$_REQUEST['ga'].'&keyword='.$searchKeyword.'&'; 
											$rs=GetRecordList('*','campaignMaster','  '.$where.'  ','10',$page,$targetpage); 
											$totalentry=$rs[1]; 
											$paging=$rs[2]; //pagination 
											while($result=mysqli_fetch_array($rs[0])){
											  	
											$abcd=GetPageRecord('*','clientGroupMaster','id="'.$result['customerGroup'].'"'); 
											$cgroupdata=mysqli_fetch_array($abcd); 
											
											$abcde=GetPageRecord('*','templateMaster','id="'.$result['templateId'].'"'); 
											$templatedata=mysqli_fetch_array($abcde); 
											 ?>
											  
											  
											    <tr >
											      <td valign="top" >
												  <a href="#" popaction="action=viewcampaign&id=<?php echo encode($result['id']); ?>" onclick="loadpop('Campaign',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center"><div style="margin-bottom:2px; font-size:14px; font-weight:600;"><?php echo stripslashes($result['title']); ?></div> <div style=" font-size:11px; color:#999999;">ID: <?php echo encode($result['id']); ?></div></a>
												  <td valign="top"><div align="left" style="cursor:pointer;"  popaction="action=viewcampaign&id=<?php echo encode($result['id']); ?>" onclick="loadpop('Campaign',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center"><?php echo stripslashes($templatedata['name']); ?></div></td>
												  <td valign="top"><?php echo stripslashes($cgroupdata['name']); ?></td>
 
                                                  <td align="center" valign="top" ><div align="center" style="width:100px;"><?php echo stripslashes($result['contacts']); ?> </div></td>
                                                    <td align="center" valign="top"><div align="center"><?php echo strip($result['clicks']); ?></div></td>
                                                    <td valign="top"> 		
 <?php if($result['status']==3){?>
<span class="badge badge-warning" style="margin-top: 3px;">Scheduled</span> 
<div style=" font-size:11px; width:124px; margin-top:2px;"><?php echo displaydateindatetme($result['scheduleDate']); ?></div>	
<?php } else { ?>	
<span class="badge badge-primary" style="margin-top: 3px;">Sent</span>

<?php } ?>								</td>
                                                    <td valign="top"><?php echo getUserNameNew($result['addedBy']); ?>
                                                  <div style=" font-size:11px; width:124px; margin-top:2px;"><?php echo displaydateindatetme($result['dateAdded']); ?></div></td>
                                                </tr> 
												<?php $sNo++; }  ?>
                                            </tbody>
                                      </table>
											
																					
											
										 
										  
			                                          </div>
                                                    </div>
								
							
							
							
						
							
							
						</div>
						
			 
						
 
						   
						   
						    
						   
						   
						   
						   
				 
						  </div>
								 
                             
</div>
                             

                        </div>

                         
						
						
						
						 
                     

             </div><!--end col-->

            <!-- end row -->

    </div>

        <!-- End Page-content -->

         
    </div>
	</div>	</div>
	<script>



 $( function() {
    $( "#startDate" ).datepicker({ 
	  dateFormat: 'dd-mm-yy' 
      });
	  
	  $( "#endDate" ).datepicker({ 
	  dateFormat: 'dd-mm-yy' 
      });
  } );
 

</script>
				
	
<script>
function changeAssignTo(id){
var assignTo = $('#assignTo'+id).val();  
$('#actoinfrm').attr('src','actionpage.php?action=changeassignstatus&queryid='+id+'&assignTo='+assignTo);
}

</script>