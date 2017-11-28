<?php 
	include "../db.php";

	echo "
		<h3 class='ui header'>TS Revision Checker</h3>
		<table class='ui center aligned celled table'>
			<thead><tr>
				<th id='tableheader'>No</th>
				<th id='tableheader'>TS No</th>
				<th id='tableheader'>Rev.</th>
				<th id='tableheader'>Status</th>
			</tr></thead>";

	$no = 1;		
	for($i = 0; $i < count($_POST['ts']); $i++){
		$alreadyHave = false;

		if(!empty($_POST['ts'][$i])){
		if(empty($_POST['rev'][$i])) $_POST['rev'][$i] = 0;

		// check supplier owned
		$tsno = $_POST['ts'][$i];
		$tsrev = $_POST['rev'][$i];
		$selectSql = "SELECT * FROM ts WHERE suppName='$_POST[supp]' AND 
		tsNo='$tsno' AND rev='$tsrev'";
		$selectResult = $conn->query($selectSql);

		if($selectResult->num_rows > 0){
			$alreadyHave = true;
		}

		// check latest rev
		$revSql = "SELECT * FROM ts_rev WHERE tsNo='$tsno' order by rev desc";
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

		$tsno = $_POST[ts][$i];
		$tsrev = $_POST[rev][$i];
		echo "<tr>
				<td>$no</td>
				<td>$tsno</td>
				<td>$tsrev</td>";
				
		if($alreadyHave){
			echo "<td id='existedts'>Already have</td>";
		}else{			
			if($latestrev == -2){
				echo "<td><i class='green checkmark icon'></i></td>";
			}else if($latestrev == -1){
				echo "<td id='existedts'>TS is already DISUSE</td>";
			}else if($latestrev > $tsrev || $latestrev < $tsrev){
				echo "<td id='existedts'>Latest rev is $latestrev ($latestDate)</td>";
			}else {
				echo "<td><i class='green checkmark icon'></i></td>";
			}
		}				
		echo "</tr>";
		$no++;
		}
		
	}
	echo "</table>";
?>