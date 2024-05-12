<?php
include "inc.php";  
$startDate=date('d-m-Y',strtotime('+2 Days'));
$endDate=date('d-m-Y',strtotime('+4 Days'));

if($_REQUEST['id']!=''){ 
$select1='*';    
$where1='id="'.decode($_REQUEST['id']).'"';  
$rs1=GetPageRecord($select1,'queryMaster',$where1);   
$editresult=mysqli_fetch_array($rs1); 

$startDate=date('d-m-Y',strtotime($editresult['startDate']));
$endDate=date('d-m-Y',strtotime($editresult['endDate']));

}

 
$rs=GetPageRecord($select,'sys_userMaster','id in (select addedBy from sys_userMaster where id="'.$result['addedBy'].'") '); 
$invoicedataa=mysqli_fetch_array($rs);

$clientDetails='';
if($_REQUEST['cid']!=''){

$asclient=GetPageRecord('*','userMaster','id="'.decode($_REQUEST['cid']).'"'); 
$clientDetails=mysqli_fetch_array($asclient); 

}

$mainwhereassignfield='';

if($LoginUserDetails['userType']!=0){ 

$mainwhereassignfield=' and id in (select id from sys_userMaster where branchId in (select id from roleMaster where parentId="'.$LoginUserDetails['branchId'].'")  or (   id in (select id from sys_userMaster where branchId in (select id from roleMaster where parentId in ( select id from roleMaster where parentId="'.$LoginUserDetails['branchId'].'" ) ) ) or   id in (select id from sys_userMaster where branchId in (select id from roleMaster where parentId in ( select id from roleMaster where parentId in ( select id from roleMaster where parentId="'.$LoginUserDetails['branchId'].'" ) ) ) ) or   id in (select id from sys_userMaster where branchId in (select id from roleMaster where parentId in ( select id from roleMaster where parentId in ( select id from roleMaster where parentId in (select id from roleMaster where parentId="'.$LoginUserDetails['branchId'].'")  ) ) ) ) or   id in (select id from sys_userMaster where branchId in (select id from roleMaster where parentId in ( select id from roleMaster where parentId in ( select id from roleMaster where parentId in (select id from roleMaster where parentId in (select id from roleMaster where parentId="'.$LoginUserDetails['branchId'].'") )  ) ) ) ) or id="'.$_SESSION['userid'].'" ) )  ';
}

 ?>
 
<style>
.table td, .table th {
    vertical-align: top;
}
label{width: 100% !important; margin-bottom: 2px !important;font-size: 12px; text-transform: uppercase;}
</style>
 
 
  <div class="row" id="showdelte" style="display:none;"> 
			 <div style="text-align: center; font-size: 16px; color: #c81a1a; width: 100%; font-weight: 600;">Are you sure you want to delete this query?</div>
			 <div class="modal-footer" style="position:relative; margin-top:20px;"> 
			 
			 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm" >  
 


<input name="Cancel" type="button" value="Cancel"   aria-label="Close" class="btn btn-secondary btn-lg waves-effect waves-light btn-primary-gray" onclick="createqueryclose()">
<input name="Delete Now" type="submit" value="Delete Now" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Deleting...';">
 <input autocomplete="false" name="action" type="hidden" id="action" value="deleteQuery" /> 
											 <input autocomplete="false" name="deleteid" type="hidden" id="deleteid" value="<?php echo $_REQUEST['id']; ?>" /> 
											 </form>
</div>
			 
			 
			   </div>
									
									<form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm" > 
                 
                        <div class="col-lg-12">
               
                                 
                                    <div class="row hidedelte" > 
                                        <div class="col-lg-12">
										 
											<div class="row" >
											 
											
											 

											<div class="col-lg-6">
											<div class="form-group input-group">
										<label for="validationCustom02">Mobile <span class="redmtext">*</span></label>
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-mobile"></i></span>
                                                </div>
                                                <input type="text" maxlength="10" id="mobile"   name="mobile" class="form-control redborder" placeholder="Phone / Mobile" value="<?php echo stripslashes($editresult['phone']); ?><?php echo stripslashes($clientDetails['mobile']); ?><?php if($_REQUEST['chatid']!=''){ echo stripslashes($_REQUEST['mobile']); } ?>" onblur="hidensearchclient();" autocomplete="nope" onkeyup="searchclients('searchname','mobile');createtitile();"  >
												<div class="clientsearchdiv" id="searchname" style="display:none; position: absolute; left: 0px; top: 57px; width: 100%; display: none; z-index: 999; background-color: rgb(255, 255, 255); border: 2px solid rgb(36, 41, 62); box-shadow: rgba(0, 0, 0, 0.45) 0px 0px 10px;"></div>
                                            </div>
											<script>
											   $('#mobile').keypress(function(e) {  
      var arr = [];  
      var kk = e.which;  
     
      for (i = 48; i < 58; i++)  
          arr.push(i);  
     
      if (!(arr.indexOf(kk)>=0))  
          e.preventDefault();  
  });  
											 </script>
											</div>
											
											<div class="col-lg-6">
											<div class="form-group input-group">
											<label for="validationCustom02">Email <span class="redmtext">*</span></label>
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                                </div>
                                                <input type="email" id="email"  name="email" class="form-control" placeholder="Email" value="<?php echo stripslashes($editresult['email']); ?><?php echo stripslashes($clientDetails['email']); ?>">
                                            </div>
											</div>
											
											
											
										 
										 
                                        <div class="col-lg-3">
											<div class="form-group">
