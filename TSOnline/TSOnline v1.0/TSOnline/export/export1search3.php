<?php
	include "../db.php";

	$selectSql = "SELECT * FROM ts WHERE suppName='$_POST[supplier]' and reqDate='$_POST[reqdate]' order by tsNo,rev+0 desc";

	// get different ts
	$ts = array();
	$tsCurrent = "";
	$tsIndex = 0;

	$selectResult = $conn->query($selectSql);
	while($row = mysqli_fetch_assoc($selectResult)) {
		if($row['tsNo'] != $tsCurrent){
			$tsCurrent = $row['tsNo'];
			$ts[$tsIndex][0] = $tsCurrent;
			$ts[$tsIndex][1] = $row['rev'];
			
			$tsIndex++;
		}
	}
	

	echo "<h2 class='ui header'>
			$_POST[reqdate]
			<div class='sub header'>$tsIndex TS</div>
		</h2>";	

	echo "
		<table class='ui center aligned sortable table'>
			<thead><tr>
				<th>No</th>
				<th>TS Number</th>
				<th>Requested Revision</th>
			</tr></thead>";
	$no = 1;
	$selectResult = $conn->query($selectSql);
	if($selectResult->num_rows > 0){
		for($i = 0; $i < count($ts); $i++){
			$tsNo =  $ts[$i][0];
			$tsRev =  $ts[$i][1];
			echo "<tr>
					<td>$no</td>
					<td><a href='../list/datats.php?search=$tsNo' target='_blank'>$tsNo</a></td>
					<td>$tsRev</td>
				</tr>";
			$no++;
		}
	}else{
		echo "<tr>
				<td class='center aligned' colspan=3>0 result :(</td>
			</tr>";
	}
	echo "</table>

	<form method='post' action='export.php'>
		<input type='hidden' name='supplier' value='$_POST[supplier]'>
		<input type='hidden' name='reqdate' value='$_POST[reqdate]'>
		<button class='ui button'>Convert</button>
	</form>";
?>