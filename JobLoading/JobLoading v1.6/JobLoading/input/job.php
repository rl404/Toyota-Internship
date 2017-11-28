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
		<h1 class="ui header" id='titleheader2'>Add New Job</h1>
		<form action="jobupdate.php" method="post" class="ui form">			
			<div class="required field">
				<label id='titleheader'>Job Name</label>
				<input type="text" name="jobname" required>
			</div>
			<div class="required field">
				<label id='titleheader'>Dept. Code</label>
				<input type="text" name="deptcode" list='deptlist' onkeydown="upperCaseF(this)" required/>
			</div>
			<datalist id='deptlist'><?php include 'deptcodesuggestion.php'; ?></datalist>
			<div class="field">
				<label id='titleheader'>Job Description / Element</label>
				<textarea name="jobdesc" placeholder="Description ..."></textarea>
			</div>
			<div class="field">
				<label id='titleheader'>Note: you can use "enter" or ";" to enter new line in job description.</label>
			</div>
			
			<button class="ui yellow button" type="submit">Submit</button>
		</form>	
	</div>
	</div>
	<div class="ui divider"></div>
</body>
</html>