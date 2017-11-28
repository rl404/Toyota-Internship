<?php
	ob_start();
	$conn = mysqli_connect("localhost","my_db_admin","my_db_admin","aised");

	// Check connection
	 if (mysqli_connect_errno())
	   {
	   echo "Failed to connect to MySQL: " . mysqli_connect_error();
	   }

	$selectSql = "SELECT * FROM staff WHERE (staffName='$_POST[username]' OR noReg='$_POST[username]') AND password='$_POST[password]'";
	
	$selectResult = $conn->query($selectSql);

	if($selectResult->num_rows > 0){
		session_start();
		$_SESSION['usernamets'];
		while($row = mysqli_fetch_assoc($selectResult)) {
			$_SESSION['usernamets'] = $row['staffName'];
			break;
		}
		header("Location: homepage.php");
	}else{	
		// error
		header("Location: index.php?error=1");
	}
?>