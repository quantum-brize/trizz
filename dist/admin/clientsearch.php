<?php
include "inc.php";

$keyword=addslashes(trim($_REQUEST['keyword']));


if($keyword!=''){
?>
<style>
.selectclientab{border-bottom:1px #ccc solid; padding:10px; cursor:pointer;}
.selectclientab:hover{background-color:#333333; color:#fff;}
</style>
<script>
$('#searchname').show();
</script>

<div style="padding:0px; width:100%; box-sizing:border-box; border:1px solid #ccc; border-bottom:0px;">
<div style=" border-bottom:1px #ccc solid; padding:10px; background-color:#F4F4F4"><strong>Select Client</strong></div> 
<?php
$n=1;
$where=' userType=4  and (firstName like "%'.$keyword.'%" or lastName like "%'.$keyword.'%"  or email like "%'.$keyword.'%"  or mobile like "%'.$keyword.'%" or phone like "%'.$keyword.'%")';
$rs=GetPageRecord('*','userMaster',$where);
while($rest=mysqli_fetch_array($rs)){ 
?>
<div class="selectclientab" onClick="filltoallfieldauto('<?php echo stripslashes($rest['submitName']); ?>','<?php echo stripslashes($rest['firstName']); ?> <?php echo stripslashes($rest['lastName']); ?>','<?php echo stripslashes($rest['email']); ?>','<?php echo stripslashes($rest['mobile']); ?>','<?php echo encode($rest['id']); ?>','<?php echo $rest['country']; ?>','<?php echo $rest['state']; ?>','<?php echo $rest['city']; ?>','<?php echo getStateName($rest['state']); ?>','<?php echo getCityName($rest['city']); ?>','<?php echo getCountryName($rest['country']); ?>')"><?php echo stripslashes($rest['submitName']); ?> <?php echo stripslashes($rest['firstName']); ?> <?php echo stripslashes($rest['lastName']); ?></div> 
<?php $n++; } ?>

<?php if($n==1){ ?>
<div style="padding:10px; text-align:center; color:#666666; font-size:12px;">No Client Found</div>
<script>
$('.clientsearchdiv').hide();
$('#clientId').val('0');
</script>
<?php } ?>

</div>

<?php } else { ?>

<script>
$('.clientsearchdiv').hide();
</script>
<?php } ?>


<script>
function filltoallfieldauto(submitName,name,email,mobile,clientId,countryId,stateId,cityId,statename,cityname,countryname){ 
$('#submitName').val(submitName);							
$('#name').val(name);							
$('#email').val(email);							
$('#mobile').val(mobile);						
$('#clientId').val(clientId); 
$('#country').val(countryId);	 
$('#select2-country-container').html(countryname);	
$('#state').append('<option value="'+stateId+'" selected> '+statename+' </option>'); 
$('#city').append('<option value="'+cityId+'" selected> '+cityname+' </option>'); 


$('#searchname').hide();							
}
</script>
