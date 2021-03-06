<?php
	if(session_id() == '') {
	    session_start();
	}
	
	include "../db.php";
	include "../function.php";

	if(empty($_POST['month'])){

		$_POST['month'] = date('m');
		$_POST['year'] = date('Y');

		$day = date('d');
		
		$_POST['week'] = getWeeks("$_POST[year]-$_POST[month]-$day", "sunday");
		
	}
	
	$maxWeek = weeks($_POST['month'],$_POST['year']);

	// week, month, year dropdown
	
	echo "<form class='ui form'>		
			<div class='inline fields'>
				<div class='field'>
					<select id='jobweek'>";

				for($i = 1; $i <= $maxWeek; $i++){
					if($i == $_POST['week']){
						echo "<option value='$i' selected>Week $i</option>";
					}else{
						echo "<option value='$i'>Week $i</option>";
					}
				}

				echo "
					</select>
				</div>
				<div class='field'>
					<select id='jobmonth'>";
					for($i=1;$i<13;$i++){
						$reqMonth = date("F",mktime(0,0,0,$i,1,2011));
						if($i==$_POST['month']){
							echo "<option value='$i' selected>$reqMonth</option>";
						}else{
							echo "<option value='$i'>$reqMonth</option>";
						}
					}
	echo "			</select>
				</div>
				<label>-</label>
				<div class='field'>
					<input id='jobyear' type='text' name='jobyear' size=5 value='";
	echo 			$_POST['year'];
	echo 			"'>
				</div>
				<div class='field'>
					<img class='ui centered mini image' src='../images/loading.gif' id='ajaxloading' style='display:none;'>
				</div>					
			</div>
			</form>";

	// table data
		
	$selectSql = "SELECT * FROM data WHERE staffName='$_SESSION[username]'
	AND MONTH(jobDate)=$_POST[month] AND YEAR(jobDate)=$_POST[year] order by jobName,jobDesc,projectCode,jobDate";

	echo "<form class='ui form' method='post' action='updatehour.php' id='ajaxupdatetable'>
		<input type='hidden' name='jobmonth' value='$_POST[month]'>
		<input type='hidden' name='jobyear' value='$_POST[year]'>

		<table class='ui compact selectable definition center aligned collapsing celled table'>
			<thead class='full-width'><tr>
				<th class='one wide' id='tableheader'>No</th>					
				<th class='four wide' id='tableheader'>Job Name</th>
				<th class='two wide' id='tableheader'>Proj. Code</th>";


	$dayHour = array();
	$week = 1;
	for($i = 1; $i < 32; $i++){		
		$dayHour[$i] = 0;
		$timestamp = strtotime("$_POST[year]-$_POST[month]-$i");
		$day = date('D', $timestamp);
		
		if($day == 'Sun') $week++;
		if($week == $_POST['week']){
			$i2 = ordinal((int)$i);
			if($day == 'Sun' || $day == 'Sat'){
				echo "<th class='one wide' id='weekendtext'>$i2".'<br>'."$day</th>";
			}else if($i == date('d') && $_POST['month'] == date('m') && $_POST['year'] == date('Y')){
				echo "<th class='one wide' id='todaytext'>$i2".'<br>'."$day</th>";
			}else{
				echo "<th class='one wide' id='tableheader'>$i2".'<br>'."$day</th>";
			}
		}
	}
	echo "		<th class='one wide' id='tableheader'>Total Week</th>
				<th class='one wide' id='tableheader'>Total Month</th>
			</tr></thead>";

	$no = 1;
	$jobCurrent = '';
	$jobDescCurrent = '';
	$projectCurrent = '';
	$jobIndex = 0;	

	$selectResult = $conn->query($selectSql);
	if($selectResult->num_rows > 0){
		while($row = mysqli_fetch_assoc($selectResult)) {
			if($row['jobName'] != $jobCurrent || $row['jobDesc'] != $jobDescCurrent || $row['projectCode'] != $projectCurrent){
				$jobCurrent = $row['jobName'];
				$jobDescCurrent = $row['jobDesc'];
				$projectCurrent = $row['projectCode'];

				echo "<tbody><tr>
						<td>$no.</td>
						<td class='left aligned'><b>$jobCurrent</b><br>$jobDescCurrent
							<input type='hidden' id='job' name='job[$jobIndex]' class='inputtable' value='$row[jobName]---$row[jobDesc]' list='joblist'></td>
						<td>$projectCurrent
							<input type='hidden' id='project' name='projectname[$jobIndex]' class='inputtable' value='$row[projectCode]' list='projectlist'></td>";
						
				$week = 1;
				$weekHour = 0;
				$monthHour = 0;
				for($i = 1; $i < 32; $i++){	
					$timestamp = strtotime("$_POST[year]-$_POST[month]-$i");
					$day = date('D', $timestamp);
					
					// total month
					$selectSql2 = "SELECT * FROM data WHERE staffName='$_SESSION[username]'
								AND jobName='$row[jobName]' AND jobDesc='$row[jobDesc]' AND projectCode='$row[projectCode]' AND DAY(jobDate)=$i AND MONTH(jobDate)=$_POST[month] AND YEAR(jobDate)=$_POST[year] 
								order by jobDate";
					$selectResult2 = $conn->query($selectSql2);
					if($selectResult2->num_rows > 0){
						while($row2 = mysqli_fetch_assoc($selectResult2)) {
							$monthHour += $row2['jobHour'];
						}
					}

					if($day == 'Sun') $week++;
					if($week == $_POST['week']){

						$selectSql2 = "SELECT * FROM data WHERE staffName='$_SESSION[username]'
								AND jobName='$row[jobName]' AND jobDesc='$row[jobDesc]' AND projectCode='$row[projectCode]' AND DAY(jobDate)=$i AND MONTH(jobDate)=$_POST[month] AND YEAR(jobDate)=$_POST[year] 
								order by jobDate";
						$selectResult2 = $conn->query($selectSql2);
						if($selectResult2->num_rows > 0){
							while($row2 = mysqli_fetch_assoc($selectResult2)) {
								echo "<input type='hidden' name='jobid[$jobIndex][$i]' value='$row2[id]'>";
								$date = date_create($row2['jobDate']);
								$date = date_format($date,"d");
								$weekHour = $weekHour + $row2['jobHour'];
								
								if($day == 'Sun' || $day == 'Sat'){
									echo "<td>";
								}else if($i == date('d') && $_POST['month'] == date('m') && $_POST['year'] == date('Y')){
									echo "<td id='todaytext2'>";
								}else{
									echo "<td>";
								}

								echo "<div class='field'><input type='text' name='jobhour[$jobIndex][$i]' class='center aligned inputtable' size='3' value='$row2[jobHour]' onchange='this.value = this.value.replace(/,/g, &quot;.&quot;)'></div></td>";
								$dayHour[$i] += $row2['jobHour'];
								break;
							}
						}else{
							if($day == 'Sun' || $day == 'Sat'){
								echo "<td>";
							}else if($i == date('d') && $_POST['month'] == date('m') && $_POST['year'] == date('Y')){
								echo "<td id='todaytext2'>";
							}else{
								echo "<td>";
							}
							echo "<div class='field'><input type='text' name='jobhour[$jobIndex][$i]' class='center aligned inputtable' size='3' value=''></div></td>";
						}
					}
				}	
				echo "	<td id='tabletotal'>$weekHour</td>
						<td id='tabletotal'>$monthHour</td></tr>";
				$no++;
				$jobIndex++;
			}
		}
	}

	// input new job

	echo "<tr>
			<td>$no.</td>
			<td><div class='field'>
				<select id='job' name='job[$jobIndex]' class='inputtable'>";
				include "updatejobsuggestion.php";
	echo "		</select>
			</td>";			
			// <td><div class='field'><input type='text' class='inputtable' id='job' list='joblist' name='job[$jobIndex]'></div></td>
	echo "	<td><div class='field'>
				<select id='project' name='projectname[$jobIndex]' class='center aligned inputtable'>";
				include "updateprojectnamesuggestion.php";
	echo "		</select>
			</td>";
			// <input type='text' class='center aligned inputtable' id='project' list='projectlist' name='projectname[$jobIndex]'></div></td>";

	$week = 1;
	for($i = 1; $i < 32; $i++){		
		$timestamp = strtotime("$_POST[year]-$_POST[month]-$i");
		$day = date('D', $timestamp);
		
		if($day == 'Sun') $week++;
		if($week == $_POST['week']){
			if($day == 'Sun' || $day == 'Sat'){
				echo "<td>";
			}else if($i == date('d') && $_POST['month'] == date('m') && $_POST['year'] == date('Y')){
				echo "<td id='todaytext2'>";
			}else{
				echo "<td>";
			}
			echo "<div class='field'><input type='text' class='center aligned inputtable' name='jobhour[$jobIndex][$i]' size='3' onchange='this.value = this.value.replace(/,/g, &quot;.&quot;)'></div></td>";
		}
	}	
	echo "<td id='tabletotal'></td><td id='tabletotal'></td>
		</tr></tbody>";

	echo "<tfoot class='full-width'><tr>
			<th colspan=3 id='tablefooter'>Total Day Hours</th>";

	$week = 1;
	for($i = 1; $i < 32; $i++){		
		$timestamp = strtotime("$_POST[year]-$_POST[month]-$i");
		$day = date('D', $timestamp);
		
		if($day == 'Sun') $week++;
		if($week == $_POST['week']){
			if($i == date('d') && $_POST['month'] == date('m') && $_POST['year'] == date('Y')){
				echo "<th id='todaytext'>$dayHour[$i]";
				if($dayHour[$i] > 12){
					echo "<span class='detailjobview' data-tooltip='You have worked for more than 12 hours. Are you sure? Don&#39;t work too hard.' data-position='top center'><i class='link help icon'></i>
						</span>";
				}
				echo "</th>";
			}else{
				echo "<th id='tablefooter'>$dayHour[$i]";
				if($dayHour[$i] > 12){
					echo "<span class='detailjobview' data-tooltip='You have worked for more than 12 hours. Are you sure? Don&#39;t work too hard.' data-position='top center'><i class='link help icon'></i>
						</span>";
				}
				echo "</th>";
			}
		}
	}

	echo "<th colspan=2 id='tablefooter'></th></tr></tfoot>";

	echo "</table>
	<div class='inline fields'>
		<div class='field'><button class='ui yellow button' type='submit'>UPDATE</button></div>
		<div class='field'>
			<button class='ui red button' onclick='window.open(&quot;../list/joblist.php?search=$_SESSION[deptname]&noheader=1&quot;, 
				&quot;newwindow&quot;, &quot;width=800,height=500&quot;);return false;'>			
				View Job List
			</button>
		</div>
		<div class='field'>
			<button class='ui blue button' onclick='window.open(&quot;../list/projectlist.php?noheader=1&quot;, 
				&quot;newwindow&quot;, &quot;width=800,height=500&quot;);return false;'>			
				View Project List
			</button>
		</div>
		<div class='field'>
			<a href='updatecleaner.php'><div data-tooltip='Change the job hour to 0 and click update first. Then, click this button.'>
				<div class='ui black button'>Delete Empty Job Hour</div>
			</div></a>
		</div>
		<div class='field'>
			<a href='../help/help.php'>Need help?</a>
		</div>
	</div>
	</form>";

	echo "<datalist id='joblist'>";
	include "updatejobsuggestion.php";
	echo "</datalist>";

	echo "<datalist id='projectlist'>";
	include "updateprojectnamesuggestion.php";
	echo "</datalist>";
?>