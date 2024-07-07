<?php 	

require_once 'core.php';

$sql = "SELECT member_reg.RegNo,member_reg.Savedate,member_reg.Name,member_reg.CellNo,member_reg.Gender,
parish_station.StationName,jumuiya.JumuiyaName,member_reg.Status,member_reg.CreatedBy
FROM member_reg 
INNER JOIN parish_station ON member_reg.StationCode=parish_station.StationCode
INNER JOIN jumuiya ON member_reg.JumuiyaCode=jumuiya.JumuiyaCode
WHERE Status=1";
$result = $connect->query($sql);



$output = array('data' => array());

if($result->num_rows > 0) { 
 
 $x = 1;

 while($row = $result->fetch_array()) {
 	$RegNo = $row[0];

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a href="members?o=editOrd&i='.$RegNo.'#a" id="editMemberModalBtn"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
	    
	    <li><a type="button" onclick="printMember('.$RegNo.')"> <i class="glyphicon glyphicon-print"></i> Print </a></li>
	    
	    <li><a type="button" data-toggle="modal" data-target="#removeMemberModal" id="removeMemberModalBtn" onclick="removeMember('.$RegNo.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
	  </ul>
	</div>';

	if($row[7] == 1) {
 		// activate member
 		$activeMember = "<label class='label label-success'>Active</label>";
 	} else {
 		// deactivate member
 		$activeMember = "<label class='label label-danger'>Not Active</label>";
 	}

 	$output['data'][] = array( 		
 		
		// name
 		$row[0],
 		// name
 		$row[2],
 		// member station
 		$row[5], 
 		// member jumuiya
 		$row[6],
		// member contact
		$row[3],
		// member date
		date('d-m-Y',strtotime($row[1])),
		// member status
		$activeMember, 		 	
 		// button
 		$button 		
 		);
		
 	$x++;
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);
