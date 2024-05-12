<?php include "clientinc.php";
$pageno=1; 
$result =mysqli_query (db(),"select * from userMaster where id='".$_SESSION['clientId']."' ")  or die(mysqli_error());   
$userinfo=mysqli_fetch_array($result);

$greet='';
$Hour = date('G');

if ( $Hour >= 5 && $Hour <= 11 ) {
    $greet= "Good Morning";
} else if ( $Hour >= 12 && $Hour <= 18 ) {
    $greet= "Good Afternoon";
} else if ( $Hour >= 19 || $Hour <= 4 ) {
    $greet= "Good Evening";
}



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
.getno{margin-top: 3px;
    font-size: 12px;
    border: 1px solid #ccc;
    width: fit-content;
    margin: auto;
    padding: 0px 5px;
    border-radius: 4px;
    line-height: 2;
    background-color: #958e8e;
    color: #fff;
    cursor: pointer;}
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

<style>
.priceblkbox{font-size: 12px;
    padding: 5px;
    background-color: #000000a6;
    position: absolute;
    right: 10px;
    bottom: 10px;
    padding: 5px 10px;
    font-size: 14px;
    color: #fff;
    border-radius: 4px;
    font-weight: 600;}
</style>





<div class="careerfy-column-9">
<div class="careerfy-typo-wrap">
<div class="careerfy-employer-dasboard" style="margin-bottom:0px;">
<div class="careerfy-employer-box-section" style="margin-bottom:30px;">
 
<div class="alert alert-success" role="alert" style="text-align: center; font-size: 20px; font-family: serif; background-color: #3d7297; color:#fff;">
   <?php echo $greet; ?> 
</div>



<div class="careerfy-profile-title" style="margin-bottom:0px;">
<h2>MY TRIPS</h2> 
</div>
 
<div class="careerfy-managejobs-list-wrap">
<div class="careerfy-managejobs-list">

<div class="careerfy-table-layer careerfy-managejobs-thead">
<div class="careerfy-table-row">
<div class="careerfy-table-cell">Description</div>
<div class="careerfy-table-cell">Created</div> 
<div class="careerfy-table-cell">Status</div> 
<div class="careerfy-table-cell">Spoc&nbsp;Name</div> 
<div class="careerfy-table-cell">Contact</div>
</div>
</div>


