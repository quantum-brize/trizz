<?php include "websiteinc.php"; ?>

<!doctype html>
<html lang="en">
    
<head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
      <title><?php echo stripslashes($WebsiteSettingDetails['metaTitle']); ?></title>
	  
<meta name="Description" content="<?php echo stripslashes($WebsiteSettingDetails['metaDesctiption']); ?>" /> 
	<meta name="keywords" content="<?php echo stripslashes($WebsiteSettingDetails['metaKeyword']); ?>">

	  
	  <?php include "websiteheaderinc.php"; ?>
	  
   </head>
   <body class="home">
       
      <div id="page" class="full-page">
          <?php include "websiteheader.php"; ?>
         <main id="content" class="site-main">
            <!-- Home slider html start -->
            <section class="home-slider-section">
               <div class="home-slider">
				<?php   
				$rs=GetPageRecord('*','homeBanner',' status=1  order by id asc'); 
				while($restbanner=mysqli_fetch_array($rs)){  
				?>  
                  <div class="home-banner-items">
                     <div class="banner-inner-wrap" style="background-image: url(<?php echo $contenturl; ?>package_image/<?php echo stripslashes($restbanner['photo']); ?>);"></div>
                        <div class="banner-content-wrap">
                           <div class="container">
                              <div class="banner-content text-center">
                                 <h2 class="banner-title"><?php echo stripslashes($restbanner['name']); ?></h2> 
                                  
                              </div>
                           </div>
                        </div>
                     <div class="overlay"></div>
                  </div>
				 <?php } ?>
                   
               </div>
            </section>
            <!-- slider html start -->
            <!-- Home search field html start -->
             <form method="get" name="searchformpackage" action="packages"  > <div class="trip-search-section shape-search-section">
               <div class="slider-shape"></div>
               <div class="container" style="    max-width: 760px;">
              <div class="row trip-search-inner white-bg" style="    padding: 20px;" >
                       <div class="col-lg-5"> 
					 <div class=" ">
                        <label> Theme </label>
                        <select name="theme" class="theme" onChange="$('#searchformpackage').submit();" style="width:100%; "  >
								 <option value="" <?php if(''==$themeres["id"]){ ?>selected="selected"<?php } ?>>All Theme</option> 
								<?php
								$theme = GetPageRecord('*','websitePackageTheme','status="1" order by  name');
								while($themeres = mysqli_fetch_array($theme)){ ?>
								<option value="<?php echo encode($themeres["id"]); ?>" <?php if(decode($_REQUEST['theme'])==$themeres["id"]){ ?>selected="selected"<?php } ?>><?php echo stripslashes($themeres["name"]); ?></option> 
								<?php } ?>
                                 </select>
                     </div>
                      </div>
                      
					  <div class="col-lg-5"> 
					 <div class=" ">
                        <label> Destination</label>
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
					  
                        <div class="col-lg-2"> 
                     <div class=" ">
                        <label class="screen-reader-text"> Search </label>
                        <input type="submit" name="travel-search" value="Search">
                     </div>
					 </div>
                  </div>
               </div>
            </div></form>
            <!-- search search field html end -->
            <section class="destination-section">
               <div class="container">
			   <div class="section-heading text-center">
                     <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                           <h5 class="dash-style">POPULAR DESTINATION</h5>
                           <h2>TOP DESTINATION</h2>
                           
                        </div>
                     </div>
                  </div>
			   
			   
                   
				  
				  <?php
$a=GetPageRecord('photo,name,id','websiteDestination','1 order by rand()'); 
$destinationone=mysqli_fetch_array($a); 

$a=GetPageRecord('photo,name,id','websiteDestination','1 and id!="'.$destinationone['id'].'" order by rand()'); 
$destinationtwo=mysqli_fetch_array($a); 

$a=GetPageRecord('photo,name,id','websiteDestination','1 and id!="'.$destinationtwo['id'].'" and  id!="'.$destinationone['id'].'" order by rand()'); 
$destinationthree=mysqli_fetch_array($a); 

