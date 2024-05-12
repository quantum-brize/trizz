<?php
include "inc.php";  
 
$namemaster=$_REQUEST['namemaster'];
if($_REQUEST['transferCategory']=='SIC'){
$type=1;
}
if($_REQUEST['transferCategory']=='Private'){
$type=2;
}

$where=' id="'.$namemaster.'" order by name asc';  
$rs=GetPageRecord('*','transferMaster',$where); 
$resListing=mysqli_fetch_array($rs); 

$ab=GetPageRecord('*','transferRateList','parentId="'.$resListing['id'].'" and startDate<="'.$_REQUEST['day'].'" and transferType="'.$type.'" order by id desc');  
$data=mysqli_fetch_array($ab);
echo $resListing['details'];
 
 ?>
 <script> 
	parent.$('#servicename').val('<?php echo $resListing['name']; ?>');  
	parent.$('#hotelPriceId').val('<?php echo $data['id']; ?>');   
	parent.$('#transferCategory option:selected').val('<?php if($data['transferType']==1){ echo 'SIC'; } if($data['transferType']==2){ echo 'Private'; } ?>');   
 </script>
 