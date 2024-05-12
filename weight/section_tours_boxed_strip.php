<div class="offerrow">

        <div class="offerheading">

          <h3><?php echo stripslashes($clientwebsitesection['sectionName']); ?></h3>

        </div>

        <div class="row">



          <?php 
          $where = ''; 
          $p = 1; 
          $bb = GetPageRecord('*', 'sys_packageBuilder', '  showwebsite=1  and queryId=0 and grossPrice>0  order by rand() asc  limit 0,4   '); 
          while ($packagelist = mysqli_fetch_array($bb)) {  
			 
          ?>

                <div class="col-lg-3">

                  <div class="holidestibox phoneholibox" style="margin-top:0px; ">

                    <div class="card" style="margin-top:0px; overflow:hidden; position:relative;">

                      <div class="holiimg">

                        <a target="_blank" href="<?php echo $fullurl; ?>view-package?i=<?php echo encode($packagelist['id']); ?>&name=<?php echo  (stripslashes($packagelist['name'])); ?>"><img src="<?php echo $packagephotourl; ?><?php echo $packagelist['coverPhoto']; ?>" class="img-fluid" alt="<?php echo stripslashes($packagelist['name']); ?>"></a>

                      </div>

                      <div class="card-body" style="background-color: #000000ad; position: absolute; bottom: 0px; width: 100%; text-align: center; z-index: 1;">

                        <h5 class="card-title"><a target="_blank" href="<?php echo $fullurl; ?>view-package?i=<?php echo encode($packagelist['id']); ?>&name=<?php echo  (stripslashes($packagelist['name'])); ?>" style="color:#fff; font-weight: 600; font-size: 18px; margin-bottom: 6px !important;"><?php echo stripslashes($packagelist['name']); ?></a></h5>

                        <p><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo ($packagelist['days']-1); ?> Nights / <?php echo $packagelist['days']; ?> Days</p>

                        <div class="holipricing">

                          <p><a href="" style="color: #fff;"><?php echo convertfromtocurrencywithcurr('INR',$_SESSION['currency'],$packagelist['grossPrice']); ?></a></p>

                           

                        </div>

                      </div>


                    </div>

                  </div>

                </div>



          <?php $p++;  }  ?>







        </div>

      </div>