function showErrorToast(message) {
	$(".toast").removeClass("alert-success").addClass("alert-danger");
	$(".toast-header strong").text("Error");
	$(".toast-body").text(message);
	$(".toast").toast("show");
}
