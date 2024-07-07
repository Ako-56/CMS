<?php 
require_once 'php_action/db_connect.php'; 
require_once 'includes/header.php'; 

if($_GET['o'] == 'add') { 
// add member
	echo "<div class='div-request div-hide'>add</div>";
} else if($_GET['o'] == 'manord') { 
	echo "<div class='div-request div-hide'>manord</div>";
} else if($_GET['o'] == 'editOrd') { 
	echo "<div class='div-request div-hide'>editOrd</div>";
} // /else manage member


?>

<ol class="breadcrumb">
  <li><a href="dashboard">Home</a></li>
  <li>Members</li>
  <li class="active">
  	<?php if($_GET['o'] == 'add') { ?>
  		Add Member
		<?php } else if($_GET['o'] == 'manord') { ?>
			Manage Member
		<?php } // /else manage member ?>
  </li>
</ol>


<h4>
	<i class='glyphicon glyphicon-circle-arrow-right'></i>
	<?php if($_GET['o'] == 'add') {
		echo "<a style='text-decoration:none;' href='members?o=manord#a'>Manage Members</a>";
	} else if($_GET['o'] == 'manord') { 
		echo "<a style='text-decoration:none;' href='members?o=add#a'>Add Members</a>";
	} else if($_GET['o'] == 'editOrd') { 
		echo "<a style='text-decoration:none;' href='members?o=manord#a'>Manage Members</a>";
	}
	?>	
</h4>



