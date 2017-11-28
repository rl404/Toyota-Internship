<?php
	include "../db.php";

	$deleteSql = "DELETE FROM data WHERE jobHour='0'";

	if ($conn->query($deleteSql) === TRUE) {		
		echo "<script type='text/javascript'> document.location = 'http://".$_SERVER['HTTP_HOST']."/JobLoading/update/update.php?ok=2'; </script>";
	}else{
		echo "<script type='text/javascript'> document.location = 'http://".$_SERVER['HTTP_HOST']."/JobLoading/update/update.php?ok=-1'; </script>";
		// echo "Error: " . $updateSql . "<br>" . $conn->error;
	}

?>