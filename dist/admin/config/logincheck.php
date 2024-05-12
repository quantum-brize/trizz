<?php 
if($_SESSION['username']=="" || $_SESSION['userid']==""){ 
header("Location:login.html");
exit(); }  
?>