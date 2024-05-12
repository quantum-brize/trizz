<?php
include "inc.php";


updatelisting('sys_userMaster','onlineStatus=1','onlineSessionDate<"'.date('Y-m-d H:i:s',strtotime('-10 minutes')).'"'); 
updatelisting('sys_userMaster','onlineStatus=0','onlineSessionDate<"'.date('Y-m-d H:i:s',strtotime('-30 minutes')).'"'); 


?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style=" font-size:12px;">
						  <tr>
    <td align="left" style="padding:5px; border-bottom:1px solid #ddd;"><strong>User</strong></td>
    <td align="center" style="padding:5px;  border-bottom:1px solid #ddd;"><strong>Status</strong></td>
    </tr>
<?php
$rr=1;
$rs=GetPageRecord('*','sys_userMaster',' status=1 order by onlineStatus desc ');
while($userData=mysqli_fetch_array($rs)){  

?>
 
  <tr>
    <td width="72%" align="left" style="padding:5px; border-bottom:1px solid #ddd;"><?php echo strip($userData['firstName']); ?> <?php echo strip($userData['lastName']); ?></td>
    <td width="28%" align="center" style="padding:5px;  border-bottom:1px solid #ddd;">
	<div class="statusboxed" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="<?php if($userData['onlineStatus']==2){ ?>Online<?php } ?><?php if($userData['onlineStatus']==0){ ?>Offline<?php } ?><?php if($userData['onlineStatus']==1){ ?>Idle<?php } ?>" data-original-title="" aria-describedby="tooltip504165" style=" <?php if($userData['onlineStatus']==2){ ?>background-color:#009900;<?php } ?> <?php if($userData['onlineStatus']==0){ ?>background-color:#999999;<?php } ?> <?php if($userData['onlineStatus']==1){ ?>background-color:#ff6a00;<?php } ?>"></div>
	</td>
    </tr>
  <?php $rr++; } ?>
  
  
</table>