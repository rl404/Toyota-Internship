<?php
	session_start();
	include "../db.php";


	for($i = 0; $i < count($_POST['job']); $i++){
		for($j = 1; $j < 32; $j++){
			if(!empty($_POST['jobhour'][$i][$j])){
				$job = $_POST['job'][$i];
				$project = $_POST['projectname'][$i];										
				$jobid = $_POST['jobid'][$i][$j];

				$selectSql = "SELECT * FROM data 
							WHERE staffName='$_SESSION[username]'
							AND id='$jobid'
							AND DAY(jobDate)=$j
							AND MONTH(jobDate)='$_POST[jobmonth]'
							AND YEAR(jobDate)='$_POST[jobyear]'";

				$selectResult = $conn->query($selectSql);
				if($selectResult->num_rows > 0){
					while($row = mysqli_fetch_assoc($selectResult)) {
						$jobhour = $_POST['jobhour'][$i][$j];

						$updateSql = "UPDATE data SET jobHour=$jobhour,jobName='$job',projectCode='$project'
								WHERE id='$jobid'";

						if ($conn->query($updateSql) === TRUE) {
							header("Location: update.php");
						}else{
							echo "Error: " . $updateSql . "<br>" . $conn->error;
						}
					}
				}else{
					$jobhour = $_POST['jobhour'][$i][$j];
					$date = date_create("$_POST[jobyear]-$_POST[jobmonth]-$j");
					$date = date_format($date,"Y-m-d");

					$insertSql = "INSERT INTO data (id,staffName,deptCode,jobName,jobDate,jobHour,projectCode) 
					VALUES ('', '$_SESSION[username]','$_SESSION[deptname]','$job','$date','$jobhour','$project')";

					if ($conn->query($insertSql) === TRUE) {
						header("Location: update.php");
					}else{
						echo "Error: " . $insertSql . "<br>" . $conn->error;
					}
				}

				// echo " $j=".$_POST['jobhour'][$i][$j];
			}
		}
		echo "<br>";
	}


?>