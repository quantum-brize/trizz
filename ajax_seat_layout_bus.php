<?php
include "inc.php"; 
include "config/logincheck.php"; 
include "busapi/SSAPICaller.php";


$rs=GetPageRecord('*','sys_userMaster','id="'.$_SESSION['agentUserid'].'" '); 
$AgentWebsiteData=mysqli_fetch_array($rs);



$rsParent=GetPageRecord('*','sys_userMaster','id="'.$AgentWebsiteData['parentId'].'" '); 
$AgentWebsiteData=mysqli_fetch_array($rsParent);

$rsParent=GetPageRecord('*','sys_userMaster','id=1'); 
$adminWebsiteData=mysqli_fetch_array($rsParent);






$sid = base64_decode($_REQUEST['sid']);

$select = 'BB'.$sid;



$j =$_REQUEST['j'];

$_SESSION['currency_type']="INR";

/*==========================creating sessions================================*/



$result=$_SESSION['busresult'];

 "count : ".count($result);

//print_r($result);



$j =$_REQUEST['j'];

$_SESSION["trip_id"]=$_REQUEST["tripid"];

//echo $_REQUEST["j"];

$_SESSION["t_agency_name"]=$_REQUEST["tnm"];

$_SESSION["b_loc"]=$_REQUEST["bl"];

$_SESSION["b_time"]=$_REQUEST["bt"];

$_SESSION["d_loc"]=$_REQUEST["dl"];

$_SESSION["d_time"]=$_REQUEST["dt"];

$_SESSION["fare1"]=$_REQUEST["f"];

//$fare_amount=$_SESSION[$select]["fare1"];

$_SESSION["busdesc"]=$_REQUEST["bdesc"];

$_SESSION["d1"]=$_REQUEST["dur1"];

//echo $_SESSION[$select]['path']=$_REQUEST["ipath"];

/*========================creating sessions==================================*/



//$cancelpolicy= "{$value->cancellationPolicy}"; //by sahid

?>

<style>
 

    @media only screen and (max-width: 600px) {

   td.mshd {display: none;}

}

   

</style>

<div class="bus-details">

                            

                            <ul class="nav nav-tabs" id="myTab" role="tablist">

                              <li class="nav-item"> <a class="nav-link active" id="first-tab" data-toggle="tab" href="#first" role="tab" aria-controls="first" aria-selected="true">Available Seats</a> </li>

                              <li class="nav-item"> <a class="nav-link" id="second-tab" data-toggle="tab" href="#second" role="tab" aria-controls="second" aria-selected="false">Cancellation Fee</a> </li>

                            </ul>

                            <div class="tab-content my-3" id="myTabContent">

                              <div class="tab-pane fade show active" id="first" role="tabpanel" aria-labelledby="first-tab">

                                <div class="row">

                                  <div class="col-12 col-lg-12 text-center">

                                    

                                    <form name="frm<?php echo $j; ?>" id="frm<?php echo $j; ?>" action="bus_booking_review.php" method="post" enctype="multipart/form-data">

<table width="100%"  align="center" cellpadding="0" cellspacing="0" border="0" style=" border:2px solid #e5e5e5;">

<input type="hidden" name="action" id="action" value="booking"/>

<input type="hidden" name="count" id="count" value="<?php echo $j; ?>"/>

