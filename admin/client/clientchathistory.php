<?php include "clientinc.php"; 
$pageno=4; 
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
  <h2>CHAT HISTORY </h2> 
</div> 
<ul class="careerfy-row careerfy-employer-profile-form"> 


<li class="careerfy-column-12" id="clientloadmessage" style="max-height: 400px; overflow: auto;">&nbsp;</li>  

 
 
<script> 
	function loadmessagehistory(){ 
		$('#clientloadmessage').load('clientloadmessage.php');
		
	} 
	 
 </script>
</ul>
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
<script>  
loadmessagehistory();
</script>