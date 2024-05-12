<?php
include "inc.php";  

$countryId=$_REQUEST['id'];
$destinationName=trim($_REQUEST['destinationName']);

?> 
<?php
$select=''; 
$where=''; 
$rs='';  
$select='*';    

if($countryId!=''){
 $countryId=' and countryId="'.$countryId.'" ';
}
$whereobj='';
if($_REQUEST['eventobjectid']>0){
$whereobj=' and id="'.$_REQUEST['eventobjectid'].'" ';
}

$where=' status=1 and destination in (select id from cityMaster where name="'.$destinationName.'" and status=1) '.$whereobj.' order by name asc';  
$rs=GetPageRecord($select,'hotelMaster',$where); 
while($resListing=mysqli_fetch_array($rs)){  

?>
<option value="<?php echo strip($resListing['id']); ?>" <?php if($resListing['id']==$selectId){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['name']); ?></option>
<?php } ?>


<?php if($_REQUEST['eventobjectid']>0){ ?>
<script>
loadhoteldata();
</script>
 <?php } ?>
 