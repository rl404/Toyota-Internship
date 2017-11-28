<?php
	include "../db.php";

	$jobname = '';
	$deptname = '';
	$jobdesc = '';

	$selectSql = "SELECT * FROM job WHERE id=$_POST[jobid]";
	$selectResult = $conn->query($selectSql);
	while($row = mysqli_fetch_assoc($selectResult)) {
		$jobname = $row['jobName'];
		$deptname = $row['deptCode'];
		$jobdesc = $row['jobDesc'];
	}

	echo "<h3 class='ui header' id='titleheader3'>Job Name : <span style='color:white;'>".$jobname."</span><br>";
	echo "Dept. Code : <span style='color:white;'>".$deptname."</span></div>";

	echo "<form action='jobdelete2.php' method='post' id='deletejobform'>	
			<input type='hidden' name='jobid' value='$_POST[jobid]'>
		</form>	";

?>