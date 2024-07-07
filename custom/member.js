//alert('inside');
var manageMemberTable;

$(document).ready(function() {

	var divRequest = $(".div-request").text();

	// top nav bar 
	$("#navMember").addClass('active');

	if(divRequest == 'add')  {
		// add member	
		// top nav child bar 
		$('#topNavAddMember').addClass('active');	

		// create member form function
		$("#createMemberForm").unbind('submit').bind('submit', function() {
			var form = $(this);

			$('.form-group').removeClass('has-error').removeClass('has-success');
			$('.text-danger').remove();
				
			var memberDate = $("#memberDate").val();
			var memberName = $("#memberName").val();
			var memberContact = $("#memberContact").val();
			var memberGender = $("#memberGender").val();
			var memberStation = $("#memberStation").val();
			var memberJumuiya = $("#memberJumuiya").val();
			var memberStatus = $("#memberStatus").val();	
				//alert(memberName);

			// form validation 
			if(memberDate == "") {
				$("#memberDate").after('<p class="text-danger"> The Member Enroll Date field is required </p>');
				$('#memberDate').closest('.form-group').addClass('has-error');
			} else {
				$('#memberDate').closest('.form-group').addClass('has-success');
			} // /else

			if(memberName == "") {
				$("#memberName").after('<p class="text-danger"> The Client Name field is required </p>');
				$('#memberName').closest('.form-group').addClass('has-error');
			} else {
				$('#memberName').closest('.form-group').addClass('has-success');
			} // /else

			if(memberContact == "") {
				$("#memberContact").after('<p class="text-danger"> The Contact field is required </p>');
				$('#memberContact').closest('.form-group').addClass('has-error');
			} else {
				$('#memberContact').closest('.form-group').addClass('has-success');
			} // /else

			if(memberGender == "") {
				$("#memberGender").after('<p class="text-danger"> The Gender field is required </p>');
				$('#memberGender').closest('.form-group').addClass('has-error');
			} else {
				$('#memberGender').closest('.form-group').addClass('has-success');
			} // /else

			if(memberStation == "") {
				$("#memberStation").after('<p class="text-danger"> The Station field is required </p>');
				$('#memberStation').closest('.form-group').addClass('has-error');
			} else {
				$('#memberStation').closest('.form-group').addClass('has-success');
			} // /else

			if(memberJumuiya == "") {
				$("#memberJumuiya").after('<p class="text-danger"> The Jumuiya field is required </p>');
				$('#memberJumuiya').closest('.form-group').addClass('has-error');
			} else {
				$('#memberJumuiya').closest('.form-group').addClass('has-success');
			} // /else

			if(memberStatus == "") {
				$("#memberStatus").after('<p class="text-danger"> The Member Status field is required </p>');
				$('#memberStatus').closest('.form-group').addClass('has-error');
			} else {
				$('#memberStatus').closest('.form-group').addClass('has-success');
			} // /else
	   	

			if(memberDate && memberName && memberContact && memberGender && memberStation && memberJumuiya && memberStatus) {
					$.ajax({
						url : form.attr('action'),
						type: form.attr('method'),
						data: form.serialize(),					
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// reset button
							$("#createMemberBtn").button('reset');
							
							$(".text-danger").remove();
							$('.form-group').removeClass('has-error').removeClass('has-success');

							if(response.success == true) {
								//alert('tuko site');
								// create member button
								$(".success-messages").html('<div class="alert alert-success">'+
	            	'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            	'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
	            	' <br /> <br /> <a type="button" onclick="printMember('+response.RegNo+')" class="btn btn-primary"> <i class="glyphicon glyphicon-print"></i> Print </a>'+
	            	'<a href="members?o=add" class="btn btn-default" style="margin-left:10px;"> <i class="glyphicon glyphicon-plus-sign"></i> Add New Member </a>'+
	            	
	   		       '</div>');
								
							$("html, body, div.panel, div.pane-body").animate({scrollTop: '0px'}, 100);

							// disabled te modal footer button
							$(".submitButtonFooter").addClass('div-hide');
							// remove the member row
							$(".removeMemberRowBtn").addClass('div-hide');
								
							} else {
								alert(response.messages);								
							}
						} // /response
					}); // /ajax
			} // /if field validate is true
			

			return false;
		}); // /create member form function	
	
	} else if(divRequest == 'manord') {
		
		manageMemberTable = $("#manageMemberTable").DataTable({
			'ajax': 'php_action/fetchMember.php',
			'member': []
		});		
					
	} else if(divRequest == 'editOrd') {

		// edit member form function
		$("#editMemberForm").unbind('submit').bind('submit', function() {
			// alert('ok');
			var form = $(this);

			$('.form-group').removeClass('has-error').removeClass('has-success');
			$('.text-danger').remove();
				
			var memberDate = $("#memberDate").val();
			var memberName = $("#memberName").val();
			var memberContact = $("#memberContact").val();
			var memberGender = $("#memberGender").val();
			var memberStation = $("#memberStation").val();
			var memberJumuiya = $("#memberJumuiya").val();
			var memberStatus = $("#memberStatus").val();		

			// form validation 
			if(memberDate == "") {
				$("#memberDate").after('<p class="text-danger"> The Member Date field is required </p>');
				$('#memberDate').closest('.form-group').addClass('has-error');
			} else {
				$('#memberDate').closest('.form-group').addClass('has-success');
			} // /else

			if(memberName == "") {
				$("#memberName").after('<p class="text-danger"> The Client Name field is required </p>');
				$('#memberName').closest('.form-group').addClass('has-error');
			} else {
				$('#memberName').closest('.form-group').addClass('has-success');
			} // /else

			if(memberContact == "") {
				$("#memberContact").after('<p class="text-danger"> The Contact field is required </p>');
				$('#memberContact').closest('.form-group').addClass('has-error');
			} else {
				$('#memberContact').closest('.form-group').addClass('has-success');
			} // /else

			if(memberGender == "") {
				$("#memberGender").after('<p class="text-danger"> The Gender field is required </p>');
				$('#memberGender').closest('.form-group').addClass('has-error');
			} else {
				$('#memberGender').closest('.form-group').addClass('has-success');
			} // /else

			if(memberStation == "") {
				$("#memberStation").after('<p class="text-danger"> The Station field is required </p>');
				$('#memberStation').closest('.form-group').addClass('has-error');
			} else {
				$('#memberStation').closest('.form-group').addClass('has-success');
			} // /else

			if(memberJumuiya == "") {
				$("#memberJumuiya").after('<p class="text-danger"> The Jumuiya Type field is required </p>');
				$('#memberJumuiya').closest('.form-group').addClass('has-error');
			} else {
				$('#memberJumuiya').closest('.form-group').addClass('has-success');
			} // /else

			if(memberStatus == "") {
				$("#memberStatus").after('<p class="text-danger"> The Status Status field is required </p>');
				$('#memberStatus').closest('.form-group').addClass('has-error');
			} else {
				$('#memberStatus').closest('.form-group').addClass('has-success');
			} // /else	
	   	
//alert('tuko site');
			if(memberDate && memberName && memberContact && memberGender && memberStation && memberJumuiya && memberStatus) {
				
					$.ajax({
						url : form.attr('action'),
						type: form.attr('method'),
						data: form.serialize(),					
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// reset button
							$("#editMemberBtn").button('reset');
							
							$(".text-danger").remove();
							$('.form-group').removeClass('has-error').removeClass('has-success');

							if(response.success == true) {
								
								// create member button
								$(".success-messages").html('<div class="alert alert-success">'+
	            	'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            	'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +	            		            		            	
	   		       '</div>');
								
							$("html, body, div.panel, div.pane-body").animate({scrollTop: '0px'}, 100);

							// disabled te modal footer button
							$(".editButtonFooter").addClass('div-hide');
							// remove the member row
							$(".removeMemberRowBtn").addClass('div-hide');
								
							} else {
								alert(response.messages);								
							}
						} // /response
					}); // /ajax
			} // /if field validate is true
			

			return false;
		}); // /edit member form function	
	} 	

}); // /documernt


