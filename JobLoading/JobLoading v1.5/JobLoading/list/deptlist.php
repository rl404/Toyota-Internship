<html>
	<?php include "../header.php" ?>
	<div class="ui container" id='homepage'>
	<div class="ui secondary menu">
		<div class="item">	
<?php
	include "../db.php";

	$selectSql = "SELECT * FROM dept order by deptName";

	// if search
	$query;	
	if(!empty($_GET['search'])){
		$query = $_GET['search'];
		$selectSql = "SELECT * FROM dept WHERE (deptCode LIKE '%$query%') OR (deptName LIKE '%$query%') OR (sectName LIKE '%$query%')
					order by deptCode";
		echo "<h2 id='titleheader'>Search: $query</h2>";		
	}else{
		echo "<h2 id='titleheader'>Department List</h2>";		
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
				<form action="deptlist.php" method="GET" id="deptsearchform">
					<div class="ui icon input">					
					    <input type="text" name="search" placeholder="Search dept/sect...">
					    <i class="search link icon" onclick="submitForm('deptsearchform');"></i>				
					</div>
					<button type="submit" style="display: none;">asd</button>
				</form>
			</div>
		</div>
	</div>

<?php
	$ts=0;

	$selectSql = "SELECT * FROM dept order by deptName";
	if(!empty($_GET['search'])){
		$query = $_GET['search'];
		$selectSql = "SELECT * FROM dept WHERE (deptCode LIKE '%$query%') OR (deptName LIKE '%$query%') OR (sectName LIKE '%$query%') 
					order by deptName";
	}	

	$selectResult = $conn->query($selectSql);

	// table data
	if($selectResult->num_rows > 0){
		echo "<table class='ui compact sortable selectable definition center aligned table'>
			<thead class='full-width'><tr>
				<th id='tableheader'>No</th>				
				<th id='tableheader'>Department Name</th>
				<th id='tableheader'>Dept. Code</th>	
				<th id='tableheader'>Section Name</th>		
			</tr></thead>";
	}	

	$no = 1;
	if($selectResult->num_rows > 0){
		while($row = mysqli_fetch_assoc($selectResult)) {
			echo "<tr>
					<td>$no</td>
					<td class='left aligned'>$row[deptName]</td>
					<td>$row[deptCode]</td>
					<td class='left aligned'>$row[sectName]</td>
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