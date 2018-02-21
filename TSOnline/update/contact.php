<html>
	<?php 
	// Header
	include "../header.php";

	// Function
	include "../function.php"; 
	?>

	<div class="ui container" id='input1form'>
		<?php
			if(notempty($_GET['ok'])){

				// If added successfully and email has been sent.
				if($_GET['ok'] == 1){
					echo "<div class='ui green message'>
				  		<i class='close icon'></i>
				  		<div class='header'>
				   			Updated successfully.
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

		<div class='ui segment'>

			<!-- Title -->
			<h1 class="ui dividing header" id='titleheader2'>
				Update Contact Data
			</h1>
		
			<form class='ui form' action="contactupdate.php" method="post" >
				<!-- Supplier name textbox + datalist -->
				<div class="required field">
					<label>Supplier name</label>
					<input type="text" name="suppname" list="suppsuggestion" autofocus required>
				</div>
				<datalist id="suppsuggestion"><?php include "../request/requestsuggestion.php";?></datalist>

				<div class="required field">
					<label>Contact Person name</label>
					<input type="text" name="staffname" required>
				</div>

				<div class="field">
					<label>Department Name</label>
					<input type="text" name="deptname">
				</div>

				<div class="field">
					<label>Email</label>
					<input type="text" name="email">
				</div>

				<button type='submit' class='ui inverted red button'>Submit</button>
			</form>
		</div>
	</div>
</body>
</html>