<?php
	include "../db.php";

	$insertSql = "INSERT INTO dept (id,deptName,deptCode,sectName) 
			VALUES (' ','$_POST[deptname]','$_POST[deptcode]','$_POST[sectname]')";

	if ($conn->query($insertSql) === TRUE) {
		header("Location: dept.php");
	}else{
		echo "Error: " . $insertSql . "<br>" . $conn->error;
	}
?>