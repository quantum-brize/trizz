<?php 
include "inc.php";   
?>

<!DOCTYPE html>

<html lang="en">



<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">



<title>Offers - <?php echo $websitesetting['metaTitle']; ?></title>  

<?php include "headerinc.php"; ?>


<style>
.card { margin-top: 20px; border: 0px; box-shadow: 2px 2px 15px #00000029; }
</style>

</head>



<body class="greybluebg">



<?php include "header.php"; ?>


  

<section class="holidaydestination"> 

	<div class="container" style="margin-top:100px;padding: 0% 10%;">

        <div class="row"> 
		<h1>Exciting Deals &amp; Offers</h1>
		
		<?php
$a=GetPageRecord('*','sys_specialDeal',' status=1 order by rand()');
while($data=mysqli_fetch_array($a)){  
?>
		<div class="col-lg-6">
		<a  onClick="loadpop('Deal / Offer',this,'700px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewdetails&id=<?php echo encode($data['id']); ?>" ><div class="card">
		<div class="card-body" style="text-align:left;">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"><div style="width: 128px; height: 100px;  border-radius: 5px; overflow: hidden; ">
		<img src="<?php echo $imgurl; ?><?php echo $data['image']; ?>"  style="width:100%; height:100%;">
		</div></td>
    <td width="90%" style=" padding-left:10px;">
	<div style="font-size:16px; font-weight:800; color:#000000; margin-bottom:10px;"><?php echo stripslashes($data['title']); ?></div>
	<div style=" width:100%; overflow:hidden;">
	<?php if($data['dealType']=='flight'){ ?>
	<div style=" padding:5px 10px; font-size:12px; color:#FFFFFF; background-color:#0066CC; float:left;border-radius: 5px;">Flight</div>
		<?php } ?>
	<?php if($data['dealType']=='hotel'){ ?>
	<div style=" padding:5px 10px; font-size:12px; color:#FFFFFF; background-color:#FF6600; float:left;border-radius: 5px;">Hotel</div>
	<?php } ?>
	
	</div>
	
	</td>
  </tr>
</table>

		
		
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

