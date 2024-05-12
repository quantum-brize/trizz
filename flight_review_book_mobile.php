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

</style>



 

<style>

.flightfooter{display:none;}



body{background-color:var(--greyouter);}

</style>







</head>

 



<body>







<?php //include "header.php"; ?>













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

<div style="text-align:center; padding:100px 0px; text-align:center;"><img src="images/loadinggif.gif" width="40" style="margin:auto;"></div>

</div>

<style>
h2 { font-size: 16px; font-weight: 800; margin-bottom: 10px; }
.col-lg-8{min-height: 500px; padding: 20px; padding-top: 0px;}
.col-lg-4{  padding: 20px; padding-top: 0px;}
#flightbookingsubmit .card { margin-top: 0px !important; margin-bottom: 0px;}
#flightbookingsubmit .card {  box-shadow: 0px 0px 0px #606060; border: 0px; }
.tabsboxxxx a{padding:10px 10px !important;}
#stepfourpayments .col-4{ width:100% !important;}
#stepfourpayments .col-4 div{border:0px !important;}
#stepfourpayments .col-8{width:100% !important; text-align:center;}
.makeReview .col-lg-8{margin-top:40px !important;}
.card-body{padding:10px !important;}
</style>

<?php



if($res['apiType']=='tripjack'){ $incfile= "flight_review_book_tripjack_mobile.php"; } 
if($res['apiType']=='kafila'){ $incfile= "flight_review_book_kafila.php"; } 
if($res['apiType']=='AK'){ $incfile="flight_review_book_AK.php"; } 
if($res['apiType']=='MF'){ $incfile="flight_review_book_MF.php"; }
if($res['apiType']=='tbo'){ $incfile="flight_review_book_tbo.php"; }
if($res['apiType']=='FD'){ $incfile="flight_review_book_FD.php"; }

 



?>



<script>

$('#reviewloadbox').load('<?php echo $incfile; ?>?i=<?php echo $_REQUEST['i']; ?>&r=<?php echo $_REQUEST['r']; ?>');

</script>



<?php include "footerinc.php"; ?>



<?php include "footer.php"; ?>



 

<div class="mfp-with-anim mfp-hide mfp-dialog" style="max-width: 610px; border-radius: 10px; padding: 10px;" id="new-card-dialog">







  <div id="view-seats"></div>







</div>



</body>

</html>



















