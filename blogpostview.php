<?php  
include "inc.php";   
$page='holidays'; 
$selectedpage='blog'; 

$rsa=GetPageRecord('*','websiteBlog','id="'.decode($_REQUEST['id']).'"'); 
$pagecontent=mysqli_fetch_array($rsa); 

?>

<!DOCTYPE html>

<html lang="en">



<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">



<title><?php echo $pagecontent['metaTitle']; ?></title> 
<meta name="Description" content="<?php echo $pagecontent['metaDesctiption']; ?>" /> 
<meta name="keywords" content="<?php echo $pagecontent['metaKeyword']; ?>">

<?php include "headerinc.php"; ?>


 <style>
.card { margin-top: 20px; border: 0px; box-shadow: 2px 2px 15px #00000029; }
</style>


</head>



<body class="greybluebg">



<?php include "header.php"; ?>





<section class="holidaybanner" style="background-image: url(<?php echo $blogphoto; ?><?php echo $pagecontent['photo']; ?>);">

    <div class="container holidabancontainer" style="padding:0px 20px;">

        <div class="row">

            <div class="col-lg-12">

                <div class="holidaysearch" style="text-align:center;">

                    <h1 style="color: #fff; background-color: #000000ba; padding: 20px; display: inline-block; font-size: 30px; border-radius: 10px; ">
					<div style="text-align:center; font-size:16px;  margin-bottom:20px;"><a href="<?php echo $fullurl; ?>" style="color:#fff; text-decoration:underline;">Home</a> &nbsp;&nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i> &nbsp;&nbsp;<a href="<?php echo $fullurl; ?>blog" style="color:#fff; text-decoration:underline;">Blog</a></div>
					<?php echo stripslashes($pagecontent['name']); ?></h1>

                     

            </div>

            </div>

        </div>

    </div>

</section>







<section class="holidaydestination"> 

	<div class="container holicontainer">

        <div class="row"> 
		
		<div class="card"><div class="card-body"><?php echo str_replace('/scgtest/team-explore/',''.$agentlogin.'scgtest/team-explore/',stripslashes($pagecontent['description'])); ?></div></div>

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

