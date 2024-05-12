<?php 
ob_start();
session_start();  
function db() {
	static $conn;
		if ($conn===NULL){ 
			$servername = "localhost";
			$username = "getflytrip_getflytrip";
			$password = "admin@3214";
			$dbname = "getflytrip_getflytrip";
			$conn = mysqli_connect ($servername, $username, $password, $dbname);
	}
	return $conn;
}
?>