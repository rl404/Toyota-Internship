<html>
	<?php include "../header.php";
	include "../function.php"; ?>
	<div class="ui container">
		<h1 class='ui center aligned header' id='titleheader2'>MANUAL COVER LETTER CREATOR</h1>
		<div class="ui divider"></div>
		<div class='ui grid'>
			<div class='two column row'>
				<div class='column'>
					<form class='ui form'>
						<div class="field">
							<label>Supplier name</label>
							<input type="text" name="suppname" id="inputsupp" list="suppsuggestion" autofocus required>
						</div>
						<div class="field">
							<label>PIC name</label>
							<input type="text" name="supppic" id="inputpic">
						</div>
						<datalist id="suppsuggestion"><?php include "../request/requestsuggestion.php";?></datalist>

						<table class='ui center aligned sortable table' id='newrow'>
							<thead><tr>
								<th id='tableheader'>TS Number</th>
								<th id='tableheader'>Revision</th>
								<th id='tableheader'>Model</th>
								<th id='tableheader'>Part No.</th>
							</tr></thead>
							<tr>
								<td><input type='text' name='tsno' value='' id='inputts' class='inputtable' onkeydown='upperCaseF(this)' list='tsno'></td>
								<td><input type='text' name='rev' value='' id='inputrev' class='center aligned inputtable' onkeydown='upperCaseF(this)'></td>
								<td><input type='text' name='model' value='' id='inputmodel' class='center aligned inputtable'></td>
								<td><input type='text' name='part' value='' id='inputpart' class='center aligned inputtable' onkeydown='upperCaseF(this)'></td>
							</tr>

							<tr id='emptyrow' style='display:none;'>
								<td><input type='text' name='tsno' value='' id='inputts' class='inputtable' onkeydown='upperCaseF(this)' list='tsno'></td>
								<td><input type='text' name='rev' value='' id='inputrev' class='center aligned inputtable' onkeydown='upperCaseF(this)'></td>
								<td><input type='text' name='model' value='' id='inputmodel' class='center aligned inputtable'></td>
								<td><input type='text' name='part' value='' id='inputpart' class='center aligned inputtable' onkeydown='upperCaseF(this)'></td>
							</tr>
						</table>
						<div class='field'>	
							<div tabindex='0' class='ui fluid vertical basic animated button' onclick='addNewRow()'>
							  	<div class='visible content'><i class='plus icon'></i></div>
							  	<div class='hidden content'>Add new row</div>
						 	</div>
						 </div>
						
						<div class="three fields">
							<div class="field">
								<label>Date</label>
								<select class="ui search dropdown" name="reqday" id='reqday'>
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
								<select class="ui search dropdown" name="reqmonth" id='reqmonth'>
								<?php
									for($i=1;$i<13;$i++){

										// Convert month to string
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
									echo "<input type='text' name='reqyear' id='reqyear' value='";
									echo date('Y');
									echo "'>";
								?>
							</div>						
						</div>

						<div class='field'>	
							<button class='ui red inverted button' id='coverlettercreatebutton'>Create</button>
						</div>
					</form>
				</div>

				<div class='column'>
					<div id='manualconvert'></div>
				</div>
			</div>
		</div>
		
	</div>

	<datalist id='tsno'><?php include "../update/tssuggestion.php"; ?></datalist>
</body>
</html>