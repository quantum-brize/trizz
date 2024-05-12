<?php 
include "inc.php"; 
include "config/logincheck.php"; 
$page='hotels';

$actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
 $actual_link = str_replace('hotel_search_load.php','hotel_session.php',$actual_link);

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

 


if($_REQUEST['action']=='flightpostaction'){ 




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
  "CheckInDate": "'.date('d/m/Y', strtotime($checkInDate. ' + 10 days')).'",
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
  "MaxRating": "5",
  "MinRating": "1",
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

if(!is_file($file)){ 

curl_setopt($ch , CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $body1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$information = curl_getinfo($ch);

//echo "<br><br>";
 $result = curl_exec($ch);
$json_arr = json_decode($result,true); 
$_SESSION['hotelTraceId']=$json_arr['HotelSearchResult']['TraceId'];

file_put_contents($file, $result);     
   
}  

 

$result=file_get_contents($file);
$json_arr = json_decode($result,true);  

}

//print_r($json_arr);
?>

<style>
.Deluxe { margin-top: 15px; background-color: var(--greyouter); width: 100%; padding: 5px 5px; overflow: hidden; }
.Deluxe p{font-size:12px; font-weight:400;}
.filtersidebar  .ui-state-default{ padding: 9px !important;}
.hotdeal{font-size: 12px; color: #ffffff; PADDING: 2PX 6PX; MARGIN-BOTTOM: 10PX; position: absolute; top: 10px; background-color: #f73131; border-radius: 4px; right: 10px; }
 
</style>


<iframe src="" style="display:none;" id="actual_link"></iframe>



<script>
function getssfile(){
$('#actual_link').attr('src','<?php echo $actual_link; ?>');
}

setTimeout(getssfile(), 5000);
</script>

<div class="col-3 filtersidebar hotelfilter">
<div class="card-header">
    Enter Hotel Name, Location
  </div>
<div class="card-body">
<input type="text" id="search" class="form-control" placeholder="Enter Keyword">
				
<script> 
var $filterCheckboxes = $('#allFilterDiv input[type="checkbox"]');
$filterCheckboxes.on('change', function() { 
  var selectedFilters = {};
  $filterCheckboxes.filter(':checked').each(function() {
    if (!selectedFilters.hasOwnProperty(this.name)) {

      selectedFilters[this.name] = [];

    }
    selectedFilters[this.name].push(this.value);
  });
  // create a collection containing all of the filterable elements

  var $filteredResults = $('.hotelsearchlist');
  // loop over the selected filter name -> (array) values pairs

  $.each(selectedFilters, function(name, filterValues) {
    // filter each .flower element

    $filteredResults = $filteredResults.filter(function() {
      var matched = false,

        currentFilterValues = $(this).data('category').split(' ');
      // loop over each category value in the current .flower's data-category

      $.each(currentFilterValues, function(_, currentFilterValue) {
        // if the current category exists in the selected filters array

        // set matched to true, and stop looping. as we're ORing in each

        // set of filters, we only need to match once
        if ($.inArray(currentFilterValue, filterValues) != -1) {

          matched = true;

          return false;

        }

      });
      // if matched is true the current .flower element is returned

      return matched;
    });

  });
  $('.hotelsearchlist').hide().filter($filteredResults).show();
});
 

$(document).ready(function(){
$('#search').keyup(function(){
var text = $(this).val();
$('.hotelboxx').hide();
$('.hotelboxx:contains("'+text+'")').show();
});
});

</script>
 </div>

<div class="card">
<div class="card-header">
    Price Range
  </div>
<div class="card-body">
		<div class=""> 
			<p class="range-value">
			<input type="text" id="amountfilter" readonly style="border: 0px;">
			</p>
		<div id="slider-ranges" class="range-bar"></div> 
		</div>
</div>
<script> 
		$(function() {
		var maxprice = Number($('#maxprice').val()); 
		var minprice = Number($('#minprice').val());
		$( "#slider-ranges" ).slider({
		range: true,
		min: minprice,
		max: maxprice,
		values: [ minprice, maxprice ],
		slide: function( event, ui ) {
		$( "#amountfilter" ).val( "" + ui.values[ 0 ] + " - " + ui.values[ 1 ] );
		
		showProducts(ui.values[ 0 ], ui.values[ 1 ]);
		}
		});
		$( "#amountfilter" ).val( "" + $( "#slider-ranges" ).slider( "values", 0 ) +
		" - " + $( "#slider-ranges" ).slider( "values", 1 ) );
		
		});
		
		function showProducts(minPrice, maxPrice) {
		$(".hotelsearchlist").hide().filter(function() {
		var price = parseInt($(this).data("price"), 10);
		return price >= minPrice && price <= maxPrice;
		}).show();
		}
</script>
<div class="card-header">
    Star Rating
  </div>
<div class="card-body" id="allFilterDiv">
<div class="arranddep">
 <label id="hotdeal" style="color:#f73131;"><input  type="checkbox" value="hotdeal" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> <i class="fa fa-fire" aria-hidden="true"></i> Hot Deal</label>
 <label id="1star" style="display:none;"><input  type="checkbox" value="1star" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> 1 Star</label>
 <label id="2star"  style="display:none;"><input type="checkbox" value="2star" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> 2 Star</label>
 <label id="3star" style="display:none;" ><input  type="checkbox" value="3star" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> 3 Star</label>
 <label id="4star" style="display:none;"><input  type="checkbox" value="4star" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> 4 Star</label>
 <label id="5star" style="display:none;"><input  type="checkbox" value="5star" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> 5 Star</label>

</div> 
</div>
 
  <div class="card-header">
    Locations
  </div>
<div class="card-body"  id="allFilterDiv3">
<div class="arranddep" style="max-height:250px; overflow-y: auto;">
<?php 
function d($dep) {
    return implode(',', array_keys(array_flip(explode(',', $dep))));
}

$alllocations='';
 foreach($json_arr['HotelSearchResult']['HotelResults'] as $hotelList){ 
 $alllocations.=$hotelList['HotelLocation'].',';
 }
 
$string = preg_replace('/\.$/', '', d($alllocations));  
$array = explode(',', $string); 
foreach($array as $value)
{
 if($value!=''){
?>
 <label style="display:none;" id="location<?php echo str_replace(' ','-',$value); ?>"><input  type="checkbox" value="location<?php echo str_replace(' ','-',$value); ?>" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> <?php echo stripslashes($value); ?></label> 
 <?php  } } ?>

</div> 
</div>

 
</div>

 

 

 
</div>


<div class="col-9 cardresult">
 


<div id="flightresult" class="listouter">
<div class="sortingouter" style="display:none;">
<table width="100%" border="0" cellpadding="0" cellspacing="0">



                      <tbody><tr>



                        <td width="16%" align="left" style="cursor:pointer;" onClick="getSortedDeparture();"><strong>Sort By:</strong> </td>



                        <td width="21%" align="center" style="cursor:pointer;" onClick="getSortedDeparture();">Departure <i class="fa fa-arrow-down" id="departurefa" aria-hidden="true" style="display: none;"></i>



                          <input name="departurefilterid" type="hidden" id="departurefilterid" value="1"></td>



                        <td width="21%" align="center" style="cursor:pointer;" onClick="getSortedDuration();">Duration <i class="fa fa-arrow-down" id="durationfa" aria-hidden="true" style="display: none;"></i>



                          <input name="durationfilterid" type="hidden" id="durationfilterid" value="1"></td>



                        <td width="21%" align="center" style="cursor:pointer;" onClick="getSortedArrival();">Arrival <i class="fa fa-arrow-down" id="arrivalfa" aria-hidden="true" style="display: none;"></i>



                          <input name="arrivalfilterid" type="hidden" id="arrivalfilterid" value="1">



                        </td>



                        <td width="21%" align="center" style="cursor:pointer;" onClick="getSortedPrice();" id="pricefilter">Price <i class="fa fa-arrow-up" id="pricefa" aria-hidden="true" style="display: inline-block;"></i>



                           <input name="pricefilterid" type="hidden" id="pricefilterid" value="0">



                        </td> 

                      </tr>



                    </tbody></table>
</div>





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
if (strpos($starcategory,$hotelList['StarRating'].',') !== false) {
 
			  ?> 			   


<div   class="row bookrow hotelbookrow hotelsearchlist hotelboxx <?php if($n>20){ ?>notshow<?php } ?>"  id="hotel<?php echo ($hotelList['HotelCode']); ?>list"  style="width:100%; "  data-price="<?php echo $hotelprice; ?>" data-category="<?php echo $hotelList['StarRating']; ?>star amt3 amt10 amt14 amt7 amt19 hoteltype<?php echo str_replace(' ','-','Hotel'); ?> <?php if($hotelList['IsHotDeal']!=false){ echo 'hotdeal'; } ?> location<?php echo str_replace(' ','-',$hotelList['HotelLocation']); ?>">

<script> 
$('#<?php echo $hotelList['StarRating']; ?>star').show();
$('#hoteltype<?php echo str_replace(' ','-','Hotel'); ?>').show();
</script>

<div class="col-lg-9"> 
<div class="hotelbooking">
<div class="hotelimg">
<img src="<?php echo gethotelimgna($hotelList['HotelPicture']); ?>" onerror="this.onerror=null;this.src='images/nohotelimage.png';" data-src="<?php echo stripslashes($hotelList['HotelPicture']); ?>">
</div>
<div class="hoteltext">
<h5><?php echo stripslashes($hotelList['HotelName']);  ?> <span style="display:none;"><?php echo strtolower($hotelList['HotelName']); ?></span></h5>
<div class="reviewsection">
<p class="threeblue">Hotel</p>
<span class="starcatht"> 
<?php $i=1;while($i<=$hotelList['StarRating']) { ?>
<i class="fa fa-star" aria-hidden="true"></i>
<?php $i++; } ?></span> 
</div>
<p class="relocation"><i class="fa fa-map-marker" aria-hidden="true"></i>
<?php if($hotelList['HotelLocation']!=''){ echo substr(strip_tags($hotelList['HotelLocation']),'0','120'); } else {  ?><?php echo stripslashes($hotelList['HotelAddress']); } ?></p>
<div class="Deluxe">
<p><?php echo substr(strip_tags($hotelList['HotelDescription']),'0','120'); ?>...</p> 
</div>
</div> 
</div> 
</div>


<div class="col-lg-3" style="position:relative;">
<?php if($hotelList['IsHotDeal']!=false){ ?>
<div class="hotdeal"><i class="fa fa-fire" aria-hidden="true"></i> Hot Deal</div>
<?php } ?>

<div class="bookbtn">
<h4 id="hotel<?php echo ($hotelList['HotelCode']); ?>price"><img src="images/loading.gif" style="width:32px; height:32px;" /></h4>
<div class="blackbox">  
<h5>Start From</h5>
 
</div>
<form name="hotelform" id="hotelform<?php echo $count; ?>" method="post"  action="<?php echo $fullurl; ?>hotel-view2" target="_blank"> 
<input type="hidden" name="action" value="hotelapi" /> 
<input type="hidden" name="ResultIndex"  id="res<?php echo ($hotelList['HotelCode']); ?>index"  value="<?php echo ($hotelList['ResultIndex']); ?>" /> 
<input type="hidden" name="HotelCode" value="<?php echo ($hotelList['HotelCode']); ?>" />  
<input type="hidden" name="HotelSearchDetails" value="<?php echo htmlentities($hotelBasicJson); ?>" />
<input type="hidden" name="hotelSearchId" value="<?php echo encode($rest['id']); ?>" /> 
<input type="hidden" name="checkInDate" value="<?php echo $checkInDate; ?>" /> 
<input type="hidden" name="empcount" value="<?php echo $_REQUEST['empcount']; ?>" /> 
<input type="hidden" name="checkOutDate" value="<?php echo $checkOutDate; ?>" /> 
<input type="hidden" name="nights" value="<?php echo $numberOfNights; ?>" /> 
<input type="hidden" name="ad" value="<?php echo $adultCount; ?>" /> 
<input type="hidden" name="cd" value="<?php echo $childCount; ?>" /> 
<input type="hidden" class="hotelTraceId" name="hotelTraceId" value="<?php echo $_SESSION['hotelTraceId']; ?>" /> 
<input type="hidden" name="countrynamedesti" value="<?php echo $_REQUEST['citydestination']; ?>" /><button type="submit" class="btn btn-danger" style="width:100%; display:none;"  id="book<?php echo ($hotelList['HotelCode']); ?>now">View Room</button>
</form>
</div>
</div>
</div> 


	  <?php $n++; } } } ?> 
  

