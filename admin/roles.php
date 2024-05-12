<?php 
$u = decode($_REQUEST['u']);

if($_REQUEST['u']==''){
$u=$_SESSION['userid'];
}
$abcd=GetPageRecord('*','userMaster','id="'.$u.'"'); 
$result=mysqli_fetch_array($abcd); 
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

<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top" >
<?php include "settingleft.php"; ?>
	
	</td>
    <td align="left" valign="top" width="90%"><div class="page-content">

      <div class="newboxheading"><div class="newhead">Roles Master<div class="newoptionmenu">
  	
		 	
		<div style="display:none;"> <button type="button" class="btn btn-secondary btn-lg waves-effect waves-light"  onclick="loadpop2('Add Role',this,'400px')" data-toggle="modal" data-target="#myModal2" data-backdrop="static"  popaction="action=addrole" >Add Roles</button></div>					 
								  
 </div>
 </div>     
 
     
</div>
                    
                    <!-- start page title -->
                     
              
                        <div class=" ">
                        <div class="col-md-12 col-xl-12" style="padding-top:32px;">
						<div >
                            <div class="card-body" style="padding:20px;"> 
                                      
									
									<img src="profilepic/<?php echo stripslashes($companyLogoAdmin['invoiceLogo']); ?>" style=" height:40px;" />
									<div class="roleouter"> 
									
									<div class="hyrouter" style="margin-bottom:0px; border-left:0px; ">
									<div class="rolebox" style=" margin-left: -96px;">CEO</div>
									
									</div>
									
								<?php
								$rs=GetPageRecord('*','roleMaster',' 1 group by branchId order by name asc'); 
								while($rest=mysqli_fetch_array($rs)){ 
								
									$b=GetPageRecord('*','branchMaster','id="'.$rest['branchId'].'"'); 
									$branch=mysqli_fetch_array($b);
								?>
								
								
									<div class="headrole"><div class="linerole"></div><?php echo stripslashes($branch['name']); ?></div>
									
									 <?php
									  $k=0;
									$rst=GetPageRecord('*','roleMaster',' branchId="'.$branch['id'].'" and parentId=0 order by name asc'); 
									while($restt=mysqli_fetch_array($rst)){ 
									?>
									<div class="hyrouter"><div class="linerole"></div>
									<div class="ingry"><?php echo stripslashes($restt['name']); ?> <a class="dropdown-item neweditpan"  onclick="loadpop2('Edit Role',this,'400px')" data-toggle="modal" data-target="#myModal2" data-backdrop="static"  popaction="action=addrole&id=<?php echo encode($rest['id']); ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></div>
									
						
									
									 <?php
									 $k=100;
									$rsta=GetPageRecord('*','roleMaster',' branchId="'.$branch['id'].'" and parentId="'.$restt['id'].'" order by name asc'); 
									while($restta=mysqli_fetch_array($rsta)){ 
									?>
									<div class="hyrouter"  ><div class="linerole"></div>
									<div class="ingry"><?php echo stripslashes($restta['name']); ?> <a class="dropdown-item neweditpan"  onclick="loadpop2('Edit Role',this,'400px')" data-toggle="modal" data-target="#myModal2" data-backdrop="static"  popaction="action=addrole&id=<?php echo encode($rest['id']); ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></div>
									
									
									
									 <?php
									 $k=100;
									$rstaa=GetPageRecord('*','roleMaster',' branchId="'.$branch['id'].'" and parentId="'.$restta['id'].'" order by name asc'); 
									while($resttaa=mysqli_fetch_array($rstaa)){ 
									?>
									<div class="hyrouter"  ><div class="linerole"></div>
									<div class="ingry"><?php echo stripslashes($resttaa['name']); ?> <a class="dropdown-item neweditpan"  onclick="loadpop2('Edit Role',this,'400px')" data-toggle="modal" data-target="#myModal2" data-backdrop="static"  popaction="action=addrole&id=<?php echo encode($rest['id']); ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></div>
									
									
									
									 <?php
									 $k=100;
									$rstaaa=GetPageRecord('*','roleMaster',' branchId="'.$branch['id'].'" and parentId="'.$resttaa['id'].'" order by name asc'); 
									while($resttaaa=mysqli_fetch_array($rstaaa)){ 
									?>
									<div class="hyrouter"  ><div class="linerole"></div>
									<div class="ingry"><?php echo stripslashes($resttaaa['name']); ?> <a class="dropdown-item neweditpan"  onclick="loadpop2('Edit Role',this,'400px')" data-toggle="modal" data-target="#myModal2" data-backdrop="static"  popaction="action=addrole&id=<?php echo encode($rest['id']); ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></div>
									
									
									
									 <?php
									 $k=100;
									$rstaaaa=GetPageRecord('*','roleMaster',' branchId="'.$branch['id'].'" and parentId="'.$resttaaa['id'].'" order by name asc'); 
									while($resttaaaa=mysqli_fetch_array($rstaaaa)){ 
									?>
									<div class="hyrouter"  ><div class="linerole"></div>
									<div class="ingry"><?php echo stripslashes($resttaaaa['name']); ?> <a class="dropdown-item neweditpan"  onclick="loadpop2('Edit Role',this,'400px')" data-toggle="modal" data-target="#myModal2" data-backdrop="static"  popaction="action=addrole&id=<?php echo encode($rest['id']); ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></div>
									
									
										 <?php
									 $k=100;
									$rstaaaaa=GetPageRecord('*','roleMaster',' branchId="'.$branch['id'].'" and parentId="'.$resttaaaa['id'].'" order by name asc'); 
									while($resttaaaaa=mysqli_fetch_array($rstaaaaa)){ 
									?>
									<div class="hyrouter"  ><div class="linerole"></div>
									<div class="ingry"><?php echo stripslashes($resttaaaaa['name']); ?> <a class="dropdown-item neweditpan"  onclick="loadpop2('Edit Role',this,'400px')" data-toggle="modal" data-target="#myModal2" data-backdrop="static"  popaction="action=addrole&id=<?php echo encode($rest['id']); ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></div>
									
									</div>
									<?php } ?>
									
									
									</div>
									<?php } ?>
									
									
									</div>
									<?php } ?>
									
									
									</div>
									<?php } ?>
									
									</div>
									<?php } ?>
									
									
									
									
												</div>
									<?php } ?>
									
									
									
									
									<?php  } ?>
									
									
									</div>
									
									
									
									
									
							  
                             
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