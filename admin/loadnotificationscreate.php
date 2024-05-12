<?php
include "inc.php";
?>
<div style="padding:10px;">
 
<div style=" font-size:14px; font-weight:600; margin-bottom:10px;"><i class="fa fa-clock-o" aria-hidden="true"></i> You have <span class="countreminders">0</span> notification </div>
<div id="showreminders">
							<?php  
							$wherest='';
							if($LoginUserDetails['userType']!=0){ 
							$wherest=' and assignTo="'.$_SESSION['userid'].'")  '; 
							} 
							
							$n=1;
							$rs=GetPageRecord('*','queryTask',' 1 '.$wherest.' and makeDone!=1 order by id desc');
							while($rest=mysqli_fetch_array($rs)){ 
							
							if(date('Y-m-d',strtotime($rest['reminderDate']))<date('Y-m-d')){ 
							?> 
<?php if($rest['notificationType']==0){ ?>
<a href="display.html?ga=query&view=1&id=<?php echo encode($rest['queryId']); ?>&c=3">
<?php } ?>
<?php if($rest['notificationType']==1){ ?>
<a href="display.html?ga=itineraries&view=1&id=<?php echo encode($rest['queryId']); ?>&b=4&ntid=<?php echo encode($rest['id']); ?>">
<?php } ?>


<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"><div class="iconbox">
	<?php if($rest['taskType']=='Task'){ ?>
	<i class="fa fa-calendar-check-o" aria-hidden="true"></i>
	<?php } ?>
	<?php if($rest['taskType']=='Call'){ ?>
	<i class="fa fa-phone-square" aria-hidden="true"></i>
	<?php } ?>
	<?php if($rest['taskType']=='Meeting'){ ?>
	<i class="fa fa-handshake-o" aria-hidden="true"></i>
	<?php } ?>
	<?php if($rest['taskType']=='Notification'){ ?>
<i class="fa fa-check-square-o" aria-hidden="true"></i>
<?php } ?>
</div></td>
    <td width="90%" style="padding-left:10px;"><div style="font-size:14px; font-weight:600; color:#0066CC;"><?php echo (stripslashes($rest['details'])); ?></div>
	<div style="font-size:12px;"><?php if($rest['taskType']=='Notification'){ ?><?php echo date('d/m/Y - h:i A',strtotime($rest['dateAdded'])); ?><?php }else{ ?><?php echo date('d/m/Y - h:i A',strtotime($rest['reminderDate'])); ?><?php } ?></div>
	</td>
  </tr>
  
</table>
</a>  <?php $n++; }  } ?>

<script>
$('.countreminders').text('<?php echo $n-1; ?>');
$('.topnotifications').text('<?php echo $n-1; ?>');

if(<?php echo ($n-1); ?><1){
$('.topnotifications').hide();
} else {
$('.topnotifications').show();
}

</script>
</div>
</div>




 
