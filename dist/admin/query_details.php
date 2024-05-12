 


<div class="row">
 
							  <div class="col-lg-12" style="padding-left:15px;"> 
							   
							  <h4 class="mt-0 header-title">Client Information</h4>
							  
							  <div class="row" style="padding-left:10px;  ">
							  <div class="col-lg-3"> 
										<div class="form-group input-group" style="position:relative;">
										<label for="validationCustom02">Client Name</label>
                                                <?php echo stripslashes($clientData['submitName']); ?> <?php echo stripslashes($clientData['firstName']); ?> <?php echo stripslashes($clientData['lastName']); ?>
												</div> 
							  </div>
							  
							  <div class="col-lg-3"> 
										<div class="form-group input-group" style="position:relative;">
										<label for="validationCustom02">Mobile </label>
                                                <?php echo stripslashes($clientData['mobileCode']); ?><?php echo stripslashes($clientData['mobile']); ?>
												</div> 
							  </div>
							  
							  <div class="col-lg-3"> 
										<div class="form-group input-group" style="position:relative;">
										<label for="validationCustom02">Email</label>
                                                <?php echo stripslashes($clientData['email']); ?>
												</div> 
							  </div>
							  
							  
							  <div class="col-lg-4" style="display:none;"> 
										<div class="form-group input-group" style="position:relative;">
										<label for="validationCustom02">Country</label>
                                                <?php echo getCountryName($clientData['country']);  ?>
												</div> 
							  </div>
							  
							  <div class="col-lg-3" style="display:none;"> 
										<div class="form-group input-group" style="position:relative;">
										<label for="validationCustom02">State</label>
                                                <?php echo getStateName($clientData['state']);  ?>
												</div> 
							  </div>
							  
							  <div class="col-lg-5" style="display:none;"> 
										<div class="form-group input-group" style="position:relative;">
										<label for="validationCustom02">City</label>
                                                <?php echo getCityName($clientData['city']);  ?>
												</div> 
							  </div>
							  
							  </div>
							  
							  
							  
							  	  <h4 class="mt-3 header-title">Query Information</h4>
							  
							  <div class="row" style="padding-left:10px;  ">
							  <div class="col-lg-3" style="display:none;"> 
										<div class="form-group input-group" style="position:relative;">
										<label for="validationCustom02">FROM CITY</label>
                                                <?php echo stripslashes($editresult['fromCity']); ?></div> 
							  </div>
							  
							  <div class="col-lg-3"> 
										<div class="form-group input-group" style="position:relative;">
										<label for="validationCustom02">Destination </label>
                                                <?php echo getCityName($editresult['destinationId']); ?>
												</div> 
							  </div>
							  
							  <div class="col-lg-3"> 
										<div class="form-group input-group" style="position:relative;">
										<label for="validationCustom02">From Date </label>
                                                <?php if(date('d-m-Y',strtotime($editresult['startDate']))!='01-01-1970'){ echo date('d-m-Y',strtotime($editresult['startDate'])); } ?></div> 
							  </div>
							  
							  
							  <div class="col-lg-3"> 
										<div class="form-group input-group" style="position:relative;">
										<label for="validationCustom02">To Date </label>
                                                <?php if(date('d-m-Y',strtotime($editresult['endDate']))!='01-01-1970'){ echo date('d-m-Y',strtotime($editresult['endDate'])); } ?></div> 
							  </div>
							  <div class="col-lg-3"> 
										<div class="form-group input-group" style="position:relative;">
										<label for="validationCustom02">Travel Month </label>
                                                <?php echo $editresult['travelMonth']; ?></div> 
							  </div>
							  <div class="col-lg-3"> 
										<div class="form-group input-group" style="position:relative;">
										<label for="validationCustom02">Lead Source </label>
                                                <?php $rsb=GetPageRecord('*','querySourceMaster',' id="'.$editresult['leadSource'].'"');while($restsource=mysqli_fetch_array($rsb)){  echo stripslashes($restsource['name']); }?>
												</div> 
							  </div>
							  
							  <div class="col-lg-3"> 
										<div class="form-group input-group" style="position:relative;">
										<label for="validationCustom02">Services</label>
                                                <?php $rsb=GetPageRecord('*','queryServicesMaster',' id="'.$editresult['serviceId'].'"');while($restsource=mysqli_fetch_array($rsb)){  echo stripslashes($restsource['name']); }?>
												</div> 
							  </div>
							  
							  
							  
							  <div class="col-lg-3"> 
										<div class="form-group input-group" style="position:relative;">
										<label for="validationCustom02">Pax</label>
                                              <strong> Adult: </strong> <?php echo $editresult['adult']; ?> - <strong>Child:</strong> <?php echo $editresult['child']; ?> - <strong>Infant:</strong> <?php echo $editresult['infant']; ?>
												</div> 
							  </div>
							  
							   
							  
							   
							  
							  
							  
							  
							  
							  
							  		  <div class="col-lg-3"> 
										<div class="form-group input-group" style="position:relative;">
										<label for="validationCustom02">Assign To</label>
                                                <?php $rsb=GetPageRecord('*','sys_userMaster',' id="'.$editresult['assignTo'].'"');while($restsource=mysqli_fetch_array($rsb)){  echo stripslashes($restsource['firstName'].' '.$restsource['lastName']); }?>
												</div> 
							  </div>
							  
				 
							  <?php if($_SESSION['userid']==1){ ?>
							  <div class="col-lg-12" style="display:none;"> 
										<table width="100%" border="0" cellspacing="0" cellpadding="5">
											  <tr>
												<td width="41%"><div class="form-group input-group" style="position:relative;">
																					<label for="validationCustom02">Internal Note</label>
																							 <div class="form-group" style="overflow:hidden;"> 
																							<textarea name="internalnote" id="internalnote" onkeyup="saveinternalnote();" class="form-control" style="width:400px;" placeholder="Note"><?php echo strip($editresult['internalnote']); ?></textarea>  
																						</div>
														</div></td>
												<td width="59%"><div style="margin-top:5px;"><button type="submit"  id="savingbutton" class="btn btn-primary" onclick="location.reload();" >Save</button></div></td>
											  </tr>
											</table>
											<div style="display:none;" id="internote"></div>
											<script>
												function saveinternalnote(){ 
													var internalnote = encodeURI($('#internalnote').val());
													$('#internote').load('actionpage.php?action=saveinternalnote&queryId=<?php echo encode($editresult['id']); ?>&internalnote='+internalnote);
												
												}
											</script> 
							  </div>
							  <?php } ?>
							  
							  
							  <?php if($editresult['details']!=''){ ?>
							  <div class="col-lg-12"> 
										<div class="form-group input-group" style="position:relative;">
										<label for="validationCustom02">Query Description</label>
                                                 <?php echo nl2br(stripslashes($editresult['details'])); ?>
												</div> 
							  </div>
							  <?php } ?>
							  </div>
							  </div>
							  
							  </div>
							  
							  <div class="row">
							
							  
							    <div class="col-lg-12" style="padding: 0px 20px; margin-bottom: 0px;"> 
								  	  <h4 class="mt-3 header-title" style="position:relative;">Notes <a onclick="$('#notefiledmaintop').show();$('#notedetails').focus();" style="position: absolute; font-size: 12px; font-weight: 600; right: 5px; top: 5px; background-color: #005ee2; color: #fff; padding: 1px 10px; border-radius: 3px; cursor:pointer;">+ Add Note</a></h4>
							  <div class="card" style="margin-bottom:5px;">
							  <div class="col-lg-12" style="padding-left:15px;"> 
								
								<div class="row" style="padding: 10px 5px 0px 0px;">
								<div class="col-lg-12" id="notefiledmaintop" style="display:none;">
											 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm" > 
											 <div class="form-group" style="overflow:hidden;"> 
                                                <textarea name="details" id="notedetails" onkeyup="notedetailsfun();" class="form-control"  style="height:80px; border: 5px solid #ddd;" placeholder="Type Note Here"></textarea>
												
												<div style="margin-top:5px; display:none;" id="noteaddbutton"><button type="submit"  id="savingbutton" class="btn btn-secondary" onclick="this.form.submit();$('#noteaddbutton').hide();"  style="float:right;"  ><i class="fa fa-plus" aria-hidden="true"></i> Save Note</button></div>
                                            </div>
											<input name="action" type="hidden" value="addnotes" />
											<input name="queryid" type="hidden" value="<?php echo encode($editresult['id']); ?>" />
											 </form>
								  </div>
											 
											 <div class="col-lg-12" id="queryNotes" style="max-height:372px; overflow:auto;">
											 
											 </div>
											
								</div>
							  
							  </div> 
							  </div>
							  </div>
							  </div>
							  
							  <script>
							  function notedetailsfun(){
							   var notedetails = $('#notedetails').val();
							   if(notedetails!=''){
							  $('#noteaddbutton').show();
							  } else {
							   $('#noteaddbutton').hide();
							  }
							  
							  }
							  </script>
							  <?php if($editresult['statusId']!=5){ ?>
							  
							  <div class="row" id="nosug">
							
							  
							    <div class="col-lg-12" style="padding: 0px 20px; margin-bottom: 0px;"> 
								  	  <h4 class="mt-3 header-title" style="position:relative; margin-top:10px !important;"><?php echo getCityName($editresult['destinationId']); ?> Package Suggestion  </h4>
							  <div class="card" style="margin-bottom:5px; padding:10px;">
							   <table class="table table-hover mb-0" style=" font-size:13px;">

                                            <thead>
                                                <tr>
                                                  <th width="1%">&nbsp;</th>
                                                    <th>Title</th>
                                                    <th>Price</th>
                                                    <th>Created</th>
                                                    <th width="1%">&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>
<?php
$where2='';
if($_REQUEST['s']==1 || $_REQUEST['s']==2 || $_REQUEST['s']==3){
$where2=' and status="'.$_REQUEST['s'].'"';
}

$where3=' and archiveThis=0';

if($_REQUEST['s']==4){
$where3=' and archiveThis=1';
}

if($_REQUEST['keyword']!=''){
$where4=' and (name like "%'.$_REQUEST['keyword'].'%"  or destinations like "%'.$_REQUEST['keyword'].'%" or queryId like "'.decode($_REQUEST['keyword']).'") ';
}


$totalno='1';
$select='';
$where='';
$rs=''; 
$select='*'; 
$wheremain=''; 
$where=' where 1 and  destinations like "%'.getCityName($editresult['destinationId']).'%" and coverPhoto!="" order by id desc'; 
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 
$targetpage='display.html?ga='.$_REQUEST['ga'].'&s='.$_REQUEST['s'].'&qid='.$_REQUEST['qid'].'&keyword='.$_REQUEST['keyword'].'&'; 
$rs=GetRecordList('*','sys_packageBuilder','  '.$where.'  ','10',$page,$targetpage);

$totalentry=$rs[1];

$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 
?>

<tr>
  <td width="1%" valign="middle"><a href="display.html?ga=itineraries&view=1&id=<?php echo encode($rest['id']); ?>" target="_blank"><img src="<?php echo $fullurl; ?>package_image/<?php echo $rest['coverPhoto']; ?>" style="width:64px; height:46px;  "></a></td>
<td valign="middle"><a  target="_blank" href="display.html?ga=itineraries&view=1&id=<?php echo encode($rest['id']); ?>" style="color: #000; font-weight: 600;"><?php echo stripslashes($rest['name']); if($rest['destinations']!=''){ ?>
<div style="color:#999999; font-size:11px; margin-top:2px;">ID: <?php echo encode($rest['id']); ?> -  <?php echo stripslashes($rest['destinations']); ?> </div><?php } ?></a></td>
<td valign="middle">&#8377;<?php echo number_format($rest['grossPrice']+$rest['extraMarkup']); ?> </td>
<td valign="middle"> 
<div style="margin-bottom:0px; font-weight:600;"><?php echo getUserNameNew($rest['addedBy']); ?></div>
<div style=" font-weight:600; font-size:11px; color:#999999;"><?php echo displaydateinnumber($rest['dateAdded']); ?></div></td>
<td width="1%" valign="middle"><a target="actoinfrm" onclick="$('.savingbutton<?php echo encode($rest['id']); ?>').attr('disabled','true');$('.savingbutton<?php echo encode($rest['id']); ?>').text('Inserting...');" href="actionpage.php?action=insertitinerary&qid=<?php echo $_REQUEST['id']; ?>&id=<?php echo encode($rest['id']); ?>">
  <button type="button" class="btn btn-info btn-lg waves-effect waves-light savingbutton<?php echo encode($rest['id']); ?>" id="savingbutton" style="font-size: 14px; padding: 5px 10px;"  ><i class="fa fa-plus" aria-hidden="true"></i> Select </button></a></td>
</tr>


<?php $totalno++; } ?>
                                            </tbody>
                              </table> 
							  </div>
							  </div>
							  </div>
							  <?php if($totalno==1){ ?>
							  <script>
							  $('#nosug').remove();
							  </script>
							  <?php } ?>
							  <?php } ?>