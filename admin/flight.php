<?php
$_SESSION['pgc']='2';
$tripType=1;
if($_REQUEST['tripType']!=''){
$tripType=$_REQUEST['tripType'];
}
$fixedDeparture=0;
if($_REQUEST['fixedDeparture']!=''){
$fixedDeparture=$_REQUEST['fixedDeparture'];
}
$PC='EC';
if($_REQUEST['PC']!=''){
$PC=$_REQUEST['PC'];
}

$travellers='1 Pax, Economy';
if($_REQUEST['travellers']!=''){
$travellers=$_REQUEST['travellers'];
}

$fromcitydesti='DEL - NEW DELHI';
if($_REQUEST['fromcitydesti']!=''){
$fromcitydesti=$_REQUEST['fromcitydesti'];
}


$fromDestinationFlight='DEL-India';
if($_REQUEST['fromDestinationFlight']!=''){
$fromDestinationFlight=$_REQUEST['fromDestinationFlight'];
}

$tocitydesti='BOM - MUMBAI';
if($_REQUEST['tocitydesti']!=''){
$tocitydesti=$_REQUEST['tocitydesti'];
}

$toDestinationFlight='BOM-India';
if($_REQUEST['toDestinationFlight']!=''){
$toDestinationFlight=$_REQUEST['toDestinationFlight'];
}


$journeyDateOne=date('d-m-Y');;
if($_REQUEST['journeyDateOne']!=''){
$journeyDateOne=$_REQUEST['journeyDateOne'];
}
  
$journeyDateRound=date('d-m-Y', strtotime('+1 days'));
if($_REQUEST['journeyDateRound']!=''){
$journeyDateRound=$_REQUEST['journeyDateRound'];
}
 

if(trim($_REQUEST['action'])=="flightpostaction"){

unset($_SESSION['uniqueId']);
if($_SESSION['uniqueId']==''){
	$_SESSION['uniqueId'] = uniqid();
}

$jsonAuth = '{
   "TYPE":"AUTH",
   "NAME":"GET_AUTH_TOKEN",
   "STR":[
      {
         "A_ID":"'.$A_ID.'",
         "U_ID":"'.$U_ID.'",
         "PWD":"'.$PWD.'",
         "MODULE":"'.$MODULE.'",
         "HS":"'.$hitSource.'"
      }
   ]
}';

//logger("JSON POST FOR AUTH: ".$jsonAuth);
if($_REQUEST['fixedDeparture']!=1){
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$TokenUrl);
curl_setopt($ch, CURLINFO_HEADER_OUT, true);
curl_setopt($ch, CURLOPT_POST,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonAuth);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
$responseAuth = curl_exec($ch); 
curl_close($ch);
$responseAuthArr = json_decode($responseAuth);

//logger("Response return from auth API: ".$responseAuth);


 
}



$tokenId = trim($responseAuthArr->RESULT);
$newSessionId = trim($_SESSION['uniqueId']);
$tripType = trim($_REQUEST['tripType']);
$fromDestinationFlight = trim($_REQUEST['fromDestinationFlight']);
$toDestinationFlight = trim($_REQUEST['toDestinationFlight']);
$journeyDateOne = trim($_REQUEST['journeyDateOne']);
$journeyDateRound = trim($_GET['journeyDateRound']);

$ADT = trim($_REQUEST['ADT']);
$CHD = trim($_REQUEST['CHD']);
$INF = trim($_REQUEST['INF']);
$PC = trim($_REQUEST['PC']);
$toalPaxFinal=$ADT+$CHD+$INF;
$toalPax=$ADT+$CHD;

if($tripType=='1'){ 
	 $journeyDate = date('Y-m-d',strtotime($journeyDateOne));
	 $returnDate = '';
}else{ 
	 
	 $journeyDate = date('Y-m-d',strtotime($journeyDateOne));
	 $returnDate = date('Y-m-d',strtotime($journeyDateRound));
}

$fromdestexp = explode('-',$fromDestinationFlight);
$todestexp = explode('-',$toDestinationFlight);

if (strstr($fromdestexp[1],'India')=='India' && strstr($todestexp[1],'India')=='India') {
  $SECTOR = 'D';
} else {
  $SECTOR = 'I';
}



$jsonPost = '{
			 "TYPE": "AIR",
			 "NAME": "GET_FLIGHT",
			 "STR": [
					 {
						 "AUTH_TOKEN": "'.$tokenId.'",
						 "SESSION_ID": "",
						 "TRIP": "'.$tripType.'",
						 "SECTOR": "'.$SECTOR.'",
						 "SRC": "'.$fromdestexp[0].'",
						 "DES": "'.$todestexp[0].'",
						 "DEP_DATE": "'.$journeyDate.'",
						 "RET_DATE": "'.$returnDate.'",
						 "ADT": "'.$ADT.'",
						 "CHD": "'.$CHD.'",
						 "INF": "'.$INF.'",
						 "PC": "'.$PC.'",
						 "PF": "",
						 "HS": "'.$hitSource.'",
					 }
					]
			}';
			
//logger('JSON POST FOR FLIGHT SEARCH: '.$jsonPost);	
//echo $FlightSearchUrl;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$FlightSearchUrl);
curl_setopt($ch, CURLINFO_HEADER_OUT, true);
curl_setopt($ch, CURLOPT_POST,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonPost);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
$response = curl_exec($ch); 
curl_close($ch);

$data = json_decode($response);		


 
//logger("Response return from flight Search API: ".$response);

}
$flightType=$SECTOR;
?>
 
