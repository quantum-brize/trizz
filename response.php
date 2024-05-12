	<?php 
include "config/database.php";
include "config/function.php";
include "config/setting.php";

	    ob_start();
		 $secretkey = "8d747056b806493f81cb0308f3abce260c6ac1ea";
		 $orderId = $_POST["orderId"];
		 $orderAmount = $_POST["orderAmount"];
		 $referenceId = $_POST["referenceId"];
		 $txStatus = $_POST["txStatus"];
		 $paymentMode = $_POST["paymentMode"];
		 $txMsg = $_POST["txMsg"];
		 $txTime = $_POST["txTime"];
		 $signature = $_POST["signature"];
		 $data = $orderId.$orderAmount.$referenceId.$txStatus.$paymentMode.$txMsg.$txTime;
		 $hash_hmac = hash_hmac('sha256', $data, $secretkey, true) ;
		 $computedSignature = base64_encode($hash_hmac);
		 
		 
		 if ($signature == $computedSignature && $txStatus==="SUCCESS"){

//Order Successful
//Update Order Details
$namevalue ='net_amount_debit="'.$orderAmount.'",referenceId="'.$referenceId.'",status="'.$txStatus.'",txStatus="'.$txStatus.'",paymentMode="'.$paymentMode.'",txMsg="'.$txMsg.'",txTime="'.$txTime.'",signature="'.$signature.'"';  
$where=' token="'.$orderId.'"';
updatelisting('onlineRechargeRequest',$namevalue,$where);

$rs=GetPageRecord('*','onlineRechargeRequest',$where); 
$result=mysqli_fetch_array($rs);


$chkrow=GetPageRecord('*','sys_balanceSheet','token="'.$result["token"].'"'); 
if(mysqli_num_rows($chkrow)==0){
//Insert data in balancesheet
$namevalue ='agentId="'.$result["agentId"].'",amount="'.$orderAmount.'",paymentType="Credit",paymentMethod="Online",transactionId="'.$referenceId.'",token="'.$result["token"].'",remarks="'.$result["notes"].'",addedBy="'.$result['agentId'].'",addDate="'.date('Y-m-d H:i:s').'"';  
addlistinggetlastid('sys_balanceSheet',$namevalue); 

}

?>


<script>
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
Wait Please...
<?php

			exit();
	  	} else {
			
//Update Order Details
$namevalue ='net_amount_debit="'.$orderAmount.'",referenceId="'.$referenceId.'",txStatus="'.$txStatus.'",paymentMode="'.$paymentMode.'",txMsg="'.$txMsg.'",txTime="'.$txTime.'",signature="'.$signature.'"';  
$where=' id="'.$orderId.'"';
updatelisting('onlineRechargeRequest',$namevalue,$where);
			
			echo "Order Id#" .$referenceId;
			echo "<br>";
			echo $txMsg;
			
			echo "<br>";
			
			echo "<a href='".$fullurl."'>Click here to go back</a>";
			
			//Failed
			//header("Location: ../confirmpaymentaction.php?id=");
			exit();
	 	}
	 ?>