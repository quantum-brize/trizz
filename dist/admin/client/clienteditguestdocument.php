<?php
include "clientinc.php"; 
$rs=GetPageRecord('*','sys_guests',' id="'.decode($_REQUEST['id']).'" order by id desc');
$rest=mysqli_fetch_array($rs); 

 
$pac=GetPageRecord('*','sys_packageBuilder',' queryId="'.$rest['queryId'].'" and confirmQuote=1'); 
$restpack=mysqli_fetch_array($pac); 

$bx=GetPageRecord('*','sys_packageBuilderEvent',' packageId="'.$restpack['id'].'" and sectionType="Flight"'); 
  



?>
<form class="" method="post" action="action.html" id="postdata" target="datapost" enctype="multipart/form-data">


<ul class="careerfy-row careerfy-employer-profile-form" style="color: #000;">
<li class="careerfy-column-12">
<table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#666666">
  <tr>
    <td width="29%">PAN CARD</td>
    <td width="16%"><input type="file" class="form-control" name="panCard"  id="panCard" style="padding:10px;width: 220px;border: none;"></td>
    <td width="55%" align="center"><?php $n=0; $a=GetPageRecord('*','sys_guestsDucument','guestId="'.decode($_REQUEST['id']).'" and documentType="PanCard"');  
if(mysqli_num_rows($a)>0){ while($result=mysqli_fetch_array($a)){ ?>
      <div style=" position: relative; width:fit-content;"><i class="fa fa-times" aria-hidden="true" style="color: #fff; font-size: 12px; top: 4px; position: absolute; right: 6px;" onClick="deleteDoc('<?php echo encode($result['id']); ?>','<?php echo $_REQUEST['id']; ?>');"></i><a href="<?php echo $softwareurl; ?>profilepic/<?php echo $result['document']; ?>" class="btn btn-info btn-sm waves-effect waves-light" style="margin: 3px; padding: 8px 20px;" target="_blank"><?php //echo ++$n; ?> <i class="fa fa-download" aria-hidden="true"></i>&nbsp;Download</a></div><?php } }else{ echo 'No Files Selected'; } ?></td>
  </tr>
  <tr>
    <td>PASSPORT FRONT</td>
    <td><input type="file" class="form-control" name="passportFront"  id="passportFront" style="padding:10px;width: 220px;border: none;"></td>
    <td align="center"><?php $n=0; $a=GetPageRecord('*','sys_guestsDucument','guestId="'.decode($_REQUEST['id']).'" and documentType="PassportFront"');  
if(mysqli_num_rows($a)>0){ while($result=mysqli_fetch_array($a)){ ?>
      <div style=" position: relative; width:fit-content;"><i class="fa fa-times" aria-hidden="true" style="color: #fff; font-size: 12px; top: 4px; position: absolute; right: 6px;" onClick="deleteDoc('<?php echo encode($result['id']); ?>','<?php echo $_REQUEST['id']; ?>');"></i><a href="<?php echo $softwareurl; ?>profilepic/<?php echo $result['document']; ?>" class="btn btn-info btn-sm waves-effect waves-light" style="margin: 3px; padding: 8px 20px;" target="_blank"><?php //echo ++$n; ?> <i class="fa fa-download" aria-hidden="true"></i>&nbsp;Download Front</a></div><?php } }else{ echo 'No Files Selected'; } ?></td>
  </tr>
  <tr>
    <td>PASSPORT BACK</td>
    <td><input type="file" class="form-control" name="passportBack"  id="passportBack" style="padding:10px;width: 220px;border: none;"></td>
    <td align="center"><?php $n=0; $a=GetPageRecord('*','sys_guestsDucument','guestId="'.decode($_REQUEST['id']).'" and documentType="PassportBack"');  
	if(mysqli_num_rows($a)>0){
while($result=mysqli_fetch_array($a)){ ?>
      <div style=" position: relative; width:fit-content;"><i class="fa fa-times" aria-hidden="true" style="color: #fff; font-size: 12px; top: 4px; position: absolute; right: 6px;" onClick="deleteDoc('<?php echo encode($result['id']); ?>','<?php echo $_REQUEST['id']; ?>');"></i><a href="<?php echo $softwareurl; ?>profilepic/<?php echo $result['document']; ?>" class="btn btn-info btn-sm waves-effect waves-light" style="margin: 3px; padding: 8px 20px;" target="_blank"><?php //echo ++$n; ?> <i class="fa fa-download" aria-hidden="true"></i>&nbsp;Download Back</a></div><?php } }else{ echo 'No Files Selected'; } ?></td>
  </tr>
  <?php if(mysqli_num_rows($bx)<1){ ?>
  <tr>
    <td>FLIGHT</td>
    <td><input type="file" class="form-control" name="flight[]" multiple id="flight" style="padding:10px;width: 220px;border: none;"></td>
    <td align="center"><?php $n=0; $a=GetPageRecord('*','sys_guestsDucument','guestId="'.decode($_REQUEST['id']).'" and documentType="Flight"');  
if(mysqli_num_rows($a)>0){ while($result=mysqli_fetch_array($a)){ ?>
      <div style=" position: relative; width:fit-content; float: left;"><i class="fa fa-times" aria-hidden="true" style="color: #fff; font-size: 12px; top: 4px; position: absolute; right: 6px;" onClick="deleteDoc('<?php echo encode($result['id']); ?>','<?php echo $_REQUEST['id']; ?>');"></i><a href="<?php echo $softwareurl; ?>profilepic/<?php echo $result['document']; ?>" class="btn btn-info btn-sm waves-effect waves-light" style="margin: 3px; padding: 8px 20px;" target="_blank"><?php //echo ++$n; ?> <i class="fa fa-download" aria-hidden="true"></i>&nbsp;Download <?php echo ++$n; ?></a></div><?php } }else{ echo 'No Files Selected'; } ?></td>
  </tr>
  <?php } ?>
</table> 
</li> 
</ul> 
 <input type="hidden" name="qd" value="<?php echo $_REQUEST['qd']; ?>" /> 
 <input type="hidden" name="editId" value="<?php echo $_REQUEST['id']; ?>" /> 
 <input type="hidden" name="action" value="editguestdocuments" /> 
<button type="submit" name="submit" class="bluebutton" style="float: right;padding: 8px; font-size:12px;"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
</form>


 
