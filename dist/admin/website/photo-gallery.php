<?php include "websiteinc.php";
 
 ?>

<!doctype html>
<html lang="en">
    
<head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
      <title>Photo Gallery - <?php echo stripslashes($WebsiteSettingDetails['companyName']); ?></title>
	  
 

	  
	  <?php include "websiteheaderinc.php"; ?>
	  <style>
	  figure { margin: 0 0 0rem; }
	  </style>
 
   </head>
   <body>

			 
      <div id="page" class="full-page">
          <?php include "websiteheader.php"; ?>
       
	 
         <main id="content" class="site-main">
		 
		 <section class="inner-banner-wrap">
               <div class="inner-baner-container" style="background-image: url(<?php echo $fullurl; ?>assets/inner-banner.jpg);">
                  <div class="container">
                     <div class="inner-banner-content">
                        <h1 class="inner-title">Photo Gallery</h1>
                     </div>
                  </div>
               </div>
               <div class="inner-shape"></div>
            </section>
          
		  
		  
		   <div class="gallery-section">
               <div class="container">
                  <div class="gallery-outer-wrap">
                     <div class="gallery-inner-wrap gallery-container grid">
					 
					 				  <?php
$a = GetPageRecord('*','websitePhotoGallery','status="1" order by id desc');
while($posts = mysqli_fetch_array($a)){
?>	
                        <div class="single-gallery grid-item">
                           <figure class="gallery-img">
                              <img src="<?php echo $contenturl; ?>package_image/<?php echo stripslashes($posts['photo']); ?>" alt="<?php echo stripslashes($posts['name']); ?>">
                              <div class="gallery-title">
                                 <h3>
                                    <a href="<?php echo $contenturl; ?>package_image/<?php echo stripslashes($posts['photo']); ?>" data-lightbox="lightbox-set">
                                       <?php echo stripslashes($posts['name']); ?>
                                    </a>
                                 </h3>
                              </div>
                           </figure>
                        </div>
                          <?php } ?>
                         
                         
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