<input name="maxprice" id="maxprice" type="hidden" value="<?php echo $maxprice; ?>">
<input name="minprice" id="minprice" type="hidden" value="<?php echo $minprice; ?>">
</div> 

</div>
 

 
<script>

 

  
function getSearchCityHotel(citysearchfield,cityresultfield,listsearch){
var citysearchfieldval = encodeURI($('#'+citysearchfield).val());  
var citysearchfield = citysearchfield;

if(citysearchfieldval!=''){  
$('#'+listsearch).show();
$('#'+listsearch).load('searchcitylistshotel.php?keyword='+citysearchfieldval+'&searchcitylists='+listsearch+'&cityresultfield='+cityresultfield+'&citysearchfield='+citysearchfield);
}
}
 
 

$(document).ready(function () {
    $("#dt1").datepicker({
        dateFormat: "dd-mm-yy",
        minDate: 0,
        onSelect: function () {
            var dt2 = $('#dt2');
            var startDate = $(this).datepicker('getDate');
            //add 30 days to selected date
            startDate.setDate(startDate.getDate() + 30);
            var minDate = $(this).datepicker('getDate');
            var dt2Date = dt2.datepicker('getDate');
            //difference in days. 86400 seconds in day, 1000 ms in second
            var dateDiff = (dt2Date - minDate)/(86400 * 1000);

            //dt2 not set or dt1 date is greater than dt2 date
            if (dt2Date == null || dateDiff < 0) {
                    dt2.datepicker('setDate', minDate);
            }
            //dt1 date is 30 days under dt2 date
            else if (dateDiff > 30){
                    dt2.datepicker('setDate', startDate);
            }
            //sets dt2 maxDate to the last day of 30 days window
            dt2.datepicker('option', 'maxDate', startDate);
            //first day which can be selected in dt2 is selected date in dt1
            dt2.datepicker('option', 'minDate', minDate);
        }
    });
    $('#dt2').datepicker({
        dateFormat: "dd-mm-yy",
        minDate: 0,onSelect: function () { 
        }
    });
	
});
 
 
  
