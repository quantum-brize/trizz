<?php 
 


$ssr_result= $_SESSION['SSR'];

$RowSeats= $ssr_result['Response']['SeatDynamic'][0]['SegmentSeat'][0]['RowSeats'];

//echo '<pre>';print nl2br(print_r($RowSeats, true));echo '</pre>';

$dataPassenger=$_REQUEST['dataPassenger'];

?>



<style>

    .abc:active{

    background-color: #20bf7a !IMPORTANT;

}



.abc:focus{

    background-color: #20bf7a !IMPORTANT;

}

.abc:hover{

    background-color: #20bf7a !IMPORTANT;

}

.mfp-dialog {

    background: #fff;

    padding: 20px 10px;}

.seatCharts-container { border: 0px solid #ddd !important; border-radius: 4px; padding: 0px 16px 20px 0px !important; display: inline-block; position: relative; background-color: #fff;min-width: 280px; }

</style>
<div class="modal-body">

        <div class="bus-details" style="background-color: #add6ef; padding: 5px 2px; margin-top: 10px; border-radius: 10px;">

     

          <div class="tab-content my-3" id="myTabContent">

            <div class="tab-pane fade show active" id="first" role="tabpanel" aria-labelledby="first-tab">

              <div class="row">

                <div class="col-12 col-lg-7 text-center">

 <div style="background-image: url(images/ic_flightSmallFront.1e0e0ad4.png);     margin-top: 10px; background-repeat: no-repeat; background-size: 100% auto; width: 280px; height: 206px; margin: auto; position:relative;">
 
 <div id="legend" class="seatCharts-legend" style="position:absolute; width:100%; margin-top:177px;">

                    <ul class="seatCharts-legendList">

                      <li class="seatCharts-legendItem">

                        <div class="seatCharts-seat seatCharts-cell available first-class"></div>

                        <span class="seatCharts-legendDescription">Available</span></li>

                      

                      <li class="seatCharts-legendItem">

                        <div class="seatCharts-seat seatCharts-cell unavailable first-class"></div>

                        <span class="seatCharts-legendDescription">Already Booked</span></li>

                    </ul>

                  </div>
 </div>

                  <div id="seat-map" class="seatCharts-container" tabindex="0" aria-activedescendant="3_4"  style="margin-bottom:-20px;">

                   
                    <?php $ab=0; foreach($RowSeats as $valArray){ ?>

                    <div class="seatCharts-row">

                      <div class="seatCharts-cell seatCharts-space"><?php if($ab >0){echo $ab;} ?></div>

                      <?php 

                          $ac=1;

                          $Seats= $valArray['Seats'];

                          foreach($Seats as $valArr){

                      ?>

                      <?php if($valArr['AvailablityType']=='1'){ ?>

                      <div id="1_1" role="checkbox" aria-checked="false" focusable="true" tabindex="-1" class="seatCharts-seat seatCharts-cell first-class available abc tooltiptext" data-toggle="tooltip" data-placement="top" title="Seat No: <?php echo $valArr['Code']; ?> | Seat Amount: <?php echo $valArr['Currency'].' '.$valArr['Price']; ?>" onclick="change_icon('<?php echo $valArr['Code'];?>','<?php echo $valArr['Price'];?>','<?php echo $ac;?>','<?php echo $dataPassenger; ?>');" id="sl<?php echo $ac;?>seat<?php echo $valArr['Code'];?>amt<?php echo $valArr['Price'];?>"><?php echo $valArr['Code']; ?></div>

                      <?php }else if($valArr['AvailablityType']=='3'){ ?>

                       <div id="1_1" role="checkbox" aria-checked="false" focusable="true" tabindex="-1" class="seatCharts-seat seatCharts-cell first-class unavailable tooltiptext" data-toggle="tooltip" data-placement="top" title="Seat No: <?php echo $valArr['Code']; ?> | Seat Amount: <?php echo $valArr['Currency'].' '.$valArr['Price']; ?>" onclick="change_icon('<?php echo $valArr['Code'];?>','<?php echo $valArr['Price'];?>','<?php echo $ac;?>','<?php echo $dataPassenger; ?>');" id="sl<?php echo $ac;?>seat<?php echo $valArr['Code'];?>amt<?php echo $valArr['Price'];?>"><?php echo $valArr['Code']; ?></div>

                      <?php } ?>

                      <?php if($ac == '3'){?>

                      <div class="seatCharts-cell seatCharts-space"></div>

                      <?php } ?>

                      <?php $ac++; } ?>

                      

                    </div>

                    <?php $ab++; } ?>

                    

                   

                  </div>
				  
				 
<div style="background-image: url(images/ic_flightSmallTail.aa15f774.png); background-repeat: no-repeat; background-size: 100% auto; width: 280px; height:355px; margin: auto; position:relative;">
</div>
                  

                </div>

                <div class="col-12 col-lg-5 mt-3 mt-lg-0">

                  <div class="booking-details">
				  <table border="0" cellpadding="10" cellspacing="0" style="font-size: 14px; padding: 20px; background-color: #fff; border-radius: 10px; margin: auto; margin-top: 40px; position: absolute; right: 20px; width: 200px; box-shadow: 0px 0px 10px #00000026;">
  <tr>
    <td colspan="2" style="font-size:20px; font-weight:700;">Selected Seat</td>
    </tr>
  <tr>
    <td>Selected Seat:</td>
    <td><span class="font-weight-medium seatval" id=""></span></td>
  </tr>
  <tr>
    <td>Seat Fare: (INR)</td>
    <td><span class="font-weight-medium seatvalamt" id=""></span></td>
  </tr>
  <tr>
    <td colspan="2"><button class="btn btn-danger btn-block mfp-close close"   data-dismiss="modal" aria-label="Close" style="position: relative; color: #fff; background-color: #e52b30; font-size: 18px; font-weight: 700; width:100%;">Continue</button></td>
    </tr>
</table>
 

                  </div>

                </div>

              </div>

            </div>

          </div>

        </div>

      </div>

