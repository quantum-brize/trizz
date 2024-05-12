<?php include "websiteinc.php";
 
 ?>

<!doctype html>
<html lang="en">
    
<head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
      <title>Contact - <?php echo stripslashes($WebsiteSettingDetails['companyName']); ?></title>
	  
 

	  
	  <?php include "websiteheaderinc.php"; ?>
 
   </head>
   <body>

			 
      <div id="page" class="full-page">
          <?php include "websiteheader.php"; ?>
       
	 
         <main id="content" class="site-main">
		 
		 <section class="inner-banner-wrap">
               <div class="inner-baner-container" style="background-image: url(<?php echo $fullurl; ?>assets/contact-banner.jpg);">
                  <div class="container">
                     <div class="inner-banner-content">
                        <h1 class="inner-title">Contact</h1>
                     </div>
                  </div>
               </div>
               <div class="inner-shape"></div>
            </section>
          
		  
		  
		  <div class="contact-page-section">
               <div class="contact-form-inner">
                  <div class="container">
                     <div class="row">
                        <div class="col-md-6">
                           <div class="contact-from-wrap">
                              <div class="section-heading">
                                 <h5 class="dash-style">GET IN TOUCH</h5>
                                 <h2>CONTACT US TO GET MORE INFO</h2>
                                 <p>Fill the form and send us your message</p>
                              </div>
							  	<?php if(isset($_REQUEST["s"])){ ?>
						<p class="text-red font-size-15 font-weight-bold mb-5 pb-xl-2" style="color:#CC3300;">Thank you for contacting us!! <br>
One of our executive will contact you shortly.</p>
						<?php } ?>
                               <form class="js-validate" method="POST" action="sendMail.php">
							   <input name="action" type="hidden" value="feedback"> 
                            <div class="row">
                                <!-- Input -->
                                <div class="col-sm-12 mb-2">
                                    <div class="js-form-message">
                                        <input type="text" class="form-control" name="name" placeholder="Name" aria-label="Jack Wayley" required="required" data-error-class="u-has-error" data-msg="Please enter your name." data-success-class="u-has-success">
                                    </div>
                                </div>
                                <!-- End Input -->

                                <!-- Input -->
                                <div class="col-sm-12 mb-2">
                                    <div class="js-form-message">
                                        <input type="email" class="form-control" name="email" placeholder="Email" aria-label="jackwayley@gmail.com" required="required" data-msg="Please enter a valid email address." data-error-class="u-has-error" data-success-class="u-has-success">
                                    </div>
                                </div>
                                <!-- End Input -->
								
								<!-- Input -->
                                <div class="col-sm-12 mb-2">
                                    <div class="js-form-message">
                                        <input type="text" class="form-control" name="number" placeholder="Mobile" aria-label="+919910402252" required="required" data-error-class="u-has-error" data-msg="Please enter your contact number." data-success-class="u-has-success">
                                    </div>
                                </div>
                                
								
                                <div class="col-sm-12 mb-2">
                                    <div class="js-form-message">
                                        <div class="input-group">
                                            <textarea class="form-control" rows="4" cols="77" name="text" placeholder="Message" aria-label="Hi there, I would like to ..." required="" data-msg="Please enter a reason." data-error-class="u-has-error" data-success-class="u-has-success"></textarea>
                                        </div>
                                    </div>
                                </div>
                                   <div class="col-sm-12 mb-2">    <!-- End Input -->
                                <input type="submit" name="submit" value="SEND MESSAGE">
								</div>
                            </div>
                        </form>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="contact-detail-wrap">
                              <h3 style="font-weight:600;">Need help ? Feel free to contact us !</h3>
                               
                               
                              <div class="details-list">
                                 <ul>
                                    <li>
                                       <span class="icon">
                                          <i class="fas fa-map-signs"></i>
                                       </span>
                                       <div class="details-content">
                                          <h4>Location Address</h4>
                                          <span><?php echo stripslashes($WebsiteSettingDetails['contactAddress']); ?></span>
                                       </div>
                                    </li>
                                    <li>
                                       <span class="icon">
                                          <i class="fas fa-envelope-open-text"></i>
                                       </span>
                                       <div class="details-content">
                                          <h4>Email Address</h4>
                                          <span><a href="mailto:<?php echo stripslashes($WebsiteSettingDetails['contactEmail']); ?>"><?php echo stripslashes($WebsiteSettingDetails['contactEmail']); ?></a></span>
                                       </div>
                                    </li>
                                    <li>
                                       <span class="icon">
                                          <i class="fas fa-phone-volume"></i>
                                       </span>
                                       <div class="details-content">
                                          <h4>Phone Number</h4>
                                          <span>Telephone: <?php echo stripslashes($WebsiteSettingDetails['contactPhone']); ?></span>
                                       </div>
                                    </li>
                                 </ul>
                              </div>
                              <div class="contct-social social-links">
                                 <h3 style="font-weight:600;">Follow us on social media..</h3>
                                 <ul>
                                     <?php if($WebsiteSettingDetails['facebookURL']!=''){ ?><li><a href="<?php echo stripslashes($WebsiteSettingDetails['facebookURL']); ?>"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li><?php } ?>
                                     <?php if($WebsiteSettingDetails['twitterURL']!=''){ ?><li><a href="<?php echo stripslashes($WebsiteSettingDetails['twitterURL']); ?>"><i class="fab fa-twitter" aria-hidden="true"></i></a></li><?php } ?>
                                     <?php if($WebsiteSettingDetails['instagramURL']!=''){ ?><li><a href="<?php echo stripslashes($WebsiteSettingDetails['instagramURL']); ?>"><i class="fab fa-instagram" aria-hidden="true"></i></a></li><?php } ?>
                                     <?php if($WebsiteSettingDetails['youtubeURL']!=''){ ?><li><a href="<?php echo stripslashes($WebsiteSettingDetails['youtubeURL']); ?>"><i class="fab fa-youtube" aria-hidden="true"></i></a></li><?php } ?>
                                 </ul>
                              </div>
                           </div>
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