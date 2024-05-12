<?php
include "inc.php"; 
$chatwhere=''; 
if($LoginUserDetails['userType']!=0){ 
$chatwhere=' and id in (select clientId from queryMaster where assignTo="'.$_SESSION['userid'].'")'; 
} 





updatelisting('userMaster','onlineStatus=1','onlineSessionDate<"'.date('Y-m-d H:i:s',strtotime('-10 minutes')).'"'); 
updatelisting('userMaster','onlineStatus=0','onlineSessionDate<"'.date('Y-m-d H:i:s',strtotime('-30 minutes')).'"'); 


?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style=" font-size:12px;">
						  <tr>
    <td align="left" style="padding:5px; border-bottom:1px solid #ddd;"><strong>Client</strong></td>
    <td align="center" style="padding:5px;  border-bottom:1px solid #ddd;"><strong>Status</strong></td>
    </tr>
<?php
 
$rr=1;
$rs=GetPageRecord('*','userMaster',' status=1 and onlineStatus>0 and id!=1 '.$chatwhere.' order by onlineStatus desc ');
while($userData=mysqli_fetch_array($rs)){  

?>
 
  <tr>
    <td width="72%" align="left" style="padding:5px; border-bottom:1px solid #ddd;">
	<a href="display.html?ga=usermessenger&cui=<?php echo encode($userData['id']); ?>"><div style="font-size:14px; font-weight:500; color:#000000; margin-bottom:1px;"><?php echo strip($userData['firstName']); ?> <?php echo strip($userData['lastName']); ?></div>
	<div style="font-size:11px; font-weight:500; color:#999999; ">Mobile: <?php echo strip($userData['mobile']); ?></div></a>
	
	</td>
    <td width="28%" align="center" style="padding:5px;  border-bottom:1px solid #ddd;">
	<div class="statusboxed" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="<?php if($userData['onlineStatus']==2){ ?>Online<?php } ?><?php if($userData['onlineStatus']==0){ ?>Offline<?php } ?><?php if($userData['onlineStatus']==1){ ?>Idle<?php } ?>" data-original-title="" aria-describedby="tooltip504165" style=" <?php if($userData['onlineStatus']==2){ ?>background-color:#009900;<?php } ?> <?php if($userData['onlineStatus']==0){ ?>background-color:#999999;<?php } ?> <?php if($userData['onlineStatus']==1){ ?>background-color:#ff6a00;<?php } ?>"></div>
	</td>
    </tr>
  <?php $rr++; } ?>
  
  
</table>