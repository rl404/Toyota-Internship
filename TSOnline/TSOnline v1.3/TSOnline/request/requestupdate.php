<?php
	include "../db.php";

	// format submitted date
	$date = date_create("$_POST[reqyear]-$_POST[reqmonth]-$_POST[reqday]");
	$date = date_format($date,"Y-m-d");

	for($i = 0; $i < count($_POST['inputts']); $i++){

		if(empty($_POST['inputts'][$i])) $i++;
		
		$tsno = $_POST['inputts'][$i];
		$rev = $_POST['inputrev'][$i];
		$model = $_POST['inputmodel'][$i];
		$part = $_POST['inputpart'][$i];

		// echo $tsno.$rev.$model.$part."<br>";

		$insertSql = "INSERT INTO ts (tsNo,rev,suppName,model,partNo,reqDate) 
					VALUES ('$tsno', '$rev', '$_POST[suppname]', '$model', '$part', '$date')";

		if ($conn->query($insertSql) === TRUE) {
		} else {
		    echo "Error: " . $insertSql . "<br>" . $conn->error;
		}
	}

	echo "<script type='text/javascript'> document.location = 'request.php'; </script>";
?>