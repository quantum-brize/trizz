<?php
include "clientinc.php"; 



if($_POST['action']=='uploadphoto'){ 
if($_FILES["profileimg"]["tmp_name"]!=""){ 
$rt=mt_rand().strtotime(date("YMDHis")); 
$companyLogoFileName=basename($_FILES['profileimg']['name']); 
$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION); 
$profilePhoto=time().$rt.'.'.$companyLogoFileExtension;  
move_uploaded_file($_FILES["profileimg"]["tmp_name"], "images/profileImg/{$profilePhoto}"); 
}
 

$namevalue ='profilePhoto="'.$profilePhoto.'"';  
$where='id="'.$_SESSION['clientId'].'"';   
updatelisting('userMaster',$namevalue,$where);  

header('location:index.html');
 }
 
 
 
 
 
 
 
 
 
 
 
 
 
if($_POST['action']=='editprofilesetting'){ 
 

$firstName = addslashes(trim($_POST['firstName']));
$lastName = addslashes(trim($_POST['lastName']));
$email = addslashes(trim($_POST['email']));
$mobile = addslashes(trim($_POST['mobile']));
$address = addslashes(trim($_POST['address'])); 
$submitName = addslashes(trim($_POST['submitName'])); 
$mobileCode = addslashes(trim($_POST['mobileCode'])); 
$city = addslashes(trim($_POST['city']));  
 

$namevalue ='firstName="'.$firstName.'",lastName="'.$lastName.'",mobile="'.$mobile.'",address="'.$address.'",submitName="'.$submitName.'",mobileCode="'.$mobileCode.'",city="'.$city.'"';  
$where='id="'.$_SESSION['clientId'].'"';   
updatelisting('userMaster',$namevalue,$where);  
?>
<script> 
 parent.window.location.href = "profile.html?c=1";
  </script>
<?php 
exit();
 }
 
 
 
 
 
 
 
 
 
 
 
if($_POST['action']=='editppasswordsetting'){  

$currPassword = addslashes(trim($_POST['currPassword']));
$newPassword = addslashes(trim($_POST['newPassword']));
$confPassword = addslashes(trim($_POST['confPassword']));

$passValue='';

if($currPassword!=''){
$result =mysqli_query (db(),"select * from userMaster where id='".$_SESSION['clientId']."' and  password='".md5($currPassword)."' ")  or die(mysqli_error());  
if(mysqli_num_rows($result)>0){  
 
if($newPassword==$confPassword){



$namevalue ='password="'.md5($newPassword).'"';  
$where='id="'.$_SESSION['clientId'].'"';   
updatelisting('userMaster',$namevalue,$where); 

?>
<script> 
 parent.window.location.href = "profile.html?p=1";
  </script>
<?php 


}else{
?>
<script> alert('Password did not match!'); </script>
<?php
exit();
}
}else{
?>
<script> alert('Current Password did not match!'); </script>
<?php
exit();
}
}

 

exit();
 }
 
 
 
 
 
if($_POST['action']=='editguestdetails' && $_POST['editId']!='' && $_POST['qd']!=''){ 
 
$submitName = addslashes(trim($_POST['submitName']));
$firstName = addslashes(trim($_POST['firstName']));
$lastName = addslashes(trim($_POST['lastName']));
$gender = addslashes(trim($_POST['gender']));
$dob = date('Y-m-d', strtotime($_POST['startDate'])); 
 
 

$namevalue ='firstName="'.$firstName.'",lastName="'.$lastName.'",gender="'.$gender.'",dob="'.$dob.'",submitName="'.$submitName.'"';  
$where='id="'.decode($_POST['editId']).'"';   
updatelisting('sys_guests',$namevalue,$where);  
?>
<script> 
 parent.window.location.href = "my-trip-details.html?id=<?php echo $_POST['qd']; ?>";
  </script>
<?php 
exit();
 }


 
 