function gettotalpax(){

var totalpax=0;
$('.pax').each(function(i, obj) {
    totalpax=Number(totalpax+Number($(obj).val())); 
}); 
$('#totalpax').val(totalpax);
 
 
var empcount = $('#empcount').val(); 
$('#travellersshow').val(''+empcount+' Room - '+totalpax+' Guest'); 
}




 
function addEmpInfo(){
var empcount = $('#empcount').val();

empcount=Number(empcount)+1;  
$.get("loadchild.php?id="+empcount, function (data) { 
$("#loademployee").append(data); 
}); 

var totalpax = $('#totalpax').val();
$('#empcount').val(empcount); 
$('#travellersshow').val(''+empcount+' Room - '+totalpax+' Guest'); 
}



function removeEmpInfo(id){
$('#empInfoId'+id).remove();
var empcount = $('#empcount').val();
empcount=Number(empcount)-1;  
var totalpax = $('#totalpax').val();
$('#empcount').val(empcount);
$('#travellersshow').val(''+empcount+' Room - '+totalpax+' Guest');
}



function combinecheckbox(){
var combinecheck ='';
var output = jQuery.map($(':checkbox[name=category\\[\\]]:checked'), function (n, i) {
    combinecheck = combinecheck+n.value+',';
}).join(',');

$('#starcategory').val(rtrim(combinecheck)+' Star');
}

