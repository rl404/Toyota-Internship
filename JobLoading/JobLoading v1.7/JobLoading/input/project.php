<html>
	<?php include "../header.php";
		include "../function.php"; ?>

	<div class="ui container"  id="input1form">
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
		<h1 class="ui header" id='titleheader2'>Add New Project</h1>
		<form action="projectupdate.php" method="post" class="ui form">
			<div class='two fields'>
				<div class="required field">
					<label id='titleheader'>Project Code</label>
					<input type="text" name="projectcode" id='projectcode' onkeydown="upperCaseF(this)" required>
				</div>
				<div class="required field">
					<label id='titleheader'>Project Name</label>
					<input type="text" name="projectname" required>
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