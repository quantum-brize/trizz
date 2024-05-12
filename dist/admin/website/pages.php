<?php include "websiteinc.php";
$a=GetPageRecord('*','cmsPages','url="'.$_REQUEST['id'].'"'); 
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

    
      <title><?php echo stripslashes($pageContent['metaTitle']); ?></title>
	  
<meta name="Description" content="<?php echo stripslashes($pageContent['metaDesctiption']); ?>" /> 
	<meta name="keywords" content="<?php echo stripslashes($pageContent['metaKeyword']); ?>">

	  
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
                        <h1 class="inner-title"><?php echo stripslashes($pageContent['name']); ?></h1>
                     </div>
                  </div>
               </div>
               <div class="inner-shape"></div>
            </section>
          
		  
		  
		  <div class="about-service-wrap">
                  <div class="container">
                     <div class="section-heading">
                        <div class="row align-items-end"> 
                           <div class="col-lg-12">
                              <div class="section-disc">
                                 <p><?php echo stripslashes($pageContent['description']); ?></p>
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