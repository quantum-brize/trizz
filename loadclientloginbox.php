<?php
include "inc.php";


if($_REQUEST['t']==1){
?>
<div class=" "> 
<form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="clientloginform">  
            <div class="formlogo"> 
              <p style="font-size:14px; font-weight:600; margin-bottom:0px;">Please Login/Register using your Email to continue

</p>
			             </div>
            <div class="inputbox">
            <input name="emailid" type="email" id="useremail"   placeholder="Email" validate style="font-weight:600; font-size:14px;"> 
            </div>
            <div class="loginbutton">
             <a onclick="clientlogin();">
                  <button type="button">Continue</button>
			  </a>
				  
				  <div style="text-align:center; font-size:26px; color:#666666; padding:40px 0px;">------------- Or -------------</div>
				  <div style="text-align:center; ">Login by username and password.</div>
				  <div style="text-align:center; "><a href="#" onclick="$('#clientloginformclient').show();$('#clientloginform').hide();"><strong>Login Now</strong></a></div>
               
            </div>
             
     <script>
	 function clientlogin(){
	 
	 if($('#useremail').val()!=''){
	 $('#clientloginform').submit();
	 } else {
	 alert('Enter valid email address!');
	 $('#useremail').focus()
	 }
	 
	 }
	 </script>
             
             <input name="action" type="hidden" value="clientloginotpsend" />
        </form>
		
		
		<form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="clientloginformclient" style="display:none;">  
            <div class="formlogo"> 
              <p style="font-size:14px; font-weight:600; margin-bottom:0px;"><strong>Enter your username and password</strong>

</p><br />

			             </div>
            <div class="inputbox">
            <input name="username" type="email" id="username"   placeholder="Username" validate style="font-weight:600; font-size:14px;"> 
            <input name="password" type="password" id="password"   placeholder="Password" validate style="font-weight:600; font-size:14px; margin-top:5px;"> 
            </div>
            <div class="loginbutton">  
				   <a onclick="$('#clientloginformclient').submit();">
                  <button type="button">Continue</button>
			  </a>
				  
				  <div style="text-align:center; font-size:26px; color:#666666; padding:40px 0px;">------------- Or -------------</div>
				  <div style="text-align:center; ">Login by OTP.</div>
				  <div style="text-align:center; "><a href="#"  onclick="$('#clientloginformclient').hide();$('#clientloginform').show();"><strong>Login Now</strong></a></div>
               
            </div>
             
      
             
             <input name="action" type="hidden" value="clientloginwithuserpassword" />
        </form>
      </div>

<?php } 

if($_REQUEST['t']==2){
?>
<div class=" ">  
<form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="clientloginform">  
            <div class="formlogo"> 
              <p style="font-size:14px; font-weight:600; margin-bottom:0px; text-align:center;">Enter 6 Digit OTP</p>
			             </div>
            <div class="inputbox">
            <input name="loginotp" type="text" id="otp" maxlength="6"   style="font-size:18px; font-weight:600; padding:10px; text-align:center;" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"> 
            </div>
            <div class="loginbutton">
             <a onclick="clientlogin();">
                  <button type="button">Continue</button>
				  </a>
               
            </div>
             
     <script>
	 function clientlogin(){ 
	 $('#clientloginform').submit();  
	 }
	 </script>
             
             <input name="action" type="hidden" value="clientloginotpenter" />
             <input name="emailid" type="hidden" value="<?php echo $_SESSION['b2cloginemail']; ?>" />
        </form>
      </div>

<?php }


if($_REQUEST['t']==3){
?>
<div class=" ">  
<form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="clientloginform">  
            <div class="formlogo"> 
              <p style="font-size:14px; font-weight:600; margin-bottom:0px; text-align:center;">Complete Your Profile</p>
			             </div>
            <div class="inputbox">
            <input name="name" type="text" maxlength="30"  placeholder="First Name" validate style="font-weight:600; font-size:16px;margin-bottom: 0px;"> 
            </div>
			
			 <div class="inputbox">
            <input name="lastName" type="text" maxlength="30"   placeholder="Last Name" validate style="font-weight:600; font-size:16px;margin-bottom: 0px;"> 
            </div>
			 <div class="inputbox">
            <input name="phone" type="text"  maxlength="10"  onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"  placeholder="Mobile Number" validate style="font-weight:600; font-size:16px;"> 
            </div>
            <div class="loginbutton">
             <a onclick="clientlogin();">
                  <button type="button">Save</button>
				  </a>
               
            </div>
             
     <script>
	 function clientlogin(){ 
	 $('#clientloginform').submit();  
	 }
	 </script>
             
             <input name="action" type="hidden" value="completeprofile" />
             <input name="emailid" type="hidden" value="<?php echo $_SESSION['b2cloginemail']; ?>" />
        </form>
      </div>

<?php }?>
<iframe id="clientloginform" style="display:none;"></iframe>