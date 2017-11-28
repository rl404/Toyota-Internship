<?php
	ob_start(); 
	include "../db.php";

	$_POST['jobdesc'] = str_replace("'", "\'", "$_POST[jobdesc]"); 

	$insertSql = "UPDATE job set jobName='$_POST[jobname]',deptCode='$_POST[deptcode]',jobDesc='$_POST[jobdesc]'
			WHERE id='$_POST[jobid]'";

	if ($conn->query($insertSql) === TRUE) {
		header("Location: joblist.php?ok=1");
	}else{
		header("Location: joblist.php?ok=0");
		// echo "Error: " . $insertSql . "<br>" . $conn->error;
	}
?>