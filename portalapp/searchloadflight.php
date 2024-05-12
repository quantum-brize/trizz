<?php
include "inc.php";  


function encode($string) 
{ 
if(trim($string)!='' && trim($string)!='0'){
$encoded=$string+202565517;
//$encoded = base64_encode(base64_encode(base64_encode($string)));  
return  $encoded; 
}
}



function decode($string) 
{ 
if(trim($string)!='' && trim($string)!='0'){
$decoded=$string-202565517;
//$decoded = base64_decode(base64_decode(base64_decode($string)));  
return  $decoded; 
}
}

  $url = $basesiteurl."flightsearchpage_mobile.php"; 
 $ch = curl_init($url);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);

		$data = array(
		'MemberId' => $_SESSION['userId'],
		'searcharray' =>  json_encode($_REQUEST)
); 

curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
$contents = curl_exec($ch);
$contentres=json_decode($contents,true); 
curl_close($ch); 
 
 
  ?>
<style>
#contenttabs{overflow:hidden; border-bottom:2px solid #ddd; margin-bottom:5px; text-align:center;}
#contenttabs a { border: 1px solid #ddd; border-bottom: 0px; font-weight: 600; font-size: 16px; width: 45%; padding: 10px 0px; text-align: center; margin: 0px 5px; background-color: #fff; display: inline-block; border-top-left-radius:4px; border-top-right-radius:4px;}
#contenttabs .active{background-color: var(--base-color); color:#FFFFFF !important;}
#selectflightbar table tr td{padding:10px !important;}
#selectflightbar span{font-weight:600;}
#booknowbtnbox{padding: 7px 9PX; background-color: #fff; border: 0px; border-radius: 5px; font-weight: 600;}
</style>
 
  <div class="mainallcontent">
    <?php if($contentres['tripType']==2){ ?>
  <div id="contenttabs">
  <a class="active" id="ftab1" onclick="selectflighttabs('ftab1');">Departure</a>
  <a id="ftab2" onclick="selectflighttabs('ftab2');">Return</a>
  </div>
  
  <script>
  function selectflighttabs(id){
  $('#contenttabs a').removeClass('active');
  $('#'+id).addClass('active');
  $('#flightd').hide();
  $('#flightr').hide();
  if(id=='ftab1'){
  $('#flightd').show(); 
  } else {
  $('#flightr').show(); 
  }
  
  }
  
  
  function selectgetdataflight(id,ftype){
  $('#selectflightbar').show();
  var flightnamecode = $('#flightnamecode'+id).html(); 
  $('#'+ftype).html(flightnamecode);
  
  if(ftype=='lleftbox'){
  $('#dflight').val(id);
  }
  if(ftype=='rleftbox'){
  $('#rflight').val(id);
  }
  
  if(Number($('#rflight').val())>0 && Number($('#dflight').val())>0){
  $('#booknowbtnbox').show();
  }
    if(ftype=='lleftbox'){
  var dprice = Number($('#dprice'+id+' span').text());
   $('#dpricefield').val(dprice);
  } else {
  var rprice = Number($('#rprice'+id+' span').text());
    $('#rpricefield').val(rprice);
  }
  
 

  
  var dpricefield = Number($('#dpricefield').val());
  var rpricefield = Number($('#rpricefield').val());
  
  $('#totalselctedflightprice').text(Number(dpricefield+rpricefield));
  }
  
  
  </script>
  
  <?php  } ?>
  
  <div id="flightd">
 <?php 
 $minprice=0;
 $maxprice=0;
 $ns=1;
 $totalhotel=0; foreach($contentres['FlightList'] as $list) { 
 
 if($list['roundTripFlight']==0){
$h=1;

$_SESSION['EndUserIp']=$list['EndUserIp'];
$_SESSION['tbotokenId']=$list['tbotokenId'];
$_SESSION['TraceId']=$list['TraceId'];


?> 
 <div class="card flightsearchcard">
        <div class="flightname">
		<?php if($contentres['tripType']==2){ ?>
		<div class="faretypeflight" style=" background-color:<?php echo $list['fareTypeColor']; ?>;"><?php echo $list['fareType']; ?></div>
		<?php } ?>
		
          <div class="logofl"><img src="<?php echo $list['flightLogo']; ?>"></div>
          <div class="flightnamecode" id="flightnamecode<?php echo encode($list['flightId']); ?>"><span><?php echo $list['flightName']; ?></span> <br><?php echo $list['flightCode']; ?>-<?php echo $list['flightNumber']; ?></div>
        </div>

        <div class="searchcityflight">
          <div>
            <ul>
              <li>
                <div class="bookboxprice">
                  <p class="destination"><?php echo $list['orgCode']; ?></p>
                  <h6><?php echo $list['depTime']; ?></h6>
                </div>
              </li>
              <li>
                <div class="bookboxprice">
                  <h6><?php echo $list['duration']; ?></h6>
                  <p class="destination dest2"><?php if($list['stop']!='Non Stop'){  echo $list['stop'].' Stop(s)';  } else {  echo $list['stop']; } ?></p>
                </div>
              </li>
              <li>
                <div class="bookboxprice">
                  <p class="destination"><?php echo $list['desCode']; ?></p>
                  <h6><?php echo $list['arrTime']; ?></h6>
                </div>
              </li>

            </ul>
          </div>

          <div class="rightprice" id="dprice<?php echo encode($list['flightId']); ?>">
            <h4>&#8377;<span><?php echo $list['displayFare']; ?></span></h4>
           
		<?php if($contentres['tripType']==1){ ?>   
  <a class="selectbtn" style="cursor:pointer;"  onclick="openWindow('<?php echo $fullurl.'flightoption.php?id='.$list['flightId'].''; ?>');"><button type="button" class="btn btn-danger">Select</button></a>
		<?php } else { ?>
		 <a class="selectbtn" style="cursor:pointer;" onclick="selectgetdataflight('<?php echo encode($list['flightId']); ?>','lleftbox');selectflighttabs('ftab2');"><button type="button" class="btn btn-danger">Select</button></a>
		<?php } ?>	
			
          </div>
        </div>


        <ul class="refeconomyul">
           <li class="refundtable"><i class="fa fa-credit-card-alt" aria-hidden="true"></i>&nbsp; <span class="refundablespan" <?php  if($list['refund']=='Non Refundable'){?>style="color:#CC0000;"<?php } ?>><?php echo $list['refund']; ?></span></li>
           <li class="redclr"><i class="fa fa-user-circle-o" aria-hidden="true"></i>&nbsp; <span class="red"> <?php echo $list['seats']; ?> Seat Left </span></li>
		   <?php if($contentres['tripType']==2){ ?> 
		    <li class="redclr" onclick="openWindow('<?php echo $fullurl.'flightbox.php?id='.$list['flightId'].''; ?>');"><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp; <span class="red"> Flight Detail </span></li>
			<?php } ?>
        </ul>
        

      </div>
<?php 
if($list['displayFare']>$maxprice){
  $maxprice=$list['displayFare'];
  }
  
if($ns==1){
$minprice=$list['displayFare'];
}
  

 $totalhotel++;
 
 
  } $ns++; } ?>
