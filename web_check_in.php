<?php 
include "inc.php";   
?>

<!DOCTYPE html>

<html lang="en">



<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">



<title>Web Check In - <?php echo $websitesetting['metaTitle']; ?></title>  

<?php include "headerinc.php"; ?>


 

</head>



<body class="greybluebg">



<?php include "header.php"; ?>





<section class="holidaybanner" style="background-image: url(images/webcheckin.jpg);">

    <div class="container holidabancontainer" style="padding:0px 20px;">

        <div class="row">

            <div class="col-lg-12">

                <div class="holidaysearch" style="text-align:center;">

                    <h1 style="color: #fff; background-color: #000000ba; padding: 20px; display: inline-block; font-size: 30px; border-radius: 10px; ">
					 
					Web Check In</h1>

                     

            </div>

            </div>

        </div>

    </div>

</section>







<section class="holidaydestination"> 

	<div class="container" style="margin-top:30px;">

        <div class="row"> 
		
		
		<?php
$a=GetPageRecord('*','sys_webCheckMaster',' status=1 order by flightName asc');
while($data=mysqli_fetch_array($a)){  
?>
		<div class="col-lg-3">
		<a href="<?php echo stripslashes($data['url']); ?>" target="_blank"><div class="card">
		<div class="card-body" style="text-align:center;">
		<div style="width: 62px; height: 62px; margin: auto; border-radius: 5px; overflow: hidden; margin-bottom: 10px;">
		<img src="<?php echo $imgurl.$data['logo']; ?>" style="width:100%; height:100%;">
		</div>
		<div style="font-size:18px; font-weight:800; color:#000000;"><?php echo stripslashes($data['flightName']); ?></div>
		</div>
		</div></a>
		</div>
		<?php } ?>
 

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

