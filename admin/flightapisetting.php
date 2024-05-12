 

<div class="wrapper">
<div class="container-fluid">
<div class="main-content">

                <div class="page-content">

      
                    
                    <!-- start page title -->
                     
              
                        <div class="row">
                        <div class="col-md-12 col-xl-12">
						<div class="card"  >
                            <div class="card-body" style="padding:0px;"> 
                                    <h4 class="card-title cardtitle">Flight API Setting<div class="float-right"></div></h4> 
							  <form action="frmaction.html" method="post" enctype="multipart/form-data" target="actoinfrm" id="addeditfrmapi">  
                                        <table class="table">
							<thead>
								<tr>
								  <th width="1%" align="left" >API</th>
								  <th align="left" ><div align="left">Type</div></th>
								  <th width="1%" align="left"><div align="left">Status </div></th>
								    <th width="1%" align="left">API&nbsp;Markup&nbsp;(%)</th>
								</tr>
							</thead>
							<tbody>
							
															<tr style="display:none;">
															  <td width="1%" align="left" ><img src="images/kafilalogo.png" height="34" style="margin-right:30px;" /></td>
								  <td width="20%" align="left" ><div align="left"><strong>One Way  																		</strong></div></td>
									<td width="1%" align="left">
									<select name="kafilaAPIOneWay"  class="form-control" style="width:160px;" onchange="$('#addeditfrmapi').submit();">
									  <option value="1" <?php if($getapistatus['kafilaAPIOneWay']==1){ ?>selected="selected"<?php } ?>>Active</option>
									  <option value="0" <?php if($getapistatus['kafilaAPIOneWay']==0){ ?>selected="selected"<?php } ?>>Deactive</option>
									</select>									</td>
								    <td width="1%" align="left"> 
								      <input name="kafilaApiMarkup" type="number" class="form-control"  style="width:120px;" value="<?php echo $getapistatus['kafilaApiMarkup']; ?>" />						 </td>
								</tr>
															<tr  style="display:none;">
															  <td width="1%" align="left" ><img src="images/kafilalogo.png" height="34" /></td>
															  <td width="20%" align="left" ><strong>Round Trip </strong></td>
															  <td width="1%" align="left"><select name="kafilaAPIRoundTrip"   class="form-control" style="width:160px;" onchange="$('#addeditfrmapi').submit();" disabled="disabled">
									  <option value="1" <?php if($getapistatus['kafilaAPIRoundTrip']==1){ ?>selected="selected"<?php } ?>>Active</option>
									  <option value="0" <?php if($getapistatus['kafilaAPIRoundTrip']==0){ ?>selected="selected"<?php } ?>>Deactive</option>
									</select></td>
							                                  <td width="1%" align="left" style="color:#FF0000;"> </td>
							  </tr>
															<tr  >
															  <td width="1%" align="left" ><img src="images/tbologo.png" height="34" /></td>
															  <td width="20%" align="left" ><strong>One Way </strong></td>
															  <td width="1%" align="left"><select name="tboAPIOneWay"  class="form-control" style="width:160px;" onchange="$('#addeditfrmapi').submit();">
									  <option value="1" <?php if($getapistatus['tboAPIOneWay']==1){ ?>selected="selected"<?php } ?>>Active</option>
									  <option value="0" <?php if($getapistatus['tboAPIOneWay']==0){ ?>selected="selected"<?php } ?>>Deactive</option>
									</select></td>
							                                  <td width="1%" align="left"><input type="number" name="tboApiMarkup"  style="width:120px;" class="form-control"  value="<?php echo $getapistatus['tboApiMarkup']; ?>" /></td>
							  </tr>
															<tr  style="display:none;" >
															  <td width="1%" align="left" ><img src="images/tbologo.png" height="34" /></td>
															  <td width="20%" align="left" ><strong>Round Trip </strong></td>
															  <td width="1%" align="left"><select name="tboAPIRoundTrip"  class="form-control" style="width:160px;" onchange="$('#addeditfrmapi').submit();">
									  <option value="1" <?php if($getapistatus['tboAPIRoundTrip']==1){ ?>selected="selected"<?php } ?>>Active</option>
									  <option value="0" <?php if($getapistatus['tboAPIRoundTrip']==0){ ?>selected="selected"<?php } ?>>Deactive</option>
									</select></td>
							                                  <td width="1%" align="left">&nbsp;</td>
							  </tr>
															<tr style="display:none;"  >
															  <td align="left" ><img src="images/tripjack.png" height="34" /></td>
															  <td align="left" ><strong>One Way / Round </strong></td>
															  <td width="1%" align="left"><select name="fixedGF"  class="form-control" style="width:160px;" onchange="$('#addeditfrmapi').submit();">
                                                                <option value="1" <?php if($getapistatus['fixedGF']==1){ ?>selected="selected"<?php } ?>>Active</option>
                                                                <option value="0" <?php if($getapistatus['fixedGF']==0){ ?>selected="selected"<?php } ?>>Deactive</option>
                                                              </select></td>
							                                  <td width="1%" align="left"><input type="number" name="tripjackApiMarkup"  style="width:120px;" class="form-control"   value="<?php echo $getapistatus['tripjackApiMarkup']; ?>"  /></td>
							  </tr>
														<tr  >
															  <td align="left" ><img src="images/airiq.png" height="27" /></td>
															  <td align="left" ><strong>One Way </strong></td>
															  <td width="1%" align="left"><select name="fixedAK"  class="form-control" style="width:160px;" onchange="$('#addeditfrmapi').submit();">
                                                                <option value="1" <?php if($getapistatus['fixedAK']==1){ ?>selected="selected"<?php } ?>>Active</option>
                                                                <option value="0" <?php if($getapistatus['fixedAK']==0){ ?>selected="selected"<?php } ?>>Deactive</option>
                                                          </select></td>
						                                  <td width="1%" align="left"><input type="number" name="airiqApiMarkup"  style="width:120px;" class="form-control"  value="<?php echo $getapistatus['airiqApiMarkup']; ?>"   /></td>
							  </tr>
														
														<tr  >
														  <td colspan="4" align="right" ><button type="submit" class="btn btn-primary btn-sm">Save Changes</button></td>
							  </tr> 
										  </tbody>
						</table>
						<input name="action" type="hidden" value="flightapisetting" />
                           </form>
									 
						  </div>
								 
                             
</div>
                             

                        </div>

                         
						
						
						
						 
                     

             </div><!--end col-->

            <!-- end row -->

    </div>

        <!-- End Page-content -->

         
    </div>
	</div>	</div>