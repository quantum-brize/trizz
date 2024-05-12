<?php
	$segR=unserialize(stripslashes($res['roundIntInboundJson']));
	//$segR = $valArray['Segments'][1];
	
	
		unset($inbound);
		foreach($segR as $segmentR)
		{
			$inbound[] = $segmentR;		
		}
		
	$originCityR = $inbound[0]['Origin']['Airport']['CityName'];	
	$deptimeR = $inbound[0]['Origin']['DepTime'];	
		
	$ibound2=$inbound[count($inbound)-1];
	
	$desitnationstopcityR = $ibound2['Destination']['Airport']['CityName'];
	//$destination_codeR= $ibound['Destination']['Airport']['AirportCode']." ".$desitnationstopcityR;
	$destination_cityR= $ibound2['Destination']['Airport']['CityName'];
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
		
		
?>
<div class="card-header">
    <?php echo $originCityR; ?> <i class="fa fa-long-arrow-right" aria-hidden="true"></i> <?php echo $desitnationstopcityR; ?> <span>on  <?php echo date('D, M d Y',strtotime($deptimeR)); ?> &nbsp;&nbsp;&nbsp;<i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;<?php echo $durationHourMinstR; ?></span>
  </div>
<div class="card-body">
<div class="detailscontent">
<div class="row">
<div class="col-12">

<?php
$j=0; 

$outbound2= $inbound;

