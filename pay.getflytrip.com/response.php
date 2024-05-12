<?php 
session_start();
include "config/database.php";
include "config/function.php";
include "config/setting.php";


?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
//parent.allBookingSubmit();
//window.opener.bookingFormSubmit();
</script>


<?php


include_once('easebuzz-lib/easebuzz_payment_gateway.php');
$SALT = "HSMFG0M0M9";

$easebuzzObj = new Easebuzz($MERCHANT_KEY = null, $SALT, $ENV = null);
$result = $easebuzzObj->easebuzzResponse( $_POST );

$response=json_decode($result, true);

 


$status=$response['data']['status'];
$name_on_card=$response['data']['name_on_card'];
$net_amount_debit=$response['data']['net_amount_debit'];
$payment_source=$response['data']['payment_source'];
$easepayid=$response['data']['easepayid'];
$amount=$response['data']['amount'];
$txnid=$response['data']['txnid']; //Token
$udf1=$response['data']['udf1'];
$udf2=$response['data']['udf2'];
$udf3=$response['data']['udf3'];
$udf4=$response['data']['udf4'];
$udf5=$response['data']['udf5'];
$udf6=$response['data']['udf6'];//Payment Transaction Type: Recharge & Booking
$deduction_percentage=$response['data']['deduction_percentage'];

//Fetch & Match With Previous Details
$id=decode($txnid);

 

$_SESSION=json_decode(file_get_contents("usersession/".$udf2.".txt"));  

$_SESSION['agentUserid']=$udf2;


if($status=='success' && $easepayid!='' && $txnid!=''){

$namevalue ='status="success",net_amount_debit="'.$net_amount_debit.'",payment_source="'.$payment_source.'",easepayid="'.$easepayid.'",deduction_percentage="'.$deduction_percentage.'"';
 $where='status="pending" and email="'.$udf5.'" and  requestedAmount="'.$amount.'"';
updatelisting('onlineRechargeRequest',$namevalue,$where);		

 
$a=GetPageRecord('*','sys_userMaster','email="'.$udf5.'" ');   
$agentid=mysqli_fetch_array($a);

$namevalue ='agentId="'.$agentid['id'].'",amount="'.$amount.'",paymentType="Credit",paymentMethod="Online",transactionId="'.$easepayid.'",token="'.$id.'",remarks="Online Recharge",addedBy="'.$agentid['id'].'",addDate="'.date('Y-m-d H:i:s').'"';  
addlistinggetlastid('sys_balanceSheet',$namevalue); 

  
$_SESSION=json_decode(file_get_contents("usersession/".$udf2.".txt"));  
$_SESSION['agentUserid']=$udf2;
 
?>



<script>
//parent.allBookingSubmit(); 
//parent.window.opener.bookingFormSubmit();

    function closeWindow() { 
        let new_window =
            open(location, '_self');
       
        new_window.close();
      
        return false;
    }
setTimeout(function() { 
closeWindow();
}, 2000);
	
 
</script>

Wait Please...
<?php
 

exit();

}else {
			
//Update Order Details
$namevalue ='status="'.$status.'",net_amount_debit="'.$net_amount_debit.'",payment_source="'.$payment_source.'",easepayid="'.$easepayid.'",deduction_percentage="'.$deduction_percentage.'"';
$where='token="'.$id.'"';
updatelisting('onlineRechargeRequest',$namevalue,$where);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Paymemt Information</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body style="font-family:Arial, Helvetica, sans-serif; float:14px; ">
<div class="container" style="text-align:center;">
  <h2>Payment Failure</h2>            
  <table border="1" cellpadding="10" cellspacing="0" bordercolor="#000000" class="table" style="font-size:14px;">
    <tbody>
      <tr>
        <td align="left" bgcolor="#F0F0F0"><strong>Status</strong></td>
        <td align="left" bgcolor="#F0F0F0"><strong>Falied</strong></td>
      </tr>
      <tr>
        <td align="left"><strong>Transaction Id</strong></td>
        <td align="left"><?php echo $txnid; ?></td>
      </tr>
	  <tr>
        <td align="left"><strong>Payable Amount</strong></td>
        <td align="left"><?php echo $net_amount_debit; ?></td>
      </tr>
      <tr>
        <td align="left"><strong>Reference Id</strong></td>
        <td align="left"><?php echo $easepayid; ?></td>
      </tr>
    </tbody>
  </table>    
</div>
 
<script type="text/javascript">

    function closeWindow() { 
        let new_window =
            open(location, '_self');
       
        new_window.close();
      
        return false;
    }
 
setTimeout(function() { 
 closeWindow();
}, 3000);


</script>
</body>
</html>

<?php
	exit();
}
?>