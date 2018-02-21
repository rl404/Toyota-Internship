<?php
	// Connect to db
	include "../db.php";
	
	// Start session if not started yet
	if(session_id() == '') {
	    session_start();
	}

	// Convert format submitted date
	$date = date_create("$_POST[reqdate]");
	$date = date_format($date,"Y-m-d");

	// Loop for every TS
	for($i = 0; $i < count($_POST['inputts']); $i++){		
		
		$tsno = $_POST['inputts'][$i];
		$rev = $_POST['inputrev'][$i];

		$selectSql = "SELECT * FROM TS WHERE suppName='$_POST[suppname]' and tsNo='$tsno' and rev='$rev'";
		$selectResult = $conn->query($selectSql);

		if($selectResult->num_rows > 0){
			$updateSql = "UPDATE TS SET sendDate='$date', sendStatus='1',receiver='$_POST[receiver]' where suppName='$_POST[suppname]' and tsNo='$tsno' and rev='$rev'";

			if ($conn->query($updateSql) === TRUE) {
			
				// If there is error, back to request page
			} else {
				echo "<script type='text/javascript'> document.location = 'deliver.php?ok=0'; </script>";
			    // echo "Error: " . $insertSql . "<br>" . $conn->error;
			}

		}else{
			// Insert query to db
			$insertSql = "INSERT INTO ts (tsNo,rev,suppName, reqDate, sendDate, sendStatus, receiver, pic) 
						VALUES ('$tsno', '$rev', '$_POST[suppname]', '$date', '$date', '1', '$_POST[receiver]', '$_SESSION[usernamets]')";

			if(!empty($_POST['inputts'][$i])){
				if ($conn->query($insertSql) === TRUE) {
				
					// If there is error, back to request page
				} else {
					echo "<script type='text/javascript'> document.location = 'deliver.php?ok=0'; </script>";
				    // echo "Error: " . $insertSql . "<br>" . $conn->error;
				}
			}
		}
	}

	echo "<script type='text/javascript'> document.location = 'deliver.php?ok=1'; </script>";
?>