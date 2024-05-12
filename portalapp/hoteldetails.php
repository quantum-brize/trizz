<?php
include "inc.php";  

$url = $basesiteurl."hoteldetail_mobile.php";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);

		$data = array(
		'MemberId' => $_SESSION['userId'],
		'hotelId' =>  $_REQUEST['id']
); 

curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
$contents = curl_exec($ch);
$contentres=json_decode($contents,true); 
curl_close($ch); 
 
  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
  <title>Holidays Details</title>
  <?php
  include "headerinc.php";
  ?>

  

  <style>
    /* parent of book-container & container (slider) */
    main {
      overflow: hidden;
      display: flex;
      justify-content: space-between;
    }

    /* wraps entire slider */
    .slider-wrapper {
      overflow: hidden;
      width: 100%;
      position: relative;
    }

    .slider-nav {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      text-align: center;
      margin: 0;
      padding: 1%;
      background: rgba(0, 0, 0, 0.6);
      color: #fff;
    }

    /* slider controls*/
    .control {
      position: absolute;
      top: 50%;
      width: 40px;
      height: 10px;
      color: #fff;
      font-size: 3rem;
      padding: 0;
      margin: 0;
      line-height: 5px;
    }

    .prev,
    .next {
      cursor: pointer;
      transition: all 0.2s ease;
      -webkit-touch-callout: none;
      -webkit-user-select: none;
      -khtml-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
      background: rgba(0, 0, 0, 0.3);
      padding: 8px;
      font-size: 18px;
      width: auto;
      transform: none !important;
      border-radius: 5px;
    }

    .prev {
      left: 1.1rem;
    }

    .next {
      right: 1.1rem;
    }

    .prev:hover,
    .next:hover {
      transform: scale(1.5, 1.5);
    }

    .slider-container {
      display: flex;
      align-items: center;
      overflow-y: hidden;
      width: 100%;
      /* fallback */
      width: calc(var(--n)*100%);
      transform: translate(calc(var(--i, 0)/var(--n)*-100% + var(--tx, 0px)));
      margin-top: 48px;
      max-height: 190px;
    }

    /* transition animation for the slider */
    .smooth {
      /* f computes actual animation duration via JS */
      transition: transform calc(var(--f, 1)*.5s) ease-out;
    }

    /* images for the slider */
    img {
      width: 100%;
      /* can't take this out either as it breaks Chrome */
      width: calc(100%/var(--n));
      pointer-events: none;
    }
  </style> 
  
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css"> 
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
</head>

<body>

  <div class="innerpageaccountheader" style="width:100% !important;"><i class="fa fa-arrow-left" aria-hidden="true" onclick="closeWindow();"></i>Hotels </div>
