<?php 
if($_SESSION['agentUserid']=="" || $_SESSION['agentUsername']=="" || $LoginUserDetails['userType']!='agent'){ 
header("Location:".$fullurl."login");
exit(); }  
?>