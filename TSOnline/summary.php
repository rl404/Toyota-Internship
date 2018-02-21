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

	// Count Request total + show it
	$dateIndex = 0;
	$selectSql = "SELECT * FROM ts WHERE MONTH(reqDate)=$reqMonth && YEAR(reqDate)=$reqYear order by suppName";
	$selectResult = $conn->query($selectSql);

	while($row = mysqli_fetch_assoc($selectResult)) {

		$no = 1;
		if(date( 'm', strtotime($row['reqDate'])) != $dateCurrent || $row['suppName'] != $suppCurrent){
			$dateCurrent = date( 'm', strtotime($row['reqDate']));
			$suppCurrent = $row['suppName'];
			$dateIndex++;
		}
	}

	echo "		<div class='statistic'>
					<div class='value'>
						<a onclick='showSummarySupplier();' id='titleheader2'>
							<i class='exchange icon'></i>
							$dateIndex
						</a>
					</div>
					<div class='label'>Supplier Request</div>";

					echo "<table class='ui table' id='summarysupplier' style='display:none;width:90%;'>";
					
					$no = 1;
					$dateCurrent = "";
					$suppCurrent = "";

					$selectSql = "SELECT * FROM ts WHERE MONTH(reqDate)=$reqMonth && YEAR(reqDate)=$reqYear order by suppName";
					$selectResult = $conn->query($selectSql);

					while($row = mysqli_fetch_assoc($selectResult)) {
						
						if(date( 'm', strtotime($row['reqDate'])) != $dateCurrent || $row['suppName'] != $suppCurrent){
							
							$dateCurrent = date( 'm', strtotime($row['reqDate']));
							$suppCurrent = $row['suppName'];

							$detailSupplier = "";

							$selectSql2 = "SELECT * FROM ts WHERE suppName='$suppCurrent' && MONTH(reqDate)=$reqMonth && YEAR(reqDate)=$reqYear order by tsNo";
							$selectResult2 = $conn->query($selectSql2);

							while($row2 = mysqli_fetch_assoc($selectResult2)) {

								$sendsign = "";
								if($row2['sendStatus'] == 1){
									$sendsign = "<i class=&quot;green checkmark icon&quot;></i>";
								}else{
									$sendsign = "<i class=&quot;red remove icon&quot;></i>";
								}

								$detailSupplier .= "$sendsign $row2[tsNo] - rev. $row2[rev]<br>";
							}

							echo "<tr class='datapopup' data-html='$detailSupplier' data-position='right center' >
									<td>$no.</td>
									<td>$suppCurrent</td>
								</tr>";

							$no++;
						}
					}

					echo "</table>";
					
	echo "		</div>";

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
			$ts[$tsIndex][0] = $row['tsNo'];
			$ts[$tsIndex][1] = $row['suppName'];
			$ts[$tsIndex][2] = $row['sendStatus'];
			$tsIndex++;
		}
	}

	echo "		<div class='statistic'>
					<div class='value' id='titleheader2'>
						<a onclick='showSummaryTS();' id='titleheader2'>
							<i class='mail icon'></i>
							$tsIndex
						</a>
					</div>
					<div class='label'>Requested TS</div>";

					$no = 1;
					echo "<table class='ui center aligned compact table' id='summaryts' style='display:none;width:90%;'>";
					for($i = 0;$i < count($ts);$i++){
						$tsno = $ts[$i][0];
						$suppname = $ts[$i][1];
						$sendstatus = $ts[$i][2];

						$sendsign = "";
						if($sendstatus == 1){
							$sendsign = "<i class='green checkmark icon'></i>Done";
						}else{
							$sendsign = "<i class='red remove icon'></i>Not Delivered";
						}

						echo "<tr class='datapopup' data-html='$suppname' data-position='right center'>
								<td class='one wide'>$no.</td>
								<td class='two wide'>$tsno</td>
								<td>$sendsign</td>
							</tr>";
						$no++;
					}
					echo "</table>";
					
	echo "		</div>";
	
	// Count updated ts + show it

	$tmcts = array();
	$tmcIndex = 0;

	$dataCountTotal = 0;
	$selectSql = "SELECT * FROM ts_rev WHERE MONTH(issueDate)=$reqMonth && YEAR(issueDate)=$reqYear";
	$selectResult = $conn->query($selectSql);
	while($row = mysqli_fetch_assoc($selectResult)) {
		$tmcts[$tmcIndex][0] = $row['tsNo'];
		$tmcts[$tmcIndex][1] = $row['rev'];

		$tmcIndex++;
		$dataCountTotal++;
	}	

	echo "		<div class='statistic'>
					<div class='value' id='titleheader2'>
						<a onclick='showSummaryTMC();' id='titleheader2'>
							<i class='repeat icon'></i>
							$dataCountTotal
						</a>
					</div>
					<div class='label'>Updated TS Revision</div>";

					$no = 1;
					$supplierStatus = array();
					$statusIndex = 0;					

					echo "<table class='ui center aligned table' id='summarytmc' style='display:none;width:90%;'>";
					for($i = 0;$i < count($tmcts);$i++){
						$tmc1 = $tmcts[$i][0];
						$tmc2 = $tmcts[$i][1];

						$sentSupplier = 0;
						$totalSupplier = 0;	
						$detailSupplier = "";					

						$selectSql2 = "SELECT distinct suppName FROM ts where tsNo='$tmc1' order by suppName";
						$selectResult2 = $conn->query($selectSql2);
						while($row2 = mysqli_fetch_assoc($selectResult2)) {

							$selectSql3 = "SELECT * FROM ts where tsNo='$tmc1' and suppName='$row2[suppName]' and rev='$tmc2' and sendStatus='1'";
							$selectResult3 = $conn->query($selectSql3);
							if($selectResult3->num_rows > 0){
								$sentSupplier++; 
								$supplierStatus[$statusIndex][0] = "<i class=&quot;green checkmark icon&quot;></i>";
							}else{
								$supplierStatus[$statusIndex][0] = "<i class=&quot;red remove icon&quot;></i>";
							}

							$supplierStatus[$statusIndex][1] = $row2['suppName'];

							$suppSign = $supplierStatus[$statusIndex][0];
							$suppName = $supplierStatus[$statusIndex][1];
							$detailSupplier .= $suppSign.$suppName.'<br>';

							$totalSupplier++;
							$statusIndex++;
						}

						echo "<tr class='datapopup' data-html='$detailSupplier' data-position='left center'>
									<td>$no.</td>
									<td>$tmc1</td>
									<td>$tmc2</td>
									<td>$sentSupplier / $totalSupplier</td>
								</tr>";
						$no++;
					}
					echo "</table>";
					
	echo "		</div>";

	echo "	</div>";

	echo "<script>
		$(document).ready(function() {
			$('.datapopup').popup(); 
		});
	</script>"
?>