<html>
	<?php 
	// Header
	include "../header.php" 
	?>

	<div class="ui container">

		<!-- Title -->
		<h1 class='ui center aligned header' id='titleheader2'>Change Log</h1>
		<div class="ui divider"></div>

		<!-- V1.8 -->
		<div class='ui segment'>
			<h3 class='ui dividing header'>
				V1.8 <span id='titleheader1'>/ 28-Sep-2017</span>
			</h3>			
			<ul class="ui list">
				<li>Added new feature: update supplier owned revision everytime creating cover letter (by manual and auto).</li>				
				<li>Added new feature: check if the revision has been delivered to the supplier.</li>
				<li>Added update form of deliver status for undelivered revision.</li>
				<li>Added update form to add contact of supplier.</li>
				<li>Added download link list of TS that the supplier owned.</li>
				<li>Added request date and deliver date tooltip when hover supplier owned revision.</li>
				<li>Added issued date tooltip when hover latest TS revision.</li>
				<li>Added supplier PIC textbox when creating cover letter (manual and auto).</li>
				<li>Minor changes</li>
			</ul>
		</div>

		<!-- V1.7 -->
		<div class='ui segment' id='olderversion'>
			<h3 class='ui dividing header'>
				V1.7 <span id='titleheader1'>/ 31-Aug-2017</span>
			</h3>			
			<ul class="ui list">
				<li>Added new feature: send notification email everytime update TS revision.</li>
				<li>Added option to disable notification email in setting page.</li>
				<li>Added download link for list of suppliers who are using the TS in <a href='../list/datats.php'>TS Update</a> page and <a href='../list/ts.php'>TS x Supplier</a> page.</li>
				<li>Added check box to set today as delivery date in export page</li>
				<li>Combined account with Sylegi system.</li>
				<li>Added short explanation in all code</li>
				<li>Minor changes</li>
			</ul>
		</div>

		<!-- V1.6 -->
		<div class='ui segment' id='olderversion'>
			<h3 class='ui dividing header'>
				V1.6 <span id='titleheader1'>/ 14-Aug-2017</span>
			</h3>
			
			<ul class="ui list">
				<li>Fixed some TS missing in TSxSupplier page.</li>
				<li>Added manual cover letter creator feature.</li>
				<li>Converted help.docx to help.pdf and go to a new tab.</li>
			</ul>
		</div>

		<!-- V1.5 -->
		<div class='ui segment' id='olderversion'>
			<h3 class='ui dividing header'>
				V1.5 <span id='titleheader1'>/ 10-Aug-2017</span>
			</h3>
			
			<ul class="ui list">
				<li>Added supplier request PIC.</li>
				<li>Added update TS revision PIC.</li>
				<li>Fixed latest revision checker related with EST. and DISUSE (hopefully).</li>
				<li>Converted all month from number to string everywhere.</li> 
				<li>Minor changes</li>
			</ul>
		</div>

		<!-- V1.4 -->
		<div class='ui segment' id='olderversion'>
			<h3 class='ui dividing header'>
				V1.4 <span id='titleheader1'>/ 9-Aug-2017</span>
			</h3>
			
			<ul class="ui list">
				<li>Launching officially (yay...).</li>
				<li>Added <a href='../setting/setting.php'>setting</a> page.</li>
				<li>Added <a href='../how to.docx'>How to</a> document.</li>
			</ul>
		</div>

		<!-- V1.3 -->
		<div class='ui segment' id='olderversion'>
			<h3 class='ui dividing header'>
				V1.3 <span id='titleheader1'>/ 8-Aug-2017</span>
			</h3>
			
			<ul class="ui list">
				<li>Initial Release.</li>
				<li>Features:
					<ul>
						<li>Login/ Logout</li>
						<li>Input new supplier request
							<ul>
								<li>TS revision checker</li>
							</ul>
						</li>
						<li>Update TS revision (from TMC email)
							<ul>
								<li>Automatic</li>
								<li>Manual</li>
							</ul>
						</li>
						<li>List
							<ul>
								<li>TS x Supplier</li>
								<li>Supplier x TS</li>
								<li>TS revision history</li>
								<li>Supplier request history</li>
							</ul>
						</li>
						<li>Cover Letter creator</li>
					</ul>
				</li>
			</ul>
		</div>
		
	</div>
	<div class="ui divider"></div>
</body>
</html>