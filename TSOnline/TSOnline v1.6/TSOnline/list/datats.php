<html>
	<?php include "../header.php" ?>
	<div class="ui container">

	<div class="ui secondary menu">
		<div class="item">		

<?php
	include "../db.php";

	$selectSql = "SELECT * FROM ts_rev order by issueDate desc";

	// if search
	$query;	
	if(!empty($_GET['search'])){
		$query = $_GET['search'];
		$selectSql = "SELECT * FROM ts_rev WHERE (tsNo LIKE '%$query%') OR (content LIKE '%$query%') 
					order by tsNo asc,rev+0 desc";
		echo "<h2 id='titleheader2'>Search: $query</h2>";		
	}else{
		echo "<h1 id='titleheader2'>TS Revision List</h1>";		
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
	$ts=0;

	$selectSql = "SELECT * FROM ts_rev order by issueDate desc";
	if(!empty($_GET['search'])){
		$query = $_GET['search'];
		$selectSql = "SELECT * FROM ts_rev WHERE (tsNo LIKE '%$query%') OR (content LIKE '%$query%')  
					order by tsNo asc,rev+0 desc";
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
		echo "<table class='ui compact sortable selectable definition center aligned table'>
			<thead class='full-width'><tr>
				<th class='center aligned' id='tableheader'>No</th>
				<th class='center aligned' id='tableheader'>TS No</th>
				<th class='center aligned' id='tableheader'>Rev.</th>
				<th class='center aligned' id='tableheader'>Content</th>	
				<th class='center aligned' id='tableheader'>Issued Date</th>
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

				echo "<tr class='datatsrow'>
						<td>$no</td>
						<td><a href='datasupplier.php?search=$row[tsNo]'>$row[tsNo]</a></td>						
						<td ";

				if((preg_match('/EST/',$row['rev']) && $highestRev > 0)
				|| (is_numeric($row['rev']) && (int)$row['rev'] < $highestRev)){
					echo "<td id='existedts' data-tooltip='Latest rev is $latestRev ($latestDate)' data-position='right center'>$row[rev]</td>";
				}else{
					echo "<td>$row[rev]</td>";
				}
				// echo "<td id='existedts' data-tooltip='Latest rev is $latestRev ($latestDate)' data-position='right center'>$row[rev]</td>";
				
				$row['issueDate'] = strtotime( $row['issueDate'] );
				$row['issueDate'] = date( 'Y-M-d', $row['issueDate'] );

				echo "	<td class='left aligned'>$row[content]</td>
						<td>$row[issueDate]</td>
						<td class='left aligned'>$row[pic]</td>
					</tr>";
				$no++;
			}
			
			if($dataCount >= $page*50)break;
			
		}

		echo "</table>";

		// page number
		echo "<table class='ui table collapsing'><tr>";

		for($i = 1; $i < $pageCount; $i++){
			echo "<form action='datats.php' method='GET' id='searchpage$i'>";
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

	<div class="ui modal">
  <i class="close icon"></i>
  <div class="header">
    Profile Picture
  </div>
  <div class="image content">
    <div class="ui medium image">
      <img src="/images/avatar/large/chris.jpg">
    </div>
    <div class="description">
      <div class="ui header">We've auto-chosen a profile image for you.</div>
      <p>We've grabbed the following image from the <a href="https://www.gravatar.com" target="_blank">gravatar</a> image associated with your registered e-mail address.</p>
      <p>Is it okay to use this photo?</p>
    </div>
  </div>
  <div class="actions">
    <div class="ui black deny button">
      Nope
    </div>
    <div class="ui positive right labeled icon button">
      Yep, that's me
      <i class="checkmark icon"></i>
    </div>
  </div>
</div>

</body>
</html>