function rtrim(str){
    return str.replace(/\s+$/, '');
}


  
gettotalpax();





					
					
					


 var $filterCheckboxes2 = $('#allFilterDiv2 input[type="checkbox"]');
$filterCheckboxes2.on('change', function() {
  var selectedFilters2 = {};
  $filterCheckboxes2.filter(':checked').each(function() {
    if (!selectedFilters2.hasOwnProperty(this.name)) {

      selectedFilters2[this.name] = [];

    }
    selectedFilters2[this.name].push(this.value);
  });
  // create a collection containing all of the filterable elements

  var $filteredResults = $('.hotelsearchlist');
  // loop over the selected filter name -> (array) values pairs

  $.each(selectedFilters2, function(name, filterValues) {
    // filter each .flower element

    $filteredResults = $filteredResults.filter(function() {
      var matched = false,

        currentFilterValues = $(this).data('category').split(' ');
      // loop over each category value in the current .flower's data-category

      $.each(currentFilterValues, function(_, currentFilterValue) {
        // if the current category exists in the selected filters array

        // set matched to true, and stop looping. as we're ORing in each

        // set of filters, we only need to match once
        if ($.inArray(currentFilterValue, filterValues) != -1) {

          matched = true;

          return false;

        }

      });
      // if matched is true the current .flower element is returned

      return matched;
    });

  });
  $('.hotelsearchlist').hide().filter($filteredResults).show();
});







 var $filterCheckboxes3 = $('#allFilterDiv3 input[type="checkbox"]');
