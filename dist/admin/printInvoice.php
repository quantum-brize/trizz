<?php
include "inc.php";


$a=GetPageRecord('*','sys_userMaster','  id="'.$_SESSION['userid'].'"'); 
$invoiceData=mysqli_fetch_array($a);

$abc=GetPageRecord('*','sys_userMaster','id=1'); 
$LoginUserDetails=mysqli_fetch_array($abc); 

$rsa=GetPageRecord('*','sys_invoiceMaster',' id="'.decode($_REQUEST['id']).'" order by id desc');
$invoiceData=mysqli_fetch_array($rsa);

$rsa=GetPageRecord('*','queryMaster',' id="'.decode($_REQUEST['queryId']).'" order by id desc');
$rest=mysqli_fetch_array($rsa);

$b=GetPageRecord('*','userMaster','id="'.$rest['clientId'].'"'); 
$clientData=mysqli_fetch_array($b);

if($clientData['city']!=''){ $clientCity= getCityName($clientData['city']); }
 
$bp=GetPageRecord('*','sys_packageBuilder','queryId="'.$rest['id'].'" and confirmQuote=1'); 
$result=mysqli_fetch_array($bp);
?> 
<div style="width:800px; border:2px solid #000; margin: auto; padding:0px;">

<table width="100%" border="0" cellpadding="10" cellspacing="0" style="font-size:13px;">
  <tr>
    <td width="50%" rowspan="3" align="left" valign="top" style=" border-bottom:1px solid #000;"><img src="<?php echo $fullurl; ?>profilepic/<?php echo stripslashes($LoginUserDetails['invoiceLogo']); ?>" style="max-width:200px; height:auto;"/><br /><br />

<strong><?php echo stripslashes($LoginUserDetails['invoiceCompany']); ?>  </strong><br>
      Address: <?php echo stripslashes($LoginUserDetails['invoiceAddress']); ?>  <br>
      GSTN: <?php echo stripslashes($LoginUserDetails['Invoicegstn']); ?><br>
      State Name : <?php echo stripslashes($LoginUserDetails['invoiceState']); ?> <?php echo stripslashes($LoginUserDetails['invoiceStateCode']); ?> <br>
      E-Mail : <?php echo stripslashes($LoginUserDetails['invoiceEmail']); ?></td>
    <td width="25%" align="left" valign="top" style="border-left:1px solid #000; border-bottom:1px solid #000;">Invoice No.  <br>
      <strong>FF/<?php echo date('y',strtotime($invoiceData['invoiceDate']));  ?>-<?php echo date('y',strtotime($invoiceData['invoiceDate'].' + 1 years'));  ?>/<?php echo ($invoiceData['id']);  ?></strong></td>
    <td width="25%" align="left" valign="top" style="border-left:1px solid #000; border-bottom:1px solid #000;">Dated  <br>
      <strong><?php echo date('j M Y',strtotime($invoiceData['invoiceDate']));  ?></strong></td>
  </tr>
  <tr>
    <td width="25%" align="left" valign="top" style="border-left:1px solid #000; border-bottom:1px solid #000;">Delivery Note</td>
    <td width="25%" align="left" valign="top" style="border-left:1px solid #000; border-bottom:1px solid #000;">Mode/Terms of Payment</td>
  </tr>
  <tr>
    <td width="25%" align="left" valign="top" style="border-left:1px solid #000; border-bottom:1px solid #000;">Supplier&rsquo;s Ref. </td>
    <td width="25%" align="left" valign="top" style="border-left:1px solid #000; border-bottom:1px solid #000;">Other Reference(s)</td>
  </tr>
  <tr>
    <td rowspan="4" align="left" valign="top" style="  border-bottom:1px solid #000;"><strong>Buyer  </strong><br>
      <?php echo stripslashes($clientData['submitName']); ?> <?php echo stripslashes($clientData['firstName']); ?> <?php echo stripslashes($clientData['lastName']); ?><br>
      <br>  
      <strong>State Name:</strong> <?php echo $clientCity; ?></td>
    <td width="25%" align="left" valign="top" style="border-left:1px solid #000; border-bottom:1px solid #000;">Buyer&rsquo;s Order No.</td>
    <td width="25%" align="left" valign="top" style="border-left:1px solid #000; border-bottom:1px solid #000;">Dated</td>
  </tr>
  <tr>
    <td width="25%" align="left" valign="top" style="border-left:1px solid #000; border-bottom:1px solid #000;">Despatch Document No. </td>
    <td width="25%" align="left" valign="top" style="border-left:1px solid #000; border-bottom:1px solid #000;">Delivery Note Date</td>
  </tr>
  <tr>
    <td width="25%" align="left" valign="top" style="border-left:1px solid #000; border-bottom:1px solid #000;">Despatched through</td>
    <td width="25%" align="left" valign="top" style="border-left:1px solid #000; border-bottom:1px solid #000;">Destination</td>
  </tr>
  <tr>
    <td colspan="2" align="left" valign="top" style="border-left:1px solid #000; border-bottom:1px solid #000;">Terms of Delivery</td>
    </tr>
