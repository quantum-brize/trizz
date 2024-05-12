<?php   
$fd=GetPageRecord('*','queryMaster','id="'.decode($_REQUEST['id']).'"'); 
$queryData=mysqli_fetch_array($fd);


?>

<style>
 
 
.statusbox{margin-right: 5px; padding: 10px; text-align: center; background-color: #000000; font-size: 13px; color: #fff; border-radius: 4px; text-transform:uppercase;}
.conf{width: 100px;
    border: 1px solid #ddd;
    border-radius: 3px;
    padding: 5px;
    text-align: center;}
</style>
<div>
<div>
 

 
 
<div> 
<h4 class="mt-0 header-title" style="border-bottom:0px; overflow:hidden; position:relative;">Guests (<?php $ba=GetPageRecord('count(id) as totalpayments','sys_guests',' queryId="'.$editresult['id'].'" '); $packagecostrecivedpayment=mysqli_fetch_array($ba); echo number_format($packagecostrecivedpayment['totalpayments']); ?>)
<?php if (strpos($LoginUserDetails["permissionAddEdit"], 'Guest') !== false) { ?>


<button type="button"  onclick="loadpop('Add Guest',this,'700px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addGuest&queryId=<?php echo $_REQUEST['id']; ?>&packageId=<?php echo encode($packagedatadetials['id']); ?>" style="position: absolute; font-size: 12px; font-weight: 600; right: 5px; top:2px; background-color: #005ee2; color: #fff; padding: 2px 10px; border-radius: 3px; border:0px; cursor: pointer;">+Add Guest</button>
<?php } ?>


</h4>

<div class="card" style="padding:10px;">
  <table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC"  style="font-size:14px;" class="table table-hover mb-0"> 

                                            <thead>
                                                <tr>
                                                  <th bgcolor="#f5f7f9">First Name</th>
                                                  <th bgcolor="#f5f7f9">Last Name</th>
                                                  <th bgcolor="#f5f7f9">Gender</th>
                                                  <th bgcolor="#f5f7f9">Date of Birth </th>
                                                  <th width="1%" bgcolor="#f5f7f9"> </th>
                                                </tr>
                                            </thead>
<tbody>
<?php 
$totalno=1;
$rs=GetPageRecord('*','sys_guests',' queryId="'.decode($_REQUEST['id']).'" order by id desc');
while($rest=mysqli_fetch_array($rs)){ 
?>

<tr>
  <td align="left" valign="middle"><?php echo stripslashes($rest['submitName']); ?> <?php echo stripslashes($rest['firstName']); ?></td>
  <td align="left" valign="middle"><?php echo stripslashes($rest['lastName']); ?></td>
  <td align="left" valign="middle"><span style="text-transform:uppercase;"><?php echo stripslashes($rest['gender']); ?></span></td>
  <td align="left" valign="middle"><?php echo date('d-m-Y', strtotime($rest['dob'])); ?></td>
  <td width="1%" align="left" valign="middle"><div align="right" style="width:140px;">
  <?php  if (strpos($LoginUserDetails["permissionAddEdit"], 'Guest') !== false) { ?>
  <button type="button" class="btn btn-info btn-sm waves-effect waves-light" onclick="loadpop('Upload Documents',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addGuestDocuments&queryId=<?php echo $_REQUEST['id']; ?>&id=<?php echo encode($rest['id']); ?>" style="margin-bottom:0px; margin-bottom: 0px; margin: 0px 5px;">Document</button>
  
  <button type="button" class="btn btn-info btn-sm waves-effect waves-light" onclick="loadpop('Edit Guest',this,'700px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addGuest&queryId=<?php echo $_REQUEST['id']; ?>&id=<?php echo encode($rest['id']); ?>" style="margin-bottom:0px; margin-bottom: 0px; margin: 0px 5px;">Edit</button>
  

  <?php } ?>
  </div>
  </td>
</tr>


<?php  $totalno++; } ?>
      </tbody>
    </table> 
	</div>
</div>    
</div>
							   
							   
							   