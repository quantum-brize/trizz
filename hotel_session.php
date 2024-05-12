<?php 
include "inc.php"; 
include "config/logincheck.php"; 

function gethotelimgna($imgname){
if(strpos($imgname, 'HotelNA.jpg') !== false){
    return 'images/nohotelimage.png';
} else {
return $imgname;
}
}


$agentid=$_SESSION['agentUserid'];

$category='';

if(!empty($_REQUEST['category'])) {
    foreach($_REQUEST['category'] as $check) {
        $category.=$check.','; 
    }
}
$starcategory=$_REQUEST['starcategory'];
 
$travellers='1 Room - 1 Guest';
if($_REQUEST['travellers']!=''){
$travellers=$_REQUEST['travellers'];
}

$starcategory='3, 4 Star';
if($_REQUEST['starcategory']!=''){
$starcategory=$_REQUEST['starcategory'];
}
$checkInDate=date('d-m-Y', strtotime('+1 days'));
if($_REQUEST['checkInDate']!=''){
$checkInDate=$_REQUEST['checkInDate'];
}
  
$checkOutDate=date('d-m-Y', strtotime('+2 days'));
if($_REQUEST['checkOutDate']!=''){
$checkOutDate=$_REQUEST['checkOutDate'];
}
 
$destinationHotel='130443,IN'; 
if($_REQUEST['destinationHotel']!=''){
$destinationHotel=$_REQUEST['destinationHotel'];
}
 
$citydestination='Delhi,India'; 
if($_REQUEST['citydestination']!=''){
$citydestination=$_REQUEST['citydestination'];
}





////////=============Online=======================================






$category='';

if(!empty($_REQUEST['category'])) {
    foreach($_REQUEST['category'] as $check) {
        $category.=$check.','; 
    }
}
 $category=rtrim($category,', '); 

if($_GET['citydestination']!=""){ 

if(strpos(strtoupper($_GET['citydestination']), 'INDIA')){
    $domesticInternational = 'Yes';
}else{
    $domesticInternational = 'No';
}

 


$destExplode = explode(',',$_GET['destinationHotel']);
$city = $destExplode[0]; 
$country = $destExplode[1];

$checkInDateapi =  date('Y-m-d',strtotime($checkInDate));
$_SESSION['checkInDate']=$checkInDateapi;
 
$checkOutDateapi = date('Y-m-d',strtotime($checkOutDate));
$_SESSION['checkOutDate']=$checkOutDateapi;

$norooms='';
$roomJson= '';
$n=1;
$adultTotal=0;
$childTotal=0;
//$adultCount=0;
//$childCount=0;
$childAge='';
for ($x = 1; $x <= $_GET['empcount']; $x++) {

$adultTotal=0;
$childTotal=0;

$childAge='';

$adultJson='';
for ($j = 1; $j <= $_GET['noadults'.$n]; $j++) {
//$adultTotal=$adultTotal+$j;
$adultTotal = $_GET['noadults'.$n];
$adultJson.='{"PaxType":"AD"},';

}


$childJson='';



$cn1=$n;
$cn2=$n;
for ($k = 1; $k <= $_GET['nochilds'.$n]; $k++) {
$ca=10;
$cb=20;
 
if($k==1){ 
	$cage = $_REQUEST['age'.($ca+$cn1)];
	$cn1++;
}else{
	$cage = $_REQUEST['age'.($cb+$cn2)];
	$cn2++;
}

//$childTotal=$childTotal+$k;
$childTotal=$_GET['nochilds'.$n];
$childAge.=$cage.',';
$childJson.='{"PaxType":"CH","Age":"'.$cage.'"},';


}

$adultCount+=$_GET['noadults'.$n];
$childCount+=$_GET['nochilds'.$n];

$norooms.='{
				"numberOfAdults": '.$adultTotal.',
				"numberOfChild": '.$childTotal.',
				"childAge": ['.rtrim($childAge,',').']	
		   },';

$roomJson.= '{
				"Adult": ['.rtrim($adultJson,',').'],
				"Child": ['.rtrim($childJson,',').']
			},';

$n++; 

}

 $hotelBasicJson = '{
	"Destination":"'.$_GET['citydestination'].'",
	"CheckIn":"'.$checkInDateapi.'",
	"CheckOut":"'.$checkOutDateapi.'",
	"TotalRoom":"'.$_GET['empcount'].'",
	"TotalAdult":"'.$adultCount.'",
	"TotalChild":"'.$childCount.'",
	"Domestic":"'.$domesticInternational.'",
	"RoomDetails":['.rtrim($roomJson,',').']
}';

 $jsonPost = '{
    "searchQuery": {
        "checkinDate": "'.$checkInDateapi.'",
        "checkoutDate": "'.$checkOutDateapi.'",
        "roomInfo": ['.rtrim($norooms,',').'],
        "searchCriteria": {
            "city": "'.$city.'",
            "nationality": "'.$country.'",
            "currency": "INR"
        },
        "searchPreferences": {
            "ratings": ['.$category.'],
            "fsc": true
        }
    },
    "sync": falseapi
}';

