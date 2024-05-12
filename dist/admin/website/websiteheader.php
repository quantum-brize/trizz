<header id="masthead" class="site-header header-primary">

            <!-- header html start -->

            <div class="top-header">

               <div class="container">

                  <div class="row">

                     <div class="col-lg-8 d-none d-lg-block">

                        <div class="header-contact-info">

                           <ul>

                              <li>

                                 <a href="#"><i class="fas fa-phone-alt"></i> <?php echo stripslashes($WebsiteSettingDetails['contactPhone']); ?></a>

                              </li>

                              <li>

                                 <a href="mailto:<?php echo stripslashes($WebsiteSettingDetails['contactEmail']); ?>"><i class="fas fa-envelope"></i>  <?php echo stripslashes($WebsiteSettingDetails['contactEmail']); ?></a>

                              </li>

                               

                           </ul>

                        </div>

                     </div>

                     <div class="col-lg-4 d-flex justify-content-lg-end justify-content-between">

                        <div class="header-social social-links">

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

            <div class="bottom-header">

               <div class="container d-flex justify-content-between align-items-center">

                  <div class="site-identity">

                     <h1 class="site-title">

                        <a href="<?php echo $fullurl; ?>">

                           <img class="white-logo" src="<?php echo $contenturl; ?>profilepic/<?php echo stripslashes($WebsiteSettingDetails['websiteLogo']); ?>" alt="logo">

                           <img class="black-logo" src="<?php echo $contenturl; ?>profilepic/<?php echo stripslashes($WebsiteSettingDetails['websiteLogo']); ?>" alt="logo">

                        </a>

                     </h1>

                  </div>

                  <div class="main-navigation d-none d-lg-block">

                     <nav id="navigation" class="navigation">

                        <ul>

                           <li>

                              <a href="<?php echo $fullurl; ?>">Home</a> 

                           </li>

						   

						   

						   

						   <li class="menu-item-has-children">

                              <a href="#">Destination</a>

                              <ul> 

							  

							  	  

                                  <?php   

				$rs=GetPageRecord('*','websiteDestination',' status=1  order by name asc'); 

				while($destinationmenu=mysqli_fetch_array($rs)){  

				?>

				

                                 <li class="menu-item-has-children">

                                    <a href="#"><?php echo stripslashes($destinationmenu['name']); ?></a>

                                    <ul>

                                       <li>

                                          <a href="<?php echo $fullurl; ?>about-destination/<?php echo encode($destinationmenu["id"]); ?>/<?php echo seo_friendly_url(stripslashes($destinationmenu['name'])); ?>">About <?php echo stripslashes($destinationmenu['name']); ?></a>

                                       </li> 

                                       <li>

                                          <a href="<?php echo $fullurl; ?>packages?destination=<?php echo stripslashes($destinationmenu['name']); ?>"><?php echo stripslashes($destinationmenu['name']); ?> Packages</a>

                                       </li>

                                    </ul>

                                 </li>

								  		 <?php } ?>

                                  

                                  

                              </ul>

                           </li>

						   

						    

						   

						   

                           <li>

                              <a href="<?php echo $fullurl; ?>packages">Tour Packages</a>

                               

                           </li>

                           <li class="menu-item-has-children">

                              <a href="#">About Us</a>

                              <ul>

							<?php   

							$rs=GetPageRecord('*','cmsPages',' status=1 and pageType="About" order by id asc'); 

							while($aboutmenu=mysqli_fetch_array($rs)){  

							?>

                                 <li>

                                    <a href="<?php echo $fullurl; ?>pages/<?php echo ($aboutmenu["url"]); ?>"><?php echo stripslashes($aboutmenu['name']); ?></a>

                                 </li>

								 <?php } ?>

                                 

                              </ul>

                           </li>

                           <li class="menu-item-has-children">

                              <a href="#">Services</a>

                              <ul>

							<?php   

							$rs=GetPageRecord('*','cmsPages',' status=1 and pageType="Services" order by id asc'); 

							while($aboutmenu=mysqli_fetch_array($rs)){  

							?>

                                 <li>

                                    <a href="<?php echo $fullurl; ?>pages/<?php echo ($aboutmenu["url"]); ?>"><?php echo stripslashes($aboutmenu['name']); ?></a>

                                 </li>

								 <?php } ?>

                                 

                              </ul>

                           </li>

                           <li>

                              <a href="<?php echo $fullurl; ?>blog">Blog</a>

                               

                           </li>   

						   <li>

                              <a href="<?php echo $fullurl; ?>contact">Contact</a>

                               

                           </li>

                            

                        </ul>

                     </nav>

                  </div>

                   

               </div>

            </div>

            <div class="mobile-menu-container"></div>

         </header>