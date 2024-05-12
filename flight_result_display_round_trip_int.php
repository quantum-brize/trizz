<?php 
include "inc.php"; 
include "config/logincheck.php";
?>
 
 
<div class="sortingouter">
<table width="100%" border="0" cellpadding="0" cellspacing="0">



                      <tbody><tr>



                        <td width="16%" align="left" style="cursor:pointer;" onClick="getSortedDeparture();"><strong>Sort By:</strong> </td>



                        <td width="21%" align="center" style="cursor:pointer;" onClick="getSortedDeparture();">Departure <i class="fa fa-caret-down" id="departurefa" aria-hidden="true" style="display: none;"></i>



                          <input name="departurefilterid" type="hidden" id="departurefilterid" value="1"></td>



                        <td width="21%" align="center" style="cursor:pointer;" onClick="getSortedDuration();">Duration <i class="fa fa-caret-down" id="durationfa" aria-hidden="true" style="display: none;"></i>



                          <input name="durationfilterid" type="hidden" id="durationfilterid" value="1"></td>



                        <td width="21%" align="center" style="cursor:pointer;" onClick="getSortedArrival();">Arrival <i class="fa fa-caret-down" id="arrivalfa" aria-hidden="true" style="display: none;"></i>



                          <input name="arrivalfilterid" type="hidden" id="arrivalfilterid" value="1">



                        </td>



                        <td width="21%" align="center" style="cursor:pointer;" onClick="getSortedPrice();" id="pricefilter">Price <i class="fa fa-caret-up" id="pricefa" aria-hidden="true" style="display: inline-block;"></i>
 
                           <input name="pricefilterid" type="hidden" id="pricefilterid" value="1">



                        </td> 

                      </tr>



                    </tbody></table>
</div>




<?php
$minprice=0;
$mainlistcount=1;
//$a=GetPageRecord('*','wig_flight_json_bkp',' agentId="'.$_SESSION['agentUserid'].'" group by FLIGHT_NAME,FLIGHT_NO,DEP_TIME order by AMT asc');

//echo ' uniqueSessionId="'.$_SESSION['uniqueSessionId'].'" and isRoundTripInt=1  order by AMT asc';

