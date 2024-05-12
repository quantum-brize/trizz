<?php 
require_once('PHPMailer/class.phpmailer.php'); 
include("PHPMailer/class.smtp.php");
  
 function send_attachment_mail($fromemail,$to,$subject,$description,$ccmail,$attfilename) 
{ 
 
$select='*'; 
$where='id="'.$_SESSION['agentUserid'].'"'; 
$rs=GetPageRecord($select,'sys_userMaster',$where); 
$LoginUserDetails=mysqli_fetch_array($rs); 

 


	$mail = new PHPMailer();

	$mail->IsMail();

	$mail->SMTPAuth = $LoginUserDetails['securityType'];

	$mail->SMTPSecure = $LoginUserDetails['smtpServer'];

	$mail->Host = $LoginUserDetails['smtpServer'];

	$mail->Port = $LoginUserDetails['emailPort'];  

	$mail->Username = $LoginUserDetails['emailAccount'];

	$mail->Password = $LoginUserDetails['emailPassword']; 

	$mail->From = $LoginUserDetails['emailAccount'];

	$mail->FromName = $LoginUserDetails['fromName'];

	$mail->Subject = $subject;

	$mail->AltBody = "";
	
	$mail->CharSet = 'UTF-8';
	
    $mail->ContentType = 'text/html';

	$mail->MsgHTML('<body>'.$description.'</body>'); 

	 $mail->AddAddress(trim($to), ""); 
	   
	 
	 $allFiles = explode(',', $attfilename);
	foreach ($allFiles as $file) {
	$mail->AddAttachment('upload/'.$file);
	} 
	 
	$ccmail = explode(',', $ccmail);
	foreach ($ccmail as $ccaddress) {
	$mail->AddCC(trim($ccaddress));
	} 

	$mail->IsHTML(true);

	$mail->SMTPOptions = array(
	'ssl' => array(
	'verify_peer' => false,
	'verify_peer_name' => false,
	'allow_self_signed' => true
	)
	);
	$mail->Send();



}

  
 function send_attachment_mail_admin($fromemail,$to,$subject,$description,$ccmail,$attfilename) 
{ 
 
$select='*'; 
$where='id=1'; 
$rs=GetPageRecord($select,'sys_userMaster',$where); 
$LoginUserDetails=mysqli_fetch_array($rs); 

 


	$mail = new PHPMailer();

	$mail->IsMail();

	$mail->SMTPAuth = $LoginUserDetails['securityType'];

	$mail->SMTPSecure = $LoginUserDetails['smtpServer'];

	$mail->Host = $LoginUserDetails['smtpServer'];

	$mail->Port = $LoginUserDetails['emailPort'];  

	$mail->Username = $LoginUserDetails['emailAccount'];

	$mail->Password = $LoginUserDetails['emailPassword']; 

	$mail->From = $LoginUserDetails['emailAccount'];

	$mail->FromName = $LoginUserDetails['fromName'];

	$mail->Subject = $subject;

	$mail->AltBody = "";
	
	$mail->CharSet = 'UTF-8';
	
    $mail->ContentType = 'text/html';

	$mail->MsgHTML('<body>'.$description.'</body>'); 

	 $mail->AddAddress(trim($to), ""); 
	   
	 
	 $allFiles = explode(',', $attfilename);
	foreach ($allFiles as $file) {
	$mail->AddAttachment('upload/'.$file);
	} 
	 
	$ccmail = explode(',', $ccmail);
	foreach ($ccmail as $ccaddress) {
	$mail->AddCC(trim($ccaddress));
	} 

	$mail->IsHTML(true);

	$mail->SMTPOptions = array(
	'ssl' => array(
	'verify_peer' => false,
	'verify_peer_name' => false,
	'allow_self_signed' => true
	)
	);
	$mail->Send();



}
 
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
?>