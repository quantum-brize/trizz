<?php
ob_start();
include "config/database.php"; 
include "config/function.php"; 
include "config/setting.php"; 
include "baseurl.php"; 

 
define("_USER_MASTER_", "sys_userMaster");  
error_reporting(0); 


if($_REQUEST['nighttheme']==2 || $_REQUEST['nighttheme']==1){
$namevalue ='theme="'.trim($_REQUEST['nighttheme']).'"';  
$where='id="'.$_SESSION['userid'].'"';   
updatelisting('sys_userMaster',$namevalue,$where);  
}

   
$select=''; 
$where=''; 
$rs='';  
$select='*'; 
$where='id="'.$_SESSION['userid'].'" and email="'.$_SESSION['username'].'"'; 
$rs=GetPageRecord($select,'sys_userMaster',$where); 
$LoginUserDetails=mysqli_fetch_array($rs);


 
$rs=GetPageRecord('*','sys_userMaster','id=1'); 
$getapistatus=mysqli_fetch_array($rs);

  
$rs=GetPageRecord('*','userLogs','userId="'.$_SESSION['userid'].'" order by id desc'); 
$LoginUserlog=mysqli_fetch_array($rs);



if($LoginUserDetails['id']=='1' || $LoginUserDetails['parentId']=='1'){
$namevalue ='cLogin="'.date('Y-m-d H:i:s').'"';  
$where='id="'.$LoginUserDetails['id'].'"';   
updatelisting('sys_userMaster',$namevalue,$where); 
}


function checkemail($email){
if (strpos($email, '@') !== false) {
 return $email;
} else {
return '<span class="lightgraytext">Not Provided</span>';
}
}

function checkmobile($mobile){
$numlength = strlen((string)$mobile); 
if ($numlength>9) {
 return $mobile;
} else {
return '<span class="lightgraytext">Not Provided</span>';
}
}


function showhotelcategory($star){
$totalstar='';
for ($k = 0 ; $k < $star; $k++){
$totalstar.='<i class="dripicons-star"></i>';
}
return $totalstar; 
}  

function getamenities($id){ 
$a=GetPageRecord('*','amenitiesMaster','id="'.$id.'"'); 
$hoteldetails=mysqli_fetch_array($a); 
return $hoteldetails['name']; 
}  



function starcategory($cat){
for ($x = 0; $x <= ($cat-1); $x++) {
  echo "<i class='fa fa-star' aria-hidden='true'></i>";
}
}



 
 
 

function getUserNameNew($id){
$a=GetPageRecord('firstName','sys_userMaster','id="'.$id.'"'); 
$displayData=mysqli_fetch_array($a);
return $displayData['firstName'];
}



function displaydateinnumber($date){
if($date!='1970-01-0' && $date!='' && $date!='0000-00-00' && $date!='1970-01-01'){
return date('d/m/Y',strtotime($date));
}
}

function displaydateinword($date){
if($date!='1970-01-0' && $date!='' && $date!='0000-00-00 00:00:00' && $date!='1970-01-01'){
return date('j M Y',strtotime($date));
}
}


function displaydateinwordshort($date){
if($date!='1970-01-0' && $date!='' && $date!='0000-00-00 00:00:00' && $date!='1970-01-01'){
return date('j M Y',strtotime($date));
}
}

function displaydateindatetme($date){
if($date!='1970-01-0' && $date!='' && $date!='1970-01-01'){
return date('d/m/Y - h:i A',strtotime($date));
}
}


function daysbydates($startdate,$enddate){
$start = strtotime($startdate);
$end = strtotime($enddate); 
return ceil(abs($end - $start) / 86400);
}



$k=GetPageRecord('*','currencyMaster','defaultThis=1'); 
$curr=mysqli_fetch_array($k);


include "language/".$LoginUserDetails['systemLanguage'].".php"; 


function cleanstring($string) {

   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
      $string = str_replace('----', '-', $string); // Replaces all spaces with hyphens.
   $string = str_replace('---', '-', $string); // Replaces all spaces with hyphens.
   $string = str_replace('--', '-', $string); // Replaces all spaces with hyphens.
   $string = str_replace('-', '-', $string); // Replaces all spaces with hyphens.

   return strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $string)); // Removes special chars.
}




