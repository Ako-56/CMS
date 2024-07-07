var manageAccTable;

$(document).ready(function() {
	// top bar active
	$('#navAcc').addClass('active');
	
	// manage acc table
	manageAccTable = $("#manageAccTable").DataTable({
		'ajax': 'php_action/fetchAcc.php',
		'order': []		
	});

	// submit acc form function
	$("#submitAccForm").unbind('submit').bind('submit', function() {
		// remove the error text
		$(".text-danger").remove();
		// remove the form error
		$('.form-group').removeClass('has-error').removeClass('has-success');			

		var accName = $("#accName").val();
		var accStatus = $("#accStatus").val();

		if(accName == "") {
			$("#accName").after('<p class="text-danger">Acc Name field is required</p>');
			$('#accName').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#accName").find('.text-danger').remove();
			// success out for form 
			$("#accName").closest('.form-group').addClass('has-success');	  	
		}

		if(accStatus == "") {
			$("#accStatus").after('<p class="text-danger">Acc Name field is required</p>');

			$('#accStatus').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#accStatus").find('.text-danger').remove();
			// success out for form 
			$("#accStatus").closest('.form-group').addClass('has-success');	  	
		}

		if(accName && accStatus) {
			var form = $(this);
			// button loading
			$("#createAccBtn").button('loading');

			$.ajax({
				url : form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {
					// button loading
					$("#createAccBtn").button('reset');

					if(response.success == true) {
						// reload the manage member table 
						manageAccTable.ajax.reload(null, false);						

  	  			// reset the form text
						$("#submitAccForm")[0].reset();
						// remove the error text
						$(".text-danger").remove();
						// remove the form error
						$('.form-group').removeClass('has-error').removeClass('has-success');
  	  			
  	  			$('#add-acc-messages').html('<div class="alert alert-success">'+
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
	}); // /submit acc form function

});

function editAcc(accId = null) {
	if(accId) {
		// remove hidden acc id text
		$('#accId').remove();

		// remove the error 
		$('.text-danger').remove();
		// remove the form-error
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// modal loading
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.edit-acc-result').addClass('div-hide');
		// modal footer
		$('.editAccFooter').addClass('div-hide');

		$.ajax({
			url: 'php_action/fetchSelectedAcc.php',
			type: 'post',
			data: {accId : accId},
			dataType: 'json',
			success:function(response) {
				// modal loading
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-acc-result').removeClass('div-hide');
				// modal footer
				$('.editAccFooter').removeClass('div-hide');

				// setting the acc name value 
				$('#editAccName').val(response.acc_name);
				// setting the acc status value
				$('#editAccStatus').val(response.acc_active);
				// acc id 
				$(".editAccFooter").after('<input type="hidden" name="accId" id="accId" value="'+response.acc_id+'" />');

				// update acc form 
				$('#editAccForm').unbind('submit').bind('submit', function() {

					// remove the error text
					$(".text-danger").remove();
					// remove the form error
					$('.form-group').removeClass('has-error').removeClass('has-success');			

					var accName = $('#editAccName').val();
					var accStatus = $('#editAccStatus').val();

					if(accName == "") {
						$("#editAccName").after('<p class="text-danger">Acc Name field is required</p>');
						$('#editAccName').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editAccName").find('.text-danger').remove();
						// success out for form 
						$("#editAccName").closest('.form-group').addClass('has-success');	  	
					}

					if(accStatus == "") {
						$("#editAccStatus").after('<p class="text-danger">Acc Name field is required</p>');

						$('#editAccStatus').closest('.form-group').addClass('has-error');
					} else {
						// remove error text field
						$("#editAccStatus").find('.text-danger').remove();
						// success out for form 
						$("#editAccStatus").closest('.form-group').addClass('has-success');	  	
					}

					if(accName && accStatus) {
						var form = $(this);

						// submit btn
						$('#editAccBtn').button('loading');

						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {

								if(response.success == true) {
									console.log(response);
									// submit btn
									$('#editAccBtn').button('reset');

									// reload the manage member table 
									manageAccTable.ajax.reload(null, false);								  	  										
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
			  	  			
			  	  			$('#edit-acc-messages').html('<div class="alert alert-success">'+
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
				}); // /update acc form

			} // /success
		}); // ajax function

	} else {
		alert('error!! Refresh the page again');
	}
} // /edit accs function

function removeAcc(accId = null) {
	if(accId) {
		$('#removeAccId').remove();
		$.ajax({
			url: 'php_action/fetchSelectedAcc.php',
			type: 'post',
			data: {accId : accId},
			dataType: 'json',
			success:function(response) {
				$('.removeAccFooter').after('<input type="hidden" name="removeAccId" id="removeAccId" value="'+response.acc_id+'" /> ');

				// click on remove button to remove the acc
				$("#removeAccBtn").unbind('click').bind('click', function() {
					// button loading
					$("#removeAccBtn").button('loading');

					$.ajax({
						url: 'php_action/removeAcc.php',
						type: 'post',
						data: {accId : accId},
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// button loading
							$("#removeAccBtn").button('reset');
							if(response.success == true) {

								// hide the remove modal 
								$('#removeMemberModal').modal('hide');

								// reload the acc table 
								manageAccTable.ajax.reload(null, false);
								
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
					}); // /ajax function to remove the acc

				}); // /click on remove button to remove the acc

			} // /success
		}); // /ajax

		$('.removeAccFooter').after();
	} else {
		alert('error!! Refresh the page again');
	}
} // /remove accs function