</div>

<?php if($contentres['tripType']==2){ ?>
<div id="flightr"  style="display:none;">
 <?php 
 $totalhotel=0; foreach($contentres['FlightList'] as $list) { 
 
 if($list['roundTripFlight']==1){
$h=1;
?> 
 <div class="card flightsearchcard">
        <div class="flightname">
		<?php if($contentres['tripType']==2){ ?>
		<div class="faretypeflight" style=" background-color:<?php echo $list['fareTypeColor']; ?>;"><?php echo $list['fareType']; ?></div>
		<?php } ?>
		
          <div class="logofl"><img src="<?php echo $list['flightLogo']; ?>"></div>
          <div class="flightnamecode"  id="flightnamecode<?php echo encode($list['flightId']); ?>"><span><?php echo $list['flightName']; ?></span> <br><?php echo $list['flightCode']; ?>-<?php echo $list['flightNumber']; ?></div>
        </div>

        <div class="searchcityflight">
          <div>
            <ul>
              <li>
                <div class="bookboxprice">
                  <p class="destination"><?php echo $list['orgCode']; ?></p>
                  <h6><?php echo $list['depTime']; ?></h6>
                </div>
              </li>
              <li>
                <div class="bookboxprice">
                  <h6><?php echo $list['duration']; ?></h6>
                  <p class="destination dest2"><?php if($list['stop']!='Non Stop'){  echo $list['stop'].' Stop(s)';  } else {  echo $list['stop']; } ?></p>
                </div>
              </li>
              <li>
                <div class="bookboxprice">
                  <p class="destination"><?php echo $list['desCode']; ?></p>
                  <h6><?php echo $list['arrTime']; ?></h6>
                </div>
              </li>

            </ul>
          </div>

             <div class="rightprice" id="rprice<?php echo encode($list['flightId']); ?>">
            <h4>&#8377;<span><?php echo $list['displayFare']; ?></span></h4>
            <a class="selectbtn" style="cursor:pointer;"  onclick="selectgetdataflight('<?php echo encode($list['flightId']); ?>','rleftbox');"><button type="button" class="btn btn-danger">Select</button></a>
          </div>
        </div>


        <ul class="refeconomyul">
           <li class="refundtable"><i class="fa fa-credit-card-alt" aria-hidden="true"></i>&nbsp; <span class="refundablespan" <?php  if($list['refund']=='Non Refundable'){?>style="color:#CC0000;"<?php } ?>><?php echo $list['refund']; ?></span></li>
           <li class="redclr"><i class="fa fa-user-circle-o" aria-hidden="true"></i>&nbsp; <span class="red"> <?php echo $list['seats']; ?> Seat Left </span></li>
		    <li class="redclr" onclick="openWindow('<?php echo $fullurl.'flightbox.php?id='.$list['flightId'].''; ?>');"><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp; <span class="red"> Flight Detail </span></li>
        </ul>
        

      </div>
<?php  $totalhotel++; } } ?>
</div>
<?php } ?>

