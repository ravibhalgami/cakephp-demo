$(document).ready(function () {
	loadPaginatedData(1); // Load users for the first page initially

	function loadPaginatedData(page) {
		$.ajax({
			url: "users/list/page:" + page,
			type: "GET",
			dataType: "html",
			success: function (response) {
				$("#userTableContainer").html(response);
			},
		});
	}

	$(document).on("click", ".pagination a", function (e) {
		e.preventDefault(); // Prevent default link behavior

		var pageUrl = $(this).attr("href"); // Get URL of pagination link
		var page = pageUrl.split(":")[1]; // Extract page number from URL
		// Load paginated data for the specified page
		loadPaginatedData(page);
	});
});
