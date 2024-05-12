<aside class="careerfy-column-3" id="leftclientsection" style="min-height:700px;">
<div class="careerfy-typo-wrap">
<div class="careerfy-employer-dashboard-nav">
<figure>
<a href="#" class="employer-dashboard-thumb"><?php if($userinfo['profilePhoto']==''){ ?><img src="images/nouserimg.png" alt=""><?php }else{ ?><img src="images/profileImg/<?php echo $userinfo['profilePhoto']; ?>" alt="" style="width: 134px; height: 134px;"><?php } ?></a>
<figcaption> 
<?php if($pagenoedit==3){ ?>
<div class="careerfy-fileUpload">
<span><i class="careerfy-icon careerfy-add"></i> Upload Photo</span>
<form method="post" action="action.html" id="postdata" target="datapost" enctype="multipart/form-data">
<input type="file" class="careerfy-upload" name="profileimg" onchange="$('#postdata').submit();" />
<input type="hidden" name="action" value="uploadphoto" />
</form>
</div>
<?php } ?>
<span class="careerfy-dashboard-subtitle"><strong><?php echo $userinfo['submitName']; ?> <?php echo $userinfo['firstName'].' '.$userinfo['lastName']; ?></strong></span>
</figcaption>
 </figure>
<ul>
 
<li <?php if($pageno==1){ ?> class="active" <?php } ?>><a href="<?php echo $fullurl; ?>">My Trips</a></li>
<li <?php if($pageno==2){ ?> class="active" <?php } ?>><a href="payment.html">Payment History</a></li>
<li <?php if($pageno==4){ ?> class="active" <?php } ?>><a href="chathistory.html">Chat History</a></li> 
<li <?php if($pageno==3){ ?> class="active" <?php } ?>><a href="profile.html">My Profile</a></li> 
<li><a href="logout.html">Logout</a></li> 

 
</ul>
</div>
</div>
</aside>