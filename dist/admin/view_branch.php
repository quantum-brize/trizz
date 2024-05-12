<?php 
   $a=GetPageRecord('*','sys_userMaster','id="'.decode($_REQUEST['id']).'" '); 
   $agentinfo=mysqli_fetch_array($a);
?>
<div class="wrapper">
   <div class="container-fluid">
      <div class="main-content">
         <div class="page-content">
            <div class="newboxheading">
               <div class="newhead">
                  Branch
                  <div class="newoptionmenu">
                     <div>
                        <button type="button" class="btn btn-secondary btn-lg waves-effect waves-light" onclick="loadpop2('Add Branch',this,'500px')" data-toggle="modal" data-target="#myModal2" data-backdrop="static"  popaction="action=addNewBranch&agentId=<?php echo $_REQUEST['id']; ?>">Add Branch</button> 
                     </div>
                  </div>
               </div>
            </div>
            <!-- start page title -->
            <div style="padding-top: 34px;">
               <div class="col-md-12 col-xl-12" style="padding-left:0px; padding-right:0px;">
                  <div class="">
                     <div class="card-body" style="background-color:#FFFFFF;">
                        <table class="table table-bordered table-striped" style=" margin-bottom:0px;">
                           <thead>
                              <tr>
                                 <th align="center"><div align="center">Comapany</div></th>
                                 <th align="center"><div align="center">GST</div></th>
                                 <th align="center"><div align="center">GST Mobile</div></th>
                                 <th align="center"><div align="center">GST Email</div></th>
                                 <th align="center"><div align="center">GST State</div></th>
                                 <th align="center"><div align="center">GST Address</div></th>
								 <th align="center"><div align="center">Action</div></th>
                              </tr>
                           </thead>
                           <tbody>
                               <?php 
									$limit=clean($_GET['records']);
									$page=clean($_GET['page']); 
									$sNo=1; 
									$search='';
									$targetpage='display.html?ga=branch&agentCategory='.$_REQUEST['agentCategory'].'&id='.$_REQUEST['id'].'&view=1&fromdate='.$_REQUEST['fromdate'].'&todate='.$_REQUEST['todate'].'&keyword='.$_REQUEST['keyword'].'&'; 
									$rs=GetRecordList('*', 'agentBranch',' where agentId="'.decode($_REQUEST['id']).'"  order by id desc  ','250',$page,$targetpage);  
									$totalentry=$rs[1];  
									$paging=$rs[2];  
									while($rest=mysqli_fetch_array($rs[0])){  
									$totalSale=0;
								?>
                              <tr>
                                 <td align="center" valign="top"><b><?php echo strip($rest['companyName']); ?></b></td>
                                 <td align="center" valign="top"><?php echo strip($rest['gst']); ?></td>
                                 <td align="center" valign="top"><?php echo strip($rest['gstMobile']); ?></td>
                                 <td align="center" valign="top"><?php echo strip($rest['gstEmail']); ?></td>
                                 <td align="center" valign="top"><?php echo strip($rest['state']); ?></td>
                                 <td align="center" valign="top"><?php echo strip($rest['gstAddress']); ?></td>
								 
								 <td align="center" valign="top">
									 <div style="display:flex;justify-content:center;gap:5px;">
										<a class="dropdown-item neweditpan" onclick="loadpop2('Edit Branch',this,'600px')" data-toggle="modal"  data-target="#myModal2" data-backdrop="static"  popaction="action=addNewBranch&id=<?php echo $rest['id']; ?>&agentId=<?php echo $_REQUEST['id']; ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
									  
										<a style="width:30% !important;" href="#" onclick="deleteBranch('<?php echo $rest['id']; ?>');" class="dropdown-item neweditpan"><i class="fa fa-trash" aria-hidden="true"></i></a>
									 </div>
                                 </td>
								 
                              </tr>
                              <?php } ?>
                             
                              <tr>
                                 <td colspan="7" valign="top" style="padding:0px;">
                                    <div class="card-footer text-right" style="overflow:hidden;width: 100%; ">
                                       <div style="float: left; font-size: 13px; padding: 7px 11px; border: 1px solid #ededed; background-color: #fff; color: #000;">Total Records: <strong><?php echo $totalentry; ?></strong></div>
                                       <div class="pagingnumbers"><?php echo $paging; ?></div>
                                    </div>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
            <!--end col-->
            <!-- end row -->
         </div>
         <!-- End Page-content -->
      </div>
   </div>
</div>

<script>
function deleteBranch(id) {
  var result = confirm("Are you sure you want to delete this branch?");
  if (result==true) {
   $('#ActionDiv').load('actionpage.php?id='+id+'&agentId=<?php echo $_REQUEST['id']; ?>&action=deleteBranch');
  } else {
   return false;
  }
}
</script>
