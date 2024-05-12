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
$mainwhere=' and   assignTo="'.$_SESSION['userid'].'" '.$keywordfield.'  ';   
$mainwheretotal=' and  assignTo="'.$_SESSION['userid'].'"  '.$keywordfield.'  ';   
} else {
$mainwhere=' and 1 '.$keywordfield.' '; 
$mainwheretotal=' and 1 '.$keywordfield.' ';  

}


 
?>


<style>
#addbuttontop{display:none;}
</style>

<div class="listview">



<?php 
$n=1;  
$a=GetPageRecord('*','queryTask',' 1 '.$mainwhere.' and makeDone!=1 and  reminderDate<"'.date('Y-m-d H:i:s').'" order by id desc limit '.$frompage.', '.$topage.'');
while($rest=mysqli_fetch_array($a)){ 

$b=GetPageRecord('*','queryMaster','id="'.$rest['queryId'].'"'); 
$queryData=mysqli_fetch_array($b);
?>
<a href="#">
<div class="content leftimgicon">
<div class="userthumbleft"><?php if($rest['taskType']=='Task'){ ?>
	<i class="fa fa-calendar-check-o" aria-hidden="true"></i>
	<?php } ?>
	<?php if($rest['taskType']=='Call'){ ?>

	<i class="fa fa-phone-square" aria-hidden="true"></i>
	<?php } ?>
	<?php if($rest['taskType']=='Meeting'){ ?>
	<i class="fa fa-handshake-o" aria-hidden="true"></i>
	<?php } ?></div>
<div class="qid"><?php echo (stripslashes($rest['details'])); ?></div>
<div class="dateq"><?php echo stripslashes($queryData['name']); ?> <i class="fa fa-long-arrow-right" aria-hidden="true"></i> <?php
												$string = '';
										$string = preg_replace('/\.$/', '', $queryData['destinationId']);  
										$array = explode(',', $string); 
										foreach($array as $value)  
										{ ?>
										 <?php echo  getCityName($value); ?> 
							  <?php }?> - <?php  echo encode($rest['queryId']); ?></div>  
<div class="dateq"><?php echo date('d/m/Y-h:i A',strtotime($rest['reminderDate'])); ?></div>
</div> 
</a>
<?php } ?>

 

</div>








<script>
$('#titleheading').html('Notifications (<?php echo countlisting('id','queryTask','where   1 '.$mainwhere.' and makeDone!=1 and  reminderDate<"'.date('Y-m-d H:i:s').'"  '); ?>)');
</script>




<script>
function loadpaging(){ 
var keywordfield = encodeURI($('#keywordfield').val());
var scrolltopid = $('#scrolltopid').val();
var querystatus = encodeURI('<?php echo $_REQUEST['querystatus']; ?>'); 
var statusname = encodeURI('<?php echo $_REQUEST['statusname']; ?>'); 
openpage('notifications.php?querystatus='+querystatus+'&statusname='+statusname+'&frompage=<?php echo $frompage; ?>&topage=<?php echo ($topage+25); ?>&scrolltopid='+scrolltopid+'&keywordfield='+keywordfield,'Notifications (<?php echo countlisting('id','queryTask','where   1 '.$mainwhere.' and makeDone!=1  and  reminderDate<"'.date('Y-m-d H:i:s').'" '); ?>');
}
 

function searchlist(){
var title = $('#titleheading').html();
var keywordfield = encodeURI($('#keywordfield').val());
$('#bodyarea').html('<div class="demo"></div>');
$('#bodyarea').load('notifications.php?keywordfield='+keywordfield);
$('#titleheading').html(title);
}



$(window).scroll( function() { 
 var scrolled_val = $(document).scrollTop().valueOf(); 
 $('#scrolltopid').val(scrolled_val);
});
  
$('html').scrollTop(<?php echo $_REQUEST['scrolltopid']; ?>);
</script>
