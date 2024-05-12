<?php include "clientinc.php"; 
$pageno=2; 
$result =mysqli_query (db(),"select * from userMaster where id='".$_SESSION['clientId']."' ")  or die(mysqli_error());   
$userinfo=mysqli_fetch_array($result);


$rs13=GetPageRecord('*','sys_packageBuilder','queryId in (select id from queryMaster where clientId="'.$_SESSION['clientId'].'") and confirmQuote=1');   
$packagedatadetials=mysqli_fetch_array($rs13);



 ?>

<!DOCTYPE html>
<html lang="en">
 
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>My Trips - <?php echo $clientnameglobal; ?></title>

<?php include "clientheaderinc.php";  ?>

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
<div class="careerfy-employer-dasboard">
<div class="careerfy-employer-box-section">

<div class="careerfy-profile-title">
<h2>PAYMENT HISTORY</h2>
 
</div>

<div class="careerfy-managejobs-list-wrap">
<div class=" ">
<div class="careerfy-job-alerts">
<table border="0" cellpadding="10" cellspacing="0">
<thead>
<tr>
<th align="left"><div align="left">TRANS. ID</div></th>
<th align="left">TYPE</th>
<th align="left"><div align="left">AMOUNT</div></th>
<th align="left"><div align="left"> Date</div></th>
</tr>
</thead>
<tbody>
<?php
$nos=1;
$rs=GetPageRecord('*','sys_PackagePayment',' queryId="'.$packagedatadetials['queryId'].'" and packageId="'.$packagedatadetials['id'].'" and paymentStatus=1 order by paymentDate asc');
while($paymentlist=mysqli_fetch_array($rs)){ 
 ?>
<tr>
<td align="left">
  <div align="left"><?php if($paymentlist['paymentId']!=''){  echo ($paymentlist['paymentId']); } else { echo '-'; }  ?></div></td>
<td align="left"><?php if($paymentlist['paymentId']!=''){  ?>

<span class="badge badge-boxed  badge-soft-success" style=" background-color: #868686!important; color:#fff; font-size: 11px; padding: 5px 6px;"><?php echo ($paymentlist['transectionType']); ?></span>
 <?php } ?></td>
<td align="left"><div align="left">₹<?php echo ($paymentlist['amount']); $totalpendingamountcount+=$paymentlist['amount']; ?></div></td>
<td align="left"><div align="left"><?php if($paymentlist['paymentStatus']==1){ echo date('d/m/Y',strtotime($paymentlist['paymentDate'])); } else { echo date('d/m/Y',strtotime($paymentlist['paymentDate']));  } ?></div></td>
</tr>
<?php $nos++; } ?>
</tbody>
</table>


<?php if($nos==1){ ?>
<div style="text-align:center; padding:20px; text-align:center;">No Payment</div>
<?php } ?>
</div>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

</div>


 

</div>
 
<?php include "clientfooterinc.php";  ?>

</body>
 
</html>
