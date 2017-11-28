<?php
	ob_start(); 
	include "db.php";

	$selectSql = "SELECT * FROM staff WHERE (staffName='$_POST[username]' OR noReg='$_POST[username]') AND password='$_POST[password]'";
	
	$selectResult = $conn->query($selectSql);

	if($selectResult->num_rows > 0){

		// define all session variable

		session_start();
		$_SESSION['username'];
		$_SESSION['userid'];
		$_SESSION['title'];
		$_SESSION['deptname'];
		while($row = mysqli_fetch_assoc($selectResult)) {
			$_SESSION['username']= $row['staffName'];
			$_SESSION['userid'] = $row['id'];
			$_SESSION['deptname'] = $row['deptCode'];

			if($row['jobTitle'] == 'Div. Head'){
				$_SESSION['title'] = 4;
			}else if($row['jobTitle'] == 'Dept. Head'){
				$_SESSION['title'] = 3;
			}else if($row['jobTitle'] == 'Sect. Head'){
				$_SESSION['title'] = 2;
			}else{
				$_SESSION['title'] = 1;
			}
			break;
		}

		header("Location: homepage.php");
		
	}else{	
		// if wrong username or password
		header("Location: index.php?error=1");
	}
?>