<?php
	include "../db.php";	
	include "../function.php";

	if(session_id() == '') {
	    session_start();
	}

	if(empty($_POST['month'])){

		$_POST['month'] = date('m');
		$_POST['year'] = date('Y');

		$day = date('d');
		
		$_POST['week'] = getWeeks("$_POST[year]-$_POST[month]-$day", "sunday");
		
	}

	$maxWeek = weeks($_POST['month'],$_POST['year']);

	echo "<form class='ui form'>		
				<div class='inline fields'>
					<div class='field'>
						<select class='ui search dropdown' id='jobweek'>";

				for($i = 1; $i <= $maxWeek; $i++){
					if($i == $_POST['week']){
						echo "<option value='$i' selected>Week $i</option>";
					}else{
						echo "<option value='$i'>Week $i</option>";
					}
				}

				echo "
						</select>
					</div>
					<label>-</label>
					<div class='field'>
						<select class='ui search dropdown' id='jobmonth'>";
						for($i=1;$i<13;$i++){
							$reqMonth = date("F",mktime(0,0,0,$i,1,2011));
							if($i==$_POST['month']){
								echo "<option value='$i' selected>$reqMonth</option>";
							}else{
								echo "<option value='$i'>$reqMonth</option>";
							}
						}
		echo "			</select>
					</div>
					<label>-</label>
					<div class='field'>
						<input id='jobyear' type='number' name='jobyear' size=5 value='";
		echo 			$_POST['year'];
		echo 			"'>
					</div>
					<div class='field'>
						<img class='ui centered mini image' src='../images/loading.gif' id='ajaxloading' style='display:none;'>
					</div>					
				</div>
			</form>";

	$strwhere = '';
	if($_SESSION['title'] == 4){
		$strwhere = '';
	}else{
		$strwhere = "WHERE deptCode='$_SESSION[deptname]'";
	}
	$selectSql = "SELECT * FROM staff ".$strwhere." order by staffName";

	echo "<table class='ui sortable selectable definition center aligned collapsing table'>
			<thead class='full-width'><tr>
				<th id='tableheader'>No</th>					
				<th id='tableheader'>Staff Name</th>
				<th id='tableheader'>Title</th>";

	$week = 1;
	for($i = 1; $i < 32; $i++){		
		$timestamp = strtotime("$_POST[year]-$_POST[month]-$i");
		$day = date('D', $timestamp);
		
		if($day == 'Sun') $week++;
		if($week == $_POST['week']){
			$i2 = ordinal((int)$i);
			if($day == 'Sun' || $day == 'Sat'){
				echo "<th class='one wide' id='weekendtext'>$i2".'<br>'."$day</th>";
			}else if($i == date('d') && $_POST['month'] == date('m') && $_POST['year'] == date('Y')){
				echo "<th class='one wide' id='todaytext'>Today</th>";
			}else{
				echo "<th class='one wide' id='tableheader'>$i2".'<br>'."$day</th>";
			}
		}
	}
	echo "	<th class='one wide' id='tableheader'>Total Week Hour</th>
		</tr></thead>";

	$no = 1;
	$staffCurrent = '';
	$staffIndex = 0;
	$jobRank = 0;
	$selectResult = $conn->query($selectSql);
	while($row = mysqli_fetch_assoc($selectResult)) {
		if($row['jobTitle'] == 'Dept. Head'){
			$jobRank = 3;
		}else if($row['jobTitle'] == 'Sect. Head'){
			$jobRank = 2;
		}else{
			$jobRank = 1;
		}

		if($jobRank <= $_SESSION['title']){
			if($row['staffName'] != $staffCurrent){
				$staffCurrent = $row['staffName'];

				echo "<tr>
						<td>$no.</td>
						<td class='left aligned'>$row[staffName]</td>
						<td>$row[jobTitle]</td>";

				$week = 1;
				$weekHour = 0;
				for($i = 1; $i < 32; $i++){		
					$timestamp = strtotime("$_POST[year]-$_POST[month]-$i");
					$day = date('D', $timestamp);
					
					if($day == 'Sun') $week++;
					if($week == $_POST['week']){
						$dayHour = 0;
						$selectSql2 = "SELECT * FROM data WHERE staffName='$row[staffName]'
									AND DAY(jobDate)=$i AND MONTH(jobDate)=$_POST[month] AND YEAR(jobDate)=$_POST[year] 
									ORDER By jobHour+0 desc";
						$selectResult2 = $conn->query($selectSql2);

						$job = array();
						$jobIndex = 0;
						if($selectResult2->num_rows > 0){
							while($row2 = mysqli_fetch_assoc($selectResult2)) {
								$job[$jobIndex][0] = $row2['jobName'];
								$job[$jobIndex][1] = $row2['jobHour'];

								$dayHour += $row2['jobHour'];
								$weekHour += $row2['jobHour'];

								$jobIndex++;
							}
						}

						$jobHourDetail = '';
						for($j = 0; $j < $jobIndex; $j++){
							$jobname = $job[$j][0];
							$jobhour = $job[$j][1];

							$jobHourDetail = $jobHourDetail."$jobhour - $jobname <br>"; 
						}

						if($day == 'Sun' || $day == 'Sat'){
							echo "<td id='errortext'>";
						}else if($i == date('d') && $_POST['month'] == date('m') && $_POST['year'] == date('Y')){
							echo "<td id='todaytext2'>";
						}else{
							echo "<td>";
						}
						if($dayHour == 0) $dayHour = "-";
						
						echo "<div class='detailjobview' data-html='$jobHourDetail' data-position='right center'>$dayHour</div></td>";
					}
				}
				echo "<td id='tabletotal'>$weekHour</td>";
				echo "</tr>";
				$no++;
			}
		}
	}

	echo "</table>";

?>