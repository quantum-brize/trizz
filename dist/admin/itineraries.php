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

      
                    <div class="newboxheading"><div class="newhead">Itineraries<form  action=""  class="newsearchsecform"  style="top: -9px; left: 76px !important;"  method="get" enctype="multipart/form-data">	
								  <input type="text" name="keyword" class="form-control newsearchsec"  placeholder="Search by name"  value="<?php echo $_REQUEST['keyword']; ?>" style="margin-top: 3px;">
								  <input name="ga" type="hidden" value="<?php echo $_REQUEST['ga']; ?>" />
								  </form>
 <div class="newoptionmenu">

  
 
 									 
 
  
   
 
    									 
										 
     
   
 <div>
 <?php if (strpos($LoginUserDetails["permissionAddEdit"], 'Itinerary') !== false) { ?>	<button type="button" class="btn btn-secondary btn-lg waves-effect waves-light"  onclick="loadpop2('Itinerary setup',this,'600px')" data-toggle="modal" data-target="#myModal2" data-backdrop="static"  popaction="action=addtineraries">Create itinerary</button> <?php } ?>							 
 </div>
 

  

									
									
  
		  
		  

 </div>
 </div>     
 
     
</div>
                    <!-- start page title -->
                     
              
                      <div style="padding-top: 34px;">
                        <div class="col-md-12 col-xl-12" style="padding-left:0px; padding-right:0px;">
						              <div class="">
                            <div class="card-body" style=" background-color:#FFFFFF;"> 
                                     
                                     
							 
                                        <table class="table table-hover mb-0">

                                            <thead>
                                                <tr>
                                            
                                                  <th>Title</th>
                                                  <?php if($withwebsite=='yes'){ ?>  
                                              
                                                  <th align="center" style="display:none;">Website&nbsp;Cost </th>
                                                    <th align="center"><div align="center">Website</div></th>
                                                    <?php } ?>
                                                    <th><div align="center">Duration</div></th>
                                                    <th width="1%">
                                    <div align="center">Gallery</div>                                 </th>
                                                    <th>Price</th>
                                                    <th width="12%">Date</th>
                                                    <th width="1%">&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>
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
$where4=' and (name like "%'.$_REQUEST['keyword'].'%" or destinations like "%'.$_REQUEST['keyword'].'%") ';
}


$totalno='1';
$select='';
$where='';
$rs=''; 
$select='*'; 
$wheremain=''; 
$where=' where 1 and  queryId=0 and websiteUse=0 '.$where2.' '.$where3.'  '.$where4.'  order by id desc'; 
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 
$targetpage='display.html?ga='.$_REQUEST['ga'].'&s='.$_REQUEST['s'].'&'; 
$rs=GetRecordList('*','sys_packageBuilder','  '.$where.'  ','25',$page,$targetpage);

$totalentry=$rs[1];

$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 


$namevalue ='seoURL="'.SEO($rest['name']).'"';  
$where='id="'.$rest['id'].'"';    
updatelisting('sys_packageBuilder',$namevalue,$where); 
?>

<tr>
  <td>
<a href="display.html?ga=itineraries&view=1&id=<?php echo encode($rest['id']); ?>">
<table border="0" cellpadding="0" cellspacing="0"  class="addbynewbadges">
  <tr>
   <?php if($rest['coverPhoto']!=''){ ?> <td colspan="2"  style="padding-right:10px !important;"><img src="<?php echo $fullurl; ?>package_image/<?php echo $rest['coverPhoto']; ?>" width="64" height="46" /></td>
   <?php } ?>
    <td><?php echo stripslashes($rest['name']); if($rest['destinations']!=''){ ?>
<div style="color:#999999; font-size:10px; margin-top:2px;">ID: <?php echo encode($rest['id']); ?> -  <?php echo stripslashes($rest['destinations']); ?> &nbsp;|&nbsp; <?php echo stripslashes($rest['adult']); ?> Adult(s) - <?php echo stripslashes($rest['child']); ?> Child(s)</div><?php } ?></td>
  </tr>
</table>
 </a></td>
 <?php if($withwebsite=='yes'){ ?>
    <td style="display:none;" align="center">&#8377;<?php echo number_format($rest['grossPrice']); ?> </td>
  <td align="center"><div align="center">
    <?php if($rest['showwebsite']==1){ ?>
    <span class="badge badge-success">Yes</span>
    <?php } else { ?>
    <span class="badge badge-danger">No</span>
    <?php } ?>
  </div></td><?php } ?>
  <td><div align="center"><?php echo $rest['days']; ?> Days</div></td>
  <td width="1%">
                                    <div align="center"><a class="dropdown-item"  style="cursor:pointer; font-size:12px; text-decoration:underline;" onclick="loadpop('Gallary',this,'800px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addItinerariesGallary&id=<?php echo encode($rest['id']); ?>">Upload</a></div>                                 </td>
  <td>&#8377;<?php echo number_format($rest['grossPrice']+$rest['extraMarkup']); ?> </td>
<td width="12%"><?php echo date('d-m-Y', strtotime($rest['dateAdded'])); ?></td>
<td width="1%"> <div class="">
                                            <button type="button" class="optionmenu" data-toggle="dropdown" aria-expanded="false">
                                         <i class="mdi mdi-dots-vertical"></i>                                            </button>
                                            <div class="dropdown-menu" style="">
											  
												<div class="leg">ACTIONS</div>
											<?php if (strpos($LoginUserDetails["permissionAddEdit"], 'Itinerary') !== false) { ?>
                                                <a class="dropdown-item"  style="cursor:pointer;" onclick="loadpop2('Itinerary setup',this,'600px')" data-toggle="modal" data-target="#myModal2" data-backdrop="static"  popaction="action=addtineraries&id=<?php echo encode($rest['id']); ?>">Edit Itinerary</a>
												
												<a href="#" onclick="duplicatePackage('<?php echo encode($rest['id']); ?>');" class="dropdown-item">Duplicate</a>
												
												<?php } ?>
						  </div>
                                        </div> </td>
</tr>


<?php $totalno++; } ?>
                                            </tbody>
                                        </table>
                           <?php if($totalno==1){ ?>
						   <div style="text-align:center; padding:40px 0px; font-size:14px; color:#999999;">No Itinerary</div>
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
function duplicatePackage(id) {
  var result = confirm("Are you sure you want to create duplicate package?");
  if (result==true) {
   $('#ActionDiv').load('actionpage.php?pid='+id+'&action=addduplicatepackage');
  } else {
   return false;
  }
}
</script>