<script>
function selecttb(id){
$('#returndiv').show();
$('#searchbuttonflight').show();
$('#submitbuttonflight').hide();
$('#notediv').hide();
$('#formids').removeAttr('target');
$('#formids').attr('action','display.html');


if(id==1){
$('#tb2').removeClass('active');
$('#tb3').removeClass('active');
$('#tb4').removeClass('active');
$('#tb1').addClass('active');
$('#tripType').val('1');
$('#dt2').attr('disabled','true');
$('#dt3').attr('disabled','true');
$('#dt2').css('color','#fafafa');
$('#fixedDeparture').val('0');
}
if(id==2){
$('#tb1').removeClass('active');
$('#tb3').removeClass('active');
$('#tb4').removeClass('active');
$('#tb2').addClass('active');
$('#tripType').val('2');
$('#dt2').removeAttr('disabled');
$('#dt3').removeAttr('disabled');
$('#dt2').css('color','#333333');
$('#fixedDeparture').val('0');
} 
if(id==3){
$('#tb1').removeClass('active');
$('#tb2').removeClass('active');
$('#tb4').removeClass('active');
$('#tb3').addClass('active');
$('#tripType').val('1');
$('#dt2').attr('disabled','true');
$('#dt1').removeAttr('disabled');
$('#dt2').css('color','#fafafa');
$('#fixedDeparture').val('1');
}

if(id==4){
$('#returndiv').hide();
$('#tb1').removeClass('active');
$('#tb2').removeClass('active');
$('#tb3').removeClass('active');
$('#tb4').addClass('active');
$('#formids').attr('target','actoinfrm');
$('#formids').attr('action','actionpage.php');
$('#tripType').val('4');
$('#notediv').show();

$('#searchbuttonflight').hide();
$('#submitbuttonflight').show();
}


}
</script>
<style>
.sharechecked{display:none;}
.sharecheckedret{display:none;}
.searchboxblue{background-color:transparent;}
.mid { background-color: #fff; padding: 10px ; border-radius: 20px ; padding-bottom: 38px ; }

.tab{display:block;}
.gbutton{bottom: -36px ; left: 45%; position:absolute;}
#selectsearchtypediv{display:none;}

.flightsearchboxxx{max-width: 1300px; margin: auto; width: 1300px;}
@media (max-width: 800px){
.flightsearchboxxx{max-width: 1300px; margin: auto; width:100% !Important; }
.gbutton{ position:relative; left:0px; bottom:0px;}
.gbutton label{display:none;}
.gbutton .btn-primary{width:100%;}

.searchboxblue{padding:10px 10px !important; }

.searchboxblue .tab a {margin-left: 10px !important;}
.searchboxblue .mid{width:100% !important; box-sizing:border-box !important;}
.searchboxblue .card-body{padding:0px !important;}

.tab{display:none;}

.searchboxblue .form-group { margin-bottom: 10px !important;}
.gbutton .form-group{margin-bottom:0px !important; }
#selectsearchtypediv{display:block;}
.sortdivmain{display:none;}
.notshowmobile{display:none;}


.sidebarfilter {
    position: fixed !important;
    bottom: 0px !important;
    margin-bottom: 0px !important;
    left: 0px !important;
    padding: 12px !important;
    z-index: 9 !important;
    background-color: #000000 !important;
    box-shadow: 0 0 0 !important;
    color: #fff !important;
    width: 33%;
    border-radius: 0px;
}

.sidebarfilter span { color: #fff !important; padding-left: 0px; margin-left: 0px !important; font-size: 14px; }

.whatsappsharebtn {
    color: #fff !important;
    padding: 13.6px !important;
    background-color: #46C156 !important;
    position: fixed !important;
    z-index: 9 !important;
    left: 33% !important;
    bottom: 0px !important;
    width: 33% !important;
    text-align: center; 
}



.emailsharebtn {
    color: #fff !important;
    padding: 13.6px !important;
    background-color: #0b85f9 !important;
    position: fixed !important;
    z-index: 9 !important;
    left: 66% !important;
    bottom: 0px !important;
    width: 33% !important;
    text-align: center; display:block !important;
}

}

@media (min-width: 1200px){ .ml-xl-5, .mx-xl-5 { margin-left: 2rem !important; margin-right: 20px; }


 }
.ui-widget.ui-widget-content{top: 58px !important;}
</style>




	   
<div class="searchboxblue" style="margin-top: -20px; background-image:url(images/flightheaderbg.png) !important;">
<div class="mid">
<div class="content"> 
<div class="tab">
<a style="cursor:pointer;" class="active" id="tb1" onclick="selecttb(1);"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> ONE-WAY</a>
<a style="cursor:pointer;" id="tb2" onclick="selecttb(2);"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> ROUND-TRIP</a>
<a style="cursor:pointer;" id="tb3" onclick="selecttb(3);"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> FIXED DEPARTURE</a>
<a style="cursor:pointer;" id="groupenquiryid" onclick="loadpop('Group Enquiry',this,'800px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=groupenquiry"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> GROUP ENQUIRY</a>




</div>
<div class="card" style="margin-bottom: 0px ; margin-top: -2px ; border: 0px ; box-shadow: 0px 0px;">
<div class="card-body" style="margin-bottom: 0px ; margin-top: -2px ; border: 0px ; box-shadow: 0px 0px 10px #fff;">
   <form class="js-validate" method="GET" id="formids" action="display.html" >
                <input type="hidden" name="tripType" id="tripType" value="<?php echo $tripType; ?>">
				<input type="hidden" name="fixedDeparture" id="fixedDeparture" value="<?php echo $fixedDeparture; ?>">
 <div class="row">

<div class="col-lg-2" id="selectsearchtypediv">
<div class="form-group">
<script>
function changeselectsearchtype(){
var selectsearchtype = Number($('#selectsearchtype').val());
if(selectsearchtype<4){
selecttb(selectsearchtype);
}

if(selectsearchtype==4){ 
$( "#groupenquiryid" ).trigger( "click" );
}
$('#selectsearchtype').val(1);
}
</script>
<select  id="selectsearchtype" name="selectsearchtype" onchange="changeselectsearchtype();" class="form-control" >
  <option value="1" <?php if($_REQUEST['selectsearchtype']==1){?>selected="selected"<?php } ?>>ONE-WAY</option>
  <option value="2" <?php if($_REQUEST['selectsearchtype']==2){?>selected="selected"<?php } ?>>ROUND-TRIP</option>
  <option value="3" <?php if($_REQUEST['selectsearchtype']==3){?>selected="selected"<?php } ?>>FIXED DEPARTURE</option>
  <option value="4" <?php if($_REQUEST['selectsearchtype']==4){?>selected="selected"<?php } ?>>GROUP ENQUIRY</option> 
</select>

</div>
</div>
<style>
.swapbtn {
    position: absolute;
    right: -9px;
    bottom: 14px;
    padding: 2px;
    background-color: #fff;
    cursor: pointer;
    z-index: 99;
}
</style>

<div class="col-lg-2" style="position:relative;">
<div class="swapbtn" onclick="swapdata();"><i class="fa fa-exchange" aria-hidden="true"></i></div>
<div class="form-group">
<label>From</label> 
<div style="height:0px; font-size:0px; position:relative; width: 100%; text-align: left;" id="searchcitylistsfromCity"></div>
<input type="text" onClick="$('#pickupCitySearchfromCity').select();" class="form-control" requered="" onKeyUp="getflightSearchCIty('pickupCitySearchfromCity','fromDestinationFlight','searchcitylistsfromCity');" id="pickupCitySearchfromCity" name="fromcitydesti" value="<?php echo $fromcitydesti; ?>"  autocomplete="off" >
<input name="fromDestinationFlight" id="fromDestinationFlight" type="hidden" value="<?php echo $fromDestinationFlight; ?>" autocomplete="nope">
</div>
</div>
<script>
function swapdata(){
var pickupCitySearchfromCity = $('#pickupCitySearchfromCity').val();
var pickupCitySearchfromCity2 = $('#pickupCitySearchfromCity2').val();

var fromDestinationFlight = $('#fromDestinationFlight').val();
var fromDestinationFlight2 = $('#fromDestinationFlight2').val();

$('#pickupCitySearchfromCity').val(pickupCitySearchfromCity2);
$('#pickupCitySearchfromCity2').val(pickupCitySearchfromCity);

$('#fromDestinationFlight2').val(fromDestinationFlight);
$('#fromDestinationFlight').val(fromDestinationFlight2);

}

</script>
<div class="col-lg-2">
<div class="form-group">
<label>To</label> 
<div style="height:0px; font-size:0px; position:relative; width: 100%; text-align: left;" id="searchcitylistsfromCity2"></div>
													<input type="text" onClick="$('#pickupCitySearchfromCity2').select();" class="form-control" requered="" onKeyUp="getflightSearchCIty('pickupCitySearchfromCity2','fromDestinationFlight2','searchcitylistsfromCity2');" id="pickupCitySearchfromCity2" name="tocitydesti" value="<?php echo $tocitydesti; ?>"  autocomplete="off"  >
													<input name="toDestinationFlight" id="fromDestinationFlight2" type="hidden" value="<?php echo $toDestinationFlight; ?>" autocomplete="nope"> 

</div>
</div>


<div class="col-lg-2">
<div class="form-group">
<label>Departure</label> 
 <input type="text" id="dt1" name="journeyDateOne" class="form-control"  value="<?php echo trim($journeyDateOne); ?>" autocomplete="off"  >
</div>
</div>


<div class="col-lg-2" id="returndiv">
<div class="form-group"  onclick="selecttb(2);">
<label>Return</label> 
 <input type="text" id="dt2" name="journeyDateRound" class="form-control"  value="<?php echo trim($journeyDateRound); ?>" autocomplete="off" <?php if($tripType==1){ ?>disabled  style="color:#fafafa;" <?php } ?>>
</div>
</div>
<?php if($tripType==2){ ?>
<script>selecttb(2);</script>
<?php } ?>
<?php if($fixedDeparture==1){ ?>
<script>selecttb(3);</script>
<?php } ?>
<div class="col-lg-4">
<div class="form-group">
<label>Travellers | Class</label> 
 <input type="text" id="travellersshow"  class="form-control"  value="<?php echo trim($travellers); ?>" autocomplete="off" readonly="readonly" onclick="$('#basicDropdownClick').show();"  >
 
  <script>
  $('#basicDropdownClick').click(function(event){
  event.stopPropagation();
});
  </script>
 
 <div id="basicDropdownClick" class="dropdown-menu dropdown-unfold col-11 m-0" aria-labelledby="basicDropdownClickInvoker" style="max-width: 300px; width: 250px;">
                   
					  
					  <div class=" "  style="margin-bottom: 10px;">
					  
					  
					  
                        <div class="js-quantity mx-3 row align-items-center justify-content-between">
						   <div class=" "  style="margin-bottom: 10px; width:100%; position:relative;">
					  <strong>Travellers</strong> <i class="fa fa-times" aria-hidden="true" style="position: absolute; right: 0px; cursor: pointer; top: 4px; font-size: 16px; color: #000;" onclick="$('#basicDropdownClick').hide();"></i>
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
                      <div class=" ">
                        <div class="js-quantity mx-3 row align-items-center justify-content-between"> <span class="d-block font-size-16 text-secondary font-weight-medium" style="padding-bottom:4px; display:block;">Preffered Class</span>
                     <select id="PC" name="PC" class="form-control" onChange="selectpaxs();" > 
                              <option value="EC" <?php if($PC=='EC'){ echo 'selected'; }?>>Economy Class</option>
                              <option value="BU" <?php if($PC=='BU'){ echo 'selected'; }?>>Business Class</option>
                            </select>
							
							
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
                        </div>
                      </div>
                      <div class="w-100 text-right py-1 pr-5">
                        <!--<a class="text-primary font-weight-semi-bold font-size-16" href="#">Done</a>-->
                      </div>
                    </div>
</div>
</div>

<div class="col-lg-2" id="notediv" style="display:none;">
<div class="form-group">
<label>Note</label> 
 <input type="text" id="notes" name="notes" class="form-control"  value="">
</div>
</div>

<div class="col-lg-1 gbutton">
<div class="form-group" >
<label style=" width: 100%; height:14px;"> </label> 
<button type="submit" class="btn btn-primary" id="searchbuttonflight" style="background-color: #6ec1a5; border: 1px solid #6ec1a5; border-radius: 30px ;" onclick="$('#flightloadingbox').show();">Search &nbsp; <i class="fa fa-search" aria-hidden="true"></i></button>
<button type="submit" class="btn btn-primary" id="submitbuttonflight" style="display:none;">Submit</button>
</div>
</div>



 </div>
<input type="hidden" name="action" value="flightpostaction" >
<input name="ga" type="hidden" id="ga" value="<?php echo $_REQUEST['ga']; ?>"></form>
</div>
</div>

</div>
</div>
</div>

<div class="page-content pt-3 flightsearchboxxx" >  
			<!-- Content area -->
			<div class="content"> 
			<div class="row" >
<?php if($_REQUEST['tocitydesti']!=''){ ?>
 
						<div class="col-xl-3">
			<div class="card"> 
					   <div class="navbar-expand-xl navbar-expand-xl-collapse-block">
          <button onclick="$(document).scrollTop(0);" class="btn d-xl-none mb-5 p-0 collapsed sidebarfilter" type="button" data-toggle="collapse" data-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation"> <i class="far fa-caret-square-down text-primary font-size-20 card-btn-arrow ml-0"></i> <span class="text-primary ml-2"><i class="fa fa-filter" aria-hidden="true"></i> Filter</span> </button>
          <div id="sidebar" class="collapse navbar-collapse" >
            <div class="mb-6 w-100">
              <div class="sidenav border border-color-8 rounded-xs" id="allFilterDiv" >
                <!-- Accordiaon -->
                <div id="shopCategoryAccordion" class="accordion rounded-0 shadow-none">
                  <div class="border-0">
                     
					<div class="tabsleftheadings">Stops</div>
					
					
                    <div id="flightstopfilter" class="collapse show" aria-labelledby="shopCategoryHeadingOne" data-parent="#shopCategoryAccordion">
                      <div class="card-body pt-0 mt-1 px-5 pb-2">
                        <!-- Checkboxes -->
                        <div class="form-group d-flex align-items-center justify-content-between font-size-1 text-lh-md text-gray-1 mb-3" id="nonstopdiv">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="nonstop" value="Non Stop">
                            <label class="custom-control-label" for="nonstop" >Non Stop</label>
                          </div>
                          <small id="totalNonstop"></small> </div>
                        <div class="form-group d-flex align-items-center justify-content-between font-size-1 text-lh-md text-gray-1 mb-3" id="onestopdiv">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="onestop" value="1 Stop">
                            <label class="custom-control-label" for="onestop" >1 Stop</label>
                          </div>
                          <small id="totalOnestop"></small> </div>
                        <div class="form-group d-flex align-items-center justify-content-between font-size-1 text-lh-md text-gray-1 mb-3" id="twostopdiv">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="twostop" value="2 Stop">
                            <label class="custom-control-label" for="twostop" >2 Stop</label>
                          </div>
                          <small id="totalTwostop"></small> </div>
                        <div class="form-group d-flex align-items-center justify-content-between font-size-1 text-lh-md text-gray-1 mb-3" id="threestopdiv">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="threestop" value="3 Stop">
                            <label class="custom-control-label" for="threestop" >3 Stop</label>
                          </div>
                          <small id="totalThreestop"></small> </div>
                        <!-- End Checkboxes -->
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Accordion -->
				<?php if($tripType=='2'){ ?>
				<!--Return journey stop-->
				<div id="shopCategoryAccordionReturn" class="accordion rounded-0 shadow-none">
                  <div class="border-0"> 
					<div class="tabsleftheadings">Return Stops</div>
					
                    <div id="flightstopfilterReturn" class="collapse show" aria-labelledby="shopCategoryHeadingOneReturn" data-parent="#shopCategoryAccordionReturn">
                      <div class="card-body pt-0 mt-1 px-5 pb-2">
                        <!-- Checkboxes -->
                        <div class="form-group d-flex align-items-center justify-content-between font-size-1 text-lh-md text-gray-1 mb-3" id="nonstopdivret">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="nonstopret" value="Non Stop">
                            <label class="custom-control-label" for="nonstopret" >Non Stop</label>
                          </div>
                          <small id="totalNonstopret"></small> </div>
                        <div class="form-group d-flex align-items-center justify-content-between font-size-1 text-lh-md text-gray-1 mb-3" id="onestopdivret">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="onestopret" value="1 Stop">
                            <label class="custom-control-label" for="onestopret" >1 Stop</label>
                          </div>
                          <small id="totalOnestopret"></small> </div>
                        <div class="form-group d-flex align-items-center justify-content-between font-size-1 text-lh-md text-gray-1 mb-3" id="twostopdivret">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="twostopret" value="2 Stop">
                            <label class="custom-control-label" for="twostopret" >2 Stop</label>
                          </div>
                          <small id="totalTwostopret"></small> </div>
                        <div class="form-group d-flex align-items-center justify-content-between font-size-1 text-lh-md text-gray-1 mb-3" id="threestopdivret">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="threestopret" value="3 Stop">
                            <label class="custom-control-label" for="threestopret" >3 Stop</label>
                          </div>
                          <small id="totalThreestopret"></small> </div>
                        <!-- End Checkboxes -->
                      </div>
                    </div>
                  </div>
                </div>
				<!---Return journey stop end----->
				<?php } ?>
                <!-- Accordiaon -->
                <div id="shopCartAccordion" class="accordion rounded shadow-none border-top">
                  <div class="border-0">
                     
					<div class="tabsleftheadings">Price Range</div>
					
					
                    <div id="shopCardOne" class="collapse show" aria-labelledby="shopCardHeadingOne" data-parent="#shopCartAccordion">
                      <div class="card-body pt-0 px-2">
                        
                        <div class="demo__body">
                          <input id="demo_1" type="text" name="" value="" class="irs-hidden-input" tabindex="-1" readonly="" style="display:none;">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Accordion -->
                <div id="facilityCategoryAccordion" class="accordion rounded-0 shadow-none border-top">
                  <div class="border-0">
                     
					
									<div class="tabsleftheadings">Airlines</div>
					
                    <div id="filterFlightName" class="collapse show" aria-labelledby="facilityCategoryHeadingOne" data-parent="#facilityCategoryAccordion">
                      <div class="card-body pt-0 mt-1 px-5 pb-2">
                        <?php
														$a=GetPageRecord('id,name','sys_flightName','1 order by id asc limit 6'); 
														while($res=mysqli_fetch_array($a)){
														?>
                        <div class="form-group d-flex align-items-center justify-content-between font-size-1 text-lh-md text-gray-1 mb-3" id="filterFlightNameDiv<?php echo $res['id']; ?>">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="flightName<?php echo $res['id']; ?>" value="<?php echo $res['name']; ?>">
                            <label class="custom-control-label" for="flightName<?php echo $res['id']; ?>"><?php echo $res['name']; ?></label>
                          </div>
                          <small id="flightNamecount<?php echo $res['id']; ?>"></small> </div>
						  
						  
						   
                        <?php } ?>
                        <!-- End Checkboxes -->
                        <!-- View More - Collapse -->
                        <div class="collapse" id="collapseBrand1">
<?php
$a1=GetPageRecord('id,name','sys_flightName','1 order by id asc limit 6,25'); 
$count=mysqli_num_rows($a);
while($res1=mysqli_fetch_array($a1)){
?>
                          <div class="form-group d-flex align-items-center justify-content-between font-size-1 text-lh-md text-gray-1 mb-1" id="filterFlightNameDiv<?php echo $res1['id']; ?>">
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="flightName<?php echo $res1['id']; ?>" value="<?php echo $res1['name']; ?>">
                              <label class="custom-control-label" for="flightName<?php echo $res1['id']; ?>"><?php echo $res1['name']; ?></label>
                            </div>
                            <small id="flightNamecount<?php echo $res1['id']; ?>"></small> </div>
                          <?php } ?>
                        </div>
           
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Accordion -->
                <div id="propertyCategoryAccordion" class="accordion rounded-0 shadow-none border-top">
                  <div class="border-0">
                     
					<div class="tabsleftheadings">Flight Type</div>
					
					
                    <div id="FlightTypeFilter" class="collapse show" aria-labelledby="propertyCategoryHeadingOne" data-parent="#propertyCategoryAccordion">
                      <div class="card-body pt-0 mt-1 px-5 pb-2">
                          <?php if($_REQUEST['PC']=='BU'){ ?>
					    <div class="form-group d-flex align-items-center justify-content-between font-size-1 text-lh-md text-gray-1 mb-3" id="FlightTypeDivBusi">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="Business" value="Business">
                            <label class="custom-control-label" for="Business">Business</label>
                          </div>
                          <small id="totalBusiness"></small> </div>
						  	  <?php  }?> 
                       <?php if($_REQUEST['PC']=='EC'){ ?>
                        <div class="form-group d-flex align-items-center justify-content-between font-size-1 text-lh-md text-gray-1 mb-3" id="FlightTypeDivEco">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="Economy" value="Economy">
                            <label class="custom-control-label" for="Economy">Economy</label>
                          </div>
                          <small id="totalEconomy"></small> </div>
						  <?php  }?> 
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Accordion -->
				
				<!-- End Accordion -->
                <div id="propertyCategoryAccordion" class="accordion rounded-0 shadow-none border-top">
                  <div class="border-0">
                     
					<div class="tabsleftheadings">Depart Time</div>
					  
					
                    <div id="FlightTimeFilter" class="collapse show" aria-labelledby="propertyCategoryHeadingOne" data-parent="#propertyCategoryAccordion">
                      <div class="card-body pt-0 mt-1 px-5 pb-2"> 
					    <div class="form-group d-flex align-items-center justify-content-between font-size-1 text-lh-md text-gray-1 mb-3" id="FlightTimeDivBusi">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="timing00-06" value="00|01|02|03|04|05|06">
                            <label class="custom-control-label" for="timing00-06">00-06</label>
                          </div>
                          <small id="totaltiming00-06"></small> </div>
						  	 
                      </div>
                    </div>
					<div id="FlightTimeFilter" class="collapse show" aria-labelledby="propertyCategoryHeadingOne" data-parent="#propertyCategoryAccordion">
                      <div class="card-body pt-0 mt-1 px-5 pb-2"> 
					    <div class="form-group d-flex align-items-center justify-content-between font-size-1 text-lh-md text-gray-1 mb-3" id="FlightTimeDivBusi">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="timing06-12" value="06|07|08|09|10|11|12">
                            <label class="custom-control-label" for="timing06-12">06-12</label>
                          </div>
                          <small id="totaltiming06-12"></small> </div>
						  	 
                      </div>
                    </div> 
					<div id="FlightTimeFilter" class="collapse show" aria-labelledby="propertyCategoryHeadingOne" data-parent="#propertyCategoryAccordion">
                      <div class="card-body pt-0 mt-1 px-5 pb-2"> 
					    <div class="form-group d-flex align-items-center justify-content-between font-size-1 text-lh-md text-gray-1 mb-3" id="FlightTimeDivBusi">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="timing12-18" value="12|13|14|15|16|17|18">
                            <label class="custom-control-label" for="timing12-18">12-18</label>
                          </div>
                          <small id="totaltiming12-18"></small> </div>
						  	 
                      </div>
                    </div>
					<div id="FlightTimeFilter" class="collapse show" aria-labelledby="propertyCategoryHeadingOne" data-parent="#propertyCategoryAccordion">
                      <div class="card-body pt-0 mt-1 px-5 pb-2"> 
					    <div class="form-group d-flex align-items-center justify-content-between font-size-1 text-lh-md text-gray-1 mb-3" id="FlightTimeDivBusi">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="timing18-00" value="18|19|20|21|22|23|00">
                            <label class="custom-control-label" for="timing18-00">18-00</label>
                          </div>
                          <small id="totaltiming18-00"></small> </div>
						  	 
                      </div>
                    </div>
					
					
					
					
					
					
					
                  </div>
                </div>
                <!-- End Accordion -->
              </div>
            </div>
          </div>
        </div>
			  </div>
					
					</div>
					
					<div class="col-xl-9">
					 
        <div class="tab-content" id="pills-tabContent">
          <div class="tab-pane fade active show" id="pills-three-example1" role="tabpanel" aria-labelledby="pills-three-example1-tab" data-target-group="groups">
		  
            <div id="alldiv">
			<?php	 
			$sr = 1;
			$flightClass = '';
			if($tripType=='1'){
		
			?>
			<div class="listouter">
			
			<div style="margin-bottom:20px; text-align:right;" class="shareallon">Share By: &nbsp; <a href="#" class="whatsappsharebtn" style="color:#46C156;" onclick="$('.shareallon').hide();$('.sharewhatsapp').show();$('.sharechecked').show();"><i class="fa fa-whatsapp" aria-hidden="true"></i> Whatsapp</a> &nbsp;&nbsp; <a href="#" style="color:#0066CC;" class="emailsharebtn"><i class="fa fa-envelope" aria-hidden="true"></i> Email</a></div>
			
			<div style="margin-bottom:20px; text-align:right; display:none;" class="sharewhatsapp">Share By: &nbsp; <a href="#" onclick="shareonwhatsapp();" class="whatsappsharebtn" style="color:#46C156;"><i class="fa fa-whatsapp" aria-hidden="true"></i> Share</a> &nbsp; <i class="fa fa-times" aria-hidden="true" style="color:#993300; cursor:pointer;" onclick="$('.shareallon').show();$('.sharewhatsapp').hide();$('.sharechecked').hide();" ></i> </div>
			
			
			
			<div class="card" style="background-color: #fff; padding: 10px !important; margin-bottom:20px;">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
			<td align="left" style="font-size:16px; font-weight:500;"><?php echo $_REQUEST['fromDestinationFlight']; ?>&nbsp; <i class="fa fa-arrow-right" aria-hidden="true"></i> &nbsp;<?php echo $_REQUEST['toDestinationFlight']; ?></td>
			<td width="30%" align="right" style="font-size:13px;"><?php echo date('d M Y',strtotime($journeyDate)); ?> </td>
			</tr>
			<tr>
			<td colspan="2" align="left" style=" padding-top:2px; font-size:12px;"><span id="totalrecordgo">0</span> results found.</td>
			</tr>
			</table>
			</div>
			<div class="mb-2 sortdivmain">
			<div class="border rounded-xs py-4 px-4 px-xl-5 hideinmobile" style="padding:10px !important; background-color:#ebf0f7; font-size:12px;">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
			  <td width="16%" align="left" style="cursor:pointer;"  onClick="getSortedDeparture();" ><strong>Sort By:</strong> </td>
			<td width="21%" align="center" style="cursor:pointer;"  onClick="getSortedDeparture();" >Departure <i class="fa fa-arrow-down" id="departurefa" aria-hidden="true"></i>
			<input name="departurefilterid" type="hidden" id="departurefilterid" value="1"></td>
			<td width="21%" align="center" style="cursor:pointer;"  onClick="getSortedDuration();" >Duration <i class="fa fa-arrow-down" id="durationfa" aria-hidden="true"></i>
			<input name="durationfilterid" type="hidden" id="durationfilterid" value="1"></td>
			<td width="21%" align="center"  style="cursor:pointer;"  onClick="getSortedArrival();" >Arrival <i class="fa fa-arrow-down" id="arrivalfa" aria-hidden="true"></i>
			<input name="arrivalfilterid" type="hidden" id="arrivalfilterid" value="1">			</td>
			<td width="21%" align="center" style="cursor:pointer;" onClick="getSortedPrice();" id="pricefilter">Price <i class="fa fa-arrow-down" id="pricefa" aria-hidden="true"></i>
			<input name="pricefilterid" type="hidden" id="pricefilterid" value="1"></td>
			</tr>
			</table>
			</div>
			</div>
			
			
			<?php
			if($fixedDeparture==0){
			foreach((array) $data->FLIGHT as $flightList){
			   
			if(getBlockFlights($agentid,$flightList->F_NAME,$flightList->PCC)<1){
			?>
			
			<?php
			 
			$i = 1;
			$baseFare=0;	
			$surcharge=0;	 
			$taxBreakup = explode(',',$flightList->TAX_BREAKUP);
			foreach($taxBreakup as $faredetail){
			$newfaredetail = explode('=',$faredetail);
			
			if($newfaredetail[0]=='ab'){
			$adultFare = $newfaredetail[1];
			}
			if($newfaredetail[0]=='ay'){
			 $adultay = $newfaredetail[1];
			}
			if($newfaredetail[0]=='at'){
			 $adultat = $newfaredetail[1];
			} 
			if($newfaredetail[0]=='cb'){
			 $childFare = $newfaredetail[1];
			} 
			if($newfaredetail[0]=='cy'){
			 $childTax = $newfaredetail[1];
			} 
			if($newfaredetail[0]=='ct'){
			 $childTax2 = $newfaredetail[1];
			}
			if($newfaredetail[0]=='ib'){
			 $infantFare = $newfaredetail[1];
			}
			
			
			$i++;
			}
			
			$totalPaxFare=round(($adultFare*$ADT)+($childFare*$CHD)+($infantFare*$INF));
			$totalTax=round((($adultay+$adultat)*$ADT)+(($childTax+$childTax2)*$CHD));
			
			if($totalPaxFare<1 && $flightList->F_TYPE){
			$totalPaxFare=$flightList->AMT;
			} 
			
			$getCalCost=calculateflightcost(encode($agentid),$flightList->F_NAME,$flightType,$flightList->PCC,$toalPax,$totalPaxFare,$totalTax);
			$getCalCost2=calculateflightcostForAgent(encode($agentid),$flightList->F_NAME,$flightType,$flightList->PCC,$toalPax,$totalPaxFare,$totalTax);
			 
			?>
		
			<div class="card item filghtdatalistdiv <?php if($flightList->STOP==0){ ?>Non Stop<?php }else{ echo $flightList->STOP.' Stop '; } ?> <?php echo  $flightList->F_CLASS; ?> <?php echo  $flightList->F_NAME; ?> <?php $tarr = explode(':',$flightList->D_TIME); echo $tarr[0]; ?> " price-data-order="<?php echo $getCalCost[1]; ?>" arrival-data-order="<?php echo preg_replace('/[^0-9]/', '', $flightList->A_TIME); ?>" departure-data-order="<?php echo preg_replace('/[^0-9]/', '', $flightList->D_TIME); ?>" duration-data-order="<?php echo preg_replace('/[^0-9]/', '', $flightList->DUR); ?>" data-price="<?php echo $flightList->AMT; ?>" >
				<form method="POST" name="bookingform<?php echo $sr; ?>" target="_blank" id="bookingform<?php echo $sr; ?>" action="display.html?ga=bookflight">
				
					<input type="hidden" id="sharewhatsapp<?php echo $sr; ?>" value="<?php echo $flightList->F_NAME; ?>(<?php echo $flightList->F_CODE; ?>-<?php echo $flightList->F_NO; ?>)*%20:%20%0A%20<?php echo $_REQUEST['fromDestinationFlight']; ?>%20-%20<?php echo $_REQUEST['toDestinationFlight']; ?>%20on%20<?php echo $flightList->D_TIME; ?>%20<?php echo date('d M Y',strtotime($flightList->D_DATE)); ?>-<?php echo $flightList->A_TIME; ?> <?php echo date('d M Y',strtotime($flightList->A_DATE)); ?>,%202021%20%20Duration:<?php echo makeFlightTime($flightList->DUR); ?>, Pax: <?php echo ($_REQUEST['ADT']+$_REQUEST['CHD']+$_REQUEST['INF']); ?>," >
			
			
			<input type="hidden" name="action" value="onewaysubmit" >
			<input type="hidden" name="onewayjson" value="<?php echo htmlentities(json_encode($flightList,true)); ?>" >
			<input type="hidden" name="PARAM" value="<?php echo htmlentities(json_encode($data->PARAM,true)); ?>" >
			<input type="hidden" name="tyipType" value="<?php echo $tripType; ?>" >
			<input type="hidden" name="sector" value="<?php echo $SECTOR; ?>" >
			<input type="hidden" name="adfare" value="<?php echo base64_encode('baseFare='.$totalPaxFare.',tax='.$totalTax.',totalFare='.($totalPaxFare+$totalTax)); ?>" > 
			<input type="hidden" name="agfare" value="<?php echo base64_encode('baseFare='.$getCalCost2[2].',tax='.$getCalCost2[0].',totalFare='.$getCalCost2[1]); ?>" > 
			<input type="hidden" name="clfare" value="<?php echo base64_encode('baseFare='.$getCalCost[2].',tax='.$getCalCost[0].',totalFare='.$getCalCost[1]); ?>" > 
			<input type="hidden" name="bookingst" value="<?php echo offlineflight(encode($agentid),$flightList->F_NAME,$flightType,$flightList->PCC,$toalPax,$totalPaxFare,$totalTax); ?>" > 
			
			<div class="flightlisting">
			<div class="row align-items-center text-center">
			<div class="col-md mb-4 mb-md-0"> <img class="img-fluid" src="<?php echo $imgurl.getflightlogo($flightList->F_NAME); ?>" alt="<?php echo  $flightList->F_NAME; ?>">
			<div class="font-size-14 flightNameClass" style="padding-top: 5px; font-weight:500;"><?php echo $flightList->F_NAME; ?><div style="color:#a9a9a9"><?php echo $flightList->F_CODE; ?> <?php echo $flightList->F_NO; ?></div></div>
			
			<?php
					  $flightinfodata = explode('|', $flightList->FLIGHT_INFO); 
					  
					  $baggage=$flightinfodata[2];
					  $baggage=explode(':', $baggage); 
					  $baggage2=explode(',', $baggage[0]); 
					  $baggage=explode('=', $baggage2[0]);  
					  
					  $baggagearr = $flightinfodata[2];
					  $baggagearr=explode(':', $baggagearr); 
						$baggagearr=explode(',', $baggagearr[1]);
						$baggage3 = explode('=', $baggagearr[0]);
						$baggage4 = explode('=', $baggagearr[1]);
						 
					  
					  ?>
			
			</div>
			<div class="col-md mb-4 mb-md-0">
			<div class="flex-content-center"> 
			<div class="text-lg-right">
			<h6 class="font-weight-bold font-size-21 text-gray-5 mb-0"><?php echo $flightList->D_TIME; ?></h6>
			<span class="font-size-14 text-gray-1"><?php echo $flightList->D_NAME; ?></span> </div>
			</div>
			</div>
			<div class="col-md mb-4 mb-md-0">
			<div class="flex-content-center flex-column">
			<h6 class="font-size-14 font-weight-bold text-gray-5 mb-0"><?php echo makeFlightTime($flightList->DUR); ?></h6>
			<div class="width-60 border-top border-primary border-width-2 my-1"></div>
			<div class="font-size-14 text-gray-1 check stops">
			<?php if($flightList->STOP==0){ ?>
			Non Stop
			<?php  }else{ ?><span style="color:#bf0000 !important;"><?php echo $flightList->STOP.' Stop '; ?></span><?php } ?>
			<span style="display:none;"><?php echo  $flightList->F_CLASS.'Class'; ?></span></div>
			<div style="text-align:center; font-size:11px; color:#666666;" class="display-none"><?php echo $flightList->SEAT; ?> Seat(s) left</div>
			</div>
			</div>
			<div class="col-md mb-4 mb-md-0">
			<div class="flex-content-center d-block d-lg-flex">
			 
			<div class="text-lg-left">
			<h6 class="font-weight-bold font-size-21 text-gray-5 mb-0"><?php echo $flightList->A_TIME; ?></h6>
			<span class="font-size-14 text-gray-1"><?php echo $flightList->A_NAME; ?></span> </div>
			</div>
			</div>
			<div class="col-md-2gdot8">
			<div class="border-xl-left">
			<div class="ml-xl-5">
			<div class="mb-2">
			<div class="mb-2 text-lh-1dot4"> <span class="font-weight-bold font-size-22">&#8377; <span id="finalCostapi<?php echo $sr; ?>"><?php echo $getCalCost[1]; ?> </span></span> </div>
			<button type="submit" class="btn btn-outline-primary border-radius-3 d-flex align-items-center justify-content-center min-height-50 font-weight-bold border-width-2 py-2 w-100" onclick="$('#booknowloader').show();$('#flightsearchloader').hide();">Book Now</button> </div>
			<!-- On Target Modal -->
			
			
			<!-- End On Target Modal -->
			</div>
			</div>
			</div>
			</div>
			
			
			<?php if(getfaretypedetails($flightList->F_NAME,$flightList->PCC)!=''){ ?><div class="ymsg"><?php echo stripslashes(getfaretypedetails($flightList->F_NAME,$flightList->PCC)); ?></div><?php } ?>
			
			
			<div class="ffoterbox">
			<div class="box"><a style="cursor:pointer;" class="font-size-14 text-gray-1 d-block" onClick="$('#ontargetModal<?php echo $sr; ?>').show();$('#inwinontargetModal<?php echo $sr; ?>').show();"><i class="fa fa-list" aria-hidden="true"></i> Flight Details</a></div>
			 <div class="box"><div class="<?php if($flightinfodata[0]=='REFUNDABLE'){ ?>greentabmsg<?php } else { ?>redtabmsg<?php } ?>"><?php if($flightinfodata[0]=='REFUNDABLE'){ echo 'Refundable'; } else { echo 'Non Refundable'; } ?></div>
			 </div> 
  
			 
			<div class="box2"> <input name="sharechecked" id="sharechecked<?php echo $sr; ?>" type="checkbox" value="<?php echo $sr; ?>" class="sharechecked" onclick="getshareonwhatsapp();" />  </div>
			
			<div class="box2"> 
					<div class="box display-none" ><i class="fa fa-briefcase" aria-hidden="true" style="color:#000000;">ddddd</div>
			
			<div class="box display-none" ><i class="fa fa-briefcase" aria-hidden="true" style="color:#000000;"></i><?php echo $baggage4[1]; ?> &nbsp;&nbsp; <i class="fa fa-shopping-bag" aria-hidden="true"  style="color:#000000;"></i> <?php echo $baggage3[1]; ?></div>
			<span class="shownetprice<?php echo $sr; ?>" style="display:none;">Net Price: <strong>&#8377;  <?php if($totalPaxFare==getAgentCommission($totalPaxFare,$flightList->F_NAME,$flightList->PCC)){ echo round($getCalCost[1]); }else{ echo round($getCalCost2[1]-(getAgentCommission($totalPaxFare,$flightList->F_NAME,$flightList->PCC))); } ?></strong> <a  onclick="$('.shownetprice<?php echo $sr; ?>').hide();$('.showpricebtn<?php echo $sr; ?>').show();" style="cursor:pointer; text-decoration:underline;" >Hide</a></span><a  onclick="$('.shownetprice<?php echo $sr; ?>').show();$('.showpricebtn<?php echo $sr; ?>').hide();" style="cursor:pointer;" class="showpricebtn<?php echo $sr; ?>">Net Price</a></div>
			<input type="hidden" name="acom" value="<?php echo getAgentCommission($getCalCost[2],$flightList->F_NAME,$flightList->PCC); ?>"  />
			 
			</div>
			</div>	</form>
			
			<div id="ontargetModal<?php echo $sr; ?>"  style="display:none;">
			<div id="inwinontargetModal<?php echo $sr; ?>" class="js-modal-window u-modal-window  " data-modal-type="ontarget" data-open-effect="fadeIn" data-close-effect="fadeOut" data-speed="500" style="margin:auto; margin-top:20px; background-color:#FFFFFF;">
			<div class="card mx-4 mx-xl-0  mb-md-0">
			<button type="button" class="border-0 width-50 height-50 flex-content-center position-absolute rounded-circle mt-n4 mr-n4 top-0 right-0 flightdetailsclosebtn" aria-label="Close" onClick="$('#ontargetModal<?php echo $sr; ?>').hide();$('#inwinontargetModal<?php echo $sr; ?>').hide();"> <i class="fa fa-times" aria-hidden="true"></i> </button>
			<!-- Header -->
			 
					<?php
                $j = 0;
                foreach ((array)$flightList->CON_DETAILS as $layoverFlight)
                {

                    if ($layoverFlight->FLIGHT_NAME != '')
                    {
?> 
			<div style="padding:10px; border:1px solid #ddd; margin:0px 10px 0px; margin-top:10px;">
			  <div class="row align-items-center text-center">
				<div class="col-md-auto mb-4 mb-md-0">
				  <div class="d-block d-lg-flex flex-horizontal-center"> <img class="img-fluid mr-3 mb-1 mb-lg-0" src="<?php echo $imgurl . getflightlogo($flightList->F_NAME); ?>" >
					<div class="font-size-14"><?php echo $layoverFlight->FLIGHT_NAME; ?> <?php echo $layoverFlight->FLIGHT_CODE; ?> <?php echo $layoverFlight->FLIGHT_NO; ?> 
				 
					</div>
				  </div>
				</div>
				<div class="col-md-auto mb-4 mb-md-0">
				  <div class="mx-2 mx-xl-3 flex-content-center align-items-start d-block d-lg-flex">
					 
					<div class="text-lg-center">
					  <h6 class="font-weight-bold font-size-21 text-gray-5 mb-0"><?php echo $layoverFlight->DEP_TIME; ?></h6>
					  <div class="font-size-14 text-gray-5"><?php echo date('D, d M y', strtotime($layoverFlight->DEP_DATE)); ?></div>
					  <span class="font-size-14 text-gray-1"><?php echo $layoverFlight->ORG_NAME; ?></span> </div>
				  </div>
				</div>
				<div class="col-md-auto mb-4 mb-md-0">
				  <div class="mx-2 mx-xl-3 flex-content-center flex-column">
					<h6 class="font-size-14 font-weight-bold text-gray-5 mb-0"><?php echo makeFlightTime($layoverFlight->DURATION); ?></h6>
					<div class="c-timeline" style="height: 2px;background-color: rgba(187, 187, 187, 0.49);">
                                                            <div class="dot"></div>
                                                           
                                                            <div class="dot"></div>
                                </div>
					<div class="font-size-14 text-gray-1"></div>
				  </div>
				</div>
				<div class="col-md-auto mb-4 mb-md-0">
				  <div class="mx-2 mx-xl-3 flex-content-center align-items-start d-block d-lg-flex">
					 
					<div class="text-lg-center">
					  <h6 class="font-weight-bold font-size-21 text-gray-5 mb-0"><?php echo $layoverFlight->ARRV_TIME; ?></h6>
					  <div class="font-size-14 text-gray-5"><?php echo date('D, d M y', strtotime($layoverFlight->DEP_DATE)); ?></div>
					  <span class="font-size-14 text-gray-1"><?php echo $layoverFlight->DES_NAME; ?></span> </div>
				  </div>
				</div>
			  </div>
		 </div>
			<div class="layover"><?php echo $layoverFlight->LAYOVER_INFO; ?></div>
			<?php $j++;
                    }
                } ?>
			 
			<!-- End Header -->
			<!-- Body -->
			<div class="card-body">
			  <div class="row">
				<div class="col">
				   <table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC" style="font-size:12px;">
  <tr>
    <td  bgcolor="#F4F4F4"><strong>Baggage Type</strong></td>
    <td bgcolor="#F4F4F4"><strong>Check-in</strong></td>
    <td bgcolor="#F4F4F4"><strong>Cabin</strong></td>
  </tr>
  <tr>
    <td>Adult / Child</td>
    <td><?php echo $baggage4[1]; ?></td>
    <td><?php echo $baggage3[1]; ?></td>
  </tr>
</table> 

<div style="margin-top:10px; font-size:12px; color:#FF0000;">
<?php echo $flightinfodata[3]; ?>
</div>
				</div>
				
				<div class="col-auto">
				  <div class="min-width-250">
					<h5 class="font-size-17 font-weight-bold text-dark">Fare breakup</h5>
					<ul class="list-unstyled font-size-1 mb-0 font-size-16">
					  <li class="d-flex justify-content-between py-2"> <span class="font-weight-medium">Base Fare</span> <span class="text-secondary">&#8377;  <?php echo $getCalCost[2]; ?></span> </li>
					  <li class="d-flex justify-content-between py-2"> <span class="font-weight-medium">Surcharges & Taxes</span> <span class="text-secondary">&#8377;  <?php echo $getCalCost[0]; ?></span> </li>
					  <li class="d-flex justify-content-between py-2 font-size-17 font-weight-bold"> <span class="font-weight-bold">Pay Amount</span> <span class="">&#8377;  <?php echo $getCalCost[1]; ?> </span> </li>
					</ul>
				  </div>
				</div>
			  </div>
			</div>
			<!-- End Body -->
			</div>
			</div>
			</div>
			</div>
		
			
			<?php $sr++; } ?>
			
			 

			
			<script>
			$('#totalrecordgo').text('<?php echo ($sr-1); ?>');
			</script>
			
			<?php
			} 
			}
			// Manual Flights by admin
			?>
			
			<?php
			if($INF<1 || $INF==''){
			if($fixedDeparture==1){ 
			$rs5=GetPageRecord('*','fixedDepartureMaster',' arrival="'.$todestexp[0].'" and departure="'.$fromdestexp[0].'" and fromdate<="'.date('Y-m-d',strtotime($_REQUEST['journeyDateOne'])).'" and todate>="'.date('Y-m-d',strtotime($_REQUEST['journeyDateOne'])).'" and status=1 and (addBy="'.($webagentid).'" or addBy=1) '); 
			}else{ 
			$rs5=GetPageRecord('*','manualFlightMaster',' arrival="'.$todestexp[0].'" and departure="'.$fromdestexp[0].'" and fromDate<="'.date('Y-m-d',strtotime($_REQUEST['journeyDateOne'])).'" and toDate>="'.date('Y-m-d',strtotime($_REQUEST['journeyDateOne'])).'" and status=1 and (addBy="'.($webagentid).'" or addBy=1) '); 
			}
			while($rest=mysqli_fetch_array($rs5)){
			$fareType=$rest['fareType'];
			
			if (strpos($fareType, '~') !== false) {
			$fareType=explode('~',$fareType); 
			$fareType=$fareType[1];
			}
			 
 			 
			if(getBlockFlights($agentid,$rest['name'],trim($fareType))<1){
			
			
			$totalPaxFare=round($rest['baseFare']*($ADT+$CHD));
			$totalTax=round($rest['surchargesTaxes']*($ADT+$CHD)); 
			
			$getCalCost=calculateflightcost(encode($agentid),$rest['name'],$rest['flightType'],$rest['fareType'],$toalPax,$totalPaxFare,$totalTax);
			$getCalCost2=calculateflightcostForAgent(encode($agentid),$rest['name'],$rest['flightType'],$rest['fareType'],$toalPax,$totalPaxFare,$totalTax);
			?> 
			
			
			
			<div class="card item filghtdatalistdiv <?php echo stripslashes($rest['stops']); ?> <?php echo stripslashes($rest['name']); ?> <?php $tarr = explode(':',stripslashes($rest['departureTime'])); echo $tarr[0]; ?> "  price-data-order="<?php echo $getCalCost[1]; ?>" arrival-data-order="<?php echo stripslashes($rest['arrivalTime']); ?>" departure-data-order="<?php echo stripslashes($rest['departureTime']); ?>" duration-data-order="<?php echo stripslashes($rest['duration']); ?>" data-price="<?php echo round($rest['baseFare']+$rest['surchargesTaxes']); ?>" >
			<form method="POST" name="bookingformmanuel<?php echo $sr; ?>" id="bookingform<?php echo $sr; ?>" action="display.html?ga=bookflight" target="_blank" >
			<div class="border rounded-xs py-4 px-4 px-xl-5 flightlisting"> 
			<input type="hidden" name="fixedDeparture" id="fixedDeparture" value="<?php echo $fixedDeparture; ?>">
			<input type="hidden" name="agoff" value="<?php echo ($rest['addBy']); ?>" >
			<input type="hidden" name="action" value="offlinesubmit" >
			<input type="hidden" name="onewayjson" value="<?php echo htmlentities('{"UID":"'.encode($rest['id']).'","ID":"'.$rest['id'].'","TID":"0","D_CODE":"'.$rest['departure'].'","D_NAME":"'.getflightdestination($rest['departure']).'","A_CODE":"'.$rest['arrival'].'","A_NAME":"'.getflightdestination($rest['arrival']).'","D_DATE":"'.$journeyDate.'","D_TIME":"'.$rest['departureTime'].'","A_DATE":"'.$journeyDate.'","A_TIME":"'.$rest['arrivalTime'].'","F_CODE":"'.$rest['flightNo'].'","F_NAME":"'.$rest['name'].'","F_NO":"'.$rest['flightNo'].'","F_LOGO":"0 -123px","F_TYPE":"R","SEAT":"15","STOP":"'.$rest['stops'].'","AMT":"'.($rest['baseFare']+$rest['surchargesTaxes']).'","DUR":"'.$rest['duration'].'","S_CODE":"'.$rest['departure'].'-'.$rest['arrival'].'","CN_CODE":"'.$rest['flightNo'].'","OI":"1D","PCC":"'.$rest['fareType'].'","TAX_BREAKUP":"ab='.$rest['baseFare'].',ay=0,at='.$rest['surchargesTaxes'].',cb='.$rest['baseFare'].',cy=0,ct='.$rest['surchargesTaxes'].',ib=0","CON_DETAILS":"","FLIGHT_INFO":"NONREFUNDABLE|1,2|Baggage:Cabin='.$rest['cabin'].',Checkin='.$rest['checkin'].'|Cancellation='.$rest['cancellationPolicy'].',Reschedule=ASAP Airlines|CLASS=","NET_FARE":"'.$rest['baseFare'].'","F_CLASS":"'.$PC.'"}'); ?>" >
			
			<input type="hidden" name="PARAM" value="<?php echo htmlentities('[{"src":"'.$rest['departure'].'","des":"'.$rest['arrival'].'","dep_date":"'.$journeyDate.'","ret_date":"","adt":"'.$ADT.'","chd":"'.$CHD.'","inf":"0","L_OW":"'.$rest['baseFare'].'","H_OW":"","T_TIME":"","Trip_String":"'.encode($rest['id']).'"}]'); ?>" >
			<input type="hidden" name="tyipType" value="1" >
			<input type="hidden" name="sector" value="<?php echo $rest['flightType']; ?>" >
			<input type="hidden" name="adfare" value="<?php echo base64_encode('baseFare='.$totalPaxFare.',tax='.$totalTax.',totalFare='.($totalPaxFare+$totalTax)); ?>" > 
			<input type="hidden" name="agfare" value="<?php echo base64_encode('baseFare='.$getCalCost2[2].',tax='.$getCalCost2[0].',totalFare='.($getCalCost2[1])); ?>" > 
			<input type="hidden" name="clfare" value="<?php echo base64_encode('baseFare='.$getCalCost[2].',tax='.$getCalCost[0].',totalFare='.($getCalCost[1])); ?>" > 
			<input type="hidden" name="bookingst" value="off" > 
			
			
			
			
				
					<input type="hidden" id="sharewhatsapp<?php echo $sr; ?>" value="<?php echo stripslashes($rest['name']); ?>(<?php echo stripslashes($rest['flightNo']); ?>)*%20:%20%0A%20<?php echo getflightdestination($rest['departure']); ?>%20-%20<?php echo getflightdestination($rest['arrival']); ?>%20on%20<?php echo stripslashes($rest['departureTime']); ?>%20<?php echo date('d M Y',strtotime($journeyDate)); ?>-<?php echo stripslashes($rest['arrivalTime']); ?> <?php echo date('d M Y',strtotime($journeyDate)); ?>,%202021%20%20Duration:<?php echo stripslashes($rest['duration']); ?>, Pax: <?php echo ($_REQUEST['ADT']+$_REQUEST['CHD']+$_REQUEST['INF']); ?>," >
					
					
			<div class="row align-items-center text-center">
			<div class="col-md mb-4 mb-md-0"> <img class="img-fluid" src="<?php if($rest['img']!=''){ echo $imgurl.stripslashes($rest['img']); }else{ echo $imgurl.'noflightlogo.png'; } ?>" >
			<div class="font-size-14 flightNameClass" style="padding-top: 5px; font-weight:500;"><?php echo stripslashes($rest['name']); ?> <?php echo stripslashes($rest['flightNo']); ?></div>
			  
			</div>
			<div class="col-md mb-4 mb-md-0">
			<div class="flex-content-center d-block d-lg-flex">
			 
			<div class="text-lg-left">
			<h6 class="font-weight-bold font-size-21 text-gray-5 mb-0"><?php echo stripslashes($rest['departureTime']); ?></h6>
			<span class="font-size-14 text-gray-1"><?php echo getflightdestination($rest['departure']); ?></span> </div>
			</div>
			</div>
			<div class="col-md mb-4 mb-md-0">
			<div class="flex-content-center flex-column">
			<h6 class="font-size-14 font-weight-bold text-gray-5 mb-0"><?php echo stripslashes($rest['duration']); ?></h6>
			<div class="width-60 border-top border-primary border-width-2 my-1"></div>
			<div class="font-size-14 text-gray-1 check stops">
			<?php echo stripslashes($rest['stops']); ?>
			<span style="display:none;"><?php echo  $flightList->F_CLASS.'Class'; ?></span></div>
			</div>
			</div>
			<div class="col-md mb-4 mb-md-0">
			<div class="flex-content-center d-block d-lg-flex">
			 
			<div class="text-lg-left">
			<h6 class="font-weight-bold font-size-21 text-gray-5 mb-0"><?php echo stripslashes($rest['arrivalTime']); ?></h6>
			<span class="font-size-14 text-gray-1"><?php echo getflightdestination($rest['arrival']); ?></span> </div>
			</div>
			</div>
			<div class="col-md-2gdot8">
			<div class="border-xl-left">
			<div class="ml-xl-5">
			<div class="mb-2">
			<div class="mb-2 text-lh-1dot4"> <span class="font-weight-bold font-size-22">&#8377;  <span id="finalCostapi<?php echo $sr; ?>"><?php echo $getCalCost[1]; ?></span></span> </div>
			<button type="submit" class="btn btn-outline-primary border-radius-3 d-flex align-items-center justify-content-center min-height-50 font-weight-bold border-width-2 py-2 w-100"  onclick="$('#booknowloader').show();$('#flightsearchloader').hide();">Book Now</button> </div>
			<!-- On Target Modal -->
			 
			 
			<!-- End On Target Modal -->
			</div>
			</div>
			</div>
			</div> 
			<?php if($rest['description']!=''){ ?><div class="ymsg"><?php echo stripslashes($rest['description']); ?></div><?php } ?>
			
				<div class="ffoterbox">
				<div class="box"><a style="cursor:pointer;" class="font-size-14 text-gray-1 d-block" onClick="$('#ontargetModal<?php echo $sr; ?>').show();$('#inwinontargetModal<?php echo $sr; ?>').show();"><i class="fa fa-list" aria-hidden="true"></i> Flight Details</a></div>
				
				<div class="box"><?php echo stripslashes($rest['fareType']); ?></div>
			 
					<div class="box2"> <input name="sharechecked" id="sharechecked<?php echo $sr; ?>" type="checkbox" value="<?php echo $sr; ?>" class="sharechecked" />  </div>
			<div class="box2"> 
					
					<span class="shownetprice<?php echo $sr; ?>" style="display:none;">Net Price: <strong>&#8377;  <?php if($getCalCost[2]==getAgentCommission($getCalCost[2],$rest['name'],$rest['fareType'])){ echo round($getCalCost[1]); }else{ echo round($getCalCost2[1]-getAgentCommission($getCalCost[2],$rest['name'],$rest['fareType'])); } ?></strong> <a  onclick="$('.shownetprice<?php echo $sr; ?>').hide();$('.showpricebtn<?php echo $sr; ?>').show();" style="cursor:pointer; text-decoration:underline;" >Hide</a></span><a  onclick="$('.shownetprice<?php echo $sr; ?>').show();$('.showpricebtn<?php echo $sr; ?>').hide();" style="cursor:pointer;" class="showpricebtn<?php echo $sr; ?>">Net Price</a>
					</div>
					 
				<input type="hidden" name="acom" value="<?php echo getAgentCommission($getCalCost[2],$rest['name'],$rest['fareType']); ?>"  />
				</div>
			</div></form>
			
			
			<div id="inwinontargetModal<?php echo $sr; ?>" class="js-modal-window u-modal-window  " data-modal-type="ontarget" data-open-effect="fadeIn" data-close-effect="fadeOut" data-speed="500" style=" margin-top:20px; background-color:#FFFFFF;">
			<div class="card mx-4 mx-xl-0  mb-md-0">
			<button type="button" class="border-0 width-50 height-50 flex-content-center position-absolute rounded-circle mt-n4 mr-n4 top-0 right-0 flightdetailsclosebtn" aria-label="Close" onClick="$('#ontargetModal<?php echo $sr; ?>').hide();$('#inwinontargetModal<?php echo $sr; ?>').hide();"> <i class="fa fa-times" aria-hidden="true"></i> </button>
			<!-- Header -->
		 
			
			
	 
			<!-- End Header -->
			<!-- Body -->
			<div class="card-body">
			  <div class="row">
				<div class="col">
				  <table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC" style="font-size:12px;">
  <tr>
    <td bgcolor="#F4F4F4"><strong>Baggage Type</strong></td>
    <td  bgcolor="#F4F4F4"><strong>Check-in baggage</strong></td>
    <td bgcolor="#F4F4F4"><strong>Cabin baggage</strong></td>
  </tr>
  <tr>
    <td>Adult / Child</td>
    <td><?php echo $rest['checkin']; ?></td>
    <td><?php echo $rest['cabin']; ?></td>
  </tr>
</table>
				</div>
				
				<div class="col-auto">
				  <div class="min-width-250">
					<h5 class="font-size-17 font-weight-bold text-dark">Fare breakup </h5>
					<ul class="list-unstyled font-size-1 mb-0 font-size-16">
					  <li class="d-flex justify-content-between py-2"> <span class="font-weight-medium">Base Fare</span> <span class="text-secondary">&#8377;  <?php echo $getCalCost[2]; ?></span> </li>
					  <li class="d-flex justify-content-between py-2"> <span class="font-weight-medium">Surcharges & Taxes</span> <span class="text-secondary">&#8377;  <?php echo $getCalCost[0]; ?></span> </li>
					  <li class="d-flex justify-content-between py-2 font-size-17 font-weight-bold"> <span class="font-weight-bold">Pay Amount</span> <span class="">&#8377;  <?php echo $getCalCost[1]; ?></span> </li>
					</ul>
				  </div>
				</div>
			  </div>
			</div>
			<!-- End Body -->
			</div>
			</div>
			</div>
			
			
			<?php $sr++;  }  } 
			}
			?>
			</div>
			
			
			
<script>
function getshareonwhatsapp(){ 
var sharewhatsapp ='';
var n=1;
$('input.sharechecked:checkbox:checked').each(function () { 

var finalCostapi = $('#finalCostapi'+$(this).val()).text(); 
finalCostapi =  +finalCostapi+' INR %0A%0A';

 sharewhatsapp += '*'+n+'. '+$('#sharewhatsapp'+$(this).val()).val()+' '+finalCostapi;
   n++; });
   

  <?php
  $useragent=$_SERVER['HTTP_USER_AGENT'];

if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
?> 
   
 sharewhatsapp='https://wa.me/send?text='+sharewhatsapp;   
 
 <?php } else { ?>
  sharewhatsapp='https://web.whatsapp.com/send?text='+sharewhatsapp;   
 
 <?php } ?>
 
 
 $('#hiddenleftwhatsappshare').val(sharewhatsapp);
 
 
}

function shareonwhatsapp(){
var sharewhatsapp=$('#hiddenleftwhatsappshare').val();
  var win = window.open(sharewhatsapp, '_blank');
if (win) {
    //Browser has allowed it to be opened
    win.focus();
} else {
    //Browser has blocked it
    alert('Please allow popups for this website');
}
}
</script>
			
			
			<?php 
			 }else{
			?>
			
			
			
<script>
function getshareonwhatsapp(){ 
var sharewhatsapp ='';
var n=1;
$('input.sharechecked:checkbox:checked').each(function () { 

var finalCostapi = $('#finalCostapidep'+$(this).val()).text(); 
finalCostapi =  +finalCostapi+' INR %0A%0A';

 sharewhatsapp += '*'+n+'. '+$('#sharewhatsapp'+$(this).val()).val()+' '+finalCostapi;
   n++; });
   
   
  n=1; 
$('input.sharecheckedret:checkbox:checked').each(function () { 

var finalCostapi = $('#finalCostapiret'+$(this).val()).text(); 
finalCostapi =  +finalCostapi+' INR %0A%0A';

 sharewhatsapp += '*'+n+'. '+$('#sharewhatsappret'+$(this).val()).val()+' '+finalCostapi;
   n++; });   
   
   
   
   
 sharewhatsapp='https://web.whatsapp.com/send?text='+sharewhatsapp;   
 $('#hiddenleftwhatsappshare').val(sharewhatsapp);
}

function shareonwhatsapp(){
var sharewhatsapp=$('#hiddenleftwhatsappshare').val();
  var win = window.open(sharewhatsapp, '_blank');
if (win) {
    //Browser has allowed it to be opened
    win.focus();
} else {
    //Browser has blocked it
    alert('Please allow popups for this website');
}
}
</script>
			<style>
			.flightname{font-size: 12px; font-weight: 500;}
			.flightimgbox{width:25px; height:25px; margin-right:10px;}
			.flightimgbox .img-fluid{height:25px !important;width:25px !important;}
			.flightdetailslink{cursor: pointer; font-size: 12px; margin-top: 4px;}
			.flightlisting{padding:0px !important;}
			.flightlisting label{width:100%; padding:10px !important;}
			.flightlisting .footer{background-color:#ebf0f7; font-size:12px; padding:4px;}
			</style>
			 
			<div style="margin-bottom:20px; text-align:right;" class="shareallon">Share By: &nbsp; <a href="#" style="color:#46C156;"  class="whatsappsharebtn"  onclick="$('.shareallon').hide();$('.sharewhatsapp').show();$('.sharechecked').show();$('.sharecheckedret').show();"><i class="fa fa-whatsapp" aria-hidden="true"></i> Whatsapp</a> &nbsp;&nbsp; 
			<a href="#" style="color:#0066CC;" class="emailsharebtn"><i class="fa fa-envelope" aria-hidden="true"></i> Email</a></div>
			
			<div style="margin-bottom:20px; text-align:right; display:none;" class="sharewhatsapp">Share By: &nbsp; <a href="#" onclick="shareonwhatsapp();" style="color:#46C156;"><i class="fa fa-whatsapp" aria-hidden="true"></i> Share</a> &nbsp; <i class="fa fa-times" aria-hidden="true" style="color:#993300; cursor:pointer;" onclick="$('.shareallon').show();$('.sharewhatsapp').hide();$('.sharechecked').hide();$('.sharecheckedret').hide();" ></i> </div>
			
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
			<td colspan="2" align="left" valign="top"  class="listouter" style="padding-right:10px;"><div class="mb-2">
			<div class="border rounded-xs py-4 px-4 px-xl-5" style="background-color: #fff; padding: 10px !important;">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
			<td align="left" style="font-size:16px; font-weight:500;"><?php echo $_REQUEST['fromDestinationFlight']; ?>&nbsp; <i class="fa fa-arrow-right" aria-hidden="true"></i> &nbsp;<?php echo $_REQUEST['toDestinationFlight']; ?></td>
			<td width="30%" align="right" style="font-size:13px;"><?php echo date('d M Y',strtotime($journeyDate)); ?> </td>
			</tr>
			<tr>
			<td colspan="2" align="left" style=" padding-top:2px; font-size:12px;"><span id="totalrecordgo">0</span> results found.</td>
			</tr>
			</table>
			</div>
			</div>
			<div class="mb-2 sortdivmain">
			<div class="border rounded-xs py-4 px-4 px-xl-5 hideinmobile" style="padding:10px !important; background-color:#ebf0f7; font-size:12px;">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
			<td width="21%" align="center" style="cursor:pointer;"  onClick="getSortedDeparture();" >Departure <i class="fa fa-arrow-down" id="departurefa" aria-hidden="true"></i>
			<input name="departurefilterid" type="hidden" id="departurefilterid" value="1"></td>
			<td width="21%" align="center" style="cursor:pointer;"  onClick="getSortedDuration();" >Duration <i class="fa fa-arrow-down" id="durationfa" aria-hidden="true"></i>
			<input name="durationfilterid" type="hidden" id="durationfilterid" value="1"></td>
			<td width="21%" align="center"  style="cursor:pointer;"  onClick="getSortedArrival();" >Arrival <i class="fa fa-arrow-down" id="arrivalfa" aria-hidden="true"></i>
			<input name="arrivalfilterid" type="hidden" id="arrivalfilterid" value="1">
			</td>
			<td width="21%" align="center" style="cursor:pointer;" onClick="getSortedPrice();" id="pricefilter">Price <i class="fa fa-arrow-down" id="pricefa" aria-hidden="true"></i>
			<input name="pricefilterid" type="hidden" id="pricefilterid" value="1"></td>
			</tr>
			</table>
			</div>
			</div>
			
			<?php
			$totalgo=0;
			
			foreach((array) $data->FLIGHTOW as $flightList){
			$totalgo++;
			
			if(getBlockFlights($agentid,$flightList->F_NAME,$flightList->PCC)<1){
			?>
			
			<?php
			 
			
			$i = 1;
			$baseFare=0;	
			$surcharge=0;	
			
			$taxBreakup = explode(',',$flightList->TAX_BREAKUP);
			foreach($taxBreakup as $faredetail){
			$newfaredetail = explode('=',$faredetail);
			
			if($newfaredetail[0]=='ab'){
			$adultFare = $newfaredetail[1];
			}
			if($newfaredetail[0]=='ay'){
			 $adultay = $newfaredetail[1];
			}
			if($newfaredetail[0]=='at'){
			 $adultat = $newfaredetail[1];
			} 
			if($newfaredetail[0]=='cb'){
			 $childFare = $newfaredetail[1];
			} 
			if($newfaredetail[0]=='cy'){
			 $childTax = $newfaredetail[1];
			} 
			if($newfaredetail[0]=='ct'){
			 $childTax2 = $newfaredetail[1];
			}
			if($newfaredetail[0]=='ib'){
			 $infantFare = $newfaredetail[1];
			}
			
			$i++;
			}
			
			$totalPaxFare=round(($adultFare*$ADT)+($childFare*$CHD)+($infantFare*$INF));
			$totalTax=round((($adultay+$adultat)*$ADT)+(($childTax+$childTax2)*$CHD));
			 
			$getCalCost=calculateflightcost(encode($agentid),$flightList->F_NAME,$flightType,$flightList->PCC,$toalPax,$totalPaxFare,$totalTax);
			 $getCalCost2=calculateflightcostForAgent(encode($agentid),$flightList->F_NAME,$flightType,$flightList->PCC,$toalPax,$totalPaxFare,$totalTax);
			
			?>
			
			
			<div class="card mb-2 item filghtdatalistdiv <?php if($flightList->STOP==0){ ?>Non Stop<?php }else{ echo $flightList->STOP.' Stop '; } ?> <?php echo  $flightList->F_CLASS; ?> <?php echo  $flightList->F_NAME; ?> <?php $tarr = explode(':',$flightList->D_TIME); echo $tarr[0]; ?> " price-data-order="<?php echo $getCalCost[1]; ?>" arrival-data-order="<?php echo preg_replace('/[^0-9]/', '', $flightList->A_TIME); ?>" departure-data-order="<?php echo preg_replace('/[^0-9]/', '', $flightList->D_TIME); ?>" duration-data-order="<?php echo preg_replace('/[^0-9]/', '', $flightList->DUR); ?>" data-price="<?php echo $flightList->AMT; ?>"  >
			<div class="border rounded-xs py-4 px-4 px-xl-5 flightlisting">
			
			<label id="b<?php echo $sr; ?>">
			
			
				<input type="hidden" name="adfare" value="<?php echo base64_encode('baseFare='.$totalPaxFare.',tax='.$totalTax.',totalFare='.($totalPaxFare+$totalTax)); ?>" > 
				<input type="hidden" name="agfare" value="<?php echo base64_encode('baseFare='.$getCalCost2[2].',tax='.$getCalCost2[0].',totalFare='.$getCalCost2[1]); ?>" > 
				<input type="hidden" name="clfare" value="<?php echo base64_encode('baseFare='.$getCalCost[2].',tax='.$getCalCost[0].',totalFare='.$getCalCost[1]); ?>" > 
			
			<input type="hidden" id="sharewhatsapp<?php echo $sr; ?>" value="Departure: <?php echo $flightList->F_NAME; ?>(<?php echo $flightList->F_CODE; ?>-<?php echo $flightList->F_NO; ?>)*%20:%20%0A%20<?php echo $_REQUEST['fromDestinationFlight']; ?>%20-%20<?php echo $_REQUEST['toDestinationFlight']; ?>%20on%20<?php echo $flightList->D_TIME; ?>%20<?php echo date('d M Y',strtotime($flightList->D_DATE)); ?>-<?php echo $flightList->A_TIME; ?> <?php echo date('d M Y',strtotime($flightList->A_DATE)); ?>,%202021%20%20Duration:<?php echo makeFlightTime($flightList->DUR); ?>, Pax: <?php echo ($_REQUEST['ADT']+$_REQUEST['CHD']+$_REQUEST['INF']); ?>," >
			<div>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
			<td colspan="2"><div class="flightimgbox"><img class="img-fluid" src="<?php echo $imgurl.getflightlogo($flightList->F_NAME); ?>"></div></td>
			<td width="98%" class="flightname flightNameClass">&nbsp;<?php echo $flightList->F_NAME; ?><div style="color:#a9a9a9"><?php echo $flightList->F_CODE; ?> <?php echo $flightList->F_NO; ?></div></td>
			</tr>
			</table>
			</div>
			<div class="row align-items-center text-center">
			<div class="col-md mb-4 mb-md-0">
			<div class="flex-content-center d-block d-lg-flex">
			<div class="mr-lg-2 mb-1 mb-lg-0"> <i class="flaticon-aeroplane font-size-20 text-primary"></i> </div>
			<div class="text-lg-left">
			<h6 class="font-weight-bold font-size-16 text-gray-5 mb-0"><?php echo $flightList->D_TIME; ?></h6>
			<span class="font-size-14 text-gray-1"><?php echo $flightList->D_NAME; ?></span> </div>
			</div>
			
			</div>
			<div class="mb-4 mb-md-0 rightbtnsec">
			<div class="flex-content-center flex-column">
			<h6 class="font-size-14 font-weight-bold text-gray-5 mb-0"><?php echo makeFlightTime($flightList->DUR); ?></h6>
			<div class="width-60 border-top border-primary border-width-2 my-1"></div>
			<div class="font-size-14 text-gray-1 stops" >
			<?php if($flightList->STOP==0){ ?>
			Non Stop
			<?php }else{ ?><span style="color:#bf0000 !important;"><?php echo $flightList->STOP.' Stop '; ?></span><?php } ?>
			<span style="display:none;"><?php echo  $flightList->F_CLASS.'Class'; ?></span></div>
			</div>
			</div>
			<div class="col-md mb-4 mb-md-0">
			<div class="flex-content-center d-block d-lg-flex">
			<div class="mr-lg-2 mb-1 mb-lg-0"> <i class="d-block rotate-90 flaticon-aeroplane font-size-20 text-primary"></i> </div>
			<div class="text-lg-left">
			<h6 class="font-weight-bold font-size-16 text-gray-5 mb-0"><?php echo $flightList->A_TIME; ?></h6>
			<span class="font-size-14 text-gray-1"><?php echo $flightList->A_NAME; ?></span> </div>
			</div>
			</div>
			<div class="col-md">
			<div class="border-xl-left">
			<div class="ml-xl-2">
			<div class="mb-2">
			  <div class="mb-2 text-lh-1dot4"> <span class="font-weight-bold font-size-16">&#8377; &nbsp;<span id="finalCostapileft<?php echo $sr; ?>"><span id="finalCostapidep<?php echo $sr; ?>"><?php echo $getCalCost[1]; ?></span></span> &nbsp;&nbsp;
				<input name="flightDeparture" id="flightDeparture<?php echo $sr; ?>" type="radio" data-onward="<?php echo $sr; ?>" value="<?php echo $sr; ?>" style="width: 18px; height: 18px;" onClick="selectmultiflightsleft(<?php echo $sr; ?>);" <?php  if($sr==1){ } ?> class="radioclass" fieldid="<?php echo $sr; ?>" >
				
				<input name="flightDeparturejson" type="hidden" id="flightDeparturejson" value="<?php echo htmlentities(json_encode($flightList,true)); ?>">
				</span>   </div>
			</div>
			<?php
			$flightinfodata = explode('|', $flightList->FLIGHT_INFO); 
			?>
			<input type="hidden" name="acom" value="<?php echo getAgentCommission($getCalCost2[2],$flightList->F_NAME,$flightList->PCC); ?>"  />

			<!-- End On Target Modal -->
			</div>
			</div>
			</div>
			</div>
			</label>
			
 
 <?php if(getfaretypedetails($flightList->F_NAME,$flightList->PCC)!=''){ ?><div class="ymsg"><?php echo stripslashes(getfaretypedetails($flightList->F_NAME,$flightList->PCC)); ?></div><?php } ?>

			<div class="ffoterbox" style="padding: 8px 8px 5px;">
			<div class="box"><a style="cursor:pointer;" class="font-size-14 text-gray-1 d-block" onClick="$('#ontargetModal<?php echo $sr; ?>').show();$('#inwinontargetModal<?php echo $sr; ?>').show();"><i class="fa fa-list" aria-hidden="true"></i> Flight Details</a></div>
			 <div class="box"><div class="<?php if($flightinfodata[0]=='REFUNDABLE'){ ?>greentabmsg<?php } else { ?>redtabmsg<?php } ?>"><?php if($flightinfodata[0]=='REFUNDABLE'){ echo 'Refundable'; } else { echo 'Non Refundable'; } ?></div></div>
			  
			  
 <div class="box2"> <input name="sharechecked" id="sharechecked<?php echo $sr; ?>" type="checkbox" value="<?php echo $sr; ?>" class="sharechecked" onclick="getshareonwhatsapp();" />  </div>
		 
			<div class="box2">
			<span class="shownetprice<?php echo $sr; ?>" style="display:none;">Net Price: <strong>&#8377;  <?php if($getCalCost2[2]==getAgentCommission($getCalCost2[2],$flightList->F_NAME,$flightList->PCC)){ echo round($getCalCost[1]); }else{ echo round($getCalCost2[1]-getAgentCommission($getCalCost2[2],$flightList->F_NAME,$flightList->PCC)); } ?></strong> <a  onclick="$('.shownetprice<?php echo $sr; ?>').hide();$('.showpricebtn<?php echo $sr; ?>').show();" style="cursor:pointer; text-decoration:underline;" >Hide</a></span><a  onclick="$('.shownetprice<?php echo $sr; ?>').show();$('.showpricebtn<?php echo $sr; ?>').hide();" style="cursor:pointer;" class="showpricebtn<?php echo $sr; ?>">Net Price</a>
			
			
			 </div>
			
		 
			</div>
			</div>
			
			
			<div  class="flightdetails" id="ontargetModal<?php echo $sr; ?>" >
			  <div id="inwinontargetModal<?php echo $sr; ?>" class="js-modal-window u-modal-window max-width-960" data-modal-type="ontarget" data-open-effect="fadeIn" data-close-effect="fadeOut" data-speed="500" style="margin:auto; margin-top:10%; background-color:#FFFFFF;">
				<div class="card mx-4 mx-xl-0 mb-4 mb-md-0">
				  <button type="button" class="border-0 width-50 height-50 bg-primary flex-content-center position-absolute rounded-circle mt-n4 mr-n4 top-0 right-0" aria-label="Close" onClick="$('#ontargetModal<?php echo $sr; ?>').hide();$('#inwinontargetModal<?php echo $sr; ?>').hide();"> <i class="fa fa-times" aria-hidden="true"></i> </button>
				  <!-- Header -->
					<?php
						$j=0; 
						foreach((array) $flightList->CON_DETAILS as $layoverFlight){
						
						if($layoverFlight->FLIGHT_NAME!=''){
					?>
				  <header class="card-header bg-light py-4 px-4">
					<div class="row align-items-center text-center">
					  <div class="col-md-auto mb-4 mb-md-0">
						<div class="d-block d-lg-flex flex-horizontal-center"> <img class="img-fluid mr-3 mb-3 mb-lg-0" src="<?php echo $imgurl.getflightlogo($flightList->F_NAME); ?>" >
						  <div class="font-size-14"><?php echo $layoverFlight->FLIGHT_NAME; ?> <?php echo $layoverFlight->FLIGHT_CODE; ?> <?php echo $layoverFlight->FLIGHT_NO; ?> 
						  </div>
						</div>
					  </div>
					  <div class="col-md-auto mb-4 mb-md-0">
						<div class="mx-2 mx-xl-3 flex-content-center align-items-start d-block d-lg-flex">
						   
						  <div class="text-lg-left">
							<h6 class="font-weight-bold font-size-16 text-gray-5 mb-0"><?php echo $layoverFlight->DEP_TIME; ?></h6>
							<div class="font-size-14 text-gray-5"><?php echo date('D, d M y',strtotime($layoverFlight->DEP_DATE)); ?></div>
							<span class="font-size-14 text-gray-1"><?php echo $layoverFlight->ORG_NAME; ?></span> </div>
						</div>
					  </div>
					  <div class="col-md-auto mb-4 mb-md-0">
						<div class="mx-2 mx-xl-3 flex-content-center flex-column">
						  <h6 class="font-size-14 font-weight-bold text-gray-5 mb-0"><?php echo $layoverFlight->DURATION; ?></h6>
						  <div class="width-60 border-top border-primary border-width-2 my-1"></div>
						  <div class="font-size-14 text-gray-1"></div>
						</div>
					  </div>
					  <div class="col-md-auto mb-4 mb-md-0">
						<div class="mx-2 mx-xl-3 flex-content-center align-items-start d-block d-lg-flex">
						   
						  <div class="text-lg-left">
							<h6 class="font-weight-bold font-size-16 text-gray-5 mb-0"><?php echo $layoverFlight->ARRV_TIME; ?></h6>
							<div class="font-size-14 text-gray-5"><?php echo date('D, d M y',strtotime($layoverFlight->DEP_DATE)); ?></div>
							<span class="font-size-14 text-gray-1"><?php echo $layoverFlight->DES_NAME; ?></span> </div>
						</div>
					  </div>
					</div>
				  </header>
				  <div style="padding: 1px; font-size: 13px; font-weight: 100; color: red;"><?php echo $layoverFlight->LAYOVER_INFO; ?></div>
				  <?php $j++; } } ?>
				  <!-- End Header -->
				  <!-- Body -->
				  <div class="card-body py-4 p-md-5">
					<div class="row">
					  <div class="col">
						<ul class="d-block d-md-flex list-group list-group-borderless list-group-horizontal list-group-flush no-gutters">
						  <li class="mr-md-8 mr-lg-10 mb-5 list-group-item py-0">
							<div class="font-weight-bold text-dark">Baggage</div>
							<span class="text-gray-1">Adult</span> </li>
						  <li class="mr-md-8 mr-lg-10 mb-5 list-group-item py-0">
							<div class="font-weight-bold text-dark">Check-in</div>
							<span class="text-gray-1">15 Kgs</span> </li>
						  <li class="mr-md-8 mr-lg-10 mb-5 list-group-item py-0">
							<div class="font-weight-bold text-dark">Cabin</div>
							<span class="text-gray-1">7 Kgs</span> </li>
						</ul>
					  </div>
					
					  <div class="col-auto">
						<div class="min-width-250">
						  <h5 class="font-size-17 font-weight-bold text-dark">Fare breakup</h5>
						  <ul class="list-unstyled font-size-1 mb-0 font-size-16">
							<li class="d-flex justify-content-between py-2"> <span class="font-weight-medium">Base Fare</span> <span class="text-secondary">&#8377;  <?php echo $getCalCost[2]; ?></span> </li>
							<li class="d-flex justify-content-between py-2"> <span class="font-weight-medium">Surcharges & Taxes</span> <span class="text-secondary">&#8377;  <?php echo $getCalCost[0]; ?></span> </li>
							<li class="d-flex justify-content-between py-2 font-size-17 font-weight-bold"> <span class="font-weight-bold">Pay Amount</span> <span class="">&#8377;  <?php echo $getCalCost[1];  ?> </span> </li>
						  </ul>
						</div>
					  </div>
					</div>
				  </div>
				  <!-- End Body -->
				</div>
			  </div>
			</div>
			
			</div>
			<?php $sr++; }} ?>
			<script>
			$('#totalrecordgo').text('<?php echo $totalgo; ?>');
			</script>
			</td>
			<td width="49.5%" align="left" valign="top" class="listouterReturn"><div class="mb-2">
			<div class="border rounded-xs py-4 px-4 px-xl-5" style="background-color: #fff; padding: 10px !important;">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
			<td align="left" style="font-size:16px; font-weight:500;"><?php echo $_REQUEST['toDestinationFlight']; ?>&nbsp; <i class="fa fa-arrow-right" aria-hidden="true"></i> &nbsp;<?php echo $_REQUEST['fromDestinationFlight']; ?></td>
			<td width="30%" align="right" style="font-size:13px;"><?php echo date('d M Y',strtotime($returnDate)); ?> </td>
			</tr>
			<tr>
			<td colspan="2" align="left" style=" padding-top:2px; font-size:12px;"><span id="totalcome">0</span> results found.</td>
			</tr>
			</table>
			</div>
			</div>
		
			<div class="mb-2 sortdivmain">
			<div class="border rounded-xs py-4 px-4 px-xl-5 hideinmobile" style="padding:10px !important; background-color:#ebf0f7; font-size:12px;">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
			<td width="21%" align="center" style="cursor:pointer;"  onClick="getSortedDepartureReturn();" >Departure <i class="fa fa-arrow-down" id="departurefaReturn" aria-hidden="true"></i>
			<input name="departurefilterid" type="hidden" id="departurefilteridReturn" value="1"></td>
			<td width="21%" align="center" style="cursor:pointer;"  onClick="getSortedDurationReturn();" >Duration <i class="fa fa-arrow-down" id="durationfaReturn" aria-hidden="true"></i>
			<input name="durationfilterid" type="hidden" id="durationfilteridReturn" value="1"></td>
			<td width="21%" align="center"  style="cursor:pointer;"  onClick="getSortedArrivalReturn();" >Arrival <i class="fa fa-arrow-down" id="arrivalfaReturn" aria-hidden="true"></i>
			<input name="arrivalfilterid" type="hidden" id="arrivalfilteridReturn" value="1">
			</td>
			<td width="21%" align="center" style="cursor:pointer;" onClick="getSortedPriceReturn();" id="pricefilter">Price <i class="fa fa-arrow-down" id="pricefaReturn" aria-hidden="true"></i>
			<input name="pricefilterid" type="hidden" id="pricefilteridReturn" value="1"></td>
			</tr>
			</table>
			</div>
			</div>
			<?php 
			$totalcome=1;
			foreach((array) $data->FLIGHTRT as $flightListRet){ 
			$totalcome++;
			
			
			if(getBlockFlights($agentid,$flightListRet->F_NAME,$flightListRet->PCC)<1){
			
			 ?>
			 
			<?php
			 
			
			
			$i = 1;
			$baseFare=0;	
			$surcharge=0;	
			
			$taxBreakup = explode(',',$flightListRet->TAX_BREAKUP);
			foreach($taxBreakup as $faredetail){
			$newfaredetail = explode('=',$faredetail);
			
			if($newfaredetail[0]=='ab'){
			$adultFare = $newfaredetail[1];
			}
			if($newfaredetail[0]=='ay'){
			 $adultay = $newfaredetail[1];
			}
			if($newfaredetail[0]=='at'){
			 $adultat = $newfaredetail[1];
			} 
			if($newfaredetail[0]=='cb'){
			 $childFare = $newfaredetail[1];
			} 
			if($newfaredetail[0]=='cy'){
			 $childTax = $newfaredetail[1];
			} 
			if($newfaredetail[0]=='ct'){
			 $childTax2 = $newfaredetail[1];
			}
			if($newfaredetail[0]=='ib'){
			 $infantFare = $newfaredetail[1];
			}
			
			
			$i++;
			}
			
			$totalPaxFare=round(($adultFare*$ADT)+($childFare*$CHD)+($infantFare*$INF));
			$totalTax=round((($adultay+$adultat)*$ADT)+(($childTax+$childTax2)*$CHD));
			 
			$getCalCost=calculateflightcost(encode($agentid),$flightListRet->F_NAME,$flightType,$flightListRet->PCC,$toalPax,$totalPaxFare,$totalTax);
			$getCalCost2=calculateflightcostForAgent(encode($agentid),$flightListRet->F_NAME,$flightType,$flightListRet->PCC,$toalPax,$totalPaxFare,$totalTax);
			 
			
			?>
			<div class="card mb-2 item filghtdatalistdiv <?php if($flightListRet->STOP==0){ ?>Non Stop<?php }else{ echo $flightListRet->STOP.' Stop '; } ?> <?php echo  $flightListRet->F_CLASS; ?> <?php echo  $flightListRet->F_NAME; ?> <?php $tarr = explode(':',$flightListRet->D_TIME); echo $tarr[0]; ?> "  price-data-order="<?php echo $getCalCost[1]; ?>" arrival-data-order="<?php echo preg_replace('/[^0-9]/', '', $flightListRet->A_TIME); ?>" departure-data-order="<?php echo preg_replace('/[^0-9]/', '', $flightListRet->D_TIME); ?>" duration-data-order="<?php echo preg_replace('/[^0-9]/', '', $flightListRet->DUR); ?>" data-price="<?php echo $flightListRet->AMT; ?>"  >
			<div class="border rounded-xs py-4 px-4 px-xl-5 flightlisting">
			<label  id="a<?php echo $totalcome; ?>">
			<div >
			
			
			
				<input type="hidden" name="adfareret" value="<?php echo base64_encode('baseFare='.$totalPaxFare.',tax='.$totalTax.',totalFare='.($totalPaxFare+$totalTax)); ?>" > 
				<input type="hidden" name="agfareret" value="<?php echo base64_encode('baseFare='.$getCalCost2[2].',tax='.$getCalCost2[0].',totalFare='.$getCalCost2[1]); ?>" > 
				<input type="hidden" name="clfareret" value="<?php echo base64_encode('baseFare='.$getCalCost[2].',tax='.$getCalCost[0].',totalFare='.$getCalCost[1]); ?>" > 
				
				
				<input type="hidden" id="sharewhatsappret<?php echo $totalcome; ?>" value="Return: <?php echo $flightListRet->F_NAME; ?>(<?php echo $flightListRet->F_CODE; ?>-<?php echo $flightListRet->F_NO; ?>)*%20:%20%0A%20<?php echo $_REQUEST['fromDestinationFlight']; ?>%20-%20<?php echo $_REQUEST['toDestinationFlight']; ?>%20on%20<?php echo $flightListRet->D_TIME; ?>%20<?php echo date('d M Y',strtotime($flightListRet->D_DATE)); ?>-<?php echo $flightListRet->A_TIME; ?> <?php echo date('d M Y',strtotime($flightListRet->A_DATE)); ?>,%202021%20%20Duration:<?php echo makeFlightTime($flightListRet->DUR); ?>, Pax: <?php echo ($_REQUEST['ADT']+$_REQUEST['CHD']+$_REQUEST['INF']); ?>," >
				
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
			<td colspan="2"><div class="flightimgbox"><img class="img-fluid" src="<?php echo $imgurl.getflightlogo($flightListRet->F_NAME); ?>"></div></td>
			<td width="98%"  class="flightname">&nbsp;<?php echo $flightListRet->F_NAME; ?><div style="color:#a9a9a9"><?php echo $flightListRet->F_CODE; ?> <?php echo $flightListRet->F_NO; ?></div></td>
			</tr>
			</table>
			</div>
			<div class="row align-items-center text-center">
			<div class="col-md mb-4 mb-md-0">
			<div class="flex-content-center d-block d-lg-flex">
			<div class="mr-lg-2 mb-1 mb-lg-0"> <i class="flaticon-aeroplane font-size-20 text-primary"></i> </div>
			<div class="text-lg-left">
			<h6 class="font-weight-bold font-size-16 text-gray-5 mb-0"><?php echo $flightListRet->D_TIME; ?></h6>
			<span class="font-size-14 text-gray-1"><?php echo $flightListRet->D_NAME; ?></span> </div>
			</div>
			</div>
			<div class="mb-4 mb-md-0 rightbtnsec">
			<div class="flex-content-center flex-column">
			<h6 class="font-size-14 font-weight-bold text-gray-5 mb-0"><?php echo makeFlightTime($flightListRet->DUR); ?></h6>
			<div class="width-60 border-top border-primary border-width-2 my-1"></div>
			<div class="font-size-14 text-gray-1 retstops ">
			<?php if($flightListRet->STOP==0){ ?>
			Non Stop
			<?php }else{ ?><span style="color:#bf0000 !important;"><?php echo $flightListRet->STOP.' Stop '; ?></span><?php } ?>
			<span style="display:none;"><?php echo  $flightListRet->F_CLASS.'Class'; ?></span></div>
			</div>
			</div>
			<div class="col-md mb-4 mb-md-0">
			<div class="flex-content-center d-block d-lg-flex">
			<div class="mr-lg-2 mb-1 mb-lg-0"> <i class="d-block rotate-90 flaticon-aeroplane font-size-20 text-primary"></i> </div>
			<div class="text-lg-left">
			<h6 class="font-weight-bold font-size-16 text-gray-5 mb-0"><?php echo $flightListRet->A_TIME; ?></h6>
			<span class="font-size-14 text-gray-1"><?php echo $flightListRet->A_NAME; ?></span> </div>
			</div>
			</div>
			<div class="col-md " >
			<div class="border-xl-left">
			<div class="ml-xl-2">
			<div class="mb-2">
			  <div class="mb-2 text-lh-1dot4"> <span class="font-weight-bold font-size-16">&#8377; &nbsp;<span id="finalCostapiright<?php echo $totalcome; ?>"><span id="finalCostapiret<?php echo $totalcome; ?>"><?php echo $getCalCost[1]; ?></span></span> &nbsp;&nbsp;
				<input name="flightReturn" id="flightReturn<?php echo $totalcome; ?>" type="radio" data-return="<?php echo $totalcome; ?>" value="<?php echo $totalcome; ?>" style="width: 18px; height: 18px;"  onClick="selectmultiflightsright(<?php echo $totalcome; ?>);" <?php   if($totalcome==1){ } ?> class="radioclass" fieldid="<?php echo $totalcome; ?>" >
				
				<input name="flightReturnjson" type="hidden" id="flightReturnjson" value="<?php echo htmlentities(json_encode($flightListRet,true)); ?>">
				<?php
$flightinfodata = explode('|', $flightListRet->FLIGHT_INFO); 
?>
<input type="hidden" name="racom" value="<?php echo getAgentCommission($getCalCost2[2],$flightListRet->F_NAME,$flightListRet->PCC); ?>"  />
				</span>  </div>
			</div>
			
			<!-- End On Target Modal -->
			</div>
			</div>
			</div>
			</div>
			</label>
			<div  class="flightdetails" id="ontargetModalReturn<?php echo $totalcome; ?>" >
			  <div id="inwinontargetModalReturn<?php echo $totalcome; ?>" class="js-modal-window u-modal-window max-width-960" data-modal-type="ontarget" data-open-effect="fadeIn" data-close-effect="fadeOut" data-speed="500" style="margin:auto; margin-top:10%; background-color:#FFFFFF;">
				<div class="card mx-4 mx-xl-0 mb-4 mb-md-0">
				  <button type="button" class="border-0 width-50 height-50 bg-primary flex-content-center position-absolute rounded-circle mt-n4 mr-n4 top-0 right-0" aria-label="Close" onClick="$('#ontargetModalReturn<?php echo $totalcome; ?>').hide();$('#inwinontargetModalReturn<?php echo $totalcome; ?>').hide();"> <i class="fa fa-times" aria-hidden="true"></i> </button>
				  <!-- Header -->
				  <?php
					$j=0; 
					foreach((array) $flightListRet->CON_DETAILS as $layoverFlight){
					
					if($flightListRet->FLIGHT_NAME!=''){
					?>
				  <header class="card-header bg-light py-4 px-4">
					<div class="row align-items-center text-center">
					  <div class="col-md-auto mb-4 mb-md-0">
						<div class="d-block d-lg-flex flex-horizontal-center"> <img class="img-fluid mr-3 mb-3 mb-lg-0" src="<?php echo $imgurl.getflightlogo($flightListRet->F_NAME); ?>" >
						  <div class="font-size-14"><?php echo $layoverFlight->FLIGHT_NAME; ?> <?php echo $layoverFlight->FLIGHT_CODE; ?> <?php echo $layoverFlight->FLIGHT_NO; ?> 
						  </div>
						</div>
					  </div>
					  <div class="col-md-auto mb-4 mb-md-0">
						<div class="mx-2 mx-xl-3 flex-content-center align-items-start d-block d-lg-flex">
						   
						  <div class="text-lg-left">
							<h6 class="font-weight-bold font-size-16 text-gray-5 mb-0"><?php echo $layoverFlight->DEP_TIME; ?></h6>
							<div class="font-size-14 text-gray-5"><?php echo date('D, d M y',strtotime($layoverFlight->DEP_DATE)); ?></div>
							<span class="font-size-14 text-gray-1"><?php echo $layoverFlight->ORG_NAME; ?></span> </div>
						</div>
					  </div>
					  <div class="col-md-auto mb-4 mb-md-0">
						<div class="mx-2 mx-xl-3 flex-content-center flex-column">
						  <h6 class="font-size-14 font-weight-bold text-gray-5 mb-0"><?php echo $layoverFlight->DURATION; ?></h6>
						  <div class="width-60 border-top border-primary border-width-2 my-1"></div>
						  <div class="font-size-14 text-gray-1"></div>
						</div>
					  </div>
					  <div class="col-md-auto mb-4 mb-md-0">
						<div class="mx-2 mx-xl-3 flex-content-center align-items-start d-block d-lg-flex">
						   
						  <div class="text-lg-left">
							<h6 class="font-weight-bold font-size-16 text-gray-5 mb-0"><?php echo $layoverFlight->ARRV_TIME; ?></h6>
							<div class="font-size-14 text-gray-5"><?php echo date('D, d M y',strtotime($layoverFlight->DEP_DATE)); ?></div>
							<span class="font-size-14 text-gray-1"><?php echo $layoverFlight->DES_NAME; ?></span> </div>
						</div>
					  </div>
					</div>
				  </header>
				  <div style="padding: 1px; font-size: 13px; font-weight: 100; color: red;"><?php echo $layoverFlight->LAYOVER_INFO; ?></div>
				  <?php $j++;  } } ?>
				  <!-- End Header -->
				  <!-- Body -->
				  <div class="card-body py-4 p-md-5">
					<div class="row">
					  <div class="col">
						<ul class="d-block d-md-flex list-group list-group-borderless list-group-horizontal list-group-flush no-gutters">
						  <li class="mr-md-8 mr-lg-10 mb-5 list-group-item py-0">
							<div class="font-weight-bold text-dark">Baggage</div>
							<span class="text-gray-1">Adult</span> </li>
						  <li class="mr-md-8 mr-lg-10 mb-5 list-group-item py-0">
							<div class="font-weight-bold text-dark">Check-in</div>
							<span class="text-gray-1">15 Kgs</span> </li>
						  <li class="mr-md-8 mr-lg-10 mb-5 list-group-item py-0">
							<div class="font-weight-bold text-dark">Cabin</div>
							<span class="text-gray-1">7 Kgs</span> </li>
						</ul>
					  </div>
					
					  <div class="col-auto">
						<div class="min-width-250">
						  <h5 class="font-size-17 font-weight-bold text-dark">Fare breakup</h5>
						  <ul class="list-unstyled font-size-1 mb-0 font-size-16">
							<li class="d-flex justify-content-between py-2"> <span class="font-weight-medium">Base Fare</span> <span class="text-secondary">&#8377;  <?php echo $getCalCost[2]; ?></span> </li>
							<li class="d-flex justify-content-between py-2"> <span class="font-weight-medium">Surcharges & Taxes</span> <span class="text-secondary">&#8377;  <?php echo $getCalCost[0];  ?></span> </li>
							<li class="d-flex justify-content-between py-2 font-size-17 font-weight-bold"> <span class="font-weight-bold">Pay Amount</span> <span class="">&#8377;  <?php  echo $getCalCost[1];  ?> </span> </li>
						  </ul>
						</div>
					  </div>
					</div>
				  </div>
				  <!-- End Body -->
				</div>
			  </div>
			</div>
		 
			
 <?php if(getfaretypedetails($flightListRet->F_NAME,$flightListRet->PCC)!=''){ ?><div class="ymsg"><?php echo stripslashes(getfaretypedetails($flightListRet->F_NAME,$flightListRet->PCC)); ?></div><?php } ?>
			
			
			<div class="ffoterbox" style="padding: 8px 8px 5px;">

			<div class="box"><a class="font-size-14 text-gray-1 d-block flightdetailslink" onClick="$('#ontargetModalReturn<?php echo $totalcome; ?>').show();$('#inwinontargetModalReturn<?php echo $totalcome; ?>').show();" style="margin-top: 0px;"><i class="fa fa-list" aria-hidden="true"></i> Flight Details </a></div>
			 <div class="box"><div class="<?php if($flightinfodata[0]=='REFUNDABLE'){ ?>greentabmsg<?php } else { ?>redtabmsg<?php } ?>"><?php if($flightinfodata[0]=='REFUNDABLE'){ echo 'Refundable'; } else { echo 'Non Refundable'; } ?></div></div>
		
		
			 <div class="box2"> <input name="sharecheckedret" id="sharecheckedret<?php echo $totalcome; ?>" type="checkbox" value="<?php echo $sr; ?>" class="sharecheckedret" onclick="getshareonwhatsapp();" />  </div>
		 
			<div class="box2">
			<span class="shownetpriceret<?php echo $totalcome; ?>" style="display:none;">Net Price: <strong>&#8377;  <?php if($getCalCost2[2]==getAgentCommission($getCalCost2[2],$flightListRet->F_NAME,$flightListRet->PCC)){ echo round($getCalCost[1]); }else{ echo round($getCalCost2[1]-getAgentCommission($getCalCost2[2],$flightListRet->F_NAME,$flightListRet->PCC)); } ?></strong> <a  onclick="$('.shownetpriceret<?php echo $totalcome; ?>').hide();$('.showpricebtnret<?php echo $totalcome; ?>').show();" style="cursor:pointer; text-decoration:underline;" >Hide</a></span><a  onclick="$('.shownetpriceret<?php echo $totalcome; ?>').show();$('.showpricebtnret<?php echo $totalcome; ?>').hide();" style="cursor:pointer;" class="showpricebtnret<?php echo $totalcome; ?>">Net Price</a>
			
			 </div>
		 
			</div>
			</div>
			</div>
			<?php  } }  ?>
			<script>
			$('#totalcome').text('<?php echo $totalcome; ?>');
			</script>
			</td>
			</tr>
			</table>
			
		
			
			<div style="position:fixed; left:0px; bottom:0px; width:100%; padding-left: 22%;z-index: 999; display:none;" id="multiselectdiv">
<div style="background-color: #0a223d; color: #fff; font-size: 13px; width: 80%; margin: auto; padding: 15px; border-radius: 4px; margin-bottom: 10px; box-shadow: 0px 0px 5px #00000063;">
 <form action="display.html?ga=bookflight" method="post" target="_blank" >
 	<input type="hidden" name="PARAM" value="<?php echo htmlentities(json_encode($data->PARAM,true)); ?>" >
			<input type="hidden" name="action" value="roundtripsubmit" >
			<input type="hidden" name="tyipType" value="<?php echo $tripType; ?>">
			<input type="hidden" name="sector" value="<?php echo $SECTOR; ?>"> 
				<input type="hidden" name="bookingst" value="off" > 
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="45%" align="left" valign="top"><div style="font-weight:500; color:#3d97dc; margin-bottom:5px;text-transform: uppercase;">Departure</div><div  id="leftdata"></div></td>
      <td width="45%" align="left" valign="top"  style="padding-left: 20px; border-left: 1px solid #ffffff3b;"><div style="font-weight:500; color:#3d97dc; margin-bottom:5px;text-transform: uppercase;">Return</div><div  id="rightdata"></div></td>
      <td align="left" valign="top"  style="padding-left: 20px; border-left: 1px solid #ffffff3b; text-align:center;">
	  <div style="font-size:12px;">Total Fare</div>
	  <div style="font-size:18px; font-weight:500;">&#8377;  <span id="totalbothflightcost"></span></div>
	  <button type="submit" class="btn btn-blue-1 width-lg-200 text-white border-radius-2 font-weight-bold btn-md mb-xl-0 mb-lg-1 transition-3d-hover w-100 w-md-auto" style="padding: 10px; height: auto; margin-top: 10px;">Book Now</button>
	  </td>
    </tr>
  </table></form>
</div>
</div>

<style>
#leftdata .rightbtnsec{display:none;}

#leftdata .text-gray-1 {
    color: #ffffff !important;
}

#leftdata .text-gray-5 {
    color: #fff !important;
}

#leftdata input { display:none;}
#leftdata .border-xl-left { 
    padding-left: 0px;
    border-left: 0px !important;
}

#rightdata .rightbtnsec{display:none;}

#rightdata .text-gray-1 {
    color: #ffffff !important;
}

