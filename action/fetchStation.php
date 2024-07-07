<?php 	

require_once 'core.php';

$sql = "SELECT StationCode, StationName, Station_active, Savedate FROM parish_station WHERE Station_active = 1";
$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $activeStation = ""; 

 while($row = $result->fetch_array()) {
 	$stationId = $row[0];
 	// active 
 	if($row[2] == 1) {
 		// activate member
 		$activeStation = "<label class='label label-success'>Active</label>";
 	} else {
 		// deactivate member
 		$activeStation = "<label class='label label-danger'>Not Active</label>";
 	}

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" data-target="#editBrandModel" onclick="editStation('.$stationId.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeMemberModal" onclick="removeStation('.$stationId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
	  </ul>
	</div>';

 	$output['data'][] = array( 		
 		$row[1], 		
 		$activeStation,
 		$button
 		); 	
 } // /while 

} // if num_rows

$connect->close();

echo json_encode($output);