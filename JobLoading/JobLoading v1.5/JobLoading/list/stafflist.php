<html>
	<?php include "../header.php" ?>
	<div class="ui container">
	<div class="ui secondary menu">
		<div class="item">	
<?php
	include "../db.php";

	$selectSql = "SELECT * FROM staff order by staffName";

	// if search
	$query;	
	if(!empty($_GET['search'])){
		$query = $_GET['search'];
		$selectSql = "SELECT * FROM staff WHERE (staffName LIKE '%$query%') OR (noReg LIKE '%$query%') OR (deptName LIKE '%$query%') OR (deptCode='$query') OR (sectName LIKE '%$query%')
					order by staffName";
		echo "<h2 id='titleheader'>Search: $query</h2>";		
	}else{
		echo "<h2 id='titleheader'>Staff List</h2>";		
	}

	// count data total
	$dataCountTotal = 0;
	$selectResult = $conn->query($selectSql);
	while($row = mysqli_fetch_assoc($selectResult)) {
		$dataCountTotal++;
	}
	echo "
		</div>
		<div class='item' id='titleheader2'>
			$dataCountTotal results
		</div>";
?>
	<div class="right menu">
			<div class="item">
				<form action="stafflist.php" method="GET" id="staffsearchform">
					<div class="ui icon input">					
					    <input type="text" name="search" placeholder="Search staff...">
					    <i class="search link icon" onclick="submitForm('staffsearchform');"></i>				
					</div>
					<button type="submit" style="display: none;">asd</button>
				</form>
			</div>
		</div>
	</div>

<?php
	$ts=0;

	$selectSql = "SELECT * FROM staff order by staffName";
	if(!empty($_GET['search'])){
		$query = $_GET['search'];
		$selectSql = "SELECT * FROM staff WHERE (staffName LIKE '%$query%') OR (noReg LIKE '%$query%') OR (deptName LIKE '%$query%') OR (deptCode='$query') OR (sectName LIKE '%$query%')
					order by staffName";
	}	

	$selectResult = $conn->query($selectSql);

	// table data
	if($selectResult->num_rows > 0){
		echo "<table class='ui compact sortable selectable definition center aligned table'>
			<thead class='full-width'><tr>
				<th id='tableheader'>No</th>
				<th id='tableheader'>No Reg.</th>
				<th id='tableheader'>Staff Name</th>
				<th id='tableheader'>Departement Name</th>	
				<th id='tableheader'>Dept. Code</th>	
				<th id='tableheader'>Section Name</th>
				<th id='tableheader'>Job Title</th>	
				<th id='tableheader'>Job Class</th>
			</tr></thead><tbody>";
	}	

	$no = 1;
	if($selectResult->num_rows > 0){
		while($row = mysqli_fetch_assoc($selectResult)) {
			if($row['staffName'] != "ADMIN"){
				echo "<tr>
						<td>$no</td>
						<td>$row[noReg]</td>
						<td class='left aligned'>$row[staffName]</td>
						<td class='left aligned'>$row[deptName]</td>
						<td>$row[deptCode]</td>
						<td class='left aligned'>$row[sectName]</td>
						<td>$row[jobTitle]</td>
						<td>$row[jobClass]</td>
					</tr>";
				$no++;
			}				
		}
	}

	echo "</tbody></table>";
?>
	
	</div>
	<div class='ui divider'></div>
</body>
</html>