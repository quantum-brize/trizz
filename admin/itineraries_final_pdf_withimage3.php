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
 

<!DOCTYPE HTML>
<html>
  <head>
    <title>html2pdf Test - Pagebreaks</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <style type="text/css">
	body{margin:0px; padding:0px; padding-right:10px; font-family: 'Roboto', sans-serif; font-size:13px;
      /* Avoid unexpected sizing on all elements. */
      * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
      }

   

      /* Big and bigger elements. */
      .big {
        height: 10.9in;
        background-color: yellow;
        border: 1px solid black;
      }
      .fullpage {
        height: 11in;
        background-color: fuchsia;
        border: 1px solid black;
      }
      .bigger {
        height: 11.1in;
        background-color: aqua;
        border: 1px solid black;
      }

      /* Table styling */
      
    table, tr, td, th, tbody, thead, tfoot {
    page-break-inside: avoid !important;
} 
    </style>
  </head>

  <body>
   
	
	
	 <div class="box1" style="width: 794px; height: 1122px;">
        <div class="main_grid" style="display: grid; grid-template-columns: auto auto;">
            <div class="logo">
                <img src="<?php echo $fullurl; ?>profilepic/<?php  echo $invoicedataa['invoiceLogo']; ?>" alt="" style="width: 35%; margin-top: 16px; margin-left: 2rem;">
            </div> <!-- logo -->

            <div class="sales" style="padding-left: -9rem; margin-top: 15px;">
                <p style="font-size: 12px; letter-spacing: 1px; opacity: 90%; font-weight: bold;">
                    <img src="itinerary3/mail.png" alt="" style="position: relative; top: 5px">
                    <?php echo strip($packagecreator['email']); ?>
                    <img src="itinerary3/whatsap.png" alt="" style="width: 4%; position: relative; top: 5px;"> +<?php echo strip($packagecreator['countryCode']); ?> <?php echo strip($packagecreator['mobile']); ?>
                </p>
                <p style="font-size: 12px; opacity: 70%; margin: 8px 0;">As quoted on <?php echo date('j F, Y'); ?></p>
                <p style="font-size: 11px;">TRIP ID : <?php if($querydata['id']!=''){ echo encode($querydata['id']); } else { echo encode($result['id']); } ?></p>

            </div><!-- sales  -->
        </div><!-- main_grid -->

        <div class="homepage" style="text-align: center; font-size :18px; margin-top :10rem;">
            <p style="letter-spacing: 4px;"> VOCATION TO </p>
            <h1 style="margin: 10px 0;"><?php echo stripslashes($result['destinations']); ?></h1>
            <p style="letter-spacing: 1px;"><?php echo round($result['days']-1); ?> N, <?php echo stripslashes($result['days']); ?> D <i class="fas fa-circle"
                    style="font-size: 7px; position:relative; bottom:3px; left:2px;"></i> <?php echo date('j M Y',strtotime($result['startDate'])); ?><br>
                <div style="font-size:14px; margin:5px 0px;"><i class="fas fa-circle" style="font-size: 7px; position:relative; bottom:3px;"></i> Adults (Above 12 Years) : <?php echo stripslashes($result['adult']); ?> | Child (5-12 Years) : <?php echo stripslashes($querydata['child']); ?> Child (0-5 Years) - <?php if($querydata['infant']>0){ echo stripslashes($querydata['infant']); } else { echo '0'; } ?></div>
            </p>
            <button
                style="font-size: 19px; background-color: #ff0039; border: none; color: #fff; padding: 10px 20px; border-radius: 5px; letter-spacing: 2px; margin-top: 1rem;"><?php if($result['billingType']==2){ ?><strong>&#8377;<?php echo number_format($result['grossPrice']+$result['extraMarkup']); ?></strong><?php } ?>
	   
	   <?php if($result['billingType']==1){ ?><strong>&#8377;<?php echo number_format($result['grossPrice']); ?></strong>  <?php } ?>
	   
	   </button>
	   
	   <div style="font-size:12px; color:#000; margin:10px 0px; "><strong><?php if($result['billingType']==2){ ?>
       Cost Per Person Cost<?php } ?><?php if($result['billingType']==1){ ?>Total Cost <?php } ?></strong></div>
            <p style="opacity: 50%; font-size :12px; word-spacing: 1px; margin-top: 8px;">We are not making any
                holding on below mentioned as of now. Flight prices<br>
                are subject to availability at the time of booking</p>
        </div>

         
    </div><!-- box1 -->



    <div class="box2" style="width: 794px; height:1122px; margin-top: 1rem;">
        <img src="itinerary3/summary.png" alt="" style="margin-left:-4px;">

        <table style="margin-left: 10rem;">
            <tr>
                <td style="padding: 0 15px;"><img src="itinerary3/flight.png" alt="" style="width: 48px;"><br><span
                        style="font-size: 11px; margin-top: 10px; margin-left: 2px;">FLIGHTS</span></td>
                <td style="padding: 0 15px;"><img src="itinerary3/hotel.png" alt="" style="width: 48px;"><br><span
                        style="font-size: 11px; margin-top: 10px; margin-left: 5px;">HOTELS</td>
                <td style="padding: 0 15px;"><img src="itinerary3/activity.png" alt="" style="width: 48px;"><br><span
                        style="font-size: 11px; margin-top: 10px;">ACTIVITIES</td>
                <td style="padding: 0 15px;"><img src="itinerary3/transfer.png" alt="" style="width: 48px;"><br><span
                        style="font-size: 11px; margin-top: 10px; margin-left: -5px;">TRANSFERS</td>
                <td style="padding: 0 15px;"><img src="itinerary3/visa.png" alt="" style="width: 48px;"><br><span
                        style="font-size: 11px; margin-top: 10px; margin-left: 12px;">VISA</td>
            </tr>
        </table>

        <div style="margin-top: 35px;">
            <table style="text-align: center; opacity:95%;">
                <tr>
                    <th style="padding: 6px 6rem;">DETAILS</th>
                    <th style="padding: 0 6rem;">PER PAX </th>
                    <th style="padding: 0 6rem;">TOTAL</th>
                </tr>

                <tr style="background-color: #edf4fa;">
                    <td style="padding: 6px 6rem;">FLIGHT</td>
                    <td style="padding: 0 6rem;">18350</td>
                    <td style="padding: 0 6rem;">36700</td>
                </tr>

                <tr>
                    <td style="padding: 6px 6rem;">LAND</td>
                    <td style="padding: 0 6rem;">42692</td>
                    <td style="padding: 0 6rem;">85383</td>
                </tr>

                <tr style="background-color: #edf4fa;">
                    <th style="padding: 6px 6rem;">TOTAL</th>
                    <th style="padding: 0 6rem;">61041.5</th>
                    <th style="padding: 0 6rem;">122083</th>
                </tr>
            </table>
        </div>

        <div class="total" style="text-align: center; opacity: 95%;">
            <h5 style="font-weight: bold; margin-top: 40px; margin-bottom: 0;">Total cost including taxes and above</h5>
            <h3 style="margin: 5px 0;"><?php if($result['billingType']==2){ ?><strong>&#8377;<?php echo number_format($result['grossPrice']+$result['extraMarkup']); ?></strong><?php } ?>
	   
	   <?php if($result['billingType']==1){ ?><strong>&#8377;<?php echo number_format($result['grossPrice']); ?></strong>  <?php } ?></h3>
            <div style="font-size:12px; color:#000; margin:10px 0px; "><strong><?php if($result['billingType']==2){ ?>
       Cost Per Person Cost<?php } ?><?php if($result['billingType']==1){ ?>Total Cost <?php } ?></strong></div>
            <p style="opacity: 70%; font-size : 11px; margin-top: 12px;">We are not making any holding on above as of
                now. Flight prices are also subject to availability at the time of<br>
                booking. As quoted on <?php echo date('j F, Y'); ?></p>
        </div>

         
    </div><!-- box2 -->

 

<?php


$rs=GetPageRecord('*','sys_packageBuilderEvent',' packageId="'.$result['id'].'"  and  sectionType="Accommodation" order by time(checkIn) asc');
$eventData1=mysqli_fetch_array($rs); 
if($eventData1['id']!=''){ 
?>
 
    <div class="box5" style="width: 794px; height:1122px; margin-top: 36rem; page-break-after:always;">

        <img src="itinerary3/box5-hotel.png" alt="" style="margin-left:-4px;">

         
 <?php  
$rs=GetPageRecord('*','sys_packageBuilderEvent',' packageId="'.$result['id'].'"  and  sectionType="Accommodation" order by time(checkIn) asc');
while($eventData=mysqli_fetch_array($rs)){ 
?>
        <div class="grid-hotel" style="margin-left: 3rem; margin-bottom:20px;">
            <table>
                <tr>
                  <td rowspan="2"> <img src="<?php echo $fullurl; ?>package_image/<?php  echo $eventData['eventPhoto']; ?>" alt="" style="width: 150px;"></td>
                  <td style="padding-left: 4rem;"><h6 style="margin-bottom: 0px;">  <span
                    style="font-size: 16px; opacity: 90%; position: relative; bottom: 6px;"><?php echo stripslashes($eventData['name']); ?></span>
                &nbsp;<?php echo starcategory($eventData['hotelCategory']); ?></h6></td>
                </tr>
                <tr>
                    <td style="padding-left: 4rem;">
                        <div class="multi-content">
                            <table>
                                <tr>
                                  <td style="opacity: 55%; font-size:14px;">Check In</td>
                                  <td style="opacity: 55%; font-size:14px; padding-left: 3rem;">Check Out</td>
                                </tr>
                                <tr>
                                  <td><?php echo date('d M Y',strtotime($eventData['startDate'])); ?> - <?php echo  date('g:i A',strtotime($eventData['checkIn'])); ?></td>
                                  <td style="padding-left: 3rem;"><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo date('d M Y',strtotime($eventData['endDate'])); ?> - <?php echo  date('g:i A',strtotime($eventData['checkOut'])); ?></td>
                                </tr>
                            </table>
                            <br>

<?php if($eventData['singleRoom']>0){ ?>
 
<div style="margin-bottom:20px;"><strong>Room: </strong> <?php echo $eventData['singleRoom']; ?> Single &nbsp;&nbsp;| &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Meal: </strong> <?php echo stripslashes($eventData['mealPlan']); ?>&nbsp;&nbsp; | &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Room Type: </strong> <?php echo stripslashes($eventData['hotelRoom']); ?></div>
 
 <?php } ?>
 
  <?php if($eventData['doubleRoom']>0){ ?>
 
 <div style="margin-bottom:20px;"><strong>Room: </strong> <?php echo $eventData['doubleRoom']; ?> Double &nbsp;&nbsp;| &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Meal: </strong> <?php echo stripslashes($eventData['mealPlan']); ?>&nbsp;&nbsp; | &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Room Type: </strong> <?php echo stripslashes($eventData['hotelRoom']); ?></div>
 <?php } ?>


<?php if($eventData['tripleRoom']>0){ ?>
 <div style="margin-bottom:20px;"><strong>Room: </strong> <?php echo $eventData['tripleRoom']; ?> Triple &nbsp;&nbsp;| &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Meal: </strong> <?php echo stripslashes($eventData['mealPlan']); ?>&nbsp;&nbsp; | &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Room Type: </strong> <?php echo stripslashes($eventData['hotelRoom']); ?></div>
<?php } ?>



<?php if($eventData['quadRoom']>0){ ?>
<div style="margin-bottom:20px;"><strong>Room: </strong> <?php echo $eventData['quadRoom']; ?> Quad &nbsp;&nbsp;| &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Meal: </strong> <?php echo stripslashes($eventData['mealPlan']); ?>&nbsp;&nbsp; | &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Room Type: </strong> <?php echo stripslashes($eventData['hotelRoom']); ?></div>
<?php } ?>


<?php if($eventData['cwbRoom']>0){ ?> 
  <div style="margin-bottom:20px;"><strong>Room: </strong> <?php echo $eventData['cwbRoom']; ?> Child With Bed &nbsp;&nbsp;| &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Meal: </strong> <?php echo stripslashes($eventData['mealPlan']); ?>&nbsp;&nbsp; | &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Room Type: </strong> <?php echo stripslashes($eventData['hotelRoom']); ?></div>
<?php } ?>

<?php if($eventData['cnbRoom']>0){ ?> 
  <div style="margin-bottom:20px;"><strong>Room: </strong> <?php echo $eventData['cnbRoom']; ?> Child No Bed &nbsp;&nbsp;| &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Meal: </strong> <?php echo stripslashes($eventData['mealPlan']); ?>&nbsp;&nbsp; | &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Room Type: </strong> <?php echo stripslashes($eventData['hotelRoom']); ?></div>
<?php } ?>
 <?php echo strip_tags(stripslashes($eventData['description'])); ?>         </div>               </td>
                </tr>
            </table>
			
			<div style="background-color: #FFFBEC; border: 1px dashed #fba309; padding: 10px; border-radius: 5px; color: #090909; margin-top: 20px; margin-bottom: 10px;"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAABmJLR0QA/wD/AP+gvaeTAAABRUlEQVRoge2YS07DMBRFDx8xY15YEu0SWEZp5xTx2RNhxgi2QcSYMoBRGeSlRK7jRCWpnXKPZMXxe7LvdfuctCCEEEIIAE6AByAH3oA7Gxsc98DKabdRFW1JzqaRPKqiLTigEF4XGwyHsQV0hYykhoykRlsjEyADPoGl9cdOzjObx3hfzauhLrnkJpCzaDFP3+26jZGJ9b+AKXBm7crGVpVdcTegT86BOfBta15UBfiMPFl/6plsZrHM7ndppGRuaz5WBfiMLK0/8kwystiH3ccwstbQVOylMN/rypGTE4N3u542GXmx66UnVo69diKpA0JfrTG/xT6jKDK30GIUe5X1uk3H7yKQ4zt+d01rI1DsekZR/HUPxKhGQr9HBsW/e9dKHhlJDRlJDRlJjeNALNU/6LwP8L35RGQkNfbGiBBCCPEXfgBDJL201UHfZAAAAABJRU5ErkJggg==" width="16"/>

 &nbsp;Overnight stay at <?php echo stripslashes($eventData['name']); ?></div>
        </div>
 <?php   }  ?>
        

    </div> <!-- grid-hotel -->
    </div> <!-- box5  -->
	
	<?php   }  ?>

 


    <div class="box6" style="width: 794px; min-height:1122px; page-break-after:always;">

        <img src="itinerary3/intinerey.png" alt="" style="margin-left:-4px;">
        <div class="brdr" style="border-left: 1px solid gray; margin-left: 2rem; margin-top:20px;">
            <div class="all" style="padding-left: 1rem;">
              <?php
	$n=1;
$begin = new DateTime( $result['startDate'] );
$end   = new DateTime( $result['endDate'] );
 
 
for($i = $begin; $i <= $end; $i->modify('+1 day')){ 
$abcde=GetPageRecord('*','sys_packageBuilderEvent',' packageDays="'.$n.'" and packageId="'.$result['id'].'"'); 
$dayDetailsData=mysqli_fetch_array($abcde); 
?> 
<div style="  padding-bottom:10px;">

<div style="padding:5px 0px; line-height:20px; font-size:14px; margin-bottom:10px;page-break-inside:avoid; page-break-after:auto;">
<div style=" padding:5px 0px; font-weight:500; line-height:20px; font-size:22px; color:#000; font-weight:600; padding-top:25px; padding-bottom:20px; position:relative;"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAABmJLR0QA/wD/AP+gvaeTAAAA20lEQVRoge2ayw6DIBBFL00/rrva/9/ZwG/YjRjSYosI4XZyT8JCHgOHiRMXAuXcADwBLGub175W9I6/MSebpJv9S/yNGHzveWj8S8ODDCUVeQAI+Ezvr5vZm3+0HY0fAEy5Bd8kchu2EjgT38fJ7m1hCXFNy/fjTHwHGHpHajLChq2MSIQNMyKCDZVfNiTChkTYuFascZm+peNYEWYyIhE2zIjoE4UNlV82JMKGGRGVXzZUftmQCBtmRFR+2ZAIGxJhIxUJw05Rj891TutArz8aWjcP4N7gMkQXXjdxqG1L7Y6IAAAAAElFTkSuQmCC" width="16"/>

 <strong>Day <?php echo $n; ?> - <?php echo stripslashes($dayDetailsData['daySubject']); ?></strong>
 <div style="color:#666666; position:absolute; right:0px; font-size:14px;top: 27px;"><?php echo date('D', strtotime($i->format("Y-m-d"))); ?>, <?php echo date('d M Y', strtotime($i->format("Y-m-d"))); ?></div>
 
 </div>
<div style="padding:20px; background-color:#F7F7F7; margin-bottom:20px;"><?php echo nl2br(strip_tags(stripslashes($dayDetailsData['dayDetails']))); ?></div></div>

 <?php  
$rs=GetPageRecord('*','sys_packageBuilderEvent',' packageId="'.$result['id'].'"   and sectionType="Accommodation" order by time(checkIn) asc');
while($eventData=mysqli_fetch_array($rs)){

if(date('Y-m-d', strtotime($i->format("Y-m-d")))>=$eventData['startDate'] && date('Y-m-d', strtotime($i->format("Y-m-d")))<$eventData['endDate']){
?>
<div style="margin-bottom:10px; padding-bottom:10px;page-break-inside:avoid; page-break-after:auto ">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top"><img src="<?php echo $fullurl; ?>package_image/<?php  if($eventData['eventPhoto']!=''){ echo $eventData['eventPhoto']; } else {   if($eventData['sectionType']=='Transportation' ){ echo 'notransfer.png'; }if($eventData['sectionType']=='Activity' ){ echo 'noactivity.png'; }if($eventData['sectionType']=='Meal' ){ echo 'nomeal.png'; } }?>" width="203" height="147"  style="border-radius: 5px; "></td>
    <td width="90%" align="left" valign="top" style="padding-left:20px; "> <?php if($eventData['sectionType']=='Accommodation'){ ?>
      <div style=" padding-top:4px; margin-bottom:4px;">
<div style="font-size:18px; font-weight:500; color:#000; margin-bottom:10px;"><strong><?php echo stripslashes($eventData['name']); ?></strong> - <span style="color:#FFCC00;"><?php echo starcategory($eventData['hotelCategory']); ?></span></div>
 
</div>

<?php if($eventData['singleRoom']>0){ ?>
 
<div style="margin-bottom:10px; font-size:"><strong>Room: </strong> <?php echo $eventData['singleRoom']; ?> Single &nbsp;&nbsp;| &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Meal: </strong> <?php echo stripslashes($eventData['mealPlan']); ?>&nbsp;&nbsp; | &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Room Type: </strong> <?php echo stripslashes($eventData['hotelRoom']); ?></div>
 
 <?php } ?>
 
  <?php if($eventData['doubleRoom']>0){ ?>
 
 <div style="margin-bottom:10px;"><strong>Room: </strong> <?php echo $eventData['doubleRoom']; ?> Double &nbsp;&nbsp;| &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Meal: </strong> <?php echo stripslashes($eventData['mealPlan']); ?>&nbsp;&nbsp; | &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Room Type: </strong> <?php echo stripslashes($eventData['hotelRoom']); ?></div>
 <?php } ?>


<?php if($eventData['tripleRoom']>0){ ?>
 <div style="margin-bottom:10px;"><strong>Room: </strong> <?php echo $eventData['tripleRoom']; ?> Triple &nbsp;&nbsp;| &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Meal: </strong> <?php echo stripslashes($eventData['mealPlan']); ?>&nbsp;&nbsp; | &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Room Type: </strong> <?php echo stripslashes($eventData['hotelRoom']); ?></div>
<?php } ?>



<?php if($eventData['quadRoom']>0){ ?>
<div style="margin-bottom:10px;"><strong>Room: </strong> <?php echo $eventData['quadRoom']; ?> Quad &nbsp;&nbsp;| &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Meal: </strong> <?php echo stripslashes($eventData['mealPlan']); ?>&nbsp;&nbsp; | &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Room Type: </strong> <?php echo stripslashes($eventData['hotelRoom']); ?></div>
<?php } ?>


<?php if($eventData['cwbRoom']>0){ ?> 
  <div style="margin-bottom:10px;"><strong>Room: </strong> <?php echo $eventData['cwbRoom']; ?> Child With Bed &nbsp;&nbsp;| &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Meal: </strong> <?php echo stripslashes($eventData['mealPlan']); ?>&nbsp;&nbsp; | &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Room Type: </strong> <?php echo stripslashes($eventData['hotelRoom']); ?></div>
<?php } ?>

<?php if($eventData['cnbRoom']>0){ ?> 
  <div style="margin-bottom:10px;"><strong>Room: </strong> <?php echo $eventData['cnbRoom']; ?> Child No Bed &nbsp;&nbsp;| &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Meal: </strong> <?php echo stripslashes($eventData['mealPlan']); ?>&nbsp;&nbsp; | &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Room Type: </strong> <?php echo stripslashes($eventData['hotelRoom']); ?></div>
<?php } ?>
<?php } ?><div style="font-size:13px;line-height: 20px;"><?php echo strip_tags(stripslashes($eventData['description'])); ?></div>

<div style="background-color: #FFFBEC; border: 1px dashed #fba309; padding: 10px; border-radius: 5px; color: #090909; margin-top: 20px; margin-bottom: 10px;"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAABmJLR0QA/wD/AP+gvaeTAAABRUlEQVRoge2YS07DMBRFDx8xY15YEu0SWEZp5xTx2RNhxgi2QcSYMoBRGeSlRK7jRCWpnXKPZMXxe7LvdfuctCCEEEIIAE6AByAH3oA7Gxsc98DKabdRFW1JzqaRPKqiLTigEF4XGwyHsQV0hYykhoykRlsjEyADPoGl9cdOzjObx3hfzauhLrnkJpCzaDFP3+26jZGJ9b+AKXBm7crGVpVdcTegT86BOfBta15UBfiMPFl/6plsZrHM7ndppGRuaz5WBfiMLK0/8kwystiH3ccwstbQVOylMN/rypGTE4N3u542GXmx66UnVo69diKpA0JfrTG/xT6jKDK30GIUe5X1uk3H7yKQ4zt+d01rI1DsekZR/HUPxKhGQr9HBsW/e9dKHhlJDRlJDRlJjeNALNU/6LwP8L35RGQkNfbGiBBCCPEXfgBDJL201UHfZAAAAABJRU5ErkJggg==" width="16"/>

 &nbsp;Overnight stay at <?php echo stripslashes($eventData['name']); ?></div>
</td>
  </tr>
</table>

</div>
<?php  } } ?>

 <?php  
$rs=GetPageRecord('*','sys_packageBuilderEvent',' packageId="'.$result['id'].'"  and packageDays="'.$n.'" and  (sectionType="Activity" ) order by time(checkIn) asc');
while($eventData=mysqli_fetch_array($rs)){ 
?>
<div style="margin-bottom:10px; padding-bottom:20px; ">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top"><img src="<?php echo $fullurl; ?>package_image/<?php  if($eventData['eventPhoto']!=''){ echo $eventData['eventPhoto']; } else {   if($eventData['sectionType']=='Transportation' ){ echo 'notransfer.png'; }if($eventData['sectionType']=='Activity' ){ echo 'noactivity.png'; }if($eventData['sectionType']=='Meal' ){ echo 'nomeal.png'; } }?>" width="203" height="147" style="border-radius: 5px; " ></td>
    <td width="90%" align="left" valign="top" style="padding-left:20px; font-size:13px;line-height: 20px;"> <div style="font-size:18px; font-weight:500; color:#000; margin-bottom:10px;"><strong><?php echo stripslashes($eventData['name']); ?></strong> </div><?php if($eventData['sectionType']=='Activity' || $eventData['sectionType']=='Transportation' ){ ?>
 <div style="margin-bottom:10px;">
 <i class="fa fa-calendar" aria-hidden="true"></i> &nbsp;<?php echo date('d M Y',strtotime($eventData['startDate'])); ?> &nbsp;<i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp; <?php echo  date('g:i A',strtotime($eventData['checkIn'])); ?> to <?php echo  date('g:i A',strtotime($eventData['checkOut'])); ?></div>
 
<?php } ?><?php echo strip_tags(stripslashes($eventData['description'])); ?></td>
  </tr>
</table>

</div>

<?php } ?>


 <?php  
$rs=GetPageRecord('*','sys_packageBuilderEvent',' packageId="'.$result['id'].'" and packageDays="'.$n.'" and  ( sectionType="Transportation") order by time(checkIn) asc');
while($eventData=mysqli_fetch_array($rs)){ 

?>
<div style="margin-bottom:10px; padding-bottom:20px; ">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top"><img src="<?php echo $fullurl; ?>package_image/<?php  if($eventData['eventPhoto']!=''){ echo $eventData['eventPhoto']; } else {   if($eventData['sectionType']=='Transportation' ){ echo 'notransfer.png'; }if($eventData['sectionType']=='Activity' ){ echo 'noactivity.png'; }if($eventData['sectionType']=='Meal' ){ echo 'nomeal.png'; } }?>" width="203" height="147"  style="border-radius: 5px; " ></td>
    <td width="90%" align="left" valign="top" style="padding-left:20px; font-size:13px;line-height: 20px;"> <div style="font-size:18px; font-weight:500; color:#000; margin-bottom:10px;"><strong><?php echo stripslashes($eventData['name']); ?></strong> </div><?php if($eventData['sectionType']=='Activity' || $eventData['sectionType']=='Transportation' ){ ?>
 <div style="margin-bottom:10px;">
 <i class="fa fa-calendar" aria-hidden="true"></i> &nbsp;<?php echo date('d M Y',strtotime($eventData['startDate'])); ?> &nbsp;<i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp; <?php echo  date('g:i A',strtotime($eventData['checkIn'])); ?> to <?php echo  date('g:i A',strtotime($eventData['checkOut'])); ?></div>
 
<?php } ?><?php echo strip_tags(stripslashes($eventData['description'])); ?></td>
  </tr>
</table>

</div>

<?php } ?>

 <?php   
$rs=GetPageRecord('*','sys_packageBuilderEvent',' packageId="'.$result['id'].'"   and packageDays="'.$n.'" and  sectionType="Meal"  ');
while($eventData=mysqli_fetch_array($rs)){ 


 
?>
<div style="margin-bottom:10px; padding-bottom:20px; ">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top"><img src="<?php echo $fullurl; ?>package_image/<?php echo $eventData['eventPhoto']; ?>" width="203" height="147" style="border-radius: 5px; " ></td>
    <td width="90%" align="left" valign="top" style="padding-left:20px; font-size:13px;line-height: 20px;"> <div style="font-size:18px; font-weight:500; color:#000; margin-bottom:10px;"><strong><?php echo stripslashes($eventData['name']); ?></strong> </div><?php if($eventData['sectionType']=='Meal' ){ ?>
 <div style="margin-bottom:10px;">
 <i class="fa fa-calendar" aria-hidden="true"></i> &nbsp;<?php echo date('d M Y',strtotime($eventData['startDate'])); ?> &nbsp;<i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp; <?php echo  date('g:i A',strtotime($eventData['checkIn'])); ?> to <?php echo  date('g:i A',strtotime($eventData['checkOut'])); ?></div>
 
<?php } ?><?php echo strip_tags(stripslashes($eventData['description'])); ?></td>
  </tr>
</table>

</div>

<?php } ?>




</div>
<?php $n++; } ?>
            </div><!-- all  -->
        </div><!-- brdr  -->
    </div><!-- box6 -->



     <!-- box7 -->


    

    <div class="box9" style="width: 794px; min-height: 1110px;  page-break-after:always;">
        <img src="itinerary3/payment.png" alt="" style="margin-left: -4px;">
		<?php 
$rsa=GetPageRecord('*','sys_PackageTips',' packageId="'.$result['id'].'"   order by id asc');
while($packageTipsData=mysqli_fetch_array($rsa)){ 
?>


        <div style="margin-left: 3rem; font-size: 12px; margin-top: 2rem;">
            <p><span style="margin-left: -1rem;"><?php echo stripslashes($packageTipsData['title']); ?></span>
               

            <p style="font-size: 12px; margin-top: 1rem; margin-left: -1rem;"><?php echo stripslashes($packageTipsData['description']); ?>
            </p>

           
        </div>
		<?php } ?>
    </div><!-- box9 -->
    




      <!-- box10  -->








     <!-- box11  -->




    <div class="box12" style="width: 794px; height: 1122px;">
        <img src="itinerary3/last.png" alt="" style="margin-left: -4px;">
        <h1 style="color: #ffc341; text-align: center; font-size: 42px">THANK YOU</h1>

        <div style="text-align: center; margin-top: 6rem;">
            <img src="itinerary3/logo.png" alt="" style="width: 120px;">
            <p style="font-size: 12px; letter-spacing: 1px; opacity: 90%; font-weight: bold;">
                <img src="itinerary3/last-phone.png" alt="" style="width: 13px; position: relative; top: 5px;">+<?php echo strip($packagecreator['countryCode']); ?> <?php echo strip($packagecreator['mobile']); ?> &nbsp;
                <img src="itinerary3/whatsap.png" alt="" style="width: 20px; position: relative; top: 5px;"> <?php echo strip($packagecreator['mobile']); ?>
                <img src="itinerary3/mail.png" alt="" style="position: relative; top: 5px;">
               <?php echo strip($packagecreator['email']); ?>
            </p>
        </div>
       
    </div><!-- box12  -->
       


  </body>
</html>


<script>
  window.print();
 </script>