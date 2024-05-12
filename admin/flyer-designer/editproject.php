<?php include "inc.php";
$editflyer=1;


$a=GetPageRecord('*','flyer_project','	userId="'.$_SESSION['userid'].'" and id="'.decode($_REQUEST['id']).'"');  
$res=mysqli_fetch_array($a);

if($res['id']==''){

echo 'Something went wrong!';

}  
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo stripslashes($res['name']); ?> - Edit Project - <?php echo $systemname; ?></title>
<?php include "headerinc.php"; ?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Acme&family=Alfa+Slab+One&family=Alice&family=Anton&family=Archivo+Black&family=Bangers&family=Concert+One&family=Creepster&family=Fredoka+One&family=Fugaz+One&family=Fuzzy+Bubbles&family=Great+Vibes&family=Kalam&family=Kanit&family=Lobster&family=Lobster+Two&family=Luckiest+Guy&family=Orbitron&family=Pacifico&family=Passion+One&family=Permanent+Marker&family=Playball&family=Righteous&family=Roboto&family=Roboto+Slab&family=Sacramento&family=Satisfy&family=Space+Mono&family=Special+Elite&family=Staatliches&family=Teko&family=Titan+One&display=swap" rel="stylesheet">
</head>

<body>
<?php include "header.php"; ?>

<div class="left">
<a id="o1" onclick="selectoption('o1');"><i class="fa fa-picture-o" aria-hidden="true"></i><div>Photo</div></a>
<a id="o2" onclick="selectoption('o2');"><i class="fa fa-font" aria-hidden="true"></i><div>Text</div></a>
<a id="o3" onclick="selectoption('o3');"><i class="fa fa-th" aria-hidden="true"></i><div>Background</div></a>
<a  id="o4" onclick="selectoption('o4');"><i class="fa fa-futbol-o" aria-hidden="true"></i><div>Shape</div></a>
<a  id="o5" onclick="selectoption('o5');"><i class="fa fa-star" aria-hidden="true"></i><div>Icons</div></a>

</div>

 
<div class="designbody">
<div class="instagramposts"  style=" width:<?php echo $res['pageWidth']; ?>; height:<?php echo $res['pageHeight']; ?>;">
<div  style=" width:<?php echo $res['pageWidth']; ?>; height:<?php echo $res['pageHeight']; ?>;"  id="designarea"><?php echo stripslashes($res['flyerHTML']); ?></div> 
   

</div>
</div>
<div class="zoomoptionbottomouter">
<div class="zoomoptionbottom">
  <table width="200" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="2" align="center"><i class="fa fa-search-plus" aria-hidden="true" onclick="zoominfun();"></i></td>
      <td width="25%" align="center"><i class="fa fa-search-minus" aria-hidden="true"onclick="zoomoutfun();"></i></td>
      <td width="50%"><select name="select" id="optionzoom" onchange="zoominout();">   
        <option value="120%">120%</option>
        <option value="100%" selected="selected">100%</option>
        <option value="75%">75%</option>
        <option value="50%">50%</option>
        <option value="25%">25%</option>  
          </select>
      </td>
    </tr>
  </table>
</div>
</div>



<div id="img-out"></div>




