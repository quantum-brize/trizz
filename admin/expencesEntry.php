<?php
include "inc.php";



if($_REQUEST['st']=='add' && $_REQUEST['id']!=''){
$namevalue ='expencesId="'.$_REQUEST['id'].'",addDate="'.date('Y-m-d H:i:s').'",addBy="'.$_SESSION['userid'].'",dueDate="'.date('Y-m-d').'"';  
addlisting('tourExpencesEntry',$namevalue); 
}


if($_REQUEST['st']=='dlt' && $_REQUEST['id']!='' && $_REQUEST['did']!=''){ 
deleteRecord('tourExpencesEntry',' id="'.$_REQUEST['did'].'" and expencesId="'.$_REQUEST['id'].'"');
//deleteRecord('quotationPricemaster',' tourExpencesEntryId="'.$_REQUEST['did'].'"');
}

?>
<form method="post" id="sorting<?php echo $_REQUEST['id']; ?>" action="tourExpence/sortingactionpage.php" target="sortingfrm">
<table width="100%" border="2" cellpadding="5" cellspacing="0" bordercolor="#FFFFFF" id="stbl<?php echo $_REQUEST['id']; ?>">
  <tr style="background-color: #e9e9e9; border-left:5px solid #515151; border-top: 1px solid #4d4d4d;">
    <td width="25%" align="left"><strong>Details </strong></td>
    <td width="12%" align="center"><strong>Booking</strong></td>
    <td width="12%" align="center"><strong>Due Date </strong></td>
    <td width="12%" align="center"><strong>Status</strong></td>
    <td width="12%" align="center"><strong>Supplier</strong></td>
    <td width="12%" align="center"><strong>Buy </strong></td>
    <td width="12%" align="center" style="position:relative; padding-right:20px;"><strong>Sale</strong></td>
    <td width="12%" align="center" style="position:relative; padding-right:20px;"><strong>Profit</strong></td>
    <td width="12%" align="center" style="position:relative; padding-right:20px;"><strong>Invoice</strong></td>
    <td width="1%" align="center" style="position:relative; padding-right:20px;"><div class="listdownarrow2" style="position:absolute; right:7px;top: 3px; cursor:pointer;"  onClick="addloadentryexp<?php echo $_REQUEST['id']; ?>('add');"><i class="fa fa-plus" aria-hidden="true"></i></div></td></tr>
 
 <?php   
  


