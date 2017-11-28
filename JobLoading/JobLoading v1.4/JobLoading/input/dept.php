<html>
	<?php include "../header.php" ?>

	<div class="ui container">
	<div class="ui segment" id="input1form">
		<h1 class="ui header" id='titleheader2'>Add New Department/Section</h1>
		<form action="deptupdate.php" method="post" class="ui form">
			<div class='two fields'>
				<div class="field">
					<label id='titleheader'>Department Name</label>
					<input type="text" name="deptname" list="deptlist">
				</div>
				<datalist id='deptlist'><?php include 'deptnamesuggestion.php'; ?></datalist>
	
				<div class="field">
					<label id='titleheader'>Department Code</label>
					<input type="text" name="deptcode" list="deptlist2" onkeydown="upperCaseF(this)">
				</div>
				<datalist id='deptlist2'><?php include 'deptcodesuggestion.php'; ?></datalist>
	
			</div>
			<div class="field">
				<label id='titleheader'>Section Name</label>
				<input type="text" name="sectname" list="sectlist">
			</div>
			<datalist id='sectlist'><?php include 'sectsuggestion.php'; ?></datalist>
	
			<div class='field'>
				<button class="ui yellow button" type="submit">Submit</button>
			</div>
		</form>	
	</div>
	</div>
	<div class="ui divider"></div>
</body>
</html>