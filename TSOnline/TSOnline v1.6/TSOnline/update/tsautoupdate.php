<?php
	include "../db.php";
	
	if(session_id() == '') {
	    session_start();
	}

	// include "../email/send.php";
	
	$date = date_create("$_POST[reqyear]-$_POST[reqmonth]-$_POST[reqday]");
	$date = date_format($date,"Y-m-d");

	for($i=0;$i<count($_POST['tsno']);$i++){

		$tsno = $_POST['tsno'][$i];
		$rev = $_POST['rev'][$i];
		$content = $_POST['content'][$i];
		$insertSql = "INSERT INTO ts_rev (tsNo,rev,content,issueDate,pic) 
					VALUES ('$tsno', '$rev','$content','$date','$_SESSION[usernamets]')";

		if ($conn->query($insertSql) === TRUE) {
			echo "<script type='text/javascript'> document.location = 'tsauto.php?ok=1'; </script>";
		}else{
			echo "<script type='text/javascript'> document.location = 'tsauto.php?ok=0'; </script>";
			// echo "Error: " . $insertSql . "<br>" . $conn->error;
		}
	}

?>