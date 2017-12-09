<html>
	<?php include "../header.php"; include "../function.php"; ?>
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
	if(session_id() == '') {
	    session_start();
	}

	include "../db.php";

	$selectSql = "SELECT * FROM staff where divCode='ED' order by staffName";

	// if search
	$query;	
	if(!empty($_GET['search'])){
		$query = $_GET['search'];
		$selectSql = "SELECT * FROM staff WHERE divCode='ED' and (staffName LIKE '%$query%') OR (noReg LIKE '%$query%') OR (deptName LIKE '%$query%') OR (deptCode='$query') OR (sectName LIKE '%$query%')
					order by staffName";
		echo "<h2 id='titleheader'>Search: $query</h2>";		
	}else{
		echo "<h2 id='titleheader'>Member List</h2>";		
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
				<form action="stafflist.php" method="GET" id="staffsearchform">
					<div class="ui icon input">					
					    <input type="text" name="search" placeholder="Search staff...">
					    <i class="search link icon" onclick="submitForm('staffsearchform');"></i>				
					</div>
					<button type="submit" style="display: none;">asd</button>
				</form>
			</div>
		</div>
	</div>

<?php
	$ts=0;

	$selectSql = "SELECT * FROM staff where divCode='ED'order by staffName";
	if(!empty($_GET['search'])){
		$query = $_GET['search'];
		$selectSql = "SELECT * FROM staff WHERE divCode='ED' and (staffName LIKE '%$query%') OR (noReg LIKE '%$query%') OR (deptName LIKE '%$query%') OR (deptCode='$query') OR (sectName LIKE '%$query%')
					order by staffName";
	}	

	$selectResult = $conn->query($selectSql);

	// table data
	if($selectResult->num_rows > 0){
		echo "<table class='ui very compact sortable selectable definition center aligned table'>
			<thead class='full-width'><tr>
				<th id='tableheader'>No</th>";
		if($_SESSION['deptname'] == "EA"){
			echo "<th id='tableheader'>No Reg.</th>";
			echo "<th id='tableheader'>Pass</th>";
		}
		echo "	<th id='tableheader'>Member Name</th>
				<th id='tableheader'>Departement Name</th>	
				<th id='tableheader'>Dept. Code</th>	
				<th id='tableheader'>Section Name</th>
				<th id='tableheader'>Email</th>";
		if($_SESSION['deptname'] == "EA"){
			echo "<th id='tableheader'>E</th>";
		}
		echo "	<th id='tableheader'>Title</th>	
			</tr></thead><tbody>";
	}	

	$no = 1;
	if($selectResult->num_rows > 0){
		while($row = mysqli_fetch_assoc($selectResult)) {
			echo "<input type='hidden' value='$row[id]' id='staff$row[id]'>";
			$row['staffName'] = strtoupper($row['staffName']);

			echo "<tr>
					<td>";

			if($_SESSION['deptname'] == "EA"){
				echo "	<i class='link green large edit icon' onclick='editStaff(&quot;$row[id]&quot;);' style='position:absolute;margin-left:-50px;margin-top:-3px;'></i>
						<i class='link red large remove icon' onclick='deleteStaff(&quot;$row[id]&quot;);' style='position:absolute;margin-left:-80px;margin-top:-5px;'></i>";
			}
			echo "	$no</td>";

			if($_SESSION['deptname'] == "EA"){
				echo "<td>$row[noReg]</td>";
				echo "<td>$row[password]</td>";
			}
			echo "	<td class='left aligned'>$row[staffName]</td>
					<td class='left aligned'>$row[deptName]</td>
					<td>$row[deptCode]</td>
					<td class='left aligned'>$row[sectName]</td>
					<td class='left aligned'>$row[email]</td>";
			if($_SESSION['deptname'] == "EA"){
				echo "<td>$row[notify]</td>";
			}
			echo "	<td>$row[jobTitle]</td>
				</tr>";
			$no++;
							
		}
	}

	echo "</tbody></table>";
?>
		<!-- Modal for edit staff -->
		<div class="ui modal editmodal">
		  	<div class="header modalform" id='titleheader2'>EDIT MEMBER DETAIL</div>
		  	<div class="content modalform" id='editstaffcontent'></div>
		  	<div class="actions modalform">		   
			    <div class="ui green button" onclick="submitForm('editstaffform');">Update</div>
			    <div class="ui red cancel button">Cancel</div>
	  		</div>
		</div>

		<!-- Modal for delete staff -->
		<div class="ui basic modal deletemodal">
		  	<div class="header" id='titleheader2'>Are you sure you want to delete this member?</div>
		  	<div class="content" id='deletestaffcontent'></div>
		  	<div class="actions">		   
			    <div class="ui green button" onclick="submitForm('deletestaffform');">Yes</div>
			    <div class="ui red cancel button">No</div>
	  		</div>
		</div>
	</div>
	<div class='ui divider'></div>
</body>
</html>