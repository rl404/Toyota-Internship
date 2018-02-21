<?php
	//$conn = mysqli_connect("localhost","root","","ea_ts");
	$conn = mysqli_connect("localhost","tsonline_admin","toyota123","ea_ts");

	// Check connection
 	if (mysqli_connect_errno()){
   		echo "Failed to connect to MySQL: " . mysqli_connect_error();
   	}
?> 