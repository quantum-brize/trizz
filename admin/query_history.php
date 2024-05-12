<style>
.activity img.icon-info, .activity i.icon-info {
    color: #9ba7ca;
    background-color: #eef0f6;
}
.activity img.icon-info, .activity i.icon-info {
    color: #9ba7ca;
    background-color: #eef0f6;
}
.activity img, .activity i {
    width: 36px;
    height: 36px;
    text-align: center;
    line-height: 36px;
    border-radius: 12%;
    position: absolute;
    left: -19px;
    color: #4d79f6;
    background-color: #f3f6f7;
    font-size: 20px;
    margin-top: -10px;
    -webkit-box-shadow: 0px 0px 0px 0.5px #f3f6f7;
    box-shadow: 0px 0px 0px 0.5px #f3f6f7;
    -webkit-transform: rotate(45deg);
    transform: rotate(0deg);
}

.activity {
    position: relative;
    border-left: 3px dotted #eff2f9;
    margin: 20px 20px 0 22px;
}
.activity .item-info {
    margin-left: 40px;
    margin-bottom:15px;
}
</style>
<h4 class="mt-0 header-title">History</h4>
<div class="">
<div class="card" style="padding:10px;">
  <table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC"  class="table table-hover mb-0"  style="font-size:12px;">

                                            <thead>
                                                <tr>
                                                  <th width="1%" align="center" bgcolor="#f5f7f9">&nbsp;</th>
                                                  <th align="left" bgcolor="#f5f7f9">Type</th>
                                                  <th align="left" bgcolor="#f5f7f9">Description</th>
                                                  <th align="left" bgcolor="#f5f7f9">By</th>
                                                  <th width="25%" align="left" bgcolor="#f5f7f9">Date</th>
                                                </tr>
                                            </thead>
<tbody>
<?php   
$rs=GetPageRecord('*','queryLogs',' queryId="'.$editresult['id'].'" order by id desc');
while($updatesdata=mysqli_fetch_array($rs)){ 

$b=GetPageRecord('*','sys_userMaster','id="'.$updatesdata['addedBy'].'"'); 
$prifiledata=mysqli_fetch_array($b);

if($prifiledata['userId']!='0'){ 
$c=GetPageRecord('*','sys_userMaster','id="'.$updatesdata['userId'].'"'); 
$assignTodata=mysqli_fetch_array($c);
}  



if($updatesdata['details']=='Query Created'){
$iconclass='fa fa-thumbs-up';
}

if($updatesdata['details']=='Note Created'){
$iconclass='fa fa-sticky-note';
}

if($updatesdata['details']=='Task Created'){
$iconclass='fa fa-calendar';
}

if($updatesdata['details']=='Query Update'){
$iconclass='fa fa-pencil';
}

if($updatesdata['details']=='Assign Query'){
$iconclass='fa fa-retweet';
}


if($updatesdata['logType']=='create_package'){
$iconclass='fa fa-plus';
}
if($updatesdata['details']=='Call Created'){
$iconclass='fa fa-phone';
}

if($updatesdata['logType']=='create_quotation'){
$iconclass='fa fa-plus';
}


if($updatesdata['logType']=='share_package' || $updatesdata['logType']=='share_invoice' || $updatesdata['logType']=='share_quotation'){
$iconclass='fa fa-share';
}

if($updatesdata['logType']=='status_change'){
$iconclass='fa fa-check-square';
}

if($updatesdata['logType']=='status_change'){
$iconclass='fa fa-check-square';
}


if($updatesdata['logType']=='supplier_payment'){
$iconclass='fa fa-credit-card-alt';
}


if($updatesdata['logType']=='client_payment'){
$iconclass='fa fa-money';
}
 
if($updatesdata['logType']=='invoice_update'){
$iconclass='fa fa-file-text';
}

?> 

<tr>
  <td width="1%" align="center" valign="top"><i class="fa fa-dot-circle-o" aria-hidden="true"></i></td>
  <td align="left" valign="top"><?php echo $updatesdata['details']; if($assignTodata['firstName']!=''){ ?> - to <?php echo $assignTodata['firstName']; } ?></td>
  <td align="left" valign="top"><?php echo stripslashes($updatesdata['statusComment']); ?></td>
  <td align="left" valign="top"><span style="text-transform:uppercase;"><?php echo $prifiledata['firstName']; ?></span></td>
  <td width="25%" align="left" valign="top"><?php echo date('j F Y h:i A',strtotime($updatesdata['dateAdded'])); ?></td>
  </tr>


<?php  } ?>
      </tbody>
    </table> 
  </div>

   </div>
</div>