<?php
include "inc.php"; 

$abcd=GetPageRecord('*','sys_packageBuilder','id="'.decode($_REQUEST['id']).'"'); 
$result=mysqli_fetch_array($abcd); 
 
$select='*'; 
$where='id="'.$result['addedBy'].'"'; 
$rs=GetPageRecord($select,'sys_userMaster',$where); 
$LoginUserDetails=mysqli_fetch_array($rs);
?>
<!DOCTYPE html>
<html lang="en">
   
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
 <title><?php echo stripslashes($result['name']); ?> - <?php echo $clientnameglobal; ?></title> 
 <?php include "headerinc.php"; ?>
</head>

<body>
<?php include "itineraries_final.php"; ?>
</body>
</html>
