<?php 
   $u = decode($_REQUEST['u']);
   
   if($_REQUEST['u']==''){
   $u=$_SESSION['userid'];
   }
   $abcd=GetPageRecord('*','userMaster','id="'.$u.'"'); 
   $result=mysqli_fetch_array($abcd); 
   
   if($_REQUEST['status']==1 || $_REQUEST['status']==2 || $_REQUEST['status']==3){
   if($_REQUEST['i']!=''){
   $namevalue ='status="'.$_REQUEST['status'].'"';  
   $where='id="'.decode($_REQUEST['i']).'"';    
   updatelisting('sys_packageBuilder',$namevalue,$where); 
   }
   }
   
   if($_REQUEST['status']==4){
   if($_REQUEST['i']!=''){
   $namevalue ='archiveThis=1';  
   $where='id="'.decode($_REQUEST['i']).'"';    
   updatelisting('sys_packageBuilder',$namevalue,$where); 
   }
   }
   
   if($_REQUEST['status']==5){
   if($_REQUEST['i']!=''){
   $namevalue ='archiveThis=0';  
   $where='id="'.decode($_REQUEST['i']).'"';    
   updatelisting('sys_packageBuilder',$namevalue,$where); 
   }
   }
   
?>
<div class="wrapper">
   <div class="container-fluid">
      <div class="main-content">
         <div class="page-content">
            <div class="newboxheading">
               <div class="newhead">
                Cruise
                  <form action="" class="newsearchsecform"  style="top: -9px; left: 76px !important;"  method="get" enctype="multipart/form-data">	
                     <input type="text" name="keyword" class="form-control newsearchsec" placeholder="Search by name"  value="<?php echo $_REQUEST['keyword']; ?>" style="margin-top: 3px;">
                     <input name="ga" type="hidden" value="<?php echo $_REQUEST['ga']; ?>" />
                  </form>
                  <div class="newoptionmenu">
                     <!-- <div>
                        <?php //if (strpos($LoginUserDetails["permissionAddEdit"], 'Cruise') !== false) { ?>	<button type="button" class="btn btn-secondary btn-lg waves-effect waves-light"  onclick="loadpop2('Cruise setup',this,'600px')" data-toggle="modal" data-target="#myModal2" data-backdrop="static"  popaction="action=addCruise">Create Cruise</button> <?php //} ?>							 
                     </div> -->

                     <div>
                      <button type="button" class="btn btn-secondary btn-lg waves-effect waves-light"  onclick="loadpop('Cruise setup',this,'800px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addCruiseMaster">Create Cruise</button>						 
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
                                 <th>Title</th>
                                 <th align="center">Tagline 1</th>
                                 <th align="center">Tagline 2</th>
                                 <th align="center">Tagline 3</th>
                                 <th align="center">Cabin</th>
                                 <th width="1%"><div align="center">Banner Gallery</div></th>
                                 <th width="1%"><div align="center">Expect Gallery</div></th>
                                 <!-- <th>Price</th> -->
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
                                 $where=' where 1 '.$where4.'  order by id desc'; 
                                 $limit=clean($_GET['records']);
                                 $page=clean($_GET['page']); 
                                 $sNo=1; 
                                 $targetpage='display.html?ga='.$_REQUEST['ga'].'&'; 
                                 $rs=GetRecordList('*','sys_cruiseBuilder','  '.$where.'  ','25',$page,$targetpage);
                                 
                                 $totalentry=$rs[1];
                                 
                                 $paging=$rs[2];  
                                 while($rest=mysqli_fetch_array($rs[0])){ 
                                ?>
                              <tr>
                                   
                                <td><?php echo stripslashes($rest['name']); ?></td>
                                <td><?php echo stripslashes($rest['tagline1']); ?></td>
                                <td><?php echo stripslashes($rest['tagline2']); ?></td>
                                <td><?php echo stripslashes($rest['tagline3']); ?></td>

                                <td> <a  href="display.html?ga=cabin&cruiseId=<?php echo encode($rest['id']); ?>" target="_blank" class="btn btn-success btn-sm" style="color:#fff !important;">Add Cabin</a></td>
                                    
                                <td width="1%">
                                <div align="center"><a class="dropdown-item"  style="cursor:pointer; font-size:12px; text-decoration:underline;" onclick="loadpop('Gallary',this,'800px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addCruiseBannerGallary&id=<?php echo encode($rest['id']); ?>">Upload</a></div>
                                </td>
                                 
                                <td width="1%">
                                <div align="center"><a class="dropdown-item"  style="cursor:pointer; font-size:12px; text-decoration:underline;" onclick="loadpop('Gallary',this,'800px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addCruiseExpectGallary&id=<?php echo encode($rest['id']); ?>">Upload</a></div>
                                </td>

                                <!-- <td>&#8377;<?php echo number_format($rest['grossPrice']+$rest['extraMarkup']); ?> </td> -->
                                <td width="12%"><?php echo date('d-m-Y', strtotime($rest['updated_at'])); ?></td>
                                <td width="1%">
                                <div class="">
                                    <button type="button" class="optionmenu" data-toggle="dropdown" aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical"></i></button>
                                    <div class="dropdown-menu" style="">
                                        <div class="leg">ACTIONS</div>
                                        <?php //if (strpos($LoginUserDetails["permissionAddEdit"], 'Cruise') !== false) { ?>
                                        <a class="dropdown-item" style="cursor:pointer;" onclick="loadpop('Cruise setup',this,'800px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addCruiseMaster&id=<?php echo encode($rest['id']); ?>">Edit Cruise</a>
                        
                                        <?php //} ?>
                                    </div>
                                </div>
                                </td>
                              </tr>
                              <?php $totalno++; } ?>
                           </tbody>
                        </table>
                        <?php if($totalno==1){ ?>
                        <div style="text-align:center; padding:40px 0px; font-size:14px; color:#999999;">No Cruises</div>
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
