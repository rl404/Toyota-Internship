<!-- 
	JOB LOADING MANAGEMENT SYSTEM
	For Engineering Division TMMIN

	By:	Axel Oktavian Antonio
		Engineer Administrator Department
		Technical Information Management Team

	July 2017
 -->

<html>
<?php
	session_start();

	// if logged in
	if(!empty($_SESSION['userid'])){
		include "homepage.php";
	}else{
?>	

<!-- If not logged in -->

<head>
	<link href='css/login.css' rel='stylesheet'>
	<script src='script/login.js'></script>
</head>
<body>
	<div class="header">
		<div>Job-Loading<span><br>Management System</span></div>
	</div>
	<br>
	<div class="login">
	<?php
		if(!empty($_GET['error']) && $_GET['error'] == 1){
			echo "<label style='color:red;'>*Wrong username or password</label>";
		}

		if(!empty($_GET['error']) && $_GET['error'] == 2){
			echo "<label style='color:red;'>*Please login</label>";
		}
	?>
		<form action="login.php" method="post">			
			<input type="text" placeholder="no reg." name="username" autofocus><br>
			<input type="password" placeholder="password" name="password"><br>
			<button type="submit" id="submitbutton">Login</button>
		</form>		
	</div>
	<div class='copyright1'><div class='copyright2'>
		PT. Toyota Motor Manufacturing Indonesia - Engineering Division - Technical Information Management Team 
		| Axel O.A | Copyright © 2017 
	</div></div>

<?php
	}
?>
	
</body>
</html>