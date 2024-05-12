<?php include "inc.php"; 

$bnr=0;

if(trim($_REQUEST['keyword'])!='' && $_REQUEST['topsearchtype']!=''){ ?>
 
 



 
 
 <?php  
 $q=1;
$wheresearch='';  
if(trim($_REQUEST['topsearchtype'])=='All' || trim($_REQUEST['topsearchtype'])=='Queries'){ ?>

<div class="listearchlist">
<div class="headsearchlist" id="queryheadtop">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" valign="top"><i class="dripicons-archive"></i></td>
    <td width="98%" valign="top" style="padding-left:5px;">Queries</td>
  </tr>
</table>

 </div>
<?php
$mainwhere='';
if($LoginUserDetails['userType']!=0){ 

 $mainwhere='and assignTo in (select id from sys_userMaster where branchId in (select id from roleMaster where parentId="'.$LoginUserDetails['branchId'].'")  or (   assignTo in (select id from sys_userMaster where branchId in (select id from roleMaster where parentId in ( select id from roleMaster where parentId="'.$LoginUserDetails['branchId'].'" ) ) ) or   assignTo in (select id from sys_userMaster where branchId in (select id from roleMaster where parentId in ( select id from roleMaster where parentId in ( select id from roleMaster where parentId="'.$LoginUserDetails['branchId'].'" ) ) ) ) or   assignTo in (select id from sys_userMaster where branchId in (select id from roleMaster where parentId in ( select id from roleMaster where parentId in ( select id from roleMaster where parentId in (select id from roleMaster where parentId="'.$LoginUserDetails['branchId'].'")  ) ) ) ) or   assignTo in (select id from sys_userMaster where branchId in (select id from roleMaster where parentId in ( select id from roleMaster where parentId in ( select id from roleMaster where parentId in (select id from roleMaster where parentId in (select id from roleMaster where parentId="'.$LoginUserDetails['branchId'].'") )  ) ) ) ) or addedBy="'.$_SESSION['userid'].'" or  assignTo="'.$_SESSION['userid'].'") )  ';

}

$wheresearch.=' and (id="'.decode($_REQUEST['keyword']).'" or clientId in (select id from userMaster where firstName like "%'.$_REQUEST['keyword'].'%" or lastName like "%'.$_REQUEST['keyword'].'%"  or mobile like "%'.$_REQUEST['keyword'].'%" or email like "%'.$_REQUEST['keyword'].'%") )';


 
  
$rs=GetPageRecord('*','queryMaster',' 1 '.$wheresearch.' '.$mainwhere.' order by id desc limit 0,30'); 
while($rest=mysqli_fetch_array($rs)){ 
?> 
<a href="#" onclick="showuserinfosearch('query','<?php echo encode($rest['id']); ?>');" id="link<?php echo encode($rest['id']); ?>">
<div style="font-size:12px; margin-bottom:2px; font-weight:700;"><?php echo encode($rest['id']); ?></div>
<?php if(date('d-m-Y',strtotime($rest['startDate']))!='01-01-1970'){ echo date('d-m-Y',strtotime($rest['startDate'])); } ?> | <?php echo $rest['fromCity']; ?> - <?php
												$string = '';
										$string = preg_replace('/\.$/', '', $rest['destinationId']);  
										$array = explode(',', $string); 
										foreach($array as $value)  
										{ ?>
										<span class="badge badge-boxed  badge-soft-success" style=" background-color: #737373 !important; color:#fff; font-size: 11px; padding: 5px 6px;"><?php echo  getCityName($value); ?></span>
										<?php }?>

</a>
<?php $q++; $bnr=1; $s=1; }  ?>

<?php if($q==1){ ?><div style="color:#999999; text-align:left">&nbsp;&nbsp;&nbsp;No Result Found</div><?php } ?>
</div> 
<?php } ?>



<?php   

if(trim($_REQUEST['topsearchtype'])=='All' || trim($_REQUEST['topsearchtype'])=='Itineraries'){
$wheresearch='';  ?>

<div class="listearchlist">
<div class="headsearchlist" id="queryheadtop">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" valign="top"><i class="dripicons-briefcase"></i></td>
    <td width="98%" valign="top" style="padding-left:5px;">Itineraries</td>
  </tr>
</table>

 </div>
 
 <?php
 
  $q=1;
$wheresearch.=' and name like "%'.$_REQUEST['keyword'].'%"  '; 
 
  
$rs=GetPageRecord('*','sys_packageBuilder',' 1 '.$wheresearch.' order by id desc limit 0,30'); 
while($rest=mysqli_fetch_array($rs)){ 
?> 
<a href="#" onclick="showuserinfosearch('Itineraries','<?php echo encode($rest['id']); ?>');" id="it<?php echo encode($rest['id']); ?>">
 
<?php echo stripslashes($rest['name']); ?> - <?php echo stripslashes($rest['destinations']); ?> - &#8377;<?php echo number_format($rest['grossPrice']+$rest['extraMarkup']); ?> 

</a>
<?php $q++; $bnr=1; $s=1; }  ?>
<?php if($q==1){ ?><div style="color:#999999; text-align:left">&nbsp;&nbsp;&nbsp;No Result Found</div><?php } ?>
</div>


<?php } ?>




<?php   

if(trim($_REQUEST['topsearchtype'])=='All' || trim($_REQUEST['topsearchtype'])=='Clients'){
$wheresearch='';  ?>

<div class="listearchlist">
<div class="headsearchlist" id="queryheadtop">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" valign="top"><i class="dripicons-user"></i></td>
    <td width="98%" valign="top" style="padding-left:5px;">Clients</td>
  </tr>
</table>

 </div>
 
 <?php
  $q=1;
 
$wheresearch.=' and (firstName like "%'.$_REQUEST['keyword'].'%" or  lastName like "%'.$_REQUEST['keyword'].'%")  '; 
 
  
$rs=GetPageRecord('*','userMaster',' userType=4 '.$wheresearch.' order by id desc limit 0,30'); 
while($rest=mysqli_fetch_array($rs)){ 
?> 
<a href="#" onclick="showuserinfosearch('Clients','<?php echo encode($rest['id']); ?>');" id="cl<?php echo encode($rest['id']); ?>">
 
<?php echo stripslashes($rest['submitName']); ?> <?php echo stripslashes($rest['firstName']); ?> <?php echo stripslashes($rest['lastName']); ?> 

</a>
<?php $q++; $bnr=1; $s=1; }  ?>
<?php if($q==1){ ?><div style="color:#999999; text-align:left">&nbsp;&nbsp;&nbsp;No Result Found</div><?php } ?>
</div>


<?php } ?>






 





<div class="searchdetails">

</div>
 
<?php } ?>


<script>
function showuserinfosearch(t,id){
$('.searchdetails').show();
$('.searchdetails').load('searchdetails.php?type='+t+'&id='+id);
$('.listearchlist a').removeClass('active');
if(t=='query'){
$('.listearchlist #link'+id).addClass('active'); 
}
if(t=='Itineraries'){
$('.listearchlist #it'+id).addClass('active'); 
}
if(t=='Clients'){
$('.listearchlist #cl'+id).addClass('active'); 
}
}
</script>


<?php if($s==1){ ?>
<script>
$('#topsearchresult').css('height','500px');
</script>
<?php }  else { ?>
<script>
$('#topsearchresult').css('height','auto');
</script>

<?php } ?>