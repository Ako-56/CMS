var manageGroupTable;

$(document).ready(function() {
	// top bar active
	$('#navGroup').addClass('active');
	
	// manage group table
	manageGroupTable = $("#manageGroupTable").DataTable({
		'ajax': 'php_action/fetchGroup.php',
		'order': []		
	});

	// submit group form function
	$("#submitGroupForm").unbind('submit').bind('submit', function() {
		// remove the error text
		$(".text-danger").remove();
		// remove the form error
		$('.form-group').removeClass('has-error').removeClass('has-success');			

		var groupName = $("#groupName").val();
		var groupStatus = $("#groupStatus").val();

		if(groupName == "") {
			$("#groupName").after('<p class="text-danger">Group Name field is required</p>');
			$('#groupName').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#groupName").find('.text-danger').remove();
			// success out for form 
			$("#groupName").closest('.form-group').addClass('has-success');	  	
		}

		if(groupStatus == "") {
			$("#groupStatus").after('<p class="text-danger">Group Name field is required</p>');

			$('#groupStatus').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#groupStatus").find('.text-danger').remove();
			// success out for form 
			$("#groupStatus").closest('.form-group').addClass('has-success');	  	
		}

		if(groupName && groupStatus) {
			var form = $(this);
			// button loading
			$("#createGroupBtn").button('loading');

			$.ajax({
				url : form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {
					// button loading
					$("#createGroupBtn").button('reset');

					if(response.success == true) {
						// reload the manage member table 
						manageGroupTable.ajax.reload(null, false);						

  	  			// reset the form text
						$("#submitGroupForm")[0].reset();
						// remove the error text
						$(".text-danger").remove();
						// remove the form error
						$('.form-group').removeClass('has-error').removeClass('has-success');
  	  			
  	  			$('#add-group-messages').html('<div class="alert alert-success">'+
            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
          '</div>');

  	  			$(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert
					}  // if

				} // /success
			}); // /ajax	
		} // if

		return false;
	}); // /submit group form function

});

function editGroup(groupId = null) {
	if(groupId) {
		// remove hidden group id text
		$('#groupId').remove();

		// remove the error 
		$('.text-danger').remove();
		// remove the form-error
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// modal loading
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.edit-group-result').addClass('div-hide');
		// modal footer
		$('.editGroupFooter').addClass('div-hide');

		$.ajax({
			url: 'php_action/fetchSelectedGroup.php',
			type: 'post',
			data: {groupId : groupId},
			dataType: 'json',
			success:function(response) {
				// modal loading
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-group-result').removeClass('div-hide');
				// modal footer
				$('.editGroupFooter').removeClass('div-hide');

				// setting the group name value 
				$('#editGroupName').val(response.group_name);
				// setting the group status value
				$('#editGroupStatus').val(response.group_active);
				// group id 
				$(".editGroupFooter").after('<input type="hidden" name="groupId" id="groupId" value="'+response.group_id+'" />');

				// update group form 
				$('#editGroupForm').unbind('submit').bind('submit', function() {

					// remove the error text
					$(".text-danger").remove();
					// remove the form error
					$('.form-group').removeClass('has-error').removeClass('has-success');			

					var groupName = $('#editGroupName').val();
					var groupStatus = $('#editGroupStatus').val();

					if(groupName == "") {
						$("#editGroupName").after('<p class="text-danger">Group Name field is required</p>');
						$('#editGroupName').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editGroupName").find('.text-danger').remove();
						// success out for form 
						$("#editGroupName").closest('.form-group').addClass('has-success');	  	
					}

					if(groupStatus == "") {
						$("#editGroupStatus").after('<p class="text-danger">Group Name field is required</p>');

						$('#editGroupStatus').closest('.form-group').addClass('has-error');
					} else {
						// remove error text field
						$("#editGroupStatus").find('.text-danger').remove();
						// success out for form 
						$("#editGroupStatus").closest('.form-group').addClass('has-success');	  	
					}

					if(groupName && groupStatus) {
						var form = $(this);

						// submit btn
						$('#editGroupBtn').button('loading');

						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {

								if(response.success == true) {
									console.log(response);
									// submit btn
									$('#editGroupBtn').button('reset');

									// reload the manage member table 
									manageGroupTable.ajax.reload(null, false);								  	  										
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
			  	  			
			  	  			$('#edit-group-messages').html('<div class="alert alert-success">'+
			            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
			          '</div>');

			  	  			$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert
								} // /if
									
							}// /success
						});	 // /ajax												
					} // /if

					return false;
				}); // /update group form

			} // /success
		}); // ajax function

	} else {
		alert('error!! Refresh the page again');
	}
} // /edit groups function

function removeGroups(groupId = null) {
	if(groupId) {
		$('#removeGroupId').remove();
		$.ajax({
			url: 'php_action/fetchSelectedGroup.php',
			type: 'post',
			data: {groupId : groupId},
			dataType: 'json',
			success:function(response) {
				$('.removeGroupFooter').after('<input type="hidden" name="removeGroupId" id="removeGroupId" value="'+response.group_id+'" /> ');

				// click on remove button to remove the group
				$("#removeGroupBtn").unbind('click').bind('click', function() {
					// button loading
					$("#removeGroupBtn").button('loading');

					$.ajax({
						url: 'php_action/removeGroup.php',
						type: 'post',
						data: {groupId : groupId},
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// button loading
							$("#removeGroupBtn").button('reset');
							if(response.success == true) {

								// hide the remove modal 
								$('#removeMemberModal').modal('hide');

								// reload the group table 
								manageGroupTable.ajax.reload(null, false);
								
								$('.remove-messages').html('<div class="alert alert-success">'+
			            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
			          '</div>');

			  	  			$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert
							} else {

							} // /else
						} // /response messages
					}); // /ajax function to remove the group

				}); // /click on remove button to remove the group

			} // /success
		}); // /ajax

		$('.removeGroupFooter').after();
	} else {
		alert('error!! Refresh the page again');
	}
} // /remove groups function