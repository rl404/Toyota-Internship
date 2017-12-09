<html>
	<?php include "../header.php"; include "../function.php"; ?>
	<div class="ui container" id='homepage'>
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

	$selectSql = "SELECT * FROM project order by projectCode";

	// if search
	$query;	
	if(!empty($_GET['search'])){
		$query = $_GET['search'];
		$selectSql = "SELECT * FROM project WHERE (projectCode LIKE '%$query%') OR (projectName LIKE '%$query%')
					order by projectCode";
		echo "<h2 id='titleheader'>Search: $query</h2>";		
	}else{
		echo "<h2 id='titleheader'>Project List</h2>";		
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
				<form action="projectlist.php" method="GET" id="projectsearchform">
					<div class="ui icon input">					
					    <input type="text" name="search" placeholder="Search Project...">
					    <i class="search link icon" onclick="submitForm('projectsearchform');"></i>				
					</div>
					<button type="submit" style="display: none;">asd</button>
				</form>
			</div>
		</div>
	</div>

<?php
	$ts=0;

	$selectSql = "SELECT * FROM project order by showList desc,projectCode";
	if(!empty($_GET['search'])){
		$query = $_GET['search'];
		$selectSql = "SELECT * FROM project WHERE (projectCode LIKE '%$query%') OR (projectName LIKE '%$query%')  
					order by showList desc,projectCode";
	}	

	$selectResult = $conn->query($selectSql);

	// table data
	if($selectResult->num_rows > 0){
		echo "
		<div class='ui checkbox' id='oldprojectcheckbox'>
			<input type='checkbox' value='1' id='oldprojectcheck'>
			<label>Show old projects</label>
		</div>
		<table class='ui compact sortable selectable definition center aligned table'>
			<thead class='full-width'><tr>
				<th id='tableheader'>No</th>				
				<th id='tableheader'>Project Code</th>
				<th id='tableheader'>Project Name</th>";
				if($_SESSION['deptname'] == "EA") echo "<th id='tableheader'>Show</th>";		
		echo "</tr></thead>";
	}	

	$no = 1;
	if($selectResult->num_rows > 0){
		while($row = mysqli_fetch_assoc($selectResult)) {			
				echo "<input type='hidden' value='$row[id]' id='project$row[id]'>";

			if($row['showList'] == 0){				
				echo "<tr class='oldproject' style='display:none;'>";
			}else{
				echo "<tr>";
			}
				echo "	<td>";

				if($_SESSION['deptname'] == "EA"){
					echo "	<i class='link green large edit icon' onclick='editProject(&quot;$row[id]&quot;);' style='position:absolute;margin-left:-70px;margin-top:-3px;'></i>
							<i class='link red large remove icon' onclick='deleteProject(&quot;$row[id]&quot;);' style='position:absolute;margin-left:-100px;margin-top:-5px;'></i>";
				}
				echo "		$no</td>
						<td>$row[projectCode]</td>
						<td>$row[projectName]</td>";
					if($_SESSION['deptname'] == "EA") echo "<td>$row[showList]</td>";		
				echo "</tr>";
				$no++;
			
		}
	}

	echo "</table>";
?>
		<!-- Modal for edit project -->
		<div class="ui modal editmodal">
		  	<div class="header modalform" id='titleheader2'>EDIT PROJECT DETAIL</div>
		  	<div class="content modalform" id='editprojectcontent'></div>
		  	<div class="actions modalform">		   
			    <div class="ui green button" onclick="submitForm('editprojectform');">Update</div>
			    <div class="ui red cancel button">Cancel</div>
	  		</div>
		</div>

		<!-- Modal for delete project -->
		<div class="ui basic modal deletemodal">
		  	<div class="header" id='titleheader2'>Are you sure you want to delete this project?</div>
		  	<div class="content" id='deleteprojectcontent'></div>
		  	<div class="actions">		   
			    <div class="ui green button" onclick="submitForm('deleteprojectform');">Yes</div>
			    <div class="ui red cancel button">No</div>
	  		</div>
		</div>
	</div>
	<div class='ui divider'></div>
</body>
</html>