function addbynewbadges($id){ 
$a=GetPageRecord('*','sys_userMaster','id="'.$id.'"'); $profilename=mysqli_fetch_array($a);

if($profilename['firstName']!=''){
return '<table border="0" cellpadding="0" cellspacing="0" class="addbynewbadges">
  <tr>
    <td colspan="2"><div class="listnameicon">'.substr(stripslashes($profilename['firstName']),0,1).'</div></td>
    <td>'.stripslashes($profilename['firstName']).'</td>
  </tr>
  
</table>';
 }
}

function newstatusbadges($status){
if($status==1){ 
return '<span class="badge badge-success">Active</span>';
} else {
return '<span class="badge badge-danger">Inactive</span>'; 
} 
}




function sendautomationmail($queryid,$fullurl){


include "config/mail.php"; 


$rs13=GetPageRecord('*','queryMaster','id="'.$queryid.'"');   
$querydata=mysqli_fetch_array($rs13);

if($querydata['clientId']!=''){

$asclient=GetPageRecord('*','userMaster','id="'.$querydata['clientId'].'"'); 
$clientDetails=mysqli_fetch_array($asclient); 

$ab=GetPageRecord('*','sys_userMaster',' id in (select addedBy from  sys_userMaster where id="'.$_SESSION['userid'].'")');  
$invoiceData=mysqli_fetch_array($ab);


$abd=GetPageRecord('*','automationMaster','  destinationId="'.$querydata['destinationId'].'" and startDate<="'.$querydata['startDate'].'" and endDate>="'.$querydata['startDate'].'" and status=1 and queryStatus="'.$querydata['statusId'].'" order by id desc');  
$automationdata=mysqli_fetch_array($abd);

$ab2=GetPageRecord('*','sys_userMaster',' id="'.$_SESSION['userid'].'"');  
$invoiceData222=mysqli_fetch_array($ab2);


$abc=GetPageRecord('*','sys_packageBuilder',' 1 and id="'.$automationdata['packageId'].'"');  
$packageDataMain=mysqli_fetch_array($abc);

}



if($clientDetails['email']!='' && $clientDetails['firstName']!='' && $packageDataMain['id']!='' && $automationdata['packageId']!=''){

$subject = 'Quotation '.encode($queryid).' '.$clientnameglobal; 
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
                                  <span style="font-family:Arial,sans-serif;color:#1a1a1a;font-size:40px;line-height:38px;font-weight:300;letter-spacing:-1.5px">Hi '.stripslashes($clientDetails['firstName']).',</span>                                <br>
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
                                        <a href="'.$fullurl.'samplepackage/'.encode($packageDataMain['id']).'/'.encode($clientDetails['id']).'/'.($automationdata['id']).'/'.cleanstring(stripslashes($packageDataMain['name'])).'.html" style="display:inline-block;border:1px solid #525a68;border-radius:30px;padding:15px 27px;font-family:Arial,sans-serif;color:#ffffff;font-size:20px;text-decoration:none" target="_blank">
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

$file_name='';
$ccmail='';

send_attachment_mail($fromemail,$clientDetails['email'],$subject,$mailbody,$ccmail.','.$_SESSION['username'],$file_name);



$namevalue2 ='details="'.addslashes($mailbody).'",subject="'.addslashes($subject).'",fromEmail="'.$_SESSION['username'].'",toEmail="'.$clientDetails['email'].'",dateAdded="'.date('Y-m-d H:i:s').'",addedBy="'.$_SESSION['userid'].'",queryId="'.$queryid.'"';
addlistinggetlastid('queryMail',$namevalue2); 

}



}




function showbranchname($id){
$a=GetPageRecord('name,branchId','roleMaster','id="'.$id.'"'); 
$displayData=mysqli_fetch_array($a);

$b=GetPageRecord('name','branchMaster','id="'.$displayData['branchId'].'"'); 
$branch=mysqli_fetch_array($b);


return stripslashes($displayData['name'] .' - '.$branch['name']);
}



