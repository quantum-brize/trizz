<?php
include "clientinc.php"; 
$rs=GetPageRecord('*','sys_guests',' id="'.decode($_REQUEST['id']).'" order by id desc');
$rest=mysqli_fetch_array($rs); 
?>
<form class="" method="post" action="action.html" id="postdata" target="datapost" enctype="multipart/form-data">
 
<ul class="careerfy-row careerfy-employer-profile-form">
<li class="careerfy-column-2">
<label>Salutations</label>
<select name="submitName"  class="form-control">
<option value="Mr." <?php if($rest['submitName']=='Mr.'){ ?>selected="selected"<?php } ?>>Mr.</option>
<option value="Mrs." <?php if($rest['submitName']=='Mrs.'){ ?>selected="selected"<?php } ?>>Mrs.</option>
<option value="Ms." <?php if($rest['submitName']=='Ms.'){ ?>selected="selected"<?php } ?>>Ms.</option>
<option value="Dr." <?php if($rest['submitName']=='Dr.'){ ?>selected="selected"<?php } ?>>Dr.</option>
<option value="Prof." <?php if($rest['submitName']=='Prof.'){ ?>selected="selected"<?php } ?>>Prof.</option>
</select>
</li>
<li class="careerfy-column-5">
<label>First Name *</label>
<input value="<?php echo $rest['firstName']; ?>" type="text" name="firstName">
</li>
<li class="careerfy-column-5">
<label>Last Name *</label>
<input value="<?php echo $rest['lastName']; ?>" type="text" name="lastName">
</li>
 
<li class="careerfy-column-7">
<label>Date Of Birth</label>
<input type="date" class="form-control" required="" name="startDate" style="text-align:center;"  id="startDate" value="<?php if($rest['dob']!=''){ echo $rest['dob']; }else{ echo date('Y-m-d'); } ?>">

</li>
<li class="careerfy-column-5">
<label>Gender</label>
<select name="gender"  class="form-control">
  <option value="Male" <?php if($rest['gender']=='Male'){ ?>selected="selected"<?php } ?>>Male</option>
  <option value="Female" <?php if($rest['gender']=='Female'){ ?>selected="selected"<?php } ?>>Female</option>
  <option value="Other" <?php if($rest['gender']=='Other'){ ?>selected="selected"<?php } ?>>Other</option>
</select>
</li> 
 
</ul>
 <input type="hidden" name="qd" value="<?php echo $_REQUEST['qd']; ?>" /> 
 <input type="hidden" name="editId" value="<?php echo $_REQUEST['id']; ?>" /> 
 <input type="hidden" name="action" value="editguestdetails" /> 
<button type="submit" name="submit" class="bluebutton" style="float: right;padding: 10px; font-size:12px;"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
</form>


 
