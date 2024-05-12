<?php 
$u = decode($_REQUEST['u']);

if($_REQUEST['u']==''){
$u=$_SESSION['userid'];
}
$abcd=GetPageRecord('*','userMaster','id="'.decode($_REQUEST['g']).'"'); 
$result=mysqli_fetch_array($abcd); 
?>
 <script src="tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
selector: "#emailsignature",
themes: "modern",
plugins: [
"advlist autolink lists link image charmap print preview anchor",
"searchreplace visualblocks code fullscreen"
],
toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
});
</script>
<style>
html{height:100%;}
body{background-image:url(images/bulkemailsetup-bg-cover.png); background-size:100% 100%; background-color:transparent; height:100%;}
</style>
<div class="wrapper">
<div class="container-fluid">
<div class="main-content">

                <div class="page-content">

      
                    
                    <!-- start page title -->
                     
              
                        
                            
							<?php if($_REQUEST['templateId']>0 && $_REQUEST['groupId']>0 && $_REQUEST['name']!=''){ 
							$wheremore='';
if($_REQUEST['birthdaywish']!=''){
$wheremore=' and clientId in (select id from userMaster where month(dob)="'.date('m').'" )';
}

if($_REQUEST['anniversary']!=''){
$wheremore=' and clientId in (select id from userMaster where month(marriageAnniversary)="'.date('m').'" )';
}

							
$abcd=GetPageRecord('*','clientGroupMaster','id="'.decode($_REQUEST['groupId']).'"'); 
$cgroupdata=mysqli_fetch_array($abcd); 

$abcde=GetPageRecord('*','templateMaster','id="'.decode($_REQUEST['templateId']).'"'); 
$templatedata=mysqli_fetch_array($abcde); 
							
							?>
					
							
							<div class="row">
                        <div class="col-md-12 col-xl-12">
						<div class="card" style="margin: auto; margin-top: 100px; border: 1px solid #ddd; width: 800px; padding: 30px 50px; background-color: #FFFFFF;">
								  <div class="card-body" style="padding:0px;"> 
                                    <h4 class="card-title" style=" margin-top:0px; text-align:center; width:100%;" id="revtitle">Review Campaign</h4>  
									
									
									<?php if($_REQUEST['birthdaywish']==1){ ?>
									<div style="background-color:#F5FFD9; border:1px solid #D1FFA4; padding:5px; color:#000; margin-bottom:10px;">
									<table height="58" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="58" colspan="2"><img src="images/birthday-icon.png" height="41" ></td>
    <td style="padding-left:10px; font-size:18px">Send this month birthday  wishes to clients</td>
  </tr>
</table>

									</div>
									<?php } ?>
							  
							  
							  
									
									<?php if($_REQUEST['anniversary']==1){ ?>
									<div style="background-color:#F5FFD9; border:1px solid #D1FFA4; padding:5px; color:#000; margin-bottom:10px;">
									<table height="58" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="58" colspan="2"><img src="images/marrige-icon.png" height="41" ></td>
    <td style="padding-left:10px; font-size:18px">Send this month  marriage anniversary wishes to clients</td>
  </tr>
</table>

									</div>
									<?php } ?>
									
									
									<div style="text-align:center; padding:30px; font-weight:600; font-size:14px; display:none; margin-bottom:20px;" id="mailsendingcampaign"><img src="images/giphy.gif" style=" height: 256px; "><br />
Wait Please Sending...</div>
							  
							  <form action="frmaction.html" method="post"  enctype="multipart/form-data" name="addeditfrm" id="submitlaunchcamp"  target="actoinfrm">
							  
							  		<input name="name" type="hidden" value="<?php echo $_REQUEST['name']; ?>" />
							<input name="groupId" type="hidden" value="<?php echo $_REQUEST['groupId']; ?>" />
							<input name="templateId" type="hidden" value="<?php echo $_REQUEST['templateId']; ?>" />
							<input name="sendType" id="sendType" type="hidden" value="2" />
							<input name="action" type="hidden" value="sendcampaignsmail" />
								<input name="birthdaywish" id="birthdaywish" type="hidden" value="<?php echo $_REQUEST['birthdaywish']; ?>" />
								<input name="anniversary" id="anniversary" type="hidden" value="<?php echo $_REQUEST['anniversary']; ?>" />
							
							<hr />
							<div style="font-size:16px; margin-bottom:10px;">Campaign Name:<strong> <?php echo $_REQUEST['name']; ?></strong></div>
							  <div style="font-size:16px; margin-bottom:10px;">Template:<strong> <a href="#"  onclick="loadpop('View Template',this,'1200px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewtemplate&id=<?php echo $_REQUEST['templateId']; ?>"><?php echo stripslashes($templatedata['name']); ?></a></strong></div>
							  <div style="font-size:16px; margin-bottom:10px;">Clients Group:<strong> <?php echo stripslashes($cgroupdata['name']); ?> <a href="display.html?ga=clients-group-contacts&g=<?php echo encode($cgroupdata['id']); ?>&birthdaywish=<?php echo $_REQUEST['birthdaywish']; ?>&anniversary=<?php echo $_REQUEST['anniversary']; ?>" target="_blank">(<i class="fa fa-user" aria-hidden="true"></i> <?php
 $a=GetPageRecord('count(id) as totalclients','clientGroupContacts',' groupId="'.$cgroupdata['id'].'" '.$wheremore.'');  
$result=mysqli_fetch_array($a); echo $result['totalclients'];
?> Subscribers)</a></strong></div><hr />



<div class="row spdiv" style="margin-top:20px;">
<div class="col-md-6"> 	
<div class="form-group">
<label for="validationCustom02">From Name*</label>
<input name="fromName" type="text" class="form-control" id="fromName" value="<?php echo $LoginUserDetails['fromName']; ?>" readonly="readonly"    required="">
 
</div> 
</div>


<div class="col-md-6"> 	
<div class="form-group">
<label for="validationCustom02">From Email*</label>
<input name="fromEmail" type="text" class="form-control" id="fromEmail"  value="<?php echo $LoginUserDetails['email']; ?>" readonly="readonly"   required="">
 
</div> 
</div>


<div class="col-md-12"> 	
<div class="form-group">
<label for="validationCustom02">Subject*</label>
<input name="subject" type="text" class="form-control" id="subject"   value="<?php echo stripslashes($templatedata['subject']); ?>"  required="">
 
</div> 
</div>
 
<div class="col-md-8"> 	
<div class="form-group">
<label for="validationCustom02">Enter Test Email ID</label>
<input name="testEmail" type="text" class="form-control" id="testEmail"   value="<?php echo $LoginUserDetails['email']; ?>">
<div style="text-align:left; padding:10px; color:#CC3300; padding-top:0px; padding-bottom:20px; width:100%; display:none; margin-top:4px;" id="testmailsent">Test Mail Sent Successfully|</div>
 
</div> 
</div>


<script>
function showloadingabout(){
var testEmail = $('#testEmail').val();
if(testEmail!=''){
$('#submitlaunchcamp').submit();
$('#testmailsent').show();
}
}

function launchcampaignnow(){
var subject = $('#subject').val();
if(subject!=''){
$('#mailsendingcampaign').show();
$('#sendType').val('1');
$('#submitlaunchcamp').hide();
$('#revtitle').hide();

$('#submitlaunchcamp').submit();

}
}

</script>


<div class="col-md-4"> 	
  <button type="button" class="btn btn-primary" onclick="showloadingabout();" style="margin-top: 32px;"><i class="fa fa-envelope" aria-hidden="true"></i> Test Mail</button> 
</div>

<div style="text-align:center; padding:10px; color:#CC3300; padding-top:0px; padding-bottom:20px; width:100%; display:none;" id="testmailsent">Test Mail Sent Successfully|</div>

 
         <div class="col-md-12 col-xl-12">
										<button type="button" class="btn btn-primary btn-lg waves-effect waves-light" style="margin-bottom: 10px; border-radius: 5px; padding: 15px; width: 100%; font-size: 20px;" onclick="launchcampaignnow();">Launch Campaign Now</button>
										</div>
</div>
							  
							  </form>
							  
							  </div>
							
								  
						  </div>    </div>   </div>
						  
						  <?php }  else  { ?>
						  
						  <script>
function selecttemp(id){
$('.table-hover .btn').removeClass('active');
$('#templateId').val(id);
$('#selecttempid'+id).addClass('active');
}

function selectgroup(id){
$('.table-hover .btn').removeClass('active');
$('#groupId').val(id);
$('#selectgroupid'+id).addClass('active');
}



function stepone(){
var campname = $('#campname').val();

if(campname!=''){ 
$('.step1').hide();
$('.step2').show();
} else {
$('#campname').focus();
}

}




function steptwo(){
var campname = $('#campname').val();
var templateId = Number($('#templateId').val());

if(campname!='' && templateId>0){ 
$('.step1').hide();
$('.step2').hide();
$('.step3').show();
} 

}





function steptree(){
var campname = $('#campname').val();
var templateId = Number($('#templateId').val());
var groupId = Number($('#groupId').val());

if(campname!='' && templateId>0 && groupId>0){ 
$('.step1').hide();
$('.step2').hide();
$('#submitcampaddeditfrm').submit();
} 

}
</script>
						  
						  <div class="row">
                        <div class="col-md-12 col-xl-12">
						<div class="card" style="margin: auto; margin-top: 100px; border: 1px solid #ddd; width: 800px; padding: 30px 50px; background-color: #FFFFFF;">
						  <div class="card-body" style="padding:0px;"> 
                                    <h4 class="card-title" style=" margin-top:0px; text-align:center; width:100%;">Create New Campaign</h4> 
									
									<?php if($_REQUEST['birthdaywish']==1){ ?>
									<div style="background-color:#F5FFD9; border:1px solid #D1FFA4; padding:5px; color:#000; margin-bottom:10px;">
									<table height="58" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="58" colspan="2"><img src="images/birthday-icon.png" height="41" ></td>
    <td style="padding-left:10px; font-size:18px">Send this month birthday  wishes to clients</td>
  </tr>
</table>

									</div>
									<?php } ?>
									
									
									<?php if($_REQUEST['anniversary']==1){ ?>
									<div style="background-color:#F5FFD9; border:1px solid #D1FFA4; padding:5px; color:#000; margin-bottom:10px;">
									<table height="58" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="58" colspan="2"><img src="images/marrige-icon.png" height="41" ></td>
    <td style="padding-left:10px; font-size:18px">Send this month  marriage anniversary wishes to clients</td>
  </tr>
</table>

									</div>
									<?php } ?>
							  
							  
							  <form action="display.html" method="get" enctype="multipart/form-data" name="addeditfrm" id="submitcampaddeditfrm" >
				 
							  <div class="row step1">  
										<div class="col-lg-12">
											 <div class="form-group"> 
											 <label for="validationCustom02">Campaign Name</label>
                                          <input type="text" class="form-control redborder" id="campname" name="name" style="font-size: 20px; padding: 27px 10px; font-weight: 600;" placeholder="Enter your campaign name...">
                                        </div>
										
										
										
										<button type="button" class="btn btn-primary btn-lg waves-effect waves-light" style="margin-bottom: 10px; border-radius: 5px; padding: 15px; width: 100%; font-size: 20px;" onclick="stepone();">Next Step</button>
										</div>
										
										
										</div>
										
										
										
										
										
										
										<div class="row step2" style="display:none;">  
										<div class="col-lg-12">
											  <div style="font-size:16px; margin-bottom:10px;"><strong>Select Template</strong></div>
										
										<div style="max-height:400px; overflow:hidden; border:1px solid #ddd; margin-bottom:10px;">
										
										<table class="table table-hover mb-0">

                                            <thead>
                                                <tr>
                                                  <th>Name</th>
                                                    <th>Mail Subject </th>
                                                    <th>&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>
<?php
$totalno='1';
$totalmail='0';
$select='';
$where='';
$rs=''; 
$select='*'; 
$wheremain=''; 
$where=' where    (name like "%'.$_REQUEST['keyword'].'%" or subject like "%'.$_REQUEST['keyword'].'%" ) order by id desc'; 
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 
$targetpage='display.html?ga='.$_REQUEST['ga'].'&keyword='.$_REQUEST['keyword'].'&'; 
$rs=GetRecordList('*','templateMaster','  '.$where.'  ','200',$page,$targetpage);

$totalentry=$rs[1];

$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 
?>

<tr>
  <td><a  style="cursor:pointer; color:#0066CC;" onclick="loadpop('View Template',this,'1200px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewtemplate&id=<?php echo encode($rest['id']); ?>" ><strong><?php echo stripslashes($rest['name']); ?></strong></a></td>
  <td><?php echo stripslashes($rest['subject']); ?></td>
  <td>
<div style="width:100px;">
<a style="cursor:pointer;" ><button type="button" class="btn btn-outline-success waves-effect waves-light" onclick="selecttemp('<?php echo encode($rest['id']); ?>');" id="selecttempid<?php echo encode($rest['id']); ?>">Select</button></a>


 </div></td>
</tr>


<?php $totalno++; } ?>
                                            </tbody>
                                        </table>
										
										</div>
										
										<button type="button" class="btn btn-primary btn-lg waves-effect waves-light" style="margin-bottom: 10px; border-radius: 5px; padding: 15px; width: 100%; font-size: 20px;" onclick="steptwo()">Next Step</button><input name="templateId" id="templateId" type="hidden" value="0" />
										</div>
										
										
										</div>
										
										
										
										
										<div class="row step3" style="display:none;">  
										<div class="col-lg-12">
											  <div style="font-size:16px; margin-bottom:10px;"><strong>Select Clients Group</strong></div>
										
										<div style="max-height:400px; overflow:hidden; border:1px solid #ddd; margin-bottom:10px;">
										
										<table class="table table-hover mb-0">

                                            <thead>
                                                <tr>
                                                  <th>Name</th>
                                                    <th>Description</th>
                                                    <th><div align="center">Subscribers</div></th>
                                                    <th>&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>
