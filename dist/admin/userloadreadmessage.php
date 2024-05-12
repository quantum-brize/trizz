<?php
include "inc.php"; 
 
?>   
<script>
<?php 
$rs=GetPageRecord('*','sys_MessageMaster',' clientid="'.decode($_REQUEST['clientId']).'" and readMsg=0 and addedBy!="'.$_SESSION['userid'].'" order by id asc');
if(mysqli_num_rows($rs)>0){
while($rest=mysqli_fetch_array($rs)){
 ?> var msg='<li class="usermessage" id="lastcommunication<?php echo $rest['id']; ?>" tabindex="10"><div class="content"><?php echo ucwords(strip($rest['msg'])); ?></div><div class="datetimechat"><?php echo date('d M Y - h:i A', strtotime($rest['dateAdded'])); ?></div></li>';<?php
  ?>
  $('#chatarea ul').append(msg);
  scrollbottom(); 
  <?php
 updatelisting('sys_MessageMaster','readMsg="1"','id="'.$rest['id'].'"'); 
  } } ?>  


 </script>
