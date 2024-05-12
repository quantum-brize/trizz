<?php
include "inc.php";  
if(trim($_REQUEST['keyword'])!=''){
?>
 
<div class="searchdestinationboxclass">

<?php

$rs=GetPageRecord('*','apiDestinationMaster','DESTINATION like "'.trim(strip($_REQUEST['keyword'])).'%"  order by DESTINATION desc limit 0,10'); 
while($resListing=mysqli_fetch_array($rs)){ 
$no=1;  
?>
<div class="list" onclick="$('.destinationhotelcountry').text('<?php echo strip($resListing['COUNTRY']); ?>');$('#<?php echo $_REQUEST['cityresultfield']; ?>').val('<?php echo strip($resListing['CITYID']); ?>,<?php echo strip($resListing['COUNTRYCODE']); ?>');$('#<?php echo $_REQUEST['citysearchfield']; ?>').val('<?php echo strip($resListing['DESTINATION']); ?>');$('#<?php echo $_REQUEST['searchcitylists']; ?>').hide();"><?php echo strip($resListing['DESTINATION']); ?>,<?php echo strip($resListing['COUNTRY']); ?><div style="font-size:11px; color:#666666;"><?php echo strip($resListing['DESTINATION']); ?></div></div>
<?php } ?>
<?php if($no!=1){ ?> 
<?php } ?>

 </div>
 <?php }  else {?>
 <script>
 $('.searchdestinationboxclass').hide();
 </script>
 <?php } ?>