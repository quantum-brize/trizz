<style>
body{padding-top:10px;}
#header #menu .active {  border: 0px; border-bottom: 4px solid var(--blue) !important; background-color: transparent; border-radius: 0px; color:var(--blue); }
#header #menu a{background-color:transparent; border:0px;  height: 60px; border-bottom: 4px solid #fff; border-radius: 0px;   height: 50px;display: inline-grid !important; font-size:13px; text-align:center; margin-right: 20px;padding: 4px 5px;}
#header #menu a:hover{background-color:transparent; border:0px; color:var(--blue);  border-bottom: 4px solid #fff !important;     height: 50px;}
#header #menu a span{display:block; text-align:center; width:100%; background-color:transparent; font-size:20px;color:var(--darkgray); height:18px;}
#header #menu .active span{color:var(--blue);}
#header #menu .dropdown-toggle::after{display:none;}
#header #logo img { height: 37px; }
#header {  box-shadow: 0px 0px 8px #00000045; }
.dropdown-item{  border-radius: 0px !important; padding: 10px !important;  line-height: 9px;}
.dropdown-item:hover{background-color:#f4f4f4 !important;}
@media (min-width: 576px) {
#header #rightmenu .btn{border:0px;     line-height: 35px;}
#header #rightmenu .btn span{padding: 0px; background-color: transparent; color: #111; width: auto; margin-top:4px; }
#header #rightmenu .show .btn { background-color: var(--blue); color: var(--white); border: 1px solid var(--blue); color: #111; background-color: transparent; border: 0px; }
}

@media (max-width: 575.98px) {
#header #logo img { height: 32px; }
#header #logo {padding-right: 0px !important;}

}
</style>
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
    
    <a href="<?php echo $fullurl; ?>bus" <?php if($selectedpage=='bus'){ ?>class="active"<?php } ?>><span><i class="fa fa-bus" aria-hidden="true"></i></span>Bus</a>

   

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