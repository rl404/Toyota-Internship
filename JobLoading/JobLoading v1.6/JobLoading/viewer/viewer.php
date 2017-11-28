<html>
	<?php include "../header.php"; ?>
	<div class="ui container">
		<div data-tooltip="You can see the other member with the same position or lower in your deparment only." data-position="bottom center">
			<h1 class='ui center aligned dividing header' id='titleheader'>
				Viewer <?php echo $_SESSION['deptname']; ?> Department
			</h1>
		</div>

		<div id='worklisttable'><?php include 'worklist.php'; ?></div>
		<div class='ui divider'></div>
	</div>
</body>
</html>