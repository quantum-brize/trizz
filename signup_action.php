<?php 
include "inc.php";


print_r($_POST);

if($_REQUEST["action"]=="register" && $_POST["firstName"]!="" && $_POST["lastName"]!="" && $_POST["mobile"]!="" && $_POST["email"]!="" && $_POST["password"]!="" && $_POST["confirmpassword"]!="" && $_POST["country"]!="" && $_POST["state"]!="" && $_POST["city"]!="" && $_POST["companyName"]!="" && $_POST["businessType"]!="" && $_POST["iaccept"]>0  ){




$firstName=trim($_REQUEST["firstName"]); 
$salesManager=trim($_REQUEST["salesManager"]); 

$mobile=trim($_REQUEST["mobile"]); 

$password=trim($_REQUEST["password"]);

$confirmpassword=trim($_REQUEST["confirmpassword"]); 

$address=trim($_REQUEST["address"]); 

$lastName=trim($_REQUEST["lastName"]); 

$email=trim($_REQUEST["email"]); 

$pincode=trim($_REQUEST["pincode"]); 

$country=trim($_REQUEST["country"]); 

$state=trim($_REQUEST["state"]); 

$city=trim($_REQUEST["city"]); 

$companyName=trim($_REQUEST["companyName"]);  

$pan=trim($_REQUEST["pan"]); 

$businessType=trim($_REQUEST["businessType"]); 

$gstNumber=trim($_REQUEST["gstNumber"]);

$website=trim($_REQUEST["website"]);
	
$userCountry=trim($_REQUEST["userCountry"]);

$userState=trim($_REQUEST["userState"]);

$userCity=trim($_REQUEST["userCity"]);
	
$companyPincode=trim($_REQUEST["companyPincode"]);
	
$companyAddress=trim($_REQUEST["companyAddress"]);
	
$companyMobile=trim($_REQUEST["companyMobile"]);
	
$agentCode=addslashes($_POST['agentCode']);
	
$aadharNumber=addslashes($_POST['aadharNumber']);
	
$oldpanCopy=addslashes($_POST['panCopy']);
	

	
if($_FILES["panCopy"]["tmp_name"]!=""){  

$rt=mt_rand().strtotime(date("YMDHis")); 
$companyLogoFileName=basename($_FILES['panCopy']['name']); 

$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION);  
$panCopy=time().$rt.'.'.$companyLogoFileExtension; 

move_uploaded_file($_FILES["panCopy"]["tmp_name"], "upload/{$panCopy}"); 
}

if($panCopy==''){ 
$panCopy=$oldpanCopy; 
}





if(strlen($password)<8){ ?>



<script>

alert('Enter password  minimum length 8 characters!');

</script>



<?php

exit();



}



if($password!=$confirmpassword){ ?>



<script>

alert('Password and confirm password must be same!');

</script> 
<?php

exit();



}

 


 

$rs8=GetPageRecord('*','sys_userMaster','email="'.trim($email).'" ');   
$dubcheck=mysqli_fetch_array($rs8);   
if($dubcheck['id']!=''){
 

?> 

<script> 
alert('Username (<?php echo $email; ?>) already taken. Please enter diffrent email id!'); 
</script>


 
<?php 
}else{ 
$a=GetPageRecord('*','sys_userMaster','id=1 ');  
$invoiceData=mysqli_fetch_array($a); 
 

$lag=GetPageRecord('*','sys_userMaster',' 1 order by id desc');  
$lastagentid=mysqli_fetch_array($lag); 
$lastAgentId=round($lastagentid['agentId']+1); 


 
 
 
 $rs=GetPageRecord('*','sys_userMaster',' userType="agent" order by id desc'); 
$getid=mysqli_fetch_array($rs);

$id='TSB'.($getid['id']+1);

$agentId=$id;
 
	//Insert
 
$namevalue ='firstName="'.$firstName.'",lastName="'.$lastName.'",email="'.$email.'",panCopy="'.$panCopy.'",password="'.md5($password).'",mobile="'.$mobile.'",address="'.$address.'",pincode="'.$pincode.'",country="'.$country.'",state="'.$state.'",city="'.$city.'",userCountry="'.$userCountry.'",userState="'.$userState.'",userCity="'.$userCity.'",companyPincode="'.$companyPincode.'",companyAddress="'.$companyAddress.'",companyMobile="'.$companyMobile.'",phone="'.$companyMobile.'",businessType="'.$businessType.'",website="'.$website.'",companyName="'.$companyName.'",company="'.$companyName.'",pan="'.$pan.'",aadharNumber="'.$aadharNumber.'",gstin="'.$gstNumber.'",dateAdded="'.date('Y-m-d H:i:s').'",addedBy="0",userType="agent",status=0,agentId="'.$agentId.'"'; 
$userId=addlistinggetlastid('sys_userMaster',$namevalue); 
 

$ccmail='';   
$file_name='';  
 

$subject = 'Login Details - '.strip($getlogo['companyName']).''; 


$mailbody='<div align="left">Dear '.$firstName.',<br /> 
          <br /> 
      Thank you for register with us.<br /> 
  <br /> 
  <strong>Your Login Credentials</strong><br /> 
  <br /> 
      Login Page URL: <a href="'.$fullurl.'" target="_blank">'.$fullurl.'</a><br /> 
  <br /> 

      Agent ID: '.$agentId.'<br />  
      Username: '.$email.'<br />  
      Password: '.$password.'<br /> 
  <br /> 

     <div style="padding:20px; margin-top:10px; background-color:#FFFFCC;"><strong>Note:</strong> Your account is under review process.</div> 

    </div> ';

 

senddesignedmail($fromemail,$email,$subject,$mailbody,$ccmail,$file_name,$adminurl);

 



?>

 
 

<script> 
window.parent.location.href = "<?php echo $fullurl; ?>signup-done"; 

</script> 

<?php 

} 


}



?>