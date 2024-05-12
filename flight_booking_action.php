<?php 
include "inc.php"; 
include "config/logincheck.php"; 


$randbookingid='OFF-'.rand(11111111,99999999);
$bookingMethod=trim($_REQUEST["bookingMethod"]);

unset($_SESSION["bookingData"]);

if($bookingMethod==0){
	
$uniqueSessionId=base64_encode(time());
$basefareret=0; 

$ab=GetPageRecord('*','wig_flight_json_bkp',' id="'.decode(decode($_REQUEST['flighttwo'])).'" and agentId="'.$_SESSION['agentUserid'].'"');
$resret=mysqli_fetch_array($ab);

$retrunflightoffline=offlineflight($_SESSION['agentUserid'],$resret['FLIGHT_NAME'],$resret['PCC']);
$totalAmountToPay=$_REQUEST['totalAmountToPay'];

if($resret['id']!=''){

$str_arr = explode (",", $resret['agfare']);   
$basefareret = explode ("=", $str_arr[2]); 
$basefareret = $basefareret[1];
 
 }



$a=GetPageRecord('*','wig_flight_json_bkp',' id="'.decode(decode($_REQUEST['flightone'])).'" and agentId="'.$_SESSION['agentUserid'].'"');
$res=mysqli_fetch_array($a);


$onewayflightoffline=offlineflight($_SESSION['agentUserid'],$res['FLIGHT_NAME'],$res['PCC']);
 

$str_arr = explode (",", $res['agfare']);   
$basefare = explode ("=", $str_arr[2]); 



$discountPrice=0;
$cashbackPrice=0;

if($res['discountType']==1 && $res["couponType"]==1){
$discountPrice=$res['discount'];
}
if($res['discountType']==2 && $res["couponType"]==1){
$discountPrice=trim(($res['discount']*($basefare[1]+$basefareret))/100);
}

if($res['discountType']==1 && $res["couponType"]==2){
$cashbackPrice=$res['discount'];
}
if($res['discountType']==2 && $res["couponType"]==2){
$cashbackPrice=trim(($res['discount']*($basefare[1]+$basefareret))/100);
}

$totalPayableAmount=($basefare[1]+$basefareret)-$discountPrice;



if($_POST['flightone']!='' && $res['id']>0 && $res['id']!="" && $_POST['flightbooking']==1 && $totalwalletBalance>=$totalPayableAmount){
	
if($totalPayableAmount<900){
	exit();
}	
	
$bookingpro=1;
   
   
 
   
  foreach((array) unserialize(stripslashes($res['PARAM_DATA'])) as $layoverFlight){
  
 $adultmain=$layoverFlight->adt;
 $childmain=$layoverFlight->chd;
 $infantmain=$layoverFlight->inf;
  }
  
  



$rs=GetPageRecord('*','sys_userMaster','id="'.$_SESSION['agentUserid'].'" '); 
$AgentWebsiteData=mysqli_fetch_array($rs);  


$bl=GetPageRecord('*','taxMaster','id=1 '); 
$taxData=mysqli_fetch_array($bl);

$source=$res['ORG_NAME'].'-'.$res['ORG_CODE'];
$destination=$res['DES_NAME'].'-'.$res['DES_CODE'];
$journeyDate=$res['DEP_DATE'];
$sector=$res['sector'];
$bookingDate=date('Y-m-d H:i:s');
$agentId=$_SESSION['agentUserid'];
$PCC=$res['FARE_TYPE'];
$flightName=$res['FLIGHT_NAME'];
$flightNo=$res['FLIGHT_NO'];
$arrivalTime=$res['ARRV_TIME'];
$arrivalDate=$res['ARRV_DATE'];
$departureTime=$res['DEP_TIME'];
$clientBaseFare=$res['DEP_TIME'];
$markup = '0';
$agentMarkup = '0';
$bookingType = '0'; 
if($res['F_CLASS']=='EC'){ $flightClass='Economy'; } else { $flightClass='Business'; } 
$arr=explode("|",unserialize(stripslashes($res['searchJson']))->FLIGHT_INFO);
$totalBaggage=str_replace(':',': ',str_replace(',',', ',str_replace('=',': ',$arr[2])));
$flightStop=$res['STOP'];
$agentCommision=$res['acom'];


	$clientFareOW = json_decode(taxBreakupFunc($res['clfare']));
	$bareFare = $clientFareOW->bareFare;
	$tax = $clientFareOW->tax;
	$totalFare = $clientFareOW->totalFare;
	
	//Price of admin fare onward flight
	$adminFareOW = json_decode(taxBreakupFunc($res['adfare']));
	$adminBaseFareOW = $adminFareOW->bareFare;
	$adminTaxOW = $adminFareOW->tax;
	$adminTotalOW = $adminFareOW->totalFare;
	
	//Price of agent fare onward flight
	$agentFareOW = json_decode(taxBreakupFunc($res['agfare']));
	$agentBaseFareOW = $agentFareOW->bareFare;
	$agentTaxOW = $agentFareOW->tax;
	$agentTotalOW = $agentFareOW->totalFare;
	
	
		if($taxData['applicableType']=='commission'){
		$agentFinalGST=(($_REQUEST['acom']*$taxData['valuePerc'])/100);
	}
	
	if($taxData['applicableType']=='totalfare'){
		$agentFinalGST=(($adminBaseFareOW*$taxData['valuePerc'])/100);
	}

  
//-------------------Booking Entry-------------------------  


$finalAgentTax=$res['agentMarkup'];



$finalFlightname=$flightName;
$finalFareTypename=$PCC;

  
$namevalue ='uniqueSessionId="'.$uniqueSessionId.'",source="'.$source.'",status=1,destination="'.$destination.'",journeyDate="'.$journeyDate.'",tripType="1",sector="'.$sector.'",bookingDate="'.$bookingDate.'",agentId="'.$agentId.'",bookingNumber="",pcc="'.$PCC.'",flightName="'.$flightName.'",flightNo="'.$flightNo.'",arrivalTime="'.$arrivalTime.'",arrivalDate="'.$arrivalDate.'",departureTime="'.$departureTime.'",clientBaseFare="'.$bareFare.'",clientTax="'.$tax.'",clientTotalFare="'.$totalFare.'",baseFare="'.$adminBaseFareOW.'",tax="'.$adminTaxOW.'",totalFare="'.$adminTotalOW.'",agentBaseFare="'.$agentBaseFareOW.'",agentTax="'.$agentTaxOW.'",agentTotalFare="'.$totalAmountToPay.'",markup="'.$markup.'",agentMarkup="'.$agentMarkup.'",bookingType="'.$bookingType.'",flightClass="'.$flightClass.'",totalBaggage="'.$totalBaggage.'",flightStop="'.$flightStop.'",agentCommision="'.$agentCommision.'",taxApplicableType="'.$taxData['applicableType'].'",taxValuePerc="'.$taxData['valuePerc'].'",taxApplicableOn="'.$taxData['applicableOn'].'",agentFinalGST="'.$agentFinalGST.'",detailArray="'.addslashes($res['searchJson']).'",couponCode="'.$res['couponCode'].'",discountType="'.$res['discountType'].'",couponValue="'.$res['couponValue'].'",couponType="'.$res['couponType'].'",searchArrey="'.addslashes($res['CON_DETAILS']).'"';  
$bookinglastId = addlistinggetlastid('flightBookingMaster',$namevalue); 
  
if($res["couponType"]==2){
$a11 ='agentId="'.$_SESSION['agentUserid'].'",amount="'.$cashbackPrice.'",remarks="Cashback offer",paymentMethod="Online",transactionId="'.encode($bookinglastId).'", paymentType="Credit",bookingId="'.encode($bookinglastId).'",bookingType="Flight",addedBy="'.$_SESSION['agentUserid'].'",addDate="'.date('Y-m-d H:i:s').'"';
addlistinggetlastid('sys_balanceSheet',$a11);
}
    
//-------------------Booking Entry End-------------------------  
  
  
  
 
for ($adult = 0; $adult <= $adultmain; $adult++){  
$guestname=addslashes($_POST['firstNameAdt'.$adult]);
}


$guestname = trim($guestname);
$email = trim($_POST['email']);
$phone = trim($_POST['phone']);
$companyName = trim($_POST['companyName']);
$gstNo = trim($_POST['gstNo']);
$gstEmail = trim($_POST['gstEmail']);
$address = addslashes($_POST['address']);

if($guestname!='' && $email!=''){
$rs5=GetPageRecord('*','clientMaster',' email="'.$email.'"'); 
$count=mysqli_num_rows($rs5);
$editresult=mysqli_fetch_array($rs5);
if($count>0){
$clientId = $editresult['id'];
}else{
$namevalue ='clientType="1",name="'.$guestname.'",email="'.$email.'",phone="'.$phone.'",address="'.$address.'",addDate="'.date('Y-m-d h:i:s').'"';  
$clientId = addlistinggetlastid('clientMaster',$namevalue);  
}
}	





//-------------Adult-----------------
 
for ($adult = 0; $adult <= $adultmain; $adult++) { 
 
 if($_REQUEST['adtPassEx'.$adult]==''){
 $adtPassEx='1970-01-01';
 } else {
 $adtPassEx=date('Y-m-d',strtotime($_REQUEST['adtPassEx'.$adult]));
 }
 
 
 $namevalue ='BookingId="'.$bookinglastId.'",bookingNumber="'.$bookinglastId.'",title="'.trim($_POST['titleAdt'.$adult]).'",firstName="'.trim($_POST['firstNameAdt'.$adult]).'",lastName="'.trim($_POST['lastNameAdt'.$adult]).'",dob="'.date('Y-m-d',strtotime($_POST['dobAdt'.$adult])).'",nationality="'.trim($_POST['nationalityAdt'.$adult]).'",passportNumber="'.trim($_POST['passportNumberAdt'.$adult]).'",passportExpiry="'.$adtPassEx.'",mobile="'.$phone.'",email="'.$email.'",addDate="'.date('Y-m-d h:i:s').'",paxType="adult"';
addlistinggetlastid('flightBookingPaxDetailMaster',$namevalue); 


}


//-------------Child-----------------


for ($child = 0; $child <= $childmain; $child++) { 

 if($_REQUEST['adtPassEx'.$child]==''){
 $adtPassEx='1970-01-01';
 } else {
 $adtPassEx=date('Y-m-d',strtotime($_REQUEST['adtPassEx'.$child]));
 }


$namevalue ='BookingId="'.$bookinglastId.'",bookingNumber="'.$bookinglastId.'",title="'.trim($_POST['titleChd'.$child]).'",firstName="'.trim($_POST['firstNameChd'.$child]).'",lastName="'.trim($_POST['lastNameChd'.$child]).'",dob="'.date('Y-m-d',strtotime($_POST['dobChd'.$child])).'",nationality="'.trim($_POST['nationalityChd'.$child]).'",passportNumber="'.trim($_POST['passportNumberChd'.$child]).'",passportExpiry="'.$adtPassEx.'",mobile="'.$phone.'",email="'.$email.'",addDate="'.date('Y-m-d h:i:s').'",paxType="child"';
addlistinggetlastid('flightBookingPaxDetailMaster',$namevalue); 

 
}




//-------------Infant-----------------



for($infant = 0; $infant <= $infantmain; $infant++) { 


 if($_REQUEST['adtPassEx'.$infant]==''){
 $adtPassEx='1970-01-01';
 } else {
 $adtPassEx=date('Y-m-d',strtotime($_REQUEST['adtPassEx'.$infant]));
 }
 




$namevalue ='BookingId="'.$bookinglastId.'",bookingNumber="'.$bookinglastId.'",title="'.trim($_POST['titleInf'.$infant]).'",firstName="'.trim($_POST['firstNameInf'.$infant]).'",lastName="'.trim($_POST['lastNameInf'.$infant]).'",dob="'.date('Y-m-d',strtotime($_POST['dobInf'.$infant])).'",nationality="'.trim($_POST['nationalityInf'.$infant]).'",passportNumber="'.trim($_POST['passportNumberInf'.$infant]).'",passportExpiry="'.$adtPassEx.'",mobile="'.$phone.'",email="'.$email.'",addDate="'.date('Y-m-d h:i:s').'",paxType="infant"';
addlistinggetlastid('flightBookingPaxDetailMaster',$namevalue); 

}









$insuranceAmount=0;
   if($_REQUEST['addInsurance']==1){
   $insurance=addslashes(trim($_REQUEST['insurance']));
   $insuranceAmount=addslashes(trim($_REQUEST['insuranceAmount']));
   $insuranceDetails=addslashes(trim($_REQUEST['insuranceDetails']));
   }
   $donateAmount=0;
   if($_REQUEST['donate']==1){
	$donateDetails=addslashes(trim($_REQUEST['donateDetails']));
	$donateAmount=addslashes(trim($_REQUEST['donateAmount']));
	}
  
  $finalclientcost=($_REQUEST['finalclientcost']+$insuranceAmount+$donateAmount);
  

$bl=GetPageRecord('*','flightBookingMaster','id="'.$bookinglastId.'" '); 
$actCost=mysqli_fetch_array($bl);
  
$admarkup=($actCost['clientTotalFare']-$actCost['agentTotalFare']);
$agmarkup=($actCost['agentTotalFare']-$actCost['totalFare']);


$inv=GetPageRecord('*','flightBookingMaster',' 1 order by invoiceId desc'); 
$lastInv=mysqli_fetch_array($inv); 
$invoiceId=($lastInv['invoiceId']+1);

 
 
 
 
 
 
 
 
 
 
 
 	for($adult=1; $adult<=$adultmain; $adult++){
		if($_POST['passportExpiryAdt'.$adult]!=''){
			$adtPassEx = changedDateFormat($_POST['passportExpiryAdt'.$adult]);
		}else{ 
			$adtPassEx = '1970-01-01';
			$adtPassjson = '';
		}
		
		
		
		 $paxDetail.= '{
			"year":"",
			"ttl":"'.trim($_POST['titleAdt'.$adult]).'",
			"fn":"'.trim($_POST['firstNameAdt'.$adult]).'",
			"ln":"'.trim($_POST['lastNameAdt'.$adult]).'",
			"type":"adult",
			"mn":"",
			"dob":"'.changedDateFormat($_POST['dobAdt'.$adult]).'",
			"meal":"",
			"baggage":"",
			"refundable":"",
			"status":"",
			"apnr":"",
			"gpnr":"",
			"tktno":"",
			"fare":"",
			"ffn":"",
			"tc":"",
			"nat":"",
			"pi":"'.trim($_POST['nationalityAdt'.$adult]).'",
			"pn":"'.trim($_POST['passportNumberAdt'.$adult]).'",
			"ed":"'.$adtPassjson.'",
			"other_info":""
      },';
	  
	  
 
	}
	
	for($child=1; $child<=$childmain; $child++){
		if($_POST['passportExpiryChd'.$child]!=''){
			$chdPassEx = changedDateFormat($_POST['passportExpiryChd'.$child]);
		}else{ 
			$chdPassEx = '1970-01-01';
			$chdPassjson = '';
		}
		$paxDetail.= '{
			"year":"",
			"ttl":"'.trim($_POST['titleChd'.$child]).'",
			"fn":"'.trim($_POST['firstNameChd'.$child]).'",
			"ln":"'.trim($_POST['lastNameChd'.$child]).'",
			"type":"child",
			"mn":"",
			"dob":"'.changedDateFormat($_POST['dobChd'.$child]).'",
			"meal":"",
			"baggage":"",
			"refundable":"",
			"status":"",
			"apnr":"",
			"gpnr":"",
			"tktno":"",
			"fare":"",
			"ffn":"",
			"tc":"",
			"nat":"",
			"pi":"'.trim($_POST['nationalityChd'.$child]).'",
			"pn":"'.trim($_POST['passportNumberChd'.$child]).'",
			"ed":"'.$chdPassjson.'",
			"other_info":""
      },'; 
	   
		
	}
	
	
	  
	for($infant=1; $infant<=$infantmain; $infant++){
		if($_POST['passportExpiryInf'.$infant]!=''){
			$infPassEx = changedDateFormat($_POST['passportExpiryInf'.$infant]);
		}else{ 
			$infPassEx = '1970-01-01';
			$infPassjson = '';
		}
		 $paxDetail.= '{
			"year":"",
			"ttl":"'.trim($_POST['titleInf'.$infant]).'",
			"fn":"'.trim($_POST['firstNameInf'.$infant]).'",
			"ln":"'.trim($_POST['lastNameInf'.$infant]).'",
			"type":"infant",
			"mn":"",
			"dob":"'.changedDateFormat($_POST['dobInf'.$infant]).'",
			"meal":"",
			"baggage":"",
			"refundable":"",
			"status":"",
			"apnr":"",
			"gpnr":"",
			"tktno":"",
			"fare":"",
			"ffn":"",
			"tc":"",
			"nat":"",
			"pi":"'.trim($_POST['nationalityInf'.$infant]).'",
			"pn":"'.trim($_POST['passportNumberInf'.$infant]).'",
			"ed":"'.$infPassjson.'",
			"other_info":""
      },'; 
	  
	  
	}
 
 
 
 
 //----------------------Booking Prosess-------------------------
 
 
    
 $data = unserialize(stripslashes($res['flightCheckData']));
  
 
 
 //logger('INSIDE bookinglastIdRet NULL CONDITION');
