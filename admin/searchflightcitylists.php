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

<div class="list" style="position:relative;padding-right: 32px;" onclick="<?php if($_REQUEST['searchcitylists']=='searchcitylistsfromCity'){ ?>$('#pickupCitySearchfromCity2').focus();<?php } else { ?>$('#dt1').focus();<?php } ?>$('#<?php echo $_REQUEST['cityresultfield']; ?>').val('<?php echo strip($resListing['airportCode']); ?>-<?php echo strip($resListing['country']); ?>');$('#<?php echo $_REQUEST['citysearchfield']; ?>').val('<?php echo strip($resListing['airportCode']); ?> - <?php echo strip($resListing['city']); ?>');$('.searchdestinationboxclass').hide();"><?php echo strip($resListing['airportCode']); ?> - <?php echo strip($resListing['city']); ?>, <?php echo strip($resListing['country']); ?><div style="font-size:11px; color:#666666;"><?php echo strip($resListing['airportDescription']); ?></div></div>

<?php }  }

if($no!=1){ 
 
$rs=GetPageRecord('*','flightDestinationMaster',' city="New Delhi" or city="Mumbai" or city="Kolkata" or city="Goa" or city="Jammu"  or city="Lucknow" or city="CHENNAI" or city="Srinagar" or city="Chandigarh" group by airportCode order by airportCode asc limit 0,10'); 
  
while($resListing=mysqli_fetch_array($rs)){ 
  
?>



<div class="list" style="position:relative;padding-right: 32px;" onclick="<?php if($_REQUEST['searchcitylists']=='searchcitylistsfromCity'){ ?>$('#pickupCitySearchfromCity2').focus();$('#pickupCitySearchfromCity2').select();<?php } else { ?>$('#dt1').focus();<?php } ?><?php if($_REQUEST['searchcitylists']=='searchcitylistsfromCity2'){ ?>callhide();<?php  } ?>$('.searchdestinationboxclass').hide();$('#<?php echo $_REQUEST['cityresultfield']; ?>').val('<?php echo strip($resListing['airportCode']); ?>-<?php echo strip($resListing['country']); ?>');$('#<?php echo $_REQUEST['citysearchfield']; ?>').val('<?php echo strip($resListing['airportCode']); ?> - <?php echo strip($resListing['city']); ?>');$('.searchdestinationboxclass').hide();"><?php echo strip($resListing['airportCode']); ?> - <?php echo strip($resListing['city']); ?>, <?php echo strip($resListing['country']); ?><div style="font-size:11px; color:#666666;"><?php echo strip($resListing['airportDescription']); ?></div></div>

<?php } ?>
 

 <?php } ?>
 
  </div>