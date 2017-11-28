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

		$highestRev = 0;
		$latestRev;
		$latestDate;
		$latestContent = "";
		if($revResult->num_rows > 0){
			while($revrow = mysqli_fetch_assoc($revResult)){					
				if($revrow['rev'] == 'DISUSE'){
					$latestDate = $revrow['issueDate'];
					$latestContent = $revrow['content'];
					$highestRev = 100;
					break;	
				}

				if(preg_match('/EST/',$revrow['rev']) && $highestRev == 0){
					$highestRev = -100;
				}

				if(is_numeric($revrow['rev']) && $revrow['rev'] > $highestRev ){
					$highestRev = $revrow['rev'];
					$latestDate = $revrow['issueDate'];
					$latestContent = $revrow['content'];
				}
			}
		}else{
			$highestRev = 0;
		}	

		if($highestRev != 0){
			if($highestRev == 100){
				$latestRev = "DISUSE";
			}else if($highestRev == -100){
				$latestRev = "EST.";
				$latestDate = $row['issueDate'];
				$latestContent = $row['content'];
			}else{
				$latestRev = $highestRev;
			}
		}else{
			$latestRev = "No info";
			$latestDate = "-";
			$latestContent = "-";
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
			if($latestRev == "DISUSE"){
				echo "<td id='existedts'>TS is already DISUSE</td>";
			}else if($tsrev == 'EST.' && $highestRev < 0){
				echo "<td><i class='green checkmark icon'></i></td>";
			}else if($highestRev > $tsrev || $highestRev < $tsrev){
				echo "<td id='existedts'>Latest rev is $latestRev ($latestDate)</td>";
			}else{
				echo "<td><i class='green checkmark icon'></i></td>";
			}
		}				
		echo "</tr>";
		$no++;
		}
		
	}
	echo "</table>";
?>