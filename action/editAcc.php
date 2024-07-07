<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$accName = $_POST['editAccntName'];
  $accStatus = $_POST['editAccntStatus']; 
  $accId = $_POST['accId'];

	$sql = "UPDATE church_acc SET AccntName = '$accName', Accnt_active = '$accStatus' WHERE AccntCode = '$accId'";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Updated";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the acc";
	}
	 
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST