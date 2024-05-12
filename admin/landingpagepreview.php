<?php
include "config/database.php"; 
include "config/function.php"; 
include "config/setting.php"; 
$startDate=date('d-m-Y',strtotime('+2 Days'));
$endDate=date('d-m-Y',strtotime('+4 Days'));
 
$rs=GetPageRecord('*','landingPages','status=1 and pageURL="'.$_REQUEST['id'].'"'); 
$landingpageres=mysqli_fetch_array($rs);

 
$a=GetPageRecord('*','sys_userMaster','id=1'); 
$companydata=mysqli_fetch_array($a);

if($landingpageres['id']==''){
echo 'You dont have permission to access this page!';
exit();
}

$destinationName='';

$data=array($landingpageres["packages"]);

$packages=GetPageRecord('*','sys_packageBuilder','id="'.$data[0].'"'); 
$packagesData=mysqli_fetch_array($packages);
$destinationName=$packagesData["destinations"];


function cleanstring($string) {

   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
      $string = str_replace('----', '-', $string); // Replaces all spaces with hyphens.
   $string = str_replace('---', '-', $string); // Replaces all spaces with hyphens.
   $string = str_replace('--', '-', $string); // Replaces all spaces with hyphens.
   $string = str_replace('-', '-', $string); // Replaces all spaces with hyphens.

   return strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $string)); // Removes special chars.
}

?>

<!DOCTYPE html>
<html lang="en">

 
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?php echo stripslashes($landingpageres['metaTitle']); ?></title>
  <meta name="description" content="<?php echo stripslashes($landingpageres['metaDescription']); ?>">
<meta name="keywords" content="<?php echo stripslashes($landingpageres['metaKeyword']); ?>">

  <link rel="stylesheet" href="<?php echo $landingpagedatas; ?>assets/styles/css/slick.css">
  <link rel="stylesheet" href="<?php echo $landingpagedatas; ?>assets/styles/css/slick-theme.css">
  <link rel="stylesheet" href="<?php echo $landingpagedatas; ?>assets/styles/css/jquery.datepicker2.css">
  <link rel="stylesheet" href="<?php echo $landingpagedatas; ?>assets/styles/css/animate.css">

  <link rel="stylesheet" href="<?php echo $landingpagedatas; ?>assets/styles/style.css">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'> 

  <style>
