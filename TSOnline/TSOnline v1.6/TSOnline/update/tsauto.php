<html>
	<?php include "../header.php";
	include "../function.php"; ?>
	<div class="ui container">
		<?php
			if(notempty($_GET['ok'])){
				if($_GET['ok'] == 1){
					echo "<div class='ui green message'>
				  		<i class='close icon'></i>
				  		<div class='header'>
				   			Added successfully. Notification email has been sent.
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
		<h1 class="ui header" id='titleheader2'>
			Update TS Revision
		</h1>
		<form class="ui form">
			<div class="field">
				<label>Paste the TS new revision here:</label>
				<textarea name="tsno" id="tsarea"
				placeholder="･TSxxxx　REV.x　Content"></textarea>
			</div>
			<button class='ui red inverted button' type="submit" id="convertts">Convert</button>
		</form>		
		
		<h5 class='ui header'>Converted TS:</h5>
		<div id="convertedts"></div>
	</div>
	<div class="ui divider"></div>
</body>
</html>