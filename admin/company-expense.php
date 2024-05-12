<?php
$selectedmenu=33;
if($_REQUEST['startDate']!='' && $_REQUEST['endDate']!='' ){
$startDate=date('d-m-Y',strtotime($_REQUEST['startDate']));
$endDate=date('d-m-Y',strtotime($_REQUEST['endDate']));
} else {
$startDate=date('1-m-Y');
$endDate=date('t-m-Y');
}

$where1='';
$where2='';

$whereintotal=' and DATE(paymentDate) between  "'.date('Y-m-d',strtotime($startDate)).'" and "'.date('Y-m-d',strtotime($endDate)).'" ';
$whereintotal2=' and DATE(paymentDate) between  "'.date('Y-m-d',strtotime($startDate)).'" and "'.date('Y-m-d',strtotime($endDate)).'" ';



if($_REQUEST['keyword']!=''){
$where1=' and remark like "%'.$_REQUEST['keyword'].'%" ';
}

if($_REQUEST['transectionType']!=''){
$where2=' and paymentType="'.$_REQUEST['transectionType'].'"';
}

if($_REQUEST['status']!=''){
if($_REQUEST['status']==1){
$where2=' and paymentStatus="'.$_REQUEST['status'].'"';
}

if($_REQUEST['status']==2){
$where2=' and paymentStatus="'.$_REQUEST['status'].'"  ';
}

 

}


$where='  and DATE(paymentDate) between "'.date('Y-m-d',strtotime($startDate)).'" and "'.date('Y-m-d',strtotime($endDate)).'" '.$where1.' '.$where2.'  ';
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

      <div class="newboxheading"><div class="newhead">Expenses 
 <div class="newoptionmenu">

  
 
 									 
 
  
   
 
    									 
										 
     
   
 <div>
<button type="button" class="btn btn-secondary btn-lg waves-effect waves-light"  onclick="loadpop2('Add Expense',this,'600px')" data-toggle="modal"  data-target="#myModal2" data-backdrop="static"    popaction="action=addcompanyexpense" >Add Expense</button>						 
 </div>
 

  

									
									
  
		  
		  

 </div>
 </div>     
 
     
</div>
                    
                    <!-- start page title -->
                     
              
                        <div class=" ">
                        <div class="col-md-12 col-xl-12" style=" padding-top: 34px;">
						<div class="card"  >
                            <div class="card-body" style="padding:0px;"> 
                                      
							 <div   style="  margin-bottom: 10px; float: left; width: 100%; border-top: 1px solid #dee2e6; border-bottom: 2px solid #dee2e6; background-color: #f3f3f3; padding: 8px;">
								 
								  <div class="row" style="margin-right: 0px; margin-left: 0px;">
								  
								    
								  <div class="col-md-3 col-xl-3">
								   <form  action=""    method="get" enctype="multipart/form-data">	
								<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><input type="text" class="form-control" id="startDate" name="startDate" readonly="" placeholder="From" value="<?php echo $startDate; ?>" style="width:130px;"></td>
    <td style="padding-left:5px;"><input type="text" class="form-control" id="endDate" name="endDate" readonly="" placeholder="From" value="<?php echo $endDate; ?>" style="width:130px;"></td>
    <td style="padding-left:5px;"><input type="text" name="keyword" class="form-control"  placeholder="Keyword"  value="<?php echo $_REQUEST['keyword']; ?>" style=" width:250px;">
								  <input name="page" type="hidden" value="<?php echo $_REQUEST['page']; ?>" /><input name="ga" type="hidden" value="<?php echo $_REQUEST['ga']; ?>" />						    </td>
    <td style="padding-left:5px;"><select name="transectionType" class="form-control" style="width:180px;">
<option value="">All Type</option>
 <?php   
$rs=GetPageRecord('*','expenseTypeMaster',' status=1  order by name asc'); 
while($rest=mysqli_fetch_array($rs)){  
?>  
<option value="<?php echo $rest['id']; ?>"<?php if($_REQUEST['transectionType']==$rest['id']){ ?> selected="selected"<?php } ?>><?php echo stripslashes($rest['name']); ?></option> 
  <?php } ?>
</select></td>
 <td style="padding-left:5px;"><select name="status" class="form-control"  style="width:150px;"> 
