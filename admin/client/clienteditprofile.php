<?php include "clientinc.php"; 
$result =mysqli_query (db(),"select * from userMaster where id='".$_SESSION['clientId']."' ")  or die(mysqli_error());   
$userinfo=mysqli_fetch_array($result);
$pageno=3;
$pagenoedit=3;
 ?>

<!DOCTYPE html>
<html lang="en">
 
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>My Trips - <?php echo $clientnameglobal; ?></title>

<?php include "clientheaderinc.php";  ?>

</head>
<body>
<div class="bodyboxbg"></div>
<div class="careerfy-wrapper">

<?php include "clientheader.php";  ?>


 


<div class="careerfy-main-content">

<div class="careerfy-main-section careerfy-dashboard-fulltwo">
<div class="container">
<div class="row">

<?php include "clientleft.php";  ?>



<div class="careerfy-column-9">
<div class="careerfy-typo-wrap">
<div class="careerfy-employer-box-section">
<form class="" method="post" action="action.html" id="postdata" target="datapost" enctype="multipart/form-data">

<div class="careerfy-profile-title"><h2>EDIT PROFILE</h2></div>
<ul class="careerfy-row careerfy-employer-profile-form">
<li class="careerfy-column-2">
<label>Salutations *</label>
<select name="submitName"  class="form-control">
<option value="Mr." <?php if($userinfo['submitName']=='Mr.'){ ?>selected="selected"<?php } ?>>Mr.</option>
<option value="Mrs." <?php if($userinfo['submitName']=='Mrs.'){ ?>selected="selected"<?php } ?>>Mrs.</option>
<option value="Ms." <?php if($userinfo['submitName']=='Ms.'){ ?>selected="selected"<?php } ?>>Ms.</option>
<option value="Dr." <?php if($userinfo['submitName']=='Dr.'){ ?>selected="selected"<?php } ?>>Dr.</option>
<option value="Prof." <?php if($userinfo['submitName']=='Prof.'){ ?>selected="selected"<?php } ?>>Prof.</option>
</select>
</li>
<li class="careerfy-column-5">
<label>First Name *</label>
<input value="<?php echo $userinfo['firstName']; ?>" type="text" name="firstName">
</li>
<li class="careerfy-column-5">
<label>Last Name *</label>
<input value="<?php echo $userinfo['lastName']; ?>" type="text" name="lastName">
</li>
<li class="careerfy-column-6">
<label>Email *</label>
<input value="<?php echo $userinfo['email']; ?>" type="email" name="email" readonly="">
</li>
<li class="careerfy-column-2">
<label>Code(91)</label>
<input type="text" class="form-control" required="" name="mobileCode" value="<?php echo stripslashes($userinfo['mobileCode']); ?>" >
</li>
<li class="careerfy-column-4">
<label>Phone *</label>
<input value="<?php echo $userinfo['mobile']; ?>" type="text" name="mobile">
</li>
<li class="careerfy-column-6">
<label>City</label>
 <input type="text" class="form-control" onKeyUp="getSearchCIty('pickupCitySearch','pickupCity','searchcitylists');" id="pickupCitySearch" required="" name="pickupCitySearch" value="<?php echo getCityName($userinfo['city']); ?>" autocomplete="off" > 
  <input name="city" id="pickupCity" type="hidden" value="<?php echo stripslashes($userinfo['city']); ?>" />
  <div style="height:0px; font-size:0px; position:relative; margin-top:68px;  " id="searchcitylists"></div>
</li>
<li class="careerfy-column-6">
<label>Address</label>
<input value="<?php echo $userinfo['address']; ?>" type="text" name="address">
</li> 
 
</ul>
 <input type="hidden" name="action" value="editprofilesetting" /> 
<button type="submit" name="submit" class=" bluebutton" style="float: right;padding: 10px; font-size:12px;"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
</form>
</div>
<script>
function getSearchCIty(citysearchfield,cityresultfield,listsearch){
var citysearchfieldval = encodeURI($('#'+citysearchfield).val());  
var citysearchfield = citysearchfield;

if(citysearchfieldval!=''){  
$('#'+listsearch).show();
$('#'+listsearch).load('clientsearchcitylists.php?keyword='+citysearchfieldval+'&searchcitylists='+listsearch+'&cityresultfield='+cityresultfield+'&citysearchfield='+citysearchfield);
}
}
</script>
<div class="careerfy-employer-box-section">
<form class="" method="post" action="action.html" id="postdata" target="datapost" enctype="multipart/form-data">

<div class="careerfy-profile-title">
  <h2>CHANGE PASSWORD</h2>
</div>
<ul class="careerfy-row careerfy-employer-profile-form">
<li class="careerfy-column-4">
<label>Current Password *</label>
<input value="" type="password" name="currPassword">
</li>
<li class="careerfy-column-4">
<label>New Password *</label>
<input value="" type="password" name="newPassword">
</li>
<li class="careerfy-column-4">
<label>Confirm Password *</label>
<input value="" type="password" name="confPassword">
</li> 
 
</ul>
 <input type="hidden" name="action" value="editppasswordsetting" /> 
<button type="submit" name="submit" class=" bluebutton" style="float: right;padding: 10px; font-size:12px;"><i class="fa fa-floppy-o" aria-hidden="true"></i> Update Password</button>
</form>
</div> 

</div>
</div>
</div>
</div>
</div>

</div>


 

</div>
 
<?php include "clientfooterinc.php";  ?>

</body>
 
</html>
