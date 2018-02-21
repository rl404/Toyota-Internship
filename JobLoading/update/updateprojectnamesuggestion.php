<?php
	include "../db.php";

	$selectSql = "SELECT * FROM project WHERE showList='1' order by projectCode";
	
	$selectResult = $conn->query($selectSql);

	$no = 1;
	$project = array();
	$projectcurr = "";
	$projectindex = 0;

	while($row = mysqli_fetch_assoc($selectResult)) {		
		if($row['projectCode'] != $projectcurr){
			$projectcurr = $row['projectCode'];
			$project[$projectindex][0] = $row['projectCode'];
			$project[$projectindex][1] = $row['projectName'];
			$projectindex++;
		}
	}

	echo "<option value='' disabled hidden selected>Project</option>";
	for($i = 0; $i < count($project); $i++){
		$projcode = $project[$i][0];
		$projname = $project[$i][1];
		echo "<option value='$projcode'>$projcode - $projname</option>";
	}
?>