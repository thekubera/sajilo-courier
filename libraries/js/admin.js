$(document).ready(function() {
	/* 
		Actions related to login form (Admin/login)
		Form validation using ajax request
		Login route after successful validation 
	*/
	// Enable the login button only after jquery is loaded
	$('#login-btn').attr('disabled', false);


	$('#loginForm').on('submit', function(event) {
		// prevent form from submission by default 
		event.preventDefault();

		// take a value of input
		const email = $('#email').val();
		const password = $('#password').val();

		// validate it if you need client side validation
		function isEmail(email) {
			return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
		}

		// send it for server side validation
		// send it through ajax
		$.ajax('User/loginCheck',
			{
		 		type: 'POST',
		 		data: {
		 			email: email,
		 			password: password
		 		},

		 		// success callback Function       
		 		success: function (data, status, xhr) {
		 		  //console.log(data);

		 		  // For successful admin callbacks
		 		  if (data.trim() === "1") {
		 		  	window.location.href = "Admin/dashboard";
		 		  }

		 		  // For successful staff callbacks
		 		  if(data.trim() === "2") {
		 		  	window.location.href = "Staff/dashboard";
		 		  }

		 		  // if response is 0 invalid username or password
		 		  if(data.trim() === "0") {
		 		  	displayError("#passwordError", "Incorrect email or password.");
		 		  }

		 		 // if both email and password is empty
		 		 if(data === "errorEmpty") {
		 		 	displayError("#passwordError", "Email and password can not be empty.");
		 		 }

		 		 // if only email is empty
		 		 if(data === "emailEmpty") {
		 		 	displayError("#emailError", "Email can not be empty.");
		 		 }

		 		 // if only password is empty
		 		 if(data === "passwordEmpty" ) {
		 		 	displayError("#passwordError", "Password can not be empty.");
		 		 }

		 		 // if email is invalid
		 		 if(data === "invalidEmail") {
		 		 	displayError("#emailError", "Enter valid email.");
		 		 }

		 		 // if email is valid remove invalid flag from form
		 		 if(isEmail(email) && $('#emailError').hasClass('error')) {
		 		 	displayError("#emailError", "");
		 		 }
    		}
		});
	});

	/*
		(Admin/login) ends here. 
	*/


	/*
		Actions related to branch Addition form (Branch/addBranch)
	*/

	/*
		Selectiong the form dynamically since we are using same
		validation for both insert and update form.
		So we need to select form either one of them dynamically.
	*/
	const formName = $('#addBranch, #updateBranch');
	// .attr('action')

	formName.on('submit', (event) => {
		// prevent form from submission by default 
		event.preventDefault();

		// take input from form
		/*const bname = $('#branchName').val();
		const badd = $('#branchAddress').val();
		const bemail = $('#branchEmail').val();
		const bcontact = $('#branchContact').val();
		const bcountry = $('#branchCountry').val();*/

		// Send it through ajax
		// pick a request dynamically 
		$.ajax(`${formName.attr('action')}`, {
			type: 'POST',
			data: formName.serialize(),

			// success callback
			success: function (data, status, xhr) {
				const errorEle = $("#"+formName.attr('id') + " .form-group .error");
				// for success callback
				if(data.trim() === "1") {
					removeError(errorEle);
					$("#exampleModalLongTitle").text("Success");
					$(".modal-body").empty().append("<i class='fas fa-check-circle fa-5x text-success mb-4'></i><h2>Successfully new branch added.</h2>");
					$("#exampleModalCenter").prependTo("body");
					$("#exampleModalCenter").modal('show');

					$("#exampleModalCenter").delay(1000).fadeOut(2000);

					setTimeout(() => {
						$("#exampleModalCenter").modal('hide');
						window.location.href = "Branch/branchDetails";
					}, 2900)
				}

				// for error
				if(data.trim() === "sqlError" || data.trim() === "updateError") {
					removeError(errorEle);
					$("#exampleModalCenter").prependTo("body");
					$('#exampleModalCenter').modal('show');
				}

				// for update 
				if(data.trim() === "updated") {
					removeError(errorEle);
					$("#exampleModalLongTitle").text("Success");
					$(".modal-body").empty().append("<i class='fas fa-check-circle fa-5x text-success mb-4'></i><h2>Successfully branch details updated.</h2>");
					$("#exampleModalCenter").prependTo("body");
					$("#exampleModalCenter").modal('show');

					$("#exampleModalCenter").delay(1000).fadeOut(2000);

					setTimeout(() => {
						$("#exampleModalCenter").modal('hide');
						window.location.href = "Branch/branchDetails";
					}, 2900)

				}

				// if fields are empty
				if(data.trim() === "errorEmpty") {
					displayError("#bcountryError", "Please fill all fields.");
				}

				// for invalid branch name
				if(data.trim() === "invalidbname") {
					removeError(errorEle);
					displayError("#bnameError", "Only alphabets and whitespace are allowed.");
				}

				// for invalid branch address
				if(data.trim() === "invalidbadd") {
					removeError(errorEle);
					displayError("#baddressError", "Please enter valid address.");
				} 

				// for invalid email address
				if(data.trim() === "invalidemail") {
					removeError(errorEle);
					displayError("#bemailError", "Please enter valid email.");
				}

				// for invalid contact
				if(data.trim() === "invalidcontact") {
					removeError(errorEle);
					displayError("#bcontactError", "Please enter valid phone number.");
				}

				// if country is not selected
				if(data.trim() === "selectcountry") {
					removeError(errorEle);
					displayError("#bcountryError", "Please select one country.");
				} 	
			}
		});
		
	});

	// For country get the JSON file and append in select option
    $.getJSON('libraries/js/allcountries.json', function (data) {
         $.each(data, function (index, value) {
            // APPEND OR INSERT DATA TO SELECT ELEMENT.
           
            $('#country').append('<option value="' + value.name + '">' + value.name + '</option>');
         });
     });


	/*Branch/addBranch ends here.*/

	/*
	 * Actions related to Staff/add (Form handling for staff addition 
		and update)
	*/
	const staffForm = $('#staffAddition, #staffUpdate');

	staffForm.on('submit', (e) => {
		e.preventDefault();

		// send it through ajax
		$.ajax(`${staffForm.attr('action')}`, {
			type: 'POST',
			data: staffForm.serialize(),

			success: (data, status, xhr) => {
				// Current element with error
				const errorEle = $("#"+staffForm.attr('id') + " .form-group .error");

				// if success
				if(data.trim() === "1") {
					removeError(errorEle);
					$("#exampleModalLongTitle").text("Success");
					$(".modal-body").empty().append("<i class='fas fa-check-circle fa-5x text-success mb-4'></i><h2>Successfully new staff detail added.</h2>");
					$("#exampleModalCenter").prependTo("body");
					$("#exampleModalCenter").modal('show');

					$("#exampleModalCenter").delay(1000).fadeOut(2000);

					setTimeout(() => {
						$("#exampleModalCenter").modal('hide');
						window.location.href = "Staff/staffDetails";
					}, 2900)
				}

				// if success
				if(data.trim() === "updated") {
					removeError(errorEle);
					$("#exampleModalLongTitle").text("Success");
					$(".modal-body").empty().append("<i class='fas fa-check-circle fa-5x text-success mb-4'></i><h2>Successfully staff detail updated.</h2>");
					$("#exampleModalCenter").prependTo("body");
					$("#exampleModalCenter").modal('show');

					$("#exampleModalCenter").delay(1000).fadeOut(2000);

					setTimeout(() => {
						$("#exampleModalCenter").modal('hide');
						window.location.href = "Staff/staffDetails";
					}, 2900)
				}

				// if failure
				if(data.trim() === "sqlError") {
					removeError(errorEle);
					$("#exampleModalCenter").prependTo("body");
					$('#exampleModalCenter').modal('show');
				}

				// if fields are empty
				if(data.trim() === "errorEmpty") {
					removeError(errorEle);
					displayError("#scontactError", "Please fill all fields.");
				}

				// if branch name is not matched
				if(data.trim() === "bnameError") {
					removeError(errorEle);
					displayError("#bnameError", "Branch name doesn't exist.");
				}

				// if user entered invalid first middle or last name
				if(data.trim() === "invalidFName") {
					removeError(errorEle);
					displayError("#fnameError", "First name can contain alphabets only.");
				}

				if(data.trim() === "invalidMName") {
					removeError(errorEle);
					displayError("#mnameError", "Middle name can contain alphabets only.");
				}

				if(data.trim() === "invalidLName") {
					removeError(errorEle);
					displayError("#lnameError", "Last name can contain alphabets only.");
				}

				if(data.trim() === "invalidbadd") {
					removeError(errorEle);
					displayError("#saddError", "Please enter valid address.");
				} 

				// for invalid email address
				if(data.trim() === "invalidemail") {
					removeError(errorEle);
					displayError("#semailError", "Please enter valid email.");
				}

				// for invalid contact
				if(data.trim() === "invalidcontact") {
					removeError(errorEle);
					displayError("#scontactError", "Please enter valid phone number.");
				}

				// already exists email
				if(data.trim() === "dupEmail") {
					removeError(errorEle);
					displayError("#semailError", "This email is associated with another account.");
				}

				// already exists phone number
				if(data.trim() === "dupPhone") {
					removeError(errorEle);
					displayError("#scontactError", "This phone number is associated with another account.");
				}
			}
		});

	});
	// check email association with another account
	$('#staffEmail').on('blur', () => {
		const staffEmail = $('#staffEmail').val();

		$.ajax('Staff/checkEmail', {
			type: 'POST',
			data: {
				email: staffEmail
			},

			success: function (data, status, xhr) {
				if(data.trim() === "invalidEmail") {
					displayError("#semailError", "Please enter valid email.");
				}
				if(data.trim() === "0") {
					displayError("#semailError", "This email is associated with another account.");
				}
				if(data.trim() === "1") {
					removeError("#semailError");
				}
			}

		});
	});

	// check phone number association with another account
	$('#staffContact').on('blur', () => {
		const staffContact = $('#staffContact').val();

		$.ajax('Staff/checkPhone', {
			type: 'POST',
			data: {
				phone: staffContact
			},

			success: function (data, status, xhr) {
				if(data.trim() === "invalidPhone") {
					displayError("#scontactError", "Please enter valid phone number.");
				}
				if(data.trim() === "0") {
					displayError("#scontactError", "This phone number is associated with another account.");
				}
				if(data.trim() === "1") {
					removeError("#scontactError");
				}
			}

		});
	});

	$('#reportForm').on('submit', function(e) {
		e.preventDefault();
		$.ajax('Admin/searchReport', {
			type: 'POST',
			data: $(this).serialize(),

			success: function(data, status, xhr) {
				
				if(data.trim() === "errorEmpty") {
					displayError("#todateErr", "Please choose date.");
				}
				if(data.trim() === "invalidDate") {
					displayError("#todateErr", "Please enter valid date");
				} else {
					('#reportForm').replaceWith(data.trim());
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

 // methot to remove error class	
function removeError(ele) {
	$(ele).removeClass().text("");
}