<?php 	

require_once 'core.php';

$sql = "SELECT AccntCode, AccntName, Accnt_active, Savedate FROM church_acc WHERE Accnt_active = 1";
$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $activeAccnt = ""; 

 while($row = $result->fetch_array()) {
 	$accId = $row[0];
 	// active 
 	if($row[2] == 1) {
 		// activate member
 		$activeAccnt = "<label class='label label-success'>Active</label>";
 	} else {
 		// deactivate member
 		$activeAccnt = "<label class='label label-danger'>Not Active</label>";
 	}

 	$button = '<!-- Single button -->
	<div class="btn-acc">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" data-target="#editAccntModel" onclick="editAcc('.$accId.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeAccntModal" onclick="removeAcc('.$accId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
	  </ul>
	</div>';

 	$output['data'][] = array( 		
 		$row[1], 		
 		$activeAccnt,
 		$button
 		); 	
 } // /while 

} // if num_rows

$connect->close();

echo json_encode($output);