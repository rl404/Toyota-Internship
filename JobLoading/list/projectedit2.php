<?php
	ob_start(); 
	include "../db.php";

	if(empty($_POST['showlist'])) $_POST['showlist'] = '0';

	$insertSql = "UPDATE project set projectName='$_POST[projectname]',projectCode='$_POST[projectcode]',showList='$_POST[showlist]'
			WHERE id='$_POST[projectid]'";

	if ($conn->query($insertSql) === TRUE) {
		header("Location: projectlist.php?ok=1");
	}else{
		header("Location: projectlist.php?ok=0");
		// echo "Error: " . $insertSql . "<br>" . $conn->error;
	}
?>