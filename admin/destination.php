<?php 
   include "websiteinc.php"; 
 
   function cleanstring($string) {
      $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
   
      return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
   }
   function isMobile() {
       return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
   }
   
   		//  $where='';
   		 if(decode($_REQUEST['destinationId'])!=''){
   		//  $where=' and id="'.decode($_REQUEST['destinationId']).'" ';
        $cd = GetPageRecord('*','websiteDestination', 'id="'.decode($_REQUEST['destinationId']).'"');
        $cDestinations = mysqli_fetch_array($cd);
   		 }
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <link rel="stylesheet" type="text/css" href="slick/slick.css"/>
      <link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
      <title>Cruise Packages - <?php echo stripslashes($getcompanybasicinfo['companyName']); ?></title>
      <?php include "websiteheaderinc.php"; ?>
      <link rel="stylesheet" type="text/css" href="slick/slick.css">
      <link rel="stylesheet" type="text/css" href="slick/slick-theme.css">
      <script src="slick/slick.js" type="text/javascript" charset="utf-8"></script>
      <style>
         .holicontainer, .travelcontainer, .lastcon { padding: 0px 60px; }
         .videobackground{
         width: 100%;
         background-size: cover;
         background-position: center;
         height: 550px;
         overflow: hidden;
         position: relative;
         }
         .videocontent{
         position: absolute;
         top: 50%;
         left: 50%;
         transform: translate(-50%,-50%);
         }
         .videobackground video{
         width: 100%;
         }
         .videobackground h1{
         font-size: 40px;
         color: #fff !important;
         }
         .slick-slider {
         margin:0 -8px;
         }
         .slick-slide {
         padding:5px;
         overflow: hidden;
         margin-right:8px;
         }
         .slick-prev{
         left: -36px;
         top: 50% !important;
         }
         .slick-prev:before, .slick-next:before{
         color: var(--blue) !important;
         }
         /* .slick-sliderfour.slick-prev:before{
         display: none !important;
         }
         .slick-sliderfour.slick-next:before{
         display: none !important;
         } */
      </style>
   </head>
   <body class="greybluebg">
      <?php include "websiteheader.php"; ?>
      <section class="destibackground">
         <h1>Adventures across various countries.</h1>
      </section>
      <section class="destidetail" style="padding:50px;">
         <div class="container">
            <div class="row d-flex align-items-center">
               <div class="col-lg-6">
                  <div class="destidetailimg">
                     <img src="<?php echo $crmurl; ?>upload/<?php echo $cDestinations['thumbImage']; ?>" alt="">
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="desticontent">
                     <h1>OUR DESTINATIONS</h1>
                     <h3><?php echo $cDestinations['name']; ?></h3>
                     <p><?php echo $cDestinations['description']; ?></p>
                     <!-- <div class="itnerarybutton">
                        <a href="#"><i class="fa fa-download" aria-hidden="true"></i> Download Travel Document Requirements here</a>
                        </div> -->
                  </div>
               </div>
            </div>
         </div>
      </section>
      <section class="morecard">
         <div class="container">
            <div class="row">
               <div class="col-lg-12 text-center">
                  <h5 style="text-transform:uppercase;font-size:26px;margin-bottom:14px;"><?php echo $cDestinations['name']; ?></h5>
                  <p>Consisting of the largest island in Thailand with 32 other small islands, this is the perfect <br>
                     paradise for water sports. Visit the bustling street markets and uncover the Sino-colonial <br>
                     mansions with over 100 years of history in the Old Town.
                  </p>
               </div>
                <?php 
                  $cb = GetPageRecord('*','sys_cruiseBuilder', 'status=1 and destinationId="'.decode($_REQUEST['destinationId']).'"');
                  while($cruiseBuilder = mysqli_fetch_array($cb)){
                   $cbb = GetPageRecord('*','websiteDestination', 'id="'.$cruiseBuilder['destinationId'].'"');
                   $cruiseDestinationss = mysqli_fetch_array($cbb);
                   $cg = GetPageRecord('*','cruiseGallery', 'cruiseId="'.$cruiseBuilder['id'].'" order by id desc limit 1');
                   $cruiseGallery = mysqli_fetch_array($cg);
                ?>
                  <div class="col-lg-3">
                      <div class="card ddcard">
                        <div class="ddimg">
                            <img src="<?php echo $crmurl; ?>package_image/<?php echo $cruiseGallery['image']; ?>" class="card-img-top" alt="...">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $cruiseBuilder['name']; ?></h5>
                            <p class="card-text">
                            <?php echo $cruiseDestinationss['name']; ?>
                            </p>
                            <a href="<?php echo $fullurl; ?>cruises?cid=<?php echo encode($cruiseBuilder['id']); ?>" class="btn btn-primary">Go somewhere</a>
                        </div>
                      </div>
                  </div>
               <?php } ?>

            
            </div>
         </div>
      </section>
      <?php include "websitefooter.php"; ?>
      <script>
         $('.owl-carousel').owlCarousel({
           loop:true,
           margin:10,
           nav:true,
           responsive:{
               0:{
                   items:1
               },
               600:{
                   items:3
               },
               1000:{
                   items:5
               }
           }
         })
         
      </script>
      <script>
         $( function() {
         $( "#departuredate" ).datepicker(
         {
         changeMonth: true,
                 changeYear: true,
                 yearRange: '-100:+0',
         dateFormat: 'dd-mm-yy',
         maxDate: new Date()
         
         }
         
         );
         } );
         
         
         
         function getSearchCityHotel(citysearchfield,cityresultfield,listsearch){
         var citysearchfieldval = encodeURI($('#'+citysearchfield).val());  
         var citysearchfield = citysearchfield;
         
         if(citysearchfieldval!=''){  
         $('#'+listsearch).show();
         $('#'+listsearch).load('searchcitylistshotel.php?keyword='+citysearchfieldval+'&searchcitylists='+listsearch+'&cityresultfield='+cityresultfield+'&citysearchfield='+citysearchfield);
         }
         }
         
         
         
         var $filterCheckboxes = $('#allFilterDiv input[type="checkbox"]');
         
         $filterCheckboxes.on('change', function() {
         
         var selectedFilters = {};
         
         $filterCheckboxes.filter(':checked').each(function() {
         
         if (!selectedFilters.hasOwnProperty(this.name)) {
         
         
         
           selectedFilters[this.name] = [];
         
         
         
         }
         
         selectedFilters[this.name].push(this.value);
         
         });
         
         // create a collection containing all of the filterable elements
         
         
         
         var $filteredResults = $('.itemlist');
         
         // loop over the selected filter name -> (array) values pairs
         
         
         
         $.each(selectedFilters, function(name, filterValues) {
         
         // filter each .flower element
         
         
         
         $filteredResults = $filteredResults.filter(function() {
         
           var matched = false,
         
         
         
             currentFilterValues = $(this).data('category').split(' ');
         
           // loop over each category value in the current .flower's data-category
         
         
         
           $.each(currentFilterValues, function(_, currentFilterValue) {
         
             // if the current category exists in the selected filters array
         
         
         
             // set matched to true, and stop looping. as we're ORing in each
         
         
         
             // set of filters, we only need to match once
         
             if ($.inArray(currentFilterValue, filterValues) != -1) {
         
         
         
               matched = true;
         
         
         
               return false;
         
         
         
             }
         
         
         
           });
         
           // if matched is true the current .flower element is returned
         
         
         
           return matched;
         
         });
         
         
         
         });
         
         $('.itemlist').hide().filter($filteredResults).show();
         
         });
         
         
         
      </script>
      <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
      <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
      <script type="text/javascript" src="slick/slick.min.js"></script>
      <script>
         $(".slick-slider").slick({
         slidesToShow: 3,
         infinite:false,
         slidesToScroll: 1,
         autoplay: true,
         autoplaySpeed: 2000,
         dots: true,
         arrows: true,
         
          // dots: false, Boolean
         // arrows: false, Boolean
         });
         
         
      </script>
      <script>
         $(".slick-slidertwo").slick({
         slidesToShow: 4,
         infinite:false,
         slidesToScroll: 1,
         autoplay: true,
         autoplaySpeed: 2000,
         dots: true,
         arrows: true,
         
          // dots: false, Boolean
         // arrows: false, Boolean
         });
         
         
      </script>
      <script>
         $(".slick-sliderfour").slick({
         slidesToShow: 1,
         infinite:false,
         slidesToScroll: 1,
         autoplay: true,
         autoplaySpeed: 2000,
         dots: true,
         arrows: false,
         
          // dots: false, Boolean
         // arrows: false, Boolean
         });
         
         
      </script>
   </body>
</html>