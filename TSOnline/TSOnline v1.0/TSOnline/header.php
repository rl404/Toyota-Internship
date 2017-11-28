<?php
	//#d20d16
	if(session_id() == '') {
	    session_start();
	}
	echo 
	"
	<head>
		<link href='http://".$_SERVER['HTTP_HOST']."/TSOnline/css/semantic.min.css' rel='stylesheet'>
		<link href='http://".$_SERVER['HTTP_HOST']."/TSOnline/css/main.css' rel='stylesheet'>
		<script src='http://".$_SERVER['HTTP_HOST']."/TSOnline/scripts/jquery.min.js'></script>
		<script src='http://".$_SERVER['HTTP_HOST']."/TSOnline/scripts/semantic.min.js'></script>
		<script src='http://".$_SERVER['HTTP_HOST']."/TSOnline/scripts/sortable.js'></script>
		<script src='http://".$_SERVER['HTTP_HOST']."/TSOnline/scripts/main.js'></script>
	</head>
	<body>
	<div class='ui inverted menu'>
		<a href='http://".$_SERVER['HTTP_HOST']."/TSOnline/index.php' class='item'>
			Homepage
		</a>
		<a href='http://".$_SERVER['HTTP_HOST']."/TSOnline/request/request.php' class='item'>
			New Request
		</a>
		<div class='ui simple dropdown item'>
			Update TS Rev.
			<i class='dropdown icon'></i>
			<div class='menu'>
				<a href='http://".$_SERVER['HTTP_HOST']."/TSOnline/update/tsauto.php' class='item'>Auto</a>
				<a href='http://".$_SERVER['HTTP_HOST']."/TSOnline/update/tsmanual.php' class='item'>Manual</a>
			</div>
		</div>
		<div class='ui simple dropdown item'>
			List
			<i class='dropdown icon'></i>
			<div class='menu'>
				<a href='http://".$_SERVER['HTTP_HOST']."/TSOnline/list/ts.php' class='item'>TS x Supplier</a>
				<a href='http://".$_SERVER['HTTP_HOST']."/TSOnline/list/supplier.php' class='item'>Supplier x TS</a>
				<div class='ui left pointing dropdown link item'>
					<i class='dropdown icon'></i>
        			<span class='text'>History</span>
        			<div class='menu'>
        			<a href='http://".$_SERVER['HTTP_HOST']."/TSOnline/list/datats.php' class='item'>TS</a>
        				<a href='http://".$_SERVER['HTTP_HOST']."/TSOnline/list/datasupplier.php' class='item'>Supplier</a>
					</div>
				</div>	
			</div>
		</div>
		<a href='http://".$_SERVER['HTTP_HOST']."/TSOnline/export/export.php' class='item'>
			Cover Letter
		</a>";

		if(!empty($_SESSION['usernamets'])){
			echo "<div class='right menu'>
					<div class='header item'>Welcome, $_SESSION[usernamets]</div>
					<a href='http://".$_SERVER['HTTP_HOST']."/TSOnline/logout.php' class='item'>Logout</a>
				</div>";
		}else{
			header("Location: http://".$_SERVER['HTTP_HOST']."/TSOnline/index.php?error=2");
		}
		
		echo "</div>
	</div>";
?>