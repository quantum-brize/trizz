<?php
   include "inc.php"; 
   include "config/logincheck.php";  
   $selectedpage=''; 
   $selectleft='branches'; 
   
    if($_REQUEST['deleteId']!=''){ 
 deleteRecord('agentBranch','id="'.decode($_REQUEST['deleteId']).'"'); 
}

 if($_REQUEST['did']!=''){

 deleteRecord('clientMaster','id="'.decode($_REQUEST['did']).'" and agentId="'.$_SESSION['agentUserid'].'"   ');

 }
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <title>Branches - <?php echo stripslashes($getcompanybasicinfo['companyName']); ?></title>
      <?php include "headerinc.php"; ?>
   </head>
   <body class="greyouter">
      <?php include "header.php"; ?>
      <!--------------Left Menu---------------->
      <?php include "left.php"; ?>
      <!--------------Mid Body---------------->
      <section class="profile">
         <div class="listcontent">
            <div class="card">
               <div class="card-body">
                  <div class="bodysection bodypricesection">
                     <h1>Manage Branches
					 <button type="button" class="bodyhandbuttonright" onClick="loadpop('Add Branch',this,'500px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addagentbranch&id=<?php echo encode($_SESSION['agentUserid']); ?>">+ Add Branches</button>
					 </h1>
                     
                     <div class="tbtabcontent" style="border-top-left-radius: 14px;">
                        <div class="row">
                        </div>
                        <div class="table-responsive">
                           <?php if ($_REQUEST['did'] != '') { ?>
                           <div id="successMessage" style="background-color:#CC0000; color:#FFFFFF; font-size:12px; margin:10px 0px; padding:5px 10px;">
                              Successfully Deleted!
                           </div>
                           <script>
                              setTimeout(function () {
                                  var successMessage = document.getElementById('successMessage');
                                  successMessage.parentNode.removeChild(successMessage);
                              }, 1000); // Remove the message after 1000 milliseconds (1 second)
                           </script>
                           <?php } ?>
                           <table class="table">
                              <thead>
                                 <tr style="background-color: #25708d;color:#fff;">

								  <th>Company</th>

								  <th>GST</th>

								  <th align="center"><div align="center">GST Mobile </div></th>

								  <th>GST Email </th>

									<th>GST State </th>

									<th>GST Address </th>
								    <th>&nbsp;</th>
								    <th>&nbsp;</th>
								</tr>
                              </thead>
                              <tbody>
                                 <?php 
									$limit=clean($_GET['records']);
									
									$page=clean($_GET['page']); 
									
									$sNo=1; 
									
									$search='';
									
									$targetpage='display.html?ga='.$_REQUEST['ga'].'&agentCategory='.$_REQUEST['agentCategory'].'&fromdate='.$_REQUEST['fromdate'].'&todate='.$_REQUEST['todate'].'&keyword='.$_REQUEST['keyword'].'&'; 
									
									$rs=GetRecordList('*','agentBranch',' where agentId="'.$_SESSION['agentUserid'].'"  order by id desc  ','250',$page,$targetpage);  
									$totalentry=$rs[1];  
									$paging=$rs[2];  
									
									while($rest=mysqli_fetch_array($rs[0])){  
									$totalSale=0;
								?>
                                 <tr>

								  <td align="left" valign="top"><b><?php echo strip($rest['companyName']); ?></b></td>
								  <td align="left" valign="top"><b><?php echo strip($rest['gst']); ?></b></td>
                                  <td align="center" valign="top"><b><?php echo strip($rest['gstMobile']); ?></b></td>
                                   <td align="left" valign="top"><b><?php echo strip($rest['gstEmail']); ?></b></td>
								   <td align="left" valign="top"><b><?php echo strip($rest['state']); ?></b></td>
                                   <td align="left" valign="top"><b><?php echo strip($rest['gstAddress']); ?></b></td>
					               <td width="4%" align="left" valign="top"><div align="center"><i class="fa fa-pencil" aria-hidden="true" style="cursor:pointer;" title="Edit" onClick="loadpop('Edit Branch',this,'500px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addagentbranch&id=<?php echo encode($_SESSION['agentUserid']); ?>&editid=<?php echo encode($rest['id']); ?>"></i></div></td>
                                   <td width="4%" align="left" valign="top"><div align="center" style="cursor:pointer; color:#FF0000;display:none;"><a onClick="showConfirmation('<?php echo encode($rest['id']); ?>', '<?php echo ($_REQUEST['id']); ?>');"><i class="fa fa-trash" title="Delete" aria-hidden="true"></i></a></div>
								   
								   
								    <span style="display: inline-block;" >
									   	<a class="dropdown-item neweditpan" onClick="loadpop('Delete Branch',this,'600px')" popaction="action=deletebranch&id=<?php echo $rest['id']; ?>" data-toggle="modal" data-target=".bs-example-modal-center"><i class="fa fa-trash" aria-hidden="true"></i></a>
									   </span>
									   
                                          </td>

								 <?php $sNo++; } ?>
                              </tbody>
                           </table>
                           <?php if($sNo==1){?>
                           <div style="text-align:center; padding:40px;">No Customer Found</div>
                           <?php } ?>	
                           <div class="card-footer text-right" style="overflow:hidden;">
                              <div style="float: left; font-size: 13px; padding: 7px 11px; border: 1px solid #ededed; background-color: #fff; color: #000;">Total Records: <strong><?php echo $totalentry; ?></strong></div>
                              <div class="pagingnumbers"><?php echo $paging; ?></div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- HTML -->
      <?php include "footerinc.php"; ?>
	  
	  
	  


