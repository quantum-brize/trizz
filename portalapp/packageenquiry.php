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
 


$url = $basesiteurl."packagedetailpage_mobile.php";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);

		$data = array(
		'id' => $_REQUEST['id']
); 

curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
$contents = curl_exec($ch);
$contentres=json_decode($contents,true); 
curl_close($ch);
  
 
 

?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
<title>Holidays Enquery</title>
<?php
include "headerinc.php";
?>
<style>
.filedlable{font-size:13px; color:#000000; margin-bottom:2px;} 
</style>

</head>
<body style=" background-color:#ffe8a4;">

<div class="innerpageaccountheader" style="width:100% !important;"><i class="fa fa-arrow-left" aria-hidden="true" onclick="closeWindow();"></i>Holidays Enquiry</div>
 
 <div class="bodyouter" style="padding-top:65px;">
 <div class="card" style="border: 0px;box-shadow: 0px 10px 18px #29426917; background-color:#ffe8a4;">

<div class="card-header" style="text-align: center; padding: 15px 0px; background-color: #ffffffc7; border-radius: 10px;">

<div style="font-size:18px; font-weight:600; ">Want to Go For A Memorable Holiday?</div>

<div style="font-size:11px; color:#666666;">Provide Your Details to Know Best Holiday Deals</div>





</div>

<div class="card-body" style="padding:20px;" id="showflightbookingcancelaltion"> 

<form action="frmaction.html" method="post" target="actoinfrm"><div class="row">

 <div class="col-sm-12 mb-3">

 

 <div class="filedlable">Destination</div>

 	<div style="height:0px; font-size:0px; position:relative; width: 100%; text-align: left;" id="searchcitylistsfromCity3"></div>

	  <input type="text" onclick="$('#pickupCitySearchfromCity3').select();" class="form-control" requered="" onkeyup="getSearchCityHotel('pickupCitySearchfromCity3','destinationHotel','searchcitylistsfromCity3');" id="pickupCitySearchfromCity3" name="citydestination" value="" autocomplete="nope"  placeholder="Destination Name" required="required" >

	  

	  <input name="destinationHotel" id="destinationHotel" type="hidden" value="" autocomplete="nope">

 

 

 </div>

 

 

 

 <div class="col-sm-12 mb-3">

 

 <div class="filedlable">City of Departure</div>

 	<select name="departureCity" class="form-control" id="departurecity" tabindex="2" placeholder="City of Departure" type="email" required="">

                                            <option value="Bangalore">Bangalore</option>

                                            <option value="Bombay (Mumbai)">Bombay (Mumbai)</option>

                                            <option value="Kolkata">Kolkata</option>

                                            <option selected="selected" value="New Delhi">New Delhi</option>

                                            <option value="Goa">Goa</option>

                                            <option value="Hyderabad">Hyderabad</option>

                                            <option value="Chennai">Chennai</option>

                                            <option value="Pune">Pune</option>

                                            <option value="">--------------------</option>

                                            <option value="Agartala">Agartala</option>

                                            <option value="Agatti Island">Agatti Island</option>

                                            <option value="Agra">Agra</option>

                                            <option value="Ahmedabad">Ahmedabad</option>

                                            <option value="Aizawl">Aizawl</option>

                                            <option value="Allahabad">Allahabad</option>

                                            <option value="Amritsar">Amritsar</option>

                                            <option value="Aurangabad">Aurangabad</option>

                                            <option value="Bagdogra">Bagdogra</option>

                                            <option value="Bahawalpur">Bahawalpur</option>

                                            <option value="Bangalore">Bangalore</option>

                                            <option value="Belgaum">Belgaum</option>

                                            <option value="Bellary">Bellary</option>

                                            <option value="Bhavnagar">Bhavnagar</option>

                                            <option value="Bhopal">Bhopal</option>

                                            <option value="Bhubaneswar">Bhubaneswar</option>

                                            <option value="Bhuj">Bhuj</option>

                                            <option value="Biratnagar">Biratnagar</option>

                                            <option value="Chandigarh">Chandigarh</option>

                                            <option value="Chennai">Chennai</option>

                                            <option value="Cochin">Cochin</option>

                                            <option value="Coimbatore">Coimbatore</option>

                                            <option value="Dehra Dun">Dehra Dun</option>

                                            <option value="New Delhi">New Delhi</option>

                                            <option value="Dharamshala">Dharamshala</option>

                                            <option value="Dibrugarh">Dibrugarh</option>

                                            <option value="Dimapur">Dimapur</option>

                                            <option value="Diu">Diu</option>

                                            <option value="Guwahati">Guwahati</option>

                                            <option value="Gaya">Gaya</option>

                                            <option value="Goa">Goa</option>

                                            <option value="Tezpur">Tezpur</option>

                                            <option value="Gorakhpur">Gorakhpur</option>

                                            <option value="Gwalior">Gwalior</option>

                                            <option value="Hubli">Hubli</option>

                                            <option value="Hyderabad">Hyderabad</option>

                                            <option value="Imphal">Imphal</option>

                                            <option value="Indore">Indore</option>

                                            <option value="Jabalpur">Jabalpur</option>

                                            <option value="Jaipur">Jaipur</option>

                                            <option value="Jaisalmer">Jaisalmer</option>

                                            <option value="Jammu">Jammu</option>

                                            <option value="Jamnagar">Jamnagar</option>

                                            <option value="Jamshedpur">Jamshedpur</option>

                                            <option value="Jodhpur">Jodhpur</option>

                                            <option value="Jorhat">Jorhat</option>

                                            <option value="Kailashahar">Kailashahar</option>

                                            <option value="Kandla">Kandla</option>

                                            <option value="Kanpur">Kanpur</option>

                                            <option value="Khajuraho">Khajuraho</option>

                                            <option value="Kochi">Kochi</option>

                                            <option value="Kolhapur">Kolhapur</option>

                                            <option value="Kolkata">Kolkata</option>

                                            <option value="Kozhikode">Kozhikode</option>

                                            <option value="Kulu">Kulu</option>

                                            <option value="Leh">Leh</option>

                                            <option value="Lilabari">Lilabari</option>

                                            <option value="Lucknow">Lucknow</option>

                                            <option value="Madurai">Madurai</option>

                                            <option value="Mangalore">Mangalore</option>

                                            <option value="Bombay (Mumbai)">Bombay (Mumbai)</option>

                                            <option value="Nagpur">Nagpur</option>

                                            <option value="Nanded">Nanded</option>

                                            <option value="Nasik">Nasik</option>

                                            <option value="Pantnagar">Pantnagar</option>

                                            <option value="Pathankot">Pathankot</option>

                                            <option value="Patna">Patna</option>

                                            <option value="Porbandar">Porbandar</option>

                                            <option value="Port Blair">Port Blair</option>

                                            <option value="Pune">Pune</option>

                                            <option value="Raipur">Raipur</option>

                                            <option value="Rajahmundry">Rajahmundry</option>

                                            <option value="Rajkot">Rajkot</option>

                                            <option value="Ranchi">Ranchi</option>

                                            <option value="Siliguri">Siliguri</option>

                                            <option value="Shillong">Shillong</option>

                                            <option value="Silchar">Silchar</option>

                                            <option value="Simla">Simla</option>

                                            <option value="Srinagar">Srinagar</option>

                                            <option value="Surat">Surat</option>

                                            <option value="Thiruvananthapuram">Thiruvananthapuram</option>

                                            <option value="Tiruchirappalli">Tiruchirappalli</option>

                                            <option value="Tirupati">Tirupati</option>

                                            <option value="Tuticorin">Tuticorin</option>

                                            <option value="Udaipur">Udaipur</option>

                                            <option value="Vadodara">Vadodara</option>

                                            <option value="Varanasi">Varanasi</option>

                                            <option value="Vijayawada">Vijayawada</option>

                                            <option value="Vishakhapatnam">Vishakhapatnam</option>

                                            <option value="Vizag">Vizag</option>

                </select>

 

 

 </div>

 

 

 

 <div class="col-sm-12 mb-3">

 

 <div class="filedlable">Date of Departure</div>

 	 

  <input type="text" name="departuredate" class="form-control" readonly="readonly" id="departuredate" value="19-10-2023" autocomplete="nope"  placeholder="Destination Name">

	   

 

 </div>

  

 <div style=" font-size:16px; margin-bottom:10px; margin-top:0px;  "><strong>Contact Details</strong></div>

 

 

 <div class="col-sm-6 mb-3">

  

 	 

	  <input name="name" type="text" class="form-control" id="name" placeholder="Type your full name" required="required">

	  

	    

 </div>

 

 

 <div class="col-sm-6 mb-3"> 

	  <input class="form-control" type="text" name="email" placeholder="Type your email" required="required"> 

	    

 </div>

 

  <div class="col-sm-3 mb-3"> 
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"><input type="text" name="countrycode" class="form-control" value="+91"></td>
    <td width="80%"> <input class="form-control" type="text" name="mobile" placeholder="Type your mobile number" required="required">

	    <input type="hidden" name="action" value="submitpackageenquiry">

	    <input type="hidden" name="packageName" value="<?php echo stripslashes($contentres['PackageDetails']['name']); ?>"></td>
  </tr>
</table>

	   

	    

 </div>

 

 

 

 <div class="col-sm-12 mb-0"> 

 <button type="submit" class="searchbigbtncom2" style="width: 100%; padding:10px 0px; text-align:center;">Submit</button>

  </div>

</div></form>



</div>

<div id="showflightbookingcancelaltionthanks" style="display:none;">

  <div style="padding:30px; text-align:center;">

  <div style="text-align:center; font-size:24px; color:#CC3300; margin-bottom:10px;">Thank You!</div>

  <div style="text-align:center; font-size:14px; margin-bottom:10px;">One of our team will be in contact with you shortly.</div>

  

  </div>

  </div> 

</div>
  </div>

<?php
include "footerinc.php";
?>

</body>
</html>
