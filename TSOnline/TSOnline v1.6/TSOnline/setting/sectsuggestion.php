<?php
	$conn = mysqli_connect("localhost","my_db_admin","my_db_admin","aised");

	// Check connection
 	if (mysqli_connect_errno()){
	   echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	$selectSql = "SELECT * FROM dept order by sectName";
	
	$selectResult = $conn->query($selectSql);

	$no = 1;
	$sect = array();
	$sectcurr = "";
	$sectindex = 0;

	while($row = mysqli_fetch_assoc($selectResult)) {		
		if($row['sectName'] != $sectcurr){
			$sectcurr = $row['sectName'];
			$sect[$sectindex] = $sectcurr;
			$sectindex++;
		}
	}

	for($i = 0; $i < count($sect); $i++){
		echo "<option value='$sect[$i]'>";
	}
?>