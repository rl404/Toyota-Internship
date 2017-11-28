<?php
	session_start();
	ob_start(); 
	include "../db.php";	
	include "../function.php";
	
	if(count(array_filter($_POST['job'])) != count(array_filter($_POST['projectname']))){
		header("Location: update.php?ok=-1");
		exit();
	}
	
	for($i = 0; $i < count($_POST['job']); $i++){	

		for($j = 1; $j < 32; $j++){			

			if(notempty($_POST['jobhour'][$i][$j])){
				$job = $_POST['job'][$i];
				$project = $_POST['projectname'][$i];										
				$jobid = $_POST['jobid'][$i][$j];

				if(!notempty($project) || !notempty($job)){
					header("Location: update.php?ok=-1");
					exit();
				}				

				$selectSql = "SELECT * FROM data 
							WHERE staffName='$_SESSION[username]'
							AND jobName='$job'
							AND projectCode='$project'
							AND DAY(jobDate)='$j'
							AND MONTH(jobDate)='$_POST[jobmonth]'
							AND YEAR(jobDate)='$_POST[jobyear]'";

				$selectResult = $conn->query($selectSql);
				if($selectResult->num_rows > 0){
					while($row = mysqli_fetch_assoc($selectResult)) {
						$jobhour = $_POST['jobhour'][$i][$j];
						$jobhour = str_replace(",",".","$jobhour");

						$updateSql = "UPDATE data SET jobHour=$jobhour,jobName='$job',projectCode='$project'
								WHERE id='$row[id]'";

						if ($conn->query($updateSql) === TRUE) {							
						}else{
							header("Location: update.php?ok=-1");
							exit();
							// echo "Error: " . $updateSql . "<br>" . $conn->error;
						}
					}
					header("Location: update.php?ok=1");
				}else{					
					$jobhour = $_POST['jobhour'][$i][$j];
					$jobhour = str_replace(",",".","$jobhour");
					
					$date = date_create("$_POST[jobyear]-$_POST[jobmonth]-$j");
					$date = date_format($date,"Y-m-d");

					$insertSql = "INSERT INTO data (staffName,deptCode,jobName,jobDate,jobHour,projectCode) 
					VALUES ('$_SESSION[username]','$_SESSION[deptname]','$job','$date','$jobhour','$project')";

					if ($conn->query($insertSql) === TRUE) {
						header("Location: update.php?ok=1");
					}else{
						header("Location: update.php?ok=-1");
						exit();
					}
				}

				// echo " $j=".$_POST['jobhour'][$i][$j];
			}
		}
	}


?>