<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$GroupName = ucwords($_POST['groupName']);
	$GroupStatus = $_POST['groupStatus']; 

	$sql = "INSERT INTO church_group (GroupName, Group_active, Savedate) VALUES ('$GroupName', '$GroupStatus', NOW())";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Added";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the group";
	}
	 

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST