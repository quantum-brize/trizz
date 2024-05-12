<?php
if($_REQUEST['startDate']!='' && $_REQUEST['endDate']!='' ){
$startDate=date('d-m-Y',strtotime($_REQUEST['startDate']));
$endDate=date('d-m-Y',strtotime($_REQUEST['endDate']));
} else {
$startDate=date('d-m-Y',strtotime('-10 Days'));
$endDate=date('d-m-Y',strtotime('+1 Days'));
}

$where1='';
$where2='';

$whereintotal=' and DATE(reminderDate) between  "'.date('Y-m-d',strtotime($startDate)).'" and "'.date('Y-m-d',strtotime($endDate)).'" '; 

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
$searchusers=' and  assignTo="'.$_REQUEST['searchusers'].'" ';
}

?>

 <style>
.table td, .table th {
    vertical-align: top;
}
.statusbox{margin-right: 5px; padding: 10px; text-align: center; background-color: #000000; font-size: 13px; color: #fff; border-radius: 4px; text-transform:uppercase;}
.iconbox .fa{font-size:30px; text-align:center;  }

</style>
<div class="wrapper">
<div class="container-fluid">
<div class="main-content">

                <div class="page-content">

      
                    <div class="newboxheading"><div class="newhead">Task's / Followup's Report<div class="newoptionmenu">
  <form  action=""    method="get" enctype="multipart/form-data">	
								<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><input type="text" class="form-control" id="startDate" name="startDate" readonly="" placeholder="From" value="<?php echo $startDate; ?>" style="width:130px;"></td>
    <td style="padding-left:5px;"><input type="text" class="form-control" id="endDate" name="endDate" readonly="" placeholder="From" value="<?php echo $endDate; ?>" style="width:130px;"></td>
    <td style="padding-left:5px;"><input type="text" name="keyword" class="form-control"  placeholder="Search by name, email, mobile"  value="<?php echo $_REQUEST['keyword']; ?>" style=" width:150px;">
								  <input name="page" type="hidden" value="<?php echo $_REQUEST['page']; ?>" /><input name="ga" type="hidden" value="<?php echo $_REQUEST['ga']; ?>" />						    </td>
    
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
  </tr>
</table>
  </form>
 </div>
 </div>     
 
     
</div>
                    <!-- start page title -->
                     
              
                        <div class=" ">
                        <div class="col-md-12 col-xl-12" style="padding-top:45px;">
						<div class="card" style="min-height:500px; overflow:hidden;">
                            <div class="card-body"  style="padding:0px;">  
							  
							  
							  <div style="margin-bottom:0px; padding:10px;">
							  <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="33%" align="left" valign="top"><div class="statusbox" style="background-color:#655be6;"><div style="margin-bottom: 0px; font-size: 30px; line-height: 38px;"><?php $ba=GetPageRecord('count(id) as totaltours','queryTask',' makeDone!=1 '.$whereintotal.' and DATE(reminderDate)>="'.date('Y-m-d').'" '.$searchusers.'  '.$clientsearch.' ' ); $packagecost=mysqli_fetch_array($ba); echo  ($packagecost['totaltours']); ?>
	
	</div>
    Scheduled</div></td>
    <td width="33%" align="left" valign="top"><div class="statusbox" style="background-color:#0cb5b5;">
      <div style="margin-bottom: 0px; font-size: 30px; line-height: 38px;"><?php $ba=GetPageRecord('count(id) as totaltours','queryTask',' makeDone=1 '.$whereintotal.' '.$searchusers.'  '.$clientsearch.' ' ); $packagecost=mysqli_fetch_array($ba); echo  ($packagecost['totaltours']); ?> </div>
      Done </div></td>
     
    <td width="33%" align="left" valign="top"><div class="statusbox" style="background-color:#e45555; margin-right:0px;">
      <div style="margin-bottom: 0px; font-size: 30px; line-height: 38px;"><?php $ba=GetPageRecord('count(id) as totaltours','queryTask',' makeDone!=1 '.$whereintotal.' and DATE(reminderDate)<"'.date('Y-m-d').'" '.$searchusers.' '.$clientsearch.' ' ); $packagecost=mysqli_fetch_array($ba); echo  ($packagecost['totaltours']); ?> </div>
      Pending</div></td>
    </tr>
</table>

							  </div>
							  
                                       
                                         
                           
						   
						   
						   <table class="table table-hover mb-0" style="border:1px solid #ddd;">

                                            <thead>
                                                <tr>
                                                  <th width="5%" align="center">&nbsp;</th>
                                                  <th>Client</th>
                                                  <th>Query ID </th>
                                                  <th>Details</th>
                                                  <th>Reminder</th>
                                                  <th>Status</th>
                                                  <th>Assigned</th>
                                                </tr>
                                            </thead>
<tbody> 
<?php

$totalno=1;

$where=' where DATE(reminderDate)>="'.date('Y-m-d',strtotime($startDate)).'" and DATE(reminderDate)<="'.date('Y-m-d',strtotime($endDate)).'"  and queryId!=0 '.$clientsearch.' '.$searchcity.' '.$searchusers.'  order by reminderDate desc';


$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 
$targetpage='display.html?ga='.$_REQUEST['ga'].'&keyword='.$_REQUEST['keyword'].'&searchcity'.$_REQUEST['searchcity'].'&status='.$_REQUEST['status'].'&searchusers='.$_REQUEST['searchusers'].'&'; 
$rs=GetRecordList('*','queryTask','   '.$where.'  ','25',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 

$b=GetPageRecord('*','queryMaster','id="'.$rest['queryId'].'"'); 
$queryData=mysqli_fetch_array($b);

$bc=GetPageRecord('*','userMaster','id="'.$queryData['clientId'].'"'); 
$clientData=mysqli_fetch_array($bc);

?>

<tr>
  <td width="5%" align="center" valign="top"><div class="iconbox">
	<?php if($rest['taskType']=='Task'){ ?>
	<i class="fa fa-calendar-check-o" aria-hidden="true"></i>
	<?php } ?>
	<?php if($rest['taskType']=='Call'){ ?>
	<i class="fa fa-phone-square" aria-hidden="true"></i>
	<?php } ?>
	<?php if($rest['taskType']=='Meeting'){ ?>
	<i class="fa fa-handshake-o" aria-hidden="true"></i>
	<?php } ?>
	
</div></td>
  <td align="left" valign="top"><div style="font-weight:600; margin-bottom:3px;"><?php echo stripslashes($clientData['submitName']); ?> <?php echo stripslashes($clientData['firstName']); ?> <?php echo stripslashes($clientData['lastName']); ?></div><div style="  font-size:11px;margin-bottom:2px;"><i class="fa fa-mobile" aria-hidden="true"></i> <?php echo stripslashes($clientData['mobile']); ?></div><div style="  font-size:11px;"><i class="fa fa-envelope" aria-hidden="true"></i> 
<?php echo stripslashes($clientData['email']); ?></div> </td>
  <td align="left" valign="top"><a href="display.html?ga=query&view=1&id=<?php echo encode($rest['queryId']); ?>" target="_blank"><?php echo encode($rest['queryId']); ?></a></td>
  <td align="left" valign="top" style="text-transform:uppercase;"><?php echo (stripslashes($rest['details'])); ?></td>
  <td align="left" valign="top">	<?php if($rest['status']==1){ ?>
	<div style="margin-bottom:5px; font-size:12px; color:#FF0000;<?php if($rest['makeDone']==1){ ?>text-decoration: line-through;<?php } ?>"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo date('d/m/Y - h:i A',strtotime($rest['reminderDate'])); ?> </div>
	<?php } ?></td>
  <td align="left" valign="top">
  <?php if($rest['makeDone']!=1 && date('Y-m-d',strtotime($rest['reminderDate']))>=date('Y-m-d')){ ?> <span class="badge badge-info">Scheduled</span><?php } ?>
  
  <?php if($rest['makeDone']!=1 && date('Y-m-d',strtotime($rest['reminderDate']))<date('Y-m-d')){ ?> <span class="badge badge-danger">Pending</span><?php } ?>
	<?php if($rest['makeDone']==1){ ?> <span class="badge badge-success">Done</span><div style="width:100%; margin-top:2px; font-size:11px;"><?php echo date('d/m/Y - h:i A',strtotime($rest['confirmDate'])); ?></div><?php } ?></td>
  <td align="left" valign="top"><div style="margin-bottom:0px; font-weight:600;"><?php echo getUserNameNew($rest['assignTo']); ?></div>
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