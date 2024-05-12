<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge"> 	  
      <link href="<?php echo $fullurl; ?>images/favicon.png" rel="icon" /> 
      <link href="<?php echo $fullurl; ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
      <link href="<?php echo $fullurl; ?>assets/css/icons.css" rel="stylesheet" type="text/css">
      <link href="<?php echo $fullurl; ?>assets/css/style.css?i=1" rel="stylesheet" type="text/css">
	  <link rel="stylesheet" href="<?php echo $fullurl; ?>plugins/summernote/summernote-bs4.css">
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'> 
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Fjalla+One&display=swap" rel="stylesheet">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
 <link href="<?php echo $fullurl; ?>customstyle.css?i=1" rel="stylesheet" type="text/css">
 
 


<style>
.header-bg{background-color:<?php if($LoginUserDetails['themeColor']=='#313949'){ echo '#12344d'; }  else { echo $LoginUserDetails['themeColor']; } ?>;}

#topnav .navigation-menu>li .submenu li a:hover {
    color: <?php echo $LoginUserDetails['themeColor']; ?>;
}
.headerslideright .userinformationbox{background-image:url(images/gray-abstract-bg.png); background-repeat:repeat; padding:15px; position:relative; border-top:5px solid <?php echo $LoginUserDetails['themeColor']; ?>;}
#tograypanelmenu .rightmenu a:hover{color:<?php echo $LoginUserDetails['themeColor']; ?>;}

