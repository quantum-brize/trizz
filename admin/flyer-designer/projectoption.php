<?php include "inc.php";
 

if($_REQUEST['secid']=='o1'){
?>
<div class="optionheader">
  <h1>Photo Library 
    <button type="button" id="OpenImgUpload" style="position: absolute; right: 54px; top: 16px;" class="btn btn-primary btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Add Assets</button></h1>  <i class="fa fa-times" aria-hidden="true" onclick="$('#projectoptionboxouter').hide('slide');"></i></div>

<form action="action.html" method="post" enctype="multipart/form-data" name="addeditfrm"  target="actoinfrm" id="addeditfrmuploadfile" style="display:none;"> 
<input type="file" id="imgupload" name="image" accept="image/x-png,image/gif,image/jpeg"  onChange="$('#addeditfrmuploadfile').submit();"/> 
<input name="action" type="hidden" value="uploadphoto" />
</form>


<script>
$('#OpenImgUpload').click(function(){ $('#imgupload').trigger('click'); });
</script>


<div class="imglistlibrary"> 
<?php
$c=GetPageRecord('count(id) as totalphotosnumber','flyerMediaLibrary','userId="'.$_SESSION['userid'].'"'); 
$totalphotos=mysqli_fetch_array($c);


if($_REQUEST['from']==''){
$limitfrom=0;
$limitto=14;
} else {

$limitfrom=$_REQUEST['from'];
$limitto=($_REQUEST['to']+14);

}

$n=1;
$b=GetPageRecord('*','flyerMediaLibrary','userId="'.$_SESSION['userid'].'" order by id desc limit '.$limitfrom.','.$limitto.' '); 
while($resultimg=mysqli_fetch_array($b)){  
?>
<div class="listing" onclick="addimagetoflyer('<?php echo $resultimg['name']; ?>');"><img src="flyer_library/<?php echo $resultimg['name']; ?>"></div>
<?php $n++; } ?>

<?php if($totalphotos['totalphotosnumber']>$n){ ?>
<div class="loadmorebtn" onclick="loadmorebtn('<?php echo $_REQUEST['secid']; ?>','<?php echo $limitfrom; ?>','<?php echo $limitto; ?>');">Load More</div>
<?php } ?>
</div> 
<?php } ?> 



