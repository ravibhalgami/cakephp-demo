$(function () {
	$("#UserRegisterForm, #UserEditForm").validate({
		rules: {
			"data[User][first_name]": {
				required: true,
				lettersonly: true,
			},
			"data[User][last_name]": {
				required: true,
				lettersonly: true,
			},
			"data[User][contact_number]": {
				required: true,
				validContactNumber: true,
			},
			"data[User][email]": {
				required: true,
				email: true,
			},
			"data[User][password]": {
				required: true,
				minlength: 6,
				maxlength: 20,
			},
			"data[User][confirm_password]": {
				required: true,
				minlength: 6,
				maxlength: 20,
				equalTo: "#UserPassword",
			},
			"data[User][address]": "required",
			"data[User][state_id]": "required",
		},
		messages: {
			"data[User][first_name]": {
				required: "Please enter your First Name",
				lettersonly: "Please enter alphabet only",
			},
			"data[User][last_name]": {
				required: "Please enter your Last Name",
				lettersonly: "Please enter alphabet only",
			},
			"data[User][contact_number]": {
				required: "Please enter your contact Number",
				validContactNumber: "Please enter a valid 10-digit phone number",
			},
			"data[User][email]": {
				required: "Please enter your email address",
			},
			"data[User][password]": {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long",
			},
			"data[User][confirm_password]": {
				required: "Please provide a confirm password",
				minlength: "Your confirm password must be at least 5 characters long",
				equalTo: "Please enter the same password as above",
			},
			"data[User][address]": {
				required: "Please enter your address",
			},
			"data[User][state_id]": {
				required: "Please select your state",
			},
		},
		submitHandler: function (form) {
			var formData = $(form).serialize(); // Serialize form dat
			$.ajax({
				type: $(form).attr("method"),
				url: $(form).attr("action"),
				data: formData,
				dataType: "json",
				success: function (response) {
					if (response.redirect) {
						window.location.href = response.redirect;
					} else {
						showErrorToast(response.message);
					}
				},
				error: function (xhr, textStatus, errorThrown) {
					var errorMessage = "";
					try {
						var errorResponse = JSON.parse(xhr.responseText);
						if (errorResponse && errorResponse.error) {
							errorMessage = errorResponse.error;
						}
					} catch (e) {
						errorMessage = "Bad Request";
					}
					showErrorToast(errorMessage);
				},
			});
			return false;
		},
	});
});
