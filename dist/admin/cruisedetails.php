<?php 
   include "inc.php"; 
   include "config/logincheck.php"; 
   $page='holidays';
   $selectedpage='holidays';
    
   function cleanstring($string) {
      $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
      return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
   }
   function isMobile() {
       return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
   }
   
        if(decode($_REQUEST['cid'])!=''){
         $cbb = GetPageRecord('*','sys_cruiseBuilder', 'id="'.decode($_REQUEST['cid']).'"');
         $cruiseBuilder = mysqli_fetch_array($cbb);
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
      <title><?php echo $cruiseBuilder['name']; ?> - <?php echo stripslashes($getcompanybasicinfo['companyName']); ?></title>
      <?php include "headerinc.php"; ?>
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
         .packagecard{
         padding: 20px;
         background-color: #f5f5f5;
         margin-bottom: 20px;
         }
         .packagecard button{
         padding: 6px 12px;
         border: 1px solid black;
         font-size: 13px;
         background-color: white;
         border-radius: 6px;
         font-weight: 800;
         width: fit-content;
         }
         .packagecard button:hover{
         background-color: #f1956e !important;
         color: white !important;
         }
         .packagecard p{
         margin-bottom: 16px;
         color: gray;
         font-size: 14px;
         }
         .packagecard table{
         margin-bottom: 16px;
         }
         .bbottom{
         border-left: 3px solid #e5622a;
         padding-left: 10px;
         margin-bottom: 16px;
         font-weight: 600;
         }
         /* .slick-sliderfour.slick-prev:before{
         display: none !important;
         }
         .slick-sliderfour.slick-next:before{
         display: none !important;
         } */





      </style>


<style>
   /* Tabs */

ul#tabs-nav {
  list-style: none;
  margin: 0;
  padding: 5px;
  overflow: auto;
}
ul#tabs-nav li {
  float: left;
  font-weight: bold;
  margin-right: 2px;
  padding: 6px 15px;
  border-radius: 5px 5px 5px 5px;
  cursor: pointer;
  margin-top: 10px !important;
  margin-left: 8px;
}
#tabs-content table
{
   width: 100% !important;
}
#tabs-content table tr td 
{
   width: 10% !important;
}
.tabs
         {
            background-color: transparent !important;
            border: 1px solid #ddd !important;
            border-radius: 5px !important;
            background-color: #f5f5f5 !important;
            margin-bottom: 20px !important;
         }
