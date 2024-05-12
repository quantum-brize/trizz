<?php if($LoginUserDetails['userType']!=0){ exit(); }

$a=GetPageRecord('*','sys_userMaster','id="'.$_SESSION['userid'].'" order by id desc');  
$result=mysqli_fetch_array($a);
 ?>

<script src="tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
selector: ".editorclass",
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
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top" >
<?php include "settingleft.php"; ?>
	
	</td>
    <td align="left" valign="top" width="90%"><div class="page-content">

      
                    
                    <!-- start page title -->
                     
              
                        <div class=" ">
                        <div class="col-md-12 col-xl-12">
						<div >
                            <div class="card-body" style="padding:10px;"> 
                                    <h4 class="card-title" style="margin-top: 0px !important; padding-left: 10px !important; padding-top: 10px !important; padding-bottom: 5px !IMPORTANT;padding-right: 0px !important;">Default Settings
                                      <div class="float-right">
									 
									</div></h4>
                  
							 <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">	
 
	<div class="modal-body">			
	<div class="row">
	<div class="col-md-12">
	<div class="form-group">
	<label>Invoice / Itinerary logo </label>
	<div class="custom-file">
	<input name="changeprofilepic" type="file" class="custom-file-input" id="customFile">
	<input name="oldchangeprofilepic" type="hidden" value="<?php echo $result['invoiceLogo']; ?>" >
	<label class="custom-file-label" for="customFile">Choose file</label>
	</div>
	</div>
	</div>
<div class="col-md-12"> 
<div class="form-group">
<label for="validationCustom02">Invoice terms and conditions </label>
  <textarea name="inclusion" rows="5" class="form-control editorclass" required=""><?php echo stripslashes($result['inclusion']); ?></textarea>
</div></div>


<div class="col-md-12"> 
<div class="form-group">
<label for="validationCustom02">Package terms and conditions </label>
  <textarea name="invoiceTerms" rows="5" class="form-control editorclass" required=""><?php echo stripslashes($result['invoiceTerms']); ?></textarea>
</div></div>
 
  <div class="col-md-12"> 
<div class="form-group">
<label for="validationCustom02">Bank information </label>
  <textarea name="packageImportantTips" rows="5" class="form-control editorclass" required=""><?php echo stripslashes($result['packageImportantTips']); ?></textarea>
</div></div>


<div class="col-md-12"> 
<img src="images/leadgeticon.png" height="100" style="margin:40px 0px;" />
<div class="form-group">
<label for="validationCustom02">Google sheet URL for leads fetching </label>
  <input name="leadURL" type="text" class="form-control" value="<?php echo stripslashes($result['leadURL']); ?>" required="" />
</div></div>
</div> 


<hr />
 

<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"><img src="payment/Razorpay_logo.svg.png" height="30" /></td>
    <td width="95%" style="font-size: 20px; padding-top: 6px;">&nbsp;&nbsp;Payment Gateway Setting</td>
  </tr>
</table> 
</div>
<div class="col-md-12"> 
<div class="form-group">
<label for="validationCustom02">API Key</label>
  <input name="paymentAPIKey" type="text" class="form-control" id="paymentAPIKey" value="<?php echo stripslashes($result['paymentAPIKey']); ?>" required="" />
</div></div>


<div class="col-md-12"> 
<div class="form-group">
<label for="validationCustom02">API Secret</label>
  <input name="paymentAPISecret" type="text" class="form-control" id="paymentAPISecret" value="<?php echo stripslashes($result['paymentAPISecret']); ?>" required="" />
</div></div>


 <div class="modal-footer"> 
<input name="Save" type="submit" value="Save"   id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';"  />
</div>

<input name="action" type="hidden" id="action" value="setlogoandinclusion" />  
</form>
                                        
                           
									
						  </div>
								 
                             
</div>
                             

                        </div>

                         
						
						
						
						 
                     

             </div><!--end col-->
			 
			 
			 
			 
			 
			 
			  

            <!-- end row -->

    </div></td>
  </tr>
</table>
                

        <!-- End Page-content -->

         
    </div>
  </div>	</div>