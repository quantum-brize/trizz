<?php 
include "inc.php";   


?>

 <script>
    function callhide(){
	 setTimeout(function(){
  $('.searchdestinationboxclass').hide();
  }, 120 );
	 }
 </script>

<div class="searchdestinationboxclass"> 
<?php 
if(trim(strip($_REQUEST['keyword']))!=''){  
 $no=0;
$rs=GetPageRecord('*','flightDestinationMaster',' city like "'.trim(strip($_REQUEST['keyword'])).'%" or airportCode like "%'.trim(strip($_REQUEST['keyword'])).'" group by airportCode order by airportCode asc limit 0,10');  
while($resListing=mysqli_fetch_array($rs)){  
 $no=1;  
?>

<div class="list" style="position:relative;padding-right: 32px;" onclick="<?php if($_REQUEST['searchcitylists']=='searchcitylistsfromCity'){ ?>$('#pickupCitySearchfromCity2').focus();$('.fromairport').text('<?php echo strip($resListing['airportDescription']); ?>');<?php } else { ?>$('.toairport').text('<?php echo strip($resListing['airportDescription']); ?>');$('#dt1').focus();<?php } ?>$('#<?php echo $_REQUEST['cityresultfield']; ?>').val('<?php echo strip($resListing['airportCode']); ?>-<?php echo strip($resListing['country']); ?>');$('#<?php echo $_REQUEST['citysearchfield']; ?>').val('<?php echo strip($resListing['airportCode']); ?> - <?php echo ucwords(strip($resListing['city'])); ?>');$('.searchdestinationboxclass').hide();"><?php echo strip($resListing['airportCode']); ?> - <?php echo ucwords(strip($resListing['city'])); ?>, <?php echo strip($resListing['country']); ?><div style="font-size:11px; color:#666666;"><?php echo strip($resListing['airportDescription']); ?></div><?php if(countrynametoflag($resListing['country'])!=''){ ?><img src="<?php echo countrynametoflag($resListing['country']); ?>" style="position: absolute; width: 22px; right: 10px; top: 14px;" /><?php } ?></div>

<?php }  }

if($no!=1){ 
 
$rs=GetPageRecord('*','flightDestinationMaster',' city="New Delhi" or city="Mumbai" or city="Kolkata" or city="Goa" or city="Jammu"  or city="Lucknow" or city="CHENNAI" or city="Srinagar" or city="Chandigarh" group by airportCode order by airportCode asc limit 0,10'); 
  
while($resListing=mysqli_fetch_array($rs)){ 
  
?>



<div class="list" style="position:relative;padding-right: 32px;" onclick="<?php if($_REQUEST['searchcitylists']=='searchcitylistsfromCity'){ ?>$('#pickupCitySearchfromCity2').focus();$('#pickupCitySearchfromCity2').select();$('.fromairport').text('<?php echo strip($resListing['airportDescription']); ?>');<?php } else { ?>$('#dt1').focus();$('.toairport').text('<?php echo strip($resListing['airportDescription']); ?>');<?php } ?><?php if($_REQUEST['searchcitylists']=='searchcitylistsfromCity2'){ ?>callhide();<?php  } ?>$('.searchdestinationboxclass').hide();$('#<?php echo $_REQUEST['cityresultfield']; ?>').val('<?php echo strip($resListing['airportCode']); ?>-<?php echo strip($resListing['country']); ?>');$('#<?php echo $_REQUEST['citysearchfield']; ?>').val('<?php echo strip($resListing['airportCode']); ?> - <?php echo ucwords(strip($resListing['city'])); ?>');$('.searchdestinationboxclass').hide();"><?php echo strip($resListing['airportCode']); ?> - <?php echo ucwords(strip($resListing['city'])); ?>, <?php echo strip($resListing['country']); ?><div style="font-size:11px; color:#666666;"><?php echo strip($resListing['airportDescription']); ?></div><?php if(countrynametoflag($resListing['country'])!=''){ ?><img src="<?php echo countrynametoflag($resListing['country']); ?>" style="position: absolute; width: 22px; right: 10px; top: 14px;" /><?php } ?></div>

<?php } ?>
 

 <?php } ?>
 
  </div>