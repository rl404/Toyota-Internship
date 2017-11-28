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
			<input type="hidden" name="password" value="0000">
			<div class="field">
				<label id='titleheader'>Registration Number</label>
				<input type="text" name="noreg" id='noreginput'>
			</div>	
			<div id='staffcheck'></div>		
			<div class="field">
				<label id='titleheader'>Full Name</label>
				<input type="text" name="staffname">
			</div>

			<div class='fields'>
				<div class="thirteen wide field">
					<label id='titleheader'>Department Name</label>
					<input type="text" name="deptname" list='deptnamelist'>
					<datalist id='deptnamelist'><?php include 'deptnamesuggestion.php'; ?></datalist>
				</div>
				<div class="three wide field">
					<label id='titleheader'>Dept. Code</label>
					<input type="text" name="deptcode" list='deptlist' onkeydown="upperCaseF(this)"/>
					<datalist id='deptlist'><?php include 'deptcodesuggestion.php'; ?></datalist>
				</div>
			</div>

			<div class="field">
				<label id='titleheader'>Section Name</label>
				<input type="text" name="sectname" list='sectlist'>
				<datalist id='sectlist'><?php include 'sectsuggestion.php'; ?></datalist>
			</div>

			<div class='two fields'>
				<div class="thirteen wide field">
					<label id='titleheader'>Job Title</label>
					<input type="text" name="jobtitle" list='titlelist'>
					<datalist id='titlelist'><?php include 'titlesuggestion.php'; ?></datalist>
				</div>
				<div class="three wide field">
					<label id='titleheader'>Class</label>
					<input type="number" name="jobclass" value='0'>
				</div>
			</div>
			<div class='field'>
				<label id='titleheader'>*Default account password is 0000</label>
			</div>
			<button class="ui yellow button" type="submit">Submit</button>
		</form>	
	</div>
	</div>
	<div class="ui divider"></div>
</body>
</html>