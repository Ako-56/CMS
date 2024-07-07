var manageJumuiyaTable;

$(document).ready(function() {
	// top nav bar 
	$('#navJumuiya').addClass('active');
	// manage jumuiya data table
	manageJumuiyaTable = $('#manageJumuiyaTable').DataTable({
		'ajax': 'php_action/fetchJumuiya.php',
		'order': []
	});

	// add jumuiya modal btn clicked
	$("#addJumuiyaModalBtn").unbind('click').bind('click', function() {
		// // jumuiya form reset
		$("#submitJumuiyaForm")[0].reset();		

		// remove text-error 
		$(".text-danger").remove();
		// remove from-group error
		$(".form-group").removeClass('has-error').removeClass('has-success');

		// submit jumuiya form
		$("#submitJumuiyaForm").unbind('submit').bind('submit', function() {

			// form validation
			var jumuiyaName = $("#jumuiyaName").val();
			var stationName = $("#stationName").val();
			var jumuiyaStatus = $("#jumuiyaStatus").val();

			if(jumuiyaName == "") {
				$("#jumuiyaName").after('<p class="text-danger">Jumuiya Name field is required</p>');
				$('#jumuiyaName').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#jumuiyaName").find('.text-danger').remove();
				// success out for form 
				$("#jumuiyaName").closest('.form-group').addClass('has-success');	  	
			}	// /else

			if(stationName == "") {
				$("#stationName").after('<p class="text-danger">Station Name field is required</p>');
				$('#stationName').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#stationName").find('.text-danger').remove();
				// success out for form 
				$("#stationName").closest('.form-group').addClass('has-success');	  	
			}	// /else

			if(jumuiyaStatus == "") {
				$("#jumuiyaStatus").after('<p class="text-danger">Jumuiya Status field is required</p>');
				$('#jumuiyaStatus').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#jumuiyaStatus").find('.text-danger').remove();
				// success out for form 
				$("#jumuiyaStatus").closest('.form-group').addClass('has-success');	  	
			}	// /else

			if(jumuiyaName && stationName && jumuiyaStatus) {
				// submit loading button
				$("#createJumuiyaBtn").button('loading');

				var form = $(this);
				var formData = new FormData(this);

				$.ajax({
					url : form.attr('action'),
					type: form.attr('method'),
					data: formData,
					dataType: 'json',
					cache: false,
					contentType: false,
					processData: false,
					success:function(response) {

						if(response.success == true) {
							// submit loading button
							$("#createJumuiyaBtn").button('reset');
							
							$("#submitJumuiyaForm")[0].reset();

							$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																	
							// shows a successful message after operation
							$('#add-jumuiya-messages').html('<div class="alert alert-success">'+
		            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
		            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
		          '</div>');

							// remove the mesages
		          $(".alert-success").delay(500).show(10, function() {
								$(this).delay(3000).hide(10, function() {
									$(this).remove();
								});
							}); // /.alert

		          // reload the manage student table
							manageJumuiyaTable.ajax.reload(null, true);

							// remove text-error 
							$(".text-danger").remove();
							// remove from-group error
							$(".form-group").removeClass('has-error').removeClass('has-success');

						} // /if response.success
						
					} // /success function
				}); // /ajax function
			}	 // /if validation is ok 					

			return false;
		}); // /submit jumuiya form

	}); // /add jumuiya modal btn clicked
	

	// remove jumuiya 	

}); // document.ready fucntion

