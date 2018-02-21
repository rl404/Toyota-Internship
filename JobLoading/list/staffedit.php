<?php
	include "../db.php";

	$noreg = '';
	$password = '';
	$staffname = '';
	$deptname = '';
	$deptcode = '';
	$sectname = '';
	$email = '';
	$jobtitle = '';
	$notify = 0;

	$selectSql = "SELECT * FROM staff WHERE id=$_POST[staffid]";
	$selectResult = $conn->query($selectSql);
	while($row = mysqli_fetch_assoc($selectResult)) {
		$noreg = $row['noReg'];
		$password = $row['password'];
		$staffname = $row['staffName'];
		$deptname = $row['deptName'];
		$deptcode = $row['deptCode'];
		$sectname = $row['sectName'];
		$email = $row['email'];
		$jobtitle = $row['jobTitle'];
		$notify = $row['notify'];
	}

	echo "<form action='staffedit2.php' method='post' class='ui form' id='editstaffform'>
			<input type='hidden' name='staffid' value='$_POST[staffid]'>
			<div class='two fields'>
				<div class='required field'>
					<label id='titleheader'>Registration Number</label>
					<input type='text' name='noreg' id='noreginput' value='$noreg' required>
				</div>	
				<div class='field'>
					<label id='titleheader'>Password</label>
					<input type='text' name='password' value='$password'>
				</div>
			</div>
			<div id='staffcheck'></div>		
			<div class='required field'>
				<label id='titleheader'>Full Name</label>
				<input type='text' name='staffname' value='$staffname' required>
			</div>

			<div class='field'>
				<label id='titleheader'>Email</label>
				<input type='text' name='email' value='$email'>
			</div>

			<div class='fields'>
				<div class='thirteen wide field'>
					<label id='titleheader'>Department Name</label>
					<input type='text' name='deptname' list='deptnamelist' value='$deptname'>
					<datalist id='deptnamelist'>"; include '../input/deptnamesuggestion.php'; echo "</datalist>
				</div>
				<div class='three wide field'>
					<label id='titleheader'>Dept. Code</label>
					<input type='text' name='deptcode' list='deptlist' value='$deptcode' onkeydown='upperCaseF(this)'/>
					<datalist id='deptlist'>"; include '../input/deptcodesuggestion.php'; echo "</datalist>
				</div>
			</div>

			<div class='field'>
				<label id='titleheader'>Section Name</label>
				<input type='text' name='sectname' list='sectlist' value='$sectname'>
				<datalist id='sectlist'>"; include '../input/sectsuggestion.php'; echo "</datalist>
			</div>

			<div class='field'>
				<label id='titleheader'>Job Title</label>
				<input type='text' name='jobtitle' list='titlelist' value='$jobtitle'>
				<datalist id='titlelist'>"; include '../input/titlesuggestion.php'; echo"</datalist>
			</div>
			
			<div class='field'>
				<div class='ui checkbox'>						
			      	<input type='checkbox' name='notifyemail' value='1'"; if($notify==1)echo 'checked'; echo ">
			      	<label>Notified when there is new TS update.</label>
			    </div>
			</div>
		</form>	";

?>