.tab-content {
  padding: 10px 15px;
}
ul#tabs-nav li
{
  background-color: #09828f !important;
  color: #fff !important;
}
#tabs-nav a 
{
   color: #fff !important;
}
</style>
   </head>
   <body class="greybluebg">
      <?php include "header.php"; ?>
      <h1><?php echo decode($_REQUEST['cid']); ?></h1>
      <div class="container" style="width:65%;margin-top:5%;">
         <div class="slick-slider">
            <?php 
               $n=1;
               $cg = GetPageRecord('*','cruiseGallery', 'cruiseId="'.decode($_REQUEST['cid']).'" order by id desc');
               while($cruiseGallery = mysqli_fetch_array($cg)){
            ?>
                <div class="elemnt element-<?php echo $n; ?>">
                <div class="htsetdiv" style="width:100%;height:500px;overflow:hidden;">
                    <img style="width: 100%;height:auto;min-height:100%;" src="<?php echo $adminurl; ?>package_image/<?php echo $cruiseGallery['image']; ?>" alt="">
                </div>
                </div>
            <?php $n++; } ?>
          
         </div>
         <div class="row">
            <div class="col-lg-8">
               <div class="bring-text">
                  <h4 style="font-weight:800;margin-bottom:10px;"><?php echo $cruiseBuilder['name']; ?></h4>
                  <!-- <p style="font-size:15px;">900+ booked</p> -->
                  <table class="bringtable">
                     <tr>
                        <?php if($cruiseBuilder['tagline1']!=''){ ?>
                        <td><i class="fa fa-inr" aria-hidden="true"></i>&nbsp;<?php echo $cruiseBuilder['tagline1']; ?></td>
                        <?php }if($cruiseBuilder['tagline2']!=''){ ?>
                        <td><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;<?php echo $cruiseBuilder['tagline2']; ?></td>
                        <?php }if($cruiseBuilder['tagline3']!=''){ ?>
                        <td><i class="fa fa-th-large" aria-hidden="true"></i>&nbsp;<?php echo $cruiseBuilder['tagline3']; ?></td>
                        <?php } ?>
                     </tr>
                  </table>
                  <?php echo $cruiseBuilder['description']; ?>
                  <!-- <ul class="bringul">
                     <li>With effect from 30 Apr 2023 sailings, Gratuity for Interior to Balcony will be revised from $21 to $22 per person per night.</li>
                     <li>For any special request (subject to availability), please send an email to our reservation team (email address: ) for your special request and to indicate your booking reservation number. Kindly do take note that this is subject to availability.</li>
                     </ul> -->
               </div>
			   
                <div class="packageoptions">
                  <h4 class="bbottom">Package options</h4>
                  <div class="card packagecard">
                     <div style="display:flex;justify-content:space-between;">
                        <h6>Select options</h6>
						<a href="<?php echo $fullurl; ?>cruises?cruiseId=<?php echo $_REQUEST['cid']; ?>"><button>clear all</button></a>
                     </div>
                     <p>Please select a travel date</p>

                     <!-- <button style="background-color:#e5622a;color:#fff;border:0px;margin-bottom:16px;" id="datepicker"><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;Check availability</button> -->
					 
			<form method='GET'>
				<div class="col-md-4">
				  <div class="form-group">
					   <label style="font-weight: 600;">Check availability</label>
					   <input type="text" name="departureDate" id="departuredate" class="form-control" onchange='this.form.submit()' value="<?php if($_REQUEST['departureDate']!=''){ echo date('d-m-Y', strtotime($_REQUEST['departureDate'])); } ?>" autocomplete="off">
					   <input type="hidden" name="cid" value="<?php echo encode($cruiseBuilder['id']); ?>">
					   <noscript><input type="submit" value="Submit"></noscript>
				   </div>
				 </div>
			</form>
		
		  <?php if($_REQUEST['departureDate']!=''){ ?>
			 <table class="mt-4">
				<tr>
				   <th>Cabin</th>
				   <th>Occupancy</th>
				   <th></th>
				</tr>
			   
			     <?php
				   $cpl = GetPageRecord('*', 'cabinPriceList', ' startDate = "'.date('Y-m-d', strtotime($_REQUEST['departureDate'])).'" ');
				   $priceList = mysqli_fetch_array($cpl);
					  $ccm = GetPageRecord('*', 'cruiseCabinMaster', 'cruiseId = "'.decode($_REQUEST['cid']).'" ');
					  while($cruiseCabin = mysqli_fetch_array($ccm)){
			     ?>
				  <form method='GET' onchange='this.form.submit()'>
					<tr>
					   <td style="width:37%;"><?php echo $cruiseCabin['name']; ?></td>
					   <td style="width:27%;"><?php echo $cruiseCabin['occupancy']; ?></td>
					   <?php if($_REQUEST['cabinId']==$cruiseCabin['id']) { ?>
					   <td><button type="submit" style="background-color: #f1956e !important;"><i class="fa fa-plus" style="margin-bottom: 10px;"></i> Select</button></td>
					   <?php }else{ ?>
					     <td><button type="submit"><i class="fa fa-plus" style="margin-bottom: 10px;"></i> Select</button></td>
					   
					   <?php } ?>
					   
					     <input type="hidden" name="cid" value="<?php echo encode($cruiseBuilder['id']); ?>">
						 <input type="hidden" name="cabinId" value="<?php echo $cruiseCabin['id']; ?>">
						 <input type="hidden" name="occupancy" value="<?php echo $cruiseCabin['occupancy']; ?>">
					     <input type="hidden" name="departureDate" value="<?php echo date('Y-m-d', strtotime($_REQUEST['departureDate'])); ?>">
						 <noscript><input type="submit" value="Submit"></noscript>
					</tr>
				 </form>
				 <?php } ?>
			 </table>
		  <?php } ?>


			  <?php if($_REQUEST['cabinId'] !=''){ ?>
			    <form method='GET'>
				  <table class="mt-4">
					<tr>
					   <?php $c=1; for($i=0; $i<($_REQUEST['occupancy']); $i++){ ?>
					   
					   <?php if($_REQUEST['adult'] == $i+1) { ?>
					   
						  <td><button type="submit" style="background-color: #f1956e !important;" name="adult" value="<?php echo $i+1; ?>"><?php echo $i+1; ?> Adult</button></td> 
						  
						<?php }else{ ?>
						  <td><button type="submit" name="adult" value="<?php echo $i+1; ?>"><?php echo $i+1; ?> Adult</button></td>
						<?php } ?>
						
					   <?php $c++; } ?>
					</tr>
						<input type="hidden" name="cid" value="<?php echo encode($cruiseBuilder['id']); ?>">
						<input type="hidden" name="cabinId" value="<?php echo $_REQUEST['cabinId']; ?>">
						<input type="hidden" name="occupancy" value="<?php echo $_REQUEST['occupancy']; ?>">
						<input type="hidden" name="departureDate" value="<?php echo date('Y-m-d', strtotime($_REQUEST['departureDate'])); ?>">
				  </table>
				 </form>
			  <?php } ?>
			 
			 
			 <?php 
			  	if(($_REQUEST['adult'] !='') && ($_REQUEST['occupancy'] != $_REQUEST['adult']) && ($_REQUEST['occupancy'] > $_REQUEST['adult'])){ 
				$child = $_REQUEST['occupancy']-$_REQUEST['adult'];
			 ?>
			    <form method='GET'>
				  <table>
					<tr>
					   <?php $c=1; for($i=0; $i<=$child; $i++){ ?>
					   
					    <?php if($_REQUEST['child'] == $i) { ?>
							<td><button type="submit" style="background-color: #f1956e !important;" name="child" value="<?php echo $i; ?>"><?php echo $i; ?> Child</button></td> 
						<?php }else{ ?>
							<td><button type="submit" name="child" value="<?php echo $i; ?>"><?php echo $i; ?> Child</button></td>
						<?php } ?>
						
					   <?php $c++; } ?>
					</tr>
						 <input type="hidden" name="adult" value="<?php echo $_REQUEST['adult']; ?>">
					     <input type="hidden" name="cid" value="<?php echo encode($cruiseBuilder['id']); ?>">
						 <input type="hidden" name="cabinId" value="<?php echo $_REQUEST['cabinId']; ?>">
						 <input type="hidden" name="occupancy" value="<?php echo $_REQUEST['occupancy']; ?>">
						 <input type="hidden" name="departureDate" value="<?php echo date('Y-m-d', strtotime($_REQUEST['departureDate'])); ?>">
				  </table>
				</form>
			  <?php } ?>
			  
			  
			 <?php 
			  	if(($_REQUEST['child'] !='') && ($_REQUEST['occupancy'] != ($_REQUEST['adult']+$_REQUEST['child'])) && ($_REQUEST['occupancy'] > ($_REQUEST['adult']+$_REQUEST['child']))){ 
				$child = $_REQUEST['occupancy']-$_REQUEST['adult'];
				$infant = $child - $_REQUEST['child'];
			 ?>
			    <form method='GET'>
				  <table>
					<tr>
					   <?php $c=1; for($i=0; $i<=$infant; $i++){ ?>
					   
					    <?php if($_REQUEST['infant'] == $i) { ?>
							<td><button type="submit" style="background-color: #f1956e !important;"  name="infant" value="<?php echo $i; ?>"><?php echo $i; ?> Infant</button></td> 
						<?php }else{ ?>
							<td><button type="submit" name="infant" value="<?php echo $i; ?>"><?php echo $i; ?> Infant</button></td>
						<?php } ?>
						
					   <?php $c++; } ?>
					</tr>
					     <input type="hidden" name="child" value="<?php echo $_REQUEST['child']; ?>">
						 <input type="hidden" name="adult" value="<?php echo $_REQUEST['adult']; ?>">
					     <input type="hidden" name="cid" value="<?php echo encode($cruiseBuilder['id']); ?>">
						 <input type="hidden" name="cabinId" value="<?php echo $_REQUEST['cabinId']; ?>">
						 <input type="hidden" name="occupancy" value="<?php echo $_REQUEST['occupancy']; ?>">
						 <input type="hidden" name="departureDate" value="<?php echo date('Y-m-d', strtotime($_REQUEST['departureDate'])); ?>">
				  </table>
				</form>
			  <?php } ?>
                  </div>
               </div>

                  <div class="tabs">
                     <?php
                        $n=1;
                        $y = GetPageRecord('Year(startDate) as groupyear', 'cabinPriceList', ' cruiseId = "'.decode($_REQUEST['cid']).'" group by groupyear order by groupyear desc');
                        while($year = mysqli_fetch_array($y)){
			            ?>
                        <ul id="tabs-nav">
                           <li><a href="#tab<?php echo $n; ?>"><?php echo $year['groupyear']; ?></a></li>
                        </ul> 

                        <div id="tabs-content">
                           <div id="tab<?php echo $n; ?>" class="tab-content">
                              <table style="border-collapse:collapse;">
                                 <tr>
                                    <th style="border: 1px solid grey; padding:10px; font-size:16px; font-weight:700;">Start Date</th>
                                    <th style="border: 1px solid grey; padding:10px; font-size:16px; font-weight:700;">End Date</th>
                                    <th style="border: 1px solid grey; padding:10px; font-size:16px; font-weight:700;">Price</th>
                                 </tr>

                                 <?php
                                    $cpl = GetPageRecord('*', 'cabinPriceList', ' Year(startDate) = "'.$year['groupyear'].'" order by id desc');
                                    while($ylist = mysqli_fetch_array($cpl)){
                                 ?>
                                    <tr>
                                       <td style="border: 1px solid grey; padding:10px; font-size:16px; font-weight:400;"><?php echo date('d-m-Y', strtotime($ylist['startDate'])); ?></td>
                                       <td style="border: 1px solid grey; padding:10px; font-size:16px; font-weight:400;"><?php echo date('d-m-Y', strtotime($ylist['endDate'])); ?></td>
                                       <td style="border: 1px solid grey; padding:10px; font-size:16px; font-weight:400;"><?php echo $ylist['adultCost']+$ylist['childCost']+$ylist['infantCost']; ?></td>
                                    </tr>
                                 <?php } ?>
                              </table>
                           </div>
                        </div> 
                     <?php $n++; } ?>
                  </div> 


               <div class="packageoptions d-none">
                  <h4 class="bbottom">Travel Year List</h4>
                  <div class="card packagecard">
                     <div style="display:flex;justify-content:space-between;">
                     
                     </div>
                  
                     <?php
                        $n=1;
                        $y = GetPageRecord('Year(startDate) as groupyear', 'cabinPriceList', ' cruiseId = "'.decode($_REQUEST['cid']).'" group by groupyear order by groupyear desc');
                        while($year = mysqli_fetch_array($y)){
			            ?>
                        <td> 
                            <button class="nav-link active show" data-toggle="tab" href="#tab<?php echo $n; ?>" role="tab" aria-selected="true"><?php echo $year['groupyear']; ?></button> 
                        </td> 


                        <!-- <ul class="nav nav-tabs" role="tablist">
                           <li class="nav-item"> 
                              <a class="nav-link active show" data-toggle="tab" href="#tab<?php echo $n; ?>" role="tab" aria-selected="true"><?php echo $year['groupyear']; ?></a> 
                           </li>
                        </ul> -->
                  
                        <table class="mt-4 tab-pane active show" id="tab<?php echo $n; ?>" role="tabpanel">
                           <tr>
                              <th>From Date</th>
                              <th>End Date</th>
                              <th>Price</th>
                           </tr>
                           
                           <?php
                              // $y = GetPageRecord('Year(startDate) as groupyear', 'cabinPriceList', ' cruiseId = "'.decode($_REQUEST['cid']).'" group by groupyear order by groupyear desc');
                              // while($year = mysqli_fetch_array($y)){

                              //  $cpll = GetPageRecord('*', 'cabinPriceList', 'Year(startDate) = "'.$year.'" order by id desc');
                              //  while($ylist = mysqli_fetch_array($cpll)){

                                 // $y = GetPageRecord('*', 'cabinPriceList', ' cruiseId = "'.decode($_REQUEST['cid']).'" group by startDate order by id desc');
                                 // $year = mysqli_fetch_array($y);

                                    $cpl = GetPageRecord('*', 'cabinPriceList', ' Year(startDate) = "'.$year['groupyear'].'" order by id desc');
                                    while($ylist = mysqli_fetch_array($cpl)){

                           ?>
                              <tr>
                                 <td style="width:37%;"><?php echo $ylist['startDate']; ?></td>
                                 <td style="width:27%;"><?php echo $ylist['endDate']; ?></td>
                                 <td style="width:27%;"><?php echo $ylist['adultCost']+$ylist['childCost']+$ylist['infantCost']; ?></td>
                              </tr>
                           <?php  } $n++; } ?>
                        </table>

                  </div>
               </div>

               <h4 class="bbottom">Good to know</h4>
               <?php echo $cruiseBuilder['packageDetails']; ?>
            </div>
			<?php
				 $p = GetPageRecord('*', 'cabinPriceList', 'cruiseId = "'.decode($_REQUEST['cid']).'"');
				 $price = mysqli_fetch_array($p);
				 $totalPrice = $price['adultCost']+$price['childCost']+$price['infantCost'];
				 $adultPrice=0;
				 $childPrice=0;
				 $infantPrice=0;
			      if(isset($_REQUEST['adult'])){$adultPrice = $_REQUEST['adult']*$price['adultCost'];}
				  if(isset($_REQUEST['child'])){ $childPrice = $_REQUEST['child']*$price['childCost'];}
				  if(isset($_REQUEST['infant'])){$infantPrice = $_REQUEST['infant']*$price['infantCost'];}
				  
				  if(isset($_REQUEST['adult']) || isset($_REQUEST['child']) || isset($_REQUEST['infant'])){
				  	$totalPrice = $adultPrice+$childPrice+$infantPrice;
				  }
			?>


    
				<div class="col-lg-4">
				     <form action="<?php echo $fullurl; ?>cruisebook" method="get">
				   <div class="pkg-content">
					  <h5 style="font-weight:700;color:black;margin-bottom:20px;">INR <?php echo $totalPrice; ?>.00</h5>
                 <input type="hidden" name="departureDate" value="<?php echo $_REQUEST['departureDate']; ?>">
                 <input type="hidden" name="occupancy" value="<?php echo $_REQUEST['occupancy']; ?>">
                 <input type="hidden" name="cabinId" value="<?php echo $_REQUEST['cabinId']; ?>">
                 <input type="hidden" name="cid" value="<?php echo $_REQUEST['cid']; ?>">
                 <input type="hidden" name="adult" value="<?php echo $_REQUEST['adult']; ?>">
                 <input type="hidden" name="child" value="<?php echo $_REQUEST['child']; ?>">
                 <input type="hidden" name="infant" value="<?php echo $_REQUEST['infant']; ?>">
				 <input type="hidden" name="price" value="<?php echo $totalPrice; ?>">
					  <button type="submit">Book Now</button>
				   </div>
				            </form>

				</div>
         </div>
      </div>
      <?php include "footer.php"; ?>
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
         $(function() {
            $("#departuredate" ).datepicker({
               changeMonth: true,
               changeYear: true,
               dateFormat: 'dd-mm-yy',
			   minDate : 1
            });
         });
      </script>

      <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
      <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
      <script type="text/javascript" src="slick/slick.min.js"></script>

      <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
      
      <script>
         $(".slick-slider").slick({
         slidesToShow: 1,
         infinite:false,
         slidesToScroll: 1,
         autoplay: true,
         autoplaySpeed: 1000,
         dots: true,
         arrows: true,
         
         // dots: false, Boolean
         // arrows: false, Boolean
         });
         
      </script>
      
      <script>
         $(function() {
            $( "#datepicker" ).datepicker({
            
               changeMonth: true,
               changeYear: true,
               showButtonPanel: true,
            
            });
         });
      </script>

      <script>
         // Show the first tab and hide the rest
$('#tabs-nav li:first-child').addClass('active');
$('.tab-content').hide();
$('.tab-content:first').show();

// Click function
$('#tabs-nav li').click(function(){
  $('#tabs-nav li').removeClass('active');
  $(this).addClass('active');
  $('.tab-content').hide();
  
  var activeTab = $(this).find('a').attr('href');
  $(activeTab).fadeIn();
  return false;
});
      </script>
      
   </body>
</html>