<html>
	<?php include "../header.php" ?>
	<div class="ui container">

	<?php 
	if(empty($_POST['supplier'])){
		include "export1search.php";
	}else{
		include "export2convert.php";
	} 
	?>
	
	</div>
</body>
</html>