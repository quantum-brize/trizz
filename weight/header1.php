
<div id="header">
<div class="container">

 

      <i class="fa fa-bars mobilemainmenu" aria-hidden="true" onclick="$('.mobilemainmenuboxss').toggle();"></i>
	  
	  <div class="mobilemainmenuboxss">
	  <?php if($_SESSION['websiteUserId']==''){ ?> 
	  <a onclick="loadpop('Account Login',this,'800px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=clientlogin" ><i class="fa fa-user" aria-hidden="true"></i> Login / Signup</a>
	  <?php } else { ?>
	  	  <a href="<?php echo $fullurl; ?>my-profile"><i class="fa fa-user" aria-hidden="true"></i> My Account</a>
	  <?php } ?>
	  
                           <a href="<?php echo $fullurl; ?>about-us"><i class="fa fa-file-text-o" aria-hidden="true"></i> About</a>
              <a href="<?php echo $fullurl; ?>terms-conditions"><i class="fa fa-file-text" aria-hidden="true"></i> Terms & conditions</a>
              <a href="<?php echo $fullurl; ?>privacy-policy"><i class="fa fa-file-text" aria-hidden="true"></i> Privacy Policy</a>
              <a href="<?php echo $fullurl; ?>blog"><i class="fa fa-list-alt" aria-hidden="true"></i> Blog</a>
              <a href="<?php echo $fullurl; ?>contact-us"><i class="fa fa-phone-square" aria-hidden="true"></i> Contact</a>
	  
	  </div>
	  
	  <script>
	  $(document).mouseup(function(e) 
{
    var container = $(".mobilemainmenuboxss");

    // if the target of the click isn't the container nor a descendant of the container
    if (!container.is(e.target) && container.has(e.target).length === 0) 
    {
        container.hide();
    }
});
	  </script>
	  

    <div id="logo"><a href="<?php echo $fullurl; ?>"><img src="<?php echo $imgurl; ?><?php echo $companyProfileData['companyLogo']; ?>"></a></div>

    <div id="menu">
 

    <a href="<?php echo $fullurl; ?>flights" <?php if($selectedpage=='flights'){ ?>class="active"<?php } ?>><span><i class="fa fa-plane" aria-hidden="true"></i></span>Flights</a>

    <a href="<?php echo $fullurl; ?>hotels" <?php if($selectedpage=='hotels'){ ?>class="active"<?php } ?>><span><i class="fa fa-building" aria-hidden="true"></i></span>Hotels</a>

   

  <div class="dropdown dropbuton" style="margin-right:10px; float:left;">  <a href="<?php echo $fullurl; ?>holidays" class="<?php if($selectedpage=='holidays'){ ?>active<?php } ?> dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span><i class="fa fa-suitcase" aria-hidden="true"></i></span>Holidays</a>

  

  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">

    <a class="dropdown-item" href="domestic-holidays">Domestic</a>

    <a class="dropdown-item" href="international-holidays">International</a>

   

  </div>

  </div>

	

	 

    </div>

    

    

    <div id="rightmenu">

	

    <div class="dropdown" id="toprightmenubox"> 
    </div>
	
	<script>
	$('#toprightmenubox').load('toprightmenubox.php');
	</script>

</div>

</div>
</div>