$rs=GetPageRecord('*','tourExpencesEntry','  expencesId="'.$_REQUEST['id'].'" order by id asc');
while($rest=mysqli_fetch_array($rs)){ 
?> 

<script>
function saveexpcontent<?php echo $rest['id']; ?>(){
var details = encodeURI($('#details<?php echo $rest['id']; ?>').text()); 
var amount = Number(encodeURI($('#amount<?php echo $rest['id']; ?>').text())); 
var sellamount = Number(encodeURI($('#sellamount<?php echo $rest['id']; ?>').text())); 
var supplierId = encodeURI($('#supplierId<?php echo $rest['id']; ?>').val()); 
var dueDate = encodeURI($('#dueDate<?php echo $rest['id']; ?>').val()); 
var status = encodeURI($('#status<?php echo $rest['id']; ?>').val());  
var bookingStatusId = encodeURI($('#bookingStatusId<?php echo $rest['id']; ?>').val()); 

$('#profit<?php echo $rest['id']; ?>').text(sellamount-amount);

$('#ActionDiv').load('saveExpencesDetails.php?id=<?php echo $rest['id']; ?>&details='+details+'&amount='+amount+'&sellamount='+sellamount+'&supplierId='+supplierId+'&dueDate='+dueDate+'&status='+status+'&bookingStatusId='+bookingStatusId);

}




</script>
  <tr>
    <td align="left" bgcolor="#f5f6f8" class="exlistingleftborder tdlistingex" style="position:relative;border-left:5px solid #515151; "><div class="editButton"></div><div contenteditable="true" id="details<?php echo $rest['id']; ?>" style="max-width:100%;" onKeyUp="saveexpcontent<?php echo $rest['id']; ?>();"><?php echo stripslashes($rest['details']); ?></div></td>
    <td align="center" bgcolor="#f5f6f8" class="tdlistingex bookingstatusfield">
	
	  <input name="rowidsorting[]" type="hidden" id="rowidsorting" value="<?php echo $rest['id']; ?>" />
	  <select id="bookingStatusId<?php echo $rest['id']; ?>" name="bookingStatusId" class="select2 form-control" onchange="chnagebookingstatuscolor<?php echo $rest['id']; ?>();saveexpcontent<?php echo $rest['id']; ?>();"  autocomplete="off" style="font-size: 12px; width: 140px; padding-right: 0px; padding-left: 4px; color:#fff; background-color:#<?php if($rest['bookingStatusId']==0){ ?>e77350<?php } ?><?php if($rest['bookingStatusId']==1){ ?>01c875<?php } ?><?php if($rest['bookingStatusId']==2){ ?>e3445a<?php } ?><?php if($rest['bookingStatusId']==3){ ?>a55cd9<?php } ?><?php if($rest['bookingStatusId']==4){ ?>323232<?php } ?>;" >  
<option value="0" <?php if($rest['bookingStatusId']==0){ ?>selected="selected"<?php } ?>>To do</option>  
<option value="1" <?php if($rest['bookingStatusId']==1){ ?>selected="selected"<?php } ?> >Done</option>     
<option value="2" <?php if($rest['bookingStatusId']==2){ ?>selected="selected"<?php } ?> >Waiting for Email</option>     
<option value="3" <?php if($rest['bookingStatusId']==3){ ?>selected="selected"<?php } ?> >Payment due</option>     
<option value="4" <?php if($rest['bookingStatusId']==4){ ?>selected="selected"<?php } ?> >Checking supplier</option>  
</select>	</td>
    <td align="center" bgcolor="#f5f6f8"  class="tdlistingex"><input name="textfield" type="text" class="datepick" id="dueDate<?php echo $rest['id']; ?>" style="border:0px; width:100%; text-align:center; background-color:transparent;" value="<?php if(date('d-m-Y',strtotime($rest['dueDate']))!='01-01-1970' ){ echo date('d-m-Y',strtotime($rest['dueDate'])); } ?>" /></td>
    <td align="center" bgcolor="#f5f6f8"  class="tdlistingex statusfield"><select id="status<?php echo $rest['id']; ?>" name="status" class="select2 form-control" onchange="chnagestatuscolor<?php echo $rest['id']; ?>();saveexpcontent<?php echo $rest['id']; ?>();"  autocomplete="off" style="width:100%; color:#fff; background-color:#<?php if($rest['status']==0){ ?>e1455b<?php } else {  ?>01c875<?php } ?>;" >  
<option value="0" <?php if($rest['status']==0){ ?>selected="selected"<?php } ?>>UNPAID</option>  
<option value="1" <?php if($rest['status']==1){ ?>selected="selected"<?php } ?> >PAID</option>     
</select></td>
    <td align="center" bgcolor="#f5f6f8"  class="tdlistingex"><select id="supplierId<?php echo $rest['id']; ?>" name="supplierId" class="select2 form-control"   autocomplete="off" style="width:100%;" onchange="saveexpcontent<?php echo $rest['id']; ?>();" >  
<option value="" >Select</option>  
 <?php  
$rs2=GetPageRecord('*','userMaster','  status=1 and userType=5 order by firstName asc');
while($restsup=mysqli_fetch_array($rs2)){ 
?> 
<option value="<?php echo $restsup['id']; ?>" <?php if($restsup['id']==$rest['supplierId']){ ?>selected="selected"<?php } ?>><?php echo $restsup['firstName']; ?> <?php echo $restsup['lastName']; ?></option>  
 <?php } ?>
</select></td>
    <td align="center" bgcolor="#f5f6f8"  class="tdlistingex"><div contenteditable="true" id="amount<?php echo $rest['id']; ?>" style="max-width:100%;" class="amountthb<?php echo $_REQUEST['id']; ?>" onKeyUp="totalamountcalculate<?php echo $_REQUEST['id']; ?>();saveexpcontent<?php echo $rest['id']; ?>();"><?php echo stripslashes($rest['amount']); ?></div></td>
    <td align="center" bgcolor="#f5f6f8" class="tdlistingex" style="position:relative; padding-right:20px;"><div contenteditable="true" id="sellamount<?php echo $rest['id']; ?>" style="max-width:100%;" onKeyUp="totalamountcalculate<?php echo $_REQUEST['id']; ?>();saveexpcontent<?php echo $rest['id']; ?>();" class="amountdoller<?php echo $_REQUEST['id']; ?>"><?php echo stripslashes($rest['sellAmount']); ?></div></td>
    <td align="center" bgcolor="#f5f6f8" class="tdlistingex" style="position:relative; padding-right:20px;"><div id="profit<?php echo $rest['id']; ?>"><?php echo round($rest['sellAmount']-$rest['amount']); ?></div></td>
    <td align="center" bgcolor="#f5f6f8" class="tdlistingex" style="position:relative; padding-right:20px;">&nbsp;</td>
    <td width="1%" align="center" bgcolor="#f5f6f8" class="tdlistingex" style="position:relative; padding-right:20px;"><div class="listdownarrow2" style="position:absolute; right:8px; top:12px; color:#CC0000; cursor:pointer;"  onClick="addloadentryexp<?php echo $_REQUEST['id']; ?>('dlt','<?php echo $rest['id']; ?>');"><i class="fa fa-trash" aria-hidden="true"></i></div></td>
  </tr>
  <script>
$('.datepick').each(function(){
dateFormat: 'yy-mm-dd',
    $(this).datepicker({dateFormat: 'dd-mm-yy'}).on("change", function() { saveexpcontent<?php echo $rest['id']; ?>(); });
	 
});

function chnagestatuscolor<?php echo $rest['id']; ?>(){
var status = $('#status<?php echo $rest['id']; ?>').val(); 

if(status==0){ 
$('#status<?php echo $rest['id']; ?>').css('background-color','#e1455b'); 
} else {
$('#status<?php echo $rest['id']; ?>').css('background-color','#01c875'); 
}

}




function chnagebookingstatuscolor<?php echo $rest['id']; ?>(){
var status = $('#bookingStatusId<?php echo $rest['id']; ?>').val(); 

if(status==0){ 
$('#bookingStatusId<?php echo $rest['id']; ?>').css('background-color','#e77350'); 
} 

if(status==1){ 
$('#bookingStatusId<?php echo $rest['id']; ?>').css('background-color','#01c875'); 
} 

if(status==2){ 
$('#bookingStatusId<?php echo $rest['id']; ?>').css('background-color','#e3445a'); 
} 

if(status==3){ 
$('#bookingStatusId<?php echo $rest['id']; ?>').css('background-color','#a55cd9'); 
} 

if(status==4){ 
$('#bookingStatusId<?php echo $rest['id']; ?>').css('background-color','#323232'); 
} 

}


</script>
  <?php } ?>
  <tr>
    <td height="31" colspan="10" align="left" bgcolor="#FFFFFF" style="background-color: #fff; cursor: pointer;border-left:5px solid #b2c6fd;" class="exlistingleftborder tdlistingex" onClick="addloadentryexp<?php echo $_REQUEST['id']; ?>('add');">+ Add</td>
  </tr>
  
   <tr>
    <td height="31" align="left" bgcolor="#FFFFFF" class=""></td>
    <td height="31" align="left" bgcolor="#FFFFFF" class=""></td>
    <td height="31" align="left" bgcolor="#FFFFFF" class=""></td>
    <td height="31" align="left" bgcolor="#FFFFFF" class=""></td>
    <td height="31" align="left" bgcolor="#FFFFFF" class=""></td>
    <td height="31" align="center" bgcolor="#FFFFFF" class="tdlistingex" style="font-size:16px; "><div style="margin-bottom:2px;font-weight:bold;"  id="totalthb<?php echo $_REQUEST['id']; ?>"></div>
      <div style=" font-size:11px; color:#999999">SUM</div></td>
    <td align="center" bgcolor="#FFFFFF" class="tdlistingex" style="font-size:16px; "><div style="margin-bottom:2px;font-weight:bold;"  id="totaldoller<?php echo $_REQUEST['id']; ?>"></div>
      <div style=" font-size:11px; color:#999999">SUM</div></td>
        <td align="center" bgcolor="#FFFFFF" class="tdlistingex" style="font-size:16px; "><div style="margin-bottom:2px;font-weight:bold;"  id="totalprofit<?php echo $_REQUEST['id']; ?>"></div>
      <div style=" font-size:11px; color:#999999">SUM</div></td>
    <td align="center" bgcolor="#FFFFFF" class="tdlistingex" style="font-size:16px; ">&nbsp;</td>
    <td height="31" align="center" bgcolor="#FFFFFF" class="tdlistingex" style="font-size:16px; ">&nbsp;</td>
  </tr>
