<html>
	<?php include "../header.php"; include "../function.php"; ?>

	<!-- Modal for edit job -->
		<div class="ui modal editmodal">
		  	<div class="header modalform" id='titleheader2'>EDIT JOB DETAIL</div>
		  	<div class="content modalform" id='editjobcontent'></div>
		  	<div class="actions modalform">		   
			    <div class="ui green button" onclick="submitForm('editjobform');">Update</div>
			    <div class="ui red cancel button">Cancel</div>
	  		</div>
		</div>

		<!-- Modal for delete job -->
		<div class="ui basic modal deletemodal">
		  	<div class="header" id='titleheader2'>Are you sure you want to delete this job?</div>
		  	<div class="content" id='deletejobcontent'></div>
		  	<div class="actions">		   
			    <div class="ui green button" onclick="submitForm('deletejobform');">Yes</div>
			    <div class="ui red cancel button">No</div>
	  		</div>
		</div>
		
	<div class="ui container">
		<?php
		if(notempty($_GET['ok'])){
			if($_GET['ok'] == 1){
				echo "<div class='ui green message'>
			  		<i class='close icon'></i>
			  		<div class='header'>
			   			Updated successfully. 
			  		</div>
			  	</div>";
			}else if($_GET['ok'] == 2){
				echo "<div class='ui green message'>
			  		<i class='close icon'></i>
			  		<div class='header'>
			   			Deleted successfully. 
			  		</div>
			  	</div>";
			}else{
			  	echo "<div class='ui red message'>
			  		<i class='close icon'></i>
			  		<div class='header'>
			   			Something wrong. 
			  		</div>
			  	</div>";
			  }
		  }
	  	?>
	<div class="ui secondary menu">
		<div class="item">	
<?php
	include "../db.php";

	$selectSql = "SELECT * FROM job order by jobName";

	// if search
	$query;	
	if(!empty($_GET['search'])){
		$query = $_GET['search'];
		$selectSql = "SELECT * FROM job WHERE (jobName LIKE '%$query%') OR (jobDesc LIKE '%$query%') OR (deptCode='$query')
					order by jobName";
		echo "<h2 id='titleheader'>Search: $query</h2>";		
	}else{
		echo "<h2 id='titleheader'>Job List</h2>";		
	}

	// count data total
	$dataCountTotal = 0;
	$selectResult = $conn->query($selectSql);
	while($row = mysqli_fetch_assoc($selectResult)) {
		$dataCountTotal++;
	}
	echo "
		</div>
		<div class='item' id='titleheader2'>
			$dataCountTotal results
		</div>";
?>
	<div class="right menu">
			<div class="item">
				<form action="joblist.php" method="GET" id="jobsearchform">
					<div class="ui icon input">					
					    <input type="text" name="search" placeholder="Search ...">
					    <i class="search link icon" onclick="submitForm('jobsearchform');"></i>				
					</div>
					<button type="submit" style="display: none;">asd</button>
				</form>
			</div>
		</div>
	</div>

<?php
	$ts=0;

	$selectSql = "SELECT * FROM job order by deptCode,jobName";
	if(!empty($_GET['search'])){
		$query = $_GET['search'];
		$selectSql = "SELECT * FROM job WHERE (jobName LIKE '%$query%') OR (jobDesc LIKE '%$query%') OR (deptCode='$query') 
					order by deptCode,jobName";
	}	

	$selectResult = $conn->query($selectSql);

	// table data
	if($selectResult->num_rows > 0){
		echo "<table class='ui compact sortable selectable definition center aligned table'>
			<thead class='full-width'><tr>
				<th id='tableheader'>No</th>
				<th id='tableheader'>Job Name</th>
				<th id='tableheader'>Dept.</th>	
				<th id='tableheader'>Job Description / Element</th>			
			</tr></thead>";
	}	

	$no = 1;
	if($selectResult->num_rows > 0){
		while($row = mysqli_fetch_assoc($selectResult)) {
			echo "<input type='hidden' value='$row[id]' id='job$row[id]'>";

			$row['jobDesc'] = str_replace("\n", "<br>", "$row[jobDesc]"); 
			$row['jobDesc'] = str_replace(";", "<br>", "$row[jobDesc]"); 
			echo "<tr>
					<td>";

			if($_SESSION['deptname'] == "EA"){
				echo "<i class='link green large edit icon' onclick='editJob(&quot;$row[id]&quot;);' style='position:absolute;margin-left:-50px;margin-top:-3px;'></i>
						<i class='link red large remove icon' onclick='deleteJob(&quot;$row[id]&quot;);' style='position:absolute;margin-left:-80px;margin-top:-5px;'></i>";
			}
			echo "		$no
					</td>
					<td>$row[jobName]</td>
					<td>$row[deptCode]</td>
					<td class='left aligned'>$row[jobDesc]</td>
				</tr>";
			$no++;
		}
	}

	echo "</table>";
?>
		
	</div>
	<div class='ui divider'></div>	

</body>
</html>