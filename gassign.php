<?php require_once 'includes/header.php'; ?>
<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li id="sidebarCollapse">
			<a href="#"><i class="glyphicon glyphicon-tasks"></i> </a>
		  </li>		  
		  <li><a href="dashboard">Home</a></li>		  
		  <li class="active">Church Group Members</li>
		</ol>
		<h4>
			<?php if($_GET['a'] == 'Mng') { ?>
				<i class='glyphicon glyphicon-circle-arrow-left'></i>
				<a style='text-decoration:none;' href='groups#a'>Manage Groups</a>
				<i class='glyphicon glyphicon-circle-arrow-right'></i>
				<a style='text-decoration:none;' href='gassign?a=Asgn#a'>Assign Member Groups</a>
			<?php } else if($_GET['a'] == 'Asgn') { ?>
				<i class='glyphicon glyphicon-circle-arrow-left'></i>
				<a style='text-decoration:none;' href='gassign?a=Mng#a'>Manage Group Members</a>
			<?php }	?>	
		</h4>
		
		
	<?php if($_GET['a'] == 'Mng') { // manage member ?>	
	
		<div class="panel panel-default">
			<div class="panel-heading"> 
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Group Members</div>
				<div class="div-action pull pull-right">
					<div class="form-group">
						 <select class="form-control" id="memberGroup" onchange="getGroupData(this);">
							<option value="">~~SELECT GROUP~~</option>
							<?php 
								$sql = "SELECT GroupCode, GroupName FROM church_group WHERE Group_active = 1";
										$result = $connect->query($sql);

								while($row = $result->fetch_array()) {
									echo "<option value='".$row[0]."'>".$row[1]."</option>";
								} // while	
							?>
						 </select>
					</div>
				</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>			
				
				<table class="table" id="manageGroupmTable">
					<thead>
						<tr>							
							<th>Name</th>
							<th>Join Date</th>
							<th>Status</th>
							<th style="width:15%;">Options</th>
						</tr>
					</thead>
				</table>
				<!-- /table -->

			</div> <!-- /panel-body -->
		</div> <!-- /panel -->	
	<?php } ?>
	
	<?php if($_GET['a'] == 'Asgn') { // asign member ?>
	<form class="form-horizontal" id="submitGroupForm" action="php_action/assignGroup.php" method="POST">
		<div class="panel panel-default">
			<div class="panel-heading"> 
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Assign Group Members</div>
			</div>
		</div>
		<div id="add-messages"></div>  
		<div class="col-md-4">
			<div class="form-group">
				 <select class="form-control" id="membGroup" name="membGroup" onchange="getMembData(this);">
					<option value="">~~SELECT GROUP~~</option>
					<?php 
						$sql = "SELECT GroupCode, GroupName FROM church_group WHERE Group_active = 1";
								$result = $connect->query($sql);

						while($row = $result->fetch_array()) {
							echo "<option value='".$row[0]."'>".$row[1]."</option>";
						} // while	
					?>
				 </select>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary" id="assignGroupBtn" data-loading-text="Loading..." autocomplete="off">Save Changes</button>
			  </div>
		</div>
		<div class="col-md-8">
			<div id="wrapperx">
				<table class="table" id="manageMembTable">
					<thead>
						<tr>							
							<th>Name</th>
							<th>Gender</th>
							<th style="width:15%;">Options</th>
						</tr>
					</thead>
				</table>
				<!-- /table -->
			</div><!-- /wrapperx -->
		</div>
	</form>
	<?php } ?>
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->
<!-- remove group -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeRowModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Member From Group</h4>
      </div>
      <div class="modal-body">
        <p>Do you really want to remove ?</p>
      </div>
      <div class="modal-footer removeRowFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removeRowBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /remove group -->

<script src="custom/js/gassign.js"></script>

<?php require_once 'includes/footer.php'; ?>