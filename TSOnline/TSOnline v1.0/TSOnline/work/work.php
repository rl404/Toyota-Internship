<html>
	<?php include "../header.php" ?>
	<div class="ui container">
		<h1 class='ui center aligned header'>WORK LIST</h1>
		<div class="ui secondary menu">
			<div class="item">
			<?php
				include "../db.php";

				$selectSql = "SELECT * FROM ts order by reqDate desc";

				// count data total
				$dataCountTotal = 0;
				$selectResult = $conn->query($selectSql);
				while($row = mysqli_fetch_assoc($selectResult)) {
					if($row['sendStatus'] == 0){
						$dataCountTotal++;
					}
				}

				echo "<h2>$dataCountTotal works</h2>";				
			?>
			</div>
			<!-- <div class="right menu">
				<div class="item">
					<form action="datats.php" method="GET" id="datasearchform">
						<div class="ui icon input">					
						    <input type="text" name="search" placeholder="Search TS or Content...">
						    <i class="search link icon" onclick="submitForm('datasearchform');"></i>				
						</div>
						<input type="hidden" name="page" value=1>
						<button type="submit" style="display: none;">asd</button>
					</form>
				</div>
			</div>	 -->
		</div>
		<div id='worklist'>
			<?php include "worklist.php" ?>
		</div>	
	</div>
</body>
</html>