<?php
	include "../db.php";
	session_start();

	echo "<option value='' disabled selected hidden>Job Name</option>";

	$selectSql = "SELECT * FROM job WHERE deptCode='Common' order by jobName";
	
	$selectResult = $conn->query($selectSql);

	$jobcurr = "";
	
	echo "<optgroup class='centeroption' label='--- COMMON JOB ---'>";
	while($row = mysqli_fetch_assoc($selectResult)) {		
		if($row['jobName'] != $jobcurr){
			$jobcurr = $row['jobName'];

			echo "
				<optgroup label='$row[jobName]'>";

				$selectSql2 = "SELECT * FROM job WHERE jobName='$row[jobName]' and deptCode='Common' order by jobOrder";
	
				$selectResult2 = $conn->query($selectSql2);
				if($selectResult2->num_rows > 0){
					while($row2 = mysqli_fetch_assoc($selectResult2)) {
						echo "<option value='$row[jobName]---$row2[jobDesc]'>$row2[jobDesc]</option>";
					}	
				}else{
					echo "<option value='$row[jobName]---$row2[jobDesc]'>$row[jobName]</option>";
				}
			echo "</optgroup>";
		}
	}
	echo "</optgroup>";

	if($_SESSION['deptname'] != "ED"){
		$selectSql = "SELECT * FROM job WHERE deptCode='$_SESSION[deptname]' order by jobName";
		
		$selectResult = $conn->query($selectSql);

		$jobcurr = "";
		
		echo "<optgroup class='centeroption' label='--- $_SESSION[deptname] JOB ---'>";
		while($row = mysqli_fetch_assoc($selectResult)) {		
			if($row['jobName'] != $jobcurr){
				$jobcurr = $row['jobName'];

				echo "<optgroup label='$row[jobName]'>";

					$selectSql2 = "SELECT * FROM job WHERE jobName='$row[jobName]' and deptCode='$_SESSION[deptname]' order by jobOrder";
		
					$selectResult2 = $conn->query($selectSql2);
					if($selectResult2->num_rows > 0){
						while($row2 = mysqli_fetch_assoc($selectResult2)) {
							echo "<option value='$row[jobName]---$row2[jobDesc]'>$row2[jobDesc]</option>";
						}	
					}else{
						echo "<option value='$row[jobName]---$row2[jobDesc]'>$row[jobName]</option>";
					}	
				echo "</optgroup>";
			}
		}
		echo "</optgroup>";
	}else{
		$selectSql = "SELECT * FROM job WHERE deptCode!='Common' order by deptCode";
		
		$selectResult = $conn->query($selectSql);

		$deptCurrent = "";
		while($row = mysqli_fetch_assoc($selectResult)) {		
			if($row['deptCode'] != $deptCurrent){
				$deptCurrent = $row['deptCode'];

				$jobcurr = "";
		
				echo "<optgroup class='centeroption' label='--- $deptCurrent JOB ---'>";

				$selectSql2 = "SELECT * FROM job WHERE deptCode='$deptCurrent' order by jobName";
				$selectResult2 = $conn->query($selectSql2);
				while($row2 = mysqli_fetch_assoc($selectResult2)) {		
					if($row2['jobName'] != $jobcurr){
						$jobcurr = $row2['jobName'];

						echo "<optgroup label='$row2[jobName]'>";

							$selectSql3 = "SELECT * FROM job WHERE jobName='$row2[jobName]' and deptCode='$deptCurrent' order by jobOrder";
				
							$selectResult3 = $conn->query($selectSql3);
							if($selectResult3->num_rows > 0){
								while($row3 = mysqli_fetch_assoc($selectResult3)) {
									echo "<option value='$row2[jobName]---$row3[jobDesc]'>$row3[jobDesc]</option>";
								}	
							}else{
								echo "<option value='$row2[jobName]---$row3[jobDesc]'>$row2[jobName]</option>";
							}	
						echo "</optgroup>";
					}
				}
				echo "</optgroup>";
			}
		}

		
		
	}
?>