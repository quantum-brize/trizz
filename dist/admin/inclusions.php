<?php 
$rs=GetPageRecord($select,'sys_userMaster','id=1 '); 
$editresult=mysqli_fetch_array($rs);

 ?>
  <script language="JavaScript" type="text/javascript" src="ckeditor/ckeditor.js"></script> 
<script language="JavaScript" type="text/javascript" src="ckeditor/ckfinder/ckfinder.js"></script>
 
<style>
.table td, .table th {
    vertical-align: top;
}
label{width: 100% !important; margin-bottom: 5px !important;font-size: 14px; text-transform: uppercase;}
.form-group label{font-size:13px !important; font-weight:500 !important;}
</style>
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
						<div style="min-height:500px;">
                            <div class="card-body"> 
                                    <h4 class="card-title" style=" margin-top:0px; padding-bottom:5px; ">Package Inclusions / Exclusion Setting
                                       </h4> 
									        <div style="padding:10px;"> 
									<div class=" "> 
									<form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm" > 
                    
				 
									   
									  
									   <div class="card-body">
									   <div class="col-lg-12">
											 <div class="form-group"> 
											 <label for="validationCustom02">Inclusions Title</label>
                                          <input type="text" class="form-control" id="inclusionsTitle" name="inclusionsTitle" style="padding: 4px;" value="<?php echo stripslashes($editresult['inclusionsTitle']); ?>"> 
                                        </div>
										</div>
											   
											<div class="col-lg-12">
											 
											 <div class="form-group">
                                                 <label for="validationCustom02">Inclusions</label>
                                                <textarea name="packageInclusions" id="packageInclusions" style="height:120px;" ><?php echo stripslashes($editresult['packageInclusions']); ?></textarea>
												
												<script type="text/javascript">

var editor = CKEDITOR.replace('packageInclusions');

CKFinder.setupCKEditor( editor,'ckeditor/ckfinder/' ) ;

</script>
                                            </div>
											 
											 </div>
											 
											 <div class="col-lg-12">
											 <div class="form-group"> 
											 <label for="validationCustom02">Important Tips Title</label>
                                          <input type="text" class="form-control" id="importantTipsTitle" name="importantTipsTitle" style="padding: 4px;" value="<?php echo stripslashes($editresult['importantTipsTitle']); ?>"> 
                                        </div>
										</div>
										
										<div class="col-lg-12"> 
											 <div class="form-group">
                                                 <label for="validationCustom02">Important Tips</label> 
												<textarea name="packageImportantTips" id="packageImportantTips" style="height:120px;" ><?php echo stripslashes($editresult['packageImportantTips']); ?></textarea>
												
												<script type="text/javascript">

var editor = CKEDITOR.replace('packageImportantTips');

CKFinder.setupCKEditor( editor,'ckeditor/ckfinder/' ) ;

</script>
                                            </div>
											 
											 </div>
											 
											 	    <div class="col-lg-12">
											 <div class="form-group"> 
											 <label for="validationCustom02">Exclusions Title</label>
                                          <input type="text" class="form-control" id="exclusionsTitle" name="exclusionsTitle" style="padding: 4px;" value="<?php echo stripslashes($editresult['exclusionsTitle']); ?>"> 
                                        </div>
										</div>
												  
													 
											
											 <div class="col-lg-12"> 
											 <div class="form-group">
                                                 <label for="validationCustom02">Exclusions</label>
                                                <textarea name="packageExclusions" id="packageExclusions" style="height:120px;" ><?php echo stripslashes($editresult['packageExclusions']); ?></textarea>
												
													<script type="text/javascript">

var editor = CKEDITOR.replace('packageExclusions');

CKFinder.setupCKEditor( editor,'ckeditor/ckfinder/' ) ;

</script>
                                            </div>
											 
											 </div>  
											 
											    		 <div class="col-lg-12">
											 <div class="form-group"> 
											 <label for="validationCustom02">List of documents for traveling Title</label>
                                          <input type="text" class="form-control" id="travelInformationTitle" name="travelInformationTitle" style="padding: 4px;" value="<?php echo stripslashes($editresult['travelInformationTitle']); ?>"> 
                                        </div>
										</div>
											  
											 
											 <div class="col-lg-12"> 
											 <div class="form-group">
                                                 <label for="validationCustom02">List of documents for traveling</label>
                                                <textarea name="packageTravelInfo" id="packageTravelInfo" style="height:120px;" ><?php echo stripslashes($editresult['packageTravelInfo']); ?></textarea>
												
												<script type="text/javascript">

var editor = CKEDITOR.replace('packageTravelInfo');

CKFinder.setupCKEditor( editor,'ckeditor/ckfinder/' ) ;

</script>
                                            </div>
											 
											 </div>
									    </div>
					 
					
					
					
					
                        <div class="col-lg-12">
               
                                  
								<div class="row">
								<div class="col-lg-12">
								
							  <div class="form-group mb-0" style="padding: 20px 0px;  border-top: 1px solid #e6e6e6; overflow:hidden; margin-top:20px;">
                                           
                                   
											
											 <button type="submit"  id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';"  style="float:right;"  >
                                                Save Setting
                                            </button>
                                             <input autocomplete="false" name="action" type="hidden" id="action" value="addInclusions" />  
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

         
    </div></td>
  </tr>
</table>
                
	</div>	</div>