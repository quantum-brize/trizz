<?php 
include "inc.php";   
 $nc=1;
 $body='';   
$rs=GetPageRecord('*','transferRateList',' parentId in (select id from transferMaster where status=1)  order by startDate asc '); 
while($rest=mysqli_fetch_array($rs)){ 
  
$nc++;

$rh=GetPageRecord($select,'transferMaster','id="'.$rest['parentId'].'"'); 
$hotelData=mysqli_fetch_array($rh); 
$transType='';
if($rest['transferType']==1){ $transType= 'SIC'; } if($rest['transferType']==2){ $transType= 'PVT'; }


 $body.='
  <tr>
    <td>'.$hotelData['name'].'</td> 
    <td>'.getCityName($hotelData['destination']).'</td>
    <td>'.$transType.'</td>
    <td>'.date('d/m/Y',strtotime($rest['startDate'])).'</td>
    <td>'.date('d/m/Y',strtotime($rest['endDate'])).'</td>
    <td>'.stripslashes($rest['adult']).'</td>
    <td>'.stripslashes($rest['child']).'</td> 
    <td>'.stripslashes($rest['vehicleCost']).'</td> 
  </tr>';
  }  
  
   
$data='<table width="100%" border="1" cellspacing="0" cellpadding="5">
  <tr>
  <td><strong>Transfer Name</strong></td>
  <td><strong>Destination</strong></td>
  <td><strong>Type</strong></td>
  <td><strong>From Date</strong></td>
  <td><strong>To Date</strong></td>
  <td><strong>Adult Cost</strong></td>
  <td><strong>Child Cost</strong></td>
  <td><strong>Vehicle Cost</strong></td>
  </tr>
'.$body.'
</table>';

 
$file="Transfer_Data.xls"; 
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$file");
echo $data;
 ?>
