<?php
	ob_start(); 
	include "../db.php";

	$insertSql = "DELETE FROM job WHERE id='$_POST[jobid]'";

	if ($conn->query($insertSql) === TRUE) {
		header("Location: joblist.php?ok=2");
	}else{
		header("Location: joblist.php?ok=0");
		// echo "Error: " . $insertSql . "<br>" . $conn->error;
	}
?>