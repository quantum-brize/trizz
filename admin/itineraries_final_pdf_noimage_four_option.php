<?php 
$abcd=GetPageRecord('*','sys_packageBuilder','id="'.decode($_REQUEST['id']).'"'); 
$result=mysqli_fetch_array($abcd);  

$rs=GetPageRecord($select,'sys_userMaster','id in (select addedBy from sys_userMaster where id="'.$result['addedBy'].'") '); 
$invoicedataa=mysqli_fetch_array($rs);


$n=1;
$begin = new DateTime( $result['startDate'] );
$end   = new DateTime( $result['endDate'] );
 
$rs1=GetPageRecord('*','queryMaster','id="'.$result['queryId'].'"');   
$querydata=mysqli_fetch_array($rs1); 

$a=GetPageRecord('*','sys_packageBuilderEvent','packageId="'.$result['id'].'" and sectionType="Flight"');   
$getflight=mysqli_fetch_array($a); 

$a=GetPageRecord('*','sys_packageBuilderEvent','packageId="'.$result['id'].'" and sectionType="Activity"');   
$getActivity=mysqli_fetch_array($a); 

$a=GetPageRecord('*','sys_packageBuilderEvent','packageId="'.$result['id'].'" and sectionType="Accommodation"');   
$getHotel=mysqli_fetch_array($a); 

$a=GetPageRecord('*','sys_packageBuilderEvent','packageId="'.$result['id'].'" and (sectionType="Transportation")');   
$gettransport=mysqli_fetch_array($a); 

$a=GetPageRecord('*','sys_packageBuilderEvent','packageId="'.$result['id'].'" and sectionType="Meal"');   
$getmeal=mysqli_fetch_array($a); 

$rs=GetPageRecord($select,'sys_userMaster','id="'.$result['addedBy'].'" '); 
$packagecreator=mysqli_fetch_array($rs);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>

