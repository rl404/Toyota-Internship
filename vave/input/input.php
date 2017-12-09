<html>
	<?php include "../header.php"; include "../function.php"; ?>

	<div class="ui container" style='width:50%;'>

		<?php
		if(notempty($_GET['ok'])){

			// If setting updated successfully
			if($_GET['ok'] == 0){
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
			<div class="ui ordered fluid steps">
				<div class="active step">
			    	<div class="content">
			      	<div class="title">Search</div>
			    	</div>
			  	</div>
			  	<div class="disabled step">
			    	<div class="content">
			      	<div class="title">PE</div>
			    	</div>
			  	</div>
			 	<div class="disabled step">
			    	<div class="content">
			      		<div class="title">PPEQ</div>
			    	</div>
			  	</div>
			  	<div class="disabled step">
			    	<div class="content">
			      		<div class="title">PuD</div>
			    	</div>
			  	</div>
			  	<div class="disabled step">
			   		<div class="content">
			      		<div class="title">EA</div>
			    	</div>
			 	</div>
			</div>

			<div class='ui segment'>
				<h2 class='ui center aligned header'>Search Proposal Form
					<div class='sub header'>Teardown or Manufacture Number</div></h2>
				<div class='ui centered grid'>
					<div class='two column centered row'>
						<div class='column'>
							<form class="ui form" method='post' action="inputsearch.php" >
								<div class="field">
									<div class="ui left icon input">
										<input type="text" name='search' onkeydown="upperCaseF(this);" autofocus>
										<i class="file text outline icon"></i>
									</div>
								</div>						
								<button type='submit' class="ui blue fluid button">Go</button>
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