<?php 
include "inc.php"; 
include "agenturlinc.php";   
?>



<script language="JavaScript" type="text/javascript" src="ckeditor/ckeditor.js"></script> 

<script language="JavaScript" type="text/javascript" src="ckeditor/ckfinder/ckfinder.js"></script>




<?php if($_REQUEST['action']=='importEmployee'){ ?>
 
<form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">	
 
<div class="modal-body">
			
<div class="row"> 
	<div class="col-md-12"> 
		<div class="form-group">
			<label for="validationCustom02">Import Excel File</label>   
			<input type="file" name="importfield" class="form-control" style="padding: 4px;" accept=".xls,.xlsx" />
		</div>
	</div>
</div>   

</div>
 
<div class="modal-footer">  
	<input name="action" type="hidden" id="action" value="importEmployee" />  
	<input name="Save" type="submit" value="Import" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';"  />
</div>

</form>

<?php } ?> 



<?php if($_REQUEST['action']=='viewdetails' && $_REQUEST['id']!=""){ 

$a=GetPageRecord('*','sys_specialDeal',' id="'.decode($_REQUEST['id']).'"'); 

$data=mysqli_fetch_array($a);  ?>

<div class="modal-body">

<img src="<?php echo $imgurl; ?><?php echo $data['image']; ?>" style="width:100%; margin-bottom:20px;">

<h5><?php echo stripslashes($data['title']); ?></h3>

<div style="font-size:13px; line-height:20px; margin-top:10px;"><?php echo nl2br(stripslashes($data['description'])); ?></div>

</div>

<?php } ?>



 <?php if($_REQUEST['action']=='changepassword'){   ?>



<form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

<div class="modal-body">	<div class=" ">  

		<div class="form-group">

			<label>Old Password</label>

			<input name="oldPassword" type="password" min="0" class="form-control" id="oldPassword" value=""    >

		</div>	

		

		<div class="form-group">

			<label>New Password</label>

			<input name="newPassword" type="password" min="0" class="form-control" id="newPassword" value=""    >

		</div>	

		

		<div class="form-group">

			<label>Confirm Password</label>

			<input name="confirmPassword" type="password" min="0" class="form-control" id="confirmPassword" value=""    >

		</div>	     

	</div>

	<input name="action" type="hidden" id="action" value="changePassword">   </div>

	<div class="modal-footer showflightbookingcancelaltion" > 

		<button type="submit" class="btn btn-primary">Save&nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

	</div>

</form>



<?php } ?>





<?php if($_REQUEST['action']=='viewTicket' && $_REQUEST['id']!=''){

  

if($_REQUEST['id']!=''){

$a=GetPageRecord('*','flightBookingMaster',' id="'.decode($_REQUEST['id']).'" '); 

$editresult=mysqli_fetch_array($a); 





}

 ?> 

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 
 

					  

					<div class="" id="loadticket"> 

					<?php echo file_get_contents($fullurl.'download_ticket.php?id='.$_REQUEST['id'].'&ta=1&psid='.$_REQUEST['psid'].'&tp='.$_REQUEST['tp'].''); ?> 

					</div>

					<script>

					

						function loadticket(){

							var ta = $('#ticketaction').val();

							var markup = Number($('#markup').val());

							if(ta!='' ){ 

								if(ta==4){

									$('.addmrkp').show();  

								}else{ 
 
  

									$('#loadticket').load('download_ticket.php?psid=<?php echo $_REQUEST['psid']; ?>&tp=<?php echo $_REQUEST['tp']; ?>&id=<?php echo $_REQUEST['id']; ?>&ta='+ta); 

								} 

							

							} 

						}

					

					function loadticketwithmarkup(){

					

						var ta = $('#ticketaction').val();

						var markup = Number($('#markup').val());

						 

								$('#loadticket').load('download_ticket.php?psid=<?php echo $_REQUEST['psid']; ?>&tp=<?php echo $_REQUEST['tp']; ?>&id=<?php echo $_REQUEST['id']; ?>&ta='+ta+'&markup='+markup); 

							 

					

					}

					

					

					</script>

					 

					 

	 



		<input name="action" type="hidden" id="action" value="ticketsendtomail">  

		<input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>"> 			

		<input name="page" type="hidden" id="page" value="<?php echo $_REQUEST['page']; ?>"> 	

								

    

</form>

<?php } ?>











