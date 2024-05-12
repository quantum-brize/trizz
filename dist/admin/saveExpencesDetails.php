<?php
include "inc.php";

if($_REQUEST['id']!=''){

$details=addslashes($_REQUEST['details']);
$status=addslashes($_REQUEST['status']);
$bookingStatusId=addslashes($_REQUEST['bookingStatusId']);
$amount=addslashes($_REQUEST['amount']);
$sellamount=addslashes($_REQUEST['sellamount']);
$supplierId=addslashes($_REQUEST['supplierId']);
$dueDate=date('Y-m-d',strtotime($_REQUEST['dueDate']));

$namevalue ='details="'.$details.'",amount="'.$amount.'",sellAmount="'.$sellamount.'",supplierId="'.$supplierId.'",dueDate="'.$dueDate.'",status="'.$status.'",bookingStatusId="'.$bookingStatusId.'"';
 ?>
 
 <?php
$where='id="'.$_REQUEST['id'].'"';   
$update = updatelisting('tourExpencesEntry',$namevalue,$where); 
}
?>