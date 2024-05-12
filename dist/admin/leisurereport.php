<?php
if($_REQUEST['startDate']!='' && $_REQUEST['endDate']!='' ){
$startDate=date('d-m-Y',strtotime($_REQUEST['startDate']));
$endDate=date('d-m-Y',strtotime($_REQUEST['endDate']));
} else {
$startDate=date('d-m-Y',strtotime('-30 Days'));
$endDate=date('d-m-Y',strtotime('+30 Days'));
}

$where1='';
$where2='';

$whereintotal=' and DATE(dateAdded) between  "'.date('Y-m-d',strtotime($startDate)).'" and "'.date('Y-m-d',strtotime($endDate)).'" ';
$whereintotal2=' and DATE(paymentDate) between  "'.date('Y-m-d',strtotime($startDate)).'" and "'.date('Y-m-d',strtotime($endDate)).'" ';

$clientsearch='';

if($_REQUEST['keyword']!=''){
$clientsearch=' and queryId in (select id from queryMaster where clientId in (select id from userMaster where firstName like "%'.$_REQUEST['keyword'].'%" or lastName like "%'.$_REQUEST['keyword'].'%"  or mobile like "%'.$_REQUEST['keyword'].'%"  or email like "%'.$_REQUEST['keyword'].'%" )  or id="'.decode($_REQUEST['keyword']).'" )  or id="'.decode($_REQUEST['keyword']).'"';
}
  
  
  
$searchcity='';
if($_REQUEST['searchcity']!=''){
$searchcity=' and queryId in(select id from queryMaster where  destinationId="'.$_REQUEST['searchcity'].'") ';
}

$searchusers='';
if($_REQUEST['searchusers']!=''){
$searchusers=' and queryId in(select id from queryMaster where   assignTo="'.$_REQUEST['searchusers'].'") ';
}

?>

 <style>
