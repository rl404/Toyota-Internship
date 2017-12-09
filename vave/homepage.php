<?php
 	include 'header.php'; 
 	include 'db.php';

	echo "<div class='ui center aligned container'>
		<h1 class='ui center aligned header' id='titleheader1'>
			VA-VE Information System
		</h1>

		<div class='ui divider'></div>		
		<div class='ui form'>
			<div class='one wide field' style='margin-left: calc(100% - 100px);'>";

		$todayYear = date('Y');
			// <input type='text' id='graphyearbox' value='$todayYear'>
	echo "		
			</div>
		</div>

		<div id='homepagecontent'>";
		// include 'homepage2.php';

		echo "</div>";

	echo "
		<div class='ui container' style='width:50%;'>
		<div class='ui raised center aligned segment'>
			<h3 class='ui icon header'>
				<i class='idea icon'></i>
				 <div class='content'>
					Idea Proposing
				</div>
				<div class='sub header'>
					Propose new idea for vehicle part number.
				</div>
			</h3>
		</div>
		<i class='arrow down icon'></i>

		<div class='ui raised center aligned segment'>
			<h3 class='ui icon header'>
				<i class='configure icon'></i>
				 <div class='content'>
					PE-ED Process and Approval
				 </div>
				 <div class='sub header'>
					Check and approve the new proposed idea.
				</div>
			</h3>
		</div>
		<i class='arrow down icon'></i>

		<div class='ui raised center aligned segment'>
			<h3 class='ui icon header'>
				<i class='search icon'></i>
				<div class='content'>
					PPEQ-ED Process
				</div>
				<div class='sub header'>
					Check the new proposed idea and send to PuD.
				</div>
			</h3>
		</div>
		<i class='arrow down icon'></i>

		<div class='ui raised center aligned segment'>
			<h3 class='ui icon header'>
				<i class='dollar icon'></i>
				<div class='content'>
					PuD Process
				</div>
				<div class='sub header'>
					Calculate cost reduction effect of the new proposed idea and send back to PPEQ-ED.
				</div>
			</h3>
		</div>
		<i class='arrow down icon'></i>

		<div class='ui raised center aligned segment'>
			<h3 class='ui icon header'>
				<i class='checkmark box icon'></i>
				<div class='content'>
					PPEQ-ED Approval
				</div>
				<div class='sub header'>
					Check and approve the cost reduction result from PuD.
				</div>
			</h3>
		</div>
		<i class='arrow down icon'></i>

		<div class='ui raised center aligned segment'>
			<h3 class='ui icon header'>
				<i class='send icon'></i>
				<div class='content'>
					EA-ED Process and Approval
				</div>
				<div class='sub header'>
					Final check of the new proposed idea and upload it to TMC.
				</div>
			</h3>
		</div>
		<i class='arrow down icon'></i>

		<div class='ui raised center aligned segment'>
			<h3 class='ui icon header'>
				<i class='thumbs outline up icon'></i>
				<div class='content'>
					TMC Approval
				</div>
				<div class='sub header'>
					Check and Approve the new proposed idea and publish ECI Number.
				</div>
			</h3>
		</div>
		</div>";

	echo "<div class='ui divider'></div></div>";
?>