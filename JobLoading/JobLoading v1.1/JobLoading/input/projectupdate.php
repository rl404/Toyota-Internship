<?php
	include "../db.php";

	$insertSql = "INSERT INTO project (id,projectCode,projectName) 
			VALUES (' ', '$_POST[projectcode]','$_POST[projectname]')";

	if ($conn->query($insertSql) === TRUE) {
		header("Location: project.php");
	}else{
		echo "Error: " . $insertSql . "<br>" . $conn->error;
	}
?>