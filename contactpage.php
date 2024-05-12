<?php 
include "inc.php";  
?>

<!DOCTYPE html>

<html lang="en">



<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">



<title>Contact Us - <?php echo $systemname; ?></title>

<?php include "headerinc.php"; ?>


 <style>
        @media (max-width: 576px){
  .holidaybanner{height: 250px !important;}
  .holidaysearch h1{font-size: 15px !important;}
  .holidabancontainer{top: 122px !important;}
  .holidaydestination .card-body{height: auto !important;}
  .holidaydestination .card{margin-bottom: 10px !important;}
}
.contacticon .fa { font-size: 24px; color: var(--blue); margin: 6px; }
.contacticon a{ color:#333333; text-decoration:underline; font-size:14px; font-weight:500;}
.contactcardhgt{height: 255px;}
.galleryview .col-lg-6{padding-top: 0px !important;}
 </style>

</head>



<body class="greybluebg">



<?php include "header.php"; ?>





<section class="holidaybanner" style="background-image: url(images/contactbanner.png);">

    <div class="container holidabancontainer" style="padding:0px 20px;">

        <div class="row">

            <div class="col-lg-12">

                <div class="holidaysearch" style="text-align:center;">

                    <h1 style="color: #fff; background-color: #000000ba; padding: 20px; display: inline-block; font-size: 30px; border-radius: 10px; ">
					 
					Contact Us</h1>

                     

            </div>

            </div>

        </div>

    </div>

</section>







<section class="holidaydestination"> 

	<div class="container" style="margin-top:30px;">

<div class="row" style="margin:auto;">

                        <div class="col-lg-12">

                            <div style="padding:20px 0px;font-size: 14px;font-weight:600;">
                                   
                                    <div class="row"> 
									
									<div class="col-lg-12">
									<div style="padding:20px; color:#fff; background-color: var(--blue);border-radius: 10px; margin-bottom:20px;">
									<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"> 
<img src="questioniconhealp.png" style="width: 40px; margin-right: 10px;">
</td>
    <td width="99%"><h1 style="margin-bottom:0px;">Need Assistance? We are here to help you!</h1>More customer support options below. Choose one that suits you most.</td>
  </tr>
</table>

									</div>
									</div>
									
									
									
                                        <div class="col-lg-6 " style="padding-top: 0px !important;">
                                            <div class="card contactcardhgt" style="  margin-top: 0px;">
                                       
                                                         <div class="card-header">
                                       
                                                            <div class="card-title" style="margin-bottom:0px;"><strong>Get In Touch With Us</strong></div>
                                       
                                                         </div>
                                       
                                                         <div class="card-body" style="min-height: 194px;">
                                       <?php if($_REQUEST['i']==1){ ?>
				 
				<div style="text-align:center; padding-top:100px;">
				
				<h2>Thank You!</h2>
				<div style="text-align:center; font-size:14px;">Your query has been submitted successfully. <br>
We will contact you shortly.</div>
				</div> 
				 
				 
				 <?php } else { ?>

                                                        
                                                            <form action="contactaction" method="post" > 
                                       				<div class="row">
													<div class="col-lg-6">
                                                               <div class="form-group"> <input type="text" class="form-control" name="firstName" placeholder="Full Name" required=""> </div>
                                        			</div>
													<div class="col-lg-6">
                                                               
                                                               <div class="form-group"> <input type="number" class="form-control" name="phone" placeholder="Phone Number" required=""> </div>
                                       </div>
									   
									   	
									   
													<div class="col-lg-6">
                                                               
                                                               <div class="form-group"> <input type="email" class="form-control" name="email" placeholder="Email Address" required=""> </div>
                                       </div><div class="col-lg-6">
                                                               
                                                               
                                       
                                                               <div class="form-group"> <textarea class="form-control" name="message" rows="2" placeholder="Message" required=""></textarea> 
                                                               </div>
                                       </div>	<div class="col-lg-6">
										&nbsp;&nbsp;&nbsp;
										</div>
									   
									   <div class="col-lg-6">
										       <button type="submit" class="btn sendbutton" style="margin-top:0px; width:100%;">Send Message</button> 
										</div>
										
									
													
													<div class="col-lg-6">
                                                               
                                                               <input type="hidden" name="action" value="sendcontactform">
                                            </div>
                                                        
                                       </div>
                                                            </form>
                                                            <?php } ?>
                                                            
                                                         </div>
                                       
                                                      </div>
                                       </div>
									   
									    <div class="col-lg-3 ">
										  <div class="card contactcardhgt" style="  margin-top: 0px;">
                                       
                                                         <div class="card-header">
														 Manage Your Booking
														 </div>
														 <div class="card-body contacticon"  style="padding: 26px 20px;" >
														 <table>
                        <tbody><tr>
                            <td align="center"><i class="fa fa-inr" aria-hidden="true"></i></td>
                            <td>
                                <a href="#" id="login_pop" onclick="loadpop('Status of Refund',this,'500px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=contactquery&type=Status of Refund">Status of Refund</a>
                            </td>
                        </tr>
                        <tr>
                            <td align="center"><i class="fa fa-calendar" aria-hidden="true"></i></td>
                            <td><a href="#" id="login_pop"  onclick="loadpop('Schedule Changes',this,'500px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=contactquery&type=Schedule Changes">Schedule Changes</a></td>
                        </tr>
                       
                        <tr>
                            <td align="center"><i class="fa fa-wheelchair-alt" aria-hidden="true"></i></td>
                            <td><a href="#" id="login_pop"   onclick="loadpop('Special Service Request',this,'500px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=contactquery&type=Special Service Request">Special Service Request</a></td>
                        </tr>
                        <tr>
                            <td align="center"><i class="fa fa-times-circle-o" aria-hidden="true"></i></td>
                            <td><a href="#" id="login_pop"   onclick="loadpop('Booking Cancellation',this,'500px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=contactquery&type=Booking Cancellation">Booking Cancellation</a></td>
                        </tr>
                      
                        
                    </tbody></table>
														 </div>
														 </div>
										</div>
										
										
										<div class="col-lg-3">
										  <div class="card contactcardhgt" style="  margin-top: 0px;">
                                       
                                                         <div class="card-header">
														 Find info Before You Travel
														 </div>
														 
														 <div class="card-body contacticon" style="padding: 26px 20px;"  >
														 <table >

                        <tbody><tr>
                            <td align="center"><i class="fa fa-suitcase" aria-hidden="true"></i></td>
                            <td><a href="#" onclick="loadpop('Baggage Charges',this,'500px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=contactquery&type=Baggage Charges"  >Baggage Charges</a></td>
                        </tr>
                        <tr>
                            <td align="center"><i class="fa fa-phone-square" aria-hidden="true"></i></td>
                            <td><a href="#" id="login_pop" onclick="loadpop('Request Callback',this,'500px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=contactquery&type=Request Callback"  >Request Callback</a></td>
                        </tr>
                        <tr>
                            <td align="center"><i class="fa fa-print" aria-hidden="true"></i></td>
                            <td><a href="#" id="login_pop" onclick="loadpop('View/Print Itinerary',this,'500px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=contactquery&type=View/Print Itinerary"  >View/Print Itinerary</a></td>
                        </tr>
                        <tr>
                            <td align="center"><i class="fa fa-desktop" aria-hidden="true"></i></td>
                            <td><a href="#" id="login_pop"  onclick="loadpop('Get E-Ticket Number',this,'500px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=contactquery&type=Get E-Ticket Number"  >Get E-Ticket Number</a></td>
                        </tr>
                        
                    </tbody></table>
														 </div>
														 </div>
										</div>
									   
									   
									    <div class="col-lg-6" style="margin-top:20px;">
											<div class="card" style="margin-top: 0px;  font-weight: 500;  min-height: 457px;"  >
									<div class="card-body"  >
									  <p><span style="color: var(--blue);"><strong><?php echo $websitesetting['companyName']; ?></strong></span> is famed for its friendly and caring 24/7 customer support. Affectionately called ‘Trip Experts’ our customer service team renders the best travel solutions for you and your loved ones. Making travel easy for you is our goal. As travelers themselves, our patient customer support staff understands the value of your travel and is ready to provide latest and valuable travel information, around the clock.</p>
									  <div>
									    <h2>We’re here to help you:</h2>
								      </div>
									  <div>
									    <ul>
									      <li><strong>Research–</strong>Our Trip Experts have an average experience of five to ten years and they have traveled all around the globe. So you get the best guidance and assistance when it comes to exploring any destination.</li>
									      <li><strong>Booking –</strong>We never miss out on the minute details while seeking the discount vacation packages for you. Our team will take care of all the small and deft touches so that you don’t miss out on those memories.</li>
									      <li><strong>Travel –</strong>Our team is there ‘before, during and after’ your travel. Just contact us anytime during the trip or share views once you get back home.</li>
								        </ul>
								      </div>
									</div>
										</div>
										</div>
										
										
                                        <div class="col-lg-6"  style="margin-top:20px;">
                                            <div class="card" style="margin-top:0px;">
                                            <div class="card-body"  >
                                                
                                                <div  class="contacttabscont">
                                                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                  <tbody><tr>
                                                    <td colspan="2" style="background-color: var(--blue);  border-radius: 10px;"><div  class="contacticons"><i class="fa fa-map-marker" aria-hidden="true"></i></div></td>
                                                    <td width="99%" style="padding-left:10px;" class="contactcontent"><div class="contactlable">Address</div>
                                                <?php echo $websitesetting['contactAddress']; ?></td>
                                                  </tr>
                                                </tbody></table>
                                                
                                                 </div>
                                                 
                                                 
                                                 <div  class="contacttabscont">
                                                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                  <tbody><tr>
                                                    <td colspan="2" style="background-color: var(--blue); border-radius: 10px;"><div  class="contacticons"><i class="fa fa-phone" aria-hidden="true"></i></div></td>
                                                    <td width="99%" style="padding-left:10px;" class="contactcontent"><div class="contactlable">Phone</div>
													<?php echo $websitesetting['contactPhone']; ?></td>
                                                  </tr>
                                                </tbody></table>
                                                
                                                 </div>
                                                 
                                                 <div  class="contacttabscont">
                                                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                  <tbody><tr>
                                                    <td colspan="2"  style="background-color: var(--blue);  border-radius: 10px;"><div  class="contacticons"><i class="fa fa-envelope" aria-hidden="true"></i></div></td>
                                                    <td width="99%" style="padding-left:10px;" class="contactcontent"><div class="contactlable">Email</div>
                                                      <a href="mailto:<?php echo $websitesetting['contactEmail']; ?>"><?php echo $websitesetting['contactEmail']; ?></a></td>
                                                  </tr>
                                                </tbody></table>
                                                
                                                 </div>
                                                 
                                                 <div  class="contacttabscont">
                                                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                  <tbody><tr>
                                                    <td colspan="2"  style="background-color: var(--blue);  border-radius: 10px;"><div  class="contacticons"><i class="fa fa-clock-o" aria-hidden="true"></i></div></td>
                                                    <td width="99%" style="padding-left:10px;" class="contactcontent"><div class="contactlable">Working Hours</div>  
                                                Mon – Sun 10:00 am – 7:00 pm We are open 24*7 of every month, including Sundays & public holidays</td>
                                                  </tr>
                                                </tbody></table>
                                                
                                                 </div>
                                                
                                                </div>
                                            </div>
                                        </div>
										 
                                    </div>
                                </div> 
                        


                        </div>

                    </div>

    </div> 

	

	</section>
 



<?php include "footer.php"; ?>

















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
 <?php include "footerinc.php"; ?>
</body>

</html>

