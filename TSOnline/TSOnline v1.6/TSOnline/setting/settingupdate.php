<?php
	$conn = mysqli_connect("localhost","my_db_admin","my_db_admin","aised");

	// Check connection
 	if (mysqli_connect_errno()){
	   echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	if(session_id() == '') {
	    session_start();
	}	

	ob_start();

	$_POST['staffname'] = strtoupper($_POST['staffname']);

	$insertSql = "UPDATE staff SET 
			noReg='$_POST[noreg]',
			password='$_POST[password]',
			staffName='$_POST[staffname]',
			deptName='$_POST[deptname]',
			deptCode='$_POST[deptcode]',
			sectName='$_POST[sectname]',
			jobTitle='$_POST[jobtitle]',
			email='$_POST[email]'
			WHERE id='$_SESSION[useridts]'";

	if ($conn->query($insertSql) === TRUE) {
		$_SESSION['usernamets'] = $_POST['staffname'];
		$_SESSION['deptname'] = $_POST['deptcode'];


		if($_POST['jobtitle'] == 'Div. Head'){
			$_SESSION['title'] = 4;
		}else if($_POST['jobtitle'] == 'Dept. Head'){
			$_SESSION['title'] = 3;
		}else if($_POST['jobtitle'] == 'Sect. Head'){
			$_SESSION['title'] = 2;
		}else{
			$_SESSION['title'] = 1;
		}
		
		echo "<script type='text/javascript'> document.location = 'setting.php?ok=1'; </script>";
	}else{
		echo "<script type='text/javascript'> document.location = 'setting.php?ok=0'; </script>";
		// echo "Error: " . $insertSql . "<br>" . $conn->error;
	}
?>