if($_REQUEST['action']=='deletedoc' && $_REQUEST['id']!='' && $_REQUEST['qd']!=''){  

deleteRecord('sys_guestsDucument','id="'.decode($_REQUEST['id']).'"');


?>
<script>  
 parent.uploadguestdocument('<?php echo $_REQUEST['guestId']; ?>');
  </script>
<?php 
exit();
 }



if(trim($_POST['action'])=='editguestdocuments' ){   
  include('clientmail.php');
$editId=decode($_POST['editId']);
$queryId=decode($_POST['qd']);   

$docinclude='';
$files='';

if($_FILES["panCard"]["tmp_name"]!=""){ 
$rt=mt_rand().strtotime(date("YMDHis")); 
$companyLogoFileName=basename($_FILES['panCard']['name']); 
$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION); 
$panCard=time().$rt.'.'.$companyLogoFileExtension;  
move_uploaded_file($_FILES["panCard"]["tmp_name"], "../software/profilepic/{$panCard}"); 
 
$namevalue ='queryId="'.$queryId.'",guestId="'.$editId.'",documentType="PanCard",document="'.$panCard.'",dateAdded="'.date('Y-m-d H:i:s').'"';
addlistinggetlastid('sys_guestsDucument',$namevalue);  

$docinclude.='Pan Card Uploaded<br />';
$files.=$panCard.',';
} 


 
 

if($_FILES["passportFront"]["tmp_name"]!=""){ 
$rt=mt_rand().strtotime(date("YMDHis")); 
$companyLogoFileName=basename($_FILES['passportFront']['name']); 
$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION); 
$passportFront=time().$rt.'.'.$companyLogoFileExtension;  
move_uploaded_file($_FILES["passportFront"]["tmp_name"], "../software/profilepic/$passportFront"); 
 
$namevalue ='queryId="'.$queryId.'",guestId="'.$editId.'",documentType="PassportFront",document="'.$passportFront.'",dateAdded="'.date('Y-m-d H:i:s').'"';
addlistinggetlastid('sys_guestsDucument',$namevalue);   

$docinclude.='Passport Front Uploaded<br />';
$files.=$passportFront.',';

}

 

if($_FILES["passportBack"]["tmp_name"]!=""){ 
$rt=mt_rand().strtotime(date("YMDHis")); 
$companyLogoFileName=basename($_FILES['passportBack']['name']); 
$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION); 
$passportBack=time().$rt.'.'.$companyLogoFileExtension;  
move_uploaded_file($_FILES["passportBack"]["tmp_name"], "../software/profilepic/{$passportBack}"); 
 
$namevalue ='queryId="'.$queryId.'",guestId="'.$editId.'",documentType="PassportBack",document="'.$passportBack.'",dateAdded="'.date('Y-m-d H:i:s').'"';
addlistinggetlastid('sys_guestsDucument',$namevalue);   

$docinclude.='Passport Back Uploaded<br />';
$files.=$passportBack.',';


} 


 
 

$totfile=count($_FILES["flight"]["tmp_name"]);
$countFlightdoc='';
for($i=0; $i<=$totfile; $i++) {
if($_FILES["flight"]["tmp_name"][$i]!=""){ 
$rt=mt_rand().strtotime(date("YMDHis")); 
$companyLogoFileName=basename($_FILES['flight']['name'][$i]); 
$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION); 
$flight=time().$rt.'.'.$companyLogoFileExtension;  
move_uploaded_file($_FILES["flight"]["tmp_name"][$i], "../software/profilepic/{$flight}"); 
 
$namevalue ='queryId="'.$queryId.'",guestId="'.$editId.'",documentType="Flight",document="'.$flight.'",dateAdded="'.date('Y-m-d H:i:s').'"';
 addlistinggetlastid('sys_guestsDucument',$namevalue);   
$countFlightdoc.=$flight.',';
}  
} 
if($totfile>0){
$docinclude.='Flight Document Uploaded<br />';
}
  $files.=$countFlightdoc;
 





