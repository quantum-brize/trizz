<?php  
include "inc.php";  
include "config/logincheck.php";  
$page='visa';
$selectedpage='visa';
  
$rs=GetPageRecord('*','cmsPages','url="visa"');  
$pagecontent=mysqli_fetch_array($rs); 
?>

<!DOCTYPE html>

<html lang="en">



<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">



<title>Visa - <?php echo $pagecontent['metaTitle']; ?></title> 
<meta name="Description" content="<?php echo $pagecontent['metaDesctiption']; ?>" /> 
<meta name="keywords" content="<?php echo $pagecontent['metaKeyword']; ?>">

<?php include "headerinc.php"; ?>

<style>
.newvisacountrybox { display: grid; grid-template-columns: repeat(7,1fr); justify-content: center; grid-gap: 20px; }
.newcountryvisa { text-align: center; margin-bottom: 20px; padding: 20px; background-color: #fff; border-radius: 4px; box-shadow: 0px 0px 35px #0000001a; }
.newcountryimg { width: 70px; height: 55px; overflow: hidden; margin-bottom: 12px !important; margin: auto; }  
@media (max-width: 576px){
.holidaysearch h1{font-size: 15px !important;}
.holidaybanner{height: 260px !important;}
.holidabancontainer{top: 122px !important;}
.newvisacountrybox{grid-template-columns: auto auto auto !important;}
.newcountryvisa{padding: 6px !important;}
}
</style>
 

</head>



<body class="greybluebg">



<?php include "header.php"; ?>


<section class="holidaybanner" style="background-image: url(<?php echo $packagephotourl; ?><?php echo $pagecontent['photo']; ?>);">
    <div class="container holidabancontainer" style="padding:0px 20px;">
        <div class="row">

            <div class="col-lg-12">

                <div class="holidaysearch" style="text-align:center;">

                    <h1 style="color: #fff; background-color: #000000ba; padding: 20px; display: inline-block; font-size: 30px; border-radius: 10px; ">
					 
					<?php echo stripslashes($pagecontent['name']); ?></h1>

                     

            </div>

            </div>

        </div>

    </div>

</section>







<section class="holidaydestination"> 

	<div class="container" style="margin-top:30px;">

        <div class="row offerboxes"> 
<?php echo (stripslashes($pagecontent['description'])); ?>



<div class="newvisabox">
  <h1 style="text-align:center;margin-bottom:40px;">Select Country </h1>
  <div class="newvisacountrybox">
  
  <?php 
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 
$targetpage='display.html?ga='.$_REQUEST['ga'].'&'; 
$rs=GetRecordList('*','visaSubscriptionMaster',' where status=1 group by country_id order by id asc ','200',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){

	$ct=GetPageRecord('*','countryMaster',' id= "'.$rest['country_id'].'" '); 
	$country=mysqli_fetch_array($ct);
	
	$vt=GetPageRecord('*','VisaTypeMaster',' id= "'.$rest['visa_type_id'].'" '); 
	$visaType=mysqli_fetch_array($vt);
	
	$vt=GetPageRecord('*','visa_country',' country_id= "'.$country['id'].'" '); 
	$visaTypecountry=mysqli_fetch_array($vt);
?> <a href="<?php echo $fullurl; ?>visa-detail?id=<?php echo encode($rest['id']); ?>" style="color:#000000; font-weight:600;">
    <div class="newcountryvisa">
     
      <div class="newcountryimg">
      <img src="<?php echo $imgurl; ?><?php echo stripslashes($visaTypecountry['image']); ?>" height="80" width="80">
      </div>
      <p><?php echo stripslashes($country['name']); ?></p>
     
    </div> </a>
      <?php } ?>
   
   
  
   
   
   
 
    
     
     
   
     
     
     
      
  
   
    
   
    
  
    
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

 