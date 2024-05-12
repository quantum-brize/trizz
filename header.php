<?php 

  

if($noshowmenu=="yes"){ ?>
<script>
window.addEventListener("scroll", (event) => {
    let scroll = this.scrollY;
	var spo = this.scrollY;
	
	if(spo>100){
	$('#header').addClass('selectheader');
	} else {
	$('#header').removeClass('selectheader');
	}
   
});
</script>
<?php } ?>

<style>

.main2 { position: relative;text-align: left;}

.item2 {
    width: 100%;
    line-height: 45px;
    padding-left: 20px;
    background-color: #fff;
    -webkit-transition: 0.2s ease-in-out;
    transition: 0.2s ease-in-out;
    font-weight: 400;
}
.item2:hover {
    background-color: #eee;
}



.pricedropdownflex{display: flex;align-items: center;}



  
    




</style>

<div id="header" <?php if($noshowmenu!="yes"){ ?>class="selectheader"<?php } ?>>
<div style="max-width:1200px; margin:auto;">
 
<img data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample" class="mobilemainmenu" src="<?php echo $fullurl; ?>images/menu1.png" alt="" aria-hidden="true" >
      <!-- <i class="fa fa-bars mobilemainmenu" aria-hidden="true" onclick="$('.mobilemainmenuboxss').toggle();"></i> -->
	  

      <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header">
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
  <div class="mobilemainmenuboxss">
  
   <?php if($_COOKIE[$cookie_name]!=1){ ?>
	 
    <div class="alltabslist">
    <a href="<?php echo $fullurl; ?>flights"  ><img src="<?php echo $fullurl; ?>images/flight1.png" alt=""> Flights</a>
	  <a href="<?php echo $fullurl; ?>hotels"  ><img src="<?php echo $fullurl; ?>images/hotel1.png" alt=""> Hotels</a>
    <a href="<?php echo $fullurl; ?>holidays"><img src="<?php echo $fullurl; ?>images/holiday1.png" alt=""> Holidays</a> 
    <a href="<?php echo $fullurl; ?>cabs" <?php if($selectedpage=='cabs'){ ?>class="active"<?php } ?>><img src="<?php echo $fullurl; ?>images/carb.png" alt=""> Cabs</a> 
    <a href="<?php echo $fullurl; ?>about-us"><img src="<?php echo $fullurl; ?>images/about1.png" alt=""> About</a>
    <a href="<?php echo $fullurl; ?>terms-conditions"><img src="<?php echo $fullurl; ?>images/terms1.png" alt=""> Terms & conditions</a>
    <a href="<?php echo $fullurl; ?>privacy-policy"><img src="<?php echo $fullurl; ?>images/privacy1.png" alt=""> Privacy Policy</a> 
    <a href="<?php echo $fullurl; ?>contact-us"><img src="<?php echo $fullurl; ?>images/contact1.png" alt=""> Contact</a> 
          </div>
		  
		  <?php } else { ?>
	<div class="alltabslist">
	
	<a onClick="openWindow('<?php echo $fullurl; ?>about-us');"><img src="<?php echo $fullurl; ?>images/about1.png" alt=""> About</a>
	<a onClick="openWindow('<?php echo $fullurl; ?>terms-conditions');" ><img src="<?php echo $fullurl; ?>images/terms1.png" alt=""> Terms & conditions</a>
	<a onClick="openWindow('<?php echo $fullurl; ?>privacy-policy');" ><img src="<?php echo $fullurl; ?>images/privacy1.png" alt=""> Privacy Policy</a> 
	<a onClick="openWindow('<?php echo $fullurl; ?>contact-us');"><img src="<?php echo $fullurl; ?>images/contact1.png" alt=""> Contact</a> 
		<?php  if($LoginUserDetails['userType']=='agent' || $LoginUserDetails['userType']=='client'){ ?>
	<a href="logoutpage.php" style="color:#CC3300;">Logout My Account</a> 
	<?php } ?>
          </div>
		  <?php } ?>
		  
		  
  </div>
  </div>
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
 

    <div id="logo"><a href="<?php echo $fullurl; ?>"><img src="<?php echo $profilepic; ?><?php echo $websitesetting['websiteLogo']; ?>"></a></div>
