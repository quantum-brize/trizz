<?php
include "inc.php";
$cookie_name = "user";
if (!isset($_COOKIE[$cookie_name])) {
} else {
	$cookieuserid = $_COOKIE[$cookie_name];
}
if ($cookieuserid > 0) {
	$_SESSION['userId'] = $cookieuserid;
}

$actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$actual_link =str_replace($fullurl,'',$actual_link);
$actual_link =str_replace('flightsearch.php','searchloadflight.php',$actual_link);







$ADT = trim($_REQUEST['ADT']);

$CHD = trim($_REQUEST['CHD']);

$INF = trim($_REQUEST['INF']);

$PC = trim($_REQUEST['PC']);



$_SESSION['PC']=$_REQUEST['PC'];



$_SESSION['ADT']=$ADT;

$_SESSION['CHD']=$CHD;

$_SESSION['INF']=$INF;

$_SESSION['PC']=$PC;













$_SESSION['fromDestinationFlight']=$_REQUEST['fromDestinationFlight'];

$_SESSION['toDestinationFlight']=$_REQUEST['toDestinationFlight'];

$_SESSION['tripType']=$_REQUEST['tripType'];









if ( (strpos(strtolower($_REQUEST['fromDestinationFlight']), 'india') !== false)  &&  (strpos(strtolower($_REQUEST['toDestinationFlight']), 'india') !== false) )

{

  

 

   $_SESSION['isdomestic']='Yes';

   $_SESSION['domesticorinter']='D';

  

}

else

{

	 	 

	 $_SESSION['isdomestic']='No';

	  $_SESSION['domesticorinter']='I';	 

	

}



$isRoundTripInt=0;

if($_REQUEST['tripType']==2)

{

	 if( (strpos(strtolower($_REQUEST['fromDestinationFlight']), 'india')== false)  ||  (strpos(strtolower($_REQUEST['toDestinationFlight']), 'india')== false) )

	 {

		$isRoundTripInt=1;

	 }

 }



$_SESSION['isRoundTripInt']=$isRoundTripInt;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
	<title>Flight Search</title>
	<?php
	include "headerinc.php";
	?>

	<script>
		function opendashboard() {
			$('body').removeClass('loginbg');
			$('body').load('dashboard.php');
		}
	</script>

	<style>
		body {
			background-color: #f0f7fe;
		}
		
	 
    

    .packagebox .name {
      white-space: inherit !important;
      font-weight: 500 !important;
    }
 
	</style>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
	<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
</head>

<body>
<div class="innerpageaccountheader filtercontents" style="width:100% !important;"><div><a href="<?php echo $fullurl; ?>flightpage.php" style="color:#FFFFFF !important;"><i class="fa fa-arrow-left" aria-hidden="true" ></i></a>Flights</div> <div><i class="fa fa-filter" aria-hidden="true" onclick="$('#allFilterDiv').toggle();"></i></div></div>
<div class="bodyouter" style=" padding:10px;">
	<section class="cardsection" style="margin-top: 50px;">
		<div class="container">
		
		<div style="padding:10px; border:1px solid #ddd; margin-bottom:10px; border-radius: 10px;">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" style="font-size:16px; font-weight:600;"><?php echo $_REQUEST['fromcitydesti']; ?> <i class="fa fa-long-arrow-right" aria-hidden="true"></i> <?php echo $_REQUEST['tocitydesti']; ?> <span id="totalhotel" style="display:none;"></span>
	
	<div style="font-size:12px; margin-top:4px;">Departure: <?php echo date('j M Y',strtotime($_REQUEST['journeyDateOne'])); ?><?php if($_REQUEST['tripType']==2){?>&nbsp; - Return&nbsp;<?php echo date('j M Y',strtotime($_REQUEST['journeyDateRound'])); ?><?php } ?></div>
	<div style="font-size:12px; margin-top:4px;">Adults: <?php echo $_REQUEST['ADT']; ?><?php if($_REQUEST['CHD']>0){?> - Children: <?php echo $_REQUEST['CHD']; ?><?php } ?><?php if($_REQUEST['INF']>0){?> - Infants: <?php echo $_REQUEST['INF']; ?><?php } ?> - (<?php echo $_REQUEST['PC']; ?>)</div>	</td>
    <td width="5%" align="right"><a href="<?php echo $fullurl; ?>flightpage.php" style=" color:#0066CC; font-weight:600; font-size:14px; display:block; padding:4px 10px; text-align:center;">Edit</a></td>
  </tr>
