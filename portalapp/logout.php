<?php
include "inc.php";

$_SESSION['userId']='';
if (isset($_COOKIE['user'])) {
    unset($_COOKIE['user']); 
    setcookie('user', '', -1, '/'); 
 
}  

?>