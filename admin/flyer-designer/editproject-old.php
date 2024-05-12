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
</head>

<body>
<?php include "header.php"; ?>

<div class="left">
<a id="o1" onclick="selectoption('o1');"><i class="fa fa-picture-o" aria-hidden="true"></i><div>Photo</div></a>
<a id="o2" onclick="selectoption('o2');"><i class="fa fa-font" aria-hidden="true"></i><div>Text</div></a>
<a id="o3" onclick="selectoption('o3');"><i class="fa fa-th" aria-hidden="true"></i><div>Background</div></a>
<a  id="o4" onclick="selectoption('o4');"><i class="fa fa-futbol-o" aria-hidden="true"></i><div>Designs</div></a>
<a  id="o5" onclick="selectoption('o5');"><i class="fa fa-star" aria-hidden="true"></i><div>Icons</div></a>

</div>

 
<div class="designbody">
<div class="instagramposts" id="designarea" style=" width:<?php echo $res['pageWidth']; ?>; height:<?php echo $res['pageHeight']; ?>;"> 
 <div class="box" onclick="thisprop(this);" id="ob1" data-id="1" style="left: var(--left-1); top: var(--top-1); z-index: var(--zi-1); width: var(--width-1); height: var(--height-1); background-color: var(--bg-1);"> <img src="images/test.jpg" /></div>

 
        <div class="box" onclick="thisprop(this);"  id="ob2" data-id="2" style="left: var(--left-2); top: var(--top-2); z-index: var(--zi-2); width: var(--width-2); height: var(--height-2); background-color: var(--bg-2);"></div>

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




<div class="objoptionouter">
<div class="objoption"><table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="center"><div onclick="duplicateobj();"><i class="fa fa-files-o" aria-hidden="true"></i><div style="margin-top:2px; font-size:11px;">Duplicate</div></div></td>
    <td width="50%" align="center"><div onclick="dltobj();"><i class="fa fa-trash" aria-hidden="true"></i><div style="margin-top:2px; font-size:11px;">Delete</div></div></td>
  </tr>
  
</table>
</div>
</div>



<div id="projectoptionboxouter"></div>




<script src="js/box-modeling.js"></script>
 
 
 
<script>

function selectoption(id){
$('#projectoptionboxouter').html('<div style="text-align: center; font-size: 30px; color: #a1a1a1; margin-top: 160px;"><i class="fa fa-spinner fa-spin"></i></div>');
$('.left a').removeClass('active');
$('#'+id).addClass('active');
$('#projectoptionboxouter').show();
$('#projectoptionboxouter').load('projectoption.php?secid='+id);
}


function loadmorebtn(id,from,to){
$('#projectoptionboxouter').load('projectoption.php?secid='+id+'&from='+from+'&to='+to);
}
	
	
        $('#designarea .box').boxModeling({
            rotate: true,
            resize: true,
            move: true,
        });
 
     
 



$(function() { 
    $("#btnSave").click(function() { 
        html2canvas($("#designarea"), {
            onrendered: function(canvas) {
                theCanvas = canvas;
                document.body.appendChild(canvas);

                // Convert and download as image 
                Canvas2Image.saveAsPNG(canvas); 
                $("#img-out").append(canvas);
                // Clean up 
                //document.body.removeChild(canvas);
            }
        });
    });
});

  


function zoominout(){
var optionzoom = $('#optionzoom').val(); 
$('#designarea').css('-webkit-transform','scale('+optionzoom+')'); 
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


function thisprop(obj){
var id = $(obj).attr('id');
$('#selectedobjid').val(id); 
$('.objoptionouter').show();   
}


function dltobj(){
var id = $('#selectedobjid').val();
$( "#"+id ).remove();
$('#selectedobjid').val('');

}


function duplicateobj(){
var id = $('#selectedobjid').val(); 

$("#"+id).clone().appendTo('#designarea');
$('#selectedobjid').val('');


   $('#designarea .box').boxModeling({
            rotate: true,
            resize: true,
            move: true,
        });
 
}


$(document).mouseup(function(e) 
{
    var container = $(".objoptionouter");

    // if the target of the click isn't the container nor a descendant of the container
    if (!container.is(e.target) && container.has(e.target).length === 0) 
    {
        container.hide();
    }
});
</SCRIPT>








<input name="selectedobjid" id="selectedobjid" type="hidden" value="" />
</body>
</html>
