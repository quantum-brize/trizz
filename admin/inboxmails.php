<style>
.mailboxleft{background-color:#1772bd; color:#fff; height:100%; padding:20px; width:220px;}
.mailboxleft .fa{margin-right:10px;}
.mailboxleft .bigtext{font-size:17px; font-weight:600; margin-bottom:20px;}
.mailboxleft a{display:block; margin-bottom:20px; color:#fff !important;}
.mailboxleft a:hover{background-color: #00000047; border-radius: 4px;}
.mailboxleft .active{background-color: #00000047; border-radius: 4px;}
.mailboxlisttopsearch { position: absolute; padding: 15px 20px; width: 97%; box-sizing: border-box; padding-bottom: 10px; border-bottom: 1px solid #ddd; background-color: #fff; z-index: 99; }
.mailboxlisttopsearch .input{padding:8px; border:1px solid #d0d0d0; width:100%;box-sizing: border-box;border-radius: 4px;}
.mailboxlisttopsearch .drop{padding:8px; border:0px solid #d0d0d0;  box-sizing: border-box;border-radius: 4px; background-color:#FFFFFF;}
.mailboxmaillistingouter{overflow:auto; height:100%; width:100%; padding-top:104px; box-sizing: border-box; min-width:280px; padding-bottom:30px;}
.mailboxmaillistingouter .datelist{padding:5px 20px; background-color:#f8f8f8; border-bottom:1px solid #ddd; font-size:13px;}
.mailboxmaillistingouter .maillist{padding:10px 20px; overflow:hidden;border-bottom:1px solid #ddd; font-size:14px; position:relative; cursor:pointer;}
.mailboxmaillistingouter .maillist .identifyuser { position: absolute; right: 10px; bottom: 10px; background-color: #777777; color: #FFFFFF; font-size: 10px; padding: 1px 5px; border-radius: 10px; }
.mailboxmaillistingouter .maillist .identifyclient { position: absolute; right: 10px; bottom: 10px; background-color: #45c4ca; color: #FFFFFF; font-size: 10px; padding: 1px 5px; border-radius: 10px; }
.mailboxmaillistingouter .maillist .identifysupplier { position: absolute; right: 10px; bottom: 10px; background-color: #4572ca; color: #FFFFFF; font-size: 10px; padding: 1px 5px; border-radius: 10px; }

.mailboxmaillistingouter .maillist:hover{background-color:#F9F9F9;}
.mailboxmaillistingouter .maillist .globalname{ width: 30px; height: 30px; background-color: #19a4b9; color: #FFFFFF;  text-align: center; line-height: 28px; font-weight: 500; border-radius: 100px; position:absolute; left:20px; top:15px;text-transform: uppercase; } 
.mailboxmaillistingouter .maillist .content{ font-size:14px; padding-left:40px;}
.mailboxmaillistingouter .maillist .content .text{white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin-bottom:1px; width:100%; max-width:280px; color:#000000; max-width:250px;}
.mailboxmaillistingouter .maillist .content .textbody{white-space: nowrap; overflow: hidden; text-overflow: ellipsis;  width:100%; font-size:13px; color:#666666; max-width:200px;}
.mailboxmaillistingouter .maillist .mailtime{position:absolute; right:20px; top:10px; font-size:12px; color:#666666;}
.mailoadingimgbox{padding:20px; text-align:center; width:100%; padding-top:40px;}
.mailoadingimgbox img{width:200px !important; margin:auto;}
.mailoadingimgboxread{padding:20px; text-align:center; width:100%; height:100%; overflow:auto; background-color:#FFFFFF; text-align:left; border-left:1px solid #ddd; display:none;}
.mailoadingimgboxread .topoption{overflow:hidden; padding-bottom:10px; border-bottom:1px solid #ddd;}
.mailoadingimgboxread .topoption a{float:right !important; padding:5px 10px !important; font-size:15px !important; color:#333333 !important; cursor:pointer;}
.mailoadingimgboxread .mailsubject{font-size:18px; font-weight:600; padding:10px 0px 15px;word-break: break-all;}
.mailoadingimgboxread .mailfrom{margin-bottom:10px; border-bottom:1px solid #ddd; padding-bottom:10px;}
.mailoadingimgboxread .mailfrom .globalnameicon{ width:40px; height: 40px; background-color: #19a4b9; color: #FFFFFF;  text-align: center; line-height: 40px; font-weight: 500; border-radius: 100px;  text-transform: uppercase; font-size:18px; }
.mailoadingimgboxread .mailfrom .nameemail{font-size:16px; font-weight:600;}
.mailoadingimgboxread .mailfrom .fromdate{ font-size:12px; color:#666666;}
.mailoadingimgboxread .mailbodybox{ padding-bottom:40px; word-break: break-all;}
.gmail-fix{height: 10px !important; position: absolute;}

.sendmailbox{padding:20px; text-align:center; width:100%; height:100%; overflow:auto; background-color:#FFFFFF; text-align:left; border-left:1px solid #ddd; display:none;  }
.sendmailbox .sendfrommail{padding:10px 0px; border-bottom:1px solid #ddd;}
.sendmailbox .mailfield{border:0px; outline:0px; padding:0px; width:100%; font-size:15px; font-weight:500;}
.sendmailbox label{padding: 0px; margin: 0px; display: block; font-weight:400;}
.sendmailbox .mailbodybox{width:100%; min-height:400px; padding-top:10px; font-size:15px;}
.sendmailbox .topoption{overflow:hidden; padding-bottom:10px; border-bottom:1px solid #ddd;}
.sendmailbox .topoption a{float:right !important; padding:5px 10px !important; font-size:15px !important; color:#333333 !important; cursor:pointer;}
.makeanimate { 
  animation: mymove 1s infinite;
}

@keyframes mymove {
  100% {transform: rotate(180deg);}
}


</style>


<div class="wrapper" style="padding-top: 45px; padding-left: 63px; margin-top: 0px; height: 100%; position: absolute; width: 100%; box-sizing: border-box; background: rgb(23,114,189); background: linear-gradient(129deg, rgba(23,114,189,1) 0%, rgba(7,72,126,1) 100%);">
 <table width="100%" border="0" cellpadding="0" cellspacing="0" style="height:100%;">
  <tr>
    <td align="left" valign="top">
	<div class="mailboxleft">
	<a href="#" style="background-color:transparent;" onclick="newmail();"><div class="bigtext"><i class="fa fa-plus" aria-hidden="true"></i> New Mail</div></a>
 <div class="bigtext"><i class="fa fa-user-o" aria-hidden="true"></i> Account</div> 
 <a href="#" style="padding: 10px 0px;"><div style="padding-left:28px;white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-size:13px; font-weight:600;"><?php echo $LoginUserDetails['fromName']; ?></div>
 <div style="padding-left:28px;white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-size:12px;"><?php echo $LoginUserDetails['emailAccount']; ?></div></a>
 
 <a href="#" style="padding: 10px 0px; margin-bottom:5px;" onclick="mailboxmaillistingouterfun('100');" id="inboxancher">
 <div style="padding-left: 10px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-size: 14px;"><i class="fa fa-inbox" aria-hidden="true" style="margin-right:6px;"></i>Inbox</div></a>
 
 <a href="#" style="padding: 10px 0px;" onclick="mailboxsentmaillistingouterfun();" id="sentancher">
 <div style="padding-left: 10px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-size: 14px;"><i class="fa fa-paper-plane-o" aria-hidden="true" style="margin-right:6px;"></i>Sent</div></a>
 
    </div>
	
	</td>
    <td width="30%" align="left" valign="top" bgcolor="#FFFFFF" style="position:relative;">
	<div class="mailboxlisttopsearch">
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><input name="search-criteria" class="input" id="search-criteria" type="text" placeholder="Search" /></td>
    <td width="10%" align="center"><i class="fa fa-refresh" aria-hidden="true" style="font-size: 22px; cursor:pointer; color:#888;" onclick="mailboxmaillistingouterfun('100');$(this).addClass('makeanimate');"></i></td>
  </tr>
  <tr>
    <td colspan="2"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="2" style="padding-top:15px; font-size:16px; font-weight:600;" id="mailsectionname">Inbox</td>
        <td align="right" valign="bottom"> 
          <select name="select" class="drop" style="display:none;">
            <option value="All">All</option>
          </select>
       </td>
      </tr>
      
    </table></td>
    </tr>
</table>

	
	</div>
	
	<div class="mailboxmaillistingouter">
	<div class="mailoadingimgbox">
	<img src="images/mailloadingsection.gif" />
	</div>

	
	</div>
 
	 
	</td>
    <td width="57%" align="left" valign="top">
	<i class="fa fa-envelope-o" aria-hidden="true" style="position: fixed; right: 20px; bottom: 40px; font-size: 120px; color: #fff3;" id="mailiddisplay"></i>
	<div style="width:100%; height:100%; background-color:#FFFFFF; text-align:center; display:none; " id="mailsending"><img src="images/bird-animation-1.gif" style="width:70%; max-width:400px; margin:auto; margin-top:100px;"  /><div style="text-align:center; font-size:16px; margin-top:20px;">Wait please sending...</div></div>
	<div class="mailoadingimgboxread">
	<div class="topoption">
	<a onclick="forwordmail();"><i class="fa fa-share" aria-hidden="true"></i> Forword</a>
	<a onclick="replymail();"><i class="fa fa-reply-all" aria-hidden="true"></i> Reply</a>
	</div>
	
	<div class="mailsubject"></div>
	<div class="mailfrom"><table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"><div class="globalnameicon"></div></td>
    <td width="98%" style="padding-left:10px;"><div class="nameemail"></div><input name="sendmailfiled" id="sendmailfiled" type="hidden" value="" />
	<div class="fromdate"></div>
	</td>
  </tr>
  
</table>
</div>

<div class="mailbodyboxtrans">
  
</div>
	
	</div>
	
	<div class="sendmailbox">
	<div class="topoption">
	 
 
	
	<a onclick="sendmail();" id="sendmailbtn"><i class="fa fa-paper-plane-o" aria-hidden="true"></i> Send</a>
	<a onclick="$('.mailoadingimgboxread').hide();$('.sendmailbox').hide();$('#mailiddisplay').show();discardmail();"><i class="fa fa-trash-o" aria-hidden="true"></i> Discard</a>
	</div>
	<form class="custom-validation" action="frmaction.html" target="actoinfrm" id="mailactoinfrm" novalidate="" method="post" enctype="multipart/form-data">	
	<div class="sendfrommail"><table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2">From:</td>
    <td width="95%" style="padding-left:10px;"><?php echo $LoginUserDetails['emailAccount']; ?></td>
  </tr>
  
</table>
</div>

<div class="sendfrommail"><label><table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2">To:</td>
    <td width="97%" style="padding-left:10px;"><input name="tomailfield" type="text" class="mailfield" id="tomailfield" /></td>
  </tr>
  
</table></label>
</div>

<div class="sendfrommail"><table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td width="97%" ><input name="subjectmailfield" type="text" class="mailfield" id="subjectmailfield" placeholder="Subject" /></td>
  </tr>
  
</table>
</div><textarea name="sendmailbodyfield" cols="" rows="" id="sendmailbodyfield" style="display:none;"></textarea>
<input name="action" type="hidden" value="sendmailermail" />
</form>
<div class="mailbodybox" contenteditable="true"></div>
	
	</div>
	
	</td>
  </tr>
</table>


</div>




<script>
function mailboxmaillistingouterfun(no){
$('.fa-refresh').addClass('makeanimate');
$('#mailsectionname').text('Inbox');
$('#inboxancher').addClass('active');
$('#sentancher').removeClass('active');
$('.mailboxlisttopsearch .fa-refresh').show();
$('.mailboxmaillistingouter').html('<div class="mailoadingimgbox"> <img src="images/mailloadingsection.gif" /> </div>');
$('.mailboxmaillistingouter').load('load_mailboxmaillistingouter.php?moremail='+no);
}


 mailboxmaillistingouterfun('100');
 
 
 
 function mailboxsentmaillistingouterfun(){
 
 $('#mailsectionname').text('Sent');
 $('.mailboxlisttopsearch .fa-refresh').hide();
$('#sentancher').addClass('active');
$('#inboxancher').removeClass('active');
$('.mailboxmaillistingouter').html('<div class="mailoadingimgbox"> <img src="images/mailloadingsection.gif" /> </div>');
$('.mailboxmaillistingouter').load('load_sentmailboxmaillistingouter.php');
}

 
 
 function sendmail(){
 $('#sendmailbodyfield').val($('.mailbodybox').html()); 
 
 if($('#tomailfield').val()!='' && $('#subjectmailfield').val()!=''){ 
 
 $('#sendmailbtn').hide();
 //alert();
 $('#mailactoinfrm').submit();
 }
 }
 
 
 function replymail(){
 $('.mailoadingimgboxread').hide();
 $('.sendmailbox').show();
 var sendmailfiled = $('#sendmailfiled').val();
 var mailsubject = $('.mailsubject').text();
 var mailbodybox = $('#mailbodybox').html();
 
 $('#tomailfield').val(sendmailfiled);
 $('#subjectmailfield').val('RE: '+mailsubject);
 $('#mailbodybox').html('<br><br><br>    '+mailbodybox);
 }

 function forwordmail(){
 $('.mailoadingimgboxread').hide();
 $('.sendmailbox').show();
 var sendmailfiled = $('#sendmailfiled').val();
 var mailsubject = $('.mailsubject').text();
 var mailbodybox = $('#mailbodybox').html();
 
 $('#tomailfield').val('');
 $('#subjectmailfield').val('RE: '+mailsubject);
 $('#mailbodybox').html('<br><br><br>    '+mailbodybox);
 }



 function newmail(){
 $('.mailoadingimgboxread').hide();
 $('.sendmailbox').show();
 var sendmailfiled = $('#sendmailfiled').val();
 var mailsubject = $('.mailsubject').text();
 var mailbodybox = $('#mailbodybox').html();
 
 $('#tomailfield').val('');
 $('#subjectmailfield').val('');
 $('#mailbodybox').html('');
 $('.mailbodybox').html('');
 $('#mailbodyboxtrans').html('');
 }
 
 
function selectopen(obj){
$('.maillist').removeAttr('style');
$(obj).css('background-color','#e0f4ff');
}

function discardmail(){
$('.maillist').removeAttr('style');
}


</script> 