<div style="height:70px; width:100%;"></div>
</div>
<div style="background-color:#000; color:#FFFFFF; position:fixed; left:0px; bottom:0px; width:100%; display:none;" id="selectflightbar">
<table width="100%" border="0" cellpadding="5" cellspacing="0">
  <tr>
    <td id="lleftbox">Not Selected</td>
    <td  ><i class="fa fa-long-arrow-right" aria-hidden="true"></i></td>
    <td id="rleftbox">Not Selected</td>
    <td align="right"><span>Price</span><br />
	<div id="totalselctedflightprice"></div>
</td>
    <td align="right">
	<form method="post" action="flight_booking_mobile.php">
	<button type="submit" id="booknowbtnbox" class="btn btn-danger" style="display:none;">Book Now</button>
	<input name="i" id="dflight" type="hidden" value="0" />
	<input name="r" id="rflight" type="hidden" value="0" />
	<input name="dpricefield" id="dpricefield" type="hidden" value="0" />
	<input name="rpricefield" id="rpricefield" type="hidden" value="0" />
	
	</form>	</td>
  </tr>
</table>

</div>

<script>
$('#totalhotel').text('(<?php echo $totalhotel; ?>)');
</script>

<?php if($h!=1){ ?>
<div style="text-align:center; padding:50px 0px; font-size:15px; font-weight:600;">No Flight Found</div>
<?php } ?>
 
 
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
					
					
 