<?php
	include "../db.php";

	$selectSql = "SELECT * FROM staff WHERE noReg='$_POST[staff]'";

	$selectResult = $conn->query($selectSql);
	if($selectResult->num_rows > 0){
		while($row = mysqli_fetch_assoc($selectResult)) {
			echo "<div class='field'><label id='errortext'>
			*Already in Database with staff name: $row[staffName]
			</label></div>";
		}
	}

?>