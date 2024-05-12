<div class="header">
<div class="brand"><a href="../display.html?keyword=&ga=flyerdesigner" style="font-size: 15px; font-weight: 600; color: #000; padding: 10px 20px; display: block;"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back to projects home</a></div>
<?php if($editflyer==1){ ?><div class="sub"><a href="../display.html?keyword=&ga=flyerdesigner" style="color:#c5ccd0;">Projects</a> &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i></div>
<div class="main"><span onkeyup="changeprojectname();" onblur="changeprojectname();" contenteditable="true" id="projectname"><?php echo stripslashes($res['name']); ?></span>&nbsp;&nbsp;<i class="fa fa-pencil" aria-hidden="true" onclick="$('#projectname').focus();"></i></div><?php } ?>


<div class="right">
<?php if($editflyer==1){ ?><div class="main" style="font-weight:400; color:#666666; display:none;">Saving...</div>
<div class="main"><a href="#" style="color:#04a184;" onclick="saveproject();"><i class="fa fa-floppy-o" aria-hidden="true" style="color:#04a184;"></i> &nbsp;Save Changes</a></div>
<div class="main"><a href="#" onclick="downloadimage();"><i class="fa fa-download" aria-hidden="true"></i> &nbsp;Download</a></div><?php } ?> 
</div>
</div>

<div id="actionload" style="display:none;"></div>
<iframe id="actoinfrm" name="actoinfrm" style="display:none;"></iframe>



<script>
function changeprojectname(){
var projectname = encodeURI($('#projectname').text()); 
$('#actionload').load('action.html?projectname='+projectname+'&action=changeprojectname&id=<?php echo encode($res['id']); ?>');
}
</script>