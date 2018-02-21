<?php
	ob_start(); 
	include "../db.php";

	if(empty($_POST['notifyemail'])) $_POST['notifyemail'] = 0;
	
	$insertSql = "UPDATE staff SET 
			noReg='$_POST[noreg]',
			password='$_POST[password]',
			staffName='$_POST[staffname]',
			deptName='$_POST[deptname]',
			deptCode='$_POST[deptcode]',
			sectName='$_POST[sectname]',
			jobTitle='$_POST[jobtitle]',
			email='$_POST[email]',
			notify='$_POST[notifyemail]'
			WHERE id='$_POST[staffid]'";


	if ($conn->query($insertSql) === TRUE) {
		header("Location: stafflist.php?ok=1");
	}else{
		header("Location: stafflist.php?ok=0");
		// echo "Error: " . $insertSql . "<br>" . $conn->error;
	}
?>