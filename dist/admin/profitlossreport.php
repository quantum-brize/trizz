<?php

if($_REQUEST['startDate']!='' && $_REQUEST['endDate']!='' ){
$startDate=date('d-m-Y',strtotime($_REQUEST['startDate']));
$endDate=date('d-m-Y',strtotime($_REQUEST['endDate']));
} else {
$startDate=date('d-m-Y',strtotime('-30 Days'));
$endDate=date('d-m-Y');
}









$totalno='1';
$totalmail='0';
$select='';
$where='';
$rs='';  
$wheremain=''; 

$searchwhere='';
$searchwhereuser='';
$mainwhere=''; 
$noteswhere='';


if($LoginUserDetails['userType']!=0){ 
$mainwhere=' and (addedBy="'.$_SESSION['userid'].'" or  assignTo="'.$_SESSION['userid'].'")  ';

if($_REQUEST['statusid']==1){ 
$noteswhere='and id in (select queryId from queryNotes) and statusId=1';
}

if($_REQUEST['statusid']==''){ 
$noteswhere='and id in (select queryId from queryNotes)';
}

} else {
$mainwhere=' and 1 '; 
}



$searchcity='';
if($_REQUEST['searchcity']!=''){
$searchcity=' and  destinationId="'.$_REQUEST['searchcity'].'"';
}


$searchsource='';
if($_REQUEST['searchsource']!=''){
$searchsource=' and  leadSource="'.$_REQUEST['searchsource'].'"';
}





$searchusers=''; 
if($_REQUEST['searchusers']!=''){
 $searchusers=' and assignTo in (select id from sys_userMaster where id="'.$_REQUEST['searchusers'].'") ';
}

$statusid='';
if($_REQUEST['statusid']!=''){
$statusid=' and  statusId="'.$_REQUEST['statusid'].'"';
}

if($_REQUEST['keyword']!=''){
$searchwhereuser=' and (id="'.decode($_REQUEST['keyword']).'" or clientId in (select id from userMaster where firstName like "%'.$_REQUEST['keyword'].'%" or lastName like "%'.$_REQUEST['keyword'].'%"  or mobile like "%'.$_REQUEST['keyword'].'%" or email like "%'.$_REQUEST['keyword'].'%") )';
}

$wheresdate='  and date(dateAdded)<="'.date('Y-m-d',strtotime($endDate)).'" and  date(dateAdded)>="'.date('Y-m-d',strtotime($startDate)).'"   '; 

$destinationIdwhere='';
if($_REQUEST['searchcity']!=''){
 $destinationIdwhere='  and destinationId='.$_REQUEST['searchcity'].'   '; 
}
 

?>