<label for="validationCustom02">&nbsp;&nbsp; </label>
  <select name="submitName"  id="submitName"  class="form-control">
								  <option value="Mr." <?php if($editresult['submitName']=='Mr.'){ ?>selected="selected"<?php } ?><?php if($clientDetails['submitName']=='Mr.'){ ?>selected="selected"<?php } ?>>Mr.</option>
								  <option value="Mrs." <?php if($editresult['submitName']=='Mrs.'){ ?>selected="selected"<?php } ?><?php if($clientDetails['submitName']=='Mrs.'){ ?>selected="selected"<?php } ?>>Mrs.</option>
								  <option value="Ms." <?php if($editresult['submitName']=='Ms.'){ ?>selected="selected"<?php } ?><?php if($clientDetails['submitName']=='Ms.'){ ?>selected="selected"<?php } ?>>Ms.</option>
								  <option value="Dr." <?php if($editresult['submitName']=='Dr.'){ ?>selected="selected"<?php } ?><?php if($clientDetails['submitName']=='Dr.'){ ?>selected="selected"<?php } ?>>Dr.</option>
								  <option value="Prof." <?php if($editresult['submitName']=='Prof.'){ ?>selected="selected"<?php } ?><?php if($clientDetails['submitName']=='Prof.'){ ?>selected="selected"<?php } ?>>Prof.</option>
		  </select>
</div> 
										</div>
										<div class="col-lg-9"> 
										<div class="form-group input-group" style="position:relative;" >
										<label for="validationCustom02">Client Name <span class="redmtext">*</span></label>
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                </div>
                                                <input style="opacity: 0;position: absolute;">
												<input type="text" id="name" name="name" class="form-control redborder" placeholder="Name" value="<?php echo stripslashes($editresult['name']); ?><?php echo stripslashes($clientDetails['firstName']); ?><?php if($_REQUEST['chatid']!=''){ echo stripslashes($_REQUEST['name']); } ?>"> 
												
												
												<script>
												
												
												function searchclients(divname,fieldname){
												<?php if($_REQUEST['chatid']==''){ ?>
												var fieldname = $('#'+fieldname).val();
												<?php } else { ?>
												var fieldname = '<?php echo $_REQUEST['email']; ?>';
												<?php } ?>
												
												fieldname=encodeURI(fieldname);
												$('#searchname').show();
												$('#'+divname).load('clientsearch.php?keyword='+fieldname);
												}
												
												<?php if($_REQUEST['chatid']!=''){ ?>
												searchclients('searchname','name');
												<?php } ?>
												</script>
                                            </div>
										</div>
										 
											
											
										
										
										
										
										
								 
											 
											
											
											 
											</div>
											                           
                                        </div>
<hr />

										  <div class="col-lg-12">
										  
										  <div class="row" >
										    <div class="col-lg-6" style="display:none;">
												<div class="form-group">
                                                 <label for="validationCustom02">From City <span class="redmtext">*</span></label>
												
 <input type="text" class="form-control" onkeyup="getSearchCIty('pickupCitySearchfromCity','pickupCityfromCity','searchcitylistsfromCity');" id="pickupCitySearchfromCity" required="" name="fromCity" value="<?php echo $editresult['fromCity']; ?>" autocomplete="off" > 
  <input name="pickupCityfromCity123" id="pickupCityfromCity" type="hidden" value="<?php echo stripslashes($editresult['destinationId']); ?>" />
  <div style="height:0px; font-size:0px; position:relative;  " id="searchcitylistsfromCity"></div>
   
                                                 
                                            </div>
										</div>
										
										  <div class="col-lg-6">
										<div class="form-group"> 
										<label for="validationCustom02">Destination <span class="redmtext">*</span></label>
										 <input type="text" class="form-control" onkeyup="getSearchCIty('pickupCitySearch','pickupCity','searchcitylists');" id="pickupCitySearch" required="" name="pickupCitySearch" value="<?php echo getCityName($editresult['destinationId']); ?>" autocomplete="off" > 
  <input name="destinationId[]" id="pickupCity" type="hidden" value="<?php echo stripslashes($editresult['destinationId']); ?>" />
  <div style="height:0px; font-size:0px; position:relative;  " id="searchcitylists"></div>
										
                                             
                                        </div>
										</div>
										 
												   
										<div class="col-lg-6">
											 <div class="form-group"> 
											 <label for="validationCustom02">Travel Month</label>
                                          <input type="text" class="form-control redborder" id="travelMonth" name="travelMonth"    value="<?php echo $editresult['travelMonth']; ?>" >
                                        </div>
										</div>
										   
										
										 <div class="col-lg-6">
										<div class="form-group input-group"><label for="validationCustom02">From Date <span class="redmtext">*</span></label>
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                </div>
                                            <input type="text" class="form-control redborder" id="startDatestart" name="startDate" readonly="" placeholder="From" value="<?php if($startDate!='1970-01-01' && $startDate!='01-01-1970'){ echo $startDate; } ?>" >
                                        </div></div>

