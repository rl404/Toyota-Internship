<?php

	if(session_id() == '') {
	    session_start();
	}
	echo 
	"
	<head>
	<title>Job Loading</title>
		<link href='http://".$_SERVER['HTTP_HOST']."/JobLoading/css/semantic.min.css' rel='stylesheet'>
		<link href='http://".$_SERVER['HTTP_HOST']."/JobLoading/css/main.css' rel='stylesheet'>
		<script src='http://".$_SERVER['HTTP_HOST']."/JobLoading/scripts/jquery.min.js'></script>
		<script src='http://".$_SERVER['HTTP_HOST']."/JobLoading/scripts/semantic.min.js'></script>
		<script src='http://".$_SERVER['HTTP_HOST']."/JobLoading/scripts/sortable.js'></script>
		<script src='http://".$_SERVER['HTTP_HOST']."/JobLoading/scripts/main.js'></script>
		<script src='http://".$_SERVER['HTTP_HOST']."/JobLoading/scripts/loader.js'></script>
	</head>
	<body>
	<div class='ui inverted menu' id='superheader'>
		<a href='http://".$_SERVER['HTTP_HOST']."/JobLoading/index.php' class='item'>
			Homepage
		</a>";

	// if manager logged in
	if($_SESSION['title'] == 2 || $_SESSION['title'] == 3){
		echo "<div class='ui simple dropdown item'>
			Entry
			<i class='dropdown icon'></i>
			<div class='menu'>
				<a href='http://".$_SERVER['HTTP_HOST']."/JobLoading/update/update.php' class='item'>Job Hours</a>
				<a href='http://".$_SERVER['HTTP_HOST']."/JobLoading/input/job.php' class='item'>Job</a>
				<a href='http://".$_SERVER['HTTP_HOST']."/JobLoading/input/project.php' class='item'>Project</a>
				<a href='http://".$_SERVER['HTTP_HOST']."/JobLoading/input/dept.php' class='item'>Dept./Sect.</a>
				<a href='http://".$_SERVER['HTTP_HOST']."/JobLoading/input/staff.php' class='item'>Staff</a>
			</div>
		</div>";
	
	// if staff logged in
	}else{
		echo "<a href='http://".$_SERVER['HTTP_HOST']."/JobLoading/update/update.php' class='item'>Job Hours</a>";
	}
		echo "
		<a href='http://".$_SERVER['HTTP_HOST']."/JobLoading/list/joblist.php' class='item'>
			Job List
		</a>
		<a href='http://".$_SERVER['HTTP_HOST']."/JobLoading/list/projectlist.php' class='item'>
			Project List
		</a>
		<a href='http://".$_SERVER['HTTP_HOST']."/JobLoading/list/stafflist.php' class='item'>
			Staff List
		</a>
		<a href='http://".$_SERVER['HTTP_HOST']."/JobLoading/list/deptlist.php' class='item'>
			Dept./Sect. List
		</a>
		<a href='http://".$_SERVER['HTTP_HOST']."/JobLoading/viewer/viewer.php' class='item'>
			Viewer
		</a>
		<div class='ui simple dropdown item'>
			Report
			<i class='dropdown icon'></i>
			<div class='menu'>
				<a href='http://".$_SERVER['HTTP_HOST']."/JobLoading/report/project.php' class='item'>By Project</a>
				<a href='http://".$_SERVER['HTTP_HOST']."/JobLoading/report/dept.php' class='item'>By Dept</a>
				<a href='http://".$_SERVER['HTTP_HOST']."/JobLoading/report/job.php' class='item'>By Job</a>
				<a href='http://".$_SERVER['HTTP_HOST']."/JobLoading/report/staff.php' class='item'>By Staff</a>
			</div>
		</div>";

		// show username on nav bar
		if(!empty($_SESSION['username'])){
			echo "<div class='right menu'>
					<div class='header item'>Welcome, $_SESSION[username]</div>
					<a href='http://".$_SERVER['HTTP_HOST']."/JobLoading/setting/setting.php' class='item'>Setting</a>
					<a href='http://".$_SERVER['HTTP_HOST']."/JobLoading/help/help.php' class='item'>Help</a>
					<a href='http://".$_SERVER['HTTP_HOST']."/JobLoading/logout.php' class='item'>Logout</a>
				</div>";
		}else{
			header("Location: http://".$_SERVER['HTTP_HOST']."/JobLoading/index.php?error=2");
		}
		
		echo "</div>
	</div>";
?>