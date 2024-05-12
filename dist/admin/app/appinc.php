<?php 
include "../config/database.php"; 
include "../config/function.php"; 
include "../config/setting.php"; 



if(!isset($_COOKIE['cookuserid'])) { 


header("Location:https://travbizz.in/crm_companies/applogin.php"); 
exit();

} else { 
    $_SESSION['userid']=$_COOKIE['cookuserid'];
}


if(!isset($_COOKIE['cookusername'])) { 


header("Location:https://travbizz.in/crm_companies/applogin.php"); 
exit();

} else { 
    $_SESSION['username']=$_COOKIE['cookusername'];
}



if(!isset($_COOKIE['cookpassword'])) { 

header("Location:https://travbizz.in/crm_companies/applogin.php"); 
exit();

} else { 
    $_SESSION['password']=$_COOKIE['cookpassword'];
}




if($_SESSION['userid']=='' || $_SESSION['username']==''){
header("Location:https://travbizz.in/crm_companies/applogin.php"); 
exit();
}
 
define("_USER_MASTER_", "sys_userMaster");  
error_reporting(0); 

   
$select=''; 
$where=''; 
$rs='';  
$select='*'; 
$where='id="'.$_SESSION['userid'].'" and email="'.$_SESSION['username'].'"'; 
$rs=GetPageRecord($select,'sys_userMaster',$where); 
$LoginUserDetails=mysqli_fetch_array($rs);


if($LoginUserDetails['email']!=$_SESSION['username'] || md5($_SESSION['password'])!=$LoginUserDetails['password']){
 header("Location:https://travbizz.in/crm_companies/applogin.php"); 
 exit();
}

 
  
$rs=GetPageRecord('*','userLogs','userId="'.$_SESSION['userid'].'" order by id desc'); 
$LoginUserlog=mysqli_fetch_array($rs);



if($LoginUserDetails['id']=='1' || $LoginUserDetails['parentId']=='1'){
$namevalue ='cLogin="'.date('Y-m-d H:i:s').'"';  
$where='id="'.$LoginUserDetails['id'].'"';   
updatelisting('sys_userMaster',$namevalue,$where); 
}


function checkemail($email){
if (strpos($email, '@') !== false) {
 return $email;
} else {
return '<span class="lightgraytext">Not Provided</span>';
}
}

function checkmobile($mobile){
$numlength = strlen((string)$mobile); 
if ($numlength>9) {
 return $mobile;
} else {
return '<span class="lightgraytext">Not Provided</span>';
}
}


function showhotelcategory($star){
$totalstar='';
for ($k = 0 ; $k < $star; $k++){
$totalstar.='<i class="dripicons-star"></i>';
}
return $totalstar; 
}  

function getamenities($id){ 
$a=GetPageRecord('*','amenitiesMaster','id="'.$id.'"'); 
$hoteldetails=mysqli_fetch_array($a); 
return $hoteldetails['name']; 
}  



function starcategory($cat){
for ($x = 0; $x <= ($cat-1); $x++) {
  echo "<i class='fa fa-star' aria-hidden='true'></i>";
}
}



 
 
 

function getUserNameNew($id){
$a=GetPageRecord('firstName','sys_userMaster','id="'.$id.'"'); 
$displayData=mysqli_fetch_array($a);
return $displayData['firstName'];
}



function displaydateinnumber($date){
if($date!='1970-01-0' && $date!='' && $date!='0000-00-00' && $date!='1970-01-01'){
return date('d/m/Y',strtotime($date));
}
}

function displaydateinword($date){
if($date!='1970-01-0' && $date!='' && $date!='0000-00-00 00:00:00' && $date!='1970-01-01'){
return date('j M Y',strtotime($date));
}
}


function displaydateinwordshort($date){
if($date!='1970-01-0' && $date!='' && $date!='0000-00-00 00:00:00' && $date!='1970-01-01'){
return date('j M Y',strtotime($date));
}
}

function displaydateindatetme($date){
if($date!='1970-01-0' && $date!='' && $date!='1970-01-01'){
return date('d/m/Y - h:i A',strtotime($date));
}
}


function daysbydates($startdate,$enddate){
$start = strtotime($startdate);
$end = strtotime($enddate); 
return ceil(abs($end - $start) / 86400);
}



$k=GetPageRecord('*','currencyMaster','defaultThis=1'); 
$curr=mysqli_fetch_array($k);

 


function cleanstring($string) {

   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
      $string = str_replace('----', '-', $string); // Replaces all spaces with hyphens.
   $string = str_replace('---', '-', $string); // Replaces all spaces with hyphens.
   $string = str_replace('--', '-', $string); // Replaces all spaces with hyphens.
   $string = str_replace('-', '-', $string); // Replaces all spaces with hyphens.

   return strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $string)); // Removes special chars.
}




function addbynewbadges($id){ 
$a=GetPageRecord('*','sys_userMaster','id="'.$id.'"'); $profilename=mysqli_fetch_array($a);

if($profilename['firstName']!=''){
return '<table border="0" cellpadding="0" cellspacing="0" class="addbynewbadges">
  <tr>
    <td colspan="2"><div class="listnameicon">'.substr(stripslashes($profilename['firstName']),0,1).'</div></td>
    <td>'.stripslashes($profilename['firstName']).'</td>
  </tr>
  
</table>';
 }
}

function newstatusbadges($status){
if($status==1){ 
return '<span class="badge badge-success">Active</span>';
} else {
return '<span class="badge badge-danger">Inactive</span>'; 
} 
}
?>

 