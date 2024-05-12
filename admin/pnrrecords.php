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

</style>
	
<?php include "libraryheader.php"; ?>

<div class="page-content pt-0">
<?php if($LoginUserDetails['userType']!='suppliers'){ include "hotelsettingsleft.php"; } ?>

		<!-- Main content -->
		<div class="content-wrapper">

  
			<div class="content">
			
  			<div class="card">
			
			<div class="card-footer d-flex justify-content-between" style="position:relative;"> 


<span class="text-muted" style="font-weight:500; color:#000000 !important;"><i class="fa fa-plane" aria-hidden="true"></i> PNR Records</span>


<a href="display.html?ga=pnrrecords&add=1"><span  class="badge bg-blue dropdown-toggle caret-0" style="background-color: #0cb5b5; position: absolute; right: 15px; top: 13px; font-size: 12px; cursor: pointer;" >Add PNR</span> </a>
</div>


<div style="padding:10px; width:100%; border-bottom:1px solid #ddd;border-bottom: none;">
<div class="row">
<div class="row">
<form method="get" action="">

	<table  style=" max-width: 100%; margin-left: 30px; margin-bottom: 20px;">

		<tbody>

			<tr>
			  <td width="10%" valign="top">

<div>

    <select class="form-control" id="date_type" name="date_type"> 

		<option value="1" <?php if($_REQUEST["date_type"]==1){ ?>selected="selected"<?php } ?>>Travel date</option>

		<option value="2" <?php if($_REQUEST["date_type"]==2){ ?>selected="selected"<?php } ?>>Entry date</option>
	</select>
</div>				</td>

				

				<td width="10%" valign="top">

<div>

    <input type="text" id="fromdate" name="fromdate" class="form-control" placeholder="From Date" value="<?php echo $_REQUEST['fromdate']; ?>"  readonly >
</div>				</td>

				

				<td width="10%" valign="top">

<div>

    <input type="text" id="todate" name="todate" class="form-control" placeholder="To Date"  value="<?php echo $_REQUEST['todate']; ?>" readonly>
</div>				</td>

				

				

				<td width="10%" valign="top">

<div>

    <input type="text" class="form-control" name="pnr" id="pnr" placeholder="PNR" value="<?php echo $_REQUEST["pnr"]; ?>">
</div>				</td>

				
 

				<td width="10%" valign="top">
<input type="hidden" name="ga" value="<?php echo $_REQUEST['ga']; ?>" /><button class="btn btn-primary btn-with-icon btn-block srchbtn2" type="submit">Search</button>				</td>
			</tr>
		</tbody>
	</table>
<input name="ga" type="hidden" id="ga" value="<?php echo $_REQUEST['ga']; ?>" />
</form>
 </div>

</div>


<div class="nocsstable">
<table class="table table-bordered table-hover">

    <thead>

      <tr>

        <th>Travel Date</th>

        <th>From</th>
        <th>To</th>

        <th>Dep</th>

        <th>Arv</th>

        <th>Airline</th>
        <th><div align="center">Flight No</div></th>

        <th><div align="center"> Route</div></th>

        <th>Qty</th>
        <th bgcolor="#F8FFDD"><div align="center">PNR</div></th>
        <th><div align="center">Status</div></th>

        <th align="left"><div align="left">Add</div></th>

	    <?php if($_SESSION["userType"]==0){ ?>

		<?php } ?>
      </tr>
    </thead>

    <tbody>

<?php

$limit=clean($_GET['records']);

$page=clean($_GET['page']); 

$sNo=1; 



$search='';


 


if($_REQUEST['date_type']!='' && $_REQUEST['fromdate']!='' && $_REQUEST['todate']!=''){

	if($_REQUEST['date_type']=='1'){

		$search.='and travel_date BETWEEN "'.date('Y-m-d',strtotime($_REQUEST["fromdate"])).'" and "'.date('Y-m-d',strtotime($_REQUEST["todate"])).'"';

	}

	

	if($_REQUEST['date_type']=='2'){

		$search.='and addedDate BETWEEN "'.date('Y-m-d',strtotime($_REQUEST["fromdate"])).'" and "'.date('Y-m-d',strtotime($_REQUEST["todate"])).'"';

	}

}



