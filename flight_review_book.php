<?php  

include "inc.php";  

include "config/logincheck.php";  

$page='flights';


$a=GetPageRecord('*','wig_flight_json_bkp',' id="'.decode($_REQUEST['i']).'" and agentId="'.$_SESSION['agentUserid'].'"');



$res=mysqli_fetch_array($a);



?>

<!DOCTYPE html>



<html lang="en"  class="greybluebg">







<head>



    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">



    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />



    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">







<title>Flight Booking Review - <?php echo stripslashes($getcompanybasicinfo['companyName']); ?></title>



<?php include "headerinc.php"; ?>







<style>

body{background-color:var(--greyouter) !important;}

.hidecomm{display:none;}

.showonlyaftercheck{display:none;}

.opencloseprice { background-color: #4c4c4c; color: #fff; display: inline-block; padding: 0px 5px; border-radius: 10px; cursor: pointer; margin-left: 5px; width: 18px; text-align: center; }

@media (max-width: 575.98px) {
  .faresummrybox{display: none;}
  #flightbookingsubmit .col-8{width: 100% !important;}
  
}
@media (min-width:1000px) {
.faresummryboxflight { position: absolute; right: 0px; width: 300px; top: 0px; }
}


 .bookingreviewbg { background-color: var(--blue); position: absolute; left: 0px; top: 0px; width: 100%; height: 400px; z-index:0; }
.flightreview .container{display:none;}
.flightfooter{display:none;}
#flightbookingsubmit { margin-top: 80px !important; }
h2 { font-size: 24px !important; font-weight:700 !important; } 
.heMTZI { padding: 16px; border: 1px solid rgb(228, 228, 228); border-radius: 8px; margin-top: 10px; font-size: 14px; color: #222222; font-weight: 600; }
.cKtGum { font-size: 15px; background-color: rgb(229, 243, 255); padding: 4px; border-radius: 4px; display: inline; margin-top: 10px; }
.cKtGumtime { font-size: 24px; font-weight: 800; color: #000000; margin-bottom: 0px; }
.cKtGumcode { font-size: 18px; font-weight: 800; color: #000000; margin-bottom: 0px; }
.cKtGudurationouter { border-bottom: 2px dashed #c5c5c5; margin: 20px 0px; width: 100%; height: 0px; text-align: center; font-weight:500; }
.cKtGudurationouter div{  font-weight:400; }
.cKtGudurationouter span { display: inline-block; padding: 3px 10px; background-color: #FFFFFF; font-size: 17px; margin-top: -124px; padding-top: 0px;  }
.eNECmC { background-color: rgb(247, 247, 247); margin: 24px 0px; padding: 20px 16px 16px; text-align: center; margin-top: 24px !important;     font-weight: 400; }
.cKtGumairport { font-size: 13px; font-weight: 600; color: #717171; margin-bottom: 0px;   font-weight: 400; }
.ipLpOd { margin-top: 16px; padding-top: 16px; border-top: 1px solid rgb(228, 228, 228);     font-weight: 500;}
.cancellationbtn { float: right; position: absolute; right: 0px; top: 14px; }
body{background-color:var(--greyouter);}

</style>







</head>



<?php include "header.php"; ?>



<body>







<?php include "header.php"; ?>





<div class="bookingreviewbg"></div>







<!--<div style="position: fixed; bottom: 10px; right: 10px; width: 230px; text-align: center; background-color: #c51919; color: #fff; font-weight: 600; font-size: 16px; z-index: 9999; padding: 12px; border-radius: 10px;">Your session will expire in <span id="timer"></span>:<span id="timerseczero"></span><span id="timersec"></span></div>-->



<script>



  var n=59; 



  var m=19; 



  var intervalId = window.setInterval(function(){



  if(m==0 && n<2){



  $('#timer').text('0');



  $('#timersec').text('0 min.');



  	//window.location.reload();



  	 window.location = "<?php echo $fullurl; ?>";



  }



  if(n==1){



  	n=59;



	m=(m-1);



  }



  if(n<10){



  	$('#timerseczero').text('0');



  }else{



  	$('#timerseczero').text('');



  }



  $('#timer').text(m);



  $('#timersec').text(n+' min.');



   n--;



}, 1000);</script>







<div style="width:100%; overflow:visible;" id="reviewloadbox">

<div style="padding: 100px 0px; margin-top: 110px; text-align: center; z-index: 9999; position: absolute; width: 100%;"><img src="images/loading.gif" width="40" style="margin:auto;"></div>

</div> 
<?php



if($res['apiType']=='tripjack'){ $incfile= "flight_review_book_tripjack.php"; } 

if($res['apiType']=='kafila'){ $incfile= "flight_review_book_kafila.php"; } 

if($res['apiType']=='AK'){ $incfile="flight_review_book_AK.php"; } 

if($res['apiType']=='MF'){ $incfile="flight_review_book_MF.php"; }


if($res['apiType']=='tbo'){ $incfile="flight_review_book_tbo.php"; }
if($res['apiType']=='FD'){ $incfile="flight_review_book_FD.php"; }

 



?>



<script>

 $('#reviewloadbox').load('<?php echo $incfile; ?>?i=<?php echo $_REQUEST['i']; ?>&r=<?php echo $_REQUEST['r']; ?>');

</script>




<?php include "footer.php"; ?>



 

<div class="mfp-with-anim mfp-hide mfp-dialog" style="max-width: 610px; border-radius: 10px; padding: 10px;" id="new-card-dialog">







  <div id="view-seats"></div>







</div>



</body>

</html>



















