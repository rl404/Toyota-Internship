<?php

	if(session_id() == '') {
	    session_start();
	}

	ob_start();
	
	echo 
	"
	<head>
		<title>TS Online</title>
		<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
		<link href='http://".$_SERVER['HTTP_HOST']."/TSOnline/css/semantic.min.css' rel='stylesheet'>
		<link href='http://".$_SERVER['HTTP_HOST']."/TSOnline/css/main.css' rel='stylesheet'>
		<script src='http://".$_SERVER['HTTP_HOST']."/TSOnline/scripts/jquery.min.js'></script>
		<script src='http://".$_SERVER['HTTP_HOST']."/TSOnline/scripts/semantic.min.js'></script>
		<script src='http://".$_SERVER['HTTP_HOST']."/TSOnline/scripts/sortable.js'></script>
		<script src='http://".$_SERVER['HTTP_HOST']."/TSOnline/scripts/main.js'></script>
	</head>
	<body>
	<div class='ui inverted menu' id='superheader'>
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
				<a href='http://".$_SERVER['HTTP_HOST']."/TSOnline/list/contact.php' class='item'>Supplier Contact</a>
				
				<div class='ui left pointing dropdown link item'>
					<i class='dropdown icon'></i>
        			<span class='text'>History</span>
        			<div class='menu'>
        				<a href='http://".$_SERVER['HTTP_HOST']."/TSOnline/list/datats.php' class='item'>TS</a>
        				<a href='http://".$_SERVER['HTTP_HOST']."/TSOnline/list/datasupplier.php' class='item'>Request</a>
					</div>
				</div>	
			</div>
		</div>
		<div class='ui simple dropdown item'>
			Cover Letter
			<i class='dropdown icon'></i>
			<div class='menu'>
				<a href='http://".$_SERVER['HTTP_HOST']."/TSOnline/export/export.php' class='item'>Auto</a>
				<a href='http://".$_SERVER['HTTP_HOST']."/TSOnline/export/exportmanual.php' class='item'>Manual</a>
			</div>
		</div>";

		// If logged in
		if(!empty($_SESSION['usernamets'])){
			echo "<div class='right menu'>
					<div class='header item'>Welcome, $_SESSION[usernamets]</div>					
					<a href='http://".$_SERVER['HTTP_HOST']."/TSOnline/help/help.pdf' target='_blank' class='item'>Help</a>
					<a href='http://".$_SERVER['HTTP_HOST']."/TSOnline/setting/setting.php' class='item'>Setting</a>
					<a href='http://".$_SERVER['HTTP_HOST']."/TSOnline/logout.php' class='item'>Logout</a>
				</div>";
		
		// If not logged in, redirect to login page
		}else{
			echo "<script type='text/javascript'> 
					document.location = 'http://".$_SERVER['HTTP_HOST']."/TSOnline/index.php?error=2'; 
				</script>";
			die();			
		}
		
		echo "</div>";
?>