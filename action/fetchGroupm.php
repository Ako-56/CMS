<?php 	

require_once 'core.php';

$groupId = $_POST['groupId'];

$sql = "SELECT member_group.Id,member_group.GroupCode,member_group.RegNo,member_group.Status_m,member_group.Jdate,
		member_reg.Name
		FROM member_group
		INNER JOIN member_reg ON member_group.RegNo=member_reg.RegNo
		INNER JOIN church_group ON member_group.RegNo=church_group.GroupCode
		WHERE member_group.GroupCode = '$groupId' AND member_group.Status_m='1'";
$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $activeGroup = ""; 

 while($row = $result->fetch_array()) {
 	$rowId = $row[0];
 	// active 
 	if($row[3] == 1) {
 		// activate member
 		$activeGroup = "<label class='label label-success'>Active</label>";
 	} else {
 		// deactivate member
 		$activeGroup = "<label class='label label-danger'>Not Active</label>";
 	}

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" data-target="#removeRowModal" onclick="removeRow('.$rowId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
	  </ul>
	</div>';

 	$output['data'][] = array( 		
 		$row[5], 		
 		$row[4], 		
 		$activeGroup,
 		$button,
 		); 	
 } // /while 

} // if num_rows

$connect->close();

echo json_encode($output);