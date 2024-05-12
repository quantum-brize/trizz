<?php 
include "inc.php";

$_SESSION['agentUserid']=$_REQUEST['ag'];
 

if($_REQUEST['id']!=''){
$a=GetPageRecord('*','flightBookingMaster',' id="'.decode($_REQUEST['id']).'" and agentId="'.$_SESSION['agentUserid'].'"'); 
$rest=mysqli_fetch_array($a); 

$a=GetPageRecord('*','flightBookingMaster',' id="'.decode($_REQUEST['id']).'" and agentId="'.$_SESSION['agentUserid'].'"'); 
$editresult=mysqli_fetch_array($a); 

if($rest['id']==''){
echo 'Something went wrong. Please try again.';
exit();
}

$b=GetPageRecord('*','sys_userMaster',' id=1  '); 
$adminData=mysqli_fetch_array($b); 


$urs=GetPageRecord('*','sys_userMaster',' id="'.$rest['agentId'].'" '); 
$agentData=mysqli_fetch_array($urs); 


$urs=GetPageRecord('*','sys_userMaster',' userType="b2cwebsite" '); 
$gstdata=mysqli_fetch_array($urs); 
} 

$segmentsDataArr=(array) unserialize(stripslashes($rest['searchArrey']));


function getcabin($id){

if($id==2){ 
$cabin='Economy';
}
if($id==3){ 
$cabin='Premium Economy';
}
if($id==4){ 
$cabin='Business';
}
if($id==6){ 
$cabin='First Class';
} 
return $cabin;
}
?> 

