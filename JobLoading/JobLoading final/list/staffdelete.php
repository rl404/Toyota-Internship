<?php
	include "../db.php";

	$staffname = '';
	$noreg = '';

	$selectSql = "SELECT * FROM staff WHERE id=$_POST[staffid]";
	$selectResult = $conn->query($selectSql);
	while($row = mysqli_fetch_assoc($selectResult)) {
		$staffname = $row['staffName'];
		$noreg = $row['noReg'];
	}

	echo "<h3 class='ui header' id='titleheader3'>No Reg. : <span style='color:white;'>".$noreg."</span><br>";
	echo "Member Name : <span style='color:white;'>".$staffname."</span></div>";

	echo "<form action='staffdelete2.php' method='post' id='deletestaffform'>	
			<input type='hidden' name='staffid' value='$_POST[staffid]'>
		</form>	";

?>