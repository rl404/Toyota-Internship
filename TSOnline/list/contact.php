<html>
	<?php include "../header.php" ?>
	<div class="ui container">

	<div class="ui secondary menu">
		<div class="item">		

<?php
	// Connect to db
	include "../db.php";

	// Select all supplier
	$selectSql = "SELECT * FROM supplier order by suppName,staffName";

	// Select searched supplier
	$query;	
	if(!empty($_GET['search'])){
		$query = $_GET['search'];
		$selectSql = "SELECT * FROM supplier WHERE (suppName LIKE '%$query%') OR (staffName LIKE '%$query%') OR (email LIKE '%$query%') OR (deptName LIKE '%$query%')
					order by suppName,staffName";
		echo "<h2 id='titleheader2'>Search: $query</h2>";		
	}else{
		echo "<h1 id='titleheader2'>Supplier Contact List</h1>";		
	}

	// Count data total
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

		<!-- Search box -->
		<div class="right menu">
			<div class="item">
				<form action="contact.php" method="GET" id="datasearchform">
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

	// Select all supplier
	$selectSql = "SELECT * FROM supplier order by suppName,staffName";

	// Select searched supplier
	if(!empty($_GET['search'])){
		$query = $_GET['search'];
		$selectSql = "SELECT * FROM supplier WHERE (suppName LIKE '%$query%') OR (staffName LIKE '%$query%') OR (email LIKE '%$query%') OR (deptName LIKE '%$query%')
					order by suppName,staffName";
	}

	$selectResult = $conn->query($selectSql);

	// Table data
	if($selectResult->num_rows > 0){
		echo "<table class='ui compact sortable selectable definition table'>
			<thead class='full-width'><tr>
				<th id='tableheader' class='center aligned'>No</th>
				<th id='tableheader' class='center aligned'>Supplier Name</th>
				<th id='tableheader' class='center aligned'>Dept. Name</th>
				<th id='tableheader' class='center aligned'>Contant Person</th>		
				<th id='tableheader' class='center aligned'>Email</th>
			</tr></thead>";

		$no = 1;		
		while($row = mysqli_fetch_assoc($selectResult)) {
			echo "<tr>
					<td class='center aligned'>$no.</td>
					<td><a href='datasupplier.php?search=$row[suppName]'>PT. $row[suppName]</a></td>
					<td>$row[deptName]</td>
					<td>$row[staffName]</td>
					<td>$row[email]</td>";
			echo "</tr>";
			$no++;		
		}		
		echo "</table>";

	// If no result
	}else{
		echo "<h3 class='ui header center aligned'>No result :(</h3>";
	}
?>
	</div>
	<div class="ui divider"></div>
</body>
</html>