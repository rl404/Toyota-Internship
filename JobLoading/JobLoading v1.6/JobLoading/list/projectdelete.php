<?php
	include "../db.php";

	$projectname = '';
	$projectcode = '';

	$selectSql = "SELECT * FROM project WHERE id=$_POST[projectid]";
	$selectResult = $conn->query($selectSql);
	while($row = mysqli_fetch_assoc($selectResult)) {
		$projectname = $row['projectName'];
		$projectcode = $row['projectCode'];
	}

	echo "<h3 class='ui header' id='titleheader3'>Project Code : <span style='color:white;'>".$projectcode."</span><br>";
	echo "Project Name : <span style='color:white;'>".$projectname."</span></div>";

	echo "<form action='projectdelete2.php' method='post' id='deleteprojectform'>	
			<input type='hidden' name='projectid' value='$_POST[projectid]'>
		</form>	";

?>