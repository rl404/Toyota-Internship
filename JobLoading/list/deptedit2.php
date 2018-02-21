<?php
	ob_start(); 
	include "../db.php";

	if(empty($_POST['showlist'])) $_POST['showlist'] = '0';

	$insertSql = "UPDATE dept set deptName='$_POST[deptname]',deptCode='$_POST[deptcode]',sectName='$_POST[sectname]',showList='$_POST[showlist]'
			WHERE id='$_POST[deptid]'";

	if ($conn->query($insertSql) === TRUE) {
		header("Location: deptlist.php?ok=1");
	}else{
		header("Location: deptlist.php?ok=0");
		// echo "Error: " . $insertSql . "<br>" . $conn->error;
	}
?>