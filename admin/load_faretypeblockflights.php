<?php 
include "inc.php"; 
include "config/logincheck.php"; 
$id=decode($_REQUEST['id']); 


if($_REQUEST['dltid']!=''){ 
deleteRecord('fareTypeblockFlightMaster','id="'.decode($_REQUEST['dltid']).'"'); 
deleteRecord('agent_fareTypeblockFlightMaster',' blockFlightId="'.$id.'"'); 
}
?>

<table class="table">
							<thead>
								<tr>
								  <th align="left">Fare Type</th>
									<th align="left">Sector </th>
									<th align="left">Includes</th>
									<th align="left"><div align="center">Delete</div></th>
								</tr>
							</thead>
							<tbody>
					 
<?php 
$n=1;  
$roomslist='';
$rs=GetPageRecord('*','fareTypeblockFlightMaster',' blockFlightId="'.$id.'" order by id desc');
while($rest=mysqli_fetch_array($rs)){ 

 
$ab=GetPageRecord('*','fareTypeMaster',' displayType="'.$rest['name'].'" and flightName="'.$_REQUEST['flightname'].'"  ');  
$faretypeinc=mysqli_fetch_array($ab); 
 
?>
<tr>
  <td align="left"><?php echo stripslashes($rest['name']); ?></td>
  <td align="left"><?php if($rest['sectorType']=='D'){ echo 'Domestic'; } else { echo 'International'; } ?></td>
  <td align="left"> 
  <?php
$string = preg_replace('/\.$/', '', $faretypeinc['fareTypeName']); $array = explode(',', $string); foreach($array as $value){
?>
<span class="badge badge-secondary"><?php echo $value; ?></span>
<?php } ?>  </td>
  <td align="left"><div align="center"> <a  style="cursor:pointer;"  onclick="if(confirm('Are you sure you want to delete this fare type?')) loadcrusecostdlt('<?php echo encode($rest['id']); ?>');">
									  <button type="button" class="btn btn-danger btn-sm"> <i class="fa fa-trash-o" aria-hidden="true"></i> </button>
								    </a>
									
									</div></td>
</tr> 

<?php $n++; } ?>
			
<?php
$roomslist='';
$a=GetPageRecord('*','fareTypeblockFlightMaster',' blockFlightId="'.$id.'" order by id desc');
while($roomlist=mysqli_fetch_array($a)){ $roomslist.='<div class="roomratelist">'.strip($roomlist['name']).'</div>'; }   ?> 			
						
<script>
$('#displayroomrate<?php echo $id; ?>').html('<?php echo $roomslist; ?>');
</script>						
							</tbody>
						</table>

<?php if($n==1){ ?>
<div style="font-size:14px; color:#999999; text-align:center; padding:20px 0px; width:100%;">Nothing Found</div>
<?php } ?>