<html>
	<?php include "../header.php"; ?>
	<div class="ui container">
		<?php
		if(!empty($_GET['ok'])){
			if($_GET['ok'] == 1){
				echo "<div class='ui green message'>
			  		<i class='close icon'></i>
			  		<div class='header'>
			   			Updated successfully. 
			  		</div>
			  	</div>";
		 	}else if($_GET['ok'] == 2){
		 		echo "<div class='ui green message'>
			  		<i class='close icon'></i>
			  		<div class='header'>
			   			Deleted successfully. 
			  		</div>
			  	</div>";
			}else{
			  	echo "<div class='ui red message'>
			  		<i class='close icon'></i>
			  		<div class='header'>
			   			Please fill both Job name and Project code. 
			  		</div>
			  	</div>";
			}
		}
	  	?>
	  	<h1 class='ui center aligned dividing header' id='titleheader'>
			UPDATE WORK HOUR
		</h1>		

		<div id='inputhourtable'>
			<?php include "updatetable.php"; ?>				
		</div>
		<div class='ui divider'></div>
	</div>
</body>
</html>