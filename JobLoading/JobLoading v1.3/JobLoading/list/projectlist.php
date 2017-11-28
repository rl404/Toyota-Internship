<html>
	<?php include "../header.php" ?>
	<div class="ui container"  id='homepage'>
	<div class="ui secondary menu">
		<div class="item">	
<?php
	include "../db.php";

	$selectSql = "SELECT * FROM project order by projectCode";

	// if search
	$query;	
	if(!empty($_GET['search'])){
		$query = $_GET['search'];
		$selectSql = "SELECT * FROM project WHERE (projectCode LIKE '%$query%') OR (projectName LIKE '%$query%')
					order by projectCode";
		echo "<h2 id='titleheader'>Search: $query</h2>";		
	}else{
		echo "<h2 id='titleheader'>Project List</h2>";		
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
				<form action="projectlist.php" method="GET" id="projectsearchform">
					<div class="ui icon input">					
					    <input type="text" name="search" placeholder="Search Project...">
					    <i class="search link icon" onclick="submitForm('projectsearchform');"></i>				
					</div>
					<button type="submit" style="display: none;">asd</button>
				</form>
			</div>
		</div>
	</div>

<?php
	$ts=0;

	$selectSql = "SELECT * FROM project order by projectCode";
	if(!empty($_GET['search'])){
		$query = $_GET['search'];
		$selectSql = "SELECT * FROM project WHERE (projectCode LIKE '%$query%') OR (projectName LIKE '%$query%')  
					order by projectCode";
	}	

	$selectResult = $conn->query($selectSql);

	// table data
	if($selectResult->num_rows > 0){
		echo "<table class='ui compact sortable selectable definition center aligned table'>
			<thead class='full-width'><tr>
				<th id='tableheader'>No</th>				
				<th id='tableheader'>Project Code</th>
				<th id='tableheader'>Project Name</th>			
			</tr></thead>";
	}	

	$no = 1;
	if($selectResult->num_rows > 0){
		while($row = mysqli_fetch_assoc($selectResult)) {
			echo "<tr>
					<td>$no</td>
					<td>$row[projectCode]</td>
					<td>$row[projectName]</td>
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