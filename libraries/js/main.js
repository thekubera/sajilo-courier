$(document).ready( function () {
		// dataTable JS initialization
	//$('#branch_details').DataTable();

	$('.searchbar > a').on('click', function(event) {
	   event.preventDefault();

	   const refnum = $('#search_box').val();
	   if(refnum !== '') {
	      $.ajax('Parcel/searchParcel', {
	         type: 'POST',
	         data: {
	            refnum: refnum,
	         },
	         success: function(data,status,xhr) {
	            if(data.trim() === "invalidRef") {
	               $(".modal-body > p").text("Reference number can contain alphabets,numbers and hyphens only.");
	               $('#exampleModalCenter').modal('show');
	            } else if(data.trim() === "notExist") {
	               $(".modal-body > p").text("Check the reference number provided by our staff and try again.");
	               $('#exampleModalCenter').modal('show');
	             } else {
	               $('#search-area').replaceWith(data.trim());
	               $("#actionButtonModal").prependTo("body");
	             }
	         }
	      });
	   }

	});

	$('#resetPasswordForm').on('submit', function(event) {
		event.preventDefault();

		$.ajax('User/resetPassword', {
			type: 'POST',
			data: $(this).serialize(),

			success: function(data, status, xhr) {
				if(data.trim() === "1") {
					$("#forgot-password-container").empty().append("<i class='fas fa-check-circle fa-5x text-success mb-4'></i><p>We have sent a mail with new password. Please visit mailbox of registered mail.</p><br><a href='./User/login'>Go back to login</a>");
				}
				if(data.trim() === "errorEmpty") {
					displayError("#emailError", "This field can not be empty.");
				}
				if(data.trim() === "invalidEmail") {
					displayError("#emailError", "Enter valid email.");
				}

				if(data.trim() === "notRegistered") {
					displayError("#emailError", "This email is not registered with system.");
				}

				if(data.trim() === 'error') {
               		$("#exampleModalCenter").prependTo("body");
               		$('#exampleModalCenter').modal('show');
				}
			}
		});
	});
});

// display error method 
 function displayError(elementId, errorMessage) {
   $(elementId).text(errorMessage);
   $(elementId).addClass('error');
 }
