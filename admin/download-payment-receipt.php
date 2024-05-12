<?php include "inc.php"; ?>

<?php 
$a=GetPageRecord('*','sys_userMaster','  id="'.$_SESSION['userid'].'"'); 
$invoiceData=mysqli_fetch_array($a);

$abc=GetPageRecord('*','sys_userMaster','id=1'); 
$LoginUserDetails=mysqli_fetch_array($abc); 

$rs=GetPageRecord('*','sys_PackagePayment',' id="'.decode($_REQUEST['id']).'"');
$paymentlist=mysqli_fetch_array($rs);

$a=GetPageRecord('*','queryMaster',' id="'.$paymentlist['queryId'].'"');
$queryData=mysqli_fetch_array($a);

$b=GetPageRecord('*','userMaster',' id="'.$queryData['clientId'].'"');
$clientData=mysqli_fetch_array($b);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> 
<title>Payment Receipt</title>
</head>

<body>
 <style>
 body { font-size: small; font-family:Arial, Helvetica, sans-serif; }
 .receipt-main::after {
    background: #414143 none repeat scroll 0 0;
    content: "";
    height: 5px;
    left: 0;
    position: absolute;
    right: 0;
    top: -13px;
}
 </style>
 <div class="receipt-main" style="background: #ffffff none repeat scroll 0 0; border-bottom: 12px solid #333333; border-top: 12px solid #9f181c; margin-bottom: 50px; padding: 40px 30px !important; position: relative; box-shadow: 0 1px 21px #acacac; color: #333333; font-family: open sans; max-width: 550px; margin: auto; top: 30px;border-left: 1px solid #ddd;border-right: 1px solid #ddd;">
  
   <table width="100%" border="0" cellspacing="0" cellpadding="3">
     <tr>
       <td width="64%" align="left" valign="top"><img class="img-responsive" alt="iamgurdeeposahan"  src="<?php echo $fullurl; ?>profilepic/<?php echo stripslashes($LoginUserDetails['invoiceLogo']); ?>" width="230" /></td>
       <td width="36%" align="right" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="3">
  <tr>
    <td align="right" valign="top" style="font-size: 14px;"><strong><?php echo strip($getInvData['accountName']); ?></strong></td>
  </tr>
  <tr>
    <td align="right" valign="top"><?php echo stripslashes($LoginUserDetails['phone']); ?></td>
  </tr>
  <tr>
    <td align="right" valign="top"><?php echo stripslashes($LoginUserDetails['email']); ?></td>
  </tr> 
  <tr>
    <td align="right" valign="top"><?php echo stripslashes($LoginUserDetails['address']); ?></td>
  </tr>
  <tr>
    <td align="right" valign="top"><strong>Receipt ID:</strong>&nbsp;#<?php echo ($_REQUEST['id']); ?></td>
  </tr>
</table></td>
     </tr>
     <tr>
       <td align="left">&nbsp;</td>
       <td width="36%" rowspan="5" align="right" valign="bottom"><h1>RECEIPT</h1></td>
     </tr>
     <tr>
       <td width="64%" align="left" style="font-size: 14px;"><strong><?php echo stripslashes($queryData['name']); ?></strong></td>
     </tr>
     <tr>
       <td width="64%" align="left"><strong>Mobile :</strong> <?php echo stripslashes($queryData['phone']); ?></td>
     </tr>
     <tr>
       <td width="64%" align="left"><strong>Email :</strong> <?php echo stripslashes($queryData['email']); ?></td>
     </tr>
     <tr>
       <td width="64%" align="left"><strong>Address :</strong> <?php echo stripslashes($clientData['address']); ?></td>
     </tr>
     <tr>
       <td align="left">&nbsp;	</td>
       <td align="right">&nbsp;</td>
     </tr>
     <tr>
       <td colspan="2" align="left"><table width="100%" border="0" cellspacing="0" cellpadding="10">
         <tr>
           <td width="72%" height="30" bgcolor="#333333" style="color:#fff; border-left:1px solid #ddd; border-top:1px solid #ddd; border-right:1px solid #ddd; font-size: 16px; padding-left:30px;"><strong>Description</strong></td>
           <td width="28%" height="30" align="right" bgcolor="#333333" style="color:#fff; border-top:1px solid #ddd; border-right:1px solid #ddd; font-size: 16px;"><strong>Amount</strong></td>
         </tr>
         <tr>
           <td style="border-left:1px solid #ddd; border-top:1px solid #ddd; border-right:1px solid #ddd; padding-left:30px;">Total  Amount</td>
           <td align="right" style="border-top:1px solid #ddd; border-right:1px solid #ddd;"><strong>&#8377;
              <?php $ba=GetPageRecord('*','sys_packageBuilder',' queryId="'.$queryData['id'].'" and confirmQuote=1'); $packagecost=mysqli_fetch_array($ba); echo number_format($packagecost['grossPrice']); ?>
            /-</strong></td>
         </tr>
         <tr>
           <td align="right" style="border-left:1px solid #ddd; border-top:1px solid #ddd; border-right:1px solid #ddd;">
		   <p><strong>Amount Paid:</strong></p></td>
           <td align="right" style="border-top:1px solid #ddd; border-right:1px solid #ddd;">
		   <p><strong>&#8377;<?php echo ($paymentlist['amount']); ?>/-</strong></p></td>
         </tr>
         <tr>
           <td align="right" style="border-bottom:1px solid #ddd; border-left:1px solid #ddd; border-top:1px solid #ddd; border-right:1px solid #ddd;"><strong>Total Received: </strong></td>
           <td align="right" style="border-bottom:1px solid #ddd; border-top:1px solid #ddd; border-right:1px solid #ddd;color:#339966;"><strong>&#8377;
              <?php $ba=GetPageRecord('SUM(amount) as totalrecived','sys_PackagePayment',' queryId="'.$queryData['id'].'" and packageId="'.$paymentlist['packageId'].'" and paymentStatus=1 '); $packagecostrecived=mysqli_fetch_array($ba); echo number_format($packagecostrecived['totalrecived']); ?>
            /-</strong></td>
         </tr>
         <tr>
           <td align="right" style="border-bottom:1px solid #ddd; border-left:1px solid #ddd; border-top:1px solid #ddd; border-right:1px solid #ddd;"><h3><strong>TOTAL PENDING:</strong></h3></td>
           <td align="right" style="border-bottom:1px solid #ddd; border-top:1px solid #ddd; border-right:1px solid #ddd;color: #9f181c;"><h3><strong>&#8377;<?php echo ($packagecost['grossPrice']-$packagecostrecived['totalrecived']); ?>/-</strong></h3></td>
         </tr>

       </table></td>
     </tr>
     <tr>
       <td align="left"><p><strong>Date :</strong> <?php echo date('d/m/Y - h:i A',strtotime($paymentlist['paymentDate'])); ?></p><p style="color:#8c8c8c;">Thank you for your business!</p></td>
       <td align="right">SIGNATURE</td>
     </tr>
   </table>
    <div style="font-size: 10px; text-align: center; margin-top: 20px; color: #9d9797;">This is computer generated receipt.</div>  
 </div>
 </body>
</html>