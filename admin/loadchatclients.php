<?php include "inc.php"; 
$chatwhere=''; 
if($LoginUserDetails['userType']!=0){ 
$chatwhere=' and id in (select clientId from queryMaster where assignTo="'.$_SESSION['userid'].'")'; 
} 



$searchwhere='';
if(trim($_REQUEST['searchdata'])!=''){
$searchwhere=' and clientId in (select id from userMaster where firstName like "%'.trim($_REQUEST['searchdata']).'%" or lastName like "%'.trim($_REQUEST['searchdata']).'%" or mobile like "%'.trim($_REQUEST['searchdata']).'%" ) ';
} 

$rs=GetPageRecord('*','userMaster',' id!=1 and id in (select addedBy from sys_MessageMaster where addedBy!=1 '.$searchwhere.' '.$chatwhere.' group by addedBy ) order by onlineStatus desc');
//$rs=GetPageRecord('*','sys_MessageMaster',' addedBy!=1 '.$searchwhere.' group by addedBy order by id asc');
if(mysqli_num_rows($rs)>0){
while($restuser=mysqli_fetch_array($rs)){

$rs22=GetPageRecord('*','sys_MessageMaster',' addedBy="'.$restuser['id'].'" order by id asc');  
$rest=mysqli_fetch_array($rs22); 

$rsnewmsg=GetPageRecord('*','sys_MessageMaster',' addedBy="'.$restuser['id'].'" and readMsg=0 and msgType="Client" order by id asc');   
 ?>
<div class="chatuserlist <?php if(mysqli_num_rows($rsnewmsg)>0){ ?> chatactive <?php } ?>">
	<div class="imgbox"  style="float:left; margin-right:10px;"><img src="images/nousericon.png" /> <?php if($restuser['onlineStatus']==0){ ?><div class="offline"></div><?php } ?> <?php if($restuser['onlineStatus']==1){ ?><div class="idel"></div><?php } ?> <?php if($restuser['onlineStatus']==2){ ?><div class="online"></div><?php } ?></div>
	<a href="display.html?ga=usermessenger&cui=<?php echo encode($rest['addedBy']); ?>"><div class="namearea" style="float:left; width:auto;">
	<div class="name"><?php echo ucwords($restuser['firstName']); ?> <?php echo ucwords($restuser['lastName']); ?></div>
	<div class="mobilenumber"><?php echo $restuser['mobile']; ?></div>
	<div class="datebox"><?php echo date('d M Y - h:i A', strtotime($restuser['onlineSessionDate'])); ?></div>
	
	</div></a>
	
	</div>
	
<?php  } } ?>