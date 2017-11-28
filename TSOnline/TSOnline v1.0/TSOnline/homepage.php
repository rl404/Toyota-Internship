<?php
	include "header.php";

	include "db.php";

	// Count total data and different TS
	$tsCount = array();
	$tsCurrent = "";
	$tsIndex = 0;
	$dataCountTotal = 0;

	$selectSql = "SELECT * FROM ts order by tsNo";
	$selectResult = $conn->query($selectSql);
	while($row = mysqli_fetch_assoc($selectResult)) {
		if($row['tsNo'] != $tsCurrent){
			$tsCurrent = $row['tsNo'];
			$tsCount[$tsIndex] = 0;

			$selectTS = "SELECT * FROM ts WHERE tsNo='$tsCurrent'";

			$selectTSResult = $conn->query($selectTS);
			while($rowTS = mysqli_fetch_assoc($selectTSResult)) {
				$tsCount[$tsIndex]++;
				$dataCountTotal++;
			}
			$tsIndex++;
		}
	}

	// Count different supplier
	$suppCount = array();
	$suppCurrent = "";
	$suppIndex=0;

	$selectSql = "SELECT * FROM ts order by suppName";
	$selectResult = $conn->query($selectSql);
	while($row = mysqli_fetch_assoc($selectResult)) {
		if($row['suppName'] != $suppCurrent){
			$suppCurrent = $row['suppName'];
			$suppCount[$suppIndex]=0;

			$selectSupp = "SELECT * FROM ts WHERE suppName='$suppCurrent'";

			$selectSuppResult = $conn->query($selectSupp);
			while($rowSupp = mysqli_fetch_assoc($selectSuppResult)) {
				$suppCount[$suppIndex]++;
			}
			$suppIndex++;
		}
	}

	// Homepage Top Content
	echo "<div class='ui container'>
			<h1 class='ui center aligned dividing header'>Toyota Standard Information System</h1>
			<div class='ui three statistics'>
				<div class='statistic'>
					<div class='value'>
					  <a href='list/datasupplier.php'>$dataCountTotal</a>
					</div>
					<div class='label'>
					  Total TS Request
					</div>
				</div>
				<div class='statistic'>
					<div class='value'>
					  <a href='list/datats.php'><i class='file outline icon'></i> $tsIndex</a>
					</div>
					<div class='label'>
					  Registered TS Number
					</div>
				</div>
				<div class='statistic'>
					<div class='value'>
					  <a href='list/datasupplier.php'><i class='industry icon'></i> $suppIndex</a>
					</div>
					<div class='label'>
					  Registered Supplier
					</div>
				</div>
			</div>
			<div class='ui divider'></div>";

	
	echo "<div class='ui grid'>
			<div class='two column row'>
				<div class='column'>
			<h3 class='ui header'><a href='list/datats.php'>Recent TS Revision Update</a></h3>";

	// 5 recent revision updates
	$selectSql = "SELECT * FROM ts_rev order by issueDate desc";
	$selectResult = $conn->query($selectSql);

	$no = 1;
	echo "<table class='ui compact selectable table'>
			<thead><tr>
				<th class='center aligned'>No</th>
				<th class='center aligned'>TS Number</th>
				<th class='center aligned'>Revision</th>
				<th class='center aligned'>Issue Date</th>
			</tr></thead>";
	while($row = mysqli_fetch_assoc($selectResult)) {
		if($no < 6){
			echo "<tr>
					<td class='center aligned'>$no.</td>
					<td class='center aligned'>$row[tsNo]</td>
					<td class='center aligned'>$row[rev]</td>
					<td class='center aligned'>$row[issueDate]</td>
				</tr>";
			$no++;
		}else{break;}
	}

	
	// 5 revent supplier 
	echo "	</table>
				</div>
				<div class='column'>
			<h3 class='ui header'><a href='list/datasupplier.php'>Recent Supplier Request</a></h3>";

	$selectSql = "SELECT * FROM ts order by reqDate desc";
	$selectResult = $conn->query($selectSql);

	$no = 1;
	echo "<table class='ui compact selectable table'>
			<thead><tr>
				<th class='center aligned'>No</th>
				<th class='center aligned'>Supplier Name</th>
				<th class='center aligned'>TS Number</th>
				<th class='center aligned'>Revision</th>
				<th class='center aligned'>Request Date</th>
			</tr></thead>";
	while($row = mysqli_fetch_assoc($selectResult)) {
		if($no<6){
			echo "<tr>
					<td class='center aligned'>$no.</td>
					<td>PT. $row[suppName]</td>
					<td class='center aligned'>$row[tsNo]</td>
					<td class='center aligned'>$row[rev]</td>
					<td class='center aligned'>$row[reqDate]</td>
					<td></td>
				</tr>";
			$no++;
		}else{break;}
	}

		echo "</table>
				</div>
			</div>
			</div>
		<div class='ui divider'></div>";
		// summary month
	echo "<form class='ui form'>		
		<div class='inline fields'>
			<div class='field'>
				<label><h3 class='ui header'>Summary Month</h3></label>
				<select class='ui search dropdown' id='summarymonth'>";
				for($i=1;$i<13;$i++){
					$reqMonth = date("F",mktime(0,0,0,$i,1,2011));
					if($i==date('m')){
						echo "<option value='$i' selected>$reqMonth</option>";
					}else{
						echo "<option value='$i'>$reqMonth</option>";
					}
				}
	echo "		</select>
			</div>
			<label>-</label>
			<div class='field'>
				<input id='summaryyear' type='number' name='reqyear' size=5 value='";
	echo 		date('Y');
	echo 		"'>
			</div>
			<div class='field'>
				<button class='ui button' id='summarybutton'>Go</button>
			</div>
		</div>
		</form>";

	echo "<div id='summaryresult'>";
	include 'summary.php';
	echo "</div>";
	echo "<div class='ui divider'></div>";

	echo "</div>";
?>