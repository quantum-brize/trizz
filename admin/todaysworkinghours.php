<?php 
include "inc.php"; 

$namevalue ='checkoutTime="'.date('Y-m-d H:i:s').'"';  
$where='uSession="'.$_SESSION['uSession'].'" and userId='.$_SESSION['userid'].'';   
updatelisting('userLogs',$namevalue,$where);  
 
$totaltimecount='0';
$totaltimecountfinal='0';

$rs=GetPageRecord('lLogin,checkoutTime','userLogs',' checkoutTime!="" and  userId="'.$_SESSION['userid'].'" and date(lLogin)="'.date('Y-m-d').'"'); 
while($rest=mysqli_fetch_array($rs)){ 

 

$to_time = strtotime($rest['checkoutTime']);
$from_time = strtotime($rest['lLogin']);
$totaltimecountfinal+=$totaltimecount=round(abs($to_time - $from_time) / 60,2);
 
$hours = intdiv($totaltimecount, 60).':'. ($totaltimecount % 60);  

$namevalue ='checkoutTime="'.date('Y-m-d H:i:s').'",totalMinutes="'.$totaltimecount.'"';  
$where='uSession="'.$_SESSION['uSession'].'" and userId='.$_SESSION['userid'].'';   
updatelisting('userLogs',$namevalue,$where);  
} 

$a=GetPageRecord('SUM(totalMinutes) as totalMinutes','userLogs',' checkoutTime!="" and  userId="'.$_SESSION['userid'].'" and date(lLogin)="'.date('Y-m-d').'"'); 
$rest=mysqli_fetch_array($a);



echo $hours = sprintf("%02d",intdiv($rest['totalMinutes'], 60)).':'. sprintf("%02d",($rest['totalMinutes'] % 60));  

?> 