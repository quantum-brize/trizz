<?php 
include "inc.php";  
$keyword=trim($_REQUEST['keyword']);

$abcd=GetPageRecord('*','sys_packageBuilder','id="'.decode($_REQUEST['pid']).'"'); 
$result=mysqli_fetch_array($abcd); 
 $queryid=$result['queryId'];

if($keyword!=''){



?> 
<table class="table table-hover mb-0"> 
<thead></thead><tbody> 
<?php 
$n=1;


$rs=GetPageRecord('*','userMaster',' userType=4 and email!="" and (firstName like "%'.$keyword.'%" or  email like "%'.$keyword.'%" or  mobile like "%'.$keyword.'%") order by firstName asc limit 0,5');
while($rest=mysqli_fetch_array($rs)){  

?>
<tr>
  <td width="2%"><div class="checkbox"><input type="checkbox" name="sendcheck[]" value="<?php echo encode($rest['id']); ?>" style="width: 19px; height: 22px;"></div></td>
<td><?php echo stripslashes($rest['firstName']); ?></td>
<td><?php echo stripslashes($rest['email']); ?></td>
<td><?php echo stripslashes($rest['mobile']); ?></td>
</tr>

<?php $n++; } ?>





</tbody>
</table>
<?php }   ?>







<?php if($keyword==''){ ?>

<table class="table table-hover mb-0"> 
<thead></thead><tbody> 
<?php 
$n=1;
if($queryid>0){  
$rs=GetPageRecord('*','userMaster',' userType=4 and id in (select clientId from queryMaster where id="'.$queryid.'") order by firstName asc limit 0,5');
?>
<script>
$('#clientkeywordsearch').attr('disabled','true');
$('#clientkeywordsearch').css('display','none');
$('#clientinfodata').text('Select client you would like to email this itinerary to.');
</script>
<?php
} else {
$rs=GetPageRecord('*','userMaster',' userType=4 and id in (select clientId from sys_ShareProposal where packageId="'.decode($_REQUEST['pid']).'") order by firstName asc limit 0,5');
}
while($rest=mysqli_fetch_array($rs)){
?>
<tr>
  <td width="2%"><div class="checkbox"><input type="checkbox" name="sendcheck[]" value="<?php echo encode($rest['id']); ?>" checked="checked" style="width: 19px; height: 22px;"></div></td>
<td><?php echo stripslashes($rest['firstName']); ?></td>
<td><?php echo stripslashes($rest['email']); ?></td>
<td><?php echo stripslashes($rest['mobile']); ?></td>
</tr>

<?php $n++; } ?>
 
</tbody>
</table>

<?php if($n==1){ ?>
<div style="text-align:center; font-size:12px; color:#666666;">No Client Found</div>
<?php } ?>

<?php } ?>


 