<div class="objoptionouter" style="display:block;">
<div class="objoption"><table border="0" cellpadding="0" cellspacing="0">
  <tr>
 <td colspan="2" align="center"  class="duplicatecol"><div onclick="duplicateobj();"><i class="fa fa-files-o" aria-hidden="true"></i><div style="margin-top:2px; font-size:11px;">Duplicate</div></div></td> 
    <td align="center" class="grayscalecol"><label><input name="constantTrue" id="constantTrue" type="checkbox" value="1" /><div style="margin-top:2px; font-size:11px;">Constant Size</div></label></td>
	
    <td align="center"><label><select name="transparency" id="transparency">
      <option value="1">1</option>
      <option value="0.9">0.9</option>
      <option value="0.8">0.8</option>
      <option value="0.7">0.7</option>
      <option value="0.6">0.6</option>
      <option value="0.5">0.5</option>
      <option value="0.4">0.4</option>
      <option value="0.3">0.3</option>
      <option value="0.2">0.2</option>
      <option value="0.1">0.1</option>
      <option value="0">0</option>
    </select><div style="margin-top:2px; font-size:11px;">Transparency</div></label></td>
	
	   <td align="center" class="grayscalecol"><label> <input name="grayscale" id="grayscale" type="number" min="0" max="100" value="0" onclick="grayscale()" onkeyup="grayscale();" />
	   <div style="margin-top:2px; font-size:11px;">Grayscale % </div>
	   </label></td>
	
       <td align="center" class="sizecol"><label><input name="iconsize" id="iconsize" type="number" min="1" max="500" value="0" onclick="iconsize()" onkeyup="iconsize();" />
       <div style="margin-top:2px; font-size:11px;">Size</div>
       </label></td>
	   <td align="center" class="fontscolorcol"><label><input name="fontscolor" id="fontscolor" type="color" min="1" max="100" value="0" onclick="fontscolor()"  onchange="fontscolor();" />
       <div style="margin-top:2px; font-size:11px;">Color</div>
       </label></td>
	    <td align="center" class="roundcorcol"><label><select name="roundcorner" id="roundcorner" onchange="roundcorner();">
      <option value="0px">0</option>
      <option value="2px">2</option>
      <option value="5px">5</option>
      <option value="10px">10</option>
      <option value="20px">20</option>
      <option value="30px">30</option>
      <option value="40px">40</option>
      <option value="50px">50</option>
      <option value="60px">60</option>
      <option value="70px">70</option>
      <option value="80px">80</option>
      <option value="90px">90</option>
      <option value="100px">100</option>
    </select>
       <div style="margin-top:2px; font-size:11px;">Radius</div>
       </label></td>
	   
       <td align="center">&nbsp;</td>
       <td align="center"><div onclick="dltobj();"><i class="fa fa-trash" aria-hidden="true"></i>
       <div style="margin-top:2px; font-size:11px;">Delete</div>
       </div></td>
  </tr>
  
</table>
</div>
</div>



<div id="projectoptionboxouter" style="display:none;"></div>





 

<script src="js/box-modeling.js"></script>
 
 
<script>

 //-------------Add Icon to Flyer----------------


function addicontoflyer(obj){  
 var randomnumber = Math.floor((Math.random() * 10000) + 1);
 
var d1 = document.getElementById('designarea'); 
 
d1.insertAdjacentHTML('beforeend', '<div class="box icondiv" onclick="thisprop(this);" sectype="icon" id="ob'+randomnumber+'" data-id="'+randomnumber+'" style="left: var(--left-2); top: var(--top-2); z-index: var(--zi-2); width:60px; height:50px; font-size:50px; background-color: var(--bg-2); color:#FF9666;">'+$(obj).html()+'</div>');

 $('#ob'+randomnumber+'').boxModeling();
}
 
 


//-------------Add Image to Flyer----------------

function addimagetoflyer(img){ 

var randomnumber = Math.floor((Math.random() * 10000) + 1);
 
var d1 = document.getElementById('designarea'); 
 
d1.insertAdjacentHTML('beforeend', '<div class="box constantTrue" onclick="thisprop(this);" sectype="photo" id="ob'+randomnumber+'" data-id="'+randomnumber+'" style="left: var(--left-2); top: var(--top-2); z-index: var(--zi-2); width: var(--width-2); height: var(--height-2); background-color: var(--bg-2);"> <img src="flyer_library/'+img+'" /></div>');

 $('#ob'+randomnumber+'').boxModeling();
}



//-------------Add Shape to Flyer----------------


function addshapetoflyer(shapeiq){ 

var randomnumber = Math.floor((Math.random() * 10000) + 1);
 
var d1 = document.getElementById('designarea'); 
 
d1.insertAdjacentHTML('beforeend', '<div class="box shapebox " onclick="thisprop(this);" sectype="shape" id="ob'+randomnumber+'" data-id="'+randomnumber+'" style="left: var(--left-2); top: var(--top-2); z-index: var(--zi-2); width: var(--width-2);    background-color: var(--bg-2);"> <div class="'+shapeiq+'"></div></div>');

 $('#ob'+randomnumber+'').boxModeling();
}



function addfontetoflyer(fontfamily){ 

var randomnumber = Math.floor((Math.random() * 10000) + 1);
 
var d1 = document.getElementById('designarea'); 
 
d1.insertAdjacentHTML('beforeend', '<div class="box fontbox " onclick="thisprop(this);" sectype="icon" id="ob'+randomnumber+'" data-id="'+randomnumber+'" style="left: var(--left-2); top: var(--top-2); z-index: var(--zi-2); width: var(--width-2);    background-color: var(--bg-2);"> <div style="font-family:'+fontfamily+'" class="fa edittextdiv" contenteditable="true">Welcome</div></div>');

 $('#ob'+randomnumber+'').boxModeling();
}






//-------------Add Background to Flyer----------------