.table td, .table th {
    vertical-align: top;white-space: nowrap;
}
.statusbox{margin-right: 5px; padding: 10px; text-align: center; background-color: #000000; font-size: 13px; color: #fff; border-radius: 4px; text-transform:uppercase;}
</style>
<div class="wrapper">
<div class="container-fluid">
<div class="main-content">

                <div class="page-content">

      <div class="newboxheading"><div class="newhead">Ledger Report<div class="newoptionmenu">
  <form  action=""    method="get" enctype="multipart/form-data">	
								<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><input type="text" class="form-control" id="startDate" name="startDate" readonly="" placeholder="From" value="<?php echo $startDate; ?>" style="width:130px;"></td>
    <td style="padding-left:5px;"><input type="text" class="form-control" id="endDate" name="endDate" readonly="" placeholder="From" value="<?php echo $endDate; ?>" style="width:130px;"></td>
    <?php  if($LoginUserDetails['userType']==0){ ?> <?php } ?>
    <td style="padding-left:5px;"><button type="submit" class="btn btn-secondary btn-lg waves-effect waves-light" style="padding: 6px 10px;"  ><i class="fa fa-search" aria-hidden="true"></i> Search</button></td>
    <td><button type="button" class="btn btn-secondary btn-lg waves-effect waves-light" style="padding: 6px 10px; margin-left:10px;" onclick="fnExcelReport();"><i class="fa fa-download" aria-hidden="true"></i> Export Report</button></td>
  </tr>
</table>
<input type="hidden" name="ga" value="leisurereport" />
  </form>
 </div>
 </div>     
 
     
</div>
                    
                    <!-- start page title -->
                     
              
                        <div class=" ">
                        <div class="col-md-12 col-xl-12" style="padding-top:32px;">
						<div class="card">
                            <div class="card-body" style="padding:0px;">  
							         
							  
							        <div style="margin-bottom:0px;"> </div>
									<div class="table-responsive">
							        <table class="table table-hover mb-0" style="border:1px solid #ddd; display:1none !important;" id="headerTable" >

                                            <thead>
                                                <tr>
                                                  <th>Sr.</th>
                                                  <th>Name</th>
                                                  <th>Room Type </th>
                                                  <th>From&nbsp;Date </th>
                                                  <th>To&nbsp;Date </th>
                                                  <th>Start&nbsp;Time </th>
                                                  <th>End&nbsp;Time </th>
                                                  <th>Vehicle</th>
                                                  <th>Supplier</th>
                                                  <th>Booking Status </th>
                                                  <th>Payment Status</th>
                                                  <th>Invoice Amount </th>
                                                  <th>Cancellation Date </th>
                                                  <th>Due Date </th>
                                                  <th>Paid Amount </th>
                                                  <th>Pending Amount </th>
                                                  <th>XE Gain </th>
                                                  <th>XE Loss </th>
                                                  <th>Additional Profit </th>
                                                  <th>GST</th>
                                                  <th>Client Name </th>
                                                  <th>Mobile</th>
                                                  <th>Email</th>
                                                  <th>Remarks</th>
                                                </tr>
                                            </thead>
<tbody> 
<?php 
$totalno=1; 
$rs=GetPageRecord('*','sys_packageBuilderEvent',' DATE(supplierCancellationDate)>="'.date('Y-m-d',strtotime($startDate)).'" and DATE(supplierCancellationDate)<="'.date('Y-m-d',strtotime($endDate)).'" and sectionType!="Leisure" order by packageDays,time(checkIn) asc');
while($rest=mysqli_fetch_array($rs)){ 


$aadv=GetPageRecord('count(id) as totalnotes','supplierNotes','serviceId="'.$rest['id'].'"');  
$notesyes=mysqli_fetch_array($aadv);

$netCost=0;
$markupValue=0;
$gross=0;

$predate=date('d-m-Y',strtotime($editresult['startDate']));
 

if($rest['sectionType']=='Accommodation'){

  $netCost=round($rest['singleRoomCost']*$rest['singleRoom'])+($rest['doubleRoomCost']*$rest['doubleRoom'])+($rest['tripleRoomCost']*$rest['tripleRoom'])+($rest['quadRoomCost']*$rest['quadRoom'])+($rest['cwbRoomCost']*$rest['cwbRoom'])+($rest['cnbRoomCost']*$rest['cnbRoom']);

} else { 

if($rest['transferCategory']=='Private'){

 $netCost=round($rest['vehicle']*$rest['adultCost']);

} else {

 $netCost=round($rest['adultCost']*$editresult['adult'])+($rest['childCost']*$editresult['child']);

if($rest['sectionType']=='Flight'){
$netflightcosting=$netCost+$netflightcosting;
}


}
 
}




$totalnetCost=$netCost+$totalnetCost;

$markupValue=($rest['markupPercent']*$netCost/100);
$gross=round($netCost+$markupValue);

$totalGross=$gross+$totalGross;


if($rest['supplierAmount']>0){
$netCost=$rest['supplierAmount'];
} 


$rs13q=GetPageRecord('*','sys_packageBuilder','id="'.$rest['packageId'].'" and confirmQuote=1');   
$packagedata=mysqli_fetch_array($rs13q);


$rs1=GetPageRecord('*','queryMaster','id="'.$packagedata['queryId'].'"');   
$queyData=mysqli_fetch_array($rs1);


$aadv=GetPageRecord('*','supplierNotes','serviceId="'.$rest['id'].'"');  
$notesyes=mysqli_fetch_array($aadv);

/*
$rs22=GetPageRecord('*','sys_userMaster','  id="'.$rest['addedBy'].'" order by firstName asc'); 
$restuser=mysqli_fetch_array($rs22); 
*/
$bc=GetPageRecord('*','userMaster','id="'.$queyData['clientId'].'"'); 
$clientData=mysqli_fetch_array($bc);

?>

<tr>
  <td align="left" valign="top"><?php echo $totalno; ?></td>
  <td align="left" valign="top"><div style="width:200px; overflow:hidden;"><?php echo stripslashes($rest['name']); ?></div></td>
  <td align="left" valign="top"><?php echo stripslashes($rest['hotelRoom']); ?></td>
  <td align="left" valign="top"><?php if($rest['sectionType']=='Accommodation'){ ?><?php echo date('d-m-Y',strtotime($rest['startDate'])); ?> 
<?php } else { echo date('d-m-Y',strtotime($rest['startDate'])); } ?></td>
  <td align="left" valign="top"><?php if($rest['sectionType']=='Accommodation'){   echo date('d-m-Y',strtotime($rest['endDate'])); } ?></td>
  <td align="left" valign="top"><?php if($rest['sectionType']!='FeesInsurance'){ echo date('g:i A',strtotime($rest['checkIn'])); } ?>  </td>
  <td align="left" valign="top"><?php if($rest['sectionType']!='FeesInsurance'){ echo date('g:i A',strtotime($rest['checkOut'])); } ?></td>
  <td align="left" valign="top"><?php if($rest['transferCategory']=='Private'){ ?><?php echo stripslashes($rest['vehicle']); } ?></td>
  <td align="left" valign="top"> <?php  
$rs2=GetPageRecord('*','userMaster',' id="'.$rest['supplierId'].'" and status=1 and userType=5 order by firstName asc');
while($restsup=mysqli_fetch_array($rs2)){   echo $restsup['firstName']; ?> <?php echo $restsup['lastName'];  } ?></td>
  <td align="left" valign="top"><?php if($rest['bookingStatusId']==0){ ?>Mail Sent<?php } if($rest['bookingStatusId']==1){ ?>Pending Confirmation<?php } if($rest['bookingStatusId']==2){ ?>Confirmed<?php }  if($rest['bookingStatusId']==3){ ?>Not Confirmed<?php } if($rest['bookingStatusId']==4){ ?>Rates Negotiation<?php } ?></td>
  <td align="left" valign="top"><?php if($rest['status']==0){ ?>Payment Pending<?php } if($rest['status']==1){ ?>Amount Paid<?php } ?></td>
  <td align="left" valign="top"><?php echo $netCost; ?></td>
  <td align="left" valign="top"><?php if($rest['supplierCancellationDate']!='' && date('d-m-Y',strtotime($rest['supplierCancellationDate']))!='01-01-1970'){  echo date('d-m-Y',strtotime($rest['supplierCancellationDate'])); } ?></td>
  <td align="left" valign="top"><?php if($rest['dueDate']!='' && date('d-m-Y',strtotime($rest['dueDate']))!='01-01-1970'){  echo date('d-m-Y',strtotime($rest['dueDate'])); } ?></td>
  <td align="left" valign="top"><?php echo $rest['paidAmount']; ?></td>
  <td align="left" valign="top"><?php echo $netCost-$rest['paidAmount']; ?></td>
  <td align="left" valign="top"><?php if($rest['r1XErate']>$rest['r2XErate']){ echo $rest['r1Cost']-$rest['r2Cost']; } ?></td>
  <td align="left" valign="top"><?php if($rest['r1XErate']<$rest['r2XErate']){ echo $rest['r1Cost']-$rest['r2Cost']; } ?></td>
  <td align="left" valign="top">&nbsp;</td>
  <td align="left" valign="top"><?php if($packagedata['igst']==0){ echo ($packagedata['totalsgst']+$packagedata['totalcgst']); } if($packagedata['igst']>0){ echo ($packagedata['totaligst']); } ?></td>
  <td align="left" valign="top"><?php echo stripslashes($clientData['submitName']); ?> <?php echo stripslashes($clientData['firstName']); ?> <?php echo stripslashes($clientData['lastName']); ?></td>
  <td align="left" valign="top"><?php echo stripslashes($clientData['mobile']); ?></td>
  <td align="left" valign="top"><?php echo stripslashes($clientData['email']); ?></td>
  <td align="left" valign="top"><?php echo stripslashes($notesyes['details']); ?></td>
</tr>


<?php  $totalno++; } ?>
                                      </tbody>
                              </table>
								   </div>
						   
						   
						   
									 <?php if($totalno==1){ ?>
						   <div style="text-align:center; padding:40px 0px; font-size:14px; color:#999999;">No Data </div>
						   <?php } else { ?>
								 
										  
										<?php } ?>
						  </div>
								 
                             
</div>
                             

                        </div>

                         
						
						
						
						 
                     

             </div><!--end col-->

            <!-- end row -->

    </div>

        <!-- End Page-content -->

         
    </div>
	</div>	</div>
	<script>



 $( function() {
    $( "#startDate" ).datepicker({ 
	  dateFormat: 'dd-mm-yy' 
      });
	  
	  $( "#endDate" ).datepicker({ 
	  dateFormat: 'dd-mm-yy' 
      });
  } );
 
function fnExcelReport()
{
    var tab_text="<table border='2px'><tr bgcolor='#87AFC6'>";
    var textRange; var j=0;
    tab = document.getElementById('headerTable'); // id of table

    for(j = 0 ; j < tab.rows.length ; j++) 
    {     
        tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
        //tab_text=tab_text+"</tr>";
    }

    tab_text=tab_text+"</table>";
    tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
    tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
    tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE "); 

    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
    {
        txtArea1.document.open("txt/html","replace");
        txtArea1.document.write(tab_text);
        txtArea1.document.close();
        txtArea1.focus(); 
        sa=txtArea1.document.execCommand("SaveAs",true,"Say Thanks to Sumit.xls");
    }  
    else                 //other browser not tested on IE 11
        sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));  

    return (sa);
}
</script>
				
	
 