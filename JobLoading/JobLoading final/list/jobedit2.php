<?php
	ob_start(); 
	include "../db.php";

	$_POST['jobdesc'] = str_replace("'", "\'", "$_POST[jobdesc]"); 
	$_POST['jobdesc'] = str_replace("\n", ";", "$_POST[jobdesc]"); 

	$separatedJob = array_filter(explode(";", $_POST['jobdesc']));

	$deleteSql = "DELETE FROM job where jobName='$_POST[jobname]' and deptCode='$_POST[deptcode]'";
	if ($conn->query($deleteSql) === TRUE) {
	}else{
		header("Location: joblist.php?ok=0");
		exit();
		// echo "Error: " . $insertSql . "<br>" . $conn->error;
	}

	$no = 1;
	for($i = 0; $i < count($separatedJob); $i++){

		$separatedJob2 = preg_replace('/\s+/', '', $separatedJob[$i]);
		if(!empty($separatedJob2)){
			$insertSql = "INSERT INTO job (jobName,deptCode,jobOrder,jobDesc) 
					VALUES ('$_POST[jobname]','$_POST[deptcode]','$no','$separatedJob[$i]')";

			if ($conn->query($insertSql) === TRUE) {
				$no++;			
			}else{
				header("Location: joblist.php?ok=0");
				exit();
				// echo "Error: " . $insertSql . "<br>" . $conn->error;
			}
		}
	}
	header("Location: joblist.php?ok=1");
?>