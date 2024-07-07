var manageGroupmTable;
var manageMembTable;
var groupId;

$(document).ready(function() {
	var groupId = $("#memberGroup").val();
	
	manageGroupmTable = $("#manageGroupmTable").DataTable({
		'ajax': {
            'url': 'php_action/fetchGroupm.php',
			'type': 'POST',
			'data': {groupId : groupId},
		},
		'groupm': []
	});
});

function getGroupData(value) {
var groupId = $("#memberGroup").val();
//alert('asi '+ groupId);
	if ($.fn.DataTable.isDataTable('#manageGroupmTable')) {
        $('#manageGroupmTable').DataTable().destroy();
    }
	if(groupId) {
		
		$.ajax({
			url: 'php_action/fetchGroupm.php',
			type: 'post',
			data: {groupId : groupId},
			dataType: 'json',
			success:function(response) {
				//console.log(response);
				manageGroupmTable = $("#manageGroupmTable").DataTable({
					'ajax': {
						'url': 'php_action/fetchGroupm.php',
						'type': 'POST',
						'data': {groupId : groupId},
					},
					'groupm': []
				});
			} // /success
		}); // /ajax function to fetch the member data	
	}
}

function getMembData(value) {
var groupId = $("#membGroup").val();

	if(groupId){
		//alert('iko');
		 $('#wrapperx').show();
		 $("#assignGroupBtn").button('reset');
	}else{
		$('#wrapperx').hide();
		$('#assignGroupBtn').button('loading');
	}
	if ($.fn.DataTable.isDataTable('#manageMembTable')) {
        $('#manageMembTable').DataTable().destroy();
    }
	if(groupId) {
		$.ajax({
			url: 'php_action/fetchMemb.php',
			type: 'post',
			data: {groupId : groupId},
			dataType: 'json',
			success:function(response) {
				
				manageMembTable = $("#manageMembTable").DataTable({
					'ajax': {
						'url': 'php_action/fetchMemb.php',
						'type': 'POST',
						'data': {groupId : groupId},
					},
					'groupx': []
				});
			} // /success
		});
	}
}

$(document).ready(function() {
	var groupId = $("#membGroup").val();
	
	function anyCheckboxChecked() {
        return $('.memberCheckbox:checked').length > 0;
    }
	
	 $('#manageMembTable').on('change', '.memberCheckbox', function() {
        // Enable/disable submit button based on checkbox state
        $('#assignGroupBtn').prop('disabled', !anyCheckboxChecked());
    });
	
	//alert(groupId);
	if(groupId){
		//alert('iko');
		 $('#wrapperx').show();
		 $("#assignGroupBtn").button('reset');
	}else{
		//alert('iko hapa');
		$('#wrapperx').hide();
		$('#assignGroupBtn').button('loading');
	}
	
	$("#submitGroupForm").unbind('submit').bind('submit', function() {
		var form = $(this);
		
		var selMemb = document.querySelectorAll('input[name="selMemb[]"]:checked');
			
			var validateMember;
			
			  if(selMemb.length <= 0){	    		    	
				alert('Must select atleast one member');	
			  } else {      	
				validateMember = true;
			  }
		if(validateMember === true){
			$.ajax({
				url : form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),					
				dataType: 'json',
				success:function(response) {
					console.log(response);

					if(response.success == true) {
						$("#assignGroupBtn").button('reset');
					
						$(".text-danger").remove();
						$('.form-group').removeClass('has-error').removeClass('has-success');
						
							$("#submitGroupForm")[0].reset();
							$('#wrapperx').hide();
							//$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																	
							// shows a successful message after operation
							$('#add-messages').html('<div class="alert alert-success">'+
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
							manageMembTable.ajax.reload(null, false);
					}
				}
			});
		}
		
		return false;  
	}); // /submit group form function
});

// remove jumuiya 
function removeRow(rowId = null) {
	if(rowId) {
		// remove jumuiya button clicked
		$("#removeRowBtn").unbind('click').bind('click', function() {
			// loading remove button
			$("#removeRowBtn").button('loading');
			$.ajax({
				url: 'php_action/removeRow.php',
				type: 'post',
				data: {rowId: rowId},
				dataType: 'json',
				success:function(response) {
					// loading remove button
					$("#removeRowBtn").button('reset');
					if(response.success == true) {
						// remove jumuiya modal
						$("#removeRowModal").modal('hide');

						// update the jumuiya table
						manageGroupmTable.ajax.reload(null, false);

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
						$(".removeRowMessages").html('<div class="alert alert-success">'+
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


