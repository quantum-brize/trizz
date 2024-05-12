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
 

$url = $basesiteurl."contentpage_mobile.php";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);

		$data = array(
		'PageId' => $_REQUEST['page']
); 

curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
$contents = curl_exec($ch);
$contentdata=json_decode($contents,true); 
curl_close($ch);
 
 
 
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
<title>Page</title>
<?php
include "headerinc.php";
?>
<style>
.de div{width:100% !important; margin-top:0px !important; padding-top:0px !important; }
</style>
<script>
function opendashboard(){
$('body').removeClass('loginbg');
$('body').load('dashboard.php');
}
</script>
 

</head>
<body>

<div class="innerpageaccountheader"><i class="fa fa-arrow-left" aria-hidden="true" onclick="closeWindow();"></i><?php echo stripslashes($contentdata['Page']['PageTitle']); ?></div>
 
 

<div class="fullwhitesection" style="  font-size:15px; line-height:20px; padding-top:70px; ">
<?php if($contentdata['Page']['image']!=''){ ?>
<div class="bodybardbanner">
<img src="<?php echo stripslashes($contentdata['Page']['image']); ?>" style="width:100%;" />
</div>
<?php } ?>
<div class="de">
  <?php echo str_replace('col-','',str_replace('!important','',stripslashes($contentdata['Page']['PageDescription']))); ?>  
  </div>
</div>


<?php
include "footerinc.php";
?>

</body>
</html>
