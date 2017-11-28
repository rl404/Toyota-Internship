<?php

	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=JobReport$_POST[year]-$_POST[month].xls");

	echo "<b>JOB REPORT</b><br>";
	echo "<b>Month:</b> $_POST[month]<br>";
	echo "<b>Year:</b> $_POST[year]<br><br>";

	include "../db.php";	
	include "../function.php";

	$selectSql = "SELECT * FROM data WHERE MONTH(jobDate)=$_POST[month] 
				AND YEAR(jobDate)=$_POST[year]
				order by jobName";

	echo "<table border=1>
			<thead><tr>
				<th>No</th>
				<th>Job Name</th>
				<th>Member Name</th>
				<th>Dept.</th>
				<th>Hours</th>
			</tr></thead>";

	$jobCurrent = '';
	$no = 1;

	$selectResult = $conn->query($selectSql);
	while($row = mysqli_fetch_assoc($selectResult)) {
		$jobHour = 0;
		if($row['jobName'] != $jobCurrent){
			$jobCurrent = $row['jobName'];

			$selectSql2 = "SELECT * FROM data WHERE MONTH(jobDate)=$_POST[month] 
			AND YEAR(jobDate)=$_POST[year] AND jobName='$jobCurrent' 
			order by staffName";

			$staffCurrent = '';			

			$selectResult2 = $conn->query($selectSql2);
			while($row2 = mysqli_fetch_assoc($selectResult2)) {
				
				$jobHour = 0;
				if($staffCurrent != $row2['staffName']){
					$staffCurrent = $row2['staffName'];

					echo "<tr style='vertical-align:middle;'>
							<td style='text-align:center;'>$no.</td>
							<td>$jobCurrent</td>
							<td>$staffCurrent</td>
							<td style='text-align:center;'>$row2[deptCode]</td>";

					$selectSql3 = "SELECT * FROM data 
						WHERE MONTH(jobDate)=$_POST[month] 
						AND YEAR(jobDate)=$_POST[year]
						AND staffName='$staffCurrent'
						AND jobName='$jobCurrent'";

					$selectResult3 = $conn->query($selectSql3);
					while($row3 = mysqli_fetch_assoc($selectResult3)) {
						$jobHour += $row3['jobHour'];
						$totalHour += $row3['jobHour'];
					}

					echo "	<td style='text-align:center;'>$jobHour</td>
						</tr>";
					$no++;
				}
			}					
		}
	}
	
	echo "</table><br>";

	echo "<i>*Generated by Job Loading System.</i>";

?>