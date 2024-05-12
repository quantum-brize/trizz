<?php
require_once('PHPMailer/class.phpmailer.php'); 
include("PHPMailer/class.smtp.php");

function send_attachment_mail_new($to,$subject,$description,$ccmail) 
{ 


$rs=GetPageRecord('*','sys_userMaster','id=1');  
$maildata=mysqli_fetch_array($rs); 


$mail = new PHPMailer();

$mail->IsSMTP();
$mail->Host = $maildata['smtpServer'];

$mail->SMTPAuth = true;
//$mail->SMTPSecure = "ssl";
$mail->Port = 587;
$mail->Username = $maildata['emailAccount'];
$mail->Password = $maildata['emailPassword'];

$mail->From = $maildata['emailAccount'];
$mail->FromName = $maildata['fromName'];
$mail->AddAddress($to);
//$mail->AddReplyTo("mail@mail.com");

$mail->IsHTML(true);

$mail->Subject = $subject;
$mail->Body = $description;
//$mail->AltBody = "This is the body in plain text for non-HTML mail clients";

if(!$mail->Send())
{
//echo "Message could not be sent. <p>";
//echo "Mailer Error: " . $mail->ErrorInfo;
exit;
}

//echo "Message has been sent";

}

$obj = json_decode(json_encode($_POST));  
$to=$obj->to;
$Subject=$obj->Subject;
$Detail=$obj->Detail;

send_attachment_mail_new($to,$Subject,$Detail,'');
?>