<div style="margin:auto; padding:10px;" id="DivIdToPrint">
<style>
table { font-size:12px; color:#000000; }
</style>
<style>
@media print {
body{padding:0px;}
table tr td { font-family:Arial, Helvetica, sans-serif;  font-size:13px; }
}

@page {
    size: auto;   /* auto is the initial value */
    margin: 0;  /* this affects the margin in the printer settings */
}
</style>
<table width="100%" border="0" cellpadding="5" style="font-size:12px; ">
  <tr>
    <td width="34%" align="left"><img src="<?php echo $profilepic; ?><?php echo $websitesetting['websiteLogo']; ?>" height="55"></td>
    <td width="27%">&nbsp;</td>
    <td width="39%" align="right" valign="middle"><div style="font-size:24px; text-decoration:underline; font-weight:600">Invoice</div></td>
  </tr>
  <tr>
    <td width="34%" valign="top"><table width="100%" border="0" cellpadding="0">
      <tr>
        <td><strong><?php echo strtoupper($adminData['invoiceCompany']); ?></strong></td>
      </tr>
      <tr>
        <td><?php echo stripslashes($adminData['invoiceAddress']); ?></td>
      </tr>
      <tr>
        <td>Tel: <?php echo stripslashes($adminData['invoicePhone']); ?> </td>
      </tr>
      <tr>
        <td>Email: <?php echo stripslashes($adminData['invoiceEmail']); ?> </td>
      </tr>
      <tr>
        <td>GSTN: <?php echo stripslashes($adminData['Invoicegstn']); ?></td>
      </tr>
      
    </table></td>
    <td width="27%">&nbsp;</td>
        <td width="39%" align="right" valign="top"><table width="100%" border="0" cellpadding="0">
          <tr>
            <td align="right"><strong><?php echo stripslashes($agentData['companyName']); ?></strong><br>
          </tr>
          <tr>
            <td align="right"><?php echo stripslashes($agentData['address']); ?></td>
          </tr>
          
          <tr>
            <td align="right">Mobile No: <?php echo stripslashes($agentData['phone']); ?></td>
          </tr> 
          <tr>
            <td align="right">Email: <?php echo stripslashes($agentData['email']); ?></td>
          </tr>
          <tr>
            <td align="right">GSTIN: <?php echo stripslashes($agentData['gstin']); ?></td>
          </tr>
          <tr>
            <td align="right">Pan No: <?php echo stripslashes($agentData['pan']); ?></td>
          </tr>

        </table></td>
      </tr> 
  <tr>
    <td colspan="3"><hr /></td>
    </tr> 
  <tr>
    <td colspan="3"><table width="100%" border="0" cellpadding="0" style="border:1px solid #ddd;">
      <tr>
        <td width="39%"><div>Invoice no:</div>
		<div style="font-size:13px; font-weight:600;"><?php echo encode($rest['id']); ?></div>		</td>
        <td width="28%"><div>Booking Date:</div>
		<div style="font-size:13px; font-weight:600;"><?php echo date('d M Y, H:i A', strtotime($rest['bookingDate'])); ?></div></td>
        <td width="18%"><div>PNR:</div>
		  <div style="font-size:13px; font-weight:600;"><?php echo stripslashes($rest['pnrNo']); ?></div>		</td>
		  <td width="15%" align="center"><div>Booked By:</div>
		<div style="font-size:13px; font-weight:600;"><?php echo stripslashes($agentData['companyName']); ?></div>
		</td>
        </tr>   
    </table></td>
    </tr> 
<tr>
    <td colspan="3"><table width="100%" border="0" cellpadding="3" cellspacing="0">
      <tr>
        <td colspan="3" style="border-bottom:1px solid #FF6633;">Onward: <span style="font-size:13px; font-weight:600;"><?php echo $rest['source']; ?>-<?php echo $rest['destination']; ?> , <?php echo $rest['flightName']; ?> <?php echo $rest['flightNo']; ?></span></td>
        <td colspan="4" align="right" style="border-bottom:1px solid #FF6633;">Travel Date: <span style="font-size:13px; font-weight:600;"><?php echo date('d M Y', strtotime($rest['journeyDate'])); ?></span></td>
        </tr>
      <tr>
        <td width="31%" align="left" style="border-bottom:1px solid #FF6633;">Name</td>
        <td width="8%" align="center" style="border-bottom:1px solid #FF6633;">Type</td>
        <td width="14%" align="center" style="border-bottom:1px solid #FF6633;">Class</td>
        <td width="13%" align="center" style="border-bottom:1px solid #FF6633;">Basic</td>
        <td width="8%" align="center" style="border-bottom:1px solid #FF6633;">YQ</td>
        <td width="13%" align="center" style="border-bottom:1px solid #FF6633;">Taxes</td>
        <td width="13%" align="center" style="border-bottom:1px solid #FF6633;">Total</td>
      </tr>
      <?php 
		$rs6=GetPageRecord('*','flightBookingPaxDetailMaster',' BookingId="'.$rest['id'].'" and firstName!="" '); 
		$paxData=mysqli_fetch_array($rs6);
	  ?>
      <tr>
            <td align="left" style="border-bottom:1px solid #ddd;"><?php echo $paxData['title']; ?>&nbsp;<?php echo $paxData['firstName']; ?>&nbsp;<?php echo $paxData['lastName']; ?> <?php if(mysqli_num_rows($rs6)>1){ ?>+ <?php echo (mysqli_num_rows($rs6)-1); } ?></td>
            <td align="center" style="border-bottom:1px solid #ddd;"><?php echo ucfirst($paxData['paxType']); ?></td>
            <td align="center" style="border-bottom:1px solid #ddd;"><?php echo ucfirst($rest['flightClass']); ?></td>
            <td align="center" style="border-bottom:1px solid #ddd;"><?php echo number_format($rest['agentBaseFare']); ?></td>
            <td align="center" style="border-bottom:1px solid #ddd;">0</td>
            <td align="center" style="border-bottom:1px solid #ddd;"><?php echo number_format($rest['agentTax']); ?></td>
            <td align="center" style="border-bottom:1px solid #ddd;"><?php echo number_format($rest['agentBaseFare']+($rest['agentTax'])); ?></td>
          </tr> 
        </table></td>
        </tr>   
	<?php 
		$c=GetPageRecord('*','sys_balanceSheet',' bookingId="'.$rest['id'].'" and bookingType="flight_GST"'); 
		$balanceSheetData=mysqli_fetch_array($c);
		 
		$ct=GetPageRecord('*','sys_balanceSheet',' bookingId="'.$rest['id'].'" and bookingType="TDS"'); 
		$balanceSheetDataTDS=mysqli_fetch_array($ct); 
		
		$totalAmt=0;
	  ?>
  <tr>
    <td width="34%">&nbsp;</td>
    <td width="33%">&nbsp;</td>
    <td width="33%" align="right"><table width="100%" border="0" cellpadding="0">
      <tr>
        <td align="right"><strong>Basic Fare</strong></td>
        <td colspan="2" align="right">Rs. <?php echo  $totalfare=(round(($editresult['agentBaseFare']+$editresult['agentFixedMakup']))); ?></td>
        </tr>
      <tr>
        <td align="right"><strong>Taxes </strong></td>
        <td colspan="2" align="right">Rs. <?php echo (round($editresult['agentTax'])); $totalfare+=(round($editresult['agentTax'])); ?></td>
      </tr>
     <?php if($editresult['seatPrice']>0){ ?> <tr>
        <td align="right"><strong>Seat Charges </strong></td>
        <td colspan="2" align="right">Rs. <?php echo ($editresult['seatPrice']); $totalfare+=($editresult['seatPrice']); ?></td>
      </tr>
	  <?php } ?>
	     <?php if($editresult['mealPrice']>0){ ?> 
      <tr>
        <td align="right"><strong>Meal Charges </strong></td>
        <td colspan="2" align="right">Rs. <?php echo ($editresult['mealPrice']); $totalfare+=($editresult['mealPrice']); ?></td>
      </tr>
	    <?php } ?>
		    <?php if($editresult['extraBaggagePrice']>0){ ?> 
      <tr>
        <td align="right"><strong>Extra Baggage Charges </strong></td>
        <td colspan="2" align="right">Rs. <?php echo ($editresult['extraBaggagePrice']); $totalfare+=($editresult['extraBaggagePrice']); ?></td>
      </tr>
	      <?php } ?>
          <tr>
            <td align="right"><strong>Tsbizz Service Fee </strong></td>
            <td colspan="2" align="right">Rs. <?php
			$totaalservicefee=($editresult['agentTotalFare']-$editresult['totalFare']);
			
			 echo (round($totaalservicefee/1.18)); $totalfare+=(round($totaalservicefee/1.18)); ?></td>
          </tr>
          <tr>
            <td align="right"><strong>GST</strong></td>
            <td colspan="2" align="right">Rs. <?php echo ($totaalservicefee-round($totaalservicefee/1.18)); $totalfare+=($totaalservicefee-round($totaalservicefee/1.18)); ?> </td>
          </tr>
          <tr>
        <td align="right"><strong>Total Payable (INR)</strong></td>
        <td colspan="2" align="right">Rs. <?php echo number_format($totalfare); ?></td>
      </tr>
    </table></td>
  </tr> 
  <tr>
    <td colspan="3"><table width="100%" border="0" cellpadding="0">
      <tr>
        <td width="53%">
		<table width="100%" border="0" cellspacing="0" cellpadding="3" style="border:1px solid #ddd;">
  <tr>
    <td><div style=" font-weight:600; text-decoration: underline; padding:10px;">Terms & Condition</div>
		<div  style=" padding:10px;"><?php echo strip_tags(stripslashes($adminData['invoiceTerms'])); ?></div> </td>
  </tr>
</table>		</td>
        <td width="47%" align="center"><div style=" font-weight:600;">For <?php echo strtoupper($adminData['invoiceCompany']); ?>.</div>
		<div>Computer Generated Report, Requires No Signature</div>		</td>
      </tr>
    </table></td>
    </tr>
</table>


</div>
 
 
 
 
<button type="button" class="btn btn-secondary btn-sm" onclick='printDiv();' style="float:right;">Print / Download</button>


<script>
function printDiv() 
{

  var divToPrint=document.getElementById('DivIdToPrint'); 
  var newWin=window.open('','Print-Window'); 
  newWin.document.open(); 
  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>'); 
  newWin.document.close(); 

}
</script>