<?php if($_REQUEST['secid']=='o2'){
?>
<div class="optionheader"><h1>Text</h1>  <i class="fa fa-times" aria-hidden="true" onclick="$('#projectoptionboxouter').hide('slide');"></i></div>
 

<div class="imglistlibrary"> 
 
<div class="listing" style=" font-size:20px;height: auto; text-align: center; font-family:Abril Fatface;" onclick="addfontetoflyer('Abril Fatface');">Welcome</div>   
<div class="listing" style=" font-size:20px;height: auto; text-align: center; font-family:Acme;" onclick="addfontetoflyer('Acme');">Welcome</div>   
<div class="listing" style=" font-size:20px;height: auto; text-align: center; font-family:Alfa Slab One;" onclick="addfontetoflyer('Alfa Slab One');">Welcome</div>   
<div class="listing" style=" font-size:20px;height: auto; text-align: center; font-family:Alice;" onclick="addfontetoflyer('Alice');">Welcome</div>   
<div class="listing" style=" font-size:20px;height: auto; text-align: center; font-family:Anton;" onclick="addfontetoflyer('Anton');">Welcome</div>   
<div class="listing" style=" font-size:20px;height: auto; text-align: center; font-family:Archivo Black;" onclick="addfontetoflyer('Archivo Black');">Welcome</div>   
<div class="listing" style=" font-size:20px;height: auto; text-align: center; font-family:Bangers;" onclick="addfontetoflyer('Bangers');">Welcome</div>   
<div class="listing" style=" font-size:20px;height: auto; text-align: center; font-family:Concert One;" onclick="addfontetoflyer('Concert One');">Welcome</div>   
<div class="listing" style=" font-size:20px;height: auto; text-align: center; font-family:Creepster;" onclick="addfontetoflyer('Creepster');">Welcome</div>   
<div class="listing" style=" font-size:20px;height: auto; text-align: center; font-family:Fredoka One;" onclick="addfontetoflyer('Fredoka One');">Welcome</div>   
<div class="listing" style=" font-size:20px;height: auto; text-align: center; font-family:Fugaz One;" onclick="addfontetoflyer('Fugaz One');">Welcome</div>   
<div class="listing" style=" font-size:20px;height: auto; text-align: center; font-family:Fuzzy Bubbles;" onclick="addfontetoflyer('Fuzzy Bubbles');">Welcome</div>   
<div class="listing" style=" font-size:20px;height: auto; text-align: center; font-family:Great Vibes;" onclick="addfontetoflyer('Great Vibes');">Welcome</div>   
<div class="listing" style=" font-size:20px;height: auto; text-align: center; font-family:Kalam;" onclick="addfontetoflyer('Kalam');">Welcome</div>   
<div class="listing" style=" font-size:20px;height: auto; text-align: center; font-family:Kanit;" onclick="addfontetoflyer('Kanit');">Welcome</div>   
<div class="listing" style=" font-size:20px;height: auto; text-align: center; font-family:Lobster;" onclick="addfontetoflyer('Lobster');">Welcome</div>   
<div class="listing" style=" font-size:20px;height: auto; text-align: center; font-family:Lobster Two;" onclick="addfontetoflyer('Lobster Two');">Welcome</div>   
<div class="listing" style=" font-size:20px;height: auto; text-align: center; font-family:Luckiest Guy;" onclick="addfontetoflyer('Luckiest Guy');">Welcome</div>   
<div class="listing" style=" font-size:20px;height: auto; text-align: center; font-family:Orbitron;" onclick="addfontetoflyer('Orbitron');">Welcome</div>   
<div class="listing" style=" font-size:20px;height: auto; text-align: center; font-family:Pacifico;" onclick="addfontetoflyer('Pacifico');">Welcome</div>   
<div class="listing" style=" font-size:20px;height: auto; text-align: center; font-family:Passion One;" onclick="addfontetoflyer('Passion One');">Welcome</div>   
<div class="listing" style=" font-size:20px;height: auto; text-align: center; font-family:Permanent Marker;" onclick="addfontetoflyer('Permanent Marker');">Welcome</div>   
<div class="listing" style=" font-size:20px;height: auto; text-align: center; font-family:Playball;" onclick="addfontetoflyer('Playball');">Welcome</div>   
<div class="listing" style=" font-size:20px;height: auto; text-align: center; font-family:Righteous;" onclick="addfontetoflyer('Righteous');">Welcome</div>   
<div class="listing" style=" font-size:20px;height: auto; text-align: center; font-family:Roboto;" onclick="addfontetoflyer('Roboto');">Welcome</div>   
<div class="listing" style=" font-size:20px;height: auto; text-align: center; font-family:Roboto Slab;" onclick="addfontetoflyer('Roboto Slab');">Welcome</div>   
<div class="listing" style=" font-size:20px;height: auto; text-align: center; font-family:Sacramento;" onclick="addfontetoflyer('Sacramento');">Welcome</div>   
<div class="listing" style=" font-size:20px;height: auto; text-align: center; font-family:Satisfy;" onclick="addfontetoflyer('Satisfy');">Welcome</div>   
<div class="listing" style=" font-size:20px;height: auto; text-align: center; font-family:Space Mono;" onclick="addfontetoflyer('Space Mono');">Welcome</div>   
<div class="listing" style=" font-size:20px;height: auto; text-align: center; font-family:Special Elite;" onclick="addfontetoflyer('Special Elite');">Welcome</div>   
<div class="listing" style=" font-size:20px;height: auto; text-align: center; font-family:Staatliches;" onclick="addfontetoflyer('Staatliches');">Welcome</div>   
<div class="listing" style=" font-size:20px;height: auto; text-align: center; font-family:Teko;" onclick="addfontetoflyer('Teko');">Welcome</div>   
<div class="listing" style=" font-size:20px;height: auto; text-align: center; font-family:Titan One;" onclick="addfontetoflyer('Titan One');">Welcome</div>   
<div class="listing" style=" font-size:20px;height: auto; text-align: center; font-family:Berkshire Swash;" onclick="addfontetoflyer('Berkshire Swash');">Welcome</div>   
</div> 
 
 <?php } ?>
 
 


<?php if($_REQUEST['secid']=='o3'){
?>
<div class="optionheader">
  <h1>Background 
     </h1>  <i class="fa fa-times" aria-hidden="true" onclick="$('#projectoptionboxouter').hide('slide');"></i></div>

 


<div class="imglistlibrary"> 
<?php
$c=GetPageRecord('count(id) as totalphotosnumber','backgroundLibrary','imageType="background"'); 
$totalphotos=mysqli_fetch_array($c);


if($_REQUEST['from']==''){
$limitfrom=0;
$limitto=14;
} else {

$limitfrom=$_REQUEST['from'];
$limitto=($_REQUEST['to']+14);

}

$n=1;
$b=GetPageRecord('*','backgroundLibrary','imageType="background" order by id desc limit '.$limitfrom.','.$limitto.' '); 
while($resultimg=mysqli_fetch_array($b)){  
?>
<div class="listing" onclick="addbackgroundtoflyer('<?php echo $resultimg['image']; ?>');"><img src="background/<?php echo $resultimg['image']; ?>"></div>
<?php $n++; } ?>

<?php if($totalphotos['totalphotosnumber']>$n){ ?>
<div class="loadmorebtn" onclick="loadmorebtn('<?php echo $_REQUEST['secid']; ?>','<?php echo $limitfrom; ?>','<?php echo $limitto; ?>');">Load More</div>
<?php } ?>
</div> 
<?php } ?> 






