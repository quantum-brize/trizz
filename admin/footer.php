 
 
 <div id="reminderouterrightbottom">
<div style="padding:20px;">

<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"><img src="images/remonder-bell_192.gif" style="width:70px;" /></td>
    <td width="90%" id="loadremindertask" style="padding-left:10px;">&nbsp;</td>
  </tr>
</table>

</div>
</div>


 
 
 
 
 
 
 <script> 
var intervalId = window.setInterval(function(){ 
 showcurrentworkinghours();
 
}, 60000);
 
showcurrentworkinghours();
 </script>
 
 
 <div style="height:50px;"></div>
 <iframe id="actoinfrm" name="actoinfrm" src="" style="display:none;"></iframe> 

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> 
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 
 	    <script src="<?php echo $fullurl; ?>assets/js/bootstrap.bundle.min.js"></script>
	    <script src="<?php echo $fullurl; ?>assets/js/modernizr.min.js"></script>
	    <script src="<?php echo $fullurl; ?>assets/js/waves.js"></script>
	    <script src="<?php echo $fullurl; ?>assets/js/jquery.slimscroll.js"></script>
	    <script src="<?php echo $fullurl; ?>plugins/peity-chart/jquery.peity.min.js"></script>
	    <!--Morris Chart--> 
	    <script src="<?php echo $fullurl; ?>plugins/raphael/raphael-min.js"></script>
	    <script src="<?php echo $fullurl; ?>assets/pages/dashboard.js"></script>
	    <!-- App js --> 
	    <script src="<?php echo $fullurl; ?>assets/js/app.js"></script>  
		

