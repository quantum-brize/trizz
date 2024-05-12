<?php include "clientinc.php"; 
$pageno=5; 
 $result =mysqli_query (db(),"select * from userMaster where id='".$_SESSION['clientId']."' ")  or die(mysqli_error());   
$userinfo=mysqli_fetch_array($result);
 
 ?>
<!DOCTYPE html>
<html lang="en">
 
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>My Chat - <?php echo $clientnameglobal; ?></title>

<?php include "clientheaderinc.php";  ?>
<style>
.table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td { 
    vertical-align: middle !important;     line-height: 20px !important;
}
</style>
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
 
 
<div class="careerfy-employer-box-section" >

<div class="careerfy-profile-title" style="margin-bottom:0px;">
  <h2>Privacy Policy! TravBizz</h2> 
</div> 
  <br>
<br>

<div dir="auto">TravBizz comprehends your anxiety for security and ensures ensuring the individual data of the clients; including their names, locations and contact subtle elements they share with us. We, being a reliable travel management co., make each move to secure your protection.</div>
<div dir="auto"><br>
</div>
<div dir="auto">For going to TravBizz site, you don't have to uncover your own data. The individual client investigating our site stays finish unknown.</div>
<div dir="auto"><br>
</div>
<div dir="auto">Truly few of our website pages utilize "cookies" to serve the clients better and to give them the customized data they require from our web page. Cookies just distinguish the sites to smooth the advance of your following visit to our site. Data that we gather through them is utilized just to break down and enhance our administrations for you. No individual data identified is gathered or utilized as a part of this procedure.</div>
<div dir="auto"><br>
</div>
<div dir="auto">On the off chance that you make any reserving/obtaining or agree to accept bulletins of our site, web based business exchanges, TravBizz gathers the accompanying individual data from you while executing:</div>
<div dir="auto"><br>
</div>
<div dir="auto">Name</div>
<div dir="auto">Contact Number</div>
<div dir="auto">Address</div>
<div dir="auto">Credit Card details</div>
<div dir="auto">Age</div>
<div dir="auto">Email Id</div>
<div dir="auto">TravBizz does not share or arrangement for any of the above touchy data without the consent of its clients or clients. The previously mentioned data is gathered from the clients/clients/voyagers for following use:</div>
<div dir="auto"><br>
</div>
<div dir="auto">To do Bookings:-</div>
<div dir="auto"><br>
</div>
<div dir="auto">Names, addresses, telephone numbers and age points of interest are imparted to related specialist co-ops, including carriers, lodgings, or transport administrations to give reservation and booking to the clients or explorers.</div>
<div dir="auto"><br>
</div>
<div dir="auto">To send promotional deals:-</div>
<div dir="auto"><br>
</div>
<div dir="auto">TravBizz utilizes points of interest like versatile numbers and email I'd for sending data about any special offers. We frequently support advancements and fortunate attracts to give individuals a chance to win rebates on movement or different prizes. This is likewise discretionary and the client can withdraw for such messages. In such cases, clients stay unconscious about continuous limited time rebates.</div>
<div dir="auto"><br>
</div>
<div dir="auto">Member Registration:-</div>
<div dir="auto"><br>
</div>
<div dir="auto">In the event that you select to be an enrolled individual from our site, data like name, address, phone number, email address, a one of a kind login name and secret word are inquired. This data is gathered on the enlistment frame for different purposes like</div>
<div dir="auto"><br>
</div>
<div dir="auto">1. User recognition</div>
<div dir="auto">2. To complete the travel reservations</div>
<div dir="auto">3. To let us connecting with you for customer service purposes, if necessary</div>
<div dir="auto">4. To contact you in order to meet your specific needs; and</div>
<div dir="auto">5. To improve our products and services</div>
<div dir="auto">6. To confirm your new member registration and each booking you do.</div>
<div dir="auto">Reviews:-</div>
<div dir="auto"><br>
</div>
<div dir="auto">TravBizz distinguishes the significance of its clients' supposition. It frequently leads studies and uses individual recognizable proof data to welcome its normal clients for partaking into the reviews. Clients can partake in these reviews at totally without anyone else decision. Regularly, we lead the overviews to think about their encounters with TravBizz and to make our site, portable site and versatile application more easy to use for its individuals. Review challengers stay unknown.</div>
<div dir="auto"><br>
</div>
<div dir="auto">Shield Sensitive Information:-</div>
<div dir="auto"><br>
</div>
<div dir="auto">Touchy data like Credit/Debit Card and Net Banking Details are for the most part gathered by the installment passages and banks and not by TravBizz. In any case, if still this data is put away on our webpage, it remains totally unshared and safe, barring that on the off chance that it hosts been imparted to any third gathering by blame through you while perusing our site. Infrequently, such data is imparted to certain outsiders to process the Cash back offers and rebates, if material.</div>
<div dir="auto"><br>
</div>
<div dir="auto">Programmed Logging of Session Data:-</div>
<div dir="auto"><br>
</div>
<div dir="auto">We record session information of the clients, which incorporates IP address, OS, program programming and the exercises of the client on his gadget. We gather session information to assess client conduct. It encourages us in distinguishing the issues with our servers and gives us a chance to enhance our frameworks. This data does not distinguish any guest actually and just analyze the client's unpleasant geographic area.</div>
<div dir="auto"><br>
</div>
<div dir="auto">TravBizz takes most extreme activities conceivable to secure the data you share with us. We have taken propelled innovation and safety efforts alongside strict arrangement rules to secure the protection of our clients and spare their data from any undesirable access. We are continually upgrading our safety efforts utilizing further developed innovation.</div>
<div dir="auto"><br>
</div>
<div dir="auto">Our security strategy may change because of any unexpected conditions and improvement of innovations. To gain admittance to our new protection strategy, continue checking the sites frequently and recognize our most recent arrangements.</div>
<div dir="auto"><br>
</div>
<div dir="auto">Much obliged to you for utilizing TravBizz! We guarantee you a sheltered exchange.</div>

</div>  
</div>
</div>
</div>
</div>
</div>

</div> 
</div>
 <div id="deletedoc" style="display:none;"></div>
<?php include "clientfooterinc.php";  ?>

</body>
 
</html>