// echo "<pre>";
	  $jsonPost = '{
				   "STATUS":'.json_encode($data->STATUS,JSON_PRETTY_PRINT).',
				   "FLIGHT":'.json_encode($data->FLIGHT,JSON_PRETTY_PRINT).',
				   "CON_FLIGHT":'.json_encode($data->CON_FLIGHT,JSON_PRETTY_PRINT).',
				   "FARE":'.json_encode($data->FARE,JSON_PRETTY_PRINT).',
				   "PARAM":'.json_encode($data->PARAM,JSON_PRETTY_PRINT).',
				   "Deal":'.json_encode($data->Deal,JSON_PRETTY_PRINT).',
				   "FARE_RULE":'.json_encode($data->FARE_RULE,JSON_PRETTY_PRINT).',
				   "PAX":['.rtrim($paxDetail,',').'],
				   "TYPE":"DC",
				   "NAME":"PNR_CREATION",
				   "Others":[
					  {
						 "REMARK":"'.$A_ID.'",
						 "CUSTOMER_EMAIL":"'.trim($_POST['email']).'",
						 "CUSTOMER_MOBILE":"'.trim($_POST['phone']).'"
					  }
				   ]
				}';
 
 
 
 if($onewayflightoffline==0){
 
 $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$PnrCreateUrl);
	curl_setopt($ch, CURLINFO_HEADER_OUT, true);
	curl_setopt($ch, CURLOPT_POST,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonPost);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	$response = curl_exec($ch); 
	curl_close($ch);
	
	$bookingdata = json_decode($response);	
	//logger('JSON response returnfrom PNR BOOKING(PNR_CREATION): '.$response);
	$bookingNumber=1;
		$bookingNumber = $bookingdata->RESULT{0}->BOOKINGID;
		
		} else {
		$bookingNumber=$randbookingid;
		}
		
		if($bookingNumber==''){
		$bookingNumber=$randbookingid;
		}
	
		
		if(trim($bookingNumber)==''){	?>
		<script>
alert('Something Went Wrong. Please Try Again.');
window.parent.location.href = "<?php echo $fullurl; ?>"; 
</script>
		
		<?php exit(); }
		
	if(trim($bookingNumber)!=''){	
			
			if($bookingNumber==1){
			$bookingNumber='';
			}
			
			
				if(trim($bookingNumber)!=''){	
					
					$companyName = trim($_POST['companyName']);
					
	 				$status = 1;
					
					$insuranceAmount=0;
					$donateAmount=0;
					if($_REQUEST['addInsurance']==1){
					$insurance=addslashes(trim($_REQUEST['insurance']));
					$insuranceAmount=addslashes(trim($_REQUEST['insuranceAmount']));
					$insuranceDetails=addslashes(trim($_REQUEST['insuranceDetails']));
					}
					if($_REQUEST['donate']==1){
					$donateDetails=addslashes(trim($_REQUEST['donateDetails']));
					$donateAmount=addslashes(trim($_REQUEST['donateAmount']));
					}
					
					$bl=GetPageRecord('*','flightBookingMaster','id="'.$bookinglastId.'" '); 
					$actCost=mysqli_fetch_array($bl);
					
					
					if(round($totalwalletBalance)>$actCost['clientTotalFare']){
					
					
					
					$admarkup=($actCost['clientTotalFare']-$actCost['agentTotalFare']);
					$agmarkup=($actCost['agentTotalFare']-$actCost['totalFare']);
					
					
					$inv=GetPageRecord('*','flightBookingMaster',' 1 order by invoiceId desc'); 
					$lastInv=mysqli_fetch_array($inv); 
					$invoiceId=($lastInv['invoiceId']+1);
					
					

					
					$namevalue ='bookingNumber="'.$bookingNumber.'",status="'.$status.'",clientId="'.$clientId.'",companyName="'.$companyName.'",gstNo="'.$gstNo.'",gstEmail="'.$gstEmail.'",insurance="'.$insurance.'",insuranceAmount="'.$insuranceAmount.'",donateAmount="'.$donateAmount.'",donateDetails="'.$donateDetails.'",invoiceId="'.$invoiceId.'",markup="'.$admarkup.'",agentMarkup="'.$agmarkup.'",insuranceDetails="'.$insuranceDetails.'",agentOffline="'.offlineflightifagentoffline($_SESSION['agentUserid'],$finalFlightname,$finalFareTypename).'"'; 
					
					$where='id="'.$bookinglastId.'" and tripType="1"';
					updatelisting('flightBookingMaster',$namevalue,$where); 
					updatelisting('flightBookingPaxDetailMaster','bookingNumber="'.$bookingNumber.'"','BookingId="'.$bookinglastId.'"'); 
		
		
$finalclientcost=($_REQUEST['finalclientcost']+$insuranceAmount+$donateAmount);	


$balnceSheetAmt=($admarkup+$donateAmount+$insuranceAmount+$actCost['agentTotalFare'])-($actCost['agentTotalFare']-$actCost['totalFare']);

$a ='bookingId="'.$bookinglastId.'",bookingType="flight",agentId="'.$AgentWebsiteData['id'].'",amount="'.$totalAmountToPay.'",paymentType="Debit",addedBy="'.$AgentWebsiteData['id'].'",addDate="'.date('Y-m-d H:i:s').'"';
addlistinggetlastid('sys_balanceSheet',$a); 
 
			
			
			
			
			
			
			
			
			if(offlineflightifagentoffline($_SESSION['agentUserid'],$finalFlightname,$finalFareTypename)==0){
		
  
   
  
  	//-----------Markup to masteradmin--------------
		
		
		 $a ='bookingId="'.($bookinglastId).'",bookingType="Markup",agentId="'.$AgentWebsiteData['parentId'].'",amount="'.round($finalAgentTax).'",paymentType="Credit",addedBy="'.$AgentWebsiteData['id'].'",addDate="'.date('Y-m-d H:i:s').'"';
		addlistinggetlastid('sys_balanceSheet',$a);
		
		


} else {





$a ='bookingId="'.$bookinglastId.'",bookingType="Facilitating",agentId="'.$AgentWebsiteData['parentId'].'",amount="10",paymentType="Debit",addedBy="'.$AgentWebsiteData['id'].'",addDate="'.date('Y-m-d H:i:s').'"';
addlistinggetlastid('sys_balanceSheet',$a); 


$a ='bookingId="'.$bookinglastId.'",bookingType="Facilitating_GST",agentId="'.$AgentWebsiteData['parentId'].'",amount="1.80",paymentType="Debit",addedBy="'.$AgentWebsiteData['id'].'",addDate="'.date('Y-m-d H:i:s').'"';
addlistinggetlastid('sys_balanceSheet',$a); 

}
			
			
			
			
			
 

} 

				}
				
			
			 
		
			
	
	 
			
			}
		
		
		
		 
		
		
		
		
}






