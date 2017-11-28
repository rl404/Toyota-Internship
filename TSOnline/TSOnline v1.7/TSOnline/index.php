<!-- 
	TOYOTA STANDARD INFORMATION SYSTEM
	For Engineering Division TMMIN

	By:	Axel Oktavian Antonio
		Engineer Administrator Department
		Technical Information Management Team

	9 August 2017
 -->
 
<html>
<?php
	session_start();

	// If already logged in
	if(!empty($_SESSION['usernamets'])){
		include "homepage.php";

	// Else
	}else{
?>	
<head>
	<title>TS Online</title>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
	<link href='css/login.css' type="text/css" rel='stylesheet'>
	<script src='script/login.js'></script>
</head>
<body>
	<div class="header">
		<div>Toyota Standard<br><span>Information System</span></div>
	</div>
	<br>
	<div class="login">
			
	<?php

		// Wrong username or password
		if(!empty($_GET['error']) && $_GET['error'] == 1){
			echo "<label style='color:red;'>*Wrong username or password</label>";
		}

		// Go inside without logged in
		if(!empty($_GET['error']) && $_GET['error'] == 2){
			echo "<label style='color:red;'>*Please login</label>";
		}
	?>
		<form action="login.php" method="post">			
			<input type="text" placeholder="No Reg." name="username" autofocus><br>
			<input type="password" placeholder="Password" name="password"><br>
			<button type="submit" id="submitbutton">Login</button>
		</form>		
	</div>
	<div class='copyright'>
		PT. Toyota Motor Manufacturing Indonesia - Engineering Division - Technical Information Management Team 
		| Axel O.A | Copyright © 2017 
	</div>

<?php
	}
?>

	
</body>
</html>