<?php
$totalno='1';
$totalmail='0';
$select='';
$where='';
$rs=''; 
$select='*'; 
$wheremain=''; 
$where=' where  status=1 order by id desc'; 
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 
$targetpage='display.html?ga='.$_REQUEST['ga'].'&keyword='.$_REQUEST['keyword'].'&'; 
$rs=GetRecordList('*','clientGroupMaster','  '.$where.'  ','200',$page,$targetpage);

$totalentry=$rs[1];

$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 
?>

<tr>
  <td><?php echo stripslashes($rest['name']); ?></td>
  <td><?php echo stripslashes($rest['description']); ?></td>
<td> <div align="center"><a target="_blank" href="display.html?ga=clients-group-contacts&g=<?php echo encode($rest['id']); ?>&birthdaywish=<?php echo $_REQUEST['birthdaywish']; ?>&anniversary=<?php echo $_REQUEST['anniversary']; ?>"><i class="fa fa-user" aria-hidden="true"></i> <?php
$wheremore='';
if($_REQUEST['birthdaywish']!=''){
$wheremore=' and clientId in (select id from userMaster where month(dob)="'.date('m').'" )';
}

if($_REQUEST['anniversary']!=''){
$wheremore=' and clientId in (select id from userMaster where month(marriageAnniversary)="'.date('m').'" )';
}


 $a=GetPageRecord('count(id) as totalclients','clientGroupContacts',' groupId="'.$rest['id'].'" '.$wheremore.'');  