//----------------------Return Flight----------------------


$discountPrice=0;
$cashbackPrice=0;

if($resret['discountType']==1 && $resret["couponType"]==1){
$discountPrice=$resret['discount'];
}

if($resret['discountType']==2 && $resret["couponType"]==1){
$discountPrice=trim(($resret['discount']*($basefare[1]+$basefareret))/100);
}

if($resret['discountType']==1 && $resret["couponType"]==2){
$cashbackPrice=$resret['discount'];
}

if($resret['discountType']==2 && $resret["couponType"]==2){
$cashbackPrice=trim(($resret['discount']*($basefare[1]+$basefareret))/100);
}

$totalPayableAmount=($basefare[1]+$basefareret)-$discountPrice;





if($_POST['flighttwo']!='' && $resret['id']>0 && $resret['id']!="" && $_POST['flightbooking']==1 && $totalwalletBalance>=$totalPayableAmount){
	
if($totalPayableAmount<900){
	exit();
}	
	
$bookingpro=1; 

$ab=GetPageRecord('*','wig_flight_json_bkp',' id="'.decode(decode($_REQUEST['flighttwo'])).'" and agentId="'.$_SESSION['agentUserid'].'"');
$res=mysqli_fetch_array($ab);

   
  foreach((array) unserialize(stripslashes($res['PARAM_DATA'])) as $layoverFlight){
  
 $adultmain=$layoverFlight->adt;
 $childmain=$layoverFlight->chd;
 $infantmain=$layoverFlight->inf;
  }
  
   


$rs=GetPageRecord('*','sys_userMaster','id="'.$_SESSION['agentUserid'].'" '); 
$AgentWebsiteData=mysqli_fetch_array($rs);  


$bl=GetPageRecord('*','taxMaster','id=1 '); 
$taxData=mysqli_fetch_array($bl);

$source=$res['ORG_NAME'].'-'.$res['ORG_CODE'];
$destination=$res['DES_NAME'].'-'.$res['DES_CODE'];
$journeyDate=$res['DEP_DATE'];
$sector=$res['sector'];
$bookingDate=date('Y-m-d H:i:s');
$agentId=$_SESSION['agentUserid'];
$PCC=$res['FARE_TYPE'];
$flightName=$res['FLIGHT_NAME'];
$flightNo=$res['FLIGHT_NO'];
$arrivalTime=$res['ARRV_TIME'];
$arrivalDate=$res['ARRV_DATE'];
$departureTime=$res['DEP_TIME'];
$clientBaseFare=$res['DEP_TIME'];
$markup = '0';
$agentMarkup = '0';
$bookingType = '0'; 
if($res['F_CLASS']=='EC'){ $flightClass='Economy'; } else { $flightClass='Business'; } 
$arr=explode("|",unserialize(stripslashes($res['searchJson']))->FLIGHT_INFO);
$totalBaggage=str_replace(':',': ',str_replace(',',', ',str_replace('=',': ',$arr[2])));
$flightStop=$res['STOP'];
$agentCommision=$res['acom'];


	$clientFareOW = json_decode(taxBreakupFunc($res['clfare']));
	$bareFare = $clientFareOW->bareFare;
	$tax = $clientFareOW->tax;
	$totalFare = $clientFareOW->totalFare;
	
	//Price of admin fare onward flight
	$adminFareOW = json_decode(taxBreakupFunc($res['adfare']));
	$adminBaseFareOW = $adminFareOW->bareFare;
	$adminTaxOW = $adminFareOW->tax;
	$adminTotalOW = $adminFareOW->totalFare;
	
	//Price of agent fare onward flight
	$agentFareOW = json_decode(taxBreakupFunc($res['agfare']));
	$agentBaseFareOW = $agentFareOW->bareFare;
	$agentTaxOW = $agentFareOW->tax;
	$agentTotalOW = $agentFareOW->totalFare;
	
	
		if($taxData['applicableType']=='commission'){
		$agentFinalGST=(($_REQUEST['acom']*$taxData['valuePerc'])/100);
	}
	
	if($taxData['applicableType']=='totalfare'){
		$agentFinalGST=(($adminBaseFareOW*$taxData['valuePerc'])/100);
	}

  
//-------------------Booking Entry-------------------------  
  
$namevalue ='uniqueSessionId="'.$uniqueSessionId.'",source="'.$source.'",status=0,destination="'.$destination.'",journeyDate="'.$journeyDate.'",tripType="1",sector="'.$sector.'",bookingDate="'.$bookingDate.'",agentId="'.$agentId.'",bookingNumber="",pcc="'.$PCC.'",flightName="'.$flightName.'",flightNo="'.$flightNo.'",arrivalTime="'.$arrivalTime.'",arrivalDate="'.$arrivalDate.'",departureTime="'.$departureTime.'",clientBaseFare="'.$bareFare.'",clientTax="'.$tax.'",clientTotalFare="'.$totalFare.'",baseFare="'.$adminBaseFareOW.'",tax="'.$adminTaxOW.'",totalFare="'.$adminTotalOW.'",agentBaseFare="'.$agentBaseFareOW.'",agentTax="'.$agentTaxOW.'",agentTotalFare="'.$agentTotalOW.'",markup="'.$markup.'",agentMarkup="'.$agentMarkup.'",bookingType="'.$bookingType.'",flightClass="'.$flightClass.'",totalBaggage="'.$totalBaggage.'",flightStop="'.$flightStop.'",agentCommision="'.$agentCommision.'",taxApplicableType="'.$taxData['applicableType'].'",taxValuePerc="'.$taxData['valuePerc'].'",taxApplicableOn="'.$taxData['applicableOn'].'",agentFinalGST="'.$agentFinalGST.'",detailArray="'.addslashes($res['searchJson']).'",couponCode="'.$resret['couponCode'].'",discountType="'.$resret['discountType'].'",couponValue="'.$resret['couponValue'].'",couponType="'.$resret['couponType'].'"';  
$bookinglastId2 = addlistinggetlastid('flightBookingMaster',$namevalue); 
  
$bookinglastIdret=$bookinglastId2;

if($resret["couponType"]==2){
$a11 ='agentId="'.$_SESSION['agentUserid'].'",amount="'.$cashbackPrice.'",remarks="Cashback offer",paymentMethod="Online",transactionId="'.encode($bookinglastId2).'", paymentType="Credit",bookingId="'.encode($bookinglastId2).'",bookingType="Flight",addedBy="'.$_SESSION['agentUserid'].'",addDate="'.date('Y-m-d H:i:s').'"';
addlistinggetlastid('sys_balanceSheet',$a11);
}

    
//-------------------Booking Entry End-------------------------  
  
  
  
 
for ($adult = 0; $adult <= $adultmain; $adult++){  
$guestname=addslashes($_POST['firstNameAdt'.$adult]);
}


$guestname = trim($guestname);
$email = trim($_POST['email']);
$phone = trim($_POST['phone']);
$companyName = trim($_POST['companyName']);
$gstNo = trim($_POST['gstNo']);
$gstEmail = trim($_POST['gstEmail']);
$address = addslashes($_POST['address']);

if($guestname!='' && $email!=''){
$rs5=GetPageRecord('*','clientMaster',' email="'.$email.'"'); 
$count=mysqli_num_rows($rs5);
$editresult=mysqli_fetch_array($rs5);
if($count>0){
$clientId = $editresult['id'];
}else{
$namevalue ='clientType="1",name="'.$guestname.'",email="'.$email.'",phone="'.$phone.'",address="'.$address.'",addDate="'.date('Y-m-d h:i:s').'"';  
$clientId = addlistinggetlastid('clientMaster',$namevalue);  
}
}	





//-------------Adult-----------------
 
for ($adult = 0; $adult <= $adultmain; $adult++) { 
 
 if($_REQUEST['adtPassEx'.$adult]==''){
 $adtPassEx='1970-01-01';
 } else {
 $adtPassEx=date('Y-m-d',strtotime($_REQUEST['adtPassEx'.$adult]));
 }
 
 
 $namevalue ='BookingId="'.$bookinglastId2.'",bookingNumber="'.$bookinglastId2.'",title="'.trim($_POST['titleAdt'.$adult]).'",firstName="'.trim($_POST['firstNameAdt'.$adult]).'",lastName="'.trim($_POST['lastNameAdt'.$adult]).'",dob="'.date('Y-m-d',strtotime($_POST['dobAdt'.$adult])).'",nationality="'.trim($_POST['nationalityAdt'.$adult]).'",passportNumber="'.trim($_POST['passportNumberAdt'.$adult]).'",passportExpiry="'.$adtPassEx.'",mobile="'.$phone.'",email="'.$email.'",addDate="'.date('Y-m-d h:i:s').'",paxType="adult"';
addlistinggetlastid('flightBookingPaxDetailMaster',$namevalue); 


}


//-------------Child-----------------


for ($child = 0; $child <= $childmain; $child++) { 

 if($_REQUEST['adtPassEx'.$child]==''){
 $adtPassEx='1970-01-01';
 } else {
 $adtPassEx=date('Y-m-d',strtotime($_REQUEST['adtPassEx'.$child]));
 }


$namevalue ='BookingId="'.$bookinglastId2.'",bookingNumber="'.$bookinglastId2.'",title="'.trim($_POST['titleChd'.$child]).'",firstName="'.trim($_POST['firstNameChd'.$child]).'",lastName="'.trim($_POST['lastNameChd'.$child]).'",dob="'.date('Y-m-d',strtotime($_POST['dobChd'.$child])).'",nationality="'.trim($_POST['nationalityChd'.$child]).'",passportNumber="'.trim($_POST['passportNumberChd'.$child]).'",passportExpiry="'.$adtPassEx.'",mobile="'.$phone.'",email="'.$email.'",addDate="'.date('Y-m-d h:i:s').'",paxType="child"';
addlistinggetlastid('flightBookingPaxDetailMaster',$namevalue); 

 
}




//-------------Infant-----------------



for($infant = 0; $infant <= $infantmain; $infant++) { 


 if($_REQUEST['adtPassEx'.$infant]==''){
 $adtPassEx='1970-01-01';
 } else {
 $adtPassEx=date('Y-m-d',strtotime($_REQUEST['adtPassEx'.$infant]));
 }
 




$namevalue ='BookingId="'.$bookinglastId2.'",bookingNumber="'.$bookinglastId2.'",title="'.trim($_POST['titleInf'.$infant]).'",firstName="'.trim($_POST['firstNameInf'.$infant]).'",lastName="'.trim($_POST['lastNameInf'.$infant]).'",dob="'.date('Y-m-d',strtotime($_POST['dobInf'.$infant])).'",nationality="'.trim($_POST['nationalityInf'.$infant]).'",passportNumber="'.trim($_POST['passportNumberInf'.$infant]).'",passportExpiry="'.$adtPassEx.'",mobile="'.$phone.'",email="'.$email.'",addDate="'.date('Y-m-d h:i:s').'",paxType="infant"';
addlistinggetlastid('flightBookingPaxDetailMaster',$namevalue); 

}









$insuranceAmount=0;
   if($_REQUEST['addInsurance']==1){
   $insurance=addslashes(trim($_REQUEST['insurance']));
   $insuranceAmount=addslashes(trim($_REQUEST['insuranceAmount']));
   $insuranceDetails=addslashes(trim($_REQUEST['insuranceDetails']));
   }
   $donateAmount=0;
   if($_REQUEST['donate']==1){
	$donateDetails=addslashes(trim($_REQUEST['donateDetails']));
	$donateAmount=addslashes(trim($_REQUEST['donateAmount']));
	}
  
  $finalclientcost=($_REQUEST['finalclientcost']+$insuranceAmount+$donateAmount);
  

$bl=GetPageRecord('*','flightBookingMaster','id="'.$bookinglastId2.'" '); 
$actCost=mysqli_fetch_array($bl);
  
$admarkup=($actCost['clientTotalFare']-$actCost['agentTotalFare']);
$agmarkup=($actCost['agentTotalFare']-$actCost['totalFare']);


$inv=GetPageRecord('*','flightBookingMaster',' 1 order by invoiceId desc'); 
$lastInv=mysqli_fetch_array($inv); 
$invoiceId=($lastInv['invoiceId']+1);

 
 
 
 
 
 
 
 
 
 
 
 	for($adult=1; $adult<=$adultmain; $adult++){
		if($_POST['passportExpiryAdt'.$adult]!=''){
			$adtPassEx = changedDateFormat($_POST['passportExpiryAdt'.$adult]);
		}else{ 
			$adtPassEx = '1970-01-01';
			$adtPassjson = '';
		}
		
		
		
		 $paxDetail.= '{
			"year":"",
			"ttl":"'.trim($_POST['titleAdt'.$adult]).'",
			"fn":"'.trim($_POST['firstNameAdt'.$adult]).'",
			"ln":"'.trim($_POST['lastNameAdt'.$adult]).'",
			"type":"adult",
			"mn":"",
			"dob":"'.changedDateFormat($_POST['dobAdt'.$adult]).'",
			"meal":"",
			"baggage":"",
			"refundable":"",
			"status":"",
			"apnr":"",
			"gpnr":"",
			"tktno":"",
			"fare":"",
			"ffn":"",
			"tc":"",
			"nat":"",
			"pi":"'.trim($_POST['nationalityAdt'.$adult]).'",
			"pn":"'.trim($_POST['passportNumberAdt'.$adult]).'",
			"ed":"'.$adtPassjson.'",
			"other_info":""
      },';
	  
	  
 
	}
	
	for($child=1; $child<=$childmain; $child++){
		if($_POST['passportExpiryChd'.$child]!=''){
			$chdPassEx = changedDateFormat($_POST['passportExpiryChd'.$child]);
		}else{ 
			$chdPassEx = '1970-01-01';
			$chdPassjson = '';
		}
		$paxDetail.= '{
			"year":"",
			"ttl":"'.trim($_POST['titleChd'.$child]).'",
			"fn":"'.trim($_POST['firstNameChd'.$child]).'",
			"ln":"'.trim($_POST['lastNameChd'.$child]).'",
			"type":"child",
			"mn":"",
			"dob":"'.changedDateFormat($_POST['dobChd'.$child]).'",
			"meal":"",
			"baggage":"",
			"refundable":"",
			"status":"",
			"apnr":"",
			"gpnr":"",
			"tktno":"",
			"fare":"",
			"ffn":"",
			"tc":"",
			"nat":"",
			"pi":"'.trim($_POST['nationalityChd'.$child]).'",
			"pn":"'.trim($_POST['passportNumberChd'.$child]).'",
			"ed":"'.$chdPassjson.'",
			"other_info":""
      },'; 
	   
		
	}
	
	
	  
	for($infant=1; $infant<=$infantmain; $infant++){
		if($_POST['passportExpiryInf'.$infant]!=''){
			$infPassEx = changedDateFormat($_POST['passportExpiryInf'.$infant]);
		}else{ 
			$infPassEx = '1970-01-01';
			$infPassjson = '';
		}
		 $paxDetail.= '{
			"year":"",
			"ttl":"'.trim($_POST['titleInf'.$infant]).'",
			"fn":"'.trim($_POST['firstNameInf'.$infant]).'",
			"ln":"'.trim($_POST['lastNameInf'.$infant]).'",
			"type":"infant",
			"mn":"",
			"dob":"'.changedDateFormat($_POST['dobInf'.$infant]).'",
			"meal":"",
			"baggage":"",
			"refundable":"",
			"status":"",
			"apnr":"",
			"gpnr":"",
			"tktno":"",
			"fare":"",
			"ffn":"",
			"tc":"",
			"nat":"",
			"pi":"'.trim($_POST['nationalityInf'.$infant]).'",
			"pn":"'.trim($_POST['passportNumberInf'.$infant]).'",
			"ed":"'.$infPassjson.'",
			"other_info":""
      },'; 
	  
	  
	}
 
 
 
 
 //----------------------Booking Prosess-------------------------
 
 
    
 $data = unserialize(stripslashes($res['flightCheckData']));
  
 
 
 //logger('INSIDE bookinglastIdRet NULL CONDITION');
