<?php
	include "../db.php";

	$suppliername = '';
	$tsno = '';
	$rev = '';

	// echo $_POST['tsid'];

	$selectSql = "SELECT * FROM ts WHERE reqId='$_POST[tsid]'";
	$selectResult = $conn->query($selectSql);
	while($row = mysqli_fetch_assoc($selectResult)) {
		$suppliername = $row['suppName'];
		$tsno = $row['tsNo'];
		$rev = $row['rev'];
	}

	echo "<form action='' method='post' class='ui form' id='editsendform'>
			<input type='hidden' name='tsid' value='$_POST[tsid]' id='tsid'>
			
			
			<b>Supplier Name:</b> $suppliername<br>
			<input type='hidden' name='suppname' value='$suppliername'>
						
			<b>TS Number:</b> $tsno<br>
			<input type='hidden' name='tsno' value='$dtsno'>
			
			<b>Rev:</b> $rev
			<input type='hidden' name='rev' value='$rev'>

			<div class='three fields'>
				<div class='field'>
					<label>Deliver Date:</label>
					<select class='ui search dropdown' name='reqday' id='reqday'";
					
						for($i=1;$i<32;$i++){
							if($i==date('d')){
								echo "<option value='$i' selected>$i</option>";
							}else{
								echo "<option value='$i'>$i</option>";
							}
						}
				
					echo "
					</select>
				</div>
				<div class='field'>
					<label>.</label>
					<select class='ui search dropdown' name='reqmonth' id='reqmonth'>";
					
						for($i=1;$i<13;$i++){

							// Convert month to string
							$reqMonth = date('F',mktime(0,0,0,$i,1,2011));
							
							if($i==date('m')){
								echo "<option value='$i' selected>$reqMonth</option>";
							}else{
								echo "<option value='$i'>$reqMonth</option>";
							}
						}
					echo "
					</select>
				</div>
				<div class='field'>
					<label>.</label>";
					
						echo "<input type='text' name='reqyear' id='reqyear' value='";
						echo date('Y');
						echo "'>";
					echo "
				</div>						
			</div>

		</form>";

		echo "<div id='hiddensend'></div>";


?>