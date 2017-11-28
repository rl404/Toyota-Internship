<?php 

include "../db.php";

// separate each line
$separatedTSRev = array_filter(explode("*",$_POST['ts']));

echo "<form action='tsautoupdate.php' method='post' class='ui form' id='tsautoupdate'>
		<input type='hidden' value='1' name='type'>
		<div class='inline fields'>
			<label>Issue Date:</label>
			<div class='field'>
				<select class='ui search dropdown' name='reqday'>";
					for($i=1;$i<32;$i++){
						if($i==date('d')){
							echo "<option value='$i' selected>$i</option>";
						}else{
							echo "<option value='$i'>$i</option>";
						}
					}
				echo "</select>
			</div>/
			<div class='field'>
				<select class='ui search dropdown' name='reqmonth'>";
					for($i=1;$i<13;$i++){
						$reqMonth = date("F",mktime(0,0,0,$i,1,2011));
						if($i==date('m')){
							echo "<option value='$i' selected>$reqMonth</option>";
						}else{
							echo "<option value='$i'>$reqMonth</option>";
						}
					}
				echo "</select>/
			</div>
			<div class='field'>
				<input type='text' name='reqyear' value='";
				echo date('Y');
				echo "'>
			</div>
		</div>
		<table class='ui celled table'>
			<thead><tr>
				<th class='center aligned' id='tableheader'>TS No</th>
				<th class='center aligned' id='tableheader'>Rev.</th>
				<th class='center aligned' id='tableheader'>Content</th>
			</tr></thead>";
			
for($i=0;$i<count($separatedTSRev);$i++){
	// remove the ･
	$editedTS1 = substr($separatedTSRev[$i], 3, strlen($separatedTSRev[$i]));

	// separate into ts, rev, content
	$editedTS2 = explode("　",$editedTS1);

	// separate Rev.x
	$editedRev = explode(".",$editedTS2[1]);

	$selectSql = "SELECT * FROM ts_rev WHERE tsNo='$editedTS2[0]'";
	$selectResult = $conn->query($selectSql);

	$existts = false;
	$isoldrev = false;
	$latestrev = 0;

	$revcount = count($editedRev)-1;

	$highestRev = 0;
	$latestRev;

	if($selectResult->num_rows > 0){
		while($row = mysqli_fetch_assoc($selectResult)) {
			if($row['rev'] == $editedTS2[1] || $row['rev'] == $editedRev[$revcount]){
				$existts = true;
			}
			
			if($row['rev'] == 'DISUSE'){
				$highestRev = 100;
				break;	
			}

			if(preg_match('/EST/',$row['rev']) && $highestRev == 0){
				$highestRev = -100;
			}

			if(is_numeric($row['rev']) && $row['rev'] > $highestRev ){
				$highestRev = $row['rev'];
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

	echo "<tr>";
	if($existts){
		echo "<td class='center aligned' id='existedts' colspan=3>Already in Database</td>";
	}else{	
		echo "	<td><input type='text' name='tsno[]' value='$editedTS2[0]' class='center aligned' required></td>
				<td>";

		if((preg_match('/EST/',$editedRev[0]) && $highestRev > 0)
		|| (is_numeric($editedRev[1]) && $editedRev[1] < $highestRev)){
			echo "<div data-tooltip='Newer revision found. (Rev.$latestRev)' data-position='right center'>
				<input type='text' name='rev[]' value='$editedRev[$revcount]' class='center aligned' id='existedts' required></div>";
		}else{
			echo "<input type='text' name='rev[]' value='$editedRev[$revcount]' class='center aligned' required>";
		}

		echo "	</td>
				<td><textarea name='content[]' rows=2>$editedTS2[2]</textarea></td>";
	}
	
	echo "</tr>";
}
echo "</table>
	<button class='ui red inverted button' type='submit' form='tsautoupdate'>Submit</button>
	</form>";
?>