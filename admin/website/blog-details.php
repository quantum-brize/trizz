<?php include "websiteinc.php";
$a=GetPageRecord('*','websiteBlog','id="'.decode($_REQUEST['id']).'"'); 
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

    
      <title><?php echo stripslashes($pageContent['metaTitle']); ?> - Blog - <?php echo stripslashes($WebsiteSettingDetails['companyName']); ?></title>
	  
<meta name="Description" content="<?php echo stripslashes($pageContent['metaDesctiption']); ?>" /> 
	<meta name="keywords" content="<?php echo stripslashes($pageContent['metaKeyword']); ?>">

	  
	  <?php include "websiteheaderinc.php"; ?>
 
   </head>
   <body>

			 
      <div id="page" class="full-page">
          <?php include "websiteheader.php"; ?>
       
	 
         <main id="content" class="site-main">
		 
		 <section class="inner-banner-wrap">
               <div class="inner-baner-container" style="background-image: url(<?php echo $contenturl; ?>blogphotos/<?php echo stripslashes($pageContent['photo']); ?>);">
                  <div class="container">
				  
				  
                     <div class="inner-banner-content">
                        <h1 class="inner-title"><?php echo stripslashes($pageContent['name']); ?></h1>
						<div style="text-align:center;">Posted: <?php echo date('j F, Y',strtotime($pageContent['dateAdded'])); ?></div>
                     </div>
					 
                  </div>
               </div>
               <div class="inner-shape"></div>
            </section>
          
		  
		  
		  <div class="about-service-wrap">
                  <div class="container">
                     <div class="section-heading">
                        <div class="row"> 
                           <div class="col-lg-8 primary right-sidebar">
                              <div class="section-disc">
							  <img src="<?php echo $contenturl; ?>blogphotos/<?php echo stripslashes($pageContent['photo']); ?>" style="width:100%;">
                                 <p><?php echo stripslashes($pageContent['description']); ?></p>
                              </div>
                           </div>
						   
						     <div class="col-lg-4">
                           <div class="sidebar">
                               
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
         </main>
		 
		 
		 <?php include "websitefooter.php"; ?>
		 
       
      </div>

      <!-- JavaScript -->
	  <?php include "websitefooterinc.php"; ?>
    
   </body>
 
</html>