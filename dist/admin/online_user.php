<?php
include "inc.php"; 
 
?>	 <style>
							.statusboxed{
							width: 12px !important;
							height: 12px !important;
							border-radius: 100%;
						 }
						 </style>
 
  <div style="height:320px; overflow:auto; padding:10px;" id="loadliveusers"></div>
  
  <script>
						window.setInterval(function(){
						loadliveusers();
						}, 10000);
						
						function loadliveusers(){
						$('#loadliveusers').load('loadliveusers.php');
						}
						
						loadliveusers();
						</script>
 