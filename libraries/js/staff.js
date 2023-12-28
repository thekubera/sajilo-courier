$(document).ready(function() {

	// For country get the JSON file and append in select option
    $.getJSON('libraries/js/allcountries.json', function (data) {
         $.each(data, function (index, value) {
            // APPEND OR INSERT DATA TO SELECT ELEMENT.
           
            $('.country').append('<option value="' + value.name + '">' + value.name + '</option>');
         });
     });

    const formName = $('#addCourier');

    $('#addCourier').on('submit', function(event) {
    	event.preventDefault();

    	$.ajax(`${formName.attr('action')}`, {
    		type: 'POST',
			data: formName.serialize(),

			success: function(data, status, xhr) {
				// Current element with error
            const errorEle = $("#"+formName.attr('id') + " .form-group .error");

            if(data.trim() === "1") {
               removeError(errorEle);
               $("#exampleModalLongTitle").text("Success");
               $(".modal-body").empty().append("<i class='fas fa-check-circle fa-5x text-success mb-4'></i><h2>Successfully new parcel added.</h2>");
               $("#exampleModalCenter").prependTo("body");
               $("#exampleModalCenter").modal('show');

               $("#close-btn").on('click', function() {
                  window.location.href = "Parcel/details?type=totalPickup";
               });
            }

            if(data.trim() === "sqlError") {
               removeError(errorEle);
               $("#exampleModalCenter").prependTo("body");
               $('#exampleModalCenter').modal('show');
            }

            // if fields are empty
            if(data.trim() === "errorEmpty") {
               removeError(errorEle);
               displayError("#ppriceerror", "Please fill all fields.");
            }

            if(data.trim() === "sinvalidemail") {
               removeError(errorEle);
               displayError("#semailerror", "Please enter valid email.");
            }

            if(data.trim() === "sinvalidcontact") {
               removeError(errorEle);
               displayError("#sphoneerror", "Please enter valid phone number.");
            }

            if(data.trim() === "rinvalidemail") {
               removeError(errorEle);
               displayError("#remailerror", "Please enter valid email.");
            }

            if(data.trim() === "rinvalidcontact") {
               removeError(errorEle);
               displayError("#rphoneerror", "Please enter valid phone number.");
            }

            if(data.trim() === "pweightError") {
               removeError(errorEle);
               displayError("#pwerror", "This field accepts positive numeric value only.");
            }

            if(data.trim() === "pbreadthError" || data.trim() === "pheightError" || data.trim() === "plengthError" ) {
               removeError(errorEle);
               displayError("#pderror","This fields accepts positive numeric value only.");
            }

            if(data.trim() === "ppriceError") {
               removeError(errorEle);
               displayError("#ppriceerror","This field accepts positive numeric value only.");
            }

            if(data.trim() === "sbranch") {
               removeError(errorEle);
               displayError("#sberror", "Sender and receiver branch can not be same.");
            }

            if(data.trim() === "berror") {
               removeError(errorEle);
               alert("Somthing went wrong!, Please try again.");
            }

            if(data.trim() === "sameEmail") {
               removeError(errorEle);
               displayError("#semailerror", "Sender and Receiver email can not be same.");
            } 
			}
    	});

    });

$('.searchbar > a').on('click', function(event) {
   event.preventDefault();

   const refnum = $('#search_box').val();
   if(refnum !== '') {
      $.ajax('Parcel/searchCourier', {
         type: 'POST',
         data: {
            refnum: refnum,
         },
         success: function(data,status,xhr) {
            if(data.trim() === "invalidRef") {
               displayError("#refError", "Please enter valid reference number.");
            } else if(data.trim() === "notExist") {
               displayError("#refError", "Entered reference number is not exist.");
             } else {
               $('#search-area').replaceWith(data.trim());
               $("#actionButtonModal").prependTo("body");
             }
         }
      });
   }

});

$('#statbtn').attr('disabled', true);

   $('#status').on('change', function() {
      if(this.value === 'Choose...') {
         $('#statbtn').attr('disabled', true);
      } else {
         $('#statbtn').attr('disabled', false);
      }
   });

   $('#changeStatus').on('submit', function(event) {
      event.preventDefault();

      const remarks = $('#remarks').val();
      const status = $('#status').val();
      const refnum = $("#refnum").val();

      changeStatus(refnum,remarks,status);
   });

   /*
      Event on dynamically created status change form 
      not on body.
      Since it was dynamically created we should select the 
      element based on ancestor.
      Note: Once inspect DOM after creating elements dynamically
      before selecting it.
   */

   $('body').on('submit', '.modal > .modal-dialog > .modal-content > .modal-body > form', function(event) {
      event.preventDefault();

      const remarks = $('#remarks').val();
      const status = $('#status').val();
      const refnum = $("#refnum").val();

      changeStatus(refnum,remarks,status);
      
   });

   $('#staffProfileUpdate').on('submit', function(event) {
      event.preventDefault();
      const formData = new FormData(this);

      $.ajax('Staff/updateProfile', {
         type: 'POST',
         data: formData,
         cache: false,
         contentType: false,
         processData: false,

         success: function(data, status, xhr) {
            console.log(data);
         }
      });
   });

   $('#staffChangePassword').on('submit', function(event) {
      event.preventDefault();

      $.ajax('Staff/passwordChange', {
         type: 'POST',
         data: $(this).serialize(),

         success: function(data, status, xhr) {

            // Current element with error
            const errorEle = $("#staffChangePassword .form-group .error");

            if(data.trim() === "1") {
               removeError(errorEle);
               successModal("Successfully user password changed.", "Staff/dashboard");
            }
            if(data.trim() === "sqlError") {
               $("#exampleModalCenter").prependTo("body");
               $('#exampleModalCenter').modal('show');
            }

            if(data.trim() === "errorEmpty") {
               removeError(errorEle);
               displayError("#newpass1Error", "Please fill all fields.");
            }

            if(data.trim() === "notMatch") {
               removeError(errorEle);
               displayError("#newpass1Error", "New Password does't match.");
            }

            if(data.trim() === "dupPass") {
               removeError(errorEle);
               displayError("#newpass1Error", "New password can not be same as old.");
            }

            if(data.trim() === "incorrectPass") {
               removeError(errorEle);
               displayError("#oldpassError", "Incorrect current password.");
            }

            if(data.trim() === "lenError") {
               removeError(errorEle);
               displayError("#newpass1Error", "Password must contain six or more characters.");
            }
         }
      });
   });

   $('#profilePictureForm').on('submit', function(event) {
      event.preventDefault();
      const formData = new FormData(this);

      $.ajax('Staff/profilePicture', {
         type: 'POST',
         data: formData,
         cache: false,
         contentType: false,
         processData: false,

         success: function(data, status, xhr) {
            if(data.trim() === "1") {
               successModal("Successfully profile picture updated.", "Staff/changeProfilePicture");
            }
            if(data.trim() === "error") {
               $("#exampleModalCenter").prependTo("body");
               $('#exampleModalCenter').modal('show');
            }
            if(data.trim() === "errorEmpty") {
               displayError("#pError", "Please choose any picture.");
            }
            if(data.trim() === "invalidExt") {
               displayError("#pError", "This type of file is not allowed.");
            }
            if(data.trim() === "uploadErr") {
               displayError("#pError", "Somthing went wrong. Try again.");
            }
            if(data.trim() === "sizeErr") {
               displayError("#pError", "Your file size is too big.");
            }
         }
      });

   }); 

});

