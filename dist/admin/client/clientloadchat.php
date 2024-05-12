<?php
include "clientinc.php"; 

 




if($_REQUEST['action']=='sendmessage' && trim($_REQUEST['msg'])!=''){
 //include('clientmail.php');

$namevalue ='clientId="'.$_SESSION['clientId'].'",status="Sent",msg="'.addslashes(trim($_REQUEST['msg'])).'",dateAdded="'.date('Y-m-d H:i:s').'",addedBy="'.$_SESSION['clientId'].'",msgType="Client",chatUser="'.$_SESSION['chatuser'].'"';
addlistinggetlastid('sys_MessageMaster',$namevalue);


updatelisting('userMaster','onlineSessionDate="'.date('Y-m-d H:i:s').'",onlineStatus=2','id="'.$_SESSION['clientId'].'"'); 


$b=GetPageRecord('*','queryMaster','id="'.decode($_REQUEST['queryId']).'"'); 
$rest=mysqli_fetch_array($b);

$opsEmail='';
$rs22=GetPageRecord('*','sys_userMaster',' id="'.$rest['assignTo'].'" and onlineStatus<2 order by firstName asc'); 
if(mysqli_num_rows($rs22)>0){
$restuser=mysqli_fetch_array($rs22);    
$opsEmail= $restuser['email']; 

$rs=GetPageRecord($select,'sys_userMaster','id=1 '); 
$editresult=mysqli_fetch_array($rs);


$ccmail=$editresult['offlineChatEmail']; 
$mailbody=trim($_REQUEST['msg']);
//send_attachment_mail($fromemail,$opsEmail,'#'.$_REQUEST['queryId'].' Guest Message.',$mailbody,$ccmail,$files);

}


}


 
?>   

<?php
$row=1;
$rs=GetPageRecord('*','sys_MessageMaster',' clientId="'.$_SESSION['clientId'].'" and chatUser="'.$_SESSION['chatuser'].'" order by id asc');
if(mysqli_num_rows($rs)>0){
while($rest=mysqli_fetch_array($rs)){
 ?>
 
<li class="<?php if($rest['addedBy']==$_SESSION['clientId']){?>mymessage<?php }else{ ?>usermessage<?php } ?>" id="communication<?php echo ++$row; ?>" tabindex="10">
<div class="content">
<?php echo nl2br(ucwords(strip($rest['msg']))); ?>
</div>
<div class="datetimechat"><?php echo date('d M Y - h:i A', strtotime($rest['dateAdded'])); ?></div>
 
</li>
<?php } } ?> 



<script>  
scrollbottom(); 

</script>
<style>
#communication<?php echo $row; ?>{ outline: none; }
</style>
 
