<html>
	<?php include "../header.php"; include "../function.php"; ?>

	<div class="ui container">

		<?php
		if(notempty($_GET['ok'])){

			// If setting updated successfully
			if($_GET['ok'] == 1){
				echo "<div class='ui green message'>
			  		<i class='close icon'></i>
			  		<div class='header'>
			   			Proposal Found. 
			  		</div>
			  	</div>";

			}
		}
	  	?>

	  	<?php
			include "../db.php";
			$result = mysqli_query($conn,"SELECT * FROM vave WHERE id='$_GET[id]'");
			$row = mysqli_fetch_array($result);
		?>

		<div class="ui segment">
			<h1 class="ui center aligned header" id='titleheader1'>VA PROPOSAL FORM</h1>
		</div>

		<div class="ui fluid steps">
			<div class="step">
				<i class='green checkmark icon'></i>
		    	<div class="content">
		    	<?php 
		    		echo "<div class='title'>Update</div>
		    			<div class='description'>$row[teardownNo]</div>";		    	
			    ?>
		    	</div>
		  	</div>
		  	<?php 
		  		if($row['result'] == "O"){
		  			echo "<div class='step'>
		  					<i class='green checkmark icon'></i>
		  					<div class='content'>		  						
					      		<div class='title'>PE</div>
					      		<div class='description'>Processed</div>
					    	</div>
					  	</div>";
		  		}else if($row['result'] == "U"){
		  			echo "<div class='step'>
		  					<i class='yellow edit icon'></i>
		  					<div class='content'>
					      		<div class='title'>PE</div>
					      		<div class='description'>Understudy</div>
					    	</div>
					  	</div>";
		  		}else if($row['result'] == "D"){
		  			echo "<div class='step'>
		  					<i class='orange clone icon'></i>
		  					<div class='content'>
					      		<div class='title'>PE</div>
					      		<div class='description'>Duplicate</div>
					    	</div>
					  	</div>";
		  		}else if($row['result'] == "X"){
		  			echo "<div class='step'>
		  					<i class='red remove icon'></i>
		  					<div class='content'>
					      		<div class='title'>PE</div>
					      		<div class='description'>Rejected</div>
					    	</div>
					  	</div>";
		  		}else{
		  			echo "<div class='step'>
		  					<i class='help icon'></i>
		  					<div class='content'>
					      		<div class='title'>PE</div>
					      		<div class='description'>Unknown</div>
					    	</div>
					  	</div>";
		  		}
		  	?>
		  	
		  	<?php 
		  		if($row['status'] == "O"){
		  			echo "<div class='step'>
		  					<i class='green checkmark icon'></i>
		  					<div class='content'>
					      		<div class='title'>PPEQ</div>
					      		<div class='description'>Processed</div>
					    	</div>
					  	</div>";
		  		}else if($row['status'] == "U"){
		  			echo "<div class='step'>
		  					<i class='yellow edit icon'></i>
		  					<div class='content'>
					      		<div class='title'>PPEQ</div>
					      		<div class='description'>Understudy</div>
					    	</div>
					  	</div>";
		  		}else if($row['status'] == "X"){
		  			echo "<div class='step'>
		  					<i class='red remove icon'></i>
		  					<div class='content'>
					      		<div class='title'>PPEQ</div>
					      		<div class='description'>Rejected</div>
					    	</div>
					  	</div>";
		  		}else{
		  			echo "<div class='step'>
		  					<i class='help icon'></i>
		  					<div class='content'>
					      		<div class='title'>PPEQ</div>
					      		<div class='description'>Unknown</div>
					    	</div>
					  	</div>";
		  		}
		  	?>

		  	<?php 
		  		if($row['costReduction'] != "0"){
		  			echo "<div class='step'>
		  					<i class='green checkmark icon'></i>
		  					<div class='content'>
					      		<div class='title'>PuD</div>
					      		<div class='description'>Processed</div>
					    	</div>
					  	</div>";
		  		}else {
		  			echo "<div class='step'>
		  					<i class='help icon'></i>
		  					<div class='content'>
					      		<div class='title'>PuD</div>
					      		<div class='description'>Unknown</div>
					    	</div>
					  	</div>";
		  		}
		  	?>
		    
		    <?php 
		  		if($row['statusTMC'] == "O"){
		  			echo "<div class='step'>
		  					<i class='green checkmark icon'></i>
		  					<div class='content'>
					      		<div class='title'>EA + TMC</div>
					      		<div class='description'>Accepted</div>
					    	</div>
					  	</div>";
		  		}else if($row['statusTMC'] == "X"){
		  			echo "<div class='step'>
		  					<i class='red remove icon'></i>
		  					<div class='content'>
					      		<div class='title'>EA + TMC</div>
					      		<div class='description'>Rejected</div>
					    	</div>
					  	</div>";
		  		}else{
		  			echo "<div class='step'>
		  					<i class='help icon'></i>
		  					<div class='content'>
					      		<div class='title'>EA + TMC</div>
					      		<div class='description'>Unknown</div>
					    	</div>
					  	</div>";
		  		}
		  	?>
		</div>			

		<?php
			if(empty($row['status'])){
				echo "<div class='ui red inverted center aligned segment'>
						<h3 class='ui header'>
							PPEQ DIDN'T PROCESS THIS PROPOSAL (YET).
							<div class='subheader'>
								Are you sure you want to continue?
							</div>
						</h3>
					</div>";
			}
		?>

		<div class='ui equal width grid'>
			<div class='column'>
				<div class='ui segment'>					
						
					<h2 class='ui orange center aligned dividing header'>Proposal Form</h2>
					<table class='ui compact celled selectable center aligned table'>
						<thead><tr>
							<th class='right aligned eight wide'>Proposer Number</th>
							<th class='left aligned eight wide'><?php echo $row['teardownNo']; ?></th>
						</tr></thead>
						<thead><tr>
							<th class='right aligned eight wide'>Manufacturer's Number</th>
							<th class='left aligned eight wide'><?php echo $row['manufacturerNo']; ?></th>
						</tr></thead>
						<tr>
							<td class='right aligned'>Toyota Design Staff</td>
							<td class='left aligned'><?php echo $row['designer']; ?></td>
						</tr>
						<tr><td class='center aligned' colspan=2><h3 class='ui orange header'>Part Info</h3></td></tr>
						<tr>
							<td class='right aligned'>Model</td>
							<td class='left aligned'><?php echo $row['model']; ?></td>
						</tr>
						<tr class='tooltip'>
							<td class='right aligned'>Part No</td>
							<?php 
								$selectSql2 = "SELECT * FROM attachment where proposerId='$_GET[id]'";
								$selectResult2 = $conn->query($selectSql2);
								
								if($selectResult2->num_rows > 1){
									$partDetail = "<table class='ui very compact table'>";

									$selectSql2 = "SELECT * FROM attachment where proposerId='$_GET[id]'";
									$selectResult2 = $conn->query($selectSql2);
									while($row2 = mysqli_fetch_assoc($selectResult2)) {
										$partDetail .= "<tr><td class='center aligned'>$row2[partNo]</td><td>$row2[partName]</td></tr>";
									}
									$partDetail .= "</table>";
									
									echo "<td class='left aligned tooltip'>
											<a onclick='window.open(&quot;../list/attachment.php?header=no&search=$row[id]&quot;, 
												&quot;newwindow&quot;, &quot;width=800,height=500&quot;);return false;'>			
												$row[partNo]
											</a>

											<span class='tooltipimage' style='width:100%'>$partDetail</span>
										</td>";
								}else{
									echo "<td class='left aligned'>$row[partNo]</td>";
								}
							?>
						</tr>
						<tr class='tooltip'>
							<td class='right aligned'>Part Name</td>
							<?php 
								if($selectResult2->num_rows > 1){
									echo "<td class='left aligned tooltip'>
											<a onclick='window.open(&quot;../list/attachment.php?header=no&search=$row[id]&quot;, 
												&quot;newwindow&quot;, &quot;width=800,height=500&quot;);return false;'>			
												$row[partName]
											</a>

											<span class='tooltipimage' style='width:100%'>$partDetail</span>
										</td>";
								}else{
									echo "<td class='left aligned'>$row[partName]</td>";
								}
							?>
						</tr>
						<tr><td class='center aligned' colspan=2><h3 class='ui orange header'>Idea Info</h3></td></tr>
						<tr>
							<td class='right aligned'>Idea</td>
							<td class='left aligned'><?php echo "$row[ideaType] ($row[ideaType2])"; ?></td>
						</tr>
						<tr class='tooltip'>
							<td class='right aligned'>Old Design</td>
							<td class='left aligned tooltip'><?php echo $row['ideaOld']."<span class='tooltipimage'><img src='../images/design/$row[id]old0.png' width='100%' alt='No image uploaded'></span>";?></td>
						</tr>
						<tr class='tooltip'>
							<td class='right aligned'>New Design</td>
							<td class='left aligned tooltip'><?php echo $row['ideaNew']."<span class='tooltipimage'><img src='../images/design/$row[id]new0.png' width='100%' alt='No image uploaded'></span>";?></td>
						</tr>
						<tr>
							<td class='right aligned'>Photo Number</td>
							<td class='left aligned'><?php echo $row['photoNo']; ?></td>
						</tr>
						<tr><td class='center aligned' colspan=2><h3 class='ui orange header'>Proposer Info</h3></td></tr>
						<tr>
							<td class='right aligned'>Proposer Name (Div.)</td>
							<td class='left aligned'><?php echo "$row[proposerName] ($row[proposerDiv])"; ?></td>
						</tr>
						<tr>
							<td class='right aligned'>Upload Date</td>
							<td class='left aligned'><?php 
								if($row['proposerDate'] != "0000-00-00"){
									echo date('Y-M-d',strtotime($row['proposerDate']));
								}else{
									echo "-";
								} ?></td>
						</tr>
					</table>
				</div>
				<div class='ui segment'>
					<h2 class='ui yellow center aligned dividing header'>PE</h2>
					<table class='ui compact celled selectable center aligned table'>
						<thead><tr>
							<th class='right aligned eight wide'>Proposer Number</th>
							<th class='left aligned eight wide'><?php echo $row['teardownNo']; ?></th>
						</tr></thead>
						<thead><tr>
							<th class='right aligned eight wide'>Manufacturer's Number</th>
							<th class='left aligned eight wide'><?php echo $row['manufacturerNo']; ?></th>
						</tr></thead>
						<tr><td class='center aligned' colspan=2><h3 class='ui yellow header'>Technical Study</h3></td></tr>
						<tr>
							<td class='right aligned'>Proposal Rank</td>
							<td class='left aligned'><?php echo $row['proposalRank']; ?></td>
						</tr>
						<tr>
							<td class='right aligned'>PIC</td>
							<td class='left aligned'><?php echo $row['pic']; ?></td>
						</tr>
						<tr>
							<td class='right aligned'>Result</td>
							<td class='left aligned'><?php echo $row['result']; ?></td>
						</tr>
						<tr>
							<td class='right aligned'>Rejection Category</td>
							<td class='left aligned'><?php echo $row['rejection']; ?></td>
						</tr>
						<tr><td class='center aligned' colspan=2><h3 class='ui yellow header'>Uploader Info</h3></td></tr>
						<tr>
							<td class='right aligned'>Uploader</td>
							<td class='left aligned'><?php echo $row['uploader1']; ?></td>
						</tr>
						<tr>
							<td class='right aligned'>Upload Date</td>
							<td class='left aligned'><?php 
								if($row['date1'] != "0000-00-00"){
									echo date('Y-M-d',strtotime($row['date1']));
								}else{
									echo "-";
								} ?></td>
						</tr>
					</table>	
				</div>
			</div>

			<div class='column'>				
				<div class='ui segment'>
					<h2 class='ui olive center aligned dividing header'>PuD</h2>

					<form action="inputupdate.php" method="post" class="ui form">
						<input type='hidden' name='step' value='4'>
						<input type='hidden' name='vaveid' value=<?php echo $row['id']; ?>>
						<div class='two fields'>
							<div class='required field'>
								<label>Cost Reduction / PC</label>
								<input type='text' name='costperpc' value='<?php echo $row['costPerPc']?>' required>
							</div>
							<div class='required field'>
								<label>Cost Reduction / Vehicle</label>
								<input type='text' name='costreduction' value='<?php echo $row['costReduction']?>' required>
							</div>
						</div>
						<div class='two fields'>
							<div class='field'>
								<label>Piece / Month</label>
								<input type='text' name='piece' value='<?php echo $row['piece']?>'>
							</div>
							<div class='required field'>
								<label>Cost Impact / Month</label>
								<input type='text' name='costimpact' value='<?php echo $row['costImpact']?>' required>
							</div>
						</div>

						<!-- Submit button -->
						<button class="ui green inverted button" type="submit">Submit</button>
					</form>	
				</div>	
				<div class='ui segment'>
					<h2 class='ui olive center aligned dividing header'>PPEQ</h2>
					<table class='ui compact celled selectable center aligned table'>
						<thead><tr>
							<th class='right aligned eight wide'>Proposer Number</th>
							<th class='left aligned eight wide'><?php echo $row['teardownNo']; ?></th>
						</tr></thead>
						<thead><tr>
							<th class='right aligned eight wide'>Manufacturer's Number</th>
							<th class='left aligned eight wide'><?php echo $row['manufacturerNo']; ?></th>
						</tr></thead>
						<tr>
							<td class='right aligned'>Status</td>
							<td class='left aligned'><?php echo $row['status']; ?></td>
						</tr>
						<tr>
							<td class='right aligned'>Received Date from PE</td>
							<td class='left aligned'><?php 
								if($row['receivedFromPE'] != "0000-00-00"){
									echo date('Y-M-d',strtotime($row['receivedFromPE']));
								}else{
									echo "-";
								} ?></td>
						</tr>
						<tr>
							<td class='right aligned'>Send Date to PuD</td>
							<td class='left aligned'><?php 
								if($row['sendToPuD'] != "0000-00-00"){
									echo date('Y-M-d',strtotime($row['sendToPuD']));
								}else{
									echo "-";
								} ?></td>
						</tr>
						<tr>
							<td class='right aligned'>Replied Date from PuD</td>
							<td class='left aligned'><?php 
								if($row['repliedFromPuD'] != "0000-00-00"){
									echo date('Y-M-d',strtotime($row['repliedFromPuD']));
								}else{
									echo $row['repliedFromPuD'];
								} ?></td>
						</tr>
						<tr>
							<td class='right aligned'>Send Date to EA</td>
							<td class='left aligned'><?php 
								if($row['sendToEA'] != "0000-00-00"){
									echo date('Y-M-d',strtotime($row['sendToEA']));
								}else{
									echo "-";
								} ?></td>
						</tr>
						
						<tr><td class='center aligned' colspan=2><h3 class='ui olive header'>Uploader Info</h3></td></tr>
						<tr>
							<td class='right aligned'>Uploader</td>
							<td class='left aligned'><?php echo $row['uploader2']; ?></td>
						</tr>
						<tr>
							<td class='right aligned'>Upload Date</td>
							<td class='left aligned'><?php 
								if($row['date2'] != "0000-00-00"){
									echo date('Y-M-d',strtotime($row['date2']));
								}else{
									echo "-";
								} ?></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class='ui divider'></div>

	<script>
		$(document).ready(function() {
			$('.resultdetail').popup();
		});
	</script>
</body>
</html>