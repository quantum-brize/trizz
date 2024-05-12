<div class="offerrow">

        <div class="offerheading">

          <h3><?php echo stripslashes($clientwebsitesection['sectionName']); ?></h3>

        </div>
        <div class="row" style="padding-left: 3px;padding-right: 3px;">

      <?php
               $dm = GetPageRecord('*', 'websiteDestination', 'name in (SELECT destinations FROM sys_packageBuilder WHERE showwebsite=1  and showinPopular=1 )  order by rand() limit 6');
               while ($destinationMaster = mysqli_fetch_array($dm)) {
               ?>
 

                <div class="col-lg-2" style="margin-bottom:10px;">

                  <div class="card" style="border-radius: 20px !important; overflow: hidden; box-shadow: 0px 10px 18px #29426917 !important;margin-top: 0px;border: 0px;">

                    <a href="holidays-search?holidaysdestination=<?php echo stripslashes($destinationMaster["name"]); ?>&Submit=SEARCH&action=flightpostaction&changesearch=0">

                      <div class="mobedit1" style="border-radius: 20px; height:200px; object-fit: cover; margin-right:10px; overflow:hidden;border-radius: 5px;margin-right: 10px; margin-top: 0px !important; margin: 5px;"><img src="<?php echo $packagephotourl; ?><?php echo stripslashes($destinationMaster['photo']); ?>" style="width:100%; height:100%; border-radius: 20px !important;"></div>

                      <table width="100%" border="0" cellpadding="0" cellspacing="0"> 
                        <tbody> 

                          <tr> 

                            <td width="90%" style="font-size: 13px;padding-left: 10px; font-weight: 700;color:#000 !important; text-align:center; padding:0px 0px 5px;"><?php echo stripslashes($destinationMaster["name"]); ?></td>
                          </tr>
                        </tbody>
                      </table>

                    </a>

                  </div>

                </div>

          <?php } ?> 
        </div>
      </div>