<script>

function getflightSearchCIty(citysearchfield,cityresultfield,listsearch){

var citysearchfieldval = encodeURI($('#'+citysearchfield).val());  

var citysearchfield = citysearchfield;



if(citysearchfieldval!=''){  

$('#'+listsearch).show();

$('#'+listsearch).load('searchflightcitylists.php?keyword='+citysearchfieldval+'&searchcitylists='+listsearch+'&cityresultfield='+cityresultfield+'&citysearchfield='+citysearchfield);

}

}





function swapdata(){

var pickupCitySearchfromCity = $('#pickupCitySearchfromCity').val();

var pickupCitySearchfromCity2 = $('#pickupCitySearchfromCity2').val();



var fromDestinationFlight = $('#fromDestinationFlight').val();

var fromDestinationFlight2 = $('#fromDestinationFlight2').val();



$('#pickupCitySearchfromCity').val(pickupCitySearchfromCity2);

$('#pickupCitySearchfromCity2').val(pickupCitySearchfromCity);



$('#fromDestinationFlight2').val(fromDestinationFlight);

$('#fromDestinationFlight').val(fromDestinationFlight2);



}



$(".swapbtn").click(function(){

 $(this).toggleClass("down")  ; 

});











 



$(document).ready(function () {

    $("#dt1").datepicker({

        dateFormat: "dd-mm-yy",

        minDate: 0,

        onSelect: function () {

            var dt2 = $('#dt2');

            var startDate = $(this).datepicker('getDate');

            //add 30 days to selected date

            startDate.setDate(startDate.getDate() + 30);

            var minDate = $(this).datepicker('getDate');

            var dt2Date = dt2.datepicker('getDate');

            //difference in days. 86400 seconds in day, 1000 ms in second

            var dateDiff = (dt2Date - minDate)/(86400 * 1000);



            //dt2 not set or dt1 date is greater than dt2 date

            if (dt2Date == null || dateDiff < 0) {

                    dt2.datepicker('setDate', minDate);

            }

            //dt1 date is 30 days under dt2 date

            else if (dateDiff > 30){

                    dt2.datepicker('setDate', startDate);

            }

            //sets dt2 maxDate to the last day of 30 days window

            dt2.datepicker('option', 'maxDate', startDate);

            //first day which can be selected in dt2 is selected date in dt1

            dt2.datepicker('option', 'minDate', minDate);

        }

    });

    $('#dt2').datepicker({

        dateFormat: "dd-mm-yy",

        minDate: 0,onSelect: function () { 

        }

    });

	

});

 

 

 

