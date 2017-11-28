<?php
	include "../db.php";

	$deptname = '';
	$deptcode = '';
	$sectname = '';
	$showlist = '';

	$selectSql = "SELECT * FROM dept WHERE id=$_POST[deptid]";
	$selectResult = $conn->query($selectSql);
	while($row = mysqli_fetch_assoc($selectResult)) {
		$deptname = $row['deptName'];
		$deptcode = $row['deptCode'];
		$sectname = $row['sectName'];
		$showlist = $row['showList'];
	}

	echo "<form action='deptedit2.php' method='post' class='ui form' id='editdeptform'>
			<input type='hidden' name='deptid' value='$_POST[deptid]'>
			<div class='two fields'>
				<div class='required field'>
					<label id='titleheader'>Department Name</label>
					<input type='text' name='deptname' list='deptlist' value='$deptname' required>
				</div>
				<datalist id='deptlist'>"; include '../input/deptnamesuggestion.php'; echo "</datalist>
	
				<div class='required field'>
					<label id='titleheader'>Department Code</label>
					<input type='text' name='deptcode' list='deptlist2' value='$deptcode' onkeydown='upperCaseF(this)' required>
				</div>
				<datalist id='deptlist2'>"; include '../input/deptcodesuggestion.php'; echo "</datalist>
	
			</div>
			<div class='field'>
				<label id='titleheader'>Section Name</label>
				<input type='text' name='sectname' list='sectlist' value='$sectname'>
			</div>
			<div class='ui checkbox'>
				<input type='checkbox' name='showlist' id='showlist' value='1'";
				if($showlist==1) echo "checked"; echo ">
				<label>Show this department in department list suggestion</label>
			</div>
			<datalist id='sectlist'>"; include '../input/sectsuggestion.php'; echo "</datalist>
		</form>		";

?>