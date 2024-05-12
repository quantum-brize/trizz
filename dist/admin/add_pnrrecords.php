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
.roomratelist{font-size: 11px;
    font-weight: 500;
    text-align: center;
    padding: 2px;
    background-color: #f1f1f1; margin-bottom:1px;
	}
		.form-group { margin-bottom:5px; }
	.searchdestinationboxclass{background-color: #fff; box-shadow: 0px 0px 10px #00000017; border: 1px solid #DDD; z-index: 99999; position: absolute; width: 300px; top: 30px;}
	.searchdestinationboxclass .list{ padding:10px; font-size:14px; font-weight:600; border-bottom:1px solid #ddd; cursor:pointer;}
	.searchdestinationboxclass .list:hover{background-color:#f8f8f8;}
a:not([href]):not([tabindex]):focus, a:not([href]):not([tabindex]) { color: inherit; text-decoration: none; top: 30px; }
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
.content-wrapper .card-body{border-bottom: none !important; background-color: transparent !important;}
</style>
	
<?php include "libraryheader.php"; ?>

<div class="page-content pt-0">
<?php if($LoginUserDetails['userType']!='suppliers'){ include "hotelsettingsleft.php"; } ?>

		<!-- Main content -->
		<div class="content-wrapper">

  
			<div class="content">
			
  			<div class="card">

			<div class="card-footer d-flex justify-content-between" style="position:relative;">

				<span class="text-muted" style="font-weight:500; color:#000000 !important;font-size: 18px; font-weight: 700;"><i class="fa fa-plane" aria-hidden="true"></i> &nbsp;Add PNR</span>
 
			</div>

			

				 

<div class="row row-sm">
						<div class="col-lg-12"> 
									<div class="card-body" style="background-color: #fffee3; border-bottom: 1px solid #ddd;"> 
                                     
                              
									
									  
										<div>
										<form class="custom-validation" id="submitprofileform" action="<?php echo $fullurl; ?>frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data"  >	
                                    <div class=" ">
                                         
                                         
                                        <div class="">

                                <div class="col-md-12">

	<table >

		<tbody>

			<tr>
			  <td><div class="form-group">

    <label for="sector_id">From</label>
	<div style="height:0px; font-size:0px; position:relative; width: 100%; text-align: left;" id="searchcitylistsfromCity"></div>
	  <input type="text" onClick="$('#pickupCitySearchfromCity').select();" class="form-control" requered="" onKeyUp="getflightSearchCIty('pickupCitySearchfromCity','fromDestinationFlight','searchcitylistsfromCity');" id="pickupCitySearchfromCity" name="fromcitydesti" value="DEL - NEW DELHI" autocomplete="off">
	  <input name="fromDestinationFlight" id="fromDestinationFlight" type="hidden" value="DEL-India" autocomplete="nope">
</div></td>

				<td>

<div class="form-group">

    <label for="sector_id">To</label>
	
		<div style="height:0px; font-size:0px; position:relative; width: 100%; text-align: left;" id="searchcitylistsfromCity2"></div>
	<input type="text" onClick="$('#pickupCitySearchfromCity2').select();" class="form-control" requered="" onKeyUp="getflightSearchCIty('pickupCitySearchfromCity2','fromDestinationFlight2','searchcitylistsfromCity2');" id="pickupCitySearchfromCity2" name="tocitydesti" value="BOM - MUMBAI" autocomplete="off" >
	<input name="toDestinationFlight" id="fromDestinationFlight2" type="hidden" value="BOM-India" autocomplete="nope">
</div>				</td>

				<td>

<div class="form-group">

    <label for="airline_id">Airline</label>
<select name="airline_id" class="form-control">

<?php 

$air=GetPageRecord('*','sys_flightName','  status=1 order by iataCode desc');  
while($airline=mysqli_fetch_array($air)){

?> 
	<option value="<?php echo $airline["id"]; ?>" <?php if($airline['name']==$editresult['name']){ ?> selected="selected" <?php } ?>><?php echo $airline["iataCode"]; ?> <?php if($airline["iataCode"]!=''){?> - <?php }?><?php echo $airline["name"]; ?></option>

<?php } ?>

</select>
     
</div>				</td>

				<td>

<div class="form-group">

    <label for="flight_no">Flight No.</label>

    <input type="text" class="form-control" name="flight_no" id="flight_no" placeholder="Flight No." required="required">
</div>				</td>

				<td>

<div class="form-group">

    <label for="departure_time">Departure</label>

    <input type="time" class="form-control" name="departure_time" id="departure_time"  required="required">
</div>				</td>

				<td>

<div class="form-group">

    <label for="arrival_time">Arrival</label>

    <input type="time" class="form-control" name="arrival_time" id="arrival_time" required="required">
</div>				</td>

				<td>

<div class="form-group">

    <label for="route">Route</label>

    <select class="form-control" id="route" name="route">

		<option value="0">Non-Stop</option> 
		<option value="1">1 Stop</option>
		<option value="2">2 Stop</option>
		<option value="3">3 Stop</option>
	</select>
</div>				</td>
			</tr>
		</tbody>
	</table>

</div>





<div class="col-md-12">

	<table >

		<tbody>

			<tr>

				<td>

<div class="form-group">

    <label for="fromdate">From Date</label>

    <input type="text" class="form-control" name="fromdate" id="fromdate" placeholder="From Date" readonly="readonly" required="required">
</div>				</td>

				

				

				<td>

<div class="form-group">

    <label for="todate">To Date</label>

    <input type="text" class="form-control" name="todate" id="todate" placeholder="To Date" readonly="readonly" required="required">
</div>				</td>


<td>

<div class="form-group">

    <label for="todate">Terminal</label>

    <input type="text" class="form-control" name="terminal" placeholder="Terminal">
</div>				</td>


<td>

<div class="form-group">

    <label for="todate">Checkin Baggage</label>

    
	<select name="checkinBaggage" class="form-control">


	<option value="15 kg" <?php if('15 kg'==$editresult['checkinBaggage']){ ?> selected="selected" <?php } ?>> 15 kg</option>
	<option value="20 kg" <?php if('20 kg'==$editresult['checkinBaggage']){ ?> selected="selected" <?php } ?>> 20 kg</option>
	<option value="25 kg" <?php if('25 kg'==$editresult['checkinBaggage']){ ?> selected="selected" <?php } ?>> 25 kg</option>



</select>
	
</div>				</td>



<td>

<div class="form-group">

    <label for="todate">Cabin Baggage</label>

    <input type="text" class="form-control" name="cabinBaggage" placeholder="">
</div>				</td>

				<td>

<div class="form-group" style="padding-top: 8px; padding-left: 10px;">

 

		<button class="btn btn-success waves-effect waves-light" type="button" onClick="addRows();$('.savebtn').show();" style="margin-top: 20px; padding: 4px 10px; font-size: 13px; font-weight: 600; height: 32px; }">PROCEED</button>

	</label>
</div>				</td>
			</tr>
		</tbody>
	</table>

</div>


 
<div class="col-md-12">

	<table class="table table-hover" style="max-width: 690px; margin: auto; border: 1px solid #ddd; margin: 40px auto; float: left; margin-bottom:10px; margin-top:20px;">

		<tbody id="pnr_details">

			

		</tbody>

	</table>

</div>
	 
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> 
                              
                                                    <div class="form-group savebtn" style="display:none; float: left; width: 100%; max-width: 690px; margin-bottom: 20px;">
                                                        <button type="submit" class="btn btn-success waves-effect waves-light" style="float: right;"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save </button>
                                                    </div>
                                       


                                        </div>
									</div>
									
										<input type="hidden" name="action" value="addpnr">
</form>
									  
										</div>
						  </div> 
							</div>
							
							 
						</div>
						   
 
		</div>
 
</div>

</div>

 
  
  
  <script>
		
		
		
		function getflightSearchCIty(citysearchfield,cityresultfield,listsearch){
var citysearchfieldval = encodeURI($('#'+citysearchfield).val());  
var citysearchfield = citysearchfield;

if(citysearchfieldval!=''){  
$('#'+listsearch).show();
$('#'+listsearch).load('searchflightcitylists.php?keyword='+citysearchfieldval+'&searchcitylists='+listsearch+'&cityresultfield='+cityresultfield+'&citysearchfield='+citysearchfield);
}
}

function dateFormat(inputDate, format) {

    //parse the input date

    var date = new Date(inputDate);



    //extract the parts of the date

    var day = date.getDate();

    var month = date.getMonth() + 1;

    var year = date.getFullYear();    



    //replace the month

    format = format.replace("MM", month.toString().padStart(2,"0"));        



    //replace the year

    if (format.indexOf("yyyy") > -1) {

        format = format.replace("yyyy", year.toString());

    } else if (format.indexOf("yy") > -1) {

        format = format.replace("yy", year.toString().substr(2,2));

    }



    //replace the day

    format = format.replace("dd", day.toString().padStart(2,"0"));



    return ""+format+"";

}





function getDates(days){

	

	var fromdate=$("#fromdate").val();

	

	var date1 = new Date(fromdate);

	

	var result = new Date(date1);

	result.setDate(result.getDate() + days);

	

	var dd=result.toLocaleString();

	

	var ddd=dd.split(',')[0];

	

	//return ddd;

	return dateFormat(ddd, 'dd-MM-yyyy');

}











function addRows(){

	

	$("#pnr_details").empty();

	

	var fromdate=$("#fromdate").val(); 
	var todate=$("#todate").val(); 
	

	var date1 = new Date(fromdate); 
	var date2 = new Date(todate); 
  
 
var Difference_In_Time = date2.getTime() - date1.getTime();

// To calculate the no. of days between two dates

var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);





	for(var i=0; i<Difference_In_Days+1; i++){

		

		//getDates(i);

		

		var tblRows='<tr id="row_'+i+'"><td width="30%" class="d-none"><div class="form-group"><label for="travel_date">Travel Date</label><input type="text" class="form-control date" name="travel_date[]" id="travel_date_'+i+'" value="'+getDates(i)+'" placeholder="MM-dd-yyyy" required="required" readonly="readonly"></div></td><td width="20%"><div class="form-group"><label for="pnr">PNR</label><input type="text" class="form-control" name="pnr[]" id="pnr_'+i+'" placeholder="PNR" required="required"></div></td><td width="15%"><div class="form-group"><label for="qty">Qty</label><input type="number" class="form-control" name="qty[]" id="qty_'+i+'" placeholder="Quantity" required="required"></div></td><td width="15%"><div class="form-group"><label for="fare">Fare</label><input type="number" class="form-control" name="fare[]" id="fare_'+i+'" placeholder="Fare" required="required"></div></td><td width="5%"><div class="form-group" id="remove_div_'+i+'"><a id="'+i+'" class="" href="javascript:void(0)" onclick="removeRow(this.id)"><i class="fa fa-trash" aria-hidden="true" style="color: #f00; font-size: 24px; margin-top: 22px; margin-left: 10px;"></i></img></a></div></td></tr>';



		$("#pnr_details").append(tblRows);

	}

}



function removeRow(id){

	$("#row_"+id).remove();

}













$(function () {

		$("#fromdate").datepicker({

			changeMonth: true, 

			changeYear: true, 

			dateFormat: 'yy-mm-dd',

			minDate: 0, // 0 days offset = today

			numberOfMonths: 1,

			onSelect: function (selected) {

				var dt = new Date(selected);

				dt.setDate(dt.getDate() + 0);

				$("#todate").datepicker("option", "minDate", dt);

			}

		});

		$("#todate").datepicker({

			changeMonth: true, 

			changeYear: true, 

			dateFormat: 'yy-mm-dd',

			minDate: 0, // 0 days offset = today

			numberOfMonths: 1,

			onSelect: function (selected) {

				var dt = new Date(selected);

				$("#fromdate").datepicker("option", "maxDate", dt);

			}

		});

	});

 

	$(function(){

		$(".date").datepicker({

			dateFormat: "yy-mm-dd"

		});

	});

	

	

	$(function(){

		$(".date1").datepicker({

			dateFormat: "yy-mm-dd",

			minDate: 0

		});

	});

</script>