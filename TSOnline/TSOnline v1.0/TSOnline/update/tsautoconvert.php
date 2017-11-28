<?php 

include "../db.php";

// separate each line
$separatedTSRev = array_filter(explode("*",$_POST['ts']));

echo "<form action='tsautoupdate.php' method='post' class='ui form' id='tsautoupdate'>
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
						if($i==date('m')){
							echo "<option value='$i' selected>$i</option>";
						}else{
							echo "<option value='$i'>$i</option>";
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
				<th class='center aligned'>TS No</th>
				<th class='center aligned'>Rev.</th>
				<th class='center aligned'>Content</th>
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
	while($row = mysqli_fetch_assoc($selectResult)) {
		if($row['rev'] == $editedTS2[1] || $row['rev'] == $editedRev[$revcount]){
			$existts = true;
		}
		if($row['rev'] > $editedRev[$revcount]){
			$isoldrev = $isoldrev || true;
			$latestrev = $row['rev'];
		}			
	}

	echo "<tr>";
	if($existts){
		echo "<td class='center aligned' id='existedts' colspan=3>Already in Database</td>";
	}else{	
		echo "	<td><input type='text' name='tsno[]' value='$editedTS2[0]' class='center aligned'></td>
				<td>";

		if($isoldrev){
			echo "<div data-tooltip='Newer revision found. (Rev.$latestrev)' data-position='right center'>
				<input type='text' name='rev[]' value='$editedRev[$revcount]' class='center aligned' id='existedts'></div>";
		}else{
			echo "<input type='text' name='rev[]' value='$editedRev[$revcount]' class='center aligned'>";
		}
		echo "	</td>
				<td><textarea name='content[]' rows=2>$editedTS2[2]</textarea></td>";
	}
	
	echo "</tr>";
}
echo "</table>
	<button class='ui button' type='submit' form='tsautoupdate'>Submit</button>
	</form>";
?>