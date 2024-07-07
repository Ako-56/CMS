<?php 	

require_once 'core.php';

$sql = "SELECT jumuiya.JumuiyaCode, jumuiya.JumuiyaName, jumuiya.StationCode,
 		jumuiya.JumuiyaStatus,parish_station.StationName FROM jumuiya 
		INNER JOIN parish_station ON jumuiya.StationCode = parish_station.StationCode   
		WHERE jumuiya.JumuiyaStatus = 1";

$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $active = ""; 

 while($row = $result->fetch_array()) {
 	$jumuiyaId = $row[0];
	//echo $jumuiyaId; exit;
 	// active 
 	if($row[3] == 1) {
 		// activate member
 		$active = "<label class='label label-success'>Active</label>";
 	} else {
 		// deactivate member
 		$active = "<label class='label label-danger'>Not Active</label>";
 	} // /else

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" id="editJumuiyaModalBtn" data-target="#editJumuiyaModal" onclick="editJumuiya('.$jumuiyaId.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeJumuiyaModal" id="removeJumuiyaModalBtn" onclick="removeJumuiya('.$jumuiyaId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
	  </ul>
	</div>';

	$station = $row[4];

 	$output['data'][] = array( 		
 		// jumuiya name
 		$row[1], 		 	
 		// station
 		$station,
 		// category 		
 		$active,
 		// button
 		$button 		
 		); 	
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);