<?php
$nos=1; 
$b=GetPageRecord('*','queryMaster','clientId="'.$_SESSION['clientId'].'" order by id desc'); 
while($rest=mysqli_fetch_array($b)){

 
$bp=GetPageRecord('*','sys_packageBuilder','queryId="'.$rest['id'].'" order by id desc'); 
$restpack=mysqli_fetch_array($bp); 
   
$a=GetPageRecord('*','sys_PackagePayment','queryId="'.$rest['id'].'" and packageId in (select id from sys_packageBuilder where confirmQuote=1 and queryId="'.$rest['id'].'") and paymentStatus=1 order by id desc'); 
$paymentlist=mysqli_fetch_array($a);
 ?>
<div class="careerfy-table-layer careerfy-managejobs-tbody">
<div class="careerfy-table-row">
<div class="careerfy-table-cell">
<a href="my-trip-details.html?id=<?php echo encode($rest['id']); ?>"> <h6><?php echo $rest['fromCity']; ?> to <?php
												$string = '';
										$string = preg_replace('/\.$/', '', $rest['destinationId']);  
										$array = explode(',', $string); 
										foreach($array as $value)  
										{ ?>
										<?php echo  getCityName($value); ?> 
										<?php }?></h6>
<ul>
<li><i class="careerfy-icon careerfy-filter-tool-black-shape"></i> ID: <span><?php echo encode($rest['id']); ?></span></li>
<li><i class="careerfy-icon careerfy-calendar"></i> Travel Date: <span><?php if(date('d-m-Y',strtotime($rest['startDate']))!='01-01-1970'){ echo date('d-m-Y',strtotime($rest['startDate'])); } ?></span></li>   
</ul>
<ul> 
<li><i class="careerfy-icon careerfy-user"></i> Pax: <span><?php echo $rest['adult']; ?> Adult  - <?php echo $rest['child']; ?> Child</span></li>  
</ul>
</a>
</div>
<div class="careerfy-table-cell"><?php echo date('d/m/Y',strtotime($rest['dateAdded'])); ?></div>  

<div class="careerfy-table-cell">

 <?php if($rest['statusId']==6){ ?>
<span class="badge badge-boxed  badge-soft-success" style=" background-color:#CC3300 !important; color:#fff; font-size: 11px; padding: 5px 6px;">Cancelled</span>
<?php }

elseif($rest['assignTo']>0 && $rest['endDate']<date('Y-m-d') && $restpack['id']>0 && $paymentlist['id']>0 && $rest['statusId']!=6){ ?>
<span class="badge badge-boxed  badge-soft-success" style=" background-color: #49bf68 !important; color:#fff; font-size: 11px; padding: 5px 6px;">Completed</span>
<?php }
elseif($rest['assignTo']>0 && $rest['startDate']<=date('Y-m-d') && $rest['endDate']>=date('Y-m-d') && $restpack['id']>0 && $rest['statusId']!=6){ ?>
<span class="badge badge-boxed  badge-soft-success" style=" background-color: #c2c508!important; color:#fff; font-size: 11px; padding: 5px 6px;">On-Going</span>
<?php }
elseif($rest['assignTo']>0 && $restpack['id']>0 && $rest['statusId']==8 && $rest['statusId']!=6){ ?>
<span class="badge badge-boxed  badge-soft-success" style=" background-color:#02D0C6!important; color:#fff; font-size: 11px; padding: 5px 6px;">Prop Received</span>
<?php }
elseif($rest['assignTo']>0 && $restpack['id']>0 && $rest['statusId']!=6 && $rest['statusId']!=8){ ?>
<span class="badge badge-boxed  badge-soft-success" style=" background-color:#9FC703!important; color:#fff; font-size: 11px; padding: 5px 6px;">Quote Received</span> 
<?php }
elseif($rest['assignTo']>0 && $restpack['id']<1 && $rest['estimatedQuote']!='' && $rest['statusId']!=6){ ?>
<span class="badge badge-boxed  badge-soft-success" style=" background-color: #fe6a00!important; color:#fff; font-size: 11px; padding: 5px 6px;">Estimated Quoted</span> 
<?php }
elseif($rest['assignTo']>0 && $rest['estimatedQuote']=='' && $restpack['id']<1 && $rest['statusId']!=6){ ?>
<span class="badge badge-boxed  badge-soft-success" style=" background-color: #cb42ba!important; color:#fff; font-size: 11px; padding: 5px 6px;">Assigned</span> 
<?php }
elseif($rest['statusId']==1 && $rest['assignTo']<1){ ?>
<span class="badge badge-boxed  badge-soft-success" style=" background-color: #00c4fe!important; color:#fff; font-size: 11px; padding: 5px 6px;">Opened</span> 
<?php }else{  }  ?> 

</div>

<div class="careerfy-table-cell" style="text-align:center;"> 
<?php if($rest['assignTo']!=1){ 
$rs22=GetPageRecord('*','sys_userMaster',' id="'.$rest['assignTo'].'" order by firstName asc'); 
if(mysqli_num_rows($rs22)>0){
$restuser=mysqli_fetch_array($rs22);    
echo $restuser['firstName']; 
} } ?>

</div>

<div class="careerfy-table-cell"> 
<?php if($rest['assignTo']!=1){ ?><div class="getno" onClick="getaccmanagerno('<?php echo encode($rest['id']); ?>');$('#getaccmanagerno').show();">Get Number</div><?php } ?>

</div>
</div> 
</div>
<?php   $nos++; } ?>
 


<?php if($nos==1){ ?>
<div style="text-align:center; padding:20px; text-align:center;">No Trip Found</div>
<?php } ?>


</div>
</div>
</div>
</div>
</div>
</div>

<?php 
function dbpack() {
	static $connpack;
		if ($connpack===NULL){ 
			$servernamepack = "localhost";
			$usernamepack = "webfr9ps_b2cFinal";
			$passwordpack = "admin@3214";
			$dbnamepack = "webfr9ps_b2cFinal";
			$connpack = mysqli_connect ($servernamepack, $usernamepack, $passwordpack, $dbnamepack);
	}
	return $connpack;
}
?>

 




</div>
</div>
</div>

</div>


 

</div>

 
<?php include "clientfooterinc.php";  ?>
<div class="careerfy-employer-box-section" id="getaccmanagerno" style="display:none; position:fixed; top:0px; left:0px; right:0px; bottom:0px; margin:auto; z-index:99; max-width:400px;height: fit-content;" >
<div class="careerfy-profile-title">
  <h2>Account Manager</h2>  
  <i class="fa fa-times" aria-hidden="true" style="float:right; color:#b2adad; font-size: 20px;" onClick="$('#getaccmanagerno').hide();"></i>
</div>
<div id="loadaccountmanager"></div>
 
</div>
</body>
 
</html>

<script>
function getaccmanagerno(qid){
$('#loadaccountmanager').html('');
$('#loadaccountmanager').load('clientgetaccountmanagerno.php?id='+qid);
}
 
</script>
