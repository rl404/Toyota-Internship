<html>
	<?php 

	// Header
	include "../header.php";

	// Function
	include "../function.php"; 
	?>

	<div class="ui container"  id="input1form">
		<?php
			if(notempty($_GET['ok'])){
				
				// If updated successfully and email has been sent 
				if($_GET['ok'] == 1){
					echo "<div class='ui green message'>
				  		<i class='close icon'></i>
				  		<div class='header'>
				   			Updated successfully. Notification email has been sent.
				  		</div>
				  	</div>";
				
				// If there is something wrong.
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

			<!-- Title -->
			<h1 class="ui header" id='titleheader2'>Update TS Revision</h1>
			
			<!-- Form -->
			<form action="tsmanualupdate.php" method="post" class="ui form">
				<input type='hidden' name='type' value='2'>
				<div class="two fields">
					
					<!-- TS Number -->
					<div class="required field">
						<label>TS no</label>
						<input type="text" list="tsno" name="tsno" id="inputts" onkeydown="upperCaseF(this);" required autofocus>
						<datalist id="tsno"><?php include "tssuggestion.php"; ?></datalist>
					</div>
					
					<!-- Revision -->
					<div class="required field">
						<label>Revision</label>
						<input type="text" name="rev" id="inputrev" required>
					</div>
				</div>

				<!-- Revision checker -->
				<div id="revisioncheck"></div>
				
				<!-- TS Content -->
				<div class="field">
					<label>TS Content</label>
					<textarea name="content" placeholder="TS Content ..."></textarea>
				</div>
				
				<!-- Date -->
				<div class='field'>
					<label>Date</label>
					<div class="ui calendar calendarinput">						
						<div class="ui input left icon">
							<i class="calendar icon"></i>
							<input type='text' name='reqdate' placeholder='date' value="<?php echo date('Y-M-d'); ?>">
						</div>
					</div>
				</div>	

				<!-- Submit button -->
				<button class="ui red inverted button" type="submit">Submit</button>
			</form>	

		</div>
	</div>
	<div class="ui divider"></div>
</body>
</html>