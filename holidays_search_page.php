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


		 $where='';
		  
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<title>Domestic Holidays - <?php echo $websitesetting['metaTitle']; ?></title>
<?php include "headerinc.php"; ?>

  <link rel="stylesheet" type="text/css" href="slick/slick.css">
  <link rel="stylesheet" type="text/css" href="slick/slick-theme.css">
  <script src="slick/slick.js" type="text/javascript" charset="utf-8"></script>

 <style>
 .holicontainer, .travelcontainer, .lastcon {padding: 0px 60px;}
 .flexcol2div{display: grid !important; grid-template-columns: 50% 50%; gap: 25px !important;}
 .flexcol2div .hotelbookrow{flex-direction: column !important;border: 1px solid #e7e7e7; border-radius: 15px !important;}
 .flexcol2div .hotelbooking { display: flex !important; gap: 10px; flex-direction: column !important; }
 .flexcol2div .hotelimg { width: 100%; height: 215px; margin: 6px 0px;}
 .flexcol2div .Deluxe{width: 100%;border-radius: 5px}
 .flexcol2div .hotelbookrow .col-lg-12{padding: 0px;}
 .flexcol2div .hotelimg{margin: 0px; border-radius: 15px; border-bottom-left-radius: 0px !important;border-bottom-right-radius: 0px !important;}
 .hotelimg img{border-radius: 15px;border-bottom-left-radius: 0px !important;border-bottom-right-radius: 0px !important;object-fit: cover;}
 .flexcol2div .flsearchcol1 {padding: 10px 20px !important; padding-bottom: 20px !important; padding-top: 0px !important; }
 .flexcol2div .hoteltext{padding: 10px 20px !important;width: 100%;padding-top: 0px !important;margin-bottom: 5px !important;}
 .daynightdiv{margin: 0px;border: 1px solid #16477f; border-radius: 4px; padding: 2px 4px; color: #16477f; font-size: 12px; font-weight: 700;}
 .flexcol2div .hoteltext h5{font-size: 18px; text-overflow: ellipsis; white-space: nowrap; overflow: hidden; width: 75%;}
 .flexcol2div .Deluxe{background-color: #f9f9f9 !important; border: 1px solid #e5e5e5 !important;}
 .flexcol2div .incbox img{width: 25px !important;}
.hotelseachheading{position: relative !important; color: #fff !important; font-size: 26px !important; padding-top: 60px !important;margin-bottom: 0px;}
.holidaysearch .textfield{background-color: transparent;color: #fff;padding: 0px;}
.holidaysearch .textfield option{color: #000 !important;}
.labeldiv {font-size: 13px;font-weight: 500;color: #fff;text-transform: uppercase;display: block;white-space: nowrap;}
.borderdivradius{background: rgb(255 255 255 / 10%);border-radius: 4px; padding: 4px 9px;}
.holidaysearch .redbuttonsearch{font-size: 16px; text-transform: uppercase; color: #fff; font-weight: 600; background-color: var(--blue); padding: 12px; outline: 0px; border-radius: 4px !important; width: 94%; margin-left: 20px;}
.hotelfilter .card-body{border: 1px solid #e7e7e7 !important;}
.holicnt{padding-left: 20px !important; padding-right: 20px !important;}
.positiondiv{position: relative;}
.pricemainbox1{position: absolute; bottom: 15px; background-color: #000000ad; color: #fff; border-radius: 5px; right: 15px; padding: 6px 12px; text-align: center;}
.pricemainbox1 h4{font-size: 18px !important;}
.blackbox{margin-bottom: 0px !important;font-size: 10px !important;}
.hotelbookrow .btn-danger{margin-top: 0px !important;}

@media(max-width: 576px){
    
      .hotelsearchtop2{background-color: #0a223d !important; margin-top: 48px !important; padding: 7px !important; padding-bottom: 11px !important;}
      .holidaysearch{padding-left: 0px !important;}
      .borderdivradius { background: rgb(255 255 255 / 10%) !important; border-radius: 4px !important; padding: 2px 8px !important; }
      .labeldiv{font-size: 12px !important;}
      .holidaysearch .textfield{font-size: 14px !important; padding: 0px !important;}
      .holidaysearch .redbuttonsearch{font-size: 14px !important;padding: 11px 10px !important;margin-left: 5px !important;width: 100% !important;}
      .hotelseachheading{padding-top: 30px !important;font-size: 18px !important;}
      .holidaybanner{padding-left: 12px !important;height: 120px !important;background-image: url(https://e1.pxfuel.com/desktop-wallpaper/146/57/desktop-wallpaper-lake-mountains-sunset-nature-background-daeb70-mountain-sunset.jpg) !important;}
      .holidaysearch tr td{padding-left: 6px !important;}
      .holidaysearch .redbuttonsearch{margin-left: 0px !important;}
      #loadallhotels{margin-top: 0px !important;}
      .holicnt { padding-left: 10px !important; padding-right: 10px !important; }
      .flexcol2div{display: block !important; }
      .flexcol2div .hotelbookrow{border-radius: 10px !important;}
      .hotelimg img {border-radius: 10px !important; border-bottom-left-radius: 0px !important;border-bottom-right-radius: 0px !important;}     
      .holidaybanner .container{text-align: center;}
      .flexcol2div .hoteltext{padding: 10px !important; padding-top: 5px !important;}
      .flexcol2div .flsearchcol1{padding-left: 10px !important;padding-right: 10px !important;padding-bottom: 10px !important;}
      .hoteltext{margin-top: 0px !important;padding-top: 5px !important;}
      .flexcol2div .hotelimg{height: 190px !important;}

    }
 </style>
</head>

<body class="greybluebg">

<?php include "header.php"; ?>


<div class="hotelsearchtop2">
<div class="container holidabancontainer" style="top:2px;">
        <div class="row">
            <div class="col-lg-12">
                <div class="holidaysearch">
                    
                    <form  method="GET" id="formids" action="<?php echo $fullurl; ?>holidays-search" > 
				<table>
                    <tbody><tr>
                        <td width="40%">
                          <div class="borderdivradius">
                        <label class="labeldiv">STARTING FROM</label>
                            <select class="textfield"  name="holidaysdestination" style="margin-left: -3px;"> 
                                
                                   <option value="0">Select Destination</option>
	   
  <?php
	      $dm = GetPageRecord('*', 'websiteDestination', 'name in (SELECT destinations FROM sys_packageBuilder WHERE showwebsite=1)  order by rand() ');
               while ($destinationMaster = mysqli_fetch_array($dm)) {
			   ?>
 
	   <option value="<?php echo $destinationMaster['name']; ?>" <?php if($_REQUEST['holidaysdestination']==$destinationMaster['name']){?>selected="selected"<?php } ?>><?php echo $destinationMaster['name']; ?></option>
 
                                <?php } ?>
                                       
                                
                              </select>
                              </div>
                        </td>

                        <td width="40%" style="padding-left: 20px;">
                        <div class="borderdivradius">
                      <label class="labeldiv">STARTING DATE</label>
                      <input type="text" id="dt4" name="journeyDateOne" class="textfield" value="Any Time" autocomplete="off" style="min-width: 140px;">
                        </div>
                    </td>

                        <td width="20%">
                          <input type="submit" name="Submit" value="SEARCH" class="redbuttonsearch"><input type="hidden" name="action" value="flightpostaction" >
<input type="hidden" name="changesearch" id="changesearch" value="0" >
</td>
                    </tr>
                </tbody></table>
			     	</form>
            </div>
            </div>
        </div>
    </div>
</div>

<section class="holidaybanner" style="background-image: url(https://bookingdesk.travbizz.website/admin/package_image/lake-mountains-wallpaper1707300099.jpg);height: 188px;">
   <div class="container">
   <h1 class="hotelseachheading" style="position:relative;"> Holiday Tour Packages Search - <?php echo $_REQUEST['holidaysdestination']; ?></h1>
   <p style="font-size: 14px;color:#fff">Explore the World</p>
   </div>
</section>



<section class="holidaydestination"> 
	<div class="container holicontainer holicnt" style="margin-top:30px;">
        <div class="row" id="loadallhotels">
		<div class="col-3 filtersidebar hotelfilter"  id="allFilterDiv">
		<div class="card">
		<div class="card-header" style="margin-top: 0px !important;">
    Package Theme
  </div>
  
  <div class="card-body" id="allFilterDiv">
<div class="arranddep">
 
  <?php
			  $a=GetPageRecord('*','websitePackageTheme','  status=1   order by name');
 while($resttheme=mysqli_fetch_array($a)){ 
?>
    <label id="theme<?php echo str_replace(' ','-',stripslashes($resttheme['id'])); ?>" style=" display:none;"><input type="checkbox" value="<?php echo str_replace(' ','-',stripslashes($resttheme['id'])); ?>" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> <?php echo stripslashes($resttheme['name']); ?></label>
	
	
	              
				<?php  } ?>

</div> 
</div>
			<div class="card-header" style="margin-top:20px !important;">
    Duration
  </div>
  
  <div class="card-body" id="allFilterDiv">
<div class="arranddep">
 
  <?php
 $bb = GetPageRecord('*', 'sys_packageBuilder', '  showwebsite=1  and queryId=0 and grossPrice>0 and destinations like "'.$_REQUEST['holidaysdestination'].'%" group by days  order by id desc    '); 
          while ($packagelist = mysqli_fetch_array($bb)) {  
 
 
?>
    <label id="day<?php echo ($packagelist['days']); ?>" style=""><input type="checkbox"  value="day<?php echo ($packagelist['days']); ?>" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> <?php echo stripslashes($packagelist['days']-1); ?> Night(s) - <?php echo stripslashes($packagelist['days']); ?> Day(s)</label>
	
	
	              
				<?php  } ?>

</div> 
</div>
		
		</div>
		
		</div>
		
		
		<div class="col-9 cardresult flexcol2div">
		
		     <?php 
          $where = ''; 
          $p = 1; 
          $bb = GetPageRecord('*', 'sys_packageBuilder', '  showwebsite=1  and queryId=0 and grossPrice>0 and destinations like "'.$_REQUEST['holidaysdestination'].'%"  order by id desc    '); 
          while ($packagelist = mysqli_fetch_array($bb)) {  
			 
          ?>

		<script>
		$('#theme<?php echo str_replace(' ','-',stripslashes($packagelist['packageThemeId'])); ?>').show(); 
		</script>



		<div class="row bookrow hotelbookrow hotelsearchlist hotelboxx itemlist" style="width:100%;" data-category="<?php echo ($packagelist['nights']); ?>nights <?php echo str_replace(' ','-',stripslashes($packagelist['name'])); ?> <?php echo str_replace(' ','-',stripslashes($packagelist['packageThemeId'])); ?> day<?php echo ($packagelist['days']); ?>">
                  <div class="col-lg-12">
                    
                    <div class="hotelbooking">

                    <div class="positiondiv">
                        <div class="hotelimg">
                            <img src="<?php echo $packagephotourl; ?><?php echo $packagelist['coverPhoto']; ?>">
                        </div>

                        <div class="pricemainbox1">
                      <h4>&#8377;<?php echo ($packagelist['grossPrice']); ?></h4>
                      <div class="blackbox"  style="margin-left: 0px !important;">
                      <div>Price Per Person</div>  
                      </div>
                      </div>
</div>

                        <div class="hoteltext">
                          <div class="d-flex justify-content-between align-items-center"><h5><?php echo stripslashes($packagelist['name']); ?></h5>
                
                <p class="relocation daynightdiv"> <?php echo ($packagelist['days']-1); ?>N/<?php echo ($packagelist['days']); ?>D</p></div>
                            


                            <p class="relocation"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo stripslashes($_REQUEST['holidaysdestination']); ?></p>
                            <div class="Deluxe">
                             <div style="margin-top:4px;"> 

  
 
 
 
 
 <div class="incbox">
 <img src="data:image/png;base64,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" width="32">
 
 <div style=" text-align:center; font-weight:500;">Hotel</div>
 </div>
 
 
  
 <div class="incbox">
 <img src="data:image/png;base64,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" width="32">
 
 <div style=" text-align:center; font-weight:500;">Sightseeing</div>
 </div>
 
 
  
 
 <div class="incbox">
 <img src="data:image/png;base64,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" width="32">


 
 <div style=" text-align:center; font-weight:500;">Transfer</div>
 </div>
 
 
 
 <div class="incbox">
 <img src="data:image/png;base64,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" width="32">
 
 <div style=" text-align:center; font-weight:500;">Activity</div>
 </div>
 
 
 
  
 </div>
                                 
                            </div>
                        </div>
                       
                    </div>
              
                    
                  </div>
                  <div class="col-lg-12 flsearchcol1">
                    <div class="bookbtn">
                      
					 <a  target="_blank" href="<?php echo $fullurl; ?>package/<?php echo stripslashes($packagelist['seoURL']); ?>"><button type="submit" class="btn btn-danger" style="width:100%;">View Detail</button></a>
				 
                    </div>
                  </div>
                  <!-- tabs -->
              
          </div>
				
				<?php  } ?>
		</div>
		
		
		
		
		</div>
    </div> 
	
	</section>



 
	
	
	
	
	 




<?php include "footer.php"; ?>





<script>
    $("#dt4").datepicker({

      dateFormat: "dd-mm-yy",

      minDate: 0,

      onSelect: function() {

        var dt2 = $('#dt2');

        var startDate = $(this).datepicker('getDate');

        //add 30 days to selected date

        startDate.setDate(startDate.getDate() + 30);

        var minDate = $(this).datepicker('getDate');

        var dt2Date = dt2.datepicker('getDate');

        //difference in days. 86400 seconds in day, 1000 ms in second

        var dateDiff = (dt2Date - minDate) / (86400 * 1000);



        //dt2 not set or dt1 date is greater than dt2 date

        if (dt2Date == null || dateDiff < 0) {

          dt2.datepicker('setDate', minDate);

        }

        //dt1 date is 30 days under dt2 date
        else if (dateDiff > 30) {

          dt2.datepicker('setDate', startDate);

        }

        //sets dt2 maxDate to the last day of 30 days window

        dt2.datepicker('option', 'maxDate', startDate);

        //first day which can be selected in dt2 is selected date in dt1

        dt2.datepicker('option', 'minDate', minDate);

      }

    });
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
</body>
</html>
