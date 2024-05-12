<?php include "clientinc.php"; 
$pageno=1; 
$result =mysqli_query (db(),"select * from userMaster where id='".$_SESSION['clientId']."' ")  or die(mysqli_error());   
$userinfo=mysqli_fetch_array($result);


$b=GetPageRecord('*','queryMaster','id="'.decode($_REQUEST['id']).'"'); 
$rest=mysqli_fetch_array($b);

$totalpax = $rest['adult']+$rest['child']+$rest['infant'];

$gue=GetPageRecord('*','sys_guests','queryId="'.decode($_REQUEST['id']).'"');  
if(mysqli_num_rows($gue)<1){
for($i=1; $i<=$totalpax; $i++){
$namevalue ='firstName="",queryId="'.decode($_REQUEST['id']).'"';  
addlistinggetlastid('sys_guests',$namevalue);  
}
}
if($_REQUEST['s']==''){ $bg=''; }

if($rest['statusId']!=5 && $rest['statusId']!=6 && $rest['statusId']!=7 && $_REQUEST['s']==''){ $bg='#fca11a'; } 
if($rest['statusId']==6 || $rest['statusId']==7 && $_REQUEST['s']==''){ $bg='#f40000'; } 
if($rest['statusId']==5 && $_REQUEST['s']==''){ $bg='#37c986'; }
 ?>
<!DOCTYPE html>
<html lang="en">
 
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>My Trips - <?php echo $clientnameglobal; ?></title>

