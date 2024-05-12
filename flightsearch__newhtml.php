<?php include "inc.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Flight - <?php echo $portalname; ?></title>

    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/main.css">

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css">


    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <?php include "headerinc.php"; ?> 
 
  <style>
   #bodyaria{padding:68px 0px 0px 0px;}
   .webcontenor{ max-width:1200px; margin:auto;}
   .hldtabs input{position: relative;top: -2px;}
   .flightsearchfullheader { padding-bottom: 10px !important; margin-bottom: 30px; } .flightsearchfullheader { padding: 20px; } .fullheader { background-color: var(--blue); padding: 50px 0px; color: #FFFFFF; font-size: 14px; }
   .flightsearchfullheader .searchtabs {margin-bottom: 12px !important;overflow: hidden;}
   .flightsearchfullheader .tablebordersearch { background-color: transparent; box-shadow: none; } .fullheader .tablebordersearch { background-color: #fff; border-radius: 5px; box-shadow: 1px 1px 3px #00000063; color: #000000; }
   .flightsearchfullheader .tablebordersearch table tr td { border-right: none; padding-right: 20px; }
   .flightsearchfullheader .tablebordersearch label { padding: 0px; } .fullheader .tablebordersearch label { padding: 10px 18px; width: 100%; }
   .flightsearchfullheader .tablebordersearch .lable { color: var(--white); margin-bottom: 6px !important; } .fullheader .tablebordersearch .lable { text-transform: uppercase; font-size: 12px; font-weight: 600; color: #8a8a8a; }
   .flightsearchfullheader #pickupCitySearchfromCity { width: 90%; } .flightsearchfullheader .tablebordersearch .textfield { background-color: hsl(0deg 0% 100% / 10%); font-size: 16px !important; color: var(--white); margin-bottom: 0px !important; padding: 2px 10px; border-radius: 5px !important; }
   .flightsearchfullheader .tablebordersearch .swapbtn { right: 6px !important; top: 27px !important; background-color: transparent !important; color: var(--white) !important; font-size: 11px !important; } .fullheader .tablebordersearch .swapbtn { position: absolute; right: -14px; top: 29px; border-radius: 100px; border: 1px solid #ddd; padding: 5px 8px; background-color: #fff; font-size: 12px; color: #969696; cursor: pointer; }
   .flightsearchfullheader .redbuttonsearch { background-color: transparent !important; font-size: 16px !important; text-transform: uppercase !important; color: var(--white)!important; border: 1px solid var(--white)!important; padding: 8px 30px !important; border-radius: 50px !important; margin-top: 18px; }
   .flightsearchfullheader .nowrapdiv {margin-top: 12px !important;}
   .flightsearchfullheader .webcheckin { display: none; } .webcheckin { position: absolute; right: 0px; font-weight: 700; color: #FFFFFF; border: 1px solid #ffffff61; padding: 7px 20px; border-radius: 5px; background-color: #ffffff12; top: -6px; }
    </style>
</head>

<body>
<?php include "header.php"; ?>


 
    <div id="bodyaria" class="innersearchbody">
    


        <div class="webcontenor">
            <div class="row flightsearchcnt">
                <div class="col-lg-3">
                    <div class="card filtercard">
                        <div class="card-header">FILTER</div>

                        <div class="contentfl">
                            <div>
                                <h6>Popular Filters</h6>
                                <div class="listairlines">
                                    <div class="listcheckbox"><input type="checkbox">
                                        <h5>Nonstop</h5>
                                    </div>
                                    <div class="listcheckbox"><input type="checkbox">
                                        <h5>Indigo</h5>
                                    </div>
                                    <div class="listcheckbox"><input type="checkbox">
                                        <h5>Vistara</h5>
                                    </div>
                                    <div class="listcheckbox"><input type="checkbox">
                                        <h5>Air India</h5>
                                    </div>
                                    <div class="listcheckbox"><input type="checkbox">
                                        <h5>SpiceJet</h5>
                                    </div>
                                    <div class="listcheckbox"><input type="checkbox">
                                        <h5>Air India Express</h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="borderb2"></div>

                        <div class="contentfl">
                            <h6>Price Range</h6>
                            <div class="filterslide"></div>
                            <p class="priceshow">Rs. 8503 - 30455</p>
                        </div>

                        <div class="borderb2"></div>

                        <div class="contentfl">
                            <h6>Stops</h6>
                            <ul class="stopstabs">
                                <li>0 <br> Nonstop</li>
                                <li>1 <br> Stop</li>
                                <li>2+ <br> Stop</li>
                            </ul>
                        </div>

                        <div class="borderb2"></div>

                        <div class="contentfl">
                            <h6>Departure</h6>
                            <div class="deparuretab">
                                <div><i class="fa fa-picture-o" aria-hidden="true"></i> <br> Before 6 AM</div>
                                <div><i class="fa fa-sun-o" aria-hidden="true"></i> <br> 6 AM - 12 PM</div>
                                <div><i class="fa fa-sun-o" aria-hidden="true"></i> <br> 12 PM - 6 AM</div>
                                <div><i class="fa fa-moon-o" aria-hidden="true"></i> <br> After 6 PM</div>

                            </div>
                        </div>

                    </div><!-- filtercard  -->
                </div>



                <div class="col-lg-9">


                    <div class="card datecardfl">
                        <div class="fromtogo">
                            <h6>New Delhi (DEL) → Bangkok (BKK)</h6>
                            <p>Wed, 6 Dec 2023 | passenger(s) | Economy</p>
                        </div>
                        <img class="flightfixoimg" src="images/fl2.png" alt="">

                        <div class="flexdatebox">
                            <div class="datecontent activedatebox">
                                <p>Wed, 6 Dec <br> U$$ 455.03</p>
                            </div>
                            <div class="datecontent">
                                <p>Wed, 7 Dec <br> U$$ 455.03</p>
                            </div>
                            <div class="datecontent">
                                <p>Thu, 8 Dec <br> U$$ 455.03</p>
                            </div>
                            <div class="datecontent">
                                <p>Fri, 9 Dec <br> U$$ 455.03</p>
                            </div>
                            <div class="datecontent">
                                <p>Sat, 10 Dec <br> U$$ 455.03</p>
                            </div>
                            <div class="datecontent">
                                <p>Sun, 11 Dec <br> U$$ 455.03</p>
                            </div>

                        </div>
                    </div>

                    <div class="nav hotel-pills mb-3 sortbycard">

                        <table width="100%" border="0" cellpadding="0" cellspacing="0">

                            <tbody>
                                <tr>

                                    <td width="16%" align="left" style="cursor:pointer;" onclick="getSortedDeparture();"><strong>Sort By:</strong> </td>

                                    <td width="21%" align="center" style="cursor:pointer;" onclick="getSortedDeparture();">Departure <i class="fa fa-caret-down" id="departurefa" aria-hidden="true" style="display: none;"></i>

                                        <input name="departurefilterid" type="hidden" id="departurefilterid" value="1">
                                    </td>

                                    <td width="21%" align="center" style="cursor:pointer;" onclick="getSortedDuration();">Duration <i class="fa fa-caret-down" id="durationfa" aria-hidden="true" style="display: none;"></i>

                                        <input name="durationfilterid" type="hidden" id="durationfilterid" value="1">
                                    </td>

                                    <td width="21%" align="center" style="cursor:pointer;" onclick="getSortedArrival();">Arrival <i class="fa fa-caret-down" id="arrivalfa" aria-hidden="true" style="display: none;"></i>

                                        <input name="arrivalfilterid" type="hidden" id="arrivalfilterid" value="1">

                                    </td>

                                    <td width="21%" align="center" style="cursor:pointer;" onclick="getSortedPrice();" id="pricefilter">Price <i class="fa fa-caret-up" id="pricefa" aria-hidden="true" style="display: inline-block;"></i>



                                        <input name="pricefilterid" type="hidden" id="pricefilterid" value="0">

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>




                    <div class="flightselect">
                        <div class="row">

                            <div class="col-lg-2">
                                <div class="bookimg">
                                    <div class="bkimg"><img src="https://ofc.faujiyatra.com/upload/168790287116156276441686088471.png" alt=""></div>
                                    <h6>SpiceJet <br><span>SG-160</span></h6>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="bookboxprice">
                                    <h6>11:15</h6>
                                    <p class="destination">IXJ</p>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="nonstop">
                                    <h4>0H :50 M</h4>
                                    <div class="nonstopborder"><i class="fa fa-plane" aria-hidden="true"></i>
                                    </div>
                                    <span>Non Stop</span>
                                    <div class="stoptooltip" id="stoptooltip25695"></div>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="bookboxprice">
                                    <h6>12:05</h6>
                                    <p class="destination">SXR</p>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <p class="flprice2"> ₹ 24580</p>
                            </div>

                            <div class="col-lg-2">
                                <a href="#" class="selectbutton"><button type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" class="btn btn-danger" style="width:100%;">Select</button></a>
                            </div>



                        </div>



                        <div class="refundtable">
                            <table>
                                <tbody>
                                    <tr>
                                        <td><i class="fa fa-credit-card-alt" aria-hidden="true"></i> <span class="green"><span class="nonrefundablespan">Non Refundable</span></span>&nbsp;&nbsp;&nbsp;</td>

                                        <td><i class="fa fa-user-circle-o" aria-hidden="true"></i>
                                            <span class="red"> Seat Left </span>
                                        </td>

                                        <td>
                                            <div class="blackbox">

                                                <h5><i class="fa fa-list" aria-hidden="true"></i> ECONOMY</h5>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div><!-- flightselect  -->


                    <div class="flightselect">
                        <div class="row">

                            <div class="col-lg-2">
                                <div class="bookimg">
                                    <div class="bkimg"><img src="images/indigo.png" alt=""></div>
                                    <h6>Indigo <br><span>6E-2137</span></h6>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="bookboxprice">
                                    <h6>11:15</h6>
                                    <p class="destination">IXJ</p>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="nonstop">
                                    <h4>0H :50 M</h4>
                                    <div class="nonstopborder"><i class="fa fa-plane" aria-hidden="true"></i>
                                    </div>
                                    <span>Non Stop</span>
                                    <div class="stoptooltip" id="stoptooltip25695"></div>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="bookboxprice">
                                    <h6>12:05</h6>
                                    <p class="destination">SXR</p>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <p class="flprice2"> ₹ 24580</p>
                            </div>

                            <div class="col-lg-2">
                                <a href="#" class="selectbutton"><button type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" class="btn btn-danger" style="width:100%;">Select</button></a>
                            </div>



                        </div>



                        <div class="refundtable">
                            <table>
                                <tbody>
                                    <tr>
                                        <td><i class="fa fa-credit-card-alt" aria-hidden="true"></i> <span class="green"><span class="nonrefundablespan">Non Refundable</span></span>&nbsp;&nbsp;&nbsp;</td>

                                        <td><i class="fa fa-user-circle-o" aria-hidden="true"></i>
                                            <span class="red"> Seat Left </span>
                                        </td>

                                        <td>
                                            <div class="blackbox">

                                                <h5><i class="fa fa-list" aria-hidden="true"></i> ECONOMY</h5>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div><!-- flightselect  -->



                    <div class="flightselect">
                        <div class="row">

                            <div class="col-lg-2">
                                <div class="bookimg">
                                    <div class="bkimg"><img src="images/vistara.jpeg" alt=""></div>
                                    <h6>Vistara <br><span>UK-612</span></h6>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="bookboxprice">
                                    <h6>02:14</h6>
                                    <p class="destination">IXJ</p>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="nonstop">
                                    <h4>0H :50 M</h4>
                                    <div class="nonstopborder"><i class="fa fa-plane" aria-hidden="true"></i>
                                    </div>
                                    <span>Non Stop</span>
                                    <div class="stoptooltip" id="stoptooltip25695"></div>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="bookboxprice">
                                    <h6>13:05</h6>
                                    <p class="destination">SXR</p>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <p class="flprice2"> ₹ 14580</p>
                            </div>

                            <div class="col-lg-2">
                                <a href="#" class="selectbutton"><button type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" class="btn btn-danger" style="width:100%;">Select</button></a>
                            </div>

                        </div>


                        <div class="refundtable">
                            <table>
                                <tbody>
                                    <tr>
                                        <td><i class="fa fa-credit-card-alt" aria-hidden="true"></i> <span class="green"><span class="nonrefundablespan">Non Refundable</span></span>&nbsp;&nbsp;&nbsp;</td>

                                        <td><i class="fa fa-user-circle-o" aria-hidden="true"></i>
                                            <span class="red"> Seat Left </span>
                                        </td>

                                        <td>
                                            <div class="blackbox">

                                                <h5><i class="fa fa-list" aria-hidden="true"></i> ECONOMY</h5>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div><!-- flightselect  -->



                    <div class="flightselect">
                        <div class="row">

                            <div class="col-lg-2">
                                <div class="bookimg">
                                    <div class="bkimg"><img src="https://ofc.faujiyatra.com/upload/168790287116156276441686088471.png" alt=""></div>
                                    <h6>SpiceJet <br><span>SG-160</span></h6>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="bookboxprice">
                                    <h6>05:20</h6>
                                    <p class="destination">IXJ</p>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="nonstop">
                                    <h4>0H :50 M</h4>
                                    <div class="nonstopborder"><i class="fa fa-plane" aria-hidden="true"></i>
                                    </div>
                                    <span>Non Stop</span>
                                    <div class="stoptooltip" id="stoptooltip25695"></div>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="bookboxprice">
                                    <h6>06:05</h6>
                                    <p class="destination">SXR</p>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <p class="flprice2"> ₹ 34690</p>
                            </div>

                            <div class="col-lg-2">
                                <a href="#" class="selectbutton"><button type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" class="btn btn-danger" style="width:100%;">Select</button></a>
                            </div>



                        </div>



                        <div class="refundtable">
                            <table>
                                <tbody>
                                    <tr>
                                        <td><i class="fa fa-credit-card-alt" aria-hidden="true"></i> <span class="green"><span class="nonrefundablespan">Non Refundable</span></span>&nbsp;&nbsp;&nbsp;</td>

                                        <td><i class="fa fa-user-circle-o" aria-hidden="true"></i>
                                            <span class="red"> Seat Left </span>
                                        </td>

                                        <td>
                                            <div class="blackbox">

                                                <h5><i class="fa fa-list" aria-hidden="true"></i> ECONOMY</h5>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div><!-- flightselect  -->

                </div>

            </div><!-- flightsearchcnt  -->



            <!-- right slide offcanvas -->

            <div class="offcanvas offcanvas-end rightcanvas" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                <div class="offcanvas-header">
                    <h5 id="offcanvasRightLabel">Your Trip</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <div class="pricelistflight">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td width="20%">
                                        <div class="flhead">Type</div>
                                        <div class="flhtext"><span class="green"><span class="refundablespan">Refundable</span></span></div>
                                    </td>
                                    <td width="20%">
                                        <div class="flhead">Fare Type </div>
                                        <div class="flhtext">
                                            <div class="blackbox" style="margin-left:0px;">
                                                <div class="blackbg" style="background-color:#a19b9b; color:#FFFFFF;">MAIN</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td width="15%">
                                        <div class="flhtext" style="line-height: 18px; color: #393939; text-transform: uppercase; font-size: 11px !important;"><i class="fa fa-suitcase" aria-hidden="true"></i> 15 Kg (01 Piece only)<br>
                                            <i class="fa fa-briefcase" aria-hidden="true"></i> 7 Kg
                                        </div>
                                        <div class="bookmsg">


                                        </div>
                                    </td>
                                    <td align="center">
                                        <div id="toggle2" class="toggle2">
                                            <i class="fa fa-info-circle" aria-hidden="true" data-toggle="modal" data-target=".bs-example-modal-center"></i>
                                            <span></span>
                                        </div>

                                    </td>


                                    <td width="20%" align="center" class="pricefare1">₹ 3868</td>

                                    <td width="20%" align="right"><a href="#">
                                            <button type="button" class="btn btn-danger buttonbook">Book Now</button></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>




            <!-- second sidebar popup  -->

            <div class="sidebar" id='sidebar'>

                <div class="sidebarheader">
                    <div>Flight Details (Air India - AI-821)</div>
                    <button type="button" class="btn-close text-reset toggle3" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>

                <div class="sidebarbody">
                    <div class="tabs">
                        <ul id="tabs-nav">
                            <li><a href="#tab2">Flight Details</a></li>
                            <li><a href="#tab3">Fare Details</a></li>
                            <li><a href="#tab4">Baggage Info</a></li>
                            <li><a href="#tab5">Fare Rules</a></li>
                        </ul>

                        <div id="tabs-content">
                            <div id="tab2" class="tab-content">
                                <div class="row flightdetailrefund">
                                    <div class="col-lg-3">
                                        <div class="bookimg">
                                            <div class="bkimg"><img src="images/indigo.png" alt=""></div>
                                            <h6>Indigo <br><span>6E-2137</span></h6>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="coltime">12:40</div>
                                        <div class="coltime" style="font-size:11px;">09-12-2023</div>
                                        <div class="graysmalltext">
                                            (IXJ) Jammu<br>Satwari<br>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="nostops">1H :0 M
                                        </div>
                                        <div style="margin-top:2px;">
                                            <span class="nonrefundablespan">Non Refundable</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="coltime">12:40</div>
                                        <div class="coltime" style="font-size:11px;">09-12-2023</div>
                                        <div class="graysmalltext">
                                            (IXJ) Jammu<br>Satwari<br>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="tab3" class="tab-content">
                                <div class="row">
                                    <div class="col-lg-6 basefare">
                                        <div style="margin-bottom:10px; font-size:16px;"><strong>Fare Breakup</strong></div>
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="baggageclass">
                                            <tbody>
                                                <tr>
                                                    <td width="33%" align="left">Base Fare</td>
                                                    <td width="33%" align="left">₹1160</td>
                                                </tr>
                                                <tr>
                                                    <td align="left">Surcharges &amp; Taxes</td>
                                                    <td align="left">₹1208</td>
                                                </tr>
                                                <tr>
                                                    <td align="left" bgcolor="#F7F7F7"><strong>Total Fare</strong></td>
                                                    <td align="left" bgcolor="#F7F7F7"><strong>₹2368</strong></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div id="tab4" class="tab-content">
                                <div class="row bagagerow">
                                    <div class="col-lg-12">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="baggageclass">
                                            <tbody>
                                                <tr>
                                                    <td width="33%" align="left" bgcolor="#f5f5f5"><strong>Airline</strong></td>
                                                    <td width="33%" align="left" bgcolor="#f5f5f5"><strong>Check-in Baggage</strong></td>
                                                    <td width="33%" align="left" bgcolor="#f5f5f5"><strong>Cabin Baggage</strong></td>
                                                </tr>
                                                <tr>
                                                    <td width="33%" align="left">
                                                        <table border="0" cellpadding="0" cellspacing="0">
                                                            <tbody>
                                                                <tr>
                                                                    <td colspan="2"><img src="https://ofc.faujiyatra.com/upload/163173034410875909681630520744.png" height="32"></td>
                                                                    <td>
                                                                        <div class="flightname">Air India</div>
                                                                        <div class="flightnumber">AI-821</div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                    <td width="33%" align="left">20 Kilograms</td>
                                                    <td width="33%" align="left">7 Kg</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" align="left">
                                                        <div style="padding:10px; background-color:#F5F5F5;">
                                                            Baggage information mentioned above is obtained from airline's reservation system, Fauji Yatra does not guarantee the accuracy of this information.<br>
                                                            The baggage allowance may vary according to stop-overs, connecting flights. changes in airline rules. etc.
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div id="tab5" class="tab-content">
                            <div class="cancelationdiv">
                                <h5>Cancellation Fee</h5>
                                <h6>₹ 3500 +  ₹50</h6>
                                
                                <h5>Data Change Free</h5>
                                <h6>₹ 3500 +  ₹50</h6>
                                 <p>+ Fare Difference if any</p>

                                <h5>No Show</h5>

                                <h5>Seat Chargeable</h5>
                            </div>
                            </div>
                        </div>
                    </div>
                </div><!-- sidebarbody  -->
            </div><!-- sidebar  -->

            <!-- second sidevar end  -->


        </div>

    </div>

 


    <script>
        function getflightSearchCIty(citysearchfield, cityresultfield, listsearch) {

            var citysearchfieldval = encodeURI($('#' + citysearchfield).val());

            var citysearchfield = citysearchfield;



            if (citysearchfieldval != '') {

                $('#' + listsearch).show();

                $('#' + listsearch).load('searchflightcitylists.php?keyword=' + citysearchfieldval + '&searchcitylists=' + listsearch + '&cityresultfield=' + cityresultfield + '&citysearchfield=' + citysearchfield);

            }

        }





        function swapdata() {

            var pickupCitySearchfromCity = $('#pickupCitySearchfromCity').val();

            var pickupCitySearchfromCity2 = $('#pickupCitySearchfromCity2').val();



            var fromDestinationFlight = $('#fromDestinationFlight').val();

            var fromDestinationFlight2 = $('#fromDestinationFlight2').val();



            $('#pickupCitySearchfromCity').val(pickupCitySearchfromCity2);

            $('#pickupCitySearchfromCity2').val(pickupCitySearchfromCity);



            $('#fromDestinationFlight2').val(fromDestinationFlight);

            $('#fromDestinationFlight').val(fromDestinationFlight2);



        }



        $(".swapbtn").click(function() {

            $(this).toggleClass("down");

        });

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
                onSelect: function() {

                }

            });



        });







        function changeselectsearchtype() {

            var selectsearchtype = Number($('#selectsearchtype').val());

            if (selectsearchtype < 4) {

                selecttb(selectsearchtype);

            }



            if (selectsearchtype == 4) {

                $("#groupenquiryid").trigger("click");

            }

            $('#selectsearchtype').val(1);

        }

















        function selecttb(id) {

            $('#returndiv').show();

            $('#searchbuttonflight').show();

            $('#submitbuttonflight').hide();

            $('#notediv').hide();





            if (id == 1) {

                $('#tb2').removeClass('active');

                $('#tb3').removeClass('active');

                $('#tb4').removeClass('active');

                $('#tb1').addClass('active');

                $('#tripType').val('1');

                $('#dt2').attr('disabled', 'true');

                $('#dt3').attr('disabled', 'true');

                $('#dt2').css('color', '#fafafa');

                $('#fixedDeparture').val('0');

                $('.selectreturnflightcl').hide();

            }

            if (id == 2) {

                $('.selectreturnflightcl').show();

                $('#tb1').removeClass('active');

                $('#tb3').removeClass('active');

                $('#tb4').removeClass('active');

                $('#tb2').addClass('active');

                $('#tripType').val('2');

                $('#dt2').removeAttr('disabled');

                $('#dt3').removeAttr('disabled');

                $('#dt2').css('color', '#333333');

                $('#fixedDeparture').val('0');

            }

            if (id == 3) {

                /*$('#tb1').removeClass('active');

                $('#tb2').removeClass('active');

                $('#tb4').removeClass('active');

                $('#tb3').addClass('active');

                $('#tripType').val('1');

                $('#dt2').attr('disabled','true');

                $('#dt1').removeAttr('disabled');

                $('#dt2').css('color','#fafafa');

                $('#fixedDeparture').val('1');*/



                $('.selectreturnflightcl').show();

                $('#tb1').removeClass('active');

                $('#tb2').removeClass('active');

                //$('#tb3').removeClass('active');

                $('#tb4').removeClass('active');

                $('#tb3').addClass('active');

                $('#tripType').val('3');

                $('#dt2').removeAttr('disabled');

                $('#dt3').removeAttr('disabled');

                $('#dt2').css('color', '#333333');

                $('#fixedDeparture').val('0');







            }



            if (id == 4) {

                $('#returndiv').hide();

                $('#tb1').removeClass('active');

                $('#tb2').removeClass('active');

                $('#tb3').removeClass('active');

                $('#tb4').addClass('active');

                $('#formids').attr('target', 'actoinfrm');

                $('#formids').attr('action', 'actionpage.php');

                $('#tripType').val('4');

                $('#notediv').show();



                $('#searchbuttonflight').hide();

                $('#submitbuttonflight').show();

            }





        }





        function findflight(id) {

            var pickupCitySearchfromCity = $('#pickupCitySearchfromCity').val();

            var pickupCitySearchfromCity2 = $('#pickupCitySearchfromCity2').val();



            if (pickupCitySearchfromCity == pickupCitySearchfromCity2) {

                $('#flightdublicate').show();

            } else {

                $('#flightdublicate').hide();





                if (id == 1) {

                    $('#formids').submit();

                }



            }

        }





        function checkdublicatedestination() {

            setTimeout(function() {

                findflight(0);

            }, 500);

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script>
        var btn = document.querySelector('.toggle2');
        var btn2 = document.querySelector('.toggle3');
        var btnst = true;
        btn.onclick = function() {
            if (btnst == true) {
                document.querySelector('.toggle2 span').classList.add('toggle2');
                document.getElementById('sidebar').classList.add('sidebarshow');
                btnst = false;
            } else if (btnst == false) {
                document.querySelector('.toggle2 span').classList.remove('toggle2');
                document.getElementById('sidebar').classList.remove('sidebarshow');
                btnst = true;
            }
        }

        btn2.onclick = function() {
            if (btnst == true) {
                document.querySelector('.toggle3 span').classList.add('toggle3');
                document.getElementById('sidebar').classList.add('sidebarshow');
                btnst = false;
            } else if (btnst == false) {
                document.querySelector('.toggle2 span').classList.remove('toggle3');
                document.getElementById('sidebar').classList.remove('sidebarshow');
                btnst = true;
            }
        }
    </script>

    <script>

    </script>


    <script>
        // Show the first tab and hide the rest
        $('#tabs-nav li:first-child').addClass('active');
        $('.tab-content').hide();
        $('.tab-content:first').show();

        // Click function
        $('#tabs-nav li').click(function() {
            $('#tabs-nav li').removeClass('active');
            $(this).addClass('active');
            $('.tab-content').hide();

            var activeTab = $(this).find('a').attr('href');
            $(activeTab).fadeIn();
            return false;
        });
    </script>


<?php include "footerinc.php"; ?>
<?php include "footer.php"; ?>


</body>

</html>