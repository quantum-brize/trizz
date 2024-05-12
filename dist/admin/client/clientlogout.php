<?php 
include "clientinc.php";  
error_reporting(0);    
unset($_SESSION['sessionid']); 
unset($_SESSION['clientname']); 
unset($_SESSION['clientid']);
session_destroy(); 
header('Location: login.html'); 
exit;  
?>