</table>

</div>
<div style=" width:100%;" id="searchloadhotel">
			<div style="padding:50px 0px; text-align:center;"><img src="images/loading-gif.gif" style="width:32px; height:32px;" /></div>
			</div>
			
			<script>
			 $('#searchloadhotel').load('<?php echo $actual_link; ?>');
			</script>

	 
		</div>
	</section>

</div>




<style>
#allFilterDiv{background-color: #fff; position: fixed; left: 0px; top: 0px; width: 100%; height: 100%; padding-top:48px;}
#allFilterDiv .card-header{padding: 10px; font-size: 14px; font-weight: 600; background-color: #f2f2f2; border-bottom: 1px solid #ddd;}
#allFilterDiv .card-body{padding: 10px;  }
.filterinnerboxes { background-color: #FFFFFF; border: 1px solid #ddd; border-radius: 4px; cursor: pointer; }
.filterinnerboxes td { border-right: 1px solid #ddd; padding: 0px 0px; text-align: center; font-size: 11px; font-weight: 600;  }
.filterinnerboxes td:last-child { border: 0px solid #ddd !important; }
.arranddep .custom-control-label { text-align: center; color: #fff; border-radius: 60px; padding-left: 0px !important; padding: 0px; color: #212529; padding: 0px; width: 100%; height: 100%; border-radius: 0px; margin: 0px; padding: 5px !important; }
.custom-control-input { display: none; }
.mor-n1, .mor-n11 { margin: 0 auto; width: 28px; height: 25px; background: url(images/filter-sprite.png); background-position: -5px -42px; }
.mor1-n2, .mor1-n22 { margin: 0 auto; width: 24px; height: 25px; background: url(images/filter-sprite.png); background-position: -38px -43px; }
.mor2-n3, .mor2-n33 { margin: 0 auto; width: 20px; height: 25px; background: url(images/filter-sprite.png); background-position: -66px -42px; }
.mor3-n4, .mor3-n44 { margin: 0 auto; width: 16px; height: 25px; background: url(images/filter-sprite.png); background-position: -95px -43px; }
.arranddep .custom-control-input:checked ~ .custom-control-label { background: #dddddd4f; text-align: center; color: #666666; border-radius: 60px; padding-left: 0px !important; padding: 0px; width: 100%; height: 100%; border-radius: 0px; margin: 0px; padding: 5px 0px !important; display: inline-block; }
.filterinnerboxes label { display: inline-block; }

</style>

<div class="col-3 filtersidebar" id="allFilterDiv" style="display:none;">
                
               <div class="card nav-pills"  style="margin-top:0px;">
                  <div class="card-header">
                     Price Range <a style="position: absolute; right: 10px; padding: 5px 10px; background-color: #000; color: #fff !important; top: 53px; border-radius: 5px;" onclick="$('#allFilterDiv').hide();">Close</a>
                  </div>
                  <div class="card-body">
                     <div class="">
                        <p class="range-value">
                           <input type="text" id="amountfilter" readonly style="border: 0px;">
                        </p>
                        <div id="slider-ranges" class="range-bar"></div>
                     </div>
                  </div>
                  <div class="card-body" style="padding-bottom:0px; display:none;">
                     <a style="cursor:pointer;" id="shownetpricebtn" onClick="$('.mainprice').hide();$('.netpriceshow').show();$('#shownetpricebtn').hide();$('#hidenetpricebtn').show();"><i class="fa fa-eye" aria-hidden="true"></i> <strong>Show Net Fare</strong></a>
                     <a style="cursor:pointer; display:none;" id="hidenetpricebtn" onClick="$('.mainprice').show();$('.netpriceshow').hide();$('#shownetpricebtn').show();$('#hidenetpricebtn').hide();"><i class="fa fa-eye-slash" aria-hidden="true"></i> <strong>Hide Net Fare</strong></a>
                  </div>
                  <div class="card-header">
                     Stops
                  </div>
                  <div class="card-body allFilterDiv">
                     <div class="filterinnerboxes arranddep">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                           <tr>
                              <td width="25%"  >
                                 <div class="custom-control custom-checkbox filter-stops" data-value="nonstopss">
                                    <input type="checkbox" id="0stop" value="0stop" name="stop" class="custom-control-input i-check"  >
                                    <label class="custom-control-label " for="0stop">0<br>Non Stop  </label>
                                 </div>
                              </td>
                              <td width="25%"  >
                                 <div class="custom-control custom-checkbox filter-stops" data-value="1">
                                    <input type="checkbox" id="1stop" value="1stop" name="stop" class="custom-control-input i-check" >
                                    <label class="custom-control-label" for="1stop">1 <br>Stop  </label>
                                 </div>
                              </td>
                              <td width="25%"  >
                                 <div class="custom-control custom-checkbox filter-stops" data-value="2">
                                    <input type="checkbox" id="2stop" name="stop" value="2stop" class="custom-control-input i-check" >
                                    <label class="custom-control-label" for="2stop">2+ <br>Stop  </label>
                                 </div>
                              </td>
                           </tr>
                        </table>
                     </div>
                  </div>
                                    <div class="card-header">
                     Departure  
                  </div>
                  <div class="card-body allFilterDiv">
                     <div class="filterinnerboxes arranddep">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                           <tr>
                              <td width="25%">
                                 <div class="custom-control custom-checkbox clearfix filter-dtime" data-min="1800" data-max="23340">
                                    <input type="checkbox" id="earlyMorning" name="departureTime[]" value="D6" class="custom-control-input i-check">
                                    <label class="custom-control-label clrwht"   for="earlyMorning">
                                       <div class="mor-n1"></div>
                                       00-06
                                    </label>
                                 </div>
                              </td>
                              <td width="25%">
                                 <div class="custom-control custom-checkbox clearfix filter-dtime" data-min="23400" data-max="44940">
                                    <input type="checkbox" id="morning" name="departureTime[]" value="D12"   class="custom-control-input i-check">
                                    <label class="custom-control-label clrwht" for="morning">
                                       <div class="mor1-n2"></div>
                                       06-12
                                    </label>
                                 </div>
                              </td>
                              <td width="25%">
                                 <div class="custom-control custom-checkbox clearfix filter-dtime" data-min="45000" data-max="66540">
                                    <input type="checkbox" id="midDay" name="departureTime[]"  value="D18"  class="custom-control-input i-check">
                                    <label class="custom-control-label clrwht" for="midDay">
                                       <div class="mor2-n3"></div>
                                       12-18
                                    </label>
                                 </div>
                              </td>
                              <td width="25%">
                                 <div class="custom-control custom-checkbox clearfix filter-dtime" data-min="-19800" data-max="1740">
                                    <input type="checkbox" id="evening" name="departureTime[]"  value="D1"   class="custom-control-input i-check">
                                    <label class="custom-control-label clrwht" for="evening">
                                       <div class="mor3-n4"></div>
                                       18-00
                                    </label>
                                 </div>
                              </td>
                           </tr>
                        </table>
                     </div>
                  </div>
                                    <div class="card-header">
                     Arrival  
                  </div>
                  <div class="card-body allFilterDiv">
                     <div class="filterinnerboxes arranddep">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                           <tr>
                              <td width="25%">
                                 <div class="custom-control custom-checkbox clearfix filter-dtime" data-min="1800" data-max="23340">
                                    <input type="checkbox" id="earlyMorning2" name="departureTime" value="A6" class="custom-control-input i-check">
                                    <label class="custom-control-label clrwht"   for="earlyMorning2">
                                       <div class="mor-n1"></div>
                                       00-06
                                    </label>
                                 </div>
                              </td>
                              <td width="25%">
                                 <div class="custom-control custom-checkbox clearfix filter-dtime" data-min="23400" data-max="44940">
                                    <input type="checkbox" id="morning2" name="departureTime" value="A12"   class="custom-control-input i-check">
                                    <label class="custom-control-label clrwht" for="morning2">
                                       <div class="mor1-n2"></div>
                                       06-12
                                    </label>
                                 </div>
                              </td>
                              <td width="25%">
                                 <div class="custom-control custom-checkbox clearfix filter-dtime" data-min="45000" data-max="66540">
                                    <input type="checkbox" id="midDay2" name="departureTime"  value="A18"  class="custom-control-input i-check">
                                    <label class="custom-control-label clrwht" for="midDay2">
                                       <div class="mor2-n3"></div>
                                       12-18
                                    </label>
                                 </div>
                              </td>
                              <td width="25%">
                                 <div class="custom-control custom-checkbox clearfix filter-dtime" data-min="-19800" data-max="1740">
                                    <input type="checkbox" id="evening2" name="departureTime"  value="A1"   class="custom-control-input i-check">
                                    <label class="custom-control-label clrwht" for="evening2">
                                       <div class="mor3-n4"></div>
                                       18-00
                                    </label>
                                 </div>
                              </td>
                           </tr>
                        </table>
                     </div>
                  </div>
                  


                  <div class="card-body" style="display:none;">
                     <div class="filtercolorbox colorboxxx allFilterDiv">
                                                <div class="custom-control custom-checkbox filter-999999" style="display:none;" data-value="#999999">
                           <input type="checkbox" id="#999999" value="999999" name="fareTypeColorLeft" class="custom-control-input i-check"  >
                           <label style="background-color:#999999;width: 30px; height: 30px; float:left;" class="custom-control-label " for="#999999"> </label>
                        </div>
                                                <div class="custom-control custom-checkbox filter-ff2600" style="display:none;" data-value="#ff2600">
                           <input type="checkbox" id="#ff2600" value="ff2600" name="fareTypeColorLeft" class="custom-control-input i-check"  >
                           <label style="background-color:#ff2600;width: 30px; height: 30px; float:left;" class="custom-control-label " for="#ff2600"> </label>
                        </div>
                                                <div class="custom-control custom-checkbox filter-ff0000" style="display:none;" data-value="#ff0000">
                           <input type="checkbox" id="#ff0000" value="ff0000" name="fareTypeColorLeft" class="custom-control-input i-check"  >
                           <label style="background-color:#ff0000;width: 30px; height: 30px; float:left;" class="custom-control-label " for="#ff0000"> </label>
                        </div>
                                                <div class="custom-control custom-checkbox filter-909893" style="display:none;" data-value="#909893">
                           <input type="checkbox" id="#909893" value="909893" name="fareTypeColorLeft" class="custom-control-input i-check"  >
                           <label style="background-color:#909893;width: 30px; height: 30px; float:left;" class="custom-control-label " for="#909893"> </label>
                        </div>
                                                <div class="custom-control custom-checkbox filter-a0a2a0" style="display:none;" data-value="#a0a2a0">
                           <input type="checkbox" id="#a0a2a0" value="a0a2a0" name="fareTypeColorLeft" class="custom-control-input i-check"  >
                           <label style="background-color:#a0a2a0;width: 30px; height: 30px; float:left;" class="custom-control-label " for="#a0a2a0"> </label>
                        </div>
                                                <div class="custom-control custom-checkbox filter-e6450f" style="display:none;" data-value="#e6450f">
                           <input type="checkbox" id="#e6450f" value="e6450f" name="fareTypeColorLeft" class="custom-control-input i-check"  >
                           <label style="background-color:#e6450f;width: 30px; height: 30px; float:left;" class="custom-control-label " for="#e6450f"> </label>
                        </div>
                                                <div class="custom-control custom-checkbox filter-929292" style="display:none;" data-value="#929292">
                           <input type="checkbox" id="#929292" value="929292" name="fareTypeColorLeft" class="custom-control-input i-check"  >
                           <label style="background-color:#929292;width: 30px; height: 30px; float:left;" class="custom-control-label " for="#929292"> </label>
                        </div>
                                                <div class="custom-control custom-checkbox filter-612505" style="display:none;" data-value="#612505">
                           <input type="checkbox" id="#612505" value="612505" name="fareTypeColorLeft" class="custom-control-input i-check"  >
                           <label style="background-color:#612505;width: 30px; height: 30px; float:left;" class="custom-control-label " for="#612505"> </label>
                        </div>
                                                <div class="custom-control custom-checkbox filter-a19b9b" style="display:none;" data-value="#a19b9b">
                           <input type="checkbox" id="#a19b9b" value="a19b9b" name="fareTypeColorLeft" class="custom-control-input i-check"  >
                           <label style="background-color:#a19b9b;width: 30px; height: 30px; float:left;" class="custom-control-label " for="#a19b9b"> </label>
                        </div>
                                                <div class="custom-control custom-checkbox filter-9b9797" style="display:none;" data-value="#9b9797">
                           <input type="checkbox" id="#9b9797" value="9b9797" name="fareTypeColorLeft" class="custom-control-input i-check"  >
                           <label style="background-color:#9b9797;width: 30px; height: 30px; float:left;" class="custom-control-label " for="#9b9797"> </label>
                        </div>
                                                <div class="custom-control custom-checkbox filter-b6c3b7" style="display:none;" data-value="#b6c3b7">
                           <input type="checkbox" id="#b6c3b7" value="b6c3b7" name="fareTypeColorLeft" class="custom-control-input i-check"  >
                           <label style="background-color:#b6c3b7;width: 30px; height: 30px; float:left;" class="custom-control-label " for="#b6c3b7"> </label>
                        </div>
                                                <div class="custom-control custom-checkbox filter-b2b8b5" style="display:none;" data-value="#b2b8b5">
                           <input type="checkbox" id="#b2b8b5" value="b2b8b5" name="fareTypeColorLeft" class="custom-control-input i-check"  >
                           <label style="background-color:#b2b8b5;width: 30px; height: 30px; float:left;" class="custom-control-label " for="#b2b8b5"> </label>
                        </div>
                                                <div class="custom-control custom-checkbox filter-9d9f9e" style="display:none;" data-value="#9d9f9e">
                           <input type="checkbox" id="#9d9f9e" value="9d9f9e" name="fareTypeColorLeft" class="custom-control-input i-check"  >
                           <label style="background-color:#9d9f9e;width: 30px; height: 30px; float:left;" class="custom-control-label " for="#9d9f9e"> </label>
                        </div>
                                                <div class="custom-control custom-checkbox filter-9a9693" style="display:none;" data-value="#9a9693">
                           <input type="checkbox" id="#9a9693" value="9a9693" name="fareTypeColorLeft" class="custom-control-input i-check"  >
                           <label style="background-color:#9a9693;width: 30px; height: 30px; float:left;" class="custom-control-label " for="#9a9693"> </label>
                        </div>
                                                <div class="custom-control custom-checkbox filter-9b9ea1" style="display:none;" data-value="#9b9ea1">
                           <input type="checkbox" id="#9b9ea1" value="9b9ea1" name="fareTypeColorLeft" class="custom-control-input i-check"  >
                           <label style="background-color:#9b9ea1;width: 30px; height: 30px; float:left;" class="custom-control-label " for="#9b9ea1"> </label>
                        </div>
                                                <div class="custom-control custom-checkbox filter-00fa00" style="display:none;" data-value="#00fa00">
                           <input type="checkbox" id="#00fa00" value="00fa00" name="fareTypeColorLeft" class="custom-control-input i-check"  >
                           <label style="background-color:#00fa00;width: 30px; height: 30px; float:left;" class="custom-control-label " for="#00fa00"> </label>
                        </div>
                                                <div class="custom-control custom-checkbox filter-9aeaaa" style="display:none;" data-value="#9aeaaa">
                           <input type="checkbox" id="#9aeaaa" value="9aeaaa" name="fareTypeColorLeft" class="custom-control-input i-check"  >
                           <label style="background-color:#9aeaaa;width: 30px; height: 30px; float:left;" class="custom-control-label " for="#9aeaaa"> </label>
                        </div>
                                                <div class="custom-control custom-checkbox filter-a6a0a3" style="display:none;" data-value="#a6a0a3">
                           <input type="checkbox" id="#a6a0a3" value="a6a0a3" name="fareTypeColorLeft" class="custom-control-input i-check"  >
                           <label style="background-color:#a6a0a3;width: 30px; height: 30px; float:left;" class="custom-control-label " for="#a6a0a3"> </label>
                        </div>
                                                <div class="custom-control custom-checkbox filter-9c9c9c" style="display:none;" data-value="#9c9c9c">
                           <input type="checkbox" id="#9c9c9c" value="9c9c9c" name="fareTypeColorLeft" class="custom-control-input i-check"  >
                           <label style="background-color:#9c9c9c;width: 30px; height: 30px; float:left;" class="custom-control-label " for="#9c9c9c"> </label>
                        </div>
                                                <div class="custom-control custom-checkbox filter-7a7a7a" style="display:none;" data-value="#7a7a7a">
                           <input type="checkbox" id="#7a7a7a" value="7a7a7a" name="fareTypeColorLeft" class="custom-control-input i-check"  >
                           <label style="background-color:#7a7a7a;width: 30px; height: 30px; float:left;" class="custom-control-label " for="#7a7a7a"> </label>
                        </div>
                                                <div class="custom-control custom-checkbox filter-8d8d8d" style="display:none;" data-value="#8d8d8d">
                           <input type="checkbox" id="#8d8d8d" value="8d8d8d" name="fareTypeColorLeft" class="custom-control-input i-check"  >
                           <label style="background-color:#8d8d8d;width: 30px; height: 30px; float:left;" class="custom-control-label " for="#8d8d8d"> </label>
                        </div>
                                                <div class="custom-control custom-checkbox filter-3acb71" style="display:none;" data-value="#3acb71">
                           <input type="checkbox" id="#3acb71" value="3acb71" name="fareTypeColorLeft" class="custom-control-input i-check"  >
                           <label style="background-color:#3acb71;width: 30px; height: 30px; float:left;" class="custom-control-label " for="#3acb71"> </label>
                        </div>
                                                <div class="custom-control custom-checkbox filter-858585" style="display:none;" data-value="#858585">
                           <input type="checkbox" id="#858585" value="858585" name="fareTypeColorLeft" class="custom-control-input i-check"  >
                           <label style="background-color:#858585;width: 30px; height: 30px; float:left;" class="custom-control-label " for="#858585"> </label>
                        </div>
                                                <div class="custom-control custom-checkbox filter-a1a1a1" style="display:none;" data-value="#a1a1a1">
                           <input type="checkbox" id="#a1a1a1" value="a1a1a1" name="fareTypeColorLeft" class="custom-control-input i-check"  >
                           <label style="background-color:#a1a1a1;width: 30px; height: 30px; float:left;" class="custom-control-label " for="#a1a1a1"> </label>
                        </div>
                                                <div class="custom-control custom-checkbox filter-000000" style="display:none;" data-value="#000000">
                           <input type="checkbox" id="#000000" value="000000" name="fareTypeColorLeft" class="custom-control-input i-check"  >
                           <label style="background-color:#000000;width: 30px; height: 30px; float:left;" class="custom-control-label " for="#000000"> </label>
                        </div>
                                             </div>
                  </div>

                  
                  <div class="card-header">
                     Airline
                  </div>
                  <div class="card-body allFilterDiv bigcheck">
                                          <div class="form-check" id="flightnameidA.P.G.-Distribution-System" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="A.P.G.-Distribution-System"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        A.P.G. Distr... <span class="totalflight52 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidAegean-Air" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Aegean-Air"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Aegean Air... <span class="totalflight84 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidAer-Lingus-PLC" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Aer-Lingus-PLC"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Aer Lingus P... <span class="totalflight78 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidAeroflot-Soviet" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Aeroflot-Soviet"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Aeroflot-Sov... <span class="totalflight11 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidAI-Express" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="AI-Express"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        AI Express... <span class="totalflight103 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidAir-Algerie" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Air-Algerie"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Air Algerie... <span class="totalflight87 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidAir-Arabia" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Air-Arabia"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Air Arabia... <span class="totalflight55 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidAir-Astana" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Air-Astana"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Air Astana... <span class="totalflight67 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidAir-Baltic" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Air-Baltic"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Air Baltic... <span class="totalflight77 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidAir-Canada" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Air-Canada"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Air Canada... <span class="totalflight44 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidAir-China" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Air-China"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Air China... <span class="totalflight16 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidAir-Europa" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Air-Europa"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Air Europa... <span class="totalflight76 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidAir-France" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Air-France"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Air France... <span class="totalflight39 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidAir-India" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Air-India"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Air India... <span class="totalflight7 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidAir-Malta" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Air-Malta"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Air Malta... <span class="totalflight75 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidAir-Mauritius-" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Air-Mauritius-"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Air Mauritiu... <span class="totalflight68 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidAir-Serbia" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Air-Serbia"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Air Serbia... <span class="totalflight85 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidAir-Asia" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Air-Asia"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Air-Asia... <span class="totalflight5 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidAirArabia" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="AirArabia"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        AirArabia... <span class="totalflight28 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidAirAsia-India" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="AirAsia-India"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        AirAsia Indi... <span class="totalflight29 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidAirIndia-Express" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="AirIndia-Express"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        AirIndia Exp... <span class="totalflight102 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidAkasa-Air" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Akasa-Air"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Akasa Air... <span class="totalflight59 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidAll-Nippon-Airways" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="All-Nippon-Airways"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        All Nippon A... <span class="totalflight43 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidAlliance-Air" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Alliance-Air"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Alliance Air... <span class="totalflight31 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidAmerican-Airlines" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="American-Airlines"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        American Air... <span class="totalflight34 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidAPG-Airlines" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="APG-Airlines"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        APG Airlines... <span class="totalflight53 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidAsiana-Airlines" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Asiana-Airlines"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Asiana Airli... <span class="totalflight56 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidAustrian" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Austrian"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Austrian... <span class="totalflight79 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidAvianca" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Avianca"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Avianca... <span class="totalflight60 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidAzerbaijan-Airlines" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Azerbaijan-Airlines"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Azerbaijan A... <span class="totalflight61 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidBatik-Air" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Batik-Air"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Batik Air... <span class="totalflight48 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidBhutan-Airlines" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Bhutan-Airlines"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Bhutan Airli... <span class="totalflight71 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidBiman-Bangladesh-Airlines" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Biman-Bangladesh-Airlines"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Biman Bangla... <span class="totalflight22 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidBritish-Airways" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="British-Airways"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        British Airw... <span class="totalflight18 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidBrussels-Airlines" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Brussels-Airlines"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Brussels Air... <span class="totalflight74 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidBulgaria-Air" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Bulgaria-Air"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Bulgaria Air... <span class="totalflight96 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidCathay-Pacific-Airways" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Cathay-Pacific-Airways"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Cathay Pacif... <span class="totalflight58 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidChina-Eastern-Air" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="China-Eastern-Air"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        China Easter... <span class="totalflight99 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidCroatia-Airlines" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Croatia-Airlines"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Croatia Airl... <span class="totalflight80 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidCzech-Airlines" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Czech-Airlines"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Czech Airlin... <span class="totalflight95 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidDelta-Air-Lines" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Delta-Air-Lines"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Delta Air Li... <span class="totalflight37 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidDjibouti-Airlines" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Djibouti-Airlines"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Djibouti Air... <span class="totalflight93 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidEasyjet-Airlines" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Easyjet-Airlines"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Easyjet Airl... <span class="totalflight89 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidEgyptair" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Egyptair"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Egyptair... <span class="totalflight64 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidEmirates-Airlines" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Emirates-Airlines"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Emirates Air... <span class="totalflight19 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidEthiopian-Air-lines" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Ethiopian-Air-lines"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Ethiopian Ai... <span class="totalflight15 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidEtihad-Airways" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Etihad-Airways"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Etihad Airwa... <span class="totalflight10 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidEVA-Airways" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="EVA-Airways"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        EVA Airways... <span class="totalflight100 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidFinnair" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Finnair"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Finnair... <span class="totalflight32 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidFly-Dubai" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Fly-Dubai"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Fly Dubai... <span class="totalflight8 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidFlynas-Airlines" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Flynas-Airlines"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Flynas Airli... <span class="totalflight12 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidGO-FIRST" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="GO-FIRST"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        GO FIRST... <span class="totalflight24 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidGoAir" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="GoAir"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        GoAir... <span class="totalflight6 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidGulf-Air" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Gulf-Air"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Gulf Air... <span class="totalflight35 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidHahn-Air" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Hahn-Air"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Hahn Air... <span class="totalflight51 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidIberia" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Iberia"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Iberia... <span class="totalflight81 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidIcelandair" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Icelandair"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Icelandair... <span class="totalflight98 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidIndiGo" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="IndiGo"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        IndiGo... <span class="totalflight2 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidInternational" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="International"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Internationa... <span class="totalflight30 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidITA-Airways" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="ITA-Airways"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        ITA Airways... <span class="totalflight26 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidJapan-Airlines-Intl" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Japan-Airlines-Intl"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Japan Airlin... <span class="totalflight38 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidKenya-Airways" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Kenya-Airways"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Kenya Airway... <span class="totalflight65 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidKLM-Royal-Dutch-Airlines" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="KLM-Royal-Dutch-Airlines"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        KLM Royal Du... <span class="totalflight20 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidKorean-Air" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Korean-Air"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Korean Air... <span class="totalflight46 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidKuwait-Airways" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Kuwait-Airways"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Kuwait Airwa... <span class="totalflight23 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidLOT-Polish-Airlines" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="LOT-Polish-Airlines"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        LOT Polish A... <span class="totalflight33 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidLufthansa" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Lufthansa"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Lufthansa... <span class="totalflight40 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidLuxair" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Luxair"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Luxair... <span class="totalflight92 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidMalaysia-Airlines" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Malaysia-Airlines"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Malaysia Air... <span class="totalflight17 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidMIAT---Mongolian-Airlines" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="MIAT---Mongolian-Airlines"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        MIAT - Mongo... <span class="totalflight66 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidOman-Air" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Oman-Air"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Oman Air... <span class="totalflight9 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidOman-Aviation" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Oman-Aviation"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Oman Aviatio... <span class="totalflight63 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidQantas-Airways" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Qantas-Airways"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Qantas Airwa... <span class="totalflight54 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidQatar-Airways" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Qatar-Airways"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Qatar Airway... <span class="totalflight14 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidRoyal-Air-Maroc" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Royal-Air-Maroc"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Royal Air Ma... <span class="totalflight86 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidRoyal-Nepal-Airlines" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Royal-Nepal-Airlines"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Royal Nepal ... <span class="totalflight21 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidRwanda-Air" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Rwanda-Air"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Rwanda Air... <span class="totalflight69 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidRyanAir-(Ireland)" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="RyanAir-(Ireland)"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        RyanAir (Ire... <span class="totalflight88 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidSAS-Scandinavian-Airlines" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="SAS-Scandinavian-Airlines"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        SAS Scandina... <span class="totalflight83 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidSATA-Intl" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="SATA-Intl"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        SATA Intl... <span class="totalflight94 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidSaudi-Arabian-Airlines" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Saudi-Arabian-Airlines"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Saudi Arabia... <span class="totalflight62 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidSingapore-Airlines" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Singapore-Airlines"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Singapore Ai... <span class="totalflight47 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidSpice-Jet" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Spice-Jet"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Spice Jet... <span class="totalflight3 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidSpiceJet" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="SpiceJet"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        SpiceJet... <span class="totalflight101 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidSriLankan-Airlines" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="SriLankan-Airlines"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        SriLankan Ai... <span class="totalflight42 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidSwiss" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Swiss"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Swiss... <span class="totalflight27 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidTAP-Air-Portugal" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="TAP-Air-Portugal"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        TAP Air Port... <span class="totalflight82 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidTarom--Romanian-Air-Transport" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Tarom--Romanian-Air-Transport"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Tarom- Roman... <span class="totalflight97 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidThai-Airways-Intl" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Thai-Airways-Intl"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Thai Airways... <span class="totalflight50 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidThai-Lion" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Thai-Lion"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Thai Lion... <span class="totalflight72 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidThai-Smile" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Thai-Smile"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Thai Smile... <span class="totalflight73 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidTransavia-France" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Transavia-France"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Transavia Fr... <span class="totalflight91 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidTurkish-Airlines" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Turkish-Airlines"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Turkish Airl... <span class="totalflight13 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidUnited-Airlines-" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="United-Airlines-"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        United Airli... <span class="totalflight45 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidUS-Bangla-Airlines" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="US-Bangla-Airlines"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        US-Bangla Ai... <span class="totalflight70 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidUzbekistan-Airways" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Uzbekistan-Airways"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Uzbekistan A... <span class="totalflight41 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidVietjet-Airlines" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Vietjet-Airlines"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Vietjet Airl... <span class="totalflight49 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidVietnam-Airlines" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Vietnam-Airlines"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Vietnam Airl... <span class="totalflight57 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidVirgin-Atlantic" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Virgin-Atlantic"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Virgin Atlan... <span class="totalflight36 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidVistara" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Vistara"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Vistara... <span class="totalflight4 graytextlable"></span>
                        </label>
                     </div>
                                          <div class="form-check" id="flightnameidVueling-Airlines" style="display:none;">
                        <input class="form-check-input" name="flightslist" type="checkbox" value="Vueling-Airlines"  >
                        <label class="form-check-label" for="flexCheckDefault">
                        Vueling Airl... <span class="totalflight90 graytextlable"></span>
                        </label>
                     </div>
                                       </div>

                                 </div>
            </div>






	<?php
	include "footerinc.php";
	?>

</body>

</html>