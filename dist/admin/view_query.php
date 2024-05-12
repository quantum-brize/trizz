<?php
ob_start();
if($_REQUEST['sts']>0 && $_REQUEST['sts']<10){
$namevalue ='statusId="'.$_REQUEST['sts'].'"';  
$where='id="'.decode($_REQUEST['id']).'"';  
updatelisting('queryMaster',$namevalue,$where);  

$rs13=GetPageRecord('*','queryStatusMaster','id="'.$_REQUEST['sts'].'"');   
$stausdata=mysqli_fetch_array($rs13);

$namevalue3 ='details="Query Status Changed: '.$stausdata['name'].'",queryId="'.decode($_REQUEST['id']).'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.date('Y-m-d H:i:s').'",userId=0,logType="status_change"'; 
addlisting('queryLogs',$namevalue3);
 
sendautomationmail(decode($_REQUEST['id']),$fullurlproposal); 

$stschange='';
if($_REQUEST['sts']==5){
$stschange='&showcong=1';
}
 
header('Location:display.html?ga=query&view=1&id='.$_REQUEST['id'].''.$stschange);
  
}

$startDate=date('d-m-Y',strtotime('+2 Days'));
$endDate=date('d-m-Y',strtotime('+4 Days'));


if($_REQUEST['id']!=''){ 
$select1='*';    
$where1='id="'.decode($_REQUEST['id']).'"';  
$rs1=GetPageRecord($select1,'queryMaster',$where1);   
$editresult=mysqli_fetch_array($rs1); 

if($editresult['startDate']!='' && $editresult['endDate']!=''){

$startDate=date('d-m-Y',strtotime($editresult['startDate']));
$endDate=date('d-m-Y',strtotime($editresult['endDate']));

}


$b=GetPageRecord('*','userMaster','id="'.$editresult['clientId'].'"'); 
$clientData=mysqli_fetch_array($b);
}
 

$rs=GetPageRecord($select,'sys_userMaster','id in (select addedBy from sys_userMaster where id="'.$result['addedBy'].'") '); 
$invoicedataa=mysqli_fetch_array($rs);


if($_REQUEST['c']==''){
$filename='query_details.php';
}
if($_REQUEST['c']==2){
$filename='query_proposal.php';
}

if($_REQUEST['c']==3){
$filename='query_followup.php';
}

if($_REQUEST['c']==4){
$filename='query_supplier.php';
}

if($_REQUEST['c']==5){
$filename='query_billing.php';
}

if($_REQUEST['c']==6){
$filename='query_history.php';
}
if($_REQUEST['c']==7){
$filename='query_mails.php';
}
if($_REQUEST['c']==8){
$filename='query_operation.php';
} 
if($_REQUEST['c']==9){
$filename='query_tourexpences.php';
} 
if($_REQUEST['c']==10){
$filename='query_guest.php';
}


$mainwhere=''; 
if($LoginUserDetails['userType']!=0){ 
$mainwhere=' and (addedBy="'.$_SESSION['userid'].'" or  assignTo="'.$_SESSION['userid'].'") ';
} else {
$mainwhere=' and addedBy in (select addedBy from sys_userMaster where id="'.$_SESSION['userid'].'") '; 
}
 
/*$ck=GetPageRecord('id','queryMaster',' id in (select queryId from queryNotes) and id='.(decode($_REQUEST['id'])-1).' '.$mainwhere.' order by id DESC limit 0,1'); 
$notesdatack=mysqli_fetch_array($ck); 
if($notesdatack['id']!=''){
$checkQuery=1;
}else{
header('Location:display.html?ga=query');
exit();
}*/



?>
<?php if($clientData['mobile']!=''){
	$mobileno='';
	if(strlen($clientData['mobile'])>10){
	$mobileno=stripslashes($clientData['mobile']);
	}
	if(strlen($clientData['mobile'])==10){
	$mobileno='91'.stripslashes($clientData['mobile']);
	}
}
 ?>
<script src="tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
selector: ".editorclass",
themes: "modern",
plugins: [
"advlist autolink lists link image charmap print preview anchor",
"searchreplace visualblocks code fullscreen"
],
toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
});
</script>

<style>
.table td, .table th {
    vertical-align: top;
}
label{width: 100% !important; margin-bottom: 2px !important;font-size: 12px; text-transform: uppercase;}

 

