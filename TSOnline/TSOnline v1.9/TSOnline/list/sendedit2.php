<?php
	include "../db.php";

	$date = date_create("$_POST[reqyear]-$_POST[reqmonth]-$_POST[reqday]");
	$date = date_format($date,"Y-m-d");

	$updateSql = "UPDATE TS SET sendDate='$date',sendStatus='1' where reqId='$_POST[tsid]'";

	if ($conn->query($updateSql) === TRUE) {

	}else{
		// echo "fail";
	}

?>