<input type="hidden" id="tripid<?php echo $j;?>" name="tripid<?php echo $j;?>" value="<?php echo $_REQUEST['tripid'];?>"/>

  <?php

  		if($_REQUEST['tripid'] !=''){

		$rowarray=array(); 

		$columnarray =array();

		$tripid = $_REQUEST['tripid'];

		$arryseatlayout = getTripDetails($_REQUEST['tripid']);

		//file_put_contents("XML/tripdet.txt",$arryseatlayout);

		$resultseat=json_decode($arryseatlayout);
		

		$_SESSION['resultseat']=$resultseat;

		foreach ( $resultseat->seats as $val ){

			array_push($rowarray, "{$val->row}");

			array_push($columnarray, "{$val->column}");

		}

		$maxrow =  max($rowarray);

		$maxcolm = max($columnarray);

		$text_array=array();

		$text_array1=array();

		

		foreach ( $resultseat->seats as $val ){

			$row  = "{$val->row}";

			$column  = "{$val->column}";

			$zindex = "{$val->zIndex}";

			if($zindex == 0){ 

				$text_array[$row][$column]=$val;

			}elseif($zindex == 1){

				$text_array1[$row][$column]=$val;

			}

		 }

		}

		if(!empty($resultseat)){

		?> 

  <tr>

    <td align="left" valign="middle" >&nbsp;</td>

    <td align="center" valign="bottom" class="contenttext" >Tips:Click on available seat/sleeper to select it.Click again to deselect it.</td>

    <td height="25" align="left" valign="middle" >&nbsp;</td>

  </tr>

  <tr>

    <td align="left" valign="middle">&nbsp;</td>

    <td align="left" valign="middle">

	<?php if(!empty($text_array)) {?>

        <table width="100%" align="center" cellpadding="0" cellspacing="0" border="0" style=" border:1px solid #e5e5e5;">

          <tr>

            <td height="10" colspan="150"></td>

          </tr>

          <?php 

                $img='<img src="busimages/steering.jpg"  alt="Driver seat"  align="absmiddle" style="padding-right:10px;"/>';

           ?>

          <?php for($r=0; $r <=$maxrow; $r++) {?>

          <tr>

            <?php for($c=0; $c <= $maxcolm; $c++) {
			$fare_amount=0;
           
		    $available = "{$text_array[$r][$c]->available}" ;

            $ladies = "{$text_array[$r][$c]->ladiesSeat}" ;

            $length = "{$text_array[$r][$c]->length}" ;

            $width = "{$text_array[$r][$c]->width}" ;

            $name = "{$text_array[$r][$c]->name}";
			
            $fare_amount = "{$text_array[$r][$c]->fare}";
			$fares=$fare_amount;
			
			$agentMarkup=0;	
$adminMarkup=0;										
if($AgentWebsiteData['busMarkupType']=='flat')
{
	$agentMarkup=$AgentWebsiteData['busMarkupValue'];
	
}	

if($AgentWebsiteData['busMarkupType']=='percentage')
{
	$agentMarkup=round(($AgentWebsiteData['busMarkupValue']*$fares/100));
	 
}


if($adminWebsiteData['busMarkupType']=='flat')
{
	$adminMarkup=$adminWebsiteData['busMarkupValue'];
	
}	

if($adminWebsiteData['busMarkupType']=='percentage')
{
	 $adminMarkup=round((($adminWebsiteData['busMarkupValue']*$fares)/100));
	
}	


$adminAgentMarkup=($adminMarkup+$agentMarkup);
$fare_amount=$fare_amount+$adminAgentMarkup;								

	   //$fare_amount=$fare_amount+($fare_amount*$_SESSION[$select]["myservicecharge"]/100);

			//echo $_SESSION[$select]["myservicecharge"];

            ?>

            <td ><?php echo $img; $img='';?></td>

            <td height="25" valign="middle" ><?php 

             if("{$text_array[$r][$c]->name}" != ''){

				$mf=$text_array[$r][$c]->fare;

				$mf1=$mf;

				$curr_amt=number_format(($_SESSION['currency_value']*$mf1),2);

				$curr_type="";

				if(isset($_SESSION['currency_type'])){ $curr_type=$_SESSION['currency_type'].' '; }else { $curr_type='INR '; }

				$titlea='<small> <strong>Seat Number : '."{$text_array[$r][$c]->name}".'<br/>'. 'Fare : '.$curr_type.' '.$curr_amt.'</strong></small>';

			 ?>

              <a href="javascript:void(0);" data-toggle="tooltip" title="<?=htmlspecialchars($titlea)?>" data-html="true">

					

					<?php 

					  if($length =='1' && $width=='1'){

							if($ladies=='true' && $available =='true'){?>

							<img src="busimages/available_ladies.jpg"  alt="Ladies Seat" onclick="change_icon('<?php echo $length;?>','<?php echo $width;?>','<?php echo $name;?>','<?php echo $ladies;?>','<?php echo $fare_amount;?>','<?php echo $j;?>');" id="sl<?php echo $j;?>seat<?php echo $name;?>"/>

							<?php } else if($available =='true'){?>

							<img src="busimages/available.jpg"  alt="Available Seat" onclick="change_icon('<?php echo $length;?>','<?php echo $width;?>','<?php echo $name;?>','<?php echo $ladies;?>','<?php echo $fare_amount;?>','<?php echo $j;?>');" id="sl<?php echo $j;?>seat<?php echo $name;?>"/>

							<?php }else if($ladies=='true' && $available =='false'){?>

							<img src="busimages/booked.jpg"  alt="Booked Ladies Seat"/>

							<?php } else {?>

							<img src="busimages/booked.jpg"  alt="Booked Seat" />

					 <?php } }elseif($length =='2' && $width=='1') {

							if($ladies=='true' && $available =='true'){?>

							<img src="busimages/ladies_sleeper.jpg"  alt="Ladies Sleeper" onclick="change_icon('<?php echo $length;?>','<?php echo $width;?>','<?php echo $name;?>','<?php echo $ladies;?>','<?php echo $fare_amount;?>','<?php echo $j;?>');" id="sl<?php echo $j;?>seat<?php echo $name;?>"/>

							<?php }else if($available =='true'){?>

							<img src="busimages/available_sleeper.jpg"  alt="Available Sleeper" onclick="change_icon('<?php echo $length;?>','<?php echo $width;?>','<?php echo $name;?>','<?php echo $ladies;?>','<?php echo $fare_amount;?>','<?php echo $j;?>');" id="sl<?php echo $j;?>seat<?php echo $name;?>"/>

							<?php }elseif($ladies=='true' && $available =='false'){?>

							<img src="busimages/booked_sleeper.jpg"  alt="Booked Ladies Sleeper" />

							<?php }else {?>

							<img src="busimages/booked_sleeper.jpg"  alt="Booked Sleeper"/>

					<?php } }elseif($length =='1' && $width=='2') {

							if($ladies=='true' && $available =='true'){?>

							<img src="busimages/ladies_sleeper2.jpg"  alt="Ladies Sleeper" onclick="change_icon('<?php echo $length;?>','<?php echo $width;?>','<?php echo $name;?>','<?php echo $ladies;?>','<?php echo $fare_amount;?>','<?php echo $j;?>');" id="sl<?php echo $j;?>seat<?php echo $name;?>"/>

							<?php }else if($available =='true'){?>

							<img src="busimages/available_sleeper2.jpg"  alt="Available Sleeper" onclick="change_icon('<?php echo $length;?>','<?php echo $width;?>','<?php echo $name;?>','<?php echo $ladies;?>','<?php echo $fare_amount;?>','<?php echo $j;?>');" id="sl<?php echo $j;?>seat<?php echo $name;?>"/>

							<?php }else if($ladies=='true' && $available =='false'){?>

							<img src="busimages/booked_sleeper2.jpg"  alt="Booked Ladies Sleeper" />

							<?php }else {?>

							<img src="busimages/booked_sleeper2.jpg"  alt="Booked Sleeper"/>

					  <?php } } ?>

				</a>

              <?php }?></td>

            <?php }?>

          </tr>

          <?php }?>

          <tr>

            <td height="10" colspan="150"></td>

          </tr>

        </table>

    <?php } if(!empty($text_array1)) {?> <br/>

        <table width="100%" align="center" cellpadding="0" cellspacing="0" border="0" style=" border:1px solid #e5e5e5;">

      <tr>

        <td height="10" colspan="150"></td>

      </tr>

       <?php 

            $img='<img src="busimages/steering1.jpg"  alt="Driver seat"  align="absmiddle" style="padding-right:10px;"/>';

        ?>

      <?php for($r=0; $r <=$maxrow; $r++) {?>

      <tr>

        <?php for($c=0; $c <= $maxcolm; $c++) {

        $available1 = "{$text_array1[$r][$c]->available}" ;

        $ladies1 = "{$text_array1[$r][$c]->ladiesSeat}" ;

        $length1 = "{$text_array1[$r][$c]->length}" ;

        $width1 = "{$text_array1[$r][$c]->width}" ;

        $name1 = "{$text_array1[$r][$c]->name}";

        $fare_amount1 = "{$text_array1[$r][$c]->fare}";

		

        ?>

        <td ><?php echo $img; $img='';?></td>

        <td height="25" valign="middle" ><?php 

          if("{$text_array1[$r][$c]->name}" != ''){

			$mf=$text_array1[$r][$c]->fare;

			$mf1=$mf; 

			$curr_amt=number_format(($_SESSION['currency_value']*$mf1),2);

			$curr_type="";

			if(isset($_SESSION['currency_type'])){ $curr_type=$_SESSION['currency_type'].' '; }else { $curr_type='INR '; }

			$titlea='<small><strong>Seat Number : '."{$text_array1[$r][$c]->name}".' <br/>'. 'Fare : '.$curr_type.' '.$curr_amt.'</strong></small>';

		  ?>

          <a href="javascript:void(0);" class="" data-toggle="tooltip" title="<?=htmlspecialchars($titlea)?>" data-html="true">

            <?php 

              if($length1 =='1' && $width1=='1'){

                    if($ladies1=='true' && $available1 =='true'){?>

                    <img src="busimages/available_ladies.jpg"  alt="Ladies Seat" onclick="change_icon('<?php echo $length1;?>','<?php echo $width1;?>','<?php echo $name1;?>','<?php echo $ladies1;?>','<?php echo $fare_amount1;?>','<?php echo $j;?>');" id="sl<?php echo $j;?>seat<?php echo $name1;?>"/>

                    <?php }else if($available1 =='true'){?>

                    <img src="busimages/available.jpg"  alt="Available Seat" onclick="change_icon('<?php echo $length1;?>','<?php echo $width1;?>','<?php echo $name1;?>','<?php echo $ladies1;?>','<?php echo $fare_amount1;?>','<?php echo $j;?>');" id="sl<?php echo $j;?>seat<?php echo $name1;?>"/>

                    <?php }else if($ladies1=='true' && $available1 =='false'){?>

                    <img src="busimages/booked.jpg"  alt="Booked Ladies Seat"/>

                    <?php }else {?>

                    <img src="busimages/booked.jpg"  alt="Booked Seat" />

             <?php } }else if($length1 =='2' && $width1=='1') {

                    if($ladies1=='true' && $available1 =='true'){?>

                    <img src="busimages/ladies_sleeper.jpg"  alt="Ladies Sleeper" onclick="change_icon('<?php echo $length1;?>','<?php echo $width1;?>','<?php echo $name1;?>','<?php echo $ladies1;?>','<?php echo $fare_amount1;?>','<?php echo $j;?>');" id="sl<?php echo $j;?>seat<?php echo $name1;?>"/>

                    <?php }else if($available1 =='true'){?>

                    <img src="busimages/available_sleeper.jpg"  alt="Available Sleeper" onclick="change_icon('<?php echo $length1;?>','<?php echo $width1;?>','<?php echo $name1;?>','<?php echo $ladies1;?>','<?php echo $fare_amount1;?>','<?php echo $j;?>');" id="sl<?php echo $j;?>seat<?php echo $name1;?>"/>

                    <?php }else if($ladies1=='true' && $available1 =='false'){?>

                    <img src="busimages/booked_sleeper.jpg"  alt="Booked Ladies Sleeper" />

                    <?php }else {?>

                    <img src="busimages/booked_sleeper.jpg"  alt="Booked Sleeper"/>

            <?php } }else if($length1 =='1' && $width1=='2') {

                    if($ladies1=='true' && $available1 =='true'){?>

                    <img src="busimages/ladies_sleeper2.jpg"  alt="Ladies Sleeper" onclick="change_icon('<?php echo $length1;?>','<?php echo $width1;?>','<?php echo $name1;?>','<?php echo $ladies1;?>','<?php echo $fare_amount1;?>','<?php echo $j;?>');" id="sl<?php echo $j;?>seat<?php echo $name1;?>"/>

                    <?php }else if($available1 =='true'){?>

                    <img src="busimages/available_sleeper2.jpg"  alt="Available Sleeper" onclick="change_icon('<?php echo $length1;?>','<?php echo $width1;?>','<?php echo $name1;?>','<?php echo $ladies1;?>','<?php echo $fare_amount1;?>','<?php echo $j;?>');" id="sl<?php echo $j;?>seat<?php echo $name1;?>"/>

                    <?php }else if($ladies1=='true' && $available1 =='false'){?>

                    <img src="busimages/booked_sleeper2.jpg"  alt="Booked Ladies Sleeper" />

                    <?php }else {?>

                    <img src="busimages/booked_sleeper2.jpg"  alt="Booked Sleeper"/>

              <?php } }?>

			</a>

          <?php }?></td>

        <?php }?>

      </tr>

      <?php }?>

      <tr>

        <td height="10" colspan="150"></td>

      </tr>

    </table>

    <?php }?>

    </td>

    <td height="25" align="left" valign="middle" class="mshd"><table width="100%" border="0">

      <tr>

        <td width="30%" align="center"><img src="busimages/available.jpg"  alt="Available Seat"/></td>

        <td width="70%" class="contenttext">Available Seats</td>

      </tr>

      <tr>

        <td align="center"><img src="busimages/available_ladies.jpg"  alt="Booked Seat"/></td>

        <td class="contenttext">Reserved For Ladies </td>

      </tr>

      <tr>

        <td align="center"><img src="busimages/booked.jpg"  alt="Booked Seat"/></td>

        <td class="contenttext">Booked Seats</td>

      </tr>

      <tr>

        <td align="center"><img src="busimages/selected.jpg"  alt="Booked Seat"/></td>

        <td class="contenttext">Selected Seats</td>

      </tr>

      <tr>

        <td align="center">&nbsp;</td>

        <td class="contenttext">&nbsp;</td>

      </tr>

    </table>

      <table width="100%" border="0">

        <tr>

          <td width="30%" align="center"><img src="busimages/available_sleeper.jpg"  alt="Available Sleeper"/></td>

          <td width="70%" class="contenttext">Available Sleeper </td>

        </tr>

        <tr>

          <td align="center"><img src="busimages/ladies_sleeper.jpg"  alt="Booked Seat"/></td>

          <td class="contenttext">Reserved For Ladies</td>

        </tr>

        <tr>

          <td align="center"><img src="busimages/booked_sleeper.jpg"  alt="Booked Seat"/></td>

          <td class="contenttext">Booked Sleeper</td>

        </tr>

        <tr>

          <td align="center"><img src="busimages/selected_sleeper.jpg"  alt="Booked Seat"/></td>

          <td class="contenttext">Selected Sleeper</td>

        </tr>

      </table></td>

  </tr>

  <tr colspan="3">

	&nbsp;

  </tr>

  <tr>

    <td height="25" align="left" valign="middle" >&nbsp;</td>

    <td align="center" valign="middle" width:"200">

    <select name="cmbBoardingPoint<?php echo $j; ?>" id="cmbBoardingPoint<?php echo $j; ?>" class="form-control textfield" style="float: left;width:250px;border-radius: 5px !important;margin-right: 10px;">

      <option value="0">--Boarding Points--</option>

      <?php 

	  	if(count($result->availableTrips)==1){

			$value= $result->availableTrips;

			   if( $value->id == $tripid){ 

					if(count($value->boardingTimes) ==1){

						$bpId = "{$value->boardingTimes->bpId}";

						$bplocation = "{$value->boardingTimes->location}";

						$b = "{$value->boardingTimes->time}";

						$bhour = floor($b/60);

						while($bhour >24){

							$bhour=$bhour-24;

						}

						$bmin = ($b %60);

						$bhrmin = $bhour .":".$bmin; 

						$boardingtime  = date ("g:i A", strtotime($bhrmin)); 

					?>

					<option value="<?php echo $bpId;?>" > <?php echo $bplocation." - ".$boardingtime;?></option>

					<?php

					}elseif(count($value->boardingTimes) >1){

						foreach($value->boardingTimes as $v){

						$b = "{$v->time}";

						$bhour = floor($b/60);

						while($bhour >24){

							$bhour=$bhour-24;

						}

						$bmin = ($b %60);

						$bhrmin = $bhour .":".$bmin; 

						$boardingtime  = date ("g:i A", strtotime($bhrmin));

					?>

					<option value="<?php echo "{$v->bpId}";?>" > <?php echo "{$v->location}"." - ".$boardingtime;?></option>

		  <?php }} } 

		}elseif(count($result->availableTrips)>1){

	   		foreach ( $result->availableTrips as $value ) {

		   if( $value->id == $tripid){ 

		   		if(count($value->boardingTimes) ==1){

					$bpId = "{$value->boardingTimes->bpId}";

					$bplocation = "{$value->boardingTimes->location}";

					$b = "{$value->boardingTimes->time}";

					$bhour = floor($b/60);

					while($bhour >24){

						$bhour=$bhour-24;

					}

					$bmin = ($b %60);

					$bhrmin = $bhour .":".$bmin; 

					$boardingtime  = date ("g:i A", strtotime($bhrmin)); 

				?>

				

                <option value="<?php echo $_SESSION['BPLOC']=$bpId;?>" > <?php echo $bplocation." - ".$boardingtime;?></option>

                <?php

                

				}elseif(count($value->boardingTimes) >1){

					foreach($value->boardingTimes as $v){

					$b = "{$v->time}";

					$bhour = floor($b/60);

					while($bhour >24){

						$bhour=$bhour-24;

					}

					$bmin = ($b %60);

					$bhrmin = $bhour .":".$bmin; 

					$boardingtime  = date ("g:i A", strtotime($bhrmin));

				?>

      			<option name="loc" value="<?php echo "{$v->bpId}";?>" > <?php echo "{$v->location}"." - ".$boardingtime;?></option>

      <?php }}} } }?>

      

    </select>

      &nbsp; &nbsp; 

     <select name="cmbDroppingPoint<?php echo $j; ?>" id="cmbDroppingPoint<?php echo $j; ?>" class="form-control textfield" style="float: left;width:250px;border-radius: 5px !important;margin-right: 10px;">

      <option value="0">--Dropping Points--</option>

      <?php 

	  	if(count($result->availableTrips)==1){

			$value= $result->availableTrips;

			   if( $value->id == $tripid){ 

					if(count($value->droppingTimes) ==1){

						$bpId = "{$value->droppingTimes->bpId}";

						$bplocation = "{$value->droppingTimes->location}";

						$b = "{$value->droppingTimes->time}";

						$bhour = floor($b/60);

						while($bhour >24){

							$bhour=$bhour-24;

						}

						$bmin = ($b %60);

						$bhrmin = $bhour .":".$bmin; 

						$boardingtime  = date ("g:i A", strtotime($bhrmin)); 

					?>

					<option value="<?php echo $bpId;?>" > <?php echo $bplocation." - ".$boardingtime;?></option>

					<?php

					}elseif(count($value->droppingTimes) >1){

						foreach($value->droppingTimes as $v){

						$b = "{$v->time}";

						$bhour = floor($b/60);

						while($bhour >24){

							$bhour=$bhour-24;

						}

						$bmin = ($b %60);

						$bhrmin = $bhour .":".$bmin; 

						$boardingtime  = date ("g:i A", strtotime($bhrmin));

					?>

					<option value="<?php echo "{$v->bpId}";?>" > <?php echo "{$v->location}"." - ".$boardingtime;?></option>

		  <?php }} } 

		}elseif(count($result->availableTrips)>1){

	   		foreach ( $result->availableTrips as $value ) {

		   if( $value->id == $tripid){ 

		   		if(count($value->droppingTimes) ==1){

					$bpId = "{$value->droppingTimes->bpId}";

					$bplocation = "{$value->droppingTimes->location}";

					$b = "{$value->droppingTimes->time}";

					$bhour = floor($b/60);

					while($bhour >24){

						$bhour=$bhour-24;

					}

					$bmin = ($b %60);

					$bhrmin = $bhour .":".$bmin; 

					$boardingtime  = date ("g:i A", strtotime($bhrmin)); 

				?>

				

                <option value="<?php echo $_SESSION['BPLOC']=$bpId;?>" > <?php echo $bplocation." - ".$boardingtime;?></option>

                <?php

                

				}elseif(count($value->droppingTimes) >1){

					foreach($value->droppingTimes as $v){

					$b = "{$v->time}";

					$bhour = floor($b/60);

					while($bhour >24){

						$bhour=$bhour-24;

					}

					$bmin = ($b %60);

					$bhrmin = $bhour .":".$bmin; 

					$boardingtime  = date ("g:i A", strtotime($bhrmin));

				?>

      			<option name="loc" value="<?php echo "{$v->bpId}";?>" > <?php echo "{$v->location}"." - ".$boardingtime;?></option>

      <?php }}} } }?>

      

    </select>

      <button type="submit" name="continue" id="continue" class="btn btn-outline-primary border-radius-3" value="Continue" onclick=" return check_boarding_points('<?php echo $j;?>');">Continue</button>



      </td>

    

  </tr>

  <tr>

      <td align="left" valign="middle">&nbsp;</td>

      <td  align="left" valign="middle" class="mblcss" id="faretable<?php echo $j; ?>"><table border="0" width="100%" style="margin-top: 15px;">

      <tr>

        <td width="55%" align="left" valign="top" class="contenttext">Selected Seats : </td>

        <td width="45%" align="left" valign="top" class="contenttextred"  id="st<?php echo $j;?>">&nbsp;</td>

        <input type="hidden" id="hid_st<?php echo $j;?>" name="hid_st<?php echo $j;?>" value=""/>

      </tr>

      <tr>

        <td valign="top" class="contenttext">Amount:</td>

        <td align="left" valign="top" class="contenttextred" id="amt<?php echo $j;?>">&nbsp;</td>

        <input type="hidden" id="hid_amt<?php echo $j;?>" name="hid_amt<?php echo $j;?>" value=""/>

      </tr>

    </table></td>

  </tr>

  <tr>

    <td height="25" align="left" valign="middle" >&nbsp;</td>

    <td align="left" valign="middle" >&nbsp;</td>

  </tr>

  <?php }else{?>

  <tr>

    <td height="25" colspan="2" align="center" valign="middle" class="noRecords">No Information Available Now.Please wait.</td>

    </tr>

  <?php }?>

