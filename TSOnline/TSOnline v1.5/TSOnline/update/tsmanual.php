<html>
	<?php include "../header.php";
	include "../function.php"; ?>

	<div class="ui container"  id="input1form">
		<?php
			if(notempty($_GET['ok'])){
				if($_GET['ok'] == 1){
					echo "<div class='ui green message'>
				  		<i class='close icon'></i>
				  		<div class='header'>
				   			Added successfully. 
				  		</div>
				  	</div>";
				}else{
				  	echo "<div class='ui red message'>
				  		<i class='close icon'></i>
				  		<div class='header'>
				   			Something wrong. 
				  		</div>
				  	</div>";
				}
			}
	?>
	<div class="ui segment">		
		<h1 class="ui header" id='titleheader2'>Update TS Revision</h1>
		<form action="tsmanualupdate.php" method="post" class="ui form">
			<div class="two fields">
				<div class="required field">
					<label>TS no</label>
					<input type="text" list="tsno" name="tsno" id="inputts" onkeydown="upperCaseF(this);" required autofocus>
					<datalist id="tsno"><?php include "tssuggestion.php"; ?></datalist>
				</div>
				<div class="required field">
					<label>Revision</label>
					<input type="text" name="rev" id="inputrev" required>
				</div>
			</div>

			<div id="revisioncheck"></div>
			
			<div class="field">
				<label>TS Content</label>
				<textarea name="content" placeholder="TS Content ..."></textarea>
			</div>
			<div class="three fields">
				<div class="field">
					<label>Issued Date</label>
					<select class="ui search dropdown" name="reqday">
						<option value="">Day</option>
					<?php
						for($i=1;$i<32;$i++){
							if($i==date('d')){
								echo "<option value='$i' selected>$i</option>";
							}else{
								echo "<option value='$i'>$i</option>";
							}
						}
					?>
					</select>
				</div>
				<div class="field">
					<label>.</label>
					<select class="ui search dropdown" name="reqmonth">
						<option value="">Month</option>
					<?php
						for($i=1;$i<13;$i++){
							$reqMonth = date("F",mktime(0,0,0,$i,1,2011));
							if($i==date('m')){
								echo "<option value='$i' selected>$reqMonth</option>";
							}else{
								echo "<option value='$i'>$reqMonth</option>";
							}
						}
					?>
					</select>
				</div>
				<div class="field">
					<label>.</label>
					<?php
						echo "<input type='text' name='reqyear' value='";
						echo date('Y');
						echo "'>";
					?>
				</div>
			</div>
			<button class="ui red inverted button" type="submit">Submit</button>
		</form>	
	</div>
	</div>
	<div class="ui divider"></div>
</body>
</html>