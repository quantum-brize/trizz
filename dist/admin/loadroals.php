<?php
include "inc.php";
$branchid=$_REQUEST['branchidmain'];
?>
<option value="0" <?php if($result['parentId']==0){ ?>selected="selected"<?php } ?>>No Parent</option> 
 <?php    
$rs=GetPageRecord('*','roleMaster',' branchId="'.$branchid.'" order by id asc'); 
while($rest=mysqli_fetch_array($rs)){  
?> 
<option value="<?php echo trim($rest['id']); ?>" <?php if($result['parentId']==trim($rest['id'])){ ?>selected="selected"<?php } ?>><?php echo stripslashes($rest['name']); ?></option> 
  <?php }  ?>