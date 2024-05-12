<?php 
include "inc.php"; 
$paymentId = $_REQUEST['id'];  
$linkid = $_SESSION['linkid']; 


updatelisting('sys_packageBuilder',' confirmQuote=1 ','id='.decode($_SESSION['packageId']).'');

 
updatelisting('queryMaster',' statusId=5 ','id='.decode($_SESSION['queryId']).'');



$f=GetPageRecord('*','sys_packageBuilder','id='.decode($_SESSION['packageId']).''); 
$packageData=mysqli_fetch_array($f);


$fd=GetPageRecord('*','queryMaster','id="'.$packageData['queryId'].'"'); 
$queryData=mysqli_fetch_array($fd);


$rsa=GetPageRecord('*','userMaster','id="'.$queryData['clientId'].'"'); 
$userDetail=mysqli_fetch_array($rsa);
 

if($packageData['depositAmount']>0){
$totalAmt=$packageData['depositAmount'];
} else {
$totalAmt=$packageData['grossPrice'];
}

if($_SESSION['packageId']!='' && $_SESSION['queryId']!='' && $paymentId!=''){

//$namevalue2 ='paymentId="'.$paymentId.'",queryId="'.decode($_SESSION['queryId']).'",packageId="'.decode($_SESSION['packageId']).'",amount="'.$totalAmt.'",paymentDate="'.date('Y-m-d H:i:s').'",	paymentBy=0,paymentStatus=1'; 

 
updatelisting('sys_PackagePayment','paymentStatus=1,paymentId="'.$paymentId.'",paymentDate="'.date('Y-m-d H:i:s').'",transectionType="Online"','id='.$_SESSION['paymentId'].'');

include "config/mail.php"; 


if($_SESSION['linkid']==''){
$mailbody=file_get_contents(''.$fullurl.'packageConfirmReceipt.php?pid='.$_SESSION['packageId'].''); 
$subject='Booking Confirmed - '.$_SESSION['queryId'].'';
}else{

$mailbody=file_get_contents(''.$fullurl.'packageConfirmReceipt.php?pid='.$_SESSION['packageId'].'&linkpayment=1'); 
$subject='Payment Confirmed Receipt - '.$_SESSION['linkid'].'';

}

$rs=GetPageRecord($select,'sys_userMaster','id in (select addedBy from sys_userMaster where id="'.$packageData['addedBy'].'") '); 
$invoicedataa=mysqli_fetch_array($rs);

send_attachment_mail($fromemail,$userDetail['email'],$subject,$mailbody,$invoicedataa['emailAccount'],$file_name);

$pid=$_SESSION['packageId'];

$_SESSION['queryId']='';
$_SESSION['packageId']='';
$_SESSION['paymentId']='';
$_SESSION['linkid']='';

} 

header("Location: paymentdone.html?pid=".$pid."&i=".$linkid."");

?>

