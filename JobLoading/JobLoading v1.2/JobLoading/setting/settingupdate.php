<?php
	include "../db.php";
	ob_start();
	if(session_id() == '') {
	    session_start();
	}
	
	$_POST['staffname'] = strtoupper($_POST['staffname']);
	
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
		$_SESSION['username'] = $_POST['staffname'];
		$_SESSION['deptname'] = $_POST['deptCode'];

		if($_POST['jobtitle'] == 'Dept. Head'){
			$_SESSION['title'] = 3;
		}else if($_POST['jobtitle'] == 'Sect. Head'){
			$_SESSION['title'] = 2;
		}else{
			$_SESSION['title'] = 1;
		}

		header("Location: setting.php");
	}else{
		echo "Error: " . $insertSql . "<br>" . $conn->error;
	}
?>