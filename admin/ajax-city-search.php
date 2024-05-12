<?php
include "inc.php"; 
if(isset($_POST['search']) && $_POST['sectionType']!=""){ 

 $a=GetPageRecord('*','sys_packageBuilderEvent','sectionType="'.$_POST['sectionType'].'" and  name like "%'.$_POST['search'].'%" group by name order by name asc limit 0,25');  
$result=mysqli_fetch_array($a);

 $response = array(); 
 while($row = mysqli_fetch_array($a) ){
   $response[] = array("value"=>stripslashes($row['name']),"label"=>stripslashes($row['name']));
 }

 echo json_encode($response);
}




if(isset($_POST['search']) && $_POST['room']=="roomhotel"){ 

 $a=GetPageRecord('*','sys_packageBuilderEvent','hotelRoom!="" and  hotelRoom like "%'.$_POST['search'].'%" group by hotelRoom order by hotelRoom asc limit 0,25');  
$result=mysqli_fetch_array($a);

 $response = array(); 
 while($row = mysqli_fetch_array($a) ){
   $response[] = array("value"=>stripslashes($row['hotelRoom']),"label"=>stripslashes($row['hotelRoom']));
 }

 echo json_encode($response);
}





if(isset($_POST['search']) && $_POST['mealPlan']=="mealPlan"){ 

 $a=GetPageRecord('*','sys_packageBuilderEvent','mealPlan!="" and  mealPlan like "%'.$_POST['search'].'%" group by mealPlan order by mealPlan asc limit 0,25');  
$result=mysqli_fetch_array($a);

 $response = array(); 
 while($row = mysqli_fetch_array($a) ){
   $response[] = array("value"=>stripslashes($row['mealPlan']),"label"=>stripslashes($row['mealPlan']));
 }

 echo json_encode($response);
}



?>