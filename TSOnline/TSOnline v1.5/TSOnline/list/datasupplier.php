<html>
	<?php include "../header.php" ?>
	<div class="ui container">

	<div class="ui secondary menu">
		<div class="item">		

<?php
	include "../db.php";

	$selectSql = "SELECT * FROM ts order by tsNo,suppName,rev";

	// if search
	$query;	
	if(!empty($_GET['search'])){
		$query = $_GET['search'];
		$selectSql = "SELECT * FROM ts WHERE (tsNo LIKE '%$query%') OR (suppName LIKE '%$query%') OR (model LIKE '%$query%') OR (partNo LIKE '%$query%')
					order by tsNo,rev";
		echo "<h2 id='titleheader2'>Search: $query</h2>";		
	}else{
		echo "<h1 id='titleheader2'>Request Data List</h1>";		
	}

	// count data total
	$dataCountTotal = 0;
	$selectResult = $conn->query($selectSql);
	while($row = mysqli_fetch_assoc($selectResult)) {
		$dataCountTotal++;
	}
	echo "
		</div>
		<div class='item' id='titleheader1'>
			$dataCountTotal results
		</div>";
?>
		<div class="right menu">
			<div class="item">
				<form action="datasupplier.php" method="GET" id="datasearchform">
					<div class="ui icon input">					
					    <input type="text" name="search" placeholder="Search TS or Supplier...">
					    <i class="search link icon" onclick="submitForm('datasearchform');"></i>					
					</div>
					<button type="submit" style="display: none;">a</button>
				</form>
			</div>
		</div>
	</div>

<?php
	$ts=0;

	$selectSql = "SELECT * FROM ts order by reqDate desc,suppName";
	if(!empty($_GET['search'])){
		$query = $_GET['search'];
		$selectSql = "SELECT * FROM ts WHERE (tsNo LIKE '%$query%') OR (suppName LIKE '%$query%') OR (model LIKE '%$query%') OR (partNo LIKE '%$query%')
					order by reqDate desc,suppName";
	}

	$selectResult = $conn->query($selectSql);
	$pageCount = ceil(1+$dataCountTotal/50);
	
	// page number
	echo "<table class='ui collapsing table'><tr>";
	for($i = 1; $i < $pageCount; $i++){
		if(!empty($_GET['page']) && $_GET['page'] == $i){
			echo "<td onclick='submitForm(&quot;searchpage$i&quot;);' id='selected-tdpage'>$i</td>";
		}else{
			echo "<td onclick='submitForm(&quot;searchpage$i&quot;);' id='tdpage'>$i</td>";		
		}
	}
	echo "</tr></table>";
	
	// table data
	if($selectResult->num_rows > 0){
		echo "<table class='ui compact sortable selectable definition table center aligned'>
			<thead class='full-width'><tr>
				<th id='tableheader'>No</th>
				<th id='tableheader'>Supplier Name</th>
				<th id='tableheader'>TS No</th>
				<th id='tableheader'>Rev.</th>		
				<th id='tableheader'>Model</th>
				<th id='tableheader'>Part Number</th>		
				<th id='tableheader'>Request Date</th>					
				<th id='tableheader'>PIC</th>		
			</tr></thead>";
	}

	if($selectResult->num_rows > 0){	
		
		// calculate each page
		$dataCount = 0;
		$page = 1;
		if(!empty($_GET['page'])){
			$page = $_GET['page'];
		}
		$no = 1+50*($page-1);
		$ts = 50*($page-1); 		

		while($row = mysqli_fetch_assoc($selectResult)) {
			$dataCount++;

			// show ts on the selected page
			if($dataCount<=$page*50 && $dataCount>($page-1)*50){

				// check latest rev
				$revSql = "SELECT * FROM ts_rev WHERE tsNo='$row[tsNo]' order by rev+0 desc";
				$revResult = $conn->query($revSql);

				$highestRev = 0;
				$latestRev;
				$latestDate;
				$latestContent = "";
				if($revResult->num_rows > 0){
					while($revrow = mysqli_fetch_assoc($revResult)){			
						if($revrow['rev'] == 'DISUSE'){
							$latestDate = $revrow['issueDate'];
							$latestContent = $revrow['content'];
							$highestRev = 100;
							break;	
						}

						if(preg_match('/EST/',$revrow['rev']) && $highestRev == 0){
							$highestRev = -100;
						}

						if(is_numeric($revrow['rev']) && $revrow['rev'] > $highestRev ){
							$highestRev = $revrow['rev'];
							$latestDate = $revrow['issueDate'];
							$latestContent = $revrow['content'];
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
						$latestDate = $row['issueDate'];
						$latestContent = $row['content'];
					}else{
						$latestRev = $highestRev;
					}
				}else{
					$latestRev = "No info";
					$latestDate = "-";
					$latestContent = "-";
				}

				echo "<tr>
						<td>$no</td>
						<td class='left aligned'><a href='datasupplier.php?search=$row[suppName]'>PT. $row[suppName]</a></td>
						<td><div class='tdtsno'><a href='datats.php?search=$row[tsNo]'>$row[tsNo]</a></div></td>";

				if((preg_match('/EST/',$row['rev']) && $highestRev > 0)
				|| (is_numeric($row['rev']) && (int)$row['rev'] < $highestRev)){
					echo "<td id='existedts' data-tooltip='Latest rev is $latestRev ($latestDate)' data-position='right center'>$row[rev]</td>";
				}else{
					echo "<td>$row[rev]</td>";
				}
					
				$row['reqDate'] = strtotime( $row['reqDate'] );
				$row['reqDate'] = date( 'Y-M-d', $row['reqDate'] );

				echo "	<td>$row[model]</td>
						<td>$row[partNo]</td>
						<td>$row[reqDate]</td>
						<td>$row[pic]</td>";
				echo "</tr>";
				$no++;
			}
			
			if($dataCount >= $page*50)break;
			
		}
		
		echo "</table>";

		// page number
		echo "<table class='ui table collapsing'><tr>";

		for($i = 1; $i < $pageCount; $i++){
			echo "<form action='datasupplier.php' method='GET' id='searchpage$i'>";
			echo "<input type='hidden' value='$i' name='page'>";

			if(!empty($query)){
				echo "<input type='hidden' value='$query' name='search'>";
			}
			echo "</form>";

			if(!empty($_GET['page']) && $_GET['page'] == $i){
				echo "<td onclick='submitForm(&quot;searchpage$i&quot;);' id='selected-tdpage'>$i</td>";
			}else{
				echo "<td onclick='submitForm(&quot;searchpage$i&quot;);' id='tdpage'>$i</td>";		
			}
		}
		echo "</tr></table>";
	}else{
		echo "<h3 class='ui header center aligned'>No result :(</h3>";
	}
?>
	</div>
	<div class="ui divider"></div>
</body>
</html>