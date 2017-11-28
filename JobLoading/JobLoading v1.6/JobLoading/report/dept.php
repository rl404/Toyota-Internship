<html>
	<?php include "../header.php" ?>
	<div class="ui container" id='homepage'>
		<h1 class='ui center aligned dividing header' id='titleheader'>Report By Department</h1>

		<?php
		echo "<form class='ui form'>		
				<div class='inline fields'>
					<div class='field'>
						<input type='text' id='deptname' name='dept' list='deptlist' placeholder='Dept Code...'>
					</div>
					<div class='field'>
						<select class='ui search dropdown' id='deptmonth'>";
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
						<input id='deptyear' type='text' name='deptyear' size=5 value='";
		echo 			date('Y');
		echo 			"'>
					</div>
				</div>
			</form>";

		?>
	<div id='reportdepttable'><?php include 'depttable.php'; ?></div>
	<div class='ui divider'></div>
	</div>
	<datalist id='deptlist'><?php include '../input/deptcodesuggestion.php'; ?></datalist>
</body>
</html>