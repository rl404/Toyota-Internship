<?php
	$conn = mysqli_connect("localhost","my_db_admin","my_db_admin","aised");

	// Check connection
 	if (mysqli_connect_errno()){
	   echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	$selectSql = "SELECT * FROM dept order by deptCode";
	
	$selectResult = $conn->query($selectSql);

	$no = 1;
	$dept = array();
	$deptcurr = "";
	$deptindex = 0;

	while($row = mysqli_fetch_assoc($selectResult)) {		
		if($row['deptCode'] != $deptcurr){
			$deptcurr = $row['deptCode'];
			$dept[$deptindex] = $deptcurr;
			$deptindex++;
		}
	}

	for($i = 0; $i < count($dept); $i++){
		echo "<option value='$dept[$i]'>";
	}
?>