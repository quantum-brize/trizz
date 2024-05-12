<?php include "websiteinc.php";
 
 
$wherestr='';

if($_REQUEST['theme']!=''){
$wherestr.=' and packageThemeId="'.decode($_REQUEST['theme']).'" ';
}

if($_REQUEST['destination']!=''){
$wherestr.=' and destinations like "%'.($_REQUEST['destination']).'%" ';
}

 ?>

<!doctype html>
<html lang="en">
    
<head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
      <title>Tour Packages - <?php echo stripslashes($WebsiteSettingDetails['companyName']); ?></title>
	  
 

	  
	  <?php include "websiteheaderinc.php"; ?>
 
   </head>
   <body>

			 
      <div id="page" class="full-page">
          <?php include "websiteheader.php"; ?>
       
	 
         <main id="content" class="site-main">
		 
		  
          
		  
		  
		  <div class="about-service-wrap">
                  <div class="container">
                      <div class="row">
					  <div class="col-lg-12 primary right-sidebar">
					 <form method="get" name="searchformpackage" id="searchformpackage"> 
					  <div class="product-notices-wrapper" style="margin-top:160px;">
					                <div class="row" style="margin-bottom:30px;">
                              <div class="col-lg-6">  <h2 style="font-weight:800;">Tour Packages</h2></div>
                               <div class="col-lg-3">  
                                 <select name="theme" class="theme" onChange="$('#searchformpackage').submit();" style="width:100%; margin-bottom:10px;"  >
								 <option value="" <?php if(''==$themeres["id"]){ ?>selected="selected"<?php } ?>>All Theme</option> 
								<?php
								$theme = GetPageRecord('*','websitePackageTheme','status="1" order by  name');
								while($themeres = mysqli_fetch_array($theme)){ ?>
								<option value="<?php echo encode($themeres["id"]); ?>" <?php if(decode($_REQUEST['theme'])==$themeres["id"]){ ?>selected="selected"<?php } ?>><?php echo stripslashes($themeres["name"]); ?></option> 
								<?php } ?>
                                 </select> 
                         </div>
						 
						   <div class="col-lg-3">  
                                 <select name="destination" class="destination" onChange="$('#searchformpackage').submit();" style="width:100%;"  >
								 <option value="" <?php if(''==$themeres["id"]){ ?>selected="selected"<?php } ?>>All Destinations</option> 
								<?php
								$theme = GetPageRecord('*','websiteDestination','status="1" order by  name');
								while($themeres = mysqli_fetch_array($theme)){ ?>
								<option value="<?php echo stripslashes($themeres["name"]); ?>" <?php if( ($_REQUEST['destination'])==stripslashes($themeres["name"])){ ?>selected="selected"<?php } ?>><?php echo stripslashes($themeres["name"]); ?></option> 
								<?php } ?>
                                 </select> 
                         </div>
							  </div>
                       </div>
					  
				        </form>
                           <!-- blog post item html start -->
                           <div class="package-inner">
                     <div class="row">
					 <?php 
$a = GetPageRecord('*','sys_packageBuilder','showwebsite=1 and websiteCost>0 and websiteValidity>"'.date('Y-m-d').'" '.$wherestr.' order by id desc');
while($packages = mysqli_fetch_array($a)){ 
?>
                        <div class="col-lg-4 col-md-6">
                           <div class="package-wrap">
                              <figure class="feature-image">
                                 <a href="<?php echo $fullurl; ?>packages/<?php echo encode($packages["id"]); ?>/<?php echo seo_friendly_url(stripslashes($packages['name'])); ?>">
                                    <img src="<?php echo $contenturl; ?>package_image/<?php echo stripslashes($packages["coverPhoto"]); ?>" alt="<?php echo stripslashes($packages["name"]); ?>" class="packagelistimgbox">
                                 </a>
                              </figure>
                              <div class="package-price">
                                 <h6>
                                    <span>&#8377;<?php echo number_format($packages['websiteCost']); ?> </span> / per person
                                 </h6>
                              </div>
                              <div class="package-content-wrap">
                                  
                                 <div class="package-content">
                                    <h3>
                                       <a href="<?php echo $fullurl; ?>packages/<?php echo encode($packages["id"]); ?>/<?php echo seo_friendly_url(stripslashes($packages['name'])); ?>" style="font-size: 15px; font-weight: 600;"><?php echo stripslashes($packages["name"]); ?></a>
                                    </h3>
									<p style="font-size:13px;"><i class="fas fa-map-marker-alt"></i> <?php echo stripslashes($packages["destinations"]); ?></p>
                                     
                                    <div class="btn-wrap">
                                       <a href="<?php echo $fullurl; ?>packages/<?php echo encode($packages["id"]); ?>/<?php echo seo_friendly_url(stripslashes($packages['name'])); ?>" class="button-text width-6"><i class="far fa-clock"></i> <?php echo $packages['days']; ?>D / <?php echo ($packages['days']-1); ?>N</a>
									   
                                       <a href="<?php echo $fullurl; ?>packages/<?php echo encode($packages["id"]); ?>/<?php echo seo_friendly_url(stripslashes($packages['name'])); ?>" class="button-text width-6">View Detail<i class="fas fa-arrow-right"></i></a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div> 
  <?php $n=1; } ?>
  
  
  
                                  
  
                     </div>
                      
                  </div>
                
  <?php if($n!=1){ ?><div style="padding:20px; text-align:center; font-size:30px;"><h2 style="font-weight:800; background-color:#F3F3F3; padding:30px; margin:30px 0px;">No Package Found!</h2></div><?php } ?>
                        </div>
					  </div>
                      
                      
                  </div>
               </div>
         </main>
		 
		 
		 <?php include "websitefooter.php"; ?>
		 
       
      </div>

      <!-- JavaScript -->
	  <?php include "websitefooterinc.php"; ?>
    
   </body>
 
</html>