<?php if($_REQUEST['action']=='viewInvoice' && $_REQUEST['id']!=''){

 

 ?> 

 

					 

					

					  

					<div class="" id="loadticket"> 

					<?php 

					if($_REQUEST['invtype']=='flight'){

					echo file_get_contents($fullurl.'flightInvoice.php?id='.$_REQUEST['id'].'&ag='.$_SESSION['agentUserid'].'');

					}

					if($_REQUEST['invtype']=='hotel'){

					echo file_get_contents($fullurl.'hotelInvoice.php?id='.$_REQUEST['id'].'&ag='.$_SESSION['agentUserid'].'');

					}

					

					 ?> 

					</div>

					  

 

<?php } ?>







 <?php if($_REQUEST['action']=='hotelquery'){   ?>

 

 





<form action="frmaction.html" method="post" target="actoinfrm">

	<div class="modal-body" id="showflightbookingcancelaltion">			

   <div class="row">

	<div class="col-md-6"> 

        <div class="input-box">

			<label class="label-text">First Name <span style="color:red;">*</span></label>

				<div class="form-group"> 

                    <input name="name" type="text" class="form-control" id="name" placeholder="Type your full name" required="required">

				</div>

		</div></div><!-- end input-box -->

		

			<div class="col-md-6"> 

		<div class="input-box">

			<label class="label-text">Mobile Number <span style="color:red;">*</span></label>

            <div class="form-group"> 

            <input class="form-control" type="text" name="mobile" placeholder="Type your mobile number" required="required">

            </div>

		</div>

		

		 

		

	

	</div>

		<div class="col-md-12">

		

			<div class="input-box">

			<label class="label-text">Email Address <span style="color:red;">*</span></label>

			<div class="form-group"> 

				<input class="form-control" type="text" name="email" placeholder="Type your email" required="required">

			</div>

		</div>

		

			 

			

			 

		<input type="hidden" name="action" value="submithotelenquiry" />				

	 



							<!-- end input-box -->

		</div>

		

		<div class="col-md-12">

		<div class="input-box">

			<label class="label-text">Note <span style="color:red;">*</span></label>

			<div class="form-group"> 

				<textarea name="notes" rows="4" class="form-control" id="notes" placeholder="Type your Note"></textarea>

			</div>

		</div>

		</div>

	</div>

	

	<div class="btn-box pt-12  ">

		<button type="submit" class="btn btn-danger" style="width: 100%;">Submit Enquiry</button>

	</div>

   </div>

   

   

   <div id="showflightbookingcancelaltionthanks" style="display:none;">

  <div style="padding:30px; text-align:center;">

  <div style="text-align:center; font-size:24px; color:#CC3300; margin-bottom:10px;">Thank You!</div>

  <div style="text-align:center; font-size:14px; margin-bottom:10px;">One of our team will be in contact with you shortly.</div>

  

  </div>

  </div>

   <input type="hidden" name="hotelName" value="<?php echo $_REQUEST['hotelname']; ?>" />

   <input type="hidden" name="roomName" value="<?php echo $_REQUEST['name']; ?>" />

   <input type="hidden" name="room" value="<?php echo $_REQUEST['room']; ?>" />

   <input type="hidden" name="adult" value="<?php echo $_REQUEST['adult']; ?>" />

   <input type="hidden" name="child" value="<?php echo $_REQUEST['child']; ?>" />

   <input type="hidden" name="startdate" value="<?php echo $_REQUEST['startdate']; ?>" />

   <input type="hidden" name="enddate" value="<?php echo $_REQUEST['enddate']; ?>" />

   <input type="hidden" name="city" value="<?php echo $_REQUEST['city']; ?>" />

</form>



<?php } ?>





 <?php if($_REQUEST['action']=='flightCancellationRequest' && $_REQUEST['id']!=''){  

 

 

 if($_REQUEST['id']!=''){ 

$a=GetPageRecord('*','flightBookingMaster',' id="'.decode($_REQUEST['id']).'" '); 

$editresult=mysqli_fetch_array($a); 



$detailArray = json_decode(stripslashes(unserialize($editresult['detailArray'])));



$urs=GetPageRecord('*','sys_userMaster',' id="'.$editresult['agentId'].'" '); 

$agentData=mysqli_fetch_array($urs); 

} 

 

  ?>

  <div id="showflightbookingcancelaltion">

 <div style="font-size:14px; margin-bottom:10px;"><strong>Flight Booking Information</strong></div>

 <table width="100%" border="1" cellpadding="4" cellspacing="0" bordercolor="#ddd">

      <tr>

        <td bgcolor="#486b88" style="background-color:#486b88; color:#fff; font-weight:500;">Type</td>

        <td colspan="2" bgcolor="#486b88" style="background-color:#486b88; color:#fff; font-weight:500;">Passenger&nbsp;Name</td>

        <td bgcolor="#486b88" style="background-color:#486b88; color:#fff; font-weight:500;">PNR</td>

      </tr>

	  <?php 

		$rs6=GetPageRecord('*','flightBookingPaxDetailMaster',' BookingId="'.$editresult['id'].'" and firstName!="" '); 

		while($paxData=mysqli_fetch_array($rs6)){

	  ?>

      <tr>

        <td><?php echo ucfirst($paxData['paxType']); ?></td>

        <td colspan="2"><?php echo $paxData['title']; ?>&nbsp;<?php echo $paxData['firstName']; ?>&nbsp;<?php echo $paxData['lastName']; ?></td>

        <td><?php echo $editresult['pnrNo']; ?></td>

      </tr>

	  <?php } ?>

</table>

 <table width="100%" border="1" cellpadding="4" cellspacing="0" bordercolor="#ddd">

      <tr>

        <td width="20%" style="background-color:#486b88; color:#fff; font-weight:500;">Flight</td>

        <td width="20%" align="right" style="background-color:#486b88; color:#fff; font-weight:500;">Departure</td>

        <td width="20%" style="background-color:#486b88; color:#fff; font-weight:500;">&nbsp;</td>

        <td width="20%" style="background-color:#486b88; color:#fff; font-weight:500;">Arrival</td>

   </tr>

		

		  

      

       

	  

	  <?php 

 

	  if ($detailArray->D_CODE != ''){

	   $countstops=$detailArray->STOP; 

	   $OITerminal=$detailArray->OI; 

	 

	  }

	  

	  

		$j = 0;

		foreach ((array)$detailArray->CON_DETAILS as $layoverFlight){ 

		  if ($layoverFlight->FLIGHT_NAME != ''){

		  

 

		?>  

      <tr>

        <td width="20%"><table border="0">

  <tr>

    <td><img class="img-fluid" src="<?php echo $imgurl.getflightlogo($layoverFlight->FLIGHT_NAME); ?>" style="max-width: 50px !important;" ></td>

    <td>&nbsp;</td>

    <td><?php echo $layoverFlight->FLIGHT_NAME; ?><br />

	<?php echo $layoverFlight->FLIGHT_CODE; ?> - <?php echo $layoverFlight->FLIGHT_NO; ?></td>

  </tr>

</table></td>

        <td width="20%" align="right" valign="middle">

			<div style="font-size: 16px; font-weight: 900; color: #1574c3;"><?php echo $layoverFlight->ORG_NAME; ?></div>  

			<div style="border-bottom: 1px solid #000; border-top: 1px solid #000;width: 150px;"><?php echo $layoverFlight->DEP_TIME; ?> - <?php echo date('D, d M y', strtotime($layoverFlight->DEP_DATE)); ?></div>

			<div>Terminal: <?php echo $editresult['flightTerminal']; ?></div></td>

        <td width="20%" align="center" valign="middle"><div style="font-size:30px;"><i class="fa fa-plane" aria-hidden="true"></i></div>

		<div style="border-bottom: 1px solid #000; width: 60px;"><?php echo makeFlightTime($layoverFlight->DURATION); ?></div>

		<div><strong><?php echo $editresult['flightClass']; ?></strong></div>		</td>

        <td width="20%" valign="middle">

				<div style="font-size: 16px; font-weight: 900; color: #1574c3;"><?php echo $layoverFlight->DES_NAME; ?></div>

				<div style="border-bottom: 1px solid #000; border-top: 1px solid #000;width: 150px;"><?php echo $layoverFlight->ARRV_TIME; ?> - <?php echo date('D, d M y', strtotime($layoverFlight->DEP_DATE)); ?></div>	

				<div>Terminal: <?php  if($countstops>0){ echo $layoverFlight->DES_TRML; } else { echo '(Please check with airline)'; } ?></div>			</td>

   </tr>

		<?php if($layoverFlight->LAYOVER_INFO!=''){ ?>

	  <tr>

        <td colspan="4" align="center" style="background-color: #FFF9EA !important; border: 1px solid #FFECD7 !important; font-size:14px;"><?php echo $layoverFlight->LAYOVER_INFO; ?></td>

   </tr>

		<?php } ?>

      <?php $j++; } } ?>

	  <?php if($j==0){  ?>

	  <tr>

        <td width="20%">

		<table border="0">

  <tr>

    <td><img src="<?php echo $imgurl.getflightlogo($detailArray->F_NAME); ?>" width="32" class="img-fluid" style="max-width: 50px !important;" ></td>

    <td>&nbsp;</td>

    <td><strong><?php echo $editresult['flightName']; ?></strong><br />

	 <?php echo $editresult['flightNo']; ?></td>

  </tr>

</table></td>

        <td width="20%" align="right" valign="middle">

			<div style="font-size: 16px; font-weight: 900; color: #1574c3;"><?php  $fareType=explode('-',$editresult['source']); echo getflightdestination($fareType[1]); ?></div>  

			<div style="border-bottom: 1px solid #000; border-top: 1px solid #000;width: 150px;"><?php echo $editresult['departureTime']; ?>,<?php echo date('D, j M Y', strtotime($editresult['journeyDate'])); ?></div>

			<div>Terminal: <?php echo $editresult['flightTerminal']; ?></div></td>

        <td width="20%" align="center" valign="middle"><div style="font-size:30px;"><i class="fa fa-plane" aria-hidden="true"></i></div>

		<div style="border-bottom: 1px solid #000; width: 60px;"><?php echo makeFlightTime($detailArray->DUR); ?></div>

		<div><strong><?php echo $editresult['flightClass']; ?></strong></div>		</td>

        <td width="20%" valign="middle">

				<div style="font-size: 16px; font-weight: 900; color: #1574c3;"><?php  $fareType=explode('-',$editresult['destination']);  echo getflightdestination($fareType[1]); ?></div>

				<div style="border-bottom: 1px solid #000; border-top: 1px solid #000;width: 150px;"><?php echo $editresult['arrivalTime']; ?>,<?php echo date('D, j M Y', strtotime($editresult['arrivalDate'])); ?></div>	

				<div>Terminal: <?php  if($countstops>0){ echo $layoverFlight->DES_TRML; } else { echo '(Please check with airline)'; } ?></div>						</td>

   </tr>

		<?php } ?>

</table>

  <table width="100%" border="1" cellpadding="4" cellspacing="0" bordercolor="#ddd">

      <tr>

        <?php if($_REQUEST['ta']!=2){ ?> <td width="89%" align="right" bgcolor="#486b88" style="background-color:#486b88; color:#fff; font-weight:500;">&nbsp;</td>

        <td width="30%" align="right" bgcolor="#486b88" style="background-color:#486b88; color:#fff; font-weight:500;">&nbsp;</td><?php } ?>

      </tr>

      <tr>

        <?php if($_REQUEST['ta']!=2){ ?> <td align="right">Fare: <br>



Fee & Surcharge: <br>

<?php if($editresult['insuranceAmount']>0){ ?><?php echo strip($editresult['insurance']); ?> <br><?php } ?>



<strong>Total Amount:</strong> </td>

        <td width="30%" align="right"> Rs.<?php echo number_format($editresult['clientBaseFare']); $totalAmt+=$editresult['clientBaseFare']; ?><br> 



Rs.<?php echo number_format($editresult['clientTax']+$editresult['clientExtraMarkup']+$_REQUEST['markup']);  $totalAmt+=($editresult['clientTax']+$editresult['clientExtraMarkup']+$_REQUEST['markup']); ?><br>

<?php if($editresult['insuranceAmount']>0){ ?>Rs.<?php echo strip($editresult['insuranceAmount']); ?><br><?php } ?>

<strong>Rs.<?php echo number_format($totalAmt+$editresult['insuranceAmount']); ?></strong> </td>

		<?php } ?>

      </tr>

    </table>

	

	<div style="padding:20px; background-color:#FFFFFF; border:2px solid #CC3300; color:#CC3300; font-size:14px; margin:20px 0px;">

	<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> <strong>Please confirm the following.</strong><br />

    <strong>Warning:</strong> Cancellation - Refund charges may applicable.</div>

	

    <form action="frmaction.html" method="post" target="actoinfrm">

<div class="btn-box pt-12  ">

		<button type="submit" class="btn btn-danger" style="width: 100%;">Confirm</button>

	</div>

   <input type="hidden" name="id" value="<?php echo base64_encode(base64_encode(decode($_REQUEST['id']))); ?>" />

   <input type="hidden" name="action" value="flightcancellation" />

</form>

</div>





  <div id="showflightbookingcancelaltionthanks" style="display:none;">

  <div style="padding:30px; text-align:center;">

  <div style="text-align:center; font-size:24px; color:#CC3300; margin-bottom:10px;">Cancellation Request Submitted Successfully!</div>

  <div style="text-align:center; font-size:14px; margin-bottom:10px;">We will review your request and process asap.</div>

  

  </div>

  </div>



<?php } ?>



 <?php if($_REQUEST['action']=='resetpassword'){ ?>

 

 

 <form action="<?php echo $fullurl; ?>frmaction.html" method="post" target="actoinfrm">

	<div class="modal-body showflightbookingcancelaltion" >			

   <div class="row">

	 <!-- end input-box -->

		

			 

		<div class="col-md-12">

		

			<div class="input-box">

			<label class="label-text" style="margin-bottom:5px;">Enter your registered email address <span style="color:red;">*</span></label>

			<div class="form-group"> 

				<input class="form-control" type="email" name="email" placeholder="Type your email" required="required">

			</div>

		</div> 

			 

		<input type="hidden" name="action" value="submithotelenquiry" />	 

		</div>

		

		 

	</div>

   </div>

	 <div class="modal-footer showflightbookingcancelaltion"> 

		<button type="submit" class="btn btn-danger" style="width: 120px;">Submit</button> 

	 </div>



  

   

   

   <div id="showflightbookingcancelaltionthanks" style="display:none;">

  <div style="padding:30px; text-align:center;">

  <div style="text-align:center; font-size:24px; color:#CC3300; margin-bottom:10px;">Password Recovery </div>

  <div style="text-align:center; font-size:14px; margin-bottom:10px;">Password reset successfully and sent to your email address.</div>

  

  </div>

  </div>

   <input type="hidden" name="action" value="resetpassword" />

 

</form>

 <?php } ?>

 

 

 <?php if($_REQUEST['action']=='viewHotelVoucher' && $_REQUEST['id']!=''){ 

 

 $id=base64_encode(($_REQUEST['i']));

 $_REQUEST['i']=$id;

 

  

 

 

 ?>

 <?php if($LoginUserDetails['userType']=='agent'){ ?>

 <div class="row">

					

					<div class="col-md-3">

						<div class="form-group"> 

							<select name="ticketaction" id="ticketaction" class="form-control" onchange="loadticket();" style="margin-bottom: 10px; font-size: 13px; margin-top: 5px;margin-bottom: 0px;-webkit-appearance: listbox !important"> 

								<option value="1">With Fare Voucher</option>

								<option value="2">Without Fare Voucher</option>  

								<option value="3">Without Company Info.</option>  

								<option value="4">Add Markup</option>

							</select>

						</div>

						

						<script>

					

						function loadticket(){

							var ta = $('#ticketaction').val();

							var markup = Number($('#markup').val());

						  $('.withoutfare').show();

									$('.hcompanyinfo').show();  

							if(ta!='' ){ 

								if(ta==2){

									$('.withoutfare').hide();  

								} 

								

								if(ta==3){

									$('.hcompanyinfo').hide();  

								} 

							

							} 

						}

					

					function loadticketwithmarkup(){

					

						var ta = Number($('#htotalamount').val());

						var markup = Number($('#markup').val());

						

						 

							$('#displayhtotalamount').text(Number(ta+markup));	

					

					

					}

					

					

					</script>

					</div> 

					<div class="col-md-2 addmrkp" style="display:none;">

						<div class="form-group " > 

							<input name="markup" type="number" placeholder="Markup" min="0" class="form-control" id="markup" value="0"  style="margin-bottom: 10px; font-size: 13px; margin-top: 5px;margin-bottom: 0px;">

						</div> 

					</div> 

					

					<div class="col-md-3 tomail" style="display:none;"> 

						<div class="form-group ">

							<label>To Mail</label> 

							<input name="to" type="text" min="0" class="form-control" id="to" value="">

						</div>

					</div>

					<div class="col-md-3 addmrkp" style="display:none;">

						<button type="button" class="btn btn-primary"  onclick="loadticketwithmarkup();" style="padding: 5px 10px; margin-top:0px !important;">Apply Markup</button> 

					</div>

					 <div class="col-md-4 tomail" style="display:none;"><button type="submit" class="btn btn-primary" style="margin-top: 28px;" >Send to Mail</button></div>   

</div>

					

					<hr />
<?php } ?>
 

<?php  include "hotel-voucher.php"; ?>

  <script>

					

						function loadticket(){

							var ta = $('#ticketaction').val();

							var markup = Number($('#markup').val());

							if(ta!='' ){ 

								if(ta==4 && markup=='0'){

									$('.addmrkp').show();  

								}else{ 

									$('#markup').val('0');

									$('.addmrkp').hide();

									$('#loadticket').load('download_ticket.php?id=<?php echo $_REQUEST['id']; ?>&ta='+ta); 

								} 

							

							} 

						}

					

					function loadticketwithmarkup(){

				

						var ta = Number($('#htotalamount').val());

						var markup = Number($('#markup').val());

					 

						$('#displayhtotalamount').text(Number(ta+markup));

							 

					

					}

					

					

					</script>

 <?php } ?>

 

 

 

 

 

 

 

 

<?php if($_REQUEST['action']=='selectpackage'){ ?>

<div style="padding:10px;">

<input name="searchpackagekeyword" id="searchpackagekeyword" type="text" style="padding:15px; border:1px solid #ddd; font-size:16px; width:100%; box-sizing:border-box;" placeholder="Search Package" onkeyup="loadselectpackages();" />

</div>

<div style="margin-top:10px; max-height:400px; overflow:auto;" id="loadselectpackages">



</div>

<script>

function loadselectpackages(){

var searchpackagekeyword = encodeURI($('#searchpackagekeyword').val());

var packalready = $('#selectedpackageslist').val();

$('#loadselectpackages').load('loadselectpackages.php?searchpackagekeyword='+searchpackagekeyword+'&packalready='+packalready);

}

loadselectpackages();

</script>



<?php } ?>









