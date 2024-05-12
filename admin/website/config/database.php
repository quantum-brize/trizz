<?php 
ob_start();
session_start();  
function db() {
	static $conn;
		if ($conn===NULL){ 
			$servername = "localhost";
			$username = "travbizz_tsbizz";
			$password = "admin@3214";
			$dbname = "travbizz_tsbizz";
			$conn = mysqli_connect ($servername, $username, $password, $dbname);
	}
	return $conn;
}
date_default_timezone_set('Asia/Calcutta');
?>