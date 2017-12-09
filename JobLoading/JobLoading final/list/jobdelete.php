<?php
	include "../db.php";

	$jobname = '';
	$deptname = '';
	$jobdesc = '';

	$selectSql = mysqli_query($conn,"SELECT * FROM job WHERE id=$_POST[jobid]");
	$row = mysqli_fetch_array($selectSql);
		$jobname = $row['jobName'];
		$deptname = $row['deptCode'];

	$selectSql2 = "SELECT * FROM job WHERE jobName='$jobname' and deptCode='$deptname'";
	$selectResult2 = $conn->query($selectSql2);

	$no = 1;
	while($row2 = mysqli_fetch_assoc($selectResult2)) {
		$jobdesc .= "$no. $row2[jobDesc]<br>";
		$no++;
	}

	echo "<h3 class='ui header' id='titleheader3'>Job Name : <span style='color:white;'>".$jobname."</span><br>";
	echo "Dept. Code : <span style='color:white;'>".$deptname."</span><br>";
	echo "Job Description : <br><span style='color:white;'>".$jobdesc."</span></div>";

	echo "<form action='jobdelete2.php' method='post' id='deletejobform'>
			<input type='hidden' name='jobname' value='$jobname'>
			<input type='hidden' name='deptcode' value='$deptname'>
		</form>	";

?>