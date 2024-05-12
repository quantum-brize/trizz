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
      
     
    </style>
  </head>

  <body>
 

    <!-- Div to capture. -->
     

<img src="<?php echo $fullurl; ?>package_image/<?php echo str_replace(' ','%20',$result['coverPhoto']); ?>" height="400" style="width:100%; height:400" />
<div style="page-break-after: always; padding-top:30px;"><div style="font-size:25px; font-weight:600; margin-bottom:10px;"><?php echo stripslashes($result['name']); ?></div>
  <table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-size:16px;">
    <tr>
      <td style="padding:5px 0px;"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAABmJLR0QA/wD/AP+gvaeTAAABfUlEQVRIieXWPUscURTG8d8qamyUWJldsU5K8ROYPr4QsAsI6UO6FSVfJzYioo0h3yBBfAExabQwhWKhQYgoihYzC8tm2HtndtTCB05z7zznfzhzODM8N1VyPDuEaUziNUbS8z/YxxpWcVZWcf1YxF/cBeIcC6mnI1XxIwLYGlsYLQodkbQxL7QRR6jlhfZjswNoI37iRR7wlxKgjZiPhQ6JG6TYOMfLVkhXBngGA7FVRmgQUzHgd4FE16hLBqcmaeV1wDMZUaDf2reunuGpBzy/YsAXgSSvMjzDAc9FqyGr1T2BwrLWbHfA8999Fvg4kORD5FmzTgL3YEX7tl1J3mk1jXp61s6zHAOeDSQpEu9jwH04LRF6gt4YMHwsETwXCyWZ3O8lQDfk+9lAsjZ3OoDuydjRsaphtwB0WzLxHWkQ6zmgq0r8yFTwGZdtgP/wSYF3GqM3OMyAHqR3D6px3DZBbzD20NCGlprAXx8LCm+bwBOPCa7gm4IL4kl1D6g+L/ymwoEkAAAAAElFTkSuQmCC" width="32"/></td>
      <td width="99%" style="padding:5px 0px; padding-left:10px;"><?php echo stripslashes($result['destinations']); ?> - <?php echo round($result['days']-1); ?> nights, <?php echo stripslashes($result['days']); ?> days</td>
    </tr>
    <tr>
      <td style="padding:5px 0px;"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAABmJLR0QA/wD/AP+gvaeTAAABS0lEQVR4nO2aQU7DMBBFH5QNVyjdAeIGHIFbsOUK3KYn6m2QKiqQyiIsUTp2xvkO+U+KFEX25OfbHjuJwRhjjDFr5SpQ5jwxVrR+q7ijz3hdpmWU7R/X7jqOC+Qa8Bq81kvcMOfgcQLeGVps+3t+KqjfKu4omTmgV2bLAYvEBqgFqLEBagFqbIBagDFaIivBL+ADOAKfwENTRTNTsxSO1FFyz9BQR4aG+x4r/B8NKNK7+lnABqgFqLEBagFqbhrEjGbh7HJVrL4H2AC1ADUtckB0jGaXq2L1PcAGqAWoycwBl/4gdfkW6R4gvLdXgj1gA9QC1ChzgFeCDXgurZDZAxTz/AbYAY/AC/BWGkA5BKZyy/DtfxJLHgJPGUGWbEDxeK+laNvZTGyAAwnb5CL0ZsAO2JO0T7AmCfZgQhpLzgEp2AC1AGOMMcYYFT9T02E5130aiAAAAABJRU5ErkJggg==" width="32"/></td>
      <td style="padding:5px 0px; padding-left:10px;"><?php echo date('j M Y',strtotime($result['startDate'])); ?> <strong>to</strong> <?php echo date('j M Y',strtotime($result['endDate'])); ?></td>
    </tr>
    <tr>
      <td style="padding:5px 0px;"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAABmJLR0QA/wD/AP+gvaeTAAADhklEQVR4nO2azUtVQRjGf5kpEhFaGX0R1MZF/QFJRItKSaMIyW1aQkEFbSUKiiCKdv0TIdIXhIvaZZD2hUFqEYG5sBaltwumlraYudyr3Jnz3nPP3LnWPPBsznnfeZ/3nXNm5swcCAgICCgd6oFrwBsgDSxopoHX+t4Gb+ocow1IkU3axCnguCeNztAGzBOdfIZ/+IeKUI+s55dyEljvWlyF6wDAeWBNDL+1wLmEtXjBWwrv/QxfedCbOH4SvwAp1+JWuA6ASqQYONVYijGgrBEK4FuAb4QCxPBpBQaAGc0BoCVJUeWsoxXzlHXM4BN3CswwKR2JYNAS+IXBx0UB4uhIBDOWwL8MPi4KEEdHXhQ6BlRZ7lUbrqcLjJGLqQR15EUpZoGXnnydIM7jekTgZ+LhBHUkgjlL0DmL33WLn4lXHegoGs8tgfsjfFuAp9g3R1LAE8w9n4SOotCgg+f2wJy+1uAycJnqCAj4n1ALnAIeAaOo1Vga+Aw8ALq0TSl0nNExvwDTWscocA/oTFpHDXCJxSc5tlH8RJ42VgPNwA3gIeoU6Btqv/A7MA6MAL3AZeAoald4KdqRbbFPAt1ae1HYBgwJAi4AE0AH2dVlJepwow/72t3EaVRB2sgubytQPTwhbGMQ2Bo3+e2onpEEukv2EGMVcLEAXwnHgNOooqJj9Qh9x+MUoQa1Jx/V+CyLDy8OAsMJJr6UH4CmnHgXsK8Kc5+Egl6HK4JG08ABbV8F3HGYeC7ngVtkvwgPIRufuqXJr0N9htoaSwF7tf0m4FmJks/lALBRa9hH9AHMD4SzQ1dEQ79RX3gAW4BPHpLPcATYrLU0E/06dEgKcD+ikbParh6377uUw6inENR4ZLPtlRTgo6WBHm1Tjdqs8J18hv2o2QedpMluVFIA07v0FajTNrfLIOmlvKm11aEWWflsRIetpgAn9f0mCvvbo1ScJztFdlrsYhVgCHVKW4mai30na+J7YCVqxfguyQJk1vdRM0Q5sFNrbY9bABMqUEtS3wlGcQxHu92NZZCclI0uCtBXBolJ+Tjp5GtRHz6+E5NyBuGyV/qu7Ce70FgOqEJ9H0RCWoA98bV4g2gckBZgdxFCfGGXxEhagB1FCPGFnRIjaQGW4y/sIs3SnxBnWV6DICjNkf8KSAuwUJwWb4jML/wm51uAb4QC+BbgG6EAvgUEBAQE+MRf4zQr1ajhlicAAAAASUVORK5CYII=" width="32"/></td>
      <td style="padding:5px 0px; padding-left:10px;">Adults (Above 12 Years) : <?php echo stripslashes($result['adult']); ?> | Child (5-12 Years) : <?php echo stripslashes($querydata['child']); ?> Child (0-5 Years) - <?php if($querydata['infant']>0){ echo stripslashes($querydata['infant']); } else { echo '0'; } ?></td>
    </tr>
    
    
    <tr>
      <td colspan="2" style="padding:5px 0px;"><div style="margin-top:10px; padding-top:15px; padding-bottom:10px; text-align:center; border-top:1px solid #ddd; ">
 <div  ><div style="font-size:22px; color:#000; "><strong><?php if($result['billingType']==2){ ?>
       Cost Per Person Cost<?php } ?><?php if($result['billingType']==1){ ?>Total Cost <?php } ?></strong></div>
       
       <div style="font-size:30px;  color:#000; "><?php if($result['billingType']==2){ ?><strong>&#8377;<?php echo number_format($result['grossPrice']); ?></strong><?php } ?>
	   
	   <?php if($result['billingType']==1){ ?><strong>&#8377;<?php echo number_format($result['grossPrice']); ?></strong>  <?php } ?>
	   
	   <div style="  margin:10px 0px; color:#999999; font-size:13px;line-height: 20px;"><i>Note: All  prices are subject to change without prior notice as per availability, <br />
       the final date of travel and any
changes in taxes.</i></div>
	   </div>	
</div>
 </div></td>
    </tr>
    
    <tr>
      <td colspan="2" align="center" style="padding:10px 0px; font-size:13px;line-height: 20px; line-height:25px;"><img src="<?php echo $fullurl; ?>profilepic/<?php  echo $invoicedataa['invoiceLogo']; ?>" style="height:40px; width:auto; margin-bottom:10px; " /><br />
<strong><?php echo stripslashes($packagecreator['firstName']); ?></strong><br />
<?php echo strip($packagecreator['email']); ?><br />
+<?php echo strip($packagecreator['countryCode']); ?> <?php echo strip($packagecreator['mobile']); ?></td>
    </tr>
    <tr>
      <td colspan="2" align="center" style="padding:10px 0px;"></td>
    </tr>
  </table>
</div>
 


<div style="page-break-after: always;">
<?php  
$rsa=GetPageRecord('*','sys_packageBuilderEvent',' packageId="'.$result['id'].'" and sectionType="Flight"  order by sr, time(checkIn) asc');
$eventDataflight=mysqli_num_rows($rsa);
if($eventDataflight>0){
?> 
<div style="font-size:25px; font-weight:600; margin-bottom:10px; padding-bottom:20px; ">

 <table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-size:25px; ">
  <tr>
    <td colspan="2"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAABmJLR0QA/wD/AP+gvaeTAAAEHUlEQVR4nO3aWYhWZRzH8c+M07hRQjUGRaCVXSRtgpVM0GaLLRdCJFpkRBlCFGRU4EVSRNZNUV0odRFkgW1Q0kWpVBhRmVHRQosVlC0SZU2RuMx08cybZ8bzznues7wzQ+cL/5v3Pef/+/+ec973Wampqampqan5v9Ix2gUUYBpuwMXowU5sxRr8MIp1tYXzBcMDKbEHN41eadVzLnZLN5+M5VmSFfkJdGAB5mMyvsXr2Ib+AnlH4lS8Kbz+rejDbHxfRSHTsUV6y+/EOizBkSVqzsSPTTSbxe0l6v/HUfgsYwH78S5W4Ux05tScji8zaiZjQ069EQv5JEchjfgVz2IZjs6oOQVv59R7tYDXg4h58lnfjvdwD+ZhQopmN14roLGuNPc4Cx8UNN3q7bg/odeJpwvmvLLMBmgUtQTbK2iAnTgxofVQwXwfY2LZDdCgGzfj54JFNqIPcxP57yyYb5fQBVbO1MFidxUodg8uSeS8RhhH5M33E06vxm5zjsBq/BNZbD+WJvJchr2ROZKxHSdU5jIDx2It9slW8G2Je8/AXxnvS4utQjc9JjhJ6O9HKviBxPWz8EuL60eKzTisYk+5mCeM3YcXvM6Becgx+C7lmqzxvAr/7ctiPj4SCn4Fhwx+Pg0fym/+EfmH121nAhYLPQdhBvmWfMb7cUcbay+dCXhBPvP7hJWgcUsHnpDP/N+4NJFrqnHIffKZ/w29iTxzheHuuFrXXC6f+R04OZHnAvw5+N1pbaq9MIuEKXCs+U+FAVaDq4Xhc+P7u9pTfjHOk20hc3i8Y+iy2q0ObsQ32uKgAKfgd/HmXxa6SsLvfFWT6/bKtkg6KhwnzM5izT+JrsEcXVr3Ggvb4iaSHnwh3vxqB/7Zpwgjx1b3rG2HoRgOFfYHYoz3Y0Uix+GyjxQrWfvPSzc2iTO/G1cNy7MoMkdbVoBa0Yn14grvw0UpuTrwfkSeFSk5SuF4wdRTuB4zmlzXhccjCh7QevnqwohcG3P6a8mGFLHtgtmlwtNbLn5a+5XQuK3Iui+wW0Vzg9inmiW2CRstWZgj+wjy8iJGmzEZd2u+Hx8bG4VeIoasGySP5bOYjYm4VrHtsRcxKYf2DNmG0t/kchZJJ64Qv5rzqGLLVw9n1JlVQCOaXuGptvqN3luCVg/+aKEzgFtK0IrmHOFgUlpBm5W3aLGyiUYySj8TkJVe6Rsii0vUmKr1KZG2/A8045mUgnpHvCOeZSkaY6YB5qQUVOYbQBhxfp6i04jnStaLZrOhBa2pQGOhdPP7lf/GRbPA0KK+rkCjQ/q5oZUVaOVi+LxgZgUaZw/TeLACjdxcZ2hxN1ak85IxaJ6wKLLDgQZYX5HObOGU2Zgkec5n0yjXMipMEs4BbBFOidbU1NTU1NTUjCn+BTtCslhCOTo2AAAAAElFTkSuQmCC" width="32"/></td>
    <td width="99%" style="padding-left:10px;"><strong>Flights</strong></td>
  </tr>
</table>
</div>
<div style="margin-bottom:60px;">
<?php  
$rs=GetPageRecord('*','sys_packageBuilderEvent',' packageId="'.$result['id'].'"  order by sr, time(checkIn) asc');
while($eventData=mysqli_fetch_array($rs)){ 
?> 
<?php if($eventData['sectionType']=='Flight'){ ?>
<div style="margin-bottom:10px; margin-top:20px;">
<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAABmJLR0QA/wD/AP+gvaeTAAABS0lEQVR4nO2aQU7DMBBFH5QNVyjdAeIGHIFbsOUK3KYn6m2QKiqQyiIsUTp2xvkO+U+KFEX25OfbHjuJwRhjjDFr5SpQ5jwxVrR+q7ijz3hdpmWU7R/X7jqOC+Qa8Bq81kvcMOfgcQLeGVps+3t+KqjfKu4omTmgV2bLAYvEBqgFqLEBagFqbIBagDFaIivBL+ADOAKfwENTRTNTsxSO1FFyz9BQR4aG+x4r/B8NKNK7+lnABqgFqLEBagFqbhrEjGbh7HJVrL4H2AC1ADUtckB0jGaXq2L1PcAGqAWoycwBl/4gdfkW6R4gvLdXgj1gA9QC1ChzgFeCDXgurZDZAxTz/AbYAY/AC/BWGkA5BKZyy/DtfxJLHgJPGUGWbEDxeK+laNvZTGyAAwnb5CL0ZsAO2JO0T7AmCfZgQhpLzgEp2AC1AGOMMcYYFT9T02E5130aiAAAAABJRU5ErkJggg==" width="16"/> &nbsp;<strong><?php echo date('d M Y',strtotime($eventData['startDate'])); ?></strong></div>
 <div style="margin-bottom:10px; padding:20px; border:1px solid #ddd; background-color:#F7F7F7; ">
 
 <table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"   width="150"><?php echo  date('g:i A',strtotime($eventData['checkIn'])); ?><br />
      <strong><?php echo  stripslashes($eventData['fromDestination']); ?></strong></td>
    <td align="center" style="width:100px;"><?php if($eventData['flightDuration']!=''){ ?><div style="text-align:center; font-size:11px; color:#666666;padding-bottom: 4px;"><?php echo stripslashes($eventData['flightDuration']); ?></div><?php } ?><div style="font-size:0px; border-top:2px solid #ddd; position:relative;"><i class="fa fa-plane" aria-hidden="true" style="position: absolute; font-size: 18px; transform: rotate(45deg); top: -9px; left: 40%;"></i></div></td>
    <td align="center"   width="150"><?php echo  date('g:i A',strtotime($eventData['checkOut'])); ?><br />
      <strong><?php echo  stripslashes($eventData['toDestination']); ?></strong></td>
  </tr>
</table>
 
 
 </div>
 
<?php } ?>
<?php } ?>

</div>
<?php } ?>

<?php  
$rsa=GetPageRecord('*','sys_packageBuilderEvent',' packageId="'.$result['id'].'" and sectionType="Accommodation"  order by sr, time(checkIn) asc');
$eventDataflight=mysqli_num_rows($rsa);
if($eventDataflight>0){
?> 
<div style="font-size:25px; font-weight:600; margin-bottom:10px; padding-bottom:20px; ">

 <table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-size:25px; ">
  <tr>
    <td colspan="2"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAABmJLR0QA/wD/AP+gvaeTAAAD90lEQVR4nO2bP2wcRRSHvzeHkC3Z/CmRq9iBAiklCOTN5YqjACVVKmxT0CV0QEEZU1LRhRIkiOlJQEh2sXEuQYgOiQrHoSCILgIs5YTieRR76927ZO9m7m5294w/aeXZ2Teemee537y3Nxb6eQ14HXiaavgXuAP8WHbHzwHfAVqT6wbwbNAZD1CnyafX9aAz7iEky/6H3r0FtoD7ZXT+BJaA9d64AF4Ffgrd6YdkXv8ydGcOfEU2nvdDd2aAxdz93dAdOrCXKwfXARO6g7rzv3fAU1UPYASrwEce9t5xhKsDDLDWK18jEahp1hfR7l2+fEuym/zlYrxJprqbBTYbOZv1APVF4wkeR7iugNO58osB6ou4DXQc7FLyccR54BVGxBF114AdildlEUK2uiJGOOA47gJeccRxdIAXs+SA08AH9OuIIRHWDbL8wQtXDcgvq18D1LvwPbACXAJe6tWtkeUvSrK1euHqgHTPVuDrAPUurPR+TrKrPIarA4q8O636ypglDQjCiQM87J6kttOqdyEV0GmJKuCuAUVqO616F94ELgDf5OomEVWg/rlAnj3g04G6iUX1RAOqHkDVzJIDKg2F60CQUNh1BdQhF6g0FK5DLhCEk1yg6gFUzSw5oNJQuKrvBfJUGgrXIReoNBQuMxeYdFl7ta9jIDTpsvZqX0cHTLqsvdrXxgFR1F1uNA7bqvp8yH5E5IGq2d7dnb8HNXHAuXMH76o+uqrKXOi+VBU47J49e3D51q2FLyrPBaKou6zKVQg/+RxzInzWbD48VXkuYMzhG5Q7+ZQ5EduuQS5gXxgzlZ8YVbtUCw0IhBVhC0C17+xhH8fWASJs3by58A5As3mQPzPQxywlQ16oau7Mo+4V2R1bB7gyAx8B3Qd2QB74tDJGnM4W+abDSz6DGMJ9HNJhVT5vNBbei2PpTqnfxxgnHZ4WI2J23Q89eRjvq7Gy2E4n32wenAHeKjI0xt6O42c6AK3WPy1raRlDHMeL8ahOxtGAwbN7EcmRVp9nPzM6Vf0zK+pFkCtFhtbKx+nvtpYWyBVrFSCIAwbP7m2STdLnmTPGSMdaPhn2PCsTW6sYM3ryMBO7AMTxwg6JAx1sF2Mc/vIpJ3FA1QNwodX6O7LWrI62zMgL4zBmwgHWShsoFMGCNkfCOIzafgREZCV3570Nu7av7QpQZb2XxQnwdqj2tXUA/cfeg7UfdEDR/+isDrEZ59lRLiBi/kheVJaPqvldSIITL4GZEhvAtSjqLhvz6BfKfy/YhcbLhv43taXT6cztq3I5GVBpdIFLu7vz91KRWAPOlDiANBc4WvvN5sNTIratqivFzSZHRO6KmO04nv8N4D8snPatoEGoJAAAAABJRU5ErkJggg==" width="32"/>

</td>
    <td width="99%" style="padding-left:10px;"><strong>Hotel</strong></td>
  </tr>
</table>
</div>

  <?php  
$rs=GetPageRecord('*','sys_packageBuilderEvent',' packageId="'.$result['id'].'"  and  sectionType="Accommodation" order by startDate asc');
while($eventData=mysqli_fetch_array($rs)){ 
?>
<div style="margin-bottom:10px; padding-bottom:20px; ">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top"><img src="<?php echo $fullurl; ?>package_image/<?php  if($eventData['eventPhoto']!=''){ echo $eventData['eventPhoto']; } else {   if($eventData['sectionType']=='Transportation' ){ echo 'notransfer.png'; }if($eventData['sectionType']=='Activity' ){ echo 'noactivity.png'; }if($eventData['sectionType']=='Meal' ){ echo 'nomeal.png'; } }?>" width="203" height="147"  style="border-radius: 5px; "></td>
    <td width="90%" align="left" valign="top" style="padding-left:20px; "> <?php if($eventData['sectionType']=='Accommodation'){ ?>
      <div style=" padding-top:4px; margin-bottom:4px;">
<div style="font-size:18px; font-weight:500; color:#000; margin-bottom:10px;"><strong><?php echo stripslashes($eventData['name']); ?></strong> - <span style="color:#FFCC00;"><?php echo starcategory($eventData['hotelCategory']); ?></span></div>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style=" font-size:14px;">
  <tr>
    <td colspan="2"><div style="margin-bottom:10px;">
 
<div style="margin-bottom:5px; font-weight:700;">Check-in: <?php echo date('d M Y',strtotime($eventData['startDate'])); ?> - <?php echo  date('g:i A',strtotime($eventData['checkIn'])); ?></div>
</div></td>
    <td><div style="margin-bottom:10px;"> 
<div style="margin-bottom:5px; font-weight:700;">Check-out: <?php echo date('d M Y',strtotime($eventData['endDate'])); ?> - <?php echo  date('g:i A',strtotime($eventData['checkOut'])); ?></div>
</div></td>
  </tr>
</table>
</div>

<?php if($eventData['singleRoom']>0){ ?>
 
<div style="margin-bottom:10px; font-size:"><strong>Room: </strong> <?php echo $eventData['singleRoom']; ?> Single &nbsp;&nbsp;| &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Meal: </strong> <?php echo stripslashes($eventData['mealPlan']); ?>&nbsp;&nbsp; | &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Room Type: </strong> <?php echo stripslashes($eventData['hotelRoom']); ?></div>
 
 <?php } ?>
 
  <?php if($eventData['doubleRoom']>0){ ?>
 
 <div style="margin-bottom:10px;"><strong>Room: </strong> <?php echo $eventData['doubleRoom']; ?> Double &nbsp;&nbsp;| &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Meal: </strong> <?php echo stripslashes($eventData['mealPlan']); ?>&nbsp;&nbsp; | &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Room Type: </strong> <?php echo stripslashes($eventData['hotelRoom']); ?></div>
 <?php } ?>


<?php if($eventData['tripleRoom']>0){ ?>
 <div style="margin-bottom:10px;"><strong>Room: </strong> <?php echo $eventData['tripleRoom']; ?> Triple &nbsp;&nbsp;| &nbsp;&nbsp;<strong><i class="fa fa-cutlery" aria-hidden="true"></i> Meal: </strong> <?php echo stripslashes($eventData['mealPlan']); ?></div>
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
<?php } ?><div style="font-size:13px;line-height: 20px;"><?php echo strip_tags(stripslashes($eventData['description'])); ?></div></td>
  </tr>
</table>

</div>

<?php } ?>

<?php } ?>
</div>



<div style=" ">




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
</div>



<div >
<div style="font-size:25px; font-weight:600; margin-bottom:10px; padding-bottom:20px;margin-top:40px; ">
<?php 
$rsa=GetPageRecord('*','sys_PackageTips',' packageId="'.$result['id'].'"   order by id asc');
while($packageTipsData=mysqli_fetch_array($rsa)){ 
?>
<div style=" padding:20px; border:1px solid #ddd; margin-bottom:20px; page-break-inside:avoid; page-break-after:auto; margin-top:20px;">
<div style="font-size:25px;  margin-bottom:30px; ">

 <?php echo stripslashes($packageTipsData['title']); ?>
</div>
<div style="font-size:14px;"><?php echo stripslashes($packageTipsData['description']); ?></div>
</div>
<?php } ?>



<div style=" padding:20px; border:1px solid #ddd;  page-break-inside:avoid; page-break-after:auto; margin-top:40px; ">
<div style="font-size:25px;  margin-bottom:30px; ">

 Terms and Conditions
</div>
<div style="font-size:14px;"><?php echo (stripslashes($result['terms'])); ?></div>
</div>

</div>
</div>
 
	
 
  </body>
</html>

<script>
  window.print();
 </script>
