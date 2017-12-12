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
			<h1 class='ui center aligned header' id='titleheader1'>
				Toyota Standard Information System
			</h1>
			<h5 class='ui horizontal divider header versionline'>
				<a href='version/version.php' id='titleheader1'>v1.9</a>
			</h5>
			<div class='ui three statistics'>
				<div class='statistic'>
					<div class='value'>
					  <a href='list/datasupplier.php' id='titleheader2'>$dataCountTotal</a>
					</div>
					<div class='label'>
					  Total TS Request
					</div>
				</div>
				<div class='statistic'>
					<div class='value'>
					  <a href='list/ts.php' id='titleheader2'><i class='file outline icon'></i> $tsIndex</a>
					</div>
					<div class='label'>
					  Registered TS Number
					</div>
				</div>
				<div class='statistic'>
					<div class='value'>
					  <a href='list/supplier.php' id='titleheader2'><i class='industry icon'></i> $suppIndex</a>
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
			<h3 class='ui header'><a href='list/datats.php' id='titleheader1'>Recent TS Revision Update<i class='linkify icon'></i></a></h3>";

	// 5 recent revision updates
	$selectSql = "SELECT * FROM ts_rev order by issueDate desc";
	$selectResult = $conn->query($selectSql);

	$no = 1;
	echo "<table class='ui center aligned compact selectable table'>
			<thead><tr>
				<th id='tableheader'>No</th>
				<th id='tableheader'>TS Number</th>
				<th id='tableheader'>Revision</th>
				<th id='tableheader'>Issue Date</th>
				<th id='tableheader'>Send Status</th>
			</tr></thead>";
	while($row = mysqli_fetch_assoc($selectResult)) {
		if($no < 6){

			$sentSupplier = 0;
			$totalSupplier = 0;
			$supplierStatus = array();
			$statusIndex = 0;

			$selectSql2 = "SELECT distinct suppName FROM ts where tsNo='$row[tsNo]' order by suppName";
			$selectResult2 = $conn->query($selectSql2);
			while($row2 = mysqli_fetch_assoc($selectResult2)) {

				$selectSql3 = "SELECT * FROM ts where tsNo='$row[tsNo]' and suppName='$row2[suppName]' and rev='$row[rev]' and sendStatus='1'";
				$selectResult3 = $conn->query($selectSql3);
				if($selectResult3->num_rows > 0){
					$sentSupplier++; 
					$supplierStatus[$statusIndex][0] = "<i class=&quot;green checkmark icon&quot;></i>";
				}else{
					$supplierStatus[$statusIndex][0] = "<i class=&quot;red remove icon&quot;></i>";
				}

				$supplierStatus[$statusIndex][1] = $row2['suppName'];

				$totalSupplier++;
				$statusIndex++;
			}

			$detailSupplier = "";

			for($i=0;$i<$statusIndex;$i++){
				$suppSign = $supplierStatus[$i][0];
				$suppName = $supplierStatus[$i][1];
				$detailSupplier .= $suppSign.$suppName.'<br>';
			}

			$issueDate = date( 'Y-M-d', strtotime($row['issueDate']));
			
			echo "<tr class='datapopup' data-html='$detailSupplier' data-position='right center'>
					<td>$no.</td>
					<td>$row[tsNo]</td>
					<td>$row[rev]</td>
					<td>$issueDate</td>
					<td>$sentSupplier / $totalSupplier</td>
				</tr>";
			$no++;
		}else{break;}
	}

	
	// 5 revent supplier 
	echo "	</table>
				</div>
				<div class='column'>
			<h3 class='ui header'><a href='list/datasupplier.php' id='titleheader1'>Recent Supplier Request<i class='linkify icon'></i></a></h3>";

	$selectSql = "SELECT * FROM ts order by reqDate desc";
	$selectResult = $conn->query($selectSql);

	$no = 1;
	echo "<table class='ui center aligned compact selectable table'>
			<thead><tr>
				<th id='tableheader'>No</th>
				<th id='tableheader'>Supplier Name</th>
				<th id='tableheader'>TS Number</th>
				<th id='tableheader'>Rev.</th>
				<th id='tableheader'>Request Date</th>
			</tr></thead>";
	while($row = mysqli_fetch_assoc($selectResult)) {
		if($no<6){
			$reqDate = date( 'Y-M-d', strtotime($row['reqDate']) );

			$sendStatus = "";
			if($row['sendStatus'] == 1){
				$sendStatus = "<i class=&quot;green checkmark icon&quot;></i>Delivered";
			}else{
				$sendStatus = "<i class=&quot;red remove icon&quot;></i>Not Delivered";
			}
						
			echo "<tr class='datapopup' data-html='$sendStatus' data-position='right center'>
					<td>$no.</td>
					<td class='left aligned'>PT. $row[suppName]</td>
					<td>$row[tsNo]</td>
					<td>$row[rev]</td>
					<td>$reqDate</td>
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
				<label><h3 class='ui header' id='titleheader1'>Summary Month</h3></label>
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
				<input id='summaryyear' type='text' name='reqyear' size=5 value='";
	echo 		date('Y');
	echo 		"'>
			</div>
		</div>
		</form>";

	echo "<div id='summaryresult'>";
	include 'summary.php';
	echo "</div>";
	echo "<div class='ui divider'></div>";

	echo "</div>";
?>