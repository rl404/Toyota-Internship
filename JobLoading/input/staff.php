<html>
	<?php include "../header.php";
		include "../function.php"; ?>

	<div class="ui container" id="input1form">
		<?php
		if(notempty($_GET['ok'])){
			if($_GET['ok'] == 1){
				echo "<div class='ui green message'>
			  		<i class='close icon'></i>
			  		<div class='header'>
			   			Added successfully. 
			  		</div>
			  	</div>";
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
		<h1 class="ui header" id='titleheader2'>Add New Staff</h1>
		<form action="staffupdate.php" method="post" class="ui form">
			<input type="hidden" name="password" value="1234">
			<div class="required field">
				<label id='titleheader'>Registration Number</label>
				<input type="text" name="noreg" id='noreginput' required>
			</div>	
			<div id='staffcheck'></div>		
			<div class="required field">
				<label id='titleheader'>Full Name</label>
				<input type="text" name="staffname" required>
			</div>

			<div class='field'>
				<label id='titleheader'>Email</label>
				<input type='text' name='email'>
			</div>

			<div class='fields'>
				<div class="thirteen wide field">
					<label id='titleheader'>Department Name</label>
					<select name='deptname'>";
						<?php include 'deptnamesuggestion.php'; ?>
					</select>
				</div>
				<div class="three wide field">
					<label id='titleheader'>Dept. Code</label>
					<select name='deptcode'>";
						<?php include 'deptcodesuggestion.php'; ?>
					</select>
				</div>
			</div>

			<div class="field">
				<label id='titleheader'>Section Name</label>
				<select name='sectname'>";
					<?php include 'sectsuggestion.php'; ?>
				</select>
			</div>

			<div class="field">
				<label id='titleheader'>Job Title</label>
				<input type="text" name="jobtitle" list='titlelist'>
				<datalist id='titlelist'><?php include 'titlesuggestion.php'; ?></datalist>
			</div>
			
			<div class='field'>
				<label id='titleheader'>*Default account password is 1234</label>
			</div>
			<button class="ui yellow button" type="submit">Submit</button>
		</form>	
	</div>
	</div>
	<div class="ui divider"></div>
</body>
</html>