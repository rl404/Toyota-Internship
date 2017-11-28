<?php 
	include "../db.php";

	// separate each line
	$separatedTSRev = array_filter(explode('*', $_POST['tsrev']));

	echo "
		<h3 class='ui header'>TS Revision Checker</h3>
		<table class='ui center aligned celled table'>
			<thead><tr>
				<th>No</th>
				<th>TS No</th>
				<th>Rev.</th>
				<th>Status</th>
			</tr></thead>";
	$no = 1;		
	for($i = count($separatedTSRev)-1; $i >= 0; $i--){
		$alreadyHave = false;
		$parsedTSRev = explode('/', $separatedTSRev[$i]);

		if(count($parsedTSRev)>1){
			if(empty($parsedTSRev[1])) $parsedTSRev[1] = 0;
			// check supplier owned
			$selectSql = "SELECT * FROM ts WHERE suppName='$_POST[supp]' && 
			tsNo='$parsedTSRev[0]' && rev='$parsedTSRev[1]'";
			$selectResult = $conn->query($selectSql);

			if($selectResult->num_rows > 0){
				$alreadyHave = true;
			}

			// check latest rev
			$revSql = "SELECT * FROM ts_rev WHERE tsNo='$parsedTSRev[0]' order by rev desc";
			$revResult = $conn->query($revSql);

			$latestrev = 0;
			$latestDate;
			if($revResult->num_rows > 0){
				while($revrow = mysqli_fetch_assoc($revResult)){					
					if(is_numeric($revrow['rev']) && $revrow['rev'] > $latestrev ){
						$latestrev = $revrow['rev'];
						$latestDate = $revrow['issueDate'];
					}
					if($revrow['rev'] == 'DISUSE'){
						$latestDate = $revrow['issueDate'];
						$latestrev = -1;
						break;					
					}
				}
			}else{
				$latestrev = -2;
			}

			echo "<tr>
					<td>$no</td>
					<td>$parsedTSRev[0]</td>
					<td>$parsedTSRev[1]</td>";

			if($alreadyHave){
				echo "<td id='existedts'>Already have</td>";
			}else{			
				if($latestrev == -2){
					echo "<td id='okts'>OK</td>";
				}else if($latestrev == -1){
					echo "<td id='existedts'>TS is already DISUSE</td>";
				}else if($latestrev > $parsedTSRev[1] || $latestrev < $parsedTSRev[1]){
					echo "<td id='existedts'>Latest rev is $latestrev ($latestDate)</td>";
				}else {
					echo "<td id='okts'>OK</td>";
				}
			}				
			echo "</tr>";
			$no++;
		}
		
	}
	echo "</table>";
?>