<option value="">All Status</option> 
<option value="1"<?php if($_REQUEST['status']==1){ ?> selected="selected"<?php } ?>>Paid</option>  
<option value="2"<?php if($_REQUEST['status']==2){ ?> selected="selected"<?php } ?>>Pending</option>   
</select>  </td> 
    <td style="padding-left:5px;"><button type="submit" class="btn btn-secondary btn-lg waves-effect waves-light" style="padding: 6px 10px;"  ><i class="fa fa-search" aria-hidden="true"></i> Search</button></td>
    <td>&nbsp;</td>
  </tr>
</table>
  </form>
								  </div>
								 </div>
								 
							  </div>
							  
							  <div style="margin:10px;">
							  <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="33%" align="left" valign="top"><div class="statusbox" style="background-color:#655be6;"><div style="margin-bottom: 0px; font-size: 30px; line-height: 38px;">
	&#8377;<?php $ba=GetPageRecord('SUM(amount) as totalgross','expenseMaster',' 1  '.$where.'  ' ); $packagecost=mysqli_fetch_array($ba); echo number_format($packagecost['totalgross']); ?>
	
	</div>Total Amount</div></td>
    <td width="33%" align="left" valign="top"><div class="statusbox" style="background-color:#0cb5b5;">
      <div style="margin-bottom: 0px; font-size: 30px; line-height: 38px;">&#8377;<?php $ba=GetPageRecord('SUM(amount) as totalrecived','expenseMaster',' paymentStatus=1    '.$where.'  '); $packagecostrecived=mysqli_fetch_array($ba); echo number_format($packagecostrecived['totalrecived']); ?></div>
      Paid</div></td>
     
    <td width="33%" align="left" valign="top"><div class="statusbox" style="background-color:#e45555; margin-right:0px;">
      <div style="margin-bottom: 0px; font-size: 30px; line-height: 38px;">&#8377;<?php echo number_format(round($packagecost['totalgross']-$packagecostrecived['totalrecived'])); ?></div>Pending</div></td>
    </tr>
</table>

							  </div>
							  
                                       
                                         
                           
						   
						   
						   <table class="table table-hover mb-0" style="border:1px solid #ddd;">

                                            <thead>
                                                <tr>
                                                  <th width="10%">ID </th>
                                                  <th width="15%">Type</th>
                                                  <th width="10%">Amount</th>
                                                  <th>Remark</th>
                                                  <th width="15%">Payment Date</th>
                                                    <th width="1%">Status</th>
                                                    <th width="1%">&nbsp;</th>
                                                </tr>
                                            </thead>
<tbody> 
<?php

$totalno=1;

$where=' where DATE(paymentDate) between "'.date('Y-m-d',strtotime($startDate)).'" and "'.date('Y-m-d',strtotime($endDate)).'" '.$where1.' '.$where2.' order by paymentDate desc';


$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 
$targetpage='display.html?ga='.$_REQUEST['ga'].'&keyword='.$_REQUEST['keyword'].'&searchcity'.$_REQUEST['searchcity'].'&status='.$_REQUEST['status'].'&transectionType='.$_REQUEST['transectionType'].'&'; 
$rs=GetRecordList('*','expenseMaster','   '.$where.'  ','25',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($paymentlist=mysqli_fetch_array($rs[0])){ 
 
 
?>

<tr>
  <td width="10%" align="left" valign="middle"><?php echo encode($paymentlist['id']); ?></td>
  <td width="15%" align="left" valign="middle"><span class="badge badge-dark"><?php echo getExpenseTypeName($paymentlist['paymentType']); ?></span></td>
  <td width="10%" align="left" valign="middle">&#8377;<?php echo ($paymentlist['amount']); ?></td>
  <td align="left" valign="middle"><?php echo stripslashes($paymentlist['remark']); ?></td>
  <td width="15%" align="left" valign="middle"><?php echo date('d/m/Y',strtotime($paymentlist['paymentDate'])); ?> </td>
  <td width="1%" align="left" valign="middle">
  <?php if($paymentlist['paymentStatus']==1){ ?><span class="badge badge-success">Paid</span><?php } ?>
  <?php if($paymentlist['paymentStatus']==2){ ?><span class="badge badge-danger">Pending</span><?php } ?>   </td>
  <td width="1%" align="left" valign="top"><a class="dropdown-item neweditpan"   onclick="loadpop2('Edit Client',this,'600px')" data-toggle="modal"  data-target="#myModal2" data-backdrop="static"  popaction="action=addcompanyexpense&id=<?php echo encode($paymentlist['id']); ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
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