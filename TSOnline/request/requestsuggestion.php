<?php
	// Connect to db
	include "../db.php";

	// Get different supplier + put into array
	$supp = array();
	$suppCurrent = "";
	$suppIndex = 0;

	$selectSql = "SELECT * FROM ts order by suppName";
	$selectResult = $conn->query($selectSql);
	while($row = mysqli_fetch_assoc($selectResult)) {
		if($row['suppName'] != $suppCurrent){
			$suppCurrent = $row['suppName'];
			$supp[$suppIndex] = $suppCurrent;
			$suppIndex++;
		}
	}

	// Put into datalist option
	for($i = 0; $i < count($supp); $i++){
		echo "<option value='$supp[$i]'></option>";
	}
?>