<?php if($_SESSION['agentUserid']!=''){ ?>
    <div id="menu">
 

    <a href="<?php echo $fullurl; ?>flights" <?php if($selectedpage=='flights'){ ?>class="active"<?php } ?>><i class="fa fa-plane" aria-hidden="true"></i> Flights</a>

    <a href="<?php echo $fullurl; ?>hotels" <?php if($selectedpage=='hotels'){ ?>class="active"<?php } ?>><i class="fa fa-building" aria-hidden="true"></i> Hotels</a>
 
    <a href="<?php echo $fullurl; ?>holidays" <?php if($selectedpage=='holidays'){ ?>class="active"<?php } ?>><i class="fa fa-suitcase" aria-hidden="true"></i> Holidays</a>  

    </div>
	<?php } ?>

    
	<div class="supportmenu"><strong>Call Us:</strong> <?php echo stripslashes($getlogo['phone']); ?></div>

    <?php if($_SESSION['agentUserid']!=''){ ?>
	
	

    <div id="rightmenu"> 
    <div class="pricedropdownflex">
    
  <div class="main2">
    <input type="checkbox" id="drop-1" hidden>
    <label class="dropHeader dropHeader-1" for="drop-1"><?php echo $_SESSION['currency']; ?> <i class="fa fa-sort-desc" aria-hidden="true" style="position:relative; top: -3px;"></i></label>

    <div class="list2 list-1" style="background-color: #fff;border-radius: 5px">
 <?php   
               $rs=GetPageRecord('*','currencyExchangeMaster',' 1 order by name asc'); 
               while($rest=mysqli_fetch_array($rs)){  
               ?> 
      <div class="listofinr" onclick="$('#currency').val('<?php echo $rest['name']; ?>');$('#formidscurrency').submit();"><p><?php echo $rest['name']; ?></p> <img src="<?php echo $imgurl; ?><?php echo $rest['flagImg']; ?>" alt=""></div> 
<?php } ?>
    </div>
</div>
  
 
    <div class="dropdown"> <a href="<?php echo $fullurl; ?>web-check-in" target="_blank"><button class="btn btn-secondary mainbutton greenbtn"  type="button"  >

  
        <i class="fa fa-paper-plane" aria-hidden="true"></i>&nbsp;  Web Check-In

      </button></a>
	<?php  if($LoginUserDetails['userType']=='agent' || $LoginUserDetails['userType']=='client'){ ?>

      <button class="btn btn-secondary dropdown-toggle mainbutton " style="display:block !important;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

        <span style="float:left;"><i class="fa fa-user" aria-hidden="true"></i>

        </span>Account

      </button> 
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
	<?php  if($LoginUserDetails['userType']=='agent'){ ?>
         <a class="dropdown-item" href="<?php echo $fullurl; ?>balance-sheet" style="background-color: #00000080 !important; color: #fff;"><i class="fa fa-credit-card-alt" aria-hidden="true"></i> Balance: &#8377;<?php echo round($totalwalletBalance); ?></a>

        <a class="dropdown-item" href="<?php echo $fullurl; ?>my-profile"><i class="fa fa-id-card-o" aria-hidden="true"></i> Corporate Id: <?php echo ($LoginUserDetails['agentId']); ?></a>
			 
		 
			<a class="dropdown-item" href="<?php echo $fullurl; ?>dashboard"><i class="fa fa-home" aria-hidden="true"></i> Dashboard</a>
			<?php } ?>
		
		
        <a class="dropdown-item" href="<?php echo $fullurl; ?>flight-bookings"><i class="fa fa-list" aria-hidden="true"></i> Bookings</a>

        <a class="dropdown-item" href="<?php echo $fullurl; ?>flight-bookings-invoice"><i class="fa fa-file" aria-hidden="true"></i> Invoices</a>

			<?php if($LoginUserDetails['userType']=='agent'){ ?>
        <a class="dropdown-item" href="<?php echo $fullurl; ?>balance-sheet"><i class="fa fa-money" aria-hidden="true"></i> Balance Sheet</a>

        <a class="dropdown-item" href="<?php echo $fullurl; ?>topup-recharge"><i class="fa fa-retweet" aria-hidden="true"></i> Credit Pool Recharge</a>

        <a class="dropdown-item d-none" href="<?php echo $fullurl; ?>topup-request"><i class="fa fa-cloud-upload" aria-hidden="true"></i> Top Up Request</a>

        <a class="dropdown-item d-none" href="<?php echo $fullurl; ?>my-customer"><i class="fa fa-users" aria-hidden="true"></i> My Employees</a>
		<?php } ?>

        <a class="dropdown-item" href="<?php echo $fullurl; ?>my-profile"><i class="fa fa-user" aria-hidden="true"></i> My Profile</a>

        <a class="dropdown-item" href="<?php echo $fullurl; ?>settings"><i class="fa fa-cog" aria-hidden="true"></i> Settings</a>

        <a class="dropdown-item" href="<?php echo $fullurl; ?>logout"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>

      </div>

	  
	  <?php } else {  ?><a href="<?php echo $fullurl; ?>login"><button class="btn btn-secondary mainbutton greenbtn"  type="button"  >

        Corporate Login

      </button></a>
	  
	  

	  <?php } ?>
	  
	  <form method="Post" id="formidscurrency" action="" style="position: absolute;right: 316px; top: 10px; display:none; ">
         <select name="currency" id="currency" class="currencyfield currencydrop"  onchange="$('#formidscurrency').submit();">
            <?php   
               $rs=GetPageRecord('*','currencyExchangeMaster',' 1 order by name asc'); 
               while($rest=mysqli_fetch_array($rs)){  
               ?> 
            <option value="<?php echo $rest['name']; ?>" <?php if($_SESSION['currency']==$rest['name']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>
            <?php }  ?>
         </select>
      </form>
    </div>
    </div>
</div>

<?php } ?>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>