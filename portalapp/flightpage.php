<?php
include "inc.php";
 
$cookie_name = "user";
if(!isset($_COOKIE[$cookie_name])) {
     
} else {
    $cookieuserid=$_COOKIE[$cookie_name];
}
 if($cookieuserid>0){
$_SESSION['userId']=$cookieuserid; 
}
 


$url = $basesiteurl."packagedestinationpage_mobile.php";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);

		$data = array(
		'MemberId' => $_SESSION['userId']
); 

curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
$contents = curl_exec($ch);
$contentres=json_decode($contents,true); 
curl_close($ch);
  
$url = $basesiteurl."marqueepage_mobile.php";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);

		$data = array(
		'MemberId' => $_SESSION['userId']
); 

curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
$contents = curl_exec($ch);
$contentresmark=json_decode($contents,true); 
curl_close($ch);
 


$url = $basesiteurl."offerspage_mobile.php";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);

		$data = array(
		'MemberId' => $_SESSION['userId']
); 

curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
$contents = curl_exec($ch);
$contentoffer=json_decode($contents,true); 
curl_close($ch); 




$tripType = 1;

if ($_REQUEST['tripType'] != '') {
  $tripType = $_REQUEST['tripType'];
}

$fixedDeparture = 0;
if ($_REQUEST['fixedDeparture'] != '') {
  $fixedDeparture = $_REQUEST['fixedDeparture'];
}

$PC = 'EC';
if ($_REQUEST['PC'] != '') {
  $PC = $_REQUEST['PC'];
}

$travellers = '1 Pax, Economy';
if ($_REQUEST['travellers'] != '') {
  $travellers = $_REQUEST['travellers'];
}

$fromcitydesti = 'DEL - NEW DELHI';
if ($_REQUEST['fromcitydesti'] != '') {
  $fromcitydesti = $_REQUEST['fromcitydesti'];
}

$fromDestinationFlight = 'DEL-India';
if ($_REQUEST['fromDestinationFlight'] != '') {
  $fromDestinationFlight = $_REQUEST['fromDestinationFlight'];
}

$tocitydesti = 'BOM - MUMBAI';
if ($_REQUEST['tocitydesti'] != '') {
  $tocitydesti = $_REQUEST['tocitydesti'];
}

$toDestinationFlight = 'BOM-India';
if ($_REQUEST['toDestinationFlight'] != '') {
  $toDestinationFlight = $_REQUEST['toDestinationFlight'];
}


$journeyDateOne = date('d-m-Y',strtotime('+ 1 Day'));
if ($_REQUEST['journeyDateOne'] != '') {
  $journeyDateOne = $_REQUEST['journeyDateOne'];
}



