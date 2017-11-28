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
			if($revrow['rev'] == "EST."){
				$revrow['rev'] = 0;	
				$latestDate = $revrow['issueDate'];
				$highestRev = -3;
			}	
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
		}
	}else{
		$highestRev = -2;
	}	

	if($highestRev < 0){
		if($highestRev == -1){$latestRev = "DISUSE";}
		if($highestRev == -2){
			$latestRev = "No info";
			$latestDate = "-";
			$latestContent = "-";
		}
		if($highestRev == -3){
			$latestRev = "EST";
		}
	}else{
		$latestRev = $highestRev;
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
	}else if($latestRev == "EST"){
		echo "<label id='okts'>OK</label>";
	}else{
		if($_POST['rev'] < $latestRev){
			echo "<label id='existedts'>The latest revision is $latestRev ($latestDate).</label>";
		}else if($_POST['rev'] > $latestRev){
			echo "<label id='okts'>OK</label>";
		}else if($_POST['rev'] == $latestRev){
		}
	}
	echo "</div>";

?>