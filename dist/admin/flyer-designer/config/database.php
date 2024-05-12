<?php 
ob_start();
session_start();  
function db() {
	static $conn;
		if ($conn===NULL){ 
			$servername = "localhost";
			$username = "webfr9ps_flyerdesigner";
			$password = "admin@3214";
			$dbname = "webfr9ps_flyerdesigner";
			$conn = mysqli_connect ($servername, $username, $password, $dbname);
	}
	return $conn;
}
date_default_timezone_set('Asia/Calcutta');
?>