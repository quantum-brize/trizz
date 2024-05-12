<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge"> 	  
      <link href="<?php echo $fullurl; ?>images/favicon.png" rel="icon" /> 
      <link href="<?php echo $fullurl; ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
      <link href="<?php echo $fullurl; ?>assets/css/icons.css" rel="stylesheet" type="text/css">
      <link href="<?php echo $fullurl; ?>assets/css/style.css?i=1" rel="stylesheet" type="text/css">
	  <link rel="stylesheet" href="<?php echo $fullurl; ?>plugins/summernote/summernote-bs4.css">
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<style>
.header-bg { 
padding-bottom:0px; 
}

.sticky {
  position: fixed;
  top: 0;
  width: 100%;
      z-index: 999;
}

.wrapper {
    margin-top: 100px;
}

@media (min-width: 992px){
#topnav .navigation-menu>li:first-of-type>a {
    padding-left: 20px;
}

}
.bulbblue{text-transform:uppercase;}

.navigation-menu .active a{background-color: #ffffff2e !Important;}

#topnav .navigation-menu>li>a { 
    color: rgb(255 255 255);
    font-size: 14px; 
    font-weight: 600;
}

.header-bg{background-color:<?php echo $LoginUserDetails['themeColor']; ?>;}

#topnav .navigation-menu>li .submenu li a:hover {
    color: <?php echo $LoginUserDetails['themeColor']; ?>;
}

.card-body { 
    padding: 25px 30px;
}
.bulbblue{ 
    height: 45px;
    width: 45px;
    background-color: #3b5de7;
    border-radius: 100%;
    text-align: center;
    overflow: hidden;
    line-height: 45px;
    font-size: 24px;
    font-weight: 600;
    color: #fff; margin-right:20px;
}
.badge { 
    font-size: 12px;
    padding: 6px;
}

.dropdown-toggle::after { display:none;}

