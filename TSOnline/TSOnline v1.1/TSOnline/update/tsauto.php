<html>
	<?php include "../header.php" ?>
	<div class="ui container">
		<h1 class="ui header" id='titleheader2'>
			Update TS Revision
		</h1>
		<form class="ui form">
			<div class="field">
				<label>Paste the TS new revision here:</label>
				<textarea name="tsno" 
				placeholder="･TSxxxx　REV.x　Content&#10;･TSxxxx　REV.x　Content&#10;･TSxxxx　REV.x　Content" 
				id="tsarea"></textarea>
			</div>
			<button class='ui red inverted button' type="submit" id="convertts">Convert</button>
		</form>		
		
		<h5 class='ui header'>Converted TS:</h5>
		<div id="convertedts"></div>
	</div>
	<div class="ui divider"></div>
</body>
</html>