<?php if($_SESSION['userid']==1){ } else { echo 'You dont have permission to view this page.'; exit(); }?>	
	
	<style>
.newboxheading{padding-left: 296px;}
.settingleftsection { width: 220px; position: fixed; left: 64px; top: 0px; height: 100%; z-index: 99; border-right: 1px solid #E5EBEF; background: #f9fbfc; overflow:auto; }
body{background-color:#FFFFFF !important; background-image:none !important;}
html{background-image:none !important;background-color:#FFFFFF !important;}
.col-xl-12{padding-left: 0px; padding-right: 0px;}
.settingleftsection .lmenu { padding-top: 56px; }
.settingleftsection .lmenu ul{list-style:none; padding:0px; margin:0px;}
.settingleftsection .lmenu ul li a{ padding:10px 15px; display:block; font-size:15px; color:#333333;}
.settingleftsection .lmenu h5{padding-left:15px;}
.settingleftsection .lmenu ul li .active{color: #1980d8; background-color: #D9EFFF;}
.settingleftsection .lmenu ul li a .fa{margin-right: 5px;}
.settingleftsection .lmenu ul li a:hover{ background-color:#f1f1f1;}
</style>
<div class="settingleftsection">
<div class="lmenu">
<h5>Settings</h5>

<ul>
<li><a href="display.html?ga=team" <?php if($_REQUEST['ga']=='team'){ ?>class="active"<?php } ?>><i class="fa fa-user" aria-hidden="true"></i> Team Management</a></li> 
<li><a href="display.html?ga=setting" <?php if($_REQUEST['ga']=='setting'){ ?>class="active"<?php } ?>><i class="fa fa-building-o" aria-hidden="true"></i> Organisation Settings</a></li>  
<li><a href="display.html?ga=defaultsettings"  <?php if($_REQUEST['ga']=='defaultsettings'){ ?>class="active"<?php } ?> ><i class="fa fa-sliders" aria-hidden="true"></i> Default Settings</a></li>  
 
<li><a href="display.html?ga=adminsetting" <?php if($_REQUEST['ga']=='adminsetting'){ ?>class="active"<?php } ?>><i class="fa fa-cog" aria-hidden="true"></i> Admin Settings</a></li>  
<li><a href="display.html?ga=inclusions"   <?php if($_REQUEST['ga']=='inclusions'){ ?>class="active"<?php } ?>><i class="fa fa-check" aria-hidden="true"></i> Package Inclusions</a></li>  
<li><a href="display.html?ga=automation" <?php if($_REQUEST['ga']=='automation'){ ?>class="active"<?php } ?>><i class="fa fa-retweet" aria-hidden="true"></i> Automation</a></li>  
<li><a href="display.html?ga=branches" <?php if($_REQUEST['ga']=='branches'){ ?>class="active"<?php } ?>><i class="fa fa-home" aria-hidden="true"></i> Branch Setting</a></li>   
<li><a href="display.html?ga=roles" <?php if($_REQUEST['ga']=='roles'){ ?>class="active"<?php } ?>><i class="fa fa-user-circle-o" aria-hidden="true"></i> Roles</a></li>  

</ul>
</div>

</div>
	
	<div style="width:220px;"></div>