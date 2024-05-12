<?php
   $a=GetPageRecord('*','sys_userMaster','  userType=0 and addedBy="'.$_SESSION['userid'].'"');  
   $invoiceData=mysqli_fetch_array($a);
   
   $rsb=GetPageRecord('*','queryServicesMaster',' id="'.$editresult['serviceId'].'"');while($restsource=mysqli_fetch_array($rsb)){  $sourcedata= stripslashes($restsource['name']); }
   
   $rs13=GetPageRecord('*','sys_packageBuilder','queryId="'.$editresult['id'].'" and confirmQuote=1');   
   $packagedatadetials=mysqli_fetch_array($rs13);
?>
<script src="tinymce/tinymce.min.js"></script>
<script type="text/javascript">
   tinymce.init({
   selector: "#EmailDetails",
   themes: "modern",
   plugins: [
   "advlist autolink lists link image charmap print preview anchor",
   "searchreplace visualblocks code fullscreen"
   ],
   toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
   });
</script>
<style>
   .tasklist{border: 1px solid #ddd; margin-bottom: 10px; padding: 10px; border: 3px; border: 1px solid #ddd; border-left: 5px solid #ff8a12; background-color: #f9f9f9; border-radius: 4px;}
   .tasklist .iconbox{width:50px; height:50px; margin-right: 10px; background-color: #ff8a12; color: #fff; text-align: center; line-height:50px; font-size: 18px; border-radius: 100%;}
   .makedone{border-left: 5px solid #009900;}
   .makedone .iconbox{ background-color: #009900;}
   .makenotedone{border: 1px solid #CC3300; border-left: 5px solid #CC3300;}
   .makenotedone .iconbox{ background-color: #CC3300;}
   .table th:first-child { border:0px !important;} 
</style>
<form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm" >
   <div class="row">
      <div class="col-lg-8" style="padding-left:15px;">
         <h4 class="mt-0 header-title">Supplier Communication</h4>
         <div class="row" style="padding-left: 5px;">
            <div class="col-lg-12">
               <div style="margin-bottom:2px; font-size:12px;">Subject</div>
               <input name="subject" type="text" class="form-control" style="width:100%; margin-bottom:20px;" value="Travel Enquiry for <?php echo getCityName($editresult['destinationId']); ?> from <?php echo stripslashes($invoiceData['invoiceCompany']); ?> (Query Id- <?php echo encode($editresult['id']); ?>)"  autocomplete="off" />
               <div style="margin-bottom:2px; font-size:12px;">CC Email</div>
               <input name="ccmail" type="text" class="form-control"  autocomplete="off" style="width:100%; margin-bottom:20px;" /> 
               <?php
                  $mailbody='Dear Sir,<br>Kindly provide the best rates for below enquiry for '.getCityName($editresult['destinationId']).' at the earliest<br><br><table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC">
                  <tr>
                  <td><strong>Customer Name </strong></td>
                  <td>'.stripslashes($clientData['submitName']).' '.stripslashes($clientData['firstName']).' '.stripslashes($clientData['lastName']).'</td>
                  <td><strong>Enquiry ID </strong></td>
                  <td>'.encode($editresult['id']).'</td>
                  <td><strong>Enquiry For </strong></td>
                  <td>'.$sourcedata.'</td>
                  </tr>
                  
                  <tr>
                  <td colspan="6" bgcolor="#F8F8F8"><strong>Enquiry Details </strong></td>
                  </tr>
                  <tr>
                  <td><strong>Check-In</strong></td>
                  <td>'.$startDate.'</td>
                  <td><strong>Check-Out </strong></td>
                  <td>'.$endDate.'</td>
                  <td><strong>Nights</strong></td>
                  <td>'.$editresult['day'].'</td>
                  </tr>
                  <tr>
                  <td><strong>From City </strong></td>
                  <td>'.stripslashes($editresult['fromCity']).'</td>
                  <td><strong>Destination</strong></td>
                  <td>'.getCityName($editresult['destinationId']).'</td>
                  <td><strong>Total Pax</strong></td>
                  <td>'.$editresult['adult'].' Adult - '.$editresult['child'].' Child - '.$editresult['infant'].' Infant </td>
                  </tr>
                  <tr>
                  <td><strong>Remarks</strong></td>
                  <td colspan="5">'.stripslashes($editresult['details']).'</td>
                  </tr>
                  </table>'.stripslashes($LoginUserDetails['emailsignature']).'
                  '
                  
                  ?>
               <textarea class="form-control" id="EmailDetails" name="EmailDetails" rows="15" placeholder=""><?php include "supplier_communication.php"; ?></textarea>
               <input type="hidden" name="action" value="sendtosupplier" />
               <input type="hidden" name="queryid" value="<?php echo $_REQUEST['id']; ?>" /> 
            </div>
            <div class="form-group" style="overflow:hidden; padding-right:10px; margin-right:0px; margin-top:10px; width:100%;">
               <?php if (strpos($LoginUserDetails["permissionAddEdit"], 'Suppliers') !== false) { ?>	    
               <div style="margin-top:5px;"><button type="submit" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Sending...';" style="float:right;"><i class="fa fa-paper-plane" aria-hidden="true"></i>&nbsp;
                  Send Mail To Selected Suppliers</button>
               </div>
               <?php } ?>
            </div>
         </div>
      </div>

      <div class="col-lg-4" style="padding-left:15px;">
         <h4 class="mt-0 header-title" style="margin-bottom:0px;"><i class="fa fa-check-square-o" aria-hidden="true"></i> Select Supplier</h4>
            <form action="" class="newsearchsecform" style="left:80px;" method="get" enctype="multipart/form-data">	
              <input type="text" name="keyword" class="form-control newsearchsec my-textbox" placeholder="Search by name,email" value="<?php echo $_REQUEST['keyword']; ?>" style="margin-top: 10px;">
              <input name="keyword" type="hidden" value="<?php echo $_REQUEST['keyword']; ?>" />
            </form>
         <div class="row" style="padding: 5px; padding-top: 15px;">
            <div class="col-lg-12">
               <div class="form-group mb-3">
                  <div class="suplistingouter" style="height:600px; overflow:auto;">
                      <?php 
                        $n=1;
                        $rs=GetPageRecord('*','sys_userMaster',' userType="suppliers" and email!="" and (firstName like "%'.$keyword.'%" or  email like "%'.$keyword.'%" or  mobile like "%'.$keyword.'%") order by company asc limit 0,100');
                        while($rest=mysqli_fetch_array($rs)){  
                      ?>
                     <div class="card personsMenu">
                        <div class="card-body">
                           <table width="100%" border="0" cellpadding="0" cellspacing="0">
                              <tr>
                                 <td colspan="2" align="left" valign="top" style="padding-right:10px;">
                                    <div class="checkbox"><input type="checkbox" name="sendcheck[]" value="<?php echo encode($rest['id']); ?>" style="width: 19px; height: 22px;"></div>
                                 </td>
                                 <td width="99%" align="left" valign="top">
                                    <div style="margin-bottom:2px; font-weight:800;"><?php echo stripslashes($rest['company']); ?></div>
                                    <?php echo stripslashes($rest['submitName']); ?> <?php echo stripslashes($rest['firstName']); ?> <?php echo stripslashes($rest['lastName']); ?><i class="fa fa-circle" aria-hidden="true" style="color: #b2bad066; margin: 0px 10px; font-size:8px;"></i><?php echo stripslashes($rest['email']); ?>
                                 </td>
                              </tr>
                           </table>
                        </div>
                     </div>
                     <?php $n++; } ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</form>



<script>
$(".my-textbox").keyup(function(e) {
  var val = $(this).val();
  filter(val.toLowerCase());
});

$(".my-textbox").on("paste", function() {
  var element = this;
  setTimeout(function() {
    var text = $(element).val().toLowerCase();
    filter(text);
  }, 100);
});

function filter(x) {
  var isMatch = false;
  $(".personsMenu").each(function(i) {
    var content = $(this).html();

    if(content.toLowerCase().indexOf(x) == -1) {
      $(this).hide();
    } else {
      isMatch = true;
      $(this).show();
    }
  });

  var ccs = $('.personsMenu').filter(function() {
    return $(this).css('display') !== 'none';
  }).length;
 
  $(".no-results").toggle(!isMatch);
    $(".cc").toggle(isMatch);
  }

  var ccs = $('.personsMenu').filter(function() {
    return $(this).css('display') !== 'none';
  }).length;
 </script>