<?php include "clientinc.php"; 
$result =mysqli_query (db(),"select * from userMaster where id='".$_SESSION['clientId']."' ")  or die(mysqli_error());   
$userinfo=mysqli_fetch_array($result);

$pageno=3;
 ?>

<!DOCTYPE html>
<html lang="en">
 
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>My Trips - <?php echo $clientnameglobal; ?></title>

<?php include "clientheaderinc.php";  ?>

</head>
<body>
<div class="bodyboxbg"></div>
<div class="careerfy-wrapper">

<?php include "clientheader.php";  ?>


 


<div class="careerfy-main-content">

<div class="careerfy-main-section careerfy-dashboard-fulltwo">
<div class="container">
<div class="row">

<?php include "clientleft.php";  ?>



<div class="careerfy-column-9">
<div class="careerfy-typo-wrap"> 
<div class="careerfy-employer-box-section" style="min-height: 486px;">
<div class="careerfy-profile-title"><h2>MY PROFILE</h2><a href="editprofile.html" class=" bluebutton" style="float: right; padding: 5px;"><i class="fa fa-pencil" aria-hidden="true"></i>
 Edit</a></div>
<ul class="careerfy-row careerfy-employer-profile-form">
<?php if($_GET['c']=='1'){ ?>
<div class="alert alert-success" role="alert">
  <i class="fa fa-check" aria-hidden="true"></i> Changes have been successfully saved
</div>
<?php } ?>
<?php if($_GET['p']=='1'){ ?>
<div class="alert alert-success" role="alert">
 <i class="fa fa-check" aria-hidden="true"></i>  Password have been successfully updated
</div>
<?php } ?>

<li class="careerfy-column-4">
<label>Salutations</label>
<?php echo $userinfo['submitName']; ?>
</li>

<li class="careerfy-column-4">
<label>First Name</label>
<?php echo $userinfo['firstName']; ?>
</li>

<li class="careerfy-column-4">
<label>Last Name</label>
<?php echo $userinfo['lastName']; ?>
</li>
<li class="careerfy-column-4">
<label>Email</label>
<?php echo $userinfo['email']; ?>
</li>
<li class="careerfy-column-4">
<label>Code</label>
<?php echo $userinfo['mobileCode']; ?>
</li>  

<li class="careerfy-column-4">
<label>Phone</label>
<?php echo $userinfo['mobile']; ?>
</li>

<li class="careerfy-column-4">
<label>City</label>
<?php echo getCityName($userinfo['city']); ?>
</li>

<li class="careerfy-column-4">
<label>Address</label>
<?php echo $userinfo['address']; ?>
</li>
 
 
</ul>
</div>
 
  
</div>
</div>
</div>
</div>
</div>

</div>


 

</div>
 
<?php include "clientfooterinc.php";  ?>

</body>
 
</html>
