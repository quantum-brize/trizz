<?php 
$abcd=GetPageRecord('*','sys_userMaster','id="'.$_SESSION['userid'].'"'); 
$result=mysqli_fetch_array($abcd); 

$as=GetPageRecord('*','sys_userMaster','id=1'); 
$bankdata=mysqli_fetch_array($as); 
 
 ?>
 <script src="tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
selector: "#emailsignature",
themes: "modern",
plugins: [
"advlist autolink lists link image charmap print preview anchor",
"searchreplace visualblocks code fullscreen"
],
toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
});
</script>

<div class="wrapper">
<div class="container-fluid">
<div class="main-content">

                <div class="page-content">

      
                    <div class="row" style="padding-left:20px;padding-right:20px;">
                        <div class="col-lg-6">
                                            <div class="card">
                                                <div class="card-body"> <h4 class="header-title mt-0 mb-3">Setup SMTP Settings</h4>
                                                    <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">
															<div class="col-md-12">
															<div class="table-responsive mb-0 fixed-solution" data-pattern="priority-columns"> 
															<div class="alert icon-custom-alert alert-outline-success alert-success-shadow" role="alert" id="mailsenddiv" style=" display:none;   ">
																<i class="mdi mdi-check-all alert-icon"></i>
																<div class="alert-text">
																<strong>Changes Saved</strong>
																</div>                                            
																</div>
										<table class="table mb-0">
																				
											<tbody>
											<tr>
												<td width="30%">Name</td>
												<td><input name="fromName" type="text" class="form-control" id="fromName" value="<?php echo $LoginUserDetails['fromName']; ?>" maxlength="30"></td>
											</tr>
											<tr>
												<td width="30%">Email</td>
												<td><input name="emailAccount" type="email"  class="form-control" id="emailAccount" value="<?php echo $LoginUserDetails['emailAccount']; ?>"></td>
											</tr>
											<tr>
												<td width="30%">Password</td>
												<td><input name="emailPassword" type="password" class="form-control" id="emailPassword" value="<?php echo $LoginUserDetails['emailPassword']; ?>" ></td>
											</tr>
											<tr>
												<td width="30%">SMTP Server</td>
												<td><input name="smtpServer" type="text" class="form-control" id="smtpServer" value="<?php echo $LoginUserDetails['smtpServer']; ?>"  ></td>
											</tr>
											<tr>
												<td width="30%">Port</td>
												<td><input name="emailPort" type="text" class="form-control" id="emailPort" value="<?php echo $LoginUserDetails['emailPort']; ?>" maxlength="5"></td>
											</tr>
											<tr>
											  <td width="30%">Security Type</td>
											  <td> 
											  <select id="securityType" name="securityType" class="form-control" displayname="Security Type" autocomplete="off">  
											<option value="false" <?php if($LoginUserDetails['securityType']=='false'){ ?>selected="selected"<?php } ?>>None</option>
											<option value="true" <?php if($LoginUserDetails['securityType']=='true'){ ?>selected="selected"<?php } ?>>SSL</option>
											</select>
											  
											  </td>
											</tr>
											<tr>
											  <td width="30%">&nbsp;</td>
											  <td><button type="submit" class="btn btn-primary px-5 py-2">Save</button>
											  <input name="action" type="hidden" id="action" value="savemailsetting">
											  </td>
											</tr>        
											</tbody>
										</table>
																</div>
																</form>
        
                                                     
                                                </div>                                            
                                            </div>
                                        </div><!--end col-->
                    </div>
					
					
					<div class="col-lg-6">
                                            <div class="card"><h5 class="card-header bg-secondary text-white mt-0">Configure Email</h5>
                                              <div class="card-body">  
                                                     
       
                                                     <div   style="text-align:center;">
													 Connect your email inbox  and transform the way you do sales.<br />
													 
													 <table border="0" align="center" cellpadding="0" cellspacing="0" style="font-size:12px; margin:4px 0px;">
  <tr>
    <td align="center" style="padding:0px 20px;"><img src="images/e1.png" height="97" /><br />
Access your customer emails with holistic CRM information</td>
    <td align="center" style="padding:0px 20px;"><img src="images/e2.png" height="97" /><br />
      Send and receive mails from inside CRM records</td>
    <td align="center" style="padding:0px 20px;"><img src="images/e3.png" height="97" /><br />
      Synchronize your email inbox</td>
  </tr>
</table>

<br />

                                                
                                                    <div style="padding:10px; background-color:#F5F5F5; text-align:left;">  <strong>Use the following settings:</strong>
                                                        <div style="margin-top:10px; font-size:12px;">
                                         
                                                            1) Mail.com SMTP server address:&nbsp;<strong>smtp.yourdomain.com</strong><br />
                                                            2) Mail.com SMTP username:&nbsp;<strong>Your full yourdomain.com email address</strong><br />
                                                            3) Mail.com SMTP password:&nbsp;<strong>Your yourdomain.com password</strong><br />
                                                            4) Mail.com SMTP&nbsp;port:&nbsp;<strong>587</strong>&nbsp;(alternatives:&nbsp;<strong>465&nbsp;</strong>and&nbsp;<strong>25</strong>)<br />
                                                            5) Mail.com SMTPTLS/SSL required:&nbsp;<strong>yes&nbsp;</strong>(<strong>no&nbsp;</strong>can be used as an alternative)
                                                     
                                                        </div></div>
                                             
                                                </div>
                                              </div>                                            
                                            </div>
                                        </div><!--end col-->
                    </div>

            <!-- end row -->

    </div>

        <!-- End Page-content -->

         
    </div>
	</div>	</div>