$_SESSION['hotelBasicJson']= $hotelBasicJson;

$api=GetPageRecord('*','sys_companyMaster',' id=1'); 
$apiData=mysqli_fetch_array($api); 
/*echo '<pre>';
print_r($jsonPost);
echo '</pre>';*/
//$url = stripslashes($apiData['hotelApiKey']); // URL To Hit
$url = $hotelsearchquerylist; // URL To Hit
 
 
 
$result = getHotelApiData($url,$jsonPost,$hotelApiKey);

//print_r($result);
$resultArr = json_decode($result);
$searchId = $resultArr->searchIds{0};

$urlsecond = $hotelsearch; // URL To Hit
$searchPostJosn = '{ "searchId":"'.$searchId.'" }';
$listJson = getHotelApiData($urlsecond,$searchPostJosn,$hotelApiKey);
$hotelData = json_decode($listJson);


//print_r($listJson);

 
}
$datetime1 = date_create($checkInDateapi);
$datetime2 = date_create($checkOutDateapi);
$interval = date_diff($datetime1, $datetime2);
$days = $interval->format('%a');




 $destination = explode(',',$_GET['citydestination']);
		  $citydestination = $destination[0];
		  
		  $values = $hotelData->searchResult->his;
		  foreach($values as $hotelList){
		  
		  $count++;
		
		
		$source=$hotelList->img{0}->tns;
    $contents=file_get_contents( $source );
	
	 $source=$hotelList->img{0}->tns;
	
	}






////////=============Offline=======================================












$norooms='';
$roomJson= '';
$n=1;
$adultTotal=0;
$childTotal=0;


$childAge='';
$childJson='';
for ($x = 1; $x <= $_GET['empcount']; $x++) {

$adultTotal=0;
$childTotal=0;

$childAge='';

 




$cn1=$n;
$cn2=$n;
for ($k = 1; $k <= $_GET['nochilds'.$n]; $k++) {
$ca=10;
$cb=20;
 
if($k==1){ 
	$cage = $_REQUEST['age'.($ca+$cn1)];
	$cn1++;
}else{
	$cage = $_REQUEST['age'.($cb+$cn2)];
	$cn2++;
}

//$childTotal=$childTotal+$k;
$childTotal=$_GET['nochilds'.$n];
$childAge.=$cage.',';
$childJson.='{"PaxType":"CH","Age":"'.$cage.'"},';


}

$adultCount+=$_GET['noadults'.$n];
$childCount+=$_GET['nochilds'.$n];

 

$n++; 

}

 

 




include "hotelapi/api.php"; 

 
 $n=1;

$strings = explode(' - ',$_REQUEST['daterange']);
 
$rooms='';

$adultJson='';
$childJson='';
$norooms='';
  
for ($x = 1; $x <= $_GET['empcount']; $x++) {

$adultTotal=0;
$childTotal=0;

$childAge='';

 $adultCount=0;
 $childCount=0;


for ($j = 1; $j <= $_GET['noadults'.$n]; $j++) {
//$adultTotal=$adultTotal+$j;
$adultTotal = $_GET['noadults'.$n];
$adultJson.='{"PaxType":"AD"},';

}


$cn1=$n;
$cn2=$n;
for ($k = 1; $k <= $_GET['nochilds'.$n]; $k++) {
$ca=10;
$cb=20;
 
if($k==1){ 
	$cage = $_REQUEST['age'.($ca+$cn1)];
	$cn1++;
}else{
	$cage = $_REQUEST['age'.($cb+$cn2)];
	$cn2++;
}

//$childTotal=$childTotal+$k;
$childTotal=$_GET['nochilds'.$n];
$childAge.=$cage.',';
}



$cn1=$n;
$cn2=$n;
 

$adultCount+=$_GET['noadults'.$n];
$childCount+=$_GET['nochilds'.$n];

$norooms.='{
				"NoOfAdults": '.$adultCount.',
				"NoOfChild": '.$childTotal.',
				"ChildAge": ['.rtrim($childAge,',').']	
		   },';

$roomJson.= '{
				"Adult": ['.rtrim($adultJson,',').'],
				"Child": ['.rtrim($childJson,',').']
			},';
			
			
