<?php
	$conn = mysqli_connect("localhost","my_db_admin","my_db_admin","aised");

	// Check connection
 	if (mysqli_connect_errno()){
	   echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	$selectSql = "SELECT * FROM staff order by jobTitle";
	
	$selectResult = $conn->query($selectSql);

	$no = 1;
	$title = array();
	$titlecurr = "";
	$titleindex = 0;

	while($row = mysqli_fetch_assoc($selectResult)) {		
		if($row['jobTitle'] != $titlecurr){
			$titlecurr = $row['jobTitle'];
			$title[$titleindex] = $titlecurr;
			$titleindex++;
		}
	}

	for($i = 0; $i < count($title); $i++){
		echo "<option value='$title[$i]'>";
	}
?>