</table>
</form>
     <!-- /.container -->

    <!-- Bootstrap & Core Scripts -->
 

    <script type="text/javascript">
	$("#stbl<?php echo $_REQUEST['id']; ?> tbody").sortable({
        handle: '.editButton',
          stop: function( event, ui ) {

                      var obj={};
        var len=$("#stbl<?php echo $_REQUEST['id']; ?> tbody > div").length;
    // alert("all Index");
        for(var i=0;i<len;i++){
           // var id=
      //alert($("#testCaseContainer > div").eq(i).find('li').attr('id'));
            obj[i]=$("#stbl<?php echo $_REQUEST['id']; ?> tbody > div").eq(i).find('li').attr('id');

          //  alert($("#testCaseContainer > div")[0].find('li').id);

        }
$('#sorting<?php echo $_REQUEST['id']; ?>').submit(); 

          }
    });
	
	 
function totalamountcalculate<?php echo $_REQUEST['id']; ?>(){
var totalthb=0;
var totaldlr=0;
$('.amountthb<?php echo $_REQUEST['id']; ?>').each(function(i, obj) {
	var thb = Number($(obj).text());
   totalthb = Number(thb+totalthb);
});

$('.amountdoller<?php echo $_REQUEST['id']; ?>').each(function(i, objdlr) {
	var dlr = Number($(objdlr).text());
   totaldlr = Number(dlr+totaldlr);
});

$('#totalthb<?php echo $_REQUEST['id']; ?>').text(totalthb);
$('#totaldoller<?php echo $_REQUEST['id']; ?>').text(totaldlr);

$('#totalprofit<?php echo $_REQUEST['id']; ?>').text(Number(totaldlr-totalthb));

}
 totalamountcalculate<?php echo $_REQUEST['id']; ?>();
</script>

 