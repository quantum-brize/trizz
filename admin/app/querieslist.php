<?php
include "appinc.php";
$keywordfield='';
if($_REQUEST['keywordfield']!=''){
$keywordfield='  and (id="'.decode($_REQUEST['keywordfield']).'" or clientId in (select id from userMaster where firstName like "%'.$_REQUEST['keywordfield'].'%" or lastName like "%'.$_REQUEST['keywordfield'].'%"  or mobile like "%'.$_REQUEST['keywordfield'].'%" or email like "%'.$_REQUEST['keywordfield'].'%") ) ';
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
$mainwheretotal=' and (addedBy="'.$_SESSION['userid'].'" or  assignTo="'.$_SESSION['userid'].'") '.$keywordfield.' ';   
} else {
$mainwhere=' and 1 '.$keywordfield.' '; 
$mainwheretotal=' and 1 '.$keywordfield.' ';  

}



if($_REQUEST['querystatus']>0){
$mainwhere.=' and statusId="'.$_REQUEST['querystatus'].'"  ';
} 


if($_REQUEST['statusname']==''){
$_REQUEST['statusname']='All Queries - '.countlisting(id,'queryMaster','where  1 '.$mainwheretotal.' ').'';
}
 
 
 //echo 'where  1 '.$mainwheretotal.' ';
?>

<div class="sectionallsearch"   onClick="filteropenclose();"><span id="statusname"><?php echo $_REQUEST['statusname']; ?></span> <i class="fa fa-caret-down" id="mainarrow" aria-hidden="true"></i>

<div id="filterbox" style="display:none;">
<a <?php if($_REQUEST['querystatus']==''){ ?>class="active"<?php } ?> onclick="changestatus('','All Queries - <?php echo countlisting('id','queryMaster','where  1 '.$mainwheretotal.' '); ?>');">All Queries - <?php echo countlisting(id,'queryMaster','where  1 '.$mainwheretotal.' '); ?> <?php if($_REQUEST['querystatus']==''){ ?><i class="fa fa-check" aria-hidden="true"></i><?php } ?></a>

<a <?php if($_REQUEST['querystatus']==1){ ?>class="active"<?php } ?> onclick="changestatus('1','New Queries - <?php echo countlisting('id','queryMaster','where  1 '.$mainwheretotal.' and statusId=1'); ?>');">New Queries - <?php echo countlisting(id,'queryMaster','where  1 '.$mainwheretotal.' and statusId=1'); ?> <?php if($_REQUEST['querystatus']==1){ ?><i class="fa fa-check" aria-hidden="true"></i><?php } ?></a>
<a <?php if($_REQUEST['querystatus']==2){ ?>class="active"<?php } ?> onclick="changestatus('2','Active Queries - <?php echo countlisting('id','queryMaster','where  1 '.$mainwheretotal.' and statusId=2'); ?>');">Active Queries - <?php echo countlisting(id,'queryMaster','where  1 '.$mainwheretotal.' and statusId=2'); ?> <?php if($_REQUEST['querystatus']==2){ ?><i class="fa fa-check" aria-hidden="true"></i><?php } ?></a>
<a <?php if($_REQUEST['querystatus']==3){ ?>class="active"<?php } ?> onclick="changestatus('3','No Connec - <?php echo countlisting('id','queryMaster','where  1 '.$mainwheretotal.' and statusId=3'); ?>');">No Connect - <?php echo countlisting(id,'queryMaster','where  1 '.$mainwheretotal.' and statusId=3'); ?> <?php if($_REQUEST['querystatus']==3){ ?><i class="fa fa-check" aria-hidden="true"></i><?php } ?></a>

<a <?php if($_REQUEST['querystatus']==4){ ?>class="active"<?php } ?> onclick="changestatus('4','Hot Lead - <?php echo countlisting('id','queryMaster','where  1 '.$mainwheretotal.' and statusId=4'); ?>');">Hot Lead - <?php echo countlisting(id,'queryMaster','where  1 '.$mainwheretotal.' and statusId=4'); ?> <?php if($_REQUEST['querystatus']==4){ ?><i class="fa fa-check" aria-hidden="true"></i><?php } ?></a>

<a <?php if($_REQUEST['querystatus']==9){ ?>class="active"<?php } ?> onclick="changestatus('9','Follow Up - <?php echo countlisting('id','queryMaster','where  1 '.$mainwheretotal.' and statusId=9'); ?>');">Follow Up - <?php echo countlisting(id,'queryMaster','where  1 '.$mainwheretotal.' and statusId=9'); ?><?php if($_REQUEST['querystatus']==9){ ?><i class="fa fa-check" aria-hidden="true"></i><?php } ?></a>

