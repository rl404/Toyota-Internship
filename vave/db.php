<?php
	//$conn = mysqli_connect("localhost","root","","ea_ts");
	$conn = mysqli_connect("localhost","vave_admin","toyota123","vave");

	// Check connection
 	if (mysqli_connect_errno()){
   		echo "Failed to connect to MySQL: " . mysqli_connect_error();
   	}
?> 