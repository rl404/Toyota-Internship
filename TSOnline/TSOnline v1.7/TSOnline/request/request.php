<html>
	<?php include "../header.php";
	include "../function.php"; ?>
	<div class="ui container">
		<?php
			// If added successfully
			if(notempty($_GET['ok'])){
				if($_GET['ok'] == 1){
					echo "<div class='ui green message'>
				  		<i class='close icon'></i>
				  		<div class='header'>
				   			Added successfully. 
				  		</div>
				  	</div>";

				// If there is error
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

		<!-- Title -->
		<h1 class='ui center aligned header' id='titleheader2'>NEW SUPPLIER REQUEST</h1>
		<div class="ui divider"></div>
		<div class='ui grid'>
			<div class='two column row'>
				<div class='column'>
				
				<!-- Form -->
				<form class='ui form' method='post' action='requestupdate.php'>
					
					<!-- Supplier name textbox + datalist -->
					<div class="field">
						<label>Supplier name</label>
						<input type="text" name="suppname" id="inputsupp" list="suppsuggestion" autofocus required>
					</div>
					<datalist id="suppsuggestion"><?php include "requestsuggestion.php";?></datalist>

					<!-- TS input table -->
					<div class="field">
						<table class='ui compact sortable selectable definition center aligned table' id='newrow'>
							
							<!-- Table header -->
							<thead class='full-width'><tr>
								<th class='center aligned' id='tableheader'>TS Number</th>
								<th class='center aligned' id='tableheader'>Rev.</th>
								<th class='center aligned' id='tableheader'>Model</th>
								<th class='center aligned' id='tableheader'>Part Number</th>
							</tr></thead>							
							
							<!-- Empty input -->
							<tr>
								<td><input class='inputtable' name='inputts[]' id='inputts' type='text' onkeydown="upperCaseF(this)" list="tssuggestion" required></td>
								<td><input class='center aligned inputtable' name='inputrev[]' id='inputrev' type='text' onkeydown="upperCaseF(this)" required></td>
								<td><input class='center aligned inputtable' name='inputmodel[]' type='text' onkeydown="upperCaseF(this)"></td>
								<td><input class='center aligned inputtable' name='inputpart[]' type='text' onkeydown="upperCaseF(this)"></td>
							</tr>	

							<!-- For cloning -->
							<tr id='emptyrow' style="display:none;">
								<td><input class='inputtable' name='inputts[]' id='inputts' type='text' onkeydown="upperCaseF(this)" list="tssuggestion"></td>
								<td><input class='center aligned inputtable' name='inputrev[]' id='inputrev' type='text' onkeydown="upperCaseF(this)"></td>
								<td><input class='center aligned inputtable' name='inputmodel[]' type='text' onkeydown="upperCaseF(this)"></td>
								<td><input class='center aligned inputtable' name='inputpart[]' type='text' onkeydown="upperCaseF(this)"></td>
							</tr>						
						</table>
						<datalist id="tssuggestion"><?php include "../update/tssuggestion.php"; ?></datalist>						
					</div>

					<!-- Button to add new row -->
					<div class='field'>	<div tabindex="0" class="ui fluid vertical basic animated button" onclick="addNewRow()">
						  	<div class="visible content"><i class='plus icon'></i></div>
						  	<div class="hidden content">
						    	Add new row
						 	</div>
					 	</div>
					 </div>

					<!-- Day, Month, Year input -->
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
					<button type='submit' class='ui inverted red button'>Update</button>
				</form>
				</div>

				<!-- TS and rev checker table (on the right of the page) -->
				<div class='column'>				
					<div id="convertedtsrev"></div>
				</div>
			</div>
		</div>
	</div>	
</body>
</html>