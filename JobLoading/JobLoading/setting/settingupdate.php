<?php
	include "../db.php";
	if(session_id() == '') {
	    session_start();
	}
	
	$insertSql = "UPDATE staff SET 
			noReg='$_POST[noreg]',
			password='$_POST[password]',
			staffName='$_POST[staffname]',
			deptName='$_POST[deptname]',
			deptCode='$_POST[deptcode]',
			sectName='$_POST[sectname]',
			jobTitle='$_POST[jobtitle]',
			jobClass='$_POST[jobclass]'
			WHERE id='$_SESSION[userid]'";

	if ($conn->query($insertSql) === TRUE) {
		header("Location: setting.php");
	}else{
		echo "Error: " . $insertSql . "<br>" . $conn->error;
	}
?>