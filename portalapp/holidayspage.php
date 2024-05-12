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
</style>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css"> 
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
</head>
<body>

<div class="innerpageaccountheader" style="width:100% !important;"><i class="fa fa-arrow-left" aria-hidden="true" onclick="closeWindow();"></i>Holidays</div>
<div class="blkaria"></div>
<div class="bodyouter" style="margin-top: -60px; padding:10px;">
<div class="innerbodycard" style="position:relative;">
 <div class="searchfieldlable">Select Destination</div>
 <form method="GET" id="formids" action="<?php $fullurl; ?>searchpackage.php"> 
 <select name="destination" class="searchfielinbox">
  <?php foreach($contentres['Destination'] as $list){ 
  ?>
   <option value="<?php echo $list['id']; ?>"><?php echo $list['name']; ?></option>
   <?php } ?>
 
 </select>
 <div class="searchfieldlable">Travel Date</div>
 <input name="fromdate"   class="searchfielinbox" readonly="readonly" type="text" id="fromdate" value="<?php echo date('d-m-Y'); ?>"  />
 
 <div style="text-align: center; width: 100%;   box-sizing: border-box; margin-bottom: -39px;">
 <input name="submit" value="Search" type="submit"  class="searchbigbtn"/>
 </div>
 </form>
 
   <script>
  $( function() {
    $( "#fromdate" ).datepicker({ dateFormat: 'dd-mm-yy', minDate: +1 });
  } );
  </script>
</div>
</div>




<div class="sectionheading" style="margin-top:10px;">Top Packages</div>
<?php
$url = $basesiteurl."packagelistpage_mobile.php";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);

		$data = array(
		'MemberId' => $_SESSION['userId']
); 

curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
$contents = curl_exec($ch);
$packagedata=json_decode($contents,true); 
curl_close($ch); 
?>
<div class="packagelistouter">
	<?php
	$n=1;
	foreach($packagedata['Package'] as $list){ 
	if($list['price']>0){
	
	if($n<11){
	?>
	<div class="packagebox"  onclick="openWindow('<?php echo $fullurl.'packagedetails.php?id='.$list['packageId'].'&fromdate='.date("d-m-Y", strtotime("+1 day")).''; ?>');">
	<div class="imgbox">
	<img src="<?php echo stripslashes($list['banner']); ?>" />
	</div>
	<div class="name"><?php echo stripslashes($list['name']); ?></div>
	<div class="subline">Start From</div>
	<div class="price">₹<?php echo stripslashes($list['price']); ?></div>
	</div>
	
	
	<?php } $n++;  } }	?>
	
</div>


<div class="sectionheading" style="margin-top:10px;">Destinations</div>
 
<div class="packagelistouter">
	<?php
	$n=1;
	foreach($contentres['Destination'] as $list){ 
	 
	 
	?>

	<div class="packagebox">
		<a href="<?php echo $fullurl; ?>searchpackage.php?destination=<?php echo $list['id']; ?>&fromdate=<?php echo date("d-m-Y", strtotime("+1 day")); ?>">
	<div class="imgbox">
	<img src="<?php echo stripslashes($list['banner']); ?>" />
	</div>
	<div class="name"><?php echo stripslashes($list['name']); ?></div> 
	</a>
	</div>
	
	
	
	<?php    }	?>
	
</div>



<?php
include "footerinc.php";
?>

</body>
</html>