function addbackgroundtoflyer(img){ 

var randomnumber = Math.floor((Math.random() * 10000) + 1);
 
var d1 = document.getElementById('designarea'); 
 
d1.insertAdjacentHTML('beforeend', '<div class="box constantTrue" onclick="thisprop(this);" sectype="photo" id="ob'+randomnumber+'" data-id="'+randomnumber+'" style="left: var(--left-2); top: var(--top-2); z-index: var(--zi-2); width: var(--width-2); height: var(--height-2); background-color: var(--bg-2); z-index:1;"> <img src="background/'+img+'" /></div>');

 $('#ob'+randomnumber+'').boxModeling();
}



function selectoption(id){
$('#projectoptionboxouter').html('<div style="text-align: center; font-size: 30px; color: #a1a1a1; margin-top: 160px;"><i class="fa fa-spinner fa-spin"></i></div>');
$('.left a').removeClass('active');
$('#'+id).addClass('active');
$('#projectoptionboxouter').show('slide');
$('#projectoptionboxouter').load('projectoption.php?secid='+id);
}


function loadmorebtn(id,from,to){
$('#projectoptionboxouter').load('projectoption.php?secid='+id+'&from='+from+'&to='+to);
}
	
	
        $('#designarea .box').boxModeling();
 
     
 



function downloadimage(){

$('#optionzoom').val('100%');
zoominout();

$('.box img').css('z-index','-0');
$('.box .rec').css('border','0px');
 
 html2canvas($('#designarea'), 
    {
	background: '#FFFFFF',
      onrendered: function (canvas) {
        var a = document.createElement('a');
        // toDataURL defaults to png, so we need to request a jpeg, then convert for file download.
        a.href = canvas.toDataURL("image/jpeg").replace("image/jpeg", "image/octet-stream");
        a.download = 'somefilename.jpg';
        a.click();
      }
    });
	
	 $('.box .rec').css('border','1px');
}

  

  


function zoominout(){
var optionzoom = $('#optionzoom').val(); 
$('.instagramposts').css('-webkit-transform','scale('+optionzoom+')'); 
}
zoominout();

function zoominfun(){
var optionzoom = $('#optionzoom').val();

if(optionzoom=='25%'){
$('#optionzoom').val('50%');
}


if(optionzoom=='50%'){
$('#optionzoom').val('75%');
}

if(optionzoom=='75%'){
$('#optionzoom').val('100%');
}
if(optionzoom=='100%'){
$('#optionzoom').val('120%');
}
zoominout();
}


