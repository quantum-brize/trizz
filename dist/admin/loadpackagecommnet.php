<?php 
include "inc.php";
?>


<?php
if($_REQUEST['id']!=''){
$ns=1;
$rs=GetPageRecord('*','packageComment',' packageId="'.$_REQUEST['id'].'" order by addDate asc'); 
while($restcomment=mysqli_fetch_array($rs)){ 
?>
<div style="padding:15px; background-color:#FEFFE8; border: 1px solid #ffdc9e; font-size:14px;border-radius: 5px; margin-bottom:10px;">
<?php echo stripslashes($restcomment['comment']); ?>
<div style="margin-top:4px; color:#666666; font-size:12px;"><?php echo date('j F, Y - h:i A',strtotime($restcomment['addDate'])); ?></div>
</div>
<?php $ns++; } ?>
<?php if($ns==1){ ?>
<div style="text-align:center; padding:20px 0px;">No Comment Available</div>
<?php } ?>

<form class="custom-validation" action="<?php echo $fullurl; ?>frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3"> 
      <textarea name="comment" id="comment" style="border: 2px solid #ddd; padding: 10px; font-size: 14px; width: 100%; border-radius: 5px;" placeholder="Enter Your Comment"></textarea>
   </td>
    </tr>
  <tr>
    <td colspan="3" style="padding-top:10px;"><button type="submit" id="page2" class="btn btn-secondary btn-sm waves-effect" style="float:right; font-size:12px;" >Submit Comment</button></td>
  </tr>
</table>
<input name="action" type="hidden" value="loadpackagecommnet" />
<input name="pid" type="hidden" value="<?php echo $_REQUEST['id']; ?>" />
</form>
<?php } ?>