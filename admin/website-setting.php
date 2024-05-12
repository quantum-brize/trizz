<?php 
 
$select1='*';    
$where1='id=1';  
$rs1=GetPageRecord($select1,'websiteSetting',$where1);   
$editresult=mysqli_fetch_array($rs1);  

 
 

 ?>

 <script language="JavaScript" type="text/javascript" src="ckeditor/ckeditor.js"></script> 
<script language="JavaScript" type="text/javascript" src="ckeditor/ckfinder/ckfinder.js"></script>

<style>
.table td, .table th {
    vertical-align: top;
}
label{width: 100% !important; margin-bottom: 2px !important;font-size: 12px; text-transform: uppercase;}
</style>
<div class="wrapper">
<div class="container-fluid">
<div class="main-content">

                <div class="page-content">

      
                    
                    <!-- start page title -->
                     
              
                        <div class=" ">
                        <div class="col-md-12 col-xl-12">
						<div class="card" style="min-height:500px;">
                            <div class="card-body"> 
                                    <h4 class="card-title" style=" margin-top:0px; overflow:hidden;">Website Setting<div class="float-right">
									 
									</div></h4> 
									        <div class=" "> 
									
									<form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm" > 
                    <div class=" ">
                        <div class="col-lg-12">
               
                                 
                                    <div class="row"> 
                                         


										  <div class="col-lg-12">
										  
										  <div class="row"  style="padding: 5px; margin: 5px; border: 1px solid #ddd; padding-top: 12px; border-radius: 4px;">
										  	 
							  
										
										 
										
										
										<div class="col-lg-4">
											 <div class="form-group"> 
											 <label for="validationCustom02">Company Name <span style="color:#FF0000;">*</span></label>
                                          <input type="text" class="form-control redborder" id="companyName" name="companyName"    value="<?php echo stripslashes($editresult['companyName']); ?>" >
                                        </div>
										</div>
											
		 
											<div class="col-lg-4">
											 <div class="form-group"> 
											 <label for="validationCustom02">Website Logo <span style="color:#FF0000;">*</span></label>
                                          <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"><input name="logoattachment" type="file"   class="form-control"/><input name="websiteLogo" type="hidden" id="websiteLogo" value="<?php echo stripslashes($editresult['websiteLogo']); ?>" /></td>
    <td width="50%" align="center"><img src="profilepic/<?php echo stripslashes($editresult['websiteLogo']); ?>" height="30" style="max-width:200px;" /></td>
  </tr>
</table>

                                        </div>
										</div> 
											
		 
											<div class="col-lg-4">
											 <div class="form-group"> 
											 <label for="validationCustom02">Favicon <span style="color:#FF0000;">*</span></label>
                                         <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"><input name="faviiconattachment" type="file"   class="form-control"/>
      <input name="websiteFavicon" type="hidden" id="websiteFavicon" value="<?php echo stripslashes($editresult['websiteFavicon']); ?>" /></td>
    <td width="50%" align="center"><img src="profilepic/<?php echo stripslashes($editresult['websiteFavicon']); ?>" width="30" height="30" style="max-width:200px;" /></td>
  </tr>
