<?php include "websiteinc.php";
$a=GetPageRecord('*','websiteDestination','id="'.decode($_REQUEST['id']).'"'); 
$pageContent=mysqli_fetch_array($a); 

if($pageContent['id']==''){
echo 'Nothing Found';
exit();
}
 ?>

<!doctype html>
<html lang="en">
    
<head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
      <title><?php echo stripslashes($pageContent['name']); ?> - <?php echo stripslashes($WebsiteSettingDetails['companyName']); ?></title>
	  
<meta name="Description" content="<?php echo stripslashes($pageContent['name']); ?>" /> 
	<meta name="keywords" content="<?php echo stripslashes($pageContent['name']); ?>">

	  
	  <?php include "websiteheaderinc.php"; ?>
 
   </head>
   <body>

			 
      <div id="page" class="full-page">
          <?php include "websiteheader.php"; ?>
       
	 
         <main id="content" class="site-main">
		 
		 <section class="inner-banner-wrap">
               <div class="inner-baner-container" style="background-image: url(<?php echo $contenturl; ?>package_image/<?php echo stripslashes($pageContent['photo']); ?>);">
                  <div class="container">
                     <div class="inner-banner-content">
                        <h1 class="inner-title">About <?php echo stripslashes($pageContent['name']); ?></h1>
                     </div>
                  </div>
               </div>
               <div class="inner-shape"></div>
            </section>
          
		  
		  
		  <div class="about-service-wrap">
                  <div class="container">
                     <div class="accordion" id="accordionOne" style="margin-bottom:20px;">
					 
					 <?php
$a = GetPageRecord('*','websiteAboutDestination','status="1" and destinationId="'.$pageContent['id'].'" order by id desc ');
while($posts = mysqli_fetch_array($a)){
$n=1;
?>	

                                 <div class="card">
                                    <div class="card-header" id="headingOne">
                                       <h4 class="mb-0">
                                          <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne<?php echo stripslashes($posts['id']); ?>" aria-expanded="true" aria-controls="collapseOne">
                                           <i class="fas fa-map-marker-alt"></i> <?php echo stripslashes($posts['name']); ?>
                                          </button>
                                       </h4>
                                    </div>
                                    <div id="collapseOne<?php echo stripslashes($posts['id']); ?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionOne">
                                       <div class="card-body">
                                        <?php if($posts["photo"]!=''){ ?><img src="<?php echo $contenturl; ?>package_image/<?php echo stripslashes($posts["photo"]); ?>" alt="<?php echo stripslashes($posts["name"]); ?>" class="aboutdestinationimg"><?php } ?>
										
										<?php echo nl2br(stripslashes($posts['description'])); ?>
                                       </div>
                                    </div>
                                 </div>
                                  
                                  <?php } ?>
								  
								  <?php if($n!=1){ ?><div style="padding:20px; text-align:center; font-size:30px;"><h2 style="font-weight:800;">Coming Soon</h2></div><?php } ?>
                                  
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