<?php
	include "../db.php";

	$selectSql = "SELECT * FROM staff 
					WHERE deptCode='$_SESSION[deptname]'
					order by staffName";

	$memberCount = 0;
	$selectResult = $conn->query($selectSql);
	while($row = mysqli_fetch_assoc($selectResult)) {
		$memberCount++;
	}
	
	echo "<div class='ui grid'>
			<div class='three column row'>
				<div class='column'>";

	$rowMax = ceil($memberCount/3);
	$rowCount = 1;
	$columnCount = 1;
	$selectResult = $conn->query($selectSql);
	while($row = mysqli_fetch_assoc($selectResult)) {
		if($rowCount == 1){
			echo "<form class='ui form'>";
		}

		echo "	<div class='inline field'>
					<div class='ui checkbox'>
						<input type='checkbox' name='membercheck[]'>
						<input type='hidden' name='membername[]' value='$row[staffName]'>
						<label>$row[staffName] - $row[jobTitle]</label>
					</div>
				</div>";
		$rowCount++;

		if($rowCount > $rowMax){
			$rowCount = 1;			
			$columnCount++;
			echo "</form></div>";

			if($columnCount < 4){
				echo "<div class='column'>";
			}
		}
	}

	echo "</div>
		</div>";

?>