<?php if($_REQUEST['action']=='changequerystatus' && $_REQUEST['id']!='' && $_REQUEST['status']!='' && $_REQUEST['statusname']!=''){



 



 ?>



 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 



			 <div class="" >  



			 <?php if($_REQUEST['statusname2']=='Cancelled' || $_REQUEST['statusname2']=='Lost'){ ?>



						<div class="form-group">



									<label>Query Closure Reasons<span class="text-danger">*</span></label>



									 <select name="closureReasons" class="form-control" id="closureReasons">



											<?php  



										$rs=GetPageRecord('*','sys_queryClosureReasons','  parentId="'.$LoginUserDetails['parentId'].'" and status=1  order by name asc');



										while($rest=mysqli_fetch_array($rs)){ 



										?> 



									   <option value="<?php echo stripslashes($rest['id']); ?>"><?php echo stripslashes($rest['name']); ?></option>



									   <?php } ?>



						  </select>



			   </div>



			   <?php } ?>



						<div class="form-group">



									<label>Comment</label>



									<textarea name="comment" rows="2" class="form-control" id="comment" placeholder="Write a comment..."></textarea>



			   </div>



						     



						 







								



								



   </div><div class="card-footer text-right"  style="text-align:right;">



								 



								



								<button type="submit" class="btn btn-primary">Change Query Status &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>



								  <input name="action" type="hidden" id="action" value="savechangequerystatus">



							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>">



							    <input name="status" type="hidden" id="status" value="<?php echo $_REQUEST['status']; ?>">



							    <input name="statusname" type="hidden" id="statusname" value="<?php echo $_REQUEST['statusname']; ?>">



				  </div>



</form>



<?php } ?>





<?php if($_REQUEST['action']=='addquerynote' && $_REQUEST['id']!=''){



 



 ?>



 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 



			 <div class=" " >  



			 



						



						<div class="form-group"> 



									<textarea name="comment" rows="2" class="form-control" id="comment" placeholder="Enter Note"></textarea>



			   </div>



						     



						 







								



								



   </div><div class="card-footer text-right" style="text-align:right;" >



								 



								



								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>



								  <input name="action" type="hidden" id="action" value="savequerynote">



							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>"> 



				  </div>



</form>



<?php } ?>

























<?php if($_REQUEST['action']=='editinerary' && $_REQUEST['id']!=''){











$rs5=GetPageRecord('*','quotationMaster',' parentId="'.$_SESSION['agentUserid'].'" and id="'.decode($_REQUEST['id']).'" '); 



$editresult=mysqli_fetch_array($rs5);







$a=GetPageRecord('*','queryMaster',' addBy="'.$_SESSION['agentUserid'].'" and id="'.($editresult['queryId']).'" '); 



$queryData=mysqli_fetch_array($a);



 



 ?>



 



<script>



 $(document).ready(function() {



    $('#destination').select2({dropdownParent: $('.modal'), tags: true, tokenSeparators: [',', ' ']}); 



});



</script>



 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 



		 <div class="modal-body" >	



			<div class="col-md-12">



					<div class="row">



					 <div class="col-md-6">



						<div class="form-group">



									<label>Package Title<span class="text-danger">*</span></label>



									<input name="name" type="text" class="form-control" id="name" value="<?php echo stripslashes($editresult['name']); ?>" maxlength="255">



					   </div> 



				      </div> 



						



						<div class="col-md-6">



						<div class="form-group">



									<label>Package Banner</label>



									<input name="packagebanner" type="file" class="form-control" id="packagebanner" style="padding: 4px;">



					      </div> 



				      </div>







<?php



//Get City Name



$cityName=GetPageRecord('*','cityMaster','  id="'.$editresult['destination'].'" order by name asc');



$cityNameData=mysqli_fetch_array($cityName);



?>



						   <div class="col-md-6">



	<div class="form-group">



		<label>Select Location</label>



		<div style="height:0px; font-size:0px; position:relative;  " id="searchcitylistsfromCity"></div>



			<div class="input-group input-group-lg">  



				<input type="text" class="form-control" requered  onkeyup="getSearchCIty('pickupCitySearchfromCity','pickupCityfromCity','searchcitylistsfromCity');" id="pickupCitySearchfromCity" name="pickupCitySearchfromCity123" value="<?php echo $cityNameData['name']; ?>" autocomplete="nope" >



				<input name="cityName" id="pickupCityfromCity" type="hidden" value="<?php echo stripslashes($editresult['destination']); ?>" autocomplete="nope" />



			</div>



		</div>



</div>















  <div class="col-md-6 d-none">



	<div class="form-group">



		<label>Weekend Getaways</label>



		<div style="height:0px; font-size:0px; position:relative;  " ></div>



			<div class="input-group input-group-lg">  



				 <select name="weekendGatewayLocationId" class="form-control" id="weekendGatewayLocationId">



	<?php  



	$a=GetPageRecord('*','weekendGatewayLocationMaster','  status=1 order by name asc');



	while($locationData=mysqli_fetch_array($a)){







 ?>



	<option value="<?php echo $locationData['id']; ?>" <?php if($locationData['id']==$editresult['weekendGatewayLocationId']){ ?>selected="selected"<?php } ?>><?php echo $locationData['name']; ?></option>



	<?php } ?>



			  </select>



				 



			</div>



		</div>



</div>



						   



						   <?php if($_REQUEST['package']!='detail'){ ?>



						   <div class="col-md-12">



						<div class="form-group">



									<label>Package Itinerary</label>



									 <textarea name="packageItinerary" rows="3" class="form-control" id="packageItinerary" ><?php  echo stripslashes($editresult['packageItinerary']);  ?></textarea>



 <script type="text/javascript"> 



	var editor = CKEDITOR.replace('packageItinerary'); 



	CKFinder.setupCKEditor( editor,'ckeditor/ckfinder/' ) ; 



	</script>



						   </div> 



						   </div>



						   <?php } else {?>



						   



						   



						   



						   



						      



						        <div class="col-md-2" <?php if($queryData['id']==''){ ?>style="display:none;"<?php } ?>>



						<div class="form-group">



									<label>Start Date<span class="text-danger">*</span></label>



									<input name="startDate" type="text" class="form-control" id="startDate" value="<?php echo date('d-m-Y',strtotime($editresult['startDate'])); ?>">



						   </div> 



						   </div>



						   



						   <?php if($queryData['id']==''){ ?>



						     <div class="col-md-6">



						<div class="form-group">



									<label>Package Duration<span class="text-danger">*</span></label>



									<select name="nights" class="form-control" id="nights">



	<?php $n=1; for ($x = 1; $x <= 20; ) { ?>



	<option value="<?php echo ($x-1); ?>" <?php if(($x-1)==$editresult['nights']){ ?>selected="selected"<?php } ?>><?php echo ($x-1); ?> Nights / <?php echo $n; ?> Days</option>



	<?php $n++; $x++;} ?>



						  </select>



									



									 



						   </div> 



						   </div>



						   <?php } else { ?>



						   



						    <div class="col-md-2">



						<div class="form-group">



									<label>End Date<span class="text-danger">*</span></label>



									<input name="endDate" type="text" class="form-control" id="endDate" value="<?php echo date('d-m-Y',strtotime($editresult['endDate'])); ?>">



						   </div> 



						   </div>



						   



						   <?php }  ?>



						   



						   



						   



						   



						   



						   	 <div class="col-md-2" style="display:none;">



						<div class="form-group">



									<label>Adult</label>



									<input name="adult" type="number" min="1" class="form-control" id="adult" readonly="readonly" value="<?php echo stripslashes($queryData['adult']); ?>">



						   </div> 



						   </div>



						   



						    <div class="col-md-1"  style="display:none;">



						<div class="form-group">



									<label>Child121</label>



									<input name="child" type="number" min="0" class="form-control" id="child" readonly="readonly" value="<?php echo stripslashes($queryData['child']); ?>">



						   </div> 



						   </div>



						   



						    <div class="col-md-1"  style="display:none;">



						<div class="form-group">



									<label>Infant</label>



									<input name="infant" type="number" min="0" class="form-control" id="infant" readonly="readonly" value="<?php echo stripslashes($queryData['infant']); ?>">



						   </div> 



						   </div>



						   



					 <div class="col-md-6">



						<div class="form-group">



									<label>Package Theme</label>



									<select name="packageTheme" class="form-control" id="packageTheme">



										<?php  



										$rs=GetPageRecord('*','sys_packageTheme','    status=1  order by name asc');



										while($rest=mysqli_fetch_array($rs)){ 



										?> 



										<option value="<?php echo stripslashes($rest['id']); ?>" <?php if($rest['id']==$editresult['packageTheme']){ ?>selected="selected"<?php } ?>><?php echo stripslashes($rest['name']); ?></option>



										<?php } ?>



						  			</select>



					   </div> 



				      </div>



						   



						   <div class="col-md-6">



						<div class="form-group">



									<label>Show On Website</label>



									<select name="showOnWebsite" class="form-control" id="showOnWebsite">



	 



	<option value="1" <?php if(1==$editresult['showOnWebsite']){ ?>selected="selected"<?php } ?>>Yes</option>



	<option value="0" <?php if(0==$editresult['showOnWebsite']){ ?>selected="selected"<?php } ?>>No</option>



 



						  </select>



						   </div> 



						   </div>



						   



<div class="col-md-12" style="display:none;">



	<div class="form-group">



	<label>Select Location (Multiselect)</label>



	<select class="form-control" multiple="multiple" name="destination[]" id="destination" data-fouc>



	<?php  



		$rs=GetPageRecord('*','sys_destinationMaster','  parentId="'.$LoginUserDetails['parentId'].'" and status=1  order by name asc');



		while($rest=mysqli_fetch_array($rs)){ 



		if(trim($rest['name'])!=''){ 



			$HiddenProducts = explode(',',$editresult['destination']);



		?> 



		<option value="<?php echo stripslashes($rest['id']); ?>" <?php if (in_array($rest['id'], $HiddenProducts)) { ?>selected="selected"<?php } ?>><?php echo stripslashes($rest['name']); ?></option>



	<?php }} ?>



	</select>



</div> 



</div>











<div class="row" style=" width:100%; padding-left:10px; margin-top:10px; margin-bottom:10px;">



							<div class="col-md-2">



							<div class="checkbox checkbox-primary">



							<input type="checkbox" name="flighticon" id="checkbox2" value="1" <?php if(1==$editresult['flighticon']){ ?> checked="checked" <?php } ?> />



							<label for="checkbox2">



							Flight Icon



							</label>



							</div> 



							</div>



							



							<div class="col-md-2">



							<div class="checkbox checkbox-primary">



							<input type="checkbox" name="hotelicon" id="hotelicon" value="1" <?php if(1==$editresult['hotelicon']){ ?> checked="checked" <?php } ?> />



							<label for="hotelicon">



							Hotel Icon



							</label>



							</div> 



							</div>



							



							<div class="col-md-2">



							<div class="checkbox checkbox-primary">



							<input type="checkbox" name="sightseeingicon" id="sightseeingicon" value="1" <?php if(1==$editresult['sightseeingicon']){ ?> checked="checked" <?php } ?> />



							<label for="sightseeingicon">



							Sightseeing Icon



							</label>



							</div> 



							</div>



							



							<div class="col-md-2">



							<div class="checkbox checkbox-primary">



							<input type="checkbox" name="transfericon" id="transfericon" value="1" <?php if(1==$editresult['transfericon']){ ?> checked="checked" <?php } ?> />



							<label for="transfericon">



							Transfer Icon



							</label>



							</div> 



							</div>



							



							<div class="col-md-2">



							<div class="checkbox checkbox-primary">



							<input type="checkbox" name="activityicon" id="activityicon" value="1" <?php if(1==$editresult['activityicon']){ ?> checked="checked" <?php } ?> />



							<label for="activityicon">



							Activity Icon



							</label>



							</div> 



							</div>



							



							<div class="col-md-2">



							<div class="checkbox checkbox-primary">



							<input type="checkbox" name="cruiseicon" id="cruiseicon" value="1" <?php if(1==$editresult['cruiseicon']){ ?> checked="checked" <?php } ?> />



							<label for="cruiseicon">



							Cruise Icon



							</label>



							</div> 



							</div>







				</div>		    



						   



						    



						   



						    



						   



						    



						   



						   <div class="col-md-12">



						<div class="form-group">



									<label>Package Overview</label>



									 <textarea name="packageItinerary" rows="6" class="form-control" id="packageItinerary" placeholder="Write something about package" ><?php  echo stripslashes($editresult['packageItinerary']);  ?></textarea>



 



						   </div> 



						   </div>



						  <script>



















				$( function() {



				$( "#startDate" ).datepicker({ dateFormat: 'dd-mm-yy',minDate: 0, changeMonth: true, changeYear: true, showButtonPanel: true});



				$( "#endDate" ).datepicker({ dateFormat: 'dd-mm-yy',minDate: 0, changeMonth: true, changeYear: true, showButtonPanel: true });



				} );



				</script>



				



						   



						   



						   <?php  } ?>



					</div>



					



		   </div>







								



								



   </div>



				  <div class="card-footer text-right" >



							 	 



								



								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>



<input name="action" type="hidden" id="action" value="<?php if($_REQUEST['package']=='detail'){?>savedetailpackageotitle<?php }else{ ?>savequickpackageotitle<?php } ?>">



							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>"> 



							    <input name="bannerImg" type="hidden" id="bannerImg" value="<?php echo $editresult['bannerImg']; ?>">



								<input name="adult" type="hidden" id="adult" value="1"> 



				  </div>



</form>



<?php } ?>









