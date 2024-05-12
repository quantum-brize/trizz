<?php 
include "inc.php"; 
include "config/logincheck.php"; 
$page='hotels';
$selectedpage='hotels';
$agentid=$_SESSION['agentUserid']; 


$a=GetPageRecord('*','hotelMaster',' id="'.decode($_REQUEST['hotelSearchId']).'"'); 
$rest=mysqli_fetch_array($a);


$numberOfNights=$_REQUEST['nights'];
$adultCount=$_REQUEST['ad'];
$childCount=$_REQUEST['cd'];



$starcategory='3, 4 Star';
if($_REQUEST['starcategory']!=''){
$starcategory=$_REQUEST['starcategory'];
}
 
if($_REQUEST['checkInDate']!=''){
 $checkInDate=$_REQUEST['checkInDate'];
}
  
 
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




 $date1 = new DateTime($checkInDate);
			$date2 = new DateTime($checkOutDate); 
			$numberOfNights= $date2->diff($date1)->format("%a");
			if($numberOfNights==0){ $numberOfNights=1; }
			
			
$numun = 'MN-'.str_pad(mt_rand(1,9999),4,'0',STR_PAD_LEFT).'-'.time();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<title><?php echo stripslashes($rest['name']); ?> - Hotel - <?php echo stripslashes($getcompanybasicinfo['companyName']); ?></title>
<?php include "headerinc.php"; ?>

<link rel="stylesheet" href="dist/css/lightbox.min.css">
 
 
</head>

<body id="hotelview">

