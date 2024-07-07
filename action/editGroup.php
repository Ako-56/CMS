<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$groupName = $_POST['editGroupName'];
  $groupStatus = $_POST['editGroupStatus']; 
  $groupId = $_POST['groupId'];

	$sql = "UPDATE church_group SET GroupName = '$groupName', Group_active = '$groupStatus' WHERE GroupCode = '$groupId'";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Updated";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the group";
	}
	 
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST