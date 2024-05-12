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

?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
<title>Holidays</title>
<?php
include "headerinc.php";
?>

<script>
function opendashboard(){
$('body').removeClass('loginbg');
$('body').load('dashboard.php');
}
</script>

<style>
body{background-color:#f0f7fe;}
#basicDropdownClick .form-group { margin-right:2px; margin-bottom: 10px !important; float:left; }
#basicDropdownClick .form-control { max-width:80px; padding:5px !important; }
#basicDropdownClick .row{float:left; width:100%;}
</style>

  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css"> 
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
</head>
<body>

<div class="innerpageaccountheader" style="width:100% !important;"><i class="fa fa-arrow-left" aria-hidden="true" onclick="closeWindow();"></i>Hotels</div>
<div class="blkaria"></div>
<div class="bodyouter" style="margin-top: -60px; padding:10px;">
 <form method="GET" id="formids" action="<?php $fullurl; ?>hotelsearch.php"> 
<div class="innerbodycard" style="position:relative;">
 <div class="searchfieldlable labeldesti">Destination</div>
 <div style="height: 0px; font-size: 0px; position: relative; width: 100%; text-align: left; display: none;" id="searchcitylistsfromCity"></div>
 <div class="input-group destinationsearch" style="margin-bottom:0px; border:0px; padding:5px 0px; ">  

 
  <input type="text" onclick="$('#pickupCitySearchfromCity3').select();" class="form-control destinput" requered="" onkeyup="getSearchCityHotel('pickupCitySearchfromCity3','destinationHotel','searchcitylistsfromCity3');" id="pickupCitySearchfromCity3" name="citydestination" value="MANALI, INDIA" autocomplete="nope" style="border:0px; padding:0px 0px 10px; font-size:18px; font-weight:600;">
  <input name="destinationHotel" id="destinationHotel" type="hidden" value="656671,106" autocomplete="nope">
</div>


 <table class="datetravel" style="margin-bottom:0px;">
       <tr>
		<td style="border-left:0px;     padding-top:15px;padding-bottom:10px; border-bottom:0px;"> <div class="searchfieldlable">Check In</div>
          <input name="checkInDate"  id="dt1"  class="searchfielinbox" readonly="readonly" type="text"   value="<?php echo date('d-m-Y'); ?>"  />
		</td>
		<td style="direction: rtl;border-right:0px;padding-top: 15px;padding-bottom: 10px; border-bottom:0px;"> <div class="searchfieldlable">Check Out</div>
          <input name="checkOutDate"   id="dt2"  class="searchfielinbox" readonly="readonly" type="text"  value="<?php echo date('d-m-Y',strtotime('+1 Days')); ?>"  />
		</td>
	   </tr>
 </table>
 
 
 <table class="datetravel">
       <tr>
		<td style="border-left:0px;     padding-top:15px;padding-bottom:10px;width: 50%;"> <div class="searchfieldlable">Rooms & Guests</div>
		<input type="text" id="travellersshow" name="travellers" class="searchfielinbox" value="1 Room - 1 Guest" autocomplete="nope" readonly="readonly" onclick="$('#basicDropdownClick').show();">
		
		<div id="basicDropdownClick" class="dropdown-menu dropdown-unfold col-11 m-0" aria-labelledby="basicDropdownClickInvoker" style="width: 95%; padding: 10px; right: 0px;  display:none; border-radius: 10px;">
                   <div class=" "  style="margin-bottom: 10px; width:100%; position:relative;">
					  <strong>Guests</strong> <i class="fa fa-times" aria-hidden="true" style="position: absolute; right: 0px; cursor: pointer; top: 4px; font-size: 16px; color: #000;" onClick="$('#basicDropdownClick').hide();"></i>					  </div>
					  
					<?php 
					$empno=1;
					for($empno=1; $empno<=$_GET['empcount']; $empno++){
					
					?> 
					<div class="row" id="empInfoId<?php echo $empno; ?>" style="margin-right: 0px; margin-left: 1px;">
					
					<div class="roomguestblockdiv">
					<div class="form-group">  
						<div style="font-weight: 500; margin-top: 46px; padding-right: 10px;"><?php echo $empno; ?></div>
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
					<i class="fa fa-plus" aria-hidden="true" style="margin-top: 29px; cursor: pointer; background-color: #000; padding: 6px 8px; color: #fff; border-radius: 2px; font-size: 12px;margin-left: 2px;" onClick="addEmpInfo();"></i>
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
						<div style="font-weight: 500; margin-top: 44px; padding-right: 10px;" class="romonecalendar">1</div>
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
					
					 
					</div>
					<?php 
					 } 
					?> 
					<input name="empcount" type="hidden" id="empcount" value="<?php if($empno==1){ echo '1'; } else { echo $empno-1; } ?>" />
					<input name="totalpax" type="hidden" id="totalpax" value="<?php if($_REQUEST['totalpax']==''){ echo '1'; } else { echo $_REQUEST['totalpax']; } ?>" />
					 
		 
					 
					<div id="loademployee">					</div>
					
					<div style="width:100%; float:left; text-align:center;">
					<a onClick="addEmpInfo();" style="background-color: var(--base-color) !important; width: 100%; display: block; color: #fff !important; padding: 10px; box-sizing: border-box; border-radius: 5px;"><i class="fa fa-plus addroombtn" aria-hidden="true"  ></i> Add Room</a>
					</div>
                    </div>
          
		</td>
		<td style=" text-align:right;border-right:0px;padding-top: 15px;padding-bottom: 10px;"> <div class="searchfieldlable">Hotel Category</div> 
		
		<style>
		.dropdown-menu{text-align: left; padding: 10px; position: absolute; background-color: #fff; box-shadow: 0px 0px 10px #dcdcdc; width: 170px; z-index: 999; right: 0px; display:none;}
		.dropdown-menu label{margin-top: 0px; display: block; line-height: 20px; padding: 5px 5px 10px;}
		.dropdown-menu td{padding-bottom:2px !important;}
		.searchfielinbox{font-size:16px;}
		</style>
		<input type="text" id="starcategory" name="starcategory" class="searchfielinbox" value="4, 5 Star" autocomplete="nope" readonly="readonly" onclick="$('#basicDropdownClickstar').show();" style="text-align:right;">
		
		<div id="basicDropdownClickstar" class="dropdown-menu dropdown-unfold col-11 m-0" aria-labelledby="basicDropdownClickInvoker" style="display:none;"  >
                   <div class=" "  style="margin-bottom: 10px; width:100%; position:relative;">
					  <strong>Star Category</strong> <i class="fa fa-times" aria-hidden="true" style="position: absolute; right: 0px; cursor: pointer; top: 4px; font-size: 16px; color: #000;" onClick="$('#basicDropdownClickstar').hide();"></i>
			    </div>
					  
				  <table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-size:13px;">
  <tr>
    <td><label><input name="category[]" type="checkbox" value="1" style="width: 20px; height: 16px; float: left; margin-right: 3px;"  onclick="combinecheckbox()"     /> 1 Star</label></td>
    </tr>
  <tr>
    <td><label><input name="category[]" type="checkbox" value="2" style="width: 20px; height: 16px; float: left; margin-right: 3px;" onClick="combinecheckbox()"   /> 2 Star</label></td>
    </tr>
  <tr>
    <td><label><input name="category[]" type="checkbox" value="3"  style="width: 20px; height: 16px; float: left; margin-right: 3px;"  onclick="combinecheckbox()"    /> 3 Star</label></td>
    </tr>
  <tr>
    <td><label><input name="category[]" type="checkbox" value="4"  style="width: 20px; height: 16px; float: left; margin-right: 3px;"  onclick="combinecheckbox()"  checked="checked" /> 4 Star</label></td>
    </tr>
  <tr>
    <td><label><input name="category[]" type="checkbox" value="5"  style="width: 20px; height: 16px; float: left; margin-right: 3px;"  onclick="combinecheckbox()"  checked="checked" /> 5 Star</label></td>
    </tr>
</table>

					 
              </div>
		</td>
	   </tr>
 </table>



 
 <div style="text-align: center; width: 100%;   box-sizing: border-box; margin-bottom: -39px;">
 
 <input name="submit" value="Search" type="submit"  class="searchbigbtn"/>
 
 </div>
 
 
<script>
  

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
 
 
 
 
 
 function getSearchCityHotel(citysearchfield,cityresultfield,listsearch){
var citysearchfieldval = encodeURI($('#'+citysearchfield).val());  
var citysearchfield = citysearchfield;

if(citysearchfieldval!=''){  
$('#searchcitylistsfromCity').show();
$('#searchcitylistsfromCity').load('hotelcity.php?keyword='+citysearchfieldval+'&searchcitylists='+listsearch+'&cityresultfield='+cityresultfield+'&citysearchfield='+citysearchfield);
} else {
$('#searchcitylistsfromCity').hide();
}
}




  
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
</div>
</form>
</div>



<?php $n=1; foreach($contentresmark['Marquee'] as $list){ 


if($list['marqueeType']=='hotel'){

if($n==1){

?>
<div class="sectionheading" style="margin-top:10px;"><div style="padding: 12px; background-color: #DDFCFF; font-size: 14px; text-align: center; border-radius: 10px; border: 1px solid #a6ebed; margin-bottom: 20px; "><?php echo stripslashes($list['name']); ?></div></div>
<?php   }  $n++; }  } ?>



<div class="sectionheading" style="margin-top:10px;">Exclusive Hotels Deals</div>
 
<div class="packagelistouter">
	<?php 
	foreach($contentoffer['Offers'] as $list){
	if($list['offerType']=='hotel'){ 
	?>
	<div class="packagebox" onclick="openWindow('<?php echo $fullurl.'offerdetails.php?id='.$list['Id'].''; ?>');">
	<div class="imgbox">
	<img src="<?php echo $list['banner']; ?>" />
	</div>
	<div class="name"><?php echo stripslashes($list['name']); ?></div> 
	</div>
	
	
	<?php  } }	?>
	
</div>


 
 
 



<?php
include "footerinc.php";
?>

</body>
</html>
