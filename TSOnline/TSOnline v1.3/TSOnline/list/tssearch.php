<?php
	include "../db.php";

	$selectSql = "SELECT * FROM ts order by tsNo";

	if(!empty($_POST['ts'])){
		$selectSql = "SELECT * FROM ts WHERE tsNo like '%$_POST[ts]%' order by tsNo";
	}

	$ts = array();
	$tsCurrent = "";
	$tsIndex=0;

	$selectResult = $conn->query($selectSql);
	while($row = mysqli_fetch_assoc($selectResult)) {
		if($row['tsNo'] != $tsCurrent){
			$tsCurrent = $row['tsNo'];
			$ts[$tsIndex] = $tsCurrent;
			$tsIndex++;
		}
	}

	$no = 1;

	echo "<div id='listsearch'>
		<table class='ui compact sortable selectable definition table center aligned'>
			<thead class='full-width'><tr>
				<th id='tableheader'>No</th>
				<th id='tableheader'>TS Number</th>
				<th id='tableheader'>Supplier List</th>
			</tr></thead>";

	$selectResult = $conn->query($selectSql);
	if($selectResult->num_rows > 0){
		for($i = 0; $i < count($ts); $i++){
			echo "<tr>
					<td>$no</td>
					<td><a href='datats.php?search=$ts[$i]' target='_blank'>$ts[$i]</a></td>
					<td><button class='ui red inverted button' onclick='showSupplier(&quot;$ts[$i]&quot;);'>Show >></button></td>
				</tr>";
			$no++;
		}
	}else{
		echo "<tr>
				<td class='center aligned' colspan=3>0 result :(</td>
			</tr>";
	}
	echo "</table></div>";
?>