<?php
	include "db.php";

	echo "<div class='ui three statistics'>";

	// Initial month and year value
	$reqMonth;
	$reqYear;

	if(!empty($_POST['month'])){
		$reqMonth = $_POST['month'];
		$reqYear = $_POST['year'];
	}else{
		$reqMonth = date('m');
		$reqYear = date('Y');
	}

	// Count request total + show it
	$reqDate = array();
	$dateCurrent = "";
	$suppCurrent = "";
	$dateIndex = 0;

	$selectSql = "SELECT * FROM ts WHERE MONTH(reqDate)=$reqMonth && YEAR(reqDate)=$reqYear order by reqDate,suppName";
	$selectResult = $conn->query($selectSql);

	while($row = mysqli_fetch_assoc($selectResult)) {
		if($row['reqDate'] != $dateCurrent || $row['suppName'] != $suppCurrent){
			$dateCurrent = $row['reqDate'];
			$suppCurrent = $row['suppName'];
			$dateIndex++;
		}
	}

	echo "		<div class='statistic'>
					<div class='value' id='titleheader2'>
						<i class='exchange icon'></i>
						$dateIndex
					</div>
					<div class='label'>Supplier Request</div>
				</div>";

	// Count ts total + show it
	$dataCountTotal = 0;
	$ts = array();
	$tsCurrent = "";
	$tsIndex=0;

	$selectSql = "SELECT * FROM ts WHERE MONTH(reqDate)=$reqMonth && YEAR(reqDate)=$reqYear order by tsNo";
	$selectResult = $conn->query($selectSql);

	while($row = mysqli_fetch_assoc($selectResult)) {
		if($row['tsNo'] != $tsCurrent){
			$tsCurrent = $row['tsNo'];
			$ts[$tsIndex] = $tsCurrent;
			$tsIndex++;
		}
	}

	echo "		<div class='statistic'>
					<div class='value' id='titleheader2'>
						<i class='mail icon'></i>
						$tsIndex
					</div>
					<div class='label'>Requested TS</div>
				</div>";
	
	// Count updated ts + show it
	$dataCountTotal = 0;
	$selectSql = "SELECT * FROM ts_rev WHERE MONTH(issueDate)=$reqMonth && YEAR(issueDate)=$reqYear";
	$selectResult = $conn->query($selectSql);
	while($row = mysqli_fetch_assoc($selectResult)) {
		$dataCountTotal++;
	}	

	echo "		<div class='statistic'>
					<div class='value' id='titleheader2'>
						<i class='repeat icon'></i>
						$dataCountTotal
					</div>
					<div class='label'>Updated TS Revision</div>
				</div>";

	echo "	</div>";
?>