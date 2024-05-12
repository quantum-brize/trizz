<?php 

include "inc.php"; 

$whereapp='';

if(trim($_REQUEST['searchevent'])!=''){

$whereapp=' and name like "%'.trim($_REQUEST['searchevent']).'%"';

}

?>







 <?php if($_REQUEST['destinationNameload']!='' && $_REQUEST['eventsection']=='DayItinerary'){ ?>



<?php

$n=1; 

$where=' status=1 and destination in (select id from cityMaster where name="'.trim($_REQUEST['destinationNameload']).'" and status=1) '.$whereapp.' order by name asc';  

$rs=GetPageRecord('*','dayItineraryMaster',$where); 

while($eventData=mysqli_fetch_array($rs)){  



?>

<div class="daydetailsbox">

<table width="100%" border="0" cellpadding="0" cellspacing="0">

  <tr>

    <td colspan="2"><div class="eventimgclass"  style="width: 50px; height: 50px;"><img style="width:100%;" src="<?php if($eventData['eventPhoto']!=''){ echo $fullurl.'package_image/'.$eventData['eventPhoto']; } else { ?>data:image/png;base64,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<?php } ?>">





	

	 

	

	</div></td>

    <td width="90%"style="padding-left:10px;"><div class="eventheading" style="margin-bottom:0px;"><?php echo strip($eventData['name']); ?></div><div><span style="color:#999999;; "><?php echo substr(stripslashes($eventData['details']),0,40); ?>...</span></div></td>

    <td width="10%">

	<div class="addeventbtnn" onclick="loadpop('Day <?php echo $_REQUEST['dayloader']; ?> Details',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=editDayDetails2&pid=<?php echo $_REQUEST['loadp']; ?>&d=<?php echo $_REQUEST['dayloader']; ?>&date=<?php echo $_REQUEST['fromdateload']; ?>&dayitid=<?php echo $eventData['id'] ;?>" ><i class="fa fa-plus" aria-hidden="true"></i></div>

	

	</td>

  </tr>

</table>





</div>

<?php $n++; } ?>







 <?php } ?>

 

 

 

	