.nav-link {
    display: block;
    padding: 8px 30px;
}

.header-title { padding: 6px 10px; background-color: #f5f7f9; border-radius: 4px; border: 0px; text-transform: capitalize; margin-top:0px !important; }
label { 
    color: #9a9a9a;
}
 

.nav-link { 
    padding: 8px 13px !important;
}

.input-group { font-size: 13px; font-weight: 600; margin-bottom:15px;}
</style>
<div class="wrapper">
<div class="container-fluid">
<div class="main-content">

                <div class="page-content">
				
				
				<div class="newboxheading"><div class="newhead">Query ID: <?php echo encode($editresult['id']); ?> <?php if($editresult['priorityStatus']==1){ ?><img src="images/hot.gif" width="40" height="27" /><?php } ?>
 <div class="newoptionmenu"> 
 
 

 
 	 <?php if (strpos($LoginUserDetails["permissionAddEdit"], 'Query') !== false) { ?>								 
    <div>
	<a onclick="createquery('<?php echo encode($editresult['id']); ?>');" ><button type="button" class="btn btn-secondary btn-lg waves-effect waves-light btn-primary-gray" style="margin-bottom:10px;" >

                                       <i class="fa fa-pencil" aria-hidden="true"></i> &nbsp;Edit</button></a>
	</div>
	<?php } ?>
	
	
	<div>
	<a href="display.html?ga=query&view=1&id=<?php echo encode($editresult['id']); ?>&c=3" ><button type="button" class="btn btn-secondary btn-lg waves-effect waves-light btn-primary-gray" style="margin-bottom:10px;" >

                                       <i class="fa fa-calendar-check-o" aria-hidden="true"></i> &nbsp;Task</button></a>
	</div>
	
	 <div>
	<a popaction="action=composemail&queryId=<?php echo encode($editresult['id']); ?>" onclick="loadpop('Compose Mail',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center"  ><button type="button" class="btn btn-secondary btn-lg waves-effect waves-light btn-primary-gray" style="margin-bottom:10px;" >

                                       <i class="fa fa-envelope-o" aria-hidden="true"></i> &nbsp;Email</button></a>
	</div>
	
	<div>
	<?php if($clientData['mobile']!=''){
	$mobileno='';
	if(strlen($clientData['mobile'])>10){
	$mobileno=stripslashes($clientData['mobile']);
	}
	if(strlen($clientData['mobile'])==10){
	$mobileno='91'.stripslashes($clientData['mobile']);
	}

 ?>
	<a onclick="whatsappQuwithPrice();" style="float:right;cursor:pointer;" class="whatsappsharequerymain"><img src="images/whatsapp-button.png" alt="Send WhatsApp Message" height="40"  ></a> <?php } ?>
	</div>
	 <div id="actionDivWhtap"></div>

<input type="hidden" id="urlData" value="<?php echo encode($editresult["id"]); ?>">
<input type="hidden" id="clientMobile" value="91<?php echo str_replace('+91','',str_replace('91','',$mobileno)); ?>">
 
<script>
	function whatsappQuwithPrice(){
		var urlData=$("#urlData").val();
		$('#actionDivWhtap').load('actionpage.php?id='+urlData+'&action=sendFollowup');
	}
</script>
   
  
 

 
 

									
									
  
		  
		  

 </div>
 </div>     
 
     
</div>


 


<style>
.breadcrumb { list-style: none; overflow: hidden; font: 18px Helvetica, Arial, Sans-Serif; margin: 0px; padding: 0; margin-bottom: 0px; margin-left: 0px; }
.breadcrumb li { 
  float: left; 
} 
.breadcrumb li a {
    color: white;
    text-decoration: none;
    padding: 10px 0 10px 55px;
    background: brown;
    background: hsla(34,85%,35%,1);
    position: relative;
    display: block;
    float: left;
    background-color: #cfd7df;
    color: #000;
    font-size: 13px;
}
.breadcrumb li a:after {
    content: " ";
    display: block;
    width: 0;
    height: 0;
    border-top: 50px solid transparent;
    border-bottom: 50px solid transparent;
    border-left: 30px solid #cfd7df;
    position: absolute;
    top: 50%;
    margin-top: -50px;
    left: 100%;
    z-index: 2;
}
.breadcrumb li a:before { 
  content: " "; 
  display: block; 
  width: 0; 
  height: 0;
  border-top: 50px solid transparent;           /* Go big on the size, and let overflow hide */
  border-bottom: 50px solid transparent;
  border-left: 30px solid white;
  position: absolute;
  top: 50%;
  margin-top: -50px; 
  margin-left: 1px;
  left: 100%;
  z-index: 1; 
} 
.breadcrumb li:first-child a {
  padding-left: 10px ;
}
 
  
.breadcrumb li a:hover { background: #cecece !important; }
.breadcrumb li a:hover:after { border-left-color: #cecece !important; }


.steps {
  margin: 40px;
  padding: 0;
  overflow: hidden;
}
.steps a {
  color: white;
  text-decoration: none;
}
.steps em {
  display: block;
  font-size: 1.1em;
  font-weight: bold;
}
.steps li {
  float: left;
  margin-left: 0;
  width: 150px; /* 100 / number of steps */
  height: 70px; /* total height */
  list-style-type: none;
  padding: 5px 5px 5px 30px; /* padding around text, last should include arrow width */
  border-right: 3px solid white; /* width: gap between arrows, color: background of document */
  position: relative;
}
/* remove extra padding on the first object since it doesn't have an arrow to the left */
.steps li:first-child {
  padding-left: 5px;
}
/* white arrow to the left to "erase" background (starting from the 2nd object) */
.steps li:nth-child(n+2)::before {
  position: absolute;
  top:0;
  left:0;
  display: block;
  border-left: 25px solid white; /* width: arrow width, color: background of document */
  border-top: 40px solid transparent; /* width: half height */
  border-bottom: 40px solid transparent; /* width: half height */
  width: 0;
  height: 0;
  content: " ";
}
/* colored arrow to the right */
.steps li::after {
  z-index: 1; /* need to bring this above the next item */
  position: absolute;
  top: 0;
  right: -25px; /* arrow width (negated) */
  display: block;
  border-left: 25px solid #7c8437; /* width: arrow width */
  border-top: 40px solid transparent; /* width: half height */
  border-bottom: 40px solid transparent; /* width: half height */
  width:0;
  height:0;
  content: " ";
}

/* Setup colors (both the background and the arrow) */

/* Completed */
.steps li { background-color: #7C8437; }
.steps li::after { border-left-color: #7c8437; }

/* Current */
.steps li.current { background-color: #C36615; }
.steps li.current::after { border-left-color: #C36615; }

/* Following */
.steps li.current ~ li { background-color: #EBEBEB; }
.steps li.current ~ li::after { border-left-color: #EBEBEB; }

/* Hover for completed and current */
.steps li:hover {background: #cecece !important;}
.steps li:hover::after {border-left-color: #696}



.arrows { white-space: nowrap; }
.arrows li {
    display: inline-block;
    line-height: 26px;
    margin: 0 9px 0 -10px;
    padding: 0 20px;
    position: relative;
}
.arrows li::before,
.arrows li::after {
    border-right: 1px solid #666666;
    content: '';
    display: block;
    height: 50%;
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    z-index: -1;
    transform: skewX(45deg);   
}
.arrows li::after {
    bottom: 0;
    top: auto;
    transform: skewX(-45deg);
}

.arrows li:last-of-type::before, 
.arrows li:last-of-type::after { 
    display: none; 
}

.arrows li a { 
   font: bold 24px Sans-Serif;  
   letter-spacing: -1px; 
   text-decoration: none;
}

.arrows li:nth-of-type(1) a { color: hsl(0, 0%, 70%); } 
.arrows li:nth-of-type(2) a { color: hsl(0, 0%, 65%); } 
.arrows li:nth-of-type(3) a { color: hsl(0, 0%, 50%); } 
.arrows li:nth-of-type(4) a { color: hsl(0, 0%, 45%); } 


.stclass1 a{ background-color:#655be6 !important; color:#fff !important;}
.stclass1 a::after{  border-left: 30px solid #655be6 !important;}
 
.stclass2 a{ background-color:#0cb5b5 !important; color:#fff !important;}
.stclass2 a::after{  border-left: 30px solid #0cb5b5 !important;}
 
.stclass3 a{ background-color:#0f1f3e !important; color:#fff !important;}
.stclass3 a::after{  border-left: 30px solid #0f1f3e !important;}

.stclass4 a{ background-color:#e45555 !important; color:#fff !important;}
.stclass4 a::after{  border-left: 30px solid #e45555 !important;}

.stclass5 a{ background-color:#46cd93 !important; color:#fff !important;}
.stclass5 a::after{  border-left: 30px solid #46cd93 !important;}
 
.stclass6 a{ background-color:#6c757d !important; color:#fff !important;}
.stclass6 a::after{  border-left: 30px solid #6c757d !important;}

.stclass7 a{ background-color:#f9392f !important; color:#fff !important;}
.stclass7 a::after{  border-left: 30px solid #f9392f !important;}

.stclass8 a{ background-color:#cc00a9 !important; color:#fff !important;}
.stclass8 a::after{  border-left: 30px solid #cc00a9 !important;}

.stclass9 a{ background-color:#FF6600 !important; color:#fff !important;}
.stclass9 a::after{  border-left: 30px solid #FF6600 !important;}
.header-title{padding: 6px 10px; background-color: #f7f7f7; border-radius: 4px;}

.querydetailinsideheading{font-size:18px; margin-bottom:10px; font-weight:600; color:#000; position:relative;}
.querydetailinsideheading div{position: absolute; right: 0px; top: 0px; }
.querydetailinsideheading div a{font-size: 12px; background-color: #e6ebf2; color: #030303; padding: 4px 10px !important; border-radius: 6px; float: left;margin-left: 5px;}
.querydetailinsideheading div .active{ background-color:#303834; color:#fff;}
.nav-tabs .nav-item { margin-bottom: 0px; width: 100%;  } 
.proposalboxouterbox .itibox{float:left; width:31.5%; float:left; margin-right:10px;} 
.proposalboxouterbox .itibox .imgbox{ height:200px; overflow:hidden;border-radius: 5px; position:relative;}
.proposalboxouterbox .itibox .card{padding:5px !important;}
.proposalboxouterbox .itibox .imgbox img{width:100% !important;  min-height:100% !important;  height:auto !important; }
.proposalboxouterbox .itibox .imgbox .packname { background-color: #000000b8; font-size: 15px; color: #fff; font-weight: 600; position: absolute; left: 0px; bottom: 0px; width: 100%; padding: 10px; }
.proposalboxouterbox .itibox .smtext{font-size:12px; color:#333;}
.proposalboxouterbox .itibox .card-body{ padding:10px !important;}
.proposalboxouterbox .itibox .optionmenu { position: absolute; top: 5px; right: 5px; background-color: #fff; width: 30px; text-align: center; padding-right: 0px; border-radius: 2px; }
.proposalboxouterbox .itibox .addnewcard { height: 481px; background-color: #cfd7df42; border: 3px dashed #cfd7df; box-shadow: 0px 0px 0px #fff !important; text-align: center; padding-top: 50% !important; padding-left: 20px !important; padding-right: 20px !important; }
.proposalboxouterbox .itibox .btn-warning {margin:0px !important; width:100% !important;}

</style>



      
                    
                    <!-- start page title -->
                     
              
                        <div class="row">
                        <div class="col-md-12 col-xl-12">
						<div class="card" style="min-height: 500px; margin-left: 17px; margin-right: 17px; margin-top: 47px; overflow:hidden;">
						
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
 <tr>
    <td colspan="2" align="left" valign="top" style="background-color:#f5f7f9; border-bottom: 1px solid #cfd7df; padding:10px;">
	<div style="font-size:11px; margin-bottom:10px;"><strong>Created:</strong> <?php echo date('d-m-Y',strtotime($editresult['dateAdded'])); ?> &nbsp; | &nbsp; <strong>Last Updated: <?php echo date('d/m/Y - h:i A',strtotime($editresult['updateDate'])); ?></strong></div>
	<div class="querystatustabmain" style="overflow:hidden;">
 

 
<ul class="breadcrumb">

<?php  


if($editresult['statusId']!=5){ 

$rs=GetPageRecord('*','queryStatusMaster',' 1 order by sr asc');
while($rest=mysqli_fetch_array($rs)){ 
?> 
<li class="<?php if($rest['id']==$editresult['statusId'] && $editresult['statusId']==1){ ?>stclass1<?php } ?><?php if($rest['id']==$editresult['statusId'] && $editresult['statusId']==2){ ?>stclass2<?php } ?><?php if($rest['id']==$editresult['statusId'] && $editresult['statusId']==3){ ?>stclass3<?php } ?><?php if($rest['id']==$editresult['statusId'] && $editresult['statusId']==8){ ?>stclass8<?php } ?><?php if($rest['id']==$editresult['statusId'] && $editresult['statusId']==4){ ?>stclass4<?php } ?><?php if($rest['id']==$editresult['statusId'] && $editresult['statusId']==5 ){ ?>stclass5<?php } ?><?php if($rest['id']==$editresult['statusId'] && $editresult['statusId']==6){ ?>stclass6<?php } ?><?php if($rest['id']==$editresult['statusId'] && $editresult['statusId']==7){ ?>stclass7<?php } ?><?php if($rest['id']==$editresult['statusId'] && $editresult['statusId']==9){ ?>stclass9<?php } ?>">

<a <?php if($rest['id']!=5){ ?> href="display.html?ga=query&view=1&id=<?php echo $_REQUEST['id']; ?>&sts=<?php echo $rest['id']; ?>" <?php } else { ?>href="#" onclick="alert('You can not mark as confirmed manually.');"<?php } ?>><?php echo $rest['name']; ?></a>
</li> 
<?php }  } ?>



<?php  
if($editresult['statusId']==5 && $LoginUserDetails['id']==1){ 

$rs=GetPageRecord('*','queryStatusMaster',' 1 order by sr asc');
while($rest=mysqli_fetch_array($rs)){ 
?> 
<li class="<?php if($rest['id']==$editresult['statusId'] && $editresult['statusId']==1){ ?>stclass1<?php } ?><?php if($rest['id']==$editresult['statusId'] && $editresult['statusId']==2){ ?>stclass2<?php } ?><?php if($rest['id']==$editresult['statusId'] && $editresult['statusId']==3){ ?>stclass3<?php } ?><?php if($rest['id']==$editresult['statusId'] && $editresult['statusId']==8){ ?>stclass8<?php } ?><?php if($rest['id']==$editresult['statusId'] && $editresult['statusId']==4){ ?>stclass4<?php } ?><?php if($rest['id']==$editresult['statusId'] && $editresult['statusId']==5){ ?>stclass5<?php } ?><?php if($rest['id']==$editresult['statusId'] && $editresult['statusId']==6){ ?>stclass6<?php } ?><?php if($rest['id']==$editresult['statusId'] && $editresult['statusId']==7){ ?>stclass7<?php } ?><?php if($rest['id']==$editresult['statusId'] && $editresult['statusId']==9){ ?>stclass9<?php } ?>">

<a <?php if($rest['id']!=1 && $rest['id']!=2 && $rest['id']!=3 && $rest['id']!=4 && $rest['id']!=7 && $rest['id']!=8 && $rest['id']!=9){  ?> href="display.html?ga=query&view=1&id=<?php echo $_REQUEST['id']; ?>&sts=<?php echo $rest['id']; ?>" <?php } else { ?>href="#" onclick="alert('Locked.');"<?php } ?>><?php if($rest['id']!=6 && $rest['id']!=5){  ?><i class="fa fa-lock" aria-hidden="true"></i>  &nbsp;<?php } ?><?php echo $rest['name']; ?></a>
</li> 
<?php }  } ?>
  
 
 <?php  
if($editresult['statusId']==5 && $LoginUserDetails['id']!=1){ 

$rs=GetPageRecord('*','queryStatusMaster',' 1 order by sr asc');
while($rest=mysqli_fetch_array($rs)){ 
?> 
<li class="<?php if($rest['id']==$editresult['statusId'] && $editresult['statusId']==1){ ?>stclass1<?php } ?><?php if($rest['id']==$editresult['statusId'] && $editresult['statusId']==2){ ?>stclass2<?php } ?><?php if($rest['id']==$editresult['statusId'] && $editresult['statusId']==3){ ?>stclass3<?php } ?><?php if($rest['id']==$editresult['statusId'] && $editresult['statusId']==4){ ?>stclass4<?php } ?><?php if($rest['id']==$editresult['statusId'] && $editresult['statusId']==5){ ?>stclass5<?php } ?><?php if($rest['id']==$editresult['statusId'] && $editresult['statusId']==6){ ?>stclass6<?php } ?><?php if($rest['id']==$editresult['statusId'] && $editresult['statusId']==7){ ?>stclass7<?php } ?><?php if($rest['id']==$editresult['statusId'] && $editresult['statusId']==9){ ?>stclass9<?php } ?><?php if($rest['id']==$editresult['statusId'] && $editresult['statusId']==8){ ?>stclass8<?php } ?>">

<a <?php if($rest['id']!=1 && $rest['id']!=2 && $rest['id']!=3 && $rest['id']!=4 && $rest['id']!=7 && $rest['id']!=5 && $rest['id']!=6 && $rest['id']!=8 && $rest['id']!=9){  ?> href="display.html?ga=query&view=1&id=<?php echo $_REQUEST['id']; ?>&sts=<?php echo $rest['id']; ?>" <?php } else { ?>href="#" onclick="alert('Locked.');"<?php } ?>><i class="fa fa-lock" aria-hidden="true"></i>  &nbsp;<?php echo $rest['name']; ?></a>
</li> 
<?php }  } ?>
  
</ul>
 


</div></td>
    </tr>
 
  <tr>
    <td align="left" valign="top" width="18%" style="background-color:#f5f7f9; border-right: 1px solid #cfd7df;"><div class="inquerytabsmain">
								 
								  <div class="row" style="margin-right: 0px; margin-left: 0px;">
			 
								 
								 <ul class="nav nav-tabs nav-tabs-custom" style="border-bottom:0px solid #dee2e6;">
								 
   <li class="nav-item"><a class="nav-link<?php if($_REQUEST['c']==''){ ?> active show<?php } ?>" href="display.html?ga=query&view=1&id=<?php echo encode($editresult['id']); ?>"><span class="d-none d-md-block"><i class="fa fa-id-card-o" aria-hidden="true"></i> &nbsp;Query Details</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span></a></li>
   
   <?php if($clientData['firstName']!='' && $startDate!='' && $endDate!=''){ ?>
   
   <?php if (strpos($LoginUserDetails["permissionView"], 'Proposal') !== false) { ?>
   <li class="nav-item"><a class="nav-link<?php if($_REQUEST['c']==2){ ?> active show<?php } ?>" href="display.html?ga=query&view=1&id=<?php echo encode($editresult['id']); ?>&c=2"><span class="d-none d-md-block"><i class="fa fa-list-alt" aria-hidden="true"></i> &nbsp;Proposals</span><span class="d-block d-md-none"><i class="mdi mdi-account h5"></i></span></a></li>
   <?php } ?>
   
   <?php if (strpos($LoginUserDetails["permissionView"], 'Mails') !== false) { ?>
   <li class="nav-item"><a class="nav-link<?php if($_REQUEST['c']==7){ ?> active show<?php } ?>" href="display.html?ga=query&view=1&id=<?php echo encode($editresult['id']); ?>&c=7"><span class="d-none d-md-block"><i class="fa fa-envelope-o" aria-hidden="true"></i> &nbsp;Mails</span><span class="d-block d-md-none"><i class="mdi mdi-settings h5"></i></span></a></li>
   <?php } ?>
   
   
   <?php if (strpos($LoginUserDetails["permissionView"], 'Task') !== false) { ?>
   <li class="nav-item"><a class="nav-link<?php if($_REQUEST['c']==3){ ?> active show<?php } ?>" href="display.html?ga=query&view=1&id=<?php echo encode($editresult['id']); ?>&c=3"><span class="d-none d-md-block"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> &nbsp;Followup's</span><span class="d-block d-md-none"><i class="mdi mdi-email h5"></i></span></a></li>
     <?php } ?>
 
 
 <?php if (strpos($LoginUserDetails["permissionView"], 'Suppliers') !== false) { ?>
   <li class="nav-item"><a class="nav-link<?php if($_REQUEST['c']==4){ ?> active show<?php } ?>" href="display.html?ga=query&view=1&id=<?php echo encode($editresult['id']); ?>&c=4"><span class="d-none d-md-block"><i class="fa fa-users" aria-hidden="true"></i> &nbsp;Suppliers Communication</span><span class="d-block d-md-none"><i class="mdi mdi-settings h5"></i></span></a></li>
    <?php } ?>
	
	
	
   
 <?php if (strpos($LoginUserDetails["permissionView"], 'TourExpences') !== false) { ?>
   <li class="nav-item"><a class="nav-link<?php if($_REQUEST['c']==9){ ?> active show<?php } ?>" href="display.html?ga=query&view=1&id=<?php echo encode($editresult['id']); ?>&c=9"><span class="d-none d-md-block"><i class="fa fa-credit-card-alt" aria-hidden="true"></i> &nbsp;Post Sales Supplier</span><span class="d-block d-md-none"><i class="mdi mdi-settings h5"></i></span></a></li>
    <?php } ?>    
	
	
	  
	   <?php if (strpos($LoginUserDetails["permissionView"], 'Operation') !== false) { ?>
   <li class="nav-item"><a class="nav-link<?php if($_REQUEST['c']==8){ ?> active show<?php } ?>" href="display.html?ga=query&view=1&id=<?php echo encode($editresult['id']); ?>&c=8"><span class="d-none d-md-block"><i class="fa fa-check-square-o" aria-hidden="true"></i> &nbsp;Voucher</span><span class="d-block d-md-none"><i class="mdi mdi-settings h5"></i></span></a></li>
    <?php } ?>
    
   
   <?php if (strpos($LoginUserDetails["permissionView"], 'Billing') !== false) { ?>
    <li class="nav-item"><a class="nav-link<?php if($_REQUEST['c']==5){ ?> active show<?php } ?>" href="display.html?ga=query&view=1&id=<?php echo encode($editresult['id']); ?>&c=5"><span class="d-none d-md-block"><i class="fa fa-file-text" aria-hidden="true"></i> &nbsp;Billing</span><span class="d-block d-md-none"><i class="mdi mdi-settings h5"></i></span></a></li>
	<?php } ?>
	
	
	<?php  if (strpos($LoginUserDetails["permissionView"], 'Guest') !== false) { ?>
   <li class="nav-item"><a class="nav-link<?php if($_REQUEST['c']==10){ ?> active show<?php } ?>" href="display.html?ga=query&view=1&id=<?php echo encode($editresult['id']); ?>&c=10"><span class="d-none d-md-block"><i class="fa fa-user" aria-hidden="true"></i> &nbsp;Guest Documents</span><span class="d-block d-md-none"><i class="mdi mdi-settings h5"></i></span></a></li>
    <?php } ?>
	
	<?php if (strpos($LoginUserDetails["permissionView"], 'History') !== false) { ?>
	    <li class="nav-item"><a class="nav-link<?php if($_REQUEST['c']==6){ ?> active show<?php } ?>" href="display.html?ga=query&view=1&id=<?php echo encode($editresult['id']); ?>&c=6"><span class="d-none d-md-block"><i class="fa fa-clock-o" aria-hidden="true"></i> &nbsp;History</span><span class="d-block d-md-none"><i class="mdi mdi-settings h5"></i></span></a></li>
		<?php } ?><?php } ?>
</ul>
								 </div>
								 
							  </div></td>
    <td align="left" valign="top" <?php if($_REQUEST['c']==9){ ?>style=" background-color:#f5f7f9;"<?php } ?>>
	<?php if($_REQUEST['c']!=9){ ?>
	<div class="card-body"> 
                                      
									        <div style="padding:10px;">  
							  
							 <?php include $filename; ?>
							  </div>
									 
					 
						  </div><?php } else { ?>
						  	 <?php include $filename; ?>
						  <?php } ?></td>
  </tr>
</table>

						
                   		  </div>
								 
                             
</div>
                             

                        </div>

                         
						
						
						
						 
                     

             </div><!--end col-->

            <!-- end row -->

    </div>

        <!-- End Page-content -->

         
    </div>
	</div>	</div>
	
<style>
.querystatustabmainstikey{position: fixed; z-index: 99; background-color: #f5f7f9; width: 100%; top: 90px; left: 0px; padding: 6px; padding-left: 83px; box-shadow: 0px 3px 4px #0000001c; border-top: 1px solid #e2e2e2;}
</style>

<script>
 

$(function() {
    $(window).scroll(function(){
        if($(this).scrollTop() > 43) {
            $('.querystatustabmain').addClass('querystatustabmainstikey');
        } else {
		$('.querystatustabmain').removeClass('querystatustabmainstikey');
		}
    });
}); 


function queryNotes(){
$('#queryNotes').load('loadQueryNotes.php?id=<?php echo encode($editresult['id']); ?>');
}
queryNotes();
</script>