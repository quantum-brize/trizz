<?php  

if($_REQUEST['id']!=''){
 
$a=GetPageRecord('*','flightBookingMaster',' id="'.decode($_REQUEST['id']).'" '); 
$editresult=mysqli_fetch_array($a); 


$urs=GetPageRecord('*','sys_userMaster',' id="'.$editresult['agentId'].'" '); 
$agentData=mysqli_fetch_array($urs); 
} 
 
 
$ag=GetPageRecord('*','flight_booking_ssr_details',' BookingId="'.$editresult['id'].'" ');  
$ssrprice=mysqli_fetch_array($ag);
 $segmentsDataArr=(array) unserialize(stripslashes($editresult['searchArrey']));
  
$originteminal=$segmentsDataArr['Segments'][0][0]['Origin']['Airport']['Terminal'];
$originairport=$segmentsDataArr['Segments'][0][0]['Origin']['Airport']['AirportName'];
$destinationteminal=$segmentsDataArr['Segments'][0][0]['Destination']['Airport']['Terminal'];
$destinationairport=$segmentsDataArr['Segments'][0][0]['Destination']['Airport']['AirportName'];
$baggage=$segmentsDataArr['Segments'][0][0]['Baggage'].', '.$segmentsDataArr['Segments'][0][0]['CabinBaggage'];
$CabinClass=$segmentsDataArr['Segments'][0][0]['CabinClass'];

function getcabin($id){

if($id==2){ 
$cabin='Economy';
}
if($id==3){ 
$cabin='Premium Economy';
}
if($id==4){ 
$cabin='Business';
}
if($id==6){ 
$cabin='First Class';
} 
return $cabin;
}
?>

<div id="DivIdToPrint">
<style>
@media print {
table tr td { font-family:Arial, Helvetica, sans-serif;  font-size:13px; }
}
@page { margin: 0; }
.multiflightbox{  margin-left:0px; margin-right:0px; margin-bottom:10px;}
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


<table width="100%" border="1" cellpadding="20" cellspacing="0" bordercolor="#CCCCCC">
  <tr>
    <td colspan="3"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      
      
      <tr>
        <td style="font-size:20px; font-weight:500;">
		 
		
			<img src="<?php echo $imgurl; ?><?php echo $agentData['companyLogo']; ?>" height="55">		
	 
		
		
		      </td>
        <td width="50%" align="right">
 
		<strong style="font-size:18px;"><?php if($agentData['websiteUser']==1){  echo stripslashes($agentData['firstName'].' '.$agentData['lastName']); } else {  echo stripslashes($agentData['companyName']); }  ?></strong><br>

          

