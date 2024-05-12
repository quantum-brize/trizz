<?php
include "inc.php";  
 
$hotelnamemaster=$_REQUEST['hotelnamemaster'];
$wheremeal='';
if($_REQUEST['meal']){
$wheremeal=' and name="'.$_REQUEST['meal'].'"';
}
$allmealid='';
$where=' id="'.$hotelnamemaster.'"  order by name asc';  
$rs=GetPageRecord('*','hotelMaster',$where); 
$resListing=mysqli_fetch_array($rs);   
 
$ab=GetPageRecord('*','hotelRateList','hotelId="'.$resListing['id'].'" and startDate<="'.$_REQUEST['day'].'" order by id desc');  
while($data=mysqli_fetch_array($ab)){
$allmealid.=$data['mealPlan'].',';
} 
 ?> 
  <option value="">Select Meal Plan</option>
 <?php 
 
 $n=0; $a=GetPageRecord('*','mealPlanMaster','id in ('.rtrim($allmealid,',').')');  
while($resulthot=mysqli_fetch_array($a)){ ?>
 <option value="<?php echo strip($resulthot['name']); ?>" <?php if($resulthot['name']==$result['mealPlan']){ ?> selected="selected" <?php } ?>><?php echo strip($resulthot['name']); ?></option>  
 <?php } ?>
 
 