$journeyDateRound = date('d-m-Y', strtotime('+2 days'));
if ($_REQUEST['journeyDateRound'] != '') {
  $journeyDateRound = $_REQUEST['journeyDateRound'];
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
  <title>Flight</title>
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
    .packagebox .name{white-space: inherit !important;font-weight: 500 !important;}
	.flighttable input {  font-weight: 600; box-sizing: border-box; font-size: 16px; width: 100%;}
	.flighttabletwo input {  font-weight: 600; box-sizing: border-box; font-size: 16px; width: 100%;}
	.flighttablethree #travellersshow {  font-weight: 600; box-sizing: border-box; font-size: 16px; width: 100%;}
		.dropdown-menu{text-align: left; padding: 10px !important; position: absolute; background-color: #fff; box-shadow: 0px 0px 10px #dcdcdc; width: 170px; z-index: 999; right: 0px; display:none;}
		.dropdown-menu label{margin-top: 0px; display: block; line-height: 20px; padding: 5px 5px 10px;}
		.dropdown-menu td{padding-bottom:2px !important;}
		.searchfielinbox{font-size:16px;}
		.boxselectpax { padding: 4px; background-color: #fff; border: 1px solid #ddd; margin: 3px 0px 5px; width: auto; border-radius: 4px; width: auto; overflow: hidden; position: relative; }

.boxselectpax .paxbx { padding: 5px 2px !important; color: #000; float: left; margin-right: 2px; font-size: 14px; font-weight: 700; cursor: pointer; text-align: center; width: 32px; border-radius: 4px; height: 20px; }

.boxselectpax .paxbx:hover{background-color:var(--lightgray);}

.boxselectpax .active { background-color: var(--blue) !important; color: #fff !important; }
.flighttablethree li div { padding: 3px; }
.boxselectpax .active { background-color: var(--base-color) !important; color: #fff !important; }
#mobileflightsearchpax .phonecalendar{padding:3px !important;}
.searchdestinationboxclass{width:99%; top:133px;}
  </style>
 
</head>

<body style="background-color:#f0f7fe;">

  <div class="innerpageaccountheader" style="width:100% !important;"><i class="fa fa-arrow-left" aria-hidden="true" onclick="closeWindow();"></i>Flights</div>
  <div class="blkaria"></div>
  <div class="mainallcontent">

    <div style="margin-top: -60px; padding:10px;">
      <div class="innerbodycard" style="position:relative;">

        <div class="onewayroundbtn" style="margin-bottom:20px;">
          <div id="tb1" class="active oneway"  onClick="selecttb(1);">One Way</div>
          <div id="tb2" class="roundtrip"  onClick="selecttb(2);">Round Trip</div>
        </div><!-- onewayroundbtn  -->
 <form method="GET" id="formids" action="<?php $fullurl; ?>flightsearch.php"> 
 <input type="hidden" name="tripType" id="tripType" value="1">
        <div class="searchflight">
         
            <div class="mainallinput">
              <ul class="flighttable">
                <li class="departli">
				 
                  <div>
                    <label for="exampleFormControlInput1" class="form-label">From</label>
                <div style="height: 0px; font-size: 0px;  width: 100%; text-align: left; display: none;" id="searchcitylistsfromCity"></div>
                        <input type="text" onClick="$('#pickupCitySearchfromCity').select();" class="textfield" required="" onKeyUp="getflightSearchCIty('pickupCitySearchfromCity','fromDestinationFlight','searchcitylistsfromCity');" id="pickupCitySearchfromCity" name="fromcitydesti" value="IXJ - Jammu" autocomplete="off">
                        <input name="fromDestinationFlight" id="fromDestinationFlight" type="hidden" value="IXJ-India" autocomplete="nope">
                  </div>
                </li>
                <li class="swapiconli">
                  <div> <i class="fa fa-exchange" aria-hidden="true" onClick="swapdata();"></i></div>
                </li>
                <li class="goingtoli">
                  <div>
                    <label for="exampleFormControlInput1" class="form-label">To</label>
                    <div style="height: 0px; font-size: 0px;   width: 100%; text-align: left; display: none;" id="searchcitylistsfromCity2"></div>
                        <input type="text" onClick="$('#pickupCitySearchfromCity2').select();" class="textfield" required="" onKeyUp="getflightSearchCIty('pickupCitySearchfromCity2','fromDestinationFlight2','searchcitylistsfromCity2');" id="pickupCitySearchfromCity2" name="tocitydesti" value="SXR - Srinagar" autocomplete="off">
                        <input name="toDestinationFlight" id="fromDestinationFlight2" type="hidden" value="SXR-India" autocomplete="nope">
                  </div>
                </li>
              </ul><!-- flighttable  -->


              <ul class="flighttabletwo">
                <li class="depdate">
                  <div>
                    <label for="exampleFormControlInput1" class="form-label">Departure</label>
                 <input type="text" id="dt1" name="journeyDateOne"  value="<?php echo trim($journeyDateOne); ?>" readonly="readonly" autocomplete="off" >
                  </div>
                </li>

                <li class="goingdate">
                  <div>
                    <label for="exampleFormControlInput1" class="form-label">Return</label>
                   <input type="text" id="dt2" name="journeyDateRound"  value="<?php echo trim($journeyDateRound); ?>" autocomplete="off"  style="<?php if ($tripType == 1) { ?>color:#fff; <?php } ?>background-color: transparent;" disabled="disabled"  onClick="selecttb(2);"  >
                  </div>
                </li>
              </ul> <!-- flighttabletwo  -->

     <input type="hidden" name="action" value="flightpostaction">
            <input type="hidden" name="changesearch" id="changesearch" value="0">
			
			
              <ul class="flighttablethree">
                <li class="travellerli">
                  <div>
                    <label for="exampleFormControlInput1" class="form-label">Travellers</label>
                      <input type="text" id="travellersshow" name="travellersshow" class="textfield" value="<?php echo trim($travellers); ?>" autocomplete="off" readonly="readonly" onClick="$('#mobileflightsearchpax').show();">





                      <script>
                        $('#basicDropdownClick').click(function(event) {

                          event.stopPropagation();

                        });




                        function countadultchild(id, selectdiv) {

                          var remainingpax = 0;
                          var maxadultchild = 10;
                          var toadult = 1;
                          var tochild = 0;

                          if (selectdiv == 'adt') {
                            toadult = Number(id);
                          } else {
                            toadult = Number($('#ADT').val());
                          }

                          if (selectdiv == 'chd') {
                            tochild = Number(id);
                          } else {
                            tochild = Number($('#CHD').val());
                          }


                          maxadultchild = Number(maxadultchild - toadult);

                          maxadultchild = Number(maxadultchild - tochild);


                          if (maxadultchild > 0) {
                            selectadultad(id, selectdiv);
                          } else {
                            alert('You can not select more then 9 (Adult + Child)');
                          }





                        }



                        function selectadultad(id, selectdiv) {



                          $('.' + selectdiv + ' .paxbx').removeClass('active');





                          if (selectdiv == 'adt') {

                            $('#ADT').val(id);

                            $('#adt' + id).addClass('active');

                            selectpaxs();

                          }



                          if (selectdiv == 'chd') {

                            $('#chd' + id).addClass('active');

                            $('#CHD').val(id);

                            selectpaxs();

                          }







                          if (selectdiv == 'inft') {

                            $('#inft' + id).addClass('active');

                            $('#INF').val(id);

                            selectpaxs();

                          }



                        }
                      </script>



                      <div id="mobileflightsearchpax" class="dropdown-menu dropdown-unfold col-11 m-0 fullwidth" aria-labelledby="basicDropdownClickInvoker" style="max-width: 370px; right: 0px; display: block; border-radius: 10px; width: 100%; display:none; left:0px;"> 

                        <div class=" " style="margin-bottom: 10px;"> 

                          <div class="js-quantity mx-1 row align-items-center justify-content-between">

                            <div class="phnonetraveltext" style="margin-bottom: 10px; width:100%; position:relative;">

                              <strong>Travellers</strong> <span style="position: absolute; right: 10px; cursor: pointer; top: 4px; font-size: 14px; color: #fff; background-color: #000; display: inline-block; padding: 3px 5px; border-radius: 4px;" onClick="$('#mobileflightsearchpax').hide();">Done</span>

                            </div>



                            <span class="font-weight-medium" style="argin-bottom: 0px;">Adults</span>

                            <div class="d-flex phonecalendar">

                              <div class="boxselectpax adt">

                                <div class="paxbx active" id="adt1" onClick="countadultchild('1','adt');">1</div>

                                <div class="paxbx" id="adt2" onClick="countadultchild('2','adt');">2</div>

                                <div class="paxbx" id="adt3" onClick="countadultchild('3','adt');">3</div>

                                <div class="paxbx" id="adt4" onClick="countadultchild('4','adt');">4</div>


                                <div class="paxbx" id="adt5" onClick="countadultchild('5','adt');">5</div>

                                <div class="paxbx" id="adt6" onClick="countadultchild('6','adt');">6</div>

                                <div class="paxbx" id="adt7" onClick="countadultchild('7','adt');">7</div>

                                <div class="paxbx" id="adt8" onClick="countadultchild('8','adt');">8</div>

                                <div class="paxbx" id="adt9" onClick="countadultchild('9','adt');">9</div>

                              </div>

                            </div>







                            <div class="d-flex phonecalendar" style="display:none !important;">



                              <select id="ADT" name="ADT" class="form-control" onChange="selectpaxs();">

                                <option value="1" <?php echo ($ADT == 1 ? 'selected' : ''); ?>>1</option>

                                <option value="2" <?php echo ($ADT == 2 ? 'selected' : ''); ?>>2</option>

                                <option value="3" <?php echo ($ADT == 3 ? 'selected' : ''); ?>>3</option>

                                <option value="4" <?php echo ($ADT == 4 ? 'selected' : ''); ?>>4</option>

                                <option value="5" <?php echo ($ADT == 5 ? 'selected' : ''); ?>>5</option>

                                <option value="6" <?php echo ($ADT == 6 ? 'selected' : ''); ?>>6</option>

                                <option value="7" <?php echo ($ADT == 7 ? 'selected' : ''); ?>>7</option>

                                <option value="8" <?php echo ($ADT == 8 ? 'selected' : ''); ?>>8</option>

                                <option value="9" <?php echo ($ADT == 9 ? 'selected' : ''); ?>>9</option>

                              </select>

                            </div>

                          </div>

                        </div>

                        <div class="" style="margin-bottom: 10px;">

                          <div class="js-quantity mx-1 row align-items-center justify-content-between"> <span class="d-block font-size-16 text-secondary font-weight-medium">Children (2 - 12 Years )</span>



                            <div class="d-flex phonecalendar">

                              <div class="boxselectpax chd">

                                <div class="paxbx active" id="chd0" onClick="countadultchild('0','chd');">0</div>

                                <div class="paxbx" id="chd1" onClick="countadultchild('1','chd');">1</div>

                                <div class="paxbx" id="chd2" onClick="countadultchild('2','chd');">2</div>

                                <div class="paxbx" id="chd3" onClick="countadultchild('3','chd');">3</div>

                                <div class="paxbx" id="chd4" onClick="countadultchild('4','chd');">4</div>

                                <div class="paxbx" id="chd5" onClick="countadultchild('5','chd');">5</div>

                                <div class="paxbx" id="chd6" onClick="countadultchild('6','chd');">6</div>

                                <div class="paxbx" id="chd7" onClick="countadultchild('7','chd');">7</div>

                                <div class="paxbx" id="chd8" onClick="countadultchild('8','chd');">8</div>

                              </div>

                            </div>



                            <div class="d-flex phonecalendar" style="display:none !important;">

                              <select id="CHD" name="CHD" class="form-control" onChange="selectpaxs();">

                                <option value="0" <?php echo ($CHD == 0 ? 'selected' : ''); ?>>0</option>

                                <option value="1" <?php echo ($CHD == 1 ? 'selected' : ''); ?>>1</option>

                                <option value="2" <?php echo ($CHD == 2 ? 'selected' : ''); ?>>2</option>

                                <option value="3" <?php echo ($CHD == 3 ? 'selected' : ''); ?>>3</option>

                                <option value="4" <?php echo ($CHD == 4 ? 'selected' : ''); ?>>4</option>

                                <option value="5" <?php echo ($CHD == 5 ? 'selected' : ''); ?>>5</option>

                                <option value="6" <?php echo ($CHD == 6 ? 'selected' : ''); ?>>6</option>

                                <option value="7" <?php echo ($CHD == 7 ? 'selected' : ''); ?>>7</option>

                                <option value="8" <?php echo ($CHD == 8 ? 'selected' : ''); ?>>8</option>

                              </select>

                            </div>

                          </div>

                        </div>

                        <div class="" style="margin-bottom: 10px;">

                          <div class="js-quantity mx-1 row align-items-center justify-content-between"> <span class="d-block font-size-16 text-secondary font-weight-medium">Infants (0-2 Months)</span>



                            <div class="d-flex phonecalendar">

                              <div class="boxselectpax inft">

                                <div class="paxbx active" id="inft0" onClick="selectadultad('0','inft');">0</div>

                                <div class="paxbx" id="inft1" onClick="selectadultad('1','inft');">1</div>

                                <div class="paxbx" id="inft2" onClick="selectadultad('2','inft');">2</div>

                                <div class="paxbx" id="inft3" onClick="selectadultad('3','inft');">3</div>

                                <div class="paxbx" id="inft4" onClick="selectadultad('4','inft');">4</div>

                                <div class="paxbx" id="inft5" onClick="selectadultad('5','inft');">5</div>

                                <div class="paxbx" id="inft6" onClick="selectadultad('6','inft');">6</div>

                              </div>

                            </div>

                            <div class="d-flex calendar" style="display:none !important;">

                              <select id="INF" name="INF" class="form-control" onChange="selectpaxs();">

                                <option value="0" <?php echo ($INF == 0 ? 'selected' : ''); ?>>0</option>

                                <option value="1" <?php echo ($INF == 1 ? 'selected' : ''); ?>>1</option>

                                <option value="2" <?php echo ($INF == 2 ? 'selected' : ''); ?>>2</option>

                                <option value="3" <?php echo ($INF == 3 ? 'selected' : ''); ?>>3</option>

                                <option value="4" <?php echo ($INF == 4 ? 'selected' : ''); ?>>4</option>

                                <option value="5" <?php echo ($INF == 5 ? 'selected' : ''); ?>>5</option>

                                <option value="6" <?php echo ($INF == 6 ? 'selected' : ''); ?>>6</option>

                              </select>

                            </div>

                          </div>

                        </div>







                        <div class="" style="margin-bottom: 10px;">

                          <div class="js-quantity mx-1 row align-items-center justify-content-between"> <span class="d-block font-size-16 text-secondary font-weight-medium">Preffered Class</span>

                            <div class="d-flex">

                              <select id="PC" name="PC" class="form-control economybutton" onChange="selectpaxs();">

                                <option value="ECONOMY" <?php if ($PC == 'ECONOMY') {
                                                          echo 'selected';
                                                        } ?>>ECONOMY</option>
                                <option value="PREMIUM_ECONOMY" <?php if ($PC == 'PREMIUM_ECONOMY') {
                                                                  echo 'selected';
                                                                } ?>>PREMIUM ECONOMY</option>
                                <option value="BUSINESS" <?php if ($PC == 'BUSINESS') {
                                                            echo 'selected';
                                                          } ?>>BUSINESS</option>
                                <option value="FIRST" <?php if ($PC == 'FIRST') {
                                                        echo 'selected';
                                                      } ?>>FIRST</option>

                              </select>

                            </div>

                          </div>

                        </div>

                        <script>
                          function selectpaxs() {

                            var ADT = Number($('#ADT').val());

                            var CHD = Number($('#CHD').val());

                            var INF = Number($('#INF').val());

                            var PC = $('#PC').val();






                            $('#travellersshow').val(Number(ADT + CHD + INF) + ' Pax, ' + PC);

                          }
                        </script>







                      </div>

                  </div>
                </li>
              </ul> <!-- flighttabletwo  -->

<ul class="flighttablethree">
                <li class="travellerli" style="padding-bottom: 20px;">
                   <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><label><table border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="2"><input name="psting" type="radio" value="" checked></td>
        <td style="padding-left:3px;">All</td>
      </tr>
      
    </table></label></td>
    <td style="padding-left:10px;"><label><table border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="2"><input name="psting" type="radio" value="Regular"></td>
        <td style="padding-left:3px;">Regular</td>
      </tr>
      
    </table></label></td>
    <td style="padding-left:10px;"><label><table border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="2"><input type="radio" name="psting" value="Student"></td>
        <td style="padding-left:3px;">Student</td>
      </tr>
      
    </table></label></td>
    <td style="padding-left:10px;"><label><table border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="2"><input type="radio" name="psting" value="Senior citizen"></td>
        <td style="padding-left:3px;">Senior Citizen</td>
      </tr>
      
    </table></label></td>
  </tr>
</table>

                </li>
              </ul>

            </div>
          
        </div><!-- searchflight  -->

        <div style="text-align: center; width: 100%;   box-sizing: border-box; margin-bottom: -39px;">
          
            <input name="submit" value="Search" type="submit" class="searchbigbtn" />
         
        </div>
		</form>
      </div><!-- innerbodycard -->
    </div><!-- bodyouter  -->

<?php 
$url = $basesiteurl."topflightsearchpage.php";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);

		$data = array(
		'MemberId' => $_SESSION['userId']
); 

curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
$contents = curl_exec($ch);
$ressearch=json_decode($contents,true); 
curl_close($ch);
	 
	?>
    <div class="topflightsearch" id="rflightsearches">
      <h6>Top Flight Searches</h6>
      <ul class="cardlistinline">
	  
<?php 
	$fs=1;
foreach($ressearch['FlightSearch'] as $list){
	?>
        <li>
          <div class="card flsearchcard">
            <div><i class="fa fa-plane" aria-hidden="true"></i> &nbsp;&nbsp;<?php echo $list['type']; ?></div>
            <ul>
              <li><?php echo $list['from']; ?> </li>
              <li><i class="fa fa-exchange" aria-hidden="true"></i></li>
              <li><?php echo $list['to']; ?></li>
            </ul> 
          </div><!-- flsearchcard  -->
        </li>
 <?php $fs++; } ?>
 
 <?php if($fs==1){ ?>
 <script>
 $('#rflightsearches').hide();
 </script>
 
 <?php } ?>
         
      </ul>
    </div>
	
	 


  <?php $n=1; foreach($contentresmark['Marquee'] as $list){ 


if($list['marqueeType']=='flight'){

if($n==1){

?>
<div class="sectionheading" style="margin-top:10px;"><div style="padding: 12px; background-color: #DDFCFF; font-size: 14px; text-align: center; border-radius: 10px; border: 1px solid #a6ebed;"><?php echo stripslashes($list['name']); ?></div></div>
<?php   }  $n++; }  } ?>

    
<div class="sectionheading" style="margin-top:10px;">Exclusive Flight Deals</div>
 
<div class="packagelistouter">
	<?php 
	foreach($contentoffer['Offers'] as $list){
	if($list['offerType']=='flight'){ 
	?>
	<div class="packagebox" onclick="openWindow('<?php echo $fullurl.'offerdetails.php?id='.$list['Id'].''; ?>');">
	<div class="imgbox">
	<img src="<?php echo $list['banner']; ?>" />
	</div>
	<div class="name"><?php echo stripslashes($list['name']); ?></div> 
	</div>
	
	
	<?php  } }	?>
	
</div>


  </div><!-- mainallcontent  -->
  
  <script>
  
    function swapdata() {

      var pickupCitySearchfromCity = $('#pickupCitySearchfromCity').val();

      var pickupCitySearchfromCity2 = $('#pickupCitySearchfromCity2').val();



      var fromDestinationFlight = $('#fromDestinationFlight').val();

      var fromDestinationFlight2 = $('#fromDestinationFlight2').val();



      $('#pickupCitySearchfromCity').val(pickupCitySearchfromCity2);

      $('#pickupCitySearchfromCity2').val(pickupCitySearchfromCity);



      $('#fromDestinationFlight2').val(fromDestinationFlight);

      $('#fromDestinationFlight').val(fromDestinationFlight2);



    }

 $(document).ready(function() {

      $("#dt1").datepicker({

        dateFormat: "dd-mm-yy",

        minDate: 0,

        onSelect: function() {

          var dt2 = $('#dt2');

          var startDate = $(this).datepicker('getDate');

          //add 30 days to selected date

          startDate.setDate(startDate.getDate() + 30);

          var minDate = $(this).datepicker('getDate');

          var dt2Date = dt2.datepicker('getDate');

          //difference in days. 86400 seconds in day, 1000 ms in second

          var dateDiff = (dt2Date - minDate) / (86400 * 1000);



          //dt2 not set or dt1 date is greater than dt2 date

          if (dt2Date == null || dateDiff < 0) {

            dt2.datepicker('setDate', minDate);

          }

          //dt1 date is 30 days under dt2 date
          else if (dateDiff > 30) {

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

        minDate: 0,
        onSelect: function() {

        }

      });



    });


 function changeselectsearchtype() {

      var selectsearchtype = Number($('#selectsearchtype').val());

      if (selectsearchtype < 4) {

        selecttb(selectsearchtype);

      }



      if (selectsearchtype == 4) {

        $("#groupenquiryid").trigger("click");

      }

      $('#selectsearchtype').val(1);

    }



function selecttb(id) {

      $('#returndiv').show();

      $('#searchbuttonflight').show();

      $('#submitbuttonflight').hide();

      $('#notediv').hide();





      if (id == 1) {

        $('#tb2').removeClass('active');

        $('#tb3').removeClass('active');

        $('#tb4').removeClass('active');

        $('#tb1').addClass('active');

        $('#tripType').val('1');

        $('#dt2').attr('disabled', 'true');

        $('#dt3').attr('disabled', 'true');

        $('#dt2').css('color', '#fafafa');

        $('#fixedDeparture').val('0');

        $('.selectreturnflightcl').hide();

      }

      if (id == 2) {

        $('.selectreturnflightcl').show();

        $('#tb1').removeClass('active');

        $('#tb3').removeClass('active');

        $('#tb4').removeClass('active');

        $('#tb2').addClass('active');

        $('#tripType').val('2');

        $('#dt2').removeAttr('disabled');

        $('#dt3').removeAttr('disabled');

        $('#dt2').css('color', '#333333');

        $('#fixedDeparture').val('0');

      }

      if (id == 3) {

        /*$('#tb1').removeClass('active');

        $('#tb2').removeClass('active');

        $('#tb4').removeClass('active');

        $('#tb3').addClass('active');

        $('#tripType').val('1');

        $('#dt2').attr('disabled','true');

        $('#dt1').removeAttr('disabled');

        $('#dt2').css('color','#fafafa');

        $('#fixedDeparture').val('1');*/



        $('.selectreturnflightcl').show();

        $('#tb1').removeClass('active');

        $('#tb2').removeClass('active');

        //$('#tb3').removeClass('active');

        $('#tb4').removeClass('active');

        $('#tb3').addClass('active');

        $('#tripType').val('3');

        $('#dt2').removeAttr('disabled');

        $('#dt3').removeAttr('disabled');

        $('#dt2').css('color', '#333333');

        $('#fixedDeparture').val('0');







      }



      if (id == 4) {

        $('#returndiv').hide();

        $('#tb1').removeClass('active');

        $('#tb2').removeClass('active');

        $('#tb3').removeClass('active');

        $('#tb4').addClass('active');

        $('#formids').attr('target', 'actoinfrm');

        $('#formids').attr('action', 'actionpage.php');

        $('#tripType').val('4');

        $('#notediv').show();



        $('#searchbuttonflight').hide();

        $('#submitbuttonflight').show();

      }





    }

 
    function getflightSearchCIty(citysearchfield, cityresultfield, listsearch) {

      var citysearchfieldval = encodeURI($('#' + citysearchfield).val());

      var citysearchfield = citysearchfield;



      if (citysearchfieldval != '') {

        $('#' + listsearch).show();

        $('#' + listsearch).load('searchflightcitylists.php?keyword=' + citysearchfieldval + '&searchcitylists=' + listsearch + '&cityresultfield=' + cityresultfield + '&citysearchfield=' + citysearchfield);

      }

    }


 
  </script>
  <?php
  include "footerinc.php";
  ?>

</body>

</html>