<html>
	<?php include "../header.php" ?>

	<div class="ui container">
	<div class="ui segment" id="input1form">
		<h1 class="ui header" id='titleheader2'>Add New Job</h1>
		<form action="jobupdate.php" method="post" class="ui form">			
			<div class="field">
				<label id='titleheader'>Job Name</label>
				<input type="text" name="jobname">
			</div>
			<div class="field">
				<label id='titleheader'>Dept. Code</label>
				<input type="text" name="deptcode" list='deptlist' onkeydown="upperCaseF(this)"/>
			</div>
			<datalist id='deptlist'><?php include 'deptcodesuggestion.php'; ?></datalist>
			<div class="field">
				<label id='titleheader'>Job Description</label>
				<textarea name="jobdesc" placeholder="Description ..."></textarea>
			</div>
			
			<button class="ui yellow button" type="submit">Submit</button>
		</form>	
	</div>
	</div>
	<div class="ui divider"></div>
</body>
</html>