<strong> </strong> <?php echo stripslashes($agentData['phone']); ?><br>
<strong> </strong> <?php echo stripslashes($agentData['email']); ?><br />
</strong> <?php echo stripslashes($agentData['address']); ?>  </td>
      </tr>
      
    </table></td>
    </tr>
  <tr>
    <td colspan="3"><table width="100%" border="1" cellpadding="10" cellspacing="0" bordercolor="#000000">
      <tr>
        <td colspan="2" align="left" valign="top">
		Booking Status: <strong> <?php if($editresult['status']==1 || $editresult['status']==0){ ?>
          Pending
          <?php } ?>
          <?php if($editresult['status']==2){ ?>
          Confirmed
          <?php } ?>
          <?php if($editresult['status']==3){ ?>
          Cancelled
          <?php } ?></strong>  <br />Booking Id: <strong><?php echo encode($editresult['id']); ?></strong>  <br />
          Booking Type: <strong>Refundable</strong>  <br />
          Booking Time: <?php echo date('D, j M Y', strtotime($editresult['bookingDate']));  ?></td>
        <td width="50%" align="center" valign="top"><table width="100%" border="0" cellpadding="10" cellspacing="0">
          <tr>
            <td colspan="2" align="center"><img src="<?php echo $imgurl.getflightlogo(stripslashes($editresult['flightName'])); ?>" height="45"></td>
            <td width="50%" align="center">
			<div style="font-size:18px; color:#000; text-transform:uppercase;"><?php echo $editresult['pnrNo']; ?></div>
			<div style="font-size:11px; color:#666666; text-transform:uppercase;">Airline PNR</div> </td>
          </tr>
          
        </table></td>
      </tr>
      
    </table>
	
	
	
	<div style="margin:10px 0px; color:#000000; font-weight:500; text-align:left;">Flight Details</div>
    	
    	<?php if($editresult['searchArrey']!='' ){ ?>
    	 
    	  
    	  
    	  
    	  
    	   <?php  if($editresult['apiType']=='tbo' && $editresult['searchArrey']!=''){ 
    		
    	 	$d=1;
    		
    		$segmentsDataArr=(array) unserialize(stripslashes($editresult['searchArrey']));
    		// echo '<pre>';
    		//  print_r($segmentsDataArr);
    		
    		$numberOfStop=count($segmentsDataArr['Segments'][0]);
    		if(count($numberOfStop)>0)
    		{
    		
    			foreach($segmentsDataArr['Segments'][0] as $segmentsDataArrValue)
    			{
    		 
    			
    		?>
    		
    		<div class="row multiflightbox">
     <?php if($d>1){?>
      <div style="text-align: center; color: #0b0b0b; padding: 5px; background-color: #e4f8ff; font-weight: 600; border-radius: 24px;    margin-bottom: 10px;"><?php 
      
      $lastdep=date('Y-m-d H:i:s',strtotime($segmentsDataArrValue['Origin']['DepTime']));
      
      $datetime1 = new DateTime($lastdep);
    $datetime2 = new DateTime($lastarr);
    $interval = $datetime1->diff($datetime2);
    $elapsed = $interval->format(' %h:%i hours');
    echo 'Layover time: '.$elapsed;
      
      ?></div>
     <?php } ?>
    		
    <div class="col-3">
     <table border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="2" style="padding:10px;"><img src="<?php echo $imgurl.getflightlogo(stripslashes( $segmentsDataArrValue['Airline']['AirlineName'])); ?>" width="32" height="32"></td>
        <td>
    	<div class="flightname"><?php echo $segmentsDataArrValue['Airline']['AirlineName']; ?> </div>
    	<div class="flightnumber"><?php echo $segmentsDataArrValue['Airline']['AirlineCode']; ?> <?php echo $segmentsDataArrValue['Airline']['FlightNumber']; ?></div>
    	<div class="flightnumber"><strong>Cabin:</strong> <?php echo getcabin($segmentsDataArrValue['CabinClass']); ?></div>
    	
    	</td>
      </tr>
    </table>
    
    </div>
    
    <div class="col-9">
     <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="33%" align="left">
    	 
    	<div class="coltime" style="font-size:12px;"><?php echo date('H:i',strtotime($segmentsDataArrValue['Origin']['DepTime'])); ?> - <?php echo date('d-m-Y',strtotime($segmentsDataArrValue['Origin']['DepTime']));  ?></div>
    	<div class="graysmalltext" style="font-size:11px;"> 
    	
    	<?php
    
    	$rs=GetPageRecord('*','flightDestinationMaster',' airportCode="'.$segmentsDataArrValue['Origin']['Airport']['CityCode'].'"'); 
    $rscodearr=mysqli_fetch_array($rs); ?>
    	
    	(<?php echo $segmentsDataArrValue['Origin']['Airport']['CityCode']; ?>) <?php echo strip($rscodearr['city']); ?><br /><?php echo strip($segmentsDataArrValue['Origin']['Airport']['AirportName']); ?><?php if($segmentsDataArrValue['Origin']['Airport']['Terminal']!=''){ ?> 
    	<div style="color:#009900;">Terminal: <?php echo $segmentsDataArrValue['Origin']['Airport']['Terminal']; ?></div><?php } ?></div>	</td>
        <td width="33%" align="left"> 
    		<div class="coltime" style="font-size:12px;"><?php echo date('H:i',strtotime($segmentsDataArrValue['Destination']['ArrTime'])); ?> - <?php echo date('d-m-Y',strtotime($segmentsDataArrValue['Destination']['ArrTime'])); $lastarr=date('Y-m-d H:i:s',strtotime($segmentsDataArrValue['Destination']['ArrTime'])); ?></div>
    	<div class="graysmalltext"  style="font-size:11px;">
    	<?php
    
    	$rs=GetPageRecord('*','flightDestinationMaster',' airportCode="'.$segmentsDataArrValue['Destination']['Airport']['CityCode'].'"'); 
    $rscodearr=mysqli_fetch_array($rs); ?>
    	
    	(<?php echo $segmentsDataArrValue['Destination']['Airport']['CityCode']; ?>) <?php echo strip($rscodearr['city']); ?><br /><?php echo strip($segmentsDataArrValue['Destination']['Airport']['AirportName']); ?> 
    	
    	<?php if($segmentsDataArrValue['Destination']['Airport']['Terminal']!=''){ ?> 
    	<div style="color:#009900;">Terminal: <?php echo $segmentsDataArrValue['Destination']['Airport']['Terminal']; ?></div><?php } ?></div></td>
        <td width="33%" align="left" valign="top"><strong>Duration:</strong> <?php echo sprintf("%d:%02d",   floor($segmentsDataArrValue['Duration']/60), $segmentsDataArrValue['Duration']%60);  ?> Hour(s)<br />
           <strong>Checkin Baggage: </strong><?php echo $segmentsDataArrValue['Baggage']; ?><br />
    	   <strong>Cabin Baggage:</strong> <?php echo $segmentsDataArrValue['CabinBaggage']; ?>
         </td>
      </tr>
    </table>
    
    </div>
    
     
    </div>
    			
    		<?php
    		
    		$j++; 	$d++; }
    		}
    		
    		
    		$ss=1;
    		$numberOfStop=count($segmentsDataArr['Segments'][1]);
    		if(count($numberOfStop)>0)
    		{ 
    		$Rhh=1;
    			foreach($segmentsDataArr['Segments'][1] as $segmentsDataArrValue)
    			{
    			if($Rhh==1){
    			?>
    		
    	<div style="padding: 5px 10px; background-color: #f1f1f1; font-weight: 700; margin-bottom: 10px; margin-top:10px;">Return Flight</div>
    		<?php
    		
    		}
    		?>
    		
    		<div class="row multiflightbox">
     <?php if($ss>1){?>
      <div style="text-align: center; color: #0b0b0b; padding: 5px; background: #e4f8ff; font-weight: 600; border-radius: 24px; margin-top:20px;"><?php 
      
      $lastdep=date('Y-m-d H:i:s',strtotime($segmentsDataArrValue['Origin']['DepTime']));
      
      $datetime1 = new DateTime($lastdep);
    $datetime2 = new DateTime($lastarr);
    $interval = $datetime1->diff($datetime2);
    $elapsed = $interval->format(' %h:%i hours');
    echo 'Layover time: '.$elapsed;
      
      ?></div>
     <?php } ?>
    		
    <div class="col-3">
     <table border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="2" style="padding:10px;"><img src="<?php echo $imgurl.getflightlogo(stripslashes( $segmentsDataArrValue['Airline']['AirlineName'])); ?>" width="32" height="32"></td>
        <td>
    	<div class="flightname"><?php echo $segmentsDataArrValue['Airline']['AirlineName']; ?> </div>
    	<div class="flightnumber"><?php echo $segmentsDataArrValue['Airline']['AirlineCode']; ?> <?php echo $segmentsDataArrValue['Airline']['FlightNumber']; ?></div>
    	
    	<div class="flightnumber"><strong>Cabin:</strong> <?php echo getcabin($segmentsDataArrValue['CabinClass']); ?></div>
    	
    	</td>
      </tr>
    </table>
    
    </div>
    
    <div class="col-9">
     <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="33%" align="left">
    	 
    	<div class="coltime" style="font-size:12px;"><?php echo date('H:i',strtotime($segmentsDataArrValue['Origin']['DepTime'])); ?> - <?php echo date('d-m-Y',strtotime($segmentsDataArrValue['Origin']['DepTime']));  ?></div>
    	<div class="graysmalltext"   style="font-size:11px;"> 
    	
    	<?php
    
    	$rs=GetPageRecord('*','flightDestinationMaster',' airportCode="'.$segmentsDataArrValue['Origin']['Airport']['CityCode'].'"'); 
    $rscodearr=mysqli_fetch_array($rs); ?>
    	
    	(<?php echo $segmentsDataArrValue['Origin']['Airport']['CityCode']; ?>) <?php echo strip($rscodearr['city']); ?><br /><?php echo strip($segmentsDataArrValue['Origin']['Airport']['AirportName']); ?><?php if($segmentsDataArrValue['Origin']['Airport']['Terminal']!=''){ ?> 
    	<div style="color:#009900;">Terminal: <?php echo $segmentsDataArrValue['Origin']['Airport']['Terminal']; ?></div><?php } ?>
    	</div>	</td>
        <td width="33%" align="left"> 
    		<div class="coltime" style="font-size:12px;"><?php echo date('H:i',strtotime($segmentsDataArrValue['Destination']['ArrTime'])); ?> - <?php echo date('d-m-Y',strtotime($segmentsDataArrValue['Destination']['ArrTime'])); $lastarr=date('Y-m-d H:i:s',strtotime($segmentsDataArrValue['Destination']['ArrTime'])); ?></div>
    	<div class="graysmalltext"   style="font-size:11px;">
    	<?php
    
    	$rs=GetPageRecord('*','flightDestinationMaster',' airportCode="'.$segmentsDataArrValue['Destination']['Airport']['CityCode'].'"'); 
    $rscodearr=mysqli_fetch_array($rs); ?>
    	
    	(<?php echo $segmentsDataArrValue['Destination']['Airport']['CityCode']; ?>) <?php echo strip($rscodearr['city']); ?><br /><?php echo strip($segmentsDataArrValue['Destination']['Airport']['AirportName']); ?><?php if($segmentsDataArrValue['Destination']['Airport']['Terminal']!=''){ ?> 
    	<div style="color:#009900;">Terminal: <?php echo $segmentsDataArrValue['Destination']['Airport']['Terminal']; ?></div><?php } ?></div></td>
        <td width="33%" align="left" valign="top"><strong>Duratino:</strong> <?php echo sprintf("%d:%02d",   floor($segmentsDataArrValue['Duration']/60), $segmentsDataArrValue['Duration']%60);  ?>  Hour(s)<br />
           <strong>Checkin Baggage: </strong><?php echo $segmentsDataArrValue['Baggage']; ?><br />
    	   <strong>Cabin Baggage:</strong> <?php echo $segmentsDataArrValue['CabinBaggage']; ?>
         </strong></td>
      </tr>
    </table>
    
    </div>
    
     
    </div>
    			
    		<?php
    		
    		$j++; 	$d++; $ss++; $Rhh++; }
    		}
    		
     
    	  
    	  
    	  } ?>
	<?php } else { ?>
	<table width="100%" border="1" cellpadding="4" cellspacing="0" bordercolor="#000000">
      <tr>
        <td>Flight</td>
        <td>Departure</td>
        <td>Arrival</td>
        <td> Stop </td>
        <td>Baggage / Cabin</td>
        <td>Class</td>
      </tr>
      <tr>
        <td align="left" valign="top"><div style="font-size:14px; font-weight:500; color:#000000;"><?php echo $editresult['flightName']; ?></div>
<?php echo $editresult['flightNo']; ?> </td>
        <td align="left" valign="top">
		<div style="font-size:14px; font-weight:500; color:#000000;"><?php echo date('D, j M Y', strtotime($editresult['journeyDate'])); ?>, <?php echo $editresult['departureTime']; ?></div>
		<?php  $fareType=explode('-',$editresult['source']); 
 			echo getflightdestination($fareType[1]); ?> - Terminal: <?php echo $editresult['flightTerminal']; ?></td>
        <td align="left" valign="top">
		<div style="font-size:14px; font-weight:500; color:#000000;"><?php echo date('D, j M Y', strtotime($editresult['arrivalDate'])); ?>, <?php echo $editresult['arrivalTime']; ?></div>
		<?php  $fareType=explode('-',$editresult['destination']);  echo getflightdestination($fareType[1]); ?><br></td>
        <td align="left" valign="top"><div style="font-size:14px; font-weight:500; color:#000000;"><?php echo $editresult['flightStop']; ?> Stop(s)</div></td>
        <td align="left" valign="top"><?php echo $editresult['totalBaggage']; ?></td>
        <td align="left" valign="top"><strong><?php echo $editresult['fareClass']; ?></strong></td>
      </tr>
    </table>
	<?php } ?>
	
	<div style="margin:10px 0px; color:#000000; font-weight:500; text-align:left;">Traveller's Details</div>
	
	<table width="100%" border="1" cellpadding="4" cellspacing="0" bordercolor="#000000">
      <tr>
        <td width="5%" align="center"><strong>Sr.</strong></td>
        <td><strong>Type</strong></td>
        <td colspan="2"><strong>Passenger&nbsp;Name</strong></td>
        <td><strong>PNR & Ticket No</strong></td>
        <td><strong>Seat</strong></td>
        <td><strong>Meal</strong></td>
        <td><strong>Extra&nbsp;Baggage</strong></td>
      </tr>
	  <?php 
	  $ns=1;
		$rs6=GetPageRecord('*','flightBookingPaxDetailMaster',' BookingId="'.$editresult['id'].'" and firstName!="" '); 
		while($paxData=mysqli_fetch_array($rs6)){
	  ?>
      <tr>
        <td width="5%" align="center"><?php echo $ns; ?></td>
        <td><?php echo ucfirst($paxData['paxType']); ?></td>
        <td colspan="2" style="text-transform:uppercase;"><strong><?php echo $paxData['title']; ?>&nbsp;<?php echo $paxData['firstName']; ?>&nbsp;<?php echo $paxData['lastName']; ?></strong></td>
        <td><?php echo $editresult['pnrNo']; ?> <?php if($paxData['ticketNo']!=''){ echo '-'; ?><?php echo $paxData['ticketNo']; } ?></td>
        <td><?php echo stripslashes($paxData['seatAdultCode']); ?></td>
        <td><?php  $meal=explode(",",stripslashes($paxData['meal'])); echo $meal[0].', '.$meal[1]; ?></td>
        <td><?php  $baggages=explode(',',stripslashes($paxData['baggage'])); echo $baggages[0]; ?></td>
      </tr>
	  <?php $ns++; } ?>
    </table>
	
	
	
	<div style="margin:10px 0px; color:#000000; font-weight:500; text-align:left;">Fare Details</div>
	
	<table width="100%" border="1" cellpadding="4" cellspacing="0" bordercolor="#CCCCCC">
      <tr>
        <td width="25%"><strong>Basic Fare</strong></td>
        <td colspan="2">Rs.<?php echo number_format($editresult['agentBaseFare']); ?></td>
        </tr>
      <tr>
        <td width="25%"><strong>Taxes </strong></td>
        <td colspan="2">Rs.<?php echo number_format($editresult['agentTax']); ?></td>
      </tr>
     <?php if($editresult['seatPrice']>0){ ?> <tr>
        <td><strong>Seat Charges </strong></td>
        <td colspan="2">Rs.<?php echo number_format($editresult['seatPrice']); ?></td>
      </tr>
	  <?php } ?>
	     <?php if($editresult['mealPrice']>0){ ?> 
      <tr>
        <td><strong>Meal Charges </strong></td>
        <td colspan="2">Rs.<?php echo number_format($editresult['mealPrice']); ?></td>
      </tr>
	    <?php } ?>
		    <?php if($editresult['extraBaggagePrice']>0){ ?> 
      <tr>
        <td><strong>Extra Baggage Charges </strong></td>
        <td colspan="2">Rs.<?php echo number_format($editresult['extraBaggagePrice']); ?></td>
      </tr>
	      <?php } ?>
      <tr>
        <td width="25%"><strong>Total Fare </strong></td>
        <td colspan="2">Rs.<?php echo number_format($editresult['agentTotalFare']);  ?></td>
      </tr>
    </table>
	
	<div style="margin:10px 0px; color:#000000; font-weight:500; text-align:left;">Important Information</div>
	1). For departure terminal please check with the airline first.<br />
2). You must download & register on the Aarogya Setu App and carry a valid ID.<br />
3). It is mandatory to wear a mask and carry other protective gear.<br />
4). Use the Airline PNR for all Correspondence directly with the Airline.<br />
5). You must web check-in on the airline website and obtain a boarding pass.<br />
6). Date & Time is calculated based on the local time of the city/destination.<br />
7). For rescheduling/cancellation within 4 hours of the departure time contact the airline directly.<br />
8). Your ability to travel is at the sole discretion of the airport authorities and we shall not be held responsible.<br />
9). Reach the terminal at least 2 hours prior to the departure for domestic flight and 4 hours prior to the departure
of international flight
	</td>
  </tr>
</table>

</div>
<div style="text-align: right; width: 100%; margin-top:20px;"><button type="button" class="btn btn-secondary btn-sm" onclick='printDiv();'>Print</button></div>
<script>
function printDiv() 
{

  var divToPrint=document.getElementById('DivIdToPrint');

  var newWin=window.open('','Print-Window');

  newWin.document.open();

  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

  newWin.document.close();
 

}
</script>