</table>
                                        </div>
										</div> 
											 			 
											  <div class="col-lg-12"> <h5>Contact Setting</h5></div>
											 
											  <div class="col-lg-3">
											 <div class="form-group"> 
											 <label for="validationCustom02">Contact Phone</label>
                                          <input type="text" class="form-control redborder" id="contactPhone" name="contactPhone"    value="<?php echo stripslashes($editresult['contactPhone']); ?>" >
                                        </div>
										</div>
											 <div class="col-lg-3">
											 <div class="form-group"> 
											 <label for="validationCustom02">Contact Email</label>
                                          <input type="text" class="form-control redborder" id="contactEmail" name="contactEmail"    value="<?php echo stripslashes($editresult['contactEmail']); ?>" >
                                        </div>
										</div>
										
										 <div class="col-lg-3">
											 <div class="form-group"> 
											 <label for="validationCustom02">WhatsApp Number</label>
                                          <input type="text" class="form-control redborder" id="whatsAppNumber" name="whatsAppNumber"    value="<?php echo stripslashes($editresult['whatsAppNumber']); ?>" >
                                        </div>
										</div>
										
										<div class="col-lg-3">
											 <div class="form-group"> 
											 <label for="validationCustom02">Contact Form Email</label>
                                          <input type="text" class="form-control redborder" id="queryEmail" name="queryEmail"    value="<?php echo stripslashes($editresult['queryEmail']); ?>" >
                                        </div>
										</div>
										
										
										<div class="col-lg-12">
											 <div class="form-group"> 
											 <label for="validationCustom02">Contact Address</label>
                                             <textarea name="contactAddress" rows="3" class="form-control redborder" id="contactAddress"><?php echo stripslashes($editresult['contactAddress']); ?></textarea>
                                        </div>
										</div>
											 
											<div class="col-lg-12"> <h5>Home Page SEO</h5></div>
											 
											 
											 
											 				
										
										<div class="col-lg-6">
											 <div class="form-group"> 
											 <label for="validationCustom02">Meta Title </label>
                                          <input type="text" class="form-control redborder" id="metaTitle" name="metaTitle"    value="<?php echo stripslashes($editresult['metaTitle']); ?>" >
                                        </div>
										</div>
											
		 
												<div class="col-lg-6">
											 <div class="form-group"> 
											 <label for="validationCustom02">Meta Keyword </label>
                                          <input type="text" class="form-control redborder" id="metaKeyword" name="metaKeyword"    value="<?php echo stripslashes($editresult['metaKeyword']); ?>" >
                                        </div>
										</div> 
										
										<div class="col-lg-12">
											 <div class="form-group"> 
											 <label for="validationCustom02">Meta Desctiption</label>
                                             <textarea name="metaDesctiption" rows="3" class="form-control redborder" id="metaDesctiption"><?php echo stripslashes($editresult['metaDesctiption']); ?></textarea>
                                        </div>
										</div>
										
										
										
										
										
										<div class="col-lg-12"> <h5>Widget Script</h5></div>
										
										<div class="col-lg-6">
											 <div class="form-group"> 
											 <label for="validationCustom02">Header Script</label>
                                             <textarea name="headerScript" rows="3" class="form-control redborder" id="headerScript"><?php echo stripslashes($editresult['headerScript']); ?></textarea>
                                        </div>
										</div>
										
										<div class="col-lg-6">
											 <div class="form-group"> 
											 <label for="validationCustom02">Footer Script</label>
                                             <textarea name="footerScript" rows="3" class="form-control redborder" id="footerScript"><?php echo stripslashes($editresult['footerScript']); ?></textarea>
                                        </div>
										</div>
										
										
										<div class="col-lg-12"> <h5>Social Networking</h5></div>
										
										<div class="col-lg-3">
											 <div class="form-group"> 
											 <label for="validationCustom02">Facebook</label>
                                             <input name="facebookURL" type="text" class="form-control redborder" id="facebookURL" value="<?php echo stripslashes($editresult['facebookURL']); ?>" />
                                        </div>
										</div>
										
										<div class="col-lg-3">
											 <div class="form-group"> 
											 <label for="validationCustom02">Twitter</label>
                                             <input name="twitterURL" type="text" class="form-control redborder" id="twitterURL" value="<?php echo stripslashes($editresult['twitterURL']); ?>" />
                                        </div>
										</div>
										
										<div class="col-lg-3">
											 <div class="form-group"> 
											 <label for="validationCustom02">Instagram</label>
                                             <input name="instagramURL" type="text" class="form-control redborder" id="instagramURL" value="<?php echo stripslashes($editresult['instagramURL']); ?>" />
                                        </div>
										</div>
										
										<div class="col-lg-3">
											 <div class="form-group"> 
											 <label for="validationCustom02">YouTube</label>
                                             <input name="youtubeURL" type="text" class="form-control redborder" id="youtubeURL" value="<?php echo stripslashes($editresult['youtubeURL']); ?>" />
                                        </div>
										</div>
										
											
										  </div>		  
                                             
											  
											 
										 
											                              
                                        </div>

                                         
                                    </div>  
									
									
									
									                                                                    
                        
								<div class="row">
								<div class="col-lg-12">
								
							  <div class="form-group mb-0" style="padding: 20px 10px;  border-top: 1px solid #e6e6e6; overflow:hidden; margin-top:20px;">
                                           
                                   
											
											 <button type="submit"  id="savingbutton" class="btn btn-secondary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';"  style="float:right;"  >
                                                Save Setting
                                            </button>
                                             <input autocomplete="false" name="action" type="hidden" id="action" value="addwebsitesetting" />  
								</div>
                           
								</div>
                           
							
                        </div>
						
						
						
                    </div>
					
					</form>
					 
						  </div>		  </div>
								 
                             
</div>
                             

                        </div>

                         
						
						
						
						 
                     

             </div><!--end col-->

            <!-- end row -->

    </div>

        <!-- End Page-content -->

         
    </div>
	</div>	</div>