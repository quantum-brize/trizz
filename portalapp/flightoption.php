<?php
include "inc.php";
 
$cookie_name = "user";
if (!isset($_COOKIE[$cookie_name])) {
} else {
  $cookieuserid = $_COOKIE[$cookie_name];
}
if ($cookieuserid > 0) {
  $_SESSION['userId'] = $cookieuserid;
}



  $url = $basesiteurl."flightoption_mobile.php"; 
 $ch = curl_init($url);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);

		$data = array(
		'MemberId' => $_SESSION['userId'],
		'id' =>  $_REQUEST['id']
); 

curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
$contents = curl_exec($ch);
$contentres=json_decode($contents,true); 
curl_close($ch); 

 
include "../config/database.php";  
 include "../config/function.php";   
include "../flight_setting.php"; 





$rs=GetPageRecord('*','sys_userMaster','id="'.$_SESSION['userId'].'" ');  
$userinfo=mysqli_fetch_array($rs); 

$_SESSION['agentUserid']=$userinfo['id'];   
$_SESSION['parentAgentId']=$userinfo['parentAgentId'];  
$_SESSION['agentUsername']=$userinfo['email'];    
$_SESSION['parentid']=$userinfo['parentId'];  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
  <title>Flight</title>
  <?php
  include "headerinc.php";
  ?>

  <script>
    function opendashboard() {
      $('body').removeClass('loginbg');
      $('body').load('dashboard.php');
    }
  </script>

  <style>
    body {
      background-color: #f0f7fe;
    }

    .packagebox .name {
      white-space: inherit !important;
      font-weight: 500 !important;
    }
  </style> 
</head>

<body style="background-color: var(--base-color) !important;">

  <div class="innerpageaccountheader" style="width:100% !important;"><i class="fa fa-arrow-left" aria-hidden="true" onclick="closeWindow();"></i>Flight Details<?php //print_r($contentres); ?></div>
  <div class="mainallcontent">

    <div class="bodypading" style="margin-top: 55px;">


    <div class="flightdetailsdiv">
             <div class="triptrvl"><p>Trip to</p> <h2 style="font-size:24px;"><?php echo $contentres['FlightSearchTerms'][0]['TripFromTo']; ?></h2></div>
            <div class="codeflightname"><div><img src="<?php echo $contentres['FlightSearchTerms'][0]['flightLogo']; ?>" alt="" style="width: 20px;"></div><div><?php echo $contentres['FlightSearchTerms'][0]['flightName']; ?> | <?php echo $contentres['FlightSearchTerms'][0]['flightCode']; ?>-<?php echo $contentres['FlightSearchTerms'][0]['flightNumber']; ?></div></div>

            <div class="flightsInfoDtl">
              <div><h5><?php echo $contentres['FlightSearchTerms'][0]['depTime']; ?></h5> <p><?php echo date('D, d M Y',strtotime($contentres['FlightSearchTerms'][0]['depDate'])); ?></p></div>
              <div class="hourcenter"><?php echo $contentres['FlightSearchTerms'][0]['duration']; ?><br> <img src="images/renge.png" alt=""></div>
              <div class="text-end"><h5><?php echo $contentres['FlightSearchTerms'][0]['arrTime']; ?></h5> <p><?php echo date('D, d M Y',strtotime($contentres['FlightSearchTerms'][0]['arrDate'])); ?></p></div>
            </div><!-- flightsInfoDtl  -->

            <div class="append_bottom3">
              <div>
                <h6><?php echo $contentres['FlightSearchTerms'][0]['orgName']; ?></h6>
                <p class="airportname"><?php echo $contentres['FlightSearchTerms'][0]['orgairport']; ?></p>
              </div>
              <div class="text-end">
                <h6><?php echo $contentres['FlightSearchTerms'][0]['desName']; ?></h6>
                <p class="airportname"><?php echo $contentres['FlightSearchTerms'][0]['destiairport']; ?></p>
              </div>
            </div>
 
       </div>

<?php $totalhotel=0; foreach($contentres['FlightList'] as $list) {  ?>
      <div class="card flightbookcard">
         <h5>Baggage Policy</h5>
         <table width="100%">
          <tr>
            <td width="1%"><i class="fa fa-suitcase" aria-hidden="true"></i>&nbsp; <span>Cabin Bag</span></td>
            <td width="60%" align="left"><?php echo $list['cabin']; ?></td>
            <td width="17%" align="right"><div class="faretypeflight" style=" background-color:<?php echo $list['fareTypeColor']; ?>;"><?php echo $list['fareType']; ?></div></td>
           </tr>
          <tr>
            <td width="1%"><div style="width:100px;"><i class="fa fa-briefcase" aria-hidden="true"></i>&nbsp; <span>Check-in bag</span></div></td>
            <td width="60%" align="left"><?php echo $list['checkin']; ?></td>
            <td align="right"  style="color:<?php  if($list['refund']=='Non Refundable'){?>#CC0000;<?php } else {  ?>#009900<?php } ?>"><?php echo $list['refund']; ?></td>
           </tr>
        </table>

         <ul class="bookpriced">
          <li><span>₹ <?php echo $list['displayFare']; ?></span></li>
          <li class="bookdetailbtn"><a onclick="openWindow('<?php echo $fullurl.'flightbox.php?id='.$list['flightId'].'&EndUserIp='.$_SESSION['EndUserIp'].'&tbotokenId='.$_SESSION['tbotokenId'].'&TraceId='.$_SESSION['TraceId'].''; ?>');" class="detailprbtn">Details</a> <a href="flight_booking_mobile.php?i=<?php echo encode($list['flightId']); ?>" class="bookbtnflight">Book</a></li>
         </ul>
      </div> 
<?php } ?>
       

      
    </div>
  </div><!-- mainallcontent  -->
  <?php
  include "footerinc.php";
  ?>

</body>

</html>