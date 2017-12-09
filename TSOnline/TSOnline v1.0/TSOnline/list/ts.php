<html>
	<?php include "../header.php" ?>
	<div class="ui container">
		<h1 class='ui center aligned header'>TOYOTA STANDARD LIST</h1>
		<div class="ui divider"></div>
		<div class='ui grid'>
			<div class='two column row'>
				<div class='column'>
					<form class='ui form'>
						<div class="inline fields">		
							<div class='field'><label>TS Number</label></div>		
						    <div class='field'>
						    	<div class='ui icon input'>
								    <input type="text" id='tsinputsearch'>
								    <i class="search link icon"></i>
								</div>
							</div>
						    <!-- <div class='field'><button class='ui button' type="submit">Search</button></div> -->
						</div>					
					</form>

					<div id='tsresultsearch'>
						<?php include "tssearch.php" ?>
					</div>

				</div>
				<div class='column'>
					<div id='tsxsupplierresult'>
					</div>
				</div>
			</div>
		</div>	
	</div>
	<div class="ui divider"></div>
</body>
</html>