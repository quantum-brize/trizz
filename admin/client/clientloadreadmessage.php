<?php
include "clientinc.php"; 
 
?>   
<script>
<?php 
$rs=GetPageRecord('*','sys_MessageMaster',' clientId="'.$_SESSION['clientId'].'" and chatUser="'.$_SESSION['chatuser'].'" order by id asc');
if(mysqli_num_rows($rs)==1){


$rs=GetPageRecord('*','sys_userMaster','id=1 '); 
$editresult=mysqli_fetch_array($rs);

$b=GetPageRecord('*','queryMaster','clientId="'.$_SESSION['clientId'].'" order by id desc'); 
$rest=mysqli_fetch_array($b);

$rslog=GetPageRecord('*','queryLogs','queryId="'.$rest['id'].'" and logType="assign_query" and userId!=1 order by id desc'); 
$log=mysqli_fetch_array($rslog);
 
 
 
$rsckon=GetPageRecord('*','sys_userMaster','onlineStatus=2 and DATE(onlineSessionDate)="'.date('Y-m-d').'"');  
if(mysqli_num_rows($rsckon)>0){



 
if(mysqli_num_rows($rslog)==1){ 
$rs22=GetPageRecord('*','sys_userMaster',' id=1 order by firstName asc'); 
$restuser=mysqli_fetch_array($rs22); 

$autoChatMsg ='<h5>Hi From '.stripslashes($companydetails['invoiceCompany']).',</h5>I&rsquo;m '.$restuser['firstName'].' '.$restuser['lastName'].', Your Travel Advisor for the requested Query.<br />Please advise how can I help you today.';

}

if(mysqli_num_rows($rslog)>1){  
$rs22=GetPageRecord('*','sys_userMaster',' id="'.$log['userId'].'" order by firstName asc'); 
$restuser=mysqli_fetch_array($rs22); 

$autoChatMsg ='<h5>Hi Again From '.stripslashes($companydetails['invoiceCompany']).',</h5>Your Query is now re-aligned to '.$restuser['firstName'].' '.$restuser['lastName'].', Your New Travel Advisor for the requested Query.<br />Please advise how can I help you today.'; 
}

if(mysqli_num_rows($rslog)==0){   

$rs22=GetPageRecord('*','sys_userMaster',' id="'.$rest['assignTo'].'" order by firstName asc'); 
$restuser=mysqli_fetch_array($rs22); 


$autoChatMsg ='<h5>Hi From '.stripslashes($companydetails['invoiceCompany']).',</h5>I&rsquo;m '.$restuser['firstName'].' '.$restuser['lastName'].', Your Travel Advisor for the requested Query.<br />Please advise how can I help you today.';
 
}

$namevalue ='clientId="'.$_SESSION['clientId'].'",status="Received",msg="'.addslashes(trim($autoChatMsg)).'",dateAdded="'.date('Y-m-d H:i:s').'",addedBy="1",msgType="Operation",chatUser="'.$_SESSION['chatuser'].'"';
addlistinggetlastid('sys_MessageMaster',$namevalue);
}else{

// If offline  
$autoChatMsg ='<h5>Sorry we aren&rsquo;t online at the moment.</h5>Live Chat operating hours are from 10am to 7pm.<br />Excluding Sundays & Public Holliday&rsquo;s<br />
Please leave a message and one of our Travel Advisors will get back to you shortly.';
 

$namevalue ='clientId="'.$_SESSION['clientId'].'",status="Received",msg="'.addslashes(trim($autoChatMsg)).'",dateAdded="'.date('Y-m-d H:i:s').'",addedBy="1",msgType="Operation",chatUser="'.$_SESSION['chatuser'].'"';
addlistinggetlastid('sys_MessageMaster',$namevalue);

}
 
 }
 


$rs=GetPageRecord('*','sys_MessageMaster',' clientId="'.$_SESSION['clientId'].'" and chatUser="'.$_SESSION['chatuser'].'" and readMsg=0 and addedBy!="'.$_SESSION['clientId'].'" order by id asc');
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
