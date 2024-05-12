<?php 
   if($_REQUEST['fromdate']!='' && $_REQUEST['todate']!=''){
   
    $fromdate=$_REQUEST['fromdate'];
    $todate=$_REQUEST['todate'];
   
   } else {
   // $fromdate=date('d-m-Y', strtotime("-30 days"));
   // $todate=date('d-m-Y'); 
   }
   
   ?>
<style>
.content-wrapper .table-bordered .form-control{padding: 10px 5px !important;}
.content-wrapper table tr td{padding: 2px !important;}
.content-wrapper .table-bordered .form-select{padding: 10px 5px !important;}
   .roomratelist{font-size: 11px;
   font-weight: 500;
   text-align: center;
   padding: 2px;
   background-color: #f1f1f1; margin-bottom:1px;
   }
   /* .table tr td{width: 6%;} */
   .table tr td input{width: 100%;text-align: center;}
   .table tr td select{padding: 3px;}
   .page-content{margin-top:60px; margin-left:80px;}
	.srchbtn2{height: 37px;}
	.page-content .card-footer{border-top: none;background-color: #dddddd80;border-top-left-radius: 6px;border-top-right-radius: 6px;}
	.content-wrapper .card {
    margin-bottom: 1.25rem;
    box-shadow: 0 0.25rem 1.125rem rgba(75,70,92,.1) !important;
    border: 0px;
    border-radius: 10px;
	width:99%;
}
.content-wrapper .card-body{border-bottom: none !important; background-color: transparent !important; padding: 15px 5px !important;}
</style>


<style>

	.searchdestinationboxclass{background-color: #fff; box-shadow: 0px 0px 10px #00000017; border: 1px solid #DDD; z-index: 99999; position: absolute; width: 300px; top: 30px;}
	.searchdestinationboxclass .list{ padding:10px; font-size:14px; font-weight:600; border-bottom:1px solid #ddd; cursor:pointer;}
	.searchdestinationboxclass .list:hover{background-color:#f8f8f8;}
a:not([href]):not([tabindex]):focus, a:not([href]):not([tabindex]) { color: inherit; text-decoration: none; top: 30px; }
.content-wrapper .table thead th{padding: 10px 5px !important;}
</style>
<?php include "libraryheader.php"; ?>
<div class="page-content pt-0">
<?php if($LoginUserDetails['userType']!='suppliers'){ include "hotelsettingsleft.php"; } ?>
<!-- Main content -->
<div class="content-wrapper">
   <div class="content">
      <div class="card">
         <div class="card-footer d-flex justify-content-between" style="position:relative;">
            <span class="text-muted" style="font-weight:500; color:#000000 !important; "><i class="fa fa-plane" aria-hidden="true"></i> &nbsp;Fare Management</span>
         </div>
         <div class="card-body">
            <form method="get" id="searchform">
               <div class="row">
                  <input name="ga" type="hidden" value="<?php echo $_REQUEST['ga']; ?>" />
                  <input name="stage" type="hidden" value="<?php echo $_REQUEST['stage']; ?>" />
                  <div class="col-xl-12 col-sm-12">
                     <div class="input-group" style="padding-left:8px;">
            <form method="get" action="">
            <table>
            <tbody>
            <tr>
            <td valign="top">
            <div>
            <input type="text" id="fromdate" name="fromdate" class="form-control" placeholder="From Date" value="<?php echo $_REQUEST['fromdate']; ?>"  readonly>
            </div>				</td>
            <td valign="top">
            <div>
            <input type="text" id="todate" name="todate" class="form-control" placeholder="To Date"  value="<?php echo $_REQUEST['todate']; ?>" readonly>
            </div>				</td>
			
			 <td valign="top">
            <div>
            <input type="text" id="fromdesti" name="fromdesti" class="form-control" placeholder="From Destination" value="<?php echo $_REQUEST['fromdesti']; ?>"  >
            </div>				</td>
            <td valign="top">
            <div>
            <input type="text" id="todesti" name="todesti" class="form-control" placeholder="To Destination"  value="<?php echo $_REQUEST['todesti']; ?>" >
            </div>				</td>
			
            <td  valign="top">
            <div>
            <input type="text" class="form-control" name="keyword" id="pnr" placeholder="keyword" value="<?php echo $_REQUEST["keyword"]; ?>">
            </div>				</td>
			
			
            <td  valign="top">
            <button class="btn btn-primary btn-with-icon btn-block srchbtn2" type="submit">Search</button>	<input type="hidden" name="ga" value="<?php echo $_REQUEST['ga']; ?>" />		</td>
            </tr>
            </tbody>
            </table>
            </form>
            </div>
            </div>
            </div>
            </form>										
         </div>
         <div class="row row-sm">
            <div class="col-lg-12">
               <div class="card-body" style=" overflow:hidden;">
                  <div class="table-responsive">
				  <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm" style="padding:0px 10px 20px;">
                     <table class="table table-bordered table-hover">
                        <thead>
                           <tr>
                              <th width="10%">
                                 <div align="center">Date</div>
                              </th>
                              <th align="center" width="13%">
                                 <div align="center">From</div>
                              </th>
                              <th align="center" width="13%">
                                 <div align="center" >To</div>
                              </th>
                              <th align="center" width="10%">
                                 <div align="center">Airline</div>
                              </th>
                              <th width="6%" align="center">
                                 <div align="center"><strong>Flight&nbsp;No.</strong></div>
                              </th>
                              <th width="6%">
                                 <div align="center"><strong>Dep</strong></div>
                              </th>
                              <th width="6%">
                                 <div align="center"><strong>Arr</strong></div>
                              </th>
                              <th width="6%">
                                 <div align="center"><strong>PNR</strong></div>
                              </th>
                              <th width="4%">
                                 <div align="center"><strong>Seat</strong></div>
                              </th>
                              <th width="4%">
                                 <div align="center">Sold</div>
                              </th>
                              <th width="4%">
                                 <div align="center">Cancel</div>
                              </th>
                              <th width="4%">
                                 <div align="center"><strong>Block</strong></div>
                              </th>
                              <th width="6%">
                                 <div align="center"><strong>Fare</strong></div>
                              </th>
                              <th width="4%">
                                 <div align="center">Available</div>
                              </th>
                              <th width="6%">
                                 <div align="center">Status</div>
                              </th>
							  <th width="6%">
                                 <div align="center">Action</div>
                              </th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                              $limit=clean($_GET['records']);
                              
                              $page=clean($_GET['page']); 
                              
                              $sNo=1; 
                              
                              $search='';
                               
                              if($_REQUEST['fromdate']!='' && $_REQUEST['todate']!=''){
                              	$search.='and travel_date BETWEEN "'.date('Y-m-d',strtotime($_REQUEST["fromdate"])).'" and "'.date('Y-m-d',strtotime($_REQUEST["todate"])).'"';
                              } 
							  
							  if($_REQUEST['fromdesti']!='' && $_REQUEST['todesti']!=''){
                              	$search.=' and flight_id in (select id from fixdeparture_flight where fromDestination like "%'.$_REQUEST['fromdesti'].'%") and flight_id in (select id from fixdeparture_flight where toDestination like "%'.$_REQUEST['todesti'].'%") or flight_id in (select id from fixdeparture_flight where fromCode like "%'.$_REQUEST['fromdesti'].'%") and flight_id in (select id from fixdeparture_flight where toCode like "%'.$_REQUEST['todesti'].'%")';
                              }
                              
                              if($_REQUEST['keyword']!=''){
                              	$search.=' and pnr="'.$_REQUEST['keyword'].'" or flight_id in (select id from fixdeparture_flight where airline_id in (select id from sys_flightName where name like "%'.$_REQUEST['keyword'].'%")) ';
                              }
							 
                              $search.='  and addedBy="'.$_SESSION['userid'].'"';
                              
                              $targetpage=$fullurl.'display.html?ga=faremanagement&sector_id='.$_REQUEST['sector_id'].'&date_type='.$_REQUEST['date_type'].'&fromdate='.$_REQUEST['fromdate'].'&todate='.$_REQUEST['todate'].'&pnr='.$_REQUEST['pnr'].'&keyword='.$_REQUEST['keyword'].'&';
                               
                              $rs=GetRecordList('*','pnr_details','where 1 '.$search.' '.$searchFlight.'  order by travel_date asc','100',$page,$targetpage); 
                              
                              $totalentry=$rs[1]; 
                              
                              $paging=$rs[2];  
                              
                              while($rest=mysqli_fetch_array($rs[0])){
                              
                              $flight=GetPageRecord('*','fixdeparture_flight','1 and id="'.$rest["flight_id"].'"');
                              
                              $flightData=mysqli_fetch_array($flight);
                              
                              /*Cancelled*/
                              
                              $total=($rest["qty"]-($rest["block"]));
                              
                              $flight=GetPageRecord('*','fixdeparture_flight','1 and id="'.$rest["flight_id"].'"'); 
                              $flightData=mysqli_fetch_array($flight);
                              
                              $airlineid=GetPageRecord('*','sys_flightName','1 and id="'.$flightData["airline_id"].'"  '); 
                              $airlinename=mysqli_fetch_array($airlineid);
                              
                              $airlineidsold=GetPageRecord('count(id) as totalsold','flightBookingMaster','status=2 and fdFlightId="'.$rest["id"].'"'); 
                              $finalsold=mysqli_fetch_array($airlineidsold);
                              
                              $airlineidcancel=GetPageRecord('count(id) as totalcancel','flightBookingMaster','status=3 and fdFlightId="'.$rest["id"].'"'); 
                              $finalcancel=mysqli_fetch_array($airlineidcancel);
                           ?>
                           <tr>
                              <td><input type="text" class="text-muted form-control"  readonly="" name="travel_date" id="travelDate<?php echo $rest['id']; ?>" value="<?php echo date("d-m-Y",strtotime($rest['travel_date'])); ?>"  /></td>
							  
                              <td>
                               <div style="height:0px; font-size:0px; position:relative; width: 100%; text-align: left;" id="searchcitylistsfromCity<?php echo $rest['flight_id']; ?>"></div>	
							   						  
							  <input text="text" class="form-control text-muted" readonly="" name="fromDestination" id="pickupCitySearchfromCity<?php echo $rest['flight_id']; ?>" value="<?php  echo ($flightData["fromCode"]); ?> - <?php echo ($flightData["fromDestination"]); ?>" onClick="$('#pickupCitySearchfromCity<?php echo $rest['flight_id']; ?>').select();" onKeyUp="getflightSearchCIty('pickupCitySearchfromCity<?php echo $rest['flight_id']; ?>','fromDestinationFlight<?php echo $rest['flight_id']; ?>','searchcitylistsfromCity<?php echo $rest['flight_id']; ?>');"  /> 
							    <input name="fromDestinationFlight" id="fromDestinationFlight" type="hidden" value="DEL-India" autocomplete="nope">
							  </td>
							  
							  
                              <script>
                                 $(function(){
                                     $( "#travelDate<?php echo $rest['id'];?>" ).datepicker({ dateFormat: 'dd-mm-yy' });
                                   });
                              </script>
							  
                              <td>
							  	  <div style="height:0px; font-size:0px; position:relative; width: 100%; text-align: left;" id="searchcitylistsfromCity2<?php echo $rest['flight_id']; ?>"></div>
								  
							  <input type="text" class="form-control text-muted" readonly="" name="toDestination" id="pickupCitySearchfromCity2<?php echo $rest['flight_id']; ?>" value="<?php  echo ($flightData["toCode"]); ?> - <?php echo ($flightData["toDestination"]); ?>" onClick="$('#pickupCitySearchfromCity2<?php echo $rest['flight_id']; ?>').select();" onKeyUp="getflightSearchCIty('pickupCitySearchfromCity2<?php echo $rest['flight_id']; ?>','fromDestinationFlight2<?php echo $rest['flight_id']; ?>','searchcitylistsfromCity2<?php echo $rest['flight_id']; ?>');"  />
							  
							  	<input name="toDestinationFlight" id="fromDestinationFlight2" type="hidden" value="BOM-India" autocomplete="nope">

							  </td>
							  
                              <td>
	
							  <select name="airline_id"  id="airline_id<?php echo $rest['flight_id']; ?>" class="form-control">

<?php 

$air=GetPageRecord('*','sys_flightName','  status=1 ');  
while($airlinename=mysqli_fetch_array($air)){

?> 
	<option value="<?php echo $airlinename["id"]; ?>" <?php if($airlinename['id']==$flightData['airline_id']){ ?> selected="selected" <?php } ?>><?php echo $airlinename["iataCode"]; ?> <?php if($airlinename["iataCode"]!=''){?> - <?php }?><?php echo $airlinename["name"]; ?></option>

<?php } ?>

</select>
							  </td>
							  
                              <td align="center"><input text="text" class="form-control" name="flight_no" id="flight_no<?php echo $rest['flight_id']; ?>"  value="<?php echo $flightData['flight_no']; ?>"  /></td>
							  
                              <td><div align="center"><input type="time" name="departure_time" id="departure_time<?php echo $rest['flight_id']; ?>" class="form-control" value="<?php echo $flightData['departure_time']; ?>"/></div></td>
						
                              <td>
                                 <div align="center"> <input type="time" name="arrival_time" id="arrival_time<?php echo $rest['flight_id']; ?>" class="form-control" value="<?php echo $flightData['arrival_time']; ?>"  /></div>
                              </td>
						
								 
                              <td>
                                 <div align="center"> <input class="form-control" type="text" name="pnr_no"  id="pnrNo<?php echo $rest['id']; ?>" value="<?php if($rest['pnr']!=""){ echo $rest['pnr'];}else{echo "---";} ?>"    /></div>
                              </td>
							   
                          
                              <td>
                                 <div align="center"> <input class="form-control" type="text" name="qty" id="qty<?php echo $rest['id']; ?>" value="<?php echo $rest['qty']; ?>" /></div>
                              </td>
                              <td>
                                 <div align="center"><input class="form-control" name="totalsold" type="text" value="<?php echo $finalsold['totalsold']; ?>" /></div>
                              </td>
                              <td>
                                 <div align="center"><input class="form-control" type="text" name="totalcancel" value="<?php echo $finalcancel['totalcancel']; ?>" /></div>
                              </td>
                         
                              <td>
                                 <div align="center"><input class="form-control" type="text" name="block" id="block<?php echo $rest['id']; ?>" value="<?php echo $rest['block']; ?>"/></div>
                              </td>
                
                              <td>
                                 <div align="center"><input class="form-control" name="fare" id="fare<?php echo $rest['id']; ?>" type="text" value="<?php echo $rest['fare']; ?>" /></div>
                              </td>
							  
                              <td>
                                 <div align="center"><input type="text" class="text-muted form-control" value="<?php echo ($total-$finalsold['totalsold']-$finalcancel['totalcancel']); ?>" readonly/></div>
                              </td>
                              <td style="width: 8%;">
                                 <div align="center">
                                    <select name="is_approve" id="is_approve<?php echo $rest['id']; ?>" class="form-control" >
                                       <option value="0" <?php if($rest['is_approve']==0){ ?> selected="selected" <?php } ?>>Deactive</option>
									   <option value="1" <?php if($rest['is_approve']==1){ ?> selected="selected" <?php } ?>>Activate</option>
                                    </select>
                                 </div>
                              </td>
							  
							  <td>
                                 <div align="center">
								   <input type="hidden" name="id" value="<?php echo $rest['id']; ?>" />
								   <button type="submit" class="btn btn-success" id="Save" onclick="flightDataSave('<?php echo $rest['id']; ?>'),flightDepartureSave('<?php echo $rest['id']; ?>','<?php echo $rest['flight_id']; ?>'),changeStatus('<?php echo $rest['id']; ?>')">Save</button>
								 </div>
                              </td>
							  
							  
                           </tr>
                           <?php } ?>
                        </tbody>
                     </table>
					
					 </form>
                  </div>
                  <?php if($totalno==1){ ?>
                  <div style="text-align:center; padding:40px 0px; font-size:14px; color:#999999;">No Data </div>
                  <?php } else { ?>
                  <div class="mt-3 pageingouter">
                     <div style="float: left; font-size: 13px; padding: 7px 11px; border: 1px solid #ededed; background-color: #fff; color: #000;">Records: <strong><?php echo $totalentry; ?></strong></div>
                     <div class="pagingnumbers"><?php echo $paging; ?></div>
                  </div>
                  <?php } ?>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<div id="flightSave" style="display:none;"></div>

<script>
   $( function() {
     $( "#fromdate" ).datepicker({ dateFormat: 'dd-mm-yy' });
     $( "#todate" ).datepicker({ dateFormat: 'dd-mm-yy' });
   });
</script>

<script>
 function flightDataSave(id){ 
   var travelDate = $('#travelDate'+id).val();
   var pnrNo = $('#pnrNo'+id).val();
   var fare = $('#fare'+id).val();
   var block = $('#block'+id).val();
   var qty = $('#qty'+id).val();
   var flight_no = $('#flight_no'+id).val();
   	 $('#flightSave').load('actionpage.php?action=savepnrdata&travelDate='+travelDate+'&pnrNo='+pnrNo+'&fare='+fare+'&block='+block+'&qty='+qty+'&id='+id);
 }
</script>

<script>
  function flightDepartureSave(id,fid){ 
	var flight_no = encodeURI($('#flight_no'+fid).val());
	 var airline_id = $('#airline_id'+fid).val();
	  var departure_time = $('#departure_time'+fid).val();
	   var arrival_time = $('#arrival_time'+fid).val();
	    var fromDestination = $('#pickupCitySearchfromCity'+fid).val();
		var toDestination = $('#pickupCitySearchfromCity2'+fid).val();
		// var fromCode = $('#pickupCitySearchfromCity .fromCode'+fid).val();
		// var toCode = $('#pickupCitySearchfromCity2 .toCode'+fid).val();
		// alert(fromDestination);
   		$('#flightSave').load('actionpage.php?action=saveDepartureData&flight_no='+flight_no+'&airline_id='+airline_id+'&departure_time='+departure_time+'&arrival_time='+arrival_time+'&fromDestination='+fromDestination+'&toDestination='+toDestination+'&id='+id+'&fid='+fid);
    }
</script>

<script>
	function changeStatus(id){
		var is_approve = $('#is_approve'+id).val();  
		$('#flightSave').load('actionpage.php?action=changeflightstatus&id='+id+'&is_approve='+is_approve);
	}
</script>


<script>
		
function getflightSearchCIty(citysearchfield,cityresultfield,listsearch){
var citysearchfieldval = encodeURI($('#'+citysearchfield).val());  
var citysearchfield = citysearchfield;

if(citysearchfieldval!=''){  
$('#'+listsearch).show();
$('#'+listsearch).load('searchflightcitylists.php?keyword='+citysearchfieldval+'&searchcitylists='+listsearch+'&cityresultfield='+cityresultfield+'&citysearchfield='+citysearchfield);
}
}



</script>