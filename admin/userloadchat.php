<?php
include "inc.php"; 

if($_REQUEST['action']=='sendmessage' && trim($_REQUEST['msg'])!='' && trim($_REQUEST['clientId'])!=''){ 

$rs=GetPageRecord('*','sys_MessageMaster',' clientid="'.decode($_REQUEST['clientId']).'" order by id desc'); 
$rests=mysqli_fetch_array($rs);

$namevalue ='clientId="'.decode($_REQUEST['clientId']).'",status="Received",msg="'.addslashes(trim($_REQUEST['msg'])).'",dateAdded="'.date('Y-m-d H:i:s').'",addedBy="'.$_SESSION['userid'].'",msgType="Operation",chatUser="'.$rests['chatUser'].'"';
$lastid=addlistinggetlastid('sys_MessageMaster',$namevalue); 
}
 
?>   

<?php 
$rs=GetPageRecord('*','sys_MessageMaster',' clientid="'.decode($_REQUEST['clientId']).'" order by id asc');
if(mysqli_num_rows($rs)>0){
while($rest=mysqli_fetch_array($rs)){
$lastId=$rest['id'];
 ?>
 
<li class="<?php if($rest['addedBy']==$_SESSION['userid']){?>mymessage<?php }else{ ?>usermessage<?php } ?>" id="communication<?php echo $lastId; ?>" tabindex="10">
<div class="content"><?php echo ucwords(strip($rest['msg'])); ?></div>
<div class="datetimechat"><?php echo date('d M Y - h:i A', strtotime($rest['dateAdded'])); ?></div> 
</li> 

<?php } } ?> 
 <script>  
scrollbottom(); 

</script>
