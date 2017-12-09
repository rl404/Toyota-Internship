<?php
	include "../db.php";

	$selectSql = "SELECT * FROM dept WHERE showList='1' order by sectName";
	
	$selectResult = $conn->query($selectSql);

	$no = 1;
	$sect = array();
	$sectcurr = "";
	$sectindex = 0;

	while($row = mysqli_fetch_assoc($selectResult)) {		
		if($row['sectName'] != $sectcurr){
			$sectcurr = $row['sectName'];
			$sect[$sectindex] = $sectcurr;
			$sectindex++;
		}
	}

	echo "<option value='Engineering Division'>Engineering Division</option>";
	for($i = 0; $i < count($sect); $i++){
		echo "<option value='$sect[$i]'>$sect[$i]</option>";
	}
?>