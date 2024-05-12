<?php
include "inc.php"; 

$abcd=GetPageRecord('*','sys_packageBuilder','id="'.decode($_REQUEST['id']).'"'); 
$result=mysqli_fetch_array($abcd); 
if($result['id']!='' && $result['linkSharing']==1){

$select='*'; 
$where='id="'.$result['addedBy'].'"'; 
$rs=GetPageRecord($select,'sys_userMaster',$where); 
$LoginUserDetails=mysqli_fetch_array($rs);
?>
 

 
<?php include "itineraries_final_pdf_withimage2.php"; ?>

<?php }  else { ?>
<div style="padding-top:50px; font-size:30px; text-align:center;">Access Denied</div>
<div style="padding-top:20px; font-size:15px; text-align:center;">You don't currently have permission to access this itinerary.</div>
<?php } ?>
 