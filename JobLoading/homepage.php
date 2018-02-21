<?php
	include "header.php";
	
	include "db.php";
	include "function.php";

	// Homepage
	echo "<div class='ui container' id='homepage'>";
		// echo "<div class='ui info message'>
		//   		<i class='close icon'></i>
		//   		<div class='header'>
		//    			Under Maintenance...
		//   		</div>
		//   		<p>Improving Job Name and Job Element for a better future.<br>
		//   		Some functions may not be working at the moment.</p>
		  		
		//   	</div>";

		if(notempty($_GET['ok'])){			
		  	echo "<div class='ui red message'>
		  		<i class='close icon'></i>
		  		<div class='header'>
		   			Your password is still default. Please change it on <a href='setting/setting.php'>Setting</a> page.
		  		</div>
		  	</div>";			  
		 }

	echo "	<h1 class='ui center aligned dividing header' id='titleheader'>JOB LOADING MANAGEMENT SYSTEM</h1>";
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
					<input id='jobyear' type='text' name='jobyear' size=5 value='";
	echo 			date('Y');
	echo 			"'>
				</div>
				<div class='field'>
					<img class='ui centered mini image' src='images/loading.gif' id='ajaxloading' style='display:none;'>
				</div>	
			</div>
		</form>";

	echo "<div id='summarytable'>";
	include "summary.php"; 
	echo "</div><div class='ui divider'></div>";

	echo "</div>";
?>