</table>

<table width="100%" border="0" cellpadding="10" cellspacing="0" style="font-size:13px;">
  <tr>
    <td width="4%" align="left" valign="top" style=" border-bottom:1px solid #000;"><strong>Sr.</strong></td>
    <td width="30%" align="left" valign="top" style="border-left:1px solid #000; border-bottom:1px solid #000;"><strong>Particulars</strong></td>
    <td width="15%" align="left" valign="top" style="border-left:1px solid #000; border-bottom:1px solid #000;"><strong>HSN/SAC</strong></td>
    <td width="15%" align="left" valign="top" style="border-left:1px solid #000; border-bottom:1px solid #000;"><strong>Quantity</strong></td>
    <td width="15%" align="right" valign="top" style="border-left:1px solid #000; border-bottom:1px solid #000;"><strong>Rate</strong></td>
    <td width="2%" align="center" valign="top" style="border-left:1px solid #000; border-bottom:1px solid #000;"><strong>per</strong></td>
    <td width="19%" align="right" valign="top" style="border-left:1px solid #000; border-bottom:1px solid #000;"><strong>Amount</strong></td>
  </tr>
  <tr>
    <td align="left" valign="top" style=" ">1.</td>
    <td align="left" valign="top" style="border-left:1px solid #000; "><?php echo $result['name']; ?></td>
    <td align="left" valign="top" style="border-left:1px solid #000; "><?php echo $result['grossNoGSTPrice']; ?></td>
    <td align="left" valign="top" style="border-left:1px solid #000; ">&nbsp;</td>
    <td align="right" valign="top" style="border-left:1px solid #000; ">&nbsp;</td>
    <td width="2%" align="center" valign="top" style="border-left:1px solid #000; ">&nbsp;</td>
    <td align="right" valign="top" style="border-left:1px solid #000; ">&#8377;<?php echo number_format($result['grossNoGSTPrice'],0); ?></td>
  </tr>
  <?php if($result['cgst']>0){ ?>
  <tr>
    <td align="left" valign="top" style=" ">&nbsp;</td>
    <td align="left" valign="top" style="border-left:1px solid #000; ">CGST@<?php echo $result['cgst']; ?>% OUTPUT</td>
    <td align="left" valign="top" style="border-left:1px solid #000; ">&nbsp;</td>
    <td align="left" valign="top" style="border-left:1px solid #000; ">&nbsp;</td>
    <td align="right" valign="top" style="border-left:1px solid #000; "><?php echo $result['cgst']; ?></td>
    <td width="2%" align="center" valign="top" style="border-left:1px solid #000; ">%</td>
    <td align="right" valign="top" style="border-left:1px solid #000; ">&#8377;<?php echo number_format($result['totalcgst'],0); ?></td>
  </tr>
  <?php } ?>
   <?php if($result['sgst']>0){ ?>
  <tr>
    <td align="left" valign="top" style=" ">&nbsp;</td>
    <td align="left" valign="top" style="border-left:1px solid #000; ">SGST@<?php echo $result['sgst']; ?>% OUTPUT</td>
    <td align="left" valign="top" style="border-left:1px solid #000; ">&nbsp;</td>
    <td align="left" valign="top" style="border-left:1px solid #000; ">&nbsp;</td>
    <td align="right" valign="top" style="border-left:1px solid #000; "><?php echo $result['sgst']; ?></td>
    <td width="2%" align="center" valign="top" style="border-left:1px solid #000; ">%</td>
    <td align="right" valign="top" style="border-left:1px solid #000; ">&#8377;<?php echo number_format($result['totalsgst'],0); ?></td>
  </tr>
  <?php } ?>
   <?php if($result['igst']>0){ ?>
  <tr>
    <td align="left" valign="top" style=" ">&nbsp;</td>
    <td align="left" valign="top" style="border-left:1px solid #000; ">IGST@<?php echo $result['igst']; ?>% OUTPUT</td>
    <td align="left" valign="top" style="border-left:1px solid #000; ">&nbsp;</td>
    <td align="left" valign="top" style="border-left:1px solid #000; ">&nbsp;</td>
    <td align="right" valign="top" style="border-left:1px solid #000; "><?php echo $result['igst']; ?></td>
    <td width="2%" align="center" valign="top" style="border-left:1px solid #000; ">%</td>
    <td align="right" valign="top" style="border-left:1px solid #000; ">&#8377;<?php echo number_format($result['totaligst'],0); ?></td>
  </tr>
  <?php } ?> 
  <tr>
    <td align="left" valign="top" style=" border-bottom:1px solid #000;">&nbsp;</td>
    <td width="30%" align="left" valign="top" style="border-left:1px solid #000; border-bottom:1px solid #000;">TCS@5%<span style=" "> OUTPUT</span></td>
    <td align="left" valign="top" style="border-left:1px solid #000; border-bottom:1px solid #000;">&nbsp;</td>
    <td align="left" valign="top" style="border-left:1px solid #000; border-bottom:1px solid #000;">&nbsp;</td>
    <td align="right" valign="top" style="border-left:1px solid #000; border-bottom:1px solid #000;">5</td>
    <td width="2%" align="center" valign="top" style="border-left:1px solid #000; border-bottom:1px solid #000;"><span style="">%</span></td>
    <td align="right" valign="top" style="border-left:1px solid #000; border-bottom:1px solid #000;">&#8377;<?php echo number_format($result['grosstcs'],0); ?></td>
  </tr>
  <tr>
    <td align="left" valign="top" style=" border-bottom:1px solid #000;">&nbsp;</td>
    <td width="30%" align="left" valign="top" style="border-left:1px solid #000; border-bottom:1px solid #000;">&nbsp;</td>
    <td align="left" valign="top" style="border-left:1px solid #000; border-bottom:1px solid #000;">&nbsp;</td>
    <td align="left" valign="top" style="border-left:1px solid #000; border-bottom:1px solid #000;">&nbsp;</td>
    <td align="right" valign="top" style="border-left:1px solid #000; border-bottom:1px solid #000;">&nbsp;</td>
    <td width="2%" align="right" valign="top" style="border-left:1px solid #000; border-bottom:1px solid #000;">Total </td>
    <td align="right" valign="top" style="border-left:1px solid #000; border-bottom:1px solid #000;"><span style=" ">&#8377;<?php echo number_format($result['grossPrice'],0); ?></span></td>
  </tr>
  <tr>
    <td colspan="6" align="left" valign="top" style=" border-bottom:1px solid #000;">Amount Chargeable (in words)<br>
      <strong><?php echo getcurrenyWord($result['grossPrice']); ?></strong></td>
    <td align="right" valign="top" style="border-left:1px solid #000; border-bottom:1px solid #000;"><em>E. & O.E</em></td>
  </tr>
