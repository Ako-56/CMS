<?php 	

require_once 'core.php';

$groupId = $_POST['groupId'];

$sql = "SELECT member_reg.RegNo, member_reg.Name, member_reg.Gender
		FROM member_reg
		LEFT JOIN member_group ON member_reg.RegNo = member_group.RegNo AND member_group.GroupCode = '$groupId'
		WHERE member_group.RegNo IS NULL AND member_reg.Status = '1'";
$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
$Gender='';

 while($row = $result->fetch_array()) {
	
	if($row[2]==1){
		$Gender='Male';
	}else if($row[2]==2){
		$Gender='Female';
	}else{
		$Gender='Others';
	}
 	$button = '<!-- Single button -->
	<input type="checkbox" name="selMemb[]" class="memberCheckbox" id="selMemb['.$row[0].']" value="'.$row[0].'">';

 	$output['data'][] = array( 		
 		$row[1], 		
 		$Gender, 		
 		$button
 		); 	
 } // /while 

} // if num_rows

$connect->close();

echo json_encode($output);