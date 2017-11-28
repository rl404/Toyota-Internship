<?php
	include "../db.php";
	
	if(session_id() == '') {
	    session_start();
	}

	// format submitted date
	$date = date_create("$_POST[reqyear]-$_POST[reqmonth]-$_POST[reqday]");
	$date = date_format($date,"Y-m-d");

	for($i = 0; $i < count($_POST['inputts']); $i++){		
		
		$tsno = $_POST['inputts'][$i];
		$rev = $_POST['inputrev'][$i];
		$model = $_POST['inputmodel'][$i];
		$part = $_POST['inputpart'][$i];

		// echo $tsno.$rev.$model.$part."<br>";

		$insertSql = "INSERT INTO ts (tsNo,rev,suppName,model,partNo,reqDate,pic) 
					VALUES ('$tsno', '$rev', '$_POST[suppname]', '$model', '$part', '$date', '$_SESSION[usernamets]')";

		if(!empty($_POST['inputts'][$i])){
			if ($conn->query($insertSql) === TRUE) {
			} else {
				echo "<script type='text/javascript'> document.location = 'request.php?ok=0'; </script>";
			    echo "Error: " . $insertSql . "<br>" . $conn->error;
			}
		}
	}

	echo "<script type='text/javascript'> document.location = 'request.php?ok=1'; </script>";
?>