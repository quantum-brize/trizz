<?php
$abcd=GetPageRecord('*','userMaster','id="'.$editresult['clientId'].'"'); 
$clientInfoData=mysqli_fetch_array($abcd); 
?> <?php if (strpos($LoginUserDetails["permissionAddEdit"], 'Mails') !== false) { ?>

<div class="btn-toolbar p-3" role="toolbar" style="background-color: #cfd7df42;">
                                      	 <div class="btn-group mr-2 mb-2 mb-sm-0" style="overflow:visible;">
                                            <button type="button"  popaction="action=composemail&queryId=<?php echo encode($editresult['id']); ?>" onclick="loadpop('Compose Mail',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center"   class="btn btn-primary waves-light waves-effect"><i class="fa fa-envelope-o"></i> &nbsp;Compose</button> 
                                        </div>
										<div class="btn-group mr-2 mb-2 mb-sm-0">
                                            <button style="background-color: #fff; border: 1px solid #ddd; font-size:12px;" type="button" class="btn btn-light waves-effect"  popaction="action=composemail&queryId=<?php echo encode($editresult['id']); ?>" onclick="loadpop('Compose Mail',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center"><i class="fa fa-info-circle"></i> <?php echo $clientInfoData['email']; ?></button> 
                                        </div>
								 
                                    </div>		<?php } ?>
 
<style>
.mailsent .fa-arrow-circle-left{font-size: 18px;
    color: #f47836;
    padding-right: 7px;
    position: absolute;
    top: 17px;    left: 3px;}
	
	.message-list li { 
    border-bottom: 1px solid #e6e6e6;
}
</style>

<ul class="message-list">
<?php

 
$a=GetPageRecord('*','queryMail','queryId="'.$editresult['id'].'" order by id desc');
while($maillist=mysqli_fetch_array($a)){  ?>

                                        <li onClick="">
                                            <div class="col-mail col-mail-1">
                                                 
                                                <a  popaction="action=showquerymail&id=<?php echo encode($maillist['id']); ?>&queryId=<?php echo encode($editresult['id']); ?>" onclick="loadpop('Mail',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center" class="title mailsent" style=" cursor:pointer; left: 0px; padding-left:28px;"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> <?php echo $maillist['toEmail']; ?></a>
                                            </div>
                                            <div class="col-mail col-mail-2">
                                                <a class="title mailsent" popaction="action=showquerymail&id=<?php echo encode($maillist['id']); ?>&queryId=<?php echo encode($editresult['id']); ?>" onclick="loadpop('Mail',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center"  style="cursor:pointer;"><?php if($maillist['mailType']!='0'){ ?><span class="badge-warning badge mr-2"><?php echo $maillist['mailType']; ?></span><?php } ?><?php echo stripslashes($maillist['subject']); ?>
                                                    </a>
                                                <div class="date" style="padding-left:10px; font-size:12px;"><?php if(date('Y-m-d',strtotime($maillist['dateAdded']))==date('Y-m-d')){ echo 'Today'.' '.date('h:i A',strtotime($maillist['dateAdded'])); } else { echo date('j F Y',strtotime($maillist['dateAdded'])); } ?></div>
                                            </div>
                                        </li>
										
										<?php } ?>
 

                                    </ul>