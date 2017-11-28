<?php

//$conn = mysqli_connect("localhost","root","","ea_ts");
$conn = mysqli_connect("localhost","lodeh_admin","lodeh_admin","lodeh");

// Check connection
 if (mysqli_connect_errno())
   {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }
?> 