<?php if($_REQUEST['secid']=='o4'){
?>
<div class="optionheader">
  <h1>Shape 
     </h1>  <i class="fa fa-times" aria-hidden="true" onclick="$('#projectoptionboxouter').hide('slide');"></i></div>

 


<div class="imglistlibrary"> 
 
<div class="listing" style="border:2px solid #000;" onclick="addshapetoflyer('rec');"></div> 
<div class="listing" style="border:2px solid #000;border-radius: 10px;" onclick="addshapetoflyer('recr');"></div>  
</div> 
<?php } ?> 






<?php if($_REQUEST['secid']=='o5'){
?>
<div class="optionheader"><h1>Icons</h1>  <i class="fa fa-times" aria-hidden="true" onclick="$('#projectoptionboxouter').hide('slide');"></i></div>
 

<div class="iconlibraryouter"> 
 <div class="iconlibrary" onclick="addicontoflyer(this);" ><i class="fa fa-star" aria-hidden="true"></i></div>
  <div class="iconlibrary" onclick="addicontoflyer(this);" ><i class="fa fa-star-half-o" aria-hidden="true"></i></div>
  <div class="iconlibrary" onclick="addicontoflyer(this);" ><i class="fa fa-star-o" aria-hidden="true"></i></div>
 <div class="iconlibrary" onclick="addicontoflyer(this);" ><i class="fa fa-play" aria-hidden="true"></i></div>
 <div class="iconlibrary" onclick="addicontoflyer(this);" ><i class="fa fa-certificate" aria-hidden="true"></i></div>
 <div class="iconlibrary" onclick="addicontoflyer(this);" ><i class="fa fa-share-square" aria-hidden="true"></i></div>
 
 <div class="iconlibrary" onclick="addicontoflyer(this);" ><i class="fa fa-search" aria-hidden="true"></i></div>
 <div class="iconlibrary" onclick="addicontoflyer(this);" ><i class="fa fa-street-view" aria-hidden="true"></i></div>
 <div class="iconlibrary" onclick="addicontoflyer(this);" ><i class="fa fa-share-alt-square" aria-hidden="true"></i></div>
 <div class="iconlibrary" onclick="addicontoflyer(this);" ><i class="fa fa-share" aria-hidden="true"></i></div>
 <div class="iconlibrary" onclick="addicontoflyer(this);" ><i class="fa fa-hourglass-start" aria-hidden="true"></i></div>
 
 <div class="iconlibrary" onclick="addicontoflyer(this);" ><i class="fa fa-tree" aria-hidden="true"></i></div>
 <div class="iconlibrary" onclick="addicontoflyer(this);" ><i class="fa fa-pagelines" aria-hidden="true"></i></div>
 <div class="iconlibrary" onclick="addicontoflyer(this);" ><i class="fa fa-thermometer-three-quarters" aria-hidden="true"></i></div>
 <div class="iconlibrary" onclick="addicontoflyer(this);" ><i class="fa fa-free-code-camp" aria-hidden="true"></i></div>
 <div class="iconlibrary" onclick="addicontoflyer(this);" ><i class="fa fa-twitter-square" aria-hidden="true"></i></div>
 <div class="iconlibrary" onclick="addicontoflyer(this);" ><i class="fa fa-facebook-square" aria-hidden="true"></i></div>
 <div class="iconlibrary" onclick="addicontoflyer(this);" ><i class="fa fa-linkedin-square" aria-hidden="true"></i></div>
 <div class="iconlibrary" onclick="addicontoflyer(this);" ><i class="fa fa-instagram" aria-hidden="true"></i></div>
 
 
 <div class="iconlibrary" onclick="addicontoflyer(this);" ><i class="fa fa-university" aria-hidden="true"></i></div>
 <div class="iconlibrary" onclick="addicontoflyer(this);" ><i class="fa fa-bug" aria-hidden="true"></i></div>
 <div class="iconlibrary" onclick="addicontoflyer(this);" ><i class="fa fa-lightbulb-o" aria-hidden="true"></i></div>
 <div class="iconlibrary" onclick="addicontoflyer(this);" ><i class="fa fa-car" aria-hidden="true"></i></div>
 <div class="iconlibrary" onclick="addicontoflyer(this);" ><i class="fa fa-cart-plus" aria-hidden="true"></i></div>
 <div class="iconlibrary" onclick="addicontoflyer(this);" ><i class="fa fa-id-card" aria-hidden="true"></i></div>
 <div class="iconlibrary" onclick="addicontoflyer(this);" ><i class="fa fa-plane" aria-hidden="true"></i></div>
 <div class="iconlibrary" onclick="addicontoflyer(this);" ><i class="fa fa-cubes" aria-hidden="true"></i></div>
 
 
 <div class="iconlibrary" onclick="addicontoflyer(this);" ><i class="fa fa-envelope-square" aria-hidden="true"></i></div>
 <div class="iconlibrary" onclick="addicontoflyer(this);" ><i class="fa fa-envelope" aria-hidden="true"></i></div>
 <div class="iconlibrary" onclick="addicontoflyer(this);" ><i class="fa fa-flag" aria-hidden="true"></i></div>
 <div class="iconlibrary" onclick="addicontoflyer(this);" ><i class="fa fa-life-ring" aria-hidden="true"></i></div>
 <div class="iconlibrary" onclick="addicontoflyer(this);" ><i class="fa fa-wifi" aria-hidden="true"></i></div>
 <div class="iconlibrary" onclick="addicontoflyer(this);" ><i class="fa fa-tachometer" aria-hidden="true"></i></div>
 <div class="iconlibrary" onclick="addicontoflyer(this);" ><i class="fa fa-shopping-basket" aria-hidden="true"></i></div>
 <div class="iconlibrary" onclick="addicontoflyer(this);" ><i class="fa fa-sign-language" aria-hidden="true"></i></div>
 
 <div class="iconlibrary" onclick="addicontoflyer(this);" ><i class="fa fa-motorcycle" aria-hidden="true"></i></div>
 <div class="iconlibrary" onclick="addicontoflyer(this);" ><i class="fa fa-reply-all" aria-hidden="true"></i></div>
 <div class="iconlibrary" onclick="addicontoflyer(this);" ><i class="fa fa-gavel" aria-hidden="true"></i></div>
 <div class="iconlibrary" onclick="addicontoflyer(this);" ><i class="fa fa-cutlery" aria-hidden="true"></i></div>
 <div class="iconlibrary" onclick="addicontoflyer(this);" ><i class="fa fa-comment-o" aria-hidden="true"></i></div>
 <div class="iconlibrary" onclick="addicontoflyer(this);" ><i class="fa fa-circle" aria-hidden="true"></i></div>
 <div class="iconlibrary" onclick="addicontoflyer(this);" ><i class="fa fa-camera" aria-hidden="true"></i></div>
 <div class="iconlibrary" onclick="addicontoflyer(this);" ><i class="fa fa-heart" aria-hidden="true"></i></div>
 
 <div class="iconlibrary" onclick="addicontoflyer(this);" ><i class="fa fa-bullseye" aria-hidden="true"></i></div>
 <div class="iconlibrary" onclick="addicontoflyer(this);" ><i class="fa fa-bullhorn" aria-hidden="true"></i></div>
 <div class="iconlibrary" onclick="addicontoflyer(this);" ><i class="fa fa-birthday-cake" aria-hidden="true"></i></div>
 <div class="iconlibrary" onclick="addicontoflyer(this);" ><i class="fa fa-check-circle" aria-hidden="true"></i></div>
 <div class="iconlibrary" onclick="addicontoflyer(this);" ><i class="fa fa-comments-o" aria-hidden="true"></i></div>
 <div class="iconlibrary" onclick="addicontoflyer(this);" ><i class="fa fa-handshake-o" aria-hidden="true"></i></div>
 
 <div class="iconlibrary" onclick="addicontoflyer(this);" ><i class="fa fa-bus" aria-hidden="true"></i></div>
 <div class="iconlibrary" onclick="addicontoflyer(this);" ><i class="fa fa-anchor" aria-hidden="true"></i></div>
 <div class="iconlibrary" onclick="addicontoflyer(this);" ><i class="fa fa-arrows-h" aria-hidden="true"></i></div>
 <div class="iconlibrary" onclick="addicontoflyer(this);" ><i class="fa fa-user-circle" aria-hidden="true"></i></div>
 <div class="iconlibrary" onclick="addicontoflyer(this);" ><i class="fa fa-window-minimize" aria-hidden="true"></i></div>
 <div class="iconlibrary" onclick="addicontoflyer(this);" ><i class="fa fa-coffee" aria-hidden="true"></i></div>
 <div class="iconlibrary" onclick="addicontoflyer(this);" ><i class="fa fa-flag-checkered" aria-hidden="true"></i></div>
 <div class="iconlibrary" onclick="addicontoflyer(this);" ><i class="fa fa-heart-o" aria-hidden="true"></i></div>
 
 </div>
 
 <?php } ?>