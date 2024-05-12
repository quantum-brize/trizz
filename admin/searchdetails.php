<?php include "inc.php"; 

if($_REQUEST['type']!='' && $_REQUEST['id']!=''){

?>

<?php if($_REQUEST['type']=='query'){

$rs=GetPageRecord('*','queryMaster','  id="'.decode($_REQUEST['id']).'" order by id desc'); 
$rest=mysqli_fetch_array($rs);

$b=GetPageRecord('*','userMaster','id="'.$rest['clientId'].'"'); 
$clientData=mysqli_fetch_array($b);
 ?>

<div class="userdatasearch">

<a href="display.html?ga=query&view=1&id=<?php echo encode($rest['id']); ?>" target="_blank"><i class="fa fa-external-link-square" aria-hidden="true" style="font-size:20px; right:40px; top:10px;position: absolute; cursor:pointer;"></i></a>

<i class="fa fa-times" aria-hidden="true" style="font-size:20px; right:10px; top:10px;position: absolute; cursor:pointer; cursor:pointer;" onClick="$('.searchdetails').hide();$('.listearchlist a').removeClass('active');"></i>

<div style="margin-bottom:2px; font-size:12px; font-weight:600"><a href="display.html?ga=query&view=1&id=<?php echo encode($rest['id']); ?>" target="_blank">ID: <?php echo encode($rest['id']); ?></a></div> 
<div style="margin-bottom:2px; font-size:13px; "><i class="fa fa-user" aria-hidden="true"></i> &nbsp;<?php $rsb=GetPageRecord('*','sys_userMaster',' id="'.$rest['assignTo'].'"');while($restsource=mysqli_fetch_array($rsb)){  echo stripslashes($restsource['firstName'].' '.$restsource['lastName']); }?></div>
<div style="margin-bottom:2px; margin-top:5px; font-size:13px;"><?php echo getstatus($rest['statusId']); ?></div>

<hr>

<div style="margin-bottom:2px; font-size:13px;"><strong>Travel Date:</strong> 
  <?php if(date('d-m-Y',strtotime($rest['startDate']))!='01-01-1970'){ echo date('d-m-Y',strtotime($rest['startDate'])); } ?> - <?php if(date('d-m-Y',strtotime($rest['endDate']))!='01-01-1970'){ echo date('d-m-Y',strtotime($rest['endDate'])); } ?></div> 
<div style="margin-bottom:2px; font-size:13px;"><strong>Destination:</strong> <?php echo getCityName($rest['destinationId']); ?></div> 
  
<div style="margin-bottom:2px; font-size:13px;"><strong>Adult(s):</strong> <?php echo $rest['adult']; ?>&nbsp;-&nbsp;<strong>child(s):</strong> <?php echo $rest['child']; ?>&nbsp;-&nbsp;<strong>infant(s):</strong> <?php echo $rest['infant']; ?></div> 
</div> 


<div style="border-bottom:1px solid #ddd; font-weight:700; padding:10px;">Client Information</div>

<div style="padding:15px;">

<div style="margin-bottom:2px; font-size:13px;"><strong>Name:</strong> <?php echo stripslashes($clientData['submitName']); ?> <?php echo stripslashes($clientData['firstName']); ?> <?php echo stripslashes($clientData['lastName']); ?></div>  

<div style="margin-bottom:2px; font-size:13px;"><strong>Email:</strong> <?php echo stripslashes($clientData['email']); ?></div>
<div style="margin-bottom:2px; font-size:13px;"><strong>Mobile:</strong> <?php echo stripslashes($clientData['mobileCode']); ?><?php echo stripslashes($clientData['mobile']); ?></div>
<div style="margin-bottom:2px; font-size:13px;"><strong>Location:</strong>  <?php echo getCityName($clientData['city']);  ?>, <?php echo getStateName($clientData['state']);  ?>, <?php echo getCountryName($clientData['country']);  ?></div>



</div>
<?php  } ?>




<?php if($_REQUEST['type']=='Itineraries'){

$rs=GetPageRecord('*','sys_packageBuilder','  id="'.decode($_REQUEST['id']).'" order by id desc'); 
$rest=mysqli_fetch_array($rs); 
 ?>

<div class="userdatasearch">

<a href="display.html?ga=itineraries&view=1&id=<?php echo encode($rest['id']); ?>" target="_blank"><i class="fa fa-external-link-square" aria-hidden="true" style="font-size:20px; right:40px; top:10px;position: absolute; cursor:pointer;"></i></a>

<i class="fa fa-times" aria-hidden="true" style="font-size:20px; right:10px; top:10px;position: absolute; cursor:pointer; cursor:pointer;" onClick="$('.searchdetails').hide();$('.listearchlist a').removeClass('active');"></i>

<div style="margin-bottom:2px; font-size:12px; font-weight:600"><a href="display.html?ga=itineraries&view=1&id=<?php echo encode($rest['id']); ?>" target="_blank">ID: <?php echo encode($rest['id']); ?></a></div> 
<div style="margin-bottom:2px; font-size:13px; "><?php echo stripslashes($rest['name']); ?></div> 

<hr>
<div style="margin-bottom:2px; font-size:13px;"><strong>Price:</strong> 
&#8377;<?php echo number_format($rest['grossPrice']+$rest['extraMarkup']); ?></div> 

<div style="margin-bottom:2px; font-size:13px;"><strong>Created Date:</strong> 
<?php echo displaydateinnumber($rest['dateAdded']); ?></div> 
<div style="margin-bottom:2px; font-size:13px;"><strong>Created By:</strong>   <?php echo getUserNameNew($rest['addedBy']); ?></div> 
  
  
</div> 


 

 
<?php  } ?>




<?php if($_REQUEST['type']=='Clients'){

$rs=GetPageRecord('*','userMaster','  id="'.decode($_REQUEST['id']).'" order by id desc'); 
$rest=mysqli_fetch_array($rs); 
 ?>

<div class="userdatasearch">

<a href="#" onclick="loadpop('Edit Client',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addclient&id=<?php echo encode($rest['id']); ?>"><i class="fa fa-external-link-square" aria-hidden="true" style="font-size:20px; right:40px; top:10px;position: absolute; cursor:pointer;"></i></a>

<i class="fa fa-times" aria-hidden="true" style="font-size:20px; right:10px; top:10px;position: absolute; cursor:pointer; cursor:pointer;" onClick="$('.searchdetails').hide();$('.listearchlist a').removeClass('active');"></i>

<div style="margin-bottom:2px; font-size:12px; font-weight:600"><a href="#" onclick="loadpop('Edit Client',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addclient&id=<?php echo encode($rest['id']); ?>">ID: <?php echo encode($rest['id']); ?></a></div> 
<div style="margin-bottom:2px; font-size:13px; "><?php echo stripslashes($rest['submitName']); ?> <?php echo stripslashes($rest['firstName']); ?> <?php echo stripslashes($rest['lastName']); ?> </div> 

<hr>
<div style="margin-bottom:2px; font-size:13px;"><strong>Email:</strong> 
<?php echo checkemail(stripslashes($rest['email'])); ?></div> 

<div style="margin-bottom:2px; font-size:13px;"><strong>Mobile:</strong> 
<?php if(checkmobile(trim($rest['mobile']))!='<span class="lightgraytext">Not Provided</span>'){  echo stripslashes($rest['mobileCode']); ?><?php } echo checkmobile(trim($rest['mobile'])); ?></div>

  
<div style="margin-bottom:2px; font-size:13px;"><strong>Created By:</strong>   <?php echo getUserNameNew($rest['addedBy']); ?></div> 
  
  
</div> 


 

 
<?php  } ?>



<?php } ?>


 