<?php  
$abcd=GetPageRecord('*','clientGroupMaster','id="'.decode($_REQUEST['g']).'"'); 
$result=mysqli_fetch_array($abcd); 


$wheremore='';
if($_REQUEST['birthdaywish']!=''){
$wheremore=' and clientId in (select id from userMaster where month(dob)="'.date('m').'" )';
}

if($_REQUEST['anniversary']!=''){
$wheremore=' and clientId in (select id from userMaster where month(marriageAnniversary)="'.date('m').'" )';
}
?>


<div class="wrapper">
<div class="container-fluid">
<div class="main-content">

                <div class="page-content">

      
                    
                    <!-- start page title -->
                     
              
                        <div class="row">
                        <div class="col-md-12 col-xl-12">
						<div class="card" style="min-height:500px;">
                            <div class="card-body" style="padding:0px;"> 
                                    <h4 class="card-title" style=" margin-top:0px;"><?php echo stripslashes($result['name']); ?> - Subscriber<div class="float-right">
									
									<a href="display.html?ga=clients-group">
									<button type="button" class="btn btn-secondary btn-lg waves-effect waves-light"  style="margin-bottom:20px;">Back</button>
									</a>
								 
									</div></h4> 
							 <div   style="  margin-bottom: 20px; float: left; width: 100%; border-top: 1px solid #dee2e6; border-bottom: 2px solid #dee2e6; background-color: #f3f3f3; padding: 8px;">
								 
								  <div class="row" style="margin-right: 0px; margin-left: 0px;">
								  
								    
								  <div class="col-md-3 col-xl-3">
								   <form  action=""    method="post" enctype="multipart/form-data">	
								  <input type="text" name="keyword" class="form-control"  placeholder="Search by name, email, mobile"  value="<?php echo $_REQUEST['keyword']; ?>" style="margin-top: 3px;">
								  <input name="page" type="hidden" value="<?php echo $_REQUEST['page']; ?>" />
								  </form>
								  </div>
								 </div>
								 
							  </div><form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm" >
							 <?php if($_SESSION['userid']==1){ ?> <div id="bulkassign" style="display:none;padding: 5px 2px; background-color: #f0f0f0; border-bottom: 2px solid #ddd; border-radius: 3px; margin-bottom: 10px; width:100%; float:left;"><table border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td style="font-size:13px;"><input type="checkbox" id="ckbCheckAll"  style="width: 16px; height: 16px;margin-left: 6px;" /></td>
    <td style="font-size:13px;">Select All&nbsp;</td>
 
    <td><button type="submit"  id="savingbutton" class="btn btn-primary btn-primaryred" onclick="this.form.submit(); this.value='Saving...';"  style="float:right;padding: 3px 10px;"  >
                                                Remove Selected Clients From This Group
                                            </button><input name="assignToPerson" type="hidden" value="<?php echo ($result['id']); ?>" /></td>
    <td><input autocomplete="false" name="action" type="hidden" id="action" value="bulkclientremovefromgroup" /></td>
  </tr>
</table>
</div> <?php } ?>
							  
							  
							  <table class="table mb-0">
                                                <thead>
                                                </thead>
                                                <tbody>
												
												<?php

$searchKeyword='';
$searchKeyword=$_REQUEST['keyword'];
$totalmail='0';
$select='';
$where='';
$rs=''; 
$select='*'; 
$wheremain='';
if($searchKeyword!=''){ 
 $searchwhere=' and (	firstName like "%'.$searchKeyword.'%" or mobile like "%'.$searchKeyword.'%"  or email like "%'.$searchKeyword.'%"    ) '; 
}


$where=' where (userType=4) and (firstName like "%'.$_REQUEST['keyword'].'%" or lastName like "%'.$_REQUEST['keyword'].'%" or email like "%'.$_REQUEST['keyword'].'%" or mobile like "%'.$_REQUEST['keyword'].'%") and id in (select clientId from clientGroupContacts where groupId='.$result['id'].' '.$wheremore.' )  order by id desc'; 
 
$limit=clean($_GET['records']);
$page=clean($_GET['page']);

