<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {
	$jumuiyaId = $_POST['jumuiyaId'];
	$jumuiyaName 		= $_POST['editJumuiyaName']; 
    $stationName 		= $_POST['editStationName'];
    $jumuiyaStatus 	    = $_POST['editJumuiyaStatus'];
	
	$sql = "UPDATE jumuiya SET JumuiyaName = '$jumuiyaName', StationCode = '$stationName', JumuiyaStatus = '$jumuiyaStatus' WHERE JumuiyaCode = $jumuiyaId ";

	if($connect->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Update";	
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while updating jumuiya info";
	}

} // /$_POST
	 
$connect->close();

echo json_encode($valid);
 
