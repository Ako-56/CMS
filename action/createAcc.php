<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$AccntName = ucwords($_POST['accName']);
	$AccntStatus = $_POST['accStatus']; 

	$sql = "INSERT INTO church_acc (AccntName, Accnt_active, Savedate) VALUES ('$AccntName', '$AccntStatus', NOW())";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Added";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the acc";
	}
	 

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST