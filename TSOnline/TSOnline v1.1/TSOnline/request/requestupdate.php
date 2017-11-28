<?php
	include "../db.php";
	ob_start();
	// separate each line
	$separatedTSRev = array_filter(explode(PHP_EOL, $_POST['tsnorev']));

	// format submitted date
	$date = date_create("$_POST[reqyear]-$_POST[reqmonth]-$_POST[reqday]");
	$date = date_format($date,"Y-m-d");

	for($i = 0; $i < count($separatedTSRev); $i++){
		$parsedTSRev = explode('/', $separatedTSRev[$i]);

		$insertSql = "INSERT INTO ts (tsNo,rev,suppName,reqDate) 
					VALUES ('$parsedTSRev[0]', '$parsedTSRev[1]', '$_POST[suppname]', '$date')";

		if ($conn->query($insertSql) === TRUE) {
		} else {
		    echo "Error: " . $insertSql . "<br>" . $conn->error;
		}
	}

	echo "<script type='text/javascript'> document.location = 'request.php'; </script>";
?>