<?php if($_REQUEST['action']=='editdetailpackageoptionpeice' && $_REQUEST['id']!='' && $_REQUEST['quotationid']!=''){











$rs5=GetPageRecord('*','sys_quickPackageOptions',' parentId="'.$_SESSION['agentUserid'].'" and id="'.decode($_REQUEST['id']).'" '); 



$editresult=mysqli_fetch_array($rs5);















$ab=GetPageRecord('*','sys_branchMaster',' parentId="'.$LoginUserDetails['parentId'].'" and  id="'.$LoginUserDetails['branchId'].'" order by id asc '); 



$branchData=mysqli_fetch_array($ab);



 ?>



 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 



		 <div class="modal-body" >	



			<div class="col-md-12">



					<div class="row">



					



<div class="col-md-6">



	<div class="form-group">



		<label>Per Adult Price</label>



		<input name="perAdult" type="number" class="form-control" id="perAdult" value="<?php echo stripslashes($editresult['perAdult']); ?>">



	</div> 



</div>







<div class="col-md-6">



	<div class="form-group">



		<label>Per Child Price</label>



		<input name="perChild" type="number" class="form-control" id="perChild" value="<?php echo stripslashes($editresult['perChild']); ?>">



	</div> 



</div>







<div class="col-md-6" style="display:none;">



	<div class="form-group">



		<label>Adult Markup</label>



		<input name="quotationAdultMarkup" type="number" class="form-control" id="quotationAdultMarkup" value="0<?php // echo stripslashes($editresult['quotationAdultMarkup']); ?>">



	</div> 



</div>







<div class="col-md-6"  style="display:none;">



	<div class="form-group">



		<label>Child Markup</label>



		<input name="quotationChildMarkup" type="number" class="form-control" id="quotationChildMarkup" value="0<?php // echo stripslashes($editresult['quotationChildMarkup']); ?>">



	</div> 



</div>



					



					



<input type="hidden" id="currencyId" name="currencyId" value="2755">			



						   



						 



					</div>



					



		   </div>







								



								



   </div>



				  <div class="card-footer text-right" >



							<!--<button type="button" class="btn btn-danger" style="float:left;" data-dismiss="modal" onclick="if(confirm('Are you sure you want to delete this option?')) deleteoptions<?php echo $_REQUEST['id']; ?>('<?php echo $_REQUEST['id']; ?>');">Delete &nbsp;<i class="fa fa-trash" aria-hidden="true"></i></button>-->	 



								



								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>



								  <input name="action" type="hidden" id="action" value="savequickpackageoptionpeice">



							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>">



							    <input name="quotationid" type="hidden" id="quotationid" value="<?php echo $_REQUEST['quotationid']; ?>">



				  </div>



</form>



<?php } ?>









<?php if($_REQUEST['action']=='editdaydetails' && $_REQUEST['id']!=''){











$rs5=GetPageRecord('*','packageDays',' parentId="'.$_SESSION['agentUserid'].'" and id="'.decode($_REQUEST['id']).'" '); 



$editresult=mysqli_fetch_array($rs5);







$b=GetPageRecord('*','quotationMaster',' parentId="'.$_SESSION['agentUserid'].'" and id="'.$editresult['quotationId'].'"   '); 



$quotationDetail=mysqli_fetch_array($b);



 



 ?>



 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 



		 <div class="modal-body" >	



			<div class="col-md-12">



					<div class="row">				   



						   



						   



					



					 <div class="col-md-12">



						<div class="form-group">



									<label>Title<span class="text-danger">*</span></label>



									<input name="title" type="text" class="form-control" id="title" value="<?php echo stripslashes($editresult['title']); ?>" maxlength="255">



					   </div> 



				      </div> 



						 



						   <div class="col-md-12">



						<div class="form-group">



									<label>Day Details</label>



									 <textarea name="description" rows="6" class="form-control" id="packageItinerary" ><?php  echo stripslashes($editresult['description']);  ?></textarea>



 



						   </div> 



						   </div>



						    



					</div>



					



		   </div>







								



								



   </div>



				  <div class="card-footer text-right" >



							 	 



								



								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>



								  <input name="action" type="hidden" id="action" value="savedaydetails">



							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>"> 



							    <input name="quotationid" type="hidden" id="quotationid" value="<?php echo $_REQUEST['quotationid']; ?>"> 



							    <input name="daydate" type="hidden" id="daydate" value="<?php echo $_REQUEST['daydate']; ?>"> 



							    <input name="dayid" type="hidden" id="dayid" value="<?php echo $_REQUEST['dayid']; ?>">  



				  </div>



</form>



<?php } ?>

















<?php if($_REQUEST['action']=='editpackageterms' && $_REQUEST['quotationid']!='' && $_REQUEST['id']!=''){







if($_REQUEST['id']!=''){



$rs5=GetPageRecord('*','quotationTerms','   id="'.decode($_REQUEST['id']).'"  and quotationId="'.decode($_REQUEST['quotationid']).'" '); 



$editresult=mysqli_fetch_array($rs5);



 }



 



 ?>



  



 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 



		 <div class="modal-body" >	



			<div class="col-md-12">



					<div class="row">



					<div class="col-md-12">



						<div class="form-group">



									<label>Title<span class="text-danger">*</span></label>



									<input name="termType" type="text"  class="form-control" id="termType"   value="<?php echo stripslashes($editresult['termType']); ?>">



				      </div> 



				      </div> 



			   



						     <div class="col-md-12">



						<div class="form-group">



									<label>Description</label>



 <textarea name="termDescription" rows="3" class="form-control" id="termDescription" ><?php  echo stripslashes($editresult['termDescription']);  ?></textarea>



 <script type="text/javascript"> 



	var editor = CKEDITOR.replace('termDescription'); 



	CKFinder.setupCKEditor( editor,'ckeditor/ckfinder/' ) ; 



	</script>



						   </div> 



						   </div> 



						



					</div>



					



		   </div>







								



								



   </div><div class="card-footer text-right" >



								 



								



								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>



								  <input name="action" type="hidden" id="action" value="saveEventTermDescription">



							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>">



							    <input name="quotationid" type="hidden" id="quotationid" value="<?php echo $_REQUEST['quotationid']; ?>">  



				  </div>



</form>



 



 



  



<?php } ?>









<?php if($_REQUEST['action']=='viewquotation'  && $_REQUEST['id']!=''){







if($_REQUEST['id']!=''){



$rs5=GetPageRecord('*','quotationMaster',' parentId="'.$_SESSION['agentUserid'].'" and id="'.decode($_REQUEST['id']).'"'); 



$quotationInfo=mysqli_fetch_array($rs5);



 }



 



 ?>



<div class="modal-body" >	



			<div class="col-md-12">



					<div class="row">



					  



			   



						  <?php if($quotationInfo['quotationType']=='Quick Package'){ include "quickpackageview.php"; } ?>



						  <?php if($quotationInfo['quotationType']=='Flight'){ include "flightquotationview.php"; } ?>



						  <?php if($quotationInfo['quotationType']=='Sightseeing'){ include "sightseeingquotationview.php"; } ?>



						  <?php if($quotationInfo['quotationType']=='Transport'){ include "transportquotationview.php"; } ?>



						  <?php if($quotationInfo['quotationType']=='Visa'){ include "visaquotationview.php"; } ?>



						  <?php if($quotationInfo['quotationType']=='Miscellaneous'){ include "miscellaneousquotationview.php"; } ?>



						  <?php if($quotationInfo['quotationType']=='Hotel'){ include "hotelquotationview.php"; } ?>



						  <?php if($quotationInfo['quotationType']=='Detailed Package'){ include "detailedpackageview.php"; } ?>



						



					</div>



					



  </div>







								



								



</div>



  



 



 



  



<?php } 



if($_REQUEST['action']=='addcustomer' ){

	if($_REQUEST['id']!=''){
	$rs5=GetPageRecord('*','clientMaster','   id="'.decode($_REQUEST['id']).'"  and agentId="'.$_SESSION['agentUserid'].'" ');  
	$editresult=mysqli_fetch_array($rs5);
} 
	
?>

 <form action="<?php echo $fullurl; ?>frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 
	<div class="modal-body">
		<div class="row">
			
				<div class="col-md-2">
					<div class="form-group">
						<label>Title<span class="text-danger">*</span></label>
						<select name="nameHead" class="form-control">
							<option value="Mr" <?php if('Mr'==$editresult['nameHead']){ ?>selected="selected"<?php } ?>>Mr</option>
							<option value="Ms" <?php if('Ms'==$editresult['nameHead']){ ?>selected="selected"<?php } ?>>Ms</option> 
							<option value="Mrs" <?php if('Mrs'==$editresult['nameHead']){ ?>selected="selected"<?php } ?>>Mrs</option>
							<option value="Mstr" <?php if('Mstr'==$editresult['nameHead']){ ?>selected="selected"<?php } ?>>Mstr</option>
							<option value="Miss" <?php if('Miss'==$editresult['nameHead']){ ?>selected="selected"<?php } ?>>Miss</option> 
						</select>
					</div> 
			    </div>
				<div class="col-md-6">
					<div class="form-group">
						<label>First Name<span class="text-danger">*</span></label>
						<input name="name" type="text" class="form-control" value="<?php echo stripslashes($editresult['name']); ?>">
					</div> 
				</div> 
			
			<div class="col-md-4">
				<div class="form-group">
					<label>Last Name<span class="text-danger">*</span></label>
					<input name="lastName" type="text" class="form-control" value="<?php echo stripslashes($editresult['lastName']); ?>">
				</div> 
			</div> 
			<div class="col-md-6">
				<div class="form-group">
					<label>Email<span class="text-danger">*</span></label>
					<input name="email" type="email" class="form-control" value="<?php echo stripslashes($editresult['email']); ?>">
				</div> 
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Phone<span class="text-danger">*</span></label>
					<input name="phone" type="number" pattern="[0-9]+" class="form-control" value="<?php echo stripslashes($editresult['phone']); ?>">
				</div>
				</div> 
			<div class="col-md-6">
				<div class="form-group">
					<label>Department<span class="text-danger">*</span></label>
					<input name="department" type="text" class="form-control" value="<?php echo stripslashes($editresult['department']); ?>">
				</div> 
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Designation<span class="text-danger">*</span></label>
					<input name="designation" type="text" class="form-control" value="<?php echo stripslashes($editresult['designation']); ?>">
				</div>
				</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Emp-ID</label>
					<input name="empid" type="text" class="form-control" value="<?php echo stripslashes($editresult['empid']); ?>">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Gender</label>
					<select name="gender" class="form-control" id="gender">
						<option value="Male" <?php if('Male'==$editresult['gender']){ ?>selected="selected"<?php } ?>>Male</option>
						<option value="Female" <?php if('Female'==$editresult['gender']){ ?>selected="selected"<?php } ?>>Female</option>
					</select>
				</div> 
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Date of Birth</label>
					<input name="dob" type="date" class="form-control" value="<?php if(date('Y',strtotime($editresult['dob']))>'1930'){ echo date('Y-m-d',strtotime($editresult['dob'])); } else { echo date('Y/m/d'); } ?>">
				</div> 
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>meal</label>
					<select name="meal" class="form-control" id="meal">
						<option value="Veg" <?php if('Veg'==$editresult['meal']){ ?>selected="selected"<?php } ?>>Veg</option>
						<option value="Non-Veg" <?php if('Non-Veg'==$editresult['meal']){ ?>selected="selected"<?php } ?>>Non-veg</option>
					</select>
				</div> 
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Passport No.</label>
					<input name="passportNo" type="text" class="form-control" value="<?php echo stripslashes($editresult['passportNo']); ?>">
				</div>
				</div> 
			<div class="col-md-6">
				<div class="form-group">
					<label>Passport Expiry</label>
					<input name="passportExpiry" type="date" class="form-control" value="<?php if(date('Y',strtotime($editresult['passportExpiry']))>'1970'){ echo date('Y-m-d',strtotime($editresult['passportExpiry'])); } else { echo date('Y/m/d'); } ?>">
				</div>
				</div>
			
			</div>
		</div>
	</div>
	<div class="card-footer text-right" style="margin-top:0px; padding:20px; padding-top:0px;">
		<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>
		<input name="action" type="hidden" id="action" value="saveaddcustomer">
		<input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>">
	</div>
</form>

<?php } ?>













