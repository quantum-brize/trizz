<?php
include "config/database.php";
include "config/function.php";
include "config/setting.php";

if($_POST['action']=='savelogo' && $_POST['agentId']!=""){ 
$agentId=decode($_POST['agentId']); 

 
if($_FILES["companyLogo"]["tmp_name"]!=""){  
$rt=mt_rand().strtotime(date("YMDHis")); 
$companyLogoFileName=basename($_FILES['companyLogo']['name']); 
$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION);  
$companyLogo=time().$rt.'.'.$companyLogoFileExtension; 
move_uploaded_file($_FILES["companyLogo"]["tmp_name"], "upload/{$companyLogo}"); 
}
 
 
 
$namevalue ='companyLogo="'.$companyLogo.'"';  
$where='id="'.$agentId.'"';   
updatelisting('sys_userMaster',$namevalue,$where);  



}
?>
 