<?php include "clientheaderinc.php";  ?>
<style>
.table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td { 
    vertical-align: middle !important;     line-height: 20px !important;
}
.pdfbtn{
padding:10px 20px; outline:0px; border:2px solid #ddd; background-color:#CC3300; color:#FFFFFF !important;
border-radius:7px;
/* Permalink - use to edit and share this gradient: https://colorzilla.com/gradient-editor/#ff3019+0,840202+99 */
background: #ff3019; /* Old browsers */
background: -moz-linear-gradient(top,  #ff3019 0%, #840202 99%); /* FF3.6-15 */
background: -webkit-linear-gradient(top,  #ff3019 0%,#840202 99%); /* Chrome10-25,Safari5.1-6 */
background: linear-gradient(to bottom,  #ff3019 0%,#840202 99%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ff3019', endColorstr='#840202',GradientType=0 ); /* IE6-9 */
}
</style>
</head>
<body>
<div class="bodyboxbg"></div>
<div class="careerfy-wrapper">

<?php include "clientheader.php";  ?>


 


<div class="careerfy-main-content">

<div class="careerfy-main-section careerfy-dashboard-fulltwo">
<div class="container">
<div class="row">

<?php include "clientleft.php";  ?>



<div class="careerfy-column-9">
<div class="careerfy-typo-wrap"> 
<div class="careerfy-employer-box-section" >

<div class="careerfy-profile-title"><h2>TRIP  - ID: <?php echo encode($rest['id']); ?></h2><!--<a href="#" class="careerfy-employer-profile-submit" style="float: right; cursor:default; padding: 5px; background-color:<?php echo $bg; ?>; border:1px solid <?php echo $bg; ?>"> <span style="font-size:12px; font-weight:600;"><?php if($rest['statusId']!=5 && $rest['statusId']!=6 && $rest['statusId']!=7){ echo 'In Process'; } if($rest['statusId']==6 || $rest['statusId']==7){ echo 'Cancelled'; } if($rest['statusId']==5 && $rest['endDate']<date('Y-m-d')){ echo 'Completed'; } if($rest['statusId']==5 && $rest['endDate']>date('Y-m-d')){ echo 'On Going'; } ?></span></a>--></div>


 
<ul class="careerfy-row careerfy-employer-profile-form">

 

 


<li class="careerfy-column-6">
<label>FROM CITY</label>
<?php echo $rest['fromCity']; ?>
</li>
<li class="careerfy-column-6">
<label>DESTINATION</label>
<?php
$string = '';
$string = preg_replace('/\.$/', '', $rest['destinationId']);  
$array = explode(',', $string); 
foreach($array as $value)  
{  echo  getCityName($value); } ?>
</li>
<li class="careerfy-column-6">
<label>FROM DATE</label>
<?php if(date('d-m-Y',strtotime($rest['startDate']))!='01-01-1970'){ echo date('d-m-Y',strtotime($rest['startDate'])); } ?>
</li>  

<li class="careerfy-column-6">
<label>TO DATE</label>
<?php if(date('d-m-Y',strtotime($rest['endDate']))!='01-01-1970'){ echo date('d-m-Y',strtotime($rest['endDate'])); } ?>
</li>
 
 <li class="careerfy-column-6">
<label>ADULT(S)</label>
<?php echo $rest['adult']; ?>
</li>

<li class="careerfy-column-6">
<label>CHILD(S)</label>
<?php echo $rest['child']; ?>
</li>

<li class="careerfy-column-6">
<label>INFANT(S)</label>
<?php echo $rest['infant']; ?>
</li>
<li class="careerfy-column-6">
<label>CREATED</label>
<?php echo date('d/m/Y h:i A',strtotime($rest['dateAdded'])); ?>
</li>

</ul>
</div>
 
  
 <?php 
$bx=GetPageRecord('*','sys_packageBuilder',' queryId="'.$rest['id'].'"'); 
if(mysqli_num_rows($bx)>0){
?>
 
  <div class="careerfy-employer-box-section" >
<div class="careerfy-profile-title"><h2>PROPOSAL
</h2>  </div>


<table width="46%" class="table table-hover mb-0">

<thead>
</thead>
<tbody>
<?php  
while($packagedata=mysqli_fetch_array($bx)){



$toatlminisval=0;
$totalcgstval=0;
$totaligstval=0;
$totalgrossgrosstcs=0; 

if($packagedata['showcgst']==0 || $packagedata['showsgst']==0 || $packagedata['showigst']==0 || $packagedata['showtcs']==0){
 
$gst='';
if($packagedata['showcgst']==0){ 
$totalcgstval=$packagedata['totalcgst'];
}

if($packagedata['showsgst']==0){   
$totalsgstval=$packagedata['totalsgst'];
}

if($packagedata['showigst']==0){  
$totaligstval=$packagedata['totaligst'];
}

if($packagedata['showtcs']==0){  
$totalgrossgrosstcs=$packagedata['grosstcs'];
}


$toatlminisval=$totalcgstval+$totalsgstval+$totaligstval+$totalgrossgrosstcs;
}
 ?>
<tr style="background-color: #e7fff8;">
<td width="2%" align="left"><div style="width: 150px; height: 100px; overflow: hidden; border: 0px solid #b1b1b1; padding: 1px; box-shadow: 2px 2px 5px #00000042;">
<div align="left"><a target="_blank" href="<?php echo $proposalurl; ?>sharepackage/<?php echo encode($packagedata['id']); ?>/thulhagiri-4n5d-package-early-bird-offer.html"><img src="<?php echo $softwareurl; ?>package_image/<?php echo $packagedata['coverPhoto']; ?>" style="width:100%; height:auto; min-height:100%;"></a></div>
</div>  </td>
<td align="left" valign="middle"><div align="left"><a target="_blank" href="<?php echo $proposalurl; ?>sharepackage/<?php echo encode($packagedata['id']); ?>/thulhagiri-4n5d-package-early-bird-offer.html" style="color: #000; font-weight: 600;"><?php echo stripslashes($packagedata['name']); ?></a></div>  <div style="color:#999999; font-size:11px; margin-top:2px;">
<div align="left"><a target="_blank" href="<?php echo $proposalurl; ?>sharepackage/<?php echo encode($packagedata['id']); ?>/thulhagiri-4n5d-package-early-bird-offer.html" style="color: #000; font-weight: 600;">ID: <?php echo encode($packagedata['id']); ?> -   <?php echo stripslashes($packagedata['destinations']); ?> &nbsp;|&nbsp; <?php echo stripslashes($packagedata['adult']); ?> Adult(s) - <?php echo stripslashes($packagedata['child']); ?> Child(s)</a></div>
</div> <div style=" font-weight:600; font-size:11px; color:#999999;">
<div align="left">Created: <?php echo displaydateinnumber($packagedata['dateAdded']); ?></div>
</div></td>
<td align="left" valign="middle"><div align="center" style="color:#000000;"><strong>₹<?php echo number_format($packagedata['grossPrice']-$toatlminisval); ?> </strong></div></td>
</tr>
<?php } ?>
</tbody>
</table>
</div>

<?php } ?>




<?php
$totalno=1;
$rsa=GetPageRecord('*','sys_invoiceMaster',' queryId="'.decode($_REQUEST['id']).'" and packageId in (select id from sys_packageBuilder where queryId="'.decode($_REQUEST['id']).'" and confirmQuote=1)  order by id desc');
$invoiceData=mysqli_fetch_array($rsa);
?>
<div id="invoiceBody" style="display:none;" class='html-content'> 
<?php echo file_get_contents($softwareurl.'printInvoice.php?id='.encode($invoiceData['id']).'&queryId='.encode($invoiceData['queryId']).'&packageId='.encode($invoiceData['packageId'])); ?> 
</div>



 

 



 <?php  $rs=GetPageRecord('*','sys_guests',' queryId="'.decode($_REQUEST['id']).'" and queryId in (select id from queryMaster where statusId=5) order by id desc');
 if(mysqli_num_rows($rs)>0){
   ?>
 
  <div class="careerfy-employer-box-section" >
<div class="careerfy-profile-title">
  <h2>UPLOAD DOCUMENTS </h2>  
</div>


<table border="0" cellpadding="10" cellspacing="0" style="color:#000000;">
<thead>
<tr>
  <th align="left">Sr. No. </th>
<th align="left">First Name</th>
<th align="left">Last Name</th>
<th align="left">Gender</th>
<th align="left">Date of Birth </th>
<th align="center">Upload Documents Below&nbsp;<i class="fa fa-arrow-down" aria-hidden="true"></i></th>
<th align="center">Edit Details</th>
</tr>
</thead>
<tbody>
<?php 
$n=0;
while($rest=mysqli_fetch_array($rs)){ 
?>
<tr>
  <td align="left"><?php echo ++$n; ?>.</td>
<td align="left"><?php echo stripslashes($rest['submitName']); ?> <?php echo stripslashes($rest['firstName']); ?></td>
<td align="left"><?php echo stripslashes($rest['lastName']); ?></td>
<td align="left"><span style="text-transform:uppercase;"><?php echo stripslashes($rest['gender']); ?></span></td>
<td align="left"><?php if($rest['dob']!=''){ echo date('d-m-Y', strtotime($rest['dob'])); } ?></td>
<td align="center"><a href="javascript:;" class=" " onClick="uploadguestdocument('<?php echo encode($rest['id']); ?>');$('#uploaddoc').show();" >Upload</a></td>
<td align="center"><a href="javascript:;" class="" onClick="editguest('<?php echo encode($rest['id']); ?>');$('#editguest').show();" >Edit</a></td>
</tr>
<?php } ?>
</tbody>
</table>
</div> 

<?php } ?>

 


<div class="careerfy-employer-box-section" id="uploaddoc" style="display:none; position:fixed; top:0px; left:0px; right:0px; bottom:0px; margin:auto; z-index:99; max-width:800px;height: fit-content;" >
<div class="careerfy-profile-title" style="text-align:center;">
  <h2 style="float:none; position:relative;">DOCUMENT UPLOADS</h2>  
  <i class="fa fa-times" aria-hidden="true" style="float: right; color: #b2adad; font-size: 20px; position: absolute; top: 10px; right: 10px;" onClick="$('#uploaddoc').hide();"></i>
</div>
<div id="loaddocuments"></div>
 
</div>

<div class="careerfy-employer-box-section" id="editguest" style="display:none; position:fixed; top:0px; left:0px; right:0px; bottom:0px; margin:auto; z-index:99; max-width:540px;height: fit-content;" >
<div class="careerfy-profile-title">
  <h2>EDIT GUEST DETAILS</h2>  
  <i class="fa fa-times" aria-hidden="true" style="float:right; color:#b2adad; font-size: 20px;" onClick="$('#editguest').hide();"></i>
</div>
<div id="loadguest"></div>
 
</div>

</div>
</div>
</div>
</div>
</div>

</div>


 

</div>
 <div id="deletedoc" style="display:none;"></div>
<?php include "clientfooterinc.php";  ?>

</body>
 
</html>
<script>
function editguest(id){
$('#loadguest').html('');
$('#loadguest').load('clienteditguest.php?id='+id+'&qd=<?php echo $_REQUEST['id']; ?>');
}

function uploadguestdocument(id){
$('#loaddocuments').html('');
$('#loaddocuments').load('clienteditguestdocument.php?id='+id+'&qd=<?php echo $_REQUEST['id']; ?>');
}

function deleteDoc(id,guestId){
if(confirm('Are you sure want to delete?')){
$('#deletedoc').load('clientaction.php?action=deletedoc&id='+id+'&qd=<?php echo $_REQUEST['id']; ?>&guestId='+guestId);
}
}

loadmessage();
</script>