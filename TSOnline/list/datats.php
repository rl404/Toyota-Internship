<html>
	<?php include "../header.php" ?>
	<div class="ui container">

	<div class="ui secondary menu">
		<div class="item">		

<?php
	// Connect to db
	include "../db.php";

	$selectSql = "SELECT * FROM ts_rev order by issueDate desc";

	// Search query
	$query;	
	if(!empty($_GET['search'])){
		$query = $_GET['search'];
		$selectSql = "SELECT * FROM ts_rev WHERE (tsNo LIKE '%$query%') OR (content LIKE '%$query%') 
					order by tsNo asc,rev+0 desc";
		echo "<h2 id='titleheader2'>Search: $query</h2>";		
	
	// All ts data
	}else{
		echo "<h1 id='titleheader2'>TS Revision List</h1>";		
	}

	// Count ts data total
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

				<!-- Search box -->
				<form action="datats.php" method="GET" id="datasearchform">
					<div class="ui icon input">					
					    <input type="text" name="search" placeholder="Search TS or Content...">
					    <i class="search link icon" onclick="submitForm('datasearchform');"></i>				
					</div>
					<button type="submit" style="display: none;">asd</button>
				</form>
			</div>
		</div>
	</div>

<?php	

	// Select all data
	$selectSql = "SELECT * FROM ts_rev order by issueDate desc";

	// Select searched data
	if(!empty($_GET['search'])){
		$query = $_GET['search'];
		$selectSql = "SELECT * FROM ts_rev WHERE (tsNo LIKE '%$query%') OR (content LIKE '%$query%')  
					order by tsNo asc,rev+0 desc";
	}	

	// Run query
	$selectResult = $conn->query($selectSql);

	// Count total page number
	$pageCount = ceil(1+$dataCountTotal/50);

	// Top page number
	echo "<table class='ui collapsing table'><tr>";
	for($i = 1; $i < $pageCount; $i++){
		
		// Color the page number if in current page
		if(!empty($_GET['page']) && $_GET['page'] == $i){
			echo "<td onclick='submitForm(&quot;searchpage$i&quot;);' id='selected-tdpage'>$i</td>";
		
		// Other page number
		}else{
			echo "<td onclick='submitForm(&quot;searchpage$i&quot;);' id='tdpage'>$i</td>";		
		}
	}
	echo "</tr></table>";

	// Table data
	if($selectResult->num_rows > 0){
		echo "<table class='ui compact sortable selectable definition center aligned table'>
			<thead><tr>
				<th><i class='large black industry icon'></i></th>
				<th class='center aligned' id='tableheader'>No</th>
				<th class='center aligned' id='tableheader'>TS No</th>
				<th class='center aligned' id='tableheader'>Rev.</th>
				<th class='center aligned' id='tableheader'>Content</th>	
				<th class='center aligned' id='tableheader'>Issued Date</th>
				<th id='tableheader'>PIC</th>
			</tr></thead>";
	}	

	$ts=0;
	if($selectResult->num_rows > 0){

		// Selected page number
		$dataCount = 0;
		$page = 1;
		if(!empty($_GET['page'])){
			$page = $_GET['page'];
		}

		// Starting data number
		$no = 1+50*($page-1);

		// Show appropriate data on selected page
		$ts = 50*($page-1); 

		while($row = mysqli_fetch_assoc($selectResult)) {
			
			// Increase data count
			$dataCount++;

			// Show the correct data on the selected page
			if($dataCount<=$page*50 && $dataCount>($page-1)*50){

				// Check latest rev
				$revSql = "SELECT * FROM ts_rev WHERE tsNo='$row[tsNo]' order by rev+0 desc";
				$revResult = $conn->query($revSql);

				$highestRev = 0;
				$latestRev;
				$latestDate;
				$latestContent = "";
				if($revResult->num_rows > 0){
					while($revrow = mysqli_fetch_assoc($revResult)){			
						
						// If already DISUSE, end loop
						if($revrow['rev'] == 'DISUSE'){
							$latestDate = $revrow['issueDate'];
							$latestContent = $revrow['content'];
							$highestRev = 100;
							break;	
						}

						// If still EST, continue search
						if(preg_match('/EST/',$revrow['rev']) && $highestRev == 0){
							$highestRev = -100;
						}

						// If found newer rev, that will be the highest rev
						if(is_numeric($revrow['rev']) && $revrow['rev'] > $highestRev ){
							$highestRev = $revrow['rev'];
							$latestDate = $revrow['issueDate'];
							$latestContent = $revrow['content'];
						}
					}
				
				// If ts number not in db
				}else{
					$highestRev = 0;
				}	

				// If ts number is in db
				if($highestRev != 0){
					
					// If already DISUSE
					if($highestRev == 100){
						$latestRev = "DISUSE";
					
					// I still EST
					}else if($highestRev == -100){
						$latestRev = "EST.";
						$latestDate = $row['issueDate'];
						$latestContent = $row['content'];
					
					// If not DISUSE or EST, get the highest rev
					}else{
						$latestRev = $highestRev;
					}
				
				// If ts number not in db
				}else{
					$latestRev = "No info";
					$latestDate = "-";
					$latestContent = "-";
				}

				// Show data + link
				echo "<tr class='datatsrow'>
						<td style='background-color:transparent;'>
							<form method='POST' action='datatsxsupplier.php' id='$row[tsNo]xsupplierform'>
								<input type='hidden' name='tsno' value='$row[tsNo]'>
								<input type='hidden' name='tsrev' value='$row[rev]'>
								<input type='hidden' name='content' value='$row[content]'>
								<input type='hidden' name='issuedate' value='$row[issueDate]'>
								<i class='large green link file excel outline icon' onclick='submitForm(&quot;$row[tsNo]xsupplierform&quot;)';></i>
							</form>
						</td>
						<td style='background-color:#e3e3e3;'>$no.</td>
						<td><a href='datasupplier.php?search=$row[tsNo]'>$row[tsNo]</a></td>						
						<td ";

				// If there is newer rev, color the text
				if((preg_match('/EST/',$row['rev']) && $highestRev > 0)
				|| (is_numeric($row['rev']) && (int)$row['rev'] < $highestRev)){
					echo "<td id='existedts' data-tooltip='Latest rev is $latestRev ($latestDate)' data-position='right center'>$row[rev]</td>";
				
				// If already the latest
				}else{
					echo "<td>$row[rev]</td>";
				}

				// Convert month to string
				$row['issueDate'] = strtotime( $row['issueDate'] );
				$row['issueDate'] = date( 'Y-M-d', $row['issueDate'] );

				echo "	<td class='left aligned'>$row[content]</td>
						<td>$row[issueDate]</td>
						<td class='left aligned'>$row[pic]</td>
					</tr>";
				$no++;
			}
			
			// Out of loop if already 50 data in the page
			if($dataCount >= $page*50)break;
			
		}

		echo "</table>";

		// Bottom page number
		echo "<table class='ui table collapsing'><tr>";

		for($i = 1; $i < $pageCount; $i++){
			echo "<form action='datats.php' method='GET' id='searchpage$i'>";
			echo "<input type='hidden' value='$i' name='page'>";

			// Dont forget the search query when go to other page
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
