<?php
include "inc.php"; 
?>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>

<?php 
 
 
if($_REQUEST['action']=='sendcontactform' && $_REQUEST['firstName']!='' && $_REQUEST['email']!='' && $_REQUEST['phone']!='' && $_SESSION['contactpage']!=0){ 
 
$firstName=trim($_REQUEST['firstName']);
$lastName=trim($_REQUEST['lastName']);
$email=trim($_REQUEST['email']);
$phone=trim($_REQUEST['phone']); 
$message=trim($_REQUEST['message']); 

 $_SESSION['contactpage']=0;

 

// subject
$subject = 'New Query From Website '.$fullurl;

// message
$message = '
<html>
<head>
  <title>New Query From Website</title>
</head>
<body>
   <table width="100%" border="0" cellpadding="5">
  <tr>
    <td width="10%"><strong>Name:</strong></td>
    <td width="90%">'.$firstName.'&nbsp;'.$lastName.'</td>
  </tr>
  <tr>
    <td><strong>Email:</strong></td>
    <td>'.$email.'</td>
  </tr>
  <tr>
    <td><strong>Phone:</strong></td>
    <td>'.$phone.'</td>
  </tr>
  <tr>
    <td><strong>Message:</strong></td>
    <td>'.$message.'</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
';
 
include "config/mail.php"; 
 
send_attachment_mail_new('mohd.m.imran@gmail.com',$subject,$message,$cc);

 

exit();

} 



if($_REQUEST['action']=='sendcontactformquery' && $_REQUEST['firstName']!=''  && $_REQUEST['bookingref']!=''   && $_REQUEST['pnr']!='' && $_REQUEST['email']!='' && $_REQUEST['phone']!=''  ){ 
 
$firstName=trim($_REQUEST['firstName']);
$bookingref=trim($_REQUEST['bookingref']);
$pnr=trim($_REQUEST['pnr']);
$lastName=trim($_REQUEST['lastName']);
$email=trim($_REQUEST['email']);
$phone=trim($_REQUEST['phone']); 
$message=trim($_REQUEST['message']); 
$msgtype=trim($_REQUEST['msgtype']); 

 $_SESSION['contactpage']=0;

 

// subject
$subject = 'New Query From Website '.$fullurl;

// message
$message = '
<html>
<head>
  <title>New Query From Website</title>
</head>
<body>
   <table width="100%" border="0" cellpadding="5">
   <tr>
    <td width="10%"><strong>Type:</strong></td>
    <td width="90%">'.$msgtype.'</td>
  </tr>
   <tr>
    <td width="10%"><strong>Booking Ref:</strong></td>
    <td width="90%">'.$bookingref.'</td>
  </tr>
   <tr>
    <td width="10%"><strong>PNR No:</strong></td>
    <td width="90%">'.$pnr.'</td>
  </tr>
   
  <tr>
    <td width="10%"><strong>Name:</strong></td>
    <td width="90%">'.$firstName.'&nbsp;'.$lastName.'</td>
  </tr>
  <tr>
    <td><strong>Email:</strong></td>
    <td>'.$email.'</td>
  </tr>
  <tr>
    <td><strong>Phone:</strong></td>
    <td>'.$phone.'</td>
  </tr>
  <tr>
    <td><strong>Message:</strong></td>
    <td>'.$message.'</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
';
 ?>
 <script>
 alert('Your request has been submitted successfully!');
 </script>
 <?php
include "config/mail.php"; 
 
send_attachment_mail_new('mohd.m.imran@gmail.com',$subject,$message,$cc);

 

exit();

} 


?>
<script> 
parent.window.location.href='<?php echo $fullurl; ?>contact-us?i=1';
</script>
<?php


?>