.bannerheadingouter{ width:100%; text-align:left; overflow:hidden; position:absolute; left:0px; top:10%;}
.bannerheadingouter .headingleftin{max-width:1156px; margin:auto;}
.bannerheadingouter .headingleft{width:50%; float:left;}
.bannerheadingouter .headingleft h1{font-size: 30px; color: #fff; background-color: #00000091; padding: 10px 20px; line-height: 50px; width: fit-content; border-radius: 4px; margin-top:80px;}
.bannerheadingouter .headingleft .content{font-size:20px; color: #fff; background-color: #00000091; padding: 10px 20px; line-height: 30px; width: fit-content; border-radius: 4px;}
.bannerheadingouter .headingright{width:50%; float:left;}
.bannerheadingouter .headingright .formbox{width:80%; float:right; padding:20px 30px; background-color:#FFFFFF; border-radius: 10px;}
.bannerheadingouter .headingright .formbox .heading{font-size:22px; font-weight:500; margin-bottom:0px;}
.bannerheadingouter .headingright .formbox .subheading{font-size:16px; font-weight:500; margin-bottom:10px;}
.bannerheadingouter .headingright .formbox .field{margin-bottom:10px;}
.somedia .fa{font-size: 40px; margin-right: 10px; margin-top: 20px;}

@media only screen and (max-width: 800px) {
.headingleft{width:100% !important;}
.headingright{width:100% !important;}
.filterable-tour {   margin-top: 400px; }
.bannerheadingouter .headingright .formbox{width:100%;}
.bannerheadingouter .headingleft h1 { font-size: 30px; color: #fff; background-color: #00000091; padding: 10px 20px; line-height: 50px; width: fit-content; border-radius: 4px; margin-top: 0px; text-align: center; font-size: 15px; width: 100%; line-height: 25px; margin-bottom: -1px;}
.bannerheadingouter .headingleft .content { font-size: 20px; color: #fff; background-color: #00000091; padding: 10px 20px; line-height: 30px; width: fit-content; border-radius: 4px; width: 100%; text-align: center; font-size: 15px; padding: 10px; line-height: 21px; }
.filterable-tour .trending-tour-item{width:100%;}
}
  </style>
  
  
<?php echo stripslashes($landingpageres['headerScript']); ?>

</head>
<body>


<header id="header-2">
    <div class="wand-container">
        <div class="header-content2">
            <div class="header-content2__logo">
                <a class="header-content2__logo__sitename" href="<?php echo $landingpage; ?><?php echo stripslashes($landingpageres['pageURL']); ?>"><img src="<?php echo $fullurl; ?>profilepic/<?php echo stripslashes($companydata['invoiceLogo']); ?>" alt="<?php echo stripslashes($companydata['invoiceCompany']); ?>" style="max-height:105px;"></a>
            </div>
            
            <nav class="header-2-nav">
                <ul>
                    <li>
                        <a href="#" >Home </a> 
                    </li>
					<li>
                        <a href="#tourpackagesid"  >Tours Packages </a> 
                    </li>
					<li>
                        <a href="#contactUs" >Contact Us </a> 
                    </li>
                      
                </ul>
            </nav> 

            <a href="tel:<?php echo stripslashes($landingpageres['contactNumber']); ?>" class="header-content2__call">
                <img src="<?php echo $landingpagedatas; ?>assets/images/call.png" alt="call">
                <div class="header-content2__call__phone-number">
                    <p>Call Us Today!</p>
                    <span><?php echo stripslashes($landingpageres['contactNumber']); ?></span>
                </div>
            </a>
            <div class="search-area">
    <div class="search-area__close"></div>
    <form action="#">
        <input class="search-area__input" placeholder="Search..." type="text">
        <button class="search-area__submit" type="submit"><span>Hit Enter to search or Esc key to close</span></button>
    </form>
</div>
            <nav class="header-nav-mobile">
    <ul>
           <li>
                        <a href="#" >HOME </a> 
                    </li>
					<li>
                        <a href="#tourpackagesid"  >Tours Packages </a> 
                    </li>
					<li>
                        <a href="#contactUs" >Contact Us </a> 
                    </li>
                      
    </ul>
</nav> 

            <div class="header-content2__hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div> 
    </div>
</header>
 

<section>
    <div class="slider-banner-3">
        <div class="slider-banner-3__item">
            <img src="<?php echo $fullurl; ?>package_image/<?php echo $landingpageres['banner']; ?>" alt="banner" style="max-height:623px;width: 100%; height: 623px; object-fit: cover;">
			
			<div class="bannerheadingouter">
			<div class="headingleftin">
			<div class="headingleft"><h1><?php echo stripslashes($landingpageres['bannerHeading']); ?></h1><div class="content"><?php echo stripslashes($landingpageres['bannerSubHeading']); ?></div></div>
			
			
			<div class="headingright">
			<div class="formbox">
			<div class="heading"><h5>Please Fill this Form for Exclusive Rates</h5></div>
			<!--<div class="subheading"><?php echo stripslashes($landingpageres['enquirySubHeading']); ?></div>-->
			
			<form action="<?php echo $fullurl; ?>landingpageaction.php" method="post" enctype="multipart/form-data" name="addeditfrm"   id="addeditfrm">

			<input type="hidden" name="destination" value="<?php echo $destinationName; ?>">
			
			<input value="" name="clientName" id="clientName" type="text" placeholder="Name" maxlength="50" class="field">
			<input value="" name="mobileNumber" id="mobileNumber" type="text" maxlength="13" placeholder="Mobile Number" class="field">
			<input value="" name="clientEmail" id="clientEmail" type="email" placeholder="Email" maxlength="100" class="field">
			
			<table style="width: 100%; margin-bottom:0px;">
			<tr style="border-bottom: none;">
			<td><input value="" name="adult" id="adult" type="number" maxlength="13" placeholder="No. of Adult" class="field"></td>
			<td><input value="" name="child" id="child" type="number" maxlength="13" placeholder="No. of Child" class="field"></td>
			</tr>
			
			<tr style="border-bottom: none;">
			<td><input name="startDate" id="startDatestart" type="date" maxlength="13" value="<?php if($startDate!='1970-01-01' && $startDate!='01-01-1970'){ echo $startDate; } ?>" placeholder="From Date" class="field"></td>
			<td><input name="endDate" id="endDateend" type="date" maxlength="13" value="<?php if($endDate!='1970-01-01' && $endDate!='01-01-1970'){ echo $endDate; } ?>" placeholder="To Date" class="field"></td>
			</tr>
			
			</table>
			 <select disabled name="enquiryFor" id="enquiryFor" class="field" style="padding: 12px; width: 100%; border: 1px solid #ddd; border-radius: 3px;">
			 	   <option value="0">Select Package From Below List</option>
			 <?php 

$string = $landingpageres['packages'];
$string = preg_replace('/\.$/', '', $string); //Remove dot at end if exists
$array = explode(',', $string); //split string into array seperated by ', '
foreach($array as $value) //loop over values
{
$rs=GetPageRecord('*','sys_packageBuilder',' id="'.$value.'"  order by id desc');
while($rest=mysqli_fetch_array($rs)){ 
 
?>
			   <option disabled value="<?php echo stripslashes($rest['name']); ?> (<?php echo $rest['days']; ?> Days - <?php echo ($rest['days']-1); ?> Nights)" ><?php echo stripslashes($rest['name']); ?> (<?php echo $rest['days']; ?> Days - <?php echo ($rest['days']-1); ?> Nights)</option>
			   <?php } } ?>
			   
			 </select>
			
			<div class="form__item form__item--submit" style="width: 100%;">
                <input type="submit" value="Submit">
                <input name="action" type="hidden" id="action" value="submitquery">
                <input name="packageId" type="hidden" id="packageId" value="packageId">
			</div>
			</form>
			<div style="padding:20px; text-align:center; display:none;" id="thanksmsg">
			<div style="text-align:center; font-size:30px;">Thank You</div>
			<div style="text-align:center; font-size:18px;">Your enquiry has been submitted successfully.</div>
			</div>
			</div>
			</div>
			</div>
			
			
			</div>
             
        </div>
    </div>
      
</section>


<section class="filterable-tour" id="tourpackagesid">
    <div class="container">
        <div class="filterable-tour__tittle" style=" margin-top: 40px;margin-bottom: 30px; ">
            
            
            
            <div class="section-tittle">
    <h2><?php echo stripslashes($landingpageres['mainHeading']); ?></h2>
    <div class="section-tittle__line-under"></div>
    <p><?php echo stripslashes($landingpageres['mainHeading']); ?></p>
</div>
        </div>
        <p style="margin-bottom:40px; border-bottom:1px solid #ddd; padding-bottom:20px; display:block; text-align:center;"><?php echo stripslashes(nl2br($landingpageres['description'])); ?></p>
		
        <div id="filterable-posts" class="row">
		
		
		<?php 

$string = $landingpageres['packages'];
$string = preg_replace('/\.$/', '', $string); //Remove dot at end if exists
$array = explode(',', $string); //split string into array seperated by ', '
foreach($array as $value) //loop over values
{
$rs=GetPageRecord('*','sys_packageBuilder',' id="'.$value.'"  order by id desc');
while($rest=mysqli_fetch_array($rs)){ 
 
?>
            <div class="col-lg-4 col-md-6 col-xl-4 col-sm-6 col-12 greek">
                <a href="<?php echo $fullurlproposal; ?>sharepackage/<?php echo encode($rest['id']); ?>/<?php echo cleanstring(stripslashes($rest['name'])); ?>.html" class="trending-tour-item " target="_blank" style="    margin-bottom: 0px;"> 
                    <img class="trending-tour-item__thumnail" src="<?php echo $fullurl; ?>package_image/<?php echo $rest['coverPhoto']; ?>" alt="<?php echo stripslashes($rest['name']); ?>">
                    <div class="trending-tour-item__info">
                        <h3 class="trending-tour-item__name">
                            <?php echo stripslashes($rest['name']); ?>
                        </h3>
                        <div class="trending-tour-item__group-infor">
                            <div class="trending-tour-item__group-infor--left"> 
                                <div class="trending-tour-item__group-infor__lasting"><?php echo $rest['days']; ?> Days / <?php echo ($rest['days']-1); ?> Nights</div>
                            </div> 
                            <span class="trending-tour-item__group-infor__price" style="top: 50px; color: #000; background-color: #fffbbf; padding: 0px 8px; border-radius: 4px;">&#8377;<?php echo number_format($rest['grossPrice']); ?></span>
            
                        </div>
                    </div>
					
					
                </a><div class="form__item--submit" style="width: 100%;margin-top: -9px;">
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr style="    border: 0px;">
    <!--<td width="50%"><a href="<?php echo $fullurlproposal; ?>sharepackage/<?php echo encode($rest['id']); ?>/<?php echo cleanstring(stripslashes($rest['name'])); ?>.html" target="_blank" style="margin-bottom:20px;"><input type="submit" value="Preview" style="padding: 10px;"></a></td>-->
	<td colspan="2"><a   style="margin-bottom:20px; cursor:pointer;" onClick="$('#packageId').val('<?php echo encode($rest['id']); ?>');$('#clientName').focus();$('#enquiryFor').val('<?php echo stripslashes($rest['name']); ?> (<?php echo $rest['days']; ?> Days - <?php echo ($rest['days']-1); ?> Nights)');"><input type="submit" value="Preview" style="padding: 10px; background-color:#ffc60;"></a></td>
	<td colspan="2"><a   style="margin-bottom:20px; cursor:pointer;" onClick="$('#packageId').val('<?php echo encode($rest['id']); ?>');$('#clientName').focus();$('#enquiryFor').val('<?php echo stripslashes($rest['name']); ?> (<?php echo $rest['days']; ?> Days - <?php echo ($rest['days']-1); ?> Nights)');"><input type="submit" value="Enquiry" style="padding: 10px; background-color:#3fced3;"></a></td>
    
  </tr>
</table>

            </div>
            </div>
			
			<?php $totalno++; } } ?>
           
        </div>
    </div>
</section>

<section class="contact-infomation" style=" background-color:#f7f7f7;padding-bottom: 0px;" id="contactUs"> 
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-6">
                 <img src="<?php echo $fullurl; ?>images/about-one-img-1.png" style="width:100%;">
            </div>
            <div class="col-lg-7 col-md-6">
                <div class="contact-infomation__item contact-infomation__item--padding">
                    <div class=" contact-infomation__info">
                        <h5>Contact Information</h5> 
                        <div class="contact-infomation__info__address">
                            <div class="contact-infomation__info__address-item">
                                <img src="<?php echo $landingpagedatas; ?>assets/images/addresst.png" alt="contact-addresst" style="height: 25px;">
                                <span><?php echo stripslashes($landingpageres['address']); ?></span>
                            </div>
                            <div class="contact-infomation__info__address-item">
                                <img src="<?php echo $landingpagedatas; ?>assets/images/mail.png" alt="contact-mail" style="height: 25px;">
                                <span><?php echo stripslashes($landingpageres['emailId']); ?></span>
                            </div>
                            <div class="contact-infomation__info__address-item">
                                <img src="<?php echo $landingpagedatas; ?>assets/images/phone.png" alt="contact-phone" style="height: 25px;">
                                <span><?php echo stripslashes($landingpageres['contactNumber']); ?></span>
                            </div>
                        </div><p class="somedia">
 <?php if($landingpageres['facebook']!=''){ ?><a href="<?php echo $landingpageres['facebook']; ?>" target="_blank"><i class="fa fa-facebook-square" aria-hidden="true"></i></a><?php } ?>
 <?php if($landingpageres['instagram']!=''){ ?><a href="<?php echo $landingpageres['instagram']; ?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a><?php } ?>
<?php if($landingpageres['twitter']!=''){ ?><a href="<?php echo $landingpageres['twitter']; ?>" target="_blank"><i class="fa fa-twitter-square" aria-hidden="true"></i></a><?php } ?>
<?php if($landingpageres['youtube']!=''){ ?><a href="<?php echo $landingpageres['youtube']; ?>" target="_blank"><i class="fa fa-youtube-square" aria-hidden="true"></i></a><?php } ?>
<?php if($landingpageres['pinterest']!=''){ ?><a href="<?php echo $landingpageres['pinterest']; ?>" target="_blank"><i class="fa fa-pinterest-square" aria-hidden="true"></i></a><?php } ?>
						
						</p>
                    </div>
                    <div class="contact-infomation__working-time">
                        <h5>Working Hours</h5>
                        <p>We are always here for you 24x7 Support</p>
                        
                    </div>
                </div>
            </div>
        </div>

         
    </div>


</section>

<script src="<?php echo $landingpagedatas; ?>assets/scripts/jquery-3.4.1.js"> </script>
<!--
<script src="<?php echo $landingpagedatas; ?>assets/scripts/countdownsale.js"></script>
-->

<!-- Choose tuor destination index 4 -->

 
<footer>
    <div class="scroll-top">
    <i class="fas fa-angle-up"></i>
</div>
     
    <div class="copyright-style3">
        <div class="container">
            <div class="copyright__area">
                <div class="copyright__license">
                    Copyright <i class="far fa-copyright"></i> <?php echo date('Y'); ?> <?php echo stripslashes($companydata['invoiceCompany']); ?>. All Rights Reserved.
                </div>
                 
            </div>
			 
        </div>
		
		
		
    </div>
	
	
	
</footer>
	<script>
  

$(document).ready(function(){
    $("#startDatestart").datepicker({
        numberOfMonths: 2,dateFormat: 'dd-mm-yy',
        onSelect: function(selected) {
          $("#endDateend").datepicker("option","minDate", selected)
        }
    });
    $("#endDateend").datepicker({dateFormat: 'dd-mm-yy',
        numberOfMonths: 2,
        onSelect: function(selected) {
           $("#startDatestart").datepicker("option","maxDate", selected)
        }
    });  
});

  $( function() {
    $( "#startDatestart" ).datepicker({ 
	  dateFormat: 'dd-mm-yy' 
      });
	  
	  $( "#endDateend" ).datepicker({ 
	  dateFormat: 'dd-mm-yy' 
      });
  } );
 
</script>
<script src="<?php echo $landingpagedatas; ?>assets/scripts/jquery-3.4.1.js"> </script>

<script src="<?php echo $landingpagedatas; ?>assets/scripts/slick.min.js"></script>
<script src="<?php echo $landingpagedatas; ?>assets/scripts/jquery.datepicker2.js"></script>
<script src="<?php echo $landingpagedatas; ?>assets/scripts/isotope.pkgd.min.js"></script> 
<script src="<?php echo $landingpagedatas; ?>assets/scripts/app.js"></script>


<?php echo stripslashes($landingpageres['footerScript']); ?>

<iframe style="display:none;" id="actoinfrm" name="actoinfrm"></iframe>
</body>

<style>
.float{
	position:fixed;
	width:60px;
	height:60px;
	bottom:40px;
	right:40px;
	background-color:#25d366;
	color:#FFF;
	border-radius:50px;
	text-align:center;
  font-size:30px;
	box-shadow: 2px 2px 3px #999;
  z-index:100;
}

.my-float{
	margin-top:16px;
}
</style>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<a href="https://api.whatsapp.com/send?phone=917303168331&text=Hello!!" class="float" target="_blank">
<i class="fa fa-whatsapp my-float"></i>
</a>


 
</html>