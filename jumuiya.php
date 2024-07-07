<?php require_once 'php_action/db_connect.php' ?>
<?php require_once 'includes/header.php'; ?>

<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard">Home</a></li>		  
		  <li class="active">Jumuiya</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Jumuiya</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>

				<div class="div-action pull pull-right" style="padding-bottom:20px;">
					<button class="btn btn-default button1" data-toggle="modal" id="addJumuiyaModalBtn" data-target="#addJumuiyaModal"> <i class="glyphicon glyphicon-plus-sign"></i> Add Jumuiya </button>
				</div> <!-- /div-action -->				
				
				<table class="table" id="manageJumuiyaTable">
					<thead>
						<tr>
							<th>Jumuiya Name</th>
							<th>Station</th>
							<th>Status</th>
							<th style="width:15%;">Options</th>
						</tr>
					</thead>
				</table>
				<!-- /table -->

			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->


<!-- add jumuiya -->
<div class="modal fade" id="addJumuiyaModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

    	<form class="form-horizontal" id="submitJumuiyaForm" action="php_action/createJumuiya.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-plus"></i> Add Jumuiya</h4>
	      </div>

	      <div class="modal-body" style="max-height:450px; overflow:auto;">

	      	<div id="add-jumuiya-messages"></div>  	           	       

	        <div class="form-group">
	        	<label for="jumuiyaName" class="col-sm-3 control-label">Jumuiya Name: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="jumuiyaName" placeholder="Jumuiya Name" name="jumuiyaName" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->	          	  	        

	        <div class="form-group">
	        	<label for="stationName" class="col-sm-3 control-label">Station Name: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <select class="form-control" id="stationName" name="stationName">
				      	<option value="">~~SELECT~~</option>
				      	<?php 
				      	$sql = "SELECT StationCode, StationName, Station_active FROM parish_station WHERE Station_active = 1";
								$result = $connect->query($sql);

								while($row = $result->fetch_array()) {
									echo "<option value='".$row[0]."'>".$row[1]."</option>";
								} // while
								
				      	?>
				      </select>
				    </div>
	        </div> <!-- /form-group-->					        	         	       

	        <div class="form-group">
	        	<label for="jumuiyaStatus" class="col-sm-3 control-label">Status: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <select class="form-control" id="jumuiyaStatus" name="jumuiyaStatus">
				      	<option value="">~~SELECT~~</option>
				      	<option value="1">Active</option>
				      	<option value="2">Not Active</option>
				      </select>
				    </div>
	        </div> <!-- /form-group-->	         	        
	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
	        
	        <button type="submit" class="btn btn-primary" id="createJumuiyaBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
	      </div> <!-- /modal-footer -->	      
     	</form> <!-- /.form -->	     
    </div> <!-- /modal-content -->    
  </div> <!-- /modal-dailog -->
</div> 
<!-- /add jumuiya -->


<!-- edit jumuiya station -->
<div class="modal fade" id="editJumuiyaModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	    	
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Jumuiya</h4>
	      </div>
	      <div class="modal-body" style="max-height:450px; overflow:auto;">

	      	<div class="div-loading">
	      		<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Loading...</span>
	      	</div>

	      	<div class="div-result">

				  <!-- Nav tabs -->
				  <ul class="nav nav-tabs" role="tablist">
				    <li role="presentation"><a href="#jumuiyaInfo" aria-controls="profile" role="tab" data-toggle="tab">Jumuiya Info</a></li>    
				  </ul>

				  <!-- Tab panes -->
				  <div class="tab-content">

				  	
				    <div role="tabpanel" class="tab-pane active" id="photo">
				    </div>
				    <!-- jumuiya image -->
				    <div role="tabpanel" class="tab-pane" id="jumuiyaInfo">
				    	<form class="form-horizontal" id="editJumuiyaForm" action="php_action/editJumuiya.php" method="POST">				    
				    	<br />

				    	<div id="edit-jumuiya-messages"></div>

				    	<div class="form-group">
			        	<label for="editJumuiyaName" class="col-sm-3 control-label">Jumuiya Name: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="editJumuiyaName" placeholder="Jumuiya Name" name="editJumuiyaName" autocomplete="off">
						    </div>
			        </div> <!-- /form-group-->     	        

			        <div class="form-group">
			        	<label for="editStationName" class="col-sm-3 control-label">Station Name: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <select class="form-control" id="editStationName" name="editStationName">
						      	<option value="">~~SELECT~~</option>
						      	<?php 
						      	$sql = "SELECT StationCode, StationName, Station_active FROM parish_station WHERE Station_active = 1";
										$result = $connect->query($sql);

										while($row = $result->fetch_array()) {
											echo "<option value='".$row[0]."'>".$row[1]."</option>";
										} // while
										
						      	?>
						      </select>
						    </div>
			        </div> <!-- /form-group-->	

			        <div class="form-group">
			        	<label for="editJumuiyaStatus" class="col-sm-3 control-label">Status: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <select class="form-control" id="editJumuiyaStatus" name="editJumuiyaStatus">
						      	<option value="">~~SELECT~~</option>
						      	<option value="1">Active</option>
						      	<option value="2">Not Active</option>
						      </select>
						    </div>
			        </div> <!-- /form-group-->	         	        

			        <div class="modal-footer editJumuiyaFooter">
				        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
				        
				        <button type="submit" class="btn btn-success" id="editJumuiyaBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
				      </div> <!-- /modal-footer -->				     
			        </form> <!-- /.form -->				     	
				    </div>    
				    <!-- /jumuiya info -->
				  </div>

				</div>
	      	
	      </div> <!-- /modal-body -->
	      	      
     	
    </div>
    <!-- /modal-content -->
  </div>
  <!-- /modal-dailog -->
</div>
<!-- /jumuiya station -->

<!-- jumuiya station -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeJumuiyaModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Jumuiya</h4>
      </div>
      <div class="modal-body">

      	<div class="removeJumuiyaMessages"></div>

        <p>Do you really want to remove ?</p>
      </div>
      <div class="modal-footer removeJumuiyaFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removeJumuiyaBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /jumuiya station -->


<script src="custom/js/jumuiya.js"></script>

<?php require_once 'includes/footer.php'; ?>