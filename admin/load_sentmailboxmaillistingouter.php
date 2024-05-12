<?php
include "inc.php"; 
 
function getusermail($email){

$a=GetPageRecord('*','userMaster','email="'.$email.'"');
$client=mysqli_fetch_array($a);
if($client['id']!=''){

if($client['userType']=='4'){
return '<div class="identifyclient">CLT</div>';
}
if($client['userType']=='5'){
return '<div class="identifysupplier">SUP</div>';
}

} else {
 
$a=GetPageRecord('*','sys_userMaster','email="'.$email.'"');
$user=mysqli_fetch_array($a);

if($user['id']!=''){
return '<div class="identifyuser">USR</div>';
}

}


}


 
$a=GetPageRecord('*','queryMail','fromEmail="'.$LoginUserDetails['emailAccount'].'" order by id desc limit 0,250');
while($maillist=mysqli_fetch_array($a)){

$subject=$maillist['subject'];
$fromName=$maillist['toEmail'];
$mailDate=$maillist['dateAdded'];
$mailBody=$maillist['details'];
  ?>

	<input id="mailsubject<?php echo $maillist['id']; ?>" type="hidden" value="<?php echo addslashes(strip_tags($subject)); ?>" />
				<input id="mailemail<?php echo $maillist['id']; ?>" type="hidden" value="<?php echo  str_replace('>','',str_replace('<',' | ',str_replace('\"','',addslashes(trim($fromName))))); ?>" />
				
				<input id="mailemailonly<?php echo $maillist['id']; ?>" type="hidden" value="<?php $mailonly=str_replace('>','',str_replace('<',' | ',str_replace('\"','',addslashes(trim($onlymail[1]))))); if($mailonly!=''){ echo $showmail=$mailonly;} else { echo $showmail=str_replace('>','',str_replace('<',' | ',str_replace('\"','',addslashes(trim($fromName))))); } ?>" />
				
				<input id="maildate<?php echo $maillist['id']; ?>" type="hidden" value="<?php echo $finaldateto=date('d/m/Y - h:i A',strtotime($mailDate));  ?>" />
				 <textarea id="mailtextbody<?php echo $maillist['id']; ?>" style="display:none;" cols="" rows=""><?php echo  str_replace('','',str_replace('display: ;','display:none ;',str_replace('\"','',addslashes(($mailBody))))); ?></textarea>
				
	<div class="maillist" onclick="clicktoviewmail('<?php echo $maillist['id']; ?>');selectopen(this);">
	<div class="globalname" id="globalname<?php echo $maillist['id']; ?>"><?php echo substr(trim($fromName),0,1); ?></div>
	<div class="content">
	<div class="text" ><?php echo str_replace('\"','',addslashes(trim($fromName))); ?><span style="display:none;"><?php echo strtolower(trim($fromName)); ?> <?php echo strtolower(strip_tags($subject)); ?></span></div>
	<div class="text" ><?php echo addslashes(strip_tags($subject)); ?></div>
	<div class="textbody"><?php echo substr(addslashes(strip_tags($mailBody)),0,200); ?></div>
	
	<?php if(date('Y',strtotime($mailDate))==date('Y')){ ?>
	<div class="mailtime"><?php echo $finaldateto=date('j M - h:i A',strtotime($mailDate));  ?></div>
	<?php } else { ?>
	<div class="mailtime"><?php echo $finaldateto=date('d/m/Y - h:i A',strtotime($mailDate));  ?></div>
	<?php } ?>
	<?php echo getusermail($showmail); ?>
	</div>
	</div>

<?php } ?>



<script>
function clicktoviewmail(id){
var mailsubject = $('#mailsubject'+id).val();
var mailemail = $('#mailemail'+id).val();
var maildate = $('#maildate'+id).val();
var mailemailonly = $('#mailemailonly'+id).val();
var mailtextbody = $('#mailtextbody'+id).val();
var globalname = $('#globalname'+id).text();

$('.mailsubject').html(mailsubject);
$('.mailfrom .nameemail').html(mailemail);
$('.mailfrom .fromdate').html(maildate);
$('.mailbodybox').html(mailtextbody);
$('.mailbodyboxtrans').html(mailtextbody);
$('.globalnameicon').html(globalname);
$('#sendmailfiled').val(mailemailonly);
$('.mailoadingimgboxread').show();
$('#mailiddisplay').hide();
$('.sendmailbox').hide();
}


 $("#search-criteria").on("keyup", function() {

var g = $(this).val();
 
$(".mailboxmaillistingouter .maillist").each( function() {
var s = $(this).text();
if (s.indexOf(g)!=-1) {
$(this).show();
}
else {
$(this).hide();
}
});
});




</script>
	