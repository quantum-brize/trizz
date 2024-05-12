<div class="footerblank"></div>
<div id="footermenu">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="20%" align="center"><a <?php if($selectpage==1){ ?>class="active"<?php } ?> onClick="selectfootertabs('t1')" id="t1"><i class="fa fa-home" aria-hidden="true"></i><div>Dashboard</div></a></td>
    <td width="20%" align="center"><a <?php if($selectpage==2){ ?>class="active"<?php } ?> onClick="selectfootertabs('t2')" id="t2"><i class="fa fa-suitcase" aria-hidden="true"></i><div>Bookings</div></a></td>
   <td width="20%" align="center" style="position:relative;"><a onClick="selectfootertabs('t4')"  <?php if($selectpage==4){ ?>class="active"<?php } ?>  id="t4" style="position: absolute; top: -22px; width: 100%;"><i class="fa fa-percent" aria-hidden="true" style="background-color: #f10e0e; padding: 12px 14px; font-size: 20px; border-radius: 40px; color: #fff !important;"></i><div>Offers</div></a></td>
    <td width="20%" align="center"><a onClick="selectfootertabs('t3')" <?php if($selectpage==3){ ?>class="active"<?php } ?> id="t3"><i class="fa fa-list-alt" aria-hidden="true"></i>
      <div>Invoice</div>
    </a></td>
    
    <td width="20%" align="center"><a <?php if($selectpage==5){ ?>class="active"<?php } ?> onClick="selectfootertabs('t5')" id="t5"><i class="fa fa-user" aria-hidden="true"></i>
      <div>Profile</div>
    </a></td>
  </tr>
</table>

</div>

<script>
function selectfootertabs(id){
$('#footermenu a').removeClass('active');
$('#footermenu #'+id).addClass('active'); 
 

if(id=='t1'){
$('body').load('dashboard.php');
}

if(id=='t5'){ 
$('body').load('profile.php');
}
if(id=='t3'){ 
$('body').load('invoicepage.php');
}
if(id=='t2'){ 
$('body').load('bookingpage.php');
}
if(id=='t4'){ 
$('body').load('offer.php');
}

}
</script>