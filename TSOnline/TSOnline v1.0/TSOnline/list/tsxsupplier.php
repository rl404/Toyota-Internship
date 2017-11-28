<?php
	include "../db.php";

	$selectSql = "SELECT * FROM ts WHERE tsNo='$_POST[ts]' order by suppName";

	// get different supplier
	$supp = array();
	$suppCurrent = "";
	$suppIndex=0;

	$selectResult = $conn->query($selectSql);
	while($row = mysqli_fetch_assoc($selectResult)) {
		if($row['suppName'] != $suppCurrent){
			$suppCurrent = $row['suppName'];
			$supp[$suppIndex][0] = $suppCurrent;

			// get latest rev supplier
			$suppSql = "SELECT * FROM ts WHERE suppName='$suppCurrent' AND tsNo='$_POST[ts]' order by suppName,rev+0 desc";
			$suppSqlResult = $conn->query($suppSql);
			while($supprow = mysqli_fetch_assoc($suppSqlResult)) {
				$supp[$suppIndex][1] = $supprow['rev'];
				$supp[$suppIndex][2] = $supprow['reqDate'];
				break;
			}

			$suppIndex++;
		}
	}


	// check latest rev
	$revSql = "SELECT * FROM ts_rev WHERE tsNo='$_POST[ts]' order by rev+0 desc";
	$revResult = $conn->query($revSql);

	$highestRev = 0;
	$latestRev;
	$latestDate;
	$latestContent = "";
	if($revResult->num_rows > 0){
		while($revrow = mysqli_fetch_assoc($revResult)){			
			if(is_numeric($revrow['rev']) && $revrow['rev'] > $highestRev ){
				$highestRev = $revrow['rev'];
				$latestDate = $revrow['issueDate'];
				$latestContent = $revrow['content'];
			}
			if($revrow['rev'] == 'DISUSE'){
				$latestDate = $revrow['issueDate'];
				$latestContent = $revrow['content'];
				$highestRev = -1;
				break;					
			}
			if(preg_match('/EST/',$revrow['rev'])){
				$latestDate = $revrow['issueDate'];
				if($highestRev <= 0) $highestRev = -3;
			}
		}
	}else{
		$highestRev = -2;
	}	

	if($highestRev < 0){
		if($highestRev == -1)$latestRev = "DISUSE";
		if($highestRev == -2){
			$latestRev = "No info";
			$latestDate = "-";
			$latestContent = "-";
		}
		if($highestRev == -3)$latestRev = "EST";
	}else{
		$latestRev = $highestRev;
	}

	echo "<h2 class='ui header'>
			$_POST[ts]
			<div class='sub header'>
				Latest revision: $latestRev ($latestDate)				
			</div>
			<div class='sub header'>
				Content: $latestContent
			</div>
		</h2>";
	

	echo "<div id='listxlist'>
		<table class='ui center aligned sortable table'>
			<thead><tr>
				<th>No</th>
				<th>Supplier Name</th>
				<th>Owned Revision</th>
				<th>Request Date</th>
			</tr></thead>";
	$no = 1;
	$selectResult = $conn->query($selectSql);
	if($selectResult->num_rows > 0){
		for($i = 0; $i < count($supp); $i++){
			$suppName =  $supp[$i][0];
			$suppRev =  $supp[$i][1];
			$suppDate = $supp[$i][2];
			echo "<tr>
					<td>$no</td>
					<td class='left aligned'><a href='datasupplier.php?search=$suppName' target='_blank'>PT. $suppName</a></td>";
			if($suppRev < $latestRev){
				echo "<td id='existedts'>$suppRev</td>";
			}else{
				echo "<td>$suppRev</td>";
			}					
				echo "<td>$suppDate</td>
					</tr>";
			$no++;
		}
	}else{
		echo "<tr>
				<td class='center aligned' colspan=3>0 result :(</td>
			</tr>";
	}
	echo "</table></div>";
?>