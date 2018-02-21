<?php
	ob_start();
	$conn = mysqli_connect("localhost","jobloading_admin","toyota123","job_loading");

	// Check connection
	 if (mysqli_connect_errno())
	   {
	   echo "Failed to connect to MySQL: " . mysqli_connect_error();
	   }

	// Check matching username & password
	$selectSql = "SELECT * FROM staff WHERE (staffName='$_POST[username]' OR noReg='$_POST[username]') AND password='$_POST[password]'";
	
	$selectResult = $conn->query($selectSql);

	if($selectResult->num_rows > 0){

		// Start session + declare all session variable
		session_start();
		$_SESSION['usernamets'];
		$_SESSION['useridts'];
		$_SESSION['deptnamets'];
		while($row = mysqli_fetch_assoc($selectResult)) {

			if($row['divCode'] != "ED"){
				session_unset();
				session_destroy(); 
				echo "<script type='text/javascript'> document.location = 'index.php?error=3'; </script>";
				exit;
			} 
			
			$_SESSION['usernamets'] = $row['staffName'];
			$_SESSION['useridts'] = $row['id'];
			$_SESSION['deptnamets'] = $row['deptCode'];
			break;
		}

		// Redirect to homepage
		header("Location: homepage.php");
	}else{	
		
		// Wrong username or password
		header("Location: index.php?error=1");
	}
?>