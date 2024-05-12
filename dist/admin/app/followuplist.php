<?php
include "appinc.php";

$keywordfield='';
if($_REQUEST['keywordfield']!=''){
$keywordfield='  and (queryId="'.decode($_REQUEST['keywordfield']).'" or details like "%'.($_REQUEST['keywordfield']).'%" or queryId in (select id from queryMaster where name like "%'.$_REQUEST['keywordfield'].'%"   or phone like "%'.$_REQUEST['keywordfield'].'%" or email like "%'.$_REQUEST['keywordfield'].'%") ) ';
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
$mainwhere=' and (addedBy="'.$_SESSION['userid'].'" or  assignTo="'.$_SESSION['userid'].'") '.$keywordfield.' ';   
$mainwheretotal=' and (addedBy="'.$_SESSION['userid'].'" or  assignTo="'.$_SESSION['userid'].'") '.$keywordfield.'  ';   
} else {
$mainwhere=' and 1 '.$keywordfield.' '; 
$mainwheretotal=' and 1 '.$keywordfield.' ';  

}

if($_REQUEST['statusname']==''){
$_REQUEST['statusname']='All Follow Up - '.countlisting('id','queryTask','where 1 '.$mainwheretotal.'  ').'';
}


if($_REQUEST['querystatus']!=""){
$mainwhere.=' and taskType="'.$_REQUEST['querystatus'].'"  ';
} 




?>

<style>
#addbuttontop{display:none;}
</style>
 <div class="sectionallsearch"   onClick="filteropenclose();"><span><?php echo $_REQUEST['statusname']; ?></span> <i class="fa fa-caret-down" id="mainarrow" aria-hidden="true"></i>

<div id="filterbox" style="display:none;">
<a  onclick="changestatus('','All Follow Up - <?php echo countlisting('id','queryTask','where 1 '.$mainwheretotal.'  '); ?>');" <?php if($_REQUEST['querystatus']==''){ ?>class="active"<?php } ?>>All Follow Up - <?php echo countlisting('id','queryTask','where 1 '.$mainwheretotal.'  '); ?>  <?php if($_REQUEST['querystatus']==''){ ?><i class="fa fa-check" aria-hidden="true"></i><?php } ?></a>
<a onclick="changestatus('Task','Task - <?php echo countlisting('id','queryTask','where 1 and taskType="Task" '.$mainwheretotal.'  '); ?>');"  <?php if($_REQUEST['querystatus']=='Task'){ ?>class="active"<?php } ?>>Tasks - <?php echo countlisting('id','queryTask','where 1 and taskType="Task" '.$mainwheretotal.'  '); ?> <?php if($_REQUEST['querystatus']=='Task'){ ?><i class="fa fa-check" aria-hidden="true"></i><?php } ?></a>
<a onclick="changestatus('Call','Call - <?php echo countlisting('id','queryTask','where 1 and taskType="Call" '.$mainwheretotal.'  '); ?>');"   <?php if($_REQUEST['querystatus']=='Call'){ ?>class="active"<?php } ?>>Calls - <?php echo countlisting('id','queryTask','where 1 and taskType="Call" '.$mainwheretotal.'  '); ?> <?php if($_REQUEST['querystatus']=='Call'){ ?><i class="fa fa-check" aria-hidden="true"></i><?php } ?></a>
<a onclick="changestatus('Meeting','Meeting - <?php echo countlisting('id','queryTask','where 1 and taskType="Meeting" '.$mainwheretotal.'  '); ?>');" <?php if($_REQUEST['querystatus']=='Meeting'){ ?>class="active"<?php } ?>>Mettings - <?php echo countlisting('id','queryTask','where 1  and taskType="Meeting" '.$mainwheretotal.'  '); ?> <?php if($_REQUEST['querystatus']=='Meeting'){ ?><i class="fa fa-check" aria-hidden="true"></i><?php } ?></a> 

</div>
</div>

<div class="listview">

