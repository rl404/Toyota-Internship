<?php
	ob_start(); 
	include "../db.php";

	$insertSql = "DELETE FROM dept WHERE id='$_POST[deptid]'";

	if ($conn->query($insertSql) === TRUE) {
		header("Location: deptlist.php?ok=2");
	}else{
		header("Location: deptlist.php?ok=0");
		// echo "Error: " . $insertSql . "<br>" . $conn->error;
	}
?>