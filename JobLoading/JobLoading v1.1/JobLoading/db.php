<?php

$conn = mysqli_connect("localhost","root","","job_loading");

// Check connection
 if (mysqli_connect_errno())
   {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }

  set_time_limit(0);
?> 