$a=GetPageRecord('*','wig_flight_json_bkp',' uniqueSessionId="'.$_SESSION['uniqueSessionId'].'" and isRoundTripInt=1  order by AMT asc');
while($res=mysqli_fetch_array($a)){



			foreach($segmentsDataArr['Segments'][0] as $segmentsDataArrValue)
			{ 
			$starttimedeparture+=round($segmentsDataArrValue['Duration']+$segmentsDataArrValue['AccumulatedDuration']);
			
			} 

	 
		
			foreach($segmentsDataArr['Segments'][1] as $segmentsDataArrValue)
			{ 
			$starttimearrival+=round($segmentsDataArrValue['Duration']+$segmentsDataArrValue['AccumulatedDuration']); 
			
			}


$deptime= $res['DEP_DATE'].' '.$res['DEP_TIME'];
$deptime=date('hi',strtotime($deptime));

$arrtime= $res['DEP_DATE'].' '.$res['ARRV_TIME'];
$arrtime=date('hi',strtotime($arrtime));
  
preg_match("/([0-9]+)/", $res['DUR'], $matches);

$D_TIME= $res['DEP_TIME'];
$arrtime= $res['ARRV_TIME'];




 
$b=GetPageRecord('*','wig_flight_json_bkp',' uniqueSessionId="'.$_SESSION['uniqueSessionId'].'" and id="'.$res['id'].'" and isRoundTripInt=1 and FLIGHT_NAME="'.$res['FLIGHT_NAME'].'" and FLIGHT_NO="'.$res['FLIGHT_NO'].'" and DEP_TIME="'.$res['DEP_TIME'].'"  order by AMT asc');
$flightprice=mysqli_fetch_array($b);



$str_arr = explode (",", $flightprice['agfare']);  
	$basefares = explode ("=", $str_arr[2]);
	
	$durationHourMinstR=0;
	$segR=unserialize(stripslashes($res['roundIntInboundJson']));
	//$segR = $valArray['Segments'][1];
		unset($inbound);
		foreach($segR as $segmentR)
		{
			$inbound[] = $segmentR;		
		}
	
	$ibound=$inbound[0];

	$NoOfSeatAvailableR = $ibound['NoOfSeatAvailable']; 
    $BaggageR = $ibound['Baggage'];
    $CabinBaggageR = $ibound['CabinBaggage'];
    $airlineR = $ibound['Airline']['AirlineName'];
	$haveAirlineR = $airlinecodeR = $ibound['Airline']['AirlineCode'];
	$airlinenumR = $airlinecodeR."-".$ibound['Airline']['FlightNumber']." ".$ibound['Airline']['FareClass'];    
	$deptimeR = $ibound['Origin']['DepTime'];
	$depcityR = $ibound['Origin']['Airport']['CityName'].", ".$ibound['Origin']['Airport']['CountryName']."(".$ibound['Origin']['Airport']['AirportCode'].")";
	$deptitleR = $ibound['Origin']['Airport']['AirportName']." Airport";     
	$stopcityR = $ibound['Origin']['Airport']['CityName'];
	$confltR = $airlinecodeR."-".$ibound['Airline']['FlightNumber'];
	//$dep_codeR= $ibound['Origin']['Airport']['AirportCode']." ".$stopcityR;
	$dep_codeR= $ibound['Origin']['Airport']['AirportCode'];
	$durationR= $ibound['Duration'];

	
	
	$ibound2=$inbound[count($inbound)-1];
	
	$desitnationstopcityR = $ibound2['Destination']['Airport']['CityName'];
	//$destination_codeR= $ibound['Destination']['Airport']['AirportCode']." ".$desitnationstopcityR;
	$destination_codeR= $ibound2['Destination']['Airport']['AirportCode'];
	$destinationTimeR = $ibound2['Destination']['ArrTime'];
	
	$NoOfSeatAvailableR=$ibound['NoOfSeatAvailable'];
	
		################### TIME CALCULATION #####################

		$msdate1= $destinationTimeR;
		$msdate1= explode('T',$msdate1); 
		$msdateaxp1= $msdate1['0'].' '.$msdate1['1']; 
		
		$msdate2= $deptimeR;
		$msdate2= explode('T',$msdate2); 
		$msdateaxp2= $msdate2['0'].' '.$msdate2['1']; 
		$seconds = strtotime($msdateaxp1) - strtotime($msdateaxp2);
		$hoursR   = floor($seconds / 3600); 
		$minR = floor(($seconds - ($hoursR * 3600))/60); 
		
		$durationHourMinstR= $hoursR."H ".$minR."M";

		################### TIME CALCULATION #####################



//echo '<pre>';print nl2br(print_r($inbound, true));echo '</pre>'; exit;



$flight_segR= count($inbound);
$flight_segmentR = $flight_segR - 1;

?>

<script>
$('#flightnameid<?php echo str_replace(' ','-',stripslashes($res['FLIGHT_NAME'])); ?>').show();
</script>


<div id="itemlist<?php echo stripslashes($res['id']); ?>" class="card item itemlist"  data-price="" data-duration="<?php echo trim($matches[1]);?>" data-depart="<?php echo $deptime; ?>" data-arrive="<?php echo str_replace(':','',$arrtime); ?>" data-category="<?php echo $res['STOP']; ?>stop D<?php if(date('H',strtotime($D_TIME))<12 && date('H',strtotime($D_TIME))>5){ echo '12'; } if(date('H',strtotime($D_TIME))<18 && date('H',strtotime($D_TIME))>12){ echo '18'; }  if(date('H',strtotime($D_TIME))<24 && date('H',strtotime($D_TIME))>18){ echo '1'; }  if(date('H',strtotime($D_TIME))<6 && date('H',strtotime($D_TIME))>0){ echo '6'; }   ?> A<?php if(date('H',strtotime($arrtime))<12 && date('H',strtotime($arrtime))>5){ echo '12'; } if(date('H',strtotime($arrtime))<18 && date('H',strtotime($arrtime))>12){ echo '18'; }  if(date('H',strtotime($arrtime))<24 && date('H',strtotime($arrtime))>18){ echo '1'; }  if(date('H',strtotime($arrtime))<6 && date('H',strtotime($arrtime))>0){ echo '6'; } ?> <?php echo str_replace(' ','-',stripslashes($res['FLIGHT_NAME'])); ?>">

<div class="card-body">

<div class="row">

<div class="col-10">

<div class="row">
<div class="col-4 bookimg">
 <table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"><img src="<?php echo $imgurl.getflightlogo(stripslashes($res['FLIGHT_NAME'])); ?>" width="32" height="32"></td>
    <td style="padding-left:10px;">
	<h6><strong><?php echo stripslashes($res['FLIGHT_NAME']); ?></strong> <br>
	  <span class="destination"><?php echo stripslashes($res['FLIGHT_CODE']); ?>-<?php echo stripslashes($res['FLIGHT_NO']); ?></span></h6>
	 
	
	</td>
  </tr>
</table>

</div>

<div class="col-8">
 <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="33%" align="center">
	<div class="bookboxprice">
                        <h6><strong><?php echo stripslashes($res['DEP_TIME']); ?></strong></h6>
                        <p class="destination"><?php echo stripslashes($res['ORG_CODE']); ?></p> 
                  </div> 
	</td>
    <td width="33%" align="center">
	
 
			<div class="nonstop">
                        <h4><?php echo sprintf("%d:%02d",   floor($starttimedeparture/60), $starttimedeparture%60);  ?></h4>
                        <div class="nonstopborder" style="margin: 5px auto;"><i class="fa fa-plane" aria-hidden="true"></i>
                        </div>
                        <span><?php if($res['STOP']==0){ ?>
			Non Stop<?php  }else{ ?><span style="color:#bf0000 !important;"><?php echo $res['STOP'].' Stop '; ?></span><?php } ?></span>
							 
                  </div>
			
			</td>
    <td width="33%" align="center">
	<div class="bookboxprice">
                        <h6><strong><?php echo stripslashes($res['ARRV_TIME']); ?></strong></h6>
                        <p class="destination"><?php echo stripslashes($res['DES_CODE']); ?></p> 
                  </div>  
	 </td>
  </tr>
</table>



</div>
 <div class="col-12">
 <div class="refundtable" style="margin-top: 8px; margin-bottom: 10px; padding: 5px; border: 1px dashed #ddd; background-color: #cccccc26;">
                      <table>
                        <tbody><tr>
                          <td><i class="fa fa-credit-card-alt" aria-hidden="true"></i> <span class="green"><span class="refundablespan"><?php if($flightprice['refundyes']=='1'){ echo '<span class="refundablespan">Refundable</span>'; } else { echo '<span class="nonrefundablespan">Non Refundable</span>'; } ?></span></span>&nbsp;&nbsp;&nbsp;</td>

                          <td><i class="fa fa-user-circle-o" aria-hidden="true"></i>
                            <span class="red"> <?php echo $remseat; ?> Seat Left </span>                          </td>
                           
                          <td><div class="blackbox">
                      
						     <h5 style="cursor:pointer;" onclick="loadpop('Flight Details (<?php echo stripslashes($flightprice['FLIGHT_NAME']); ?>  - <?php echo stripslashes($res['FLIGHT_CODE']); ?>-<?php echo stripslashes($res['FLIGHT_NO']); ?>)',this,'800px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=showflightdetails&id=<?php echo $res['id']; ?>"><i class="fa fa-info-circle" aria-hidden="true"></i> Flight Detail</h5>
						</div></td> 
                        </tr>
                      </tbody></table>
            </div>
 
</div>

<div class="col-4">
 <table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"><img src="<?php echo $imgurl.getflightlogo(stripslashes($airlineR)); ?>" width="32" height="32"></td>
    <td  style="padding-left:10px;"> 
	<h6 style="font-size:15px;"><strong><?php echo stripslashes($airlineR); ?></strong> <br>
	  <span class="destination"><?php echo stripslashes($confltR); ?></span></h6> 
	</td>
  </tr>
</table>

</div>

<div class="col-8">
 <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="33%" align="center">
	<div class="bookboxprice">
                        <h6><strong><?php echo date('H:i',strtotime($deptimeR)); ?></strong></h6>
                        <p class="destination"><?php echo $dep_codeR; ?></p> 
                  </div> 
	</td>
    <td width="33%" align="center">
	<div class="nonstop">
                        <h4><?php echo sprintf("%d:%02d",   floor($starttimearrival/60), $starttimearrival%60);  ?></h4>
                        <div class="nonstopborder" style="margin: 5px auto;"><i class="fa fa-plane" aria-hidden="true"></i>
                        </div>
						
						<span><?php if($flight_segmentR==0){ ?>
			Non Stop<?php  }else{ ?><span style="color:#bf0000 !important;"><?php echo $flight_segmentR.' Stop '; ?></span><?php } ?></span>
						 
							 
                  </div> 
	  </td>
    <td width="33%" align="center">
	
		<div class="bookboxprice">
                        <h6><strong><?php echo date('H:i',strtotime($destinationTimeR)); ?></strong></h6>
                        <p class="destination"><?php echo $destination_codeR; ?></p> 
                  </div> 
	 </td>
  </tr>
</table>

</div>

  
</div> 

 
 <?php if(getfaretypedetails(stripslashes($res['FLIGHT_NAME']),stripslashes($res['PCC']))!=''){ ?>
<div class="ymessage">
<?php echo stripslashes(getfaretypedetails(stripslashes($res['FLIGHT_NAME']),stripslashes($res['PCC']))); ?>
</div>
<?php  } ?>

 
 
 
</div>


 
 

<script>
var colorattr = $('#itemlist<?php echo stripslashes($res['id']); ?>').attr('data-category');
$('#itemlist<?php echo stripslashes($res['id']); ?>').attr('data-category','<?php echo $farecolor; ?>'+colorattr)
</script>

<div class="col-2">
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="pricelisttable">
 <?php
 $flightpricelastid=0;
$ns=1;
$farecolor='';
$b=GetPageRecord('*','wig_flight_json_bkp',' uniqueSessionId="'.$_SESSION['uniqueSessionId'].'" and id="'.$res['id'].'" and isRoundTripInt=1 and FLIGHT_NAME="'.$res['FLIGHT_NAME'].'" and FLIGHT_NO="'.$res['FLIGHT_NO'].'" and DEP_TIME="'.$res['DEP_TIME'].'"  order by AMT asc');
while($flightprice=mysqli_fetch_array($b)){ 

 

$str_arr = explode (",", $flightprice['agfare']);  
	$basefares = explode ("=", $str_arr[2]);
	
	$durationHourMinstR=0;
	$segR=unserialize(stripslashes($res['roundIntInboundJson']));
	//$segR = $valArray['Segments'][1];
		unset($inbound);
		foreach($segR as $segmentR)
		{
			$inbound[] = $segmentR;		
		}
	
	$ibound=$inbound[0];

	$NoOfSeatAvailableR = $ibound['NoOfSeatAvailable']; 
    $BaggageR = $ibound['Baggage'];
    $CabinBaggageR = $ibound['CabinBaggage'];
    $airlineR = $ibound['Airline']['AirlineName'];
	$haveAirlineR = $airlinecodeR = $ibound['Airline']['AirlineCode'];
	$airlinenumR = $airlinecodeR."-".$ibound['Airline']['FlightNumber']." ".$ibound['Airline']['FareClass'];    
	$deptimeR = $ibound['Origin']['DepTime'];
	$depcityR = $ibound['Origin']['Airport']['CityName'].", ".$ibound['Origin']['Airport']['CountryName']."(".$ibound['Origin']['Airport']['AirportCode'].")";
	$deptitleR = $ibound['Origin']['Airport']['AirportName']." Airport";     
	$stopcityR = $ibound['Origin']['Airport']['CityName'];
	$confltR = $airlinecodeR."-".$ibound['Airline']['FlightNumber'];
	//$dep_codeR= $ibound['Origin']['Airport']['AirportCode']." ".$stopcityR;
	$dep_codeR= $ibound['Origin']['Airport']['AirportCode'];
	$durationR= $ibound['Duration'];

	
	
	$ibound2=$inbound[count($inbound)-1];
	
	$desitnationstopcityR = $ibound2['Destination']['Airport']['CityName'];
	//$destination_codeR= $ibound['Destination']['Airport']['AirportCode']." ".$desitnationstopcityR;
	$destination_codeR= $ibound2['Destination']['Airport']['AirportCode'];
	$destinationTimeR = $ibound2['Destination']['ArrTime'];
	
	$NoOfSeatAvailableR=$ibound['NoOfSeatAvailable'];
	
		################### TIME CALCULATION #####################

		$msdate1= $destinationTimeR;
		$msdate1= explode('T',$msdate1); 
		$msdateaxp1= $msdate1['0'].' '.$msdate1['1']; 
		
		$msdate2= $deptimeR;
		$msdate2= explode('T',$msdate2); 
		$msdateaxp2= $msdate2['0'].' '.$msdate2['1']; 
		$seconds = strtotime($msdateaxp1) - strtotime($msdateaxp2);
		$hoursR   = floor($seconds / 3600); 
		$minR = floor(($seconds - ($hoursR * 3600))/60); 
		
		$durationHourMinstR= $hoursR."H ".$minR."M";

		################### TIME CALCULATION #####################



//echo '<pre>';print nl2br(print_r($inbound, true));echo '</pre>'; exit;



$flight_segR= count($inbound);
$flight_segmentR = $flight_segR - 1;
	
?>

<?php 
if($ns==1){
$flightpricelastid=$flightprice['id'];
}


if($ns==1 && $mainlistcount==1){



  $minprice=$basefares[1];
  
  }

$remseat=$flightprice['SEAT'];
if($ns==1 ){ 

 ?>

<script>
$('#seatleft<?php echo stripslashes($res['id']); ?>').text('<?php echo stripslashes($flightprice['SEAT']); ?>');
$('#itemlist<?php echo stripslashes($res['id']); ?>').attr('data-price','<?php echo $basefares[1]; ?>');
</script>
<?php } 

 $maxprice=$basefares[1];
?>
 
  <tr>
    <td align="left" valign="top" style="text-align: center; font-weight: 700; border: 0px;"><span class="mainprice" style="font-size:22px;"><?php echo convertfromtocurrencywithcurr('INR',$_SESSION['currency'],$basefares[1]+$flightprice['agentFixedMakup']); ?>
	
	</span><span class="netpriceshow" style="display:none; color:#009933;font-size:22px;">&#8377; <?php echo $flightprice['netFareBeforecomm']; ?></span>	</td>
    </tr>
  <tr>
    <td align="left" valign="top" style="text-align: center; font-weight: 700; border: 0px;"><a id="booknowlink<?php echo stripslashes($res['id']); ?>" href="<?php echo $fullurl; ?>flight-review-book?i=<?php echo encode($flightpricelastid); ?>"><button type="button" class="btn btn-danger" style="width:100%;">Book Now</button></a></td>
  </tr>
  <tr>    </tr>
  <?php 
  
  $farecolor.=' '.str_replace('#','',getfaretypedisplaycolor(stripslashes($flightprice['FLIGHT_NAME']),stripslashes($flightprice['PCC']))).' ';
  ?>
  <script>
  $('.filter-<?php echo str_replace('#','',getfaretypedisplaycolor(stripslashes($flightprice['FLIGHT_NAME']),stripslashes($flightprice['PCC']))); ?>').show();
  </script>
  <?php
  $ns++; } ?>
</table>
</div>


 

</div>



<div class="row">

<div class="col-10">

 

 
 

 
 
 
</div>




 
 
 

</div>
 

</div>




</div>

<?php $mainlistcount++; } ?>


<script>
function flightdetailsbox(id,secid,tabid){ 

if(tabid==4){
$('#flightdetails'+id).html('Loading...');
}

var secid = $('input[name="flightprice'+id+'"]:checked').val();
$('#flightdetails'+id).load('flightdetailsbox.php?id='+secid+'&mainid='+id+'&tabid='+tabid);
 
}

function hidedetailbtn(id){

var blk = $('#flightdetails'+id).css('display');

if(blk=='block'){
$('#viewdetailbtn'+id).text('Show Details');
$('#flightdetails'+id).hide();
} else {
$('#viewdetailbtn'+id).text('Hide Details');
$('#flightdetails'+id).show();
}

}


function hideallfilterarrow(){
$('#departurefa').hide();
$('#durationfa').hide();
$('#arrivalfa').hide();
$('#pricefa').hide();
$('#departurefaReturn').hide();
$('#durationfaReturn').hide();
$('#arrivalfaReturn').hide();
$('#pricefaReturn').hide();
}




function getSortedPrice(){

var pricefilterid = $('#pricefilterid').val();
var $wrap = $('.listouter');
hideallfilterarrow(); 
$('#pricefa').show();$wrap.find('.item').sort(function(a, b) 
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
 
function getSortedArrival() 
{
var pricefilterid = $('#arrivalfilterid').val();
var $wrap = $('.listouter');
hideallfilterarrow(); 
$('#arrivalfa').show(); $wrap.find('.item').sort(function(a, b) 
{if(pricefilterid==1){$('#arrivalfilterid').val('0'); 
$('#arrivalfa').removeClass('fa-caret-down');
$('#arrivalfa').addClass('fa-caret-up');return + a.getAttribute('data-arrive') - 
+b.getAttribute('data-arrive'); } else {$('#arrivalfilterid').val('1'); 
$('#arrivalfa').removeClass('fa-caret-up');
$('#arrivalfa').addClass('fa-caret-down');return + b.getAttribute('data-arrive') - 
+a.getAttribute('data-arrive');
}})
.appendTo($wrap); 
} 
function getSortedDeparture() 
{
var pricefilterid = $('#departurefilterid').val();
var $wrap = $('.listouter');
hideallfilterarrow();
$('#departurefa').show(); $wrap.find('.item').sort(function(a, b) 
{if(pricefilterid==1){$('#departurefilterid').val('0'); 
$('#departurefa').removeClass('fa-caret-down');
$('#departurefa').addClass('fa-caret-up');return + a.getAttribute('data-depart') - 
+b.getAttribute('data-depart'); } else {$('#departurefilterid').val('1'); 
$('#departurefa').removeClass('fa-caret-up');
$('#departurefa').addClass('fa-caret-down');return + b.getAttribute('data-depart') - 
+a.getAttribute('data-depart');
}})
.appendTo($wrap); 
} 
function getSortedDuration() 
{
var pricefilterid = $('#durationfilterid').val();
var $wrap = $('.listouter');
hideallfilterarrow(); 
$('#durationfa').show(); $wrap.find('.item').sort(function(a, b) 
{if(pricefilterid==1){$('#durationfilterid').val('0'); 
$('#durationfa').removeClass('fa-caret-down');
$('#durationfa').addClass('fa-caret-up');return + a.getAttribute('data-duration') - 
+b.getAttribute('data-duration'); } else {$('#durationfilterid').val('1'); 
$('#durationfa').removeClass('fa-caret-up');
$('#durationfa').addClass('fa-caret-down');return + b.getAttribute('data-duration') - 
+a.getAttribute('data-duration');
}})
.appendTo($wrap); 
}









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

  var $filteredResults = $('.itemlist');
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
  $('.itemlist').hide().filter($filteredResults).show();
});

</script>













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
					  $(".item").hide().filter(function() {
						var price = parseInt($(this).data("price"), 10);
						return price >= minPrice && price <= maxPrice;
					  }).show();
					}

					</script>
					
					<input name="maxprice" id="maxprice" type="hidden" value="<?php echo $maxprice; ?>">
					<input name="minprice" id="minprice" type="hidden" value="<?php echo $minprice; ?>">
					
					
					
					
					
					
	<script>
function showratetablebox(id){
var morefrebt = $('#morefrebt'+id).text();
if(morefrebt=='+ More Fare'){
$('#ratetablebox'+id).css('height','auto');
$('#morefrebt'+id).text('- Less Fare');
} else { 
$('#ratetablebox'+id).css('height','52px');
$('#morefrebt'+id).text('+ More Fare');
}
}
</script>