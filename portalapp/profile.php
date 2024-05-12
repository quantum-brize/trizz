<?php
include "inc.php"; 
$selectpage=5;

$cookie_name = "user";
if(!isset($_COOKIE[$cookie_name])) {
     
} else {
    $cookieuserid=$_COOKIE[$cookie_name];
}
 if($cookieuserid>0){
$_SESSION['userId']=$cookieuserid; 
}
 

$url = $basesiteurl."agentprofilepage_mobile.php";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);

		$data = array(
		'MemberId' => $_SESSION['userId']
); 

curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
$contents = curl_exec($ch);
$contentslogin=json_decode($contents,true); 
curl_close($ch);

 
 
?> 
<style>
body{background-color:#f0f7fe;}
.displaylist tr td{padding:5px 0px; padding-right:5px !important;}
.displaylist tr{ border-bottom:1px solid #ddd !important;}
.displaylist td:first-child{color:#999999 !important;}
</style>

<div class="innerpageaccountheader">My Profile</div>
<div class="blkaria"></div>
<div class="bodyouter" style="margin-top: -60px; padding:10px;">
<div class="innerbodycard">
<div class="sectionheading" style="padding:0px; margin:0px; margin-bottom:10px;padding-bottom:10px; border-bottom:1px solid #ddd;">Account Information</div>
<table class="displaylist" style=" font-size:13px;">
                                            
                                            <tbody> 
                                     <tr>
                                                  <td align="left" valign="top"><div style="width:120px;"><strong>First Name </strong></div></td>
                                                  <td align="left" valign="top" class="profiledetail">:</td>
                                                  <td align="left" valign="top" class="profiledetail"><?php echo stripslashes($contentslogin['Member']['FirstName']); ?></td>
                                              </tr>
                                                <tr>
                                                  <td width="10%" align="left" valign="top"><strong>Last Name  </strong></td>
                                                  <td width="1%" align="left" valign="top" class="profiledetail">:</td>
                                                  <td width="90%" align="left" valign="top" class="profiledetail"><?php echo stripslashes($contentslogin['Member']['LastName']); ?></td>
                                                </tr>
                                                <tr>
                                                  <td width="10%" align="left" valign="top"><strong>Email </strong></td>
                                                  <td width="1%" align="left" valign="top" class="profiledetail">:</td>
                                                  <td width="90%" align="left" valign="top" class="profiledetail"><?php echo stripslashes($contentslogin['Member']['Email']); ?></td>
                                              </tr>
                                                <tr>
                                                  <td width="10%" align="left" valign="top"><strong>Contact No. </strong></td>
                                                  <td width="1%" align="left" valign="top" class="profiledetail">:</td>
                                                  <td width="90%" align="left" valign="top" class="profiledetail"><?php echo stripslashes($contentslogin['Member']['Phone']); ?></td>
                                              </tr>
                                                <tr>
                                                  <td width="10%" align="left" valign="top"><strong>City</strong></td>
                                                  <td width="1%" align="left" valign="top" class="profiledetail">:</td>
                                                  <td width="90%" align="left" valign="top" class="profiledetail"><?php echo stripslashes($contentslogin['Member']['City']); ?></td>
                                              </tr>
                                                <tr>
                                                  <td align="left" valign="top"><strong>State</strong></td>
                                                  <td width="1%" align="left" valign="top" class="profiledetail">:</td>
                                                  <td align="left" valign="top" class="profiledetail"><?php echo stripslashes($contentslogin['Member']['State']); ?></td>
                                              </tr>
                                                <tr>
                                                  <td align="left" valign="top"><strong>Country</strong></td>
                                                  <td width="1%" align="left" valign="top" class="profiledetail">:</td>
                                                  <td align="left" valign="top" class="profiledetail"><?php echo stripslashes($contentslogin['Member']['Country']); ?></td>
                                              </tr>
                                              <tr>
                                                  <td width="10%" align="left" valign="top"><strong>Address</strong></td>
                                                  <td width="1%" align="left" valign="top" class="profiledetail">:</td>
                                                  <td width="90%" align="left" valign="top" class="profiledetail"><?php echo stripslashes($contentslogin['Member']['Address']); ?></td>
                                              </tr>
                                              
                                              <tr>
                                                <td align="left" valign="top"><strong>Pin Code </strong></td>
                                                <td width="1%" align="left" valign="top" class="profiledetail">:</td>
                                                <td align="left" valign="top" class="profiledetail"><?php echo stripslashes($contentslogin['Member']['PinCode']); ?></td>
                                              </tr>
                                            </tbody>
                                      </table>

</div>

<div class="innerbodycard">
<div class="sectionheading" style="padding:0px; margin:0px; margin-bottom:10px; padding-bottom:10px; border-bottom:1px solid #ddd;">Agency Information</div>
<table class="displaylist" style=" font-size:13px;">
                                            
                                            <tbody> 
											<?php if($contentslogin['Member']['Logo']!=''){ ?>
                                     <tr>
                                                  <td align="left" valign="top"><div style="width:120px;"><strong>Logo</strong></div></td>
                                                  <td width="1%" align="left" valign="top" class="profiledetail" style="position:relative;">&nbsp;</td>
                                                  <td align="left" valign="top" class="profiledetail" style="position:relative;"><img src="<?php echo stripslashes($contentslogin['Member']['Logo']); ?>"   id="dislogo" style="max-width: 100px; width:auto;"  > <div  style="position: absolute; text-align: left; display: inline-block; right: 0px; top: 6px;"> 
  



 
 
 
</div></td>
                                              </tr>
											  <?php } ?>
                                                <tr>
                                                  <td width="10%" align="left" valign="top"><div style="width:120px;"><strong>Agent ID</strong></div></td>
                                                  <td width="1%" align="left" valign="top" class="profiledetail">:</td>
                                                  <td width="90%" align="left" valign="top" class="profiledetail">#<?php echo stripslashes($contentslogin['Member']['DisplayId']); ?></td>
                                                </tr>
                                                <tr>
                                                  <td width="10%" align="left" valign="top"><strong>Company Name</strong></td>
                                                  <td width="1%" align="left" valign="top" class="profiledetail">:</td>
                                                  <td width="90%" align="left" valign="top" class="profiledetail"><?php echo stripslashes($contentslogin['Member']['CompanyName']); ?></td>
                                              </tr>
                                                <tr>
                                                  <td width="10%" align="left" valign="top"><strong>Business Type</strong></td>
                                                  <td width="1%" align="left" valign="top" class="profiledetail">:</td>
                                                  <td width="90%" align="left" valign="top" class="profiledetail"><?php echo stripslashes($contentslogin['Member']['BusinessType']); ?></td>
                                              </tr>
                                                <tr>
                                                  <td width="10%" align="left" valign="top"><strong>PAN</strong></td>
                                                  <td width="1%" align="left" valign="top" class="profiledetail">:</td>
                                                  <td width="90%" align="left" valign="top" class="profiledetail"><?php echo stripslashes($contentslogin['Member']['PAN']); ?></td>
                                              </tr>
                                                <tr>
                                                  <td align="left" valign="top"><strong>Agency GSTIN</strong></td>
                                                  <td width="1%" align="left" valign="top" class="profiledetail">:</td>
                                                  <td align="left" valign="top" class="profiledetail"><?php echo stripslashes($contentslogin['Member']['AgencyGSTIN']); ?></td>
                                              </tr>
                                                <tr>
                                                  <td align="left" valign="top"><strong>Website</strong></td>
                                                  <td width="1%" align="left" valign="top" class="profiledetail">:</td>
                                                  <td align="left" valign="top" class="profiledetail"><?php echo stripslashes($contentslogin['Member']['Website']); ?></td>
                                              </tr>
                                            </tbody>
                                      </table>

</div>
</div>


<?php include "footermenu.php"; ?>


 