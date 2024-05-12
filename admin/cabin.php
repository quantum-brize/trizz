<?php 
   $u = decode($_REQUEST['u']);
   
   if($_REQUEST['u']==''){
   $u=$_SESSION['userid'];
   }
   $abcd=GetPageRecord('*','userMaster','id="'.$u.'"'); 
   $result=mysqli_fetch_array($abcd); 
   
?>
<div class="wrapper">
   <div class="container-fluid">
      <div class="main-content">
         <div class="page-content">
            <div class="newboxheading">
               <div class="newhead">
                Cruise Cabin 
                  <form action="" class="newsearchsecform ml-3"  style="top: -9px; left: 76px !important;"  method="get" enctype="multipart/form-data">	
                     <input type="text" name="keyword" class="form-control newsearchsec" placeholder="Search by name"  value="<?php echo $_REQUEST['keyword']; ?>" style="margin-top: 3px;">
                     <input name="ga" type="hidden" value="<?php echo $_REQUEST['ga']; ?>" />
                  </form>
                  <div class="newoptionmenu">
                     <!-- <div>
                        <?php //if (strpos($LoginUserDetails["permissionAddEdit"], 'Cruise') !== false) { ?>	<button type="button" class="btn btn-secondary btn-lg waves-effect waves-light"  onclick="loadpop2('Cruise setup',this,'600px')" data-toggle="modal" data-target="#myModal2" data-backdrop="static"  popaction="action=addCruise">Create Cruise</button> <?php //} ?>							 
                     </div> -->

                     <div>
                      <button type="button" class="btn btn-secondary btn-lg waves-effect waves-light"  onclick="loadpop('Cabin setup',this,'800px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addCruiseCabin&cruiseId=<?php echo $_REQUEST['cruiseId']; ?>">Add Cabin</button>						 
                     </div>

                  </div>
               </div>
            </div>
            <!-- start page title -->
            <div style="padding-top: 34px;">
               <div class="col-md-12 col-xl-12" style="padding-left:0px; padding-right:0px;">
                  <div class=" ">
                     <div class="card-body" style=" background-color:#FFFFFF;">
                        <table class="table table-hover mb-0">
                           <thead>
                              <tr>
                                 <th>Name</th>
                                 <th align="center">Subline</th>
                                 <th align="center">Occupancy</th>
                                 <th align="center">Price</th>
                                 <th>Status</th>
                                 <th width="12%">Date</th>
                                 <th width="1%">&nbsp;</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                                 if($_REQUEST['keyword']!=''){
                                    $where4=' and (name like "%'.$_REQUEST['keyword'].'%")';
                                 }
                                 
                                 $totalno='1';
                                 $select='';
                                 $where='';
                                 $rs=''; 
                                 $select='*'; 
                                 $wheremain=''; 
                                  $where=' where 1 '.$where4.' and cruiseId="'.decode($_REQUEST['cruiseId']).'"  order by id desc'; 
                                 //$where=' where 1 '.$where4.' order by id desc'; 
                                 $limit=clean($_GET['records']);
                                 $page=clean($_GET['page']); 
                                 $sNo=1; 
                                 $targetpage='display.html?ga='.$_REQUEST['ga'].'&'; 
                                 $rs=GetRecordList('*','cruiseCabinMaster','  '.$where.'  ','25',$page,$targetpage);
                                 
                                 $totalentry=$rs[1];
                                 
                                 $paging=$rs[2];  
                                 while($rest=mysqli_fetch_array($rs[0])){ 
                                ?>
                              <tr>
                                   
                                <td><?php echo stripslashes($rest['name']); ?></td>
                                <td><?php echo stripslashes($rest['subline']); ?></td>
                                <td><?php echo stripslashes($rest['occupancy']); ?></td>

                                <td width="1%">
                                  <div align="center"><a class="dropdown-item btn btn-success btn-sm"  style="cursor:pointer; font-size:12px; text-decoration:underline; color:#fff !important;" onclick="loadpop('Cabin Price',this,'800px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addCabinPrice&cabinId=<?php echo $rest['id']; ?>&cruiseId=<?php echo decode($_REQUEST['cruiseId']); ?>">Update</a></div>
                                </td>

                                <td><?php echo newstatusbadges($rest['status']); ?> </td> 
                     
                                <td width="12%"><?php echo date('d-m-Y', strtotime($rest['updated_at'])); ?></td>
                                <td width="1%">
                                <div class="">
                                    <button type="button" class="optionmenu" data-toggle="dropdown" aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical"></i></button>
                                    <div class="dropdown-menu" style="">
                                        <div class="leg">ACTIONS</div>
                                        <?php //if (strpos($LoginUserDetails["permissionAddEdit"], 'Cruise') !== false) { ?>
                                        <a class="dropdown-item" style="cursor:pointer;" onclick="loadpop('Cabin setup',this,'800px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addCruiseCabin&id=<?php echo encode($rest['id']); ?>&cruiseId=<?php echo $_REQUEST['cruiseId']; ?>">Edit Cabin</a>
                        
                                        <?php //} ?>
                                    </div>
                                </div>
                                </td>
                              </tr>
                              <?php $totalno++; } ?>
                           </tbody>
                        </table>
                        <?php if($totalno==1){ ?>
                        <div style="text-align:center; padding:40px 0px; font-size:14px; color:#999999;">No Cabins</div>
                        <?php } else { ?>
                        <div class="mt-3 pageingouter">
                           <div style="float: left; font-size: 13px; padding: 7px 11px; border: 1px solid #ededed; background-color: #fff; color: #000;">Total Records: <strong><?php echo $totalentry; ?></strong></div>
                           <div class="pagingnumbers"><?php echo $paging; ?></div>
                        </div>
                        <?php } ?>
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