$a=GetPageRecord('photo,name','websiteDestination','1 and id!="'.$destinationthree['id'].'" and  id!="'.$destinationone['id'].'" and  id!="'.$destinationtwo['id'].'" order by rand()'); 
$destinationfour=mysqli_fetch_array($a); 
?>
				  
                  <div class="destination-inner destination-three-column">
                     <div class="row">
                        <div class="col-lg-7">
                           <div class="row">
                              <div class="col-sm-6">
                                 <div class="desti-item overlay-desti-item">
                                    <figure class="desti-image homedestione">
                                       <img src="<?php echo $contenturl; ?>package_image/<?php echo stripslashes($destinationone["photo"]); ?>" alt="<?php echo stripslashes($destinationone["name"]); ?>">
                                    </figure>
                                     
                                    <div class="desti-content">
                                       <h3>
                                          <a href="<?php echo $fullurl; ?>packages?destination=<?php echo stripslashes($destinationone["name"]); ?>"><?php echo stripslashes($destinationone["name"]); ?></a>
                                       </h3>
                                        
                                    </div>
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <div class="desti-item overlay-desti-item">
                                    <figure class="desti-image homedestione" >
                                       <img src="<?php echo $contenturl; ?>package_image/<?php echo stripslashes($destinationtwo["photo"]); ?>" alt="<?php echo stripslashes($destinationtwo["name"]); ?>">
                                    </figure>
                                     
                                    <div class="desti-content">
                                       <h3>
                                          <a href="<?php echo $fullurl; ?>packages?destination=<?php echo stripslashes($destinationone["name"]); ?>"><?php echo stripslashes($destinationtwo["name"]); ?></a>
                                       </h3>
                                        
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-5">
                           <div class="row">
                              <div class="col-md-6 col-xl-12">
                                 <div class="desti-item overlay-desti-item">
                                    <figure class="desti-image homedestitwo">
                                       <img src="<?php echo $contenturl; ?>package_image/<?php echo stripslashes($destinationthree["photo"]); ?>" alt="<?php echo stripslashes($destinationthree["name"]); ?>">
                                    </figure>
                                     
                                    <div class="desti-content">
                                       <h3>
                                          <a href="<?php echo $fullurl; ?>packages?destination=<?php echo stripslashes($destinationone["name"]); ?>"><?php echo stripslashes($destinationthree["name"]); ?></a>
                                       </h3>
                                        
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6 col-xl-12">
                                 <div class="desti-item overlay-desti-item">
                                    <figure class="desti-image homedestitwo">
                   <img src="<?php echo $contenturl; ?>package_image/<?php echo stripslashes($destinationfour["photo"]); ?>" alt="<?php echo stripslashes($destinationfour["name"]); ?>">
                                    </figure>
                                     
                                    <div class="desti-content">
                                       <h3>
                                 <a href="<?php echo $fullurl; ?>packages?destination=<?php echo stripslashes($destinationone["name"]); ?>"><?php echo stripslashes($destinationfour["name"]); ?></a>
                                       </h3>
                                        
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                      
                  </div>
               </div>
            </section>
            <!-- Home packages section html start -->
            <section class="package-section">
               <div class="container">
                  <div class="section-heading text-center">
                     <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                           <h5 class="dash-style">EXPLORE GREAT PLACES</h5>
                           <h2>POPULAR PACKAGES</h2>
                           <p>Our most popular packages for you</p>
                        </div>
                     </div>
                  </div>
                  <div class="package-inner">
                     <div class="row">
					 <?php 
$a = GetPageRecord('*','sys_packageBuilder','showwebsite=1 and websiteCost>0 and websiteValidity>"'.date('Y-m-d').'" and showinPopular=1 order by rand() limit 0,3');
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
  <?php } ?>
                     </div>
                     <div class="btn-wrap text-center">
                        <a href="<?php echo $fullurl; ?>packages" class="button-primary">VIEW ALL PACKAGES</a>
                     </div>
                  </div>
               </div>
            </section>
            <!-- packages html end -->
            <!-- Home callback section html start -->
			
<?php
$a=GetPageRecord('*','cmsPages','id=12'); 
$HomeAboutDetails=mysqli_fetch_array($a); 
?>
            <section class="callback-section">
               <div class="container">
                  <div class="row no-gutters align-items-center">
                     <div class="col-lg-5">
                        <div class="callback-img" style="background-image: url(<?php echo $contenturl; ?>package_image/<?php echo stripslashes($HomeAboutDetails["photo"]); ?>);">
                            
                        </div>
                     </div>
                     <div class="col-lg-7">
                        <div class="callback-inner">
                           <div class="section-heading section-heading-white"> 
                              <h2><?php echo stripslashes($HomeAboutDetails['name']); ?></h2>
                              <div class="whitecontent"><?php echo strip_tags(stripslashes($HomeAboutDetails['description'])); ?></div>
                           </div>
                            
                           <div class="support-area">
                              <div class="support-icon">
                                 <img src="assets/images/icon5.png" alt="">
                              </div>
                              <div class="support-content">
                                 <h4>Our 24/7 Emergency Phone Services</h4>
                                 <h3>
                                    <a href="tel:<?php echo stripslashes($WebsiteSettingDetails['contactPhone']); ?>">Call: <?php echo stripslashes($WebsiteSettingDetails['contactPhone']); ?></a>
                                 </h3>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
            <!-- callback html end -->
            <!-- Home activity section html start -->
            <section class="activity-section">
               <div class="container">
                  <div class="section-heading text-center">
                     <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                           <h5 class="dash-style">TRAVEL BY THEME</h5>
                           <h2 style="text-transform:uppercase;">Themes You Can Explore</h2>
                           
                        </div>
                     </div>
                  </div>
                  <div class="activity-inner row">
                   
				    <?php
