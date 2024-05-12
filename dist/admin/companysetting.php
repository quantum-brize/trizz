<?php if($LoginUserDetails['userType']!=0){ exit(); } ?>
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
                                    <h4 class="card-title" style="margin-top: 0px !important; padding-left: 10px !important; padding-top: 10px !important; padding-bottom: 5px !IMPORTANT;padding-right: 0px !important;">Organisation Settings
                                      <div class="float-right">
									<button type="button" class="btn btn-secondary btn-lg waves-effect waves-light"  onclick="loadpop('Edit organisation settings',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=organisationsettings">Edit Setting</button>
									</div></h4>
                  
							 <div style="border:1px solid #ddd; margin:10px;"><table width="100%" class="table table-striped" style="    margin-bottom: 0px;">

                                            <thead>
                                            </thead>
                                            <tbody>
											
											<tr>
											  <td width="20%">Organisation name</td>
  <td width="71%"><div style="font-size:15px; color:#000; "><strong><?php echo stripslashes($LoginUserDetails['invoiceCompany']); ?></strong></div>  </td>
</tr>
											<tr>
											  <td width="20%">Email (Invoicing use)</td>
  <td><div style="font-size:15px; color:#000; "><strong><?php echo stripslashes($LoginUserDetails['invoiceEmail']); ?></strong></div>  </td>
</tr>
											<tr>
											  <td width="20%">Phone (Invoicing use)</td>
  <td><div style="font-size:15px; color:#000; "><strong><?php echo stripslashes($LoginUserDetails['invoicePhone']); ?></strong></div>  </td>
</tr>
											<tr>
											  <td width="20%">Address</td>
  <td><div style="font-size:15px; color:#000; "><strong><?php echo stripslashes($LoginUserDetails['invoiceAddress']); ?></strong></div>  </td>
</tr>
											<tr>
											  <td width="20%">GSTN</td>
  <td><div style="font-size:15px; color:#000; "><strong><?php echo stripslashes($LoginUserDetails['Invoicegstn']); ?></strong></div>  </td>
</tr>

							<tr>
							  <td width="20%">State</td>
  <td><div style="font-size:15px; color:#000; "><strong><?php echo stripslashes($LoginUserDetails['invoiceState']); ?></strong></div>  </td>
</tr>

							<tr>
							  <td width="20%">State code </td>
  <td><div style="font-size:15px; color:#000; "><strong><?php echo stripslashes($LoginUserDetails['invoiceStateCode']); ?></strong></div>  </td>
</tr>
                                            </tbody>
                                        </table></div>
                                        
                           
									
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