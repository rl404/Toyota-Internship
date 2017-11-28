<?php
	include "../db.php";
	
	$selectSql = "SELECT * FROM ts_rev WHERE (tsNo LIKE '%$_POST[ts]%') order by tsNo";
	$selectResult = $conn->query($selectSql);

	$no = 1;
	$ts = array();
	$tscurr = "";
	$tsindex = 0;

	while($row = mysqli_fetch_assoc($selectResult)) {
		if($row['tsNo'] != $tscurr){
			$tscurr = $row['tsNo'];
			$ts[$tsindex] = $tscurr;
			$tsindex++;
		}
	}

	for($i = 0; $i < count($ts); $i++){
		echo "<option value='$ts[$i]'>";
	}
?>