$theme = GetPageRecord('*','websitePackageTheme','status="1" order by  name');
while($themeres = mysqli_fetch_array($theme)){

$c=GetPageRecord('count(id) as totalpackages','sys_packageBuilder','showwebsite=1 and websiteCost>0 and websiteValidity>"'.date('Y-m-d').'" and packageThemeId="'.$themeres['id'].'"'); 
$totalpackagestheme=mysqli_fetch_array($c); 
?>	
				     <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="activity-item">
                           <div class="activity-icon">
                              <a href="<?php echo $fullurl; ?>packages?theme=<?php echo encode($themeres["id"]); ?>">
                                 <img src="<?php echo $contenturl; ?>package_image/<?php echo stripslashes($themeres["photo"]); ?>" alt="<?php echo stripslashes($themeres["name"]); ?>" style="height: 100px;">
                              </a>
                           </div>
                           <div class="activity-content">
                              <h4>
                                 <a href="<?php echo $fullurl; ?>packages?theme=<?php echo encode($themeres["id"]); ?>" style=" font-size: 18px;"><?php echo stripslashes($themeres["name"]); ?></a>
                              </h4>
                              <p  style=" font-size: 14px;"><?php echo $totalpackagestheme['totalpackages']; ?> Packages</p>
                           </div>
                        </div>
                     </div>
                       <?php } ?>
                      
                  </div>
               </div>
            </section>
            <!-- activity html end -->
            <!-- Home special section html start -->
            <section class="special-section">
               <div class="container">
                  <div class="section-heading text-center">
                     <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                           <h5 class="dash-style">TRAVEL OFFER & DISCOUNT</h5>
                           <h2>SPECIAL PACKAGES</h2>
                           <p>Planning a holiday in next few days or months? Avail these discounts</p>
                        </div>
                     </div>
                  </div>
                  <div class="special-inner">
                       <div class="row">
					 <?php 
$a = GetPageRecord('*','sys_packageBuilder','showwebsite=1 and websiteCost>0 and websiteValidity>"'.date('Y-m-d').'" and showinSpecial=1 order by rand() limit 0,3');
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
  <?php } ?>
                     </div>
                  </div>
               </div>
            </section>
            <!-- special html end -->
            <!-- Home special section html start -->
            <section class="best-section" style="padding-bottom: 0px">
               <div class="container">
                  <div class="row">
                     <div class="col-lg-5">
                        <div class="section-heading">
                           <h5 class="dash-style">OUR TOUR GALLERY</h5>
<?php
$a=GetPageRecord('name,description','cmsPages','id=13'); 
$photogallerytext=mysqli_fetch_array($a);
?>
                           <h2><?php echo stripslashes($photogallerytext["name"]); ?></h2>
                           <p><div class="gallerytext"><?php echo strip_tags(stripslashes($photogallerytext["description"])); ?></div></p>
                        </div>
<?php
$a=GetPageRecord('photo,name,id','websitePhotoGallery','1 order by rand()'); 
$photoone=mysqli_fetch_array($a); 

$a=GetPageRecord('photo,name,id','websitePhotoGallery','1 and id!="'.$photoone['id'].'" order by rand()'); 
$phottwo=mysqli_fetch_array($a); 

$a=GetPageRecord('photo,name,id','websitePhotoGallery','1 and id!="'.$phottwo['id'].'" and  id!="'.$photoone['id'].'" order by rand()'); 
$photthree=mysqli_fetch_array($a); 

