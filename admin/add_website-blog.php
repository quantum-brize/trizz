<?php 
if($_REQUEST['id']!=''){ 
$select1='*';    
$where1='id="'.decode($_REQUEST['id']).'"';  
$rs1=GetPageRecord($select1,'websiteBlog',$where1);   
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
						<div class="card" style="min-height:500px;">
                            <div class="card-body"> 
                                    <h4 class="card-title" style=" margin-top:0px; overflow:hidden;"><?php if($_REQUEST['id']!=''){ echo 'Edit'; } else { echo 'Add'; } ?> Blog Post<div class="float-right">
									<a href="display.html?ga=<?php echo $_REQUEST['ga']; ?>" ><button type="button" class="btn btn-primary btn-lg waves-effect waves-light" style="margin-bottom:10px;"  >Back</button></a>
									</div></h4> 
									        <div class=" "> 
									
									<form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm" > 
                    <div class=" ">
                        <div class="col-lg-12">
               
                                 
                                    <div class="row"> 
                                         


										  <div class="col-lg-12">
										  
										  <div class="row"  style="padding: 5px; margin: 5px; border: 1px solid #ddd; padding-top: 12px; border-radius: 4px;">
										  	 
							  
										
										 
										
										
										<div class="col-lg-8">
											 <div class="form-group"> 
											 <label for="validationCustom02">Title <span style="color:#FF0000;">*</span></label>
                                          <input type="text" class="form-control redborder" id="name" name="name"    value="<?php echo stripslashes($editresult['name']); ?>" >
                                        </div>
										</div>
											
		 
											  
											
		 
											<div class="col-lg-2">
											 <div class="form-group"> 
											 <label for="validationCustom02">Status <span style="color:#FF0000;">*</span></label>
                                         <select name="status" id="ff"  class="form-control">
<option value="1" <?php if($editresult['status']==1){ ?>selected="selected"<?php } ?>>Active</option>
<option value="0" <?php if($editresult['status']==0){ ?>selected="selected"<?php } ?>>Inactive</option> 

</select>
                                        </div>
										</div> 
										
										<div class="col-md-2"> 
<div class="form-group">
<label for="validationCustom02">Photo
</label>
<input name="image" type="file" id="changeprofilepic"  class="form-control">

<input name="oldlogo" type="hidden" id="oldlogo" value="<?php echo $editresult['photo']; ?>" />

</div></div>
											 			 
											  
											 
											 <div class="col-lg-12">
											 
											 <div class="form-group">
                                                 <label for="validationCustom02">Description</label>
                                                <textarea name="description" class="editorclass" id="description" style="height:350px;"><?php echo stripslashes($editresult['description']); ?></textarea>
												
												
												<script type="text/javascript">

var editor = CKEDITOR.replace('description');

CKFinder.setupCKEditor( editor,'ckeditor/ckfinder/' ) ;

</script>
  
                                            </div>
											 
											 </div>
											 
											 
											<div class="col-lg-12"> <h5>SEO</h5></div>
											 
											 
											 
											 				
										
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
											
										  </div>		  
                                             
											  
											 
										 
											                              
                                        </div>

                                         
                                    </div>  
									
									
									
									                                                                    
                        
								<div class="row">
								<div class="col-lg-12">
								
							  <div class="form-group mb-0" style="padding: 20px 10px;  border-top: 1px solid #e6e6e6; overflow:hidden; margin-top:20px;">
                                           
                                   
											
											 <button type="submit"  id="savingbutton" class="btn btn-secondary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';"  style="float:right;"  >
                                                Save Post
                                            </button>
                                             <input autocomplete="false" name="action" type="hidden" id="action" value="addwebsiteblogpost" /> 
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