function changeselectsearchtype(){

var selectsearchtype = Number($('#selectsearchtype').val());

if(selectsearchtype<4){

selecttb(selectsearchtype);

}



if(selectsearchtype==4){ 

$( "#groupenquiryid" ).trigger( "click" );

}

$('#selectsearchtype').val(1);

}

















function selecttb(id){

$('#returndiv').show();

$('#searchbuttonflight').show();

$('#submitbuttonflight').hide();

$('#notediv').hide(); 





if(id==1){

$('#tb2').removeClass('active');

$('#tb3').removeClass('active');

$('#tb4').removeClass('active');

$('#tb1').addClass('active');

$('#tripType').val('1');

$('#dt2').attr('disabled','true');

$('#dt3').attr('disabled','true');

$('#dt2').css('color','#fafafa');

$('#fixedDeparture').val('0');

$('.selectreturnflightcl').hide();

}

if(id==2){

$('.selectreturnflightcl').show();

$('#tb1').removeClass('active');

$('#tb3').removeClass('active');

$('#tb4').removeClass('active');

$('#tb2').addClass('active');

$('#tripType').val('2');

$('#dt2').removeAttr('disabled');

$('#dt3').removeAttr('disabled');

$('#dt2').css('color','#333333');

$('#fixedDeparture').val('0');

} 

if(id==3){

$('#tb1').removeClass('active');

$('#tb2').removeClass('active');

$('#tb4').removeClass('active');

$('#tb3').addClass('active');

$('#tripType').val('1');

$('#dt2').attr('disabled','true');

$('#dt1').removeAttr('disabled');


$('#dt2').css('color','#fafafa');

$('#fixedDeparture').val('1');

}



if(id==4){

$('#returndiv').hide();

$('#tb1').removeClass('active');

$('#tb2').removeClass('active');

$('#tb3').removeClass('active');

$('#tb4').addClass('active');

$('#formids').attr('target','actoinfrm');

$('#formids').attr('action','actionpage.php');

$('#tripType').val('4');

$('#notediv').show();



$('#searchbuttonflight').hide();

$('#submitbuttonflight').show();

}





}





function findflight(id){

var pickupCitySearchfromCity = $('#pickupCitySearchfromCity').val();

var pickupCitySearchfromCity2 = $('#pickupCitySearchfromCity2').val();



if(pickupCitySearchfromCity==pickupCitySearchfromCity2){

$('#flightdublicate').show();

} else {

$('#flightdublicate').hide();





if(id==1){

$('#formids').submit();

}



}

}





function checkdublicatedestination(){

setTimeout(function() { 

findflight(0);

 }, 500);

}

function showConfirmation(idToDelete, parentId) {
    
    document.querySelector('html').classList.add('bgcolorbranch');
    
    var confirmationBox = document.createElement('div');
    confirmationBox.classList.add('confirmation-box');
    
    var message = document.createElement('div');
    message.classList.add('confirmation-box-message');
    message.textContent = 'Are you sure you want to delete?';

    var confirmButton = document.createElement('button');
    confirmButton.classList.add('confirmation-box-button');
    confirmButton.textContent = 'OK';
    confirmButton.addEventListener('click', function() {
        window.location.href = 'branches?deleteId=' + idToDelete + '&id=' + parentId;
    });

    var cancelButton = document.createElement('button');
    cancelButton.classList.add('confirmation-box-button', 'confirmation-box-cancel-button');
    cancelButton.textContent = 'Cancel';
    cancelButton.addEventListener('click', function() {
        document.body.removeChild(confirmationBox);
    });

    var buttonContainer = document.createElement('div');
    buttonContainer.classList.add('confirmation-box-buttons');
    buttonContainer.appendChild(confirmButton);
    buttonContainer.appendChild(cancelButton);

    confirmationBox.appendChild(message);
    confirmationBox.appendChild(buttonContainer);

    document.body.appendChild(confirmationBox);
}



</script>
   </body>
</html>