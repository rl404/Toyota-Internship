<?php
	/*

		Link to call pdf frame

	*/

	// If set today as delivery date
	if($_POST['setdate'] == 1){
		include "../db.php";

		// Get today date
		$today = date("Y-m-d");

		$updateSql = "UPDATE ts SET sendDate='$today' WHERE suppName='$_POST[supplier]' and reqDate='$_POST[reqdate]' ";

		if ($conn->query($updateSql) === TRUE) {
			echo "<div class='ui green message'>
				  		<i class='close icon'></i>
				  		<div class='header'>
				   			Delivery date updated successfully. 
				  		</div>
				  	</div>";
		} else {
			echo "<div class='ui red message'>
				  		<i class='close icon'></i>
				  		<div class='header'>".
				   			$conn->error."
						</div>
				  	</div>";
		}
	}

	echo "<iframe height=100% width=100%
	src='export2pdf.php?supplier=".$_POST['supplier']."&";

	// Combine submitted value to comma delimiter string
	$tsstring = "ts=";
	$revstring = "rev=";
	$modelstring = "model=";
	$partstring = "part=";

	for($i = 0; $i < count($_POST['ts']); $i++){
		$tsstring = $tsstring.",".$_POST['ts'][$i];

		if(empty($_POST['rev'][$i])){
			$_POST['rev'][$i] = " ";
		}
		$revstring = $revstring.",".$_POST['rev'][$i];

		if(empty($_POST['model'][$i])){
			$_POST['model'][$i] = " ";
		}
		$modelstring = $modelstring.",".$_POST['model'][$i];

		if(empty($_POST['part'][$i])){
			$_POST['part'][$i] = " ";
		}
		$partstring = $partstring.",".$_POST['part'][$i];
	}

	echo "$tsstring&$revstring&$modelstring&$partstring";

	if(!empty($_POST['day'])){
		echo "&day=".$_POST['day']."&month=".$_POST['month']."&year=".$_POST['year'];
	}

	echo "'></iframe>";

?>