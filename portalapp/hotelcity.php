<?php
include "inc.php";
 
 
$url = $basesiteurl."hoteldestinationpage.php";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);

		$data = array(
		'Keyword' => $_REQUEST['keyword']
); 

curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
$contents = curl_exec($ch);
$contres=json_decode($contents,true); 
curl_close($ch);
 
?>
<div class="searchdestinationboxclass">
<?php
	$n=1;
	foreach($contres['HotelDestination'] as $list){  
	?>
<div class="list" onclick="$('#pickupCitySearchfromCity3').val('<?php echo stripslashes($list['destination']); ?>');$('#destinationHotel').val('<?php echo stripslashes($list['destinationValue']); ?>');$('#searchcitylistsfromCity').hide();"><?php echo stripslashes($list['destination']); ?></div>
<?php } ?>

</div>

 