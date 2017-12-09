<html>
	<?php include "../header.php"; include "../function.php"; ?>

	<div class="ui container" style='width:50%;'>

		<?php
		if(notempty($_GET['ok'])){

			// If setting updated successfully
			if($_GET['ok'] == 1){
				echo "<div class='ui green message'>
			  		<i class='close icon'></i>
			  		<div class='header'>
			   			Added Successfully. 
			  		</div>
			  	</div>";
			}else if($_GET['ok'] == 2){
				echo "<div class='ui green message'>
			  		<i class='close icon'></i>
			  		<div class='header'>
			   			Updated Successfully. 
			  		</div>
			  	</div>";

			// If something wrong
			}else{
			  	echo "<div class='ui red message'>
			  		<i class='close icon'></i>
			  		<div class='header'>
			   			Proposal Not Found. 
			  		</div>
			  	</div>";
			}
		}
	  	?>

		<div class="ui segment">

			<!-- Title -->
			<h1 class="ui center aligned header" id='titleheader1'>VA PROPOSAL FORM</h1>

		</div>

		<div id='inputcontent'>

			<div class='ui segment'>
				<h2 class='ui center aligned dividing header' id='titleheader1'>Add or Update Idea</h2>
				<div class='ui basic segment'>
					<div class="ui two column middle aligned very relaxed stackable grid">						
						<div class="center aligned column">
							<a href='inputproposal2.php'>
								<div class="ui large green labeled icon button">
									<i class="add circle icon"></i>
									Add New Idea
								</div>
							</a>
						</div>
						<div class="ui vertical divider">
							Or
						</div>
						<div class="column">
							<form class="ui form" method='post' action="inputproposalsearch.php" >
								<div class="field">
									<label>Proposer or Manufacturer Number Search</label>
									<div class="ui left icon input">
										<input type="text" name='search' onkeydown="upperCaseF(this);">
										<i class="file text outline icon"></i>
									</div>
								</div>						
								<button type='submit' class="ui blue submit button">Go</div>
							</form>
						</div>				
					</div>
				</div>
			</div>

		</div>		
	</div>
	<div class="ui divider"></div>
</body>
</html>