<?php
   include "inc.php"; 
   include "config/logincheck.php";  
   $selectedpage=''; 
   $selectleft=''; 
   
   if($LoginUserDetails['userType']=='agent' || $LoginUserDetails['userType']=='client'){ } else {
   header("Location:".$fullurl."");
   exit();
   }
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <title>My Profile - <?php echo stripslashes($getcompanybasicinfo['companyName']); ?></title>
      <style>
         .midcontent{
         margin:auto;
         }
         .profilecard{
         margin-top:60px;
         margin-left:80px;
      </style>
      <?php include "headerinc.php"; ?>
   </head>
   <body class="greyouter">
      <?php include "header.php"; ?>
      <!--------------Left Menu---------------->
      <?php include "left.php"; ?>
      <!--------------Mid Body---------------->
      <section class=" ">
         <div class="container midcontent">
            <?php if($LoginUserDetails['userType']=='client'){ ?>	
            <section class="profile">
               <div class="container midcontent">
                  <div class="card profilecard" >
                     <form action="<?php echo $fullurl; ?>frmaction.html" method="post" target="actoinfrm">
                        <div class="card-body">
                           <div class="row">
                              <?php if($_REQUEST['a']==1){ ?>
                              <div class="col-lg-12">
                                 <div style="padding:10px 20px; margin-bottom:20px; background-color:#E1FFFB; color:#01BE8A;"><strong>Profile has been saved!</strong></div>
                              </div>
                              <?php } ?>
                              <div class="col-lg-6">
                                 <h3 style="font-size: 18px; font-weight: 700; padding-bottom: 10px;">
                                    Profile
                                    <div style="font-size:12px; color:#666666; font-weight:400;">Basic info, for a faster booking experience</div>
                                 </h3>
                                 <hr>
                                 <div class="table-responsive">
                                    <table class="table" style=" font-size:13px;">
                                       <tbody>
                                          <tr>
                                             <td align="left" valign="middle">
                                                <div style="width:120px;"><strong>First Name </strong></div>
                                             </td>
                                             <td align="left" valign="middle">
                                                <input class="form-control" type="text" name="name" placeholder="Enter your full name" value="<?php echo stripslashes($LoginParentId['firstName']); ?>" required="required">  
                                             </td>
                                          </tr>
                                          <tr>
                                             <td align="left" valign="middle">
                                                <div style="width:120px;"><strong>Last Name</strong></div>
                                             </td>
                                             <td align="left" valign="middle">
                                                <input class="form-control" type="text" name="lastName" placeholder="Enter your full name" value="<?php echo stripslashes($LoginParentId['lastName']); ?>" required="required">  
                                             </td>
                                          </tr>
                                          <tr>
                                             <td width="10%" align="left" valign="middle"><strong>Birthday  </strong></td>
                                             <td width="90%" align="left" valign="middle">
                                                <input name="dob" type="text" class="form-control" id="dob" value="<?php if(date('Y',strtotime($LoginParentId['dob']))>1970){ echo  date('d-m-Y',strtotime($LoginParentId['dob'])); } ?>" placeholder="Enter your dob"  readonly="" >
												
                                                <script>
                                                   $('#dob').datepicker({
                                                       dateFormat: 'dd-mm-yy',
													   maxDate: 0,
													   yearRange: '1940:<?php echo date('Y'); ?>',
													   changeYear: true
                                                   });
                                                </script>
												
                                             </td>
                                          </tr>
                                          <tr>
                                             <td width="10%" align="left" valign="middle"><strong>Gender</strong></td>
                                             <td width="90%" align="left" valign="middle">
                                                <select name="gender" id="gender" class="form-control">
                                                   <option value="">Select</option>
                                                   <option value="Male" <?php if($LoginParentId['gender']=='Male'){ ?>selected="selected"<?php } ?>>Male</option>
                                                   <option value="Female" <?php if($LoginParentId['gender']=='Female'){ ?>selected="selected"<?php } ?>>Female</option>
                                                </select>
                                             </td>
                                          </tr>
                                          <tr>
                                             <td width="10%" align="left" valign="middle"><strong>Marital Status </strong></td>
                                             <td width="90%" align="left" valign="middle">
                                                <select name="maritalStatus" id="maritalStatus" class="form-control">
                                                   <option value="">Select</option>
                                                   <option value="Married" <?php if($LoginParentId['maritalStatus']=='Married'){ ?>selected="selected"<?php } ?>>Married</option>
                                                   <option value="Single" <?php if($LoginParentId['maritalStatus']=='Single'){ ?>selected="selected"<?php } ?>>Single</option>
                                                </select>
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                              <div class="col-lg-6">
                                 <h3 style="font-size: 18px; font-weight: 700; padding-bottom: 10px;">
                                    Login Details
                                    <div style="font-size:12px; color:#666666; font-weight:400;">Manage your email address mobile number</div>
                                 </h3>
                                 <hr>
                                 <div class="table-responsive">
                                    <table class="table " style=" font-size:13px;">
                                       <tbody>
                                          <tr>
                                             <td align="left" valign="middle"><strong>Email </strong></td>
                                             <td align="left" valign="middle"><input class="form-control" type="text" name="email" placeholder="Enter your email" readonly="readonly" value="<?php echo stripslashes($LoginParentId['email']); ?>" required="required"></td>
                                          </tr>
                                          <tr>
                                             <td align="left" valign="middle"><strong>Mobile Number</strong></td>
                                             <td align="left" valign="middle"><input name="phone" type="text" class="form-control" id="phone" value="<?php echo stripslashes($LoginParentId['phone']); ?>"  placeholder="Enter your mobile number"  ></td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                              <div class=" " style="position:relative; width:100%; text-align:right;"> 
                                 <button type="submit" class="combutton"  >Save Chnages</button> 
                              </div>
                              <input name="action" type="hidden" id="action" value="editclientprofile">
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </section>
            <?php } ?>  
			
            <?php if($LoginUserDetails['userType']=='agent'){ ?>
			
            <div class="card profilecard">
               <div class="card-body">
                  <h1>Corporate Information</h1>
                  <p>Basic info,for a faster booking experience</p>
                  <div class="table-responsive">
                     <table class="table table-bordered table-striped profiletable" style=" font-size:13px;">
                        <tbody>
                           <tr>
                              <td align="left" valign="top">
                                 <div style="width:120px;"><strong>Logo</strong></div>
                              </td>
                              <td align="left" valign="top" class="profiledetail" style="position:relative;">
                                 <img src="<?php echo $imgurl; ?><?php echo $LoginUserDetails['companyLogo']; ?>" alt="<?php echo stripslashes($LoginUserDetails['companyName']); ?>" id="dislogo" style="max-width: 100px; width:auto;"  > 
                                 <div  style="position: absolute; text-align: left; display: inline-block; right: 0px; top: 6px;">
                                    <a style="cursor:pointer;"><button type="button" class="combutton" style="padding:5px 10px;" id="OpenImgUpload">Change Logo</button></a> 
                                    <form action="<?php echo $adminurl; ?>agent_logo_upload.php" method="post" enctype="multipart/form-data" name="addeditfrmlogo" target="actoinfrm" id="addeditfrmlogo" style="display:none;"> 
                                       <input name="companyLogo" type="file" class="form-control" id="companyLogo" style="padding: 4px;" onChange="$('#addeditfrmlogo').submit();reloadthis();$('#dislogo').attr('src','images/loadinggif.gif');">
                                       <input name="action" type="hidden" value="savelogo">
                                       <input name="agentId" type="hidden" value="<?php echo encode($_SESSION['agentUserid']); ?>">
                                    </form>
                                    <script>
                                       $('#OpenImgUpload').click(function(){ $('#companyLogo').trigger('click'); });
                                       
                                       
                                       function reloadthis(){
                                       setTimeout(function() {
                                           location.reload();
                                       }, 4000);
                                       
                                       }
                                    </script>
                                 </div>
                              </td>
                           </tr>
                           <tr>
                              <td width="10%" align="left" valign="top"><strong>Agent ID:</strong></td>
                              <td width="90%" align="left" valign="top" class="profiledetail"><?php echo ($LoginUserDetails['agentId']); ?></td>
                           </tr>
                           <tr>
                              <td width="10%" align="left" valign="top"><strong>Company Name</strong></td>
                              <td width="90%" align="left" valign="top" class="profiledetail"><?php echo stripslashes($LoginUserDetails['company']); ?></td>
                           </tr>
                           <tr>
                              <td width="10%" align="left" valign="top"><strong>Business Type</strong></td>
                              <td width="90%" align="left" valign="top" class="profiledetail"><?php if(1==$LoginUserDetails['businessType']){ echo 'Proprietorship'; } 
                                 if(2==$LoginUserDetails['businessType']){ echo 'Partnership'; } 
                                 if(3==$LoginUserDetails['businessType']){ echo 'Limited Partnership'; } 
                                 if(4==$LoginUserDetails['businessType']){ echo 'Corporation'; } 
                                 if(5==$LoginUserDetails['businessType']){ echo 'Limited Liability Company'; } 
                                 if(6==$LoginUserDetails['businessType']){ echo 'Nonprofit Organization'; } 
                                 if(7==$LoginUserDetails['businessType']){ echo 'Cooperative'; } 
                                 
                                 ?></td>
                           </tr>
                           <tr>
                              <td width="10%" align="left" valign="top"><strong>PAN</strong></td>
                              <td width="90%" align="left" valign="top" class="profiledetail"><?php echo stripslashes($LoginUserDetails['pan']); ?></td>
                           </tr>
                           <tr>
                              <td align="left" valign="top"><strong>Agency GSTIN</strong></td>
                              <td align="left" valign="top" class="profiledetail"><?php echo stripslashes($LoginUserDetails['gstin']); ?></td>
                           </tr>
                           <tr>
                              <td align="left" valign="top"><strong>Website</strong></td>
                              <td align="left" valign="top" class="profiledetail"><?php echo stripslashes($LoginUserDetails['website']); ?></td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
            <div class="card profilecard">
               <div class="card-body">
                  <h1>Account Information</h1>
                  <p>Basic info,for a faster booking experience</p>
                  <div class="table-responsive">
                     <table class="table table-bordered table-striped profiletable" style=" font-size:13px;">
                        <tbody>
                           <tr>
                              <td align="left" valign="top">
                                 <div style="width:120px;"><strong>First Name </strong></div>
                              </td>
                              <td align="left" valign="top" class="profiledetail"><?php echo stripslashes($LoginUserDetails['firstName']); ?></td>
                           </tr>
                           <tr>
                              <td width="10%" align="left" valign="top"><strong>Last Name  </strong></td>
                              <td width="90%" align="left" valign="top" class="profiledetail"><?php echo stripslashes($LoginUserDetails['lastName']); ?></td>
                           </tr>
                           <tr>
                              <td width="10%" align="left" valign="top"><strong>Email </strong></td>
                              <td width="90%" align="left" valign="top" class="profiledetail"><?php echo stripslashes($LoginUserDetails['email']); ?></td>
                           </tr>
                           <tr>
                              <td width="10%" align="left" valign="top"><strong>Contact No. </strong></td>
                              <td width="90%" align="left" valign="top" class="profiledetail"><?php echo stripslashes($LoginUserDetails['countryCode']); ?><?php echo stripslashes($LoginUserDetails['phone']); ?></td>
                           </tr>
                           <tr>
                              <td width="10%" align="left" valign="top"><strong>City</strong></td>
                              <td width="90%" align="left" valign="top" class="profiledetail"><?php echo getCityName($LoginUserDetails['city']); ?></td>
                           </tr>
                           <tr>
                              <td align="left" valign="top"><strong>State</strong></td>
                              <td align="left" valign="top" class="profiledetail"><?php echo getStateName($LoginUserDetails['state']); ?></td>
                           </tr>
                           <tr>
                              <td align="left" valign="top"><strong>Country</strong></td>
                              <td align="left" valign="top" class="profiledetail"><?php echo getCountryName($LoginUserDetails['country']); ?></td>
                           </tr>
                           <tr>
                              <td width="10%" align="left" valign="top"><strong>Address</strong></td>
                              <td width="90%" align="left" valign="top" class="profiledetail"><?php echo stripslashes($LoginUserDetails['address']); ?></td>
                           </tr>
                           <tr>
                              <td align="left" valign="top"><strong>Pin Code </strong></td>
                              <td align="left" valign="top" class="profiledetail"><?php echo stripslashes($LoginUserDetails['pincode']); ?></td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
            <?php } ?>
         </div>
      </section>
      <!-- HTML -->
      <?php include "footerinc.php"; ?>
   </body>
</html>