  
<script src="tinymce/tinymce.min.js"></script>
<style>
.chatuserlistouter{height:500px; overflow:auto;}
.chatuserlist{padding:10px; border-bottom:1px solid #ddd; overflow:hidden;}


.chatuserlist .imgbox{ width:50px; height:50px; overflow:hidden; float:left; position:relative; border-radius: 4px;}
.chatuserlist .imgbox .online{width: 15px; height: 15px; background-color: #009900; border: 1px solid #fff; position: absolute; right: 2px; bottom: 2px;   border-radius: 100%;}
.chatuserlist .imgbox .idel{width: 15px; height: 15px; background-color:#FF6600; border: 1px solid #fff; position: absolute; right: 2px; bottom: 2px;   border-radius: 100%;}
.chatuserlist .imgbox .offline{width: 15px; height: 15px; background-color:#DFDFDF; border: 1px solid #fff; position: absolute; right: 2px; bottom: 2px;   border-radius: 100%;}

.chatuserlist .imgbox img{width:100%; height:auto; min-height:100%;border-radius: 4px;}
.chatuserlist .name{font-size:14px; font-weight:600; }
.chatuserlist .namearea{width:280px; float:right;}
.chatuserlist .mobilenumber{ font-size:12px; color:#666666; }
.chatuserlist .datebox{ font-size:11px; color:#666666;}
.chatuserlist:hover{background-color:#f2f2f28c; cursor:pointer;}
.chatactive{background-color: #fff2cc;}



.imgbox2{ width:50px; height:50px; overflow:hidden; float:left; position:relative; border-radius: 4px;}
.imgbox2 .online{width: 15px; height: 15px; background-color: #009900; border: 1px solid #fff; position: absolute; right: 2px; bottom: 2px;   border-radius: 100%;}
.imgbox2 .idel{width: 15px; height: 15px; background-color:#FF6600; border: 1px solid #fff; position: absolute; right: 2px; bottom: 2px;   border-radius: 100%;}
.imgbox2 .offline{width: 15px; height: 15px; background-color:#DFDFDF; border: 1px solid #fff; position: absolute; right: 2px; bottom: 2px;   border-radius: 100%;}
.imgbox2 img{width:100%; height:auto; min-height:100%; border-radius: 4px;}
</style>
<style>
 
#chatarea{height:454px; overflow:auto; border-bottom:2px solid #ddd; padding:15px 10px}
#field #chatbutton{ padding: 7px; border: 0px; background-color: #fff; outline: 0px; width: 100%; box-sizing: border-box; height: 45px; font-size: 15px; line-height: 45px;}
#field #sendbtn{background-color: #fff; color: #4b9df5; padding: 8px 13px; font-size: 18px; border-radius: 6px; margin-top: 5px; float: right; margin-right: 5px; cursor: pointer;}
#chatarea ul{list-style:none; padding:0px; margin:0px; width:100%;}
#chatarea ul li{width:100%; display:block; overflow:hidden;}

#chatarea .usermessage{width: 100%;  float: left; font-size: 14px; margin-bottom:8px; line-height: 20px;}
#chatarea .usermessage .content{ padding: 8px; background-color: #4b9df5; color: #fff; border-radius: 5px; width:auto; float:left; }

#chatarea .mymessage{width: 100%;  float: right; font-size: 14px; margin-bottom:8px; line-height: 20px;}
#chatarea .mymessage .content{ padding: 8px; background-color:#EEEEEE; color: #000; border-radius: 5px; width:auto; float:right; }

#chatarea .usermessage .datetimechat{font-size:10px; margin-top:1px; text-align:left; font-weight:400; text-transform:uppercase; float:left; width:100%;}
#chatarea .mymessage .datetimechat{font-size:10px; margin-top:1px; text-align:right; font-weight:400; text-transform:uppercase; float:right; width:100%;}


#chatouter #bottmbuttonclose{overflow:hidden;}
#chatouter #bottmbuttonclose .buttonmain{float: right; width: 60px; height: 60px; background-color: #4b9df5; color: #FFF; margin: 5px 0px; border-radius: 100%; font-size: 26px; text-align: center; line-height: 60px; cursor:pointer;box-shadow: -3px 0px 10px #00000024;}

#chatouter #bottmbuttonopen{overflow:hidden;}
#chatouter #bottmbuttonopen .buttonmain{float: right; width: 60px; height: 60px; background-color: #4b9df5; color: #FFF; margin: 5px 0px; border-radius: 100%; font-size: 26px; text-align: center; line-height: 60px; box-shadow: -3px 0px 10px #00000024; cursor:pointer;}

</style>
<div class="wrapper">
<div class="container-fluid">
<div class="main-content">

                <div class="page-content">

      
                    
                    <!-- start page title -->
                     
              
                        <div class="row">
                        <div class="col-md-12 col-xl-12">
						<div class="card" style="min-height:500px;">
                            <div class="card-body"> 
                                    <h4 class="card-title" style=" margin-top:0px;">Messenger<div class="float-right"> 
									</div></h4> 
							  
                                     <div class="row"> 
									 <table width="100%" border="0" cellpadding="0" cellspacing="0" style="border:1px solid #ddd;">
  <tr>
    <td colspan="2" align="left" valign="top" width="30%" style="border-right:1px solid #ddd;">
	<div style="background-color:#f3f3f3; padding:10px;"><input id="searchdata" onkeyup="searchfun();" type="text" style="padding:10px; border:1px solid #ddd; width:100%;box-sizing: border-box;" placeholder="Search customer..." /></div>
	<div class="chatuserlistouter" id="loadchatclient">
	  
	  
	</div>
	
	</td>
    <td align="left" valign="top" width="70%">
	<?php if($_GET['cui']!='' && $_GET['cui']>0){ 
	$rs22=GetPageRecord('*','userMaster',' id="'.decode($_GET['cui']).'" order by firstName asc');  
	$restuser=mysqli_fetch_array($rs22);  
	
	 updatelisting('sys_MessageMaster','readMsg=1','clientId="'.$restuser['id'].'"'); 
	?>
	<div style=" border-bottom:1px solid #ddd; padding: 6px 10px;">
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td colspan="2"><div class="imgbox2"><img src="images/nousericon.png" /></div></td>
            <td width="94%" style="padding-left:10px;"><div style="font-size:16px; font-weight:600;"><?php echo ucwords($restuser['firstName']); ?> <?php echo ucwords($restuser['lastName']); ?></div>
			<div style="color:#666666; font-size:12px;"><strong>Mobile:</strong> <?php echo $restuser['mobile']; ?> | <strong>Email:</strong> <?php echo $restuser['email']; ?></div>
			</td>
          </tr>
        </table>
	</div>
	
	
 
<div id="chatarea">
<ul>
<?php

$rs=GetPageRecord('*','sys_MessageMaster',' clientid="'.$restuser['id'].'" order by id asc');
if(mysqli_num_rows($rs)>0){
while($rest=mysqli_fetch_array($rs)){
$lastId=$rest['id'];
 ?>
 
<li class="<?php if($rest['addedBy']==$_SESSION['userid']){?>mymessage<?php }else{ ?>usermessage<?php } ?>" id="communication<?php echo $lastId; ?>" tabindex="10">
<div class="content"><?php echo ucwords(strip($rest['msg'])); ?></div>
<div class="datetimechat"><?php echo date('d M Y - h:i A', strtotime($rest['dateAdded'])); ?></div> 
</li> 

<?php
 } } ?>  
 </ul> 
</div>
<div id="field">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" width="80%" style="border:0px;"> 
      <input type="text" name="textfield" id="chatbutton" placeholder="Write here..." style="padding-left:14px;" /> </td>
    <td width="20%" style="border:0px;"><i class="fa fa-paper-plane" aria-hidden="true" onClick="sendmessage();" id="sendbtn"></i></td>
  </tr>
</table>

</div>
 
	<?php }else{ ?>
	<div style="text-align:center; margin-top:30%;">No conversation</div>
	<?php } ?>
	</td>
  </tr>
</table> 			
	</div> 
	</div> 
	
	</div> 
	</div> 
             </div><!--end col--> 
            <!-- end row --> 
    </div> 
        <!-- End Page-content -->  
    </div>
	</div>	
	</div>
	<script>
	setInterval(function(){
		$('#loadchatclient').load('loadchatclients.php');
		}, 10000);
		$('#loadchatclient').load('loadchatclients.php');
		
		function sendmessage(){
		var msg = encodeURI($('#chatbutton').val()); 
		 $('#chatarea ul').load('userloadchat.php?action=sendmessage&msg='+msg+'&clientId=<?php echo $_GET['cui']; ?>');
		$('#chatbutton').val('');
		}
		
		$("#chatbutton").keypress(function(e) {
		if(e.which == 13) { 
		sendmessage();
		}
		});
		
		
		setInterval(function(){ 
		$('#userloadreadmessage').load('userloadreadmessage.php?clientId=<?php echo $_GET['cui']; ?>'); 
		}, 5000);
		
		
		
function scrollbottom(){
$('#chatarea').animate({ scrollTop: $('#chatarea').get(0).scrollHeight }, 1500);
}


function searchfun(){
	var searchdata = encodeURI($('#searchdata').val());
	$('#loadchatclient').load('loadchatclients.php?searchdata='+searchdata); 
	
}
	</script>
	
	<div style="display:none;" id="userloadreadmessage"></div>