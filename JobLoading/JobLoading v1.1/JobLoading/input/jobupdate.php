<?php
	include "../db.php";

	$insertSql = "INSERT INTO job (id,jobName,deptCode,jobDesc) 
			VALUES (' ','$_POST[jobname]','$_POST[deptcode]','$_POST[jobdesc]')";

	if ($conn->query($insertSql) === TRUE) {
		header("Location: job.php");
	}else{
		echo "Error: " . $insertSql . "<br>" . $conn->error;
	}
?>