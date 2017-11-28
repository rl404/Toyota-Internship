<html>
	<?php include "../header.php"; ?>
	<div class="ui container">
		<h1 class='ui center aligned dividing header' id='titleheader'>
			Viewer <?php echo $_SESSION['deptname']; ?> Department
		</h1>

		<div id='worklisttable'><?php include 'worklist.php'; ?></div>
		<div class='ui divider'></div>
	</div>
</body>
</html>