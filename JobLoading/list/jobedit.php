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
	while($row2 = mysqli_fetch_assoc($selectResult2)) {
		$jobdesc .= $row2['jobDesc']."\n";
	}


	echo "<form action='jobedit2.php' method='post' class='ui form' id='editjobform'>				
			<div class='required field'>
				<label id='titleheader'>Job Name</label>
				<input type='text' name='jobname' value='$jobname' required>
			</div>
			<div class='required field'>
				<label id='titleheader'>Dept. Code</label>
				<input type='text' name='deptcode' list='deptlist' value='$deptname' onkeydown='upperCaseF(this)' required/>
			</div>
			<datalist id='deptlist'>"; include '../input/deptcodesuggestion.php'; echo "</datalist>
			<div class='field'>
				<label id='titleheader'>Job Description / Element</label>
				<textarea name='jobdesc' placeholder='Description ...'>$jobdesc</textarea>
			</div>
			<div class='field'>
				<label id='titleheader'>Note: you can use 'enter' or ';' to enter new line in job description.</label>
			</div>
			<input type='hidden' name='jobid' value='$_POST[jobid]'>	
		</form>	";

?>