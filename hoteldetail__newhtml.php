<?php include "inc.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
   <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
   <title>Hotel - <?php echo $portalname; ?></title>

   <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" href="css/main.css">
   <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
   <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
   <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css">
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" integrity="sha512-+EoPw+Fiwh6eSeRK7zwIKG2MA8i3rV/DGa3tdttQGgWyatG/SkncT53KHQaS5Jh9MNOT3dmFL0FjTY08And/Cw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<?php include "headerinc.php"; ?> 

<style>
   #bodyaria{padding:68px 0px 0px 0px;}
   .webcontenor{ max-width:1200px; margin:auto;}
</style>
</head>

<body>
<?php include "header.php"; ?>
  
   <div id="bodyaria" class="innersearchbody">

      <div class="webcontenor">
         <div class="hotelnameflex">
            <div>
               <h3>Nova Inn</h3>
               <div class="staricons"><span>Hotels</span> <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>
               </div>
               <p><i class="fa fa-map-marker" aria-hidden="true"></i> Pari Chowk Rd, Delhi, India, 273001</p>
            </div>

            <div class="rightpricediv">
               <p>Price/room/night starts from</p>
               <h6>₹ 1504</h6>
               <a href="#" class="roomselectbtn"><button type="button" class="btn btn-danger">Select Room</button></a>
            </div>
         </div>

         <div class="galleryview">
            <div class="row gallerys">

               <div class="col-lg-8">
                  <div class="leftfullimg">
                    <a href="https://wallpapercave.com/wp/wp38684.jpg">
                    <img src="https://wallpapercave.com/wp/wp38684.jpg" alt="">
                    </a>
                  </div>
               </div>

               <div class="col-lg-4 rightview">
                  <div class="row">
                     <div class="col-lg-6">
                        <div class="fixheightimg">
                           <a href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRVyEQYs6u18I8NInCKXVOFd2RVzEXjGf3h2g&usqp=CAU">
                           <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRVyEQYs6u18I8NInCKXVOFd2RVzEXjGf3h2g&usqp=CAU" alt="">
                           </a>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="fixheightimg">
                          <a href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTeQ0PtoyHW261-DEvmltJ2ugE27zgOS9y5YQ&usqp=CAU">
                          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTeQ0PtoyHW261-DEvmltJ2ugE27zgOS9y5YQ&usqp=CAU" alt="">
                          </a>
                     </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="fixheightimg">
                          <a href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRMJ6eWTiOmv9DOYbZVG1OpfQYdy1wEH5L-kQ&usqp=CAU">
                          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRMJ6eWTiOmv9DOYbZVG1OpfQYdy1wEH5L-kQ&usqp=CAU" alt="">
                          </a>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="fixheightimg">
                           <a href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSuUI0wEKMdkysIIuqibPDgjW4BngRkXAyjxA&usqp=CAU">
                           <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSuUI0wEKMdkysIIuqibPDgjW4BngRkXAyjxA&usqp=CAU" alt="">
                           </a>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="fixheightimg">
                           <a href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRHvvk4IR-x_g9VYXLQJUtSbhdM6J5zFVuC-Q&usqp=CAU">
                           <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRHvvk4IR-x_g9VYXLQJUtSbhdM6J5zFVuC-Q&usqp=CAU" alt="">
                           </a>
                        </div>
                     </div>
                     <div class="col-lg-6 seemorephoto">
                        <div class="fixheightimg">
                           <a href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQrjNq-loS5c7Ci2wX06IXhKmlUm-5a6JF6Qg&usqp=CAU">
                           <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQrjNq-loS5c7Ci2wX06IXhKmlUm-5a6JF6Qg&usqp=CAU" alt="">
                        </a>
                        </div>
                     </div>
                  </div>
               </div>

            </div>
         </div><!-- galleryview  -->

         <div class="accomadationcard">
            <div class="seemoreflex">
               <h6>About Accommodation</h6>
               <p>See more <i class="fa fa-angle-right" aria-hidden="true"></i></p>
            </div>
            <p class="roomdetails">Nova Inn is a hotel in a good neighborhood, which is located at Gorakhpur. 24-hours front desk is available to serve you, from check-in to check-out, or any assistance you need. Should you desire more, do not hesitate to ask the front desk, we are always ready to accommodate you.</p>
         </div>

         <div class="accomadationcard">
            <div class="seemoreflex">
               <h6>Main Facilities</h6>
               <p>See more <i class="fa fa-angle-right" aria-hidden="true"></i></p>
            </div>
            <div class="facflex">
               <div><img src="images/24i.png" alt=""> 24-Hour Front Desk</div>
               <div><img src="images/wifi.png" alt=""> WiFi</div>
            </div>
         </div>


         <section>
            <div class="roomcontentlist">
               <h4>Available Room Types in Nova Inn</h4>


               <div class="row roomslistbox">
                  <div class="col-lg-3">
                     <div class="detailsleftcard card">
                        <div class="showdetailroom">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSTLY0NoB8g907LCyrw0n_7SZj62lPH8W_n5Q&usqp=CAU" class="card-img-top" alt="...">
                        </div>
                        <div class="card-body">
                         <p>Shower</p>
                         <p>Air Conditioning</p>
                         <button type="button" class="btn btn-light">See Room Details</button>
                        </div>
                     </div>
                  </div>


                  <div class="col-lg-9 deluxerooms">
                     <div class="rightinfocard card">
                        <h6>Deluxe Room</h6>

                        <table class="guestroomtable">
                           <tr>
                              <td style="width: 30%;"><img src="images/twin.svg" alt=""> 1 Twin Bed</td>
                              <td style="width: 30%;"><img src="images/guest.svg" alt=""> 1 guest</td>
                              <td style="text-align: right;"><span>(1 room(s) available)</span></td>
                           </tr>
                        </table>

                        <table class="bookpricetable">
                           <tr>
                              <td>
                                 <div><i class="fa fa-cutlery" aria-hidden="true"></i> Without Breakfast</div>
                                 <div class="green"><i class="fa fa-wifi" aria-hidden="true"></i> Free WiFi</div>
                                 <div class="green"><i class="fa fa-ban" aria-hidden="true"></i> Non-smoking</div>
                              </td>
                          
                              <td>
                                 <div><i class="fa fa-times-circle-o" aria-hidden="true"></i> Non-refundable</div>
                                 <div><i class="fa fa-times-circle-o" aria-hidden="true"></i> Non-refundable</div>
                                 <div class="blue"><i class="fa fa-book" aria-hidden="true"></i> Read Cancellation Policy</div>
                              </td>

                              <td class="lasttdprice" style="text-align: right;">
                                 <div class="linethroug">₹ 840</div>
                                 <div class="mainprice">₹ 3456</div>
                                 <div style="font-size: 13px;">/  room /  night(s)</div>
                                 <div style="font-size: 13px;">Inclusive of Taxes</div>
                                 <div><a href="#" class="roomselectbtn2"><button type="button" class="btn btn-danger">Book Now</button></a></div>
                              </td>
                           </tr>
                        </table>

                        <div class="borderline"></div>

                        <div class="green savepercent"><i class="fa fa-percent" aria-hidden="true"></i> Private sale: save 10%</div>
                     </div>
                  </div>
               </div><!-- roomslistbox  -->


               <div class="row roomslistbox">
                  <div class="col-lg-3">
                     <div class="detailsleftcard card">
                        <div class="showdetailroom">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRp9p5UQHE6FiUAuLe6ZyJ1JUXRby-2sDRGtA&usqp=CAU" class="card-img-top" alt="...">
                        </div>
                        <div class="card-body">
                         <p>Shower</p>
                         <p>Air Conditioning</p>
                         <button type="button" class="btn btn-light">See Room Details</button>
                        </div>
                     </div>
                  </div>


                  <div class="col-lg-9 deluxerooms">
                     <div class="rightinfocard card">
                        <h6>Deluxe Room</h6>

                        <table class="guestroomtable">
                           <tr>
                              <td style="width: 30%;"><img src="images/twin.svg" alt=""> 1 Twin Bed</td>
                              <td style="width: 30%;"><img src="images/guest.svg" alt=""> 1 guest</td>
                              <td style="text-align: right;"><span>(1 room(s) available)</span></td>
                           </tr>
                        </table>

                        <table class="bookpricetable">
                           <tr>
                              <td>
                                 <div><i class="fa fa-cutlery" aria-hidden="true"></i> Without Breakfast</div>
                                 <div class="green"><i class="fa fa-wifi" aria-hidden="true"></i> Free WiFi</div>
                                 <div class="green"><i class="fa fa-ban" aria-hidden="true"></i> Non-smoking</div>
                              </td>
                          
                              <td>
                                 <div><i class="fa fa-times-circle-o" aria-hidden="true"></i> Non-refundable</div>
                                 <div><i class="fa fa-times-circle-o" aria-hidden="true"></i> Non-refundable</div>
                                 <div class="blue"><i class="fa fa-book" aria-hidden="true"></i> Read Cancellation Policy</div>
                              </td>

                              <td class="lasttdprice" style="text-align: right;">
                                 <div class="linethroug">₹ 840</div>
                                 <div class="mainprice">₹ 3456</div>
                                 <div style="font-size: 13px;">/  room /  night(s)</div>
                                 <div style="font-size: 13px;">Inclusive of Taxes</div>
                                 <div><a href="#" class="roomselectbtn2"><button type="button" class="btn btn-danger">Book Now</button></a></div>
                              </td>
                           </tr>
                        </table>

                        <div class="borderline"></div>

                        <div class="green savepercent"><i class="fa fa-percent" aria-hidden="true"></i> Private sale: save 10%</div>
                     </div>
                  </div>
               </div><!-- roomslistbox  -->



               <div class="row roomslistbox">
                  <div class="col-lg-3">
                     <div class="detailsleftcard card">
                        <div class="showdetailroom">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQOUF7SgK2i-TCvenmKSi-gJODE-A2RE6nCMg&usqp=CAU" class="card-img-top" alt="...">
                        </div>
                        <div class="card-body">
                         <p>Shower</p>
                         <p>Air Conditioning</p>
                         <button type="button" class="btn btn-light">See Room Details</button>
                        </div>
                     </div>
                  </div>


                  <div class="col-lg-9 deluxerooms">
                     <div class="rightinfocard card">
                        <h6>Deluxe Room</h6>

                        <table class="guestroomtable">
                           <tr>
                              <td style="width: 30%;"><img src="images/twin.svg" alt=""> 1 Twin Bed</td>
                              <td style="width: 30%;"><img src="images/guest.svg" alt=""> 1 guest</td>
                              <td style="text-align: right;"><span>(1 room(s) available)</span></td>
                           </tr>
                        </table>

                        <table class="bookpricetable">
                           <tr>
                              <td>
                                 <div><i class="fa fa-cutlery" aria-hidden="true"></i> Without Breakfast</div>
                                 <div class="green"><i class="fa fa-wifi" aria-hidden="true"></i> Free WiFi</div>
                                 <div class="green"><i class="fa fa-ban" aria-hidden="true"></i> Non-smoking</div>
                              </td>
                          
                              <td>
                                 <div><i class="fa fa-times-circle-o" aria-hidden="true"></i> Non-refundable</div>
                                 <div><i class="fa fa-times-circle-o" aria-hidden="true"></i> Non-refundable</div>
                                 <div class="blue"><i class="fa fa-book" aria-hidden="true"></i> Read Cancellation Policy</div>
                              </td>

                              <td class="lasttdprice" style="text-align: right;">
                                 <div class="linethroug">₹ 840</div>
                                 <div class="mainprice">₹ 3456</div>
                                 <div style="font-size: 13px;">/  room /  night(s)</div>
                                 <div style="font-size: 13px;">Inclusive of Taxes</div>
                                 <div><a href="#" class="roomselectbtn2"><button type="button" class="btn btn-danger">Book Now</button></a></div>
                              </td>
                           </tr>
                        </table>

                        <div class="borderline"></div>

                        <div class="green savepercent"><i class="fa fa-percent" aria-hidden="true"></i> Private sale: save 10%</div>
                     </div>
                  </div>
               </div><!-- roomslistbox  -->



            </div><!-- roomcontentlist  -->

            <div class="dealscardblue">
               <div class="flexdealsdiv">
                  <div><h6>You can get better deals for your stay!</h6> <p>Other travelers have secured lower prices on our app. Now it’s your turn!</p></div>
                  <div><button type="button" class="btn btn-light">Open app</button></div>
               </div>
               <img class="dealsstayimg" src="images/deals1.svg" alt="">
            </div>
      </div><!-- webcontenor  -->

   </div>



 
   <script>
      function getSearchCityHotel(citysearchfield, cityresultfield, listsearch) {
         var citysearchfieldval = encodeURI($('#' + citysearchfield).val());
         var citysearchfield = citysearchfield;

         if (citysearchfieldval != '') {
            $('#' + listsearch).show();
            $('#' + listsearch).load('searchcitylistshotel.php?keyword=' + citysearchfieldval + '&searchcitylists=' + listsearch + '&cityresultfield=' + cityresultfield + '&citysearchfield=' + citysearchfield);
         }
      }



      $(document).ready(function() {
         $("#dt1").datepicker({
            dateFormat: "dd-mm-yy",
            minDate: 0,
            onSelect: function() {
               var dt2 = $('#dt2');
               var startDate = $(this).datepicker('getDate');
               //add 30 days to selected date
               startDate.setDate(startDate.getDate() + 30);
               var minDate = $(this).datepicker('getDate');
               var dt2Date = dt2.datepicker('getDate');
               //difference in days. 86400 seconds in day, 1000 ms in second
               var dateDiff = (dt2Date - minDate) / (86400 * 1000);

               //dt2 not set or dt1 date is greater than dt2 date
               if (dt2Date == null || dateDiff < 0) {
                  dt2.datepicker('setDate', minDate);
               }
               //dt1 date is 30 days under dt2 date
               else if (dateDiff > 30) {
                  dt2.datepicker('setDate', startDate);
               }
               //sets dt2 maxDate to the last day of 30 days window
               dt2.datepicker('option', 'maxDate', startDate);
               //first day which can be selected in dt2 is selected date in dt1
               dt2.datepicker('option', 'minDate', minDate);
            }
         });
         $('#dt2').datepicker({
            dateFormat: "dd-mm-yy",
            minDate: 0,
            onSelect: function() {}
         });

      });



      function gettotalpax() {

         var totalpax = 0;
         $('.pax').each(function(i, obj) {
            totalpax = Number(totalpax + Number($(obj).val()));
         });
         $('#totalpax').val(totalpax);


         var empcount = $('#empcount').val();
         $('#travellersshow').val('' + empcount + ' Room - ' + totalpax + ' Guest');
      }





      function addEmpInfo() {
         var empcount = $('#empcount').val();

         empcount = Number(empcount) + 1;
         $.get("loadchild.php?id=" + empcount, function(data) {
            $("#loademployee").append(data);
         });

         var totalpax = $('#totalpax').val();
         $('#empcount').val(empcount);
         $('#travellersshow').val('' + empcount + ' Room - ' + totalpax + ' Guest');
      }



      function removeEmpInfo(id) {
         $('#empInfoId' + id).remove();
         var empcount = $('#empcount').val();
         empcount = Number(empcount) - 1;
         var totalpax = $('#totalpax').val();
         $('#empcount').val(empcount);
         $('#travellersshow').val('' + empcount + ' Room - ' + totalpax + ' Guest');
      }



      function combinecheckbox() {
         var combinecheck = '';
         var output = jQuery.map($(':checkbox[name=category\\[\\]]:checked'), function(n, i) {
            combinecheck = combinecheck + n.value + ',';
         }).join(',');

         $('#starcategory').val(rtrim(combinecheck) + ' Star');
      }

      function rtrim(str) {
         return str.replace(/\s+$/, '');
      }

      function openclosebox(id) {

         var getdisplay = $('#' + id + ' .whitecardbody').css('display');
         $('#' + id + ' .whitecardheader .fa').removeClass('fa-angle-down');

         if (getdisplay == 'none') {
            $('#' + id + ' .whitecardbody').slideDown();
            $('#' + id + ' .whitecardheader .fa').addClass('fa-angle-up');
         } else {
            $('#' + id + ' .whitecardbody').slideUp();
            $('#' + id + ' .whitecardheader .fa').addClass('fa-angle-down');
         }

      }
   </script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js" integrity="sha512-IsNh5E3eYy3tr/JiX2Yx4vsCujtkhwl7SLqgnwLNgf04Hrt9BT9SXlLlZlWx+OK4ndzAoALhsMNcCmkggjZB1w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   <script>
      $(document).ready(function(){
         $(".gallerys").magnificPopup({
            type:'image',
            delegate:'a',
            gallery:{
               enabled:true
            }
         });
      });
   </script>


<?php include "footerinc.php"; ?>
<?php include "footer.php"; ?>


</body>

</html>