<?php if($LoginUserDetails['theme']==2){ ?>
html{filter: invert(1);}
.badge{filter: invert(1);}
.btn{filter: invert(1);}
.statusbox{filter: invert(1);}
.outeritibox{filter: invert(1); background-color:#f0f0f0;}
.rightmenu{filter: invert(1);  }
.welcomename{filter: invert(1);  }
.logonavitop{filter: invert(1);  } 
.querylistbox img{filter: invert(1);  }
table img{filter: invert(1); }
#chartdiv{filter: invert(1); }
 
.headerslideright .userinformationbox .nameboxxx{filter: invert(1);  }
.footerpopboxs .usernotesouter .usernotes .noteareawrite{ color:#fff;}
.header-bg{background-color: #e2e2e2 !important;}
#topnav .navigation-menu>li>a{color: #00000080 !important;}
#topnav .navigation-menu>li>a:hover{color: #00000080 !important;}
#topnav .navigation-menu>li>a:hover i{color: #00000080 !important;}
#topnav .has-submenu.active a{filter: invert(1);}
<?php } ?>

#topnav .navigation-menu>li>a { 
    padding-top: 10px !important;
    padding-bottom: 10px !important;
	
}
.topmainlogomain{display:block;}
.topmainlogomainmobile{display:none;}
#navigation{display: block;}
.hideinmobile{display:block;}
.showinmobile{display:none;}
.inquerytabsmain { width: 100%;  background-color: #f5f7f9; padding: 13px; height: 100%; margin-bottom: 0px; position: relative; float: none; border-bottom: 0px; min-width:250px; }
.sectabnew{margin-bottom: 20px; float: left; width: 100%; border-top: 1px solid #dee2e6; border-bottom: 2px solid #dee2e6; background-color: #f3f3f3; padding: 8px;}
.float-right button { float: left; margin-left: 5px; margin-bottom: 0px; margin-top: -8px; margin-bottom: 3px; }
.float-right a{float:left; margin-left:5px;}
.searchquerymain{display:none;}


.nav-tabs-custom .nav-item .nav-link { border: none!important; font-weight: 600; text-align: left; padding: 12px !important; font-weight: 400; }

@media only screen and (max-width: 900px) {
#topnav .navigation-menu>li .submenu { position: absolute; top: -220%; left: 80px; z-index: 1000; padding: 4px 0; list-style: none; min-width: 200px; text-align: left; visibility: hidden; opacity: 0; margin-top: 20px; -webkit-transition: all .2s ease; transition: all .2s ease; background-color: #fff; -webkit-box-shadow: 0 1px 12px rgb(0 0 0 / 10%); box-shadow: 0 0px 0px rgb(0 0 0 / 34%); border-radius: 4px; border-left: 3px solid #46cd93; background-color: #00000038 !important; }
#navigation{display: none; position: fixed; left: 0px; top: 0px; width: 70%; background-color: #313949; height: 100%;}
#topnav .navigation-menu>li { width: 100% !important; text-align: center; text-align: left; padding: 5px; }
#topnav .navigation-menu>li .submenu { position: relative; display: block !IMPORTANT; top: 0px !important; left: 0px !important; z-index: 1000; padding: 4px 0; list-style: none; min-width: 200px; text-align: left; visibility: visible !important; opacity: 1; margin-top: 20px; -webkit-transition: all .2s ease; transition: all .2s ease; background-color: #fff; }
#topnav .navigation-menu>li>a i {   position: absolute;left: 16px; margin-top: 0px !IMPORTANT;}
#topnav .navigation-menu>li>a { padding-top: 8px !important; padding-bottom: 8px !important; padding-left: 37px !important; font-size: 15px !important;    }
#topnav .navigation-menu>li .submenu{margin-top:0px; margin-top: 16px !important;}
#topnav .navigation-menu>li .submenu li a {  color: #ffffff; }
#topnav .has-submenu.active a { color: #fff !important; background-color: #ffffffcf !important; padding: 10px 38px !important; }
.headersearchbarouter{display:none;}
.footerstripboxouter{display:none;}
#loadnotificationscreate { overflow: auto; height: 80% !important; position: fixed; }
.mailopened{display:none !important;}
.topmainlogomain{display:none;}
.topmainlogomainmobile{display:block;}
.topmainlogomainmobile .fa{color:#fff;}
.topmainlogomainmobile { display: block; background-color: #23ae73; padding: 0px 10px; margin-left: -6px; margin-top: -7px; font-size: 24px; border-radius: 3px; }
.header-bg { background-color: #ffffff; width: 0px !important; }
.dashboardleft { background-color: #FFFFFF; width: 100%; position: relative; left: 0px; top: 0px; height: 100%; box-sizing: border-box; }
.wrapper {  padding-left: 10px !important;  padding-right: 10px !important;  }
.container-fluid {  padding-right: 5px !important;  padding-top: 8px !important;  padding-left: 4px !important; }
.dashboardleft .dashboardleftinnter{padding-top:14px; overflow:hidden;}
.dashboardleft { background-color: #FFFFFF; width: 100%; position: relative; left: 0px; top: 0px; height: 100%; box-sizing: border-box; border-radius: 5px; margin-bottom: 10px; }
.dashboardleft .listbox { padding: 10px 18px; background-color: #e5e4ff; font-size: 20px; margin-bottom: 10px; border-radius: 12px; border-left: 4px solid #00000024; width: 46%; text-align: center; float: left; height: 73px; margin: 6px; }
.createquerybtnmaindash{margin-top:10px !important;}
.invitememberboxbutton{margin-bottom:20px !important;}
.topmainlogomainmobile { display: block; background-color: #23ae73; padding: 0px 10px; margin-left: -4px; margin-top: -4px; font-size: 24px; border-radius: 3px; }
#tograypanelmenu .rightmenu a {  color: #ffffff94;}
#tograypanelmenu .rightmenu a {margin-left: 10px;margin-right: 10px;}
#tograypanelmenu { background-color: #313949; border-bottom: 3px solid #46cd93; padding: 2px; height: 56px; }
#tograypanelmenu .navirightlink{padding:12px;}
#topnav .navigation-menu { padding-top: 60px; }
.rnblkquery .querywhitebox{width:100% !important;}
.modal-dialog{width:100% !important;}
.rnblkquery .modal-footer{ position:relative !important; padding-right:0px;}
.headerslideright {overflow:auto;}
.float-right { float: right!important; width: 100%; margin: 12px 0px; }
.querytabslead{overflow:auto; width:100%;}
.querytabslead .statusbox {   width: 130px; font-size:10px!important; font-weight:600!important;  }
.statusbox {  font-size:12px!important; }
.querytabsleadsearch table tr td{display:block!important; width:100% !important; padding:0px !important; padding-bottom:5px !important;}
.querytabsleadsearch table tr td input{width:100% !important;}
.querytabsleadsearch table tr td select{width:100% !important;}
.querytabsleadsearch table tr td button{width:100% !important;}
.querytabsleadsearch table {width:100% !important;}
.querylistbox{width:100%; overflow:auto;} 
.querylistbox table{width:1000px !important;}
.hideinmobile{display:none;}
.showinmobile{display:block;}
.searchquerymain{padding:0px !important; padding:10px 0px !important;border-radius:10px;}
.d-none {  display: block !important; }
.d-block {  display: none !important; }
.inquerytabsmain{width:100%; overflow:auto; margin-bottom:10px;}


.inquerytabsmain .nav-tabs-custom{width:1150px !important;}
.querystatustabmain{width:97% !important; overflow:auto !important;}
.querystatustabmain .breadcrumb{width:1082px !important;margin-bottom:10px;}
.whatsappsharequerymain { position: fixed; right: 218px; top: 7px; z-index: 99999; }
.whatsappsharequerymain img{height:36px !important;}
.mobilemargianbottomzero{margin-bottom:0px !important;}
.sectabnew .float-right{width:auto !important;}
.overflowautomobiletable{overflow:auto; width:100%;}
.overflowautomobiletable table{min-width:800px !important;}
.message-list li .col-mail-2{display:none;}
}

.ui-datepicker{box-shadow: 0px 0px 10px #00000045 !important; border: 1px solid #e5e5e5 !important; padding: 0px !important; width:auto !important;}
.ui-datepicker .ui-widget-header { border: 1px solid #ffffff; background: #ffffff; color: #333333; font-weight: bold; font-size: 18px; }
.ui-datepicker .ui-state-default { border: 0px; text-align: center; font-size: 14px; padding: 14px 12px !important; background-color: #fff !important; border: 0px !important; }
.ui-datepicker .ui-state-default:hover{background-color: #f0f0f0 !important;border-radius: 4px; color:#000 !important;}

.ui-datepicker table{margin-bottom:0px !important;}
.ui-datepicker table th{color:#8B9898 !important;}
.ui-datepicker .ui-state-highlight{ background-color:#d6fff1!important; color:#3a8e71!important;border-radius: 4px;}
.ui-datepicker .ui-state-active{background-color:#008cff !important; color:#fff !important;border-radius: 4px;}
.ui-datepicker .ui-datepicker-header{box-shadow: 0px 0px 10px #0000004d;}
.ui-datepicker .ui-datepicker-title{font-size:17px !important; }
.ui-datepicker .ui-datepicker-prev{background-color:#fff !important; border:0px !important; cursor:pointer;}
.ui-datepicker .ui-datepicker-next{background-color:#fff !important; border:0px !important; cursor:pointer;}
.ui-datepicker .ui-datepicker-calendar tr td:first-child{padding-left:15px !important;}
.ui-datepicker .ui-datepicker-calendar tr td:last-child{padding-right:15px !important;}
.ui-datepicker .ui-datepicker-calendar tr th:first-child{padding-left:15px !important;}
.ui-datepicker .ui-datepicker-calendar tr th:last-child{padding-right:15px !important;}
.ui-datepicker .ui-datepicker-calendar tr th{padding-top:25px!important;}
.ui-datepicker .ui-datepicker-calendar{margin-bottom:15px!important;}
.ui-datepicker select.ui-datepicker-month, .ui-datepicker select.ui-datepicker-year { border: 1px solid #ddd!important; padding: 5px 4px!important; font-size: 13px!important; margin: 0px 2px!important; border-radius: 4px;}
.btn-group .btn-secondary { border-radius: 0px !important; border: 1px solid #ddd !important; border-right:0px !important; background-color: transparent !important; background-image: none; color: #000; padding: 5px 10px; background: rgb(255,255,255); background: linear-gradient(180deg, rgba(255,255,255,1) 47%, rgba(244,244,244,1) 100%); color:#000000 !important;}
.btn-group .btn-secondary:hover{background: rgb(244,244,244); background: linear-gradient(180deg, rgba(244,244,244,1) 0%, rgba(255,255,255,1) 47%);}

.btn-group {border-radius: 4px !important; overflow:hidden; border-right:1px solid #cfd7df; margin-right:3px; }
.workinghoursstrip{background-color: #d9fffb; color: #000; padding: 10px; font-size: 12px; font-weight: 700; padding-left: 35px;}
.width480{ width:400px !important;}
.mastericons{text-align:center; overflow:hidden;}
.mastericons a{padding:10px 0px !important;  font-size:30px !important; text-align:center; cursor:pointer; width:32% !important;display: inline-block !important; margin:1px 0px; border: 1px solid #e6f4ff;  }
.mastericons a .titilemaster{margin-top:2px; font-size:13px !important; color:#6d6d6d; font-weight:400;}
.mastericons a:hover{background-color:#e6f4ff !important;border-radius: 4px !important;}
.mastericons a img{width:32px !important;}
.querylistbox .viewpackageheader { padding: 6px 8px; font-size: 11px; background-color: #ebebeb; color: #0a0a0a; text-transform: uppercase; font-weight: 600; line-height: 12px; cursor:pointer; }
.querylistbox:hover .viewpackageheader { background-color:#35beff; color:#fff;}
.querylistbox .proposallistouter{background-color:#FFFFFF; padding:0px 0px;}
.querylistbox .proposallistouter a{ padding:4px 8px; display:block; border-bottom:1px solid #ddd; font-size:12px; font-weight:600; color:#000000;}
.querylistbox .proposallistouter a:hover{background-color:#FFFFCC;}

.roleouter{ border-left:2px dashed #c5c5c5; margin-left:50px;}
.roleouter .headrole { margin-top:30px; padding: 5px 10px; font-weight: 600; margin-left: 30px; background-color: #dff0ff; border-radius: 4px; line-height: 25px; position:relative; width: max-content;}
.roleouter .hyrouter { border-left: 2px dashed #ddd; padding: 13px 30px; margin-left: 50px; position: relative; }
.roleouter .rolebox { background-color: #EFEFEF; width: fit-content; padding: 4px 10px; text-align: center; color: #000000; border-radius: 4px; font-weight: 600; line-height: 22px; }
.roleouter .linerole { position: absolute; left: 0px; width: 31px; background-color: #EFEFEF; height: 4px; left: -30px; top: 15px; }
.roleouter .hyrouter .linerole { position: absolute; left: 0px; width: 31px; background-color: #EFEFEF; height: 4px; left: 0px; top: 30px; }
.roleouter .hyrouter .ingry{ background-color: #EFEFEF; width: fit-content; padding: 4px 30px; text-align: center; color: #000000; border-radius: 4px; font-weight: 600; line-height: 22px; }
.roleouter a { display: block; position: absolute; top: 18px; left: 14px; background-color: #000 !important; padding: 2px; height: 20px; width: 20px; font-size: 12px; color: #fff !important; line-height: 15px; } 
option:disabled { color: red; background-color:#FFFFCC; font-weight:600; padding:4px;}
.modal-content { border: 0px; box-shadow: 2px 2px 9px #00000045; }

.listtypehome {
    overflow: hidden;
}

.listtypehome a { float: left; display: block; margin-right: 10px; padding: 10px; border: 1px solid #fff; margin-bottom: 10px; }
.listtypehome a img { width: 148px; }
.listtypehome a div { font-weight: 600; color: #333333; text-align: center; padding-top: 10px; }
.listtypehome a:hover { border: 1px solid #03acea3d; box-shadow: 2px 2px 5px #00000042; margin-bottom: 10px; border-radius: 10px; }

#topnav .has-submenu.active a {
    color: <?php if($LoginUserDetails['themeColor']=='#313949'){ echo '#12344d'; }  else { echo $LoginUserDetails['themeColor']; } ?> !important; 
	background-color:#ffffffe8 !important;
	fill:<?php if($LoginUserDetails['themeColor']=='#313949'){ echo '#12344d'; } else { echo $LoginUserDetails['themeColor']; } ?>;
}

#topnav .active>a:hover i { color: <?php if($LoginUserDetails['themeColor']=='#313949'){ echo '#12344d'; }  else { echo $LoginUserDetails['themeColor']; } ?> !important;  }
#topnav .unified360-valign{width:20px !important;}
#topnav #navigation  .unified360-valignimg{width:20px !important; stroke: #ffffffd1;}
#topnav #navigation  .active .unified360-valignimg {stroke: <?php if($LoginUserDetails['themeColor']=='#313949'){ echo '#12344d'; } else { echo $LoginUserDetails['themeColor']; } ?>;}
body { background-color: #f8fafa!important; }
html { background-color: #f8fafa!important; }
.minwbox{max-width:1070px; margin:auto; margin-top:45px !important; padding-top:50px;}
.newboxheading { background: #f5f7f9; border-bottom: solid 1px #cfd7df; padding: 12px 10px; padding-left: 85px; font-weight: 700; margin-top: -10px; position: fixed; width: 100%; left: 0px; z-index: 9;  height:46px; }
.newboxheading .newhead{position:relative;}
.newboxheading .newoptionmenu{ position:absolute; right:0px; top:-7px; width:auto;}
.newboxheading .newoptionmenu div { float: right; margin-top: -2px; margin-left:5px; }
.newboxheading .newoptionmenu div .btn{margin-top:3px;height: 34px}

.newbigpadding{padding:20px !important; }
.newbigheader{border-bottom: 1px dashed #cfd7df; padding-bottom:10px; margin-bottom:10px; font-size:18px; font-weight:600;}
.settings-group-description { font-size: 12px; color: #666; font-weight:400; }
.mastericons a img { width: 36px !important; float: left; }
.mastericons a .titilemaster { margin-top: 2px; color: #6d6d6d; font-weight: 400; text-align: left; font-size: 14px !important; line-height: 27px; padding-left: 46px; }
.mastericons a { padding: 10px 0px !important; font-size: 30px !important; text-align: center; cursor: pointer; width: 32% !important; display: inline-block !important; margin: 1px 0px; border: 0px solid #e6f4ff; padding: 25px !important; }
.page-content .card-title { padding: 20px !important;  padding-bottom: 0px !important;  margin-bottom: 10px !important;  }
.card-title-desc { margin-left: 20px !important;  }
.newsearchsecform { position: absolute; top: 10px; width: 220px; left: 196px !important; }
.newsearchsec { margin-top: 3px; border-radius: 5px; padding: 10px; height: 34px; } 
.newpadding30{padding-top:30px !important; }
.statusbox {  font-size:12px !important; padding:8px !important;font-size:10px!important; font-weight:600!important; }
 
 
.inquerytabsmain .nav-tabs .nav-item.show .nav-link, .inquerytabsmain .nav-tabs .nav-link.active { color: #495057; background-color: #6c757d; border-color: #dee2e6 #dee2e6 #fff !important;  color: #000 !important; border-radius: 3px; background-color: #fff !important; box-shadow: 1px 2px 6px #00000024; border-left: 4px solid #46cd93 !important; }

.btn-primary { background: rgb(38,73,102); background: linear-gradient(180deg, rgba(38,73,102,1) 0%, rgba(18,52,77,1) 46%, rgba(18,52,77,1) 100%);  }
.suplistingouter{width:100%;}
.suplistingouter .card-body{padding:10px !important; font-size:12px;}
.suplistingouter .card{ margin-bottom:10px !important; margin-right:5px;}
.suplistingouter .card:hover{background-color:#FFFFCC;}
.inquerytabsmain .nav-tabs-custom .nav-link:hover{background-color: #e6e9f1 !important;  border-radius: 5px !important; }

.newoptionmenu .form-control { font-family: 'Lato', sans-serif !important; font-size: 13px !important; height: 34px!important;  }
#topnav .navigation-menu>li .submenu div { background-color:  <?php if($LoginUserDetails['themeColor']=='#313949'){ echo '#12344d'; } else { echo $LoginUserDetails['themeColor']; } ?> !important;   }
.statusbox{position:relative; overflow:hidden;    box-shadow: 1px 3px 4px #0000005e;}


.ripple { margin: auto; background-color: #ffffff0f; width: 1rem; height: 1rem; border-radius: 50%; animation: ripple 2s linear infinite; position: absolute; left: 45%; top: 61px; }
@keyframes ripple {
  0% {
    box-shadow: 0 0 0 .7rem rgba(255,255,255, 0.2),
                0 0 0 1.5rem rgba(255,255,255, 0.2),
                0 0 0 5rem rgba(255,255,255, 0.2);
  }
  100% {
    box-shadow: 0 0 0 1.5rem rgba(255,255,255, 0.2),
                0 0 0 4rem rgba(255,255,255, 0.2),
                0 0 0 8rem rgba(255,255,255, 0);
  }
}


html{ background-repeat:repeat;}
#reminderouterrightbottom { background: #fff; border: 1px solid #cfd7df; box-shadow: 0 2px 5px rgb(39 49 58 / 15%) !important; border-radius: 8px; position: fixed; right: 10px; bottom: 40px; width: 390px;background: rgb(255,255,255); background: linear-gradient(52deg, rgba(255,255,255,1) 44%, rgba(255,221,221,1) 78%, rgba(254,163,163,1) 100%); display:none; } 
#tograypanelmenu .rightmenu a{    padding: 5px 12px;}

body { background-color: #f8fafa!important; }
.wrapper .card {box-shadow: 1px 1px 7px rgba(154,154,204,.1)!important;     border: 1px solid #e6e6e6!important;  }
.cardsmheading2{font-size:12px; font-weight:600; margin-top:5px; color:#4a4a69; }
.cardsmheading{font-size:12px; font-weight:600; margin-bottom:5px; color:#4a4a69;  }
.cardnumberbig{font-size:26px; font-weight:600; color:#4a4a69; line-height:32px; position:relative;}
.cardnumberbig .fa-external-link { font-size: 16px; position: absolute; right: 4px; top: -13px; padding: 9px; background-color: #38cab333; color: #38cab3; border-radius: 4px; }
.taskfollowuplist .tasklist { padding: 10px 18px; background-color: transparent; font-size: 20px; margin-bottom: 10px; border-radius: 0px; border-left: 0px solid #00000024;border: 0px; position: relative; border-bottom: 1px solid #ededf5; padding-right: 0px; margin-right: 0px;  padding-left:0px;}
.dashheader{border-left:4px solid #0bbfa9; padding-left:6px; line-height: 15px;}
.taskfollowuplist .tasklist .badge{bottom: 26px !important; border-radius: 4px;}
.morningh2{font-size:20px; line-height:22px; margin:0px; color:#38cab3; margin-bottom:3px;}
.bigbtntab table tr td { padding: 7px 6px; font-size: 13px; }

#topnav .navigation-menu>li.last-elements .submenu{left: 45px !important;width: 240px;}

.boxtabs a { padding: 10px 30px; border: 1px solid #ddd; margin-bottom: 20px; float: left; border-radius: 5px; margin-right: 10px; font-weight: 600; background-color: #fff; color: #000000; }
.boxtabs .active { background-color:<?php if($LoginUserDetails['themeColor']=='#313949'){ echo '#12344d'; }  else { echo $LoginUserDetails['themeColor']; } ?>; color: #FFFFFF; border: 1px solid <?php if($LoginUserDetails['themeColor']=='#313949'){ echo '#12344d'; }  else { echo $LoginUserDetails['themeColor']; } ?>;  }
#topnav .navigation-menu>li .submenu div { border:1px solid #FFF; }
#topnav .navigation-menu>li .submenu{left:44px;}
.badge{color:#fff;}
hr { border-bottom: 1px solid #8181814d; margin-top: 10px;  margin-bottom: 10px; }
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