<?php if($_REQUEST['destinationNameload']!='' && $_REQUEST['eventsection']=='Accommodation'){ ?>



<input type="button"  style="padding: 10px; color: #fff; background-color: #23ae73; outline: 0px; height: 46px; width: 100%; box-sizing: border-box; margin: 15px 0px; margin-top: 0px; border-radius: 4px; border: 0px; font-size: 16px; cursor:pointer;" value="+ Add Accommodation Manually" onclick="loadpop('Accommodation in day <?php echo $_REQUEST['dayloader']; ?>',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addAccommodation&pid=<?php echo $_REQUEST['loadp']; ?>&d=<?php echo $_REQUEST['fromdateload']; ?>&packageDays=<?php echo $_REQUEST['dayloader']; ?>&loaddestinationidload=<?php echo str_replace(' ','%',trim($_REQUEST['destinationNameload'])); ?>" />



<div style="margin-bottom: 15px; color: #000000; font-size: 12px; font-weight: 600;">Suggested <?php echo $_REQUEST['eventsection']; ?> in <span style="font-weight:600; color:#0066CC;"><?php echo $_REQUEST['destinationNameload']; ?></span></div>



<?php

$n=1; 

$where=' status=1 and destination in (select id from cityMaster where name="'.trim($_REQUEST['destinationNameload']).'" and status=1) '.$whereapp.' order by name asc';  

$rs=GetPageRecord('*','hotelMaster',$where); 

while($eventData=mysqli_fetch_array($rs)){  



?>

<div class="daydetailsbox">

<table width="100%" border="0" cellpadding="0" cellspacing="0">

  <tr>

    <td colspan="2"><div class="eventimgclass"  style="width: 50px; height: 50px;"><img style="height:100%;"  src="<?php if($eventData['hotelPhoto']!=''){ echo $fullurl;   echo 'package_image/'.$eventData['hotelPhoto']; } else { echo 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAABmJLR0QA/wD/AP+gvaeTAAATo0lEQVR4nO2dd3iUVb7HP2f6pDdIIyEQQoRQBCFUC6ggClIURUXdtaxevXp173W96z67a1lZ+z66a1sQdXVFFxEbiKiIyCahiYDpISEZ0hup099z/whGhkySmTATwDuf55nnmZz3d877e9/vnF4CAQIECBAgQIAAAQIECBAgQIAAAQIECDAAxOl2YDDY1Xo0WqVowwF0Flk7MS6u43T71Bs/O0F219XFKWr7AinFXCmYJCAN0J1k1goyD6HaC8pW2aF8OTMpyXw6/D2Zn40gOY1V86SU9yDEAkDtZfRGKVmtEfKlzOhEkz/885SzXpBd9VVTpEq8IJEzfJCcA3jTobY/cH7E8GYfpOc1Z60guTJX19IU8bhA3I/3OaJPJFQjuWtmTMKHvkzXE85KQfbW18fbVfYPgUx/3kcK+eKMyIR7hRCKP+9zImedIFl1plFCrd4KjBhIfJ1KTaIxBCklR83tDDOGUmftIFJnQK9yzWhqIQjV6Fp1KnUecBCQwBNCiCOn/CC9cNoFWTBx/B8Uh+OR0+2HN2g06uZNB36I8kva/kjUG1SCyHnXLGH2ZRefblc8wmG38+hdD4T6K/3TLog76qtq+HTd+6y48xaMwUEAHMjey5GiEhbfvAIAi9nM1x9vofiHfBSnQkp6KhcvvoLQiDAO7t7Hvm+ze6R72dVLUOu0bHpnvUu4kIJf/M/d1FZWsfndD7jh7tvQGQz+f1A3qE7LXfvBYjZzOLcQp8PRHdbc0IiptKvollLyzxdWk//dQTIvmsWs+XOoPFLBmqeex2F3EBkdTeqYdCJjojmcW0hKWiqpY9IxhgRh7exKe2h8LInDk7s+I5IAMLd3dt3X2XcdrlarNVLKVH88+xmZQ/qjNK+IisOl3L/q90TERAMwIfM8nn3wYb7P2s2UC2eSlJrC4fwi9n6TxcxL56A3dv3i2461AnDhogWEhIYM6P5Op9MhhDjsm6dx5YwW5I1nX0Kt7mr5tLW0EHT8BVabjhITG9stBoDeaCB51EiqKzzraL/y6NOoVF0FRGRMFL984B6P/RJC+K0xdEYLcu6sqeiPl+VFB3NpbmgCwGA00tHejlQkQvXTu2lraSEuKcGjtC9aNB+D0QiATq/3yi8ppfqycekTtvxQeNCriB5wRtYhP3Lu9KlMvXAWUy+cRWLK8O7wtPFjsZrNbP90C1JKAPbvzKGq3ETGeZM8SntEehqpGemkZqSTNCrFK79UKhVBIWE75k1IH1BfqC9Oaw75uqzMsPrO26P7t3QlPCqCK29awUdvvse/P/8alVqF1Wxh/vLFxCcnepTGX377aPd3IQSPvfZC99+P3/Ng9/eJ06ew/Fc3u8QVQrDyrttC1726dg1w8YKxYydpjLrrDUb9eKnQ1tra9ll4aOu69dlHvR5BHvSOYa7M1bU0Rq0QgpuQcvbWl1/Vhyk2l36IzWqjvqaGuGGJP9Uhx1qxdHYyJCGu266zrZ2Kw2U4nU6SU1MIjYhwuZfNYqG+to6E5GEIoXJJ+2QShydjtVppqKl1CQ8KDibyhLrKYbfz+D3/y4bsL7nuoss7HXb7p1qdbuEV1y7TpYxK1VjNZnZ8/mV77veHzBarecHWQwX7vHk/g5ZDpJQiu7lqRWuTWCWE7Cojjv8cSguKURTXpma1qZL4pJ6/9vzvD7lNv7G2vtd7H84t7Nc/dzatx46h0WgJCgnuDvvRT41GQ8bkibK1ueWKx15+Lig45KcW27yli0Kyt+0Ifuqhh7ddPmbMhM35+eX9OnCcQckh2Q1VY1DxEpKLTr5WWVhI/vYdLmFSKmSte59Z11/jd98qDhyktqSUiJgobFYrLU3NxA1LZNbFF3Jg1z6MIUGMzhjjEid6yBCuvH45x5qaCQoO6rVRsO6VtY6Nb7/78YacPVd56o/fBclqrr5QKPIjINzTOFJx8ujcBfxx+1Y/ega7N2ykeNs2Hv3r04RHRgKwd2cOpUXFXHPLjax+5gViYoey9MYVA0q/9VgLN156pcU46mDI+vU4PYnj1yIrq6lmoVCU9UCv4xA2s5kGk2vfQSoKIKkqKvK5T9Kp0GAyYes0s/Of67jzgXupq6ml7njdER4dwaQZUynOL+BYU1czuzi/wCWNkNBQ4of133gIiwhHq9Mp7YWj4qHkqCf++S2H7G6sznAic4A+u8Mv3XwrdWV+G832G29s2cjQ+Fi315xOJ1998hn11bWUFBQ5Cg7m2jrb2//70/0HXukvXb/kkFyZq2ttkuvpRwwAW2cniclJ/Oaph/3his8pzi3kb489RWdH7wtX1v39dWZfOod5SxYCaMqKijWP3ve/zyybPiXpg5y9v+srfb8I0toUeTcwpl/D4+gNetLGnOMPV3xOZ1vfK4gsZgvJI1NIGfXT2OOI0Wk8/87a4FuuuPq++WPHvvN5Xl5ub/F9LsjXZWUG4CFv4pQfLmPFnCuIjIokaaR3vebBwtzRSUl+EU67o087g9HABfMv6REeFhHO8ltuNLy35h//Bfyqt/g+F8QQrr8KSYyn9jOvu4aDX2yjvvQI9TV13HDHrb52ySfkbP+WlqZmRo8bS1hEGAlu+kj9MWZChkqn1U3ty8b3RZYirkVIj80zly0lc9lSXrvrXlqrqpg9b47PXfIFNVVVsAmeWPM3DMaBTV5JRYKgz5fj08HFf0mpFkKe78s0f07kfLPTZjV3ftGXzSnnECmlyG6snCtQz6OpepaEiP5j9U9FaTlNde6HQ9LGnUNwSAh5Bw5hM1t7XFepBROmnofNaiNvv/sR8rCoCEaOHkVjXUP3TOTJJAxP6rVp6y0l+YVs2fCx3dxheb4vu1MSJLupclFOU/WTQqjG0HdO9Jo3V/8DQ8bEHuENJcUst9uZcv4MXn1xLcMu6FnEVWz/iucmjsd0pJy3N2wmduK5PWyO7fuQx//yJ7Zu2kpxhx1jRKTLdWtHO7F793P7f95+Ss/R0d7Otk+3KG88/7LFYXPc8EVhYVVf9gMSJMtkMoog9ctIbu7femBotBpSZs3qEa7W/ORyeEyMW5vWop961jGjUt3aFBT+0PVFShLPnURYomslbW5uxpr1dY94v1iwDIfDo1EQkBKHw074kJh9NkvnrZsPFbgfGT0BrwXZLIv1qib1Rgnz3V3XqdSEarRYnE46nHZvkz/jueP1Nai1Ws+MhcAQEoyE/TOjE/oVAwYgSGRzyDMS6VYMAL1KTZTOSIvd+rMURBtk9HqJkBBirqe2XgmS3VAzDanc7XIzYJgxlBOn/a2KA6cctOWwZz5SjsgymYye7EHxqtkrhfJ7ThqQlIBNceJQpMvHHhDkRNQyRKR7YuhRDpFShkvY2um0T+2vMVVpaSfeEEwUBky0kWQMRQAKkoK2JpzSt62xswWB2qP5IE+LrNYyS8vGDpu93+X/FqcDi9OJAMyKg7LOFgCkxCsxhg6NIf+1v/cIN7e3EXb7TQAIm8Wtjb2pCZVaTUhICM2HDpJvquhhExHaNS0bFx/Lto8/QKtznfVzOu1kTp3ssb/9IZzC4omdR4IIIWRWY2V0lNZIemgkHQ47pR0tZIRFc7C1gXFh0WhE36WfU0q+O1brsSi3etD+f+SZx/q8HpsYz5N/e7JPmzkLLmHOgp6Dgb5GUTt69mDd4HGlLiCm2W4hp6m6O2x3c9fqjdzWRlRCYHE6fFYkFecVUGVy34eaNO08wiLC2bUjG4u5Zz2p0aiZOfcCrBYru3ZkuU0jekg04yZPpKayisIfCtzapJ6TxrDhSQN/iBNwatSVnth5IYgIdveqBYKRweGoENRaO6mzdnrsZF+89/b7hGbO7BFeV5BPcJCRKefP4L13NzB83uU9bMq2fkLm+TOoLK9g87e7SZjSs6RteGcD4yZPZNvnX1MutQRFuw5QW9vaKC75nNvuvs0Xj2O6IDS+92UxJ+CxIIqQdUL2nPGVSHJbG73wzTPUWjUJE3sOnThOyBEhEZFubRq+29v9PTIpya1N676c7u9D089x21O3ZW8fkO89EV96aulxs1clVWUDcyaAQFnnqa3HOcSJM0t1Zi8FRnE4qCsspKakhLXPvsix+gbKW9oRxiDix0/AGOGTgWjvkByeFp3gcQ7xWBBbVOIeQ1N1HTB0QI75EUtLC3kbNlC89XOG6gyMd6gJK2sgSqgYIh2UFr3JHmsbMSNTybjheuLGjR885wTJOY1VFwMeieKxIHOEcGQ3Va1Bejdf7m9Mu3aR88LzzBRB3GoYxhC1DtyM/dk1Q9h1tIV1j68iNjOTsBDvtiCcAlqEeD+nzjR1+tCk4v6MvRrLsgjr0wapvxPwyw5Ub2kymSj+6mt+q09gpKbvAT+tEMzWhTNVG8qr+w5RpFWwWjzqGviCcEWjfhpY0p+hV4LMiRxxLKuh6jYh2ICfl6EmJydRuLZnL9xmMRM5aSUFB3OpyyvgT6EpxKpOPlumd/RCxT36WF7srObFP6xi6mWX8NWmD9FoXLOV0+lk5izfnUsgJIuzG2qmzYiJ29WXndfD7zNjEjbmNFU9JCV/Hrh7/XPDrSt7vSal5M7Ll3OHMd4rMX5EAHcExfLgv3dz8VWLePjPfzgFT725sXIt0KcgA2o2TY9KeAK4HfBNL9BL9ufsQd9uYYpu4NvFtahYQigbV7/lQ8/6QYhF/ZkMuB07IzphjXQ6JyJ5h65TdAaNPV/tINN56pVypi6MQwcO4nAMkvtSjtwrZZ/Tjae0yGHm0KQS4Iac2tpfS7VymRRykkDEIaUdIXUgluK2zXNqFPyQR4PRznalBo3FjtVqpefGWImUuA0Hgcaox2bQotbrqK+p9Wg1uw9QKU1VcUCvW4V9slBuemxsLfDm8U832Y1VhcBoX9zjREafO455Y0ezbeNmzpmQwXffbCMtNd7FxmZ3UF5R3yO8s9NCblEN869bTqfFSt6+7wdLDAAcTqXPrO3X/SESaoUfBPlxx5Jer2dIbCwGg46oSNeF9harnTpDS49wrUaNVqslLjGB0sNlaLSDu+/VqVP6HPjz61iICjzapPL/iJbZ4cktfRn49eehCLFfSHldb9eri4rZ8/4HHM3Lx9zaBlKhorSc5JHDe4tytpPd32FofhVEONnTWx7cv3kL36xZy/W3/4IJd/wSgN07dvLgLXfzwKrfM3nmNH+6dnqQ4r3+TPwqiKXdkmMI07cBLh2GurIjbF+zlufefMWlQk0eOZz08Rk8/uvfsvrjd6koO8Kh3d/RcqyFtLHpnD9vLlqd9x3BM4Sj0uzoVxC/1iFzRoywgNh0cvj3m7dwxdWL3bZuxp93LufNmsb9K2/nhYefQEqIionmi482c9fVN1FVcXZWSwLu82Rdlv+bGEJ5RzqVFXs2fkJxVhYqlYr6ChOXPHh/r1EuvOxSQHD/Iw+hOb5sc/ktN/LBm+/wp/t/y+RZZ1lxJuVL02MSN3hi6vcZp+mRCZs+efK5liM7d3LzrSu56urFGHS6Pje9ZF4wiwdW/bFbjB9ZetN1aLRa6qp6Ho1xpiJgvSk64V5P7f2WQ5bPGGZsaQu9csG4sWmG4KCgt7/8BGNQ13FIs+d5vNTVBSEE6RMyOJzf/1EZZwB2gfzztKiER6Z7ccysX4bQ540dO80YZPh01NjRurSMscbE5GGqy5cvPaXDji1mC+tff4vaymp2fbMTnU6HTq8jKCSUtsZaEhNcp2icToX6hlbiYl2nba1WOxWVTSSNGIHZ3ElbaxtjJozr9/6V5SbKS0oJjYkGRNt/vPH3PUFh4TPpeShCK8gP1KieyYyO73W3bW/4XJAFk0YN0apCS3737KqwKbOn+yzdf732FvOXLSQ8MhKpKLy46lm+y9nFsBEp1FZWebVfyBgSTGxCHA6HE6ES3ScO9YXNZuPo4SOYOztpqmtAKoz/S977RccaoyaqhRKhINRSqI5WRsbmXyOEhxtIeuLzIksoxjvmLpqv96UYAMtuvg7N8c06QqXizgfvY+Uli7FarMSd1FpLGJ5EjekoyWmpVJcfZe6Sy9HpfdNcLi0oYu1TfwUgQ2TYgD0+Sfg4PhckOCQ4c8y5430+Ya3RuLqq0WpJSUtFkQpBocEu1441NWEIDqKuqhq1Vs03mz73mR8tjf49o9/ngthtNlNluUlhEFpwlUfKaaxv8PdteiKEA62mzh9J+1yQjk7r6g//+d4t85YuNPhzWPuz9R+iCw3lj+vXIVRuta9BqpacPIe9s74yXa1WPYWUC+nnRyOgUJFi1YzouLeE8GLz/Sngl1bWovMm3SPgqSUrr9WlpKWq1O5f2HEPBBOmTsZ0pJwRo1IpKSjEYbczeUZX56+itJyKkp+OyLWYzezN3sPBffu54ZknGZLibiBSfKV2qldmDh3aa4clp86UJjWqZRIxQ0jSJBgEWCQcFYK9Aj6bFhmfNZj/GQH8uHLksnHpE/SGkNv0Bv05Qt37Obf6oKDQxfffOyQvK3vk1MsXkP3RJ9gtVq793W8QKjVZGz7k8Pffn+CxmrjRo5i8aCGGkOCTk6uVyIdmRCW8Pli/aF9z2v87AnQdPpDTXLUQKX4DzPY6PpSqEC8Z7eKVM/kffnnCGSHIieysr0zXqMVSCfOEZJLbkyEkVgQHgG+lSnwyIyLu28EuWvzFGSfIyeTU1sY6tXKI2qnoJUgpnLXW6GG1c4QY1JUuAQIECBAgQIAAAQIECBAgQIAAAQIECBAgQICzlv8DvhknhQQnvTIAAAAASUVORK5CYII=';  } ?>"  />

	

	 

	

	</div></td>

    <td width="90%"style="padding-left:10px;"><div class="eventheading"><?php echo strip($eventData['name']); ?></div><div><span style="color:#FF9900; "><?php echo starcategory($eventData['category']); ?></span></div></td>

    <td width="10%">

	<div class="addeventbtnn" onclick="loadpop('Accommodation in day <?php echo $_REQUEST['dayloader']; ?>',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addAccommodation&pid=<?php echo $_REQUEST['loadp']; ?>&d=<?php echo $_REQUEST['fromdateload']; ?>&packageDays=<?php echo $_REQUEST['dayloader']; ?>&loaddestinationidload=<?php echo str_replace(' ','%',trim($_REQUEST['destinationNameload'])); ?>&auto=1&eventobjectid=<?php echo strip($eventData['id']); ?>&photo=<?php echo $eventData['hotelPhoto']; ?>" ><i class="fa fa-plus" aria-hidden="true"></i></div>

	

	</td>

  </tr>

</table>





</div>

<?php $n++; } ?>





<?php } ?>





 

	



