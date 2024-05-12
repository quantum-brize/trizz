<?php
include "inc.php"; 
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
 

  <style>
    body {
      background-color: #f0f7fe;
    }
	html{width:100%; height:100%;

    .packagebox .name {
      white-space: inherit !important;
      font-weight: 500 !important;
    }
  </style> 
</head>

<body style="background-color: var(--base-color) !important;">

  <div class="innerpageaccountheader" style="width:100% !important;"><i class="fa fa-arrow-left" aria-hidden="true" onclick="closeWindow();"></i>Flight Booking</div>
  <iframe src="../flight_review_book_mobile.php?i=<?php echo $_REQUEST['i']; ?>&r=<?php echo $_REQUEST['r']; ?>" style=" width:100%; height:100%;" frameborder="0"></iframe>
 
  <?php
  include "footerinc.php";
  ?>

</body>

</html>