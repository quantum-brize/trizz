<?php  
include "../config/database.php"; 
include "../config/function.php";  
include "../config/setting.php";  

 
 

if($_REQUEST['u']!='' && $_REQUEST['p']!=''){   
$username = clean($_REQUEST['u']); 
$password = clean($_REQUEST['p']); 
//$password = 'admin#3214'; 
$ftoken = ''; 

 

$ftoken = '';   
$loginreturn = login($username,$password,$ftoken);

 
if($loginreturn=='yes'){ 


   
 
$where='id="'.$_SESSION['userid'].'" and email="'.$_SESSION['username'].'"'; 
$rs=GetPageRecord('*','sys_userMaster',$where); 
$LoginUserDetails=mysqli_fetch_array($rs);


$cookie_name = "cookuserid";
$cookie_value = $LoginUserDetails['id'];
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");


$cookie_name2 = "cookusername";
$cookie_value2 = $LoginUserDetails['email'];
setcookie($cookie_name2, $cookie_value2, time() + (86400 * 30), "/");

$cookie_name3 = "cookpassword";
$cookie_value3 = $password;
setcookie($cookie_name3, $cookie_value3, time() + (86400 * 30), "/");

 
$_SESSION['password']=$password;

header("Location:index.php");
exit;


} else {  
header("Location:https://travbizz.in/crm_companies/applogin.php?invlogin=1");
exit;

}
}

//header("Location:https://travbizz.in/crm_companies/applogin.php?invlogin=1");
exit;
?>

 