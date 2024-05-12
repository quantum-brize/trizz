<?php
include "appinc.php";
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, shrink-to-fit=no, viewport-fit=cover">
<title>Home</title>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'> 
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
<link href="css/main.css?i=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>

<script>
function filteropenclose(){ 
var filterbox = $('#filterbox').css('display');

if(filterbox=='none'){
$('#filterbox').show();
$('.listview').hide();
$('.sectionallsearch #mainarrow').removeClass('fa-caret-down');
$('.sectionallsearch #mainarrow').addClass('fa-caret-up');
} else {
$('#filterbox').hide();
$('.listview').show();
$('.sectionallsearch #mainarrow').addClass('fa-caret-down');
$('.sectionallsearch #mainarrow').removeClass('fa-caret-up');
} 
}

function footertabs(id){
$('#footermenu a').removeClass('active');
$('#footermenu #t'+id).addClass('active');

if(id==2 || id==4){
$('#bodyarea').css('padding-top','52px');
} else {
$('#bodyarea').css('padding-top','92px');
}

}

function clearsearch(){
$('#toapsearchbox').hide();
$('#keywordfield').val('');
}

function openpage(page,title){

if(title=='Notifications' || title=='Follow Up'){
$('#addbuttontop').hide();
} else {
$('#addbuttontop').show();
}

$('#bodyarea').html('<div class="demo"></div>');
$('#bodyarea').load(page);
$('#titleheading').html(title);
}




document.querySelector('button').addEventListener('click', function() {
  document.querySelector('.demo').innerHTML = '<h1>Injected content.</h1>';
})
</script>
</head>

<body>
<div id="toapsearchbox"><table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"><input name="keywordfield" id="keywordfield" type="search" placeholder="Search" onKeyUp="searchlist();"></td>
    <td width="30%"><a class="greencancelsearchbutton"  onClick="clearsearch();searchlist();">Cancel</a></td>
  </tr>
  
</table>
</div>


<div class="header"><span id="titleheading">Queries </span>
  <div class="right">
<a style="padding-right:20px;" id="addbuttontop"><i class="fa fa-plus"></i></a>
<a onClick="$('#toapsearchbox').show();$('#keywordfield').focus();" id="searchbuttontop"><i class="fa fa-search"></i></a>

</div>



</div>




<div id="bodyarea">
<div class="demo"></div> 
</div>


<div id="footermenu">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="21%" align="center"><a class="active" id="t1" onClick="footertabs(1);openpage('querieslist.php','Queries');clearsearch();"><i class="fa fa-clone" aria-hidden="true"></i>Queries</a></td>
    <td width="21%" align="center"><a id="t2" onClick="footertabs(2);openpage('clientslist.php','Clients');clearsearch();"><i class="fa fa-user-o" aria-hidden="true"></i> Clients</a></td>
    <td width="21%" align="center"><a id="t3" onClick="footertabs(3);openpage('followuplist.php','Follow Up');clearsearch();"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>Follow Up</a></td>
    <td width="21%" align="center"><a id="t4" onClick="footertabs(4);openpage('notifications.php','Notifications');clearsearch();"><i class="fa fa-bell-o" aria-hidden="true"></i>Notifications</a></td>
    <td align="center"><a id="t5" ><i class="fa fa-ellipsis-h" aria-hidden="true"></i>More</a></td>
  </tr>
</table>

</div>

<script>
openpage('querieslist.php','Queries');
</script>
</body>
</html>
