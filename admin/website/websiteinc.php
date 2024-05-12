<?php
ob_start();
include "config/database.php"; 
include "config/function.php";  

$fullurl="https://travbizz.in/crm/b2cv2/website/";
$contenturl="https://travbizz.in/crm/b2cv2/";
 
 
$rs=GetPageRecord('*','websiteSetting','id=1'); 
$WebsiteSettingDetails=mysqli_fetch_array($rs); 


function seo_friendly_url($string){
    $string = str_replace(array('[\', \']'), '', $string);
    $string = preg_replace('/\[.*\]/U', '', $string);
    $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
    $string = htmlentities($string, ENT_COMPAT, 'utf-8');
    $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string );
    $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '-', $string);
    return strtolower(trim($string, '-'));
}
?>

 