<?php
	ob_start(); 
	include "../db.php";

	$insertSql = "INSERT INTO project (projectCode,projectName) 
			VALUES ('$_POST[projectcode]','$_POST[projectname]')";

	if ($conn->query($insertSql) === TRUE) {
		header("Location: project.php?ok=1");
	}else{
		header("Location: project.php?ok=0");
		// echo "Error: " . $insertSql . "<br>" . $conn->error;
	}
?>