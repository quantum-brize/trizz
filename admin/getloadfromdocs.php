<?php 
include "inc.php"; 
 
$rsa=GetPageRecord($select,'sys_userMaster','id=1'); 
$getleadurl=mysqli_fetch_array($rsa);

 
?> 
<script src="assets/js/jquery.min.js"></script>

<?php
 $finalvar='';
$DOM = new DOMDocument();
$DOM->loadHTMLFile($getleadurl['leadURL']);
$rows = $DOM->getElementsByTagName("tr");
for ($i = 0; $i < $rows->length; $i++) {
    $cols = $rows->item($i)->getElementsbyTagName("td");
	
		$name='';
	$mobile='';
	$email='';
	$address='';
	$finalvar='';
	$n=1;
    for ($j = 0; $j < $cols->length; $j++) {
	

	if($i>1){
		
		
	if($n==1){
	
	
	
	if(trim($cols->item($j)->nodeValue)!=''){
	 
	$finalvar.=trim($cols->item($j)->nodeValue).',';
	}
	}
	
	if($n==2){
	if(trim($cols->item($j)->nodeValue)!=''){
	$finalvar.=trim($cols->item($j)->nodeValue).',';
	}
	}
	if($n==3){
	if(trim($cols->item($j)->nodeValue)!=''){
	$finalvar.=trim($cols->item($j)->nodeValue).',';
	}
	}
	 
		
		
		
		
        //echo $cols->item($j)->nodeValue, " - ";
		}
		
        // you can also use DOMElement::textContent
        // echo $cols->item($j)->textContent, "\t";
    $n++; if($n==3){$n=1;} 
	
	 //echo $name.'-'.$mobile.'-'.$email.'-'.$address;
	}
   

$arr=explode(',',$finalvar);
$name='';
$mobile=trim($arr[1]);
$phone=trim($arr[1]);
$email='';
$name='';
$startDate='';

//print_r($arr);

$name=trim($arr[0]);
$mobile=trim($arr[1]);
$phone=trim($arr[1]);
$email=trim($arr[2]); 
$adult=trim($arr[3]); 
$child=trim($arr[4]);
$infant=trim($arr[5]);
$details=trim($arr[6]);
$startDate=trim($arr[7]);
$endDate=trim($arr[8]);
$destination=trim($arr[9]);
$dateAdded=date('Y-m-d H:i:s');
$updateDate=date('Y-m-d H:i:s');
	
 
	
	if($startDate!=''){
$startDate=date('Y-m-d',strtotime($startDate));
	}

//echo $name.'-'.$mobile.'-'.$email.'-'.$address;
 
 $bb=GetPageRecord('*','userMaster','mobile="'.$mobile.'" and userType=4');    
$clientidcheck=mysqli_fetch_array($bb); 

 

if($clientidcheck['mobile']=='' && $name!='' && $name!=' ' && $name!='  ' && $name!='   ' && $name!=' '){

if($mobile!='' && $name!=''){

if (strpos($mobile, 'not for') !== false || strpos($mobile, 'are not sourced') !== false || strpos($email, 'Sheet1') !== false) {
//echo $mobile.'+++'.$email;
//echo $mobile.'+++1';
} else {
	
	

$randPass = rand(999999,100000);

$namevalue4 ='userType="4",submitName="Mr.",firstName="'.$name.'",mobile="'.$mobile.'",password="'.md5($randPass).'",status=1,email="'.$email.'",addedBy=1,dateAdded="'.time().'"';
$clientId=addlistinggetlastid('userMaster',$namevalue4); 

$destinationData=GetPageRecord('name','cityMaster','name="'.$destination.'"'); 
$destinationData11=mysqli_fetch_array($destinationData);


$namevalue ='startDate="'.$startDate.'",endDate="'.$endDate.'",name="'.$name.'",phone="'.$phone.'",email="'.$email.'",adult="'.$adult.'",child="'.$child.'",infant="'.$infant.'",assignTo="1",details="'.$details.'",addedBy="1",dateAdded="'.$dateAdded.'",day="'.$day.'",updateDate="'.$dateAdded.'",clientId="'.$clientId.'",destinationId="'.$destinationData11["name"].'",priorityStatus="0"';

$queryId=addlistinggetlastid('queryMaster',$namevalue); 


/*Send Whatsapp SMS*/
$clientName=$name;
$clientMobile=$phone;
$userName=getUserNameNew(1);
$travelDate=date("d M Y",strtotime($startDate));

$pax=urlencode($adult.' Adult + '.$child.' Child');


$data='https://api.easysocial.in/api/v1/wa-templates/send/clbknqlvp0ci09naicpy82iw9/90/78/API/91'.urlencode($clientMobile).'?header1=https://storage.googleapis.com/easysocial_production/iyaatra/iyaatra-welcome.png&body1='.urlencode($clientName).'&body2='.urlencode($userName).'&body3='.urlencode($destination).'&body4='.encode($queryId).'&body5='.urlencode($travelDate).'&body6='.$pax;

file_get_contents($data);






}

}

$finalvar='';
}



   ?>

<script>  

 parent.redirectpage('display.html?ga=query'); 

</script>

<?php 
   
   
}
?>