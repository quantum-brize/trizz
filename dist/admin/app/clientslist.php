<?php
include "appinc.php";

$keywordfield=''; 
if($_REQUEST['keywordfield']!=''){
$keywordfield='  and (  firstName like "%'.$_REQUEST['keywordfield'].'%" or lastName like "%'.$_REQUEST['keywordfield'].'%"  or mobile like "%'.$_REQUEST['keywordfield'].'%" or email like "%'.$_REQUEST['keywordfield'].'%" ) ';
}

if($_REQUEST['topage']==''){
$frompage=0;
$topage=25;
} else {
$frompage=trim($_REQUEST['frompage']);
$topage=trim($_REQUEST['topage']);
}



$mainwhere='';
if($LoginUserDetails['userType']!=0){  
$mainwhere=' and addedBy="'.$_SESSION['userid'].'" or (id in(select clientId from queryMaster where addedBy="'.$_SESSION['userid'].'" or assignTo="'.$_SESSION['userid'].'" )) '.$keywordfield.'  ';   
$mainwheretotal=' and addedBy="'.$_SESSION['userid'].'" or (id in(select clientId from queryMaster where addedBy="'.$_SESSION['userid'].'" or assignTo="'.$_SESSION['userid'].'" ))  '.$keywordfield.'  ';   
} else {
$mainwhere=' and 1 '.$keywordfield.' '; 
$mainwheretotal=' and 1 '.$keywordfield.' ';  

}



?>

<div class="listview">

<?php 
$n=1;  
//echo 'userType=4 '.$mainwhere.'';

$a=GetPageRecord('*','userMaster',' userType=4 '.$mainwhere.' order by id desc limit '.$frompage.', '.$topage.'');
while($rest=mysqli_fetch_array($a)){ 
?> 
<a href="#">
<div class="content leftimgicon">
<div class="userthumbleft" style="text-transform:uppercase;"><?php echo substr($rest['firstName'],0,1); ?></div>
<div class="qid"><?php echo stripslashes($rest['submitName']); ?> <?php echo stripslashes($rest['firstName']); ?> <?php echo stripslashes($rest['lastName']); ?></div>
<div class="dateq"><i class="fa fa-mobile" aria-hidden="true"></i> &nbsp;<?php  echo checkmobile(trim($rest['mobile'])); ?></div>
<div class="dateq"><i class="fa fa-envelope-o" aria-hidden="true"></i> &nbsp;<?php echo $rest['email']; ?></div> 
</div> 
</a>
<?php $n++; } ?>
 <?php if($n==1){ ?>
<div style="padding:40px 0px; text-align:center; font-size:12px; color:#666666;">No Client Found</div>

<?php } ?>

</div>



  <input name="scrolltopid" id="scrolltopid" type="hidden" value="" />
  
<?php if(countlisting(id,'userMaster','where  userType=4 '.$mainwhere.'  ')>$n){ ?>
<div style="padding:30px 0px; text-align:center; color:#999999; font-size:12px;" onclick="loadpaging();" id="loadmorebtn">Load More</div>
 <?php }?>




<script>
$('#titleheading').html('Clients (<?php echo countlisting('id','userMaster','where  userType=4 '.$mainwhere.'  '); ?>)');
</script>




<script>
function loadpaging(){ 
var keywordfield = encodeURI($('#keywordfield').val());
var scrolltopid = $('#scrolltopid').val();
var querystatus = encodeURI('<?php echo $_REQUEST['querystatus']; ?>'); 
var statusname = encodeURI('<?php echo $_REQUEST['statusname']; ?>'); 
openpage('clientslist.php?querystatus='+querystatus+'&statusname='+statusname+'&frompage=<?php echo $frompage; ?>&topage=<?php echo ($topage+25); ?>&scrolltopid='+scrolltopid+'&keywordfield='+keywordfield,'Clients (<?php echo countlisting('id','userMaster','where  userType=4 '.$mainwhere.'  '); ?>');
}
 
 
function searchlist(){
var title = $('#titleheading').html();
var keywordfield = encodeURI($('#keywordfield').val());
$('#bodyarea').html('<div class="demo"></div>');
$('#bodyarea').load('clientslist.php?keywordfield='+keywordfield);
$('#titleheading').html(title);
}



$(window).scroll( function() { 
 var scrolled_val = $(document).scrollTop().valueOf(); 
 $('#scrolltopid').val(scrolled_val);
});
  
$('html').scrollTop(<?php echo $_REQUEST['scrolltopid']; ?>);
</script>