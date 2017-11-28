<?php
	include "../db.php";

	$selectSql = "SELECT * FROM ts order by suppName";

	if(!empty($_POST['supplier'])){
		$selectSql = "SELECT * FROM ts WHERE suppName like '%$_POST[supplier]%' order by suppName";
	}

	$supplier = array();
	$supplierCurrent = "";
	$supplierIndex=0;

	$selectResult = $conn->query($selectSql);
	while($row = mysqli_fetch_assoc($selectResult)) {
		if($row['suppName'] != $supplierCurrent){
			$supplierCurrent = $row['suppName'];
			$supplier[$supplierIndex] = $supplierCurrent;
			$supplierIndex++;
		}
	}

	$no = 1;

	echo "<div id='listsearch'>
		<table class='ui compact sortable selectable definition table center aligned'>
			<thead class='full-width'><tr>
				<th>No</th>
				<th>Supplier Name</th>
				<th>TS Number</th>
			</tr></thead>";

	$selectResult = $conn->query($selectSql);
	if($selectResult->num_rows > 0){
		for($i = 0; $i < count($supplier); $i++){
			echo "<tr>
					<td>$no</td>
					<td class='left aligned'><a href='datasupplier.php?search=$supplier[$i]' target='_blank'>PT. $supplier[$i]</a></td>
					<td><button class='ui button' onclick='showTS(&quot;$supplier[$i]&quot;);'>Show TS >></button></td>
				</tr>";
			$no++;
		}
	}else{
		echo "<tr>
				<td class='center aligned' colspan=3>0 result :(</td>
			</tr>";
	}
	echo "</table></div>";
?>