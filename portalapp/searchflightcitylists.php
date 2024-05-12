<?php
include "inc.php";
 
 
$url = $basesiteurl."flightdestinationpage_mobile.php";
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
 
   
if(trim($_REQUEST['keyword'])!=''){
?>
 
<div class="searchdestinationboxclass">
<?php 
	foreach($contres['FlightDestination'] as $list){  
	
	$no=1;
	?>
 
<div class="list" style="position:relative;padding-right: 32px;"  onclick="$('#<?php echo $_REQUEST['cityresultfield']; ?>').val('<?php echo ($list['destinationValue']); ?>');$('#<?php echo $_REQUEST['citysearchfield']; ?>').val('<?php echo ($list['destinationcity']); ?>');$('#<?php echo $_REQUEST['searchcitylists']; ?>').hide();" ><?php echo $list['destination']; ?><div style="font-size:11px; color:#666666;"><?php echo ($list['airport']); ?></div><?php if($list['countryFlag']!=''){ ?><img src="<?php echo $list['countryFlag']; ?>" style="position: absolute; width: 22px; right: 10px; top: 14px;" /><?php } ?></div>
<?php } ?>

 </div>
 <?php }  else {?>
 <script>
 $('.searchdestinationboxclass').hide();
 </script>
 <?php } ?>