<?php
include "config/database.php"; 
include "config/function.php"; 
include "config/setting.php"; 

function getUserNameNew($id){
$a=GetPageRecord('firstName','sys_userMaster','id="'.$id.'"'); 
$displayData=mysqli_fetch_array($a);
return $displayData['firstName'];
}

?>
<script src="<?php echo $landingpagedatas; ?>assets/scripts/jquery-3.4.1.js"> </script>

<?php if($_POST['action']=='submitquery' && $_POST['mobileNumber']!='' && $_POST['adult']!='' && $_POST['child']!='' &&  $_POST['clientEmail']!='' &&  $_POST['clientName']!='' ){
 
$startDate=date('Y-m-d',strtotime($_POST["startDate"]));   
$endDate=date('Y-m-d',strtotime($_POST["endDate"]));     
$submitName=addslashes($_POST['submitName']);  

$name=addslashes($_POST['clientName']); 
$mobile=addslashes($_POST['mobileNumber']);   
$email=addslashes($_POST['clientEmail']);   
$details=addslashes($_POST['enquiryFor']); 
$adult=addslashes($_POST['adult']);
$child=addslashes($_POST['child']);
$destination=addslashes($_POST['destination']);
	
//$where='id!=1'; 
//$aaa=GetPageRecord('id','sys_userMaster','1 order by id rand()',$where); 
$addedBy= 404;
 
$dateAdded=date('Y-m-d H:i:s');
 
 
$bb=GetPageRecord('*','userMaster','email="'.$email.'" and userType=4');   
$clientidcheck=mysqli_fetch_array($bb);
 

if($clientidcheck['email']==''){

$namevalue4 ='userType="4",submitName="'.$submitName.'",firstName="'.$name.'",mobile="'.$mobile.'",status=1,email="'.$email.'",addedBy="'.$addedBy.'",dateAdded="'.time().'"';
$clientId=addlistinggetlastid('userMaster',$namevalue4); 

} else {
 
$clientId=$clientidcheck['id'];

}

  
$rs=GetPageRecord('*','sys_userMaster','id=1 '); 
$invoicedataa=mysqli_fetch_array($rs);



//cityId
//destinationId

$rs1=GetPageRecord('*','cityMaster','name="'.$destination.'"');
$editresult=mysqli_fetch_array($rs1);
$destinationId=$editresult['id']; 

 

$namevalue ='startDate="'.$startDate.'",endDate="'.$endDate.'",clientId="'.$clientId.'",name="'.$name.'",phone="'.$mobile.'",countryId=101,email="'.$email.'",serviceId=1,adult="'.$adult.'",child="'.$child.'",destinationId="'.$destinationId.'",cityId="'.$destinationId.'",infant=0,assignTo=1,leadSource=43,details="'.$details.'",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'"'; 

$queryId=addlistinggetlastid('queryMaster',$namevalue);   


$namevalue3 ='details="Query Created",queryId="'.$queryId.'",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'",logType="add_query"'; 
addlisting('queryLogs',$namevalue3); 


$clientName=$submitName . $name;
$clientMobile=$mobile;
$userName=getUserNameNew(1);
$travelDate=date("d M Y",strtotime($startDate));
$pax=urlencode($adult.' Adult + '.$child.' Child');

$data='https://api.easysocial.in/api/v1/wa-templates/send/clbknqlvp0ci09naicpy82iw9/90/78/API/91'.urlencode($clientMobile).'?header1=https://storage.googleapis.com/easysocial_production/iyaatra/iyaatra-welcome.png&body1='.urlencode($clientName).'&body2='.urlencode($userName).'&body3='.urlencode($destination).'&body4='.encode($queryId).'&body5='.urlencode($travelDate).'&body6='.$pax;


file_get_contents($data);
?>
<script>alert("Your Query Submitted! We Will be get back to youu soon.")</script>
<?php
header("Location: ".$fullurlproposal."sharepackage/".$_REQUEST['packageId']."/package.html");
  
?>

<script>

parent.$('#clientName').val('');
parent.$('#addeditfrm').hide();
parent.$('#thanksmsg').show();
</script>
 
 <?php
 
}