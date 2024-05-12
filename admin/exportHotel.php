<?php 
include "inc.php";   
 $nc=1;
 $body='';
$rs=GetPageRecord('*','hotelRateList',' hotelId in (select id from hotelMaster where status=1)  order by startDate asc '); 
while($rest=mysqli_fetch_array($rs)){ 
$nc++;

$rh=GetPageRecord($select,'hotelMaster','id="'.$rest['hotelId'].'"'); 
$hotelData=mysqli_fetch_array($rh);

$rs33=GetPageRecord($select,'RoomTypeMaster','id="'.$rest['roomType'].'" '); 
$roomtypename=mysqli_fetch_array($rs33);

$rs333=GetPageRecord($select,'mealPlanMaster','id="'.$rest['mealPlan'].'" '); 
$mealplanname=mysqli_fetch_array($rs333);
 $body.='
  <tr>
    <td>'.$hotelData['name'].'</td>
    <td>'.$hotelData['category'].' Star</td>
    <td>'.getCityName($hotelData['destination']).'</td>
    <td>'.date('d/m/Y',strtotime($rest['startDate'])).'</td>
    <td>'.date('d/m/Y',strtotime($rest['endDate'])).'</td>
    <td>'.stripslashes($roomtypename['name']).'</td>
    <td>'.stripslashes($mealplanname['name']).'</td>
    <td>'.stripslashes($rest['single']).'</td>
    <td>'.stripslashes($rest['doublePrice']).'</td>
    <td>'.stripslashes($rest['triple']).'</td>
    <td>'.stripslashes($rest['quad']).'</td>
    <td>'.stripslashes($rest['childBed']).'</td>
    <td>'.stripslashes($rest['extraAdult']).'</td>
    <td>'.stripslashes($hotelData['contactPerson']).'</td>
    <td>'.stripslashes($hotelData['contactPersonEmail']).'</td>
    <td>'.stripslashes($hotelData['contactPersonPhone']).'</td>
    <td>'.stripslashes($hotelData['imgLink']).'</td>
  </tr>';
  }  
  
   
$data='<table width="100%" border="1" cellspacing="0" cellpadding="5">
  <tr>
  <td><strong>Hotel Name</strong></td>
  <td><strong>Category</strong></td>
  <td><strong>Destination</strong></td>
  <td><strong>From Date</strong></td>
  <td><strong>To Date</strong></td>
  <td><strong>Room Type</strong></td>
  <td><strong>Meal Plan</strong></td>
  <td><strong>Single</strong></td>
  <td><strong>Double</strong></td>
  <td><strong>Triple</strong></td>
  <td><strong>Quad</strong></td>
  <td><strong>Child Extra Bed</strong></td>
  <td><strong>Child No Bed</strong></td>
  <td><strong>Contact Person</strong></td>
  <td><strong>Email</strong></td>
  <td><strong>Phone</strong></td>
  <td><strong>Image Link</strong></td>
</tr>
'.$body.'
</table>';

 
$file="Hotel_Data.xls"; 
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$file");
echo $data;
 ?>
