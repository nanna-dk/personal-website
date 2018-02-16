<?php
	$host = "localhost";
	$userName = "root";
	$password = "";
	$dbName = "my_cart";

	// Create database connection
	$conn = mysqli_connect($host, $userName, $password, $dbName);
	
	// Check connection
	if(!$conn)
	{
		die("Connection failed: " . mysqli_connect_error());
	}

?>