<?php
include "inc.php";
$searchpackagekeyword=addslashes($_REQUEST['searchpackagekeyword']);
$packalready=addslashes($_REQUEST['packalready']);

if($packalready!=''){
$wherenotin='and id not in ('.rtrim($packalready,',').') ';
}
 if($searchpackagekeyword!=''){ 
 
  
 $n=1; 
$rs=GetPageRecord('*','sys_packageBuilder',' ( name like "%'.$searchpackagekeyword.'%" or destinations like "%'.$searchpackagekeyword.'%" ) and status=1 and grossPrice>0  '.$wherenotin.'  order by name asc');
while($rest=mysqli_fetch_array($rs)){ 

if (strpos($packalready, $rest['id']) !== true) {
?> 
<div style="border:1px solid #ddd; padding:10px;" id="dispack<?php echo $rest['id']; ?>">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top"><div style="width:100px; height:75px; overflow:hidden; border:1px solid #ddd;"><img src="package_image/<?php echo $rest['coverPhoto']; ?>" width="100%" style=" min-height:100%;"></div></td>
    <td width="77%" align="left" valign="top" style="padding-left:10px;"><div style="font-size:16px; font-weight:600; margin-bottom:5px;"><?php echo stripslashes($rest['name']); ?></div>
	
 <div style="font-size:13px; font-weight:400; margin-bottom:5px;"><strong>Duration:</strong> <?php echo stripslashes($rest['days']-1); ?> Nights / <?php echo stripslashes($rest['days']); ?> Days | <strong><i class="fa fa-map-marker"></i> </strong> <?php echo stripslashes($rest['destinations']); ?></div>
 <div style="font-size:13px; font-weight:400; "><strong>Price:</strong> &#8377;<?php echo stripslashes($rest['grossPrice']); ?></div>	</td>
    <td width="13%" align="right" valign="middle" style="padding-left:10px;"><button type="button" class="btn btn-secondary" onClick="selectpackageonebyone('<?php echo $rest['id']; ?>,');$('#dispack<?php echo $rest['id']; ?>').slideUp();">Select</button></td>
  </tr>
</table>

</div>

<script>
function selectpackageonebyone(id){
var selectedpackageslist = $('#selectedpackageslist').val();

selectedpackageslist = selectedpackageslist+id;

$('#selectedpackageslist').val(selectedpackageslist);
load_packages_landingpage();
}
</script>

<?php $n++; } } }  ?>

<?php if($n==1){ ?>
<div style="padding:30px; text-align:center; color:#999999;">No Package Found</div>
<?php } ?>