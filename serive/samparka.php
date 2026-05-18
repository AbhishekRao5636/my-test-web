<?php
	$conn = mysqli_connect('localhost', 'selimx_pro', 'selimx_pro', 'selimx_pro');
	
	if (!$conn) {
		echo "Error: " . mysqli_connect_error();
		exit();
	}
	
	date_default_timezone_set("Asia/Kolkata"); 
?>