<script>
  

$(document).ready(function(){
    $("#startDatestart").datepicker({
        numberOfMonths: 2,dateFormat: 'dd-mm-yy',
        onSelect: function(selected) {
          $("#endDateend").datepicker("option","minDate", selected)
        }
    });
    $("#endDateend").datepicker({dateFormat: 'dd-mm-yy',
        numberOfMonths: 2,
        onSelect: function(selected) {
           $("#startDatestart").datepicker("option","maxDate", selected)
        }
    });  
});

  $( function() {
    $( "#startDatestart" ).datepicker({ 
	  dateFormat: 'dd-mm-yy' 
      });
	  
	  $( "#endDateend" ).datepicker({ 
	  dateFormat: 'dd-mm-yy' 
      });
  } );
 
</script>
										
										
											 <div class="col-lg-6">
											<div class="form-group input-group"><label for="validationCustom02">To Date <span class="redmtext">*</span></label>
											
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                </div>
                                            <input type="text" class="form-control redborder" id="endDateend" name="endDate" readonly="" placeholder="To" value="<?php if($endDate!='1970-01-01' && $endDate!='01-01-1970'){ echo $endDate; } ?>" >
                                        </div>
										</div>
										
										
										
										
										
										
										
										
										
										
										
										<div class="col-lg-6" style="display:none">
											 <div class="form-group"> 
											 <label for="validationCustom02">Travel Month</label>
                                          <input type="text" class="form-control redborder" id="travelMonth" name="travelMonth"    value="<?php echo $editresult['travelMonth']; ?>" >
                                        </div>
										</div>
											
											<div class="col-lg-6"  style="display:none">
											 <div class="form-group"> 
											 <label for="validationCustom02">Service</label>
                                            <select id="serviceId" name="serviceId" class="form-control" displayname="country" autocomplete="off" >  
											<option value="0">Select Service</option>  
 <?php  
