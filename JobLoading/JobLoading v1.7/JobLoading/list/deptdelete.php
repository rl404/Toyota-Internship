<?php
	include "../db.php";

	$deptname = '';
	$deptcode = '';
	$sectname = '';

	$selectSql = "SELECT * FROM dept WHERE id=$_POST[deptid]";
	$selectResult = $conn->query($selectSql);
	while($row = mysqli_fetch_assoc($selectResult)) {
		$deptname = $row['deptName'];
		$deptcode = $row['deptCode'];
		$sectname = $row['sectName'];
	}

	echo "<h3 class='ui header' id='titleheader3'>Dept. Name : <span style='color:white;'>".$deptname." ($deptcode)</span><br>";
	echo "Sect. Name : <span style='color:white;'>".$sectname."</span></div>";

	echo "<form action='deptdelete2.php' method='post' id='deletedeptform'>	
			<input type='hidden' name='deptid' value='$_POST[deptid]'>
		</form>	";

?>