<?php if($_REQUEST['action']=='addcustomer_bkp' ){



	if($_REQUEST['id']!=''){

	$rs5=GetPageRecord('*','flightBookingPaxDetailMaster','   id="'.decode($_REQUEST['id']).'"    and BookingId in(select id from flightBookingMaster where agentId="'.$_SESSION['agentUserid'].'")  ');  

	$editresult=mysqli_fetch_array($rs5);

	} 

	

 ?>



 <form action="<?php echo $fullurl; ?>frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 



		 <div class="modal-body" >	



			<div class="col-md-12">



					<div class="row">

<div class="col-md-4">



						<div class="form-group">



									<label>Title<span class="text-danger">*</span></label>

 <select name="nameHead" class="form-control" >



	 



	<option value="Mr" <?php if('Mr'==$editresult['title']){ ?>selected="selected"<?php } ?>>Mr</option>

	<option value="Ms" <?php if('Ms'==$editresult['title']){ ?>selected="selected"<?php } ?>>Ms</option> 

	<option value="Mrs" <?php if('Mrs'==$editresult['title']){ ?>selected="selected"<?php } ?>>Mrs</option>

	<option value="Mstr" <?php if('Mstr'==$editresult['title']){ ?>selected="selected"<?php } ?>>Mstr</option>

	<option value="Miss" <?php if('Miss'==$editresult['title']){ ?>selected="selected"<?php } ?>>Miss</option> 

 



						  </select>



				      </div> 



				      </div>

					<div class="col-md-8">



						<div class="form-group">



									<label>First Name<span class="text-danger">*</span></label>



									<input name="name" type="text"  class="form-control"     value="<?php echo stripslashes($editresult['firstName']); ?>">



				      </div> 



				      </div> 

					  

				<div class="col-md-6">



						<div class="form-group">



									<label>Last Name<span class="text-danger">*</span></label>



									<input name="lastName" type="text"  class="form-control"  value="<?php echo stripslashes($editresult['lastName']); ?>">



				      </div> 



				      </div>

					  

					  <div class="col-md-6" style="display:none;">



						<div class="form-group">



									<label>Gender</label>



									<select name="gender" class="form-control" id="gender">



	 



	<option value="Male" <?php if('Male'==$editresult['gender']){ ?>selected="selected"<?php } ?>>Male</option>



	<option value="Female" <?php if('Female'==$editresult['gender']){ ?>selected="selected"<?php } ?>>Female</option>



 



						  </select>



				      </div> 



				      </div>

			   



						       <div class="col-md-6">



						<div class="form-group">



									<label>Date of Birth </label>



									 		<input name="dob" type="date"  class="form-control"  value="<?php if(date('Y',strtotime($editresult['dob']))>'1970'){ echo date('Y-m-d',strtotime($editresult['dob'])); } else { echo date('Y/m/d'); } ?>">



				      </div> 



				      </div>

					  

					  <div class="col-md-6">



						<div class="form-group">



									<label>Passport </label>



									 		<input name="passportNumber" type="text"  class="form-control"  value="<?php echo stripslashes($editresult['passportNumber']); ?>">



				      </div> 



				      </div>



						

<div class="col-md-6">



						<div class="form-group">



									<label>Passport Expiry </label>



									 		<input name="passportExpiry" type="date"  class="form-control"  value="<?php if(date('Y',strtotime($editresult['passportExpiry']))>'1970'){ echo date('Y-m-d',strtotime($editresult['passportExpiry'])); } else { echo date('Y/m/d'); } ?>">



				      </div> 



				      </div>

					</div>



					



		   </div>







								



								



   </div><div class="modal-footer showflightbookingcancelaltion" >



								 



								



								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>



								  <input name="action" type="hidden" id="action" value="saveaddcustomer">



							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>">

 



				  </div>



</form>



  

<?php } ?>



<?php if($_REQUEST['action']=='importcustomertobooking' ){  ?>

<div style="padding:4px 10px; background-color:#fff;">

<table border="0" cellpadding="5" cellspacing="0">

  <tr>

    <td colspan="2">Please select according to order <strong style="color:#0066CC;">1st Adult (All) </strong>, <strong style="color:#CC3300;">2nd Child (All) </strong>, <strong  style="color:#FF9900;">3rd Infant (All)</strong></td>

    </tr>

  <tr>

    <td>Search</td>

    <td> 

      <input type="text" name="textfield" style="padding:5px 10px; background-color:#FFFFFF; border:1px solid #ddd; width:300px;" placeholder="Enter Keyword" id="loadimportcustomersearch" onkeyup="loadimportcustomers();" /> </td>

  </tr>

</table>



</div>

<div style="width:100%; max-height:400px; overflow:auto;" id="loadimportcustomers">



</div>



<script>

function loadimportcustomers(){

var loadimportcustomersearch = encodeURI($('#loadimportcustomersearch').val());

$('#loadimportcustomers').load('loadimportcustomers.php?keyword='+loadimportcustomersearch);

}



loadimportcustomers();

</script>



<?php } ?>













 <?php if($_REQUEST['action']=='viewbusVoucher' && $_REQUEST['i']!=''){ 

 

 $id=base64_encode(($_REQUEST['i']));

 $_REQUEST['i']=$id;

 

  

 

 

 ?>

 

 <div class="row">

					

					<div class="col-md-3">

						<div class="form-group"> 

							<select name="ticketaction" id="ticketaction" class="form-control" onchange="loadticket();" style="margin-bottom: 10px; font-size: 13px; margin-top: 5px;margin-bottom: 0px;-webkit-appearance: listbox !important"> 

								<option value="1">With Fare Voucher</option>

								<option value="2">Without Fare Voucher</option>  

								<option value="3">Without Company Info.</option>  

								<option value="4">Add Markup</option>

							</select>

						</div>

						

						<script>

					

						function loadticket(){

							var ta = $('#ticketaction').val();

							var markup = Number($('#markup').val());

						  $('.withoutfare').show();

									$('.hcompanyinfo').show();  

							if(ta!='' ){ 

								if(ta==2){

									$('.withoutfare').hide();  

								} 

								

								if(ta==3){

									$('.hcompanyinfo').hide();  

								} 

							

							} 

						}

					

					function loadticketwithmarkup(){

					

						var ta = Number($('#htotalamount').val());

						var markup = Number($('#markup').val());

						

						 

							$('#displayhtotalamount').text(Number(ta+markup));	

					

					

					}

					

					

					</script>

					</div> 

					<div class="col-md-2 addmrkp" style="display:none;">

						<div class="form-group " > 

							<input name="markup" type="number" placeholder="Markup" min="0" class="form-control" id="markup" value="0"  style="margin-bottom: 10px; font-size: 13px; margin-top: 5px;margin-bottom: 0px;">

						</div> 

					</div> 

					

					<div class="col-md-3 tomail" style="display:none;"> 

						<div class="form-group ">

							<label>To Mail</label> 

							<input name="to" type="text" min="0" class="form-control" id="to" value="">

						</div>

					</div>

					<div class="col-md-3 addmrkp" style="display:none;">

						<button type="button" class="btn btn-primary"  onclick="loadticketwithmarkup();" style="padding: 5px 10px; margin-top: 5px;">Apply Markup</button> 

					</div>

					 <div class="col-md-4 tomail" style="display:none;"><button type="submit" class="btn btn-primary" style="margin-top: 28px;" >Send to Mail</button></div>   

</div>

					

					<hr />

 

<?php  include "bus-ticket.php"; ?>

  <script>

					

						function loadticket(){

							var ta = $('#ticketaction').val();

							var markup = Number($('#markup').val());

							if(ta!='' ){ 

								if(ta==4 && markup=='0'){

									$('.addmrkp').show();  

								}else{ 

									$('#markup').val('0');

									$('.addmrkp').hide();

									$('#loadticket').load('download_ticket.php?id=<?php echo $_REQUEST['id']; ?>&ta='+ta); 

								} 

							

							} 

						}

					

					function loadticketwithmarkup(){

				

						var ta = Number($('#htotalamount').val());

						var markup = Number($('#markup').val());

					 

						$('#displayhtotalamount').text(Number(ta+markup));

							 

					

					}

					

					

					</script>

 <?php } ?>

 

 

 

 <?php if($_REQUEST['action']=='stoptooltip' && $_REQUEST['id']!=''){

 $a=GetPageRecord('*','wig_flight_json_bkp',' agentId="'.$_SESSION['agentUserid'].'" and id="'.$_REQUEST['id'].'" ');

$res=mysqli_fetch_array($a);



$dd=unserialize(stripslashes($res['searchJson']));

$n=1;

foreach((array) $dd['sI'] as $layoverFlight){  ?>

  <div><?php echo stripslashes($layoverFlight['fD']['aI']['code']); ?>-<?php echo stripslashes($layoverFlight['fD']['fN']); ?> - <?php echo stripslashes($layoverFlight['da']['code']); ?> (<?php echo date('H:i',strtotime($layoverFlight['dt'])); ?>) &nbsp;<i class="fa fa-arrow-right" aria-hidden="true"></i> &nbsp;<?php echo stripslashes($layoverFlight['aa']['code']); ?> (<?php echo date('H:i',strtotime($layoverFlight['at'])); ?>)<?php if($n==1){ ?>, Dept. <?php echo stripslashes($layoverFlight['da']['terminal']); } ?></div>

  <?php $n++; } ?>

 

 

 <?php } ?>

 

 

 

 <?php if($_REQUEST['action']=='addflightbookingnote' && $_REQUEST['id']!=''){

 

	

 ?>



 <form action="<?php echo $fullurl; ?>frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 



 



			<div class="col-md-12">



					<div class="row">

 	  

					<div class="col-md-12">

					

					<div class="modal-body">



						<div class="form-group">



									<label>Note<span class="text-danger">*</span></label>



									<textarea name="details" rows="5" class="form-control" id="details"></textarea>



				      </div> 



				      </div> 

				      </div> 

					   

						

 

					</div>



					



		   </div>



 



	 <div class="modal-footer showflightbookingcancelaltion"> 



								 



								



								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>



								  <input name="action" type="hidden" id="action" value="addflightbookingnote"> 

								  <input name="bookingid" type="hidden" id="bookingid" value="<?php echo $_REQUEST['id']; ?>">

 



   </div>



</form>



  

<?php } ?>





