<?php
	include "header.php";
	
	include "db.php";

	// Homepage
	echo "<div class='ui container' id='homepage'>
			<h1 class='ui center aligned dividing header' id='titleheader'>JOB LOADING MANAGEMENT SYSTEM</h1>";
	echo "<form class='ui form'>		
			<div class='inline fields'>
				<div class='field'>
					<label><h3 class='ui header' id='titleheader2'>Summary Month</h3></label>
					<select class='ui search inverted dropdown' id='jobmonth'>";
					for($i=1;$i<13;$i++){
						$reqMonth = date("F",mktime(0,0,0,$i,1,2011));
						if($i==date('m')){
							echo "<option value='$i' selected>$reqMonth</option>";
						}else{
							echo "<option value='$i'>$reqMonth</option>";
						}
					}
	echo "			</select>
				</div>
				<label>-</label>
				<div class='field'>
					<input id='jobyear' type='number' name='jobyear' size=5 value='";
	echo 			date('Y');
	echo 			"'>
				</div>
			</div>
		</form>";

	echo "<div id='summarytable'>";
	include "summary.php"; 
	echo "</div><div class='ui divider'></div>";

	echo "</div>";
?>