<?php
	ob_start(); 
	include "../db.php";

	$insertSql = "INSERT INTO dept (deptName,deptCode,sectName) 
			VALUES ('$_POST[deptname]','$_POST[deptcode]','$_POST[sectname]')";

	if ($conn->query($insertSql) === TRUE) {
		header("Location: dept.php?ok=1");
	}else{
		header("Location: dept.php?ok=0");
		// echo "Error: " . $insertSql . "<br>" . $conn->error;
	}
?>