// echo "<pre>";
	  $jsonPost = '{
				   "STATUS":'.json_encode($data->STATUS,JSON_PRETTY_PRINT).',
				   "FLIGHT":'.json_encode($data->FLIGHT,JSON_PRETTY_PRINT).',
				   "CON_FLIGHT":'.json_encode($data->CON_FLIGHT,JSON_PRETTY_PRINT).',
				   "FARE":'.json_encode($data->FARE,JSON_PRETTY_PRINT).',
				   "PARAM":'.json_encode($data->PARAM,JSON_PRETTY_PRINT).',
				   "Deal":'.json_encode($data->Deal,JSON_PRETTY_PRINT).',
				   "FARE_RULE":'.json_encode($data->FARE_RULE,JSON_PRETTY_PRINT).',
				   "PAX":['.rtrim($paxDetail,',').'],
				   "TYPE":"DC",
				   "NAME":"PNR_CREATION",
				   "Others":[
					  {
						 "REMARK":"'.$A_ID.'",
						 "CUSTOMER_EMAIL":"'.trim($_POST['email']).'",
						 "CUSTOMER_MOBILE":"'.trim($_POST['phone']).'"
					  }
				   ]
				}';
 
 
 $randbookingid='OFF-'.rand(11111111,99999999);
 
 if($retrunflightoffline==0){ 
 
 $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$PnrCreateUrl);
	curl_setopt($ch, CURLINFO_HEADER_OUT, true);
	curl_setopt($ch, CURLOPT_POST,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonPost);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	$response = curl_exec($ch); 
	curl_close($ch);
	
	$bookingdata = json_decode($response);	
	//logger('JSON response returnfrom PNR BOOKING(PNR_CREATION): '.$response);
	$bookingNumber=1;
		$bookingNumber = $bookingdata->RESULT{0}->BOOKINGID;
		
	
	
	} else {
		$bookingNumber=$randbookingid;
		}
		
		if($bookingNumber==''){
		$bookingNumber=$randbookingid;
		}
	
	
		
		if(trim($bookingNumber)==''){	?>
		<script>
alert('Something Went Wrong. Please Try Again.');
window.parent.location.href = "<?php echo $fullurl; ?>"; 
</script>
		
		<?php exit(); }
		
	if(trim($bookingNumber)!=''){	
			
			if($bookingNumber==1){
			$bookingNumber='';
			}
			
			
					if(trim($bookingNumber)!=''){	
					
					$companyName = trim($_POST['companyName']);
					
	 				$status = 1;
					
					$insuranceAmount=0;
					$donateAmount=0;
					if($_REQUEST['addInsurance']==1){
					$insurance=addslashes(trim($_REQUEST['insurance']));
					$insuranceAmount=addslashes(trim($_REQUEST['insuranceAmount']));
					$insuranceDetails=addslashes(trim($_REQUEST['insuranceDetails']));
					}
					if($_REQUEST['donate']==1){
					$donateDetails=addslashes(trim($_REQUEST['donateDetails']));
					$donateAmount=addslashes(trim($_REQUEST['donateAmount']));
					}
					
					$bl=GetPageRecord('*','flightBookingMaster','id="'.$bookinglastId2.'" '); 
					$actCost=mysqli_fetch_array($bl);
					
					
					if(round($totalwalletBalance)>$actCost['clientTotalFare']){
					
					
					
					$admarkup=($actCost['clientTotalFare']-$actCost['agentTotalFare']);
					$agmarkup=($actCost['agentTotalFare']-$actCost['totalFare']);
					
					
					$inv=GetPageRecord('*','flightBookingMaster',' 1 order by invoiceId desc'); 
					$lastInv=mysqli_fetch_array($inv); 
					$invoiceId=($lastInv['invoiceId']+1);
					
					

					
					$namevalue ='bookingNumber="'.$bookingNumber.'",status="'.$status.'",clientId="'.$clientId.'",companyName="'.$companyName.'",gstNo="'.$gstNo.'",gstEmail="'.$gstEmail.'",insurance="'.$insurance.'",insuranceAmount="'.$insuranceAmount.'",donateAmount="'.$donateAmount.'",donateDetails="'.$donateDetails.'",invoiceId="'.$invoiceId.'",markup="'.$admarkup.'",agentMarkup="'.$agmarkup.'",insuranceDetails="'.$insuranceDetails.'"'; 
					
					$where='id="'.$bookinglastId2.'" and tripType="1"';
					updatelisting('flightBookingMaster',$namevalue,$where); 
					updatelisting('flightBookingPaxDetailMaster','bookingNumber="'.$bookingNumber.'"','BookingId="'.$bookinglastId2.'"'); 
		
		
$finalclientcost=($_REQUEST['finalclientcost']+$insuranceAmount+$donateAmount);	


$balnceSheetAmt=($admarkup+$donateAmount+$insuranceAmount+$actCost['agentTotalFare'])-($actCost['agentTotalFare']-$actCost['totalFare']);

$a ='bookingId="'.$bookinglastId2.'",bookingType="flight",agentId="'.$AgentWebsiteData['id'].'",amount="'.$actCost['agentTotalFare'].'",paymentType="Debit",addedBy="'.$AgentWebsiteData['id'].'",addDate="'.date('Y-m-d H:i:s').'"';
addlistinggetlastid('sys_balanceSheet',$a); 
	 
 

} 

				}
				
			
			 
		
			
 
			
			}
		
		
		
		 
		
		
		
		
}

 	
			
deleteRecord('wig_flight_json_bkp','agentId="'.$_SESSION['agentUserid'].'"');

if($bookingpro!=1){ ?>

<script>
alert('Something Went Wrong. Please Try Again.');
window.parent.location.href = "<?php echo $fullurl; ?>"; 
</script>


<?php 

exit(); 

}

header("Location:".$fullurl.'flight-bookings');

}

/*
else if($bookingMethod==1){

//Redirect to payment gateway 
$_SESSION["bookingData"]=$_POST;
$amount=decode(decode(addslashes($_POST["arq"])));
$namevalue ='agentId="'.$_SESSION['agentUserid'].'",parentAgentId="'.$_SESSION['parentAgentId'].'",agentUsername="'.$_SESSION['agentUsername'].'",parentid="'.$_SESSION['parentid'].'",amount="'.$amount.'",note="Online Flight Book",data="'.addslashes(serialize($_POST)).'",status="pending",dateAdded="'.date("Y-m-d H:i:s").'"';
$txnID = addlistinggetlastid('onlineFlightBook',$namevalue);
$floatValue = number_format((float)$amount, 2, '.', '');  // return float
?>

<script>
window.location.href="<?php echo $fullurl; ?>test.php";
</script>

<?php } */ ?>