$rs=GetPageRecord('*','queryServicesMaster',' 1 order by name asc');
while($rest=mysqli_fetch_array($rs)){ 
?> 
<option value="<?php echo $rest['id']; ?>" <?php if($rest['id']==$editresult['serviceId']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>  
 <?php } ?>
</select>
                                        </div>
										</div>
										
										
													<div class="col-lg-4">
											 
											 <div class="form-group input-group">
											 <label for="validationCustom02">Adult <span class="redmtext">*</span></label>
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-male"></i></span>
                                                </div>
												<input type="number" class="form-control redborder" id="adult" name="adult" min="0"  placeholder="Adult"   value="<?php echo $editresult['adult']; ?>" >
                                                 
                                            </div>
											 
											 </div>
											 
											 <div class="col-lg-4">
											 
											 <div class="form-group input-group">
											  <label for="validationCustom02">Child</label>
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-child"></i></span>
                                                </div>
												<input type="number" class="form-control" id="child" name="child"   placeholder="Child"  min="0"   value="<?php echo $editresult['child']; ?>" >
                                                 
                                            </div>
											 
											 </div>
											 
											 <div class="col-lg-4">
											 
											 <div class="form-group input-group">
											  <label for="validationCustom02">Infant</label>
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-user-circle"></i></span>
                                                </div>
                                                <select id="infant" name="infant" class="form-control"   autocomplete="off" >  
											<option value="0">0 Infant</option>  
 <?php  
for ($x = 1; $x <= 6; $x++) {
?> 
<option value="<?php echo $x; ?>" <?php if($x==$editresult['infant']){ ?>selected="selected"<?php } ?>><?php echo $x; ?></option>  
 <?php }  ?> 
</select>
                                            </div>
											 
											 </div>
											 
								
											 
											 
											 
											 
											  
											 
											  
											 
											    
										
										 
											  
									
											 
											 			  
											 
											  
											 
											   <div class="col-lg-4">
											 
											 <div class="form-group">
                                                  <label for="validationCustom02">Lead Source <span class="redmtext">*</span></label>
                                                <select id="leadSource" name="leadSource" class="form-control"   autocomplete="off" > 
												
												
											<?php if($_REQUEST['chatid']!=''){ ?> 
											
											<option value="11">Chat</option>  
											
											<?php } else { ?> 
							
 <?php  
$rs=GetPageRecord('*','querySourceMaster','  1  order by name asc');
while($rest=mysqli_fetch_array($rs)){ 
?> 
<option value="<?php echo $rest['id']; ?>" <?php if($rest['id']==$editresult['leadSource']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>  


 <?php } } ?>
</select>
                                            </div>
											 
											 </div>
											 
											  <div class="col-lg-4">
											 
											 <div class="form-group">
                                                  <label for="validationCustom02">Priority <span class="redmtext">*</span></label>
                                                <select id="priorityStatus" name="priorityStatus" class="form-control"   autocomplete="off" >  
											<option value="0" <?php if(0==$editresult['priorityStatus']){ ?>selected="selected"<?php } ?>>General Query</option>
											<option value="1" <?php if(1==$editresult['priorityStatus']){ ?>selected="selected"<?php } ?>>Hot Query</option>   						 
</select>
                                            </div>
											 
											 </div>
											 
											 
											 
											 			<div class="col-lg-4">
											
											
											 
											 <div class="form-group">
                                               <label for="validationCustom02">Assign To <span class="redmtext">*</span></label>
                                              <select id="assignTo" name="assignTo" class="select2 form-control"   autocomplete="off" > 
											    <option value="<?php echo $_SESSION['userid']; ?>" >Assign to me</option>
							  
 <?php   
$rs=GetPageRecord('*','sys_userMaster',' 1 '.$mainwhereassignfield.'  and id!="'.$_SESSION['userid'].'" and (userType="1" or userType="0") order by firstName asc'); 
while($rest=mysqli_fetch_array($rs)){ 
?> 
<option value="<?php echo $rest['id']; ?>" <?php if($rest['id']==$editresult['assignTo']){ ?>selected="selected"<?php } ?>><?php echo $rest['firstName']; ?> <?php echo $rest['lastName']; ?></option>  
 <?php } ?>
</select>
                                            </div>
											 
											 </div> 
											 
											 <div class="col-lg-12">
											 <div class="form-group"> 
											 <label for="validationCustom02">Service</label>
                                            <select id="serviceId" name="serviceId" class="form-control" displayname="country" autocomplete="off" >  
											<option value="0">Select Service</option>  
 <?php  
$rs=GetPageRecord('*','queryServicesMaster',' 1 order by name asc');
while($rest=mysqli_fetch_array($rs)){ 
?> 
<option value="<?php echo $rest['id']; ?>" <?php if($rest['id']==$editresult['serviceId']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>  
 <?php } ?>
</select>
                                        </div>
										</div>
											 <div class="col-lg-12"><div class="form-group input-group" style="position:relative;" >
										<div for="validationCustom02" style="width:100%;">Remark  </div>
                                              
                                                <textarea name="details" rows="3" class="form-control" ><?php echo stripslashes($editresult['details']); ?></textarea>
												  
												
												
												 
                                            </div></div>
											 
										  </div>		  
                                             
											  
											 
										 
											                              
                                        </div>

                                         
                                    </div>  
									
									
									
									                                                                    
                        
								<div class="row">
								<div class="col-lg-12">
								
							   
                           
								</div>
                           
							
                        </div>
						
						
						
                    </div>
					 


<div class="modal-footer hidedelte">  
<?php if($_REQUEST['id']!='' && $_SESSION['userid']==1){ ?>
<input name="Delete" type="button" value="Delete"    class="btn btn-danger btn-lg waves-effect waves-light"   style="position: absolute; left: 10px; padding: 5px 10px;" onclick="$('#showdelte').show();$('.hidedelte').hide();">
<?php } ?>


<input name="Cancel" type="button" value="Cancel"   aria-label="Close" class="btn btn-secondary btn-lg waves-effect waves-light btn-primary-gray" onclick="createqueryclose()">
<input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';">
 <input autocomplete="false" name="action" type="hidden" id="action" value="addQuery" />
											 <input  autocomplete="false" name="clientId" type="hidden" id="clientId" value="<?php echo encode($editresult['clientId']); ?><?php echo encode($clientDetails['id']); ?>" />
											 <input autocomplete="false" name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>" />
											 <input autocomplete="false" name="chatid" type="hidden" id="chatid" value="<?php echo $_REQUEST['chatid']; ?>" />
</div>

					</form>
					 
 
 
 