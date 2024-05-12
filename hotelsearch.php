<?php 
include "inc.php"; 
include "config/logincheck.php"; 
$page='hotels';
$selectedpage='hotels';


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




 

 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<title>Hotel Search - <?php echo stripslashes($getcompanybasicinfo['companyName']); ?></title>
<?php include "headerinc.php"; ?>


 <style>


 
.hoteltext h5{font-size: 20px !important;}
 .relocation{color: #4a4a4a !important;}
.hotelsearchwhite { top: 22px; }
.hoteltableborder label{width:100%;}
.flightsearchwihite .searchboxouter table tr td{padding-right:10px;}
.flightsearchwihite .searchboxouter table tr td:last-child{padding-right:0px;}
.searchmainflightbn table tr td{border: none !important;}
.searchmainflightbn .hoteltableborder{border: none !important;}
.flightsearchwihite .searchboxouter table tr td .fa-calendar{top: 16px !important;font-size: 18px !important;}
.hotelbookrow{border: 1px solid #e1e1e1 !important;}
.hotelbookrow:hover{border: 1px solid var(--blue) !important;}
    .hotelbookrow .col-lg-9{border-right: 1px solid #e1e1e1 !important;}
    .hotelbookrow .col-lg-3{background-color: transparent !important;}
	.searchmainflightbn{margin-bottom: 20px !important;height: 320px !important;}
 .col-2 .card:first-child{margin-top:0px;}
 .col-9 .card:first-child{margin-top:0px;}

 @media (max-width: 576px){
	#fromlabel{width: auto !important;}
	.hoteltext{width: 100% !important;}
	#loadallhotels {
    margin-top: 155px !important;
}

@media (max-width: 575.98px) {
  .flightsearchwihite .lable{margin-left: 6px !important; top: 27px !important; padding: 9px 4px !important;}
  .searchboxouter .textfield{border-radius: 5px !important;padding: 30px 10px !important;font-size: 14px !important;padding-bottom: 14px !important;margin-top: 0px !important;border: 1px solid #ddd !important;}
  #pickupCitySearchfromCity2{margin-left: 0px !important;}
  .flightsearchwihite .searchboxouter .tableborder table tr td{width: 50% !important;}
  .swapbtn{top: 25px !important; font-size: 14px !important;width: 34px !important;height: 34px !important;}
  .tablebordersearch{padding-left: 4px !important;}
  .fa-calendar:before{ top: 18px !important; right: -7px !important;font-size: 16px !important;}
  .offerheading h3 {font-size: 17px; margin-left: 12px !important; }
  .holidestibox .card-body{background-color: transparent !important;top: 0px;}
  .flightsearchwihite{top: 40px !important;}
  .holidestibox{margin-bottom: 10px !important;}
  .holidestibox a{color: #000 !important;}
  .holidestibox p{color: #000 !important;font-weight: 600 !important;}
  .holidestibox .card{border: 1px solid #ddd;}
  .fa-calendar:before {top: 0px !important;right: 4px !important;font-size: 12px !important;}
  .holidestibox p{margin-top: 5px !important;text-align: left !important;}
  .holipricing{justify-content: left !important;}
  .pricelistflight tr{grid-template-columns: 33% 33% 33% !important;}
  .tablebordersearch{border: 1px solid #ddd !important;padding-bottom: 3px !important;}
  .tableborder table{position: relative;top: -4px !important;}
  .flightsearchwihite .searchboxouter .tableborder table tr td:last-child{padding-right: 12px !important;}
.mobileshowonly ul {margin-bottom: 0px !important;margin-top: 50px;padding-left: 0px !important;}
.mobileshowonly ul li { display: inline-block; list-style: none; margin: 0px 5px; border: 1px solid #fff; background-color: #fff; border-radius: 5px; padding: 16px 10px; width: 90px; height: 70px; }
.mobileshowonly ul li a { font-size: 12px !important; font-weight: 700 !important; display: grid; text-align: center; color: #333333; }
.mobileshowonly ul li a i {font-size: 28px;}
.mobileshowonly{display: unset !important;}
.top_bg_ofr_sb2other{border-radius: 0px !important;}
.mobileshowonly{text-align: center !important;}
.domheading{top: 160px !important;font-size: 18px !important;}
.top_bg_ofr_sb2other{margin-top: 15px !important;height: 250px !important;}
.searchboxouter .textfield{border-left: 1px solid #ddd !important;}
.flightsearchwihite .searchboxouter .hoteltableborder table tr td:first-child{border: none !important;}
.hotelheading{margin-top: 208px !important;}
.tableborder{border: 1px solid #ddd !important;padding: 0px 6px !important; padding-bottom: 2px !important;}
.hotelsearchwhite{padding: 30px 10px !important;}
.messagesection{margin-top: 100px !important;}
.searchmainflightbn .searchboxouter .textfield{margin-bottom: -8px !important;font-size: 14px !important; margin-top: 0px !important;}
.flightsearchwihite .searchboxouter table tr td .fa-calendar{top: 35px !important;color: #fff !important;}
.searchmainflightbn{height: 246px !important;}
.flightsearchwihite .searchboxouter .redbuttonsearch{margin-top: 20px !important;padding: 27px 35px !important; max-width: 100% !important;border-radius: 5px !important;}
.searchmainflightbn .flightsrchdetails{background-color: transparent !important;}
.mobilehight{height: 245px !important;}
#loadallhotels{margin-top: 0px !important;}
.fa-calendar:before{color: #fff !important;}
.Deluxe{margin-top: 5px !important;}
.bookbtn h4{margin-top: 5px !important;}
.hotelbookrow .btn-danger{margin-bottom: 10px !important;}
.hotelbookrow .col-lg-3{padding-top: 0px !important;}
.searchmainflightbn .hotelsearchwhite{margin-left: 0px !important;padding-left: 0px !important;padding-right: 0px !important;}
.hoteltableborder{padding-left: 0px !important;padding-right: 0px !important;}
.searchboxouter{padding-right: 0px !important;}

.filtersidebar {display: none !important; position: fixed; top: 30%; z-index: 9999; width: 93%; margin-left: 3% !important;  background: #fff; border-radius: 10px !important; box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px; }
.hotelfilter .card-header{padding-top: 15px !important;}
}

 }


 </style>
 
</head>

<body>

<?php include "header.php"; ?>
<div class="top_bg_ofr_sb top_bg_ofr_sb2other homeflightsearchouterbox hotelmainbg mobilehight searchmainflightbn" style="margin-bottom: 90px;padding: 50px 0px;">
   
    
    <div class="container mobilecontainer" style="padding: 0px 20px; padding-top: 185px;">
   
    <div class="flightsearchwihite hotelsearchwhite">
     
    <script>
    $(document).mouseup(function(e)
    {
        var container = $("#fromflightdestination"); 
        if (!container.is(e.target) && container.has(e.target).length === 0) 
        {
            $('#searchcitylistsfromCity').hide();
        } else { 
        
        $('#searchcitylistsfromCity2').hide();
        }
        
         var container = $("#toflightdestination"); 
        if (!container.is(e.target) && container.has(e.target).length === 0) 
        {
            $('#searchcitylistsfromCity2').hide();
        } else { 
        
        $('#searchcitylistsfromCity').hide();
        }
    });
    
    
     
    </script>
    <div class="searchboxouter flightsearchhomebox hotelboxouter">
    <form  method="GET" id="formids" action="<?php echo $fullurl; ?>hotel-search" > 
                    <input type="hidden" name="tripType" id="tripType" value="1">
    <div class="tableborder hoteltableborder">
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tbody><tr>
        <td width="20%" align="left" valign="top" id="fromflightdestination"> 
		<div class="flightsrchdetails">
         	<div style="height:0px; font-size:0px; position:relative; width: 100%; text-align: left;" id="searchcitylistsfromCity3"></div>
        <div class="lable" id="fromlabel"><span class="cityspan">Enter city name,</span> Location</div>
                <label>        
        <div style="height: 0px; font-size: 0px; position: relative; width: 100%; text-align: left; display: none;" id="searchcitylistsfromCity"></div>
          <input  type="text" onClick="$('#pickupCitySearchfromCity3').select();" class="textfield" requered="" onKeyUp="getSearchCityHotel('pickupCitySearchfromCity3','destinationHotel','searchcitylistsfromCity3');" id="pickupCitySearchfromCity3" name="citydestination" value="<?php echo $citydestination; ?>" autocomplete="nope" >
	  
	  <input name="destinationHotel" id="destinationHotel" type="hidden" value="<?php echo $destinationHotel; ?>" autocomplete="nope">
	  </label>
          <div class="swapbtn hotelswapbtn" onClick="swapdata();"><i class="fa fa-exchange" aria-hidden="true"></i></div>       
		</div>
		  </td> 
        <td width="18%" align="left" valign="top">
		<div class="flightsrchdetails">
			 <label>   <div class="lable" id="departurelabel">CHECK IN</div><input type="text" id="dt1" name="checkInDate" class="textfield"  value="<?php echo trim($checkInDate); ?>" autocomplete="off"  ><i class="fa fa-calendar" aria-hidden="true"></i></label>
		</div>
			</td>
        <td width="18%" align="left" valign="top" onClick="selecttb(2);" class="selectreturnflightcl">
		<div class="flightsrchdetails">
         <label>   
        <div class="lable" id="returnlable">CHECK OUT</div>
        <input type="text" id="dt2" name="checkOutDate" class="textfield"  value="<?php echo trim($checkOutDate); ?>" autocomplete="off"   ><i class="fa fa-calendar" aria-hidden="true"></i>
		 </label></div>
 </td>
        
        <td width="20%" align="left" valign="top"  >
		<div class="flightsrchdetails">
	<div class="lable" id="travellable">Rooms &amp; Guests</div>
	<input type="text" id="travellersshow"  name="travellers"  class="textfield"  value="<?php echo trim($travellers); ?>" autocomplete="nope" readonly="readonly" onClick="$('#basicDropdownClick').show();" >
							
	  <script>
  $('#basicDropdownClick').click(function(event){
  event.stopPropagation();
});
  </script>
 
 
 <style>
 #basicDropdownClick .form-group{margin-right:10px;margin-bottom: 10px !important;}
 
 </style>
 <div id="basicDropdownClick" class="dropdown-menu dropdown-unfold col-11 m-0" aria-labelledby="basicDropdownClickInvoker" style="max-width: 510px; width:510px; padding:10px; right:0px;">
                   <div class=" "  style="margin-bottom: 10px; width:100%; position:relative;">
					  <strong>Guests</strong> <i class="fa fa-times" aria-hidden="true" style="position: absolute; right: 0px; cursor: pointer; top: 4px; font-size: 16px; color: #000;" onClick="$('#basicDropdownClick').hide();"></i>					  </div>
					  
					<?php 
					$empno=1;
					for($empno=1; $empno<=$_GET['empcount']; $empno++){
					
					?> 
					<div class="row" id="empInfoId<?php echo $empno; ?>" style="margin-right: 0px; margin-left: 1px;">
					
					<div class="roomguestblockdiv">
					<div class="form-group">  
						<div style="font-weight: 500; margin-top:27px">Room - <?php echo $empno; ?></div>
					</div>
					</div>
					<div class="roomguestblockdiv">
					<div class="form-group"> <?php if($empno==1){ ?><label for="subject">Adult</label><?php } ?>
					
					<select class="form-control select2 pax" id="noadults<?php echo $empno; ?>" name="noadults<?php echo $empno; ?>" onChange="gettotalpax();"> 
												<option value="1" <?php if($_GET['noadults'.$empno]=='1'){ echo 'selected'; }?> >1 Adult</option>
												<option value="2" <?php if($_GET['noadults'.$empno]=='2'){ echo 'selected'; }?>>2 Adults</option>
												<option value="3" <?php if($_GET['noadults'.$empno]=='3'){ echo 'selected'; }?>>3 Adults</option>  
												</select> 
					</div>
					</div>
					<div class="roomguestblockdiv">
					<div class="form-group"><?php if($empno==1){ ?><label for="subject">Child</label><?php } ?>
					
					<select class="form-control select2 pax" id="nochilds<?php echo $empno; ?>" name="nochilds<?php echo $empno; ?>" onChange="showAgeColumn<?php echo $empno; ?>(this.value);gettotalpax();"> 
						<option value="0" <?php if($_GET['nochilds'.$empno]=='0'){ echo 'selected'; }?>>0 Child</option>
						<option value="1" <?php if($_GET['nochilds'.$empno]=='1'){ echo 'selected'; }?>>1 Child</option>
						<option value="2" <?php if($_GET['nochilds'.$empno]=='2'){ echo 'selected'; }?>>2 Childs</option> 
					</select> 
					</div>
					</div>
					<script>
					function showAgeColumn<?php echo $empno; ?>(numChild){
					//var numChild = ().val();
					if(numChild==1){
						$('#childAgediv1<?php echo $empno; ?>').show();
						$('#childAgediv2<?php echo $empno; ?>').hide();
					}
					if(numChild==2){
						$('#childAgediv1<?php echo $empno; ?>').show();
						$('#childAgediv2<?php echo $empno; ?>').show();
					}
					if(numChild==0){
						$('#childAgediv1<?php echo $empno; ?>').hide();
						$('#childAgediv2<?php echo $empno; ?>').hide();
					}
					}
					showAgeColumn<?php echo $empno; ?>(<?php echo $_GET['nochilds'.$empno]; ?>);
					</script>
					
					<div class="roomguestblockdiv" id="childAgediv1<?php echo $empno; ?>" >
					<div class="form-group"><?php if($empno==1){ ?><label for="subject">Child Age</label><?php } ?>
					<select class="form-control" id="age1<?php echo $empno; ?>" name="age1<?php echo $empno; ?>"> 
						<option value="0" <?php if($_GET['age1'.$empno]=='0'){ echo 'selected'; }?>>0</option>
						<option value="1" <?php if($_GET['age1'.$empno]=='1'){ echo 'selected'; }?>>1</option>
						<option value="2" <?php if($_GET['age1'.$empno]=='2'){ echo 'selected'; }?>>2</option> 
						<option value="3" <?php if($_GET['age1'.$empno]=='3'){ echo 'selected'; }?>>3</option>
						<option value="4" <?php if($_GET['age1'.$empno]=='4'){ echo 'selected'; }?>>4</option>
						<option value="5" <?php if($_GET['age1'.$empno]=='5'){ echo 'selected'; }?>>5</option>
						<option value="6" <?php if($_GET['age1'.$empno]=='6'){ echo 'selected'; }?>>6</option>
						<option value="7" <?php if($_GET['age1'.$empno]=='7'){ echo 'selected'; }?>>7</option>
						<option value="8" <?php if($_GET['age1'.$empno]=='8'){ echo 'selected'; }?>>8</option>
						<option value="9" <?php if($_GET['age1'.$empno]=='9'){ echo 'selected'; }?>>9</option>
						<option value="10" <?php if($_GET['age1'.$empno]=='10'){ echo 'selected'; }?>>10</option>
						<option value="11" <?php if($_GET['age1'.$empno]=='11'){ echo 'selected'; }?>>11</option>
					</select> 
					</div>
					</div>
					<div class="roomguestblockdiv" id="childAgediv2<?php echo $empno; ?>" >
					<div class="form-group"><?php if($empno==1){ ?><label for="subject">Child Age</label><?php } ?>
					<select class="form-control" id="age2<?php echo $empno; ?>" name="age2<?php echo $empno; ?>"> 
						<option value="0" <?php if($_GET['age2'.$empno]=='0'){ echo 'selected'; }?>>0</option>
						<option value="1" <?php if($_GET['age2'.$empno]=='1'){ echo 'selected'; }?>>1</option>
						<option value="2" <?php if($_GET['age2'.$empno]=='2'){ echo 'selected'; }?>>2</option> 
						<option value="3" <?php if($_GET['age2'.$empno]=='3'){ echo 'selected'; }?>>3</option>
						<option value="4" <?php if($_GET['age2'.$empno]=='4'){ echo 'selected'; }?>>4</option>
						<option value="5" <?php if($_GET['age2'.$empno]=='5'){ echo 'selected'; }?>>5</option>
						<option value="6" <?php if($_GET['age2'.$empno]=='6'){ echo 'selected'; }?>>6</option>
						<option value="7" <?php if($_GET['age2'.$empno]=='7'){ echo 'selected'; }?>>7</option>
						<option value="8" <?php if($_GET['age2'.$empno]=='8'){ echo 'selected'; }?>>8</option>
						<option value="9" <?php if($_GET['age2'.$empno]=='9'){ echo 'selected'; }?>>9</option>
						<option value="10" <?php if($_GET['age2'.$empno]=='10'){ echo 'selected'; }?>>10</option>
						<option value="11" <?php if($_GET['age2'.$empno]=='11'){ echo 'selected'; }?>>11</option>
					</select> 
					</div>
					</div>
					
					<div class="roomguestblockdiv">
					<div class="form-group"> 
					<?php if($empno==1){ ?>
					<i class="fa fa-plus" aria-hidden="true" style="margin-top: 23px; cursor: pointer; background-color: #000; padding: 6px 8px; color: #fff; border-radius: 2px; font-size: 12px;margin-left: 2px;" onClick="addEmpInfo();"></i>
					<?php }else{ ?>
					<i class="fa fa-trash" aria-hidden="true" style="margin-top:6px; cursor: pointer; background-color: #f1646c; padding: 6px 8px; color: #fff; border-radius: 2px; font-size: 12px;margin-left: 2px;"  onclick="removeEmpInfo(<?php echo $empno; ?>);"></i>
					<?php } ?>
					</div>
					</div>
					</div>
					<?php 
					  }
					
					if($empno==1){
					?> 
					<div class="row" id="empInfoId1" style="margin-right: 0px; margin-left: 1px;">
					
					<div class="roomguestblockdiv">
					<div class="form-group">   
						<div style="font-weight: 500; margin-top:27px;">Room - 1</div>
					</div>
					</div>
					<div class="roomguestblockdiv">
					<div class="form-group"><label for="subject">Adult</label>  
					
					<select class="form-control select2 pax" id="noadults1" name="noadults1" onChange="gettotalpax();"> 
												<option value="1" selected="selected">1 Adult</option>
												<option value="2">2 Adults</option>
												<option value="3">3 Adults</option> 
												<option value="4">4 Adults</option> 
												</select> 
					</div>
					</div>
					<div class="roomguestblockdiv">
					<div class="form-group"><label for="subject">Child</label>  
					
					<select class="form-control select2 pax" id="nochilds1" name="nochilds1" onChange="showAgeColumn1(this.value);gettotalpax();"> 
						<option value="0" selected="selected">0 Child</option>
						<option value="1">1 Child</option>
						<option value="2">2 Childs</option> 
					</select> 
					</div>
					</div>
					<script>
					function showAgeColumn1(numChild){
						if(numChild==1){
							$('#childAgediv11').show();
							$('#childAgediv21').hide();
						}
						if(numChild==2){
							$('#childAgediv11').show();
							$('#childAgediv21').show();
						}
						if(numChild==0){
							$('#childAgediv11').hide();
							$('#childAgediv21').hide();
						}
					}
					showAgeColumn1('0');
					</script>
					
					<div class="roomguestblockdiv" id="childAgediv11" style="display:none;">
					<div class="form-group"><label for="subject">Child Age</label>  
					<select class="form-control" id="age11" name="age11"> 
						<option value="0">0</option>
						<option value="1">1</option>
						<option value="2">2</option> 
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
						<option value="11">11</option>
					</select> 
					</div>
					</div>
					<div class="roomguestblockdiv" id="childAgediv21" style="display:none;">
					<div class="form-group"><label for="subject">Child Age</label>  
					<select class="form-control" id="age21" name="age21"> 
						<option value="0">0</option>
						<option value="1">1</option>
						<option value="2">2</option> 
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
						<option value="11">11</option>
					</select> 
					</div>
					</div>
					
					<div class="roomguestblockdiv">
					<div class="form-group"> 
					<i class="fa fa-plus addroombtn" aria-hidden="true"  onClick="addEmpInfo();"></i>					</div>
					</div>
					</div>
					<?php 
					 } 
					?> 
					<input name="empcount" type="hidden" id="empcount" value="<?php if($empno==1){ echo '1'; } else { echo $empno-1; } ?>" />
					<input name="totalpax" type="hidden" id="totalpax" value="<?php if($_REQUEST['totalpax']==''){ echo '1'; } else { echo $_REQUEST['totalpax']; } ?>" />
					 
		 
					 
					<div class="form-group"  id="loademployee">					</div>
                    </div>
		</div>
				</td>

        <td width="15%" align="left" valign="top">
		<div class="flightsrchdetails">
	<div class="lable" id="travellable">Hotel&nbsp;Category</div>
	<input type="text" id="starcategory"  name="starcategory"  class="textfield"  value="<?php echo trim($starcategory); ?>" autocomplete="nope" readonly="readonly" onClick="$('#basicDropdownClickstar').show();"  >
	
	<input type="submit" name="Submit" value="SEARCH" class="redbuttonsearch mobileshow">
	
	<div id="basicDropdownClickstar" class="dropdown-menu dropdown-unfold col-11 m-0" aria-labelledby="basicDropdownClickInvoker"  >
                   <div class=" "  style="margin-bottom: 10px; width:100%; position:relative;">
					  <strong>Star Category</strong> <i class="fa fa-times" aria-hidden="true" style="position: absolute; right: 0px; cursor: pointer; top: 4px; font-size: 16px; color: #000;" onClick="$('#basicDropdownClickstar').hide();"></i>
			    </div>
					  
				  <table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-size:13px;">
  <tr>
    <td><label><input name="category[]" type="checkbox" value="1" style="width: 20px; height: 16px; float: left; margin-right: 3px;"  onclick="combinecheckbox()"  <?php if(strpos($category, '1') !== false){ ?> checked="checked" <?php } ?> /> 1 Star</label></td>
    </tr>
  <tr>
    <td><label><input name="category[]" type="checkbox" value="2" style="width: 20px; height: 16px; float: left; margin-right: 3px;" onClick="combinecheckbox()"  <?php if(strpos($category, '2') !== false){ ?> checked="checked" <?php } ?> /> 2 Star</label></td>
    </tr>
  <tr>
    <td><label><input name="category[]" type="checkbox" value="3"  style="width: 20px; height: 16px; float: left; margin-right: 3px;"  onclick="combinecheckbox()" <?php if($category=='' || strpos($category, '3') !== false){ ?> checked="checked" <?php } ?> /> 3 Star</label></td>
    </tr>
  <tr>
    <td><label><input name="category[]" type="checkbox" value="4"  style="width: 20px; height: 16px; float: left; margin-right: 3px;"  onclick="combinecheckbox()"  <?php if($category=='' || strpos($category, '4') !== false){ ?> checked="checked" <?php } ?> /> 4 Star</label></td>
    </tr>
  <tr>
    <td><label><input name="category[]" type="checkbox" value="5"  style="width: 20px; height: 16px; float: left; margin-right: 3px;"  onclick="combinecheckbox()"  <?php if(strpos($category, '5') !== false){ ?> checked="checked" <?php } ?>/> 5 Star</label></td>
    </tr>
</table>

					 
              </div>
		</div>
	</td>


	<td>
	<div class="flightsrchdetails" style="background-color: transparent;">
	<div class="flightsearchbtn hotelsearchbtn"><input type="submit" name="Submit" value="SEARCH" class="redbuttonsearch hotelseachbtn"></div>
	</div>
	</td>

	</label>

        
        </tr>
    </tbody>
</table>
</div>
     


    
    
    
    
    <input type="hidden" name="action" value="flightpostaction" >
<input type="hidden" name="changesearch" id="changesearch" value="0" >
</form>
  </div>
    </div>
    </div>
    </div>
 
 


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

 
 

 

<div class="container" style="margin-top:20px; margin-bottom:20px;"> 
<div class="row" id="loadallhotels">

<div class="col-3 filtersidebar ">

 
<div class="card-body flightloadingshadow">

<div class="row">

 


<div class="col-12">
<div class="shbox6"></div>
<div class="shbox7"></div>


<div class="shbox6"></div>
<div class="shbox7"></div>


<div class="shbox6"></div>
<div class="shbox7"></div>

</div>

 


 

</div>

</div>
 

 

 
</div>


<div class="col-9 cardresult">
<div id="flightresult" class="listouter newlistouter">
 
<div class="card bookrow">

<div class="card-body flightloadingshadow">

<div class="row">

<div class="col-3">

<div class="row">
<div class="col-12">
  <div class="shbox1" style="width: 100%; height: 160px;"></div> 

</div>

 
</div> 


  
 
 
 
 
</div>


<div class="col-6">
<div class="shbox6"></div>
<div class="shbox7"></div>


<div class="shbox6"></div>
<div class="shbox7"></div>


<div class="shbox6"></div>
<div class="shbox7"></div>

</div>

<div class="col-3">
<div class="shbox8"></div>
</div>


 

</div>

</div>



</div>
<div class="card bookrow">

<div class="card-body flightloadingshadow">

<div class="row">

<div class="col-3">

<div class="row">
<div class="col-12">
  <div class="shbox1" style="width: 100%; height: 160px;"></div> 

</div>

 
</div> 


  
 
 
 
 
</div>


<div class="col-6">
<div class="shbox6"></div>
<div class="shbox7"></div>


<div class="shbox6"></div>
<div class="shbox7"></div>


<div class="shbox6"></div>
<div class="shbox7"></div>

</div>

<div class="col-3">
<div class="shbox8"></div>
</div>


 

</div>

</div>



</div>
<div class="card bookrow">

<div class="card-body flightloadingshadow">

<div class="row">

<div class="col-3">

<div class="row">
<div class="col-12">
  <div class="shbox1" style="width: 100%; height: 160px;"></div> 

</div>

 
</div> 


  
 
 
 
 
</div>


<div class="col-6">
<div class="shbox6"></div>
<div class="shbox7"></div>


<div class="shbox6"></div>
<div class="shbox7"></div>


<div class="shbox6"></div>
<div class="shbox7"></div>

</div>

<div class="col-3">
<div class="shbox8"></div>
</div>


 

</div>

</div>



</div>
<div class="card bookrow">

<div class="card-body flightloadingshadow">

<div class="row">

<div class="col-3">

<div class="row">
<div class="col-12">
  <div class="shbox1" style="width: 100%; height: 160px;"></div> 

</div>

 
</div> 


  
 
 
 
 
</div>


<div class="col-6">
<div class="shbox6"></div>
<div class="shbox7"></div>


<div class="shbox6"></div>
<div class="shbox7"></div>


<div class="shbox6"></div>
<div class="shbox7"></div>

</div>

<div class="col-3">
<div class="shbox8"></div>
</div>


 

</div>

</div>



</div>
<div class="card bookrow">

<div class="card-body flightloadingshadow">

<div class="row">

<div class="col-3">

<div class="row">
<div class="col-12">
  <div class="shbox1" style="width: 100%; height: 160px;"></div> 

</div>

 
</div> 


  
 
 
 
 
</div>


<div class="col-6">
<div class="shbox6"></div>
<div class="shbox7"></div>


<div class="shbox6"></div>
<div class="shbox7"></div>


<div class="shbox6"></div>
<div class="shbox7"></div>

</div>

<div class="col-3">
<div class="shbox8"></div>
</div>


 

</div>

</div>



</div>
 
   
 

</div>

</div>
 
</div>
 </div>
 
 
 <div style="display: none;" class="mobilefilterbtn" id="mobofilterbtn">

<i class="fa fa-filter" aria-hidden="true"></i>

</div>


  <?php 
$geturl = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$geturl = str_replace($fullurl,'',$geturl);
$geturl = str_replace('hotel-search','',$geturl);

 
$pagesearch='hotel_search_load.php'.$geturl;
  
  
 ?>
  

 
 

<?php include "footer.php"; ?>
<script>
$('#loadallhotels').load('<?php echo $pagesearch; ?>');
</script>

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
</script>
</body>
</html>
