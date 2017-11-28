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