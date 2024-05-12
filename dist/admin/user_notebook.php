<?php
include "inc.php"; 

if($_REQUEST['addnote']==1){

$namevalue ='dateAdded="'.date('Y-m-d H:i:s').'",addedBy="'.$_SESSION['userid'].'"';  
addlistinggetlastid('notebookMaster',$namevalue);  
}

if($_REQUEST['deletenote']==1 && $_REQUEST['id']!=''){
deleteRecord('notebookMaster','id="'.decode($_REQUEST['id']).'" and addedBy="'.($_SESSION['userid']).'"');  
}
?>
<div class="addnotebookouter">
<a class="notebookadd" title="Add New Note" onclick="addnotebook();"><i class="fa fa-plus-square" aria-hidden="true"></i></a>
</div>
<div class="usernotesouter">
<?php
$n=1;
$a=GetPageRecord('*','notebookMaster',' addedBy="'.$_SESSION['userid'].'" order by id desc'); 
while($rest=mysqli_fetch_array($a)){
$n++;
?>
<div class="usernotes">
 <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" id="addnoteform<?php echo stripslashes($rest['id']); ?>" enctype="multipart/form-data">	 
    <textarea name="notedescription" class="noteareawrite" onclick="$(this).css('min-height','180px');$(this).css('overflow','auto');" onblur="onblurnotes<?php echo stripslashes($rest['id']); ?>(this);" id="notedescription<?php echo stripslashes($rest['id']); ?>" placeholder="Write here something..."><?php echo stripslashes($rest['details']); ?></textarea>
	<input name="action" type="hidden" value="addnotebook" />
	<input name="id" type="hidden" value="<?php echo encode($rest['id']); ?>" />
	<div class="toolbarfoo">
	<a title="Delete" onclick="deletenotebook<?php echo stripslashes($rest['id']); ?>('<?php echo encode($rest['id']); ?>');"><i class="fa fa-trash" aria-hidden="true"></i></a>
	</div>
	</form>
 
</div>

<script>
function onblurnotes<?php echo stripslashes($rest['id']); ?>(obj){
$(obj).css('min-height','50px');
$(obj).css('overflow','hidden'); 
$('#addnoteform<?php echo stripslashes($rest['id']); ?>').submit();
}


function deletenotebook<?php echo stripslashes($rest['id']); ?>(id){
if(confirm('Are you sure your want to delete?')){
 $('.popcontentbodybox').load('user_notebook.php?deletenote=1&id='+id);
} 
}
</script>


<?php } ?>


<?php if($n==1){ ?>

<div style="text-align:center; font-size:20px; color:#999999; font-family:'Times New Roman', Times, serif; padding: 60px;"><em>From small beginnings come great things.</em></div>
<?php } ?>


</div>


<script>
function addnotebook(){
$('.popcontentbodybox').load('user_notebook.php?addnote=1');
}
</script>