<?php if($_REQUEST['action']=='addflightbookingamendments' && $_REQUEST['id']!=''){

 

	

 ?>



 <form action="<?php echo $fullurl; ?>flight-booking-amendments" method="get" enctype="multipart/form-data" name="addeditfrm"  id="addeditfrm"> 



 



			<div class="col-md-12">



					

					<div class="modal-body">

 	  <div class="row">

					<div class="col-md-6">



						<div class="form-group">



									<label>Booking Id <span class="text-danger">*</span></label>



									<input name="id" type="text" class="form-control" id="bookingid" value="<?php echo $_REQUEST['id']; ?>" readonly=""  />



				      </div> 



        </div> 

					   <div class="col-md-6">



						<div class="form-group">



									<label>Amendment Type <span class="text-danger">*</span></label>

 <select name="amendmentType" id="amendmentType" class="form-control"  style="font-size: 13px; margin-top: 0px; margin-bottom: 0px; padding: 8px; -webkit-appearance: listbox !important;"> 

 	<option value="">Select</option>

								<option value="Ssr">Ssr</option>

								<option value="Cancellation Quotation">Cancellation Quotation</option>  

								<option value="Cancellation">Cancellation</option>  

								<option value="Full Refund">Full Refund</option>

								<option value="Reissue Quotation">Reissue Quotation</option>

								<option value="Re-Issue">Re-Issue</option>

								<option value="Miscellaneous">Miscellaneous</option>

								<option value="No Show">No Show</option>

								<option value="Void">Void</option>

								<option value="Correction">Correction</option>

								<option value="Custom">Custom</option> 

						  </select>



				      </div> 



				      </div>

						

 

					</div>

					</div>



					



		   </div>



 





	 <div class="modal-footer showflightbookingcancelaltion"> 

								



								<button type="submit" class="btn btn-primary">Raise</button>

 

 



   </div>



</form>



  

<?php } ?>







<?php 

	if($_REQUEST['action']=='addpaymentrequest' ){

?>



<form action="<?php echo $fullurl; ?>frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

	<div class="modal-body" >	

		<div class="col-md-12">

			<div class="row">

				<div class="col-md-8">

					<div class="form-group">

						<label>Requested Amount<span class="text-danger">*</span></label>

						<input name="requestedAmount" type="number" class="form-control" value="0" required>

					</div>

				</div>

				

				<div class="col-md-4">

					<div class="form-group">

						<label>Payment Mode<span class="text-danger">*</span></label>

							<select name="paymentMode" class="form-control" >

								<option value="Cash">Cash</option>

								<option value="Cheque">Cheque</option>

								<option value="NEFT">NEFT</option>

								<option value="DD">DD</option>

								<option value="Credit">Credit</option>

							</select>

					</div>

				</div>

				 



				<div class="col-md-6">

					<div class="form-group">

						<label>Reference Number<span class="text-danger">*</span></label>

						<input name="referenceNumber" type="text"  class="form-control"  value="" required="">

					</div> 

				</div>

				

				<div class="col-md-6">

					<div class="form-group">

						<label>Attachment</label>

						<input name="attachment" type="file">

					</div> 

				</div>



				<div class="col-md-6">

					<div class="form-group">

						<label>Cheque Number<span class="text-danger">*</span></label>

						<input name="chequeNumber" type="text"  class="form-control"  value="" required="">

					</div> 

				</div>

				

				<div class="col-md-6">

					<div class="form-group">

						<label>Date<span class="text-danger">*</span></label>

						<input name="chequeDate" type="date"  class="form-control"  value="" required="">

					</div> 

				</div>



				<div class="col-md-6">

					<div class="form-group">

						<label>Bank<span class="text-danger">*</span></label>

						<input name="bank" type="text"  class="form-control"  value="" required="">

					</div> 

				</div>

				

				<div class="col-md-6">

					<div class="form-group">

						<label>Branch<span class="text-danger">*</span></label>

						<input name="branch" type="text"  class="form-control"  value="" required="">

					</div> 

				</div>



				<div class="col-md-12">

					<div class="form-group">

						<label>Our Bank Account<span class="text-danger">*</span></label>

						<input name="account_number" type="text" placeholder="50200068661036"  class="form-control"  value="" required="" style="font-size:12px;">

					</div> 

				</div>



				

				<div class="col-md-12">

					<div class="form-group">

						<label>Bank Transaction ID<span class="text-danger">*</span></label>

						<input name="bank_transaction_id" type="text"  class="form-control"  value="" required="">

					</div> 

				</div>



				<div class="col-md-12">

					<div class="form-group">

						<label>Remark </label>

						<textarea name="note" type="text"  class="form-control"></textarea>

					</div>

				</div>

			</div>

		</div>



  </div><div class="modal-footer showflightbookingcancelaltion"  >



		<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

		

		<input name="action" type="hidden" id="action" value="addpaymentrequest">

	</div>

</form>

<?php } ?>




<?php 

	if($_REQUEST['action']=='selectbusseat' && $_REQUEST['i']>0 ){
	
	
	function d($dep) {
    return implode('@@', array_keys(array_flip(explode('@@', $dep))));
}
	
	
$a=GetPageRecord('*','manual_busAssigned','id="'.decode($_REQUEST['i']).'"');  
$busdata=mysqli_fetch_array($a);
	 
$abc=GetPageRecord('*','manual_busTrip','id="'.$busdata['tripId'].'"');  
$buspackage=mysqli_fetch_array($abc);

$ab=GetPageRecord('*','manual_busMaster','id="'.$busdata['busId'].'"');  
$busname=mysqli_fetch_array($ab);

$ac=GetPageRecord('*','manual_busFleetType',' id="'.$buspackage['fleetId'].'"');  
$fleetname=mysqli_fetch_array($ac);
			
		 
$ad=GetPageRecord('*','manual_busSeatLayout','id="'.$fleetname['seatId'].'" ');  
$seatlaout=mysqli_fetch_array($ad);
 
$ae=GetPageRecord('*','manual_busSchedule',' id="'.$buspackage['scheduleId'].'" ');  
$sheduledata=mysqli_fetch_array($ae);


$aec=GetPageRecord('*','manual_busTicketPrice',' fleetId="'.$buspackage['fleetId'].'" and routeId="'.$buspackage['routeId'].'" ');  
$pricedata=mysqli_fetch_array($aec);


$seatsused=0;
$sleeperused=0;

?>



<form action="<?php echo $fullurl; ?>bus_booking_review" method="get" enctype="multipart/form-data" name="addeditfrm"  > 

<script>
function sumbuscost(){
var totalseats = $('#totalseats').val();
var totalsleeper = $('#totalsleeper').val();

<?php
$fares =$pricedata['price'];										
$agentMarkup=0;	
$adminMarkup=0;										
if($AgentWebsiteData['busMarkupType']=='flat')
{
	$agentMarkup=$AgentWebsiteData['busMarkupValue'];
	
}	

if($AgentWebsiteData['busMarkupType']=='percentage')
{
	$agentMarkup=round(($AgentWebsiteData['busMarkupValue']*$fares/100));
	 
}


if($adminWebsiteData['busMarkupType']=='flat')
{
	$adminMarkup=$adminWebsiteData['busMarkupValue'];
	
}	

if($adminWebsiteData['busMarkupType']=='percentage')
{
	 $adminMarkup=round((($adminWebsiteData['busMarkupValue']*$fares)/100));
	
}	

$adminAgentMarkup=($adminMarkup+$agentMarkup);

?>


var totalseatonlyprice = <?php echo round($pricedata['price']+$adminAgentMarkup); ?>;

<?php
$fares =$pricedata['sleeperPrice'];										
$agentMarkup=0;	
$adminMarkup=0;										
if($AgentWebsiteData['busMarkupType']=='flat')
{
	$agentMarkup=$AgentWebsiteData['busMarkupValue'];
	
}	

if($AgentWebsiteData['busMarkupType']=='percentage')
{
	$agentMarkup=round(($AgentWebsiteData['busMarkupValue']*$fares/100));
	 
}


if($adminWebsiteData['busMarkupType']=='flat')
{
	$adminMarkup=$adminWebsiteData['busMarkupValue'];
	
}	

if($adminWebsiteData['busMarkupType']=='percentage')
{
	 $adminMarkup=round((($adminWebsiteData['busMarkupValue']*$fares)/100));
	
}	

$adminAgentMarkup=($adminMarkup+$agentMarkup);

?>

 
var totalsleeperonlyprice = <?php echo round($pricedata['sleeperPrice']+$adminAgentMarkup); ?>;


totalsleeperonlyprice = (totalsleeperonlyprice*totalsleeper);
totalseatonlyprice = (totalseatonlyprice*totalseats);

$('#totalsumcostbus').text(Number(totalsleeperonlyprice+totalseatonlyprice));
$('#tp').val(Number(totalsleeperonlyprice+totalseatonlyprice));
}
</script>


	<div class="modal-body" >	

		<div class="col-md-12">

			<div class="row">
 
				<div class="col-md-6"  style=" display:none; <?php if($sleeperused<$fleetname['seatofDeck']){ ?> display:block;<?php } ?>">

					<div class="form-group">

						<label>Seats<span class="text-danger"> &nbsp;(<?php echo round($pricedata['price']+$adminAgentMarkup);?> INR)</span></label>

			<select name="totalseats" id="totalseats" class="form-control" onchange="sumbuscost();" >  
			<option value="">Select</option> 
			<?php 
			for ($k = 1 ; $k < $fleetname['seatofDeck']+1; $k++){
			?>
			<option value="<?php echo $k; ?>"><?php echo $k; ?></option> 
			<?php } ?>
			</select>

					</div>

				</div>

		 
				
				

				<div class="col-md-6" style=" display:none; <?php if($sleeperused<$fleetname['noofDeck']){ ?> display:block;<?php } ?>">

					<div class="form-group">

						<label>Sleeper<span class="text-danger">&nbsp; (<?php echo round($pricedata['sleeperPrice']+$adminAgentMarkup);?> INR)</span></label>

			<select name="totalsleeper" id="totalsleeper" class="form-control"  onchange="sumbuscost();">  
			<option value="">Select</option> 
			
			<?php 
			for ($k = 1 ; $k < $fleetname['noofDeck']+1; $k++){
			?>
			<option value="<?php echo $k; ?>"><?php echo $k; ?></option> 
			<?php } ?>
			</select>

					</div>

				</div>

			 
				
				<?php

$boardingpointst=''; 


$droppingpointst='';

$a=GetPageRecord('*','manual_busAssigned','id="'.decode($_REQUEST['i']).'"');  
while($busdata=mysqli_fetch_array($a)){

$abc=GetPageRecord('*','manual_busTrip','id="'.$busdata['tripId'].'"');  
$buspackage=mysqli_fetch_array($abc);
 

 $boardingpoint='';
$droppingpoint='';

  $fromDestination=$buspackage['fromDestination'];
 
$array = explode('##', $fromDestination); //split string into array seperated by ', '
foreach($array as $value) //loop over values
{
   $boardingpoint=str_replace(" "," ",trim($value)).'@@';
 $boardingpointst.=$boardingpoint;
}



$toDestination=$buspackage['toDestination'];

$string = preg_replace('/\.$/', ' ', $toDestination); //Remove dot at end if exists
$array = explode('##', $string); //split string into array seperated by ', '
foreach($array as $value) //loop over values
{
 $droppingpoint=str_replace(" "," ",trim($value)).'@@';
  $droppingpointst.=$droppingpoint;
}



}
?>
				
				<div class="col-md-12">

					<div class="form-group">

						<label>Boarding Point<span class="text-danger">*</span></label>

							<select name="boardingPoint" class="form-control" >
<?php
$dublicbording=''; 
 
$string = preg_replace('/\.$/', ' ', d($boardingpointst)); //Remove dot at end if exists
$array = explode('@@', $string); //split string into array seperated by ', '
foreach($array as $value) //loop over values
{

if($value!=''){
?>
<option value="<?php echo $value; ?>"><?php echo $value; ?></option> 
								<?php  } }  ?>

							</select>

					</div>

				</div>

				 

<div class="col-md-12">

					<div class="form-group">

						<label>Drop Point<span class="text-danger">*</span></label>

							<select name="droppingPoint" class="form-control" >
<?php
$string = preg_replace('/\.$/', ' ', d($droppingpointst)); //Remove dot at end if exists
$array = explode('@@', $string); //split string into array seperated by ', '
foreach($array as $value) //loop over values
{

if($value!=''){
 ?>
<option value="<?php echo $value; ?>"><?php echo $value; ?></option> 
								<?php  } }  ?>

							</select>

					</div>

			  </div>

		 

  
 

				<div class="col-md-12">

					<div class="form-group">

						<label>Remarks </label>

						<input name="Seatprefrence" type="text" class="form-control" value="" />

					</div>

				</div>
				
				
				<div class="col-md-12">

					<div class="form-group">

						<label>Total Price </label>

						<div style="font-size:25px; font-weight:800;"><span id="totalsumcostbus">0</span> INR</div>

					</div>

				</div>

			</div>

		</div>
 
  </div><div class="modal-footer showflightbookingcancelaltion"  > 
		<button type="submit" class="btn btn-primary">Continue &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button> 
		<input name="i" type="hidden" id="i" value="<?php echo $_REQUEST['i']; ?>">
		<input name="tp" type="hidden" id="tp" value="0">

	</div>

</form>

<?php } ?>




