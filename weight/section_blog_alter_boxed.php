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

          <div class="col-lg-6">
            <?php
            $a = GetPageRecord('*', 'websiteBlog', ' status=1  order by rand() limit 0,1');
            while ($spdeals = mysqli_fetch_array($a)) {
              $lastid = $spdeals['id'];
            ?>
              <div class="col-lg-12" style="cursor:pointer; margin-bottom:20px;">
                <a href="<?php echo $fullurl; ?>post-view?id=<?php echo encode($spdeals['id']); ?>&t=<?php echo seo_friendly_url(stripslashes($spdeals['name'])); ?>">

                  <div class="offerphotobox2" style="margin-right:0px; width:100%; height:350px;">
                    <img src="<?php echo $blogphoto; ?><?php echo $spdeals['photo']; ?>" style=" height:100%; min-width:100%;">
                  </div>

                  <div class="offerboxheading" style="color:#333333; font-size:16px; font-weight:800; padding-top:20px;"><?php echo stripslashes($spdeals['name']); ?>

                    <div style="font-size:13px; font-weight:500;"><?php echo substr(strip_tags(str_replace('/scgtest/team-explore/', '' . $agentlogin . 'scgtest/team-explore/', stripslashes($spdeals['description']))), 0, 250); ?>...</div>
                  </div>






                </a>
              </div>

            <?php } ?>
          </div>


          <div class="col-lg-6">

            <div class="row">
              <?php
              $a = GetPageRecord('*', 'websiteBlog', ' status=1 and id!="' . $lastid . '" order by rand() limit 0,3');
              while ($spdeals = mysqli_fetch_array($a)) {
              ?>
                <div class="col-lg-12" style="cursor:pointer; margin-bottom:20px;">
                  <a href="<?php echo $fullurl; ?>post-view?id=<?php echo encode($spdeals['id']); ?>&t=<?php echo seo_friendly_url(stripslashes($spdeals['name'])); ?>">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td colspan="2">
                          <div class="offerphotobox2">
                            <img src="<?php echo $blogphoto; ?><?php echo $spdeals['photo']; ?>" style=" height:100%; min-width:100%;">
                          </div>
                        </td>
                        <td width="70%" class="offerboxheading" style="color:#333333; font-size:16px; font-weight:800;"><?php echo stripslashes($spdeals['name']); ?>

                          <div style="font-size:13px; font-weight:500;"><?php echo substr(strip_tags(str_replace('/scgtest/team-explore/', '' . $agentlogin . 'scgtest/team-explore/', stripslashes($spdeals['description']))), 0, 100); ?>...</div>
                        </td>
                      </tr>
                    </table>





                  </a>
                </div>

              <?php } ?>
            </div>


          </div>




        </div>
      </div>