function changeStatus(refnum, remarks, status) {
   $.ajax('Parcel/changeStatus', {
         type: 'POST',
         data: {
            refnum: refnum,
            remarks: remarks,
            status: status
         },

         success: function(data, status, xhr) {
            if(data.trim() === "1") {
               $("#actionButtonModal").modal('hide');
               $("#exampleModalLongTitle").text("Success");
               $(".modal-body").empty().append("<i class='fas fa-check-circle fa-5x text-success mb-4'></i><h2>Successfully parcel status updated.</h2>");
               $("#exampleModalCenter").prependTo("body");
               $("#exampleModalCenter").modal('show');

               $("#close-btn").on('click', function() {
                  window.location.reload(true);
               });
            }

            if(data.trim() === "sqlError") {
               $("#exampleModalCenter").prependTo("body");
               $('#exampleModalCenter').modal('show');
            }

            if(data.trim() === "dupStat") {
               displayError("#statusError", "Past or current status is not allowed.");
            }

            if(data.trim() === "invalidChar") {
               displayError("#statusError", "Entered string is not valid.");
            }

            if(data.trim() === "invalidStat") {
               alert("Please enter valid status!");
            }

            if(data.trim() === "invalidRef") {
               alert("Please enter valid status.");
            }
         }
      });
}

// display error method 
 function displayError(elementId, errorMessage) {
   $(elementId).text(errorMessage);
   $(elementId).addClass('error');
 }

 // modal to display success message
 function successModal(message, loc) {
   $("#exampleModalLongTitle").text("Success");
   $(".modal-body").empty().append(`<i class='fas fa-check-circle fa-5x text-success mb-4'></i><h2>${message}</h2>`);
   $("#exampleModalCenter").prependTo("body");
   $("#exampleModalCenter").modal('show');
   
   $("#close-btn").on('click', function() {
      window.location.href = loc;
   });
 }

 // methot to remove error class 
function removeError(ele) {
   $(ele).removeClass().text("");
}