<?php

$conn = mysqli_connect("localhost","root","","ea_ts");
// $conn = mysqli_connect("intranet","my_db_admin","my_db_admin","aised");

// Check connection
 if (mysqli_connect_errno())
   {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }
?> 