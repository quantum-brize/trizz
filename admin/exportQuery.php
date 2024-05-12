<?php 
include "inc.php";   
$nc=1;
$body=''; 





if($_REQUEST['startDate']!='' && $_REQUEST['endDate']!='' ){
$startDate=date('d-m-Y',strtotime($_REQUEST['startDate']));
$endDate=date('d-m-Y',strtotime($_REQUEST['endDate']));
} else {
$startDate=date('d-m-Y',strtotime('-30 Days'));
$endDate=date('d-m-Y');
}
 
$totalno='1';
$totalmail='0';
$select='';
$where='';
$rs='';  
$wheremain=''; 

$searchwhere='';
$searchwhereuser='';
$mainwhere=''; 
$noteswhere='';


if($LoginUserDetails['userType']!=0){ 

if($LoginUserDetails['showQueryStatus']==0){
$mainwhere=' and (addedBy="'.$_SESSION['userid'].'" or  assignTo="'.$_SESSION['userid'].'")  '; 
}

if($LoginUserDetails['showQueryStatus']==1){
$mainwhere=' and (statusId=5  or statusId=9) '; 
}

if($LoginUserDetails['showQueryStatus']==2){
$mainwhere=' and 1  '; 
}

if($_REQUEST['statusid']==1){ 
$noteswhere='and id in (select queryId from queryNotes) and statusId=1';
}

if($_REQUEST['statusid']==''){ 
$noteswhere='and id in (select queryId from queryNotes)';
}

} else {
$mainwhere=' and 1 '; 
}



$searchcity='';
if($_REQUEST['searchcity']!=''){
$searchcity=' and  destinationId="'.$_REQUEST['searchcity'].'"';
}


$searchsource='';
if($_REQUEST['searchsource']!=''){
$searchsource=' and  leadSource="'.$_REQUEST['searchsource'].'"';
}


$searchconfirmproposal='';
if($_REQUEST['searchconfirmproposal']==1){
$searchconfirmproposal=' and id in (select queryId from sys_packageBuilder where confirmQuote=1)';
}


$searchusers='';
if($_REQUEST['searchusers']!=''){
$searchusers=' and  assignTo="'.$_REQUEST['searchusers'].'"';
}

$statusid='';
if($_REQUEST['statusid']!=''){
$statusid=' and  statusId="'.$_REQUEST['statusid'].'"';
}

if($_REQUEST['keyword']!=''){
$searchwhereuser=' and (id="'.decode($_REQUEST['keyword']).'" or clientId in (select id from userMaster where firstName like "%'.$_REQUEST['keyword'].'%" or lastName like "%'.$_REQUEST['keyword'].'%"  or mobile like "%'.$_REQUEST['keyword'].'%" or email like "%'.$_REQUEST['keyword'].'%") )';
}

$wheres=' clientId in (select id from userMaster where userType=4 and firstName!="") '.$mainwhere.' '.$searchcity.' '.$searchwhereuser.'  '.$searchusers.' '.$statusid.' '.$noteswhere.' '.$searchsource.' and date(dateAdded)<="'.date('Y-m-d',strtotime($endDate)).'" and  date(dateAdded)>="'.date('Y-m-d',strtotime($startDate)).'" '.$searchconfirmproposal.'  order by id desc'; 

$wheres2=' and clientId in (select id from userMaster where userType=4 and firstName!="") '.$mainwhere.' '.$searchcity.' '.$searchwhereuser.'  '.$searchusers.' '.$statusid.'  '.$searchsource.' and date(dateAdded)<="'.date('Y-m-d',strtotime($endDate)).'" and  date(dateAdded)>="'.date('Y-m-d',strtotime($startDate)).'"   order by id asc'; 


$where2='  clientId in (select id from userMaster where userType=4 and firstName!="") '.$mainwhere.' '.$searchcity.' '.$searchwhereuser.'  '.$searchusers.' '.$statusid.' '.$searchsource.' and date(dateAdded)<="'.date('Y-m-d',strtotime($endDate)).'" and  date(dateAdded)>="'.date('Y-m-d',strtotime($startDate)).'"   order by id desc'; 

$where3='  clientId in (select id from userMaster where userType=4 and firstName!="") '.$mainwhere.' '.$searchcity.' '.$searchwhereuser.'  '.$searchusers.'  '.$searchsource.' and date(dateAdded)<="'.date('Y-m-d',strtotime($endDate)).'" and  date(dateAdded)>="'.date('Y-m-d',strtotime($startDate)).'"   order by id desc'; 
 


$rs22=GetPageRecord('*','queryMaster','  destinationId in (select id from cityMaster where name!="") '.$wheres2.'  '); 
while($restuser=mysqli_fetch_array($rs22)){ 
  
$nc++;

$b=GetPageRecord('*','userMaster','id="'.$restuser['clientId'].'"'); 
$clientData=mysqli_fetch_array($b);
 

$d=GetPageRecord('*','queryServicesMaster',' id="'.$restuser['serviceId'].'" order by name asc');
$servicedata=mysqli_fetch_array($d);


$c=GetPageRecord('*','sys_userMaster',' id="'.$restuser['assignTo'].'" order by firstName asc'); 
$assigndata=mysqli_fetch_array($c);

$e=GetPageRecord('*','querySourceMaster',' id="'.$restuser['leadSource'].'" order by name asc');
$leadsourcedata=mysqli_fetch_array($e); 

 $body.='
  <tr>
    <td>'.encode($restuser['id']).'</td> 
    <td>'.stripslashes($clientData['submitName']).' '.stripslashes($clientData['firstName']).' '.stripslashes($clientData['lastName']).'</td>
    <td>'.stripslashes($clientData['email']).'</td>
    <td>'.stripslashes($clientData['mobile']).'</td> 
    <td>'.getCityName($restuser['destinationId']).'</td>
    <td>'.date('d/m/Y',strtotime($restuser['startDate'])).'</td>
    <td>'.date('d/m/Y',strtotime($restuser['endDate'])).'</td>
    <td>'.stripslashes($restuser['travelMonth']).'</td>
    <td>'.stripslashes($servicedata['name']).'</td> 
    <td>'.stripslashes($restuser['adult']).'</td> 
    <td>'.stripslashes($restuser['child']).'</td> 
    <td>'.stripslashes($restuser['infant']).'</td> 
    <td>'.getstatus($restuser['statusId']).'</td>  
    <td>'.stripslashes($assigndata['firstName']).' '.stripslashes($assigndata['lastName']).'</td> 
    <td>'.stripslashes($leadsourcedata['name']).'</td>  
  </tr>';
  }  
  
   
$data='<table width="100%" border="1" cellspacing="0" cellpadding="5">
  <tr>
  <td><strong>#ID</strong></td>
  <td><strong>Client</strong></td>
  <td><strong>Email</strong></td>
  <td><strong>Mobile</strong></td> 
  <td><strong>Destination</strong></td>
  <td><strong>Start Date </strong></td>
  <td><strong>End Date </strong></td>
  <td><strong>Travel Month</strong></td>
  <td><strong>Service</strong></td>
  <td><strong>Adult</strong></td>
  <td><strong>Child</strong></td>
  <td><strong>Infant</strong></td>
  <td><strong>Status</strong></td>
  <td><strong>Assign To </strong></td>
  <td><strong>Lead Source </strong></td>
  </tr>
'.$body.'
</table>
';

 
$file="Query_Data.xls"; 
 header("Content-type: application/vnd.ms-excel");
 header("Content-Disposition: attachment; filename=$file");
echo $data;
 ?>
