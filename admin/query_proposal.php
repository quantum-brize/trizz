<?php
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
   
   $string = '';
   $string = preg_replace('/\.$/', '', $editresult['destinationId']);  
   $array = explode(',', $string); 
   foreach($array as $value) {
   $destin.=getCityName($value).' ';
   } 
   ?>
<style>
   .table td, .table th {
   vertical-align: middle;
   }
</style>
<div class="overflowautomobiletable">
   <div class="querydetailinsideheading">
      Proposals
      <div><a class="nav-link<?php if($_REQUEST['s']==0 || $_REQUEST['s']==''){ ?> active show<?php } ?>"  href="display.html?ga=query&view=1&id=<?php echo $_REQUEST['id']; ?>&c=2&status=0&s=0"  ><span class="d-none d-md-block">All Proposals</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span></a><a class="nav-link<?php if($_REQUEST['s']==4){ ?> active show<?php } ?>" href="display.html?ga=query&view=1&id=<?php echo $_REQUEST['id']; ?>&status=1&c=2&s=4"><span class="d-none d-md-block">Archived Proposals</span><span class="d-block d-md-none"><i class="mdi mdi-settings h5"></i></span></a></div>
   </div>
   <div class="proposalboxouterbox">
      <?php
         $where2='';
         if($_REQUEST['s']==1 || $_REQUEST['s']==2 || $_REQUEST['s']==3){
            $where2=' and status="'.$_REQUEST['s'].'"';
         }
         
         $where3=' and archiveThis=0';
         
         if($_REQUEST['s']==4){
            $where3=' and archiveThis=1';
         }
         
         if($_REQUEST['keyword']!=''){
            $where4=' and (name like "%'.$_REQUEST['keyword'].'%" or like "%'.$_REQUEST['keyword'].'%") ';
         }
         
         $totalno='1';
         $select='';
         $where='';
         $rs=''; 
         $select='*'; 
         $wheremain=''; 
         $where=' where 1 and queryId="'.$editresult['id'].'" '.$where2.' '.$where3.' '.$where4.' order by id desc'; 
         $where1 = ' where status=1 and queryId="'.$editresult['id'].'" '.$where.'';
         $limit=clean($_GET['records']);
         $page=clean($_GET['page']); 
         $sNo=1; 
         $targetpage='display.html?ga='.$_REQUEST['ga'].'&s='.$_REQUEST['s'].'&'; 
         $rs=GetRecordList('*','sys_packageBuilder',' '.$where.' ','25',$page,$targetpage);
         
         $totalentry=$rs[1];
         
         $paging=$rs[2];  
         while($rest=mysqli_fetch_array($rs[0])){ 
            $abcde=GetPageRecord('sum(amount) as totalpaymentreceived','sys_PackagePayment','packageId="'.$rest['id'].'" and paymentId!=""'); 
            $paymentdata=mysqli_fetch_array($abcde); 
      ?>
      <div class="itibox">
         <div class="card">
            <a href="display.html?ga=itineraries&view=1&id=<?php echo encode($rest['id']); ?>">
               <div class="imgbox">
                  <img src="<?php echo $fullurl; ?>package_image/<?php echo $rest['coverPhoto']; ?>" style="width:100%; height:auto; min-height:100%;">
                  <div class="packname">
                     <?php echo stripslashes($rest['name']); ?>
                     <div style="color:#fff; font-size:11px; margin-top:2px;"><?php echo stripslashes($rest['destinations']); ?></div>
                  </div>
               </div>
            </a>
            <div class="card-body">
               <table width="100%" border="0" cellpadding="5" cellspacing="0">
                  <tr>
                     <td align="left" valign="top">
                        <div class="smtext">
                           ID: 
                           <strong>
                              <div><?php echo encode($rest['id']); ?></div>
                           </strong>
                        </div>
                        <div class="optionmenu">
                           <button type="button" class="optionmenu" data-toggle="dropdown" aria-expanded="false">
                           <i class="mdi mdi-dots-vertical"></i> </button>
                           <div class="dropdown-menu" style="">
                              <div class="leg" style="display:none;">CHANGE STATUS</div>
                              <a  style="display:none;" href="display.html?ga=query&view=1&id=<?php echo $_REQUEST['id']; ?>&c=2&status=1&i=<?php echo encode($rest['id']); ?>" class="dropdown-item">Proposal<?php if($rest['status']==1){ ?> <i class="fa fa-check" aria-hidden="true"></i><?php } ?></a>
                              <?php if($rest['grossPrice']>0){ ?>
                              <a style="display:none;" href="display.html?ga=query&view=1&id=<?php echo $_REQUEST['id']; ?>&c=2&status=3&i=<?php echo encode($rest['id']); ?>&s=<?php echo $_REQUEST['s']; ?>" class="dropdown-item">Itinerary accepted<?php if($rest['status']==3){ ?> <i class="fa fa-check" aria-hidden="true"></i><?php } ?></a>
                              <a style="display:none;" href="display.html?ga=query&view=1&id=<?php echo $_REQUEST['id']; ?>&c=2&status=2&i=<?php echo encode($rest['id']); ?>&s=<?php echo $_REQUEST['s']; ?>" class="dropdown-item">Final<?php if($rest['status']==2){ ?> <i class="fa fa-check" aria-hidden="true"></i><?php } ?></a><?php } ?>
                              <!--<hr />-->
                              <div class="leg">ACTIONS</div>
                              <a class="dropdown-item" target="_blank" href="https://api.whatsapp.com/send?text=<?php echo $fullurlproposal; ?>sharepackage/<?php echo encode($rest['id']); ?>/<?php echo cleanstring(stripslashes($rest['name'])); ?>.html&phone=+91<?php echo str_replace('+91','',$clientData['mobile']); ?>">
                              <i class="fa fa-whatsapp" aria-hidden="true"></i> &nbsp;WhatsApp</a>
                              <?php if (strpos($LoginUserDetails["permissionAddEdit"], 'Proposal') !== false) { ?>	
                              <a class="dropdown-item" style="cursor:pointer;" onclick="loadpop('Itinerary setup',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addtineraries&id=<?php echo encode($rest['id']); ?>&queryid=<?php echo $_REQUEST['id']; ?>&fromquery=1">Edit Itinerary</a>
                              <a href="#" onclick="duplicatePackage('<?php echo encode($rest['id']); ?>');" class="dropdown-item">Duplicate</a>
                              <?php } ?>
                              <?php if($rest['archiveThis']==0){ ?>
                              <a href="display.html?ga=query&view=1&id=<?php echo $_REQUEST['id']; ?>&c=2&status=4&i=<?php echo encode($rest['id']); ?>&s=<?php echo $_REQUEST['s']; ?>" class="dropdown-item">Archive</a>
                              <?php } else { ?>
                              <a href="display.html?ga=query&view=1&id=<?php echo $_REQUEST['id']; ?>&c=2&status=5&i=<?php echo encode($rest['id']); ?>&s=<?php echo $_REQUEST['s']; ?>" class="dropdown-item">Not Archive</a>
                              <?php } ?>
                           </div>
                        </div>
                     </td>
                     <td width="60%" align="left" valign="top">
                        <div class="smtext">
                           Pax: 
                           <strong>
                              <div>
                                 <?php echo stripslashes($rest['adult']); ?> Adult(s) - <?php echo stripslashes($rest['child']); ?> Child(s)
                              </div>
                           </strong>
                        </div>
                     </td>
                  </tr>
                  <tr>
                     <td align="left" valign="top">
                        <div class="smtext">
                           From: 
                           <strong>
                              <div><?php echo displaydateinword($rest['startDate']); ?></div>
                           </strong>
                        </div>
                     </td>
                     <td width="60%" align="left" valign="top">
                        <div class="smtext">
                           To: 
                           <strong>
                              <div><?php echo displaydateinword($rest['endDate']); ?></div>
                           </strong>
                        </div>
                     </td>
                  </tr>
                  <tr>
                     <td align="left" valign="top">
                        <div class="smtext">By: <strong><?php echo substr(getUserNameNew($rest['addedBy']),0,15); ?>...</strong></div>
                     </td>
                     <td width="60%" align="left" valign="top">
                        <div class="smtext">Created: <strong><?php echo displaydateinnumber($rest['dateAdded']); ?></strong></div>
                     </td>
                  </tr>
                  <tr>
                     <td colspan="2" align="center" valign="top">
                        <div style="font-size:25px; font-weight:600; border-top:1px solid #ddd; padding-top:10px; color:#000000;">&#8377;<?php echo number_format($rest['grossPrice']); ?></div>
                     </td>
                  </tr>
                  <tr>
                     <td colspan="2" align="left" valign="top">
                        <?php if($rest['grossPrice']>0){ ?>
                        <?php if($rest['confirmQuote']==1){ ?>
                           <button type="button" class="btn btn-warning btn-lg waves-effect waves-light" style="width: 100%; background-color: #46cd93 !important; border-color: #46cd93 !important;font-weight: 600 !important;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Itinerary confirmed. This action cannot be undone."><i class="fa fa-check-square" aria-hidden="true"></i> Confirmed</button>
                        <?php } ?>
                        <?php if($rest['confirmQuote']==0){ ?>
                           <button type="button" class="btn btn-warning btn-lg waves-effect waves-light" style="width: 100%; background-color: #f9f9f9 !important; border-color: #cbcbcb !important; color: #464646; font-weight: 600 !important;" onclick="loadpop('Alert',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=confirmitineararies&id=<?php echo encode($rest['id']); ?>&queryid=<?php echo $_REQUEST['id']; ?>">Make Confirm</button>
                        <?php } ?>
						
                           <button type="button" class="btn btn-info btn-lg waves-effect waves-light" style="width: 100%; background-color: #b38135 !important; border-color: #b38135 !important; color: #ffffff; font-weight: 600 !important; margin-top: 10px;" onclick="loadpop('View Quotation',this,'1000px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=shareitinerary&pid=<?php echo encode($rest['id']); ?>">Share Package</button>
						   
                           <button type="button" class="btn btn-info btn-lg waves-effect waves-light" style="width: 100%; background-color: #3574b3 !important; border-color: #246090 !important; color: #ffffff; font-weight: 600 !important; margin-top: 10px;"  onclick="loadpop('View Quotation',this,'1000px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewquotation&id=<?php echo encode($rest['id']); ?>">View Quotation</button>
                        <?php } ?>
                     </td>
                  </tr>
               </table>
            </div>
         </div>
      </div>
      <?php $totalno++; } ?>
      <?php if(strpos($LoginUserDetails["permissionAddEdit"], 'Proposal') !== false) { if($_REQUEST['s']!=4){ ?>	
         <div class="itibox">
            <div class="card addnewcard" style="height:509px;">
               <button type="button" class="btn btn-info btn-lg waves-effect waves-light" onclick="loadpop('Itinerary setup',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addtineraries&queryid=<?php echo $_REQUEST['id']; ?>&startDate=<?php echo $editresult['startDate']; ?>&endDate=<?php echo $editresult['endDate']; ?>&adult=<?php echo $editresult['adult']; ?>&child=<?php echo $editresult['child']; ?>&destination=<?php echo trim($destin); ?>"  ><i class="fa fa-plus" aria-hidden="true"></i> Create itinerary</button>
               <a href="display.html?ga=selectitinerary&qid=<?php echo $_REQUEST['id']; ?>"><button type="button" class="btn btn-warning btn-lg waves-effect waves-light" style="margin-right: 10px; margin-top:20px !important;background-color: #005ee2; border: 1px solid #005ee2;" ><i class="fa fa-download" aria-hidden="true"></i> Insert itinerary</button></a>
            </div>
         </div>
      <?php } } ?>
      <?php if($_REQUEST['s']==4 && $totalno==1){ ?>
      <div style="padding:100px 0px; text-align:center;">
         <div><img src="data:image/png;base64,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">
         </div>
         <em>Nothing Found!</em>
      </div>
      <?php } ?>
   </div>
</div>
<script>
   function duplicatePackage(id){
     var result = confirm("Are you sure you want to create duplicate package?");
     if (result==true) {
      $('#ActionDiv').load('actionpage.php?pid='+id+'&action=addduplicatepackage&queryid=<?php echo $_REQUEST['id']; ?>');
     } else {
      return false;
     }
   }
</script>