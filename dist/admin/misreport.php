<?php
if($_REQUEST['startDate']!='' && $_REQUEST['endDate']!='' ){
$startDate=date('d-m-Y',strtotime($_REQUEST['startDate']));
$endDate=date('d-m-Y',strtotime($_REQUEST['endDate']));
} else {
$startDate=date('01-m-Y');
$endDate=date('d-m-Y');
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

      <div class="newboxheading"><div class="newhead">MIS Report<div class="newoptionmenu">
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
<input type="hidden" name="ga" value="misreport" />
  </form>
 </div>
 </div>     
 
     
</div>
                    
                    <!-- start page title -->
                     
              
                        <div class=" ">
                        <div class="col-md-12 col-xl-12" style="padding-top:32px;">
						<div class="card" style=" overflow:hidden;">
                            <div class="card-body"  style="padding:0px;">  
							         
							   
									<div class="table-responsive"  >
							        <table class="table table-hover mb-0" style="border:1px solid #ddd; display:1none !important;" id="headerTable" >

                                            <thead>
                                                <tr>
                                                  <th>Sr. </th>
                                                  <th>Booked By </th>
                                                  <th>Email</th>
                                                  <th>Mobile</th>
                                                  <th>Email</th>
                                                  <th> ID </th>
                                                  <th>Booking Date </th>
                                                  <th>Client </th>
                                                  <th>Destination</th>
                                                  <th>No. of Pax </th>
                                                  <th>Selling Cost </th>
                                                  <th>Flight Cost </th>
                                                  <th>Hotel Cost </th>
                                                  <th>Tour Cost </th>
                                                  <th>Visa Cost </th>
                                                  <th>Cruise Cost </th>
                                                  <th>Total Cost </th>
                                                  <th>Gross Profit </th>
                                                  <th>GST</th>
                                                </tr>
                                            </thead>
<tbody> 
<?php

$totalno=1;

$where=' where  id in (select queryId from sys_packageBuilder where confirmQuote=1 and confirmDate>="'.date('Y-m-d',strtotime($startDate)).'" and confirmDate<="'.date('Y-m-d',strtotime($endDate)).'") order by id desc';


$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 
$targetpage='display.html?ga='.$_REQUEST['ga'].'&keyword='.$_REQUEST['keyword'].'&searchcity'.$_REQUEST['searchcity'].'&status='.$_REQUEST['status'].'&searchusers='.$_REQUEST['searchusers'].'&'; 
$rs=GetRecordList('*','queryMaster','   '.$where.'  ','2000',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 

$b=GetPageRecord('*','sys_packageBuilder','queryId="'.$rest['id'].'" and confirmQuote=1'); 
$packageData=mysqli_fetch_array($b);


$totalbuying = 0;
$filghtcost = 0;
$totalFilght = 0;
$rsd=GetPageRecord('*','sys_packageBuilderEvent',' packageId="'.$packageData['id'].'" and sectionType!="Leisure" and sectionType="Flight" order by id asc');
while($serviceflight=mysqli_fetch_array($rsd)){ 
$filghtcost=round(($serviceflight['adultCost']*$rest['adult'])+($serviceflight['childCost']*$rest['child']));
$totalbuying+=$filghtcost;
$totalFilght+=round(($filghtcost*$serviceflight['markupPercent']/100)+$filghtcost);
}
 
$finalHotelCost = 0;
$totalHotel = 0;
$rsd=GetPageRecord('*','sys_packageBuilderEvent',' packageId="'.$packageData['id'].'" and sectionType!="Leisure" and sectionType="Accommodation" order by id asc');
while($serviceHotel=mysqli_fetch_array($rsd)){ 
$totalHotel=round(($serviceHotel['singleRoomCost']*$serviceHotel['singleRoom'])+($serviceHotel['doubleRoomCost']*$serviceHotel['doubleRoom'])+($serviceHotel['tripleRoomCost']*$serviceHotel['tripleRoom'])+($serviceHotel['quadRoomCost']*$serviceHotel['quadRoom'])+($serviceHotel['cwbRoomCost']*$serviceHotel['cwbRoom'])+($serviceHotel['cnbRoomCost']*$serviceHotel['cnbRoom']));
$totalbuying+=$totalHotel;
$finalHotelCost+= round($serviceHotel['markupPercent']*$totalHotel/100)+$totalHotel;
 
}

$totalTour = 0;
$totalToursic = 0;
$rsd=GetPageRecord('*','sys_packageBuilderEvent',' packageId="'.$packageData['id'].'" and sectionType!="Leisure" and (sectionType="Activity" or sectionType="Transportation") order by id asc');
while($serviceTour=mysqli_fetch_array($rsd)){ 



if($serviceTour['transferCategory']=='Private'){ 
 $tourCost=round($serviceTour['vehicle']*$serviceTour['adultCost']);
$totalbuying+=$tourCost;
$totalTour+=round(($serviceTour['markupPercent']*$tourCost/100)+$tourCost); 
} else {
 $totalToursic=round(($serviceTour['adultCost']*$rest['adult'])+($serviceTour['childCost']*$rest['child']));
$totalbuying+=$totalToursic;
 $totalTour+=round(($serviceTour['markupPercent']*$totalToursic/100)+($totalToursic)); 
} 
}

$visacost=0;
$totalVisa = 0;
$rsd=GetPageRecord('*','sys_packageBuilderEvent',' packageId="'.$packageData['id'].'" and sectionType!="Leisure" and (sectionType="FeesInsurance") order by id asc');
while($serviceVisa=mysqli_fetch_array($rsd)){
$visacost=round(($serviceVisa['adultCost']*$rest['adult'])+($serviceVisa['childCost']*$rest['child']));
$totalbuying+=$visacost;  
$totalVisa+=round(($serviceVisa['markupPercent']*$visacost/100)+$visacost); 
}

$cruisecost=0;
$totalCruise = 0;
$rsd=GetPageRecord('*','sys_packageBuilderEvent',' packageId="'.$packageData['id'].'" and sectionType!="Leisure" and (sectionType="Cruise") order by id desc');
while($serviceCruise=mysqli_fetch_array($rsd)){ 
$cruisecost=round(($serviceCruise['adultCost']*$rest['adult'])+($serviceCruise['childCost']*$rest['child']));
$totalbuying+=$cruisecost;  
$totalCruise+=round(($serviceCruise['markupPercent']*$cruisecost/100)+$cruisecost); 
}





$rs22=GetPageRecord('*','sys_userMaster','  id="'.$rest['addedBy'].'" order by firstName asc'); 
$restuser=mysqli_fetch_array($rs22); 

$bc=GetPageRecord('*','userMaster','id="'.$rest['clientId'].'"'); 
$clientData=mysqli_fetch_array($bc);


 $extramarkup=($packageData['extraMarkup']);

?>

<tr>
  <td align="left" valign="top"><?php echo $totalno; ?></td>
  <td align="left" valign="top"><?php echo stripslashes($restuser['firstName']); ?> <?php echo stripslashes($restuser['lastName']); ?></td>
  <td align="left" valign="top"><?php echo stripslashes($clientData['email']); ?></td>
  <td align="left" valign="top"><?php echo stripslashes($clientData['mobile']); ?></td>
  <td align="left" valign="top"><?php echo stripslashes($clientData['email']); ?></td>
  <td align="left" valign="top"><a href="display.html?ga=query&view=1&id=<?php echo encode($rest['id']); ?>" target="_blank"><?php echo encode($rest['id']); ?></a></td>
  <td align="left" valign="top" style="text-transform:uppercase;"><?php echo date('d-m-Y', strtotime($packageData['confirmDate'])); ?></td>
  <td align="left" valign="top" style="text-transform:uppercase;"><?php echo stripslashes($clientData['submitName']); ?> <?php echo stripslashes($clientData['firstName']); ?> <?php echo stripslashes($clientData['lastName']); ?></td>
  <td align="left" valign="top" style="text-transform:uppercase;"><?php
												$string = '';
										$string = preg_replace('/\.$/', '', $rest['destinationId']);  
										$array = explode(',', $string); 
										foreach($array as $value)  
										{ echo  getCityName($value);  }?></td>
  <td align="left" valign="top" style="text-transform:uppercase;"><?php echo $rest['adult']+$rest['child']+$rest['infant']; ?></td>
  <td align="left" valign="top" style="text-transform:uppercase;"><?php echo $packageData['grossPrice']; ?></td>
  <td align="left" valign="top" style="text-transform:uppercase;"><?php echo $totalFilght; ?></td>
  <td align="left" valign="top" style="text-transform:uppercase;"><?php echo $finalHotelCost; ?></td>
  <td align="left" valign="top" style="text-transform:uppercase;"><?php echo $totalTour; ?></td>
  <td align="left" valign="top" style="text-transform:uppercase;"><?php echo $totalVisa; ?></td>
  <td align="left" valign="top" style="text-transform:uppercase;"><?php echo $totalCruise; ?></td>
  <td align="left" valign="top" style="text-transform:uppercase;"><?php echo $totalbuying; ?></td>
  <td align="left" valign="top" style="text-transform:uppercase;"><?php echo round(($totalFilght+$finalHotelCost+$totalTour+$totalVisa+$totalCruise+$extramarkup)-$totalbuying); ?></td>
  <td align="left" valign="top" style="text-transform:uppercase;"><?php echo round($packageData['totaligst']+$packageData['totalsgst']+$packageData['totalcgst']); ?></td>
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
				
	
 