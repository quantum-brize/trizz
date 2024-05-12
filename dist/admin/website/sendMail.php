<?php
require_once("websiteinc.php");
if(isset($_POST["send"])){
$user_ip=$_SERVER['REMOTE_ADDR'];
$name=addslashes($_POST["name"]);
$email=addslashes($_POST["email"]);
$number=addslashes($_POST["number"]);
$travelling_month=addslashes($_POST["travelling_month"]);
$no_people=addslashes($_POST["no_people"]);
$trip_starting_location=addslashes($_POST["trip_starting_location"]);
$trip_ending_location=addslashes($_POST["trip_ending_location"]);
$days_trip=addslashes($_POST["days_trip"]);
$text=addslashes($_POST["text"]);
$subject="Online Query!!";

$namevalue ='name="'.$name.'",email="'.$email.'",number="'.$number.'",travelling_month="'.$travelling_month.'",no_people="'.$no_people.'",trip_starting_location="'.$trip_starting_location.'",trip_ending_location="'.$trip_ending_location.'",days_trip="'.$days_trip.'",text="'.$text.'",user_ip="'.$user_ip.'"';
$query=addlistinggetlastid("contact_query",$namevalue);


//Mail
$mailSubject="Online Contact Query";

$mailbody="
<table style='width: 100%;border-collapse: collapse;'>
	<tbody>
		<tr style='border: 1px solid black;'>
			<td style='border: 1px solid black;'><strong>Full Name</strong></td>
            <td style='border: 1px solid black;'>".$name."</td>
        </tr>
        <tr style='border: 1px solid black;'>
			<td style='border: 1px solid black;'><strong>Email</strong></td>
            <td style='border: 1px solid black;'>".$email."</td>
        </tr>
		<tr style='border: 1px solid black;'>
			<td style='border: 1px solid black;'><strong>Number</strong></td>
            <td style='border: 1px solid black;'>".$number."</td>
        </tr>
		<tr style='border: 1px solid black;'>
			<td style='border: 1px solid black;'><strong>Travelling Month</strong></td>
            <td style='border: 1px solid black;'>".$travelling_month."</td>
        </tr>
		<tr style='border: 1px solid black;'>
			<td style='border: 1px solid black;'><strong>Number of People</strong></td>
            <td style='border: 1px solid black;'>".$no_people."</td>
        </tr>
		<tr style='border: 1px solid black;'>
			<td style='border: 1px solid black;'><strong>Trip Starting Location</strong></td>
            <td style='border: 1px solid black;'>".$trip_starting_location."</td>
        </tr>
		<tr style='border: 1px solid black;'>
			<td style='border: 1px solid black;'><strong>Trip Ending Location</strong></td>
            <td style='border: 1px solid black;'>".$trip_ending_location."</td>
        </tr>
		<tr style='border: 1px solid black;'>
			<td style='border: 1px solid black;'><strong>Trip Days</strong></td>
            <td style='border: 1px solid black;'>".$days_trip."</td>
        </tr>
		<tr style='border: 1px solid black;'>
			<td style='border: 1px solid black;'><strong>Message</strong></td>
            <td style='border: 1px solid black;'>".$text."</td>
        </tr>
		<tr style='border: 1px solid black;'>
			<td style='border: 1px solid black;'><strong>User IP</strong></td>
            <td style='border: 1px solid black;'>".$user_ip."</td>
        </tr>
    </tbody>
</table>";

$mailbody.='<p>Team Chal Banjare</p>';
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "From: info@chalbanjare.co.in \r\n";

mail("info@chalbanjare.co.in",$mailSubject,$mailbody,$headers);

header("location:".$fullurl."contactus.html?s=1");

}

