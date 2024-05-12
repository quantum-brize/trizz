<style>
.tasklist { border: 0px solid #ddd; border-left: 0px solid #ff8a12; background-color: #fff; border-radius: 4px; margin-bottom:0px; margin-top:0px; }
.tasklist .iconbox { width: 42px; height: 42px; margin-right: 10px; background-color: #ebeff3; color: #595959; text-align: center; line-height: 40px; font-size:18px; border-radius: 100%; border: 1px solid #cfd7df; }
.tasklist .card-body{padding:10px !important;}
.makedone{border-left: 5px solid #009900;}
.makedone .iconbox{ background-color: #009900;}

.makenotedone{border: 1px solid #CC3300; border-left: 5px solid #CC3300;}
.makenotedone .iconbox{ background-color: #CC3300;}
</style>

<div class="row" style=" margin-right:1px;">
							  <div class="col-lg-12" style="padding-left:15px;"> 
							  <h4 class="mt-0 header-title" style="margin-bottom:10px;">Followup's / Task   <?php if (strpos($LoginUserDetails["permissionAddEdit"], 'Task') !== false) { ?>	<a onclick="loadpop('Add Followup / Task',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addtask&queryid=<?php echo encode($editresult['id']); ?>" style="position: absolute; font-size: 12px; font-weight: 600; right: 5px; top: 5px; background-color: #005ee2; color: #fff; padding: 1px 10px; border-radius: 3px; cursor:pointer;">+ Add Task</a><?php } ?></h4>
							  
							  <div class=" " >
							  
							<?php  
							$n=1;
							$rs=GetPageRecord('*','queryTask',' queryId="'.$editresult['id'].'" and taskType!="Notification" order by id desc');
							while($rest=mysqli_fetch_array($rs)){ 
							?> 
							  <div class=""> 
								<div  class="tasklist">
								<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top"><div class="iconbox">
	<?php if($rest['taskType']=='Task'){ ?>
	<i class="fa fa-calendar-check-o" aria-hidden="true"></i>
	<?php } ?>
	<?php if($rest['taskType']=='Call'){ ?>
	<i class="fa fa-phone-square" aria-hidden="true"></i>
	<?php } ?>
	<?php if($rest['taskType']=='Meeting'){ ?>
	<i class="fa fa-handshake-o" aria-hidden="true"></i>
	<?php } ?>
	
</div></td>
    <td width="98%" align="left" valign="top" style="position:relative;">
	<div class="card" <?php if($rest['makeDone']==1){ ?>style="background-color: #ebfff7;"<?php } ?>>
	<div class="card-body">
	<?php if($rest['makeDone']==1){ ?>
	<i class="fa fa-check-square" aria-hidden="true" style="font-size:24px; color:#009900; cursor:pointer; position:absolute; right:10px; top:22px;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Completed"></i>
	<?php } else { ?>
	<i class="fa fa-square-o" aria-hidden="true" style="font-size:24px; color:#333333; cursor:pointer; position:absolute; right:10px; top:22px;"  data-placement="top" data-original-title="Click to complete"  onclick="loadpop('Alert',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=confirmtask&id=<?php echo encode($rest['id']); ?>&qid=<?php echo $_REQUEST['id']; ?>"></i>
	<?php } ?>
	
	
	
	<div style="margin-bottom: 5px; font-size: 14px; font-weight: 600;"><span style="font-size:11px; color:#333;"><?php $rsb=GetPageRecord('*','sys_userMaster',' id="'.$rest['assignTo'].'"');while($restsource=mysqli_fetch_array($rsb)){  echo stripslashes($restsource['firstName'].' '.$restsource['lastName']); }?></span><i class="fa fa-circle" aria-hidden="true" style="color: #b2bad066; margin: 0px 10px; font-size:8px;"></i><span style="font-size:11px; color:#333; <?php if($rest['makeDone']!=1 && date('Y-m-d',strtotime($rest['reminderDate']))<date('Y-m-d')){ ?> color:#FF0000;<?php } ?>">Due on: <?php echo date('d/m/Y - h:i A',strtotime($rest['reminderDate'])); ?></span></div>
 
	<div style="margin-bottom: 0px; font-size: 13px; font-weight: 600;<?php if($rest['makeDone']==1){ ?>text-decoration: line-through;<?php } ?>"><?php echo (stripslashes($rest['details'])); ?></div>
	</div>
	</div>
	</td>
  </tr>
</table>

								</div>
							  </div> 
							  <?php $n++; } ?>
							  
							  <?php if($n==1){ ?>
							  <div style="text-align:center; color:#999999; width:100%; padding:40px;">No Task</div>
							  <?php } ?>
							  </div>
							  
							  
							  
							  	   
							  
							   
							  </div>
						 
							  </div>