<?php
include "inc.php";
$queryId=decode($_REQUEST['queryId']);
$serviceId=decode($_REQUEST['serviceId']);
?>

											 
 <?php  
 $n=1; 
$rs=GetPageRecord('*','supplierNotes',' serviceId="'.$serviceId.'" and  queryId="'.$queryId.'" order by id desc');
while($rest=mysqli_fetch_array($rs)){ 
?> 
<div style="background-color: #ffffe1; border: 2px solid #ffdeae91; font-size: 14px; color: #000; margin-bottom: 10px; padding:10px; border-radius: 4px;">
											 <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2%" align="left" valign="top"><i class="fa fa-thumb-tack" aria-hidden="true" style="font-size: 20px; color:#ff8d00;"></i></td>
    <td width="98%" align="left" valign="top" style="padding-left:10px;"><div style=" margin-bottom:5px;"><?php echo nl2br(stripslashes($rest['details'])); ?></div>
	
	<div style=" font-size:12px;"><em><?php echo date('d/m/Y - h:i A',strtotime($rest['dateAdded'])); ?></em> by <?php $rsb=GetPageRecord('*','sys_userMaster',' id="'.$rest['addedBy'].'"');while($restsource=mysqli_fetch_array($rsb)){  echo stripslashes($restsource['firstName'].' '.$restsource['lastName']); }?></div>
	</td>
  </tr>
</table>
 </div>
 <?php $n++; } ?>
 
 <?php if($n==1){ ?>
 <div style="text-align:center; color:#999999;">No Remark </div>
 <?php } ?>