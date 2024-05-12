<?php
include "inc.php";  
 
$hotelnamemaster=$_REQUEST['hotelnamemaster'];

$where=' id="'.$hotelnamemaster.'" order by name asc';  
$rs=GetPageRecord('*','hotelMaster',$where); 
$resListing=mysqli_fetch_array($rs); 

$a=GetPageRecord('*','mealPlanMaster','name="'.$_REQUEST['mealPlanmaster'].'"');  
$resultmeal=mysqli_fetch_array($a);


$a=GetPageRecord('*','RoomTypeMaster','name="'.$_REQUEST['hotelRoommaster'].'"');  
$resulthotroom=mysqli_fetch_array($a); 

$ab=GetPageRecord('*','hotelRateList','hotelId="'.$resListing['id'].'" and roomType="'.$resulthotroom['id'].'" and startDate<="'.$_REQUEST['day'].'" and mealPlan="'.$resultmeal['id'].'" order by id desc');  
$data=mysqli_fetch_array($ab);


 

 ?>
 <script>   
	parent.$('#hotelName').val('<?php echo $resListing['name']; ?>');  
	parent.$('#hotelPriceId').val('<?php echo $data['id']; ?>');  
  
 </script>
 