<?php
include "inc.php";

if($_REQUEST['c']!=''){

$ab=GetPageRecord('*','campaignMaster','id="'.trim($_REQUEST['c']).'" order by id desc');  
$resultCampaign=mysqli_fetch_array($ab);
$views=$resultCampaign['clicks']+1;


$namevalue ='clicks="'.$views.'"';
$where='id="'.trim($_REQUEST['c']).'"';   
updatelisting('campaignMaster',$namevalue,$where); 

}


 
?>