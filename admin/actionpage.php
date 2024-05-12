<?php 

include "inc.php";  

?> 

<script src="assets/js/jquery.min.js"></script>



<?php

 function compress($source, $destination, $quality) {

    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg') 

        $image = imagecreatefromjpeg($source);

    elseif ($info['mime'] == 'image/gif') 

        $image = imagecreatefromgif($source);

    elseif ($info['mime'] == 'image/png') 

        $image = imagecreatefrompng($source);

    imagejpeg($image, $destination, $quality);

    return $destination;

}





$fromemail=$_SESSION['userid'];



if(trim($_POST['action'])=='updateProfile' && trim($_POST['firstName'])!=''){  

$firstName=addslashes($_POST['firstName']);  

$lastName=addslashes($_POST['lastName']);  



$submitName=addslashes($_POST['submitName']);   



$phone=addslashes($_POST['phone']);   



$address=addslashes($_POST['address']);  

$website=addslashes($_POST['website']);  



$countryCode=addslashes($_POST['countryCode']);  



$mobile=addslashes($_POST['mobile']);   



$emailsignature=addslashes($_POST['emailsignature']);



$oldphoto=addslashes($_POST['oldchangeprofilepic']);

$submitName=addslashes($_POST['submitName']);



$editid=decode($_POST['editId']); 







   







if($_FILES["changeprofilepic"]["tmp_name"]!=""){ 
$rt=mt_rand().strtotime(date("YMDHis")); 
$companyLogoFileName=basename($_FILES['changeprofilepic']['name']); 
$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION); 
$profilePhoto=time().$rt.'.'.$companyLogoFileExtension;  
move_uploaded_file($_FILES["changeprofilepic"]["tmp_name"], "profilepic/{$profilePhoto}"); 
}



 



if($profilePhoto==''){



$profilePhoto=$oldphoto;



}















$namevalue ='phone="'.$phone.'",profilePhoto="'.$profilePhoto.'",mobile="'.$mobile.'",address="'.$address.'",website="'.$website.'",submitName="'.$submitName.'",countryCode="'.$countryCode.'",firstName="'.$firstName.'",lastName="'.$lastName.'"'; 



 



$where='id="'.$editid.'"';  



updatelisting('sys_userMaster',$namevalue,$where);  

?> 



<script> 

parent.redirectpage('display.html?ga=myprofile&save=1');

</script>





<?php



 



}

if($_POST['action']=='addpnr' && $_POST['fromcitydesti']!="" && $_POST['tocitydesti']!="" && $_POST['airline_id']!="" && $_POST['flight_no']!="" && $_POST['fromdate']!="" && $_POST['todate']!="" && $_POST['route']!="" && $_POST['departure_time']!="" && $_POST['arrival_time']!=""){


$fromdesti=explode(" - ", $_POST['fromcitydesti']);
$todesti=explode(" - ", $_POST['tocitydesti']);

$fromCode=$fromdesti[0];
$fromDestination=$fromdesti[1];

$toCode=$todesti[0];
$toDestination=$todesti[1];

$fromcitydesti=addslashes($_POST['fromcitydesti']);
$tocitydesti=addslashes($_POST['tocitydesti']);

$airline_id=addslashes($_POST['airline_id']);

$flight_no=addslashes($_POST['flight_no']);
$terminal=addslashes($_POST['terminal']);
$checkinBaggage=addslashes($_POST['checkinBaggage']);
$cabinBaggage=addslashes($_POST['cabinBaggage']);
$departure_time=addslashes($_POST['departure_time']);

$arrival_time=addslashes($_POST['arrival_time']);

$route=addslashes($_POST['route']);

$fromdate=addslashes($_POST['fromdate']);

$todate=addslashes($_POST['todate']);

$flight_pnr_status=addslashes($_POST['flight_pnr_status']);

$is_approve=0;





//-------ADD-----------

$namevalue ='fromCode="'.$fromCode.'",fromDestination="'.$fromDestination.'",toCode="'.$toCode.'",toDestination="'.$toDestination.'",airline_id="'.$airline_id.'",flight_no="'.$flight_no.'",departure_time="'.$departure_time.'",arrival_time="'.$arrival_time.'",route="'.$route.'",fromdate="'.$fromdate.'",todate="'.$todate.'",flight_pnr_status="'.$flight_pnr_status.'",is_approve="'.$is_approve.'",addedDate="'.date('Y-m-d H:i:s').'",addedBy="'.$_SESSION['userid'].'"';

$flight_id=addlistinggetlastid('fixdeparture_flight',$namevalue);







      
$count=count($_POST["travel_date"]);



for($i=0;$i<$count;$i++){

$fromdate=date("Y-m-d",strtotime($fromdate));

$fromdate=date('Y-m-d',strtotime($fromdate . ' +'.$i.' day'));


$flight_id=addlistinggetlastid('fixdeparture_flight',$namevalue);


	$namevalue1='terminal="'.$terminal.'",checkinBaggage="'.$checkinBaggage.'",cabinBaggage="'.$cabinBaggage.'",flight_id="'.$flight_id.'",travel_date="'.$fromdate.'",pnr="'.$_POST["pnr"][$i].'",qty="'.$_POST["qty"][$i].'",fare="'.$_POST["fare"][$i].'",pnr_status="'.$_POST["pnr_status"][$i].'",addedDate="'.date('Y-m-d H:i:s').'",addedBy="'.$_SESSION['userid'].'"';

	$pnr_details_id=addlistinggetlastid('pnr_details',$namevalue1);

}

?> 
<script> 
parent.redirectpage('display.html?ga=pnrrecords&save=1');
</script> 
<?php 
  
exit();

}


if($_REQUEST['action']=='savepnrdata' && $_REQUEST['id']!='' ){

$id=$_REQUEST['id']; 

$fid=$_REQUEST['fid']; 

$travelDate=date('Y-m-d', strtotime($_REQUEST['travelDate']));
$pnrNo=$_REQUEST['pnrNo'];
$fare=$_REQUEST['fare'];
$block=$_REQUEST['block'];
$qty=$_REQUEST['qty'];
$flight_no=$_REQUEST['flight_no'];

$namevalue ='travel_date="'.$travelDate.'", pnr="'.$pnrNo.'" , fare="'.$fare.'", block="'.$block.'", qty="'.$qty.'" ';  

$where='id="'.$id.'" ';

updatelisting('pnr_details',$namevalue,$where); 

?>

<script>

parent.redirectpage('display.html?ga=faremanagement&save=1');

</script>

<?php 

} 

 





if(trim($_POST['action'])=='setlogoandinclusion'){ 

 

$inclusion=addslashes($_POST['inclusion']);  

$leadURL=addslashes($_POST['leadURL']);  



$paymentAPIKey=addslashes($_POST['paymentAPIKey']);  

$paymentAPISecret=addslashes($_POST['paymentAPISecret']);  

 

$invoiceTerms=addslashes($_POST['invoiceTerms']);  

$packageImportantTips=addslashes($_POST['packageImportantTips']);   

$oldphoto=addslashes($_POST['oldchangeprofilepic']);   

 

if($_FILES["changeprofilepic"]["tmp_name"]!=""){ 

$rt=mt_rand().strtotime(date("YMDHis")); 

$companyLogoFileName=basename($_FILES['changeprofilepic']['name']); 

$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION); 

$profilePhoto=time().$rt.'.'.$companyLogoFileExtension; 

move_uploaded_file($_FILES["changeprofilepic"]["tmp_name"], "profilepic/{$profilePhoto}"); 

}



 



if($profilePhoto==''){ 

$profilePhoto=$oldphoto; 

}



 

$namevalue ='inclusion="'.$inclusion.'",invoiceLogo="'.$profilePhoto.'",invoiceTerms="'.$invoiceTerms.'",leadURL="'.$leadURL.'",packageImportantTips="'.$packageImportantTips.'",paymentAPIKey="'.$paymentAPIKey.'",paymentAPISecret="'.$paymentAPISecret.'"';  

$where='id="'.$_SESSION['userid'].'"';   

updatelisting('sys_userMaster',$namevalue,$where);  

?> 



<script> 

parent.redirectpage('<?php echo $fullurl; ?>display.html?ga=defaultsettings&save=1');

</script>





<?php



 



}













if(trim($_REQUEST['action'])=='changetheme' && $_SESSION['userid']!='' && $_REQUEST['ccolor']!=''){    

$where='id="'.$_SESSION['userid'].'"';    

updatelisting('sys_userMaster','themeColor="#'.$_REQUEST['ccolor'].'"',$where);   

} 

 

 

 

 

 

 

 

 if(trim($_POST['action'])=='addstaff' && trim($_POST['firstName'])!='' && trim($_POST['lastName'])!='' && trim($_POST['email'])!=''){  

include "config/mail.php"; 

$email=addslashes($_POST['email']); 

$branchId=addslashes($_POST['branchId']);  

$phone=addslashes($_POST['phone']);  

$userType=addslashes($_POST['userType']);  

$mobile=addslashes($_POST['mobile']);  

$city=addslashes($_POST['city']);  

$state=addslashes($_POST['stateId']);   

$country=addslashes($_POST['countryId']); 

$firstName=addslashes($_POST['firstName']);   

$lastName=addslashes($_POST['lastName']); 

$countryCode=addslashes($_POST['countryCode']); 

$status=($_POST['status']);  

$countryCode=addslashes($_POST['countryCode']); 

$profile=addslashes($_POST['profile']);  

$profile=addslashes($_POST['profile']);  

$showQueryStatus=addslashes($_POST['showQueryStatus']); 

$editid=decode($_POST['editId']); 



$permissionView='';

foreach($_POST['permissionView'] as $check) { 

		 $permissionView.=$check.',';

}



$permissionAddEdit='';

foreach($_POST['permissionAddEdit'] as $check) { 

		 $permissionAddEdit.=$check.',';

}



$randPass = rand(999999,100000);

 

$ccmail=''; 

$file_name='';





$a=GetPageRecord('*','sys_userMaster','  id=1');  

$invoiceData=mysqli_fetch_array($a);



$subject = strip($invoiceData['invoiceCompany']).' Assistance';



$mailbody='Dear '.$firstName.',<br /><br />

You have received this communication in response to the request for your '.strip($invoiceData['invoiceCompany']).' System account password to be sent to you via e-mail.<br /><br />

Temporary Password: '.$randPass.'<br /><br />

Please change your password as soon as possible, to ensure total privacy and confidentiality.<br /><br /> 

If you did not request for your password to be reset, please contact us at

'.$invoiceData['invoicePhone'].' or email us at '.$invoiceData['invoiceEmail'].'<br /><br />    

We hope to see you onboard again soon!<br /><br /> 

'.strip($invoiceData['emailsignature']).'';







  

if($_FILES["changeprofilepic"]["tmp_name"]!=""){ 

$rt=mt_rand().strtotime(date("YMDHis")); 

$companyLogoFileName=basename($_FILES['changeprofilepic']['name']); 

$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION); 

$profilePhoto=time().$rt.'.'.$companyLogoFileExtension;  

move_uploaded_file($_FILES["changeprofilepic"]["tmp_name"], "profilepic/{$profilePhoto}");  

} 

if($profilePhoto==''){ 

$profilePhoto=$oldphoto; 

} 



$a=GetPageRecord('*','sys_userMaster','email="'.$email.'" and (userType=1 or userType=2)');  

$validateemail=mysqli_fetch_array($a); 



if($editid!=''){ 



if($_POST['sendpass']==1){

$password = md5($randPass);

}else{

$password = $validateemail['password'];

}





$namevalue ='showQueryStatus="'.$showQueryStatus.'",email="'.$email.'",branchId="'.$branchId.'",password="'.$password.'",firstName="'.$firstName.'",lastName="'.$lastName.'",status="'.$status.'",userType="'.$userType.'",dateAdded="'.date('Y-m-d H:i:s').'",addedBy="'.$_SESSION['userid'].'",permissionView="'.rtrim($permissionView,',').'",permissionAddEdit="'.rtrim($permissionAddEdit,',').'"';  

$where='id="'.$editid.'"';    

updatelisting('sys_userMaster',$namevalue,$where);  

$lstaddid=$editid;



if($_POST['sendpass']==1){

send_attachment_mail($fromemail,$email,$subject,$mailbody,$ccmail.','.$_SESSION['username'],$file_name);

}



 

} else { 

if($validateemail['id']==''){ 

$namevalue ='email="'.$email.'",firstName="'.$firstName.'",branchId="'.$branchId.'",lastName="'.$lastName.'",status="'.$status.'",userType="'.$userType.'",password="'.$password.'",dateAdded="'.date('Y-m-d H:i:s').'",addedBy="'.$_SESSION['userid'].'",permissionView="'.rtrim($permissionView,',').'",permissionAddEdit="'.rtrim($permissionAddEdit,',').'"';  

$lstaddid=addlistinggetlastid('sys_userMaster',$namevalue);  



send_attachment_mail($fromemail,$email,$subject,$mailbody,$ccmail.','.$_SESSION['username'],$file_name);







} else { 

?> 

<script>alert('This email is already exists!');  

parent.$('.animated-progess').hide(); 

parent.$('#stoppagediv').hide();  

</script> 

<?php 

exit(); 

} 

} 





?> 

<script> 

parent.redirectpage('display.html?ga=team&save=1'); 

</script> 

<?php 

}



 

 

 

 

 



if(trim($_POST['action'])=='organisationsettings' && trim($_POST['invoiceCompany'])!='' && trim($_POST['invoiceEmail'])!='' && trim($_POST['invoicePhone'])!='' && trim($_POST['invoiceAddress'])!=''){   

$invoiceCompany=addslashes($_POST['invoiceCompany']);  

$invoiceEmail=addslashes($_POST['invoiceEmail']);  

$invoicePhone=addslashes($_POST['invoicePhone']);  

$invoiceAddress=addslashes($_POST['invoiceAddress']);    

$Invoicegstn=addslashes($_POST['Invoicegstn']);    

$invoiceState=addslashes($_POST['invoiceState']);    

$invoiceStateCode=addslashes($_POST['invoiceStateCode']);    

$manualVoucherPin=addslashes($_POST['manualVoucherPin']);





$namevalue ='invoiceCompany="'.$invoiceCompany.'",invoiceEmail="'.$invoiceEmail.'",invoicePhone="'.$invoicePhone.'",invoiceAddress="'.$invoiceAddress.'",Invoicegstn="'.$Invoicegstn.'",invoiceState="'.$invoiceState.'",invoiceStateCode="'.$invoiceStateCode.'",manualVoucherPin="'.$manualVoucherPin.'"';  

$where='id="'.$_SESSION['userid'].'"';    

updatelisting('sys_userMaster',$namevalue,$where);   





?> 

<script> 

parent.redirectpage('display.html?ga=setting&save=1'); 

</script> 

<?php 

}



 

 

 

 

 

 

 





if(trim($_POST['action'])=='updatePassword' && trim($_POST['oldpassword'])!='' && trim($_POST['newpassword'])!='' && trim($_POST['repassword'])!=''){  







$oldpassword=trim($_POST['oldpassword']);  



$newpassword=trim($_POST['newpassword']);  



$repassword=trim($_POST['repassword']);    



$editid=decode($_POST['editId']);  







$a=GetPageRecord('*','sys_userMaster','password="'.md5($oldpassword).'"');  



if(mysqli_num_rows($a)>0){ 







if($newpassword==$repassword){ 



$namevalue ='password="'.md5($newpassword).'",dateAdded="'.time().'",addedBy="'.$_SESSION['userid'].'"';  



$where='id="'.$editid.'"';    



updatelisting('sys_userMaster',$namevalue,$where); 



?> 



<script>alert('Password updated successfully!');</script> 



<?php



}else{ 



?> 



<script>alert('Confirm password did not match...!');</script> 



<?php 



exit(); 



} 



}else{ 



?> 



<script>alert('Old password incorrect...! Please try again.');</script> 



<?php 



exit(); 



} 



?> 



<script> 



parent.redirectpage('display.html?ga=myprofile&save=1'); 



</script> 



<?php 



} 



// if(trim($_POST['action'])=='getotp' && trim($_POST['firstname'])!='' && trim($_POST['mobile'])!='' && trim($_POST['countryCode'])!=''){   
   
//   $countryCode=addslashes($_POST['countryCode']);  
//   $firstname=addslashes($_POST['firstname']); 
//   $mobile=addslashes($_POST['mobile']); 
//   $source="website"; 
  
//   $namevalue =' firstname="'.$firstname.'", countryCode="'.$countryCode.'", mobile="'.$mobile.'", source="'.$source.'" ';     
  
//   addlistinggetlastid('userMaster',$namevalue);   
  
//   ?> 
// <script> 
//   alert('success');
//   parent.redirectpage('<?php //echo $fullurlweb; ?>packages-itinerary'); 
// </script> 
// <?php 
//   }







 if(trim($_POST['action'])=='addtineraries' && trim($_POST['name'])!='' && trim($_POST['startDate'])!='' && trim($_POST['endDate'])!=''){   

 

$name=addslashes($_POST['name']);  

$queryid=addslashes($_POST['queryid']);  

$startDate=date('Y-m-d',strtotime($_POST['startDate']));  

$endDate=date('Y-m-d',strtotime($_POST['endDate']));  

$websiteValidity=date('Y-m-d',strtotime($_POST['websiteValidity']));  

$adult=addslashes($_POST['adult']);  

$child=addslashes($_POST['child']);  

$destinations=addslashes($_POST['destinations']);  

$aboutPackage=addslashes($_POST['aboutPackage']);   

$packageThemeId=addslashes($_POST['packageThemeId']);   

if($_FILES["image"]["tmp_name"]!=""){
  $rt=time(); 
  $companyLogoFileName=basename($_FILES['image']['name']); 
  $companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION); 
  $profilePhoto=str_replace(' ','_',substr($companyLogoFileName, 0, strpos($companyLogoFileName, ".")).$rt.'.'.$companyLogoFileExtension); 
  move_uploaded_file($_FILES["image"]["tmp_name"], "package_image/{$profilePhoto}");  
}else{
  $profilePhoto=$_REQUEST['oldlogo'];
}

$showwebsite=addslashes($_POST['showwebsite']);   

$websiteCost=addslashes($_POST['websiteCost']);   

$showinPopular=addslashes($_POST['showinPopular']);   

$showinSpecial=addslashes($_POST['showinSpecial']);   

$activeImageGallery=addslashes($_POST['activeImageGallery']);   

$notes=addslashes($_POST['notes']);    

$editId=addslashes($_POST['editId']);  



if($_POST['queryid']!=''){

$queryId=decode($_POST['queryid']);  

} else {  

$queryId=0;

}







$abcd=GetPageRecord('*','sys_userMaster','id="'.$_SESSION['userid'].'" or addedBy="'.$_SESSION['userid'].'"'); 

$inclusiondata=mysqli_fetch_array($abcd); 







$days=daysbydates($startDate,$endDate)+1;

 

if($editId!=''){ 

 

$namevalue ='name="'.$name.'",startDate="'.$startDate.'",endDate="'.$endDate.'",adult="'.$adult.'",child="'.$child.'",days="'.$days.'",websiteCost="'.$websiteCost.'",websiteValidity="'.$websiteValidity.'",showwebsite="'.$showwebsite.'",destinations="'.$destinations.'",aboutPackage="'.$aboutPackage.'",packageThemeId="'.$packageThemeId.'",showinPopular="'.$showinPopular.'",showinSpecial="'.$showinSpecial.'",notes="'.$notes.'",dateAdded="'.date('Y-m-d H:i:s').'",image="'.$profilePhoto.'",activeImageGallery="'.$activeImageGallery.'"';  

$where='id="'.decode($editId).'"';    

updatelisting('sys_packageBuilder',$namevalue,$where);  

$lstaddid=decode($editId);

$packagelastid=decode($editId);


$b=0;

$a=GetPageRecord('*','sys_packageBuilderEvent','packageId="'.decode($editId).'" group by startDate order by startDate asc');  

while($result=mysqli_fetch_array($a)){



if($result['sectionType']!='Accommodation'){

 updatelisting('sys_packageBuilderEvent','startDate="'.date('Y-m-d',strtotime($_POST['startDate'].' + '.$b.' days')).'",endDate="'.date('Y-m-d',strtotime($_POST['startDate'].' + '.$b.' days')).'"','packageId="'.decode($editId).'" and sectionType!="Accommodation" and startDate="'.$result['startDate'].'"');  

}

if($result['sectionType']=='Accommodation'){

$days=0;

if($result['days']>1){

$days=$result['days']+1;

}else{

$days=$result['days'];

}



 updatelisting('sys_packageBuilderEvent','startDate="'.date('Y-m-d',strtotime($_POST['startDate'].' + '.$b.' days')).'",endDate="'.date('Y-m-d',strtotime($_POST['startDate'].' + '.$days.' days')).'"','packageId="'.decode($editId).'" and sectionType="Accommodation" and startDate="'.$result['startDate'].'"'); 

}

$b++;

}

 

} else { 

 

$namevalue ='name="'.$name.'",startDate="'.$startDate.'",packageThemeId="'.$packageThemeId.'",aboutPackage="'.$aboutPackage.'",websiteValidity="'.$websiteValidity.'",showinPopular="'.$showinPopular.'",showinSpecial="'.$showinSpecial.'",endDate="'.$endDate.'",adult="'.$adult.'",websiteCost="'.$websiteCost.'",showwebsite="'.$showwebsite.'",child="'.$child.'",days="'.$days.'",queryId="'.$queryId.'",destinations="'.$destinations.'",notes="'.$notes.'",dateAdded="'.date('Y-m-d H:i:s').'",addedBy="'.$_SESSION['userid'].'",inclusionExclusion="'.addslashes($inclusiondata['inclusion']).'",terms="'.addslashes($inclusiondata['invoiceTerms']).'",baseMarkup="10",image="'.$profilePhoto.'",activeImageGallery="'.$activeImageGallery.'"';   

$lstaddid=addlistinggetlastid('sys_packageBuilder',$namevalue);   

$packagelastid=$lstaddid;



$rs=GetPageRecord($select,'sys_userMaster','id=1 '); 

$editresult=mysqli_fetch_array($rs);

 

$namevalue ='packageId="'.$lstaddid.'",title="'.addslashes($editresult['inclusionsTitle']).'",description="'.addslashes($editresult['packageInclusions']).'",iconset="'.$editresult['inclusionsImg'].'"';   

addlistinggetlastid('sys_PackageTips',$namevalue);  

  

$namevalue ='packageId="'.$lstaddid.'",title="'.addslashes($editresult['importantTipsTitle']).'",description="'.addslashes($editresult['packageImportantTips']).'",iconset="'.$editresult['impTipsImg'].'"';   

addlistinggetlastid('sys_PackageTips',$namevalue);

  

$namevalue ='packageId="'.$lstaddid.'",title="'.addslashes($editresult['exclusionsTitle']).'",description="'.addslashes($editresult['packageExclusions']).'",iconset="'.$editresult['exclusionsImg'].'"';   

addlistinggetlastid('sys_PackageTips',$namevalue);

  

$namevalue ='packageId="'.$lstaddid.'",title="'.addslashes($editresult['travelInformationTitle']).'",description="'.addslashes($editresult['packageTravelInfo']).'",iconset="'.$editresult['travelInfoImg'].'"';   

addlistinggetlastid('sys_PackageTips',$namevalue);

 


} 




 
?> 

<script> 

 

parent.redirectpage('display.html?ga=itineraries&view=1&id=<?php echo encode($lstaddid); ?>&save=1'); 

</script> 

<?php 

}




// changes by jitesh

if(trim($_POST['action'])=='addCruiseMaster' && trim($_POST['name'])!=''){   
   
  $name=addslashes($_POST['name']);  
  $tagline1=addslashes($_POST['tagline1']);  
  $tagline2=addslashes($_POST['tagline2']);  
  $tagline3=addslashes($_POST['tagline3']);  
  $destinationId=addslashes($_POST['destinationId']);  
  $cruiseRoute=addslashes($_POST['cruiseRoute']);  
  $description=addslashes($_POST['description']);    
  $packageDetails=addslashes($_POST['packageDetails']);   
  $status=addslashes($_POST['status']);   
  $editId=addslashes($_POST['editId']);  

  // if($_FILES["image"]["tmp_name"]!=""){
  //       $rt=time(); 
  //       $companyLogoFileName=basename($_FILES['image']['name']); 
  //       $companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION); 
  //       $profilePhoto=str_replace(' ','_',substr($companyLogoFileName, 0, strpos($companyLogoFileName, ".")).$rt.'.'.$companyLogoFileExtension); 
  //       move_uploaded_file($_FILES["image"]["tmp_name"], "package_image/{$profilePhoto}");  
  //    }else{
  //       $profilePhoto=$_REQUEST['oldlogo'];
  //    }
  
  if($editId!=''){ 
  
  $namevalue ='name="'.$name.'", packageDetails="'.$packageDetails.'", description="'.$description.'", tagline1="'.$tagline1.'", tagline2="'.$tagline2.'", tagline3="'.$tagline3.'", destinationId="'.$destinationId.'", cruiseRoute="'.$cruiseRoute.'", status="'.$status.'", addedBy="'.$_SESSION['userid'].'" ';  
  
  $where='id="'.decode($editId).'"';    
  
  updatelisting('sys_cruiseBuilder',$namevalue,$where);  
  
  $lstaddid=decode($editId);
  
  $packagelastid=decode($editId);
 
  } else { 
  
  $namevalue ='name="'.$name.'", packageDetails="'.$packageDetails.'", description="'.$description.'", destinationId="'.$destinationId.'",cruiseRoute="'.$cruiseRoute.'",tagline1="'.$tagline1.'", tagline2="'.$tagline2.'", tagline3="'.$tagline3.'", status="'.$status.'",addedBy="'.$_SESSION['userid'].'"';   
  
  $lstaddid=addlistinggetlastid('sys_cruiseBuilder',$namevalue);   
  
  $packagelastid=$lstaddid;
} 

?> 
<script> parent.redirectpage('display.html?ga=cruise&save=1'); </script> 
<?php 
}




if(trim($_POST['action'])=='addCruiseCabin' && trim($_POST['name'])!=''){   
  
  $name=addslashes($_POST['name']);  
  $subline=addslashes($_POST['subline']);  
  $occupancy=addslashes($_POST['occupancy']); 
  $cruiseId=addslashes($_POST['cruiseId']);  
  $status=addslashes($_POST['status']);  
  $editId=addslashes($_POST['editId']);  
  
  if($editId!=''){ 
  
  $namevalue =' name="'.$name.'", subline="'.$subline.'", occupancy="'.$occupancy.'",cruiseId="'.$cruiseId.'" ,status="'.$status.'"  ';  
  
  $where='id="'.decode($editId).'"';    
  
  updatelisting('cruiseCabinMaster',$namevalue,$where);  
  
  $lstaddid=decode($editId);
  
  $packagelastid=decode($editId);
 
  } else { 
  
  $namevalue ='name="'.$name.'", subline="'.$subline.'", occupancy="'.$occupancy.'",cruiseId="'.$cruiseId.'" ,status="'.$status.'" ';   
  
  $lstaddid=addlistinggetlastid('cruiseCabinMaster',$namevalue);   
  
  $packagelastid=$lstaddid;
} 

?> 
<script> parent.redirectpage('display.html?ga=cabin&cruiseId=<?php echo encode($cruiseId); ?>'); </script> 
<?php 
}


if(trim($_POST['action'])=='addCabinPrice' && trim($_POST['startDate'])!=''){   
  
  $startDate=date('Y-m-d', strtotime($_POST['startDate']));  
  $endDate=date('Y-m-d', strtotime($_POST['endDate']));  
  $adultCost=addslashes($_POST['adultCost']); 
  $childCost=addslashes($_POST['childCost']); 
  $infantCost=addslashes($_POST['infantCost']);  
  $cabinId=addslashes($_POST['cabinId']);  
  $cruiseId=addslashes($_POST['cruiseId']);  
  $editId=addslashes($_POST['editid']);  
  
  if($editId!=''){ 
  
  $namevalue =' startDate="'.$startDate.'", endDate="'.$endDate.'", adultCost="'.$adultCost.'", childCost="'.$childCost.'", infantCost="'.$infantCost.'", cabinId="'.$cabinId.'", cruiseId="'.$cruiseId.'" ';  
  
  $where='id="'.decode($editId).'"';    
  
  updatelisting('cabinPriceList',$namevalue,$where);  
  
  $lstaddid=decode($editId);
  
  $packagelastid=decode($editId);
 
  } else { 
  
  $namevalue =' startDate="'.$startDate.'", endDate="'.$endDate.'", paxCost="'.$paxCost.'", infantCost="'.$infantCost.'", cabinId="'.$cabinId.'", cruiseId="'.$cruiseId.'" ';   
  
  $lstaddid=addlistinggetlastid('cabinPriceList',$namevalue);   
  
  $packagelastid=$lstaddid;
} 

?> 
<script> parent.redirectpage('display.html?ga=cabin&cruiseId=<?php echo encode($cruiseId); ?>'); </script> 
<?php 
}

// changes by jitesh end









 if(trim($_POST['action'])=='confirmitineararies' && trim($_POST['editId'])!='' && trim($_POST['queryid'])!=''){   

 

 

$namevalue ='confirmQuote=0,confirmedBy="",confirmDate=""';  

$where='queryId="'.decode($_POST['queryid']).'"';    

updatelisting('sys_packageBuilder',$namevalue,$where); 

 



$namevalue ='packageId="'.decode($_POST['editId']).'"';  

$where='queryId="'.decode($_POST['queryid']).'"';    

updatelisting('sys_invoiceMaster',$namevalue,$where); 



$namevalue ='packageId="'.decode($_POST['editId']).'"';  

$where='queryId="'.decode($_POST['queryid']).'"';    

updatelisting('sys_PackagePayment',$namevalue,$where); 



 

 

$namevalue ='confirmQuote=1,confirmedBy="'.$_SESSION['userid'].'",confirmDate="'.date('Y-m-d H:i:s').'"';  

$where='id="'.decode($_POST['editId']).'"';    

updatelisting('sys_packageBuilder',$namevalue,$where); 

 

updatelisting('queryMaster','statusid=9','id="'.decode($_POST['queryid']).'"');  

 

?> 

<script> 

parent.redirectpage('display.html?ga=query&view=1&id=<?php echo $_POST['queryid']; ?>&c=2&save=1'); 

</script> 

<?php 

}

   

 

 

 

 

 if(trim($_POST['action'])=='confirmtask' && trim($_POST['editId'])!='' && trim($_POST['qid'])!=''){   

 

$namevalue ='makeDone=1,confirmDate="'.date('Y-m-d H:i:s').'"';  

$where='id="'.decode($_POST['editId']).'" and queryId="'.decode($_POST['qid']).'"';    

updatelisting('queryTask',$namevalue,$where);  

 

?> 

<script> 

parent.redirectpage('display.html?ga=query&view=1&id=<?php echo $_REQUEST['qid']; ?>&c=3&save=1'); 

</script> 

<?php 

}



 

 

 

 

 if(trim($_POST['action'])=='addAccommodation' && trim($_POST['hotelName'])!='' && trim($_POST['hotelRoom'])!='' && trim($_POST['startDate'])!='' && trim($_POST['endDate'])!=''){ 

 





  

$hotelName=addslashes($_POST['hotelName']);  

$photo=addslashes($_POST['photo']);  

$startDate=date('Y-m-d',strtotime($_POST['startDate']));  

$endDate=date('Y-m-d',strtotime($_POST['endDate']));  

$hotelRoom=addslashes($_POST['hotelRoom']);  

 

 

$hotelCategory=addslashes($_POST['hotelCategory']);  

$mealPlan=addslashes($_POST['mealPlan']);   

$singleRoom=addslashes($_POST['singleRoom']);  

$doubleRoom=addslashes($_POST['doubleRoom']);  

$tripleRoom=addslashes($_POST['tripleRoom']);  

$quadRoom=addslashes($_POST['quadRoom']);  

$cwbRoom=addslashes($_POST['cwbRoom']);  

$cnbRoom=addslashes($_POST['cnbRoom']);  

$checkIn=addslashes($_POST['checkIn']);  

$checkOut=addslashes($_POST['checkOut']);   

$description=addslashes($_POST['description']);  

$showTime=addslashes($_POST['showTime']);  

$pid=decode($_POST['pid']);   

$editId=addslashes($_POST['editId']);  

$packageDays=addslashes($_POST['packageDays']);  

$destinationName=addslashes(trim($_POST['destinationName']));



$days=daysbydates($startDate,$endDate);

if($days==0){ $days=1; }



$addprice='';

$pricetype=addslashes($_POST['pricetype']); 

if($pricetype==2){

$hotelnamemaster=addslashes($_POST['hotelnamemaster']);

 

$a=GetPageRecord('*','hotelMaster','id="'.$hotelnamemaster.'"');  

$resulthot=mysqli_fetch_array($a);

$hotelName=$resulthot['name'];

 

 



$hotelPriceId=addslashes($_POST['hotelPriceId']); 

 

$ab=GetPageRecord('*','hotelRateList','id="'.$hotelPriceId.'" ');  

$data=mysqli_fetch_array($ab);



  $addprice=',singleRoomCost="'.($data['single']*$days).'",doubleRoomCost="'.($data['doublePrice']*$days).'",tripleRoomCost="'.($data['triple']*$days).'",quadRoomCost="'.($data['quad']*$days).'",cwbRoomCost="'.($data['childBed']*$days).'",cnbRoomCost="'.($data['extraAdult']*$days).'"';

 

$hotelRoommaster=addslashes($_POST['hotelRoommaster']); 



$a=GetPageRecord('*','RoomTypeMaster','name="'.$hotelRoommaster.'"');  

$roomData=mysqli_fetch_array($a);

$hotelRoom=$roomData['name'];

 

$mealPlanmaster=addslashes($_POST['mealPlanmaster']); 



$a=GetPageRecord('*','mealPlanMaster','name="'.$mealPlanmaster.'"');   
$mealData=mysqli_fetch_array($a); 
$mealPlan=$mealData['name'];



}



$eventphotomain='';

if($photo!=''){

$eventphotomain=',eventPhoto="'.$photo.'"';

}







if($editId!=''){ 



$namevalue ='hotelType="'.$pricetype.'",hotelId="'.$hotelnamemaster.'",hotelPriceId="'.$hotelPriceId.'",name="'.$hotelName.'",startDate="'.$startDate.'",endDate="'.$endDate.'",description="'.$description.'",hotelRoom="'.$hotelRoom.'",hotelCategory="'.$hotelCategory.'",mealPlan="'.$mealPlan.'",singleRoom="'.$singleRoom.'",doubleRoom="'.$doubleRoom.'",tripleRoom="'.$tripleRoom.'",quadRoom="'.$quadRoom.'",cwbRoom="'.$cwbRoom.'",cnbRoom="'.$cnbRoom.'",checkIn="'.$checkIn.'",checkOut="'.$checkOut.'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.date('Y-m-d H:i:s').'",days="'.$days.'",destinationName="'.$destinationName.'",showTime="'.$showTime.'"'.$addprice.'';  

$where='id="'.decode($editId).'"';    

updatelisting('sys_packageBuilderEvent',$namevalue,$where);  



} else { 



$namevalue ='hotelType="'.$pricetype.'",hotelId="'.$hotelnamemaster.'",hotelPriceId="'.$hotelPriceId.'",name="'.$hotelName.'",packageId="'.$pid.'",packageDays="'.$packageDays.'",description="'.$description.'",startDate="'.$startDate.'",endDate="'.$endDate.'",hotelRoom="'.$hotelRoom.'",hotelCategory="'.$hotelCategory.'",mealPlan="'.$mealPlan.'",singleRoom="'.$singleRoom.'",doubleRoom="'.$doubleRoom.'",tripleRoom="'.$tripleRoom.'",quadRoom="'.$quadRoom.'",cwbRoom="'.$cwbRoom.'",cnbRoom="'.$cnbRoom.'",checkIn="'.$checkIn.'",checkOut="'.$checkOut.'",sectionType="Accommodation",addedBy="'.$_SESSION['userid'].'",days="'.$days.'",dateAdded="'.date('Y-m-d H:i:s').'",destinationName="'.$destinationName.'",showTime="'.$showTime.'"'.$addprice.''.$eventphotomain.'';   

$lstaddid=addlistinggetlastid('sys_packageBuilderEvent',$namevalue);   

 

} 





?> 

<script> 

parent.redirectpage('display.html?ga=itineraries&view=1&id=<?php echo $_REQUEST['pid']; ?>&pd=<?php echo $_REQUEST['packageDays']; ?>'); 

</script> 

<?php 

}













if(trim($_REQUEST['action'])=='deleteQuery' && trim($_REQUEST['deleteid'])!='' && $_SESSION['userid']==1){   



deleteRecord('queryMaster','id="'.decode($_REQUEST['deleteid']).'" '); 

deleteRecord('queryTask','queryId="'.decode($_REQUEST['deleteid']).'" '); 

deleteRecord('queryMail','queryId="'.decode($_REQUEST['deleteid']).'" '); 

deleteRecord('queryNotes','queryId="'.decode($_REQUEST['deleteid']).'" '); 

deleteRecord('queryNotes','queryId="'.decode($_REQUEST['deleteid']).'" '); 

deleteRecord('sys_voucherMaster','queryId="'.decode($_REQUEST['deleteid']).'" '); 

deleteRecord('sys_packageBuilderEvent',' packageId in (select id from sys_packageBuilder where  queryId="'.decode($_REQUEST['deleteid']).'") ');  

deleteRecord('sys_packageBuilder','queryId="'.decode($_REQUEST['deleteid']).'" '); 









?> 

<script> 

parent.redirectpage('display.html?ga=query&save=1'); 

</script> 

<?php 

}









if(trim($_REQUEST['action'])=='delteevent' && trim($_REQUEST['did'])!='' && trim($_REQUEST['pid'])!=''){   



$abcd=GetPageRecord('*','sys_packageBuilderEvent','id="'.decode($_REQUEST['did']).'"'); 

$result=mysqli_fetch_array($abcd);   

 

deleteRecord('sys_packageBuilderEvent','id="'.decode($_REQUEST['did']).'" and packageId="'.decode($_REQUEST['pid']).'"'); 







?> 

<script> 

parent.redirectpage('display.html?ga=itineraries&view=1&id=<?php echo $_REQUEST['pid']; ?>&pd=<?php echo $result['packageDays']; ?>&save=1'); 

</script> 

<?php 

}

























  if(trim($_POST['action'])=='addActivity' && trim($_POST['name'])!='' && trim($_POST['startDate'])!=''){   

 $packageDays=addslashes($_POST['packageDays']);

$hotelName=addslashes($_POST['name']);  

$showTime=addslashes($_POST['showTime']);  

$startDate=date('Y-m-d',strtotime($_POST['startDate']));  

$endDate=date('Y-m-d',strtotime($_POST['startDate']));  

$hotelRoom=addslashes($_POST['hotelRoom']);  

$hotelCategory=addslashes($_POST['hotelCategory']);  

$mealPlan=addslashes($_POST['mealPlan']);   

$singleRoom=addslashes($_POST['singleRoom']);  

$doubleRoom=addslashes($_POST['doubleRoom']);  

$tripleRoom=addslashes($_POST['tripleRoom']);  

$quadRoom=addslashes($_POST['quadRoom']);  

$cwbRoom=addslashes($_POST['cwbRoom']);  

$cnbRoom=addslashes($_POST['cnbRoom']);  

$checkIn=addslashes($_POST['checkIn']);  

$checkOut=addslashes($_POST['checkOut']);   

$pid=decode($_POST['pid']);   

$editId=addslashes($_POST['editId']);  

$description=addslashes($_POST['description']);  

$destinationName=addslashes(trim($_POST['destinationName']));

$days=daysbydates($startDate,$endDate)+1;

 

 

 

 $addprice='';

$pricetype=addslashes($_POST['pricetype']); 

if($pricetype==2){

$namemaster=addslashes($_POST['namemaster']);



$a=GetPageRecord('*','sightseeingMaster','id="'.$namemaster.'"');  

$resulthot=mysqli_fetch_array($a);

$hotelName=$resulthot['name'];

 

$hotelPriceId=addslashes($_POST['hotelPriceId']); 



$ab=GetPageRecord('*','sightseeingRateList','id="'.$hotelPriceId.'" ');  

$data=mysqli_fetch_array($ab);







$addprice=',adultCost="'.$data['adult'].'",childCost="'.$data['child'].'"'; 



}

 
 $eventphotomain='';

if($photo!=''){

$eventphotomain=',eventPhoto="'.$photo.'"';

}
 

 

 

 

if($editId!=''){ 



 

$namevalue ='hotelType="'.$pricetype.'",hotelId="'.$namemaster.'",hotelPriceId="'.$hotelPriceId.'",name="'.$hotelName.'",startDate="'.$startDate.'",endDate="'.$endDate.'",hotelRoom="'.$hotelRoom.'",description="'.$description.'",hotelCategory="'.$hotelCategory.'",mealPlan="'.$mealPlan.'",singleRoom="'.$singleRoom.'",doubleRoom="'.$doubleRoom.'",tripleRoom="'.$tripleRoom.'",quadRoom="'.$quadRoom.'",cwbRoom="'.$cwbRoom.'",cnbRoom="'.$cnbRoom.'",checkIn="'.$checkIn.'",checkOut="'.$checkOut.'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.date('Y-m-d H:i:s').'",days="'.$days.'",destinationName="'.$destinationName.'",showTime="'.$showTime.'"'.$addprice.'';  

$where='id="'.decode($editId).'"';    

updatelisting('sys_packageBuilderEvent',$namevalue,$where);  



} else { 



if($pricetype==2){

$description=$resulthot['details'];

}

 

$namevalue ='hotelType="'.$pricetype.'",hotelId="'.$hotelnamemaster.'",hotelPriceId="'.$hotelPriceId.'",name="'.$hotelName.'",packageId="'.$pid.'",startDate="'.$startDate.'",packageDays="'.$packageDays.'",description="'.$description.'",endDate="'.$endDate.'",hotelRoom="'.$hotelRoom.'",hotelCategory="'.$hotelCategory.'",mealPlan="'.$mealPlan.'",singleRoom="'.$singleRoom.'",doubleRoom="'.$doubleRoom.'",tripleRoom="'.$tripleRoom.'",quadRoom="'.$quadRoom.'",cwbRoom="'.$cwbRoom.'",cnbRoom="'.$cnbRoom.'",checkIn="'.$checkIn.'",checkOut="'.$checkOut.'",sectionType="Activity",addedBy="'.$_SESSION['userid'].'",days="'.$days.'",dateAdded="'.date('Y-m-d H:i:s').'",destinationName="'.$destinationName.'",showTime="'.$showTime.'"'.$addprice.''.$eventphotomain.'';   

$lstaddid=addlistinggetlastid('sys_packageBuilderEvent',$namevalue);   

 

} 





?> 

<script> 

parent.redirectpage('display.html?ga=itineraries&view=1&id=<?php echo $_REQUEST['pid']; ?>&pd=<?php echo $_REQUEST['packageDays']; ?>'); 

</script> 

<?php 

}














  if(trim($_POST['action'])=='addTransportation' && trim($_POST['name'])!='' && trim($_POST['startDate'])!='' && trim($_POST['transferCategory'])!=''){   

 $packageDays=addslashes($_POST['packageDays']);

$hotelName=addslashes($_POST['name']);  

$showTime=addslashes($_POST['showTime']);  

$startDate=date('Y-m-d',strtotime($_POST['startDate']));  

$endDate=date('Y-m-d',strtotime($_POST['startDate']));  

$hotelRoom=addslashes($_POST['hotelRoom']);  

$hotelCategory=addslashes($_POST['hotelCategory']);  

$photo=addslashes($_POST['photo']); 

$mealPlan=addslashes($_POST['mealPlan']);   

$singleRoom=addslashes($_POST['singleRoom']);  

$doubleRoom=addslashes($_POST['doubleRoom']);  

$tripleRoom=addslashes($_POST['tripleRoom']);  

$quadRoom=addslashes($_POST['quadRoom']);  

$cwbRoom=addslashes($_POST['cwbRoom']);  

$cnbRoom=addslashes($_POST['cnbRoom']);  

$checkIn=addslashes($_POST['checkIn']);  

$checkOut=addslashes($_POST['checkOut']);  

$transferCategory=addslashes($_POST['transferCategory']);  

$destinationName=addslashes(trim($_POST['destinationName']));  

$pid=decode($_POST['pid']);   

$editId=addslashes($_POST['editId']);  

$description=addslashes($_POST['description']);  



$days=daysbydates($startDate,$endDate)+1;

 

 

 $eventphotomain='';

if($photo!=''){

$eventphotomain=',eventPhoto="'.$photo.'"';

}



 

 

$addprice='';

$pricetype=addslashes($_POST['pricetype']); 

if($pricetype==2){

$namemaster=addslashes($_POST['namemaster']);

 

$a=GetPageRecord('*','transferMaster','id="'.$namemaster.'"');  

$resulthot=mysqli_fetch_array($a);

$hotelName=$resulthot['name'];

 

$hotelPriceId=addslashes($_POST['hotelPriceId']); 

 

if($transferCategory=='SIC'){ $transferCategory=1; }

if($transferCategory=='Private'){ $transferCategory=2; }



$ab=GetPageRecord('*','transferRateList',' parentId="'.$resulthot['id'].'" and startDate<="'.$_REQUEST['day'].'" and transferType="'.$transferCategory.'" order by id desc');  

$data=mysqli_fetch_array($ab);

 if($data['transferType']==1){ 

$addprice=',adultCost="'.$data['adult'].'",childCost="'.$data['child'].'"'; 

}



if($data['transferType']==2){

$addprice=',vehicle="1",adultCost="'.$data['vehicleCost'].'"';

}

} 

 

 

 

 

 

 

if($editId!=''){ 

 

$namevalue ='hotelType="'.$pricetype.'",hotelId="'.$hotelnamemaster.'",hotelPriceId="'.$hotelPriceId.'",name="'.$hotelName.'",startDate="'.$startDate.'",endDate="'.$endDate.'",description="'.$description.'",transferCategory="'.$_POST['transferCategory'].'",hotelCategory="'.$hotelCategory.'",mealPlan="'.$mealPlan.'",singleRoom="'.$singleRoom.'",doubleRoom="'.$doubleRoom.'",tripleRoom="'.$tripleRoom.'",quadRoom="'.$quadRoom.'",cwbRoom="'.$cwbRoom.'",cnbRoom="'.$cnbRoom.'",checkIn="'.$checkIn.'",checkOut="'.$checkOut.'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.date('Y-m-d H:i:s').'",days="'.$days.'",destinationName="'.$destinationName.'",showTime="'.$showTime.'"'.$addprice.'';  

$where='id="'.decode($editId).'"';    

updatelisting('sys_packageBuilderEvent',$namevalue,$where);  



} else { 

 

$namevalue ='hotelType="'.$pricetype.'",hotelId="'.$hotelnamemaster.'",hotelPriceId="'.$hotelPriceId.'",name="'.$hotelName.'",packageId="'.$pid.'",startDate="'.$startDate.'",description="'.$description.'",packageDays="'.$packageDays.'",endDate="'.$endDate.'",transferCategory="'.$_POST['transferCategory'].'",hotelCategory="'.$hotelCategory.'",mealPlan="'.$mealPlan.'",singleRoom="'.$singleRoom.'",doubleRoom="'.$doubleRoom.'",tripleRoom="'.$tripleRoom.'",quadRoom="'.$quadRoom.'",cwbRoom="'.$cwbRoom.'",cnbRoom="'.$cnbRoom.'",checkIn="'.$checkIn.'",checkOut="'.$checkOut.'",sectionType="Transportation",addedBy="'.$_SESSION['userid'].'",days="'.$days.'",dateAdded="'.date('Y-m-d H:i:s').'",destinationName="'.$destinationName.'",showTime="'.$showTime.'"'.$addprice.''.$eventphotomain.'';   

$lstaddid=addlistinggetlastid('sys_packageBuilderEvent',$namevalue);   

 

} 





?> 

<script> 

parent.redirectpage('display.html?ga=itineraries&view=1&id=<?php echo $_REQUEST['pid']; ?>&pd=<?php echo $_REQUEST['packageDays']; ?>'); 

</script> 

<?php 

}













  if(trim($_POST['action'])=='addFeesInsurance' && trim($_POST['name'])!='' && trim($_POST['startDate'])!=''){   

 $packageDays=addslashes($_POST['packageDays']);

$hotelName=addslashes($_POST['name']);  

$startDate=date('Y-m-d',strtotime($_POST['startDate']));  

$endDate=date('Y-m-d',strtotime($_POST['startDate']));  

$hotelRoom=addslashes($_POST['hotelRoom']);  

$hotelCategory=addslashes($_POST['hotelCategory']);  

$mealPlan=addslashes($_POST['mealPlan']);   

$singleRoom=addslashes($_POST['singleRoom']);  

$doubleRoom=addslashes($_POST['doubleRoom']);  

$tripleRoom=addslashes($_POST['tripleRoom']);  

$quadRoom=addslashes($_POST['quadRoom']);  

$cwbRoom=addslashes($_POST['cwbRoom']);  

$cnbRoom=addslashes($_POST['cnbRoom']);  

$checkIn=addslashes($_POST['checkIn']);  

$checkOut=addslashes($_POST['checkOut']);   

$pid=decode($_POST['pid']);   

$editId=addslashes($_POST['editId']);  

$description=addslashes($_POST['description']);  

$destinationName=addslashes(trim($_POST['destinationName']));

$days=daysbydates($startDate,$endDate)+1;

 

if($editId!=''){ 

 

$namevalue ='name="'.$hotelName.'",startDate="'.$startDate.'",endDate="'.$endDate.'",description="'.$description.'",hotelRoom="'.$hotelRoom.'",hotelCategory="'.$hotelCategory.'",mealPlan="'.$mealPlan.'",singleRoom="'.$singleRoom.'",doubleRoom="'.$doubleRoom.'",tripleRoom="'.$tripleRoom.'",quadRoom="'.$quadRoom.'",cwbRoom="'.$cwbRoom.'",cnbRoom="'.$cnbRoom.'",checkIn="'.$checkIn.'",checkOut="'.$checkOut.'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.date('Y-m-d H:i:s').'",days="'.$days.'",destinationName="'.$destinationName.'"';  

$where='id="'.decode($editId).'"';    

updatelisting('sys_packageBuilderEvent',$namevalue,$where);  



} else { 

 

$namevalue ='name="'.$hotelName.'",packageId="'.$pid.'",startDate="'.$startDate.'",description="'.$description.'",packageDays="'.$packageDays.'",endDate="'.$endDate.'",hotelRoom="'.$hotelRoom.'",hotelCategory="'.$hotelCategory.'",mealPlan="'.$mealPlan.'",singleRoom="'.$singleRoom.'",doubleRoom="'.$doubleRoom.'",tripleRoom="'.$tripleRoom.'",quadRoom="'.$quadRoom.'",cwbRoom="'.$cwbRoom.'",cnbRoom="'.$cnbRoom.'",checkIn="'.$checkIn.'",checkOut="'.$checkOut.'",sectionType="FeesInsurance",addedBy="'.$_SESSION['userid'].'",days="'.$days.'",dateAdded="'.date('Y-m-d H:i:s').'",destinationName="'.$destinationName.'"';   

$lstaddid=addlistinggetlastid('sys_packageBuilderEvent',$namevalue);   

 

} 





?> 

<script> 

parent.redirectpage('display.html?ga=itineraries&view=1&id=<?php echo $_REQUEST['pid']; ?>&pd=<?php echo $_REQUEST['packageDays']; ?>'); 

</script> 

<?php 

}











  if(trim($_POST['action'])=='addOther' && trim($_POST['name'])!='' && trim($_POST['startDate'])!=''){   

 $packageDays=addslashes($_POST['packageDays']);



 

 

 

 

$hotelName=addslashes($_POST['name']);  

$startDate=date('Y-m-d',strtotime($_POST['startDate']));  

$endDate=date('Y-m-d',strtotime($_POST['startDate']));  

$hotelRoom=addslashes($_POST['hotelRoom']);  

$hotelCategory=addslashes($_POST['hotelCategory']);  

$mealPlan=addslashes($_POST['mealPlan']);   

$singleRoom=addslashes($_POST['singleRoom']);  

$doubleRoom=addslashes($_POST['doubleRoom']);  

$tripleRoom=addslashes($_POST['tripleRoom']);  

$quadRoom=addslashes($_POST['quadRoom']);  

$cwbRoom=addslashes($_POST['cwbRoom']);  

$cnbRoom=addslashes($_POST['cnbRoom']);  

$checkIn=addslashes($_POST['checkIn']);  

$checkOut=addslashes($_POST['checkOut']);   

$pid=decode($_POST['pid']);   

$editId=addslashes($_POST['editId']);  

$description=addslashes($_POST['description']); 



 $flightNo=addslashes($_POST['flightNo']);

 $fromDestination=addslashes($_POST['fromDestination']);

 $toDestination=addslashes($_POST['toDestination']);

 $flightDuration=addslashes($_POST['flightDuration']); 



$days=daysbydates($startDate,$endDate)+1;

 

if($editId!=''){ 

 

$namevalue ='name="'.$hotelName.'",startDate="'.$startDate.'",description="'.$description.'",endDate="'.$endDate.'",hotelRoom="'.$hotelRoom.'",hotelCategory="'.$hotelCategory.'",mealPlan="'.$mealPlan.'",singleRoom="'.$singleRoom.'",doubleRoom="'.$doubleRoom.'",tripleRoom="'.$tripleRoom.'",quadRoom="'.$quadRoom.'",cwbRoom="'.$cwbRoom.'",cnbRoom="'.$cnbRoom.'",checkIn="'.$checkIn.'",checkOut="'.$checkOut.'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.date('Y-m-d H:i:s').'",days="'.$days.'",flightNo="'.$flightNo.'",fromDestination="'.$fromDestination.'",toDestination="'.$toDestination.'",flightDuration="'.$flightDuration.'"';  

$where='id="'.decode($editId).'"';    

updatelisting('sys_packageBuilderEvent',$namevalue,$where);  



} else { 

 

$namevalue ='name="'.$hotelName.'",packageId="'.$pid.'",description="'.$description.'",startDate="'.$startDate.'",packageDays="'.$packageDays.'",endDate="'.$endDate.'",hotelRoom="'.$hotelRoom.'",hotelCategory="'.$hotelCategory.'",mealPlan="'.$mealPlan.'",singleRoom="'.$singleRoom.'",doubleRoom="'.$doubleRoom.'",tripleRoom="'.$tripleRoom.'",quadRoom="'.$quadRoom.'",cwbRoom="'.$cwbRoom.'",cnbRoom="'.$cnbRoom.'",checkIn="'.$checkIn.'",checkOut="'.$checkOut.'",sectionType="Flight",addedBy="'.$_SESSION['userid'].'",days="'.$days.'",dateAdded="'.date('Y-m-d H:i:s').'",flightNo="'.$flightNo.'",fromDestination="'.$fromDestination.'",toDestination="'.$toDestination.'",flightDuration="'.$flightDuration.'"';   

$lstaddid=addlistinggetlastid('sys_packageBuilderEvent',$namevalue);   

 

} 





?> 

<script> 

parent.redirectpage('display.html?ga=itineraries&view=1&id=<?php echo $_REQUEST['pid']; ?>&pd=<?php echo $_REQUEST['packageDays']; ?>'); 

</script> 

<?php 

}





















  if(trim($_POST['action'])=='addMeal' && trim($_POST['name'])!='' && trim($_POST['startDate'])!=''){   

 $packageDays=addslashes($_POST['packageDays']);

$hotelName=addslashes($_POST['name']);  

$startDate=date('Y-m-d',strtotime($_POST['startDate']));  

$endDate=date('Y-m-d',strtotime($_POST['startDate']));  

$hotelRoom=addslashes($_POST['hotelRoom']);  

$hotelCategory=addslashes($_POST['hotelCategory']);  

$mealPlan=addslashes($_POST['mealPlan']);   

$singleRoom=addslashes($_POST['singleRoom']);  

$doubleRoom=addslashes($_POST['doubleRoom']);  

$tripleRoom=addslashes($_POST['tripleRoom']);  

$quadRoom=addslashes($_POST['quadRoom']);  

$cwbRoom=addslashes($_POST['cwbRoom']);  

$cnbRoom=addslashes($_POST['cnbRoom']);  

$checkIn=addslashes($_POST['checkIn']);  

$checkOut=addslashes($_POST['checkOut']);   

$showTime=addslashes($_POST['showTime']);  

$pid=decode($_POST['pid']);   

$editId=addslashes($_POST['editId']);  

$mealCategory=addslashes($_POST['mealCategory']);  

$description=addslashes($_POST['description']);  

$destinationName=addslashes(trim($_POST['destinationName']));

$days=daysbydates($startDate,$endDate)+1;

 

if($editId!=''){ 

 

$namevalue ='name="'.$hotelName.'",startDate="'.$startDate.'",description="'.$description.'",endDate="'.$endDate.'",hotelRoom="'.$hotelRoom.'",hotelCategory="'.$hotelCategory.'",mealPlan="'.$mealPlan.'",singleRoom="'.$singleRoom.'",doubleRoom="'.$doubleRoom.'",tripleRoom="'.$tripleRoom.'",quadRoom="'.$quadRoom.'",mealCategory="'.$mealCategory.'",cwbRoom="'.$cwbRoom.'",cnbRoom="'.$cnbRoom.'",checkIn="'.$checkIn.'",checkOut="'.$checkOut.'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.date('Y-m-d H:i:s').'",days="'.$days.'",destinationName="'.$destinationName.'",showTime="'.$showTime.'"';  

$where='id="'.decode($editId).'"';    

updatelisting('sys_packageBuilderEvent',$namevalue,$where);  



} else { 

 

$namevalue ='name="'.$hotelName.'",packageId="'.$pid.'",description="'.$description.'",startDate="'.$startDate.'",packageDays="'.$packageDays.'",endDate="'.$endDate.'",hotelRoom="'.$hotelRoom.'",hotelCategory="'.$hotelCategory.'",mealPlan="'.$mealPlan.'",singleRoom="'.$singleRoom.'",doubleRoom="'.$doubleRoom.'",mealCategory="'.$mealCategory.'",tripleRoom="'.$tripleRoom.'",quadRoom="'.$quadRoom.'",cwbRoom="'.$cwbRoom.'",cnbRoom="'.$cnbRoom.'",checkIn="'.$checkIn.'",checkOut="'.$checkOut.'",sectionType="Meal",addedBy="'.$_SESSION['userid'].'",days="'.$days.'",dateAdded="'.date('Y-m-d H:i:s').'",destinationName="'.$destinationName.'",showTime="'.$showTime.'"';   

$lstaddid=addlistinggetlastid('sys_packageBuilderEvent',$namevalue);   

 

} 





?> 

<script> 

parent.redirectpage('display.html?ga=itineraries&view=1&id=<?php echo $_REQUEST['pid']; ?>&pd=<?php echo $_REQUEST['packageDays']; ?>'); 

</script> 

<?php 

}























if(trim($_POST['action'])=='editpricing' && trim($_POST['adultCost'])!='' && trim($_POST['editId'])!='' && trim($_POST['pid'])!=''){

      

$adultCost=addslashes(trim($_POST['adultCost']));  

$childCost=addslashes(trim($_POST['childCost']));   

$vehicle=addslashes(trim($_POST['vehicle']));

$markupPercent=addslashes(trim($_POST['markupPercent']));   

$editId=addslashes($_POST['editId']);   

      

	  

$rs2=GetPageRecord('*','currencyExchangeMaster','id=2 order by id asc');

$restsup=mysqli_fetch_array($rs2); 



 

$namevalue ='adultCost="'.$adultCost.'",childCost="'.$childCost.'",vehicle="'.$vehicle.'",markupPercent="'.$markupPercent.'",markupValue="'.$markupValue.'",currencyId="2",currencyValue="'.($restsup['rate']).'"';  

$where='id="'.decode($editId).'"';    

updatelisting('sys_packageBuilderEvent',$namevalue,$where);  



 



?> 

<script> 

parent.redirectpage('display.html?ga=itineraries&view=1&id=<?php echo $_POST['pid']; ?>&save=1&b=2'); 

</script> 

<?php 

}











if(trim($_POST['action'])=='editpricingAccommodation' && trim($_POST['editId'])!='' && trim($_POST['pid'])!=''){

      

$singleRoomCost=addslashes(trim($_POST['singleRoomCost']));  

$doubleRoomCost=addslashes(trim($_POST['doubleRoomCost']));  

$tripleRoomCost=addslashes(trim($_POST['tripleRoomCost']));  

$quadRoomCost=addslashes(trim($_POST['quadRoomCost']));  

$cwbRoomCost=addslashes(trim($_POST['cwbRoomCost']));  

$cnbRoomCost=addslashes(trim($_POST['cnbRoomCost']));   

$markupPercent=addslashes(trim($_POST['markupPercent']));   

$editId=addslashes($_POST['editId']);   

 

$rs2=GetPageRecord('*','currencyExchangeMaster','id=2 order by id asc');

$restsup=mysqli_fetch_array($rs2); 

 

$namevalue ='singleRoomCost="'.$singleRoomCost.'",doubleRoomCost="'.$doubleRoomCost.'",tripleRoomCost="'.$tripleRoomCost.'",quadRoomCost="'.$quadRoomCost.'",cwbRoomCost="'.$cwbRoomCost.'",cnbRoomCost="'.$cnbRoomCost.'",markupPercent="'.$markupPercent.'",markupValue="'.$markupValue.'",currencyId="2",currencyValue="'.($restsup['rate']).'"';  

$where='id="'.decode($editId).'"';    

updatelisting('sys_packageBuilderEvent',$namevalue,$where);  



 



?> 

<script> 

parent.redirectpage('display.html?ga=itineraries&view=1&id=<?php echo $_POST['pid']; ?>&save=1&b=2'); 

</script> 

<?php 

}



















if(trim($_REQUEST['action'])=='updatebillingtype' && trim($_REQUEST['pid'])!=''){    

 

$namevalue ='billingType="'.$_REQUEST['billingType'].'",gstType="'.$_REQUEST['gstType'].'",convertedCurrency="INR"';  

$where='id="'.decode($_REQUEST['pid']).'"';    

updatelisting('sys_packageBuilder',$namevalue,$where);





?> 

<script> 

parent.redirectpage('display.html?ga=itineraries&view=1&id=<?php echo $_REQUEST['pid']; ?>&b=2&save=1'); 

</script> 

<?php 

}











if(trim($_POST['action'])=='savepageduedate' && trim($_POST['pid'])!='' && trim($_POST['depositAmount'])!='' && trim($_POST['depositDueDate'])!=''){    

 

$namevalue ='depositAmount="'.$_POST['depositAmount'].'",depositDueDate="'.date('Y-m-d',strtotime($_POST['depositDueDate'])).'"';  

$where='id="'.decode($_REQUEST['pid']).'"';    

updatelisting('sys_packageBuilder',$namevalue,$where);





?> 

<script> 

parent.redirectpage('display.html?ga=itineraries&view=1&id=<?php echo $_REQUEST['pid']; ?>&b=2&save=1'); 

</script> 

<?php 

}













if(trim($_REQUEST['action'])=='uploadphototmedia'){ 



$totalImg = count($_FILES["image"]["tmp_name"]);

  

for($i=0; $i<=$totalImg; $i++){

if($_FILES["image"]["tmp_name"][$i]!=""){ 





$rt=time(); 

$companyLogoFileName=basename($_FILES['image']['name'][$i]); 

$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION); 

$profilePhoto=str_replace(' ','_',substr($companyLogoFileName, 0, strpos($companyLogoFileName, ".")).$rt.'.'.$companyLogoFileExtension); 

move_uploaded_file($_FILES["image"]["tmp_name"][$i], "package_image/{$profilePhoto}"); 





$source_img = 'package_image/'.$profilePhoto;

$destination_img = 'package_image/'.$profilePhoto;



$d = compress($source_img, $destination_img, 50);





$namevalue ='name="'.$profilePhoto.'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.date('Y-m-d H:i:s').'"';   

addlistinggetlastid('sysMediaLibrary',$namevalue);   

}

}

?>

<script>

parent.funloaduploadedphotos(12);

</script>



<?php



}













if(trim($_REQUEST['action'])=='setpackagecoverphoto' && trim($_REQUEST['imagename'])!=''  && trim($_REQUEST['pid'])!=''){    



$coverPhoto=$_REQUEST['imagename'];



$timename=time();



if (strpos($_REQUEST['imagename'], 'https://') !== false) {



$content = file_get_contents($_REQUEST['imagename']);

file_put_contents('package_image/'.$timename.'.jpg', $content);





$source_img = 'package_image/'.$timename.'.jpg';

$destination_img = 'package_image/'.$timename.'.jpg';



$d = compress($source_img, $destination_img, 70);



$coverPhoto=$timename.'.jpg';

}





 

$namevalue ='coverPhoto="'.$coverPhoto.'"';  

$where='id="'.decode($_REQUEST['pid']).'"';    

updatelisting('sys_packageBuilder',$namevalue,$where);

 

}











if(trim($_POST['action'])=='editDayDetails'){    

 

$namevalue ='daySubject="'.addslashes($_POST['daySubject']).'",dayDetails="'.addslashes($_POST['dayDetails']).'"';  

 $where='packageId="'.decode($_REQUEST['pid']).'" and packageDays="'.($_REQUEST['editId']).'"';    

updatelisting('sys_packageBuilderEvent',$namevalue,$where);



 

?> 

<script> 

parent.redirectpage('display.html?ga=itineraries&view=1&id=<?php echo $_REQUEST['pid']; ?>&b=3&save=1&d=<?php echo $_REQUEST['editId']; ?>'); 

</script> 

<?php 

}



if(trim($_POST['action'])=='editDayDetails2'){    

 

$namevalue ='daySubject="'.addslashes($_POST['daySubject']).'",dayDetails="'.addslashes($_POST['dayDetails']).'"';  

 $where='packageId="'.decode($_REQUEST['pid']).'" and packageDays="'.($_REQUEST['editId']).'"';    

updatelisting('sys_packageBuilderEvent',$namevalue,$where);



 

?> 

<script> 

parent.load_build_day_details('<?php echo $_REQUEST['editId']; ?>','<?php echo $_REQUEST['date']; ?>'); 

parent.$('.modal').modal('hide');

</script> 

<?php 

}













if(trim($_REQUEST['action'])=='seteventcoverphoto' && trim($_REQUEST['imagename'])!=''  && trim($_REQUEST['id'])!=''  && trim($_REQUEST['pid'])!=''){    

 

 



 

 

 

 $coverPhoto=$_REQUEST['imagename'];



$timename=time();



if (strpos($_REQUEST['imagename'], 'https://') !== false) {



$content = file_get_contents($_REQUEST['imagename']);



file_put_contents('package_image/'.$timename.'.jpg', $content);





$source_img = 'package_image/'.$timename.'.jpg';

$destination_img = 'package_image/'.$timename.'.jpg';



$d = compress($source_img, $destination_img, 50);

 



$coverPhoto=$timename.'.jpg';

}



 

 

$namevalue ='eventPhoto="'.$coverPhoto.'"';  

$where='packageId="'.decode($_REQUEST['pid']).'" and id="'.($_REQUEST['id']).'"';    

updatelisting('sys_packageBuilderEvent',$namevalue,$where);

 

}







if(trim($_REQUEST['action'])=='daydetailsphoto' && trim($_REQUEST['imagename'])!=''  && trim($_REQUEST['id'])!=''){    

 

 

 

 $coverPhoto=$_REQUEST['imagename'];



$timename=time();



if (strpos($_REQUEST['imagename'], 'https://') !== false) {



$content = file_get_contents($_REQUEST['imagename']);

file_put_contents('package_image/'.$timename.'.jpg', $content);





$source_img = 'package_image/'.$timename.'.jpg';

$destination_img = 'package_image/'.$timename.'.jpg';



$d = compress($source_img, $destination_img, 50);

 





$coverPhoto=$timename.'.jpg';

}



 

 

$namevalue ='eventPhoto="'.$coverPhoto.'"';  

$where='id="'.($_REQUEST['id']).'"';    

updatelisting('dayItineraryMaster',$namevalue,$where);

 

}









if(trim($_REQUEST['action'])=='editinclusionExclusionDetails'  && trim($_REQUEST['pid'])!=''){    

 

$namevalue ='inclusionExclusion="'.addslashes($_REQUEST['inclusionExclusion']).'"';  

$where='id="'.decode($_REQUEST['pid']).'" ';    

updatelisting('sys_packageBuilder',$namevalue,$where);

 

 

 ?> 

<script> 

parent.redirectpage('display.html?ga=itineraries&view=1&id=<?php echo $_REQUEST['pid']; ?>&b=3&save=1&d=<?php echo $_REQUEST['d']; ?>'); 

</script> 

<?php 

} 





if(trim($_REQUEST['action'])=='edittermsandconditionsDetails'  && trim($_REQUEST['pid'])!=''){    

 

$namevalue ='terms="'.addslashes($_REQUEST['terms']).'"';  

$where='id="'.decode($_REQUEST['pid']).'" ';    

updatelisting('sys_packageBuilder',$namevalue,$where);

 

 

 ?> 

<script> 

parent.redirectpage('display.html?ga=itineraries&view=1&id=<?php echo $_REQUEST['pid']; ?>&save=1&pd=100000'); 

</script> 

<?php 

} 









if(trim($_REQUEST['action'])=='packageextramarkup'  && trim($_REQUEST['pid'])!=''){    

 

$namevalue ='extraMarkup="'.$_REQUEST['extraMarkup'].'",baseMarkup="'.$_REQUEST['baseMarkup'].'"';  



$where='id="'.decode($_REQUEST['pid']).'" ';    

updatelisting('sys_packageBuilder',$namevalue,$where);

 

 

 ?> 

<script> 

parent.redirectpage('display.html?ga=itineraries&view=1&id=<?php echo $_REQUEST['pid']; ?>&b=2&save=1'); 

</script> 

<?php 

} 











if(trim($_POST['action'])=='shareprivateclients'  && trim($_POST['pid'])!='' && $_POST['sendcheck']!=''){    



include "config/mail.php"; 



$ccmail = $_SESSION['username'].','.$_POST['ccmails'];

$hobby = $_POST['sendcheck'];

$shareMessage = addslashes($_POST['shareMessage']);



foreach ($hobby as $hobys=>$value) { 



$ab=GetPageRecord('*','sys_userMaster',' id in (select addedBy from  sys_userMaster where id="'.$_SESSION['userid'].'")');  

$invoiceData=mysqli_fetch_array($ab);



$ab2=GetPageRecord('*','sys_userMaster',' id="'.$_SESSION['userid'].'"');  

$invoiceData222=mysqli_fetch_array($ab2);



$ab2pk=GetPageRecord('*','sys_packageBuilder',' id="'.decode($_POST['pid']).'"');  

$packageDataMain=mysqli_fetch_array($ab2pk);



$a=GetPageRecord('*','userMaster','id="'.decode($value).'"  ');  

$userdata=mysqli_fetch_array($a);





$subject = 'Quotation '.$_POST['pid'].' '.$clientnameglobal; 

$mailbody='

<table cellpadding="0" cellspacing="0" border="0" width="100%" style="background:#f3f3f3;min-width:350px;font-size:1px;line-height:normal">

      <tbody><tr>

        <td align="center" valign="top">

          <table cellpadding="0" cellspacing="0" border="0" width="600" class="m_6354632776220649125table750" style="width:100%;max-width:600px;min-width:350px;background:#f3f3f3">

            <tbody><tr>

              <td class="m_6354632776220649125mob_pad" width="25" style="width:25px;max-width:25px;min-width:25px">&nbsp;</td>

              <td align="center" valign="top">

                <table cellpadding="0" cellspacing="0" border="0" width="100%" style="width:100%!important;min-width:100%;max-width:100%;background:#f3f3f3">

                  <tbody><tr>

                    <td class="m_6354632776220649125top_pad" style="height:25px;line-height:25px;font-size:23px"><div style="height:30px;">&nbsp;</div></td>

                  </tr>

                </tbody></table>

                <table cellpadding="0" cellspacing="0" border="0" width="100%" style="background:#ffffff;border-radius:10px;width:100%!important;min-width:100%;max-width:100%">

                  <tbody><tr>

                    <td class="m_6354632776220649125mob_pad" width="25" style="width:25px;max-width:25px;min-width:25px">&nbsp;</td>

                    <td align="center" valign="top">

                      <table cellpadding="0" cellspacing="0" border="0" width="100%" style="width:100%!important;min-width:100%;max-width:100%">

                        <tbody><tr>

                          <td align="center" valign="top">

                            <table cellpadding="0" cellspacing="0" border="0" width="100%" style="width:100%!important;min-width:100%;max-width:100%">

                              <tbody>

                                <tr>

                                  <td align="left" valign="top">&nbsp;</td>

                                </tr>

                                <tr>

                                  <td align="left" valign="top"><div style="height:30px;">&nbsp;</div></td>

                                </tr>

                                <tr>

                                <td align="left" valign="top">

                                  <span style="font-family:Arial,sans-serif;color:#1a1a1a;font-size:40px;line-height:38px;font-weight:300;letter-spacing:-1.5px">Hi '.stripslashes($userdata['firstName']).',</span>                                <br>

<br>

<span style="font-family:Arial,sans-serif;color:#343642;font-size:22px;line-height:30px;font-weight:300">'.stripslashes($shareMessage).'</span></td>

                              </tr>

                              <tr>

                                <td style="height:30px;line-height:30px;font-size:28px">&nbsp;</td>

                              </tr>

                              <tr>

                                <td>

                                  <span style="font-family:Arial,sans-serif;color:#343642;font-size:22px;line-height:30px;font-weight:300">Please click the button below to view your itinerary.                                  </span>                                </td>

                              </tr>

                              <tr>

                                <td style="height:30px;line-height:30px;font-size:28px">&nbsp;</td>

                              </tr>

                              <tr>

                                <td align="center" valign="top">

                                  <table cellpadding="0" cellspacing="0" border="0" style="background:#525a68;border-radius:30px;border:2px solid #525a68">

                                    <tbody><tr>

                                      <td align="left" valign="top">

                                        <a href="'.$fullurlproposal.'sharepackage/'.$_POST['pid'].'/'.cleanstring(stripslashes($packageDataMain['name'])).'.html" style="display:inline-block;border:1px solid #525a68;border-radius:30px;padding:15px 27px;font-family:Arial,sans-serif;color:#ffffff;font-size:20px;text-decoration:none" target="_blank">

                                        View your&nbsp;itinerary                                        </a>                                      </td>

                                    </tr>

                                  </tbody></table>                                </td>

                              </tr>

                              <tr>

                                <td style="height:30px;line-height:30px;font-size:28px">&nbsp;</td>

                              </tr>

                              <tr>

                                <td>

                                  <span style="font-family:Arial,sans-serif;color:#888;font-size:12px;line-height:18px;font-weight:300">You are receiving this email because you have engaged with and/or are a customer of '.stripslashes($invoiceData['invoiceCompany']).'. We promise to only send you emails regarding your itinerary and we will never give your details to an external party or individual.</span>                                </td>

                              </tr>

                              <tr>

                                <td style="height:30px;line-height:30px;font-size:28px">&nbsp;</td>

                              </tr>

                              <tr>

                                <td>

                                  <table cellpadding="0" cellspacing="0" border="0" width="100%" style="width:100%!important;min-width:100%;max-width:100%;border-width:2px;border-style:solid;border-color:#c0c7cd;border-bottom:none;border-left:none;border-right:none">

                                    <tbody><tr>

                                      <td style="height:28px;line-height:28px;font-size:26px">&nbsp;</td>

                                    </tr>

                                  </tbody></table>

                                  <table border="0" cellpadding="0" cellspacing="0" width="100%">

                                    <tbody><tr>

                                      <td valign="middle">

                                        <span style="font-family:Arial,sans-serif;color:#343642;font-size:14px;line-height:18px;font-weight:300">'.stripslashes($invoiceData222['emailsignature']).'</span>                                      </td>

                                    </tr>

                                  </tbody></table>                                </td>

                              </tr>

                              <tr>

                                <td style="height:30px;line-height:30px;font-size:28px">&nbsp;</td>

                              </tr>

                              <tr>

                                <td style="height:30px;line-height:30px;font-size:28px">&nbsp;</td>

                              </tr>

                            </tbody></table>                          </td>

                        </tr>

                      </tbody></table>                    </td>

                    <td class="m_6354632776220649125mob_pad" width="25" style="width:25px;max-width:25px;min-width:25px">&nbsp;</td>

                  </tr>

                </tbody></table>              </td>

              <td class="m_6354632776220649125mob_pad" width="25" style="width:25px;max-width:25px;min-width:25px">&nbsp;</td>

            </tr>

              <tr>

                <td class="m_6354632776220649125mob_pad" style="width:25px;max-width:25px;min-width:25px">&nbsp;</td>

                <td align="center" valign="top"><div style="height:30px;">&nbsp;</div></td>

                <td class="m_6354632776220649125mob_pad" style="width:25px;max-width:25px;min-width:25px">&nbsp;</td>

              </tr>

          </tbody></table>

        </td>

      </tr>

    </tbody></table> 

';

$mailbody=file_get_contents($fullurl."quotation_email_itineraries.php?id=".$_POST['pid']);
 


$namevalue ='packageId="'.decode($_POST['pid']).'",clientId="'.$userdata['id'].'",	email="'.$userdata['email'].'",dateAdded="'.date('Y-m-d H:i:s').'",addedBy="'.$_SESSION['userid'].'"';  

$lstaddid=addlistinggetlastid('sys_ShareProposal',$namevalue);  







 

send_attachment_mail($fromemail,$userdata['email'],$subject,$mailbody,$ccmail.','.$_SESSION['username'],$file_name);







}





$abs=GetPageRecord('*','sys_packageBuilder','id="'.decode($_REQUEST['pid']).'"  ');  

$packagedatas=mysqli_fetch_array($abs);



if($packagedatas['id']!=''){

$namevalue2 ='details="'.addslashes($mailbody).'",subject="'.addslashes($subject).'",fromEmail="'.$_SESSION['username'].'",toEmail="'.$userdata['email'].'",dateAdded="'.date('Y-m-d H:i:s').'",addedBy="'.$_SESSION['userid'].'",queryId="'.$packagedatas['queryId'].'"';

addlistinggetlastid('queryMail',$namevalue2); 

}



 ?> 

<script> 

parent.redirectpage('display.html?ga=itineraries&view=1&id=<?php echo $_REQUEST['pid']; ?>&b=3&save=3'); 

</script> 

<?php 

}









if(trim($_REQUEST['action'])=='linkSharingaction'  && trim($_REQUEST['pid'])!=''){    

 

$namevalue ='linkSharing="'.$_REQUEST['linkSharing'].'"';  

$where='id="'.decode($_REQUEST['pid']).'" ';    

updatelisting('sys_packageBuilder',$namevalue,$where); 

} 



























if(trim($_REQUEST['action'])=='addduplicatepackage'  && trim($_REQUEST['pid'])!=''){    



$a=GetPageRecord('*','sys_packageBuilder','id="'.decode($_REQUEST['pid']).'" ');  

$packagedata=mysqli_fetch_array($a);



  

echo $namevalue ='name="'.addslashes($packagedata['name']).' - Duplicate'.'",startDate="'.$packagedata['startDate'].'",endDate="'.$packagedata['endDate'].'",adult="'.$packagedata['adult'].'",child="'.$packagedata['child'].'",days="'.$packagedata['days'].'",destinations="'.$packagedata['destinations'].'",notes="'.addslashes($packagedata['notes']).'",dateAdded="'.date('Y-m-d H:i:s').'",addedBy="'.$_SESSION['userid'].'",inclusionExclusion="'.addslashes($packagedata['inclusionExclusion']).'",depositAmount="'.$packagedata['depositAmount'].'",depositDueDate="'.$packagedata['depositDueDate'].'",billingType="'.$packagedata['billingType'].'",bookingDays="'.$packagedata['bookingDays'].'",grossPrice="'.$packagedata['grossPrice'].'",netPrice="'.$packagedata['netPrice'].'",extraMarkup="'.$packagedata['extraMarkup'].'",linkSharing="'.$packagedata['linkSharing'].'",coverPhoto="'.$packagedata['coverPhoto'].'",terms="'.addslashes($packagedata['terms']).'",queryId="'.decode($_REQUEST['queryid']).'"';   

$lstaddid=addlistinggetlastid('sys_packageBuilder',$namevalue); 







$rs=GetPageRecord('*','sys_PackageTips',' packageId="'.decode($_REQUEST['pid']).'" order by id asc');

while($eventDatatips=mysqli_fetch_array($rs)){   



$namevalue ='packageId="'.$lstaddid.'",title="'.addslashes($eventDatatips['title']).'",description="'.addslashes($eventDatatips['description']).'",iconset="'.addslashes($eventDatatips['iconset']).'"';   

addlistinggetlastid('sys_PackageTips',$namevalue); 



}



  

  

$rs=GetPageRecord('*','sys_packageBuilderEvent',' packageId="'.decode($_REQUEST['pid']).'" order by id asc');

while($eventData=mysqli_fetch_array($rs)){  





$namevalue ='packageId="'.$lstaddid.'",startDate="'.$eventData['startDate'].'",endDate="'.$eventData['endDate'].'",checkIn="'.$eventData['checkIn'].'",checkOut="'.$eventData['checkOut'].'",singleRoom="'.$eventData['singleRoom'].'",doubleRoom="'.$eventData['doubleRoom'].'",tripleRoom="'.$eventData['tripleRoom'].'",dateAdded="'.date('Y-m-d H:i:s').'",addedBy="'.$_SESSION['userid'].'",quadRoom="'.$eventData['quadRoom'].'",cwbRoom="'.$eventData['cwbRoom'].'",cnbRoom="'.$eventData['cnbRoom'].'",name="'.addslashes($eventData['name']).'",hotelCategory="'.$eventData['hotelCategory'].'",hotelRoom="'.addslashes($eventData['hotelRoom']).'",mealPlan="'.addslashes($eventData['mealPlan']).'",sectionType="'.$eventData['sectionType'].'",days="'.$eventData['days'].'",transferCategory="'.$eventData['transferCategory'].'",vehicle="'.$eventData['vehicle'].'",packageDays="'.$eventData['packageDays'].'",mealCategory="'.addslashes($eventData['mealCategory']).'",description="'.addslashes($eventData['description']).'",adultCost="'.$eventData['adultCost'].'",childCost="'.$eventData['childCost'].'",markupPercent="'.$eventData['markupPercent'].'",markupValue="'.$eventData['markupValue'].'",singleRoomCost="'.$eventData['singleRoomCost'].'",doubleRoomCost="'.$eventData['doubleRoomCost'].'",tripleRoomCost="'.$eventData['tripleRoomCost'].'",quadRoomCost="'.$eventData['quadRoomCost'].'",cwbRoomCost="'.$eventData['cwbRoomCost'].'",cnbRoomCost="'.$eventData['cnbRoomCost'].'",daySubject="'.addslashes($eventData['daySubject']).'",dayDetails="'.addslashes($eventData['dayDetails']).'",eventPhoto="'.$eventData['eventPhoto'].'",flightNo="'.$eventData['flightNo'].'",fromDestination="'.$eventData['fromDestination'].'",toDestination="'.$eventData['toDestination'].'",flightDuration="'.$eventData['flightDuration'].'",destinationName="'.$eventData['destinationName'].'"';   

addlistinggetlastid('sys_packageBuilderEvent',$namevalue); 



}







 ?> 

<script> 

<?php if($_REQUEST['queryid']!=''){ ?>

parent.redirectpage('display.html?ga=query&view=1&id=<?php echo $_REQUEST['queryid']; ?>&status=1&c=2&save=1'); 



<?php } else { ?>

parent.redirectpage('display.html?ga=itineraries&save=1'); 

<?php } ?>

</script> 

<?php 

} 

















if(trim($_REQUEST['action'])=='insertitinerary'  && trim($_REQUEST['id'])!=''  && trim($_REQUEST['qid'])!=''){    



$a=GetPageRecord('*','sys_packageBuilder','id="'.decode($_REQUEST['id']).'" ');   
$packagedata=mysqli_fetch_array($a);



  

$namevalue ='name="'.addslashes($packagedata['name']).''.'",startDate="'.$packagedata['startDate'].'",endDate="'.$packagedata['endDate'].'",adult="'.$packagedata['adult'].'",child="'.$packagedata['child'].'",days="'.$packagedata['days'].'",destinations="'.$packagedata['destinations'].'",notes="'.addslashes($packagedata['notes']).'",dateAdded="'.date('Y-m-d H:i:s').'",addedBy="'.$_SESSION['userid'].'",inclusionExclusion="'.addslashes($packagedata['inclusionExclusion']).'",depositAmount="'.$packagedata['depositAmount'].'",depositDueDate="'.$packagedata['depositDueDate'].'",billingType=1,bookingDays="'.$packagedata['bookingDays'].'",grossPrice="'.$packagedata['grossPrice'].'",netPrice="'.$packagedata['netPrice'].'",extraMarkup="'.$packagedata['extraMarkup'].'",linkSharing="'.$packagedata['linkSharing'].'",coverPhoto="'.$packagedata['coverPhoto'].'",terms="'.addslashes($packagedata['terms']).'",queryId="'.decode($_REQUEST['qid']).'"';   

$lstaddid=addlistinggetlastid('sys_packageBuilder',$namevalue); 







$rs=GetPageRecord('*','sys_PackageTips',' packageId="'.decode($_REQUEST['id']).'" order by id asc');

while($eventDatatips=mysqli_fetch_array($rs)){   



$namevalue ='packageId="'.$lstaddid.'",title="'.addslashes($eventDatatips['title']).'",description="'.addslashes($eventDatatips['description']).'",iconset="'.addslashes($eventDatatips['iconset']).'"';   

addlistinggetlastid('sys_PackageTips',$namevalue); 



}



  

  

$rs=GetPageRecord('*','sys_packageBuilderEvent',' packageId="'.decode($_REQUEST['id']).'" order by id asc');

while($eventData=mysqli_fetch_array($rs)){  





$namevalue ='packageId="'.$lstaddid.'",startDate="'.$eventData['startDate'].'",endDate="'.$eventData['endDate'].'",checkIn="'.$eventData['checkIn'].'",checkOut="'.$eventData['checkOut'].'",singleRoom="'.$eventData['singleRoom'].'",doubleRoom="'.$eventData['doubleRoom'].'",tripleRoom="'.$eventData['tripleRoom'].'",dateAdded="'.date('Y-m-d H:i:s').'",addedBy="'.$_SESSION['userid'].'",quadRoom="'.$eventData['quadRoom'].'",cwbRoom="'.$eventData['cwbRoom'].'",cnbRoom="'.$eventData['cnbRoom'].'",name="'.addslashes($eventData['name']).'",hotelCategory="'.$eventData['hotelCategory'].'",hotelRoom="'.addslashes($eventData['hotelRoom']).'",mealPlan="'.addslashes($eventData['mealPlan']).'",sectionType="'.$eventData['sectionType'].'",days="'.$eventData['days'].'",transferCategory="'.$eventData['transferCategory'].'",vehicle="'.$eventData['vehicle'].'",packageDays="'.$eventData['packageDays'].'",mealCategory="'.addslashes($eventData['mealCategory']).'",description="'.addslashes($eventData['description']).'",adultCost="'.$eventData['adultCost'].'",childCost="'.$eventData['childCost'].'",markupPercent="'.$eventData['markupPercent'].'",markupValue="'.$eventData['markupValue'].'",singleRoomCost="'.$eventData['singleRoomCost'].'",doubleRoomCost="'.$eventData['doubleRoomCost'].'",tripleRoomCost="'.$eventData['tripleRoomCost'].'",quadRoomCost="'.$eventData['quadRoomCost'].'",cwbRoomCost="'.$eventData['cwbRoomCost'].'",cnbRoomCost="'.$eventData['cnbRoomCost'].'",daySubject="'.addslashes($eventData['daySubject']).'",dayDetails="'.addslashes($eventData['dayDetails']).'",eventPhoto="'.$eventData['eventPhoto'].'",flightNo="'.$eventData['flightNo'].'",fromDestination="'.$eventData['fromDestination'].'",toDestination="'.$eventData['toDestination'].'",flightDuration="'.$eventData['flightDuration'].'",destinationName="'.$eventData['destinationName'].'"';   

addlistinggetlastid('sys_packageBuilderEvent',$namevalue); 



}







 ?> 

<script> 

parent.redirectpage('display.html?ga=query&view=1&id=<?php echo $_REQUEST['qid']; ?>&c=2&save=1'); 

</script> 

<?php 

} 



















 if(trim($_POST['action'])=='addclient' && trim($_POST['submitName'])!='' && trim($_POST['firstName'])!=''  && trim($_POST['mobile'])!='' && trim($_POST['email'])!='' && trim($_POST['city'])!=''){  

 

$city=addslashes($_POST['city']); 

$email=addslashes($_POST['email']);    

$mobile=addslashes($_POST['mobile']);  

$mobileCode=addslashes($_POST['mobileCode']);   

$email2=addslashes($_POST['email2']);    

$mobile2=addslashes($_POST['mobile2']);  

$mobileCode2=addslashes($_POST['mobileCode2']); 

$firstName=addslashes($_POST['firstName']);   

$lastName=addslashes($_POST['lastName']);  

$submitName=addslashes($_POST['submitName']);   

$address=addslashes($_POST['address']);   

$editid=decode($_POST['editId']);



$dob=date('Y-m-d',strtotime($_POST['dob'])); 



$marriageAnniversary=date('Y-m-d',strtotime($_POST['marriageAnniversary']));  

 

if($dob=='01-01-1970'){

$dob='';

}

if($marriageAnniversary=='01-01-1970'){

$marriageAnniversary='';

}





$a=GetPageRecord('*','cityMaster','id="'.$city.'"');  

$datacity=mysqli_fetch_array($a); 



$a=GetPageRecord('*','stateMaster','id="'.$datacity['stateId'].'"');  

$datas=mysqli_fetch_array($a); 



$a=GetPageRecord('*','countryMaster','id="'.$datas['countryId'].'"');  

$datac=mysqli_fetch_array($a); 

 



$state=addslashes($datas['id']);   

$country=addslashes($datac['id']);







$a=GetPageRecord('*','sys_userMaster','email="'.$email.'" and (userType=1 or userType=2 or userType=4)');  

$validateemail=mysqli_fetch_array($a); 



if($editid!=''){ 

 





 $namevalue ='city="'.$city.'",email="'.$email.'",mobile="'.$mobile.'",mobileCode="'.$mobileCode.'",submitName="'.$submitName.'",email2="'.$email2.'",mobile2="'.$mobile2.'",mobileCode2="'.$mobileCode2.'",state="'.$state.'",country="'.$country.'",firstName="'.$firstName.'",lastName="'.$lastName.'",address="'.$address.'",dob="'.$dob.'",marriageAnniversary="'.$marriageAnniversary.'",dateAdded="'.time().'",addedBy="'.$_SESSION['userid'].'"';

$where='id="'.$editid.'"';    

updatelisting('userMaster',$namevalue,$where);  

 

 

 

} else { 

if($validateemail['id']==''){ 

$namevalue ='email="'.$email.'",city="'.$city.'",mobile="'.$mobile.'",mobileCode="'.$mobileCode.'",submitName="'.$submitName.'",email2="'.$email2.'",dob="'.$dob.'",marriageAnniversary="'.$marriageAnniversary.'",mobile2="'.$mobile2.'",mobileCode2="'.$mobileCode2.'",state="'.$state.'",country="'.$country.'",firstName="'.$firstName.'",lastName="'.$lastName.'",address="'.$address.'",status=1,profileId=5,userType=4,dateAdded="'.time().'",addedBy="'.$_SESSION['userid'].'"';  

$lstaddid=addlistinggetlastid('userMaster',$namevalue);  

 







} else { 

?> 

<script>alert('This email is already exists!');  

parent.$('.animated-progess').hide(); 

parent.$('#stoppagediv').hide();  

 

parent.$('#savingbutton').prop("disabled", false);

parent.$('#savingphtobutton').prop("disabled", false);

parent.$('#savingbutton').val("Save");

</script> 

<?php 

exit(); 

} 

} 





?> 

<script> 

parent.redirectpage('display.html?ga=clients&save=1'); 

</script> 

<?php 

}









 if(trim($_POST['action'])=='addtips' && trim($_POST['title'])!='' && trim($_POST['description'])!='' && trim($_POST['pid'])!=''){

 

 

$title=addslashes($_POST['title']);   

$description=addslashes($_POST['description']);  

$iconset=addslashes($_POST['iconset']);   

$editId=decode($_POST['editId']);   

$packageId=decode($_POST['pid']);   

 

 



if($editId!=''){ 

 





 $namevalue ='title="'.$title.'",description="'.$description.'",iconset="'.$iconset.'"';

$where='id="'.$editId.'" and packageId="'.$packageId.'"';    

updatelisting('sys_PackageTips',$namevalue,$where);  

 

 

 

} else {  

$namevalue ='title="'.$title.'",description="'.$description.'",iconset="'.$iconset.'",packageId="'.$packageId.'"';  

$lstaddid=addlistinggetlastid('sys_PackageTips',$namevalue);  

  

 

}



?> 

<script> 

parent.redirectpage('display.html?ga=itineraries&view=1&id=<?php echo $_REQUEST['pid']; ?>&save=1&pd=100000'); 

</script> 

<?php 

}







if(trim($_REQUEST['action'])=='deltetips' && trim($_REQUEST['did'])!='' && trim($_REQUEST['pid'])!=''){    

deleteRecord('sys_PackageTips','id="'.decode($_REQUEST['did']).'" and packageId="'.decode($_REQUEST['pid']).'"');  

?> 

<script> 

parent.redirectpage('display.html?ga=itineraries&view=1&id=<?php echo $_REQUEST['pid']; ?>&b=3&save=1'); 

</script> 

<?php 

}

//===================================Add Query===========================================

//if($_POST['action']=='addQuery' &&  $_POST['startDate']!='' && $_POST['endDate']!=''  && $_POST['name']!='' && $_POST['email']!='' && $_POST['mobile']!='' && $_POST['country']!='' && $_POST['state']!='' && $_POST['city']!='' && $_POST['fromCity']!='' && $_POST['destinationId']!=''){ 

if($_POST['action']=='addQuery'){  

include "config/mail.php"; 

$startDate=date('Y-m-d',strtotime($_POST['startDate']));  

$endDate=date('Y-m-d',strtotime($_POST['endDate']));   

$submitName=addslashes($_POST['submitName']); 

$name=addslashes($_POST['name']); 

$mobile=addslashes($_POST['mobile']);  

$webqueryid=addslashes($_POST['webqueryid']);  

$priorityStatus=addslashes($_POST['priorityStatus']);  

$country=addslashes($_POST['country']);  

$email=addslashes($_POST['email']);  

$state=addslashes($_POST['state']);  

$travelMonth=addslashes($_POST['travelMonth']); 

$city=addslashes($_POST['city']);

$clientId=decode($_POST['clientId']); 

$clientId=decode($_POST['clientId']); 

$fromCity=addslashes($_POST['fromCity']);  

//add email signature

$kk=GetPageRecord('*','sys_userMaster','id="'.$_SESSION['userid'].'"');   

$userDetail=mysqli_fetch_array($kk);

$emailsignature=$userDetail['emailsignature'];

//end email sign.

if(isset($_POST['destinationId'])){ 

foreach($_POST['destinationId'] as $k4=>$v4){ 

$destinationId .= $_POST['destinationId'][$k4].','; 

} 

} 

$string = '';
$string = preg_replace('/\.$/', '', $destinationId);  
$array = explode(',', $string); 
foreach($array as $value)  
{  
$rs1=GetPageRecord('name','cityMaster',' id="'.$value.'"');   

$editresult=mysqli_fetch_array($rs1);
$destinationIdName.=$editresult['name'].', '; 
}
$randPass = rand(999999,100000);

$serviceId=addslashes($_POST['serviceId']);     
$adult=addslashes(strip_tags($_POST['adult'])); 
$child=addslashes(strip_tags($_POST['child'])); 
$infant=addslashes(strip_tags($_POST['infant'])); 
$assignTo=addslashes(strip_tags($_POST['assignTo'])); 
$leadSource=addslashes(strip_tags($_POST['leadSource'])); 
$title=addslashes(strip_tags($_POST['title'])); 
$details=addslashes(strip_tags($_POST['details'])); 

$start = strtotime($startDate); 
$end = strtotime($endDate);  
$day = ceil(abs($end - $start) / 86400); 

if($day==1){ 
$night=1; 
} else { 
$night=$day-1; 
}

 
$addedBy=$_SESSION['userid'];  
$dateAdded=date('Y-m-d H:i:s');
 

if($clientId=='' || $clientId=='0'){

$bb=GetPageRecord('*','userMaster','email="'.$email.'" and userType=4');   
$clientidcheck=mysqli_fetch_array($bb); 

if($clientidcheck['email']==''){
$namevalue4 ='userType="4",submitName="'.$submitName.'",firstName="'.$name.'",mobile="'.$mobile.'",password="'.md5($randPass).'",status=1,email="'.$email.'",country="'.$country.'",state="'.$state.'",city="'.$city.'",addedBy="'.$addedBy.'",dateAdded="'.time().'"';

$clientId=addlistinggetlastid('userMaster',$namevalue4); 
$mailbody='Dear '.$name.',

<div><br>

</div>

<div>Please find below the login details</div>

<div><br>

</div>

<div><strong>Login URL:</strong>&nbsp;<a href="'.$clienturl.'" target="_blank">'.$clienturl.'</a><br>

    <strong>Username:</strong>&nbsp;<a href="mailto:'.$email.'" target="_blank">'.$email.'</a><br>

  <strong>Password:&nbsp;</strong>'.$randPass.'</div>

<div><br>

</div>

<div>Note: Please update your password after login in your profile section.</div>

<div><br>

</div>

<div>Thanks<br>

  Team '.stripslashes($LoginUserDetailscompany['invoiceCompany']).'</div>

 ';

 

 

 send_attachment_mail($fromemail,$email,'Login Credentials',$mailbody,$ccmail,$file_name);

} else {
$clientId=$clientidcheck['id'];
}
}

if(trim($_POST['startDate'])=='' or trim($_POST['endDate'])==''){
$night=0;
$day=0;
}

 
if($_REQUEST['editid']==''){ 
$rs=GetPageRecord($select,'sys_userMaster','id=1 '); 

$invoicedataa=mysqli_fetch_array($rs);$namevalue2 ='subject="'.$title.'",fromEmail="'.$_SESSION['username'].'",toEmail="'.$email.'",dateAdded="'.$dateAdded.'",addedBy="'.$addedBy.'"';

$querymailid=addlistinggetlastid('queryMail',$namevalue2);  

 
$bodycontent='<div style="padding:30px 0px; background-color:#F4FDFF;  text-align:center">
<img src="'.$fullurl.'profilepic/'.$invoicedataa['invoiceLogo'].'"    style="height: 54px; margin-bottom:20px;">
<div style=" max-width:600px;  background-color:#FFFFFF; margin:auto;  border:1px solid #F2F2F2; border-top:4px #419bf3 solid; padding:20px; text-align:left; font-family:Arial, Helvetica, sans-serif; font-size:13px; ">
  <h4>Your Query Detail</h4> 
  While replying to this query, please dont change the subject line.  <div style="margin-top:20px;border-top:2px solid #F2F2F2; padding:10px; background-color:#F7F7F7; margin-bottom:20px;">
  <div style="margin-bottom:20px;"><table width="100%" border="0" cellpadding="4" cellspacing="0" style="font-size:12px;">
      <tbody>
        <tr>
          <td colspan="2" align="left" valign="top" bgcolor="#EFEFEF" style="padding:10px; font-size:15px;"><strong>Contact Detail</strong></td>
          </tr>
        <tr>
        <td width="25%" align="left" valign="top"><strong>Name</strong></td>
        <td width="25%" align="left" valign="top"><strong>Phone/Mobile</strong></td>
        </tr>
      <tr>
        <td width="25%" align="left" valign="top">'.$_POST['name'].'</td>
        <td width="25%" align="left" valign="top">'.$_POST['mobile'].'</td>
        </tr>
    </tbody></table>
  </div>
    <div style="margin-bottom:10px;"><table width="100%" border="0" cellpadding="4" cellspacing="0" style="font-size:12px;">
      <tbody>
	   <tr>
          <td colspan="4" align="left" valign="top" bgcolor="#EFEFEF" style="padding:10px; font-size:15px;"><strong>Query Detail</strong></td>
          </tr>
	  <tr>
        <td width="25%" align="left" valign="top"><strong>From  Date</strong></td> 
        <td width="25%" align="left" valign="top"><strong>To  Date</strong></td>
        <td width="25%" align="left" valign="top"><strong>Destination</strong></td>
        <td width="25%" align="left" valign="top"><strong>Duration</strong></td>
      </tr>
      <tr>
        <td width="25%" align="left" valign="top">'.$_POST['startDate'].'</td>
        <td width="25%" align="left" valign="top">'.$_POST['endDate'].'</td>
        <td width="25%" align="left" valign="top">'.$destinationIdName.'</td>
        <td width="25%" align="left" valign="top">'.$night.' Nights / '.$day.' Days</td>
      </tr>
    </tbody></table></div>
	<div><table width="100%" border="0" cellpadding="4" cellspacing="0" style="font-size:12px;">
      <tbody><tr>
        <td width="25%" align="left" valign="top"><strong>Created Date</strong></td>
        <td width="25%" align="left" valign="top"><strong>Adult</strong></td>
        <td width="25%" align="left" valign="top"><strong>Child</strong></td>
        <td width="25%" align="left" valign="top"><strong>Infant</strong></td>
      </tr>
      <tr>
        <td width="25%" align="left" valign="top">'.date('d-m-Y h:i A').'</td>
        <td width="25%" align="left" valign="top">'.$_POST['adult'].'</td>
        <td width="25%" align="left" valign="top">'.$_POST['child'].'</td>
        <td width="25%" align="left" valign="top">'.$_POST['infant'].'</td>
      </tr>
    </tbody></table>
	</div>
  </div>
  <div>

  </div>
  </div>
</div><br>'.$details.'<br><br>'.$emailsignature;  
$namevalue ='startDate="'.$startDate.'",endDate="'.$endDate.'",name="'.$name.'",phone="'.$mobile.'",countryId="'.$country.'",stateId="'.$state.'",cityId="'.$city.'",email="'.$email.'",destinationId="'.$destinationId.'",serviceId="'.$serviceId.'",adult="'.$adult.'",child="'.$child.'",infant="'.$infant.'",assignTo="'.$assignTo.'",leadSource="'.$leadSource.'",title="'.$title.'",details="'.$details.'",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'",day="'.$day.'",updateDate="'.$dateAdded.'",clientId="'.$clientId.'",fromCity="'.$fromCity.'",travelMonth="'.$travelMonth.'",priorityStatus="'.$priorityStatus.'"';
 
$queryId=addlistinggetlastid('queryMaster',$namevalue); 
$namevalue2 ='subject="#'.makeQueryId($queryId).' Query Created!",details="'.addslashes($bodycontent).'",queryId="'.$queryId.'"'; 

$where='id="'.$querymailid.'"';   

updatelisting('queryMail',$namevalue2,$where); $namevalue3 ='details="Query Created",queryId="'.$queryId.'",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'",logType="add_query"';
addlisting('queryLogs',$namevalue3); 
 
$mailto=$email;

$subject='#'.makeQueryId($queryId).' Query Created!'; 

send_attachment_mail($fromemail,$mailto,$subject,$bodycontent.'<img src="'.$fullurl.'rmail.php?q='.$querymailid.'" width="0" height="0">',$ccmail,$file_name);

/*Send Whatsapp SMS*/
$clientName=$submitName . $name;
$clientMobile=$mobile;
$userName=getUserName($assignTo);
$travelDate=date("d M Y",strtotime($startDate));

$destinationData=GetPageRecord('name','cityMaster','id="'.$destinationId.'"'); 
$destinationData11=mysqli_fetch_array($destinationData);

$pax=urlencode($adult.' Adult + '.$child.' Child');

$data='https://api.easysocial.in/api/v1/wa-templates/send/clbknqlvp0ci09naicpy82iw9/90/78/API/91'.urlencode($clientMobile).'?header1=https://storage.googleapis.com/easysocial_production/iyaatra/iyaatra-welcome.png&body1='.urlencode($clientName).'&body2='.urlencode($userName).'&body3='.urlencode($destinationData11["name"]).'&body4='.encode($queryId).'&body5='.urlencode($travelDate).'&body6='.$pax;


//$data='https://api.easysocial.in/api/v1/wa-templates/send/clb1vu7lr2b5aowai7pethx86/62/78/API/91'.urlencode($clientMobile).'?header1=https://storage.googleapis.com/easysocial_production/business-assets%2Fbusiness-78%2FEngage-assets%2Fclb11mys129fnowai01i98kt8&body1='.urlencode($clientName).'&body2='.urlencode($userName).'&body3='.urlencode($destinationData11["name"]).'&body4='.encode($queryId).'&body5='.urlencode($travelDate).'&body6='.$adult.'&body7='.$child.''


file_get_contents($data);

} else { 

$namevalue ='startDate="'.$startDate.'",endDate="'.$endDate.'",name="'.$name.'",phone="'.$mobile.'",countryId="'.$country.'",stateId="'.$state.'",cityId="'.$city.'",email="'.$email.'",destinationId="'.$destinationId.'",serviceId="'.$serviceId.'",adult="'.$adult.'",child="'.$child.'",infant="'.$infant.'",leadSource="'.$leadSource.'",title="'.$title.'",details="'.$details.'",day="'.$day.'",updateDate="'.$dateAdded.'",clientId="'.$clientId.'",fromCity="'.$fromCity.'",travelMonth="'.$travelMonth.'",priorityStatus="'.$priorityStatus.'",submitName="'.$submitName.'"'; 

$where='id="'.decode($_POST['editid']).'"';   

updatelisting('queryMaster',$namevalue,$where); 

$queryId=decode($_POST['editid']);

$namevalue4 ='submitName="'.$submitName.'",firstName="'.$name.'",mobile="'.$mobile.'",email="'.$email.'"'; 

updatelisting('userMaster',$namevalue4,'id="'.$clientId.'"'); 

$namevalue3 ='details="Query Update",queryId="'.decode($_POST['editid']).'",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'",logType="edit_query"';

addlisting('queryLogs',$namevalue3); 

}

?>

<script>  

parent.redirectpage('display.html?ga=query&view=1&id=<?php echo encode($queryId); ?>'); 

</script>

<?php 

}


if(trim($_REQUEST['action'])=='sendWhatsAppVoucher' && trim($_REQUEST['voucherid'])!='' && trim($_REQUEST['queryId'])!=''){


/*Send Whatsapp*/
$query=GetPageRecord('*','queryMaster','id="'.decode($_REQUEST['queryId']).'"'); 
$editresult=mysqli_fetch_array($query);

$clientName=$editresult["submitName"] . $editresult["name"];
$clientMobile=$editresult["phone"];
$userName=getUserName($editresult["assignTo"]);
$dest=getCityName($editresult['destinationId']);
$queryId=encode($editresult['destinationId']);
$travelDate=date("d M Y",strtotime($editresult["startDate"]));


$rsa=GetPageRecord('*','sys_userMaster','id="'.$editresult["assignTo"].'"'); 
$userDetail=mysqli_fetch_array($rsa);

$destinationData=GetPageRecord('name','cityMaster','id="'.$editresult["destinationId"].'"'); 
$destinationData11=mysqli_fetch_array($destinationData);

$invoiceUrl=urlencode($fullurl.'viewvoucher.php?id='.$_REQUEST["voucherid"].'&sendmail=1');


$abcde=GetPageRecord('*','sys_voucherMaster','id="'.decode($_REQUEST['voucherid']).'"'); 
$voucherData=mysqli_fetch_array($abcde);



$data='https://api.easysocial.in/api/v1/wa-templates/send/clbvymbh50qg73yai68e0f2fp/121/78/API/91'.urlencode($clientMobile).'?header1=https://storage.googleapis.com/easysocial_production/business-assets%2Fbusiness-78%2FEngage-assets%2Fclbvy15fz0q1d3yai277r6ztm&body1='.urlencode($clientName).'&body2='.urlencode($destinationData11["name"]).'&body3='.encode($editresult["id"]).'&body4='.urlencode($voucherData['hotel']).'&body5='.$invoiceUrl.'&body6='.urlencode($userName).'&body7='.urlencode($LoginUserDetails["mobile"]).'&body8='.urlencode($LoginUserDetails["email"]).'';

 




file_get_contents($data);

}


if(trim($_REQUEST['action'])=='sendFollowup' && trim($_REQUEST['id'])!=''){
$id=$_REQUEST["id"];

$query=GetPageRecord('*','queryMaster','id="'.decode($_REQUEST['id']).'"'); 
$editresult=mysqli_fetch_array($query);

$abcd=GetPageRecord('*','sys_packageBuilder','confirmQuote="1" and queryId="'.$editresult['id'].'"'); 
$result=mysqli_fetch_array($abcd);

$clientName=$editresult["submitName"] . $editresult["name"];
$clientMobile=$editresult["phone"];
$userName=getUserName($editresult["assignTo"]);
$dest=getCityName($editresult['destinationId']);
$queryId=encode($editresult['destinationId']);
$travelDate=date("d M Y",strtotime($editresult["startDate"]));


$rsa=GetPageRecord('*','sys_userMaster','id="'.$editresult["assignTo"].'"'); 
$userDetail=mysqli_fetch_array($rsa);

$destinationData=GetPageRecord('name','cityMaster','id="'.$editresult["destinationId"].'"'); 
$destinationData11=mysqli_fetch_array($destinationData);


if($result["currency"]!=""){
	$currency=$result["currency"];
}else{
	$currency="INR";
}

$totalfinalcost=urlencode($currency." ".number_format(round($result['grossPrice']+$result['totalDiscount'])));
$packageUrl=urlencode($fullurlproposal."sharepackage/".encode($result['id']).".html");

/*
$data='https://api.easysocial.in/api/v1/wa-templates/send/clbknvnrg0cll9nai25ag5qs2/94/78/API/91'.$clientMobile.'? header1=https://storage.googleapis.com/easysocial_production/iyaatra/iyaatra-follow-up.png&body1='.urlencode($clientName).'&body2='.urlencode($userName).'&body3='.encode($editresult["id"]).'&body4='.urlencode($destinationData11["name"]).'&body5='.$totalfinalcost.'&body6='.$packageUrl.'&body7='.urlencode($userName).'&body8='.urlencode($LoginUserDetails["mobile"]).'&body9='.urlencode($LoginUserDetails["email"]).''
*/


$data='https://api.easysocial.in/api/v1/wa-templates/send/clbknvnrg0cll9nai25ag5qs2/94/78/API/91'.$clientMobile.'?header1=https://storage.googleapis.com/easysocial_production/iyaatra/iyaatra-follow-up.png&body1='.urlencode($clientName).'&body2='.urlencode($userName).'&body3='.encode($editresult["id"]).'&body4='.urlencode($destinationData11["name"]).'&body5='.$totalfinalcost.'&body6='.$packageUrl.'&body7='.urlencode($userName).'&body8='.urlencode($userDetail["mobile"]).'&body9='.urlencode($userDetail["email"]).'';


file_get_contents($data);

}


if(trim($_REQUEST['action'])=='sendWhatsapp' && trim($_REQUEST['id'])!=''){

$id=$_REQUEST["id"];

$abcd=GetPageRecord('*','sys_packageBuilder','confirmQuote="1" and id="'.decode($_REQUEST['id']).'"'); 
$result=mysqli_fetch_array($abcd);

$query=GetPageRecord('*','queryMaster','id="'.$result['queryId'].'"'); 
$editresult=mysqli_fetch_array($query);

$abcd=GetPageRecord('*','sys_packageBuilder','confirmQuote="1" and queryId="'.$editresult['id'].'"'); 
$result=mysqli_fetch_array($abcd);

$clientName=$editresult["submitName"] . $editresult["name"];
$clientMobile=$editresult["phone"];
$userName=getUserName($editresult["assignTo"]);
$dest=getCityName($editresult['destinationId']);
$queryId=encode($editresult['destinationId']);
$travelDate=date("d M Y",strtotime($editresult["startDate"]));

$rsa=GetPageRecord('*','sys_userMaster','id="'.$editresult["assignTo"].'"'); 
$userDetail=mysqli_fetch_array($rsa);

$destinationData=GetPageRecord('name','cityMaster','id="'.$editresult["destinationId"].'"'); 
$destinationData11=mysqli_fetch_array($destinationData);

if($result["currency"]!=""){
	$currency=$result["currency"];
}else{
	$currency="INR";
}

$totalfinalcost=urlencode($currency." ".number_format(round($result['grossPrice']+$result['totalDiscount'])));
$packageUrl=urlencode($fullurlproposal."sharepackage/".encode($result['id']).".html");

$data='https://api.easysocial.in/api/v1/wa-templates/send/clbknufv10ckl9nai2w3w1yax/91/78/API/91'.$clientMobile.'?header1=https://storage.googleapis.com/easysocial_production/iyaatra/iyaatra-quote.png&body1='.urlencode($clientName).'&body2='.urlencode($destinationData11["name"]).'&body3='.encode($editresult["id"]).'&body4='.$totalfinalcost.'&body5='.$packageUrl.'&body6='.urlencode($userName).'&body7='.urlencode($userDetail["mobile"]).'&body8='.urlencode($userDetail["email"]).'';

file_get_contents($data);

}




if(trim($_REQUEST['action'])=='changeassignstatus' && trim($_REQUEST['queryid'])!='' && trim($_REQUEST['assignTo'])!=''){ 

$id=decode($_REQUEST['queryid']);

$assignTo=$_REQUEST['assignTo']; 

$addedBy=$_SESSION['userid']; 

$dateAdded=date('Y-m-d H:i:s');

 $namevalue ='assignTo="'.$assignTo.'",updateDate="'.$dateAdded.'"'; 

 $where='id="'.$id.'"';   

updatelisting('queryMaster',$namevalue,$where); 

$namevalue3 ='details="Assign Query",queryId="'.$id.'",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'",userId="'.$assignTo.'",logType="assign_query"'; 

addlisting('queryLogs',$namevalue3);

}

 

if(trim($_REQUEST['action'])=='addnotes' && trim($_REQUEST['queryid'])!='' && trim($_REQUEST['details'])!=''){  

$queryid=decode($_REQUEST['queryid']); 

$details=addslashes($_REQUEST['details']); 

$addedBy=$_SESSION['userid']; 

$dateAdded=date('Y-m-d H:i:s');

$namevalue ='queryId="'.$queryid.'",details="'.$details.'",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'"';   

addlisting('queryNotes',$namevalue); 

$namevaluek ='details="Note Created",queryId="'.$queryid.'",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'",statusComment="'.$details.'",logType="add_note"'; 

addlisting('queryLogs',$namevaluek);

?>

<script>  
    parent.queryNotes(); 
    parent.$('#notedetails').val('');  
</script>

<?php

} 

















if(trim($_REQUEST['action'])=='addtask' && trim($_REQUEST['details'])!=''){  



  

$queryid=decode($_REQUEST['queryid']); 

$details=addslashes($_REQUEST['details']); 

$reminderDate=date('Y-m-d',strtotime($_REQUEST['reminderDate']));

$reminderTime=date('H:i:s',strtotime($_REQUEST['reminderTime']));

$status=addslashes($_REQUEST['status']); 

$taskType=addslashes($_REQUEST['taskType']); 

$assignTo=addslashes($_REQUEST['assignTo']); 

$reminderDate=$reminderDate.' '.$reminderTime;

$reminderDate=date('Y-m-d H:i:s',strtotime($reminderDate));

$addedBy=$_SESSION['userid']; 

$dateAdded=date('Y-m-d H:i:s');







$namevalue ='queryId="'.$queryid.'",details="'.$details.'",status="'.$status.'",reminderDate="'.$reminderDate.'",assignTo="'.$assignTo.'",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'",taskType="'.$taskType.'"';   

addlisting('queryTask',$namevalue); 



 

$namevaluek ='details="'.$taskType.' Created",queryId="'.$queryid.'",addedBy="'.$addedBy.'",statusComment="'.$details.'",dateAdded="'.$dateAdded.'",logType="add_task"';

addlisting('queryLogs',$namevaluek);



  

?>



<script> 

parent.redirectpage('display.html?ga=query&view=1&id=<?php echo $_REQUEST['queryid']; ?>&c=3&save=1'); 

  

</script>







<?php } 



















if(trim($_POST['action'])=='composemail' && $_POST['queryId']!='' && $_POST['subject']!='' && $_POST['EmailDetails']!=''){  



















$subject=addslashes($_POST['subject']);



$EmailDetails=addslashes($_POST['EmailDetails']);



$queryId=decode($_POST['queryId']);  



$day=addslashes($_POST['day']); 



$toEmail=addslashes($_POST['toEmail']); 



$cc=addslashes($_POST['cc']); 







?>



<script>



parent.$('#popcontent').html('<div style="padding:10px; text-align:center;"><img src="images/loading.gif" width="32" ></div>');



</script>



<?php







 







$namevaluelog ='dateAdded="'.date('Y-m-d H:i:s').'",addedBy="'.$_SESSION['userid'].'",queryId="'.($queryId).'",fromEmail="'.($LoginUserDetails['emailAccount']).'",toEmail="'.($toEmail).'",subject="'.$subject.'",details="'.($EmailDetails).'",ccEmail="'.$cc.'"'; 



$lastid=addlistinggetlastid('queryMail',$namevaluelog);







 



 $namevaluek ='details="Mail Sent to ('.$toEmail.')",queryId="'.$queryId.'",addedBy="'.$_SESSION['userid'].'",statusComment="",dateAdded="'.date('Y-m-d H:i:s').'",logType="add_mail"';

addlisting('queryLogs',$namevaluek);



 

 

 if($_FILES["attachmentfile"]["tmp_name"]!=""){ 

$rt=mt_rand().strtotime(date("YMDHis")); 

$companyLogoFileName=basename($_FILES['attachmentfile']['name']); 

$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION); 

$receiptFile=time().$rt.'.'.$companyLogoFileExtension; 

move_uploaded_file($_FILES["attachmentfile"]["tmp_name"], "voucherAttachments/{$receiptFile}"); 

}

 

 



include "config/mail.php"; 







 



$ccmail=$cc;



$file_ename=$receiptFile;



send_attachment_mail($fromemail,$toEmail,stripslashes($subject),stripslashes($EmailDetails.'<img src="'.$fullurl.'readmail.php?m='.encode($lastid).'" width="0" height="0">'),$ccmail.','.$_SESSION['username'],$file_name);











?>



<script> 

parent.redirectpage('display.html?ga=query&view=1&id=<?php echo encode($queryId); ?>&c=7&save=1'); 

  

</script>







<?php  }







if(trim($_POST['action'])=='sendtosupplier' && $_POST['queryid']!='' && $_POST['subject']!='' && $_POST['EmailDetails']!=''){  




$subject=addslashes($_POST['subject']); 

$EmailDetails=addslashes($_POST['EmailDetails']); 

$queryId=decode($_POST['queryid']);    

$cc=addslashes($_POST['ccmail']);  

?>



<script>



parent.$('#popcontent').html('<div style="padding:10px; text-align:center;"><img src="images/loading.gif" width="32" ></div>');



</script>



<?php
 

include "config/mail.php";   
$hobby = $_POST['sendcheck']; 
$shareMessage = addslashes($_POST['shareMessage']);



foreach ($hobby as $hobys=>$value) { 

$sup=1;



$a=GetPageRecord('*','sys_userMaster','id="'.decode($value).'"  ');   
$userdata=mysqli_fetch_array($a); 


$toEmail=addslashes($userdata['email']);  

$namevaluelog ='dateAdded="'.date('Y-m-d H:i:s').'",addedBy="'.$_SESSION['userid'].'",queryId="'.($queryId).'",fromEmail="'.($LoginUserDetails['emailAccount']).'",toEmail="'.($toEmail).'",subject="'.$subject.'",details="'.($EmailDetails).'",ccEmail="'.$cc.'"';  
$lastid=addlistinggetlastid('queryMail',$namevaluelog); 


$namevaluek ='details="Mail Sent to ('.$toEmail.')",queryId="'.$queryId.'",addedBy="'.$_SESSION['userid'].'",statusComment="",dateAdded="'.date('Y-m-d H:i:s').'",logType="add_mail"'; 
addlisting('queryLogs',$namevaluek);



  



$ccmail=$cc; 

$file_name=''; 

send_attachment_mail($fromemail,$toEmail,stripslashes($subject),stripslashes($EmailDetails.'<img src="'.$fullurl.'readmail.php?m='.encode($lastid).'" width="0" height="0">'),$ccmail.','.$_SESSION['username'],$file_name);



}

?>



<script> 

<?php if($sup!=1){ ?>

alert('Please select supplier from list!');

<?php } else { ?> 

parent.redirectpage('display.html?ga=query&view=1&id=<?php echo encode($queryId); ?>&c=7&save=1'); 

<?php } ?>

  

</script>







<?php  }

























 if(trim($_POST['action'])=='addsupplier' && trim($_POST['submitName'])!='' && trim($_POST['company'])!='' && trim($_POST['firstName'])!='' && trim($_POST['lastName'])!='' && trim($_POST['mobile'])!='' && trim($_POST['email'])!='' && trim($_POST['city'])!=''){  

 

 

$company=addslashes($_POST['company']);   
 

$email=addslashes($_POST['email']);   

$city=addslashes($_POST['city']);  

$mobile=addslashes($_POST['mobile']);  

$mobileCode=addslashes($_POST['mobileCode']);   

$firstName=addslashes($_POST['firstName']);   

$lastName=addslashes($_POST['lastName']);    

$address=addslashes($_POST['address']);   
$status=addslashes($_POST['status']);   
$hotelManagement=addslashes($_POST['hotelManagement']);   
$flightManagement=addslashes($_POST['flightManagement']);  
$itineraryManagement=addslashes($_POST['itineraryManagement']);  
$cabManagement=addslashes($_POST['cabManagement']);  
$submitName=addslashes($_POST['submitName']);  

$editid=decode($_POST['editId']);

  $randPass = rand(999999,100000);


$a=GetPageRecord('*','cityMaster','id="'.$city.'"');  

$datacity=mysqli_fetch_array($a); 



$a=GetPageRecord('*','stateMaster','id="'.$datacity['stateId'].'"');  

$datas=mysqli_fetch_array($a); 



$a=GetPageRecord('*','countryMaster','id="'.$datas['countryId'].'"');  

$datac=mysqli_fetch_array($a); 

 



$state=addslashes($datas['id']);   

$country=addslashes($datac['id']);







$a=GetPageRecord('*','sys_userMaster','email="'.$email.'" and userType="suppliers"');   
$validateemail=mysqli_fetch_array($a); 



if($editid!=''){   

if($_REQUEST['logincredentials']==1){

$namevalue ='email="'.$email.'",city="'.$city.'",status="'.$status.'",city="'.$city.'",password="'.$randPass.'",mobile="'.$mobile.'",mobileCode="'.$mobileCode.'",state="'.$state.'",country="'.$country.'",company="'.$company.'",firstName="'.$firstName.'",lastName="'.$lastName.'",address="'.$address.'",dateAdded="'.date('Y-m-d H:i:s').'",addedBy="'.$_SESSION['userid'].'",hotelManagement="'.$hotelManagement.'",flightManagement="'.$flightManagement.'",itineraryManagement="'.$itineraryManagement.'",cabManagement="'.$cabManagement.'",submitName="'.$submitName.'"';

} else { 

$namevalue ='email="'.$email.'",city="'.$city.'",status="'.$status.'",mobile="'.$mobile.'",mobileCode="'.$mobileCode.'",state="'.$state.'",country="'.$country.'",company="'.$company.'",firstName="'.$firstName.'",lastName="'.$lastName.'",address="'.$address.'",dateAdded="'.date('Y-m-d H:i:s').'",addedBy="'.$_SESSION['userid'].'",hotelManagement="'.$hotelManagement.'",flightManagement="'.$flightManagement.'",itineraryManagement="'.$itineraryManagement.'",cabManagement="'.$cabManagement.'",submitName="'.$submitName.'"';


}


$where='id="'.$editid.'"';    

updatelisting('sys_userMaster',$namevalue,$where);  

 

 

 

} else { 

if($validateemail['id']==''){ 

$namevalue ='email="'.$email.'",city="'.$city.'",mobile="'.$mobile.'",password="'.$randPass.'",mobileCode="'.$mobileCode.'",state="'.$state.'",country="'.$country.'",company="'.$company.'",firstName="'.$firstName.'",lastName="'.$lastName.'",address="'.$address.'",status="'.$status.'",profileId=5,userType="suppliers",dateAdded="'.date('Y-m-d H:i:s').'",addedBy="'.$_SESSION['userid'].'",hotelManagement="'.$hotelManagement.'",flightManagement="'.$flightManagement.'",itineraryManagement="'.$itineraryManagement.'",cabManagement="'.$cabManagement.'",submitName="'.$submitName.'"';  

$lstaddid=addlistinggetlastid('sys_userMaster',$namevalue);  

  
} else { 

?> 

<script>alert('This email is already exists!');  

parent.$('.animated-progess').hide(); 

parent.$('#stoppagediv').hide();  

 

parent.$('#savingbutton').prop("disabled", false);

parent.$('#savingphtobutton').prop("disabled", false);

parent.$('#savingbutton').val("Save");

</script> 

<?php 

exit(); 

}




 

} 

if($editid!=''){
$editid=$editid;
} else {
$editid=$lstaddid;
}

if($_REQUEST['logincredentials']==1){  

$rs8=GetPageRecord('*','sys_userMaster','id="'.trim($editid).'" ');  
$dubcheck=mysqli_fetch_array($rs8);
 

$subject = 'Supplier Login Details';  
$mailbody=''; 
$mailbody='Dear '.$company.',<br><br>  
<strong>Your Login Details</strong><br>  
URL: '.$fullurl.'<br>  
Username: '.$email.'<br>  
Password: '.$randPass.'<br> <br>   
Thank You
';  
$subject = 'Supplier Login Details';  

senddesignedmail($fromemail,$email,stripslashes($subject),stripslashes($mailbody),$ccmail.','.$_SESSION['username'],$file_name,$fullurl); 
 
}


?> 

<script> 

parent.redirectpage('display.html?ga=suppliers&save=1'); 

</script> 

<?php 

}


 if(trim($_POST['action'])=='addagent' && trim($_POST['submitName'])!='' && trim($_POST['company'])!='' && trim($_POST['firstName'])!='' && trim($_POST['lastName'])!='' && trim($_POST['mobile'])!='' && trim($_POST['email'])!='' && trim($_POST['city'])!=''){  

$company=addslashes($_POST['company']);    
$email=addslashes($_POST['email']);   
$city=addslashes($_POST['city']);   
$mobile=addslashes($_POST['mobile']);   
$mobileCode=addslashes($_POST['mobileCode']);   
$firstName=addslashes($_POST['firstName']);   
$lastName=addslashes($_POST['lastName']);   
$address=addslashes($_POST['address']);   
$status=addslashes($_POST['status']);     
$submitName=addslashes($_POST['submitName']);  
$commissionType=addslashes($_POST['commissionType']);  
$userCountry=addslashes($_POST['userCountry']); 
$userState=addslashes($_POST['userState']); 
$userCity=addslashes($_POST['userCity']); 
$phone=addslashes($_POST['phone']); 
$businessType=addslashes($_POST['businessType']); 
$gstin=addslashes($_POST['gstin']); 
$pan=addslashes($_POST['pan']); 
$companyPincode=addslashes($_POST['companyPincode']); 
$companyAddress=addslashes($_POST['companyAddress']); 
$website=addslashes($_POST['website']); 

$serviceFee=addslashes($_POST['serviceFee']); 
$IntServiceFee=addslashes($_POST['IntServiceFee']); 
$HotelDomesticServiceFee=addslashes($_POST['HotelDomesticServiceFee']); 
$HotelIntServiceFee=addslashes($_POST['HotelIntServiceFee']); 

$editid=decode($_POST['editId']);

  $randPass = rand(999999,100000);


$a=GetPageRecord('*','cityMaster','id="'.$city.'"');  

$datacity=mysqli_fetch_array($a); 



$a=GetPageRecord('*','stateMaster','id="'.$datacity['stateId'].'"');  

$datas=mysqli_fetch_array($a); 



$a=GetPageRecord('*','countryMaster','id="'.$datas['countryId'].'"');  

$datac=mysqli_fetch_array($a); 

 



$state=addslashes($datas['id']);   

$country=addslashes($datac['id']);







$a=GetPageRecord('*','sys_userMaster','email="'.$email.'" ');   
$validateemail=mysqli_fetch_array($a); 

  

if($editid!=''){   

if($_REQUEST['logincredentials']==1){

$namevalue ='email="'.$email.'",commissionType="'.$commissionType.'",status="'.$status.'",city="'.$city.'",password="'.$randPass.'",mobile="'.$mobile.'",mobileCode="'.$mobileCode.'",state="'.$state.'",country="'.$country.'",company="'.$company.'",firstName="'.$firstName.'",lastName="'.$lastName.'",address="'.$address.'",dateAdded="'.date('Y-m-d H:i:s').'",addedBy="'.$_SESSION['userid'].'",hotelManagement="'.$hotelManagement.'",flightManagement="'.$flightManagement.'",itineraryManagement="'.$itineraryManagement.'",cabManagement="'.$cabManagement.'",submitName="'.$submitName.'",userCountry="'.$userCountry.'",userState="'.$userState.'",userCity="'.$userCity.'",phone="'.$phone.'",businessType="'.$businessType.'",gstin="'.$gstin.'",pan="'.$pan.'",companyPincode="'.$companyPincode.'",website="'.$website.'",companyAddress="'.$companyAddress.'",serviceFee="'.$serviceFee.'",IntServiceFee="'.$IntServiceFee.'",HotelDomesticServiceFee="'.$HotelDomesticServiceFee.'",HotelIntServiceFee="'.$HotelIntServiceFee.'"';

} else { 

$namevalue ='email="'.$email.'",city="'.$city.'",commissionType="'.$commissionType.'",status="'.$status.'",mobile="'.$mobile.'",mobileCode="'.$mobileCode.'",state="'.$state.'",country="'.$country.'",company="'.$company.'",firstName="'.$firstName.'",lastName="'.$lastName.'",address="'.$address.'",dateAdded="'.date('Y-m-d H:i:s').'",addedBy="'.$_SESSION['userid'].'",hotelManagement="'.$hotelManagement.'",flightManagement="'.$flightManagement.'",itineraryManagement="'.$itineraryManagement.'",cabManagement="'.$cabManagement.'",submitName="'.$submitName.'",userCountry="'.$userCountry.'",userCountry="'.$userCountry.'",userState="'.$userState.'",userCity="'.$userCity.'",phone="'.$phone.'",businessType="'.$businessType.'",gstin="'.$gstin.'",pan="'.$pan.'",companyPincode="'.$companyPincode.'",website="'.$website.'",companyAddress="'.$companyAddress.'",serviceFee="'.$serviceFee.'",IntServiceFee="'.$IntServiceFee.'",HotelDomesticServiceFee="'.$HotelDomesticServiceFee.'",HotelIntServiceFee="'.$HotelIntServiceFee.'"';


}

$rs=GetPageRecord('*','sys_userMaster','id="'.$editid.'"'); 
$getid=mysqli_fetch_array($rs);
$agentId=$getid['agentId'];

$where='id="'.$editid.'"';    

updatelisting('sys_userMaster',$namevalue,$where);   
 

} else { 

if($validateemail['id']==''){

$rs=GetPageRecord('*','sys_userMaster',' userType="agent" order by id desc'); 
$getid=mysqli_fetch_array($rs);

$id='AGT'.($getid['id']+1);

$agentId=$id;
 

$namevalue ='email="'.$email.'",city="'.$city.'",mobile="'.$mobile.'",password="'.$randPass.'",mobileCode="'.$mobileCode.'",state="'.$state.'",country="'.$country.'",company="'.$company.'",firstName="'.$firstName.'",lastName="'.$lastName.'",address="'.$address.'",status="'.$status.'",profileId=5,userType="agent",dateAdded="'.date('Y-m-d H:i:s').'",addedBy="'.$_SESSION['userid'].'",hotelManagement="'.$hotelManagement.'",flightManagement="'.$flightManagement.'",itineraryManagement="'.$itineraryManagement.'",cabManagement="'.$cabManagement.'",submitName="'.$submitName.'",userCountry="'.$userCountry.'",userState="'.$userState.'",userCity="'.$userCity.'",phone="'.$phone.'",businessType="'.$businessType.'",gstin="'.$gstin.'",pan="'.$pan.'",companyPincode="'.$companyPincode.'",website="'.$website.'",agentId="'.$agentId.'",companyAddress="'.$companyAddress.'"';  

$lstaddid=addlistinggetlastid('sys_userMaster',$namevalue);  

  
} else { 

?> 

<script>alert('This email is already exists!');  

parent.$('.animated-progess').hide(); 

parent.$('#stoppagediv').hide();  

 

parent.$('#savingbutton').prop("disabled", false);

parent.$('#savingphtobutton').prop("disabled", false);

parent.$('#savingbutton').val("Save");

</script> 

<?php 

exit(); 

}




 

} 

if($editid!=''){
$editid=$editid;
} else {
$editid=$lstaddid;
}

if($_REQUEST['logincredentials']==1){  

$rs8=GetPageRecord('*','sys_userMaster','id="'.trim($editid).'" ');  
$dubcheck=mysqli_fetch_array($rs8);
 
 
$mailbody=''; 
$mailbody='Dear '.$company.',<br><br>  
<strong>Your Login Details</strong><br>  
URL: '.$fullurl.'<br>  
Agent Id: '.$agentId.'<br>  
Username: '.$email.'<br>  
Password: '.$randPass.'<br> <br>   
Thank You
';  
$subject = 'Agent Login Details';  

senddesignedmail($fromemail,$email,stripslashes($subject),stripslashes($mailbody),$ccmail.','.$_SESSION['username'],$file_name,$fullurl); 
 
}


?> 

<script> 

parent.redirectpage('display.html?ga=agents&save=1'); 

</script> 

<?php 

}




if($_POST['action']=='addNewBranch' && $_POST['companyName']!="" && $_POST['gst']!="" && $_POST['gstMobile']!="" && $_POST['gstEmail']!="" && $_POST['state']!="" && $_POST['gstAddress']!=""){

$companyName=addslashes($_POST['companyName']);
$gst=addslashes($_POST['gst']);
$gstMobile=addslashes($_POST['gstMobile']);
$gstEmail=addslashes($_POST['gstEmail']);
$state=addslashes($_POST['state']);
$gstAddress=addslashes($_POST['gstAddress']); 
$editid=addslashes($_POST['editId']); 
$id=decode($_POST['agentId']); 


if($editid!=''){

//-------EDIT-----------

 $namevalue ='companyName="'.$companyName.'",gst="'.$gst.'",gstMobile="'.$gstMobile.'",gstEmail="'.$gstEmail.'",state="'.$state.'",gstAddress="'.$gstAddress.'"';  
$where='  id="'.($editid).'"';  
  
updatelisting('agentBranch',$namevalue,$where);  

} else { 

//-------ADD-----------

$namevalue ='companyName="'.$companyName.'",gst="'.$gst.'",gstMobile="'.$gstMobile.'",gstEmail="'.$gstEmail.'",state="'.$state.'",gstAddress="'.$gstAddress.'",agentId="'.$id.'"';  
addlistinggetlastid('agentBranch',$namevalue);   
 
}
 
?>
<script>
parent.redirectpage('display.html?ga=branch&id=<?php echo encode($id); ?>&view=1'); 
</script>

<?php

exit();
}
?>

 

<?php

if(trim($_POST['action'])=='addquerypayment' && $_POST['queryId']!='' && $_POST['packageId']!='' && $_POST['amount']!=''){  

$stschange='';



if($_FILES["receiptFile"]["tmp_name"]!=""){ 

$rt=mt_rand().strtotime(date("YMDHis")); 

$companyLogoFileName=basename($_FILES['receiptFile']['name']); 

$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION); 

$receiptFile=time().$rt.'.'.$companyLogoFileExtension; 

move_uploaded_file($_FILES["receiptFile"]["tmp_name"], "package_image/{$receiptFile}"); 

}

 





if($_POST['transectionType']!='Cash' && $_POST['paymentId']=='' && $_POST['status']==1){

?>

<script> alert('Transection ID is empty!'); </script>

<?php

exit();

}



if($_POST['transectionType']=='Cash' && $_FILES["receiptFile"]["tmp_name"]=='' && $_POST['status']==1){

?>

<script> alert('Receipt is empty!'); </script>

<?php

exit();

}



if($_POST['editid']>0){



$namevalue2 ='queryId="'.decode($_POST['queryId']).'",packageId="'.decode($_POST['packageId']).'",amount="'.trim($_REQUEST['amount']).'",paymentDate="'.date('Y-m-d H:i:s',strtotime($_REQUEST['startDate'].' '.date('H:i:s'))).'",paymentBy="'.$_SESSION['userid'].'",paymentStatus="'.$_POST['status'].'",transectionType="'.$_POST['transectionType'].'",paymentId="'.$_POST['paymentId'].'",receiptFile="'.$receiptFile.'",remark="'.addslashes($_POST['remark']).'"';

$where='id="'.decode($_POST['editid']).'"';    

updatelisting('sys_PackagePayment',$namevalue2,$where);  

    

updatelisting('queryMaster','statusId="5"','id="'.decode($_REQUEST['queryId']).'"');

$stschange='&showcong=1';

if($_POST['status']==1){

/*Send Whatsapp*/
$query=GetPageRecord('*','queryMaster','id="'.decode($_REQUEST['queryId']).'"'); 
$editresult=mysqli_fetch_array($query);

$abcd=GetPageRecord('*','sys_packageBuilder','confirmQuote="1" and queryId="'.$editresult['id'].'"'); 
$result=mysqli_fetch_array($abcd);

$clientName=$editresult["submitName"].$editresult["name"];
$clientMobile=$editresult["phone"];
$userName=getUserName($editresult["assignTo"]);
$dest=getCityName($editresult['destinationId']);
$queryId=encode($editresult['destinationId']);
$travelDate=date('d M Y',strtotime($_REQUEST['startDate']));

$rsa=GetPageRecord('*','sys_userMaster','id="'.$editresult["assignTo"].'"'); 
$userDetail=mysqli_fetch_array($rsa);

$destinationData=GetPageRecord('name','cityMaster','id="'.$editresult["destinationId"].'"');
$destinationData11=mysqli_fetch_array($destinationData);


if($result["currency"]!=""){
	$currency=$result["currency"];
}else{
	$currency="INR";
}

$paidcost=urlencode($currency.number_format(round($result['grossPrice']+$result['totalDiscount'])));

$totalfinalcost=urlencode($currency.number_format(round(trim($_REQUEST['amount']))));
$packageUrl=urlencode($fullurlproposal."sharepackage/".encode($result['id']).".html");

$receiptUrl='https://iyaatra.com/crm/download-payment-receipt.html?id='.$_POST['editid'].'';

$payData='0';

$rs=GetPageRecord('*','sys_PackagePayment',' queryId="'.$editresult['id'].'" and packageId="'.$result['id'].'" and paymentStatus=2 order by paymentDate asc');
while($paymentlist=mysqli_fetch_array($rs)){
	$payData.=date('d M Y',strtotime($paymentlist['paymentDate'])).'-'.$currency.$paymentlist['amount'].',';
}



$data='https://api.easysocial.in/api/v1/wa-templates/send/clbknwbxb0cma9nai611xauyb/96/78/API/91'.urlencode($clientMobile).'?header1=https://storage.googleapis.com/easysocial_production/iyaatra/iyaatra-payment-receive.png&body1='.urlencode($clientName).'&body2='.urlencode($destinationData11["name"]).'&body3='.encode($editresult["id"]).'&body4='.$paidcost.'&body5='.$packageUrl.'&body6='.$totalfinalcost.'&body7='.urlencode($payData).'&body8='.urlencode($receiptUrl);


file_get_contents($data);
}



} else { 



$namevalue2 ='queryId="'.decode($_POST['queryId']).'",packageId="'.decode($_POST['packageId']).'",amount="'.trim($_REQUEST['amount']).'",paymentDate="'.date('Y-m-d H:i:s',strtotime($_REQUEST['startDate'])).'",paymentBy="'.$_SESSION['userid'].'",paymentStatus="'.$_POST['status'].'",transectionType="'.$_POST['transectionType'].'",paymentId="'.$_POST['paymentId'].'",remark="'.addslashes($_POST['remark']).'"';

addlistinggetlastid('sys_PackagePayment',$namevalue2); 



}



$namevalue3 ='details="Update Payment",queryId="'.decode($_REQUEST['queryId']).'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.date('Y-m-d H:i:s').'",logType="edit_query"'; 

addlisting('queryLogs',$namevalue3); 











?> 

<script> 

parent.redirectpage('display.html?ga=query&view=1&id=<?php echo $_REQUEST['queryId']; ?>&c=5&save=1<?php echo $stschange; ?>'); 

</script> 

<?php

}









if(trim($_REQUEST['action'])=='genrateinvoice' && $_REQUEST['queryId']!='' && $_REQUEST['packageId']!='' && $_REQUEST['amount']!=''){  

$rs13=GetPageRecord('*','sys_invoiceMaster','queryId!="" and queryId="'.decode($_REQUEST['queryId']).'" order by id desc');  

if(mysqli_num_rows($rs13)<1){ 

$invoiceData=mysqli_fetch_array($rs13);

$invoiceid=round($invoiceData['id']+1);

$invoiceId='GI/'.date('y',strtotime(' -1 year')).'-'.date('y').'/'.str_pad($invoiceid, 3, '0', STR_PAD_LEFT).'';

$namevalue2 ='queryId="'.decode($_REQUEST['queryId']).'",packageId="'.decode($_REQUEST['packageId']).'",amount="'.trim($_REQUEST['amount']).'",invoiceDate="'.date('Y-m-d H:i:s').'",genrateBy="'.$_SESSION['userid'].'",invoiceId="'.$invoiceId.'"';

addlistinggetlastid('sys_invoiceMaster',$namevalue2); 

$namevalue3 ='details="Invoice Generated",queryId="'.decode($_REQUEST['queryId']).'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.date('Y-m-d H:i:s').'",logType="edit_query"'; 

addlisting('queryLogs',$namevalue3); 

$query=GetPageRecord('*','queryMaster','id="'.decode($_REQUEST['queryId']).'"'); 
$editresult=mysqli_fetch_array($query);


$abcd=GetPageRecord('*','sys_packageBuilder','confirmQuote="1" and queryId="'.$editresult['id'].'"'); 
$result=mysqli_fetch_array($abcd);


$clientName=$editresult["submitName"] . $editresult["name"];
$clientMobile=$editresult["phone"];
$userName=getUserName($editresult["assignTo"]);
$dest=getCityName($editresult['destinationId']);
$queryId=encode($editresult['destinationId']);
$travelDate=date("d M Y",strtotime($editresult["startDate"]));


$rsa=GetPageRecord('*','sys_userMaster','id="'.$editresult["assignTo"].'"'); 
$userDetail=mysqli_fetch_array($rsa);

$destinationData=GetPageRecord('name','cityMaster','id="'.$editresult["destinationId"].'"'); 
$destinationData11=mysqli_fetch_array($destinationData);


if($result["currency"]!=""){
	$currency=$result["currency"];
}else{
	$currency="INR";
}

$totalfinalcost=urlencode($currency." ".number_format(round($result['grossPrice']+$result['totalDiscount'])));
$packageUrl=urlencode($fullurlproposal."sharepackage/".encode($result['id']).".html");


$invoiceUrl=urlencode($fullurl.'printInvoice.php?queryId='.$_REQUEST['queryId'].'&id='.encode($lastId).'&packageId='.$result['id']);



$payData='0';

$rs=GetPageRecord('*','sys_PackagePayment',' queryId="'.$editresult['id'].'" and packageId="'.$result['id'].'" and paymentStatus=2 and paymentDate>"'.date("Y-m-d").'" order by paymentDate asc');
while($paymentlist=mysqli_fetch_array($rs)){
	$payData=date('d M Y',strtotime($paymentlist['paymentDate'])).'-'.$currency.$paymentlist['amount'].',';
}

$todayPayment=GetPageRecord('*','sys_PackagePayment',' queryId="'.$editresult['id'].'" and packageId="'.$result['id'].'" and paymentStatus=2 and paymentDate="'.date("Y-m-d").'" order by paymentDate asc');
$todayPaymentData=mysqli_fetch_array($todayPayment);

$tPayment=urlencode($currency.$todayPaymentData["amount"]);


$data='https://api.easysocial.in/api/v1/wa-templates/send/clbvyk7vc0qfz3yaic9ej8emk/120/78/API/91'.$clientMobile.'?header1=https://storage.googleapis.com/easysocial_production/business-assets%2Fbusiness-78%2FEngage-assets%2Fclbvxhs7g0pxk3yai6n4pa42i&body1='.urlencode($clientName).'&body2='.urlencode($destinationData11["name"]).'&body3='.encode($editresult["id"]).'&body4='.$packageUrl.'&body5='.$tPayment.'&body6='.urlencode($payData).'&body7='.$invoiceUrl.'&body8='.$totalfinalcost.'';


file_get_contents($data);

}



?> 

<script> 

parent.redirectpage('display.html?ga=query&view=1&id=<?php echo $_REQUEST['queryId']; ?>&c=5&save=1'); 

</script> 

<?php

}







if(trim($_REQUEST['action'])=='saveGSTpackagebuilder' && trim($_REQUEST['pid'])!=''){  

$id=decode($_REQUEST['pid']); 

$cgst=$_REQUEST['cgst'];   

$convertedCurrency=$_REQUEST['convertedCurrency'];  

$sgst=$_REQUEST['sgst'];  

$igst=$_REQUEST['igst'];  

$tcsPercent=$_REQUEST['tcsPercent'];  

$totalDiscount=$_REQUEST['totalDiscount'];  

$finalcostperperson=$_REQUEST['finalcostperperson'];  

$showcgst=$_REQUEST['showcgst'];  

$showsgst=$_REQUEST['showsgst'];  

$showigst=$_REQUEST['showigst']; 

$showtcs=$_REQUEST['showtcs']; 

$totalCost=$_REQUEST['totalCost']; 

$ebo=$_REQUEST['ebo'];

$changedata='';



 



if($_REQUEST['changecussyes']==1){ 

$curl = curl_init();



curl_setopt_array($curl, [

	CURLOPT_URL => "https://currency-converter-by-api-ninjas.p.rapidapi.com/v1/convertcurrency?have=INR&want=".$convertedCurrency."&amount=".$finalcostperperson."",

	CURLOPT_RETURNTRANSFER => true,

	CURLOPT_FOLLOWLOCATION => true,

	CURLOPT_ENCODING => "",

	CURLOPT_MAXREDIRS => 10,

	CURLOPT_TIMEOUT => 30,

	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

	CURLOPT_CUSTOMREQUEST => "GET",

	CURLOPT_HTTPHEADER => [

		"X-RapidAPI-Host: currency-converter-by-api-ninjas.p.rapidapi.com",

		"X-RapidAPI-Key: 4qHxfnYRW8mshIpW9aY4RfeEmocZp1ZXAWDjsnQk9pQYTjDPCQ"

	],

]);



$response = curl_exec($curl);

$err = curl_error($curl);



curl_close($curl);



if ($err) {

	//echo "cURL Error #:" . $err;

} else {

	$data = json_decode($response);	

	

	$changedata=',convertedCost="'.$data->new_amount.'"';

}







}





$namevalue ='cgst="'.$cgst.'",sgst="'.$sgst.'",igst="'.$igst.'"'.$changedata.',showcgst="'.$showcgst.'",convertedCurrency="'.$convertedCurrency.'",showsgst="'.$showsgst.'",showigst="'.$showigst.'",showtcs="'.$showtcs.'",tcsPercent="'.$tcsPercent.'",totalDiscount="'.$totalDiscount.'",ebo="'.$ebo.'"'; 

$where='id="'.$id.'"';    

updatelisting('sys_packageBuilder',$namevalue,$where);  







?> 

<script> 

 

parent.redirectpage('display.html?ga=itineraries&view=1&id=<?php echo $_REQUEST['pid']; ?>&b=2'); 

</script> 

<?php 

}















if(trim($_REQUEST['action'])=='sendpaymentlink'  && $_REQUEST['pid']!='' && $_REQUEST['qid']!='' && $_REQUEST['id']!=''){  



$queryId=decode($_REQUEST['qid']);

$packageId=decode($_REQUEST['pid']);

$id=decode($_REQUEST['id']);
$fd=GetPageRecord('*','queryMaster','id="'.$queryId.'"'); 

$queryData=mysqli_fetch_array($fd);

$rsa=GetPageRecord('*','userMaster','id="'.$queryData['clientId'].'"'); 

$userDetail=mysqli_fetch_array($rsa);
$rs=GetPageRecord($select,'sys_userMaster','id in (select addedBy from sys_userMaster where id="'.$queryData['addedBy'].'") '); 
$invoicedataa=mysqli_fetch_array($rs);

//if($_REQUEST['sendlink']==1){

$subject='Payment Request  (via '.strip($invoicedataa['invoiceCompany']).')';
$mailbody=file_get_contents($fullurl.'packagePaymentLink.php?pid='.$_REQUEST['pid'].'&id='.$_REQUEST['id'].'&qid='.$_REQUEST['qid'].'&sendlink='.$_REQUEST['sendlink']);

include "config/mail.php";  

$ccmail=$_POST['ccmails']; 

$file_name=''; 

send_attachment_mail($fromemail,$userDetail['email'],stripslashes($subject),stripslashes($mailbody),$ccmail.','.$_SESSION['username'],$file_name);
$namevalue ='paymentLinkDate="'.date('Y-m-d H:i:s').'"'; 

$where='id="'.$id.'"';    

updatelisting('sys_PackagePayment',$namevalue,$where);

$clientName=$queryData["submitName"] . $queryData["name"];
$clientMobile=$queryData["phone"];
$userName=getUserName($queryData["assignTo"]);

$destinationData=GetPageRecord('name','cityMaster','id="'.$queryData["destinationId"].'"'); 
$destinationData11=mysqli_fetch_array($destinationData);

$ba=GetPageRecord('*','sys_packageBuilder',' queryId="'.$queryData['id'].'" and confirmQuote=1'); 
$packagecost=mysqli_fetch_array($ba);



if($packagecost["currency"]!=""){
	$symbol="<i class='".$packagecost["currency"]."'></i>";
}else{
	$symbol="INR";
}


$url=urlencode('https://v2.api2pdf.com/chrome/pdf/url?url=https://iyaatra.com/crm/downloadpackagepdf_withimage2.php?id='.$_REQUEST['pid'].'&apikey=e196cd2c-d5d2-467b-b99b-3ad60f24c20e');

$body4=urlencode($symbol . $packagecost["grossPrice"]);
$body6=urlencode($symbol . $_REQUEST["amt"]);
$body7=urlencode(date("D M y") .'-'. $symbol . $_REQUEST["amt"]);

$data='https://api.easysocial.in/api/v1/wa-templates/send/clbc3hctv00unyoai9evlgli8/83/78/API/91'.urlencode($clientMobile).'?body1='.urlencode($clientName).'&body2='.urlencode($destinationData11["name"]).'&body3='.encode($queryData["id"]).'&body4='.$body4.'&body5='.$url.'&body6='.$body6.'&body7='.$body7;

file_get_contents($data);

?>

<script> 

parent.redirectpage('display.html?ga=query&view=1&id=<?php echo $_REQUEST['qid']; ?>&c=5&save=1');

</script>

<?php  }













if(trim($_REQUEST['action'])=='sendInvoicemail'  && $_REQUEST['id']!='' && $_REQUEST['queryId']!='' && $_REQUEST['packageId']!=''){  



$queryId=decode($_REQUEST['queryId']);

$packageId=decode($_REQUEST['packageId']);

$id=decode($_REQUEST['id']);



$fd=GetPageRecord('*','queryMaster','id="'.$queryId.'"'); 

$queryData=mysqli_fetch_array($fd);



$rsa=GetPageRecord('*','userMaster','id="'.$queryData['clientId'].'"'); 

$userDetail=mysqli_fetch_array($rsa);



$rs=GetPageRecord($select,'sys_userMaster','id in (select addedBy from sys_userMaster where id="'.$queryData['addedBy'].'") '); 

$invoicedataa=mysqli_fetch_array($rs);



$rsaa=GetPageRecord('*','sys_invoiceMaster',' id="'.decode($_REQUEST['id']).'" order by id desc');

$invoiceData=mysqli_fetch_array($rsaa);





$abasd=GetPageRecord('*','sys_userMaster',' id="'.$_SESSION['userid'].'" ');  

$signature=mysqli_fetch_array($abasd); 



$subject='Invoice: #'.$invoiceData['invoiceId'].' - '.strip($invoicedataa['invoiceCompany']).'';



$mailbody=file_get_contents($fullurl.'printInvoice.php?queryId='.$_REQUEST['queryId'].'&id='.$_REQUEST['id'].'&packageId='.$_REQUEST['packageId']);

 $mailbody=$mailbody.'<br /><br /><br />'.strip($signature['emailsignature']);



include "config/mail.php";  

$ccmail=$cc; 

$file_name=''; 

send_attachment_mail($fromemail,$userDetail['email'],stripslashes($subject),stripslashes($mailbody),$ccmail.','.$_SESSION['username'],$file_name);

 

 

 

$namevalue ='emailDate="'.date('Y-m-d H:i:s').'"'; 

$where='id="'.$id.'"';    

updatelisting('sys_invoiceMaster',$namevalue,$where);



?>



<script> 

parent.redirectpage('display.html?ga=query&view=1&id=<?php echo $_REQUEST['queryId']; ?>&c=5&save=1');

</script>







<?php  }











if(trim($_REQUEST['action'])=='gethoteldatavaoucher'  && $_REQUEST['packageId']!='' && $_REQUEST['queryId']!='' && $_REQUEST['hotel']!=''){  

 

$rsa=GetPageRecord('*','sys_packageBuilderEvent','id="'.$_REQUEST['hotel'].'"'); 

$enventData=mysqli_fetch_array($rsa);



$rs=GetPageRecord('*','sys_packageBuilderEvent',' name="'.$enventData['name'].'" and sectionType="Accommodation"  order by id asc');

while($rest=mysqli_fetch_array($rs)){ 

$roomTypename.=stripslashes($rest['hotelRoom']).', ';

}



if($enventData['id']!=''){

?>

<script>

$('#destinationId').val('<?php echo stripslashes($enventData['destinationName']); ?>');

$('#startDate').val('<?php echo date('d-m-Y',strtotime($enventData['startDate'])); ?>'); 

$('#endDate').val('<?php echo date('d-m-Y',strtotime($enventData['endDate'])); ?>'); 

$('#noOfRooms').val('<?php echo $enventData['singleRoom']+$enventData['doubleRoom']+$enventData['tripleRoom']+$enventData['quadRoom']+$enventData['cwbRoom']+$enventData['cnbRoom']; ?>');

$('#roomType').val('<?php echo stripslashes($enventData['hotelRoom']); ?>'); 

$('#nights').val('<?php echo daysbydates($enventData['startDate'],$enventData['endDate']); ?>');

$('#hotel').val('<?php echo stripslashes($enventData['name']); ?>');

$('#mealPlan').val('<?php echo stripslashes($enventData['mealPlan']); ?>');



  

</script>



<?php

}  else { 



?>

<script>

$('#destinationId').val('');

$('#startDate').val(''); 

$('#endDate').val(''); 

$('#noOfRooms').val('0');

$('#roomType').val(''); 

$('#nights').val('0');

$('#hotel').val('');

</script>



<?php } 



}













if(trim($_POST['action'])=='addvoucher' && $_POST['queryId']!='' && $_POST['packageId']!='' && $_POST['hotel']!='' && $_POST['confirmationNo']!='' && $_POST['welcomeContent']!=''){  



 

 $inclusionsvalue='';

 foreach($_POST['inclusions'] as $check) { 

			 $inclusionsvalue.=$check.',';

    }

  

 



if($_POST['editid']>0){



$namevalue2 ='queryId="'.decode($_POST['queryId']).'",packageId="'.decode($_POST['packageId']).'",bannerImage="'.trim($_REQUEST['bannerImage']).'",hotel="'.trim($_REQUEST['hotel']).'",confirmationNo="'.addslashes($_REQUEST['confirmationNo']).'",destination="'.addslashes($_REQUEST['destination']).'",leadPaxName="'.addslashes($_REQUEST['leadPaxName']).'",remark="'.addslashes($_REQUEST['remark']).'",nights="'.trim($_REQUEST['nights']).'",startDate="'.date('Y-m-d',strtotime($_REQUEST['startDate'])).'",endDate="'.date('Y-m-d',strtotime($_REQUEST['endDate'])).'",addedBy="'.$_SESSION['userid'].'",noOfRooms="'.$_POST['noOfRooms'].'",roomType="'.$_POST['roomType'].'",transferMode="'.$_POST['transferMode'].'",welcomeContent="'.addslashes($_POST['welcomeContent']).'",mealPlan="'.$_POST['mealPlan'].'",inclusions="'.$inclusionsvalue.'",dateAdded="'.date('Y-m-d H:i:s').'",adult="'.$_REQUEST['adult'].'",child="'.$_REQUEST['child'].'",infant="'.$_REQUEST['infant'].'",supplierName="'.addslashes($_REQUEST['supplierName']).'"';

$where='id="'.$_POST['editid'].'"';    

updatelisting('sys_voucherMaster',$namevalue2,$where);  





$namevalue3 ='details="Edit Voucher",queryId="'.decode($_REQUEST['queryId']).'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.date('Y-m-d H:i:s').'",logType="edit_query"'; 

addlisting('queryLogs',$namevalue3); 





} else { 



 $namevalue2 ='queryId="'.decode($_POST['queryId']).'",packageId="'.decode($_POST['packageId']).'",bannerImage="'.trim($_REQUEST['bannerImage']).'",hotel="'.trim($_REQUEST['hotel']).'",confirmationNo="'.addslashes($_REQUEST['confirmationNo']).'",destination="'.addslashes($_REQUEST['destination']).'",remark="'.addslashes($_REQUEST['remark']).'",leadPaxName="'.addslashes($_REQUEST['leadPaxName']).'",nights="'.trim($_REQUEST['nights']).'",startDate="'.date('Y-m-d',strtotime($_REQUEST['startDate'])).'",endDate="'.date('Y-m-d',strtotime($_REQUEST['endDate'])).'",addedBy="'.$_SESSION['userid'].'",noOfRooms="'.$_POST['noOfRooms'].'",roomType="'.$_POST['roomType'].'",transferMode="'.$_POST['transferMode'].'",welcomeContent="'.addslashes($_POST['welcomeContent']).'",mealPlan="'.$_POST['mealPlan'].'",inclusions="'.$inclusionsvalue.'",dateAdded="'.date('Y-m-d H:i:s').'",adult="'.$_REQUEST['adult'].'",child="'.$_REQUEST['child'].'",infant="'.$_REQUEST['infant'].'",supplierName="'.addslashes($_REQUEST['supplierName']).'"';

addlistinggetlastid('sys_voucherMaster',$namevalue2); 



$namevalue3 ='details="Add Voucher",queryId="'.decode($_REQUEST['queryId']).'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.date('Y-m-d H:i:s').'",logType="edit_query"'; 

addlisting('queryLogs',$namevalue3); 

/*Send Whatsapp*/
$query=GetPageRecord('*','queryMaster','id="'.decode($_POST['queryId']).'"'); 
$editresult=mysqli_fetch_array($query);

$clientName=$editresult["submitName"] . $editresult["name"];
$clientMobile=$editresult["phone"];
$userName=getUserName($editresult["assignTo"]);
$dest=getCityName($editresult['destinationId']);
$queryId=encode($editresult['destinationId']);
$travelDate=date("d M Y",strtotime($editresult["startDate"]));


$rsa=GetPageRecord('*','sys_userMaster','id="'.$editresult["assignTo"].'"'); 
$userDetail=mysqli_fetch_array($rsa);

$destinationData=GetPageRecord('name','cityMaster','id="'.$editresult["destinationId"].'"'); 
$destinationData11=mysqli_fetch_array($destinationData);

$invoiceUrl=urlencode($fullurl.'viewvoucher.php?id='.encode($lastId).'&sendmail=1');
/*
$data='https://api.easysocial.in/api/v1/wa-templates/send/clbvymbh50qg73yai68e0f2fp/121/78/API/91'.urlencode($clientMobile).'?header1=https://storage.googleapis.com/easysocial_production/business-assets%2Fbusiness-78%2FEngage-assets%2Fclbvy15fz0q1d3yai277r6ztm&body1='.urlencode($clientName).'&body2='.urlencode($destinationData11["name"]).'&body3='.encode($editresult["id"]).'&body4='.trim($_REQUEST['hotel']).'&body5='.$invoiceUrl.'&body6='.urlencode($userName).'&body7='.urlencode($LoginUserDetails["mobile"]).'&body8='.urlencode($LoginUserDetails["email"]).'';
file_get_contents($data);

*/


}















?> 

<script> 

parent.redirectpage('display.html?ga=query&view=1&id=<?php echo $_REQUEST['queryId']; ?>&c=8&save=1'); 

</script> 

<?php

}







if(trim($_POST['action'])=='schedulepaymentPlan' && $_POST['queryId']!='' && $_POST['packageId']!='' && $_POST['payment']>0){  



$paymentschedule = trim($_POST['paymentschedule']);

$payment = trim($_POST['payment']);



$totalpay=round($payment/$paymentschedule);



for($i=1; $i<=$paymentschedule; $i++){



 $namevalue2 ='queryId="'.decode($_POST['queryId']).'",packageId="'.decode($_POST['packageId']).'",amount="'.$totalpay.'",paymentStatus="2",paymentDate="'.date('Y-m-d').'"';

addlistinggetlastid('sys_PackagePayment',$namevalue2);



} 

?> 

<script> 

parent.redirectpage('display.html?ga=query&view=1&id=<?php echo $_REQUEST['queryId']; ?>&c=5&save=1'); 

</script> 

<?php

}

 

 

 

 

 



if(trim($_REQUEST['action'])=='sendpaymentWithoutLink'  && $_REQUEST['pid']!='' && $_REQUEST['qid']!='' && $_REQUEST['id']!=''){  



$queryId=decode($_REQUEST['qid']);

$packageId=decode($_REQUEST['pid']);

$id=decode($_REQUEST['id']);



$fd=GetPageRecord('*','queryMaster','id="'.$queryId.'"'); 

$queryData=mysqli_fetch_array($fd);



$rsa=GetPageRecord('*','userMaster','id="'.$queryData['clientId'].'"'); 

$userDetail=mysqli_fetch_array($rsa);



$rs=GetPageRecord($select,'sys_userMaster','id in (select addedBy from sys_userMaster where id="'.$queryData['addedBy'].'") '); 

$invoicedataa=mysqli_fetch_array($rs);





if($_REQUEST['acn']==1){ 

$subject='Payment Acknowledgement (via '.strip($invoicedataa['invoiceCompany']).')';

} else { 

$subject='Payment Request (via '.strip($invoicedataa['invoiceCompany']).')'; 

}







$mailbody=file_get_contents($fullurl.'packagePaymentLink.php?pid='.$_REQUEST['pid'].'&id='.$_REQUEST['id'].'&qid='.$_REQUEST['qid'].'&wt=1');

 



include "config/mail.php";  

$ccmail=$_POST['ccmails']; 

$file_name=''; 

send_attachment_mail($fromemail,$userDetail['email'],stripslashes($subject),stripslashes($mailbody),$ccmail.','.$_SESSION['username'],$file_name);

 

 

 

$namevalue ='paymentWithoutLinkDate="'.date('Y-m-d H:i:s').'"'; 

$where='id="'.$id.'"';    

updatelisting('sys_PackagePayment',$namevalue,$where);



?>



<script> 

parent.redirectpage('display.html?ga=query&view=1&id=<?php echo $_REQUEST['qid']; ?>&c=5&save=1');

</script>







<?php  }







if(trim($_REQUEST['action'])=='saveconfee' && $_REQUEST['queryId']!='' && $_REQUEST['id']!=''){  



$conFee = trim($_REQUEST['conFee']);  
$namevalue2 ='conFee="'.$conFee.'"';

$where='id="'.decode($_REQUEST['id']).'"';    

updatelisting('sys_PackagePayment',$namevalue2,$where);
}



if(trim($_REQUEST['action'])=='sendSelectedPaymentPlanToMail' && $_REQUEST['queryId']!='' && $_REQUEST['packageId']!=''){  



$sendPaymentPlan = trim($_REQUEST['sendPaymentPlan']);   

$queryId=decode($_REQUEST['queryId']);

$packageId=decode($_REQUEST['packageId']); 



 



$fd=GetPageRecord('*','queryMaster','id="'.$queryId.'"'); 

$queryData=mysqli_fetch_array($fd);



$rsa=GetPageRecord('*','userMaster','id="'.$queryData['clientId'].'"'); 

$userDetail=mysqli_fetch_array($rsa);



$rs=GetPageRecord($select,'sys_userMaster','id in (select addedBy from sys_userMaster where id="'.$queryData['addedBy'].'") '); 

$invoicedataa=mysqli_fetch_array($rs);







$subject='Payment Plan (via '.strip($invoicedataa['invoiceCompany']).')';



$mailbody=file_get_contents($fullurl.'packagePaymentLink.php?pid='.$_REQUEST['packageId'].'&qid='.$_REQUEST['queryId'].'&shal=1');

 



include "config/mail.php";  

$ccmail=trim($_POST['ccmails']); 

$file_name=''; 

send_attachment_mail($fromemail,$userDetail['email'],stripslashes($subject),stripslashes($mailbody),$ccmail.','.$_SESSION['username'],$file_name);

 

 

 

$namevalue2 ='sendPaymentPlanDate="'.date('Y-m-d H:i:s').'"';

$where='id="'.decode($_REQUEST['queryId']).'"';    

updatelisting('queryMaster',$namevalue2,$where);

/*Send Whatsapp*/
$query=GetPageRecord('*','queryMaster','id="'.$queryData["id"].'"'); 
$editresult=mysqli_fetch_array($query);

$abcd=GetPageRecord('*','sys_packageBuilder','confirmQuote="1" and queryId="'.$editresult['id'].'"'); 
$result=mysqli_fetch_array($abcd);

$clientName=$editresult["submitName"].$editresult["name"];
$clientMobile=$editresult["phone"];
$userName=getUserName($editresult["assignTo"]);
$dest=getCityName($editresult['destinationId']);
$queryId=encode($editresult['destinationId']);
$travelDate=date('d M Y',strtotime($_REQUEST['startDate']));

$rsa=GetPageRecord('*','sys_userMaster','id="'.$editresult["assignTo"].'"'); 
$userDetail=mysqli_fetch_array($rsa);

$destinationData=GetPageRecord('name','cityMaster','id="'.$editresult["destinationId"].'"');
$destinationData11=mysqli_fetch_array($destinationData);


if($result["currency"]!=""){
	$currency=$result["currency"];
}else{
	$currency="INR";
}

$totalfinalcost=urlencode($currency.number_format(round($result['grossPrice']+$result['totalDiscount'])));

$packageUrl=urlencode($fullurlproposal."sharepackage/".encode($result['id']).".html");

$receiptUrl='https://iyaatra.com/crm/download-payment-receipt.html?id='.$_POST['editid'].'';

$payData='0';

$rs=GetPageRecord('*','sys_PackagePayment',' queryId="'.$editresult['id'].'" and packageId="'.$result['id'].'" and paymentStatus=2 and paymentDate>"'.date("Y-m-d").'" order by paymentDate asc');
while($paymentlist=mysqli_fetch_array($rs)){
	$payData.=date('d M Y',strtotime($paymentlist['paymentDate'])).'-'.$currency.$paymentlist['amount'].',';
}

$todayPayment=GetPageRecord('*','sys_PackagePayment',' queryId="'.$editresult['id'].'" and packageId="'.$result['id'].'" and paymentStatus=2 and paymentDate="'.date("Y-m-d").'" order by paymentDate asc');
$todayPaymentData=mysqli_fetch_array($todayPayment);

$tPayment=urlencode($currency.$todayPaymentData["amount"]);

$data='https://api.easysocial.in/api/v1/wa-templates/send/clbknvaug0clc9naiffcs32yk/93/78/API/91'.urlencode($clientMobile).'?header1=https://storage.googleapis.com/easysocial_production/iyaatra/iyaatra-payment_schedule.png&body1='.urlencode($clientName).'&body2='.urlencode($destinationData11["name"]).'&body3='.encode($editresult["id"]).'&body4='.$totalfinalcost.'&body5='.$packageUrl.'&body6='.$tPayment.'&body7='.urlencode($payData);

file_get_contents($data);

?>



<script> 

parent.redirectpage('display.html?ga=query&view=1&id=<?php echo $_REQUEST['queryId']; ?>&c=5&save=1');

</script>







<?php  

}





















if(trim($_POST['action'])=='savemailsetting' && trim($_POST['fromName'])!='' && trim($_POST['emailAccount'])!='' && trim($_POST['emailPassword'])!='' && trim($_POST['smtpServer'])!='' && trim($_POST['emailPort'])!=''){ 

 



$fromName=$_POST['fromName'];  

$emailAccount=$_POST['emailAccount'];  

$emailPassword=$_POST['emailPassword'];  

$smtpServer=$_POST['smtpServer'];  

$emailPort=$_POST['emailPort'];  

$securityType=$_POST['securityType'];  



$namevalue ='fromName="'.$fromName.'",emailAccount="'.$emailAccount.'",emailPassword="'.$emailPassword.'",smtpServer="'.$smtpServer.'",emailPort="'.$emailPort.'",securityType="'.$securityType.'"'; 

$where='id="'.$_SESSION['userid'].'"';    

updatelisting('sys_userMaster',$namevalue,$where); 



 



?> 

<script>   

parent.redirectpage('display.html?ga=mailsetting&save=1');  

</script> 

<?php  } 




if($_POST['action']=='importFBleads' && $_FILES['importfield']['name']!=''){  

require_once('spreadsheet-reader-master/php-excel-reader/excel_reader2.php'); 

require_once('spreadsheet-reader-master/SpreadsheetReader.php');

$addedBy=$_SESSION['userid'];  

$dateAdded=date('Y-m-d H:i:s');

$allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];  

  if(in_array($_FILES["importfield"]["type"],$allowedFileType)){ 

        $targetPath = 'importfiles/'.$_FILES['importfield']['name']; 

        move_uploaded_file($_FILES['importfield']['tmp_name'], $targetPath);  

		    $n=0;

        $Reader = new SpreadsheetReader($targetPath); 

        $sheetCount = count($Reader->sheets()); 

         for($i=0;$i<$sheetCount;$i++){ 

            $Reader->ChangeSheet($i);

            foreach ($Reader as $Row){ 	 

			$n++;

			if($n>1){

$leadsource = trim($Row[0]); 

$travelMonth = trim($Row[1]); 

$description = trim($Row[2]); 

$clientName = trim($Row[3]); 

$email = trim($Row[4]); 

$phone = trim($Row[5]); 

$fromCity = trim($Row[6]);  

$destination = trim($Row[7]);  

$chekin = date('Y-m-d', strtotime(trim($Row[8]))); 

$checkout = date('Y-m-d', strtotime(trim($Row[9])));  

$adult = trim($Row[10]); 

$child = trim($Row[11]); 

$infant=trim($Row[12]); 

$details=trim($Row[13]);

$assignTo=trim($Row[14]);

 

$clientId='';



if($clientName==''){

$clientName=$phone;

}



if($leadsource=='fb' || $leadsource=='ig'){



if($leadsource=='fb'){

$leadSource= '13';

}



if($leadsource=='ig'){

$leadSource= '14';

}

}else{



$a=GetPageRecord('*','querySourceMaster','name="'.$leadsource.'"');  

if(mysqli_num_rows($a)>0){

$datalead=mysqli_fetch_array($a); 

$leadSource=$datalead['id'];

 }else{ 

$leadSource= '16';

} 

}

$a=GetPageRecord('*','cityMaster','name="'.$destination.'"');  

if(mysqli_num_rows($a)>0){

$datacity=mysqli_fetch_array($a); 

$destinationId=$datacity['id'];

 }else{

$namevalue ='name="'.$destination.'",status=1 ';  

$lstDest=addlistinggetlastid('cityMaster',$namevalue); 

$destinationId= $lstDest;

} 

// $um=GetPageRecord('*','sys_userMaster','firstName="'.trim($assign).'"');  

// if(mysqli_num_rows($um)>0){

// $assigned=mysqli_fetch_array($um); 

// $assignId=$assigned['id'];

// }

$a=GetPageRecord('*','userMaster','mobile="'.$phone.'" and userType=4'); 

if(mysqli_num_rows($a)>0){

$profilename=mysqli_fetch_array($a); 

$clientName= $profilename['firstName'].' '.$profilename['lastName'];

$clientId= $profilename['id'];

}else{  

$namevalue ='email="'.$email.'",mobile="'.$phone.'",firstName="'.$clientName.'",status=1,profileId=5,userType=4,dateAdded="'.time().'",addedBy="'.$_SESSION['userid'].'"';
$clientId=addlistinggetlastid('userMaster',$namevalue);
}

if($phone!=''){ 

$namevalue ='startDate="'.$chekin.'",endDate="'.$checkout.'",name="'.$clientName.'",phone="'.$phone.'",cityId="",email="'.$email.'",destinationId="'.$destinationId.'",serviceId="1",adult="'.$adult.'",child="'.$child.'",infant="'.$infant.'",leadSource="'.$leadSource.'",details="'.$description.' ('.$details.')'.'",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'",updateDate="'.$dateAdded.'",clientId="'.$clientId.'",fromCity="Delhi",travelMonth="'.$travelMonth.'",assignTo="'.$assignTo.'"';  

$queryId=addlistinggetlastid('queryMaster',$namevalue);

/*Send Whatsapp SMS*/
$clientName=$clientName;
$clientMobile=$phone;
$userName=getUserNameNew(1);
$travelDate=date("d M Y",strtotime($chekin));

$destinationData=GetPageRecord('name','cityMaster','id="'.$destinationId.'"'); 
$destinationData11=mysqli_fetch_array($destinationData);

$pax=urlencode($adult.' Adult + '.$child.' Child');


$data='https://api.easysocial.in/api/v1/wa-templates/send/clbknqlvp0ci09naicpy82iw9/90/78/API/91'.urlencode($clientMobile).'?header1=https://storage.googleapis.com/easysocial_production/iyaatra/iyaatra-welcome.png&body1='.urlencode($clientName).'&body2='.urlencode($userName).'&body3='.urlencode($destinationData11["name"]).'&body4='.encode($queryId).'&body5='.urlencode($travelDate).'&body6='.$pax;

file_get_contents($data);

		}  

 		}

		}

    }

  }else{  
    echo $type = "error"; 
    echo $message = "Invalid File Type. Upload Excel File."; 
  }  

?>  

<script> parent.redirectpage('display.html?ga=query&save=1'); </script>

<?php } 



















if(trim($_POST['action'])=='addmanualvoucher' && $_POST['hotel']!='' && $_POST['confirmationNo']!='' && $_POST['welcomeContent']!=''){  



 

  

  

 



if($_POST['editid']>0){ 

$namevalue2 ='bannerImage="'.trim($_REQUEST['bannerImage']).'",hotel="'.trim($_REQUEST['hotel']).'",confirmationNo="'.addslashes($_REQUEST['confirmationNo']).'",destination="'.addslashes($_REQUEST['destination']).'",leadPaxName="'.addslashes($_REQUEST['leadPaxName']).'",remark="'.addslashes($_REQUEST['remark']).'",nights="'.trim($_REQUEST['nights']).'",startDate="'.date('Y-m-d',strtotime($_REQUEST['startDate'])).'",endDate="'.date('Y-m-d',strtotime($_REQUEST['endDate'])).'",addedBy="'.$_SESSION['userid'].'",noOfRooms="'.$_POST['noOfRooms'].'",roomType="'.$_POST['roomType'].'",transferMode="'.$_POST['transferMode'].'",welcomeContent="'.addslashes($_POST['welcomeContent']).'",mealPlan="'.$_POST['mealPlan'].'",inclusions="'.addslashes($_POST['inclusions']).'",dateAdded="'.date('Y-m-d H:i:s').'",adult="'.$_REQUEST['adult'].'",child="'.$_REQUEST['child'].'",infant="'.$_REQUEST['infant'].'",supplierName="'.addslashes($_REQUEST['supplierName']).'"';

$where='id="'.$_POST['editid'].'"';    

updatelisting('sys_manualVoucherMaster',$namevalue2,$where);  

 

} else { 



 $namevalue2 ='bannerImage="'.trim($_REQUEST['bannerImage']).'",hotel="'.trim($_REQUEST['hotel']).'",confirmationNo="'.addslashes($_REQUEST['confirmationNo']).'",destination="'.addslashes($_REQUEST['destination']).'",remark="'.addslashes($_REQUEST['remark']).'",leadPaxName="'.addslashes($_REQUEST['leadPaxName']).'",nights="'.trim($_REQUEST['nights']).'",startDate="'.date('Y-m-d',strtotime($_REQUEST['startDate'])).'",endDate="'.date('Y-m-d',strtotime($_REQUEST['endDate'])).'",addedBy="'.$_SESSION['userid'].'",noOfRooms="'.$_POST['noOfRooms'].'",roomType="'.$_POST['roomType'].'",transferMode="'.$_POST['transferMode'].'",welcomeContent="'.addslashes($_POST['welcomeContent']).'",mealPlan="'.$_POST['mealPlan'].'",inclusions="'.addslashes($_POST['inclusions']).'",dateAdded="'.date('Y-m-d H:i:s').'",adult="'.$_REQUEST['adult'].'",child="'.$_REQUEST['child'].'",infant="'.$_REQUEST['infant'].'",supplierName="'.addslashes($_REQUEST['supplierName']).'"';

addlistinggetlastid('sys_manualVoucherMaster',$namevalue2); 

 

}















?> 

<script> 

parent.redirectpage('display.html?ga=manualvoucher&save=1'); 

</script> 

<?php

}











if(trim($_POST['action'])=='composemailmanualvoucher' && $_POST['subject']!='' && $_POST['EmailDetails']!=''){   

$subject=addslashes($_POST['subject']); 

$EmailDetails=addslashes($_POST['EmailDetails']);  

$day=addslashes($_POST['day']);  

$toEmail=addslashes($_POST['toEmail']); 

$cc=addslashes($_POST['cc']);  







if($_FILES["attachment"]["tmp_name"]!=""){ 

$rt=mt_rand().strtotime(date("YMDHis")); 

$companyLogoFileName=basename($_FILES['attachment']['name']); 

$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION); 

$attachment=time().$rt.'.'.$companyLogoFileExtension;  

move_uploaded_file($_FILES["attachment"]["tmp_name"], "voucherAttachments/{$attachment}"); 

}







?> 

<script> 

parent.$('#popcontent').html('<div style="padding:10px; text-align:center;"><img src="images/loading.gif" width="32" ></div>'); 

</script> 

<?php  



include "config/mail.php";  



$ccmail=$cc; 

$file_name=''; 

send_attachment_mail($fromemail,$toEmail,stripslashes($subject),stripslashes($EmailDetails.'<img src="'.$fullurl.'readmail.php?m='.encode($lastid).'" width="0" height="0">'),$ccmail.','.$_SESSION['username'],$attachment); 

?>



<script> 

parent.redirectpage('display.html?ga=manualvoucher&id=<?php echo encode($queryId); ?>&save=1'); 

  

</script>







<?php  }



if($_POST['action']=='loginmanualvoucher' && trim($_POST['pin'])!=''){

$pin=trim($_POST['pin']); 

 

$ras=GetPageRecord('*','sys_userMaster','id=1 and manualVoucherPin="'.$pin.'"'); 

if(mysqli_num_rows($ras)>0){  

$_SESSION['manualVoucherPin']=$pin; 

?> 

<script> 

parent.redirectpage('display.html?ga=manualvoucher');  

</script> 

<?php 

}else{ 

?> 

<script> 

alert('Pin not matched!');

</script> 

<?php 

} 

}









if(trim($_POST['action'])=='addmealplan'){    

 



if($_POST['editId']>0){ 

$namevalue2 ='name="'.trim($_REQUEST['name']).'",status="'.($_REQUEST['status']).'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.date('Y-m-d H:i:s').'"';

$where='id="'.decode($_POST['editId']).'"';    

updatelisting('mealPlanMaster',$namevalue2,$where);  

 

} else { 



$namevalue2 ='name="'.trim($_REQUEST['name']).'",status="'.($_REQUEST['status']).'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.date('Y-m-d H:i:s').'"';

addlistinggetlastid('mealPlanMaster',$namevalue2); 

 

}



?> 

<script> 

parent.redirectpage('display.html?ga=mealplan&save=1'); 

</script> 

<?php 

}







if(trim($_POST['action'])=='cityMaster'){    

if($_POST['editId']>0){ 

$namevalue2 ='name="'.trim($_REQUEST['name']).'",themeId="'.trim($_REQUEST['themeId']).'"';

$where='id="'.decode($_POST['editId']).'"';    

updatelisting('cityMaster',$namevalue2,$where);  

} else { 

$namevalue2 ='name="'.trim($_REQUEST['name']).'",themeId="'.trim($_REQUEST['themeId']).'"';

addlistinggetlastid('cityMaster',$namevalue2); 

}

?> 

<script> 

parent.redirectpage('display.html?ga=destinations&save=1'); 

</script> 

<?php 

}



if(trim($_POST['action'])=='addKeyword'){    

  if($_POST['editId']>0){ 
  
  $namevalue2 ='keyword="'.trim($_REQUEST['keyword']).'",url="'.trim($_REQUEST['url']).'",categoryId="'.trim($_REQUEST['categoryId']).'"';
  
  $where='id="'.decode($_POST['editId']).'"';    
  
  updatelisting('keywordMaster',$namevalue2,$where);  
  
  } else { 
  
    $namevalue2 ='keyword="'.trim($_REQUEST['keyword']).'",url="'.trim($_REQUEST['url']).'",categoryId="'.trim($_REQUEST['categoryId']).'"';
  
  addlistinggetlastid('keywordMaster',$namevalue2); 
  
  }
  
  ?> 
  
  <script> 
  
  parent.redirectpage('display.html?ga=footerKeyword&save=1'); 
  
  </script> 
  
  <?php 
  
  }


  if(trim($_POST['action'])=='addKeywordCategory'){    

    if($_POST['editId']>0){ 
    
    $namevalue2 ='name="'.trim($_POST['name']).'",status="'.$_POST['status'].'"';
    
    $where='id="'.decode($_POST['editId']).'"';    
    
    updatelisting('keywordCategoryMaster',$namevalue2,$where);  
    
    } else { 
    
    $namevalue2 ='name="'.trim($_POST['name']).'",status="'.$_POST['status'].'"';
    
    addlistinggetlastid('keywordCategoryMaster',$namevalue2); 
    
    }
    
    ?> 
    
    <script> 
    
    parent.redirectpage('display.html?ga=keywordCategory&save=1'); 
    
    </script> 
    
    <?php 
    
    }











  if(trim($_POST['action'])=='addLeisure' && trim($_POST['name'])!='' && trim($_POST['startDate'])!=''){   

 $packageDays=addslashes($_POST['packageDays']);

$hotelName=addslashes($_POST['name']);  

$startDate=date('Y-m-d',strtotime($_POST['startDate']));  

$endDate=date('Y-m-d',strtotime($_POST['startDate']));  

$hotelRoom=addslashes($_POST['hotelRoom']);  

$hotelCategory=addslashes($_POST['hotelCategory']);  

$mealPlan=addslashes($_POST['mealPlan']);   

$singleRoom=addslashes($_POST['singleRoom']);  

$doubleRoom=addslashes($_POST['doubleRoom']);  

$tripleRoom=addslashes($_POST['tripleRoom']);  

$quadRoom=addslashes($_POST['quadRoom']);  

$cwbRoom=addslashes($_POST['cwbRoom']);  

$cnbRoom=addslashes($_POST['cnbRoom']);  

$checkIn=addslashes($_POST['checkIn']);  

$checkOut=addslashes($_POST['checkOut']);   

$pid=decode($_POST['pid']);   

$editId=addslashes($_POST['editId']);  

$description=addslashes($_POST['description']);  

$destinationName=addslashes(trim($_POST['destinationName']));

$days=daysbydates($startDate,$endDate)+1;

 

if($editId!=''){ 

 

$namevalue ='name="'.$hotelName.'",startDate="'.$startDate.'",endDate="'.$endDate.'",hotelRoom="'.$hotelRoom.'",description="'.$description.'",hotelCategory="'.$hotelCategory.'",mealPlan="'.$mealPlan.'",singleRoom="'.$singleRoom.'",doubleRoom="'.$doubleRoom.'",tripleRoom="'.$tripleRoom.'",quadRoom="'.$quadRoom.'",cwbRoom="'.$cwbRoom.'",cnbRoom="'.$cnbRoom.'",checkIn="'.$checkIn.'",checkOut="'.$checkOut.'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.date('Y-m-d H:i:s').'",days="'.$days.'",destinationName="'.$destinationName.'"';  

$where='id="'.decode($editId).'"';    

updatelisting('sys_packageBuilderEvent',$namevalue,$where);  



} else { 

 

$namevalue ='name="'.$hotelName.'",packageId="'.$pid.'",startDate="'.$startDate.'",packageDays="'.$packageDays.'",description="'.$description.'",endDate="'.$endDate.'",hotelRoom="'.$hotelRoom.'",hotelCategory="'.$hotelCategory.'",mealPlan="'.$mealPlan.'",singleRoom="'.$singleRoom.'",doubleRoom="'.$doubleRoom.'",tripleRoom="'.$tripleRoom.'",quadRoom="'.$quadRoom.'",cwbRoom="'.$cwbRoom.'",cnbRoom="'.$cnbRoom.'",checkIn="'.$checkIn.'",checkOut="'.$checkOut.'",sectionType="Leisure",addedBy="'.$_SESSION['userid'].'",days="'.$days.'",dateAdded="'.date('Y-m-d H:i:s').'",destinationName="'.$destinationName.'"';   

$lstaddid=addlistinggetlastid('sys_packageBuilderEvent',$namevalue);   

 

} 





?> 

<script> 

parent.redirectpage('display.html?ga=itineraries&view=1&id=<?php echo $_POST['pid']; ?>&save=1'); 

</script> 

<?php 

}







if(trim($_POST['action'])=='addInclusions'){    

  

  



if($_FILES["inclusionsImg"]["tmp_name"]!=""){ 

$rt=mt_rand().strtotime(date("YMDHis")); 

$companyLogoFileName=basename($_FILES['inclusionsImg']['name']); 

$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION); 

$inclusionsImg=time().$rt.'.'.$companyLogoFileExtension;  

move_uploaded_file($_FILES["inclusionsImg"]["tmp_name"], "package_image/{$inclusionsImg}"); 

}

 

if($inclusionsImg==''){ 

$inclusionsImg=trim($_POST['inclusionsImgOld']); 

}

  

 



if($_FILES["impTipsImg"]["tmp_name"]!=""){ 

$rt=mt_rand().strtotime(date("YMDHis")); 

$companyLogoFileName1=basename($_FILES['impTipsImg']['name']); 

$companyLogoFileExtension1=pathinfo($companyLogoFileName1, PATHINFO_EXTENSION); 

$impTipsImg=time().$rt.'.'.$companyLogoFileExtension1;  

move_uploaded_file($_FILES["impTipsImg"]["tmp_name"], "package_image/{$impTipsImg}"); 

}

 

if($impTipsImg==''){ 

$impTipsImg=trim($_POST['impTipsImgOld']); 

}  



 



if($_FILES["exclusionsImg"]["tmp_name"]!=""){ 

$rt=mt_rand().strtotime(date("YMDHis")); 

$companyLogoFileName2=basename($_FILES['exclusionsImg']['name']); 

$companyLogoFileExtension2=pathinfo($companyLogoFileName2, PATHINFO_EXTENSION); 

$exclusionsImg=time().$rt.'.'.$companyLogoFileExtension2;  

move_uploaded_file($_FILES["exclusionsImg"]["tmp_name"], "package_image/{$exclusionsImg}"); 

}

 

if($exclusionsImg==''){ 

$exclusionsImg=trim($_POST['exclusionsImgOld']); 

}  



if($_FILES["travelInfoImg"]["tmp_name"]!=""){ 

$rt=mt_rand().strtotime(date("YMDHis")); 

$companyLogoFileName3=basename($_FILES['travelInfoImg']['name']); 

$companyLogoFileExtension3=pathinfo($companyLogoFileName3, PATHINFO_EXTENSION); 

$travelInfoImg=time().$rt.'.'.$companyLogoFileExtension3;  

move_uploaded_file($_FILES["travelInfoImg"]["tmp_name"], "package_image/{$travelInfoImg}"); 

}

 

if($travelInfoImg==''){ 

$travelInfoImg=trim($_POST['travelInformationImgOld']); 

}

 

$namevalue2 ='inclusionsTitle="'.addslashes(($_POST['inclusionsTitle'])).'",importantTipsTitle="'.addslashes(($_POST['importantTipsTitle'])).'",exclusionsTitle="'.addslashes(($_POST['exclusionsTitle'])).'",travelInformationTitle="'.addslashes(($_POST['travelInformationTitle'])).'",inclusionsImg="'.$inclusionsImg.'",packageInclusions="'.addslashes(($_POST['packageInclusions'])).'",impTipsImg="'.$impTipsImg.'",packageImportantTips="'.addslashes(($_POST['packageImportantTips'])).'",exclusionsImg="'.$exclusionsImg.'",packageExclusions="'.addslashes(($_POST['packageExclusions'])).'",travelInfoImg="'.$travelInfoImg.'",packageTravelInfo="'.addslashes(($_POST['packageTravelInfo'])).'"';

$where='id="1"';    

updatelisting('sys_userMaster',$namevalue2,$where);  

 



?> 

<script> 

parent.redirectpage('display.html?ga=inclusions&save=1'); 

</script> 

<?php 

}













  if(trim($_POST['action'])=='addCruise' && trim($_POST['name'])!='' && trim($_POST['startDate'])!=''){   

 $packageDays=addslashes($_POST['packageDays']);

$hotelName=addslashes($_POST['name']);  

$startDate=date('Y-m-d',strtotime($_POST['startDate']));  

$endDate=date('Y-m-d',strtotime($_POST['startDate']));  

$hotelRoom=addslashes($_POST['hotelRoom']);  

$hotelCategory=addslashes($_POST['hotelCategory']);  

$mealPlan=addslashes($_POST['mealPlan']);   

$singleRoom=addslashes($_POST['singleRoom']);  

$doubleRoom=addslashes($_POST['doubleRoom']);  

$tripleRoom=addslashes($_POST['tripleRoom']);  

$quadRoom=addslashes($_POST['quadRoom']);  

$cwbRoom=addslashes($_POST['cwbRoom']);  

$cnbRoom=addslashes($_POST['cnbRoom']);  

$checkIn=addslashes($_POST['checkIn']);  

$checkOut=addslashes($_POST['checkOut']);   

$showTime=addslashes($_POST['showTime']);  

$pid=decode($_POST['pid']);   

$editId=addslashes($_POST['editId']);  

$description=addslashes($_POST['description']);  

$destinationName=addslashes(trim($_POST['destinationName']));

$days=daysbydates($startDate,$endDate)+1;

 

if($editId!=''){ 

 

$namevalue ='name="'.$hotelName.'",startDate="'.$startDate.'",endDate="'.$endDate.'",hotelRoom="'.$hotelRoom.'",description="'.$description.'",hotelCategory="'.$hotelCategory.'",mealPlan="'.$mealPlan.'",singleRoom="'.$singleRoom.'",doubleRoom="'.$doubleRoom.'",tripleRoom="'.$tripleRoom.'",quadRoom="'.$quadRoom.'",cwbRoom="'.$cwbRoom.'",cnbRoom="'.$cnbRoom.'",checkIn="'.$checkIn.'",checkOut="'.$checkOut.'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.date('Y-m-d H:i:s').'",days="'.$days.'",destinationName="'.$destinationName.'",showTime="'.$showTime.'"';  

$where='id="'.decode($editId).'"';    

updatelisting('sys_packageBuilderEvent',$namevalue,$where);  



} else { 

 

$namevalue ='name="'.$hotelName.'",packageId="'.$pid.'",startDate="'.$startDate.'",packageDays="'.$packageDays.'",description="'.$description.'",endDate="'.$endDate.'",hotelRoom="'.$hotelRoom.'",hotelCategory="'.$hotelCategory.'",mealPlan="'.$mealPlan.'",singleRoom="'.$singleRoom.'",doubleRoom="'.$doubleRoom.'",tripleRoom="'.$tripleRoom.'",quadRoom="'.$quadRoom.'",cwbRoom="'.$cwbRoom.'",cnbRoom="'.$cnbRoom.'",checkIn="'.$checkIn.'",checkOut="'.$checkOut.'",sectionType="Cruise",addedBy="'.$_SESSION['userid'].'",days="'.$days.'",dateAdded="'.date('Y-m-d H:i:s').'",destinationName="'.$destinationName.'",showTime="'.$showTime.'"';   

$lstaddid=addlistinggetlastid('sys_packageBuilderEvent',$namevalue);   

 

} 





?> 

<script> 

parent.redirectpage('display.html?ga=itineraries&view=1&id=<?php echo $_POST['pid']; ?>&save=1'); 

</script> 

<?php 

}









if(trim($_POST['action'])=='stepverificationaction'){   



 

$namevalue ='stepVerification=0,qrCodeOn=0';  

$where='1';    

updatelisting('sys_userMaster',$namevalue,$where); 





foreach($_POST['stipverification'] as $check) { 

 $namevalue ='stepVerification=1';  

$where='id="'.decode($check).'"';    

updatelisting('sys_userMaster',$namevalue,$where);  

}





foreach($_POST['qrcodeon'] as $checkqrcodeon) { 

 $namevalue ='qrCodeOn=1';  

$where='id="'.decode($checkqrcodeon).'" and id!=1';    

updatelisting('sys_userMaster',$namevalue,$where);  

}



$namevalue ='qrCodeOn=1';  

$where='id=1';    

updatelisting('sys_userMaster',$namevalue,$where);  



?>

<script> 

parent.redirectpage('display.html?ga=team&save=1'); 

</script> 



<?php





}







if(trim($_REQUEST['action'])=='chqqr'){ 

if($LoginUserDetails['qrCode']==$LoginUserDetails['verifyQrCode']){  

?>

<script> 

redirectpage('<?php echo $fullurl; ?>');

</script> 

<?php

}

}















 if(trim($_POST['action'])=='addGuest' && trim($_POST['submitName'])!='' && trim($_POST['firstName'])!='' && trim($_POST['lastName'])!='' && trim($_POST['gender'])!='' && trim($_POST['startDate'])!='' ){   

$submitName=addslashes($_POST['submitName']);   

$firstName=addslashes($_POST['firstName']);   

$lastName=addslashes($_POST['lastName']);  

$gender=addslashes($_POST['gender']);  

$dob=date('Y-m-d', strtotime($_POST['startDate']));    

$editid=decode($_POST['editId']);

$queryId=decode($_POST['queryId']);  

 



if($editid!=''){ 

 

$namevalue ='queryId="'.$queryId.'",gender="'.$gender.'",dob="'.$dob.'",firstName="'.$firstName.'",lastName="'.$lastName.'",submitName="'.$submitName.'",dateAdded="'.date('Y-m-d H:i:s').'",addedBy="'.$_SESSION['userid'].'"';

$where='id="'.$editid.'"';    

updatelisting('sys_guests',$namevalue,$where);   

 

} else {  



$namevalue ='queryId="'.$queryId.'",gender="'.$gender.'",dob="'.$dob.'",firstName="'.$firstName.'",lastName="'.$lastName.'",submitName="'.$submitName.'",dateAdded="'.date('Y-m-d H:i:s').'",addedBy="'.$_SESSION['userid'].'"';

$lstaddid=addlistinggetlastid('sys_guests',$namevalue);  



} 





?> 

<script> 

parent.redirectpage('display.html?ga=query&view=1&id=<?php echo $_POST['queryId']; ?>&c=10&save=1'); 

</script> 

<?php 

}









if(trim($_POST['action'])=='addGuestDocuments' ){   

  

$editId=decode($_POST['editId']);

$queryId=decode($_POST['queryId']);   





if($_FILES["panCard"]["tmp_name"]!=""){ 

$rt=mt_rand().strtotime(date("YMDHis")); 

$companyLogoFileName=basename($_FILES['panCard']['name']); 

$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION); 

$panCard=time().$rt.'.'.$companyLogoFileExtension;  

move_uploaded_file($_FILES["panCard"]["tmp_name"], "profilepic/{$panCard}");



 

$namevalue ='queryId="'.$queryId.'",guestId="'.$editId.'",documentType="PanCard",document="'.$panCard.'",dateAdded="'.date('Y-m-d H:i:s').'",addedBy="'.$_SESSION['userid'].'"';

addlistinggetlastid('sys_guestsDucument',$namevalue);   

}



 



if($_FILES["passportFront"]["tmp_name"]!=""){ 

$rt=mt_rand().strtotime(date("YMDHis")); 

$companyLogoFileName=basename($_FILES['passportFront']['name']); 

$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION); 

$passportFront=time().$rt.'.'.$companyLogoFileExtension;  

move_uploaded_file($_FILES["passportFront"]["tmp_name"], "profilepic/{$passportFront}"); 

 

$namevalue ='queryId="'.$queryId.'",guestId="'.$editId.'",documentType="PassportFront",document="'.$passportFront.'",dateAdded="'.date('Y-m-d H:i:s').'",addedBy="'.$_SESSION['userid'].'"';

addlistinggetlastid('sys_guestsDucument',$namevalue);   

}



 



if($_FILES["passportBack"]["tmp_name"]!=""){ 

$rt=mt_rand().strtotime(date("YMDHis")); 

$companyLogoFileName=basename($_FILES['passportBack']['name']); 

$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION); 

$passportBack=time().$rt.'.'.$companyLogoFileExtension;  

move_uploaded_file($_FILES["passportBack"]["tmp_name"], "profilepic/{$passportBack}"); 

 

$namevalue ='queryId="'.$queryId.'",guestId="'.$editId.'",documentType="PassportBack",document="'.$passportBack.'",dateAdded="'.date('Y-m-d H:i:s').'",addedBy="'.$_SESSION['userid'].'"';

addlistinggetlastid('sys_guestsDucument',$namevalue);   

} 





 

 



$totfile=count($_FILES["flight"]["tmp_name"]);



for($i=0; $i<=$totfile; $i++) {

if($_FILES["flight"]["tmp_name"][$i]!=""){ 

$rt=mt_rand().strtotime(date("YMDHis")); 

$companyLogoFileName=basename($_FILES['flight']['name'][$i]); 

$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION); 

$flight=time().$rt.'.'.$companyLogoFileExtension;  

move_uploaded_file($_FILES["flight"]["tmp_name"][$i], "profilepic/{$flight}"); 

 

$namevalue ='queryId="'.$queryId.'",guestId="'.$editId.'",documentType="Flight",document="'.$flight.'",dateAdded="'.date('Y-m-d H:i:s').'",addedBy="'.$_SESSION['userid'].'"';

addlistinggetlastid('sys_guestsDucument',$namevalue);   

} 

}

















 

?> 

<script> 

parent.redirectpage('display.html?ga=query&view=1&id=<?php echo $_POST['queryId']; ?>&c=10&save=1'); 

</script> 

<?php 

}









if(trim($_REQUEST['action'])=='savesuppliercosting' && $_REQUEST['editId']!=''){ 

 

$confirmationNo=addslashes($_REQUEST['confirmationNo']);

$supplierId=addslashes($_REQUEST['supplierId']);

$status=addslashes($_REQUEST['statusId']);

$paidAmount=addslashes($_REQUEST['paidAmount']);

$pendingAmount=addslashes($_REQUEST['pendingAmount']);

$bookingStatusId=addslashes($_REQUEST['bookingStatusId']);

$lossAmount=addslashes($_REQUEST['lossAmount']);

$marginAmount=addslashes($_REQUEST['marginAmount']);









$r1selectedCurrency=addslashes($_REQUEST['r1Currency']);



$r1Currencyrate=addslashes($_REQUEST['r1Currencyrate']);

$r1XErate=addslashes($_REQUEST['r1XErate']);

$r1Cost=addslashes($_REQUEST['r1Cost']);



$r2Currencyrate=addslashes($_REQUEST['r2Currencyrate']);

$r2XErate=addslashes($_REQUEST['r2XErate']);

$r2Cost=addslashes($_REQUEST['r2Cost']); 





if($bookingStatusId==2 && $confirmationNo==''){

?>

<script> alert('Please enter confirmation number...!');

parent.$('#savingbutton').val('Save');

 </script>

<?php

exit();

}

$supplierAmount=addslashes($_REQUEST['supplierAmount']);

$dueDate=date('Y-m-d',strtotime($_REQUEST['dueDate']));

$suppliercancellationdate=date('Y-m-d',strtotime($_REQUEST['suppliercancellationdate']));



$namevalue ='supplierId="'.$supplierId.'",bookingStatusId="'.$bookingStatusId.'",supplierAmount="'.$supplierAmount.'",dueDate="'.$dueDate.'",paidAmount="'.$paidAmount.'",pendingAmount="'.$pendingAmount.'",supplierCancellationDate="'.$suppliercancellationdate.'",status="'.$status.'",confirmationNo="'.$confirmationNo.'",lossAmount="'.$lossAmount.'",marginAmount="'.$marginAmount.'",r1selectedCurrency="'.$r1selectedCurrency.'",r1Currencyrate="'.$r1Currencyrate.'",r1XErate="'.$r1XErate.'",r1Cost="'.$r1Cost.'",r2Currencyrate="'.$r2Currencyrate.'",r2XErate="'.$r2XErate.'",r2Cost="'.$r2Cost.'"';

$where='id="'.decode($_REQUEST['editId']).'"';    

updatelisting('sys_packageBuilderEvent',$namevalue,$where);



?> 

<script> 

parent.redirectpage('display.html?ga=query&view=1&id=<?php echo $_POST['queryId']; ?>&c=9&save=1'); 

</script> 

<?php 



} 







if(trim($_POST['action'])=='addSupplierNotes' && trim($_POST['queryId'])!='' && trim($_POST['id'])!='' && trim($_POST['remark'])!=''){   

 

$queryId=decode($_POST['queryId']);  

$serviceId=decode($_POST['id']);    

$remark=addslashes($_POST['remark']);   



$namevalue ='queryId="'.$queryId.'",serviceId="'.$serviceId.'",details="'.$remark.'",dateAdded="'.date('Y-m-d H:i:s').'",addedBy="'.$_SESSION['userid'].'"';   

addlistinggetlastid('supplierNotes',$namevalue); 



?> 

<script> 

parent.querySupplierNotes(); 

</script> 

<?php 

}




if(trim($_REQUEST['action'])=='deletebill' && trim($_REQUEST['parentId'])!='' && trim($_REQUEST['id'])!=''){    

deleteRecord('sys_PackagePayment','id="'.decode($_REQUEST['id']).'"');  

?> 

<script> 

parent.redirectpage('display.html?ga=query&view=1&id=<?php echo $_REQUEST['parentId']; ?>&save=1&c=5'); 

</script> 

<?php 

}


if(trim($_REQUEST['action'])=='deleteBranch' && trim($_REQUEST['agentId'])!='' && trim($_REQUEST['id'])!=''){    

deleteRecord('agentBranch','id="'.$_REQUEST['id'].'"');  

?> 

<script>
parent.redirectpage('display.html?ga=branch&id=<?php echo $_REQUEST['agentId']; ?>&view=1'); 
</script>

<?php 

}



 





if(trim($_POST['action'])=='addcurrencyexchange'){    

 
if($_FILES["changeprofilepic"]["tmp_name"]!=""){ 
$rt=mt_rand().strtotime(date("YMDHis")); 
$companyLogoFileName=basename($_FILES['changeprofilepic']['name']); 
$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION); 
$profilePhoto=time().$rt.'.'.$companyLogoFileExtension;  
move_uploaded_file($_FILES["changeprofilepic"]["tmp_name"], "upload/{$profilePhoto}"); 
} else {
$profilePhoto=$_REQUEST['oldflag'];
}



if($_POST['editId']>0){ 

$namevalue2 ='name="'.trim($_REQUEST['name']).'",rate="'.($_REQUEST['rate']).'",flagImg="'.($profilePhoto).'",status="'.($_REQUEST['status']).'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.date('Y-m-d H:i:s').'"';

$where='id="'.decode($_POST['editId']).'"';    

updatelisting('currencyExchangeMaster',$namevalue2,$where);  

 

} else { 



$namevalue2 ='name="'.trim($_REQUEST['name']).'",rate="'.($_REQUEST['rate']).'",flagImg="'.($profilePhoto).'",status="'.($_REQUEST['status']).'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.date('Y-m-d H:i:s').'"';

addlistinggetlastid('currencyExchangeMaster',$namevalue2); 

 

}



?> 

<script> 

parent.redirectpage('display.html?ga=currencyExchange'); 

</script> 

<?php 

}



 





if(trim($_REQUEST['action'])=='saveprice'){ 

 

$rs2=GetPageRecord('*','currencyExchangeMaster','id="'.$_REQUEST['currency'].'" order by id asc');

$restsup=mysqli_fetch_array($rs2); 

 

$namevalue2 ='r1Currency="'.trim($_REQUEST['currency']).'",r1XE="'.($restsup['rate']).'"';

$where='id="'.decode($_REQUEST['editId']).'"';    

//updatelisting('sys_packageBuilderEvent',$namevalue2,$where);  

  



?> 

<script> 

parent.$('.exchangecurr').text('<?php echo rtrim(rtrim((string)number_format($_REQUEST['netCost']/$restsup['rate'], 2, ".", ""),"0"),"."); ?>'); 

parent.$('#r1Currencyrate').val('<?php echo rtrim(rtrim((string)number_format($_REQUEST['netCost']/$restsup['rate'], 2, ".", ""),"0"),"."); ?>');   

parent.$('#r2Currency').val('<?php echo rtrim(rtrim((string)number_format($_REQUEST['netCost']/$restsup['rate'], 2, ".", ""),"0"),"."); ?>');



parent.$('.currname').text('<?php echo $restsup['name']; ?>'); 



parent.$('#r1XE').text('<?php echo $restsup['rate']; ?>'); 

parent.$('#r1XErate').val('<?php echo $restsup['rate']; ?>'); 

parent.$('#r2XE').val('<?php echo $restsup['rate']; ?>');



parent.$('#r2totalCost').text('<?php echo rtrim(rtrim((string)number_format($_REQUEST['netCost'], 2, ".", ""),"0"),"."); ?>'); 

parent.$('#r2Cost').text('<?php echo rtrim(rtrim((string)number_format($_REQUEST['netCost'], 2, ".", ""),"0"),"."); ?>'); 



 



</script> 

<?php 

}

 





if(trim($_REQUEST['action'])=='savepricemanual'){ 



$convert=round($_REQUEST['r2Currency']*$_REQUEST['r2XE']);

  

 

$namevalue2 ='r2XE="'.trim($_REQUEST['r2XE']).'",r2Currency="'.$convert.'"';

$where='id="'.decode($_REQUEST['editId']).'"';    

//updatelisting('sys_packageBuilderEvent',$namevalue2,$where);  

  



?> 

<script> 

parent.$('#r2Cost').val('<?php echo $convert; ?>');  

parent.$('#r2totalCost').text('<?php echo $convert; ?>');

parent.$('#supplierAmount').val('<?php echo $convert; ?>');

parent.$('#pendingAmount').val('<?php echo $convert-$_REQUEST['paidAmount']; ?>');



</script> 

<?php 

}













if(trim($_POST['action'])=='addHotelMaster' && $_POST['name']!='' && $_POST['destination']!=''){   



$name=addslashes($_POST['name']);   

$category=addslashes($_POST['category']);   

$destination=addslashes($_POST['destination']);    

$status=addslashes(strip_tags($_POST['status']));      

$address=addslashes(strip_tags($_POST['address']));

$details=addslashes(($_POST['details']));

$contactPerson=addslashes(($_POST['contactPerson']));

$contactPersonEmail=addslashes(($_POST['contactPersonEmail']));

$contactPersonPhone=addslashes(($_POST['contactPersonPhone']));

$imgLink=addslashes(($_POST['imgLink']));

$addedBy=$_SESSION['userid']; 



$dateAdded=date('Y-m-d H:i:s'); 





if($_FILES["image"]["tmp_name"]!=""){



$rt=time();



$companyLogoFileName=basename($_FILES['image']['name']);



$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION);



$profilePhoto=str_replace(' ','_',substr($companyLogoFileName, 0, strpos($companyLogoFileName, ".")).$rt.'.'.$companyLogoFileExtension);

 

move_uploaded_file($_FILES["image"]["tmp_name"], "package_image/{$profilePhoto}");

  

  

} else {

$profilePhoto=$_REQUEST['oldlogo'];

}

 



if($_REQUEST['editId']==''){  



$namevalue ='name="'.$name.'",category="'.$category.'",countryId="'.$countryId.'",destination="'.$destination.'",status="'.$status.'",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'",amenities="'.$amenities.'",hotelPhoto="'.$profilePhoto.'",address="'.$address.'",hotelType="'.$hotelType.'",checkIn="'.$checkIn.'",checkOut="'.$checkOut.'",details="'.$details.'",mapURL="'.$mapURL.'",contactPerson="'.$contactPerson.'",contactPersonEmail="'.$contactPersonEmail.'",contactPersonPhone="'.$contactPersonPhone.'",imgLink="'.$imgLink.'"'; 

addlisting('hotelMaster',$namevalue);  



} else { 





 $namevalue ='name="'.$name.'",category="'.$category.'",countryId="'.$countryId.'",destination="'.$destination.'",status="'.$status.'",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'",amenities="'.$amenities.'",hotelPhoto="'.$profilePhoto.'",address="'.$address.'",hotelType="'.$hotelType.'",checkIn="'.$checkIn.'",checkOut="'.$checkOut.'",details="'.$details.'",mapURL="'.$mapURL.'",contactPerson="'.$contactPerson.'",contactPersonEmail="'.$contactPersonEmail.'",contactPersonPhone="'.$contactPersonPhone.'",imgLink="'.$imgLink.'"';



$where='id="'.decode($_POST['editId']).'"';   



updatelisting('hotelMaster',$namevalue,$where);  

}



?> 

<script> 

parent.redirectpage('display.html?ga=hotel&save=1'); 

</script> 

<?php 

}















if(trim($_POST['action'])=='addhotelratelist' && trim($_POST['startDate'])!='' && trim($_POST['endDate'])!='' && trim($_POST['roomType'])!='' && trim($_POST['mealPlan'])!='' && trim($_POST['hotelId'])!=''){ 







$startDate=date('Y-m-d',strtotime($_POST['startDate']));  



$endDate=date('Y-m-d',strtotime($_POST['endDate']));  



$roomType=addslashes($_POST['roomType']);  

$noOfDays=addslashes($_POST['noOfDays']);  

$maxpax=addslashes($_POST['maxpax']);  



$mealPlan=addslashes($_POST['mealPlan']);    



$currencyId=addslashes($_POST['currencyId']); 



$supplierId=addslashes($_POST['supplierId']);  



$single=addslashes($_POST['single']);  



$double=addslashes($_POST['double']);  

$oldlogo=addslashes($_POST['oldlogo']); 

$singlemarkup=addslashes($_POST['singlemarkup']); 

$doublemarkup=addslashes($_POST['doublemarkup']); 

$triplemarkup=addslashes($_POST['triplemarkup']); 

$quadmarkup=addslashes($_POST['quadmarkup']); 

$childBedmarkup=addslashes($_POST['childBedmarkup']); 

$extraBedmarkup=addslashes($_POST['extraBedmarkup']); 

$transferId=addslashes($_POST['transferId']); 

$infent=addslashes($_POST['infent']); 



$triple=addslashes($_POST['triple']);  



$quad=addslashes($_POST['quad']);  



$childBed=addslashes($_POST['childBed']);  

$details=addslashes($_POST['details']);  



$extraAdult=addslashes($_POST['extraAdult']);   



$status=addslashes(strip_tags($_POST['status']));

$extraNight=addslashes(strip_tags($_POST['extraNight']));   



$hotelId=addslashes(decode($_POST['hotelId']));   



$addedBy=$_SESSION['userid']; 



$dateAdded=date('Y-m-d H:i:s'); 



  











if($_REQUEST['editid']==''){ 





 

$namevalue ='startDate="'.$startDate.'",endDate="'.$endDate.'",roomType="'.$roomType.'",mealPlan="'.$mealPlan.'",currencyId="'.$currencyId.'",supplierId="'.$supplierId.'",single="'.$single.'",doublePrice="'.$double.'",triple="'.$triple.'",quad="'.$quad.'",childBed="'.$childBed.'",extraAdult="'.$extraAdult.'",photo="'.$filename.'",details="'.$details.'",status="'.$status.'",addedBy="'.$addedBy.'",hotelId="'.$hotelId.'",dateAdded="'.$dateAdded.'",singlemarkup="'.$singlemarkup.'",doublemarkup="'.$doublemarkup.'",triplemarkup="'.$triplemarkup.'",quadmarkup="'.$quadmarkup.'",childBedmarkup="'.$childBedmarkup.'",extraBedmarkup="'.$extraBedmarkup.'",infent="'.$infent.'",maxpax="'.$maxpax.'",extraNight="'.$extraNight.'",noOfDays="'.$noOfDays.'",transferId="'.$transferId.'"';



addlisting('hotelRateList',$namevalue); 







} else { 







$namevalue ='startDate="'.$startDate.'",endDate="'.$endDate.'",roomType="'.$roomType.'",mealPlan="'.$mealPlan.'",currencyId="'.$currencyId.'",supplierId="'.$supplierId.'",single="'.$single.'",doublePrice="'.$double.'",triple="'.$triple.'",quad="'.$quad.'",childBed="'.$childBed.'",extraAdult="'.$extraAdult.'",photo="'.$filename.'",details="'.$details.'",status="'.$status.'",addedBy="'.$addedBy.'",hotelId="'.$hotelId.'",dateAdded="'.$dateAdded.'",hotelMarkup="'.$hotelMarkup.'",singlemarkup="'.$singlemarkup.'",doublemarkup="'.$doublemarkup.'",triplemarkup="'.$triplemarkup.'",quadmarkup="'.$quadmarkup.'",childBedmarkup="'.$childBedmarkup.'",extraBedmarkup="'.$extraBedmarkup.'",infent="'.$infent.'",maxpax="'.$maxpax.'",extraNight="'.$extraNight.'",noOfDays="'.$noOfDays.'",transferId="'.$transferId.'"';



$where='id="'.decode($_POST['editid']).'"';   



updatelisting('hotelRateList',$namevalue,$where); 



}



 



 







?>



<script> 

 

parent.$('#popcontent').load('loadpopup.php?action=addHotelRate&id=<?php echo $_POST['hotelId']; ?>'); 

 

</script>



<?php 



}













if(trim($_POST['action'])=='addactivity' && $_POST['name']!='' && $_POST['destination']!=''){   



$name=addslashes($_POST['name']);      

$destination=addslashes($_POST['destination']);    

$status=addslashes(strip_tags($_POST['status']));      

$address=addslashes(strip_tags($_POST['address']));

$details=addslashes(($_POST['details']));



$addedBy=$_SESSION['userid']; 



$dateAdded=date('Y-m-d H:i:s'); 





if($_FILES["image"]["tmp_name"]!=""){



$rt=time(); 

$companyLogoFileName=basename($_FILES['image']['name']); 

$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION); 

$profilePhoto=str_replace(' ','_',substr($companyLogoFileName, 0, strpos($companyLogoFileName, ".")).$rt.'.'.$companyLogoFileExtension); 

move_uploaded_file($_FILES["image"]["tmp_name"], "package_image/{$profilePhoto}");  

} else {

$profilePhoto=$_REQUEST['oldlogo'];

}

 



if($_REQUEST['editId']==''){   

$namevalue ='name="'.$name.'",countryId="'.$countryId.'",destination="'.$destination.'",status="'.$status.'",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'",photo="'.$profilePhoto.'",details="'.$details.'"'; 

addlisting('sightseeingMaster',$namevalue);  

} else {   

$namevalue ='name="'.$name.'",countryId="'.$countryId.'",destination="'.$destination.'",status="'.$status.'",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'",photo="'.$profilePhoto.'",details="'.$details.'"'; 

$where='id="'.decode($_POST['editId']).'"';  

updatelisting('sightseeingMaster',$namevalue,$where);  

} 

?> 

<script> 

parent.redirectpage('display.html?ga=activity&save=1'); 

</script> 

<?php 

}















if(trim($_POST['action'])=='addActivityRate' && trim($_POST['startDate'])!='' && trim($_POST['endDate'])!='' && trim($_POST['parentId'])!=''){ 







$startDate=date('Y-m-d',strtotime($_POST['startDate']));   

$endDate=date('Y-m-d',strtotime($_POST['endDate']));  



$sightseeingType=1;  

$adult=addslashes($_POST['adult']);  

$child=addslashes($_POST['child']);   

$child2=addslashes($_POST['child2']);   

$vehicleCost=addslashes($_POST['vehicleCost']);  

$status=addslashes(strip_tags($_POST['status']));    

$parentId=addslashes(decode($_POST['parentId']));    

$addedBy=$_SESSION['userid'];  

$dateAdded=date('Y-m-d H:i:s');  



if($_REQUEST['editid']==''){  

$namevalue ='startDate="'.$startDate.'",endDate="'.$endDate.'",sightseeingType="'.$sightseeingType.'",adult="'.$adult.'",child="'.$child.'",child2="'.$child2.'",vehicleCost="'.$vehicleCost.'",parentId="'.$parentId.'",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'"'; 

addlisting('sightseeingRateList',$namevalue);  

} else {  

$namevalue ='startDate="'.$startDate.'",endDate="'.$endDate.'",sightseeingType="'.$sightseeingType.'",adult="'.$adult.'",child="'.$child.'",child2="'.$child2.'",vehicleCost="'.$vehicleCost.'",parentId="'.$parentId.'",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'"'; 

$where='id="'.decode($_POST['editid']).'"'; 

updatelisting('sightseeingRateList',$namevalue,$where);  

} 



?> 

<script>  

parent.$('#popcontent').load('loadpopup.php?action=addActivityRate&id=<?php echo $_POST['parentId']; ?>');  

</script> 

<?php  

}













if(trim($_POST['action'])=='addtransfer' && $_POST['name']!='' && $_POST['destination']!=''){   



$name=addslashes($_POST['name']);      

$destination=addslashes($_POST['destination']);    

$status=addslashes(strip_tags($_POST['status']));      

$address=addslashes(strip_tags($_POST['address']));

$details=addslashes(($_POST['details']));



$addedBy=$_SESSION['userid']; 



$dateAdded=date('Y-m-d H:i:s'); 





if($_FILES["image"]["tmp_name"]!=""){



$rt=time(); 

$companyLogoFileName=basename($_FILES['image']['name']); 

$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION); 

$profilePhoto=str_replace(' ','_',substr($companyLogoFileName, 0, strpos($companyLogoFileName, ".")).$rt.'.'.$companyLogoFileExtension); 

move_uploaded_file($_FILES["image"]["tmp_name"], "package_image/{$profilePhoto}");  

} else {

$profilePhoto=$_REQUEST['oldlogo'];

}

 



if($_REQUEST['editId']==''){   

$namevalue ='name="'.$name.'",countryId="'.$countryId.'",destination="'.$destination.'",status="'.$status.'",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'",photo="'.$profilePhoto.'",details="'.$details.'"'; 

addlisting('transferMaster',$namevalue);  

} else {   

$namevalue ='name="'.$name.'",countryId="'.$countryId.'",destination="'.$destination.'",status="'.$status.'",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'",photo="'.$profilePhoto.'",details="'.$details.'"'; 

$where='id="'.decode($_POST['editId']).'"';  

updatelisting('transferMaster',$namevalue,$where);  

} 

?> 

<script> 

parent.redirectpage('display.html?ga=transfer&save=1'); 

</script> 

<?php 

}













if(trim($_POST['action'])=='addtransferRate' && trim($_POST['startDate'])!='' && trim($_POST['endDate'])!='' && trim($_POST['transferType'])!='' && trim($_POST['parentId'])!=''){ 







$startDate=date('Y-m-d',strtotime($_POST['startDate']));   

$endDate=date('Y-m-d',strtotime($_POST['endDate']));  



$transferType=addslashes($_POST['transferType']);  

$adult=addslashes($_POST['adult']);  

$child=addslashes($_POST['child']);   

$child2=addslashes($_POST['child2']);   

$vehicleCost=addslashes($_POST['vehicleCost']);  

$status=addslashes(strip_tags($_POST['status']));    

$parentId=addslashes(decode($_POST['parentId']));    

$addedBy=$_SESSION['userid'];  

$dateAdded=date('Y-m-d H:i:s');  



if($_REQUEST['editid']==''){  

$namevalue ='startDate="'.$startDate.'",endDate="'.$endDate.'",transferType="'.$transferType.'",adult="'.$adult.'",child="'.$child.'",child2="'.$child2.'",vehicleCost="'.$vehicleCost.'",parentId="'.$parentId.'",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'"'; 

addlisting('transferRateList',$namevalue);  

} else {  

$namevalue ='startDate="'.$startDate.'",endDate="'.$endDate.'",transferType="'.$transferType.'",adult="'.$adult.'",child="'.$child.'",child2="'.$child2.'",vehicleCost="'.$vehicleCost.'",parentId="'.$parentId.'",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'"'; 

$where='id="'.decode($_POST['editid']).'"'; 

updatelisting('transferRateList',$namevalue,$where);  

} 



?> 

<script>  

parent.$('#popcontent').load('loadpopup.php?action=addtransferRate&id=<?php echo $_POST['parentId']; ?>');  

</script> 

<?php  

}











if($_POST['action']=='importhotelExcel' && $_FILES['importfield']['name']!=''){ 



require_once('spreadsheet-reader-master/php-excel-reader/excel_reader2.php'); 

require_once('spreadsheet-reader-master/SpreadsheetReader.php');  

$allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];  



  if(in_array($_FILES["importfield"]["type"],$allowedFileType)){  

        $targetPath = 'importfiles/'.$_FILES['importfield']['name']; 

        move_uploaded_file($_FILES['importfield']['tmp_name'], $targetPath);  

        $Reader = new SpreadsheetReader($targetPath); 

        $sheetCount = count($Reader->sheets());  

         for($i=0;$i<$sheetCount;$i++){ 

            $Reader->ChangeSheet($i);

			 

            foreach ($Reader as $Row) 

            { 	 



$hotelName = trim($Row[0]); 

$category = trim($Row[1]); 

$destination = trim($Row[2]);  

$fromDate = trim($Row[3]); 

$toDate = trim($Row[4]); 

$roomType = trim($Row[5]); 

$mealPlan = trim($Row[6]);  

$single = trim($Row[7]); 

$double = trim($Row[8]); 

$triple = trim($Row[9]); 

$quad = trim($Row[10]); 

$childBed = trim($Row[11]); 

$extraBed = trim($Row[12]);  

$contactPerson = trim($Row[13]);  

$contactPersonEmail = trim($Row[14]);  

$contactPersonPhone = trim($Row[15]);  

$imgLink = trim($Row[16]);

 

$addedBy=$_SESSION['userid'];  

$dateAdded=date('Y-m-d H:i:s');

 

 

//fecth destination 



$bb=GetPageRecord('*','cityMaster','name="'.$destination.'"');  

$destinationidcheck=mysqli_fetch_array($bb); 



if($destinationidcheck['id']==''){ 

$namevalue4 ='name="'.$destination.'"'; 

$destinationnewid=addlistinggetlastid('cityMaster',$namevalue4);  

$destinationIdFinal=$destinationnewid; 

} else { 

$destinationIdFinal=$destinationidcheck['id']; 

}  

$status=1;  



//add hotel 

if($hotelName!='' && $hotelName!='Hotel name' && $category!='' && $destination!=''){  

$whereChecka='name="'.$hotelName.'" and destination="'.$destinationIdFinal.'"'; 

$checkCode = checkduplicate('hotelMaster',$whereChecka); 



if($checkCode == 'yes'){ 

 

 

 $htes=GetPageRecord('*','hotelMaster','name="'.$hotelName.'" and destination="'.$destinationIdFinal.'"'); 

$hoteledit=mysqli_fetch_array($htes); 







$roomlist=GetPageRecord('*','RoomTypeMaster',' 1 and status=1 and name="'.$roomType.'" order by id desc'); 

$roomdata=mysqli_fetch_array($roomlist);  



if($roomdata['id']==''){ 

$namevalue4 ='name="'.$roomType.'"'; 

$destinationnewid=addlistinggetlastid('RoomTypeMaster',$namevalue4);  

$roomType=$destinationnewid; 

} else { 

$roomType=$roomdata['id'];

}  







//meal plan



$meallist=GetPageRecord('*','mealPlanMaster',' 1 and status=1 and name="'.$mealPlan.'" order by id desc'); 

$mealdata=mysqli_fetch_array($meallist);  



if($mealdata['id']==''){  

$mealPlan=addlistinggetlastid('mealPlanMaster','name="'.$mealPlan.'"');   

} else { 

$mealPlan=$mealdata['id'];

} 







//currency id 

$currenlist=GetPageRecord('*','currencyMaster',' 1 and status=1 and name="'.$currency.'" order by id desc'); 

$currendata=mysqli_fetch_array($currenlist); 

$currency=$currendata['id']; 



if($_SESSION['userid']!='1'){ 

$parentId=$_SESSION['userid']; 

} else { 

if($LoginUserDetails['userType']=='2'){ 

$parentId=$LoginUserDetails['parentId']; 

} else { 

$parentId=$LoginUserDetails['id']; 

} 



}

 

//fecth supplier 

 

 

//insert room rate



$whereCheckb='hotelId="'.$hoteledit['id'].'" and startDate="'.date('Y-m-d',strtotime($fromDate)).'" and endDate="'.date('Y-m-d',strtotime($toDate)).'"   and roomType="'.$roomType.'" and mealPlan="'.$mealPlan.'"'; 

$checkCodeaa = checkduplicate('hotelRateList',$whereCheckb); 



$namevalueaa ='startDate="'.date('Y-m-d',strtotime($fromDate)).'",endDate="'.date('Y-m-d',strtotime($toDate)).'",roomType="'.$roomType.'",mealPlan="'.$mealPlan.'",single="'.$single.'",doublePrice="'.$double.'",triple="'.$triple.'",quad="'.$quad.'",childBed="'.$childBed.'",extraAdult="'.$extraBed.'",status="0",addedBy="'.$addedBy.'",hotelId="'.$hoteledit['id'].'",dateAdded="'.$dateAdded.'"'; 



if($checkCodeaa == 'yes'){  

$whereaa='hotelId="'.$hoteledit['id'].'" and startDate="'.date('Y-m-d',strtotime($fromDate)).'" and endDate="'.date('Y-m-d',strtotime($toDate)).'"   and roomType="'.$roomType.'" and mealPlan="'.$mealPlan.'"';    

updatelisting('hotelRateList',$namevalueaa,$whereaa);  

} 

else{ 

addlisting('hotelRateList',$namevalueaa); 

}  







}else{ 



//////////////////-----------------ADD HOTEL---------------------------------------







$namevalue ='name="'.$hotelName.'",category="'.$category.'",destination="'.$destinationIdFinal.'",status="1",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'",contactPerson="'.addslashes($contactPerson).'",contactPersonEmail="'.addslashes($contactPersonEmail).'",contactPersonPhone="'.addslashes($contactPersonPhone).'",imgLink="'.addslashes($imgLink).'"'; 

$hotelId=addlistinggetlastid('hotelMaster',$namevalue); 

//add room price 

//room type



$roomlist=GetPageRecord('*','RoomTypeMaster',' 1 and status=1 and name="'.$roomType.'" order by id desc'); 

$roomdata=mysqli_fetch_array($roomlist); 

 



if($roomdata['id']==''){ 

$namevalue4 ='name="'.$roomType.'"'; 

$destinationnewid=addlistinggetlastid('RoomTypeMaster',$namevalue4);  

$roomType=$destinationnewid; 

} else { 

$roomType=$roomdata['id'];

}  







//meal plan



$meallist=GetPageRecord('*','mealPlanMaster',' 1 and status=1 and name="'.$mealPlan.'" order by id desc'); 

$mealdata=mysqli_fetch_array($meallist);  



if($mealdata['id']==''){  

$mealPlan=addlistinggetlastid('mealPlanMaster','name="'.$mealPlan.'"');   

} else { 

$mealPlan=$mealdata['id'];

} 







//currency id 

$currenlist=GetPageRecord('*','currencyMaster',' 1 and status=1 and name="'.$currency.'" order by id desc'); 

$currendata=mysqli_fetch_array($currenlist); 

$currency=$currendata['id']; 



if($_SESSION['userid']!='1'){ 

$parentId=$_SESSION['userid']; 

} else { 

if($LoginUserDetails['userType']=='2'){ 

$parentId=$LoginUserDetails['parentId']; 

} else { 

$parentId=$LoginUserDetails['id']; 

} 



}

 

//fecth supplier 

 

 

//insert room rate



$whereCheckb='hotelId="'.$hotelId.'" and startDate="'.date('Y-m-d',strtotime($fromDate)).'" and endDate="'.date('Y-m-d',strtotime($toDate)).'"   and roomType="'.$roomType.'" and mealPlan="'.$mealPlan.'"'; 

$checkCodeaa = checkduplicate('hotelRateList',$whereCheckb); 



$namevalueaa ='startDate="'.date('Y-m-d',strtotime($fromDate)).'",endDate="'.date('Y-m-d',strtotime($toDate)).'",roomType="'.$roomType.'",mealPlan="'.$mealPlan.'",single="'.$single.'",doublePrice="'.$double.'",triple="'.$triple.'",quad="'.$quad.'",childBed="'.$childBed.'",extraAdult="'.$extraBed.'",status="0",addedBy="'.$addedBy.'",hotelId="'.$hotelId.'",dateAdded="'.$dateAdded.'"'; 



if($checkCodeaa == 'yes'){  

$whereaa='hotelId="'.$hotelId.'" and startDate="'.date('Y-m-d',strtotime($fromDate)).'" and endDate="'.date('Y-m-d',strtotime($toDate)).'"   and roomType="'.$roomType.'" and mealPlan="'.$mealPlan.'"';    

updatelisting('hotelRateList',$namevalueaa,$whereaa);  

} 

else{ 

addlisting('hotelRateList',$namevalueaa); 

}  



} 



}   

//add hotel 

 		} 

         } 

  }else{ 



        echo $type = "error"; 

        echo $message = "Invalid File Type. Upload Excel File.";



  }  

?>   

<script> 

parent.redirectpage('display.html?ga=hotel&save=1');

 </script> 

<?php }









if($_POST['action']=='importactivityExcel' && $_FILES['importfield']['name']!=''){ 



require_once('spreadsheet-reader-master/php-excel-reader/excel_reader2.php'); 

require_once('spreadsheet-reader-master/SpreadsheetReader.php');  

$allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];  



  if(in_array($_FILES["importfield"]["type"],$allowedFileType)){  

        $targetPath = 'importfiles/'.$_FILES['importfield']['name']; 

        move_uploaded_file($_FILES['importfield']['tmp_name'], $targetPath);  

        $Reader = new SpreadsheetReader($targetPath); 

        $sheetCount = count($Reader->sheets());  

         for($i=0;$i<$sheetCount;$i++){ 

            $Reader->ChangeSheet($i);

			 

            foreach ($Reader as $Row) 

            { 	 



$activityName = trim($Row[0]);  

$destination = trim($Row[1]);  

$fromDate = trim($Row[2]); 

$toDate = trim($Row[3]); 

$adultCost = trim($Row[4]); 

$childCost = trim($Row[5]);   



$addedBy=$_SESSION['userid'];  

$dateAdded=date('Y-m-d H:i:s');

 

 

//fecth destination 



$bb=GetPageRecord('*','cityMaster','name="'.$destination.'"');  

$destinationidcheck=mysqli_fetch_array($bb); 



if($destinationidcheck['id']==''){ 

$namevalue4 ='name="'.$destination.'"'; 

$destinationnewid=addlistinggetlastid('cityMaster',$namevalue4);  

$destinationIdFinal=$destinationnewid; 

} else { 

$destinationIdFinal=$destinationidcheck['id']; 

}  

$status=1;  



//add hotel 

if($activityName!='' && $activityName!='Activity Name' && $destination!=''){  

$whereChecka='name="'.$hotelName.'" and destination="'.$destinationIdFinal.'"'; 

$checkCode = checkduplicate('sightseeingMaster',$whereChecka); 



if($checkCode == 'yes'){ 



}else{ 

$namevalue ='name="'.$activityName.'",destination="'.$destinationIdFinal.'",status="1",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'"'; 

$hotelId=addlistinggetlastid('sightseeingMaster',$namevalue); 

  



if($_SESSION['userid']!='1'){ 

$parentId=$_SESSION['userid']; 

} else { 

if($LoginUserDetails['userType']=='2'){ 

$parentId=$LoginUserDetails['parentId']; 

} else { 

$parentId=$LoginUserDetails['id']; 

} 



}

 

//fecth supplier 

 

 

//insert room rate



$whereCheckb='parentId="'.$hotelId.'" and startDate="'.date('Y-m-d',strtotime($fromDate)).'" and endDate="'.date('Y-m-d',strtotime($toDate)).'"'; 

$checkCodeaa = checkduplicate('sightseeingRateList',$whereCheckb); 



$namevalueaa ='startDate="'.date('Y-m-d',strtotime($fromDate)).'",endDate="'.date('Y-m-d',strtotime($toDate)).'",adult="'.$adultCost.'",child="'.$childCost.'",status="0",addedBy="'.$addedBy.'",parentId="'.$hotelId.'",dateAdded="'.$dateAdded.'"'; 



if($checkCodeaa == 'yes'){  

$whereaa='parentId="'.$hotelId.'" and startDate="'.date('Y-m-d',strtotime($fromDate)).'" and endDate="'.date('Y-m-d',strtotime($toDate)).'"';    

updatelisting('sightseeingRateList',$namevalueaa,$whereaa);  

} 

else{ 

addlisting('sightseeingRateList',$namevalueaa); 

}  



} 



}   

//add hotel 

 		} 

         } 

  }else{ 



        echo $type = "error"; 

        echo $message = "Invalid File Type. Upload Excel File.";



  }  

?>   

<script> 

parent.redirectpage('display.html?ga=activity&save=1');

 </script> 

<?php }









if($_POST['action']=='importransferExcel' && $_FILES['importfield']['name']!=''){ 



require_once('spreadsheet-reader-master/php-excel-reader/excel_reader2.php'); 

require_once('spreadsheet-reader-master/SpreadsheetReader.php');  

$allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];  



  if(in_array($_FILES["importfield"]["type"],$allowedFileType)){  

        $targetPath = 'importfiles/'.$_FILES['importfield']['name']; 

        move_uploaded_file($_FILES['importfield']['tmp_name'], $targetPath);  

        $Reader = new SpreadsheetReader($targetPath); 

        $sheetCount = count($Reader->sheets());  

         for($i=0;$i<$sheetCount;$i++){ 

            $Reader->ChangeSheet($i);

			 

            foreach ($Reader as $Row) 

            { 	 



$activityName = trim($Row[0]);  

$destination = trim($Row[1]);  

$fromDate = trim($Row[2]); 

$toDate = trim($Row[3]); 

$type = trim($Row[4]); 

$adultCost = trim($Row[5]); 

$childCost = trim($Row[6]);   

$vehicleCost = trim($Row[7]);   

$transferType=1;

if($type=='SIC' || $type=='sic'){

$transferType=1;

}

if($type=='PVT' || $type=='pvt' || $type=='private'){

$transferType=2;

}



$addedBy=$_SESSION['userid'];  

$dateAdded=date('Y-m-d H:i:s');

 

 

//fecth destination 



$bb=GetPageRecord('*','cityMaster','name="'.$destination.'"');  

$destinationidcheck=mysqli_fetch_array($bb); 



if($destinationidcheck['id']==''){ 

$namevalue4 ='name="'.$destination.'"'; 

$destinationnewid=addlistinggetlastid('cityMaster',$namevalue4);  

$destinationIdFinal=$destinationnewid; 

} else { 

$destinationIdFinal=$destinationidcheck['id']; 

}  

$status=1;  







if($_SESSION['userid']!='1'){ 

$parentId=$_SESSION['userid']; 

} else { 

if($LoginUserDetails['userType']=='2'){ 

$parentId=$LoginUserDetails['parentId']; 

} else { 

$parentId=$LoginUserDetails['id']; 

} 



}







//add hotel 

if($activityName!='' && $activityName!='Transfer Name' && $destination!=''){  

$whereChecka='name="'.$activityName.'" and destination="'.$destinationIdFinal.'"'; 

$checkCode = checkduplicate('transferMaster',$whereChecka); 



if($checkCode == 'yes'){ 





$bbtt=GetPageRecord('*','transferMaster','name="'.$activityName.'" and destination="'.$destinationIdFinal.'"');  

$trnsId=mysqli_fetch_array($bbtt); 

$hotelId=$trnsId['id'];



$whereCheckb='parentId="'.$hotelId.'" and startDate="'.date('Y-m-d',strtotime($fromDate)).'" and endDate="'.date('Y-m-d',strtotime($toDate)).'" and transferType="'.$transferType.'"'; 

$checkCodeaa = checkduplicate('transferRateList',$whereCheckb); 



$namevalueaa ='startDate="'.date('Y-m-d',strtotime($fromDate)).'",endDate="'.date('Y-m-d',strtotime($toDate)).'",transferType="'.$transferType.'",adult="'.$adultCost.'",child="'.$childCost.'",vehicleCost="'.$vehicleCost.'",status="0",addedBy="'.$addedBy.'",parentId="'.$hotelId.'",dateAdded="'.$dateAdded.'"'; 



if($checkCodeaa == 'yes'){  

$whereaa='parentId="'.$hotelId.'" and startDate="'.date('Y-m-d',strtotime($fromDate)).'" and endDate="'.date('Y-m-d',strtotime($toDate)).'",transferType="'.$transferType.'"';    

updatelisting('transferRateList',$namevalueaa,$whereaa);  

} 

else{ 

addlisting('transferRateList',$namevalueaa); 

} 









}else{ 

$namevalue ='name="'.$activityName.'",destination="'.$destinationIdFinal.'",status="1",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'"'; 

$hotelId=addlistinggetlastid('transferMaster',$namevalue); 

  





 



$whereCheckb='parentId="'.$hotelId.'" and startDate="'.date('Y-m-d',strtotime($fromDate)).'" and endDate="'.date('Y-m-d',strtotime($toDate)).'" and transferType="'.$transferType.'"'; 

$checkCodeaa = checkduplicate('transferRateList',$whereCheckb); 



$namevalueaa ='startDate="'.date('Y-m-d',strtotime($fromDate)).'",endDate="'.date('Y-m-d',strtotime($toDate)).'",transferType="'.$transferType.'",adult="'.$adultCost.'",child="'.$childCost.'",vehicleCost="'.$vehicleCost.'",status="0",addedBy="'.$addedBy.'",parentId="'.$hotelId.'",dateAdded="'.$dateAdded.'"'; 



if($checkCodeaa == 'yes'){  

$whereaa='parentId="'.$hotelId.'" and startDate="'.date('Y-m-d',strtotime($fromDate)).'" and endDate="'.date('Y-m-d',strtotime($toDate)).'",transferType="'.$transferType.'"';    

updatelisting('transferRateList',$namevalueaa,$whereaa);  

} 

else{ 

addlisting('transferRateList',$namevalueaa); 

}  



} 



}   

//add hotel 

 		} 

         } 

  }else{ 



        echo $type = "error"; 

        echo $message = "Invalid File Type. Upload Excel File.";



  }  

?>   

<script> 

parent.redirectpage('display.html?ga=transfer&save=1');

 </script> 

<?php }

 





if(trim($_POST['action'])=='addroomtype' && $_POST['name']!='' ){   



$name=addslashes($_POST['name']);       

$status=addslashes(strip_tags($_POST['status']));  



$addedBy=$_SESSION['userid'];  

$dateAdded=date('Y-m-d H:i:s');   

 



if($_REQUEST['editId']==''){   

$namevalue ='name="'.$name.'",status="'.$status.'",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'"'; 

addlisting('RoomTypeMaster',$namevalue);   

} else {   

$namevalue ='name="'.$name.'",status="'.$status.'",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'"'; 

$where='id="'.decode($_POST['editId']).'"';    

updatelisting('RoomTypeMaster',$namevalue,$where);  

}



?> 

<script> 

parent.redirectpage('display.html?ga=roomtype&save=1'); 

</script> 

<?php 

}











 if(trim($_POST['action'])=='bulkassignquery' && $_POST['assignToPerson']>0){   

 

 foreach($_POST['assignall'] as $val){

	$namevalue ='assignTo="'.$_POST['assignToPerson'].'"';  

	$where='id="'.decode($val).'"';    

	 updatelisting('queryMaster',$namevalue,$where); 

 } 

 

?> 

<script> 

 parent.redirectpage('display.html?ga=query&statusid=1'); 

</script> 

<?php 

}

   

 







if(trim($_POST['action'])=='addleadsource'){    

 



if($_POST['editId']>0){ 

$namevalue2 ='name="'.trim($_REQUEST['name']).'",status="'.($_REQUEST['status']).'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.date('Y-m-d H:i:s').'"';

$where='id="'.decode($_POST['editId']).'"';    

updatelisting('querySourceMaster',$namevalue2,$where);  

 

} else { 



$namevalue2 ='name="'.trim($_REQUEST['name']).'",status="'.($_REQUEST['status']).'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.date('Y-m-d H:i:s').'"';

addlistinggetlastid('querySourceMaster',$namevalue2); 

 

}



?> 

<script> 

parent.redirectpage('display.html?ga=leadsource&save=1'); 

</script> 

<?php 

}











if(trim($_REQUEST['action'])=='saveinternalnote' && trim($_REQUEST['queryId'])!=''){    

updatelisting('queryMaster','internalnote="'.addslashes(trim($_REQUEST['internalnote'])).'"','id="'.decode($_REQUEST['queryId']).'"'); 

}

   

 

 







if(trim($_POST['action'])=='addRoomType'){    

 



if($_POST['editId']>0){ 

$namevalue2 ='name="'.trim($_REQUEST['name']).'",status="'.($_REQUEST['status']).'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.date('Y-m-d H:i:s').'"';

$where='id="'.decode($_POST['editId']).'"';    

updatelisting('RoomTypeMaster',$namevalue2,$where);  

 

} else { 



$namevalue2 ='name="'.trim($_REQUEST['name']).'",status="'.($_REQUEST['status']).'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.date('Y-m-d H:i:s').'"';

addlistinggetlastid('RoomTypeMaster',$namevalue2); 

 

}



?> 

<script> 

parent.redirectpage('display.html?ga=roomType&save=1'); 

</script> 

<?php 

}







if($_REQUEST['action']=='eventsorting'){

$n=1;

foreach($_POST['sr'] as $index => $value) { 



 $namevalue ='sr="'.$n.'"'; 

echo $where='id="'.$value.'"';  

updatelisting('sys_packageBuilderEvent',$namevalue,$where);   

$n++;}

}















if(trim($_POST['action'])=='addclientgroup' && trim($_POST['name'])!=''){  

 

 

$name=addslashes($_POST['name']);   

$description=addslashes($_POST['description']);   

$status=addslashes($_POST['status']);      

$editid=decode($_POST['editId']);

  



if($editid!=''){ 

 





$namevalue ='name="'.$name.'",description="'.$description.'",status="'.$status.'",dateAdded="'.date('Y-m-d H:i:s').'",addedBy="'.$_SESSION['userid'].'"';

$where='id="'.$editid.'"';    

updatelisting('clientGroupMaster',$namevalue,$where);  

 

 

 

} else {  

$namevalue ='name="'.$name.'",description="'.$description.'",status="'.$status.'",dateAdded="'.date('Y-m-d H:i:s').'",addedBy="'.$_SESSION['userid'].'"';

$lstaddid=addlistinggetlastid('clientGroupMaster',$namevalue);  

  

}  

 





?> 

<script> 

parent.redirectpage('display.html?ga=clients-group&save=1'); 

</script> 

<?php 

}

















 if(trim($_POST['action'])=='bulkclientaddtogroup' && $_POST['assignToPerson']>0){   

 

 foreach($_POST['assignall'] as $val){ 

 

 $a=GetPageRecord('*','clientGroupContacts','clientId="'.decode($val).'"  and groupId="'.$_POST['assignToPerson'].'" ');  

$result=mysqli_fetch_array($a);



if($result['id']==''){

 

	 $namevalue ='clientId="'.decode($val).'",groupId="'.$_POST['assignToPerson'].'"';

addlistinggetlastid('clientGroupContacts',$namevalue); 



}





 } 

 

?> 

<script> 

 parent.redirectpage('display.html?ga=clients&&save=1'); 

</script> 

<?php 

}

  

  

  

if(trim($_POST['action'])=='bulkclientremovefromgroup' && $_POST['assignToPerson']>0){   

 

 foreach($_POST['assignall'] as $val){  

 

	 $namevalue ='clientId="'.decode($val).'",groupId="'.$_POST['assignToPerson'].'"';

addlistinggetlastid('clientGroupContacts',$namevalue); 

 

 

deleteRecord('clientGroupContacts','clientId="'.decode($val).'" and groupId="'.$_POST['assignToPerson'].'"');  



 } 

 

?> 

<script> 

 parent.redirectpage('display.html?ga=clients-group-contacts&g=<?php echo encode($_POST['assignToPerson']); ?>&&save=1'); 

</script> 

<?php 

}









if(trim($_POST['action'])=='addemailtemplate' && trim($_POST['name'])!=''){  

 

 

$name=addslashes($_POST['name']);   

$details=addslashes($_POST['details']);   

$subject=addslashes($_POST['subject']);       

$editid=decode($_POST['editid']);

  



if($editid!=''){ 

 





$namevalue ='name="'.$name.'",details="'.$details.'",subject="'.$subject.'",dateAdded="'.date('Y-m-d H:i:s').'",addedBy="'.$_SESSION['userid'].'"';

$where='id="'.$editid.'"';    

updatelisting('templateMaster',$namevalue,$where);  

  

} else {  

$namevalue ='name="'.$name.'",details="'.$details.'",subject="'.$subject.'",dateAdded="'.date('Y-m-d H:i:s').'",addedBy="'.$_SESSION['userid'].'"';

addlistinggetlastid('templateMaster',$namevalue);  

  

}  

 





?> 

<script> 

parent.redirectpage('display.html?ga=mailing-templates&save=1'); 

</script> 

<?php 

}









if(trim($_POST['action'])=='bulktemplatedelete'){   

 

 foreach($_POST['assignall'] as $val){   

 

 

deleteRecord('templateMaster','id="'.decode($val).'"');  



 } 

 

?> 

<script> 

 parent.redirectpage('display.html?ga=mailing-templates&save=1'); 

</script> 

<?php 

}















if(trim($_POST['action'])=='sendcampaignsmail' && trim($_POST['sendType'])!='' && trim($_POST['name'])!='' && trim($_POST['groupId'])!='' && trim($_POST['templateId'])!=''){  

 

include "config/mail.php"; 



$name=addslashes($_POST['name']);   

$subject=addslashes($_POST['subject']); 

$groupId=addslashes($_POST['groupId']);   

$templateId=addslashes($_POST['templateId']);  

$sendType=addslashes($_POST['sendType']);   

$testEmail=addslashes($_POST['testEmail']); 

$fromEmail=addslashes($_POST['fromEmail']);  

$fromName=addslashes($_POST['fromName']); 

$birthdaywish=addslashes($_POST['birthdaywish']); 



$wheremore='';

if($_REQUEST['birthdaywish']!=''){

$wheremore=' and clientId in (select id from userMaster where month(dob)="'.date('m').'" )';

}

if($_REQUEST['anniversary']!=''){

$wheremore=' and clientId in (select id from userMaster where month(marriageAnniversary)="'.date('m').'" )';

}

   



$abcd=GetPageRecord('*','clientGroupMaster','id="'.decode($groupId).'"'); 

$cgroupdata=mysqli_fetch_array($abcd); 



$abcde=GetPageRecord('*','templateMaster','id="'.decode($templateId).'"'); 

$templatedata=mysqli_fetch_array($abcde); 





$mailerdetails=$templatedata['details']; 

$mailerdetails=str_replace('{Client Name}',$cuserddetails['firstName'],$mailerdetails); 







if($sendType==2){ 



$ccmail=''; 

$file_name=''; 

send_attachment_mail($fromEmail,$testEmail,stripslashes($subject),stripslashes($mailerdetails),$ccmail,$file_name);





} else {



$namevalue ='scheduleDate="'.date('Y-m-d H:i:s').'",dateAdded="'.date('Y-m-d H:i:s').'",addedBy="'.$_SESSION['userid'].'",status=1,deleteStatus=0,templateId="'.decode($templateId).'",customerGroup="'.decode($groupId).'",fromName="'.$fromName.'",title="'.$name.'",fromEmail="'.$fromEmail.'",details="'.addslashes($templatedata['details']).'",emails="'.$emails.'",contacts="'.$emails.'",subject="'.addslashes($_POST['subject']).'"';



$campaignId=addlistinggetlastid('campaignMaster',$namevalue);  







$emails=0;

$rscon=GetPageRecord('*','clientGroupContacts',' groupId="'.decode($groupId).'" '.$wheremore.' '); 

while($restContact=mysqli_fetch_array($rscon)){ 





$abcd=GetPageRecord('*','userMaster','id="'.$restContact['clientId'].'"');  

$cuserddetails=mysqli_fetch_array($abcd); 





$mailerdetails=$templatedata['details']; 

$mailerdetails=str_replace('{Client Name}',$cuserddetails['firstName'],$mailerdetails);  

$subject=str_replace('{Client Name}',$cuserddetails['firstName'],$_REQUEST['subject']);   

$ccmail='';  
$file_name='';  
send_attachment_mail($fromEmail,$cuserddetails['email'],stripslashes($subject),stripslashes($mailerdetails.'<img src="'.$fullurl.'readmail.php?c='.$campaignId.'" width="0" height="0">'),$ccmail,$file_name);





$emails++; }











$namevalue2 ='scheduleDate="'.date('Y-m-d H:i:s').'",dateAdded="'.date('Y-m-d H:i:s').'",addedBy="'.$_SESSION['userid'].'",status=1,deleteStatus=0,templateId="'.decode($templateId).'",customerGroup="'.decode($groupId).'",fromName="'.$fromName.'",title="'.$name.'",fromEmail="'.$fromEmail.'",details="'.addslashes($templatedata['details']).'",emails="'.$emails.'",contacts="'.$emails.'",subject="'.addslashes($_POST['subject']).'"';



$where='id="'.$campaignId.'"';    

updatelisting('campaignMaster',$namevalue2,$where);  





 





}



?> 

<script> 

parent.redirectpage('display.html?ga=maketing-dashboard&sentcamp=1'); 

</script> 

<?php 

}





















if(trim($_POST['action'])=='addemailtemplate' && trim($_POST['name'])!=''){  

 

 

$name=addslashes($_POST['name']);   

$bannerHeading=addslashes($_POST['bannerHeading']);  

$pageURL=str_replace(' ','-',addslashes($_POST['pageURL']));   

$bannerSubHeading=addslashes($_POST['bannerSubHeading']);    

$enquiryHeading=addslashes($_POST['enquiryHeading']);    

$enquirySubHeading=addslashes($_POST['enquirySubHeading']);    

$contactNumber=addslashes($_POST['contactNumber']);    

$emailId=addslashes($_POST['emailId']);    

$address=addslashes($_POST['address']);    

$mainHeading=addslashes($_POST['mainHeading']);     

$description=addslashes($_POST['description']);     

$leadSource=addslashes($_POST['leadSource']);     

$facebook=addslashes($_POST['facebook']);     

$instagram=addslashes($_POST['instagram']);     

$twitter=addslashes($_POST['twitter']);     

$youtube=addslashes($_POST['youtube']);     

$pinterest=addslashes($_POST['pinterest']);   

$metaTitle=addslashes($_POST['metaTitle']);   

$metaDescription=addslashes($_POST['metaDescription']);   

$metaKeyword=addslashes($_POST['metaKeyword']);   

$headerScript=addslashes($_POST['headerScript']);       

$footerScript=addslashes($_POST['footerScript']);      

$oldphoto=addslashes($_POST['bannerold']);       

$status=addslashes($_POST['status']);        

$packages=addslashes($_POST['packages']);    

$editid=decode($_POST['editid']);

  

  

  

  

if($_FILES["banner"]["tmp_name"]!=""){ 

$rt=mt_rand().strtotime(date("YMDHis")); 

$companyLogoFileName=basename($_FILES['banner']['name']); 

$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION); 

$profilePhoto=time().$rt.'.'.$companyLogoFileExtension;  

move_uploaded_file($_FILES["banner"]["tmp_name"], "package_image/{$profilePhoto}");  

} 

if($profilePhoto==''){ 

$profilePhoto=$oldphoto; 

} 

  

  



if($editid!=''){  



$namevalue ='name="'.$name.'",bannerHeading="'.$bannerHeading.'",bannerSubHeading="'.$bannerSubHeading.'",packages="'.$packages.'",enquiryHeading="'.$enquiryHeading.'",enquirySubHeading="'.$enquirySubHeading.'",contactNumber="'.$contactNumber.'",emailId="'.$emailId.'",address="'.$address.'",mainHeading="'.$mainHeading.'",description="'.$description.'",leadSource="'.$leadSource.'",facebook="'.$facebook.'",instagram="'.$instagram.'",twitter="'.$twitter.'",youtube="'.$youtube.'",pinterest="'.$pinterest.'",metaTitle="'.$metaTitle.'",metaDescription="'.$metaDescription.'",metaKeyword="'.$metaKeyword.'",headerScript="'.$headerScript.'",footerScript="'.$footerScript.'",pageURL="'.$pageURL.'",banner="'.$profilePhoto.'",status="'.$status.'",dateAdded="'.date('Y-m-d H:i:s').'",addedBy="'.$_SESSION['userid'].'"';

$where='id="'.$editid.'"';    

updatelisting('landingPages',$namevalue,$where);  

  

} else {  

$namevalue ='name="'.$name.'",bannerHeading="'.$bannerHeading.'",bannerSubHeading="'.$bannerSubHeading.'",packages="'.$packages.'",enquiryHeading="'.$enquiryHeading.'",enquirySubHeading="'.$enquirySubHeading.'",contactNumber="'.$contactNumber.'",emailId="'.$emailId.'",address="'.$address.'",mainHeading="'.$mainHeading.'",description="'.$description.'",leadSource="'.$leadSource.'",facebook="'.$facebook.'",instagram="'.$instagram.'",twitter="'.$twitter.'",youtube="'.$youtube.'",pinterest="'.$pinterest.'",metaTitle="'.$metaTitle.'",metaDescription="'.$metaDescription.'",metaKeyword="'.$metaKeyword.'",headerScript="'.$headerScript.'",footerScript="'.$footerScript.'",pageURL="'.$pageURL.'",banner="'.$profilePhoto.'",status="'.$status.'",dateAdded="'.date('Y-m-d H:i:s').'",addedBy="'.$_SESSION['userid'].'"';

addlistinggetlastid('landingPages',$namevalue);  

  

}  

 





?> 

<script> 

parent.redirectpage('display.html?ga=landingpages&save=1'); 

</script> 

<?php 

}















if(trim($_POST['action'])=='addsignature' && trim($_POST['emailsignature'])!=''){ 



$namevalue ='emailsignature="'.addslashes($_REQUEST['emailsignature']).'"'; 

$where='id="'.$_SESSION['userid'].'"';   

updatelisting('sys_userMaster',$namevalue,$where); 



?>

<script>

parent.redirectpage('display.html?ga=myprofile&save=1');

</script>



<?php }


if(trim($_POST['action'])=='sendContact' && trim($_POST['email'])!=''){ 
   
  $to = 'jiteshramscreative@gmail.com'; 
  
  $name = $_POST['name'];
  $email = $_POST['email'];
  $subject = $_POST['subject'];
  $message =  $_POST['message'];
   
  $htmlContent = ' 
      <html> 
  
      <body> 
          <h1>Contact Us Form Data</h1> 
          <table cellspacing="0" style="border: 2px dashed #FB4314; width: 100%;"> 
              <tr> 
                  <th>Name:</th><td>'. $_POST['name'] .'</td> 
              </tr> 
              <tr style="background-color: #e0e0e0;"> 
                  <th>Email:</th><td>'. $_POST['email'] .'</td> 
              </tr> 
              <tr> 
                  <th>Message:</th><td>'. $_POST['message'] .'</td> 
              </tr> 
          </table> 
      </body> 
      </html>'; 
   
  // Set content-type header for sending HTML email 
  $headers = "MIME-Version: 1.0" . "\r\n"; 
  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
   
  // Additional headers 
  $headers .= 'From: '.$_POST['email'].  "\r\n"; 
     
  if(mail($to, $subject, $htmlContent, $headers)){
  ?> 
  <script>
      alert('Email has sent successfully.');
    window.top.location.href = "<?php echo $websiteurl; ?>contact";
  </script>
  
  <?php } ?>
  
  
  
  
  <?php }





if(trim($_POST['action'])=='addnotebook' && trim($_POST['id'])!=''){ 



$namevalue ='details="'.addslashes($_POST['notedescription']).'"';

$where='id="'.decode($_POST['id']).'"';    

updatelisting('notebookMaster',$namevalue,$where);   

}







if(trim($_POST['action'])=='addcmspage' && trim($_POST['name'])!='' && trim($_POST['url'])!='' && trim($_POST['pageType'])!=''){  

 

 

$name=addslashes($_POST['name']);   

$pageType=addslashes($_POST['pageType']);   

$url=addslashes($_POST['url']);       

$description=addslashes($_POST['description']);    

$status=addslashes($_POST['status']);       

$metaTitle=addslashes($_POST['metaTitle']);       

$metaKeyword=addslashes($_POST['metaKeyword']);       

$metaDesctiption=addslashes($_POST['metaDesctiption']);     

$editid=decode($_POST['editid']);





 

if($_FILES["image"]["tmp_name"]!=""){



$rt=time(); 

$companyLogoFileName=basename($_FILES['image']['name']); 

$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION); 

$profilePhoto=str_replace(' ','_',substr($companyLogoFileName, 0, strpos($companyLogoFileName, ".")).$rt.'.'.$companyLogoFileExtension); 

move_uploaded_file($_FILES["image"]["tmp_name"], "package_image/{$profilePhoto}");  

} else {

$profilePhoto=$_REQUEST['oldlogo'];

}

  



if($editid!=''){ 

 





$namevalue ='name="'.$name.'",pageType="'.$pageType.'",url="'.$url.'",description="'.$description.'",status="'.$status.'",photo="'.$profilePhoto.'",metaTitle="'.$metaTitle.'",metaKeyword="'.$metaKeyword.'",metaDesctiption="'.$metaDesctiption.'",dateAdded="'.date('Y-m-d H:i:s').'",addedBy="'.$_SESSION['userid'].'"';

$where='id="'.$editid.'"';    

updatelisting('cmsPages',$namevalue,$where);  

  

} else {  

$namevalue ='name="'.$name.'",pageType="'.$pageType.'",url="'.$url.'",description="'.$description.'",status="'.$status.'",metaTitle="'.$metaTitle.'",metaKeyword="'.$metaKeyword.'",metaDesctiption="'.$metaDesctiption.'",dateAdded="'.date('Y-m-d H:i:s').'",addedBy="'.$_SESSION['userid'].'"';

addlistinggetlastid('cmsPages',$namevalue);  

  

}  

 

 

?> 

<script> 

parent.redirectpage('display.html?ga=cms-pages&save=1'); 

</script> 

<?php 

}























if(trim($_POST['action'])=='addwebsitesetting' && trim($_POST['companyName'])!=''){  

 

 

$companyName=addslashes($_POST['companyName']);   

$oldphotologo=addslashes($_POST['websiteLogo']);   

$oldphotowebsiteFavicon=addslashes($_POST['websiteFavicon']);       

$contactPhone=addslashes($_POST['contactPhone']);    

$contactEmail=addslashes($_POST['contactEmail']);   

$whatsAppNumber=addslashes($_POST['whatsAppNumber']); 

$queryEmail=addslashes($_POST['queryEmail']);

$contactAddress=addslashes($_POST['contactAddress']); 

$headerScript=addslashes($_POST['headerScript']); 

$footerScript=addslashes($_POST['footerScript']); 

      

$metaTitle=addslashes($_POST['metaTitle']);       

$metaKeyword=addslashes($_POST['metaKeyword']);       

$metaDesctiption=addslashes($_POST['metaDesctiption']);  

$facebookURL=addslashes($_POST['facebookURL']);  

$twitterURL=addslashes($_POST['twitterURL']);  

$instagramURL=addslashes($_POST['instagramURL']);  

$youtubeURL=addslashes($_POST['youtubeURL']);  



  



if($_FILES["logoattachment"]["tmp_name"]!=""){ 

$rt=mt_rand().strtotime(date("YMDHis")); 

$companyLogoFileName=basename($_FILES['logoattachment']['name']); 

$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION); 

$websiteLogo=time().$rt.'.'.$companyLogoFileExtension;

  

move_uploaded_file($_FILES["logoattachment"]["tmp_name"], "profilepic/{$websiteLogo}"); 



} 

if($websiteLogo==''){ 

$websiteLogo=$oldphotologo; 

}







if($_FILES["faviiconattachment"]["tmp_name"]!=""){ 

$rt=mt_rand().strtotime(date("YMDHis")); 

$companyLogoFileName=basename($_FILES['faviiconattachment']['name']); 

$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION); 

$websiteFavicon=time().$rt.'.'.$companyLogoFileExtension;

  

move_uploaded_file($_FILES["faviiconattachment"]["tmp_name"], "profilepic/{$websiteFavicon}"); 



} 

if($websiteFavicon==''){ 

$websiteFavicon=$oldphotowebsiteFavicon; 

}



 



 



$namevalue ='companyName="'.$companyName.'",websiteLogo="'.$websiteLogo.'",websiteFavicon="'.$websiteFavicon.'",contactPhone="'.$contactPhone.'",contactEmail="'.$contactEmail.'",metaTitle="'.$metaTitle.'",metaKeyword="'.$metaKeyword.'",metaDesctiption="'.$metaDesctiption.'",whatsAppNumber="'.$whatsAppNumber.'",queryEmail="'.$queryEmail.'",contactAddress="'.$contactAddress.'",headerScript="'.$headerScript.'",footerScript="'.$footerScript.'",facebookURL="'.$facebookURL.'",twitterURL="'.$twitterURL.'",instagramURL="'.$instagramURL.'",youtubeURL="'.$youtubeURL.'",dateAdded="'.date('Y-m-d H:i:s').'",addedBy="'.$_SESSION['userid'].'"';

$where='id=1';    

updatelisting('websiteSetting',$namevalue,$where);   



?> 

<script> 

parent.redirectpage('display.html?ga=website-setting&save=1'); 

</script> 

<?php 

}





















if(trim($_POST['action'])=='addwebsitebanner' && $_POST['name']!=''){   



$name=addslashes($_POST['name']);        

$status=addslashes(strip_tags($_POST['status']));   



$addedBy=$_SESSION['userid']; 



$dateAdded=date('Y-m-d H:i:s'); 





if($_FILES["image"]["tmp_name"]!=""){



$rt=time(); 

$companyLogoFileName=basename($_FILES['image']['name']); 

$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION); 

$profilePhoto=str_replace(' ','_',substr($companyLogoFileName, 0, strpos($companyLogoFileName, ".")).$rt.'.'.$companyLogoFileExtension); 

move_uploaded_file($_FILES["image"]["tmp_name"], "package_image/{$profilePhoto}");  

} else {

$profilePhoto=$_REQUEST['oldlogo'];

}

 



if($_REQUEST['editId']==''){   

$namevalue ='name="'.$name.'",status="'.$status.'",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'",photo="'.$profilePhoto.'"'; 

addlisting('homeBanner',$namevalue);  

} else {   

$namevalue ='name="'.$name.'",status="'.$status.'",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'",photo="'.$profilePhoto.'"'; 

$where='id="'.decode($_POST['editId']).'"';  

updatelisting('homeBanner',$namevalue,$where);  

} 

?> 

<script> 

parent.redirectpage('display.html?ga=home-banner&save=1'); 

</script> 

<?php 

}















if(trim($_POST['action'])=='addwebsitetestimonial' && $_POST['name']!=''){   



$name=addslashes($_POST['name']);       

$destinationName=addslashes($_POST['destinationName']);    

$description=addslashes($_POST['description']);       
$rating=addslashes($_POST['rating']);       

$status=addslashes(strip_tags($_POST['status']));   



$addedBy=$_SESSION['userid']; 



$dateAdded=date('Y-m-d H:i:s'); 





if($_FILES["image"]["tmp_name"]!=""){



$rt=time(); 

$companyLogoFileName=basename($_FILES['image']['name']); 

$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION); 

$profilePhoto=str_replace(' ','_',substr($companyLogoFileName, 0, strpos($companyLogoFileName, ".")).$rt.'.'.$companyLogoFileExtension); 

move_uploaded_file($_FILES["image"]["tmp_name"], "package_image/{$profilePhoto}");  

} else {

$profilePhoto=$_REQUEST['oldlogo'];

}

 



if($_REQUEST['editId']==''){   

$namevalue ='name="'.$name.'",status="'.$status.'",destinationName="'.$destinationName.'",description="'.$description.'",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'",photo="'.$profilePhoto.'" ,rating="'.$rating.'"'; 

addlisting('websiteTestimonials',$namevalue);  

} else {   

$namevalue ='name="'.$name.'",status="'.$status.'",destinationName="'.$destinationName.'",description="'.$description.'",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'",photo="'.$profilePhoto.'" ,rating="'.$rating.'"'; 

$where='id="'.decode($_POST['editId']).'"';  

updatelisting('websiteTestimonials',$namevalue,$where);  

} 

?> 

<script> 

parent.redirectpage('display.html?ga=testimonials&save=1'); 

</script> 

<?php 

}




if(trim($_POST['action'])=='addwebsitedestination' && $_POST['name']!=''){   

$name=addslashes($_POST['name']);        
$theme=addslashes($_POST['theme']);        
$tagline=addslashes($_POST['tagline']);        
$type=addslashes($_POST['type']);        
$description=addslashes($_POST['description']);        

$status=addslashes(strip_tags($_POST['status']));   

$addedBy=$_SESSION['userid']; 

$dateAdded=date('Y-m-d H:i:s'); 

if($_FILES["image"]["tmp_name"]!=""){

$rt=time(); 

$companyLogoFileName=basename($_FILES['image']['name']); 

$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION); 

$profilePhoto=str_replace(' ','_',substr($companyLogoFileName, 0, strpos($companyLogoFileName, ".")).$rt.'.'.$companyLogoFileExtension); 

move_uploaded_file($_FILES["image"]["tmp_name"], "package_image/{$profilePhoto}");  

} else {

$profilePhoto=$_REQUEST['oldlogo'];

}


if($_REQUEST['editId']==''){   

$namevalue ='name="'.$name.'",theme="'.$theme.'",tagline="'.$tagline.'",status="'.$status.'",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'",photo="'.$profilePhoto.'",type="'.$type.'",description="'.$description.'"'; 

addlisting('websiteDestination',$namevalue);  

} else {   

$namevalue ='name="'.$name.'",theme="'.$theme.'",tagline="'.$tagline.'",status="'.$status.'",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'",photo="'.$profilePhoto.'",type="'.$type.'",description="'.$description.'"'; 

$where='id="'.decode($_POST['editId']).'"';  

updatelisting('websiteDestination',$namevalue,$where);  

} 

?> 

<script> 

parent.redirectpage('display.html?ga=website-destinations&save=1'); 

</script> 

<?php 

}



if(trim($_POST['action'])=='addwhatsapppromotion' && $_POST['name']!=''){   
   
  $name=addslashes($_POST['name']);        
  $fromDate=date('Y-m-d',strtotime($_POST['fromDate']));        
  $toDate=date('Y-m-d',strtotime($_POST['toDate']));          
  $packageId=addslashes($_POST['packageId']);        
  $status=addslashes(strip_tags($_POST['status']));   
  $addedBy=$_SESSION['userid']; 
  $dateAdded=date('Y-m-d H:i:s'); 

  if($_REQUEST['editId']==''){   
     $namevalue ='name="'.$name.'",fromDate="'.$fromDate.'",toDate="'.$toDate.'",packageId="'.$packageId.'",status="'.$status.'",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'"'; 
     addlisting('whatsappPromotion',$namevalue);  
  } else {   
     $namevalue ='name="'.$name.'",fromDate="'.$fromDate.'",toDate="'.$toDate.'",packageId="'.$packageId.'",status="'.$status.'",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'"'; 
     $where='id="'.decode($_POST['editId']).'"';  
     updatelisting('whatsappPromotion',$namevalue,$where);  
  } 
  ?> 
<script> parent.redirectpage('display.html?ga=whatsapp-promotion&save=1'); </script> 
<?php 
  }









if(trim($_POST['action'])=='addwebsiteaboutdestination' && $_POST['name']!=''){   



$name=addslashes($_POST['name']);  

$description=addslashes($_POST['description']);

$destinationId=addslashes($_POST['destinationId']);        

$status=addslashes(strip_tags($_POST['status']));   



$addedBy=$_SESSION['userid']; 



$dateAdded=date('Y-m-d H:i:s'); 





if($_FILES["image"]["tmp_name"]!=""){



$rt=time(); 

$companyLogoFileName=basename($_FILES['image']['name']); 

$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION); 

$profilePhoto=str_replace(' ','_',substr($companyLogoFileName, 0, strpos($companyLogoFileName, ".")).$rt.'.'.$companyLogoFileExtension); 

move_uploaded_file($_FILES["image"]["tmp_name"], "package_image/{$profilePhoto}");  

} else {

$profilePhoto=$_REQUEST['oldlogo'];

}

 



if($_REQUEST['editId']==''){   

$namevalue ='name="'.$name.'",status="'.$status.'",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'",photo="'.$profilePhoto.'",description="'.$description.'",destinationId="'.$destinationId.'"'; 

addlisting('websiteAboutDestination',$namevalue);  

} else {   

$namevalue ='name="'.$name.'",status="'.$status.'",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'",photo="'.$profilePhoto.'",description="'.$description.'",destinationId="'.$destinationId.'"'; 

$where='id="'.decode($_POST['editId']).'"';  

updatelisting('websiteAboutDestination',$namevalue,$where);  

} 

?> 

<script> 

parent.redirectpage('display.html?ga=about-website-destinations&save=1'); 

</script> 

<?php 

}









if(trim($_POST['action'])=='addwebsitephoto' && $_POST['name']!=''){   



$name=addslashes($_POST['name']);        

$status=addslashes(strip_tags($_POST['status']));   



$addedBy=$_SESSION['userid']; 



$dateAdded=date('Y-m-d H:i:s'); 





if($_FILES["image"]["tmp_name"]!=""){



$rt=time(); 

$companyLogoFileName=basename($_FILES['image']['name']); 

$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION); 

$profilePhoto=str_replace(' ','_',substr($companyLogoFileName, 0, strpos($companyLogoFileName, ".")).$rt.'.'.$companyLogoFileExtension); 

move_uploaded_file($_FILES["image"]["tmp_name"], "package_image/{$profilePhoto}");  

} else {

$profilePhoto=$_REQUEST['oldlogo'];

}

 



if($_REQUEST['editId']==''){   

$namevalue ='name="'.$name.'",status="'.$status.'",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'",photo="'.$profilePhoto.'"'; 

addlisting('websitePhotoGallery',$namevalue);  

} else {   

$namevalue ='name="'.$name.'",status="'.$status.'",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'",photo="'.$profilePhoto.'"'; 

$where='id="'.decode($_POST['editId']).'"';  

updatelisting('websitePhotoGallery',$namevalue,$where);  

} 

?> 

<script> 

parent.redirectpage('display.html?ga=website-photo-gallery&save=1'); 

</script> 

<?php 

}

















if(trim($_POST['action'])=='addwebsiteblogpost' && trim($_POST['name'])!=''){  

 

 

$name=addslashes($_POST['name']);       

$description=addslashes($_POST['description']);    

$status=addslashes($_POST['status']);       

$metaTitle=addslashes($_POST['metaTitle']);       

$metaKeyword=addslashes($_POST['metaKeyword']);       

$metaDesctiption=addslashes($_POST['metaDesctiption']);     

$editid=decode($_POST['editid']);





 

if($_FILES["image"]["tmp_name"]!=""){



$rt=time(); 

$companyLogoFileName=basename($_FILES['image']['name']); 

$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION); 

$profilePhoto=str_replace(' ','_',substr($companyLogoFileName, 0, strpos($companyLogoFileName, ".")).$rt.'.'.$companyLogoFileExtension); 

move_uploaded_file($_FILES["image"]["tmp_name"], "blogphotos/{$profilePhoto}");  

} else {

$profilePhoto=$_REQUEST['oldlogo'];

}

  



if($editid!=''){  



$namevalue ='name="'.$name.'",description="'.$description.'",status="'.$status.'",photo="'.$profilePhoto.'",metaTitle="'.$metaTitle.'",metaKeyword="'.$metaKeyword.'",metaDesctiption="'.$metaDesctiption.'",dateAdded="'.date('Y-m-d H:i:s').'",addedBy="'.$_SESSION['userid'].'"';

$where='id="'.$editid.'"';    

updatelisting('websiteBlog',$namevalue,$where);  

  

} else {  

$namevalue ='name="'.$name.'",description="'.$description.'",status="'.$status.'",photo="'.$profilePhoto.'",metaTitle="'.$metaTitle.'",metaKeyword="'.$metaKeyword.'",metaDesctiption="'.$metaDesctiption.'",dateAdded="'.date('Y-m-d H:i:s').'",addedBy="'.$_SESSION['userid'].'"';

addlistinggetlastid('websiteBlog',$namevalue);  

  

}  

 

 

?> 

<script> 

parent.redirectpage('display.html?ga=website-blog&save=1'); 

</script> 

<?php 

}















if(trim($_POST['action'])=='addwebsitetheme' && $_POST['name']!=''){   



$name=addslashes($_POST['name']);        
$description=addslashes($_POST['description']);        

$status=addslashes(strip_tags($_POST['status']));   



$addedBy=$_SESSION['userid']; 



$dateAdded=date('Y-m-d H:i:s'); 





if($_FILES["image"]["tmp_name"]!=""){



$rt=time(); 

$companyLogoFileName=basename($_FILES['image']['name']); 

$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION); 

$profilePhoto=str_replace(' ','_',substr($companyLogoFileName, 0, strpos($companyLogoFileName, ".")).$rt.'.'.$companyLogoFileExtension); 

move_uploaded_file($_FILES["image"]["tmp_name"], "package_image/{$profilePhoto}");  

} else {

$profilePhoto=$_REQUEST['oldlogo'];

}

 



if($_REQUEST['editId']==''){   

$namevalue ='name="'.$name.'",status="'.$status.'",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'",photo="'.$profilePhoto.'",description="'.$description.'"'; 

addlisting('websitePackageTheme',$namevalue);  

} else {   

$namevalue ='name="'.$name.'",status="'.$status.'",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'",photo="'.$profilePhoto.'",description="'.$description.'"'; 

$where='id="'.decode($_POST['editId']).'"';  

updatelisting('websitePackageTheme',$namevalue,$where);  

} 

?> 

<script> 

parent.redirectpage('display.html?ga=package-theme&save=1'); 

</script> 

<?php 

}



















if(trim($_POST['action'])=='addcompanyexpense' && $_POST['amount']!='' && $_POST['paymentType']!=''){  



 

 



if($_POST['editid']>0){



$namevalue2 ='amount="'.trim($_REQUEST['amount']).'",paymentDate="'.date('Y-m-d H:i:s',strtotime($_REQUEST['startDate'].' '.date('H:i:s'))).'",paymentBy="'.$_SESSION['userid'].'",paymentStatus="'.$_POST['status'].'",paymentType="'.$_POST['paymentType'].'",remark="'.addslashes($_POST['remark']).'"';

$where='id="'.decode($_POST['editid']).'"';    

updatelisting('expenseMaster',$namevalue2,$where);  

 



} else { 



$namevalue2 ='amount="'.trim($_REQUEST['amount']).'",paymentDate="'.date('Y-m-d H:i:s',strtotime($_REQUEST['startDate'])).'",paymentBy="'.$_SESSION['userid'].'",paymentStatus="'.$_POST['status'].'",paymentType="'.$_POST['paymentType'].'",remark="'.addslashes($_POST['remark']).'"';

addlistinggetlastid('expenseMaster',$namevalue2); 



}

  



?> 

<script> 

parent.redirectpage('display.html?ga=company-expense&save=1'); 

</script> 

<?php

}















if(trim($_POST['action'])=='loadpackagecommnet' && $_POST['pid']!='' && $_POST['comment']!=''){ 



 

addlistinggetlastid('packageComment','packageId="'.trim($_REQUEST['pid']).'",addDate="'.date('Y-m-d H:i:s').'",comment="'.addslashes($_REQUEST['comment']).'"');





$abcd=GetPageRecord('*','sys_packageBuilder','id="'.$_REQUEST['pid'].'"'); 

$result=mysqli_fetch_array($abcd);    

  

  

addlisting('queryTask','queryId="'.$_REQUEST['pid'].'",details="New Comment on '.addslashes($result['name']).'",status="1",dateAdded="'.date('Y-m-d H:i:s').'",taskType="Notification",notificationType="1"');  

?> 

<script> 

parent.funloadpackagecommnet(); 

</script> 

<?php

}























if(trim($_POST['action'])=='addautomation' && $_POST['queryStatus']!=0 && $_POST['packageId']!=0 && $_POST['destinationId']!="" ){   



$queryStatus=addslashes($_POST['queryStatus']);  

$packageId=addslashes($_POST['packageId']);      

$destinationId=addslashes($_POST['destinationId']);   

$details=addslashes($_POST['details']);    

$startDate=date('Y-m-d',strtotime($_POST['startDate'])); 

$endDate=date('Y-m-d',strtotime($_POST['endDate']));   



$status=addslashes(strip_tags($_POST['status']));   

$addedBy=$_SESSION['userid'];  

$dateAdded=date('Y-m-d H:i:s');   

 



if($_REQUEST['editId']==''){   

$namevalue ='queryStatus="'.$queryStatus.'",packageId="'.$packageId.'",destinationId="'.$destinationId.'",details="'.$details.'",startDate="'.$startDate.'",endDate="'.$endDate.'",status="'.$status.'",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'"'; 

addlisting('automationMaster',$namevalue);   

} else {   

$namevalue ='queryStatus="'.$queryStatus.'",packageId="'.$packageId.'",destinationId="'.$destinationId.'",details="'.$details.'",startDate="'.$startDate.'",endDate="'.$endDate.'",status="'.$status.'",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'"';

$where='id="'.decode($_POST['editId']).'"';    

updatelisting('automationMaster',$namevalue,$where);  

}



?> 

<script> 

parent.redirectpage('display.html?ga=automation&save=1'); 

</script> 

<?php 

}



















if(trim($_POST['action'])=='adddayitinerary' && $_POST['name']!='' && $_POST['destination']!=''){   



$name=addslashes($_POST['name']);      

$destination=addslashes($_POST['destination']);    

$status=addslashes(strip_tags($_POST['status']));      

$address=addslashes(strip_tags($_POST['address']));

$details=addslashes(($_POST['details']));



$addedBy=$_SESSION['userid']; 



$dateAdded=date('Y-m-d H:i:s'); 



  



if($_REQUEST['editId']==''){   

$namevalue ='name="'.$name.'",destination="'.$destination.'",status="'.$status.'",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'",details="'.$details.'"'; 

addlisting('dayItineraryMaster',$namevalue);  

} else {   

$namevalue ='name="'.$name.'",destination="'.$destination.'",status="'.$status.'",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'",details="'.$details.'"'; 

$where='id="'.decode($_POST['editId']).'"';  

updatelisting('dayItineraryMaster',$namevalue,$where);  

} 

?> 

<script> 

parent.redirectpage('display.html?ga=dayitinerarysmaster&save=1'); 

</script> 

<?php 

}







if(trim($_POST['action'])=='addbranch' && $_POST['name']!='' && $_POST['destinations']!='' ){   



$name=addslashes($_POST['name']); 

$destinations=addslashes($_POST['destinations']);       

$status=addslashes(strip_tags($_POST['status']));  



$addedBy=$_SESSION['userid'];  

$dateAdded=date('Y-m-d H:i:s');   

 



if($_REQUEST['editId']==''){   

$namevalue ='name="'.$name.'",status="'.$status.'",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'",destinations="'.$destinations.'"'; 

addlisting('branchMaster',$namevalue);   

} else {   

$namevalue ='name="'.$name.'",status="'.$status.'",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'",destinations="'.$destinations.'"'; 

$where='id="'.decode($_POST['editId']).'"';    

updatelisting('branchMaster',$namevalue,$where);  

}



?> 

<script> 

parent.redirectpage('display.html?ga=branches&save=1'); 

</script> 

<?php 

}









if(trim($_POST['action'])=='addrole' && $_POST['name']!='' && $_POST['branchId']!='' && $_POST['parentId']!='' ){   



$name=addslashes($_POST['name']); 

$parentId=addslashes($_POST['parentId']); 

$branchId=addslashes($_POST['branchId']); 

$destinations=addslashes($_POST['destinations']);       

$status=addslashes(strip_tags($_POST['status']));  



$addedBy=$_SESSION['userid'];  

$dateAdded=date('Y-m-d H:i:s');   

 



if($_REQUEST['editId']==''){   

$namevalue ='name="'.$name.'",status="'.$status.'",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'",parentId="'.$parentId.'",branchId="'.$branchId.'"'; 

addlisting('roleMaster',$namevalue);   

} else {   

$namevalue ='name="'.$name.'",status="'.$status.'",addedBy="'.$addedBy.'",dateAdded="'.$dateAdded.'",parentId="'.$parentId.'",branchId="'.$branchId.'"'; 

$where='id="'.decode($_POST['editId']).'"';    

updatelisting('roleMaster',$namevalue,$where);  

}



?> 

<script> 

parent.redirectpage('display.html?ga=roles&save=1'); 

</script> 

<?php 

}













if(trim($_REQUEST['action'])=='updateSalesTarget' && $_REQUEST['targetYear']!='' && $_REQUEST['salesPersonId']!=''){   



for($i=1; $i<=12; $i++){



$ba=GetPageRecord('*','salesTargetMaster',' salesPersonId="'.decode($_REQUEST['salesPersonId']).'" and targetMonth="'.addslashes(trim($i)).'" and targetYear="'.addslashes(trim($_REQUEST['targetYear'])).'"'); 

if(mysqli_num_rows($ba)>0){

$targetData=mysqli_fetch_array($ba);



$namevalue ='targetAmount="'.addslashes(trim($_REQUEST['targetAmount'.$i])).'"';   

$where='id="'.$targetData['id'].'"';    

updatelisting('salesTargetMaster',$namevalue,$where);





}else{  



$namevalue2 ='targetMonth="'.addslashes(trim($i)).'",targetYear="'.addslashes(trim($_REQUEST['targetYear'])).'",targetAmount="'.addslashes(trim($_REQUEST['targetAmount'.$i])).'",salesPersonId="'.decode($_REQUEST['salesPersonId']).'"'; 

$lstaddid=addlistinggetlastid('salesTargetMaster',$namevalue2);



}

}

 

 



?>  

<script>     

parent.redirectpage('display.html?targetYear=<?php echo $_REQUEST['targetYear']; ?>&id=<?php echo $_REQUEST['salesPersonId']; ?>&Save=View+Year&ga=team&add=1'); 

</script>  

<?php 

} 















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

window.location.href = "flyer-designer/edit-project.html?id=<?php echo encode($lastid); ?>";

</script>

<?php



}

}











if(trim($_REQUEST['action'])=='weathersetting' && $_REQUEST['cityName1']!='' && $_REQUEST['cityName2']!='' && $_REQUEST['cityName3']!='' && $_REQUEST['cityName4']!=''){   



  

 

$namevalue ='cityName="'.$_REQUEST['cityName1'].'",udpateDate=""'; 

$where='id=1';    

updatelisting('weatherAPI',$namevalue,$where);

 

$namevalue ='cityName="'.$_REQUEST['cityName2'].'",udpateDate=""'; 

$where='id=2';    

updatelisting('weatherAPI',$namevalue,$where);

 

$namevalue ='cityName="'.$_REQUEST['cityName3'].'",udpateDate=""'; 

$where='id=3';    

updatelisting('weatherAPI',$namevalue,$where);

 

$namevalue ='cityName="'.$_REQUEST['cityName4'].'",udpateDate=""'; 

$where='id=4';    

updatelisting('weatherAPI',$namevalue,$where);

 

 

$rswe=GetPageRecord('*','weatherAPI',' 1 and udpateDate<"'.date('Y-m-d').'" order by id asc'); 

while($restWeather=mysqli_fetch_array($rswe)){ 

  



$curl = curl_init();



curl_setopt_array($curl, [

	CURLOPT_URL => "https://weather-by-api-ninjas.p.rapidapi.com/v1/weather?city=".$restWeather['cityName']."",

	CURLOPT_RETURNTRANSFER => true,

	CURLOPT_FOLLOWLOCATION => true,

	CURLOPT_ENCODING => "",

	CURLOPT_MAXREDIRS => 10,

	CURLOPT_TIMEOUT => 30,

	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

	CURLOPT_CUSTOMREQUEST => "GET",

	CURLOPT_HTTPHEADER => [

		"X-RapidAPI-Host: weather-by-api-ninjas.p.rapidapi.com",

		"X-RapidAPI-Key: 4qHxfnYRW8mshIpW9aY4RfeEmocZp1ZXAWDjsnQk9pQYTjDPCQ"

	],

]);



$response = curl_exec($curl);

$err = curl_error($curl);



curl_close($curl);



if ($err) {

	echo "cURL Error #:" . $err;

} else {

	

	$data = json_decode($response);	

	

 

	

$namevalue ='cloud_pct="'.$data->cloud_pct.'",tempWether="'.$data->temp.'",feels_like="'.$data->feels_like.'",humidity="'.$data->humidity.'",min_temp="'.$data->min_temp.'",max_temp="'.$data->max_temp.'",wind_speed="'.$data->wind_speed.'",wind_degrees	="'.$data->wind_degrees	.'",sunrise="'.$data->sunrise.'",sunset="'.$data->sunset.'",udpateDate="'.date('Y-m-d').'"';   

$where='id="'.$restWeather['id'].'"';    

updatelisting('weatherAPI',$namevalue,$where); 



}





}

?>  

<script>     

parent.redirectpage('display.html?ga=adminsetting&save=1'); 

</script>  

<?php 

} 


if($_POST['action']=='sendmailermail' && $_POST['tomailfield']!='' && $_POST['subjectmailfield'] && $_POST['sendmailbodyfield']!=''){
include "config/mail.php";
send_attachment_mail($fromemail,$_POST['tomailfield'],$_POST['subjectmailfield'],$_POST['sendmailbodyfield'],$ccmail.','.$_SESSION['username'],$file_name);

$namevalue ='subject="'.addslashes($_POST['subjectmailfield']).'",details="'.addslashes($_POST['sendmailbodyfield']).'",fromEmail="'.$LoginUserDetails['emailAccount'].'",toEmail="'.$_POST['tomailfield'].'",dateAdded="'.date('Y-m-d H:i:s').'",addedBy="'.$_SESSION['userid'].'",ccEmail="'.$_POST['ccEmail'].'"';   

$lastid=addlistinggetlastid('queryMail',$namevalue);

?>
<script>
parent.$('#mailsending').show();
parent.$('.sendmailbox').hide();

setTimeout( function(){ 
    parent.$('#mailsending').hide();
    parent.$('#mailiddisplay').show();
    parent.$('#sendmailbtn').show();
    parent.discardmail();
	
  }  , 2000 );
</script>
<?php
}
 


if($_POST['action']=='subscribe'){
    $namevalue ='email="'.addslashes($_POST['email']).'", user_ip="'.$_SERVER['REMOTE_ADDR'].'"';   
    $lastid=addlistinggetlastid('newsletterSubscription',$namevalue);
   ?>
<script>
   alert('You subscribed our newsletter successfully');
   window.top.location.href = "<?php echo $websiteurl; ?>";
</script>
<?php
   }
   
   
   
   if(trim($_REQUEST['action'])=='addItinerariesGallary' && $_REQUEST['itinerariesId']!=''){ 
   
    $totalImg = count($_FILES["image"]["tmp_name"]);
      
    for($i=0; $i<=$totalImg; $i++){
      if($_FILES["image"]["tmp_name"][$i]!=""){ 
        $rt=time(); 
        $companyLogoFileName=basename($_FILES['image']['name'][$i]); 
        $companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION); 
        $profilePhoto=str_replace(' ','_',substr($companyLogoFileName, 0, strpos($companyLogoFileName, ".")).$rt.'.'.$companyLogoFileExtension); 
        move_uploaded_file($_FILES["image"]["tmp_name"][$i], "package_image/{$profilePhoto}"); 
        
        $namevalue ='image="'.$profilePhoto.'",itinerariesId="'.decode($_REQUEST['itinerariesId']).'"';   
        $lastId=addlistinggetlastid('itinerariesGallery',$namevalue);   
        
        ?>
      <script>
         var e = $('<div class="col-md-3 gal" id="delId<?php echo $lastId; ?>"><i class="fa fa-times-circle-o del" aria-hidden="true" id="trash<?php echo $lastId; ?>"></i><div class="form-group"><img src="<?php echo $fullurl; ?>package_image/<?php echo $profilePhoto; ?>" width="150" /></div></div>');
         parent.$('#loadimages').append(e);    
         parent.$("#trash<?php echo $lastId; ?>").attr("onclick", "deleteimage('<?Php echo $lastId; ?>')");
      </script>
      <?php
      } } }
   
    
   if(trim($_REQUEST['action'])=='deleteaddItinerariesGallary' && trim($_REQUEST['did'])!=''){    
   
   deleteRecord('itinerariesGallery','id="'.$_REQUEST['did'].'"');  
   ?> 
<script> 
   parent.$('#delId<?php echo $_REQUEST['did']; ?>').remove();
</script> 
<?php 
   }
   

if(trim($_REQUEST['action'])=='addCruiseBannerGallary' && $_REQUEST['cruiseId']!='' && $_REQUEST['type']!=''){ 
   
   $totalImg = count($_FILES["image"]["tmp_name"]);
     
   for($i=0; $i<=$totalImg; $i++){
     if($_FILES["image"]["tmp_name"][$i]!=""){ 
       $rt=time(); 
       $companyLogoFileName=basename($_FILES['image']['name'][$i]); 
       $companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION); 
       $profilePhoto=str_replace(' ','_',substr($companyLogoFileName, 0, strpos($companyLogoFileName, ".")).$rt.'.'.$companyLogoFileExtension); 
       move_uploaded_file($_FILES["image"]["tmp_name"][$i], "package_image/{$profilePhoto}"); 
       
       $namevalue ='image="'.$profilePhoto.'",cruiseId="'.decode($_REQUEST['cruiseId']).'",type="'.$_REQUEST['type'].'"';   
       $lastId=addlistinggetlastid('cruiseGallery',$namevalue);   
       
       ?>
     <script>
        var e = $('<div class="col-md-3 gal" id="delId<?php echo $lastId; ?>"><i class="fa fa-times-circle-o del" aria-hidden="true" id="trash<?php echo $lastId; ?>"></i><div class="form-group"><img src="<?php echo $fullurl; ?>package_image/<?php echo $profilePhoto; ?>" width="150" /></div></div>');
        parent.$('#loadimages').append(e);    
        parent.$("#trash<?php echo $lastId; ?>").attr("onclick", "deleteimage('<?Php echo $lastId; ?>')");
     </script>
     <?php
     } } }
  
   
  if(trim($_REQUEST['action'])=='deleteaddCruiseBannerGallary' && trim($_REQUEST['did'])!=''){    
  
  deleteRecord('cruiseGallery','id="'.$_REQUEST['did'].'" ');  
  ?> 
<script> 
  parent.$('#delId<?php echo $_REQUEST['did']; ?>').remove();
</script> 
<?php 
  }



  if(trim($_REQUEST['action'])=='addCruiseExpectGallary' && $_REQUEST['cruiseId']!='' && $_REQUEST['type']!=''){ 
   
   $totalImg = count($_FILES["image"]["tmp_name"]);
     
   for($i=0; $i<=$totalImg; $i++){
     if($_FILES["image"]["tmp_name"][$i]!=""){ 
       $rt=time(); 
       $companyLogoFileName=basename($_FILES['image']['name'][$i]); 
       $companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION); 
       $profilePhoto=str_replace(' ','_',substr($companyLogoFileName, 0, strpos($companyLogoFileName, ".")).$rt.'.'.$companyLogoFileExtension); 
       move_uploaded_file($_FILES["image"]["tmp_name"][$i], "package_image/{$profilePhoto}"); 
       
       $namevalue ='image="'.$profilePhoto.'",cruiseId="'.decode($_REQUEST['cruiseId']).'",type="'.$_REQUEST['type'].'"';   
       $lastId=addlistinggetlastid('cruiseGallery',$namevalue);   
       
       ?>
     <script>
        var e = $('<div class="col-md-3 gal" id="delId<?php echo $lastId; ?>"><i class="fa fa-times-circle-o del" aria-hidden="true" id="trash<?php echo $lastId; ?>"></i><div class="form-group"><img src="<?php echo $fullurl; ?>package_image/<?php echo $profilePhoto; ?>" width="150" /></div></div>');
        parent.$('#loadimages').append(e);    
        parent.$("#trash<?php echo $lastId; ?>").attr("onclick", "deleteimage('<?Php echo $lastId; ?>')");
     </script>
     <?php
     } } }
  
   
  if(trim($_REQUEST['action'])=='deleteaddCruiseExpectGallary' && trim($_REQUEST['did'])!=''){    
  
  deleteRecord('cruiseGallery','id="'.$_REQUEST['did'].'" ');  
  ?> 
<script> 
  parent.$('#delId<?php echo $_REQUEST['did']; ?>').remove();
</script> 
<?php 
  }
  
  
  
  
  
  
  
if($_POST['action']=='updatePNR' && $_POST['editid']!=''){ 

 
$bookingNumber=trim(addslashes($_POST['bookingNumber']));

$pnrNo=trim(addslashes($_POST['pnrNo']));  

$rejectType=trim(addslashes($_POST['rejectType'])); 

$supplier=trim(addslashes($_POST['supplier']));  

$type=trim(addslashes($_POST['type']));  

$status=trim(addslashes($_POST['status']));  

$remark=trim(addslashes($_POST['remark']));  

$airlinerefund=trim(addslashes($_POST['airlinerefund']));  ;  

$servicecharge=trim(addslashes($_POST['servicecharge']));

$noshowrefund=trim(addslashes($_POST['noshowrefund']));







$editid=$_POST['editid']; 



if($type=="online"){

	$url="flightbooking";

}else{

	$url="offlineflightbooking";

}



$namevalue ='pnrNo="'.$pnrNo.'",bookingNumber="'.$bookingNumber.'",supplier="'.$supplier.'",remark="'.$remark.'",status="'.$status.'",updateDatePNR="'.date('Y-m-d H:i:s').'"'; 



$where=' id="'.decode($_REQUEST['editid']).'"';

updatelisting('flightBookingMaster',$namevalue,$where);

    

//Update Ticket No. Passangers wise ->flightBookingPaxDetailMaster

$count=count($_POST["rowId"]);



for($i=0;$i<$count;$i++){

$namevalue1 ='ticketNo="'.addslashes($_POST["ticketNo"][$i]).'"'; 

$where1=' id="'.$_POST["rowId"][$i].'"';

updatelisting('flightBookingPaxDetailMaster',$namevalue1,$where1);	

}





 

  

 sendtickettomail($fullurl,$_REQUEST['editid']);

 



 



if($status=="4" || $status=="3"){ 

/*

*For Reject

*Reverse Balance to Agent Account

*Fetch Previous Balance Details

*/

$prvBalance=GetPageRecord('*','sys_balanceSheet',' bookingId="'.decode($_REQUEST['editid']).'" and agentId in(select id from sys_userMaster where userType="agent")  order by id asc'); 

while($prvBalanceData=mysqli_fetch_array($prvBalance)){

	$agentId=$prvBalanceData["agentId"];

	$SubAgentId=$prvBalanceData["SubAgentId"];

	$amount=$prvBalanceData["amount"];

	$paymentMethod=$prvBalanceData["paymentMethod"];

	$transactionId=$prvBalanceData["transactionId"];

	$attachment=$prvBalanceData["attachment"];

	$bookingId=$prvBalanceData["bookingId"];

	$bookingType=$prvBalanceData["bookingType"];

	$offlineAgent=$prvBalanceData["offlineAgent"];

	

	if($prvBalanceData["paymentType"]=="Debit"){

		$paymentType="Credit";

	}

	

	if($prvBalanceData["paymentType"]=="Credit"){

		$paymentType="Debit";

	}

	

if($status==3){

$rej='Cancelled';

}

	

if($status==4){

$rej='Rejected';

}	

//Insert Reverse Entry in BalanceSheet

 $namevalue ='agentId="'.$agentId.'",SubAgentId="'.$SubAgentId.'",amount="'.$amount.'", remarks="'.$rej.'",paymentMethod="'.$paymentMethod.'",transactionId="'.$transactionId.'",attachment="'.$attachment.'",paymentType="'.$paymentType.'",bookingId="'.$bookingId.'",bookingType="'.$bookingType.'",addedBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'",offlineAgent="'.$offlineAgent.'"';  

addlistinggetlastid('sys_balanceSheet',$namevalue); 	



 

	

if($prvBalanceData["bookingType"]=='flight'){

$rrfundamount=$amount;

}

	

	

}

 



if($rejectType==1){ }	

}

 

 if($airlinerefund>0 && $servicecharge>0){

 $namevalue ='agentId="'.$agentId.'",SubAgentId="'.$SubAgentId.'",amount="'.($airlinerefund+$servicecharge).'", remarks="Airline Refund",paymentMethod="Online",transactionId="'.$transactionId.'",attachment="'.$attachment.'",paymentType="Debit",bookingId="'.$bookingId.'",bookingType="flight",addedBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'",offlineAgent="'.$offlineAgent.'"';  

addlistinggetlastid('sys_balanceSheet',$namevalue); 

 }

 

 

  if($noshowrefund>0){

 $namevalue ='agentId="'.$agentId.'",SubAgentId="'.$SubAgentId.'",amount="'.($noshowrefund).'", remarks="No Show Refund",paymentMethod="Online",transactionId="'.$transactionId.'",attachment="'.$attachment.'",paymentType="Debit",bookingId="'.$bookingId.'",bookingType="flight",addedBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'",offlineAgent="'.$offlineAgent.'"';  

addlistinggetlastid('sys_balanceSheet',$namevalue); 

 }

 

?>

<script>

parent.redirectpage('display.html?ga=<?php echo $url; ?>&save=1');

</script>



<?php

exit();

}



  
  


if($_POST['action']=='confirmHotelVoucher' && $_POST['editid']!=''){ 

 

$confirmationNo=trim(addslashes($_POST['confirmationNo']));  

$supplier=trim(addslashes($_POST['supplier']));  

$type=trim(addslashes($_POST['type']));  

$status=trim(addslashes($_POST['status']));  

$status=trim(addslashes($_POST['status']));  

$confirmedBy=trim(addslashes($_POST['confirmedBy']));  

$remark=trim(addslashes($_POST['remark']));  

$editid=$_POST['editid']; 


 

	$url="hotelBookings";

 



$namevalue ='confirmationNo="'.$confirmationNo.'",supplier="'.$supplier.'",remark="'.$remark.'",status="'.$status.'",confirmedBy="'.$confirmedBy.'",confirmedDate="'.date('Y-m-d H:i:s').'"';   
$where=' id="'.decode($_REQUEST['editid']).'"'; 
updatelisting('hotelBookingMaster',$namevalue,$where);



//Update Ticket No. Passangers wise ->flightBookingPaxDetailMaster

 
if($_REQUEST['hotelRequest']!=1){
if($status=="4" || $status=="3"){ 

/*

*For Reject

*Reverse Balance to Agent Account

*Fetch Previous Balance Details

*/

$prvBalance=GetPageRecord('*','sys_balanceSheet',' bookingId="'.decode($_REQUEST['editid']).'" order by id asc'); 

while($prvBalanceData=mysqli_fetch_array($prvBalance)){

	$agentId=$prvBalanceData["agentId"];

	$SubAgentId=$prvBalanceData["SubAgentId"];

	$amount=$prvBalanceData["amount"];

	$paymentMethod=$prvBalanceData["paymentMethod"];

	$transactionId=$prvBalanceData["transactionId"];

	$attachment=$prvBalanceData["attachment"];

	$bookingId=$prvBalanceData["bookingId"];

	$bookingType=$prvBalanceData["bookingType"];

	$offlineAgent=$prvBalanceData["offlineAgent"];

	

	if($prvBalanceData["paymentType"]=="Debit"){

		$paymentType="Credit";

	}

	

	if($prvBalanceData["paymentType"]=="Credit"){

		$paymentType="Debit";

	}

	

//Insert Reverse Entry in BalanceSheet

$namevalue ='agentId="'.$agentId.'",SubAgentId="'.$SubAgentId.'",amount="'.$amount.'", remarks="Rejected",paymentMethod="'.$paymentMethod.'",transactionId="'.$transactionId.'",attachment="'.$attachment.'",paymentType="'.$paymentType.'",bookingId="'.$bookingId.'",bookingType="'.$bookingType.'",addedBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'",offlineAgent="'.$offlineAgent.'"';  

addlistinggetlastid('sys_balanceSheet',$namevalue); 	

	
$namevalue ='bookedRoom="0"';
$where=' id="'.decode($_REQUEST['editid']).'"';  
updatelisting('hotelBookingMaster',$namevalue,$where);


}
}
}
 

if($_REQUEST['hotelRequest']==1 && $status==2){

$ag=GetPageRecord('*','hotelBookingMaster','id="'.decode($_REQUEST['editid']).'" '); 
$hotelbook=mysqli_fetch_array($ag);


$a ='bookingId="'.$hotelbook['BookingNumber'].'",bookingType="hotel",agentId="'.($hotelbook['agentId']).'",amount="'.round($hotelbook['agentTotalFare']-$hotelbook['agentMarukup']).'",paymentType="Debit",addedBy="'.$hotelbook['agentId'].'",addDate="'.date('Y-m-d H:i:s').'",billType="hotel"';
	addlistinggetlastid('sys_balanceSheet',$a);
 
}
 

 //sendhoteltickettomail($fullurl,$_REQUEST['editid']);

 

?>

<script>

parent.redirectpage('display.html?ga=<?php echo $url; ?>&save=1');

</script>



<?php

exit();

}



if($_POST['action']=='addwebcheck'){



$flightName=addslashes($_POST['flightName']); 

$url=addslashes($_POST['url']);

$status=addslashes($_POST['status']);

$editid=addslashes($_POST['editid']);



$sql='';



if($_FILES["logo"]["tmp_name"]!=""){  

$rt=mt_rand().strtotime(date("YMDHis")); 

$companyLogoFileName=basename($_FILES['logo']['name']); 

$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION);  

$companyLogo=time().$rt.'.'.$companyLogoFileExtension;

move_uploaded_file($_FILES["logo"]["tmp_name"], "upload/{$companyLogo}"); 

$sql.=',logo="'.$companyLogo.'"';

}





if($editid!=''){

//-------EDIT-----------



$namevalue ='flightName="'.$flightName.'",url="'.$url.'",status="'.$status.'",addDate="'.date("Y-m-d H:i:s").'",addBy="'.$_SESSION['userid'].'" '.$sql.''; 

$where='id="'.decode($editid).'"';   

updatelisting('sys_webCheckMaster',$namevalue,$where); 



 

} else { 



//-------ADD----------- 



$namevalue ='flightName="'.$flightName.'",url="'.$url.'",status="'.$status.'",addDate="'.date("Y-m-d H:i:s").'",addBy="'.$_SESSION['userid'].'"';  
$lastid=addlistinggetlastid('sys_webCheckMaster',$namevalue);   
 

}


 



 



 

?>

<script>

parent.redirectpage('display.html?ga=webcheck&<?php if($editid!=''){ echo 'save=1'; } else { echo 'added=1'; } ?>');

</script>



<?php

exit();

}



if($_POST['action']=='addspecialdeal'){



$title=addslashes($_POST['title']);

$dealtype=addslashes($_POST['dealtype']);

$url=addslashes($_POST['url']);

$description=addslashes($_POST['description']);

$status=addslashes($_POST['status']);

$editid=addslashes($_POST['editid']);



$sql='';

if($_FILES["image"]["tmp_name"]!=""){

$rt=mt_rand().strtotime(date("YMDHis"));

$companyLogoFileName=basename($_FILES['image']['name']);

$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION);  

$companyLogo=time().$rt.'.'.$companyLogoFileExtension;

move_uploaded_file($_FILES["image"]["tmp_name"], "upload/{$companyLogo}"); 

$sql.=',image="'.$companyLogo.'"';

}





if($editid!=''){

//-------EDIT-----------



$namevalue ='title="'.$title.'",url="'.$url.'",description="'.$description.'",status="'.$status.'",dealtype="'.$dealtype.'",addDate="'.date("Y-m-d H:i:s").'",addBy="'.$_SESSION['userid'].'" '.$sql.'';  
$where='id="'.decode($editid).'"';   
updatelisting('sys_specialDeal',$namevalue,$where); 
 

} else { 



//-------ADD----------- 

$namevalue ='title="'.$title.'",url="'.$url.'",description="'.$description.'",status="'.$status.'",dealtype="'.$dealtype.'",addDate="'.date("Y-m-d H:i:s").'",addBy="'.$_SESSION['userid'].'" '.$sql.'';  
$lastid=addlistinggetlastid('sys_specialDeal',$namevalue);   
 
}


 



 





?>

<script>

parent.redirectpage('display.html?ga=specialdeal&<?php if($editid!=''){ echo 'save=1'; } else { echo 'added=1'; } ?>');

</script>



<?php

exit();

}





if($_POST['action']=='addmarquee'){



$title=addslashes($_POST['title']); 

$messageType=addslashes($_POST['messageType']); 

$url=addslashes($_POST['url']);

$status=addslashes($_POST['status']);

$editid=addslashes($_POST['editid']);



if($editid!=''){

//-------EDIT-----------



$namevalue ='title="'.$title.'",url="'.$url.'",status="'.$status.'",messageType="'.$messageType.'",addDate="'.date("Y-m-d H:i:s").'",addBy="'.$_SESSION['userid'].'"';  
$where='id="'.decode($editid).'"';    
updatelisting('sys_Marquee',$namevalue,$where);  

 

} else { 



//-------ADD----------- 



$namevalue ='title="'.$title.'",url="'.$url.'",status="'.$status.'",messageType="'.$messageType.'",addDate="'.date("Y-m-d H:i:s").'",addBy="'.$_SESSION['userid'].'"';  
$lastid=addlistinggetlastid('sys_Marquee',$namevalue);   
 
}



 



 

?>

<script>

parent.redirectpage('display.html?ga=marquee&<?php if($editid!=''){ echo 'save=1'; } else { echo 'added=1'; } ?>');

</script>



<?php

exit();

}




if($_POST['action']=='commissiontype' && $_POST['name']!=""){



$name=addslashes($_POST['name']);  



  

if($_POST['editid']!=''){ 

$namevalue ='name="'.$name.'",parentId="'.$LoginUserDetails['parentId'].'",details="'.$companyLogo.'",status=1,editBy="'.$_SESSION['userid'].'",editDate="'.date('Y-m-d H:i:s').'"';  

$where=' id="'.decode($_REQUEST['editid']).'"';

updatelisting('sys_commissionType',$namevalue,$where); 



}else{





$namevalue ='name="'.$name.'",details="'.$companyLogo.'",parentId="'.$LoginUserDetails['parentId'].'",status=1,editBy="'.$_SESSION['userid'].'",editDate="'.date('Y-m-d H:i:s').'"';  

addlistinggetlastid('sys_commissionType',$namevalue);  



}
 



?>

<script>

parent.redirectpage('display.html?ga=commissiontype&save=1');

</script>



<?php

exit();

}





if($_POST['action']=='addfaretypedomesticFlightsMarkup' && $_POST['name']!=''){ 





$typeid=trim(addslashes($_POST['typeid']));  

$sectorType=trim(addslashes($_POST['sectorType']));  

$name=addslashes(trim($_POST['name']));  

$markupType=addslashes(trim($_POST['markupType']));  

$markupValue=addslashes(trim($_POST['markupValue']));  

$flightId=decode($_POST['flightId']);

$editid=trim(addslashes($_POST['editid']));

 

 



 

if($editid!=''){



$namevalue ='flightId="'.$flightId.'",name="'.$name.'",agentTypeGroupId="'.decode($typeid).'",markupType="'.$markupType.'",sectorType="'.$sectorType.'",markupValue="'.$markupValue.'",editBy="'.$_SESSION['userid'].'",editDate="'.date('Y-m-d H:i:s').'"';   



$where='  id="'.decode($_REQUEST['editid']).'" and  flightId="'.$flightId.'"';

updatelisting('fareTypedomesticFlightsMarkupMaster',$namevalue,$where);  



} else { 

  



$namevalue ='flightId="'.$flightId.'",name="'.$name.'",agentTypeGroupId="'.decode($typeid).'",sectorType="'.$sectorType.'",markupType="'.$markupType.'",markupValue="'.$markupValue.'",parentId="'.$LoginUserDetails['parentId'].'",addBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';  

addlistinggetlastid('fareTypedomesticFlightsMarkupMaster',$namevalue); 
 



$namevalue ='agentId="'.$_SESSION['userid'].'",sectorType="'.$sectorType.'",agentTypeGroupId="'.decode($typeid).'",flightId="'.$flightId.'",name="'.$name.'",markupType="'.$markupType.'",markupValue="'.$markupValue.'",parentId="'.$LoginUserDetails['parentId'].'",addBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';  

addlistinggetlastid('agent_fareTypedomesticFlightsMarkupMaster',$namevalue);  



 

 



}





 



?>

<script>

alert('Saved Successfully!');

parent.$('#name').val(''); 

parent.$('#markupValue').val(''); 

parent.$('#editid').val('');



parent.window.location.reload();

</script>



<?php

exit();

}






if($_POST['action']=='adddomesticflightsmarkup' && $_POST['name']!="" && $_POST['name']!=""){ 

 

$name=trim(addslashes($_POST['name']));   

$typeid=trim(addslashes($_POST['typeid']));  

$editid=trim(addslashes($_POST['editid'])); 

$status=trim(addslashes($_POST['status']));  





  

if($editid!=''){



$namevalue ='name="'.$name.'",status="'.$status.'",agentTypeGroupId="'.decode($typeid).'",editBy="'.$_SESSION['userid'].'",editDate="'.date('Y-m-d H:i:s').'"'; 



$where=' id="'.decode($_REQUEST['editid']).'"';

updatelisting('domesticFlightsMarkupMaster',$namevalue,$where); 

  

} else { 
 

$rs7=GetPageRecord('*','domesticFlightsMarkupMaster','   name="'.$name.'"'); 

$hotelhave=mysqli_fetch_array($rs7);

 
$namevalue ='name="'.$name.'",agentTypeGroupId="'.decode($typeid).'",status="'.$status.'",addBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';  

addlistinggetlastid('domesticFlightsMarkupMaster',$namevalue); 

 

 

} 

?>

<script>

parent.redirectpage('display.html?ga=domesticflightsmarkup&save=1&typeid=<?php echo $_REQUEST['typeid'];?>');

</script>



<?php

exit();

}




if($_POST['action']=='addblockflights' && $_POST['name']!=""){ 

 

$name=trim(addslashes($_POST['name']));   

$editid=trim(addslashes($_POST['editid'])); 

$status=trim(addslashes($_POST['status']));  

$typeid=trim(addslashes($_POST['typeid'])); 



  

if($editid!=''){ 

$namevalue ='name="'.$name.'",status="'.$status.'",editBy="'.$_SESSION['userid'].'",editDate="'.date('Y-m-d H:i:s').'"';  
$where='  id="'.decode($_REQUEST['editid']).'"'; 
updatelisting('blockFlightMaster',$namevalue,$where);  
} else {  

$namevalue ='name="'.$name.'",status="'.$status.'",agentTypeGroupId="'.decode($typeid).'",addBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';  

addlistinggetlastid('blockFlightMaster',$namevalue);  
} 

?>

<script>

parent.redirectpage('display.html?ga=blockflights&save=1&typeid=<?php echo $typeid; ?>');

</script>



<?php

exit();

}



if($_POST['action']=='addfaretype' && $_POST['flightName']!=""){

 

$displayType=trim(addslashes($_POST['displayType']));   

$displayColor=trim(addslashes($_POST['displayColor']));   

$flightName=trim(addslashes($_POST['flightName']));   

$fareTypeName=trim(addslashes($_POST['fareTypeName']));   

$description=addslashes($_POST['description']); 

$cancellationPolicy=addslashes($_POST['cancellationPolicy']); 

$b2cDescription=addslashes($_POST['b2cDescription']); 

$b2cCancellationPolicy=addslashes($_POST['b2cCancellationPolicy']); 

 $editid=$_POST['editid'];
 

if($editid!=''){



$namevalue ='flightName="'.$flightName.'",fareTypeName="'.$fareTypeName.'",description="'.$description.'",b2cDescription="'.$b2cDescription.'",b2cCancellationPolicy="'.$b2cCancellationPolicy.'",cancellationPolicy="'.$cancellationPolicy.'",displayType="'.$displayType.'",displayColor="'.$displayColor.'",editBy="'.$_SESSION['userid'].'",editDate="'.date('Y-m-d H:i:s').'"'; 



$where='   id="'.decode($_REQUEST['editid']).'"';

updatelisting('fareTypeMaster',$namevalue,$where); 

 
} else {  
$rs7=GetPageRecord('*','fareTypeMaster','  flightName="'.$flightName.'" and fareTypeName="'.$fareTypeName.'"'); 

$hotelhave=mysqli_fetch_array($rs7);

 

if($hotelhave['id']!=''){

?>

<script>

alert('This Manual Flight already exists.');

</script>

<?php

exit();

}

 

$namevalue ='flightName="'.$flightName.'",fareTypeName="'.$fareTypeName.'",description="'.$description.'",b2cDescription="'.$b2cDescription.'",b2cCancellationPolicy="'.$b2cCancellationPolicy.'",cancellationPolicy="'.$cancellationPolicy.'",displayType="'.$displayType.'",parentId="'.$LoginUserDetails['parentId'].'",displayColor="'.$displayColor.'",addBy="'.$_SESSION['userid'].'",editDate="'.date('Y-m-d H:i:s').'"';  

addlistinggetlastid('fareTypeMaster',$namevalue); 

 
 

} 

?>

<script>

parent.redirectpage('display.html?ga=faretype&save=1');

</script>



<?php

exit();

}





if($_POST['action']=='flightapisetting'){
 

$namevalue ='kafilaAPIOneWay="'.$_REQUEST['kafilaAPIOneWay'].'",kafilaAPIRoundTrip="'.$_REQUEST['kafilaAPIRoundTrip'].'",tboAPIOneWay="'.$_REQUEST['tboAPIOneWay'].'",tboAPIRoundTrip="'.$_REQUEST['tboAPIRoundTrip'].'",fixedGF="'.$_REQUEST['fixedGF'].'",fixedAK="'.$_REQUEST['fixedAK'].'",kafilaApiMarkup="'.$_REQUEST['kafilaApiMarkup'].'",tboApiMarkup="'.$_REQUEST['tboApiMarkup'].'",tripjackApiMarkup="'.$_REQUEST['tripjackApiMarkup'].'",airiqApiMarkup="'.$_REQUEST['airiqApiMarkup'].'"  '; 

$where='id=1';   

updatelisting('sys_userMaster',$namevalue,$where); 

?>

<script>

alert('Fligt API Setting Changed!');

parent.$('#loadingwhite').hide();

</script>

<?php

}






if($_POST['action']=='saveFlightName' && $_POST['name']!=""){ 
$name=addslashes($_POST['name']);  
$oldcompanyLogo=addslashes($_POST['oldcompanyLogo']); 
$editid=trim(addslashes($_POST['editid']));  


if($_FILES["companyLogo"]["tmp_name"]!=""){   
$rt=mt_rand().strtotime(date("YMDHis"));  
$companyLogoFileName=basename($_FILES['companyLogo']['name']);  
$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION);   
$companyLogo=time().$rt.'.'.$companyLogoFileExtension;  
move_uploaded_file($_FILES["companyLogo"]["tmp_name"], "upload/{$companyLogo}");  
}



if($companyLogo==''){ 

$companyLogo=$oldcompanyLogo;  
} 

if($_POST['editid']!=''){ 

$namevalue ='name="'.$name.'",parentId="'.$LoginUserDetails['parentId'].'",details="'.$companyLogo.'",status=1,editBy="'.$_SESSION['userid'].'",editDate="'.date('Y-m-d H:i:s').'"';   
$where='   id="'.decode($_REQUEST['editid']).'"'; 
updatelisting('sys_flightName',$namevalue,$where);   
}else{ 
$namevalue ='name="'.$name.'",details="'.$companyLogo.'",status=1,editBy="'.$_SESSION['userid'].'",editDate="'.date('Y-m-d H:i:s').'"';   
addlistinggetlastid('sys_flightName',$namevalue);   
} 
?> 
<script> 
parent.redirectpage('display.html?ga=flightsname&save=1'); 
</script>
 

<?php

exit();

}




if($_POST['action']=='adddomestichotelsmarkup' && $_POST['name']!=""){  
$name=trim(addslashes($_POST['name']));
$editid=trim(addslashes($_POST['editid']));  
$status=trim(addslashes($_POST['status']));  
$groupId=trim(addslashes($_POST['groupId']));  

if($editid!=''){ 
$namevalue ='name="'.$name.'",status="'.$status.'",groupId="'.$groupId.'",editBy="'.$_SESSION['userid'].'",editDate="'.date('Y-m-d H:i:s').'"';  
$where='  id="'.decode($_REQUEST['editid']).'"'; 
updatelisting('domesticHotelMarkupMaster',$namevalue,$where);  
} else { 
  
$rs7=GetPageRecord('*','domesticHotelMarkupMaster','  name="'.$name.'" and groupId="'.$groupId.'"');  
$hotelhave=mysqli_fetch_array($rs7);
 
if($hotelhave['id']!=''){ 
?> 
<script> 
alert('This is already exists.'); 
</script> 
<?php exit(); }

$namevalue ='name="'.$name.'",status="'.$status.'",groupId="'.$groupId.'",addBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';   
addlistinggetlastid('domesticHotelMarkupMaster',$namevalue);  
} 
?> 
<script> 
parent.redirectpage('display.html?ga=domestichotelsmarkup&save=1'); 
</script> 
<?php exit(); } 



if($_POST['action']=='addfaretypedomesticHotelMarkup' && $_POST['markupValue']!=''){  
$name=addslashes(trim($_POST['name'])); 
$markupType=addslashes(trim($_POST['markupType']));  
$markupValue=addslashes(trim($_POST['markupValue'])); 
$hotelId=decode($_POST['hotelId']); 
$editid=trim(addslashes($_POST['editid']));  

if($editid!=''){  
$namevalue ='hotelId="'.$hotelId.'",name="'.$name.'",markupType="'.$markupType.'",markupValue="'.$markupValue.'",editBy="'.$_SESSION['userid'].'",editDate="'.date('Y-m-d H:i:s').'"';   
$where=' id="'.decode($_REQUEST['editid']).'" and  hotelId="'.$hotelId.'"'; 
updatelisting('fareTypedomesticHotelMarkupMaster',$namevalue,$where);   
} else {   
$namevalue ='hotelId="'.$hotelId.'",name="'.$name.'",markupType="'.$markupType.'",markupValue="'.$markupValue.'",parentId="'.$LoginUserDetails['parentId'].'",addBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';   
addlistinggetlastid('fareTypedomesticHotelMarkupMaster',$namevalue);   

$rs6=GetPageRecord('*','sys_userMaster',' userType="agent" limit 0,1');  
while($agentcate=mysqli_fetch_array($rs6)){ 

$namevalue ='agentId="'.$agentcate['id'].'",hotelId="'.$hotelId.'",name="'.$name.'",markupType="'.$markupType.'",markupValue="'.$markupValue.'",parentId="'.$LoginUserDetails['parentId'].'",addBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';addlistinggetlastid('agent_fareTypedomesticHotelsMarkupMaster',$namevalue);   
} 
}  
?>

<script> 
alert('Saved Successfully!'); 
parent.$('#name').val('');  
parent.$('#markupValue').val('');  
parent.$('#editid').val(''); 
parent.loadcrusecost(); 
</script> 

<?php exit(); } 




if($_POST['action']=='addvisacountryterms' && $_REQUEST['country_id']!=''){

$countryId=addslashes($_POST['country_id']);

$terms=addslashes($_POST['terms']);

$status=addslashes($_POST['status']);

$editid=addslashes($_POST['editid']);




if($_FILES["image"]["tmp_name"]!=""){ 
$rt=mt_rand().strtotime(date("YMDHis")); 
$companyLogoFileName=basename($_FILES['image']['name']); 
$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION); 
$profilePhoto=time().$rt.'.'.$companyLogoFileExtension;  
move_uploaded_file($_FILES["image"]["tmp_name"], "upload/{$profilePhoto}"); 
} else { 
$profilePhoto=$_REQUEST['oldimage']; 
}





if($editid!=''){ 
//-------EDIT----------- 

$namevalue ='country_id="'.$countryId.'",terms="'.$terms.'",status="'.$status.'",image="'.$profilePhoto.'",addedBy="'.$_SESSION['userid'].'", dateAdded="'.date('Y-m-d H:i:s').'" ';  
$where='id="'.decode($editid).'"';    
updatelisting('visa_country',$namevalue,$where);  

} else {   
//-------ADD----------- 

$namevalue ='country_id="'.$countryId.'",terms="'.$terms.'",status="'.$status.'",image="'.$profilePhoto.'",addedBy="'.$_SESSION['userid'].'", dateAdded="'.date('Y-m-d H:i:s').'" ';  
$lastid=addlistinggetlastid('visa_country',$namevalue);  
}


?>

<script> 
parent.redirectpage('display.html?ga=visacountryterms&save=1'); 
</script> 



<?php

exit();

}

if($_POST['action']=='addvisatypemaster' && $_REQUEST['name']!=''){

$country_id=addslashes($_POST['country_id']);

$name=addslashes($_POST['name']);

$status=addslashes($_POST['status']);

$editid=addslashes($_POST['editid']);


if($editid!=''){

//-------EDIT-----------


$namevalue ='country_id="'.$country_id.'",name="'.$name.'",status="'.$status.'",addedBy="'.$_SESSION['userid'].'", dateAdded="'.date('Y-m-d H:i:s').'" '; 

$where='id="'.decode($editid).'"';   

updatelisting('VisaTypeMaster',$namevalue,$where); 


} else { 


//-------ADD----------- 

$namevalue ='country_id="'.$country_id.'",name="'.$name.'",status="'.$status.'",addedBy="'.$_SESSION['userid'].'", dateAdded="'.date('Y-m-d H:i:s').'" '; 

$lastid=addlistinggetlastid('VisaTypeMaster',$namevalue);   

}


?>
 

<script> 
parent.redirectpage('display.html?ga=visatype&save=1'); 
</script> 





<?php

exit();

}


if($_POST['action']=='addvisasubscription' && $_REQUEST['country_id']!=''){

$country_id=addslashes($_POST['country_id']);

$visa_type_id=addslashes($_POST['visa_type_id']);

$entry=addslashes($_POST['entry']);

$duration=addslashes($_POST['duration']);

$details=addslashes($_POST['details']);

$price=addslashes($_POST['price']);

$b2bMarkup=addslashes($_POST['b2bMarkup']);

$b2cMarkup=addslashes($_POST['b2cMarkup']);

$status=addslashes($_POST['status']);

$editid=addslashes($_POST['editid']);


if($editid!=''){

//-------EDIT-----------

$namevalue ='b2bMarkup="'.$b2bMarkup.'",b2cMarkup="'.$b2cMarkup.'",country_id="'.$country_id.'",visa_type_id="'.$visa_type_id.'",entry="'.$entry.'",duration="'.$duration.'",details="'.$details.'",price="'.$price.'",status="'.$status.'",addedBy="'.$_SESSION['userid'].'", dateAdded="'.date('Y-m-d H:i:s').'" '; 

$where='id="'.decode($editid).'"';   

updatelisting('visaSubscriptionMaster',$namevalue,$where); 

} else { 

//-------ADD----------- 

$namevalue ='b2bMarkup="'.$b2bMarkup.'",b2cMarkup="'.$b2cMarkup.'",country_id="'.$country_id.'",visa_type_id="'.$visa_type_id.'",entry="'.$entry.'",duration="'.$duration.'",details="'.$details.'",price="'.$price.'",status="'.$status.'",addedBy="'.$_SESSION['userid'].'", dateAdded="'.date('Y-m-d H:i:s').'" '; 

$lastid=addlistinggetlastid('visaSubscriptionMaster',$namevalue);   

}

?>

<script> 
parent.redirectpage('display.html?ga=visasubscription&save=1'); 
</script> 

 

<?php

exit();

}





if($_POST['action']=='addNewTransaction' && $_POST['agentId']!=''){



$amount=trim(addslashes($_POST['amount']));   

$paymentType=trim(addslashes($_POST['paymentType']));  

$paymentMethod=trim(addslashes($_POST['paymentMethod']));  

$transactionId=trim(addslashes($_POST['transactionId']));  

$remark=trim(addslashes($_POST['remark']));   





$a=GetPageRecord('*','sys_userMaster',' id="'.decode($_POST['agentId']).'"  '); 

$getparentid=mysqli_fetch_array($a);



//credit check limit



 



if($_FILES["companyLogo"]["tmp_name"]!=""){   

$rt=mt_rand().strtotime(date("YMDHis")); 

$companyLogoFileName=basename($_FILES['companyLogo']['name']);   

$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION);  

$companyLogo=time().$rt.'.'.$companyLogoFileExtension;  

move_uploaded_file($_FILES["companyLogo"]["tmp_name"], "upload/{$companyLogo}"); 

}



  

$agentId=decode($_POST['agentId']);



 



$namevalue ='agentId="'.$agentId.'",amount="'.$amount.'",paymentType="'.$paymentType.'",paymentMethod="'.$paymentMethod.'",transactionId="'.$transactionId.'",remarks="'.$remark.'",attachment="'.$companyLogo.'",addedBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';  

addlistinggetlastid('sys_balanceSheet',$namevalue); 



if($getparentid['parentId']>0){

if($paymentType=='Credit'){

$paymentType='Debit';

}



if($paymentType=='Debit'){

$paymentType='Credit';

}


 



}

 

?>

<script>

parent.redirectpage('display.html?ga=agents&id=<?php echo $_POST['agentId']; ?>&view=1&save=1');

</script>



<?php

exit();

}

?>

<script> 
   parent.$('#savingbutton').prop("disabled", false);
   parent.$('#savingphtobutton').val('Upload Photo'); 
   parent.$('#savingbutton').prop("disabled", false);
   parent.$('#savingphtobutton').prop("disabled", false);
   parent.$('#savingbutton').val("Save");
</script>