.optionmenu {
    font-size: 23px;
    padding: 0px;
    background-color: transparent;
    color: #a5a5a5;
    float: right;
    line-height: 30px;
    outline: 0px !important;
    border: 0px;
    width: auto;
    cursor: pointer;
}
.modal-backdrop{background-color:#f4f4f5 !important;}
.modal-backdrop.show {
    opacity: 0.9; 
}

.modal-content { border:0px;    box-shadow: 0px 0px 7px #d8d8d8;}

h1, h2, h3, h4, h5, h6 { 
    font-weight: 700;
}

.headersavealert{    position: fixed;
    width: 100%;
    top: 61px;
    padding: 5px;
    text-align: center;
    font-size: 15px;
    border-radius: 0px;
    z-index: 99;}
	
.card-title-desc{color: #858b95;}
.table thead th { 
    font-weight: 700;
    font-size: 13px;
    text-transform: uppercase; 
}

.tooltip.show {
    opacity: .8;
}

.tooltip .tooltip-inner {
    padding: 10px 10px; 
}






.pagingdiv {

    margin: 10px 20px;

    color: #464659;

    font-size: 14px;

}



 

.pagingnumbers{border:0px #EAEAEA solid; border-radius: 2px; overflow:hidden; float:right;} 

.pagingnumbers a {

    display: inline-block;

    padding: 6px 12px;

    min-width: 12px;

    text-align: center;

    color: #2c2c2c;

    text-decoration: none;

    border-right: #EAEAEA solid 0px;

    font-size: 12px; 

}

.pagingnumbers .nextprev{line-height: 20px;} 

.pagingnumbers a:hover{background-color:#EAEAEA; color:#4d709f;    border-radius: 2px; } 

.pagingnumbers .active{background-color:#6990C3; color:#FFFFFF;    border-radius: 2px;} 

.pagingnumbers .current{background-color:#3b5de7; color:#FFFFFF;    border-radius: 2px;} 

.pagingnumbers .disabled{display: inline-block; padding:7px 8px;color: #CECECE;    border-radius: 2px;} 

.pagingnumbers .current{display: inline-block; padding: 5px 12px;    border-radius: 2px;}


.pageingouter {
    margin-top: 1rem!important;
    overflow: hidden;
    padding: 10px;
    background-color: #f5f5f5;
    border-radius: 3px;
}

.dropdown-menu .leg {
    font-weight: 700;
    font-size: 12px;
    text-transform: uppercase;
    padding: 5px 18px; 
    color: #000000;
}

.dropdown-menu  hr {
    margin-top: 5px;
    margin-bottom: 5px; 
}

.dropdown-menu  .fa {color: #3db1a1;}

.topnavigation .nav-tabs-custom .nav-item .nav-link { 
    font-weight: 600;
    padding: 10px 30px;
}

.topnavigation .d-md-block {
    display: block!important;
    font-size: 16px;
}

.topnavigation .d-md-block { 
    font-weight: 400;
}

.topnavigation .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active2 { 
    color: #000 !important; 
}

.topnavigation .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active2 .d-md-block {
    font-weight: 700 !important;
}

.nav-tabs-custom>li>a::after { display:none;
}
.daywisebox{padding:15px  0px; border-top:1px solid #ccc;border-bottom:1px solid #ccc; margin-bottom:30px; font-size:20px; font-weight:700; }
.starcategorybox{color:#FF9900; padding-left:10px;}
.itiday{padding:15px  0px; border-top:1px solid #ccc;border-bottom:1px solid #ccc; margin-bottom:30px; font-size:20px; font-weight:700; }

.showinmobile{display:none;}
.hideinmobile{display:block;}

@media only screen and (max-width: 800px) {
  .headerresposive1 { padding:0px !important; padding-bottom:20px !important; text-align:center !important; position: absolute !important;  top: 20px !important;}
  .headerresposive2 { padding: 0px !important; padding-bottom: 0px !important; text-align: center !important; margin-top: 70px !important; }
 
 
 .coverBanner img {
    width: 100% !important;
    height: auto !important;
    min-height: 100% !important;
    margin-left: 0% !important;
}

body, html{width: 100% !important;}
body{ position:relative !important;}
.actiimgbox img {
    width: 100% !important;
    height: auto !important; 
}

.wbg { 
    position: relative !important;  
}

.bbg { 
    position: relative !important;  
}

.coverBanner {
    height: auto !important;   
}
.daywisebox{text-align:center !important; }
.starcategorybox{ display:block; padding-left:0px !important;}
 
.actiimgboxflight{height:auto !important;}
.actiimgboxflight img {
    width: 100% !important;
    height: auto !important; 
}
.itiday{text-align:center;}
.showinmobile{display:block;}
.hideinmobile{display:none;}
}

.lightgraytext{color:#999999;}
.redmtext{color:#FF0000;}
body{padding-bottom:0px;}
.grn{ background-color:#0cb5b5 !important;}
.rd{ background-color:#e45555 !important; color:#fff !important;}

#topnav .navigation-menu>li>a i { 
    margin-right: 4px !important;
}


::-webkit-scrollbar {
    width: 10px;
}

::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.4); 
    border-radius: 8px;
    -webkit-border-radius: 8px;
}

::-webkit-scrollbar-thumb {
    -webkit-border-radius: 10px;
    border-radius: 10px;
    background: rgba(100,100,100,0.8); 
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5); 
}

.ui-autocomplete{ z-index:9999 !important;}

.badge-blue{ background:#cc00a9; color:#fff; }

.badge-orange{ background:#FF6600; color:#fff; }

.breadcrumb li a {
padding: 10px 0 10px 40px !important;
}


</style>






<script>
function openloadsection(page,id){
$('#'+id).html('<div style="padding:10px; text-align:center;"><img src="<?php echo $fullurl; ?>images/loading.gif" width="32" ></div>');
$('#'+id).load(page);
}

function getSearchCIty(citysearchfield,cityresultfield,listsearch){
var citysearchfieldval = encodeURI($('#'+citysearchfield).val());  
var citysearchfield = citysearchfield;

if(citysearchfieldval!=''){  
$('#'+listsearch).show();
$('#'+listsearch).load('searchcitylists.php?keyword='+citysearchfieldval+'&searchcitylists='+listsearch+'&cityresultfield='+cityresultfield+'&citysearchfield='+citysearchfield);
}
}




function selectcity(){
	var stateId = $('#state').val();
	$('#city').load('loadcity.php?id='+stateId+'&selectId=<?php echo $editresult['city']; ?>');
	}
	
	function selectstate(){
	var countryId = $('#country').val(); 
	$('#state').load('loadstate.php?id='+countryId+'&selectId=<?php echo $editresult['state']; ?>'); 
	}
	 
</script>

