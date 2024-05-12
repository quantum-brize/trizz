<?php
include "inc.php"; 
$selectpage=4;

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
<style>
body{background-color:#f0f7fe;} 

</style>

<div class="innerpageaccountheader">Offers</div> 
<div class="bodyouter" style="margin-top:50px;" >
 <?php foreach($contentres['Offers'] as $list){
 if(trim($list['name'])!='' && trim($list['offerType'])!='cabs'){
  ?>
<div class="bodybard" style="margin-bottom:10px;" onclick="openWindow('<?php echo $fullurl.'offerdetails.php?id='.$list['Id'].''; ?>');">
<div class="pading">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"><div class="listimg"><img src="<?php echo $list['banner']; ?>" /></div></td>
    <td width="95%" style="padding-left:10px;"><div style=" font-size:15px; font-weight:600; margin-bottom:4px;"><?php echo stripslashes($list['name']); ?></div>
	<div style="font-size:12px; color:#666666; margin-top:6px;"><?php echo substr(strip_tags(stripslashes($list['details'])),0,30); ?>...</div>
	
	<div class="linkviewmore">View More Details</div>
	
	</td>
  </tr>
</table>

</div>

</div>
 <?php } } ?>

 
</div>


<?php include "footermenu.php"; ?>


 