<?php 
$n=1;  
$a=GetPageRecord('*','queryTask',' 1 '.$mainwhere.' order by id desc limit '.$frompage.', '.$topage.'');
while($rest=mysqli_fetch_array($a)){ 

$b=GetPageRecord('*','queryMaster','id="'.$rest['queryId'].'"'); 
$queryData=mysqli_fetch_array($b);
?>
<a>
<div class="content leftimgicon followupcheckbox">
<div class="userthumbleft"><?php if($rest['makeDone']==1){ ?><i class="fa fa-check-square" aria-hidden="true"></i><?php } else {  ?> <i class="fa fa-square-o" aria-hidden="true"></i><?php } ?></div>
<div class="qid"><?php if($rest['makeDone']!=1 && date('Y-m-d',strtotime($rest['reminderDate']))<date('Y-m-d')){ ?><i class="fa fa-clock-o" aria-hidden="true"></i> <?php } ?><?php echo (stripslashes($rest['details'])); ?></div>
<div class="dateq">

<?php if($rest['makeDone']!=1 && date('Y-m-d',strtotime($rest['reminderDate']))>=date('Y-m-d')){ ?>Scheduled<?php } ?>
<?php if($rest['makeDone']!=1 && date('Y-m-d',strtotime($rest['reminderDate']))<date('Y-m-d')){ ?>Pending<?php } ?>
<?php if($rest['makeDone']==1){ ?>Done<?php } ?>
	
	
	 &nbsp;<i class="fa fa-dot-circle-o" aria-hidden="true"></i>&nbsp; <?php echo date('d/m/Y-h:i A',strtotime($rest['reminderDate'])); ?></div>
<div class="dateq"> <?php
												$string = '';
										$string = preg_replace('/\.$/', '', $queryData['destinationId']);  
										$array = explode(',', $string); 
										foreach($array as $value)  
										{ ?>
										 <?php echo  getCityName($value); ?> 
							  <?php }?> - <?php  echo encode($rest['queryId']); ?></div> 

<div class="rightbox"><?php if($rest['taskType']=='Task'){ ?>
	<i class="fa fa-calendar-check-o" aria-hidden="true"></i>
	<?php } ?>
	<?php if($rest['taskType']=='Call'){ ?>

	<i class="fa fa-phone-square" aria-hidden="true"></i>
	<?php } ?>
	<?php if($rest['taskType']=='Meeting'){ ?>
	<i class="fa fa-handshake-o" aria-hidden="true"></i>
	<?php } ?> </div>
</div> 
</a>
 

<?php $n++; } ?>





<?php if($n==1){ ?>
<div style="padding:40px 0px; text-align:center; font-size:12px; color:#666666;">No Follow Up Found</div>

<?php } ?>

  <input name="scrolltopid" id="scrolltopid" type="hidden" value="" />
  
<?php if(countlisting(id,'queryTask','where  1 '.$mainwhere.' ')>$n){ ?>
<div style="padding:30px 0px; text-align:center; color:#999999; font-size:12px;" onclick="loadpaging();" id="loadmorebtn">Load More</div>
 <?php }?>

</div>




 



<script>
function loadpaging(){ 
var keywordfield = encodeURI($('#keywordfield').val());
var scrolltopid = $('#scrolltopid').val();
var querystatus = encodeURI('<?php echo $_REQUEST['querystatus']; ?>'); 
var statusname = encodeURI('<?php echo $_REQUEST['statusname']; ?>'); 
openpage('followuplist.php?querystatus='+querystatus+'&statusname='+statusname+'&frompage=<?php echo $frompage; ?>&topage=<?php echo ($topage+25); ?>&scrolltopid='+scrolltopid+'&keywordfield='+keywordfield,'Follow Up');
}

function changestatus(id,name){ 
var keywordfield = encodeURI($('#keywordfield').val());
var name = encodeURI(name);
openpage('followuplist.php?querystatus='+id+'&statusname='+name+'&keywordfield='+keywordfield,'Follow Up');
 
}

function searchlist(){
var title = $('#titleheading').html();
var keywordfield = encodeURI($('#keywordfield').val());
$('#bodyarea').html('<div class="demo"></div>');
$('#bodyarea').load('followuplist.php?keywordfield='+keywordfield);
$('#titleheading').html(title);
}


$(window).scroll( function() { 
 var scrolled_val = $(document).scrollTop().valueOf(); 
 $('#scrolltopid').val(scrolled_val);
});
  
$('html').scrollTop(<?php echo $_REQUEST['scrolltopid']; ?>);
</script>