// print member function
function printMember(memberId = null) {
	if(memberId) {		
			
		$.ajax({
			url: 'php_action/printMember.php',
			type: 'post',
			data: {memberId: memberId},
			dataType: 'text',
			success:function(response) {
				
				var mywindow = window.open('', 'CMS', 'height=400,width=600');
        mywindow.document.write('<html><head><title>Member Register Form</title>');        
        mywindow.document.write('</head><body>');
        mywindow.document.write(response);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10
        mywindow.resizeTo(screen.width, screen.height);
setTimeout(function() {
    mywindow.print();
    mywindow.close();
}, 1250);

        //mywindow.print();
        //mywindow.close();
				
			}// /success function
		}); // /ajax function to fetch the printable member
	} // /if memberId
} // /print member function


// select on Jumuiya data
function getJumuiyaData(value) {

	if(value) {
		var stationId = $("#memberStation").val();
		var defaultOption = '<option value="">~~SELECT~~</option>'
		//alert(stationId);
		
		if(stationId == "") {
			$("#memberJumuiya").val("").trigger('change');

		} else {
			$.ajax({
				url: 'php_action/fetchSelectedJumuiya.php',
				type: 'post',
				data: {stationId : stationId},
				dataType: 'json',
				success:function(response) {
					$("#memberJumuiya").empty();
					
					$("#memberJumuiya").append(defaultOption);
					
					for (let i = 0; i < response.length; i++) {
						$("#memberJumuiya").append('<option value="' + response[i].JumuiyaCode + '">' + response[i].JumuiyaName + '</option>');
					}
				} // /success
			}); // /ajax function to fetch the member data	
		}
				
	} else {
		alert('no row! please refresh the page');
	}
} // /select on member data


function resetMemberForm() {
	// reset the input field
	$("#createMemberForm")[0].reset();
	// remove remove text danger
	$(".text-danger").remove();
	// remove form group error 
	$(".form-group").removeClass('has-success').removeClass('has-error');
} // /reset member form


// remove member from server
function removeMember(memberId = null) {
	if(memberId) {
		$("#removeMemberBtn").unbind('click').bind('click', function() {
			$("#removeMemberBtn").button('loading');

			$.ajax({
				url: 'php_action/removeMember.php',
				type: 'post',
				data: {memberId : memberId},
				dataType: 'json',
				success:function(response) {
					$("#removeMemberBtn").button('reset');

					if(response.success == true) {

						manageMemberTable.ajax.reload(null, false);
						// hide modal
						$("#removeMemberModal").modal('hide');
						// success messages
						$("#success-messages").html('<div class="alert alert-success">'+
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
						// error messages
						$(".removeMemberMessages").html('<div class="alert alert-warning">'+
	            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
	          '</div>');

						// remove the mesages
	          $(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert	          
					} // /else

				} // /success
			});  // /ajax function to remove the member

		}); // /remove member button clicked
		

	} else {
		alert('error! refresh the page again');
	}
}
// /remove member from server