function editJumuiya(jumuiyaId = null) {

	if(jumuiyaId) {
		$("#jumuiyaId").remove();		
		// remove text-error 
		$(".text-danger").remove();
		// remove from-group error
		$(".form-group").removeClass('has-error').removeClass('has-success');
		// modal spinner
		$('.div-loading').removeClass('div-hide');
		// modal div
		$('.div-result').addClass('div-hide');

		$.ajax({
			url: 'php_action/fetchSelectedJumuiya.php',
			type: 'post',
			data: {jumuiyaId: jumuiyaId},
			dataType: 'json',
			success:function(response) {		
			
				// modal spinner
				$('.div-loading').addClass('div-hide');
				// modal div
				$('.div-result').removeClass('div-hide');				

				// jumuiya id 
				$(".editJumuiyaFooter").append('<input type="hidden" name="jumuiyaId" id="jumuiyaId" value="'+response.jumuiya_id+'" />');				
				$(".editJumuiyaPhotoFooter").append('<input type="hidden" name="jumuiyaId" id="jumuiyaId" value="'+response.jumuiya_id+'" />');				
				alert(response.jumuiya_id);
				// jumuiya name
				$("#editJumuiyaName").val(response.jumuiya_name);
				// station name
				$("#editStationName").val(response.station_id);
				// status
				$("#editJumuiyaStatus").val(response.active);

				// update the jumuiya data function
				$("#editJumuiyaForm").unbind('submit').bind('submit', function() {

					// form validation
					var jumuiyaName = $("#editJumuiyaName").val();
					var stationName = $("#editStationName").val();
					var jumuiyaStatus = $("#editJumuiyaStatus").val();
								

					if(jumuiyaName == "") {
						$("#editJumuiyaName").after('<p class="text-danger">Jumuiya Name field is required</p>');
						$('#editJumuiyaName').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editJumuiyaName").find('.text-danger').remove();
						// success out for form 
						$("#editJumuiyaName").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(stationName == "") {
						$("#editStationName").after('<p class="text-danger">Station Name field is required</p>');
						$('#editStationName').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editStationName").find('.text-danger').remove();
						// success out for form 
						$("#editStationName").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(jumuiyaStatus == "") {
						$("#editJumuiyaStatus").after('<p class="text-danger">Jumuiya Status field is required</p>');
						$('#editJumuiyaStatus').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editJumuiyaStatus").find('.text-danger').remove();
						// success out for form 
						$("#editJumuiyaStatus").closest('.form-group').addClass('has-success');	  	
					}	// /else					

					if(jumuiyaName && stationName && jumuiyaStatus) {
						// submit loading button
						$("#editJumuiyaBtn").button('loading');

						var form = $(this);
						var formData = new FormData(this);

						$.ajax({
							url : form.attr('action'),
							type: form.attr('method'),
							data: formData,
							dataType: 'json',
							cache: false,
							contentType: false,
							processData: false,
							success:function(response) {
								console.log(response);
								if(response.success == true) {
									// submit loading button
									$("#editJumuiyaBtn").button('reset');																		

									$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																			
									// shows a successful message after operation
									$('#edit-jumuiya-messages').html('<div class="alert alert-success">'+
				            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
				            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
				          '</div>');

									// remove the mesages
				          $(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert

				          // reload the manage student table
									manageJumuiyaTable.ajax.reload(null, true);

									// remove text-error 
									$(".text-danger").remove();
									// remove from-group error
									$(".form-group").removeClass('has-error').removeClass('has-success');

								} // /if response.success
								
							} // /success function
						}); // /ajax function
					}	 // /if validation is ok 					

					return false;
				}); // update the jumuiya data function

			} // /success function
		}); // /ajax to fetch jumuiya image

				
	} else {
		alert('error please refresh the page');
	}
} // /edit jumuiya function

// remove jumuiya 
function removeJumuiya(jumuiyaId = null) {
	if(jumuiyaId) {
		// remove jumuiya button clicked
		$("#removeJumuiyaBtn").unbind('click').bind('click', function() {
			// loading remove button
			$("#removeJumuiyaBtn").button('loading');
			$.ajax({
				url: 'php_action/removeJumuiya.php',
				type: 'post',
				data: {jumuiyaId: jumuiyaId},
				dataType: 'json',
				success:function(response) {
					// loading remove button
					$("#removeJumuiyaBtn").button('reset');
					if(response.success == true) {
						// remove jumuiya modal
						$("#removeJumuiyaModal").modal('hide');

						// update the jumuiya table
						manageJumuiyaTable.ajax.reload(null, false);

						// remove success messages
						$(".remove-messages").html('<div class="alert alert-success">'+
		            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
		            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
		          '</div>');

						// remove the mesages
	          $(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert
					} else {

						// remove success messages
						$(".removeJumuiyaMessages").html('<div class="alert alert-success">'+
		            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
		            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
		          '</div>');

						// remove the mesages
	          $(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert

					} // /error
				} // /success function
			}); // /ajax fucntion to remove the jumuiya
			return false;
		}); // /remove jumuiya btn clicked
	} // /if jumuiyaid
} // /remove jumuiya function

