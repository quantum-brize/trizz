<?php 
include "inc.php";  

?>


<table class="table table-hover mb-0">

                                            <thead>
                                                <tr>
                                                  <th>Title</th>
                                                    <th><div align="center">Duration</div></th>
                                                    <th>Price</th>
                                                    <th width="15%">By</th>
                                                    <th width="1%"><div align="center"></div></th>
                                                </tr>
                                            </thead>
                                            <tbody>
<?php 

$string = $_REQUEST['id'];
$string = preg_replace('/\.$/', '', $string); //Remove dot at end if exists
$array = explode(',', $string); //split string into array seperated by ', '
foreach($array as $value) //loop over values
{
$rs=GetPageRecord('*','sys_packageBuilder',' id="'.$value.'"  order by id desc');
while($rest=mysqli_fetch_array($rs)){ 
 
?>

<tr>
  <td>
<a href="display.html?ga=itineraries&view=1&id=<?php echo encode($rest['id']); ?>" target="_blank">
<table border="0" cellpadding="0" cellspacing="0"  class="addbynewbadges">
  <tr>
   <?php if($rest['coverPhoto']!=''){ ?> <td colspan="2"  style="padding-right:10px !important;"><img src="<?php echo $fullurl; ?>package_image/<?php echo $rest['coverPhoto']; ?>" width="64" height="46" /></td>
   <?php } ?>
    <td><?php echo stripslashes($rest['name']); ?><?php echo stripslashes($rest['name']); if($rest['destinations']!=''){ ?>
<div style="color:#999999; font-size:10px; margin-top:2px;">ID: <?php echo encode($rest['id']); ?> -  <?php echo stripslashes($rest['destinations']); ?> &nbsp;|&nbsp; <?php echo stripslashes($rest['adult']); ?> Adult(s) - <?php echo stripslashes($rest['child']); ?> Child(s)</div><?php } ?></td>
  </tr>
</table>
 </a></td>
  <td><div align="center"><?php echo $rest['days']; ?> Days</div></td>
  <td>&#8377;<?php echo number_format($rest['grossPrice']+$rest['extraMarkup']); ?> </td>
<td width="15%"><?php echo addbynewbadges($rest['addedBy']); ?></td>
<td width="1%"><div align="center"><a class="dropdown-item neweditpan" onclick="removepack('<?php echo $rest['id']; ?>');"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div></td>
</tr>


<?php $totalno++; } } ?>

<script>
function removepack(id){
var removeval = id+',';

var selectedpackageslist = $('#selectedpackageslist').val();

selectedpackageslist = selectedpackageslist.replace(removeval,'');

$('#selectedpackageslist').val(selectedpackageslist);

load_packages_landingpage();
}
</script>

                                            </tbody>
                                        </table>
