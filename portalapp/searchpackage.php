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

foreach($contentres['Destination'] as $list){ 

if($_REQUEST['destination']==$list['id']){
$destinationname=$list['name'];
$banner=$list['banner'];
}

}
 

?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
<title>Search Holidays</title>
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

<div class="innerpageaccountheader" style="width:100% !important;"><a href="<?php echo $fullurl; ?>holidayspage.php" style="color:#FFFFFF !important;"><i class="fa fa-arrow-left" aria-hidden="true" ></i></a>Holidays</div>
<div style="padding-top:30px; margin-bottom:0px; height:150px; position:relative; overflow:hidden;"><img src="<?php echo $banner; ?>" style="width:100%; min-height:100%; height:auto;" /><div style="position:absolute; left:0px; top:0px; height:100%; width:100%; box-sizing:border-box; background-color:#0000005c; color:#FFFFFF; font-weight:600; font-size:26px; padding-left:30px;"><div style="margin-top:100px; padding-left:20px;"></div><?php echo $destinationname; ?></div></div>
<div class="bodyouter">
<div style="padding:10px; border:1px solid #ddd; margin-bottom:20px; border-radius: 10px;">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" style="font-size:16px; font-weight:600;"><?php echo $destinationname; ?><div style="font-size:12px; margin-top:4px;"><?php echo date('j, F Y',strtotime($_REQUEST['fromdate'])); ?></div></td>
    <td width="30%" align="right"><a href="<?php echo $fullurl; ?>holidayspage.php" style="font-weight: 600; font-size: 14px; padding: 4px 10px; text-align: center; display: inline; border: 1px solid #ddd; background-color: var(--base-color) !important; color: #fff !important; border-radius: 5px; margin-right: 5px; display:none;"><i class="fa fa-filter" aria-hidden="true"></i> Filter</a></td>
    <td width="5%" align="right"><a href="<?php echo $fullurl; ?>holidayspage.php" style=" color:#0066CC; font-weight:600; font-size:14px; display:block; padding:4px 10px; text-align:center;">Edit</a></td>
  </tr>
</table>

</div>
	<div class="container">
<?php
$n=1;
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
$packagedatares=json_decode($contents,true); 
curl_close($ch); 
foreach($packagedatares['Package'] as $list){

if($list['destination']==$destinationname){
?>
			<div class="card hotelcards" style="position:relative;" onclick="openWindow('<?php echo $fullurl.'packagedetails.php?id='.$list['packageId'].'&fromdate='.$_REQUEST['fromdate'].''; ?>');"> 
				<div class="cardimg2"><img src="<?php echo stripslashes($list['banner']); ?>" class="card-img-top" ></div>
				<div class="card-body">
					<div class="flexcontent">
                        <div> 
						 <h6  style="padding-right:30px;"><?php echo stripslashes($list['name']); ?></h6>
					    </div>
					    <div class="startprice"> 
                             <h6 style="text-align: right;">₹<?php echo stripslashes($list['price']); ?></h6>
						</div>
					</div><!-- flexcontent  -->

                    <div class="locationdiv"> 
						<p><?php echo stripslashes($list['nights']); ?> Nights / <?php echo stripslashes($list['days']); ?>Days <span style="background-color: #00000087; color: #fff; padding: 2px 10px 3px; border-radius: 10px; margin-left: 10px; display: inline-block;"><?php echo stripslashes($list['theme']); ?></span></p>
					</div>

					 
				</div><!-- card-body  --> 
			</div>
			
			<?php $n++; } } ?>
			<?php if($n==1){?>
			<div style="text-align:center; font-size:14px;">No Package Found</div>
			<?php  } ?>
</div>
</div>

 
<?php
include "footerinc.php";
?>

</body>
</html>
