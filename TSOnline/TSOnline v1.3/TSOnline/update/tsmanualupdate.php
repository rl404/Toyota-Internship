<?php
	include "../db.php";

	ob_start();
	
	$date = date_create("$_POST[reqyear]-$_POST[reqmonth]-$_POST[reqday]");
	$date = date_format($date,"Y-m-d");
	
	$insertSql = "INSERT INTO ts_rev (tsNo,rev,content,issueDate) 
					VALUES ('$_POST[tsno]', '$_POST[rev]','$_POST[content]','$date')";

	if ($conn->query($insertSql) === TRUE) {
		echo "<script type='text/javascript'> document.location = 'tsmanual.php'; </script>";
		
	}else{
		echo "Error: " . $insertSql . "<br>" . $conn->error;
	}
?>