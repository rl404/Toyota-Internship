<?php
	ob_start(); 
	include "../db.php";

	$insertSql = "INSERT INTO staff (noReg,password,staffName,deptName,deptCode,sectName,jobTitle,jobClass) 
			VALUES ('$_POST[noreg]','$_POST[password]','$_POST[staffname]','$_POST[deptname]',
			'$_POST[deptcode]','$_POST[sectname]','$_POST[jobtitle]','$_POST[jobclass]')";

	if ($conn->query($insertSql) === TRUE) {
		header("Location: staff.php");
	}else{
		echo "Error: " . $insertSql . "<br>" . $conn->error;
	}
?>