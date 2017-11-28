<?php
	include "../db.php";

	$selectSql = "SELECT * FROM dept WHERE showList='1' order by deptCode";
	
	$selectResult = $conn->query($selectSql);

	$no = 1;
	$dept = array();
	$deptcurr = "";
	$deptindex = 0;

	while($row = mysqli_fetch_assoc($selectResult)) {		
		if($row['deptCode'] != $deptcurr){
			$deptcurr = $row['deptCode'];
			$dept[$deptindex] = $deptcurr;
			$deptindex++;
		}
	}

	echo "<option value=''></option>";
	for($i = 0; $i < count($dept); $i++){
		echo "<option value='$dept[$i]'>$dept[$i]</option>";
	}
?>