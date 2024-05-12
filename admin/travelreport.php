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
    vertical-align: top;
}
.statusbox{margin-right: 5px; padding: 10px; text-align: center; background-color: #000000; font-size: 13px; color: #fff; border-radius: 4px; text-transform:uppercase;}
</style>
<div class="wrapper">
<div class="container-fluid">
<div class="main-content">

                <div class="page-content">

      <div class="newboxheading"><div class="newhead">Tours Report<div class="newoptionmenu">
  <form  action=""    method="get" enctype="multipart/form-data">	
								<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><input type="text" class="form-control" id="startDate" name="startDate" readonly="" placeholder="From" value="<?php echo $startDate; ?>" style="width:130px;"></td>
    <td style="padding-left:5px;"><input type="text" class="form-control" id="endDate" name="endDate" readonly="" placeholder="From" value="<?php echo $endDate; ?>" style="width:130px;"></td>
    <td style="padding-left:5px;"><input type="text" name="keyword" class="form-control"  placeholder="Search by name, email, mobile"  value="<?php echo $_REQUEST['keyword']; ?>" style=" width:150px;">
								  <input name="page" type="hidden" value="<?php echo $_REQUEST['page']; ?>" /><input name="ga" type="hidden" value="<?php echo $_REQUEST['ga']; ?>" />						    </td>
    <td style="padding-left:5px;"><select name="searchcity" class="form-control"  style="width:130px;">
  <option value="" >All Destinations</option>
  <?php  

$rs22=GetPageRecord('*','queryMaster','  fromCity!="" and destinationId in (select id from cityMaster) group by destinationId order by id desc'); 
while($restuser=mysqli_fetch_array($rs22)){ 

$a=GetPageRecord('*','cityMaster',' 1 and id="'.$restuser['destinationId'].'" ');  
$resultcityname=mysqli_fetch_array($a);
?>
  <option value="<?php echo $restuser['destinationId']; ?>" <?php if($restuser['destinationId']==$_REQUEST['searchcity']){ ?>selected="selected"<?php } ?>><?php echo $resultcityname['name']; ?></option>
  <?php } ?>
</select></td>
   <?php  if($LoginUserDetails['userType']==0){ ?> <td style="padding-left:5px;"><select name="searchusers" class="form-control"  style="width:130px;">
  <option value="" >All Users</option>
  <?php  

$rs22=GetPageRecord('*','sys_userMaster',' 1  order by firstName desc'); 
while($restuser=mysqli_fetch_array($rs22)){ 
 
?>
  <option value="<?php echo $restuser['id']; ?>" <?php if($restuser['id']==$_REQUEST['searchusers']){ ?>selected="selected"<?php } ?>><?php echo stripslashes($restuser['firstName']); ?> <?php echo stripslashes($restuser['lastName']); ?></option>
  <?php } ?>
</select></td><?php } ?>
    <td style="padding-left:5px;"><button type="submit" class="btn btn-secondary btn-lg waves-effect waves-light" style="padding: 6px 10px;"  ><i class="fa fa-search" aria-hidden="true"></i> Search</button></td>
    <td>&nbsp;</td>
    <td>
	<?php if($_REQUEST['cal']==0){ ?>
	<a href="display.html?ga=travelreport&cal=1"><button type="button" class="btn btn-secondary btn-lg waves-effect waves-light" style="padding: 6px 10px;"  ><i class="fa fa-calendar" aria-hidden="true"></i> Calendar View</button></a>
<?php } else { ?>
<a href="display.html?ga=travelreport&cal=0"><button type="button" class="btn btn-secondary btn-lg waves-effect waves-light" style="padding: 6px 10px;"  ><i class="fa fa-list" aria-hidden="true"></i> List View</button></a>
<?php } ?>	
	</td>
  </tr>
</table>
  </form>
 </div>
 </div>     
 
     
</div>
                    
                    <!-- start page title -->
                     
              
                        <div class="">
                        <div class="col-md-12 col-xl-12" style="padding-top:45px;">
						<div class="card" style="min-height:500px; overflow:hidden;">
                            <div class="card-body" style="padding:0px;"> 
                                      
							  
							  
							  
							  
							  
							  <?php if($_REQUEST['cal']!=1){ ?>
							  <div style="margin-bottom:0px; padding:10px;">
							  <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="33%" align="left" valign="top"><div class="statusbox" style="background-color:#655be6;"><div style="margin-bottom: 0px; font-size: 30px; line-height: 38px;"><?php $ba=GetPageRecord('count(id) as totaltours','sys_packageBuilder',' confirmQuote=1 '.$whereintotal.' and queryId in (select id from queryMaster where statusId!=7) '.$clientsearch.' '.$clientsearch.' '.$searchcity.'' ); $packagecost=mysqli_fetch_array($ba); echo  ($packagecost['totaltours']); ?>
	
	</div>
    Total Tours</div></td>
    <td width="33%" align="left" valign="top"><div class="statusbox" style="background-color:#0cb5b5;">
      <div style="margin-bottom: 0px; font-size: 30px; line-height: 38px;"><?php $ba=GetPageRecord('count(id) as compleatedtours','sys_packageBuilder',' confirmQuote=1 '.$whereintotal.' and endDate<"'.date('Y-m-d').'" and queryId in (select id from queryMaster where statusId!=7)  '.$clientsearch.' '.$clientsearch.' '.$searchcity.' '); $packagecostrecived=mysqli_fetch_array($ba); echo ($packagecostrecived['compleatedtours']); ?></div>
      Compleated Tours</div></td>
     
    <td width="33%" align="left" valign="top"><div class="statusbox" style="background-color:#e45555; margin-right:0px;">
      <div style="margin-bottom: 0px; font-size: 30px; line-height: 38px;"><?php $ba=GetPageRecord('count(id) as upcomingtours','sys_packageBuilder',' confirmQuote=1 '.$whereintotal.' and endDate>"'.date('Y-m-d').'" and queryId in (select id from queryMaster where statusId!=7)  '.$clientsearch.' '.$clientsearch.' '.$searchcity.' '); $packagecostrecived=mysqli_fetch_array($ba); echo ($packagecostrecived['upcomingtours']); ?></div>
      Upcoming Tours</div></td>
    </tr>
</table>

							  </div>
							  
                                       
                                         
                           
						   
						   
						   <table class="table table-hover mb-0" style="border:1px solid #ddd;">

                                            <thead>
                                                <tr>
                                                  <th>Query ID </th>
                                                  <th>Package</th>
                                                  <th>Client</th>
                                                  <th>Status</th>
                                                  <th>Assigned</th>
                                                </tr>
                                            </thead>
<tbody> 
<?php

$totalno=1;

$where=' where startDate>="'.date('Y-m-d',strtotime($startDate)).'" and startDate<="'.date('Y-m-d',strtotime($endDate)).'" and confirmQuote=1 and queryId!=0   '.$clientsearch.' '.$searchcity.' '.$searchusers.' and queryId in (select id from queryMaster where statusId=5)  order by startDate desc';


$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 
$targetpage='display.html?ga='.$_REQUEST['ga'].'&keyword='.$_REQUEST['keyword'].'&searchcity'.$_REQUEST['searchcity'].'&status='.$_REQUEST['status'].'&searchusers='.$_REQUEST['searchusers'].'&'; 
$rs=GetRecordList('*','sys_packageBuilder','   '.$where.'  ','25',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 

$b=GetPageRecord('*','queryMaster','id="'.$rest['queryId'].'"'); 
$queryData=mysqli_fetch_array($b);

$bc=GetPageRecord('*','userMaster','id="'.$queryData['clientId'].'"'); 
$clientData=mysqli_fetch_array($bc);

?>

<tr>
  <td align="left" valign="top"><a href="display.html?ga=query&view=1&id=<?php echo encode($rest['queryId']); ?>" target="_blank"><?php echo encode($rest['queryId']); ?></a></td>
  <td align="left" valign="top" style="text-transform:uppercase;"><?php echo stripslashes($rest['name']); if($rest['destinations']!=''){ ?>
<div style="color:#999999; font-size:11px; margin-top:2px;">ID: <a href="display.html?ga=itineraries&view=1&id=<?php echo encode($rest['id']); ?>" target="_blank"><?php echo encode($rest['id']); ?></a> -  <?php echo stripslashes($rest['destinations']); ?> &nbsp;|&nbsp; <?php echo stripslashes($rest['adult']); ?> Adult(s) - <?php echo stripslashes($rest['child']); ?> Child(s)</div><?php } ?>

<div style="margin-top:5px; font-weight:700;">From: <?php echo displaydateinword($rest['startDate']); ?> - To: <?php echo displaydateinword($rest['endDate']); ?></div></td>
  <td align="left" valign="top"> <div style="font-weight:600; margin-bottom:3px;"><?php echo stripslashes($clientData['submitName']); ?> <?php echo stripslashes($clientData['firstName']); ?> <?php echo stripslashes($clientData['lastName']); ?></div><div style="  font-size:11px;margin-bottom:2px;"><i class="fa fa-mobile" aria-hidden="true"></i> <?php echo stripslashes($clientData['mobile']); ?></div><div style="  font-size:11px;"><i class="fa fa-envelope" aria-hidden="true"></i> 
<?php echo stripslashes($clientData['email']); ?></div> </td>
  <td align="left" valign="top">
  <?php if($rest['endDate']<date('Y-m-d')){ ?>
  <span class="badge badge-success">Compleated</span>
  <?php }  ?>
  
  
  
  <?php if($rest['endDate']>date('Y-m-d')){ ?>
  <span class="badge badge-danger">Upcoming</span>
  <?php } ?>
  
  
   </td>
  <td align="left" valign="top"><div style="margin-bottom:0px; font-weight:600;"><?php echo getUserNameNew($queryData['assignTo']); ?></div>
<div style=" font-weight:600; font-size:11px; color:#999999;"><?php echo displaydateinnumber($rest['dateAdded']); ?></div> </td>
  </tr>


<?php  $totalno++; } ?>
                                          </tbody>
                              </table>
						   
						   
						   
						   
									 <?php if($totalno==1){ ?>
						   <div style="text-align:center; padding:40px 0px; font-size:14px; color:#999999;">No Data </div>
						   <?php } else { ?>
								<div class="mt-3 pageingouter">	
										<div style="float: left; font-size: 13px; padding: 7px 11px; border: 1px solid #ededed; background-color: #fff; color: #000;">Total Records: <strong><?php echo $totalentry; ?></strong></div>
											<div class="pagingnumbers"><?php echo $paging; ?></div>
											
							  </div>
										  
										<?php } ?>
										
										
										<?php } else { ?>
						<iframe src="fullcalendar.php" width="100%" height="1100" frameborder="0"></iframe>
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
 

</script>
				
	
<script>
function changeAssignTo(id){
var assignTo = $('#assignTo'+id).val();  
$('#actoinfrm').attr('src','actionpage.php?action=changeassignstatus&queryid='+id+'&assignTo='+assignTo);
}

</script>