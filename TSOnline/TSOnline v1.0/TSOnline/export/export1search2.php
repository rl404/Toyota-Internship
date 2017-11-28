<?php
	include "../db.php";

	$selectSql = "SELECT * FROM ts order by reqDate desc,suppName";

	if(!empty($_POST['supplier'])){
		$selectSql = "SELECT * FROM ts WHERE suppName like '%$_POST[supplier]%' order by reqDate desc,suppName";
	}

	$reqdate = array();
	$reqdateCurrent = "";
	$reqdateIndex=0;

	$selectResult = $conn->query($selectSql);
	while($row = mysqli_fetch_assoc($selectResult)) {
		if($row['reqDate'] != $reqdateCurrent){
			$reqdateCurrent = $row['reqDate'];
			$reqdate[$reqdateIndex] = $reqdateCurrent;
			$reqdateIndex++;
		}
	}

	$no = 1;

	echo "<h2 class='ui header'>
			PT. $_POST[supplier]
			<div class='sub header'>$reqdateIndex requests</div>
		</h2>
		<div id='listxlist'>
		<table class='ui compact sortable selectable definition table center aligned'>
			<thead class='full-width'><tr>
				<th>No</th>
				<th>Request Date</th>
				<th>Detail</th>
			</tr></thead>";

	$selectResult = $conn->query($selectSql);
	if($selectResult->num_rows > 0){
		for($i = 0; $i < count($reqdate); $i++){
			echo "<tr>
					<td>$no</td>
					<td>$reqdate[$i]</td>
					<td><button class='ui button' onclick='showRequestDetail(&quot;$_POST[supplier]&quot;&#44;&quot;$reqdate[$i]&quot;);'>Show</button></td>
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