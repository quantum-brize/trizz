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

    <style type="text/css">
	body{margin:0px; padding:0px; padding-right:10px;
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
      
     
    </style>
  </head>

  <body>
    <!-- Different options. -->
    <select id="mode">
      <option value="avoid-all">Avoid-all</option>
      <option value="css">CSS</option>
      <option value="legacy">Legacy</option>
      <option value="specify">Specified elements (using before/after/avoid)</option>
    </select>

    <!-- Button to generate PDF. -->
    <button onClick="test()">Generate PDF</button>

    <!-- Div to capture. -->
    <div id="root" style="padding-right:16px; padding-top:10px;">
      
 
<img src="https://travbizz.in/crm/b2c/package_image/1.png" style="width:100%; height:700" />
<div style="padding:70px 50px 0px;page-break-after: always;"><div style="font-size:35px; font-weight:600; margin-bottom:10px;">Manali - Sissu  - Barah Lacha 2 Nights 3 Days</div>
  <table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-size:20px;">
    <tr>
      <td style="padding:10px 0px;"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAABmJLR0QA/wD/AP+gvaeTAAABfUlEQVRIieXWPUscURTG8d8qamyUWJldsU5K8ROYPr4QsAsI6UO6FSVfJzYioo0h3yBBfAExabQwhWKhQYgoihYzC8tm2HtndtTCB05z7zznfzhzODM8N1VyPDuEaUziNUbS8z/YxxpWcVZWcf1YxF/cBeIcC6mnI1XxIwLYGlsYLQodkbQxL7QRR6jlhfZjswNoI37iRR7wlxKgjZiPhQ6JG6TYOMfLVkhXBngGA7FVRmgQUzHgd4FE16hLBqcmaeV1wDMZUaDf2reunuGpBzy/YsAXgSSvMjzDAc9FqyGr1T2BwrLWbHfA8999Fvg4kORD5FmzTgL3YEX7tl1J3mk1jXp61s6zHAOeDSQpEu9jwH04LRF6gt4YMHwsETwXCyWZ3O8lQDfk+9lAsjZ3OoDuydjRsaphtwB0WzLxHWkQ6zmgq0r8yFTwGZdtgP/wSYF3GqM3OMyAHqR3D6px3DZBbzD20NCGlprAXx8LCm+bwBOPCa7gm4IL4kl1D6g+L/ymwoEkAAAAAElFTkSuQmCC" width="32"/></td>
      <td width="99%" style="padding:10px 0px; padding-left:10px;">Manali, Sissu, Barah Lacha  - 2 nights, 3 days</td>
    </tr>
    <tr>
      <td style="padding:10px 0px;"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAABmJLR0QA/wD/AP+gvaeTAAABS0lEQVR4nO2aQU7DMBBFH5QNVyjdAeIGHIFbsOUK3KYn6m2QKiqQyiIsUTp2xvkO+U+KFEX25OfbHjuJwRhjjDFr5SpQ5jwxVrR+q7ijz3hdpmWU7R/X7jqOC+Qa8Bq81kvcMOfgcQLeGVps+3t+KqjfKu4omTmgV2bLAYvEBqgFqLEBagFqbIBagDFaIivBL+ADOAKfwENTRTNTsxSO1FFyz9BQR4aG+x4r/B8NKNK7+lnABqgFqLEBagFqbhrEjGbh7HJVrL4H2AC1ADUtckB0jGaXq2L1PcAGqAWoycwBl/4gdfkW6R4gvLdXgj1gA9QC1ChzgFeCDXgurZDZAxTz/AbYAY/AC/BWGkA5BKZyy/DtfxJLHgJPGUGWbEDxeK+laNvZTGyAAwnb5CL0ZsAO2JO0T7AmCfZgQhpLzgEp2AC1AGOMMcYYFT9T02E5130aiAAAAABJRU5ErkJggg==" width="32"/></td>
      <td style="padding:10px 0px; padding-left:10px;">1 Jul 2022 <strong>to</strong> 3 Jul 2022</td>
    </tr>
    <tr>
      <td style="padding:10px 0px;"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAABmJLR0QA/wD/AP+gvaeTAAADhklEQVR4nO2azUtVQRjGf5kpEhFaGX0R1MZF/QFJRItKSaMIyW1aQkEFbSUKiiCKdv0TIdIXhIvaZZD2hUFqEYG5sBaltwumlraYudyr3Jnz3nPP3LnWPPBsznnfeZ/3nXNm5swcCAgICCgd6oFrwBsgDSxopoHX+t4Gb+ocow1IkU3axCnguCeNztAGzBOdfIZ/+IeKUI+s55dyEljvWlyF6wDAeWBNDL+1wLmEtXjBWwrv/QxfedCbOH4SvwAp1+JWuA6ASqQYONVYijGgrBEK4FuAb4QCxPBpBQaAGc0BoCVJUeWsoxXzlHXM4BN3CswwKR2JYNAS+IXBx0UB4uhIBDOWwL8MPi4KEEdHXhQ6BlRZ7lUbrqcLjJGLqQR15EUpZoGXnnydIM7jekTgZ+LhBHUkgjlL0DmL33WLn4lXHegoGs8tgfsjfFuAp9g3R1LAE8w9n4SOotCgg+f2wJy+1uAycJnqCAj4n1ALnAIeAaOo1Vga+Aw8ALq0TSl0nNExvwDTWscocA/oTFpHDXCJxSc5tlH8RJ42VgPNwA3gIeoU6Btqv/A7MA6MAL3AZeAoald4KdqRbbFPAt1ae1HYBgwJAi4AE0AH2dVlJepwow/72t3EaVRB2sgubytQPTwhbGMQ2Bo3+e2onpEEukv2EGMVcLEAXwnHgNOooqJj9Qh9x+MUoQa1Jx/V+CyLDy8OAsMJJr6UH4CmnHgXsK8Kc5+Egl6HK4JG08ABbV8F3HGYeC7ngVtkvwgPIRufuqXJr0N9htoaSwF7tf0m4FmJks/lALBRa9hH9AHMD4SzQ1dEQ79RX3gAW4BPHpLPcATYrLU0E/06dEgKcD+ikbParh6377uUw6inENR4ZLPtlRTgo6WBHm1Tjdqs8J18hv2o2QedpMluVFIA07v0FajTNrfLIOmlvKm11aEWWflsRIetpgAn9f0mCvvbo1ScJztFdlrsYhVgCHVKW4mai30na+J7YCVqxfguyQJk1vdRM0Q5sFNrbY9bABMqUEtS3wlGcQxHu92NZZCclI0uCtBXBolJ+Tjp5GtRHz6+E5NyBuGyV/qu7Ce70FgOqEJ9H0RCWoA98bV4g2gckBZgdxFCfGGXxEhagB1FCPGFnRIjaQGW4y/sIs3SnxBnWV6DICjNkf8KSAuwUJwWb4jML/wm51uAb4QC+BbgG6EAvgUEBAQE+MRf4zQr1ajhlicAAAAASUVORK5CYII=" width="32"/></td>
      <td style="padding:10px 0px; padding-left:10px;">Adults (Above 12 Years) : 15 | Child (5-12 Years) :  Child (0-5 Years) - 0</td>
    </tr>
    
    
    <tr>
      <td colspan="2" style="padding:10px 0px;"><div style="margin-top:10px; padding-top:30px; padding-bottom:10px; text-align:center; border-top:1px solid #ddd; ">
 <div  ><div style="font-size:22px; color:#000; "><strong>Total Cost </strong></div>
       
       <div style="font-size:30px;  color:#000; ">	   
	   <strong>&#8377;98,000</strong>  	   
	   <div style="  margin:10px 0px; color:#999999; font-size:15px;"><i>Note: All  prices are subject to change without prior notice as per availability, <br />
       the final date of travel and any
changes in taxes.</i></div>
	   </div>	
</div>
 </div></td>
    </tr>
    
    <tr>
      <td colspan="2" align="center" style="padding:10px 0px; font-size:15px; line-height:25px;"><img src="https://travbizz.in/crm/b2c/profilepic/16553875452958611131654177945.png" style="height:40px; width:auto; margin-bottom:10px; " /><br />
<strong>TravBizz</strong><br />
info@travbizz.com<br />
+Indi 7011205338</td>
    </tr>
    <tr>
      <td colspan="2" align="center" style="padding:10px 0px;"></td>
    </tr>
  </table>
</div>
 


<div style="padding:70px 50px 0px;page-break-after: always;">

 
<div style="font-size:25px; font-weight:600; margin-bottom:10px; padding-bottom:20px; ">

 <table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-size:25px; ">
  <tr>
    <td colspan="2"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAABmJLR0QA/wD/AP+gvaeTAAAD90lEQVR4nO2bP2wcRRSHvzeHkC3Z/CmRq9iBAiklCOTN5YqjACVVKmxT0CV0QEEZU1LRhRIkiOlJQEh2sXEuQYgOiQrHoSCILgIs5YTieRR76927ZO9m7m5294w/aeXZ2Teemee537y3Nxb6eQ14HXiaavgXuAP8WHbHzwHfAVqT6wbwbNAZD1CnyafX9aAz7iEky/6H3r0FtoD7ZXT+BJaA9d64AF4Ffgrd6YdkXv8ydGcOfEU2nvdDd2aAxdz93dAdOrCXKwfXARO6g7rzv3fAU1UPYASrwEce9t5xhKsDDLDWK18jEahp1hfR7l2+fEuym/zlYrxJprqbBTYbOZv1APVF4wkeR7iugNO58osB6ou4DXQc7FLyccR54BVGxBF114AdildlEUK2uiJGOOA47gJeccRxdIAXs+SA08AH9OuIIRHWDbL8wQtXDcgvq18D1LvwPbACXAJe6tWtkeUvSrK1euHqgHTPVuDrAPUurPR+TrKrPIarA4q8O636ypglDQjCiQM87J6kttOqdyEV0GmJKuCuAUVqO616F94ELgDf5OomEVWg/rlAnj3g04G6iUX1RAOqHkDVzJIDKg2F60CQUNh1BdQhF6g0FK5DLhCEk1yg6gFUzSw5oNJQuKrvBfJUGgrXIReoNBQuMxeYdFl7ta9jIDTpsvZqX0cHTLqsvdrXxgFR1F1uNA7bqvp8yH5E5IGq2d7dnb8HNXHAuXMH76o+uqrKXOi+VBU47J49e3D51q2FLyrPBaKou6zKVQg/+RxzInzWbD48VXkuYMzhG5Q7+ZQ5EduuQS5gXxgzlZ8YVbtUCw0IhBVhC0C17+xhH8fWASJs3by58A5As3mQPzPQxywlQ16oau7Mo+4V2R1bB7gyAx8B3Qd2QB74tDJGnM4W+abDSz6DGMJ9HNJhVT5vNBbei2PpTqnfxxgnHZ4WI2J23Q89eRjvq7Gy2E4n32wenAHeKjI0xt6O42c6AK3WPy1raRlDHMeL8ahOxtGAwbN7EcmRVp9nPzM6Vf0zK+pFkCtFhtbKx+nvtpYWyBVrFSCIAwbP7m2STdLnmTPGSMdaPhn2PCsTW6sYM3ryMBO7AMTxwg6JAx1sF2Mc/vIpJ3FA1QNwodX6O7LWrI62zMgL4zBmwgHWShsoFMGCNkfCOIzafgREZCV3570Nu7av7QpQZb2XxQnwdqj2tXUA/cfeg7UfdEDR/+isDrEZ59lRLiBi/kheVJaPqvldSIITL4GZEhvAtSjqLhvz6BfKfy/YhcbLhv43taXT6cztq3I5GVBpdIFLu7vz91KRWAPOlDiANBc4WvvN5sNTIratqivFzSZHRO6KmO04nv8N4D8snPatoEGoJAAAAABJRU5ErkJggg==" width="32"/>

</td>
    <td width="99%" style="padding-left:10px;"><strong>Hotel</strong></td>
  </tr>
</table>
</div>

  <div style="margin-bottom:10px; padding-bottom:20px; ">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top"><img src="https://travbizz.in/crm/b2c/package_image/ka9a0insbt5h9e6pvlc45nrs001d1656411895.jpg" width="203" height="147"  style="border-radius: 5px; "></td>
    <td width="90%" align="left" valign="top" style="padding-left:20px; ">       <div style=" padding-top:4px; margin-bottom:4px;">
<div style="font-size:18px; font-weight:500; color:#000; margin-bottom:10px;"><strong>Hotel Vintage 3 Star</strong> - <span style="color:#FFCC00;"><i class='fa fa-star' aria-hidden='true'></i><i class='fa fa-star' aria-hidden='true'></i><i class='fa fa-star' aria-hidden='true'></i></span></div>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style=" font-size:14px;">
  <tr>
    <td colspan="2"><div style="margin-bottom:10px;">
 
<div style="margin-bottom:5px; font-weight:700;">Check-in: 01 Jul 2022 - 2:00 PM</div>
</div></td>
    <td><div style="margin-bottom:10px;"> 
<div style="margin-bottom:5px; font-weight:700;">Check-out: 03 Jul 2022 - 11:00 AM</div>
</div></td>
  </tr>
</table>
</div>

 
  

 <div style="margin-bottom:10px;"><strong>Room: </strong> 5 Triple &nbsp;&nbsp;| &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Meal: </strong> MAP</div>






<div style="font-size:15px;">Offering views of the Himalayas, this unpretentious hotel off the NH3 road is a minute&rsquo;s walk from the Beas River and 3 km from Jogini Falls.</div></td>
  </tr>
</table>

</div>

<div style="margin-bottom:10px; padding-bottom:20px; ">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top"><img src="https://travbizz.in/crm/b2c/package_image/1674919451656412847.jpg" width="203" height="147"  style="border-radius: 5px; "></td>
    <td width="90%" align="left" valign="top" style="padding-left:20px; ">       <div style=" padding-top:4px; margin-bottom:4px;">
<div style="font-size:18px; font-weight:500; color:#000; margin-bottom:10px;"><strong>Winterfell Camps</strong> - <span style="color:#FFCC00;"><i class='fa fa-star' aria-hidden='true'></i><i class='fa fa-star' aria-hidden='true'></i></span></div>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style=" font-size:14px;">
  <tr>
    <td colspan="2"><div style="margin-bottom:10px;">
 
<div style="margin-bottom:5px; font-weight:700;">Check-in: 02 Jul 2022 - 2:00 PM</div>
</div></td>
    <td><div style="margin-bottom:10px;"> 
<div style="margin-bottom:5px; font-weight:700;">Check-out: 02 Jul 2022 - 11:00 AM</div>
</div></td>
  </tr>
</table>
</div>

 
  

 <div style="margin-bottom:10px;"><strong>Room: </strong> 5 Triple &nbsp;&nbsp;| &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Meal: </strong> MAP</div>






<div style="font-size:15px;">Get your trip off to a great start with a stay at this property, which offers car park free of charge. Conveniently situated in the Jispa part of Jispa, this property puts you close to attractions and interesting dining options. This 5-star property is packed with in-house facilities to improve the quality and joy of your stay.</div></td>
  </tr>
</table>

</div>


</div>



<div style="padding:70px 50px 0px; ">




 
<div style="  padding-bottom:10px;">

<div style="padding:5px 0px; line-height:20px; font-size:14px; margin-bottom:10px;">
<div style=" padding:5px 0px; font-weight:500; line-height:20px; font-size:22px; color:#000; font-weight:600; padding-top:25px; padding-bottom:20px; position:relative;">
<div style="font-size:25px; font-weight:600; margin-bottom:0px; padding-bottom:0px; ">

 <table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-size:25px; ">
  <tr>
    <td colspan="2"> 
	
	<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAABmJLR0QA/wD/AP+gvaeTAAAB/ElEQVR4nO2aTStEcRSHH1KSEGqylY3FCCuRspQFzcLLwsLOVpJCWfkCvoJSisVEWdnIflZjoYxmYUWhbETEZhaKOzP3/3LOne7/qbu6nd8583Q7M3fuhUAg1TRZ1g8Auy4G8cgJcO4rfBz4TvixVe0DNFsK+M0TUHCYJ4JLARfArMM8EVwK6AcWHeaJ0OIwa6xyNBQur4BTYNRhngguBbwBDw7zRHApoCFxuQOiWAfuY9YsAQseZvmDhIAM8BWzpsPHIP8hIWBboIcxqd8BQYD2ANpI7IAj4Nlj/iQwbFosIeAYKHnM7yLhAvICPYxJ/Q4IArQH0EZiB9wB7x7z+4Ae02IJATng2mP+PrBmWiwh4Ir4N0NxaLcplhDQLdDDGJdLMAtsOMwTweUVkK0cDUX4GhToMQXceMzfA1ZNiyUE7ACvHvNHbIolBEwL9DAm9TsgCNAeQBuJHbBJ/AcjcVgBZkyLawnIAcsR5/JAuY4enVjcrdVBq01xLQGDwHzEuRL1CUj0O0Sp3wFBgPYA2kg9F3jxmD8BDJkWSwg4BG495reRcAFnAj2MSf0OCAK0B9BGYgeUgQ+P+Rks/nmWEDBHyh+MXAKfHvOt3iiTENAr0MOY1C/BIEB7AG2CAO0BtAkCtAfQptbvgCJwEHGuADxWOZ8UitoDBAIJ5gfPK1qTl5ZTagAAAABJRU5ErkJggg==" width="32"/>



</td>
    <td width="99%" style="padding-left:10px;"><strong>Itinerary</strong></td>
  </tr>
</table>
</div>

<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAABmJLR0QA/wD/AP+gvaeTAAAA20lEQVRoge2ayw6DIBBFL00/rrva/9/ZwG/YjRjSYosI4XZyT8JCHgOHiRMXAuXcADwBLGub175W9I6/MSebpJv9S/yNGHzveWj8S8ODDCUVeQAI+Ezvr5vZm3+0HY0fAEy5Bd8kchu2EjgT38fJ7m1hCXFNy/fjTHwHGHpHajLChq2MSIQNMyKCDZVfNiTChkTYuFascZm+peNYEWYyIhE2zIjoE4UNlV82JMKGGRGVXzZUftmQCBtmRFR+2ZAIGxJhIxUJw05Rj891TutArz8aWjcP4N7gMkQXXjdxqG1L7Y6IAAAAAElFTkSuQmCC" width="16"/>

 <strong>Day 1 - Manali</strong>
 <div style="color:#666666; position:absolute; right:0px; font-size:14px;top: 27px;">Fri, 01 Jul 2022</div>
 
 </div>
Upon arrival in Manali, check-in at the hotel. Later in the afternoon, proceed on a half-day city tour and visit the Hidimba Devi Temple, Vashist Hot Water Springs, Van Vihar, Hongkong Market and the Tibetan Monastery. Explore the Shopping malls of Manali and enjoy dinner and overnight stay at the hotel.</div>

 <div style="margin-bottom:10px; padding-bottom:10px; ">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top"><img src="https://travbizz.in/crm/b2c/package_image/ka9a0insbt5h9e6pvlc45nrs001d1656411895.jpg" width="203" height="147"  style="border-radius: 5px; "></td>
    <td width="90%" align="left" valign="top" style="padding-left:20px; ">       <div style=" padding-top:4px; margin-bottom:4px;">
<div style="font-size:18px; font-weight:500; color:#000; margin-bottom:10px;"><strong>Hotel Vintage 3 Star</strong> - <span style="color:#FFCC00;"><i class='fa fa-star' aria-hidden='true'></i><i class='fa fa-star' aria-hidden='true'></i><i class='fa fa-star' aria-hidden='true'></i></span></div>
 
</div>

 
  

 <div style="margin-bottom:10px;"><strong>Room: </strong> 5 Triple &nbsp;&nbsp;| &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Meal: </strong> MAP</div>






<div style="font-size:15px;">Offering views of the Himalayas, this unpretentious hotel off the NH3 road is a minute&rsquo;s walk from the Beas River and 3 km from Jogini Falls.</div>

<div style="background-color: #FFFBEC; border: 1px dashed #fba309; padding: 10px; border-radius: 5px; color: #090909; margin-top: 20px; margin-bottom: 10px;"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAABmJLR0QA/wD/AP+gvaeTAAABRUlEQVRoge2YS07DMBRFDx8xY15YEu0SWEZp5xTx2RNhxgi2QcSYMoBRGeSlRK7jRCWpnXKPZMXxe7LvdfuctCCEEEIIAE6AByAH3oA7Gxsc98DKabdRFW1JzqaRPKqiLTigEF4XGwyHsQV0hYykhoykRlsjEyADPoGl9cdOzjObx3hfzauhLrnkJpCzaDFP3+26jZGJ9b+AKXBm7crGVpVdcTegT86BOfBta15UBfiMPFl/6plsZrHM7ndppGRuaz5WBfiMLK0/8kwystiH3ccwstbQVOylMN/rypGTE4N3u542GXmx66UnVo69diKpA0JfrTG/xT6jKDK30GIUe5X1uk3H7yKQ4zt+d01rI1DsekZR/HUPxKhGQr9HBsW/e9dKHhlJDRlJDRlJjeNALNU/6LwP8L35RGQkNfbGiBBCCPEXfgBDJL201UHfZAAAAABJRU5ErkJggg==" width="16"/>

 &nbsp;Overnight stay at Hotel Vintage 3 Star</div>
</td>
  </tr>
</table>

</div>

 <div style="margin-bottom:10px; padding-bottom:20px; ">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top"><img src="https://travbizz.in/crm/b2c/package_image/download1656406280.jpg" width="203" height="147" style="border-radius: 5px; " ></td>
    <td width="90%" align="left" valign="top" style="padding-left:20px; font-size:15px;"> <div style="font-size:18px; font-weight:500; color:#000; margin-bottom:10px;"><strong>City Tour </strong> </div> <div style="margin-bottom:10px;">
 <i class="fa fa-calendar" aria-hidden="true"></i> &nbsp;01 Jul 2022 &nbsp;<i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp; 1:00 PM to 2:00 PM</div>
 
Complete full day City tour </td>
  </tr>
</table>

</div>



 <div style="margin-bottom:10px; padding-bottom:20px; ">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top"><img src="https://travbizz.in/crm/b2c/package_image/Traveller1625232460.jpg" width="203" height="147"  style="border-radius: 5px; " ></td>
    <td width="90%" align="left" valign="top" style="padding-left:20px; font-size:15px;"> <div style="font-size:18px; font-weight:500; color:#000; margin-bottom:10px;"><strong>Delhi To  Manali</strong> </div> <div style="margin-bottom:10px;">
 <i class="fa fa-calendar" aria-hidden="true"></i> &nbsp;01 Jul 2022 &nbsp;<i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp; 1:00 PM to 2:00 PM</div>
 
The first bus starts from Delhi to Manali at 16:45 and the last bus leaves from Delhi at 23:10. The minimum bus ticket booking fare is 715 and goes upto maximumFare depending on the bus type and timings. The bus journey from Manali to 16:45 is approximately 12h 55m. Daily 18 buses ply from Delhi to Manali. All zingbus buses are Premium AC Buses for a comfortable commute between Delhi to Manali. You can choose from different bus types on zingbus. They are sanitised post every trip to keep it safe for travellers.</td>
  </tr>
</table>

</div>


 



</div>
 
<div style="  padding-bottom:10px;">

<div style="padding:5px 0px; line-height:20px; font-size:14px; margin-bottom:10px;">
<div style=" padding:5px 0px; font-weight:500; line-height:20px; font-size:22px; color:#000; font-weight:600; padding-top:25px; padding-bottom:20px; position:relative;"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAABmJLR0QA/wD/AP+gvaeTAAAA20lEQVRoge2ayw6DIBBFL00/rrva/9/ZwG/YjRjSYosI4XZyT8JCHgOHiRMXAuXcADwBLGub175W9I6/MSebpJv9S/yNGHzveWj8S8ODDCUVeQAI+Ezvr5vZm3+0HY0fAEy5Bd8kchu2EjgT38fJ7m1hCXFNy/fjTHwHGHpHajLChq2MSIQNMyKCDZVfNiTChkTYuFascZm+peNYEWYyIhE2zIjoE4UNlV82JMKGGRGVXzZUftmQCBtmRFR+2ZAIGxJhIxUJw05Rj891TutArz8aWjcP4N7gMkQXXjdxqG1L7Y6IAAAAAElFTkSuQmCC" width="16"/>

 <strong>Day 2 - Rohtang Pass and Sissu</strong>
 <div style="color:#666666; position:absolute; right:0px; font-size:14px;top: 27px;">Sat, 02 Jul 2022</div>
 
 </div>
Atal Tunnel [also known as Rohtang Tunnel] is a Highway Tunnel built under Rohtang Pass in Eastern Pir Panjal Range of the Himalayas on Leh-Manali Highway in Himachal Pradesh, India. Sissu Water Fall is located on Leh–Manali Highway in Lahaul and Spiti District of Himachal Pradesh. The main source of Water Fall is the suspended glaciers on the Himalayan Range. This Water Fall is also known by Heart Shape Waterfall</div>

 <div style="margin-bottom:10px; padding-bottom:10px; ">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top"><img src="https://travbizz.in/crm/b2c/package_image/ka9a0insbt5h9e6pvlc45nrs001d1656411895.jpg" width="203" height="147"  style="border-radius: 5px; "></td>
    <td width="90%" align="left" valign="top" style="padding-left:20px; ">       <div style=" padding-top:4px; margin-bottom:4px;">
<div style="font-size:18px; font-weight:500; color:#000; margin-bottom:10px;"><strong>Hotel Vintage 3 Star</strong> - <span style="color:#FFCC00;"><i class='fa fa-star' aria-hidden='true'></i><i class='fa fa-star' aria-hidden='true'></i><i class='fa fa-star' aria-hidden='true'></i></span></div>
 
</div>

 
  

 <div style="margin-bottom:10px;"><strong>Room: </strong> 5 Triple &nbsp;&nbsp;| &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Meal: </strong> MAP</div>






<div style="font-size:15px;">Offering views of the Himalayas, this unpretentious hotel off the NH3 road is a minute&rsquo;s walk from the Beas River and 3 km from Jogini Falls.</div>

<div style="background-color: #FFFBEC; border: 1px dashed #fba309; padding: 10px; border-radius: 5px; color: #090909; margin-top: 20px; margin-bottom: 10px;"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAABmJLR0QA/wD/AP+gvaeTAAABRUlEQVRoge2YS07DMBRFDx8xY15YEu0SWEZp5xTx2RNhxgi2QcSYMoBRGeSlRK7jRCWpnXKPZMXxe7LvdfuctCCEEEIIAE6AByAH3oA7Gxsc98DKabdRFW1JzqaRPKqiLTigEF4XGwyHsQV0hYykhoykRlsjEyADPoGl9cdOzjObx3hfzauhLrnkJpCzaDFP3+26jZGJ9b+AKXBm7crGVpVdcTegT86BOfBta15UBfiMPFl/6plsZrHM7ndppGRuaz5WBfiMLK0/8kwystiH3ccwstbQVOylMN/rypGTE4N3u542GXmx66UnVo69diKpA0JfrTG/xT6jKDK30GIUe5X1uk3H7yKQ4zt+d01rI1DsekZR/HUPxKhGQr9HBsW/e9dKHhlJDRlJDRlJjeNALNU/6LwP8L35RGQkNfbGiBBCCPEXfgBDJL201UHfZAAAAABJRU5ErkJggg==" width="16"/>

 &nbsp;Overnight stay at Hotel Vintage 3 Star</div>
</td>
  </tr>
</table>

</div>

 <div style="margin-bottom:10px; padding-bottom:20px; ">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top"><img src="https://travbizz.in/crm/b2c/package_image/Rohatnga-pass-e15264713466071656412078.jpg" width="203" height="147" style="border-radius: 5px; " ></td>
    <td width="90%" align="left" valign="top" style="padding-left:20px; font-size:15px;"> <div style="font-size:18px; font-weight:500; color:#000; margin-bottom:10px;"><strong>Rohtang La</strong> </div> <div style="margin-bottom:10px;">
 <i class="fa fa-calendar" aria-hidden="true"></i> &nbsp;02 Jul 2022 &nbsp;<i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp; 1:00 PM to 2:00 PM</div>
 
Rohtang Pass is a high mountain pass on the eastern end of the Pir Panjal Range of the Himalayas around 51 km from Manali in the Indian state of Himachal Pradesh. It connects the Kullu Valley with the Lahaul and Spiti Valleys of Himachal Pradesh, India.&nbsp;</td>
  </tr>
</table>

</div>

<div style="margin-bottom:10px; padding-bottom:20px; ">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top"><img src="https://travbizz.in/crm/b2c/package_image/111017waterfalls_031656412158.jpg" width="203" height="147" style="border-radius: 5px; " ></td>
    <td width="90%" align="left" valign="top" style="padding-left:20px; font-size:15px;"> <div style="font-size:18px; font-weight:500; color:#000; margin-bottom:10px;"><strong>Sissu Waterfall</strong> </div> <div style="margin-bottom:10px;">
 <i class="fa fa-calendar" aria-hidden="true"></i> &nbsp;02 Jul 2022 &nbsp;<i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp; 1:00 PM to 2:00 PM</div>
 
Sissu Falls is on a diversion on the road from Leh to Manali in Lahaul and Spiti District, Himachal Pradesh. The falls is about 20 minutes drive from the diversion on the road. It is near the village of Gramphu, which is near Manali. The place is magnificent with dense green vegetation and beautiful scenery. The falls can be seen from the road to Manali and visitors are attracted to this place by the beauty surrounding the falls. The source of water is the suspended glaciers on the Himalayan range.</td>
  </tr>
</table>

</div>



 
 



</div>
 
<div style="  padding-bottom:10px;">

<div style="padding:5px 0px; line-height:20px; font-size:14px; margin-bottom:10px; ">
<div style=" padding:5px 0px; font-weight:500; line-height:20px; font-size:22px; color:#000; font-weight:600; padding-top:25px; padding-bottom:20px; position:relative;"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAABmJLR0QA/wD/AP+gvaeTAAAA20lEQVRoge2ayw6DIBBFL00/rrva/9/ZwG/YjRjSYosI4XZyT8JCHgOHiRMXAuXcADwBLGub175W9I6/MSebpJv9S/yNGHzveWj8S8ODDCUVeQAI+Ezvr5vZm3+0HY0fAEy5Bd8kchu2EjgT38fJ7m1hCXFNy/fjTHwHGHpHajLChq2MSIQNMyKCDZVfNiTChkTYuFascZm+peNYEWYyIhE2zIjoE4UNlV82JMKGGRGVXzZUftmQCBtmRFR+2ZAIGxJhIxUJw05Rj891TutArz8aWjcP4N7gMkQXXjdxqG1L7Y6IAAAAAElFTkSuQmCC" width="16"/>

 <strong>Day 3 - Manali - Baralacha La</strong>
 <div style="color:#666666; position:absolute; right:0px; font-size:14px;top: 27px;">Sun, 03 Jul 2022</div>
 
 </div>
Baralacha La, better known as Baralacha pass is situated in the Zanskar range. It is a high mountain pass located along the Leh-Manali highway that connects Leh district in Ladakh and Lahaul district in Himachal Pradesh. The barren sceneries without any obstructions of shops or hotels here look truly beautiful to the onlookers.</div>

 
 <div style="margin-bottom:10px; padding-bottom:20px; ">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top"><img src="https://travbizz.in/crm/b2c/package_image/s2x8d9yqw3e7x1czd1vgei3k5qp3_1581764235_Baralacha_la1656412488.jpg" width="203" height="147" style="border-radius: 5px; " ></td>
    <td width="90%" align="left" valign="top" style="padding-left:20px; font-size:15px;"> <div style="font-size:18px; font-weight:500; color:#000; margin-bottom:10px;"><strong>Baralacha La</strong> </div> <div style="margin-bottom:10px;">
 <i class="fa fa-calendar" aria-hidden="true"></i> &nbsp;03 Jul 2022 &nbsp;<i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp; 1:00 PM to 2:00 PM</div>
 
The best time to visit and enjoy the ride through the Baralacha La is from the months of April to October. In these months, the snow melts and the Baralacha La is considered safe for tourists who can travel and enjoy the scenic beauty of the place.</td>
  </tr>
</table>

</div>



 <div style="margin-bottom:10px; padding-bottom:20px; ">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top"><img src="https://travbizz.in/crm/b2c/package_image/Traveller1625232460.jpg" width="203" height="147"  style="border-radius: 5px; " ></td>
    <td width="90%" align="left" valign="top" style="padding-left:20px; font-size:15px;"> <div style="font-size:18px; font-weight:500; color:#000; margin-bottom:10px;"><strong>Barah Laha To Delhi</strong> </div> <div style="margin-bottom:10px;">
 <i class="fa fa-calendar" aria-hidden="true"></i> &nbsp;03 Jul 2022 &nbsp;<i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp; 1:00 PM to 2:00 PM</div>
 
There is no direct connection from New Delhi to Bara-lacha la. However, you can take the Metro to Airport, take the walk to Delhi airport, fly to Dharamsala, then take the drive to Bara-lacha la. Alternatively, you can take the Metro to Airport, take the walk to Delhi airport, fly to Leh, then take the taxi to Bara-lacha la.</td>
  </tr>
</table>

</div>


 



</div>
</div>



<div style="padding:70px 50px 0px;">
<div style="font-size:25px; font-weight:600; margin-bottom:10px; padding-bottom:20px; ">
<div style=" padding:20px; border:1px solid #ddd; margin-bottom:30px;   ">
<div style="font-size:25px;  margin-bottom:30px; ">

 Inclusions & Exclusions</div>
<div style="font-size:14px;"><p><span class="JsGRdQ" style="color: #222222;"><strong>Inclusions:</strong>&nbsp;</span></p>
<ul>
<li><span class="JsGRdQ" style="color: #222222;">Stay on sharing basis as per the plan</span></li>
<li><span class="JsGRdQ" style="color: #222222;">All Meals starting from Lunch on Day One to Breakfast on Last Day.</span></li>
<li><span class="JsGRdQ" style="color: #222222;">Jungle Safaris with an expert forest guide.</span></li>
<li><span class="JsGRdQ" style="color: #222222;">Transfer from Nagpur</span></li>
<li><span class="JsGRdQ" style="color: #222222;">5% GST Included</span></li>
</ul>
<p><span class="JsGRdQ" style="color: #222222;"><strong>Exclusions:</strong>&nbsp;</span></p>
<ul>
<li><span class="JsGRdQ" style="color: #222222;">Any other services or meals which are not mentioned in the above "Includes" section.</span></li>
<li><span class="JsGRdQ" style="color: #222222;">Expense of personal nature such as mineral water, laundry, telephones, beverages etc.</span></li>
<li><span class="JsGRdQ" style="color: #222222;">Any tips to the Safari Driver or Guide at&nbsp;</span>your will.</li>
<li><span class="JsGRdQ" style="color: #222222;">Camera Charges if any. (Depends upon the Sizes of the Lens)</span></li>
<li><span class="JsGRdQ" style="color: #222222;">Travel cost up to Nagpur from your Residence.</span></li>
</ul></div>
</div>
<div style=" padding:20px; border:1px solid #ddd; margin-bottom:30px; ">
<div style="font-size:25px;  margin-bottom:30px; ">

 Payment Policy & Our Scope of Services</div>
<div style="font-size:14px;"><table border="1" width="100%" cellspacing="0" cellpadding="5">
<tbody>
<tr>
<td align="left" width="50%"><strong>Beneficiary's Name</strong>:</td>
<td align="left" width="50%">TravBizz</td>
</tr>
<tr>
<td align="left"><strong>Bank Name:</strong></td>
<td align="left">ICICI Bank</td>
</tr>
<tr>
<td align="left"><strong>Account No.:</strong></td>
<td align="left">073605500265</td>
</tr>
<tr>
<td align="left"><strong>RTGS/NEFT IFSC CODE:</strong></td>
<td align="left">ICIC0000736</td>
</tr>
<tr>
<td colspan="2" align="left">&nbsp;</td>
</tr>
<tr>
<td colspan="2" align="left"><strong>Google Pay/ UPI:&nbsp;</strong>travbizz@icici</td>
</tr>
<tr>
<td colspan="2" align="left"><strong>PAN NO.</strong>&nbsp;BROPG7360P<br /><br /></td>
</tr>
</tbody>
</table>
<p>&nbsp;</p></div>
</div>
<div style=" padding:20px; border:1px solid #ddd; margin-bottom:30px;   ">
<div style="font-size:25px;  margin-bottom:30px; ">

 Useful Tips Before Booking</div>
<div style="font-size:14px;"><ul>
<li>If your flights involve a combination of different airlines, you may have to collect your luggage on arrival at the connecting hub and register it again while checking in for the return journey to your origin.</li>
<li>For queries regarding cancellations and refunds, please refer to our Cancellation Policy.</li>
<li>Extra Charges for A/C if running in Hills</li>
<li>Hatchback will be Alto/ Similar as per availability</li>
<li>Sedan will be Dzire/ Similar as per availability</li>
<li>SUV will be Sumo/ Innova as per availability</li>
<li>Disputes, if any, shall be subject to the exclusive jurisdiction of the courts in Kullu/ Manali.</li>
<li>We reserve the right to issue a full refund in case we believe that we are unable to fulfil the services for any technical reasons.</li>
</ul></div>
</div>
<div style=" padding:20px; border:1px solid #ddd; margin-bottom:30px;  ">
<div style="font-size:25px;  margin-bottom:30px; ">

 Cancellation Policy & Airline Cancellation Policy</div>
<div style="font-size:14px;"><ul style="list-style-type: square;">
<li>Date of booking to 30 days before travel the cancellation charges will be 25% of the tour cost</li>
<li>30 to 15 days before travel - cancellation charges will be 50% of the tour cost</li>
<li>15 to 7 days before travel - cancellation charges will be 75% of the tour cost</li>
<li>0 to 7 days before travel - cancellation charges will be 100% of the tour cost. No refund shall be given</li>
<li>Please Note: Cancellation policy is subject to change. It depends on the hotel policy.</li>
<li>In peak season (example: long weekends, festival season, summer vacation etc.) most of the hotels charge 100% cancellation</li>
</ul>
<h3><strong>Airline Cancellation Policy:</strong></h3>
<ul style="list-style-type: square;">
<li>Your flights are non-refundable. In the event of cancellation, you will not get any refund for flights.</li>
</ul></div>
</div>



<div style=" padding:20px; border:1px solid #ddd;   ">
<div style="font-size:25px;  margin-bottom:30px; ">

 Terms and Conditions
</div>
<div style="font-size:14px;"><ul style="list-style-type: square;">
<li>Airline seats and hotel rooms are subject to availability at the time of confirmation.</li>
<li>In case of unavailability in the listed hotels, arrangement for an alternate accommodation will be made in a hotel of similar standard.</li>
<li>There will be no refund for unused nights or early check-out (In case of Medical condition it completely depends on hotel policy).</li>
<li>Check-in and check-out times at hotels would be as per hotel policies. Early check-in or late check-out is subject to availability and may be chargeable by the hotel.</li>
<li>The price does not include expenses of personal nature, such as laundry, telephone calls, room service, alcoholic beverages, mini bar charges, tips, portage, camera fees etc.</li>
<li>Travelling Bee reserves the right to modify the itinerary at any point, due to reasons including but not limited to: Force Majeure events, strikes, fairs, festivals, weather conditions, traffic problems, overbooking of hotels / flights, cancellation / re-routing of flights, closure of / entry restrictions at a place of visit, etc. While we will do our best to make suitable alternate arrangements, we would not be held liable for any refunds/compensation claims arising out of this.</li>
<li>In case a flight gets cancelled, Travelling Bee will not be liable to provide any alternate flights within the same cost, any additional cost incurred for the same shall be borne by the traveler.</li>
<li>In Case of any Health Issues Travelling Bee will not be liable to provide any refunds and in case of Medical Emergencies all the medical expenses will be liable by the customer.</li>
</ul></div>
</div>

</div>
</div>

 
   
    </div>

    <!-- Include html2pdf bundle. -->
    <script src="html2pdf.js-master/dist/html2pdf.bundle.js"></script>

    <script>
      // Pagebreak fields:  mode, before, after, avoid
      // Pagebreak modes:   'avoid-all', 'css', 'legacy'

      function test() {
        // Get the element.
        var element = document.getElementById('root');

        // Choose pagebreak options based on mode.
        var mode = document.getElementById('mode').value;
        var pagebreak = (mode === 'specify') ?
            { mode: '', before: '.before', after: '.after', avoid: '.avoid' } :
            { mode: mode };

        // Generate the PDF. 
        html2pdf().from(element).set({
          filename: mode + '.pdf',
          pagebreak: pagebreak,
          jsPDF: {orientation: 'portrait', unit: 'in', format: 'letter', compressPDF: true}
        }).save();
      }
    </script>
  </body>
</html>
