<?php include "inc.php"; 
include "config/logincheck.php"; 
$agentid=$_SESSION['agentUserid'];
	
$aaa=GetPageRecord('*','hotelBookingMaster','id="'.$_SESSION['bookinglastId'].'" '); 
$actCost=mysqli_fetch_array($aaa);


if($totalwalletBalance>=$_SESSION['totalfaremain']){ } else { 

?>
<script> alert('Your account balance is low. Please recharge for continue to this booking.'); 
parent.$('#loadingwhite').hide();

</script>
<?php
exit();
die();
}


 
if(round($totalwalletBalanceParent)<$_SESSION['totalfaremain'] && round($totalwalletBalanceParent)!=$_SESSION['totalfaremain']){ 
	
 

?>
<script> alert('Your account balance is low. Please recharge for continue to this booking.'); 
parent.$('#loadingwhite').hide();

</script>
<?php
exit();
die();
 } else {
 

 
$rs=GetPageRecord('*','sys_userMaster','id="'.$_SESSION['parentAgentId'].'" '); 
$AgentWebsiteData=mysqli_fetch_array($rs);  

  
if(trim($_POST['action'])=='paxdetailaction'){
$HotelSearchDetails = trim($_POST['HotelSearchDetails']);
$HotelSearchArr = json_decode($HotelSearchDetails); 
//print_r($HotelSearchArr);

/*$hotelJsonData = trim($_POST['hotelJsonData']);
$hotelArr = json_decode($hotelJsonData); 

$RoomDetails = trim($_POST['RoomDetails']);
$RoomArr = json_decode($RoomDetails); 
*/

$guestname = trim($_POST['guestname']);
$email = trim($_POST['email']);
$phone = trim($_POST['phone']);
$address = addslashes($_POST['address']);
$HotelReviewDataArr = json_decode($_POST['HotelReviewData']);
//print_r($HotelReviewDataArr);
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




 

$adultroom=$_REQUEST['nr'];
	$n=1;
	$roomjson='';
		foreach(range($adultroom,$columns) as $index) {
				$adultroom=$_GET['noadults'.$n];
				$childroom=$_GET['nochilds'.$n];
				$age1=$_GET['age1'.$n];
				$age2=$_GET['age2'.$n];
		
		$adult = 1;
		$adultJson = '';
		foreach(range($adultroom-1,$columnsa) as $indexa) {
		$namevalue ='bookingTableId="'.$_POST['bookinglastId'].'",title="'.trim($_POST['titleAdt'.$n.$adult]).'",firstName="'.trim($_POST['firstNameAdt'.$n.$adult]).'",lastName="'.trim($_POST['lastNameAdt'.$n.$adult]).'",paxType="AD",roomNo="'.$n.'"';
		addlistinggetlastid('hotelBookingPaxDetailMaster',$namevalue); 
		
		$adultJson.= '{
					"fN": "'.trim($_POST['firstNameAdt'.$n.$adult]).'",
                    "lN": "'.trim($_POST['lastNameAdt'.$n.$adult]).'",
                    "ti": "'.trim($_POST['titleAdt'.$n.$adult]).'",
                    "pNum": "'.trim($_POST['passportAdt'.$n.$adult]).'",
                    "pt": "ADULT"
		},';
		
		$adult++;
		}
		
		
		
		$child = 1;
		$childJson = '';
		foreach(range($childroom-1,$columnsv) as $indexv) {
		$namevalue ='bookingTableId="'.$_POST['bookinglastId'].'",title="'.trim($_POST['titleChd'.$n.$child]).'",firstName="'.trim($_POST['firstNameChd'.$n.$child]).'",lastName="'.trim($_POST['lastNameChd'.$n.$child]).'",paxType="CH",roomNo="'.$n.'",ageChild="'.trim($_POST['ageChild'.$n.$child]).'"';
		addlistinggetlastid('hotelBookingPaxDetailMaster',$namevalue); 
		
		$childJson.= '{
					"fN": "'.trim($_POST['firstNameChd'.$n.$child]).'",
                    "lN": "'.trim($_POST['lastNameChd'.$n.$child]).'",
                    "ti": "'.trim($_POST['titleChd'.$n.$child]).'",
                    "pt": "CHILD"
		},';
		
		$child++;
		}
		
		$finalpaxJson = $adultJson.$childJson;
		$finalpaxJson = rtrim($finalpaxJson,',');
		$roomjson.= '{
            "travellerInfo": ['.$finalpaxJson.']
        },';
		
	$n++; 
	}