<?php 

	if($_REQUEST['action']=='showflightdetails' && $_REQUEST['action']!='' ){

?>



	<div class="modal-body" >	

		<div class="col-md-12"> 

			<?php include "flightdetailsbox.php"; ?> 

	  </div>

</div>

<?php } ?>



 <?php if($_REQUEST['action']=='cancellationPolicy' && $_REQUEST['hotelid']!='' && $_REQUEST['roomid']!=''){

 

 $url = ''.$tripjackhotelurl.'hms/v1/hotel-cancellation-policy';

$bookingNumber = $HotelReviewDataArr->bookingId;

$jsonPost = '{

		"id":"'.$_REQUEST['hotelid'].'",

		"optionId":"'.$_REQUEST['roomid'].'"

}';

 

   $result = getHotelApiData($url,$jsonPost,$hotelApiKey);

$hotelData = json_decode($result);

 

 $values = $hotelData->cancellationPolicy->pd;

		 

		  

		  ?>

 <table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC" style=" font-size:13px; font-weight:600;">

   <tr>

     <td bgcolor="#F4F4F4"><strong>From Date</strong></td>

     <td bgcolor="#F4F4F4"><strong>To Date</strong></td>

     <td bgcolor="#F4F4F4"><strong>Penalty amount</strong></td>

   </tr>

  <?php  foreach($values as $hotelList){ ?>

   <tr>

     <td style="border-bottom: 1px solid #ddd;"><?php echo $hotelList->fdt; ?></td>

     <td style="border-bottom: 1px solid #ddd;"><?php echo $hotelList->tdt; ?></td>

     <td style="border-bottom: 1px solid #ddd;">&#8377;<?php echo $hotelList->am; ?></td>

   </tr>

   <?php } ?>

 

</table>



