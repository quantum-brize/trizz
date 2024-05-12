<?php
include "clientinc.php";   
 
?> 
<style>
.chat{ 
font-size:14px; padding: 0px 20px;
 }
</style>
 <?php  
 $row=0;  
 
 $rs1=GetPageRecord('*','sys_MessageMaster',' clientId="'.$_SESSION['clientId'].'" group by chatUser order by id asc');
 while($rest1=mysqli_fetch_array($rs1)){
 ?>
 <ul class="careerfy-row careerfy-employer-profile-form" style="margin-top: 20px;"> 
<li ><div style="text-align:center; width:fit-content; border:1px solid #ddd; padding:5px; border-radius:3px; margin:auto;">Session: <?php echo $rest1['chatUser']; ?> - <?php echo date('d/m/Y H:i a', strtotime($rest1['dateAdded'])); ?></div></li>
</ul>
 <?php
 //echo ' clientId="'.$_SESSION['clientId'].'" and chatUser="'.$rest1['chatUser'].'" order by id asc';
$rs=GetPageRecord('*','sys_MessageMaster',' clientId="'.$_SESSION['clientId'].'" and chatUser="'.$rest1['chatUser'].'" order by id asc');
if(mysqli_num_rows($rs)<1){
?><ul class="careerfy-row careerfy-employer-profile-form" style="margin-top: 20px;"> 
<li >
   <div class="chat" style="text-align:center;" >No message.</div> 
 </li>
 </ul>
<?php
}
while($rest=mysqli_fetch_array($rs)){
$css='';
if($rest['status']=='Sent'){ $css='float:right; background-color: #ccf0de; border-radius: 3px; margin:2px;color: #000;'; }
if($rest['status']=='Received'){ $css='float: left; padding: 4px 20px; background-color: #f2eeee; border-radius: 3px; margin: 2px;color: #000;'; }
  ?>
  <ul class="careerfy-row careerfy-employer-profile-form" tabindex="-1" id="communication<?php echo ++$row; ?>"> 
  <li>
   <div class="chat" style=" <?php echo $css; ?>" ><?php echo ucwords(strip($rest['msg'])); ?>
	<span  style="margin-left:5px; font-size:9px;"><em><?php echo date('d/m/Y H:i a', strtotime($rest['dateAdded'])); ?></em></span><?php if($rest['status']=='Sent'){ ?><i class="fa fa-check" aria-hidden="true" style="font-size: 8px; margin-left: 1px;"></i><?php } ?></div> 
 </li>
 </ul>
  <?php } } ?>
  <script> 
		
		document.getElementById( 'communication<?php echo $row; ?>' ).focus( );
		
		 
  </script>
  <style>
  #communication<?php echo $row; ?>{ outline: none; }
  </style>
 
