<?php

	if(session_id() == '') {
	    session_start();
	}

	include "db.php";

	// default month and year value
	if(empty($_POST['month'])){
		$_POST['month'] = date('m');
		$_POST['year'] = date('Y');		
	}
		
	$selectSql = "SELECT * FROM data 
					WHERE staffName='$_SESSION[username]'
					AND MONTH(jobDate)='$_POST[month]'
					AND YEAR(jobDate)='$_POST[year]'
					order by projectCode,jobName";

	echo "<table class='ui selectable sortable center aligned table'>
			<thead><tr>
				<th id='tableheader'>Proj. Code</th>
				<th id='tableheader'>Job Name</th>
				<th id='tableheader'>Hours</th>
			</tr></thead>";

	$jobCurrent = '';
	$projectCurrent = '';
	$jobIndex = 0;
	$jobHour = 0;
	$totalHour = 0;

	$selectResult = $conn->query($selectSql);
	if($selectResult->num_rows > 0){
		while($row = mysqli_fetch_assoc($selectResult)) {
			$jobHour = 0;

			// show unique job and project
			if($row['jobName'] != $jobCurrent || $row['projectCode'] != $projectCurrent){
				$jobCurrent = $row['jobName'];
				$projectCurrent = $row['projectCode'];

				$selectSql2 = "SELECT * FROM data 
					WHERE staffName='$_SESSION[username]'
					AND jobName='$jobCurrent'
					AND projectCode='$projectCurrent'
					AND MONTH(jobDate)='$_POST[month]'
					AND YEAR(jobDate)='$_POST[year]'";

				$selectResult2 = $conn->query($selectSql2);
				while($row2 = mysqli_fetch_assoc($selectResult2)) {
					$jobHour += $row2['jobHour'];
					$totalHour += $row2['jobHour'];
				}

				echo "<tr>
						<td>$projectCurrent</td>
						<td class='left aligned'>$jobCurrent</td>
						<td>$jobHour</td>
					</tr>";
			}
		}
		echo "<tfoot><tr>
				<th colspan=2 id='tablefooter'>Total</th>
				<th id='tablefooter'>$totalHour</th>
			</tr></tfoot>";
	}else{
		echo "<tr>
				<td colspan=3>No result :(</td>
			</tr>";
	}
	echo "</table>";
?>