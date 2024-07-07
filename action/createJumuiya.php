<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	  $jumuiyaName 		= $_POST['jumuiyaName'];
	  $stationName 		= $_POST['stationName'];
	  $jumuiyaStatus 	= $_POST['jumuiyaStatus'];

	$sql = "INSERT INTO jumuiya (JumuiyaName, StationCode, JumuiyaStatus) 
	VALUES ('$jumuiyaName', '$stationName', '$jumuiyaStatus')";

	if($connect->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Added";	
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while adding the members";
	}	

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST