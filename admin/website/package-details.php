<?php include "websiteinc.php";
$a=GetPageRecord('*','sys_packageBuilder','id="'.decode($_REQUEST['id']).'"'); 
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

    
      <title><?php echo stripslashes($pageContent["name"]); ?> - Packages - <?php echo stripslashes($WebsiteSettingDetails['companyName']); ?></title>
	  
 

	  
	  <?php include "websiteheaderinc.php"; ?>
 
   </head>
   <body>

			 
      <div id="page" class="full-page">
          <?php include "websiteheader.php"; ?>
       
	 
         <main id="content" class="site-main"  style="margin-top:160px;">
		 
		  
          
		  
		  
		  <div class="about-service-wrap">
                  <div class="container">
                     <div class="section-heading">
                        <div class="row"> 
                           <div class="col-lg-8 primary right-sidebar">
                              <div class="single-tour-inner">
                           <h2 style="margin-bottom:20px;"><?php echo stripslashes($pageContent["name"]); ?></h2>
						   
                           <figure class="feature-image">
                              <img src="<?php echo $contenturl; ?>package_image/<?php echo stripslashes($pageContent["coverPhoto"]); ?>" alt="<?php echo stripslashes($pageContent["name"]); ?>" style="width:100%;">
                              <div class="package-meta text-center">
                                 <ul>
                                    <li>
                                       <i class="far fa-clock"></i>
                                       <?php echo $pageContent['days']; ?> Days / <?php echo ($pageContent['days']-1); ?> Nights
                                    </li>
                                    
                                    <li>
                                       <i class="fas fa-map-marked-alt"></i>
                                       <?php echo stripslashes($pageContent["destinations"]); ?>
                                    </li>
                                 </ul>
                              </div>
                           </figure>
                           <div class="tab-container">
                               
                              <div class="tab-content"  style="border: 1px solid #ddd; margin-bottom:10px;">
                                 <div class="tab-pane fade active show">
                                    <div class="overview-content">
									<h4 style="font-weight:800;">Description</h4>
                                       <p><?php echo nl2br(stripslashes($pageContent["aboutPackage"])); ?></p>
                                        
                                    </div>
                                 </div>
                                  
                                  
                                  
                              </div>
							  
							  
							  <div class="tab-content"  style="border: 1px solid #ddd; margin-bottom:10px;">
                                 <div class="tab-pane fade active show">
                                    <div class="overview-content">
									<h4 style="font-weight:800;">Day Wise Itinerary</h4>
                                      <div class="itinerary-timeline-wrap">
                                       <ul>
									   <?php
									   $n=1;
$begin = new DateTime( $pageContent['startDate'] );
$end   = new DateTime( $pageContent['endDate'] );

for($i = $begin; $i <= $end; $i->modify('+1 day')){



$abcde=GetPageRecord('*','sys_packageBuilderEvent',' packageDays="'.$n.'" and packageId="'.$pageContent['id'].'"'); 
$dayDetailsData=mysqli_fetch_array($abcde); 
if($dayDetailsData['daySubject']!=''){
?>
                                          <li>
                                             <div class="timeline-content">
                                                <div class="day-count">Day <span><?php echo $n; ?></span></div>
                                                <h4><?php echo stripslashes($dayDetailsData['daySubject']); ?></h4>
                                                <p><?php echo (stripslashes($dayDetailsData['dayDetails'])); ?></p>
                                             </div>
                                          </li>
                                          <?php  $n++; } } ?> 
                                           
                                           
                                       </ul>
                                    </div>
                                        
                                    </div>
                                 </div>
                                  
                                  
                                  
                              </div>
							  
							   <div class="overview-content">
									<?php 
$rsa=GetPageRecord('*','sys_PackageTips',' packageId="'.$pageContent['id'].'"   order by id asc');
while($packageTipsData=mysqli_fetch_array($rsa)){ 
?>
							  
						 <div class="tab-content"  style="border: 1px solid #ddd; margin-bottom:10px;">
                                 <div class="tab-pane fade active show">
                                   
									<h4 style="font-weight:800;"><?php echo stripslashes($packageTipsData['title']); ?></h4>
                                       <p><?php echo str_replace('*','&#10004;',(stripslashes($packageTipsData['description']))); ?></p>
                                   
                                    </div>
                                 </div>
                                       <?php } ?>
                                  
                              </div>
                                  
                                  
                                  
                              </div>
                           </div>
                            
                        </div>
                         
						   
						     <div class="col-lg-4">
                           <div class="sidebar">
                               <div style="margin-bottom: 20px; font-size: 20px; font-weight: 800; padding: 10px; background-color: #F56960; color: #fff; text-align:center;">&#8377;<?php echo $totalfinalcost=number_format(round($pageContent['grossPrice']+$pageContent['totalDiscount'])); ?> / Person</div>
                              <aside class="widget widget_latest_post widget-post-thumb">
                                 <h3 class="widget-title">Recent Post</h3>
                                 <ul>
								    <?php   
				$rs=GetPageRecord('*','websiteBlog',' status=1 and id!="'.$pageContent['id'].'"  order by id desc limit 0,10'); 
				while($rest=mysqli_fetch_array($rs)){  
				?>
                                    <li>
                                       <figure class="post-thumb">
                                          <a href="<?php echo $fullurl; ?>blog/<?php echo encode($rest['id']); ?>/<?php echo seo_friendly_url(stripslashes($rest['name'])); ?>"><img src="<?php echo $contenturl; ?>blogphotos/<?php echo stripslashes($rest['photo']); ?>" alt="<?php echo stripslashes($rest['name']); ?>"></a>
                                       </figure>
                                       <div class="post-content">
                                          <h5>
                                             <a href="<?php echo $fullurl; ?>blog/<?php echo encode($rest['id']); ?>/<?php echo seo_friendly_url(stripslashes($rest['name'])); ?>"><?php echo stripslashes($rest['name']); ?></a>
                                          </h5>
                                          <div class="entry-meta">
                                             <span class="posted-on">
                                                <a href="<?php echo $fullurl; ?>blog/<?php echo encode($rest['id']); ?>/<?php echo seo_friendly_url(stripslashes($rest['name'])); ?>"><?php echo date('j F, Y',strtotime($rest['dateAdded'])); ?></a>
                                             </span>
                                              
                                          </div>
                                       </div>
                                    </li>
                                 
								      <?php } ?>
                                 </ul>
                              </aside>
                               
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