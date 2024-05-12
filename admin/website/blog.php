<?php include "websiteinc.php";
 
 ?>

<!doctype html>
<html lang="en">
    
<head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
      <title>Blog - <?php echo stripslashes($WebsiteSettingDetails['companyName']); ?></title>
	  
 

	  
	  <?php include "websiteheaderinc.php"; ?>
 
   </head>
   <body>

			 
      <div id="page" class="full-page">
          <?php include "websiteheader.php"; ?>
       
	 
         <main id="content" class="site-main">
		 
		 <section class="inner-banner-wrap">
               <div class="inner-baner-container" style="background-image: url(<?php echo $fullurl; ?>assets/website-default-inner-banner.jpg);">
                  <div class="container">
                     <div class="inner-banner-content">
                        <h1 class="inner-title">Blog</h1>
                     </div>
                  </div>
               </div>
               <div class="inner-shape"></div>
            </section>
          
		  
		  
		  <div class="about-service-wrap">
                  <div class="container">
                      <div class="row">
					  <div class="col-lg-12 primary right-sidebar">
                           <!-- blog post item html start -->
                           <div class="grid row" >
						   
						   <?php   
				$rs=GetPageRecord('*','websiteBlog',' status=1  order by id desc'); 
				while($rest=mysqli_fetch_array($rs)){  
				?>
                              <div class="grid-item col-md-4" >
                                 <article class="post">
                                    <figure class="feature-image">
                                       <a href="<?php echo $fullurl; ?>blog/<?php echo encode($rest['id']); ?>/<?php echo seo_friendly_url(stripslashes($rest['name'])); ?>">
                                          <img src="<?php echo $contenturl; ?>blogphotos/<?php echo stripslashes($rest['photo']); ?>" alt="<?php echo stripslashes($rest['name']); ?>" class="packagelistimgbox">
                                       </a>
                                    </figure>
                                    <div class="entry-content">
                                       <h3>
                                          <a href="<?php echo $fullurl; ?>blog/<?php echo encode($rest['id']); ?>/<?php echo seo_friendly_url(stripslashes($rest['name'])); ?>"><?php echo stripslashes($rest['name']); ?></a>
                                       </h3>
                                       <div class="entry-meta">
                                           
                                          <span class="posted-on">
                                             <a href="<?php echo $fullurl; ?>blog/<?php echo encode($rest['id']); ?>/<?php echo seo_friendly_url(stripslashes($rest['name'])); ?>"><?php echo date('j F, Y',strtotime($rest['dateAdded'])); ?></a>
                                          </span>
                                           
                                       </div>
                                       <p><?php echo strip_tags(stripslashes($rest['description']),0,200); ?></p>
                                       <a href="<?php echo $fullurl; ?>blog/<?php echo encode($rest['id']); ?>/<?php echo seo_friendly_url(stripslashes($rest['name'])); ?>" class="button-text">CONTINUE READING..</a>
                                    </div>
                                 </article>
                              </div>
							  <?php } ?>
                                
                           </div>
                
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