<?php
include "inc.php";  

  $url = $basesiteurl."hotellist_mobile.php"; 
 $ch = curl_init($url);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);

		$data = array(
		'MemberId' => $_SESSION['userId'],
		'searcharray' =>  json_encode($_REQUEST)
); 

curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
$contents = curl_exec($ch);
$contentres=json_decode($contents,true); 
curl_close($ch); 

 
 
 $totalhotel=0; foreach($contentres['Hotels'] as $list) { 
$h=1;
?> 
<div class="card hotelcards"><a  onclick="openWindow('<?php echo $fullurl.'hoteldetails.php?id='.$list['hotelId'].'&empcount='.$list['empcount'].'&adult='.$list['ad'].'&child='.$list['cd'].'&checkInDate='.$list['checkInDate'].'&checkOutDate='.$list['checkOutDate'].''; ?>');"><div class="cardimg2"><img src="<?php echo $list['hotelBanner']; ?>" id="img<?php echo $totalhotel; ?>" class="card-img-top"></div><div class="card-body"><div class="flexcontent"><div><p><?php   $i=1;while($i<=$list['hotelCategory']) { ?><i class="fa fa-star" aria-hidden="true"></i><?php $i++; } ?></p><h6 class="namewidth"><?php echo $list['hotelName']; ?></h6></div><div class="startprice"><p><?php echo $list['hoteType']; ?></p><h6 style="text-align: right;">&#8377;<?php echo $list['hotelPrice']; ?></h6></div></div><div class="locationdiv"><i class="fa fa-map-marker" aria-hidden="true"></i><p> <?php echo $list['hotelAddress']; ?></p></div></div></a></div>
<?php  $totalhotel++; } ?>
<script>
$('#totalhotel').text('(<?php echo $totalhotel; ?>)');
</script>

<?php if($h!=1){ ?>
<div style="text-align:center; padding:50px 0px; font-size:15px; font-weight:600;">No Hotel Found</div>
<?php } ?>
 
 