<?php include "inc.php"; 


$a=GetPageRecord('*','queryTask',' 1  and (makeDone!=1 ) and taskType!="Notification" and status=1 and assignTo="'.$_SESSION['userid'].'"  and reminderDate<"'.date('Y-m-d H:i:s').'" order by id asc');
$rest=mysqli_fetch_array($a);


$b=GetPageRecord('*','queryMaster','id="'.$rest['queryId'].'"'); 
$queryData=mysqli_fetch_array($b);
 
  
?>

<a href="display.html?ga=query&view=1&id=<?php echo encode($rest['queryId']); ?>&c=3" style="color:#333333;">
<div style="font-size:10px; text-transform:uppercase; font-weight:600;">Reminder - <?php echo  date('j M Y - h:i A',strtotime($rest['reminderDate'])); ?></div>
<div style="  font-weight: 600; color: #c33030; font-size: 14px; margin-bottom:8px;"><?php echo (stripslashes($rest['details'])); ?></div>
</a> 

<button type="button" class="btn btn-secondary btn-lg waves-effect waves-light" style="background: linear-gradient(180deg, rgb(178 41 41) 0%, rgb(200 47 47) 46%, rgb(167 21 21) 100%);"  onclick="loadpop('Alert',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=confirmtask&id=<?php echo encode($rest['id']); ?>&qid=<?php echo encode($queryData['id']); ?>">Confirm</button>

<?php if($rest['queryId']!=''){ ?>
<script>
$('#reminderouterrightbottom').show();
</script>
<?php } ?>