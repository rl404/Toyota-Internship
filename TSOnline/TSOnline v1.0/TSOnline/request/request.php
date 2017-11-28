<html>
	<?php include "../header.php" ?>
	<div class="ui container">
		<h1 class='ui center aligned header'>NEW SUPPLIER REQUEST</h1>
		<div class="ui divider"></div>
		<div class='ui grid'>
			<div class='two column row'>
				<div class='column'>
				<form class='ui form' method='post' action='requestupdate.php'>
					<div class="field">
						<label>Supplier name</label>
						<input type="text" name="suppname" id="inputsupp" list="suppsuggestion" autofocus>
					</div>
					<datalist id="suppsuggestion"><div id="suppdatalist"></div></datalist>

					<div class="field">
						<label>TS no/Revision</label>
						<textarea name="tsnorev" 
						placeholder="TSxxxx/y&#10;TSxxxx/y&#10;TSxxxx/y" 
						id="inputtsrev" onkeydown="upperCaseF(this)"></textarea>				
					</div>
					<div class="three fields">
						<div class="field">
							<label>Date</label>
							<select class="ui search dropdown" name="reqday">
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
					<button type='submit' class='ui button'>Update</button>
				</form>
				</div>
				<div class='column'>				
					<div id="convertedtsrev"></div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>