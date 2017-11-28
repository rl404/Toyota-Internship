<html>
	<?php include "../header.php" ?>

	<div class="ui container">
	<div class="ui segment" id="input1form">
		<h1 class="ui header" id='titleheader2'>Add New Project</h1>
		<form action="projectupdate.php" method="post" class="ui form">
			<div class='two fields'>
				<div class="field">
					<label id='titleheader'>Project Code</label>
					<input type="text" name="projectcode" id='projectcode' onkeydown="upperCaseF(this)">
				</div>
				<div class="field">
					<label id='titleheader'>Project Name</label>
					<input type="text" name="projectname">
				</div>
			</div>
			<div id='projectcheck'></div>
			<div class='field'>
				<button class="ui yellow button" type="submit">Submit</button>
			</div>
		</form>	
	</div>
	</div>
	<div class="ui divider"></div>
</body>
</html>