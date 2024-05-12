<?php include "inc.php"; ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $systemname; ?></title>

<?php include "headerinc.php"; ?>
</head>

<body style="background-color:#FFFFFF;">
<?php include "header.php"; ?>

<div class="left">
<a href="#"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: #1473e6; color: #fff; border-radius: 32px; width: 49px; height: 49px; margin: auto; margin-bottom: 10px;"><i class="fa fa-plus" aria-hidden="true"></i></a>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="top: 113px; left: 4px;">
    <a class="dropdown-item" href="#" onclick="createflyer('Instagram Story');"><i class="fa fa-instagram" aria-hidden="true"></i> &nbsp;Instagram Story</a>
    <a class="dropdown-item" href="#" onclick="createflyer('Instagram Post');"><i class="fa fa-instagram" aria-hidden="true"></i> &nbsp;Instagram Post</a>
    <a class="dropdown-item" href="#" onclick="createflyer('Facebook Post');"><i class="fa fa-facebook-official" aria-hidden="true"></i> &nbsp;Facebook Post</a> 
    <a class="dropdown-item" href="#" onclick="createflyer('Emailer');"><i class="fa fa-file-image-o" aria-hidden="true"></i> &nbsp;Emailer</a>
    <a class="dropdown-item" href="#" onclick="createflyer('Custom Size');"><i class="fa fa-window-maximize" aria-hidden="true"></i> &nbsp;Custom Size</a>
  </div>


<a href="<?php echo $fullurl; ?>" class="active"><i class="fa fa-home" aria-hidden="true"></i><div>Home</div></a>
<a href="<?php echo $fullurl; ?>projects"><i class="fa fa-sticky-note-o" aria-hidden="true"></i><div>Projects</div></a> 

</div>

<div class="bodyareahome">
<div class="bodysections">
<div class="lighttext">Here's a few things you can create</div>
<h1>Tell your story with easy way!</h1>

<div class="listtypehome">
<a href="#"><img src="images/instagramstory.PNG" /><div>Instagram Story</div></a>
<a href="#"><img src="images/instagrampost.PNG" /><div>Instagram Post</div></a>
<a href="#"><img src="images/facebookpost.PNG" /><div>Facebook Post</div></a>
<a href="#"><img src="images/emailer.PNG" /><div>Emailer</div></a>
<a href="#"><img src="images/customsize.PNG" /><div>Custom Size</div></a>
</div>



</div>

<div class="bodysections">
<div class="lighttext">Take your designs to the next level</div>
<h1>Start from a beautiful template</h1>
<div class="hometemplatelist">
<a href="#"><img src="images/400.png" /></a>
<a href="#"><img src="images/400.png" /></a>
<a href="#"><img src="images/400.png" /></a>
<a href="#"><img src="images/400.png" /></a>
<a href="#"><img src="images/400.png" /></a>
</div>

</div>

</div>
 

 




 


 
</body>
</html>