$offlineBooking=offlinehotel($actCost['HotelName']);

$offlineBooking='off';

if($offlineBooking=='off'){
//logger('This is offline booking for hotel: ');
$status = 1;
$bookingNumber = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 8);
$bookingNumber = strtoupper($bookingNumber);
updatelisting('hotelBookingMaster','BookingNumber="'.$bookingNumber.'",status="'.$status.'",clientId="'.$clientId.'",agentId="'.$_SESSION['agentUserid'].'",bookingType=1,agentBookingType=0','id="'.$_POST['bookinglastId'].'"'); 
updatelisting('hotelBookingPaxDetailMaster','bookingNumber="'.$bookingNumber.'"','bookingTableId="'.$_POST['bookinglastId'].'"'); 
$BookingMessage = 'Booking Succesfull';

$bl=GetPageRecord('*','hotelBookingMaster','id="'.$_POST['bookinglastId'].'" '); 
$actCost=mysqli_fetch_array($bl);



$bloff=GetPageRecord('*','offlinehotelMaster','addBy="'.$AgentWebsiteData['parentId'].'" and (name="'.$actCost['HotelName'].'" or name="All")'); 
$offlinemoney=mysqli_fetch_array($bloff);

 

if($offlinemoney['id']>0){

$a ='bookingId="'.$bookinglastId.'",bookingType="Facilitating",agentId="'.$AgentWebsiteData['parentId'].'",amount="10",paymentType="Debit",addedBy="'.$AgentWebsiteData['id'].'",addDate="'.date('Y-m-d H:i:s').'",billType="hotel"';
addlistinggetlastid('sys_balanceSheet',$a); 

$a ='bookingId="'.$bookinglastId.'",bookingType="Facilitating_GST",agentId="'.$AgentWebsiteData['parentId'].'",amount="1.80",paymentType="Debit",addedBy="'.$AgentWebsiteData['id'].'",addDate="'.date('Y-m-d H:i:s').'",billType="hotel"';
addlistinggetlastid('sys_balanceSheet',$a); 

}



$a ='bookingId="'.$actCost['BookingNumber'].'",bookingType="hotel",agentId="'.($_SESSION['agentUserid']).'",amount="'.$_SESSION['hotelfinalprice'].'",paymentType="Debit",billType="hotel",addedBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';
addlistinggetlastid('sys_balanceSheet',$a);

 

 
 
 //=================Send Mail To Supplier===================
  
 
   
$rs7=GetPageRecord('*','sys_userMaster',' id in (select supplier  from hotelMaster where id in ( select HotelCode from hotelBookingMaster where id="'.$_POST['bookinglastId'].'") ) ');  
$hotelhave=mysqli_fetch_array($rs7);

$rs=GetPageRecord('*','sys_branchMaster','id=1'); 
$homeSettings=mysqli_fetch_array($rs);
  
 
   $to  = stripslashes($hotelhave['email']); // note the comma
  
  $subject = 'Hotel Booking Request ('.encode($_POST['bookinglastId']).') - '.$getcompanybasicinfo['companyName'];
  
   
$e=trim($homeSettings['email']);

$headers  = "From: " .$e. "\r\n";
$headers .= "Reply-To: " .$e. "\r\n"; 
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

$message = file_get_contents("".$fullurl."supplier_hotel_mail.php?id=".$_POST['bookinglastId']."", true);

 


mail($to, $subject, $message, $headers);
 
 
 
} 
	 
	 

}


unset($_SESSION['uniqueId']);
$_SESSION['uniqueId']='';


 

?>



<script> 

window.parent.location.href = "<?php echo $fullurl; ?>hotels-bookings"; 

</script>


<?php } ?>