<a <?php if($_REQUEST['querystatus']==8){ ?>class="active"<?php } ?> onclick="changestatus('8','Proposal Sent - <?php echo countlisting('id','queryMaster','where  1 '.$mainwheretotal.' and statusId=8'); ?>');">Proposal Sent - <?php echo countlisting(id,'queryMaster','where  1 '.$mainwheretotal.' and statusId=8'); ?><?php if($_REQUEST['querystatus']==8){ ?><i class="fa fa-check" aria-hidden="true"></i><?php } ?></a>
<a <?php if($_REQUEST['querystatus']==5){ ?>class="active"<?php } ?> onclick="changestatus('5','Confirmed - <?php echo countlisting('id','queryMaster','where  1 '.$mainwheretotal.' and statusId=5'); ?>');">Confirmed - <?php echo countlisting(id,'queryMaster','where  1 '.$mainwheretotal.' and statusId=5'); ?><?php if($_REQUEST['querystatus']==5){ ?><i class="fa fa-check" aria-hidden="true"></i><?php } ?></a>
<a <?php if($_REQUEST['querystatus']==6){ ?>class="active"<?php } ?> onclick="changestatus('6','Cancelled - <?php echo countlisting('id','queryMaster','where  1 '.$mainwheretotal.' and statusId=6'); ?>');">Cancelled - <?php echo countlisting(id,'queryMaster','where  1 '.$mainwheretotal.' and statusId=6'); ?><?php if($_REQUEST['querystatus']==6){ ?><i class="fa fa-check" aria-hidden="true"></i><?php } ?></a>
<a <?php if($_REQUEST['querystatus']==7){ ?>class="active"<?php } ?> onclick="changestatus('7','Invalid - <?php echo countlisting('id','queryMaster','where  1 '.$mainwheretotal.' and statusId=7'); ?>');">Invalid - <?php echo countlisting(id,'queryMaster','where  1 '.$mainwheretotal.' and statusId=7'); ?><?php if($_REQUEST['querystatus']==7){ ?><i class="fa fa-check" aria-hidden="true"></i><?php } ?></a>

</div>
</div>

<div class="listview">

<?php 
$n=1;  
$a=GetPageRecord('*','queryMaster',' 1 '.$mainwhere.' order by id desc limit '.$frompage.', '.$topage.'');
while($rest=mysqli_fetch_array($a)){ 
?> 

<a>
<div class="content" id="hash<?php  echo $pagehash=encode($rest['id']); ?>">
<div class="qid"><?php echo stripslashes($rest['name']); ?> <i class="fa fa-long-arrow-right" aria-hidden="true"></i> <?php
												$string = '';
										$string = preg_replace('/\.$/', '', $rest['destinationId']);  
										$array = explode(',', $string); 
										foreach($array as $value)  
										{ ?>
										 <?php echo  getCityName($value); ?> 
							  <?php }?></div>
<div class="dateq"><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo date('d-m-Y', strtotime($rest['startDate'])); ?> Till <?php echo date('d-m-Y', strtotime($rest['endDate'])); ?> </div>
<div class="dateq"><?php  echo encode($rest['id']); ?> - <i class="fa fa-calendar-check-o" aria-hidden="true"></i> <?php echo date('d-m-Y',strtotime($rest['dateAdded'])); ?></div>
<?php echo getstatus($rest['statusId']); ?>
</div> 
</a>

<?php $n++; } ?>


<?php if($n==1){ ?>
<div style="padding:40px 0px; text-align:center; font-size:12px; color:#666666;">No Query Found</div>

<?php } ?>

  <input name="scrolltopid" id="scrolltopid" type="hidden" value="" />
  
<?php if(countlisting(id,'queryMaster','where  1 '.$mainwhere.' ')>$n){ ?>
<div style="padding:30px 0px; text-align:center; color:#999999; font-size:12px;" onclick="loadpaging();" id="loadmorebtn">Load More</div>
 <?php }?>




</div>


<script>
function loadpaging(){ 
var keywordfield = encodeURI($('#keywordfield').val());
var scrolltopid = $('#scrolltopid').val();
var querystatus = encodeURI('<?php echo $_REQUEST['querystatus']; ?>'); 
var statusname = encodeURI('<?php echo $_REQUEST['statusname']; ?>'); 
openpage('querieslist.php?querystatus='+querystatus+'&statusname='+statusname+'&frompage=<?php echo $frompage; ?>&topage=<?php echo ($topage+25); ?>&scrolltopid='+scrolltopid+'&keywordfield='+keywordfield,'Queries');
}

function changestatus(id,name){ 
var keywordfield = encodeURI($('#keywordfield').val());
var name = encodeURI(name);
openpage('querieslist.php?querystatus='+id+'&statusname='+name+'&keywordfield='+keywordfield,'Queries');
 
}

function searchlist(){
var title = $('#titleheading').html();
var keywordfield = encodeURI($('#keywordfield').val());
$('#bodyarea').html('<div class="demo"></div>');
$('#bodyarea').load('querieslist.php?keywordfield='+keywordfield);
$('#titleheading').html(title);
}

$(window).scroll( function() { 
 var scrolled_val = $(document).scrollTop().valueOf(); 
 $('#scrolltopid').val(scrolled_val);
});
  
$('html').scrollTop(<?php echo $_REQUEST['scrolltopid']; ?>);
</script>