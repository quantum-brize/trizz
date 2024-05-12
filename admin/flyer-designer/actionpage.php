<?php include "inc.php"; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
<?php
 
if($_REQUEST['action']=='createflyer' && $_REQUEST['typevar']!=''){ 
$typevar=$_REQUEST['typevar'];
$pageWidth='0px';
$pageHeight='0px';

if($typevar=='Instagram Story'){
$pageWidth='1080px';
$pageHeight='1920px';
}


if($typevar=='Instagram Post'){
$pageWidth='1080px';
$pageHeight='1080px';
}

if($typevar=='Facebook Post'){
$pageWidth='1200px';
$pageHeight='630px';
}
if($typevar=='Emailer'){
$pageWidth='800px';
$pageHeight='1000px';
}

if($pageWidth!='0px'){
 
$namevalue ='userId="'.$_SESSION['userid'].'",projectType="'.trim($typevar).'",name="New Project",pageWidth="'.$pageWidth.'",pageHeight="'.$pageHeight.'",editDate="'.date('Y-m-d H:i:s').'",addDate="'.date('Y-m-d H:i:s').'"';   
$lastid=addlistinggetlastid('flyer_project',$namevalue); 

?>
<script>
window.location.href = "edit-project.html?id=<?php echo encode($lastid); ?>";
</script>
<?php

}
}


if($_REQUEST['action']=='deleteproject' && $_REQUEST['did']!=''){  
deleteRecord('flyer_project','id="'.decode($_REQUEST['did']).'" and userId="'.$_SESSION['userid'].'"'); 

?>
<script>
window.location.href = "projects?dl=1";
</script>
<?php
  
}



if($_REQUEST['action']=='changeprojectname' && $_REQUEST['projectname']!='' && $_REQUEST['id']!=''){ 
$projectname=addslashes($_REQUEST['projectname']);

 $namevalue ='name="'.$projectname.'",editDate="'.date('Y-m-d H:i:s').'"';   
$where='userId="'.$_SESSION['userid'].'" and id="'.decode($_REQUEST['id']).'"';     
updatelisting('flyer_project',$namevalue,$where); 

}



 

if($_REQUEST['action']=='uploadphoto' && $_FILES['image']!=''){  
 
if ($_FILES["image"]["size"] > 5000000) { // 500KB
    ?>
	<script>
	alert('Sorry, your file is too large. Max file size: 5MB');
	</script>
	<?php
}

 

if($_FILES["image"]["tmp_name"]!=""){  

$rt=mt_rand().strtotime(date("YMDHis")); 

$companyLogoFileName=basename($_FILES['image']['name']); 

$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION); 
$profilePhoto=time().$rt.'.'.$companyLogoFileExtension;
 

move_uploaded_file($_FILES["image"]["tmp_name"], "flyer_library/{$profilePhoto}"); 

$namevalue ='name="'.$profilePhoto.'",userid="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';  
addlistinggetlastid('flyerMediaLibrary',$namevalue);   

}

 
?>
<script>
parent.selectoption('o1');
</script>
<?php

}









if($_REQUEST['action']=='saveprojecthtml' && $_POST['projecthmtl']!='' && $_REQUEST['projectid']!=''){ 
$projecthmtl=addslashes($_REQUEST['projecthmtl']);

 $namevalue ='flyerHTML="'.$projecthmtl.'",editDate="'.date('Y-m-d H:i:s').'"';   
$where='id="'.($_REQUEST['projectid']).'"';     
updatelisting('flyer_project',$namevalue,$where); 

}
?>