<div style="margin-top:10px; color:#FF0000; font-size:12px; font-weight:600;"><?php echo $hotelData->cancellationPolicy->scnp; ?></div>

 <?php  } ?>



 <?php
  
 
  if($_REQUEST['action']=='selectseat' && $_REQUEST['seatadult']!=''){
$_REQUEST['dataPassenger']=$_REQUEST['seatadult'];
include "ajax_seat_layout.php";

 } ?>
 
 
 
 <?php if($_REQUEST['action']=='hotelcancellationpolicy' && $_REQUEST['id']!=''){ 

$rstop=GetPageRecord('*','sys_HotelRoomTypeCost',' id="'.decode($_REQUEST['id']).'"');
$hotelPricetop=mysqli_fetch_array($rstop)
?>
<?php if($_REQUEST['c']==2){ ?>
  <div style="padding:10px; color:#000000;">This is Non-Refundable Booking.<br />
    <br />
    100% charges will be applicable if cancelled after <?php echo date('j F Y',strtotime(date('Y-m-d') . "-1 days")); ?>  23:30<br />
  The property makes no refunds for no shows or early checkouts.</div>
 <?php } else { ?>
 <div style="padding:10px; color:#000000;"> 
    Charges will be refundable if cancelled before <?php echo date('j F Y',strtotime($_REQUEST['checkInDate'] . "-".$hotelPricetop['cancellationBeforeDays']." days")); ?>  23:30<br />
  <strong>Note:</strong> Cancellation charges may be applicable.
  
</div>
 
 <?php } ?>

<?php } ?>
 
 
 
 
 
 
 
 <?php if($_REQUEST['action']=='tripjackseat' && $_REQUEST['id']!=''){  
 
 include 'tripjackAPI/APIConstants.php';

include 'tripjackAPI/RestApiCaller.php';
 
 ?>
 
 <style>
 .seatxbox{ text-align: center; padding: 5px 0px; margin-bottom: 8px; background-color: #CCCCCC; border-radius: 4px; font-size:12px; line-height:12px; color:#fff; font-weight:500; cursor:pointer;}
 .seatxbox:hover{background-color:#20bf7a !important;}
 .bookedflightbtn{ background-color:#F00 !important; cursor:inherit !important;}
 .bookedflightbtn:hvoer{ background-color:#F00 !important; cursor:inherit !important;}
 .freeflightbtn{ background-color:#999;}
 </style>
 
 
 <?php
 $postdata='{
  "bookingId": "'.$_REQUEST['id'].'"
}';
 

try 
{ 
 
$restCaller = new RestApiCaller(); 
$flightRes = $restCaller->getTripJackResponse(_APISEAT_, $postdata); 
$result=file_put_contents("tripjackAPIJson/TripjackSeat.json","$flightRes"); 
$search_result = json_decode($flightRes,true); 
}
 
catch(Exception $e) 
{ 
    $errhdng="Technical Error !!"; 
    $errmsg="Sorry Due To Some Technical Issue, Flights Result Are Not Found."; 
    exit; 
}





//print_r($search_result);
 foreach($search_result as $layoverFlight){
  foreach($layoverFlight['tripSeat'] as $uns){
  $uns['sData']['row'];
   $totalcol=$uns['sData']['column'];
  }
}
 
 
 
  ?>
  <div style="background-color: #add6ef; border-radius: 10px; overflow: hidden; padding: 30px;">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="center" valign="top">
	<table width="200" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3" style="padding: 0px; position:relative;"><img src="images/ic_flightSmallFront.1e0e0ad4.png" width="280" />
	
	<div style=" width:100%; text-align:center; position:absolute; bottom:0px;">
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="right"><span style="background-color: #999; border-radius: 4px; width: 10px; height: 10px; display: inline-table; margin-right: 5px;"></span><span style=" border-radius: 4px;height: 16px; display: inline-table; ">Available</span></td>
    <td align="center">&nbsp;&nbsp;&nbsp;</td>
    <td width="50%" align="left"><span style="background-color: #F00; border-radius: 4px; width: 10px; height: 10px; display: inline-table; margin-right: 5px;"></span><span style=" border-radius: 4px;height: 16px; display: inline-table; ">Booked</span></td>
  </tr>
</table>

	</div>
	</td>
    </tr>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF" style="padding: 0px;"><div style=" width: 260px; margin: auto; padding: 0px; overflow: hidden; ">
<?php 

for($i =1; $i<=$totalcol;)
{ ?>

<div style="width:27px; float:left; margin:0px 5px;   padding:0px;">
&nbsp;&nbsp;


<?php
$n=1;
 foreach($search_result as $layoverFlight){
  foreach($layoverFlight['tripSeat'] as $uns){
    foreach($uns['sInfo'] as $seatlist){
	
	if($seatlist['seatPosition']['column']==$i){
 
?>
<div class="seatxbox <?php if($seatlist['isBooked']==1){ echo 'bookedflightbtn'; } else { echo 'freeflightbtn'; }  ?>" <?php if($seatlist['isBooked']!=1){ ?>onclick="getseatdata('<?php echo  $seatlist['code']; ?>','<?php echo  $seatlist['amount']; ?>');"<?php } ?> >
<?php echo  $seatlist['code']; ?>
</div>
<?php
 }
	$n++;}
  }
}
 
 ?>


</div>
 
   
<?php $i++; } ?>

</div></td>
  </tr>
  <tr>
    <td colspan="3" style="padding: 0px;"><img src="images/ic_flightSmallTail.aa15f774.png" width="280" /></td>
  </tr>
</table>

<script>
function getseatdata(seatno,seatprice){ 
$('#showseatno').text(seatno);
$('#showseatprice').text(seatprice);

$('#seatval<?php echo $_REQUEST['adult']; ?>').text(seatno);
$('#seatvalamtTotal<?php echo $_REQUEST['adult']; ?>').text(Number(seatprice));
$('#seatremove<?php echo $_REQUEST['adult']; ?>').show();
 gettotalprice();
}

function gettotalprice(){
var totalseatamountx=0;
$('.seattotalamount').each(function(i, obj) {
   totalseatamountx=Number(totalseatamountx+Number($(obj).text())); 
});
$('#SeatPriceInn').val(totalseatamountx);

allCalCulatedPrice();
}

</script>

 </td>
    <td width="50%" align="center" valign="top"><table border="0" cellpadding="10" cellspacing="0" style="font-size: 14px; padding: 20px; background-color: #fff; border-radius: 10px; margin: auto; margin-top: 40px;  width: 200px; box-shadow: 0px 0px 10px #00000026;">
  <tbody><tr>
    <td colspan="2" style="font-size:20px; font-weight:700;">Selected Seat</td>
    </tr>
  <tr>
    <td>Selected Seat:</td>
    <td><span class="font-weight-medium seatval" id="showseatno"></span></td>
  </tr>
  <tr>
    <td>Seat Fare: (INR)</td>
    <td><span class="font-weight-medium seatvalamt" id="showseatprice"></span></td>
  </tr>
  <tr>
    <td colspan="2"><button class="btn btn-danger btn-block mfp-close close" data-dismiss="modal" aria-label="Close" style="position: relative; color: #fff; background-color: #e52b30; font-size: 18px; font-weight: 700; width:100%;">Continue</button></td>
    </tr>
</tbody></table></td>
  </tr>
</table>

</div>
 
 
 <?php } ?>
 
 
 
 <?php if($_REQUEST['action']=='contactquery' && $_REQUEST['type']!=''){

 

	

 ?>



 <form action="contactaction" method="post" > 



 



			<div class="col-md-12">



					

					<div class="modal-body">

 	  <div class="row">

					<div class="col-md-6"> 

						<div class="form-group"> 
									<label>Booking Ref. <span class="text-danger">*</span></label> 
									<input name="bookingref" type="text" class="form-control" id="bookingid" value="" required=""/> 
				      </div>  
        </div> 

					   <div class="col-md-6"> 

						<div class="form-group"> 
									<label>PNR No. <span class="text-danger">*</span></label> 
									<input name="bookingref" type="text" class="form-control" id="pnr" value=""  required=""/> 
				      </div>  
        </div> 

						<div class="col-md-6"> 

						<div class="form-group"> 
									<label>Your Full Name <span class="text-danger">*</span></label> 
									<input name="firstName" type="text" class="form-control" id="firstName" value="" required="" /> 
				      <input type="hidden" name="action" value="sendcontactformquery"></div>  
        </div>

 <div class="col-md-6"> 

						<div class="form-group"> 
									<label>Email <span class="text-danger">*</span></label> 
									<input type="email" class="form-control" name="email" placeholder="Email Address" required=""> 
				      </div>  
        </div>
<div class="col-md-6"> 

						<div class="form-group"> 
									<label>Phone <span class="text-danger">*</span></label> 
									<input type="number" class="form-control" name="phone" placeholder="Phone Number" required=""> 
				      </div>  
        </div>
		
		<div class="col-md-6"> 

						<div class="form-group"> 
									<label>Type <span class="text-danger">*</span></label> 
									<input type="text" class="form-control" name="msgtype" placeholder="Phone Number" value="<?php echo $_REQUEST['type']; ?>" required="" readonly=""> 
				      </div>  
        </div>
		
		<div class="col-md-12"> 

						<div class="form-group"> 
									<label>Message <span class="text-danger">*</span></label> 
									<textarea class="form-control" name="message" rows="2" placeholder="Message" ></textarea> 
				      </div>  
        </div>
					</div>

					</div>



					



		   </div>



 





	 <div class="modal-footer showflightbookingcancelaltion"> 

								



								<button type="submit" class="btn btn-primary">Submit Request </button>

 

 



   </div>



</form>



  

<?php } ?>



<?php if($_REQUEST['action']=='addagentbranch'){ 


$c=GetPageRecord('*','agentBranch','  id="'.decode($_REQUEST['editid']).'"  order by id desc ');  
$res=mysqli_fetch_array($c);


?>



<form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 



		 <div class="modal-body" >	



				<div class=" " >	



					<div class="col-md-12">



						<div class="row"> 



							<div class="col-md-6">



								<div class="form-group">



									<label>Company Name </label> 



									<input type="text" id="companyName" name="companyName" class="form-control" value="<?php echo stripslashes($res['companyName']); ?>" >	



								</div> 



						   </div> 



							  	<div class="col-md-6">
                                   <div class="form-group">
                                       <label>GST Number</label>
                                    <input type="text" id="gst" name="gst" class="form-control" value="<?php echo stripslashes($res['gst']); ?>">
                                    <span id="gstError" style="color: red; display: none;">State code (First 2 digits) should match with the State entered above,GST must be a 15 digit.</span>
                                      </div>

						   </div> 


						   <div class="col-md-6">
    <div class="form-group">
        <label>Mobile</label>
        <input type="text" id="gstMobile" name="gstMobile" class="form-control" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="<?php echo stripslashes($res['gstMobile']); ?>">
    </div>
</div>


	   <div class="col-md-6"> 
			<div class="form-group"> 
				<label>Email</label>  
				<input type="email" id="gstEmail" name="gstEmail" class="form-control"  value="<?php echo stripslashes($res['gstEmail']); ?>" >	 
			</div>  
	   </div> 
	   
	<div class="col-md-6">
    <div class="form-group">
        <label>State</label>
        <select name="state" id="state" class="form-control">
            <option value="">Select State</option>
            <option value="Andhra Pradesh"<?php echo ($res['state'] === 'Andhra Pradesh') ? ' selected' : ''; ?>>37|Andhra Pradesh</option>
            <option value="Arunachal Pradesh"<?php echo ($res['state'] === 'Arunachal Pradesh') ? ' selected' : ''; ?>>12|Arunachal Pradesh</option>
            <option value="Assam"<?php echo ($res['state'] === 'Assam') ? ' selected' : ''; ?>>18|Assam</option>
            <option value="Bihar"<?php echo ($res['state'] === 'Bihar') ? ' selected' : ''; ?>>10|Bihar</option>
            <option value="Chhattisgarh"<?php echo ($res['state'] === 'Chhattisgarh') ? ' selected' : ''; ?>>22|Chhattisgarh</option>
            <option value="Delhi"<?php echo ($res['state'] === 'Delhi') ? ' selected' : ''; ?>>07|Delhi</option>
            <option value="Goa"<?php echo ($res['state'] === 'Goa') ? ' selected' : ''; ?>>30|Goa</option>
            <option value="Gujarat"<?php echo ($res['state'] === 'Gujarat') ? ' selected' : ''; ?>>24|Gujarat</option>
            <option value="Haryana"<?php echo ($res['state'] === 'Haryana') ? ' selected' : ''; ?>>06|Haryana</option>
            <option value="Himachal Pradesh"<?php echo ($res['state'] === 'Himachal Pradesh') ? ' selected' : ''; ?>>02|Himachal Pradesh</option>
            <option value="Jharkhand"<?php echo ($res['state'] === 'Jharkhand') ? ' selected' : ''; ?>>20|Jharkhand</option>
            <option value="Karnataka"<?php echo ($res['state'] === 'Karnataka') ? ' selected' : ''; ?>>29|Karnataka</option>
            <option value="Kerala"<?php echo ($res['state'] === 'Kerala') ? ' selected' : ''; ?>>32|Kerala</option>
            <option value="Madhya Pradesh"<?php echo ($res['state'] === 'Madhya Pradesh') ? ' selected' : ''; ?>>23|Madhya Pradesh</option>
            <option value="Maharashtra"<?php echo ($res['state'] === 'Maharashtra') ? ' selected' : ''; ?>>27|Maharashtra</option>
            <option value="Manipur"<?php echo ($res['state'] === 'Manipur') ? ' selected' : ''; ?>>14|Manipur</option>
            <option value="Meghalaya"<?php echo ($res['state'] === 'Meghalaya') ? ' selected' : ''; ?>>17|Meghalaya</option>
            <option value="Mizoram"<?php echo ($res['state'] === 'Mizoram') ? ' selected' : ''; ?>>15|Mizoram</option>
            <option value="Nagaland"<?php echo ($res['state'] === 'Nagaland') ? ' selected' : ''; ?>>13|Nagaland</option>
            <option value="Odisha"<?php echo ($res['state'] === 'Odisha') ? ' selected' : ''; ?>>21|Odisha</option>
            <option value="Punjab"<?php echo ($res['state'] === 'Punjab') ? ' selected' : ''; ?>>03|Punjab</option>
            <option value="Rajasthan"<?php echo ($res['state'] === 'Rajasthan') ? ' selected' : ''; ?>>08|Rajasthan</option>
            <option value="Sikkim"<?php echo ($res['state'] === 'Sikkim') ? ' selected' : ''; ?>>11|Sikkim</option>
            <option value="Tamil Nadu"<?php echo ($res['state'] === 'Tamil Nadu') ? ' selected' : ''; ?>>33|Tamil Nadu</option>
            <option value="Telangana"<?php echo ($res['state'] === 'Telangana') ? ' selected' : ''; ?>>36|Telangana</option>
            <option value="Tripura"<?php echo ($res['state'] === 'Tripura') ? ' selected' : ''; ?>>16|Tripura</option>
            <option value="Uttar Pradesh"<?php echo ($res['state'] === 'Uttar Pradesh') ? ' selected' : ''; ?>>09|Uttar Pradesh</option>
            <option value="Uttarakhand"<?php echo ($res['state'] === 'Uttarakhand') ? ' selected' : ''; ?>>05|Uttarakhand</option>
            <option value="West Bengal"<?php echo ($res['state'] === 'West Bengal') ? ' selected' : ''; ?>>19|West Bengal</option>
        </select>
    </div>
</div>

						   <div class="col-md-12"> 
								<div class="form-group"> 
									<label>Address</label>  
									<input type="text" id="gstAddress" name="gstAddress" class="form-control"  value="<?php echo stripslashes($res['gstAddress']); ?>" >	 
								</div>  
						   </div> 
 

						</div>


					</div>


				</div>


  </div><div class="card-footer text-right">


						<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button> 

						<input name="action" type="hidden" id="action" value="addagentbranch" /> 

						<input name="id" type="hidden" id="id" value="<?php echo $_REQUEST['id']; ?>" /> 
						<input name="editid" type="hidden" id="editid" value="<?php echo $res['id']; ?>" /> 



					</div>



</form> 



<?php } ?>




 
 <script>
 
// Function to validate GST Via format and State
        const stateGSTCodes = {
    "Andhra Pradesh": "37",
    "Arunachal Pradesh": "12",
    "Assam": "18",
    "Bihar": "10",
    "Chhattisgarh": "22",
    "Delhi": "07",
    "Goa": "30",
    "Gujarat": "24",
    "Haryana": "06",
    "Himachal Pradesh": "02",
    "Jharkhand": "20",
    "Karnataka": "29",
    "Kerala": "32",
    "Madhya Pradesh": "23",
    "Maharashtra": "27",
    "Manipur": "14",
    "Meghalaya": "17",
    "Mizoram": "15",
    "Nagaland": "13",
    "Odisha": "21",
    "Punjab": "03",
    "Rajasthan": "08",
    "Sikkim": "11",
    "Tamil Nadu": "33",
    "Telangana": "36",
    "Tripura": "16",
    "Uttar Pradesh": "09",
    "Uttarakhand": "05",
    "West Bengal": "19"
};


     
    function validateGSTByState(gst, state) {
        const gstPrefix = stateGSTCodes[state];
        const inputGSTPrefix = gst.substring(0, 2);
        return gstPrefix === inputGSTPrefix;
    }

    function validateGST(gst) {
        const pattern = /^\d{2}[A-Z]{5}\d{4}[A-Z]\d[A-Z]{2}$/;
        return pattern.test(gst);
    }

    function handleSubmit(event) {
        const gstInput = document.getElementById('gst');
        const gstError = document.getElementById('gstError');
        const gstValue = gstInput.value.trim();
        const selectedState = document.getElementById('state').value;

        if (!validateGST(gstValue) || !validateGSTByState(gstValue, selectedState)) {
            gstError.style.display = 'block';
            event.preventDefault(); // Prevent form submission
        } else {
            gstError.style.display = 'none';
        }
    }

    const form = document.querySelector('form');
    form.addEventListener('submit', handleSubmit);

    // Listen to state change
    const stateSelect = document.getElementById('state');
    stateSelect.addEventListener('change', function() {
        document.getElementById('gstError').style.display = 'none';
    });
    
    
    
    //gst mobile length
     document.getElementById('gstMobile').addEventListener('input', function() {
        if (this.value.length > 10) {
            this.value = this.value.slice(0, 10);
        }
    });
    
</script>





<?php if ($_REQUEST['action'] == 'deleteClients') { ?>
  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">
  
    <p style="color: red;font-size:18px;">Are you sure you want to delete this Employee?</p>

    <div class="modal-footer"> <input name="Cancel" type="submit" value="Cancel" data-dismiss="modal" aria-label="Close" class="btn btn-secondary btn-lg waves-effect waves-light btn-primary-gray" />
      <input name="Save" type="submit" value="delete" id="savingbutton" class="btn btn-danger" />
    </div>

    <input name="action" type="hidden" id="action" value="deleteClients" />
    <input name="deleteId" type="hidden" id="" value="<?php echo $_REQUEST['id'] ?>" />
	
  </form>
<?php } ?>



<?php if ($_REQUEST['action'] == 'deletebranch') { ?>
  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">



    <p style="color: red;font-size:18px;">Are you sure you want to delete this branch?</p>


    <div class="modal-footer"> <input name="Cancel" type="submit" value="Cancel" data-dismiss="modal" aria-label="Close" class="btn btn-secondary btn-lg waves-effect waves-light btn-primary-gray" />
      <input name="Save" type="submit" value="delete" id="savingbutton" class="btn btn-danger" />
    </div>

    <input name="action" type="hidden" id="action" value="deletebranch" />
    <input name="deleteId" type="hidden" id="" value="<?php echo $_REQUEST['id'] ?>" />
  </form>

<?php } ?>