<?php include "header.php"; ?>

 
 <section class="hotelgallery phonehotelgallery">
        <div class="container phonehoteldetailcontainer">
		<div class="hoteldetail">
                <div class="hoteldetailone">
                    <div class="topheading">
                     
                            <h1> <?php echo stripslashes($rest['name']); ?> <span class="starcatht" style="font-size:18px; color:#FF9900;"><?php for($i=1; $i<=$rest['category']; $i++){ ?>
						 <i class="fa fa-star" aria-hidden="true"></i>
						   <?php } ?></h1>
                        
                         
                    </div>
                    <p><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;
                            <?php echo $rest['address']; ?>, <?php echo $rest['cityName']; ?>
                            </p>
                     
                </div>
                <div class="hoteldetailtwo">
                    <div class="roompricing">
                        <div style="margin-top: 20px;">
                            <h3><strong id="toppriceht">0</strong></h3>
                            <p>Best Price</p>
                        </div>
                        <a href="#pricelist"><button type="button">Select Room</button></a>
                    </div>
                </div>
            </div>
		
		
		
		<div class="row hoteldetailrow">
                <div class="col-lg-5">
                    <div class="roomoneimg borderleft">
                       <img src="<?php if($rest['hotelPhoto']!=''){  echo $imgurl.$rest['hotelPhoto'];  } else { echo 'images/NoImageFound.png'; } ?>" class="htphoto" onerror="imgError(this);"  >
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="roomtwoimg">
                       
	
	<img src="<?php if($rest['hotelPhoto2']!=''){  echo $imgurl.$rest['hotelPhoto2'];  } else { echo 'images/NoImageFound.png'; } ?>" class="htphoto" onerror="imgError(this);"  > 
	<img src="<?php if($rest['hotelPhoto3']!=''){  echo $imgurl.$rest['hotelPhoto3'];  } else { echo 'images/NoImageFound.png'; } ?>" class="htphoto" onerror="imgError(this);"  > 

	
 
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="roomoneimg borderright">
                
	
	<img src="<?php if($rest['hotelPhoto4']!=''){  echo $imgurl.$rest['hotelPhoto4'];  } else { echo 'images/NoImageFound.png'; } ?>" class="htphoto" onerror="imgError(this);"  > 

	
 
  
                        <div class="camerabox">
                            <i class="fa fa-camera" aria-hidden="true"></i>
                            <p>View All</p>
                        </div>

                    </div>
                </div>
            </div>
			
			
			<div class="card descriptioncard">
                <div class="card-body">
                    <div class="description">
                        <h1>Stay <span>Details</span></h1>
                        <p>
                            <?php echo nl2br(stripslashes($rest['hotelDetails'])); ?></p>
                    </div>
                    <div class="stayamentites">
                        <h1>Stay <span>Amentities</span></h1>
                        <table>
                            <tbody><tr>
                             
                                <td><i class="fa fa-bed" aria-hidden="true"></i><br><span>Rest</span></td>
                                <td><i class="fa fa-bath" aria-hidden="true"></i><br> <span>Bathroom</span></td>
                               <td><i class="fa fa-cutlery" aria-hidden="true"></i><br><span>Restaurant</span></td>
                                <td><i class="fa fa-wifi" aria-hidden="true"></i><br><span>Wifi</span></td>
        
                                <td><i class="fa fa-beer" aria-hidden="true"></i><br><span>Tea Maker</span></td>
                                <td><i class="fa fa-car" aria-hidden="true"></i><br><span>Parking</span></td>
                                </tr>
                        </tbody></table>
                    </div>
                </div>
            </div>
			
			
			<div class="roomtable" id="pricelist">
                <table class="firstrtable">
                    <tbody><tr>
                        <td>Room</td>
                        <td>Inclusion</td>
                        <td>Cancellation</td>
                        <td>Total Price</td>
                    </tr>
                </tbody></table>
                <table class="secondrtable">
                    <tbody>
					 <?php 
					  $n=1;
			$roomCount = 1;
			$rstop=GetPageRecord('*','sys_HotelRoomTypeCost',' hotelId="'.$rest['id'].'" and validFrom<="'.date('Y-m-d', strtotime($_REQUEST['checkInDate'])).'" and validTo>="'.date('Y-m-d', strtotime($_REQUEST['checkOutDate'])).'" order by adultCost asc');
			while($hotelPricetop=mysqli_fetch_array($rstop)){ $roomCount++;
			
		
	 		
			$baseFare=0;
			$adultCost=0;
			$childCost=0;
			if($adultCount>0){
			$adultCost=($hotelPricetop['adultCost']*$adultCount);
			}
			if($childCount>0){
			$childCost=($hotelPricetop['childCost']*$childCount);
			}  
			    $baseFare=((($adultCost+$childCost)*trim($_REQUEST['empcount']))*$numberOfNights); 
			$hotelCost=calculatehotelcost(encode($agentid),stripslashes($rest['name']),$baseFare,'0');
			
			if($count==1){
			$minprice=$hotelCost[2];
			}
			
			if($hotelCost[2]>$maxprice){
			$maxprice=$hotelCost[2];
			}
			
			
			
			
			$numberroom=1;
				$finalroomcost=0;
				$age1=0;
				$age2=0;
				foreach(range($_REQUEST['empcount']-1,$columns) as $index) {
				
				$adult=$_GET['noadults'.$numberroom];
				$child=$_GET['nochilds'.$numberroom];
				$age1=$_GET['age1'.$numberroom];
				$age2=$_GET['age2'.$numberroom];
	
	
$rs=GetPageRecord('*','sys_HotelRoomTypeCost',' hotelId="'.$rest['id'].'" and id="'.$hotelPricetop['id'].'" and maxPax<3 and rooms>0 and validFrom<="'.date('Y-m-d', strtotime($checkInDate)).'" and validTo>="'.date('Y-m-d', strtotime($checkOutDate)).'" order by adultCost asc');
$hotelPrice=mysqli_fetch_array($rs); 

				$adultcost=0;
				$childcost1=0;
				$childcost2=0;
				
					$childcostone=0;
				$childcosttwo=0; 
				
				
				 
				
				if($adult<3 && $hotelPrice['id']>0){
			
		 		
				 $adultcost=$hotelPrice['adultCost']+($hotelPrice['mealCost']*$adultCount);
				
				if($age1<3 && $child>0){
				$childcostone=$hotelPrice['infantCost'];
				}

				if($age1>2 && $child>0){
				$childcostone=$hotelPrice['childCost']+($hotelPrice['mealCost']*$adultCount);
				}
				
				if($age2>2 && $child==2){
				$childcosttwo=$hotelPrice['childCost']+($hotelPrice['mealCost']*$adultCount);
				} 
				if($age2<3 && $child==2){
				$childcosttwo=$hotelPrice['infantCost'];
				} 
				
				
				
			 
		  $finalroomcost+=($adultcost+$childcostone+$childcosttwo)*$numberOfNights;
				
				
				} else {
				
				$rs=GetPageRecord('*','sys_HotelRoomTypeCost',' hotelId="'.$rest['id'].'"  and id="'.$hotelPricetop['id'].'" and maxPax>2 and rooms>0 and validFrom<="'.date('Y-m-d', strtotime($checkInDate)).'" and validTo>="'.date('Y-m-d', strtotime($checkOutDate)).'" order by adultCost asc');
			$hotelPrice=mysqli_fetch_array($rs); 
			
						$childcostone=0;
				$childcosttwo=0; 
 
			
			if($hotelPrice['id']!=''){
			 
						 
				$adultcost=$hotelPrice['adultCost']+($hotelPrice['mealCost']*$adultCount);
				
				if($age1<3 && $child>0){
				$childcostone=$hotelPrice['infantCost'];
				}
				
				if($age1>2 && $child>0){
				$childcostone=$hotelPrice['childCost']+($hotelPrice['mealCost']*$adultCount);
				}
				 	//echo $child.'-'.$rest['name'];
				
				if($age2>2 && $child==2){
				$childcosttwo=$hotelPrice['childCost']+($hotelPrice['mealCost']*$adultCount);
				} 
				if($age2<3 && $child==2){
				$childcosttwo=$hotelPrice['infantCost'];
				} 

				 } else {
				 
				 $rs=GetPageRecord('*','sys_HotelRoomTypeCost',' hotelId="'.$rest['id'].'"  and id="'.$hotelPricetop['id'].'" and rooms>0 and maxPax<3 and validFrom<="'.date('Y-m-d', strtotime($checkInDate)).'" and validTo>="'.date('Y-m-d', strtotime($checkOutDate)).'" order by adultCost asc');
			$hotelPrice=mysqli_fetch_array($rs); 
				 
				 
				 $adultcost=$hotelPrice['adultCost']+$hotelPrice['extraBed']+($hotelPrice['mealCost']*$adultCount);
				
				if($age1<3 && $child>0){
				$childcostone=$hotelPrice['infantCost'];
				}
				
				if($age1>2 && $child>0){
				$childcostone=$hotelPrice['childCost']+($hotelPrice['mealCost']*$adultCount);
				}
				 	//echo $child.'-'.$rest['name'];
				
			if($age2>2 && $child==2){
			$childcosttwo=$hotelPrice['childCost']+($hotelPrice['mealCost']*$adultCount);
			} 
			if($age2<3 && $child==2){
			$childcosttwo=$hotelPrice['infantCost'];
			} 				 
		}
				 
$finalroomcost+=($adultcost+$childcostone+$childcosttwo)*$numberOfNights;
		
}
    $numberroom++; 
  }
  
 
  	$hotelCost=calculatehotelcost(encode($agentid),stripslashes($rest['name']),$finalroomcost,'0');
	
	
		$rsroomre=GetPageRecord('SUM(bookedRoom) as remainroom','hotelBookingMaster',' RoomTypeCode="'.$hotelPrice['id'].'"  and status=2');
			$ifrromremain=mysqli_fetch_array($rsroomre); 
			
 
	
	if($hotelCost>0 && ($hotelPrice['rooms']-$ifrromremain['remainroom'])>=$_REQUEST['empcount']){
 
	
	if(($hotelPrice['rooms']-$ifrromremain['remainroom'])==$_REQUEST['empcount'] || ($hotelPrice['rooms']-$ifrromremain['remainroom'])>$_REQUEST['empcount']){
			?>
  <tr>
    <td align="left" valign="top" style="padding:10px;"><h4 style="font-weight:700; font-size:18px; margin-bottom:10px; color:#e52b30;"><?php echo stripslashes($hotelPrice['roomType']); ?> <?php echo stripslashes(' | '.$hotelPricetop['inclusion']); ?> <?php 
	 if($hotelPrice['cancellationPolicy']=='Refundable'){
   $checkin=date('Y-m-d',strtotime($_REQUEST['checkInDate']));  
	 if(date('Y-m-d')>date('Y-m-d',strtotime($checkin . ' -'.$hotelPrice['cancellationBeforeDays'].' day'))){
	 ?> 
	<?php } else {?>
	 | Free Cancellation 
	<?php } } ?> </h4>
	 
 
	</td>
    <td width="20%" align="left" valign="top" style="padding:10px; font-weight:600;"><i class="fa fa-check-circle" aria-hidden="true" style=" color:#2a9c7b;"></i> <?php echo stripslashes($hotelPrice['inclusion']); ?></td>
    <td width="20%" align="left" valign="top" style="padding:10px;">
	
	 
	 
	 
	 <?php 
	 if($hotelPrice['cancellationPolicy']=='Refundable'){
   $checkin=date('Y-m-d',strtotime($_REQUEST['checkInDate']));  
	 if(date('Y-m-d')>date('Y-m-d',strtotime($checkin . ' -'.$hotelPrice['cancellationBeforeDays'].' day'))){
	 $c=2;
	 ?>
	 <div style=" margin-bottom:5px; font-weight:600; color:#FF0000;">Non-Refundable </div>
	<?php } else { $c=1; ?>
	<div style=" margin-bottom:5px; font-weight:600; color:#2a9c7b;">Refundable </div>
	<?php } } else {  $c=2; ?>
	<div style=" margin-bottom:5px; font-weight:600; color:#FF0000;">Non-Refundable </div>
	<?php } ?> 
	
	
	
	 <div style="font-size: 11px; color: #FF0000; padding: 2px 10px; float: left; border: 1px solid #FF0000; border-radius: 4px; font-weight: 600; cursor: pointer; margin-top: 10px;" onClick="loadpop('Cancellation Policy',this,'500px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=hotelcancellationpolicy&id=<?php echo encode($hotelPrice['id']); ?>&checkInDate=<?php echo $_REQUEST['checkInDate']; ?>&c=<?php echo $c; ?>">Cancellation Policy</div>
	
	</td>
    <td width="20%" align="left" valign="top" style="padding:10px;">
	
	 
	<div style="font-size:24px; color:#000000; font-weight:700; margin-bottom:5px;">&#8377;<?php 
	$totalgst=0;
	if($rest['hotelGST']==5){
	$totalgst=round($hotelCost[2]*$rest['hotelGST']/100);
	}
	
	if($rest['hotelGST']==18){
	$totalgst=round($hotelCost[4]*$rest['hotelGST']/100);
	}
	
	  echo $hotelCost[2]+$totalgst;?></div>
	
	<form name="roomfrom" method="post" action="hotel-review?i= " >
	 <?php $actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; 
		   
		   $actual_link = str_replace('hotel-view','hotel-review-page',$actual_link);
		   
		   $actual_link = $actual_link.'&hotelSearchId='.encode($rest['id']).'&roomcost='.round($hotelCost[2]).'&ad='.$adultCount.'&cd='.$childCount.'&rid='.encode($hotelPricetop['id']).'&un='.$numun.'&c='.$c;
		   
		   ?>
	  <a href="<?php echo $actual_link; ?>" ><button type="button" class="btn btn-danger" style=" font-weight:700px; padding:5px 20px;">

                                    <span class="ladda-label" style="color: #fff;">Book Now</span>
                                    <span class="ladda-spinner"></span></button></a>
									
									
									<a href="<?php echo  str_replace('hotel-review-page','hotel-request-page',$actual_link); ?>" ><button type="button" class="btn btn-danger" style=" font-weight:700px; padding:5px 20px;background-color: #ff9a00 !important;">

                                    <span class="ladda-label" style="color: #fff;">Request</span>
                                    <span class="ladda-spinner"></span></button></a>

									
									 <input type="hidden" name="action" value="roompostaction" />
									 
							 
	 
	<input type="hidden" name="hotelJsonData" value="<?php echo htmlentities($_POST['hotelJsonData']); ?>" >
	<input type="hidden" name="RoomDetails" value="<?php echo nl2br(stripslashes($rest['hotelDetails']));  ?>" />
	<input type="hidden" name="hotelName" value="<?php echo stripslashes($rest['name']);  ?>" />
	<input type="hidden" name="hotelRating" value="<?php echo $rest['category'];  ?>" />
	<input type="hidden" name="hotelAddress" value="<?php echo $rest['address'];  ?>" />
	<input type="hidden" name="RoomTypeName" value="<?php echo stripslashes($hotelPrice['roomType']);  ?>" />
	<input type="hidden" name="hotelnights" value="<?php echo $numberOfNights;  ?>" />
	<input type="hidden" name="toadult" value="<?php echo $adultCount; ?>" />
	<input type="hidden" name="tochild" value="<?php echo $childCount; ?>" />
	
	<input type="hidden" name="NoOfRooms" id="NoOfRooms" value="<?php echo $_REQUEST['empcount']; ?>" >
		<input type="hidden" name="hotelimg" id="hotelimg" value="<?php if($rest['hotelPhoto']!=''){  echo $imgurl.$rest['hotelPhoto'];  } else { echo 'images/NoImageFound.png'; } ?>" >
									<input type="hidden" name="hotelnights" id="hotelnights" value="<?php echo $numberOfNights; ?>" >
									<input type="hidden" name="c" id="c" value="<?php echo $c; ?>" >
									
								</form>
									<?php if($n==1){ ?>
									<script>
									 $('#toppriceht').html('&#8377;<?php  echo $hotelCost[2];   ?>');
									</script>
									<?php } ?>
	</td>
  </tr>
  
  	<?php $n++; } } }  ?>
                </tbody></table>
                 
                
            </div>
		
		
		</div>
		
		</section>


