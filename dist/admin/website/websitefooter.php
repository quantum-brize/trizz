  <footer id="colophon" class="site-footer footer-primary">
            <div class="top-footer">
               <div class="container">
                  <div class="row">
                     
                     <div class="col-lg-4 col-md-6">
                        <aside class="widget widget_text">
                           <h3 class="widget-title">CONTACT INFORMATION</h3>
                           <div class="textwidget widget-text">
                              <ul>
                                 <li>
                                    <a href="tel:<?php echo stripslashes($WebsiteSettingDetails['contactPhone']); ?>"><i class="fas fa-phone-alt"></i> <?php echo stripslashes($WebsiteSettingDetails['contactPhone']); ?></a>
                                 </li>
                                 <li>
                                    <a href="mailto:<?php echo stripslashes($WebsiteSettingDetails['contactEmail']); ?>"><i class="fas fa-envelope"></i> <?php echo stripslashes($WebsiteSettingDetails['contactEmail']); ?></a>
                                 </li>
                                 <li>
                                    <i class="fas fa-map-marker-alt"></i>
                                   <?php echo stripslashes($WebsiteSettingDetails['contactAddress']); ?>
                                 </li>
                              </ul>
                           </div>
                        </aside>
                     </div>
                     <div class="col-lg-3 col-md-6">
                        <aside class="widget widget_text">
                           <h3 class="widget-title">
                              Company
                           </h3>
                           <div class="textwidget widget-text">
                              <ul>
                                 <li>
  <a href="<?php echo $fullurl; ?>">Home</a></li>
  <li><a href="<?php echo $fullurl; ?>packages">Tours</a></li>
  <li><a href="<?php echo $fullurl; ?>photo-gallery">Photo Gallery</a></li>
  <li><a href="<?php echo $fullurl; ?>blog">Blog</a></li>
  <li><a href="<?php echo $fullurl; ?>pages/terms-of-use">Terms of Use</a></li>
  <li><a href="<?php echo $fullurl; ?>pages/privacy-policy">Privacy Policy</a></li>
  <li><a href="<?php echo $fullurl; ?>contact">Contact Us</a>
                                 </li>
                                  
                                  
                              </ul>
                           </div>
                            
                        </aside>
                     </div>
                     <div class="col-lg-3 col-md-6">
                        <aside class="widget widget_text">
                           <h3 class="widget-title">
                              Our Services
                           </h3>
                           <div class="textwidget widget-text">
                              <ul>
                                 <li>
								 <?php 
$am=GetPageRecord('*','cmsPages',' status=1 and pageType="Services" order by id asc'); 
while($resData=mysqli_fetch_array($am)){
?>
  						<li><a href="<?php echo $fullurl; ?>pages/<?php echo stripslashes($resData['url']); ?>"><?php echo stripslashes($resData['name']); ?></a></li> 
						<?php } ?>
                                  
                                  
                                  
                              </ul>
                           </div>
                            
                        </aside>
                     </div>
					 <div class="col-lg-2 col-md-6">
                        <aside class="widget widget_text">
                           <h3 class="widget-title">
                              Destinations
                           </h3>
                           <div class="textwidget widget-text">
                              <ul>
                                 <li>
								 <?php 
$am=GetPageRecord('*','websiteDestination',' status=1  order by  rand() limit 0,6'); 
while($resData=mysqli_fetch_array($am)){
?>
  						<li><a href="<?php echo $fullurl; ?>destination/<?php echo encode($resData['id']); ?>/<?php echo seo_friendly_url($resData['name']); ?>"><?php echo stripslashes($resData['name']); ?></a></li> 
						<?php } ?>
                                  
                                  
                                  
                              </ul>
                           </div>
                            
                        </aside>
                     </div>
                  </div>
               </div>
            </div>
            <div class="buttom-footer">
               <div class="container">
                  <div class="row align-items-center">
                     <div class="col-md-5">
                        <div class="footer-menu">
                           Copyright &copy; <?php echo date('Y'); ?> <?php echo stripslashes($WebsiteSettingDetails['companyName']); ?> <?php echo date('Y'); ?>. All rights reserveds                        </div>
                     </div>
                      
                     <div class="col-md-7">
                        <div class="copy-right text-right">Developed by <a href="https://www.travbizz.com" target="_blank">travBizz</a> </div>
                     </div>
                  </div>
               </div>
            </div>
         </footer>
         <a id="backTotop" href="#" class="to-top-icon">
            <i class="fas fa-chevron-up"></i>
         </a>
         <!-- custom search field html -->
            <div class="header-search-form">
               <div class="container">
                  <div class="header-search-container">
                     <form class="search-form" role="search" method="get" >
                        <input type="text" name="s" placeholder="Enter your text...">
                     </form>
                     <a href="#" class="search-close">
                        <i class="fas fa-times"></i>
                     </a>
                  </div>
               </div>
            </div>
         <!-- header html end -->