#rightdata .text-gray-5 {
    color: #fff !important;
}

#rightdata input { display:none;}

#rightdata .border-xl-left { 
    padding-left: 0px;
    border-left: 0px !important;
}
</style>

			
			
			<script>
			function selectmultiflightsleft(id){
			var id = $('input[name="flightDeparture"]:checked').attr('fieldid'); 
			var leftdata = $('#b'+id).html();
			leftdata.replace('flightDeparture', '');
			leftdata.replace('ontargetModal', 'ontargetModalsmall');
			 $('#leftdata').html(leftdata); 
			  $('#multiselectdiv').show();
			 // ontargetModal
			 finalflightcost();
			}
			
			
			function selectmultiflightsright(id){
			var id = $('input[name="flightReturn"]:checked').attr('fieldid'); 
			var leftdata = $('#a'+id).html();
			leftdata.replace('flightReturn', '');
			leftdata.replace('ontargetModalReturn', 'ontargetModalReturnsmall');
			 $('#rightdata').html(leftdata);
			 $('#rightdata ').html(leftdata);
			 $('#multiselectdiv').show();
			 // $('#rightdata .radioclass').remove(); 
			 finalflightcost();
			}
			
			function finalflightcost(){
			var did = $('input[name="flightDeparture"]:checked').attr('fieldid');
			var aid = $('input[name="flightReturn"]:checked').attr('fieldid'); 
			
			 var finalCostapileft = Number($('#finalCostapileft'+did).text());
			 var finalCostapiright = Number($('#finalCostapiright'+aid).text());
			
			 $('#totalbothflightcost').text(Number(finalCostapileft+finalCostapiright));
			
			
			}
			
			$('#flightDeparture1').trigger('click');
			$('#flightReturn2').trigger('click');
			
			</script>
			
			<?php }
			
		 
			if($sr=='0'){
			?>
			<div>No Record found.</div>
			<?php	
			}
			?>
            </div>
          </div>
        </div>
 
				 
					
					</div>
					
 
					
