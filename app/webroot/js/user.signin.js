$(function () {
	// validate signup form on keyup and submit
	$("#UserSigninForm").validate({
		rules: {
			"data[User][email]": {
				required: true,
				email: true,
			},
			"data[User][password]": {
				required: true,
				minlength: 6,
				maxlength: 20,
			},
		},
		messages: {
			"data[User][email]": {
				required: "Please enter your email address",
			},
			"data[User][password]": {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long",
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
					if (response.success) {
						window.location.href = "users";
					} else {
						showErrorToast(response.message);
					}
				},
				error: function (xhr, textStatus, errorThrown) {
					var errorMessage = "";
					try {
						var errorResponse = JSON.parse(xhr.responseText);
						if (errorResponse && errorResponse.message) {
							errorMessage = errorResponse.message;
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
	function showErrorToast(message) {
		$(".toast").removeClass("alert-success").addClass("alert-danger");
		$(".toast-header strong").text("Error");
		$(".toast-body").text(message);
		$(".toast").toast("show");
	}
});