function gethotelcategorytype($id){ 
$a=GetPageRecord('*','sys_hotelCategory',' id="'.$id.'"');  
$res=mysqli_fetch_array($a);  
return stripslashes($res['name']); 

}


function getflightlogo($name){

$a=GetPageRecord('*','sys_flightName',' name like "%'.$name.'%"'); 
$res=mysqli_fetch_array($a); 
if($res['details']!=''){
return stripslashes($res['details']);
} else {
return 'noflightlogo.png';
}
}



function getflightdestination($code){ 

if($code!=''){

$a=GetPageRecord('*','flightDestinationMaster',' airportCode="'.trim($code).'"'); 

$res=mysqli_fetch_array($a);  

return stripslashes($res['city']); 

}

}


function sendtickettomail($url,$tid){

include "config/mail.php"; 

$a=GetPageRecord('*','flightBookingMaster',' id="'.decode($tid).'" '); 
$editresult=mysqli_fetch_array($a); 

$a=GetPageRecord('*','sys_userMaster','id=1 ');  
$invoiceData=mysqli_fetch_array($a); 

$subject = 'Booking Status - '.$tid.'';

$rs=GetPageRecord('*','sys_userMaster','id="'.$editresult['agentId'].'"'); 
$LoginParentId=mysqli_fetch_array($rs); 

 //$url.'download_ticket.php?id='.$tid;
//exit();
 $mailbody=file_get_contents($url.'download_ticket.php?id='.$tid.'&mail=1'); 

send_attachment_mail($fromemail,$LoginParentId['email'],$subject,$mailbody,$ccmail,$attfilename);

 
}



function getagentbalance($id){

$totalwalletBalance=0; 
$totalwalletBalanceOffline=0; 
if($id>0){ 
$rs8=GetPageRecord('SUM(amount) as totalcreditAmt','sys_balanceSheet','agentId="'.$id.'" and paymentType="Credit" and offlineAgent=0 ');  
$agentCreditAmt=mysqli_fetch_array($rs8); 

$rs8=GetPageRecord('SUM(amount) as totaldebitAmt','sys_balanceSheet','agentId="'.$id.'" and paymentType="Debit" and offlineAgent=0 ');  
$agentDebitAmt=mysqli_fetch_array($rs8);  

return ($agentCreditAmt['totalcreditAmt']-$agentDebitAmt['totaldebitAmt']);
}
}



function senddesignedmail($fromemail,$email,$subject,$mailbody,$ccmail,$file_name,$fullurl){
include "config/mail.php";

 

$ars=GetPageRecord('invoiceLogo','sys_userMaster','id=1');   
$companyLogoAdmin=mysqli_fetch_array($ars); 


$body='<div style="background-color:#f9f9f9; padding:30px 0px; width:100%;text-align:center;"> 
<div style="width:100%;  font-family:Arial, Helvetica, sans-serif;text-align:center;">

  <table width="600" border="0" align="center" cellpadding="30" cellspacing="0"   style="text-align:left;width:600px;  background-color:#FFFFFF; font-family:Arial, Helvetica, sans-serif;">
  
  <tr>
      <td colspan="3" align="center" bgcolor="#fff" style="background-color:#fff;  font-size:#000; font-size:26px;"><img src="'.$fullurl.'profilepic/'.stripslashes($companyLogoAdmin['invoiceLogo']).'" height="50" /></td>
      </tr>
    <tr>
      <td colspan="3" align="center" bgcolor="#e8f7ff" style="background-color:#e8f7ff;  font-size:#000; font-size:26px;">'.$subject.'</td>
      </tr>
    <tr>
      <td colspan="3" style="font-size:14px;">'.$mailbody.'</td>
    </tr>
  </table>
</div>
</div>';


send_attachment_mail($fromemail,$email,$subject,$body,$ccmail,$file_name); 

}



function SEO($string) {
  $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens. 
  $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
  $string = strtolower($string);
  $string = str_replace(' ','-',$string);
  return $string;
}
?>

 