<div class="panel panel-default">
	<div class="panel-heading">

		<?php if($_GET['o'] == 'add') { ?>
  		<i class="glyphicon glyphicon-plus-sign"></i>	Add Member
		<?php } else if($_GET['o'] == 'manord') { ?>
			<i class="glyphicon glyphicon-edit"></i> Manage Member
		<?php } else if($_GET['o'] == 'editOrd') { ?>
			<i class="glyphicon glyphicon-edit"></i> Edit Member
		<?php } ?>

	</div> <!--/panel-->	
	<div class="panel-body">
			
		<?php if($_GET['o'] == 'add') { 
			// add member
			?>			

			<div class="success-messages"></div> <!--/success-messages-->

  		<form class="form-horizontal" method="POST" action="php_action/createMember.php" id="createMemberForm">

			  <div class="form-group">
			    <label for="memberDate" class="col-sm-3 control-label">Member Enroll Date</label>
			    <div class="col-sm-9">
			      <input type="date" class="form-control" id="memberDate" name="memberDate" autocomplete="off" value="<?php echo date('Y-m-d'); ?>"/>
			    </div>
			  </div> <!--/form-group-->
			  <div class="form-group">
			    <label for="memberName" class="col-sm-3 control-label">Member Name</label>
			    <div class="col-sm-9">
			      <input type="text" class="form-control" id="memberName" name="memberName" placeholder="Member Name" autocomplete="off" />
			    </div>
			  </div> <!--/form-group-->
			  <div class="form-group">
			    <label for="memberContact" class="col-sm-3 control-label">Member Contact</label>
			    <div class="col-sm-9">
			      <input type="text" class="form-control" id="memberContact" name="memberContact" placeholder="Contact Number" autocomplete="off" />
			    </div>
			  </div> <!--/form-group-->		
			  <div class="form-group">
				<label for="memberGender" class="col-sm-3 control-label">Gender</label>
				<div class="col-sm-9">
				  <select class="form-control" name="memberGender" id="memberGender">
					<option value="">~~SELECT~~</option>
					<option value="1">Male</option>
					<option value="2">Female</option>
					<option value="3">Other</option>
				  </select>
				</div>
			  </div> <!--/form-group-->
			  <div class="form-group">
				<label for="memberStation" class="col-sm-3 control-label">Station</label>
				<div class="col-sm-9">
				  <select class="form-control" name="memberStation" id="memberStation" onchange="getJumuiyaData(this);">
					<option value="">~~SELECT~~</option>
					<?php 
				      	$sql = "SELECT StationCode, StationName FROM parish_station WHERE Station_active = 1";
								$result = $connect->query($sql);

						while($row = $result->fetch_array()) {
							echo "<option value='".$row[0]."'>".$row[1]."</option>";
						} // while	
				    ?>
				  </select>
				</div>
			  </div> <!--/form-group-->
			  <div class="form-group">
				<label for="memberJumuiya" class="col-sm-3 control-label">Jumuiya</label>
				<div class="col-sm-9">
				  <select class="form-control" name="memberJumuiya" id="memberJumuiya">
					<option value="">~~SELECT~~</option>
				  </select>
				</div>
			  </div> <!--/form-group-->	  
			  <div class="form-group">
				<label for="memberStatus" class="col-sm-3 control-label">Status</label>
				<div class="col-sm-9">
				  <select class="form-control" name="memberStatus" id="memberStatus">
					<option value="">~~SELECT~~</option>
					<option value="1">Active</option>
				    <option value="2">Not Active</option>
				  </select>
				</div>
			  </div> <!--/form-group-->	  

			  <div class="form-group submitButtonFooter">
			    <div class="col-sm-offset-3 col-sm-9">
			      <button type="submit" id="createMemberBtn" data-loading-text="Loading..." class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>

			      <button type="reset" class="btn btn-default" onclick="resetMemberForm()"><i class="glyphicon glyphicon-erase"></i> Reset</button>
			    </div>
			  </div>
			</form>
		<?php } else if($_GET['o'] == 'manord') { 
			// manage member
			?>

			<div id="success-messages"></div>
			
			<table class="table" id="manageMemberTable">
			  	<thead>
			  		<tr>			  			
			  			<th style="width:10%;">RegNo</th>
			  			<th style="width:30%;">Name</th>
			  			<th style="width:20%;">Station</th>
			  			<th style="width:10%;">Jumuiya</th>
			  			<th style="width:15%;">Contact</th>			  			
			  			<th style="width:15%;">Date</th>			  			
			  			<th style="width:25%;">Status</th>			  			
			  			<th style="width:10%;"></th>
			  		</tr>
			  	</thead>			  	
			</table>

		<?php 
		// /else manage member
		} else if($_GET['o'] == 'editOrd') {
			// get member
			?>
			
			<div class="success-messages"></div> <!--/success-messages-->

  		<form class="form-horizontal" method="POST" action="php_action/editMember.php" id="editMemberForm">

  			<?php $memberId = $_GET['i'];

  			$sql = "SELECT member_reg.RegNo,member_reg.Name,member_reg.Status,member_reg.Savedate,parish_station.StationName,jumuiya.JumuiyaName,
					member_reg.StationCode,member_reg.JumuiyaCode,
					member_reg.CellNo,member_reg.Gender,member_reg.Status FROM member_reg 	
					INNER JOIN parish_station ON member_reg.StationCode = parish_station.StationCode
					INNER JOIN jumuiya ON member_reg.JumuiyaCode = jumuiya.JumuiyaCode
					WHERE member_reg.RegNo='$memberId' AND member_reg.Status = 1";
			
				$result = $connect->query($sql);
				$data = $result->fetch_row();
  			?>

			  <div class="form-group">
			    <label for="memberDate" class="col-sm-3 control-label">Member Enroll Date</label>
			    <div class="col-sm-9">
			      <input type="date" class="form-control" id="memberDate" name="memberDate" autocomplete="off" value="<?php echo date('Y-m-d',strtotime($data[3])); ?>"/>
			    </div>
			  </div> <!--/form-group-->
			  <div class="form-group">
			    <label for="memberName" class="col-sm-3 control-label">Member Name</label>
			    <div class="col-sm-9">
			      <input type="text" class="form-control" id="memberName" name="memberName" placeholder="Member Name" value="<?php echo $data[1]; ?>" autocomplete="off" />
			    </div>
			  </div> <!--/form-group-->
			  <div class="form-group">
			    <label for="memberContact" class="col-sm-3 control-label">Member Contact</label>
			    <div class="col-sm-9">
			      <input type="text" class="form-control" id="memberContact" name="memberContact" placeholder="Contact Number" value="<?php echo $data[8]; ?>" autocomplete="off" />
			    </div>
			  </div> <!--/form-group-->		
			  <div class="form-group">
				<label for="memberGender" class="col-sm-3 control-label">Gender</label>
				<div class="col-sm-9">
				  <select class="form-control" name="memberGender" id="memberGender">
					<option value="">~~SELECT~~</option>
					<option <?php if($data[9]=='1'){?>selected<?php } ?> value="1">Male</option>
					<option <?php if($data[9]=='2'){?>selected<?php } ?> value="2">Female</option>
					<option <?php if($data[9]=='3'){?>selected<?php } ?> value="3">Other</option>
				  </select>
				</div>
			  </div> <!--/form-group-->
			  <div class="form-group">
				<label for="memberStation" class="col-sm-3 control-label">Station</label>
				<div class="col-sm-9">
				  <select class="form-control" name="memberStation" id="memberStation" onchange="getJumuiyaData(this);">
					<option value="">~~SELECT~~</option>
					<?php 
				      	$sql = "SELECT StationCode, StationName FROM parish_station WHERE Station_active = 1";
								$result = $connect->query($sql);

						while($row = $result->fetch_array()) {
							?>
							 <option <?php if($data[6]==$row[0]){?>selected<?php } ?> value='<?php echo $row[0]; ?>'><?php echo $row[1]; ?></option>
							 <?php
						} // while	
				    ?>
				  </select>
				</div>
			  </div> <!--/form-group-->
			  <div class="form-group">
				<label for="memberJumuiya" class="col-sm-3 control-label">Jumuiya</label>
				<div class="col-sm-9">
				  <select class="form-control" name="memberJumuiya" id="memberJumuiya">
					<option value="<?php echo $data[7]; ?>"><?php if(!empty($data[7])){ echo $data[4]; }else{ echo  "~~SELECT~~"; } ?></option>
				  </select>
				</div>
			  </div> <!--/form-group-->	  
			  <div class="form-group">
				<label for="memberStatus" class="col-sm-3 control-label">Status</label>
				<div class="col-sm-9">
				  <select class="form-control" name="memberStatus" id="memberStatus">
					<option value="">~~SELECT~~</option>
					<option <?php if($data[2]=='1'){?>selected<?php } ?> value="1">Active</option>
				    <option <?php if($data[2]=='2'){?>selected<?php } ?> value="2">Not Active</option>
				  </select>
				</div>
			  </div> <!--/form-group-->	  
			  <div class="form-group editButtonFooter">
			    <div class="col-sm-offset-3 col-sm-9">
			    <input type="hidden" name="memberId" id="memberId" value="<?php echo $_GET['i']; ?>" />

			    <button type="submit" id="editMemberBtn" data-loading-text="Loading..." class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
			      
			    </div>
			  </div>
		</form>
	
			<?php
		} // /get Member else  ?>

	</div> <!--/panel-->	
</div> <!--/panel-->	

<!-- remove member -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeMemberModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Member</h4>
      </div>
      <div class="modal-body">

      	<div class="removeMemberMessages"></div>

        <p>Do you really want to remove ?</p>
      </div>
      <div class="modal-footer removeProductFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removeMemberBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /remove member-->


<script src="custom/js/member.js"></script>

<?php require_once 'includes/footer.php'; ?>


	