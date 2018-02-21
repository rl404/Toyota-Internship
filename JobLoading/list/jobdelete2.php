<?php
	ob_start(); 
	include "../db.php";

	$deleteSql = "DELETE FROM job where jobName='$_POST[jobname]' and deptCode='$_POST[deptcode]'";

	if ($conn->query($deleteSql) === TRUE) {
		header("Location: joblist.php?ok=2");
	}else{
		header("Location: joblist.php?ok=0");
		// echo "Error: " . $insertSql . "<br>" . $conn->error;
	}
?>