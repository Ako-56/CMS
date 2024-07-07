<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array(), 'RegNo' => '');
// print_r($valid);
if($_POST) {	

  $memberDate 		= date('Y-m-d', strtotime($_POST['memberDate']));  
  $memberName 		= $_POST['memberName'];
  $memberContact 	= $_POST['memberContact'];
  $memberGender 	= $_POST['memberGender'];
  $memberStation 	= $_POST['memberStation'];
  $memberJumuiya    = $_POST['memberJumuiya'];
  $memberStatus		= $_POST['memberStatus'];
  $userid 		    = $_SESSION['userId'];

	
	$sql = "INSERT INTO member_reg (Savedate,Name,CellNo,Gender,StationCode,JumuiyaCode,Status,CreatedBy) VALUES 
	('$memberDate', '$memberName', '$memberContact', '$memberGender', '$memberStation', '$memberJumuiya', '$memberStatus',$userid)";
	
	$RegNo;
	if($connect->query($sql) === TRUE) {
		$RegNo = $connect->insert_id;
		$valid['RegNo'] = $RegNo;	
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Added";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the member";
	}
	
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST
// echo json_encode($valid);