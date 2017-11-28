<?php
	include "../db.php";

	$selectSql = "SELECT * FROM staff order by jobTitle";
	
	$selectResult = $conn->query($selectSql);

	$no = 1;
	$title = array();
	$titlecurr = "";
	$titleindex = 0;

	while($row = mysqli_fetch_assoc($selectResult)) {		
		if($row['jobTitle'] != $titlecurr){
			$titlecurr = $row['jobTitle'];
			$title[$titleindex] = $titlecurr;
			$titleindex++;
		}
	}

	for($i = 0; $i < count($title); $i++){
		echo "<option value='$title[$i]'>";
	}
?>