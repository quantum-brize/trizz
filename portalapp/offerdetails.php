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
$contentres=json_decode($contents,true); 
curl_close($ch);
 
 
 
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
<title>Offer</title>
<?php
include "headerinc.php";



?>

<script>
function opendashboard(){
$('body').removeClass('loginbg');
$('body').load('dashboard.php');
}
</script>
 

</head>
<body>

<div class="innerpageaccountheader"><i class="fa fa-arrow-left" aria-hidden="true" onclick="closeWindow();"></i>Offer Details</div>
 
 
<?php foreach($contentres['Offers'] as $list){ 

if($list['Id']==$_REQUEST['id']){
?>
<div class="fullwhitesection" style="  font-size:15px; line-height:20px; padding-top:70px; ">
<?php if($list['banner']!=''){ ?>
<div class="bodybardbanner">
<img src="<?php echo $list['banner']; ?>" style="width:100%;" />
</div>
<?php } ?>
<h4><?php echo $list['name']; ?></h4>
  <?php echo stripslashes($list['details']); ?>  
</div>
<?php }  } ?>

<?php
include "footerinc.php";
?>

</body>
</html>