foreach($outbound2 as $obound)
{


                        //echo '<pre>';print nl2br(print_r($outbound, true));echo '</pre>';

                        $NoOfSeatAvailable = $obound['NoOfSeatAvailable'];  
                        $Baggage = $obound['Baggage'];
                        $CabinBaggage = $obound['CabinBaggage'];
                        $SegmentIndicator = $obound['SegmentIndicator'];
                		$journeytime= $obound['Duration'];
                        $fdurhour= floor($journeytime/60); 
                        $fdurmint= $journeytime% 60; 
                        $deptime = $obound['Origin']['DepTime'];
                    	$depcity = $obound['Origin']['Airport']['CityName'].", ".$obound['Origin']['Airport']['CountryName']."(".$obound['Origin']['Airport']['AirportCode'].")";

        			    $depcityy = $obound['Origin']['Airport']['CityName'];
        			    $depTerminal = $ibound['Origin']['Airport']['Terminal'];
       			    	$tm1 = date('H:i',strtotime($deptime));
       			    	$dtms1 = date('D, d M',strtotime($deptime));
        				$dt1 = date('D, d M Y',strtotime($deptime));
        				$arrtime = $obound['Destination']['ArrTime'];
               	    	$arrcity = $obound['Destination']['Airport']['CityName'].", ".$obound['Destination']['Airport']['CountryName']."(".$obound['Destination']['Airport']['AirportCode'].")";
                	    $arrcityy = $obound['Destination']['Airport']['CityName'];
                	    $arrTerminal = $ibound['Destination']['Airport']['Terminal'];
                	    $tm2 = date('H:i',strtotime($arrtime));
                	    $dt2 = date('D, d M Y',strtotime($arrtime));
                	    $AirlineCode = $airlinecode = $obound['Airline']['AirlineCode'];
                	    $airline = $obound['Airline']['AirlineName'];
                	    $airlinenum = $airlinecode."-".$obound['Airline']['FlightNumber']." ".$obound['Airline']['FareClass'];
                	    $FlightNumber= $obound['Airline']['FlightNumber'];
						
						$ssrSeatFlight2=$obound['Origin']['Airport']['AirportCode']."-".$obound['Destination']['Airport']['AirportCode']." : ".$airlinecode." ".$FlightNumber;
	
?>
<div class="row multiflightbox">
<div class="col-3">
 <table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"><img src="<?php echo $imgurl.getflightlogo(stripslashes($resret['FLIGHT_NAME'])); ?>" width="32" height="32"></td>
    <td>
	<div class="flightname"><?php echo $airline; ?> </div>
	<div class="flightnumber"><?php echo $airlinecode; ?> <?php echo $FlightNumber; ?></div>
	
	</td>
  </tr>
</table>

</div>

<div class="col-9">
 <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="33%" align="center">
	<div class="coltime">
	<?php echo $dt1; ?> <?php echo $tm1; ?></div>
	<div class="graysmalltext">
	<?php echo  $depcity; ?></div>
	</td>
    <td width="33%" align="center"><div class="nostops"><?php echo $fdurhour .'H , ' . $fdurmint.'M' ; ?></div> <div style="margin-top:2px;">Non-Stop</div></td>
    <td width="33%" align="center"><div class="coltime">
	<?php echo $dt2; ?> <?php echo $tm2;?></div>
	<div class="graysmalltext">
	<?php echo $arrcity; ?><br>
</div></td>
  </tr>
</table>

</div>

<?php
  
if($Baggage!="")
{
?>
<div style="margin:0px 0px;"><i class="fa fa-suitcase" aria-hidden="true"></i> <?php echo 'Baggage:'. $Baggage. ", Cabin Baggage: ".$CabinBaggage;
}
 ?>

</div>
<?php if($layoverFlight->LAYOVER_INFO!=''){ ?>
  <div style="text-align: center; color: #0b0b0b; padding: 5px; background-color: #e4f8ff; font-weight: 600; border-radius: 24px; margin-top:20px;margin-bottom:20px;"><?php echo $layoverFlight->LAYOVER_INFO; ?></div>
<?php } ?>
</div>

<?php  $j++; }  ?>
	
	  
<?php if($j==0){ ?>

<div class="row multiflightbox">
<div class="col-4">
 <table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"><img src="<?php echo $imgurl.getflightlogo(stripslashes($resret['FLIGHT_NAME'])); ?>" width="32" height="32"></td>
    <td>
	<div class="flightname"><?php echo stripslashes($resret['FLIGHT_NAME']); ?></div>
	<div class="flightnumber"><?php echo stripslashes($resret['FLIGHT_CODE']); ?>-<?php echo stripslashes($resret['FLIGHT_NO']); ?></div>
	
	</td>
  </tr>
</table>

</div>

<div class="col-8">
 <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="33%" align="center">
	<div class="coltime">
	<?php echo date('D, M d Y',strtotime(unserialize(stripslashes($resret['searchJson']))->D_DATE)); ?> <?php echo stripslashes($resret['DEP_TIME']); ?></div>
	<div class="graysmalltext">
	<?php echo stripslashes($resret['ORG_NAME']); ?></div>
	</td>
    <td width="33%" align="center"><div class="nostops"><?php echo $resret['DUR']; ?></div><div class="graysmalltext"><?php if($resret['STOP']==0){ ?>
			Non Stop<?php  }else{ ?><span style="color:#bf0000 !important;"><?php echo $resret['STOP'].' Stop '; ?></span><?php } ?></div></td>
    <td width="33%" align="center"><div class="coltime">
	<?php echo date('D, M d Y',strtotime(unserialize(stripslashes($resret['searchJson']))->A_DATE)); ?><?php echo stripslashes($resret['ARRV_TIME']); ?></div>
	<div class="graysmalltext">
	<?php echo stripslashes($resret['DES_NAME']); ?></div></td>
  </tr>
</table>

</div>
</div>

<?php
  
$arr=explode("|",unserialize(stripslashes($resret['searchJson']))->FLIGHT_INFO)
?>
<div style=" margin-top:20px;"><i class="fa fa-suitcase" aria-hidden="true"></i> <?php echo str_replace(':',': ',str_replace(',',', ',str_replace('=',': ',$arr[2]))); ?></div>
<?php } ?>



 
<div class="col-12" style="margin-top:20px;">
<button type="button" class="btn btn-outline-secondary btn-sm farerulebtn2" onClick="showfarerule2('<?php echo $ResultIndex2; ?>');">Show Fare Rules</button>
</div> 
 <div style=" display:none;" id="showfarerule2"></div>

</div>
</div>

</div>
</div>