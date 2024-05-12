<div class="offerrow">
<?php

//$rsa = GetPageRecord('*', 'sys_contentPages', 'id=8');
//$testicontent = mysqli_fetch_array($rsa);
?>
        <div class="offerheading" style="text-align:center; font-weight:500; font-size:14px; margin-bottom:20px;">

          <h3 style="margin-bottom:20px;"><?php echo stripslashes($clientwebsitesection['sectionName']); ?></h3>
          <div class="content70"><?php echo strip_tags(stripslashes($testicontent['description'])); ?>
          </div>
        </div>

        <div class="row offerboxes" style="margin:30px 0px;">

           


          <div class="col-lg-12">

            <div class="row">
              <?php
              $a = GetPageRecord('*', 'websiteBlog', ' status=1   order by rand() limit 0,4');
              while ($spdeals = mysqli_fetch_array($a)) {
              ?>
                <div class="col-lg-3" style="cursor:pointer; margin-bottom:20px;">
                  <a href="<?php echo $fullurl; ?>post-view?id=<?php echo encode($spdeals['id']); ?>&t=<?php echo seo_friendly_url(stripslashes($spdeals['name'])); ?>">
				    <div class="offerphotobox2" style="height: 252px; overflow: hidden; border-radius: 10px; width: 100%; margin-bottom:10px;">
                            <img src="<?php echo $blogphoto; ?><?php echo $spdeals['photo']; ?>" style=" height:100%; min-width:100%;">
                          </div>
						  <div style="color:#333333; font-size:16px; font-weight:800;"><?php echo stripslashes($spdeals['name']); ?></div><div style="font-size:13px; font-weight:500; color:#333333;"><?php echo substr(strip_tags(str_replace('/scgtest/team-explore/', '' . $agentlogin . 'scgtest/team-explore/', stripslashes($spdeals['description']))), 0, 100); ?>...</div>
				  
                     





                  </a>
                </div>

              <?php } ?>
            </div>


          </div>




        </div>
      </div>