</table>

</form>

                                    <div id="legend"></div>

                                  </div>

                                 

                                </div>

                              </div>

                              <div class="tab-pane fade" id="second" role="tabpanel" aria-labelledby="second-tab">

                                <table class="table table-hover table-bordered bg-light">

                                  <thead>

                                    <tr>

                                      <td>Hours before Departure</td>

                                      <td class="text-center">Refund Percentage</td>

                                    </tr>

                                  </thead>

                                  <tbody>

                                    <tr>

                                      <td>Before 0 Hrs.</td>

                                      <td class="text-center">0%</td>

                                    </tr>

                                    <tr>

                                      <td>Before 24 Hrs.</td>

                                      <td class="text-center">30%</td>

                                    </tr>

                                    <tr>

                                      <td>Before 48 Hrs.</td>

                                      <td class="text-center">60%</td>

                                    </tr>

                                    <tr>

                                      <td>Before 60 Hrs.</td>

                                      <td class="text-center">75%</td>

                                    </tr>

                                    <tr>

                                      <td>Above 60 Hrs. </td>

                                      <td class="text-center">80%</td>

                                    </tr>

                                  </tbody>

                                </table>

                                <p class="font-weight-bold">Terms & Conditions</p>

                                <ul>

                                  <li>The penalty is subject to 24 hrs before departure. No Changes are allowed after that.</li>

                                  <li>The charges are per seat.</li>

                                  <li>Partial cancellation is not allowed on tickets booked under special discounted fares.</li>

                                  <li>In case of no-show or ticket not cancelled within the stipulated time, only statutory taxes are refundable subject to Service Fee.</li>

                                </ul>

                              </div>

                            </div>

                          </div>