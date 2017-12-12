<html>
	<?php include "../header.php";
	include "../function.php"; ?>
	<div class="ui container" id='input1form'>
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
		<h1 class='ui center aligned header' id='titleheader2'>DELIVER UPDATE</h1>
		<div class="ui divider"></div>
		
				
		<!-- Form -->
		<form class='ui form' method='post' action='deliverupdate.php'>
			
			<!-- Supplier name textbox + datalist -->
			<div class="field">
				<label>Supplier name</label>
				<input type="text" name="suppname" id="inputsupp" list="suppsuggestion" autofocus required>
			</div>
			<datalist id="suppsuggestion"><?php include "requestsuggestion.php";?></datalist>

			<div class='field'>
				<label>Receiver</label>
				<input type='text' name='receiver'>
			</div>

			<!-- TS input table -->
			<div class="field">
				<table class='ui compact sortable selectable definition center aligned table' id='newrow'>
					
					<!-- Table header -->
					<thead class='full-width'><tr>
						<th class='center aligned' id='tableheader'>TS Number</th>
						<th class='center aligned' id='tableheader'>Rev.</th>
					</tr></thead>							
					
					<!-- Empty input -->
					<tr>
						<td><input class='inputtable' name='inputts[]' id='inputts' type='text' onkeydown="upperCaseF(this)" list="tssuggestion" required></td>
						<td><input class='center aligned inputtable' name='inputrev[]' id='inputrev' type='text' onkeydown="upperCaseF(this)" required></td>
					</tr>	

					<!-- For cloning -->
					<tr id='emptyrow' style="display:none;">
						<td><input class='inputtable' name='inputts[]' id='inputts' type='text' onkeydown="upperCaseF(this)" list="tssuggestion"></td>
						<td><input class='center aligned inputtable' name='inputrev[]' id='inputrev' type='text' onkeydown="upperCaseF(this)"></td>
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
			<div class='field'>
				<label>Request Date</label>
				<div class="ui calendar calendarinput">						
					<div class="ui input left icon">
						<i class="calendar icon"></i>
						<input type='text' name='reqdate' placeholder='date' value="<?php echo date('Y-M-d'); ?>">
					</div>
				</div>
			</div>						
			<button type='submit' class='ui inverted red button'>Update</button>
		</form>

	</div>	
</body>
</html>