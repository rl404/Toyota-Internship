<?php
	ob_start(); 
	include "../db.php";

	$insertSql = "DELETE FROM staff WHERE id='$_POST[staffid]'";

	if ($conn->query($insertSql) === TRUE) {
		header("Location: stafflist.php?ok=2");
	}else{
		header("Location: stafflist.php?ok=0");
		// echo "Error: " . $insertSql . "<br>" . $conn->error;
	}
?>