$filterCheckboxes3.on('change', function() {
  var selectedFilters2 = {};
  $filterCheckboxes3.filter(':checked').each(function() {
    if (!selectedFilters2.hasOwnProperty(this.name)) {

      selectedFilters2[this.name] = [];

    }
    selectedFilters2[this.name].push(this.value);
  });
  // create a collection containing all of the filterable elements

  var $filteredResults = $('.hotelsearchlist');
  // loop over the selected filter name -> (array) values pairs

  $.each(selectedFilters2, function(name, filterValues) {
    // filter each .flower element

    $filteredResults = $filteredResults.filter(function() {
      var matched = false,

        currentFilterValues = $(this).data('category').split(' ');
      // loop over each category value in the current .flower's data-category

      $.each(currentFilterValues, function(_, currentFilterValue) {
        // if the current category exists in the selected filters array

        // set matched to true, and stop looping. as we're ORing in each

        // set of filters, we only need to match once
        if ($.inArray(currentFilterValue, filterValues) != -1) {

          matched = true;

          return false;

        }

      });
      // if matched is true the current .flower element is returned

      return matched;
    });

  });
  $('.hotelsearchlist').hide().filter($filteredResults).show();
});

		
		
		
function getSortedPrice(){

var pricefilterid = $('#pricefilterid').val();
var $wrap = $('#flightresult'); 
$('#pricefa').show();$wrap.find('.hotelsearchlist').sort(function(a, b) 
{if(pricefilterid==1){$('#pricefilterid').val('0'); 
$('#pricefa').removeClass('fa-caret-down');
$('#pricefa').addClass('fa-caret-up');return + a.getAttribute('data-price') - 
+b.getAttribute('data-price'); 
}else{$('#pricefilterid').val('1'); 
$('#pricefa').removeClass('fa-caret-up');
$('#pricefa').addClass('fa-caret-down');return + b.getAttribute('data-price') - 
+a.getAttribute('data-price');
}})
.appendTo($wrap); 
}
 getSortedPrice();	
 getSortedPrice();	
 <?php if($n>1){ ?>
 $('.totalhotel').text('<?php echo $n; ?>');
 <?php }   ?>
 
 
 
</script>
 
