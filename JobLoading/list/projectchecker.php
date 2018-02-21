<?php
	include "../db.php";

	$selectSql = "SELECT * FROM project WHERE projectCode='$_POST[project]'";

	$selectResult = $conn->query($selectSql);
	if($selectResult->num_rows > 0){
		while($row = mysqli_fetch_assoc($selectResult)) {
			echo "<div class='field'><label id='errortext'>
			*Already in Database with project name: $row[projectName]
			</label></div>";
		}
	}

?>