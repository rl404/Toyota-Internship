<?php 
	// Connect to db
	include "../db.php";

	// TS rev checker table
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

		// If write something in the TS no textbox
		if(!empty($_POST['ts'][$i])){

			// If rev textbox is empty
			if(empty($_POST['rev'][$i])) $_POST['rev'][$i] = 0;

			// Check supplier owned if they already have it
			$tsno = $_POST['ts'][$i];
			$tsrev = $_POST['rev'][$i];
			$selectSql = "SELECT * FROM ts WHERE suppName='$_POST[supp]' AND 
						tsNo='$tsno' AND rev='$tsrev'";
			$selectResult = $conn->query($selectSql);

			if($selectResult->num_rows > 0){
				$alreadyHave = true;
			}

			// Check latest rev
			$revSql = "SELECT * FROM ts_rev WHERE tsNo='$tsno' order by rev desc";
			$revResult = $conn->query($revSql);

			$highestRev = 0;
			$latestRev;
			$latestDate;
			$latestContent = "";
			if($revResult->num_rows > 0){
				while($revrow = mysqli_fetch_assoc($revResult)){			
					
					// If already DISUSE, end loop
					if($revrow['rev'] == 'DISUSE'){
						$latestDate = $revrow['issueDate'];
						$latestContent = $revrow['content'];
						$highestRev = 100;
						break;	
					}

					// If still EST, continue search
					if(preg_match('/EST/',$revrow['rev']) && $highestRev == 0){
						$highestRev = -100;
					}

					// If found newer rev, that will be the highest rev
					if(is_numeric($revrow['rev']) && $revrow['rev'] > $highestRev ){
						$highestRev = $revrow['rev'];
						$latestDate = $revrow['issueDate'];
						$latestContent = $revrow['content'];
					}
				}
			
			// If ts number not in db
			}else{
				$highestRev = 0;
			}	

			// If ts number is in db
			if($highestRev != 0){
				
				// If already DISUSE
				if($highestRev == 100){
					$latestRev = "DISUSE";
				
				// I still EST
				}else if($highestRev == -100){
					$latestRev = "EST.";
					$latestDate = $row['issueDate'];
					$latestContent = $row['content'];
				
				// If not DISUSE or EST, get the highest rev
				}else{
					$latestRev = $highestRev;
				}
			
			// If ts number not in db
			}else{
				$latestRev = "No info";
				$latestDate = "-";
				$latestContent = "-";
			}


			$tsno = $_POST[ts][$i];
			$tsrev = $_POST[rev][$i];
			
			// Show checked TS rev
			echo "<tr>
					<td>$no</td>
					<td>$tsno</td>
					<td>$tsrev</td>";
					
			// If supplier already have
			if($alreadyHave){
				echo "<td id='existedts'>Already have</td>";
			}else{	

				// If TS is already DISUSE
				if($latestRev == "DISUSE"){
					echo "<td id='existedts'>TS is already DISUSE</td>";
				
				// If TS is still EST
				}else if($tsrev == 'EST.' && $highestRev < 0){
					echo "<td><i class='green checkmark icon'></i></td>";
				
				// If there is newer rev 
				}else if($highestRev > $tsrev || $highestRev < $tsrev){
					echo "<td id='existedts'>Latest rev is $latestRev ($latestDate)</td>";
				
				// If supplier doesnt have yet
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