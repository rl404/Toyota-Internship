<html>
	<?php 
	// Header
	include "../header.php";

	// Function
	include "../function.php"; 
	?>

	<div class="ui container">
		<?php
			if(notempty($_GET['ok'])){

				// If added successfully and email has been sent.
				if($_GET['ok'] == 1){
					echo "<div class='ui green message'>
				  		<i class='close icon'></i>
				  		<div class='header'>
				   			Added successfully. Notification email has been sent.
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

		<!-- Title -->
		<h1 class="ui header" id='titleheader2'>
			Update TS Revision
		</h1>

		<!-- Form -->
		<form class="ui form">

			<!-- Textarea for pasting TS from email -->
			<div class="field">
				<label>Paste the TS new revision here:</label>
				<textarea name="tsno" id="tsarea"
				placeholder="･TSxxxx　REV.x　Content"></textarea>
			</div>

			<!-- Convert button -->
			<button class='ui red inverted button' type="submit" id="convertts">Convert</button>
		</form>		
		
		<!-- Bottom title -->
		<h5 class='ui header'>Converted TS:</h5>

		<!-- Converted TS result -->
		<div id="convertedts"></div>
	</div>
	<div class="ui divider"></div>
</body>
</html>