if($docinclude!=''){
$ccmail='info@travBizz.com'; 
$mailbody=$docinclude;
send_attachment_mail($fromemail,'info@travBizz.com','#'.encode($queryId).' Guest Documents Uploaded.',$mailbody,$ccmail,$files);
}
?> 
<script> 
parent.window.location.href = "my-trip-details.html?id=<?php echo $_POST['qd']; ?>";
</script> 
<?php 
}
 
 
 
 
 
  
if($_REQUEST['action']=='redeemcouponcode' && $_REQUEST['queryId']!='' && $_REQUEST['couponId']!=''){ 
  include('clientmail.php');
$queryId = decode($_REQUEST['queryId']); 
$couponId = decode($_REQUEST['couponId']); 
$couponValue=0;

$fd=GetPageRecord('*','loginCouponMaster','queryId in (select id from queryMaster where clientId="'.$_SESSION['clientId'].'") and startDate<="'.date('Y-m-d').'" and endDate>="'.date('Y-m-d').'" and status=1 order by id desc'); 
if(mysqli_num_rows($fd)>0){
$couponData=mysqli_fetch_array($fd);
$couponValue=$couponData['couponValue'];
}
 
$a=GetPageRecord('*','sys_PackagePayment','queryId="'.$queryId.'" and packageId in (select id from sys_packageBuilder where queryId="'.$queryId.'" and confirmQuote=1) and paymentStatus!=0 order by paymentDate desc'); 
$countPayment=mysqli_num_rows($a);
$billingData=mysqli_fetch_array($a);

 if($countPayment==1){
	$namevalue2 ='queryId="'.$queryId.'",packageId="'.$billingData['packageId'].'",amount="'.$couponValue.'",paymentDate="'.date('Y-m-d H:i:s').'",paymentStatus="1",transectionType="Login Coupon",paymentId="Login Coupon",remark="Login Coupon"';
	addlistinggetlastid('sys_PackagePayment',$namevalue2); 
 }
 
  if($countPayment>1){
	$namevalue2 ='queryId="'.$queryId.'",packageId="'.$billingData['packageId'].'",amount="'.$couponValue.'",paymentDate="'.date('Y-m-d H:i:s').'",paymentStatus="1",transectionType="Login Coupon",paymentId="Login Coupon",remark="Login Coupon"';
	addlistinggetlastid('sys_PackagePayment',$namevalue2); 
	
	updatelisting('sys_PackagePayment','amount="'.($billingData['amount']-$couponValue).'"','id="'.$billingData['id'].'"');
 }
 
 
$to=''; 
$rs22=GetPageRecord('*','userMaster',' id="'.$_SESSION['clientId'].'"');
if(mysqli_num_rows($rs22)>0){
$restuser=mysqli_fetch_array($rs22);   
echo $to= $restuser['email']; 
 


$ccmail=''; 
$mailbody='Dear '.$restuser['firstName'].'<br />
<br /> 
Your coupon has been redeemed successfully. ReferenceId - '.$_REQUEST['queryId'].'<br />
<br />
<br /> 
Thanks and Regards,<br>

Team| TravBizz ';
$subject='Coupon Redeemed - TravBizz ';
send_attachment_mail($fromemail,$to,$subject,$mailbody,$ccmail,$files);




////=====================Mail to admin

$ccmail=''; 
$mailbody='Dear TravBizz <br />
<br /> 
Login coupon has been redeemed successfully by '.$restuser['firstName'].'. ReferenceId - '.$_REQUEST['queryId'].'<br />
<br />
<br /> 
Thanks and Regards,<br>

Team| TravBizz ';
$subject='Redeemed Login Coupon ';
send_attachment_mail($fromemail,'info@travbizz.com',$subject,$mailbody,$ccmail,$files);
}

?>
<script> 
 parent.window.location.href = "my-trip-details.html?id=<?php echo $_REQUEST['queryId']; ?>&cid=<?php echo $_REQUEST['couponId']; ?>";
  </script>
<?php 
exit();
 }

 
 
 
  

?>