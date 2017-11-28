<?php
	include "../db.php";

	$date = date_create("$_POST[reqyear]-$_POST[reqmonth]-$_POST[reqday]");
	$date = date_format($date,"Y-m-d");

	for($i=0;$i<count($_POST['tsno']);$i++){

		$tsno = $_POST['tsno'][$i];
		$rev = $_POST['rev'][$i];
		$content = $_POST['content'][$i];
		$insertSql = "INSERT INTO ts_rev (tsId,tsNo,rev,content,issueDate) 
					VALUES (' ', '$tsno', '$rev','$content','$date')";

		if ($conn->query($insertSql) === TRUE) {
			header("Location: tsauto.php");
		}else{
			echo "Error: " . $insertSql . "<br>" . $conn->error;
		}
	}

?>