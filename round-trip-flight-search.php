<?php 
include "inc.php"; 
include "config/logincheck.php";

 

if($_SESSION['uniqueId']==''){
	$_SESSION['uniqueId'] = uniqid();
}



$rs=GetPageRecord('*','sys_userMaster','id=1'); 
$getapistatus=mysqli_fetch_array($rs); 

$undercons=0;
 

$flightResultDisplayfile='flight_result_display_round_trip.php';
 


 
	
	if($_SESSION['isRoundTripInt']==1)
	{
		include "tbo-round-trip-Int.php"; 
		 $flightResultDisplayfile='flight_result_display_round_trip_int.php';	
	}
	else
	{
		include "tbo-round-trip.php"; 
		
	} 	
    $undercons=1;	


 
 		
?>


 