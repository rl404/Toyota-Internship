<?php
	include "../db.php";

	$date = date_create("$_POST[reqyear]-$_POST[reqmonth]-$_POST[reqday]");
	$date = date_format($date,"Y-m-d");
	
	$insertSql = "INSERT INTO ts_rev (tsId,tsNo,rev,content,issueDate) 
					VALUES (' ', '$_POST[tsno]', '$_POST[rev]','$_POST[content]','$date')";

	if ($conn->query($insertSql) === TRUE) {
		header("Location: tsmanual.php");
	}else{
		echo "Error: " . $insertSql . "<br>" . $conn->error;
	}
?>