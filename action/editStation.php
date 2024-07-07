<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$stationName = $_POST['editStationName'];
  $stationStatus = $_POST['editStationStatus']; 
  $stationId = $_POST['stationId'];

	$sql = "UPDATE parish_station SET StationName = '$stationName', Station_active = '$stationStatus' WHERE StationCode = '$stationId'";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Updated";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the station";
	}
	 
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST