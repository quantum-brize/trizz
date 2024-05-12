<?php  
include "config/database.php"; 
include "config/function.php"; 
include "config/setting.php";  
?>

<style>
body{padding:0px; margin:0px; font-family:Arial, Helvetica, sans-serif; font-size:12px;}
</style>
<div style="padding:20px; font-family:Arial, Helvetica, sans-serif; font-size:13px;">
<form action="" method="post" name="form-signup" id="formsignup"   > 
<table width="100%" border="0" cellpadding="5" cellspacing="0">
  <tr>
    <td colspan="2"><h2 style="margin-bottom:0px; padding-bottom:0px;">Inquiry Form</h2></td>
  </tr>
  <tr>
    <td colspan="2" style="font-size:11px; padding-bottom:10px;">Fill up the below form and one of our experts will contact you shortly</td>
    </tr>
  <tr>
    <td> 
      <input type="text" name="textfield" style="padding:15px; border:2px solid #ddd; width:100%; box-sizing:border-box;font-family:Arial, Helvetica, sans-serif; font-size:13px;" placeholder="First Name">  </td>
    <td><input type="text" name="textfield" style="padding:15px; border:2px solid #ddd; width:100%; box-sizing:border-box;font-family:Arial, Helvetica, sans-serif; font-size:13px;" placeholder="Last Name"></td>
  </tr>
  <tr>
    <td><input type="email" name="textfield" style="padding:15px; border:2px solid #ddd; width:100%; box-sizing:border-box;font-family:Arial, Helvetica, sans-serif; font-size:13px;" placeholder="Email"></td>
    <td><input type="number" name="textfield" style="padding:15px; border:2px solid #ddd; width:100%; box-sizing:border-box;font-family:Arial, Helvetica, sans-serif; font-size:13px;" placeholder="Phone"></td>
  </tr>
  <tr>
    <td><input type="number" name="textfield" style="padding:15px; border:2px solid #ddd; width:100%; box-sizing:border-box;font-family:Arial, Helvetica, sans-serif; font-size:13px;" placeholder="Total Pax"></td>
    <td><input type="text" name="textfield" style="padding:15px; border:2px solid #ddd; width:100%; box-sizing:border-box;font-family:Arial, Helvetica, sans-serif; font-size:13px;" placeholder="Destination"></td>
  </tr>
  <tr>
    <td colspan="2"><select name="serviceId" id="serviceId" style="padding:15px; border:2px solid #ddd; width:100%; box-sizing:border-box;font-family:Arial, Helvetica, sans-serif; font-size:13px;" required="required">
							 <?php  
$rs=GetPageRecord('*','queryServicesMaster',' 1 order by name asc');
while($rest=mysqli_fetch_array($rs)){ 
?> 
<option value="<?php echo $rest['id']; ?>" <?php if($rest['id']==$editresult['serviceId']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>  
 <?php } ?>
							</select></td>
    </tr>
  <tr>
    <td colspan="2"><textarea name="textfield" rows="5" style="padding:15px; border:2px solid #ddd; width:100%; box-sizing:border-box;font-family:Arial, Helvetica, sans-serif; font-size:13px;" placeholder="Message"></textarea></td>
    </tr>
  <tr>
    <td colspan="2" align="right"><input type="submit" name="Submit" value="Send" style="background-color: #EC4447; color: #fff; padding: 10px 60px; border-radius: 6px; border: 0px; font-weight: 600;"></td>
  </tr>
</table>
</form>

</div>