$sNo=1;

$targetpage='display.html?ga='.$_REQUEST['ga'].'&keyword='.$searchKeyword.'&';
 
$rs=GetRecordList('*','userMaster','  '.$where.'  ','50',$page,$targetpage);

$totalentry=$rs[1];

$paging=$rs[2]; //pagination

while($rest=mysqli_fetch_array($rs[0])){ 
?>
                                                    <tr>
                                                      <th width="1%" valign="top"><?php if($rest['email']!='' && $_SESSION['userid']==1){ ?><input type="checkbox" name="assignall[]" class="checkBoxClass" id="assignqury" value="<?php echo encode($rest['id']); ?>" onclick="selectedfun();" style="width: 16px; height: 16px;"><?php } ?></th>
                                                        <th valign="middle"><a >
                                                <div class="media">
                                                    <div class="mr-3 align-self-center">
                                                        <img src="<?php if($rest['profilePhoto']!=''){ ?>profilepic/<?php echo $rest['profilePhoto']; ?><?php } else { ?>images/noimage.png<?php } ?>" alt="" class="avatar-sm rounded-circle">                                                    </div>
                                                    <div class="media-body overflow-hidden">
                                                        <h6 class="font-size-16 mb-1"><?php echo stripslashes($rest['submitName']); ?> <?php echo stripslashes($rest['firstName']); ?></h6>
                                                        <p class="text-truncate mb-0"><span class="lightbox">Email: <strong><?php echo $rest['email']; ?></strong> &nbsp;|&nbsp; Mobile: <strong><?php if(checkmobile(trim($rest['mobile']))!='<span class="lightgraytext">Not Provided</span>'){  echo stripslashes($rest['mobileCode']); ?><?php } echo checkmobile(trim($rest['mobile'])); ?></strong>&nbsp;&nbsp;|&nbsp;&nbsp;City:</span> <strong><?php  $a=GetPageRecord('*','cityMaster','id="'.$rest['city'].'"'); $profilename=mysqli_fetch_array($a); echo $profilename['name']; ?></strong></p>
														
														<p><span class="lightbox">DOB: <strong><?php if(date('d-m-Y',strtotime($rest['dob']))>'01-01-1970' && date('d-m-Y',strtotime($rest['dob']))!='30-11--0001'){ echo date('j F Y',strtotime($rest['dob'])); } else { echo 'Not Provided'; }?></strong> &nbsp;|&nbsp; Anniversary: <strong><?php if(date('d-m-Y',strtotime($rest['marriageAnniversary']))>'01-01-1970' && date('d-m-Y',strtotime($rest['marriageAnniversary']))!='30-11--0001'){ echo date('j F Y',strtotime($rest['marriageAnniversary'])); } else { echo 'Not Provided'; }?></strong></span></p>
                                                    </div>
                                                </div>
                                            </a></th>
                                                        <td valign="middle">
														
														
														<strong><?php  $a=GetPageRecord('*','sys_userMaster','id="'.$rest['addedBy'].'"'); $profilename=mysqli_fetch_array($a); echo $profilename['firstName']; ?></strong><br />
<?php echo date('d-m-Y',$rest['dateAdded']); ?></td>
                                                    </tr> 
													
													<?php $sNo++; } ?>
                                                </tbody>
                                            </table>
							  </form>
							  
                                         
                           
									 <?php if($totalno==1){ ?>
						   <div style="text-align:center; padding:40px 0px; font-size:14px; color:#999999;">No Clients</div>
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

$(document).ready(function () {
    $("#ckbCheckAll").click(function () {
        $(".checkBoxClass").prop('checked', $(this).prop('checked'));
		if($(".checkBoxClass").prop('checked') == true){
		$('#bulkassign').show();
		}else{
		$('#bulkassign').hide();
		}
    });
});
function selectedfun(){ 
var mychecked = $('.checkBoxClass:checked').length 
if (mychecked==0) {
    $('#bulkassign').hide();
}
if (mychecked>0) {
    $('#bulkassign').show();
} 
}

</script>

