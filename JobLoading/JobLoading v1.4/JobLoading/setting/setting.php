<html>
	<?php include "../header.php"; 
		include "../db.php";

		$selectSql = "SELECT * FROM staff WHERE id='$_SESSION[userid]'";
		$selectResult = $conn->query($selectSql);
		while($row = mysqli_fetch_assoc($selectResult)) {
			$noReg = $row['noReg'];
			$password = $row['password'];
			$staffName = $row['staffName'];
			$deptName = $row['deptName'];
			$deptCode = $row['deptCode'];
			$sectName = $row['sectName'];
			$jobTitle = $row['jobTitle'];
			$jobClass = $row['jobClass'];
			break;
		}

	?>

	<div class="ui container">
	<div class="ui segment" id="input1form">
		<h1 class="ui header" id='titleheader2'>Setting</h1>
		<form action="settingupdate.php" method="post" class="ui form">
			
			<div class="two fields">
				<div class="field">
					<label id='titleheader'>Registration Number</label>
					<input type="text" name="noreg" value='<?=$noReg?>'>
				</div>		
				<div class="field">
					<label id='titleheader'>Password</label>
					<input type="text" name="password" value='<?=$password?>'>
				</div>		
			</div>	
			<div class="field">
				<label id='titleheader'>Full Name</label>
				<input type="text" name="staffname" value='<?=$staffName?>'>
			</div>

			<div class='fields'>
				<div class="thirteen wide field">
					<label id='titleheader'>Department Name</label>
					<input type="text" name="deptname" list='deptnamelist' value='<?=$deptName?>'>
					<datalist id='deptnamelist'><?php include '../input/deptnamesuggestion.php'; ?></datalist>
				</div>
				<div class="three wide field">
					<label id='titleheader'>Dept. Code</label>
					<input type="text" name="deptcode" list='deptlist' value='<?=$deptCode?>' onkeydown="upperCaseF(this)"/>
					<datalist id='deptlist'><?php include '../input/deptcodesuggestion.php'; ?></datalist>
				</div>
			</div>

			<div class="field">
				<label id='titleheader'>Section Name</label>
				<input type="text" name="sectname" list='sectlist' value='<?=$sectName?>'>
				<datalist id='sectlist'><?php include '../input/sectsuggestion.php'; ?></datalist>
			</div>

			<div class='two fields'>
				<div class="thirteen wide field">
					<label id='titleheader'>Job Title</label>
					<input type="text" name="jobtitle" list='titlelist' value='<?=$jobTitle?>'>
					<datalist id='titlelist'><?php include '../input/titlesuggestion.php'; ?></datalist>
				</div>
				<div class="three wide field">
					<label id='titleheader'>Class</label>
					<input type="text" name="jobclass" value='<?=$jobClass?>'>
				</div>
			</div>
			
			<button class="ui yellow button" type="submit">Update</button>
		</form>	
	</div>
	</div>
	<div class="ui divider"></div>
</body>
</html>