<?php if($_REQUEST['destinationNameload']!='' && $_REQUEST['eventsection']=='Activity'){ ?> 

<style>
.actabouter{overflow:hidden; border-bottom:1px solid #ddd; margin-bottom:10px;}
.actabouter a { float: left; width: 33%; display: block; background-color: #FFFFFF; font-size: 13px; text-align: center; font-weight: 600; padding:6px 0px; border-right: 1px solid #ddd; color: #000; }
.actabouter .active{ background-color:#23ae73; color:#FFFFFF;}
</style>
 
<script>
function activeactab(id){
$('.actabouter a').removeClass('active');
$('#'+id).addClass('active');

if(id=='actab2'){
$('#fromdatabase').hide();
$('#fromapi').show();
} else {
$('#fromdatabase').show();
$('#fromapi').hide();
}
}
</script>

<div class="actabouter">
<a href="#" class="active" id="actab1" onclick="activeactab('actab1');">From Database</a>
 <a href="#"  id="actab2" onclick="activeactab('actab2');">From API</a> 
<a href="#"  id="actab3" onclick="activeactab('actab3');loadpop('Activity in day <?php echo $_REQUEST['dayloader']; ?>',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addActivity&pid=<?php echo $_REQUEST['loadp']; ?>&d=<?php echo $_REQUEST['fromdateload']; ?>&packageDays=<?php echo $_REQUEST['dayloader']; ?>&loaddestinationidload=<?php echo str_replace(' ','%',trim($_REQUEST['destinationNameload'])); ?>">+ Add Manual</a>
</div>
<div style="width:100%;" id="fromdatabase">

<div style="margin-bottom: 15px; color: #000000; font-size: 12px; font-weight: 600;">Suggested <?php echo $_REQUEST['eventsection']; ?> in <span style="font-weight:600; color:#0066CC;"><?php echo $_REQUEST['destinationNameload']; ?></span></div>



<?php

$n=1; 

$where=' status=1 and destination in (select id from cityMaster where name="'.trim($_REQUEST['destinationNameload']).'" )  '.$whereapp.'  order by name asc';  

$rs=GetPageRecord('*','sightseeingMaster',$where); 

while($eventData=mysqli_fetch_array($rs)){  



?>

<div class="daydetailsbox">

<table width="100%" border="0" cellpadding="0" cellspacing="0">

  <tr>

    <td colspan="2"><div class="eventimgclass"  style="width: 50px; height: 50px;"><img style="height:100%;"  src="<?php if($eventData['photo']!=''){ echo $fullurl;   echo 'package_image/'.$eventData['photo']; } else { echo 'data:image/png;base64,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';  } ?>"  />

	

	 

	

	</div></td>

    <td width="90%"style="padding-left:10px;"><div class="eventheading"><?php echo strip($eventData['name']); ?></div></td>

    <td width="10%"><div class="addeventbtnn" onclick="loadpop('Activity in day <?php echo $_REQUEST['dayloader']; ?>',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addActivity&pid=<?php echo $_REQUEST['loadp']; ?>&d=<?php echo $_REQUEST['fromdateload']; ?>&packageDays=<?php echo $_REQUEST['dayloader']; ?>&loaddestinationidload=<?php echo str_replace(' ','%',trim($_REQUEST['destinationNameload'])); ?>&auto=1&eventobjectid=<?php echo strip($eventData['id']); ?>" ><i class="fa fa-plus" aria-hidden="true"></i></div></td>

  </tr>

</table>





</div>

<?php $n++; } ?>

</div>

<div style="width:100%; display:none;" id="fromapi">

<?php
 function getHotelApiData($url,$jsonPost,$apiKey){
    $crl = curl_init($url);
    curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($crl, CURLINFO_HEADER_OUT, true);
    curl_setopt($crl, CURLOPT_POST, true);
    curl_setopt($crl, CURLOPT_POSTFIELDS, json_decode($jsonPost)); 
    return $result = curl_exec($crl);
    curl_close($crl);
	
}

$apiKey='1';
$TokenId='1';
$url = "https://travbizz.co.in/sightseeing/api/sightseeinglist.php";  

 $jsonPost = '{
"EndUserIp": "'.$_SERVER['REMOTE_ADDR'].'",
"searchdestination": "'.trim($_REQUEST['destinationNameload']).'",
"TokenId": "'.$TokenId.'"
}';
  
  $getdata=json_decode(getHotelApiData($url,$jsonPost,$apiKey));
 
 $values = $getdata->Sightseeing;
 $n=1; 
 foreach($values as $datalist){

 ?>
 <div class="daydetailsbox">

<table width="100%" border="0" cellpadding="0" cellspacing="0">

  <tr>

    <td colspan="2"><div class="eventimgclass"  style="width: 50px; height: 50px;"><img style="height:100%;"  src="<?php if($datalist->Photo!=''){   echo $datalist->Photo; } else { echo 'data:image/png;base64,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';  } ?>"  />

	

	 

	

	</div></td>

    <td width="90%"style="padding-left:10px;"><div class="eventheading"><?php echo $datalist->Name; ?></div></td>

    <td width="10%"><div class="addeventbtnn" onclick="loadpop('Activity in day <?php echo $_REQUEST['dayloader']; ?>',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addActivityAPI&pid=<?php echo $_REQUEST['loadp']; ?>&d=<?php echo $_REQUEST['fromdateload']; ?>&packageDays=<?php echo $_REQUEST['dayloader']; ?>&loaddestinationidload=<?php echo str_replace(' ','%',trim($_REQUEST['destinationNameload'])); ?>&auto=1&eventobjectid=<?php echo $datalist->Id; ?>" ><i class="fa fa-plus" aria-hidden="true"></i></div></td>

  </tr>

</table>





</div>
 <?php
 
 $n++; }
  
?>


</div>


<?php } ?>





 







 

	



<?php if($_REQUEST['destinationNameload']!='' && $_REQUEST['eventsection']=='Transportation'){ ?>

 

 



<input type="button"  style="padding: 10px; color: #fff; background-color: #23ae73; outline: 0px; height: 46px; width: 100%; box-sizing: border-box; margin: 15px 0px; margin-top: 0px; border-radius: 4px; border: 0px; font-size: 16px; cursor:pointer;" value="+ Add Transportation Manually" onclick="loadpop('Transportation in day <?php echo $_REQUEST['dayloader']; ?>',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addTransportation&pid=<?php echo $_REQUEST['loadp']; ?>&d=<?php echo $_REQUEST['fromdateload']; ?>&packageDays=<?php echo $_REQUEST['dayloader']; ?>&loaddestinationidload=<?php echo str_replace(' ','%',trim($_REQUEST['destinationNameload'])); ?>"  />





<div style="margin-bottom: 15px; color: #000000; font-size: 12px; font-weight: 600;">Suggested <?php echo $_REQUEST['eventsection']; ?> in <span style="font-weight:600; color:#0066CC;"><?php echo $_REQUEST['destinationNameload']; ?></span></div>



<?php

$n=1; 

$where=' status=1 and destination in (select id from cityMaster where name="'.trim($_REQUEST['destinationNameload']).'" and status=1) '.$whereapp.' order by name asc';  

$rs=GetPageRecord('*','transferMaster',$where); 

while($eventData=mysqli_fetch_array($rs)){  



?>

<div class="daydetailsbox">

<table width="100%" border="0" cellpadding="0" cellspacing="0">

  <tr>

    <td colspan="2"><div class="eventimgclass"  style="width: 50px; height: 50px;"><img style="height:100%;"  src="<?php if($eventData['photo']!=''){ echo $fullurl;   echo 'package_image/'.$eventData['photo']; } else { echo 'data:image/png;base64,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';  } ?>"  />

	

	 

	

	</div></td>

    <td width="90%"style="padding-left:10px;"><div class="eventheading"><?php echo strip($eventData['name']); ?></div></td>

   <td width="10%"><div class="addeventbtnn" onclick="loadpop('Transportation in day <?php echo $_REQUEST['dayloader']; ?>',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addTransportation&pid=<?php echo $_REQUEST['loadp']; ?>&d=<?php echo $_REQUEST['fromdateload']; ?>&packageDays=<?php echo $_REQUEST['dayloader']; ?>&loaddestinationidload=<?php echo str_replace(' ','%',trim($_REQUEST['destinationNameload'])); ?>&auto=1&eventobjectid=<?php echo strip($eventData['id']); ?>&photo=<?php echo $eventData['photo']; ?>" ><i class="fa fa-plus" aria-hidden="true"></i></div></td>

  </tr>

</table>





</div>

<?php $n++; } ?>





<?php } ?>





 <?php if($_REQUEST['destinationNameload']!='' && $_REQUEST['eventsection']=='Insurance'){ ?> 



<input type="button"  style="padding: 10px; color: #fff; background-color: #23ae73; outline: 0px; height: 46px; width: 100%; box-sizing: border-box; margin: 15px 0px; margin-top: 0px; border-radius: 4px; border: 0px; font-size: 16px; cursor:pointer;" value="+ Add Insurance / Visa Manually" onclick="loadpop('Insurance / Visa in day <?php echo $_REQUEST['dayloader']; ?>',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addFeesInsurance&pid=<?php echo $_REQUEST['loadp']; ?>&d=<?php echo $_REQUEST['fromdateload']; ?>&packageDays=<?php echo $_REQUEST['dayloader']; ?>&loaddestinationidload=<?php echo str_replace(' ','%',trim($_REQUEST['destinationNameload'])); ?>"  />



<?php } ?>



<?php if($_REQUEST['destinationNameload']!='' && $_REQUEST['eventsection']=='Meal'){ ?> 



<input type="button"  style="padding: 10px; color: #fff; background-color: #23ae73; outline: 0px; height: 46px; width: 100%; box-sizing: border-box; margin: 15px 0px; margin-top: 0px; border-radius: 4px; border: 0px; font-size: 16px; cursor:pointer;" value="+ Add Meal Manually" onclick="loadpop('Meal in day <?php echo $_REQUEST['dayloader']; ?>',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addMeal&pid=<?php echo $_REQUEST['loadp']; ?>&d=<?php echo $_REQUEST['fromdateload']; ?>&packageDays=<?php echo $_REQUEST['dayloader']; ?>&loaddestinationidload=<?php echo str_replace(' ','%',trim($_REQUEST['destinationNameload'])); ?>"  />



<?php } ?>



<?php if($_REQUEST['destinationNameload']!='' && $_REQUEST['eventsection']=='Flight'){ ?> 



<input type="button"  style="padding: 10px; color: #fff; background-color: #23ae73; outline: 0px; height: 46px; width: 100%; box-sizing: border-box; margin: 15px 0px; margin-top: 0px; border-radius: 4px; border: 0px; font-size: 16px; cursor:pointer;" value="+ Add Flight Manually" onclick="loadpop('Flight in day <?php echo $_REQUEST['dayloader']; ?>',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addFlight&pid=<?php echo $_REQUEST['loadp']; ?>&d=<?php echo $_REQUEST['fromdateload']; ?>&packageDays=<?php echo $_REQUEST['dayloader']; ?>&loaddestinationidload=<?php echo str_replace(' ','%',trim($_REQUEST['destinationNameload'])); ?>"  />



<?php } ?>





<?php if($_REQUEST['destinationNameload']!='' && $_REQUEST['eventsection']=='Leisure'){ ?> 



<input type="button"  style="padding: 10px; color: #fff; background-color: #23ae73; outline: 0px; height: 46px; width: 100%; box-sizing: border-box; margin: 15px 0px; margin-top: 0px; border-radius: 4px; border: 0px; font-size: 16px; cursor:pointer;" value="+ Add Leisure Manually" onclick="loadpop('Leisure in day <?php echo $_REQUEST['dayloader']; ?>',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addLeisure&pid=<?php echo $_REQUEST['loadp']; ?>&d=<?php echo $_REQUEST['fromdateload']; ?>&packageDays=<?php echo $_REQUEST['dayloader']; ?>&loaddestinationidload=<?php echo str_replace(' ','%',trim($_REQUEST['destinationNameload'])); ?>"  />



<?php } ?>







<?php if($_REQUEST['destinationNameload']!='' && $_REQUEST['eventsection']=='Cruise'){ ?> 



<input type="button"  style="padding: 10px; color: #fff; background-color: #23ae73; outline: 0px; height: 46px; width: 100%; box-sizing: border-box; margin: 15px 0px; margin-top: 0px; border-radius: 4px; border: 0px; font-size: 16px; cursor:pointer;" value="+ Add Cruise Manually" onclick="loadpop('Cruise in day <?php echo $_REQUEST['dayloader']; ?>',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addCruise&pid=<?php echo $_REQUEST['loadp']; ?>&d=<?php echo $_REQUEST['fromdateload']; ?>&packageDays=<?php echo $_REQUEST['dayloader']; ?>&loaddestinationidload=<?php echo str_replace(' ','%',trim($_REQUEST['destinationNameload'])); ?>"  />



<?php } ?>











<?php if($n==1 && $_REQUEST['eventsection']!='Activity'){ ?>

<div style="background-color:#f2f5f6; padding:20px; text-align:center;border-radius: 4px; color:#8f8f8f; margin-bottom:15px;">Nothing Found</div>

<?php } ?>