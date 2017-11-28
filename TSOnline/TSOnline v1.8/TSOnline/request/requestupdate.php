<?php
	// Connect to db
	include "../db.php";
	
	// Start session if not started yet
	if(session_id() == '') {
	    session_start();
	}

	// Convert format submitted date
	$date = date_create("$_POST[reqyear]-$_POST[reqmonth]-$_POST[reqday]");
	$date = date_format($date,"Y-m-d");

	// Loop for every TS
	for($i = 0; $i < count($_POST['inputts']); $i++){		
		
		$tsno = $_POST['inputts'][$i];
		$rev = $_POST['inputrev'][$i];
		$model = $_POST['inputmodel'][$i];
		$part = $_POST['inputpart'][$i];

		// Insert query to db
		$insertSql = "INSERT INTO ts (tsNo,rev,suppName,model,partNo,reqDate,pic) 
					VALUES ('$tsno', '$rev', '$_POST[suppname]', '$model', '$part', '$date', '$_SESSION[usernamets]')";

		if(!empty($_POST['inputts'][$i])){
			if ($conn->query($insertSql) === TRUE) {
			
				// If there is error, back to request page
			} else {
				echo "<script type='text/javascript'> document.location = 'request.php?ok=0'; </script>";
			    echo "Error: " . $insertSql . "<br>" . $conn->error;
			}
		}
	}

	echo "<script type='text/javascript'> document.location = 'request.php?ok=1'; </script>";
?>