$a=GetPageRecord('photo,name','websitePhotoGallery','1 and id!="'.$photthree['id'].'" and  id!="'.$photoone['id'].'" and  id!="'.$phottwo['id'].'" order by rand()'); 
$photfour=mysqli_fetch_array($a); 
?>
						
                        <figure class="gallery-img">
                           <a href="<?php echo $fullurl; ?>photo-gallery"><img src="<?php echo $contenturl; ?>package_image/<?php echo stripslashes($photoone["photo"]); ?>" alt="<?php echo stripslashes($photoone["name"]); ?>" class="homegallery1" ></a>
                        </figure>
                     </div>
                     <div class="col-lg-7">
                        <div class="row">
                           <div class="col-sm-6">
                              <figure class="gallery-img">
                                 <a href="<?php echo $fullurl; ?>photo-gallery"><img src="<?php echo $contenturl; ?>package_image/<?php echo stripslashes($phottwo["photo"]); ?>" alt="<?php echo stripslashes($phottwo["name"]); ?>"  class="homegallery2" ></a>
                              </figure>
                           </div>
                           <div class="col-sm-6">
                              <figure class="gallery-img">
                               <a href="<?php echo $fullurl; ?>photo-gallery"><img src="<?php echo $contenturl; ?>package_image/<?php echo stripslashes($photthree["photo"]); ?>" alt="<?php echo stripslashes($photthree["name"]); ?>"   class="homegallery2"></a>
                              </figure>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-12">
                              <figure class="gallery-img">
							  <a href="<?php echo $fullurl; ?>photo-gallery"><img src="<?php echo $contenturl; ?>package_image/<?php echo stripslashes($photfour["photo"]); ?>" alt="<?php echo stripslashes($photfour["name"]); ?>"  class="homegallery4"></a>
                                 
                              </figure>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
 
            <section class="blog-section">
               <div class="container">
                  <div class="section-heading text-center">
                     <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                           <h5 class="dash-style">FROM OUR BLOG</h5>
                           <h2>OUR RECENT POSTS</h2>
                           <p>Looking for something useful to read about travelling in India? You’ve come to the right place. Join the league of readers who find here detailed insights, interesting travel tips and ideas and daily inspiration.</p>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                  
				  <?php
$a = GetPageRecord('*','websiteBlog','status="1" order by id desc limit 0,3');
while($posts = mysqli_fetch_array($a)){
?>	
				     <div class="col-md-6 col-lg-4">
                        <article class="post">
                           <figure class="feature-image">
                              <a href="<?php echo $fullurl; ?>blog/<?php echo encode($posts['id']); ?>/<?php echo seo_friendly_url(stripslashes($posts['name'])); ?>">
                                 <img src="<?php echo $contenturl; ?>blogphotos/<?php echo stripslashes($posts["photo"]); ?>" alt="<?php echo stripslashes($posts['name']); ?>">
                              </a>
                           </figure>
                           <div class="entry-content" style=" padding-top: 0px;">
                              <h3 style="font-size: 20px;">
                                 <a href="<?php echo $fullurl; ?>blog/<?php echo encode($posts['id']); ?>/<?php echo seo_friendly_url(stripslashes($posts['name'])); ?>"><?php echo stripslashes($posts['name']); ?></a>
                              </h3>
                              <div class="entry-meta">
                                  
                                 <span class="posted-on">
                                    <a href="<?php echo $fullurl; ?>blog/<?php echo encode($posts['id']); ?>/<?php echo seo_friendly_url(stripslashes($posts['name'])); ?>"><?php echo date('j F, Y',strtotime($posts['dateAdded'])); ?></a></span>
                                  </div>
                           </div>
                        </article>
                     </div>
                      <?php } ?>
                      
                  </div>
               </div>
            </section>
             <!-- blog html end -->
             <!-- Home testimonial section html start -->
            <div class="testimonial-section" style="background-image: url(assets/images/img23.jpg);">
               <div class="container">
			   
			   <div class="section-heading text-center">
                     <div class="row">
                        <div class="col-lg-8 offset-lg-2"> 
                           <h2>TESTIMONIALS</h2>
                            <p>What our clients say about us</p>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-lg-10 offset-lg-1">
                        <div class="testimonial-inner testimonial-slider">
                          
						  <?php
$testimonial = GetPageRecord('*','websiteTestimonials','status="1" order by id desc limit 10');
while($testimonial1 = mysqli_fetch_array($testimonial)){
?>	
						   <div class="testimonial-item text-center">
                              <figure class="testimonial-img">
                                 <img src="<?php echo $contenturl; ?>package_image/<?php echo stripslashes($testimonial1["photo"]); ?>" alt="<?php echo stripslashes($testimonial1["name"]); ?>">
                              </figure>
                              <div class="testimonial-content">
                                 <p>" <?php echo stripslashes($testimonial1["description"]); ?> "</p>
                                 <cite>
                                    <?php echo stripslashes($testimonial1["name"]); ?>
                                    <span class="company"><?php echo stripslashes($testimonial1["destinationName"]); ?></span>
                                 </cite>
                              </div>
                           </div>
                            <?php } ?> 
                            
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- testimonial html end -->
            <!-- Home contact details section html start -->
             
            <!--  contact details html end -->
         </main>
		 
		 
		 <?php include "websitefooter.php"; ?>
		 
       
      </div>

      <!-- JavaScript -->
	  <?php include "websitefooterinc.php"; ?>
    
   </body>
 
</html>