<?php

 
  foreach($contentres['Hotels'] as $list) { 
 ?>

  <div class="slider-wrapper">

    <div class="slider-container">
      <?php
      foreach($contentres['Gallery'] as $listgallery) { 
      ?>
        <img src="<?php echo $listgallery['url']; ?>"> 
      <?php  } ?>
    </div>

    <div class="slider-controls">
      <span class="control prev">&larr;</span>
      <span class="control next">&rarr;</span>
    </div>

  </div>


  <section class="bodypading">

    <div class="hotelscontent">
      <div class="flexcontent">
        <div><?php   $i=1;while($i<=$list['category']) { ?><i class="fa fa-star" aria-hidden="true"></i><?php $i++; } ?>
          <h6><?php echo $list['hotelName']; ?></h6>
        </div> 
      </div><!-- flexcontent  -->

      <div class="locationdiv">
        <i class="fa fa-map-marker" aria-hidden="true"></i>
        <p> <?php echo $list['address']; ?></p>
      </div>
    </div><!-- hotelscontent  -->



    <div class="details2">
      <h5>Details</h5> 
      <p><?php echo $list['description']; ?> </p> 
    </div>
 

    <div class="amentiesdiv">
    <h5>Amenties</h5>
	
	  
	
      <div class="servicetab">
        <ul>
		<?php
	$a=0;
      foreach($contentres['Aminities'] as $listam) { 
      ?> 
          <li><i class="fa fa-check" aria-hidden="true"></i>&nbsp; <?php echo $listam['amname']; ?></li>
		      <?php  $a++; } ?>
        </ul>
      </div>
    </div>


    <div class="deluxeroom">
      <h5>Select Room</h5>

<?php $r=1; foreach($contentres['Room'] as $listam) { ?>
      <div class="card carddeluxe" style="background-color:#EDF6FF;">
        <div class="card-body">
          <h4 style="color:#000000;"><?php echo $listam['RoomName']; ?></h4>
		   <?php if($listam['Refund']=='Refundable'){?>
          <h6><i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp; Refundable</h6>
          <h6 style="color:#CC0000; margin-top:4px;">Free Cancellation Till: <?php echo $listam['CancellationDate']; ?></h6>
		  <?php } else { ?>
		  <h6 style="color:#CC0000;"><i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp; Non Refundable</h6>
		  <?php  } ?>
          <div style="border: 1px solid #dddddd94;margin:10px 0px;"></div>

          <ul class="listli">
		  <li style="font-size:13px; font-weight:600; color:#04B774;"><i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp;<?php echo $listam['RoomType']; ?></li> 
		  <li style="font-size:13px; font-weight:600;"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>&nbsp;Check-In: &nbsp;<?php echo date('d-m-Y',strtotime($_REQUEST['checkInDate'])); ?> | &nbsp;Check-Out: &nbsp;<?php echo date('d-m-Y',strtotime($_REQUEST['checkOutDate'])); ?></li> 
		  
		    <li style="font-size:13px; font-weight:600;"><i class="fa fa-user" aria-hidden="true"></i> &nbsp;Adult(s): <?php echo $_REQUEST['adult']; ?> &nbsp;|&nbsp; Child(s): <?php echo $_REQUEST['child']; ?></li> 
			
			 <li style="font-size:13px; font-weight:600;"><i class="fa fa-hospital-o" aria-hidden="true"></i> &nbsp;Room(s): <?php echo $_REQUEST['empcount']; ?></li> 
			 <li style="font-size:13px; font-weight:600; color:#CC0000; font-weight:600;" onclick="$('#canpolicy<?php echo $r; ?>').toggle();"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i> &nbsp;Cancellation Policy </li> 
          </ul>
		  <?php 
		  $values=(unserialize($listam['CancellationPolicy'])); 
		     ?>
		  <div style="margin-top:10px; display:none;" id="canpolicy<?php echo $r; ?>">
		  <table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC" style=" font-size:13px; font-weight:600;">

   <tr>

     <td bgcolor="#F4F4F4"><strong>From Date</strong></td>

     <td bgcolor="#F4F4F4"><strong>To Date</strong></td>

     <td bgcolor="#F4F4F4"><strong>Penalty amount</strong></td>

   </tr>

  <?php  foreach($values as $hotelList){ ?>

   <tr>

     <td style="border-bottom: 1px solid #ddd;"><?php echo $hotelList->fdt; ?></td>

     <td style="border-bottom: 1px solid #ddd;"><?php echo $hotelList->tdt; ?></td>

     <td style="border-bottom: 1px solid #ddd;">&#8377;<?php echo $hotelList->am; ?></td>

   </tr>

   <?php } ?>

 

</table>
		  </div>
  
           <div style="border: 1px solid #dddddd94;margin:10px 0px;"></div>

           <div class="priceinquery">
            <div><h6>₹<?php echo round($listam['Price']); ?></h6></div>
            <div class="bookbtn"><button type="button" class="btn btn-dark">Send Enquiry</button><button type="button" class="btn btn-danger">Book</button></div>
           </div><!-- priceinquery  -->
        </div> <!-- card-body  -->
      </div> 
<?php $r++; } ?>
    

    </div><!-- deluxerooms -->
  </section>
 <script>
//  set --n (used for calc in CSS) via JS, after getting
// .container and the number of child images it holds:

const _C = document.querySelector(".slider-container"),
  N = _C.children.length;

_C.style.setProperty("--n", N);

// detect the direction of the motion between "touchstart" (or "mousedown") event
// and the "touched" (or "mouseup") event
// and then update --i (current slide) accordingly
// and move the container so that the next image in the desired direction moves into the viewport

// on "mousedown"/"touchstart", lock x-coordiate
// and store it into an initial coordinate variable x0:
let x0 = null;
let locked = false;

function lock(e) {
  x0 = unify(e).clientX;
  // remove .smooth class
  _C.classList.toggle("smooth", !(locked = true));
}

// next, make the images move when the user swipes:
// was the lock action performed aka is x0 set?
// if so, read current x coordiante and compare it to x0
// from the difference between these two determine what to do next

let i = 0; // counter
let w; //image width

// update image width w on resive
function size() {
  w = window.innerWidth;
}

function move(e) {
  if (locked) {
    // set threshold of 20% (if less, do not drag to the next image)
    // dx = number of pixels the user dragged
    let dx = unify(e).clientX - x0,
      s = Math.sign(dx),
      f = +(s * dx / w).toFixed(2);

    // Math.sign(dx) returns 1 or -1
    // depending on this, the slider goes backwards or forwards

    if ((i > 0 || s < 0) && (i < N - 1 || s > 0) && f > 0.2) {
      _C.style.setProperty("--i", (i -= s));
      f = 1 - f;
    }

    _C.style.setProperty("--tx", "0px");
    _C.style.setProperty("--f", f);
    _C.classList.toggle("smooth", !(locked = false));
    x0 = null;
  }
}

size();

addEventListener("resize", size, false);

// ===============
// drag-animation for the slider when it reaches the end
// ===============

function drag(e) {
  e.preventDefault();

  if (locked) {
    _C.style.setProperty("--tx", `${Math.round(unify(e).clientX - x0)}px`);
  }
}

// ===============
// prev, next
// ===============
let prev = document.querySelector(".prev");
let next = document.querySelector(".next");

prev.addEventListener("click", () => {
  if (i == 0) {
    console.log("start reached");
  } else if (i > 0) {
    // decrease i as long as it is bigger than the number of slides
    _C.style.setProperty("--i", i--);
  }
});

next.addEventListener("click", () => {
  if (i < N) {
    // increase i as long as it's smaller than the number of slides
    _C.style.setProperty("--i", i++);
  }
});

// ===============
// slider event listeners for mouse and touch (start, move, end)
// ===============

_C.addEventListener("mousemove", drag, false);
_C.addEventListener("touchmove", drag, false);

_C.addEventListener("mousedown", lock, false);
_C.addEventListener("touchstart", lock, false);

_C.addEventListener("mouseup", move, false);
_C.addEventListener("touchend", move, false);

// override Edge swipe behaviour
_C.addEventListener(
  "touchmove",
  e => {
    e.preventDefault();
  },
  false
);

// unify touch and click cases:
function unify(e) {
  return e.changedTouches ? e.changedTouches[0] : e;
}

</script>
<?php } ?>
  <?php
  include "footerinc.php";
  ?>

</body>

</html>