<?php
	include "../db.php";
	session_start();

	$selectSql = "SELECT * FROM job WHERE deptCode='$_SESSION[deptname]' order by jobName";
	
	$selectResult = $conn->query($selectSql);

	$no = 1;
	$job = array();
	$jobcurr = "";
	$jobindex = 0;

	while($row = mysqli_fetch_assoc($selectResult)) {		
		if($row['jobName'] != $jobcurr){
			$jobcurr = $row['jobName'];
			$job[$jobindex][0] = $row['jobName'];
			$job[$jobindex][1] = $row['jobDesc'];
			$jobindex++;
		}
	}

	echo "<option value=''>Job Name</option>";
	for($i = 0; $i < count($job); $i++){
		$jobname = $job[$i][0];
		$jobdesc = $job[$i][1];

		echo "<option value='$jobname'>$jobname</option>";
	}
?>