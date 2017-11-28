<?php
	include "db.php";

	$selectSql = "SELECT * FROM user WHERE userName='$_POST[username]' AND password='$_POST[password]'";
	// $selectSql = "SELECT * FROM table_ed_member WHERE id='$_POST[username]' AND pass='$_POST[password]'";
	$selectResult = $conn->query($selectSql);

	if($selectResult->num_rows > 0){
		session_start();
		$_SESSION['usernamets'] = $_POST['username'];
		header("Location: homepage.php");
	}else{	
		// error
		header("Location: index.php?error=1");
	}

?>