<html>
	<?php include "../header.php"; include "../function.php"; ?>

	<div class="ui container">

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

		<div class="ui fluid steps">
			<div class="step">
				<i class='green checkmark icon'></i>
		    	<div class="content">
		    	<?php 
		    		echo "<div class='title'>Update</div>
		    			<div class='description'>$row[teardownNo]</div>";		    	
			    ?>
		    	</div>
		  	</div>
		  	<?php 
		  		if($row['result'] == "O"){
		  			echo "<div class='step'>
		  					<i class='green checkmark icon'></i>
		  					<div class='content'>		  						
					      		<div class='title'>PE</div>
					      		<div class='description'>Processed</div>
					    	</div>
					  	</div>";
		  		}else if($row['result'] == "U"){
		  			echo "<div class='step'>
		  					<i class='yellow edit icon'></i>
		  					<div class='content'>
					      		<div class='title'>PE</div>
					      		<div class='description'>Understudy</div>
					    	</div>
					  	</div>";
		  		}else if($row['result'] == "D"){
		  			echo "<div class='step'>
		  					<i class='orange clone icon'></i>
		  					<div class='content'>
					      		<div class='title'>PE</div>
					      		<div class='description'>Duplicate</div>
					    	</div>
					  	</div>";
		  		}else if($row['result'] == "X"){
		  			echo "<div class='step'>
		  					<i class='red remove icon'></i>
		  					<div class='content'>
					      		<div class='title'>PE</div>
					      		<div class='description'>Rejected</div>
					    	</div>
					  	</div>";
		  		}else{
		  			echo "<div class='step'>
		  					<i class='help icon'></i>
		  					<div class='content'>
					      		<div class='title'>PE</div>
					      		<div class='description'>Unknown</div>
					    	</div>
					  	</div>";
		  		}
		  	?>
		  	
		  	<?php 
		  		if($row['status'] == "O"){
		  			echo "<div class='step'>
		  					<i class='green checkmark icon'></i>
		  					<div class='content'>
					      		<div class='title'>PPEQ</div>
					      		<div class='description'>Processed</div>
					    	</div>
					  	</div>";
		  		}else if($row['status'] == "U"){
		  			echo "<div class='step'>
		  					<i class='yellow edit icon'></i>
		  					<div class='content'>
					      		<div class='title'>PPEQ</div>
					      		<div class='description'>Understudy</div>
					    	</div>
					  	</div>";
		  		}else if($row['status'] == "X"){
		  			echo "<div class='step'>
		  					<i class='red remove icon'></i>
		  					<div class='content'>
					      		<div class='title'>PPEQ</div>
					      		<div class='description'>Rejected</div>
					    	</div>
					  	</div>";
		  		}else{
		  			echo "<div class='step'>
		  					<i class='help icon'></i>
		  					<div class='content'>
					      		<div class='title'>PPEQ</div>
					      		<div class='description'>Unknown</div>
					    	</div>
					  	</div>";
		  		}
		  	?>

		  	<?php 
		  		if($row['costReduction'] != "0"){
		  			echo "<div class='step'>
		  					<i class='green checkmark icon'></i>
		  					<div class='content'>
					      		<div class='title'>PuD</div>
					      		<div class='description'>Processed</div>
					    	</div>
					  	</div>";
		  		}else {
		  			echo "<div class='step'>
		  					<i class='help icon'></i>
		  					<div class='content'>
					      		<div class='title'>PuD</div>
					      		<div class='description'>Unknown</div>
					    	</div>
					  	</div>";
		  		}
		  	?>
		    
		    <?php 
		  		if($row['statusTMC'] == "O"){
		  			echo "<div class='step'>
		  					<i class='green checkmark icon'></i>
		  					<div class='content'>
					      		<div class='title'>EA + TMC</div>
					      		<div class='description'>Accepted</div>
					    	</div>
					  	</div>";
		  		}else if($row['statusTMC'] == "X"){
		  			echo "<div class='step'>
		  					<i class='red remove icon'></i>
		  					<div class='content'>
					      		<div class='title'>EA + TMC</div>
					      		<div class='description'>Rejected</div>
					    	</div>
					  	</div>";
		  		}else{
		  			echo "<div class='step'>
		  					<i class='help icon'></i>
		  					<div class='content'>
					      		<div class='title'>EA + TMC</div>
					      		<div class='description'>Unknown</div>
					    	</div>
					  	</div>";
		  		}
		  	?>
		</div>			

		<!-- Form -->
		<form action="inputupdate.php" method="post" class="ui form" enctype="multipart/form-data">
			<input type='hidden' name='step' value='2'>
			<?php if(!empty($_GET['id'])){
				echo "<input type='hidden' name='vaveid' value='$row[id]'>";
			}?>
			
			<div class='ui equal width grid'>
				<div class='column'>
					<div class='ui segment'>					
						<h2 class='ui blue center aligned dividing header'>Proposal Form</h2>
						<div class="required eight wide field">
							<label>Toyota Design Staff</label>
							<input type="text" name="designer" value='<?php echo $row['designer']?>' required>
						</div>

						<div class='two fields'>
							<div class="field">
								<label>Car Manufaturer's Number (Optional)</label>
								<input type="text" name="manufacturerno" value='<?php echo $row['manufacturerNo']?>' onkeydown="upperCaseF(this);">
							</div>
							<div class="required field">
								<label>Proposer Number</label>
								<input type="text" name="teardownno" value='<?php echo $row['teardownNo']?>' onkeydown="upperCaseF(this);" required>
							</div>
						</div>
							
						<h4 class='ui blue dividing header'>PART INFO</h4>	

						<div class='two fields'>
							<div class="required field">
								<label>Vehicle Model (Please enter only 1 model)</label>
								<input type="text" name="model" onkeydown="upperCaseF(this);" value='<?php echo $row['model']?>' required>
							</div>	
							<div class='required field'>
								<label>Piece / Month</label>
								<input type='text' name='piece' value='<?php echo $row['piece']?>' required>
							</div>
						</div>

						<div class="required field">
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
							<div class='required field' style='display: none;' id='otheridea'>
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
						<div class='two fields'>
							<div class='field'>
							<?php
								// $filename = "../images/design/$row[id]old0.png";
								// if (file_exists($filename)) {
									echo "<img src='../images/design/$row[id]old0.png' alt='No uploaded image' width='100%' id='outputold'>";
								// }
							?>
							</div>	
							<div class='field'>
							<?php
								// $filename = "../images/design/$row[id]new0.png";
								// if (file_exists($filename)) {
									echo "<img src='../images/design/$row[id]new0.png'alt='No uploaded image' width='100%' id='outputnew'>";
								// }
							?>
							</div>	
						</div>
						<div class='two fields'>
							<div class='field' data-tooltip="Only .jpg .png .jpeg allowed">				
								<input type='file' name='scanold[]' id='scanold' accept=".png, .jpg, .jpeg" onchange='loadFileOld(event)' multiple>
							</div>
							<div class='ui basic icon button' id='removeold'><i class='red remove icon'></i></div><div id='ajaxold'></div>

							<div class='field' data-tooltip="Only .jpg .png .jpeg allowed">
								<input type='file' name='scannew[]' id='scannew' accept=".png, .jpg, .jpeg" onchange='loadFileNew(event)' multiple>
							</div>
							<div class='ui basic icon button' id='removenew'><i class='red remove icon'></i></div><div id='ajaxnew'></div>
						</div>

						<div class="eight wide field">
							<label>Photo Number</label>
							<input type="text" name="photono" value='<?php echo $row['photoNo']?>'>
						</div>

						<h4 class='ui blue dividing header'>PROPOSER INFO</h4>

						<div class='two fields'>
							<div class="thirteen wide required field">
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
							    		echo "<input type='text' name='proposerdate' value='$row[proposerDate]'>";
							    	}else{
							    		echo "<input type='text' name='proposerdate' placeholder='date'>";
							    	}
							    ?>
							  </div>
							</div>
						</div>					
					</div>
				</div>
				<div class='column'>
					<div class='ui segment'>
						<h2 class='ui yellow center aligned dividing header'>PE</h2>

						<div class='two fields'>
							<div class="field">
								<label>Proposal Rank</label>
								<input type="text" name="proposalrank" value='<?php echo $row['proposalRank']?>' placeholder="1">
							</div>

							<div class="required field">
								<label>PIC</label>
								<input type="text" name="pic" value='<?php echo $row['pic']?>' placeholder="Body" required>
							</div>
						</div>

						<div class='two fields'>
							<div class="required field">
								<label>Result</label>
								<select class="ui search dropdown" name="result" required>
									<option value='<?php echo $row['result']?>'><?php echo $row['result']?></option>
									<option value='O'>O: Accepted by ED</option>
									<option value='U'>U: Understudy</option>
									<option value='D'>D: Duplicate</option>
									<option value='X'>X: Rejected</option>
								</select>
							</div>
							
							<div class="field">
								<label>Rejection Category</label>
								<input type="text" name="rejection" value='<?php echo $row['rejection']?>' placeholder="S">
							</div>
						</div>

						<!-- Submit button -->
						<button class="ui yellow inverted button" type="submit">Submit</button>
					</div>	
				</div>
			</div>
		</form>	
	</div>
	<div class='ui divider'></div>
</body>
</html>