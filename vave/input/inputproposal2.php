<html>
	<?php include "../header.php"; include "../function.php"; ?>

	<div class="ui container" style='width:50%;'>

		<?php
		if(notempty($_GET['ok'])){

			// If setting updated successfully
			if($_GET['ok'] == 1){
				echo "<div class='ui green message'>
			  		<i class='close icon'></i>
			  		<div class='header'>
			   			Proposal Found. 
			  		</div>
			  	</div>";

			// If something wrong
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

	  	<?php
			include "../db.php";
			$result = mysqli_query($conn,"SELECT * FROM vave WHERE id='$_GET[id]'");
			$row = mysqli_fetch_array($result);
		?>

		<div class="ui segment">
			<h1 class="ui center aligned header" id='titleheader1'>VA PROPOSAL FORM</h1>
		</div>

		<!-- Form -->
		<form action="inputproposalupdate.php" method="post" class="ui form">
			<input type='hidden' name='step' value='2'>
			<?php 
				if(!empty($_GET['id'])){
					echo "<input type='hidden' name='vaveid' value='$_GET[id]'>";
				} 
			?>
			
			<div class='ui segment'>					
				
				<div class="eight wide field">
					<label>Toyota Design Staff</label>
					<input type="text" name="designer" value='<?php echo $row['designer']?>'>
				</div>

				<div class='two fields'>
					<div class="field">
						<label>Car Manufaturer's Number</label>
						<input type="text" name="manufacturerno" id='manufacturerno' value='<?php echo $row['manufacturerNo']?>' onkeydown="upperCaseF(this);">
					</div>
					<div class="required field">
						<label>Proposer Number</label>
						<input type="text" name="teardownno" id='proposerno' value='<?php echo $row['teardownNo']?>' onkeydown="upperCaseF(this);" list='proposerlist' required>
						<datalist id='proposerlist'>
							<option value="VA17-TMMIN-TD-"></option>
							<option value="VA17-IMV-EDCH-"></option>
							<option value="VA17-IMV-EDSI-"></option>
						</datalist>
					</div>
				</div>
				<div class='two fields'>
					<div class="field" id='checkmanufacturer' style='color:red;'>
					</div>
					<div class="field" id='checkproposer' style='color:red;'>
					</div>
				</div>
					
				<h4 class='ui blue dividing header'>PART INFO</h4>	

				<div class="required eight wide field">
					<label>Vehicle Model (Please enter only 1 model)</label>
					<input type="text" name="model" onkeydown="upperCaseF(this);" value='<?php echo $row['model']?>' required>
				</div>	

				<div class="field">
					<table class='ui very compact celled selectable center aligned table' id='newrow'>
						
						<!-- Table header -->
						<thead><tr>
							<th class='center aligned four wide' id='tableheader'>Part No*</th>
							<th class='center aligned' id='tableheader'>Part Name*</th>
						</tr></thead>							
						
						<?php 
							$selectSql2 = "SELECT * FROM attachment where proposerId='$row[id]' order by partNo";
							$selectResult2 = $conn->query($selectSql2);
							if($selectResult2->num_rows < 1){

								echo "<tr>
									<td><input class='center aligned inputtable' name='partno[]' type='text' value='$row[partNo]' onkeydown='upperCaseF(this)' required></td>
									<td><input class='center aligned inputtable' name='partname[]' type='text' value='$row[partName]' required></td>
								</tr>";

							}else{
								echo "<input type='hidden' name='multipart' value='1'>";
								while($row2 = mysqli_fetch_assoc($selectResult2)) {
									echo "<input type='hidden' name='partid[]' value='$row2[id]'>";
									echo "<tr>
										<td><input class='center aligned inputtable' name='partno[]' type='text' value='$row2[partNo]' onkeydown='upperCaseF(this)'</td>
										<td><input class='center aligned inputtable' name='partname[]' type='text' value='$row2[partName]'></td>
									</tr>";
								}
							
							}
						?>
						<!-- For cloning -->
						<tr id='emptyrow' style="display:none;">
							<input type='hidden' name='partid[]' value='-1'>
							<td><input class='center aligned inputtable' name='partno[]' type='text' onkeydown="upperCaseF(this)"></td>
							<td><input class='center aligned inputtable' name='partname[]' type='text'></td>
						</tr>						
					</table>				
				</div>

				<!-- Button to add new row -->
				<div class='field'>	<div tabindex="0" class="ui fluid vertical basic animated button" onclick="addNewRow()">
					  	<div class="visible content"><i class='plus icon'></i></div>
					  	<div class="hidden content">
					    	Add new row
					 	</div>
				 	</div>
				</div>			

				<h4 class='ui blue dividing header'>IDEA INFO</h4>
				
				<div class='two fields'>
					<div class="required field">
						<label>Idea Type</label>
						<select class="ui search dropdown" name="ideatype" id='otherideatype' required>
							<option value='<?php echo $row['ideaType']?>'><?php echo $row['ideaType']?></option>
							<option value='Commonize'>Commonize</option>
							<option value='Design Change'>Design Change</option>
							<option value='Disuse'>Disuse/Removal/Deletion</option>
							<option value='Localization'>Localization</option>
							<option value='Material Change'>Material Change</option>						
							<option value='Process Change'>Process Change</option>
							<option value='Source Change'>Source Change</option>
							<option value='Other'>Other</option>
						</select>					
					</div>
					<div class='field' style='display: none;' id='otheridea'>
						<label>Other Idea:</label>
						<input type="text" name="ideatype2" value='<?php echo $row['ideaType2']?>'>
					</div>
				</div>

				<div class='two fields'>
					<div class="field">
						<label>Current Design</label>
						<textarea name="ideaold" placeholder="Old Design ..."><?php echo $row['ideaOld']?></textarea>
					</div>	
					<div class="field">
						<label>New Design</label>
						<textarea name="ideanew" placeholder="New Design ..."><?php echo $row['ideaNew']?></textarea>
					</div>	
				</div>

				<div class="eight wide field">
					<label>Photo Number</label>
					<input type="text" name="photono" value='<?php echo $row['photoNo']?>'>
				</div>

				<h4 class='ui blue dividing header'>PROPOSER INFO</h4>

				<div class='two fields'>
					<div class="required thirteen wide field">
						<label>Proposer Name</label>
						<input type="text" name="proposername" value='<?php echo $row['proposerName']?>' required>
					</div>	
					<div class="three wide field">
						<label>Company</label>
						<input type="text" name="proposerdiv" value='<?php echo $row['proposerDiv']?>' onkeydown="upperCaseF(this)">
					</div>	
				</div>

				<div class='required field'>
					<label>Proposed Date</label>
					<div class="ui calendar calendarinput">						
					  <div class="ui input left icon">
					    <i class="calendar icon"></i>
					    <?php
					    	if($row['proposerDate'] != "0000-00-00"){
					    		echo "<input type='text' name='proposerdate' placeholder='date' value='$row[proposerDate]' required>";
					    	}else{
					    		echo "<input type='text' name='proposerdate' placeholder='date' required>";
					    	}
					    ?>
					  </div>
					</div>
				</div>

				<!-- Submit button -->
				<button class="ui blue inverted button" type="submit">Submit</button>
			</div>					

		</form>	
	</div>
	<div class='ui divider'></div>
</body>
</html>