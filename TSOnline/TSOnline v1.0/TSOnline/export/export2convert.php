<?php
	echo "
		<div class='ui two steps'>
		  <div class='completed step'>
		    <i class='search icon'></i>
		    <div class='content'>
		      <div class='title'>Search Request</div>
		    </div>
		  </div>
		  <div class='active step'>
		    <i class='file icon'></i>
		    <div class='content'>
		      <div class='title'>Convert to Cover Letter</div>
		    </div>
		  </div>
		</div>

		<div class='ui grid'>
			<div class='two column row'>
				<div class='column'>";
					
	include "../db.php";

	$selectSql = "SELECT * FROM ts WHERE suppName='$_POST[supplier]' and reqDate='$_POST[reqdate]' order by tsNo,rev+0 desc";

	// get different ts
	$ts = array();
	$tsCurrent = "";
	$tsIndex = 0;

	$selectResult = $conn->query($selectSql);
	while($row = mysqli_fetch_assoc($selectResult)) {
		if($row['tsNo'] != $tsCurrent){
			$tsCurrent = $row['tsNo'];
			$ts[$tsIndex][0] = $tsCurrent;
			$ts[$tsIndex][1] = $row['rev'];
			
			$tsIndex++;
		}
	}
	

	echo "<h2 class='ui header'>
			PT. $_POST[supplier]
			<input type='hidden' value='$_POST[supplier]' id='suppliername'>
		</h2>";	

	echo "<form class='ui form'>
		<table class='ui center aligned sortable table'>
			<thead><tr>
				<th>No</th>
				<th>TS Number</th>
				<th>Revision</th>
				<th>Model</th>
				<th>Part No.</th>
			</tr></thead>";
	$no = 1;
	$selectResult = $conn->query($selectSql);
	if($selectResult->num_rows > 0){
		for($i = 0; $i < count($ts); $i++){
			$tsNo =  $ts[$i][0];
			$tsRev =  $ts[$i][1];
			echo "<tr>
					<td>$no</td>
					<td><input type='text' name='tsno[]' value='$tsNo' id='tsnoinput'></td>
					<td><input type='text' name='tsrev[]' value='$tsRev' id='tsrevinput'></td>
					<td><input type='text' name='tsno[]' value='' id='modelinput'></td>
					<td><input type='text' name='tsno[]' value='' id='partinput'></td>
				</tr>";
			$no++;
		}
	}else{
		echo "<tr>
				<td class='center aligned' colspan=3>0 result :(</td>
			</tr>";
	}
	echo "</table>
		<button class='ui button' id='coverletterconvertbutton'>Convert</button>
	</form>

				</div>
				<div class='column'>
					<div id='requestconvert'></div>
				</div>
			</div>
		</div>";
?>