<iframe src="" id="datapost" name="datapost" style="display:none;"></iframe>
<script src="script/jquery.js"></script>
<script src="script/bootstrap.js"></script>
<script src="script/slick-slider.js"></script>
<script src="plugin-script/counter.js"></script>
<script src="plugin-script/fancybox.pack.js"></script>
<script src="plugin-script/isotope.min.js"></script>
<script src="plugin-script/progressbar.js"></script>
<script src="plugin-script/functions.js"></script>
<script src="script/functions.js"></script>



<style>
#chatouter{width:350px; position:fixed; right:10px; bottom:0px; z-index:999;}

 
#chatouter #chatbox {
    overflow: hidden;
    height: 493px;
    background-color: #03191d;
    border: 1px solid #03191d;
    border-radius: 5px;
    box-shadow: -3px 5px 10px #00000024;
}


#chatouter #chatbox #header {
    border-bottom: 1px solid #e8ff8a6b;
    background-color: #4b9df500;
    color: #FFFFFF;
    text-align: left;
    padding: 20px 15px;
}
#chatouter #chatbox #header #online{ font-size:16px; font-weight:400; padding-bottom:10px; }
#chatouter #chatbox #header #text{text-align:center; font-size:14px;}
#chatouter #chatbox #chatarea{height:325px; overflow:auto; border-bottom:2px solid #e8ff8a6b; padding:15px 10px}

#chatouter #chatbox #field #chatbutton {
    padding: 7px;
    border: 0px;
    background-color: transparent;
    outline: 0px;
    width: 100%;
    box-sizing: border-box;
    height: 45px;
    font-size: 15px;
    line-height: 45px;
    color: #fff;
}

#chatouter #chatbox #field #sendbtn { background-color: #e8ff8a6b; color: #000000; padding: 8px 13px; font-size: 18px; border-radius: 6px; margin-top: 5px; float: right; margin-right: 5px; cursor: pointer; }
#chatouter #chatbox #chatarea ul{list-style:none; padding:0px; margin:0px; width:100%;}
#chatouter #chatbox #chatarea ul li{width:100%; display:block; overflow:hidden;}

#chatouter #chatbox #chatarea .usermessage{width: 100%;  float: left; font-size: 13px; margin-bottom:8px; line-height: 20px; outline:0px;}
#chatouter #chatbox #chatarea .usermessage .content h5{color:#fff !important;}
#chatouter #chatbox #chatarea .usermessage .content {
    padding: 8px;
    background-color: #ffffff24;
    color: #fff !important;
    border-radius: 5px;
    width: auto;
    float: left;
    color: #000;
}

#chatouter #chatbox #chatarea .mymessage{width: 100%;  float: right; font-size: 13px; margin-bottom:8px; line-height: 20px; outline:0px;}

 
#chatouter #chatbox #chatarea .mymessage .content {
    padding: 8px;
    background-color: #08635a;
    color: #fff;
    border-radius: 5px;
    width: auto;
    float: right;
}

#chatarea .usermessage .datetimechat {
    font-size: 10px;
    margin-top: 1px;
    text-align: left;
    font-weight: 400;
    text-transform: uppercase;
    float: left;
    width: 100%;
    color: #ffffff96;
}
#chatarea .mymessage .datetimechat {
    font-size: 10px;
    margin-top: 1px;
    text-align: right;
    /* font-weight: 400; */
    text-transform: uppercase;
    float: right;
    width: 100%;
    color: #ffffffa8;
}


 
#chatouter #bottmbuttonclose{overflow:hidden;}
#chatouter #bottmbuttonclose .buttonmain{float: right; width: 60px; height: 60px; background-color: #4b9df5; color: #FFF; margin: 5px 0px; border-radius: 100%; font-size: 26px; text-align: center; line-height: 60px; cursor:pointer;box-shadow: -3px 0px 10px #00000024;}

#chatouter #bottmbuttonopen{overflow:hidden;}
#chatouter #bottmbuttonopen .buttonmain{float: right; width: 60px; height: 60px; background-color:transparent; color: #FFF; margin: 5px 0px; border-radius: 100%; font-size: 26px; text-align: center; line-height: 60px;  cursor:pointer;}

</style>

<script>
function chatwindowopenclose(s){
if(s==1){
$('#bottmbuttonclose').show();
$('#bottmbuttonopen').hide();
$('#chatbox').show();
}


if(s==0){
$('#bottmbuttonclose').hide();
$('#bottmbuttonopen').show();
$('#chatbox').hide();
}


}
</script>

<?php 
$rs=GetPageRecord($select,'sys_userMaster','id=1 '); 
$editresult=mysqli_fetch_array($rs);

 ?>

<div id="chatouter">
<div id="chatbox" style="display:none;">
<div id="header">
<div id="online">Online</div>
<i class="fa fa-minus" aria-hidden="true" style="position: absolute; right: 23px; color: #FFFFFF; font-size: 20px; top: 23px; cursor:pointer;"  onclick="chatwindowopenclose(0);"></i>
<div id="text"><?php echo stripslashes($editresult['chatHeading']); ?></div>
</div>
<div id="chatarea">
<ul>
 </ul>

</div>
<div id="field">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" width="80%" style="border:0px;"> 
      <input type="text" name="textfield" id="chatbutton" placeholder="Write here..." /> </td>
    <td width="20%" style="border:0px;"><i class="fa fa-paper-plane" aria-hidden="true" onClick="sendmessage();" id="sendbtn"></i></td>
  </tr>
</table>

</div>

</div>


<!--<div id="bottmbuttonclose" style="display:none !important;">
<div class="buttonmain" onclick="chatwindowopenclose(0);"><i class="fa fa-times" aria-hidden="true"></i></div>
</div>
-->
<div id="bottmbuttonopen" style="display:none;">
<div class="buttonmain" onclick="chatwindowopenclose(1);loadmessage(); "><img src="images/messages_5122x.webp" /></div>
</div>

</div>

<script>
chatwindowopenclose(0);
 
function sendmessage(){
	var msg = encodeURI($('#chatbutton').val());
	$('#chatarea ul').load('clientloadchat.php?action=sendmessage&msg='+msg);
	$('#chatbutton').val('');
}

function loadmessage(){ 
	$('#chatarea ul').load('clientloadchat.php'); 
} 


setInterval(function(){ 
$('#clientloadreadmessage').load('clientloadreadmessage.php'); 
}, 5000);


$("#chatbutton").keypress(function(e) {
    if(e.which == 13) { 
    sendmessage();
    }
});


function scrollbottom(){
$('#chatarea').animate({ scrollTop: $('#chatarea').get(0).scrollHeight }, 1500);
}

 $(document).keydown(function(e) {
    // ESCAPE key pressed
    if (e.keyCode == 27) {
       $('.docnoti').hide();
    }
});
</script>
<div style="display:none;" id="clientloadreadmessage"></div>