<?php
	ob_start(); 
	include "../db.php";

	$_POST['jobdesc'] = str_replace("'", "\'", "$_POST[jobdesc]"); 

	$insertSql = "INSERT INTO job (jobName,deptCode,jobDesc) 
			VALUES ('$_POST[jobname]','$_POST[deptcode]','$_POST[jobdesc]')";

	if ($conn->query($insertSql) === TRUE) {
		header("Location: job.php?ok=1");
	}else{
		header("Location: job.php?ok=0");
		// echo "Error: " . $insertSql . "<br>" . $conn->error;
	}
?>