</table>

   <?php if($result['igst']>0){ ?> 
   
   <table width="100%" border="0" cellpadding="10" cellspacing="0" style="font-size:13px;">
  <tr>
    <td rowspan="2" align="left" valign="top" style="border-bottom:1px solid #000;"><strong>HSN/SAC</strong></td>
    <td rowspan="2" align="left" valign="top" style="border-left:1px solid #000; border-bottom:1px solid #000;"><strong>Taxable Value</strong></td>
    <td colspan="2" align="center" valign="top" style="border-left:1px solid #000; border-bottom:1px solid #000;"><strong>Integrated Tax </strong></td>
    <td colspan="2" align="center" valign="top" style="border-left:1px solid #000; border-bottom:1px solid #000;"><strong>TCS</strong></td>
    <td rowspan="2" align="right" valign="top" style="border-left:1px solid #000; border-bottom:1px solid #000;"><strong>Total Tax Amount</strong></td>
  </tr>
  <tr>
    <td align="center" valign="top" style="border-left:1px solid #000; border-bottom:1px solid #000;"><strong>Rate</strong></td>
    <td align="center" valign="top" style="border-left:1px solid #000; border-bottom:1px solid #000;"><strong>Amount</strong></td>
    <td align="center" valign="top" style="border-left:1px solid #000; border-bottom:1px solid #000;"><strong>Rate</strong></td>
    <td align="center" valign="top" style="border-left:1px solid #000; border-bottom:1px solid #000;"><strong>Amount</strong></td>
  </tr>
  <tr>
    <td align="left" valign="top" style="  "><span style=""><?php echo $result['grossNoGSTPrice']; ?></span></td>
    <td align="left" valign="top" style="border-left:1px solid #000; "><?php echo $result['grossPrice']; ?></td>
    <td align="left" valign="top" style="border-left:1px solid #000; "><?php echo $result['igst']; ?>% </td>
    <td align="right" valign="top" style="border-left:1px solid #000; "><?php echo $result['totaligst']; ?></td>
    <td align="center" valign="top" style="border-left:1px solid #000; ">5%</td>
    <td align="center" valign="top" style="border-left:1px solid #000; "><span style=""><?php echo $result['grosstcs']; ?></span></td>
    <td align="right" valign="top" style="border-left:1px solid #000; ">&#8377;<?php echo number_format(round($result['totalcgst']+$result['totalsgst']+$result['grosstcs']),0); ?></td>
  </tr>
  <tr>
    <td align="right" valign="top" style=" border-top:1px solid #000; "><strong>Total</strong></td>
    <td align="left" valign="top" style="border-left:1px solid #000; border-top:1px solid #000;"><strong>&#8377;<?php echo number_format($result['grossPrice'],0); ?></strong></td>
    <td align="left" valign="top" style="border-left:1px solid #000;border-top:1px solid #000; ">&nbsp;</td>
    <td align="right" valign="top" style="border-left:1px solid #000;border-top:1px solid #000; "><strong>&#8377;<?php echo number_format($result['totaligst'],0); ?></strong></td>
    <td align="center" valign="top" style="border-left:1px solid #000; border-top:1px solid #000;">&nbsp;</td>
    <td align="center" valign="top" style="border-left:1px solid #000;border-top:1px solid #000; "><strong>&#8377;<?php echo number_format($result['grosstcs'],0); ?></strong></td>
    <td align="right" valign="top" style="border-left:1px solid #000; border-top:1px solid #000;"><strong>&#8377;<?php echo number_format(round($result['totalcgst']+$result['totalsgst']+$result['grosstcs']),0); ?></strong></td>
  </tr>
  <tr>
    <td colspan="3" align="left" valign="top" style=" border-top:1px solid #000; ">Tax Amount (in words) : </td>
    <td colspan="4" align="left" valign="top" style="border-left:1px solid #000; border-top:1px solid #000; "><strong><?php echo getcurrenyWord(round($result['totalcgst']+$result['totalsgst']+$result['grosstcs'])); ?></strong></td>
    </tr>
</table>
   
   <?php  } if($result['cgst']>0 || $result['sgst']>0){ ?>

<table width="100%" border="0" cellpadding="10" cellspacing="0" style="font-size:13px;">
  <tr>
    <td rowspan="2" align="left" valign="top" style="border-bottom:1px solid #000;"><strong>HSN/SAC</strong></td>
    <td rowspan="2" align="left" valign="top" style="border-left:1px solid #000; border-bottom:1px solid #000;"><strong>Taxable Value</strong></td>
    <td colspan="2" align="center" valign="top" style="border-left:1px solid #000; border-bottom:1px solid #000;"><strong>Central Tax </strong></td>
    <td colspan="2" align="center" valign="top" style="border-left:1px solid #000; border-bottom:1px solid #000;"><strong>State Tax</strong></td>
    <td colspan="2" align="center" valign="top" style="border-left:1px solid #000; border-bottom:1px solid #000;"><strong>TCS</strong></td>
    <td rowspan="2" align="right" valign="top" style="border-left:1px solid #000; border-bottom:1px solid #000;"><strong>Total Tax Amount</strong></td>
  </tr>
  <tr>
    <td align="center" valign="top" style="border-left:1px solid #000; border-bottom:1px solid #000;"><strong>Rate</strong></td>
    <td align="center" valign="top" style="border-left:1px solid #000; border-bottom:1px solid #000;"><strong>Amount</strong></td>
    <td align="center" valign="top" style="border-left:1px solid #000; border-bottom:1px solid #000;"><strong>Rate</strong></td>
    <td align="center" valign="top" style="border-left:1px solid #000; border-bottom:1px solid #000;"><strong>Amount</strong></td>
    <td align="center" valign="top" style="border-left:1px solid #000; border-bottom:1px solid #000;"><strong>Rate</strong></td>
    <td align="center" valign="top" style="border-left:1px solid #000; border-bottom:1px solid #000;"><strong>Amount</strong></td>
  </tr>
  <tr>
    <td align="left" valign="top" style="  "><span style="border-left:1px solid #000; "><?php echo $result['grossNoGSTPrice']; ?></span></td>
    <td align="left" valign="top" style="border-left:1px solid #000; "><?php echo $result['grossPrice']; ?></td>
    <td align="left" valign="top" style="border-left:1px solid #000; "><?php echo $result['cgst']; ?>% </td>
    <td align="right" valign="top" style="border-left:1px solid #000; "><?php echo $result['totalcgst']; ?></td>
    <td align="center" valign="top" style="border-left:1px solid #000; "><?php echo $result['sgst']; ?>%</td>
    <td align="right" valign="top" style="border-left:1px solid #000; "><?php echo $result['totalsgst']; ?></td>
    <td align="center" valign="top" style="border-left:1px solid #000; ">5%</td>
    <td align="center" valign="top" style="border-left:1px solid #000; "><span style=""><?php echo $result['grosstcs']; ?></span></td>
    <td align="right" valign="top" style="border-left:1px solid #000; ">&#8377;<?php echo number_format(round($result['totalcgst']+$result['totalsgst']+$result['grosstcs']),0); ?></td>
  </tr>
  <tr>
    <td align="right" valign="top" style=" border-top:1px solid #000; "><strong>Total</strong></td>
    <td align="left" valign="top" style="border-left:1px solid #000; border-top:1px solid #000;"><strong>&#8377;<?php echo number_format($result['grossPrice'],0); ?></strong></td>
    <td align="left" valign="top" style="border-left:1px solid #000;border-top:1px solid #000; ">&nbsp;</td>
    <td align="right" valign="top" style="border-left:1px solid #000;border-top:1px solid #000; "><strong>&#8377;<?php echo number_format($result['totalcgst'],0); ?></strong></td>
    <td align="center" valign="top" style="border-left:1px solid #000;border-top:1px solid #000; ">&nbsp; </td>
    <td align="right" valign="top" style="border-left:1px solid #000;border-top:1px solid #000; "><strong>&#8377;<?php echo number_format($result['totalsgst'],0); ?></strong></td>
    <td align="center" valign="top" style="border-left:1px solid #000; border-top:1px solid #000;">&nbsp;</td>
    <td align="center" valign="top" style="border-left:1px solid #000;border-top:1px solid #000; "><strong>&#8377;<?php echo number_format($result['grosstcs'],0); ?></strong></td>
    <td align="right" valign="top" style="border-left:1px solid #000; border-top:1px solid #000;"><strong>&#8377;<?php echo number_format(round($result['totalcgst']+$result['totalsgst']+$result['grosstcs']),0); ?></strong></td>
  </tr>
  <tr>
    <td colspan="3" align="left" valign="top" style=" border-top:1px solid #000; ">Tax Amount (in words) : </td>
    <td colspan="6" align="left" valign="top" style="border-left:1px solid #000; border-top:1px solid #000; "><strong><?php echo getcurrenyWord(round($result['totalcgst']+$result['totalsgst']+$result['grosstcs'])); ?></strong></td>
    </tr>
</table>
	
	<?php } ?>
	
<table width="100%" border="0" cellpadding="10" cellspacing="0" style="font-size:13px;">
  <tr>
    <td width="60%" align="left" valign="top" style=" border-top:1px solid #000; "><?php echo stripslashes($LoginUserDetails['inclusion']); ?> </td>
    <td width="48%" align="right" valign="bottom" style="border-left:1px solid #000; border-top:1px solid #000; "> <strong>for <?php echo stripslashes($LoginUserDetails['invoiceCompany']); ?></strong><br>
        <br>
          <br>
        <br>
      Authorised Signatory</td>
    </tr>
  <tr>
    <td colspan="2" align="center" valign="top" style=" border-top:1px solid #000; text-transform:uppercase; ">
      This is a Computer Generated Invoice</td>
    </tr>
</table>
</div>