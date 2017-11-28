<html>
	<?php include "../header.php" ?>
	<div class="ui container">
	<div class="ui secondary menu">
		<div class="item">	
<?php
	include "../db.php";

	$selectSql = "SELECT * FROM job order by jobName";

	// if search
	$query;	
	if(!empty($_GET['search'])){
		$query = $_GET['search'];
		$selectSql = "SELECT * FROM job WHERE (jobName LIKE '%$query%') OR (jobDesc LIKE '%$query%') OR (deptCode='$query')
					order by jobName";
		echo "<h2 id='titleheader'>Search: $query</h2>";		
	}else{
		echo "<h2 id='titleheader'>Job List</h2>";		
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
				<form action="joblist.php" method="GET" id="jobsearchform">
					<div class="ui icon input">					
					    <input type="text" name="search" placeholder="Search ...">
					    <i class="search link icon" onclick="submitForm('jobsearchform');"></i>				
					</div>
					<button type="submit" style="display: none;">asd</button>
				</form>
			</div>
		</div>
	</div>

<?php
	$ts=0;

	$selectSql = "SELECT * FROM job order by deptCode,jobName";
	if(!empty($_GET['search'])){
		$query = $_GET['search'];
		$selectSql = "SELECT * FROM job WHERE (jobName LIKE '%$query%') OR (jobDesc LIKE '%$query%') OR (deptCode='$query') 
					order by deptCode,jobName";
	}	

	$selectResult = $conn->query($selectSql);

	// table data
	if($selectResult->num_rows > 0){
		echo "<table class='ui compact sortable selectable definition center aligned table'>
			<thead class='full-width'><tr>
				<th id='tableheader'>No</th>
				<th id='tableheader'>Job Name</th>
				<th id='tableheader'>Dept.</th>	
				<th id='tableheader'>Job Description</th>			
			</tr></thead>";
	}	

	$no = 1;
	if($selectResult->num_rows > 0){
		while($row = mysqli_fetch_assoc($selectResult)) {
			echo "<tr>
					<td>$no</td>
					<td>$row[jobName]</td>
					<td>$row[deptCode]</td>
					<td class='left aligned'>$row[jobDesc]</td>
				</tr>";
				$no++;
		}
	}

	echo "</table>";
?>
	
	</div>
	<div class='ui divider'></div>
</body>
</html>