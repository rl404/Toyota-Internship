<?php
	include "../db.php";

	$suppliername = '';
	$tsno = '';
	$ownedrev = '';

	$selectSql = "SELECT * FROM ts WHERE id=$_POST[supplierid]";
	$selectResult = $conn->query($selectSql);
	while($row = mysqli_fetch_assoc($selectResult)) {
		$suppliername = $row['suppName'];
		$tsno = $row['tsNo'];
		$ownedrev = $row['rev'];
	}

	echo "<form action='supplieredit2.php' method='post' class='ui form' id='editsupplierform'>	
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