<?php  
include "inc.php";  
include "config/logincheck.php";  
$page='visa';
$selectedpage='visa';
  
$rs=GetPageRecord('*','cmsPages','url="visa"');  
$pagecontent=mysqli_fetch_array($rs); 

$rs=GetPageRecord('*','visaSubscriptionMaster','id="'.decode($_REQUEST['id']).'"');  
$visainfo=mysqli_fetch_array($rs); 

$ct=GetPageRecord('*','countryMaster',' id= "'.$visainfo['country_id'].'" '); 
$country=mysqli_fetch_array($ct); 


$vt=GetPageRecord('*','visa_country',' country_id= "'.$country['id'].'" '); 
$visaTypecountry=mysqli_fetch_array($vt);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<title><?php echo stripslashes($country['name']); ?> - Visa - <?php echo $pagecontent['metaTitle']; ?></title> 

<?php include "headerinc.php"; ?>

<style>
.applyheading { font-size: 22px; text-align: center; margin-bottom: 30px; color: #fff; font-weight: 400 !important; }
.applybox { display: flex; gap: 90px; justify-content: center; }
.apponebox{display:inline-block; color:#FFFFFF; text-align:center;}
.applyimg{ margin-bottom:5px;}
.contentdetails div{font-family: 'Quicksand', sans-serif !important; font-weight:600 !important; font-size:14px !important;}
.contentdetails span{font-family: 'Quicksand', sans-serif !important; font-weight:600 !important; font-size:14px !important;}
.contentdetails table{font-family: 'Quicksand', sans-serif !important; font-weight:600 !important; font-size:14px !important;}
.contentdetails strong{font-family: 'Quicksand', sans-serif !important; font-weight:800 !important; font-size:20px !important;}
.contentdetails strong span{font-family: 'Quicksand', sans-serif !important; font-weight:800 !important; font-size:20px !important;}
.contentdetails table{ border:1px solid #ddd;}
.contentdetails table tr td{ border:1px solid #ddd; padding:5px;}
.contentdetails th{ border:1px solid #ddd; padding:5px; background-color:#F8F8F8;}
</style>
 

</head>



<body class="greybluebg">



<?php include "header.php"; ?>





<section class="holidaybanner" style="  background-color: #2a2a97; background-image:none;">

    <div class="container holidabancontainer" style="padding:0px 20px; top:125px;">

        <div class="row">

            <div class="col-lg-12">

                    <div class="row" style="margin:auto;padding:0px;">
                     <div class="col-lg-12" style="padding:0px;">
                        <div class="apply">
                           <h1 class="applyheading">APPLY FOR YOUR VISA ONLINE IN 3 SIMPLE STEPS</h1>
                           <div class="applybox">
                              <div class="apponebox">
                                 <div class="applyimg">
                                    <img src="images/v1.png" alt="">
                                 </div>
                                 <p>Fill Application Form</p>
                              </div>
                              <div class="apponebox">
                                 <div class="applyimg">
                                    <img src="images/v2.png" alt="">
                                 </div>
                                 <p>Verify Payment</p>
                              </div>
                              <div class="apponebox">
                                 <div class="applyimg">
                                    <img src="images/v3.png" alt="">
                                 </div>
                                 <p>Recive Vlog in E-mail</p>
                              </div>
                           </div>
                        </div>
                        
                     </div>
                  </div>

            </div>

        </div>

    </div>

</section>







<section class="holidaydestination"> 

	<div class="container" style="margin-top:30px;">

        <div class="row offerboxes"> 
<div class="applydetail">
                           <div style="width:170px;height:125px;overflow:hidden;margin:auto;margin-bottom:30px;" class="mainvisaimg">
                              <img style="width:100%;height:auto;min-height:100%;object-fit:cover;" src="<?php echo $imgurl; ?><?php echo stripslashes($visaTypecountry['image']); ?>" alt="">
                           </div>
                           <div style="width:650px;margin:auto;text-align:center;" class="visawidth">
                              <div>
                                 <h1 style="font-size:26px;color:#5d8eff;margin-bottom:10px;color:#fc4a02;font-weight:bolder;"><?php echo stripslashes($country['name']); ?></h1> 
                                 <p></p>
                              </div>
                               
                           </div>
                           <div class="row">
						   
						   <div class="col-lg-12" style="margin-bottom:30px;">
						   <div class="card">
						   <div class="card-body contentdetails">
						   <?php echo stripslashes($visaTypecountry['terms']); ?>
						   </div>
						   </div>
						   </div>
						      <form action="" class="visaenquiryform"> 
						   <div class="col-lg-12" style="margin-bottom:30px;">
						   <div class="card">
						   <div class="card-body contentdetails">
						   <h2>Select Visa Plan</h2>
						 <table width="100%" class="table">
							<thead>
								<tr>
								  <th width="1%" align="left" valign="middle">&nbsp;</th>
								<th align="left" valign="middle"><div align="left">Visa Type</div></th>
									<th align="left" valign="middle"><div align="left">Entry</div></th>
									
									<th align="left" valign="middle"><div align="left">Duration</div></th>
									<th align="left" valign="middle"><div align="left">Price</div></th>
								</tr>
							</thead>
							<tbody>
<?php 
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 
$targetpage='display.html?ga='.$_REQUEST['ga'].'&'; 
$rs=GetRecordList('*','visaSubscriptionMaster',' where addedBy=1 and status=1 and country_id="'.$visainfo['country_id'].'" order by id asc ','100',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){

	$ct=GetPageRecord('*','countryMaster',' id= "'.$rest['country_id'].'" '); 
	$country=mysqli_fetch_array($ct);
	
	$vt=GetPageRecord('*','VisaTypeMaster',' id= "'.$rest['visa_type_id'].'" '); 
	$visaType=mysqli_fetch_array($vt);
?>
								
<tr>
  <td width="1%" align="left" valign="middle"> 
    <input name="visaSubscription" type="radio" value="Entry: <?php echo stripslashes($rest['entry']); ?> - Duration: <?php echo stripslashes($rest['duration']); ?> - <?php if($ifnotlogin['userType']=='client' || $ifnotlogin['userType']=='b2cwebsite'){  echo round($rest['price']+$rest['b2cMarkup']); } else { echo round($rest['price']+$rest['b2bMarkup']);  }  ?> INR" style="width:30px; height:20px;" <?php if($sNo==1){ ?> checked="checked"<?php } ?>></td>
	<td align="left" valign="middle"><div align="left"><?php echo stripslashes($visaType['name']); ?></div></td>
	<td align="left" valign="middle"><div align="left"><?php echo stripslashes($rest['entry']); ?></div></td>
	<td align="left" valign="middle"><div align="left"><?php echo stripslashes($rest['duration']); ?> Days</div></td>
	<td align="left" valign="middle">
	
	  <div align="left">
	    <?php if($ifnotlogin['userType']=='client' || $ifnotlogin['userType']=='b2cwebsite'){  echo  convertfromtocurrencywithcurr('INR',$_SESSION['currency'],round($rest['price']+$rest['b2cMarkup'])); } else { echo  convertfromtocurrencywithcurr('INR',$_SESSION['currency'],round($rest['price']+$rest['b2bMarkup']));  }  ?>
	  </div></td>
	</tr>
	<?php $sNo++; } ?>
</tbody>
</table>
						   </div>
						   </div>
						   </div>
						   
                              <div class="col-lg-6" style="margin:auto;">
                                 <div class="bottom_box">
                                    <h2>Visa Enquiry Form</h2>
                                    <div class="card-body">
                                    
										  
										  <div class="form-group"> </div>
										  
						<?php
						if($ifnotlogin['userType']=='client' || $ifnotlogin['userType']=='agent'){
						 
						
						$rsa=GetPageRecord('*','sys_userMaster','id="'.$_SESSION['agentUserid'].'"');  
						$autofillcontent=mysqli_fetch_array($rsa); 
						}
						
						?>
                                 
                                          <div class="form-group"><input type="text" class="form-control" name="fullName" placeholder="Full Name" required="" value="<?php if($autofillcontent['firstName']!=''){ echo $autofillcontent['firstName']; ?> <?php echo $autofillcontent['lastName']; } ?>"></div>
                                          <div class="form-group"> <input type="text" class="form-control" name="phone" placeholder="Phone Number" required value="<?php echo $autofillcontent['mobile']; ?>"> </div>
                                          <div class="form-group"> <input type="email" class="form-control" name="email" placeholder="Email Address" required value="<?php echo $autofillcontent['email']; ?>"> </div>
                                          <div class="form-group"> <textarea class="form-control" name="message" rows="6" placeholder="Message" required value=""></textarea> </div>
                                          <input type="hidden" name="action" value="sendvisaform">
                                          <button type="submit" name="visaenquiryform" class="btn btn-primary btn-block">Send Enquiry</button>
                                    
                                    </div>
                                 </div>
                              </div>
							  </form>
                               
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