$result=mysqli_fetch_array($a); echo $result['totalclients'];
?></a>
</div></td>
<td><a style="cursor:pointer;" ><button type="button" class="btn btn-outline-success waves-effect waves-light" onclick="selectgroup('<?php echo encode($rest['id']); ?>');" id="selectgroupid<?php echo encode($rest['id']); ?>">Select</button></a></td>
</tr>


<?php $totalno++; } ?>
                                            </tbody>
                                        </table>
										
										</div>
										
										<button type="button" class="btn btn-primary btn-lg waves-effect waves-light" style="margin-bottom: 10px; border-radius: 5px; padding: 15px; width: 100%; font-size: 20px;" onclick="steptree()">Review Campaign</button><input name="groupId" id="groupId" type="hidden" value="0" />
										</div>
										
										
										</div>
										<input name="ga" id="ga" type="hidden" value="campaigns" />
										<input name="birthdaywish" id="birthdaywish" type="hidden" value="<?php echo $_REQUEST['birthdaywish']; ?>" />
										<input name="add" id="add" type="hidden" value="1" />
                                        <input name="anniversary" id="anniversary" type="hidden" value="<?php echo $_REQUEST['anniversary']; ?>" />
										</form>
                       
						  </div>    </div>   </div>
						  <?php } ?>
								 
                             
<!--end col-->

            <!-- end row -->

    </div>

        <!-- End Page-content -->

         
    </div>
	</div>	</div>
	
	
	
	<script>

$(document).ready(function () {
    $("#ckbCheckAll").click(function () {
        $(".checkBoxClass").prop('checked', $(this).prop('checked'));
		if($(".checkBoxClass").prop('checked') == true){
		$('#bulkassign').show();
		}else{
		$('#bulkassign').hide();
		}
    });
});
function selectedfun(){ 
var mychecked = $('.checkBoxClass:checked').length 
if (mychecked==0) {
    $('#bulkassign').hide();
}
if (mychecked>0) {
    $('#bulkassign').show();
} 
}

</script>