</head>
<body  style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">
    
    <div class="box1" style="width: 794px; height:1122px;">
        
            <img src="<?php echo $fullurl; ?>package_image/vocation.png" alt="" style="width: 85%; margin:0 3rem; margin-top:2rem;">
            <hr style="width: 84%; color:black; margin-top: 20px; margin-left: 45px;">
            <h3 style="text-align: center; margin-bottom: 0;">PROPOSED KASHMIR PACKAGE</h3>
            <hr style="width: 84%; color:black; margin-left: 45px;">

            <div class="aug" style="margin: 0 3rem;">
             <table>
                <tr>
                    <th>10 AUG 2022</th>
                    <th style="padding-left: 2rem;">VALIDITY: 11 AUG 2022</th>
                </tr>
             </table>

             <table style="font-size: 14px; text-align:left;">
                <tr>
                    <td>TOUR NAME</td>
                    <td style="padding: 3px 7px;">:</td>
                    <th>CHARISMATIC KASHMIR(TRAVBIZZ TEST ITINERARY)</th>
                </tr>

                <tr>
                    <td>DEPARTURE DATE </td>
                    <td style="padding: 3px 7px;">:</td>
                    <th>12 SEPT 2022</th>
                </tr>

                <tr>
                    <td>NO OF NIGHTS </td>
                    <td style="padding: 3px 7px;">:</td>
                    <th>07 NIGHTS / 08 DAYS</th>
                </tr>

                <tr>
                    <td>ROOM TYPE</td>
                    <td style="padding: 3px 7px;">:</td>
                    <th>01 DOUBLE ROOM</th>
                </tr>
             </table>
            </div>
            <hr style="width: 84%; color:black; margin-left: 45px;">
            <h3 style="text-align: center; margin:0;">VISITING – SRINAGAR, PAHALGAM, GULMARG & SONMARG</h3>
            <hr style="width: 84%; color:black; margin-left: 45px;">

            <h3  style="text-align: center; margin-top: 2rem; text-decoration: underline 2px;">FLIGHT DETAILS IN SPICE JET / GO AIR/ AIR INDIA / AIR ASIA</h3>

            <div style="margin: 0 3rem; margin-top: 2rem;">
                <table style="border: 1px solid #000; border-collapse: collapse; font-size: 14px;">
                    <thead style="background-color: #92d050;">
                    <tr>
                        <th style="padding: 6px .8rem; border: 1px solid #000;">FROM</th>
                        <th style="padding: 6px 1.8rem; border: 1px solid #000;">TO </th>
                        <th style="padding: 6px 1.8rem; border: 1px solid #000;">FLIGHT</th>
                        <th style="padding: 6px 1.8rem; border: 1px solid #000;">DATE </th>
                        <th style="padding: 6px 1.8rem; border: 1px solid #000;">DEP</th>
                        <th style="padding: 6px 1.8rem; border: 1px solid #000;">ARR </th>
                        <th style="padding: 6px .8rem; border: 1px solid #000;">BAGGAGE</th>
                    </tr>
                    
                    </thead>
                
                    <tr>
                        <td style="padding: 5px .8rem; border: 1px solid #000;">CHENNAI</td>
                        <td style="padding: 5px .8rem; border: 1px solid #000;">NEW DELHI</td>
                        <td style="padding: 5px .8rem; border: 1px solid #000;">SG 8104</td>
                        <td style="padding: 5px .8rem; border: 1px solid #000;">12 SEPT</td>
                        <td style="padding: 5px .8rem; border: 1px solid #000;">06:05</td>
                        <td style="padding: 5px .8rem; border: 1px solid #000;">08:55 </td>
                        <td style="padding: 5px .8rem; border: 1px solid #000;">15 KGS</td>
                    </tr>

                    <tr>
                        <td style="padding: 5px .8rem; border: 1px solid #000;">NEW DELHI </td>
                        <td style="padding: 5px .8rem; border: 1px solid #000;">SRINAGAR</td>
                        <td style="padding: 5px .8rem; border: 1px solid #000;">AI 537</td>
                        <td style="padding: 5px .8rem; border: 1px solid #000;">13 SEPT</td>
                        <td style="padding: 5px .8rem; border: 1px solid #000;">16:15</td>
                        <td style="padding: 5px .8rem; border: 1px solid #000;">19:30 </td>
                        <td style="padding: 5px .8rem; border: 1px solid #000;">15 KGS</td>
                    </tr>

                    <tr>
                        <td style="padding: 5px .8rem; border: 1px solid #000;">SRINAGAR</td>
                        <td style="padding: 5px .8rem; border: 1px solid #000;">NEW DELHI</td>
                        <td style="padding: 5px .8rem; border: 1px solid #000;">G8 213</td>
                        <td style="padding: 5px .8rem; border: 1px solid #000;">20 SEPT</td>
                        <td style="padding: 5px .8rem; border: 1px solid #000;">11:50</td>
                        <td style="padding: 5px .8rem; border: 1px solid #000;">13:20 </td>
                        <td style="padding: 5px .8rem; border: 1px solid #000;">15 KGS</td>
                    </tr>

                    <tr>
                        <td style="padding: 5px .8rem; border: 1px solid #000;">NEW DELHI</td>
                        <td style="padding: 5px .8rem; border: 1px solid #000;">CHENNAI</td>
                        <td style="padding: 5px .8rem; border: 1px solid #000;">I5 559</td>
                        <td style="padding: 5px .8rem; border: 1px solid #000;">21 SEPT</td>
                        <td style="padding: 5px .8rem; border: 1px solid #000;">13:25</td>
                        <td style="padding: 5px .8rem; border: 1px solid #000;">15:00 </td>
                        <td style="padding: 5px .8rem; border: 1px solid #000;">15 KGS</td>
                    </tr>
                </table>
                <p style="font-size: 16px; margin-top: 3rem; font-weight: 500;">*The above air fare is based on instant purchase fare and the same is subject to<br>
                    availability at the time of ticket issuance.
                </p>
            </div>
    </div><!-- box1 -->


    <div class="box2" style="width: 794px ; height: 1122px;">
        <img src="<?php echo $fullurl; ?>package_image/vocation.png" alt="" style="width: 85%; margin:0 3rem; margin-top:2rem;">
        <h3 style="text-align: center; font-size:20px; text-decoration:underline 2px;">ROUTE MAP</h3>
        <img src="<?php echo $fullurl; ?>package_image/map.png" alt="" style="width: 85%; margin:0 3rem; margin-top: 10px;">
      
    </div> <!-- box2 -->




    
    <div class="box3" style="width: 794px ; height: 1122px;">
        <img src="<?php echo $fullurl; ?>package_image/vocation.png" alt="" style="width: 85%; margin:0 3rem; margin-top:2rem;">
        <h3 style="text-align: center; font-size:20px; text-decoration:underline 2px;">TOUR ITINERARY</h3>

        <div style="margin: 0 3rem; margin-top: 1rem;">
        <table>
            <tr>
                <th>DAY 01|ARRIVE SRINAGAR</th>
                <th style="padding-left:26rem;">(D)</th>
            </tr>
        </table>
        <h4>DAY ACTIVITY: SRINAGAR SIGHTSEEING</h4>
        
        </div>
        <img src="<?php echo $fullurl; ?>package_image/water.png" alt=""  style="width: 85%; margin:0 3rem; margin-top: 5px;">
        <p style="width: 85%; margin:0 3rem; margin-top:2rem; text-align: justify; font-weight: 500;">Meet our representative upon arrival in Srinagar and proceed to your houseboat. This place is 
            famous for its lakes and the charming houseboats, Srinagar is also known for traditional 
            Kashmiri handicrafts. The lake comprises a series of water bodies, including the Nagin Lake. One 
            can take in the panoramic view of the mountains surrounding Srinagar from this lake. Kashmiri 
            boats called Shikara, are used to explore the intricate maze of waterways on this lake. In the 
            evening, enjoy visit to Mughal Gardens followed by a Shikara-ride on Dal Lake. Overnight stay in 
            Srinagar Houseboat.
            </p>
    </div>
    <!-- box3 -->





    <div class="box4" style="width: 794px ; height: 1122px;">
        <img src="<?php echo $fullurl; ?>package_image/vocation.png" alt="" style="width: 85%; margin:0 3rem; margin-top:2rem;">

        <div style="margin: 0 3rem; margin-top: 1rem;">
        <table>
            <tr>
                <th>DAY 02| SRINAGAR-PAHALGAM (90KMS / 3HOURS)</th>
                <th style="padding-left: 13rem;">(B,D)</th>
            </tr>
        </table>
        <h4>DAY ACTIVITY: SRINAGAR SIGHTSEEING</h4>
        
        </div>
        <img src="<?php echo $fullurl; ?>package_image/stone.png" alt=""  style="width: 85%; margin:0 3rem; margin-top: 5px;">
        <p style="width: 85%; margin:0 3rem; margin-top:2rem; text-align: justify; font-weight: 500;">After breakfast, proceed to Pahalgam, also called the Valley of Shepherds. On arrival, check-in 
            at the hotel. In Pahalgam, admire the beauty of nature as you walk along the banks of River 
            Lidder. Pahalgam is also famous for some trekking routes and is the base camp for the 
            Amarnath Pilgrimage. Overnight stay at the hotel.
            </p>
        </div> 
        <!-- box4 -->




        <div class="box5" style="width: 794px ; height: 1122px;">
            <img src="<?php echo $fullurl; ?>package_image/vocation.png" alt="" style="width: 85%; margin:0 3rem; margin-top:2rem;">
    
            <div style="margin: 0 3rem; margin-top: 1rem;">
            <table>
                <tr>
                    <th>DAY 03 | PAHALGAM</th>
                    <th style="padding-left: 13rem;">(B,D)</th>
                </tr>
            </table>
            <h4>DAY ACTIVITY: SRINAGAR SIGHTSEEING</h4>
            
            </div>
            <img src="<?php echo $fullurl; ?>package_image/pahaad.png" alt=""  style="width: 85%; margin:0 3rem; margin-top: 5px;">
            <p style="width: 85%; margin:0 3rem; margin-top:2rem; text-align: justify; font-weight: 500;">After breakfast, enjoy panoramic views of Pahalgam town and Lidder Valley. Start with Aru 
                Valley which is a small village, 15 km upstream the Lidder River, The route is picturesque with 
                ample campsites. This village is the starting point for treks to the Kolahoi glacier. Later, visit 
                Chandanwari, 16 Km which is the starting point of sacred Amarnath Yatra. Chandanwari is 
                famous for snow sledging on a snow bridge, enroute you can visit Hajan, an idyllic picnic spot 
                and Betaab valley. Dinner & overnight in the hotel.
                </p>
            </div><!-- box5 -->





            <div class="box6" style="width: 794px ; height: 1122px;">
                <img src="<?php echo $fullurl; ?>package_image/vocation.png" alt="" style="width: 85%; margin:0 3rem; margin-top:2rem;">
                <h3 style="text-align: center; font-size:20px; text-decoration:underline 2px; margin-bottom: 0; margin-top: 1.5rem;">HOTEL DOWNTOWN - SRINAGAR</h3>
                <img src="<?php echo $fullurl; ?>package_image/hotel.png" alt="" style="width: 85%; margin:0 3rem; margin-top: 10px;">

                <h3 style="text-align: center; font-size:20px; text-decoration:underline 2px; margin-bottom: 0; margin-top: 1.5rem;">HOTEL EDEN RESORT AND SPA - PAHALGAM
                </h3>
                <img src="<?php echo $fullurl; ?>package_image/hotel.png" alt="" style="width: 85%; margin:0 3rem; margin-top: 10px;">
              
            </div> <!-- box6 -->



            <div class="box7" style="width: 794px ; height: 1122px;">
                <img src="<?php echo $fullurl; ?>package_image/vocation.png" alt="" style="width: 85%; margin:0 3rem; margin-top:2rem;">
                <h3 style="text-align: center; font-size:20px; text-decoration:underline 2px; margin-bottom: 0; margin-top: 1.5rem;">HOTEL ROSEWOOD - GULMARG
                </h3>
                <img src="<?php echo $fullurl; ?>package_image/hotel2.png" alt="" style="width: 85%; margin:0 3rem; margin-top: 10px;">

                <h3 style="text-align: center; font-size:20px; text-decoration:underline 2px; margin-bottom: 0; margin-top: 1.5rem;">HOTEL DETAILS</h3>
                
                <div style="margin: 0 3rem; margin-top: 2rem;">
                    <table style="border: 1px solid #000; border-collapse: collapse; font-size: 14px;">
                        <thead style="background-color: #92d050;">
                        <tr>
                            <th style="padding: 6px .8rem; border: 1px solid #000;">CITY</th>
                            <th style="padding: 6px 1.8rem; border: 1px solid #000;">HOTEL</th>
                            <th style="padding: 6px 1.8rem; border: 1px solid #000;">ROOM <br>CATEGORY</th>
                            <th style="padding: 6px 1.8rem; border: 1px solid #000;">NIGHTS</th>
                            <th style="padding: 6px 1.8rem; border: 1px solid #000;">MEAL</th>
                           </tr>
                        
                        </thead>
                    
                        <tr>
                            <th style="padding: 5px .8rem; border: 1px solid #000;">SRINAGAR</th>
                            <td style="padding: 5px .8rem; border: 1px solid #000;">DELUXE HOUSEBOAT</td>
                            <td style="padding: 5px .8rem; border: 1px solid #000;">BASE</td>
                            <td style="padding: 5px .8rem; border: 1px solid #000;">01</td>
                            <td style="padding: 5px .8rem; border: 1px solid #000;">B,D</td>
                            
                        </tr>
    
                        <tr>
                            <td style="padding: 5px .8rem; border: 1px solid #000;">PAHALGAM </td>
                            <td style="padding: 5px .8rem; border: 1px solid #000;">HOTEL EDEN RESORT OR SIMILAR </td>
                            <td style="padding: 5px .8rem; border: 1px solid #000;">DELUXE</td>
                            <td style="padding: 5px .8rem; border: 1px solid #000;">02</td>
                            <td style="padding: 5px .8rem; border: 1px solid #000;">B,D</td>
                           
                        </tr>
    
                        <tr>
                            <td style="padding: 5px .8rem; border: 1px solid #000;">GULMARG</td>
                            <td style="padding: 5px .8rem; border: 1px solid #000;">HOTEL ROSEWOOD OR SIMILAR</td>
                            <td style="padding: 5px .8rem; border: 1px solid #000;">DELUXE</td>
                            <td style="padding: 5px .8rem; border: 1px solid #000;">02</td>
                            <td style="padding: 5px .8rem; border: 1px solid #000;">B,D</td>
                            
                        </tr>
    
                        <tr>
                            <td style="padding: 5px .8rem; border: 1px solid #000;">SRINAGAR</td>
                            <td style="padding: 5px .8rem; border: 1px solid #000;">HOTEL DOWNTOWN OR SIMILAR</td>
                            <td style="padding: 5px .8rem; border: 1px solid #000;">DELUXE </td>
                            <td style="padding: 5px .8rem; border: 1px solid #000;">02</td>
                            <td style="padding: 5px .8rem; border: 1px solid #000;">B,D</td>
                            
                        </tr>
                    </table>
                    <h3 style="text-align: center; margin-top: 2rem;">PACKAGE COST PER COUPLE <span style="color: red;">INR 1,50,000/-</span></h3>
                    
                </div>
            </div><!-- box7 -->


            <div class="box8" style="width: 794px ; height: 1122px;">
                <img src="<?php echo $fullurl; ?>package_image/vocation.png" alt="" style="width: 85%; margin:0 3rem; margin-top:2rem;">
                <h3 style="text-align: center; font-size:20px; text-decoration:underline 2px; margin-bottom: 0; margin-top: 1.5rem;">PACKAGE INCLUSIONS</h3>
                
                <div style="margin: 0 4rem; margin-top: 2rem; font-size: 15px; font-weight: 500;">
                <p style="margin: 0;"> <img src="<?php echo $fullurl; ?>package_image/check.png" alt="" style="width: 13px; margin-right: 10px;"> Domestic flight ticket charges</p>
                <p style="margin: 0;"><img src="<?php echo $fullurl; ?>package_image/check.png" alt="" style="width: 13px; margin-right: 10px;">6 Nights’ accommodation in well-appointed rooms as mentioned above hotels or 
                    equivalent</p>
                    <p style="margin: 0;"><img src="<?php echo $fullurl; ?>package_image/check.png" alt="" style="width: 13px; margin-right: 10px;">1 Night accommodation in well-appointed rooms as mentioned above houseboat</p>
                    <p style="margin: 0;"><img src="<?php echo $fullurl; ?>package_image/check.png" alt="" style="width: 13px; margin-right: 10px;">Assistance at the airport</p>
                    <p style="margin: 0;"><img src="<?php echo $fullurl; ?>package_image/check.png" alt="" style="width: 13px; margin-right: 10px;">Meal Plan – 07 Breakfast & 07 Dinner’s</p>
                    <p style="margin: 0;"><img src="<?php echo $fullurl; ?>package_image/check.png" alt="" style="width: 13px; margin-right: 10px;">1 session of Shikara-ride</p>
                    <p style="margin: 0;"><img src="<?php echo $fullurl; ?>package_image/check.png" alt="" style="width: 13px; margin-right: 10px;">Gandola ride (up to Phase 2) in Gulmarg</p>
                    <p style="margin: 0;"><img src="<?php echo $fullurl; ?>package_image/check.png" alt="" style="width: 13px; margin-right: 10px;">01 AC Medium car for transfers and sightseeing as per the entire itinerary. (AC will not <span style="margin-left: 1.3rem;"> operate in hilly areas)</span>
                    </p>
                    <p style="margin: 0;"><img src="<?php echo $fullurl; ?>package_image/check.png" alt="" style="width: 13px; margin-right: 10px;">Pahalgam sightseeing by Non AC union vehicle</p>
                    <p style="margin: 0;"><img src="<?php echo $fullurl; ?>package_image/check.png" alt="" style="width: 13px; margin-right: 10px;">Entry ticket at Mughal garden Srinagar for one time visit</p>
                    <p style="margin: 0;"><img src="<?php echo $fullurl; ?>package_image/check.png" alt="" style="width: 13px; margin-right: 10px;">Driver’s allowances, toll taxes and Govt. Service Tax.</p>

                    <h3 style="text-align: center; font-size:20px; text-decoration:underline 2px; margin-bottom: 0; margin-top: 1.5rem;">PACKAGE INCLUSIONS</h3>
                    <p style="margin: 0;"><img src="<?php echo $fullurl; ?>package_image/check.png" alt="" style="width: 13px; margin-right: 10px;">Medical and Travel Insurance</p>
                    <p style="margin: 0;"><img src="<?php echo $fullurl; ?>package_image/check.png" alt="" style="width: 13px; margin-right: 10px;">Monument / Entry ( except mentioned in inclusions ) & Guide Charges</p>
                    <p style="margin: 0;"><img src="<?php echo $fullurl; ?>package_image/check.png" alt="" style="width: 13px; margin-right: 10px;">Pony Ride Charges</p>
                    <p style="margin: 0;"><img src="<?php echo $fullurl; ?>package_image/check.png" alt="" style="width: 13px; margin-right: 10px;">Guide service</p>
                    <p style="margin: 0;"><img src="<?php echo $fullurl; ?>package_image/check.png" alt="" style="width: 13px; margin-right: 10px;">Items of personal nature like laundry, phone calls, tips to guides / drivers etc. </p>
                    <p style="margin: 0;"><img src="<?php echo $fullurl; ?>package_image/check.png" alt="" style="width: 13px; margin-right: 10px;">Camera / Video camera fees applicable at monuments</p>
                    <p style="margin: 0;"><img src="<?php echo $fullurl; ?>package_image/check.png" alt="" style="width: 13px; margin-right: 10px;">Lunch is not included.</p>
                    </div>
            </div><!-- box8 -->


</body>
</html>

<script>
  window.print();
 </script>