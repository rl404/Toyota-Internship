<html>
	<?php include "../header.php" ?>
	<div class="ui container">
		<h1 class='ui center aligned header' id='titleheader1'>TOYOTA STANDARD LIST</h1>
		<div class="ui divider"></div>
		<div class='ui grid'>
			<div class='two column row'>
				<div class='column'>

					<!-- Search box + title -->
					<div class='ui form'>
						<div class="inline fields">		
							<div class='field'><label id='titleheader2'>TS Number</label></div>		
						    <div class='field'>
						    	<div class='ui icon input'>
								    <input type="text" id='tsinputsearch'>
								    <i class="search link icon"></i>
								</div>
							</div>
						</div>					
					</div>

					<!-- TS list (on the left of the page) -->
					<div id='tsresultsearch'>
						<?php include "tssearch.php" ?>
					</div>
				</div>

				<!-- Supplier from selected TS (on the right of the page) -->
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