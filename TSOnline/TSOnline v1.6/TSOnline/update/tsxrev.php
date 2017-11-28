<?php
	include "../db.php";

	// get the latest revision
	$revSql = "SELECT * FROM ts_rev WHERE tsNo='$_POST[ts]' order by tsNo,rev+0 desc";
	$revResult = $conn->query($revSql);

	$highestRev = 0;
	$latestRev;
	$latestDate;
	$latestContent = "";
	if($revResult->num_rows > 0){
		while($revrow = mysqli_fetch_assoc($revResult)){	
			if($revrow['rev'] == 'DISUSE'){
				$latestDate = $revrow['issueDate'];
				$highestRev = 100;
				break;	
			}

			if(preg_match('/EST/',$revrow['rev']) && $highestRev == 0){
				$highestRev = -100;
			}

			if(is_numeric($revrow['rev']) && $revrow['rev'] > $highestRev ){
				$highestRev = $revrow['rev'];
				$latestDate = $revrow['issueDate'];
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
		}else{
			$latestRev = $highestRev;
		}
	}else{
		$latestRev = "No info";
	}

	// check if already in db
	$inDB = FALSE;
	$revResult = $conn->query($revSql);
	if($revResult->num_rows > 0){
		while($revrow = mysqli_fetch_assoc($revResult)){	
			if($_POST['rev'] == $revrow['rev']){
				$inDB = TRUE;
				break;
			}
		}
	}

	echo "<div class='two fields'>";
	if($inDB){
		echo "<div class='field'>
				<label id='existedts'>Already in database. </label>
			</div>";
	}

	// check the input
	echo "<div class='field'>";
	if($latestRev == "DISUSE"){
		echo "<label id='existedts'>This TS is already DISUSE ($latestDate).</label>";
	}else if(preg_match('/EST/',$_POST['rev']) && $highestRev < 0){
		echo "<label id='okts'>OK <i class='green checkmark icon'></i></label>";
	}else if($_POST['rev'] < $highestRev){
		echo "<label id='existedts'>The latest revision is $latestRev ($latestDate).</label>";
	}else if($_POST['rev'] > $highestRev){
		echo "<label id='okts'>OK <i class='green checkmark icon'></i></label>";
	}else{
	}
	
	echo "</div>";

?>