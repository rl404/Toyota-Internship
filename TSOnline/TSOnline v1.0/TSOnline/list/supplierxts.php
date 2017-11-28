<?php
	include "../db.php";

	$selectSql = "SELECT * FROM ts WHERE suppName='$_POST[supplier]' order by tsNo,rev+0 desc";

	// get different ts
	$ts = array();
	$tsCurrent = "";
	$tsIndex = 0;

	$selectResult = $conn->query($selectSql);
	while($row = mysqli_fetch_assoc($selectResult)) {
		if($row['tsNo'] != $tsCurrent){
			$tsCurrent = $row['tsNo'];
			$ts[$tsIndex][0] = $tsCurrent;

			// get latest rev ts
			$latestTs = 0;
			$tsSql = "SELECT * FROM ts WHERE suppName='$_POST[supplier]' && tsNo='$tsCurrent' order by tsNo,rev+0 desc";
			$tsSqlResult = $conn->query($tsSql);
			while($tsrow = mysqli_fetch_assoc($tsSqlResult)) {
				$ts[$tsIndex][1] = $tsrow['rev'];
				$ts[$tsIndex][2] = $tsrow['reqDate'];
				break;
			}

			// check latest rev
			$revSql = "SELECT * FROM ts_rev WHERE tsNo='$tsCurrent' order by rev+0 desc";
			$revResult = $conn->query($revSql);

			$highestRev = 0;
			$latestRev;
			$latestDate;
			$latestContent = "";
			if($revResult->num_rows > 0){
				while($revrow = mysqli_fetch_assoc($revResult)){			
					if(is_numeric($revrow['rev']) && $revrow['rev'] > $highestRev ){
						$highestRev = $revrow['rev'];
						$ts[$tsIndex][4] = $revrow['issueDate'];
					}
					if($revrow['rev'] == 'DISUSE'){
						$ts[$tsIndex][4] = $revrow['issueDate'];
						$highestRev = -1;
						break;					
					}
					if(preg_match('/EST/',$revrow['rev'])){
						$ts[$tsIndex][4] = $revrow['issueDate'];
						if($highestRev <= 0) $highestRev = -3;
					}
				}
			}else{
				$highestRev = -2;
			}	

			if($highestRev < 0){
				if($highestRev == -1)$ts[$tsIndex][3] = "DISUSE";
				if($highestRev == -2){
					$ts[$tsIndex][3] = "No info";
					$ts[$tsIndex][4] = "-";
				}
				if($highestRev == -3)$ts[$tsIndex][3] = "EST";
			}else{
				$ts[$tsIndex][3] = $highestRev;
			}

			$tsIndex++;
		}
	}
	

	echo "<h2 class='ui header'>
			PT. $_POST[supplier]
		</h2>";
	

	echo "<div id='listxlist'>
		<table class='ui center aligned sortable table'>
			<thead><tr>
				<th>No</th>
				<th>TS Number</th>
				<th>Owned Revision</th>
				<th>Latest Revision</th>
			</tr></thead>";
	$no = 1;
	$selectResult = $conn->query($selectSql);
	if($selectResult->num_rows > 0){
		for($i = 0; $i < count($ts); $i++){
			$tsNo =  $ts[$i][0];
			$tsRev =  $ts[$i][1];
			$tsReqDate = $ts[$i][2];
			$tsLatestRev = $ts[$i][3];
			$tsLatestDate = $ts[$i][4];
			echo "<tr>
					<td>$no</td>
					<td><a href='datats.php?search=$tsNo' target='_blank'>$tsNo</a></td>";
			if($tsRev < $tsLatestRev){
				echo "<td id='existedts'>$tsRev</td>";
			}else{
				echo "<td>$tsRev</td>";
			}	
				echo "<td>$tsLatestRev";				
				echo "</tr>";
			$no++;
		}
	}else{
		echo "<tr>
				<td class='center aligned' colspan=3>0 result :(</td>
			</tr>";
	}
	echo "</table></div>";
?>