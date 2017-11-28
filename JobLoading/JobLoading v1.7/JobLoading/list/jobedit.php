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

	echo "<form action='jobedit2.php' method='post' class='ui form' id='editjobform'>	
			<input type='hidden' name='jobid' value='$_POST[jobid]'>	
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
			
		</form>	";

?>