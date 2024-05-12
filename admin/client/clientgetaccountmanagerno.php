<?php
include "clientinc.php"; 
 

$b=GetPageRecord('*','queryMaster','id="'.decode($_REQUEST['id']).'"'); 
$rest=mysqli_fetch_array($b);

$opsEmail='';

$rs22=GetPageRecord('*','sys_userMaster',' id="'.$rest['assignTo'].'" order by firstName asc'); 
if(mysqli_num_rows($rs22)>0){
$restuser=mysqli_fetch_array($rs22);    
$opsEmail= $restuser['email']; 
} 
?> 
 <div style="text-align: center; font-size: 16px;"><i class="fa fa-user-o" aria-hidden="true"></i>&nbsp;<?php echo ucwords($restuser['firstName']); ?>&nbsp;<?php echo ucwords($restuser['lastName']); ?></div>
 <div style="text-align: center; font-size: 25px; margin-top: 9px;color: #ff782a;"><i class="fa fa-phone-square" aria-hidden="true"></i>&nbsp;<?php if($restuser['mobile']!=''){ echo $restuser['mobile']; }else{ echo $restuser['phone']; } ?></div>
  <div style="margin-top: 35px; text-align: center; border: 1px solid #ddd; color: #fff; background-color: #4d6a89; padding: 5px; border-radius: 3px;" onClick="$('#getaccmanagerno').hide();">Close</div>

 