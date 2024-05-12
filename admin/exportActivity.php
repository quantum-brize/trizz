<?php 
include "inc.php";   
 $nc=1;
 $body=''; 
$rs=GetPageRecord('*','sightseeingRateList',' parentId in (select id from sightseeingMaster where status=1)  order by startDate asc '); 
while($rest=mysqli_fetch_array($rs)){ 
  
$nc++;

$rh=GetPageRecord($select,'sightseeingMaster','id="'.$rest['parentId'].'"'); 
$hotelData=mysqli_fetch_array($rh); 
 $body.='
  <tr>
    <td>'.$hotelData['name'].'</td> 
    <td>'.getCityName($hotelData['destination']).'</td>
    <td>'.date('d/m/Y',strtotime($rest['startDate'])).'</td>
    <td>'.date('d/m/Y',strtotime($rest['endDate'])).'</td>
    <td>'.stripslashes($rest['adult']).'</td>
    <td>'.stripslashes($rest['child']).'</td> 
  </tr>';
  }  
  
   
$data='<table width="100%" border="1" cellspacing="0" cellpadding="5">
  <tr>
  <td><strong>Activity Name</strong></td>
  <td><strong>Destination</strong></td>
  <td><strong>From Date</strong></td>
  <td><strong>To Date</strong></td>
  <td><strong>Adult</strong></td>
  <td><strong>Child</strong></td>
  </tr>
'.$body.'
</table>';

 
$file="Activity_Data.xls"; 
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$file");
echo $data;
 ?>
