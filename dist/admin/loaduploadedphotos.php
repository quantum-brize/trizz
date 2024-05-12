<?php

include "inc.php";

$where='';

if($_REQUEST['keyword']!=''){ 

$where=' and name like "%'.$_REQUEST['keyword'].'%"';

}

?>

<style>

.mediaimagesbox{width:100%; height:100px; overflow:hidden;border:2px solid #fff; cursor:pointer; margin-bottom: 20px;}

.mediaimagesbox:hover{ border:2px solid #000;}

.mediaimagesbox img{width:100%; height:auto; min-height:100%; border:2px solid #fff;}

</style>

<?php 
if($_REQUEST['liboutertype']==1){


if($_REQUEST['totalnumbercount']==''){

$totalnumber='12';

} else {

$totalnumber=$_REQUEST['totalnumbercount'];

}



$number=1;

$rs=GetPageRecord('*','sysMediaLibrary',' 1 '.$where.' order by id desc ');

$totoalrows=$rest=mysqli_num_rows($rs);



$rs=GetPageRecord('*','sysMediaLibrary',' 1 '.$where.' order by id desc limit 0,'.$totalnumber.''); 

while($rest=mysqli_fetch_array($rs)){ 

 

if (getimagesize($fullurl.'package_image/'.$rest['name']) !== false) {

?>

<div class="col-md-9 col-xl-4" ><div class="mediaimagesbox" style="margin-bottom:0px;" onClick="<?php echo $_REQUEST['afunctin']; ?>('<?php echo str_replace(' ','%20',$rest['name']); ?>');"><img src="<?php echo $fullurl; ?>package_image/<?php echo $rest['name']; ?>"  />





</div>

 <div style="margin-top:5px; margin-bottom:10px; font-size:12px; text-align:center;white-space: nowrap; overflow: hidden; text-overflow: ellipsis; width:170px;"><?php  $img=explode('.',preg_replace('/[0-9]+/', '', $rest['name'])); if(trim(str_replace('_',' ',$img[0]))!=''){ echo ucfirst(str_replace('_',' ',$img[0])); } else { echo 'Untitled'; } ?></div>

</div>

<?php $number++; } }  ?> 



<?php if($totoalrows>=$number){ ?>

<div style="padding:0px 0px 40px; width:100%; text-align:center;"><input  type="button" value="Load more"   onclick="funloaduploadedphotos(<?php echo $totalnumber+6; ?>);" class="btn btn-primary"></div>

<?php } ?>

<?php } ?>



 