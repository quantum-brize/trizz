<?php
include "inc.php";  
if(trim($_REQUEST['keyword'])!=''){
?>
 
<div class="searchdestinationboxclass">

<?php

$rs=GetPageRecord('*','wig_bus_cities',' city_name like "'.trim(strip($_REQUEST['keyword'])).'%" or city_id like "%'.trim(strip($_REQUEST['keyword'])).'" order by city_name asc limit 0,10'); 
while($resListing=mysqli_fetch_array($rs)){ 
$no=1;  
?>
<div class="list" onclick="$('#<?php echo $_REQUEST['cityresultfield']; ?>').val('<?php echo strip($resListing['city_id']); ?>');$('#<?php echo $_REQUEST['citysearchfield']; ?>').val('<?php echo strip($resListing['city_name']); ?>');$('#<?php echo $_REQUEST['searchcitylists']; ?>').hide();"><?php echo strip($resListing['DESTINATION']); ?><div style="font-size:11px; color:#666666;"><?php echo strip($resListing['city_name']); ?></div></div>
<?php } ?>
<?php if($no!=1){ ?> 
<?php } ?>

 </div>
 <?php }  else {?>
 <script>
 $('.searchdestinationboxclass').hide();
 </script>
 <?php } ?>