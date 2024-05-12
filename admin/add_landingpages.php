<?php 
if($_REQUEST['id']!=''){ 
$select1='*';    
$where1='id="'.decode($_REQUEST['id']).'"';  
$rs1=GetPageRecord($select1,'landingPages',$where1);   
$editresult=mysqli_fetch_array($rs1);  

}
 

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
						<div class="card" >
                            <div class="card-body"> 
                                    <h4 class="card-title" style=" margin-top:0px; overflow:hidden;"><?php if($_REQUEST['id']!=''){ echo 'Edit'; } else { echo 'Add'; } ?> Landing Page<div class="float-right">
									<a href="display.html?ga=landingpages" ><button type="button" class="btn btn-primary btn-lg waves-effect waves-light" style="margin-bottom:10px;"  >Back</button></a>
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
											 <label for="validationCustom02">Template Name</label>
                                          <input type="text" class="form-control redborder" id="name" name="name" value="<?php echo stripslashes($editresult['name']); ?>" >
                                        </div>
										</div>
											
		 
											<div class="col-lg-4">
											 <div class="form-group"> 
											 <label for="validationCustom02">Banner (1500px - 500px)<?php if($editresult['banner']!=''){ ?> <a href="package_image/<?php echo $editresult['banner']; ?>" target="_blank"><strong>View Banner</strong></a><?php } ?></label>
                                  	<input name="banner" type="file" class="custom-file-input" id="banner" style="opacity: 1;">
	<input name="bannerold" type="hidden" value="<?php echo $editresult['banner']; ?>" >
                                        </div>
										</div> 
										
												<div class="col-lg-4">
											 <div class="form-group"> 
											 <label for="validationCustom02">Banner Heading</label>
                                          <input type="text" class="form-control redborder" id="bannerHeading" name="bannerHeading" value="<?php echo stripslashes($editresult['bannerHeading']); ?>" >
                                        </div>
										</div>
											 			 
											 	<div class="col-lg-4">
											 <div class="form-group"> 
											 <label for="validationCustom02">Banner Subheading</label>
                                          <input type="text" class="form-control redborder" id="bannerSubHeading" name="bannerSubHeading" value="<?php echo stripslashes($editresult['bannerSubHeading']); ?>" >
                                        </div>
										</div>
											 		
											  
											 <div class="col-lg-4">
											 <div class="form-group"> 
											 <label for="validationCustom02">Enquiry Heading</label>
                                          <input type="text" class="form-control redborder" id="enquiryHeading" name="enquiryHeading" value="<?php echo stripslashes($editresult['enquiryHeading']); ?>" >
                                        </div>
										</div>
											   
											  <div class="col-lg-4">
											 <div class="form-group"> 
											 <label for="validationCustom02">Enquiry Subheading</label>
                                          <input type="text" class="form-control redborder" id="enquirySubHeading" name="enquirySubHeading" value="<?php echo stripslashes($editresult['enquirySubHeading']); ?>" >
                                        </div>
										</div>
										
										
										<div class="col-lg-4">
											 <div class="form-group"> 
											 <label for="validationCustom02">Contact Number</label>
                                          <input type="text" class="form-control redborder" id="contactNumber" name="contactNumber" value="<?php echo stripslashes($editresult['contactNumber']); ?>" >
                                        </div>
										</div>
										
											<div class="col-lg-4">
											 <div class="form-group"> 
											 <label for="validationCustom02">Email Id</label>
                                          <input type="text" class="form-control redborder" id="emailId" name="emailId" value="<?php echo stripslashes($editresult['emailId']); ?>" >
                                        </div>
										</div>
										
											<div class="col-lg-4">
											 <div class="form-group"> 
											 <label for="validationCustom02">Address</label>
                                          <input type="text" class="form-control redborder" id="address" name="address" value="<?php echo stripslashes($editresult['address']); ?>" >
                                        </div>
										</div>
										
											 
										 
										<div class="col-lg-7">
											 <div class="form-group"> 
											 <label for="validationCustom02">Main Heading</label>
                                          <input type="text" class="form-control redborder" id="mainHeading" name="mainHeading" value="<?php echo stripslashes($editresult['mainHeading']); ?>" >
                                        </div>
										</div>
										
												<div class="col-lg-5">
											 <div class="form-group"> 
											 <label for="validationCustom02">URL (Slug) - <span style="text-transform:none;"><?php echo $landingpage; ?></span></label>
                                          <input type="text" class="form-control redborder" id="pageURL" name="pageURL" value="<?php echo stripslashes($editresult['pageURL']); ?>" placeholder="Eg. my-goa-packages" >
                                        </div>
										</div> 
											 <div class="col-lg-12">
											 
											 <div class="form-group">
                                                 <label for="validationCustom02">Description</label>
                                                <textarea name="description" id="descriptionsss" style="height:100px; width:100%; padding:10px;"><?php echo stripslashes($editresult['description']); ?><?php echo stripslashes($_REQUEST['details']); ?></textarea>
												
												
												 
 
  
                                            </div>
											 
											 </div>
											 
											 
											 	 
											 <div class="col-lg-12"> 
											 <div class="form-group">
											 <div style="border:1px solid #ddd;">
											 <div style="padding:15px; background-color:#F7F7F7; border-bottom:1px solid #ddd; font-size:15px; font-weight:700; position:relative;">Selected Packages<input name="packages" id="selectedpackageslist" type="hidden" value="<?php echo $editresult['packages']; ?>" />
											 
											 <button type="button" class="btn btn-primary btn-lg waves-effect waves-light" style="margin-bottom: 10px; position: absolute; right: 10px; top: 10px;" onclick="loadpop('Select Package',this,'800px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=selectpackage">+ Select Package</button>
											 </div>
											 <div style="padding:15px;" id="load_packages_landingpage">Loading...</div>
											 </div>
											 
											 <script>
											 function load_packages_landingpage(){
											 var selectedpackageslist = $('#selectedpackageslist').val();
											 $('#load_packages_landingpage').load('load_packages_landingpage.php?id='+selectedpackageslist);
											 }
											 load_packages_landingpage();
											 </script>
											 
											 </div>
											 </div>
											 
											 
											 
											 	<div class="col-lg-4">
											 <div class="form-group"> 
											 <label for="validationCustom02">Lead Source</label> 
					
					<select id="leadSource" name="leadSource" class="form-control"   autocomplete="off" > 
					
					<?php  
					$rs=GetPageRecord('*','querySourceMaster','  1  order by name asc');
					while($rest=mysqli_fetch_array($rs)){ 
					?> 
					<option value="<?php echo $rest['id']; ?>" <?php if($rest['id']==$editresult['leadSource']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>   
					
					<?php }   ?>
					</select>
                                        </div>
										</div>
										 
											 
											 
											 <div class="col-lg-4">
											 <div class="form-group"> 
											 <label for="validationCustom02">Facebook</label>
                                          <input type="text" class="form-control" id="facebook" name="facebook" value="<?php echo stripslashes($editresult['facebook']); ?>" >
                                        </div>
										</div>
										
										
										
										<div class="col-lg-4">
											 <div class="form-group"> 
											 <label for="validationCustom02">Instagram</label>
                                          <input type="text" class="form-control" id="instagram" name="instagram" value="<?php echo stripslashes($editresult['instagram']); ?>" >
                                        </div>
										</div>
										
										
										
										<div class="col-lg-4">
											 <div class="form-group"> 
											 <label for="validationCustom02">Twitter</label>
                                          <input type="text" class="form-control" id="twitter" name="twitter" value="<?php echo stripslashes($editresult['twitter']); ?>" >
                                        </div>
										</div>
										
										
										
										<div class="col-lg-4">
											 <div class="form-group"> 
											 <label for="validationCustom02">Youtube</label>
                                          <input type="text" class="form-control" id="youtube" name="youtube" value="<?php echo stripslashes($editresult['youtube']); ?>" >
                                        </div>
										</div>
										
										
										
										<div class="col-lg-4">
											 <div class="form-group"> 
											 <label for="validationCustom02">Pinterest</label>
                                          <input type="text" class="form-control" id="pinterest" name="pinterest" value="<?php echo stripslashes($editresult['pinterest']); ?>" >
                                        </div>
										</div>
										
										
										
										
										<div class="col-lg-4">
											 <div class="form-group"> 
											 <label for="validationCustom02">Meta Title</label>
                                          <input type="text" class="form-control" id="metaTitle" name="metaTitle" value="<?php echo stripslashes($editresult['metaTitle']); ?>" >
                                        </div>
										</div>
										
										
										
										
										<div class="col-lg-4">
											 <div class="form-group"> 
											 <label for="validationCustom02">Meta Description</label>
                                          <input type="text" class="form-control" id="metaDescription" name="metaDescription" value="<?php echo stripslashes($editresult['metaDescription']); ?>" >
                                        </div>
										</div>
										
										
										
										
										<div class="col-lg-4">
											 <div class="form-group"> 
											 <label for="validationCustom02">Meta Keyword</label>
                                          <input type="text" class="form-control" id="metaKeyword" name="metaKeyword" value="<?php echo stripslashes($editresult['metaKeyword']); ?>" >
                                        </div>
										</div>
										
										
										
										
										<div class="col-lg-6">
											 <div class="form-group"> 
											 <label for="validationCustom02">Header Script</label>
                                             <textarea name="headerScript" rows="3" class="form-control" id="headerScript"><?php echo stripslashes($editresult['headerScript']); ?></textarea>
                                        </div>
										</div>
										
										
										
										
										<div class="col-lg-6">
											 <div class="form-group"> 
											 <label for="validationCustom02">Footer Script</label>
                                             <textarea name="footerScript" rows="3" class="form-control" id="footerScript"><?php echo stripslashes($editresult['footerScript']); ?></textarea>
                                        </div>
										</div>
										
										
										
										<div class="col-lg-4">
											 <div class="form-group"> 
											 <label for="validationCustom02">Staus</label>
                                   <select name="status" id="paymentStatus"  class="form-control" >
<option value="1" <?php if($editresult['status']==1){ ?>selected="selected"<?php } ?>>Active</option>
<option value="0" <?php if($editresult['status']==0){ ?>selected="selected"<?php }  ?>>In-Active</option> 

</select>
                                        </div>
										</div>
										
										
										
										
											 
											 
											 
										  </div>	 
											                              
                                        </div>

                                         
                                    </div>  
									
									
									
									                                                                    
                        
								<div class="row">
								<div class="col-lg-12">
								
							  <div class="form-group mb-0" style="padding: 20px 10px;  border-top: 1px solid #e6e6e6; overflow:hidden; margin-top:20px;">
                                           
                                   
											
											 <button type="submit"  id="savingbutton" class="btn btn-secondary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';"  style="float:right;"  >
                                                Save Landing Page
                                            </button>
                                             <input autocomplete="false" name="action" type="hidden" id="action" value="addemailtemplate" /> 
											 <input autocomplete="false" name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>" /> 
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