<?php
	// Connect to db
	$conn = mysqli_connect("localhost","jobloading_admin","toyota123","job_loading");

	// Check connection
 	if (mysqli_connect_errno()){
	   echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	// Select all dept
	$selectSql = "SELECT * FROM dept order by deptCode";
	
	$selectResult = $conn->query($selectSql);

	$no = 1;
	$dept = array();
	$deptcurr = "";
	$deptindex = 0;

	// Get distinct deptcode and put into array
	while($row = mysqli_fetch_assoc($selectResult)) {		
		if($row['deptCode'] != $deptcurr){
			$deptcurr = $row['deptCode'];
			$dept[$deptindex] = $deptcurr;
			$deptindex++;
		}
	}

	// put into datalist option
	for($i = 0; $i < count($dept); $i++){
		echo "<option value='$dept[$i]'>";
	}
?>