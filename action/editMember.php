<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	
  $memberId = $_POST['memberId'];

  $memberDate 		= date('Y-m-d', strtotime($_POST['memberDate']));  
  $memberName 		= $_POST['memberName'];
  $memberContact 	= $_POST['memberContact'];
  $memberGender 	= $_POST['memberGender'];
  $memberStation 	= $_POST['memberStation'];
  $memberJumuiya    = $_POST['memberJumuiya'];
  $memberStatus		= $_POST['memberStatus'];
  $userid 		    = $_SESSION['userId'];

	$sql = "UPDATE member_reg SET Name='$memberName',CellNo='$memberContact',Gender='$memberGender',StationCode='$memberStation',
	JumuiyaCode='$memberJumuiya',Status= '$memberStatus',EditedBy='$userid',EditDate=NOW() WHERE RegNo='$memberId'"; 
	
	if($connect->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Updated";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while updating the member";
	}	
	
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST
// echo json_encode($valid);