<?php if($_REQUEST['showcong']==1){ ?>
 <style>
canvas { display: block; background-color: #050505d1; position: fixed; left: 0px; top: 0px; z-index: 999; width: 100%; height: 100%; display:none; }
 
 </style>
 <div style="position:fixed; left:0px; top:48%; font-size:30px; color:#fff; font-weight:600; text-align:center;z-index: 9999; width:100%; display:none;" id="congratutext">Congratulations!</div>
 
  <canvas id="canvas" class="congratuanimation">
</canvas>
<?php } ?>

<script>
$('canvas').fadeIn();
$('#congratutext').fadeIn();

setTimeout(function() { $('canvas').fadeOut(); $('#congratutext').fadeOut();  }, 2000);
</script>
		
 
	   
<script>
function redirectpage(pages){
window.location.href = pages;
}
</script>

<div id="ActionDiv" style="display:none;"></div>



<script>
function loadpop(pagetitle,obj,width){
$('#popcontent').html('<div style="padding:10px; text-align:center;"><img src="<?php echo $fullurl; ?>images/loading.gif" width="32" ></div>');
var popaction = encodeURI($(obj).attr('popaction')); 
$('#poptitle').html(pagetitle);
$('.modal-dialog').css('max-width',width);
$('.modal-dialog').css('width',width);
$('#popcontent').load('<?php echo $fullurl; ?>loadpopup.php?'+popaction);
}


function loadpop2(pagetitle,obj,width){
$('#popcontent2').html('<div style="padding:10px; text-align:center;"><img src="<?php echo $fullurl; ?>images/loading.gif" width="32" ></div>');
var popaction = encodeURI($(obj).attr('popaction')); 
$('#poptitle2').html(pagetitle);
$('.modal-dialog').css('width',width);
$('.modal-dialog').css('max-width',width);

$('#popcontent2').load('<?php echo $fullurl; ?>loadpopup.php?'+popaction);
}




function hideModal() {
  $("#myModal").removeClass("in");
  $(".modal-backdrop").remove();
  $('body').removeClass('modal-open');
  $('body').css('padding-right', '');
  $(".modal").hide();
}

setTimeout(function(){ $('.headersavealert').slideUp(); }, 3000);
$('#loadnotificationscreate').load('loadnotificationscreate.php');
</script>





		<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="" style="display: none;" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
		<div class="modal-header">
		<h5 class="modal-title mt-0" id="poptitle"></h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
		</button>
		</div>
		<div class="modal-body" id="popcontent">
		
		</div>
		</div> 
		</div> 
		</div>
											
											

	
	
	
	
	
	
	
	<div class="modelnew modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
		<div class="modal-dialog" role="document">
			<div class="modal-content">

				<div class="modal-header">
					
					<h4 class="modal-title"  id="poptitle2">Right Sidebar</h4>
					
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
		</button>
				</div>

		<div class="modal-body" id="popcontent2"> 
				</div>

			</div><!-- modal-content -->
		</div><!-- modal-dialog -->
	</div><!-- modal -->
	
	
											
											
<style>

.modelnew.show .modal-dialog{
        right: 0px !important;
        transform: translate(-100%, 0);
      }


.modal.left .modal-dialog,
.modal.right .modal-dialog {
		position: fixed;
		margin: auto;
		width: 320px;
		height: 100%;
		-webkit-transform: translate3d(0%, 0, 0);
		    -ms-transform: translate3d(0%, 0, 0);
		     -o-transform: translate3d(0%, 0, 0);
		        transform: translate3d(0%, 0, 0);
	}



	.modal.left .modal-content,
	.modal.right .modal-content {
		height: 100%;
		overflow-y: auto;
	}
	
	.modal.left .modal-body,
	.modal.right .modal-body {
		padding: 15px 15px 80px;
	}

/*Left*/
	.modal.left.fade .modal-dialog{
		left: -320px;
		-webkit-transition: opacity 0.3s linear, left 0.3s ease-out;
		   -moz-transition: opacity 0.3s linear, left 0.3s ease-out;
		     -o-transition: opacity 0.3s linear, left 0.3s ease-out;
		        transition: opacity 0.3s linear, left 0.3s ease-out;
	}
	
	.modal.left.fade.in .modal-dialog{
		left: 0;
	}
        
/*Right*/
	.modal.right.fade .modal-dialog {
		right: -320px;
		-webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
		   -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
		     -o-transition: opacity 0.3s linear, right 0.3s ease-out;
		        transition: opacity 0.3s linear, right 0.3s ease-out;
	}
	
	.modal.right.fade.in .modal-dialog {
		right: 0;
	}









.container-fluid {
    max-width: 100%;
    padding-left: 92px;
    padding-right: 22px;
    padding-top: 8px;
}

.wrapper {
    margin-top: 56px;
    padding-left: 20px;
}

.table>tbody>tr>td, .table>tfoot>tr>td, .table>thead>tr>td {
    padding: 10px 12px;
}
 
.container-fluid .col-md-12 .card-body{padding:0px;}
body, html{background-color:#fff;}

.card { 
    -webkit-box-shadow: 0 0 1.25rem rgb(108 118 134 / 0%);
    box-shadow: 0 0 1.25rem rgb(108 118 134 / 0%); 
}
.topnavigation{padding-top:0px !important;} 
#ui-datepicker-div{z-index:99999999 !important;}
</style>




											

<div class="rnblkquery">
<i class="fa fa-times" aria-hidden="true" style="position: absolute; right: 25px; top: 15px; color: #666666; font-size: 20px; cursor: pointer;" onclick="createqueryclose();"></i> 
<div class="querywhitebox">
<h4 class="card-title" style="margin-top: 0px; margin-bottom:0px; padding: 15px; background-color: #f8f8f8; border-bottom: 1px solid #ddd; font-size: 20px; text-transform: uppercase;padding-left: 25px;">Add Query</h4>
<div id="loadqueryadd" style="padding:20px;">Loading...</div>
</div> 
</div>											
											
 



<script>
function createqueryfromclient(id){
$('#loadqueryadd').html('Loading...');
$('.rnblkquery').show();
$('body').css('overflow','hidden');
$('html').css('overflow','hidden');
$('#loadqueryadd').load('add_query.php?cid='+id);
if(id==''){
$('.rnblkquery .card-title').html('Create Query');
} else {
$('.rnblkquery .card-title').html('Edit Query');
}
}

function createquery(id){
$('#loadqueryadd').html('Loading...');
$('.rnblkquery').show();
$('body').css('overflow','hidden');
$('html').css('overflow','hidden');
$('#loadqueryadd').load('add_query.php?id='+id);
if(id==''){
$('.rnblkquery .card-title').html('Create Query');
} else {
$('.rnblkquery .card-title').html('Edit Query');
}
}

function createqueryclose(){
$('.rnblkquery').hide();
$('body').css('overflow','visible');
$('html').css('overflow','visible');
$('#loadqueryadd').html('Loading...');
}
</script>
<style>
.footerstripboxouter{box-shadow: 0 0 6px rgb(0 0 0 / 20%); background-color:#FFFFFF; position:fixed; left:0px; bottom:0px; width:100%; min-height:28px; z-index:99999;}
.footerstripboxouter .leftar{float:left;}
.footerstripboxouter .righar{float:right;}
.activefootertab{color:#CC3300 !important;background-color:#F9F9F9;}
.footerstripboxouter .righar a{ display:block; float:right; border-left:1px solid #ddd; color:#000; padding:4px 10px; font-size: 11px; line-height: 20px;}
.footerstripboxouter .righar a span { font-weight: 600; text-transform: uppercase; line-height: 14px; }
.footerstripboxouter .righar a:hover{background-color:#F9F9F9;}
.footerpopboxs{position:fixed; right:0px; bottom:0px; width:374px; background-color:#fff;box-shadow: 0 0 6px rgb(0 0 0 / 20%); min-height:488px; border-top-left-radius:10px;border-top-right-radius:10px; overflow:hidden; z-index:9999;}
.footerpopboxsheader { height: 40px; border-bottom: 1px solid #e3e8ee; align-items: center; display: flex; padding: 0 12px; cursor: default; position:relative; font-weight:700; width:100%;}
.footerpopboxsheader .fa-times { position: absolute; right: 12px; font-size: 16px; color: #8a8a8a; cursor:pointer; }
.footerpopboxs .popcontentbodybox{height:418px; overflow:auto;}
.footerpopboxs .popcontentbodybox .loadingboxin{padding:20px; text-align:center; color:#999999; font-size:13px;}
.footerpopboxs .usernotesouter{padding:10px;}
.footerpopboxs .usernotesouter .usernotes { padding: 15px; background-color: #FFED7D; color: #000000; font-size: 14px;line-height: 24px; border-radius: 2px; box-shadow: 1px 2px 2px #00000029; margin-bottom: 10px; padding-bottom: 0px;}
.footerpopboxs .usernotesouter .usernotes .noteareawrite{background-color:transparent; border:0px; outline:0px; min-height:50px; overflow: hidden; padding:0px; color:#000000; font-size:14px; width:100%;}
.footerpopboxs .usernotesouter .usernotes .toolbarfoo{border-top:1px solid #fff; overflow:hidden; padding-bottom:10px;}
.footerpopboxs .usernotesouter .usernotes .toolbarfoo a{padding:5px 10px 0px; color:#000000 !important; font-size:14px; cursor:pointer; display:block; float:left;}

.addnotebookouter{overflow:hidden;}
.addnotebookouter .notebookadd { display: block; color: #000000 !important; float: right; font-size: 22px; padding: 0px 12px; position: absolute; top: 3px; right: 30px; cursor:pointer; }

.footerstripboxouter .leftar a { display: block; float: left; border-left: 1px solid #ddd; color: #000; padding: 4px 10px; font-size: 11px; line-height: 20px; }
.footerstripboxouter .leftar a span { font-weight: 600; text-transform: uppercase; line-height: 14px; }

</style>
 <div style="height:30px;"></div>
 <div class="footerstripboxouter"> 
 <div class="leftar"><a style="cursor:pointer;" title="Online Users" onclick="openfooterpop2('onlineusers','Online Users',this,'online_user','300px','400px','10px','531px');"><i class="fa fa-user" aria-hidden="true"></i> &nbsp;<span>Online Users</span></a></div>
 <div class="righar"><a style="cursor:pointer;"  onclick="openfooterpop('footernotebook','Notebook',this,'user_notebook','374px','488px','0px','531px');" title="Notebook"><i class="fa fa-sticky-note-o" aria-hidden="true"></i> &nbsp;<span>Notebook</span></a>
 
 <a style="cursor:pointer;"  onclick="openfooterpop('footernotebook','Updates',this,'user_news_updates','500px','600px','96px','531px');" title="Notebook"><i class="fa fa-bullhorn" aria-hidden="true"></i> &nbsp;<span>Updates</span></a>
 
 <?php if($LoginUserDetails['theme']==2){ ?>
  <a style="cursor:pointer;" href="display.html?ga=<?php echo $_REQUEST['ga']; ?>&nighttheme=1"   title="Night Theme"><i class="fa fa-moon-o" aria-hidden="true"></i> &nbsp;<span>Night Theme On</span></a>
  <?php } else { ?>
  <a style="cursor:pointer;" href="display.html?ga=<?php echo $_REQUEST['ga']; ?>&nighttheme=2"  title="Night Theme"><i class="fa fa-moon-o" aria-hidden="true"></i> &nbsp;<span>Night Theme Off</span></a>
  <?php } ?>
 </div>
 </div>
 
<div class="footerpopboxs" id="footernotebook" style="display:none;">
<div class="footerpopboxsheader"><span></span> <i class="fa fa-times" aria-hidden="true" onclick="clasefooterpop();"></i></div> 
<div class="popcontentbodybox"></div>
</div>

 <div class="footerpopboxs" id="onlineusers" style="display:none;">
<div class="footerpopboxsheader"><span></span> <i class="fa fa-times" aria-hidden="true" onclick="clasefooterpop();"></i></div> 
<div class="popcontentbodybox2"></div>
</div>
 
<script>
function openfooterpop(id,name,obj,openfile,width,height,right,bodybox){
$('.footerstripboxouter a').removeClass('activefootertab');
$('#'+id).show();
$('#'+id).css('width',width);
$('#'+id).css('min-height',height);
$('.popcontentbodybox').css('height',bodybox);
$('#'+id).css('right',right);

$(obj).addClass('activefootertab');
$('#'+id+' .footerpopboxsheader span').html(name); 
$('.popcontentbodybox').html('<div class="loadingboxin">Wait Please...</div>');
$('.popcontentbodybox').load(openfile+'.php');
}

function clasefooterpop(){
$('.footerpopboxs').hide();
$('.footerstripboxouter a').removeClass('activefootertab');
}



function openfooterpop2(id,name,obj,openfile,width,height,right,bodybox){
$('.footerstripboxouter a').removeClass('activefootertab');
$('#footernotebook').hide();
$('#'+id).show();
$('#'+id).css('width',width);
$('#'+id).css('min-height',height);
$('.popcontentbodybox').css('height',bodybox);
$('#'+id).css('left',right);

$(obj).addClass('activefootertab');
$('#'+id+' .footerpopboxsheader span').html(name); 
$('.popcontentbodybox2').html('<div class="loadingboxin">Wait Please...</div>');
$('.popcontentbodybox2').load(openfile+'.php');
}
</script>

 

 
<?php if($_REQUEST['showcong']==1){ ?>

<script>
window.requestAnimFrame = (function(){
  	  return  window.requestAnimationFrame       ||
	          window.webkitRequestAnimationFrame ||
	          window.mozRequestAnimationFrame    ||
	          function( callback ){
	            window.setTimeout(callback, 1000 / 60);
	          };
	})();

(function(window, document, undefined){
	$(document).ready(function (){
		init();
	});

	var can, ctx, origin = {}, particles = [], G=-0.01, frame=0, 
		dir = ['up', 'left', 'down', 'right'],
		mDir={
			up: [1, 0, 0, 1],
			left: [0, 1, -1, 0],
			down: [-1, 0, 0, -1],
			right: [0, -1, 1, 0]
		},
		colDir={
			up: function(){
				return "rgb("+(255-Math.floor(Math.random()*50))+","+Math.floor(Math.random()*200)+","+Math.floor(Math.random()*50)+")";
			},
			left: function(){
				return "rgb("+(255-Math.floor(Math.random()*50))+","+(255-Math.floor(Math.random()*50))+","+Math.floor(Math.random()*50)+")";
			},
			down: function(){
				return "rgb("+Math.floor(Math.random()*50)+","+Math.floor(Math.random()*200)+","+(255-Math.floor(Math.random()*50))+")";
			},
			right: function(){
				return "rgb("+Math.floor(Math.random()*200)+","+(255-Math.floor(Math.random()*50))+","+Math.floor(Math.random()*50)+")";
			}
		},
		keysDown={
			up: false,
			left: false,
			down: false,
			right: false
		},
		spinSpeed = 3, 
		bounce = 2,
		damping = 0.5,
		diminish = 1, 
		moveSpeed = 6;

	function init(){

		can = document.getElementById('canvas');

		ctx = can.getContext('2d');	

  		ctx.canvas.width  = window.innerWidth;
  		ctx.canvas.height = window.innerHeight;

  		origin.x = ctx.canvas.width/2;
  		origin.y = ctx.canvas.height/2;
  		origin.dX = 0;
  		origin.dY = 0;

		keyListener();

		resizeListener();

		docs();

  		renderLoop();

	}

	

	function keyListener(){
		$(window)
		.on('keydown', function(e){
			var code = e.keyCode || e.which;
			if(code === 87){
				keysDown.up = true;
			}else if(code === 83){
				keysDown.down = true;
			}else if(code === 65){
				keysDown.left = true;
			}else if(code === 68){
				keysDown.right = true;
			}
		})
		.on('keyup', function(e){
			var code = e.keyCode || e.which;
			if(code === 87){
				keysDown.up = false;
			}else if(code === 83){
				keysDown.down = false;
			}else if(code === 65){
				keysDown.left = false;
			}else if(code === 68){
				keysDown.right = false;
			}		
		})
		.on('keypress', function(e){
			var code = e.keyCode || e.which;
			console.log(code)
			if(code === 61){
				spinSpeed++;
			}else if(code === 45){
				spinSpeed--;
			}else if(code === 103){
				G -= 0.01;
			}else if(code === 102){
				G += 0.01;
			}else if(code === 98){
				if(bounce){
					bounce--;
				}else{
					bounce = 2;
				}
			}else if(code === 44){
				diminish*=2;
			}else if(code === 46){
				diminish*=0.5;
			}else if(code === 110){
				if(damping < 1){
					damping += 0.1;
				}
			}else if(code === 109){
				if(damping > 0){
					damping -= 0.1;
				}
			}

		});
	}

	function resizeListener(){
		$(window).on('resize', function(){
			requestAnimFrame(resize);
		});
	}
	function resize(){
  		ctx.canvas.width  = window.innerWidth;
  		ctx.canvas.height = window.innerHeight;
	}

	function docs(){
		var $key = $('.key');
		$('.close', $key).on('click', function(){
			$key.addClass('hide');
		});
		$('.open', $key).on('click', function(){
			$key.removeClass('hide');
		});

		
	}

	function cX(m){
		return m*(Math.random()*0.8 - 0.4);
	}

	function cY(m){
		return m*(Math.random() - 3);
	}

	function d(m1, m2, m3, m4){
		return cX(m1) * Math.cos( spinSpeed*frame*(2*Math.PI/360) )  +  cY(m2) * Math.sin( spinSpeed*frame*(2*Math.PI/360) ) + cX(m3) * Math.sin( spinSpeed*frame*(2*Math.PI/360) )  +  cY(m4) * Math.cos( spinSpeed*frame*(2*Math.PI/360) );
	}

	function newParticle(m, col){
		return {
			x: origin.x,
			y: origin.y,
			w: Math.random()*2 + 1,
			dX: d(m[0], m[0], m[1], m[1]),
			dY: d(m[2], m[2], m[3], m[3]),
			age: 0,
			colour: col,
			dir: '',
			draw: function(){
				ctx.beginPath();
				ctx.arc(this.x - this.w/2, this.y, this.w, 0, Math.PI*2, true);
				ctx.closePath();
				ctx.fillStyle = this.colour;
				ctx.fill();
			}
		};
	}

	function renderLoop(){
		requestAnimFrame(renderLoop); 
		render();
	}


	function render(){
		
		frame+=1;

		ctx.clearRect(0,0,ctx.canvas.width, ctx.canvas.height);

		originMovement();


		catherineWheelDirection();

	}


	function originMovement(){
		if(keysDown.up && keysDown.down){
			origin.dY = 0;
		}else if(keysDown.up){
			origin.dY = -moveSpeed;
		}else if(keysDown.down){
			origin.dY = moveSpeed;
		}else{
			origin.dY = 0;
		}
		if(keysDown.left && keysDown.right){
			origin.dX = 0;
		}else if(keysDown.left){
			origin.dX = -moveSpeed;
		}else if(keysDown.right){
			origin.dX = moveSpeed;
		}else{
			origin.dX = 0;
		}

		origin.x += origin.dX;
		origin.y += origin.dY

		switch(bounce){
			case 2: 
				if(origin.y < 0){
					origin.y = 0;
				}
				if(origin.x < 0){
					origin.x = 0;
				}else if(origin.x > ctx.canvas.width){
					origin.x = ctx.canvas.width;
				}
			case 1:
				if(origin.y > ctx.canvas.height){
					origin.y = ctx.canvas.height;
				}
			default:

				break;

		}


	}

	function catherineWheelDirection(){
		for( var j = 0; j < dir.length; j++){
			particles.push(newParticle(mDir[dir[j]], colDir[dir[j]]()));	
		}

		for( var i = 0; i < particles.length; i++){
			particles[i].draw();

			particles[i].dY -= G;
			particles[i].y += particles[i].dY;
			particles[i].x += particles[i].dX;


			switch(bounce){
				case 2:
					if(particles[i].y < 0){
						particles[i].y = -particles[i].y;
						particles[i].dY = -particles[i].dY * damping;
					}
					var pastX = particles[i].x - ctx.canvas.width;
					if(particles[i].x < 0){
						particles[i].x = -particles[i].x;
						particles[i].dX = -particles[i].dX * damping;
					}else if(pastX > 0){
						particles[i].x = ctx.canvas.width - pastX;	
						particles[i].dX = -particles[i].dX * damping;
					}
				case 1:
					var pastY = particles[i].y - ctx.canvas.height;
					if(pastY > 0){
						particles[i].y = ctx.canvas.height - pastY;	
						particles[i].dY = -particles[i].dY * damping;
					}
				default: 
					break;
			}


			particles[i].w *= (1-(particles[i].age/(diminish*1000)));

			if( particles[i].w < 0.25 ){
				particles.splice(i,1);
			}
			particles[i].age++;
		}	
	}
}(window, document));
</script> 
<?php } ?>



 