<?php
	include "../db.php";

	$projectname = '';
	$projectcode = '';
	$showlist = '';

	$selectSql = "SELECT * FROM project WHERE id=$_POST[projectid]";
	$selectResult = $conn->query($selectSql);
	while($row = mysqli_fetch_assoc($selectResult)) {
		$projectname = $row['projectName'];
		$projectcode = $row['projectCode'];
		$showlist = $row['showList'];
	}

	echo "<form action='projectedit2.php' method='post' class='ui form' id='editprojectform'>
			<input type='hidden' name='projectid' value='$_POST[projectid]'>
			<div class='two fields'>
				<div class='required field'>
					<label id='titleheader'>Project Code</label>
					<input type='text' name='projectcode' id='projectcode' value='$projectcode' onkeydown='upperCaseF(this)' required>
				</div>
				<div class='required field'>
					<label id='titleheader'>Project Name</label>
					<input type='text' name='projectname' value='$projectname' required>
				</div>
			</div>
			<div class='ui checkbox'>
				<input type='checkbox' name='showlist' id='showlist' value='1'";
				if($showlist==1) echo "checked"; echo ">
				<label>Show this project in project list suggestion</label>
			</div>
			<div id='projectcheck'></div>
		</form>	";

?>