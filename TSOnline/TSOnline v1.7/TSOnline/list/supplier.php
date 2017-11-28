<html>
	<?php include "../header.php" ?>
	<div class="ui container">
		<h1 class='ui center aligned header' id='titleheader1'>SUPPLIER LIST</h1>
		<div class="ui divider"></div>
		<div class='ui grid'>
			<div class='two column row'>
				<div class='column'>

					<!-- Search box + title -->
					<div class='ui form'>
						<div class="inline fields">		
							<div class='field'><label id='titleheader2'>Supplier Name</label></div>		
						    <div class='field'>
						    	<div class='ui icon input'>
								    <input type="text" id='supplierinputsearch'>
								    <i class="search link icon"></i>
								</div>
							</div>
						</div>					
					</div>

					<!-- Supplier list (on the left of the page) -->
					<div id='supplierresultsearch'>
						<?php include "suppliersearch.php" ?>
					</div>

				</div>

				<!-- TS from selected supplier (on the right of the page) -->
				<div class='column'>
					<div id='supplierxtsresult'>
					</div>
				</div>
			</div>
		</div>	
	</div>
	<div class="ui divider"></div>
</body>
</html>