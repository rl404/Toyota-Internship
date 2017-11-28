<html>
	<?php include "../header.php" ?>

	<div class="ui container">
	<div class="ui segment" id="input1form">
		<h1 class="ui header">Update TS Revision</h1>
		<form action="tsmanualupdate.php" method="post" class="ui form">
			<div class="two fields">
				<div class="required field">
					<label>TS no</label>
					<input type="text" list="tsno" name="tsno" id="inputts" onkeydown="upperCaseF(this)">
					<datalist id="tsno"><div id="tsdatalist"></div></datalist>
				</div>
				<div class="required field">
					<label>Revision</label>
					<input type="text" name="rev" id="inputrev">
				</div>
			</div>

			<div id="revisioncheck"></div>
			
			<div class="required field">
				<label>TS Content</label>
				<textarea name="content" placeholder="TS Content ..."></textarea>
			</div>
			<div class="three fields">
				<div class="required field">
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
							if($i==date('m')){
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
					<?php
						echo "<input type='text' name='reqyear' value='";
						echo date('Y');
						echo "'>";
					?>
				</div>
			</div>
			<button class="ui button" type="submit">Submit</button>
		</form>	
	</div>
	</div>
	<div class="ui divider"></div>
</body>
</html>