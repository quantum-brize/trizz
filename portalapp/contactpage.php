<?php
include "inc.php"; 
$cookie_name = "user";
if(!isset($_COOKIE[$cookie_name])) {
     
} else {
    $cookieuserid=$_COOKIE[$cookie_name];
}
 if($cookieuserid>0){
$_SESSION['userId']=$cookieuserid; 
}
 

$url = $basesiteurl."contactpage_mobile.php";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);

		$data = array(
		'PageId' => 1
); 

curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
$contents = curl_exec($ch);
$contentdata=json_decode($contents,true); 
curl_close($ch);
 
  

 
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
<title>Contact</title>
<?php
include "headerinc.php";
?> 
</head>
<body>

<div class="innerpageaccountheader"><i class="fa fa-arrow-left" aria-hidden="true" onclick="closeWindow();"></i>Contact Us</div>
 
 

<div class="fullwhitesection" style="  font-size:15px; line-height:20px; padding-top:70px; ">
 <div class="boxcontact">
 <div class="sec">
 <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="center" style="padding-right:20px;"><i class="fa fa-map-marker" aria-hidden="true" style="font-size:30px;"></i></td>
    <td width="85%"><div style="font-size:12px;">Address</div>
      <?php echo stripslashes($contentdata['Page']['address']); ?> </td>
  </tr>
</table>

 </div>
 
 <div class="sec">
 <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="center" style="padding-right:20px;"><i class="fa fa-phone" aria-hidden="true" style="font-size:30px;"></i></td>
    <td width="85%"><div style="font-size:12px;">Phone</div>
      <?php echo stripslashes($contentdata['Page']['phone']); ?></td>
  </tr>
</table>

 </div>
 
 <div class="sec">
 <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="center" style="padding-right:20px;"><i class="fa fa fa-envelope" aria-hidden="true" style="font-size:30px;"></i></td>
    <td width="85%"><div style="font-size:12px;">Email</div>
      <?php echo stripslashes($contentdata['Page']['email']); ?></td>
  </tr>
</table>

 </div>
 
 <div class="sec" style="border-bottom:0px; margin-bottom:0px; padding-bottom:0px;">
 <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="center" style="padding-right:20px;"><i class="fa fa-clock-o" aria-hidden="true" style="font-size:30px;"></i></td>
    <td width="85%"><div style="font-size:12px;">Working Hours</div>Mon – Sun 10:00 am – 7:00 pm We are open 24*7 of every month, including Sundays & public holidays</td>
  </tr>
</table>

 </div>
 
 </div>
</div>

<div style="padding:20px; width:100%; box-sizing:border-box; ">

<div class="sectionheading" style="margin-top:-20px; margin-left:0px; padding-left:0px;">Get In Touch With Us</div>
<div class="" style="margin-bottom:0px; padding-bottom:0px; padding:20px; border:1px solid #ddd;border-radius: 10px;">




<div class="fullwhitesection" style="  font-size:15px; line-height:20px; padding-top:5px; margin-bottom:0px; padding:0px; ">
 <?php if($_REQUEST['i']==1){ ?>
				 
				<div style="text-align:center; padding-top:100px;">
				
				<h2>Thank You!</h2>
				<div style="text-align:center; font-size:14px;">Your query has been submitted successfully. <br>
We will contact you shortly.</div>
				</div> 
				 
				 
				 <?php } else { ?>

                                                        
                                                            <form action="conactaction.php" method="post"> 
                                       
                                                               <div class="form-group"> <input type="text" class="form-control" name="firstName" placeholder="First Name" required=""> </div>
                                       
                                                               <div class="form-group"> <input type="text" class="form-control" name="lastName" placeholder="Last Name" required=""> </div>
                                                               
                                                               <div class="form-group"> <input type="number" class="form-control" name="phone" placeholder="Phone Number" required=""> </div>
                                       
                                                               <div class="form-group"> <input type="email" class="form-control" name="email" placeholder="Email Address" required=""> </div>
                                       
                                                               
                                       
                                                               <div class="form-group"> <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea> </div>
                                       
                                                               <input type="hidden" name="action" value="sendcontactform">
                                                               <input type="hidden" name="tomail" value="<?php echo stripslashes($contentdata['Page']['email']); ?>">
                                       
                                                               <button type="submit" class="btnred">Send Message</button> 
                                       
                                                            </form>
                                                            <?php } ?>
</div>

</div>
</div>
<?php
include "footerinc.php";
?>

</body>
</html>
