<?php
	include "../db.php";

	$selectSql = "SELECT * FROM ts order by reqDate desc,suppName";

	if(!empty($_POST['supplier'])){
		$selectSql = "SELECT * FROM ts WHERE suppName='$_POST[supplier]' order by reqDate desc,suppName";
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

	echo "<h2 class='ui header' id='titleheader2'>
			PT. $_POST[supplier]
			<div class='sub header' id='titleheader1'>$reqdateIndex requests</div>
		</h2>
		<div id='listxlist'>
		<table class='ui compact sortable selectable definition table center aligned'>
			<thead class='full-width'><tr>
				<th id='tableheader'>No</th>
				<th id='tableheader'>Request Date</th>
				<th id='tableheader'>Detail</th>
			</tr></thead>";

	$selectResult = $conn->query($selectSql);
	if($selectResult->num_rows > 0){
		for($i = 0; $i < count($reqdate); $i++){
			$reqdate2[$i] = strtotime( $reqdate[$i] );

			$reqDateD = date( 'd', $reqdate2[$i] );
			$reqDateM = date( 'M', $reqdate2[$i] );
			$reqDateY = date( 'Y', $reqdate2[$i] );

			echo "<tr>
					<td>$no</td>
					<td class='left aligned'>$reqDateY-$reqDateM-$reqDateD</td>
					<td><button class='ui red inverted tiny button' onclick='showRequestDetail(&quot;$_POST[supplier]&quot;&#44;&quot;$reqdate[$i]&quot;);'>Show</button></td>
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