<?php } ?>
</div> 
			 
 </div>
			
</div>

 
<script>

 
 
function getSortedPrice(){

var pricefilterid = $('#pricefilterid').val();
var $wrap = $('.listouter');
hideallfilterarrow(); 
$('#pricefa').show();

$wrap.find('.item').sort(function(a, b) 
{

if(pricefilterid==1){

$('#pricefilterid').val('0'); 
$('#pricefa').removeClass('fa-arrow-down');
$('#pricefa').addClass('fa-arrow-up');

return + a.getAttribute('price-data-order') - 
+b.getAttribute('price-data-order'); 


}else{

$('#pricefilterid').val('1'); 
$('#pricefa').removeClass('fa-arrow-up');
$('#pricefa').addClass('fa-arrow-down');

return + b.getAttribute('price-data-order') - 
+a.getAttribute('price-data-order');


}

})


.appendTo($wrap); 
}


 getSortedPrice();


 
function getSortedArrival() 
{
var pricefilterid = $('#arrivalfilterid').val();
var $wrap = $('.listouter');
hideallfilterarrow(); 
$('#arrivalfa').show(); 

$wrap.find('.item').sort(function(a, b) 
{

if(pricefilterid==1){

$('#arrivalfilterid').val('0'); 
$('#arrivalfa').removeClass('fa-arrow-down');
$('#arrivalfa').addClass('fa-arrow-up');

return + a.getAttribute('arrival-data-order') - 
+b.getAttribute('arrival-data-order'); 



} else {

$('#arrivalfilterid').val('1'); 
$('#arrivalfa').removeClass('fa-arrow-up');
$('#arrivalfa').addClass('fa-arrow-down');

return + b.getAttribute('arrival-data-order') - 
+a.getAttribute('arrival-data-order');


}

})


.appendTo($wrap); 
}





 
function getSortedDeparture() 
{
var pricefilterid = $('#departurefilterid').val();
var $wrap = $('.listouter');
hideallfilterarrow();
$('#departurefa').show(); 

$wrap.find('.item').sort(function(a, b) 
{

if(pricefilterid==1){

$('#departurefilterid').val('0'); 
$('#departurefa').removeClass('fa-arrow-down');
$('#departurefa').addClass('fa-arrow-up');

return + a.getAttribute('departure-data-order') - 
+b.getAttribute('departure-data-order'); 



} else {

$('#departurefilterid').val('1'); 
$('#departurefa').removeClass('fa-arrow-up');
$('#departurefa').addClass('fa-arrow-down');

return + b.getAttribute('departure-data-order') - 
+a.getAttribute('departure-data-order');


}

})


.appendTo($wrap); 
}



 
function getSortedDuration() 
{
var pricefilterid = $('#durationfilterid').val();
var $wrap = $('.listouter');
hideallfilterarrow(); 
$('#durationfa').show(); 

$wrap.find('.item').sort(function(a, b) 
{

if(pricefilterid==1){

$('#durationfilterid').val('0'); 
$('#durationfa').removeClass('fa-arrow-down');
$('#durationfa').addClass('fa-arrow-up');

return + a.getAttribute('duration-data-order') - 
+b.getAttribute('duration-data-order'); 



} else {

$('#durationfilterid').val('1'); 
$('#durationfa').removeClass('fa-arrow-up');
$('#durationfa').addClass('fa-arrow-down');

return + b.getAttribute('duration-data-order') - 
+a.getAttribute('duration-data-order');


}

})


.appendTo($wrap); 
}