function zoomoutfun(){
var optionzoom = $('#optionzoom').val();

 if(optionzoom=='75%'){
$('#optionzoom').val('50%');
}


if(optionzoom=='50%'){
$('#optionzoom').val('25%');
}
 
if(optionzoom=='100%'){
$('#optionzoom').val('75%');
}
if(optionzoom=='120%'){
$('#optionzoom').val('100%');
}
zoominout();
}
function rgb2hex(rgb) {
    if (/^#[0-9A-F]{6}$/i.test(rgb)) return rgb;

    rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
    function hex(x) {
        return ("0" + parseInt(x).toString(16)).slice(-2);
    }
    return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
}

function thisprop(obj){
var id = $(obj).attr('id');
var sectype = $(obj).attr('sectype');
$('#selectedobjid').val(id); 
$('.objoptionouter').show(); 



if ($("#"+id).hasClass("constantTrue")) { 
$('#constantTrue').prop("checked",true);
} else {
$('#constantTrue').prop("checked",false);
}

var opacity = 0;

$('.grayscalecol').hide();
$('.sizecol').show();

if(sectype=='photo'){
opacity = $("#"+id+' img').css('opacity'); 
$('.grayscalecol').show();
$('.sizecol').hide();
} else {
opacity = $("#"+id+' i').css('opacity');
}
$('#transparency').val(opacity);
 


if(sectype=='icon'){

var iconsize = $("#"+id+' .fa').css('font-size'); 
iconsize = Number(iconsize.replace("px", ""));
$('#iconsize').val(iconsize);
 $('.fontscolorcol').show();
 
var fontscolor = $("#"+id+' .fa').css('color');    
document.getElementById("fontscolor").value=rgb2hex(fontscolor);
$('.duplicatecol').show();
$('.roundcorcol').hide();
}


if(sectype=='shape'){ 
$('.grayscalecol').hide();
$('.fontscolorcol').show();
$('.sizecol').hide();
$('.duplicatecol').hide();
$('.roundcorcol').show();
}



if(sectype=='photo'){
 $('.fontscolorcol').hide();
var grayscaleval = $("#"+id+' img').css('filter');
grayscaleval = grayscaleval.replace("grayscale(", "");
grayscaleval = grayscaleval.replace("%)", "");
grayscaleval = Number(grayscaleval.replace(")", ""));
grayscaleval = Number(grayscaleval*100);  
$('#grayscale').val(grayscaleval);
$('.duplicatecol').show();
$('.roundcorcol').hide();
}

$('#projectoptionboxouter').hide('slide');
}


$(document).ready(function(){

    $(document).on('change', 'input[name="constantTrue"]', function(e){ 
		var selectedobjid = $('#selectedobjid').val(); 
		
		if($('#constantTrue').is(":checked")){
		 $('#'+selectedobjid).addClass('constantTrue');
		} else {
		$('#'+selectedobjid).removeClass('constantTrue'); 
		}
    });

});



$('#transparency').on('change', function() 
{
var transparency = $('#transparency').val(); 
    var selectedobjid = $('#selectedobjid').val(); 
	$('#'+selectedobjid+' img').css('opacity',transparency); 
	$('#'+selectedobjid+' .fa').css('opacity',transparency);  
	$('#'+selectedobjid+' .rec').css('opacity',transparency);  
	$('#'+selectedobjid+' .ove').css('opacity',transparency); 
	$('#'+selectedobjid+' .recr').css('opacity',transparency);  
});


function grayscale(){
var grayscaleval = $('#grayscale').val(); 
    var selectedobjid = $('#selectedobjid').val();
	var grayscale = 'grayscale('+grayscaleval+'%)';
	$('#'+selectedobjid+' img').css('filter',grayscale);  
 }


function iconsize(){
var iconsize = $('#iconsize').val(); 
    var selectedobjid = $('#selectedobjid').val();  
	$('#'+selectedobjid+' .fa').css('font-size',iconsize+'px');  
 }

function fontscolor(){
var fontscolor = $('#fontscolor').val(); 
    var selectedobjid = $('#selectedobjid').val();  
	$('#'+selectedobjid+' .fa').css('color',fontscolor); 
	$('#'+selectedobjid+' .rec').css('background-color',fontscolor);  
	$('#'+selectedobjid+' .recr').css('background-color',fontscolor);  
	$('#'+selectedobjid+' .ove').css('background-color',fontscolor);  
 }
 
 function roundcorner(){
 var selectedobjid = $('#selectedobjid').val();  
var fontscolor = $('#roundcorner').val();  
	$('#'+selectedobjid+' .recr').css('border-radius',fontscolor);  
	$('#'+selectedobjid+' .rec').css('border-radius',fontscolor);  
	$('#'+selectedobjid+' .ove').css('border-radius',fontscolor);  
 }
 
 
 
function dltobj(){
var id = $('#selectedobjid').val();
$( "#"+id ).remove();
$('#selectedobjid').val('');

}


function duplicateobj(){
var id = $('#selectedobjid').val(); 
 

var randomnumber = Math.floor((Math.random() * 10000) + 1);

const div = document.getElementById(id)
const clone = div.cloneNode(true);
clone.id = "op"+randomnumber;
document.getElementById('designarea').appendChild(clone);

 

$('#selectedobjid').val('');


   $('#op'+randomnumber).boxModeling({
            rotate: true,
            resize: true,
            move: true,
        });
 
 
$('#op'+randomnumber).css('border','2px solid #ff0000');
$('#op'+randomnumber).css('margin-top','30px');
 
      
}


$(document).ready(function () {
    $('#designarea div').hover(function () {
      $('.box').css('border','0px solid #ff0000');
    });
});


$(document).mouseup(function(e) 
{
    var container = $(".objoptionouter");

    // if the target of the click isn't the container nor a descendant of the container
    if (!container.is(e.target) && container.has(e.target).length === 0) 
    {
        container.hide();
    }
});


 
function saveproject(){

$('#optionzoom').val('100%');
zoominout();

var designarea = $('#designarea').html();
$('#projecthmtl').val(designarea);
$('#projecthtmlsaver').submit();
}



 
</SCRIPT>


<form class="custom-validation" action="actionpage.php" target="actoinfrm" novalidate="" id="projecthtmlsaver" method="post" enctype="multipart/form-data" style="display:none;">	

<textarea name="projecthmtl" id="projecthmtl" cols="100" rows="10"></textarea> 
<input name="projectid" id="projectid" type="hidden" value="<?php echo decode($_REQUEST['id']); ?>" />
<input name="action" id="action" type="hidden" value="saveprojecthtml" />

</form>


<input name="selectedobjid" id="selectedobjid" type="hidden" value="" />
</body>
</html>
