<?php
include "inc.php";   
  
  

  ?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
<title>Login</title>
<?php
include "headerinc.php";
?>
 
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script src="https://code.jquery.com/jquery-3.6.0.js"></script> 

<style>
body{font-size: 12px;}
.detailsboxtabs { width: 100%; border-bottom: 1px solid #ddd; overflow: hidden; padding-left: 0px; margin-top:10px;}
.detailsboxtabs a { padding: 5px 10px; margin-right: 5px; float: left; color: #000; padding: 10px 10px; border-radius:5px !important; border-bottom-left-radius: 0px !important; border-bottom-right-radius: 0px !important; font-weight: 600; font-size: 12px; text-decoration: none; }
.detailsboxtabs .active { background-color:var(--base-color); color: #fff !important; }
.flightname{margin-bottom:0px;}
table tr td{padding:5px!important; }
</style>
</head>

<body>  
  
  <div class="innerpageaccountheader" style="width:100% !important;"><i class="fa fa-arrow-left" aria-hidden="true" onclick="closeWindow();"></i>Flight Detail</div>
  
 
  
 
  <?php echo $fileContent = file_get_contents($basesiteurl.'flightdetailsbox.php?id='.$_REQUEST['id'].'&tabid=1&EndUserIp='.$_SESSION['EndUserIp'].'&tbotokenId='.$_SESSION['tbotokenId'].'&TraceId='.$_SESSION['TraceId'].''); ?>
 
  </body>
  </html>