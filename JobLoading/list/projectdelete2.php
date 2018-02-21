<?php
	ob_start(); 
	include "../db.php";

	$insertSql = "DELETE FROM project WHERE id='$_POST[projectid]'";

	if ($conn->query($insertSql) === TRUE) {
		header("Location: projectlist.php?ok=2");
	}else{
		header("Location: projectlist.php?ok=0");
		// echo "Error: " . $insertSql . "<br>" . $conn->error;
	}
?>