if($childCount<=0)
{			
	$rooms.='{
		  "NoOfAdults": '.$adultCount.',
		  "NoOfChild": '.$childCount.',
		  "ChildAge": null	
		},';
}
else
{

	$rooms.='{
		  "NoOfAdults": '.$adultCount.',
		  "NoOfChild": '.$childCount.',
		  "ChildAge": ['.rtrim($childAge,',').']	
		},';

}		


$n++; 

}

//echo $rooms;
//echo "<br>***********<br>"; 
 
/*echo $category;
die;*/

$categoryArr=explode(",",$category);
$minCategory=min($categoryArr);
 
$maxCategory=max($categoryArr);
 
//After city add this for tbo mapped data
/*"IsTBOMapped": "true",*/
 $body1 = '{
  "CheckInDate": "'.date('d/m/Y',strtotime($checkInDate)).'",
  "NoOfNights": "'.$days.'",
  "CountryCode": "'.$country.'",
  "CityId": "'.$city.'",
  "ResultCount": null,
  "PreferredCurrency": "INR",
  "GuestNationality": "IN",
  "NoOfRooms": "'.($n-1).'",
  "RoomGuests": [
    '.rtrim($rooms,',').'
  ],
  "PreferredHotel": "",
  "MaxRating": "'.$maxCategory.'",
  "MinRating": "'.$minCategory.'",
  "ReviewScore": null,
  "IsNearBySearchAllowed": false,
  "EndUserIp": "'.$_SERVER['SERVER_ADDR'].'",
  "TokenId": "'.$tokenId.'"
}';

// echo $body1;
  $file = 'hoteldestination/'.$_REQUEST['citydestination'].'.txt';
 
 $_SESSION['hotelSearchRequestSES'] =$body1;
 

$ch = curl_init();
$url = 'https://api.travelboutiqueonline.com/HotelAPI_V10/HotelService.svc/rest/GetHotelResult/';

 $headers = array(
'Content-Type: application/json',
'Content-Length: '.strlen($body1),    
'Accept: application/json',
'UserName: '.APIUSERNAME.'',
'APIPassword:'.APIPASSWORD.''
);

curl_setopt($ch , CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $body1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$information = curl_getinfo($ch);

//echo "<br><br>";
 $result = curl_exec($ch);
$json_arr = json_decode($result,true); 
$_SESSION['hotelTraceId']=$json_arr['HotelSearchResult']['TraceId'];
 
  
?>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script>
parent.$('.bookrow').hide();

 <?php $minprice=0; 
  $n=1;
			  foreach($json_arr['HotelSearchResult']['HotelResults'] as $hotelList){ 
				$hoteyes=1;
			  
			  
			  
			  $hotelprice=0;
			  
			  $hotelprice=$hotelList['Price']['PublishedPriceRoundedOff']; 
				if($startingprice==''){
				$startingprice=$hotelList['Price']['PublishedPriceRoundedOff'];
				}
				$endingprice=$hotelList['Price']['PublishedPriceRoundedOff'];
		
		
		$date1 = new DateTime($checkInDate);
			$date2 = new DateTime($checkOutDate); 
			$numberOfNights= $date2->diff($date1)->format("%a");
		
		if($endingprice<$minprice || $minprice==0){
			$minprice=$endingprice;
			}
			
			if($endingprice>$maxprice){
			$maxprice=$endingprice;
			}
		
		$hotelCost=calculatehotelcost(encode($agentid),stripslashes($hotelList['HotelName']),$hotelprice,'0');
		
	
		
		if($hotelnamevar!=$hotelList['HotelName']){
		
			$hotelnamevar=$hotelList['HotelName'];
			  ?>
		 

parent.$('#res<?php echo ($hotelList['HotelCode']); ?>index').val('<?php echo ($hotelList['ResultIndex']); ?>');
parent.$('#hotel<?php echo ($hotelList['HotelCode']); ?>price').html('&#8377;<?php echo $hotelCost[2]; ?>');
parent.$('#hotel<?php echo ($hotelList['HotelCode']); ?>list').show();
parent.$('#book<?php echo ($hotelList['HotelCode']); ?>now').show();
parent.$('#location<?php echo str_replace(' ','-',$hotelList['HotelLocation']); ?>').show();
 
			  <?php } } ?>

 
parent.$('.hotelTraceId').val('<?php echo $json_arr['HotelSearchResult']['TraceId']; ?>');

parent.$('.bookrow').each(function(i, obj) {
var display = $(this).css('display');
if(display=='none'){
 parent.$(this).remove();
}
});
</script>