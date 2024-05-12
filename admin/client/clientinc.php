<?php
include "../inc.php"; 
$fullurl=''.$fullurl.'client/';
$proposalurl=''.$fullurl.'';
$softwareurl=''.$fullurl.'';
$packageurl=''.$fullurl.'';


$aaaa=GetPageRecord('*','sys_userMaster',' id=1'); 
$companydetails=mysqli_fetch_array($aaaa);
?>