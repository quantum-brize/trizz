<?php
include "inc.php";
?>

	<div class="offerheading"> 
	<h3 class="homedealsheading">Exclusive <span>Deals</span> <div class="dealsectiontabs">
	
	<a <?php if($_REQUEST['sid']=='hotdeal'){ ?>class="active"<?php } ?> onClick="alldealspage('hotdeal');">Hot Deals</a>
	<a <?php if($_REQUEST['sid']=='flight'){ ?>class="active"<?php } ?> onClick="alldealspage('flight');">Flight</a>
	<a <?php if($_REQUEST['sid']=='hotel'){ ?>class="active"<?php } ?> onClick="alldealspage('hotel');">Hotel</a> 
	</div></h3> 
	</div>
	

	<div class="row dealsrows">
	<?php 
	if($_REQUEST['sid']=='flight' || $_REQUEST['sid']=='hotel'){
	$where=' dealType="'.$_REQUEST['sid'].'" ';
	} else { 
	$where=' 1 ';
	}
	 
	$a = GetPageRecord('*', 'sys_specialDeal', ' '.$where.'  and addBy=1 and status=1 order by  rand() limit 0,3'); 
	while ($spdeals = mysqli_fetch_array($a)) { 
	?> 
	
	<div class="col-lg-4">
	
	<div class="offersection"  onClick="loadpop('Deal Details',this,'700px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewdetails&id=<?php echo encode($spdeals['id']); ?>" style="cursor:pointer;">
	 <div class="card" style="margin-left: 56px; padding-left: 94px; min-height: 204px;box-shadow: 0px 0px 10px #00000029; border: 0px;    margin-top: 0px;">
	 <div class="card-body" >
	 
	 	<div class="offerimg mobileofferimg offerimgnew"> 
	<img src="<?php echo $imgurl; ?><?php echo $spdeals['image']; ?>" alt="<?php echo stripslashes($spdeals['title']); ?>"> 
	</div>
	 <div style="font-weight:800; color:#000000; font-size:18px;"><?php echo stripslashes($spdeals['title']); ?></div>
	
	<h6 class="mt-2" style="font-weight:500; color: #4f4f4f;"><?php echo substr(nl2br(stripslashes($spdeals['description'])), 0, 80); ?>...</h6>
	</div></div>
	</div>
	</div> 
	<?php } ?>
	</div>
