<?php  
 include "inc.php";    
$ADT = trim($_REQUEST['ADT']); 
$CHD = trim($_REQUEST['CHD']); 
$INF = trim($_REQUEST['INF']); 

 

$fromDestinationFlight = trim($_REQUEST['fromDestinationFlight']); 
$toDestinationFlight = trim($_REQUEST['toDestinationFlight']);
 

$fromdestexp = explode('-',$fromDestinationFlight); 
$todestexp = explode('-',$toDestinationFlight); 

 $psting = trim($_GET['psting']);

 



deleteRecord('wig_flight_json_bkp','agentId="'.$_SESSION['agentUserid'].'" and uniqueSessionId="'.$_SESSION['uniqueSessionId'].'"   ');

 



//deleteRecord('wig_flight_json_bkp',' uniqueSesId="'.$_SESSION['uniqueSesId'].'"  ');







 







if($_SESSION['uniqueId']==''){



	$_SESSION['uniqueId'] = uniqid();



}









$_SESSION['totalrexpaxAdult']=$ADT;



$_SESSION['totalrexpaxChild']=$CHD;



$_SESSION['totalrexpaxInfant']=$INF;







$rs=GetPageRecord('*','sys_userMaster','id=1');  

$getapistatus=mysqli_fetch_array($rs);  





$undercons=0;



















$ag=GetPageRecord('*','wig_flight_json_bkp',' agentId="'.$_SESSION['agentUserid'].'" and ORG_CODE="'.$fromdestexp[0].'" and DES_CODE="'.$todestexp[0].'" and DEP_DATE="'.date('Y-m-d',strtotime($_REQUEST['journeyDateOne'])).'"  '); 



$getapirecord=mysqli_fetch_array($ag);




 
 



echo $geturl = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";



$geturl = str_replace($fullurl,'',$geturl);



 $geturl = str_replace('one-way-flight-search.php','',$geturl);

$rs=GetPageRecord('*','sys_userMaster','id=1'); 
$getapistatus=mysqli_fetch_array($rs); 

?>

<iframe style="display:none;"  id="secframeload" name="secframeload" src="<?php  echo "fixed-FD-Search-API.php".$geturl; $undercons=1;  ?>"></iframe>

<?php if($getapistatus['fixedAK']==1) { ?>
<iframe style="display:none;"  id="secframeload" name="secframeload" src="<?php echo "fixed-AK-Search-API.php".$geturl; $undercons=1;  ?>"></iframe>  
<?php } ?> 

<?php  if($getapistatus['tboAPIOneWay']==1) { ?>
<iframe style="display:none;"  id="secframeload" name="secframeload" src="<?php  echo "tbo-one-way.php".$geturl; $undercons=1;  ?>"></iframe>
<?php } ?>

 <?php  if($getapistatus['fixedGF']==1) { ?>
 <iframe style="display:none;"  id="secframeload" name="secframeload" src="<?php echo "tripjack-one-way.php?".$geturl.'&sessionuser='.$_SESSION['agentUserid'].''; $undercons=1;  ?>"></iframe>
<?php } ?>
 








<?php







 



//if($getapistatus['fixedAK']==1){ include "fixed-AK-Search-API.php";  $undercons=1; }



//if($getapistatus['fixedGF']==1){ include "fixed-GF-Search-API.php";  $undercons=1; }



//include "fixed-MF-Search-API.php";  $undercons=1;











 



$undercons=1; 



		



		



$_SESSION['ORG_CODE']=$fromdestexp[0];



$_SESSION['DES_CODE']=$todestexp[0];



?>







 