if($_REQUEST['pnr']!=''){

	$search.=' and pnr="'.$_REQUEST['pnr'].'"';

}





if($_REQUEST['keywords']!=''){

	$search.=' and pnr like "%'.$_REQUEST['keywords'].'%" or qty like "%'.$_REQUEST['keywords'].'%" or addedBy in (select id from sys_usermaster where firstName like "%'.$_REQUEST['keywords'].'%")';

}





if($_REQUEST['keywords']=='' && $_REQUEST['pnr']=='' && $_REQUEST['fromdate']=='' && $_REQUEST['todate']=='' && $_REQUEST['sector_id']==''){

	$search.='and travel_date>="'.date("Y-m-d").'"';

}





$targetpage=$fullurl.'display.html?ga=pnrrecords?sector_id='.$_REQUEST['sector_id'].'&date_type='.$_REQUEST['date_type'].'&fromdate='.$_REQUEST['fromdate'].'&todate='.$_REQUEST['todate'].'&pnr='.$_REQUEST['pnr'].'&keywords='.$_REQUEST['keywords'].'&';



if($_SESSION["userType"]==0){

	$search.='';

}else{

	//$search.='and addedBy="'.$_SESSION["userid"].'"';

}
 

$rs=GetRecordList('*','pnr_details','where 1 '.$search.' and addedBy="'.$_SESSION['userid'].'" order by travel_date asc','100',$page,$targetpage); 

$totalentry=$rs[1]; 

$paging=$rs[2];  

while($rest=mysqli_fetch_array($rs[0])){



//Flight Info

$flight=GetPageRecord('*','fixdeparture_flight','1 and id="'.$rest["flight_id"].'"'); 
$flightData=mysqli_fetch_array($flight);

$airlineid=GetPageRecord('*','sys_flightName','1 and id="'.$flightData["airline_id"].'"'); 
$airlinename=mysqli_fetch_array($airlineid);





//Supplier Info

 

?>

      <tr>

        <td><?php echo date("d M Y",strtotime($rest['travel_date'])); ?></td>

		<td><?php  echo ($flightData["fromCode"]); ?>-<?php  echo ($flightData["fromDestination"]); ?></td>
		<td><?php  echo ($flightData["toCode"]); ?>-<?php  echo ($flightData["toDestination"]); ?></td>

        <td><?php echo $flightData['departure_time']; ?></td>

        <td><?php echo $flightData['arrival_time']; ?></td>

        <td><?php  echo ($airlinename["name"]); ?></td>
        <td><div align="center"><?php echo $flightData['flight_no']; ?></div></td>

        <td><div align="center">
		  <?php if($flightData['route']=="0"){echo "Non-Stop";} else { echo $flightData['route'].' Stop(s)';}?>
		  </div></td>

        <td><div align="center"><?php echo $rest['qty']; ?></div></td>
        <td bgcolor="#F8FFDD"><div align="center"><strong><?php echo $rest['pnr']; ?></strong></div></td>
        <td>



			

				
				<div align="center">
				  <?php if($rest['is_approve']==0){ ?>
				  
				  <span class="badge badge-danger"  >Pending </span>
				  
				      <?php } else { ?>
					  <span class="badge badge-success"  >Approved </span>
					  <?php } ?>
				      </div></td>

		<td align="left">

 
				  
				    <?php echo date('d-m-Y h:i A',strtotime($rest['addedDate'])); ?>				       </td>

		<?php if($_SESSION["userType"]==0){ ?>

			<?php } ?>
      </tr>

<?php } ?>
    </tbody>
  </table>
						
						<div class="card-footer text-right" style="overflow:hidden;">
		 
										<div style="float: left; font-size: 13px; padding: 7px 11px; border: 1px solid #ededed; background-color: #fff; color: #000;">Total Records: <strong><?php echo $totalentry; ?></strong></div>
											<div class="pagingnumbers"><?php echo $paging; ?></div>
											
						 
			  </div>
			  </div>
</div>



</div>
 
</div>

</div>

 			<script>

		$( function() {

    $( "#fromdate" ).datepicker({ dateFormat: 'dd-mm-yy' });

    $( "#todate" ).datepicker({ dateFormat: 'dd-mm-yy' });

  } );

  </script>