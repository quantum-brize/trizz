
      <div class="row offerrow">

<?php

$rsa = GetPageRecord('*', 'cmsPages', 'url="home_testimonial_background"');
$testicontent = mysqli_fetch_array($rsa);
?>

        <div class="card-body testibg" style="background-image:url(<?php echo $packagephotourl; ?><?php echo $testicontent['photo']; ?>)">
          <div class="heading"><?php echo stripslashes($clientwebsitesection['sectionName']); ?></div>
          <div class="text"><?php echo strip_tags(stripslashes($testicontent['description'])); ?></div>
          <div class="row offerboxes testimonials">
            <?php
            $a = GetPageRecord('*', 'websiteTestimonials', '  status=1 order by id desc');
            while ($spdeals = mysqli_fetch_array($a)) {
            ?>
              <div class="multiple">
                <div class="col-lg-12 d-flex align-items-stretch">
                  <div class="card" style="width:100%; margin-top:0px;  border-radius: 20px !important;">
                    <div style="padding: 10px 20px; text-align: left; font-size: 14px; font-weight: 500; min-height: 100px;">
                      <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td>
                            <div style="text-align:center; width:40px;"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAABmJLR0QA/wD/AP+gvaeTAAAE3ElEQVR4nO2aW2wUVRjHf2dmdre723ZrTEUUgsQoBjVGEQWEoBJtxBAfNIuEQhCMmEITMUSiLzQ+EOMFlEr0wUAx1MvSojHygEbbLkZNFBMe6gU0oCUGC6FbWnrbnT2+uKZXZnb3m22j+3ud7/z6nX9mp+fMGShSpEiR/zGq4H8x9tUcjNT9aHUNSs/gj18XYxhnMY0z+EJ7eTr6eSHbKUwA+1pKKDU2o9gA3DTi2k8/jKz1BwYJho4QCK1lY7Tb69a8D6CpLQq8Cswc9/roADJY/hSRyC5qqp/zrDe8DEBrRVN8O4rtl62bKIAM5RXH6LpuAXX3pQS7+xfDCylaK5qP7necvBsuJuYR+e1nga7GxZsAmuMvgF4j5uvtuZ76/YfFfMOQDyDWuhB4UdybuLCcPY3rpLXyARjGDk+8AH09r0srZRs91PoA6HtFncMZ6I9Q37hVUikbQFqtFPWNR2pgvaROLoA6bQAPi/kmor9vDnUtlpROLoBbv5wJXC3mmwg7ZTC9Y56UTvAnYEyXczmQ9N0spZIM4Co5lxPJ2VImuQDS6YtiLicMq1NMJSXCtP4UczmRTv8opZILIGV2AINivolQBiSTx6R0cgFEF/UDX4j5JiIYOsuWJxJSOuElq/5Y1jcO/pIjkjrhlaD/AHBG1Dkcy2fjr5jCS+Hoon7Q8jvBDKWRBjauOC+plN+1pTv3opF/sRkMn2daoEZaKx9ANGozZKwETog5fYEhzLL5RKNDYs5/8GbfvnpJFyr1IOjjebsCJf2Uly9ly6rTAp2NwZsAAB5d9jtpvRilP8jZES4/TcmVs6ip/lawsxEU5lzgYOsSlHoZWDDm2nhvhQPBHkJl29i8+i2vWyvsyVAsPheTR9B6GXAtMIMTx8MYviSW0Yvf/x1WST01qzx5AVqkyFgm4XA0XgnMxrTLQZXxV8fdaH2BtDqHP/gNGx/z7BBkPLwNIBYzsaYtRatloO9BcwdQNqJm9EPQNDW+QDc+fzs+fzOVvj1e/P/P4E0AsfhcDF0DRIHKy9Y6nQ2aVppguJ1A8HkvHo6yATS13Y5WO1C6yrXbKYDhlITPEQrVsqn6w9waHItMAI1HryBg7wS1lmwXV9kEkKE0chKrtIra6KnsB48k/5VgU7yKQLod1DoRnxt6u2/gUudJ3mzclq8qv4YPtm0FfRgo3CvxDMmkSVfnS+xu+CQfTW4BaK1oat2J4hXAzKeBvOnuWsGufd+jdU5zyS2A5rbXQG3JaawX9Cbm8UZDThum7AM4GH9ySk0+Q09iPvUN72c7LLsAYvG7UNrzHVrOJBKPU/9edTZD3AcQ+zqIofcDYiez8mjoS7zDgQPlbke4D8BMPcPob/ymIkODAbrsRrfl7hZCH7VUYBungIpc+5qQXBZCTpiWJhKexab1HU6l7u6AtLEBLybvFXZKkbZ2uyl1F4DmqbwamgwuXVrupsw5gEMttwA35ttPwUkO+Hn7XccQnAPQRpVIQ5PBoHa8c138BPSdEr1MCnbyNqcSF3eAEvsep+CkktOcStw8BL3/8ssr7FTAqcRNAK5XVVMO23acn5sALgi0MjmYlu1U4hyAUvUizUwG4bLPnErcLYWb2qKgH0IZ4bybGs2pXxaKO02zH8v3KbVrnhV3FylSpMh/ib8BqZhDAoHwIzkAAAAASUVORK5CYII=" style="width:100%;"></div>
                          </td>
                          <td width="99%" style="padding-left:10px; text-align:left;">
                            <div style="font-weight:700;font-size: 15px;color: #000;"><?php echo stripslashes($spdeals['name']); ?><br>
                              <span class="starcatht" style="font-size:18px; color:#FF9900;"><?php for ($i = 1; $i <= $spdeals['starRating']; $i++) { ?>
                                  <i class="fa fa-star" aria-hidden="true"></i>
                                <?php } ?></span>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="2" style="padding-top:10px; border-top:1px solid #ddd;"><i><?php echo stripslashes($spdeals['description']); ?></i></td>
                        </tr>
                      </table>
                    </div>






                  </div>
                </div>
              </div>

            <?php } ?>

          </div>
        </div>

      </div>
      <style>
        .testimonials .slick-arrow {
          display: none !important;
        }

        .multiple {
          padding: 0px 10px;
        }
      </style>