//------------------Return---------------------


function getSortedPriceReturn() 
{
var pricefilterid = $('#pricefilteridReturn').val();
var $wrap = $('.listouterReturn');
hideallfilterarrow(); 
$('#pricefaReturn').show();

$wrap.find('.item').sort(function(a, b) 
{

if(pricefilterid==1){

$('#pricefilteridReturn').val('0'); 
$('#pricefaReturn').removeClass('fa-arrow-down');
$('#pricefaReturn').addClass('fa-arrow-up');

return + a.getAttribute('price-data-order') - 
+b.getAttribute('price-data-order'); 



} else {

$('#pricefilteridReturn').val('1'); 
$('#pricefaReturn').removeClass('fa-arrow-up');
$('#pricefaReturn').addClass('fa-arrow-down');

return + b.getAttribute('price-data-order') - 
+a.getAttribute('price-data-order');


}

})


.appendTo($wrap); 
}
getSortedPriceReturn();




 
function getSortedArrivalReturn() 
{
var pricefilterid = $('#arrivalfilteridReturn').val();
var $wrap = $('.listouterReturn');
hideallfilterarrow(); 
$('#arrivalfaReturn').show(); 

$wrap.find('.item').sort(function(a, b) 
{

if(pricefilterid==1){

$('#arrivalfilteridReturn').val('0'); 
$('#arrivalfaReturn').removeClass('fa-arrow-down');
$('#arrivalfaReturn').addClass('fa-arrow-up');

return + a.getAttribute('arrival-data-order') - 
+b.getAttribute('arrival-data-order'); 



} else {

$('#arrivalfilteridReturn').val('1'); 
$('#arrivalfaReturn').removeClass('fa-arrow-up');
$('#arrivalfaReturn').addClass('fa-arrow-down');

return + b.getAttribute('arrival-data-order') - 
+a.getAttribute('arrival-data-order');


}

})


.appendTo($wrap); 
}





 
function getSortedDepartureReturn() 
{
var pricefilterid = $('#departurefilteridReturn').val();
var $wrap = $('.listouterReturn');
hideallfilterarrow();
$('#departurefaReturnReturn').show(); 

$wrap.find('.item').sort(function(a, b) 
{

if(pricefilterid==1){

$('#departurefilteridReturn').val('0'); 
$('#departurefaReturn').removeClass('fa-arrow-down');
$('#departurefaReturn').addClass('fa-arrow-up');

return + a.getAttribute('departure-data-order') - 
+b.getAttribute('departure-data-order'); 



} else {

$('#departurefilteridReturn').val('1'); 
$('#departurefaReturn').removeClass('fa-arrow-up');
$('#departurefaReturn').addClass('fa-arrow-down');


return + b.getAttribute('departure-data-order') - 
+a.getAttribute('departure-data-order');


}

})


.appendTo($wrap); 
}



 
function getSortedDurationReturn() 
{
var pricefilterid = $('#durationfilteridReturn').val();
var $wrap = $('.listouterReturn');
hideallfilterarrow(); 
$('#durationfaReturn').show(); 

$wrap.find('.item').sort(function(a, b) 
{

if(pricefilterid==1){

$('#durationfilteridReturn').val('0'); 
$('#durationfaReturn').removeClass('fa-arrow-down');
$('#durationfaReturn').addClass('fa-arrow-up');

return + a.getAttribute('duration-data-order') - 
+b.getAttribute('duration-data-order'); 



} else {

$('#durationfilteridReturn').val('1'); 
$('#durationfaReturn').removeClass('fa-arrow-up');
$('#durationfaReturn').addClass('fa-arrow-down');

return + b.getAttribute('duration-data-order') - 
+a.getAttribute('duration-data-order');


}

})


.appendTo($wrap); 
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
function loadingshow(){
$('#load').css('visibility','visible')
}



$('#flightDeparture1').trigger('click');
$('#flightReturn2').trigger('click');

selectpaxs();



$('#totalBusiness').text(countBusinessclass);
$('#FlightTypeDivBusi').addClass("displayClass_"+countBusinessclass);

 
 



function getflightSearchCIty(citysearchfield,cityresultfield,listsearch){
var citysearchfieldval = encodeURI($('#'+citysearchfield).val());  
var citysearchfield = citysearchfield;

if(citysearchfieldval!=''){  
$('#'+listsearch).show();
$('#'+listsearch).load('searchflightcitylists.php?keyword='+citysearchfieldval+'&searchcitylists='+listsearch+'&cityresultfield='+cityresultfield+'&citysearchfield='+citysearchfield);
}
}

$("#allFilterDiv :checkbox").click(function() {
	var re = new RegExp($("#allFilterDiv :checkbox:checked").map(function() {
						  return this.value;
					   }).get().join("|") );
					   
		   
   $(".filghtdatalistdiv").each(function() {
	  var $this = $(this);  
	  $this[re.source!="" && re.test($this.attr("class")) ? "show" : "hide"]();
  
   });
   
});



var temp = $('body').text();
var stops = $('.stops').text();
var stopsret = $('.retstops').text();
var countflight = 0;
var tempName = $('.flightNameClass').text();





//non stop count
var countnonstop = stops.match(/Non Stop/g);
if(countnonstop==null){
countnonstop = 0;
}
else{
countnonstop = Number(countnonstop.length);
}
$('#totalNonstop').text(countnonstop);
 
$('#nonstopdiv').addClass("displayClass_"+countnonstop);

//one stop count
var countonestop = stops.match(/1 Stop/g);
if(countonestop==null){
countonestop = 0;
}
else{
countonestop = Number(countonestop.length);
}

$('#totalOnestop').text(countonestop);
$('#onestopdiv').addClass("displayClass_"+countonestop);

//two stop count
var counttwostop = stops.match(/2 Stop/g);
if(counttwostop==null){
counttwostop = 0;
}
else{
counttwostop = Number(counttwostop.length);
}
$('#totalTwostop').text(counttwostop);
$('#twostopdiv').addClass("displayClass_"+counttwostop);

//three stop count
var countThreestop = stops.match(/3 Stop/g);
if(countThreestop==null){
countThreestop = 0;
}
else{
countThreestop = Number(countThreestop.length);
}
$('#totalThreestop').text(countThreestop);
$('#threestopdiv').addClass("displayClass_"+countThreestop);


//non stop count ret
var countnonstopret = stopsret.match(/Non Stop/g);
if(countnonstopret==null){
countnonstopret = 0;
}
else{
countnonstopret = Number(countnonstopret.length);
}
$('#totalNonstopret').text(countnonstopret);
$('#nonstopdivret').addClass("displayClass_"+countnonstopret);

//one stop count ret
var countonestopret = stopsret.match(/1 Stop/g);
if(countonestopret==null){
countonestopret = 0;
}
else{
countonestopret = Number(countonestopret.length);
}
$('#totalOnestopret').text(countonestopret);
$('#onestopdivret').addClass("displayClass_"+countonestopret);

//two stop count ret
var counttwostopret = stopsret.match(/2 Stop/g);
if(counttwostopret==null){
counttwostopret = 0;
}
else{
counttwostopret = Number(counttwostopret.length);
}
$('#totalTwostopret').text(counttwostopret);
$('#twostopdivret').addClass("displayClass_"+counttwostopret);

//three stop count ret
var countThreestopret = stopsret.match(/3 Stop/g);
if(countThreestopret==null){
countThreestopret = 0;
}
else{
countThreestopret = Number(countThreestopret.length);
}
$('#totalThreestopret').text(countThreestopret);
$('#threestopdivret').addClass("displayClass_"+countThreestopret);

//Flight Economy Class count
var countEconomyclass = temp.match(/EconomyClass/g);
countEconomyclass = countEconomyclass.length;
$('#totalEconomy').text(countEconomyclass);
$('#FlightTypeDivEco').addClass("displayClass_"+countEconomyclass);

//Flight Business Class count
var countBusinessclass = temp.match(/BusinessClass/g);
if(countBusinessclass==null){
countBusinessclass = 0;
}else{
countBusinessclass = countBusinessclass.length;
}

$('#totalBusiness').text(countBusinessclass);
$('#FlightTypeDivBusi').addClass("displayClass_"+countBusinessclass);

</script>

<?php
$a=GetPageRecord('id,name','sys_flightName','1 order by id asc'); 
while($res=mysqli_fetch_array($a)){
?>
<script>
countflight = tempName.match(/<?php echo $res['name']; ?>/g);
if(countflight==null){
countflight = 0;
}else{ 
countflight = Number(countflight.length);
}
$('#flightNamecount<?php echo $res['id']; ?>').text(countflight);
$('#filterFlightNameDiv<?php echo $res['id']; ?>').addClass("displayClass_"+countflight);
</script>
<?php } ?>


<input id="hiddenleftwhatsappshare" type="hidden" value="" />

<div style="background-color:#FFFFFF; left:0px; top:0px; position:fixed; width:100%; height:100%; z-index: 9999999;" id="flightloadingbox">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3" align="center" valign="middle"><img src="images/flightsearchloader.gif" width="84" id="flightsearchloader" /><img src="images/booknowloader.gif" width="200" id="booknowloader" style="display:none;" /><div style="margin-top:10px; text-align:center;">Please Wait...</div></td>
    </tr>
</table>

</div>
<script>
$('#flightloadingbox').hide();
</script>

<div class="row">
				
				<div class="col-lg-1"></div>
				<div class="col-lg-10">
				
				<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
				  <div class="carousel-inner">
					<?php 
					$n=1; 
					$rs=GetPageRecord('*','agentBannerMaster',' agentId=0 and bannerType="flight" order by  RAND() ');
					while($res1=mysqli_fetch_array($rs)){ 
					?>
					<div class="carousel-item <?php if($n==1){ ?>active<?php } ?>">
					<a href="<?php echo $res1['bannerURL']; ?>" target="_blank">
					  <img class="banneraddashbaord" src="<?php echo $imgurl.$res1['bannerImage']; ?>" alt="<?php echo $n; ?>">
					</a>
					</div>
					<?php $n++; } ?> 
					 
				  </div>
				  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				  </a>
				  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				  </a>
				</div>
				
				
 
				</div>
				<div class="col-lg-1"></div>
				</div>