<?php
include("lib/conn.php");
   $_SESSION['lastpage']=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];  ?>
<div id="fb-root"></div>
      <script>
        window.fbAsyncInit = function() {
          FB.init({
            appId      : '767567257201909',
            status     : true, 
            cookie     : true,
            xfbml      : true,
            oauth      : true
          });
        };
        (function(d){
           var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
           js = d.createElement('script'); js.id = id; js.async = true;
           js.src = "//connect.facebook.net/en_US/all.js";
           d.getElementsByTagName('head')[0].appendChild(js);
         }(document));
      </script>
	   <div class="fb-login-button" scope="email,mobile" on-login="updateUserSession();">
        Login with Facebook      </div>
	  <script language="javascript" type="text/javascript">
	  function updateUserSession()
{
	 FB.api('/user', function(user) {
	// console.log(user)
	 //alert(user);
	 alert(user.mobile);
	//alert(user.toSource());
	 alert(user.name);
	 ////return false;
			   if(user != null && user.name!='undefined'  && user.email!=undefined) {
				  ////var image = document.getElementById('image');
				  ////image.src = 'http://graph.facebook.com/' + user.id + '/picture';
				  ////var name = document.getElementById('toplogin');
				  ////alert(user.email);
				  var facebookEmail=user.email;
				  
				  var facebookName=user.first_name;
				  var facebookBirth=user.birthday;
				  var facebookHometown=user.hometown;
				  var facebookLocation=user.location;
			

				  
				  ////return false;
				  ////name.innerHTML = "Welcome, <span>"+facebookName+"</span>";
				  (facebookName);
				  (facebookEmail);
				  (facebookHometown);
				  (facebookLocation);
				  window.location="<?php echo $fullurl; ?>fb-login.php?email="+facebookEmail+'&name='+facebookName;
				
				  
		  
				  
		return false;				  
				  
				  
			   }
			 });	
}			
	  </script>