<?php
include "inc.php";  
 
$hotelnamemaster=$_REQUEST['hotelnamemaster'];

$where=' id="'.$hotelnamemaster.'" order by name asc';  
$rs=GetPageRecord('*','hotelMaster',$where); 
$resListing=mysqli_fetch_array($rs);   
 ?>
<?php if($resListing['category']==1){ ?>
<option value="1" <?php if($result['hotelCategory']==1){ ?>selected="selected"<?php } ?>>1 Star</option>
<?php } ?>
<?php if($resListing['category']==2){ ?>
<option value="2" <?php if($result['hotelCategory']==2){ ?>selected="selected"<?php } ?>>2 Star</option>
<?php } ?>
<?php if($resListing['category']==3){ ?>
<option value="3" <?php if($result['hotelCategory']==3){ ?>selected="selected"<?php } ?>>3 Star</option>
<?php } ?>
<?php if($resListing['category']==4){ ?>
<option value="4" <?php if($result['hotelCategory']==4){ ?>selected="selected"<?php } ?>>4 Star</option>
<?php } ?>
<?php if($resListing['category']==5){ ?>
<option value="5" <?php if($result['hotelCategory']==5){ ?>selected="selected"<?php } ?>>5 Star</option>
<?php } ?>
 
 