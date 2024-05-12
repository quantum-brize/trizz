<?php  
include "inc.php";  

?>

<!DOCTYPE html>

<html lang="en">



<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">



<title>Blog - <?php echo $websitesetting['metaTitle']; ?></title>

<?php include "headerinc.php"; ?>


 <style>
.card { margin-top: 20px; border: 0px; box-shadow: 2px 2px 15px #00000029; }
</style>


</head>



<body class="greybluebg">



<?php include "header.php"; ?>





<section class="holidaybanner" style="background-image: url(dist/packagebannerpage.png);">

    <div class="container holidabancontainer" style="padding:0px 20px;">

        <div class="row">

            <div class="col-lg-12">

                <div class="holidaysearch" style="text-align:center;">

                    <h1 style="color: #fff; background-color: #000000ba; padding: 20px; display: inline-block; font-size: 30px; border-radius: 10px; ">
					 
					Blog</h1>

                     

            </div>

            </div>

        </div>

    </div>

</section>







<section class="holidaydestination"> 

	<div class="container" style="margin-top:30px;">

        <div class="row offerboxes"> 
<?php
$a=GetPageRecord('*','websiteBlog',' status=1 order by id desc');
while($spdeals=mysqli_fetch_array($a)){  
?>
					<div class="col-lg-4" style="cursor:pointer; margin-bottom:10px;" >
					<a href="<?php echo $fullurl; ?>post-view?id=<?php echo encode($spdeals['id']); ?>&t=<?php echo seo_friendly_url(stripslashes($spdeals['name'])); ?>">
<div class="card" style="overflow:hidden; margin-top:0px;"><div class="offerphotobox">
<img src="<?php echo $blogphoto; ?><?php echo $spdeals['photo']; ?>" style=" height:100%; min-width:100%;">
</div><div class="card-body" style="font-weight:700; font-size:14px; color:#333333; text-align:center;">
<?php echo substr(stripslashes($spdeals['name']),0,50); ?>...</div>
 



</div>
</a>
</div> 
 
					<?php } ?>

</div>

    </div> 

	

	</section>
 



<?php include "footer.php"; ?>

 
 
 <?php include "footerinc.php"; ?>
</body>

</html>

