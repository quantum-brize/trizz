<?php 
if($_REQUEST['id']==''){
$allval='deleteStatus=1';
$editId=addlistinggetlastid('roMaster',$allval); 
$editId=encode($editId);
insertLog('RO Created',decode($editId),'RO Created');
}else{

$a=GetPageRecord('*','roMaster','id="'.decode($_REQUEST['id']).'" and deleteStatus=0'); 
$result=mysqli_fetch_array($a);
$editId=encode($result['id']);
}
 ?>
<script src="tinymce/tinymce.min.js"></script>
<style>
.linedisplaycontent .form-group {
    border-bottom: 0px solid #ebebeb !important;
}
.form-group .form-control { 
    border: 1px solid #ccc;
    padding: 10px;
}
.select2-container--default .select2-selection--single { 
    border: 1px solid #ccc !important; 
    padding-left: 10px !important; 
	    height: 35px !important; 
}
 .select2-container .select2-selection--single .select2-selection__rendered { 
    margin-top: 3px !important; 
}
</style>
<section id="content_outer_wrapper">
        <div id="content_wrapper" class="card-overlay">
          <div id="header_wrapper" class="header-md ">
            <div class="container">
              <div class="row">
                <div class="col-xs-12">
                  <header id="header">
                    <h1>Mail Integration</h1>
                    <ol class="breadcrumb">
                      <li><a href="<?php echo $fullurl; ?>">Dashboard</a></li> 
                      <li class="active"><a href="display.html?ga=manageRo">Mail Integration</a></li>
                    </ol>
                  </header>
                </div>
              </div>
            </div>
          </div>
          <div id="content" class="container">
            
<div class="content-body">
            <div class="row">
			
			
			
              <div class="col-xs-12">
                <div class="card"> 
                  <div class="card-body linedisplaycontent">
                    <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm" class="form-horizontal">

<div class="modal-body p-0">
 <div class="tab-content  p-20">
<div class="card-body">
                
				
					   <div class="form-group is-empty">
                        <label class="col-sm-3 control-label">Name</label>
                         <div class="col-sm-8">
                           <input name="fromName" type="text" class="form-control" id="fromName" value="<?php echo stripslashes($LoginUserDetails['fromName']); ?>" >  
                        </div> 
                      </div>
					  
					  <div class="form-group is-empty">
                        <label class="col-sm-3 control-label">Eamil</label>
                         <div class="col-sm-8">
                           <input name="emailAccount" type="text" class="form-control" id="emailAccount" value="<?php echo stripslashes($LoginUserDetails['emailAccount']); ?>" >  
                        </div> 
                      </div>
					  
					  <div class="form-group is-empty">
                        <label class="col-sm-3 control-label">Password</label>
                         <div class="col-sm-8">
                           <input name="emailPassword" type="password" class="form-control" id="emailPassword" value="<?php echo stripslashes($LoginUserDetails['emailPassword']); ?>" >  
                        </div> 
                      </div>
					  
					  <div class="form-group is-empty">
                        <label class="col-sm-3 control-label">SMTP Server</label>
                         <div class="col-sm-8">
                           <input name="smtpServer" type="text" class="form-control" id="smtpServer" value="<?php echo stripslashes($LoginUserDetails['smtpServer']); ?>" >  
                        </div> 
                      </div>
					  
					  <div class="form-group is-empty">
                        <label class="col-sm-3 control-label">Port</label>
                         <div class="col-sm-8">
                           <input name="emailPort" type="text" class="form-control" id="emailPort" value="<?php echo stripslashes($LoginUserDetails['emailPort']); ?>" >  
                        </div> 
                      </div>
					  
					  <div class="form-group is-empty">
                        <label class="col-sm-3 control-label">Security Type</label>
                         <div class="col-sm-8">
                           <select name="securityType" class="form-control" >
						   <option value="false" <?php if($LoginUserDetails['securityType']=='false'){ ?> selected="selected" <?php } ?>>None</option>
						   <option value="true" <?php if($LoginUserDetails['securityType']=='true'){ ?> selected="selected" <?php } ?>>SSL</option>
						   </select>  
                        </div> 
                      </div>
					    
					  
					  
					  
                      </div>
					  </div><input name="action" type="hidden" id="action" value="updateEmailSettings">
</div><input name="editId" type="hidden" id="editId" value="<?php echo $editId; ?>">
<div class="modal-footer"> 
<button type="submit" class="btn btn-primary">Update</button>
</div>
</form>
                      </div>
                    </div>
                  </div>
				  
                </div>
              </div>
						
               
            </div>
          </div>
       
            </section>
<script>
$(".select2").select2();
 <?php if($_GET['id']!=''){ ?>
 setTimeout(function(){ 
getAllMediafun();
}, 1000);
loadVendorList('load');
<?php } ?>



 tinymce.init({
selector: "#terms",
themes: "modern",   
 plugins: [
     "advlist autolink lists link image charmap print preview anchor",
    "searchreplace visualblocks code fullscreen" 
   ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"   
 });
</script>		
	
			

			