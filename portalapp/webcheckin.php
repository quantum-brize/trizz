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



$url = $basesiteurl . "packagedestinationpage_mobile.php";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);

$data = array(
  'MemberId' => $_SESSION['userId']
);

curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
$contents = curl_exec($ch);
$contentres = json_decode($contents, true);
curl_close($ch);

$url = $basesiteurl . "marqueepage_mobile.php";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);

$data = array(
  'MemberId' => $_SESSION['userId']
);

curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
$contents = curl_exec($ch);
$contentresmark = json_decode($contents, true);
curl_close($ch);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
  <title>Holidays</title>
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
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
</head>

<body style="background-color:#f0f7fe;">

  <div class="innerpageaccountheader" style="width:100% !important;"><i class="fa fa-arrow-left" aria-hidden="true" onclick="closeWindow();"></i>Web Check-in </div>
  <div class="mainallcontent">

    <div style="margin-top: 55px; padding:5px;">
       <table class="webchecktable">
        <tr>
          <td><div class="flexboxlines"><div class="webair2"><img src="images/airasia2.png" alt=""></div><div>Air Asia ( I5 )</div></div></td>
          <td><div class="flexboxlines"><div class="webair2"><img src="images/airline.png" alt=""></div><div>Air India ( AI )</div></div></td>
        </tr>
        <tr>
          <td><div class="flexboxlines"><div class="webair2"><img src="images/vistara.jpeg" alt=""></div><div>Air Vistara ( UK )</div></div></td>
          <td><div class="flexboxlines"><div class="webair2"><img src="images/indigo.png" alt=""></div><div>Indigo ( 6E )</div></div></td>
        </tr>
        <tr>
          <td><div class="flexboxlines"><div class="webair2"><img src="images/spicejet.png" alt=""></div><div>SpiceJet ( SG )</div></div></td>
          <td><div class="flexboxlines"><div class="webair2"><img src="images/goair.png" alt=""></div><div>GoAir ( G8 )</div></div></td>
        </tr>
        <tr>
          <td><div class="flexboxlines"><div class="webair2"><img src="images/emirates.JPG" alt=""></div><div>Emirates Airlines ( EK )</div></div></td>
          <td><div class="flexboxlines"><div class="webair2"><img src="images/flybig.png" alt=""></div><div>FlyBig ( S9 )</div></div></td>
        </tr>
        <tr>
          <td><div class="flexboxlines"><div class="webair2"><img src="images/trujet.png" alt=""></div><div>Trujet ( 2T )</div></div></td>
        </tr>
       </table>
    </div>

  </div><!-- mainallcontent  -->
  <?php
  include "footerinc.php";
  ?>

</body>

</html>