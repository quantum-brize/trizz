<?php
$abcd=GetPageRecord('*','sys_packageBuilder','id="'.decode($_REQUEST['id']).'"'); 
$result=mysqli_fetch_array($abcd); 

if($result['id']==''){ 
header('Location: '.$fullurl.'');
exit();
}
?>

<style>
.topnavigation  .nav-pills .nav-link.active, .nav-tabs .nav-link.active {
       font-size: 16px; 
    font-weight: 700;
    background: #ffffff26; 
    color: #fff;  
    border-bottom: 2px solid #ffffffb5;
    color: #ffffff; 
}

.topnavigation .nav-pills .nav-link, .nav-tabs .nav-link {
     font-size: 16px;
    text-transform: uppercase;
    font-weight: 400; 
    border: 0px;
    color: #ffffffcc;
    border-radius: 0px;
    padding: 10px 35px;
    border-bottom: 2px solid transparent;
    color: #ffffff;
    border-radius: 4px;
    margin: 5px;border-radius: 4px;
}

.topnavigation .nav-tabs .nav-link:focus, .nav-tabs .nav-link:hover {
    border-color:  transparent;
}
 
.wrapper{margin-top: 102px !important;}
</style>
 

<div class="wrapper" >
   <div class="row" style="background-color: #06304c; margin-bottom: 38px; z-index: 99; position: fixed; left: 0px; width: 100%; margin: 0px; top: 46px; border-top: 1px solid #ffffff61;">
<div class="container-fluid topnavigation" style=" position: relative;">
<ul class="nav nav-tabs" style="border:0px;">
<?php if($result['queryId']>0){ ?>
   <li class="nav-item"><a class="nav-link" href="display.html?ga=query&view=1&id=<?php echo encode($result['queryId']); ?>&c=2"><i class="fa fa-arrow-left" aria-hidden="true"></i> &nbsp;QUERY</a></li>
   <?php } else { ?>
   <li class="nav-item"><a class="nav-link" href="display.html?ga=itineraries"><i class="fa fa-arrow-left" aria-hidden="true"></i> &nbsp;ITINERARIES</a></li>
   <?php } ?>
   <li class="nav-item"><a class="nav-link<?php if($_REQUEST['b']==''){ ?> active<?php } ?>" href="display.html?ga=<?php echo $_REQUEST['ga']; ?>&view=1&id=<?php echo $_REQUEST['id']; ?>">BUILD</a></li>
   <li class="nav-item"><a class="nav-link<?php if($_REQUEST['b']==2){ ?> active<?php } ?>" href="display.html?ga=<?php echo $_REQUEST['ga']; ?>&view=1&id=<?php echo $_REQUEST['id']; ?>&b=2">PRICING</a></li>
     
   <?php if($result['grossPrice']>0){ ?>
   <li class="nav-item"><a class="nav-link<?php if($_REQUEST['b']==4){ ?> active<?php } ?>" href="display.html?ga=<?php echo $_REQUEST['ga']; ?>&view=1&id=<?php echo $_REQUEST['id']; ?>&b=4">FINAL</a></li> 
   <?php } ?>
   
    <li class="nav-item" style="position:absolute; right:120px;"><a  class="nav-link" href="<?php echo $fullurl; ?>tcpdf/pdf/download-package.php?pageurl=<?php echo $fullurl; ?>downloadpackagepdf.php?id=<?php echo $_REQUEST['id']; ?>" ><i class="fa fa-file-text" aria-hidden="true"></i> &nbsp;Export</a></li>
	
	<?php if($result['queryId']>0){?>   <li class="nav-item" style="position:absolute; right:247px;"><a href="#" class="nav-link" onclick="loadpop('View Quotation',this,'1000px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewquotation&id=<?php echo $_REQUEST['id']; ?>"><i class="fa fa-file-text" aria-hidden="true"></i> &nbsp;Quotation</a></li><?php } ?>
	   
	   
	    <li class="nav-item" style="position:absolute; right:120px;"><a href="#" class="nav-link" onclick="loadpop('Export Itinerary',this,'500px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=exportitinerary&pid=<?php echo $_REQUEST['id']; ?>"><i class="fa fa-file-text" aria-hidden="true"></i> &nbsp;Export</a></li>
	
    <li class="nav-item" style="position:absolute; right:0px;"><a class="nav-link" href="#"  onclick="loadpop('Share',this,'700px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=shareitinerary&pid=<?php echo $_REQUEST['id']; ?>"><i class="fa fa-paper-plane" aria-hidden="true"></i> &nbsp;Share</a></li>
	 
</ul>
</div></div>


<?php 
if($_REQUEST['b']==''){
include "itineraries_build.php"; 
}

if($_REQUEST['b']==2){
include "itineraries_manage.php"; 
}
if($_REQUEST['b']==3){
include "itineraries_proposal.php"; 
}

if($_REQUEST['b']==4){
include "itineraries_final.php"; 
}

?>
	
	
 </div>