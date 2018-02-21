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
		$_SESSION['titlerank'];
		$_SESSION['deptname'];
		$password = '';
		while($row = mysqli_fetch_assoc($selectResult)) {			

			if($row['divCode'] != "ED"){
				session_unset();
				session_destroy(); 
				echo "<script type='text/javascript'> document.location = 'index.php?error=3'; </script>";
				exit;
			} 

			$_SESSION['username']= $row['staffName'];
			$_SESSION['userid'] = $row['id'];
			$_SESSION['deptname'] = $row['deptCode'];
			$password = $row['password'];

			if($row['jobTitle'] == 'Div. Head' || $row['jobTitle'] == 'Admin'){
				$_SESSION['titlerank'] = 4;
			}else if($row['jobTitle'] == 'Dept. Head'){
				$_SESSION['titlerank'] = 3;
			}else if($row['jobTitle'] == 'Sect. Head'){
				$_SESSION['titlerank'] = 2;
			}else{
				$_SESSION['titlerank'] = 1;
			}
			break;
		}

		if($password == "1234"){
			header("Location: homepage.php?ok=0");
		}else{
			header("Location: homepage.php");
		}
		
	}else{	
		// if wrong username or password
		header("Location: index.php?error=1");
	}
?>