<?php   
$namevalue ='onlineStatus=2';   
$where='id="'.$_SESSION['userid'].'"';    
updatelisting('sys_userMaster',$namevalue,$where);   
 
$ars=GetPageRecord('invoiceLogo','sys_userMaster','id=1');   
$companyLogoAdmin=mysqli_fetch_array($ars); 
?>



 


<style>
.welcomename{background: rgb(233,45,24); background: linear-gradient(180deg, rgba(233,45,24,1) 0%, rgba(246,173,1,1) 32%, rgba(49,116,241,1) 66%, rgba(36,154,65,1) 100%); border:0px;}
#tograypanelmenu .welcomename{height:27px; width:27px; padding: 2px; border:0px;}
#tograypanelmenu .welcomename .inside{width:100%; height:100%; border-radius: 100%; text-align:center; background-color:#fff; font-size:15px;}


.prifilemenuouter{background-color:#2d2f31; position:fixed; right:10px; top:40px; color:#fff; z-index:999; width:376px;border-radius: 28px; padding:10px; display:none;}
.prifilemenuouter .inside{ background-color:#1f1f1f; border-radius: 24px;}
.prifilemenuouter .content{padding:10px;}
.buddyouter{background: rgb(233,45,24); background: linear-gradient(180deg, rgba(233,45,24,1) 0%, rgba(246,173,1,1) 32%, rgba(49,116,241,1) 66%, rgba(36,154,65,1) 100%); padding:4px; border-radius:100px; width:64px; height:64px; margin-right:5px; position:relative;}
.buddyouter .buddyimg{background-color:#fff;  width:100%; height:100%;border-radius:100px; font-size:35px; text-align:center; color:#000;}
.buttonprofile{border: 1px solid #adadad70; padding: 5px 10px; color: #FFFFFF; font-size: 14px; font-weight: 600; margin-top:10px; text-align: left; border-radius: 10px; cursor: pointer; }
.buttonprofile:hover{ background-color: #cccccc12;}
</style>




<div id="preloader" style="background-color: #ffffffdb;">



         <div id="status">



            <div class="spinner"></div>



         </div>



      </div>



	  



	  



	  











<div id="tograypanelmenu">



<div class="logonavitop">



<a href="<?php echo $fullurl; ?>" class="topmainlogomain"><img src="profilepic/<?php echo stripslashes($companyLogoAdmin['invoiceLogo']); ?>" /></a>



<a class="topmainlogomainmobile" onclick="$('#navigation').toggle();"><i class="fa fa-bars" aria-hidden="true"></i></a>



</div>







<div id="searchblk"></div>



<div class="headersearchbarouter">



<table width="100%" border="0" cellpadding="0" cellspacing="0">



  <tr>



    <td colspan="2"><select name="topsearchtype" id="topsearchtype" onchange="topsearchstart();">



      <option value="All">All</option>



      <option value="Queries">Queries</option>



      <option value="Itineraries">Itineraries</option>



      <option value="Clients">Clients</option>
      <option value="Agents">Agents</option>
      <option value="Corporate">Corporate</option>



 



    </select></td>



    <td width="90%"> 



      <input type="text" name="topsearchkeyword" id="topsearchkeyword" placeholder="Search"  style="border-left:1px solid #ddd;" onfocus="opensearch();" onkeyup="topsearchstart();"/></td>



  </tr>



</table>



<i class="fa fa-search" aria-hidden="true"></i>











<div id="topsearchresult"></div>



</div>











<script>



function opensearch(){



$('#searchblk').show();



$('.headersearchbarouter').addClass('searchstart');



$('html').css('overflow','hidden');



}











function topsearchstart(){



var topsearchtype = encodeURI($('#topsearchtype').val());



var topsearchkeyword = encodeURI($('#topsearchkeyword').val());



$('#topsearchresult').load('topsearchresult.php?keyword='+topsearchkeyword+'&topsearchtype='+topsearchtype);



}







$("#searchblk").click(function(){



   $('#searchblk').hide();




   $('.headersearchbarouter').removeClass('searchstart');



   $('html').css('overflow','visible');



});



</script>







<div class="navirightlink" id="welcomename"> 
<div class="welcomename" title="User Menu" onclick="$('.prifilemenuouter').show();"><div class="inside"><i class="fa fa-user" aria-hidden="true"></i></div></div>  
<div class="prifilemenuouter" id="clickbox">
<div class="inside">
<div class="content" style="border-bottom:2px solid #2d2f31;">
<table width="100%" border="0" cellpadding="0" cellspacing="0"> 
  <tr> 
    <td colspan="2" align="center" valign="top"><div class="buddyouter"><div class="buddyimg"><i class="fa fa-user" aria-hidden="true"></i></div>
    </div></td> 
    <td width="80%" align="left" valign="middle"> 
	<div style="font-size:16px; font-weight:600;"><?php echo stripslashes($LoginUserDetails['firstName']).' '.stripslashes($LoginUserDetails['lastName']); ?></div> 
	<div style="margin-bottom:0px; font-size:12px; font-weight:400; color:#adadad;">Email: <strong><?php echo ($LoginUserDetails['email']); ?></strong></div> 
	<div style="margin-bottom:0px; font-size:12px; font-weight:400; color:#adadad;">Last Login: <strong><?php echo date('d/m/Y - h:i A',strtotime($LoginUserlog['lLogin'])); ?></strong></div> 
	
	</td> 
  </tr> 

</table>
</div>

<div class="content" style="border-bottom:2px solid #2d2f31; text-align:center;">
<div class="workinghoursstrip" style="background-color: transparent; color: #adadad; padding: 0px;"><i class="fa fa-clock-o" aria-hidden="true"></i> Today's Working Hours: <span id="showcurrentworkinghours">0</span></div>
</div>
<script>

function openalerttaskremincer(){
$('#loadremindertask').load('loadremindertask.php');

}

function showcurrentworkinghours(){
openalerttaskremincer(); 
$('#showcurrentworkinghours').load('todaysworkinghours.php'); 
}

 
</script>


<div class="content" style="border-bottom:2px solid #2d2f31; text-align:center;">

	<a href="display.html?ga=myprofile"><div class="buttonprofile" style="margin-top:5px;"><i class="fa fa-user" aria-hidden="true"></i> &nbsp; &nbsp; Manage Your Profile</div></a>
<a href="display.html?ga=mailsetting"><div class="buttonprofile" style="margin-bottom:5px;"><i class="fa fa-envelope" aria-hidden="true"></i> &nbsp; &nbsp;Mail Setting</div></a> 


</div>

 


</div>


<div class="content" >
	<a href="logout.html"><div class="buttonprofile" style="border: 0px; margin: 0px;"><i class="fa fa-sign-out" aria-hidden="true"></i>  &nbsp; Logout of my account</div></a>
</div>
<?php if($_SESSION['userid']==1){ ?>
<a href="https://travbizz.com" target="_blank" style="color:#adadad;"><div class="content"  style="border-top: 1px solid #adadad26; text-align:center; font-size:12px;">
<i class="fa fa-question-circle" aria-hidden="true"></i> &nbsp;System Support
</div></a>
<?php } ?>
</div>
</div>





<script>
window.addEventListener('click', function(e){   
  if (document.getElementById('welcomename').contains(e.target)){
         $('#clickbox').show();
  } else{
     $('#clickbox').hide();
  }
});
</script>





<div class="rightmenu">
 

<a title="Create New" style="display:none;" onclick="openusermenu();$('.usermenu').hide();$('.createnewmenu').show();$('.createnotification').hide();$('.workinghoursstrip').hide();$('.headerslideright').addClass('width480');"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>


 <?php if($_SESSION['userid']==1){ ?>
<a href="display.html?ga=team" title="Setting" style="position:relative; padding-top: 5px; padding-right:0px;"  data-toggle="tooltip" data-placement="bottom"  data-original-title="Setting"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="19px" height="19px" viewBox="0 0 14 14" version="1.1"> 
    <svg class="unified360-icon unified360-valign" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><g data-name="Layer 2"><path d="M16.9 12.81a.73.73 0 0 1 .71-.42 2.39 2.39 0 1 0 0-4.78h-.14a.7.7 0 0 1-.59-.33 1.09 1.09 0 0 0-.05-.17.71.71 0 0 1 .17-.81 2.33 2.33 0 0 0 .7-1.69 2.38 2.38 0 0 0-.7-1.69 2.43 2.43 0 0 0-3.42 0 .7.7 0 0 1-.78.14.73.73 0 0 1-.42-.71 2.39 2.39 0 0 0-4.78 0v.14a.7.7 0 0 1-.33.59H7.1A.71.71 0 0 1 6.3 3a2.45 2.45 0 0 0-3.38 0 2.38 2.38 0 0 0-.7 1.69A2.43 2.43 0 0 0 3 6.41a.76.76 0 0 1-.57 1.27 2.39 2.39 0 0 0 0 4.78h.14a.7.7 0 0 1 .64.43.71.71 0 0 1-.21.81 2.33 2.33 0 0 0-.7 1.69 2.38 2.38 0 0 0 .7 1.69 2.43 2.43 0 0 0 3.42 0 .76.76 0 0 1 1.27.57 2.39 2.39 0 0 0 4.78 0v-.14a.68.68 0 0 1 .43-.64.71.71 0 0 1 .81.18 2.45 2.45 0 0 0 3.38 0 2.38 2.38 0 0 0 .7-1.69 2.43 2.43 0 0 0-.79-1.77.69.69 0 0 1-.14-.77zm-1.28-.55a2.1 2.1 0 0 0 .47 2.36 1 1 0 0 1 .29.7 1 1 0 0 1-.29.7 1 1 0 0 1-1.46 0 2.05 2.05 0 0 0-2.3-.42 2.08 2.08 0 0 0-1.27 1.92v.14a1 1 0 0 1-1 1 1 1 0 0 1-1-1.08 2.06 2.06 0 0 0-1.33-1.9 2 2 0 0 0-.84-.18 2.2 2.2 0 0 0-1.53.65 1 1 0 0 1-1.4 0 1 1 0 0 1-.29-.7 1.05 1.05 0 0 1 .33-.82 2.07 2.07 0 0 0 .43-2.3 2.11 2.11 0 0 0-1.93-1.27h-.11a1 1 0 0 1-1-1 1 1 0 0 1 1.08-1 2.06 2.06 0 0 0 1.9-1.33 2.11 2.11 0 0 0-.47-2.37 1 1 0 0 1-.29-.7 1 1 0 0 1 .3-.66 1 1 0 0 1 1.46 0 2.08 2.08 0 0 0 2.17.48.66.66 0 0 0 .2-.06A2.09 2.09 0 0 0 9 2.53v-.14a1 1 0 0 1 1-1 1 1 0 0 1 1 1.07 2.08 2.08 0 0 0 1.26 1.91 2.11 2.11 0 0 0 2.37-.47 1 1 0 0 1 1.4 0 1 1 0 0 1 .29.7 1.05 1.05 0 0 1-.34.76 2.08 2.08 0 0 0-.48 2.17.66.66 0 0 0 .06.2A2.09 2.09 0 0 0 17.47 9h.14a1 1 0 0 1 1 1 1 1 0 0 1-1.07 1 2.07 2.07 0 0 0-1.92 1.26z"></path><path d="M10 7.11A2.89 2.89 0 1 0 12.89 10 2.9 2.9 0 0 0 10 7.11zm0 4.38A1.49 1.49 0 1 1 11.49 10 1.49 1.49 0 0 1 10 11.49z"></path></g></svg>
</svg> </a>

<?php } ?>
<a href="#"  title="Notification" style="position:relative; padding-top: 6px;"  data-toggle="tooltip" data-placement="bottom"  data-original-title="Notification"  style="position:relative;" onclick="openusermenu();$('.usermenu').hide();$('.createnewmenu').hide();$('.createnotification').show();$('#loadnotificationscreate').load('loadnotificationscreate.php');"><i class="fa fa-bell-o" aria-hidden="true"></i><div class="topnotifications">1</div></a>
<?php if($_SESSION['userid']==1){ ?>
 <style>
 .rightmenu path{stroke: #758693 !important;}
 .rightmenu rect{stroke: #758693 !important;}
 .rightmenu g{stroke: #758693 !important;}
 </style>
 
 <a href="display.html?ga=company-expense" title="Company Expense" style="position:relative; padding-top: 5px; padding-right:0px;"  data-toggle="tooltip" data-placement="bottom"  data-original-title="Company Expense"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="19px" height="19px" viewBox="0 0 14 14" version="1.1"> 
    <g id="icon-sales-activity" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect id="Rectangle" fill-opacity="0.01" fill="#FFFFFF" opacity="0.01" x="0" y="0" width="14" height="14"></rect>
        <g id="icon-group" class="unified360-valignimg" transform="translate(1.000000, 0.000000)" stroke="#000000">
            <g id="Group-25-Copy" transform="translate(0.500000, 0.500000)">
                <path d="M8.12797546,0.8125 L10.2916667,0.8125 C10.5908209,0.8125 10.8333333,1.05501243 10.8333333,1.35416667 L10.8333333,12.4583333 C10.8333333,12.7574876 10.5908209,13 10.2916667,13 L0.541666667,13 C0.242512427,13 0,12.7574876 0,12.4583333 L0,1.35416667 C0,1.05501243 0.242512427,0.8125 0.541666667,0.8125 L0.541666667,0.8125 L2.69438171,0.8125" id="Rectangle-4"></path>
                <rect id="Rectangle-8" stroke-linecap="round" stroke-linejoin="round" x="2.70833333" y="0" width="5.41666667" height="1.625"></rect>
                <path d="M1.89583333,5.42914206 L2.52198813,6.04041802 C2.54309154,6.06101997 2.57677825,6.06101997 2.59788166,6.04041802 L3.79166667,4.875" id="Path-2" stroke-linecap="round"></path>
                <path d="M1.89583333,9.22080872 L2.52198813,9.83208469 C2.54309154,9.85268664 2.57677825,9.85268664 2.59788166,9.83208469 L3.79166667,8.66666667" id="Path-2" stroke-linecap="round"></path>
                <line x1="5.81063139" y1="5.28125" x2="8.80208333" y2="5.28125" id="Line-7" stroke-linecap="round" stroke-linejoin="round"></line>
                <line x1="5.81063139" y1="9.07291667" x2="8.80208333" y2="9.07291667" id="Line-7" stroke-linecap="round" stroke-linejoin="round"></line>
            </g>
        </g>
    </g>
</svg> </a>

 
<?php } ?>

</div>







</div>



<script>



function openusermenu(){ 



$('.rnblk').show();



$('.headerslideright').show("slide", { direction: "right" }, 100);



$('html').css('overflow','hidden');



}







function closeusermenu(){ 



$('.headerslideright').hide("slide", { direction: "right" }, 100);



$('html').css('overflow','visible');



$('.rnblk').hide();



}



</script>







































<div class="rnblk">



<div class="headerslideright ">
  

<div class="contnetin createnewmenu">
 

<div class="head17" style="position:relative;">Masters & Settings<i class="fa fa-times" aria-hidden="true" style="position: absolute; right: 0px; top: -5px; color: #666666; font-size: 18px; cursor: pointer;" onclick="closeusermenu();"></i></div>    
</div> 


 
<div class="contnetin createnotification"> 
<div class="head17" style="position:relative;">Notifications<i class="fa fa-times" aria-hidden="true" style="position: absolute; right: 0px; top: -5px; color: #666666; font-size: 18px; cursor: pointer;" onclick="closeusermenu();"></i></div>



 



 



 <div id="loadnotificationscreate" style="height:600px;">



 



 



 </div>



 







</div>



</div>



</div> 











</div>







      <div class="header-bg sticky">



         <!-- Navigation Bar-->



         <header id="topnav">



             



            <!-- end topbar-main --><!-- MENU Start -->



            <div class="navbar-custom">



               <div class="container-fluid">



                  <!-- Logo-->



                  <div class="d-none d-lg-block">



                     <!-- Text Logo



                        <a href="index.html" class="logo">



                            Foxia



                        </a>



                         --><!-- Image Logo --> 



                     <a href="<?php echo $fullurl; ?>" class="logo">



                         



                     </a>



                  </div>



                  <!-- End Logo-->



                  <div id="navigation">



                     <!-- Navigation Menu-->



                     <ul class="navigation-menu">



                        <li class="has-submenu"><a href="<?php echo $fullurl; ?>"  data-toggle="tooltip" data-placement="right" title="Dashboard"><svg class="unified360-icon unified360-valign" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M17.3 1H2.7A2.7 2.7 0 0 0 0 3.7v12.6A2.7 2.7 0 0 0 2.7 19h14.6a2.7 2.7 0 0 0 2.7-2.7V3.7A2.7 2.7 0 0 0 17.3 1zm1.3 15.3a1.3 1.3 0 0 1-1.3 1.3H2.7a1.3 1.3 0 0 1-1.3-1.3V3.7a1.3 1.3 0 0 1 1.3-1.3h14.6a1.3 1.3 0 0 1 1.3 1.3zM8 14.3a.7.7 0 0 1-.7.7H3.7a.7.7 0 0 1 0-1.4h3.6a.7.7 0 0 1 .7.7zm4-2.84a.7.7 0 0 1-.7.7H3.7a.7.7 0 0 1 0-1.4h7.6a.7.7 0 0 1 .7.7zm5.37-4.94a2.87 2.87 0 0 1-5.73 0 .7.7 0 0 1 1.4 0 1.47 1.47 0 1 0 1.46-1.47.7.7 0 1 1 0-1.4 2.88 2.88 0 0 1 2.87 2.87z" data-name="Layer 1"></path></svg></a></li>



<li class="has-submenu"><a style="cursor:pointer;"><svg class="unified360-icon unified360-valign"   style="width: 24px !important;" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
  viewBox="0 0 46.055 46.055"
	 xml:space="preserve">
<g>
	<g>
		<path d="M33.453,26.969H12.604c-0.839,0-1.52,0.665-1.52,1.505c0,0.838,0.68,1.504,1.52,1.504h20.849
			c0.839,0,1.52-0.666,1.52-1.504C34.973,27.634,34.293,26.969,33.453,26.969z"/>
		<path d="M45.752,37.209l-1.673-6.479V9.09c0-2.9-2.374-5.284-5.276-5.284H7.253c-2.902,0-5.275,2.384-5.275,5.284v21.64
			l-1.676,6.479c-0.467,1.095-0.389,2.381,0.206,3.397c0.594,1.02,1.625,1.643,2.731,1.643h39.578c1.106,0,2.136-0.623,2.729-1.643
			C46.142,39.59,46.219,38.304,45.752,37.209z M6.042,9.09c0-0.667,0.543-1.221,1.211-1.221h31.55c0.668,0,1.212,0.554,1.212,1.221
			v21.64c0,0.668-0.544,1.198-1.212,1.198H7.253c-0.668,0-1.212-0.53-1.212-1.198L6.042,9.09L6.042,9.09z"/>
		<path d="M34.316,11.448c-0.833-1.045-4.373-0.841-6.04,0.428l-1.261,1.005l-11.143-0.93c-0.474-0.039-0.907,0.268-1.029,0.727
			l-0.21,0.798c-0.101,0.379,0.035,0.781,0.344,1.022l4.773,4.175l-2.421,1.93l-5.001-0.41c-0.298-0.024-0.571,0.169-0.648,0.458
			l-0.133,0.502c-0.063,0.239,0.022,0.492,0.216,0.645l2.611,2.044c-0.003,0.375,0.105,0.754,0.338,1.083
			c0.591,0.838,1.75,1.039,2.588,0.447c0,0,11.657-8.32,15.604-11.004C33.297,14.102,35.149,12.492,34.316,11.448z"/>
	</g>
</g>
</svg></a> 

						<ul class="submenu" style="left:44px;top: -7px;"> 
<div>


						<li><a href="display.html?ga=flightbooking"><i class="fa fa-plane" aria-hidden="true"></i> Flight Booking</a></li>   
						<li><a href="display.html?ga=hotelBookings"><i class="fa fa-building" aria-hidden="true"></i> Hotel Booking</a></li>   
<!--<li><a href="display.html?ga=mailing-templates"><i class="fa fa-car" aria-hidden="true"></i> Cab Booking</a></li> -->  
</div> </ul></li>

<?php if (strpos($LoginUserDetails["permissionView"], 'Client') !== false) { ?>
<li class="has-submenu"><a style="cursor:pointer;"><svg class="unified360-icon unified360-valign" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><g id="Layer_2" data-name="Layer 2"><g id="Layer_2-2" data-name="Layer 2"><path d="M10,3.72a3.49,3.49,0,1,0,3.49,3.49A3.5,3.5,0,0,0,10,3.72ZM10,9.3a2.09,2.09,0,1,1,2.09-2.09A2.1,2.1,0,0,1,10,9.3Z"></path><path d="M10,0A10,10,0,1,0,20,10,10,10,0,0,0,10,0ZM5.1,17.06a.24.24,0,0,0,0-.08v-1.4a2.1,2.1,0,0,1,2.09-2.09h5.58a2.1,2.1,0,0,1,2.09,2.09V17a.24.24,0,0,0,0,.08,8.57,8.57,0,0,1-9.8,0Zm11.18-1.2v-.28a3.5,3.5,0,0,0-3.49-3.49H7.21a3.5,3.5,0,0,0-3.49,3.49v.28a8.6,8.6,0,1,1,12.56,0Z"  ></path></g></g></svg></a> 

						<ul class="submenu" style="left:44px;top: -7px;"> 
<div>

 
			<li><a href="display.html?ga=agents"><i class="fa fa-user" aria-hidden="true"></i> Agents</a></li>   
			<li><a href="display.html?ga=suppliers"><i class="fa fa-user-circle" aria-hidden="true"></i> Suppliers</a></li>   
			<li><a href="display.html?ga=clients"><i class="fa fa-users" aria-hidden="true"></i> Clients</a></li>  
 
</div> </ul></li>
<?php } ?>

                         <?php if (strpos($LoginUserDetails["permissionView"], 'Query') !== false) { ?><li class="has-submenu<?php if($selectedmenu==4){ ?> active<?php } ?>"><a href="display.html?ga=query"  data-toggle="tooltip" data-placement="right" title="Queries"><svg class="unified360-icon" width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
<path d="M17.3 20H2.7C1.98392 20 1.29716 19.7155 0.790812 19.2092C0.284464 18.7028 0 18.0161 0 17.3L0 2.7C0 1.98392 0.284464 1.29716 0.790812 0.790812C1.29716 0.284464 1.98392 0 2.7 0L17.3 0C18.0161 0 18.7028 0.284464 19.2092 0.790812C19.7155 1.29716 20 1.98392 20 2.7V17.3C20 18.0161 19.7155 18.7028 19.2092 19.2092C18.7028 19.7155 18.0161 20 17.3 20ZM2.7 1.4C2.52928 1.4 2.36023 1.43363 2.20251 1.49896C2.04479 1.56429 1.90148 1.66005 1.78076 1.78076C1.66005 1.90148 1.56429 2.04479 1.49896 2.20251C1.43363 2.36023 1.4 2.52928 1.4 2.7V17.3C1.4 17.6448 1.53696 17.9754 1.78076 18.2192C1.90148 18.34 2.04479 18.4357 2.20251 18.501C2.36023 18.5664 2.52928 18.6 2.7 18.6H17.3C17.6448 18.6 17.9754 18.463 18.2192 18.2192C18.463 17.9754 18.6 17.6448 18.6 17.3V2.7C18.6 2.35522 18.463 2.02456 18.2192 1.78076C17.9754 1.53696 17.6448 1.4 17.3 1.4H2.7Z"></path>
<path d="M11.3 17.0001H4.7C4.47675 17.0001 4.25569 16.9561 4.04944 16.8707C3.84318 16.7853 3.65578 16.66 3.49792 16.5022C3.17911 16.1834 3 15.751 3 15.3001V13.3001C3 12.8492 3.17911 12.4168 3.49792 12.098C3.81673 11.7792 4.24913 11.6001 4.7 11.6001H11.3C11.7509 11.6001 12.1833 11.7792 12.5021 12.098C12.8209 12.4168 13 12.8492 13 13.3001V15.3001C13 15.751 12.8209 16.1834 12.5021 16.5022C12.1833 16.821 11.7509 17.0001 11.3 17.0001ZM4.7 13.0001C4.66023 12.9987 4.62059 13.0055 4.58356 13.0201C4.54653 13.0347 4.5129 13.0567 4.48476 13.0849C4.45662 13.113 4.43457 13.1466 4.41999 13.1837C4.40541 13.2207 4.3986 13.2603 4.4 13.3001V15.3001C4.3986 15.3399 4.40541 15.3795 4.41999 15.4165C4.43457 15.4536 4.45662 15.4872 4.48476 15.5153C4.5129 15.5435 4.54653 15.5655 4.58356 15.5801C4.62059 15.5947 4.66023 15.6015 4.7 15.6001H11.3C11.3398 15.6015 11.3794 15.5947 11.4164 15.5801C11.4535 15.5655 11.4871 15.5435 11.5152 15.5153C11.5434 15.4872 11.5654 15.4536 11.58 15.4165C11.5946 15.3795 11.6014 15.3399 11.6 15.3001V13.3001C11.6014 13.2603 11.5946 13.2207 11.58 13.1837C11.5654 13.1466 11.5434 13.113 11.5152 13.0849C11.4871 13.0567 11.4535 13.0347 11.4164 13.0201C11.3794 13.0055 11.3398 12.9987 11.3 13.0001H4.7Z"></path>
<path d="M16.3 9.0001H3.7C3.51435 9.0001 3.3363 8.92635 3.20503 8.79507C3.07375 8.6638 3 8.48575 3 8.3001C3 8.11445 3.07375 7.9364 3.20503 7.80512C3.3363 7.67385 3.51435 7.6001 3.7 7.6001H16.3C16.4857 7.6001 16.6637 7.67385 16.795 7.80512C16.9263 7.9364 17 8.11445 17 8.3001C17 8.48575 16.9263 8.6638 16.795 8.79507C16.6637 8.92635 16.4857 9.0001 16.3 9.0001Z"></path>
<path d="M16.3 5.15977H3.7C3.51435 5.15977 3.3363 5.08602 3.20503 4.95474C3.07375 4.82346 3 4.64542 3 4.45977C3 4.27411 3.07375 4.09607 3.20503 3.96479C3.3363 3.83352 3.51435 3.75977 3.7 3.75977H16.3C16.4857 3.75977 16.6637 3.83352 16.795 3.96479C16.9263 4.09607 17 4.27411 17 4.45977C17 4.64542 16.9263 4.82346 16.795 4.95474C16.6637 5.08602 16.4857 5.15977 16.3 5.15977Z" ></path>
</svg></a></li><?php } ?>

						


                        <?php if (strpos($LoginUserDetails["permissionView"], 'Itinerary') !== false) { ?><li class="has-submenu<?php if($selectedmenu==2){ ?> active<?php } ?>"><a href="display.html?ga=itineraries"   data-toggle="tooltip" data-placement="right" title="Itineraries"><svg class="unified360-icon unified360-valign" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><path d="M16.16,8.93l-3.6,1.64a.69.69,0,0,0-.41.63v3.28a.72.72,0,0,0,.7.7.59.59,0,0,0,.29-.07l3.6-1.63a.72.72,0,0,0,.41-.64V9.57a.7.7,0,0,0-1-.64Zm-.41,3.46-2.2,1V11.65l2.2-1Z"></path><path d="M19.92,4.44a.08.08,0,0,0,0,0,.7.7,0,0,0-.2-.22s0,0,0,0h0a.18.18,0,0,0-.07-.05l-9.3-4a.68.68,0,0,0-.56,0l-9.3,4a.18.18,0,0,0-.07.05h0l0,0a.7.7,0,0,0-.2.22.08.08,0,0,0,0,0,.64.64,0,0,0-.08.3V15.26a.71.71,0,0,0,.42.64l9.3,4h0a.65.65,0,0,0,.5,0h0l9.3-4a.71.71,0,0,0,.42-.64V4.74A.64.64,0,0,0,19.92,4.44ZM10,1.46l7.54,3.28L10,8,2.46,4.74ZM1.4,5.81,9.3,9.25v9L1.4,14.8Zm9.3,12.42v-9l7.9-3.44v9Z" ></path></g></g></svg>
						</a></li><?php } ?>


 


<?php
 
 if (strpos($LoginUserDetails["permissionView"], 'Agent') !== false) { ?><li class="has-submenu<?php if($_REQUEST['ga']=='agent'){ ?> active<?php } ?>"><a href="display.html?ga=agent"   data-toggle="tooltip" data-placement="right" title="Agents"><i class="fa fa-user-o" aria-hidden="true"></i></a></li><?php } ?>

          
			 
 
						

<?php if (strpos($LoginUserDetails["permissionView"], 'Corporate') !== false) { ?><li class="has-submenu<?php if($_REQUEST['ga']=='corporate'){ ?> active<?php } ?>"><a href="display.html?ga=corporate"   data-toggle="tooltip" data-placement="right" title="Corporate"><i class="fa fa-building-o" aria-hidden="true"></i></a></li><?php } ?>
						



         <li  style="display:none;" class="has-submenu<?php if($_REQUEST['ga']=='inboxmails'){ ?> active<?php } ?>"><a href="display.html?ga=inboxmails"   data-toggle="tooltip" data-placement="right" title="Mails"><svg class="unified360-icon unified360-valign" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M20 3.88a2.57 2.57 0 0 0-2.51-2.08H2.56A2.57 2.57 0 0 0 .05 3.85a2.42 2.42 0 0 0 0 .47v11.3a2.58 2.58 0 0 0 2.56 2.58h14.83A2.58 2.58 0 0 0 20 15.65V4.35a2.42 2.42 0 0 0 0-.47zM2.56 3.17h14.88a1.13 1.13 0 0 1 1 .58L10 9.71l-8.41-6a1.13 1.13 0 0 1 .97-.54zm14.88 13.66H2.56a1.17 1.17 0 0 1-1.16-1.18V5.34l8.2 5.8a.68.68 0 0 0 .8 0l8.2-5.8v10.31a1.17 1.17 0 0 1-1.16 1.18z" data-name="Layer 1"></path></svg>
						</a></li> 
			 
 

			 



						<?php if (strpos($LoginUserDetails["permissionView"], 'Report') !== false) { ?><li class="has-submenu"><a href="#"><svg class="unified360-icon unified360-valign" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M16.75 20H3.25A3.26 3.26 0 0 1 0 16.75V3.25A3.26 3.26 0 0 1 3.25 0h13.5A3.26 3.26 0 0 1 20 3.25v13.5A3.26 3.26 0 0 1 16.75 20zM3.25 1.4A1.85 1.85 0 0 0 1.4 3.25v13.5a1.85 1.85 0 0 0 1.85 1.85h13.5a1.85 1.85 0 0 0 1.85-1.85V3.25a1.85 1.85 0 0 0-1.85-1.85zm12.29 13.44V9a.7.7 0 0 0-1.4 0v5.86a.7.7 0 0 0 1.4 0zm-4.84 0V5.16a.7.7 0 0 0-1.4 0v9.68a.7.7 0 0 0 1.4 0zm-4.84 0v-4.08a.7.7 0 1 0-1.4 0v4.08a.7.7 0 1 0 1.4 0z" data-name="Layer 1"></path></svg></a>



						<ul class="submenu"><!--



						<li><a href="display.html?ga=systemreport">System Report</a></li> -->


<div>

						<li><a href="display.html?ga=flightgstreport"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Flight GST Report</a></li>
						<li><a href="display.html?ga=hotelgstreport"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Hotel GST Report</a></li>
						<li><a href="display.html?ga=profitlossreport"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Profit / Loss Report</a></li>  
							<li><a href="display.html?ga=attandancesreport"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Attandance Report</a></li>  



						<li><a href="display.html?ga=notesreport"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Notes Report</a></li>  



						<li><a href="display.html?ga=collectreport"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Collection Report</a></li>  



						<li><a href="display.html?ga=travelreport"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Tours Report</a></li>  



						<li><a href="display.html?ga=todoreport"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Task's / Followup's Report</a></li>  



						<li><a href="display.html?ga=misreport"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> MIS Report</a></li>  



						<li><a href="display.html?ga=leisurereport"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Ledger Report</a></li>  

</div>

						</ul></li><?php } ?>



						 



				



				



						



						<?php if($_SESSION['userid']==1 || strpos($LoginUserDetails["permissionView"], 'ManualVoucher') !== false) { ?>



						



						<li class="has-submenu<?php if($selectedmenu==6){ ?> active<?php } ?>"><a style="cursor:pointer;"><svg class="unified360-icon unified360-valign" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><g data-name="Layer 2"><path d="M19.57 11.76l-12-5.12a.71.71 0 0 0-.78.15.73.73 0 0 0-.15.78l5.13 12a.71.71 0 0 0 .66.43h.06a.7.7 0 0 0 .63-.55l1.17-5.16 5.18-1.17a.72.72 0 0 0 .55-.63.71.71 0 0 0-.45-.73zM13.52 13a.71.71 0 0 0-.54.54L12.2 17 8.62 8.64 17 12.21zM10.26 5.8a.71.71 0 0 1-.5-1.21l2.44-2.44a.71.71 0 0 1 1 1l-2.43 2.44a.73.73 0 0 1-.51.21zM2.69 13.41a.71.71 0 0 1-.51-.21.72.72 0 0 1 0-1l2.44-2.44a.71.71 0 0 1 1 1L3.19 13.2a.7.7 0 0 1-.5.21zM5.11 5.9a.69.69 0 0 1-.5-.2L2.17 3.26a.7.7 0 0 1 0-1 .71.71 0 0 1 1 0l2.44 2.43a.71.71 0 0 1 0 1 .68.68 0 0 1-.5.21zM7.69 4.86A.71.71 0 0 1 7 4.15V.71a.71.71 0 0 1 1.4 0v3.44a.71.71 0 0 1-.71.71zM4.16 8.41H.71A.71.71 0 0 1 .71 7h3.45a.71.71 0 1 1 0 1.42z"></path></g></svg></a>



						



						<ul class="submenu" style="left:44px;top: -80px;">



	 

<div>


						<li><a href="display.html?ga=maketing-dashboard"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Maketing Dashboard</a></li>  



						<li><a href="display.html?ga=clients-group"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Clients Group</a></li>  



						<li><a href="display.html?ga=mailing-templates"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Email Templates</a></li>  



						<li><a href="display.html?ga=campaigns"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Campaigns</a></li>    



						<li><a href="display.html?ga=landingpages"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Landing Pages</a></li>    

</div>

						</ul></li> 



						



						<?php if($withwebsite=='yes'){ ?>



						<li class="has-submenu<?php if($selectedmenu==6){ ?> active<?php } ?>"><a style="cursor:pointer;"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="18" viewBox="0 0 20 18">
<path d="M18.24 11.96H17.68V9.67C17.68 9.28 17.37 8.97 16.98 8.97H10.7V7.38H13.92C14.89 7.38 15.68 6.59 15.68 5.62V1.76C15.68 0.79 14.89 0 13.92 0H6.08C5.11 0 4.32 0.79 4.32 1.76V5.61C4.32 6.58 5.11 7.37 6.08 7.37H9.3V8.96H3.03C2.64 8.96 2.33 9.27 2.33 9.66V11.95H1.76C0.79 11.96 0 12.75 0 13.72V16.24C0 17.21 0.79 18 1.76 18H4.28C5.25 18 6.04 17.21 6.04 16.24V13.72C6.04 12.75 5.25 11.96 4.28 11.96H3.73V10.37H9.3V11.96H8.74C7.77 11.96 6.98 12.75 6.98 13.72V16.24C6.98 17.21 7.77 18 8.74 18H11.26C12.23 18 13.02 17.21 13.02 16.24V13.72C13.02 12.75 12.23 11.96 11.26 11.96H10.7V10.37H16.27V11.96H15.71C14.74 11.96 13.95 12.75 13.95 13.72V16.24C13.95 17.21 14.74 18 15.71 18H18.23C19.2 18 19.99 17.21 19.99 16.24V13.72C20 12.75 19.21 11.96 18.24 11.96ZM5.72 5.62V1.76C5.72 1.56 5.88 1.4 6.08 1.4H13.92C14.12 1.4 14.28 1.56 14.28 1.76V5.61C14.28 5.81 14.12 5.97 13.92 5.97H6.08C5.88 5.98 5.72 5.82 5.72 5.62ZM4.65 13.72V16.24C4.65 16.44 4.49 16.6 4.29 16.6H1.76C1.56 16.6 1.4 16.44 1.4 16.24V13.72C1.4 13.52 1.56 13.36 1.76 13.36H4.28C4.49 13.36 4.65 13.52 4.65 13.72ZM11.62 13.72V16.24C11.62 16.44 11.46 16.6 11.26 16.6H8.74C8.54 16.6 8.38 16.44 8.38 16.24V13.72C8.38 13.52 8.54 13.36 8.74 13.36H11.26C11.46 13.36 11.62 13.52 11.62 13.72ZM18.6 16.24C18.6 16.44 18.44 16.6 18.24 16.6H15.72C15.52 16.6 15.36 16.44 15.36 16.24V13.72C15.36 13.52 15.52 13.36 15.72 13.36H18.24C18.44 13.36 18.6 13.52 18.6 13.72V16.24Z"/>
</svg></a>

 

						<ul class="submenu" style="left:44px;top: -230px;">

<div>


						 <li><a href="display.html?ga=website-setting"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Website Setting</a></li>  



						<li><a href="display.html?ga=cms-pages"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> CMS Pages</a></li>  



						



						<li><a href="display.html?ga=home-banner"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Home Banner</a></li>  



						<li><a href="display.html?ga=testimonials"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Testimonials</a></li>     



						<li><a href="display.html?ga=website-destinations"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Website Destinations</a></li>   



						<li><a href="display.html?ga=about-website-destinations"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> About Destinations</a></li>   



						<li><a href="display.html?ga=website-photo-gallery"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Photo Gallery</a></li>      



						<li><a href="display.html?ga=website-blog"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Website Blog</a></li>  
						
							<li><a href="display.html?ga=webcheck"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Web Check</a></li>   
						<li><a href="display.html?ga=marquee"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Marquee</a></li>   
						<li><a href="display.html?ga=specialdeal"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Special Deal</a></li>    

</div>

						</ul></li> 



						<?php } ?>



						<?php } ?> 
 
 
 
 
 <li class="has-submenu"><a style="cursor:pointer;">

<svg  style="width: 24px !important;" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
	 viewBox="0 0 478.703 478.703" xml:space="preserve">
<g>
	<g>
		<path d="M454.2,189.101l-33.6-5.7c-3.5-11.3-8-22.2-13.5-32.6l19.8-27.7c8.4-11.8,7.1-27.9-3.2-38.1l-29.8-29.8
			c-5.6-5.6-13-8.7-20.9-8.7c-6.2,0-12.1,1.9-17.1,5.5l-27.8,19.8c-10.8-5.7-22.1-10.4-33.8-13.9l-5.6-33.2
			c-2.4-14.3-14.7-24.7-29.2-24.7h-42.1c-14.5,0-26.8,10.4-29.2,24.7l-5.8,34c-11.2,3.5-22.1,8.1-32.5,13.7l-27.5-19.8
			c-5-3.6-11-5.5-17.2-5.5c-7.9,0-15.4,3.1-20.9,8.7l-29.9,29.8c-10.2,10.2-11.6,26.3-3.2,38.1l20,28.1
			c-5.5,10.5-9.9,21.4-13.3,32.7l-33.2,5.6c-14.3,2.4-24.7,14.7-24.7,29.2v42.1c0,14.5,10.4,26.8,24.7,29.2l34,5.8
			c3.5,11.2,8.1,22.1,13.7,32.5l-19.7,27.4c-8.4,11.8-7.1,27.9,3.2,38.1l29.8,29.8c5.6,5.6,13,8.7,20.9,8.7c6.2,0,12.1-1.9,17.1-5.5
			l28.1-20c10.1,5.3,20.7,9.6,31.6,13l5.6,33.6c2.4,14.3,14.7,24.7,29.2,24.7h42.2c14.5,0,26.8-10.4,29.2-24.7l5.7-33.6
			c11.3-3.5,22.2-8,32.6-13.5l27.7,19.8c5,3.6,11,5.5,17.2,5.5l0,0c7.9,0,15.3-3.1,20.9-8.7l29.8-29.8c10.2-10.2,11.6-26.3,3.2-38.1
			l-19.8-27.8c5.5-10.5,10.1-21.4,13.5-32.6l33.6-5.6c14.3-2.4,24.7-14.7,24.7-29.2v-42.1
			C478.9,203.801,468.5,191.501,454.2,189.101z M451.9,260.401c0,1.3-0.9,2.4-2.2,2.6l-42,7c-5.3,0.9-9.5,4.8-10.8,9.9
			c-3.8,14.7-9.6,28.8-17.4,41.9c-2.7,4.6-2.5,10.3,0.6,14.7l24.7,34.8c0.7,1,0.6,2.5-0.3,3.4l-29.8,29.8c-0.7,0.7-1.4,0.8-1.9,0.8
			c-0.6,0-1.1-0.2-1.5-0.5l-34.7-24.7c-4.3-3.1-10.1-3.3-14.7-0.6c-13.1,7.8-27.2,13.6-41.9,17.4c-5.2,1.3-9.1,5.6-9.9,10.8l-7.1,42
			c-0.2,1.3-1.3,2.2-2.6,2.2h-42.1c-1.3,0-2.4-0.9-2.6-2.2l-7-42c-0.9-5.3-4.8-9.5-9.9-10.8c-14.3-3.7-28.1-9.4-41-16.8
			c-2.1-1.2-4.5-1.8-6.8-1.8c-2.7,0-5.5,0.8-7.8,2.5l-35,24.9c-0.5,0.3-1,0.5-1.5,0.5c-0.4,0-1.2-0.1-1.9-0.8l-29.8-29.8
			c-0.9-0.9-1-2.3-0.3-3.4l24.6-34.5c3.1-4.4,3.3-10.2,0.6-14.8c-7.8-13-13.8-27.1-17.6-41.8c-1.4-5.1-5.6-9-10.8-9.9l-42.3-7.2
			c-1.3-0.2-2.2-1.3-2.2-2.6v-42.1c0-1.3,0.9-2.4,2.2-2.6l41.7-7c5.3-0.9,9.6-4.8,10.9-10c3.7-14.7,9.4-28.9,17.1-42
			c2.7-4.6,2.4-10.3-0.7-14.6l-24.9-35c-0.7-1-0.6-2.5,0.3-3.4l29.8-29.8c0.7-0.7,1.4-0.8,1.9-0.8c0.6,0,1.1,0.2,1.5,0.5l34.5,24.6
			c4.4,3.1,10.2,3.3,14.8,0.6c13-7.8,27.1-13.8,41.8-17.6c5.1-1.4,9-5.6,9.9-10.8l7.2-42.3c0.2-1.3,1.3-2.2,2.6-2.2h42.1
			c1.3,0,2.4,0.9,2.6,2.2l7,41.7c0.9,5.3,4.8,9.6,10,10.9c15.1,3.8,29.5,9.7,42.9,17.6c4.6,2.7,10.3,2.5,14.7-0.6l34.5-24.8
			c0.5-0.3,1-0.5,1.5-0.5c0.4,0,1.2,0.1,1.9,0.8l29.8,29.8c0.9,0.9,1,2.3,0.3,3.4l-24.7,34.7c-3.1,4.3-3.3,10.1-0.6,14.7
			c7.8,13.1,13.6,27.2,17.4,41.9c1.3,5.2,5.6,9.1,10.8,9.9l42,7.1c1.3,0.2,2.2,1.3,2.2,2.6v42.1H451.9z"/>
		<path d="M239.4,136.001c-57,0-103.3,46.3-103.3,103.3s46.3,103.3,103.3,103.3s103.3-46.3,103.3-103.3S296.4,136.001,239.4,136.001
			z M239.4,315.601c-42.1,0-76.3-34.2-76.3-76.3s34.2-76.3,76.3-76.3s76.3,34.2,76.3,76.3S281.5,315.601,239.4,315.601z"/>
	</g>
</g>
</svg> 
 </a> 

						<ul class="submenu" style="left:44px;top: -280px;"> 
<div> 
						<li><a href="display.html?ga=commissiontype"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Agent Group</a></li>   
						<li><a href="display.html?ga=flightmarkup"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Flight Markup</a></li>   
						<li><a href="display.html?ga=domestichotelsmarkup"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Hotel Markup</a></li> 
						
						<hr />  
 
						<li><a href="display.html?ga=faretype"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Flight Fare Type</a></li>   
						<li><a href="display.html?ga=flightsname"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Flight Name & Logo</a></li>   
						<li><a href="display.html?ga=flightapisetting"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Flight API Setting</a></li>   
						<li><a href="display.html?ga=flightlogs"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Flight Logs</a></li>   
						
							<hr />  
							
							<li><a href="display.html?ga=pnrrecords"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> PNR Records</a></li>   
						<li><a href="display.html?ga=faremanagement"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Fare Management</a></li>  
						
							<hr /> 
 
						<li><a href="display.html?ga=visacountryterms"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Visa Country Terms</a></li>   
						<li><a href="display.html?ga=visatype"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Visa Type</a></li>   
						<li><a href="display.html?ga=visasubscription"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Visa Subscription</a></li> 
						
						<hr />   
						<li><a href="display.html?ga=currencyExchange"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Currency Exchange</a></li> 
 
</div> </ul></li>
                     </ul>



                     <!-- End navigation menu -->



                 </div>



                  <!-- end #navigation -->



               </div>



               <!-- end container -->



            </div>



            <!-- end navbar-custom -->



         </header> 



          



      </div>



	  <div class="alert alert-success bg-success text-white headersavealert" role="alert" style=" display:none; <?php if($_REQUEST['save']==3){ ?> display:block;<?php } ?>">Congratulations! Your itinerary has been successfully shared</div>



	  <div class="alert alert-success bg-success text-white headersavealert" role="alert" style=" display:none; <?php if($_REQUEST['save']==1){ ?> display:block;<?php } ?>">Successfully Save</div>



	  



	  <?php if($LoginUserDetails['fromName']=='' || $LoginUserDetails['emailAccount']=='' || $LoginUserDetails['emailPassword']=='' || $LoginUserDetails['smtpServer']=='' || $LoginUserDetails['emailPort']==''){ ?>



	  <div class="alert alert-success bg-success text-white" role="alert" style="display: block; background-color: #a7193a !important; margin-top: -58px; text-align: center; position: fixed; width: 100%; border-radius: 0px; padding-top: 22px; padding-bottom: 3px;">Please update mail setting! <a href="display.html?ga=mailsetting" style="color:#fff; text-decoration:underline;">Click Here</a></div>



	  <?php } ?>



	  



 