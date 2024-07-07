<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$StationName = ucwords($_POST['stationName']);
	$StationStatus = $_POST['stationStatus']; 

	$sql = "INSERT INTO parish_station (StationName, Station_active, Savedate) VALUES ('$StationName', '$StationStatus', NOW())";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Added";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the station";
	}
	 

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST