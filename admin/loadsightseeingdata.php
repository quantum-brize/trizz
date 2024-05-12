<?php
include "inc.php";  
 
$namemaster=$_REQUEST['namemaster'];

$where=' id="'.$namemaster.'" order by name asc';  
$rs=GetPageRecord('*','sightseeingMaster',$where); 
$resListing=mysqli_fetch_array($rs); 

$ab=GetPageRecord('*','sightseeingRateList','parentId="'.$resListing['id'].'" and startDate<="'.$_REQUEST['day'].'" order by id desc');  
$data=mysqli_fetch_array($ab);
 echo $resListing['details'];
 ?>
 <script> 
	parent.$('#servicename').val('<?php echo $resListing['name']; ?>');  
	parent.$('#hotelPriceId').val('<?php echo $data['id']; ?>');   
 </script>
 