<style>
.table td, .table th {
    vertical-align: top;
}
.statusbox{margin-right: 5px; padding: 10px; text-align: center; background-color: #000000; font-size: 13px; color: #fff; border-radius: 4px; text-transform:uppercase;}
.notes{font-size: 12px; background-color: #FFFFCC; border: 1px solid #FFCC33; padding: 0px 5px; color: #ff6a00; font-weight: 600; float: left; margin-top: 2px; border-radius: 2px;}
</style>
<div class="wrapper">
<div class="container-fluid">
<div class="main-content">

                <div class="page-content">

      <div class="newboxheading"><div class="newhead">Profit / Loss Report<div class="newoptionmenu">
  <form  action=""    method="get" enctype="multipart/form-data">	
								<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><input type="text" class="form-control" id="startDate" name="startDate" readonly="" placeholder="From" value="<?php echo $startDate; ?>" style="width:130px;"></td>
    <td style="padding-left:5px;"><input type="text" class="form-control" id="endDate" name="endDate" readonly="" placeholder="From" value="<?php echo $endDate; ?>" style="width:130px;"></td>
    <td style="padding-left:5px;"><input type="text" name="keyword" class="form-control"  placeholder="Search by ID, name, email, mobile"  value="<?php echo $_REQUEST['keyword']; ?>" style=" width:150px;">
								  <input name="page" type="hidden" value="<?php echo $_REQUEST['page']; ?>" /><input name="ga" type="hidden" value="<?php echo $_REQUEST['ga']; ?>" />						    </td>
    <td style="padding-left:5px;"><select name="searchcity" class="form-control"  style="width:130px;">
  <option value="" >All Destinations</option>
  <?php  

$rs22=GetPageRecord('*','queryMaster','  destinationId in (select id from cityMaster where name!="") group by destinationId order by id desc'); 
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
  </tr>
</table>
  </form>
 </div>
 </div>     
 
     
</div>
                    
                    <!-- start page title -->
                     
              
                        <div class="">
                        <div class="col-md-12 col-xl-12" style="padding-top: 32px;">
						<div class="card" style="min-height:500px;">
						
						<div style=" padding:10px;">
							  <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tbody><tr>
    <td width="33%" align="left" valign="top"><div class="statusbox" style="background-color:#655be6;"><div style="margin-bottom: 0px; font-size: 30px; line-height: 38px;">&#8377;<?php $ba=GetPageRecord('SUM(netPrice) as totalgross','sys_packageBuilder',' confirmQuote=1 and queryId in (select id from queryMaster where statusId=5  '.$searchwhereuser.' '.$searchusers.' '.$wheresdate.' '.$destinationIdwhere.' ) ' ); $packagecost=mysqli_fetch_array($ba); echo number_format($totalbuying=$packagecost['totalgross']); ?></div>
    Total Buying </div></td>
    <td width="33%" align="left" valign="top"><div class="statusbox" style="background-color:#0cb5b5;">
      <div style="margin-bottom: 0px; font-size: 30px; line-height: 38px;">&#8377;<?php $ba=GetPageRecord('SUM(grossNoGSTPrice) as totalgrossselling','sys_packageBuilder',' confirmQuote=1 and queryId in (select id from queryMaster where statusId=5  '.$searchwhereuser.' '.$searchusers.' '.$wheresdate.' '.$destinationIdwhere.' ) ' ); $packagecost=mysqli_fetch_array($ba); echo number_format($totalselling=$packagecost['totalgrossselling']); ?></div>
      TOtal Selling </div></td>
     
    <td width="33%" align="left" valign="top"><div class="statusbox" style="background-color:#e45555; margin-right:0px;">
      <div style="margin-bottom: 0px; font-size: 30px; line-height: 38px;">&#8377;<?php echo number_format(round($totalselling-$totalbuying)); ?></div>
      Total Profit</div></td>
    </tr>
</tbody></table>

							  </div>
						
                            <div class="card-body"  style="padding:0px;">  
							  
							  
							 
							  
                                        <table class="table table-hover mb-0">

                                            <thead>
                                                <tr>
                                                  <th>Query&nbsp;ID</th>
                                                    <th>Client</th>
                                                    <th>Source</th>
                                                    <th>Package</th>
                                                    <th>Destination</th>
                                                    <th>Pax</th>
                                                    <th>Buying</th>
                                                    <th>Selling</th>
                                                    <th>Profit</th>
                                                    <th>Assigned To </th>
                                                </tr>
                                            </thead>
<tbody>

<?php
$g=1; 


$where=' where statusId=5 '.$searchwhereuser.' '.$searchusers.' '.$wheresdate.' '.$destinationIdwhere.' order by id desc';
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 
$targetpage='display.html?ga='.$_REQUEST['ga'].'&keyword='.$_REQUEST['keyword'].'&searchcity'.$_REQUEST['searchcity'].'&statusid='.$_REQUEST['statusid'].'&'; 
$rs=GetRecordList('*','queryMaster','   '.$where.'  ','25',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($notesdata=mysqli_fetch_array($rs[0])){ 
 
$c=GetPageRecord('*','queryMaster','id="'.$notesdata['id'].'"'); 
$rest=mysqli_fetch_array($c);

$b=GetPageRecord('*','userMaster','id="'.$rest['clientId'].'"'); 
$clientData=mysqli_fetch_array($b);

$bb=GetPageRecord('*','sys_packageBuilder','queryId="'.$rest['id'].'" and confirmQuote=1'); 
$packageData=mysqli_fetch_array($bb);
 
 
?>

<tr>
  <td align="left" valign="middle">
  
  
<a href="display.html?ga=query&view=1&id=<?php echo encode($rest['id']); ?>" target="_blank"> 
  <div style="font-weight:600;"><?php echo encode($rest['id']); ?></div><div style=" color:#666666; font-size:11px;"><?php echo date('d-m-Y',strtotime($rest['dateAdded'])); ?></div>
   </a> </td>
<td align="left" valign="middle"><div style="font-weight:600; margin-bottom:3px;"><?php if(checkduplicate('queryMaster',' clientId='.$rest['clientId'].' and id!='.$rest['id'].'')=='yes'){ ?><i class="fa fa-files-o" aria-hidden="true" style="color:#FF6600;"></i><?php } ?> <?php echo stripslashes($clientData['submitName']); ?> <?php echo stripslashes($clientData['firstName']); ?> <?php echo stripslashes($clientData['lastName']); ?></div> <div style="  font-size:11px;margin-bottom:2px;"><i class="fa fa-mobile" aria-hidden="true"></i> <?php echo stripslashes($clientData['mobile']); ?></div><div style="  font-size:11px;"><i class="fa fa-envelope" aria-hidden="true"></i> 
<?php echo stripslashes($clientData['email']); ?></div> </td>
<td align="left" valign="middle">
<?php $rsb=GetPageRecord('*','querySourceMaster',' id="'.$rest['leadSource'].'"');while($restsource=mysqli_fetch_array($rsb)){  echo stripslashes($restsource['name']); }?> </td>
<td align="left" valign="middle"><div style="max-width:200px;"><?php echo strip($notesdata['name']); ?></div></td>
<td align="left" valign="middle"><div style="max-width:180px; overflow:hidden;overflow-wrap: break-word;"><?php
												$string = '';
										$string = preg_replace('/\.$/', '', $rest['destinationId']);  
										$array = explode(',', $string); 
										foreach($array as $value)  
										{ ?>
										<span class="badge badge-boxed  badge-soft-success" style=" background-color: #737373 !important; color:#fff; font-size: 11px; padding: 5px 6px;"><?php echo  getCityName($value); ?></span>
					  <?php }?></div></td>
<td align="left" valign="middle"><?php echo $rest['adult']+$rest['child']+$rest['infant']; ?></td>
<td align="left" valign="middle"><?php echo round($packageData['netPrice']); ?></td>
<td align="left" valign="middle"><?php echo round($packageData['grossNoGSTPrice']); ?></td>
<td align="left" valign="middle"><?php echo round($packageData['grossNoGSTPrice']-$packageData['netPrice']); ?></td>
<td align="left" valign="middle"> 
<div style="font-size:12px; margin-top:7px;"><?php $rssa22=GetPageRecord('*','sys_userMaster',' id="'.$rest['assignTo'].'" order by firstName asc'); $restuser=mysqli_fetch_array($rssa22); echo $restuser['firstName'].' '.$restuser['lastName'];  ?></div></td> 
</tr>
<?php $totalno++; $g++;   } ?>
                                          </tbody>
                              </table>
                           
									 <?php if($totalno==1){ ?>
						   <div style="text-align:center; padding:40px 0px; font-size:14px; color:#999999;">No Query</div>
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