if(isset($_POST["package_enquire"])){
$user_ip=$_SERVER['REMOTE_ADDR'];
$package_name=addslashes($_POST["package_name"]);
$fullname=addslashes($_POST["fullname"]);
$email=addslashes($_POST["email"]);
$contact=addslashes($_POST["contact"]);
$dateRange=addslashes($_POST["dateRange"]);
$comment=addslashes($_POST["comment"]);

$namevalue ='package_name="'.$package_name.'",fullname="'.$fullname.'",email="'.$email.'",contact="'.$contact.'",dateRange="'.$dateRange.'",comment="'.$comment.'",user_ip="'.$user_ip.'"';
$query=addlistinggetlastid("package_enquire",$namevalue);


//Mail
$mailSubject="Package Enquiry - $fullname - $package_name";

$mailbody="
<table style='width: 100%;border-collapse: collapse;'>
	<tbody>
		<tr style='border: 1px solid black;'>
			<td style='border: 1px solid black;'><strong>Package Name</strong></td>
            <td style='border: 1px solid black;'>".$package_name."</td>
        </tr>
		<tr style='border: 1px solid black;'>
			<td style='border: 1px solid black;'><strong>Full Name</strong></td>
            <td style='border: 1px solid black;'>".$fullname."</td>
        </tr>
        <tr style='border: 1px solid black;'>
			<td style='border: 1px solid black;'><strong>Email</strong></td>
            <td style='border: 1px solid black;'>".$email."</td>
        </tr>
		<tr style='border: 1px solid black;'>
			<td style='border: 1px solid black;'><strong>Contact</strong></td>
            <td style='border: 1px solid black;'>".$contact."</td>
        </tr>
		
		<tr style='border: 1px solid black;'>
			<td style='border: 1px solid black;'><strong>Date</strong></td>
            <td style='border: 1px solid black;'>".$dateRange."</td>
        </tr>
		<tr style='border: 1px solid black;'>
			<td style='border: 1px solid black;'><strong>Comment</strong></td>
            <td style='border: 1px solid black;'>".$comment."</td>
        </tr>
		<tr style='border: 1px solid black;'>
			<td style='border: 1px solid black;'><strong>User IP</strong></td>
            <td style='border: 1px solid black;'>".$user_ip."</td>
        </tr>
    </tbody>
</table>";

$mailbody.='<p>Team Chal Banjare</p>';
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "From: info@chalbanjare.co.in \r\n";

mail("info@chalbanjare.co.in",$mailSubject,$mailbody,$headers);

header("location:".$_POST["url"]."?s=1");

}

if(isset($_POST["action"]) && $_POST["action"]=="feedback"){
$user_ip=$_SERVER['REMOTE_ADDR'];
$name=addslashes($_POST["name"]);
$email=addslashes($_POST["email"]);
$number=addslashes($_POST["number"]);
$comment=addslashes($_POST["comment"]);

//$namevalue ='name="'.$name.'",email="'.$email.'",number="'.$number.'",comment="'.$comment.'",user_ip="'.$user_ip.'",addedDate="'.date("Y-m-d H:i:s").'"';
//$query=addlistinggetlastid("feedback",$namevalue);


//Mail
$mailSubject="Website Contact Form - $name";

$mailbody="
<table style='width: 100%;border-collapse: collapse;'>
	<tbody>
		<tr style='border: 1px solid black;'>
			<td style='border: 1px solid black;'><strong>Name</strong></td>
            <td style='border: 1px solid black;'>".$name."</td>
        </tr>
		<tr style='border: 1px solid black;'>
			<td style='border: 1px solid black;'><strong>Email</strong></td>
            <td style='border: 1px solid black;'>".$email."</td>
        </tr>
        <tr style='border: 1px solid black;'>
			<td style='border: 1px solid black;'><strong>Number</strong></td>
            <td style='border: 1px solid black;'>".$number."</td>
        </tr>
		<tr style='border: 1px solid black;'>
			<td style='border: 1px solid black;'><strong>Comment</strong></td>
            <td style='border: 1px solid black;'>".$comment."</td>
        </tr>
		<tr style='border: 1px solid black;'>
			<td style='border: 1px solid black;'><strong>User IP</strong></td>
            <td style='border: 1px solid black;'>".$user_ip."</td>
        </tr>
    </tbody>
</table>";
 
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "From: ".$WebsiteSettingDetails['queryEmail']." \r\n";

mail($WebsiteSettingDetails['queryEmail'],$mailSubject,$mailbody,$headers);

header("location:".$fullurl."contact?s=1");

}
?>