<div class="top_bg_ofr_sb" style="display:none;" >
<div class="container"  style="padding:0px 60px;"> 
<div class="searchtabs">
<a <?php if($_REQUEST['tripType']==1){ ?>class="active"<?php } ?>  id="tb1" onClick="selecttb(1);">One-Way</a>
<a <?php if($_REQUEST['tripType']==2){ ?>class="active"<?php } ?> id="tb2" onClick="selecttb(2);">Round-Trip</a></div>

<div class="searchboxouter">
 <form  method="GET" id="formids" action="<?php echo $fullurl; ?>flight-search" >
                <input type="hidden" name="tripType" id="tripType" value="<?php echo $tripType; ?>">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="20%" align="left" valign="top">  
	<div style="height:0px; font-size:0px; position:relative; width: 100%; text-align: left;" id="searchcitylistsfromCity"></div>
	  <input type="text" onClick="$('#pickupCitySearchfromCity').select();" class="textfield" requered="" onKeyUp="getflightSearchCIty('pickupCitySearchfromCity','fromDestinationFlight','searchcitylistsfromCity');" id="pickupCitySearchfromCity" name="fromcitydesti" value="<?php echo $fromcitydesti; ?>" autocomplete="off">
	  <input name="fromDestinationFlight" id="fromDestinationFlight" type="hidden" value="<?php echo $fromDestinationFlight; ?>" autocomplete="nope">
	  <div class="swapbtn" onClick="swapdata();"><i class="fa fa-exchange" aria-hidden="true"></i></div>
     </td> 
    <td width="20%" align="left" valign="top" >
	<div style="height:0px; font-size:0px; position:relative; width: 100%; text-align: left;" id="searchcitylistsfromCity2"></div>
	<input type="text" onClick="$('#pickupCitySearchfromCity2').select();" class="textfield" requered="" onKeyUp="getflightSearchCIty('pickupCitySearchfromCity2','fromDestinationFlight2','searchcitylistsfromCity2');" id="pickupCitySearchfromCity2" name="tocitydesti" value="<?php echo $tocitydesti; ?>" autocomplete="off" >
	<input name="toDestinationFlight" id="fromDestinationFlight2" type="hidden" value="<?php echo $toDestinationFlight; ?>" autocomplete="nope">
	</td>
    <td width="12%" align="left" valign="top"><input type="text" id="dt1" name="journeyDateOne" class="textfield"  value="<?php echo trim($journeyDateOne); ?>" autocomplete="off"  ><i class="fa fa-calendar" aria-hidden="true"></i></td>
    <td width="12%" align="left" valign="top"  onclick="selecttb(2);"><input type="text" id="dt2" name="journeyDateRound" class="textfield"  value="<?php echo trim($journeyDateRound); ?>" autocomplete="off" <?php if($tripType==1){ ?>disabled  style="color:#fafafa;" <?php } ?> <?php if($_REQUEST['tripType']==1){ ?>disabled="disabled"<?php } ?>  ><i class="fa fa-calendar" aria-hidden="true"></i></td>
    <td width="24%" align="left" valign="top">
	
	<input type="text" id="travellersshow"  name="travellersshow"  class="textfield"  value="<?php echo trim($travellers); ?>" autocomplete="off" readonly="readonly" onClick="$('#basicDropdownClick').show();"  >
							
							
							  <script>
  $('#basicDropdownClick').click(function(event){
  event.stopPropagation();
});
  </script>
 
 <div id="basicDropdownClick" class="dropdown-menu dropdown-unfold col-11 m-0" aria-labelledby="basicDropdownClickInvoker" style="max-width: 300px; width: 250px;">
                   
					  
					  <div class=" "  style="margin-bottom: 10px;">
					  
					  
					  
                        <div class="js-quantity mx-3 row align-items-center justify-content-between">
						   <div class=" "  style="margin-bottom: 10px; width:100%; position:relative;">
					  <strong>Travellers</strong> <i class="fa fa-times" aria-hidden="true" style="position: absolute; right: 0px; cursor: pointer; top: 4px; font-size: 16px; color: #000;" onClick="$('#basicDropdownClick').hide();"></i>
					  </div>
						
						 <span class="d-block font-size-16 text-secondary font-weight-medium">Adults (12y +)</span>
                          <div class="d-flex">
                            <select id="ADT" name="ADT" class="form-control" onChange="selectpaxs();">
                              <option value="1" <?php echo ($ADT == 1 ? 'selected':''); ?>>1</option>
                              <option value="2" <?php echo ($ADT == 2 ? 'selected':''); ?>>2</option>
                              <option value="3" <?php echo ($ADT == 3 ? 'selected':''); ?>>3</option>
                              <option value="4" <?php echo ($ADT == 4 ? 'selected':''); ?>>4</option>
                              <option value="5" <?php echo ($ADT == 5 ? 'selected':''); ?>>5</option>
                              <option value="6" <?php echo ($ADT == 6 ? 'selected':''); ?>>6</option>
                              <option value="7" <?php echo ($ADT == 7 ? 'selected':''); ?>>7</option>
                              <option value="8" <?php echo ($ADT == 8 ? 'selected':''); ?>>8</option>
                              <option value="9" <?php echo ($ADT == 9 ? 'selected':''); ?>>9</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class=""  style="margin-bottom: 10px;">
                        <div class="js-quantity mx-3 row align-items-center justify-content-between"> <span class="d-block font-size-16 text-secondary font-weight-medium">Children (2y - 12y )</span>
                          <div class="d-flex">
                            <select id="CHD" name="CHD" class="form-control" onChange="selectpaxs();">
                              <option value="0" <?php echo ($CHD == 0 ? 'selected':''); ?>>0</option>
                              <option value="1" <?php echo ($CHD == 1 ? 'selected':''); ?>>1</option>
                              <option value="2" <?php echo ($CHD == 2 ? 'selected':''); ?>>2</option>
                              <option value="3" <?php echo ($CHD == 3 ? 'selected':''); ?>>3</option>
                              <option value="4" <?php echo ($CHD == 4 ? 'selected':''); ?>>4</option>
                              <option value="5" <?php echo ($CHD == 5 ? 'selected':''); ?>>5</option>
                              <option value="6" <?php echo ($CHD == 6 ? 'selected':''); ?>>6</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="" style="margin-bottom: 10px;">
                        <div class="js-quantity mx-3 row align-items-center justify-content-between"> <span class="d-block font-size-16 text-secondary font-weight-medium">Infants (below 2y)</span>
                          <div class="d-flex">
                            <select id="INF" name="INF" class="form-control" onChange="selectpaxs();">
                              <option value="0" <?php echo ($INF == 0 ? 'selected':''); ?>>0</option>
                              <option value="1" <?php echo ($INF == 1 ? 'selected':''); ?>>1</option>
                              <option value="2" <?php echo ($INF == 2 ? 'selected':''); ?>>2</option>
                              <option value="3" <?php echo ($INF == 3 ? 'selected':''); ?>>3</option>
                              <option value="4" <?php echo ($INF == 4 ? 'selected':''); ?>>4</option>
                              <option value="5" <?php echo ($INF == 5 ? 'selected':''); ?>>5</option>
                              <option value="6" <?php echo ($INF == 6 ? 'selected':''); ?>>6</option>
                            </select>
                          </div>
                        </div>
                      </div>
					  
					  
					  
					  <div class="" style="margin-bottom: 10px;">
                        <div class="js-quantity mx-3 row align-items-center justify-content-between"> <span class="d-block font-size-16 text-secondary font-weight-medium">Preffered Class</span>
                          <div class="d-flex">
                            <select id="PC" name="PC" class="form-control" onChange="selectpaxs();" > 
                              <option value="EC" <?php if($PC=='EC'){ echo 'selected'; }?>>Economy Class</option>
                              <option value="BU" <?php if($PC=='BU'){ echo 'selected'; }?>>Business Class</option>
                            </select>
                          </div>
                        </div>
                      </div>
					  <script>
							function selectpaxs(){
							var ADT = Number($('#ADT').val());
							var CHD = Number($('#CHD').val());
							var INF = Number($('#INF').val());
							var PC = $('#PC').val();
							
							if(PC=='EC'){
							fPC='Economy';
							}
							if(PC=='BU'){
							fPC='Business';
							}
							if(PC==''){
							fPC='All Class';
							}
							
							$('#travellersshow').val(Number(ADT+CHD+INF)+' Pax, '+fPC); 
							}
							</script>
					  
                       
                       <script>
					   selectpaxs();
					   </script>
                    </div>
	
	</td>
     
    <td width="12%" align="left" valign="top"><input type="submit" name="Submit" value="SEARCH" class="redbuttonsearch"></td>
  </tr>
</table>

<input type="hidden" name="action" value="flightpostaction" >
<input type="hidden" name="changesearch" id="changesearch" value="0" >
</form>

</div>

</div>
</div>
 

<iframe style="display:none;" src="<?php echo $pagesearch; ?>"></iframe>

<?php include "footerinc.php"; ?>
<?php include "footer.php"; ?>

 

 
 
 <script src="dist/js/lightbox-plus-jquery.min.js"></script>

 
</body>
</html>
