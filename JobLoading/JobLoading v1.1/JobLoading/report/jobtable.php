<?php
	include "../db.php";
	include "../function.php";

	function compareOrder($a, $b){return $b[1] - $a[1];}

	if(session_id() == '') {
	    session_start();
	}

	$whereSql = " ";
	if(empty($_POST['month'])){

		$_POST['month'] = date('m');
		$_POST['year'] = date('Y');

		$_POST['job'] = '';
		
	}

	if(!notempty($_POST['job']) || $_POST['job'] == 'All'){
		$whereSql = '';
		$selectSql = "SELECT * FROM data WHERE MONTH(jobDate)=$_POST[month] 
				AND YEAR(jobDate)=$_POST[year]".$whereSql." 
				order by jobName,staffName";

		echo "<div id='reportgraph'></div>";

		echo "<table class='ui selectable sortable center aligned table'>
				<thead><tr>
					<th id='tableheader'>Job Name</th>
					<th id='tableheader'>Hours</th>
				</tr></thead>";

		$jobCurrent = '';
		$jobHour = 0;
		$totalHour = 0;
		$job = array();
		$jobIndex = 0;

		$selectResult = $conn->query($selectSql);
		if($selectResult->num_rows > 0){
			while($row = mysqli_fetch_assoc($selectResult)) {
				$jobHour = 0;
				if($row['jobName'] != $jobCurrent){
					$jobCurrent = $row['jobName'];
					$job[$jobIndex][0] = $jobCurrent;

					$selectSql2 = "SELECT * FROM data 
						WHERE MONTH(jobDate)=$_POST[month] 
						AND YEAR(jobDate)=$_POST[year]
						AND jobName='$jobCurrent'";

					$selectResult2 = $conn->query($selectSql2);
					while($row2 = mysqli_fetch_assoc($selectResult2)) {
						$jobHour += $row2['jobHour'];
						$totalHour += $row2['jobHour'];
					}

					$job[$jobIndex][1] = $jobHour;
					$jobIndex++;
				}
			}

			usort($job, 'compareOrder');

			for($i = 0; $i < $jobIndex; $i++){
				$jobName = $job[$i][0];
				$jobHour = number_format((float)$job[$i][1], 1, '.', '');
				echo "<tr>
						<td class='left aligned'>$jobName</td>
						<td>$jobHour</td>
					</tr>";
			}
			echo "<tfoot><tr>
					<th id='tablefooter'>Total</th>
					<th id='tablefooter'>$totalHour</th>
				</tr></tfoot>";
		}else{
			echo "<tr>
					<td colspan=2>No result :(</td>
				</tr>";
		}
		echo "</table>";

		include "jobgraph.php";

	}else{
		$whereSql = " AND jobName='$_POST[job]' ";
		$selectSql = "SELECT * FROM data WHERE MONTH(jobDate)=$_POST[month] 
				AND YEAR(jobDate)=$_POST[year]".$whereSql." 
				order by jobName,staffName";

		echo "<div id='reportgraph'></div>";

		echo "<table class='ui selectable sortable center aligned table'>
				<thead><tr>
					<th id='tableheader'>Dept. Code</th>
					<th id='tableheader'>Staff Name</th>
					<th id='tableheader'>Hours</th>
				</tr></thead>";

		$jobCurrent = '';
		$staffCurrent = '';
		$jobHour = 0;
		$totalHour = 0;
		$staff = array();
		$staffIndex = 0;

		$selectResult = $conn->query($selectSql);
		if($selectResult->num_rows > 0){
			while($row = mysqli_fetch_assoc($selectResult)) {
				$jobHour = 0;
				if($row['jobName'] != $jobCurrent || $row['staffName'] != $staffCurrent){
					$jobCurrent = $row['jobName'];
					$staffCurrent = $row['staffName'];
					$staff[$staffIndex][0] = $staffCurrent;

					// count job hour
					$selectSql2 = "SELECT * FROM data 
						WHERE MONTH(jobDate)=$_POST[month] 
						AND YEAR(jobDate)=$_POST[year]
						AND staffName='$staffCurrent'
						AND jobName='$jobCurrent'";

					$selectResult2 = $conn->query($selectSql2);
					while($row2 = mysqli_fetch_assoc($selectResult2)) {
						$jobHour += $row2['jobHour'];
						$totalHour += $row2['jobHour'];
					}

					$jobHour = number_format((float)$jobHour, 1, '.', '');
					$staff[$staffIndex][1] = $jobHour;

					echo "<tr>
							<td>$row[deptCode]</td>
							<td class='left aligned'>$staffCurrent</td>
							<td>$jobHour</td>
						</tr>";
					$staffIndex++;
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

		include "jobgraph2.php";
	}
?>